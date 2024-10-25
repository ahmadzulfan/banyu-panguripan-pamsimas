<?php

namespace App\Controllers;

use App\Models\Pelanggan as ModelsPelanggan;
use App\Models\User;
use Exception;

class Pelanggan extends BaseController
{
    private $session;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->session = service('session');
    } 
    public function index(): string
    {
        $model = new ModelsPelanggan();
        $data['pelanggan'] = $model->findAll();
        return view('pelanggan/index', $data);
    }
    public function tambah()
    {
        return view('pelanggan/tambah_pelanggan');
    }

    public function create()
    {
        $model = new ModelsPelanggan();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email')
        ];

        $model->save($data);
        $this->session->setFlashdata('success_message', 'berhasil menambahkan data');
        
        return redirect()->to('data-pelanggan');
    }

    public function edit($id)
    {
        $model = new ModelsPelanggan();
        
        
        $data['pelanggan'] = $model->find($id);

        return view('pelanggan/edit_pelanggan', $data);
    }

    public function update($id)
    {
        $model = new ModelsPelanggan();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email')
        ];

        $model->where('id', $id)->set($data)->update();
        $this->session->setFlashdata('success_message', 'berhasil mengubah data');
        
        return redirect()->to('data-pelanggan');
    }

    public function createUser($id)
    {
        $model = new ModelsPelanggan();
        $userModel = new User();
        
        $dataPelanggan = $model->asObject()->find($id);

        $data = [
            'nama' => $dataPelanggan->nama,
            'email' => $dataPelanggan->email,
            'password' => password_hash('123456', PASSWORD_DEFAULT),
            'role' => 'pelanggan'
        ];

        $userModel->insert($data);

        $model->where('id', $id)->set('id_user', $userModel->getInsertID())->update();
        $this->session->setFlashdata('success_message', 'berhasil menambahkan '.$dataPelanggan->nama.' sebagai user');
        
        return redirect()->to('data-pelanggan');
    }
    
    public function delete($id)
    {
        $model = new ModelsPelanggan();

        try {
            $model->delete($id);

            return response()->setContentType('application/json')                             
                 ->setStatusCode(200)
                 ->setJSON(['status' => true, 'message' => 'OK']);
        }
        catch(Exception $e) {
            return response()->setContentType('application/json')                             
                 ->setStatusCode(404)
                 ->setJSON(['status' => false, 'message' => $e->getMessage()]);
        }
    }
}
