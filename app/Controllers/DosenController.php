<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AbsensiModel;

class DosenController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        $user_id = session()->get('user_id');
        $user = $userModel->find($user_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $user['ip_address']) {
            echo "<script>alert('Akun ini telah login dari perangkat lain!'); window.location.href = '/';</script>";
            return false;
        }

        // Mengatur zona waktu untuk wilayah Indonesia
        date_default_timezone_set('Asia/Jakarta');
        $login_time = date('H:i');
        $username = session()->get('username');

        // Tentukan ucapan selamat berdasarkan waktu login
        if ($login_time >= '00:00' && $login_time < '10:00') {
            $greeting = 'Selamat pagi';
        } elseif ($login_time >= '10:00' && $login_time < '14:00') {
            $greeting = 'Selamat siang';
        } elseif ($login_time >= '14:00' && $login_time < '18:00') {
            $greeting = 'Selamat sore';
        } elseif ($login_time >= '18:00' && $login_time < '24:00') {
            $greeting = 'Selamat malam';
        } else {
            $greeting = 'Selamat';
        }

        // Tampilkan halaman home dengan menyertakan ucapan selamat dan nama pengguna
        return view('dosen', [
            'greeting' => $greeting,
            'username' => $username,
            'title' => 'Dosen',
            'is_auth_page' => false
        ]);
    }

    public function absen()
    {
        // Ambil data dari request POST
        $request = $this->request->getJSON();
        $tanggal = $request->tanggal;
        $userId = session()->get('user_id');
        $waktu = $request->waktu;
        $lokasi = $request->lokasi;

        // Validasi input (jika diperlukan)
        // $validation = \Config\Services::validation();
        // $validation->setRules([
        //     'tanggal' => 'required',
        //     'waktu' => 'required',
        //     'lokasi' => 'required'
        // ]);
        // if (!$validation->run($request)) {
        //     return $this->response->setStatusCode(400)->setJSON(['error' => $validation->getErrors()]);
        // }

        // Simpan data absen ke dalam database
        $absensiModel = new AbsensiModel();
        $data = [
            'user_id' => $userId,
            'tanggal' => $tanggal,
            'waktu' => $waktu,
            'lokasi' => $lokasi
            // Tambahan kolom lain sesuai kebutuhan
        ];

        // Lakukan penyimpanan data
        $absensiModel->insert($data);

        // Berikan respons ke client
        return $this->response->setJSON(['status' => 'success']);
    }
}

