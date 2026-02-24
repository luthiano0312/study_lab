
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
        document.getElementById('error').innerText =
            data.message || Object.values(data.errors).flat().join('\n');
        document.getElementById('error').classList.remove('hidden');
    }
});