<?php

namespace App\Controllers;

use App\Models\MataKuliahModel;
use App\Models\MataKuliahModell;

class MataKuliahController extends BaseController
{
    protected $dosenModel;

    public function __construct()
    {
        $this->dosenModel = new MataKuliahModel();
    }

    public function index()
    {
        $data['mata_kuliah'] = $this->dosenModel->findAll();
        return view('matakuliah/index', $data);
    }

    public function create()
    {
        return view('matakuliah/create');
    }

    public function store()
    {
        $this->dosenModel->save([
            'kode_mk' => $this->request->getPost('kode_mk'),
            'nama_mk' => $this->request->getPost('nama_mk'),
            'sks' => $this->request->getPost('sks'),
            'semester' => $this->request->getPost('semester'),
        ]);

        return redirect()->to('/matakuliah');
    }
}
