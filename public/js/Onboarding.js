"use strict";

/* ── CONSTANTS ─────────────────────────────────────────────── */
const TOTAL_STEPS = 7;

const COLORS = [
    {
        key: "rosa",
        label: "Rosa",
        grad: "linear-gradient(135deg,#9d174d 0%,#db2777 40%,#f9a8d4 100%)",
        light: false,
    },
    {
        key: "roxo",
        label: "Roxo",
        grad: "linear-gradient(135deg,#4c1d95 0%,#7c3aed 40%,#c4b5fd 100%)",
        light: false,
    },
    {
        key: "azul",
        label: "Azul",
        grad: "linear-gradient(135deg,#1e3a8a 0%,#2563eb 40%,#93c5fd 100%)",
        light: false,
    },
    {
        key: "verde",
        label: "Verde",
        grad: "linear-gradient(135deg,#064e3b 0%,#059669 40%,#6ee7b7 100%)",
        light: false,
    },
    {
        key: "laranja",
        label: "Laranja",
        grad: "linear-gradient(135deg,#7c2d12 0%,#ea580c 40%,#fdba74 100%)",
        light: false,
    },
    {
        key: "preto",
        label: "Preto",
        grad: "linear-gradient(135deg,#111827 0%,#1f2937 40%,#374151 100%)",
        light: false,
    },
    {
        key: "vermelho",
        label: "Vermelho",
        grad: "linear-gradient(135deg,#7f1d1d 0%,#dc2626 40%,#fca5a5 100%)",
        light: false,
    },
    {
        key: "branco",
        label: "Branco",
        grad: "linear-gradient(135deg,#e5e7eb 0%,#f9fafb 50%,#fff 100%)",
        light: true,
    },
    {
        key: "ciano",
        label: "Ciano",
        grad: "linear-gradient(135deg,#164e63 0%,#0891b2 40%,#67e8f9 100%)",
        light: false,
    },
    {
        key: "amarelo",
        label: "Amarelo",
        grad: "linear-gradient(135deg,#78350f 0%,#d97706 40%,#fde68a 100%)",
        light: false,
    },
    {
        key: "indigo",
        label: "Índigo",
        grad: "linear-gradient(135deg,#312e81 0%,#4338ca 40%,#a5b4fc 100%)",
        light: false,
    },
    {
        key: "rosegold",
        label: "Rose Gold",
        grad: "linear-gradient(135deg,#881337 0%,#e11d48 30%,#fda4af 100%)",
        light: false,
    },
];

const THEMES = [
    {
        key: "light",
        label: "Light",
        bg: "#ffffff",
        sb: "#f3f3f3",
        lines: ["#0000ff", "#001080", "#a31515", "#267f99", "#795e26"],
        tc: "#555",
    },
    {
        key: "dark",
        label: "Dark",
        bg: "#1e1e1e",
        sb: "#252526",
        lines: ["#569cd6", "#9cdcfe", "#ce9178", "#4ec9b0", "#dcdcaa"],
        tc: "#aaa",
    },
];

const AVATAR_CATEGORIES = {
    // ── 3d: avt1.jpg → avt6.jpg ──────────────────────────────
    pessoas: {
        label: "3D",
        avatars: [
            { id: 1, url: "/images/avatars/3d/avt1.jpg" },
            { id: 2, url: "/images/avatars/3d/avt2.jpg" },
            { id: 3, url: "/images/avatars/3d/avt3.jpg" },
            { id: 4, url: "/images/avatars/3d/avt4.jpg" },
            { id: 5, url: "/images/avatars/3d/avt5.jpg" },
            { id: 6, url: "/images/avatars/3d/avt6.jpg" },
        ],
    },

    // ── animals: avt1.jpg → avt15.jpg (avt13 é .png) ─────────
    animais: {
        label: "Animais",
        avatars: [
            { id: 1, url: "/images/avatars/animals/avt1.jpg" },
            { id: 2, url: "/images/avatars/animals/avt2.jpg" },
            { id: 3, url: "/images/avatars/animals/avt3.jpg" },
            { id: 4, url: "/images/avatars/animals/avt4.jpg" },
            { id: 5, url: "/images/avatars/animals/avt5.jpg" },
            { id: 6, url: "/images/avatars/animals/avt6.jpg" },
            { id: 7, url: "/images/avatars/animals/avt7.jpg" },
            { id: 8, url: "/images/avatars/animals/avt8.jpg" },
            { id: 9, url: "/images/avatars/animals/avt9.jpg" },
            { id: 10, url: "/images/avatars/animals/avt10.jpg" },
            { id: 11, url: "/images/avatars/animals/avt11.jpg" },
            { id: 12, url: "/images/avatars/animals/avt12.jpg" },
            { id: 13, url: "/images/avatars/animals/avt13.png" }, // .png
            { id: 14, url: "/images/avatars/animals/avt14.jpg" },
            { id: 15, url: "/images/avatars/animals/avt15.jpg" },
        ],
    },

    // ── cats: avt1.jpg → avt5.jpg ────────────────────────────
    cats: {
        label: "Cats",
        avatars: [
            { id: 1, url: "/images/avatars/cats/avt1.jpg" },
            { id: 2, url: "/images/avatars/cats/avt2.jpg" },
            { id: 3, url: "/images/avatars/cats/avt3.jpg" },
            { id: 4, url: "/images/avatars/cats/avt4.jpg" },
            { id: 5, url: "/images/avatars/cats/avt5.jpg" },
        ],
    },

    // ── memes: avt1.jpg → avt9.png (avt9 é .png) ─────────────
    memes: {
        label: "Memes",
        avatars: [
            { id: 1, url: "/images/avatars/memes/avt1.jpg" },
            { id: 2, url: "/images/avatars/memes/avt2.jpg" },
            { id: 3, url: "/images/avatars/memes/avt3.jpg" },
            { id: 4, url: "/images/avatars/memes/avt4.jpg" },
            { id: 5, url: "/images/avatars/memes/avt5.jpg" },
            { id: 6, url: "/images/avatars/memes/avt6.jpg" },
            { id: 7, url: "/images/avatars/memes/avt7.jpg" },
            { id: 8, url: "/images/avatars/memes/avt8.jpg" },
            { id: 9, url: "/images/avatars/memes/avt9.png" }, // .png
        ],
    },

    // ── outros: avt1.jpg → avt4.jpg + avt4.png → avt10.png ───
    outros: {
        label: "Outros",
        avatars: [
            { id: 1, url: "/images/avatars/outros/avt1.jpg" },
            { id: 2, url: "/images/avatars/outros/avt2.jpg" },
            { id: 3, url: "/images/avatars/outros/avt3.jpg" },
            { id: 4, url: "/images/avatars/outros/avt4.jpg" },
            { id: 5, url: "/images/avatars/outros/avt4.png" }, // avt4.png (duplicado de nome, mantido)
            { id: 6, url: "/images/avatars/outros/avt5.png" },
            { id: 7, url: "/images/avatars/outros/avt6.png" },
            { id: 8, url: "/images/avatars/outros/avt7.png" },
            { id: 9, url: "/images/avatars/outros/avt8.png" },
            { id: 10, url: "/images/avatars/outros/avt9.png" },
            { id: 11, url: "/images/avatars/outros/avt10.png" },
        ],
    },

    // ── pixelart: avt1.jpg → avt9.jpg ────────────────────────
    pixelart: {
        label: "Pixelart",
        avatars: [
            { id: 1, url: "/images/avatars/pixelart/avt1.jpg" },
            { id: 2, url: "/images/avatars/pixelart/avt2.jpg" },
            { id: 3, url: "/images/avatars/pixelart/avt3.jpg" },
            { id: 4, url: "/images/avatars/pixelart/avt4.jpg" },
            { id: 5, url: "/images/avatars/pixelart/avt5.jpg" },
            { id: 6, url: "/images/avatars/pixelart/avt6.jpg" },
            { id: 7, url: "/images/avatars/pixelart/avt7.jpg" },
            { id: 8, url: "/images/avatars/pixelart/avt8.jpg" },
            { id: 9, url: "/images/avatars/pixelart/avt9.jpg" },
        ],
    },

    // ── sigma: avt1.jpg → avt6.jpg ───────────────────────────
    sigma: {
        label: "Sigma",
        avatars: [
            { id: 1, url: "/images/avatars/sigma/avt1.jpg" },
            { id: 2, url: "/images/avatars/sigma/avt2.jpg" },
            { id: 3, url: "/images/avatars/sigma/avt3.jpg" },
            { id: 4, url: "/images/avatars/sigma/avt4.jpg" },
            { id: 5, url: "/images/avatars/sigma/avt5.jpg" },
            { id: 6, url: "/images/avatars/sigma/avt6.jpg" },
        ],
    },
};

const CAT_COLORS = {
    animais: "#059669",
    pessoas: "#7c3aed",
    pixelart: "#0891b2",
    cats: "#d97706",
    memes: "#dc2626",
    sigma: "#374151",
    outros: "#db2777",
};

/* ── STATE ─────────────────────────────────────────────────── */
const state = {
    step: 0,
    transitioning: false,
    name: "",
    colorKey: "rosa",
    colorGrad: COLORS[0].grad,
    colorLight: false,
    themeKey: "light",
    avatarType: "preset",
    avatarCategoryKey: "animais",
    avatarId: 1,
    avatarUrl: "",
    avatarDataUrl: null,
    avatarFile: null,
    planKey: "free",
};

/* ── API ────────────────────────────────────────────────────── */
const API_BASE = "/api";
function authHeaders(extra = {}) {
    const t = localStorage.getItem("auth_token");
    return {
        Accept: "application/json",
        Authorization: `Bearer ${t}`,
        ...extra,
    };
}

/* ── CURSOR — rAF-based, reliable ──────────────────────────── */
function initCursor() {
    const dot = document.getElementById("cur-dot");
    const ring = document.getElementById("cur-ring");
    if (!dot || !ring) return;

    let mx = window.innerWidth / 2,
        my = window.innerHeight / 2;
    let rx = mx,
        ry = my;

    document.addEventListener(
        "mousemove",
        (e) => {
            mx = e.clientX;
            my = e.clientY;
        },
        { passive: true },
    );

    document.addEventListener(
        "mousemove",
        (e) => {
            const isHoverable = e.target.closest(
                "button, a, input, label, [onclick], .color-sw, .theme-card, .nf-av, .plan-card",
            );
            document.body.classList.toggle("cur-hover", !!isHoverable);
        },
        { passive: true },
    );

    function tick() {
        dot.style.left = mx + "px";
        dot.style.top = my + "px";
        rx += (mx - rx) * 0.1;
        ry += (my - ry) * 0.1;
        ring.style.left = rx + "px";
        ring.style.top = ry + "px";
        requestAnimationFrame(tick);
    }
    requestAnimationFrame(tick);
}

/* ── PAGE LOAD SPLASH ───────────────────────────────────────── */
function injectSplash() {
    if (document.getElementById("sl-splash")) return;

    const splash = document.createElement("div");
    splash.id = "sl-splash";
    splash.innerHTML = `
        <div class="sl-splash-inner">
            <div class="sl-splash-logo">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                    <rect width="40" height="40" rx="12" fill="url(#splashGrad)"/>
                    <defs>
                        <linearGradient id="splashGrad" x1="0" y1="0" x2="40" y2="40">
                            <stop offset="0%" stop-color="#9d174d"/>
                            <stop offset="100%" stop-color="#db2777"/>
                        </linearGradient>
                    </defs>
                    <path d="M12 20c0-4.4 3.6-8 8-8s8 3.6 8 8-3.6 8-8 8" stroke="white" stroke-width="2.5" stroke-linecap="round"/>
                    <circle cx="20" cy="20" r="3" fill="white"/>
                </svg>
            </div>
            <div class="sl-splash-bar-wrap">
                <div class="sl-splash-bar" id="splashBar"></div>
            </div>
            <div class="sl-splash-label" id="splashLabel">Iniciando...</div>
        </div>`;

    const style = document.createElement("style");
    style.textContent = `
        #sl-splash {
            position: fixed; inset: 0; z-index: 99999;
            background: #0d0d0d;
            display: flex; align-items: center; justify-content: center;
            transition: opacity 480ms cubic-bezier(.4,0,.2,1), transform 480ms cubic-bezier(.4,0,.2,1);
        }
        #sl-splash.fade-out {
            opacity: 0;
            transform: scale(1.03);
            pointer-events: none;
        }
        .sl-splash-inner {
            display: flex; flex-direction: column; align-items: center; gap: 20px;
        }
        .sl-splash-logo {
            animation: splashPulse 1.4s ease-in-out infinite;
        }
        @keyframes splashPulse {
            0%,100% { transform: scale(1);   opacity: 1; }
            50%      { transform: scale(1.08); opacity: .8; }
        }
        .sl-splash-bar-wrap {
            width: 160px; height: 3px; border-radius: 99px;
            background: rgba(255,255,255,.1); overflow: hidden;
        }
        .sl-splash-bar {
            height: 100%; width: 0%; border-radius: 99px;
            background: linear-gradient(90deg, #9d174d, #db2777, #f9a8d4);
            transition: width 300ms cubic-bezier(.4,0,.2,1);
        }
        .sl-splash-label {
            font-family: 'DM Mono', monospace;
            font-size: 10px; letter-spacing: .15em;
            text-transform: uppercase; color: rgba(255,255,255,.35);
            transition: opacity 200ms;
        }
    `;
    document.head.appendChild(style);
    document.body.appendChild(splash);
}

function setSplashProgress(pct, label) {
    const bar = document.getElementById("splashBar");
    const lbl = document.getElementById("splashLabel");
    if (bar) bar.style.width = pct + "%";
    if (lbl && label) {
        lbl.style.opacity = "0";
        setTimeout(() => {
            lbl.textContent = label;
            lbl.style.opacity = "1";
        }, 160);
    }
}

function dismissSplash() {
    const splash = document.getElementById("sl-splash");
    if (!splash) return;
    splash.classList.add("fade-out");
    setTimeout(() => splash.remove(), 500);
}

/* ── INIT ───────────────────────────────────────────────────── */
async function init() {
    injectSplash();
    setSplashProgress(10, "Iniciando...");

    initCursor();
    setSplashProgress(25, "Carregando interface...");

    try {
        const r = await fetch(`${API_BASE}/user`, { headers: authHeaders() });
        if (r.ok) {
            const u = await r.json();
            const el = document.getElementById("previewId");
            if (el) el.textContent = "SL-" + String(u.id).padStart(6, "0");
        }
    } catch (e) {}

    setSplashProgress(50, "Construindo componentes...");
    buildAllDots();
    buildColors();

    setSplashProgress(70, "Carregando temas...");
    buildThemes();

    setSplashProgress(85, "Carregando avatares...");
    buildNetflixRows();

    setSplashProgress(95, "Finalizando...");
    bindEvents();
    selectColor(COLORS[0]);

    setSplashProgress(100, "Pronto!");

    /* small pause so the 100% bar is visible, then dismiss */
    setTimeout(dismissSplash, 420);
}

/* ── DOTS ───────────────────────────────────────────────────── */
function buildAllDots() {
    for (let s = 0; s < TOTAL_STEPS; s++) buildDots(s);
}
function buildDots(step) {
    const wrap = document.getElementById(`dots${step}`);
    if (!wrap) return;
    wrap.innerHTML = "";
    for (let i = 0; i < TOTAL_STEPS; i++) {
        const d = document.createElement("div");
        d.className =
            i === step
                ? "dot dot-active"
                : i < step
                  ? "dot dot-done"
                  : "dot dot-idle";
        wrap.appendChild(d);
    }
}

/* ── STEP TRANSITION ────────────────────────────────────────── */
function goStep(n) {
    if (state.transitioning || n === state.step) return;
    state.transitioning = true;
    const prev = document.getElementById(`step${state.step}`);
    const next = document.getElementById(`step${n}`);
    if (!prev || !next) {
        state.transitioning = false;
        return;
    }
    const fwd = n > state.step;

    prev.style.transition = "opacity 200ms ease,transform 200ms ease";
    prev.style.opacity = "0";
    prev.style.transform = fwd ? "translateY(-12px)" : "translateY(12px)";

    setTimeout(() => {
        prev.classList.add("hidden-step");
        prev.style.cssText = "";

        next.classList.remove("hidden-step");
        next.style.opacity = "0";
        next.style.transform = fwd ? "translateY(14px)" : "translateY(-14px)";
        state.step = n;
        buildAllDots();

        next.getBoundingClientRect();
        next.style.transition = "opacity 260ms ease,transform 260ms ease";
        next.style.opacity = "1";
        next.style.transform = "translateY(0)";

        if (n === 6) spawnConfetti();

        setTimeout(() => {
            next.style.cssText = "";
            state.transitioning = false;
        }, 270);
    }, 210);
}

/* ── COLORS ─────────────────────────────────────────────────── */
function buildColors() {
    const grid = document.getElementById("colorGrid");
    if (!grid) return;
    COLORS.forEach((c, idx) => {
        const el = document.createElement("div");
        el.className = "color-sw" + (idx === 0 ? " selected" : "");
        el.dataset.key = c.key;
        el.style.background = c.grad;
        const lc = c.light ? "rgba(55,65,81,.8)" : "rgba(255,255,255,.88)";
        const cs = c.light ? "#374151" : "white";
        el.innerHTML = `
      <div class="sw-check">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="${cs}" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <div class="sw-label" style="color:${lc};">${c.label}</div>`;
        el.addEventListener("click", () => selectColor(c));
        grid.appendChild(el);
    });
}

function selectColor(c) {
    document.querySelectorAll("#colorGrid .color-sw").forEach((el) => {
        el.classList.remove("selected", "selected-light");
    });
    const active = document.querySelector(
        `#colorGrid .color-sw[data-key="${c.key}"]`,
    );
    if (active) active.classList.add(c.light ? "selected-light" : "selected");

    state.colorKey = c.key;
    state.colorGrad = c.grad;
    state.colorLight = c.light;

    const cp = document.getElementById("card-preview");
    if (cp) cp.style.background = c.grad;

    const L = c.light;
    const s = (id, prop, val) => {
        const el = document.getElementById(id);
        if (el) el.style[prop] = val;
    };
    s("previewName", "color", L ? "#1f2937" : "#fff");
    s(
        "previewSchool",
        "color",
        L ? "rgba(55,65,81,.55)" : "rgba(255,255,255,.48)",
    );
    s("previewId", "color", L ? "rgba(55,65,81,.35)" : "rgba(255,255,255,.28)");
    s(
        "previewYear",
        "color",
        L ? "rgba(55,65,81,.55)" : "rgba(255,255,255,.6)",
    );
    s(
        "previewYear",
        "background",
        L ? "rgba(0,0,0,.07)" : "rgba(255,255,255,.14)",
    );
    const mini = document.getElementById("previewPhotoMini");
    if (mini) {
        mini.style.borderColor = L
            ? "rgba(0,0,0,.12)"
            : "rgba(255,255,255,.25)";
        mini.style.background = L ? "rgba(0,0,0,.05)" : "rgba(255,255,255,.15)";
    }
}

/* ── THEMES ─────────────────────────────────────────────────── */
function buildThemes() {
    const grid = document.getElementById("themeGrid");
    if (!grid) return;
    const lw = [70, 50, 85, 40, 65, 55, 75],
        sw = [60, 40, 70, 35, 55, 45];
    THEMES.forEach((t, idx) => {
        const card = document.createElement("div");
        card.className = "theme-card" + (idx === 0 ? " selected" : "");
        card.dataset.key = t.key;
        card.style.background = t.bg;
        const sl = sw
            .map(
                (w) =>
                    `<div style="height:3px;border-radius:2px;width:${w}%;background:${t.lines[0]};opacity:.7;margin-bottom:4px;"></div>`,
            )
            .join("");
        const ml = [...t.lines, ...t.lines]
            .map(
                (cl, i) =>
                    `<div style="height:3px;border-radius:2px;width:${lw[i % lw.length]}%;background:${cl};opacity:${i < t.lines.length ? 0.8 : 0.3};margin-bottom:3px;"></div>`,
            )
            .join("");
        card.innerHTML = `
      <div style="width:100%;height:100%;display:flex;">
        <div style="width:35%;background:${t.sb};padding:8px;display:flex;flex-direction:column;">${sl}</div>
        <div style="flex:1;padding:8px;display:flex;flex-direction:column;">${ml}</div>
      </div>
      <div class="theme-check">
        <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
      </div>
      <div style="position:absolute;bottom:6px;left:0;right:0;text-align:center;font-family:'DM Mono',monospace;font-size:9px;font-weight:600;letter-spacing:.12em;text-transform:uppercase;color:${t.tc};">${t.label}</div>`;
        card.addEventListener("click", () => {
            document
                .querySelectorAll(".theme-card")
                .forEach((c) => c.classList.remove("selected"));
            card.classList.add("selected");
            state.themeKey = t.key;
        });
        grid.appendChild(card);
    });
}

/* ── NETFLIX AVATAR ROWS ────────────────────────────────────── */

/* Inject scroll-row styles once */
(function injectScrollStyles() {
    if (document.getElementById("nf-scroll-styles")) return;
    const style = document.createElement("style");
    style.id = "nf-scroll-styles";
    style.textContent = `
        .nf-row-wrap {
            position: relative;
        }
        .nf-row {
            display: flex;
            flex-direction: row;
            gap: 8px;
            overflow-x: auto;
            overflow-y: visible;
            scroll-behavior: smooth;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;          /* Firefox */
            padding-bottom: 6px;
        }
        .nf-row::-webkit-scrollbar { display: none; }

        /* fade edges */
        .nf-row-wrap::before,
        .nf-row-wrap::after {
            content: "";
            position: absolute;
            top: 0; bottom: 6px;
            width: 40px;
            pointer-events: none;
            z-index: 2;
            transition: opacity 200ms;
        }
        .nf-row-wrap::before {
            left: 0;
            background: linear-gradient(to right, var(--nf-fade-bg, #111), transparent);
        }
        .nf-row-wrap::after {
            right: 0;
            background: linear-gradient(to left, var(--nf-fade-bg, #111), transparent);
        }
        .nf-row-wrap.at-start::before { opacity: 0; }
        .nf-row-wrap.at-end::after    { opacity: 0; }

        /* nav arrows */
        .nf-arrow {
            display: none;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 3;
            width: 28px; height: 28px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,.12);
            backdrop-filter: blur(6px);
            color: #fff;
            transition: background 150ms, opacity 150ms;
            padding: 0;
        }
        .nf-arrow:hover { background: rgba(255,255,255,.25); }
        .nf-arrow.hidden-arrow { opacity: 0; pointer-events: none; }
        .nf-arrow-left  { left: 2px; }
        .nf-arrow-right { right: 2px; }

        /* show arrows only when row overflows */
        .nf-row-wrap.overflows .nf-arrow { display: flex; }
    `;
    document.head.appendChild(style);
})();

const SCROLL_THRESHOLD = 4; // px tolerance for at-start / at-end

function setupRowScroll(wrap, row) {
    const STEP = 160; // px per arrow click

    const arrowL = wrap.querySelector(".nf-arrow-left");
    const arrowR = wrap.querySelector(".nf-arrow-right");

    function updateState() {
        const atStart = row.scrollLeft <= SCROLL_THRESHOLD;
        const atEnd =
            row.scrollLeft >=
            row.scrollWidth - row.clientWidth - SCROLL_THRESHOLD;
        wrap.classList.toggle("at-start", atStart);
        wrap.classList.toggle("at-end", atEnd);
        if (arrowL) arrowL.classList.toggle("hidden-arrow", atStart);
        if (arrowR) arrowR.classList.toggle("hidden-arrow", atEnd);

        /* mark as overflowing so arrows become visible */
        wrap.classList.toggle(
            "overflows",
            row.scrollWidth > row.clientWidth + SCROLL_THRESHOLD,
        );
    }

    row.addEventListener("scroll", updateState, { passive: true });

    if (arrowL)
        arrowL.addEventListener("click", () => {
            row.scrollLeft -= STEP;
        });
    if (arrowR)
        arrowR.addEventListener("click", () => {
            row.scrollLeft += STEP;
        });

    /* run once after paint so scrollWidth is accurate */
    requestAnimationFrame(updateState);

    /* re-check on resize */
    const ro = new ResizeObserver(updateState);
    ro.observe(row);
}

function buildNetflixRows() {
    const container = document.getElementById("netflixRows");
    if (!container) return;
    container.innerHTML = "";

    Object.entries(AVATAR_CATEGORIES).forEach(([catKey, cat]) => {
        const section = document.createElement("div");
        section.className = "nf-section";
        section.dataset.cat = catKey;

        const title = document.createElement("div");
        title.className = "nf-row-title";
        title.textContent = cat.label;
        section.appendChild(title);

        /* ── scroll wrapper ── */
        const wrap = document.createElement("div");
        wrap.className = "nf-row-wrap at-start";

        /* arrow buttons */
        const arrowL = document.createElement("button");
        arrowL.className = "nf-arrow nf-arrow-left hidden-arrow";
        arrowL.setAttribute("aria-label", "Scroll esquerda");
        arrowL.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="15 18 9 12 15 6"/></svg>`;

        const arrowR = document.createElement("button");
        arrowR.className = "nf-arrow nf-arrow-right";
        arrowR.setAttribute("aria-label", "Scroll direita");
        arrowR.innerHTML = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><polyline points="9 18 15 12 9 6"/></svg>`;

        const row = document.createElement("div");
        row.className = "nf-row";

        cat.avatars.forEach((av, i) => {
            const btn = document.createElement("button");
            btn.className = "nf-av";
            btn.dataset.cat = catKey;
            btn.dataset.id = av.id;
            btn.style.position = "relative";
            btn.style.flexShrink = "0"; /* prevent squishing */

            const isSelected =
                catKey === state.avatarCategoryKey &&
                av.id === state.avatarId &&
                state.avatarType === "preset";
            if (isSelected) btn.classList.add("selected");

            btn.innerHTML = `
        <img src="${av.url}" alt="${cat.label} ${i + 1}" loading="lazy"
          onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
        <div class="nf-av-fb" style="background:${CAT_COLORS[catKey]};">${cat.label[0]}</div>
        <div class="nf-av-check">
          <svg width="6" height="6" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
        </div>`;

            btn.addEventListener("click", () =>
                selectNetflixAvatar(btn, catKey, av, i),
            );
            row.appendChild(btn);
        });

        wrap.appendChild(arrowL);
        wrap.appendChild(row);
        wrap.appendChild(arrowR);
        section.appendChild(wrap);
        container.appendChild(section);

        setupRowScroll(wrap, row);
    });

    if (state.avatarType === "preset") {
        const firstBtn = container.querySelector(".nf-av");
        if (firstBtn && !container.querySelector(".nf-av.selected"))
            firstBtn.click();
    }
}

function selectNetflixAvatar(btnEl, catKey, av, index) {
    document
        .querySelectorAll(".nf-av")
        .forEach((b) => b.classList.remove("selected"));
    btnEl.classList.add("selected");

    state.avatarType = "preset";
    state.avatarCategoryKey = catKey;
    state.avatarId = av.id;
    state.avatarUrl = av.url;
    state.avatarDataUrl = av.url;

    updateCardPhoto(av.url);
    showAvatarChip(
        av.url,
        `${AVATAR_CATEGORIES[catKey].label} · Avatar ${index + 1}`,
    );

    const zone = document.getElementById("uploadZone");
    const lbl = document.getElementById("uploadLabel");
    if (zone) zone.classList.remove("loaded");
    if (lbl) lbl.textContent = "ENVIAR FOTO DO DISPOSITIVO";
}

/* ── FILE UPLOAD ────────────────────────────────────────────── */
function handleAvatarFileUpload() {
    const input = document.getElementById("avatarFileInput");
    const zone = document.getElementById("uploadZone");
    const lbl = document.getElementById("uploadLabel");
    if (!input) return;

    input.addEventListener("change", function () {
        const file = this.files[0];
        if (!file) return;
        state.avatarType = "upload";
        state.avatarFile = file;

        document
            .querySelectorAll(".nf-av")
            .forEach((b) => b.classList.remove("selected"));

        const reader = new FileReader();
        reader.onload = (ev) => {
            state.avatarDataUrl = ev.target.result;
            updateCardPhoto(ev.target.result);
            const name =
                file.name.length > 26
                    ? file.name.slice(0, 26) + "…"
                    : file.name;
            showAvatarChip(ev.target.result, name);
            if (lbl) lbl.textContent = "✓ FOTO CARREGADA — CLIQUE PARA TROCAR";
            if (zone) zone.classList.add("loaded");
        };
        reader.readAsDataURL(file);
    });
}

function updateCardPhoto(src) {
    const mini = document.getElementById("previewPhotoMini");
    if (!mini) return;
    mini.innerHTML = `<img src="${src}" style="width:100%;height:100%;object-fit:cover;"
    onerror="this.parentElement.innerHTML='';this.parentElement.style.background='rgba(219,39,119,.2)';">`;
}

function showAvatarChip(src, label) {
    const preview = document.getElementById("selectedAvatarPreview");
    const thumb = document.getElementById("selectedAvatarThumb");
    const nameEl = document.getElementById("selectedAvatarName");
    if (!preview) return;
    preview.classList.remove("hidden");
    if (thumb)
        thumb.innerHTML = `<img src="${src}" style="width:100%;height:100%;object-fit:cover;"
    onerror="this.parentElement.style.background='rgba(219,39,119,.25)';">`;
    if (nameEl) nameEl.textContent = label;
}

/* ── PLAN ───────────────────────────────────────────────────── */
function selectPlan(plan) {
    state.planKey = plan;

    /* deselect all cards */
    ["planFree", "planEvoluir", "planPremium"].forEach((id) => {
        document.getElementById(id)?.classList.remove("selected");
    });

    /* select chosen */
    const cardMap = {
        free: "planFree",
        evoluir: "planEvoluir",
        premium: "planPremium",
    };
    document.getElementById(cardMap[plan])?.classList.add("selected");

    /* sync ALL check-mark opacities */
    const checkMap = {
        chkFree: "free",
        chkEvol: "evoluir",
        chkPrem: "premium",
    };
    Object.entries(checkMap).forEach(([id, key]) => {
        const el = document.getElementById(id);
        if (el) el.style.opacity = plan === key ? "1" : "0";
    });
}

/* ── EVENTS ─────────────────────────────────────────────────── */
function bindEvents() {
    const nameInput = document.getElementById("nameInput");
    if (nameInput) {
        nameInput.addEventListener("input", () => {
            const v = nameInput.value.trim();
            state.name = v;
            const pv = document.getElementById("namePreviewVal");
            const pn = document.getElementById("previewName");
            if (pv) pv.textContent = v ? v.toUpperCase() : "—";
            if (pn) pn.textContent = v ? v.toUpperCase() : "SEU NOME";
            const btn = document.getElementById("nextStep1");
            if (btn) btn.disabled = v.length < 2;
        });
    }

    document.addEventListener("keydown", (e) => {
        if (state.transitioning) return;
        if (e.key === "Enter") {
            const step = document.getElementById(`step${state.step}`);
            const btns = step ? [...step.querySelectorAll("button")] : [];
            const last = btns.reverse().find((b) => !b.disabled);
            if (last) last.click();
        }
        if (state.step === 5) {
            const cards = [...document.querySelectorAll(".theme-card")];
            const ci = cards.findIndex((c) => c.classList.contains("selected"));
            if (e.key === "ArrowRight" && ci < cards.length - 1)
                cards[ci + 1].click();
            if (e.key === "ArrowLeft" && ci > 0) cards[ci - 1].click();
        }
    });

    handleAvatarFileUpload();
}

/* ── CONFETTI ───────────────────────────────────────────────── */
function spawnConfetti() {
    const cols = [
        "#db2777",
        "#ec4899",
        "#fff",
        "#f9a8d4",
        "#fda4af",
        "#be185d",
    ];
    for (let i = 0; i < 65; i++) {
        const el = document.createElement("div");
        const sz = 5 + Math.random() * 9;
        el.style.cssText = `
      position:fixed;top:-12px;pointer-events:none;z-index:99999;
      left:${Math.random() * 100}vw;width:${sz}px;height:${sz}px;
      background:${cols[Math.floor(Math.random() * cols.length)]};
      border-radius:${Math.random() > 0.5 ? "50%" : "2px"};
      animation:conffall ${1.4 + Math.random() * 1.6}s ease-in ${Math.random() * 0.7}s forwards;
    `;
        document.body.appendChild(el);
        el.addEventListener("animationend", () => el.remove());
    }
}

/* ── FINISH ─────────────────────────────────────────────────── */
async function finish(skip = false) {
    const ld = document.getElementById("loadingScreen");
    const lb = document.getElementById("progressBar");
    const sl = document.getElementById("statusLabel");
    const flask = document.getElementById("loadFlask");

    /* fade in the loading screen with a scale-up entrance */
    ld.style.opacity = "0";
    ld.style.transform = "scale(.94)";
    ld.style.transition =
        "opacity 380ms cubic-bezier(.4,0,.2,1), transform 380ms cubic-bezier(.4,0,.2,1)";
    ld.classList.remove("hidden");
    ld.classList.add("flex");

    requestAnimationFrame(() => {
        requestAnimationFrame(() => {
            ld.style.opacity = "1";
            ld.style.transform = "scale(1)";
        });
    });

    /* speed up the flask float animation as progress goes up */
    const stages = [
        { pct: 15, label: "Salvando seu nome...", speed: "2s" },
        { pct: 30, label: "Aplicando cor da carteira...", speed: "1.8s" },
        { pct: 48, label: "Configurando tema visual...", speed: "1.6s" },
        { pct: 62, label: "Enviando avatar...", speed: "1.4s" },
        { pct: 78, label: "Registrando plano...", speed: "1.2s" },
        { pct: 92, label: "Finalizando configuração...", speed: "1s" },
        { pct: 100, label: "Tudo pronto! 🎉", speed: ".8s" },
    ];

    function applyStage(i) {
        const s = stages[i];
        if (lb) lb.style.width = s.pct + "%";
        if (sl) {
            sl.style.opacity = "0";
            setTimeout(() => {
                sl.textContent = s.label;
                sl.style.opacity = "1";
            }, 180);
        }
        if (flask) flask.style.animationDuration = s.speed;
    }

    const setP = (pct) => {
        const s = stages.find((st) => st.pct === pct);
        if (s) {
            applyStage(stages.indexOf(s));
        } else if (lb) lb.style.width = pct + "%";
    };

    try {
        setP(15);
        if (!skip && state.name)
            await fetch(`${API_BASE}/profile`, {
                method: "PUT",
                headers: authHeaders({ "Content-Type": "application/json" }),
                body: JSON.stringify({ name: state.name }),
            });
        setP(30);
        if (!skip && state.colorKey)
            await fetch(`${API_BASE}/profile`, {
                method: "PUT",
                headers: authHeaders({ "Content-Type": "application/json" }),
                body: JSON.stringify({ card_color: state.colorKey }),
            });
        setP(48);
        if (!skip && state.themeKey)
            await fetch(`${API_BASE}/profile`, {
                method: "PUT",
                headers: authHeaders({ "Content-Type": "application/json" }),
                body: JSON.stringify({ theme: state.themeKey }),
            });
        setP(62);
        if (!skip && state.avatarType === "upload" && state.avatarFile) {
            const f = new FormData();
            f.append("photo", state.avatarFile);
            await fetch(`${API_BASE}/profile/photo`, {
                method: "POST",
                headers: authHeaders(),
                body: f,
            });
        } else if (!skip && state.avatarType === "preset" && state.avatarUrl) {
            await fetch(`${API_BASE}/profile`, {
                method: "PUT",
                headers: authHeaders({ "Content-Type": "application/json" }),
                body: JSON.stringify({ avatar_url: state.avatarUrl }),
            });
        }
        setP(78);
        if (!skip && state.planKey)
            await fetch(`${API_BASE}/profile`, {
                method: "PUT",
                headers: authHeaders({ "Content-Type": "application/json" }),
                body: JSON.stringify({ plan: state.planKey }),
            });
        setP(92);
        await fetch(`${API_BASE}/profile`, {
            method: "PUT",
            headers: authHeaders({ "Content-Type": "application/json" }),
            body: JSON.stringify({ onboarding_done: true }),
        });
        localStorage.setItem(
            "theme",
            state.themeKey === "dark" ? "dark" : "light",
        );
        setP(100);
    } catch (e) {
        console.error(e);
        setP(100);
    }

    /* brief pause at 100%, then fade out and redirect */
    setTimeout(() => {
        ld.style.transition =
            "opacity 500ms cubic-bezier(.4,0,.2,1), transform 500ms cubic-bezier(.4,0,.2,1)";
        ld.style.opacity = "0";
        ld.style.transform = "scale(1.05)";
        setTimeout(() => {
            window.location.href = "/dashboard";
        }, 520);
    }, 700);
}

/* ── GLOBALS ────────────────────────────────────────────────── */
window.goStep = goStep;
window.selectPlan = selectPlan;
window.finish = finish;

init();
