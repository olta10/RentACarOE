<?php
session_start();
require 'config.php';

// Kontroll admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user || $user['role'] !== 'admin') die("Access denied.");

// Merr porositë
$stmt = $conn->query("SELECT * FROM orders ORDER BY id DESC");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>All Orders</h2>
<table border="1">
<tr><th>ID</th><th>User ID</th><th>Service / Car</th><th>Quantity</th><th>Preferences</th><th>Created At</th></tr>
<?php foreach($orders as $o): ?>
<tr>
<td><?= $o['id'] ?></td>
<td><?= $o['user_id'] ?></td>
<td><?= htmlspecialchars($o['service_name']) ?></td>
<td><?= $o['quantity'] ?></td>
<td><?= htmlspecialchars($o['preferences']) ?></td>
<td><?= $o['created_at'] ?></td>
</tr>
<?php endforeach; ?>
</table>
