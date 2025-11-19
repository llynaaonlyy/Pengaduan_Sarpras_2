<?php

namespace App\Models;
use CodeIgniter\Model;

class ManajemenUserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama_pengguna', 'username', 'password'];
}