<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'username', 
        'password', 
        'device_info', 
        'last_login', 
        'created_at', 
        'last_device_info', 
        'ip_address', 
        'profile_image'
    ];
}
