"use strict";

// ── helpers ─────────────────────────────────────────────────────────────────
const MONTHS = [
    "Jan",
    "Fev",
    "Mar",
    "Abr",
    "Mai",
    "Jun",
    "Jul",
    "Ago",
    "Set",
    "Out",
    "Nov",
    "Dez",
];
const DAYS = ["Dom", "Seg", "Ter", "Qua", "Qui", "Sex", "Sáb"];

const SUBJECT_COLORS = [
    ["#fce7f3", "#9d174d"],
    ["#ede9fe", "#5b21b6"],
    ["#dbeafe", "#1e40af"],
    ["#dcfce7", "#166534"],
    ["#fef9c3", "#854d0e"],
    ["#fee2e2", "#991b1b"],
];

const STATUS_MAP = {
    pending: ["#b45309", "#fef9c3", "Pendente"],
    in_progress: ["#1d4ed8", "#dbeafe", "Progresso"],
    completed: ["#166534", "#dcfce7", "Concluída"],
};

const isDark = () => document.documentElement.classList.contains("dark");
const $ = (id) => document.getElementById(id);
const txt = (id, v) => {
    const e = $(id);
    if (e) e.textContent = v;
};
const hdrs = () => ({
    "Content-Type": "application/json",
    Accept: "application/json",
    Authorization: `Bearer ${localStorage.getItem("auth_token")}`,
});
const isOverdue = (d) => d && new Date(d) < new Date(new Date().toDateString());
const avatarSrc = (u) =>
    u.avatar ??
    (u.preset_avatar != null ? `/images/avatar${u.preset_avatar}.png` : null);
const fmtDate = (s) => {
    if (!s) return "—";
    const [y, m, d] = s.split("-");
    return `${d}/${m}/${y}`;
};
const badge = (color, bg, label) =>
    `<span class="text-xs font-bold px-2.5 py-1 rounded-full ml-3 shrink-0 whitespace-nowrap" style="color:${color};background:${bg}">${label}</span>`;

// Chart.js default: no animation-loop, respect dark mode
Chart.defaults.animation.duration = 700;
Chart.defaults.font.family = "'DM Sans', sans-serif";

// ── COLOR PALETTE ────────────────────────────────────────────────────────────
const PINK = "#db2777";
const PINK_L = "rgba(219,39,119,.12)";
const RED = "#f87171";
const RED_L = "rgba(248,113,113,.12)";
const GRID = () => (isDark() ? "rgba(255,255,255,.05)" : "rgba(0,0,0,.05)");
const TICK = () => (isDark() ? "rgba(255,255,255,.35)" : "rgba(0,0,0,.35)");

// ── CHARTS STATE ─────────────────────────────────────────────────────────────
let chartStatus = null;
let chartWeek = null;
let chartSubjects = null;

// ── CLOCK ───────────────────────────────────────────────────────────────────
function startClock() {
    const el = $("clock");
    const tick = () => {
        if (el)
            el.textContent = new Date().toLocaleTimeString("pt-BR", {
                hour: "2-digit",
                minute: "2-digit",
            });
    };
    tick();
    setInterval(tick, 1000);
}

// ── USER ────────────────────────────────────────────────────────────────────
async function loadUser() {
    try {
        const r = await fetch("/api/user", { headers: hdrs() });
        if (!r.ok) return;
        const u = await r.json();

        txt("headerUserName", u.name || "Estudante");
        txt("welcomeName", u.name || "Estudante");
        txt("greetName", u.name?.split(" ")[0] || "Estudante");

        // Cache for fast header render
        localStorage.setItem(
            "user_cache",
            JSON.stringify({
                name: u.name,
                avatarUrl: avatarSrc(u),
            }),
        );

        const src = avatarSrc(u);
        if (src) {
            ["userAvatar", "headerAvatar"].forEach((id) => {
                const el = $(id);
                if (!el) return;
                el.src = src;
                el.classList.remove("hidden");
            });
            [$("avatarFallback"), $("headerAvatarFallback")].forEach((el) => {
                if (el) el.style.display = "none";
            });
        }
    } catch {}
}

// ── ACTIVITIES ───────────────────────────────────────────────────────────────
async function loadActivities() {
    try {
        const r = await fetch("/api/activities", { headers: hdrs() });
        if (!r.ok) return;
        const list = await r.json();

        // Stats
        let p = 0,
            d = 0,
            o = 0,
            inprog = 0;
        const last7 = Array(7)
            .fill(0)
            .map((_, i) => {
                const dt = new Date();
                dt.setDate(dt.getDate() - i);
                return dt.toISOString().split("T")[0];
            })
            .reverse();
        const completedByDay = Object.fromEntries(last7.map((d) => [d, 0]));
        const overdueByDay = Object.fromEntries(last7.map((d) => [d, 0]));
        const bySubject = {};

        for (const a of list) {
            if (a.status === "pending") p++;
            if (a.status === "completed") d++;
            if (a.status === "in_progress") inprog++;
            if (a.status !== "completed" && isOverdue(a.due_date)) o++;

            // Week chart data
            const day = a.updated_at?.split("T")[0] ?? a.due_date;
            if (a.status === "completed" && completedByDay[day] !== undefined)
                completedByDay[day]++;
            if (
                a.status !== "completed" &&
                isOverdue(a.due_date) &&
                overdueByDay[day] !== undefined
            )
                overdueByDay[day]++;

            // Subject chart data
            const sub = a.subject_name || "Sem matéria";
            bySubject[sub] = (bySubject[sub] || 0) + 1;
        }

        txt("statPending", p);
        txt("statDone", d);
        txt("statOverdue", o);
        txt("statTotal", list.length);

        // Completion rate
        const total = list.length;
        const rate = total ? Math.round((d / total) * 100) : 0;
        txt("completionRate", rate + "%");
        setTimeout(() => {
            const bar = $("completionBar");
            if (bar) bar.style.width = rate + "%";
        }, 300);

        // Breakdown bars
        const bd = $("completionBreakdown");
        if (bd) {
            const items = [
                {
                    label: "Concluídas",
                    val: d,
                    color: "#22c55e",
                    bg: "bg-green-500",
                },
                {
                    label: "Pendentes",
                    val: p,
                    color: "#eab308",
                    bg: "bg-yellow-400",
                },
                {
                    label: "Em progresso",
                    val: inprog,
                    color: "#3b82f6",
                    bg: "bg-blue-500",
                },
                {
                    label: "Atrasadas",
                    val: o,
                    color: "#ef4444",
                    bg: "bg-red-500",
                },
            ];
            bd.innerHTML = items
                .map((it) => {
                    const pct = total ? Math.round((it.val / total) * 100) : 0;
                    return `<div class="flex items-center gap-2">
                    <span class="text-[10px] font-bold text-gray-500 dark:text-gray-400 w-[72px] shrink-0">${it.label}</span>
                    <div class="flex-1 h-1.5 rounded-full bg-gray-100 dark:bg-gray-800 overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-700" style="width:${pct}%;background:${it.color}"></div>
                    </div>
                    <span class="text-[10px] font-black tabular-nums w-6 text-right" style="color:${it.color}">${it.val}</span>
                </div>`;
                })
                .join("");
        }

        // Recent activities list
        const el = $("recentActivities");
        if (el) {
            const recent = [...list]
                .sort((a, b) => new Date(b.updated_at) - new Date(a.updated_at))
                .slice(0, 5);
            if (!recent.length) {
                el.innerHTML =
                    '<p class="text-center text-sm text-gray-400 py-6">Nenhuma atividade ainda.</p>';
            } else {
                el.innerHTML = recent
                    .map((a) => {
                        const late =
                            a.status !== "completed" && isOverdue(a.due_date);
                        const [color, bg, label] = late
                            ? ["#dc2626", "#fee2e2", "Atrasada"]
                            : STATUS_MAP[a.status] || STATUS_MAP.pending;
                        const dot = late
                            ? "#ef4444"
                            : a.status === "completed"
                              ? "#22c55e"
                              : "#eab308";
                        return `<div class="flex items-center justify-between px-6 py-3 hover:bg-pink-50/60 dark:hover:bg-pink-500/5 transition-colors">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="w-2 h-2 rounded-full shrink-0" style="background:${dot}"></div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">${a.title || a.description || "—"}</p>
                                <p class="text-xs text-gray-400">${a.subject_name || ""}${a.due_date ? " · " + fmtDate(a.due_date) : ""}</p>
                            </div>
                        </div>
                        ${badge(color, bg, label)}
                    </div>`;
                    })
                    .join("");
            }
        }

        // ── CHART: Status donut ──────────────────────────────────────────
        buildChartStatus({
            pending: p,
            completed: d,
            in_progress: inprog,
            overdue: o,
        });

        // ── CHART: Week line ─────────────────────────────────────────────
        buildChartWeek(
            last7.map((d) => DAYS[new Date(d).getDay()]),
            last7.map((d) => completedByDay[d]),
            last7.map((d) => overdueByDay[d]),
        );

        // ── CHART: By subject ────────────────────────────────────────────
        const subNames = Object.keys(bySubject).slice(0, 6);
        const subVals = subNames.map((k) => bySubject[k]);
        buildChartSubjects(subNames, subVals);
    } catch (e) {
        console.error(e);
    }
}

// ── CHART BUILDERS ───────────────────────────────────────────────────────────

function buildChartStatus({ pending, completed, in_progress, overdue }) {
    const ctx = $("chartStatus");
    if (!ctx) return;

    const total = pending + completed + in_progress + overdue;
    txt("chartStatusTotal", total);

    const data = [completed, pending, in_progress, overdue];
    const labels = ["Concluídas", "Pendentes", "Em progresso", "Atrasadas"];
    const colors = ["#22c55e", "#eab308", "#3b82f6", "#ef4444"];

    // Legend
    const leg = $("chartStatusLegend");
    if (leg) {
        leg.innerHTML = labels
            .map(
                (l, i) => `
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-2.5 h-2.5 rounded-sm shrink-0" style="background:${colors[i]}"></span>
                    <span class="text-[11px] text-gray-500 dark:text-gray-400 font-medium">${l}</span>
                </div>
                <span class="text-[11px] font-black tabular-nums text-gray-700 dark:text-gray-300">${data[i]}</span>
            </div>`,
            )
            .join("");
    }

    if (chartStatus) chartStatus.destroy();
    chartStatus = new Chart(ctx, {
        type: "doughnut",
        data: {
            labels,
            datasets: [
                {
                    data,
                    backgroundColor: colors,
                    borderWidth: 0,
                    hoverOffset: 6,
                },
            ],
        },
        options: {
            cutout: "72%",
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) =>
                            ` ${ctx.label}: ${ctx.raw} (${total ? Math.round((ctx.raw / total) * 100) : 0}%)`,
                    },
                },
            },
            animation: { animateRotate: true, duration: 800 },
        },
    });
}

function buildChartWeek(labels, completed, overdue) {
    const ctx = $("chartWeek");
    if (!ctx) return;

    if (chartWeek) chartWeek.destroy();
    chartWeek = new Chart(ctx, {
        type: "line",
        data: {
            labels,
            datasets: [
                {
                    label: "Concluídas",
                    data: completed,
                    borderColor: PINK,
                    backgroundColor: PINK_L,
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointBackgroundColor: PINK,
                    pointBorderColor: "#fff",
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.42,
                },
                {
                    label: "Atrasadas",
                    data: overdue,
                    borderColor: RED,
                    backgroundColor: RED_L,
                    borderWidth: 2,
                    pointRadius: 3,
                    pointBackgroundColor: RED,
                    pointBorderColor: "#fff",
                    pointBorderWidth: 2,
                    fill: true,
                    tension: 0.42,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { mode: "index", intersect: false },
            },
            scales: {
                x: {
                    grid: { color: GRID(), drawBorder: false },
                    ticks: { color: TICK(), font: { size: 10, weight: "600" } },
                },
                y: {
                    beginAtZero: true,
                    grid: { color: GRID(), drawBorder: false },
                    ticks: {
                        color: TICK(),
                        font: { size: 10 },
                        stepSize: 1,
                        precision: 0,
                    },
                },
            },
        },
    });
}

function buildChartSubjects(labels, data) {
    const ctx = $("chartSubjects");
    if (!ctx) return;

    const palette = [
        "#db2777",
        "#ec4899",
        "#f472b6",
        "#e11d48",
        "#be185d",
        "#9d174d",
    ];

    if (chartSubjects) chartSubjects.destroy();
    chartSubjects = new Chart(ctx, {
        type: "bar",
        data: {
            labels,
            datasets: [
                {
                    label: "Atividades",
                    data,
                    backgroundColor: palette.slice(0, labels.length),
                    borderRadius: 8,
                    borderSkipped: false,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            indexAxis: "y", // horizontal bars
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) =>
                            ` ${ctx.raw} atividade${ctx.raw !== 1 ? "s" : ""}`,
                    },
                },
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: { color: GRID(), drawBorder: false },
                    ticks: { color: TICK(), font: { size: 10 }, precision: 0 },
                },
                y: {
                    grid: { display: false },
                    ticks: { color: TICK(), font: { size: 11, weight: "600" } },
                },
            },
        },
    });
}

// ── EXAMS ────────────────────────────────────────────────────────────────────
async function loadExams() {
    try {
        const r = await fetch("/api/exams", { headers: hdrs() });
        if (!r.ok) return;
        const all = await r.json();
        const upcoming = all
            .filter((e) => e.status !== "completed" && e.due_date)
            .sort((a, b) => new Date(a.due_date) - new Date(b.due_date));

        // ── Upcoming exams list ──
        const el = $("upcomingExams");
        if (el) {
            const slice = upcoming.slice(0, 4);
            if (!slice.length) {
                el.innerHTML =
                    '<p class="text-center text-sm text-gray-400 py-5">Nenhuma prova próxima.</p>';
            } else {
                el.innerHTML = slice
                    .map((e) => {
                        const dt = new Date(e.due_date + "T00:00:00");
                        const day = String(dt.getDate()).padStart(2, "0");
                        const mon = MONTHS[dt.getMonth()];
                        const days = Math.ceil((dt - new Date()) / 864e5);
                        const urgent = days <= 3;
                        const tag =
                            days <= 0
                                ? "Hoje"
                                : days === 1
                                  ? "Amanhã"
                                  : `${days}d`;
                        return `<div class="flex items-center justify-between px-5 py-3 hover:bg-pink-50/60 dark:hover:bg-pink-500/5 transition-colors">
                        <div class="flex items-center gap-3 min-w-0">
                            <div class="text-center shrink-0 w-10">
                                <div class="font-black text-gray-900 dark:text-white leading-none" style="font-family:'Syne',sans-serif;font-size:1.3rem">${day}</div>
                                <div class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">${mon}</div>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">${e.type || "Prova"}</p>
                                <p class="text-xs text-gray-400 truncate">${e.description || ""}</p>
                            </div>
                        </div>
                        ${badge(urgent ? "#dc2626" : "#db2777", urgent ? "#fee2e2" : "#fce7f3", tag)}
                    </div>`;
                    })
                    .join("");
            }
        }

        // ── Next exam urgency card ──
        const card = $("nextExamCard");
        if (card && upcoming.length) {
            const e = upcoming[0];
            const dt = new Date(e.due_date + "T00:00:00");
            const days = Math.ceil((dt - new Date()) / 864e5);
            const tag =
                days <= 0 ? "Hoje!" : days === 1 ? "Amanhã" : `em ${days} dias`;
            card.innerHTML = `
                <p class="text-white font-black text-base leading-tight" style="font-family:'Syne',sans-serif;">${e.type || "Prova"}</p>
                <p class="text-pink-200 text-xs font-semibold mt-0.5">${e.description || ""}</p>
                <div class="mt-2 flex items-center gap-2">
                    <span class="bg-white/20 text-white text-[10px] font-black px-2.5 py-1 rounded-full">${tag}</span>
                    <span class="text-pink-200 text-[10px]">${String(dt.getDate()).padStart(2, "0")}/${MONTHS[dt.getMonth()]}</span>
                </div>`;
        } else if (card) {
            card.innerHTML =
                '<p class="text-pink-200 text-sm font-semibold">Nenhuma prova próxima 🎉</p>';
        }
    } catch (e) {
        console.error(e);
    }
}

// ── SUBJECTS ─────────────────────────────────────────────────────────────────
async function loadSubjects() {
    try {
        const r = await fetch("/api/subjects", { headers: hdrs() });
        if (!r.ok) return;
        const list = await r.json();
        txt("statSubjects", list.length);

        const el = $("subjectsList");
        if (el) {
            el.innerHTML = list
                .slice(0, 5)
                .map((s, i) => {
                    const [bg, color] =
                        SUBJECT_COLORS[i % SUBJECT_COLORS.length];
                    const abbr = (s.abbreviation || s.name || "?")
                        .slice(0, 3)
                        .toUpperCase();
                    return `<div class="flex items-center gap-3 px-5 py-2.5 hover:bg-pink-500/10 transition-colors">
                    <div class="w-7 h-7 rounded-lg flex items-center justify-center text-[10px] font-black shrink-0" style="background:${bg};color:${color}">${abbr}</div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-white truncate">${s.name}</p>
                        <p class="text-xs text-pink-200/70 truncate">${s.teacher || "Sem professor"}</p>
                    </div>
                </div>`;
                })
                .join("");
        }
    } catch {}
}

// ── COUNTER ANIMATION ────────────────────────────────────────────────────────
function animateCounters() {
    document.querySelectorAll("[data-counter]").forEach((el) => {
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

// ── BOOT ─────────────────────────────────────────────────────────────────────
document.addEventListener("DOMContentLoaded", async () => {
    startClock();
    await loadUser();
    await Promise.all([loadActivities(), loadExams(), loadSubjects()]);
    setTimeout(animateCounters, 100);
});
