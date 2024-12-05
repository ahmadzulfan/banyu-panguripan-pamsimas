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
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
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
        $data['title'] = 'Tambah Data Pelanggan';
        return view('pelanggan/tambah_pelanggan', $data);
    }

    public function create()
    {
        $model = new ModelsPelanggan();

        helper('form');

        $post = $this->request->getPost();

        $rules = [
            'nama' => [
                'rules'  => 'required|min_length[6]|max_length[25]',
                'errors' => [
                    'required'   => 'Nama harus diisi.',
                    'min_length' => 'Nama harus lebih dari 5 karakter.',
                    'max_length' => 'Nama tidak boleh lebih dari 25 karakter.',
                ]
            ],
            'alamat' => [
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Alamat harus diisi.',
                ]
            ],
            'no_telepon' => [
                'rules'  => 'required|min_length[11]|numeric|max_length[15]|is_unique[pelanggan.no_telepon]',
                'errors' => [
                    'required'   => 'No Telepon harus diisi.',
                    'min_length' => 'No Telepon harus lebih dari 10 karakter.',
                    'max_length' => 'No Telepon tidak boleh lebih dari 15 karakter.',
                    'numeric'    => 'No Telepon harus berupa angka',
                    'is_unique'  => 'No Telepon ini sudah terdaftar'
                ]
            ],
        ];

        if ($post['email']) {
            $rules['email'] = [
                    'rules'  => 'required|valid_email|is_unique[pelanggan.email]',
                    'errors' => [
                        'required'      => 'Email harus diisi.',
                        'valid_email'   => 'Format email tidak valid',
                        'is_unique'     => 'Email ini sudah terdaftar'
                    ]
                ];
        }

        if (!$this->validate($rules)){
            return redirect()->to('data-pelanggan/tambah')->withInput()->with('validation', $this->validator->getErrors());
        }

        $data = [
            'nama'          => $post['nama'],
            'alamat'        => $post['alamat'],
            'no_telepon'    => $post['no_telepon'],
        ];

        if ($this->request->getPost('email')) $data['email'] = $this->request->getPost('email');

        $model->save($data);
        
        return redirect()->to('data-pelanggan')->with('success_message', 'berhasil menambahkan data');
    }

    public function edit($id)
    {
        $model = new ModelsPelanggan();
        
        $data['title'] = 'Edit Data Pelanggan';
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
        
        return redirect()->to('data-pelanggan')->with('success_message', 'berhasil mengubah data');
    }

    public function createUser($id)
    {
        $model = new ModelsPelanggan();
        $userModel = model(UserModel::class);
        
        $dataPelanggan = $model->asObject()->find($id);

        $randomNumber = sprintf('%06d', rand(0, 999999));

        $hash_password = Password::hash('12345678');

        $user = new User();
        if ($dataPelanggan->email) $user->email = $dataPelanggan->email;
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
