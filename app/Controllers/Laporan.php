<?php

namespace App\Controllers;

use App\Models\Pembayaran;
use App\Models\TagihanModel;

class Laporan extends BaseController
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $model = new Pembayaran();
        $modelTagihan = new TagihanModel();

        $month = date('m');
        $year = date('Y');

        if (!empty($this->request->getGet('month')) && !empty($this->request->getGet('year'))) {
            $month = $this->request->getGet('month');
            $year = $this->request->getGet('year');
        }

        $data['pembayaran'] = $model->pelanggan(['month' => $month, 'year' => $year]);
        $data['pendapatanByMonth'] = $model->pendapatanByMonth($month);
        $data['pendapatanByYear'] = $model->pendapatanByYear($year);
        $data['statusTagihan'] = $modelTagihan->statusTagihan($month, $year);

        return view('administrasi/data-laporan/index', $data);
    }
}