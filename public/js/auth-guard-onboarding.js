/**
 * auth-guard-onboarding.js
 *
 * Guard específico para a página de Onboarding.
 *
 * Regra de negócio:
 *  - Usuário NÃO autenticado → redirecionar para /register
 *  - Usuário autenticado COM onboarding já feito → redirecionar para /dashboard
 *  - Usuário autenticado SEM onboarding → deixar na página (correto)
 *
 * IMPORTANTE: Carregado de forma SÍNCRONA no <head> da view onboarding.
 */
(function () {
    "use strict";

    const TOKEN_KEY        = "auth_token";
    const CACHE_KEY        = "user_cache";
    const REDIRECT_NO_AUTH = "/register";
    const REDIRECT_DONE    = "/dashboard";
    const VALIDATE_URL     = "/api/user";
    const TIMEOUT_MS       = 3000;

    /* ── 1. Ocultar body para evitar flash ── */
    document.documentElement.style.visibility = "hidden";

    /* ── 2. Verificação síncrona: token existe? ── */
    const token = localStorage.getItem(TOKEN_KEY);

    if (!token || token.trim() === "") {
        window.location.replace(REDIRECT_NO_AUTH);
        return;
    }

    /* ── 3. Token existe — restaurar visibilidade ── */
    document.documentElement.style.visibility = "";

    /* ── 4. Validação remota ── */
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
            // Token inválido → limpar e redirecionar para cadastro
            localStorage.removeItem(TOKEN_KEY);
            localStorage.removeItem(CACHE_KEY);
            window.location.replace(REDIRECT_NO_AUTH);
            return;
        }

        return res.json();
    })
    .then(function (user) {
        if (!user) return;

        // Se o onboarding já foi feito, não deixar voltar para a tela
        if (user.onboarding_done) {
            window.location.replace(REDIRECT_DONE);
        }
    })
    .catch(function (err) {
        clearTimeout(timeoutId);

        if (err.name !== "AbortError") {
            console.warn("[auth-guard-onboarding] Falha na validação remota:", err.message);
        }
    });

})();
