'use strict';

document.addEventListener('DOMContentLoaded', async function () {
    const token = localStorage.getItem('auth_token');
    if (!token) return;

    try {
        const res = await fetch('/api/user', {
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer ' + token,
            }
        });

        if (!res.ok) return;
        const user = await res.json();

        // Preenche nome
        const nameEl = document.getElementById('headerUserName');
        if (nameEl && user.name) nameEl.textContent = user.name;

        // Decide URL do avatar
        let avatarUrl = null;
        if (user.avatar) {
            avatarUrl = user.avatar; // já vem como URL completa da API
        } else if (user.preset_avatar !== null && user.preset_avatar !== undefined) {
            avatarUrl = '/images/avatar' + user.preset_avatar + '.png';
        }

        if (avatarUrl) {
            const img = document.getElementById('headerAvatar');
            const fb  = document.getElementById('headerAvatarFallback');
            if (img) { img.src = avatarUrl; img.classList.remove('hidden'); }
            if (fb)  { fb.style.display = 'none'; }
        }

        // Salva cache para o próximo carregamento instantâneo
        localStorage.setItem('user_cache', JSON.stringify({
            name: user.name,
            avatarUrl: avatarUrl
        }));
    } catch (e) {
        // silently fail — fallback já está no HTML
    }
});
