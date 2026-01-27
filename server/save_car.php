<?php
session_start();

require_once 'classes/Car.php';
require_once 'classes/Validator.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

$brand = Validator::clean($_POST['car_brand'] ?? '');
$model = Validator::clean($_POST['car_model'] ?? '');
$year  = Validator::clean($_POST['car_year'] ?? '');
$price = Validator::clean($_POST['car_price'] ?? '');

if (
    !Validator::required($brand) ||
    !Validator::required($model) ||
    !Validator::required($year) ||
    !Validator::required($price)
) {
    header("Location: ../public/cars.php?error=1");
    exit;
}

$image = null;

if (isset($_FILES['car_image']) && $_FILES['car_image']['name'] !== '') {
    $uploadDir = "../public/uploads/";
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $image = time() . "_" . basename($_FILES['car_image']['name']);
    move_uploaded_file(
        $_FILES['car_image']['tmp_name'],
        $uploadDir . $image
    );
}

$carObj = new Car();
$carObj->addCar(
    $brand,
    $model,
    (int)$year,
    (float)$price,
    $_SESSION['user_id'],
    $image
);

header("Location: ../public/cars.php?success=1");
exit;
