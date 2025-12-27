<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    echo "Access denied. You will be redirected in 2 seconds.";
    header("Refresh:2; url=./login.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("DELETE FROM cars WHERE id=?");
$stmt->execute([$id]);

header("Location: admin_cars.php");
exit;
