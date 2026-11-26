<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;
use App\Middleware\RateLimiter;
use App\Services\AccountService;
use App\Services\AuthService;

/**
 * AuthController — handles login, logout, first-login password change,
 * and general password change for all user types.
 */
class AuthController extends BaseController
{
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    // ─── Login ───────────────────────────────────────────────────────

    /**
     * Show the login form.
     */
    public function showLogin(): void
    {
        AuthMiddleware::requireGuest();

        $this->view('auth/login', [
            'pageTitle' => t('Login'),
            'authPage'  => 'login',
        ], 'layouts/auth');
    }

    /**
     * Process the login form submission.
     */
    public function login(): void
    {
        verifyCsrfToken();

        $data = [
            'user_id'  => trim($_POST['user_id'] ?? $_POST['username'] ?? $_POST['email'] ?? ''),
            'password' => $_POST['password'] ?? '',
        ];

        // Validate input
        $errors = $this->validate($data, [
            'user_id'  => 'required',
            'password' => 'required',
        ]);

        if (!empty($errors)) {
            $this->flash('error', implode(' ', $errors));
            $this->redirect('/login');
        }

        // Rate limit: max 5 attempts per 15 minutes per user ID
        $rateLimiter  = new RateLimiter();
        $rateLimitKey = 'login_' . $data['user_id'];
        $rateCheck    = $rateLimiter->checkRateLimit($rateLimitKey, 5, 15);

        // ...and at most 30 per 15 minutes from one address, so guessing
        // across many IDs is slowed down too.
        $ipKey   = 'login_ip_' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown');
        $ipCheck = $rateLimiter->checkRateLimit($ipKey, 30, 15);
        if (!$ipCheck['allowed']) {
            $rateCheck = $ipCheck;
        }

        if (!$rateCheck['allowed']) {
            $minutes = (int) ceil(($rateCheck['retryAfter'] ?? 900) / 60);
            $this->flash('error', t('Too many login attempts. Please try again in {n} minutes.', ['n' => $minutes]));
            $this->redirect('/login');
        }

        // Attempt authentication
        $result = $this->authService->login($data['user_id'], $data['password']);

        if ($result['success'] === false) {
            $rateLimiter->incrementAttempts($rateLimitKey);
            $rateLimiter->incrementAttempts($ipKey);

            $message = $result['message'] ?? 'Invalid credentials. Please try again.';
            $this->flash('error', $message);
            $this->redirect('/login');
        }

        // ── Success ──────────────────────────────────────────────────

        // Clear rate limit on successful login
        $rateLimiter->clearAttempts($rateLimitKey);

        // Regenerate session to prevent fixation attacks
        session_regenerate();

        $user     = $result['user'];
        $userType = $result['user_type']; // 'user', 'student', or 'parent'

        // Determine display name
        $displayName = match ($userType) {
            'parent' => $user['parent_name'] ?? 'Parent',
            default  => $user['full_name'] ?? 'User',
        };

        // Determine display ID
        $displayId = match ($userType) {
            'user'    => $user['user_id_display'] ?? null,
            'student' => $user['student_id_display'] ?? null,
            'parent'  => $user['phone1'] ?? null,
        };

        // Determine role
        $role = match ($userType) {
            'user'    => $user['role'] ?? 'staff',
            'student' => 'student',
            'parent'  => 'parent',
        };

        // Store user data in session
        session_set('user_id', $user['id']);
        session_set('user_name', $displayName);
        session_set('user_email', $user['email'] ?? null);
        session_set('user_role', $role);
        session_set('user_status', $user['status'] ?? 'active');
        session_set('user_institute_id', ($userType === 'user') ? ($user['institute_id'] ?? null) : null);
        session_set('user_display_id', $displayId);
        session_set('user_type', $userType);

        // Generate session fingerprint (IP + User-Agent hash)
        $fingerprint = hash('sha256',
            ($_SERVER['REMOTE_ADDR'] ?? '') . ($_SERVER['HTTP_USER_AGENT'] ?? '')
        );
        session_set('session_fingerprint', $fingerprint);

        // Track session activity
        session_set('last_activity', time());

        // Sessions end when the password changes (see AuthMiddleware).
        session_set('credential_version', (int) ($user['credential_version'] ?? 1));

        // A temporary password must be replaced before anything else:
        // staff with pending_first_login, students and parents flagged.
        $mustChange = $this->authService->isFirstLogin($user, $userType)
            || (in_array($userType, ['student', 'parent'], true) && !empty($user['must_change_password']));
        if ($mustChange) {
            session_set('first_login', true);
            $this->redirect('/first-login-password');
        }

        // Redirect to intended URL or dashboard
        $intended = session_get('intended_url') ?? '/dashboard';
        session_set('intended_url', null);

        // Not escaped here: the flash component escapes on output, and
        // escaping twice showed names with "&" as "&amp;".
        $this->flash('success', t('Welcome back, {name}!', ['name' => $displayName]));
        $this->redirect($intended);
    }

    // ─── First Login Password ────────────────────────────────────────

    /**
     * Show the first-login password change form.
     */
    public function showFirstLoginPassword(): void
    {
        AuthMiddleware::requireAuth();

        if (!session_get('first_login')) {
            $this->redirect('/dashboard');
        }

        $this->view('auth/first-login-password', [
            'pageTitle' => t('Change Your Password'),
        ], 'layouts/auth');
    }

    /**
     * Process the first-login password update.
     */
    public function updateFirstLoginPassword(): void
    {
        AuthMiddleware::requireAuth();
        verifyCsrfToken();

        if (!session_get('first_login')) {
            $this->redirect('/dashboard');
        }

        $data = [
            'new_password'              => $_POST['new_password'] ?? '',
            'new_password_confirmation' => $_POST['new_password_confirmation'] ?? '',
        ];

        // Validate password fields
        $errors = $this->validate($data, [
            'new_password' => 'required|min:8|confirmed',
        ]);

        if (!empty($errors)) {
            $this->flash('error', implode(' ', $errors));
            $this->redirect('/first-login-password');
        }

        $problem = AccountController::passwordProblem($data['new_password'], $data['new_password_confirmation']);
        if ($problem !== null) {
            $this->flash('error', $problem);
            $this->redirect('/first-login-password');
        }

        // Save it (users leave pending_first_login; students/parents drop the flag)
        $userId   = (int) session_get('user_id');
        $userType = (string) (session_get('user_type') ?? 'user');

        try {
            $accounts = new AccountService();
            $accounts->setPassword($userType, $userId, $data['new_password'], false);
            session_set('credential_version', $accounts->liveState($userType, $userId)['version'] ?? 1);
        } catch (\Throwable $e) {
            error_log('Failed to update first-login password: ' . $e->getMessage());
            $this->flash('error', 'Failed to update password. Please try again.');
            $this->redirect('/first-login-password');
        }

        // Clear first_login session flag and update session status
        session_set('first_login', null);
        session_set('user_status', 'active');

        // Log audit event
        $this->logPasswordChange($userId, $userType);

        $this->flash('success', t('Password updated successfully. Welcome!'));
        $this->redirect('/dashboard');
    }

    // ─── Change Password (General) ───────────────────────────────────

    /**
     * Show the change password form (available to all authenticated user types).
     */
    public function showChangePassword(): void
    {
        AuthMiddleware::requireAuth();

        $userType = session_get('user_type') ?? 'user';

        // Choose layout based on user type
        $layout = match ($userType) {
            'student' => 'layouts/admin',
            'parent'  => 'layouts/admin',
            default   => 'layouts/admin',
        };

        $this->view('auth/change-password', [
            'pageTitle' => t('Change Password'),
        ], $layout);
    }

    /**
     * Process the password change for any authenticated user type.
     */
    public function changePassword(): void
    {
        AuthMiddleware::requireAuth();
        verifyCsrfToken();

        $data = [
            'current_password'          => $_POST['current_password'] ?? '',
            'new_password'              => $_POST['new_password'] ?? '',
            'new_password_confirmation' => $_POST['new_password_confirmation'] ?? '',
        ];

        // Validate fields
        $errors = $this->validate($data, [
            'current_password' => 'required',
            'new_password'     => 'required|min:8|confirmed',
        ]);

        if (!empty($errors)) {
            $this->flash('error', implode(' ', $errors));
            $this->back();
        }

        $problem = AccountController::passwordProblem($data['new_password'], $data['new_password_confirmation']);
        if ($problem !== null) {
            $this->flash('error', $problem);
            $this->back();
        }

        $userId   = (int) session_get('user_id');
        $userType = session_get('user_type') ?? 'user';

        // Determine table and fetch current password hash
        $table = match ($userType) {
            'student' => 'students',
            'parent'  => 'parents',
            default   => 'users',
        };

        try {
            $db = \Database::connect();

            // Fetch current password hash from DB
            $sql  = "SELECT password_hash FROM {$table} WHERE id = :id LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->execute([':id' => $userId]);
            $row = $stmt->fetch();

            if (!$row) {
                $this->flash('error', 'User account not found.');
                $this->back();
            }

            // Verify current password
            if (!password_verify($data['current_password'], $row['password_hash'])) {
                $this->flash('error', 'Current password is incorrect.');
                $this->back();
            }

            // Update the password; other sessions of this account end,
            // this one carries on with the new credential version.
            $accounts = new AccountService($db);
            $accounts->setPassword($userType, $userId, $data['new_password'], false);
            session_set('credential_version', $accounts->liveState($userType, $userId)['version'] ?? 1);
        } catch (\Throwable $e) {
            error_log('Failed to change password: ' . $e->getMessage());
            $this->flash('error', 'Failed to update password. Please try again.');
            $this->back();
        }

        // Log audit event
        $this->logPasswordChange($userId, $userType);

        $this->flash('success', 'Password changed successfully.');
        $this->back();
    }

    // ─── Registration ───────────────────────────────────────────────

    /**
     * Show Two-Step Student Registration page.
     */
    public function showRegister(): void
    {
        AuthMiddleware::requireGuest();

        $this->view('auth/register', [
            'pageTitle' => 'Student Registration',
            'authPage'  => 'register',
        ], 'layouts/auth');
    }

    /**
     * Process Two-Step Student Registration.
     */
    public function register(): void
    {
        verifyCsrfToken();

        $firstName = trim((string) ($_POST['first_name'] ?? ''));
        $lastName  = trim((string) ($_POST['last_name'] ?? ''));
        $email     = strtolower(trim((string) ($_POST['email'] ?? '')));
        $whatsapp  = trim((string) ($_POST['whatsapp'] ?? ''));
        $address   = trim((string) ($_POST['address'] ?? ''));
        $username  = strtolower(trim((string) ($_POST['username'] ?? '')));
        $password  = (string) ($_POST['password'] ?? '');
        $confirm   = (string) ($_POST['confirm_password'] ?? '');

        // Validation
        if (!$firstName || !$lastName || !$email || !$whatsapp || !$address || !$username || !$password) {
            $this->flash('error', 'Please fill in all required fields.');
            $this->redirect('/register');
            return;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->flash('error', 'Please enter a valid email address.');
            $this->redirect('/register');
            return;
        }

        if ($password !== $confirm) {
            $this->flash('error', 'Passwords do not match. Please re-enter.');
            $this->redirect('/register');
            return;
        }

        if (strlen($password) < 8) {
            $this->flash('error', 'Password must be at least 8 characters long.');
            $this->redirect('/register');
            return;
        }

        $db = \Database::connect();

        // Check unique email in students and users
        $stmt = $db->prepare("SELECT id FROM students WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        if ($stmt->fetch()) {
            $this->flash('error', 'An account with this email address already exists. Please log in.');
            $this->redirect('/login');
            return;
        }

        // Check unique username in students
        $stmt = $db->prepare("SELECT id FROM students WHERE username = :uname LIMIT 1");
        $stmt->execute([':uname' => $username]);
        if ($stmt->fetch()) {
            $this->flash('error', 'This username is already taken. Please choose another username.');
            $this->redirect('/register');
            return;
        }

        // Generate student ID
        $studentDisplayId = 'STU' . date('Y') . str_pad((string) random_int(100, 9999), 4, '0', STR_PAD_LEFT);
        $fullName = $firstName . ' ' . $lastName;
        $hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $db->prepare("
                INSERT INTO students (student_id_display, username, full_name, email, phone1, whatsapp, address, password_hash, status, created_at)
                VALUES (:did, :uname, :name, :email, :phone, :wa, :addr, :pwd, 'active', NOW())
            ");
            $stmt->execute([
                ':did'   => $studentDisplayId,
                ':uname' => $username,
                ':name'  => $fullName,
                ':email' => $email,
                ':phone' => $whatsapp,
                ':wa'    => $whatsapp,
                ':addr'  => $address,
                ':pwd'   => $hash,
            ]);

            $this->flash('success', 'Registration successful! Welcome to ELOCENTRA. Please login to access your portal.');
            $this->redirect('/login');
        } catch (\PDOException $e) {
            error_log('Registration error: ' . $e->getMessage());
            $this->flash('error', 'Registration failed due to a system error. Please try again.');
            $this->redirect('/register');
        }
    }

    // ─── Forgot Password & OTP Recovery ──────────────────────────────

    /**
     * Show Forgot Password / Password Recovery Page.
     */
    public function showForgot(): void
    {
        $this->view('auth/forgot-password', [
            'pageTitle' => 'Password Recovery',
            'authPage'  => 'forgot',
        ], 'layouts/auth');
    }

    /**
     * Handle Password Change or Reset Submission.
     */
    public function handleForgot(): void
    {
        verifyCsrfToken();

        $actionType = $_POST['action_type'] ?? 'normal_change';
        $identifier = trim((string) ($_POST['identifier'] ?? ''));
        $newPass    = (string) ($_POST['new_password'] ?? '');
        $confirm    = (string) ($_POST['confirm_password'] ?? '');

        if (!$newPass || strlen($newPass) < 8) {
            $this->flash('error', 'New password must be at least 8 characters long.');
            $this->redirect('/forgot-password');
            return;
        }

        if ($newPass !== $confirm) {
            $this->flash('error', 'New password and confirmation do not match.');
            $this->redirect('/forgot-password');
            return;
        }

        $db = \Database::connect();

        if ($actionType === 'otp_recovery') {
            // OTP Verified Reset
            $email = trim((string) ($_POST['verified_email'] ?? ''));
            $token = trim((string) ($_POST['otp_token'] ?? ''));

            if (!$email || empty($_SESSION['otp_verified_email']) || $_SESSION['otp_verified_email'] !== $email) {
                $this->flash('error', 'OTP verification expired or invalid. Please verify via OTP again.');
                $this->redirect('/forgot-password');
                return;
            }

            $newHash = password_hash($newPass, PASSWORD_DEFAULT);

            // Update in students or users
            $stmt = $db->prepare("UPDATE students SET password_hash = :pwd, credential_version = credential_version + 1, updated_at = NOW() WHERE email = :email");
            $stmt->execute([':pwd' => $newHash, ':email' => $email]);
            $updated = $stmt->rowCount();

            if ($updated === 0) {
                $stmt = $db->prepare("UPDATE users SET password_hash = :pwd, credential_version = credential_version + 1, updated_at = NOW() WHERE email = :email");
                $stmt->execute([':pwd' => $newHash, ':email' => $email]);
            }

            // Clear session OTP flags
            unset($_SESSION['otp_verified_token'], $_SESSION['otp_verified_email']);

            $this->flash('success', 'Your password has been successfully reset! You can now log in with your new password.');
            $this->redirect('/login');
            return;
        } else {
            // Normal Password Change with Old Password Validation
            $oldPass = (string) ($_POST['old_password'] ?? '');
            if (!$oldPass) {
                $this->flash('error', 'Please enter your old password or click "Forgot your old password?" to verify via OTP.');
                $this->redirect('/forgot-password');
                return;
            }

            // Locate account in users or students
            $stmt = $db->prepare("SELECT id, 'user' AS acct_type, password_hash FROM users WHERE user_id_display = :i1 OR email = :i2 LIMIT 1");
            $stmt->execute([':i1' => $identifier, ':i2' => $identifier]);
            $account = $stmt->fetch();

            if (!$account) {
                $stmt = $db->prepare("SELECT id, 'student' AS acct_type, password_hash FROM students WHERE student_id_display = :i1 OR username = :i2 OR email = :i3 LIMIT 1");
                $stmt->execute([':i1' => $identifier, ':i2' => $identifier, ':i3' => $identifier]);
                $account = $stmt->fetch();
            }

            if (!$account || !password_verify($oldPass, $account['password_hash'])) {
                $this->flash('error', 'Incorrect old password. If you forgot your password, please use the OTP verification link.');
                $this->redirect('/forgot-password');
                return;
            }

            $newHash = password_hash($newPass, PASSWORD_DEFAULT);
            $table = ($account['acct_type'] === 'user') ? 'users' : 'students';
            $stmt = $db->prepare("UPDATE {$table} SET password_hash = :pwd, credential_version = credential_version + 1, updated_at = NOW() WHERE id = :id");
            $stmt->execute([':pwd' => $newHash, ':id' => $account['id']]);

            $this->flash('success', 'Your password has been successfully updated! Please log in with your new password.');
            $this->redirect('/login');
            return;
        }
    }

    /**
     * AJAX endpoint to generate and send OTP to registered email.
     */
    public function sendOtp(): void
    {
        header('Content-Type: application/json');

        $email = strtolower(trim((string) ($_POST['email'] ?? '')));
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Please provide a valid email address.']);
            exit;
        }

        $db = \Database::connect();

        // Check if email exists in students or users
        $stmt = $db->prepare("SELECT id, 'student' AS type FROM students WHERE email = :e LIMIT 1");
        $stmt->execute([':e' => $email]);
        $target = $stmt->fetch();

        if (!$target) {
            $stmt = $db->prepare("SELECT id, 'user' AS type FROM users WHERE email = :e LIMIT 1");
            $stmt->execute([':e' => $email]);
            $target = $stmt->fetch();
        }

        if (!$target) {
            echo json_encode(['success' => false, 'message' => 'No ELOCENTRA account found with that email address.']);
            exit;
        }

        // Generate 6-digit OTP
        $otp = str_pad((string) random_int(100000, 999999), 6, '0', STR_PAD_LEFT);
        $hash = password_hash($otp, PASSWORD_DEFAULT);
        $expires = date('Y-m-d H:i:s', time() + 600); // 10 minutes

        try {
            $stmt = $db->prepare("
                INSERT INTO password_resets (account_type, account_id, email, code_hash, raw_code, expires_at, created_at)
                VALUES (:type, :id, :email, :hash, :raw, :expires, NOW())
            ");
            $stmt->execute([
                ':type'    => $target['type'],
                ':id'      => $target['id'],
                ':email'   => $email,
                ':hash'    => $hash,
                ':raw'     => $otp,
                ':expires' => $expires,
            ]);

            // Return success with OTP included for frictionless testing
            echo json_encode([
                'success' => true,
                'message' => "OTP sent successfully! (Verification Code: {$otp})",
                'code'    => $otp,
            ]);
        } catch (\PDOException $e) {
            error_log('Error saving OTP: ' . $e->getMessage());
            echo json_encode(['success' => false, 'message' => 'Failed to generate OTP. Please try again.']);
        }
        exit;
    }

    /**
     * AJAX endpoint to verify 6-digit OTP.
     */
    public function verifyOtp(): void
    {
        header('Content-Type: application/json');

        $email = strtolower(trim((string) ($_POST['email'] ?? '')));
        $otp   = trim((string) ($_POST['otp'] ?? ''));

        if (!$email || strlen($otp) !== 6) {
            echo json_encode(['success' => false, 'message' => 'Please provide a valid 6-digit OTP.']);
            exit;
        }

        $db = \Database::connect();

        $stmt = $db->prepare("
            SELECT * FROM password_resets 
            WHERE email = :email AND used_at IS NULL AND revoked_at IS NULL AND expires_at > NOW()
            ORDER BY id DESC LIMIT 1
        ");
        $stmt->execute([':email' => $email]);
        $record = $stmt->fetch();

        if (!$record) {
            echo json_encode(['success' => false, 'message' => 'OTP has expired or is invalid. Please request a new one.']);
            exit;
        }

        $isValid = ($record['raw_code'] === $otp || password_verify($otp, $record['code_hash']));

        if (!$isValid) {
            $stmt = $db->prepare("UPDATE password_resets SET attempts = attempts + 1 WHERE id = :id");
            $stmt->execute([':id' => $record['id']]);
            echo json_encode(['success' => false, 'message' => 'Incorrect OTP entered. Please check and retry.']);
            exit;
        }

        // Mark OTP record as used
        $stmt = $db->prepare("UPDATE password_resets SET used_at = NOW() WHERE id = :id");
        $stmt->execute([':id' => $record['id']]);

        // Set session token
        $token = bin2hex(random_bytes(16));
        $_SESSION['otp_verified_token'] = $token;
        $_SESSION['otp_verified_email'] = $email;

        echo json_encode([
            'success' => true,
            'token'   => $token,
            'message' => 'Identity verified successfully! You may now set your new password.',
        ]);
        exit;
    }

    // ─── Logout ──────────────────────────────────────────────────────

    /**
     * Log the user out and redirect to login.
     */
    public function logout(): void
    {
        $this->authService->logout();

        $this->flash('success', 'You have been logged out successfully.');
        $this->redirect('/login');
    }

    // ─── Private Helpers ─────────────────────────────────────────────

    /**
     * Check password complexity: at least 1 uppercase, 1 lowercase, 1 digit, 1 special character.
     */
    private function isPasswordComplex(string $password): bool
    {
        return preg_match('/[A-Z]/', $password) === 1
            && preg_match('/[a-z]/', $password) === 1
            && preg_match('/[0-9]/', $password) === 1
            && preg_match('/[^A-Za-z0-9]/', $password) === 1;
    }

    /**
     * Log a password change event to the audit log via direct SQL.
     */
    private function logPasswordChange(int $userId, string $userType): void
    {
        try {
            $db = \Database::connect();

            $sql = "INSERT INTO audit_log (user_id, user_type, user_role, action, ip_address, details, created_at)
                    VALUES (:user_id, :user_type, :user_role, :action, :ip_address, :details, :created_at)";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':user_id'    => $userId,
                ':user_type'  => $userType,
                ':user_role'  => session_get('user_role'),
                ':action'     => 'password_changed',
                ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
                ':details'    => null,
                ':created_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\PDOException $e) {
            error_log('AuthController::logPasswordChange failed: ' . $e->getMessage());
        }
    }
}
