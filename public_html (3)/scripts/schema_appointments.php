<?php
$path = __DIR__ . '/../database/database.sqlite';
$pdo = new PDO('sqlite:' . $path);
$stmt = $pdo->query("PRAGMA table_info('appointments')");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_export($rows);
