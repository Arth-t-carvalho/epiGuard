<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Autenticação Facchini</title>
    <!-- Google Fonts: Inter e Outfit para uma estética premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/auth.css">
</head>
<body>

    <!-- Splash Screen Overlay -->
    <div id="splash-screen" class="splash-screen">
        <div class="splash-content">
            <h1 class="facchini-logo">FACCHINI</h1>
            <p class="splash-subtitle">AUTENTICAR SISTEMA</p>
            
            <div class="loading-container">
                <div id="progress-bar" class="progress-bar"></div>
            </div>
            
            <div id="enter-button" class="enter-system hidden">
                ENTRAR NO SISTEMA
            </div>
        </div>
    </div>

    <!-- Main Login Container -->
    <main class="login-container hidden">
        <div class="login-card">
            <!-- Left Side: Branding -->
            <div class="login-sidebar">
                <div class="sidebar-header">
                    <div class="epi-logo-circle"></div>
                    <span class="epi-brand">EPI GUARD</span>
                </div>
                
                <div class="sidebar-main">
                    <h2 class="facchini-title">FACCHINI</h2>
                    <p class="sidebar-text">
                        Portal administrativo para monitorização de segurança industrial e gestão de EPIs.
                    </p>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="login-form-area">
                <div class="form-header">
                    <h2>Acessar</h2>
                    <p>Insira as suas credenciais administrativas.</p>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" style="color: #e31e24; margin-bottom: 15px; font-weight: 600;">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success" style="color: #28a745; margin-bottom: 15px; font-weight: 600;">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form id="login-form" method="POST" action="<?= BASE_PATH ?>/login">
                    <div class="input-group">
                        <label for="username">GMAIL OU CPF</label>
                        <input type="text" id="username" name="usuario" placeholder="exemplo@gmail.com ou CPF" required>
                    </div>

                    <div class="input-group">
                        <label for="password">SENHA</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="senha" placeholder="••••••••" required>
                            <button type="button" id="toggle-password" class="toggle-password">
                                <i class="fa-regular fa-eye-slash"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-login">
                        ENTRAR <i class="fa-solid fa-chevron-right"></i>
                    </button>

                    <div class="form-footer">
                        <a href="#" class="link-forgot">Esqueceu a senha?</a>
                        <p>Não tem uma conta? <a href="<?= BASE_PATH ?>/register" class="link-register">Cadastre-se</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="<?= BASE_PATH ?>/assets/js/auth.js"></script>
</body>
</html>
