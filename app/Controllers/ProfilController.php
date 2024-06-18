<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfilController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel(); // Memanggil UserModel

        $user_id = session()->get('user_id');
        $user = $userModel->find($user_id);

        // Verifikasi IP address
        if ($this->request->getIPAddress() !== $user['ip_address']) {
            echo "<script>alert('Akun ini telah login diperangkat lain !'); window.location.href = '/';</script>";
            return false;
        }

        return view('profil');
    }
}
