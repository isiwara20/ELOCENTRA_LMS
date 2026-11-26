<?php
$envPath = __DIR__ . '/../.env';
$env = [];
if (file_exists($envPath)) {
    foreach (file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $l) {
        if (strpos($l, '=') !== false && !str_starts_with(trim($l), '#')) {
            [$k, $v] = explode('=', $l, 2);
            $env[trim($k)] = trim($v, " \t\n\r\0\x0B\"'");
        }
    }
}

$host = $env['DB_HOST'] ?? '127.0.0.1';
$port = $env['DB_PORT'] ?? 3306;
$db   = $env['DB_NAME'] ?? 'student_lms';
$user = $env['DB_USER'] ?? 'root';
$pass = $env['DB_PASS'] ?? '';

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

    $updates = [
        'academy_name' => 'ELOCENTRA – English Academy (PVT) LTD',
        'academy_slogan' => 'Learn English. Speak Confidently. Succeed Globally.',
        'academy_email' => 'eloengaca@gmail.com',
        'academy_phone' => '077 7354892',
        'academy_whatsapp' => '077 2278069',
        'academy_address' => '',
        'academy_office_hours' => 'Monday - Saturday: 8.30 AM - 6.00 PM',
        'academy_vision' => 'To become a trusted and internationally recognised English academy that empowers learners to communicate confidently and succeed globally.',
        'academy_mission' => 'To provide accessible, practical and high-quality English education through modern online teaching methods, qualified guidance and learner-centred programmes that develop speaking, listening, reading, writing, grammar and professional communication skills.',
        'academy_main_goal' => 'To help every learner overcome language barriers and use English confidently in education, employment, business, leadership and everyday life.',
        'academy_supporting_goals' => json_encode([
            'Provide affordable and accessible online English classes.',
            'Develop learners\' confidence in spoken and written English.',
            'Serve schoolchildren, university students, employees, professionals and businesspeople.',
            'Offer beginner, intermediate and advanced learning pathways.',
            'Provide English for interviews, employment, business, presentations and public speaking.',
            'Use technology to reach learners throughout Sri Lanka and overseas.',
            'Maintain high teaching standards and measurable learning outcomes.',
            'Build Elocentra into a respected international education brand.'
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE)
    ];

    $stmt = $pdo->prepare("INSERT INTO system_settings (setting_key, setting_value) VALUES (:k, :v) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
    foreach ($updates as $k => $v) {
        $stmt->execute(['k' => $k, 'v' => $v]);
    }
    echo "DATABASE SYSTEM SETTINGS UPDATED SUCCESSFULLY!\n";

    // Also update banner images in database if banners table exists
    $chk = $pdo->query("SHOW TABLES LIKE 'homepage_banners'")->fetchAll();
    if (!empty($chk)) {
        $banners = [
            [1, 'Learn English. Speak Confidently. Succeed Globally.', 'A modern learning platform to build your language, communication, and professional skills for an international future.', '/assets/img/slider/banner1.jpg', 'Explore Courses', '/courses', 1],
            [2, 'Empower Your Global Career With Expert Mentors', 'Master business presentations, speech craft, professional writing, and interview excellence guided by seasoned academics.', '/assets/img/slider/banner2.jpg', 'Join Now', '/register', 2],
            [3, 'World-Class Online Learning With Modern Methods', 'Interactive virtual classrooms, practical language simulations, and comprehensive curriculum from foundational to advanced levels.', '/assets/img/slider/banner3.jpg', 'View Academic Disciplines', '/courses', 3],
            [4, 'Multidisciplinary Programs for Well-Rounded Leaders', 'Expand your competence with foundational Psychology, Business Accounting, and corporate leadership communication.', '/assets/img/slider/banner4.jpg', 'Register as a Student', '/register', 4],
        ];
        $bStmt = $pdo->prepare("INSERT INTO homepage_banners (id, title, subtitle, image_url, button_text, button_link, sort_order) VALUES (?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE title = VALUES(title), subtitle = VALUES(subtitle), image_url = VALUES(image_url), button_text = VALUES(button_text), button_link = VALUES(button_link), sort_order = VALUES(sort_order)");
        foreach ($banners as $b) {
            $bStmt->execute($b);
        }
        echo "HOMEPAGE BANNERS TABLE UPDATED SUCCESSFULLY!\n";
    }

} catch (PDOException $e) {
    echo "DB NOTE: " . $e->getMessage() . "\n";
}
