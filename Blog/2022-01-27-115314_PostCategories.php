<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PostCategories extends Migration
{
    public function up()
    {
         $this->forge->addField([
            'id'                => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'post_cat_slug'          => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'post_cat_name'          => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'post_cat_desc'          => [
                'type'       => 'TEXT',
                'null'       => true,
                'default'    => null,
            ],
            'post_cat_parent_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'post_cat_meta_title'    => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null'       => true,
                'default'    => null,
            ],
            'post_cat_meta_desc'     => [
                'type'       => 'VARCHAR',
                'constraint' => '256',
                'default'    => null,
                'null'       => true,
            ],
            'created_at'        => [
                'type'       => 'DATETIME',
            ],
            'updated_at'        => [
                'type'       => 'DATETIME',
            ],
            'deleted_at'        => [
                'type'       => 'DATETIME',
                'null'       => true,
                'default'    => null
            ],
        ]);
        $this->forge->addPrimaryKey('id', true);
        $this->forge->createTable('post_categories');
    }

    public function down()
    {
        $this->forge->dropTable('post_categories');
    }
}
