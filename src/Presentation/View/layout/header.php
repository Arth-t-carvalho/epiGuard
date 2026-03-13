<<<<<<< Updated upstream
=======
<header class="header">
    <div class="page-title">
        <h1>Dashboard</h1>
        <p>Olá Arthur, bem-vindo de volta!</p>
    </div>

    <div class="header-actions">
        <a href="<?= BASE_PATH ?>/management/employees" class="btn-admin">
            <i class="fa-solid fa-gear"></i> Administrar
        </a>

        <button class="btn-export" onclick="exportData()">
            <i class="fa-solid fa-download"></i> Exportar
        </button>
        
        <div class="user-profile-trigger" id="profileTrigger">
            <div class="user-info-mini">
                <span class="user-name"><?= $_SESSION['user_nome'] ?? 'Usuário' ?></span>
                <span class="user-role"><?= $_SESSION['user_cargo'] ?? 'Convidado' ?></span>
            </div>
            <div class="user-avatar">
                <?= isset($_SESSION['user_nome']) ? strtoupper(substr($_SESSION['user_nome'], 0, 2)) : '??' ?>
            </div>

            <!-- Menu Dropdown -->
            <div class="profile-dropdown" id="profileDropdown">
                <div class="user-card-header">
                    <div class="user-card-avatar">
                        <?= isset($_SESSION['user_nome']) ? strtoupper(substr($_SESSION['user_nome'], 0, 2)) : '??' ?>
                    </div>
                    <div class="user-card-info">
                        <strong><?= $_SESSION['user_nome'] ?? 'Usuário' ?></strong>
                        <span><?= $_SESSION['user_email'] ?? 'usuario@facchini.com.br' ?></span>
                        <small><?= $_SESSION['user_cargo'] ?? 'Convidado' ?></small>
                    </div>
                </div>

                <div class="dropdown-buttons">
                    <button class="btn-menu-close" onclick="toggleProfileMenu(event)">Fechar</button>
                    <a href="<?= BASE_PATH ?>/logout" class="btn-menu-logout">Sair</a>
                </div>
            </div>
        </div>
    </div>
</header>
>>>>>>> Stashed changes
