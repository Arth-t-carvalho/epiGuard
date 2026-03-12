<?php

use epiGuard\Presentation\Controller\AuthController;
use epiGuard\Presentation\Controller\DashboardController;
use epiGuard\Presentation\Controller\InfractionController;
use epiGuard\Presentation\Controller\ManagementController;

return [
    '/login' => [AuthController::class, 'index'],
    '/register' => [AuthController::class, 'register'],
    '/dashboard' => [DashboardController::class, 'index'],
    '/api/charts' => [\epiGuard\Presentation\Controller\Api\ChartApiController::class, 'index'],
    '/api/calendar' => [\epiGuard\Presentation\Controller\Api\OccurrenceApiController::class, 'calendar'],
    '/api/modal_details' => [\epiGuard\Presentation\Controller\Api\OccurrenceApiController::class, 'details'],
    '/api/check_notificacoes' => [\epiGuard\Presentation\Controller\Api\NotificationApiController::class, 'check'],
    '/infractions' => [InfractionController::class, 'index'],
    '/management/departments' => [ManagementController::class, 'departments'],
    '/management/employees' => [ManagementController::class, 'employees'],
    '/management/instructors' => [ManagementController::class, 'instructors'],
    '/api/departments' => [\epiGuard\Presentation\Controller\Api\DepartmentApiController::class, 'index'],
    '/api/departments/create' => [\epiGuard\Presentation\Controller\Api\DepartmentApiController::class, 'create'],
];
