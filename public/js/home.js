(() => {
    "use strict";

    /* ── Scroll progress bar ── */
    const prog = document.getElementById("prog");
    const updateProg = () => {
        const tot = document.documentElement.scrollHeight - window.innerHeight;
        prog.style.transform = `scaleX(${window.scrollY / tot})`;
    };
    window.addEventListener("scroll", updateProg, { passive: true });

    /* ── Custom cursor ── */
    const cd = document.getElementById("c-d");
    const cr = document.getElementById("c-r");
    let mx = 0,
        my = 0,
        rx = 0,
        ry = 0;
    document.addEventListener("mousemove", (e) => {
        mx = e.clientX;
        my = e.clientY;
    });
    const tickC = () => {
        cd.style.left = mx + "px";
        cd.style.top = my + "px";
        rx += (mx - rx) * 0.1;
        ry += (my - ry) * 0.1;
        cr.style.left = rx + "px";
        cr.style.top = ry + "px";
        requestAnimationFrame(tickC);
    };
    tickC();
    document.querySelectorAll("a,button").forEach((el) => {
        el.addEventListener("mouseenter", () =>
            document.body.classList.add("ch"),
        );
        el.addEventListener("mouseleave", () =>
            document.body.classList.remove("ch"),
        );
    });

    /* ── Header glass on scroll ── */
    const hdr = document.getElementById("hdr");
    window.addEventListener(
        "scroll",
        () => hdr.classList.toggle("solid", window.scrollY > 50),
        { passive: true },
    );

    /* ── Hero clip reveal ── */
    const revH = () =>
        document
            .querySelectorAll(".ci")
            .forEach((el) => el.classList.add("in"));
    requestAnimationFrame(() => requestAnimationFrame(revH));

    /* ── IntersectionObserver scroll reveals ── */
    const io = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    e.target.classList.add("in");
                    io.unobserve(e.target);
                }
            });
        },
        { threshold: 0.1, rootMargin: "0px 0px -48px 0px" },
    );
    document
        .querySelectorAll(".sr,.srx,.srr,.ss")
        .forEach((el) => io.observe(el));

    /* ── Hero floating pills ── */
    const pills = document.querySelectorAll(".fpill");
    setTimeout(() => {
        pills.forEach((p, i) => {
            setTimeout(() => {
                p.classList.add("show");
                p.style.animationPlayState = "running";
            }, i * 300);
        });
    }, 1200);

    /* ── Feature tabs ── */
    window.fsw = (idx) => {
        document
            .querySelectorAll(".ftba")
            .forEach((t, i) => t.classList.toggle("on", i === idx));
        document
            .querySelectorAll(".fp")
            .forEach((p, i) => p.classList.toggle("on", i === idx));
        // Trigger chart bars for analytics tab
        if (idx === 1)
            setTimeout(
                () =>
                    document
                        .querySelectorAll(".cb")
                        .forEach((b) => b.classList.add("go")),
                50,
            );
        // Trigger sparkline for bento (already running)
    };

    /* ── Animate chart bars when analytics tab is first opened ── */
    document.querySelectorAll(".ftba").forEach((btn, i) => {
        btn.addEventListener("click", () => {
            if (i === 1)
                setTimeout(
                    () =>
                        document
                            .querySelectorAll("#fmb1 .cb")
                            .forEach((b) => b.classList.add("go")),
                    80,
                );
        });
    });

    /* ── Sparkline draw animation on bento grid in view ── */
    const spIO = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (e.isIntersecting) {
                    const p = document.getElementById("spark-p");
                    if (p) p.classList.add("go");
                    spIO.disconnect();
                }
            });
        },
        { threshold: 0.5 },
    );
    const bentCard = document.querySelector(".bcard-g");
    if (bentCard) spIO.observe(bentCard);

    /* ── Timeline fill on scroll ── */
    const tlFill = document.getElementById("tl-fill");
    const stepsWrap = document.querySelector(".steps-wrap");
    if (tlFill && stepsWrap) {
        const updateTl = () => {
            const rect = stepsWrap.getBoundingClientRect();
            const vh = window.innerHeight;
            if (rect.top > vh || rect.bottom < 0) return;
            const pct = Math.min(
                Math.max((vh - rect.top) / (rect.height + vh * 0.4), 0),
                1,
            );
            tlFill.style.height = pct * 100 + "%";
        };
        window.addEventListener("scroll", updateTl, { passive: true });
        updateTl();
    }

    /* ── Pomodoro timer countdown ── */
    let pmS = 24 * 60 + 37;
    const pmEl = document.getElementById("pm-t");
    setInterval(() => {
        pmS = pmS > 0 ? pmS - 1 : 25 * 60;
        const m = String(Math.floor(pmS / 60)).padStart(2, "0");
        const s = String(pmS % 60).padStart(2, "0");
        if (pmEl) pmEl.textContent = `${m}:${s}`;
    }, 1000);

    /* ── Stat counter animation ── */
    const cnums = document.querySelectorAll(".cnum");
    const cIO = new IntersectionObserver(
        (entries) => {
            entries.forEach((e) => {
                if (!e.isIntersecting) return;
                const el = e.target;
                const tgt = parseFloat(el.getAttribute("data-t"));
                const sfx = el.getAttribute("data-sfx") || "";
                const isF = tgt % 1 !== 0;
                const dur = 1600,
                    t0 = performance.now();
                const tick = (now) => {
                    const p = Math.min((now - t0) / dur, 1);
                    const v = tgt * (1 - Math.pow(1 - p, 3));
                    el.textContent =
                        (isF
                            ? v.toFixed(1)
                            : Math.floor(v).toLocaleString("pt-BR")) + sfx;
                    if (p < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
                cIO.unobserve(el);
            });
        },
        { threshold: 0.5 },
    );
    cnums.forEach((el) => cIO.observe(el));

    /* ── Typewriter in AI feature tab ── */
    const twBox = document.getElementById("tw-text");
    const twCur = document.getElementById("tw-cur");
    if (twBox) {
        const lines = [
            "> Analisando seu histórico...",
            "> Matérias detectadas: 4",
            "> Cálculo III: 2h/dia",
            "> Física II: 1h30/dia",
            "> Química: 1h/dia",
            "> Plano otimizado. ✓",
        ];
        let ci2 = 0,
            li = 0;
        const typeNext = () => {
            if (li >= lines.length) {
                li = 0;
                twBox.textContent = "";
            }
            const line = lines[li];
            if (ci2 <= line.length) {
                twBox.textContent =
                    lines.slice(0, li).join("\n") +
                    (li > 0 ? "\n" : "") +
                    line.slice(0, ci2);
                ci2++;
                setTimeout(typeNext, ci2 === line.length + 1 ? 800 : 45);
            } else {
                li++;
                ci2 = 0;
                setTimeout(typeNext, 200);
            }
        };
        setTimeout(typeNext, 800);
    }

    /* ── App mockup mouse parallax ── */
    const appSh = document.getElementById("app-sh");
    if (appSh) {
        document.addEventListener("mousemove", (e) => {
            const cx = window.innerWidth / 2,
                cy = window.innerHeight / 2;
            const rx2 = ((e.clientY - cy) / cy) * 5;
            const ry2 = -((e.clientX - cx) / cx) * 9;
            appSh.style.transform = `rotate(${2 - ry2 * 0.1}deg) translateY(-6px) rotateX(${rx2}deg) rotateY(${ry2}deg)`;
            appSh.style.transition = "transform .08s linear";
        });
    }

    /* ── Magnetic buttons ── */
    document.querySelectorAll(".btn-r").forEach((btn) => {
        btn.addEventListener("mousemove", (e) => {
            const r = btn.getBoundingClientRect();
            const dx = (e.clientX - (r.left + r.width / 2)) * 0.2;
            const dy = (e.clientY - (r.top + r.height / 2)) * 0.2;
            btn.style.transform = `translate(${dx}px,${dy}px)`;
        });
        btn.addEventListener("mouseleave", () => {
            btn.style.transform = "";
        });
    });

    /* ── Smooth anchor ── */
    document.querySelectorAll('a[href^="#"]').forEach((a) => {
        a.addEventListener("click", (e) => {
            const t = document.querySelector(a.getAttribute("href"));
            if (t) {
                e.preventDefault();
                t.scrollIntoView({ behavior: "smooth" });
            }
        });
    });
})();

/* ── Cursor trail ── */
(function () {
    const N = 8;
    const dots = [];
    const positions = Array.from({ length: N }, () => ({ x: 0, y: 0 }));
    for (let i = 0; i < N; i++) {
        const d = document.createElement("div");
        d.classList.add("c-trail");
        const s = (1 - i / N) * 7;
        d.style.width = s + "px";
        d.style.height = s + "px";
        d.style.opacity = (1 - i / N) * 0.5;
        d.style.zIndex = 9998 - i;
        document.body.appendChild(d);
        dots.push(d);
    }
    let mx = 0,
        my = 0;
    document.addEventListener("mousemove", (e) => {
        mx = e.clientX;
        my = e.clientY;
    });
    function tickT() {
        positions[0] = { x: mx, y: my };
        for (let i = 1; i < N; i++) {
            positions[i] = {
                x:
                    positions[i].x +
                    (positions[i - 1].x - positions[i].x) * 0.25,
                y:
                    positions[i].y +
                    (positions[i - 1].y - positions[i].y) * 0.25,
            };
        }
        dots.forEach((d, i) => {
            d.style.left = positions[i].x + "px";
            d.style.top = positions[i].y + "px";
        });
        requestAnimationFrame(tickT);
    }
    tickT();
})();

/* ── Ripple on btn-r click ── */
document.querySelectorAll(".btn-r").forEach((btn) => {
    btn.addEventListener("click", (e) => {
        const r = btn.getBoundingClientRect();
        const rip = document.createElement("span");
        rip.classList.add("btn-ripple");
        const size = Math.max(r.width, r.height);
        rip.style.width = rip.style.height = size + "px";
        rip.style.left = e.clientX - r.left - size / 2 + "px";
        rip.style.top = e.clientY - r.top - size / 2 + "px";
        btn.appendChild(rip);
        setTimeout(() => rip.remove(), 700);
    });
});

/* ── Mouse glow on glass cards ── */
document.querySelectorAll(".bcard, .tcard, .pcol, .fmb").forEach((card) => {
    card.addEventListener("mousemove", (e) => {
        const r = card.getBoundingClientRect();
        const x = ((e.clientX - r.left) / r.width) * 100;
        const y = ((e.clientY - r.top) / r.height) * 100;
        card.style.setProperty("--mx", x + "%");
        card.style.setProperty("--my", y + "%");
        const glow = `radial-gradient(circle at ${x}% ${y}%, rgba(255,28,75,0.07) 0%, transparent 55%)`;
        if (!card.classList.contains("bcard-a")) {
            card.style.background =
                glow +
                ", " +
                getComputedStyle(card).background.split(",").slice(1).join(",");
        }
    });
    card.addEventListener("mouseleave", () => {
        card.style.background = "";
    });
});

/* ── 3D tilt on app mockup (upgraded) ── */
const appSh2 = document.getElementById("app-sh");
if (appSh2) {
    document.addEventListener("mousemove", (e) => {
        const cx = window.innerWidth / 2,
            cy = window.innerHeight / 2;
        const ry2 = -((e.clientX - cx) / cx) * 12;
        const rx2 = ((e.clientY - cy) / cy) * 7;
        appSh2.style.transform = `rotate(${2 - ry2 * 0.12}deg) translateY(-6px) rotateX(${rx2}deg) rotateY(${ry2}deg) translateZ(10px)`;
        appSh2.style.transition = "transform .06s linear";
    });
}

/* ── Magnetic effect on all btn-r ── */
document.querySelectorAll(".btn-r,.btn-od").forEach((btn) => {
    btn.addEventListener("mousemove", (e) => {
        const r = btn.getBoundingClientRect();
        const dx = (e.clientX - (r.left + r.width / 2)) * 0.25;
        const dy = (e.clientY - (r.top + r.height / 2)) * 0.25;
        btn.style.transform = `translate(${dx}px,${dy}px)`;
    });
    btn.addEventListener("mouseleave", () => {
        btn.style.transform = "";
    });
});

/* ── Count-up enhancement: easing ── */
/* already handled above, extra glow on count ── */
document.querySelectorAll(".stn").forEach((el) => {
    el.style.transition = "text-shadow .6s";
});
