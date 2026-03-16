<?php

namespace epiGuard\Infrastructure\Database;

use mysqli;
use Exception;

class Connection
{
    private static ?mysqli $instance = null;

    public static function getInstance(): mysqli
    {
        if (self::$instance === null) {
            // Tenta carregar do ambiente ou usa padrões do XAMPP
            $host = getenv('DB_HOST') ?: '127.0.0.1';
            $user = getenv('DB_USER') ?: 'root';
            $pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : '';
            $port = getenv('DB_PORT') ?: '3308'; // Porta atualizada para 3308
            $db = getenv('DB_NAME') ?: 'epi_guard';

            self::$instance = new mysqli($host, $user, $pass, $db, $port);

            if (self::$instance->connect_error) {
                throw new Exception("Falha na conexão MySQLi: " . self::$instance->connect_error);
            }

            self::$instance->set_charset("utf8mb4");
        }

        return self::$instance;
    }
}
