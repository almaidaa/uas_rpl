<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColoumntoKRS extends Migration
{
    public function up()
    {
        $this->forge->addColumn('krs', [
            'dosen_id' => [
                'type' => 'varchar',
                'constraint' => 255,
                'null' => true,
            ],
        ]);
    }

    public function down()
    {
        //
    }
}
