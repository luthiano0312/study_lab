
const SUBJECT_COLORS = [
    'bg-pink-100 text-pink-700',   'bg-purple-100 text-purple-700',
    'bg-blue-100 text-blue-700',   'bg-green-100 text-green-700',
    'bg-orange-100 text-orange-700', 'bg-red-100 text-red-700',
];

const STATUS = {
    pending:     { cls: 'text-yellow-500 bg-yellow-50', label: 'Pendente'     },
    in_progress: { cls: 'text-blue-500 bg-blue-50',     label: 'Em progresso' },
    completed:   { cls: 'text-green-500 bg-green-50',   label: 'Concluída'    },
};


const hdrs = () => ({
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
});
const txt       = (id, v) => { const e = document.getElementById(id); if (e) e.textContent = v; };
const isOverdue = d => d && new Date(d) < new Date(new Date().toDateString());
const avatarSrc = u => u.avatar ?? (u.preset_avatar != null ? `/images/avatar${u.preset_avatar}.png` : null);
const fmtDate   = s => { if (!s) return '—'; const [y,m,d] = s.split('-'); return `${d}/${m}/${y}`; };


async function loadUser() {
    try {
        const r = await fetch('/api/user', { headers: hdrs() });
        if (!r.ok) return;
        const u = await r.json();
        txt('userName',  u.name || 'Estudante');
        txt('greetName', u.name?.split(' ')[0] || 'Estudante');
        const src = avatarSrc(u);
        if (src) { const el = document.getElementById('userAvatar'); if (el) el.src = src; }
    } catch {}
}


async function loadActivities() {
    try {
        const r = await fetch('/api/activities', { headers: hdrs() });
        if (!r.ok) return;
        const list = await r.json();

        let pending = 0, done = 0, overdue = 0;
        for (const a of list) {
            if (a.status === 'pending')   pending++;
            if (a.status === 'completed') done++;
            if (a.status !== 'completed' && isOverdue(a.due_date)) overdue++;
        }
        txt('statPending', pending);
        txt('statDone',    done);
        txt('statOverdue', overdue);
        txt('statTotal',   list.length);

        const el = document.getElementById('recentActivities');
        if (!el) return;

        const recent = [...list]
            .sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at))
            .slice(0, 5);

        if (!recent.length) {
            el.innerHTML = `<p class="text-gray-400 text-sm text-center py-4">Nenhuma atividade ainda.</p>`;
            return;
        }

        el.innerHTML = recent.map(a => {
            const late  = a.status !== 'completed' && isOverdue(a.due_date);
            const s     = STATUS[a.status] || STATUS.pending;
            const dot   = late ? 'bg-red-400' : a.status === 'completed' ? 'bg-green-400' : 'bg-yellow-400';
            const badge = late ? 'text-red-500 bg-red-50' : s.cls;
            return `
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-2 h-2 rounded-full flex-shrink-0 ${dot}"></div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-800 truncate">${a.title || a.description || '—'}</p>
                        <p class="text-xs text-gray-400">${a.subject_name || ''}${a.due_date ? ' · ' + fmtDate(a.due_date) : ''}</p>
                    </div>
                </div>
                <span class="text-xs font-bold px-2.5 py-1 rounded-full ml-3 flex-shrink-0 ${badge}">${late ? 'Atrasada' : s.label}</span>
            </div>`;
        }).join('');
    } catch {}
}

async function loadExams() {
    try {
        const r = await fetch('/api/exams', { headers: hdrs() });
        if (!r.ok) return;

        const upcoming = (await r.json())
            .filter(e => e.status !== 'completed' && e.due_date)
            .sort((a, b) => new Date(a.due_date) - new Date(b.due_date))
            .slice(0, 4);

        const el = document.getElementById('upcomingExams');
        if (!el) return;

        if (!upcoming.length) {
            el.innerHTML = `<p class="text-gray-400 text-sm text-center py-4">Nenhuma prova próxima.</p>`;
            return;
        }

        el.innerHTML = upcoming.map(e => {
            const days   = Math.ceil((new Date(e.due_date) - new Date()) / 864e5);
            const urgent = days <= 3;
            const label  = days <= 0 ? 'Hoje!' : days === 1 ? 'Amanhã' : `${days} dias`;
            return `
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">${e.type}</p>
                    <p class="text-xs text-gray-400 truncate">${e.description || ''}</p>
                </div>
                <div class="text-right flex-shrink-0 ml-3">
                    <p class="text-xs font-bold ${urgent ? 'text-red-500' : 'text-pink-500'}">${fmtDate(e.due_date)}</p>
                    <p class="text-[10px] ${urgent ? 'text-red-400' : 'text-gray-400'}">${label}</p>
                </div>
            </div>`;
        }).join('');
    } catch {}
}


async function loadSubjects() {
    try {
        const r = await fetch('/api/subjects', { headers: hdrs() });
        if (!r.ok) return;
        const list = await r.json();
        txt('statSubjects', list.length);

        const el = document.getElementById('subjectsList');
        if (!el) return;

        el.innerHTML = list.slice(0, 6).map((s, i) => `
            <div class="flex items-center gap-2.5 py-2.5 border-b border-gray-50 last:border-0">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-black flex-shrink-0 ${SUBJECT_COLORS[i % 6]}">
                    ${(s.abbreviation || s.name || '?').substring(0, 3).toUpperCase()}
                </span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">${s.name}</p>
                    <p class="text-xs text-gray-400">${s.teacher || 'Sem professor'}</p>
                </div>
            </div>`).join('');
    } catch {}
}

function animateCounters() {
    document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.textContent) || 0;
        if (!target) return;
        let cur = 0;
        const step = Math.ceil(target / 20);
        const t = setInterval(() => {
            cur = Math.min(cur + step, target);
            el.textContent = cur;
            if (cur >= target) clearInterval(t);
        }, 40);
    });
}


const clockEl   = document.getElementById('clock');
const updateClock = () => {
    if (clockEl) clockEl.textContent = new Date().toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
};


async function init() {
    updateClock();
    setInterval(updateClock, 1000);
    await loadUser();
    await Promise.all([loadActivities(), loadExams(), loadSubjects()]);
    setTimeout(animateCounters, 100);
}

document.addEventListener('DOMContentLoaded', init);