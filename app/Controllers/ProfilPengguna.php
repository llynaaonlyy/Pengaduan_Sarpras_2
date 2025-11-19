<?php

namespace App\Controllers;

use App\Models\UserModel;

class ProfilPengguna extends BaseController
{
    public function index()
    {
        // Ambil user yang sedang login
        $session = session();
        $username = $session->get('username');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return redirect()->to('/dashboard_admin')->with('error', 'Data user tidak ditemukan');
        }

        return view('profil_pengguna', ['user' => $user]);
    }

    public function update()
    {
        $session = session();
        $username = $session->get('username');

        $userModel = new UserModel();

        $data = [
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'username'      => $this->request->getPost('username'),
            'password'      => $this->request->getPost('password'), 
        ];

        $userModel->where('username', $username)->set($data)->update();

        $session->set('username', $data['username']);

        return redirect()->to('/profil_pengguna')->with('success', 'Profil berhasil diperbarui!');
    }
}