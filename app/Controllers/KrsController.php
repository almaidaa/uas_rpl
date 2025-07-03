<?php

namespace App\Controllers;

use App\Models\KrsModel;
use App\Models\MataKuliahModel;
// use App\Models\JadwalPerkuliahanModel;

class KrsController extends BaseController
{
    protected $krsModel;
    protected $mataKuliahModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->krsModel = new KrsModel();
        $this->mataKuliahModel = new MataKuliahModel();
    }

    public function index()
    {
        $mahasiswaId = session()->get('user_id');
        $data['krs'] = $this->krsModel
            ->select('krs.*, jadwal_perkuliahan.*, mata_kuliah.*')
            ->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = krs.jadwal_id')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->where('krs.mahasiswa_id', $mahasiswaId)
            ->findAll();

        return view('krs/index', $data);
    }


    public function create()
    {
        $data['jadwal'] = $this->jadwalModel
            ->select('jadwal_perkuliahan.id, mata_kuliah.nama_mk, dosen.nama as dosen, hari, jam_mulai, jam_selesai, ruangan')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->join('dosen', 'dosen.id = jadwal_perkuliahan.dosen_id')
            ->findAll();

        return view('krs/create', $data);
    }


    public function store()
    {
        $this->krsModel->save([
            'mahasiswa_id'   => session()->get('id'),
            'mata_kuliah_id' => $this->request->getPost('mata_kuliah_id'),
            'jadwal_id'      => $this->request->getPost('jadwal_id'),
            'semester'       => $this->request->getPost('semester'),
        ]);

        return redirect()->to('/krs');
    }
}
