<!doctype html>
<html lang="sq">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home | Rent-a-CarOE</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="icon" type="image/png" href="images/carsoe.png">
</head>
<body>

<!-- ================= NAVBAR ================= -->
<nav class="navbar">
    <div class="left-side">
        <a href="./index.php">
            <img src="images/carsoe.png" class="logo" alt="Logo">
        </a>
    </div>

    <ul class="nav-links">
        <li><a href="./index.php" class="active">Home</a></li>
        <li><a href="./aboutus.php">About</a></li>
        <li><a href="./cars.php">Cars</a></li>
        <li><a href="./services.php">Services</a></li>
        <li><a href="./contact.php">Contact</a></li>
    </ul>

    <div class="right-side">
        <a href="register.php">
            <img src="images/usser.png" class="user-logo" alt="User">
        </a>
    </div>

    <div class="hamburger">
        <span></span>
        <span></span>
        <span></span>
    </div>
</nav>

<!-- ================= HERO / SLIDER ================= -->
<section class="hero-full">
    <div class="slider-container">
        <div class="slide active">
            <img src="images/mercedes.jpg" alt="Mercedes">
        </div>
        <div class="slide">
            <img src="images/audi.jpg" alt="Audi">
        </div>
        <div class="slide">
            <img src="images/bmw.jpg" alt="BMW">
        </div>

        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>

        <div class="hero-center">
            <h1>Find Your Perfect Car</h1>
            <a href="./cars.php" class="btn-view-cars">View All Cars</a>
        </div>
    </div>
</section>

<!-- ================= FOOTER ================= -->
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

<!-- ================= JS FILE ================= -->
<script src="js/main.js"></script>
</body>
</html>
