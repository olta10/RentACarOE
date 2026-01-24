<?php
session_start();
require_once 'classes/Car.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

$carObj = new Car();

$brand = $_POST['car_brand'] ?? '';
$model = $_POST['car_model'] ?? '';
$year  = $_POST['car_year'] ?? '';
$price = $_POST['car_price'] ?? '';

$media = null;

if(isset($_FILES['car_image']) && $_FILES['car_image']['name'] != '') {
    $uploadDir = "../public/uploads/"; // folderi ku ruhen fotot
    if(!file_exists($uploadDir)) mkdir($uploadDir, 0777, true);

    $media = time() . "_" . basename($_FILES['car_image']['name']);
    move_uploaded_file($_FILES['car_image']['tmp_name'], $uploadDir . $media);
}

$carObj->addCar($brand, $model, $year, $price, $_SESSION['user_id'], $media);

header("Location: ../public/cars.php");
exit;
?>
