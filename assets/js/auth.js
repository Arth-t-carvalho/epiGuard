<<<<<<< HEAD
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
=======
/**
 * Logica de Autenticação e UI - epiGuard (Versão Mesclada)
 */

const initCarousel = () => {
    const track = document.getElementById('carousel-track');
    if (!track) return;

    const slides = Array.from(track.children);
    const dots = Array.from(document.querySelectorAll('.dot'));
    if (slides.length === 0) return;

    let currentIndex = 0;
    let autoPlayInterval;

    const updateCarousel = (index) => {
        // Mover o track
        track.style.transform = `translateX(-${index * 100}%)`;

        // Atualizar slides
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });

        // Atualizar dots
        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });

        currentIndex = index;
    };

    const nextSlide = () => {
        let nextIndex = (currentIndex + 1) % slides.length;
        updateCarousel(nextIndex);
    };

    const startAutoPlay = () => {
        stopAutoPlay();
        autoPlayInterval = setInterval(nextSlide, 5000);
    };

    const stopAutoPlay = () => {
        if (autoPlayInterval) clearInterval(autoPlayInterval);
    };

    // Cliques nos pontos (dots)
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoPlay();
            updateCarousel(index);
            startAutoPlay();
        });
    });

    // Iniciar
    updateCarousel(0);
    startAutoPlay();
};

const initPasswordToggle = () => {
    const toggleBtn = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');

    if (!toggleBtn || !passwordInput) return;

    toggleBtn.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        const icon = toggleBtn.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
};

const initSplashTransition = (formId) => {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', (e) => {
        // Se já estiver processando a transição, não cancela o evento para permitir o envio final
        if (form.getAttribute('data-submitting') === 'true') {
            return;
        }

        e.preventDefault(); // Impede o envio imediato para rodar a animação

        const splash = document.getElementById('splash-screen');
        const loginContainer = document.querySelector('.login-container');
        const bar = document.getElementById('progress-bar');

        if (!splash || !loginContainer || !bar) {
            form.setAttribute('data-submitting', 'true');
            form.submit();
            return;
        }

        // Exibir a splash e ocultar o container
        splash.classList.remove('hidden');
        loginContainer.classList.add('hidden');

        let progress = 0;
        bar.style.width = '0%';

        const interval = setInterval(() => {
            progress += 3;
            bar.style.width = `${progress}%`;

            if (progress >= 100) {
                clearInterval(interval);
                setTimeout(() => {
                    // Após a animação, envia o formulário de verdade
                    form.setAttribute('data-submitting', 'true');
                    form.submit();
                }, 300);
            }
        }, 30);
    });
};

const initPageTransitions = () => {
    const links = document.querySelectorAll('a.link-register, a.link-login');

    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const targetUrl = link.getAttribute('href');

            // Ativa a animação de expansão do branco para 100%
            document.documentElement.classList.add('auth-transition-active');

            // Salva flag para a próxima página abrir expandida e retrair
            sessionStorage.setItem('auth-transition', 'true');

            // Navega logo que a transição de CSS finalizar (aprox 1s)
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 1000);
        });
    });
};

document.addEventListener('DOMContentLoaded', () => {
    // Se estivermos entrando de uma transição (via flag no <head>), 
    // revelamos o layout magicamente.
    if (document.documentElement.classList.contains('entering-transition')) {
        // Redraw na tela antes de tirar a classe
        void document.documentElement.offsetHeight;

        setTimeout(() => {
            document.documentElement.classList.remove('entering-transition');
        }, 50);
    }

    // Inicializa os elementos normais
    initCarousel();
    initPasswordToggle();
    initPageTransitions();

    // Configura a transição ao submeter os formulários (ajustado para funcionar com PHP)
    initSplashTransition('login-form');
    initSplashTransition('register-form');
    initSplashTransition('reset-password-form');
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9
});
