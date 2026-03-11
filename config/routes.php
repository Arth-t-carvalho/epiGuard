<?php

use epiGuard\Presentation\Controller\AuthController;
use epiGuard\Presentation\Controller\DashboardController;

return [
    '/login' => [AuthController::class, 'index'],
    '/register' => [AuthController::class, 'register'],
    '/dashboard' => [DashboardController::class, 'index'],
];
