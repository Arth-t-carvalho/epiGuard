<?php

namespace epiGuard\Presentation\Controller;

use epiGuard\Infrastructure\Database\Connection;
use App\Infrastructure\Persistence\MySQLUserRepository;
use App\Domain\Entity\User;
use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\UserRole;

class AuthController
{
    private MySQLUserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new MySQLUserRepository();
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
        $cargo = $_POST['cargo'] ?? 'OPERATOR'; // Padrão da nova arquitetura

        if (empty($nome) || empty($usuario) || empty($senha)) {
            $_SESSION['error'] = "Todos os campos são obrigatórios.";
            header("Location: " . BASE_PATH . "/register");
            exit;
        }

        try {
            // Mapear cargo do formulário para UserRole da arquitetura
            $mappedRole = UserRole::VIEWER;
            if ($cargo === 'SUPER_ADMIN') {
                $mappedRole = UserRole::ADMIN;
            } elseif ($cargo === 'SUPERVISOR' || $cargo === 'GERENTE_SEGURANCA') {
                $mappedRole = UserRole::OPERATOR;
            }

            // Criptografar senha
            $hashedPassword = password_hash($senha, PASSWORD_BCRYPT);

            // Criar entidade de domínio
            $user = new User(
                name: $nome,
                email: new Email($usuario),
                passwordHash: $hashedPassword,
                role: new UserRole($mappedRole)
            );

            $this->userRepository->save($user);
            
            $_SESSION['success'] = "Cadastro realizado com sucesso! Faça login.";
            header("Location: " . BASE_PATH . "/login");
            exit;
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

        try {
            $user = $this->userRepository->findByUsername($usuario);

            if (!$user) {
                $_SESSION['error'] = "Usuário não encontrado ou inativo.";
                header("Location: " . BASE_PATH . "/login");
                exit;
            }

            if (password_verify($senha, $user->getPasswordHash())) {
                if (session_status() === PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['user_nome'] = $user->getName();
                $_SESSION['user_cargo'] = $user->getRole()->getValue();
                
                header("Location: " . BASE_PATH . "/dashboard");
                exit;
            } else {
                $_SESSION['error'] = "Senha incorreta.";
                header("Location: " . BASE_PATH . "/login");
                exit;
            }
        } catch (\Exception $e) {
            error_log("Login Exception: " . $e->getMessage());
            $_SESSION['error'] = "Erro interno no servidor. Tente novamente mais tarde.";
            header("Location: " . BASE_PATH . "/login");
            exit;
        }
    }
}
