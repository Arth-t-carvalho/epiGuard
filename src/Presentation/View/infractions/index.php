<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Infrações</title>
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
            <div id="page-content-wrapper" class="content-fade">
                <!-- Header -->
                <header class="header">
                    <div class="page-title">
                        <h1>Infrações</h1>
                        <p>Gestão de ocorrências e infrações de EPI</p>
                    </div>
                    <div class="header-actions">
                        <button class="btn-primary" onclick="alert('Em breve: Exportar PDF')">
                            <i class="fa-solid fa-download"></i> Exportar
                        </button>
                    </div>
                </header>

                <div class="page-content">
                    <!-- Summary Cards -->
                    <div class="summary-row">
                        <div class="summary-card">
                            <div class="summary-icon red">
                                <i class="fa-solid fa-triangle-exclamation"></i>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Total Infrações</span>
                                <span class="summary-value" id="totalInfracoes"><?= count($infractions) ?></span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-icon amber">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Pendentes</span>
                                <span class="summary-value" id="totalPendentes"><?= count(array_filter($infractions, fn($i) => ($i['status'] ?? '') === 'pendente')) ?: 0 ?></span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-icon green">
                                <i class="fa-solid fa-check-circle"></i>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Resolvidas</span>
                                <span class="summary-value" id="totalResolvidas"><?= count(array_filter($infractions, fn($i) => ($i['status'] ?? '') === 'resolvido')) ?: 0 ?></span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-icon blue">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Funcionários Afetados</span>
                                <span class="summary-value" id="totalAlunos"><?= count(array_unique(array_column($infractions, 'funcionario_nome'))) ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <form action="<?= BASE_PATH ?>/infractions" method="GET" class="filter-bar">
                        <input type="text" name="search" id="searchInput" placeholder="🔍 Buscar funcionário ou setor..." value="<?= htmlspecialchars($filters['search']) ?>">
                        <select name="periodo" id="filterPeriodo">
                            <option value="todos" <?= $filters['periodo'] === 'todos' ? 'selected' : '' ?>>Todos os períodos</option>
                            <option value="hoje" <?= $filters['periodo'] === 'hoje' ? 'selected' : '' ?>>Hoje</option>
                            <option value="semana" <?= $filters['periodo'] === 'semana' ? 'selected' : '' ?>>Esta Semana</option>
                            <option value="mes" <?= $filters['periodo'] === 'mes' ? 'selected' : '' ?>>Este Mês</option>
                        </select>
                        <select name="status" id="filterStatus">
                            <option value="todos" <?= $filters['status'] === 'todos' ? 'selected' : '' ?>>Todos os Status</option>
                            <option value="pendente" <?= $filters['status'] === 'pendente' ? 'selected' : '' ?>>Pendente</option>
                            <option value="resolvido" <?= $filters['status'] === 'resolvido' ? 'selected' : '' ?>>Resolvido</option>
                        </select>
                        <select name="epi" id="filterEpi">
                            <option value="todos" <?= $filters['epi'] === 'todos' ? 'selected' : '' ?>>Todos os EPIs</option>
                            <option value="capacete" <?= $filters['epi'] === 'capacete' ? 'selected' : '' ?>>Capacete</option>
                            <option value="oculos" <?= $filters['epi'] === 'oculos' ? 'selected' : '' ?>>Óculos</option>
                            <option value="protetor" <?= $filters['epi'] === 'protetor' ? 'selected' : '' ?>>Protetor Auricular</option>
                        </select>
                        <select name="display_mode" id="displayMode">
                            <option value="name" <?= ($_GET['display_mode'] ?? 'name') === 'name' ? 'selected' : '' ?>>Exibir Nomes</option>
                            <option value="photo" <?= ($_GET['display_mode'] ?? 'name') === 'photo' ? 'selected' : '' ?>>Exibir Fotos</option>
                        </select>
                        <button type="submit" class="btn-filter">
                            <i class="fa-solid fa-filter"></i> Filtrar
                        </button>
                    </form>

                    <!-- View Toggle Container -->
                    <div class="view-container">
                        <?php if (($_GET['display_mode'] ?? 'name') === 'photo'): ?>
                            <!-- Card Grid Mode -->
                            <div class="infractions-grid">
                                <?php if (empty($infractions)): ?>
                                    <div class="empty-state-card" style="grid-column: 1 / -1;">
                                        <i class="fa-solid fa-camera"></i>
                                        <p>Nenhuma foto de infração disponível para os filtros atuais.</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($infractions as $infraction): ?>
                                        <div class="infraction-card">
                                            <div class="card-image-box">
                                                <?php if (!empty($infraction['evidencia'])): ?>
                                                    <img src="<?= BASE_PATH ?>/public/uploads/<?= htmlspecialchars($infraction['evidencia']) ?>" alt="Evidência" class="infraction-photo">
                                                <?php else: ?>
                                                    <div class="photo-placeholder">
                                                        <i class="fa-solid fa-image"></i>
                                                        <span>Sem foto da evidência</span>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="card-badge" data-status="<?= htmlspecialchars($infraction['status'] ?? 'pendente') ?>">
                                                    <?= ucfirst($infraction['status'] ?? 'Pendente') ?>
                                                </div>
                                            </div>
                                            <div class="card-details">
                                                <div class="employee-mini">
                                                    <?php if (!empty($infraction['foto_referencia'])): ?>
                                                        <img src="<?= BASE_PATH ?>/public/uploads/<?= htmlspecialchars($infraction['foto_referencia']) ?>" alt="Avatar" class="avatar-mini">
                                                    <?php else: ?>
                                                        <div class="avatar-mini-placeholder"><?= strtoupper(substr($infraction['funcionario_nome'], 0, 1)) ?></div>
                                                    <?php endif; ?>
                                                    <div class="employee-meta">
                                                        <span class="name"><?= htmlspecialchars($infraction['funcionario_nome']) ?></span>
                                                        <span class="sector"><?= htmlspecialchars($infraction['setor_sigla'] ?? 'N/A') ?></span>
                                                    </div>
                                                </div>
                                                <div class="infraction-meta">
                                                    <div class="meta-item">
                                                        <i class="fa-solid fa-helmet-safety"></i>
                                                        <span><?= htmlspecialchars($infraction['epi_nome'] ?? 'N/A') ?></span>
                                                    </div>
                                                    <div class="meta-item">
                                                        <i class="fa-solid fa-calendar-alt"></i>
                                                        <span><?= date('d/m/Y', strtotime($infraction['data_hora'])) ?> às <?= date('H:i', strtotime($infraction['data_hora'])) ?></span>
                                                    </div>
                                                </div>
                                                <div class="card-actions">
                                                    <button class="btn-card-action primary"><i class="fa-solid fa-eye"></i> Detalhes</button>
                                                    <button class="btn-card-action danger" onclick="deleteInfraction(<?= $infraction['id'] ?>, this.closest('.infraction-card'))"><i class="fa-solid fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <!-- Table Mode -->
                            <div class="table-card">
                                <div class="card-header">
                                    <h3>Registro de Infrações</h3>
                                    <span style="font-size: 12px; color: var(--text-muted);" id="tableCount">Mostrando <?= count($infractions) ?> registros</span>
                                </div>

                                <table class="data-table" id="infractionsTable">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Funcionário</th>
                                            <th>Setor</th>
                                            <th>EPI</th>
                                            <th>Horário</th>
                                            <th>Status</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody id="infractionsTableBody">
                                        <?php if (empty($infractions)): ?>
                                            <tr>
                                                <td colspan="7" style="text-align: center; padding: 30px; color: var(--text-muted);">
                                                    Nenhuma infração encontrada com os filtros selecionados.
                                                </td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($infractions as $infraction): ?>
                                                <tr>
                                                    <td><?= date('d/m/Y', strtotime($infraction['data_hora'])) ?></td>
                                                    <td style="font-weight: 600;">
                                                        <?= htmlspecialchars($infraction['funcionario_nome']) ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($infraction['setor_sigla'] ?? 'N/A') ?></td>
                                                    <td data-epi="<?= strtolower($infraction['epi_nome'] ?? '') ?>"><?= htmlspecialchars($infraction['epi_nome'] ?? 'N/A') ?></td>
                                                    <td><?= date('H:i', strtotime($infraction['data_hora'])) ?></td>
                                                    <td data-status="<?= htmlspecialchars($infraction['status'] ?? 'pendente') ?>">
                                                        <span class="status-dot <?= ($infraction['status'] ?? 'pendente') === 'resolvido' ? 'resolved' : 'pending' ?>"></span> 
                                                        <?= ucfirst($infraction['status'] ?? 'Pendente') ?>
                                                    </td>
                                                    <td>
                                                        <div class="table-actions">
                                                            <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                                            <?php if (($infraction['status'] ?? 'pendente') !== 'resolvido'): ?>
                                                                <button class="btn-action" title="Resolver"><i class="fa-solid fa-check"></i></button>
                                                            <?php endif; ?>
                                                            <button class="btn-action danger" title="Excluir" onclick="deleteInfraction(<?= $infraction['id'] ?>, this.closest('tr'))"><i class="fa-solid fa-trash"></i></button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function deleteInfraction(id, element) {
            if (confirm('Deseja realmente excluir este registro de infração?')) {
                if (element) {
                    element.style.opacity = '0';
                    element.style.transform = 'translateY(20px)';
                    element.style.transition = '0.3s';
                    
                    // Em um cenário real, aqui haveria uma chamada fetch ao backend
                    setTimeout(() => {
                        element.remove();
                    }, 300);
                }
            }
        }
    </script>
    <script>lucide.createIcons();</script>

</body>
</html>
