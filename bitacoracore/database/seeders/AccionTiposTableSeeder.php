<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccionTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            'Responsable',
            'Estatus',
            'Seguimiento',
            'Prioridad',
            'Proyecto',
            'Tipo',
            'Servicio'
        ];
        foreach ($tipos as $tipo) {
            DB::table('accion_tipos')->insert([
                "descripcion" => $tipo,
            ]);
        }
    }
}
