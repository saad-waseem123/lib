<?php 

class PermissionList
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
            'setting_key'    => [
                'type'       => 'VARCHAR',
                'constraint' => '16'
            ],
            'setting_value'    => [
                'type'       => 'text',
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
        $this->forge->createTable('settings');
    }

    public function down()
    {
        $this->forge->dropTable('settings');
    }
}
