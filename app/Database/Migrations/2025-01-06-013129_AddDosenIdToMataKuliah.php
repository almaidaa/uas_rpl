<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddDosenIdToMataKuliah extends Migration
{
    public function up()
    {
        $this->forge->addColumn('mata_kuliah', [
            'dosen_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'after'      => 'id', // Letakkan kolom setelah 'id'
            ],
        ]);

        // Tambahkan foreign key untuk kolom dosen_id
        $this->db->query('
            ALTER TABLE mata_kuliah 
            ADD CONSTRAINT mata_kuliah_dosen_id_foreign
            FOREIGN KEY (dosen_id) REFERENCES dosen(id) 
            ON DELETE SET NULL ON UPDATE CASCADE;
        ');
    }

    public function down()
    {
        // Hapus foreign key terlebih dahulu
        $this->db->query('ALTER TABLE mata_kuliah DROP FOREIGN KEY mata_kuliah_dosen_id_foreign');

        // Hapus kolom dosen_id
        $this->forge->dropColumn('mata_kuliah', 'dosen_id');
    }
}
