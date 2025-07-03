<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\DosenModel;
use App\Models\MataKuliahModel;
use App\Models\JadwalPerkuliahanModel;
use App\Models\UserModel;
// use App\Models\KrsModel;
use App\Models\KRSModel;
// use App\Models\MahasiswaModel;
// use App\Models\JadwalModel;

class AdminController extends BaseController
{
    protected $mahasiswaModel;
    protected $nilaiModel;
    protected $dosenModel;
    protected $mataKuliahModel;
    protected $jadwalModel;
    protected $userModel;
    protected $krsModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->dosenModel = new DosenModel();
        $this->mataKuliahModel = new MataKuliahModel();
        $this->jadwalModel = new JadwalPerkuliahanModel();
        $this->userModel = new UserModel();
        $this->krsModel = new KrsModel();
        $this->nilaiModel = new \App\Models\NilaiModel();
    }
    public function index()
    {
        return $this->dashboard();
    }
    public function dashboard()
    {
        $data = [
            'total_mahasiswa' => $this->mahasiswaModel->countAll(),
            'total_dosen' => $this->dosenModel->countAll(),
            'total_mata_kuliah' => $this->mataKuliahModel->countAll(),
            'total_nilai' => $this->nilaiModel->countAll(),
        ];
        return view('admin/dashboard', $data);
    }

    public function manageMahasiswa() // Mahasiswa
    {
        $data = [
            'title' => 'Daftar mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->getAllMahasiswaWithUser(),
        ];
        return view('admin/mahasiswa/mahasiswa', $data);
    }

    public function createmhs() //Mahasiswa
    {   
        $data = [
            'title' => 'Tambah Mahasiswa',
            'validation' => \Config\Services::validation(),
        ];
        return view('admin/mahasiswa/create', $data);
    }

    public function storemhs() //mahasiswa
    {
       // Validasi input
       if (!$this->validate([
        'nim'     => 'required|is_unique[mahasiswa.nim]|max_length[15]',
        'nama'    => 'required|min_length[3]|max_length[100]',
        'jk'      => 'required|in_list[L,P]',
        'jurusan'  => 'required|min_length[3]|max_length[100]',
        'angkatan'  => 'required|numeric',
    ])) {
        return redirect()->to('admin/mahasiswa/create')
        ->withInput()
        ->with('error', 'Gagal menambahkan mahasiswa, periksa kembali inputan Anda.')
        ->with('validation', \Config\Services::validation());
    }

    // Ambil data dari input
    $dataMahasiswa = [
        'nim' => $this->request->getVar('nim'),
        'nama' => $this->request->getVar('nama'),
        'jk' => $this->request->getVar('jk'),
        'jurusan' => $this->request->getVar('jurusan'),
        'angkatan' => $this->request->getVar('angkatan'),
    ];

    // Tambahkan dosen beserta user
    if ($this->mahasiswaModel->createMahasiswaWithUser($dataMahasiswa)) {
        return redirect()->to('admin/mahasiswa/mahasiswa')->with('success', 'Dosen berhasil ditambahkan.');
    } else {
        return redirect()->to('admin/mahasiswa/create')->with('error', 'Gagal menambahkan mahasiswa.');
    }
    }

    // Form Edit Mahasiswa
    public function editmhs($id)
    {
        $model = new MahasiswaModel();
        $mahasiswa = $model->find($id);

        if (!$mahasiswa) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data mahasiswa tidak ditemukan');
        }

        return view('admin/mahasiswa/edit', ['mahasiswa' => $mahasiswa]);
    }

    // Proses Update Mahasiswa
    public function updatemhs($id)
    {   
        $model = new MahasiswaModel();

        // Validasi input
        if (!$this->validate([
            // 'nim'      => "required|is_unique[mahasiswa.nim,id,{$id}]",
            'nama'     => 'required|min_length[3]',
            'jurusan'    => 'required|min_length[3]',
            'angkatan' => 'required|integer',
            'jk' => 'required|in_list[L,P]'
        ])) {
            // Kirim kembali ke form edit dengan pesan error
            return redirect()->to('/admin/mahasiswa/edit/' . $id)
                ->withInput()
                ->with('validation', $this->validator);
        }

        // Ambil data dari form
        // $nim = $this->request->getPost('nim');
        $nama = $this->request->getPost('nama');
        $jurusan = $this->request->getPost('jurusan');
        $angkatan = $this->request->getPost('angkatan');
        $jk = $this->request->getPost('jk');

        // Cek apakah data benar-benar berubah
        $currentData = $model->find($id);
        if (
            // $currentData['nim'] === $nim &&
            $currentData['nama'] === $nama &&
            $currentData['jurusan'] === $jurusan &&
            $currentData['angkatan'] == $angkatan &&
            $currentData['jk'] === $jk
        ) {
            return redirect()->to('/admin/mahasiswa/edit/' . $id)
                ->with('info', 'Tidak ada perubahan pada data.');
        }

        // Update data di database
        $updateResult = $model->update($id, [
            // 'nim' => $nim,
            'nama' => $nama,
            'jurusan' => $jurusan,
            'angkatan' => $angkatan,
            'jk' => $jk,
        ]);

        if ($updateResult) {
            // Redirect ke halaman dashboard mahasiswa dengan pesan sukses
            return redirect()->to('/admin/mahasiswa/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
        } else {
            return redirect()->to('/admin/mahasiswa/edit/' . $id)
                ->with('error', 'Gagal memperbarui data. Silakan coba lagi.');
        }
        // $this->mahasiswaModel->update($id, [
        //     'nim' => $this->request->getPost('nim'),
        //     'nama' => $this->request->getPost('nama'),
        //     'jurusan' => $this->request->getPost('jurusan'),
        //     'angkatan' => $this->request->getPost('angkatan'),
        // ]);

        // return redirect()->to('/mahasiswa/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function deletemhs($id)
    {
        $mahasiswaModel = new MahasiswaModel();
        $mahasiswaModel->delete($id);

        return redirect()->to('/admin/mahasiswa/mahasiswa')->with('success', 'Data mahasiswa berhasil dihapus.');
    }

    public function manageDosen()
    {
        $data = [
            'title' => 'Daftar Dosen',
            'dosen' => $this->dosenModel->getAllDosenWithUser(),
        ];
        return view('admin/dosen/index', $data);
    }

    public function createdosen()
    {
        $data = [
            'title' => 'Tambah Dosen',
            'validation' => \Config\Services::validation(),
        ];
        return view('/admin/dosen/create');
    }

    public function storedosen()
    {
        // Validasi input
        if (!$this->validate([
            'nip'     => 'required|is_unique[dosen.nip]|max_length[15]',
            'nama'    => 'required|min_length[3]|max_length[100]',
            'departemen'  => 'required|min_length[3]|max_length[100]',
        ])) {
            return redirect()->to('admin/dosen/create')->withInput()->with('validation', \Config\Services::validation());
        }

        // Ambil data dari input
        $dataDosen = [
            'nip' => $this->request->getVar('nip'),
            'nama' => $this->request->getVar('nama'),
            'departemen' => $this->request->getVar('departemen'),
        ];

        // Tambahkan dosen beserta user
        if ($this->dosenModel->createDosenWithUser($dataDosen)) {
            return redirect()->to('admin/dosen/index')->with('success', 'Dosen berhasil ditambahkan.');
        } else {
            return redirect()->to('admin/dosen/create')->with('error', 'Gagal menambahkan dosen.');
        }
    }

    public function editdosen($id)
    {
        $dosenModel = new DosenModel();
        $data['dosen'] = $dosenModel->find($id);
        return view('/admin/dosen/edit', $data);
    }

    public function updatedosen($id)
    {
        $dosenModel = new DosenModel();

        // if (!$this->validate([
        //     'nidn' => 'required',
        //     'nama' => 'required|min_length[3]|max_length[100]',
        // ])) {
        //     return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        // }

        // $nidn = $this->request->getPost('nidn');
        $nama = $this->request->getPost('nama');
        $departemen = $this->request->getPost('departemen');

        // Ambil data dari database berdasarkan ID
        $dosen = $dosenModel->find($id);
        if ($dosen) {
            $dataToUpdate = [
                // 'nidn' => $nidn,
                'nama' => $nama,
                'departemen' => $departemen,
            ];

            // Debug: Cek data yang akan diupdate
            log_message('info', 'Data to update: ' . print_r($dataToUpdate, true));

            // Lakukan update
            // $dosenModel->set('nidn', $nidn);
            $dosenModel->set('nama', $nama);
            $dosenModel->set('departemen', $departemen);

            if ($dosenModel->where('id', $id)->update()) {
                // dd($dosenModel);
                return redirect()->to('/admin/dosen/index')->with('message', 'Dosen updated successfully.');
            } else {
                // dd($dosenModel);
                return redirect()->back()->with('error', 'Failed to update dosen.');
            }
        }

        return redirect()->back()->with('error', 'Dosen not found.');
    }

    public function deletedosen($id)
    {
        $dosenModel = new DosenModel();
        $dosenModel->delete($id);
        return redirect()->to('/admin/dosen/index')->with('message', 'Dosen deleted successfully.');
    }

    public function manageMataKuliah()
    {
        $mataKuliahModel = new MataKuliahModel();
        $data['mata_kuliah'] = $mataKuliahModel->findAll();
        $data['title'] = 'Mata Kuliah';
        return view('admin/mata_kuliah/index', $data);
    }

    public function createmk()
    {
        $dosen = $this->dosenModel->findAll();
        return view('admin/mata_kuliah/create', [
            'dosen' => $dosen, // Variabel yang dikirim ke view
        ]);
    }

    public function storemk()
    {
        $kode_mk = $this->request->getPost('kode_mk');
        
        // Validasi unique kode_mk
        if ($this->mataKuliahModel->where('kode_mk', $kode_mk)->first()) {
            return redirect()->back()->withInput()->with('error', 'Kode mata kuliah sudah ada.');
        }

        $data = [
            'kode_mk' => $kode_mk,
            'nama_mk' => $this->request->getPost('nama_mk'),
            'sks' => $this->request->getPost('sks'),
            'semester' => $this->request->getPost('semester'),
            // 'dosen_id' => $this->request->getPost('dosen_id'),
        ];

        if ($this->mataKuliahModel->insert($data)) {
            return redirect()->to('admin/mata_kuliah/index')->with('success', 'Mata kuliah berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan mata kuliah.');
        }
    }

    public function editmk($id)
    {
        $mataKuliahModel = new MataKuliahModel();
        $data['mata_kuliah'] = $mataKuliahModel->find($id);
        return view('/admin/mata_kuliah/edit', $data);
    }

    public function updatemk($id)
    {
        $mataKuliahModel = new MataKuliahModel();
        $mataKuliah = $mataKuliahModel->find($id);
        if (!$mataKuliah) {
            return redirect()->back()->with('error', 'Mata kuliah tidak ditemukan.');
        }

        $data = [
            'nama_mk' => $this->request->getPost('nama_mk'),
            'sks' => $this->request->getPost('sks'),
            'semester' => $this->request->getPost('semester'),
        ];
        if ($mataKuliahModel->update($id, $data)) {
            return redirect()->to('admin/mata_kuliah/index')->with('success', 'Mata kuliah berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui mata kuliah.');
        }
        // dd($data['semester']); 
    }

    public function deletemk($id)
    {
        $MataKuliahModel = new MataKuliahModel();
        $MataKuliahModel->delete($id);
        return redirect()->to('/admin/mata_kuliah/index')->with('message', 'Dosen deleted successfully.');
    }

    public function manageJadwal()
    {
        $data['jadwal'] = $this->jadwalModel
            ->select('jadwal_perkuliahan.*, mata_kuliah.nama_mk, mata_kuliah.semester, dosen.nama as dosen')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->join('dosen', 'dosen.id = jadwal_perkuliahan.dosen_id')
            ->findAll();

        return view('admin/jadwal/index', $data);
    }


    public function createjdwl()
    {
        $data = [
            'mata_kuliah' => $this->mataKuliahModel->findAll(),
            'dosen'       => $this->dosenModel->findAll(),
        ];

        return view('admin/jadwal/create', $data);
    }

    public function storejdwl()
    {
        $mataKuliahId = $this->request->getPost('mata_kuliah_id');
        $semester = $this->mataKuliahModel->find($mataKuliahId)['semester'];

        $this->jadwalModel->save([
            'mata_kuliah_id' => $mataKuliahId,
            'dosen_id'       => $this->request->getPost('dosen_id'),
            'hari'           => $this->request->getPost('hari'),
            'jam_mulai'      => $this->request->getPost('jam_mulai'),
            'jam_selesai'    => $this->request->getPost('jam_selesai'),
            'ruangan'        => $this->request->getPost('ruangan'),
            'semester'        => $semester,
        ]);

        return redirect()->to('admin/jadwal/index');
    }

    public function editjdwl($id)
    {
        $data = [
            'jadwal' => $this->jadwalModel->find($id),
            'mata_kuliah' => $this->mataKuliahModel->findAll(),
            'dosen'       => $this->dosenModel->findAll(),
        ];
        return view('admin/jadwal/edit', $data);
    }

    public function updatejdwl()
    {
        try {
            $jadwalModel = new JadwalPerkuliahanModel();
            $jadwalId= $this->request->getPost('idnya');
            

            $data = [
                // 'mata_kuliah_id' => $this->request->getPost('mata_kuliah_id'),
                'dosen_id'       => $this->request->getPost('dosen_id'),
                'hari'           => $this->request->getPost('hari'),
                'jam_mulai'      => $this->request->getPost('jam_mulai'),
                'jam_selesai'    => $this->request->getPost('jam_selesai'),
                'ruangan'        => $this->request->getPost('ruangan'),
                // 'semester'       => $this->request->getPost('semester'),
            ];
            $jadwalModel->update($jadwalId, $data);
            return redirect()->to('admin/jadwal/index')->with('message', 'Mata Kuliah updated successfully.');
        } catch (\Exception $e) {
            return redirect()->to('admin/jadwal/index')->with('error', $e->getMessage());
        }
    }


    public function deletejdwl($id)
    {
        $jadwalModel = new JadwalPerkuliahanModel();
        $jadwalModel->delete($id);
        return redirect()->to('/admin/jadwal/index')->with('message', 'Mata Kuliah deleted successfully.');
    }

    public function detailJadwal($jadwalId)
    {
        $mahasiswa    = $this->krsModel->getMahasiswaByJadwal($jadwalId);
        $allMahasiswaNotRegistered = $this->mahasiswaModel
            ->select('*')
            ->whereNotIn('mahasiswa.id', function($anu) use ($jadwalId) {
                return $anu->select('mahasiswa_id')->from('krs')->where('jadwal_id', $jadwalId);
            })
            ->findAll();


        $jadwal = $this->jadwalModel
            ->select('jadwal_perkuliahan.id as id_jadwal, mata_kuliah.nama_mk as mata_kuliah, jadwal_perkuliahan.hari, jadwal_perkuliahan.jam_mulai, jadwal_perkuliahan.jam_selesai,dosen.*')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->join('dosen', 'dosen.id = jadwal_perkuliahan.dosen_id')
            ->find($jadwalId);
            // dd($jadwal);

        if (!$jadwal) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Jadwal tidak ditemukan.');
        }

        return view('admin/jadwal/detail_jadwal', [
            'jadwal' => $jadwal,
            'mahasiswa' => $mahasiswa,
            'allMahasiswa' => $allMahasiswaNotRegistered,
        ]);
    }

    public function tambahMahasiswaKeJadwal()
    {
        $jadwalId = $this->request->getPost('jadwal_id');
        $mahasiswaId = $this->request->getPost('mahasiswa_id');
        // dd($jadwalId, $mahasiswaId);
        if (!$jadwalId || !$mahasiswaId) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        // Cek apakah mahasiswa sudah terdaftar di jadwal ini
        $existing = $this->krsModel->where('jadwal_id', $jadwalId)
            ->where('mahasiswa_id', $mahasiswaId)
            ->first();

        // dd($existing);
        $mkid = $this->jadwalModel->find($jadwalId)['mata_kuliah_id'];
        // dd($jadwalId);
        $semester = $this->mataKuliahModel->find($mkid)['semester'];
        // dd($semester);
        if ($existing) {
            return redirect()->back()->with('error', 'Mahasiswa sudah terdaftar di jadwal ini.');
        }

        // Tambahkan mahasiswa ke KRS
        $this->krsModel->insert([
            'jadwal_id' => $jadwalId,
            'semester' => $semester,
            'mata_kuliah_id' => $mkid,
            'mahasiswa_id' => $mahasiswaId,
        ]);

        return redirect()->back()->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function hapusMahasiswaDariJadwal( $mahasiswaId,$jadwalId)
    {
        if (!$jadwalId || !$mahasiswaId) {
            return redirect()->back()->with('error', 'Data tidak lengkap.');
        }

        try {
            $this->krsModel
                ->where('jadwal_id', $jadwalId)
                ->where('id', $mahasiswaId)
                ->delete();

            return redirect()->back()->with('success', 'Mahasiswa berhasil dihapus dari jadwal.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function laporan()
    {
        // Implementasi laporan
        return view('admin/laporan');
    }

    public function manageNotifikasi()
    {
        // Implementasi notifikasi
        return view('admin/notifikasi');
    }

    public function manageUsers()
    {
        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $this->userModel->findAll(),
        ];
        return view('admin/users/index', $data);
    }
}

