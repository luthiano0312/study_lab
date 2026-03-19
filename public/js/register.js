'use strict';

document.addEventListener('DOMContentLoaded', function () {

    const phoneInput = document.getElementById('phone');
    if (phoneInput && typeof IMask !== 'undefined') {
        IMask(phoneInput, { mask: '(00) 00000-0000' });
    }

    const form = document.getElementById('registerForm');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        document.querySelectorAll('.error-text').forEach(el => {
            el.classList.add('hidden');
            el.innerText = '';
        });

        document.querySelectorAll('.input-field').forEach(input => {
            input.classList.remove('border-[#FF0073]');
        });

        const name     = document.getElementById('name').value;
        const email    = document.getElementById('email').value;
        const password = document.getElementById('passwordInput').value;

        const response = await fetch('/api/auth/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept':       'application/json',
            },
            body: JSON.stringify({
                name,
                email,
                password,
                password_confirmation: password,
            }),
        });

        const data = await response.json();

        if (response.ok) {
            localStorage.setItem('auth_token', data.access_token || data.token);

            const user = data.user;
            if (user && !user.onboarding_done) {
                window.location.href = '/onboarding';
            } else {
                window.location.href = '/dashboard';
            }

        } else {
            if (data.errors) {
                Object.entries(data.errors).forEach(([field, messages]) => {
                    const input     = document.getElementById(field);
                    const errorText = document.getElementById(`error-${field}`);

                    if (input)     input.classList.add('border-[#FF0073]');
                    if (errorText) { errorText.innerText = messages[0]; errorText.classList.remove('hidden'); }
                });
            } else if (data.message) {
                alert(data.message);
            }
        }
    });

    const passwordInput = document.getElementById('passwordInput');
    if (!passwordInput) return;

    const requirements = {
        length:  { el: document.getElementById('req-length'),  regex: /.{8,}/       },
        upper:   { el: document.getElementById('req-upper'),   regex: /[A-Z]/        },
        lower:   { el: document.getElementById('req-lower'),   regex: /[a-z]/        },
        number:  { el: document.getElementById('req-number'),  regex: /[0-9]/        },
        special: { el: document.getElementById('req-special'), regex: /[^A-Za-z0-9]/ },
    };

    passwordInput.addEventListener('input', () => {
        const value = passwordInput.value;
        Object.values(requirements).forEach(({ el, regex }) => {
            if (!el) return;
            if (regex.test(value)) {
                el.classList.remove('text-slate-500');
                el.classList.add('text-pink-500');
            } else {
                el.classList.remove('text-pink-500');
                el.classList.add('text-slate-500');
            }
        });
    });

});