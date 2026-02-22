<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Dashboard - Studylab</title>
@vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gray-100 p-10">

<h1 class="text-3xl font-bold mb-6">Dashboard</h1>

<div id="userData" class="bg-white p-6 rounded-lg shadow"></div>

<button id="logout"
class="mt-6 bg-red-500 text-white px-4 py-2 rounded-md">
Logout
</button>

<script>
const token = localStorage.getItem('token');

if(!token){
window.location.href = '/login';
}

fetch('/api/user', {
headers: {
'Authorization': 'Bearer ' + token,
'Accept': 'application/json'
}
})
.then(res => {
if(!res.ok){
localStorage.removeItem('token');
window.location.href = '/login';
}
return res.json();
})
.then(data => {
document.getElementById('userData').innerHTML = `
<p><strong>Nome:</strong> ${data.user.name}</p>
<p><strong>Email:</strong> ${data.user.email}</p>
`;
});

document.getElementById('logout').addEventListener('click', async () => {

await fetch('/api/logout', {
method: 'POST',
headers: {
'Authorization': 'Bearer ' + token,
'Accept': 'application/json'
}
});

localStorage.removeItem('token');
window.location.href = '/login';

});
</script>

</body>
</html>