<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MahasiswaModel;
use App\Models\BiodataMahasiswaModel;

class ProfilController extends BaseController
{
    protected $mahasiswaModel;
    protected $biodataMahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->biodataMahasiswaModel = new BiodataMahasiswaModel();
    }

    public function index()
    {
        $mahasiswa_id = session()->get('mahasiswa_id');
        $mahasiswa = $this->mahasiswaModel->find($mahasiswa_id);
        $biodata = $this->biodataMahasiswaModel->getBiodata($mahasiswa_id);

        if (!$mahasiswa) {
            return redirect()->to('/')->with('error', 'Mahasiswa tidak ditemukan');
        }

        if (!$biodata) {
            $biodata = [
                'nama_lengkap' => '',
                'email' => '',
                'alamat' => '',
                'telepon' => '',
            ];
        }

        return view('Mahasiswa/profil', ['mahasiswa' => $mahasiswa??[], 'biodata' => $biodata??[]]);
    }

    public function edit_profile()
    {
        $mahasiswa_id = session()->get('mahasiswa_id');
        $mahasiswa = $this->mahasiswaModel->find($mahasiswa_id);
        $biodata = $this->biodataMahasiswaModel->getBiodata($mahasiswa_id);

        if (!$mahasiswa) {
            return redirect()->to('/')->with('error', 'Mahasiswa tidak ditemukan');
        }

        if (!$biodata) {
            $biodata = [
                'nama_lengkap' => '',
                'email' => '',
                'alamat' => '',
                'telepon' => '',
            ];
        }
        return view('Mahasiswa/edit_profile', ['mahasiswa' => $mahasiswa, 'biodata' => $biodata]);
    }

    public function update_profile()
    {
        $mahasiswa_id = session()->get('mahasiswa_id');

        // Validate input
        $validationRules = [
            'username' => 'required|min_length[3]|max_length[50]',
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'email' => 'required|valid_email',
            'alamat' => 'required',
            'telepon' => 'required|min_length[10]|max_length[15]',
            'profile_image' => 'uploaded[profile_image]|max_size[profile_image,1024]|is_image[profile_image]'
        ];

        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $profileImage = $this->request->getFile('profile_image');
        if ($profileImage->isValid() && !$profileImage->hasMoved()) {
            $newName = $profileImage->getRandomName();
            $profileImage->move(ROOTPATH . 'public/uploads/profile/', $newName);
            
            // Delete old profile image if exists
            $oldImage = $this->mahasiswaModel->find($mahasiswa_id)['profile_image'];
            if (!empty($oldImage) && file_exists(ROOTPATH . 'public/uploads/profile/' . $oldImage)) {
                unlink(ROOTPATH . 'public/uploads/profile/' . $oldImage);
            }
        } else {
            return redirect()->back()->withInput()->with('error', $profileImage->getErrorString());
        }

        $dataMahasiswa = [
            'username' => $this->request->getPost('username'),
            'profile_image' => $profileImage->getName(),
        ];

        $dataBiodata = [
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'email' => $this->request->getPost('email'),
            'alamat' => $this->request->getPost('alamat'),
            'telepon' => $this->request->getPost('telepon'),
        ];

        $this->mahasiswaModel->update($mahasiswa_id, $dataMahasiswa);
        if ($this->biodataMahasiswaModel->find($mahasiswa_id)) {
            $this->biodataMahasiswaModel->update($mahasiswa_id, $dataBiodata);
        } else {
            $dataBiodata['mahasiswa_id'] = $mahasiswa_id;
            $this->biodataMahasiswaModel->insert($dataBiodata);
        }
        return redirect()->to('profil')->with('success', 'Profil berhasil diperbarui');
    }
}