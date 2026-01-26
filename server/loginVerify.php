<?php
session_start();
require_once "classes/User.php";

$email    = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$userObj = new User();
$user = $userObj->login($email, $password);

if (!$user) {
    header("Location: ../public/login.php?error=invalid");
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['role']    = $user['role'];
$_SESSION['name']    = $user['fullname'];

if ($user['role'] === 'admin') {
    header("Location: admin_dashboard.php");
    exit;
}

header("Location: ../public/index.php");
exit;
