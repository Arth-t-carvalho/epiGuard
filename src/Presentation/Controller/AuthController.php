<?php

namespace epiGuard\Presentation\Controller;

class AuthController
{
    public function index()
    {
        require_once __DIR__ . '/../View/auth/login.php';
    }

    public function register()
    {
        require_once __DIR__ . '/../View/auth/register.php';
    }

    public function resetPassword()
    {
        require_once __DIR__ . '/../View/auth/reset-password.php';
    }
}
