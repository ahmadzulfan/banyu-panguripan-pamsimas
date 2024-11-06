<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagihanModel;
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
        $filterMonth = $this->request->getVar('month');
        $filterYear = $this->request->getVar('year');

        if (!$filterMonth && !$filterYear) {
            $filterMonth = date('m');
            $filterYear = date('Y');
        }
        
        $datas = $this->filter($filterMonth, $filterYear);

        $spreadsheet = new Spreadsheet();

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Tanggal Pembayaran')
            ->setCellValue('C1', 'Nama Pelanggan')
            ->setCellValue('D1', 'Tagihan Bulan')
            ->setCellValue('E1', 'Jumlah Pembayaran');
        $column = 2;
        foreach ($datas as $key => $data){
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $key+1)
                ->setCellValue('B' . $column, $data['tanggal_pembayaran'])
                ->setCellValue('C' . $column, $data['nama'])
                ->setCellValue('D' . $column, $data['bulan'])
                ->setCellValue('E' . $column, $data['jumlah_dibayar']);
        $column++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = date('Y-m-d-His'). '-Data Tagihan';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
    
    public function filter($filterMonth, $filterYear)
    {
        $tagihanModel = new TagihanModel();

        $filter = [
            "month" => $filterMonth,
            "year"  => $filterYear
        ];

        $filteredData = $tagihanModel->filterData($filter);

        return $filteredData;
    }
}