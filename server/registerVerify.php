<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/register.php");
    exit;
}

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirmPassword'] ?? '';

if ($fullname === '' || $email === '' || $password === '' || $confirmPassword === '') {
    header("Location: ../public/register.php?error=empty");
    exit;
}

if ($password !== $confirmPassword) {
    header("Location: ../public/register.php?error=password");
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    header("Location: ../public/register.php?error=exists");
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (fullname, email, password, role)
     VALUES (?, ?, ?, 'user')"
);

$stmt->execute([$fullname, $email, $hashedPassword]);

header("Location: ../public/login.php?success=1");
exit;
