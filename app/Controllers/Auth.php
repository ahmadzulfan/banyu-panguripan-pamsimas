<?php namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;
use Myth\Auth\Models\UserModel;

class Auth extends Controller
{
    private $userModel, $config, $auth;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->config = config('Auth');
        $this->auth = service('authentication');
        $this->userModel = new UserModel();
    } 
    
    public function index()
    {
        $data['config'] = $this->config;
        return view('auth/login', $data);
    }
   
    public function update($id)
    {
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email')
        ];

        $this->userModel->where('id', $id)->set($data)->update();
       
        
        return redirect()->to('auth/profile');
    }
    
} 