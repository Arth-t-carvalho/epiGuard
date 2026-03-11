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
            // Em um ambiente real, carregaríamos do .env.
            // Usando padrões comuns do XAMPP
            $host = 'localhost';
            $user = 'root';
            $pass = '';
            $db   = 'epi_guard';

            self::$instance = new mysqli($host, $user, $pass, $db);

            if (self::$instance->connect_error) {
                throw new Exception("Falha na conexão MySQLi: " . self::$instance->connect_error);
            }

            self::$instance->set_charset("utf8mb4");
        }

        return self::$instance;
    }
}
