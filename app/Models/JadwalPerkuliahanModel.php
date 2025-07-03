<?php

namespace App\Models;

use CodeIgniter\Model;

class JadwalPerkuliahanModel extends Model
{
    protected $table      = 'jadwal_perkuliahan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'mata_kuliah_id',
        'dosen_id',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'ruangan',
        'semester',
    ];

    protected $useTimestamps = true;

    public function getJadwalByDosen($dosenId)
    {
        // dd($dosenId);
        return $this->select('jadwal_perkuliahan.*, mata_kuliah.nama_mk as nama_mata_kuliah, mata_kuliah.kode_mk as kode_mata_kuliah')
            ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
            ->join('dosen', 'dosen.id = jadwal_perkuliahan.dosen_id')
            ->where('jadwal_perkuliahan.dosen_id', $dosenId)
            ->findAll();
            // dd($dosenId);
    }
    // public function getJadwalByDosen($dosenId)
    // {
    //     return $this->select('jadwal_perkuliahan.*, mata_kuliah.nama_mk as mata_kuliah')
    //         ->join('mata_kuliah', 'mata_kuliah.id = jadwal_perkuliahan.mata_kuliah_id')
    //         ->where('jadwal_perkuliahan.dosen_id', $dosenId)
    //         ->findAll();
    // }
}
