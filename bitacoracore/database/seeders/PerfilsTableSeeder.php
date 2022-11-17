<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles = [
            'SuperUsuario',
            'Administrador',
            'Empleado',
            'Cliente',
        ];
        foreach ($perfiles as $perfil) {
            DB::table('perfils')->insert([
                "nombre" => $perfil,
            ]);
        }
    }
}
