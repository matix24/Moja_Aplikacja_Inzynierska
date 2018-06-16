<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('users')->insert([
      'name' => 'Grzegorz',
      'surname' => 'Kowalski',
      'ID_roles' => '1',
      'email' => 'kowalskiG@example.pl',
      'password' => bcrypt('123456'),
      'phone_number' => '789852748',
      'address' => 'ul. Narcyzowa 37, 81-660 Gdynia',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('users')->insert([
      'name' => 'Mateusz',
      'surname' => 'Szumiela',
      'ID_roles' => '1',
      'email' => 'szumiela@example.pl',
      'password' => bcrypt('123456'),
      'phone_number' => '555123456',
      'address' => 'ul. Łódzka 149, 62-800 Kalisz',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('users')->insert([
      'name' => 'Jacek',
      'surname' => 'Kowalski',
      'ID_roles' => '1',
      'email' => 'kowalskiJ@example.pl',
      'password' => bcrypt('123456'),
      'phone_number' => '785214968',
      'address' => 'ul. Zacisze 66, 81-823 Sopot',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('users')->insert([
      'name' => 'Rafał',
      'surname' => 'Nowak',
      'ID_roles' => '2',
      'email' => 'nowak@example.pl',
      'password' => bcrypt('123456'),
      'phone_number' => '785478632',
      'address' => 'ul. Zwycięstwa 57, 75-600 Koszalin',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('users')->insert([
      'name' => 'Krzysztof',
      'surname' => 'Rudkowski',
      'ID_roles' => '2',
      'email' => 'rudkowski@example.pl',
      'password' => bcrypt('123456'),
      'phone_number' => '784951783',
      'address' => 'ul. Podlaska 84, 20-304 Lublin',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
      DB::table('users')->insert([
      'name' => 'Józef',
      'surname' => 'Maciejewski',
      'ID_roles' => '3',
      'email' => 'maciejewski@example.pl',
      'password' => bcrypt('123456'),
      'phone_number' => '789852147',
      'address' => 'ul. Szumiących Traw 122, 03-289 Warszawa',
      'archive' => '0',
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s')
      ]);
    }
}
