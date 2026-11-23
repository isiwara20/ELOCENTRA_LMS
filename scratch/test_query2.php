<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=student_lms', 'root', '');
$sql = "
    SELECT c.*, sa.name AS subject_area_name, COALESCE(rp.name, u.full_name) AS teacher_name, rp.title AS teacher_title
    FROM `classes` c
    LEFT JOIN `subject_areas` sa ON sa.id = c.subject_area_id
    LEFT JOIN `resource_persons` rp ON rp.id = c.teacher_id OR rp.user_id = c.teacher_id
    LEFT JOIN `users` u ON u.id = c.teacher_id
    WHERE c.status = 'active'
    AND (c.class_name LIKE :search OR c.description LIKE :search OR c.subject LIKE :search)
";
$stmt = $pdo->prepare($sql);
$stmt->execute([':search' => '%English%']);
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "Count: " . count($res) . "\n";
foreach ($res as $r) {
    echo "ID: " . $r['id'] . " Name: " . $r['class_name'] . "\n";
}
