const API   = '/api/exams';
const TOKEN = () => localStorage.getItem('auth_token');

const PAGE = (() => {
  const p = location.pathname;
  if (p.includes('/create'))      return 'create';
  if (p.match(/\/exams\/edit\//)) return 'edit';
  return 'index';
})();

function authHeaders() {
  return { 'Content-Type': 'application/json', 'Accept': 'application/json', 'Authorization': `Bearer ${TOKEN()}` };
}

function showToast(msg) {
  const t = document.getElementById('toast');
  if (!t) return;
  const p = t.querySelector('p');
  if (p && msg) p.textContent = msg;
  t.style.display = 'flex';
  setTimeout(() => { t.style.display = 'none'; }, 3000);
}

function showModal(id) {
  const m = document.getElementById(id);
  if (m) m.style.display = 'flex';
}

function hideModal(id) {
  const m = document.getElementById(id);
  if (m) m.style.display = 'none';
}

function formatDate(dateStr) {
  if (!dateStr) return '—';
  const [y, m, d] = dateStr.split('-');
  return `${d}/${m}/${y}`;
}

function statusBadge(status) {
  const map = {
    pending:     { bg: 'bg-red-100', text: 'text-yellow-800', label: '❌ Dificil' },
    in_progress: { bg: 'bg-green-100',   text: 'text-blue-800',   label: '✅Facil' },
    completed:   { bg: 'bg-yellow-100',  text: 'text-green-800',  label: '❗ Medio' },
  };
  const s = map[status] || map.pending;
  return `<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold ${s.bg} ${s.text}">${s.label}</span>`;
}

function setError(id, msg) {
  const el  = document.getElementById(id);
  const err = document.getElementById('err-' + id);
  if (el)  el.classList.add('border-red-400', 'focus:border-red-400');
  if (err) {
    if (msg) err.textContent = msg;
    err.classList.remove('hidden');
  }
}

function clearError(id) {
  const el  = document.getElementById(id);
  const err = document.getElementById('err-' + id);
  if (el)  el.classList.remove('border-red-400', 'focus:border-red-400');
  if (err) err.classList.add('hidden');
}

function clearAllErrors() {
  ['type', 'description', 'due_date', 'status'].forEach(clearError);
}

function bindSelectOther(selectId, extraId) {
  const sel   = document.getElementById(selectId);
  const extra = document.getElementById(extraId);
  if (!sel || !extra) return;
  sel.addEventListener('change', () => {
    if (sel.value === 'outro') {
      extra.classList.remove('hidden');
      extra.querySelector('input')?.focus();
    } else {
      extra.classList.add('hidden');
    }
    clearError(selectId);
  });
}

function getFieldValue(selectId, customId) {
  const sel = document.getElementById(selectId);
  if (!sel) return '';
  if (sel.value === 'outro' && customId) {
    return (document.getElementById(customId)?.value || '').trim();
  }
  return sel.value;
}

function prefillSelect(selectId, value, extraId, customId) {
  if (!value) return;
  const sel   = document.getElementById(selectId);
  const extra = document.getElementById(extraId);
  const cust  = document.getElementById(customId);
  if (!sel) return;
  const exists = [...sel.options].some(o => o.value === value);
  if (exists) {
    sel.value = value;
  } else {
    sel.value = 'outro';
    if (extra) extra.classList.remove('hidden');
    if (cust)  cust.value = value;
  }
}

/* ══════════════════════════════════════
   INDEX
══════════════════════════════════════ */
async function initIndex() {
  await loadExams();

  let deleteId = null;

  document.getElementById('cancelDelete')?.addEventListener('click', () => hideModal('deleteModal'));

  document.getElementById('confirmDelete')?.addEventListener('click', async () => {
    if (!deleteId) return;
    const btn = document.getElementById('confirmDelete');
    btn.textContent = 'Excluindo...';
    btn.disabled = true;
    try {
      const r = await fetch(`${API}/${deleteId}`, { method: 'DELETE', headers: authHeaders() });
      if (!r.ok) throw new Error();
      hideModal('deleteModal');
      showToast('Prova excluída!');
      await loadExams();
    } catch {
      alert('Erro ao excluir. Tente novamente.');
    } finally {
      btn.textContent = 'Sim, excluir';
      btn.disabled = false;
    }
  });

  document.getElementById('examsTable')?.addEventListener('click', e => {
    const del  = e.target.closest('[data-delete]');
    const edit = e.target.closest('[data-edit]');
    if (del)  { deleteId = del.dataset.delete; showModal('deleteModal'); }
    if (edit) { location.href = `/exams/edit/${edit.dataset.edit}`; }
  });
}

async function loadExams() {
  try {
    const r = await fetch(API, { headers: authHeaders() });
    if (!r.ok) throw new Error();
    const exams = await r.json();
    renderTable(exams);
    renderStats(exams);
  } catch {
    document.getElementById('examsTable').innerHTML =
      `<tr><td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">Erro ao carregar provas. Tente novamente.</td></tr>`;
  }
}

function renderStats(exams) {
  document.getElementById('totalCount').textContent     = exams.length;
  document.getElementById('pendingCount').textContent   = exams.filter(e => e.status === 'pending').length;
  document.getElementById('progressCount').textContent  = exams.filter(e => e.status === 'in_progress').length;
  document.getElementById('completedCount').textContent = exams.filter(e => e.status === 'completed').length;
}

function renderTable(exams) {
  const tbody = document.getElementById('examsTable');
  if (!exams.length) {
    tbody.innerHTML = `
      <tr><td colspan="5" class="px-6 py-14 text-center">
        <div class="flex flex-col items-center gap-3">
          <span class="text-4xl">📝</span>
          <p class="text-gray-400 text-sm font-semibold">Nenhuma prova cadastrada ainda.</p>
          <a href="/exams/create" class="text-pink-500 text-sm font-bold hover:underline">+ Adicionar primeira prova</a>
        </div>
      </td></tr>`;
    return;
  }
  tbody.innerHTML = exams.map(exam => `
    <tr class="border-b border-gray-50 hover:bg-pink-50/30 transition-colors">
      <td class="px-6 py-4 text-center">
        <span class="text-sm font-semibold text-gray-800">${exam.type}</span>
      </td>
      <td class="px-4 py-4 text-center max-w-xs">
        <span class="text-sm text-gray-500">${exam.description}</span>
      </td>
      <td class="px-4 py-4 text-center">
        <span class="text-sm font-semibold text-gray-700">${formatDate(exam.due_date)}</span>
      </td>
      <td class="px-4 py-4 text-center">${statusBadge(exam.status)}</td>
      <td class="px-4 py-4 text-center">
        <div class="flex items-center justify-center gap-2">
          <button data-edit="${exam.id}" class="inline-flex items-center gap-1 text-xs font-bold text-pink-500 hover:text-pink-700 border border-pink-200 hover:border-pink-400 px-3 py-1.5 rounded-lg transition-colors">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
            Editar
          </button>
          <button data-delete="${exam.id}" class="inline-flex items-center gap-1 text-xs font-bold text-red-400 hover:text-red-600 border border-red-100 hover:border-red-300 px-3 py-1.5 rounded-lg transition-colors">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="3 6 5 6 21 6"/>
              <path d="M19 6l-1 14H6L5 6"/>
            </svg>
            Excluir
          </button>
        </div>
      </td>
    </tr>
  `).join('');
}

/* ══════════════════════════════════════
   CREATE
══════════════════════════════════════ */
function initCreate() {
  bindSelectOther('type', 'extra-type');

  ['type', 'description', 'due_date', 'status'].forEach(id => {
    document.getElementById(id)?.addEventListener('input',  () => clearError(id));
    document.getElementById(id)?.addEventListener('change', () => clearError(id));
  });

  const form  = document.getElementById('examForm');
  const btn   = document.getElementById('submitBtn');
  const label = document.getElementById('btnLabel');

  form?.addEventListener('submit', async e => {
    e.preventDefault();
    if (btn.disabled) return;
    clearAllErrors();

    const type        = getFieldValue('type', 'type_custom');
    const description = (document.getElementById('description')?.value || '').trim();
    const due_date    = document.getElementById('due_date')?.value || '';
    const status      = document.getElementById('status')?.value || '';

    let valid = true;
    if (!type)        { setError('type',        'Selecione ou informe o tipo.'); valid = false; }
    if (!description) { setError('description', 'Informe uma descrição.');       valid = false; }
    if (!due_date)    { setError('due_date',     'Informe a data da prova.');     valid = false; }
    if (!status)      { setError('status',       'Selecione o status.');          valid = false; }
    if (!valid) return;

    btn.disabled      = true;
    label.textContent = 'Salvando...';

    try {
      const r = await fetch(API, {
        method: 'POST', headers: authHeaders(),
        body: JSON.stringify({ type, description, due_date, status })
      });
      const data = await r.json();
      if (!r.ok) {
        if (data.errors) Object.entries(data.errors).forEach(([k, v]) => setError(k, v[0]));
        else alert(data.message || 'Erro ao salvar.');
        return;
      }
      showToast('Prova cadastrada!');
      setTimeout(() => location.href = '/exams', 1400);
    } catch {
      alert('Erro de conexão. Tente novamente.');
    } finally {
      btn.disabled      = false;
      label.textContent = 'Salvar prova';
    }
  });
}

/* ══════════════════════════════════════
   EDIT
══════════════════════════════════════ */
function initEdit() {
  bindSelectOther('type', 'extra-type');

  const form = document.getElementById('examForm');
  if (!form) return;

  const examId = form.dataset.id;

  prefillSelect('type', form.dataset.type, 'extra-type', 'type_custom');

  const desc = document.getElementById('description');
  if (desc) desc.value = form.dataset.description || '';

  const dd = document.getElementById('due_date');
  if (dd) dd.value = form.dataset.due_date || '';

  const stat = document.getElementById('status');
  if (stat) stat.value = form.dataset.status || '';

  ['type', 'description', 'due_date', 'status'].forEach(id => {
    document.getElementById(id)?.addEventListener('input',  () => clearError(id));
    document.getElementById(id)?.addEventListener('change', () => clearError(id));
  });

  const btn   = document.getElementById('submitBtn');
  const label = document.getElementById('btnLabel');

  form.addEventListener('submit', async e => {
    e.preventDefault();
    if (btn.disabled) return;
    clearAllErrors();

    const type        = getFieldValue('type', 'type_custom');
    const description = (document.getElementById('description')?.value || '').trim();
    const due_date    = document.getElementById('due_date')?.value || '';
    const status      = document.getElementById('status')?.value || '';

    let valid = true;
    if (!type)        { setError('type',        'Selecione ou informe o tipo.'); valid = false; }
    if (!description) { setError('description', 'Informe uma descrição.');       valid = false; }
    if (!due_date)    { setError('due_date',     'Informe a data da prova.');     valid = false; }
    if (!status)      { setError('status',       'Selecione o status.');          valid = false; }
    if (!valid) return;

    btn.disabled      = true;
    label.textContent = 'Salvando...';

    try {
      const r = await fetch(`${API}/${examId}`, {
        method: 'PUT', headers: authHeaders(),
        body: JSON.stringify({ type, description, due_date, status })
      });
      const data = await r.json();
      if (!r.ok) {
        if (data.errors) Object.entries(data.errors).forEach(([k, v]) => setError(k, v[0]));
        else alert(data.message || 'Erro ao atualizar.');
        return;
      }
      showToast('Prova atualizada!');
      setTimeout(() => location.href = '/exams', 1400);
    } catch {
      alert('Erro de conexão. Tente novamente.');
    } finally {
      btn.disabled      = false;
      label.textContent = 'Salvar alterações';
    }
  });

  document.getElementById('deleteBtn')?.addEventListener('click',    () => showModal('deleteModal'));
  document.getElementById('cancelDelete')?.addEventListener('click', () => hideModal('deleteModal'));

  document.getElementById('confirmDelete')?.addEventListener('click', async () => {
    const btn = document.getElementById('confirmDelete');
    btn.textContent = 'Excluindo...';
    btn.disabled = true;
    try {
      const r = await fetch(`${API}/${examId}`, { method: 'DELETE', headers: authHeaders() });
      if (!r.ok) throw new Error();
      hideModal('deleteModal');
      showToast('Prova excluída!');
      setTimeout(() => location.href = '/exams', 1400);
    } catch {
      alert('Erro ao excluir. Tente novamente.');
    } finally {
      btn.textContent = 'Sim, excluir';
      btn.disabled = false;
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  if (PAGE === 'index')  initIndex();
  if (PAGE === 'create') initCreate();
  if (PAGE === 'edit')   initEdit();
});