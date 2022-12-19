<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Modulo;
use App\Models\Perfil;

class ModuloPerfilPermisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //Crea los permisos iniciales para Empleados
        $perfil = Perfil::where('nombre', 'Seguridad')->first();

        for ($j = 8; $j <= 8; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        $perfil->permisos()->attach($syncData);

        //Crea los permisos iniciales para Administrador
        $perfil = Perfil::where('nombre', 'Administrador')->first();

        for ($j = 1; $j <= 2; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData2[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        for ($j = 8; $j <= 8; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData2[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        $perfil->permisos()->attach($syncData2);

        //Crea los permisos iniciales para SuperUsuario
        $perfil = Perfil::where('nombre', 'SuperUsuario')->first();

        for ($j = 1; $j <= 9; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData3[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        $perfil->permisos()->attach($syncData3);

        //Crea los permisos iniciales para Cliente
        $perfiles = Perfil::where('codigo', 'client')->get();

        for ($j = 1; $j <= 2; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData4[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        for ($j = 8; $j <= 8; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData4[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }

        foreach ($perfiles as $key => $perfil) {
            $perfil->permisos()->attach($syncData4);
        }
    }
}
