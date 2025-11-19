<?php

namespace App\Controllers;

use App\Models\ListLokasiModel;

class ListLokasiController extends BaseController
{
    // Halaman utama: tampilkan semua data
    public function index()
    {
        $model = new ListLokasiModel();
        $data['list_lokasi'] = $model->findAll();
        return view('list_lokasi', $data);
    }

    public function tambah()
{
    $model = new ListLokasiModel();
    $data['list_lokasi'] = $model->findAll();
    return view('list_lokasi', $data);
}

    public function simpan()
{
    $model = new ListLokasiModel();
    $data = [
        'id_lokasi' => $this->request->getPost('id_lokasi'),
        'id_item'   => $this->request->getPost('id_item')
    ];

    if ($model->save($data)) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON(['status' => 'error']);
    }
}

    public function update()
    {
        $id = $this->request->getPost('id_list');
        $model = new ListLokasiModel();
        $model->update($id, [
            'id_lokasi' => $this->request->getPost('id_lokasi'),
            'id_item'   => $this->request->getPost('id_item')
        ]);

        session()->setFlashdata('success', 'Data list lokasi berhasil diperbarui!');
        return redirect()->to('/list_lokasi');
    }

    public function delete($id)
    {
        $model = new ListLokasiModel();
        $model->delete($id);

        session()->setFlashdata('success', 'Data list lokasi berhasil dihapus!');
        return redirect()->to('/list_lokasi');
    }
}