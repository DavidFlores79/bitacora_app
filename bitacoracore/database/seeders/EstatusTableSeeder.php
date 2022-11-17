<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estatus = [
            'Registrado',
            'Asignado',
            'En Espera',
            'En Proceso',
            'Resuelto',
            'Vencido',
            'Cerrado',
            'Eliminado',
        ];
        foreach ($estatus as $estado) {
            DB::table('estatus')->insert([
                "descripcion" => $estado,
            ]);
        }
    }
}
