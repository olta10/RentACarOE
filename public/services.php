    <!doctype html>
    <html lang="sq">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Services | Rent-a-CarOE</title>
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
            <li><a href="./cars.php">Cars</a></li>
            <li><a href="./services.php" class="active">Services</a></li>            
            <li><a href="./contact.php">Contact</a></li>
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

        <section class="service-hero">
            <h1>Airport Transfer</h1>
            <p>Fast, comfortable, and safe transport to and from the airport.</p>
        </section>

        <section class="service-details container">

            <div class="main-image">
                <img src="images/foto.jpg" alt="Airport Transfer Service">
            </div>

            <div class="service-info">

                <h2>Service Description</h2>
                <p>
                    Our Airport Transfer service guarantees a comfortable and safe journey to or from the airport.
                    Our drivers are professionals and monitor flights in real-time to ensure punctuality.
                </p>

                <p>
                    Clean, comfortable cars suitable for individuals, families, or groups. Each trip is carefully organized 
                    to ensure a stress-free transport experience.
                </p>

            <form action="../server/save_car.php" method="POST" class="book-form" enctype="multipart/form-data">
                <label for="car_brand">Brand:</label>
                <input type="text" id="car_brand" name="car_brand" placeholder="Enter car brand" required>

                <label for="car_model">Model:</label>
                <input type="text" id="car_model" name="car_model" placeholder="Enter car model" required>

                <label for="car_year">Year:</label>
                <input type="number" id="car_year" name="car_year" placeholder="Enter year" required>

                <label for="car_price">Price per Day:</label>
                <input type="number" id="car_price" name="car_price" placeholder="Enter price" required>

                <label for="car_image">Image:</label>
                <input type="file" id="car_image" name="car_image">

                <button type="submit" class="btn-book">Add Car</button>
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

<script src="./js/validation.js.js"></script>
    </body>
    </html>
