<?php
require 'config.php';  // lidhja me DB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_name = trim($_POST['user_name']);
    $service_name = trim($_POST['service_name']);
    $quantity = intval($_POST['quantity']);
    $preferences = trim($_POST['preferences']);

    if ($user_name === '' || $service_name === '') {
        die("Name or Service missing");
    }

    $stmt = $conn->prepare("
        INSERT INTO orders (user_name, service_name, quantity, preferences)
        VALUES (:user_name, :service_name, :quantity, :preferences)
    ");

    $stmt->execute([
        ':user_name' => $user_name,
        ':service_name' => $service_name,
        ':quantity' => $quantity,
        ':preferences' => $preferences
    ]);

    echo "Order successfully placed! Redirecting...";

    echo '<script>
            setTimeout(function(){
                window.location.href = "../public/services.php";
            }, 2000);
          </script>';
    exit;

} else {
    header("Location: ../public/services.php");
    exit;
}
