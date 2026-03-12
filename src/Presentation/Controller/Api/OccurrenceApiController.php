<?php

namespace epiGuard\Presentation\Controller\Api;

class OccurrenceApiController
{
    public function calendar()
    {
        header('Content-Type: application/json');
        
        $month = $_GET['month'] ?? date('m');
        $year = $_GET['year'] ?? date('Y');

        // Mock data for the calendar
        $data = [
            [
                'id' => 1,
                'full_date' => "$year-$month-11",
                'name' => 'Téc. Desenv. Sistemas',
                'desc' => '1 ocorrência registrada',
                'time' => '10:30',
                'aluno_id' => 1
            ]
        ];

        echo json_encode($data);
    }

    public function details()
    {
        header('Content-Type: application/json');
        
        $month = $_GET['month'] ?? date('m');
        
        // Mock data for modal details
        $data = [
            [
                'ocorrencia_id' => 1,
                'aluno_id' => 1,
                'aluno' => 'João Silva',
                'epis' => 'Capacete',
                'data' => '11/03/2026',
                'hora' => '10:30',
                'status' => 'Pendente',
                'status_formatado' => 'Pendente'
            ]
        ];

        echo json_encode($data);
    }
}
