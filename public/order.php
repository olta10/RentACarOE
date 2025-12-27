<?php
session_start();
require '../server/config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$car_id = intval($_GET['car_id'] ?? 0);
if($car_id <= 0) die("Invalid car ID");

$stmt = $conn->prepare("SELECT * FROM cars WHERE id = :id");
$stmt->execute([':id'=>$car_id]);
$car = $stmt->fetch();

if(!$car) die("Car not found");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $preferences = $_POST['preferences'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 1);
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO orders (user_id, car_id, quantity, preferences) VALUES (:user_id, :car_id, :quantity, :preferences)");
    $stmt->execute([
        ':user_id' => $user_id,
        ':car_id' => $car_id,
        ':quantity' => $quantity,
        ':preferences' => $preferences
    ]);

    header("Location: cars.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Order Car</title>
<link rel="stylesheet" href="css/index.css">
</head>
<body>

<div class="container">
    <h1>Order <?= htmlspecialchars($car['name']) ?></h1>

    <form method="post">
        <label>Quantity:</label>
        <input type="number" name="quantity" value="1" min="1" required><br><br>

        <label>Preferences / Notes:</label><br>
        <textarea name="preferences" rows="4" cols="50" placeholder="E.g., color, GPS, child seat"></textarea><br><br>

        <button type="submit" class="order-btn">Place Order</button>
    </form>
</div>

</body>
</html>
