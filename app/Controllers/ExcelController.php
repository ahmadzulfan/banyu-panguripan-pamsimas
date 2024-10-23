<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExcelController extends BaseController
{
    public function index()
    {
        return view('index');

    }

    public function export()
    {
        //$userModel = new UsersModel();
        //$users = $userModel->findAll();

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama')
            ->setCellValue('B1', 'Email')
            ->setCellValue('C1', 'Tanggal dibuat');

        $column = 2;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, 'uu')
                ->setCellValue('B' . $column, 'oo')
                ->setCellValue('C' . $column, 'pp');

        // foreach ($users as $user) {
        //     $spreadsheet->setActiveSheetIndex(0)
        //         ->setCellValue('A' . $column, $user['name'])
        //         ->setCellValue('B' . $column, $user['email'])
        //         ->setCellValue('C' . $column, $user['created_at']);

        //     $column++;
        // }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data-User';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}