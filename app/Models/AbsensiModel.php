<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'tanggal', 'waktu', 'lokasi'];

    // Metode lain yang mungkin Anda tambahkan sesuai kebutuhan aplikasi

    public function getAbsensiByUserId($userId)
    {
        return $this->where('user_id', $userId)->findAll();
    }
}
