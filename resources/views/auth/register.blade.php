<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro - Studylab</title>
@vite('resources/css/app.css')
</head>
<body class="h-screen flex items-center justify-center bg-gray-100">

<div class="bg-white p-10 rounded-2xl shadow-lg w-[400px]">

<h2 class="text-2xl font-bold text-center mb-6">Criar Conta</h2>

<form id="registerForm" class="space-y-4">

<input id="name" type="text"
class="w-full border p-3 rounded-md"
placeholder="Nome completo" required>

<input id="email" type="email"
class="w-full border p-3 rounded-md"
placeholder="Email" required>

<input id="password" type="password"
class="w-full border p-3 rounded-md"
placeholder="Senha" required>

<input id="password_confirmation" type="password"
class="w-full border p-3 rounded-md"
placeholder="Confirmar senha" required>

<button type="submit"
class="w-full bg-[#FF0073] text-white py-3 rounded-md hover:bg-[#d10c65] transition">
Criar conta
</button>

</form>

<p id="error" class="text-red-500 text-sm mt-4 text-center hidden"></p>

<p class="text-center mt-4 text-sm">
Já tem conta?
<a href="/login" class="text-[#FF0073] font-medium hover:underline">
Entrar
</a>
</p>

</div>

<script>
document.getElementById('registerForm').addEventListener('submit', async function(e){
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

if(response.ok){
localStorage.setItem('token', data.access_token);
window.location.href = '/dashboard';
}else{
document.getElementById('error').innerText =
data.message || Object.values(data.errors).flat().join('\n');
document.getElementById('error').classList.remove('hidden');
}
});
</script>

</body>
</html>