<?php
session_start();
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        $_SESSION['error'] = "Please fill in all fields.";
        header("Location: ../public/login.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['error'] = "User does not exist. Please register.";
        header("Location: ../public/register.php");
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        $_SESSION['error'] = "Invalid password. Try again.";
        header("Location: ../public/login.php");
        exit;
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    $role = strtolower(trim($user['role']));
    if ($role === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: ../public/cars.php"); 
    }
    exit;
} else {
    header("Location: ../public/login.php");
    exit;
}
?>
