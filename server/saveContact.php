<?php
require 'config.php';

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if ($name === '' || $email === '' || $message === '') {
    header("Location: ../public/contact.php?error=1");
    exit;
}

$sql = "INSERT INTO contacts (name, email, message, created_at)
        VALUES (:name, :email, :message, NOW())";

$stmt = $conn->prepare($sql);
$stmt->execute([
    ':name'    => $name,
    ':email'   => $email,
    ':message' => $message
]);

header("Location: ../public/contact.php?success=1");
exit;
?>
