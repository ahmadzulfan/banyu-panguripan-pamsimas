<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DanaKeluarModel;
use CodeIgniter\HTTP\ResponseInterface;
use Throwable;

class UangKeluar extends BaseController
{

    public $model;
    public function __construct()
    {
        $this->model = new DanaKeluarModel();
    }

    public function index()
    {
        $model = $this->model;

        $datas = [
            'title' => 'Dana Keluar',
            'datas' => $model->findAll(),
        ];

        return view('administrasi/data-keuangan/uang-keluar/index', $datas);
    }

    public function store()
    {
        $data = $this->request->getPost();

        $model = new DanaKeluarModel();

        try {
            $arr = [
                'tanggal_keluar' => $data['tanggal_keluar'],
                'jumlah_keluar' => $data['jumlah_keluar'],
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
