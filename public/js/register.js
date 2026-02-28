document.getElementById('registerForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const password_confirmation = document.getElementById('password_confirmation').value;

    const response = await fetch('/api/auth/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            name,
            email,
            password,
            password_confirmation
        })
    });

    const data = await response.json();

    if (response.ok) {
        localStorage.setItem('token', data.access_token);
        window.location.href = '/dashboard';
    } else {

        const errorBox = document.getElementById('errorBox');
        const errorMessage = document.getElementById('errorMessage');

        let message = "Erro ao registrar";

        if (data.message) {
            message = data.message;
        }

        if (data.errors) {
            message = Object.values(data.errors).flat().join(' | ');
        }

        errorMessage.innerText = message;
        errorBox.classList.remove('hidden');
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.getElementById('phone');

    if (phoneInput) {
        IMask(phoneInput, {
            mask: '(00) 00000-0000'
        });
    }
});