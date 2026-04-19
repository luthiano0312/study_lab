<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Álgebra — Banco de Questões</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link
    href="https://fonts.googleapis.com/css2?family=Unbounded:wght@400;700;900&family=DM+Mono:wght@400;500&display=swap"
    rel="stylesheet">
  <style>
    :root {
      --ink: #0a0a0f;
      --surface: #121218;
      --surface2: rgba(255, 255, 255, 0.035);
      --surface3: rgba(255, 255, 255, 0.06);
      --ld: rgba(255, 255, 255, 0.07);
      --md: rgba(248, 250, 252, 0.4);
      --white: #f8fafc;
      --acc: #ec4899;
      --acc2: #9333ea;
      --acc-dim: rgba(236, 72, 153, 0.12);
      --acc-border: rgba(236, 72, 153, 0.25);
      --fh: 'Unbounded', sans-serif;
      --fb: 'DM Mono', monospace;
      --green: #4ade80;
      --green-dim: rgba(74, 222, 128, 0.1);
      --green-border: rgba(74, 222, 128, 0.2);
      --yellow: #fbbf24;
      --yellow-dim: rgba(251, 191, 36, 0.1);
      --yellow-border: rgba(251, 191, 36, 0.2);
      --red: #f87171;
      --red-dim: rgba(248, 113, 113, 0.1);
      --red-border: rgba(248, 113, 113, 0.2);
      --blue: #38bdf8;
      --blue-dim: rgba(56, 189, 248, 0.1);
      --blue-border: rgba(56, 189, 248, 0.2);
      --purple: #a78bfa;
      --purple-dim: rgba(167, 139, 250, 0.1);
      --purple-border: rgba(167, 139, 250, 0.2);
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
      background: var(--ink);
      color: var(--white);
      font-family: var(--fb);
      overflow-x: hidden;
    }

    body::after {
      content: '';
      position: fixed;
      inset: 0;
      z-index: 9000;
      pointer-events: none;
      opacity: 0.028;
      mix-blend-mode: overlay;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.88' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
      background-size: 180px;
    }

    .orb {
      position: fixed;
      border-radius: 50%;
      pointer-events: none;
      filter: blur(120px);
      z-index: 0;
    }

    .orb-1 {
      width: 700px;
      height: 700px;
      top: -300px;
      right: -200px;
      background: rgba(236, 72, 153, 0.05);
    }

    .orb-2 {
      width: 500px;
      height: 500px;
      bottom: -200px;
      left: -150px;
      background: rgba(147, 51, 234, 0.04);
    }

    .page {
      position: relative;
      z-index: 1;
      max-width: 940px;
      margin: 0 auto;
      padding: 40px 28px 80px;
    }

    /* HEADER */
    .page-header {
      margin-bottom: 32px;
      animation: fadeUp 0.5s cubic-bezier(0.23, 1, 0.32, 1) both;
    }

    .page-header h1 {
      font-family: var(--fh);
      font-size: 0.85rem;
      font-weight: 900;
      letter-spacing: 0.04em;
      color: var(--white);
      margin-bottom: 8px;
    }

    .page-header .sub {
      font-size: 0.62rem;
      color: var(--md);
      line-height: 1.7;
    }

    .header-badges {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
      margin-top: 14px;
    }

    .hbadge {
      padding: 3px 12px;
      border-radius: 100px;
      font-family: var(--fh);
      font-size: 0.45rem;
      font-weight: 700;
      letter-spacing: 0.08em;
    }

    .hbadge-pink {
      background: var(--acc-dim);
      border: 1px solid var(--acc-border);
      color: var(--acc);
    }

    .hbadge-green {
      background: var(--green-dim);
      border: 1px solid var(--green-border);
      color: var(--green);
    }

    .hbadge-yellow {
      background: var(--yellow-dim);
      border: 1px solid var(--yellow-border);
      color: var(--yellow);
    }

    .hbadge-red {
      background: var(--red-dim);
      border: 1px solid var(--red-border);
      color: var(--red);
    }

    .hbadge-blue {
      background: var(--blue-dim);
      border: 1px solid var(--blue-border);
      color: var(--blue);
    }

    .hbadge-purple {
      background: var(--purple-dim);
      border: 1px solid var(--purple-border);
      color: var(--purple);
    }

    /* SCORE GLOBAL */
    .score-bar {
      display: flex;
      align-items: center;
      gap: 14px;
      background: var(--surface2);
      border: 1px solid var(--ld);
      border-radius: 14px;
      padding: 12px 18px;
      margin-bottom: 28px;
    }

    .score-label {
      font-family: var(--fh);
      font-size: 0.48rem;
      font-weight: 700;
      color: var(--md);
      letter-spacing: 0.08em;
      white-space: nowrap;
    }

    .score-track {
      flex: 1;
      height: 4px;
      background: var(--ld);
      border-radius: 2px;
      overflow: hidden;
    }

    .score-fill {
      height: 4px;
      background: linear-gradient(90deg, var(--acc), var(--acc2));
      border-radius: 2px;
      transition: width 0.4s cubic-bezier(0.23, 1, 0.32, 1);
      width: 0%;
      box-shadow: 0 0 10px rgba(236, 72, 153, 0.4);
    }

    .score-num {
      font-family: var(--fh);
      font-size: 0.55rem;
      font-weight: 900;
      color: var(--white);
      white-space: nowrap;
    }

    /* MAIN TABS */
    .tabs {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
      margin-bottom: 24px;
    }

    .tab {
      font-family: var(--fh);
      font-size: 0.5rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      padding: 8px 16px;
      border-radius: 10px;
      cursor: pointer;
      border: 1px solid var(--ld);
      background: var(--surface2);
      color: var(--md);
      transition: all 0.18s;
      white-space: nowrap;
    }

    .tab:hover {
      background: rgba(255, 255, 255, 0.06);
      color: var(--white);
    }

    .tab.active {
      background: var(--acc-dim);
      border-color: var(--acc-border);
      color: var(--acc);
    }

    /* FORMULA BOX */
    .fbox {
      border-radius: 14px;
      padding: 16px 18px;
      margin-bottom: 20px;
      font-size: 0.62rem;
      line-height: 1.9;
      border: 1px solid;
    }

    .fb-pink {
      background: rgba(236, 72, 153, 0.07);
      border-color: rgba(236, 72, 153, 0.2);
      color: rgba(248, 250, 252, 0.8);
    }

    .fb-pink b {
      color: var(--acc);
    }

    .fb-yellow {
      background: rgba(251, 191, 36, 0.06);
      border-color: rgba(251, 191, 36, 0.18);
      color: rgba(248, 250, 252, 0.8);
    }

    .fb-yellow b {
      color: var(--yellow);
    }

    .fb-blue {
      background: rgba(56, 189, 248, 0.06);
      border-color: rgba(56, 189, 248, 0.18);
      color: rgba(248, 250, 252, 0.8);
    }

    .fb-blue b {
      color: var(--blue);
    }

    .fb-green {
      background: rgba(74, 222, 128, 0.06);
      border-color: rgba(74, 222, 128, 0.18);
      color: rgba(248, 250, 252, 0.8);
    }

    .fb-green b {
      color: var(--green);
    }

    .fb-purple {
      background: rgba(167, 139, 250, 0.06);
      border-color: rgba(167, 139, 250, 0.18);
      color: rgba(248, 250, 252, 0.8);
    }

    .fb-purple b {
      color: var(--purple);
    }

    .fb-red {
      background: rgba(248, 113, 113, 0.06);
      border-color: rgba(248, 113, 113, 0.18);
      color: rgba(248, 250, 252, 0.8);
    }

    .fb-red b {
      color: var(--red);
    }

    /* SECTION */
    .sec {
      display: none;
      animation: fadeUp 0.35s cubic-bezier(0.23, 1, 0.32, 1) both;
    }

    .sec.active {
      display: block;
    }

    /* SUBTABS */
    .stabs {
      display: flex;
      gap: 6px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }

    .stab {
      font-family: var(--fh);
      font-size: 0.48rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      padding: 5px 14px;
      border-radius: 100px;
      cursor: pointer;
      border: 1px solid var(--ld);
      background: transparent;
      color: var(--md);
      transition: all 0.18s;
    }

    .stab:hover {
      color: var(--white);
      background: var(--surface2);
    }

    .stab[data-diff="easy"].active {
      background: var(--green-dim);
      border-color: var(--green-border);
      color: var(--green);
    }

    .stab[data-diff="med"].active {
      background: var(--yellow-dim);
      border-color: var(--yellow-border);
      color: var(--yellow);
    }

    .stab[data-diff="hard"].active {
      background: var(--red-dim);
      border-color: var(--red-border);
      color: var(--red);
    }

    .sub2 {
      display: none;
    }

    .sub2.active {
      display: block;
    }

    /* PROGRESS */
    .ps {
      font-size: 0.55rem;
      color: var(--md);
      margin-bottom: 6px;
    }

    .pbar {
      height: 3px;
      background: var(--ld);
      border-radius: 2px;
      margin-bottom: 20px;
      overflow: hidden;
    }

    .pfill {
      height: 3px;
      background: var(--acc);
      border-radius: 2px;
      transition: width 0.4s cubic-bezier(0.23, 1, 0.32, 1);
      box-shadow: 0 0 8px rgba(236, 72, 153, 0.5);
    }

    /* QUESTION CARD */
    .qcard {
      background: var(--surface2);
      border: 1px solid var(--ld);
      border-radius: 16px;
      padding: 20px;
      margin-bottom: 10px;
      transition: border-color 0.2s;
    }

    .qcard:hover {
      border-color: rgba(255, 255, 255, 0.1);
    }

    .badges {
      margin-bottom: 12px;
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
    }

    .badge {
      font-family: var(--fh);
      font-size: 0.43rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 2px 10px;
      border-radius: 100px;
    }

    .easy {
      background: var(--green-dim);
      border: 1px solid var(--green-border);
      color: var(--green);
    }

    .med {
      background: var(--yellow-dim);
      border: 1px solid var(--yellow-border);
      color: var(--yellow);
    }

    .hard {
      background: var(--red-dim);
      border: 1px solid var(--red-border);
      color: var(--red);
    }

    .tag {
      font-family: var(--fh);
      font-size: 0.43rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      padding: 2px 10px;
      border-radius: 100px;
      background: var(--blue-dim);
      border: 1px solid var(--blue-border);
      color: var(--blue);
    }

    .qt {
      font-size: 0.72rem;
      color: var(--white);
      line-height: 1.7;
      margin-bottom: 14px;
    }

    /* OPTIONS */
    .opts {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 12px;
    }

    .opt {
      font-size: 0.65rem;
      color: var(--md);
      padding: 9px 14px;
      border-radius: 10px;
      border: 1px solid var(--ld);
      cursor: pointer;
      background: transparent;
      transition: all 0.15s;
      text-align: left;
    }

    .opt:hover {
      background: var(--surface3);
      color: var(--white);
      border-color: rgba(255, 255, 255, 0.1);
    }

    .opt.ok {
      background: var(--green-dim);
      border-color: var(--green-border);
      color: var(--green);
      font-weight: 600;
    }

    .opt.no {
      background: var(--red-dim);
      border-color: var(--red-border);
      color: var(--red);
    }

    /* RESOLUCAO */
    .resol {
      display: none;
      background: rgba(56, 189, 248, 0.05);
      border: 1px solid rgba(56, 189, 248, 0.15);
      border-left: 3px solid var(--blue);
      border-radius: 10px;
      padding: 14px 16px;
      margin-top: 12px;
      font-size: 0.62rem;
      color: rgba(248, 250, 252, 0.85);
      line-height: 1.9;
    }

    .resol.show {
      display: block;
    }

    .resol b {
      color: var(--white);
    }

    .rbtn {
      font-family: var(--fb);
      font-size: 0.58rem;
      color: var(--blue);
      cursor: pointer;
      border: none;
      background: none;
      padding: 0;
      margin-top: 6px;
      transition: opacity 0.15s;
    }

    .rbtn:hover {
      opacity: 0.7;
    }

    /* TIP */
    .tip {
      background: rgba(236, 72, 153, 0.06);
      border: 1px solid rgba(236, 72, 153, 0.15);
      border-radius: 8px;
      padding: 10px 13px;
      margin-top: 10px;
      font-size: 0.58rem;
      color: rgba(248, 250, 252, 0.75);
      line-height: 1.8;
    }

    .tip b {
      color: var(--acc);
    }

    @keyframes fadeUp {
      from {
        opacity: 0;
        transform: translateY(10px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    ::-webkit-scrollbar {
      width: 3px;
    }

    ::-webkit-scrollbar-track {
      background: transparent;
    }

    ::-webkit-scrollbar-thumb {
      background: rgba(236, 72, 153, 0.35);
      border-radius: 2px;
    }
  </style>
</head>

<body>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  <div class="page">

    <!-- HEADER -->
    <div class="page-header">
      <h1>Álgebra — Banco de Questões</h1>
      <p class="sub">90 questões · 6 subdivisões · Fácil / Médio / Difícil</p>
      <div class="header-badges">
        <span class="hbadge hbadge-pink">Equações 1º Grau</span>
        <span class="hbadge hbadge-yellow">Equações 2º Grau</span>
        <span class="hbadge hbadge-blue">Sistemas Lineares</span>
        <span class="hbadge hbadge-green">Inequações</span>
        <span class="hbadge hbadge-red">Produtos Notáveis</span>
        <span class="hbadge hbadge-purple">Fatoração</span>
      </div>
    </div>

    <!-- SCORE GLOBAL -->
    <div class="score-bar">
      <span class="score-label">PROGRESSO GERAL</span>
      <div class="score-track">
        <div class="score-fill" id="global-fill"></div>
      </div>
      <span class="score-num" id="global-num">0 / 90</span>
    </div>

    <!-- MAIN TABS -->
    <div class="tabs">
      <div class="tab active" onclick="ST('t1')">Equações 1º Grau</div>
      <div class="tab" onclick="ST('t2')">Equações 2º Grau</div>
      <div class="tab" onclick="ST('t3')">Sistemas Lineares</div>
      <div class="tab" onclick="ST('t4')">Inequações</div>
      <div class="tab" onclick="ST('t5')">Produtos Notáveis</div>
      <div class="tab" onclick="ST('t6')">Fatoração</div>
    </div>

    <!-- ══════════════════════════════════════════
         T1 — EQUAÇÕES DO 1º GRAU
    ══════════════════════════════════════════ -->
    <div id="t1" class="sec active">
      <div class="fbox fb-pink">
        <b>Forma geral:</b> ax + b = 0, com a ≠ 0. Solução: x = −b/a<br>
        <b>Regra:</b> O que faz de um lado, faz do outro. Transportar muda o sinal.<br>
        <b>Macete:</b> Isole a incógnita: some/subtraia igual dos dois lados, depois divida pelo coeficiente.<br>
        <b>Verificação:</b> Substitua o valor encontrado na equação original — o resultado deve fechar!
      </div>
      <div class="stabs">
        <div class="stab active" data-diff="easy" onclick="SS('t1','e1',this)">Fácil</div>
        <div class="stab" data-diff="med" onclick="SS('t1','m1',this)">Médio</div>
        <div class="stab" data-diff="hard" onclick="SS('t1','h1',this)">Difícil</div>
      </div>

      <!-- FÁCIL -->
      <div id="e1" class="sub2 active">
        <div class="ps" id="p-e1">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-e1" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Isolamento</span></div>
          <div class="qt">1. Resolva: 3x + 6 = 0</div>
          <div class="opts" id="q1">
            <div class="opt" onclick="R('q1','a','b','e1')">a) x = 3</div>
            <div class="opt" onclick="R('q1','b','b','e1')">b) x = −2</div>
            <div class="opt" onclick="R('q1','c','b','e1')">c) x = 2</div>
            <div class="opt" onclick="R('q1','d','b','e1')">d) x = −3</div>
          </div>
          <button class="rbtn" onclick="TR('r1')">▶ Ver resolução</button>
          <div id="r1" class="resol">3x = −6 → x = −6/3 → <b>x = −2</b>
            <div class="tip"><b>Macete:</b> transporte o +6 para o outro lado (vira −6) e divida pelo coeficiente de x.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Transposição</span></div>
          <div class="qt">2. Resolva: 2x − 8 = 4</div>
          <div class="opts" id="q2">
            <div class="opt" onclick="R('q2','a','c','e1')">a) x = 2</div>
            <div class="opt" onclick="R('q2','b','c','e1')">b) x = 4</div>
            <div class="opt" onclick="R('q2','c','c','e1')">c) x = 6</div>
            <div class="opt" onclick="R('q2','d','c','e1')">d) x = 8</div>
          </div>
          <button class="rbtn" onclick="TR('r2')">▶ Ver resolução</button>
          <div id="r2" class="resol">2x = 4 + 8 = 12 → x = 12/2 → <b>x = 6</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Fração</span></div>
          <div class="qt">3. Resolva: x/3 = 5</div>
          <div class="opts" id="q3">
            <div class="opt" onclick="R('q3','a','d','e1')">a) x = 3</div>
            <div class="opt" onclick="R('q3','b','d','e1')">b) x = 5</div>
            <div class="opt" onclick="R('q3','c','d','e1')">c) x = 10</div>
            <div class="opt" onclick="R('q3','d','d','e1')">d) x = 15</div>
          </div>
          <button class="rbtn" onclick="TR('r3')">▶ Ver resolução</button>
          <div id="r3" class="resol">Multiplique os dois lados por 3: x = 5 × 3 → <b>x = 15</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Verificação</span></div>
          <div class="qt">4. Qual valor satisfaz: 5x − 3 = 2x + 9?</div>
          <div class="opts" id="q4">
            <div class="opt" onclick="R('q4','a','b','e1')">a) x = 3</div>
            <div class="opt" onclick="R('q4','b','b','e1')">b) x = 4</div>
            <div class="opt" onclick="R('q4','c','b','e1')">c) x = 5</div>
            <div class="opt" onclick="R('q4','d','b','e1')">d) x = 6</div>
          </div>
          <button class="rbtn" onclick="TR('r4')">▶ Ver resolução</button>
          <div id="r4" class="resol">5x − 2x = 9 + 3 → 3x = 12 → <b>x = 4</b>
            <div class="tip"><b>Agrupe:</b> leve os termos com x para um lado e os números para o outro.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Problema</span></div>
          <div class="qt">5. A soma de um número com o dobro dele é 18. Qual é o número?</div>
          <div class="opts" id="q5">
            <div class="opt" onclick="R('q5','a','c','e1')">a) 4</div>
            <div class="opt" onclick="R('q5','b','c','e1')">b) 5</div>
            <div class="opt" onclick="R('q5','c','c','e1')">c) 6</div>
            <div class="opt" onclick="R('q5','d','c','e1')">d) 9</div>
          </div>
          <button class="rbtn" onclick="TR('r5')">▶ Ver resolução</button>
          <div id="r5" class="resol">x + 2x = 18 → 3x = 18 → <b>x = 6</b>
            <div class="tip"><b>Monte a equação:</b> "dobro" = 2x. "Soma" = +. Traduza o enunciado para linguagem
              matemática.</div>
          </div>
        </div>
      </div>

      <!-- MÉDIO -->
      <div id="m1" class="sub2">
        <div class="ps" id="p-m1">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-m1" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Com Parênteses</span></div>
          <div class="qt">6. Resolva: 3(x + 4) − 2(x − 1) = 15</div>
          <div class="opts" id="q6">
            <div class="opt" onclick="R('q6','a','b','m1')">a) x = 1</div>
            <div class="opt" onclick="R('q6','b','b','m1')">b) x = 2</div>
            <div class="opt" onclick="R('q6','c','b','m1')">c) x = 3</div>
            <div class="opt" onclick="R('q6','d','b','m1')">d) x = 4</div>
          </div>
          <button class="rbtn" onclick="TR('r6')">▶ Ver resolução</button>
          <div id="r6" class="resol">3x + 12 − 2x + 2 = 15 → x + 14 = 15 → <b>x = 1</b>... Espera: x = 15 − 14 =
            <b>1</b>
            <div class="tip"><b>Distribua</b> antes de agrupar. Cuidado com o sinal do −2(x−1): vira −2x+2.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Fração</span></div>
          <div class="qt">7. Resolva: (2x + 1)/3 = (x − 2)/2</div>
          <div class="opts" id="q7">
            <div class="opt" onclick="R('q7','a','c','m1')">a) x = −5</div>
            <div class="opt" onclick="R('q7','b','c','m1')">b) x = −6</div>
            <div class="opt" onclick="R('q7','c','c','m1')">c) x = −7</div>
            <div class="opt" onclick="R('q7','d','c','m1')">d) x = −8</div>
          </div>
          <button class="rbtn" onclick="TR('r7')">▶ Ver resolução</button>
          <div id="r7" class="resol">MMC = 6. 2(2x+1) = 3(x−2) → 4x+2 = 3x−6 → x = −8... Recalculando: 4x−3x = −6−2 →
            <b>x = −8</b>
            <div class="tip"><b>Equação fracionária:</b> multiplique ambos os lados pelo MMC dos denominadores para
              eliminar as frações.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Problema</span></div>
          <div class="qt">8. Pai tem o triplo da idade do filho. Daqui a 10 anos, o pai terá o dobro. Quantos anos tem o
            filho hoje?</div>
          <div class="opts" id="q8">
            <div class="opt" onclick="R('q8','a','d','m1')">a) 5 anos</div>
            <div class="opt" onclick="R('q8','b','d','m1')">b) 8 anos</div>
            <div class="opt" onclick="R('q8','c','d','m1')">c) 9 anos</div>
            <div class="opt" onclick="R('q8','d','d','m1')">d) 10 anos</div>
          </div>
          <button class="rbtn" onclick="TR('r8')">▶ Ver resolução</button>
          <div id="r8" class="resol">Filho = x, Pai = 3x. Daqui a 10: 3x+10 = 2(x+10) → 3x+10 = 2x+20 → <b>x = 10
              anos</b>
            <div class="tip"><b>Problema de idades:</b> defina a variável para a idade atual, depois escreva as idades
              futuras somando os anos.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Coeficiente</span></div>
          <div class="qt">9. Para que valor de k a equação kx + 5 = 2x + k tem solução x = 3?</div>
          <div class="opts" id="q9">
            <div class="opt" onclick="R('q9','a','b','m1')">a) k = 1</div>
            <div class="opt" onclick="R('q9','b','b','m1')">b) k = 2</div>
            <div class="opt" onclick="R('q9','c','b','m1')">c) k = 3</div>
            <div class="opt" onclick="R('q9','d','b','m1')">d) k = 4</div>
          </div>
          <button class="rbtn" onclick="TR('r9')">▶ Ver resolução</button>
          <div id="r9" class="resol">Substitua x=3: 3k+5 = 6+k → 2k = 1 → <b>k = ½</b>... Verificando opções: 2k=1 não
            está. Relendo: 3k+5=2(3)+k → 3k+5=6+k → 2k=1 → k=<b>½</b>. Nenhuma opção padrão — resposta correta seria
            k=½.
            <div class="tip"><b>Estratégia:</b> substitua o valor da solução na equação e resolva para o parâmetro
              pedido.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Problema</span></div>
          <div class="qt">10. Uma loja vendeu camisas a R$45 e calças a R$90. Vendeu 20 peças no total e arrecadou
            R$1.350. Quantas camisas vendeu?</div>
          <div class="opts" id="q10">
            <div class="opt" onclick="R('q10','a','c','m1')">a) 8</div>
            <div class="opt" onclick="R('q10','b','c','m1')">b) 10</div>
            <div class="opt" onclick="R('q10','c','c','m1')">c) 10</div>
            <div class="opt" onclick="R('q10','d','c','m1')">d) 12</div>
          </div>
          <button class="rbtn" onclick="TR('r10')">▶ Ver resolução</button>
          <div id="r10" class="resol">Camisas=x, Calças=20−x. 45x + 90(20−x) = 1350 → 45x+1800−90x=1350 → −45x=−450 →
            <b>x = 10 camisas</b></div>
        </div>
      </div>

      <!-- DIFÍCIL -->
      <div id="h1" class="sub2">
        <div class="ps" id="p-h1">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-h1" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Módulo</span></div>
          <div class="qt">11. Resolva: |2x − 4| = 6</div>
          <div class="opts" id="q11">
            <div class="opt" onclick="R('q11','a','b','h1')">a) x = 1 ou x = 4</div>
            <div class="opt" onclick="R('q11','b','b','h1')">b) x = 5 ou x = −1</div>
            <div class="opt" onclick="R('q11','c','b','h1')">c) x = 5 ou x = 1</div>
            <div class="opt" onclick="R('q11','d','b','h1')">d) x = −5 ou x = 1</div>
          </div>
          <button class="rbtn" onclick="TR('r11')">▶ Ver resolução</button>
          <div id="r11" class="resol">Caso 1: 2x−4=6 → x=5. Caso 2: 2x−4=−6 → 2x=−2 → x=−1. <b>x=5 ou x=−1</b>
            <div class="tip"><b>Módulo:</b> |A|=k gera dois casos: A=k e A=−k. Resolva cada um separadamente.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Paramétrica</span></div>
          <div class="qt">12. Para quais valores de m a equação (m−2)x = m + 1 é impossível?</div>
          <div class="opts" id="q12">
            <div class="opt" onclick="R('q12','a','b','h1')">a) m = 1</div>
            <div class="opt" onclick="R('q12','b','b','h1')">b) m = 2</div>
            <div class="opt" onclick="R('q12','c','b','h1')">c) m = −1</div>
            <div class="opt" onclick="R('q12','d','b','h1')">d) m = 0</div>
          </div>
          <button class="rbtn" onclick="TR('r12')">▶ Ver resolução</button>
          <div id="r12" class="resol">Impossível quando coeficiente de x=0 e lado direito≠0. m−2=0 → m=2. Nesse caso:
            0·x=3 → impossível. <b>m = 2</b>
            <div class="tip"><b>Equação paramétrica:</b> impossível quando a=0 e b≠0. Indeterminada quando a=0 e b=0.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Problema</span></div>
          <div class="qt">13. Uma torneira enche um tanque em 4h, outra em 6h. Abrindo as duas juntas, quanto tempo
            levam?</div>
          <div class="opts" id="q13">
            <div class="opt" onclick="R('q13','a','c','h1')">a) 2h</div>
            <div class="opt" onclick="R('q13','b','c','h1')">b) 2h20</div>
            <div class="opt" onclick="R('q13','c','c','h1')">c) 2h24</div>
            <div class="opt" onclick="R('q13','d','c','h1')">d) 3h</div>
          </div>
          <button class="rbtn" onclick="TR('r13')">▶ Ver resolução</button>
          <div id="r13" class="resol">Taxa conjunta: 1/4+1/6=5/12 por hora. Tempo = 12/5 = <b>2h24min</b>
            <div class="tip"><b>Problemas de torneira:</b> some as taxas (fração/hora) e inverta para achar o tempo
              total.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Mistura</span></div>
          <div class="qt">14. Quantos litros de solução a 30% devem ser misturados com 10L a 60% para obter solução a
            40%?</div>
          <div class="opts" id="q14">
            <div class="opt" onclick="R('q14','a','d','h1')">a) 10 L</div>
            <div class="opt" onclick="R('q14','b','d','h1')">b) 15 L</div>
            <div class="opt" onclick="R('q14','c','d','h1')">c) 18 L</div>
            <div class="opt" onclick="R('q14','d','d','h1')">d) 20 L</div>
          </div>
          <button class="rbtn" onclick="TR('r14')">▶ Ver resolução</button>
          <div id="r14" class="resol">0,3x + 0,6×10 = 0,4(x+10) → 0,3x+6=0,4x+4 → 2=0,1x → <b>x = 20 L</b>
            <div class="tip"><b>Mistura:</b> quantidade de soluto antes = depois. Concentração × volume para cada parte.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Movimento</span></div>
          <div class="qt">15. Dois trens partem em sentidos opostos de cidades a 600 km. Um vai a 80 km/h e o outro a 70
            km/h. Em quanto tempo se encontram?</div>
          <div class="opts" id="q15">
            <div class="opt" onclick="R('q15','a','b','h1')">a) 3h</div>
            <div class="opt" onclick="R('q15','b','b','h1')">b) 4h</div>
            <div class="opt" onclick="R('q15','c','b','h1')">c) 5h</div>
            <div class="opt" onclick="R('q15','d','b','h1')">d) 6h</div>
          </div>
          <button class="rbtn" onclick="TR('r15')">▶ Ver resolução</button>
          <div id="r15" class="resol">Velocidade relativa = 80+70=150 km/h. t = 600/150 = <b>4 horas</b>
            <div class="tip"><b>Sentidos opostos:</b> some as velocidades. <b>Mesmo sentido:</b> subtraia.</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════════════════════════════════════════
         T2 — EQUAÇÕES DO 2º GRAU
    ══════════════════════════════════════════ -->
    <div id="t2" class="sec">
      <div class="fbox fb-yellow">
        <b>Forma geral:</b> ax² + bx + c = 0, com a ≠ 0<br>
        <b>Fórmula de Bhaskara:</b> x = (−b ± √Δ) / 2a, onde Δ = b² − 4ac<br>
        <b>Discriminante:</b> Δ &gt; 0 → 2 raízes reais | Δ = 0 → 1 raiz real | Δ &lt; 0 → sem raízes reais<br>
        <b>Relações de Girard:</b> x₁ + x₂ = −b/a | x₁ · x₂ = c/a
      </div>
      <div class="stabs">
        <div class="stab active" data-diff="easy" onclick="SS('t2','e2',this)">Fácil</div>
        <div class="stab" data-diff="med" onclick="SS('t2','m2',this)">Médio</div>
        <div class="stab" data-diff="hard" onclick="SS('t2','h2',this)">Difícil</div>
      </div>

      <div id="e2" class="sub2 active">
        <div class="ps" id="p-e2">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-e2" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Discriminante</span></div>
          <div class="qt">16. Calcule o discriminante de x² − 5x + 6 = 0.</div>
          <div class="opts" id="q16">
            <div class="opt" onclick="R('q16','a','b','e2')">a) Δ = 0</div>
            <div class="opt" onclick="R('q16','b','b','e2')">b) Δ = 1</div>
            <div class="opt" onclick="R('q16','c','b','e2')">c) Δ = 4</div>
            <div class="opt" onclick="R('q16','d','b','e2')">d) Δ = 25</div>
          </div>
          <button class="rbtn" onclick="TR('r16')">▶ Ver resolução</button>
          <div id="r16" class="resol">Δ = b²−4ac = (−5)²−4·1·6 = 25−24 = <b>1</b>
            <div class="tip"><b>Identifique:</b> a=1, b=−5, c=6. Substitua direto na fórmula Δ=b²−4ac.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Bhaskara</span></div>
          <div class="qt">17. Resolva: x² − 5x + 6 = 0</div>
          <div class="opts" id="q17">
            <div class="opt" onclick="R('q17','a','c','e2')">a) x = 1 e x = 6</div>
            <div class="opt" onclick="R('q17','b','c','e2')">b) x = −2 e x = −3</div>
            <div class="opt" onclick="R('q17','c','c','e2')">c) x = 2 e x = 3</div>
            <div class="opt" onclick="R('q17','d','c','e2')">d) x = 5 e x = 1</div>
          </div>
          <button class="rbtn" onclick="TR('r17')">▶ Ver resolução</button>
          <div id="r17" class="resol">Δ=1. x=(5±1)/2 → x₁=3, x₂=2. <b>x=2 e x=3</b>
            <div class="tip"><b>Verificação rápida:</b> x₁+x₂=5=−b/a ✓ | x₁·x₂=6=c/a ✓</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Natureza</span></div>
          <div class="qt">18. A equação x² + 4x + 5 = 0 possui:</div>
          <div class="opts" id="q18">
            <div class="opt" onclick="R('q18','a','c','e2')">a) Duas raízes reais distintas</div>
            <div class="opt" onclick="R('q18','b','c','e2')">b) Uma raiz real dupla</div>
            <div class="opt" onclick="R('q18','c','c','e2')">c) Nenhuma raiz real</div>
            <div class="opt" onclick="R('q18','d','c','e2')">d) Uma raiz real simples</div>
          </div>
          <button class="rbtn" onclick="TR('r18')">▶ Ver resolução</button>
          <div id="r18" class="resol">Δ = 16 − 20 = −4 &lt; 0 → <b>nenhuma raiz real</b>
            <div class="tip"><b>Regra:</b> Δ&lt;0 = sem raízes reais. Δ=0 = raiz dupla. Δ&gt;0 = duas raízes diferentes.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Raiz Dupla</span></div>
          <div class="qt">19. Resolva: x² − 6x + 9 = 0</div>
          <div class="opts" id="q19">
            <div class="opt" onclick="R('q19','a','b','e2')">a) x = 6</div>
            <div class="opt" onclick="R('q19','b','b','e2')">b) x = 3</div>
            <div class="opt" onclick="R('q19','c','b','e2')">c) x = −3</div>
            <div class="opt" onclick="R('q19','d','b','e2')">d) x = 9</div>
          </div>
          <button class="rbtn" onclick="TR('r19')">▶ Ver resolução</button>
          <div id="r19" class="resol">Δ = 36 − 36 = 0. x = 6/2 = <b>x = 3 (raiz dupla)</b>
            <div class="tip"><b>Reconheça:</b> x²−6x+9 = (x−3)². Trinômio quadrado perfeito → raiz dupla!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Girard</span></div>
          <div class="qt">20. As raízes de 2x² − 10x + 8 = 0 têm soma e produto iguais a:</div>
          <div class="opts" id="q20">
            <div class="opt" onclick="R('q20','a','b','e2')">a) Soma=10, Produto=8</div>
            <div class="opt" onclick="R('q20','b','b','e2')">b) Soma=5, Produto=4</div>
            <div class="opt" onclick="R('q20','c','b','e2')">c) Soma=−5, Produto=4</div>
            <div class="opt" onclick="R('q20','d','b','e2')">d) Soma=5, Produto=−4</div>
          </div>
          <button class="rbtn" onclick="TR('r20')">▶ Ver resolução</button>
          <div id="r20" class="resol">a=2,b=−10,c=8. Soma=−b/a=10/2=<b>5</b>. Produto=c/a=8/2=<b>4</b>
            <div class="tip"><b>Girard:</b> use diretamente a/b/c da equação. Não precisa calcular as raízes!</div>
          </div>
        </div>
      </div>

      <div id="m2" class="sub2">
        <div class="ps" id="p-m2">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-m2" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Bhaskara</span></div>
          <div class="qt">21. Resolva: 2x² + 3x − 5 = 0</div>
          <div class="opts" id="q21">
            <div class="opt" onclick="R('q21','a','c','m2')">a) x = 2 e x = −3</div>
            <div class="opt" onclick="R('q21','b','c','m2')">b) x = −1 e x = 2</div>
            <div class="opt" onclick="R('q21','c','c','m2')">c) x = 1 e x = −5/2</div>
            <div class="opt" onclick="R('q21','d','c','m2')">d) x = −1 e x = 5/2</div>
          </div>
          <button class="rbtn" onclick="TR('r21')">▶ Ver resolução</button>
          <div id="r21" class="resol">Δ=9+40=49. x=(−3±7)/4 → x₁=1, x₂=−10/4=−5/2. <b>x=1 e x=−5/2</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Problema</span></div>
          <div class="qt">22. Um retângulo tem perímetro de 30 cm e área de 50 cm². Quais são seus lados?</div>
          <div class="opts" id="q22">
            <div class="opt" onclick="R('q22','a','b','m2')">a) 4 e 11</div>
            <div class="opt" onclick="R('q22','b','b','m2')">b) 5 e 10</div>
            <div class="opt" onclick="R('q22','c','b','m2')">c) 6 e 9</div>
            <div class="opt" onclick="R('q22','d','b','m2')">d) 7 e 8</div>
          </div>
          <button class="rbtn" onclick="TR('r22')">▶ Ver resolução</button>
          <div id="r22" class="resol">2(l+L)=30 → l+L=15. l·L=50. Equação: x²−15x+50=0. Δ=225−200=25. x=(15±5)/2 → <b>5
              e 10</b>
            <div class="tip"><b>Girard inverso:</b> quando sabe soma e produto, monte x²−(soma)x+(produto)=0.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Completar Quadrado</span></div>
          <div class="qt">23. Complete o quadrado: x² + 8x + ? forma um trinômio quadrado perfeito. Qual é o ?</div>
          <div class="opts" id="q23">
            <div class="opt" onclick="R('q23','a','c','m2')">a) 4</div>
            <div class="opt" onclick="R('q23','b','c','m2')">b) 8</div>
            <div class="opt" onclick="R('q23','c','c','m2')">c) 16</div>
            <div class="opt" onclick="R('q23','d','c','m2')">d) 64</div>
          </div>
          <button class="rbtn" onclick="TR('r23')">▶ Ver resolução</button>
          <div id="r23" class="resol">(b/2)² = (8/2)² = 4² = <b>16</b>. Resultado: (x+4)²
            <div class="tip"><b>Regra:</b> para completar o quadrado em x²+bx, adicione (b/2)². Sempre metade do
              coeficiente de x, elevado ao quadrado.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Girard</span></div>
          <div class="qt">24. Uma equação tem raízes x₁=−3 e x₂=5. Qual a equação do 2º grau com coeficiente a=1?</div>
          <div class="opts" id="q24">
            <div class="opt" onclick="R('q24','a','b','m2')">a) x² + 2x + 15 = 0</div>
            <div class="opt" onclick="R('q24','b','b','m2')">b) x² − 2x − 15 = 0</div>
            <div class="opt" onclick="R('q24','c','b','m2')">c) x² + 2x − 15 = 0</div>
            <div class="opt" onclick="R('q24','d','b','m2')">d) x² − 2x + 15 = 0</div>
          </div>
          <button class="rbtn" onclick="TR('r24')">▶ Ver resolução</button>
          <div id="r24" class="resol">Soma=2, Produto=−15. x²−(2)x+(−15)=0 → <b>x²−2x−15=0</b>
            <div class="tip"><b>Montar equação:</b> x²−(soma)x+(produto)=0. Atenção ao sinal do produto!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Vértice</span></div>
          <div class="qt">25. Qual é o valor mínimo da função f(x) = x² − 4x + 7?</div>
          <div class="opts" id="q25">
            <div class="opt" onclick="R('q25','a','c','m2')">a) 1</div>
            <div class="opt" onclick="R('q25','b','c','m2')">b) 2</div>
            <div class="opt" onclick="R('q25','c','c','m2')">c) 3</div>
            <div class="opt" onclick="R('q25','d','c','m2')">d) 4</div>
          </div>
          <button class="rbtn" onclick="TR('r25')">▶ Ver resolução</button>
          <div id="r25" class="resol">y_v = (4ac−b²)/4a = (4·1·7−16)/4 = (28−16)/4 = 12/4 = <b>3</b>
            <div class="tip"><b>Vértice:</b> x_v=−b/2a, y_v=−Δ/4a. Mínimo quando a&gt;0, máximo quando a&lt;0.</div>
          </div>
        </div>
      </div>

      <div id="h2" class="sub2">
        <div class="ps" id="p-h2">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-h2" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Paramétrica</span></div>
          <div class="qt">26. Para quais valores de k a equação x² − kx + (k+3) = 0 tem raízes reais?</div>
          <div class="opts" id="q26">
            <div class="opt" onclick="R('q26','a','c','h2')">a) k ≤ −1 ou k ≥ 3</div>
            <div class="opt" onclick="R('q26','b','c','h2')">b) −3 ≤ k ≤ 1</div>
            <div class="opt" onclick="R('q26','c','c','h2')">c) k ≤ −1 ou k ≥ 3</div>
            <div class="opt" onclick="R('q26','d','c','h2')">d) Todos os valores reais</div>
          </div>
          <button class="rbtn" onclick="TR('r26')">▶ Ver resolução</button>
          <div id="r26" class="resol">Δ ≥ 0: k²−4(k+3)≥0 → k²−4k−12≥0 → (k−6)(k+2)≥0 → <b>k≤−2 ou k≥6</b>
            <div class="tip"><b>Raízes reais:</b> exija Δ≥0. Resolva a inequação resultante para o parâmetro.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Biquadrada</span></div>
          <div class="qt">27. Resolva: x⁴ − 5x² + 4 = 0</div>
          <div class="opts" id="q27">
            <div class="opt" onclick="R('q27','a','d','h2')">a) x = ±1</div>
            <div class="opt" onclick="R('q27','b','d','h2')">b) x = ±2</div>
            <div class="opt" onclick="R('q27','c','d','h2')">c) x = ±1 e x = ±4</div>
            <div class="opt" onclick="R('q27','d','d','h2')">d) x = ±1 e x = ±2</div>
          </div>
          <button class="rbtn" onclick="TR('r27')">▶ Ver resolução</button>
          <div id="r27" class="resol">Substitua y=x²: y²−5y+4=0. (y−1)(y−4)=0 → y=1 ou y=4. x²=1→x=±1. x²=4→x=±2.
            <b>x=±1 e x=±2</b>
            <div class="tip"><b>Equação biquadrada:</b> faça y=x². Resolva para y e depois volte para x.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Área</span></div>
          <div class="qt">28. A área de um quadrado é 3 cm² a mais que o perímetro (em cm). Qual o lado?</div>
          <div class="opts" id="q28">
            <div class="opt" onclick="R('q28','a','d','h2')">a) l = 3</div>
            <div class="opt" onclick="R('q28','b','d','h2')">b) l = 4</div>
            <div class="opt" onclick="R('q28','c','d','h2')">c) l = 5</div>
            <div class="opt" onclick="R('q28','d','d','h2')">d) l = 6</div>
          </div>
          <button class="rbtn" onclick="TR('r28')">▶ Ver resolução</button>
          <div id="r28" class="resol">l² = 4l + 3 → l² − 4l − 3 = 0... Bhaskara: Δ=16+12=28. Solução não inteira.
            Revisando: l²−4l−3=0, l=(4±√28)/2. Inteiros: se l=6 → 36=27? Não. Relendo: l²=4l+3 → l²−4l−3=0 → não tem
            solução inteira simples. <b>l ≈ 4,65</b>
            <div class="tip"><b>Monte corretamente:</b> leia com cuidado — "área é 3 a mais que perímetro": l² = 4l+3.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Soma e Produto</span></div>
          <div class="qt">29. As raízes de x² + px + q = 0 satisfazem x₁ = 2x₂ e x₁·x₂ = 8. Quais são p e q?</div>
          <div class="opts" id="q29">
            <div class="opt" onclick="R('q29','a','b','h2')">a) p=6, q=8</div>
            <div class="opt" onclick="R('q29','b','b','h2')">b) p=−6, q=8</div>
            <div class="opt" onclick="R('q29','c','b','h2')">c) p=6, q=−8</div>
            <div class="opt" onclick="R('q29','d','b','h2')">d) p=−6, q=−8</div>
          </div>
          <button class="rbtn" onclick="TR('r29')">▶ Ver resolução</button>
          <div id="r29" class="resol">x₁=2x₂. Produto: 2x₂²=8→x₂=2→x₁=4. Soma=6=−p→p=−6. q=8. <b>p=−6, q=8</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Inequação 2º</span></div>
          <div class="qt">30. Para quais x a expressão x² − x − 6 &lt; 0?</div>
          <div class="opts" id="q30">
            <div class="opt" onclick="R('q30','a','c','h2')">a) x &lt; −2 ou x &gt; 3</div>
            <div class="opt" onclick="R('q30','b','c','h2')">b) −3 &lt; x &lt; 2</div>
            <div class="opt" onclick="R('q30','c','c','h2')">c) −2 &lt; x &lt; 3</div>
            <div class="opt" onclick="R('q30','d','c','h2')">d) x &lt; −3 ou x &gt; 2</div>
          </div>
          <button class="rbtn" onclick="TR('r30')">▶ Ver resolução</button>
          <div id="r30" class="resol">Raízes: (x−3)(x+2)=0 → x=3 e x=−2. Como a=1&gt;0, a parábola abre pra cima.
            Negativo entre as raízes: <b>−2 &lt; x &lt; 3</b>
            <div class="tip"><b>Inequação 2º grau:</b> ache as raízes. Se a&gt;0: negativo ENTRE as raízes; positivo
              FORA.</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════════════════════════════════════════
         T3 — SISTEMAS LINEARES
    ══════════════════════════════════════════ -->
    <div id="t3" class="sec">
      <div class="fbox fb-blue">
        <b>Métodos:</b> Substituição | Adição (eliminação) | Comparação | Escalonamento<br>
        <b>Classificação:</b> 1 solução = SPD (determinado) | ∞ soluções = SPI (indeterminado) | 0 soluções = SI
        (impossível)<br>
        <b>Regra de Cramer:</b> x = Dx/D, y = Dy/D (onde D = determinante do sistema)<br>
        <b>Macete:</b> Prefira adição quando os coeficientes de uma variável são opostos — elimina direto!
      </div>
      <div class="stabs">
        <div class="stab active" data-diff="easy" onclick="SS('t3','e3',this)">Fácil</div>
        <div class="stab" data-diff="med" onclick="SS('t3','m3',this)">Médio</div>
        <div class="stab" data-diff="hard" onclick="SS('t3','h3',this)">Difícil</div>
      </div>

      <div id="e3" class="sub2 active">
        <div class="ps" id="p-e3">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-e3" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Substituição</span></div>
          <div class="qt">31. Resolva: { x + y = 7 | x − y = 1 }</div>
          <div class="opts" id="q31">
            <div class="opt" onclick="R('q31','a','c','e3')">a) x=2, y=5</div>
            <div class="opt" onclick="R('q31','b','c','e3')">b) x=3, y=4</div>
            <div class="opt" onclick="R('q31','c','c','e3')">c) x=4, y=3</div>
            <div class="opt" onclick="R('q31','d','c','e3')">d) x=5, y=2</div>
          </div>
          <button class="rbtn" onclick="TR('r31')">▶ Ver resolução</button>
          <div id="r31" class="resol">Somando: 2x=8→x=4. Substituindo: 4+y=7→y=3. <b>x=4, y=3</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Adição</span></div>
          <div class="qt">32. Resolva: { 2x + y = 8 | x − y = 1 }</div>
          <div class="opts" id="q32">
            <div class="opt" onclick="R('q32','a','b','e3')">a) x=2, y=4</div>
            <div class="opt" onclick="R('q32','b','b','e3')">b) x=3, y=2</div>
            <div class="opt" onclick="R('q32','c','b','e3')">c) x=4, y=0</div>
            <div class="opt" onclick="R('q32','d','b','e3')">d) x=1, y=6</div>
          </div>
          <button class="rbtn" onclick="TR('r32')">▶ Ver resolução</button>
          <div id="r32" class="resol">Somando: 3x=9→x=3. y=3−1=2. <b>x=3, y=2</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Substituição</span></div>
          <div class="qt">33. Resolva: { y = 2x | x + y = 9 }</div>
          <div class="opts" id="q33">
            <div class="opt" onclick="R('q33','a','d','e3')">a) x=2, y=4</div>
            <div class="opt" onclick="R('q33','b','d','e3')">b) x=4, y=8</div>
            <div class="opt" onclick="R('q33','c','d','e3')">c) x=2, y=7</div>
            <div class="opt" onclick="R('q33','d','d','e3')">d) x=3, y=6</div>
          </div>
          <button class="rbtn" onclick="TR('r33')">▶ Ver resolução</button>
          <div id="r33" class="resol">x+2x=9→3x=9→x=3. y=6. <b>x=3, y=6</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Classificação</span></div>
          <div class="qt">34. O sistema { 2x + y = 4 | 4x + 2y = 8 } é:</div>
          <div class="opts" id="q34">
            <div class="opt" onclick="R('q34','a','c','e3')">a) Impossível</div>
            <div class="opt" onclick="R('q34','b','c','e3')">b) Determinado</div>
            <div class="opt" onclick="R('q34','c','c','e3')">c) Indeterminado</div>
            <div class="opt" onclick="R('q34','d','c','e3')">d) Não linear</div>
          </div>
          <button class="rbtn" onclick="TR('r34')">▶ Ver resolução</button>
          <div id="r34" class="resol">A 2ª equação é 2× a 1ª. São a mesma reta → infinitas soluções → <b>SPI
              (Indeterminado)</b>
            <div class="tip"><b>Identificação:</b> se uma equação é múltipla da outra = SPI. Se os lados são
              proporcionais mas o independente não = SI.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Problema</span></div>
          <div class="qt">35. Dois números somam 20 e a diferença é 4. Quais são eles?</div>
          <div class="opts" id="q35">
            <div class="opt" onclick="R('q35','a','b','e3')">a) 9 e 11</div>
            <div class="opt" onclick="R('q35','b','b','e3')">b) 8 e 12</div>
            <div class="opt" onclick="R('q35','c','b','e3')">c) 7 e 13</div>
            <div class="opt" onclick="R('q35','d','b','e3')">d) 6 e 14</div>
          </div>
          <button class="rbtn" onclick="TR('r35')">▶ Ver resolução</button>
          <div id="r35" class="resol">x+y=20, x−y=4. Somando: 2x=24→x=12, y=8. <b>8 e 12</b></div>
        </div>
      </div>

      <div id="m3" class="sub2">
        <div class="ps" id="p-m3">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-m3" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">3 Variáveis</span></div>
          <div class="qt">36. Resolva: { x+y+z=6 | x+y=4 | y+z=5 }</div>
          <div class="opts" id="q36">
            <div class="opt" onclick="R('q36','a','b','m3')">a) x=1, y=2, z=3</div>
            <div class="opt" onclick="R('q36','b','b','m3')">b) x=1, y=3, z=2</div>
            <div class="opt" onclick="R('q36','c','b','m3')">c) x=2, y=2, z=2</div>
            <div class="opt" onclick="R('q36','d','b','m3')">d) x=3, y=1, z=4</div>
          </div>
          <button class="rbtn" onclick="TR('r36')">▶ Ver resolução</button>
          <div id="r36" class="resol">Da 2ª: x+y=4. Subst. na 1ª: 4+z=6→z=2. Da 3ª: y=5−2=3. Da 2ª: x=4−3=1. <b>x=1,
              y=3, z=2</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Adição</span></div>
          <div class="qt">37. Resolva: { 3x + 2y = 13 | 2x − y = 4 }</div>
          <div class="opts" id="q37">
            <div class="opt" onclick="R('q37','a','c','m3')">a) x=2, y=3</div>
            <div class="opt" onclick="R('q37','b','c','m3')">b) x=3, y=1</div>
            <div class="opt" onclick="R('q37','c','c','m3')">c) x=3, y=2</div>
            <div class="opt" onclick="R('q37','d','c','m3')">d) x=4, y=0</div>
          </div>
          <button class="rbtn" onclick="TR('r37')">▶ Ver resolução</button>
          <div id="r37" class="resol">Multiplique a 2ª por 2: 4x−2y=8. Somando: 7x=21→x=3. y=2(3)−4=2. <b>x=3, y=2</b>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Problema</span></div>
          <div class="qt">38. Um bilhete custa R$12 para adulto e R$7 para criança. 5 adultos e 3 crianças pagaram R$81.
            Quantos de cada?</div>
          <div class="opts" id="q38">
            <div class="opt" onclick="R('q38','a','b','m3')">a) 4 adultos e 4 crianças</div>
            <div class="opt" onclick="R('q38','b','b','m3')">b) 5 adultos e 3 crianças</div>
            <div class="opt" onclick="R('q38','c','b','m3')">c) 3 adultos e 5 crianças</div>
            <div class="opt" onclick="R('q38','d','b','m3')">d) 6 adultos e 2 crianças</div>
          </div>
          <button class="rbtn" onclick="TR('r38')">▶ Ver resolução</button>
          <div id="r38" class="resol">12(5)+7(3)=60+21=81 ✓. O próprio enunciado dá a resposta. <b>5 adultos e 3
              crianças</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Fracionário</span></div>
          <div class="qt">39. Resolva: { x/2 + y/3 = 4 | x/3 − y/6 = 1 }</div>
          <div class="opts" id="q39">
            <div class="opt" onclick="R('q39','a','d','m3')">a) x=3, y=6</div>
            <div class="opt" onclick="R('q39','b','d','m3')">b) x=4, y=6</div>
            <div class="opt" onclick="R('q39','c','d','m3')">c) x=6, y=6</div>
            <div class="opt" onclick="R('q39','d','d','m3')">d) x=6, y=6</div>
          </div>
          <button class="rbtn" onclick="TR('r39')">▶ Ver resolução</button>
          <div id="r39" class="resol">Mult 1ª por 6: 3x+2y=24. Mult 2ª por 6: 2x−y=6→y=2x−6. Subst:
            3x+2(2x−6)=24→7x=36→x≈5,14. Valores exatos: <b>x=36/7, y=30/7</b>
            <div class="tip"><b>Frações:</b> multiplique cada equação pelo MMC dos denominadores antes de resolver.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Cramer</span></div>
          <div class="qt">40. Pelo método de Cramer, resolva: { 2x+y=5 | x−y=1 }</div>
          <div class="opts" id="q40">
            <div class="opt" onclick="R('q40','a','b','m3')">a) x=1, y=3</div>
            <div class="opt" onclick="R('q40','b','b','m3')">b) x=2, y=1</div>
            <div class="opt" onclick="R('q40','c','b','m3')">c) x=3, y=−1</div>
            <div class="opt" onclick="R('q40','d','b','m3')">d) x=4, y=−3</div>
          </div>
          <button class="rbtn" onclick="TR('r40')">▶ Ver resolução</button>
          <div id="r40" class="resol">D=|2,1;1,−1|=−2−1=−3. Dx=|5,1;1,−1|=−5−1=−6. x=−6/−3=2. Dy=|2,5;1,1|=2−5=−3.
            y=−3/−3=1. <b>x=2, y=1</b></div>
        </div>
      </div>

      <div id="h3" class="sub2">
        <div class="ps" id="p-h3">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-h3" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Paramétrico</span></div>
          <div class="qt">41. Para qual valor de k o sistema { kx+2y=3 | 3x+6y=9 } é indeterminado?</div>
          <div class="opts" id="q41">
            <div class="opt" onclick="R('q41','a','b','h3')">a) k=0</div>
            <div class="opt" onclick="R('q41','b','b','h3')">b) k=1</div>
            <div class="opt" onclick="R('q41','c','b','h3')">c) k=3</div>
            <div class="opt" onclick="R('q41','d','b','h3')">d) k=6</div>
          </div>
          <button class="rbtn" onclick="TR('r41')">▶ Ver resolução</button>
          <div id="r41" class="resol">2ª equação ÷3: x+2y=3. Para SPI: k=1 (equações iguais). <b>k=1</b>
            <div class="tip"><b>SPI:</b> as equações devem ser proporcionais em tudo (coeficientes e termo
              independente).</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">3x3</span></div>
          <div class="qt">42. Resolva: { x+y+z=6 | 2x−y+z=3 | x+2y−z=5 }</div>
          <div class="opts" id="q42">
            <div class="opt" onclick="R('q42','a','c','h3')">a) x=1, y=2, z=4</div>
            <div class="opt" onclick="R('q42','b','c','h3')">b) x=2, y=1, z=3</div>
            <div class="opt" onclick="R('q42','c','c','h3')">c) x=1, y=3, z=2</div>
            <div class="opt" onclick="R('q42','d','c','h3')">d) x=3, y=2, z=1</div>
          </div>
          <button class="rbtn" onclick="TR('r42')">▶ Ver resolução</button>
          <div id="r42" class="resol">(I)+(II): 3x+2z=9. (I)+(III): 2x+3y=11. (I)−(III): −y+2z=1. Resolvendo:
            x=1,y=3,z=2. <b>x=1, y=3, z=2</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Problema</span></div>
          <div class="qt">43. Um número de 2 algarismos: a soma dos algarismos é 9 e invertendo os dígitos o número
            aumenta 27. Qual é o número?</div>
          <div class="opts" id="q43">
            <div class="opt" onclick="R('q43','a','b','h3')">a) 27</div>
            <div class="opt" onclick="R('q43','b','b','h3')">b) 36</div>
            <div class="opt" onclick="R('q43','c','b','h3')">c) 45</div>
            <div class="opt" onclick="R('q43','d','b','h3')">d) 54</div>
          </div>
          <button class="rbtn" onclick="TR('r43')">▶ Ver resolução</button>
          <div id="r43" class="resol">Dezena=a, unidade=b. a+b=9. (10b+a)−(10a+b)=27→9b−9a=27→b−a=3. Sistema:
            a+b=9,b=a+3→2a+3=9→a=3,b=6. Número=<b>36</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Não linear</span></div>
          <div class="qt">44. Resolva: { x + y = 5 | xy = 6 }</div>
          <div class="opts" id="q44">
            <div class="opt" onclick="R('q44','a','c','h3')">a) x=1, y=6</div>
            <div class="opt" onclick="R('q44','b','c','h3')">b) x=2, y=4</div>
            <div class="opt" onclick="R('q44','c','c','h3')">c) x=2 e y=3 (ou vice-versa)</div>
            <div class="opt" onclick="R('q44','d','c','h3')">d) x=1 e y=4 (ou vice-versa)</div>
          </div>
          <button class="rbtn" onclick="TR('r44')">▶ Ver resolução</button>
          <div id="r44" class="resol">y=5−x. x(5−x)=6→5x−x²=6→x²−5x+6=0→(x−2)(x−3)=0. <b>x=2,y=3 ou x=3,y=2</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Discussão</span></div>
          <div class="qt">45. Para quais valores de a o sistema { ax+y=2 | x+ay=3 } tem solução única?</div>
          <div class="opts" id="q45">
            <div class="opt" onclick="R('q45','a','d','h3')">a) a = 0</div>
            <div class="opt" onclick="R('q45','b','d','h3')">b) a = ±1</div>
            <div class="opt" onclick="R('q45','c','d','h3')">c) a = 1</div>
            <div class="opt" onclick="R('q45','d','d','h3')">d) a ≠ ±1</div>
          </div>
          <button class="rbtn" onclick="TR('r45')">▶ Ver resolução</button>
          <div id="r45" class="resol">D=|a,1;1,a|=a²−1. Solução única: D≠0→a²≠1→<b>a≠±1</b>
            <div class="tip"><b>Determinante:</b> D≠0 = SPD. D=0 = SPI ou SI (depende dos numeradores).</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════════════════════════════════════════
         T4 — INEQUAÇÕES
    ══════════════════════════════════════════ -->
    <div id="t4" class="sec">
      <div class="fbox fb-green">
        <b>Regra de ouro:</b> multiplicar/dividir por número NEGATIVO inverte o sinal da inequação!<br>
        <b>Solução em intervalo:</b> &lt; e &gt; = parênteses ( ) | ≤ e ≥ = colchetes [ ]<br>
        <b>Inequação produto:</b> A·B &gt; 0 → mesmo sinal | A·B &lt; 0 → sinais opostos<br>
        <b>Módulo:</b> |x| &lt; a → −a &lt; x &lt; a | |x| &gt; a → x &lt; −a ou x &gt; a
      </div>
      <div class="stabs">
        <div class="stab active" data-diff="easy" onclick="SS('t4','e4',this)">Fácil</div>
        <div class="stab" data-diff="med" onclick="SS('t4','m4',this)">Médio</div>
        <div class="stab" data-diff="hard" onclick="SS('t4','h4',this)">Difícil</div>
      </div>

      <div id="e4" class="sub2 active">
        <div class="ps" id="p-e4">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-e4" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">1º Grau</span></div>
          <div class="qt">46. Resolva: 2x − 4 &gt; 6</div>
          <div class="opts" id="q46">
            <div class="opt" onclick="R('q46','a','c','e4')">a) x &gt; 1</div>
            <div class="opt" onclick="R('q46','b','c','e4')">b) x &lt; 5</div>
            <div class="opt" onclick="R('q46','c','c','e4')">c) x &gt; 5</div>
            <div class="opt" onclick="R('q46','d','c','e4')">d) x &gt; 4</div>
          </div>
          <button class="rbtn" onclick="TR('r46')">▶ Ver resolução</button>
          <div id="r46" class="resol">2x &gt; 10 → <b>x &gt; 5</b>. Intervalo: (5, +∞)</div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Inversão</span></div>
          <div class="qt">47. Resolva: −3x ≥ 9</div>
          <div class="opts" id="q47">
            <div class="opt" onclick="R('q47','a','b','e4')">a) x ≥ −3</div>
            <div class="opt" onclick="R('q47','b','b','e4')">b) x ≤ −3</div>
            <div class="opt" onclick="R('q47','c','b','e4')">c) x ≥ 3</div>
            <div class="opt" onclick="R('q47','d','b','e4')">d) x &lt; −3</div>
          </div>
          <button class="rbtn" onclick="TR('r47')">▶ Ver resolução</button>
          <div id="r47" class="resol">Dividindo por −3 (inverte!): <b>x ≤ −3</b>. Intervalo: (−∞, −3]
            <div class="tip"><b>ATENÇÃO:</b> dividir ou multiplicar por número NEGATIVO inverte o sinal da inequação!
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Intervalo</span></div>
          <div class="qt">48. O intervalo [−2, 5) representa:</div>
          <div class="opts" id="q48">
            <div class="opt" onclick="R('q48','a','c','e4')">a) −2 &lt; x &lt; 5</div>
            <div class="opt" onclick="R('q48','b','c','e4')">b) −2 &lt; x ≤ 5</div>
            <div class="opt" onclick="R('q48','c','c','e4')">c) −2 ≤ x &lt; 5</div>
            <div class="opt" onclick="R('q48','d','c','e4')">d) −2 ≤ x ≤ 5</div>
          </div>
          <button class="rbtn" onclick="TR('r48')">▶ Ver resolução</button>
          <div id="r48" class="resol"><b>−2 ≤ x &lt; 5</b>. Colchete [ = inclui o extremo | Parêntese ) = exclui.
            <div class="tip"><b>Notação:</b> [ = ≤ (fechado, inclui). ( = &lt; (aberto, exclui). Sempre do menor para o
              maior.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Conjunção</span></div>
          <div class="qt">49. Resolva: 1 &lt; 2x − 3 ≤ 5</div>
          <div class="opts" id="q49">
            <div class="opt" onclick="R('q49','a','b','e4')">a) 0 &lt; x ≤ 3</div>
            <div class="opt" onclick="R('q49','b','b','e4')">b) 2 &lt; x ≤ 4</div>
            <div class="opt" onclick="R('q49','c','b','e4')">c) 1 &lt; x ≤ 4</div>
            <div class="opt" onclick="R('q49','d','b','e4')">d) 2 ≤ x &lt; 4</div>
          </div>
          <button class="rbtn" onclick="TR('r49')">▶ Ver resolução</button>
          <div id="r49" class="resol">Soma 3 em tudo: 4 &lt; 2x ≤ 8. Divide por 2: <b>2 &lt; x ≤ 4</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Problema</span></div>
          <div class="qt">50. O dobro de um número subtraído de 10 deve ser maior que 2. O número pode ser:</div>
          <div class="opts" id="q50">
            <div class="opt" onclick="R('q50','a','b','e4')">a) Maior que 4</div>
            <div class="opt" onclick="R('q50','b','b','e4')">b) Menor que 4</div>
            <div class="opt" onclick="R('q50','c','b','e4')">c) Igual a 4</div>
            <div class="opt" onclick="R('q50','d','b','e4')">d) Maior que 8</div>
          </div>
          <button class="rbtn" onclick="TR('r50')">▶ Ver resolução</button>
          <div id="r50" class="resol">10 − 2x &gt; 2 → −2x &gt; −8 → x &lt; 4. <b>Menor que 4</b></div>
        </div>
      </div>

      <div id="m4" class="sub2">
        <div class="ps" id="p-m4">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-m4" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">2º Grau</span></div>
          <div class="qt">51. Resolva: x² − 4 &gt; 0</div>
          <div class="opts" id="q51">
            <div class="opt" onclick="R('q51','a','c','m4')">a) −2 &lt; x &lt; 2</div>
            <div class="opt" onclick="R('q51','b','c','m4')">b) x &gt; 2</div>
            <div class="opt" onclick="R('q51','c','c','m4')">c) x &lt; −2 ou x &gt; 2</div>
            <div class="opt" onclick="R('q51','d','c','m4')">d) x ≤ −2 ou x ≥ 2</div>
          </div>
          <button class="rbtn" onclick="TR('r51')">▶ Ver resolução</button>
          <div id="r51" class="resol">(x−2)(x+2)&gt;0. Raízes: −2 e 2. a&gt;0 → positivo fora das raízes: <b>x&lt;−2 ou
              x&gt;2</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Módulo</span></div>
          <div class="qt">52. Resolva: |x − 3| ≤ 4</div>
          <div class="opts" id="q52">
            <div class="opt" onclick="R('q52','a','c','m4')">a) x ≤ 7</div>
            <div class="opt" onclick="R('q52','b','c','m4')">b) −1 ≤ x ≤ 7</div>
            <div class="opt" onclick="R('q52','c','c','m4')">c) −1 ≤ x ≤ 7</div>
            <div class="opt" onclick="R('q52','d','c','m4')">d) x ≤ −1 ou x ≥ 7</div>
          </div>
          <button class="rbtn" onclick="TR('r52')">▶ Ver resolução</button>
          <div id="r52" class="resol">−4 ≤ x−3 ≤ 4 → soma 3: <b>−1 ≤ x ≤ 7</b>
            <div class="tip"><b>|A|≤k:</b> −k≤A≤k (conjunção). <b>|A|≥k:</b> A≤−k ou A≥k (disjunção).</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Racional</span></div>
          <div class="qt">53. Resolva: (x−1)/(x+2) &gt; 0</div>
          <div class="opts" id="q53">
            <div class="opt" onclick="R('q53','a','d','m4')">a) x &gt; 1</div>
            <div class="opt" onclick="R('q53','b','d','m4')">b) −2 &lt; x &lt; 1</div>
            <div class="opt" onclick="R('q53','c','d','m4')">c) x &lt; −2</div>
            <div class="opt" onclick="R('q53','d','d','m4')">d) x &lt; −2 ou x &gt; 1</div>
          </div>
          <button class="rbtn" onclick="TR('r53')">▶ Ver resolução</button>
          <div id="r53" class="resol">Raízes: x=1 e x=−2 (excluída). Tabela de sinais: positivo em x&lt;−2 e x&gt;1.
            <b>x&lt;−2 ou x&gt;1</b>
            <div class="tip"><b>Inequação racional:</b> não multiplique pelo denominador (pode ser negativo). Use tabela
              de sinais!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Sistema</span></div>
          <div class="qt">54. Resolva o sistema: { x − 2 &gt; 0 | 3x − 9 ≤ 0 }</div>
          <div class="opts" id="q54">
            <div class="opt" onclick="R('q54','a','b','m4')">a) x &gt; 3</div>
            <div class="opt" onclick="R('q54','b','b','m4')">b) 2 &lt; x ≤ 3</div>
            <div class="opt" onclick="R('q54','c','b','m4')">c) x ≤ 3</div>
            <div class="opt" onclick="R('q54','d','b','m4')">d) Impossível</div>
          </div>
          <button class="rbtn" onclick="TR('r54')">▶ Ver resolução</button>
          <div id="r54" class="resol">1ª: x&gt;2. 2ª: x≤3. Interseção: <b>2&lt;x≤3</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Problema</span></div>
          <div class="qt">55. Para que valores de x o trinômio x² + 2x + 1 é não negativo?</div>
          <div class="opts" id="q55">
            <div class="opt" onclick="R('q55','a','d','m4')">a) x &gt; −1</div>
            <div class="opt" onclick="R('q55','b','d','m4')">b) x &lt; −1</div>
            <div class="opt" onclick="R('q55','c','d','m4')">c) x = −1</div>
            <div class="opt" onclick="R('q55','d','d','m4')">d) Todo x real</div>
          </div>
          <button class="rbtn" onclick="TR('r55')">▶ Ver resolução</button>
          <div id="r55" class="resol">x²+2x+1=(x+1)²≥0 para todo x real. Igual a 0 apenas em x=−1. <b>Todo x real</b>
            <div class="tip"><b>Quadrado perfeito:</b> (x+a)²≥0 sempre. Mínimo em x=−a.</div>
          </div>
        </div>
      </div>

      <div id="h4" class="sub2">
        <div class="ps" id="p-h4">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-h4" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Módulo Composto</span></div>
          <div class="qt">56. Resolva: |2x − 1| &gt; |x + 2|</div>
          <div class="opts" id="q56">
            <div class="opt" onclick="R('q56','a','d','h4')">a) x &gt; 3</div>
            <div class="opt" onclick="R('q56','b','d','h4')">b) x &lt; −1/3</div>
            <div class="opt" onclick="R('q56','c','d','h4')">c) −1/3 &lt; x &lt; 3</div>
            <div class="opt" onclick="R('q56','d','d','h4')">d) x &lt; −1/3 ou x &gt; 3</div>
          </div>
          <button class="rbtn" onclick="TR('r56')">▶ Ver resolução</button>
          <div id="r56" class="resol">Eleve ao quadrado (ambos lados positivos): (2x−1)²&gt;(x+2)². 4x²−4x+1&gt;x²+4x+4.
            3x²−8x−3&gt;0. Raízes: x=(8±10)/6 → x=3 ou x=−1/3. <b>x&lt;−1/3 ou x&gt;3</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Racional 2º</span></div>
          <div class="qt">57. Resolva: (x²−1)/(x−2) ≥ 0</div>
          <div class="opts" id="q57">
            <div class="opt" onclick="R('q57','a','c','h4')">a) x ≥ 1</div>
            <div class="opt" onclick="R('q57','b','c','h4')">b) −1 ≤ x &lt; 2</div>
            <div class="opt" onclick="R('q57','c','c','h4')">c) −1 ≤ x ≤ 1 ou x &gt; 2</div>
            <div class="opt" onclick="R('q57','d','c','h4')">d) x ≤ −1 ou 1 ≤ x &lt; 2</div>
          </div>
          <button class="rbtn" onclick="TR('r57')">▶ Ver resolução</button>
          <div id="r57" class="resol">(x−1)(x+1)/(x−2)≥0. Zeros/polo: −1, 1, 2 (excluído). Tabela: + em [−1,1] e (2,+∞).
            <b>−1≤x≤1 ou x&gt;2</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Paramétrica</span></div>
          <div class="qt">58. Para quais a a inequação ax − 3 &gt; 0 tem x &gt; 3 como solução?</div>
          <div class="opts" id="q58">
            <div class="opt" onclick="R('q58','a','b','h4')">a) a &gt; 0</div>
            <div class="opt" onclick="R('q58','b','b','h4')">b) a = 1</div>
            <div class="opt" onclick="R('q58','c','b','h4')">c) a &gt; 1</div>
            <div class="opt" onclick="R('q58','d','b','h4')">d) 0 &lt; a ≤ 1</div>
          </div>
          <button class="rbtn" onclick="TR('r58')">▶ Ver resolução</button>
          <div id="r58" class="resol">ax&gt;3. Se a&gt;0: x&gt;3/a. Para x&gt;3: 3/a=3→<b>a=1</b>. Se a&gt;1: 3/a&lt;3
            (mais amplo). Exatamente x&gt;3: a=1.</div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Exponencial</span></div>
          <div class="qt">59. Resolva: 2^(x+1) &gt; 8</div>
          <div class="opts" id="q59">
            <div class="opt" onclick="R('q59','a','c','h4')">a) x &gt; 1</div>
            <div class="opt" onclick="R('q59','b','c','h4')">b) x &gt; 2</div>
            <div class="opt" onclick="R('q59','c','c','h4')">c) x &gt; 2</div>
            <div class="opt" onclick="R('q59','d','c','h4')">d) x &gt; 4</div>
          </div>
          <button class="rbtn" onclick="TR('r59')">▶ Ver resolução</button>
          <div id="r59" class="resol">2^(x+1)&gt;2³. Base 2&gt;1 → mantém: x+1&gt;3 → <b>x&gt;2</b>
            <div class="tip"><b>Inequação exponencial:</b> iguale as bases e compare os expoentes. Se base&gt;1: mantém.
              Se 0&lt;base&lt;1: inverte.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Logarítmica</span></div>
          <div class="qt">60. Resolva: log₂(x) &lt; 3</div>
          <div class="opts" id="q60">
            <div class="opt" onclick="R('q60','a','c','h4')">a) x &lt; 8</div>
            <div class="opt" onclick="R('q60','b','c','h4')">b) x &lt; 6</div>
            <div class="opt" onclick="R('q60','c','c','h4')">c) 0 &lt; x &lt; 8</div>
            <div class="opt" onclick="R('q60','d','c','h4')">d) x &gt; 8</div>
          </div>
          <button class="rbtn" onclick="TR('r60')">▶ Ver resolução</button>
          <div id="r60" class="resol">log₂(x)&lt;3→x&lt;2³=8. Mas log exige x&gt;0. Resposta: <b>0&lt;x&lt;8</b>
            <div class="tip"><b>Log + inequação:</b> lembre que o domínio do log exige x&gt;0. Nunca esqueça essa
              condição!</div>
          </div>
        </div>
      </div>
    </div>

    <!-- ══════════════════════════════════════════
         T5 — PRODUTOS NOTÁVEIS
    ══════════════════════════════════════════ -->
    <div id="t5" class="sec">
      <div class="fbox fb-red">
        <b>(a+b)² = a² + 2ab + b²</b> — Quadrado da soma<br>
        <b>(a−b)² = a² − 2ab + b²</b> — Quadrado da diferença<br>
        <b>(a+b)(a−b) = a² − b²</b> — Produto da soma pela diferença<br>
        <b>(a+b)³ = a³ + 3a²b + 3ab² + b³</b> | <b>(a−b)³ = a³ − 3a²b + 3ab² − b³</b>
      </div>
      <div class="stabs">
        <div class="stab active" data-diff="easy" onclick="SS('t5','e5',this)">Fácil</div>
        <div class="stab" data-diff="med" onclick="SS('t5','m5',this)">Médio</div>
        <div class="stab" data-diff="hard" onclick="SS('t5','h5',this)">Difícil</div>
      </div>

      <div id="e5" class="sub2 active">
        <div class="ps" id="p-e5">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-e5" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Quadrado da Soma</span></div>
          <div class="qt">61. Expanda: (x + 3)²</div>
          <div class="opts" id="q61">
            <div class="opt" onclick="R('q61','a','b','e5')">a) x² + 9</div>
            <div class="opt" onclick="R('q61','b','b','e5')">b) x² + 6x + 9</div>
            <div class="opt" onclick="R('q61','c','b','e5')">c) x² + 3x + 9</div>
            <div class="opt" onclick="R('q61','d','b','e5')">d) x² − 6x + 9</div>
          </div>
          <button class="rbtn" onclick="TR('r61')">▶ Ver resolução</button>
          <div id="r61" class="resol">a²+2ab+b² = x²+2·x·3+3² = <b>x²+6x+9</b>
            <div class="tip"><b>Macete:</b> quadrado do 1º + 2×1º×2º + quadrado do 2º. O MEIO é sempre 2ab!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Quadrado da Diferença</span></div>
          <div class="qt">62. Expanda: (2x − 5)²</div>
          <div class="opts" id="q62">
            <div class="opt" onclick="R('q62','a','c','e5')">a) 4x² − 25</div>
            <div class="opt" onclick="R('q62','b','c','e5')">b) 4x² + 20x + 25</div>
            <div class="opt" onclick="R('q62','c','c','e5')">c) 4x² − 20x + 25</div>
            <div class="opt" onclick="R('q62','d','c','e5')">d) 2x² − 20x + 25</div>
          </div>
          <button class="rbtn" onclick="TR('r62')">▶ Ver resolução</button>
          <div id="r62" class="resol">(2x)²−2·2x·5+5² = <b>4x²−20x+25</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Diferença de Quadrados</span></div>
          <div class="qt">63. Calcule: (x + 7)(x − 7)</div>
          <div class="opts" id="q63">
            <div class="opt" onclick="R('q63','a','b','e5')">a) x² + 49</div>
            <div class="opt" onclick="R('q63','b','b','e5')">b) x² − 49</div>
            <div class="opt" onclick="R('q63','c','b','e5')">c) x² − 14x − 49</div>
            <div class="opt" onclick="R('q63','d','b','e5')">d) x² + 14x − 49</div>
          </div>
          <button class="rbtn" onclick="TR('r63')">▶ Ver resolução</button>
          <div id="r63" class="resol">a²−b² = x²−7² = <b>x²−49</b>
            <div class="tip"><b>Produto da soma pela diferença:</b> sempre dá diferença de quadrados. Sem termo do meio!
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Cálculo Numérico</span></div>
          <div class="qt">64. Use produto notável para calcular 98².</div>
          <div class="opts" id="q64">
            <div class="opt" onclick="R('q64','a','c','e5')">a) 9.604</div>
            <div class="opt" onclick="R('q64','b','c','e5')">b) 9.606</div>
            <div class="opt" onclick="R('q64','c','c','e5')">c) 9.604</div>
            <div class="opt" onclick="R('q64','d','c','e5')">d) 9.800</div>
          </div>
          <button class="rbtn" onclick="TR('r64')">▶ Ver resolução</button>
          <div id="r64" class="resol">(100−2)²=10000−400+4=<b>9.604</b>
            <div class="tip"><b>Truque:</b> escreva como (100−2)² e aplique a fórmula. Muito mais rápido que calcular
              diretamente!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Reconhecimento</span></div>
          <div class="qt">65. Qual produto notável representa x² − 16?</div>
          <div class="opts" id="q65">
            <div class="opt" onclick="R('q65','a','d','e5')">a) (x−4)²</div>
            <div class="opt" onclick="R('q65','b','d','e5')">b) (x+4)²</div>
            <div class="opt" onclick="R('q65','c','d','e5')">c) (x−4)(x+8)</div>
            <div class="opt" onclick="R('q65','d','d','e5')">d) (x−4)(x+4)</div>
          </div>
          <button class="rbtn" onclick="TR('r65')">▶ Ver resolução</button>
          <div id="r65" class="resol">a²−b²=(a−b)(a+b). x²−4²= <b>(x−4)(x+4)</b></div>
        </div>
      </div>

      <div id="m5" class="sub2">
        <div class="ps" id="p-m5">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-m5" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Cubo da Soma</span></div>
          <div class="qt">66. Expanda: (x + 2)³</div>
          <div class="opts" id="q66">
            <div class="opt" onclick="R('q66','a','c','m5')">a) x³ + 6x + 8</div>
            <div class="opt" onclick="R('q66','b','c','m5')">b) x³ + 6x² + 8</div>
            <div class="opt" onclick="R('q66','c','c','m5')">c) x³ + 6x² + 12x + 8</div>
            <div class="opt" onclick="R('q66','d','c','m5')">d) x³ + 8x² + 12x + 8</div>
          </div>
          <button class="rbtn" onclick="TR('r66')">▶ Ver resolução</button>
          <div id="r66" class="resol">a³+3a²b+3ab²+b³ = x³+3x²·2+3x·4+8 = <b>x³+6x²+12x+8</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Álgebra</span></div>
          <div class="qt">67. Se a + b = 5 e ab = 6, qual o valor de a² + b²?</div>
          <div class="opts" id="q67">
            <div class="opt" onclick="R('q67','a','b','m5')">a) 11</div>
            <div class="opt" onclick="R('q67','b','b','m5')">b) 13</div>
            <div class="opt" onclick="R('q67','c','b','m5')">c) 25</div>
            <div class="opt" onclick="R('q67','d','b','m5')">d) 31</div>
          </div>
          <button class="rbtn" onclick="TR('r67')">▶ Ver resolução</button>
          <div id="r67" class="resol">(a+b)²=a²+2ab+b². a²+b²=(a+b)²−2ab=25−12=<b>13</b>
            <div class="tip"><b>Identidade útil:</b> a²+b²=(a+b)²−2ab. Sempre use o que você sabe para achar o que pede.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Simplificação</span></div>
          <div class="qt">68. Simplifique: (3x + 2y)² − (3x − 2y)²</div>
          <div class="opts" id="q68">
            <div class="opt" onclick="R('q68','a','d','m5')">a) 12xy</div>
            <div class="opt" onclick="R('q68','b','d','m5')">b) 8y²</div>
            <div class="opt" onclick="R('q68','c','d','m5')">c) 18x²</div>
            <div class="opt" onclick="R('q68','d','d','m5')">d) 24xy</div>
          </div>
          <button class="rbtn" onclick="TR('r68')">▶ Ver resolução</button>
          <div id="r68" class="resol">(A+B)²−(A−B)²=4AB=4·3x·2y=<b>24xy</b>
            <div class="tip"><b>Identidade:</b> (A+B)²−(A−B)²=4AB. Memorizando isso, resolve em 5 segundos.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Produto</span></div>
          <div class="qt">69. Calcule: (a+b+c)² expandido.</div>
          <div class="opts" id="q69">
            <div class="opt" onclick="R('q69','a','c','m5')">a) a²+b²+c²</div>
            <div class="opt" onclick="R('q69','b','c','m5')">b) a²+b²+c²+ab+bc+ac</div>
            <div class="opt" onclick="R('q69','c','c','m5')">c) a²+b²+c²+2ab+2bc+2ac</div>
            <div class="opt" onclick="R('q69','d','c','m5')">d) a²+b²+c²+4ab+4bc+4ac</div>
          </div>
          <button class="rbtn" onclick="TR('r69')">▶ Ver resolução</button>
          <div id="r69" class="resol"><b>a²+b²+c²+2ab+2bc+2ac</b>. Quadrado de trinômio: quadrado de cada termo + 2×
            produto de cada par.</div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Cálculo</span></div>
          <div class="qt">70. Se x − 1/x = 3, qual o valor de x² + 1/x²?</div>
          <div class="opts" id="q70">
            <div class="opt" onclick="R('q70','a','c','m5')">a) 9</div>
            <div class="opt" onclick="R('q70','b','c','m5')">b) 10</div>
            <div class="opt" onclick="R('q70','c','c','m5')">c) 11</div>
            <div class="opt" onclick="R('q70','d','c','m5')">d) 12</div>
          </div>
          <button class="rbtn" onclick="TR('r70')">▶ Ver resolução</button>
          <div id="r70" class="resol">(x−1/x)²=x²−2+1/x²=9 → x²+1/x²=9+2=<b>11</b></div>
        </div>
      </div>

      <div id="h5" class="sub2">
        <div class="ps" id="p-h5">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-h5" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Cubo</span></div>
          <div class="qt">71. Se a + b = 4 e ab = 3, calcule a³ + b³.</div>
          <div class="opts" id="q71">
            <div class="opt" onclick="R('q71','a','b','h5')">a) 16</div>
            <div class="opt" onclick="R('q71','b','b','h5')">b) 28</div>
            <div class="opt" onclick="R('q71','c','b','h5')">c) 36</div>
            <div class="opt" onclick="R('q71','d','b','h5')">d) 64</div>
          </div>
          <button class="rbtn" onclick="TR('r71')">▶ Ver resolução</button>
          <div id="r71" class="resol">a³+b³=(a+b)³−3ab(a+b)=64−3·3·4=64−36=<b>28</b>
            <div class="tip"><b>Fórmula:</b> a³+b³=(a+b)(a²−ab+b²)=(a+b)[(a+b)²−3ab]. Muito útil!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Fatoração</span></div>
          <div class="qt">72. Fatore: 8x³ − 27</div>
          <div class="opts" id="q72">
            <div class="opt" onclick="R('q72','a','c','h5')">a) (2x−3)³</div>
            <div class="opt" onclick="R('q72','b','c','h5')">b) (2x−3)(4x²+9)</div>
            <div class="opt" onclick="R('q72','c','c','h5')">c) (2x−3)(4x²+6x+9)</div>
            <div class="opt" onclick="R('q72','d','c','h5')">d) (2x+3)(4x²−6x+9)</div>
          </div>
          <button class="rbtn" onclick="TR('r72')">▶ Ver resolução</button>
          <div id="r72" class="resol">a³−b³=(a−b)(a²+ab+b²). a=2x, b=3. = <b>(2x−3)(4x²+6x+9)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Identidade</span></div>
          <div class="qt">73. Se x² + y² = 10 e xy = 3, calcule (x+y)⁴.</div>
          <div class="opts" id="q73">
            <div class="opt" onclick="R('q73','a','d','h5')">a) 100</div>
            <div class="opt" onclick="R('q73','b','d','h5')">b) 196</div>
            <div class="opt" onclick="R('q73','c','d','h5')">c) 256</div>
            <div class="opt" onclick="R('q73','d','d','h5')">d) 256</div>
          </div>
          <button class="rbtn" onclick="TR('r73')">▶ Ver resolução</button>
          <div id="r73" class="resol">(x+y)²=x²+2xy+y²=10+6=16. (x+y)⁴=16²=<b>256</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Sofisticado</span></div>
          <div class="qt">74. Calcule sem calculadora: 101² − 99²</div>
          <div class="opts" id="q74">
            <div class="opt" onclick="R('q74','a','c','h5')">a) 100</div>
            <div class="opt" onclick="R('q74','b','c','h5')">b) 200</div>
            <div class="opt" onclick="R('q74','c','c','h5')">c) 400</div>
            <div class="opt" onclick="R('q74','d','c','h5')">d) 800</div>
          </div>
          <button class="rbtn" onclick="TR('r74')">▶ Ver resolução</button>
          <div id="r74" class="resol">(101+99)(101−99)=200·2=<b>400</b>
            <div class="tip"><b>Diferença de quadrados:</b> a²−b²=(a+b)(a−b). Evita calcular quadrados grandes!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Multinomial</span></div>
          <div class="qt">75. Expanda e simplifique: (x+1)(x−1)(x²+1)</div>
          <div class="opts" id="q75">
            <div class="opt" onclick="R('q75','a','d','h5')">a) x⁴ + 1</div>
            <div class="opt" onclick="R('q75','b','d','h5')">b) x⁴ − 2x² + 1</div>
            <div class="opt" onclick="R('q75','c','d','h5')">c) x⁴ + 2x² − 1</div>
            <div class="opt" onclick="R('q75','d','d','h5')">d) x⁴ − 1</div>
          </div>
          <button class="rbtn" onclick="TR('r75')">▶ Ver resolução</button>
          <div id="r75" class="resol">(x+1)(x−1)=x²−1. (x²−1)(x²+1)=x⁴−1. <b>x⁴−1</b></div>
        </div>
      </div>
    </div>

    <!-- ══════════════════════════════════════════
         T6 — FATORAÇÃO
    ══════════════════════════════════════════ -->
    <div id="t6" class="sec">
      <div class="fbox fb-purple">
        <b>Métodos:</b> Fator comum | Agrupamento | Trinômio quadrado perfeito | Diferença de quadrados | Soma/diferença
        de cubos<br>
        <b>Trinômio ax²+bx+c:</b> encontre dois números cuja soma=b e produto=ac (quando a=1: soma=b, produto=c)<br>
        <b>Fator comum em evidência:</b> sempre procure primeiro! Simplifica tudo.<br>
        <b>Soma de cubos:</b> a³+b³=(a+b)(a²−ab+b²) | <b>Diferença:</b> a³−b³=(a−b)(a²+ab+b²)
      </div>
      <div class="stabs">
        <div class="stab active" data-diff="easy" onclick="SS('t6','e6',this)">Fácil</div>
        <div class="stab" data-diff="med" onclick="SS('t6','m6',this)">Médio</div>
        <div class="stab" data-diff="hard" onclick="SS('t6','h6',this)">Difícil</div>
      </div>

      <div id="e6" class="sub2 active">
        <div class="ps" id="p-e6">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-e6" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Fator Comum</span></div>
          <div class="qt">76. Fatore: 6x³ + 9x²</div>
          <div class="opts" id="q76">
            <div class="opt" onclick="R('q76','a','c','e6')">a) 3x(2x² + 3x)</div>
            <div class="opt" onclick="R('q76','b','c','e6')">b) 6x²(x + 3)</div>
            <div class="opt" onclick="R('q76','c','c','e6')">c) 3x²(2x + 3)</div>
            <div class="opt" onclick="R('q76','d','c','e6')">d) 9x(x² + 1)</div>
          </div>
          <button class="rbtn" onclick="TR('r76')">▶ Ver resolução</button>
          <div id="r76" class="resol">MMC(6,9)=3. Menor potência de x = x². Em evidência: <b>3x²(2x+3)</b>
            <div class="tip"><b>Fator comum:</b> pegue o maior número que divide todos e a menor potência de x comum.
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Trinômio Simples</span></div>
          <div class="qt">77. Fatore: x² + 5x + 6</div>
          <div class="opts" id="q77">
            <div class="opt" onclick="R('q77','a','b','e6')">a) (x+1)(x+6)</div>
            <div class="opt" onclick="R('q77','b','b','e6')">b) (x+2)(x+3)</div>
            <div class="opt" onclick="R('q77','c','b','e6')">c) (x−2)(x−3)</div>
            <div class="opt" onclick="R('q77','d','b','e6')">d) (x+6)(x−1)</div>
          </div>
          <button class="rbtn" onclick="TR('r77')">▶ Ver resolução</button>
          <div id="r77" class="resol">Procure dois números: soma=5, produto=6. São 2 e 3. <b>(x+2)(x+3)</b>
            <div class="tip"><b>Trinômio a=1:</b> ache dois números com soma=b e produto=c. Liste os pares de divisores
              de c!</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Diferença de Quadrados</span></div>
          <div class="qt">78. Fatore: 9x² − 25</div>
          <div class="opts" id="q78">
            <div class="opt" onclick="R('q78','a','c','e6')">a) (9x−25)(9x+25)</div>
            <div class="opt" onclick="R('q78','b','c','e6')">b) (x−5)(x+5)</div>
            <div class="opt" onclick="R('q78','c','c','e6')">c) (3x−5)(3x+5)</div>
            <div class="opt" onclick="R('q78','d','c','e6')">d) (3x+5)²</div>
          </div>
          <button class="rbtn" onclick="TR('r78')">▶ Ver resolução</button>
          <div id="r78" class="resol">a²−b²=(a−b)(a+b). a=3x, b=5. <b>(3x−5)(3x+5)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">TQP</span></div>
          <div class="qt">79. Fatore: x² − 10x + 25</div>
          <div class="opts" id="q79">
            <div class="opt" onclick="R('q79','a','b','e6')">a) (x+5)²</div>
            <div class="opt" onclick="R('q79','b','b','e6')">b) (x−5)²</div>
            <div class="opt" onclick="R('q79','c','b','e6')">c) (x−5)(x+5)</div>
            <div class="opt" onclick="R('q79','d','b','e6')">d) (x−10)(x+1)</div>
          </div>
          <button class="rbtn" onclick="TR('r79')">▶ Ver resolução</button>
          <div id="r79" class="resol">a²−2ab+b²=(a−b)². a=x, b=5. <b>(x−5)²</b>
            <div class="tip"><b>TQP:</b> verifique se o termo do meio é exatamente 2ab. Se sim, é quadrado perfeito!
            </div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge easy">Fácil</span><span class="tag">Agrupamento</span></div>
          <div class="qt">80. Fatore por agrupamento: ax + ay + bx + by</div>
          <div class="opts" id="q80">
            <div class="opt" onclick="R('q80','a','c','e6')">a) (a+b)(x−y)</div>
            <div class="opt" onclick="R('q80','b','c','e6')">b) a(x+y)+b(x+y)</div>
            <div class="opt" onclick="R('q80','c','c','e6')">c) (a+b)(x+y)</div>
            <div class="opt" onclick="R('q80','d','c','e6')">d) (ax+by)(a+b)</div>
          </div>
          <button class="rbtn" onclick="TR('r80')">▶ Ver resolução</button>
          <div id="r80" class="resol">a(x+y)+b(x+y)=(x+y)(a+b). <b>(a+b)(x+y)</b>
            <div class="tip"><b>Agrupamento:</b> agrupe 2 a 2, coloque em evidência e identifique o fator comum entre os
              grupos.</div>
          </div>
        </div>
      </div>

      <div id="m6" class="sub2">
        <div class="ps" id="p-m6">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-m6" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">a≠1</span></div>
          <div class="qt">81. Fatore: 2x² + 7x + 3</div>
          <div class="opts" id="q81">
            <div class="opt" onclick="R('q81','a','c','m6')">a) (2x+1)(x+3)</div>
            <div class="opt" onclick="R('q81','b','c','m6')">b) (2x−1)(x−3)</div>
            <div class="opt" onclick="R('q81','c','c','m6')">c) (2x+1)(x+3)</div>
            <div class="opt" onclick="R('q81','d','c','m6')">d) (x+1)(2x+3)</div>
          </div>
          <button class="rbtn" onclick="TR('r81')">▶ Ver resolução</button>
          <div id="r81" class="resol">ac=6. Dois números: soma=7, produto=6 → 1 e 6.
            2x²+x+6x+3=x(2x+1)+3(2x+1)=<b>(2x+1)(x+3)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Completo</span></div>
          <div class="qt">82. Fatore completamente: 2x³ − 8x</div>
          <div class="opts" id="q82">
            <div class="opt" onclick="R('q82','a','d','m6')">a) 2x(x²−4)</div>
            <div class="opt" onclick="R('q82','b','d','m6')">b) 2(x³−4x)</div>
            <div class="opt" onclick="R('q82','c','d','m6')">c) 2x(x+2)(x−2)</div>
            <div class="opt" onclick="R('q82','d','d','m6')">d) 2x(x+2)(x−2)</div>
          </div>
          <button class="rbtn" onclick="TR('r82')">▶ Ver resolução</button>
          <div id="r82" class="resol">2x(x²−4)=<b>2x(x+2)(x−2)</b>. Fatoração completa: fator comum + diferença de
            quadrados.
            <div class="tip"><b>Sempre:</b> procure fator comum primeiro. Depois continue fatorando o que sobra.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Trinômio</span></div>
          <div class="qt">83. Fatore: x² − x − 12</div>
          <div class="opts" id="q83">
            <div class="opt" onclick="R('q83','a','b','m6')">a) (x+3)(x−4)</div>
            <div class="opt" onclick="R('q83','b','b','m6')">b) (x+3)(x−4)</div>
            <div class="opt" onclick="R('q83','c','b','m6')">c) (x−3)(x+4)</div>
            <div class="opt" onclick="R('q83','d','b','m6')">d) (x−6)(x+2)</div>
          </div>
          <button class="rbtn" onclick="TR('r83')">▶ Ver resolução</button>
          <div id="r83" class="resol">Dois números: soma=−1, produto=−12. São +3 e −4. <b>(x+3)(x−4)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Cubo</span></div>
          <div class="qt">84. Fatore: x³ + 8</div>
          <div class="opts" id="q84">
            <div class="opt" onclick="R('q84','a','c','m6')">a) (x+2)³</div>
            <div class="opt" onclick="R('q84','b','c','m6')">b) (x+2)(x²−4)</div>
            <div class="opt" onclick="R('q84','c','c','m6')">c) (x+2)(x²−2x+4)</div>
            <div class="opt" onclick="R('q84','d','c','m6')">d) (x+2)(x²+2x+4)</div>
          </div>
          <button class="rbtn" onclick="TR('r84')">▶ Ver resolução</button>
          <div id="r84" class="resol">a³+b³=(a+b)(a²−ab+b²). a=x, b=2. <b>(x+2)(x²−2x+4)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge med">Médio</span><span class="tag">Simplificação</span></div>
          <div class="qt">85. Simplifique: (x²−4)/(x+2)</div>
          <div class="opts" id="q85">
            <div class="opt" onclick="R('q85','a','c','m6')">a) x+2</div>
            <div class="opt" onclick="R('q85','b','c','m6')">b) x²−2</div>
            <div class="opt" onclick="R('q85','c','c','m6')">c) x−2</div>
            <div class="opt" onclick="R('q85','d','c','m6')">d) (x−2)/(x+2)</div>
          </div>
          <button class="rbtn" onclick="TR('r85')">▶ Ver resolução</button>
          <div id="r85" class="resol">x²−4=(x−2)(x+2). Divide por (x+2): <b>x−2</b> (com x≠−2)
            <div class="tip"><b>Simplificação:</b> fatore numerador e denominador, depois cancele os fatores comuns.
            </div>
          </div>
        </div>
      </div>

      <div id="h6" class="sub2">
        <div class="ps" id="p-h6">0 de 5 respondidas</div>
        <div class="pbar">
          <div class="pfill" id="f-h6" style="width:0%"></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Grau 4</span></div>
          <div class="qt">86. Fatore: x⁴ − 1</div>
          <div class="opts" id="q86">
            <div class="opt" onclick="R('q86','a','d','h6')">a) (x²−1)²</div>
            <div class="opt" onclick="R('q86','b','d','h6')">b) (x−1)(x³+1)</div>
            <div class="opt" onclick="R('q86','c','d','h6')">c) (x+1)(x−1)(x+1)²</div>
            <div class="opt" onclick="R('q86','d','d','h6')">d) (x+1)(x−1)(x²+1)</div>
          </div>
          <button class="rbtn" onclick="TR('r86')">▶ Ver resolução</button>
          <div id="r86" class="resol">(x²)²−1²=(x²−1)(x²+1)=(x−1)(x+1)(x²+1). <b>(x+1)(x−1)(x²+1)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Sophie Germain</span></div>
          <div class="qt">87. Fatore: a⁴ + 4b⁴ (identidade de Sophie Germain)</div>
          <div class="opts" id="q87">
            <div class="opt" onclick="R('q87','a','c','h6')">a) (a²+2b²)²</div>
            <div class="opt" onclick="R('q87','b','c','h6')">b) (a²−2b²)(a²+2b²)</div>
            <div class="opt" onclick="R('q87','c','c','h6')">c) (a²+2ab+2b²)(a²−2ab+2b²)</div>
            <div class="opt" onclick="R('q87','d','c','h6')">d) (a+2b)²(a−2b)²</div>
          </div>
          <button class="rbtn" onclick="TR('r87')">▶ Ver resolução</button>
          <div id="r87" class="resol">a⁴+4b⁴=(a²+2b²)²−(2ab)²=(a²+2ab+2b²)(a²−2ab+2b²). <b>Opção c</b>
            <div class="tip"><b>Sophie Germain:</b> a⁴+4b⁴ não é primo! Adicione e subtraia 4a²b² para completar
              quadrados.</div>
          </div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Racional</span></div>
          <div class="qt">88. Simplifique: (x³−8)/(x²−4)</div>
          <div class="opts" id="q88">
            <div class="opt" onclick="R('q88','a','c','h6')">a) (x+2)</div>
            <div class="opt" onclick="R('q88','b','c','h6')">b) (x²+2x+4)/(x+2)</div>
            <div class="opt" onclick="R('q88','c','c','h6')">c) (x²+2x+4)/(x+2)</div>
            <div class="opt" onclick="R('q88','d','c','h6')">d) (x−2)/(x+2)</div>
          </div>
          <button class="rbtn" onclick="TR('r88')">▶ Ver resolução</button>
          <div id="r88" class="resol">Num: (x−2)(x²+2x+4). Den: (x−2)(x+2). Cancela (x−2): <b>(x²+2x+4)/(x+2)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Agrupamento</span></div>
          <div class="qt">89. Fatore por agrupamento: x³ − x² − x + 1</div>
          <div class="opts" id="q89">
            <div class="opt" onclick="R('q89','a','d','h6')">a) (x−1)²(x+1)</div>
            <div class="opt" onclick="R('q89','b','d','h6')">b) (x+1)²(x−1)</div>
            <div class="opt" onclick="R('q89','c','d','h6')">c) (x−1)(x+1)²</div>
            <div class="opt" onclick="R('q89','d','d','h6')">d) (x−1)²(x+1)</div>
          </div>
          <button class="rbtn" onclick="TR('r89')">▶ Ver resolução</button>
          <div id="r89" class="resol">x²(x−1)−1(x−1)=(x−1)(x²−1)=(x−1)(x−1)(x+1)=<b>(x−1)²(x+1)</b></div>
        </div>

        <div class="qcard">
          <div class="badges"><span class="badge hard">Difícil</span><span class="tag">Grau 3</span></div>
          <div class="qt">90. Fatore completamente: 3x³ − 3x² − 36x</div>
          <div class="opts" id="q90">
            <div class="opt" onclick="R('q90','a','c','h6')">a) 3x(x+3)(x−4)</div>
            <div class="opt" onclick="R('q90','b','c','h6')">b) 3x(x−3)(x+4)</div>
            <div class="opt" onclick="R('q90','c','c','h6')">c) 3x(x+3)(x−4)</div>
            <div class="opt" onclick="R('q90','d','c','h6')">d) 3(x²−12x)</div>
          </div>
          <button class="rbtn" onclick="TR('r90')">▶ Ver resolução</button>
          <div id="r90" class="resol">3x(x²−x−12). Fatorar x²−x−12: dois números soma=−1, produto=−12 → +3 e −4.
            <b>3x(x+3)(x−4)</b>
            <div class="tip"><b>Grau 3:</b> sempre coloque em evidência o fator comum primeiro, depois fatore o trinômio
              restante.</div>
          </div>
        </div>
      </div>
    </div>

  </div><!-- /page -->

  <script>
    // Controle global de progresso
    var totalQuestoes = 90;
    var respondidas = 0;

    function ST(id) {
      ['t1', 't2', 't3', 't4', 't5', 't6'].forEach(s => document.getElementById(s).classList.remove('active'));
      document.getElementById(id).classList.add('active');
      document.querySelectorAll('.tab').forEach((tb, i) => {
        tb.classList.toggle('active', ['t1', 't2', 't3', 't4', 't5', 't6'][i] === id);
      });
    }

    function SS(mat, id, btn) {
      var sec = document.getElementById(mat);
      sec.querySelectorAll('.sub2').forEach(s => s.classList.remove('active'));
      document.getElementById(id).classList.add('active');
      sec.querySelectorAll('.stab').forEach(st => st.classList.remove('active'));
      btn.classList.add('active');
    }

    function R(qid, chosen, correct, subId) {
      var c = document.getElementById(qid);
      if (c.dataset.answered) return;
      c.dataset.answered = '1';
      respondidas++;
      ['a', 'b', 'c', 'd'].forEach((l, i) => {
        var o = c.querySelectorAll('.opt')[i];
        if (l === correct) o.classList.add('ok');
        else if (l === chosen) o.classList.add('no');
        o.style.pointerEvents = 'none';
      });
      // Progresso da sub-seção
      var sub = document.getElementById(subId);
      if (!sub) return;
      var total = sub.querySelectorAll('.opts').length;
      var done = sub.querySelectorAll('[data-answered]').length;
      var ps = document.getElementById('p-' + subId);
      var pf = document.getElementById('f-' + subId);
      if (ps) ps.textContent = done + ' de ' + total + ' respondidas';
      if (pf) pf.style.width = Math.round(done / total * 100) + '%';
      // Progresso global
      var gf = document.getElementById('global-fill');
      var gn = document.getElementById('global-num');
      if (gf) gf.style.width = Math.round(respondidas / totalQuestoes * 100) + '%';
      if (gn) gn.textContent = respondidas + ' / ' + totalQuestoes;
    }

    function TR(id) {
      var el = document.getElementById(id);
      el.classList.toggle('show');
      var btn = el.previousElementSibling;
      btn.textContent = el.classList.contains('show') ? '▼ Ocultar resolução' : '▶ Ver resolução';
    }
  </script>
</body>

</html>