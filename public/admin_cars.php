<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    echo "Access denied. You will be redirected in 2 seconds.";
    header("Refresh:2; url=./login.php");
    exit;
}

$stmt = $conn->query("SELECT * FROM cars ORDER BY created_at DESC");
$cars = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Cars</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>Cars Management</h1>
<a href="add_car.php">Add New Car</a>
<table border="1" cellpadding="10">
<tr>
    <th>ID</th>
    <th>Title</th>
    <th>Price/Day</th>
    <th>Image</th>
    <th>Action</th>
</tr>
<?php foreach($cars as $car): ?>
<tr>
    <td><?= $car['id'] ?></td>
    <td><?= htmlspecialchars($car['title']) ?></td>
    <td><?= $car['price_per_day'] ?> €</td>
    <td><img src="../uploads/<?= $car['image'] ?>" width="100"></td>
    <td>
        <a href="edit_car.php?id=<?= $car['id'] ?>">Edit</a> | 
        <a href="delete_car.php?id=<?= $car['id'] ?>" onclick="return confirm('Delete this car?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>
</body>
</html>
