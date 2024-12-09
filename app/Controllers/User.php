<?php

namespace App\Controllers;

use App\Models\Pelanggan;
use Exception;
use Myth\Auth\Models\GroupModel;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class User extends BaseController
{
    function __construct()
    {
    } 

    public function index()
    {
        $model = new UserModel();
        
        $data['title'] = 'Manajemen User';
        $data['users'] = $model->findAll();
        return view('user/index', $data);
    }

    public function tambah_pelanggan()
    {
        $model = model(Pelanggan::class);
        $pelanggans = $model->where('id_user', NULL)->findAll();
        $data['title'] = 'Tambah User';
        $data['pelanggan'] = $pelanggans;
        return view('user/tambah_pelanggan', $data);
    }

    public function create_pelanggan()
    {
        $model = new UserModel();

        $pelangganModel = model(Pelanggan::class);

        $post = $this->request->getPost();

        $rules = $this->validationRules($post);

        $pelanggan = $pelangganModel->asObject()->find($post['pelanggan_id']);

        if (!$this->validate($rules))
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());

        if ($pelanggan->id_user)
            return redirect()->back()->withInput()->with('error_message', 'Tidak dapat menambahkan, pelanggan ini telah terdaftar');

        $data = [
            'username'          => $this->request->getPost('username'),
            'password_hash'     => Password::hash('12345678'),
            'active'            => 1
        ];

        if ($this->request->getPost('email')) $data['email'] = $this->request->getPost('email');

        if (!$model->save($data)) 
            return redirect()->back()->withInput()->with('error_message', 'On error occured');
        
        $userId = $model->getInsertID();

        $pelanggan->id_user = $userId;

        $pelangganModel->save($pelanggan);

        $role = $post['role'];

        // Assign the user to a group (e.g., "user" group)
        $groupModel = new GroupModel();
        $group = $groupModel->where('name', $role)->first();  // Or any group you need

        if ($group) {
            // Insert the user into the group
            $db = \Config\Database::connect();
            $db->table('auth_groups_users')->insert([
                'group_id' => $group->id,
                'user_id'  => $userId,
            ]);
        }

        return redirect()->to('data-user')->with('success_message', 'berhasil menambahkan '.$pelanggan->nama.' sebagai user');
    }
    // TAMBAH USER 
    public function tambah_user()
    {
        $data['title'] = 'Form Tambah Pengguna Baru';
        return view('user/tambah_user', $data);
    }

    public function create_user()
    {
        $userModel = new UserModel();
        $groupModel = new GroupModel();

        $post = $this->request->getPost();

        // Validasi input
        $rules = $this->validationRules($post);

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        // Persiapkan data user
        $dataUser = [
            'username'      => $post['username'],
            'password_hash' => Password::hash('12345678'), // Default password
            'active'        => 1
        ];

        if (!empty($post['email'])) {
            $dataUser['email'] = $post['email'];
        }

        // Simpan user baru
        if (!$userModel->save($dataUser)) {
            return redirect()->back()->withInput()->with('error_message', 'Terjadi kesalahan saat menyimpan data pengguna.');
        }

        $userId = $userModel->getInsertID();

        // Tambahkan ke grup sesuai dengan role
        $group = $groupModel->where('name', $post['role'])->first();
        if ($group) {
            $db = \Config\Database::connect();
            $db->table('auth_groups_users')->insert([
                'group_id' => $group->id,
                'user_id'  => $userId,
            ]);
        }

        return redirect()->to('/data-user')->with('success_message', 'Pengguna berhasil ditambahkan.');
    }

    
    public function edit($id)
    {
        $userModel = model(UserModel::class);
        $pelangganModel = model(Pelanggan::class);
        $groupModel = model(GroupModel::class);
        $user = $userModel->asObject()->find($id);
        $role = $groupModel->getGroupsForUser($user->id)[0];
        $pelanggan = $pelangganModel->where('id_user', $id)->asObject()->first();
        $data['user'] = $user;
        $data['pelanggan'] = $pelanggan;
        $data['role'] = $role;
        $data['title'] = 'Edit User';
        return view('user/edit_user', $data);
    }

    public function update($id)
    {
        $userModel = model(UserModel::class);

        $pelangganModel = model(Pelanggan::class);

        $userValidationRules = $userModel->getValidationRules();

        $userValidationRules['id'] = 'max_length[19]|is_natural_no_zero';

        $userModel->setValidationRules($userValidationRules);

        $post = $this->request->getPost();
        
        $user = $userModel->asObject()->find($id);

        $pelanggan = $pelangganModel->asObject()->where('id_user', $user->id)->first();

        $rules = $this->validationRules(post: $post, mode: 'update', user: $user);

        if (!$this->validate($rules))
            return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        
        $user->username = $post['username'];

        $user->active = $post['status'];

        $user->email = NULL;

        $pelanggan->email = NULL;

        if ($post['email']) {
            $user->email = $post['email'];

            $pelanggan->email = $post['email'];
        }

        $pelangganModel->save($pelanggan);
        
        if ($post['password']) $user->password_hash = Password::hash($post['password']);
        
        if (!$userModel->save($user)) 
            return redirect()->back()->withInput()->with('error_message', 'On error occured');

        $role = $post['role'];

        $groupModel = new GroupModel();
        $group = $groupModel->where('name', $role)->first();

        if ($group) {
            $db = \Config\Database::connect();
            $db->table('auth_groups_users')->where('user_id', $user->id)->set([
                'group_id' => $group->id,
            ])->update();

        }
    
        return redirect()->to('data-user')->with('success_message', 'perubahan berhasil disimpan');
    }
    
    public function delete($id)
    {
        if (!$id) return redirect()->back()->with('error_message', 'Id tidak ditemukan.');

        $userModel = new UserModel();
        $pelangganModel = model(Pelanggan::class);

        try {

            $userModel->where('id', $id)->delete();

            $pelangganModel->where('id_user', $id)->set(['id_user' => NULL])->update();

            echo json_encode(['status' => true, 'message' => 'data berhasil dihapus']);

        } catch (Exception $e) {
            echo json_encode(['status' => false, 'message' => $e->getMessage()]);
        }

    }

    private function validationRules($post, $mode = 'create', $user = null)
    {
        $rules = [
            'username' => [
                'rules'  => 'required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,{id}]',
                'errors' => [
                    'required'   => 'Username harus diisi.',
                    'min_length' => 'Username harus lebih dari 3 karakter.',
                    'max_length' => 'Username tidak boleh lebih dari 30 karakter.',
                    'is_unique'  => 'Username ini sudah terdaftar'
                ]
            ],
            'role' => [
                'rules'  => 'required|in_list[Bendahara,Petugas,Pelanggan]',
                'errors' => [
                    'required'   => 'Role harus diisi.',
                ]
            ],
        ];

        if ($post['email']) {
            $rules['email'] = [
                    'rules'  => 'required|valid_email|is_unique[users.email]',
                    'errors' => [
                        'required'      => 'Email harus diisi.',
                        'valid_email'   => 'Format email tidak valid',
                        'is_unique'     => 'Email ini sudah terdaftar'
                    ]
                ];
        }

        if ($mode == 'update') {
            if ($post['password']) {
                $rules['password'] = [
                        'rules'  => 'required|min_length[8]',
                        'errors' => [
                            'required'      => 'Password harus diisi.',
                            'min_length'    => 'Password harus lebih dari 7 karakter.',
                        ]
                    ];
            }
            if ($user->username == $post['username']) {
                $rules['username'] = [
                    'rules'  => 'required|min_length[3]|max_length[30]',
                    'errors' => [
                        'required'   => 'Username harus diisi.',
                        'min_length' => 'Username harus lebih dari 3 karakter.',
                        'max_length' => 'Username tidak boleh lebih dari 30 karakter.',
                    ]
                    ];
            }
            if ($post['email']) {
                if ($user->email == $post['email']) {
                    $rules['email'] = [
                        'rules'  => 'required|valid_email',
                        'errors' => [
                            'required'      => 'Email harus diisi.',
                            'valid_email'   => 'Format email tidak valid',
                            'is_unique'     => 'Email ini sudah terdaftar'
                        ]
                    ];
                }
            }
        }else if($mode == 'create') {
            $rules['pelanggan_id'] = [
                'rules'  => 'required',
                'errors' => [
                    'required'   => 'Pelanggan harus diisi.',
                ]
                ];
        }

        return $rules;
    }
}
