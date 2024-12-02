<?php

namespace App\Controllers;

use App\Models\DanaKeluarModel;
use App\Models\Pembayaran;

class Keuangan extends BaseController
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');

        $data['title'] = 'Data Keuangan';
        $data['submenu'] = 'keuangan';
        $data['danaMasuk'] = $this->getDanaMasuk();
        $data['danaKeluar'] = $this->getDanaKeluar();

        return view('administrasi/data-keuangan/index', $data);

    }

    public function getDanaMasuk()
    {
        $model = new Pembayaran();

        return $model->danaMasukPerPeriode();
    }

    public function getDanaKeluar()
    {
        $model = new DanaKeluarModel();

        $query = $model->select('SUM(jumlah_keluar) as dana_keluar, MONTH(tanggal_keluar) as periode')
                    ->groupBy('MONTH(tanggal_keluar)')
                    ->get()->getResultArray();

        $arr = [];
        foreach ($query as $value) {
            $arr[$value['periode']] = $value['dana_keluar'];
        }

        return $arr;
    }

}