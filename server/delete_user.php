<?php
session_start();
require 'config.php';

// Sigurohu që është admin
if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    die("Access denied.");
}

// Merr id e përdoruesit
$id = intval($_GET['id']);

// Mos lejo adminët të fshihen vetë ose të fshihen adminët e tjerë
$stmt = $conn->prepare("SELECT role FROM users WHERE id=?");
$stmt->execute([$id]);
$user = $stmt->fetch();
if (!$user) die("User not found");
if ($user['role'] === 'admin') die("Cannot delete admin users.");

// Fshi përdoruesin
$stmt = $conn->prepare("DELETE FROM users WHERE id=?");
$stmt->execute([$id]);

header("Location: admin_dashboard.php");
exit;
