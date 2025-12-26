<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register | Rent-a-CarOE</title>
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
        </ul>

        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </nav>

    <section class="auth-section">
        <div class="auth-logo">
            <img src="images/carsoe.png" alt="Logo">
        </div>
        <div class="auth-container">
            <h2>Register</h2>
                <form id="registerForm" method="POST" action="../server/registerVerify.php">
                    <div class="form-group">
                        <label for="regFullname">Full Name</label>
                        <input type="text" id="regFullname" name="fullname" placeholder="Enter your full name" required>
                    </div>

                    <div class="form-group">
                        <label for="regEmail">Email</label>
                        <input type="email" id="regEmail" name="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="regPassword">Password</label>
                        <input type="password" id="regPassword" name="password" placeholder="Enter your password" required>
                    </div>

                    <div class="form-group">
                        <label for="regConfirmPassword">Confirm Password</label>
                        <input type="password" id="regConfirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    </div>

                    <button type="submit">Register</button>
                    <p>Already have an account? <a href="login.php">Login</a></p>
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
    
<script src="../assets/js/script.js"></script>
</body>
</html>