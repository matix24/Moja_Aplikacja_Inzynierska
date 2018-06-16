<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seeder przykładowy jeden sprzedawca - nie jest później potrzebny
        $this->call(SellersTableSeeder::class);

        // role użytkowników - można je na stałe implementować
        $this->call(UserRolesTableSeeder::class);

        // użytkownicy - admina można stworzyć przez kreator
        $this->call(UsersTableSeeder::class);

        // samochody - można przepuścić przez kreator lub odpuścić
        $this->call(TrucksTableSeeder::class);

        // przyczepy - tak jak wyżej
        $this->call(TrailersTableSeeder::class);

        // wytrzymałość towarów implementujemy na stałe
        // $this->call(HardinessProductsTableSeeder::class);

        // jakość produktów implementujemy na stałe
        // $this->call(QualityProductsTableSeeder::class);

        // opakowanie towaru - można przepuścić przez kreator lub odpuścić
        $this->call(PackagingsProductTableSeeder::class);

        // tabela towarów - raczej pusta
        $this->call(WaresTableSeeder::class);

        // tabela dyspozycji załadunkowej
        $this->call(LoadingInstructionsTableSeeder::class);
    }
}
