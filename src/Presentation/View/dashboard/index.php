<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Painel Geral</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/dashboard.css">
    
    <!-- Dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>
</head>
<body>

    <div class="app-wrapper">
        <?php include __DIR__ . '/../layout/sidebar.php'; ?>

        <main class="main-content">
            <?php include __DIR__ . '/../layout/header.php'; ?>

            <div id="page-content-wrapper" class="content-fade">
                <!-- Global Variables for JS -->
                <script>
                    window.BASE_PATH = '<?= BASE_PATH ?>';
                    window.userRole = '<?= $_SESSION['user_cargo'] ?? 'instrutor' ?>';
                    window.totalStudents = 100; // Mock total students
                </script>

                <!-- KPI CARDS -->
                <div class="kpi-grid">
                    <div class="kpi-card card">
                        <span class="kpi-header">INFRAÇÕES HOJE</span>
                        <div class="kpi-value">
                            <span id="kpiDia">0</span>
                            <span class="badge" id="badgeDia">0%</span>
                        </div>
                    </div>

                    <div class="kpi-card card">
                        <span class="kpi-header">INFRAÇÕES SEMANA</span>
                        <div class="kpi-value">
                            <span id="kpiSemana">0</span>
                            <span class="badge" id="badgeSemana">0%</span>
                        </div>
                    </div>

                    <div class="kpi-card card">
                        <span class="kpi-header">INFRAÇÕES MÊS</span>
                        <div class="kpi-value">
                            <span id="kpiMes">0</span>
                        </div>
                    </div>

                    <div class="kpi-card card">
                        <span class="kpi-header">CONFORMIDADE</span>
                        <div class="kpi-value">
                            <span id="kpiMedia">0%</span>
                        </div>
                    </div>
                </div>

                <!-- MAIN CHART -->
                <div class="chart-card card">
                    <div class="chart-header-actions">
                        <h3 class="chart-title">Visão Geral Trimestral</h3>
                        
                        <!-- GATILHO MINIMALISTA -->
                        <div class="minimal-filter-trigger" onclick="openCourseModal()">
                            <div class="filter-info">
                                <span class="filter-label">Setor Ativo</span>
                                <span id="currentSectorLabel" class="filter-value">Empresa Inteira</span>
                            </div>
                            <div class="filter-icon">
                                <i data-lucide="chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container" style="height: 300px;">
                        <canvas id="mainChart"></canvas>
                    </div>
                </div>

                <!-- BOTTOM GRID -->
                <div class="chart-grid">
                    <!-- Registro Diário -->
                    <div class="card">
                        <div class="section-header">
                            <h3 class="section-title">Registro Diário</h3>
                            <button class="calendar-trigger" onclick="toggleCalendar()">
                                <i data-lucide="calendar"></i>
                            </button>
                        </div>
                        <div class="calendar-nav" onclick="toggleCalendar()"
                            onmouseover="this.style.transform='scale(1.01)'" onmouseout="this.style.transform='scale(1)'">

                            <button class="nav-btn" onclick="event.stopPropagation(); changeDay(-1)">❮</button>

                            <div class="date-display"
                                style="text-align: center; display: flex; flex-direction: column; align-items: center;">
                                <div id="displayDayNum"
                                    style="color: #E30613; font-size: 28px; font-weight: 800; line-height: 1;">
                                    --
                                </div>
                                <div id="displayMonthStr" style="color: #64748B; font-size: 13px; font-weight: 600;">
                                    --
                                </div>

                                <div
                                    style="font-size: 10px; color: #E30613; font-weight: 700; margin-top: 6px; display: flex; align-items: center; gap: 4px; cursor: pointer;">
                                    <span style="font-size: 8px;"></span> Clique para expandir
                                </div>
                            </div>

                            <button class="nav-btn" onclick="event.stopPropagation(); changeDay(1)">❯</button>
                        </div>
                        <div class="occurrences-list" id="occurrenceList">
                            <!-- Filled by JS -->
                        </div>
                    </div>

                    <!-- Donut Chart -->
                    <div class="card">
                        <div class="section-header">
                            <h3 class="section-title">Distribuição de EPIs</h3>
                        </div>
                        <div class="chart-container" style="height: 250px;">
                            <canvas id="doughnutChart"></canvas>
                        </div>
                    </div>

                    <!-- Top Infrações (Placeholder) -->
                    <div class="card">
                        <div class="section-header">
                            <h3 class="section-title">Top Ocorrências</h3>
                        </div>
                        <div class="infraction-list" id="topInfractions">
                            <div class="list-item">
                                <span class="occ-name">Placeholder</span>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 50%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Notification Container -->
    <div id="notification-container" class="notification-container"></div>

    <!-- Calendar Modal -->
    <div id="calendarModal" class="modal-calendar">
        <div class="modal-content">
            <div class="calendar-header">
                <button id="prevMonth"><i class="fa-solid fa-chevron-left"></i></button>
                <div class="month-selector">
                    <span id="calMonthDisplay">Janeiro</span>
                    <span id="calYearDisplay">2026</span>
                </div>
                <button id="nextMonth"><i class="fa-solid fa-chevron-right"></i></button>
            </div>
            <ul class="weeks">
                <li>Dom</li><li>Seg</li><li>Ter</li><li>Qua</li><li>Qui</li><li>Sex</li><li>Sáb</li>
            </ul>
            <ul class="days" id="calendarDays"></ul>
            <div class="manual-input">
                <div class="input-wrapper">
                    <input type="text" id="manualDateInput" placeholder="DD/MM/AAAA">
                    <button onclick="commitManualDate()"><i data-lucide="check"></i></button>
                </div>
            </div>
        </div>
    </div>

    <!-- Detail Modal -->
    <div id="detailModal" class="modal">
        <div class="modal-content large">
            <div class="modal-header">
                <h2 id="modalMonthTitle">Detalhes</h2>
                <button class="close-btn" onclick="closeModal()">&times;</button>
            </div>
            <div class="modal-body">
                <table class="custom-table">
                    <thead><tr></tr></thead>
                    <tbody id="modalTableBody"></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL DE SELEÇÃO MINIMALISTA -->
    <div id="courseModal" class="modal-premium">
        <div class="modal-premium-content">
            <div class="modal-premium-header">
                <div>
                    <h2>Selecione o Setor</h2>
                    <p>Filtre os dados do dashboard por área específica</p>
                </div>
                <button class="close-premium" onclick="closeCourseModal()">&times;</button>
            </div>
            <div class="modal-premium-body">
                <table class="minimal-table">
                    <thead>
                        <tr>
                            <th>Setor / Curso</th>
                            <th>Status Ativo</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="course-row global-row" onclick="selectSectorRecord('all', 'Empresa Inteira')">
                            <td>
                                <div class="sector-cell">
                                    <div class="sector-dot global"></div>
                                    <span>Toda a Empresa</span>
                                </div>
                            </td>
                            <td><span class="status-tag">Visão Global</span></td>
                            <td><i data-lucide="arrow-right"></i></td>
                        </tr>
                        <?php 
                            $deptRepo = new \App\Infrastructure\Persistence\MySQLDepartmentRepository();
                            $sectors = $deptRepo->findAll();
                            foreach ($sectors as $sector): 
                        ?>
                            <tr class="course-row" onclick="selectSectorRecord('<?= $sector->getId() ?>', '<?= htmlspecialchars($sector->getName()) ?>')">
                                <td>
                                    <div class="sector-cell">
                                        <div class="sector-dot"></div>
                                        <span><?= htmlspecialchars($sector->getName()) ?></span>
                                    </div>
                                </td>
                                <td><span class="status-tag active">Monitorado</span></td>
                                <td><i data-lucide="chevron-right"></i></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="<?= BASE_PATH ?>/assets/js/dashboard.js"></script>
</body>
</html>
