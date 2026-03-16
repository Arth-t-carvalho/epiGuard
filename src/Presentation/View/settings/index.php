<?php
$pageTitle = 'Configurações - epiGuard';
ob_start();
?>

<div class="settings-container">
    <div class="settings-header">
        <h2>Configurações do Sistema</h2>
        <p>Gerencie as preferências de visualização e conta</p>
    </div>

    <div class="settings-grid">
        <!-- Card de Aparência -->
        <div class="settings-card card">
            <div class="card-icon">
                <i data-lucide="palette"></i>
            </div>
            <div class="card-content">
                <h3>Aparência</h3>
                <p>Personalize como o epiGuard aparece para você</p>
                
                <div class="setting-item">
                    <div class="setting-info">
                        <span>Tema do Sistema</span>
                        <small>Alternar entre modo claro e escuro</small>
                    </div>
                    <button id="theme-toggle" class="theme-switch-btn">
                        <i data-lucide="sun" class="sun-icon"></i>
                        <i data-lucide="moon" class="moon-icon"></i>
                        <span class="switch-handle"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Card de Informações (Placeholder) -->
        <div class="settings-card card">
            <div class="card-icon">
                <i data-lucide="user"></i>
            </div>
            <div class="card-content">
                <h3>Minha Conta</h3>
                <p>Informações do seu perfil de Arthur</p>
                <div class="setting-item disabled">
                    <span>Editar Perfil</span>
                    <span class="badge">Em breve</span>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .settings-container {
        padding: 20px;
        animation: fadeIn 0.5s ease-out;
    }

    .settings-header {
        margin-bottom: 30px;
    }

    .settings-header h2 {
        font-size: 28px;
        font-weight: 800;
        color: var(--secondary);
    }

    .settings-header p {
        color: var(--text-muted);
    }

    .settings-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 25px;
    }

    .settings-card {
        display: flex;
        gap: 20px;
        padding: 30px;
        align-items: flex-start;
    }

    .card-icon {
        width: 50px;
        height: 50px;
        background: var(--primary-light);
        color: var(--primary);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .card-icon i {
        width: 24px;
        height: 24px;
    }

    .card-content {
        flex: 1;
    }

    .card-content h3 {
        font-size: 18px;
        font-weight: 700;
        margin-bottom: 5px;
        color: var(--secondary);
    }

    .card-content p {
        font-size: 14px;
        color: var(--text-muted);
        margin-bottom: 25px;
    }

    .setting-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-top: 1px solid var(--border);
    }

    .setting-item.disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .setting-info {
        display: flex;
        flex-direction: column;
    }

    .setting-info span {
        font-weight: 600;
        color: var(--text-main);
    }

    .setting-info small {
        font-size: 12px;
        color: var(--text-muted);
    }

    /* Theme Switch Button */
    .theme-switch-btn {
        position: relative;
        width: 64px;
        height: 32px;
        background: #e2e8f0;
        border: none;
        border-radius: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 6px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    [data-theme="dark"] .theme-switch-btn {
        background: var(--primary);
    }

    .theme-switch-btn i {
        width: 16px;
        height: 16px;
        z-index: 1;
        transition: all 0.3s ease;
    }

    .sun-icon { color: #f59e0b; }
    .moon-icon { color: #cbd5e1; }

    [data-theme="dark"] .sun-icon { color: #cbd5e1; }
    [data-theme="dark"] .moon-icon { color: #ffffff; }

    .switch-handle {
        position: absolute;
        top: 4px;
        left: 4px;
        width: 24px;
        height: 24px;
        background: white;
        border-radius: 50%;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    [data-theme="dark"] .switch-handle {
        transform: translateX(32px);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const themeToggle = document.getElementById('theme-toggle');
        
        themeToggle.addEventListener('click', () => {
            const currentTheme = document.documentElement.getAttribute('data-theme') || 'light';
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            // Aplicar o tema
            document.documentElement.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Alerta visual de feedback (opcional)
            console.log('Tema alterado para:', newTheme);
        });
    });
</script>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/main.php';
?>
