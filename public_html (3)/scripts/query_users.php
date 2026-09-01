<?php
$path = __DIR__ . '/../database/database.sqlite';
if (!file_exists($path)) { echo "NO_DB\n"; exit(0); }
$pdo = new PDO('sqlite:' . $path);
$stmt = $pdo->query('SELECT id,email,user_type,is_active FROM users LIMIT 1');
$row = $stmt ? $stmt->fetch(PDO::FETCH_ASSOC) : null;
var_export($row);
