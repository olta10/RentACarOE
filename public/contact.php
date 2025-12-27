<?php
$success = isset($_GET['success']);
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Contact Us</title>
<link rel="stylesheet" href="../css/style.css">
</head>
<body>
<h1>Contact Us</h1>
<?php if($success): ?>
    <p style="color:green;">Message sent successfully!</p>
<?php elseif($error): ?>
    <p style="color:red;">Please fill all fields!</p>
<?php endif; ?>

<form action="../server/saveContact.php" method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="message" placeholder="Your Message" required></textarea>
    <button type="submit">Send Message</button>
</form>
</body>
</html>
