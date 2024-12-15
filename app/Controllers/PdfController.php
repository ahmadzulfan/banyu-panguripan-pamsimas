<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TagihanModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\DanaKeluarModel;
use App\Models\Pembayaran;
use App\Models\Tagihan;
use App\Models\DanaMasukModel;

class PdfController extends BaseController
{
    private $tagihanModel,$pembayaranModel, $danaMasukModel, $danaKeluarModel;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->tagihanModel = new TagihanModel();
        $this->pembayaranModel = new Pembayaran();
        $this->danaMasukModel  = new DanaMasukModel();
        $this->danaKeluarModel  = new DanaKeluarModel();
    } 

    public function struk($id)
    {
        $model = new TagihanModel();
        $data['transaction'] = $model->getDetailTagihanById($id);
        return view('struk/struk', $data);
    }

    public function getDataKeuangan($filterMonth, $filterYear)
    {

        $filter = [
            "month" => $filterMonth,
            "year"  => $filterYear
        ];

        $filteredData = $this->tagihanModel->filterDataPDF($filter);

        return $filteredData;
    }
    public function getDataTagihan($filterMonth, $filterYear)
    {

        $filter = [
            "month" => $filterMonth,
            "year"  => $filterYear
        ];

        $filteredData = $this->tagihanModel->filterData($filter);

        return $filteredData;
    }
    // EXPORT DATA LAPORAN PEMBAYARAN
    public function generate()
    {

        $filterMonth = $this->request->getVar('month');
        $filterYear = $this->request->getVar('year');

        if (!$filterMonth && !$filterYear) {
            $filterMonth = date('m');
            $filterYear = date('Y');
        }
        
        $datas['datas'] = $this->getDataKeuangan($filterMonth, $filterYear);

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
        $datas['tagihan'] = $this->getDataTagihan($filterMonth, $filterYear);
        
        $datas['dateExport'] = [
            'bulan' => $filterMonth,
            'tahun' => $filterYear
        ];

        // Tambahkan nama file untuk laporan
        $filename = 'Laporan Tagihan PAM - ' . date('y-m-d-H-i-s');

        // Pastikan ada data yang dikirim
        if (empty($datas['tagihan'])) {
            // Tampilkan pesan error atau alihkan ke halaman tertentu jika data kosong
            return redirect()->back()->with('error_message', 'Maaf, Data tagihan untuk periode ini tidak ditemukan.');
        }

        
        // Inisialisasi dan gunakan Dompdf
        $dompdf = new Dompdf();

        // Muat konten HTML ke dalam Dompdf
        $dompdf->loadHtml(view('administrasi/data-tagihan/laporan-pdf', $datas));

        // Set ukuran kertas dan orientasi (A4, landscape)
        $dompdf->setPaper('A4', 'potrait');

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
        $filterMonth = $this->request->getVar('month') ?? date('m');
        $filterYear = $this->request->getVar('year') ?? date('Y');

        $pendapatanPeriodeLalu = $this->pembayaranModel->getDataSinceMonth($filterYear, $filterMonth);
        $danaMasukPeriodeLalu = $this->danaMasukModel->getDataSinceMonth($filterYear, $filterMonth);
        $danaKeluarPeriodeLalu = $this->danaKeluarModel->getDataSinceMonth($filterYear, $filterMonth);

        $dataKasPeriodeLalu = array_merge($pendapatanPeriodeLalu, $danaMasukPeriodeLalu, $danaKeluarPeriodeLalu);

        $kas = 0;
        foreach ($dataKasPeriodeLalu as $key => $k) {
            $kas += $k['pendapatan'] ?? 0;
            $kas -= $k['pengeluaran'] ?? 0;
        }

        $danaKas = [['pendapatan' => $kas]];
        $danaKas[0]['tanggal'] = first_date_by_prev_month(['bulan' => $filterMonth, 'tahun' => $filterYear]);
        $danaKas[0]['keterangan'] = 'Saldo Kas Periode '. month_indo(ltrim(date('m', strtotime($danaKas[0]['tanggal'])), '0'));

        if (!$danaKas[0]['pendapatan']) $danaKas[0]['pendapatan'] = '0.00';

        $pendapatanPam = $this->pembayaranModel->getDataByMonth($filterYear, $filterMonth);
        if ($pendapatanPam) $pendapatanPam[0]['tanggal'] = last_date_by_month(['bulan' => $filterMonth, 'tahun' => $filterYear]);

        $danaMasuk = $this->danaMasukModel->getDataByMonth($filterYear, $filterMonth);
        $danaKeluar = $this->danaKeluarModel->getDataByMonth($filterYear, $filterMonth);

        $dataKeuangan = array_merge($danaKas, $pendapatanPam ?? [], $danaMasuk, $danaKeluar);

        usort($dataKeuangan, function($a, $b) {
            return strtotime($a['tanggal']) - strtotime($b['tanggal']);
        });
        // Data untuk dikirim ke view
        $data = [
            'danaMasuk'     => $danaMasuk,
            'danaKeluar'    => $danaKeluar,
            'dataKeuangan'  => $dataKeuangan,
            'danaKas'       => $danaKas,
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
