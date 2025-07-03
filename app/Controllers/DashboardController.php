<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\NilaiModel;
use App\Models\MahasiswaModel;
use App\Models\MataKuliahModel;
use App\Controllers\BaseController;
use App\Models\JadwalPerkuliahanModel;

class DashboardController extends BaseController
{
    protected $mahasiswaModel;
    protected $dosenModel;
    protected $mataKuliahModel;
    protected $nilaiModel;
    protected $jadwalModel;


    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->dosenModel = new DosenModel();
        $this->mataKuliahModel = new MataKuliahModel();
        $this->nilaiModel = new NilaiModel();
        $this->jadwalModel = new JadwalPerkuliahanModel();
    }

    public function index()
    {
        $role = session()->get('role');

        if ($role == 'admin') {
            // dd($role);
            return $this->adminDashboard();
        } elseif ($role == 'dosen') {

            return $this->dosenDashboard();
            // return $this->dosenDashboard();
        } elseif ($role == 'mahasiswa') {
            // dd($role);
            return $this->mahasiswaDashboard();
        }

        return redirect()->to('/login')->with('error', 'Role tidak dikenali.');
    }

    private function adminDashboard()
    {
        $data = [
            'total_mahasiswa' => $this->mahasiswaModel->countAll(),
            'total_dosen' => $this->dosenModel->countAll(),
            'total_mata_kuliah' => $this->mataKuliahModel->countAll(),
            'total_nilai' => $this->nilaiModel->countAll(),
            'title' => 'Welcome ' . session()->get('username'),
        ];

        $data['logged_in_user_name'] = session()->get('username');
        return view('admin/dashboard', $data);
    }

    private function dosenDashboard()
    {
        $id         = session()->get('user_id');
        $role       = session()->get('role');
        $dosen      = $this->dosenModel->where('user_id', $id)->first();
        $mata_Kuliah = $this->dosenModel->getMataKuliahByDosen($dosen['user_id']);
        // dd($mataKuliah);
        $jadwal = $this->jadwalModel->getJadwalByDosen($dosen['id']);
        if (!$dosen) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Dosen tidak ditemukan');
        }

        $data = [
            'title' => 'Welcome ' . $dosen['nama'],
            'dosen' => $dosen,
            'mata_Kuliah' => $mata_Kuliah,
            'jadwal_perkuliahan' => $jadwal,
            'logged_in_user_name' => $dosen['nama'],
        ];

        return view('dosen/dashboard', $data);
    }

    private function mahasiswaDashboard()
    {
        $mahasiswaId = session()->get('user_id');
        $mahasiswa = $this->mahasiswaModel->getMahasiswaByUserId($mahasiswaId);
        // dd($mahasiswaId);

        $data = [
            'mahasiswa' => $mahasiswa,
            'logged_in_user_name' => $mahasiswa['nama'],
            'title' => 'Welcome ' . $mahasiswa['nama'],
        ];

        return view('mahasiswa/dashboard', $data);
    }
}
