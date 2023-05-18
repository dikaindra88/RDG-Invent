<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Auth extends BaseController
{
    public function __construct()
    {
        $this->UsersModel = new UsersModel();
        helper('form');
    }
    public function index()
    {
        if (session()->get('name') == True) {
            return view('V_login');
        } else {
            return redirect()->to('/Dashboard');
        }
    }
    public function cek_login()
    {
        $validate = $this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} must be insert !!',
                    'valid_email' => 'Harus format email!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} must be insert !!',
                ],
            ]
        ]);
        if (!$validate) {
            return view('V_login', ['validation' => $this->validator]);
        }
        // valid
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $passwordx = md5($password);
        $cek_login = $this->UsersModel->login_user($email, $passwordx);
        if ($cek_login) {
            session()->set('name', $cek_login['name']);
            session()->set('email', $cek_login['email']);
            session()->set('status', $cek_login['status']);
            session()->set('user_id', $cek_login['user_id']);

            return redirect()->to(base_url('/Dashboard'));
        } else {
            session()->setFlashdata('pesan', 'Email atau Password salah..!!!');
            return redirect()->to(base_url('/'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        session()->setFlashdata('logout', 'Berhasil Logout');
        return redirect()->to(base_url('/'));
    }
}
