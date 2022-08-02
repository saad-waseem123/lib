<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sliders extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ], 
            'slider_name'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'location_id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'is_active'      => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'default'        => 0
            ],
            'created_at'        => [
                'type'       => 'DATETIME'
            ],
            'updated_at'        => [
                'type'       => 'DATETIME'
            ],
            'deleted_at'        => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ]
        ]);

        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('sliders');
    }

    public function down()
    {
        $this->forge->dropTable('sliders');
    }
}
