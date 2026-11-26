<?php
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';

try {
    $db = Database::connect();
    $rows = $db->query("SELECT * FROM homepage_banners")->fetchAll(PDO::FETCH_ASSOC);
    echo "Found " . count($rows) . " rows in homepage_banners:\n";
    print_r($rows);
} catch (Exception $e) {
    echo "DB error: " . $e->getMessage() . "\n";
}
