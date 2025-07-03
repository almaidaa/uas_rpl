<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddJadwalIdToKrsTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('krs', [
            'jadwal_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
        ]);

        $this->forge->addForeignKey('jadwal_id', 'jadwal_perkuliahan', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->forge->dropForeignKey('krs', 'krs_jadwal_id_foreign');
        $this->forge->dropColumn('krs', 'jadwal_id');
    }
}
