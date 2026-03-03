const API_BASE = 'http://127.0.0.1:8000/api';

function authHeaders(extra = {}) {
    const token = localStorage.getItem('auth_token');
    return { 'Accept': 'application/json', 'Authorization': `Bearer ${token}`, ...extra };
}

function applyUserToUI(user) {
    document.getElementById('cardName').textContent  = (user.name  || 'SEU NOME').toUpperCase();
    document.getElementById('cardEmail').textContent = user.email  || '—';
    document.getElementById('cardId').textContent    = 'SL-' + String(user.id || 1).padStart(6, '0');

    if (user.created_at) {
        const d = new Date(user.created_at);
        document.getElementById('cardSince').textContent =
            d.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
    }

    document.getElementById('nameInput').value  = user.name  || '';
    document.getElementById('emailInput').value = user.email || '';

    const photoUrl = user.avatar || null;
    if (photoUrl) {
        const imgHtml = `<img src="${photoUrl}" class="w-full h-full object-cover">`;
        document.getElementById('photoPreviewWrapper').innerHTML = imgHtml;
        document.getElementById('cardPhotoWrapper').innerHTML    = imgHtml;
    }
}

async function loadProfile() {
    try {
        const res = await fetch(`${API_BASE}/user`, { headers: authHeaders() });
        if (!res.ok) return;
        const user = await res.json();
        applyUserToUI(user);
    } catch (e) { console.error('Erro ao carregar perfil', e); }
}

loadProfile();

function showToast(msg) {
    const t = document.getElementById('toast');
    document.getElementById('toastMsg').textContent = msg || 'Salvo!';
    t.classList.remove('hidden');
    setTimeout(() => t.classList.add('hidden'), 3000);
}

function showErr(id, msg) {
    const el = document.getElementById('err-' + id);
    if (el) { el.textContent = msg; el.classList.remove('hidden'); }
}

function clearErr(id) {
    document.getElementById('err-' + id)?.classList.add('hidden');
}

document.getElementById('nameInput').addEventListener('input', () => {
    document.getElementById('cardName').textContent =
        document.getElementById('nameInput').value.toUpperCase() || 'SEU NOME';
    clearErr('name');
});

document.getElementById('emailInput').addEventListener('input', () => {
    document.getElementById('cardEmail').textContent =
        document.getElementById('emailInput').value || '—';
    clearErr('email');
});

document.getElementById('nameForm').addEventListener('submit', async e => {
    e.preventDefault();
    const name = document.getElementById('nameInput').value.trim();
    if (!name) { showErr('name', 'Informe seu nome.'); return; }
    try {
        const res = await fetch(`${API_BASE}/profile`, {
            method: 'PUT',
            headers: authHeaders({ 'Content-Type': 'application/json' }),
            body: JSON.stringify({ name }),
        });
        const d = await res.json();
        if (res.ok) { applyUserToUI(d.user); showToast('Nome atualizado!'); }
        else showErr('name', d.message || 'Erro ao salvar.');
    } catch { showErr('name', 'Erro de conexão.'); }
});

document.getElementById('emailForm').addEventListener('submit', async e => {
    e.preventDefault();
    const email = document.getElementById('emailInput').value.trim();
    if (!email || !email.includes('@')) { showErr('email', 'E-mail inválido.'); return; }
    try {
        const res = await fetch(`${API_BASE}/profile`, {
            method: 'PUT',
            headers: authHeaders({ 'Content-Type': 'application/json' }),
            body: JSON.stringify({ email }),
        });
        const d = await res.json();
        if (res.ok) { applyUserToUI(d.user); showToast('E-mail atualizado!'); }
        else showErr('email', d.message || 'Erro ao salvar.');
    } catch { showErr('email', 'Erro de conexão.'); }
});

document.getElementById('passwordForm').addEventListener('submit', async e => {
    e.preventDefault();
    const current = document.getElementById('currentPassword').value;
    const novo    = document.getElementById('newPassword').value;
    const confirm = document.getElementById('confirmPassword').value;
    if (novo !== confirm) { showErr('password', 'As senhas não coincidem.'); return; }
    if (novo.length < 8)  { showErr('password', 'Mínimo 8 caracteres.'); return; }
    try {
        const res = await fetch(`${API_BASE}/profile`, {
            method: 'PUT',
            headers: authHeaders({ 'Content-Type': 'application/json' }),
            body: JSON.stringify({ current_password: current, password: novo, password_confirmation: confirm }),
        });
        const d = await res.json();
        if (res.ok) { showToast('Senha alterada!'); document.getElementById('passwordForm').reset(); }
        else showErr('password', d.message || 'Erro ao alterar.');
    } catch { showErr('password', 'Erro de conexão.'); }
});

document.getElementById('photoInput').addEventListener('change', function () {
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => {
        const src = ev.target.result;
        document.getElementById('photoPreviewWrapper').innerHTML =
            `<img src="${src}" class="w-full h-full object-cover rounded-2xl">`;
        document.getElementById('cardPhotoWrapper').innerHTML =
            `<img src="${src}" class="w-full h-full object-cover">`;
    };
    reader.readAsDataURL(file);
    document.getElementById('savePhotoBtn').disabled = false;
});

document.getElementById('savePhotoBtn').addEventListener('click', async () => {
    const file = document.getElementById('photoInput').files[0];
    if (!file) return;
    const form = new FormData();
    form.append('photo', file);
    try {
        const res = await fetch(`${API_BASE}/profile/photo`, {
            method: 'POST',
            headers: authHeaders(),
            body: form,
        });
        const d = await res.json();
        if (res.ok) {
            applyUserToUI(d.user);
            showToast('Foto atualizada!');
            document.getElementById('savePhotoBtn').disabled = true;
            document.getElementById('photoInput').value = '';
        } else {
            showToast(d.message || 'Erro ao enviar foto.');
        }
    } catch { showToast('Erro de conexão.'); }
});

document.getElementById('deleteAccountBtn').addEventListener('click', () => {
    document.getElementById('deleteModal').classList.remove('hidden');
});

document.getElementById('cancelDelete').addEventListener('click', () => {
    document.getElementById('deleteModal').classList.add('hidden');
    document.getElementById('deletePasswordInput').value = '';
});

document.getElementById('confirmDelete').addEventListener('click', async () => {
    const password = document.getElementById('deletePasswordInput').value;
    if (!password) {
        document.getElementById('deletePasswordInput').classList.add('border-red-400');
        return;
    }
    try {
        const res = await fetch(`${API_BASE}/profile`, {
            method: 'DELETE',
            headers: authHeaders({ 'Content-Type': 'application/json' }),
            body: JSON.stringify({ password }),
        });
        if (res.ok) {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        } else {
            document.getElementById('deletePasswordInput').classList.add('border-red-400');
        }
    } catch { showToast('Erro de conexão.'); }
});

document.getElementById('logoutBtn').addEventListener('click', async () => {
    try {
        await fetch(`${API_BASE}/logout`, {
            method: 'POST',
            headers: authHeaders(),
        });
    } catch (_) {}
    localStorage.removeItem('auth_token');
    window.location.href = '/login';
});