<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
<<<<<<< HEAD
    $mysqli = new mysqli("localhost", "root", "");
=======
    $port = 3308;
    $mysqli = new mysqli("127.0.0.1", "root", "", "epi_guard", $port);
>>>>>>> 5399806b2ad2a0f0a03798f8626547fceabfaeb9
    echo "Conexão bem-sucedida!";
} catch (mysqli_sql_exception $e) {
    echo "Erro: " . $e->getMessage();
}
