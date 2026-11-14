document.addEventListener('DOMContentLoaded', () => {
    const loginView = document.getElementById('login-view');
    const welcomeView = document.getElementById('welcome-view');
    const loginForm = document.getElementById('login-form');

    const fullnameInput = document.getElementById('fullname-input');
    const fullnameError = document.getElementById('fullname-error');

    const usernameInput = document.getElementById('username-input');
    const usernameError = document.getElementById('username-error');

    const passwordInput = document.getElementById('password-input');
    const passwordError = document.getElementById('password-error');
    const togglePasswordBtn = document.getElementById('toggle-password');
    const eyeOpen = document.getElementById('eye-open');
    const eyeClosed = document.getElementById('eye-closed');

    const welcomeGreeting = document.getElementById('welcome-greeting');
    const navUsername = document.getElementById('nav-username');
    const loginTimestamp = document.getElementById('login-timestamp');
    const logoutBtn = document.getElementById('logout-btn');

    fullnameInput.focus();

    // Tampilkan / sembunyikan password
    togglePasswordBtn.addEventListener('click', () => {
        const isPassword = passwordInput.getAttribute('type') === 'password';
        passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
        eyeOpen.classList.toggle('hidden', isPassword);
        eyeClosed.classList.toggle('hidden', !isPassword);
        passwordInput.focus();
    });

    function showError(inputEl, errorEl) {
        errorEl.classList.remove('hidden');
        inputEl.classList.add('input-error');
    }

    function clearError(inputEl, errorEl) {
        errorEl.classList.add('hidden');
        inputEl.classList.remove('input-error');
    }

    fullnameInput.addEventListener('input', () => clearError(fullnameInput, fullnameError));
    usernameInput.addEventListener('input', () => clearError(usernameInput, usernameError));
    passwordInput.addEventListener('input', () => clearError(passwordInput, passwordError));

    function getCurrentTime() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes} WIB`;
    }

    // Proses saat form dikirim
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const fullname = fullnameInput.value.trim();
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();
        let isValid = true;

        if (!fullname) {
            showError(fullnameInput, fullnameError);
            isValid = false;
        }

        if (!username) {
            showError(usernameInput, usernameError);
            isValid = false;
        }

        if (!password) {
            showError(passwordInput, passwordError);
            isValid = false;
        }

        if (!isValid) {
            if (!fullname) {
                fullnameInput.focus();
            } else if (!username) {
                usernameInput.focus();
            } else {
                passwordInput.focus();
            }
            return;
        }

        welcomeGreeting.textContent = `Selamat Datang, ${fullname}!`;
        navUsername.textContent = username;
        loginTimestamp.textContent = getCurrentTime();

        loginView.classList.add('hidden');
        welcomeView.classList.remove('hidden');
    });

    // Proses saat tombol Keluar ditekan
    logoutBtn.addEventListener('click', () => {
        fullnameInput.value = '';
        usernameInput.value = '';
        passwordInput.value = '';
        passwordInput.setAttribute('type', 'password');
        eyeOpen.classList.remove('hidden');
        eyeClosed.classList.add('hidden');

        clearError(fullnameInput, fullnameError);
        clearError(usernameInput, usernameError);
        clearError(passwordInput, passwordError);

        welcomeView.classList.add('hidden');
        loginView.classList.remove('hidden');
        fullnameInput.focus();
    });
});