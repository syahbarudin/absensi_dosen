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

    public function dosenJanjiTemu()
    {
        $data['janjiTemuList'] = $this->janjiTemuModel->getJanjiTemuWithMahasiswa();
        return view('Dosen/d_janji_temu', $data);
    }

    public function create()
    {
        // kombinasi jam dan menit
        $hour = $this->request->getPost('hour');
        $minute = $this->request->getPost('minute');
        $waktu = $hour . ':' . $minute . ':00'; 

        $data = [
            'dosen_id' => $this->request->getPost('dosen_id'),
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'waktu' => $waktu,
            'tempat' => $this->request->getPost('tempat'),
            'keterangan' => $this->request->getPost('keterangan'),
            'status' => 'Menunggu',
        ];
    
        $this->janjiTemuModel->insert($data);
    
        return redirect()->to('absen_dosen');
    }
    

    public function updateStatus($id, $status)
    {
        $janjiTemu = $this->janjiTemuModel->find($id);

        if ($janjiTemu) {
            $janjiTemu['status'] = $status;
            $this->janjiTemuModel->save($janjiTemu);
        }

        return redirect()->to('dosen/janji_temu');
    }


    
}
