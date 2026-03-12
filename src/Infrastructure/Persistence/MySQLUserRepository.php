<?php
declare(strict_types=1);

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\User;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\UserRole;
use App\Domain\Repository\UserRepositoryInterface;
use epiGuard\Infrastructure\Database\Connection;
use DateTimeImmutable;

class MySQLUserRepository implements UserRepositoryInterface
{
    private \mysqli $db;

    public function __construct()
    {
        $this->db = Connection::getInstance();
    }

    public function findById(int $id): ?User
    {
        $stmt = $this->db->prepare("SELECT id, nome, usuario, cargo, criado_em, atualizado_em FROM usuarios WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    public function findByEmail(Email $email): ?User
    {
        $stmt = $this->db->prepare("SELECT id, nome, usuario, cargo, criado_em, atualizado_em FROM usuarios WHERE usuario = ?");
        $emailStr = $email->getValue();
        $stmt->bind_param('s', $emailStr);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            return $this->hydrate($row);
        }

        return null;
    }

    /** @return User[] */
    public function findAll(): array
    {
        $result = $this->db->query("SELECT id, nome, usuario, cargo, criado_em, atualizado_em FROM usuarios ORDER BY nome ASC");
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $this->hydrate($row);
        }
        return $users;
    }

    public function save(User $user): void
    {
        // Implementação simplificada para o contexto
    }

    public function update(User $user): void
    {
        // Implementação simplificada
    }

    public function delete(User $user): void
    {
        // Implementação simplificada
    }

    private function hydrate(array $row): User
    {
        return new User(
            name: $row['nome'],
            email: new Email($row['usuario']), // Usando usuario como email
            passwordHash: '',
            role: new UserRole($row['cargo'] === 'SUPER_ADMIN' ? 'ADMIN' : 'USER'),
            id: (int) $row['id'],
            createdAt: new DateTimeImmutable($row['criado_em']),
            updatedAt: $row['atualizado_em'] ? new DateTimeImmutable($row['atualizado_em']) : null
        );
    }
}
