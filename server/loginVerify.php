<?php
session_start();
require 'config.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['username']; 
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
    $stmt->execute([':email' => $email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        if (strtolower($user['role']) === 'admin') {
            header("Location: ./admin_dashboard.php");
        } else {
            header("Location: ../public/index.php");
        }
        exit;
    } else {
        $error = "Invalid credentials";
        header("Location: ../login.php?error=" . urlencode($error));
        exit;
    }
}
