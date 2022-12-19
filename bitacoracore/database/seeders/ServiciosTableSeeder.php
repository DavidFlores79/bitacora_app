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
            'Privada Ejemplo',
            'Privada Marsella',
            'Privada Conkal',
            'Privada Mulsay',
            'Privada Sian Kaan 2',
            'Privada SantaFe Caucel',
        ];
        foreach ($servicios as $servicio) {
            DB::table('servicios')->insert([
                "nombre" => $servicio,
            ]);
        }
    }
}
