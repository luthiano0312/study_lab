'use strict';

const API_BASE = '/api';

function authHeaders(extra = {}) {
    const token = localStorage.getItem('auth_token');
    return { 'Accept': 'application/json', 'Authorization': `Bearer ${token}`, ...extra };
}

const TOTAL_STEPS = 7;

let transitioning = false;

const COLORS = [
    { key: 'rosa',      label: 'Rosa',      grad: 'linear-gradient(135deg,#be185d 0%,#db2777 40%,#f472b6 100%)',  light: false },
    { key: 'roxo',      label: 'Roxo',      grad: 'linear-gradient(135deg,#5b21b6 0%,#7c3aed 40%,#a78bfa 100%)',  light: false },
    { key: 'azul',      label: 'Azul',      grad: 'linear-gradient(135deg,#1e40af 0%,#2563eb 40%,#60a5fa 100%)',  light: false },
    { key: 'verde',     label: 'Verde',     grad: 'linear-gradient(135deg,#065f46 0%,#059669 40%,#34d399 100%)',  light: false },
    { key: 'laranja',   label: 'Laranja',   grad: 'linear-gradient(135deg,#c2410c 0%,#ea580c 40%,#fb923c 100%)',  light: false },
    { key: 'preto',     label: 'Preto',     grad: 'linear-gradient(135deg,#111827 0%,#1f2937 40%,#374151 100%)',  light: false },
    { key: 'vermelho',  label: 'Vermelho',  grad: 'linear-gradient(135deg,#991b1b 0%,#dc2626 40%,#f87171 100%)',  light: false },
    { key: 'branco',    label: 'Branco',    grad: 'linear-gradient(135deg,#e5e7eb 0%,#f9fafb 50%,#ffffff 100%)',  light: true  },
    { key: 'ciano',     label: 'Ciano',     grad: 'linear-gradient(135deg,#164e63 0%,#0891b2 40%,#67e8f9 100%)',  light: false },
    { key: 'amarelo',   label: 'Amarelo',   grad: 'linear-gradient(135deg,#92400e 0%,#d97706 40%,#fcd34d 100%)',  light: false },
    { key: 'indigo',    label: 'Índigo',    grad: 'linear-gradient(135deg,#312e81 0%,#4338ca 40%,#a5b4fc 100%)',  light: false },
    { key: 'rose-gold', label: 'Rose Gold', grad: 'linear-gradient(135deg,#9f1239 0%,#e11d48 30%,#fb7185 60%,#fda4af 100%)', light: false },
];

const THEMES = [
    { key: 'light', label: 'Light', bg: '#ffffff', sb: '#f3f3f3', lines: ['#0000ff','#001080','#a31515','#267f99','#795e26'], tc: '#555' },
    { key: 'dark',  label: 'Dark',  bg: '#1e1e1e', sb: '#252526', lines: ['#569cd6','#9cdcfe','#ce9178','#4ec9b0','#dcdcaa'], tc: '#aaa' },
];

const AVATAR_IMAGES = Array.from({ length: 16 }, (_, i) => ({ id: i + 1, url: `/images/avatar${i + 1}.png` }));

const state = {
    currentStep: 0,
    name: '',
    colorKey: 'rosa',
    colorGrad: COLORS[0].grad,
    colorLight: false,
    themeKey: 'light',
    avatarType: 'preset',
    avatarId: 1,
    avatarUrl: AVATAR_IMAGES[0].url,
    avatarFile: null,
    avatarDataUrl: null,
    userId: null,
    planKey: 'free',
};

async function init() {
    try {
        const r = await fetch(`${API_BASE}/user`, { headers: authHeaders() });
        if (r.ok) {
            const u = await r.json();
            state.userId = u.id;
            document.getElementById('previewId').textContent = 'SL-' + String(u.id).padStart(6, '0');
        }
    } catch {}

    buildDots();
    buildThemes();
    buildColors();
    buildAvatars();
    bindEvents();
    selectColor(COLORS[0]);
    selectAvatar(AVATAR_IMAGES[0]);
}

function buildDots() {
    for (let s = 0; s < TOTAL_STEPS; s++) {
        const wrap = document.getElementById(`dots${s}`);
        if (!wrap) continue;
        wrap.innerHTML = '';
        for (let i = 0; i < TOTAL_STEPS; i++) {
            const d = document.createElement('div');
            d.className = 'rounded-full transition-all duration-300 ' + (
                i === s ? 'w-4 h-2 bg-pink-500' :
                i < s   ? 'w-2 h-2 bg-pink-300' :
                           'w-2 h-2 bg-gray-200'
            );
            wrap.appendChild(d);
        }
    }
}

function goStep(n) {
    if (transitioning || n === state.currentStep) return;
    transitioning = true;

    const prev = document.getElementById(`step${state.currentStep}`);
    const next = document.getElementById(`step${n}`);
    const goingForward = n > state.currentStep;

    prev.style.transition = 'opacity 220ms ease, transform 220ms ease';
    prev.style.opacity    = '0';
    prev.style.transform  = goingForward ? 'translateY(-10px)' : 'translateY(10px)';

    setTimeout(() => {
        prev.classList.add('opacity-0', 'pointer-events-none');
        prev.style.transition = '';
        prev.style.opacity    = '';
        prev.style.transform  = '';

        next.classList.remove('opacity-0', 'pointer-events-none');
        next.style.opacity   = '0';
        next.style.transform = goingForward ? 'translateY(12px)' : 'translateY(-12px)';

        state.currentStep = n;
        buildDots();

        next.getBoundingClientRect();
        next.style.transition = 'opacity 260ms ease, transform 260ms ease';
        next.style.opacity    = '1';
        next.style.transform  = 'translateY(0)';

        if (n === 6 && window.fireConfettiBtn) {
            setTimeout(() => {
                const btn = document.getElementById('finishBtn');
                if (btn) window.fireConfettiBtn(btn);
            }, 300);
        }

        setTimeout(() => {
            next.style.transition = '';
            next.style.opacity    = '';
            next.style.transform  = '';
            transitioning = false;
        }, 280);
    }, 230);
}

function selectPlan(plan) {
    state.planKey = plan;

    const free    = document.getElementById('planFree');
    const premium = document.getElementById('planPremium');

    free.classList.toggle('border-pink-400', plan === 'free');
    free.classList.toggle('border-gray-200', plan !== 'free');
    free.querySelector('.plan-check').classList.toggle('opacity-100', plan === 'free');
    free.querySelector('.plan-check').classList.toggle('opacity-0',   plan !== 'free');

    premium.classList.toggle('border-pink-400', plan === 'premium');
    premium.classList.toggle('border-gray-200', plan !== 'premium');
    premium.querySelector('.plan-check').style.background = plan === 'premium' ? '#db2777' : '#e5e7eb';
    premium.querySelector('.plan-check').classList.toggle('opacity-100', plan === 'premium');
    premium.querySelector('.plan-check').classList.toggle('opacity-0',   plan !== 'premium');
}

function buildThemes() {
    const grid = document.getElementById('themeGrid');
    const lw = [70, 50, 85, 40, 65, 55, 75];
    const sw = [60, 40, 70, 35, 55, 45];

    THEMES.forEach((t, idx) => {
        const card = document.createElement('div');
        card.className = 'relative rounded-xl overflow-hidden border-2 cursor-pointer transition-all duration-200 hover:scale-[1.04] ' +
            (idx === 0 ? 'border-pink-500' : 'border-gray-200');
        card.style.cssText = `background:${t.bg}; aspect-ratio:4/3`;
        card.dataset.key = t.key;

        const sideLines = sw.map(w =>
            `<div class="h-[3px] rounded-sm opacity-70" style="width:${w}%;background:${t.lines[0]}"></div>`
        ).join('');
        const mainLines = [
            ...t.lines.map((c, i) => `<div class="h-[3px] rounded-sm" style="width:${lw[i % lw.length]}%;background:${c};opacity:.8"></div>`),
            ...t.lines.map((c, i) => `<div class="h-[3px] rounded-sm" style="width:${lw[(i+2) % lw.length]}%;background:${c};opacity:.35"></div>`),
        ].join('');

        card.innerHTML = `
            <div class="w-full h-full flex">
                <div class="flex flex-col gap-1 p-2" style="width:35%;background:${t.sb}">${sideLines}</div>
                <div class="flex-1 flex flex-col gap-[3px] p-2">${mainLines}</div>
            </div>
            <div class="absolute bottom-1.5 left-0 right-0 text-center text-[10px] font-semibold" style="color:${t.tc}">${t.label}</div>
            <div class="check-icon absolute top-1.5 right-1.5 w-4 h-4 bg-pink-500 rounded-full flex items-center justify-center ${idx === 0 ? 'opacity-100' : 'opacity-0'} transition-opacity duration-200">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>`;

        card.addEventListener('click', () => {
            document.querySelectorAll('#themeGrid > div').forEach(c => {
                c.classList.remove('border-pink-500'); c.classList.add('border-gray-200');
                c.querySelector('.check-icon').classList.replace('opacity-100', 'opacity-0');
            });
            card.classList.remove('border-gray-200'); card.classList.add('border-pink-500');
            card.querySelector('.check-icon').classList.replace('opacity-0', 'opacity-100');
            state.themeKey = t.key;
        });

        grid.appendChild(card);
    });
}

function buildColors() {
    const grid = document.getElementById('colorGrid');
    COLORS.forEach((c, idx) => {
        const el = document.createElement('div');
        const selBorder = c.light ? 'border-gray-500' : 'border-gray-800';
        el.className = 'relative rounded-lg border-2 cursor-pointer overflow-hidden hover:scale-[1.04] transition-all duration-200 ' +
            (idx === 0 ? selBorder : 'border-transparent');
        el.style.cssText = `background:${c.grad}; aspect-ratio:16/9`;
        el.dataset.key = c.key;
        el.dataset.selBorder = selBorder;

        const labelColor  = c.light ? 'rgba(55,65,81,.75)' : 'rgba(255,255,255,.85)';
        const checkStroke = c.light ? '#374151' : 'white';

        el.innerHTML = `
            <div class="check-overlay absolute inset-0 flex items-center justify-center bg-black/10 ${idx === 0 ? 'opacity-100' : 'opacity-0'} transition-opacity duration-200">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="${checkStroke}" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="absolute bottom-1.5 left-0 right-0 text-center text-[9px] font-semibold uppercase tracking-wider" style="color:${labelColor}">${c.label}</div>`;

        el.addEventListener('click', () => selectColor(c));
        grid.appendChild(el);
    });
}

function selectColor(c) {
    document.querySelectorAll('#colorGrid > div').forEach(el => {
        el.classList.remove('border-gray-800', 'border-gray-500');
        el.classList.add('border-transparent');
        el.querySelector('.check-overlay').classList.replace('opacity-100', 'opacity-0');
    });
    const active = document.querySelector(`#colorGrid > div[data-key="${c.key}"]`);
    if (active) {
        active.classList.remove('border-transparent');
        active.classList.add(active.dataset.selBorder);
        active.querySelector('.check-overlay').classList.replace('opacity-0', 'opacity-100');
    }

    state.colorKey   = c.key;
    state.colorGrad  = c.grad;
    state.colorLight = c.light;

    document.getElementById('cardPreview').style.background = c.grad;

    const isLight = c.light;
    document.getElementById('previewName').style.color   = isLight ? '#1f2937' : '#ffffff';
    document.getElementById('previewSchool').style.color = isLight ? 'rgba(55,65,81,.55)' : 'rgba(255,255,255,.5)';
    document.getElementById('previewId').style.color     = isLight ? 'rgba(55,65,81,.35)' : 'rgba(255,255,255,.3)';
    document.getElementById('previewYear').style.color      = isLight ? 'rgba(55,65,81,.5)'  : 'rgba(255,255,255,.6)';
    document.getElementById('previewYear').style.background = isLight ? 'rgba(0,0,0,.07)'    : 'rgba(255,255,255,.15)';

    const mini = document.getElementById('previewPhotoMini');
    mini.style.borderColor = isLight ? 'rgba(0,0,0,.12)'    : 'rgba(255,255,255,.25)';
    mini.style.background  = isLight ? 'rgba(0,0,0,.05)'    : 'rgba(255,255,255,.15)';

    document.getElementById('cardPatternOverlay').style.opacity = isLight ? '0.03' : '0.05';
}

function buildAvatars() {
    const grid = document.getElementById('avatarGrid');
    grid.innerHTML = '';

    AVATAR_IMAGES.forEach((av, i) => {
        const btn = document.createElement('button');
        btn.className = 'relative aspect-square rounded-lg border-2 overflow-hidden flex items-center justify-center hover:scale-[1.05] transition-all duration-200 bg-gray-50 ' +
            (i === 0 ? 'border-pink-500' : 'border-gray-100 hover:border-pink-200');
        btn.dataset.id = String(av.id);

        btn.innerHTML = `
            <img src="${av.url}" alt="avatar ${av.id}" loading="lazy" class="w-full h-full object-cover">
            <div class="avcheck absolute bottom-1 right-1 w-3 h-3 bg-pink-500 rounded-full flex items-center justify-center ${i === 0 ? 'opacity-100' : 'opacity-0'} transition-opacity duration-200">
                <svg width="6" height="6" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>`;

        btn.addEventListener('click', () => selectAvatar(av, btn));
        grid.appendChild(btn);
    });
}

function selectAvatar(av, btnEl) {
    document.querySelectorAll('#avatarGrid button').forEach(b => {
        b.classList.remove('border-pink-500');
        b.classList.add('border-gray-100');
        b.querySelector('.avcheck')?.classList.replace('opacity-100', 'opacity-0');
    });
    if (btnEl) {
        btnEl.classList.remove('border-gray-100');
        btnEl.classList.add('border-pink-500');
        btnEl.querySelector('.avcheck')?.classList.replace('opacity-0', 'opacity-100');
    }
    state.avatarType   = 'preset';
    state.avatarId     = av.id;
    state.avatarUrl    = av.url;
    state.avatarDataUrl = av.url;
    updateCardPhoto(av.url);
}

function updateCardPhoto(src) {
    const mini = document.getElementById('previewPhotoMini');
    mini.innerHTML = `<img src="${src}" class="w-full h-full object-cover">`;
}

function bindEvents() {
    document.getElementById('nameInput').addEventListener('input', () => {
        const v = document.getElementById('nameInput').value.trim();
        state.name = v;
        document.getElementById('namePreviewVal').textContent = v ? v.toUpperCase() : '—';
        document.getElementById('previewName').textContent    = v ? v.toUpperCase() : 'SEU NOME';
        document.getElementById('nextStep1').disabled = v.length < 2;
    });

    document.getElementById('finishBtn').addEventListener('click', () => finish(false));

    document.getElementById('avatarFileInput').addEventListener('change', function () {
        const file = this.files[0]; if (!file) return;
        state.avatarType = 'upload';
        state.avatarFile = file;
        document.querySelectorAll('#avatarGrid button').forEach(b => {
            b.classList.remove('border-pink-500');
            b.classList.add('border-gray-100');
            b.querySelector('.avcheck')?.classList.replace('opacity-100', 'opacity-0');
        });
        const reader = new FileReader();
        reader.onload = ev => { state.avatarDataUrl = ev.target.result; updateCardPhoto(ev.target.result); };
        reader.readAsDataURL(file);
    });

    document.addEventListener('keydown', e => {
        if (transitioning) return;
        if (e.key === 'Enter') {
            const step = document.getElementById(`step${state.currentStep}`);
            const btns = step?.querySelectorAll('button') ?? [];
            const last = [...btns].reverse().find(b => !b.disabled);
            if (last) last.click();
        }
        if (state.currentStep === 2) {
            const cards = [...document.querySelectorAll('#themeGrid > div')];
            const ci = cards.findIndex(c => c.classList.contains('border-pink-500'));
            if (e.key === 'ArrowRight' && ci < cards.length - 1) cards[ci + 1].click();
            if (e.key === 'ArrowLeft'  && ci > 0)                cards[ci - 1].click();
        }
    });
}

async function finish(skip = false) {
    const ld       = document.getElementById('loadingScreen');
    const lb       = document.getElementById('progressBar');
    const statusEl = document.getElementById('statusLabel');

    ld.classList.remove('hidden');
    ld.classList.add('flex');

    const messages = ['Configurando sua conta...','Salvando preferências...','Preparando o dashboard...','Quase lá...'];
    let mi = 0;
    const msgInterval = setInterval(() => {
        mi = (mi + 1) % messages.length;
        statusEl.style.transition = 'opacity .3s';
        statusEl.style.opacity = '0';
        setTimeout(() => { statusEl.textContent = messages[mi]; statusEl.style.opacity = ''; }, 300);
    }, 1800);

    const setProgress = w => { if (lb) lb.style.width = w + '%'; };

    try {
        setProgress(15);
        if (!skip && state.name)
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers: authHeaders({'Content-Type':'application/json'}), body: JSON.stringify({ name: state.name }) });

        setProgress(30);
        if (!skip && state.colorKey)
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers: authHeaders({'Content-Type':'application/json'}), body: JSON.stringify({ card_color: state.colorKey }) });

        setProgress(48);
        if (!skip && state.themeKey)
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers: authHeaders({'Content-Type':'application/json'}), body: JSON.stringify({ theme: state.themeKey }) });

        setProgress(62);
        if (!skip && state.avatarType === 'upload' && state.avatarFile) {
            const form = new FormData();
            form.append('photo', state.avatarFile);
            await fetch(`${API_BASE}/profile/photo`, { method:'POST', headers: authHeaders(), body: form });
        } else if (!skip && state.avatarType === 'preset' && state.avatarId) {
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers: authHeaders({'Content-Type':'application/json'}), body: JSON.stringify({ preset_avatar: state.avatarId }) });
        }

        setProgress(78);
        if (!skip && state.planKey)
            await fetch(`${API_BASE}/profile`, { method:'PUT', headers: authHeaders({'Content-Type':'application/json'}), body: JSON.stringify({ plan: state.planKey }) });

        setProgress(92);
        await fetch(`${API_BASE}/profile`, { method:'PUT', headers: authHeaders({'Content-Type':'application/json'}), body: JSON.stringify({ onboarding_done: true }) });

        localStorage.setItem('theme', state.themeKey === 'dark' ? 'dark' : 'light');
        setProgress(100);
    } catch (e) { console.error(e); }

    clearInterval(msgInterval);
    setTimeout(() => {
        ld.classList.add('done');
        setTimeout(() => { window.location.href = '/dashboard'; }, 500);
    }, 400);
}

init();