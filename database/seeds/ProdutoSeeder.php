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
        $baseObject = [
            [
                'Nome_produto' => 'Capuccino Italiano',
                'Preco_compra' => 12,
                'Preco_venda' => 12,
                'Preco_lojista' => 8,
                'Descricao' => '(Espresso, leite vaporizado, espuma e calda de chocolate).',
                'Imagem' => null,
                'idCategoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nome_produto' => 'Expresso',
                'Preco_compra' => 6,
                'Preco_venda' => 6,
                'Preco_lojista' => 5,
                'Descricao' => 'Café expresso.',
                'Imagem' => null,
                'idCategoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nome_produto' => 'Lungo',
                'Preco_compra' => 8,
                'Preco_venda' => 8,
                'Preco_lojista' => 6,
                'Descricao' => '(Suave 100 ml)',
                'Imagem' => null,
                'idCategoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nome_produto' => 'Expresso Duplo',
                'Preco_compra' => 10,
                'Preco_venda' => 10,
                'Preco_lojista' => 6,
                'Descricao' => 'Café duplo.',
                'Imagem' => null,
                'idCategoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'Nome_produto' => 'Latte',
                'Preco_compra' => 10,
                'Preco_venda' => 10,
                'Preco_lojista' => 6,
                'Descricao' => '(Espresso, leite vaporizado, pouca espuma do leite)',
                'Imagem' => null,
                'idCategoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'Nome_produto' => 'Machiato',
                'Preco_compra' => 8,
                'Preco_venda' => 8,
                'Preco_lojista' => 6,
                'Descricao' => '(Espresso, espuma de leite 30ml)',
                'Imagem' => null,
                'idCategoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),

            ],
            [
                'Nome_produto' => 'Capuccino Cremoso',
                'Preco_compra' => 12,
                'Preco_venda' => 12,
                'Preco_lojista' => 8,
                'Descricao' => '(Espresso, leite vaporizado, espuma, canela e cacau).',
                'Imagem' => null,
                'idCategoria' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]


        ];

        foreach ($baseObject as $obj) {
            DB::table('Produto')->insert($obj);
        }

        // for ($i = 1; $i <= 42; $i++) {
        //     DB::table('Produto')->insert([
        //         'Nome_produto' => 'Produto ' . $i,
        //         'Preco_compra' => rand(10, 50), // Valor aleatório entre 10 e 50
        //         'Preco_venda' => rand(60, 100), // Valor aleatório entre 60 e 100
        //         'Descricao' => 'Descrição do Produto ' . $i,
        //         'Imagem' => null,
        //         'idCategoria' => rand(1, 6), // Valor aleatório entre 1 e 6
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }


        // Add more sample data as needed
    }
}
