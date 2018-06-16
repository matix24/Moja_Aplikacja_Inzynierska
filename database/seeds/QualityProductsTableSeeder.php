<?php

use Illuminate\Database\Seeder;

class QualityProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('quality_products')->insert([
        'id' => '1',
        'name' => 'Mała',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quality_products')->insert([
        'id' => '2',
        'name' => 'Średnia',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('quality_products')->insert([
        'id' => '3',
        'name' => 'Duża',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
