<?php

namespace App\Models;

use CodeIgniter\Model;

class BiodataMahasiswaModel extends Model
{
    protected $table = 'biodata_mahasiswa';
    protected $primaryKey = 'mahasiswa_id';
    protected $allowedFields = ['mahasiswa_id', 'nama_lengkap', 'email', 'alamat', 'telepon'];

    public function getBiodata($mahasiswa_id)
    {
        return $this->where('mahasiswa_id', $mahasiswa_id)->first();
    }
}
