<?php
session_start();
require '../server/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email || !$password) {
        echo "<p style='color:red;'>Please fill in all fields.</p>";
        echo "<p>Redirecting back to login...</p>";
        header("refresh:2; url=../public/login.php");
        exit;
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "<p style='color:red;'>User does not exist. Redirecting to Register...</p>";
        header("refresh:2; url=../public/register.php");
        exit;
    }

    if (!password_verify($password, $user['password'])) {
        echo "<p style='color:red;'>Invalid password. Try again.</p>";
        header("refresh:2; url=../public/login.php");
        exit;
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];

    $role = strtolower(trim($user['role']));
    if ($role === 'admin') {
        header("Location: ../server/admin_dashboard.php");
    } else {
        header("Location: ../public/cars.php"); 
    }
    exit;
} else {
    header("Location: ../public/login.php");
    exit;
}
?>
