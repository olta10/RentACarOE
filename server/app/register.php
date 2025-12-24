<?php
session_start();
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullname = trim($_POST['fullname'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    if (!$fullname || !$email || !$password || !$confirmPassword) {
        die("Please fill all fields!");
    }

    if ($password !== $confirmPassword) {
        die("Passwords do not match!");
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    if ($stmt->fetch()) {
        die("Email already exists!");
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (emri, email, password, is_admin) VALUES (:fullname, :email, :password, 0)");
    $stmt->execute([
        ':fullname' => $fullname,
        ':email' => $email,
        ':password' => $hashedPassword
    ]);

    header("Location: ../../public/login.php");
    exit;
}
?>
