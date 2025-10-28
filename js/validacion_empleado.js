document.addEventListener('DOMContentLoaded', function() {
  const role = 'employee';

  const pwd = document.getElementById(`pass1-${role}`);
  const pwdVerify = document.getElementById(`pass2-${role}`);
  const submitBtn = document.getElementById(`submit-${role}`);

  if (!pwd) return;

  const rules = {
    length: document.getElementById(`lengthReq-${role}`),
    lower: document.getElementById(`lowerReq-${role}`),
    upper: document.getElementById(`upperReq-${role}`),
    special: document.getElementById(`specialReq-${role}`),
    digit: document.getElementById(`digitReq-${role}`)
  };

  const testPassword = (p) => ({
    length: p.length >= 10 && p.length <= 15,
    lower: /[a-z]/.test(p),
    upper: /[A-Z]/.test(p),
    special: /[!@#$%^&*(),.?":{}|<>_\-\\\/\[\];'`~+=]/.test(p),
    digit: /[0-9]/.test(p)
  });

  const updateRules = () => {
    const p = pwd.value;
    const r = testPassword(p);

    Object.entries(r).forEach(([key, ok]) => {
      const elem = rules[key];
      if (!elem) return;
      elem.textContent = (ok ? '✔️ ' : '❌ ') + elem.dataset.text;
      elem.classList.toggle('ok', ok);
      elem.classList.toggle('fail', !ok);
    });

    const verifyMatches = pwdVerify ? (pwdVerify.value === p && p.length > 0) : true;
    if (submitBtn) submitBtn.disabled = !(Object.values(r).every(v => v) && verifyMatches);
  };

  pwd.addEventListener('input', updateRules);
  if (pwdVerify) pwdVerify.addEventListener('input', updateRules);
  updateRules();

  document.querySelectorAll('.toggle-pwd').forEach(btn => {
    const input = document.getElementById(btn.dataset.target);
    btn.addEventListener('click', () => {
      if (!input) return;
      input.type = input.type === 'password' ? 'text' : 'password';
      btn.textContent = input.type === 'password' ? '👁️' : '🙈';
    });
  });
});
