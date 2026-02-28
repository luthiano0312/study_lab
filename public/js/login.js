document.getElementById('loginForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    try {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ email, password })
        });

        const data = await response.json();

        console.log('resposta do login:', data); // 👈 adiciona isso pra debugar

        if (response.ok) {
            localStorage.setItem('auth_token', data.token);
            window.location.href = '/dashboard';
        } else {
            document.getElementById('errorMessage').innerText = data.message ?? 'Credenciais inválidas';
            document.getElementById('errorBox').classList.remove('hidden');
        }

    } catch (error) {
        document.getElementById('errorMessage').innerText = 'Erro no servidor';
        document.getElementById('errorBox').classList.remove('hidden');
    }
});