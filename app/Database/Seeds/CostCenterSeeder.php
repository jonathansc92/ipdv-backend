<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Carbon\Carbon;

class CostCenterSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'id' => 1,
                'description' => 'Operacional',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'description' => 'Administrativo',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        $this->db->table('cost_centers')->emptyTable();
        $this->db->table('cost_centers')->insertBatch($data);
    }
}
