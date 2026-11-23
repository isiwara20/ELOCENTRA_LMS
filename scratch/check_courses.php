<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=student_lms', 'root', '');
$rows = $pdo->query('SELECT id, class_name, subject, status FROM classes')->fetchAll(PDO::FETCH_ASSOC);
print_r($rows);
