<?php

namespace epiGuard\Presentation\Controller;

class AuthController
{
    public function index()
    {
        require_once __DIR__ . '/../View/auth/login.php';
    }
}
