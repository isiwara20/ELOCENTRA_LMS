<?php
/**
 * Test View Rendering
 */
define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/ELOCENTRA_LMS');

// Mock helpers
function csrfMeta() { return '<meta name="csrf-token" content="mock">'; }
function csrfField() { return '<input type="hidden" name="csrf_token" value="mock">'; }
function te($s) { return htmlspecialchars($s); }
function lang_date($fmt, $ts) { return date($fmt, is_numeric($ts) ? (int)$ts : strtotime($ts)); }

// Test rendering home.php
$settings = [
    'academy_slogan' => 'Learn English. Speak Confidently. Succeed Globally.',
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
    ])
];
$subjectAreas = [];
$courses = [];
$resourcePersons = [];

ob_start();
include BASE_PATH . '/app/Views/public/home.php';
$homeHtml = ob_get_clean();
echo "home.php rendered: " . strlen($homeHtml) . " bytes\n";

ob_start();
include BASE_PATH . '/app/Views/public/about.php';
$aboutHtml = ob_get_clean();
echo "about.php rendered: " . strlen($aboutHtml) . " bytes\n";

ob_start();
include BASE_PATH . '/app/Views/public/contact.php';
$contactHtml = ob_get_clean();
echo "contact.php rendered: " . strlen($contactHtml) . " bytes\n";

ob_start();
$currentSubject = null;
$currentSearch = '';
include BASE_PATH . '/app/Views/public/courses.php';
$coursesHtml = ob_get_clean();
echo "courses.php rendered: " . strlen($coursesHtml) . " bytes\n";

echo "ALL PUBLIC VIEWS RENDERED CLEANLY!\n";
