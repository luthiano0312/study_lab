{{-- resources/views/components/choose-plane.blade.php --}}

<div id="planFree"
     onclick="selectPlan('free')"
     class="group/card relative flex-1 cursor-pointer rounded-2xl p-[1.5px] transition-all duration-300 hover:-translate-y-1"
     style="background:linear-gradient(135deg,#f9a8d4,#db2777);">

    <div class="relative h-full rounded-2xl bg-white p-5 flex flex-col overflow-hidden">

        <div class="absolute -left-10 -top-10 w-24 h-24 rounded-full opacity-0 group-hover/card:opacity-100 transition-opacity duration-500 pointer-events-none"
             style="background:radial-gradient(circle,#fce7f3 0%,transparent 70%);"></div>

        <div class="absolute top-3 right-3">
            <div class="plan-check w-4 h-4 rounded-full bg-pink-500 flex items-center justify-center opacity-100 transition-all duration-200">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <span class="text-[10px] font-black uppercase tracking-widest text-pink-500 mb-2">Free</span>

        <div class="flex items-baseline gap-1 mb-0.5">
            <span class="text-[28px] font-black text-gray-900 leading-none">R$ 0</span>
        </div>
        <p class="text-[11px] text-gray-400 mb-4">para sempre</p>

        <ul class="flex flex-col gap-2 flex-1">
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Calendário de provas</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Matérias ilimitadas</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Atividades ilimitadas</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Conteúdos ilimitados</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Provas e trabalhos ilimitados</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Notas e boletim</span>
            </li>
            <li class="flex items-start gap-2 text-left opacity-40">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center bg-gray-100">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </div>
                <span class="text-[11px] text-gray-400 leading-tight">Relatórios avançados</span>
            </li>
            <li class="flex items-start gap-2 text-left opacity-40">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center bg-gray-100">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </div>
                <span class="text-[11px] text-gray-400 leading-tight">Suporte prioritário</span>
            </li>
            <li class="flex items-start gap-2 text-left opacity-40">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center bg-gray-100">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </div>
                <span class="text-[11px] text-gray-400 leading-tight">Chat com IA para dúvidas</span>
            </li>
        </ul>

    </div>
</div>

<div id="planPremium"
     onclick="selectPlan('premium')"
     class="group/card relative flex-1 cursor-pointer rounded-2xl p-[1.5px] transition-all duration-300 hover:-translate-y-1"
     style="background:linear-gradient(135deg,#e5e7eb,#d1d5db);">

    <div class="relative h-full rounded-2xl bg-white p-5 flex flex-col overflow-hidden">

        <div class="absolute top-0 left-0 right-0 h-[2px] rounded-t-2xl"
             style="background:linear-gradient(90deg,#db2777,#f472b6,#fda4af);"></div>

        <div class="absolute -right-10 -top-10 w-28 h-28 rounded-full opacity-0 group-hover/card:opacity-100 transition-opacity duration-500 pointer-events-none"
             style="background:radial-gradient(circle,#fce7f3 0%,transparent 70%);"></div>

        <div class="absolute top-3 right-3">
            <div class="plan-check w-4 h-4 rounded-full flex items-center justify-center opacity-0 transition-all duration-200" style="background:#e5e7eb;">
                <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="3.5"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
        </div>

        <div class="absolute top-2 left-1/2 -translate-x-1/2">
            <span class="text-[8px] font-black uppercase tracking-widest px-2.5 py-0.5 rounded-full text-white"
                  style="background:linear-gradient(90deg,#db2777,#f472b6);">Popular</span>
        </div>

        <span class="text-[10px] font-black uppercase tracking-widest text-pink-500 mb-2 mt-4">Professional</span>

        <div class="flex items-baseline gap-1 mb-0.5">
            <span class="text-[28px] font-black text-gray-900 leading-none">R$ 14</span>
            <span class="text-[13px] font-semibold text-gray-400">,90</span>
        </div>
        <p class="text-[11px] text-gray-400 mb-4">por mês</p>

        <ul class="flex flex-col gap-2 flex-1">
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Tudo do Free</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Chat com IA para dúvidas</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Suporte prioritário</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Relatórios avançados</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Criação de grupos de estudos</span>
            </li>
            <li class="flex items-start gap-2 text-left">
                <div class="mt-0.5 w-4 h-4 rounded-full shrink-0 flex items-center justify-center" style="background:#fce7f3;">
                    <svg width="8" height="8" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
                <span class="text-[11px] text-gray-600 leading-tight">Suporte para estudos</span>
            </li>
        </ul>

        <div class="mt-4 flex items-center justify-center gap-1.5">
            <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" stroke-linejoin="round" stroke-linecap="round"/></svg>
            <span class="text-[9px] text-gray-400 font-medium">Cancele quando quiser</span>
        </div>

    </div>
</div>