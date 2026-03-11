document.addEventListener('DOMContentLoaded', () => {
    const splashScreen = document.getElementById('splash-screen');
    const progressBar = document.getElementById('progress-bar');
    const enterButton = document.getElementById('enter-button');
    const loginContainer = document.querySelector('.login-container');
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');

    // Iniciar animação da splash screen (Direita para Esquerda)
    setTimeout(() => {
        splashScreen.classList.add('active');
    }, 100);

    // Simular carregamento progressivo
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 5;
        if (progress >= 100) {
            progress = 100;
            clearInterval(interval);
            showEnterButton();
        }
        progressBar.style.width = `${progress}%`;
    }, 100);

    function showEnterButton() {
        enterButton.classList.remove('hidden');
        enterButton.style.animation = 'fadeInUp 0.6s forwards';
    }

    // Ação ao clicar em entrar no sistema
    enterButton.addEventListener('click', () => {
        // Transição de saída da splash screen
        splashScreen.style.transform = 'translateX(-100%)';
        splashScreen.style.transition = 'transform 0.8s cubic-bezier(0.77, 0, 0.175, 1)';
        
        setTimeout(() => {
            splashScreen.classList.add('hidden');
            loginContainer.classList.remove('hidden');
        }, 800);
    });

    // Toggle de visibilidade da senha
    togglePassword.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const icon = togglePassword.querySelector('i');
        if (type === 'text') {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    });

    // Animação de entrada do formulário
    const loginForm = document.getElementById('login-form');
    loginForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const btn = loginForm.querySelector('.btn-login');
        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> AUTENTICANDO...';
        
        // Simular autenticação e redirecionamento
        setTimeout(() => {
            alert('Autenticação realizada com sucesso! Redirecionando para o dashboard...');
            window.location.href = './dashboard';
        }, 1500);
    });
});
