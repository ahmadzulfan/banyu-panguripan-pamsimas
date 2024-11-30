<?php namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;
 
class Auth extends Controller
{
    public function index()
    {
        return view('auth/login');
    } 

    public function profile()
    {
        $model = new User();
        $data['user'] = $model->findAll();
        echo view('auth/profile');
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
                return redirect()->to('/login')->with('error', 'Wrong Password');
            }
        }else{
            return redirect()->to('/login')->with('error', 'Email not Found');
        }
    }
 
    public function logout()
    {
        session()->remove('id');
        return redirect()->to(site_url('/login'));
    }

    
    public function update($id)
    {
        $model = new User();
        $data = [
            'nama' => $this->request->getPost('nama'),
            'alamat' => $this->request->getPost('alamat'),
            'no_telepon' => $this->request->getPost('no_telepon'),
            'email' => $this->request->getPost('email')
        ];

        $model->where('id', $id)->set($data)->update();
       
        
        return redirect()->to('auth/profile');
    }
    
} 