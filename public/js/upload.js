'use strict';

const API = 'http://127.0.0.1:8000/api';
const $   = id => document.getElementById(id);
const tok = () => localStorage.getItem('auth_token');
const hdrs = (ct = false) => ({
    'Accept': 'application/json',
    'Authorization': `Bearer ${tok()}`,
    ...(ct ? { 'Content-Type': 'application/json' } : {}),
});

function escHtml(str) {
    return String(str ?? '')
        .replace(/&/g,'&amp;').replace(/</g,'&lt;')
        .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

function fmtDate(iso) {
    return new Date(iso).toLocaleDateString('pt-BR', { day:'2-digit', month:'2-digit', year:'numeric' });
}

let toastTimer;
function toast(msg) {
    const t = $('toast'); if (!t) return;
    $('toastMsg').textContent = msg;
    t.classList.remove('hidden');
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => t.classList.add('hidden'), 3000);
}

function showErr(id, msg) {
    const e = $(id); if (!e) return;
    e.textContent = msg;
    e.classList.remove('hidden');
}
function clearErrs() {
    ['err-title','err-image'].forEach(id => {
        const e = $(id); if (!e) return;
        e.textContent = '';
        e.classList.add('hidden');
    });
}

// ── render card ──
function renderCard(s) {
    const card = document.createElement('div');
    card.className = 'hl-card overflow-hidden group';
    card.dataset.id = s.id;
    card.innerHTML = `
        <div class="relative overflow-hidden cursor-pointer" style="height:176px;background:var(--input-bg);"
             data-action="view" data-id="${s.id}"
             data-title="${escHtml(s.title || 'Sem título')}"
             data-url="${escHtml(s.image_url)}">
            <img src="${escHtml(s.image_url)}" alt="${escHtml(s.title || '')}"
                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                onerror="this.style.display='none';this.nextElementSibling.style.display='flex'">
            <div style="display:none;position:absolute;inset:0;flex-direction:column;align-items:center;justify-content:center;gap:6px;background:var(--input-bg);">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="1.5" stroke-linecap="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                <span style="font-size:10px;color:var(--faint);font-weight:600;">Imagem indisponível</span>
                <span style="font-size:9px;color:var(--faint);max-width:140px;text-align:center;word-break:break-all;">${escHtml(s.image_url)}</span>
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-3">
                <span class="text-white text-xs font-bold">Ver em tela cheia</span>
            </div>
        </div>
        <div class="p-4">
            <div class="flex items-start justify-between gap-2">
                <div class="min-w-0">
                    <p class="text-sm font-bold truncate" style="color:var(--text)">${escHtml(s.title || 'Sem título')}</p>
                    <p class="text-[11px] mt-0.5" style="color:var(--faint)">${fmtDate(s.created_at)}</p>
                </div>
                <div class="flex gap-1 shrink-0">
                    <button class="w-7 h-7 rounded-lg flex items-center justify-center hover:bg-pink-500/10 text-pink-500 transition-colors"
                            data-action="edit" data-id="${s.id}" data-title="${escHtml(s.title || '')}">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/>
                            <path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>
                        </svg>
                    </button>
                    <button class="w-7 h-7 rounded-lg flex items-center justify-center hover:bg-red-500/10 text-red-400 transition-colors"
                            data-action="delete" data-id="${s.id}">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6l-1 14H6L5 6"/>
                            <path d="M9 6V4h6v2"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>`;
    return card;
}

function renderEmpty() {
    const d = document.createElement('div');
    d.className = 'col-span-full flex flex-col items-center justify-center py-20 gap-3';
    d.innerHTML = `
        <div class="w-16 h-16 rounded-2xl bg-pink-500/10 flex items-center justify-center text-3xl mb-1">📅</div>
        <p class="font-bold text-sm" style="color:var(--text)">Nenhum horário cadastrado</p>
        <p class="text-xs" style="color:var(--faint)">Clique em "Adicionar horário" para começar.</p>`;
    return d;
}

async function loadSchedules() {
    const grid = $('scheduleGrid');
    try {
        const res  = await fetch(`${API}/scheduleImages`, { headers: hdrs() });
        const json = await res.json();

        console.log('[horary] resposta da API:', json);

        // Suporte a { data: [...] } e [ ... ] direto
        const list = Array.isArray(json) ? json : (json.data || []);

        const count = $('totalCount');
        if (count) count.textContent = list.length;

        grid.innerHTML = '';
        if (!list.length) { grid.appendChild(renderEmpty()); return; }

        list.forEach(s => {
            console.log('[horary] item:', s.id, s.title, s.image_url);
            grid.appendChild(renderCard(s));
        });

    } catch (err) {
        console.error('[horary] loadSchedules error:', err);
        const count = $('totalCount');
        if (count) count.textContent = '—';
        grid.innerHTML = '';
        grid.appendChild(renderEmpty());
    }
}

// ── tudo dentro de DOMContentLoaded ──
document.addEventListener('DOMContentLoaded', () => {

    // ── upload panel ──
    $('openUploadBtn').addEventListener('click', () => {
        $('uploadPanel').classList.remove('hidden');
        $('uploadTitle')?.focus();
    });

    function closeUpload() {
        $('uploadPanel').classList.add('hidden');
        if ($('uploadTitle'))  $('uploadTitle').value = '';
        if ($('imageFile'))    $('imageFile').value   = '';
        resetDropZone();
        clearErrs();
    }

    $('closeUploadBtn')?.addEventListener('click',  closeUpload);
    $('cancelUploadBtn')?.addEventListener('click', closeUpload);

    // ── drop zone ──
    const dropZone = $('dropZone');

    ['dragenter','dragover'].forEach(ev =>
        dropZone.addEventListener(ev, e => { e.preventDefault(); dropZone.classList.add('drag-over'); })
    );
    ['dragleave','drop'].forEach(ev =>
        dropZone.addEventListener(ev, e => { e.preventDefault(); dropZone.classList.remove('drag-over'); })
    );
    dropZone.addEventListener('drop', e => {
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            $('imageFile').files = dt.files;
            showPreview(file);
        }
    });

    $('imageFile').addEventListener('change', function () {
        if (this.files[0]) showPreview(this.files[0]);
    });

    function showPreview(file) {
        const reader = new FileReader();
        reader.onload = ev => {
            $('previewImg').src = ev.target.result;
            $('previewName').textContent = file.name;
            $('dropPreview').classList.remove('hidden');
            $('dropPlaceholder').classList.add('hidden');
        };
        reader.readAsDataURL(file);
    }

    function resetDropZone() {
        $('dropPreview')?.classList.add('hidden');
        $('dropPlaceholder')?.classList.remove('hidden');
        if ($('previewImg')) $('previewImg').src = '';
    }

    // ── submit upload ──
    $('submitUploadBtn').addEventListener('click', async () => {
        clearErrs();
        const title = $('uploadTitle').value.trim();
        const file  = $('imageFile').files[0];
        let valid = true;
        if (!title) { showErr('err-title', 'Informe um título para o horário.'); valid = false; }
        if (!file)  { showErr('err-image', 'Selecione uma imagem.'); valid = false; }
        if (!valid) return;

        const btn   = $('submitUploadBtn');
        const label = $('submitLabel');
        btn.disabled = true; label.textContent = 'Enviando...';

        const form = new FormData();
        form.append('title', title);
        form.append('image', file);

        try {
            const res  = await fetch(`${API}/scheduleImages`, { method: 'POST', headers: hdrs(), body: form });
            const data = await res.json().catch(() => ({}));

            if (res.ok || res.status === 201) {
                toast('Horário enviado com sucesso!');
                closeUpload();
                loadSchedules();
            } else {
                // Mostra todos os erros de validação do Laravel
                if (data.errors) {
                    const allErrors = Object.values(data.errors).flat();
                    if (data.errors.title) showErr('err-title', data.errors.title[0]);
                    if (data.errors.image) showErr('err-image', data.errors.image[0]);
                    // Erros que não têm campo específico vão pro toast
                    const otherErrors = Object.entries(data.errors)
                        .filter(([k]) => k !== 'title' && k !== 'image')
                        .map(([, v]) => v[0]);
                    if (otherErrors.length) toast(otherErrors[0]);
                } else {
                    toast(data.message || `Erro ${res.status}: falha ao enviar.`);
                }
                console.error('[horary] upload error:', res.status, data);
            }
        } catch (err) {
            toast('Erro de conexão. Verifique sua rede.');
            console.error('[horary] fetch error:', err);
        }

        btn.disabled = false; label.textContent = 'Enviar horário';
    });

    // ── delegated clicks no grid ──
    $('scheduleGrid').addEventListener('click', e => {
        const btn = e.target.closest('[data-action]'); if (!btn) return;
        const { action, id, title, url } = btn.dataset;

        if (action === 'view') {
            $('modalViewTitle').textContent = title || '';
            $('modalViewImg').src           = url  || '';
            $('viewModal').classList.remove('hidden');
        }
        if (action === 'edit') {
            $('editId').value    = id;
            $('editTitle').value = title || '';
            $('editFileName').textContent = 'Clique para trocar a imagem';
            if ($('editImageFile')) $('editImageFile').value = '';
            $('editModal').classList.remove('hidden');
        }
        if (action === 'delete') {
            $('deleteId').value = id;
            $('deleteModal').classList.remove('hidden');
        }
    });

    // ── modal visualizar ──
    $('closeViewModal').addEventListener('click', () => $('viewModal').classList.add('hidden'));
    $('viewModal').addEventListener('click', e => {
        if (e.target === $('viewModal')) $('viewModal').classList.add('hidden');
    });

    // ── modal editar ──
    $('editImageFile').addEventListener('change', function () {
        $('editFileName').textContent = this.files[0]?.name || 'Clique para trocar a imagem';
    });

    function closeEditModal() { $('editModal').classList.add('hidden'); }
    $('closeEditModal').addEventListener('click', closeEditModal);
    $('cancelEditBtn').addEventListener('click',  closeEditModal);

    $('confirmEditBtn').addEventListener('click', async () => {
        const id    = $('editId').value;
        const title = $('editTitle').value.trim();
        const file  = $('editImageFile').files[0];
        if (!title) return;

        const btn   = $('confirmEditBtn');
        const label = $('editLabel');
        btn.disabled = true; label.textContent = 'Salvando...';

        const form = new FormData();
        form.append('title', title);
        form.append('_method', 'PUT');
        if (file) form.append('image', file);

        try {
            const res = await fetch(`${API}/scheduleImages/${id}`, { method: 'POST', headers: hdrs(), body: form });
            if (res.ok) {
                toast('Horário atualizado!');
                closeEditModal();
                loadSchedules();
            } else {
                toast('Erro ao atualizar.');
            }
        } catch { toast('Erro de conexão.'); }

        btn.disabled = false; label.textContent = 'Salvar';
    });

    // ── modal excluir ──
    function closeDeleteModal() { $('deleteModal').classList.add('hidden'); }
    $('cancelDeleteBtn').addEventListener('click', closeDeleteModal);

    $('confirmDeleteBtn').addEventListener('click', async () => {
        const id = $('deleteId').value;
        try {
            const res = await fetch(`${API}/scheduleImages/${id}`, { method: 'DELETE', headers: hdrs() });
            if (res.ok) {
                toast('Horário excluído!');
                closeDeleteModal();
                loadSchedules();
            } else {
                toast('Erro ao excluir.');
            }
        } catch { toast('Erro de conexão.'); }
    });

    // ── init ──
    loadSchedules();
});