<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTables extends Migration
{
    public function up()
    {
        // Tabel Users
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'username' => ['type' => 'VARCHAR', 'constraint' => 50],
            'password' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'ENUM', 'constraint' => ['admin', 'dosen', 'mahasiswa']],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');

        // Tabel Mahasiswa
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'user_id' => ['type' => 'INT'],
            'nim' => ['type' => 'VARCHAR', 'constraint' => 15],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'jk' => ['type' => 'ENUM', 'constraint' => ['L', 'P']],
            'jurusan' => ['type' => 'VARCHAR', 'constraint' => 100],
            'angkatan' => ['type' => 'YEAR'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('mahasiswa');

        // Tabel Dosen
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'user_id' => ['type' => 'INT'],
            'nip' => ['type' => 'VARCHAR', 'constraint' => 15],
            'nama' => ['type' => 'VARCHAR', 'constraint' => 100],
            'departemen' => ['type' => 'VARCHAR', 'constraint' => 100],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dosen');

        // Tabel Mata Kuliah
        $this->forge->addField([
            'id' => ['type' => 'INT', 'auto_increment' => true],
            'kode_mk' => ['type' => 'VARCHAR', 'constraint' => 10],
            'nama_mk' => ['type' => 'VARCHAR', 'constraint' => 100],
            'sks' => ['type' => 'INT'],
            'semester' => ['type' => 'INT'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('mata_kuliah');
    }

    public function down()
    {
        $this->forge->dropTable('mata_kuliah');
        $this->forge->dropTable('dosen');
        $this->forge->dropTable('mahasiswa');
        $this->forge->dropTable('users');
    }
}
