<?php

declare(strict_types=1);

namespace App\Controllers;

class PublicController extends BaseController
{
    /**
     * Homepage specifically designed for ELOCENTRA – English Academy (PVT) LTD
     */
    public function home(): void
    {
        $banners = $this->getActiveBanners();
        $subjectAreas = $this->getActiveSubjectAreas();
        $courses = $this->getFeaturedCourses();
        $resourcePersons = $this->getActiveResourcePersons();
        $settings = $this->getSystemSettings();

        $this->view('public/home', [
            'pageTitle'        => 'ELOCENTRA – English Academy (PVT) LTD | Learn English. Speak Confidently. Succeed Globally.',
            'metaDescription'  => 'Premier English and professional academy in Sri Lanka. Learn English, speak confidently, and succeed globally with university-level courses.',
            'activePage'       => 'home',
            'banners'          => $banners,
            'subjectAreas'     => $subjectAreas,
            'courses'          => $courses,
            'resourcePersons'  => $resourcePersons,
            'settings'         => $settings,
        ], 'layouts/public');
    }

    /**
     * Dedicated About Us page
     */
    public function about(): void
    {
        $settings = $this->getSystemSettings();
        $resourcePersons = $this->getActiveResourcePersons();

        $this->view('public/about', [
            'pageTitle'        => 'About Us | ELOCENTRA – English Academy (PVT) LTD',
            'metaDescription'  => 'Learn about ELOCENTRA, our vision, mission, goals, and academic methodology.',
            'activePage'       => 'about',
            'settings'         => $settings,
            'resourcePersons'  => $resourcePersons,
        ], 'layouts/public');
    }

    /**
     * Courses Catalog page (replaces legacy Classes)
     */
    public function courses(): void
    {
        $search = trim((string) ($_GET['search'] ?? $_GET['q'] ?? ''));
        $subjectAreaId = !empty($_GET['subject_area']) ? (int) $_GET['subject_area'] : null;

        $subjectAreas = $this->getActiveSubjectAreas();
        $courses = $this->getFilteredCourses($search, $subjectAreaId);

        $this->view('public/courses', [
            'pageTitle'        => 'Our Courses | ELOCENTRA – English Academy (PVT) LTD',
            'metaDescription'  => 'Explore professional English, Psychology, and Business Accounting courses at ELOCENTRA.',
            'activePage'       => 'courses',
            'subjectAreas'     => $subjectAreas,
            'courses'          => $courses,
            'currentSearch'    => $search,
            'currentSubject'   => $subjectAreaId,
        ], 'layouts/public');
    }

    /**
     * Single Course Detail page
     */
    public function courseDetail(string $id): void
    {
        $courseId = (int) $id;
        $course = $this->getCourseById($courseId);

        if (!$course) {
            $this->flash('error', 'Course not found or currently unavailable.');
            $this->redirect('/courses');
            return;
        }

        $bankAccounts = $this->getActiveBankAccounts();
        $directPayConfig = $this->getDirectPayConfig();

        $this->view('public/course-detail', [
            'pageTitle'        => $course['class_name'] . ' | ELOCENTRA Courses',
            'metaDescription'  => htmlspecialchars($course['description'] ?? 'Course at ELOCENTRA Academy', ENT_QUOTES, 'UTF-8'),
            'activePage'       => 'courses',
            'course'           => $course,
            'bankAccounts'     => $bankAccounts,
            'directPayConfig'  => $directPayConfig,
        ], 'layouts/public');
    }

    /**
     * Contact Us page
     */
    public function contact(): void
    {
        $settings = $this->getSystemSettings();

        $this->view('public/contact', [
            'pageTitle'        => 'Contact Us | ELOCENTRA – English Academy (PVT) LTD',
            'metaDescription'  => 'Get in touch with ELOCENTRA – English Academy (PVT) LTD. Colombo campus details, email, phone, and inquiry form.',
            'activePage'       => 'contact',
            'settings'         => $settings,
        ], 'layouts/public');
    }

    /**
     * Submit Contact / Inquiry Message
     */
    public function contactSubmit(): void
    {
        verifyCsrfToken();

        $data = [
            'full_name' => trim((string) ($_POST['name'] ?? $_POST['full_name'] ?? '')),
            'email'     => trim((string) ($_POST['email'] ?? '')),
            'phone'     => trim((string) ($_POST['phone'] ?? '')),
            'subject'   => trim((string) ($_POST['subject'] ?? 'General Inquiry')),
            'message'   => trim((string) ($_POST['message'] ?? '')),
        ];

        if ($data['full_name'] === '' || $data['email'] === '' || $data['message'] === '') {
            $this->flash('error', 'Please fill in your name, email address, and message.');
            $this->redirect('/contact');
            return;
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->flash('error', 'Please provide a valid email address.');
            $this->redirect('/contact');
            return;
        }

        try {
            $stmt = $this->db->prepare("
                INSERT INTO `contact_messages` (`full_name`, `email`, `phone`, `subject`, `message`, `status`, `created_at`)
                VALUES (:full_name, :email, :phone, :subject, :message, 'new', NOW())
            ");
            $stmt->execute([
                ':full_name' => $data['full_name'],
                ':email'     => $data['email'],
                ':phone'     => $data['phone'] ?: null,
                ':subject'   => $data['subject'],
                ':message'   => $data['message'],
            ]);

            $this->flash('success', 'Thank you for reaching out! Our academic counseling team will contact you shortly.');
        } catch (\Throwable $e) {
            error_log('Contact form error: ' . $e->getMessage());
            $this->flash('error', 'An error occurred while sending your message. Please try again.');
        }

        $this->redirect('/contact');
    }

    /**
     * Process Course Enrollment & Payment (DirectPay Card or Bank Transfer Slip)
     */
    public function courseEnroll(string $id): void
    {
        verifyCsrfToken();
        $courseId = (int) $id;
        $course = $this->getCourseById($courseId);

        if (!$course) {
            $this->flash('error', 'Course not found.');
            $this->redirect('/courses');
            return;
        }

        $paymentMethod = $_POST['payment_method'] ?? 'directpay';
        $amount = (float) ($course['price'] ?? $course['monthly_fee'] ?? 0);
        
        // Resolve student: either from session or guest details
        $studentId = null;
        if (function_exists('session_get') && session_get('user_id') && session_get('user_type') === 'student') {
            $studentId = (int) session_get('user_id');
        } else {
            // Guest checkout: create or resolve student account
            $name = trim((string) ($_POST['student_name'] ?? $_POST['full_name'] ?? ''));
            $email = trim((string) ($_POST['student_email'] ?? $_POST['email'] ?? ''));
            $whatsapp = trim((string) ($_POST['student_whatsapp'] ?? $_POST['whatsapp'] ?? ''));
            $address = trim((string) ($_POST['student_address'] ?? $_POST['address'] ?? ''));

            if ($name === '' || $email === '') {
                $this->flash('error', 'Please provide your name and email address to enroll.');
                $this->redirect('/courses/' . $courseId);
                return;
            }

            // Check if student exists by email
            $stmt = $this->db->prepare("SELECT id FROM students WHERE email = :email LIMIT 1");
            $stmt->execute([':email' => $email]);
            $existing = $stmt->fetchColumn();

            if ($existing) {
                $studentId = (int) $existing;
            } else {
                // Auto create student
                $studentDisplayId = 'STU' . date('Y') . str_pad((string) rand(100, 9999), 4, '0', STR_PAD_LEFT);
                $rawUsername = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', strtok($email, '@'))) . rand(10, 99);
                $defaultHash = password_hash('Demo@12345', PASSWORD_DEFAULT);

                $stmt = $this->db->prepare("
                    INSERT INTO students (student_id_display, username, full_name, email, phone1, whatsapp, address, password_hash, status, created_at)
                    VALUES (:did, :uname, :name, :email, :phone, :wa, :addr, :pwd, 'active', NOW())
                ");
                $stmt->execute([
                    ':did'   => $studentDisplayId,
                    ':uname' => $rawUsername,
                    ':name'  => $name,
                    ':email' => $email,
                    ':phone' => $whatsapp,
                    ':wa'    => $whatsapp,
                    ':addr'  => $address,
                    ':pwd'   => $defaultHash,
                ]);
                $studentId = (int) $this->db->lastInsertId();
            }
        }

        $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

        if ($paymentMethod === 'directpay') {
            // DirectPay Card Payment Simulation / Integration
            $txId = 'DP_' . strtoupper(bin2hex(random_bytes(6)));

            $stmt = $this->db->prepare("
                INSERT INTO course_orders (order_number, student_id, course_id, amount, currency, payment_method, payment_status, gateway_transaction_id, created_at)
                VALUES (:ord, :stu, :cid, :amt, 'LKR', 'directpay', 'paid', :tx, NOW())
            ");
            $stmt->execute([
                ':ord' => $orderNumber,
                ':stu' => $studentId,
                ':cid' => $courseId,
                ':amt' => $amount,
                ':tx'  => $txId,
            ]);

            // Create/update enrollment
            $stmt = $this->db->prepare("
                INSERT INTO enrollments (student_id, class_id, scholarship_type, enrollment_status, enrolled_at)
                VALUES (:stu, :cid, 'full_payment', 'active', NOW())
                ON DUPLICATE KEY UPDATE enrollment_status = 'active'
            ");
            $stmt->execute([':stu' => $studentId, ':cid' => $courseId]);

            $enrollmentId = (int) $this->db->lastInsertId();
            if (!$enrollmentId) {
                $stmt = $this->db->prepare("SELECT id FROM enrollments WHERE student_id = :stu AND class_id = :cid LIMIT 1");
                $stmt->execute([':stu' => $studentId, ':cid' => $courseId]);
                $enrollmentId = (int) $stmt->fetchColumn();
            }

            // Create payment record
            $stmt = $this->db->prepare("
                INSERT INTO payments (enrollment_id, student_id, class_id, month_year, amount_due, amount_paid, payment_status, paid_at, notes, created_at)
                VALUES (:eid, :stu, :cid, CURDATE(), :due, :paid, 'paid', NOW(), :note, NOW())
            ");
            $stmt->execute([
                ':eid'  => $enrollmentId,
                ':stu'  => $studentId,
                ':cid'  => $courseId,
                ':due'  => $amount,
                ':paid' => $amount,
                ':note' => 'Paid via DirectPay Card: ' . $txId,
            ]);

            $this->flash('success', 'Payment of LKR ' . number_format($amount, 2) . ' successful via DirectPay! You are officially enrolled in ' . $course['class_name'] . '.');
            $this->redirect('/courses/' . $courseId);
            return;
        } else {
            // Bank Transfer
            $bankRef = trim((string) ($_POST['bank_reference'] ?? ''));
            $slipPath = null;

            if (isset($_FILES['payment_slip']) && $_FILES['payment_slip']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = BASE_PATH . '/public/uploads/slips';
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }
                $ext = strtolower(pathinfo($_FILES['payment_slip']['name'], PATHINFO_EXTENSION));
                $safeName = 'slip_' . date('Ymd_His') . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                $targetFile = $uploadDir . '/' . $safeName;
                if (move_uploaded_file($_FILES['payment_slip']['tmp_name'], $targetFile)) {
                    $slipPath = '/uploads/slips/' . $safeName;
                }
            }

            $stmt = $this->db->prepare("
                INSERT INTO course_orders (order_number, student_id, course_id, amount, currency, payment_method, payment_status, bank_reference, slip_path, created_at)
                VALUES (:ord, :stu, :cid, :amt, 'LKR', 'bank_transfer', 'pending', :ref, :slip, NOW())
            ");
            $stmt->execute([
                ':ord'  => $orderNumber,
                ':stu'  => $studentId,
                ':cid'  => $courseId,
                ':amt'  => $amount,
                ':ref'  => $bankRef ?: null,
                ':slip' => $slipPath,
            ]);

            $this->flash('success', 'Your bank transfer slip has been submitted successfully! Order #' . $orderNumber . ' is pending verification. Our administrative team will verify your payment and activate your course access.');
            $this->redirect('/courses/' . $courseId);
            return;
        }
    }

    // ─── Internal Helper Queries ──────────────────────────────────────

    private function getActiveSubjectAreas(): array
    {
        if (!$this->db) return [];
        try {
            return $this->db->query("
                SELECT sa.*, COUNT(c.id) AS course_count
                FROM `subject_areas` sa
                LEFT JOIN `classes` c ON c.subject_area_id = sa.id AND c.status = 'active'
                WHERE sa.status = 'active'
                GROUP BY sa.id
                ORDER BY sa.sort_order ASC, sa.id ASC
            ")->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            error_log('Error getting subject areas: ' . $e->getMessage());
            return [];
        }
    }

    private function getFeaturedCourses(): array
    {
        if (!$this->db) return [];
        try {
            return $this->db->query("
                SELECT c.*, sa.name AS subject_area_name, COALESCE(rp.name, u.full_name) AS teacher_name, rp.title AS teacher_title
                FROM `classes` c
                LEFT JOIN `subject_areas` sa ON sa.id = c.subject_area_id
                LEFT JOIN `resource_persons` rp ON rp.id = c.teacher_id OR rp.user_id = c.teacher_id
                LEFT JOIN `users` u ON u.id = c.teacher_id
                WHERE c.status = 'active'
                ORDER BY c.is_featured DESC, c.id ASC
                LIMIT 8
            ")->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            error_log('Error getting featured courses: ' . $e->getMessage());
            return [];
        }
    }

    private function getFilteredCourses(string $search = '', ?int $subjectAreaId = null): array
    {
        if (!$this->db) return [];
        try {
            $sql = "
                SELECT c.*, sa.name AS subject_area_name, COALESCE(rp.name, u.full_name) AS teacher_name, rp.title AS teacher_title
                FROM `classes` c
                LEFT JOIN `subject_areas` sa ON sa.id = c.subject_area_id
                LEFT JOIN `resource_persons` rp ON rp.id = c.teacher_id OR rp.user_id = c.teacher_id
                LEFT JOIN `users` u ON u.id = c.teacher_id
                WHERE c.status = 'active'
            ";
            $params = [];

            if ($search !== '') {
                $sql .= " AND (c.class_name LIKE :s1 OR c.description LIKE :s2 OR c.subject LIKE :s3)";
                $params[':s1'] = '%' . $search . '%';
                $params[':s2'] = '%' . $search . '%';
                $params[':s3'] = '%' . $search . '%';
            }

            if ($subjectAreaId !== null && $subjectAreaId > 0) {
                $sql .= " AND c.subject_area_id = :subjectAreaId";
                $params[':subjectAreaId'] = $subjectAreaId;
            }

            $sql .= " ORDER BY c.is_featured DESC, c.id ASC";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            error_log('Error getting filtered courses: ' . $e->getMessage());
            return [];
        }
    }

    private function getCourseById(int $id): ?array
    {
        if (!$this->db) return null;
        try {
            $stmt = $this->db->prepare("
                SELECT c.*, sa.name AS subject_area_name, COALESCE(rp.name, u.full_name) AS teacher_name, 
                       rp.title AS teacher_title, rp.qualifications AS teacher_qualifications, rp.bio AS teacher_bio, rp.photo AS teacher_photo
                FROM `classes` c
                LEFT JOIN `subject_areas` sa ON sa.id = c.subject_area_id
                LEFT JOIN `resource_persons` rp ON rp.id = c.teacher_id OR rp.user_id = c.teacher_id
                LEFT JOIN `users` u ON u.id = c.teacher_id
                WHERE c.id = :id AND c.status = 'active'
                LIMIT 1
            ");
            $stmt->execute([':id' => $id]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res ?: null;
        } catch (\Throwable $e) {
            error_log('Error getting course: ' . $e->getMessage());
            return null;
        }
    }

    private function getActiveResourcePersons(): array
    {
        if (!$this->db) return [];
        try {
            return $this->db->query("
                SELECT * FROM `resource_persons`
                WHERE `status` = 'active'
                ORDER BY `sort_order` ASC, `id` ASC
            ")->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            error_log('Error getting resource persons: ' . $e->getMessage());
            return [];
        }
    }

    private function getActiveBankAccounts(): array
    {
        if (!$this->db) return [];
        try {
            return $this->db->query("
                SELECT * FROM `bank_accounts`
                WHERE `status` = 'active'
                ORDER BY `sort_order` ASC, `id` ASC
            ")->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            error_log('Error getting bank accounts: ' . $e->getMessage());
            return [];
        }
    }

    private function getDirectPayConfig(): ?array
    {
        if (!$this->db) return null;
        try {
            return $this->db->query("SELECT * FROM `directpay_config` LIMIT 1")->fetch(\PDO::FETCH_ASSOC) ?: null;
        } catch (\Throwable $e) {
            return null;
        }
    }

    private function getActiveBanners(): array
    {
        if (!$this->db) return [];
        try {
            return $this->db->query("
                SELECT * FROM `homepage_banners`
                WHERE `status` = 'active'
                ORDER BY `display_order` ASC, `id` ASC
            ")->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\Throwable $e) {
            error_log('Error getting homepage banners: ' . $e->getMessage());
            return [];
        }
    }

    private function getSystemSettings(): array
    {
        if (!$this->db) return [];
        try {
            $rows = $this->db->query("SELECT setting_key, setting_value FROM `system_settings`")->fetchAll(\PDO::FETCH_KEY_PAIR);
            return $rows ?: [];
        } catch (\Throwable $e) {
            return [];
        }
    }
}
