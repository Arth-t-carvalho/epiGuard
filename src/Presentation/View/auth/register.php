<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Cadastro Facchini</title>
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

    <!-- Splash Screen Overlay (Inicia oculta) -->
    <div id="splash-screen" class="splash-screen hidden">
        <div class="splash-content">
            <h1 class="facchini-logo">FACCHINI</h1>
            <p class="splash-subtitle">AUTENTICAR SISTEMA</p>
            
            <div class="loading-container">
                <div id="progress-bar" class="progress-bar"></div>
            </div>
            
        </div>
    </div>

    <!-- Main Login Container (Inicia visível) -->
    <main class="login-container">
        <div class="login-wrapper reverse-layout">
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
                        <h2>Criar Conta</h2>
                        <p>Preencha os dados abaixo para solicitar acesso à plataforma EPI GUARD.</p>
                    </header>

                    <form id="register-form">
                        <div class="input-group">
                            <label for="name">NOME COMPLETO</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-user input-icon"></i>
                                <input type="text" id="name" placeholder="Seu nome completo" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="username">E-MAIL OU CPF</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-envelope input-icon"></i>
                                <input type="text" id="username" placeholder="exemplo@facchini.com.br" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="label-row">
                                <label for="password">SENHA</label>
                            </div>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" id="password" placeholder="••••••••" required>
                                <button type="button" id="toggle-password" class="toggle-password">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-login">
                            SOLICITAR ACESSO <i class="fa-solid fa-chevron-right"></i>
                        </button>

                        <div class="form-footer">
                            <p>Já possui acesso? <a href="<?= BASE_PATH ?>/login" class="link-register">Fazer Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= BASE_PATH ?>/assets/js/auth.js"></script>
</body>
</html>
