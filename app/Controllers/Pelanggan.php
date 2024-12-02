<?php

namespace App\Controllers;

use App\Models\Pelanggan as ModelsPelanggan;
use Exception;
use Myth\Auth\Entities\User;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

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
        $data['title'] = 'Manajemen Pelanggan';
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
        $userModel = model(UserModel::class);
        
        $dataPelanggan = $model->asObject()->find($id);

        $randomNumber = sprintf('%06d', rand(0, 999999));

        $hash_password = Password::hash('12345678');

        $user = new User();
        $user->email = $dataPelanggan->email;
        $user->username = 'user_'.$randomNumber;
        $user->password_hash = $hash_password;
        $user->active = 1;

        $userModel->save($user);

        if ($userModel->errors()) {
            return var_export($userModel->errors());
            return redirect()->back()->with('error_message', $userModel->errors());
        } else {
            
            $userId = $userModel->insertID();

            $model->where('id', $id)->set('id_user', $userId)->update();

            // Assign the user to a group (e.g., "user" group)
            $groupModel = new GroupModel();
            $group = $groupModel->where('name', 'Pelanggan')->first();  // Or any group you need

            if ($group) {
                // Insert the user into the group
                $db = \Config\Database::connect();
                $db->table('auth_groups_users')->insert([
                    'group_id' => $group->id,
                    'user_id'  => $userId,
                ]);
            }
            
            return redirect()->to('data-pelanggan')->with('success_message', 'berhasil menambahkan '.$dataPelanggan->nama.' sebagai user');
        }
        
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
