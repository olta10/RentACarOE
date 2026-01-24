<?php
session_start();
require_once "classes/Car.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit;
}

$car = new Car();
$car->add($_POST, $_FILES['media'], $_SESSION['user_id']);

header("Location: ../public/cars.php");
exit;
