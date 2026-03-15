@props(['id' => 'finishBtn'])

<div class="w-full flex justify-center mt-6">
    <button
        {{ $attributes->merge(['id' => $id]) }}
        onclick="finish(false)"
        class="final-bt group relative overflow-hidden
               px-8 py-3 rounded-full
               border-2 border-pink-500 text-pink-500
               font-semibold text-[13px] tracking-widest uppercase
               transition-all duration-500 cursor-pointer
               hover:text-white hover:shadow-[0_0_24px_#ec489966]"
    >

        <span class="absolute inset-0 bg-linear-to-r from-[#be185d] via-[#ec4899] to-[#f472b6]
                     translate-y-full group-hover:translate-y-0
                     transition-transform duration-500 ease-in-out rounded-full z-0"></span>

        <span class="relative z-10 flex items-center gap-2">
            Entrar no StudyLab
            <svg class="w-3.5 h-3.5 transition-transform duration-300 group-hover:translate-x-1"
                 viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <path d="M5 12h14M13 6l6 6-6 6"/>
            </svg>
        </span>

    </button>
</div>

<canvas id="confettiCanvas"
          class="pointer-events-none fixed inset-0 w-full h-full"
        style="display:none; z-index:9999;"></canvas>

<style>
.final-bt { background: transparent; }
</style>

<script>
(function () {

    const COLORS = [
        '#be185d','#db2777','#ec4899','#f472b6','#f9a8d4',
        '#5b21b6','#7c3aed','#a78bfa',
        '#1e40af','#2563eb','#60a5fa',
        '#065f46','#059669','#34d399',
        '#c2410c','#ea580c','#fb923c',
        '#fcd34d','#f59e0b',
        '#ffffff'
    ];

    let particles = [];
    let raf = null;
    let canvas = document.getElementById('confettiCanvas');
    let ctx = canvas.getContext('2d');

    function initCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    function randomBetween(a,b){
        return a + Math.random()*(b-a);
    }

    function spawnParticles(cx,cy){
        particles = [];

        for(let i=0;i<120;i++){

            const angle = randomBetween(0,Math.PI*2);
            const speed = randomBetween(3,11);

            particles.push({
                x:cx,
                y:cy,
                vx:Math.cos(angle)*speed,
                vy:Math.sin(angle)*speed-randomBetween(2,6),
                size:randomBetween(5,13),
                color:COLORS[Math.floor(Math.random()*COLORS.length)],
                alpha:1,
                rot:randomBetween(0,Math.PI*2),
                rotV:randomBetween(-0.15,0.15),
                gravity:randomBetween(0.18,0.35)
            });
        }
    }

    function drawFrame(){

        ctx.clearRect(0,0,canvas.width,canvas.height);

        let alive=false;

        particles.forEach(p=>{

            if(p.alpha<=0)return;

            alive=true;

            p.x+=p.vx;
            p.vy+=p.gravity;
            p.y+=p.vy;
            p.rot+=p.rotV;
            p.alpha-=0.017;

            ctx.save();
            ctx.globalAlpha=p.alpha;
            ctx.fillStyle=p.color;

            ctx.translate(p.x,p.y);
            ctx.rotate(p.rot);

            ctx.fillRect(-p.size/2,-p.size/4,p.size,p.size/2);

            ctx.restore();

        });

        if(alive){
            raf=requestAnimationFrame(drawFrame);
        }else{
            canvas.style.display='none';
        }

    }

    window.fireConfettiBtn = function(btn) {
        if(!btn) return;
        initCanvas();

        const rect=btn.getBoundingClientRect();

        const cx=rect.left+rect.width/2;
        const cy=rect.top+rect.height/2;

        canvas.style.display='block';

        spawnParticles(cx,cy);

        raf=requestAnimationFrame(drawFrame);

    };

    document.addEventListener("DOMContentLoaded",()=>{
        const btn=document.getElementById("{{ $id }}");

        if(!btn)return;

        btn.addEventListener("mouseenter",()=>{
            window.fireConfettiBtn(btn);
        });

    });

})();
</script>