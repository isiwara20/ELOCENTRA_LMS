<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Middleware\AuthMiddleware;

class ElocentraAdminController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        AuthMiddleware::requireAuth();
        AuthMiddleware::requireRole([
            AuthMiddleware::ROLE_SUPER_ADMIN,
            AuthMiddleware::ROLE_ADMIN,
        ]);
    }

    // ─── 1. SUBJECT AREAS MANAGEMENT ──────────────────────────────────

    public function index(): void
    {
        $this->subjectAreas();
    }

    public function subjectAreas(): void
    {
        $subjects = $this->db->query("
            SELECT sa.*, COUNT(c.id) AS course_count
            FROM subject_areas sa
            LEFT JOIN classes c ON c.subject_area_id = sa.id
            GROUP BY sa.id
            ORDER BY sa.sort_order ASC, sa.id ASC
        ")->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/elocentra/subject-areas', [
            'pageTitle'     => 'Subject Areas Management',
            'activePage'    => 'subject_areas',
            'activeSubPage' => 'subject_areas',
            'subjects'      => $subjects,
        ], 'layouts/admin');
    }

    public function storeSubjectArea(): void
    {
        verifyCsrfToken();

        $name = trim((string) ($_POST['name'] ?? ''));
        $slug = trim((string) ($_POST['slug'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        if ($name === '') {
            $this->flash('error', 'Subject Area name is required.');
            $this->redirect('/admin/subject-areas');
            return;
        }

        if ($slug === '') {
            $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));
        }

        try {
            $stmt = $this->db->prepare("
                INSERT INTO subject_areas (name, slug, description, sort_order, status, created_at)
                VALUES (:name, :slug, :description, :sort_order, :status, NOW())
            ");
            $stmt->execute([
                ':name'        => $name,
                ':slug'        => $slug,
                ':description' => $description,
                ':sort_order'  => $sortOrder,
                ':status'      => $status,
            ]);

            $this->flash('success', 'Subject Area "' . $name . '" created successfully.');
        } catch (\PDOException $e) {
            $this->flash('error', 'Failed to create Subject Area. Name or slug may already exist.');
        }

        $this->redirect('/admin/subject-areas');
    }

    public function updateSubjectArea(string $id): void
    {
        verifyCsrfToken();
        $subId = (int) $id;

        $name = trim((string) ($_POST['name'] ?? ''));
        $slug = trim((string) ($_POST['slug'] ?? ''));
        $description = trim((string) ($_POST['description'] ?? ''));
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        if ($name === '') {
            $this->flash('error', 'Subject Area name is required.');
            $this->redirect('/admin/subject-areas');
            return;
        }

        try {
            $stmt = $this->db->prepare("
                UPDATE subject_areas 
                SET name = :name, slug = :slug, description = :description, sort_order = :sort_order, status = :status, updated_at = NOW()
                WHERE id = :id
            ");
            $stmt->execute([
                ':name'        => $name,
                ':slug'        => $slug,
                ':description' => $description,
                ':sort_order'  => $sortOrder,
                ':status'      => $status,
                ':id'          => $subId,
            ]);

            $this->flash('success', 'Subject Area updated successfully.');
        } catch (\PDOException $e) {
            $this->flash('error', 'Failed to update Subject Area.');
        }

        $this->redirect('/admin/subject-areas');
    }

    public function deleteSubjectArea(string $id): void
    {
        verifyCsrfToken();
        $subId = (int) $id;

        $this->db->prepare("DELETE FROM subject_areas WHERE id = :id")->execute([':id' => $subId]);
        $this->flash('success', 'Subject Area deleted.');
        $this->redirect('/admin/subject-areas');
    }

    // ─── 2. RESOURCE PERSONS / TEACHERS MANAGEMENT ─────────────────────

    public function resourcePersons(): void
    {
        $teachers = $this->db->query("
            SELECT rp.*, sa.name AS subject_area_name
            FROM resource_persons rp
            LEFT JOIN subject_areas sa ON sa.id = rp.subject_area_id
            ORDER BY rp.sort_order ASC, rp.id ASC
        ")->fetchAll(\PDO::FETCH_ASSOC);

        $subjectAreas = $this->db->query("SELECT id, name FROM subject_areas WHERE status = 'active' ORDER BY name ASC")->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/elocentra/resource-persons', [
            'pageTitle'     => 'Resource Persons / Teachers Management',
            'activePage'    => 'resource_persons',
            'activeSubPage' => 'resource_persons',
            'teachers'      => $teachers,
            'subjectAreas'  => $subjectAreas,
        ], 'layouts/admin');
    }

    public function storeResourcePerson(): void
    {
        verifyCsrfToken();

        $name = trim((string) ($_POST['name'] ?? ''));
        $title = trim((string) ($_POST['title'] ?? ''));
        $qualifications = trim((string) ($_POST['qualifications'] ?? ''));
        $subjectAreaId = !empty($_POST['subject_area_id']) ? (int) $_POST['subject_area_id'] : null;
        $bio = trim((string) ($_POST['bio'] ?? ''));
        $email = trim((string) ($_POST['email'] ?? ''));
        $phone = trim((string) ($_POST['phone'] ?? ''));
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        if ($name === '' || $title === '') {
            $this->flash('error', 'Name and Title are required.');
            $this->redirect('/admin/resource-persons');
            return;
        }

        $photoPath = '/assets/img/teachers/senaka.jpg';
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = BASE_PATH . '/public/uploads/profiles';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            $safeName = 'teacher_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . '/' . $safeName)) {
                $photoPath = '/uploads/profiles/' . $safeName;
            }
        }

        $stmt = $this->db->prepare("
            INSERT INTO resource_persons (name, title, qualifications, subject_area_id, bio, email, phone, photo, sort_order, status, created_at)
            VALUES (:name, :title, :qualifications, :sa, :bio, :email, :phone, :photo, :sort_order, :status, NOW())
        ");
        $stmt->execute([
            ':name'           => $name,
            ':title'          => $title,
            ':qualifications' => $qualifications,
            ':sa'             => $subjectAreaId,
            ':bio'            => $bio,
            ':email'          => $email,
            ':phone'          => $phone,
            ':photo'          => $photoPath,
            ':sort_order'     => $sortOrder,
            ':status'         => $status,
        ]);

        $this->flash('success', 'Resource Person "' . $name . '" added successfully. Homepage updated automatically.');
        $this->redirect('/admin/resource-persons');
    }

    public function updateResourcePerson(string $id): void
    {
        verifyCsrfToken();
        $rpId = (int) $id;

        $name = trim((string) ($_POST['name'] ?? ''));
        $title = trim((string) ($_POST['title'] ?? ''));
        $qualifications = trim((string) ($_POST['qualifications'] ?? ''));
        $subjectAreaId = !empty($_POST['subject_area_id']) ? (int) $_POST['subject_area_id'] : null;
        $bio = trim((string) ($_POST['bio'] ?? ''));
        $email = trim((string) ($_POST['email'] ?? ''));
        $phone = trim((string) ($_POST['phone'] ?? ''));
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        if ($name === '' || $title === '') {
            $this->flash('error', 'Name and Title are required.');
            $this->redirect('/admin/resource-persons');
            return;
        }

        // Check if new photo uploaded
        $photoSql = "";
        $params = [
            ':name'           => $name,
            ':title'          => $title,
            ':qualifications' => $qualifications,
            ':sa'             => $subjectAreaId,
            ':bio'            => $bio,
            ':email'          => $email,
            ':phone'          => $phone,
            ':sort_order'     => $sortOrder,
            ':status'         => $status,
            ':id'             => $rpId,
        ];

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = BASE_PATH . '/public/uploads/profiles';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
            $ext = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
            $safeName = 'teacher_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadDir . '/' . $safeName)) {
                $photoSql = ", photo = :photo";
                $params[':photo'] = '/uploads/profiles/' . $safeName;
            }
        }

        $stmt = $this->db->prepare("
            UPDATE resource_persons 
            SET name = :name, title = :title, qualifications = :qualifications, subject_area_id = :sa, 
                bio = :bio, email = :email, phone = :phone, sort_order = :sort_order, status = :status, updated_at = NOW() {$photoSql}
            WHERE id = :id
        ");
        $stmt->execute($params);

        $this->flash('success', 'Resource Person details updated successfully. Homepage updated automatically.');
        $this->redirect('/admin/resource-persons');
    }

    public function deleteResourcePerson(string $id): void
    {
        verifyCsrfToken();
        $rpId = (int) $id;

        $this->db->prepare("DELETE FROM resource_persons WHERE id = :id")->execute([':id' => $rpId]);
        $this->flash('success', 'Resource Person removed.');
        $this->redirect('/admin/resource-persons');
    }

    // ─── 3. COURSES MANAGEMENT (REPLACES CLASSES) ─────────────────────

    public function courses(): void
    {
        $courses = $this->db->query("
            SELECT c.*, sa.name AS subject_area_name, COALESCE(rp.name, u.full_name) AS teacher_name,
                   (SELECT COUNT(*) FROM enrollments e WHERE e.class_id = c.id AND e.enrollment_status = 'active') AS student_count
            FROM classes c
            LEFT JOIN subject_areas sa ON sa.id = c.subject_area_id
            LEFT JOIN resource_persons rp ON rp.id = c.teacher_id OR rp.user_id = c.teacher_id
            LEFT JOIN users u ON u.id = c.teacher_id
            ORDER BY c.is_featured DESC, c.id DESC
        ")->fetchAll(\PDO::FETCH_ASSOC);

        $subjectAreas = $this->db->query("SELECT id, name FROM subject_areas WHERE status = 'active' ORDER BY name ASC")->fetchAll(\PDO::FETCH_ASSOC);
        $teachers = $this->db->query("SELECT id, name, title FROM resource_persons WHERE status = 'active' ORDER BY name ASC")->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/elocentra/courses', [
            'pageTitle'     => 'Courses Management',
            'activePage'    => 'courses',
            'activeSubPage' => 'courses',
            'courses'       => $courses,
            'subjectAreas'  => $subjectAreas,
            'teachers'      => $teachers,
        ], 'layouts/admin');
    }

    public function storeCourse(): void
    {
        verifyCsrfToken();

        $name = trim((string) ($_POST['class_name'] ?? ''));
        $courseCode = trim((string) ($_POST['course_code'] ?? ''));
        $subjectAreaId = !empty($_POST['subject_area_id']) ? (int) $_POST['subject_area_id'] : null;
        $teacherId = !empty($_POST['teacher_id']) ? (int) $_POST['teacher_id'] : null;
        $duration = trim((string) ($_POST['duration_weeks'] ?? '12 Weeks'));
        $level = in_array($_POST['course_level'] ?? '', ['Beginner', 'Intermediate', 'Advanced'], true) ? $_POST['course_level'] : 'Intermediate';
        $mode = in_array($_POST['delivery_mode'] ?? '', ['online', 'physical', 'hybrid'], true) ? $_POST['delivery_mode'] : 'online';
        $fee = (float) ($_POST['price'] ?? 0);
        $description = trim((string) ($_POST['description'] ?? ''));
        $hasCert = !empty($_POST['has_certificate']) ? 1 : 0;
        $isFeatured = !empty($_POST['is_featured']) ? 1 : 0;
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        if ($name === '') {
            $this->flash('error', 'Course title is required.');
            $this->redirect('/admin/courses');
            return;
        }

        $subjectName = 'English & Communication';
        if ($subjectAreaId) {
            $stmt = $this->db->prepare("SELECT name FROM subject_areas WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $subjectAreaId]);
            $subjectName = $stmt->fetchColumn() ?: 'General';
        }

        $thumb = '/assets/img/courses/english-global.jpg';
        if (isset($_FILES['course_thumbnail']) && $_FILES['course_thumbnail']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = BASE_PATH . '/public/uploads/courses';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
            $ext = strtolower(pathinfo($_FILES['course_thumbnail']['name'], PATHINFO_EXTENSION));
            $safeName = 'course_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
            if (move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], $uploadDir . '/' . $safeName)) {
                $thumb = '/uploads/courses/' . $safeName;
            }
        }

        $stmt = $this->db->prepare("
            INSERT INTO classes (course_code, class_name, subject, subject_area_id, institute_id, teacher_id, delivery_mode, duration_weeks, course_level, has_certificate, monthly_fee, price, description, course_thumbnail, is_featured, status, created_at)
            VALUES (:code, :name, :subj, :said, 1, :tid, :mode, :duration, :lvl, :cert, :fee, :fee, :desc, :thumb, :feat, :status, NOW())
        ");
        $stmt->execute([
            ':code'     => $courseCode ?: 'CRS-' . rand(100, 999),
            ':name'     => $name,
            ':subj'     => $subjectName,
            ':said'     => $subjectAreaId,
            ':tid'      => $teacherId,
            ':mode'     => $mode,
            ':duration' => $duration,
            ':lvl'      => $level,
            ':cert'     => $hasCert,
            ':fee'      => $fee,
            ':desc'     => $description,
            ':thumb'    => $thumb,
            ':feat'     => $isFeatured,
            ':status'   => $status,
        ]);

        $this->flash('success', 'Course "' . $name . '" created successfully.');
        $this->redirect('/admin/courses');
    }

    public function updateCourse(string $id): void
    {
        verifyCsrfToken();
        $courseId = (int) $id;

        $name = trim((string) ($_POST['class_name'] ?? ''));
        $courseCode = trim((string) ($_POST['course_code'] ?? ''));
        $subjectAreaId = !empty($_POST['subject_area_id']) ? (int) $_POST['subject_area_id'] : null;
        $teacherId = !empty($_POST['teacher_id']) ? (int) $_POST['teacher_id'] : null;
        $duration = trim((string) ($_POST['duration_weeks'] ?? '12 Weeks'));
        $level = in_array($_POST['course_level'] ?? '', ['Beginner', 'Intermediate', 'Advanced'], true) ? $_POST['course_level'] : 'Intermediate';
        $mode = in_array($_POST['delivery_mode'] ?? '', ['online', 'physical', 'hybrid'], true) ? $_POST['delivery_mode'] : 'online';
        $fee = (float) ($_POST['price'] ?? 0);
        $description = trim((string) ($_POST['description'] ?? ''));
        $hasCert = !empty($_POST['has_certificate']) ? 1 : 0;
        $isFeatured = !empty($_POST['is_featured']) ? 1 : 0;
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        $subjectName = 'English & Communication';
        if ($subjectAreaId) {
            $stmt = $this->db->prepare("SELECT name FROM subject_areas WHERE id = :id LIMIT 1");
            $stmt->execute([':id' => $subjectAreaId]);
            $subjectName = $stmt->fetchColumn() ?: 'General';
        }

        $thumbSql = "";
        $params = [
            ':code'     => $courseCode,
            ':name'     => $name,
            ':subj'     => $subjectName,
            ':said'     => $subjectAreaId,
            ':tid'      => $teacherId,
            ':mode'     => $mode,
            ':duration' => $duration,
            ':lvl'      => $level,
            ':cert'     => $hasCert,
            ':fee'      => $fee,
            ':desc'     => $description,
            ':feat'     => $isFeatured,
            ':status'   => $status,
            ':id'       => $courseId,
        ];

        if (isset($_FILES['course_thumbnail']) && $_FILES['course_thumbnail']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = BASE_PATH . '/public/uploads/courses';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
            $ext = strtolower(pathinfo($_FILES['course_thumbnail']['name'], PATHINFO_EXTENSION));
            $safeName = 'course_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
            if (move_uploaded_file($_FILES['course_thumbnail']['tmp_name'], $uploadDir . '/' . $safeName)) {
                $thumbSql = ", course_thumbnail = :thumb";
                $params[':thumb'] = '/uploads/courses/' . $safeName;
            }
        }

        $stmt = $this->db->prepare("
            UPDATE classes 
            SET course_code = :code, class_name = :name, subject = :subj, subject_area_id = :said,
                teacher_id = :tid, delivery_mode = :mode, duration_weeks = :duration, course_level = :lvl,
                has_certificate = :cert, monthly_fee = :fee, price = :fee, description = :desc,
                is_featured = :feat, status = :status, updated_at = NOW() {$thumbSql}
            WHERE id = :id
        ");
        $stmt->execute($params);

        $this->flash('success', 'Course details updated successfully.');
        $this->redirect('/admin/courses');
    }

    public function deleteCourse(string $id): void
    {
        verifyCsrfToken();
        $courseId = (int) $id;

        $this->db->prepare("UPDATE classes SET status = 'inactive' WHERE id = :id")->execute([':id' => $courseId]);
        $this->flash('success', 'Course marked as inactive.');
        $this->redirect('/admin/courses');
    }

    // ─── 4. BANK TRANSFER VERIFICATION ────────────────────────────────

    public function bankTransfers(): void
    {
        $orders = $this->db->query("
            SELECT co.*, s.full_name AS student_name, s.email AS student_email, s.whatsapp AS student_whatsapp,
                   c.class_name AS course_name, c.price AS course_price
            FROM course_orders co
            JOIN students s ON s.id = co.student_id
            JOIN classes c ON c.id = co.course_id
            WHERE co.payment_method = 'bank_transfer'
            ORDER BY (co.payment_status = 'pending') DESC, co.id DESC
        ")->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/elocentra/bank-transfers', [
            'pageTitle'     => 'Bank Transfer Verification',
            'activePage'    => 'bank_transfers',
            'activeSubPage' => 'bank_transfers',
            'orders'        => $orders,
        ], 'layouts/admin');
    }

    public function approveBankTransfer(string $id): void
    {
        verifyCsrfToken();
        $orderId = (int) $id;

        $stmt = $this->db->prepare("SELECT * FROM course_orders WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $orderId]);
        $order = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$order) {
            $this->flash('error', 'Order not found.');
            $this->redirect('/admin/bank-transfers');
            return;
        }

        $reviewerId = (int) session_get('user_id');

        // 1. Mark order approved/paid
        $stmt = $this->db->prepare("
            UPDATE course_orders 
            SET payment_status = 'approved', reviewed_by = :uid, reviewed_at = NOW(), updated_at = NOW()
            WHERE id = :id
        ");
        $stmt->execute([':uid' => $reviewerId, ':id' => $orderId]);

        // 2. Create or activate enrollment
        $stmt = $this->db->prepare("
            INSERT INTO enrollments (student_id, class_id, scholarship_type, enrollment_status, enrolled_at)
            VALUES (:stu, :cid, 'full_payment', 'active', NOW())
            ON DUPLICATE KEY UPDATE enrollment_status = 'active'
        ");
        $stmt->execute([':stu' => $order['student_id'], ':cid' => $order['course_id']]);

        $enrollmentId = (int) $this->db->lastInsertId();
        if (!$enrollmentId) {
            $stmt = $this->db->prepare("SELECT id FROM enrollments WHERE student_id = :stu AND class_id = :cid LIMIT 1");
            $stmt->execute([':stu' => $order['student_id'], ':cid' => $order['course_id']]);
            $enrollmentId = (int) $stmt->fetchColumn();
        }

        // 3. Mark payment record paid
        $stmt = $this->db->prepare("
            INSERT INTO payments (enrollment_id, student_id, class_id, month_year, amount_due, amount_paid, payment_status, paid_at, marked_by, notes, created_at)
            VALUES (:eid, :stu, :cid, CURDATE(), :due, :paid, 'paid', NOW(), :uid, :note, NOW())
        ");
        $stmt->execute([
            ':eid'  => $enrollmentId,
            ':stu'  => $order['student_id'],
            ':cid'  => $order['course_id'],
            ':due'  => $order['amount'],
            ':paid' => $order['amount'],
            ':uid'  => $reviewerId,
            ':note' => 'Bank Transfer Approved (Order #' . $order['order_number'] . ')',
        ]);

        $this->flash('success', 'Bank transfer approved! Student enrollment is now active.');
        $this->redirect('/admin/bank-transfers');
    }

    public function rejectBankTransfer(string $id): void
    {
        verifyCsrfToken();
        $orderId = (int) $id;
        $reason = trim((string) ($_POST['reason'] ?? 'Invalid slip or deposit unverified'));
        $reviewerId = (int) session_get('user_id');

        $stmt = $this->db->prepare("
            UPDATE course_orders 
            SET payment_status = 'rejected', review_notes = :reason, reviewed_by = :uid, reviewed_at = NOW(), updated_at = NOW()
            WHERE id = :id
        ");
        $stmt->execute([':reason' => $reason, ':uid' => $reviewerId, ':id' => $orderId]);

        $this->flash('success', 'Bank transfer order marked as rejected.');
        $this->redirect('/admin/bank-transfers');
    }

    // ─── 5. DIRECTPAY PAYMENT GATEWAY CONFIGURATION ───────────────────

    public function directPay(): void
    {
        $config = $this->db->query("SELECT * FROM directpay_config LIMIT 1")->fetch(\PDO::FETCH_ASSOC);
        if (!$config) {
            $this->db->query("INSERT INTO directpay_config (merchant_id, is_enabled) VALUES ('DP_ELOCENTRA', 1)");
            $config = $this->db->query("SELECT * FROM directpay_config LIMIT 1")->fetch(\PDO::FETCH_ASSOC);
        }

        $this->view('admin/elocentra/directpay', [
            'pageTitle'     => 'DirectPay Gateway Configuration',
            'activePage'    => 'directpay',
            'activeSubPage' => 'directpay',
            'config'        => $config,
        ], 'layouts/admin');
    }

    public function updateDirectPay(): void
    {
        verifyCsrfToken();

        $merchantId = trim((string) ($_POST['merchant_id'] ?? ''));
        $apiKey = trim((string) ($_POST['api_key'] ?? ''));
        $secretKey = trim((string) ($_POST['secret_key'] ?? ''));
        $env = in_array($_POST['environment'] ?? '', ['sandbox', 'production'], true) ? $_POST['environment'] : 'sandbox';
        $currency = trim((string) ($_POST['currency'] ?? 'LKR'));
        $isEnabled = !empty($_POST['is_enabled']) ? 1 : 0;

        $stmt = $this->db->prepare("
            UPDATE directpay_config
            SET merchant_id = :mid, api_key = :akey, secret_key = :skey, environment = :env, currency = :curr, is_enabled = :enabled, updated_at = NOW()
            WHERE id = 1
        ");
        $stmt->execute([
            ':mid'     => $merchantId,
            ':akey'    => $apiKey,
            ':skey'    => $secretKey,
            ':env'     => $env,
            ':curr'    => $currency,
            ':enabled' => $isEnabled,
        ]);

        $this->flash('success', 'DirectPay gateway configuration updated successfully.');
        $this->redirect('/admin/directpay');
    }

    // ─── 6. BANK ACCOUNT DETAILS MANAGEMENT ───────────────────────────

    public function bankAccounts(): void
    {
        $accounts = $this->db->query("SELECT * FROM bank_accounts ORDER BY sort_order ASC, id ASC")->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/elocentra/bank-accounts', [
            'pageTitle'     => 'Academy Bank Accounts',
            'activePage'    => 'bank_accounts',
            'activeSubPage' => 'bank_accounts',
            'accounts'      => $accounts,
        ], 'layouts/admin');
    }

    public function storeBankAccount(): void
    {
        verifyCsrfToken();

        $bankName = trim((string) ($_POST['bank_name'] ?? ''));
        $branch = trim((string) ($_POST['branch_name'] ?? ''));
        $accountName = trim((string) ($_POST['account_name'] ?? ''));
        $accountNumber = trim((string) ($_POST['account_number'] ?? ''));
        $swift = trim((string) ($_POST['swift_code'] ?? ''));
        $instructions = trim((string) ($_POST['instructions'] ?? ''));
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        if (!$bankName || !$accountNumber || !$accountName) {
            $this->flash('error', 'Bank Name, Account Name, and Account Number are required.');
            $this->redirect('/admin/bank-accounts');
            return;
        }

        $stmt = $this->db->prepare("
            INSERT INTO bank_accounts (bank_name, branch_name, account_name, account_number, swift_code, instructions, status, created_at)
            VALUES (:bname, :branch, :aname, :anum, :swift, :inst, :status, NOW())
        ");
        $stmt->execute([
            ':bname'  => $bankName,
            ':branch' => $branch,
            ':aname'  => $accountName,
            ':anum'   => $accountNumber,
            ':swift'  => $swift,
            ':inst'   => $instructions,
            ':status' => $status,
        ]);

        $this->flash('success', 'Bank account added successfully.');
        $this->redirect('/admin/bank-accounts');
    }

    public function updateBankAccount(string $id): void
    {
        verifyCsrfToken();
        $accId = (int) $id;

        $bankName = trim((string) ($_POST['bank_name'] ?? ''));
        $branch = trim((string) ($_POST['branch_name'] ?? ''));
        $accountName = trim((string) ($_POST['account_name'] ?? ''));
        $accountNumber = trim((string) ($_POST['account_number'] ?? ''));
        $swift = trim((string) ($_POST['swift_code'] ?? ''));
        $instructions = trim((string) ($_POST['instructions'] ?? ''));
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        $stmt = $this->db->prepare("
            UPDATE bank_accounts
            SET bank_name = :bname, branch_name = :branch, account_name = :aname, account_number = :anum,
                swift_code = :swift, instructions = :inst, status = :status, updated_at = NOW()
            WHERE id = :id
        ");
        $stmt->execute([
            ':bname'  => $bankName,
            ':branch' => $branch,
            ':aname'  => $accountName,
            ':anum'   => $accountNumber,
            ':swift'  => $swift,
            ':inst'   => $instructions,
            ':status' => $status,
            ':id'     => $accId,
        ]);

        $this->flash('success', 'Bank account details updated successfully.');
        $this->redirect('/admin/bank-accounts');
    }

    public function deleteBankAccount(string $id): void
    {
        verifyCsrfToken();
        $accId = (int) $id;

        $this->db->prepare("DELETE FROM bank_accounts WHERE id = :id")->execute([':id' => $accId]);
        $this->flash('success', 'Bank account removed.');
        $this->redirect('/admin/bank-accounts');
    }

    // ─── 7. ACADEMY INFORMATION SETTINGS ──────────────────────────────

    public function academySettings(): void
    {
        $rows = $this->db->query("SELECT setting_key, setting_value FROM system_settings")->fetchAll(\PDO::FETCH_KEY_PAIR);

        $this->view('admin/elocentra/academy-settings', [
            'pageTitle'     => 'Academy Information Settings',
            'activePage'    => 'academy_settings',
            'activeSubPage' => 'academy_settings',
            'settings'      => $rows ?: [],
        ], 'layouts/admin');
    }

    public function updateAcademySettings(): void
    {
        verifyCsrfToken();

        $keys = [
            'academy_name', 'academy_slogan', 'academy_email', 'academy_phone',
            'academy_whatsapp', 'academy_address', 'academy_office_hours',
            'academy_vision', 'academy_mission', 'academy_main_goal'
        ];

        $stmt = $this->db->prepare("
            INSERT INTO system_settings (setting_key, setting_value, updated_at)
            VALUES (:k, :v, NOW())
            ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value), updated_at = NOW()
        ");

        foreach ($keys as $k) {
            if (isset($_POST[$k])) {
                $stmt->execute([':k' => $k, ':v' => trim((string) $_POST[$k])]);
            }
        }

        // Supporting goals array
        if (!empty($_POST['supporting_goals']) && is_array($_POST['supporting_goals'])) {
            $goals = array_values(array_filter(array_map('trim', $_POST['supporting_goals'])));
            $stmt->execute([':k' => 'academy_supporting_goals', ':v' => json_encode($goals)]);
        }

        $this->flash('success', 'Academy details and branding updated successfully. All public pages now reflect the updated content.');
        $this->redirect('/admin/academy-settings');
    }

    // ─── 8. HOMEPAGE BANNER SLIDER MANAGEMENT ─────────────────────────

    public function banners(): void
    {
        $banners = $this->db->query("SELECT * FROM homepage_banners ORDER BY sort_order ASC, id ASC")->fetchAll(\PDO::FETCH_ASSOC);

        $this->view('admin/elocentra/banners', [
            'pageTitle'     => 'Homepage Banner Slider Management',
            'activePage'    => 'banners',
            'activeSubPage' => 'banners',
            'banners'       => $banners,
        ], 'layouts/admin');
    }

    public function storeBanner(): void
    {
        verifyCsrfToken();

        $title = trim((string) ($_POST['title'] ?? ''));
        $subtitle = trim((string) ($_POST['subtitle'] ?? ''));
        $badgeText = trim((string) ($_POST['badge_text'] ?? 'ELOCENTRA – English Academy (PVT) LTD'));
        $ctaText = trim((string) ($_POST['cta_text'] ?? 'Explore Courses'));
        $ctaUrl = trim((string) ($_POST['cta_url'] ?? '/courses'));
        $secondaryCtaText = trim((string) ($_POST['secondary_cta_text'] ?? 'Join Now'));
        $secondaryCtaUrl = trim((string) ($_POST['secondary_cta_url'] ?? '/register'));
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        $imagePath = '/assets/img/slider/banner1.jpg';
        if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = BASE_PATH . '/public/uploads/slider';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
            $ext = strtolower(pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION));
            $safeName = 'slide_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
            if (move_uploaded_file($_FILES['banner_image']['tmp_name'], $uploadDir . '/' . $safeName)) {
                $imagePath = '/uploads/slider/' . $safeName;
            }
        }

        $stmt = $this->db->prepare("
            INSERT INTO homepage_banners (title, subtitle, image_path, badge_text, cta_text, cta_url, secondary_cta_text, secondary_cta_url, sort_order, status, created_at)
            VALUES (:title, :sub, :img, :badge, :cta_t, :cta_u, :s_cta_t, :s_cta_u, :sort, :status, NOW())
        ");
        $stmt->execute([
            ':title'   => $title,
            ':sub'     => $subtitle,
            ':img'     => $imagePath,
            ':badge'   => $badgeText,
            ':cta_t'   => $ctaText,
            ':cta_u'   => $ctaUrl,
            ':s_cta_t' => $secondaryCtaText,
            ':s_cta_u' => $secondaryCtaUrl,
            ':sort'    => $sortOrder,
            ':status'  => $status,
        ]);

        $this->flash('success', 'New homepage banner slide added successfully.');
        $this->redirect('/admin/banners');
    }

    public function updateBanner(string $id): void
    {
        verifyCsrfToken();
        $bannerId = (int) $id;

        $title = trim((string) ($_POST['title'] ?? ''));
        $subtitle = trim((string) ($_POST['subtitle'] ?? ''));
        $badgeText = trim((string) ($_POST['badge_text'] ?? 'ELOCENTRA – English Academy (PVT) LTD'));
        $ctaText = trim((string) ($_POST['cta_text'] ?? 'Explore Courses'));
        $ctaUrl = trim((string) ($_POST['cta_url'] ?? '/courses'));
        $secondaryCtaText = trim((string) ($_POST['secondary_cta_text'] ?? 'Join Now'));
        $secondaryCtaUrl = trim((string) ($_POST['secondary_cta_url'] ?? '/register'));
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);
        $status = in_array($_POST['status'] ?? '', ['active', 'inactive'], true) ? $_POST['status'] : 'active';

        $imgSql = "";
        $params = [
            ':title'   => $title,
            ':sub'     => $subtitle,
            ':badge'   => $badgeText,
            ':cta_t'   => $ctaText,
            ':cta_u'   => $ctaUrl,
            ':s_cta_t' => $secondaryCtaText,
            ':s_cta_u' => $secondaryCtaUrl,
            ':sort'    => $sortOrder,
            ':status'  => $status,
            ':id'      => $bannerId,
        ];

        if (isset($_FILES['banner_image']) && $_FILES['banner_image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = BASE_PATH . '/public/uploads/slider';
            if (!is_dir($uploadDir)) @mkdir($uploadDir, 0777, true);
            $ext = strtolower(pathinfo($_FILES['banner_image']['name'], PATHINFO_EXTENSION));
            $safeName = 'slide_' . date('Ymd_His') . '_' . bin2hex(random_bytes(3)) . '.' . $ext;
            if (move_uploaded_file($_FILES['banner_image']['tmp_name'], $uploadDir . '/' . $safeName)) {
                $imgSql = ", image_path = :img";
                $params[':img'] = '/uploads/slider/' . $safeName;
            }
        }

        $stmt = $this->db->prepare("
            UPDATE homepage_banners
            SET title = :title, subtitle = :sub, badge_text = :badge, cta_text = :cta_t, cta_url = :cta_u,
                secondary_cta_text = :s_cta_t, secondary_cta_url = :s_cta_u, sort_order = :sort, status = :status, updated_at = NOW() {$imgSql}
            WHERE id = :id
        ");
        $stmt->execute($params);

        $this->flash('success', 'Homepage banner slide updated successfully.');
        $this->redirect('/admin/banners');
    }

    public function deleteBanner(string $id): void
    {
        verifyCsrfToken();
        $bannerId = (int) $id;

        $this->db->prepare("DELETE FROM homepage_banners WHERE id = :id")->execute([':id' => $bannerId]);
        $this->flash('success', 'Banner slide removed.');
        $this->redirect('/admin/banners');
    }
}
