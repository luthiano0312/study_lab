
'use strict';


const MONTHS = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];

const SUBJECT_COLORS = [
    ['#fce7f3','#9d174d'],['#ede9fe','#5b21b6'],['#dbeafe','#1e40af'],
    ['#dcfce7','#166534'],['#fef9c3','#854d0e'],['#fee2e2','#991b1b'],
];

const STATUS_MAP = {
    pending:     ['#b45309','#fef9c3','Pendente'  ],
    in_progress: ['#1d4ed8','#dbeafe','Progresso' ],
    completed:   ['#166534','#dcfce7','Concluída' ],
};


const $         = id => document.getElementById(id);
const txt       = (id, v) => { const e=$(id); if(e) e.textContent=v; };
const hdrs      = () => ({ 'Content-Type':'application/json','Accept':'application/json','Authorization':`Bearer ${localStorage.getItem('auth_token')}` });
const isOverdue = d => d && new Date(d) < new Date(new Date().toDateString());
const avatarSrc = u => u.avatar ?? (u.preset_avatar!=null ? `/images/avatar${u.preset_avatar}.png` : null);
const fmtDate   = s => { if(!s) return '—'; const[y,m,d]=s.split('-'); return `${d}/${m}/${y}`; };
const badge     = (color,bg,label) => `<span class="text-xs font-bold px-2.5 py-1 rounded-full ml-3 shrink-0 whitespace-nowrap" style="color:${color};background:${bg}">${label}</span>`;


(function carousel() {
    const track = $('carouselTrack');
    const dots  = document.querySelectorAll('[data-dot]');
    const N     = dots.length;
    let cur=0, timer=null;

    function go(i) {
        cur = (i+N) % N;
        if(track) track.style.transform = `translateX(-${cur*100}%)`;
        dots.forEach((d,j) => {
            const active = j===cur;
            d.className = `h-1.5 rounded-full transition-all duration-300 ${active?'bg-pink-500 w-4':'bg-pink-200 w-1.5'}`;
        });
    }

    function reset() { clearInterval(timer); timer=setInterval(()=>go(cur+1),4000); }

    dots.forEach(d => d.addEventListener('click',()=>{ go(+d.dataset.dot); reset(); }));
    go(0); reset();
})();


function startClock() {
    const el=$('clock'), bar=$('weekBar');
    const tick=()=>{ if(el) el.textContent=new Date().toLocaleTimeString('pt-BR',{hour:'2-digit',minute:'2-digit'}); };
    tick(); setInterval(tick,1000);
    // anima barra de meta
    if(bar) setTimeout(()=>bar.style.width='65%',300);
}


async function loadUser() {
    try {
        const r=await fetch('/api/user',{headers:hdrs()}); if(!r.ok) return;
        const u=await r.json();
        txt('userName',  u.name||'Estudante');
        txt('greetName', u.name?.split(' ')[0]||'Estudante');
        const src=avatarSrc(u);
        if(src){
            const el=$('userAvatar'), fb=$('avatarFallback');
            if(el){el.src=src;el.classList.remove('hidden');}
            if(fb) fb.style.display='none';
        }
    } catch{}
}


async function loadActivities() {
    try {
        const r=await fetch('/api/activities',{headers:hdrs()}); if(!r.ok) return;
        const list=await r.json();

        let p=0,d=0,o=0;
        for(const a of list){
            if(a.status==='pending')   p++;
            if(a.status==='completed') d++;
            if(a.status!=='completed'&&isOverdue(a.due_date)) o++;
        }
        txt('statPending',p); txt('statDone',d); txt('statOverdue',o); txt('statTotal',list.length);

        const el=$('recentActivities'); if(!el) return;
        const recent=[...list].sort((a,b)=>new Date(b.updated_at)-new Date(a.updated_at)).slice(0,5);

        if(!recent.length){
            el.innerHTML='<p class="text-center text-sm text-gray-400 py-6">Nenhuma atividade ainda.</p>';
            return;
        }

        el.innerHTML=recent.map(a=>{
            const late=a.status!=='completed'&&isOverdue(a.due_date);
            const [color,bg,label]=late?['#dc2626','#fee2e2','Atrasada']:(STATUS_MAP[a.status]||STATUS_MAP.pending);
            const dot=late?'#ef4444':a.status==='completed'?'#22c55e':'#eab308';
            return `<div class="flex items-center justify-between px-6 py-3 hover:bg-pink-50/60 transition-colors">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="w-2 h-2 rounded-full shrink-0" style="background:${dot}"></div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">${a.title||a.description||'—'}</p>
                        <p class="text-xs text-gray-400 dark:text-white">${a.subject_name||''}${a.due_date?' · '+fmtDate(a.due_date):''}</p>
                    </div>
                </div>
                ${badge(color,bg,label)}
            </div>`;
        }).join('');
    } catch{}
}


async function loadExams() {
    try {
        const r=await fetch('/api/exams',{headers:hdrs()}); if(!r.ok) return;
        const upcoming=(await r.json())
            .filter(e=>e.status!=='completed'&&e.due_date)
            .sort((a,b)=>new Date(a.due_date)-new Date(b.due_date))
            .slice(0,4);

        const el=$('upcomingExams'); if(!el) return;

        if(!upcoming.length){
            el.innerHTML='<p class="text-center text-sm text-gray-400 py-5">Nenhuma prova próxima.</p>';
            return;
        }

        el.innerHTML=upcoming.map(e=>{
            const dt=new Date(e.due_date+'T00:00:00');
            const day=String(dt.getDate()).padStart(2,'0');
            const mon=MONTHS[dt.getMonth()];
            const days=Math.ceil((dt-new Date())/864e5);
            const urgent=days<=3;
            const tag=days<=0?'Hoje':days===1?'Amanhã':`${days}d`;
            return `<div class="flex items-center justify-between px-5 py-3 hover:bg-pink-50/60 transition-colors">
                <div class="flex items-center gap-3 min-w-0">
                    <div class="text-center shrink-0 w-10">
                        <div class="font-black text-gray-900 dark:text-white leading-none" style="font-family:'Syne',sans-serif;font-size:1.3rem">${day}</div>
                        <div class="text-[10px] font-bold uppercase text-gray-400 tracking-wider">${mon}</div>
                    </div>
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">${e.type||'Prova'}</p>
                        <p class="text-xs text-gray-400 truncate">${e.description||''}</p>
                    </div>
                </div>
                ${badge(urgent?'#dc2626':'#db2777',urgent?'#fee2e2':'#fce7f3',tag)}
            </div>`;
        }).join('');
    } catch{}
}


async function loadSubjects() {
    try {
        const r=await fetch('/api/subjects',{headers:hdrs()}); if(!r.ok) return;
        const list=await r.json();
        txt('statSubjects',list.length);

        const el=$('subjectsList'); if(!el) return;
        el.innerHTML=list.slice(0,5).map((s,i)=>{
            const [bg,color]=SUBJECT_COLORS[i%SUBJECT_COLORS.length];
            const abbr=(s.abbreviation||s.name||'?').slice(0,3).toUpperCase();
            return `<div class="flex items-center gap-3 px-5 py-2.5 hover:bg-pink-500/10 transition-colors">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center text-[10px] font-black shrink-0" style="background:${bg};color:${color}">${abbr}</div>
                <div class="min-w-0">
                    <p class="text-sm font-semibold text-gray-800 dark:text-white truncate">${s.name}</p>
                    <p class="text-xs text-gray-400 dark:text-white truncate">${s.teacher||'Sem professor'}</p>
                </div>
            </div>`;
        }).join('');
    } catch{}
}


function animateCounters() {
    document.querySelectorAll('[data-counter]').forEach(el=>{
        const target=parseInt(el.textContent)||0; if(!target) return;
        let cur=0; const step=Math.ceil(target/20);
        const t=setInterval(()=>{ cur=Math.min(cur+step,target); el.textContent=cur; if(cur>=target) clearInterval(t); },40);
    });
}


document.addEventListener('DOMContentLoaded',async()=>{
    startClock();
    await loadUser();
    await Promise.all([loadActivities(),loadExams(),loadSubjects()]);
    setTimeout(animateCounters,100);
});