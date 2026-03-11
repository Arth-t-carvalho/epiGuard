<?php

use epiGuard\Presentation\Controller\AuthController;

return [
    '/login' => [AuthController::class, 'index'],
];
