<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pelanggan;
use CodeIgniter\HTTP\ResponseInterface;
use FontLib\Table\Type\post;
use Myth\Auth\Models\UserModel;

class AccountController extends BaseController
{
    private $auth, $config, $authorize, $session;
    function __construct()
    {
        $this->session      = service('session');
        $this->config       = config('Auth');
        $this->auth         = service('authentication');
        $this->authorize    = service('authorization');
    }

    public function index()
    {
        if (!$this->auth->check()) return view('errors/html/error_404');

        $user = $this->auth->user();

        $model = model(Pelanggan::class);
        $pelanggan = $model->where('id_user', $user->id)->asObject()->first();

        $data['title'] = 'Manajemen Akun';
        $data['user'] = $pelanggan ?? $user;
        return view('auth/profile', $data);
    }

    public function update($id)
    {
        if (!$id) return view('errors/html/error_404');

        if (!$this->auth->check()) return view('errors/html/error_404');

        $user = $this->auth->user();

        $post = $this->request->getPost();

        $PelangganModel = model(Pelanggan::class);

        $filter['username'] = ($post['username'] !== $user->username) ? true : false;
        $filter['email'] = ($post['email'] !== $user->email) ? true : false;

        if ($filter['username'] || $filter['email']) {
            $rules = $this->validationRules($post, $filter);
            if (!$this->validate($rules)) return redirect()->back()->withInput()->with('validation', $this->validator->getErrors());
        }

        if ($filter['email']) {

            if( $this->authorize->inGroup('Pelanggan', $this->auth->user()->id)){
                $PelangganModel->update($id, [
                    'nama' => $post['name'],
                    'email' => ($post['email']) ? $post['email'] : NULL,
                    'no_telepon' => $post['phone'],
                ]);
            }

            $UserModel = model(UserModel::class);
            $user = $UserModel->find($user->id);
            $user->email = ($post['email']) ? $post['email'] : NULL;
            $user->username = ($post['username']) ? $post['username'] : NULL;
            $UserModel->save($user);
        }

        return redirect()->back()->with('success_message', 'perubahan berhasil tersimpan');
    }

    private function validationRules($post, $filter = ['username' => false, 'email' => false])
    {
        if ($filter['username']) {
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
            ];
        }

        if ($post['email'] && $filter['email']) {
            $rules['email'] = [
                'rules'  => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required'      => 'Email harus diisi.',
                    'valid_email'   => 'Format email tidak valid',
                    'is_unique'     => 'Email ini sudah terdaftar'
                ]
            ];
        }

        return $rules;
    }
}
