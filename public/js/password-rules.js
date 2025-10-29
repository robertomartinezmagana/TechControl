document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[type="password"][data-role]').forEach(password => {
        const role = password.dataset.role;
        const rulesContainer = document.querySelector(`.pwdReq[data-role="${role}"]`);
        if (!rulesContainer) return;

        const rules = {};
        rulesContainer.querySelectorAll('p[data-rule]').forEach(p => {
            rules[p.dataset.rule] = p;
        });

        const checkPassword = () => {
            const val = password.value;
            const checks = {
                length: val.length >= 10 && val.length <= 15,
                lower: /[a-z]/.test(val),
                upper: /[A-Z]/.test(val),
                number: /\d/.test(val),
                special: /[^A-Za-z0-9]/.test(val)
            };

            for (const rule in checks) {
                if (checks[rule]) {
                    rules[rule].classList.add('valid');
                    rules[rule].classList.remove('invalid');
                } else {
                    rules[rule].classList.add('invalid');
                    rules[rule].classList.remove('valid');
                }
            }
        };

        password.addEventListener('input', checkPassword);
    });
});
