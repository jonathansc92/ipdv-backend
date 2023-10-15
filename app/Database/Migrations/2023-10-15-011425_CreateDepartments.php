<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDepartments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'auto_increment' => true,
                'unsigned' => true
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'cost_center_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => false,
                'on update' => 'NOW()'
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('cost_center_id', 'cost_centers', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('departments');
    }

    public function down()
    {
        $this->forge->dropTable('departments');
    }
}
