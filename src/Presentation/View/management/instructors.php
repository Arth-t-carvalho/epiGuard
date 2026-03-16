<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Instrutores</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/management.css">
</head>
<body>

    <div class="app-wrapper">
        <?php include __DIR__ . '/../layout/sidebar.php'; ?>

        <main class="main-content">
            <header class="header">
                <div class="page-title">
                    <h1>Instrutores</h1>
                    <p>Gerencie os instrutores e supervisores</p>
                </div>
                <div class="header-actions">
                    <button class="btn-primary" id="btnAddInstructor">
                        <i class="fa-solid fa-user-plus"></i> Novo Instrutor
                    </button>
                </div>
            </header>

            <div class="page-content">
                <!-- Summary -->
                <div class="summary-row">
                    <div class="summary-card">
                        <div class="summary-icon blue">
                            <i class="fa-solid fa-chalkboard-user"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-label">Total Instrutores</span>
                            <span class="summary-value">11</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-icon green">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-label">Super Admins</span>
                            <span class="summary-value">2</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-icon amber">
                            <i class="fa-solid fa-user-tie"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-label">Supervisores</span>
                            <span class="summary-value">4</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-icon red">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-label">Professores</span>
                            <span class="summary-value">5</span>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filter-bar">
                    <input type="text" placeholder="🔍 Buscar instrutor...">
                    <select>
                        <option value="">Todos os Cargos</option>
                        <option value="SUPER_ADMIN">Super Admin</option>
                        <option value="SUPERVISOR">Supervisor</option>
                        <option value="PROFESSOR">Professor</option>
                    </select>
                    <select>
                        <option value="">Todos os Setores</option>
                        <option value="TDS">TDS</option>
                        <option value="ELE">ELE</option>
                        <option value="MEC">MEC</option>
                        <option value="AUT">AUT</option>
                    </select>
                    <button class="btn-filter"><i class="fa-solid fa-filter"></i> Filtrar</button>
                </div>

                <!-- Table -->
                <div class="table-card">
                    <div class="card-header">
                        <h3>Lista de Instrutores</h3>
                        <span style="font-size: 12px; color: var(--text-muted);">5 registros</span>
                    </div>

                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Usuário</th>
                                <th>Cargo</th>
                                <th>Setor</th>
                                <th>Turno</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight:600;">Ricardo Mendes</td>
                                <td>ricardo.mendes</td>
                                <td><span style="background:#eff6ff; color:#3b82f6; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Super Admin</span></td>
                                <td>—</td>
                                <td>Integral</td>
                                <td><span class="status-dot resolved"></span> Ativo</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Fernanda Costa</td>
                                <td>fernanda.costa</td>
                                <td><span style="background:#fefce8; color:#ca8a04; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Supervisor</span></td>
                                <td>TDS</td>
                                <td>Manhã</td>
                                <td><span class="status-dot resolved"></span> Ativo</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn-action danger" title="Inativar"><i class="fa-solid fa-ban"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Carlos Pereira</td>
                                <td>carlos.pereira</td>
                                <td><span style="background:#fef2f2; color: var(--primary); padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Professor</span></td>
                                <td>ELE</td>
                                <td>Tarde</td>
                                <td><span class="status-dot resolved"></span> Ativo</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn-action danger" title="Inativar"><i class="fa-solid fa-ban"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Juliana Rocha</td>
                                <td>juliana.rocha</td>
                                <td><span style="background:#fefce8; color:#ca8a04; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Supervisor</span></td>
                                <td>MEC</td>
                                <td>Manhã</td>
                                <td><span class="status-dot resolved"></span> Ativo</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn-action danger" title="Inativar"><i class="fa-solid fa-ban"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Marco Almeida</td>
                                <td>marco.almeida</td>
                                <td><span style="background:#fef2f2; color: var(--primary); padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Professor</span></td>
                                <td>AUT</td>
                                <td>Noite</td>
                                <td><span class="status-dot pending"></span> Inativo</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                        <button class="btn-action" title="Reativar" style="color: #16a34a;"><i class="fa-solid fa-rotate-left"></i></button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>lucide.createIcons();</script>

</body>
</html>
=======
<?php
$pageTitle = 'epiGuard - Instrutores';
ob_start();
?>

<header class="header">
    <div class="page-title">
        <h1>Instrutores</h1>
        <p>Gerencie os instrutores e supervisores</p>
    </div>
    <div class="header-actions">
        <button class="btn-primary" id="btnAddInstructor">
            <i class="fa-solid fa-user-plus"></i> Novo Instrutor
        </button>
    </div>
</header>

<div class="page-content">
    <!-- Summary -->
    <div class="summary-row">
        <div class="summary-card">
            <div class="summary-icon blue">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="summary-info">
                <span class="summary-label">Total Instrutores</span>
                <span class="summary-value">11</span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon green">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <div class="summary-info">
                <span class="summary-label">Super Admins</span>
                <span class="summary-value">2</span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon amber">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="summary-info">
                <span class="summary-label">Supervisores</span>
                <span class="summary-value">4</span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon red">
                <i class="fa-solid fa-user"></i>
            </div>
            <div class="summary-info">
                <span class="summary-label">Professores</span>
                <span class="summary-value">5</span>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filter-bar">
        <input type="text" placeholder="🔍 Buscar instrutor...">
        <select>
            <option value="">Todos os Cargos</option>
            <option value="SUPER_ADMIN">Super Admin</option>
            <option value="SUPERVISOR">Supervisor</option>
            <option value="PROFESSOR">Professor</option>
        </select>
        <select>
            <option value="">Todos os Setores</option>
            <option value="TDS">TDS</option>
            <option value="ELE">ELE</option>
            <option value="MEC">MEC</option>
            <option value="AUT">AUT</option>
        </select>
        <button class="btn-filter"><i class="fa-solid fa-filter"></i> Filtrar</button>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="card-header">
            <h3>Lista de Instrutores</h3>
            <span style="font-size: 12px; color: var(--text-muted);">5 registros</span>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Cargo</th>
                    <th>Setor</th>
                    <th>Turno</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:600;">Ricardo Mendes</td>
                    <td>ricardo.mendes</td>
                    <td><span style="background:#eff6ff; color:#3b82f6; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Super Admin</span></td>
                    <td>—</td>
                    <td>Integral</td>
                    <td><span class="status-dot resolved"></span> Ativo</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Fernanda Costa</td>
                    <td>fernanda.costa</td>
                    <td><span style="background:#fefce8; color:#ca8a04; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Supervisor</span></td>
                    <td>TDS</td>
                    <td>Manhã</td>
                    <td><span class="status-dot resolved"></span> Ativo</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-action danger" title="Inativar"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Carlos Pereira</td>
                    <td>carlos.pereira</td>
                    <td><span style="background:#fef2f2; color: var(--primary); padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Professor</span></td>
                    <td>ELE</td>
                    <td>Tarde</td>
                    <td><span class="status-dot resolved"></span> Ativo</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-action danger" title="Inativar"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Juliana Rocha</td>
                    <td>juliana.rocha</td>
                    <td><span style="background:#fefce8; color:#ca8a04; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Supervisor</span></td>
                    <td>MEC</td>
                    <td>Manhã</td>
                    <td><span class="status-dot resolved"></span> Ativo</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-action danger" title="Inativar"><i class="fa-solid fa-ban"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Marco Almeida</td>
                    <td>marco.almeida</td>
                    <td><span style="background:#fef2f2; color: var(--primary); padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600;">Professor</span></td>
                    <td>AUT</td>
                    <td>Noite</td>
                    <td><span class="status-dot pending"></span> Inativo</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                            <button class="btn-action" title="Reativar" style="color: #16a34a;"><i class="fa-solid fa-rotate-left"></i></button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?php
$content = ob_get_clean();
require_once __DIR__ . '/../layout/main.php';
?>
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9
