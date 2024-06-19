<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\UserModel;


class HomeController extends BaseController
{
    public function index()
    {
        $mahasiswaModel = new MahasiswaModel(); // Memanggil UserModel

        $mahasiswa_id = session()->get('mahasiswa_id');
        $mahasiswa = $mahasiswaModel->find($mahasiswa_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $mahasiswa['ip_address']) {
            echo "<script>alert('Akun ini telah login diperangkat lain !'); window.location.href = '/';</script>";
            return false;
        }
        
        //Mengatur zona waktu untuk region indonesia
        date_default_timezone_set('Asia/Jakarta');
        // Ambil data waktu login dan nama pengguna dari session
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
        return view('home', [
            'greeting' => $greeting,
            'username' => $username,
            'title' => 'Home',
            'is_auth_page' => false
        ]);
    }    
}
