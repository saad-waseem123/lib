Done
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
            'pcat_slug'          => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'pcat_name'          => [
                'type'       => 'VARCHAR',
                'constraint' => '32'
            ],
            'pcat_short_desc'     => [
                'type'           => 'VARCHAR',
                'constraint'     => '256',
                'null'           => true,
                'default'        => null,
            ],
            'pcat_desc'          => [
                'type'       => 'TEXT',
                'null'       => true,
                'default'    => null,
            ],
            'pcat_img'           => [
                'type'       => 'VARCHAR',
                'constraint' => "128",
                'null'       => true,
                'default'    => null,
            ],
            'pcat_banner_img_id'    => [
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => true,
                'default'    => null,
            ],
            'pcat_parent_id'      => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'pcat_meta_title'    => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null'       => true,
                'default'    => null,
            ],
            'pcat_meta_desc'     => [
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
        $this->forge->createTable('postcategories');
    }

   

    

    public function down()
    {
        $this->forge->dropTable('postcategories');
    }
}
