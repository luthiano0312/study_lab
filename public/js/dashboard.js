const TOKEN = () => localStorage.getItem('auth_token');

function authHeaders() {
    return {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'Authorization': `Bearer ${TOKEN()}`
    };
}

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const [y, m, d] = dateStr.split('-');
    return `${d}/${m}/${y}`;
}

function isOverdue(dateStr) {
    if (!dateStr) return false;
    return new Date(dateStr) < new Date(new Date().toDateString());
}

async function loadUser() {
    try {
        const r = await fetch('/api/user', { headers: authHeaders() });
        if (!r.ok) return;
        const user = await r.json();

        const nameEl = document.getElementById('userName');
        const avatarEl = document.getElementById('userAvatar');
        const greetEl = document.getElementById('greetName');

        if (nameEl) nameEl.textContent = user.name || 'Estudante';
        if (greetEl) greetEl.textContent = user.name ? user.name.split(' ')[0] : 'Estudante';
        if (avatarEl && user.avatar) avatarEl.src = user.avatar;
    } catch {}
}

async function loadActivities() {
    try {
        const r = await fetch('/api/activities', { headers: authHeaders() });
        if (!r.ok) return;
        const activities = await r.json();

        const pending   = activities.filter(a => a.status === 'pending');
        const done      = activities.filter(a => a.status === 'completed');
        const overdue   = activities.filter(a => a.status !== 'completed' && isOverdue(a.due_date));

        setText('statPending',   pending.length);
        setText('statDone',      done.length);
        setText('statOverdue',   overdue.length);
        setText('statTotal',     activities.length);

        const recentEl = document.getElementById('recentActivities');
        if (recentEl) {
            const recent = [...activities]
                .sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at))
                .slice(0, 5);

            if (!recent.length) {
                recentEl.innerHTML = `<p class="text-gray-400 text-sm text-center py-4">Nenhuma atividade ainda.</p>`;
                return;
            }

            recentEl.innerHTML = recent.map(a => {
                const statusMap = {
                    pending:     { cls: 'text-yellow-500 bg-yellow-50',  label: 'Pendente' },
                    in_progress: { cls: 'text-blue-500 bg-blue-50',      label: 'Em progresso' },
                    completed:   { cls: 'text-green-500 bg-green-50',    label: 'Concluída' },
                };
                const s = statusMap[a.status] || statusMap.pending;
                const late = a.status !== 'completed' && isOverdue(a.due_date);

                return `
                <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                    <div class="flex items-center gap-3 min-w-0">
                        <div class="w-2 h-2 rounded-full flex-shrink-0 ${late ? 'bg-red-400' : a.status === 'completed' ? 'bg-green-400' : 'bg-yellow-400'}"></div>
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-gray-800 truncate">${a.title || a.description || '—'}</p>
                            <p class="text-xs text-gray-400">${a.subject_name || ''} ${a.due_date ? '· ' + formatDate(a.due_date) : ''}</p>
                        </div>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full ml-3 flex-shrink-0 ${late ? 'text-red-500 bg-red-50' : s.cls}">${late ? 'Atrasada' : s.label}</span>
                </div>`;
            }).join('');
        }
    } catch {}
}

async function loadExams() {
    try {
        const r = await fetch('/api/exams', { headers: authHeaders() });
        if (!r.ok) return;
        const exams = await r.json();

        const upcoming = exams
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
            const daysLeft = Math.ceil((new Date(e.due_date) - new Date()) / (1000 * 60 * 60 * 24));
            const urgent = daysLeft <= 3;
            return `
            <div class="flex items-center justify-between py-3 border-b border-gray-50 last:border-0">
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">${e.type}</p>
                    <p class="text-xs text-gray-400 truncate">${e.description}</p>
                </div>
                <div class="text-right flex-shrink-0 ml-3">
                    <p class="text-xs font-bold ${urgent ? 'text-red-500' : 'text-pink-500'}">${formatDate(e.due_date)}</p>
                    <p class="text-[10px] ${urgent ? 'text-red-400' : 'text-gray-400'}">${daysLeft <= 0 ? 'Hoje!' : daysLeft === 1 ? 'Amanhã' : daysLeft + ' dias'}</p>
                </div>
            </div>`;
        }).join('');
    } catch {}
}

async function loadSubjects() {
    try {
        const r = await fetch('/api/subjects', { headers: authHeaders() });
        if (!r.ok) return;
        const subjects = await r.json();
        setText('statSubjects', subjects.length);

        const el = document.getElementById('subjectsList');
        if (!el) return;

        const colors = ['bg-pink-100 text-pink-700', 'bg-purple-100 text-purple-700', 'bg-blue-100 text-blue-700', 'bg-green-100 text-green-700', 'bg-orange-100 text-orange-700', 'bg-red-100 text-red-700'];

        el.innerHTML = subjects.slice(0, 6).map((s, i) => `
            <div class="flex items-center gap-2.5 py-2.5 border-b border-gray-50 last:border-0">
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-black flex-shrink-0 ${colors[i % colors.length]}">${(s.abbreviation || s.name || '?').substring(0,3).toUpperCase()}</span>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-800 truncate">${s.name}</p>
                    <p class="text-xs text-gray-400">${s.teacher || 'Sem professor'}</p>
                </div>
            </div>
        `).join('');
    } catch {}
}

function setText(id, val) {
    const el = document.getElementById(id);
    if (el) el.textContent = val;
}

function animateCounters() {
    document.querySelectorAll('[data-counter]').forEach(el => {
        const target = parseInt(el.textContent) || 0;
        let current = 0;
        const step = Math.ceil(target / 20);
        const timer = setInterval(() => {
            current = Math.min(current + step, target);
            el.textContent = current;
            if (current >= target) clearInterval(timer);
        }, 40);
    });
}

function updateClock() {
    const el = document.getElementById('clock');
    if (!el) return;
    const now = new Date();
    el.textContent = now.toLocaleTimeString('pt-BR', { hour: '2-digit', minute: '2-digit' });
}

async function init() {
    updateClock();
    setInterval(updateClock, 1000);

    await loadUser();
    await Promise.all([loadActivities(), loadExams(), loadSubjects()]);

    setTimeout(animateCounters, 100);
}

document.addEventListener('DOMContentLoaded', init);