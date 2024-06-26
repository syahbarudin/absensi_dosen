<?php

namespace App\Models;

use CodeIgniter\Model;

class DosenModel extends Model
{
    protected $table = 'dosen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password', 'ip_address', 'device_info', 'last_login', 'last_device_info'];
    public function getDosens($perPage, $page)
    {
        return $this->paginate($perPage, 'group1', $page);
    }
}
