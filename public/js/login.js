const $        = id => document.getElementById(id);
const JSON_HDR = { 'Content-Type': 'application/json', 'Accept': 'application/json' };

const showErr    = msg => { const b = $('errorBox'), t = $('errorMessage'); if (t) t.innerText = msg; b?.classList.remove('hidden'); };
const clearErr   = ()  => { $('errorBox')?.classList.add('hidden'); if ($('errorMessage')) $('errorMessage').innerText = ''; };
const setLoading = (btn, on, label) => { btn.disabled = on; btn.textContent = on ? 'Carregando...' : label; };

document.addEventListener('DOMContentLoaded', () => {
    const form = $('loginForm'); if (!form) return;
    const btn  = form.querySelector('button[type=submit]');
    const defaultText = btn?.textContent || 'Entrar';

    form.addEventListener('submit', async e => {
        e.preventDefault();
        clearErr();
        setLoading(btn, true, defaultText);

        try {
            const res  = await fetch('/api/auth/login', {
                method: 'POST', headers: JSON_HDR,
                body: JSON.stringify({ email: $('email').value, password: $('password').value }),
            });
            const data = await res.json();
            if (res.ok) {
                localStorage.setItem('auth_token', data.token);
                if (data.user) {
                    localStorage.setItem('user_cache', JSON.stringify({
                        name: data.user.name,
                        avatarUrl: data.user.avatar
                    }));
                }
                window.location.href = '/dashboard';
            } else {
                showErr(data.message ?? 'Credenciais inválidas');
            }
        } catch { showErr('Erro no servidor. Tente novamente.'); }

        setLoading(btn, false, defaultText);
    });
});