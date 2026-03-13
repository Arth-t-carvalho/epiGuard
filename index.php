<?php

/**
 * Ponto de entrada principal do epiGuard
 * Movido para a raiz para facilitar o acesso, mantendo a organização Clean Architecture internamente.
 */

/**
 * Autoloader manual PSR-4 (Substitui o Composer caso não esteja instalado)
 */
spl_autoload_register(function ($class) {
    $prefix = 'epiGuard\\';
    $base_dir = __DIR__ . '/src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) return;
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) require $file;
});

// Carregar configurações
$config = require_once __DIR__ . '/config/app.php';

// Roteamento
$routes = require_once __DIR__ . '/config/routes.php';

$uri = $_SERVER['REQUEST_URI'] ?? '/';

// Detectar o basePath automaticamente
$scriptName = $_SERVER['SCRIPT_NAME'];
$basePath = str_replace('\\', '/', dirname($scriptName));
if ($basePath === '/') {
    $basePath = '';
}

define('BASE_PATH', $basePath);

// Remover o basePath da URI para obter o caminho da rota
$path = parse_url($uri, PHP_URL_PATH);

// Remove query strings
$path = explode('?', $path)[0];

if ($basePath !== '' && strpos($path, $basePath) === 0) {
    $path = substr($path, strlen($basePath));
}

// Remove o '/index.php' caso presente
if (strpos($path, '/index.php') === 0) {
    $path = substr($path, strlen('/index.php'));
}

if ($path === '' || $path === '/') $path = '/login';

if (isset($routes[$path])) {
    [$controllerClass, $method] = $routes[$path];
    $controller = new $controllerClass();
    $controller->$method();
} else {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 - Página não encontrada</h1>";
    echo "<p>Caminho requisitado: " . htmlspecialchars($path) . "</p>";
}
