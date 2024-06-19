<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\JanjiTemuModel;

class JanjiTemuController extends BaseController
{
    protected $janjiTemuModel;

    public function __construct()
    {
        $this->janjiTemuModel = new JanjiTemuModel();
    }

    public function index()
    {
        $data['janjiTemuList'] = $this->janjiTemuModel->getAllJanjiTemu();
        
        // Load view janji_temu.php with data
        return view('Mahasiswa/janji_temu', $data);
    }

    public function create()
    {
        $janjiTemuModel = new JanjiTemuModel();

        $data = [
            'dosen_id' => $this->request->getPost('dosen_id'),
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $this->request->getPost('waktu'),
            'tempat' => $this->request->getPost('tempat'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => 'Menunggu',
        ];

        $janjiTemuModel->insert($data);

        return redirect()->to('absen_dosen');
    }
}
