<?php
namespace App\Models;

use CodeIgniter\Model;

class PengaduanModel extends Model
{
    protected $table      = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';

    protected $allowedFields = [
        'id_user',
        'id_item',
        'nama_pengaduan',
        'deskripsi',
        'id_lokasi',
        'foto',
        'nama_foto',
        'status',
        'tgl_pengajuan',
        'tgl_selesai',
        'saran_petugas',
        'id_petugas',
        'rating',
        'review'
    ];
    
    public function getPengaduanWithLokasi()
    {
        return $this->select('pengaduan.*, lokasi.nama_lokasi')
                    ->join('lokasi', 'lokasi.id_lokasi = pengaduan.lokasi')
                    ->findAll();
    }
}