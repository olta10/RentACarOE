<?php
session_start();
require 'config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    die("Access denied.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT role FROM users WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) die("User not found");
if ($user['role'] === 'admin') die("Cannot delete admin users.");

$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->execute([$id]);

header("Location: admin_dashboard.php");
exit;
