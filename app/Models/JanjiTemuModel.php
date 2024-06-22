<?php

namespace App\Models;

use CodeIgniter\Model;

class JanjiTemuModel extends Model
{
    protected $table = 'janji_temu';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'dosen_id',
        'mahasiswa_id',
        'tanggal',
        'waktu',
        'tempat',
        'keterangan',
        'status',
        'created_at',
        'updated_at'
    ];
    public function getJanjiTemuWithMahasiswa()
    {
        return $this->db->table($this->table)
                        ->select('janji_temu.*, mahasiswa.username AS username_mahasiswa')
                        ->join('mahasiswa', 'mahasiswa.id = janji_temu.mahasiswa_id')
                        ->get()
                        ->getResultArray();
    }
   
}
