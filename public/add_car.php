<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add a Car</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<h1>Add a Car</h1>

<form action="../server/saveCar.php" method="POST" enctype="multipart/form-data">
    <input type="text" name="name" placeholder="Car Name" required><br>
    <textarea name="description" placeholder="Description" required></textarea><br>
    <input type="number" name="price" placeholder="Price (€)" step="0.01" required><br>
    <input type="file" name="media" accept="image/*,.pdf" required><br>
    <button type="submit">Add Car</button>
</form>

</body>
</html>
