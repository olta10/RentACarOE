<?php
require_once __DIR__ . '/../config.php';
session_start();

if(!isset($_GET['id'])) { 
    header('Location: car.php'); 
    exit; 
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM cars WHERE id = ?");
$stmt->execute([$id]);
$car = $stmt->fetch();

if(!$car) { 
    header('Location: index.php'); 
    exit; 
}

$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(!isset($_SESSION['user_id'])) {
        $errors[] = "Duhet të jeni i kyçur për të bërë rezervim.";
    } else {
        $start = $_POST['start_date'];
        $end = $_POST['end_date'];

        if(!$start || !$end) $errors[] = "Zgjidhni data valide.";
        else {
            $s = new DateTime($start);
            $e = new DateTime($end);
            if($s > $e) $errors[] = "Data e fillimit duhet të jetë para datës së mbarimit.";
        }

        if(empty($errors)) {
            $days = $e->diff($s)->days + 1;
            $total = $days * $car['price_per_day'];

            $insert = $pdo->prepare("INSERT INTO bookings (user_id, car_id, start_date, end_date, total) VALUES (?,?,?,?,?)");
            $insert->execute([$_SESSION['user_id'], $car['id'], $start, $end, $total]);

            header('Location: bookings.php?success=1');
            exit;
        }
    }
}
?>
