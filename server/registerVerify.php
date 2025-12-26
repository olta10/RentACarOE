<?php
require_once 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../../client/register.php");
    exit;
}

$name = trim($_POST['fullname']);
$email = trim($_POST['email']);
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if (empty($name) || empty($email) || empty($password)) {
    echo "All fields are required";
    header("refresh:3;url=../../client/register.php");
    exit;
}

if ($password !== $confirmPassword) {
    echo "Passwords do not match";
    header("refresh:3;url=../../client/register.php");
    exit;
}

$stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
$stmt->execute([$email]);

if ($stmt->rowCount() > 0) {
    echo "Email already exists, please try another one.";
    header("refresh:2;url=../public/register.php");
    exit;
}

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$role = 'user';

$insert = $conn->prepare(
    "INSERT INTO users (name, email, password, role)
     VALUES (?, ?, ?, ?)"
);

$insert->execute([
    $name,
    $email,
    $hashedPassword,
    $role
]);

echo "Registration successful! Redirecting to login...";
header("refresh:2;url=../public/login.php");
exit;
