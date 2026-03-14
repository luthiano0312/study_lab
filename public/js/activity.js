
const API = '/api/activities';


const $       = id => document.getElementById(id);
const hdrs    = (ct = false) => ({
    'Accept': 'application/json',
    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
    ...(ct ? { 'Content-Type': 'application/json' } : {}),
});
const fmtDate = iso => { if (!iso) return '—'; const [y,m,d] = iso.split('-'); return `${d}/${m}/${y}`; };
const todayISO   = () => new Date().toISOString().split('T')[0];
const addDays    = n  => { const d = new Date(); d.setDate(d.getDate() + n);   return d.toISOString().split('T')[0]; };
const addMonths  = n  => { const d = new Date(); d.setMonth(d.getMonth() + n); return d.toISOString().split('T')[0]; };

const STATUS_LABEL = { pending: 'Pendente', in_progress: 'Em andamento', completed: 'Concluída' };
const STATUS_CLASS = {
    pending:     'bg-yellow-100 text-yellow-800',
    in_progress: 'bg-blue-100 text-blue-800',
    completed:   'bg-green-100 text-green-800',
};


function showErr(id, msg) {
    const input = $(id);    if (input) input.classList.add('border-red-400');
    const err   = $(`err-${id}`); if (err) { err.textContent = msg; err.classList.remove('hidden'); }
}
function clearErr(id) {
    $(id)?.classList.remove('border-red-400');
    $(`err-${id}`)?.classList.add('hidden');
}

function showToast() {
    const t = $('toast'); if (!t) return;
    t.classList.remove('hidden');
    clearTimeout(showToast._t);
    showToast._t = setTimeout(() => t.classList.add('hidden'), 3000);
}


const emptyRow = (icon, title, sub) => `
    <tr><td colspan="4">
        <div class="flex flex-col items-center justify-center py-16 gap-2">
            <div class="w-14 h-14 rounded-2xl bg-pink-50 flex items-center justify-center text-3xl mb-1">${icon}</div>
            <p class="text-gray-700 font-bold text-sm">${title}</p>
            <p class="text-gray-400 text-xs">${sub}</p>
        </div>
    </td></tr>`;


let pendingDeleteId = null;

async function fetchActivities() {
    const tbody = $('activitiesTable');
    try {
        const res = await fetch(API, { headers: hdrs() });
        if (!res.ok) throw new Error(res.status);
        renderActivities(await res.json());
    } catch {
        if (tbody) tbody.innerHTML = emptyRow('⚠️', 'Erro ao carregar', 'Verifique sua conexão e recarregue.');
    }
}

function renderActivities(list) {
    let pending = 0, progress = 0, completed = 0;
    for (const a of list) {
        if (a.status === 'pending')     pending++;
        if (a.status === 'in_progress') progress++;
        if (a.status === 'completed')   completed++;
    }
    const setText = (id, v) => { const e = $(id); if (e) e.textContent = v; };
    setText('totalCount',    list.length);
    setText('pendingCount',  pending);
    setText('progressCount', progress);
    setText('completedCount',completed);

    const tbody = $('activitiesTable');
    if (!list.length) { tbody.innerHTML = emptyRow('📋', 'Nenhuma atividade cadastrada', 'Clique em "Nova atividade" para começar.'); return; }

    const today = todayISO();
    tbody.innerHTML = list.map(a => {
        const overdue = a.status !== 'completed' && a.due_date < today;
        return `<tr class="border-b border-gray-50 hover:bg-pink-50/40 transition-colors">
            <td class="px-6 py-3.5 text-sm font-semibold text-gray-800 max-w-xs"><span class="line-clamp-2">${a.description}</span></td>
            <td class="px-4 py-3.5 text-center text-sm ${overdue ? 'text-red-500 font-bold' : 'text-gray-600'}">${fmtDate(a.due_date)}${overdue ? ' ⚠️' : ''}</td>
            <td class="px-4 py-3.5 text-center">
                <span class="inline-flex items-center text-xs font-bold px-2.5 py-1 rounded-full ${STATUS_CLASS[a.status] || 'bg-gray-100 text-gray-600'}">
                    ${STATUS_LABEL[a.status] || a.status}
                </span>
            </td>
            <td class="px-4 py-3.5 text-center">
                <div class="inline-flex gap-1.5">
                    <a href="/activities/edit/${a.id}" class="inline-flex items-center gap-1 bg-pink-50 hover:bg-pink-100 text-pink-600 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors">
                        <img src="${editIcon}" class="w-3.5 h-3.5 opacity-60"> Editar
                    </a>
                    <button data-del="${a.id}" class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-500 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors border-0 cursor-pointer">
                        <img src="${deleteIcon}" class="w-3.5 h-3.5 opacity-60"> Excluir
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

async function executeDelete(id) {
    try {
        const res = await fetch(`${API}/${id}`, { method: 'DELETE', headers: hdrs() });
        $('deleteModal')?.classList.add('hidden');
        pendingDeleteId = null;
        if (res.ok) fetchActivities();
        else alert('Erro ao excluir.');
    } catch { console.error('executeDelete error'); }
}

function initIndex() {
    fetchActivities();

    $('activitiesTable')?.addEventListener('click', e => {
        const btn = e.target.closest('[data-del]');
        if (!btn) return;
        pendingDeleteId = btn.dataset.del;
        $('deleteModal')?.classList.remove('hidden');
    });

    document.addEventListener('click', e => {
        if (e.target.closest('#cancelDelete'))  { $('deleteModal')?.classList.add('hidden'); pendingDeleteId = null; }
        if (e.target.closest('#confirmDelete') && pendingDeleteId) executeDelete(pendingDeleteId);
    }, { once: false });
}


const DATE_MAP = {
    hoje:      () => todayISO(),
    amanha:    () => addDays(1),
    '3dias':   () => addDays(3),
    '1semana': () => addDays(7),
    '2semanas':() => addDays(14),
    '1mes':    () => addMonths(1),
};

function initDateQuickSelect() {
    const quick = $('due_date_quick'), input = $('due_date');
    if (!quick || !input) return;
    quick.addEventListener('change', () => {
        if (quick.value === 'custom') {
            input.classList.remove('hidden'); input.focus(); return;
        }
        const fn = DATE_MAP[quick.value];
        if (fn) { input.value = fn(); input.classList.remove('hidden'); clearErr('due_date'); }
        else    { input.value = ''; input.classList.add('hidden'); }
    });
}

let _descEl, _ctrEl;
function updateCharCounter() {
    _descEl = _descEl || $('description');
    _ctrEl  = _ctrEl  || $('charCounter');
    if (!_descEl || !_ctrEl) return;
    const len = _descEl.value.length;
    _ctrEl.textContent = `${len} / 500`;
    _ctrEl.className   = 'text-xs ml-auto ' + (len > 450 ? 'text-red-500' : len > 350 ? 'text-yellow-500' : 'text-gray-400');
}

function validateForm() {
    let ok = true;
    if (!$('description')?.value.trim()) { showErr('description', 'Informe a descrição.');          ok = false; }
    if (!$('due_date')?.value)           { showErr('due_date',     'Informe a data de vencimento.'); ok = false; }
    if (!$('status')?.value)             { showErr('status',       'Selecione o status.');           ok = false; }
    return ok;
}

function initForm() {
    const form   = $('activityForm');
    const isEdit = !!form?.dataset.id;

    initDateQuickSelect();
    $('description')?.addEventListener('input', updateCharCounter);
    updateCharCounter();

    if (isEdit) {
        const desc = $('description'), dd = $('due_date'), st = $('status');
        if (desc) { desc.value = form.dataset.description || ''; updateCharCounter(); }
        if (dd)   dd.value = form.dataset.due_date || '';
        if (st)   st.value = form.dataset.status   || '';
    }

    ['description','due_date','status'].forEach(id => {
        $(id)?.addEventListener('input',  () => clearErr(id));
        $(id)?.addEventListener('change', () => clearErr(id));
    });

    const btn   = $('submitBtn');
    const label = $('btnLabel');
    const defaultLabel = isEdit ? 'Salvar alterações' : 'Salvar atividade';

    form?.addEventListener('submit', async e => {
        e.preventDefault();
        if (!validateForm()) return;
        btn.disabled = true;
        label.textContent = 'Salvando...';

        const due = $('due_date').value;
        const [y, m, d] = due.split('-');
        const dueFmt = (y && m && d) ? `${d}-${m}-${y}` : due;

        let userId = null;
        try { userId = JSON.parse(atob(localStorage.getItem('auth_token').split('.')[1])).sub; } catch {}

        const payload = {
            user_id:     userId,
            description: $('description').value.trim(),
            due_date:    dueFmt,
            status:      $('status').value,
        };

        try {
            const url = isEdit ? `${API}/${form.dataset.id}` : API;
            const res = await fetch(url, {
                method:  isEdit ? 'PUT' : 'POST',
                headers: hdrs(true),
                body:    JSON.stringify(payload),
            });
            if (res.ok || res.status === 201) {
                showToast();
                setTimeout(() => window.location.href = '/activities', 1800);
                return;
            }
            const data = await res.json();
            if (data.errors) Object.entries(data.errors).forEach(([f, msgs]) => showErr(f, msgs[0]));
            else alert(data.message || 'Erro ao salvar.');
        } catch { alert('Erro de conexão.'); }

        btn.disabled = false;
        label.textContent = defaultLabel;
    });

    $('deleteBtn')?.addEventListener('click',    () => $('deleteModal')?.classList.remove('hidden'));
    $('cancelDelete')?.addEventListener('click', () => $('deleteModal')?.classList.add('hidden'));
    $('confirmDelete')?.addEventListener('click', async () => {
        const id = form?.dataset.id; if (!id) return;
        const res = await fetch(`${API}/${id}`, { method: 'DELETE', headers: hdrs() });
        if (res.ok) window.location.href = '/activities';
        else alert('Erro ao excluir.');
    });
}


document.addEventListener('DOMContentLoaded', () => {
    if ($('activitiesTable')) initIndex();
    if ($('activityForm'))    initForm();
});