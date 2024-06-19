<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class D_ProfilController extends BaseController
{
    public function index()
    {
        $dosenModel = new DosenModel(); // Memanggil UserModel

        $dosen_id = session()->get('dosen_id');
        $dosen = $dosenModel->find($dosen_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $dosen   ['ip_address']) {
            echo "<script>alert('Akun ini telah login diperangkat lain !'); window.location.href = '/';</script>";
            return false;
        }

        return view('Dosen/d_profil');
    }
}
