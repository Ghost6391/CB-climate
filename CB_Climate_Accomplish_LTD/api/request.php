<?php
require __DIR__ . '/../config/db.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header('Location: ../'); exit; }

$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$email = trim($_POST['email'] ?? '');
$address = trim($_POST['address'] ?? '');
$service = (int)($_POST['service_id'] ?? 0);
$problem = trim($_POST['problem'] ?? '');

if (!$name || !$phone || !$service || !$problem) die('Please complete all required fields.');

$stmt = $pdo->prepare("SELECT id FROM customers WHERE phone=? LIMIT 1");
$stmt->execute([$phone]);
$customer = $stmt->fetch();

if ($customer) {
    $customerId = $customer['id'];
    $pdo->prepare("UPDATE customers SET name=?,email=?,address=? WHERE id=?")
        ->execute([$name,$email,$address,$customerId]);
} else {
    $pdo->prepare("INSERT INTO customers(name,phone,email,address) VALUES(?,?,?,?)")
        ->execute([$name,$phone,$email,$address]);
    $customerId = $pdo->lastInsertId();
}

$pdo->prepare("INSERT INTO jobs(customer_id,service_id,problem) VALUES(?,?,?)")
    ->execute([$customerId,$service,$problem]);

header('Location: ../?success=1#contact');
exit;
?>
