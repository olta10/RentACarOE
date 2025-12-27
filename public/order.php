<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

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
$car = $stmt->fetch();

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

<h2>Order: <?= htmlspecialchars($car['title']) ?></h2>
<p>Price per day: <?= $car['price_per_day'] ?> €</p>

<form method="post" action="save_order.php">
    <input type="hidden" name="car_id" value="<?= $car['id'] ?>">

    <label>Days:</label>
    <input type="number" name="days" required>

    <label>Preferences:</label>
    <textarea name="preferences"></textarea>

    <button type="submit">Confirm Order</button>
</form>

</body>
</html>
