// --- Hamburger Menu ---
document.addEventListener('DOMContentLoaded', () => {
    const hamburger = document.querySelector('.hamburger');
    const navLinks = document.querySelector('.nav-links');

    if (hamburger && navLinks) {
        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
});



// --- Login Validation ---
const loginForm = document.getElementById('loginForm');

if (loginForm) {
    loginForm.addEventListener('submit', function(e) {

        const email = document.getElementById('loginEmail').value.trim();
        const password = document.getElementById('loginPassword').value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email === "" || password === "") {
            e.preventDefault();
            alert("Please fill in all fields.");
            return;
        }

        if (!emailPattern.test(email)) {
            e.preventDefault();
            alert("Please enter a valid email.");
            return;
        }

        if (password.length < 6) {
            e.preventDefault();
            alert("Password must have at least 6 characters.");
            return;
        }

        alert("Login successful!");
    });
}

// --- Register Validation ---
const registerForm = document.getElementById('registerForm');

if (registerForm) {
    registerForm.addEventListener('submit', function(e) {

        const fullname = document.getElementById('regFullname').value.trim();
        const email = document.getElementById('regEmail').value.trim();
        const password = document.getElementById('regPassword').value.trim();
        const confirmPassword = document.getElementById('regConfirmPassword').value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (fullname === "" || email === "" || password === "" || confirmPassword === "") {
            e.preventDefault();
            alert("Please fill in all fields.");
            return;
        }

        if (!emailPattern.test(email)) {
            e.preventDefault();
            alert("Please enter a valid email.");
            return;
        }

        if (password.length < 6) {
            e.preventDefault();
            alert("Password must be at least 6 characters.");
            return;
        }

        if (password !== confirmPassword) {
            e.preventDefault();
            alert("Passwords do not match.");
            return;
        }

        alert("Registration successful!");
    });
}

// --- SLIDER Validation ---
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


