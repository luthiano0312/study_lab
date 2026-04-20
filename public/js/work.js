/**
 * exam.js — CRUD de Trabalhos
 * Detecta a página atual pela presença de elementos no DOM
 * e inicializa o comportamento correto.
 */

const API_BASE = '/api/exams';

/* ─── Helpers ───────────────────────────────────────────────── */

function formatDate(dateStr) {
    if (!dateStr) return '—';
    const [y, m, d] = dateStr.split('-');
    return `${d}/${m}/${y}`;
}

function addDays(date, days) {
    const d = new Date(date);
    d.setDate(d.getDate() + days);
    return d.toISOString().split('T')[0];
}

function addMonths(date, months) {
    const d = new Date(date);
    d.setMonth(d.getMonth() + months);
    return d.toISOString().split('T')[0];
}

function today() {
    return new Date().toISOString().split('T')[0];
}

function isOverdue(dateStr) {
    return dateStr && dateStr < today();
}

function statusBadge(status) {
    const map = {
        pending:     { label: 'Pendente',     cls: 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' },
        in_progress: { label: 'Em andamento', cls: 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' },
        completed:   { label: 'Concluído',    cls: 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' },
    };
    const s = map[status] ?? { label: status, cls: 'bg-gray-100 text-gray-600' };
    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold ${s.cls}">${s.label}</span>`;
}

function typeBadge(type) {
    const colors = {
        'Artigo':       'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400',
        'Seminário':    'bg-pink-100 text-pink-700 dark:bg-pink-900/30 dark:text-pink-400',
        'Relatório':    'bg-orange-100 text-orange-700 dark:bg-orange-900/30 dark:text-orange-400',
        'Projeto':      'bg-teal-100 text-teal-700 dark:bg-teal-900/30 dark:text-teal-400',
        'Apresentação': 'bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-400',
        'Outro':        'bg-gray-100 text-gray-600 dark:bg-gray-800 dark:text-gray-400',
    };
    const cls = colors[type] ?? 'bg-gray-100 text-gray-600';
    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold ${cls}">${type ?? '—'}</span>`;
}

function showToast(el) {
    el.classList.remove('hidden');
    el.classList.add('flex');
    setTimeout(() => {
        el.classList.add('hidden');
        el.classList.remove('flex');
    }, 3000);
}

/* ─── Quick-date select shared logic ────────────────────────── */

function initQuickDate(selectEl, inputEl) {
    selectEl.addEventListener('change', () => {
        const val = selectEl.value;
        if (!val) return;
        const t = today();
        const map = {
            hoje:     t,
            amanha:   addDays(t, 1),
            '3dias':  addDays(t, 3),
            '1semana':addDays(t, 7),
            '2semanas':addDays(t, 14),
            '1mes':   addMonths(t, 1),
        };
        if (val === 'custom') {
            inputEl.classList.remove('hidden');
            inputEl.focus();
        } else {
            inputEl.classList.remove('hidden');
            inputEl.value = map[val];
        }
    });
}

/* ─── INDEX page ─────────────────────────────────────────────── */

function initIndex() {
    const tbody         = document.getElementById('examsTable');
    const totalCount    = document.getElementById('totalCount');
    const pendingCount  = document.getElementById('pendingCount');
    const progressCount = document.getElementById('progressCount');
    const completedCount= document.getElementById('completedCount');
    const deleteModal   = document.getElementById('deleteModal');
    const cancelDelete  = document.getElementById('cancelDelete');
    const confirmDelete = document.getElementById('confirmDelete');
    const toast         = document.getElementById('toast');

    if (!tbody) return;

    let pendingDeleteId = null;

    async function loadExams() {
        try {
            const res  = await fetch(API_BASE, { headers: { Accept: 'application/json' } });
            const data = await res.json();

            // Stats
            totalCount.textContent     = data.length;
            pendingCount.textContent   = data.filter(e => e.status === 'pending').length;
            progressCount.textContent  = data.filter(e => e.status === 'in_progress').length;
            completedCount.textContent = data.filter(e => e.status === 'completed').length;

            if (data.length === 0) {
                tbody.innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-14 text-center">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-12 h-12 rounded-2xl bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center">
                                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#818cf8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                                </div>
                                <p class="text-sm font-bold text-gray-400">Nenhum trabalho cadastrado</p>
                                <a href="/exams/create" class="text-xs font-semibold text-indigo-500 hover:text-indigo-700 transition-colors">+ Adicionar trabalho</a>
                            </div>
                        </td>
                    </tr>`;
                return;
            }

            tbody.innerHTML = data.map(exam => {
                const overdue = isOverdue(exam.due_date) && exam.status !== 'completed';
                const dateHtml = overdue
                    ? `<span class="text-red-500 font-bold text-xs">${formatDate(exam.due_date)} ⚠️</span>`
                    : `<span class="text-gray-600 dark:text-gray-400 text-xs font-semibold">${formatDate(exam.due_date)}</span>`;

                return `
                <tr class="border-b border-gray-50 dark:border-gray-800/60 hover:bg-indigo-50/30 dark:hover:bg-indigo-900/10 transition-colors group">
                    <td class="px-6 py-4">${typeBadge(exam.type)}</td>
                    <td class="px-4 py-4 max-w-xs">
                        <p class="text-sm font-semibold text-gray-800 dark:text-gray-200 truncate" title="${exam.description}">${exam.description}</p>
                    </td>
                    <td class="px-4 py-4 text-center">${dateHtml}</td>
                    <td class="px-4 py-4 text-center">${statusBadge(exam.status)}</td>
                    <td class="px-4 py-4 text-center">
                        <div class="flex items-center justify-center gap-1.5">
                            <a href="/exams/${exam.id}/edit"
                                class="inline-flex items-center gap-1 border border-indigo-200 dark:border-indigo-800 hover:bg-indigo-50 dark:hover:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Editar
                            </a>
                            <button
                                class="delete-btn inline-flex items-center gap-1 border border-red-200 dark:border-red-900/40 hover:bg-red-50 dark:hover:bg-red-900/20 text-red-500 font-semibold text-xs px-3 py-1.5 rounded-lg transition-colors"
                                data-id="${exam.id}">
                                <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/><path d="M9 6V4h6v2"/></svg>
                                Excluir
                            </button>
                        </div>
                    </td>
                </tr>`;
            }).join('');

            // Bind delete buttons
            tbody.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    pendingDeleteId = btn.dataset.id;
                    deleteModal.classList.remove('hidden');
                    deleteModal.classList.add('flex');
                });
            });

        } catch (err) {
            console.error(err);
            tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-10 text-center text-sm text-gray-400 font-semibold">Erro ao carregar trabalhos.</td></tr>`;
        }
    }

    // Delete modal
    cancelDelete.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
        pendingDeleteId = null;
    });

    confirmDelete.addEventListener('click', async () => {
        if (!pendingDeleteId) return;
        confirmDelete.textContent = 'Excluindo...';
        confirmDelete.disabled = true;
        try {
            await fetch(`${API_BASE}/${pendingDeleteId}`, {
                method: 'DELETE',
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                },
            });
            deleteModal.classList.add('hidden');
            deleteModal.classList.remove('flex');
            showToast(toast);
            await loadExams();
        } catch (err) {
            console.error(err);
        } finally {
            confirmDelete.textContent = 'Sim, excluir';
            confirmDelete.disabled = false;
            pendingDeleteId = null;
        }
    });

    loadExams();
}

/* ─── CREATE page ────────────────────────────────────────────── */

function initCreate() {
    const form    = document.getElementById('examForm');
    const toast   = document.getElementById('toast');

    if (!form || form.dataset.id) return; // skip if edit page

    // Char counter
    const desc    = document.getElementById('description');
    const counter = document.getElementById('charCounter');
    desc?.addEventListener('input', () => {
        counter.textContent = `${desc.value.length} / 500`;
    });

    // Quick date
    initQuickDate(
        document.getElementById('due_date_quick'),
        document.getElementById('due_date')
    );

    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!validateForm()) return;

        const btn   = document.getElementById('submitBtn');
        const label = document.getElementById('btnLabel');
        btn.disabled = true;
        label.textContent = 'Salvando...';

        try {
            const res = await fetch(API_BASE, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                },
                body: JSON.stringify({
                    type:        document.getElementById('type').value,
                    description: desc.value.trim(),
                    due_date:    document.getElementById('due_date').value,
                    status:      document.getElementById('status').value,
                }),
            });

            if (!res.ok) throw new Error(await res.text());

            toast.classList.remove('hidden');
            toast.classList.add('flex');
            setTimeout(() => { window.location.href = '/exams'; }, 1400);

        } catch (err) {
            console.error(err);
            label.textContent = 'Salvar trabalho';
            btn.disabled = false;
        }
    });
}

/* ─── EDIT page ──────────────────────────────────────────────── */

function initEdit() {
    const form = document.getElementById('examForm');
    if (!form || !form.dataset.id) return;

    const examId      = form.dataset.id;
    const toast       = document.getElementById('toast');
    const deleteModal = document.getElementById('deleteModal');
    const cancelDelete= document.getElementById('cancelDelete');
    const confirmDel  = document.getElementById('confirmDelete');
    const deleteBtn   = document.getElementById('deleteBtn');

    // Pre-fill fields from data-* attrs
    const typeEl   = document.getElementById('type');
    const statusEl = document.getElementById('status');
    const descEl   = document.getElementById('description');
    const counter  = document.getElementById('charCounter');

    if (typeEl)   typeEl.value   = form.dataset.type   ?? '';
    if (statusEl) statusEl.value = form.dataset.status ?? '';
    if (descEl && counter) {
        counter.textContent = `${descEl.value.length} / 500`;
        descEl.addEventListener('input', () => {
            counter.textContent = `${descEl.value.length} / 500`;
        });
    }

    // Quick date
    initQuickDate(
        document.getElementById('due_date_quick'),
        document.getElementById('due_date')
    );

    // Submit — update
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        if (!validateForm()) return;

        const btn   = document.getElementById('submitBtn');
        const label = document.getElementById('btnLabel');
        btn.disabled = true;
        label.textContent = 'Salvando...';

        try {
            const res = await fetch(`${API_BASE}/${examId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                },
                body: JSON.stringify({
                    type:        document.getElementById('type').value,
                    description: descEl.value.trim(),
                    due_date:    document.getElementById('due_date').value,
                    status:      document.getElementById('status').value,
                }),
            });

            if (!res.ok) throw new Error(await res.text());

            toast.classList.remove('hidden');
            toast.classList.add('flex');
            setTimeout(() => { window.location.href = '/exams'; }, 1400);

        } catch (err) {
            console.error(err);
            label.textContent = 'Salvar alterações';
            btn.disabled = false;
        }
    });

    // Delete button
    deleteBtn?.addEventListener('click', () => {
        deleteModal.classList.remove('hidden');
        deleteModal.classList.add('flex');
    });

    cancelDelete?.addEventListener('click', () => {
        deleteModal.classList.add('hidden');
        deleteModal.classList.remove('flex');
    });

    confirmDel?.addEventListener('click', async () => {
        confirmDel.textContent = 'Excluindo...';
        confirmDel.disabled = true;
        try {
            await fetch(`${API_BASE}/${examId}`, {
                method: 'DELETE',
                headers: {
                    Accept: 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
                },
            });
            window.location.href = '/exams';
        } catch (err) {
            console.error(err);
            confirmDel.textContent = 'Sim, excluir';
            confirmDel.disabled = false;
        }
    });
}

/* ─── Validation (shared) ────────────────────────────────────── */

function validateForm() {
    let ok = true;

    // Type (only on exam forms)
    const typeEl  = document.getElementById('type');
    const errType = document.getElementById('err-type');
    if (typeEl && errType) {
        if (!typeEl.value) {
            errType.classList.remove('hidden'); ok = false;
        } else {
            errType.classList.add('hidden');
        }
    }

    const descEl  = document.getElementById('description');
    const errDesc = document.getElementById('err-description');
    if (!descEl.value.trim()) {
        errDesc.classList.remove('hidden'); ok = false;
    } else {
        errDesc.classList.add('hidden');
    }

    const dateEl  = document.getElementById('due_date');
    const errDate = document.getElementById('err-due_date');
    if (!dateEl.value) {
        errDate.classList.remove('hidden'); ok = false;
    } else {
        errDate.classList.add('hidden');
    }

    const statusEl  = document.getElementById('status');
    const errStatus = document.getElementById('err-status');
    if (!statusEl.value) {
        errStatus.classList.remove('hidden'); ok = false;
    } else {
        errStatus.classList.add('hidden');
    }

    return ok;
}

/* ─── Boot ───────────────────────────────────────────────────── */

document.addEventListener('DOMContentLoaded', () => {
    initIndex();
    initCreate();
    initEdit();
});