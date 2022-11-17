<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'Sap',
            'Desarrollo',
        ];
        foreach ($categorias as $categoria) {
            DB::table('categorias')->insert([
                "descripcion" => $categoria,
            ]);
        }
    }
}
