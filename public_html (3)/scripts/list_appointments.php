<?php
$path = __DIR__ . '/../database/database.sqlite';
if (!file_exists($path)) { echo "NO_DB\n"; exit(0); }
$pdo = new PDO('sqlite:' . $path);
$stmt = $pdo->query('SELECT id, customer_name, customer_phone, status FROM appointments ORDER BY id DESC LIMIT 10');
$rows = $stmt ? $stmt->fetchAll(PDO::FETCH_ASSOC) : [];
var_export($rows);
