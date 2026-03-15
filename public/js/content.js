'use strict';

const API_BASE = '/api';
const API      = `${API_BASE}/contents`;

const $   = id => document.getElementById(id);
const hdrs = (ct = false) => ({
    'Accept': 'application/json',
    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`,
    ...(ct ? { 'Content-Type': 'application/json' } : {}),
});
const initials = name => (name || '?').trim().split(' ').slice(0, 2).map(w => w[0]).join('').toUpperCase();
const AVATAR_COLORS = ['#db2777','#7c3aed','#0891b2','#059669','#d97706','#be185d'];

function showErr(id, msg) {
    const e = $(`err-${id}`);
    if (e) { e.textContent = msg || e.textContent; e.classList.remove('hidden'); }
}
function clearErr(id) {
    $(`err-${id}`)?.classList.add('hidden');
}

function showToast() {
    const t = $('toast'); if (!t) return;
    t.style.display = 'flex';
    clearTimeout(showToast._t);
    showToast._t = setTimeout(() => { t.style.display = 'none'; }, 3000);
}

async function loadSubjectsSelect(selectedName) {
    const sel = $('subject_id');
    const customInput = $('subject_custom');
    if (!sel) return;

    try {
        const res = await fetch(`${API_BASE}/subjects`, { headers: hdrs() });
        const list = res.ok ? await res.json() : [];

        sel.innerHTML = '<option value="">Selecione uma matéria...</option>';
        list.forEach(s => {
            const opt = document.createElement('option');
            opt.value = s.name;
            opt.textContent = s.name;
            sel.appendChild(opt);
        });

        const outro = document.createElement('option');
        outro.value = '__outro__';
        outro.textContent = 'Digitar manualmente...';
        sel.appendChild(outro);

        if (selectedName) {
            const match = [...sel.options].some(o => o.value === selectedName);
            if (match) {
                sel.value = selectedName;
            } else {
                sel.value = '__outro__';
                if (customInput) { customInput.value = selectedName; customInput.classList.remove('hidden'); }
            }
        }
    } catch {
        sel.innerHTML = '<option value="">Erro ao carregar matérias</option>';
        const outro = document.createElement('option');
        outro.value = '__outro__';
        outro.textContent = 'Digitar manualmente...';
        sel.appendChild(outro);
    }

    sel.addEventListener('change', () => {
        if (!customInput) return;
        if (sel.value === '__outro__') {
            customInput.classList.remove('hidden');
            customInput.focus();
        } else {
            customInput.classList.add('hidden');
            customInput.value = '';
        }
        clearErr('subject_id');
    });
}

function getSubjectValue() {
    const sel = $('subject_id');
    const custom = $('subject_custom');
    if (!sel) return '';
    if (sel.value === '__outro__') return custom?.value.trim() || '';
    return sel.value;
}

function validateForm() {
    let ok = true;
    if (!$('name')?.value.trim())       { showErr('name',       'Informe o nome do conteúdo.'); ok = false; }
    if (!getSubjectValue())             { showErr('subject_id', 'Selecione ou informe a matéria.'); ok = false; }
    if (!$('teacher')?.value.trim())    { showErr('teacher',    'Informe o nome do professor.'); ok = false; }
    const sem = $('semester')?.value;
    const semCustom = $('semester_custom')?.value;
    if (!sem || (sem === 'outro' && !semCustom)) { showErr('semester', 'Selecione ou informe o semestre.'); ok = false; }
    return ok;
}

function buildPayload() {
    const sem = $('semester')?.value;
    const semVal = sem === 'outro' ? parseInt($('semester_custom')?.value) : parseInt(sem);
    return {
        name:     $('name')?.value.trim(),
        teacher:  $('teacher')?.value.trim(),
        semester: semVal,
    };
}

function initSemesterExtra() {
    const sel    = $('semester');
    const custom = $('semester_custom');
    if (!sel || !custom) return;
    sel.addEventListener('change', () => {
        if (sel.value === 'outro') {
            custom.classList.remove('hidden');
            custom.focus();
        } else {
            custom.classList.add('hidden');
            custom.value = '';
        }
        clearErr('semester');
    });
}

async function initIndex() {
    const tbody = $('contentsTable');
    try {
        const res = await fetch(API, { headers: hdrs() });
        if (!res.ok) throw new Error();
        const list = await res.json();

        const total    = $('totalCount');
        const subjCount = $('subjectCount');
        if (total)     total.textContent     = list.length;
        if (subjCount) subjCount.textContent = new Set(list.map(c => c.name)).size;

        if (!list.length) {
            tbody.innerHTML = `<tr><td colspan="5"><div class="flex flex-col items-center justify-center py-16 gap-2"><div class="w-14 h-14 rounded-2xl bg-pink-50 dark:bg-pink-900/30 flex items-center justify-center text-3xl mb-1">📝</div><p class="text-gray-700 dark:text-gray-200 font-bold text-sm">Nenhum conteúdo cadastrado</p><p class="text-gray-400 dark:text-gray-500 text-xs">Clique em "Adicionar conteúdo" para começar.</p></div></td></tr>`;
            return;
        }

        tbody.innerHTML = list.map((c, i) => {
            const color = AVATAR_COLORS[i % AVATAR_COLORS.length];
            return `<tr class="border-b border-gray-50 dark:border-gray-800 hover:bg-pink-50/40 dark:hover:bg-pink-900/20 transition-colors">
                <td class="px-6 py-3.5 text-sm font-semibold text-gray-800 dark:text-gray-100">${c.name}</td>
                <td class="px-4 py-3.5 text-center"><span class="inline-flex items-center gap-1.5 bg-pink-50 dark:bg-pink-900/30 text-pink-700 dark:text-pink-300 text-xs font-semibold px-2.5 py-1 rounded-full border border-transparent dark:border-pink-800/50">${c.subject_name || '—'}</span></td>
                <td class="px-4 py-3.5 text-center"><div class="flex items-center justify-center gap-2.5"><div class="w-7 h-7 rounded-full flex items-center justify-center text-[10px] font-bold text-white shrink-0" style="background:${color}">${initials(c.teacher)}</div><span class="text-sm text-gray-600 dark:text-gray-300">${c.teacher}</span></div></td>
                <td class="px-4 py-3.5 text-center"><span class="inline-flex items-center gap-1.5 bg-gray-100 dark:bg-[#18181b] border border-transparent dark:border-gray-800 text-gray-600 dark:text-gray-400 text-xs font-semibold px-2.5 py-1 rounded-full">${c.semester}º sem.</span></td>
                <td class="px-4 py-3.5 text-center"><div class="inline-flex gap-1.5 justify-center">
                    <a href="/contents/edit/${c.id}" class="inline-flex items-center gap-1 bg-pink-50 dark:bg-pink-900/30 hover:bg-pink-100 dark:hover:bg-pink-900/50 text-pink-600 dark:text-pink-400 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors border border-transparent dark:border-pink-800/50">Editar</a>
                    <button data-del="${c.id}" class="inline-flex items-center gap-1 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 text-red-500 dark:text-red-400 font-bold text-xs px-3 py-1.5 rounded-lg transition-colors border border-transparent dark:border-red-900/50 cursor-pointer">Excluir</button>
                </div></td>
            </tr>`;
        }).join('');
    } catch {
        if (tbody) tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-10 text-center text-gray-400 dark:text-gray-500 text-sm">Erro ao carregar conteúdos.</td></tr>`;
    }

    let pendingId = null;

    tbody?.addEventListener('click', e => {
        const btn = e.target.closest('[data-del]'); if (!btn) return;
        pendingId = btn.dataset.del;
        $('deleteModal').style.display = 'flex';
    });

    $('cancelDelete')?.addEventListener('click',  () => { $('deleteModal').style.display = 'none'; pendingId = null; });
    $('confirmDelete')?.addEventListener('click', async () => {
        if (!pendingId) return;
        try {
            const res = await fetch(`${API}/${pendingId}`, { method: 'DELETE', headers: hdrs() });
            $('deleteModal').style.display = 'none';
            if (res.ok) initIndex();
            else alert('Erro ao excluir.');
        } catch { alert('Erro de conexão.'); }
    });
}

async function initForm() {
    const form   = $('contentForm');
    const isEdit = !!form?.dataset.id;

    initSemesterExtra();

    await loadSubjectsSelect(isEdit ? form.dataset.subjectName : undefined);

    if (isEdit) {
        const n = $('name');    if (n) n.value = form.dataset.name    || '';
        const t = $('teacher'); if (t) t.value = form.dataset.teacher || '';

        const semVal  = form.dataset.semester || '';
        const semSel  = $('semester');
        const semCust = $('semester_custom');
        if (semSel) {
            const known = ['1','2','3','4','5','6','7','8','9','10'];
            if (known.includes(String(semVal))) {
                semSel.value = semVal;
            } else if (semVal) {
                semSel.value = 'outro';
                semCust?.classList.remove('hidden');
                if (semCust) semCust.value = semVal;
            }
        }
    }

    ['name','teacher'].forEach(id => {
        $(id)?.addEventListener('input', () => clearErr(id));
    });

    const btn   = $('submitBtn');
    const label = $('btnLabel');
    const defaultLabel = isEdit ? 'Salvar alterações' : 'Salvar conteúdo';

    form?.addEventListener('submit', async e => {
        e.preventDefault();
        if (!validateForm()) return;
        btn.disabled = true; label.textContent = 'Salvando...';

        const payload = buildPayload();

        try {
            const url = isEdit ? `${API}/${form.dataset.id}` : API;
            const res = await fetch(url, {
                method:  isEdit ? 'PUT' : 'POST',
                headers: hdrs(true),
                body:    JSON.stringify(payload),
            });
            if (res.ok || res.status === 201) {
                showToast();
                setTimeout(() => window.location.href = '/contents', 1800);
                return;
            }
            const data = await res.json();
            if (data.errors) Object.entries(data.errors).forEach(([f, m]) => showErr(f, m[0]));
            else alert(data.message || 'Erro ao salvar.');
        } catch { alert('Erro de conexão.'); }

        btn.disabled = false; label.textContent = defaultLabel;
    });

    $('deleteBtn')?.addEventListener('click',    () => { $('deleteModal').style.display = 'flex'; });
    $('cancelDelete')?.addEventListener('click', () => { $('deleteModal').style.display = 'none'; });
    $('confirmDelete')?.addEventListener('click', async () => {
        const id = form?.dataset.id; if (!id) return;
        try {
            const res = await fetch(`${API}/${id}`, { method: 'DELETE', headers: hdrs() });
            if (res.ok) window.location.href = '/contents';
            else alert('Erro ao excluir.');
        } catch { alert('Erro de conexão.'); }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    if ($('contentsTable')) initIndex();
    if ($('contentForm'))   initForm();
});