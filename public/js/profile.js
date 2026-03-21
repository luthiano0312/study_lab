'use strict';

const API = 'http://127.0.0.1:8000/api';

const COLORS = {
    rosa:        { g: 'linear-gradient(135deg,#be185d,#db2777,#f472b6)',          l: false },
    roxo:        { g: 'linear-gradient(135deg,#5b21b6,#7c3aed,#a78bfa)',          l: false },
    azul:        { g: 'linear-gradient(135deg,#1e40af,#2563eb,#60a5fa)',          l: false },
    verde:       { g: 'linear-gradient(135deg,#065f46,#059669,#34d399)',          l: false },
    laranja:     { g: 'linear-gradient(135deg,#c2410c,#ea580c,#fb923c)',          l: false },
    preto:       { g: 'linear-gradient(135deg,#111827,#1f2937,#374151)',          l: false },
    vermelho:    { g: 'linear-gradient(135deg,#991b1b,#dc2626,#f87171)',          l: false },
    branco:      { g: 'linear-gradient(135deg,#e5e7eb,#f9fafb,#ffffff)',          l: true  },
    ciano:       { g: 'linear-gradient(135deg,#164e63,#0891b2,#67e8f9)',          l: false },
    amarelo:     { g: 'linear-gradient(135deg,#92400e,#d97706,#fcd34d)',          l: false },
    indigo:      { g: 'linear-gradient(135deg,#312e81,#4338ca,#a5b4fc)',          l: false },
    'rose-gold': { g: 'linear-gradient(135deg,#9f1239,#e11d48,#fb7185,#fda4af)', l: false },
};

const COLOR_LABELS = {
    rosa:'Rosa', roxo:'Roxo', azul:'Azul', verde:'Verde', laranja:'Laranja',
    preto:'Preto', vermelho:'Vermelho', branco:'Branco', ciano:'Ciano',
    amarelo:'Amarelo', indigo:'Índigo', 'rose-gold':'Rose Gold',
};


const $   = id => document.getElementById(id);
const txt = (id, v) => { const e = $(id); if (e) e.textContent = v; };
const tok = () => localStorage.getItem('auth_token');
const hdrs = (ct = false) => ({
    'Accept': 'application/json',
    'Authorization': `Bearer ${tok()}`,
    ...(ct ? { 'Content-Type': 'application/json' } : {}),
});
const avatarSrc = u =>
    u.avatar ? u.avatar
    : u.preset_avatar != null ? `/images/avatar${u.preset_avatar}.png`
    : null;

async function req(path, method = 'GET', body = null, isForm = false) {
    try {
        const opts = { method, headers: hdrs(!isForm && body !== null) };
        if (body) opts.body = isForm ? body : JSON.stringify(body);
        const res  = await fetch(`${API}${path}`, opts);
        const data = await res.json().catch(() => ({}));
        return { ok: res.ok, status: res.status, data };
    } catch {
        return { ok: false, status: 0, data: {} };
    }
}


let toastTimer;
function toast(msg, sub = '') {
    txt('toastMsg', msg);
    const subEl = $('toast')?.querySelector('[data-toast-sub]');
    if (subEl) subEl.textContent = sub;
    $('toast')?.classList.remove('hidden');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => $('toast')?.classList.add('hidden'), 3000);
}


const showErr  = (id, msg) => { const e = $(`err-${id}`); if (e) { e.textContent = msg; e.classList.remove('hidden'); } };
const clearErr = id => $(`err-${id}`)?.classList.add('hidden');


const card = { el: null, name: null, id: null, photo: null, photoBorder: null, progress: null, picker: [] };

function cacheCardEls() {
    card.el          = $('studentCard');
    card.name        = $('cardName');
    card.id          = $('cardId');
    card.photo       = $('cardPhotoWrapper');
    card.photoBorder = $('photoBorder');
    card.progress    = $('cardProgress');
}


function applyColor(key) {
    const c = COLORS[key]; if (!c || !card.el) return;
    card.el.style.background = c.g;

    const primaryColor = c.g.match(/#[0-9a-f]{6}/gi)?.[1] || '#db2777';

    if (card.el.querySelector('#cardLabel'))
        card.el.querySelector('#cardLabel').style.color = primaryColor;
    if (card.id)   card.id.style.color       = primaryColor;
    if (card.progress) card.progress.style.backgroundColor = primaryColor;
    if (card.photoBorder) card.photoBorder.style.borderColor = primaryColor + '66';

    const inner = $('cardInner');
    if (inner) inner.style.backgroundImage = `radial-gradient(circle at top right, ${primaryColor}1a, transparent)`;

    card.picker.forEach(btn => {
        const on = btn.dataset.color === key;
        btn.classList.toggle('ring-2', on);
        btn.classList.toggle('ring-white', on);
        const chk = btn.querySelector('.chk');
        if (chk) chk.style.opacity = on ? '1' : '0';
    });
}


function setPhoto(src) {
    if (!src) return;
    if (src.startsWith('/') && !src.startsWith('//')) src = window.location.origin + src;
    const bust = src.startsWith('data:') ? src : src + '?t=' + Date.now();
    if (!card.photo) return;
    
    card.photo.classList.remove('flex', 'items-center', 'justify-center');
    card.photo.style.cssText = 'display:block;padding:0;';
    card.photo.innerHTML = `<img src="${bust}" style="width:100%;height:100%;object-fit:cover;display:block;">`;
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
        btn.className     = 'relative rounded-xl overflow-hidden cursor-pointer transition-all duration-200 hover:scale-110 focus:outline-none';
        btn.style.cssText = `background:${c.g};aspect-ratio:1`;
        btn.innerHTML     = `
            <div class="chk absolute inset-0 flex items-center justify-center bg-black/20 transition-opacity" style="opacity:0">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="${tc}" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>`;
        btn.addEventListener('click', async () => {
            applyColor(key);
            const { ok } = await req('/profile', 'PUT', { card_color: key });
            if (ok) toast('Cor salva!', 'Aparência atualizada.');
        });
        frag.appendChild(btn);
        card.picker.push(btn);
    }
    wrap.appendChild(frag);
}


function applyUser(user) {
    if (!user) return;
    txt('cardName', (user.name || 'SEU NOME').toUpperCase());
    txt('cardId',   'SL-' + String(user.id || 1).padStart(6, '0'));
    if (user.created_at)
        txt('cardSince', new Date(user.created_at).getFullYear());

    const ni = $('nameInput'),  ei = $('emailInput');
    if (ni) ni.value = user.name  || '';
    if (ei) ei.value = user.email || '';

    applyColor(user.card_color || 'rosa');

    const src = avatarSrc(user);
    if (src) setPhoto(src);
}


async function loadProfile() {
    const { ok, data } = await req('/user');
    if (ok) {
        applyUser(data);
    } else {
        
        if (data.message?.toLowerCase().includes('unauthenticated')) {
            localStorage.removeItem('auth_token');
            window.location.href = '/login';
        }
        toast('Erro ao carregar perfil.', 'Verifique sua conexão.');
    }
}


function applyTheme(dark) {
    const root = document.documentElement;
    if (dark) {
        root.classList.add('dark');
        localStorage.setItem('theme', 'dark');
    } else {
        root.classList.remove('dark');
        localStorage.setItem('theme', 'light');
    }
    
    const knob  = $('themeKnob');
    const label = $('themeLabel');
    if (knob)  knob.style.transform  = dark ? 'translateX(20px)' : 'translateX(0)';
    if (label) label.textContent     = dark ? 'Modo Dark' : 'Modo Light';
}


$('nameInput')?.addEventListener('input',  e => txt('cardName', e.target.value.toUpperCase() || 'SEU NOME'));
$('emailInput')?.addEventListener('input', e => clearErr('email'));


$('nameForm')?.addEventListener('submit', async e => {
    e.preventDefault();
    clearErr('name');
    const name = $('nameInput').value.trim();
    if (!name) return showErr('name', 'Informe seu nome.');
    const { ok, data } = await req('/profile', 'PUT', { name });
    if (ok) { applyUser(data.user || data); toast('Nome atualizado!'); }
    else showErr('name', data.message || 'Erro ao salvar.');
});

$('emailForm')?.addEventListener('submit', async e => {
    e.preventDefault();
    clearErr('email');
    const email = $('emailInput').value.trim();
    if (!email.includes('@')) return showErr('email', 'E-mail inválido.');
    const { ok, data } = await req('/profile', 'PUT', { email });
    if (ok) { applyUser(data.user || data); toast('E-mail atualizado!'); }
    else showErr('email', data.message || 'Erro ao salvar.');
});

$('passwordForm')?.addEventListener('submit', async e => {
    e.preventDefault();
    clearErr('password');
    const current = $('currentPassword').value;
    const novo    = $('newPassword').value;
    if (!current) return showErr('password', 'Informe a senha atual.');
    if (novo.length < 8) return showErr('password', 'Mínimo 8 caracteres.');
    const { ok, data } = await req('/profile', 'PUT', {
        current_password: current, password: novo, password_confirmation: novo,
    });
    if (ok) { $('passwordForm').reset(); toast('Senha alterada!', 'Segurança atualizada.'); }
    else showErr('password', data.message || data.errors?.password?.[0] || 'Erro ao salvar.');
});


$('photoInput')?.addEventListener('change', function () {
    const file = this.files[0]; if (!file) return;
    const reader = new FileReader();
    reader.onload = ev => setPhoto(ev.target.result);
    reader.readAsDataURL(file);
    const btn = $('savePhotoBtn');
    if (btn) { btn.disabled = false; btn.classList.remove('hidden'); }
});

$('savePhotoBtn')?.addEventListener('click', async () => {
    const file = $('photoInput')?.files[0]; if (!file) return;
    const btn  = $('savePhotoBtn');
    const orig = btn.textContent;
    btn.disabled = true;
    btn.textContent = 'Salvando...';

    const form = new FormData();
    form.append('photo', file);

    const res  = await fetch(`${API}/profile/photo`, { method: 'POST', headers: hdrs(), body: form });
    const data = await res.json().catch(() => ({}));

    if (res.ok) {
        const user     = data.user || data;
        const photoUrl = user.avatar || user.photo_url || user.photo || null;
        if (photoUrl) setPhoto(photoUrl);
        if (user.name) txt('cardName', user.name.toUpperCase());
        if (user.id)   txt('cardId', 'SL-' + String(user.id).padStart(6, '0'));
        toast('Foto atualizada!', 'Imagem salva com sucesso.');
        btn.textContent = 'Salvo ✓';
        if ($('photoInput')) $('photoInput').value = '';
        setTimeout(() => { btn.disabled = true; btn.textContent = orig; btn.classList.add('hidden'); }, 2500);
    } else {
        toast(data.message || 'Erro ao enviar foto.', '');
        btn.disabled = false;
        btn.textContent = orig;
    }
});


$('toggleThemeBtn')?.addEventListener('click', () => {
    const dark = !document.documentElement.classList.contains('dark');
    applyTheme(dark);
});


const clearAuth = () => { localStorage.removeItem('auth_token'); window.location.href = '/login'; };

$('logoutBtn')?.addEventListener('click', async () => {
    await req('/logout', 'POST');
    clearAuth();
});

$('deleteAccountBtn')?.addEventListener('click', () => $('deleteModal')?.classList.remove('hidden'));

$('cancelDelete')?.addEventListener('click', () => {
    $('deleteModal')?.classList.add('hidden');
    const inp = $('deletePasswordInput');
    if (inp) { inp.value = ''; inp.classList.remove('border-red-400'); }
});

$('confirmDelete')?.addEventListener('click', async () => {
    const inp = $('deletePasswordInput');
    if (!inp?.value) return inp?.classList.add('border-red-400');
    const { ok } = await req('/profile', 'DELETE', { password: inp.value });
    ok ? clearAuth() : inp.classList.add('border-red-400');
});


document.addEventListener('DOMContentLoaded', () => {

    const saved = localStorage.getItem('theme');
    applyTheme(saved !== 'light');

    cacheCardEls();
    buildColorPicker();
    loadProfile();
});