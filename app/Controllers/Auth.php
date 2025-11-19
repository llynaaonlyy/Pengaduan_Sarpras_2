<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('login');
    }

   public function login_action()
{
    $session = session();
    $model = new UserModel();

    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    $user = $model->where('username', $username)->first();

    if ($user && $user['password'] == $password) { 
        $session->set([
            'id_user' => $user['id_user'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true
        ]);

        if ($user['role'] === 'Admin') {
            return redirect()->to('/dashboard_admin');
        } elseif ($user['role'] === 'Petugas') {
            return redirect()->to('/dashboard_petugas');
        } else {
            return redirect()->to('/dashboard');
        }

    } else {
        $session->setFlashdata('error', 'Username atau password salah.');
        return redirect()->to('/login');
    }
}

    public function register()
    {
        return view('register');
    }

    public function register_action()
    {
        $model = new UserModel();

        $data = [
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'), 
            'role' => $this->request->getPost('role'),
        ];

        if ($model->insert($data)) {
            session()->setFlashdata('success', 'Registrasi berhasil! Silakan login.');
            return redirect()->to('/login');
        } else {
            session()->setFlashdata('error', 'Registrasi gagal, coba lagi.');
            return redirect()->to('/register');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}