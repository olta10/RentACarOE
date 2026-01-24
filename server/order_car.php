<?php
session_start();
require 'config.php';

$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    header("Location: ../public/login.php");
    exit;
}

$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || strtolower($user['role']) !== 'admin') {
    die("Access denied.");
}

$stmt = $conn->query("SELECT * FROM orders ORDER BY id DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>All Orders</title>
<style>
    body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 20px; }
    h2 { text-align: center; margin-bottom: 20px; }
    table { width: 100%; border-collapse: collapse; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
    th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
    th { background-color: #4CAF50; color: #fff; }
    tr:nth-child(even) { background-color: #f9f9f9; }
</style>
</head>
<body>

<h2>All Orders</h2>

<?php if ($orders): ?>
<table>
    <tr>
        <th>ID</th>
        <th>User ID</th>
        <th>Service / Car</th>
        <th>Quantity</th>
        <th>Preferences</th>
        <th>Created At</th>
    </tr>
    <?php foreach ($orders as $o): ?>
    <tr>
        <td><?= htmlspecialchars($o['id']) ?></td>
        <td><?= htmlspecialchars($o['user_id']) ?></td>
        <td><?= htmlspecialchars($o['service_name']) ?></td>
        <td><?= htmlspecialchars($o['quantity']) ?></td>
        <td><?= htmlspecialchars($o['preferences']) ?></td>
        <td><?= htmlspecialchars($o['created_at']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center;">No orders found.</p>
<?php endif; ?>

</body>
</html>
