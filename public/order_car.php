<?php
session_start();
require '../server/config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

if (!isset($_GET['car_id'])) {
    die("Car ID missing");
}

$car_id = intval($_GET['car_id']);

$stmt = $conn->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$car_id]);
$car = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$car) {
    die("Car not found");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Car</title>
</head>
<body>

<h2>Order: <?= htmlspecialchars($car['service_name']) ?></h2>

<form method="post" action="../server/save_order.php">
    <input type="hidden" name="car_id" value="<?= $car['id'] ?>">

    <label>Quantity:</label>
    <input type="number" name="quantity" min="1" value="1" required>

    <label>Preferences:</label>
    <textarea name="preferences" placeholder="Shkruaj preferencat..."></textarea>

    <button type="submit">Confirm Order</button>
</form>

</body>
</html>
