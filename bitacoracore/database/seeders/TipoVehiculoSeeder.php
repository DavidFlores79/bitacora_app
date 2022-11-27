<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tiposVehiculo = [
            'Automovil',
            'Moticicleta',
            'Camion',
        ];
        foreach ($tiposVehiculo as $tipoVehiculo) {
            DB::table('tipo_vehiculos')->insert([
                "nombre" => $tipoVehiculo,
            ]);
        }
    }
}
