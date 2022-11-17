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

        //Crea los permisos iniciales para Helpdesk
        $perfil = Perfil::where('nombre', 'Empleado')->first();

        for ($j = 8; $j <= 8; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        $perfil->permisos()->attach($syncData);

        //Crea los permisos iniciales para Administrador
        $perfil = Perfil::where('nombre', 'Administrador')->first();

        for ($j = 1; $j <= 5; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData2[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        $perfil->permisos()->attach($syncData2);

        //Crea los permisos iniciales para Cliente
        $perfil = Perfil::where('nombre', 'SuperUsuario')->first();

        for ($j = 6; $j <= 7; $j++) {
            for ($i = 1; $i <= 4; $i++) {
                $syncData3[] = ['modulo_id' => $j, 'permiso_id' => $i];
            }
        }
        $perfil->permisos()->attach($syncData3);
    }
}
