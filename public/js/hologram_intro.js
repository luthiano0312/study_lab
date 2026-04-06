document.addEventListener("DOMContentLoaded", () => {
    /* ══════════════════════════════════════════
       PARTÍCULAS
    ══════════════════════════════════════════ */
    const canvas = document.getElementById("particle-canvas");
    if (canvas) {
        const ctx = canvas.getContext("2d");
        let particles = [];

        const resize = () => {
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
        };
        window.addEventListener("resize", resize);
        resize();

        for (let i = 0; i < 90; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() - 0.5) * 0.35,
                vy: (Math.random() - 0.5) * 0.35,
                r: Math.random() * 1.6 + 0.4,
                color:
                    Math.random() > 0.55
                        ? "rgba(236,72,153,0.75)"
                        : "rgba(180,220,255,0.4)",
            });
        }

        (function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach((p) => {
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = p.color;
                ctx.fill();
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
            });
            requestAnimationFrame(animate);
        })();
    }

    /* ══════════════════════════════════════════
       TIMER
    ══════════════════════════════════════════ */
    let running = false;
    let secs = 25 * 60; // 25 min pomodoro padrão
    const total = 25 * 60;

    const digitsEl = document.getElementById("timer-digits");
    const playBtn = document.getElementById("play-btn");
    const playLabel = document.getElementById("play-label");
    const playIcon = document.getElementById("play-icon");
    const circle = document.querySelector("circle[stroke-dasharray]");

    // Estado inicial: parado
    if (playBtn) {
        playBtn.classList.add("paused");
        if (playLabel) playLabel.textContent = "Iniciar";
        if (playIcon) playIcon.innerHTML = '<path d="M6 4l15 8-15 8V4z"/>';
    }
    if (digitsEl) digitsEl.textContent = "25:00";

    // Atualiza display
    const updateDisplay = () => {
        if (!digitsEl) return;
        const m = Math.floor(secs / 60);
        const s = secs % 60;
        digitsEl.textContent = `${String(m).padStart(2, "0")}:${String(s).padStart(2, "0")}`;

        if (circle) {
            const circ = 2 * Math.PI * 52;
            const offset = circ * (secs / total);
            circle.setAttribute("stroke-dashoffset", offset);
        }
    };

    setInterval(() => {
        if (!running || secs <= 0) return;
        secs--;
        updateDisplay();
    }, 1000);

    if (playBtn) {
        playBtn.addEventListener("click", () => {
            running = !running;
            if (running) {
                playLabel.textContent = "Pausar";
                playIcon.innerHTML =
                    '<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>';
                playBtn.classList.remove("paused");
            } else {
                playLabel.textContent = "Continuar";
                playIcon.innerHTML = '<path d="M6 4l15 8-15 8V4z"/>';
                playBtn.classList.add("paused");
            }
        });
    }

    // Botão reset (primeiro btn-icon após o play)
    const resetBtn = document.querySelector(
        ".timer-controls .btn-icon:nth-child(2)",
    );
    if (resetBtn) {
        resetBtn.addEventListener("click", () => {
            running = false;
            secs = total;
            updateDisplay();
            if (playBtn) {
                playBtn.classList.add("paused");
                playLabel.textContent = "Iniciar";
                playIcon.innerHTML = '<path d="M6 4l15 8-15 8V4z"/>';
            }
        });
    }

    /* ══════════════════════════════════════════
       OVERLAY — só fecha com o botão ACESSAR
    ══════════════════════════════════════════ */
    const overlay = document.getElementById("holo-overlay");
    const app = document.querySelector(".app");
    const enterBtn = document.getElementById("holo-enter-btn");

    if (enterBtn && overlay && app) {
        enterBtn.addEventListener("click", () => {
            // Fade out suave do overlay
            overlay.style.transition = "opacity 0.55s ease, filter 0.55s ease";
            overlay.style.opacity = "0";
            overlay.style.filter = "blur(4px)";

            // Revela o app e inicia o timer
            setTimeout(() => {
                overlay.style.display = "none";
                app.classList.add("revealed");

                running = true;
                if (playBtn) {
                    playBtn.classList.remove("paused");
                    playLabel.textContent = "Pausar";
                    playIcon.innerHTML =
                        '<path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z"/>';
                }
            }, 560);
        });
    }

    /* ══════════════════════════════════════════
       SIDEBAR TOGGLE
    ══════════════════════════════════════════ */
    const sidebar = document.getElementById("sidebar");
    const sidebarToggle = document.getElementById("sidebar-toggle");
    if (sidebar && sidebarToggle) {
        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("expanded");
        });
    }

    /* ══════════════════════════════════════════
       BANCO DE QUESTÕES (SUPPORT PANEL)
    ══════════════════════════════════════════ */
    const supportBtn = document.getElementById("support-btn");
    const supportOverlay = document.getElementById("support-overlay");
    const closeSupport = document.getElementById("close-support");

    if (supportBtn && supportOverlay) {
        supportBtn.addEventListener("click", () =>
            supportOverlay.classList.toggle("open"),
        );
    }
    if (closeSupport && supportOverlay) {
        closeSupport.addEventListener("click", () =>
            supportOverlay.classList.remove("open"),
        );
    }

    /* ── Task toggle (global) ── */
    window.toggleTask = (el) => {
        el.classList.toggle("done");
        const txt = el.nextElementSibling;
        if (txt) txt.classList.toggle("done");
    };
});
