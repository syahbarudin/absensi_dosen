<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;
use App\Models\AbsensiModel;

class DosenController extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenModel();
        $dosen_id = session()->get('dosen_id');
        $dosen = $dosenModel->find($dosen_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $dosen['ip_address']) {
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
        return view('Dosen/dosen', [
            'greeting' => $greeting,
            'username' => $username,
            'title' => 'Dosen',
            'is_auth_page' => false
        ]);
    }

}

