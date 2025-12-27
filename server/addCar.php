<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    echo "
    <html>
    <head>
        <meta http-equiv='refresh' content='2;url=../public/login.php'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: #f5f5f5;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }
            .message {
                background: #fff;
                padding: 25px 40px;
                border-radius: 8px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class='message'>
            <h3>You must login first</h3>
            <p>Redirecting to login page...</p>
        </div>
    </body>
    </html>
    ";
    exit;
}

$name        = $_POST['name'] ?? '';
$description = $_POST['description'] ?? '';
$price       = $_POST['price'] ?? 0;
$created_by  = $_SESSION['user_id'];

/* ===============================
   FILE UPLOAD
================================ */
$file = $_FILES['media'];
$ext  = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

if ($ext === 'pdf') {
    $folder = "../uploads/pdfs/";
    $type   = "pdf";
} else {
    $folder = "../uploads/images/";
    $type   = "image";
}

/* create folder if missing */
if (!is_dir($folder)) {
    mkdir($folder, 0777, true);
}

$filename = time() . "_" . basename($file['name']);
$path     = $folder . $filename;

move_uploaded_file($file['tmp_name'], $path);

$sql = "INSERT INTO cars
(name, description, price, media, media_type, created_by)
VALUES (:name, :description, :price, :media, :media_type, :created_by)";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':name'        => $name,
    ':description' => $description,
    ':price'       => $price,
    ':media'       => $filename,
    ':media_type'  => $type,
    ':created_by'  => $created_by
]);

header("Location: ../public/cars.php");
exit;
