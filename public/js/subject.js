'use strict';

const API = '/api/subjects';

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

const KNOWN_SEMESTERS = ['1','2','3','4','5','6','7','8','9','10'];

const AVATAR_COLORS = ['#db2777','#7c3aed','#0891b2','#059669','#d97706','#be185d'];

const $    = id => document.getElementById(id);
const hdrs = (ct = false) => ({
    'Accept': 'application/json',
    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
    ...(ct ? { 'Content-Type': 'application/json' } : {}),
});
const initials = name => (name || '?').trim().split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase();

function showErr(id, msg) {
    $(id)?.classList.add('border-red-400');
    const e = $(`err-${id}`);
    if (e) { if (msg) e.textContent = msg; e.classList.remove('hidden'); }
}
function clearErr(id) {
    $(id)?.classList.remove('border-red-400');
    $(`err-${id}`)?.classList.add('hidden');
}

function showToast() {
    const t = $('toast'); if (!t) return;
    t.style.display = 'flex';
    clearTimeout(showToast._t);
    showToast._t = setTimeout(() => { t.style.display = 'none'; }, 3000);
}

const emptyState = (icon, title, sub) => `
    <tr><td colspan="5">
        <div class="flex flex-col items-center justify-center py-16 gap-2">
            <div class="w-14 h-14 rounded-2xl bg-pink-50 dark:bg-pink-900/30 flex items-center justify-center text-3xl mb-1">${icon}</div>
            <p class="text-gray-700 dark:text-gray-200 font-bold text-sm">${title}</p>
            <p class="text-gray-400 dark:text-gray-500 text-xs">${sub}</p>
        </div>
    </td></tr>`;

async function fetchSubjects() {
    try {
        const res = await fetch(API, { headers: hdrs() });
        if (!res.ok) throw new Error(`HTTP ${res.status}`);
        renderSubjects(await res.json());
    } catch (e) {
        console.error('Erro ao carregar matérias:', e);
        const tbody = $('subjectsTable');
        if (tbody) tbody.innerHTML = emptyState('⚠️', 'Erro ao carregar', 'Verifique sua conexão e recarregue.');
    }
}

function renderSubjects(subjects) {
    const tbody  = $('subjectsTable');
    const total  = $('totalCount');
    const profEl = $('profCount');

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
        <tr class="border-b border-gray-50 dark:border-gray-800 hover:bg-pink-50/40 dark:hover:bg-pink-900/20 transition-colors">
            <td class="px-6 py-4 text-center font-semibold text-gray-900 dark:text-gray-100 text-sm">${s.name}</td>
            <td class="px-4 py-4 text-center">
                <span class="inline-block bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 text-xs font-semibold tracking-wide px-2.5 py-1 rounded-lg border border-transparent dark:border-gray-700/50">${s.abbreviation}</span>
            </td>
            <td class="px-4 py-4 text-center">
                <div class="flex items-center justify-center gap-2.5">
                    <div class="w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-bold text-white shrink-0" style="background:${color}">
                        ${initials(s.teacher)}
                    </div>
                    <span class="text-sm text-gray-600 dark:text-gray-300">${s.teacher}</span>
                </div>
            </td>
            <td class="px-4 py-4 text-center">
                <span class="inline-flex items-center gap-1.5 bg-pink-50 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 text-xs font-semibold px-2.5 py-1 rounded-full border border-transparent dark:border-pink-800/50">
                    <span class="w-1.5 h-1.5 rounded-full bg-pink-400 inline-block"></span>
                    ${s.semester}º sem.
                </span>
            </td>
            <td class="px-4 py-4 text-center">
                <div class="inline-flex gap-1.5 justify-center">
                    <a href="/subjects/edit/${s.id}" class="inline-flex items-center gap-1 bg-pink-50 dark:bg-pink-900/30 hover:bg-pink-100 dark:hover:bg-pink-900/50 text-pink-600 dark:text-pink-400 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Editar
                    </a>
                    <button data-del="${s.id}" class="inline-flex items-center gap-1 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 text-red-500 dark:text-red-400 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors border-0 cursor-pointer">
                        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M9 6V4h6v2"/></svg>
                        Excluir
                    </button>
                </div>
            </td>
        </tr>`;
    }).join('');
}

function initIndex() {
    fetchSubjects();

    let pendingId = null;

    $('subjectsTable')?.addEventListener('click', e => {
        const btn = e.target.closest('[data-del]'); if (!btn) return;
        pendingId = btn.dataset.del;
        $('deleteModal').style.display = 'flex';
    });

    $('cancelDelete')?.addEventListener('click', () => {
        $('deleteModal').style.display = 'none';
        pendingId = null;
    });

    $('confirmDelete')?.addEventListener('click', async () => {
        if (!pendingId) return;
        try {
            const res = await fetch(`${API}/${pendingId}`, { method: 'DELETE', headers: hdrs() });
            $('deleteModal').style.display = 'none';
            if (res.ok) fetchSubjects();
            else alert((await res.json().catch(() => ({}))).message || 'Erro ao excluir.');
        } catch { alert('Erro de conexão.'); }
        pendingId = null;
    });
}

const SELECT_EXTRAS = [
    { selectId: 'name',         extraId: 'extra-name' },
    { selectId: 'abbreviation', extraId: 'extra-abbreviation' },
    { selectId: 'semester',     extraId: 'extra-semester' },
];

function initSelectExtras() {
    SELECT_EXTRAS.forEach(({ selectId, extraId }) => {
        const sel = $(selectId), extra = $(extraId);
        if (!sel || !extra) return;
        sel.addEventListener('change', () => {
            extra.classList.toggle('hidden', sel.value !== 'outro');
        });
    });
}

function resolveVal(selectId, customId) {
    const sel = $(selectId); if (!sel) return '';
    return sel.value === 'outro' ? ($(customId)?.value.trim() || '') : sel.value;
}

function setSelectOrCustom(selectId, extraId, customId, value, known) {
    const sel = $(selectId), extra = $(extraId), custom = $(customId);
    if (!sel) return;
    if (known.includes(String(value))) {
        sel.value = value;
    } else if (value) {
        sel.value = 'outro';
        extra?.classList.remove('hidden');
        if (custom) custom.value = value;
    }
}

function buildPayload() {
    return {
        name:         resolveVal('name',         'name_custom'),
        abbreviation: resolveVal('abbreviation', 'abbreviation_custom'),
        teacher:      $('teacher')?.value.trim(),
        semester:     parseInt(resolveVal('semester', 'semester_custom')),
    };
}

function validateForm() {
    let ok = true;
    const { name, abbreviation, teacher, semester } = buildPayload();
    if (!name)                                        { showErr('name',         'Selecione ou informe a matéria.'); ok = false; }
    if (!abbreviation)                                { showErr('abbreviation', 'Selecione ou informe o código.');  ok = false; }
    if (!teacher)                                     { showErr('teacher',      'Informe o professor.');            ok = false; }
    if (!semester || isNaN(semester) || semester < 1) { showErr('semester',     'Selecione ou informe o semestre.'); ok = false; }
    return ok;
}

function initForm() {
    initSelectExtras();

    const form   = $('subjectForm');
    const isEdit = !!form?.dataset.id;

    if (isEdit) {
        setSelectOrCustom('name',         'extra-name',         'name_custom',         form.dataset.name,         KNOWN_NAMES);
        setSelectOrCustom('abbreviation', 'extra-abbreviation', 'abbreviation_custom', form.dataset.abbreviation, KNOWN_CODES);
        setSelectOrCustom('semester',     'extra-semester',     'semester_custom',     form.dataset.semester,     KNOWN_SEMESTERS);
        const t = $('teacher'); if (t) t.value = form.dataset.teacher || '';
    }

    $('abbreviation_custom')?.addEventListener('input', function () {
        const p = this.selectionStart;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(p, p);
    });

    ['name','abbreviation','teacher','semester'].forEach(id => {
        $(id)?.addEventListener('change', () => clearErr(id));
        $(`${id}_custom`)?.addEventListener('input', () => clearErr(id));
    });
    $('teacher')?.addEventListener('input', () => clearErr('teacher'));

    const btn   = $('submitBtn');
    const label = $('btnLabel');
    const defaultLabel = isEdit ? 'Salvar alterações' : 'Salvar matéria';

    form?.addEventListener('submit', async e => {
        e.preventDefault();
        if (!validateForm()) return;
        btn.disabled = true; label.textContent = 'Salvando...';

        try {
            const url = isEdit ? `${API}/${form.dataset.id}` : API;
            const res = await fetch(url, {
                method:  isEdit ? 'PUT' : 'POST',
                headers: hdrs(true),
                body:    JSON.stringify(buildPayload()),
            });
            if (res.ok || res.status === 201) {
                showToast();
                setTimeout(() => window.location.href = '/subjects', 1800);
                return;
            }
            const data = await res.json();
            if (data.errors) Object.entries(data.errors).forEach(([f, m]) => showErr(f, m[0]));
            else alert(data.message || 'Erro ao salvar.');
        } catch { alert('Erro de conexão.'); }

        btn.disabled = false; label.textContent = defaultLabel;
    });

    $('deleteBtn')?.addEventListener('click', () => {
        $('deleteModal').style.display = 'flex';
    });
    $('cancelDelete')?.addEventListener('click', () => {
        $('deleteModal').style.display = 'none';
    });
    $('confirmDelete')?.addEventListener('click', async () => {
        const id = form?.dataset.id; if (!id) return;
        try {
            const res = await fetch(`${API}/${id}`, { method: 'DELETE', headers: hdrs() });
            if (res.ok) window.location.href = '/subjects';
            else alert('Erro ao excluir.');
        } catch { alert('Erro de conexão.'); }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if ($('subjectsTable')) initIndex();
    if ($('subjectForm'))   initForm();
});