<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permisos = [
            'Visualizar',
            'Crear',
            'Modificar',
            'Eliminar',
        ];

        foreach ($permisos as $permiso) {
            DB::table('permisos')->insert([
                'nombre' => $permiso,
            ]);
        }


    }
}
