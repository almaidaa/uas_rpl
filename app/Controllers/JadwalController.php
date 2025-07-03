<?php

namespace App\Controllers;

use App\Models\JadwalPerkuliahanModel;
use App\Models\MataKuliahModel;
use App\Models\DosenModel;

class JadwalController extends BaseController
{
    protected $jadwalModel;
    protected $mataKuliahModel;
    protected $dosenModel;

    public function __construct()
    {
        $this->jadwalModel = new JadwalPerkuliahanModel();
        $this->mataKuliahModel = new MataKuliahModel();
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        $data['jadwal'] = $this->jadwalModel
            ->select('jadwal_perkuliahan.*, mata_kuliah.nama_mk, dosen.nama as dosen')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->join('dosen', 'dosen.id = jadwal_perkuliahan.dosen_id')
            ->findAll();

        return view('jadwal/index', $data);
    }

    public function create()
    {
        $data = [
            'mata_kuliah' => $this->mataKuliahModel->findAll(),
            'dosen'       => $this->dosenModel->findAll(),
        ];

        return view('jadwal/create', $data);
    }

    public function store()
    {
        $this->jadwalModel->save([
            'mata_kuliah_id' => $this->request->getPost('mata_kuliah_id'),
            'dosen_id'       => $this->request->getPost('dosen_id'),
            'hari'           => $this->request->getPost('hari'),
            'jam_mulai'      => $this->request->getPost('jam_mulai'),
            'jam_selesai'    => $this->request->getPost('jam_selesai'),
            'ruangan'        => $this->request->getPost('ruangan'),
            'semester'       => $this->request->getPost('semester'),
        ]);

        return redirect()->to('/jadwal');
    }
}
