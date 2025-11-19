<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table      = 'laporan';
    protected $primaryKey = 'id_laporan';

    protected $allowedFields = [
        'tanggal_awal',
        'tanggal_akhir',
        'dibuat_pada'
    ];
}