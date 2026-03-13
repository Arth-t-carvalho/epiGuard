<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Gestão de Setor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Bibliotecas de Processamento de Arquivos -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>
    <script>pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.worker.min.js';</script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/sidebar.css">
    <link rel="stylesheet" href="<?= BASE_PATH ?>/assets/css/dashboard.css">
    <style>
        /* === PAGE STYLES === */
        .setor-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        .setor-header .page-title h1 {
            font-size: 22px;
            font-weight: 800;
            color: #1F2937;
        }

        .setor-header .page-title p {
            font-size: 13px;
            color: #94a3b8;
            margin-top: 4px;
        }

        .btn-add-setor {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            background: #E30613;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: 0.2s;
            box-shadow: 0 4px 14px rgba(227, 6, 19, 0.25);
        }

        .btn-add-setor:hover {
            background: #c40510;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(227, 6, 19, 0.35);
        }

        /* Filtros */
        .setor-filters {
            display: flex;
            gap: 12px;
            margin-bottom: 24px;
        }

        .search-box {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            padding: 10px 16px;
            min-width: 280px;
            transition: 0.2s;
        }

        .search-box:focus-within {
            border-color: #E30613;
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.08);
        }

        .search-box i {
            color: #94a3b8;
            font-size: 14px;
        }

        .search-box input {
            border: none;
            outline: none;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            color: #1F2937;
            width: 100%;
            background: transparent;
        }

        .search-box input::placeholder {
            color: #94a3b8;
        }

        .setor-filters select {
            padding: 10px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 13px;
            font-family: 'Inter', sans-serif;
            color: #1F2937;
            background: #fff;
            cursor: pointer;
            outline: none;
            transition: 0.2s;
        }

        .setor-filters select:focus {
            border-color: #E30613;
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.08);
        }

        /* Tabela */
        .setor-table-wrapper {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f0f5;
            overflow: hidden;
        }

        .setor-table {
            width: 100%;
            border-collapse: collapse;
        }

        .setor-table thead th {
            text-align: left;
            padding: 16px 24px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            border-bottom: 1px solid #f0f0f5;
        }

        .setor-table tbody tr {
            transition: background 0.15s;
        }

        .setor-table tbody tr:hover {
            background: #fafbfc;
        }

        .setor-table tbody td {
            padding: 18px 24px;
            border-bottom: 1px solid #f5f5f8;
            vertical-align: middle;
        }

        .setor-table tbody tr:last-child td {
            border-bottom: none;
        }

        .setor-nome {
            font-size: 14px;
            font-weight: 700;
            color: #1F2937;
        }

        .setor-desc {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .setor-count {
            font-size: 15px;
            font-weight: 700;
            color: #1F2937;
        }

        .epi-icons {
            display: flex;
            gap: 8px;
        }

        .epi-icon-badge {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: #475569;
            transition: 0.2s;
        }

        .epi-icon-badge:hover {
            background: rgba(227, 6, 19, 0.08);
            color: #E30613;
        }

        .setor-actions {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            align-items: center;
        }

        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #10b981;
            border: 2px solid #d1fae5;
        }

        .btn-edit {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #94a3b8;
            font-size: 12px;
            transition: 0.2s;
        }

        .btn-edit:hover {
            border-color: #E30613;
            color: #E30613;
            background: rgba(227, 6, 19, 0.04);
        }

        .btn-delete {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid #fee2e2;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: #ef4444;
            font-size: 12px;
            transition: 0.2s;
        }

        .btn-delete:hover {
            border-color: #ef4444;
            background: #fef2f2;
        }

        /* ============ MODAL ============ */
        .modal-setor-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(4px);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .modal-setor-overlay.active {
            display: flex;
        }

        .modal-setor {
            background: #fff;
            border-radius: 18px;
            padding: 32px;
            width: 520px;
            max-height: 85vh;
            overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
            animation: dropIn 0.3s ease;
        }

        @keyframes dropIn {
            from {
                opacity: 0;
                transform: translateY(-30px) scale(0.96);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-setor-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .modal-setor-header h2 {
            font-size: 18px;
            font-weight: 800;
            color: #1F2937;
        }

        .modal-close-btn {
            background: none;
            border: none;
            font-size: 22px;
            color: #94a3b8;
            cursor: pointer;
            transition: 0.2s;
            padding: 4px;
        }

        .modal-close-btn:hover {
            color: #E30613;
        }

        /* Form fields */
        .form-group {
            margin-bottom: 24px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 700;
            color: #1F2937;
            margin-bottom: 8px;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #1F2937;
            outline: none;
            transition: 0.2s;
            background: #fff;
        }

        .form-input::placeholder {
            color: #94a3b8;
        }

        .form-input:focus {
            border-color: #E30613;
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.08);
        }

        /* Upload area */
        .upload-area {
            border: 2px dashed #e5e7eb;
            border-radius: 12px;
            padding: 16px;
            text-align: center;
            color: #94a3b8;
            font-size: 13px;
            cursor: pointer;
            transition: 0.2s;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .upload-area:hover {
            border-color: #E30613;
            color: #E30613;
            background: rgba(227, 6, 19, 0.02);
        }

        .upload-area i {
            font-size: 16px;
        }

        /* EPIs grid */
        .epi-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .epi-card {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.2s;
            background: #fff;
        }

        .epi-card:hover {
            border-color: #E30613;
            background: rgba(227, 6, 19, 0.02);
        }

        .epi-card.selected {
            border-color: #E30613;
            background: rgba(227, 6, 19, 0.06);
        }

        .epi-card-icon {
            width: 36px;
            height: 36px;
            background: #f1f5f9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            color: #475569;
        }

        .epi-card.selected .epi-card-icon {
            background: rgba(227, 6, 19, 0.1);
            color: #E30613;
        }

        .epi-card-info .epi-card-name {
            font-size: 13px;
            font-weight: 700;
            color: #1F2937;
        }

        .epi-card-info .epi-card-brands {
            font-size: 11px;
            color: #94a3b8;
        }

        /* Footer */
        .modal-setor-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f5;
        }

        .btn-cancel {
            background: none;
            border: none;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            padding: 10px 20px;
            transition: 0.2s;
            font-family: 'Inter', sans-serif;
        }

        .btn-cancel:hover {
            color: #1F2937;
        }

        .btn-create {
            padding: 10px 24px;
            background: #E30613;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
            transition: 0.2s;
        }

        .btn-create:hover {
            background: #c40510;
        }

        .btn-create:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body>

    <div class="app-wrapper">
        <?php include __DIR__ . '/../layout/sidebar.php'; ?>

        <main class="main-content">
            <div id="page-content-wrapper" class="content-fade">
                <!-- Header -->
                <div class="setor-header">
                    <div class="page-title">
                        <h1>Gestão de Setor</h1>
                        <p>Gerencie as áreas e os respectivos EPIs obrigatórios</p>
                    </div>
                    <button class="btn-add-setor" onclick="openModal()">
                        <i class="fa-solid fa-plus"></i> Adicionar Setor
                    </button>
                </div>

                <!-- Filtros -->
                <div class="setor-filters">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" id="searchInputSettings" placeholder="Pesquisar setores..." oninput="filterSetores()">
                    </div>
                    <select>
                        <option>Filtrar Setores (Todos)</option>
                        <option value="ativo">Ativos</option>
                        <option value="inativo">Inativos</option>
                    </select>
                </div>

                <!-- Tabela -->
                <div class="setor-table-wrapper">
                    <table class="setor-table">
                        <thead>
                            <tr>
                                <th>Nome do Setor</th>
                                <th>Funcionários Ativos</th>
                                <th>EPIs Obrigatórios</th>
                                <th style="text-align: right;">Ações</th>
                            </tr>
                        </thead>
                        <tbody id="setoresTableBody">
                            <?php if (empty($setores)): ?>
                                <tr>
                                    <td colspan="4" style="text-align: center; padding: 40px; color: #94a3b8;">
                                        <i class="fa-solid fa-folder-open" style="font-size: 24px; display: block; margin-bottom: 10px; opacity: 0.5;"></i>
                                        Nenhum setor encontrado no banco de dados.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($setores as $setor): ?>
                                    <tr>
                                        <td>
                                            <div class="setor-nome"><?= htmlspecialchars($setor['nome']) ?></div>
                                            <div class="setor-desc"><?= htmlspecialchars($setor['sigla'] ?: 'Sem sigla') ?></div>
                                        </td>
                                        <td><span class="setor-count"><?= $setor['total_funcionarios'] ?></span></td>
                                        <td>
                                            <div class="epi-icons">
                                                <?php 
                                                $epiIconsMap = [
                                                    'capacete' => 'fa-hard-hat',
                                                    'avental' => 'fa-shirt',
                                                    'jaqueta' => 'fa-vest-patches',
                                                    'oculos' => 'fa-glasses',
                                                    'luvas' => 'fa-mitten',
                                                    'mascara' => 'fa-mask-face',
                                                    'protetor_auricular' => 'fa-head-side-virus'
                                                ];
                                                
                                                $episSetor = [];
                                                if (!empty($setor['epis_json'])) {
                                                    $episSetor = json_decode($setor['epis_json'], true) ?: [];
                                                }

                                                if (empty($episSetor)): ?>
                                                    <span class="epi-icon-badge" title="Nenhum EPI" style="opacity: 0.3;"><i class="fa-solid fa-shield-slash"></i></span>
                                                <?php else:
                                                    foreach ($episSetor as $epiSlug): 
                                                        $iconClass = $epiIconsMap[$epiSlug] ?? 'fa-shield';
                                                        $label = ucfirst(str_replace('_', ' ', $epiSlug));
                                                ?>
                                                        <span class="epi-icon-badge" title="<?= $label ?>" data-epi="<?= $epiSlug ?>"><i class="fa-solid <?= $iconClass ?>"></i></span>
                                                <?php 
                                                    endforeach;
                                                endif; 
                                                ?>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="setor-actions">
                                                <span class="status-indicator" title="<?= $setor['status'] === 'ATIVO' ? 'Ativo' : 'Inativo' ?>" style="background: <?= $setor['status'] === 'ATIVO' ? '#10b981' : '#ef4444' ?>;"></span>
                                                <button class="btn-edit" title="Editar" onclick="editSetor(this)" data-id="<?= $setor['id'] ?>"><i class="fa-solid fa-pen"></i></button>
                                                <button class="btn-delete" title="Excluir" onclick="deleteSetor(this)" data-id="<?= $setor['id'] ?>"><i class="fa-solid fa-trash"></i></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        </main>
    </div>

    <!-- ==================== MODAL ADICIONAR SETOR ==================== -->
    <div class="modal-setor-overlay" id="modalSetor">
        <div class="modal-setor">
            <div class="modal-setor-header">
                <h2>Adicionar Setor</h2>
                <button class="modal-close-btn" onclick="closeModal()">&times;</button>
            </div>

            <!-- Nome do Setor -->
            <div class="form-group">
                <label class="form-label">Nome do Setor</label>
                <input class="form-input" type="text" id="inputNomeSetor" placeholder="Ex: Soldagem TIG">
            </div>

            <!-- Funcionários -->
            <div class="form-group">
                <label class="form-label">Funcionários</label>
                <div class="upload-area" onclick="document.getElementById('fileUpload').click()">
                    <i class="fa-solid fa-file-arrow-up"></i>
                    Adicionar funcionários via Excel / PDF
                </div>
                <input type="file" id="fileUpload" accept=".xlsx,.xls,.pdf,.csv" style="display: none;">
                <div id="uploadFeedback" style="margin-top: 8px; font-size: 13px; color: #10b981; display: none;">
                    <i class="fa-solid fa-check-circle"></i> <span id="uploadCount">0</span> funcionários carregados.
                </div>
            </div>

            <!-- EPIs Obrigatórios -->
            <div class="form-group">
                <label class="form-label">EPIs Obrigatórios (Marcas Permitidas)</label>
                <div class="epi-grid" id="epiGrid">
                    <div class="epi-card" onclick="toggleEpi(this)" data-epi="capacete">
                        <div class="epi-card-icon"><i class="fa-solid fa-hard-hat"></i></div>
                        <div class="epi-card-info">
                            <div class="epi-card-name">Capacete de Proteção</div>
                            <div class="epi-card-brands">3M, MSA</div>
                        </div>
                    </div>
                    <div class="epi-card" onclick="toggleEpi(this)" data-epi="avental">
                        <div class="epi-card-icon"><i class="fa-solid fa-shirt"></i></div>
                        <div class="epi-card-info">
                            <div class="epi-card-name">Avental</div>
                            <div class="epi-card-brands">Vivel, PVC</div>
                        </div>
                    </div>
                    <div class="epi-card" onclick="toggleEpi(this)" data-epi="jaqueta">
                        <div class="epi-card-icon"><i class="fa-solid fa-vest-patches"></i></div>
                        <div class="epi-card-info">
                            <div class="epi-card-name">Jaqueta</div>
                            <div class="epi-card-brands">Térmica, Impermeável</div>
                        </div>
                    </div>
                    <div class="epi-card" onclick="toggleEpi(this)" data-epi="oculos">
                        <div class="epi-card-icon"><i class="fa-solid fa-glasses"></i></div>
                        <div class="epi-card-info">
                            <div class="epi-card-name">Óculos de Proteção</div>
                            <div class="epi-card-brands">3M, Danny</div>
                        </div>
                    </div>
                    <div class="epi-card" onclick="toggleEpi(this)" data-epi="luvas">
                        <div class="epi-card-icon"><i class="fa-solid fa-mitten"></i></div>
                        <div class="epi-card-info">
                            <div class="epi-card-name">Luvas de Raspa</div>
                            <div class="epi-card-brands">Marluvas, Volk</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="modal-setor-footer">
                <button class="btn-cancel" onclick="closeModal()">Cancelar</button>
                <button class="btn-create" id="btnCriarSetor" onclick="criarSetor()">Criar Setor</button>
            </div>
        </div>
    </div>

    <script>
        const BASE_PATH = '<?= BASE_PATH ?>';
        let editingRow = null;
        let currentSectorId = null; // Armazena o ID do setor sendo editado
        let importedEmployees = []; // Armazena nomes extraídos do arquivo

        // --- File Upload Handling ---
        document.getElementById('fileUpload').addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (!file) return;

            importedEmployees = [];
            const feedback = document.getElementById('uploadFeedback');
            const countSpan = document.getElementById('uploadCount');

            try {
                if (file.name.endsWith('.xlsx') || file.name.endsWith('.xls') || file.name.endsWith('.csv')) {
                    await parseExcel(file);
                } else if (file.name.endsWith('.pdf')) {
                    await parsePDF(file);
                }

                if (importedEmployees.length > 0) {
                    feedback.style.display = 'block';
                    countSpan.textContent = importedEmployees.length;
                } else {
                    alert('Nenhum funcionário encontrado no arquivo. Verifique a estrutura.');
                    feedback.style.display = 'none';
                }
            } catch (err) {
                console.error(err);
                alert('Erro ao processar arquivo: ' + err.message);
            }
        });

        async function parseExcel(file) {
            return new Promise((resolve, reject) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    try {
                        const data = new Uint8Array(e.target.result);
                        const workbook = XLSX.read(data, { type: 'array' });
                        const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
                        const rows = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });
                        
                        // Extrair nomes (assume que a primeira coluna ou qualquer coluna com texto pode ser um nome)
                        rows.forEach(row => {
                            if (row[0] && typeof row[0] === 'string' && row[0].trim().length > 2) {
                                importedEmployees.push(row[0].trim());
                            }
                        });
                        resolve();
                    } catch (err) { reject(err); }
                };
                reader.onerror = reject;
                reader.readAsArrayBuffer(file);
            });
        }

        async function parsePDF(file) {
            const arrayBuffer = await file.arrayBuffer();
            const pdf = await pdfjsLib.getDocument({ data: arrayBuffer }).promise;
            
            for (let i = 1; i <= pdf.numPages; i++) {
                const page = await pdf.getPage(i);
                const textContent = await page.getTextContent();
                const strings = textContent.items.map(item => item.str.trim()).filter(s => s.length > 2);
                
                // Lógica simples: cada string considerável é tratada como um potencial nome
                // Isso pode ser refinado dependendo do formato do PDF do usuário
                importedEmployees.push(...strings);
            }
            // Remover duplicatas básicas
            importedEmployees = [...new Set(importedEmployees)];
        }

        // --- Modal ---
        function openModal(isEdit = false, row = null) {
            const modal = document.getElementById('modalSetor');
            const title = modal.querySelector('.modal-setor-header h2');
            const btn = document.getElementById('btnCriarSetor');

            modal.classList.add('active');

            if (isEdit && row) {
                editingRow = row;
                currentSectorId = row.querySelector('.btn-edit').getAttribute('data-id');
                title.textContent = 'Editar Setor';
                btn.textContent = 'Salvar Alterações';

                // Preencher campos
                const nome = row.querySelector('.setor-nome').textContent;
                document.getElementById('inputNomeSetor').value = nome;

                // Marcar EPIs
                const rowEpis = row.querySelectorAll('.epi-icon-badge');
                rowEpis.forEach(badge => {
                    const epiSlug = badge.getAttribute('data-epi');
                    const epiCard = document.querySelector(`.epi-card[data-epi="${epiSlug}"]`);
                    if (epiCard) epiCard.classList.add('selected');
                });
            } else {
                editingRow = null;
                title.textContent = 'Adicionar Setor';
                btn.textContent = 'Criar Setor';
                // Reset já acontece no closeModal
            }
        }

        function closeModal() {
            document.getElementById('modalSetor').classList.remove('active');
            // Reset fields
            document.getElementById('inputNomeSetor').value = '';
            document.querySelectorAll('.epi-card.selected').forEach(c => c.classList.remove('selected'));
            
            // Reset upload feedback
            importedEmployees = [];
            document.getElementById('fileUpload').value = '';
            document.getElementById('uploadFeedback').style.display = 'none';
            
            editingRow = null;
            currentSectorId = null;
        }

        function editSetor(btn) {
            const row = btn.closest('tr');
            openModal(true, row);
        }

        async function deleteSetor(btn) {
            const row = btn.closest('tr');
            const sectorId = btn.getAttribute('data-id');

            if (!sectorId) {
                // Se não tiver ID (linha estática ou recém-criada sem recarregar), removemos apenas da tela
                if (confirm('Tem certeza que deseja remover este setor da visualização?')) {
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(20px)';
                    setTimeout(() => row.remove(), 300);
                }
                return;
            }

            if (confirm('Tem certeza que deseja excluir permanentemente este setor do banco de dados?')) {
                try {
                    btn.disabled = true;
                    const response = await fetch(`${BASE_PATH}/api/departments/delete`, {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({ id: sectorId })
                    });

                    const result = await response.json();

                    if (result.success) {
                        row.style.opacity = '0';
                        row.style.transform = 'translateX(20px)';
                        setTimeout(() => row.remove(), 300);
                    } else {
                        alert(result.error || 'Erro ao excluir setor do banco.');
                    }
                } catch (err) {
                    alert('Erro de conexão: ' + err.message);
                } finally {
                    btn.disabled = false;
                }
            }
        }

        // Fechar ao clicar fora
        document.getElementById('modalSetor').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // --- EPI Toggle ---
        function toggleEpi(card) {
            card.classList.toggle('selected');
        }

        // --- Criar/Editar Setor ---
        async function criarSetor() {
            const nome = document.getElementById('inputNomeSetor').value.trim();
            if (!nome) {
                document.getElementById('inputNomeSetor').style.borderColor = '#E30613';
                document.getElementById('inputNomeSetor').focus();
                return;
            }

            const btn = document.getElementById('btnCriarSetor');
            const isEditing = editingRow !== null;
            
            try {
                btn.disabled = true;
                btn.textContent = 'Processando...';

                // Coletar EPIs selecionados
                const selectedEpis = Array.from(document.querySelectorAll('.epi-card.selected'))
                    .map(card => card.getAttribute('data-epi'));

                const payload = {
                    nome: nome,
                    sigla: '', // Opcional, mantendo vazio por enquanto
                    epis: selectedEpis,
                    funcionarios: importedEmployees // Enviar lista extraída
                };

                if (isEditing && currentSectorId) {
                    payload.id = currentSectorId;
                }

                const url = isEditing 
                    ? `${BASE_PATH}/api/departments/update` 
                    : `${BASE_PATH}/api/departments/create`;

                const response = await fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();

                if (result.success) {
                    // Recarregar a página para mostrar os novos dados e contagens reais
                    location.reload();
                } else {
                    alert(result.error || 'Erro ao processar setor.');
                }
            } catch (err) {
                alert('Erro de conexão: ' + err.message);
            } finally {
                btn.disabled = false;
                btn.textContent = isEditing ? 'Salvar Alterações' : 'Criar Setor';
            }
        }

        // --- Live Search ---
        function filterSetores() {
            const searchText = document.getElementById('searchInputSettings').value.toLowerCase();
            const tableBody = document.getElementById('setoresTableBody');
            const rows = tableBody.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const row = rows[i];
                const nomeContainer = row.querySelector('.setor-nome');
                const descContainer = row.querySelector('.setor-desc');

                if (!nomeContainer) continue;

                const nome = nomeContainer.textContent.toLowerCase();
                const desc = descContainer ? descContainer.textContent.toLowerCase() : '';

                if (nome.includes(searchText) || desc.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }
    </script>
    <script>
        lucide.createIcons();
    </script>

</body>

</html>
