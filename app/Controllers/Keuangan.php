<?php

namespace App\Controllers;

use App\Models\DanaKeluarModel;
use App\Models\Pembayaran;
use App\Models\DanaMasukModel;
class Keuangan extends BaseController
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $model = new Pembayaran();
        $modelDanaMasuk = new DanaMasukModel();

        $month = date('m');
        $year = date('Y');

        if (!empty($this->request->getGet('month')) && !empty($this->request->getGet('year'))) {
            $month = $this->request->getGet('month');
            $year = $this->request->getGet('year');
        }

        $data['pembayaran'] = $model->pelanggan(['month' => $month, 'year' => $year]);
        $data['pendapatanByMonth'] = $model->pendapatanByMonth($month);
        $data['pendapatanByYear'] = $model->pendapatanByYear($year);
        $data['danaMasuk'] = $this->getDanaMasuk(['month' => $month, 'year' => $year]);
        $data['danaKeluar'] = $this->getDanaKeluar(['month' => $month, 'year' => $year]);
        $data['title'] = 'Data Keuangan';
        $data['submenu'] = 'keuangan';
        
        

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