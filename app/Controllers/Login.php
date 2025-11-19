<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Login extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login_action()
    {
        $session = session();
        $userModel = new UserModel();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();

        if ($user) {
            // Karena password tidak di-hash, maka langsung dibandingkan biasa
            if ($password === $user['password']) {
                // Set session
                $session = session();
                $session->set([
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'logged_in' => true
                ]);
                
                // Arahkan berdasarkan role
                switch ($user['role']) {
                    case 'Admin':
                        return redirect()->to('/dashboard_admin');
                    case 'Petugas':
                        return redirect()->to('/dashboard_petugas');
                    case 'Guru':
                    case 'Siswa':
                        return redirect()->to('/dashboard');
                    default:
                        $session->setFlashdata('error', 'Role tidak dikenal!');
                        return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('error', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username tidak ditemukan!');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}