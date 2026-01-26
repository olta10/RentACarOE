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

$stmt = $conn->query("SELECT * FROM cars ORDER BY id DESC");
$cars = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Manage Cars</title>
<style>
body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 20px; }
h2, h3 { text-align: center; }
table { width: 100%; border-collapse: collapse; margin-bottom: 30px; background: #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
th { background-color: #4CAF50; color: #fff; }
tr:nth-child(even) { background-color: #f9f9f9; }
form { max-width: 500px; margin: 0 auto; display: flex; flex-direction: column; gap: 10px; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
input, textarea, button { padding: 10px; border-radius: 4px; border: 1px solid #ccc; }
button { background: #4CAF50; color: #fff; border: none; cursor: pointer; }
button:hover { background: #45a049; }
a { text-decoration: none; color: #3498db; }
a:hover { text-decoration: underline; }
</style>
</head>
<body>

<h2>Manage Cars</h2>

<?php if ($cars): ?>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Created By</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($cars as $c): ?>
    <tr>
        <td><?= htmlspecialchars($c['id']) ?></td>
        <td><?= htmlspecialchars($c['name']) ?></td>
        <td><?= nl2br(htmlspecialchars($c['description'])) ?></td>
        <td><?= htmlspecialchars($c['price']) ?> €</td>
<td><?= htmlspecialchars($car['user_name']) ?></td>
        <td>
            <a href="edit_car.php?id=<?= $c['id'] ?>">Edit</a> | 
            <a href="delete_car.php?id=<?= $c['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p style="text-align:center;">No cars found.</p>
<?php endif; ?>

<h3>Add New Car</h3>
<form method="post" action="add_car.php" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Car Name" required>
    <textarea name="description" placeholder="Description"></textarea>
    <input type="number" name="price" placeholder="Price" required>
    <input type="file" name="media" accept="image/*">
    <button type="submit">Add Car</button>
</form>

</body>
</html>
