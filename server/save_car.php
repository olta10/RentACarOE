<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    die("You must login first");
}

$name        = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price       = $_POST['price'] ?? 0;
$created_by  = $_SESSION['user_id'];

$file = $_FILES['media'];
$ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if ($ext === 'pdf') {
    $folder = "../uploads/pdfs/";
    $type   = "pdf";
} else {
    $folder = "../uploads/images/";
    $type   = "image";  
}

// krijo folder nëse nuk ekziston
if (!is_dir($folder)) mkdir($folder, 0777, true);

$filename = time() . "_" . basename($file['name']);
$path     = $folder . $filename;
move_uploaded_file($file['tmp_name'], $path);

// ruaj ne DB
$sql = "INSERT INTO cars (name, description, price, media, media_type, created_by, created_at)
        VALUES (:name, :description, :price, :media, :media_type, :created_by, NOW())";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':name'        => $name,
    ':description' => $description,
    ':price'       => $price,
    ':media'       => $filename,
    ':media_type'  => $type,
    ':created_by'  => $created_by
]);

header("Location: ../public/cars.php?success=1");
exit;
