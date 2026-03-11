<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Department;
use App\Domain\Repository\DepartmentRepositoryInterface;
use epiGuard\Infrastructure\Database\Connection;
use DateTimeImmutable;

class MySQLDepartmentRepository implements DepartmentRepositoryInterface
{
    private \mysqli $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): ?Department
    {
        $stmt = $this->db->prepare("SELECT id, nome, sigla, status, criado_em, atualizado_em FROM setores WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    public function findByCode(string $code): ?Department
    {
        $stmt = $this->db->prepare("SELECT id, nome, sigla, status, criado_em, atualizado_em FROM setores WHERE sigla = ?");
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    /** @return Department[] */
    public function findAll(): array
    {
        $result = $this->db->query("SELECT id, nome, sigla, status, criado_em, atualizado_em FROM setores ORDER BY nome ASC");
        $departments = [];

        while ($row = $result->fetch_assoc()) {
            $departments[] = $this->hydrate($row);
        }

        return $departments;
    }

    public function save(Department $department): void
    {
        $stmt = $this->db->prepare("INSERT INTO setores (nome, sigla) VALUES (?, ?)");
        $nome = $department->getName();
        $sigla = $department->getCode();
        $stmt->bind_param('ss', $nome, $sigla);
        $stmt->execute();

        $department->setId($this->db->insert_id);
    }

    public function update(Department $department): void
    {
        $stmt = $this->db->prepare("UPDATE setores SET nome = ?, sigla = ? WHERE id = ?");
        $nome = $department->getName();
        $sigla = $department->getCode();
        $id = $department->getId();
        $stmt->bind_param('ssi', $nome, $sigla, $id);
        $stmt->execute();
    }

    public function delete(Department $department): void
    {
        $stmt = $this->db->prepare("DELETE FROM setores WHERE id = ?");
        $id = $department->getId();
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }

    private function hydrate(array $row): Department
    {
        return new Department(
            name: $row['nome'],
            code: $row['sigla'] ?? '',
            id: (int) $row['id'],
            createdAt: new DateTimeImmutable($row['criado_em']),
            updatedAt: $row['atualizado_em'] ? new DateTimeImmutable($row['atualizado_em']) : null
        );
    }
}
