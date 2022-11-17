<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $acciones = [
            'Creó',
            'Asignó',
            'Modificó',
        ];
        foreach ($acciones as $accion) {
            DB::table('acciones')->insert([
                "nombre" => $accion,
            ]);
        }
    }
}
