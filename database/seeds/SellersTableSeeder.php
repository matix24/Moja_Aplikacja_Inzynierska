<?php

use Illuminate\Database\Seeder;

class SellersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('sellers')->insert([
      'name' => 'Arkadiusz',
      'surname' => 'Kowalski',
      'address' => 'ul. Janasa Wincentego 146, 41-500 Chorzów',
      'phone_number' => '555987147',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('sellers')->insert([
      'name' => 'Renard',
      'surname' => 'Nowicki',
      'address' => 'ul. Próchnika Adama 33, 90-404 Łódź',
      'phone_number' => '555852147',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('sellers')->insert([
      'name' => 'Mieczysława',
      'surname' => 'Wieczorek',
      'address' => 'ul. Strzemienna 144, 65-544 Zielona Góra',
      'phone_number' => '789852369',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('sellers')->insert([
      'name' => 'Beatrycze',
      'surname' => 'Adamczyk',
      'address' => 'ul. Masztalarska 127, 61-767 Poznań',
      'archive' => '0',
      'phone_number' => '741852963',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('sellers')->insert([
      'name' => 'Seweryna',
      'surname' => 'Kowalczyk',
      'address' => 'ul. Krakowska 15, 26-400 Przysucha',
      'phone_number' => '789951753',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('sellers')->insert([
      'name' => 'Roksana',
      'surname' => 'Czerwinska',
      'address' => 'ul. Grobla I 99, 80-834 Gdańsk',
      'phone_number' => '789852749',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
}
