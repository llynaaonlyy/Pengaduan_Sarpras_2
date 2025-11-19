<?php

namespace App\Controllers;
use App\Models\PengaduanModel;
use CodeIgniter\I18n\Time;

class PengaduanPetugas extends BaseController
{
    protected $pengaduanModel;

    public function __construct()
    {
        $this->pengaduanModel = new PengaduanModel();
    }

    // Tampilkan daftar pengaduan
    public function index()
    {
        $data['pengaduan'] = $this->pengaduanModel
            ->select('id_pengaduan, nama_pengaduan, deskripsi, lokasi, foto, status, tgl_pengajuan')
            ->orderBy('tgl_pengajuan', 'DESC')
            ->findAll();

        return view('petugas/pengaduan_list', $data);
    }

    // Lihat detail pengaduan tertentu
   public function detail($id_pengaduan)
{
    $data['pengaduan'] = $this->pengaduanModel
        ->select('
            pengaduan.id_pengaduan,
            pengaduan.nama_pengaduan,
            pengaduan.deskripsi,
            pengaduan.lokasi,
            temporary_item.nama_barang_baru AS kategori,
            pengaduan.foto,
            pengaduan.status,
            pengaduan.saran_petugas,
            pengaduan.tgl_selesai
        ')
        ->join('temporary_item', 'temporary_item.id_item = pengaduan.id_item', 'left')
        ->find($id_pengaduan);

    if (!$data['pengaduan']) {
        throw new \CodeIgniter\Exceptions\PageNotFoundException('Data tidak ditemukan');
    }

    return view('petugas/pengaduan_detail', $data);
}

    // Update status dan saran petugas
    public function update($id_pengaduan)
    {
        $status = $this->request->getPost('status');
        $saran = $this->request->getPost('saran_petugas');

        $updateData = [
            'status' => $status,
            'saran_petugas' => $saran
        ];

        // Jika status = Selesai → isi tanggal selesai otomatis hari ini
        if ($status === 'Selesai') {
            $updateData['tgl_selesai'] = Time::now('Asia/Jakarta')->toDateString();
        }

        $this->pengaduanModel->update($id_pengaduan, $updateData);

        return redirect()->to('/pengaduan_petugas')->with('success', 'Pengaduan berhasil diperbarui!');
    }
}