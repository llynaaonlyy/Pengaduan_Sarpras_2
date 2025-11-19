<?php

namespace App\Controllers;

use App\Models\ItemModel;
use CodeIgniter\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $model = new ItemModel();
        $data['items'] = $model->findAll();

        return view('item', $data);
    }
    public function simpan()
    {
        $file = $this->request->getFile('foto');
        $namaFile = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/items/';
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

            $namaFile = $file->getRandomName();
            $file->move($uploadPath, $namaFile);
        }

        $data = [
            'id_item'     => $this->request->getPost('id_item'),
            'nama_item'   => $this->request->getPost('nama_item'),
            'lokasi'      => $this->request->getPost('lokasi'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'foto'        => $namaFile,   // FIX
        ];

        $model = new ItemModel();
        $model->insert($data);

        return $this->response->setJSON(['status' => 'success']);
    }


        public function delete($id)
        {
            $model = new ItemModel();
            $model->delete($id);
            return redirect()->to('/item');
        }

    public function update()
    {
        $model = new ItemModel();
        $id = $this->request->getPost('id_item');

        $data = [
            'nama_item' => $this->request->getPost('nama_item'),
            'lokasi'    => $this->request->getPost('lokasi'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        $file = $this->request->getFile('foto');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $namaFile = $file->getRandomName();
            $file->move(FCPATH . 'uploads/items/', $namaFile);
            $data['foto'] = $namaFile; // simpan foto baru
        }

        $model->update($id, $data);

        return redirect()->to('/item')->with('success', 'Data item berhasil diperbarui!');
    }
}