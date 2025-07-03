<?php

namespace App\Models;

use CodeIgniter\Model;

class MataKuliahModel extends Model
{
    protected $table = 'mata_kuliah';
    protected $primaryKey = 'id';
    protected $allowedFields = ['dosen_id', 'kode_mk', 'nama_mk', 'sks', 'semester', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}
