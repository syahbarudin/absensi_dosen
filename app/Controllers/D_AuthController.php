<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DosenModel;

class D_AuthController extends BaseController
{
    public function index()
    {
        $page = $this->request->getGet('page') ?? 'login';
        return view('Dosen/d_auth', ['page' => $page]);
    }

    public function register()
    {
        $model = new DosenModel();

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
        ];

        $model->insert($data);

        return redirect()->to('/d_auth')->with('success', 'User registered successfully.');
    }

    public function login()
    {
        $model = new DosenModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $dosen = $model->where('username', $username)->first();

        if ($dosen && password_verify($password, $dosen['password'])) {
            session()->regenerate();

            $ip_address = $this->request->getIPAddress();
            $device_info = $this->request->getUserAgent();
            $timestamp = date('Y-m-d H:i:s');
            $is_new_device = $device_info !== $dosen['device_info'];
            $is_new_ip = $ip_address !== $dosen['ip_address'];
            
            if ($is_new_device || $is_new_ip) {
                $this->terminatePreviousSession($dosen['id']);
            }

            $data = [
                'ip_address' => $ip_address,
                'device_info' => $device_info,
                'last_login' => $timestamp
            ];

            $model->update($dosen['id'], $data);

            session()->set('dosen_id', $dosen['id']);
            session()->set('username', $dosen['username']);
            session()->set('login_time', date('H:i'));
            session()->set('ip_address', $ip_address);
            session()->set('is_new_device', $is_new_device);

            return redirect()->to('d_home');
        } else {
            return redirect()->to('/d_auth')->with('error', 'Kesalahan username atau password.');
        }
    }

    private function terminatePreviousSession($dosen_id)
    {
        $model = new DosenModel();
        $data = [
            'ip_address' => null,
            'device_info' => null,
        ];

        $model->update($dosen_id, $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/d_auth');
    }

    public function verify_session($dosen_id)
    {
        $model = new DosenModel();
        $dosen = $model->find($dosen_id);

        if ($dosen) {
            $current_ip = $this->request->getIPAddress();
            if ($dosen['ip_address'] !== $current_ip) {
                session()->destroy();
                return false;
            }
            return true;
        }
        return false;
    }
}
