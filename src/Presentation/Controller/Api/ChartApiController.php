<?php

namespace epiGuard\Presentation\Controller\Api;

class ChartApiController
{
    public function index()
    {
        header('Content-Type: application/json');
        
        // Mock data to match the dashboard requirements
        $response = [
            'status' => 'success',
            'summary' => [
                'today' => 2,
                'week' => 11,
                'month' => 47,
                'total_students' => 100
            ],
            'bar' => [
                'capacete' => [15, 18, 22, 10, 28, 20, 24, 17, 30, 23, 19, 26],
                'oculos' => [10, 12, 13, 8, 16, 14, 15, 11, 20, 14, 12, 17],
                'total' => [25, 30, 35, 18, 44, 34, 39, 28, 50, 37, 31, 43]
            ],
            'doughnut' => [
                'labels' => ['Capacete', 'Óculos', 'Total'],
                'data' => [60, 40, 100]
            ]
        ];

        echo json_encode($response);
    }
}
