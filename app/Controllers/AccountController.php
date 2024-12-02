<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Pelanggan;
use CodeIgniter\HTTP\ResponseInterface;
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
        $user = $model->where('id_user', $user->id)->asObject()->first();

        $data['user'] = $user;
        return view('auth/profile', $data);
    }

    public function update($id)
    {
        if (!$id) return view('errors/html/error_404');

        if (!$this->auth->check()) return view('errors/html/error_404');

        $user = $this->auth->user();

        $post = $this->request->getPost();

        $PelangganModel = model(Pelanggan::class);
        $PelangganModel->update($id, [
            'nama' => $post['name'],
            'email' => $post['email'],
            'no_telepon' => $post['phone'],
        ]);

        if ($post['email'] !== $user->email) {
            $UserModel = model(UserModel::class);
            $user = $UserModel->find($user->id);
            $user->email = $post['email'];
            $UserModel->save($user);
        }


        return redirect()->back()->with('success_message', 'perubahan berhasil tersimpan');
    }
}
