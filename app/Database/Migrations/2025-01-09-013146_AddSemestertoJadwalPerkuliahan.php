<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSemestertoJadwalPerkuliahan extends Migration
{
    public function up()
    {
        $this->forge->addColumn('jadwal_perkuliahan', [
            'semester' => [
                'type' => 'varchar',
                'constraint' => 10,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('jadwal_perkuliahan', 'semester');
    }
}
