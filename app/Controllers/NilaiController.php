<?php

namespace App\Controllers;

use App\Models\NilaiModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use App\Models\DosenModel;

class NilaiController extends BaseController
{
    protected $nilaiModel;
    protected $mahasiswaModel;
    protected $mataKuliahModel;
    protected $dosenModel;

    public function __construct()
    {
        $this->nilaiModel = new NilaiModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->mataKuliahModel = new MataKuliahModel();
        $this->dosenModel = new DosenModel();
    }

    public function index()
    {
        $role = session()->get('role');
    
        if ($role == 'admin') {
            $data['nilai'] = $this->nilaiModel
                ->select('nilai.id, mahasiswa.nama as mahasiswa, mata_kuliah.nama_mk as mata_kuliah, dosen.nama as dosen, nilai.nilai')
                ->join('mahasiswa', 'mahasiswa.id = nilai.mahasiswa_id')
                ->join('mata_kuliah', 'mata_kuliah.id = nilai.mata_kuliah_id')
                ->join('dosen', 'dosen.id = nilai.dosen_id')
                ->findAll();
        } elseif ($role == 'dosen') {
            $dosenId = session()->get('id');
            $data['nilai'] = $this->nilaiModel
                ->select('nilai.id, mahasiswa.nama as mahasiswa, mata_kuliah.nama_mk as mata_kuliah, dosen.nama as dosen, nilai.nilai')
                ->join('mahasiswa', 'mahasiswa.id = nilai.mahasiswa_id')
                ->join('mata_kuliah', 'mata_kuliah.id = nilai.mata_kuliah_id')
                ->join('dosen', 'dosen.id = nilai.dosen_id')
                ->where('nilai.dosen_id', $dosenId)
                ->findAll();
        } else {
            return redirect()->to('/login')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    
        return view('nilai/index', $data);
    }
    
    public function create()
    {
        $data['mahasiswa'] = $this->mahasiswaModel->findAll();
        $data['mata_kuliah'] = $this->mataKuliahModel->findAll();
        $data['dosen'] = $this->dosenModel->findAll();
        return view('nilai/create', $data);
    }

    public function store()
    {
        $this->nilaiModel->save([
            'mahasiswa_id' => $this->request->getPost('mahasiswa_id'),
            'mata_kuliah_id' => $this->request->getPost('mata_kuliah_id'),
            'dosen_id' => $this->request->getPost('dosen_id'),
            'nilai' => $this->request->getPost('nilai'),
        ]);

        return redirect()->to('/nilai');
    }
}
