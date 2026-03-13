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
                                <span class="summary-value" id="totalInfracoes">47</span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-icon amber">
                                <i class="fa-solid fa-clock"></i>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Pendentes</span>
                                <span class="summary-value" id="totalPendentes">12</span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-icon green">
                                <i class="fa-solid fa-check-circle"></i>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Resolvidas</span>
                                <span class="summary-value" id="totalResolvidas">35</span>
                            </div>
                        </div>
                        <div class="summary-card">
                            <div class="summary-icon blue">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <div class="summary-info">
                                <span class="summary-label">Funcionários Afetados</span>
                                <span class="summary-value" id="totalAlunos">23</span>
                            </div>
                        </div>
                    </div>

                    <!-- Filters -->
                    <div class="filter-bar">
                        <input type="text" id="searchInput" placeholder="🔍 Buscar funcionário ou setor...">
                        <select id="filterPeriodo">
                            <option value="todos">Todos os períodos</option>
                            <option value="hoje">Hoje</option>
                            <option value="semana">Esta Semana</option>
                            <option value="mes">Este Mês</option>
                        </select>
                        <select id="filterStatus">
                            <option value="todos">Todos os Status</option>
                            <option value="pendente">Pendente</option>
                            <option value="resolvido">Resolvido</option>
                        </select>
                        <select id="filterEpi">
                            <option value="todos">Todos os EPIs</option>
                            <option value="capacete">Capacete</option>
                            <option value="oculos">Óculos</option>
                        </select>
                        <button class="btn-filter" onclick="applyFilters()">
                            <i class="fa-solid fa-filter"></i> Filtrar
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="table-card">
                        <div class="card-header">
                            <h3>Registro de Infrações</h3>
                            <span style="font-size: 12px; color: var(--text-muted);" id="tableCount">Mostrando 5 registros</span>
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
                                <tr>
                                    <td>11/03/2026</td>
                                    <td style="font-weight: 600;">João Silva</td>
                                    <td>TDS</td>
                                    <td data-epi="capacete">Capacete</td>
                                    <td>10:30</td>
                                    <td data-status="pendente"><span class="status-dot pending"></span> Pendente</td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                            <button class="btn-action" title="Resolver"><i class="fa-solid fa-check"></i></button>
                                            <button class="btn-action danger" title="Excluir" onclick="deleteInfraction(this)"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>11/03/2026</td>
                                    <td style="font-weight: 600;">Maria Souza</td>
                                    <td>TDS</td>
                                    <td data-epi="oculos">Óculos</td>
                                    <td>09:15</td>
                                    <td data-status="resolvido"><span class="status-dot resolved"></span> Resolvido</td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10/03/2026</td>
                                    <td style="font-weight: 600;">Pedro Santos</td>
                                    <td>TDS</td>
                                    <td data-epi="capacete">Capacete</td>
                                    <td>14:00</td>
                                    <td data-status="pendente"><span class="status-dot pending"></span> Pendente</td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                            <button class="btn-action" title="Resolver"><i class="fa-solid fa-check"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10/03/2026</td>
                                    <td style="font-weight: 600;">Ana Oliveira</td>
                                    <td>ELE</td>
                                    <td data-epi="oculos">Óculos</td>
                                    <td>11:45</td>
                                    <td data-status="resolvido"><span class="status-dot resolved"></span> Resolvido</td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>09/03/2026</td>
                                    <td style="font-weight: 600;">Carlos Lima</td>
                                    <td>MEC</td>
                                    <td data-epi="capacete">Capacete</td>
                                    <td>08:20</td>
                                    <td data-status="resolvido"><span class="status-dot resolved"></span> Resolvido</td>
                                    <td>
                                        <div class="table-actions">
                                            <button class="btn-action" title="Ver detalhes"><i class="fa-solid fa-eye"></i></button>
                                            <button class="btn-action danger" title="Excluir" onclick="deleteInfraction(this)"><i class="fa-solid fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function applyFilters() {
            const searchText = document.getElementById('searchInput').value.toLowerCase();
            const filterStatus = document.getElementById('filterStatus').value;
            const filterEpi = document.getElementById('filterEpi').value;
            
            const tableBody = document.getElementById('infractionsTableBody');
            const rows = tableBody.getElementsByTagName('tr');
            let visibleCount = 0;

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                
                const funcionario = cells[1].textContent.toLowerCase();
                const setor = cells[2].textContent.toLowerCase();
                const epi = cells[3].getAttribute('data-epi');
                const status = cells[5].getAttribute('data-status');

                const matchesSearch = funcionario.includes(searchText) || setor.includes(searchText);
                const matchesStatus = filterStatus === 'todos' || status === filterStatus;
                const matchesEpi = filterEpi === 'todos' || epi === filterEpi;

                if (matchesSearch && matchesStatus && matchesEpi) {
                    row.style.display = '';
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            }

            document.getElementById('tableCount').textContent = `Mostrando ${visibleCount} registros`;
        }

        function deleteInfraction(btn) {
            if (confirm('Deseja realmente excluir este registro de infração?')) {
                const row = btn.closest('tr');
                row.style.opacity = '0';
                row.style.transform = 'translateX(20px)';
                setTimeout(() => {
                    row.remove();
                    applyFilters(); // Atualiza o contador
                }, 300);
            }
        }
    </script>
    <script>lucide.createIcons();</script>

</body>
</html>
