<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MesasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data for the 'Produto' table
        for ($i = 1; $i <= 12; $i++) {
            DB::table('Mesas')->insert([
                'Status_mesa' => 0,
                'Preco_total' => 0,
                'Numero_mesa' => $i,
                'Fechada' => false,
                'Tipo_pagamento' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        // Add more sample data as needed
    }
}
