<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use Faker\Factory;

class CostCenterSeeder extends Seeder
{
    public function run()
    {
        $this->db->table('cost_centers')->emptyTable();

        for ($i = 0; $i < 10; $i++) { 
            $this->db->table('cost_centers')->insert($this->generateUsers());
        }
    }

    private function generateUsers(): array
    {
        $faker = Factory::create();
        return [
            'description' => $faker->catchPhrase(),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];
    }
}
