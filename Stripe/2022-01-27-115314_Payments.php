<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payments extends Migration
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
            'payment_user_id'   => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'payment_order_id'   => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            'stripe_customer_id'    => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
            ],
            'stripe_setup_intent'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
                'default'        => null,
            ],
            'stripe_payment_method'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
                'default'        => null,
            ],
            'stripe_payment_intent'   => [
                'type'           => 'VARCHAR',
                'constraint'     => '50',
                'null'           => true,
                'default'        => null,
            ],
            'stripe_amount'   => [
                'type'           => 'INT',
                'constraint'     => 11,
                'null'           => true,
                'default'        => null,
            ],
            'stripe_payment_status' => [
                'type'           => 'TINYINT',
                'constraint'     => 1,
                'default'        => 0
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
        $this->forge->createTable('payments');
    }

    public function down()
    {
        $this->forge->dropTable('payments');
    }
}
