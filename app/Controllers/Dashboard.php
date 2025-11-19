<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\LokasiModel;
use App\Models\ItemModel;
use App\Models\PengaduanModel;
use App\Models\TemporaryItemModel;
use App\Models\RatingModel;


class Dashboard extends Controller
{
    public function index()
    {
        $session = session();

        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $user = $session->get();

        $lokasiModel = new LokasiModel();
        $itemModel = new ItemModel();
        $pengaduanModel = new PengaduanModel();


        $id_user = $user['id_user'];

        $jumlah_pengaduan = $pengaduanModel->where('id_user', $id_user)->countAllResults();
        $jumlah_histori   = $pengaduanModel->where('id_user', $id_user)
                                            ->where('status', 'selesai')
                                            ->countAllResults();

        $data = [
            'user' => $user,
            'jumlah_pengaduan' => $jumlah_pengaduan,
            'jumlah_histori'   => $jumlah_histori
        ];

        return view('dashboard', $data);
    }

    public function pengaduan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $lokasiModel = new LokasiModel();
        $itemModel   = new ItemModel();
        $pengaduanModel = new PengaduanModel();

        if ($this->request->getMethod() === 'post') {
            $data = [
                'id_user' => session()->get('id_user'),
                'nama_pengaduan' => $this->request->getPost('nama_pengaduan'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'lokasi' => $this->request->getPost('lokasi'),
                'status' => 'Diajukan',
                'tgl_pengajuan' => date('Y-m-d H:i:s')
            ];

            // Cek file foto
        $file = $this->request->getFile('foto');
    if ($file && $file->isValid() && !$file->hasMoved()) {
        $namaFoto = $file->getRandomName();
        $file->move('uploads/pengaduan', $namaFoto);

        $data['nama_foto'] = $namaFoto; 
    }

            // Simpan ke database
            $pengaduanModel->insert($data);
            return redirect()->to('/dashboard')->with('success', 'Pengaduan berhasil dikirim!');
        }

        $data['lokasi'] = $lokasiModel->findAll();
        $data['items']  = $itemModel->findAll();

        return view('pengaduan', $data);
    }

    public function simpan_pengaduan()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        $id_user = session()->get('id_user');
        if (!$id_user) {
            return redirect()->to('/login')->with('error', 'Session login tidak ditemukan.');
        }

        $pengaduanModel = new PengaduanModel();
        $temporaryModel = new TemporaryItemModel();

        $id_item        = $this->request->getPost('id_item');
        $nama_pengaduan = $this->request->getPost('nama_pengaduan');
        $deskripsi      = $this->request->getPost('deskripsi');
        $lokasi         = $this->request->getPost('id_lokasi');

        //Upload foto 
        $file = $this->request->getFile('foto');
        $namaFile = null;

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $namaFile = $file->getRandomName();
            $file->move($uploadPath, $namaFile);
        }

    //Jika pilih kategori "lain" 
    if ($id_item == 'lain') {
        $nama_item_baru   = $this->request->getPost('nama_item_baru');
        $lokasi_item_baru = $this->request->getPost('lokasi_item_baru');

        // Simpan item baru ke temporary_item
        $temporaryModel->insert([
        'nama_barang_baru'   => $nama_item_baru,
        'lokasi_barang_baru' => $lokasi_item_baru,
    ]);


        $data = [
            'id_user'        => $id_user,
            'id_item'        => null,
            'nama_pengaduan' => $nama_pengaduan ?? $nama_item_baru,
            'lokasi'         => $lokasi_item_baru, 
            'foto'           => $namaFile,
            'status'         => 'Diajukan',
            'tgl_pengajuan'  => date('Y-m-d H:i:s'),
            'id_petugas'     => 1
        ];
    } else {
            //Kalau kategori sudah tersedia 
            $data = [
                'id_user'        => $id_user,
                'id_item'        => $id_item,
                'nama_pengaduan' => $nama_pengaduan,
                'deskripsi'      => $deskripsi,
                'lokasi'         => $lokasi,
                'foto'           => $namaFile,
                'status'         => 'Diajukan',
                'tgl_pengajuan'  => date('Y-m-d H:i:s'),
                'id_petugas'     => 1
            ];
        }

        // Simpan data pengaduan 
        if ($pengaduanModel->insert($data)) {
            return redirect()->to('/dashboard/pengaduan')->with('success', 'Pengaduan anda berhasil diajukan.');
        } else {
            return redirect()->to('/dashboard/pengaduan')->with('error', 'Pengaduan anda gagal diajukan.');
        }
    }

    public function getItems($id_lokasi)
    {
        // pastikan gunakan DB builder 
        $db = \Config\Database::connect();

        $builder = $db->table('list_lokasi');
        $builder->select('items.id_item, items.nama_item');
        $builder->join('items', 'list_lokasi.id_item = items.id_item', 'left');
        $builder->where('list_lokasi.id_lokasi', $id_lokasi);
        $query = $builder->get();

        $items = $query->getResultArray(); //array data pengaduan

        return $this->response->setJSON($items);
    }

    public function histori()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $id_user = session()->get('id_user');
        
        if (!$id_user) {
            return redirect()->to('/login');
        }

        $pengaduanModel = new PengaduanModel();
        
        try {
            //QUERY MENAMPILKAN DATA PENGADUAN BERDASARKAN ID USER YANG LOGIN
            $db = db_connect();
            $query = $db->query("SELECT pengaduan.*, items.nama_item, lokasi.nama_lokasi 
                                FROM pengaduan 
                                LEFT JOIN items ON items.id_item = pengaduan.id_item 
                                LEFT JOIN lokasi ON lokasi.id_lokasi = pengaduan.lokasi 
                                WHERE pengaduan.id_user = ? 
                                ORDER BY pengaduan.tgl_pengajuan DESC", [$id_user]);
            $riwayat = $query->getResultArray();

            return view('histori', [
                'pengaduan' => $riwayat
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Error pada histori: ' . $e->getMessage());
            return view('histori', ['pengaduan' => []]);
        }
    }
}