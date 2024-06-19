<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AbsensiModel;

class AbsenController extends BaseController
{
    protected $absensiModel;

    public function __construct()
    {
        $this->absensiModel = new AbsensiModel();
    }

    public function absen()
    {
        $dosen_id = session()->get('dosen_id');
        $username = session()->get('username');

        // Periksa absensi terakhir dosen hari ini
        $lastAbsensi = $this->absensiModel->getLastAbsensiByDosenToday($dosen_id);

        if ($lastAbsensi) {
            // Jika sudah absen hari ini, beri pesan error
            return $this->response->setJSON(['status' => 'error', 'message' => 'Anda sudah melakukan absen hari ini.']);
        }

        // Jika belum absen hari ini, lanjutkan proses absen
        $tanggal = date('Y-m-d');
        $waktu = date('H:i:s');
        $lokasi = $this->request->getJSON()->lokasi;

        $data = [
            'dosen_id' => $dosen_id,
            'username' => $username,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'lokasi' => $lokasi
        ];

        // Simpan data absensi baru
        $inserted = $this->absensiModel->insert($data);
        if ($inserted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Absensi berhasil dicatat.']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menyimpan absensi.']);
        }
    }
    
}
