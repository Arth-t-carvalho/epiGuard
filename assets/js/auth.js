/**
 * Logica de Autenticação e UI - epiGuard
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

const initSplashTransition = (formId, targetUrl) => {
    const form = document.getElementById(formId);
    if (!form) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault(); // Impede o envio imediato

        const splash = document.getElementById('splash-screen');
        const loginContainer = document.querySelector('.login-container');
        const bar = document.getElementById('progress-bar');

        if (!splash || !loginContainer || !bar) {
            window.location.href = targetUrl;
            return; // Fallback
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
                    // Após a animação, redireciona para a página correspondente
                    window.location.href = targetUrl;
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

        // Remove a classe num setTimeout curtíssimo para garantir que
        // a primeira renderização (com transition: none) ocorra em 100% branco,
        // mas a retract start logo a seguir
        setTimeout(() => {
            document.documentElement.classList.remove('entering-transition');
        }, 50);
    }

    // Inicializa os elementos normais
    initCarousel();
    initPasswordToggle();
    initPageTransitions();

    // Configura a transição ao submeter os formulários
    initSplashTransition('login-form', '/dashboard');
    initSplashTransition('register-form', '/dashboard');
});
