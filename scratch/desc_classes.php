<?php
$pdo = new PDO('mysql:host=127.0.0.1;dbname=student_lms', 'root', '');
$cols = $pdo->query('DESCRIBE classes')->fetchAll(PDO::FETCH_COLUMN);
print_r($cols);
