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

        const name                  = document.getElementById('name').value;
        const email                 = document.getElementById('email').value;
        const password              = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;

        const response = await fetch('/api/auth/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify({ name, email, password, password_confirmation }),
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

                    const input = document.getElementById(field);
                    const errorText = document.getElementById(`error-${field}`);

                    if (input) {
                        input.classList.add('border-[#FF0073]');
                    }

                    if (errorText) {
                        errorText.innerText = messages[0];
                        errorText.classList.remove('hidden');
                    }

                });

            } else if (data.message) {
                alert(data.message);
            }

        }
    });

});