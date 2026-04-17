<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyLab — Estude com inteligência</title>
    <link rel="icon" type="image/png" href="{{ asset('favicons/logo/dar-logo.ico') }}">
    <meta name="description" content="Plataforma de estudos com IA para estudantes que querem evoluir com dados.">

    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=DM+Mono:ital,opsz,wght@0,14,300;0,14,400;0,14,500;1,14,300&display=swap" rel="stylesheet">

    <style>
    /* ══════════════════════════════════════
       TOKENS
    ══════════════════════════════════════ */
    :root {
        --ink:   #0A0A0A;
        --ink-2: #141414;
        --ink-3: #1E1E1E;
        --cream: #F0EDE6;
        --cr2:   #E4E0D8;
        --acc:   #FF1C4B;
        --acc2:  #FF5070;
        --white: #FAFAF7;
        --md:    rgba(250,250,247,0.35);   /* muted dark */
        --ml:    rgba(10,10,10,0.42);      /* muted light */
        --ld:    rgba(250,250,247,0.08);   /* line dark */
        --ll:    rgba(10,10,10,0.1);       /* line light */

        /* Glass — used ONLY on floating/overlay elements */
        --gd: rgba(14,14,14,0.72);         /* dark glass bg */
        --gl: rgba(244,241,234,0.72);      /* light glass bg */

        --fh: 'Unbounded', sans-serif;
        --fb: 'DM Mono', monospace;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
        background: var(--ink);
        color: var(--white);
        font-family: var(--fb);
        font-size: 0.87rem;
        font-weight: 400;
        line-height: 1.7;
        overflow-x: hidden;
        cursor: none;
        -webkit-font-smoothing: antialiased;
    }

    /* Grain */
    body::after {
        content: ''; position: fixed; inset: 0; z-index: 9000;
        pointer-events: none; opacity: 0.048; mix-blend-mode: overlay;
        background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.88' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
        background-size: 180px 180px;
    }

    /* ── Scroll progress bar ── */
    #prog {
        position: fixed; top: 0; left: 0; z-index: 9999;
        height: 2px; background: var(--acc);
        transform-origin: left; transform: scaleX(0);
        width: 100%; pointer-events: none;
        transition: transform .05s linear;
    }

    /* ── Custom cursor ── */
    #c-d {
        position: fixed; width: 7px; height: 7px;
        background: var(--acc); border-radius: 50%;
        pointer-events: none; z-index: 10000;
        transform: translate(-50%,-50%);
        transition: transform .15s, background .2s;
        will-change: left, top;
    }
    #c-r {
        position: fixed; width: 32px; height: 32px;
        border: 1px solid rgba(250,250,247,0.3);
        border-radius: 50%; pointer-events: none; z-index: 9999;
        transform: translate(-50%,-50%);
        transition: width .35s cubic-bezier(.23,1,.32,1),
                    height .35s cubic-bezier(.23,1,.32,1),
                    border-color .25s;
        will-change: left, top;
    }
    body.ch #c-d { transform: translate(-50%,-50%) scale(3.5); }
    body.ch #c-r { width: 54px; height: 54px; border-color: var(--acc); }

    /* ── Glass utils ── */
    .gd {
        background: var(--gd);
        backdrop-filter: blur(22px) saturate(160%);
        -webkit-backdrop-filter: blur(22px) saturate(160%);
        border: 1px solid rgba(255,255,255,0.09);
    }
    .gl {
        background: var(--gl);
        backdrop-filter: blur(22px) saturate(160%);
        -webkit-backdrop-filter: blur(22px) saturate(160%);
        border: 1px solid rgba(10,10,10,0.1);
    }

    /* ── Typography ── */
    h1,h2,h3,h4 { font-family: var(--fh); font-weight: 900; line-height: 1.03; letter-spacing: -0.03em; }
    .d1 { font-size: clamp(3.6rem, 10vw, 9rem); }
    .d2 { font-size: clamp(2.5rem, 5.5vw, 5rem); }
    .d3 { font-size: clamp(1.8rem, 3.2vw, 2.8rem); }
    .d4 { font-size: clamp(1.15rem, 1.8vw, 1.6rem); }
    .lbl {
        font-family: var(--fb); font-size: 0.63rem;
        letter-spacing: .18em; text-transform: uppercase;
        color: var(--acc); font-weight: 500;
    }
    .body-l { font-size: .98rem; line-height: 1.75; color: var(--md); }
    .body-l.lt { color: var(--ml); }
    .acc-bar { display: inline-block; width: 26px; height: 2px; background: var(--acc); vertical-align: middle; margin-right: 10px; }
    a { text-decoration: none; }

    /* ── Buttons ── */
    .btn {
        display: inline-flex; align-items: center; gap: 10px;
        font-family: var(--fh); font-weight: 700; font-size: 0.67rem;
        letter-spacing: .06em; text-transform: uppercase;
        cursor: none; border: 1px solid transparent;
        border-radius: 8px; padding: 15px 30px;
        transition: transform .22s cubic-bezier(.23,1,.32,1), box-shadow .22s;
        position: relative; overflow: hidden;
    }
    .btn-r {
        background: var(--acc); color: #fff;
        box-shadow: 0 6px 28px rgba(255,28,75,0.38);
    }
    .btn-r::before {
        content: ''; position: absolute; inset: 0;
        background: rgba(255,255,255,0.18);
        transform: translateX(-110%) skewX(-20deg);
        transition: transform .48s ease;
    }
    .btn-r:hover::before { transform: translateX(120%) skewX(-20deg); }
    .btn-r:hover { transform: translateY(-3px); box-shadow: 0 16px 44px rgba(255,28,75,0.52); }
    .btn-od { background: transparent; color: var(--white); border-color: var(--ld); }
    .btn-od:hover { border-color: rgba(250,250,247,.28); transform: translateY(-1px); }
    .btn-ol { background: transparent; color: var(--ink); border-color: var(--ll); }
    .btn-ol:hover { border-color: rgba(10,10,10,.28); }

    /* ── Layout ── */
    .container { max-width: 1280px; margin: 0 auto; padding: 0 48px; }
    .sec { padding: 120px 0; }
    hr.rd { border: none; border-top: 1px solid var(--ld); }
    hr.rl { border: none; border-top: 1px solid var(--ll); }

    /* ── Clip reveal ── */
    .cw { display: block; overflow: hidden; }
    .ci { display: block; transform: translateY(110%); transition: transform .95s cubic-bezier(.16,1,.3,1); }
    .ci.in { transform: translateY(0); }
    .ca1 .ci { transition-delay: .04s; }
    .ca2 .ci { transition-delay: .17s; }
    .ca3 .ci { transition-delay: .30s; }
    .ca4 .ci { transition-delay: .43s; }

    /* ── Scroll reveal ── */
    .sr { opacity: 0; transform: translateY(24px); transition: opacity .8s cubic-bezier(.23,1,.32,1), transform .8s cubic-bezier(.23,1,.32,1); }
    .sr.in { opacity: 1; transform: none; }
    .srx { opacity: 0; transform: translateX(-28px); transition: opacity .8s cubic-bezier(.23,1,.32,1), transform .8s cubic-bezier(.23,1,.32,1); }
    .srx.in { opacity: 1; transform: none; }
    .srr { opacity: 0; transform: translateX(28px); transition: opacity .8s cubic-bezier(.23,1,.32,1), transform .8s cubic-bezier(.23,1,.32,1); }
    .srr.in { opacity: 1; transform: none; }
    .ss { opacity: 0; transform: scale(.9); transition: opacity .8s cubic-bezier(.23,1,.32,1), transform .8s cubic-bezier(.23,1,.32,1); }
    .ss.in { opacity: 1; transform: scale(1); }
    .d1s { transition-delay: .08s; } .d2s { transition-delay: .18s; }
    .d3s { transition-delay: .28s; } .d4s { transition-delay: .38s; }
    .d5s { transition-delay: .48s; }

    /* ── Float keyframes ── */
    @keyframes float-a { 0%,100%{ transform: translateY(0px) rotate(0deg); } 50%{ transform: translateY(-12px) rotate(.5deg); } }
    @keyframes float-b { 0%,100%{ transform: translateY(-6px); } 50%{ transform: translateY(8px); } }
    @keyframes float-c { 0%,100%{ transform: translateY(4px) rotate(-.3deg); } 50%{ transform: translateY(-10px) rotate(.3deg); } }
    @keyframes pulse-d { 0%,100%{ opacity:.5; transform: scale(1); } 50%{ opacity:1; transform: scale(1.05); } }
    @keyframes spin-s { to{ transform: rotate(360deg); } }
    @keyframes draw { to{ stroke-dashoffset: 0; } }
    @keyframes blink { 0%,100%{ opacity:1; } 50%{ opacity:0; } }

    /* ══════════════════════════════════════
       HEADER
    ══════════════════════════════════════ */
    #hdr {
        position: fixed; top: 0; left: 0; right: 0; z-index: 500;
        background: transparent; border-bottom: 1px solid transparent;
        transition: background .4s, border-color .4s;
    }
    #hdr.solid { background: var(--gd); backdrop-filter: blur(28px) saturate(160%); -webkit-backdrop-filter: blur(28px) saturate(160%); border-bottom-color: var(--ld); }
    .hi { max-width: 1280px; margin: 0 auto; padding: 0 48px; height: 68px; display: flex; align-items: center; justify-content: space-between; }
    .hnav { display: flex; align-items: center; gap: 34px; list-style: none; }
    .hnav a { font-family: var(--fb); font-size: 0.7rem; font-weight: 500; letter-spacing: .1em; text-transform: uppercase; color: var(--md); text-decoration: none; transition: color .2s; }
    .hnav a:hover { color: var(--white); }

    /* ══════════════════════════════════════
       HERO
    ══════════════════════════════════════ */
    #hero {
        min-height: 100svh; display: grid;
        grid-template-columns: 55% 45%;
        padding-top: 68px; position: relative; overflow: hidden;
    }
    #hero::after {
        content: ''; position: absolute; top: 0; bottom: 0; right: 0;
        width: 48%; background: var(--ink-2); z-index: 0;
        clip-path: polygon(9% 0%, 100% 0%, 100% 100%, 0% 100%);
    }
    .hl { padding: 80px 48px 80px 48px; display: flex; flex-direction: column; justify-content: center; position: relative; z-index: 2; }
    .hr { display: flex; align-items: center; justify-content: center; padding: 80px 48px 80px 24px; position: relative; z-index: 2; }

    /* Floating glass pills */
    .fpill {
        position: absolute;
        border-radius: 100px;
        padding: 10px 18px;
        display: flex; align-items: center; gap: 10px;
        font-size: .72rem; font-weight: 500; white-space: nowrap;
        opacity: 0; transform: translateY(16px) scale(.95);
        transition: opacity .6s cubic-bezier(.23,1,.32,1), transform .6s cubic-bezier(.23,1,.32,1);
        will-change: transform;
        z-index: 10;
    }
    .fpill.show { opacity: 1; transform: translateY(0) scale(1); }
    .fpill-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; animation: pulse-d 2s ease-in-out infinite; }

    /* App mockup */
    .app {
        width: 100%; max-width: 360px;
        background: var(--ink);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 40px 90px rgba(0,0,0,0.6), 0 0 0 1px rgba(255,255,255,0.04);
        transform: rotate(2deg) translateY(-6px);
        transition: transform .6s cubic-bezier(.23,1,.32,1);
        position: relative; z-index: 5;
    }
    .app:hover { transform: rotate(0deg) translateY(-18px); }
    .atb { background: var(--ink-2); border-bottom: 1px solid rgba(255,255,255,0.06); padding: 13px 18px; display: flex; align-items: center; gap: 7px; }
    .td { width: 9px; height: 9px; border-radius: 50%; }
    .abb { padding: 28px 24px 24px; }

    /* PM ring */
    .pmw { position: relative; display: flex; justify-content: center; margin-bottom: 20px; }
    .pmw svg { transform: rotate(-90deg); }
    .pmk { fill: none; stroke: rgba(255,255,255,0.06); stroke-width: 6; }
    .pmp { fill: none; stroke: var(--acc); stroke-width: 6; stroke-linecap: round; stroke-dasharray: 408; stroke-dashoffset: 90; animation: pm-tick 1500s linear forwards; }
    @keyframes pm-tick { to { stroke-dashoffset: 510; } }
    .pml { position: absolute; inset: 0; display: flex; flex-direction: column; align-items: center; justify-content: center; }
    .pmt { font-family: var(--fh); font-weight: 900; font-size: 1.9rem; color: var(--white); letter-spacing: -.04em; }
    .pms { font-size: .58rem; color: var(--md); text-transform: uppercase; letter-spacing: .12em; margin-top: 3px; }

    /* Chips */
    .cpr { display: grid; grid-template-columns: repeat(3,1fr); gap: 7px; margin-bottom: 18px; }
    .cp { background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.07); border-radius: 10px; padding: 11px 5px; text-align: center; }
    .cpv { font-family: var(--fh); font-size: .95rem; font-weight: 700; line-height: 1; }
    .cpl { font-size: .55rem; color: var(--md); text-transform: uppercase; letter-spacing: .1em; margin-top: 4px; }

    /* Week */
    .wkr { display: flex; gap: 5px; }
    .wkd { flex: 1; text-align: center; }
    .wkb { width: 100%; aspect-ratio: 1; border-radius: 5px; margin-bottom: 4px; display: flex; align-items: center; justify-content: center; }
    .wkl { font-size: .55rem; color: var(--md); }

    /* ══════════════════════════════════════
       MARQUEE
    ══════════════════════════════════════ */
    .mqb { background: var(--acc); overflow: hidden; padding: 15px 0; }
    .mqt { display: flex; white-space: nowrap; animation: mq 20s linear infinite; will-change: transform; }
    .mqi { font-family: var(--fh); font-weight: 700; font-size: .72rem; letter-spacing: .12em; text-transform: uppercase; color: #fff; padding: 0 22px; flex-shrink: 0; }
    .mqsep { color: rgba(255,255,255,0.5); }
    @keyframes mq { from{ transform: translateX(0); } to{ transform: translateX(-50%); } }

    /* Live activity marquee */
    .lmb { background: var(--ink-2); overflow: hidden; padding: 10px 0; border-bottom: 1px solid var(--ld); }
    .lmt { display: flex; white-space: nowrap; animation: mq 35s linear infinite; will-change: transform; }
    .lmi { font-family: var(--fb); font-size: .62rem; letter-spacing: .06em; color: var(--md); padding: 0 20px; flex-shrink: 0; }
    .lma { color: var(--acc); }

    /* ══════════════════════════════════════
       STATS
    ══════════════════════════════════════ */
    .stg { display: grid; grid-template-columns: repeat(4,1fr); background: var(--ld); gap: 1px; }
    .stc { background: var(--ink-2); padding: 52px 36px; position: relative; overflow: hidden; }
    .stc::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 2px; background: transparent; transition: background .4s; }
    .stc:hover::before { background: var(--acc); }
    .stn { font-family: var(--fh); font-weight: 900; font-size: clamp(2.2rem, 4.5vw, 3.6rem); color: var(--white); line-height: 1; margin-bottom: 10px; }
    .stl { font-size: .68rem; text-transform: uppercase; letter-spacing: .1em; color: var(--md); }

    /* ══════════════════════════════════════
       FEATURES — tabs
    ══════════════════════════════════════ */
    .ftb { display: flex; border-bottom: 1px solid var(--ld); margin-bottom: 56px; overflow-x: auto; scrollbar-width: none; }
    .ftb::-webkit-scrollbar { display: none; }
    .ftba {
        font-family: var(--fb); font-size: .68rem; font-weight: 500;
        text-transform: uppercase; letter-spacing: .1em; color: var(--md);
        background: transparent; border: none; padding: 15px 24px; cursor: none;
        white-space: nowrap; border-bottom: 2px solid transparent; margin-bottom: -1px;
        transition: color .2s, border-color .2s;
    }
    .ftba:hover { color: var(--white); }
    .ftba.on { color: var(--white); border-bottom-color: var(--acc); }
    .fp { display: none; }
    .fp.on { display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }

    /* Feature mockup box */
    .fmb {
        border: 1px solid var(--ld); border-radius: 18px;
        background: var(--ink-2); overflow: hidden;
        aspect-ratio: 4/3; position: relative;
    }
    .fmb-pad { padding: 24px; height: 100%; display: flex; flex-direction: column; }

    /* Animated chart (analytics tab) */
    .chart-bars { display: flex; align-items: flex-end; gap: 8px; height: 80px; margin-top: auto; }
    .cb { flex: 1; border-radius: 4px 4px 0 0; background: var(--acc); transform-origin: bottom; transform: scaleY(0); transition: transform .8s cubic-bezier(.23,1,.32,1); }
    .fmb .cb.go { transform: scaleY(1); }

    /* Flashcard flip */
    .flip-scene { width: 100%; height: 140px; perspective: 600px; margin-top: auto; }
    .flip-card { width: 100%; height: 100%; position: relative; transform-style: preserve-3d; animation: flip-loop 4s ease-in-out infinite; }
    @keyframes flip-loop { 0%,40%{ transform: rotateY(0deg); } 50%,90%{ transform: rotateY(180deg); } 100%{ transform: rotateY(0deg); } }
    .flip-f, .flip-b {
        position: absolute; inset: 0; border-radius: 12px;
        backface-visibility: hidden; -webkit-backface-visibility: hidden;
        display: flex; align-items: center; justify-content: center; padding: 20px;
        font-family: var(--fh); font-weight: 700; font-size: .9rem; text-align: center;
    }
    .flip-f { background: var(--ink-3); border: 1px solid var(--ld); color: var(--white); }
    .flip-b { background: var(--acc); transform: rotateY(180deg); color: #fff; }

    /* AI plan typewriter */
    .tw-line { border-right: 2px solid var(--acc); padding-right: 3px; animation: blink 1s step-end infinite; }

    /* Timer mini (foco tab) */
    .mini-timer { display: flex; justify-content: center; align-items: center; margin-top: auto; }

    /* Group avatars */
    .gav-stack { display: flex; }
    .gav { width: 36px; height: 36px; border-radius: 50%; border: 2px solid var(--ink-2); display: flex; align-items: center; justify-content: center; font-family: var(--fh); font-size: .75rem; font-weight: 900; color: #fff; margin-left: -10px; }
    .gav:first-child { margin-left: 0; }

    /* ══════════════════════════════════════
       BENTO GRID — "App em ação"
    ══════════════════════════════════════ */
    .bento { display: grid; grid-template-columns: repeat(3,1fr); grid-template-rows: auto auto; gap: 16px; }
    .bcard { border-radius: 18px; padding: 28px; overflow: hidden; position: relative; transition: transform .4s cubic-bezier(.23,1,.32,1); }
    .bcard:hover { transform: translateY(-6px); }
    .bcard::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 1px; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.12), transparent); }
    .bcard-lg { grid-column: span 2; }
    .bcard-sm { grid-column: span 1; }
    .bcard-d { background: var(--ink-2); border: 1px solid var(--ld); }
    .bcard-a { background: var(--acc); border: 1px solid rgba(255,100,120,0.4); }
    .bcard-g { background: var(--gd); backdrop-filter: blur(20px) saturate(140%); -webkit-backdrop-filter: blur(20px) saturate(140%); border: 1px solid rgba(255,255,255,0.1); }

    /* Sparkline SVG */
    .spark { overflow: visible; }
    .spark-path { fill: none; stroke: var(--acc); stroke-width: 2; stroke-linecap: round; stroke-dasharray: 300; stroke-dashoffset: 300; }
    .spark-path.go { animation: draw .9s cubic-bezier(.23,1,.32,1) forwards; }

    /* Mini donut */
    .donut-track { fill: none; stroke: rgba(255,255,255,.08); stroke-width: 8; }
    .donut-fill { fill: none; stroke-width: 8; stroke-linecap: round; stroke-dasharray: 188; stroke-dashoffset: 48; }

    /* ══════════════════════════════════════
       STEPS — timeline
    ══════════════════════════════════════ */
    .steps-wrap { position: relative; padding-left: 80px; }
    .tl-line { position: absolute; left: 28px; top: 28px; bottom: 28px; width: 2px; background: var(--ld); overflow: hidden; }
    .tl-fill { position: absolute; top: 0; left: 0; width: 100%; background: var(--acc); height: 0%; transition: height 1s cubic-bezier(.23,1,.32,1); }
    .step-row { display: grid; grid-template-columns: 1fr; padding: 44px 0; border-bottom: 1px solid var(--ld); position: relative; }
    .step-row::before { content: attr(data-n); position: absolute; left: -80px; font-family: var(--fh); font-weight: 900; font-size: 4rem; color: var(--acc); line-height: 1; top: 40px; }
    .step-row::after { content: ''; position: absolute; left: -72px; top: 50%; transform: translateY(-50%); width: 12px; height: 12px; border-radius: 50%; background: var(--ink); border: 2px solid var(--acc); z-index: 1; }
    .step-row:last-child { border-bottom: none; }

    /* ══════════════════════════════════════
       TESTIMONIALS
    ══════════════════════════════════════ */
    #testi { background: var(--cream); }
    .pq { font-family: var(--fh); font-weight: 900; font-size: clamp(1.5rem, 2.8vw, 2.5rem); line-height: 1.18; letter-spacing: -.025em; color: var(--ink); }
    .qm { font-family: var(--fh); font-size: 6.5rem; color: var(--acc); line-height: .55; display: block; margin-bottom: 16px; user-select: none; }

    /* Glass cards on cream bg */
    .tgrid { display: grid; grid-template-columns: repeat(3,1fr); gap: 16px; margin-top: 72px; }
    .tcard {
        border-radius: 16px; padding: 28px;
        background: var(--gd);
        backdrop-filter: blur(18px) saturate(150%);
        -webkit-backdrop-filter: blur(18px) saturate(150%);
        border: 1px solid rgba(255,255,255,0.1);
        transition: transform .4s cubic-bezier(.23,1,.32,1), border-color .3s;
    }
    .tcard:hover { transform: translateY(-8px); border-color: rgba(255,28,75,0.25); }
    .tav { width: 36px; height: 36px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-family: var(--fh); font-weight: 900; font-size: .78rem; color: #fff; flex-shrink: 0; }

    /* ══════════════════════════════════════
       PRICING
    ══════════════════════════════════════ */
    .pgrid { display: grid; grid-template-columns: repeat(3,1fr); background: var(--ld); gap: 1px; border-radius: 18px; overflow: hidden; }
    .pcol { background: var(--ink-2); padding: 44px 32px; transition: transform .4s cubic-bezier(.23,1,.32,1); }
    .pcol:hover { transform: translateY(-4px); z-index: 1; }
    .pcol.ft { background: var(--acc); transform: translateY(-8px); box-shadow: 0 24px 60px rgba(255,28,75,0.3); }
    .pcol.ft:hover { transform: translateY(-14px); }
    .pn { font-family: var(--fh); font-size: .9rem; font-weight: 700; }
    .pa { font-family: var(--fh); font-weight: 900; font-size: 3.4rem; line-height: 1; color: var(--white); }
    .pf { display: flex; align-items: center; gap: 10px; font-size: .76rem; color: var(--md); padding: 8px 0; border-bottom: 1px solid var(--ld); }
    .pcol.ft .pf { border-bottom-color: rgba(255,255,255,.2); color: rgba(255,255,255,.85); }
    .pf:last-of-type { border-bottom: none; }

    /* ══════════════════════════════════════
       CTA
    ══════════════════════════════════════ */
    #cta { background: var(--ink); position: relative; overflow: hidden; }
    .cta-ghost {
        position: absolute; top: 50%; left: 50%; transform: translate(-50%,-50%);
        font-family: var(--fh); font-weight: 900;
        font-size: clamp(5rem, 18vw, 20rem); line-height: 1;
        color: rgba(255,255,255,0.023); white-space: nowrap;
        letter-spacing: -.05em; pointer-events: none; user-select: none;
    }

    /* Floating glass element in CTA */
    .cta-glass-card {
        position: absolute; border-radius: 16px; padding: 16px 22px;
        pointer-events: none;
    }

    /* ══════════════════════════════════════
       FOOTER
    ══════════════════════════════════════ */
    #ftr { background: var(--ink-2); border-top: 1px solid var(--ld); padding: 60px 0 44px; }

    /* ══════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════ */
    @media (max-width: 960px) {
        #hero { grid-template-columns: 1fr; }
        #hero::after { display: none; }
        .hl { padding: 80px 24px 60px; }
        .hr { display: none; }
        .hnav { display: none; }
        .container { padding: 0 24px; }
        .sec { padding: 80px 0; }
        .stg { grid-template-columns: 1fr 1fr; }
        .steps-wrap { padding-left: 48px; }
        .tl-line { left: 12px; }
        .step-row::before { left: -48px; font-size: 2.5rem; }
        .step-row::after { left: -39px; }
        .tgrid { grid-template-columns: 1fr; }
        .pgrid { grid-template-columns: 1fr; }
        .fp.on { grid-template-columns: 1fr; gap: 40px; }
        .bento { grid-template-columns: 1fr; }
        .bcard-lg { grid-column: span 1; }
    }
    @media (max-width: 560px) {
        .stg { grid-template-columns: 1fr 1fr; }
        .stc { padding: 36px 20px; }
        .hi { padding: 0 20px; }
        .container { padding: 0 20px; }
    }
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: var(--ink); }
    ::-webkit-scrollbar-thumb { background: var(--acc); border-radius: 2px; }
    </style>
</head>
<body>

    <!-- Scroll progress bar -->
    <div id="prog"></div>

    <!-- Custom cursor -->
    <div id="c-d"></div>
    <div id="c-r"></div>

    <!-- ══════════════════════════════════════
         HEADER
    ══════════════════════════════════════ -->
    <header id="hdr">
        <div class="hi">
            <a href="#" style="cursor:none;"><img src="{{ asset('images/logo-dark-mode.png') }}" alt="StudyLab" style="height:100px;"></a>
            <ul class="hnav">
                <li><a href="#features">Recursos</a></li>
                <li><a href="#app-action">App</a></li>
                <li><a href="#process">Processo</a></li>
                <li><a href="#testi">Histórias</a></li>
                <li><a href="#pricing">Preços</a></li>
            </ul>
            <div style="display:flex;align-items:center;gap:10px;">
                <a href="{{ route('login') }}" class="btn btn-od" style="padding:10px 20px;font-size:.64rem;">Entrar</a>
                <a href="{{ route('register') }}" class="btn btn-r" style="padding:10px 20px;font-size:.64rem;">
                    Começar grátis
                    <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
            </div>
        </div>
    </header>


    <!-- ══════════════════════════════════════
         HERO
    ══════════════════════════════════════ -->
    <section id="hero">

        <!-- Left copy -->
        <div class="hl">
            <div style="margin-bottom:32px;" class="sr">
                <span class="lbl"><span class="acc-bar"></span>Study Lab · 2025</span>
            </div>

            <h1 class="d1" style="margin-bottom:44px;">
                <span class="cw ca1"><span class="ci">ESTUDE</span></span>
                <span class="cw ca2"><span class="ci">COM</span></span>
                <span class="cw ca3"><span class="ci" style="color:var(--acc);">INTELI-</span></span>
                <span class="cw ca4"><span class="ci" style="color:var(--acc);">GÊNCIA.</span></span>
            </h1>

            <div style="width:44px;height:2px;background:var(--acc);margin-bottom:22px;" class="sr d1s"></div>

            <p class="body-l sr d2s" style="max-width:400px;margin-bottom:40px;">
                Plataforma com IA que rastreia seu progresso e transforma horas de estudo em resultados reais.
            </p>

            <div style="display:flex;align-items:center;gap:12px;flex-wrap:wrap;" class="sr d3s">
                <a href="{{ route('register') }}" class="btn btn-r" style="padding:16px 34px;font-size:.72rem;">
                    Começar gratuitamente
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn btn-od" style="padding:16px 26px;font-size:.72rem;">Já tenho conta</a>
            </div>

            <!-- Proof numbers -->
            <div style="display:flex;gap:0;margin-top:52px;" class="sr d4s">
                @php $proof = [['12k+','estudantes'],['4.9★','avaliação'],['98%','satisfação']]; @endphp
                @foreach($proof as $pi => $p)
                    <div style="padding-right:36px;{{ $pi > 0 ? 'padding-left:36px;border-left:1px solid var(--ld);' : '' }}">
                        <div style="font-family:var(--fh);font-weight:900;font-size:1.65rem;color:var(--white);line-height:1;">{{ $p[0] }}</div>
                        <div style="font-size:.62rem;color:var(--md);text-transform:uppercase;letter-spacing:.1em;margin-top:5px;">{{ $p[1] }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Right mockup + floating pills -->
        <div class="hr">

            <!-- Floating glass pill 1 — streak -->
            <div class="fpill gd" id="pill1" style="top:14%;left:-8%;animation: float-a 6s ease-in-out infinite; animation-play-state:paused;">
                <div class="fpill-dot" style="background:#FF1C4B;"></div>
                <span style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);">🔥 14 dias de sequência!</span>
            </div>

            <!-- Floating glass pill 2 — goal done -->
            <div class="fpill gd" id="pill2" style="bottom:18%;right:-12%;animation: float-b 7s ease-in-out infinite; animation-play-state:paused;">
                <div class="fpill-dot" style="background:#22C55E;"></div>
                <span style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);">✓ Meta diária concluída!</span>
            </div>

            <!-- Floating glass pill 3 — retention -->
            <div class="fpill gd" id="pill3" style="top:42%;right:-16%;animation: float-c 8s ease-in-out infinite; animation-play-state:paused;">
                <div class="fpill-dot" style="background:#818CF8;"></div>
                <span style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);">📈 +23% de retenção</span>
            </div>

            <!-- App shell -->
            <div class="app" id="app-sh">
                <div class="atb">
                    <div class="td" style="background:#FF5F57;"></div>
                    <div class="td" style="background:#FFBD2E;"></div>
                    <div class="td" style="background:#28C840;"></div>
                    <span style="font-size:.65rem;color:var(--md);margin-left:10px;font-family:var(--fb);">StudyLab · Modo Foco</span>
                </div>
                <div class="abb">
                    <!-- Pomodoro ring -->
                    <div class="pmw">
                        <svg width="150" height="150" viewBox="0 0 150 150">
                            <circle class="pmk" cx="75" cy="75" r="65"/>
                            <circle class="pmp" cx="75" cy="75" r="65"/>
                        </svg>
                        <div class="pml">
                            <span class="pmt" id="pm-t">24:37</span>
                            <span class="pms">Pomodoro</span>
                        </div>
                    </div>
                    <!-- Subject -->
                    <div style="text-align:center;margin-bottom:18px;">
                        <div style="font-family:var(--fh);font-size:.95rem;color:var(--white);font-weight:700;margin-bottom:3px;">Cálculo III</div>
                        <div style="font-size:.62rem;color:var(--md);">Sessão 3 de 4 · Hoje</div>
                    </div>
                    <!-- Chips -->
                    <div class="cpr">
                        @foreach([['3h12','Foco','#FF1C4B'],['87%','Efic.','#22C55E'],['14','Cards','#818CF8']] as $c)
                            <div class="cp">
                                <div class="cpv" style="color:{{ $c[2] }};">{{ $c[0] }}</div>
                                <div class="cpl">{{ $c[1] }}</div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Week -->
                    @php $wkd = ['S','T','Q','Q','S','S','D']; $wkdn = [1,1,1,1,0,0,0]; @endphp
                    <div class="wkr">
                        @foreach($wkd as $wi => $wd)
                            <div class="wkd">
                                <div class="wkb" style="background:{{ $wkdn[$wi] ? 'var(--acc)' : 'rgba(255,255,255,0.04)' }};">
                                    @if($wkdn[$wi])<svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><path d="M20 6L9 17l-5-5"/></svg>@endif
                                </div>
                                <div class="wkl">{{ $wd }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════
         LIVE ACTIVITY MARQUEE
    ══════════════════════════════════════ -->
    <div class="lmb">
        <div class="lmt">
            @php
                $live = [
                    ['Ana C. está estudando Cálculo agora','#FF1C4B'],
                    ['Pedro concluiu 50 flashcards','#22C55E'],
                    ['Julia atingiu a meta semanal','#818CF8'],
                    ['Rafael está em 2h30 de foco contínuo','#F59E0B'],
                    ['12 estudantes online agora','#22D3EE'],
                    ['Camila criou um grupo de estudos','#FF1C4B'],
                    ['Ana C. está estudando Cálculo agora','#FF1C4B'],
                    ['Pedro concluiu 50 flashcards','#22C55E'],
                    ['Julia atingiu a meta semanal','#818CF8'],
                    ['Rafael está em 2h30 de foco contínuo','#F59E0B'],
                    ['12 estudantes online agora','#22D3EE'],
                    ['Camila criou um grupo de estudos','#FF1C4B'],
                ];
            @endphp
            @foreach($live as $li)
                <span class="lmi"><span class="lma" style="color:{{ $li[1] }};">●</span> {{ $li[0] }} <span style="color:var(--ld);margin:0 12px;">·</span></span>
            @endforeach
        </div>
    </div>

    <!-- MARQUEE — red band -->
    <div class="mqb">
        <div class="mqt">
            @php $mw = ['IA de Suporte','Flashcards','Modo Foco','Análise de Dados','Cronograma','Grupos de Estudo','Repetição Espaçada','Metas Diárias']; @endphp
            @foreach(array_merge($mw,$mw) as $w)
                <span class="mqi">{{ $w }}<span class="mqsep"> ·</span></span>
            @endforeach
        </div>
    </div>


    <!-- ══════════════════════════════════════
         FEATURES — interactive tabs
    ══════════════════════════════════════ -->
    <section id="features" class="sec">
        <div class="container">

            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:48px;flex-wrap:wrap;gap:24px;">
                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Recursos</span>
                    <h2 class="d2 sr d1s">Tudo que você<br>precisa para vencer.</h2>
                </div>
                <p class="body-l sr d2s" style="max-width:320px;text-align:right;">Ferramentas construídas para estudantes que levam a sério o próprio desenvolvimento.</p>
            </div>

            <!-- Tabs -->
            @php
                $feats = [
                    ['tab'=>'IA de Suporte','title'=>'Planos gerados por inteligência artificial','desc'=>'Nossa IA analisa seu ritmo de aprendizado e gera um plano personalizado que evolui com você. Sem fórmulas genéricas — cada plano é único.','color'=>'#FF1C4B','type'=>'ai'],
                    ['tab'=>'Análise','title'=>'Dashboards que mostram onde você realmente está','desc'=>'Gráficos em tempo real, comparativos semanais e indicadores por matéria. Você sabe onde precisa melhorar antes que seja tarde.','color'=>'#818CF8','type'=>'chart'],
                    ['tab'=>'Flashcards','title'=>'Memória de longo prazo com repetição espaçada','desc'=>'O sistema aprende quando você está prestes a esquecer e apresenta o conteúdo no momento certo. Ciência aplicada ao estudo.','color'=>'#22D3EE','type'=>'flash'],
                    ['tab'=>'Modo Foco','title'=>'Timer Pomodoro com rastreamento automático','desc'=>'Entre no flow com o modo foco. Timer pomodoro, sessões registradas automaticamente e músicas para concentração.','color'=>'#F59E0B','type'=>'foco'],
                    ['tab'=>'Grupos','title'=>'Aprenda mais rápido em conjunto','desc'=>'Crie salas de estudo, compartilhe anotações e compita em rankings semanais. Responsabilidade coletiva mantém a consistência.','color'=>'#22C55E','type'=>'grupo'],
                ];
            @endphp

            <div class="ftb">
                @foreach($feats as $fi => $f)
                    <button class="ftba {{ $fi===0 ? 'on' : '' }}" onclick="fsw({{ $fi }})">{{ $f['tab'] }}</button>
                @endforeach
            </div>

            @foreach($feats as $fi => $f)
                <div class="fp {{ $fi===0 ? 'on' : '' }}" id="fp{{$fi}}">
                    <div>
                        <span class="lbl" style="color:{{ $f['color'] }};display:block;margin-bottom:16px;">{{ $f['tab'] }}</span>
                        <h3 class="d3" style="margin-bottom:20px;">{{ $f['title'] }}</h3>
                        <p class="body-l" style="max-width:400px;margin-bottom:32px;">{{ $f['desc'] }}</p>
                        <a href="{{ route('register') }}" class="btn btn-r">Experimentar agora</a>
                    </div>

                    <!-- Animated mini-UI per tab -->
                    <div class="fmb" id="fmb{{$fi}}">
                        <div class="fmb-pad">

                            @if($f['type'] === 'ai')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Plano gerado</span>
                                </div>
                                <div id="tw-box" style="font-size:.78rem;color:var(--md);line-height:1.8;flex:1;">
                                    <span id="tw-text"></span><span class="tw-line" id="tw-cur"></span>
                                </div>
                                <div style="margin-top:auto;padding-top:16px;border-top:1px solid var(--ld);">
                                    @foreach([['Matemática','#FF1C4B',75],['Física','#818CF8',55],['Química','#22D3EE',40]] as $pb)
                                        <div style="margin-bottom:8px;">
                                            <div style="display:flex;justify-content:space-between;font-size:.6rem;color:var(--md);margin-bottom:4px;"><span>{{ $pb[0] }}</span><span>{{ $pb[2] }}%</span></div>
                                            <div style="height:3px;background:rgba(255,255,255,.06);border-radius:2px;overflow:hidden;"><div style="height:100%;width:{{ $pb[2] }}%;background:{{ $pb[1] }};border-radius:2px;"></div></div>
                                        </div>
                                    @endforeach
                                </div>

                            @elseif($f['type'] === 'chart')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Semana atual</span>
                                    <div style="font-family:var(--fh);font-size:1.6rem;font-weight:900;color:var(--white);margin-top:4px;">18h 42min</div>
                                    <div style="font-size:.62rem;color:#22C55E;margin-top:2px;">▲ 23% vs semana passada</div>
                                </div>
                                <div class="chart-bars" id="chart-bars">
                                    @foreach([30,55,40,70,85,60,95] as $h)
                                        <div class="cb" style="height:{{ $h }}%;transition-delay:{{ $loop->index * 0.08 }}s;"></div>
                                    @endforeach
                                </div>
                                <div style="display:flex;justify-content:space-between;margin-top:6px;">
                                    @foreach(['S','T','Q','Q','S','S','D'] as $dl)
                                        <div style="flex:1;text-align:center;font-size:.55rem;color:var(--md);">{{ $dl }}</div>
                                    @endforeach
                                </div>

                            @elseif($f['type'] === 'flash')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Flashcard</span>
                                    <div style="font-size:.65rem;color:var(--md);margin-top:4px;">Toque para revelar a resposta</div>
                                </div>
                                <div class="flip-scene">
                                    <div class="flip-card">
                                        <div class="flip-f">O que é a Segunda Lei de Newton?</div>
                                        <div class="flip-b">F = m · a<br><span style="font-size:.75rem;opacity:.8;">Força = massa × aceleração</span></div>
                                    </div>
                                </div>
                                <div style="margin-top:auto;display:flex;gap:8px;padding-top:14px;">
                                    @foreach([['Errei','rgba(255,28,75,.15)','var(--acc)'],['Difícil','rgba(255,255,255,.06)','var(--md)'],['Acertei','rgba(34,197,94,.15)','#22C55E']] as $fb)
                                        <div style="flex:1;text-align:center;padding:8px;border-radius:8px;background:{{ $fb[1] }};font-size:.6rem;color:{{ $fb[2] }};font-weight:600;cursor:none;">{{ $fb[0] }}</div>
                                    @endforeach
                                </div>

                            @elseif($f['type'] === 'foco')
                                <div style="margin-bottom:14px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Modo Foco</span>
                                </div>
                                <div class="mini-timer">
                                    <svg width="130" height="130" viewBox="0 0 130 130">
                                        <circle fill="none" stroke="rgba(255,255,255,0.06)" stroke-width="6" cx="65" cy="65" r="56"/>
                                        <circle fill="none" stroke="{{ $f['color'] }}" stroke-width="6" stroke-linecap="round" cx="65" cy="65" r="56" stroke-dasharray="352" stroke-dashoffset="85" transform="rotate(-90 65 65)" style="animation: pm-tick 2500s linear forwards;"/>
                                        <text x="65" y="62" text-anchor="middle" font-family="'Unbounded',sans-serif" font-weight="900" font-size="18" fill="white" letter-spacing="-1">22:14</text>
                                        <text x="65" y="78" text-anchor="middle" font-family="'DM Mono',monospace" font-size="7" fill="rgba(250,250,247,0.35)" letter-spacing="1.5">POMODORO</text>
                                    </svg>
                                </div>
                                <div style="margin-top:auto;display:grid;grid-template-columns:repeat(3,1fr);gap:8px;padding-top:14px;">
                                    @foreach([['2h48','Foco','#F59E0B'],['6','Sessões','var(--white)'],['92%','Efic.','#22C55E']] as $fc)
                                        <div style="text-align:center;padding:10px 4px;border-radius:8px;background:rgba(255,255,255,0.04);border:1px solid var(--ld);">
                                            <div style="font-family:var(--fh);font-size:.9rem;font-weight:900;color:{{ $fc[2] }};">{{ $fc[0] }}</div>
                                            <div style="font-size:.55rem;color:var(--md);margin-top:3px;text-transform:uppercase;letter-spacing:.1em;">{{ $fc[1] }}</div>
                                        </div>
                                    @endforeach
                                </div>

                            @else {{-- grupo --}}
                                <div style="margin-bottom:16px;">
                                    <span class="lbl" style="color:{{ $f['color'] }};">Sala ativa agora</span>
                                    <div style="font-family:var(--fh);font-size:.85rem;font-weight:700;color:var(--white);margin-top:6px;">Vestibu 2025 · Exatas</div>
                                </div>
                                <div style="display:flex;align-items:center;gap:12px;margin-bottom:20px;">
                                    <div class="gav-stack">
                                        @foreach(['#FF1C4B','#818CF8','#22C55E','#F59E0B'] as $gc)
                                            <div class="gav" style="background:{{ $gc }};">{{ ['A','P','J','M'][$loop->index] }}</div>
                                        @endforeach
                                        <div class="gav" style="background:var(--ink-3);font-size:.55rem;color:var(--md);border:1px solid var(--ld);">+8</div>
                                    </div>
                                    <div>
                                        <div style="font-size:.72rem;color:var(--white);font-weight:600;">12 estudando agora</div>
                                        <div style="font-size:.6rem;color:{{ $f['color'] }};">● Ao vivo</div>
                                    </div>
                                </div>
                                <div style="flex:1;display:flex;flex-direction:column;gap:8px;overflow:hidden;">
                                    @foreach([['Ana','Acabei a lista de exercícios!','2min'],['Pedro','Alguém tem o gabarito de Q5?','5min'],['Julia','✓ Postei no grupo','8min']] as $gm)
                                        <div style="display:flex;gap:8px;align-items:flex-start;">
                                            <div style="width:22px;height:22px;border-radius:50%;background:var(--acc);flex-shrink:0;display:flex;align-items:center;justify-content:center;font-family:var(--fh);font-size:.5rem;font-weight:900;">{{ substr($gm[0],0,1) }}</div>
                                            <div style="flex:1;background:rgba(255,255,255,.04);border-radius:8px;padding:7px 10px;">
                                                <div style="font-size:.6rem;font-weight:600;color:var(--white);margin-bottom:2px;">{{ $gm[0] }}</div>
                                                <div style="font-size:.62rem;color:var(--md);">{{ $gm[1] }}</div>
                                            </div>
                                            <div style="font-size:.55rem;color:var(--md);white-space:nowrap;padding-top:4px;">{{ $gm[2] }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <hr class="rd">

    <!-- ══════════════════════════════════════
         STATS
    ══════════════════════════════════════ -->
    <div class="stg">
        @php $sts = [['12.000+','Estudantes ativos','12000','+'],['98%','Taxa de satisfação','98','%'],['4.9★','Nota média','4.9','★'],['2M+','Horas registradas','2','M+']]; @endphp
        @foreach($sts as $s)
            <div class="stc sr">
                <div class="stn"><span class="cnum" data-t="{{ $s[2] }}" data-sfx="{{ $s[3] }}">{{ $s[0] }}</span></div>
                <div class="stl">{{ $s[1] }}</div>
            </div>
        @endforeach
    </div>

    <hr class="rd">


    <!-- ══════════════════════════════════════
         BENTO GRID — App em ação
    ══════════════════════════════════════ -->
    <section id="app-action" class="sec">
        <div class="container">

            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;flex-wrap:wrap;gap:24px;">
                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Veja em ação</span>
                    <h2 class="d2 sr d1s">O app que você<br>merecia ter.</h2>
                </div>
                <p class="body-l sr d2s" style="max-width:300px;text-align:right;">Tudo em uma interface limpa, rápida e pensada para o estudante moderno.</p>
            </div>

            <div class="bento">

                <!-- Card 1: AI Plan (large) -->
                <div class="bcard bcard-d bcard-lg srx">
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;margin-bottom:20px;">
                        <div>
                            <div class="lbl" style="margin-bottom:6px;">Plano da semana</div>
                            <div style="font-family:var(--fh);font-size:1.3rem;font-weight:900;color:var(--white);">Gerado pela IA</div>
                        </div>
                        <div style="width:36px;height:36px;border-radius:10px;background:rgba(255,28,75,.15);border:1px solid rgba(255,28,75,.3);display:flex;align-items:center;justify-content:center;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="var(--acc)" stroke-width="1.8"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                        </div>
                    </div>
                    @foreach([['Cálculo III','Segunda e Quarta · 2h','#FF1C4B',80],['Física II','Terça e Quinta · 1h30','#818CF8',62],['Química Org.','Sexta · 1h','#22D3EE',45],['Redação','Sábado · 45min','#22C55E',30]] as $ai)
                        <div style="display:grid;grid-template-columns:1fr auto;align-items:center;gap:12px;margin-bottom:14px;">
                            <div>
                                <div style="font-size:.76rem;color:var(--white);font-weight:600;margin-bottom:4px;">{{ $ai[0] }}</div>
                                <div style="font-size:.62rem;color:var(--md);">{{ $ai[1] }}</div>
                                <div style="height:3px;background:rgba(255,255,255,.06);border-radius:2px;overflow:hidden;margin-top:6px;">
                                    <div style="height:100%;width:{{ $ai[3] }}%;background:{{ $ai[2] }};border-radius:2px;"></div>
                                </div>
                            </div>
                            <div style="font-size:.65rem;font-family:var(--fh);font-weight:700;color:{{ $ai[2] }};">{{ $ai[3] }}%</div>
                        </div>
                    @endforeach
                </div>

                <!-- Card 2: Streak (small) -->
                <div class="bcard bcard-a bcard-sm srr" style="display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;">
                    <div style="font-size:3rem;margin-bottom:8px;line-height:1;">🔥</div>
                    <div style="font-family:var(--fh);font-weight:900;font-size:3.5rem;color:#fff;line-height:1;margin-bottom:4px;">14</div>
                    <div style="font-size:.65rem;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.12em;font-weight:500;">dias seguidos</div>
                    <div style="font-size:.62rem;color:rgba(255,255,255,.55);margin-top:8px;">Continue assim! Seu recorde é 21.</div>
                </div>

                <!-- Card 3: Sparkline (glass, small) -->
                <div class="bcard bcard-g bcard-sm ss">
                    <div class="lbl" style="margin-bottom:6px;">Esta semana</div>
                    <div style="font-family:var(--fh);font-weight:900;font-size:2rem;color:var(--white);line-height:1;">18h<span style="color:var(--acc);">42</span></div>
                    <div style="font-size:.62rem;color:#22C55E;margin-top:4px;margin-bottom:16px;">▲ 23% vs semana passada</div>
                    <svg class="spark" viewBox="0 0 200 60" width="100%" preserveAspectRatio="none" height="60">
                        <defs>
                            <linearGradient id="sg" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0%" stop-color="#FF1C4B" stop-opacity=".25"/>
                                <stop offset="100%" stop-color="#FF1C4B" stop-opacity="0"/>
                            </linearGradient>
                        </defs>
                        <path d="M0,50 C20,50 30,30 50,26 C70,22 80,42 100,36 C120,30 130,12 150,9 C170,6 180,22 200,4 L200,60 L0,60 Z" fill="url(#sg)"/>
                        <path class="spark-path" id="spark-p" d="M0,50 C20,50 30,30 50,26 C70,22 80,42 100,36 C120,30 130,12 150,9 C170,6 180,22 200,4"/>
                    </svg>
                </div>

                <!-- Card 4: Donut (glass, small) -->
                <div class="bcard bcard-g bcard-sm ss d2s" style="display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;">
                    <div class="lbl" style="margin-bottom:12px;">Eficiência</div>
                    <div style="position:relative;display:inline-flex;">
                        <svg width="100" height="100" viewBox="0 0 100 100" transform="rotate(-90 0 0)">
                            <circle class="donut-track" cx="50" cy="50" r="35" transform="rotate(-90 50 50)"/>
                            <circle class="donut-fill" cx="50" cy="50" r="35" stroke="#FF1C4B" transform="rotate(-90 50 50)"/>
                        </svg>
                        <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                            <div style="font-family:var(--fh);font-weight:900;font-size:1rem;color:var(--white);line-height:1;">87%</div>
                            <div style="font-size:.55rem;color:var(--md);margin-top:2px;">semanal</div>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Flashcard preview (large) -->
                <div class="bcard bcard-d bcard-lg srr d2s">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                        <div>
                            <div class="lbl" style="color:#22D3EE;margin-bottom:6px;">Flashcards</div>
                            <div style="font-family:var(--fh);font-size:1rem;font-weight:700;color:var(--white);">Repetição Espaçada</div>
                        </div>
                        <div style="font-size:.72rem;color:var(--md);">48 para hoje</div>
                    </div>
                    <div style="height:120px;perspective:700px;margin-bottom:16px;">
                        <div style="width:100%;height:100%;position:relative;transform-style:preserve-3d;animation:flip-loop 5s ease-in-out infinite;">
                            <div style="position:absolute;inset:0;border-radius:12px;backface-visibility:hidden;-webkit-backface-visibility:hidden;background:var(--ink-3);border:1px solid var(--ld);display:flex;align-items:center;justify-content:center;padding:20px;font-family:var(--fh);font-size:.85rem;font-weight:700;color:var(--white);text-align:center;">O que é integral definida?</div>
                            <div style="position:absolute;inset:0;border-radius:12px;backface-visibility:hidden;-webkit-backface-visibility:hidden;background:#22D3EE;transform:rotateY(180deg);display:flex;align-items:center;justify-content:center;padding:20px;font-family:var(--fh);font-size:.85rem;font-weight:700;color:#fff;text-align:center;">Área sob a curva num intervalo [a,b]</div>
                        </div>
                    </div>
                    <div style="display:flex;gap:8px;">
                        @foreach([['Errei','rgba(255,28,75,.15)','var(--acc)'],['Difícil','rgba(255,255,255,.05)','var(--md)'],['Acertei','rgba(34,197,94,.15)','#22C55E']] as $fb)
                            <div style="flex:1;text-align:center;padding:9px;border-radius:8px;background:{{ $fb[1] }};font-size:.62rem;color:{{ $fb[2] }};font-weight:600;cursor:none;border:1px solid rgba(255,255,255,.06);">{{ $fb[0] }}</div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>

    <hr class="rd">


    <!-- ══════════════════════════════════════
         HOW IT WORKS — animated timeline
    ══════════════════════════════════════ -->
    <section id="process" class="sec">
        <div class="container">
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:start;">

                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Processo</span>
                    <h2 class="d2 sr d1s" style="margin-bottom:20px;">Em 4 passos,<br>você já está<br>evoluindo.</h2>
                    <p class="body-l sr d2s" style="max-width:340px;">Simples, rápido, sem enrolação. Em menos de 5 minutos você está estudando de forma inteligente.</p>
                    <a href="{{ route('register') }}" class="btn btn-r sr d3s" style="margin-top:36px;display:inline-flex;">
                        Começar agora
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                </div>

                <div class="steps-wrap">
                    <div class="tl-line"><div class="tl-fill" id="tl-fill"></div></div>

                    @php $steps = [
                        ['01','Crie sua conta','Cadastre-se em 60 segundos. Sem cartão, sem burocracia.','#FF1C4B'],
                        ['02','Configure seu perfil','Informe matérias e objetivo. A IA cria o plano — você executa.','#818CF8'],
                        ['03','Entre no modo foco','Timer ativo, sessão registrada. Você só precisa estudar.','#22D3EE'],
                        ['04','Evolua com dados','Dashboards claros mostram o caminho. Ajuste e vença.','#22C55E'],
                    ]; @endphp

                    @foreach($steps as $si => $step)
                        <div class="step-row sr d{{ $si+1 }}s" data-n="{{ $step[0] }}">
                            <h3 class="d4" style="margin-bottom:10px;color:var(--white);">{{ $step[1] }}</h3>
                            <p class="body-l" style="max-width:380px;font-size:.85rem;">{{ $step[2] }}</p>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════
         TESTIMONIALS — cream + dark glass cards
    ══════════════════════════════════════ -->
    <section id="testi" class="sec" style="background:var(--cream);color:var(--ink);">
        <div class="container">

            <div style="max-width:860px;margin-bottom:80px;" class="srx">
                <span class="qm">"</span>
                <p class="pq">Passei em medicina na USP depois de 10 meses com o Study Lab. O cronograma da IA foi tão preciso que parecia que alguém entendia exatamente o meu jeito de aprender.</p>
                <div style="margin-top:28px;display:flex;align-items:center;gap:14px;">
                    <div class="tav" style="background:var(--acc);">A</div>
                    <div>
                        <div style="font-family:var(--fh);font-weight:700;color:var(--ink);font-size:.75rem;">ANA COSTA</div>
                        <div style="font-size:.62rem;color:var(--ml);text-transform:uppercase;letter-spacing:.1em;margin-top:2px;">Medicina · FMUSP · Aprovada 2024</div>
                    </div>
                </div>
            </div>

            <!-- Dark glass cards on cream = distinctive -->
            <div class="tgrid">
                @php $tests = [
                    ['P','Pedro Alves','Concurso Federal · Aprovado','Passei em 8 meses. O cronograma inteligente me manteve na trilha mesmo nos dias mais difíceis.','#818CF8'],
                    ['J','Julia Mendes','Engenharia USP · 3º ano','Minha média foi de 6,8 para 9,2 em um semestre usando flashcards de repetição espaçada.','#22D3EE'],
                    ['R','Rafael Souza','OAB · Aprovado de primeira','Os grupos de estudo me deram a responsabilidade que sempre faltou. Nunca estudei tão bem.','#22C55E'],
                ]; @endphp
                @foreach($tests as $ti => $t)
                    <div class="tcard sr d{{ $ti+1 }}s">
                        <div style="display:flex;gap:0.5px;margin-bottom:14px;">
                            @for($s=0;$s<5;$s++)<svg width="13" height="13" viewBox="0 0 20 20" fill="#F59E0B"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>@endfor
                        </div>
                        <p style="font-size:.82rem;line-height:1.7;color:rgba(250,250,247,.7);margin-bottom:22px;font-style:italic;">"{{ $t[3] }}"</p>
                        <div style="display:flex;align-items:center;gap:10px;">
                            <div class="tav" style="background:{{ $t[4] }};font-size:.76rem;">{{ $t[0] }}</div>
                            <div>
                                <div style="font-family:var(--fh);font-size:.7rem;font-weight:700;color:var(--white);">{{ $t[1] }}</div>
                                <div style="font-size:.6rem;color:{{ $t[4] }};text-transform:uppercase;letter-spacing:.08em;margin-top:2px;">{{ $t[2] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>


    <!-- ══════════════════════════════════════
         PRICING
    ══════════════════════════════════════ -->
    <section id="pricing" class="sec">
        <div class="container">
            <div style="display:flex;justify-content:space-between;align-items:flex-end;margin-bottom:56px;flex-wrap:wrap;gap:24px;">
                <div>
                    <span class="lbl sr" style="display:block;margin-bottom:10px;">Planos</span>
                    <h2 class="d2 sr d1s">Sem pegadinhas.<br>Só resultados.</h2>
                </div>
                <p class="body-l sr d2s" style="max-width:260px;text-align:right;">Cancele quando quiser. Sem multa nem burocracia.</p>
            </div>

            <div class="pgrid sr">
                @php $plans = [
                    ['Aprender','R$ 0','para sempre','Para quem está começando.',['Até 3 matérias','5h de estudo/semana','Flashcards básicos','Dashboard simples'],'Criar conta grátis',false],
                    ['Dominar','R$ 15','/mês','Para quem leva a sério.',['Matérias ilimitadas','Horas ilimitadas','IA personalizada completa','Grupos de estudo','Análise avançada','Notificações inteligentes'],'Começar agora',true],
                    ['Evoluir','R$ 10','/mês','Custo-benefício perfeito.',['Até 10 matérias','Modo foco completo','Relatórios semanais','Suporte prioritário'],'Escolher plano',false],
                ]; @endphp
                @foreach($plans as $pi => $plan)
                    <div class="pcol {{ $plan[6] ? 'ft' : '' }}">
                        @if($plan[6])
                            <div style="font-size:.6rem;letter-spacing:.14em;text-transform:uppercase;color:rgba(255,255,255,.6);margin-bottom:18px;font-family:var(--fb);">★ Mais escolhido</div>
                        @else
                            <div style="height:26px;margin-bottom:18px;"></div>
                        @endif
                        <div class="pn" style="color:{{ $plan[6] ? '#fff' : 'var(--white)' }};margin-bottom:5px;">{{ $plan[0] }}</div>
                        <p style="font-size:.73rem;color:{{ $plan[6] ? 'rgba(255,255,255,.6)' : 'var(--md)' }};margin-bottom:24px;line-height:1.6;">{{ $plan[3] }}</p>
                        <div style="display:flex;align-items:flex-end;gap:4px;margin-bottom:28px;">
                            <span class="pa">{{ $plan[1] }}</span>
                            <span style="font-size:.72rem;color:{{ $plan[6] ? 'rgba(255,255,255,.55)' : 'var(--md)' }};margin-bottom:6px;">{{ $plan[2] }}</span>
                        </div>
                        <div style="margin-bottom:32px;">
                            @foreach($plan[4] as $feat)
                                <div class="pf">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="{{ $plan[6] ? '#fff' : 'var(--acc)' }}" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                    {{ $feat }}
                                </div>
                            @endforeach
                        </div>
                        @if($plan[6])
                            <a href="{{ route('register') }}" class="btn" style="background:#fff;color:var(--acc);width:100%;justify-content:center;font-size:.63rem;padding:14px;">
                                {{ $plan[5] }}
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-od" style="width:100%;justify-content:center;font-size:.63rem;padding:14px;">{{ $plan[5] }}</a>
                        @endif
                    </div>
                @endforeach
            </div>
            <p style="text-align:center;font-size:.65rem;color:var(--md);margin-top:24px;text-transform:uppercase;letter-spacing:.1em;" class="sr">Gratuito para começar · Sem cartão de crédito · Cancele quando quiser</p>
        </div>
    </section>


    <!-- ══════════════════════════════════════
         CTA
    ══════════════════════════════════════ -->
    <section id="cta" class="sec" style="padding:160px 0;text-align:center;">
        <div class="cta-ghost">ESTUDE</div>

        <!-- Floating glass cards in CTA -->
        <div class="cta-glass-card gd" style="left:5%;top:20%;animation:float-a 7s ease-in-out infinite;">
            <div style="font-size:.65rem;color:var(--md);margin-bottom:4px;">Sessão ativa</div>
            <div style="font-family:var(--fh);font-size:.9rem;font-weight:700;color:var(--white);">Cálculo III · 2h14</div>
        </div>
        <div class="cta-glass-card gd" style="right:6%;bottom:25%;animation:float-b 8s ease-in-out infinite;">
            <div style="font-size:.65rem;color:#22C55E;margin-bottom:4px;">✓ Meta atingida</div>
            <div style="font-family:var(--fh);font-size:.9rem;font-weight:700;color:var(--white);">3h de foco hoje</div>
        </div>

        <div class="container" style="position:relative;z-index:2;">
            <span class="lbl sr" style="display:block;margin-bottom:22px;text-align:center;">Comece hoje</span>
            <h2 class="d2 sr d1s" style="margin-bottom:18px;max-width:640px;margin-left:auto;margin-right:auto;">
                Seu próximo nível<br>começa <span style="color:var(--acc);">agora.</span>
            </h2>
            <p class="body-l sr d2s" style="max-width:400px;margin:0 auto 44px;text-align:center;">
                Junte-se a mais de 12.000 estudantes que decidiram estudar com inteligência.
            </p>
            <div style="display:flex;gap:12px;justify-content:center;flex-wrap:wrap;" class="sr d3s">
                <a href="{{ route('register') }}" class="btn btn-r" style="padding:18px 48px;font-size:.75rem;">
                    Criar conta gratuitamente
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                </a>
                <a href="{{ route('login') }}" class="btn btn-od" style="padding:18px 34px;font-size:.75rem;">Já tenho conta</a>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════
         FOOTER
    ══════════════════════════════════════ -->
    <footer id="ftr">
        <div class="container">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;flex-wrap:wrap;gap:48px;margin-bottom:52px;">
                <div style="max-width:260px;">
                    <img src="{{ asset('images/logo-dark-mode.png') }}" alt="StudyLab" style="height:100px;margin-bottom:2px;">
                    <p style="font-size:.76rem;color:var(--md);line-height:1.7;">Plataforma de estudos com IA para quem quer resultados reais, não só horas registradas.</p>
                </div>
                <div style="display:flex;gap:60px;flex-wrap:wrap;">
                    @php $fls = [['Produto',['Funcionalidades','Como funciona','Preços','Novidades']],['Legal',['Privacidade','Termos de uso','Cookies','Contato']]]; @endphp
                    @foreach($fls as $fl)
                        <div>
                            <div style="font-family:var(--fh);font-size:.62rem;font-weight:700;color:var(--white);letter-spacing:.12em;text-transform:uppercase;margin-bottom:18px;">{{ $fl[0] }}</div>
                            <ul style="list-style:none;display:flex;flex-direction:column;gap:10px;">
                                @foreach($fl[1] as $ll)
                                    <li><a href="#" style="font-size:.76rem;color:var(--md);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='var(--white)'" onmouseout="this.style.color='var(--md)'">{{ $ll }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
            </div>
            <hr class="rd" style="margin-bottom:24px;">
            <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
                <p style="font-size:.66rem;color:var(--md);">© {{ date('Y') }} Study Lab. Todos os direitos reservados.</p>
                <div style="display:flex;align-items:center;gap:6px;">
                    <div style="width:6px;height:6px;border-radius:50%;background:#22C55E;animation:pulse-d 2s ease-in-out infinite;"></div>
                    <span style="font-size:.66rem;color:var(--md);">Todos os sistemas operando</span>
                </div>
            </div>
        </div>
    </footer>


    <!-- ══════════════════════════════════════
         JAVASCRIPT
    ══════════════════════════════════════ -->
    <script>
    (() => {
        'use strict';

        /* ── Scroll progress bar ── */
        const prog = document.getElementById('prog');
        const updateProg = () => {
            const tot = document.documentElement.scrollHeight - window.innerHeight;
            prog.style.transform = `scaleX(${window.scrollY / tot})`;
        };
        window.addEventListener('scroll', updateProg, { passive: true });

        /* ── Custom cursor ── */
        const cd = document.getElementById('c-d');
        const cr = document.getElementById('c-r');
        let mx = 0, my = 0, rx = 0, ry = 0;
        document.addEventListener('mousemove', e => { mx = e.clientX; my = e.clientY; });
        const tickC = () => {
            cd.style.left = mx + 'px'; cd.style.top = my + 'px';
            rx += (mx - rx) * 0.1; ry += (my - ry) * 0.1;
            cr.style.left = rx + 'px'; cr.style.top = ry + 'px';
            requestAnimationFrame(tickC);
        };
        tickC();
        document.querySelectorAll('a,button').forEach(el => {
            el.addEventListener('mouseenter', () => document.body.classList.add('ch'));
            el.addEventListener('mouseleave', () => document.body.classList.remove('ch'));
        });

        /* ── Header glass on scroll ── */
        const hdr = document.getElementById('hdr');
        window.addEventListener('scroll', () => hdr.classList.toggle('solid', window.scrollY > 50), { passive: true });

        /* ── Hero clip reveal ── */
        const revH = () => document.querySelectorAll('.ci').forEach(el => el.classList.add('in'));
        requestAnimationFrame(() => requestAnimationFrame(revH));

        /* ── IntersectionObserver scroll reveals ── */
        const io = new IntersectionObserver(entries => {
            entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('in'); io.unobserve(e.target); } });
        }, { threshold: 0.1, rootMargin: '0px 0px -48px 0px' });
        document.querySelectorAll('.sr,.srx,.srr,.ss').forEach(el => io.observe(el));

        /* ── Hero floating pills ── */
        const pills = document.querySelectorAll('.fpill');
        setTimeout(() => {
            pills.forEach((p, i) => {
                setTimeout(() => {
                    p.classList.add('show');
                    p.style.animationPlayState = 'running';
                }, i * 300);
            });
        }, 1200);

        /* ── Feature tabs ── */
        window.fsw = idx => {
            document.querySelectorAll('.ftba').forEach((t, i) => t.classList.toggle('on', i === idx));
            document.querySelectorAll('.fp').forEach((p, i) => p.classList.toggle('on', i === idx));
            // Trigger chart bars for analytics tab
            if (idx === 1) setTimeout(() => document.querySelectorAll('.cb').forEach(b => b.classList.add('go')), 50);
            // Trigger sparkline for bento (already running)
        };

        /* ── Animate chart bars when analytics tab is first opened ── */
        document.querySelectorAll('.ftba').forEach((btn, i) => {
            btn.addEventListener('click', () => {
                if (i === 1) setTimeout(() => document.querySelectorAll('#fmb1 .cb').forEach(b => b.classList.add('go')), 80);
            });
        });

        /* ── Sparkline draw animation on bento grid in view ── */
        const spIO = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    const p = document.getElementById('spark-p');
                    if (p) p.classList.add('go');
                    spIO.disconnect();
                }
            });
        }, { threshold: 0.5 });
        const bentCard = document.querySelector('.bcard-g');
        if (bentCard) spIO.observe(bentCard);

        /* ── Timeline fill on scroll ── */
        const tlFill = document.getElementById('tl-fill');
        const stepsWrap = document.querySelector('.steps-wrap');
        if (tlFill && stepsWrap) {
            const updateTl = () => {
                const rect = stepsWrap.getBoundingClientRect();
                const vh   = window.innerHeight;
                if (rect.top > vh || rect.bottom < 0) return;
                const pct  = Math.min(Math.max((vh - rect.top) / (rect.height + vh * 0.4), 0), 1);
                tlFill.style.height = (pct * 100) + '%';
            };
            window.addEventListener('scroll', updateTl, { passive: true });
            updateTl();
        }

        /* ── Pomodoro timer countdown ── */
        let pmS = 24 * 60 + 37;
        const pmEl = document.getElementById('pm-t');
        setInterval(() => {
            pmS = pmS > 0 ? pmS - 1 : 25 * 60;
            const m = String(Math.floor(pmS / 60)).padStart(2,'0');
            const s = String(pmS % 60).padStart(2,'0');
            if (pmEl) pmEl.textContent = `${m}:${s}`;
        }, 1000);

        /* ── Stat counter animation ── */
        const cnums = document.querySelectorAll('.cnum');
        const cIO = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (!e.isIntersecting) return;
                const el  = e.target;
                const tgt = parseFloat(el.getAttribute('data-t'));
                const sfx = el.getAttribute('data-sfx') || '';
                const isF = tgt % 1 !== 0;
                const dur = 1600, t0 = performance.now();
                const tick = now => {
                    const p = Math.min((now - t0) / dur, 1);
                    const v = tgt * (1 - Math.pow(1 - p, 3));
                    el.textContent = (isF ? v.toFixed(1) : Math.floor(v).toLocaleString('pt-BR')) + sfx;
                    if (p < 1) requestAnimationFrame(tick);
                };
                requestAnimationFrame(tick);
                cIO.unobserve(el);
            });
        }, { threshold: 0.5 });
        cnums.forEach(el => cIO.observe(el));

        /* ── Typewriter in AI feature tab ── */
        const twBox = document.getElementById('tw-text');
        const twCur = document.getElementById('tw-cur');
        if (twBox) {
            const lines = [
                '> Analisando seu histórico...',
                '> Matérias detectadas: 4',
                '> Cálculo III: 2h/dia',
                '> Física II: 1h30/dia',
                '> Química: 1h/dia',
                '> Plano otimizado. ✓',
            ];
            let ci2 = 0, li = 0;
            const typeNext = () => {
                if (li >= lines.length) { li = 0; twBox.textContent = ''; }
                const line = lines[li];
                if (ci2 <= line.length) {
                    twBox.textContent = lines.slice(0, li).join('\n') + (li > 0 ? '\n' : '') + line.slice(0, ci2);
                    ci2++;
                    setTimeout(typeNext, ci2 === line.length + 1 ? 800 : 45);
                } else {
                    li++; ci2 = 0;
                    setTimeout(typeNext, 200);
                }
            };
            setTimeout(typeNext, 800);
        }

        /* ── App mockup mouse parallax ── */
        const appSh = document.getElementById('app-sh');
        if (appSh) {
            document.addEventListener('mousemove', e => {
                const cx = window.innerWidth / 2, cy = window.innerHeight / 2;
                const rx2 = ((e.clientY - cy) / cy) * 5;
                const ry2 = -((e.clientX - cx) / cx) * 9;
                appSh.style.transform = `rotate(${2 - ry2 * .1}deg) translateY(-6px) rotateX(${rx2}deg) rotateY(${ry2}deg)`;
                appSh.style.transition = 'transform .08s linear';
            });
        }

        /* ── Magnetic buttons ── */
        document.querySelectorAll('.btn-r').forEach(btn => {
            btn.addEventListener('mousemove', e => {
                const r = btn.getBoundingClientRect();
                const dx = (e.clientX - (r.left + r.width/2)) * 0.2;
                const dy = (e.clientY - (r.top + r.height/2)) * 0.2;
                btn.style.transform = `translate(${dx}px,${dy}px)`;
            });
            btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
        });

        /* ── Smooth anchor ── */
        document.querySelectorAll('a[href^="#"]').forEach(a => {
            a.addEventListener('click', e => {
                const t = document.querySelector(a.getAttribute('href'));
                if (t) { e.preventDefault(); t.scrollIntoView({ behavior: 'smooth' }); }
            });
        });

    })();
    </script>

    <script src="{{ asset('js/home.js') }}"></script>
</body>
</html>
