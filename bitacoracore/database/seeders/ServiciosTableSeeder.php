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
            'Servicio Ejemplo',
            'Privada Residencial Marsella',
            'Sian Kaan 2',
            'Santa Fe Caucel',
        ];
        foreach ($servicios as $servicio) {
            DB::table('servicios')->insert([
                "nombre" => $servicio,
            ]);
        }
    }
}
