<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ItemModel;
use App\Models\LokasiModel;
use App\Models\ListLokasiModel;
use App\Models\PengaduanModel;
use App\Models\LaporanModel;

class DashboardAdmin extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $itemModel = new ItemModel();
        $lokasiModel = new LokasiModel();
        $listLokasiModel = new ListLokasiModel();
        $pengaduanModel = new PengaduanModel();
        $laporanModel = new LaporanModel();

        $data = [
            'jumlah_user' => $userModel->countAll(),
            'jumlah_item' => $itemModel->countAll(),
            'jumlah_lokasi' => $lokasiModel->countAll(),
            'jumlah_list_lokasi' => $listLokasiModel->countAll(),
            'jumlah_pengaduan' => $pengaduanModel->countAll(),
            'jumlah_laporan' => $laporanModel->countAll(),
        ];

        return view('dashboard_admin', $data);
    }
}