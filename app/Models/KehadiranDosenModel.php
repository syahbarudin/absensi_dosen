<?php
namespace App\Models;

use CodeIgniter\Model;

class KehadiranDosenModel extends Model
{
    protected $table = 'kehadiran_dosen';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dosen_id', 'tanggal', 'status'];
}
