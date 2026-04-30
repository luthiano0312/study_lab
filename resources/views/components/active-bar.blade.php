{{-- resources/views/notes/index.blade.php --}}

@extends('layouts.app') {{-- troque pelo seu layout base --}}

@section('title', 'Notes')

@section('head')
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,500;1,400&family=Crimson+Text:ital,wght@0,400;0,600;1,400&family=JetBrains+Mono:wght@400&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/notebook.css') }}" />
@endsection

@section('content')

<div class="notes-page">

    {{-- Cabeçalho da página --}}
    <div class="notes-page-header">
        <h1>Minhas Notas</h1>
        <button class="btn-open-notebook" id="btnOpen">
            <span>✎</span> Nova Nota
        </button>
    </div>

    {{-- Cards de notas salvas (renderizadas pelo servidor no carregamento) --}}
    <div class="notes-grid" id="notesGrid">
        @forelse ($notes as $note)
            <div class="note-card" data-id="{{ $note->id }}" onclick="openNote({{ $note->id }})">
                <div class="note-card-title">{{ $note->title ?: 'Sem título' }}</div>
                <div class="note-card-preview">{{ Str::limit($note->content, 100) }}</div>
                <div class="note-card-date">{{ $note->updated_at->format('d/m/Y H:i') }}</div>
            </div>
        @empty
            <p class="notes-empty">Nenhuma nota ainda. Clique em "Nova Nota" para começar.</p>
        @endforelse
    </div>

</div>

{{-- Overlay --}}
<div class="overlay" id="overlay"></div>

{{-- Painel do Caderno --}}
<div class="notebook-panel" id="notebookPanel">

    {{-- Prateleira lateral --}}
    <aside class="shelf" id="shelf">
        <div class="shelf-header">
            <span class="shelf-title">Prateleira</span>
            <span class="shelf-count" id="shelfCount">0</span>
        </div>
        <div class="shelf-empty" id="shelfEmpty">
            <span>Nenhuma nota ainda</span>
        </div>
        <ul class="shelf-list" id="shelfList"></ul>
    </aside>

    {{-- Caderno --}}
    <div class="notebook">
        <div class="notebook-topbar">
            <div class="notebook-meta">
                <input class="note-title-input" id="noteTitleInput" type="text" placeholder="Título da nota..." maxlength="80" />
                <span class="note-date" id="noteDate"></span>
            </div>
            <div class="topbar-actions">
                <button class="btn-action btn-save" id="btnSave">✦ Salvar</button>
                <div class="download-group">
                    <button class="btn-action btn-dl" id="btnDownloadTxt">↓ TXT</button>
                    <button class="btn-action btn-dl" id="btnDownloadPdf">↓ PDF</button>
                </div>
                <button class="btn-close" id="btnClose">✕</button>
            </div>
        </div>

        <div class="notebook-body">
            <div class="notebook-margin"></div>
            <div class="notebook-lines">
                <textarea class="notebook-textarea" id="noteTextarea" placeholder="Escreva seus pensamentos aqui..."></textarea>
            </div>
        </div>

        <div class="notebook-footer">
            <span class="word-count" id="wordCount">0 palavras</span>
            <span class="char-count" id="charCount">0 caracteres</span>
            <span class="status-msg" id="statusMsg"></span>
        </div>
    </div>

</div>

@endsection

@section('scripts')
<script>
    // Passa as notas do servidor para o JS (evita chamada extra à API no carregamento)
    window.INITIAL_NOTES = @json($notes);

    // URL base da API — gerada pelo Laravel
    window.API_BASE = '{{ url("/api/notes") }}';

    // CSRF token para as requisições POST/PUT/DELETE
    window.CSRF_TOKEN = '{{ csrf_token() }}';
</script>
<script src="{{ asset('js/notebook.js') }}"></script>
@endsection