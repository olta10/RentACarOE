<?php
session_start();
require 'config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    die("Access denied.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM contacts WHERE id=?");
$stmt->execute([$id]);
$contact = $stmt->fetch();
if (!$contact) die("Message not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    $stmt = $conn->prepare("UPDATE contacts SET name=?, email=?, message=? WHERE id=?");
    $stmt->execute([$name, $email, $message, $id]);

    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Contact Message</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 0; }
        .container { max-width: 500px; margin: 50px auto; padding: 20px; background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        h1 { text-align: center; margin-bottom: 20px; }
        form { display: flex; flex-direction: column; gap: 15px; }
        label { font-weight: bold; }
        input, textarea { padding: 10px; border-radius: 5px; border: 1px solid #ccc; width: 100%; }
        textarea { resize: vertical; height: 100px; }
        button { background: #e74c3c; color: #fff; border: none; padding: 12px; border-radius: 5px; cursor: pointer; font-size: 16px; }
        button:hover { background: #c0392b; }
        a.back-btn { display: inline-block; margin-top: 10px; text-decoration: none; color: #3498db; }
        a.back-btn:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Contact</h1>
    <form method="post">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($contact['name']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required>

        <label>Message:</label>
        <textarea name="message" required><?= htmlspecialchars($contact['message']) ?></textarea>

        <button type="submit">Update Message</button>
    </form>
    <a href="admin_dashboard.php" class="back-btn">← Back to Dashboard</a>
</div>
</body>
</html>
