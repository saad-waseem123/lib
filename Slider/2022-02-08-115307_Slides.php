<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Slides extends Migration
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
            'slider_id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'img'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'lg_text'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'sm_text'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'xs_text'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'btn_1_text'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'btn_1_link'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'btn_2_text'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'btn_2_link'    => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
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
        $this->forge->createTable('slides');
    }

    public function down()
    {
        $this->forge->dropTable('slides');
    }
}
