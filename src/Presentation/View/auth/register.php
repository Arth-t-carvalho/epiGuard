<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>epiGuard - Cadastro SENAI</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/auth.css">
</head>
<body class="login-page-v2">

    <div class="split-screen">
        <!-- Lado Esquerdo: Institucional -->
        <div class="left-side">
            <div class="institutional-content">
                <div class="facchini-branding">
                    <h1 class="facchini-logo-text">FACCHINI</h1>
                    <div class="facchini-divider">
                        <span>DIVISÃO DE SEGURANÇA</span>
                    </div>
                </div>

                <div class="image-showcase">
                    <div class="image-frame">
                        <img src="<?= BASE_PATH ?>/assets/images/login_industrial.png" alt="Produção Facchini">
                        <div class="image-dots">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </div>

                <div class="epi-guard-badge">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>EPI GUARD</span>
                </div>

                <div class="motivational-text">
                    <h2>O nosso maior patrimônio são as <span>pessoas.</span></h2>
                    <p>Com prevenção, o futuro avança, pois a Segurança é o melhor implemento da nossa vida.</p>
                </div>
            </div>
        </div>

        <!-- Lado Direito: Formulário de Registro -->
        <div class="right-side">
            <div class="login-box">
                <div class="login-header">
                    <h2>Cadastrar Conta</h2>
                    <p>Preencha os campos abaixo para solicitar acesso administrativo.</p>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" style="color: #e31e24; margin-bottom: 15px; font-weight: 600;">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success" style="color: #155724; background-color: #d4edda; padding: 10px; border-radius: 5px; margin-bottom: 15px; font-weight: 600;">
                        <i class="fa-solid fa-check-circle"></i>
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form id="register-form" method="POST" action="<?= BASE_PATH ?>/register" class="facchini-form">
                    
                    <div class="input-field">
                        <label for="fullname">NOME COMPLETO</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-user"></i>
                            <input type="text" id="fullname" name="nome" placeholder="Ex: Arthur Silva" required>
                        </div>
                    </div>

                    <div class="input-field">
                        <label for="username">E-MAIL OU CPF</label>
                        <div class="input-wrapper">
                            <i class="fa-regular fa-envelope"></i>
                            <input type="text" id="username" name="usuario" placeholder="exemplo@facchini.com.br" required>
                        </div>
                    </div>

                    <div class="input-field">
                        <div class="label-row">
                            <label for="password">SENHA</label>
                        </div>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" name="senha" placeholder="••••••••" required>
                            <button type="button" id="toggle-password" class="eye-btn">
                                <i class="fa-regular fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <div class="input-field">
                        <label for="cargo">CARGO</label>
                        <div class="input-wrapper" style="padding: 0;">
                            <i class="fa-solid fa-briefcase" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #8F9BBA;"></i>
                            <select name="cargo" id="cargo" style="width: 100%; padding: 14px 14px 14px 45px; border-radius: 50px; border: 2px solid #E9EDF7; background: #fff; font-weight: 500; color: #1B2559; outline: none; transition: border-color 0.3s ease; appearance: none; font-family: 'Montserrat', sans-serif;">
                                <option value="GERENTE_SEGURANCA">Gerente de Segurança</option>
                                <option value="SUPERVISOR">Supervisor</option>
                                <option value="SUPER_ADMIN">Super Admin</option>
                            </select>
                            <i class="fa-solid fa-chevron-down" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); color: #8F9BBA; pointer-events: none;"></i>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        CRIAR CONTA <i class="fa-solid fa-chevron-right"></i>
                    </button>

                    <div class="form-bottom">
                        <p>Já possui acesso cadastrado? <a href="<?= BASE_PATH ?>/login">Faça Login</a></p>
                    </div>
                </form>
=======
    <title>epiGuard - Cadastro Facchini</title>
    <script>
        if (sessionStorage.getItem('auth-transition') === 'true') {
            document.documentElement.classList.add('entering-transition');
            sessionStorage.removeItem('auth-transition');
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/auth.css">
</head>
<body>

    <div id="splash-screen" class="splash-screen hidden">
        <div class="splash-content">
            <h1 class="facchini-logo">FACCHINI</h1>
            <p class="splash-subtitle">AUTENTICAR SISTEMA</p>
            <div class="loading-container">
                <div id="progress-bar" class="progress-bar"></div>
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9
            </div>
        </div>
    </div>

<<<<<<< HEAD
    <script>
        // Lógica simples para o olhinho da senha copiando o comportamento do auth.js
        const toggleBtn = document.getElementById('toggle-password');
        const passInput = document.getElementById('password');
        if(toggleBtn && passInput) {
            toggleBtn.addEventListener('click', () => {
                const type = passInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passInput.setAttribute('type', type);
                
                const icon = toggleBtn.querySelector('i');
                if(type === 'text') {
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                } else {
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                }
            });
        }
    </script>
=======
    <main class="login-container">
        <div class="login-wrapper reverse-layout">
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

            <div class="login-form-area">
                <div class="form-container">
                    <header class="form-header">
                        <h2>Criar Conta</h2>
                        <p>Preencha os dados abaixo para solicitar acesso à plataforma EPI GUARD.</p>
                    </header>

                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                        </div>
                    <?php endif; ?>

                    <form id="register-form" method="POST" action="<?= BASE_PATH ?>/register">
                        <div class="input-group">
                            <label for="name">NOME COMPLETO</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-user input-icon"></i>
                                <input type="text" id="name" name="nome" placeholder="Seu nome completo" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="username">E-MAIL OU CPF</label>
                            <div class="input-wrapper">
                                <i class="fa-regular fa-envelope input-icon"></i>
                                <input type="text" id="username" name="usuario" placeholder="exemplo@facchini.com.br" required>
                            </div>
                        </div>

                        <div class="input-group">
                            <label for="cargo">CARGO</label>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-briefcase input-icon"></i>
                                <select name="cargo" id="cargo" required>
                                    <option value="GERENTE_SEGURANCA">Gerente de Segurança</option>
                                    <option value="SUPERVISOR">Supervisor</option>
                                    <option value="SUPER_ADMIN">Super Admin</option>
                                    <option value="OPERATOR" selected>Operador</option>
                                </select>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="label-row">
                                <label for="password">SENHA</label>
                            </div>
                            <div class="input-wrapper">
                                <i class="fa-solid fa-lock input-icon"></i>
                                <input type="password" id="password" name="senha" placeholder="••••••••" required>
                                <button type="button" id="toggle-password" class="toggle-password">
                                    <i class="fa-regular fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn-login">
                            SOLICITAR ACESSO <i class="fa-solid fa-chevron-right"></i>
                        </button>

                        <div class="form-footer">
                            <p>Já possui acesso? <a href="<?= BASE_PATH ?>/login" class="link-login">Fazer Login</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script src="<?= BASE_PATH ?>/assets/js/auth.js"></script>
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9
</body>
</html>
