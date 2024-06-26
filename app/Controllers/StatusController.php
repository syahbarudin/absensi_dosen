<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\AbsensiModel;
use App\Models\JanjiTemuModel;
use App\Models\MahasiswaModel;

class StatusController extends BaseController
{
    protected $dosenModel;
    protected $absensiModel;
    protected $janjiTemuModel;
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->absensiModel = new AbsensiModel();
        $this->janjiTemuModel = new JanjiTemuModel();
        $this->mahasiswaModel = new MahasiswaModel();
    }

    public function index()
    {
        $mahasiswa_id = session()->get('mahasiswa_id');
        $mahasiswa = $this->mahasiswaModel->find($mahasiswa_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $mahasiswa['ip_address']) {
            echo "<script>alert('Akun ini telah login diperangkat lain !'); window.location.href = '/';</script>";
            return false;
        }

        // Setup pagination
        $perPage = 20;
        $page = $this->request->getGet('page') ?? 1;

        // Ambil data dosen dengan pagination
        $dosens = $this->dosenModel->paginate($perPage, 'group1', $page);
        $pager = $this->dosenModel->pager;

        foreach ($dosens as &$dosen) {
            // Cek kehadiran dosen pada tanggal tertentu
            $absensi = $this->absensiModel->where('dosen_id', $dosen['id'])
                                          ->where('tanggal', date('Y-m-d'))
                                          ->first();
            $dosen['status'] = $absensi ? 'Hadir' : 'Tidak Hadir';

            // Cek status janji temu antara mahasiswa dan dosen
            $janjiTemu = $this->janjiTemuModel->where('dosen_id', $dosen['id'])
                                              ->where('mahasiswa_id', $mahasiswa_id)
                                              ->first();
            $dosen['janji_temu_status'] = $janjiTemu ? $janjiTemu['status'] : 'Belum ada janji temu';
        }

        return view('Mahasiswa/absen_status', ['dosens' => $dosens, 'pager' => $pager]);
    }
}
