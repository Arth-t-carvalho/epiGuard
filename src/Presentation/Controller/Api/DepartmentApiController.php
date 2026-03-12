<?php

namespace epiGuard\Presentation\Controller\Api;

use App\Infrastructure\Persistence\MySQLDepartmentRepository;
use App\Domain\Entity\Department;

class DepartmentApiController
{
    /**
     * GET /api/departments — Lista todos os setores
     */
    public function index(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $repo = new MySQLDepartmentRepository();
            $departments = $repo->findAll();

            $data = array_map(function (Department $dept) {
                return [
                    'id'    => $dept->getId(),
                    'nome'  => $dept->getName(),
                    'sigla' => $dept->getCode(),
                ];
            }, $departments);

            echo json_encode(['success' => true, 'data' => $data]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * POST /api/departments/create — Cria um novo setor
     */
    public function create(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $input = json_decode(file_get_contents('php://input'), true);

            // Validação
            if (empty($input['nome'])) {
                http_response_code(422);
                echo json_encode(['success' => false, 'error' => 'O nome do setor é obrigatório.']);
                return;
            }

            $nome = trim($input['nome']);
            $sigla = trim($input['sigla'] ?? '');

            $repo = new MySQLDepartmentRepository();

            // Verificar duplicata por sigla
            if (!empty($sigla) && $repo->findByCode($sigla)) {
                http_response_code(409);
                echo json_encode(['success' => false, 'error' => 'Já existe um setor com essa sigla.']);
                return;
            }

            $department = new Department(
                name: $nome,
                code: $sigla
            );

            $repo->save($department);

            echo json_encode([
                'success' => true,
                'data' => [
                    'id'    => $department->getId(),
                    'nome'  => $department->getName(),
                    'sigla' => $department->getCode(),
                ]
            ]);
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }
}
