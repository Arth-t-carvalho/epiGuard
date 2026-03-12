document.addEventListener('DOMContentLoaded', () => {
    const loginForm = document.getElementById('login-form');
    const passwordInput = document.getElementById('password');
    const eyeBtn = document.querySelector('.eye-btn');

    // Toggle de visibilidade da senha
    if (eyeBtn && passwordInput) {
        eyeBtn.addEventListener('click', () => {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            const icon = eyeBtn.querySelector('i');
            if (type === 'text') {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
    }

    // Lógica de submissão do formulário
    if (loginForm) {
        loginForm.addEventListener('submit', (e) => {
            // Aqui você pode adicionar validações extras se necessário
            const btnSubmit = loginForm.querySelector('.btn-submit');
            if (btnSubmit) {
                btnSubmit.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> ENTRANDO...';
                btnSubmit.style.opacity = '0.8';
                btnSubmit.style.pointerEvents = 'none';
            }
            
            // O formulário continuará para a action definida no PHP (<?= BASE_PATH ?>/login)
        });
    }
});
