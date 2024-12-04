<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagihanModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\DanaKeluarModel;
use App\Models\Pembayaran;

class PdfController extends BaseController
{
    private $tagihanModel;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->tagihanModel = new TagihanModel();
    } 

    public function struk($id)
    {
        $model = new TagihanModel();
        $data['transaction'] = $model->getDetailTagihanById($id);
        return view('struk/struk', $data);
    }

    public function filter($filterMonth, $filterYear)
    {

        $filter = [
            "month" => $filterMonth,
            "year"  => $filterYear
        ];

        $filteredData = $this->tagihanModel->filterDataPDF($filter);

        return $filteredData;
    }

    public function generate()
    {

        $filterMonth = $this->request->getVar('month');
        $filterYear = $this->request->getVar('year');

        if (!$filterMonth && !$filterYear) {
            $filterMonth = date('m');
            $filterYear = date('Y');
        }
        
        $datas['datas'] = $this->filter($filterMonth, $filterYear);

        $filename = 'Laporan Tagihan PAM - '. date('y-m-d-H-i-s');

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('administrasi/data-laporan/laporan-pdf', $datas));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => 0));

        exit();
    }

    public function export()
    {
        // Ambil data dana masuk dan dana keluar dari model
        $danaMasuk = $this->getDanaMasuk();
        $danaKeluar = $this->getDanaKeluar();

        // Hitung total pendapatan
        $pendapatan = 0;
        foreach ($danaMasuk as $key => $dana) {
            $pendapatanPerBulan = $dana['dana_masuk'] - ($danaKeluar[$dana['periode']] ?? 0);
            $pendapatan += $pendapatanPerBulan;
        }

        // Data untuk dikirim ke view
        $data = [
            'danaMasuk' => $danaMasuk,
            'danaKeluar' => $danaKeluar,
            'pendapatan' => $pendapatan,
        ];

        $filename = 'Laporan Keuangan PAM - ' . date('Y-m-d-H-i-s');

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $dompdf = new Dompdf($options);

        // Load HTML view
        $dompdf->loadHtml(view('administrasi/data-keuangan/laporan-pdf', $data));

        // Atur ukuran kertas dan orientasi
        $dompdf->setPaper('A4', 'landscape');

        // Render HTML ke PDF
        $dompdf->render();

        // Tampilkan PDF di browser
        $dompdf->stream($filename, array("Attachment" => false));

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
        $query = $model->select('SUM(jumlah_keluar) as dana_keluar, MONTH(tanggal_keluar) as periode')
                       ->groupBy('MONTH(tanggal_keluar)')
                       ->get()->getResultArray();

        // Konversi ke array dengan key periode
        $arr = [];
        foreach ($query as $value) {
            $arr[$value['periode']] = $value['dana_keluar'];
        }
        return $arr;
    }
}
