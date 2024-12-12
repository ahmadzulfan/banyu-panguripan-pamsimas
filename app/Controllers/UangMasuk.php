<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DanaMasukModel;
use App\Models\Pembayaran;

class UangMasuk extends BaseController
{
    public $model, $PembayaranModel;
    public function __construct()
    {
        $this->model = new DanaMasukModel();
        $this->PembayaranModel = new Pembayaran();
    }
    public function index()
    {
        $danaKas = $this->PembayaranModel->danaMasuk();

        $datas = [
            'title'     => 'Dana Masuk',
            'submenu'   => 'keuangan',
            'danaMasuk' => $this->model->asObject()->findAll(),
            'danaKas'   => $danaKas
        ];

        return view('administrasi/data-keuangan/uang-masuk/index', $datas);
    }

    public function store()
    {
        $data = $this->request->getPost();

        $model = $this->model;

        try {
            $arr = [
                'tanggal_masuk' => $data['tanggal_masuk'],
                'jumlah_masuk' => $data['jumlah_masuk'],
                'keterangan' => $data['keterangan'],
            ];

            $model->save($arr);

            return redirect()->back()->with('success_message', 'Berhasil menambahkan data');

        } catch (\Throwable $th) {
            return redirect()->back()->with('error_message', $th->getMessage());
        }

    }

    public function delete($id)
    {
        $model = $this->model;

        try {
            $model->delete($id);

            return response()->setContentType('application/json')                             
                 ->setStatusCode(200)
                 ->setJSON(['status' => true, 'message' => 'OK']);
        }
        catch(\Throwable $e) {
            return response()->setContentType('application/json')                             
                 ->setStatusCode(404)
                 ->setJSON(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
