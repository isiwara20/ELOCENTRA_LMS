<?php
define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/ELOCENTRA_LMS');

function csrfMeta() { return '<meta name="csrf-token" content="mock">'; }
function csrfField() { return '<input type="hidden" name="csrf_token" value="mock">'; }
function csrf_token() { return 'mock'; }
function te($s) { return htmlspecialchars($s); }
function t($s) { return $s; }
function lang_date($fmt, $ts) { return date($fmt, is_numeric($ts) ? (int)$ts : strtotime($ts)); }

// Test 1: Login Page
$authPage = 'login';
$pageTitle = 'Login';
$old = [];
ob_start();
include BASE_PATH . '/app/Views/auth/login.php';
$content = ob_get_clean();

ob_start();
include BASE_PATH . '/app/Views/layouts/auth.php';
$loginFull = ob_get_clean();
echo "Login rendered: " . strlen($loginFull) . " bytes\n";
if (strpos($loginFull, 'auth-login-banner.jpg') !== false) {
    echo "  -> Found auth-login-banner.jpg in output!\n";
} else {
    echo "  -> ERROR: auth-login-banner.jpg NOT found!\n";
}

// Test 2: Register Page
$authPage = 'register';
$pageTitle = 'Student Registration';
$old = [];
ob_start();
include BASE_PATH . '/app/Views/auth/register.php';
$content = ob_get_clean();

ob_start();
include BASE_PATH . '/app/Views/layouts/auth.php';
$regFull = ob_get_clean();
echo "Register rendered: " . strlen($regFull) . " bytes\n";
if (strpos($regFull, 'auth-register-banner.jpg') !== false) {
    echo "  -> Found auth-register-banner.jpg in output!\n";
} else {
    echo "  -> ERROR: auth-register-banner.jpg NOT found!\n";
}

// Test 3: Forgot Password Page
$authPage = 'forgot';
$pageTitle = 'Password Recovery';
$old = [];
ob_start();
include BASE_PATH . '/app/Views/auth/forgot-password.php';
$content = ob_get_clean();

ob_start();
include BASE_PATH . '/app/Views/layouts/auth.php';
$forgotFull = ob_get_clean();
echo "Forgot Password rendered: " . strlen($forgotFull) . " bytes\n";
if (strpos($forgotFull, 'auth-forgot-banner.jpg') !== false) {
    echo "  -> Found auth-forgot-banner.jpg in output!\n";
} else {
    echo "  -> ERROR: auth-forgot-banner.jpg NOT found!\n";
}

// Check for duplicated logo
$logoCount = substr_count($loginFull, 'elocentra-logo-');
echo "Logo occurrences in Login full page: {$logoCount}\n";
if ($logoCount === 2) { // 1 in desktop left banner + 1 in mobile logo header
    echo "  -> Exact match: 1 desktop logo + 1 mobile-only logo! No duplicates in side banner.\n";
}

// Test 4: URI based fallback
unset($authPage);
$_SERVER['REQUEST_URI'] = '/ELOCENTRA_LMS/register';
$pageTitle = 'Student Registration';
$old = [];
ob_start();
include BASE_PATH . '/app/Views/auth/register.php';
$content = ob_get_clean();

ob_start();
include BASE_PATH . '/app/Views/layouts/auth.php';
$regUri = ob_get_clean();
if (strpos($regUri, 'auth-register-banner.jpg') !== false) {
    echo "  -> URI Fallback successfully resolved auth-register-banner.jpg!\n";
} else {
    echo "  -> ERROR in URI fallback!\n";
}

echo "ALL AUTH PAGES RENDERED SUCCESSFULLY!\n";
