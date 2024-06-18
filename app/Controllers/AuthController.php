<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    public function index()
    {
        $page = $this->request->getGet('page') ?? 'login';
        return view('auth', ['page' => $page]);
    }

    public function register()
    {
        $model = new UserModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $model->insert($data);

        return redirect()->to('/')->with('success', 'User registered successfully.');
    }

    public function login()
    {
        $model = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $model->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            session()->regenerate();

            $ip_address = $this->request->getIPAddress(); // Mendapatkan IP Address pengguna
            $device_info = $_SERVER['HTTP_USER_AGENT'];
            $timestamp = date('Y-m-d H:i:s');
            $is_new_device = $device_info !== $user['device_info'];
            $is_new_ip = $ip_address !== $user['ip_address'];
            
            if ($is_new_device || $is_new_ip) {
                // Akhiri sesi sebelumnya
                $this->terminatePreviousSession($user['id']);
            }

            $data = [
                'ip_address' => $ip_address,
                'device_info' => $device_info,
                'last_login' => $timestamp
            ];

            $model->update($user['id'], $data);

            // Simpan data waktu login dan nama pengguna ke dalam session
            session()->set('user_id', $user['id']);
            session()->set('username', $user['username']);
            session()->set('login_time', date('H:i'));
            session()->set('ip_address', $ip_address);
            session()->set('is_new_device', $is_new_device);

            return redirect()->to('home');
        } else {
            return redirect()->to('/')->with('error', 'Kesalahan username atau password.');
        }
    }

    private function terminatePreviousSession($user_id)
    {
        $model = new UserModel();
        $data = [
            'ip_address' => null,
            'device_info' => null,
        ];

        $model->update($user_id, $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    public function verify_session($user_id)
    {
        $model = new UserModel();
        $user = $model->find($user_id);

        if ($user) {
            $current_ip = $this->request->getIPAddress();
            if ($user['ip_address'] !== $current_ip) {
                session()->destroy();
               
                return false;
            }
            return true;
        }
        return false;
    }
}
