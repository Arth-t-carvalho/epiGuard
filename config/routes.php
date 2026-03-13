<?php

use epiGuard\Presentation\Controller\AuthController;

return [
    '/login' => [AuthController::class, 'index'],
    '/cadastro' => [AuthController::class, 'register'],
    '/recuperar-senha' => [AuthController::class, 'resetPassword'],
];
