<?php

namespace App\Controllers;

use App\Models\DosenModel;
use App\Models\UserModel;
use App\Models\MataKuliahModel;
use App\Models\JadwalPerkuliahanModel;
use App\Models\KrsModel;

class DosenController extends BaseController
{
    protected $dosenModel;
    protected $userModel;
    protected $mataKuliahModel;
    protected $krsModel;
    protected $jadwalModel;

    public function __construct()
    {
        $this->dosenModel = new DosenModel();
        $this->userModel = new UserModel();
        $this->krsModel = new KrsModel();
        $this->mataKuliahModel = new MataKuliahModel();
        $this->jadwalModel = new JadwalPerkuliahanModel();
    }

    public function index() //menampilkan dosen
    {
        return view('dosen/dashboard');
    }

    public function jadwal() //menampilkan dosen
    {
        $dosenId = session()->get('user_id'); // Ambil ID dosen dari session

        // Pastikan session dosen mengarah ke tabel dosen
        $dosen = $this->dosenModel->where('user_id', $dosenId)->first();
        if (!$dosen) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Dosen tidak ditemukan');
        }

        $jadwal = $this->jadwalModel->getJadwalByDosen($dosen['id']);

        $data = [
            'title' => 'Jadwal Perkuliahan Dosen',
            'jadwal' => $jadwal,
        ];

        // $jadwal = $this->jadwalModel->getJadwalByDosen($dosenId);
        // echo "<pre>";
        // print_r($jadwal);
        // echo "</pre>";
        // die();


        return view('dosen/jadwal/index',  $data);
    }

    public function lihatNilai($jadwalId)
    {
        // Ambil data mahasiswa dan nilai berdasarkan jadwal
        $nilai = $this->krsModel
            // ->select('*')
            ->select('krs.id as krs_id, mahasiswa.nim, mahasiswa.nama as mahasiswa_nama, mata_kuliah.nama_mk as mata_kuliah, krs.nilai, mahasiswa.*')
            ->join('mahasiswa', 'mahasiswa.id = krs.mahasiswa_id')
            ->join('mata_kuliah', 'mata_kuliah.id = krs.mata_kuliah_id')
            ->where('krs.jadwal_id', $jadwalId)
            ->findAll();
        // dd($nilai);

        $jadwal = $this->jadwalModel
            ->select('jadwal_perkuliahan.id, mata_kuliah.nama_mk as mata_kuliah, mata_kuliah.sks, jadwal_perkuliahan.hari, jadwal_perkuliahan.jam_mulai, jadwal_perkuliahan.jam_selesai')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->find($jadwalId);

        if (!$jadwal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jadwal tidak ditemukan.');
        }

        return view('dosen/nilai/nilai', [
            'nilai' => $nilai,
            'jadwal' => $jadwal,
        ]);

        // return view('dosen/nilai', $data);
    }

    public function inputNilai($jadwalId, $userId)
    {
        // dd($jadwalId,$userId);
        // Ambil data mahasiswa dari KRS berdasarkan jadwal yang dipilih
        $krs = $this->krsModel
            ->select('krs.id as krs_id, mahasiswa.nama as mahasiswa_nama, mahasiswa.nim, krs.nilai, krs.*')
            ->join('mahasiswa', 'mahasiswa.id = krs.mahasiswa_id')
            ->where('krs.jadwal_id', $jadwalId)
            ->Where('krs.mahasiswa_id', $userId)
            ->findAll();
            // dd($krs);

            $jadwal = $this->jadwalModel
            ->select('jadwal_perkuliahan.id, mata_kuliah.nama_mk as mata_kuliah, jadwal_perkuliahan.hari, jadwal_perkuliahan.jam_mulai, jadwal_perkuliahan.jam_selesai')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->find($jadwalId);


        if (!$jadwal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jadwal tidak ditemukan.');
        }

        return view('dosen/nilai/input_nilai', [
            'krs' => $krs,
            'jadwal' => $jadwal,
        ]);
        // return view('dosen/input_nilai', $data);
    }

    public function updateNilai()
    {
        // ambil parameter untuk ubah datanya
        $idmhs = $this->request->getPost('userId');
        $idjdwl = $this->request->getPost('jadwalId');

        $dataygmaudiubah = $this->krsModel
                                ->where('mahasiswa_id',$idmhs)
                                ->where('jadwal_id',$idjdwl)
                                ->first();
                                // dd($dataygmaudiubah);

        $nilai = $this->request->getPost('nilai');

        // dd($idmhs,$nilai,$krs);
        $dataygmaudiubah['nilai'] = $nilai;
        $this->krsModel->save($dataygmaudiubah);
        return redirect()->to(base_url('dosen/nilai/nilai/' . $dataygmaudiubah['jadwal_id']));
    }





    // public function detail($id)
    // {
    //     $dosen = $this->dosenModel->find($id);
    //     $mataKuliah = $this->dosenModel->getMataKuliahByDosen($id);

    //     if (!$dosen) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Dosen tidak ditemukan');
    //     }

    //     $data = [
    //         'title' => 'Detail Dosen',
    //         'dosen' => $dosen,
    //         'mata_Kuliah' => $mataKuliah,
    //     ];

    //     return view('dosen/detail', $data);
    // }
}
