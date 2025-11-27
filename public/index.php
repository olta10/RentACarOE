<?php
require_once __DIR__ . '/../config.php';
?>
<!doctype html>
<html lang="sq">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rent-a-Car</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
<body>

    <header class="site-header">
        <div class="container header-flex">
            <nav class="navbar">
                <div class="left-side">
                    <img src="../assets/images/carsoe.png" class="logo" alt="Logo">
                </div>

                <ul class="nav-links">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Cars</a></li>
                    <li><a href="./aboutus.php">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>

                <div class="search-box">
                    <input type="text" placeholder="Search...">
                </div>
            </nav>
        </div>
    </header>

    <!-- FOTO E MADHE -->
    <section class="hero-full">
        <img src="../assets/images/foto.jpg" class="hero-img" alt="Car">

        <div class="hero-center">
            <h1>Gjej makinën tënde ideale</h1>

            <div class="hero-button">
                <a href="cars.html" class="btn-view-cars">Shiko të gjitha makinat</a>
            </div>
        </div>
    </section>


</body>
</html>

