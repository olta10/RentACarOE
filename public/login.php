<?php
session_start();
$error = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In | Rent-a-CarOE</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" type="image/png" href="images/carsoe.png">
</head>
<body>

<nav class="navbar">
    <div class="left-side">
        <a href="index.php">
            <img src="images/carsoe.png" class="logo" alt="Logo">
        </a>
    </div>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="aboutus.php">About</a></li>
        <li><a href="cars.php">Cars</a></li>
        <li><a href="services.php">Services</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>

    <div class="right-side">
        <a href="register.php">
            <img src="images/usser.png" class="user-logo" alt="User">
        </a>
    </div>
</nav>

<section class="auth-section">
    <div class="auth-logo">
        <img src="images/carsoe.png" alt="Logo">
    </div>

    <div class="auth-container">
        <h2>Login</h2>

        <?php if ($error): ?>
            <p class="error">Invalid email or password</p>
        <?php endif; ?>

        <form method="POST"
              action="../server/loginVerify.php"
              onsubmit="return validateLogin();">

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email"
                       id="email"
                       name="email"
                       placeholder="Enter your email">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"
                       id="password"
                       name="password"
                       placeholder="Enter your password">
            </div>

            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </form>
    </div>
</section>

<footer class="site-footer">
    <div class="footer-container">

        <div class="footer-col">
            <h3>Rent-a-Car</h3>
            <p>The ideal choice for the best cars at the most affordable prices.</p>
        </div>

        <div class="footer-col">
            <h4>Pages</h4>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="aboutus.php">About Us</a></li>
                <li><a href="cars.php">Cars</a></li>
                <li><a href="services.php">Services</a></li>
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

<script src="js/validation.js"></script>
</body>
</html>
