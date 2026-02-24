
document.getElementById('forgotForm').addEventListener('submit', async function (e) {
    e.preventDefault();

    const email = document.getElementById('email').value;

    const response = await fetch('/api/auth/forgot-password', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            email
        })
    });

    const data = await response.json();

    if (response.ok) {
        document.getElementById('message').innerText =
            'Se o e-mail existir, enviaremos o link de recuperação.';
        document.getElementById('message').classList.remove('hidden');
        document.getElementById('error').classList.add('hidden');
    } else {
        document.getElementById('error').innerText =
            data.message || 'Erro ao enviar link.';
        document.getElementById('error').classList.remove('hidden');
    }
});
