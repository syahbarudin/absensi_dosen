<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'ip_address', 'device_info', 'last_login', 'last_device_info'];
}
