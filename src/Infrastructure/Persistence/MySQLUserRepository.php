<?php

namespace epiGuard\Infrastructure\Persistence;

use mysqli;
use Exception;

class MySQLUserRepository
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function save(array $userData): bool
    {
        $query = "INSERT INTO usuarios (nome, usuario, senha, cargo, status) VALUES (?, ?, ?, ?, 'ATIVO')";
        $stmt = $this->db->prepare($query);

        if (!$stmt) {
            throw new Exception("Erro ao preparar query: " . $this->db->error);
        }

        $stmt->bind_param(
            "ssss",
            $userData['nome'],
            $userData['usuario'],
            $userData['senha'],
            $userData['cargo']
        );

        $result = $stmt->execute();
        $stmt->close();

        return $result;
    }

    public function findByUsername(string $username): ?array
    {
        $query = "SELECT * FROM usuarios WHERE usuario = ? LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        $stmt->close();
        return $user ?: null;
    }
}
