// Natan que bagulho insuportavel!!!!


const API_URL = "http://127.0.0.1:8000/api/subjects";

function authHeaders(extra = {}) {
  const token = localStorage.getItem('auth_token');
  return {
    "Accept": "application/json",
    "Authorization": `Bearer ${token}`,
    ...extra,
  };
}


const KNOWN_NAMES = [

  'Português','Literatura','Redação','Matemática','Física','Química',
  'Biologia','História','Geografia','Filosofia','Sociologia','Inglês',
  'Espanhol','Arte','Educação Física','Informática',

  'Cálculo I','Cálculo II','Cálculo III','Álgebra Linear',
  'Física I','Física II','Química Geral','Biologia Celular',
  'Programação I','Programação II','Estrutura de Dados','Banco de Dados',
  'Redes de Computadores','Sistemas Operacionais','Engenharia de Software',
  'Inteligência Artificial','Estatística','Probabilidade',
  'Português Instrumental','Inglês Técnico','Administração',
  'Contabilidade','Direito','Economia','Marketing',
];

const KNOWN_CODES = [

  'PORT','LIT','RED','MAT','FIS','QUI','BIO','HIS','GEO',
  'FIL','SOC','ING','ESP','ART','EDF','INF',

  'CAL1','CAL2','CAL3','ALG','FIS1','FIS2','QUIG','BIOC',
  'PRG1','PRG2','ED','BD','RC','SO','ES','IA','EST','PRB',
  'ADM','CONT','DIR','ECO','MKT',
];


document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('subjectsTable')) initIndex();
  if (document.getElementById('subjectForm'))   initForm();
});


function initIndex() {
  fetchSubjects();
}

async function fetchSubjects() {
  try {
    const res = await fetch(API_URL, { headers: authHeaders() });

    if (!res.ok) throw new Error(`HTTP ${res.status}`);

    const subjects = await res.json();
    renderSubjects(subjects);
  } catch (e) {
    console.error('Erro ao carregar matérias:', e);
    showTableError();
  }
}

function initials(name) {
  return (name || '?').trim().split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase();
}

const AVATAR_COLORS = ['#db2777','#7c3aed','#0891b2','#059669','#d97706','#be185d'];

function renderSubjects(subjects) {
  const tbody  = document.getElementById('subjectsTable');
  const total  = document.getElementById('totalCount');
  const profEl = document.getElementById('profCount');

  if (total)  total.textContent  = subjects.length;
  if (profEl) profEl.textContent = subjects.length
    ? new Set(subjects.map(s => s.teacher)).size : 0;

  if (!subjects.length) {
    tbody.innerHTML = emptyState('📚', 'Nenhuma matéria cadastrada', 'Clique em "Adicionar matéria" para começar.');
    return;
  }

  tbody.innerHTML = subjects.map((s, i) => {
    const color = AVATAR_COLORS[i % AVATAR_COLORS.length];
    return `
      <tr>
        <td class="px-6 py-4 text-center font-800 text-gray-900 text-sm">${s.name}</td>
        <td class="px-4 py-4 text-center">
          <span class="inline-block bg-gray-100 text-gray-500 text-xs font-700 tracking-wide px-2.5 py-1 rounded-lg">
            ${s.abbreviation}
          </span>
        </td>
        <td class="px-4 py-4 text-center">
          <div class="flex items-center justify-center gap-2.5">
            <div class="w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-800 text-white shrink-0"
                 style="background:${color}">
              ${initials(s.teacher)}
            </div>
            <span class="text-sm text-gray-600">${s.teacher}</span>
          </div>
        </td>
        <td class="px-4 py-4 text-center">
          <span class="inline-flex items-center gap-1.5 bg-pink-50 text-pink-700 text-xs font-700 px-2.5 py-1 rounded-full">
            <span class="w-1.5 h-1.5 rounded-full bg-pink-400 inline-block"></span>
            ${s.semester}º sem.
          </span>
        </td>
        <td class="px-4 py-4 text-center">
          <div class="inline-flex gap-1.5 justify-center">
            <a href="/subjects/edit/${s.id}"
               class="inline-flex items-center gap-1 bg-pink-50 hover:bg-pink-100 text-pink-600 font-700 text-xs px-3 py-1.5 rounded-lg transition-colors">
              <img src="${editIcon}" class="w-3.5 h-3.5 opacity-60"> Editar
            </a>
            <button onclick="deleteSubject(${s.id})"
               class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-500 font-700 text-xs px-3 py-1.5 rounded-lg transition-colors cursor-pointer border-0">
              <img src="${deleteIcon}" class="w-3.5 h-3.5 opacity-60"> Excluir
            </button>
          </div>
        </td>
      </tr>`;
  }).join('');
}

function showTableError() {
  const tbody = document.getElementById('subjectsTable');
  if (tbody) tbody.innerHTML = emptyState('⚠️', 'Erro ao carregar', 'Verifique sua conexão e recarregue.');
}

function emptyState(icon, title, sub) {
  return `<tr><td colspan="5">
    <div class="flex flex-col items-center justify-center py-16 gap-2">
      <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl mb-1">${icon}</div>
      <p class="text-gray-700 font-700 text-sm">${title}</p>
      <p class="text-gray-400 text-xs">${sub}</p>
    </div>
  </td></tr>`;
}




async function deleteSubject(id) {
  if (!confirm('Deseja realmente excluir esta matéria?')) return;
  try {
    const res = await fetch(`${API_URL}/${id}`, {
      method: 'DELETE',
      headers: authHeaders(),
    });
    if (res.ok) fetchSubjects();
    else {
      const data = await res.json().catch(() => ({}));
      alert(data.message || 'Erro ao excluir.');
    }
  } catch (e) {
    console.error(e);
    alert('Erro de conexão.');
  }
}


function initForm() {
  initSelectExtras();

  const form   = document.getElementById('subjectForm');
  const isEdit = !!form?.dataset.id;

  if (isEdit) {
    prefillForm({
      name:         form.dataset.name,
      abbreviation: form.dataset.abbreviation,
      teacher:      form.dataset.teacher,
      semester:     form.dataset.semester,
    });
  }

 
  const abbrCustom = document.getElementById('abbreviation_custom');
  abbrCustom?.addEventListener('input', () => {
    const p = abbrCustom.selectionStart;
    abbrCustom.value = abbrCustom.value.toUpperCase();
    abbrCustom.setSelectionRange(p, p);
  });

  ['name', 'abbreviation', 'teacher', 'semester'].forEach(id => {
    document.getElementById(id)?.addEventListener('change', () => clearErr(id));
    document.getElementById(id + '_custom')?.addEventListener('input', () => clearErr(id));
  });
  document.getElementById('teacher')?.addEventListener('input', () => clearErr('teacher'));


  form?.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (!validateForm()) return;

    const btn   = document.getElementById('submitBtn');
    const label = document.getElementById('btnLabel');
    btn.disabled = true;
    label.textContent = 'Salvando...';

    const payload = buildPayload();

    try {
      const url    = isEdit ? `${API_URL}/${form.dataset.id}` : API_URL;
      const method = isEdit ? 'PUT' : 'POST';

      const res = await fetch(url, {
        method,
        headers: authHeaders({ 'Content-Type': 'application/json' }),
        body: JSON.stringify(payload),
      });

      if (res.ok || res.status === 201) {
        showToast();
        setTimeout(() => window.location.href = '/subjects', 1800);
      } else {
        const data = await res.json();
        if (data.errors) {
          Object.entries(data.errors).forEach(([f, m]) => showErr(f, m[0]));
        } else {
          alert(data.message || 'Erro ao salvar.');
        }
        btn.disabled = false;
        label.textContent = isEdit ? 'Salvar alterações' : 'Salvar matéria';
      }
    } catch (err) {
      console.error(err);
      alert('Erro de conexão.');
      btn.disabled = false;
      label.textContent = isEdit ? 'Salvar alterações' : 'Salvar matéria';
    }
  });


  document.getElementById('deleteBtn')?.addEventListener('click', () => {
    document.getElementById('deleteModal')?.classList.remove('hidden');
  });

  document.getElementById('confirmDelete')?.addEventListener('click', async () => {
    const id = form?.dataset.id;
    if (!id) return;
    try {
      const res = await fetch(`${API_URL}/${id}`, {
        method: 'DELETE',
        headers: authHeaders(),
      });
      if (res.ok) window.location.href = '/subjects';
      else alert('Erro ao excluir.');
    } catch (e) { console.error(e); }
  });

  document.getElementById('cancelDelete')?.addEventListener('click', () => {
    document.getElementById('deleteModal')?.classList.add('hidden');
  });
}



function initSelectExtras() {
  [
    { selectId: 'name',         extraId: 'extra-name' },
    { selectId: 'abbreviation', extraId: 'extra-abbreviation' },
    { selectId: 'semester',     extraId: 'extra-semester' },
  ].forEach(({ selectId, extraId }) => {
    const sel   = document.getElementById(selectId);
    const extra = document.getElementById(extraId);
    if (!sel || !extra) return;
    sel.addEventListener('change', () => {
      extra.classList.toggle('show', sel.value === 'outro');
    });
  });
}


function prefillForm({ name, abbreviation, teacher, semester }) {
  setSelectOrCustom('name',         'extra-name',         'name_custom',         name,         KNOWN_NAMES);
  setSelectOrCustom('abbreviation', 'extra-abbreviation', 'abbreviation_custom', abbreviation, KNOWN_CODES);
  setSelectOrCustom('semester',     'extra-semester',     'semester_custom',     semester,
    ['1','2','3','4','5','6','7','8','9','10']);

  const t = document.getElementById('teacher');
  if (t) t.value = teacher || '';
}

function setSelectOrCustom(selectId, extraId, customId, value, knownValues) {
  const sel    = document.getElementById(selectId);
  const extra  = document.getElementById(extraId);
  const custom = document.getElementById(customId);
  if (!sel) return;

  if (knownValues.includes(String(value))) {
    sel.value = value;
  } else if (value) {
    sel.value = 'outro';
    extra?.classList.add('show');
    if (custom) custom.value = value;
  }
}


function buildPayload() {
  return {
    name:         resolveSelectValue('name',         'name_custom'),
    abbreviation: resolveSelectValue('abbreviation', 'abbreviation_custom'),
    teacher:      document.getElementById('teacher')?.value.trim(),
    semester:     parseInt(resolveSelectValue('semester', 'semester_custom')),
  };
}

function resolveSelectValue(selectId, customId) {
  const sel = document.getElementById(selectId);
  if (!sel) return '';
  return sel.value === 'outro'
    ? (document.getElementById(customId)?.value.trim() || '')
    : sel.value;
}


function validateForm() {
  let ok = true;
  const name     = resolveSelectValue('name',         'name_custom');
  const abbr     = resolveSelectValue('abbreviation', 'abbreviation_custom');
  const teacher  = document.getElementById('teacher')?.value.trim();
  const semester = resolveSelectValue('semester',     'semester_custom');

  if (!name)    { showErr('name',         'Selecione ou informe a matéria.'); ok = false; }
  if (!abbr)    { showErr('abbreviation', 'Selecione ou informe o código.');  ok = false; }
  if (!teacher) { showErr('teacher',      'Informe o professor.');            ok = false; }
  if (!semester || isNaN(parseInt(semester)) || parseInt(semester) < 1)
                { showErr('semester',     'Selecione ou informe o semestre.'); ok = false; }
  return ok;
}


function showErr(id, msg) {
  document.getElementById(id)?.classList.add('is-error');
  const e = document.getElementById('err-' + id);
  if (e) { if (msg) e.textContent = msg; e.classList.add('show'); }
}

function clearErr(id) {
  document.getElementById(id)?.classList.remove('is-error');
  document.getElementById('err-' + id)?.classList.remove('show');
}

function showToast() {
  const t = document.getElementById('toast');
  if (!t) return;
  t.classList.remove('hidden');
  setTimeout(() => t.classList.add('hidden'), 3000);
}