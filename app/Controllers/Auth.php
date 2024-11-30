<?php namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;
 
class Auth extends Controller
{
    private $userModel;
    function __construct()
    {
        date_default_timezone_set('Asia/Jakarta');
        $this->userModel = new User();
    } 

    public function index()
    {
        helper(['form']);
        echo view('auth/login');
    } 

    public function profile($id)
    {
        helper(['form']);
        $model = $this->userModel;
        $data['user'] = $model->find($id)->first();
        echo view('auth/profile', $data);
    }

    
    public function login()
    {
        $session = session();
        $model = $this->userModel;
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'nama'          => $data['nama'],
                    'email'         => $data['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/');
            }else{
                return redirect()->to('/login')->with('error', 'Wrong Password');
            }
        }else{
            return redirect()->to('/login')->with('error', 'Email not Found');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
} 