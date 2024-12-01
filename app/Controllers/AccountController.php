<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

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

        $data['user'] = $this->auth->user();
        return view('auth/profile', $data);
    }
}
