<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurar conta · StudyLab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=DM+Mono:wght@300;400;500&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --pk: #db2777;
            --pk2: #ec4899;
            --pk3: #be185d;
            --ink: #09090e;
            --ld: rgba(255, 255, 255, 0.07);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            background: var(--ink);
            font-family: 'DM Mono', monospace;
            overflow: hidden;
            height: 100svh;
        }

        * { cursor: none !important; }

        /* grain */
        body::after {
            content:'';
            position:fixed; inset:0; z-index:9000;
            pointer-events:none; opacity:.04; mix-blend-mode:overlay;
            background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.88' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
            background-size:180px;
        }

        h1, h2, h3 { font-family:'Unbounded', sans-serif; }

        /* ── CURSOR ── */
        #cur-dot {
            position:fixed; width:8px; height:8px;
            background:var(--pk); border-radius:50%;
            pointer-events:none; z-index:99999;
            transform:translate(-50%,-50%);
            transition:width .18s, height .18s;
            will-change:left,top;
        }
        #cur-ring {
            position:fixed; width:32px; height:32px;
            border:1.5px solid rgba(255,255,255,.25); border-radius:50%;
            pointer-events:none; z-index:99998;
            transform:translate(-50%,-50%);
            transition:width .3s cubic-bezier(.23,1,.32,1), height .3s cubic-bezier(.23,1,.32,1), border-color .22s;
            will-change:left,top;
        }
        body.cur-hover #cur-dot  { width:13px; height:13px; }
        body.cur-hover #cur-ring { width:52px; height:52px; border-color:var(--pk); }

        /* ── STEPS ── */
        .ob-step {
            position:fixed; inset:0;
            display:flex; flex-direction:column;
            background:var(--ink);
        }
        .ob-step.hidden-step { opacity:0; pointer-events:none; transform:translateY(14px); }

        /* ── DOTS ── */
        .dot { border-radius:9999px; transition:all .3s ease; }
        .dot-active { width:18px; height:8px; background:var(--pk); }
        .dot-done   { width:8px;  height:8px; background:var(--pk3); opacity:.55; }
        .dot-idle   { width:8px;  height:8px; background:rgba(255,255,255,.13); }

        /* ── BUTTONS ── */
        .btn-back {
            font-family:'DM Mono', monospace;
            font-size:11px; letter-spacing:.14em; text-transform:uppercase;
            color:rgba(255,255,255,.28); background:transparent; border:none;
            padding:8px 0; transition:color .2s;
        }
        .btn-back:hover { color:rgba(255,255,255,.72); }

        .btn-next {
            font-family:'Unbounded', sans-serif;
            font-size:10px; font-weight:700;
            letter-spacing:.08em; text-transform:uppercase;
            color:#fff; background:var(--pk);
            border:none; border-radius:10px; padding:14px 30px;
            transition:transform .2s, box-shadow .2s;
            position:relative; overflow:hidden;
        }
        .btn-next::before {
            content:''; position:absolute; inset:0;
            background:rgba(255,255,255,.16);
            transform:translateX(-110%) skewX(-20deg);
            transition:transform .44s ease;
        }
        .btn-next:hover { transform:translateY(-2px); box-shadow:0 12px 36px rgba(219,39,119,.42); }
        .btn-next:hover::before { transform:translateX(120%) skewX(-20deg); }
        .btn-next:disabled { opacity:.28; pointer-events:none; }

        /* ── INPUT ── */
        .ob-input {
            width:100%; background:rgba(255,255,255,.04);
            border:1px solid rgba(255,255,255,.08); border-radius:12px;
            padding:14px 16px; color:#fff;
            font-family:'DM Mono', monospace; font-size:14px;
            outline:none; transition:border-color .2s, box-shadow .2s;
        }
        .ob-input:focus { border-color:var(--pk); box-shadow:0 0 0 3px rgba(219,39,119,.13); }
        .ob-input::placeholder { color:rgba(255,255,255,.18); }

        /* ── COLOR SWATCH ── */
        .color-sw {
            border-radius:10px; border:2px solid transparent;
            overflow:hidden; aspect-ratio:16/9;
            position:relative; transition:transform .2s, border-color .2s;
        }
        .color-sw:hover { transform:scale(1.07); }
        .color-sw.selected       { border-color:rgba(255,255,255,.85); }
        .color-sw.selected-light { border-color:#374151; }
        .sw-check {
            position:absolute; inset:0; display:flex;
            align-items:center; justify-content:center;
            background:rgba(0,0,0,.12); opacity:0; transition:opacity .2s;
        }
        .color-sw.selected .sw-check,
        .color-sw.selected-light .sw-check { opacity:1; }
        .sw-label {
            position:absolute; bottom:5px; left:0; right:0;
            text-align:center; font-family:'DM Mono', monospace;
            font-size:7px; letter-spacing:.16em;
            text-transform:uppercase; font-weight:500;
        }

        /* ── CARD PREVIEW ── */
        #card-preview {
            border-radius:20px; width:100%; max-width:300px;
            aspect-ratio:16/10; position:relative; overflow:hidden;
            box-shadow:0 28px 60px rgba(0,0,0,.65); transition:background .4s;
        }
        #card-pattern {
            position:absolute; inset:0; opacity:.05;
            background-image:repeating-linear-gradient(45deg, rgba(255,255,255,1) 0px, rgba(255,255,255,1) 1px, transparent 0px, transparent 50%);
            background-size:20px 20px;
        }

        /* ── THEME CARD ── */
        .theme-card {
            border-radius:14px; overflow:hidden;
            border:2px solid transparent;
            transition:transform .2s, border-color .2s;
            aspect-ratio:4/3; position:relative;
        }
        .theme-card:hover { transform:scale(1.04); }
        .theme-card.selected { border-color:var(--pk); }
        .theme-check {
            position:absolute; top:8px; right:8px;
            width:18px; height:18px; background:var(--pk);
            border-radius:50%; display:flex;
            align-items:center; justify-content:center;
            opacity:0; transition:opacity .2s;
        }
        .theme-card.selected .theme-check { opacity:1; }

        /* ── PLAN CARD ── */
        .plan-card {
            border-radius:16px;
            border:2px solid rgba(255,255,255,.08);
            background:rgba(255,255,255,.03);
            padding:22px; transition:transform .2s, border-color .2s;
            position:relative; overflow:hidden;
        }
        .plan-card:hover { transform:translateY(-3px); }
        .plan-card.selected { border-color:var(--pk); }
        .plan-card.featured { background:rgba(219,39,119,.07); }
        .plan-radio {
            position:absolute; top:14px; right:14px;
            width:20px; height:20px; border-radius:50%;
            border:1.5px solid rgba(255,255,255,.2);
            display:flex; align-items:center; justify-content:center;
            transition:background .2s, border-color .2s;
        }
        .plan-card.selected .plan-radio { background:var(--pk); border-color:var(--pk); }

        /* ── NETFLIX AVATAR ── */
        .nf-section { margin-bottom:22px; }
        .nf-row-title {
            font-family:'DM Mono', monospace;
            font-size:10px; letter-spacing:.2em; text-transform:uppercase;
            color:rgba(255,255,255,.4); margin-bottom:10px;
        }
        .nf-av {
            flex-shrink:0; width:76px; height:76px;
            border-radius:10px; overflow:hidden;
            position:relative; border:2px solid rgba(255,255,255,.07);
            background:rgba(255,255,255,.05);
            transition:transform .22s cubic-bezier(.23,1,.32,1), border-color .22s, box-shadow .22s;
        }
        .nf-av:hover {
            transform:scale(1.16) translateY(-5px);
            border-color:rgba(219,39,119,.45);
            box-shadow:0 12px 32px rgba(0,0,0,.55); z-index:2;
        }
        .nf-av.selected {
            border-color:var(--pk);
            box-shadow:0 0 0 1px var(--pk), 0 8px 28px rgba(219,39,119,.38);
        }
        .nf-av img { width:100%; height:100%; object-fit:cover; display:block; }
        .nf-av-fb {
            display:none; width:100%; height:100%;
            align-items:center; justify-content:center;
            font-family:'Unbounded', sans-serif;
            font-size:18px; font-weight:900; color:#fff;
        }
        .nf-av-check {
            position:absolute; bottom:3px; right:3px;
            width:14px; height:14px; background:var(--pk);
            border-radius:50%; display:flex;
            align-items:center; justify-content:center;
            opacity:0; transition:opacity .2s;
        }
        .nf-av.selected .nf-av-check { opacity:1; }

        /* upload pill */
        .upload-pill {
            display:flex; align-items:center; justify-content:center;
            gap:8px; width:100%; padding:11px;
            border-radius:12px; border:1.5px dashed rgba(255,255,255,.12);
            color:rgba(255,255,255,.32); font-size:10px; letter-spacing:.12em;
            transition:border-color .2s, color .2s;
        }
        .upload-pill:hover, .upload-pill.loaded { border-color:rgba(219,39,119,.45); color:var(--pk2); }

        /* selected avatar chip */
        .av-chip {
            display:flex; align-items:center; gap:10px;
            padding:10px 14px; border-radius:12px;
            background:rgba(219,39,119,.08);
            border:1px solid rgba(219,39,119,.22);
        }

        /* ── LOADING SCREEN ── */
        @keyframes conffall {
            to { transform:translateY(110vh) rotate(720deg); opacity:0; }
        }

        /* erlenmeyer bubble float */
        @keyframes bubbleFloat {
            0%   { transform:translateY(0)    scale(1);    opacity:.7; }
            50%  { transform:translateY(-8px) scale(1.05); opacity:1;  }
            100% { transform:translateY(0)    scale(1);    opacity:.7; }
        }
        /* liquid sway */
        @keyframes liquidSway {
            0%,100% { transform:skewX(0deg);   }
            25%     { transform:skewX(-2deg); }
            75%     { transform:skewX(2deg);  }
        }
        /* flask glow pulse */
        @keyframes flaskGlow {
            0%,100% { filter:drop-shadow(0 0 8px rgba(219,39,119,.3));  }
            50%     { filter:drop-shadow(0 0 22px rgba(219,39,119,.7)); }
        }
        /* progress bar shimmer */
        @keyframes shimmer {
            from { background-position: -200% center; }
            to   { background-position:  200% center; }
        }
        /* dots bounce */
        @keyframes dotBounce {
            0%,80%,100% { transform:translateY(0);    }
            40%          { transform:translateY(-8px); }
        }
        /* particle rise */
        @keyframes particleRise {
            0%   { transform:translateY(0) scale(1); opacity:.8; }
            100% { transform:translateY(-60px) scale(0); opacity:0; }
        }

        .acc-line {
            display:inline-block; width:22px; height:2px;
            background:var(--pk); vertical-align:middle; margin-right:10px;
        }
    </style>
</head>
<body>

    <!-- CURSOR -->
    <div id="cur-dot"></div>
    <div id="cur-ring"></div>

    <!-- ══════ STEP 0 — Welcome ══════ -->
    <div id="step0" class="ob-step">
        <div class="flex-1 flex flex-col items-center justify-center px-10 text-center">
            <!-- erlenmeyer icon -->
            <div class="flex items-center justify-center rounded-2xl mb-8"
                style="width:80px;height:80px;background:rgba(219,39,119,.1);border:1px solid rgba(219,39,119,.2);">
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <!-- book base -->
                    <path d="M5 8C5 6.9 5.9 6 7 6H19V32H7C5.9 32 5 31.1 5 30V8Z" fill="rgba(219,39,119,.18)" stroke="#db2777" stroke-width="1.4"/>
                    <path d="M21 6H33C34.1 6 35 6.9 35 8V30C35 31.1 34.1 32 33 32H21V6Z" fill="rgba(219,39,119,.1)" stroke="#db2777" stroke-width="1.4"/>
                    <line x1="20" y1="6" x2="20" y2="32" stroke="#db2777" stroke-width="1.4"/>
                    <!-- erlenmeyer flask on top -->
                    <g transform="translate(22, -2)">
                        <!-- flask neck -->
                        <rect x="5" y="2" width="4" height="5" rx="1" fill="#db2777" opacity=".9"/>
                        <!-- flask body -->
                        <path d="M3 7 L0 15 Q0 18 7 18 Q14 18 14 15 L11 7 Z" fill="rgba(219,39,119,.35)" stroke="#db2777" stroke-width="1.2"/>
                        <!-- liquid inside -->
                        <path d="M1.5 13 Q7 11 12.5 13 L12 15 Q7 17 2 15 Z" fill="#db2777" opacity=".7"/>
                        <!-- bubbles -->
                        <circle cx="5" cy="12" r="1" fill="#f9a8d4" opacity=".8"/>
                        <circle cx="9" cy="10" r=".7" fill="#f9a8d4" opacity=".6"/>
                        <!-- stopper top -->
                        <rect x="4.5" y="1" width="5" height="1.5" rx=".75" fill="#db2777"/>
                    </g>
                </svg>
            </div>
            <p style="color:var(--pk);font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:12px;">
                <span class="acc-line"></span>StudyLab · Setup
            </p>
            <h1 class="text-white mb-4" style="font-size:clamp(2rem,6vw,2.8rem);letter-spacing:-.03em;line-height:1.05;">
                BEM-VINDO<br>AO STUDYLAB.
            </h1>
            <p style="color:rgba(255,255,255,.3);font-size:12px;max-width:270px;line-height:1.9;">
                Vamos configurar sua conta em poucos passos. Leva menos de 2 minutos.
            </p>
        </div>
        <div class="w-full px-10 pb-10 flex items-center justify-between">
            <span class="invisible" style="font-size:11px;">x</span>
            <div class="flex gap-2 items-center" id="dots0"></div>
            <button class="btn-next" onclick="goStep(1)">COMEÇAR &nbsp;→</button>
        </div>
    </div>

    <!-- ══════ STEP 1 — Nome ══════ -->
    <div id="step1" class="ob-step hidden-step">
        <div class="flex-1 flex flex-col justify-center w-full max-w-lg mx-auto px-10">
            <p style="color:var(--pk);font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:10px;">Passo 1 de 5</p>
            <h2 class="text-white mb-1" style="font-size:clamp(1.7rem,5vw,2.4rem);letter-spacing:-.03em;line-height:1.1;">Como quer<br>ser chamado?</h2>
            <p style="color:rgba(255,255,255,.3);font-size:12px;margin-bottom:32px;">Esse nome aparece na sua carteira de estudante.</p>
            <label style="color:rgba(255,255,255,.28);font-size:10px;letter-spacing:.18em;text-transform:uppercase;display:block;margin-bottom:8px;">Nome completo</label>
            <input id="nameInput" class="ob-input" type="text" maxlength="50" autocomplete="off" placeholder="Ex: Ana Lima">
            <div class="mt-3 flex items-center gap-2 px-4 py-3 rounded-xl"
                style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.06);">
                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,.28)" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
                <span style="color:rgba(255,255,255,.28);font-size:11px;">Na carteira:</span>
                <span id="namePreviewVal" style="color:var(--pk);font-size:11px;font-weight:700;">—</span>
            </div>
        </div>
        <div class="w-full px-10 pb-10 flex items-center justify-between">
            <button class="btn-back" onclick="goStep(0)">← VOLTAR</button>
            <div class="flex gap-2 items-center" id="dots1"></div>
            <button id="nextStep1" class="btn-next" onclick="goStep(2)" disabled>PRÓXIMO →</button>
        </div>
    </div>

    <!-- ══════ STEP 2 — Cor da carteira ══════ -->
    <div id="step2" class="ob-step hidden-step">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg mx-auto px-10">
            <div class="w-full">
                <p style="color:var(--pk);font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:10px;">Passo 2 de 5</p>
                <h2 class="text-white mb-1" style="font-size:clamp(1.7rem,5vw,2.4rem);letter-spacing:-.03em;line-height:1.1;">Cor da<br>sua carteira.</h2>
                <p style="color:rgba(255,255,255,.3);font-size:12px;margin-bottom:20px;">Escolha a identidade visual do seu perfil.</p>
                <div class="flex justify-center mb-5">
                    <div id="card-preview" style="background:linear-gradient(135deg,#9d174d 0%,#db2777 40%,#f9a8d4 100%);">
                        <div id="card-pattern"></div>
                        <div class="absolute inset-0 flex flex-col justify-between p-5">
                            <div class="flex justify-between items-start">
                                <div>
                                    <div id="previewName" style="color:#fff;font-family:'Unbounded',sans-serif;font-size:12px;font-weight:700;letter-spacing:-.02em;margin-bottom:3px;">SEU NOME</div>
                                    <div id="previewSchool" style="color:rgba(255,255,255,.48);font-size:10px;">StudyLab Student</div>
                                </div>
                                <div id="previewPhotoMini" class="rounded-full border flex-shrink-0"
                                    style="width:38px;height:38px;border-color:rgba(255,255,255,.25);background:rgba(255,255,255,.15);overflow:hidden;"></div>
                            </div>
                            <div class="flex justify-between items-end">
                                <div id="previewId" style="color:rgba(255,255,255,.28);font-size:9px;letter-spacing:.12em;">SL-000001</div>
                                <div id="previewYear" class="rounded-md px-2 py-1"
                                    style="color:rgba(255,255,255,.6);background:rgba(255,255,255,.14);font-size:9px;">2025</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-2" id="colorGrid"></div>
            </div>
        </div>
        <div class="w-full px-10 pb-10 flex items-center justify-between">
            <button class="btn-back" onclick="goStep(1)">← VOLTAR</button>
            <div class="flex gap-2 items-center" id="dots2"></div>
            <button class="btn-next" onclick="goStep(3)">PRÓXIMO →</button>
        </div>
    </div>

    <!-- ══════ STEP 3 — Avatar ══════ -->
    <div id="step3" class="ob-step hidden-step">
        <div class="flex-1 flex flex-col justify-center w-full max-w-2xl mx-auto px-8" style="overflow:hidden;min-height:0;">
            <p style="color:var(--pk);font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:8px;flex-shrink:0;">Passo 3 de 5</p>
            <h2 class="text-white mb-1" style="font-size:clamp(1.5rem,4vw,2.1rem);letter-spacing:-.03em;line-height:1.1;flex-shrink:0;">Escolha seu avatar.</h2>
            <p style="color:rgba(255,255,255,.3);font-size:12px;margin-bottom:16px;flex-shrink:0;">Navegue pelas categorias ou envie uma foto.</p>
            <div id="netflixRows" style="overflow-y:auto;flex:1;min-height:0;scrollbar-width:none;padding-right:2px;"></div>
            <div style="flex-shrink:0;margin-top:12px;display:flex;flex-direction:column;gap:10px;">
                <label for="avatarFileInput" id="uploadZone" class="upload-pill">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/>
                        <polyline points="17 8 12 3 7 8"/>
                        <line x1="12" y1="3" x2="12" y2="15"/>
                    </svg>
                    <span id="uploadLabel">ENVIAR FOTO DO DISPOSITIVO</span>
                </label>
                <input type="file" id="avatarFileInput" accept="image/*" class="hidden">
                <div id="selectedAvatarPreview" class="av-chip hidden">
                    <div id="selectedAvatarThumb" class="rounded-full overflow-hidden border-2 flex-shrink-0"
                        style="width:38px;height:38px;border-color:var(--pk);"></div>
                    <div>
                        <div style="color:var(--pk);font-size:10px;letter-spacing:.1em;font-weight:700;">AVATAR SELECIONADO</div>
                        <div id="selectedAvatarName" style="color:rgba(255,255,255,.36);font-size:10px;margin-top:2px;"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full px-10 pb-10 flex items-center justify-between" style="flex-shrink:0;">
            <button class="btn-back" onclick="goStep(2)">← VOLTAR</button>
            <div class="flex gap-2 items-center" id="dots3"></div>
            <button class="btn-next" onclick="goStep(4)">PRÓXIMO →</button>
        </div>
    </div>

    <!-- ══════ STEP 4 — Plano ══════ -->
    <div id="step4" class="ob-step hidden-step">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg mx-auto px-10">
            <div class="w-full">
                <p style="color:var(--pk);font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:10px;">Passo 4 de 5</p>
                <h2 class="text-white mb-1" style="font-size:clamp(1.7rem,5vw,2.4rem);letter-spacing:-.03em;line-height:1.1;">Escolha seu<br>plano.</h2>
                <p style="color:rgba(255,255,255,.3);font-size:12px;margin-bottom:24px;">Mude quando quiser. Sem cartão de crédito.</p>
                <div class="flex flex-col gap-3">

                    <!-- FREE -->
                    <div id="planFree" class="plan-card selected" onclick="selectPlan('free')">
                        <div class="plan-radio">
                            <svg id="chkFree" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div class="flex items-end gap-2 mb-1">
                            <span style="font-family:'Unbounded',sans-serif;font-size:1.5rem;font-weight:900;color:#fff;letter-spacing:-.04em;">R$&nbsp;0</span>
                            <span style="color:rgba(255,255,255,.32);font-size:11px;margin-bottom:3px;">/ para sempre</span>
                        </div>
                        <div style="font-family:'Unbounded',sans-serif;font-size:11px;font-weight:700;color:#fff;margin-bottom:4px;">APRENDER</div>
                        <p style="color:rgba(255,255,255,.32);font-size:11px;margin-bottom:10px;">Para quem está começando a jornada.</p>
                        <div style="color:rgba(255,255,255,.42);font-size:11px;"><span style="color:var(--pk);">✓</span> Até 3 matérias · 5h/semana · Flashcards básicos</div>
                    </div>

                    <!-- EVOLUIR -->
                    <div id="planEvoluir" class="plan-card" onclick="selectPlan('evoluir')">
                        <div class="plan-radio">
                            <svg id="chkEvol" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" style="opacity:0"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div class="flex items-end gap-2 mb-1">
                            <span style="font-family:'Unbounded',sans-serif;font-size:1.5rem;font-weight:900;color:#fff;letter-spacing:-.04em;">R$&nbsp;10</span>
                            <span style="color:rgba(255,255,255,.32);font-size:11px;margin-bottom:3px;">/ mês</span>
                        </div>
                        <div style="font-family:'Unbounded',sans-serif;font-size:11px;font-weight:700;color:#fff;margin-bottom:4px;">EVOLUIR</div>
                        <p style="color:rgba(255,255,255,.32);font-size:11px;margin-bottom:10px;">Para quem quer crescer com mais recursos.</p>
                        <div style="color:rgba(255,255,255,.42);font-size:11px;"><span style="color:var(--pk);">✓</span> Matérias ilimitadas · IA básica · Grupos de estudo</div>
                    </div>

                    <!-- PREMIUM -->
                    <div id="planPremium" class="plan-card featured" onclick="selectPlan('premium')">
                        <div class="plan-radio">
                            <svg id="chkPrem" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3" style="opacity:0"><polyline points="20 6 9 17 4 12"/></svg>
                        </div>
                        <div style="font-size:9px;letter-spacing:.18em;text-transform:uppercase;color:var(--pk);margin-bottom:8px;">★ MAIS ESCOLHIDO</div>
                        <div class="flex items-end gap-2 mb-1">
                            <span style="font-family:'Unbounded',sans-serif;font-size:1.5rem;font-weight:900;color:#fff;letter-spacing:-.04em;">R$&nbsp;15</span>
                            <span style="color:rgba(255,255,255,.32);font-size:11px;margin-bottom:3px;">/ mês</span>
                        </div>
                        <div style="font-family:'Unbounded',sans-serif;font-size:11px;font-weight:700;color:#fff;margin-bottom:4px;">DOMINAR</div>
                        <p style="color:rgba(255,255,255,.32);font-size:11px;margin-bottom:10px;">Para quem leva a sério o próprio desenvolvimento.</p>
                        <div style="color:rgba(255,255,255,.42);font-size:11px;"><span style="color:var(--pk);">✓</span> Ilimitado · IA completa · Grupos · Análise avançada</div>
                    </div>

                </div>
            </div>
        </div>
        <div class="w-full px-10 pb-10 flex items-center justify-between">
            <button class="btn-back" onclick="goStep(3)">← VOLTAR</button>
            <div class="flex gap-2 items-center" id="dots4"></div>
            <button class="btn-next" onclick="goStep(5)">PRÓXIMO →</button>
        </div>
    </div>

    <!-- ══════ STEP 5 — Tema ══════ -->
    <div id="step5" class="ob-step hidden-step">
        <div class="flex-1 flex flex-col items-center justify-center w-full max-w-lg mx-auto px-10">
            <div class="w-full">
                <p style="color:var(--pk);font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:10px;">Passo 5 de 5</p>
                <h2 class="text-white mb-1" style="font-size:clamp(1.7rem,5vw,2.4rem);letter-spacing:-.03em;line-height:1.1;">Tema visual.</h2>
                <p style="color:rgba(255,255,255,.3);font-size:12px;margin-bottom:24px;">Clique ou use ← → para selecionar.</p>
                <div class="grid grid-cols-2 gap-3" id="themeGrid"></div>
            </div>
        </div>
        <div class="w-full px-10 pb-10 flex items-center justify-between">
            <button class="btn-back" onclick="goStep(4)">← VOLTAR</button>
            <div class="flex gap-2 items-center" id="dots5"></div>
            <button class="btn-next" onclick="goStep(6)">PRÓXIMO →</button>
        </div>
    </div>

    <!-- ══════ STEP 6 — Tudo pronto ══════ -->
    <div id="step6" class="ob-step hidden-step">
        <div class="flex-1 flex flex-col items-center justify-center px-10 text-center">
            <div class="flex items-center justify-center rounded-2xl mb-6"
                style="width:60px;height:60px;background:rgba(219,39,119,.1);border:1px solid rgba(219,39,119,.22);">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.2" stroke-linecap="round">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <p style="color:var(--pk);font-size:10px;letter-spacing:.22em;text-transform:uppercase;margin-bottom:12px;">
                <span class="acc-line"></span>Configuração completa
            </p>
            <h2 class="text-white mb-3" style="font-size:clamp(2rem,6vw,3rem);letter-spacing:-.03em;line-height:1.05;">TUDO<br>PRONTO!</h2>
            <p style="color:rgba(255,255,255,.3);font-size:12px;max-width:250px;line-height:1.9;margin-bottom:40px;">Sua conta está configurada. Bem-vindo ao StudyLab.</p>
            <button id="finishBtn" class="btn-next" onclick="finish(false)" style="padding:16px 52px;font-size:12px;">IR PARA O DASHBOARD &nbsp;→</button>
        </div>
        <div class="w-full px-10 pb-10 flex items-center justify-between">
            <button class="btn-back" onclick="goStep(5)">← VOLTAR</button>
            <div class="flex gap-2 items-center" id="dots6"></div>
            <span class="invisible" style="font-size:11px;">x</span>
        </div>
    </div>

    <!-- ══════ LOADING SCREEN (dashboard redirect) ══════ -->
    <div id="loadingScreen" class="hidden fixed inset-0 z-50 flex-col items-center justify-center gap-8"
        style="background:var(--ink);">

        <!-- animated erlenmeyer flask -->
        <div id="loadFlask" style="animation: bubbleFloat 2s ease-in-out infinite; filter:drop-shadow(0 0 12px rgba(219,39,119,.5));">
            <svg width="90" height="110" viewBox="0 0 90 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                <!-- neck -->
                <rect x="33" y="4" width="24" height="28" rx="4" fill="rgba(219,39,119,.15)" stroke="#db2777" stroke-width="2"/>
                <!-- neck lines (detail) -->
                <line x1="39" y1="10" x2="51" y2="10" stroke="#db2777" stroke-width="1" opacity=".4"/>
                <line x1="39" y1="16" x2="51" y2="16" stroke="#db2777" stroke-width="1" opacity=".3"/>
                <!-- stopper -->
                <rect x="30" y="2" width="30" height="6" rx="3" fill="#db2777"/>
                <!-- flask body outline -->
                <path d="M33 32 L10 80 Q8 92 45 92 Q82 92 80 80 L57 32 Z"
                      fill="rgba(219,39,119,.08)" stroke="#db2777" stroke-width="2" stroke-linejoin="round"/>
                <!-- liquid fill (animated sway) -->
                <clipPath id="flaskClip">
                    <path d="M33 32 L10 80 Q8 92 45 92 Q82 92 80 80 L57 32 Z"/>
                </clipPath>
                <g clip-path="url(#flaskClip)">
                    <rect id="liquidRect" x="8" y="62" width="74" height="32"
                          fill="#db2777" opacity=".35"
                          style="animation: liquidSway 3s ease-in-out infinite; transform-origin:center;"/>
                    <!-- surface wave -->
                    <path d="M8 64 Q20 60 32 64 Q44 68 56 64 Q68 60 80 64" stroke="#ec4899" stroke-width="1.5" fill="none" opacity=".6"/>
                </g>
                <!-- bubbles rising -->
                <circle cx="38" cy="70" r="3" fill="#f9a8d4" opacity=".7" style="animation:particleRise 2.2s ease-in infinite;"/>
                <circle cx="52" cy="76" r="2" fill="#f9a8d4" opacity=".5" style="animation:particleRise 1.8s ease-in .5s infinite;"/>
                <circle cx="44" cy="68" r="1.5" fill="#fda4af" opacity=".6" style="animation:particleRise 2.5s ease-in 1s infinite;"/>
                <!-- measurement lines -->
                <line x1="18" y1="80" x2="26" y2="80" stroke="#db2777" stroke-width="1" opacity=".4"/>
                <line x1="15" y1="74" x2="23" y2="74" stroke="#db2777" stroke-width="1" opacity=".3"/>
                <line x1="13" y1="68" x2="21" y2="68" stroke="#db2777" stroke-width="1" opacity=".25"/>
            </svg>
        </div>

        <!-- progress bar -->
        <div style="display:flex;flex-direction:column;align-items:center;gap:10px;width:220px;">
            <div style="width:100%;height:3px;border-radius:99px;background:rgba(255,255,255,.07);overflow:hidden;">
                <div id="progressBar" style="
                    height:100%; width:0%; border-radius:99px;
                    background: linear-gradient(90deg, #9d174d, #db2777, #f9a8d4, #db2777, #9d174d);
                    background-size: 200% 100%;
                    animation: shimmer 1.8s linear infinite;
                    transition: width .4s cubic-bezier(.4,0,.2,1);
                "></div>
            </div>

            <!-- bouncing dots -->
            <div style="display:flex;gap:6px;align-items:center;">
                <div style="width:6px;height:6px;border-radius:50%;background:var(--pk);animation:dotBounce 1.2s ease-in-out infinite;animation-delay:0s;"></div>
                <div style="width:6px;height:6px;border-radius:50%;background:var(--pk);animation:dotBounce 1.2s ease-in-out infinite;animation-delay:.15s;"></div>
                <div style="width:6px;height:6px;border-radius:50%;background:var(--pk);animation:dotBounce 1.2s ease-in-out infinite;animation-delay:.3s;"></div>
            </div>

            <p id="statusLabel" style="color:rgba(255,255,255,.3);font-size:10px;letter-spacing:.16em;text-transform:uppercase;transition:opacity .3s;">
                Configurando sua conta...
            </p>
        </div>
    </div>

    <script src="{{ asset('js/Onboarding.js') }}"></script>
</body>
</html>