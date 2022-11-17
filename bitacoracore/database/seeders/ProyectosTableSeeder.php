<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyectosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proyectos = [
            'HOPE SUCURSALES',
            'HOPE MOVIL',
            'HOPE PROVEEDORES',
        ];
        foreach ($proyectos as $proyecto) {
            DB::table('proyectos')->insert([
                "nombre" => $proyecto,
            ]);
        }
    }
}
