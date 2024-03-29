<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriasSeeder::class);
        $this->call(ProdutoSeeder::class);
        $this->call(MesasSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
