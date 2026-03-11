<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Cadastro SENAI</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/auth.css">
</head>
<body class="register-page">

    <main class="login-container">
        <div class="login-card">
            <!-- Left Side: SENAI Branding -->
            <div class="login-sidebar register-sidebar">
                <div class="sidebar-header">
                    <div class="epi-logo-circle"></div>
                    <span class="epi-brand">EPI GUARD</span>
                </div>
                
                <div class="sidebar-main">
                    <h2 class="senai-title">SENAI</h2>
                    <p class="sidebar-text">Cadastro de Usuário</p>
                </div>
            </div>

            <!-- Right Side: Form -->
            <div class="login-form-area">
                <div class="form-header">
                    <h2>Cadastrar</h2>
                    <p>Insira as suas credenciais administrativas.</p>
                </div>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger" style="color: #e31e24; margin-bottom: 15px; font-weight: 600;">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <form id="register-form" method="POST" action="<?= BASE_PATH ?>/register">
                    <div class="input-group">
                        <label for="fullname">NOME COMPLETO</label>
                        <input type="text" id="fullname" name="nome" placeholder="Ex: Arthur Silva" required>
                    </div>

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

                    <div class="input-group">
                        <label for="cargo">CARGO</label>
                        <select name="cargo" id="cargo" style="width: 100%; padding: 12px; border-radius: 10px; border: 1px solid #E9EDF7; background: #F4F7FE; font-weight: 600; color: #1B2559;">
                            <option value="GERENTE_SEGURANCA">Gerente de Segurança</option>
                            <option value="SUPERVISOR">Supervisor</option>
                            <option value="SUPER_ADMIN">Super Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn-login btn-register">
                        CRIAR CONTA <i class="fa-solid fa-chevron-right"></i>
                    </button>

                    <div class="form-footer">
                        <p>Já tem conta? <a href="<?= BASE_PATH ?>/login" class="link-register">Faça Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="<?= BASE_PATH ?>/assets/js/auth.js"></script>
</body>
</html>
