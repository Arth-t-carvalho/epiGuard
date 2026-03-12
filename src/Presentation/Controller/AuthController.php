<?php

namespace epiGuard\Presentation\Controller;

use epiGuard\Infrastructure\Database\Connection;
use epiGuard\Infrastructure\Persistence\MySQLUserRepository;

class AuthController
{
    private MySQLUserRepository $userRepository;

    public function __construct()
    {
        $db = Connection::getInstance();
        $this->userRepository = new MySQLUserRepository($db);
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->login();
            return;
        }
        require_once __DIR__ . '/../View/auth/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->handleRegister();
            return;
        }
        require_once __DIR__ . '/../View/auth/register.php';
    }

    private function handleRegister()
    {
        $nome = $_POST['nome'] ?? '';
        $usuario = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';
        $cargo = $_POST['cargo'] ?? 'SUPERVISOR'; // Padrão

        if (empty($nome) || empty($usuario) || empty($senha)) {
            $_SESSION['error'] = "Todos os campos são obrigatórios.";
            header("Location: " . BASE_PATH . "/register");
            exit;
        }

        // Criptografar senha
        $hashedPassword = password_hash($senha, PASSWORD_BCRYPT);

        $userData = [
            'nome' => $nome,
            'usuario' => $usuario,
            'senha' => $hashedPassword,
            'cargo' => $cargo
        ];

        try {
            if ($this->userRepository->save($userData)) {
                $_SESSION['success'] = "Cadastro realizado com sucesso! Faça login.";
                header("Location: " . BASE_PATH . "/login");
                exit;
            }
        } catch (\Exception $e) {
            $_SESSION['error'] = "Erro ao cadastrar: " . $e->getMessage();
            header("Location: " . BASE_PATH . "/register");
            exit;
        }
    }

    private function login()
    {
        $usuario = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if (empty($usuario) || empty($senha)) {
            $_SESSION['error'] = "Usuário e senha são obrigatórios.";
            header("Location: " . BASE_PATH . "/login");
            exit;
        }

        $user = $this->userRepository->findByUsername($usuario);

        if ($user && password_verify($senha, $user['senha'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_cargo'] = $user['cargo'];
            
            header("Location: " . BASE_PATH . "/dashboard");
            exit;
        } else {
            $_SESSION['error'] = "Usuário ou senha incorretos.";
            header("Location: " . BASE_PATH . "/login");
            exit;
        }
    }
}
