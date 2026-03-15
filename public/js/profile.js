
const API = '/api';

const COLORS = {
    rosa:        { g: 'linear-gradient(135deg,#be185d,#db2777,#f472b6)',             l: false },
    roxo:        { g: 'linear-gradient(135deg,#5b21b6,#7c3aed,#a78bfa)',             l: false },
    azul:        { g: 'linear-gradient(135deg,#1e40af,#2563eb,#60a5fa)',             l: false },
    verde:       { g: 'linear-gradient(135deg,#065f46,#059669,#34d399)',             l: false },
    laranja:     { g: 'linear-gradient(135deg,#c2410c,#ea580c,#fb923c)',             l: false },
    preto:       { g: 'linear-gradient(135deg,#111827,#1f2937,#374151)',             l: false },
    vermelho:    { g: 'linear-gradient(135deg,#991b1b,#dc2626,#f87171)',             l: false },
    branco:      { g: 'linear-gradient(135deg,#e5e7eb,#f9fafb,#ffffff)',             l: true  },
    ciano:       { g: 'linear-gradient(135deg,#164e63,#0891b2,#67e8f9)',             l: false },
    amarelo:     { g: 'linear-gradient(135deg,#92400e,#d97706,#fcd34d)',             l: false },
    indigo:      { g: 'linear-gradient(135deg,#312e81,#4338ca,#a5b4fc)',             l: false },
    'rose-gold': { g: 'linear-gradient(135deg,#9f1239,#e11d48,#fb7185,#fda4af)',    l: false },
};

const COLOR_LABELS = {
    rosa:'Rosa', roxo:'Roxo', azul:'Azul', verde:'Verde', laranja:'Laranja',
    preto:'Preto', vermelho:'Vermelho', branco:'Branco', ciano:'Ciano',
    amarelo:'Amarelo', indigo:'Índigo', 'rose-gold':'Rose Gold',
};


const $         = id => document.getElementById(id);
const txt       = (id, v) => { const e = $(id); if (e) e.textContent = v; };
const token     = () => localStorage.getItem('auth_token');
const hdrs      = (ct = false) => ({
    'Accept': 'application/json',
    'Authorization': `Bearer ${token()}`,
    ...(ct ? { 'Content-Type': 'application/json' } : {}),
});
const avatarSrc = u =>
    u.avatar              ? u.avatar
    : u.preset_avatar != null ? `/images/avatar${u.preset_avatar}.png`
    : null;

async function req(path, method = 'GET', body = null, isForm = false) {
    const opts = { method, headers: hdrs(!isForm && body !== null) };
    if (body) opts.body = isForm ? body : JSON.stringify(body);
    const res  = await fetch(`${API}${path}`, opts);
    const data = await res.json().catch(() => ({}));
    return { ok: res.ok, data };
}

const themeBtn = $('toggleThemeBtn');
if (themeBtn) {
    themeBtn.addEventListener('click', () => {
        const h = document.documentElement;
        h.classList.toggle('dark');
        localStorage.setItem('theme', h.classList.contains('dark') ? 'dark' : 'light');
    });
}


const toastSubEl = $('toast')?.querySelector('p.text-gray-400');
let toastTimer;
function toast(msg, sub = 'Atualizado com sucesso.') {
    txt('toastMsg', msg);
    if (toastSubEl) toastSubEl.textContent = sub;
    $('toast').classList.remove('hidden');
    $('toast').classList.add('flex');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => {
        $('toast').classList.add('hidden');
        $('toast').classList.remove('flex');
    }, 3000);
}

const showErr  = (id, msg) => { const e = $(`err-${id}`); if (e) { e.textContent = msg; e.classList.remove('hidden'); } };
const clearErr = id => $(`err-${id}`)?.classList.add('hidden');


const card = {
    el:     null, name: null, email: null,
    since:  null, id:   null, photo: null,
    labels: [],   picker: [],
};

function cacheCardEls() {
    card.el     = $('studentCard');
    card.name   = $('cardName');
    card.email  = $('cardEmail');
    card.since  = $('cardSince');
    card.id     = $('cardId');
    card.photo  = $('cardPhotoWrapper');
    card.labels = [...document.querySelectorAll('#studentCard .card-static-label')];
}

function applyColor(key) {
    const c = COLORS[key]; if (!c) return;
    card.el.style.background = c.g;

    const fg    = c.l ? '#1f2937'            : '#ffffff';
    const muted = c.l ? 'rgba(55,65,81,.55)' : 'rgba(255,255,255,.5)';
    const faint = c.l ? 'rgba(55,65,81,.35)' : 'rgba(255,255,255,.3)';

    card.name.style.color  = fg;
    card.id.style.color    = fg;
    card.email.style.color = muted;
    card.since.style.color = muted;
    card.labels.forEach(e => e.style.color = faint);

    if (card.photo) {
        card.photo.style.borderColor = c.l ? 'rgba(0,0,0,.12)'  : 'rgba(255,255,255,.25)';
        card.photo.style.background  = c.l ? 'rgba(0,0,0,.05)'  : 'rgba(255,255,255,.2)';
    }

    card.picker.forEach(btn => {
        const on = btn.dataset.color === key;
        btn.classList.toggle('ring-2', on);
        btn.classList.toggle('ring-pink-500', on);
        btn.classList.toggle('ring-offset-2', on);
        btn.querySelector('.chk').style.opacity = on ? '1' : '0';
    });
}

function setPhoto(src, cover = true) {
    const img = `<img src="${src}" class="w-full h-full" style="object-fit:${cover ? 'cover' : 'contain'}">`;
    if (card.photo) card.photo.innerHTML = img;
    const pw = $('photoPreviewWrapper');
    if (pw) pw.innerHTML = `<img src="${src}" class="w-full h-full object-cover rounded-2xl">`;
}


function buildColorPicker() {
    const wrap = $('colorPicker'); if (!wrap) return;
    const frag = document.createDocumentFragment();

    for (const [key, c] of Object.entries(COLORS)) {
        const tc  = c.l ? '#374151' : '#fff';
        const btn = document.createElement('button');
        btn.type          = 'button';
        btn.dataset.color = key;
        btn.title         = COLOR_LABELS[key];
        btn.className     = 'relative rounded-xl overflow-hidden cursor-pointer transition-all duration-200 hover:scale-105 focus:outline-none';
        btn.style.cssText = `background:${c.g};aspect-ratio:16/9`;
        btn.innerHTML     = `
            <div class="chk absolute inset-0 flex items-center justify-center bg-black/10 transition-opacity" style="opacity:0">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="${tc}" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <span class="absolute bottom-1 left-0 right-0 text-center text-[9px] font-bold uppercase tracking-wider" style="color:${tc}">${COLOR_LABELS[key]}</span>`;

        btn.addEventListener('click', async () => {
            applyColor(key);
            const { ok } = await req('/profile', 'PUT', { card_color: key }).catch(() => ({ ok: false }));
            if (ok) toast('Cor da carteira salva!', 'Aparência atualizada.');
        });

        frag.appendChild(btn);
        card.picker.push(btn);
    }
    wrap.appendChild(frag);
}


function applyUser(user) {
    txt('cardName',  (user.name  || 'SEU NOME').toUpperCase());
    txt('cardEmail', user.email  || '—');
    txt('cardId',    'SL-' + String(user.id || 1).padStart(6, '0'));
    if (user.created_at)
        txt('cardSince', new Date(user.created_at).toLocaleDateString('pt-BR', { day:'2-digit', month:'2-digit', year:'numeric' }));

    const ni = $('nameInput'), ei = $('emailInput');
    if (ni) ni.value = user.name  || '';
    if (ei) ei.value = user.email || '';

    applyColor(user.card_color || 'rosa');

    const src = avatarSrc(user);
    if (src) setPhoto(src, !!user.avatar);
}

async function loadProfile() {
    const { ok, data } = await req('/user').catch(() => ({ ok: false, data: {} }));
    if (ok) applyUser(data);
}


$('nameInput').addEventListener('input',  e => { txt('cardName',  e.target.value.toUpperCase() || 'SEU NOME'); clearErr('name');  });
$('emailInput').addEventListener('input', e => { txt('cardEmail', e.target.value || '—');                     clearErr('email'); });

$('nameForm').addEventListener('submit', async e => {
    e.preventDefault();
    const name = $('nameInput').value.trim();
    if (!name) return showErr('name', 'Informe seu nome.');
    const { ok, data } = await req('/profile', 'PUT', { name }).catch(() => ({ ok: false, data: {} }));
    ok ? (applyUser(data.user), toast('Nome atualizado!')) : showErr('name', data.message || 'Erro de conexão.');
});

$('emailForm').addEventListener('submit', async e => {
    e.preventDefault();
    const email = $('emailInput').value.trim();
    if (!email.includes('@')) return showErr('email', 'E-mail inválido.');
    const { ok, data } = await req('/profile', 'PUT', { email }).catch(() => ({ ok: false, data: {} }));
    ok ? (applyUser(data.user), toast('E-mail atualizado!')) : showErr('email', data.message || 'Erro de conexão.');
});

$('passwordForm').addEventListener('submit', async e => {
    e.preventDefault();
    const current = $('currentPassword').value;
    const novo    = $('newPassword').value;
    const confirm = $('confirmPassword').value;
    if (novo !== confirm) return showErr('password', 'As senhas não coincidem.');
    if (novo.length < 8)  return showErr('password', 'Mínimo 8 caracteres.');
    const { ok, data } = await req('/profile', 'PUT', {
        current_password: current, password: novo, password_confirmation: confirm,
    }).catch(() => ({ ok: false, data: {} }));
    ok ? ($('passwordForm').reset(), toast('Senha alterada!', 'Segurança atualizada.'))
       : showErr('password', data.message || 'Erro de conexão.');
});


$('photoInput').addEventListener('change', function () {
    const file = this.files[0]; if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => setPhoto(ev.target.result, true);
    reader.readAsDataURL(file);
    $('savePhotoBtn').disabled = false;
});

$('savePhotoBtn').addEventListener('click', async () => {
    const file = $('photoInput').files[0]; if (!file) return;
    const form = new FormData();
    form.append('photo', file);
    try {
        const res  = await fetch(`${API}/profile/photo`, { method: 'POST', headers: hdrs(), body: form });
        const data = await res.json().catch(() => ({}));
        if (res.ok) {
            applyUser(data.user);
            toast('Foto atualizada!');
            $('savePhotoBtn').disabled = true;
            $('photoInput').value = '';
        } else {
            toast(data.message || 'Erro ao enviar foto.', '');
        }
    } catch { toast('Erro de conexão.', ''); }
});


const clearAuth = () => { localStorage.removeItem('auth_token'); window.location.href = '/login'; };

$('logoutBtn').addEventListener('click', async () => {
    try { await fetch(`${API}/logout`, { method: 'POST', headers: hdrs() }); } catch {}
    clearAuth();
});

$('deleteAccountBtn').addEventListener('click', () => {
    $('deleteModal').classList.remove('hidden');
    $('deleteModal').classList.add('flex');
});

$('cancelDelete').addEventListener('click', () => {
    $('deleteModal').classList.add('hidden');
    $('deleteModal').classList.remove('flex');
    const inp = $('deletePasswordInput');
    inp.value = '';
    inp.classList.remove('border-red-400');
});

$('confirmDelete').addEventListener('click', async () => {
    const inp = $('deletePasswordInput');
    if (!inp.value) return inp.classList.add('border-red-400');
    try {
        const res = await fetch(`${API}/profile`, {
            method: 'DELETE', headers: hdrs(true), body: JSON.stringify({ password: inp.value }),
        });
        res.ok ? clearAuth() : inp.classList.add('border-red-400');
    } catch { toast('Erro de conexão.', ''); }
});


cacheCardEls();
buildColorPicker();
loadProfile();