'use strict';

const DAYS_PT     = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'];
const DAYS_FULL   = ['Domingo','Segunda-feira','Terça-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sábado'];
const MONTHS_PT   = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
const MONTHS_FULL = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
const API  = '/api/exams';
const hdrs = () => ({ 'Content-Type':'application/json','Accept':'application/json','Authorization':`Bearer ${localStorage.getItem('auth_token')}` });

let allExams    = [];
let allSubjects = [];
let weekOffset  = 0;

const $       = id => document.getElementById(id);
const isoDate = d  => d.toISOString().slice(0,10);

function weekDates(offset = 0) {
    const now = new Date();
    const day = now.getDay();
    const mon = new Date(now);
    mon.setDate(now.getDate() - (day === 0 ? 6 : day - 1) + offset * 7);
    return Array.from({ length: 5 }, (_, i) => {
        const d = new Date(mon); d.setDate(mon.getDate() + i); return d;
    });
}

function showToast(msg) {
    $('toastMsg').textContent = msg;
    const t = $('toast'); t.style.display = 'flex';
    setTimeout(() => { t.style.display = 'none'; }, 2800);
}

function renderCalendar() {
    const days     = weekDates(weekOffset);
    const todayISO = isoDate(new Date());

    const m1 = days[0], m2 = days[4];
    $('weekLabel').textContent =
        `${m1.getDate()} de ${MONTHS_PT[m1.getMonth()]} – ${m2.getDate()} de ${MONTHS_PT[m2.getMonth()]} de ${m2.getFullYear()}`;

    $('calHead').innerHTML = days.map(d => {
        const isToday = isoDate(d) === todayISO;
        return `<th style="width:20%;padding:10px 8px;text-align:center;">
      <div class="inline-flex flex-col items-center gap-0.5 px-3 py-1.5 rounded-xl ${isToday ? 'bg-pink-600' : ''}">
        <span class="text-[9px] font-black tracking-widest uppercase ${isToday ? 'text-pink-200' : 'text-gray-400'}">${DAYS_PT[d.getDay()]}</span>
        <span class="font-black leading-none text-xl ${isToday ? 'text-white' : 'text-gray-800'}" style="font-family:'Syne',sans-serif;">${d.getDate()}</span>
        <span class="text-[9px] font-bold ${isToday ? 'text-pink-200' : 'text-gray-400'}">${MONTHS_PT[d.getMonth()]}</span>
      </div>
    </th>`;
    }).join('');

    const cardCls = {
        pending:     'bg-orange-50 border border-orange-200 text-orange-700',
        in_progress: 'bg-blue-50 border border-blue-200 text-blue-700',
        completed:   'bg-green-50 border border-green-200 text-green-700',
    };
    const badgeCls = {
        pending:     'bg-orange-100 text-orange-700',
        in_progress: 'bg-blue-100 text-blue-700',
        completed:   'bg-green-100 text-green-700',
    };
    const badgeTxt = { pending:'Pendente', in_progress:'Andamento', completed:'Concluída' };

    $('calBody').innerHTML = days.map(d => {
        const iso      = isoDate(d);
        const isToday  = iso === todayISO;
        const dayExams = allExams.filter(e => e.due_date?.slice(0,10) === iso);

        const cards = dayExams.map(e => {
            const cs = cardCls[e.status]  || cardCls.pending;
            const bs = badgeCls[e.status] || badgeCls.pending;
            const bl = badgeTxt[e.status] || 'Pendente';
            return `<div onclick="openEdit(${e.id})"
                   class="relative rounded-xl p-2 mb-1 cursor-pointer hover:-translate-y-px hover:shadow-md transition-all ${cs}">
        <p class="text-[11px] font-black leading-tight truncate">${e.type}</p>
        <p class="text-[10px] opacity-70 mt-0.5 truncate">${e.description}${e.time_info ? ' · <svg style="display:inline;vertical-align:middle;" width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg> ' + e.time_info : ''}</p>
        <span class="inline-flex items-center mt-1 text-[9px] font-black uppercase tracking-wider px-1.5 py-0.5 rounded-full ${bs}">${bl}</span>
      </div>`;
        }).join('');

        const addLabel = `${DAYS_FULL[d.getDay()]}, ${d.getDate()} de ${MONTHS_FULL[d.getMonth()]}`;
        return `<td class="${isToday ? 'bg-pink-50/40' : ''}"
               style="padding:8px 6px;vertical-align:top;border-top:1px solid #fce7f3;min-height:80px;min-width:120px;">
      <div class="min-h-16">
        ${cards}
        <button onclick="openNew('${iso}','${addLabel}')"
                class="w-full mt-1 flex items-center justify-center gap-1 bg-pink-50 hover:bg-pink-100 border border-dashed border-pink-200 text-pink-600 rounded-xl py-1.5 text-[11px] font-black cursor-pointer transition-colors">
          <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
          Adicionar
        </button>
      </div>
    </td>`;
    }).join('');
}

function renderStats() {
    $('statTotal').textContent    = allExams.length;
    $('statPending').textContent  = allExams.filter(e => e.status === 'pending').length;
    $('statProgress').textContent = allExams.filter(e => e.status === 'in_progress').length;
    $('statDone').textContent     = allExams.filter(e => e.status === 'completed').length;
}

async function loadSubjects() {
    try {
        const r = await fetch('/api/subjects', { headers: hdrs() });
        if (!r.ok) return;
        allSubjects = await r.json();
        populateSubjectSelect();
    } catch (e) { console.error(e); }
}

function populateSubjectSelect() {
    const sel = $('modalDesc'); if (!sel) return;
    sel.innerHTML = '<option value="" disabled selected>Selecione uma matéria...</option>';
    allSubjects.forEach(s => {
        const opt = document.createElement('option');
        opt.value       = s.name;
        opt.textContent = s.abbreviation ? `${s.name} (${s.abbreviation})` : s.name;
        sel.appendChild(opt);
    });
    const outro = document.createElement('option');
    outro.value       = '__outro__';
    outro.textContent = '✏️ Digitar manualmente...';
    sel.appendChild(outro);
}

async function loadExams() {
    try {
        const r = await fetch(API, { headers: hdrs() });
        if (!r.ok) return;
        allExams = await r.json();
        renderCalendar();
        renderStats();
    } catch (e) { console.error(e); }
}

function getDescValue() {
    const sel = $('modalDesc').value;
    return sel === '__outro__' ? $('descCustom').value.trim() : (sel || '').trim();
}

function setDescValue(value) {
    if (!value) { $('modalDesc').value = ''; $('descCustom').classList.add('hidden'); return; }
    const opts = Array.from($('modalDesc').options).map(o => o.value);
    if (opts.includes(value)) {
        $('modalDesc').value = value;
        $('descCustom').classList.add('hidden');
    } else {
        $('modalDesc').value = '__outro__';
        $('descCustom').classList.remove('hidden');
        $('descCustom').value = value;
    }
}

function resetModal() {
    $('modalType').value  = 'Prova';
    $('typeCustom').value = '';
    $('typeCustomWrap').classList.add('hidden');
    $('modalDesc').value  = '';
    $('descCustom').value = '';
    $('descCustom').classList.add('hidden');
    $('modalTime').value  = '';
    document.querySelectorAll('[name="modalStatus"]').forEach(r => r.checked = r.value === 'pending');
    updateStatusLabels();
    $('modalDelete').classList.add('hidden');
    $('modalDelete').classList.remove('flex');
    $('modalExamId').value = '';
    $('errType').classList.add('hidden');
    $('errDesc').classList.add('hidden');
}

function updateStatusLabels() {
    const val = document.querySelector('[name="modalStatus"]:checked')?.value;
    const cfg = {
        pending:     { on: 'border-orange-200 bg-orange-50 text-orange-700', off: 'border-gray-200 bg-gray-50 text-gray-400' },
        in_progress: { on: 'border-blue-200 bg-blue-50 text-blue-700',      off: 'border-gray-200 bg-gray-50 text-gray-400' },
        completed:   { on: 'border-green-200 bg-green-50 text-green-700',   off: 'border-gray-200 bg-gray-50 text-gray-400' },
    };
    const map  = { pending: 'lblPending', in_progress: 'lblProgress', completed: 'lblDone' };
    const base = 'flex-1 flex items-center justify-center gap-1 py-2 rounded-xl border-2 cursor-pointer text-[11px] font-black uppercase tracking-wider transition-all';
    Object.entries(map).forEach(([v, id]) => {
        $(id).className = `${base} ${v === val ? cfg[v].on : cfg[v].off}`;
    });
}

function showModal() { $('examModal').style.display = 'flex'; setTimeout(() => $('modalDesc').focus(), 80); }
function hideModal() { $('examModal').style.display = 'none'; }

function openNew(iso, dateLabel) {
    resetModal();
    $('modalTitle').textContent     = 'Nova prova';
    $('modalSaveLabel').textContent = 'Salvar prova';
    $('modalDateLabel').textContent = dateLabel;
    $('modalDate').value            = iso;
    showModal();
}

function openEdit(id) {
    const e = allExams.find(x => x.id === id); if (!e) return;
    resetModal();
    $('modalTitle').textContent     = 'Editar prova';
    $('modalSaveLabel').textContent = 'Salvar alterações';
    $('modalExamId').value          = id;

    const d = new Date(e.due_date + 'T00:00:00');
    $('modalDateLabel').textContent = `${DAYS_FULL[d.getDay()]}, ${d.getDate()} de ${MONTHS_FULL[d.getMonth()]}`;
    $('modalDate').value            = e.due_date?.slice(0, 10) || '';

    const opts = Array.from($('modalType').options).map(o => o.value);
    if (opts.includes(e.type)) {
        $('modalType').value = e.type;
    } else {
        $('modalType').value = 'Outro';
        $('typeCustomWrap').classList.remove('hidden');
        $('typeCustom').value = e.type;
    }

    setDescValue(e.description || '');
    $('modalTime').value = e.time_info || '';

    const r = document.querySelector(`[name="modalStatus"][value="${e.status}"]`);
    if (r) r.checked = true;
    updateStatusLabels();

    $('modalDelete').classList.remove('hidden');
    $('modalDelete').classList.add('flex');
    showModal();
}

async function saveExam() {
    const typeVal = $('modalType').value === 'Outro' ? $('typeCustom').value.trim() : $('modalType').value;
    const desc    = getDescValue();
    let ok        = true;

    typeVal ? $('errType').classList.add('hidden') : ($('errType').classList.remove('hidden'), ok = false);
    desc    ? $('errDesc').classList.add('hidden') : ($('errDesc').classList.remove('hidden'), ok = false);
    if (!ok) return;

    const status   = document.querySelector('[name="modalStatus"]:checked')?.value || 'pending';
    const dueDate  = $('modalDate').value;
    const examId   = $('modalExamId').value;
    const timeInfo = $('modalTime').value.trim();
    const payload  = { type: typeVal, description: desc, due_date: dueDate, status };
    if (timeInfo) payload.time_info = timeInfo;

    const btn = $('modalSave');
    btn.disabled = true;
    $('modalSaveLabel').textContent = 'Salvando...';

    try {
        const isEdit = !!examId;
        const r = await fetch(isEdit ? `${API}/${examId}` : API, {
            method: isEdit ? 'PUT' : 'POST',
            headers: hdrs(),
            body: JSON.stringify(payload),
        });
        if (!r.ok) { const d = await r.json(); showToast(d.message || 'Erro ao salvar.'); return; }
        hideModal();
        await loadExams();
        showToast(isEdit ? 'Prova atualizada! ✓' : 'Prova cadastrada! ✓');
    } catch (e) { console.error(e); showToast('Erro de conexão.'); }
    finally {
        btn.disabled = false;
        $('modalSaveLabel').textContent = $('modalExamId').value ? 'Salvar alterações' : 'Salvar prova';
    }
}

async function deleteExam() {
    const id = $('modalExamId').value; if (!id) return;
    if (!confirm('Excluir esta prova?')) return;
    try {
        const r = await fetch(`${API}/${id}`, { method: 'DELETE', headers: hdrs() });
        if (!r.ok) return;
        hideModal(); await loadExams(); showToast('Prova excluída.');
    } catch (e) { console.error(e); }
}

document.addEventListener('DOMContentLoaded', () => {
    loadExams();
    loadSubjects();

    $('prevWeek').addEventListener('click', () => { weekOffset--; renderCalendar(); });
    $('nextWeek').addEventListener('click', () => { weekOffset++; renderCalendar(); });
    $('todayBtn').addEventListener('click', () => { weekOffset = 0; renderCalendar(); });

    $('modalClose').addEventListener('click', hideModal);
    $('modalCancel').addEventListener('click', hideModal);
    $('modalSave').addEventListener('click', saveExam);
    $('modalDelete').addEventListener('click', deleteExam);

    $('examModal').addEventListener('click', e => { if (e.target === $('examModal')) hideModal(); });

    $('modalType').addEventListener('change', () => {
        $('typeCustomWrap').classList.toggle('hidden', $('modalType').value !== 'Outro');
    });

    $('modalTime').addEventListener('input', function () {
    const raw = this.value.replace(/\D/g, '').slice(0, 8);
    let out = raw.slice(0, 2);
    if (raw.length > 2) out += ':' + raw.slice(2, 4);
    if (raw.length > 4) out += ' - ' + raw.slice(4, 6);
    if (raw.length > 6) out += ':' + raw.slice(6, 8);
    this.value = out;
  });

  $('modalDesc').addEventListener('change', () => {
        $('descCustom').classList.toggle('hidden', $('modalDesc').value !== '__outro__');
        if ($('modalDesc').value === '__outro__') $('descCustom').focus();
        $('errDesc').classList.add('hidden');
    });

    $('modalTime').addEventListener('input', function () {
        const raw = this.value.replace(/\D/g, '').slice(0, 8);
        let out = raw.slice(0, 2);
        if (raw.length > 2) out += ':' + raw.slice(2, 4);
        if (raw.length > 4) out += ' - ' + raw.slice(4, 6);
        if (raw.length > 6) out += ':' + raw.slice(6, 8);
        this.value = out;
    });

    document.querySelectorAll('[name="modalStatus"]').forEach(r => {
        r.addEventListener('change', updateStatusLabels);
    });
});