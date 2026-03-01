const API_URL = 'http://127.0.0.1:8000/api/activities';

function authHeaders(extra = {}) {
  const token = localStorage.getItem('auth_token');
  return { 'Accept': 'application/json', 'Authorization': `Bearer ${token}`, ...extra };
}

const STATUS_LABEL = { pending: '⏳ Pendente', in_progress: '🔄 Em andamento', completed: '✅ Concluída' };
const STATUS_CLASS = { pending: 'bg-yellow-100 text-yellow-800', in_progress: 'bg-blue-100 text-blue-800', completed: 'bg-green-100 text-green-800' };

function todayISO()      { return new Date().toISOString().split('T')[0]; }
function addDays(n)      { const d = new Date(); d.setDate(d.getDate() + n); return d.toISOString().split('T')[0]; }
function addMonths(n)    { const d = new Date(); d.setMonth(d.getMonth() + n); return d.toISOString().split('T')[0]; }
function fmtDisplay(iso) { if (!iso) return '—'; const [y,m,d] = iso.split('-'); return `${d}/${m}/${y}`; }

document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('activitiesTable')) initIndex();
  if (document.getElementById('activityForm'))    initForm();
});

function initIndex() { fetchActivities(); }

async function fetchActivities() {
  try {
    const res = await fetch(API_URL, { headers: authHeaders() });
    if (!res.ok) throw new Error(res.status);
    renderActivities(await res.json());
  } catch (e) {
    console.error(e);
    const tbody = document.getElementById('activitiesTable');
    if (tbody) tbody.innerHTML = emptyRow('⚠️', 'Erro ao carregar', 'Verifique sua conexão e recarregue.');
  }
}

function renderActivities(list) {
  const $ = id => document.getElementById(id);
  if ($('totalCount'))    $('totalCount').textContent    = list.length;
  if ($('pendingCount'))  $('pendingCount').textContent  = list.filter(a => a.status === 'pending').length;
  if ($('progressCount')) $('progressCount').textContent = list.filter(a => a.status === 'in_progress').length;
  if ($('completedCount'))$('completedCount').textContent= list.filter(a => a.status === 'completed').length;

  const tbody = $('activitiesTable');
  if (!list.length) { tbody.innerHTML = emptyRow('📋', 'Nenhuma atividade cadastrada', 'Clique em "Nova atividade" para começar.'); return; }

  const today = todayISO();
  tbody.innerHTML = list.map(a => {
    const overdue = a.status !== 'completed' && a.due_date < today;
    return `<tr class="border-b border-gray-50 hover:bg-pink-50/40 transition-colors">
      <td class="px-6 py-3.5 text-sm font-semibold text-gray-800 max-w-xs"><span class="line-clamp-2">${a.description}</span></td>
      <td class="px-4 py-3.5 text-center text-sm ${overdue ? 'text-red-500 font-bold' : 'text-gray-600'}">${fmtDisplay(a.due_date)}${overdue ? ' ⚠️' : ''}</td>
      <td class="px-4 py-3.5 text-center"><span class="inline-flex items-center text-xs font-bold px-2.5 py-1 rounded-full ${STATUS_CLASS[a.status] || 'bg-gray-100 text-gray-600'}">${STATUS_LABEL[a.status] || a.status}</span></td>
      <td class="px-4 py-3.5 text-center">
        <div class="inline-flex gap-1.5">
          <a href="/activities/edit/${a.id}" class="inline-flex items-center gap-1 bg-pink-50 hover:bg-pink-100 text-pink-600 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors">
            <img src="${editIcon}" class="w-3.5 h-3.5 opacity-60"> Editar
          </a>
          <button onclick="openDeleteModal(${a.id})" class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-500 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors border-0 cursor-pointer">
            <img src="${deleteIcon}" class="w-3.5 h-3.5 opacity-60"> Excluir
          </button>
        </div>
      </td>
    </tr>`;
  }).join('');
}

function emptyRow(icon, title, sub) {
  return `<tr><td colspan="4"><div class="flex flex-col items-center justify-center py-16 gap-2">
    <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl mb-1">${icon}</div>
    <p class="text-gray-700 font-bold text-sm">${title}</p>
    <p class="text-gray-400 text-xs">${sub}</p>
  </div></td></tr>`;
}

let pendingDeleteId = null;

function openDeleteModal(id) {
  pendingDeleteId = id;
  document.getElementById('deleteModal')?.classList.remove('hidden');
}
function closeDeleteModal() {
  pendingDeleteId = null;
  document.getElementById('deleteModal')?.classList.add('hidden');
}

document.addEventListener('click', e => {
  if (e.target.id === 'cancelDelete'  || e.target.closest?.('#cancelDelete'))  closeDeleteModal();
  if (e.target.id === 'confirmDelete' || e.target.closest?.('#confirmDelete')) pendingDeleteId && executeDelete(pendingDeleteId);
});

async function executeDelete(id) {
  try {
    const res = await fetch(`${API_URL}/${id}`, { method: 'DELETE', headers: authHeaders() });
    closeDeleteModal();
    if (res.ok) fetchActivities();
    else alert('Erro ao excluir.');
  } catch (e) { console.error(e); }
}

function initForm() {
  const form   = document.getElementById('activityForm');
  const isEdit = !!form?.dataset.id;

  initDateQuickSelect();
  initCharCounter();

  if (isEdit) {
    const desc   = document.getElementById('description');
    const dateEl = document.getElementById('due_date');
    const status = document.getElementById('status');
    if (desc)   { desc.value   = form.dataset.description || ''; updateCharCounter(); }
    if (dateEl) { dateEl.value = form.dataset.due_date    || ''; }
    if (status) { status.value = form.dataset.status      || ''; }
  }

  ['description','due_date','status'].forEach(id => {
    document.getElementById(id)?.addEventListener('input',  () => clearErr(id));
    document.getElementById(id)?.addEventListener('change', () => clearErr(id));
  });

  form?.addEventListener('submit', async e => {
    e.preventDefault();
    if (!validateForm()) return;

    const btn   = document.getElementById('submitBtn');
    const label = document.getElementById('btnLabel');
    btn.disabled = true;
    label.textContent = 'Salvando...';

    const due = document.getElementById("due_date")?.value || "";
    const [y,m,d] = due.split("-");
    const dueFmt = y && m && d ? `${d}-${m}-${y}` : due;

    const token = localStorage.getItem("auth_token");
    let userId = null;
    try { userId = JSON.parse(atob(token.split(".")[1])).sub; } catch(e) {}

    const payload = {
      user_id:     userId,
      description: document.getElementById("description").value.trim(),
      due_date:    dueFmt,
      status:      document.getElementById("status").value,
    };

    try {
      const url    = isEdit ? `${API_URL}/${form.dataset.id}` : API_URL;
      const method = isEdit ? 'PUT' : 'POST';
      const res    = await fetch(url, {
        method,
        headers: authHeaders({ 'Content-Type': 'application/json' }),
        body: JSON.stringify(payload),
      });

      if (res.ok || res.status === 201) {
        showToast();
        setTimeout(() => window.location.href = '/activities', 1800);
      } else {
        const data = await res.json();
        if (data.errors) Object.entries(data.errors).forEach(([f,m]) => showErr(f, m[0]));
        else alert(data.message || 'Erro ao salvar.');
        btn.disabled = false;
        label.textContent = isEdit ? 'Salvar alterações' : 'Salvar atividade';
      }
    } catch (err) {
      console.error(err);
      alert('Erro de conexão.');
      btn.disabled = false;
      label.textContent = isEdit ? 'Salvar alterações' : 'Salvar atividade';
    }
  });

  document.getElementById('deleteBtn')?.addEventListener('click', () => {
    document.getElementById('deleteModal')?.classList.remove('hidden');
  });
  document.getElementById('confirmDelete')?.addEventListener('click', async () => {
    const id = form?.dataset.id;
    if (!id) return;
    const res = await fetch(`${API_URL}/${id}`, { method: 'DELETE', headers: authHeaders() });
    if (res.ok) window.location.href = '/activities';
    else alert('Erro ao excluir.');
  });
  document.getElementById('cancelDelete')?.addEventListener('click', () => {
    document.getElementById('deleteModal')?.classList.add('hidden');
  });
}

function initDateQuickSelect() {
  const quick = document.getElementById('due_date_quick');
  const input = document.getElementById('due_date');
  if (!quick || !input) return;

  quick.addEventListener('change', () => {
    const map = {
      hoje:      todayISO(),
      amanha:    addDays(1),
      '3dias':   addDays(3),
      '1semana': addDays(7),
      '2semanas':addDays(14),
      '1mes':    addMonths(1),
    };

    if (quick.value === 'custom') {
      input.classList.remove('hidden');
      input.focus();
    } else if (map[quick.value]) {
      input.value = map[quick.value];
      input.classList.remove('hidden');
      clearErr('due_date');
    } else {
      input.value = '';
      input.classList.add('hidden');
    }
  });
}

function updateCharCounter() {
  const ta  = document.getElementById('description');
  const ctr = document.getElementById('charCounter');
  if (!ta || !ctr) return;
  const len = ta.value.length;
  ctr.textContent = `${len} / 500`;
  ctr.className = 'text-xs ml-auto ' + (len > 450 ? 'text-red-500' : len > 350 ? 'text-yellow-500' : 'text-gray-400');
}

function initCharCounter() {
  document.getElementById('description')?.addEventListener('input', updateCharCounter);
  updateCharCounter();
}

function validateForm() {
  let ok = true;
  if (!document.getElementById('description')?.value.trim()) { showErr('description', 'Informe a descrição.'); ok = false; }
  if (!document.getElementById('due_date')?.value)           { showErr('due_date', 'Informe a data de vencimento.'); ok = false; }
  if (!document.getElementById('status')?.value)             { showErr('status', 'Selecione o status.'); ok = false; }
  return ok;
}

function showErr(id, msg) {
  const input = document.getElementById(id);
  input?.classList.add('border-red-400');
  const err = document.getElementById('err-' + id);
  if (err) { if (msg) err.textContent = msg; err.classList.remove('hidden'); }
}
function clearErr(id) {
  document.getElementById(id)?.classList.remove('border-red-400');
  document.getElementById('err-' + id)?.classList.add('hidden');
}
function showToast() {
  const t = document.getElementById('toast');
  if (!t) return;
  t.classList.remove('hidden');
  setTimeout(() => t.classList.add('hidden'), 3000);
}