// --- Login ---
const loginForm = document.getElementById('loginForm');
if (loginForm) {
    loginForm.addEventListener('submit', function(e){
        e.preventDefault();
        const email = document.getElementById('loginEmail').value.trim();
        const password = document.getElementById('loginPassword').value.trim();

        if(email === "" || password === ""){
            alert("Please fill in all fields");
            return;
        }

        alert("Login successful! Email: " + email);
        loginForm.reset();
    });
}

// --- Register ---
const registerForm = document.getElementById('registerForm');
if (registerForm) {
    registerForm.addEventListener('submit', function(e){
        e.preventDefault();
        const fullname = document.getElementById('regFullname').value.trim();
        const email = document.getElementById('regEmail').value.trim();
        const password = document.getElementById('regPassword').value.trim();
        const confirmPassword = document.getElementById('regConfirmPassword').value.trim();

        if(fullname === "" || email === "" || password === "" || confirmPassword === ""){
            alert("Please fill in all fields");
            return;
        }

        if(password !== confirmPassword){
            alert("Passwords do not match! Try again.");
            return;
        }

        alert("Registration successful!\nFull Name: " + fullname + "\nEmail: " + email);
        registerForm.reset();
    });
}
