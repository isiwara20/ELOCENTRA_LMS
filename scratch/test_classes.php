<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/lang.php';

try {
    $db = Database::connect();
    $rows = $db->query("SELECT id, class_name, subject, class_code, monthly_fee, cover_image FROM classes LIMIT 10")->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);
} catch (Exception $e) {
    echo "DB error: " . $e->getMessage();
}
