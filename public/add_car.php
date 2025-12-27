<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    echo "Access denied. You will be redirected in 2 seconds.";
    header("Refresh:2; url=./login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    
    // Fotoja
    $image = '';
    if (!empty($_FILES['image']['name'])) {
        $image = time() . '_' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$image);
    }

    $stmt = $conn->prepare("INSERT INTO cars (title, description, price_per_day, image, created_by, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->execute([$title, $description, $price, $image, $_SESSION['name']]);

    header("Location: admin_cars.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Car</title>
</head>
<body>
<h1>Add New Car</h1>
<form method="post" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" required><br>
    <label>Price per Day:</label><br>
    <input type="number" name="price" step="0.01" required><br>
    <label>Description:</label><br>
    <textarea name="description" required></textarea><br>
    <label>Image:</label><br>
    <input type="file" name="image" accept="image/*"><br><br>
    <button type="submit">Add Car</button>
</form>
</body>
</html>
