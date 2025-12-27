<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("You must login first");
}

$user_id = $_SESSION['user_id'];
$service_name = $_POST['service_name'] ?? null;
$quantity = $_POST['quantity'] ?? 1;
$preferences = $_POST['preferences'] ?? '';

if (!$service_name) {
    die("Service Name missing");
}

$stmt = $conn->prepare("
    SELECT id FROM orders 
    WHERE user_id = ? AND service_name = ? 
    AND preferences = ? 
    AND created_at > DATE_SUB(NOW(), INTERVAL 1 MINUTE)
");
$stmt->execute([$user_id, $service_name, $preferences]);
$existing = $stmt->fetch(PDO::FETCH_ASSOC);

if ($existing) {
    header("Location: ../public/services.php?error=duplicate");
    exit;
}

$sql = "INSERT INTO orders (user_id, service_name, quantity, preferences, created_at)
        VALUES (:user_id, :service_name, :quantity, :preferences, NOW())";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':user_id'      => $user_id,
    ':service_name' => $service_name,
    ':quantity'     => $quantity,
    ':preferences'  => $preferences
]);

header("Location: ../public/services.php?success=1");
exit;
?>
