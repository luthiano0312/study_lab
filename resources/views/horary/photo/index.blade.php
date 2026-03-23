@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/horary.css') }}">

    <div class="min-h-screen relative overflow-hidden" style="background:var(--bg)">

        <!-- background decorativo -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden z-0">
            <!-- dot pattern -->
            <div class="absolute inset-0"
                style="background-image:radial-gradient(circle,rgba(219,39,119,.15) 1.5px,transparent 1.5px);background-size:30px 30px;opacity:.5;">
            </div>
            <!-- glows -->
            <div class="absolute top-0 left-0 w-full h-full"
                style="background:radial-gradient(ellipse 60% 50% at 0% 0%,rgba(219,39,119,.1) 0,transparent 70%);"></div>
            <div class="absolute bottom-0 right-0 w-full h-full"
                style="background:radial-gradient(ellipse 60% 50% at 100% 100%,rgba(139,92,246,.08) 0,transparent 70%);">
            </div>
            <!-- blobs -->
            <div class="fa absolute -top-20 -left-20 w-96 h-96 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] blur-[65px]"
                style="background:rgba(219,39,119,.12);"></div>
            <div class="fb absolute top-1/3 -right-16 w-72 h-72 rounded-[30%_70%_70%_30%/30%_30%_70%_70%] blur-[70px]"
                style="background:rgba(139,92,246,.09);animation-delay:2s;"></div>
            <!-- círculos giratórios -->
            <div class="spin-cw absolute opacity-[.06]" style="top:4%;right:15%;">
                <svg width="110" height="110" viewBox="0 0 110 110" fill="none">
                    <circle cx="55" cy="55" r="48" stroke="#db2777" stroke-width="4" stroke-dasharray="14 8" />
                </svg>
            </div>
            <div class="spin-ccw absolute opacity-[.05]" style="bottom:8%;left:18%;">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                    <circle cx="40" cy="40" r="34" stroke="#f472b6" stroke-width="3.5" stroke-dasharray="10 6" />
                </svg>
            </div>
            <!-- estrelinhas -->
            <div class="fa pulse-dot absolute opacity-55" style="top:14%;left:6%;animation-delay:.4s;">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M10 1L12 6.8L18 10L12 13.2L10 19L8 13.2L2 10L8 6.8Z" fill="#f472b6" opacity=".7" />
                </svg>
            </div>
            <div class="fb pulse-dot absolute opacity-45" style="bottom:28%;right:5%;animation-delay:1.2s;">
                <svg width="13" height="13" viewBox="0 0 13 13" fill="none">
                    <path d="M6.5 1L7.8 5L12 6.5L7.8 8L6.5 12L5.2 8L1 6.5L5.2 5Z" fill="#db2777" opacity=".6" />
                </svg>
            </div>
            <!-- bolinhas -->
            <div class="pulse-dot absolute w-2.5 h-2.5 rounded-full bg-pink-300 opacity-60" style="top:22%;left:4%;"></div>
            <div class="pulse-dot absolute w-2 h-2 rounded-full bg-violet-300 opacity-50"
                style="top:68%;left:30%;animation-delay:.8s;"></div>
            <div class="pulse-dot absolute w-2 h-2 rounded-full bg-pink-400 opacity-40"
                style="top:17%;right:7%;animation-delay:1.5s;"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 py-10">

            <!-- header -->
            <div class="flex flex-wrap items-end justify-between gap-4 mb-8 fade-up">
                <div>
                    <p class="text-[10px] font-black tracking-widest uppercase text-pink-500 mb-1">Gestão acadêmica</p>
                    <h1 class="text-4xl font-black leading-tight" style="font-family:'Syne',sans-serif;color:var(--text)">
                        Meus Horários</h1>
                    <p class="text-sm mt-1" style="color:var(--muted)">Envie e organize as fotos da sua grade horária</p>
                </div>
                <button id="openUploadBtn"
                    class="flex items-center gap-2 bg-pink-600 hover:bg-pink-700 text-white text-sm font-black px-5 py-3 rounded-2xl shadow-lg shadow-pink-200/30 transition-all hover:-translate-y-0.5">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Adicionar horário
                </button>
            </div>

            <!-- stats -->
            <div class="flex flex-wrap gap-3 mb-6 fade-up" style="animation-delay:.08s">
                <div class="hl-card flex items-center gap-3 px-5 py-3">
                    <div class="w-9 h-9 rounded-xl bg-pink-500/10 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <rect x="3" y="4" width="18" height="18" rx="2" stroke-width="2" />
                            <path d="M16 2v4M8 2v4M3 10h18" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider" style="color:var(--faint)">Total de
                            horários</p>
                        <p class="text-xl font-black leading-none" id="totalCount"
                            style="font-family:'Syne',sans-serif;color:var(--text)">—</p>
                    </div>
                </div>
            </div>

            <!-- FORM UPLOAD (escondido por padrão) -->
            <div id="uploadPanel" class="hidden mb-6 fade-up" style="animation-delay:.12s">
                <div class="hl-card overflow-hidden">
                    <div class="h-1.5 w-full" style="background:linear-gradient(90deg,#db2777,#f472b6,#fda4af);"></div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between mb-2">
                            <h2 class="font-black text-base" style="font-family:'Syne',sans-serif;color:var(--text)">Novo
                                horário</h2>
                            <button id="closeUploadBtn"
                                class="w-7 h-7 rounded-lg flex items-center justify-center transition-colors hover:bg-pink-500/10 text-pink-500">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round">
                                    <path d="M18 6L6 18M6 6l12 12" />
                                </svg>
                            </button>
                        </div>

                        <!-- título -->
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest mb-1.5 hl-label">Título
                                <span class="text-pink-500">*</span></label>
                            <input id="uploadTitle" type="text" placeholder="Ex: Grade 2025.1, Horário de Segunda..."
                                class="hl-input w-full rounded-xl px-4 py-2.5 text-sm transition-all">
                            <p id="err-title" class="hidden mt-1 text-[11px] font-semibold text-red-500"></p>
                        </div>

                        <!-- drop zone -->
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest mb-1.5 hl-label">Imagem
                                <span class="text-pink-500">*</span></label>
                            <div id="dropZone"
                                class="drop-zone flex flex-col items-center justify-center gap-3 py-10 px-6 text-center"
                                onclick="document.getElementById('imageFile').click()">
                                <div id="dropPreview" class="hidden w-full">
                                    <img id="previewImg" src="" alt="preview"
                                        class="max-h-48 mx-auto rounded-xl object-contain">
                                    <p id="previewName" class="text-xs mt-2 text-pink-500 font-semibold"></p>
                                </div>
                                <div id="dropPlaceholder" class="flex flex-col items-center gap-3">
                                    <div class="w-12 h-12 rounded-2xl bg-pink-500/10 flex items-center justify-center">
                                        <svg class="w-6 h-6 text-pink-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke-width="2"
                                                stroke-linecap="round" />
                                            <polyline points="17 8 12 3 7 8" stroke-width="2" stroke-linecap="round" />
                                            <line x1="12" y1="3" x2="12" y2="15" stroke-width="2" stroke-linecap="round" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold" style="color:var(--text)">Arraste aqui ou clique para
                                            selecionar</p>
                                        <p class="text-xs mt-0.5" style="color:var(--faint)">PNG, JPG, WEBP até 10MB</p>
                                    </div>
                                </div>
                            </div>
                            <input id="imageFile" type="file" accept="image/*" class="hidden">
                            <p id="err-image" class="hidden mt-1 text-[11px] font-semibold text-red-500"></p>
                        </div>

                        <div class="flex justify-end gap-2.5 pt-2">
                            <button id="cancelUploadBtn"
                                class="border border-pink-200 hover:border-pink-400 text-pink-500 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors"
                                style="background:transparent">Cancelar</button>
                            <button id="submitUploadBtn"
                                class="bg-pink-600 hover:bg-pink-700 text-white font-black text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-pink-200/30 transition-all hover:-translate-y-0.5 flex items-center gap-1.5 disabled:opacity-60">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2.5" stroke-linecap="round">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" />
                                    <polyline points="17 8 12 3 7 8" />
                                    <line x1="12" y1="3" x2="12" y2="15" />
                                </svg>
                                <span id="submitLabel">Enviar horário</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRID DE HORÁRIOS -->
            <div id="scheduleGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 fade-up"
                style="animation-delay:.18s">
                <!-- skeletons enquanto carrega -->
                @for($i = 0; $i < 3; $i++)
                    <div class="hl-card overflow-hidden">
                        <div class="skel w-full h-44"></div>
                        <div class="p-4 space-y-2">
                            <div class="skel h-4 rounded w-2/3"></div>
                            <div class="skel h-3 rounded w-1/3"></div>
                        </div>
                    </div>
                @endfor
            </div>

        </div>
    </div>

    <!-- MODAL VISUALIZAR -->
    <div id="viewModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="hl-card w-full max-w-2xl overflow-hidden shadow-2xl">
            <div class="h-1 w-full" style="background:linear-gradient(90deg,#db2777,#f472b6,#fda4af);"></div>
            <div class="p-5">
                <div class="flex items-center justify-between mb-4">
                    <h3 id="modalViewTitle" class="font-black text-base"
                        style="font-family:'Syne',sans-serif;color:var(--text)"></h3>
                    <button id="closeViewModal"
                        class="w-8 h-8 rounded-xl flex items-center justify-center hover:bg-pink-500/10 text-pink-500 transition-colors">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <img id="modalViewImg" src="" alt="" class="w-full max-h-[65vh] object-contain rounded-2xl"
                    style="background:var(--input-bg)">
            </div>
        </div>
    </div>

    <!-- MODAL EDITAR -->
    <div id="editModal" class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="hl-card w-full max-w-md overflow-hidden shadow-2xl">
            <div class="h-1 w-full" style="background:linear-gradient(90deg,#db2777,#f472b6,#fda4af);"></div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-black text-base" style="font-family:'Syne',sans-serif;color:var(--text)">Editar horário
                    </h3>
                    <button id="closeEditModal"
                        class="w-8 h-8 rounded-xl flex items-center justify-center hover:bg-pink-500/10 text-pink-500 transition-colors">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round">
                            <path d="M18 6L6 18M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <input type="hidden" id="editId">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest mb-1.5 hl-label">Título</label>
                    <input id="editTitle" type="text" class="hl-input w-full rounded-xl px-4 py-2.5 text-sm transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest mb-1.5 hl-label">Nova imagem <span
                            class="hl-faint font-normal normal-case">(opcional)</span></label>
                    <div id="editDropZone"
                        class="drop-zone flex items-center justify-center gap-3 py-5 px-4 text-sm cursor-pointer"
                        onclick="document.getElementById('editImageFile').click()">
                        <svg class="w-5 h-5 text-pink-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4" stroke-width="2" stroke-linecap="round" />
                            <polyline points="17 8 12 3 7 8" stroke-width="2" stroke-linecap="round" />
                            <line x1="12" y1="3" x2="12" y2="15" stroke-width="2" stroke-linecap="round" />
                        </svg>
                        <span id="editFileName" style="color:var(--muted)">Clique para trocar a imagem</span>
                    </div>
                    <input id="editImageFile" type="file" accept="image/*" class="hidden">
                </div>
                <div class="flex justify-end gap-2.5 pt-1">
                    <button id="cancelEditBtn"
                        class="border border-pink-200 hover:border-pink-400 text-pink-500 font-bold text-sm px-5 py-2.5 rounded-xl transition-colors"
                        style="background:transparent">Cancelar</button>
                    <button id="confirmEditBtn"
                        class="bg-pink-600 hover:bg-pink-700 text-white font-black text-sm px-6 py-2.5 rounded-xl shadow-lg shadow-pink-200/30 transition-all hover:-translate-y-0.5 flex items-center gap-1.5 disabled:opacity-60">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"
                            stroke-linecap="round">
                            <polyline points="20 6 9 17 4 12" />
                        </svg>
                        <span id="editLabel">Salvar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EXCLUIR -->
    <div id="deleteModal"
        class="hidden fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
        <div class="hl-card w-full max-w-sm overflow-hidden shadow-2xl">
            <div class="h-1 bg-gradient-to-r from-red-500 to-rose-400"></div>
            <div class="p-6 text-center">
                <div class="w-14 h-14 rounded-2xl bg-red-500/10 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <polyline points="3 6 5 6 21 6" stroke-width="2" stroke-linecap="round" />
                        <path d="M19 6l-1 14H6L5 6" stroke-width="2" stroke-linecap="round" />
                        <path d="M9 6V4h6v2" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
                <h3 class="font-black text-base mb-1" style="font-family:'Syne',sans-serif;color:var(--text)">Excluir
                    horário?</h3>
                <p class="text-sm mb-5" style="color:var(--muted)">Esta ação não pode ser desfeita.</p>
                <input type="hidden" id="deleteId">
                <div class="flex gap-2 justify-center">
                    <button id="cancelDeleteBtn"
                        class="border font-bold text-sm px-5 py-2.5 rounded-xl transition-colors cursor-pointer"
                        style="border-color:var(--card-border);color:var(--muted);background:transparent">Cancelar</button>
                    <button id="confirmDeleteBtn"
                        class="bg-red-500 hover:bg-red-600 text-white font-black text-sm px-5 py-2.5 rounded-xl transition-colors shadow-sm shadow-red-200/30">Sim,
                        excluir</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST -->
    <div id="toast"
        class="hidden fixed bottom-6 right-6 z-50 flex items-center gap-3 px-5 py-3.5 rounded-xl shadow-xl hl-card border-l-4 border-l-pink-500">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#db2777" stroke-width="2.5"
            stroke-linecap="round">
            <polyline points="20 6 9 17 4 12" />
        </svg>
        <p id="toastMsg" class="text-sm font-bold" style="color:var(--text)">Pronto!</p>
    </div>

    <script src="{{ asset('js/upload.js') }}"></script>
@endsection