<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Modulo;
use App\Models\Perfil;

class ModulosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('modulos')->insert([
            "categoria_modulo_id" => 2,
            "nombre" => "Empleados",
            "funcionalidad" => "Modulo para CRUD de Empleados",
            "icono" => "ni-chart-bar-32 text-secondary",
            "ruta" => "empleados",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 2,
            "nombre" => "Administradores",
            "funcionalidad" => "Modulo para CRUD de Administradores",
            "icono" => "ni-chart-bar-32 text-secondary",
            "ruta" => "administradores",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 2,
            "nombre" => "Clientes",
            "funcionalidad" => "Modulo para CRUD de Clientes",
            "icono" => "ni-chart-bar-32 text-secondary",
            "ruta" => "clientes",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 2,
            "nombre" => "Perfiles",
            "funcionalidad" => "Modulo para CRUD de Perfiles",
            "icono" => "ni-bullet-list-67 text-danger",
            "ruta" => "perfiles",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 2,
            "nombre" => "Tipo de Vehiculos",
            "funcionalidad" => "Modulo para CRUD de Tipos de Vehiculo",
            "icono" => "ni-chart-bar-32 text-secondary",
            "ruta" => "tipo-vehiculos",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 2,
            "nombre" => "Servicios",
            "funcionalidad" => "Modulo para CRUD de Servicios",
            "icono" => "ni-chart-bar-32 text-secondary",
            "ruta" => "servicios",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 2,
            "nombre" => "Roles",
            "funcionalidad" => "Modulo para CRUD de Roles",
            "icono" => "ni-chart-bar-32 text-secondary",
            "ruta" => "roles",
        ]);

        // DB::table('modulos')->insert([
        //     "categoria_modulo_id" => 1,
        //     "nombre" => "Administracion de usuarios",
        //     "funcionalidad" => "Modulo para CRUD de usuarios",
        //     "icono" => "ni-chart-bar-32 text-secondary",
        //     "ruta" => "adminusers",
        // ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 3,
            "nombre" => "Bitacora",
            "funcionalidad" => "Modulo para visualizar los movimientos de los usuarios",
            "icono" => "ni-atom text-secondary",
            "ruta" => "bitacora",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 1,
            "nombre" => "Registro de Visitas",
            "funcionalidad" => "Modulo para control de visitas a Residentes",
            "icono" => "ni-chart-bar-32 text-secondary",
            "ruta" => "registro-visitantes",
        ]);

        DB::table('modulos')->insert([
            "categoria_modulo_id" => 3,
            "nombre" => "Reporte de Visitas",
            "funcionalidad" => "Modulo que muestra el record de visitas a Residentes",
            "icono" => "ni-chart-bar-32 text-primary",
            "ruta" => "visitas",
        ]);

    }
}
