<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\UserModel;

class ProfilController extends BaseController
{
    public function index()
    {
        $userModel = new MahasiswaModel(); // Memanggil UserModel

        $mahasiswa_id = session()->get('mahasiswa_id');
        $mahasiswa_id = $userModel->find($mahasiswa_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $mahasiswa_id['ip_address']) {
            echo "<script>alert('Akun ini telah login diperangkat lain !'); window.location.href = '/';</script>";
            return false;
        }

        return view('Mahasiswa/profil');
    }
}
