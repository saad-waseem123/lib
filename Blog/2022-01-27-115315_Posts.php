<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Posts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'post_slug'  => [
                'type'           => 'VARCHAR',
                'constraint'     => '128'
            ],
            'post_name'       => [
                'type'          => 'VARCHAR',
                'constraint'     => '128',
            ],
            'post_desc'     => [
                'type'          => 'TEXT',
                'null'          => true,
                'default'       => null,
            ],
            'post_img'        => [
                'type'          => 'VARCHAR',
                'constraint'    => '128',
                'null'          => true,
                'default'       => null,
            ],
            'post_cat_id'        => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'created_at'        => [
                'type'           => 'DATETIME',
            ],
            'updated_at'        => [
                'type'           => 'DATETIME',
            ],
            'deleted_at'        => [
                'type'           => 'DATETIME',
                'null'           => true,
                'default'        => null
            ],
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('posts');
    }

    public function down()
    {
        $this->forge->dropTable('posts');
    }
}
