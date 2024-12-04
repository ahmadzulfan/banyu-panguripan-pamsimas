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