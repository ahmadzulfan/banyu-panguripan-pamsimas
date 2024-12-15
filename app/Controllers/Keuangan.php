<?php

namespace App\Controllers;

use App\Models\DanaKeluarModel;
use App\Models\DanaMasukModel;
use App\Models\Pembayaran;

class Keuangan extends BaseController
{
    private $pembayaranModel, $danaMasukModel, $danaKeluarModel;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->pembayaranModel = new Pembayaran();
        $this->danaMasukModel  = new DanaMasukModel();
        $this->danaKeluarModel  = new DanaKeluarModel();
    } 
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

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

        $data['title'] = 'Data Keuangan';
        $data['submenu'] = 'keuangan';
        $data['dataKeuangan'] = $dataKeuangan;

        return view('administrasi/data-keuangan/index', $data);

    }

}