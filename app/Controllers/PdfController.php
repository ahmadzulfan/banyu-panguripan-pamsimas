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
    // EXPORT DATA LAPORAN
    public function generate()
    {

        $filterMonth = $this->request->getVar('month');
        $filterYear = $this->request->getVar('year');

        if (!$filterMonth && !$filterYear) {
            $filterMonth = date('m');
            $filterYear = date('Y');
        }
        
        $datas['datas'] = $this->filter($filterMonth, $filterYear);

        $datas['dateExport'] = [
            'bulan' => $filterMonth,
            'tahun' => $filterYear
        ];

        $filename = 'Laporan Pembayaran PAM - '. date('y-m-d-H-i-s');

       
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

    // EXPORT DATA TAGIHAN
    public function generate_tagihan()
    {
        $filterMonth = $this->request->getVar('month');
        $filterYear = $this->request->getVar('year');

        // Jika tidak ada input bulan dan tahun, gunakan bulan dan tahun saat ini
        if (!$filterMonth && !$filterYear) {
            $filterMonth = date('m');
            $filterYear = date('Y');
        }

        // Ambil data tagihan berdasarkan filter bulan dan tahun
        $datas['tagihan'] = $this->filter($filterMonth, $filterYear);
        
        $datas['dateExport'] = [
            'bulan' => $filterMonth,
            'tahun' => $filterYear
        ];

        // Tambahkan nama file untuk laporan
        $filename = 'Laporan Tagihan PAM - ' . date('y-m-d-H-i-s');

        // Pastikan ada data yang dikirim
        if (empty($datas['tagihan'])) {
            // Tampilkan pesan error atau alihkan ke halaman tertentu jika data kosong
            return redirect()->back()->with('error', 'Data tagihan tidak ditemukan untuk periode ini.');
        }

        
        // Inisialisasi dan gunakan Dompdf
        $dompdf = new Dompdf();

        // Muat konten HTML ke dalam Dompdf
        $dompdf->loadHtml(view('administrasi/data-tagihan/laporan-pdf', $datas));

        // Set ukuran kertas dan orientasi (A4, landscape)
        $dompdf->setPaper('A4', 'landscape');

        // Render HTML menjadi PDF
        $dompdf->render();

        // Kirim output PDF ke browser
        $dompdf->stream($filename, array("Attachment" => 0));

        // Pastikan aplikasi berhenti setelah mengirim file
        exit();
    }


    // EXPORT DATA KAS
    public function export()
    {
        $filterMonth = $this->request->getVar('month');
        $filterYear = $this->request->getVar('year');

        if (!$filterMonth && !$filterYear) {
            $filterMonth = date('m');
            $filterYear = date('Y');
        }
        
        // Ambil data dana masuk dan dana keluar dari model
        $danaMasuk = $this->getDanaMasuk();
        $danaKeluar = $this->getDanaKeluar();

        // Hitung total pendapatan
        $pendapatan = 0;
        foreach ($danaMasuk as $dana) {
            $danaKeluarBulanan = 0;
            if (!empty($danaKeluar[$dana['periode']])) {
                foreach ($danaKeluar[$dana['periode']] as $dk) {
                    $danaKeluarBulanan += $dk['dana_keluar'];
                }
            }
            $pendapatanPerBulan = (int)$dana['dana_masuk'] - ((int)$danaKeluarBulanan);
            $pendapatan += $pendapatanPerBulan;
        }

        // Data untuk dikirim ke view
        $data = [
            'danaMasuk'     => $danaMasuk,
            'danaKeluar'    => $danaKeluar,
            'pendapatan'    => $pendapatan,
            'dateExport'    => ['bulan' => $filterMonth, 'tahun' => $filterYear]
        ];

        $filename = 'Laporan Keuangan PAM - ' . date('Y-m-d-H-i-s');

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');
        $options->set('chroot', realpath(''));
        

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml('<img src="/assets/images/pamsimas.png"');
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
