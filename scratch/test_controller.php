<?php
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/app/Core/Database.php';
// wait, where is Database defined? Let's check config/database.php!
require_once BASE_PATH . '/config/database.php';
$db = Database::connect();
$search = 'English';
$sql = "
    SELECT c.*, sa.name AS subject_area_name, COALESCE(rp.name, u.full_name) AS teacher_name, rp.title AS teacher_title
    FROM `classes` c
    LEFT JOIN `subject_areas` sa ON sa.id = c.subject_area_id
    LEFT JOIN `resource_persons` rp ON rp.id = c.teacher_id OR rp.user_id = c.teacher_id
    LEFT JOIN `users` u ON u.id = c.teacher_id
    WHERE c.status = 'active'
    AND (c.class_name LIKE :search OR c.description LIKE :search OR c.subject LIKE :search)
    ORDER BY c.is_featured DESC, c.id ASC
";
$stmt = $db->prepare($sql);
$stmt->execute([':search' => '%' . $search . '%']);
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Fetched courses:\n";
foreach ($courses as $c) {
    echo "- " . $c['class_name'] . "\n";
}
