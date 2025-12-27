<?php
require 'config.php';

$name    = $_POST['name'] ?? '';
$email   = $_POST['email'] ?? '';
$message = $_POST['message'] ?? '';

if ($name === '' || $email === '' || $message === '') {
    echo "<script>
        alert('Ju lutem plotësoni të gjitha fushat!');
        window.location.href = '../public/contact.php';
    </script>";
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

echo "<script>
    alert('Mesazhi u dërgua me sukses!');
    window.location.href = '../public/contact.php';
</script>";
exit;
?>
