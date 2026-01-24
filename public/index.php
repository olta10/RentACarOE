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




    <section class="hero-full">
        <div class="slider-container">
            <div class="slide active">
                <img src="images/mercedes.jpg" alt="Car 1">
            </div>
            <div class="slide">
                <img src="images/audi.jpg" alt="Car 2">
            </div>
            <div class="slide">
                <img src="images/bmw.jpg" alt="Car 3">
            </div>

            <button class="prev">&#10094;</button>
            <button class="next">&#10095;</button>

            <div class="hero-center">
                <h1>Find Your Perfect Car</h1>
                <a href="./cars.php" class="btn-view-cars">View All Cars</a>
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach(slide => slide.classList.remove('active'));
            slides[index].classList.add('active');
        }

        nextBtn.addEventListener('click', () => {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        });

        prevBtn.addEventListener('click', () => {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(currentIndex);
        });

        setInterval(() => {
            currentIndex = (currentIndex + 1) % slides.length;
            showSlide(currentIndex);
        }, 5000); 
    });
    </script>

    <style>
.slider-container {
    position: relative;
    width: 100%;
    height: 500px;
    overflow: hidden;
}

.slide {
    display: none;
    width: 100%;
    height: 100%;
}

.slide.active {
    display: block;
}

.slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.prev, .next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    color: white;
    border: none;
    font-size: 45px;
    cursor: pointer;
    z-index: 10;
    opacity: 0.7;
}

.prev {
    left: 20px;
}

.next {
    right: 20px;
}

.prev:hover,
.next:hover {
    opacity: 1;
}

.hero-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
    color: #fff;
    z-index: 5;
}

.hero-center h1 {
    font-size: 52px;
    font-weight: bold;
    text-shadow: 0 4px 15px rgba(0,0,0,0.8);
}


.btn-view-cars {
    display: inline-block;
    background: rgba(0,0,0,0.7);
    color: #fff;
    padding: 12px 28px;
    text-decoration: none;
    border-radius: 30px;
    font-size: 18px;
    transition: 0.3s;
}

.btn-view-cars:hover {
    background: rgba(0,0,0,0.9);
}

    </style>
</body>
</html>

