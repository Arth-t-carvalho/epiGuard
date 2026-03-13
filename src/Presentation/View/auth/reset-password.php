<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Recuperar Senha</title>
    <script>
        // Restaura a tela estendida se viermos de uma transição
        if (sessionStorage.getItem('auth-transition') === 'true') {
            document.documentElement.classList.add('entering-transition');
            sessionStorage.removeItem('auth-transition');
        }
    </script>
    <!-- Google Fonts: Inter e Outfit para uma estética premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/auth.css">
</head>
<body>

    <!-- Splash Screen Overlay (Inicia oculta, exceto ao enviar) -->
    <div id="splash-screen" class="splash-screen hidden">
        <div class="splash-content">
            <h1 class="facchini-logo">FACCHINI</h1>
            <p class="splash-subtitle">AUTENTICAR SISTEMA</p>
            
            <div class="loading-container">
                <div id="progress-bar" class="progress-bar"></div>
            </div>
            
        </div>
    </div>

    <!-- Main Login Container -->
    <main class="login-container">
        <div class="login-wrapper">
            <!-- Left Side: Sidebar -->
            <div class="login-sidebar">
                <div class="sidebar-content">
                    <div class="brand-group">
                        <h1 class="facchini-title">FACCHINI</h1>
                        <p class="facchini-subtitle">DIVISÃO DE SEGURANÇA</p>
                    </div>

                    <div class="carousel-section">
                        <div class="carousel-container">
                            <div class="carousel-track" id="carousel-track">
                                <div class="carousel-slide active">
                                    <img src="<?= BASE_PATH ?>/assets/images/image1.png" alt="Caminhão Facchini">
                                </div>
                                <div class="carousel-slide">
                                    <img src="<?= BASE_PATH ?>/assets/images/image2.png" alt="Fábrica Facchini">
                                </div>
                                <div class="carousel-slide">
                                    <img src="<?= BASE_PATH ?>/assets/images/image3.png" alt="Logística Facchini">
                                </div>
                            </div>
                            <div class="carousel-dots">
                                <span class="dot active"></span>
                                <span class="dot"></span>
                                <span class="dot"></span>
                            </div>
                        </div>
                    </div>

                    <div class="tag-group">
                        <div class="epi-tag">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>EPI GUARD</span>
                        </div>
                    </div>

                    <div class="quote-section">
                        <p class="main-quote">O nosso maior patrimônio são as <strong>pessoas.</strong></p>
                        <p class="sub-quote">Com prevenção, o futuro avança, pois a Segurança é o melhor implemento da nossa vida.</p>
                    </div>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="login-form-area">
                <div class="form-container">
                    <header class="form-header">
                        <h2>Recuperar Senha</h2>
                        <p>Informe seus dados abaixo para enviarmos as instruções de recuperação.</p>
                    </header>

                    <form id="reset-password-form">
                        <div class="input-group">
                            <label for="name">NOME COMPLETO</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-user input-icon"></i>
                                <input type="text" id="name" placeholder="Seu nome completo" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="email">E-MAIL (GMAIL)</label>
                            <div class="input-wrapper">
                                <i class="fa-brands fa-google input-icon"></i>
                                <input type="email" id="email" placeholder="exemplo@gmail.com" required>
                            </div>
                        </div>

                        <button type="submit" class="btn-login">
                            REDIFINIR SENHA <i class="fa-solid fa-chevron-right"></i>
                        </button>

                        <div class="form-footer">
                            <p>Lembrou a senha? <a href="<?= BASE_PATH ?>/login" class="link-register">Fazer Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= BASE_PATH ?>/assets/js/auth.js"></script>
</body>
</html>
