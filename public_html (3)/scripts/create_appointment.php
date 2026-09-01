<?php
$path = __DIR__ . '/../database/database.sqlite';
$pdo = new PDO('sqlite:' . $path);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$tomorrow = (new DateTime('+1 day'))->format('Y-m-d');
$sth = $pdo->prepare('INSERT INTO appointments (service_id, service_name, service_price, vehicle_make_model, registration_number, appointment_date, appointment_time, customer_name, customer_email, customer_phone, service_reason, preferred_contact_method, additional_issues, status, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, datetime("now"), datetime("now"))');
$sth->execute([1, 'Test Service', 100.00, 'Test Car', 'TEST-1234', $tomorrow, '10:00 AM', 'John Browser', 'john@example.com', '9999999999', 'Routine', 'phone', 'None', 'pending']);
echo "CREATED\n";
