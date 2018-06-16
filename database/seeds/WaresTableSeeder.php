<?php

use Illuminate\Database\Seeder;

class WaresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Ziemniak biały',
        'weight_of_package' => '15',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Ziemniak biały',
        'weight_of_package' => '30',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '3',
        'name' => 'Ziemniak folia',
        'weight_of_package' => '25',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Ziemniak czerwony',
        'weight_of_package' => '15',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Cebula biała',
        'weight_of_package' => '15',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Cebula czerwona',
        'weight_of_package' => '15',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Burak',
        'weight_of_package' => '10',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Seler',
        'weight_of_package' => '5',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Marchew',
        'weight_of_package' => '10',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Pekin',
        'weight_of_package' => '10',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '2',
        'name' => 'Botwinka',
        'weight_of_package' => '2',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '2',
        'name' => 'Por',
        'weight_of_package' => '3',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Por',
        'weight_of_package' => '5',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Czosnek',
        'weight_of_package' => '10',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '1',
        'name' => 'Kapusta',
        'weight_of_package' => '25',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '5',
        'name' => 'Kapusta',
        'weight_of_package' => '3',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);

        DB::table('wares')->insert([
        'ID_packaging' => '5',
        'name' => 'Kalafior',
        'weight_of_package' => '3',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
