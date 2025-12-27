<?php
session_start();
require 'config.php';

// Kontroll admin
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT role FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$user || $user['role'] !== 'admin') die("Access denied.");

// Lista e makinave
$stmt = $conn->query("SELECT * FROM cars ORDER BY id DESC");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>Manage Cars</h2>
<table border="1">
<tr><th>ID</th><th>Name</th><th>Description</th><th>Price</th><th>Created By</th><th>Actions</th></tr>
<?php foreach($cars as $c): ?>
<tr>
<td><?= $c['id'] ?></td>
<td><?= htmlspecialchars($c['name']) ?></td>
<td><?= htmlspecialchars($c['description']) ?></td>
<td><?= $c['price'] ?></td>
<td><?= $c['created_by'] ?></td>
<td>
<a href="edit_car.php?id=<?= $c['id'] ?>">Edit</a> | 
<a href="delete_car.php?id=<?= $c['id'] ?>">Delete</a>
</td>
</tr>
<?php endforeach; ?>
</table>

<h3>Add New Car</h3>
<form method="post" action="add_car.php" enctype="multipart/form-data">
<input type="text" name="name" placeholder="Car Name" required>
<textarea name="description" placeholder="Description"></textarea>
<input type="number" name="price" placeholder="Price" required>
<input type="file" name="media">
<button type="submit">Add Car</button>
</form>
