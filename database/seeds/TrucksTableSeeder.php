<?php

use Illuminate\Database\Seeder;

class TrucksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trucks')->insert([
        'truck_id_number' => 'ESI 12345',
        'capacity' => '15500',
        'capacity_palete' => '1100',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('trucks')->insert([
        'truck_id_number' => 'PKA 12345',
        'capacity' => '15500',
        'capacity_palete' => '1100',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
