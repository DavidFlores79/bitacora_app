<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiciosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $servicios = [
            'Mantenimiento',
            'Corrección de errores',
        ];
        foreach ($servicios as $servicio) {
            DB::table('servicios')->insert([
                "categoria_id" => 2,
                "descripcion" => $servicio,
            ]);
        }
    }
}
