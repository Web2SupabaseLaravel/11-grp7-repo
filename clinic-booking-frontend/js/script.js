const API_URL = 'http://localhost:8000/api';

function getToken() {
    return localStorage.getItem('auth_token');
}

function setToken(token) {
    localStorage.setItem('auth_token', token);
}

function clearToken() {
    localStorage.removeItem('auth_token');
}

async function login(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await axios.post(`${API_URL}/login`, { email, password }, {
            headers: {
                'Accept': 'application/json'
            }
        });
        setToken(response.data.token);
        alert('Login successful!');
        window.location.href = 'index.html';
    } catch (error) {
        alert('Error during login: ' + (error.response?.data?.message || error.message));
    }
}

async function register(event) {
    event.preventDefault();
    const full_name = document.getElementById('full_name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await axios.post(`${API_URL}/register`, { full_name, email, password }, {
            headers: {
                'Accept': 'application/json'
            }
        });
        alert('Registration successful! Please log in.');
        window.location.href = 'login.html';
    } catch (error) {
        alert('Error during registration: ' + (error.response?.data?.message || error.message));
    }
}

async function forgotPassword(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;

    try {
        const response = await axios.post(`${API_URL}/forgot-password`, { email }, {
            headers: {
                'Accept': 'application/json'
            }
        });
        alert('Password reset link sent to your email.');
        window.location.href = 'login.html';
    } catch (error) {
        alert('Error sending reset link: ' + (error.response?.data?.message || error.message));
    }
}

async function resetPassword(event) {
    event.preventDefault();
    const email = document.getElementById('email').value;
    const token = document.getElementById('token').value;
    const password = document.getElementById('password').value;
    const password_confirmation = document.getElementById('password_confirmation').value;

    try {
        const response = await axios.post(`${API_URL}/reset-password`, { email, token, password, password_confirmation }, {
            headers: {
                'Accept': 'application/json'
            }
        });
        alert('Password reset successfully! Please log in.');
        window.location.href = 'login.html';
    } catch (error) {
        alert('Error resetting password: ' + (error.response?.data?.message || error.message));
    }
}

function logout() {
    clearToken();
    alert('Logged out successfully!');
    window.location.href = 'login.html';
}