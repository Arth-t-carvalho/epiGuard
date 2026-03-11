<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Dashboard</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/dashboard.css">
</head>
<body>

    <div class="app-wrapper">
        <?php include __DIR__ . '/../layout/sidebar.php'; ?>

        <main class="main-content">
            <?php include __DIR__ . '/../layout/header.php'; ?>

            <div class="content-body">
                <div class="welcome-section">
                    <h1>Olá, <span class="highlight">Admin</span></h1>
                    <p>Aqui está o resumo da segurança industrial hoje.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="label">Total de Alunos</span>
                            <span class="value">1,248</span>
                        </div>
                        <div class="stat-icon blue">
                            <i class="fa-solid fa-users"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="label">Alunos Conformes</span>
                            <span class="value">98%</span>
                        </div>
                        <div class="stat-icon green">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="label">Ocorrências Hoje</span>
                            <span class="value">12</span>
                        </div>
                        <div class="stat-icon red">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-info">
                            <span class="label">EPIs Ativos</span>
                            <span class="value">458</span>
                        </div>
                        <div class="stat-icon purple">
                            <i class="fa-solid fa-helmet-safety"></i>
                        </div>
                    </div>
                </div>

                <div class="dashboard-grid">
                    <div class="grid-card recent-occurrences">
                        <div class="card-header">
                            <h3>Ocorrências Recentes</h3>
                            <a href="#" class="btn-link">Ver todas</a>
                        </div>
                        <div class="card-body">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Aluno</th>
                                        <th>Tipo</th>
                                        <th>Horário</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Arthur Silva</td>
                                        <td>Ausência de Luva</td>
                                        <td>08:45</td>
                                        <td><span class="badge warning">Pendente</span></td>
                                    </tr>
                                    <tr>
                                        <td>Maria Clara</td>
                                        <td>Capacete Desajustado</td>
                                        <td>09:12</td>
                                        <td><span class="badge success">Resolvido</span></td>
                                    </tr>
                                    <tr>
                                        <td>João Pedro</td>
                                        <td>Óculos de Proteção</td>
                                        <td>09:30</td>
                                        <td><span class="badge danger">Crítico</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="grid-card safety-monitoring">
                        <div class="card-header">
                            <h3>Monitoramento Facial</h3>
                            <span class="pulse-icon"><i class="fa-solid fa-circle"></i> LIVE</span>
                        </div>
                        <div class="card-body">
                            <div class="monitoring-placeholder">
                                <i class="fa-solid fa-camera"></i>
                                <p>Câmera Central Ativa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
