<?php

namespace Database\Seeders;

use App\Models\CategoriaModulo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasModuloTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            'Configuración',
            'Reportes',
            'General',
        ];
        foreach ($categorias as $categoria) {
            DB::table('categoria_modulos')->insert([
                "nombre" => $categoria,
            ]);
        }

    }
}
