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
            <a href="./index.php">
                <img src="images/carsoe.png" class="logo" alt="Logo">
            </a>
        </div>

        <ul class="nav-links" id="nav-links">
            <li><a href="./index.php" class="active">Home</a></li>
            <li><a href="./aboutus.php">About</a></li>
            <li><a href="./cars.php">Cars</a></li>
            <li><a href="./services.php">Services</a></li>
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
            <h2>Login</h2>
                <form id="loginForm" method="POST" action="login.php">
                    <div class="form-group">
                        <label for="loginUsername">Username or Email</label>
                        <input type="text" id="loginUsername" name="username" placeholder="Enter your username or email" required>
                    </div>
                    <div class="form-group">
                        <label for="loginPassword">Password</label>
                        <input type="password" id="loginPassword" name="password" placeholder="Enter your password" required>
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