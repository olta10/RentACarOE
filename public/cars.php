<?php
require '../server/config.php';

$sql = "
    SELECT cars.*, users.name AS user_name
    FROM cars
    JOIN users ON cars.created_by = users.id
    ORDER BY cars.id DESC
";

$result = $conn->query($sql);
$cars = $result->fetchAll();
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cars | Rent-a-CarOE</title>
        <link rel="stylesheet" href="css/index.css">
        <link rel="icon" type="image/png" href="images/carsoe.png">
    </head>
<body>

    <nav class="navbar">
        <div class="left-side">
            <a href="./index.php">
                <img src="images/carsoe.png" class="logo" alt="Logo">
            </a>
        </div>

        <ul class="nav-links" id="nav-links">
            <li><a href="./index.php">Home</a></li>
            <li><a href="./aboutus.php">About</a></li>
            <li><a href="./cars.php" class="active">Cars</a></li>
            <li><a href="./services.php">Services</a></li>
        </ul>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <section class="cars-section">
        <div class="container">
            <h1 class="section-title">Explore Our Top Car Brands</h1>
            <div class="cars-grid">
                
                <a href="./details.php" class="car-card">
                    <div class="car-image">
                        <img src="images/mercedes.jpg" alt="Mercedes">
                    </div>
                    <div class="car-content">
                        <h3>Mercedes</h3>
                        <p>Reliable, efficient, and perfect for daily driving. Modern technology meets comfort.</p>
                    </div>
                </a>

                <a href="./details.php" class="car-card">
                    <div class="car-image">
                        <img src="images/bmw.jpg" alt="BMW">
                    </div>
                    <div class="car-content">
                        <h3>BMW</h3>
                        <p>Luxury and performance combined with stylish design. Experience the thrill of driving.</p>
                    </div>
                </a>

                <a href="./details.php" class="car-card">
                    <div class="car-image">
                        <img src="images/audi.jpg" alt="Audi">
                    </div>
                    <div class="car-content">
                        <h3>Audi</h3>
                        <p>Comfort, innovation, and premium quality. Drive with elegance and confidence.</p>
                    </div>
                </a>
            </div>
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
    
<script src="../assets/js/script.js"></script>
</body>
</html>
