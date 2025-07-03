<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddNilaiToKrs extends Migration
{
    public function up()
    {
        $this->forge->addColumn('krs', [
            'nilai' => [
                'type' => 'VARCHAR',
                'constraint' => '2', // Nilai berupa huruf seperti A, B, C, D, E
                'null' => true,
                'after' => 'mata_kuliah_id', // Menambahkan kolom setelah mata_kuliah_id
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('krs', 'nilai');
    }
}
