<?php
$success = isset($_GET['success']);
$error = isset($_GET['error']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact | Rent-a-CarOE</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="icon" type="image/png" href="images/carsoe.png">
    </head>
<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="left-side">
        <a href="./index.php">
            <img src="images/carsoe.png" class="logo" alt="Logo">
        </a>
    </div>

    <ul class="nav-links" id="nav-links">
        <li><a href="./index.php">Home</a></li>
        <li><a href="./aboutus.php">About</a></li>
        <li><a href="./cars.php">Cars</a></li>
        <li><a href="./services.php">Services</a></li>
        <li><a href="./contact.php" class="active">Contact</a></li>
    </ul>

    <div class="right-side">
        <a href="register.php">
            <img src="images/usser.png" class="user-logo" alt="User">
        </a>
    </div>

    <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<!-- CONTACT SECTION -->
<section class="contact-section">
    <div class="contact-container">
        <h1>Contact Us</h1>

        <?php if($success): ?>
            <p style="color:green;">Message sent successfully!</p>
        <?php elseif($error): ?>
            <p style="color:red;">Please fill all fields!</p>
        <?php endif; ?>

        <form action="../server/saveContact.php" method="POST" class="contact-form">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <textarea name="message" placeholder="Your Message" required></textarea>
            <button type="submit">Send Message</button>
        </form>
    </div>
</section>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="footer-container">

        <div class="footer-col">
            <h3>Rent-a-Car</h3>
            <p>The ideal choice for the best cars at the most affordable prices.</p>
        </div>

        <div class="footer-col">
            <h4>Pages</h4>
            <ul>
                <li><a href="./index.php">Home</a></li>
                <li><a href="./aboutus.php">About Us</a></li>
                <li><a href="./cars.php">Cars</a></li>
                <li><a href="./services.php">Services</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Contact Us</h4>
            <p>Email: ok72809@ubt-uni.net</p>                        
            <p>Email: eh72952@ubt-uni.net</p>
            <p>Email: ek74412@ubt-uni.net</p>
        </div>

    </div>

    <div class="footer-bottom">
        <p>© 2025 Rent-a-Car. All rights reserved.</p>
    </div>
</footer>

<script src="./js/script.js"></script>
</body>
</html>
