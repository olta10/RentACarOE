<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['role']) || strtolower($_SESSION['role']) !== 'admin') {
    echo "Access denied. You will be redirected in 2 seconds.";
    header("Refresh:2; url=./login.php");
    exit;
}

$id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$id]);
$car = $stmt->fetch();

if (!$car) die("Car not found");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $price = floatval($_POST['price']);
    $description = trim($_POST['description']);
    $image = $car['image'];

    if (!empty($_FILES['image']['name'])) {
        $image = time().'_'.$_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$image);
    }

    $stmt = $conn->prepare("UPDATE cars SET title=?, description=?, price_per_day=?, image=?, created_by=? WHERE id=?");
    $stmt->execute([$title, $description, $price, $image, $_SESSION['name'], $id]);

    header("Location: admin_cars.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Car</title>
</head>
<body>
<h1>Edit Car</h1>
<form method="post" enctype="multipart/form-data">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($car['title']) ?>" required><br>
    <label>Price per Day:</label><br>
    <input type="number" name="price" value="<?= $car['price_per_day'] ?>" step="0.01" required><br>
    <label>Description:</label><br>
    <textarea name="description" required><?= htmlspecialchars($car['description']) ?></textarea><br>
    <label>Image:</label><br>
    <input type="file" name="image" accept="image/*"><br>
    <img src="../uploads/<?= $car['image'] ?>" width="100"><br><br>
    <button type="submit">Update Car</button>
</form>
</body>
</html>
