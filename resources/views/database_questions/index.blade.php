@extends('layouts.bq')

@section('content')

    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <div style="display:flex;flex-direction:column;height:100%;position:relative;z-index:1;">

        <!-- FILTER BAR -->
        <div
            style="display:flex;align-items:center;gap:8px;padding:10px 24px;flex-shrink:0;overflow-x:auto;border-bottom:1px solid var(--ld);">
            <span
                style="font-size:0.58rem;color:var(--md);font-family:var(--fb);white-space:nowrap;margin-right:4px;">Filtrar:</span>
            @foreach(['Todos', 'Matemática', 'Física', 'Química', 'Biologia', 'Linguagens', 'Humanas', 'Tecnologia', 'Redação'] as $fi => $f)
                <button class="filter-tab {{ $fi === 0 ? 'active' : '' }}" data-filter="{{ $f }}">{{ $f }}</button>
            @endforeach
        </div>

        <!-- CONTENT -->
        <div style="flex:1;overflow-y:auto;padding:28px 28px 40px;">

            <!-- No results -->
            <div id="no-results"
                style="display:none;flex-direction:column;align-items:center;justify-content:center;height:240px;gap:12px;">
                <svg width="40" height="40" fill="none" stroke="#334155" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <p style="font-size:0.78rem;color:#475569;">Nenhum resultado para "<span id="no-results-term"
                        style="color:#ec4899;"></span>"</p>
            </div>

            <div id="sections-wrapper" style="display:flex;flex-direction:column;gap:36px;">

                @php $sections = [
                    [
                        'area' => 'matematica',
                        'label' => 'Matemática',
                        'sublabel' => 'Exatas',
                        'icon_color' => '#ec4899',
                        'bg_color' => 'rgba(236,72,153,0.12)',
                        'border_color' => 'rgba(236,72,153,0.22)',
                        'badge_color' => 'rgba(236,72,153,0.1)',
                        'dot_color' => '#ec4899',
                        'dot_shadow' => 'rgba(236,72,153,0.5)',
                        'hover_color' => '236,72,153',
                        'icon_path' => 'M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4',
                        'cards' => [
                            ['Álgebra', 'Equações, inequações, polinômios e expressões algébricas', 'Médio'],
                            ['Geometria Plana', 'Áreas, perímetros, ângulos e figuras planas', 'Fácil'],
                            ['Geometria Espacial', 'Sólidos, volumes e superfícies tridimensionais', 'Difícil'],
                            ['Trigonometria', 'Seno, cosseno, tangente e identidades trigonométricas', 'Médio'],
                            ['Funções', 'Funções de 1°, 2° grau, exponencial e logarítmica', 'Médio'],
                            ['Probabilidade', 'Eventos, combinatória e distribuições de probabilidade', 'Difícil'],
                            ['Estatística', 'Média, mediana, moda, desvio padrão e análise de dados', 'Fácil'],
                            ['Matrizes e Determinantes', 'Operações matriciais, sistemas lineares e escalonamento', 'Difícil'],
                            ['Progressões', 'PA, PG, somas e termos gerais de progressões', 'Médio'],
                            ['Números Complexos', 'Forma algébrica, trigonométrica e operações no plano de Argand', 'Difícil'],
                            ['Contagem e Combinatória', 'Princípio multiplicativo, permutações e combinações', 'Médio'],
                            ['Logaritmos', 'Propriedades, equações e inequações logarítmicas', 'Médio'],
                        ],
                    ],
                    [
                        'area' => 'natureza',
                        'label' => 'Ciências da Natureza',
                        'sublabel' => 'Física · Química · Biologia',
                        'icon_color' => '#34d399',
                        'bg_color' => 'rgba(52,211,153,0.12)',
                        'border_color' => 'rgba(52,211,153,0.22)',
                        'badge_color' => 'rgba(52,211,153,0.08)',
                        'dot_color' => '#34d399',
                        'dot_shadow' => 'rgba(52,211,153,0.5)',
                        'hover_color' => '52,211,153',
                        'icon_path' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                        'cards' => [
                            ['Mecânica Clássica', 'Cinemática, dinâmica, leis de Newton, trabalho e energia', 'Médio'],
                            ['Eletromagnetismo', 'Campos elétricos, magnéticos, circuitos e ondas EM', 'Difícil'],
                            ['Termodinâmica', 'Calor, temperatura, leis termodinâmicas e motores', 'Médio'],
                            ['Óptica Geométrica', 'Reflexão, refração, lentes, espelhos e instrumentos ópticos', 'Fácil'],
                            ['Ondas e Som', 'Características de ondas, efeito Doppler e acústica', 'Médio'],
                            ['Física Moderna', 'Relatividade, fotoelétrico, modelos atômicos e radioatividade', 'Difícil'],
                            ['Química Geral', 'Tabela periódica, ligações, soluções e estequiometria', 'Médio'],
                            ['Química Orgânica', 'Hidrocarbonetos, funções orgânicas e reações', 'Difícil'],
                            ['Eletroquímica', 'Células galvânicas, eletrólise e potenciais de redução', 'Difícil'],
                            ['Biologia Celular', 'Organelas, divisão celular, membrana e metabolismo', 'Médio'],
                            ['Genética', 'Hereditariedade, DNA, RNA, mutações e biotecnologia', 'Difícil'],
                            ['Ecologia', 'Ecossistemas, cadeias alimentares, biomas e sustentabilidade', 'Fácil'],
                            ['Evolução', 'Teorias evolutivas, seleção natural e especiação', 'Médio'],
                            ['Fisiologia Humana', 'Sistemas digestório, circulatório, nervoso e endócrino', 'Médio'],
                            ['Botânica', 'Morfologia, fisiologia vegetal, fotossíntese e reprodução', 'Fácil'],
                        ],
                    ],
                    [
                        'area' => 'linguagens',
                        'label' => 'Linguagens',
                        'sublabel' => 'Comunicação e Expressão',
                        'icon_color' => '#fbbf24',
                        'bg_color' => 'rgba(251,191,36,0.12)',
                        'border_color' => 'rgba(251,191,36,0.22)',
                        'badge_color' => 'rgba(251,191,36,0.08)',
                        'dot_color' => '#fbbf24',
                        'dot_shadow' => 'rgba(251,191,36,0.5)',
                        'hover_color' => '251,191,36',
                        'icon_path' => 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z',
                        'cards' => [
                            ['Gramática', 'Morfologia, sintaxe, concordância verbal e nominal', 'Médio'],
                            ['Literatura Brasileira', 'Movimentos literários, autores e obras nacionais', 'Médio'],
                            ['Literatura Portuguesa', 'Classicismo, romantismo e modernismo em Portugal', 'Médio'],
                            ['Interpretação de Texto', 'Leitura crítica, inferências e coerência textual', 'Fácil'],
                            ['Produção Textual', 'Gêneros textuais, coesão e coerência na escrita', 'Médio'],
                            ['Inglês — Gramática', 'Tempos verbais, preposições e estruturas gramaticais', 'Médio'],
                            ['Inglês — Vocabulário', 'Phrasal verbs, collocations e expressões idiomáticas', 'Difícil'],
                            ['Espanhol', 'Estruturas básicas, verbos irregulares e vocabulário', 'Fácil'],
                            ['Redação Argumentativa', 'Dissertação, proposta de intervenção e repertório cultural', 'Difícil'],
                            ['Semântica e Pragmática', 'Significado, ambiguidade, ironia e atos de fala', 'Difícil'],
                            ['Figuras de Linguagem', 'Metáfora, metonímia, hipérbole e outras figuras', 'Fácil'],
                        ],
                    ],
                    [
                        'area' => 'humanas',
                        'label' => 'Ciências Humanas',
                        'sublabel' => 'História · Geografia · Filosofia',
                        'icon_color' => '#818cf8',
                        'bg_color' => 'rgba(129,140,248,0.12)',
                        'border_color' => 'rgba(129,140,248,0.22)',
                        'badge_color' => 'rgba(129,140,248,0.08)',
                        'dot_color' => '#818cf8',
                        'dot_shadow' => 'rgba(129,140,248,0.5)',
                        'hover_color' => '129,140,248',
                        'icon_path' => 'M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064',
                        'cards' => [
                            ['História do Brasil', 'Colonização, independência, república e história contemporânea', 'Médio'],
                            ['História Antiga', 'Mesopotâmia, Egito, Grécia e Roma', 'Médio'],
                            ['História Medieval', 'Feudalismo, Cruzadas, Igreja e Baixa Idade Média', 'Fácil'],
                            ['História Moderna', 'Renascimento, Reformas, Absolutismo e Iluminismo', 'Médio'],
                            ['História Contemporânea', 'Guerras Mundiais, Guerra Fria e globalização', 'Difícil'],
                            ['Geografia Física', 'Relevo, clima, hidrografia, solos e dinâmica interna', 'Fácil'],
                            ['Geografia Humana', 'Urbanização, migração, populações e geopolítica', 'Médio'],
                            ['Geopolítica', 'Blocos econômicos, conflitos atuais e relações internacionais', 'Difícil'],
                            ['Sociologia', 'Estruturas sociais, estratificação, movimentos e instituições', 'Médio'],
                            ['Filosofia — Ética', 'Teorias éticas, moral, direitos humanos e cidadania', 'Médio'],
                            ['Filosofia — Epistemologia', 'Teoria do conhecimento, razão e empirismo', 'Difícil'],
                            ['Filosofia Política', 'Contratualistas, Estado, democracia e liberalismo', 'Difícil'],
                        ],
                    ],
                    [
                        'area' => 'tecnologia',
                        'label' => 'Tecnologia',
                        'sublabel' => 'Computação & Digital',
                        'icon_color' => '#38bdf8',
                        'bg_color' => 'rgba(56,189,248,0.12)',
                        'border_color' => 'rgba(56,189,248,0.22)',
                        'badge_color' => 'rgba(56,189,248,0.08)',
                        'dot_color' => '#38bdf8',
                        'dot_shadow' => 'rgba(56,189,248,0.5)',
                        'hover_color' => '56,189,248',
                        'icon_path' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                        'cards' => [
                            ['Algoritmos e Lógica', 'Pseudocódigo, fluxogramas, complexidade e depuração', 'Fácil'],
                            ['Estruturas de Dados', 'Arrays, listas, pilhas, filas, árvores e grafos', 'Difícil'],
                            ['Programação Web', 'HTML, CSS, JavaScript e desenvolvimento frontend', 'Médio'],
                            ['Backend & APIs', 'REST, autenticação, servidores e arquitetura de APIs', 'Difícil'],
                            ['Banco de Dados', 'SQL, modelagem relacional, consultas e NoSQL', 'Médio'],
                            ['Redes de Computadores', 'TCP/IP, HTTP, DNS, segurança e arquiteturas de rede', 'Difícil'],
                            ['Inteligência Artificial', 'Machine learning, redes neurais, NLP e IA generativa', 'Difícil'],
                            ['Segurança da Informação', 'Criptografia, vulnerabilidades, OWASP e boas práticas', 'Difícil'],
                            ['Sistemas Operacionais', 'Processos, memória, sistemas de arquivos e shell Linux', 'Médio'],
                            ['Cloud Computing', 'AWS, Azure, GCP, containers e orquestração com K8s', 'Difícil'],
                        ],
                    ],
                    [
                        'area' => 'redacao',
                        'label' => 'Redação',
                        'sublabel' => 'Escrita e Argumentação',
                        'icon_color' => '#f87171',
                        'bg_color' => 'rgba(248,113,113,0.12)',
                        'border_color' => 'rgba(248,113,113,0.22)',
                        'badge_color' => 'rgba(248,113,113,0.08)',
                        'dot_color' => '#f87171',
                        'dot_shadow' => 'rgba(248,113,113,0.5)',
                        'hover_color' => '248,113,113',
                        'icon_path' => 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                        'cards' => [
                            ['Estrutura da Dissertação', 'Introdução, desenvolvimento, conclusão e proposta de intervenção', 'Fácil'],
                            ['Repertório Cultural', 'Como usar citações, filmes, dados e contextos históricos', 'Médio'],
                            ['Coesão e Coerência', 'Conectivos, progressão temática e unidade de sentido', 'Médio'],
                            ['Argumentação', 'Tipos de argumento, contra-argumento e falhas lógicas', 'Difícil'],
                            ['Temas do ENEM', 'Análise dos temas recorrentes e como abordá-los com repertório', 'Médio'],
                            ['Proposta de Intervenção', 'Agente, ação, modo, efeito e detalhamento da solução', 'Difícil'],
                        ],
                    ],
                ]; @endphp

                    @foreach($sections as $sidx => $section)
                        @if($sidx > 0)
                            <div class="section-divider" style="height:1px;background:var(--ld);"></div>
                        @endif

                        <section class="area-section anim-fade-up" data-area="{{ $section['area'] }}"
                                 style="animation-delay:{{ $sidx * 0.07 }}s;">

                            {{-- Section header --}}
                            <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px;">
                                <div style="width:36px;height:36px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;background:{{ $section['bg_color'] }};border:1px solid {{ $section['border_color'] }};">
                                    <svg width="16" height="16" fill="none" stroke="{{ $section['icon_color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $section['icon_path'] }}"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 style="font-family:var(--fh);font-size:0.72rem;font-weight:900;color:var(--white);letter-spacing:-0.01em;">{{ $section['label'] }}</h2>
                                    <p style="font-size:0.58rem;color:var(--md);margin-top:1px;">{{ $section['sublabel'] }}</p>
                                </div>
                                <div style="margin-left:auto;padding:3px 12px;border-radius:100px;background:{{ $section['badge_color'] }};border:1px solid {{ $section['border_color'] }};">
                                    <span class="badge-count" style="font-family:var(--fh);font-size:0.48rem;font-weight:700;color:{{ $section['icon_color'] }};letter-spacing:0.08em;">{{ count($section['cards']) }} tópicos</span>
                                </div>
                            </div>

                            {{-- Cards grid --}}
                            <div class="content-grid" data-color="{{ $section['hover_color'] }}"
                                 style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:12px;">
                                @foreach($section['cards'] as $card)
                                    @php $slug = Str::slug($card[0]); @endphp
                                    <div class="content-card"
                                         data-title="{{ $card[0] }}"
                                         data-slug="{{ $slug }}"
                                         data-area="{{ $section['area'] }}"
                                         style="border-radius:14px;padding:16px 18px;cursor:pointer;background:rgba(255,255,255,0.025);border:1px solid rgba(255,255,255,0.06);">

                                        {{-- Top row: dot + difficulty + arrow --}}
                                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                                            <div style="display:flex;align-items:center;gap:8px;">
                                                <div style="width:7px;height:7px;border-radius:50%;background:{{ $section['dot_color'] }};box-shadow:0 0 6px {{ $section['dot_shadow'] }};flex-shrink:0;"></div>
                                                <span class="difficulty-tag"
                                                      style="background:{{ $card[2] === 'Fácil' ? 'rgba(34,197,94,0.1)' : ($card[2] === 'Difícil' ? 'rgba(248,113,113,0.1)' : 'rgba(251,191,36,0.1)') }};
                                                             color:{{ $card[2] === 'Fácil' ? '#4ade80' : ($card[2] === 'Difícil' ? '#f87171' : '#fbbf24') }};
                                                             border:1px solid {{ $card[2] === 'Fácil' ? 'rgba(34,197,94,0.2)' : ($card[2] === 'Difícil' ? 'rgba(248,113,113,0.2)' : 'rgba(251,191,36,0.2)') }};">
                                                    {{ $card[2] }}
                                                </span>
                                            </div>
                                            <svg class="card-arrow" width="14" height="14" fill="none" stroke="#334155" stroke-width="2" viewBox="0 0 24 24" style="flex-shrink:0;transition:color 0.18s;">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                                            </svg>
                                        </div>

                                        <h3 style="font-size:0.78rem;font-weight:700;color:var(--white);margin-bottom:6px;line-height:1.3;font-family:var(--fh);letter-spacing:-0.01em;">{{ $card[0] }}</h3>
                                        <p style="font-size:0.62rem;color:var(--md);line-height:1.65;">{{ $card[1] }}</p>
                                    </div>
                                @endforeach
                            </div>

                        </section>
                    @endforeach

                </div>
            </div>
        </div>

@endsection