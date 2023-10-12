<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCostCenters extends Migration
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
            ]
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('cost_centers');
    }

    public function down()
    {
        $this->forge->dropTable('cost_centers');
    }
}
