<<<<<<< HEAD
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Alunos</title>
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
                    <h1>Alunos</h1>
                    <p>Gerencie os alunos cadastrados na instituição</p>
                </div>
                <div class="header-actions">
                    <button class="btn-primary" id="btnAddEmployee">
                        <i class="fa-solid fa-user-plus"></i> Novo Aluno
                    </button>
                </div>
            </header>

            <div class="page-content">
                <!-- Summary -->
                <div class="summary-row">
                    <div class="summary-card">
                        <div class="summary-icon blue">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-label">Total de Alunos</span>
                            <span class="summary-value">165</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-icon green">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-label">Conformes</span>
                            <span class="summary-value">142</span>
                        </div>
                    </div>
                    <div class="summary-card">
                        <div class="summary-icon red">
                            <i class="fa-solid fa-circle-xmark"></i>
                        </div>
                        <div class="summary-info">
                            <span class="summary-label">Não Conformes</span>
                            <span class="summary-value">23</span>
                        </div>
                    </div>
                </div>

                <!-- Filters -->
                <div class="filter-bar">
                    <input type="text" placeholder="🔍 Buscar aluno por nome...">
                    <select>
                        <option value="">Todos os Cursos</option>
                        <option value="TDS">TDS</option>
                        <option value="ELE">ELE</option>
                        <option value="MEC">MEC</option>
                        <option value="AUT">AUT</option>
                    </select>
                    <select>
                        <option value="">Todos os Turnos</option>
                        <option value="MANHA">Manhã</option>
                        <option value="TARDE">Tarde</option>
                        <option value="NOITE">Noite</option>
                    </select>
                    <select>
                        <option value="">Todos os Status</option>
                        <option value="CONFORME">Conforme</option>
                        <option value="NAO_CONFORME">Não Conforme</option>
                    </select>
                    <button class="btn-filter"><i class="fa-solid fa-filter"></i> Filtrar</button>
                </div>

                <!-- Table -->
                <div class="table-card">
                    <div class="card-header">
                        <h3>Lista de Alunos</h3>
                        <span style="font-size: 12px; color: var(--text-muted);">5 registros</span>
                    </div>

                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Curso</th>
                                <th>Turno</th>
                                <th>Status EPI</th>
                                <th>Infrações</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight:600;">João Silva</td>
                                <td>TDS</td>
                                <td>Manhã</td>
                                <td><span class="status-dot pending"></span> Não Conforme</td>
                                <td style="font-weight:700; color: var(--primary);">3</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Maria Souza</td>
                                <td>TDS</td>
                                <td>Tarde</td>
                                <td><span class="status-dot resolved"></span> Conforme</td>
                                <td>0</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Pedro Santos</td>
                                <td>ELE</td>
                                <td>Manhã</td>
                                <td><span class="status-dot pending"></span> Não Conforme</td>
                                <td style="font-weight:700; color: var(--primary);">5</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Ana Oliveira</td>
                                <td>MEC</td>
                                <td>Noite</td>
                                <td><span class="status-dot resolved"></span> Conforme</td>
                                <td>0</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight:600;">Carlos Lima</td>
                                <td>AUT</td>
                                <td>Manhã</td>
                                <td><span class="status-dot resolved"></span> Conforme</td>
                                <td>1</td>
                                <td>
                                    <div class="table-actions">
                                        <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                                        <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
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

=======
<?php
$pageTitle = 'epiGuard - Alunos';
ob_start();
?>

<header class="header">
    <div class="page-title">
        <h1>Alunos</h1>
        <p>Gerencie os alunos cadastrados na instituição</p>
    </div>
    <div class="header-actions">
        <button class="btn-primary" id="btnAddEmployee">
            <i class="fa-solid fa-user-plus"></i> Novo Aluno
        </button>
    </div>
</header>

<div class="page-content">
    <!-- Summary -->
    <div class="summary-row">
        <div class="summary-card">
            <div class="summary-icon blue">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="summary-info">
                <span class="summary-label">Total de Alunos</span>
                <span class="summary-value">165</span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon green">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <div class="summary-info">
                <span class="summary-label">Conformes</span>
                <span class="summary-value">142</span>
            </div>
        </div>
        <div class="summary-card">
            <div class="summary-icon red">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <div class="summary-info">
                <span class="summary-label">Não Conformes</span>
                <span class="summary-value">23</span>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="filter-bar">
        <input type="text" placeholder="🔍 Buscar aluno por nome...">
        <select>
            <option value="">Todos os Cursos</option>
            <option value="TDS">TDS</option>
            <option value="ELE">ELE</option>
            <option value="MEC">MEC</option>
            <option value="AUT">AUT</option>
        </select>
        <select>
            <option value="">Todos os Turnos</option>
            <option value="MANHA">Manhã</option>
            <option value="TARDE">Tarde</option>
            <option value="NOITE">Noite</option>
        </select>
        <select>
            <option value="">Todos os Status</option>
            <option value="CONFORME">Conforme</option>
            <option value="NAO_CONFORME">Não Conforme</option>
        </select>
        <button class="btn-filter"><i class="fa-solid fa-filter"></i> Filtrar</button>
    </div>

    <!-- Table -->
    <div class="table-card">
        <div class="card-header">
            <h3>Lista de Alunos</h3>
            <span style="font-size: 12px; color: var(--text-muted);">5 registros</span>
        </div>

        <table class="data-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Turno</th>
                    <th>Status EPI</th>
                    <th>Infrações</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="font-weight:600;">João Silva</td>
                    <td>TDS</td>
                    <td>Manhã</td>
                    <td><span class="status-dot pending"></span> Não Conforme</td>
                    <td style="font-weight:700; color: var(--primary);">3</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Maria Souza</td>
                    <td>TDS</td>
                    <td>Tarde</td>
                    <td><span class="status-dot resolved"></span> Conforme</td>
                    <td>0</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Pedro Santos</td>
                    <td>ELE</td>
                    <td>Manhã</td>
                    <td><span class="status-dot pending"></span> Não Conforme</td>
                    <td style="font-weight:700; color: var(--primary);">5</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Ana Oliveira</td>
                    <td>MEC</td>
                    <td>Noite</td>
                    <td><span class="status-dot resolved"></span> Conforme</td>
                    <td>0</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight:600;">Carlos Lima</td>
                    <td>AUT</td>
                    <td>Manhã</td>
                    <td><span class="status-dot resolved"></span> Conforme</td>
                    <td>1</td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-action" title="Ver perfil"><i class="fa-solid fa-eye"></i></button>
                            <button class="btn-action" title="Editar"><i class="fa-solid fa-pen"></i></button>
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
</body>
</html>
