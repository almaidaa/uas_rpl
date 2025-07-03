<?php

namespace App\Models;

use CodeIgniter\Model;

class NilaiModel extends Model
{
    protected $table = 'nilai';
    protected $primaryKey = 'id';
    protected $allowedFields = ['mahasiswa_id', 'mata_kuliah_id', 'dosen_id', 'nilai', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
