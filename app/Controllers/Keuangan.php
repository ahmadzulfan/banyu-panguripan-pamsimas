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

        $filteredData = $this->pembayaranModel->getDataSinceMonth($filterYear, $filterMonth);

        $pendapatanPam = $this->pembayaranModel->getDataByMonth($filterMonth);

        if ($pendapatanPam) $pendapatanPam[0]['tanggal'] = first_date_by_month(['bulan' => $filterMonth, 'tahun' => $filterYear]);
        $danaMasuk = $this->danaMasukModel->getDataByMonth($filterMonth);
        $danaKeluar = $this->danaKeluarModel->getDataByMonth($filterMonth);

        $data['title'] = 'Data Keuangan';
        $data['submenu'] = 'keuangan';
        $data['dataKeuangan'] = array_merge($pendapatanPam ?? [], $danaMasuk, $danaKeluar);

        return view('administrasi/data-keuangan/index', $data);

    }

}