<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for the 'Produto' table
        for ($i = 1; $i <= 42; $i++) {
            DB::table('Produto')->insert([
                'Nome_produto' => 'Produto ' . $i,
                'Preco_compra' => rand(10, 50), // Valor aleatório entre 10 e 50
                'Preco_venda' => rand(60, 100), // Valor aleatório entre 60 e 100
                'Descricao' => 'Descrição do Produto ' . $i,
                'Imagem' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Add more sample data as needed
    }
}
