<div class="relative inline-block">
  <a href="/focus" class="sparkle-btn">

    <span class="spark"></span>
    <span class="backdrop"></span>

    <svg class="sparkle-icon" viewBox="0 0 24 24">
      <path d="M12 2L14 8L20 10L14 12L12 18L10 12L4 10L10 8Z" />
    </svg>

    <span class="btn-text">Escola Virtual</span>
  </a>
</div>

<style>
  .sparkle-btn {
    position: relative;
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 8px 14px;
    font-size: 14px;
    border-radius: 9999px;
    border: none;
    cursor: pointer;
    overflow: hidden;
    /* 🔥 ESSENCIAL */
    background: hsl(330 40% 15%);
    color: white;
    transition: 0.3s;
  }

  /* hover principal */
  .sparkle-btn:hover {
    background: hsl(330 80% 55%);
    box-shadow: 0 0 20px hsl(330 80% 60% / 0.6);
    transform: scale(1.05);
  }

  /* brilho corrigido */
  .spark {
    position: absolute;
    inset: 0;
    border-radius: 9999px;
    /* 🔥 faz ficar redondo */
    overflow: hidden;
  }

  .spark::before {
    content: "";
    position: absolute;
    width: 200%;
    height: 200%;
    top: -50%;
    left: -50%;
    background: conic-gradient(transparent,
        rgba(255, 255, 255, 0.8),
        transparent 30%);
    opacity: 0;
    transition: 0.3s;
  }

  .sparkle-btn:hover .spark::before {
    opacity: 0.4;
    animation: girar 2s linear infinite;
  }

  /* fundo interno */
  .backdrop {
    position: absolute;
    inset: 2px;
    border-radius: 9999px;
    background: inherit;
    z-index: 0;
  }

  /* conteúdo na frente */
  .sparkle-icon,
  .btn-text {
    position: relative;
    z-index: 1;
  }

  .sparkle-icon {
    width: 16px;
    fill: white;
  }

  .btn-text {
    color: white;
  }

  /* animação */
  @keyframes girar {
    to {
      transform: rotate(360deg);
    }
  }
</style>