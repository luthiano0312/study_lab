(function () {
    /* LOADING → TUTORIAL → APP */
    var loading = document.getElementById("loading"),
        tutorial = document.getElementById("tutorial"),
        app = document.getElementById("app"),
        loadMsg = document.getElementById("load-msg");
    var msgs = [
        "\u25AA Inicializando ambiente de foco...",
        "\u25AA Carregando timer Pomodoro...",
        "\u25AA Verificando sessao do usuario...",
        "\u25AA Sistema pronto!",
    ];
    var mi = 0,
        msgInt = setInterval(function () {
            mi = (mi + 1) % msgs.length;
            if (loadMsg) loadMsg.textContent = msgs[mi];
        }, 720);
    setTimeout(function () {
        clearInterval(msgInt);
        if (loadMsg) loadMsg.textContent = "\u25AA Sistema pronto!";
        loading.classList.add("out");
        setTimeout(function () {
            loading.style.display = "none";
            app.classList.add("visible");
            tutorial.classList.add("show");
        }, 700);
    }, 2900);
    /* TUTORIALllllllllllllllllll */
    var step = 1,
        TOTAL_STEPS = 8,
        backBtn = document.getElementById("tut-back"),
        nextBtn = document.getElementById("tut-next"),
        enterBtn = document.getElementById("enter-focus"),
        dots = document.querySelectorAll("#sdots .sdot");

    function goStep(n) {
        document.querySelectorAll(".tstep").forEach(function (s, i) {
            s.classList.toggle("on", i === n - 1);
        });
        dots.forEach(function (d, i) {
            d.classList.toggle("on", i === n - 1);
        });
        backBtn.style.display = n === 1 ? "none" : "";
        nextBtn.style.display = n === TOTAL_STEPS ? "none" : "";
        if (enterBtn)
            enterBtn.style.display = n === TOTAL_STEPS ? "flex" : "none";
        step = n;
    }

    if (nextBtn)
        nextBtn.addEventListener("click", function () {
            if (step < TOTAL_STEPS) goStep(step + 1);
        });

    if (backBtn)
        backBtn.addEventListener("click", function () {
            if (step > 1) goStep(step - 1);
        });

    dots.forEach(function (d, i) {
        d.addEventListener("click", function () {
            goStep(i + 1);
        });
    });

    var ef = document.getElementById("enter-focus");
    if (ef)
        ef.addEventListener("click", function () {
            tutorial.classList.remove("show");
            setTimeout(function () {
                tutorial.style.display = "none";
            }, 450);
        });

    var rt = document.getElementById("reopen-tut");
    if (rt)
        rt.addEventListener("click", function () {
            tutorial.style.display = "";
            goStep(1);
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    tutorial.classList.add("show");
                });
            });
        });

    /* SIDEBAR */
    var sidebar = document.getElementById("sidebar"),
        sbArrow = document.getElementById("sb-arrow"),
        sbExp = false;
    var sbt = document.getElementById("sb-toggle");
    if (sbt)
        sbt.addEventListener("click", function () {
            sbExp = !sbExp;
            sidebar.classList.toggle("exp", sbExp);
            if (sbArrow)
                sbArrow.style.transform = sbExp ? "rotate(180deg)" : "";
        });

    /* TIMER */
    var PHASES = [
        { n: "FOCO", b: "FOCO", next: "pausa curta", s: 1500 },
        { n: "PAUSA", b: "PAUSA", next: "foco", s: 300 },
        { n: "PAUSA LONGA", b: "PAUSA LONGA", next: "foco", s: 900 },
    ];
    var pi = 0,
        secsLeft = 1500,
        running = false,
        iv = null,
        cycles = 0,
        sessDay = 0,
        focMin = 0,
        sndOn = true;
    var timerEl = document.getElementById("timer-digits"),
        phaseLbl = document.getElementById("phase-lbl"),
        phaseBadge = document.getElementById("phase-badge"),
        phaseNext = document.getElementById("phase-next");
    var playBtn = document.getElementById("play-btn"),
        playLbl = document.getElementById("play-lbl");
    var ringFill = document.getElementById("ring-fill"),
        timerWrap = document.getElementById("timer-wrap"),
        cyLbl = document.getElementById("cy-lbl");
    var statSess = document.getElementById("stat-sessions"),
        statFoc = document.getElementById("stat-focus"),
        sessBar = document.getElementById("sess-bar"),
        soundIcon = document.getElementById("sound-icon");
    var TIPS = [
        "Durante o Pomodoro, evite verificar o celular. Cada interrupcao leva cerca de 20 minutos para recuperar o foco total.",
        "Anote tudo que vier a mente num papel ao lado — isso libera espaco mental sem quebrar o timer.",
        "Mantenha uma garrafa de agua na mesa. Hidratacao adequada melhora em ate 14% a concentracao.",
        "Revisar o conteudo nas primeiras 24h apos aprender aumenta a retencao em ate 60%.",
        "Espaco fisico importa: mesa organizada e luz adequada potencializam o foco significativamente.",
    ];
    var tipI = 0,
        tipEl = document.getElementById("tip-text");
    if (tipEl) {
        tipEl.style.transition = "opacity 0.3s";
        setInterval(function () {
            tipI = (tipI + 1) % TIPS.length;
            tipEl.style.opacity = 0;
            setTimeout(function () {
                tipEl.textContent = TIPS[tipI];
                tipEl.style.opacity = 1;
            }, 300);
        }, 30000);
    }
    function fmt(s) {
        return (
            String(Math.floor(s / 60)).padStart(2, "0") +
            ":" +
            String(s % 60).padStart(2, "0")
        );
    }
    function updateRing() {
        var o = 440 * (1 - secsLeft / PHASES[pi].s);
        if (ringFill) ringFill.style.strokeDashoffset = o;
    }
    function updateCycles() {
        for (var i = 1; i <= 4; i++) {
            var d = document.getElementById("cy" + i);
            if (!d) continue;
            if (i <= cycles) {
                d.style.background = "linear-gradient(135deg,#ec4899,#9333ea)";
                d.style.border = "none";
                d.style.boxShadow = "0 0 8px rgba(236,72,153,0.5)";
            } else {
                d.style.background = "rgba(255,255,255,0.08)";
                d.style.border = "1px solid rgba(255,255,255,0.12)";
                d.style.boxShadow = "";
            }
        }
        if (cyLbl) cyLbl.textContent = cycles + "/4";
    }
    function setIcon(svg) {
        var el = document.getElementById("play-icon");
        if (el) el.outerHTML = svg;
    }
    function setPhase(idx) {
        pi = idx % 3;
        secsLeft = PHASES[pi].s;
        if (timerEl) timerEl.textContent = fmt(secsLeft);
        if (phaseLbl) phaseLbl.textContent = PHASES[pi].n;
        if (phaseBadge) {
            var f = pi === 0;
            phaseBadge.textContent = PHASES[pi].b;
            phaseBadge.style.color = f ? "#ec4899" : "#34d399";
            phaseBadge.style.background = f
                ? "rgba(236,72,153,0.1)"
                : "rgba(52,211,153,0.1)";
            phaseBadge.style.borderColor = f
                ? "rgba(236,72,153,0.22)"
                : "rgba(52,211,153,0.22)";
        }
        if (phaseNext) phaseNext.textContent = "Proximo: " + PHASES[pi].next;
        running = false;
        clearInterval(iv);
        if (timerWrap) timerWrap.classList.remove("running");
        setIcon(
            '<svg id="play-icon" width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4l15 8-15 8V4z"/></svg>',
        );
        if (playLbl) playLbl.textContent = "Iniciar";
        updateRing();
    }
    function tick() {
        if (secsLeft <= 0) {
            clearInterval(iv);
            running = false;
            if (timerWrap) timerWrap.classList.remove("running");
            if (pi === 0) {
                sessDay++;
                focMin += 25;
                cycles = Math.min(cycles + 1, 4);
                if (statSess) statSess.textContent = sessDay;
                if (statFoc)
                    statFoc.innerHTML =
                        focMin + '<span style="font-size:0.88rem;">min</span>';
                if (sessBar)
                    sessBar.style.width =
                        Math.min((sessDay / 4) * 100, 100) + "%";
                updateCycles();
                var lb = cycles >= 4;
                setPhase(lb ? 2 : 1);
                if (lb) cycles = 0;
            } else {
                setPhase(0);
            }
            return;
        }
        secsLeft--;
        if (timerEl) timerEl.textContent = fmt(secsLeft);
        updateRing();
    }
    if (playBtn)
        playBtn.addEventListener("click", function () {
            if (!running) {
                running = true;
                iv = setInterval(tick, 1000);
                if (timerWrap) timerWrap.classList.add("running");
                if (phaseLbl) phaseLbl.textContent = PHASES[pi].n;
                setIcon(
                    '<svg id="play-icon" width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><rect x="6" y="4" width="4" height="16"/><rect x="14" y="4" width="4" height="16"/></svg>',
                );
                if (playLbl) playLbl.textContent = "Pausar";
            } else {
                running = false;
                clearInterval(iv);
                if (timerWrap) timerWrap.classList.remove("running");
                setIcon(
                    '<svg id="play-icon" width="15" height="15" fill="currentColor" viewBox="0 0 24 24"><path d="M6 4l15 8-15 8V4z"/></svg>',
                );
                if (playLbl) playLbl.textContent = "Continuar";
            }
        });
    var rb = document.getElementById("reset-btn");
    if (rb)
        rb.addEventListener("click", function () {
            clearInterval(iv);
            running = false;
            setPhase(pi);
        });
    var sk = document.getElementById("skip-btn");
    if (sk)
        sk.addEventListener("click", function () {
            clearInterval(iv);
            running = false;
            setPhase(pi === 0 ? 1 : 0);
        });
    var sndBtn = document.getElementById("sound-btn");
    if (sndBtn)
        sndBtn.addEventListener("click", function () {
            sndOn = !sndOn;
            if (soundIcon) soundIcon.style.opacity = sndOn ? "1" : "0.3";
        });
    var curSub = document.getElementById("cur-sub");
    document.querySelectorAll(".sub-tag").forEach(function (t) {
        t.addEventListener("click", function () {
            document.querySelectorAll(".sub-tag").forEach(function (x) {
                x.classList.remove("on");
            });
            t.classList.add("on");
            if (curSub) curSub.textContent = t.dataset.s;
        });
    });
    var bqPanel = document.getElementById("bq-panel");
    var bqBtn = document.getElementById("bq-btn");
    if (bqBtn)
        bqBtn.addEventListener("click", function () {
            if (bqPanel) bqPanel.classList.toggle("open");
        });
    var cbq = document.getElementById("close-bq");
    if (cbq)
        cbq.addEventListener("click", function () {
            if (bqPanel) bqPanel.classList.remove("open");
        });
    updateRing();
    updateCycles();

    var skipBtn = document.getElementById("tut-skip");
    if (skipBtn)
        skipBtn.addEventListener("click", function () {
            tutorial.classList.remove("show");
            setTimeout(function () {
                tutorial.style.display = "none";
            }, 450);
        });
})();
