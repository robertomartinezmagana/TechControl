document.addEventListener('DOMContentLoaded', () => {
    // Selecciona todos los botones de mostrar/ocultar
    document.querySelectorAll('.toggle-pwd').forEach(btn => {
        btn.addEventListener('click', () => {
            const targetId = btn.dataset.target; // obtiene "pass1-rol"
            const input = document.getElementById(targetId);
            if (!input) return; // seguridad por si no encuentra el input

            // Alterna tipo password/text
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = '🙈'; // cambia icono si quieres
            } else {
                input.type = 'password';
                btn.textContent = '👁';
            }
        });
    });
});
