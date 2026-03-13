<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>epiGuard - Gestão de Setor</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .setor-header .page-title h1 { font-size: 22px; font-weight: 800; color: #1F2937; }
        .setor-header .page-title p { font-size: 13px; color: #94a3b8; margin-top: 4px; }

        .btn-add-setor {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 10px 22px; background: #E30613; color: #fff;
            border: none; border-radius: 10px; font-size: 13px;
            font-weight: 700; cursor: pointer; font-family: 'Inter', sans-serif;
            transition: 0.2s; box-shadow: 0 4px 14px rgba(227,6,19,0.25);
        }
        .btn-add-setor:hover { background: #c40510; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(227,6,19,0.35); }

        /* Filtros */
        .setor-filters { display: flex; gap: 12px; margin-bottom: 24px; }
        .search-box {
            display: flex; align-items: center; gap: 10px;
            background: #fff; border: 1px solid #e5e7eb; border-radius: 10px;
            padding: 10px 16px; min-width: 280px; transition: 0.2s;
        }
        .search-box:focus-within { border-color: #E30613; box-shadow: 0 0 0 3px rgba(227,6,19,0.08); }
        .search-box i { color: #94a3b8; font-size: 14px; }
        .search-box input { border: none; outline: none; font-size: 13px; font-family: 'Inter', sans-serif; color: #1F2937; width: 100%; background: transparent; }
        .search-box input::placeholder { color: #94a3b8; }
        .setor-filters select { padding: 10px 16px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 13px; font-family: 'Inter', sans-serif; color: #1F2937; background: #fff; cursor: pointer; outline: none; transition: 0.2s; }
        .setor-filters select:focus { border-color: #E30613; box-shadow: 0 0 0 3px rgba(227,6,19,0.08); }

        /* Tabela */
        .setor-table-wrapper { background: #fff; border-radius: 16px; border: 1px solid #f0f0f5; overflow: hidden; }
        .setor-table { width: 100%; border-collapse: collapse; }
        .setor-table thead th { text-align: left; padding: 16px 24px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #94a3b8; border-bottom: 1px solid #f0f0f5; }
        .setor-table tbody tr { transition: background 0.15s; }
        .setor-table tbody tr:hover { background: #fafbfc; }
        .setor-table tbody td { padding: 18px 24px; border-bottom: 1px solid #f5f5f8; vertical-align: middle; }
        .setor-table tbody tr:last-child td { border-bottom: none; }
        .setor-nome { font-size: 14px; font-weight: 700; color: #1F2937; }
        .setor-desc { font-size: 12px; color: #94a3b8; margin-top: 2px; }
        .setor-count { font-size: 15px; font-weight: 700; color: #1F2937; }
        .epi-icons { display: flex; gap: 8px; }
        .epi-icon-badge { width: 30px; height: 30px; border-radius: 8px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-size: 13px; color: #475569; transition: 0.2s; }
        .epi-icon-badge:hover { background: rgba(227,6,19,0.08); color: #E30613; }
        .setor-actions { display: flex; gap: 10px; justify-content: flex-end; align-items: center; }
        .status-indicator { width: 10px; height: 10px; border-radius: 50%; background: #10b981; border: 2px solid #d1fae5; }
        .btn-edit { width: 30px; height: 30px; border-radius: 8px; border: 1px solid #e5e7eb; background: #fff; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #94a3b8; font-size: 12px; transition: 0.2s; }
        .btn-edit:hover { border-color: #E30613; color: #E30613; background: rgba(227,6,19,0.04); }

        /* ============ MODAL ============ */
        .modal-setor-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(15,23,42,0.45); backdrop-filter: blur(4px);
            display: none; justify-content: center; align-items: center; z-index: 9999;
        }
        .modal-setor-overlay.active { display: flex; }

        .modal-setor {
            background: #fff; border-radius: 18px; padding: 32px;
            width: 520px; max-height: 85vh; overflow-y: auto;
            box-shadow: 0 25px 60px rgba(0,0,0,0.2);
            animation: dropIn 0.3s ease;
        }

        @keyframes dropIn { from { opacity: 0; transform: translateY(-30px) scale(0.96); } to { opacity: 1; transform: translateY(0) scale(1); } }

        .modal-setor-header {
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 28px;
        }
        .modal-setor-header h2 { font-size: 18px; font-weight: 800; color: #1F2937; }
        .modal-close-btn { background: none; border: none; font-size: 22px; color: #94a3b8; cursor: pointer; transition: 0.2s; padding: 4px; }
        .modal-close-btn:hover { color: #E30613; }

        /* Form fields */
        .form-group { margin-bottom: 24px; }
        .form-label { display: block; font-size: 13px; font-weight: 700; color: #1F2937; margin-bottom: 8px; }
        .form-input {
            width: 100%; padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 10px;
            font-size: 14px; font-family: 'Inter', sans-serif; color: #1F2937;
            outline: none; transition: 0.2s; background: #fff;
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-input:focus { border-color: #E30613; box-shadow: 0 0 0 3px rgba(227,6,19,0.08); }

        /* Upload area */
        .upload-area {
            border: 2px dashed #e5e7eb; border-radius: 12px; padding: 16px;
            text-align: center; color: #94a3b8; font-size: 13px;
            cursor: pointer; transition: 0.2s; font-weight: 600;
            display: flex; align-items: center; justify-content: center; gap: 10px;
        }
        .upload-area:hover { border-color: #E30613; color: #E30613; background: rgba(227,6,19,0.02); }
        .upload-area i { font-size: 16px; }

        /* EPIs grid */
        .epi-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .epi-card {
            display: flex; align-items: center; gap: 12px;
            padding: 14px 16px; border: 1px solid #e5e7eb; border-radius: 12px;
            cursor: pointer; transition: 0.2s; background: #fff;
        }
        .epi-card:hover { border-color: #E30613; background: rgba(227,6,19,0.02); }
        .epi-card.selected { border-color: #E30613; background: rgba(227,6,19,0.06); }
        .epi-card-icon { width: 36px; height: 36px; background: #f1f5f9; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 16px; color: #475569; }
        .epi-card.selected .epi-card-icon { background: rgba(227,6,19,0.1); color: #E30613; }
        .epi-card-info .epi-card-name { font-size: 13px; font-weight: 700; color: #1F2937; }
        .epi-card-info .epi-card-brands { font-size: 11px; color: #94a3b8; }

        /* Footer */
        .modal-setor-footer {
            display: flex; justify-content: flex-end; gap: 12px;
            margin-top: 28px; padding-top: 20px; border-top: 1px solid #f0f0f5;
        }
        .btn-cancel { background: none; border: none; color: #64748b; font-size: 13px; font-weight: 600; cursor: pointer; padding: 10px 20px; transition: 0.2s; font-family: 'Inter', sans-serif; }
        .btn-cancel:hover { color: #1F2937; }
        .btn-create {
            padding: 10px 24px; background: #E30613; color: #fff; border: none;
            border-radius: 10px; font-size: 13px; font-weight: 700;
            cursor: pointer; font-family: 'Inter', sans-serif; transition: 0.2s;
        }
        .btn-create:hover { background: #c40510; }
        .btn-create:disabled { background: #ccc; cursor: not-allowed; }
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
                        <input type="text" placeholder="Pesquisar setores...">
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
                            <tr>
                                <td>
                                    <div class="setor-nome">Soldagem TIG</div>
                                    <div class="setor-desc">Área de soldagem pesada</div>
                                </td>
                                <td><span class="setor-count">12</span></td>
                                <td>
                                    <div class="epi-icons">
                                        <span class="epi-icon-badge" title="Óculos"><i class="fa-solid fa-glasses"></i></span>
                                        <span class="epi-icon-badge" title="Luvas"><i class="fa-solid fa-mitten"></i></span>
                                        <span class="epi-icon-badge" title="Capacete"><i class="fa-solid fa-hard-hat"></i></span>
                                        <span class="epi-icon-badge" title="Protetor Auricular"><i class="fa-solid fa-head-side-virus"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="setor-actions">
                                        <span class="status-indicator" title="Ativo"></span>
                                        <button class="btn-edit" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="setor-nome">Pintura Automotiva</div>
                                    <div class="setor-desc">Cabine de pintura spray</div>
                                </td>
                                <td><span class="setor-count">8</span></td>
                                <td>
                                    <div class="epi-icons">
                                        <span class="epi-icon-badge" title="Luvas"><i class="fa-solid fa-mitten"></i></span>
                                        <span class="epi-icon-badge" title="Máscara"><i class="fa-solid fa-mask-face"></i></span>
                                        <span class="epi-icon-badge" title="Capacete"><i class="fa-solid fa-hard-hat"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="setor-actions">
                                        <span class="status-indicator" title="Ativo"></span>
                                        <button class="btn-edit" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="setor-nome">Usinagem CNC</div>
                                    <div class="setor-desc">Tornos e fresas CNC</div>
                                </td>
                                <td><span class="setor-count">15</span></td>
                                <td>
                                    <div class="epi-icons">
                                        <span class="epi-icon-badge" title="Máscara"><i class="fa-solid fa-mask-face"></i></span>
                                        <span class="epi-icon-badge" title="Protetor Auricular"><i class="fa-solid fa-head-side-virus"></i></span>
                                        <span class="epi-icon-badge" title="Capacete"><i class="fa-solid fa-hard-hat"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="setor-actions">
                                        <span class="status-indicator" title="Ativo"></span>
                                        <button class="btn-edit" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="setor-nome">Almoxarifado</div>
                                    <div class="setor-desc">Gestão e entrega de materiais</div>
                                </td>
                                <td><span class="setor-count">5</span></td>
                                <td>
                                    <div class="epi-icons">
                                        <span class="epi-icon-badge" title="Capacete"><i class="fa-solid fa-hard-hat"></i></span>
                                        <span class="epi-icon-badge" title="Luvas"><i class="fa-solid fa-mitten"></i></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="setor-actions">
                                        <span class="status-indicator" title="Ativo"></span>
                                        <button class="btn-edit" title="Editar"><i class="fa-solid fa-pen"></i></button>
                                    </div>
                                </td>
                            </tr>
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

        // --- Modal ---
        function openModal() {
            document.getElementById('modalSetor').classList.add('active');
        }

        function closeModal() {
            document.getElementById('modalSetor').classList.remove('active');
            // Reset
            document.getElementById('inputNomeSetor').value = '';
            document.querySelectorAll('.epi-card.selected').forEach(c => c.classList.remove('selected'));
        }

        // Fechar ao clicar fora
        document.getElementById('modalSetor').addEventListener('click', function(e) {
            if (e.target === this) closeModal();
        });

        // --- EPI Toggle ---
        function toggleEpi(card) {
            card.classList.toggle('selected');
        }

        // --- Criar Setor (Clean Architecture: View → API Controller → Repository) ---
        async function criarSetor() {
            const nome = document.getElementById('inputNomeSetor').value.trim();
            if (!nome) {
                document.getElementById('inputNomeSetor').style.borderColor = '#E30613';
                document.getElementById('inputNomeSetor').focus();
                return;
            }

            // Coletar EPIs selecionados
            const episSelecionados = [];
            document.querySelectorAll('.epi-card.selected').forEach(card => {
                episSelecionados.push(card.getAttribute('data-epi'));
            });

            const btn = document.getElementById('btnCriarSetor');
            btn.disabled = true;
            btn.textContent = 'Criando...';

            try {
                const response = await fetch(`${BASE_PATH}/api/departments/create`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        nome: nome,
                        sigla: '',
                        epis: episSelecionados
                    })
                });

                const result = await response.json();

                if (result.success) {
                    // Adicionar na tabela
                    const tbody = document.getElementById('setoresTableBody');
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>
                            <div class="setor-nome">${result.data.nome}</div>
                            <div class="setor-desc">Novo setor</div>
                        </td>
                        <td><span class="setor-count">0</span></td>
                        <td>
                            <div class="epi-icons">
                                ${episSelecionados.map(epi => `<span class="epi-icon-badge"><i class="fa-solid fa-shield"></i></span>`).join('')}
                            </div>
                        </td>
                        <td>
                            <div class="setor-actions">
                                <span class="status-indicator" title="Ativo"></span>
                                <button class="btn-edit" title="Editar"><i class="fa-solid fa-pen"></i></button>
                            </div>
                        </td>
                    `;
                    tbody.appendChild(tr);
                    closeModal();
                } else {
                    alert(result.error || 'Erro ao criar setor.');
                }
            } catch (err) {
                alert('Erro de conexão: ' + err.message);
            } finally {
                btn.disabled = false;
                btn.textContent = 'Criar Setor';
            }
        }
    </script>
    <script>lucide.createIcons();</script>

</body>
</html>
