<?php namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;
use Myth\Auth\Models\UserModel;
use Myth\Auth\Password;

class Auth extends Controller
{
    private $config, $auth;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->config = config('Auth');
        $this->auth = service('authentication');
    } 
    
    public function index()
    {
        $data['config'] = $this->config;
        return view('auth/login', $data);
    }

    public function generateTokenForUser()
    {
        return bin2hex(random_bytes(16));
    }

    public function resetPassword()
    {
        $validation = service('validation');
        $post = $this->request->getPost();

        if (!$this->auth->check()) return view('errors/html/error_404');
        $user = $this->auth->user();

        if (!$validation->run($post, 'resetPassword'))
            return redirect()->back()->withInput()->with('errors', $validation->listErrors());

        if (!Password::verify($post['current_password'], $user->password_hash))
            return redirect()->back()->withInput()->with('error', 'Password lama tidak cocok');

        $model = model(UserModel::class);
        
        $model->logResetAttempt(
            $user->email,
            $this->generateTokenForUser(),
            $this->request->getIPAddress(),
            (string) $this->request->getUserAgent()
        );

        $newHashPassword = Password::hash($post['password']);

        $userModel = $model->where('id', $user->id)->first();
        $userModel->password_hash = $newHashPassword;
        $userModel->reset_at = date('Y-m-d H:i:s');
        $model->save($userModel);

        return redirect()->back()->with('success_message', 'Berhasil mengubah kata sandi');
    }
    
} 