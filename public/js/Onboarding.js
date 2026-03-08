const API_BASE = 'http://127.0.0.1:8000/api';

function authHeaders(extra = {}) {
    const token = localStorage.getItem('auth_token');
    return { 'Accept': 'application/json', 'Authorization': `Bearer ${token}`, ...extra };
}

const MASCOT = {
    1: 'Olá! Eu sou o <strong class="text-pink-500 not-italic">Prof. Lab</strong>. Vamos deixar sua conta com a sua cara!',
    2: 'Ótimo! Agora escolha a cor da sua <strong class="text-pink-500 not-italic">carteira de estudante</strong>. Qual combina com você?',
    3: 'Quase lá! Escolha um <strong class="text-pink-500 not-italic">avatar</strong> ou faça upload de uma foto sua.',
    done: 'Perfeito! Tudo pronto. Bem-vindo ao <strong class="text-pink-500 not-italic">StudyLab</strong>! 🚀',
};

const COLORS = [
    { key:'rosa',    label:'Rosa',    grad:'linear-gradient(135deg,#be185d 0%,#db2777 40%,#f472b6 100%)' },
    { key:'roxo',    label:'Roxo',    grad:'linear-gradient(135deg,#5b21b6 0%,#7c3aed 40%,#a78bfa 100%)' },
    { key:'azul',    label:'Azul',    grad:'linear-gradient(135deg,#1e40af 0%,#2563eb 40%,#60a5fa 100%)' },
    { key:'verde',   label:'Verde',   grad:'linear-gradient(135deg,#065f46 0%,#059669 40%,#34d399 100%)' },
    { key:'laranja', label:'Laranja', grad:'linear-gradient(135deg,#c2410c 0%,#ea580c 40%,#fb923c 100%)' },
    { key:'preto',   label:'Preto',   grad:'linear-gradient(135deg,#111827 0%,#1f2937 40%,#374151 100%)' },
];

const AVATAR_SEEDS = ['felix','luna','nova','zara','milo','cleo','rex','aria'];
const AVATAR_BGS   = ['#fce7f3','#ede9fe','#dbeafe','#d1fae5','#ffedd5','#fef3c7','#f3f4f6','#fce7f3'];

const state = {
    name: '', colorKey: 'rosa',
    colorGrad: COLORS[0].grad,
    avatarType: 'preset', avatarId: 0,
    avatarFile: null, avatarDataUrl: null, userId: null,
};

async function init() {
    try {
        const r = await fetch(`${API_BASE}/user`, { headers: authHeaders() });
        if (r.ok) {
            const u = await r.json();
            state.userId = u.id;
            document.getElementById('previewId').textContent = 'SL-' + String(u.id).padStart(6,'0');
        }
    } catch(e) {}
    buildColors();
    buildAvatars();
    bindEvents();
    selectColor(COLORS[0]);
    selectAvatar(0);
}

function buildColors() {
    const grid = document.getElementById('colorGrid');
    COLORS.forEach(c => {
        const btn = document.createElement('button');
        btn.className = 'color-card group relative flex flex-col items-center gap-2 p-2.5 rounded-2xl border-2 transition-all duration-200 cursor-pointer ' +
            (c.key === 'rosa'
                ? 'border-pink-400 bg-pink-50 shadow-md shadow-pink-100'
                : 'border-transparent bg-gray-50 hover:border-pink-200 hover:bg-pink-50/50');
        btn.dataset.key = c.key;
        btn.innerHTML = `
            <div class="w-full aspect-square rounded-xl shadow-sm relative overflow-hidden" style="background:${c.grad};">
                <div class="absolute inset-0 flex items-center justify-center opacity-0 transition-opacity duration-200 check-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
            </div>
            <span class="text-[10px] font-700 text-gray-500 group-hover:text-pink-500 transition-colors color-label">${c.label}</span>`;
        grid.appendChild(btn);
        btn.addEventListener('click', () => selectColor(c));
    });
}

function selectColor(c) {
    document.querySelectorAll('.color-card').forEach(b => {
        b.classList.remove('border-pink-400', 'bg-pink-50', 'shadow-md', 'shadow-pink-100');
        b.classList.add('border-transparent', 'bg-gray-50');
        b.querySelector('.check-icon')?.classList.add('opacity-0');
        b.querySelector('.color-label')?.classList.remove('text-pink-500', 'font-bold');
        b.querySelector('.color-label')?.classList.add('text-gray-500');
    });
    const active = document.querySelector(`.color-card[data-key="${c.key}"]`);
    if (active) {
        active.classList.remove('border-transparent', 'bg-gray-50');
        active.classList.add('border-pink-400', 'bg-pink-50', 'shadow-md', 'shadow-pink-100');
        active.querySelector('.check-icon')?.classList.remove('opacity-0');
        active.querySelector('.color-label')?.classList.remove('text-gray-500');
        active.querySelector('.color-label')?.classList.add('text-pink-500', 'font-bold');
    }
    state.colorKey  = c.key;
    state.colorGrad = c.grad;
    document.getElementById('cardPreview').style.background = c.grad;
}

function buildAvatars() {
    const grid = document.getElementById('avatarGrid');
    AVATAR_SEEDS.forEach((seed, i) => {
        const url = `https://api.dicebear.com/7.x/lorelei/svg?seed=${seed}&backgroundColor=transparent`;
        const btn = document.createElement('button');
        btn.className    = 'avbtn';
        btn.dataset.id   = String(i);
        btn.style.background = AVATAR_BGS[i];
        btn.innerHTML = `
            <img src="${url}" alt="avatar ${i}" loading="lazy">
            <div class="avcheck" style="opacity:0;">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>`;
        btn.addEventListener('click', () => selectAvatar(i, url));
        grid.appendChild(btn);
    });
}

function selectAvatar(id, url) {
    if (!url) url = `https://api.dicebear.com/7.x/lorelei/svg?seed=${AVATAR_SEEDS[id]}&backgroundColor=transparent`;
    document.querySelectorAll('.avbtn').forEach(b => {
        b.classList.remove('selected');
        b.style.borderColor = '#fce7f3';
        b.style.boxShadow   = 'none';
        b.style.transform   = 'scale(1)';
        const chk = b.querySelector('.avcheck');
        if (chk) chk.style.opacity = '0';
    });
    const active = [...document.querySelectorAll('.avbtn')].find(b => Number(b.dataset.id) === id);
    if (active) {
        active.classList.add('selected');
        active.style.borderColor = '#db2777';
        active.style.transform   = 'scale(1.07)';
        active.style.boxShadow   = '0 0 0 3px rgba(219,39,119,.15)';
        const chk = active.querySelector('.avcheck');
        if (chk) chk.style.opacity = '1';
    }
    state.avatarType    = 'preset';
    state.avatarId      = id;
    state.avatarDataUrl = url;
    updateCardPhoto(url, true);
}

function updateCardPhoto(src, isSvg=false) {
    const mini = document.getElementById('previewPhotoMini');
    mini.innerHTML = `<img src="${src}" style="width:100%;height:100%;object-fit:${isSvg?'contain':'cover'};">`;
}

function bindEvents() {
    document.getElementById('nameInput').addEventListener('input', () => {
        const v = document.getElementById('nameInput').value.trim();
        state.name = v;
        document.getElementById('namePreviewVal').textContent = v ? v.toUpperCase() : '—';
        document.getElementById('previewName').textContent    = v ? v.toUpperCase() : 'SEU NOME';
        document.getElementById('nextStep1').disabled = v.length < 2;
    });

    document.getElementById('nextStep1').addEventListener('click', () => goStep(2));
    document.getElementById('nextStep2').addEventListener('click', () => goStep(3));
    document.getElementById('backStep2').addEventListener('click', () => goStep(1));
    document.getElementById('backStep3').addEventListener('click', () => goStep(2));
    document.getElementById('skipAll').addEventListener('click',   () => finish(true));
    document.getElementById('finishBtn').addEventListener('click', () => finish(false));

    document.getElementById('avatarFileInput').addEventListener('change', function() {
        const file = this.files[0];
        if (!file) return;
        state.avatarType = 'upload';
        state.avatarFile = file;
        document.querySelectorAll('.avbtn').forEach(b => b.classList.remove('selected'));
        const reader = new FileReader();
        reader.onload = ev => { state.avatarDataUrl = ev.target.result; updateCardPhoto(ev.target.result, false); };
        reader.readAsDataURL(file);
    });
}

function goStep(n) {
    [1,2,3].forEach(i => {
        const el = document.getElementById(`step${i}`);
        if (i === n) { el.classList.remove('hidden'); }
        else         { el.classList.add('hidden'); }
    });

    document.getElementById('progressFill').style.width = (n/3*100) + '%';
    document.getElementById('stepLabel').textContent    = `Passo ${n} de 3`;

    [1,2,3].forEach(i => {
        const dot = document.getElementById(`dot${i}`);
        dot.className = 'w-1.5 h-1.5 rounded-full transition-all duration-300 ' +
            (i === n ? 'bg-pink-600 scale-125' : i < n ? 'bg-pink-300' : 'bg-pink-100');
    });

    document.getElementById('mascotBubble').innerHTML = MASCOT[n];
}

async function finish(skip=false) {
    document.getElementById('mascotBubble').innerHTML = MASCOT['done'];
    document.getElementById('loadingScreen').classList.remove('hidden');

    try {
        if (!skip && state.name) {
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers:authHeaders({'Content-Type':'application/json'}), body:JSON.stringify({name:state.name}) });
        }
        if (!skip && state.colorKey) {
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers:authHeaders({'Content-Type':'application/json'}), body:JSON.stringify({card_color:state.colorKey}) });
        }
        if (!skip && state.avatarType === 'upload' && state.avatarFile) {
            const form = new FormData();
            form.append('photo', state.avatarFile);
            await fetch(`${API_BASE}/profile/photo`, { method:'POST', headers:authHeaders(), body:form });
        } else if (!skip && state.avatarType === 'preset') {
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers:authHeaders({'Content-Type':'application/json'}), body:JSON.stringify({preset_avatar:state.avatarId}) });
        }
        await fetch(`${API_BASE}/profile`, { method:'PUT', headers:authHeaders({'Content-Type':'application/json'}), body:JSON.stringify({onboarding_done:true}) });
    } catch(e) { console.error(e); }

    window.location.href = '/dashboard';
}

init();