@extends('layouts.focus')
@section('content')
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <!-- ════════════════
                                                                                                                                                                                                         LOADING
                                                                                                                                                                                                    ════════════════ -->
    <div id="loading">
        <div class="hc hc-tl"></div>
        <div class="hc hc-tr"></div>
        <div class="hc hc-bl"></div>
        <div class="hc hc-br"></div>
        <div
            style="position:absolute;top:32px;left:50%;transform:translateX(-50%);font-family:var(--fh);font-size:0.44rem;letter-spacing:0.24em;color:rgba(236,72,153,0.36);text-transform:uppercase;white-space:nowrap;">
            StudyLab &middot; Focus Engine</div>

        <!-- AXOLOTE -->
        <div id="axo-wrap">
            <div id="axo-scan"></div>
            <img src="{{ asset('favicons/logo/focus-logo.ico') }}" alt="Axolote">
        </div>

        <div
            style="font-family:var(--fh);font-size:0.9rem;font-weight:900;color:var(--wh);letter-spacing:-0.02em;margin-bottom:8px;">
            Carregando Escola Virtual<span style="color:#ec4899;">.</span></div>
        <div id="load-msg"
            style="font-family:var(--fb);font-size:0.6rem;color:var(--md);margin-bottom:26px;min-height:18px;letter-spacing:0.04em;">
            &#9642; Inicializando ambiente de foco...</div>
        <div style="display:flex;gap:5px;margin-bottom:26px;">
            <div class="ld-dot"></div>
            <div class="ld-dot"></div>
            <div class="ld-dot"></div>
        </div>
        <div style="width:220px;height:3px;background:rgba(255,255,255,0.06);border-radius:4px;overflow:hidden;">
            <div id="load-fill"></div>
        </div>
    </div>

    <div id="tutorial">
        <div class="tcard">

            <div class="tstep on" id="ts1">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Apresentação</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <div>
                        <p style="font-size:0.72rem;line-height:1.82;color:var(--md);margin-bottom:10px;">
                            A Escola Virtual e seu ambiente de concentracao maxima na StudyLab. Voce usa
                            <span style="color:#ec4899;font-weight:600;">várias ferramentas</span>
                            para melhorar seu estudo e desempenho dentro do nosso ambiente virtual.
                        </p>
                        <p style="font-size:0.72rem;line-height:1.82;color:var(--md);margin-bottom:20px;">
                            Alem disso <strong style="color:var(--wh);">voce pode criar seus proprios ciclos de
                                estudo</strong>.Possuimos tambem um banco de questões com milhares de questões.
                            Conheça nossos "professores" que vao te ajudar!
                        </p>
                    </div>
                </div>
            </div>

            <div class="tstep" id="ts2">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Professores</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <img src="{{ asset('images/mascotes/ms2.png') }}" alt="Renan"
                        style="width:120px;height:120px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div
                            style="font-family:var(--fh);font-size:0.85rem;font-weight:900;color:var(--wh);margin-bottom:6px;">
                            Prof. Renan</div>
                        <div
                            style="display:inline-flex;padding:2px 10px;border-radius:100px;background:rgba(52,211,153,0.1);border:1px solid rgba(52,211,153,0.25);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#34d399;margin-bottom:12px;">
                            Tecnologia</div>
                        <p style="font-size:0.68rem;line-height:1.8;color:var(--md);">E aí! Sou o Renan, especialista em
                            tecnologia. Hardware, software, programação e muito mais. Vamos explorar o mundo da tecnologia
                            juntos!</p>
                    </div>
                </div>
            </div>

            <div class="tstep" id="ts3">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Professores</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <img src="{{ asset('images/mascotes/ms3.png') }}" alt="Djmila"
                        style="width:120px;height:120px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div
                            style="font-family:var(--fh);font-size:0.85rem;font-weight:900;color:var(--wh);margin-bottom:6px;">
                            Prof. Djmila</div>
                        <div
                            style="display:inline-flex;padding:2px 10px;border-radius:100px;background:rgba(56,189,248,0.1);border:1px solid rgba(56,189,248,0.25);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#38bdf8;margin-bottom:12px;">
                            Humanas</div>
                        <p style="font-size:0.68rem;line-height:1.8;color:var(--md);">Sou a Djmila! História, geografia,
                            filosofia, sociologia — as ciências humanas são minha especialidade. Bora entender o mundo
                            juntos!</p>
                    </div>
                </div>
            </div>

            <div class="tstep" id="ts4">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Professores</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <img src="{{ asset('images/mascotes/ms4.png') }}" alt="Assis"
                        style="width:120px;height:120px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div
                            style="font-family:var(--fh);font-size:0.85rem;font-weight:900;color:var(--wh);margin-bottom:6px;">
                            Prof. Assis</div>
                        <div
                            style="display:inline-flex;padding:2px 10px;border-radius:100px;background:rgba(251,191,36,0.1);border:1px solid rgba(251,191,36,0.25);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#fbbf24;margin-bottom:12px;">
                            Linguagens</div>
                        <p style="font-size:0.68rem;line-height:1.8;color:var(--md);">Olá! Eu sou o Assis. Português,
                            literatura, redação, artes — a expressão humana é meu território. Vou te ajudar a se comunicar
                            com clareza e precisão.</p>
                    </div>
                </div>
            </div>

            <div class="tstep" id="ts5">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Professores</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <img src="{{ asset('images/mascotes/ms5.png') }}" alt="Gauss"
                        style="width:120px;height:120px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div
                            style="font-family:var(--fh);font-size:0.85rem;font-weight:900;color:var(--wh);margin-bottom:6px;">
                            Prof. Gauss</div>
                        <div
                            style="display:inline-flex;padding:2px 10px;border-radius:100px;background:rgba(236,72,153,0.1);border:1px solid rgba(236,72,153,0.25);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#ec4899;margin-bottom:12px;">
                            Matemática</div>
                        <p style="font-size:0.68rem;line-height:1.8;color:var(--md);">Eu sou o Gauss, mestre dos números!
                            Álgebra, geometria, trigonometria, cálculo — a matemática está em tudo ao nosso redor. Vamos
                            dominar juntos!</p>
                    </div>
                </div>
            </div>

            <div class="tstep" id="ts6">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Professores</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <img src="{{ asset('images/mascotes/ms6.png') }}" alt="Tatiana"
                        style="width:120px;height:120px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div
                            style="font-family:var(--fh);font-size:0.85rem;font-weight:900;color:var(--wh);margin-bottom:6px;">
                            Prof. Tatiana</div>
                        <div
                            style="display:inline-flex;padding:2px 10px;border-radius:100px;background:rgba(129,140,248,0.1);border:1px solid rgba(129,140,248,0.25);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#818cf8;margin-bottom:12px;">
                            Natureza</div>
                        <p style="font-size:0.68rem;line-height:1.8;color:var(--md);">Oi, eu sou a Tatiana! Biologia,
                            química e física — as ciências da natureza são meu território. Vou te ajudar a desvendar os
                            mistérios do mundo natural!</p>
                    </div>
                </div>
            </div>

            <div class="tstep" id="ts7">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Professores</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <img src="{{ asset('images/mascotes/ms1.png') }}" alt="Prof 7"
                        style="width:120px;height:120px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div
                            style="font-family:var(--fh);font-size:0.85rem;font-weight:900;color:var(--wh);margin-bottom:6px;">
                            AX</div>
                        <div
                            style="display:inline-flex;padding:2px 10px;border-radius:100px;background:rgba(248,113,113,0.1);border:1px solid rgba(248,113,113,0.25);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#f87171;margin-bottom:12px;">
                            Estudante</div>
                        <p style="font-size:0.68rem;line-height:1.8;color:var(--md);">Acho que você ja me viu por ai, eu so
                            ax e represento vocês estudantes. vamos estudar com calma e com qualidade!!!</p>
                    </div>
                </div>
            </div>

            <div class="tstep" id="ts8">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.18em;color:#ec4899;text-transform:uppercase;margin-bottom:20px;">
                    Escola Virtual · Professores</div>
                <div style="display:flex;align-items:center;gap:20px;">
                    <img src="{{ asset('images/mascotes/ms7.png') }}" alt="Prof 8"
                        style="width:120px;height:120px;object-fit:contain;flex-shrink:0;">
                    <div>
                        <div
                            style="font-family:var(--fh);font-size:0.85rem;font-weight:900;color:var(--wh);margin-bottom:6px;">
                            Niklor</div>
                        <div
                            style="display:inline-flex;padding:2px 10px;border-radius:100px;background:rgba(56,189,248,0.1);border:1px solid rgba(56,189,248,0.25);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#38bdf8;margin-bottom:12px;">
                            Diretor</div>

                        <p style="font-size:0.72rem;line-height:1.82;color:var(--md);margin-bottom:10px;">
                            Olá! Eu sou Niklor, o diretor da Escola Virtual. Estou aqui para te ajudar a
                            alcançar seus objetivos de aprendizado de forma mais eficiente e prazerosa. Agora vamos
                            começar!!!
                        </p>
                    </div>
                </div>
            </div>

            <div style="display:flex;align-items:center;margin-top:30px;">
                <button id="tut-skip"
                    style="padding:7px 15px;background:transparent;border:none;color:rgba(248,250,252,0.25);font-family:var(--fb);font-size:0.58rem;cursor:pointer;transition:color 0.18s;"
                    onmouseover="this.style.color='rgba(248,250,252,0.6)'"
                    onmouseout="this.style.color='rgba(248,250,252,0.25)'">Pular</button>

                <button id="tut-back"
                    style="display:none;padding:7px 15px;background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);border-radius:10px;color:var(--md);font-family:var(--fb);font-size:0.6rem;cursor:pointer;">&#8592;
                    Voltar</button>

                <div style="flex:1;display:flex;justify-content:center;gap:6px;" id="sdots">
                    <div class="sdot on"></div>
                    <div class="sdot"></div>
                    <div class="sdot"></div>
                    <div class="sdot"></div>
                    <div class="sdot"></div>
                    <div class="sdot"></div>
                    <div class="sdot"></div>
                    <div class="sdot"></div>
                </div>

                <button id="tut-next"
                    style="padding:7px 17px;background:rgba(236,72,153,0.1);border:1px solid rgba(236,72,153,0.26);border-radius:10px;color:#ec4899;font-family:var(--fh);font-size:0.48rem;font-weight:700;letter-spacing:0.08em;cursor:pointer;">PROXIMO
                    &#8594;</button>
            </div>

            <button id="enter-focus" class="btn-play"
                style="display:none;width:100%;justify-content:center;margin-top:16px;padding:15px;">
                <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M6 4l15 8-15 8V4z" />
                </svg>
                Entrar na Escola Virtual
            </button>

        </div>
    </div>


    <div id="app">

        <!-- CONTENT -->
        <div
            style="flex:1;overflow-y:auto;padding:32px 36px;display:flex;flex-direction:column;gap:22px;position:relative;">

            <!-- ROW 1: TIMER + STATS -->
            <div style="display:grid;grid-template-columns:1fr 276px;gap:20px;">

                <!-- TIMER -->
                <div class="card" style="padding:40px 46px;position:relative;overflow:hidden;">
                    <div
                        style="position:absolute;inset:0;background-image:linear-gradient(rgba(255,255,255,0.016) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,0.016) 1px,transparent 1px);background-size:44px 44px;pointer-events:none;">
                    </div>
                    <div
                        style="position:absolute;top:-60px;right:-60px;width:240px;height:240px;background:radial-gradient(circle,rgba(236,72,153,0.07) 0%,transparent 70%);pointer-events:none;">
                    </div>
                    <div style="display:flex;align-items:center;gap:50px;position:relative;z-index:1;">
                        <!-- ring -->
                        <div style="position:relative;flex-shrink:0;" id="timer-wrap">
                            <svg width="160" height="160" viewBox="0 0 160 160" style="transform:rotate(-90deg);">
                                <defs>
                                    <linearGradient id="rg" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" stop-color="#ec4899" />
                                        <stop offset="100%" stop-color="#9333ea" />
                                    </linearGradient>
                                </defs>
                                <circle cx="80" cy="80" r="74" fill="none" stroke="rgba(236,72,153,0.035)"
                                    stroke-width="14" />
                                <circle cx="80" cy="80" r="68" fill="none" class="ring-track" stroke-width="7" />
                                <circle cx="80" cy="80" r="68" fill="none" class="ring-fill" id="ring-fill"
                                    stroke-width="7" />
                                <line x1="80" y1="8" x2="80" y2="15" stroke="rgba(236,72,153,0.3)" stroke-width="1.5" />
                                <line x1="80" y1="145" x2="80" y2="152" stroke="rgba(236,72,153,0.3)" stroke-width="1.5" />
                                <line x1="8" y1="80" x2="15" y2="80" stroke="rgba(236,72,153,0.3)" stroke-width="1.5" />
                                <line x1="145" y1="80" x2="152" y2="80" stroke="rgba(236,72,153,0.3)" stroke-width="1.5" />
                            </svg>
                            <div
                                style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                                <div id="phase-lbl"
                                    style="font-family:var(--fh);font-size:0.4rem;letter-spacing:0.18em;text-transform:uppercase;color:#ec4899;margin-bottom:7px;">
                                    Pronto</div>
                                <div id="timer-digits"
                                    style="font-family:var(--fh);font-weight:900;font-size:2rem;color:var(--wh);letter-spacing:-0.04em;line-height:1;">
                                    25:00</div>
                                <div
                                    style="font-size:0.44rem;color:var(--md);margin-top:6px;font-family:var(--fb);letter-spacing:0.06em;">
                                    restando</div>
                            </div>
                        </div>
                        <!-- info -->
                        <div style="flex:1;">
                            <div
                                style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.14em;text-transform:uppercase;color:#ec4899;margin-bottom:10px;">
                                Tecnica Pomodoro</div>
                            <div
                                style="font-family:var(--fh);font-size:1.25rem;font-weight:900;color:var(--wh);line-height:1.1;margin-bottom:8px;">
                                Foco Total</div>
                            <p
                                style="font-size:0.67rem;color:var(--md);line-height:1.75;max-width:260px;margin-bottom:24px;">
                                25min foco &middot; 5min pausa &middot; Repita 4x para a pausa longa de 15min.</p>
                            <!-- cycles -->
                            <div style="display:flex;align-items:center;gap:8px;margin-bottom:22px;">
                                <span style="font-size:0.56rem;color:var(--md);font-family:var(--fb);">Ciclo</span>
                                @for($i = 1; $i <= 4; $i++)
                                    <div id="cy{{$i}}"
                                        style="width:12px;height:12px;border-radius:50%;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.12);transition:all 0.3s;">
                                </div>@endfor
                                <span id="cy-lbl"
                                    style="font-size:0.56rem;color:var(--md);font-family:var(--fh);font-weight:700;">0/4</span>
                            </div>
                            <!-- controls -->
                            <div style="display:flex;align-items:center;gap:10px;">
                                <button id="play-btn" class="btn-play">
                                    <svg id="play-icon" width="15" height="15" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M6 4l15 8-15 8V4z" />
                                    </svg>
                                    <span id="play-lbl">Iniciar</span>
                                </button>
                                <button class="btn-ico" id="reset-btn" title="Resetar"><svg width="15" height="15"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg></button>
                                <button class="btn-ico" id="skip-btn" title="Pular fase"><svg width="15" height="15"
                                        fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                    </svg></button>
                                <div style="width:1px;height:22px;background:var(--ld);margin:0 2px;"></div>
                                <button class="btn-ico" id="sound-btn" title="Som"><svg id="sound-icon" width="15"
                                        height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15.536 8.464a5 5 0 010 7.072M12 6v12m0 0l-3-3m3 3l3-3" />
                                    </svg></button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- STATS -->
                <div style="display:flex;flex-direction:column;gap:14px;">
                    <div class="stat-box">
                        <div
                            style="font-family:var(--fh);font-size:0.4rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--md);margin-bottom:8px;">
                            Sessoes hoje</div>
                        <div id="stat-sessions"
                            style="font-family:var(--fh);font-weight:900;font-size:1.7rem;color:var(--wh);line-height:1;margin-bottom:10px;">
                            0</div>
                        <div class="prog-track" style="height:3px;margin-bottom:5px;">
                            <div class="prog-fill" id="sess-bar" style="width:0%;"></div>
                        </div>
                        <div style="font-size:0.55rem;color:var(--md);">Meta: 4 sessoes</div>
                    </div>
                    <div class="stat-box">
                        <div
                            style="font-family:var(--fh);font-size:0.4rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--md);margin-bottom:8px;">
                            Foco total hoje</div>
                        <div id="stat-focus"
                            style="font-family:var(--fh);font-weight:900;font-size:1.7rem;color:var(--wh);line-height:1;">
                            0<span style="font-size:0.88rem;">min</span></div>
                    </div>
                    <div class="stat-box">
                        <div
                            style="font-family:var(--fh);font-size:0.4rem;letter-spacing:0.12em;text-transform:uppercase;color:var(--md);margin-bottom:10px;">
                            Fase atual</div>
                        <div id="phase-badge"
                            style="display:inline-flex;padding:4px 12px;border-radius:100px;background:rgba(236,72,153,0.1);border:1px solid rgba(236,72,153,0.22);font-family:var(--fh);font-size:0.44rem;font-weight:700;color:#ec4899;letter-spacing:0.08em;margin-bottom:7px;">
                            FOCO</div>
                        <div id="phase-next" style="font-size:0.57rem;color:var(--md);">Proximo: pausa curta</div>
                    </div>
                </div>
            </div>

            <!-- ROW 2: MATERIA + SEMANA -->
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <!-- MATERIA -->
                <div class="card" style="padding:28px 32px;">
                    <div
                        style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.14em;text-transform:uppercase;color:#ec4899;margin-bottom:16px;">
                        Materia atual</div>
                    <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:18px;">
                        @foreach(['Matematica', 'Fisica', 'Quimica', 'Biologia', 'Historia', 'Portugues', 'Ingles', 'Filosofia'] as $si => $s)
                            <div class="sub-tag {{ $si === 0 ? 'on' : '' }}" data-s="{{ $s }}">{{ $s }}</div>
                        @endforeach
                    </div>
                    <div style="display:flex;align-items:center;gap:8px;padding-top:16px;border-top:1px solid var(--ld);">
                        <div
                            style="width:7px;height:7px;border-radius:50%;background:#ec4899;box-shadow:0 0 8px rgba(236,72,153,0.6);flex-shrink:0;">
                        </div>
                        <span style="font-size:0.65rem;color:var(--wh);">Estudando: <strong id="cur-sub"
                                style="color:#ec4899;">Matematica</strong></span>
                    </div>
                </div>
                <!-- SEMANA -->
                <div class="card" style="padding:28px 32px;">
                    <div
                        style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.14em;text-transform:uppercase;color:#ec4899;margin-bottom:16px;">
                        Progresso da semana</div>
                    <div style="display:flex;align-items:flex-end;gap:6px;height:64px;">
                        @php $days = [['S', 48, 'done'], ['T', 36, 'done'], ['Q', 64, 'done'], ['Q', 24, 'done'], ['S', 8, 'now'], ['S', 0, ''], ['D', 0, '']]; @endphp
                        @foreach($days as $d)
                            <div style="display:flex;flex-direction:column;align-items:center;gap:5px;flex:1;">
                                <div style="width:100%;height:{{ max(6, $d[1]) }}px;" class="wbar {{ $d[2] }}"></div>
                                <span
                                    style="font-size:0.44rem;font-family:var(--fh);color:{{ $d[2] === 'now' ? '#ec4899' : 'var(--md)' }};">{{ $d[0] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div
                        style="display:flex;align-items:center;justify-content:space-between;margin-top:14px;padding-top:12px;border-top:1px solid var(--ld);">
                        <span style="font-size:0.58rem;color:var(--md);">Esta semana</span>
                        <span style="font-family:var(--fh);font-size:0.68rem;font-weight:900;color:var(--wh);">14
                            <span style="color:#ec4899;">sessoes</span></span>
                    </div>
                </div>
            </div>

            <!-- ROW 3: DICA -->
            <div class="card" style="padding:24px 32px;">
                <div
                    style="font-family:var(--fh);font-size:0.42rem;letter-spacing:0.14em;text-transform:uppercase;color:#ec4899;margin-bottom:14px;">
                    Dica de estudo</div>
                <div style="display:flex;align-items:flex-start;gap:14px;">
                    <div
                        style="width:38px;height:38px;border-radius:12px;background:rgba(236,72,153,0.08);border:1px solid rgba(236,72,153,0.13);display:flex;align-items:center;justify-content:center;font-size:1rem;flex-shrink:0;">
                        &#128161;</div>
                    <p id="tip-text" style="font-size:0.71rem;line-height:1.82;color:var(--md);padding-top:4px;">
                        Durante o Pomodoro, evite verificar o celular. Cada interrupcao leva cerca de 20 minutos
                        para recuperar o foco total.</p>
                </div>
            </div>

            <!-- BQ PANEL -->
            <div id="bq-panel">
                <div
                    style="display:flex;flex-direction:column;height:100%;width:282px;background:#181818;border-left:1px solid var(--ld);">
                    <div
                        style="display:flex;align-items:center;justify-content:space-between;padding:16px 20px;border-bottom:1px solid var(--ld);flex-shrink:0;">
                        <span
                            style="font-family:var(--fh);font-size:0.5rem;font-weight:700;letter-spacing:0.1em;color:var(--wh);">BANCO
                            DE QUESTOES</span>
                        <div id="close-bq"
                            style="width:24px;height:24px;display:flex;align-items:center;justify-content:center;cursor:pointer;color:#64748b;border-radius:6px;transition:all 0.18s;"
                            onmouseover="this.style.color='var(--wh)';this.style.background='rgba(255,255,255,0.05)';"
                            onmouseout="this.style.color='#64748b';this.style.background='transparent';">
                            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                    <div style="overflow-y:auto;flex:1;padding-bottom:20px;">
                        @php $bq = [['Exatas', '#ec4899', [['Matematica', '/math'], ['Fisica', '/fisica'], ['Quimica', '/quimica']]], ['Linguagens', '#fbbf24', [['Gramatica', '/gramatica'], ['Literatura', '/literatura'], ['Ingles', '/ingles'], ['Espanhol', '/espanhol'], ['Redacao', '/redacao']]], ['Humanas', '#818cf8', [['Historia', '/historia'], ['Geografia', '/geografia'], ['Sociologia', '/sociologia'], ['Filosofia', '/filosofia']]], ['Natureza', '#34d399', [['Biologia', '/biologia'], ['Ecologia', '/ecologia'], ['Fisica Moderna', '/fisica-moderna']]], ['Tecnologia', '#38bdf8', [['Algoritmos', '/algoritmos'], ['Prog. Web', '/prog-web'], ['Banco de Dados', '/banco-dados']]]]; @endphp
                        @foreach($bq as $a)
                            <div
                                style="font-size:0.48rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;color:#475569;padding:14px 20px 4px;">
                                {{ $a[0] }}
                            </div>
                            @foreach($a[2] as $item)
                                <a href="{{ $item[1] }}"
                                    style="display:flex;align-items:center;gap:10px;padding:0 20px;height:40px;text-decoration:none;border-left:2px solid transparent;color:#64748b;font-size:0.67rem;transition:all 0.16s;"
                                    onmouseover="this.style.background='rgba(255,255,255,0.04)';this.style.color='var(--wh)';"
                                    onmouseout="this.style.background='transparent';this.style.color='#64748b';">
                                    <div style="width:5px;height:5px;border-radius:50%;background:{{ $a[1] }};flex-shrink:0;">
                                    </div>{{ $item[0] }}
                                </a>
                            @endforeach
                            <div style="height:1px;margin:6px 20px;background:var(--ld);"></div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

@endsection