<?php

namespace App\Controllers;

use App\Models\Pembayaran;

class Keuangan extends BaseController
{
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $model = new Pembayaran();

        $data['danaMasuk'] = $model->danaMasuk();
        $data['danaKeluar'] = 0;

        return view('administrasi/data-keuangan/index', $data);
    }
}