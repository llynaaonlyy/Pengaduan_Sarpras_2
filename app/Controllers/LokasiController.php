<?php

namespace App\Controllers;
use App\Models\LokasiModel;

class LokasiController extends BaseController
{
    public function index()
    {
        $model = new LokasiModel();
        $data['lokasi'] = $model->findAll();
        return view('lokasi', $data);
    }

    public function simpan()
{
    $model = new LokasiModel();

    $data = [
        'id_lokasi' => $this->request->getPost('id_lokasi'),
        'nama_lokasi' => $this->request->getPost('nama_lokasi'),
    ];

    if ($model->insert($data)) {
        return $this->response->setJSON(['status' => 'success']);
    } else {
        return $this->response->setJSON(['status' => 'error']);
    }
}

    public function update()
    {
        $model = new LokasiModel();
        $id = $this->request->getPost('id_lokasi');

        $data = [
            'nama_lokasi' => $this->request->getPost('nama_lokasi'),
        ];

        $model->update($id, $data);

        return redirect()->to('/lokasi')->with('success', 'Data lokasi berhasil diperbarui!');
    }

    public function delete($id)
    {
        $model = new LokasiModel();
        $model->delete($id);
        return redirect()->to('/lokasi')->with('success', 'Data lokasi berhasil dihapus!');
    }
}