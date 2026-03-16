<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $mysqli = new mysqli("localhost", "root", "");
    echo "Conexão bem-sucedida!";
} catch (mysqli_sql_exception $e) {
    echo "Erro: " . $e->getMessage();
}
