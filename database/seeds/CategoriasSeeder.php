<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1
        DB::table('Categorias')->insert([
            'Nome_categoria' => 'Bebidas',
            'Descricao' => 'Bebidas em geral'
        ]);

        //2
        DB::table('Categorias')->insert([
            'Nome_categoria' => 'Cafés',
            'Descricao' => 'Cafés em geral'
        ]);

        //3
        DB::table('Categorias')->insert([
            'Nome_categoria' => 'Gelados',
            'Descricao' => 'Gelados em geral'
        ]);

        //4
        DB::table('Categorias')->insert([
            'Nome_categoria' => 'Salgados',
            'Descricao' => 'Salgados em geral'
        ]);

        //5
        DB::table('Categorias')->insert([
            'Nome_categoria' => 'Especiais',
            'Descricao' => 'Especiais em geral'
        ]);

        //6
        DB::table('Categorias')->insert([
            'Nome_categoria' => 'Bolos',
            'Descricao' => 'Bolos em geral'
        ]);
    }
}
