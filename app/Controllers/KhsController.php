<?php

namespace App\Controllers;

use App\Models\NilaiMahasiswaModel;

class KhsController extends BaseController
{
    protected $nilaiMahasiswaModel;

    public function __construct()
    {
        $this->nilaiMahasiswaModel = new NilaiMahasiswaModel();
    }

    public function index()
    {
        $mahasiswaId = session()->get('id');
        $semester = $this->request->getGet('semester') ?? null;

        $query = $this->nilaiMahasiswaModel
            ->select('nilai_mahasiswa.*, mata_kuliah.nama_mk, mahasiswa.jk, mahasiswa.nim, mahasiswa.nama, mahasiswa.jurusan')
            ->join('mata_kuliah', 'mata_kuliah.id = nilai_mahasiswa.mata_kuliah_id')
            ->join('mahasiswa', 'mahasiswa.id = nilai_mahasiswa.mahasiswa_id')
            ->where('nilai_mahasiswa.mahasiswa_id', $mahasiswaId);

        if ($semester) {
            $query->where('nilai_mahasiswa.semester', $semester);
        }

        $data['khs'] = $query->findAll();
        $data['semester'] = $semester;

        return view('khs/index', $data);
    }
}
