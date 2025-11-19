<?php

namespace App\Controllers;
use App\Models\PengaduanModel;

class AdminHistoriController extends BaseController
{
    public function index()
    {
        $model = new PengaduanModel();
        $data['pengaduan'] = $model->findAll();
        return view('histori_admin', $data);
    }

    public function delete($id)
{
    $model = new PengaduanModel();

    // menghapus berdasarkan id_pengaduan
    $model->delete($id);

    return redirect()->to('/histori_admin')->with('success', 'Histori berhasil dihapus.');
}

}
