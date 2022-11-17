<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeguimientosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seguimientos = [
            'Inicio de gestión',
            'El usuario no ha podido ser contactado',
        ];
        foreach ($seguimientos as $seguimiento) {
            DB::table('seguimientos')->insert([
                "descripcion" => $seguimiento,
            ]);
        }
    }
}
