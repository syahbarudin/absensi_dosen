<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\DosenModel;
use App\Models\AbsensiModel;
use App\Models\JanjiTemuModel;
use App\Models\MahasiswaModel;

class StatusController extends BaseController
{
    public function index()
    {
        $mahasiswaModel = new MahasiswaModel(); // Memanggil UserModel

        $mahasiswa_id = session()->get('mahasiswa_id');
        $mahasiswa = $mahasiswaModel->find($mahasiswa_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $mahasiswa ['ip_address']) {
            echo "<script>alert('Akun ini telah login diperangkat lain !'); window.location.href = '/';</script>";
            return false;
        }

        $dosenModel = new DosenModel();
        $absensiModel = new AbsensiModel();
        $janjiTemuModel = new JanjiTemuModel();

        $dosens = $dosenModel->findAll();
        $tanggal = date('Y-m-d');

        foreach ($dosens as &$dosen) {
            $absensi = $absensiModel->where('dosen_id', $dosen['id'])
                                    ->where('tanggal', $tanggal)
                                    ->first();
            $dosen['status'] = $absensi ? 'Hadir' : 'Tidak Hadir';
            $janjiTemu = $janjiTemuModel->where('dosen_id', $dosen['id'])
                                        ->where('mahasiswa_id', $mahasiswa_id)
                                        ->first();
            $dosen['janji_temu_status'] = $janjiTemu ? $janjiTemu['status'] : 'Belum ada janji temu';
        }

        return view('Mahasiswa/absen_status',['dosens' => $dosens]);
    }
}
