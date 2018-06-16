<?php

use Illuminate\Database\Seeder;

class TrailersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trailers')->insert([
        'trailer_id_number' => 'ESI 36481',
        'capacity' => '10000',
        'capacity_palete' => '900',
        'archive' => '0',
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
        ]);
    }
}
