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
        // $perfiles = [
        //     'SuperUsuario',
        //     'Administrador',
        //     'Seguridad',
        //     'Cliente',
        //     'Supervisor',
        // ];
        // foreach ($perfiles as $perfil) {
        //     DB::table('perfils')->insert([
        //         "nombre" => $perfil,
        //     ]);
        // }

        DB::table('perfils')->insert([
            "nombre" => "SuperUsuario",
            "codigo" => "superuser",
        ]);
        DB::table('perfils')->insert([
            "nombre" => "Administrador",
            "codigo" => "admin",
        ]);
        DB::table('perfils')->insert([
            "nombre" => "Cliente",
            "codigo" => "client",
        ]);
        DB::table('perfils')->insert([
            "nombre" => "Seguridad",
            "codigo" => "employe",
        ]);
        DB::table('perfils')->insert([
            "nombre" => "Supervisor",
            "codigo" => "employe",
        ]);
    }
}
