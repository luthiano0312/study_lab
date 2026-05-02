"use strict";
// v1.5.1 - Dashboard Intelligence & Theme Sync
// Layout: Slider | Gamification | Efficiency | Timeline | Subjects

// ── helpers ─────────────────────────────────────────────────────────────────
const MONTHS = ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"];
const DAYS = ["Domingo", "Segunda", "Terça", "Quarta", "Quinta", "Sexta", "Sábado"];
const RANKS = ["Explorador", "Aprendiz", "Iniciado", "Veterano", "Mestre", "Lendário", "Imortal"];

const SLIDES = [
    { q: "A educação é a arma mais poderosa que você pode usar para mudar o mundo.", a: "Nelson Mandela" },
    { q: "O sucesso não é o fim, o fracasso não é fatal: é a coragem de continuar que conta.", a: "Winston Churchill" },
    { q: "Não é porque as coisas são difíceis que não ousamos; é porque não ousamos que elas são difíceis.", a: "Sêneca" },
    { q: "A sorte favorece a mente preparada.", a: "Louis Pasteur" },
    { q: "Foque no progresso, não na perfeição.", a: "Estudo Consciente" },
    { q: "A mente que se abre a uma nova ideia jamais voltará ao seu tamanho original.", a: "Albert Einstein" }
];

const PINK = "#db2777";
const CYAN = "#22d3ee";
const AMBER = "#fbbf24";

const $ = (id) => document.getElementById(id);
const hdrs = () => ({
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer " + localStorage.getItem("auth_token"),
});

const isDark = () => document.documentElement.classList.contains("dark");
const GRID = () => (isDark() ? "rgba(255,255,255,0.05)" : "rgba(0,0,0,0.05)");
const TICK = () => (isDark() ? "#9ca3af" : "#4b5563");

// Global instances
let chartWeek, chartSubjects, chartWeeklyLoad;
let currentSlide = 0;
let lastData = null;

// ── initialization ──────────────────────────────────────────────────────────
document.addEventListener("DOMContentLoaded", async () => {
    updateClock();
    setInterval(updateClock, 1000);
    initQuoteSlider();

    // Listen for theme changes from header.js
    window.addEventListener('themeChanged', () => {
        if (lastData) renderCharts(lastData);
    });

    // Initial attempt from local storage
    const cache = JSON.parse(localStorage.getItem('user_cache') || '{}');
    const data  = JSON.parse(localStorage.getItem('user_data') || '{}');
    const user  = JSON.parse(localStorage.getItem('user') || '{}');
    
    const fullName = cache.name || data.name || user.name || "Estudante";
    const firstName = fullName.split(' ')[0];
    if ($("greetName")) $("greetName").innerText = firstName;

    await Promise.all([
        fetchUserInfo(), 
        loadActivities(),
        loadExams(),
        loadSubjects()
    ]);

    initCounters();
});

function initQuoteSlider() {
    const qEl = $("slideQuote");
    const aEl = $("slideAuthor");
    if (!qEl || !aEl) return;

    setInterval(() => {
        currentSlide = (currentSlide + 1) % SLIDES.length;
        qEl.style.opacity = 0;
        aEl.style.opacity = 0;

        setTimeout(() => {
            qEl.innerText = `"${SLIDES[currentSlide].q}"`;
            aEl.innerText = SLIDES[currentSlide].a;
            [0, 1, 2].forEach(i => {
                const dot = $(`dot${i}`);
                if (dot) {
                    const active = i === (currentSlide % 3);
                    dot.style.width = active ? "24px" : "8px";
                    dot.style.opacity = active ? "1" : "0.3";
                }
            });
            qEl.style.opacity = 1;
            aEl.style.opacity = 1;
        }, 500);
    }, 6000);
}

function updateClock() {
    const now = new Date();
    if ($("clock")) $("clock").innerText = now.toLocaleTimeString("pt-BR", { hour: "2-digit", minute: "2-digit" });
    if ($("headerDate")) {
        $("headerDate").innerText = `${DAYS[now.getDay()]}, ${String(now.getDate()).padStart(2, '0')} ${MONTHS[now.getMonth()]}`;
    }
}

async function fetchUserInfo() {
    try {
        const res = await fetch("/api/user", { headers: hdrs() });
        if (res.ok) {
            const user = await res.json();
            if ($("greetName") && user.name) {
                $("greetName").innerText = user.name.split(' ')[0];
                localStorage.setItem('user_cache', JSON.stringify({ name: user.name, avatarUrl: user.avatar }));
            }
        }
    } catch (e) {}
}

function initCounters() {
    document.querySelectorAll("[data-counter]").forEach((el) => {
        const target = parseInt(el.innerText) || 0;
        if (!target) return;
        let count = 0;
        const step = () => {
            count += Math.ceil(target / 100);
            if (count > target) count = target;
            el.innerText = count;
            if (count < target) requestAnimationFrame(step);
        };
        step();
    });
}

// ── data loading ────────────────────────────────────────────────────────────
async function loadActivities() {
    try {
        const res = await fetch("/api/activities", { headers: hdrs() });
        if (!res.ok) return;
        const list = await res.json();
        lastData = list;

        const done = list.filter(a => a.status === 'completed').length;
        const total = list.length;
        const efficiency = total > 0 ? Math.round((done / total) * 100) : 0;
        const level = Math.floor((done * 150) / 1000) + 1;

        if ($("statTotal")) $("statTotal").innerText = total;
        if ($("statDone")) $("statDone").innerText = done;
        if ($("statPending")) $("statPending").innerText = list.filter(a => a.status === 'pending').length;
        if ($("statOverdue")) $("statOverdue").innerText = list.filter(a => a.status === 'overdue').length;

        if ($("userLevelBadge")) $("userLevelBadge").innerText = `Nível ${level}`;
        if ($("userLevel")) $("userLevel").innerText = level;
        if ($("rankName")) $("rankName").innerText = RANKS[Math.min(level - 1, RANKS.length - 1)];
        if ($("totalXP")) $("totalXP").innerText = (done * 150) + " XP";
        if ($("currentXP")) $("currentXP").innerText = (done * 150) % 1000;
        if ($("xpBar")) $("xpBar").style.width = ((done * 150) % 1000 / 10) + "%";
        if ($("completionRate")) $("completionRate").innerText = efficiency + "%";
        if ($("completionBar")) $("completionBar").style.width = efficiency + "%";

        if ($("userStreak")) $("userStreak").innerText = calculateStreak(list.filter(a => a.status === 'completed'));

        renderCharts(list);
        renderRecentActivities(list.slice(0, 5));
        renderVisualTimeline(list);
        renderEfficiencyBreakdown(done, list.filter(a => a.status === 'pending').length, list.filter(a => a.status === 'overdue').length);

    } catch (e) {}
}

function renderCharts(list) {
    const last7 = [...Array(7)].map((_, i) => {
        const d = new Date();
        d.setDate(d.getDate() - (6 - i));
        return d.toISOString().split("T")[0];
    });

    const completed = last7.map(d => list.filter(a => a.due_date === d && a.status === 'completed').length);
    const overdue = last7.map(d => list.filter(a => a.due_date === d && a.status === 'overdue').length);
    const load = last7.map(d => list.filter(a => a.due_date === d).length);

    buildChartWeek(last7.map(d => DAYS[new Date(d).getDay()].slice(0, 3)), completed, overdue);
    buildChartWeeklyLoad(last7.map(d => DAYS[new Date(d).getDay()].slice(0, 3)), load);

    const subjects = [...new Set(list.map(a => a.subject_name))].filter(Boolean);
    const subData = subjects.map(s => list.filter(a => a.subject_name === s).length);
    buildChartSubjects(subjects.length ? subjects : ["Geral"], subData.length ? subData : [list.length]);
}

function calculateStreak(completed) {
    if (!completed.length) return 0;
    const dates = [...new Set(completed.map(a => a.due_date))].sort().reverse();
    const today = new Date().toISOString().split("T")[0];
    if (dates[0] < today) {
        const yest = new Date(); yest.setDate(yest.getDate() - 1);
        if (dates[0] < yest.toISOString().split("T")[0]) return 0;
    }
    let s = 1;
    for (let i = 0; i < dates.length - 1; i++) {
        const d1 = new Date(dates[i]), d2 = new Date(dates[i+1]);
        if ((d1 - d2) / 864e5 === 1) s++; else break;
    }
    return s;
}

async function loadExams() {
    try {
        const res = await fetch("/api/exams", { headers: hdrs() });
        const list = res.ok ? await res.json() : [];
        const next = list.sort((a,b) => new Date(a.due_date) - new Date(b.due_date))[0];
        if (next && $("nextExamCard")) {
            $("nextExamCard").innerHTML = `<p class="text-white font-black text-xl mb-1">${next.type}</p><p class="text-white/70 text-[10px] font-bold uppercase tracking-widest">📅 ${new Date(next.due_date).toLocaleDateString('pt-BR')}</p>`;
        }
    } catch (e) {}
}

async function loadSubjects() {
    try {
        const res = await fetch("/api/subjects", { headers: hdrs() });
        const list = res.ok ? await res.json() : [];
        if ($("statSubjects")) $("statSubjects").innerText = list.length;
        if ($("subjectsList")) {
            $("subjectsList").innerHTML = list.slice(0, 4).map(s => `
                <div class="flex items-center gap-3 px-5 py-3">
                    <div class="w-9 h-7 rounded-lg bg-pink-50 dark:bg-pink-900/20 flex items-center justify-center text-[10px] font-black text-pink-600 dark:text-pink-400 border border-pink-100/50 dark:border-pink-800/30">${s.abbreviation || '??'}</div>
                    <div class="flex-1 truncate"><p class="text-xs font-bold text-gray-900 dark:text-gray-100 truncate">${s.name}</p></div>
                </div>
            `).join('');
        }
    } catch (e) {}
}

function buildChartWeek(labels, completed, overdue) {
    const ctx = $("chartWeek"); if (!ctx) return;
    if (chartWeek) chartWeek.destroy();
    chartWeek = new Chart(ctx, {
        type: "line",
        data: { labels, datasets: [
            { label: "Concluídas", data: completed, borderColor: PINK, backgroundColor: "rgba(219, 39, 119, 0.1)", fill: true, tension: 0.4, borderWidth: 3 },
            { label: "Atrasadas", data: overdue, borderColor: "#f87171", borderDash: [5, 5], fill: false, tension: 0.4, borderWidth: 2 }
        ]},
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
            scales: { x: { grid: { display: false }, ticks: { color: TICK(), font: { size: 10, weight: "600" } } },
                      y: { grid: { color: GRID() }, ticks: { color: TICK(), font: { size: 10 } }, beginAtZero: true } }
        }
    });
}

function buildChartSubjects(labels, data) {
    const ctx = $("chartSubjects"); if (!ctx) return;
    if (chartSubjects) chartSubjects.destroy();
    chartSubjects = new Chart(ctx, {
        type: "bar",
        data: { labels, datasets: [{ data, backgroundColor: PINK, borderRadius: 8, barThickness: 12 }]},
        options: { indexAxis: 'y', responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
            scales: { x: { grid: { color: GRID() }, ticks: { color: TICK(), font: { size: 10 } }, beginAtZero: true },
                      y: { grid: { display: false }, ticks: { color: TICK(), font: { size: 10, weight: "700" } } } }
        }
    });
}

function buildChartWeeklyLoad(labels, data) {
    const ctx = $("chartWeeklyLoad"); if (!ctx) return;
    if (chartWeeklyLoad) chartWeeklyLoad.destroy();
    chartWeeklyLoad = new Chart(ctx, {
        type: "bar",
        data: { labels, datasets: [{ data, backgroundColor: isDark() ? "rgba(219, 39, 119, 0.4)" : "rgba(219, 39, 119, 0.1)", borderColor: PINK, borderWidth: 1, borderRadius: 6, barThickness: 24 }]},
        options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } },
            scales: { x: { grid: { display: false }, ticks: { color: TICK(), font: { size: 10, weight: "600" } } },
                      y: { grid: { color: GRID() }, ticks: { color: TICK(), font: { size: 10 } }, beginAtZero: true } }
        }
    });
}

function renderEfficiencyBreakdown(done, pending, overdue) {
    if ($("completionBreakdown")) {
        $("completionBreakdown").innerHTML = `
            <div class="flex items-center justify-between"><div class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-green-500"></div><span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Concluídas</span></div><span class="text-[10px] font-black text-gray-900 dark:text-white">${done}</span></div>
            <div class="flex items-center justify-between"><div class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-amber-500"></div><span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Pendentes</span></div><span class="text-[10px] font-black text-gray-900 dark:text-white">${pending}</span></div>
            <div class="flex items-center justify-between"><div class="flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-red-500"></div><span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Atrasadas</span></div><span class="text-[10px] font-black text-gray-900 dark:text-white">${overdue}</span></div>
        `;
    }
}

function renderRecentActivities(list) {
    const container = $("recentActivities");
    if (!container) return;
    if (list.length === 0) {
        container.innerHTML = `<div class="p-10 text-center text-gray-400 text-[11px] font-bold uppercase tracking-widest">Nenhuma atividade recente</div>`;
        return;
    }
    container.innerHTML = list.map(a => `
        <div class="group mx-4 my-2 px-6 py-5 flex items-center justify-between bg-white dark:bg-[#1c1c1f] rounded-2xl border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-md hover:border-pink-200 dark:hover:border-pink-900/50 transition-all duration-300">
            <div class="flex items-center gap-5 flex-1 min-w-0">
                <div class="w-12 h-12 rounded-2xl bg-pink-50 dark:bg-pink-900/20 flex items-center justify-center shrink-0 group-hover:rotate-6 transition-transform">
                    <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="truncate">
                    <p class="text-sm font-black text-gray-900 dark:text-gray-100 truncate mb-1" style="font-family:'Unbounded',sans-serif;">${a.description}</p>
                    <div class="flex items-center gap-3">
                        <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">${new Date(a.due_date).toLocaleDateString('pt-BR')}</span>
                        <span class="text-[10px] font-black text-pink-500 bg-pink-50 dark:bg-pink-900/30 px-2 py-0.5 rounded-md uppercase tracking-widest">${a.subject_name || 'Geral'}</span>
                    </div>
                </div>
            </div>
            <div class="ml-6 shrink-0">
                <span class="text-[9px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest 
                    ${a.status === 'completed' ? 'bg-green-500 text-white shadow-lg shadow-green-500/20' : 
                      a.status === 'overdue' ? 'bg-red-500 text-white shadow-lg shadow-red-500/20' : 
                      'bg-amber-500 text-white shadow-lg shadow-amber-500/20'}">
                    ${a.status === 'completed' ? 'Concluído' : a.status === 'overdue' ? 'Atrasado' : 'Pendente'}
                </span>
            </div>
        </div>
    `).join('');
}

function renderVisualTimeline(list) {
    const container = $("visualTimeline");
    if (!container) return;
    const sorted = list.filter(a => a.status !== 'completed')
                      .sort((a,b) => new Date(a.due_date) - new Date(b.due_date))
                      .slice(0, 4);
    
    if (sorted.length === 0) {
        container.innerHTML = `<p class="text-center text-[10px] font-bold text-gray-400 py-4 uppercase tracking-widest">Tudo em dia!</p>`;
        return;
    }

    container.innerHTML = sorted.map((a, i) => `
        <div class="flex gap-6 relative group">
            ${i < sorted.length - 1 ? `<div class="absolute left-[15.5px] top-8 w-[1px] h-[calc(100%-16px)] bg-gray-100 dark:bg-gray-800/60"></div>` : ''}
            
            <div class="relative">
                <div class="w-8 h-8 rounded-full ${a.status === 'overdue' ? 'bg-red-500/10 border-red-500/30' : 'bg-pink-500/10 border-pink-500/30'} border flex items-center justify-center shrink-0 z-10 group-hover:scale-110 transition-transform shadow-sm bg-white dark:bg-[#18181b]">
                    <span class="text-[10px] font-black ${a.status === 'overdue' ? 'text-red-500' : 'text-pink-500'}">${new Date(a.due_date).getDate()}</span>
                </div>
            </div>

            <div class="flex-1 pb-6 min-w-0">
                <p class="text-[11px] font-black text-gray-900 dark:text-white leading-tight truncate mb-1" style="font-family:'Unbounded',sans-serif;">${a.description}</p>
                <div class="flex items-center gap-2">
                    <span class="text-[8px] font-black ${a.status === 'overdue' ? 'text-red-400' : 'text-pink-500'} uppercase tracking-widest">${a.status === 'overdue' ? 'Atrasado' : 'Próximo'}</span>
                    <span class="text-[8px] font-bold text-gray-400 uppercase tracking-widest truncate">${a.subject_name || 'Estudo'}</span>
                </div>
            </div>
        </div>
    `).join('');
}
