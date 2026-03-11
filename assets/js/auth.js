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

const initSplash = () => {
    const splash = document.getElementById('splash-screen');
    const loginContainer = document.querySelector('.login-container');
    const bar = document.getElementById('progress-bar');
    
    if (!splash || !loginContainer || !bar) return;

    let progress = 0;
    const interval = setInterval(() => {
        progress += 2;
        bar.style.width = `${progress}%`;
        
        if (progress >= 100) {
            clearInterval(interval);
            setTimeout(() => {
                splash.classList.add('hidden');
                loginContainer.classList.remove('hidden');
                // Inicializa o carrossel apenas após a splash sumir
                initCarousel();
                initPasswordToggle();
            }, 600);
        }
    }, 30);
};

document.addEventListener('DOMContentLoaded', initSplash);
