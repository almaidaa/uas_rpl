<?php

namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'nim', 'nama', 'jk', 'jurusan', 'angkatan', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    protected $validationRules = [
        'nim'     => 'required|is_unique[mahasiswa.nim]|max_length[15]',
        'nama'    => 'required|min_length[3]|max_length[100]',
        'jk'      => 'required|in_list[L,P]',
        'jurusan'  => 'required|min_length[3]|max_length[100]',
        'angkatan'  => 'required|numeric',
    ];
    protected $validationMessages = [
        'nim' => [
            'is_unique' => 'NIM sudah terdaftar.',
        ],
    ];

    public function getMahasiswaByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }

    // Ambil semua data mahasiswa dengan informasi dari tabel users

    public function getAllMahasiswaWithUser()
    {
        $builder = $this->db->table($this->table)
            ->select('mahasiswa.*, users.username, users.role')
            ->join('users', 'users.id = mahasiswa.user_id', 'left');

        return $builder->get()->getResultArray();
    }

    // Ambil data mahasiswa berdasarkan ID dengan informasi dari tabel users
    public function getMahasiswaWithUser($id)
    {
        $builder = $this->db->table($this->table)
            ->select('mahasiswa.*, users.username, users.role')
            ->join('users', 'users.id = mahasiswa.user_id', 'left')
            ->where('mahasiswa.id', $id);

        return $builder->get()->getRowArray();
    }

    // Tambahkan data mahasiswa sekaligus membuat user baru
    public function createMahasiswaWithUser(array $mahasiswaData)
    {
        $db = \Config\Database::connect();
        $db->transStart();

        // Simpan data user ke tabel users
        $userData = [
            'username' => $mahasiswaData['nim'], // Gunakan NIM sebagai username
            'password' => password_hash($mahasiswaData['nim'], PASSWORD_DEFAULT), // password sesuai nim
            'role'     => 'mahasiswa',
        ];

        $userModel = new \App\Models\UserModel();
        $userModel->insert($userData);

        // Ambil ID pengguna yang baru ditambahkan
        $userId = $userModel->getInsertID();

        // Simpan data dosen dengan user_id
        $mahasiswaData['user_id'] = $userId;
        $this->save($mahasiswaData);

        $db->transComplete();
        return $db->transStatus();
        // $this->db->table($this->table)->insert($mahasiswaData);
        // $userId = $this->db->insertID();
        // $this->db->table('users')->insert(['id' => $userId, 'username' => $mahasiswaData['nim'], 'password' => password_hash($mahasiswaData['nim'], PASSWORD_DEFAULT), 'role' => 'mahasiswa']);
    }
}

