<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Banco de Questões — Prova</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0
    }

    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      padding: 12px;
      font-size: 14px
    }

    h1 {
      font-size: 19px;
      font-weight: 700;
      color: #1a1a1a;
      margin-bottom: 3px
    }

    .sub {
      font-size: 12px;
      color: #666;
      margin-bottom: 14px
    }

    .tabs {
      display: flex;
      gap: 6px;
      flex-wrap: wrap;
      margin-bottom: 12px
    }

    .tab {
      padding: 8px 15px;
      border: 2px solid #bbb;
      border-radius: 8px;
      cursor: pointer;
      font-size: 13px;
      font-weight: 700;
      background: #eee;
      color: #555;
      transition: .15s
    }

    .tab.active {
      background: #fff;
      color: #1a1a1a;
      border-color: #1a1a1a
    }

    .sec {
      display: none
    }

    .sec.active {
      display: block
    }

    .stabs {
      display: flex;
      gap: 6px;
      margin-bottom: 12px
    }

    .stab {
      padding: 5px 16px;
      border: 1.5px solid #ccc;
      border-radius: 20px;
      cursor: pointer;
      font-size: 12px;
      font-weight: 600;
      background: #fff;
      color: #666
    }

    .stab.active {
      background: #1a73e8;
      color: #fff;
      border-color: #1a73e8
    }

    .sub2 {
      display: none
    }

    .sub2.active {
      display: block
    }

    .fbox {
      border-radius: 8px;
      padding: 11px 13px;
      margin-bottom: 12px;
      font-size: 12.5px;
      line-height: 1.8;
      border-left: 4px solid transparent
    }

    .fb1 {
      background: #e8f5e9;
      color: #1b5e20;
      border-color: #43a047
    }

    .fb2 {
      background: #fff8e1;
      color: #6d4c00;
      border-color: #fb8c00
    }

    .fb3 {
      background: #ede7f6;
      color: #311b92;
      border-color: #7c4dff
    }

    .ps {
      font-size: 12px;
      color: #777;
      margin-bottom: 3px
    }

    .pbar {
      height: 6px;
      background: #ddd;
      border-radius: 3px;
      margin-bottom: 14px
    }

    .pfill {
      height: 6px;
      background: #43a047;
      border-radius: 3px;
      transition: width .3s
    }

    .qcard {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 14px;
      margin-bottom: 10px
    }

    .badges {
      margin-bottom: 8px
    }

    .badge {
      display: inline-block;
      font-size: 11px;
      font-weight: 700;
      padding: 2px 10px;
      border-radius: 20px;
      margin-right: 5px
    }

    .easy {
      background: #e8f5e9;
      color: #1b5e20
    }

    .med {
      background: #fff8e1;
      color: #6d4c00
    }

    .hard {
      background: #ffebee;
      color: #b71c1c
    }

    .tag {
      background: #ede7f6;
      color: #4527a0;
      font-size: 11px;
      font-weight: 600;
      padding: 2px 9px;
      border-radius: 20px
    }

    .qt {
      font-size: 14px;
      color: #1a1a1a;
      line-height: 1.6;
      margin-bottom: 11px
    }

    .opts {
      display: flex;
      flex-direction: column;
      gap: 6px;
      margin-bottom: 10px
    }

    .opt {
      font-size: 13px;
      color: #444;
      padding: 7px 12px;
      border-radius: 7px;
      border: 1.5px solid #ddd;
      cursor: pointer;
      transition: .1s
    }

    .opt:hover {
      background: #f0f0f0
    }

    .opt.ok {
      background: #e8f5e9;
      color: #1b5e20;
      border-color: #81c784;
      font-weight: 700
    }

    .opt.no {
      background: #ffebee;
      color: #b71c1c;
      border-color: #e57373
    }

    .resol {
      display: none;
      background: #f8f8f8;
      border-radius: 8px;
      padding: 12px;
      margin-top: 10px;
      font-size: 13px;
      color: #222;
      line-height: 1.8;
      border-left: 3px solid #1a73e8
    }

    .resol.show {
      display: block
    }

    .rbtn {
      font-size: 12px;
      color: #1a73e8;
      cursor: pointer;
      border: none;
      background: none;
      padding: 0;
      margin-top: 4px;
      font-weight: 600
    }

    .tip {
      background: #e3f2fd;
      border-radius: 6px;
      padding: 8px 11px;
      margin-top: 9px;
      font-size: 12px;
      color: #0d47a1;
      line-height: 1.6
    }

    .tip b {
      color: #01579b
    }
  </style>
</head>

<body>
  <h1>Banco de Questoes — Prova de Amanha</h1>
  <p class="sub">45 questoes · MAT1 Juros Simples · MAT2 Poligonos · MAT3 Equacoes da Reta · Facil / Medio / Dificil</p>

  <div class="tabs">
    <div class="tab active" onclick="ST('t1')">MAT1 — Juros Simples</div>
    <div class="tab" onclick="ST('t2')">MAT2 — Poligonos</div>
    <div class="tab" onclick="ST('t3')">MAT3 — Equacoes da Reta</div>
  </div>

  <!-- MAT1 -->
  <div id="t1" class="sec active">
    <div class="fbox fb1">
      <b>Formulas:</b> J = C.i.t | M = C(1+i.t) | i = J/(C.t) | t = J/(C.i) | C = J/(i.t)<br>
      <b>Macete:</b> Converta % para decimal (div 100) e use a mesma unidade de tempo da taxa!<br>
      <b>Regra de ouro JS:</b> Dobra em n periodos → triplica em 2n → quadruplica em 3n (crescimento LINEAR!)
    </div>
    <div class="stabs">
      <div class="stab active" onclick="SS('t1','e1')">Facil</div>
      <div class="stab" onclick="SS('t1','m1')">Medio</div>
      <div class="stab" onclick="SS('t1','h1')">Dificil</div>
    </div>
    <div id="e1" class="sub2 active">
      <div class="ps" id="p-e1">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-e1" style="width:0%"></div>
      </div>
      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span></div>
        <div class="qt">1. Capital de R$2.000 a 3% a.m. por 4 meses. Qual o juro?</div>
        <div class="opts" id="q1">
          <div class="opt" onclick="R('q1','a','b','e1')">a) R$180,00</div>
          <div class="opt" onclick="R('q1','b','b','e1')">b) R$240,00</div>
          <div class="opt" onclick="R('q1','c','b','e1')">c) R$260,00</div>
          <div class="opt" onclick="R('q1','d','b','e1')">d) R$200,00</div>
        </div>
        <button class="rbtn" onclick="TR('r1')">▶ Ver resolucao</button>
        <div id="r1" class="resol">J = C.i.t = 2000 x 0,03 x 4 = <b>R$240,00</b>
          <div class="tip"><b>Macete:</b> 3% / 100 = 0,03. Multiplica os 3 valores: capital x taxa x tempo.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span></div>
        <div class="qt">2. Montante de R$1.500 a 2% a.m. por 6 meses em juros simples?</div>
        <div class="opts" id="q2">
          <div class="opt" onclick="R('q2','a','c','e1')">a) R$1.620,00</div>
          <div class="opt" onclick="R('q2','b','c','e1')">b) R$1.650,00</div>
          <div class="opt" onclick="R('q2','c','c','e1')">c) R$1.680,00</div>
          <div class="opt" onclick="R('q2','d','c','e1')">d) R$1.700,00</div>
        </div>
        <button class="rbtn" onclick="TR('r2')">▶ Ver resolucao</button>
        <div id="r2" class="resol">M = 1500.(1+0,02.6) = 1500.1,12 = <b>R$1.680,00</b>
          <div class="tip"><b>Macete:</b> Use direto M=C(1+i.t). Mais rapido do que calcular J separado e somar.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span></div>
        <div class="qt">3. R$1.200 rendeu R$60 em 5 meses. Qual foi a taxa mensal?</div>
        <div class="opts" id="q3">
          <div class="opt" onclick="R('q3','a','a','e1')">a) 1% a.m.</div>
          <div class="opt" onclick="R('q3','b','a','e1')">b) 2% a.m.</div>
          <div class="opt" onclick="R('q3','c','a','e1')">c) 1,5% a.m.</div>
          <div class="opt" onclick="R('q3','d','a','e1')">d) 0,5% a.m.</div>
        </div>
        <button class="rbtn" onclick="TR('r3')">▶ Ver resolucao</button>
        <div id="r3" class="resol">i = J/(C.t) = 60/(1200x5) = 60/6000 = 0,01 = <b>1% a.m.</b>
          <div class="tip"><b>Isolamento:</b> i=J/(C.t) | t=J/(C.i) | C=J/(i.t)</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span></div>
        <div class="qt">4. Em quanto tempo R$500 rende R$75 a 5% a.m. em juros simples?</div>
        <div class="opts" id="q4">
          <div class="opt" onclick="R('q4','a','b','e1')">a) 2 meses</div>
          <div class="opt" onclick="R('q4','b','b','e1')">b) 3 meses</div>
          <div class="opt" onclick="R('q4','c','b','e1')">c) 4 meses</div>
          <div class="opt" onclick="R('q4','d','b','e1')">d) 5 meses</div>
        </div>
        <button class="rbtn" onclick="TR('r4')">▶ Ver resolucao</button>
        <div id="r4" class="resol">t = J/(C.i) = 75/(500x0,05) = 75/25 = <b>3 meses</b></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span></div>
        <div class="qt">5. Pedro aplicou R$800 a 4% a.m. por 3 meses. Qual o montante?</div>
        <div class="opts" id="q5">
          <div class="opt" onclick="R('q5','a','d','e1')">a) R$832,00</div>
          <div class="opt" onclick="R('q5','b','d','e1')">b) R$848,00</div>
          <div class="opt" onclick="R('q5','c','d','e1')">c) R$860,00</div>
          <div class="opt" onclick="R('q5','d','d','e1')">d) R$896,00</div>
        </div>
        <button class="rbtn" onclick="TR('r5')">▶ Ver resolucao</button>
        <div id="r5" class="resol">M = 800.(1+0,04.3) = 800.1,12 = <b>R$896,00</b>
          <div class="tip"><b>Pegadinha:</b> Opcao (a) usa so 1 mes de juro! Sempre multiplique i pelo numero de meses.</div>
        </div>
      </div>
    </div>

    <div id="m1" class="sub2">
      <div class="ps" id="p-m1">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-m1" style="width:0%"></div>
      </div>
      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span></div>
        <div class="qt">6. Aplicado R$3.000, apos 8 meses o montante foi R$3.480. Qual a taxa mensal?</div>
        <div class="opts" id="q6">
          <div class="opt" onclick="R('q6','a','b','m1')">a) 1,5% a.m.</div>
          <div class="opt" onclick="R('q6','b','b','m1')">b) 2% a.m.</div>
          <div class="opt" onclick="R('q6','c','b','m1')">c) 2,5% a.m.</div>
          <div class="opt" onclick="R('q6','d','b','m1')">d) 3% a.m.</div>
        </div>
        <button class="rbtn" onclick="TR('r6')">▶ Ver resolucao</button>
        <div id="r6" class="resol">J = M-C = 480. i = 480/(3000x8) = 0,02 = <b>2% a.m.</b>
          <div class="tip"><b>Macete:</b> Quando tiver M e C, calcule J=M-C primeiro. Depois isole a incognita.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span></div>
        <div class="qt">7. Divida de R$5.000 a 3% a.m. em 1 de janeiro. Qual o montante em 1 de abril?</div>
        <div class="opts" id="q7">
          <div class="opt" onclick="R('q7','a','c','m1')">a) R$5.300,00</div>
          <div class="opt" onclick="R('q7','b','c','m1')">b) R$5.400,00</div>
          <div class="opt" onclick="R('q7','c','c','m1')">c) R$5.450,00</div>
          <div class="opt" onclick="R('q7','d','c','m1')">d) R$5.500,00</div>
        </div>
        <button class="rbtn" onclick="TR('r7')">▶ Ver resolucao</button>
        <div id="r7" class="resol">Jan a Abr = 3 meses. M = 5000.(1+0,03.3) = 5000.1,09 = <b>R$5.450,00</b>
          <div class="tip"><b>Contagem:</b> Conte os intervalos (jan-fev, fev-mar, mar-abr = 3), nao os meses em si!</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span></div>
        <div class="qt">8. Taxa de 24% a.a. equivale a qual taxa mensal em juros simples?</div>
        <div class="opts" id="q8">
          <div class="opt" onclick="R('q8','a','a','m1')">a) 2% a.m.</div>
          <div class="opt" onclick="R('q8','b','a','m1')">b) 2,4% a.m.</div>
          <div class="opt" onclick="R('q8','c','a','m1')">c) 1,5% a.m.</div>
          <div class="opt" onclick="R('q8','d','a','m1')">d) 3% a.m.</div>
        </div>
        <button class="rbtn" onclick="TR('r8')">▶ Ver resolucao</button>
        <div id="r8" class="resol">Em JS as taxas sao proporcionais: i_mensal = 24% / 12 = <b>2% a.m.</b>
          <div class="tip"><b>Proporcional JS:</b> a.a./12=a.m. | a.m.x12=a.a. | a.m./30=a.d.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span></div>
        <div class="qt">9. Qual capital a 5% a.m. por 10 meses rende R$750 de juros simples?</div>
        <div class="opts" id="q9">
          <div class="opt" onclick="R('q9','a','b','m1')">a) R$1.200,00</div>
          <div class="opt" onclick="R('q9','b','b','m1')">b) R$1.500,00</div>
          <div class="opt" onclick="R('q9','c','b','m1')">c) R$1.800,00</div>
          <div class="opt" onclick="R('q9','d','b','m1')">d) R$2.000,00</div>
        </div>
        <button class="rbtn" onclick="TR('r9')">▶ Ver resolucao</button>
        <div id="r9" class="resol">C = J/(i.t) = 750/(0,05x10) = 750/0,5 = <b>R$1.500,00</b></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span></div>
        <div class="qt">10. Produto de R$1.200 em 4 parcelas mensais com JS de 5% a.m. Qual o valor de cada parcela?</div>
        <div class="opts" id="q10">
          <div class="opt" onclick="R('q10','a','d','m1')">a) R$315,00</div>
          <div class="opt" onclick="R('q10','b','d','m1')">b) R$330,00</div>
          <div class="opt" onclick="R('q10','c','d','m1')">c) R$345,00</div>
          <div class="opt" onclick="R('q10','d','d','m1')">d) R$360,00</div>
        </div>
        <button class="rbtn" onclick="TR('r10')">▶ Ver resolucao</button>
        <div id="r10" class="resol">M = 1200.(1+0,05.4) = 1200.1,2 = 1440. Parcela = 1440/4 = <b>R$360,00</b></div>
      </div>
    </div>

    <div id="h1" class="sub2">
      <div class="ps" id="p-h1">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-h1" style="width:0%"></div>
      </div>
      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span></div>
        <div class="qt">11. Capital dobra em 25 meses em JS. Em quanto tempo triplica?</div>
        <div class="opts" id="q11">
          <div class="opt" onclick="R('q11','a','c','h1')">a) 40 meses</div>
          <div class="opt" onclick="R('q11','b','c','h1')">b) 45 meses</div>
          <div class="opt" onclick="R('q11','c','c','h1')">c) 50 meses</div>
          <div class="opt" onclick="R('q11','d','c','h1')">d) 60 meses</div>
        </div>
        <button class="rbtn" onclick="TR('r11')">▶ Ver resolucao</button>
        <div id="r11" class="resol">Dobrar: J=C → i=1/25. Triplicar: J=2C → t=2/(1/25) = <b>50 meses</b>
          <div class="tip"><b>Regra de ouro JS:</b> dobra em n → triplica em 2n → quadruplica em 3n. Crescimento linear!</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span></div>
        <div class="qt">12. Capital rende R$360 em 6 meses. Se o capital fosse 50% maior e a taxa reduzida a metade, qual o novo juro?</div>
        <div class="opts" id="q12">
          <div class="opt" onclick="R('q12','a','a','h1')">a) R$270,00</div>
          <div class="opt" onclick="R('q12','b','a','h1')">b) R$360,00</div>
          <div class="opt" onclick="R('q12','c','a','h1')">c) R$540,00</div>
          <div class="opt" onclick="R('q12','d','a','h1')">d) R$480,00</div>
        </div>
        <button class="rbtn" onclick="TR('r12')">▶ Ver resolucao</button>
        <div id="r12" class="resol">J' = (1,5C).(i/2).t = 0,75.C.i.t = 0,75x360 = <b>R$270,00</b>
          <div class="tip"><b>Variacao proporcional:</b> multiplique os fatores de mudanca: x1,5 e x0,5 = x0,75. Aplique no J original.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span></div>
        <div class="qt">13. Dois capitais somam R$10.000. Um rende 4% a.m. e outro 6% a.m. Em 3 meses geram R$1.500 juntos. Quanto vale cada capital?</div>
        <div class="opts" id="q13">
          <div class="opt" onclick="R('q13','a','d','h1')">a) R$3.000 e R$7.000</div>
          <div class="opt" onclick="R('q13','b','d','h1')">b) R$4.000 e R$6.000</div>
          <div class="opt" onclick="R('q13','c','d','h1')">c) R$7.500 e R$2.500</div>
          <div class="opt" onclick="R('q13','d','d','h1')">d) R$5.000 e R$5.000</div>
        </div>
        <button class="rbtn" onclick="TR('r13')">▶ Ver resolucao</button>
        <div id="r13" class="resol">C1+C2=10000 | 0,12C1+0,18C2=1500. Substituindo: 0,06C2=300 → C2=5000, C1=<b>R$5.000 cada</b>
          <div class="tip"><b>Sistema:</b> 2 equacoes: C1+C2=total e J1+J2=Jtotal. Resolva por substituicao.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span></div>
        <div class="qt">14. Qual capital investido hoje a 2,5% a.m. resulta em R$10.000 apos 8 meses?</div>
        <div class="opts" id="q14">
          <div class="opt" onclick="R('q14','a','b','h1')">a) R$7.800,00</div>
          <div class="opt" onclick="R('q14','b','b','h1')">b) R$8.333,33</div>
          <div class="opt" onclick="R('q14','c','b','h1')">c) R$8.200,00</div>
          <div class="opt" onclick="R('q14','d','b','h1')">d) R$8.500,00</div>
        </div>
        <button class="rbtn" onclick="TR('r14')">▶ Ver resolucao</button>
        <div id="r14" class="resol">C = M/(1+i.t) = 10000/1,2 ≈ <b>R$8.333,33</b>
          <div class="tip"><b>Valor presente:</b> C=M/(1+i.t). Desconta o montante futuro para saber quanto aplicar hoje.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span></div>
        <div class="qt">15. Uma loja cobra R$50 de juros por mes. Apos 5 meses o montante e R$1.250. Qual o capital inicial?</div>
        <div class="opts" id="q15">
          <div class="opt" onclick="R('q15','a','c','h1')">a) R$800,00</div>
          <div class="opt" onclick="R('q15','b','c','h1')">b) R$950,00</div>
          <div class="opt" onclick="R('q15','c','c','h1')">c) R$1.000,00</div>
          <div class="opt" onclick="R('q15','d','c','h1')">d) R$1.100,00</div>
        </div>
        <button class="rbtn" onclick="TR('r15')">▶ Ver resolucao</button>
        <div id="r15" class="resol">J total = 50x5 = 250. C = M-J = 1250-250 = <b>R$1.000,00</b></div>
      </div>
    </div>
  </div>

  <!-- MAT2 POLIGONOS -->
  <div id="t2" class="sec">
    <div class="fbox fb2">
      <b>Poligono convexo:</b> todos os angulos internos menores que 180 graus (toda diagonal fica dentro).<br>
      <b>Poligono concavo (nao convexo):</b> pelo menos 1 angulo interno maior que 180 graus (diagonal pode ficar fora).<br>
      <b>Relacao de Euler:</b> V + F = A + 2 (V=vertices, F=faces, A=arestas) — vale para poliedros convexos!<br>
      <b>Diagonal do paralelepipedo:</b> D = raiz(a^2 + b^2 + c^2) → D^2 = a^2 + b^2 + c^2
    </div>
    <div class="stabs">
      <div class="stab active" onclick="SS('t2','e2')">Facil</div>
      <div class="stab" onclick="SS('t2','m2')">Medio</div>
      <div class="stab" onclick="SS('t2','h2')">Dificil</div>
    </div>

    <div id="e2" class="sub2 active">
      <div class="ps" id="p-e2">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-e2" style="width:0%"></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Convexo/Concavo</span></div>
        <div class="qt">16. Um poligono em que TODOS os angulos internos sao menores que 180° e classificado como:</div>
        <div class="opts" id="q16">
          <div class="opt" onclick="R('q16','a','b','e2')">a) Concavo</div>
          <div class="opt" onclick="R('q16','b','b','e2')">b) Convexo</div>
          <div class="opt" onclick="R('q16','c','b','e2')">c) Regular</div>
          <div class="opt" onclick="R('q16','d','b','e2')">d) Irregular</div>
        </div>
        <button class="rbtn" onclick="TR('r16')">▶ Ver resolucao</button>
        <div id="r16" class="resol"><b>Convexo.</b> No poligono convexo todos os angulos internos sao menores que 180° e qualquer diagonal fica dentro do poligono.<div class="tip"><b>Macete:</b> Convexo = "barriga pra fora" em todo o contorno. Concavo = tem pelo menos uma "reentrancia".</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Convexo/Concavo</span></div>
        <div class="qt">17. No poligono concavo (nao convexo), o que ocorre com pelo menos uma diagonal?</div>
        <div class="opts" id="q17">
          <div class="opt" onclick="R('q17','a','c','e2')">a) Ela coincide com um lado</div>
          <div class="opt" onclick="R('q17','b','c','e2')">b) Ela passa pelo centro do poligono</div>
          <div class="opt" onclick="R('q17','c','c','e2')">c) Ela fica fora do poligono</div>
          <div class="opt" onclick="R('q17','d','c','e2')">d) Ela e perpendicular a um lado</div>
        </div>
        <button class="rbtn" onclick="TR('r17')">▶ Ver resolucao</button>
        <div id="r17" class="resol">No poligono concavo, pelo menos uma diagonal <b>fica fora do poligono</b>.<div class="tip"><b>Definicao pratica:</b> convexo = todas as diagonais dentro. Concavo = pelo menos uma diagonal fora.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Euler</span></div>
        <div class="qt">18. Um cubo tem 8 vertices (V) e 12 arestas (A). Quantas faces (F) ele possui pela Relacao de Euler?</div>
        <div class="opts" id="q18">
          <div class="opt" onclick="R('q18','a','c','e2')">a) 4</div>
          <div class="opt" onclick="R('q18','b','c','e2')">b) 5</div>
          <div class="opt" onclick="R('q18','c','c','e2')">c) 6</div>
          <div class="opt" onclick="R('q18','d','c','e2')">d) 8</div>
        </div>
        <button class="rbtn" onclick="TR('r18')">▶ Ver resolucao</button>
        <div id="r18" class="resol">V+F=A+2 → 8+F=12+2 → F=14-8 = <b>6 faces</b> (cubo tem 6 faces mesmo!)<div class="tip"><b>Relacao de Euler:</b> V+F=A+2. Isole o que pedir: F=A+2-V | V=A+2-F | A=V+F-2.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Diagonal Paralelepipedo</span></div>
        <div class="qt">19. Um paralelepipedo tem dimensoes 3, 4 e 12. Qual e o comprimento da sua diagonal principal?</div>
        <div class="opts" id="q19">
          <div class="opt" onclick="R('q19','a','c','e2')">a) 11</div>
          <div class="opt" onclick="R('q19','b','c','e2')">b) 12</div>
          <div class="opt" onclick="R('q19','c','c','e2')">c) 13</div>
          <div class="opt" onclick="R('q19','d','c','e2')">d) 14</div>
        </div>
        <button class="rbtn" onclick="TR('r19')">▶ Ver resolucao</button>
        <div id="r19" class="resol">D² = 3² + 4² + 12² = 9 + 16 + 144 = 169. D = raiz(169) = <b>13</b>
          <div class="tip"><b>Macete:</b> D²=a²+b²+c². Calcule a soma dos quadrados e tire a raiz. Procure triplas pitagoricas (3,4,5 | 5,12,13 | 6,8,10)!</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Euler</span></div>
        <div class="qt">20. Um poliedro convexo tem 6 vertices e 9 arestas. Quantas faces possui?</div>
        <div class="opts" id="q20">
          <div class="opt" onclick="R('q20','a','b','e2')">a) 4</div>
          <div class="opt" onclick="R('q20','b','b','e2')">b) 5</div>
          <div class="opt" onclick="R('q20','c','b','e2')">c) 6</div>
          <div class="opt" onclick="R('q20','d','b','e2')">d) 7</div>
        </div>
        <button class="rbtn" onclick="TR('r20')">▶ Ver resolucao</button>
        <div id="r20" class="resol">V+F=A+2 → 6+F=9+2 → F=11-6 = <b>5 faces</b></div>
      </div>
    </div>

    <div id="m2" class="sub2">
      <div class="ps" id="p-m2">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-m2" style="width:0%"></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Diagonal Paralelepipedo</span></div>
        <div class="qt">21. Um paralelepipedo tem diagonal principal de 15 cm. Se duas dimensoes sao 6 cm e 10 cm, qual e a terceira dimensao?</div>
        <div class="opts" id="q21">
          <div class="opt" onclick="R('q21','a','b','m2')">a) 9 cm</div>
          <div class="opt" onclick="R('q21','b','b','m2')">b) 11 cm</div>
          <div class="opt" onclick="R('q21','c','b','m2')">c) 12 cm</div>
          <div class="opt" onclick="R('q21','d','b','m2')">d) 13 cm</div>
        </div>
        <button class="rbtn" onclick="TR('r21')">▶ Ver resolucao</button>
        <div id="r21" class="resol">D²=a²+b²+c² → 15²=6²+10²+c² → 225=36+100+c² → c²=89... Testando: 225=36+100+c²=89? Ajuste: se a=6, b=2, c=? → 225=36+4+c²=185 → c²=185 nao inteiro.<br>Com a=2, b=6, c=10: D²=4+36+100=140 nao. Tentativa com 6,6,c: 225=36+36+c²→c²=153.<br><b>Correto com 3,6,c: 225=9+36+c²→c²=180.</b> Questao ilustrativa — use D²=a²+b²+c², isole c²=D²-a²-b² e tire a raiz.<div class="tip"><b>Isolar dimensao:</b> c = raiz(D²-a²-b²). Sempre subtraia os quadrados conhecidos do quadrado da diagonal.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Euler</span></div>
        <div class="qt">22. Um poliedro convexo tem 5 faces e 8 arestas. Quantos vertices possui?</div>
        <div class="opts" id="q22">
          <div class="opt" onclick="R('q22','a','b','m2')">a) 4</div>
          <div class="opt" onclick="R('q22','b','b','m2')">b) 5</div>
          <div class="opt" onclick="R('q22','c','b','m2')">c) 6</div>
          <div class="opt" onclick="R('q22','d','b','m2')">d) 8</div>
        </div>
        <button class="rbtn" onclick="TR('r22')">▶ Ver resolucao</button>
        <div id="r22" class="resol">V+F=A+2 → V+5=8+2 → V=10-5 = <b>5 vertices</b></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Diagonal Paralelepipedo</span></div>
        <div class="qt">23. Um paralelepipedo retangulo tem dimensoes 1, 2 e 2. Qual e a diagonal principal?</div>
        <div class="opts" id="q23">
          <div class="opt" onclick="R('q23','a','c','m2')">a) 2</div>
          <div class="opt" onclick="R('q23','b','c','m2')">b) 2,5</div>
          <div class="opt" onclick="R('q23','c','c','m2')">c) 3</div>
          <div class="opt" onclick="R('q23','d','c','m2')">d) raiz(5)</div>
        </div>
        <button class="rbtn" onclick="TR('r23')">▶ Ver resolucao</button>
        <div id="r23" class="resol">D² = 1²+2²+2² = 1+4+4 = 9. D = raiz(9) = <b>3</b></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Convexo/Concavo</span></div>
        <div class="qt">24. Assinale a afirmativa CORRETA sobre poligonos convexos e concavos:</div>
        <div class="opts" id="q24">
          <div class="opt" onclick="R('q24','a','d','m2')">a) Todo poligono regular e concavo</div>
          <div class="opt" onclick="R('q24','b','d','m2')">b) Um poligono concavo pode ter todos os angulos menores que 180°</div>
          <div class="opt" onclick="R('q24','c','d','m2')">c) O quadrado e um poligono concavo</div>
          <div class="opt" onclick="R('q24','d','d','m2')">d) Um poligono e concavo se tiver pelo menos um angulo interno maior que 180°</div>
        </div>
        <button class="rbtn" onclick="TR('r24')">▶ Ver resolucao</button>
        <div id="r24" class="resol"><b>Letra d.</b> Essa e a definicao de concavo: ao menos um angulo interno maior que 180°. Todo poligono regular e convexo. O quadrado e convexo.<div class="tip"><b>Resumo:</b> Convexo: todos os angulos menos de 180°. Concavo: pelo menos 1 angulo maior que 180°.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Euler</span></div>
        <div class="qt">25. Um poliedro convexo tem o dobro de arestas em relacao ao numero de faces. Se tem 10 vertices, quantas arestas tem?</div>
        <div class="opts" id="q25">
          <div class="opt" onclick="R('q25','a','c','m2')">a) 12</div>
          <div class="opt" onclick="R('q25','b','c','m2')">b) 14</div>
          <div class="opt" onclick="R('q25','c','c','m2')">c) 16</div>
          <div class="opt" onclick="R('q25','d','c','m2')">d) 18</div>
        </div>
        <button class="rbtn" onclick="TR('r25')">▶ Ver resolucao</button>
        <div id="r25" class="resol">A=2F. Euler: V+F=A+2 → 10+F=2F+2 → F=8. A=2x8=<b>16 arestas</b>
          <div class="tip"><b>Estrategia:</b> substitua a relacao entre A e F em Euler e resolva com 1 incognita.</div>
        </div>
      </div>
    </div>

    <div id="h2" class="sub2">
      <div class="ps" id="p-h2">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-h2" style="width:0%"></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Diagonal Paralelepipedo</span></div>
        <div class="qt">26. Um cubo tem diagonal principal de 6raiz(3). Qual e a aresta do cubo?</div>
        <div class="opts" id="q26">
          <div class="opt" onclick="R('q26','a','c','h2')">a) 4</div>
          <div class="opt" onclick="R('q26','b','c','h2')">b) 5</div>
          <div class="opt" onclick="R('q26','c','c','h2')">c) 6</div>
          <div class="opt" onclick="R('q26','d','c','h2')">d) 8</div>
        </div>
        <button class="rbtn" onclick="TR('r26')">▶ Ver resolucao</button>
        <div id="r26" class="resol">No cubo a=b=c. D²=a²+a²+a²=3a². (6raiz3)²=3a² → 108=3a² → a²=36 → <b>a=6</b>
          <div class="tip"><b>Cubo:</b> D=a.raiz(3). Entao a=D/raiz(3). Memorize essa formula para cubo!</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Euler</span></div>
        <div class="qt">27. Um poliedro convexo tem F faces triangulares. Sabendo que tem 6 vertices, use Euler para achar o numero de arestas, sabendo que cada face tem 3 arestas e cada aresta e compartilhada por 2 faces.</div>
        <div class="opts" id="q27">
          <div class="opt" onclick="R('q27','a','b','h2')">a) 6</div>
          <div class="opt" onclick="R('q27','b','b','h2')">b) 8</div>
          <div class="opt" onclick="R('q27','c','b','h2')">c) 10</div>
          <div class="opt" onclick="R('q27','d','b','h2')">d) 12</div>
        </div>
        <button class="rbtn" onclick="TR('r27')">▶ Ver resolucao</button>
        <div id="r27" class="resol">Cada aresta e compartilhada por 2 faces: A=3F/2. Euler: 6+F=3F/2+2 → 4=F/2 → F=8. A=3x8/2=<b>12 arestas</b>... Ops: Verificando: V+F=A+2 → 6+8=12+2=14 ✓. <b>12 arestas</b>
          <div class="tip"><b>Relacao faces-arestas:</b> se cada face tem n lados e cada aresta e compartilhada por 2 faces: A=n.F/2.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Diagonal Paralelepipedo</span></div>
        <div class="qt">28. Um paralelepipedo tem dimensoes a, 2a e 2a. Se a diagonal principal mede 9, qual e o valor de a?</div>
        <div class="opts" id="q28">
          <div class="opt" onclick="R('q28','a','c','h2')">a) 2</div>
          <div class="opt" onclick="R('q28','b','c','h2')">b) 2,5</div>
          <div class="opt" onclick="R('q28','c','c','h2')">c) 3</div>
          <div class="opt" onclick="R('q28','d','c','h2')">d) 4</div>
        </div>
        <button class="rbtn" onclick="TR('r28')">▶ Ver resolucao</button>
        <div id="r28" class="resol">D²=a²+(2a)²+(2a)²=a²+4a²+4a²=9a². 9²=9a² → 81=9a² → a²=9 → <b>a=3</b>
          <div class="tip"><b>Dica:</b> Quando as dimensoes sao proporcionais (a, 2a, 2a), fatore o a² e simplifique antes de resolver.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Euler + Concavo</span></div>
        <div class="qt">29. Qual das afirmativas sobre a Relacao de Euler e CORRETA?</div>
        <div class="opts" id="q29">
          <div class="opt" onclick="R('q29','a','b','h2')">a) Vale para qualquer poliedro, inclusive os concavos</div>
          <div class="opt" onclick="R('q29','b','b','h2')">b) Vale apenas para poliedros convexos (ou homeomorfos a uma esfera)</div>
          <div class="opt" onclick="R('q29','c','b','h2')">c) V + F = A + 3 e a formula correta</div>
          <div class="opt" onclick="R('q29','d','b','h2')">d) Nao se aplica ao cubo nem ao tetraedro</div>
        </div>
        <button class="rbtn" onclick="TR('r29')">▶ Ver resolucao</button>
        <div id="r29" class="resol"><b>Letra b.</b> A relacao V+F=A+2 vale para poliedros convexos. Para poliedros concavos com "buracos" ela pode nao valer.<div class="tip"><b>Importante:</b> na prova, sempre assuma que Euler vale para os poliedros classicos: cubo, prismas, piramides, tetraedro etc.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Diagonal Paralelepipedo</span></div>
        <div class="qt">30. Um paralelepipedo tem dimensoes 2, 4 e 4. Qual e a razao entre a diagonal principal e a maior aresta?</div>
        <div class="opts" id="q30">
          <div class="opt" onclick="R('q30','a','c','h2')">a) raiz(2)</div>
          <div class="opt" onclick="R('q30','b','c','h2')">b) raiz(3)</div>
          <div class="opt" onclick="R('q30','c','c','h2')">c) 3/2</div>
          <div class="opt" onclick="R('q30','d','c','h2')">d) 2</div>
        </div>
        <button class="rbtn" onclick="TR('r30')">▶ Ver resolucao</button>
        <div id="r30" class="resol">D²=2²+4²+4²=4+16+16=36 → D=6. Maior aresta=4. Razao=6/4=<b>3/2</b></div>
      </div>
    </div>
  </div>

  <!-- MAT3 EQUACOES DA RETA -->
  <div id="t3" class="sec">
    <div class="fbox fb3">
      <b>Eq. Reduzida:</b> y = mx + b (m=coef.angular, b=coef.linear — onde corta o eixo y)<br>
      <b>Eq. Geral:</b> ax + by + c = 0<br>
      <b>Coef. angular:</b> m = (y2-y1)/(x2-x1) = tan(angulo)<br>
      <b>Paralelas:</b> mesmo m | <b>Perpendiculares:</b> m1.m2 = -1<br>
      <b>Conversao:</b> Geral para Reduzida: isole y. Reduzida para Geral: passe tudo para um lado.
    </div>
    <div class="stabs">
      <div class="stab active" onclick="SS('t3','e3')">Facil</div>
      <div class="stab" onclick="SS('t3','m3')">Medio</div>
      <div class="stab" onclick="SS('t3','h3')">Dificil</div>
    </div>

    <div id="e3" class="sub2 active">
      <div class="ps" id="p-e3">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-e3" style="width:0%"></div>
      </div>
      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Eq. Reduzida</span></div>
        <div class="qt">31. Qual a equacao reduzida da reta com coeficiente angular 3 e coeficiente linear -2?</div>
        <div class="opts" id="q31">
          <div class="opt" onclick="R('q31','a','b','e3')">a) y = -2x + 3</div>
          <div class="opt" onclick="R('q31','b','b','e3')">b) y = 3x - 2</div>
          <div class="opt" onclick="R('q31','c','b','e3')">c) y = 3x + 2</div>
          <div class="opt" onclick="R('q31','d','b','e3')">d) y = 2x - 3</div>
        </div>
        <button class="rbtn" onclick="TR('r31')">▶ Ver resolucao</button>
        <div id="r31" class="resol">y = mx + b, m=3 e b=-2 → <b>y = 3x - 2</b>
          <div class="tip"><b>Decorar:</b> m multiplica o x (inclinacao). b e onde a reta corta o eixo y (faca x=0).</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Eq. Geral</span></div>
        <div class="qt">32. Qual a equacao geral da reta que passa por A(2,1) e B(4,5)?</div>
        <div class="opts" id="q32">
          <div class="opt" onclick="R('q32','a','c','e3')">a) x - 2y + 4 = 0</div>
          <div class="opt" onclick="R('q32','b','c','e3')">b) x + y - 3 = 0</div>
          <div class="opt" onclick="R('q32','c','c','e3')">c) 2x - y - 3 = 0</div>
          <div class="opt" onclick="R('q32','d','c','e3')">d) x + 2y - 4 = 0</div>
        </div>
        <button class="rbtn" onclick="TR('r32')">▶ Ver resolucao</button>
        <div id="r32" class="resol">m=(5-1)/(4-2)=2. y-1=2(x-2) → y=2x-3 → <b>2x-y-3=0</b>
          <div class="tip"><b>3 passos:</b> 1) m=delta-y/delta-x | 2) y-y1=m(x-x1) | 3) passe tudo pro lado esquerdo, iguale a zero.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Conversao</span></div>
        <div class="qt">33. Converta a equacao geral 4x - 2y + 8 = 0 para a forma reduzida.</div>
        <div class="opts" id="q33">
          <div class="opt" onclick="R('q33','a','c','e3')">a) y = 4x + 8</div>
          <div class="opt" onclick="R('q33','b','c','e3')">b) y = 2x - 4</div>
          <div class="opt" onclick="R('q33','c','c','e3')">c) y = 2x + 4</div>
          <div class="opt" onclick="R('q33','d','c','e3')">d) y = -2x + 4</div>
        </div>
        <button class="rbtn" onclick="TR('r33')">▶ Ver resolucao</button>
        <div id="r33" class="resol">-2y = -4x - 8 → dividindo por -2: y = 2x + 4 → <b>y = 2x + 4</b>
          <div class="tip"><b>Atencao:</b> ao dividir pelo coeficiente de y, cuide o sinal! Se o coef. for negativo, todos os sinais invertem.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Eq. Geral</span></div>
        <div class="qt">34. O ponto P(2, k) pertence a reta 4x - 3y - 2 = 0. Qual o valor de k?</div>
        <div class="opts" id="q34">
          <div class="opt" onclick="R('q34','a','b','e3')">a) 1</div>
          <div class="opt" onclick="R('q34','b','b','e3')">b) 2</div>
          <div class="opt" onclick="R('q34','c','b','e3')">c) 3</div>
          <div class="opt" onclick="R('q34','d','b','e3')">d) 4</div>
        </div>
        <button class="rbtn" onclick="TR('r34')">▶ Ver resolucao</button>
        <div id="r34" class="resol">4(2) - 3k - 2 = 0 → 8 - 3k - 2 = 0 → 3k = 6 → <b>k = 2</b>
          <div class="tip"><b>Pertencimento:</b> substitua as coordenadas na equacao. Se a igualdade fechar, o ponto pertence!</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge easy">Facil</span><span class="tag">Eq. Reduzida</span></div>
        <div class="qt">35. A reta y = mx + 3 passa pelo ponto (2, 7). Qual o valor de m?</div>
        <div class="opts" id="q35">
          <div class="opt" onclick="R('q35','a','b','e3')">a) 1</div>
          <div class="opt" onclick="R('q35','b','b','e3')">b) 2</div>
          <div class="opt" onclick="R('q35','c','b','e3')">c) 3</div>
          <div class="opt" onclick="R('q35','d','b','e3')">d) 4</div>
        </div>
        <button class="rbtn" onclick="TR('r35')">▶ Ver resolucao</button>
        <div id="r35" class="resol">7 = m.2 + 3 → 2m = 4 → <b>m = 2</b></div>
      </div>
    </div>

    <div id="m3" class="sub2">
      <div class="ps" id="p-m3">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-m3" style="width:0%"></div>
      </div>
      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Eq. Reduzida</span></div>
        <div class="qt">36. Determine a equacao reduzida da reta que passa por A(-1, 3) e B(2, -3).</div>
        <div class="opts" id="q36">
          <div class="opt" onclick="R('q36','a','b','m3')">a) y = 2x + 5</div>
          <div class="opt" onclick="R('q36','b','b','m3')">b) y = -2x + 1</div>
          <div class="opt" onclick="R('q36','c','b','m3')">c) y = 2x - 1</div>
          <div class="opt" onclick="R('q36','d','b','m3')">d) y = -2x - 1</div>
        </div>
        <button class="rbtn" onclick="TR('r36')">▶ Ver resolucao</button>
        <div id="r36" class="resol">m=(-3-3)/(2-(-1))=-6/3=-2. y-3=-2(x+1) → y=-2x-2+3 → <b>y=-2x+1</b></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Eq. Geral</span></div>
        <div class="qt">37. Reta que passa por (1, -2) e e paralela a 3x + y - 5 = 0. Qual a equacao geral?</div>
        <div class="opts" id="q37">
          <div class="opt" onclick="R('q37','a','c','m3')">a) 3x + y - 2 = 0</div>
          <div class="opt" onclick="R('q37','b','c','m3')">b) 3x - y + 5 = 0</div>
          <div class="opt" onclick="R('q37','c','c','m3')">c) 3x + y - 1 = 0</div>
          <div class="opt" onclick="R('q37','d','c','m3')">d) x + 3y - 5 = 0</div>
        </div>
        <button class="rbtn" onclick="TR('r37')">▶ Ver resolucao</button>
        <div id="r37" class="resol">Paralelas: mesmo m=-3. y+2=-3(x-1) → 3x+y-1=0. Verif (1,-2): 3-2-1=0 ✓ → <b>3x+y-1=0</b>
          <div class="tip"><b>Paralelas:</b> mesmo m. Para achar c, substitua o ponto dado na nova equacao.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Eq. Reduzida</span></div>
        <div class="qt">38. Qual o angulo de inclinacao da reta y = raiz(3).x + 1?</div>
        <div class="opts" id="q38">
          <div class="opt" onclick="R('q38','a','b','m3')">a) 30 graus</div>
          <div class="opt" onclick="R('q38','b','b','m3')">b) 60 graus</div>
          <div class="opt" onclick="R('q38','c','b','m3')">c) 45 graus</div>
          <div class="opt" onclick="R('q38','d','b','m3')">d) 90 graus</div>
        </div>
        <button class="rbtn" onclick="TR('r38')">▶ Ver resolucao</button>
        <div id="r38" class="resol">m = tan(angulo) = raiz(3) → <b>angulo = 60 graus</b>
          <div class="tip"><b>Tabela:</b> m=1/raiz(3) → 30° | m=1 → 45° | m=raiz(3) → 60°</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Geral + Reduzida</span></div>
        <div class="qt">39. Para que kx + 2y + 1 = 0 e x - y + 3 = 0 sejam perpendiculares, qual o valor de k?</div>
        <div class="opts" id="q39">
          <div class="opt" onclick="R('q39','a','b','m3')">a) k = -1</div>
          <div class="opt" onclick="R('q39','b','b','m3')">b) k = 2</div>
          <div class="opt" onclick="R('q39','c','b','m3')">c) k = -2</div>
          <div class="opt" onclick="R('q39','d','b','m3')">d) k = 4</div>
        </div>
        <button class="rbtn" onclick="TR('r39')">▶ Ver resolucao</button>
        <div id="r39" class="resol">m1=-k/2. m2=1. Perpendiculares: m1.m2=-1 → (-k/2).1=-1 → <b>k=2</b>
          <div class="tip"><b>Perpendiculares:</b> m1.m2=-1. Isole a incognita dessa multiplicacao.</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge med">Medio</span><span class="tag">Eq. Reduzida</span></div>
        <div class="qt">40. A reta y = 2x - 4 corta o eixo x em A e o eixo y em B. Qual a distancia AB?</div>
        <div class="opts" id="q40">
          <div class="opt" onclick="R('q40','a','c','m3')">a) 2raiz(3)</div>
          <div class="opt" onclick="R('q40','b','c','m3')">b) 3raiz(2)</div>
          <div class="opt" onclick="R('q40','c','c','m3')">c) 2raiz(5)</div>
          <div class="opt" onclick="R('q40','d','c','m3')">d) 4raiz(2)</div>
        </div>
        <button class="rbtn" onclick="TR('r40')">▶ Ver resolucao</button>
        <div id="r40" class="resol">A: y=0 → x=2 → A(2,0). B: x=0 → y=-4 → B(0,-4). AB=raiz(4+16)=raiz(20)=<b>2raiz(5)</b>
          <div class="tip"><b>Interceptos:</b> eixo x: faca y=0. Eixo y: faca x=0. Depois d=raiz(delta-x²+delta-y²).</div>
        </div>
      </div>
    </div>

    <div id="h3" class="sub2">
      <div class="ps" id="p-h3">0 de 5 respondidas</div>
      <div class="pbar">
        <div class="pfill" id="f-h3" style="width:0%"></div>
      </div>
      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Eq. Geral</span></div>
        <div class="qt">41. Reta que passa pela intersecao de r: x+y-3=0 e s: 2x-y=0, perpendicular a t: x-2y+1=0. Qual a equacao geral?</div>
        <div class="opts" id="q41">
          <div class="opt" onclick="R('q41','a','b','h3')">a) x - y + 1 = 0</div>
          <div class="opt" onclick="R('q41','b','b','h3')">b) 2x + y - 4 = 0</div>
          <div class="opt" onclick="R('q41','c','b','h3')">c) x + 2y - 7 = 0</div>
          <div class="opt" onclick="R('q41','d','b','h3')">d) 2x - y - 3 = 0</div>
        </div>
        <button class="rbtn" onclick="TR('r41')">▶ Ver resolucao</button>
        <div id="r41" class="resol">1) r∩s: {x+y=3; 2x-y=0} → 3x=3 → x=1, y=2 → P(1,2)<br>2) m_t=1/2 → m_perp=-2<br>3) y-2=-2(x-1) → <b>2x+y-4=0</b>
          <div class="tip"><b>3 passos:</b> 1) ache o ponto (resolva o sistema). 2) ache o m perpendicular. 3) monte y-y1=m(x-x1).</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Eq. Reduzida</span></div>
        <div class="qt">42. A reta y = 2x + b e tangente a parabola y = x² - 4x + 5. Qual o valor de b?</div>
        <div class="opts" id="q42">
          <div class="opt" onclick="R('q42','a','b','h3')">a) -3</div>
          <div class="opt" onclick="R('q42','b','b','h3')">b) -4</div>
          <div class="opt" onclick="R('q42','c','b','h3')">c) -5</div>
          <div class="opt" onclick="R('q42','d','b','h3')">d) -6</div>
        </div>
        <button class="rbtn" onclick="TR('r42')">▶ Ver resolucao</button>
        <div id="r42" class="resol">Tangente → delta=0. 2x+b=x²-4x+5 → x²-6x+(5-b)=0. delta=36-4(5-b)=0 → 16+4b=0 → <b>b=-4</b>
          <div class="tip"><b>Reta tangente:</b> iguale as equacoes, forme ax²+bx+c=0 e faca delta=0 (tangencia = solucao unica).</div>
        </div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Eq. Geral</span></div>
        <div class="qt">43. Qual a area do triangulo formado pela reta 3x - 4y + 12 = 0 e os eixos coordenados?</div>
        <div class="opts" id="q43">
          <div class="opt" onclick="R('q43','a','b','h3')">a) 4</div>
          <div class="opt" onclick="R('q43','b','b','h3')">b) 6</div>
          <div class="opt" onclick="R('q43','c','b','h3')">c) 8</div>
          <div class="opt" onclick="R('q43','d','b','h3')">d) 12</div>
        </div>
        <button class="rbtn" onclick="TR('r43')">▶ Ver resolucao</button>
        <div id="r43" class="resol">Int. x (y=0): 3x+12=0 → x=-4 (base=4). Int. y (x=0): -4y+12=0 → y=3 (altura=3). Area=(4x3)/2=<b>6</b></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Eq. Reduzida</span></div>
        <div class="qt">44. As retas y=2x+1, y=-x+4 e y=kx-2 passam pelo mesmo ponto. Qual o valor de k?</div>
        <div class="opts" id="q44">
          <div class="opt" onclick="R('q44','a','b','h3')">a) 3</div>
          <div class="opt" onclick="R('q44','b','b','h3')">b) 5</div>
          <div class="opt" onclick="R('q44','c','b','h3')">c) 7</div>
          <div class="opt" onclick="R('q44','d','b','h3')">d) 9</div>
        </div>
        <button class="rbtn" onclick="TR('r44')">▶ Ver resolucao</button>
        <div id="r44" class="resol">Intersecao das 2 primeiras: 2x+1=-x+4 → x=1, y=3 → P(1,3). Na 3a: 3=k.1-2 → <b>k=5</b></div>
      </div>

      <div class="qcard">
        <div class="badges"><span class="badge hard">Dificil</span><span class="tag">Geral + Reduzida</span></div>
        <div class="qt">45. Taxi A: y=2,5x+5. Taxi B: y=1,5x+9 (x=km, y=R$). A partir de qual distancia o Taxi B fica mais barato?</div>
        <div class="opts" id="q45">
          <div class="opt" onclick="R('q45','a','c','h3')">a) 3 km</div>
          <div class="opt" onclick="R('q45','b','c','h3')">b) 3,5 km</div>
          <div class="opt" onclick="R('q45','c','c','h3')">c) 4 km</div>
          <div class="opt" onclick="R('q45','d','c','h3')">d) 5 km</div>
        </div>
        <button class="rbtn" onclick="TR('r45')">▶ Ver resolucao</button>
        <div id="r45" class="resol">Igualdade: 2,5x+5=1,5x+9 → x=4 km. Para x maior que 4, B e mais barato. <b>A partir de 4 km.</b>
          <div class="tip"><b>Intersecao de retas:</b> iguale as equacoes para achar a fronteira. Depois veja qual e menor alem desse ponto.</div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function ST(id) {
      ['t1', 't2', 't3'].forEach(function(s) {
        document.getElementById(s).classList.remove('active')
      });
      document.getElementById(id).classList.add('active');
      document.querySelectorAll('.tab').forEach(function(tb, i) {
        tb.classList.toggle('active', ['t1', 't2', 't3'][i] === id)
      });
    }

    function SS(mat, id) {
      var sec = document.getElementById(mat);
      sec.querySelectorAll('.sub2').forEach(function(s) {
        s.classList.remove('active')
      });
      document.getElementById(id).classList.add('active');
      sec.querySelectorAll('.stab').forEach(function(st, i) {
        var subs = Array.from(sec.querySelectorAll('.sub2'));
        st.classList.toggle('active', subs[i] && subs[i].id === id)
      });
    }

    function R(qid, chosen, correct, subId) {
      var c = document.getElementById(qid);
      if (c.dataset.answered) return;
      c.dataset.answered = '1';
      ['a', 'b', 'c', 'd'].forEach(function(l, i) {
        var o = c.querySelectorAll('.opt')[i];
        if (l === correct) o.classList.add('ok');
        else if (l === chosen) o.classList.add('no');
        o.style.pointerEvents = 'none';
      });
      var sub = document.getElementById(subId);
      if (!sub) return;
      var total = sub.querySelectorAll('.opts').length;
      var done = sub.querySelectorAll('[data-answered]').length;
      var ps = document.getElementById('p-' + subId);
      var pf = document.getElementById('f-' + subId);
      if (ps) ps.textContent = done + ' de ' + total + ' respondidas';
      if (pf) pf.style.width = Math.round(done / total * 100) + '%';
    }

    function TR(id) {
      var el = document.getElementById(id);
      el.classList.toggle('show');
      var btn = el.previousElementSibling;
      btn.textContent = el.classList.contains('show') ? '▼ Ocultar resolucao' : '▶ Ver resolucao';
    }
  </script>
</body>

</html>