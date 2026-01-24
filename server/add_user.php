<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("You must login first");
}

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user || $user['role'] !== 'admin') {
    die("Access denied");
}

$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$role     = $_POST['role'] ?? 'user';

if (!$username || !$email || !$password) {
    die("Please fill all required fields");
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO users (name, email, password, role, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->execute([$username, $email, $hashedPassword, $role]);

header("Location: ../public/users.php?success=1");
exit;
?>
