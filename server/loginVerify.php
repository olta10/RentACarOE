<?php
session_start();

require_once "classes/User.php";
require_once "classes/Validator.php";

$email    = Validator::clean($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($email) || empty($password)) {
    header("Location: ../public/login.php?error=empty");
    exit;
}

if (!Validator::email($email)) {
    header("Location: ../public/login.php?error=email");
    exit;
}

$auth = new User();
$user = $auth->login($email, $password);

if ($user === false) {
    session_unset();
    session_destroy();

    header("Location: ../public/login.php?error=invalid");
    exit;
}

$_SESSION['user_id'] = $user['id'];
$_SESSION['role']    = $user['role'];
$_SESSION['name']    = $user['name'];

if ($user['role'] === 'admin') {
    header("Location: admin_dashboard.php");
    exit;
}

header("Location: ../public/index.php");
exit;
