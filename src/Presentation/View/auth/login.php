<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facchini - Login EPI GUARD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@400;600;700;800&display=swap" rel="stylesheet">
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

        <!-- Lado Direito: Formulário -->
        <div class="right-side">
            <div class="login-box">
                <div class="login-header">
                    <h2>Bem-vindo</h2>
                    <p>Aceda à sua conta EPI GUARD introduzindo as suas credenciais abaixo.</p>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <form id="login-form" method="POST" action="<?= BASE_PATH ?>/login" class="facchini-form">
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
                            <a href="#" class="forgot-link">Recuperar senha?</a>
                        </div>
                        <div class="input-wrapper">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" name="senha" placeholder="••••••••" required>
                            <button type="button" class="eye-btn">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit">
                        ENTRAR NA PLATAFORMA <i class="fa-solid fa-chevron-right"></i>
                    </button>

                    <div class="form-bottom">
                        <p>Ainda não possui acesso? <a href="<?= BASE_PATH ?>/register">Solicitar Registro</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= BASE_PATH ?>/assets/js/auth.js"></script>
</body>
</html>
