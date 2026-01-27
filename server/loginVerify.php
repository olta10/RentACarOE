<?php
session_start();

require 'config.php';
require 'classes/Validator.php';
require 'classes/User.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: ../public/login.php");
    exit;
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (
    !Validator::required($email) ||
    !Validator::email($email) ||
    !Validator::required($password) ||
    !Validator::minLength($password, 6)
) {
    header("Location: ../public/login.php?error=1");
    exit;
}

$userModel = new User($conn);
$user = $userModel->login($email, $password);

if (!$user) {
    header("Location: ../public/login.php?error=1");
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['role'] = $user['role'];

// ✅ REDIRECT SIPAS ROLIT
if (strtolower($user['role']) === 'admin') {
    header("Location: admin_dashboard.php");
} else {
    header("Location: ../public/index.php");
}
exit;
