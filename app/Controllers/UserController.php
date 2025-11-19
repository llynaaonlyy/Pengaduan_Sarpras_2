<?php

namespace App\Controllers;
use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('user', $data);
    }

    public function update()
    {
        $model = new UserModel();
        $id = $this->request->getPost('id_user'); 
        $data = [
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'username'      => $this->request->getPost('username'),
            'role'          => $this->request->getPost('role'),
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $model->update($id, $data);

        return redirect()->to('/user')->with('success', 'Data user berhasil diperbarui!');
    }

        public function simpan()
    {
        $model = new UserModel();

        $data = [
            'id_user' => $this->request->getPost('id_user'),
            'nama_pengguna' => $this->request->getPost('nama_pengguna'),
            'username' => $this->request->getPost('username'),
            'password' => $this->request->getPost('password'), 
            'role' => $this->request->getPost('role'),
        ];

        if ($model->insert($data)) {
            return $this->response->setJSON(['status' => 'success']);
        } else {
            return $this->response->setJSON(['status' => 'error']);
        }
    }

    public function delete($id)
    {
        $model = new UserModel();
        $model->delete($id);
        return redirect()->to('/user')->with('success', 'Data user berhasil dihapus!');
    }
}

