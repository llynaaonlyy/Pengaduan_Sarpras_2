<?php

namespace App\Controllers;

use App\Models\LaporanModel;
use App\Models\PengaduanModel;

class Laporan extends BaseController
{
    public function index()
    {
        $laporanModel = new LaporanModel();

        $laporanList = $laporanModel
            ->orderBy('id_laporan', 'DESC')
            ->findAll();

        return view('admin/laporan_dashboard', [
            'laporan' => $laporanList
        ]);
    }

    public function filter()
    {
        $start = $this->request->getGet('start');
        $end   = $this->request->getGet('end');

        if (!$start || !$end) {
            return redirect()->to('/admin/laporan');
        }

        $pengaduanModel = new PengaduanModel();

        $dataPengaduan = $pengaduanModel
            ->where('tgl_pengajuan >=', $start)
            ->where('tgl_pengajuan <=', $end)
            ->orderBy('tgl_pengajuan', 'DESC')
            ->findAll();

        return view('admin/laporan_filter', [
            'start' => $start,
            'end'   => $end,
            'dataPengaduan' => $dataPengaduan
        ]);
    }

    public function create()
    {
        $start = $this->request->getPost(index: 'start');
        $end   = $this->request->getPost('end');

        if (!$start || !$end) {
            return redirect()->to('/admin/laporan');
        }

        $laporanModel = new LaporanModel();
        $laporanModel->insert([
            'tanggal_awal'   => $start,
            'tanggal_akhir'  => $end,
            'dibuat_pada'=> date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin/laporan')->with('success', 'Laporan berhasil dibuat!');
    }

    public function detail($id)
    {
        $laporanModel   = new LaporanModel();
        $pengaduanModel = new PengaduanModel();

        $laporan = $laporanModel->find($id);

        if (!$laporan) {
            return redirect()->to('/admin/laporan');
        }

        $pengaduan = $pengaduanModel
        ->where('tgl_pengajuan >=', $laporan['tanggal_awal'])
        ->where('tgl_pengajuan <=', $laporan['tanggal_akhir'])
        ->orderBy('tgl_pengajuan', 'DESC')
        ->findAll();

        return view('admin/laporan_detail', [
            'laporan' => $laporan,
            'pengaduan' => $pengaduan
        ]);
    }

    public function delete($id)
    {
        $laporanModel = new LaporanModel();

        if ($laporanModel->find($id)) {
            $laporanModel->delete($id);
            return redirect()->to('/admin/laporan')->with('success', 'Laporan berhasil dihapus!');
        }

        return redirect()->to('/admin/laporan')->with('error', 'Laporan tidak ditemukan.');
    }
}