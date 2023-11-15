<?php

require realpath(__DIR__.'./../vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

function exportToExcel($data) {
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Inserir cabeçalhos
    $column = 'A';
    foreach ($data[0] as $key => $value) {
        $sheet->setCellValue($column . '1', $key);
        $column++;
    }

    // Inserir dados
    $row = 2;
    foreach ($data as $item) {
        $column = 'A';
        foreach ($item as $key => $value) {
            $sheet->setCellValue($column . $row, $value);
            $column++;
        }
        $row++;
    }

    $column--;
    $row--;

    $headerStyleArray = [
        'font' => [
            'color' => ['rgb' => 'FFFFFF'],
            'bold' => true,
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '333333']
        ],
    ];
    $sheet->getStyle('A1:' . $column . '1')->applyFromArray($headerStyleArray);

    // Estilizar as bordas de todas as células
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => Border::BORDER_THIN,
                'color' => ['rgb' => '000000'],
            ],
        ],
    ];

    $sheet->getStyle('A1:' . $column . $row)->applyFromArray($styleArray);
    
    // Enviar cabeçalhos para forçar o download do arquivo
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Lista_de_Reclamações.xlsx"');
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    // echo "Planilha Gerada";
    // http_response_code(200);
    exit;
}

$data = [];

if (isset($_GET['data'])) {
    $data = json_decode($_GET['data'], true);
}

if ($data) {
    exportToExcel($data);  // Supondo que você já tenha a função exportToExcel() definida anteriormente
} else {
    echo "Erro: Dados inválidos!";
}