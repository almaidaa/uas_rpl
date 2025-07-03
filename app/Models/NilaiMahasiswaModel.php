<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiMahasiswaModel extends Model
{
    protected $table      = 'nilai_mahasiswa';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'mahasiswa_id',
        'mata_kuliah_id',
        'semester',
        'nilai',
    ];

    protected $useTimestamps = true;
}
