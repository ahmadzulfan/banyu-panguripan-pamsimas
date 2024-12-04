<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagihanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\DanaKeluarModel;
use App\Models\Pembayaran;

class ExcelController extends BaseController
{
    public function index()
    {
        return view('index');

    }

    public function generate()
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

        $filteredData = $tagihanModel->filterDataPDF($filter);

        return $filteredData;
    }

    public function export()
{
    $danaMasuk = $this->getDanaMasuk();  // Data dana masuk
    $danaKeluar = $this->getDanaKeluar();  // Data dana keluar

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Header untuk laporan
    $sheet->setCellValue('A1', 'PERIODE')
          ->setCellValue('B1', 'KETERANGAN')
          ->setCellValue('C1', 'DANA KAS');

    $row = 2; // Baris awal setelah header

    $totalPendapatan = 0;

    foreach ($danaMasuk as $key => $dana) {
        $periode = month_indo($dana['periode']);
        $danaMasukBulan = $dana['dana_masuk'];
        $danaKeluarBulan = 0;
        $pendapatanBulan = 0;

        // Baris pemasukan
        $sheet->setCellValue('A' . $row, $periode)
              ->setCellValue('B' . $row, "Pendapatan PAM bulan $periode")
              ->setCellValue('C' . $row, "Pemasukan: Rp " . number_format($danaMasukBulan, 0, '.', '.'));
        $row++;

        foreach ($danaKeluar[$dana['periode']] as $key => $dk) {
            $danaKeluarBulan += $dk['dana_keluar'];
            // Baris pengeluaran
            $sheet->setCellValue('A' . $row, $periode)
                ->setCellValue('B' . $row, $dk['keterangan'])
                ->setCellValue('C' . $row, "Pengeluaran: Rp " . number_format($dk['dana_keluar'], 0, '.', '.'));
            $row++;
        }

        $pendapatanBulan = $danaMasukBulan - $danaKeluarBulan;
        $totalPendapatan += $pendapatanBulan;

        // Baris pendapatan bulan
        $sheet->setCellValue('B' . $row, "Pendapatan Bulan $periode")
              ->setCellValue('C' . $row, "Rp " . number_format($pendapatanBulan, 0, '.', '.'));
        $row++;
    }

    // Baris total pendapatan
    $sheet->setCellValue('B' . $row, "Total Pendapatan")
          ->setCellValue('C' . $row, "Rp " . number_format($totalPendapatan, 0, '.', '.'));

    // Menyimpan file dan mengirimkan ke browser untuk diunduh
    $writer = new Xlsx($spreadsheet);
    $filename = 'Laporan-Keuangan-PAM-' . date('Y-m-d-His');

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    exit();
}

    private function getDanaMasuk()
    {
        $model = new Pembayaran();

        return $model->danaMasukPerPeriode();
    }

    private function getDanaKeluar()
    {
        $model = new DanaKeluarModel();

        $query = $model->select('jumlah_keluar as dana_keluar, MONTH(tanggal_keluar) as periode, keterangan')
                    ->orderBy('tanggal_keluar', 'asc')
                    ->get()->getResultArray();

        $totalKeluar = 0;
        $arr = [];
        foreach ($query as $value) {
            $arr[$value['periode']][] = ['dana_keluar' => $value['dana_keluar'], 'keterangan' => $value['keterangan']];
            $totalKeluar += $value['dana_keluar'];
        }

        $arr['total_pengeluaran'] = $totalKeluar;

        return $arr;
    }
}