<?php

namespace App\Models;

use CodeIgniter\Model;

class KrsModel extends Model
{
    protected $table      = 'krs';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'jadwal_id',
        'semester',
        'nilai',
    ];
    protected $useTimestamps = true;

    public function getMahasiswaByJadwal($jadwalId)
    {
        return $this->select('krs.*, mahasiswa.nim, mahasiswa.nama')
            ->join('mahasiswa', 'mahasiswa.id = krs.mahasiswa_id')
            ->where('krs.jadwal_id', $jadwalId)
            ->findAll();
    }


    public function getKHSByMahasiswa($mahasiswaId)
    {
        return $this->select('
                krs.*, 
                mata_kuliah.nama_mk, 
                mata_kuliah.sks, 
                dosen.nama AS nama_dosen, 
                jadwal_perkuliahan.semester
            ')
            ->join('jadwal_perkuliahan', 'jadwal_perkuliahan.id = krs.jadwal_id')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->join('dosen', 'dosen.id = jadwal_perkuliahan.dosen_id')
            ->where('krs.mahasiswa_id', $mahasiswaId)
            ->findAll();
    }
}
