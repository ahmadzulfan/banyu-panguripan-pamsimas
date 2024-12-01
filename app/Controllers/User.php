<?php

namespace App\Controllers;

use Myth\Auth\Models\UserModel;

class User extends BaseController
{
    private $session;
    function __construct()
    {
    } 

    public function index()
    {
        $model = new UserModel();
        
        $data['users'] = $model->findAll();
        return view('user/index', $data);
    }

    public function tambah()
    {
        return view('user/tambah_user');
    }

    public function create()
    {
        $model = new UserModel();
        $data = [
            'name' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
            'username' => '',
            'role' => 'pelanggan',
            'password_hash'     => password_hash('123456', PASSWORD_DEFAULT)
        ];

        $model->save($data);
        return redirect()->to('data-user');
    }
    
    public function delete($id)
    {
        $model = new UserModel();

        $model->where('id', $id)->delete();
        echo json_encode(['status' => true]);

    }
}
