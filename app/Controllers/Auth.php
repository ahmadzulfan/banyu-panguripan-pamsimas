<?php namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;
 
class Auth extends Controller
{
    public function index()
    {
        helper(['form']);
        echo view('pages/login/login');
    } 
 
    public function login()
    {
        $session = session();
        $model = new User();
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
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
} 