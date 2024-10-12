<?php

namespace App\Controllers;

use App\Models\User as ModelsUser;

class User extends BaseController
{
    private $session;
    function __construct()
    {
    } 

    public function index(): string
    {
        $model = new ModelsUser();
        $data['user'] = $model->findAll();
        return view('user/index', $data);
    }

    public function tambah()
    {
        return view('user/tambah_user');
    }

    public function create()
    {
        $model = new ModelsUser();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email')
        ];

        $model->save($data);
        return redirect()->to('data-user');
    }
    
    public function delete($id)
    {
        $model = new ModelsUser();

        $model->where('id', $id)->delete();
        echo json_encode(['status' => true]);

    }
}
