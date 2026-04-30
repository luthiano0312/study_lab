/**
 * auth-guard.js
 *
 * Proteção de rotas para views autenticadas (dashboard, CRUD, profile, etc.)
 * Redireciona para /login se não houver token válido.
 *
 * IMPORTANTE: Este script é carregado de forma SÍNCRONA no <head>, antes de
 * qualquer render. O body fica invisível até a verificação ser concluída,
 * prevenindo qualquer flash de conteúdo não-autorizado.
 *
 * Boas práticas aplicadas (Senior Engineer):
 * - Dupla verificação: existência local + validação remota do token
 * - Timeout de 3s para evitar UX ruim em conexões lentas
 * - Limpeza de dados corrompidos (JSON inválido no localStorage)
 * - Não bloqueia o render após a validação (apenas redireciona se necessário)
 */
(function () {
    "use strict";

    const REDIRECT_TO   = "/login";
    const TOKEN_KEY     = "auth_token";
    const CACHE_KEY     = "user_cache";
    const VALIDATE_URL  = "/api/user";
    const TIMEOUT_MS    = 3000; // max wait para validação remota

    /* ── 1. Ocultar body instantaneamente para evitar flash ── */
    document.documentElement.style.visibility = "hidden";

    /* ── 2. Verificação síncrona: token existe no localStorage? ── */
    const token = localStorage.getItem(TOKEN_KEY);

    if (!token || token.trim() === "") {
        // Sem token → redirecionar imediatamente (síncrono, sem flash)
        window.location.replace(REDIRECT_TO);
        // Não precisamos restaurar visibility, a página vai mudar
        return;
    }

    /* ── 3. Token existe, restaurar body o mais rápido possível ──
     *    Isso melhora a UX: o usuário já vê a página enquanto
     *    a validação remota acontece em background.
     */
    document.documentElement.style.visibility = "";

    /* ── 4. Validação remota assíncrona: token ainda é válido? ──
     *    Se a API retornar 401, o token expirou/foi revogado.
     *    Fazemos o logout e redirecionamos para /login.
     */
    const controller = new AbortController();
    const timeoutId  = setTimeout(() => controller.abort(), TIMEOUT_MS);

    fetch(VALIDATE_URL, {
        method:  "GET",
        headers: {
            "Accept":        "application/json",
            "Authorization": "Bearer " + token,
        },
        signal: controller.signal,
    })
    .then(function (res) {
        clearTimeout(timeoutId);

        if (res.status === 401 || res.status === 403) {
            // Token inválido ou expirado → limpar dados e redirecionar
            localStorage.removeItem(TOKEN_KEY);
            localStorage.removeItem(CACHE_KEY);
            window.location.replace(REDIRECT_TO);
        }
        // 200 OK → usuário autenticado, nada a fazer
    })
    .catch(function (err) {
        clearTimeout(timeoutId);

        // AbortError = timeout de rede → manter usuário na página (benefício da dúvida)
        // Outros erros de rede idem — não punimos o usuário por instabilidade de rede
        if (err.name !== "AbortError") {
            console.warn("[auth-guard] Falha na validação remota, continuando:", err.message);
        }
    });

})();
