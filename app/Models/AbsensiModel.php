<?php
namespace App\Models;

use CodeIgniter\Model;

class AbsensiModel extends Model
{
    protected $table = 'absensi';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dosen_id', 'username', 'tanggal', 'waktu', 'lokasi'];

    public function getLastAbsensiByDosenToday($dosen_id)
    {
        return $this->where('dosen_id', $dosen_id)
                    ->where('tanggal', date('Y-m-d'))
                    ->orderBy('waktu', 'DESC')
                    ->first();
    }
}
