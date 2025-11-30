// Modal
const modal = document.getElementById('authModal');
const openBtn = document.getElementById('openModal');
const closeBtn = document.getElementById('closeModal');

openBtn.onclick = () => modal.style.display = 'flex';
closeBtn.onclick = () => modal.style.display = 'none';
window.onclick = (e) => { if(e.target == modal) modal.style.display = 'none'; };

// Tabs
const tabs = document.querySelectorAll('.tab-btn');
const forms = document.querySelectorAll('.tab-form');

tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');

        forms.forEach(f => f.classList.remove('active'));
        document.getElementById(tab.dataset.target).classList.add('active');
    });
});

// Login form
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('loginName').value.trim();
    const surname = document.getElementById('loginSurname').value.trim();
    const password = document.getElementById('loginPassword').value.trim();
    const msg = document.getElementById('loginMsg');

    if(!name || !surname || !password) {
        msg.textContent = 'Ju lutem plotësoni të gjitha fushat.';
        msg.style.color = '#ff4d4d';
        return;
    }

    msg.textContent = 'Ky është një shembull: Login i suksesshëm!';
    msg.style.color = '#4b7bec';
});

// Register form
document.getElementById('registerForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const name = document.getElementById('regName').value.trim();
    const surname = document.getElementById('regSurname').value.trim();
    const password = document.getElementById('regPassword').value.trim();
    const msg = document.getElementById('regMsg');

    if(!name || !surname || !password) {
        msg.textContent = 'Ju lutem plotësoni të gjitha fushat.';
        msg.style.color = '#ff4d4d';
        return;
    }

    if(password.length < 6){
        msg.textContent = 'Fjalëkalimi duhet të ketë të paktën 6 karaktere.';
        msg.style.color = '#ff4d4d';
        return;
    }

    msg.textContent = 'Ky është një shembull: Regjistrimi i suksesshëm!';
    msg.style.color = '#4b7bec';
});
