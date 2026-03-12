
const API = '/api/exams';

const PAGE = (() => {
    const p = location.pathname;
    if (p.includes('/create'))     return 'create';
    if (p.match(/\/exams\/edit\//)) return 'edit';
    return 'index';
})();

const $    = id => document.getElementById(id);
const hdrs = () => ({
    'Content-Type': 'application/json',
    'Accept': 'application/json',
    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
});
const fmtDate = s => { if (!s) return '—'; const [y,m,d] = s.split('-'); return `${d}/${m}/${y}`; };

const DIFFICULTY = {
    pending:     { bg: 'bg-red-100',    text: 'text-red-800',    label: '❌ Difícil'  },
    in_progress: { bg: 'bg-green-100',  text: 'text-green-800',  label: '✅ Fácil'    },
    completed:   { bg: 'bg-yellow-100', text: 'text-yellow-800', label: '❗ Médio'    },
};

const showModal = id => { const m = $(id); if (m) m.style.display = 'flex'; };
const hideModal = id => { const m = $(id); if (m) m.style.display = 'none'; };

function showToast(msg) {
    const t = $('toast'); if (!t) return;
    const p = t.querySelector('p');
    if (p && msg) p.textContent = msg;
    t.style.display = 'flex';
    clearTimeout(showToast._t);
    showToast._t = setTimeout(() => { t.style.display = 'none'; }, 3000);
}


const FORM_FIELDS = ['type', 'description', 'due_date', 'status'];

function setError(id, msg) {
    $(id)?.classList.add('border-red-400');
    const err = $(`err-${id}`);
    if (err) { if (msg) err.textContent = msg; err.classList.remove('hidden'); }
}
function clearError(id) {
    $(id)?.classList.remove('border-red-400');
    $(`err-${id}`)?.classList.add('hidden');
}
const clearAllErrors = () => FORM_FIELDS.forEach(clearError);


function bindSelectOther(selectId, extraId) {
    const sel = $(selectId), extra = $(extraId);
    if (!sel || !extra) return;
    sel.addEventListener('change', () => {
        extra.classList.toggle('hidden', sel.value !== 'outro');
        if (sel.value === 'outro') extra.querySelector('input')?.focus();
        clearError(selectId);
    });
}

function getFieldValue(selectId, customId) {
    const sel = $(selectId); if (!sel) return '';
    return sel.value === 'outro' ? ($(`${customId}`)?.value.trim() || '') : sel.value;
}

function prefillSelect(selectId, value, extraId, customId) {
    if (!value) return;
    const sel = $(selectId), extra = $(extraId), cust = $(customId);
    if (!sel) return;
    const exists = [...sel.options].some(o => o.value === value);
    if (exists) { sel.value = value; }
    else { sel.value = 'outro'; extra?.classList.remove('hidden'); if (cust) cust.value = value; }
}

function collectAndValidate() {
    clearAllErrors();
    const type        = getFieldValue('type', 'type_custom');
    const description = ($('description')?.value || '').trim();
    const due_date    = $('due_date')?.value || '';
    const status      = $('status')?.value || '';

    let valid = true;
    if (!type)        { setError('type',        'Selecione ou informe o tipo.'); valid = false; }
    if (!description) { setError('description', 'Informe uma descrição.');       valid = false; }
    if (!due_date)    { setError('due_date',     'Informe a data da prova.');     valid = false; }
    if (!status)      { setError('status',       'Selecione o status.');          valid = false; }

    return valid ? { type, description, due_date, status } : null;
}


function bindSubmitForm({ examId, isEdit }) {
    const form  = $('examForm');
    const btn   = $('submitBtn');
    const label = $('btnLabel');
    const defaultLabel = isEdit ? 'Salvar alterações' : 'Salvar prova';

    FORM_FIELDS.forEach(id => {
        $(id)?.addEventListener('input',  () => clearError(id));
        $(id)?.addEventListener('change', () => clearError(id));
    });

    form?.addEventListener('submit', async e => {
        e.preventDefault();
        if (btn.disabled) return;

        const payload = collectAndValidate();
        if (!payload) return;

        btn.disabled = true; label.textContent = 'Salvando...';

        try {
            const url = isEdit ? `${API}/${examId}` : API;
            const r   = await fetch(url, { method: isEdit ? 'PUT' : 'POST', headers: hdrs(), body: JSON.stringify(payload) });
            const data = await r.json();

            if (r.ok) {
                showToast(isEdit ? 'Prova atualizada!' : 'Prova cadastrada!');
                setTimeout(() => location.href = '/exams', 1400);
                return;
            }
            if (data.errors) Object.entries(data.errors).forEach(([k, v]) => setError(k, v[0]));
            else alert(data.message || 'Erro ao salvar.');
        } catch { alert('Erro de conexão. Tente novamente.'); }

        btn.disabled = false; label.textContent = defaultLabel;
    });
}


function bindDeleteModal(examId, { onSuccess }) {
    $('deleteBtn')?.addEventListener('click',    () => showModal('deleteModal'));
    $('cancelDelete')?.addEventListener('click', () => hideModal('deleteModal'));

    $('confirmDelete')?.addEventListener('click', async () => {
        const btn = $('confirmDelete');
        btn.textContent = 'Excluindo...'; btn.disabled = true;
        try {
            const r = await fetch(`${API}/${examId}`, { method: 'DELETE', headers: hdrs() });
            if (!r.ok) throw new Error();
            hideModal('deleteModal');
            showToast('Prova excluída!');
            onSuccess();
        } catch { alert('Erro ao excluir. Tente novamente.'); }
        finally  { btn.textContent = 'Sim, excluir'; btn.disabled = false; }
    });
}


async function loadExams() {
    try {
        const r = await fetch(API, { headers: hdrs() });
        if (!r.ok) throw new Error();
        const exams = await r.json();
        renderTable(exams);
        renderStats(exams);
    } catch {
        $('examsTable').innerHTML =
            `<tr><td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">Erro ao carregar provas. Tente novamente.</td></tr>`;
    }
}

function renderStats(exams) {
    let pending = 0, progress = 0, completed = 0;
    for (const e of exams) {
        if (e.status === 'pending')     pending++;
        if (e.status === 'in_progress') progress++;
        if (e.status === 'completed')   completed++;
    }
    const set = (id, v) => { const el = $(id); if (el) el.textContent = v; };
    set('totalCount',    exams.length);
    set('pendingCount',  pending);
    set('progressCount', progress);
    set('completedCount',completed);
}

function renderTable(exams) {
    const tbody = $('examsTable');
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

    const editSVG   = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>`;
    const trashSVG  = `<svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/></svg>`;

    tbody.innerHTML = exams.map(exam => {
        const d = DIFFICULTY[exam.status] || DIFFICULTY.pending;
        const badge = `<span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-bold ${d.bg} ${d.text}">${d.label}</span>`;
        return `
        <tr class="border-b border-gray-50 hover:bg-pink-50/30 transition-colors">
            <td class="px-6 py-4 text-center"><span class="text-sm font-semibold text-gray-800">${exam.type}</span></td>
            <td class="px-4 py-4 text-center max-w-xs"><span class="text-sm text-gray-500">${exam.description}</span></td>
            <td class="px-4 py-4 text-center"><span class="text-sm font-semibold text-gray-700">${fmtDate(exam.due_date)}</span></td>
            <td class="px-4 py-4 text-center">${badge}</td>
            <td class="px-4 py-4 text-center">
                <div class="flex items-center justify-center gap-2">
                    <button data-edit="${exam.id}" class="inline-flex items-center gap-1 text-xs font-bold text-pink-500 hover:text-pink-700 border border-pink-200 hover:border-pink-400 px-3 py-1.5 rounded-lg transition-colors">
                        ${editSVG} Editar
                    </button>
                    <button data-delete="${exam.id}" class="inline-flex items-center gap-1 text-xs font-bold text-red-400 hover:text-red-600 border border-red-100 hover:border-red-300 px-3 py-1.5 rounded-lg transition-colors">
                        ${trashSVG} Excluir
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

async function initIndex() {
    await loadExams();

    let deleteId = null;

    $('cancelDelete')?.addEventListener('click',  () => hideModal('deleteModal'));
    $('confirmDelete')?.addEventListener('click', async () => {
        if (!deleteId) return;
        const btn = $('confirmDelete');
        btn.textContent = 'Excluindo...'; btn.disabled = true;
        try {
            const r = await fetch(`${API}/${deleteId}`, { method: 'DELETE', headers: hdrs() });
            if (!r.ok) throw new Error();
            hideModal('deleteModal');
            showToast('Prova excluída!');
            await loadExams();
        } catch { alert('Erro ao excluir. Tente novamente.'); }
        finally  { btn.textContent = 'Sim, excluir'; btn.disabled = false; }
    });

    // Delegated click on table
    $('examsTable')?.addEventListener('click', e => {
        const del  = e.target.closest('[data-delete]');
        const edit = e.target.closest('[data-edit]');
        if (del)  { deleteId = del.dataset.delete; showModal('deleteModal'); }
        if (edit) { location.href = `/exams/edit/${edit.dataset.edit}`; }
    });
}

function initCreate() {
    bindSelectOther('type', 'extra-type');
    bindSubmitForm({ examId: null, isEdit: false });
}


function initEdit() {
    const form = $('examForm'); if (!form) return;
    const examId = form.dataset.id;

    bindSelectOther('type', 'extra-type');
    prefillSelect('type', form.dataset.type, 'extra-type', 'type_custom');

    const fill = (id, val) => { const el = $(id); if (el) el.value = val || ''; };
    fill('description', form.dataset.description);
    fill('due_date',    form.dataset.due_date);
    fill('status',      form.dataset.status);

    bindSubmitForm({ examId, isEdit: true });
    bindDeleteModal(examId, { onSuccess: () => setTimeout(() => location.href = '/exams', 1400) });
}


document.addEventListener('DOMContentLoaded', () => {
    if (PAGE === 'index')  initIndex();
    if (PAGE === 'create') initCreate();
    if (PAGE === 'edit')   initEdit();
});