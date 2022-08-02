<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SliderLocation extends Migration
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
            'location_name'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
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
        $this->forge->createTable('slider_locations');
    }

    public function down()
    {
        $this->forge->dropTable('slider_locations');
    }
}
