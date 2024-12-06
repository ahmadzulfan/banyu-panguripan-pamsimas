<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagihanModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\DanaKeluarModel;
use App\Models\Pembayaran;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

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

        $title = 'Laporan Keuangan - Pamsimas Banyu Panguripan';

        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', $title);

        $sheet->getStyle('A1')
              ->getFont()
              ->setBold(true)
              ->setSize(16);

        $sheet->getStyle('A1')
              ->getAlignment()
              ->setHorizontal(Alignment::HORIZONTAL_CENTER)
              ->setVertical(Alignment::VERTICAL_CENTER);

        $sheet->setCellValue('A2', 'No')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Keterangan')
            ->setCellValue('D2', 'Pemasukan')
            ->setCellValue('E2', 'Pengeluaran');

        $sheet->getStyle('A2:E2')
              ->getFont()->setBold(true)
              ->setSize(11);

        // Mengatur perataan teks header ke tengah
        $sheet->getStyle('A2:E2')
              ->getAlignment()
              ->setHorizontal(Alignment::HORIZONTAL_CENTER)
              ->setVertical(Alignment::VERTICAL_CENTER);

        $row = 3; // Baris awal setelah header

        $totalPendapatan = 0;
        $totalPemasukan = 0;
        $totalPengeluaran = 0;
        $no = 1;

        foreach ($danaMasuk as $dana) {
            $periode = month_indo($dana['periode']);
            $danaKeluarBulan = 0;
            $pendapatanBulan = 0;
            $danaMasukBulan = $dana['dana_masuk'];
            $totalPemasukan += $danaMasukBulan;

            // Baris pemasukan
            $sheet->setCellValue('A' . $row, $no)
                ->setCellValue('B' . $row, tgl_indo($dana['tanggal']))
                ->setCellValue('C' . $row, "Pendapatan PAM bulan $periode")
                ->setCellValue('D' . $row, "Rp".number_format($danaMasukBulan, 0, '.', '.'));

            $sheet->getStyle('A')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
            $row++;

            foreach ($danaKeluar[$dana['periode']] as $dk) {
                $no++;
                $danaKeluarBulan += $dk['dana_keluar'];
                $totalPengeluaran += $danaKeluarBulan;
                // Baris pengeluaran
                $sheet->setCellValue('A' . $row, $no)
                    ->setCellValue('B' . $row, tgl_indo($dk['tanggal']))
                    ->setCellValue('C' . $row, $dk['keterangan'])
                    ->setCellValue('E' . $row, "Rp".number_format($danaKeluarBulan, 0, '.', '.'));

                $sheet->getStyle('A')
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('E')
                        ->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
                $row++;
            }

            $pendapatanBulan = $danaMasukBulan - $danaKeluarBulan;
            $totalPendapatan += $pendapatanBulan;

            $no++;
        }

        $sheet->setCellValue('C' . $row, "Total")
            ->setCellValue('D' . $row, "Rp".number_format($totalPemasukan, 0, '.', '.'))
            ->setCellValue('E' . $row, "Rp".number_format($totalPengeluaran, 0, '.', '.'));

        $sheet->getStyle('D' . $row . ':' . 'E' . $row)
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT);
        $row++;

        $sheet->setCellValue('C' . $row, "Saldo Akhir")
            ->setCellValue('E' . $row, "Rp".number_format($totalPendapatan, 0, '.', '.'));

        $sheet->getStyle('E')
            ->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_RIGHT);

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(20);
        $sheet->getColumnDimension('C')->setWidth(35);
        $sheet->getColumnDimension('D')->setWidth(15);
        $sheet->getColumnDimension('E')->setWidth(15);

        $highestColumn = $sheet->getHighestColumn();
        $highestRow = $sheet->getHighestRow();
        
        $sheet->getStyle('A2:' . $highestColumn . $highestRow)
              ->getBorders()
              ->getAllBorders()
              ->setBorderStyle(Border::BORDER_THIN)
              ->getColor()->setRGB('000000');

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

        $query = $model->select('jumlah_keluar as dana_keluar, MONTH(tanggal_keluar) as periode, keterangan, tanggal_keluar as tanggal')
                    ->orderBy('tanggal_keluar', 'asc')
                    ->get()->getResultArray();

        $totalKeluar = 0;
        $arr = [];
        foreach ($query as $value) {
            $arr[$value['periode']][] = ['dana_keluar' => $value['dana_keluar'], 'keterangan' => $value['keterangan'], 'tanggal' => $value['tanggal']];
            $totalKeluar += $value['dana_keluar'];
        }

        $arr['total_pengeluaran'] = $totalKeluar;

        return $arr;
    }
}