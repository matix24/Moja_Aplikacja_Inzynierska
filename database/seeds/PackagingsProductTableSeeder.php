<?php

use Illuminate\Database\Seeder;

class PackagingsProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('packaging_products')->insert([
        'id' => '1',
        'name' => 'Worek',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('packaging_products')->insert([
        'id' => '2',
        'name' => 'Pęczek',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('packaging_products')->insert([
        'id' => '3',
        'name' => 'Folia',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('packaging_products')->insert([
        'id' => '4',
        'name' => 'Bez Opakania',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('packaging_products')->insert([
        'id' => '5',
        'name' => 'Sztuka',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
