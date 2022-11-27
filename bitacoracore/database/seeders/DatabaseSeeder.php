<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([PermisosTableSeeder::class]);
        $this->call([EstatusTableSeeder::class]);
        $this->call([ServiciosTableSeeder::class]);
        $this->call([PerfilsTableSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([CategoriasModuloTableSeeder::class]);
        $this->call([ModulosTableSeeder::class]);
        $this->call([ModuloPerfilPermisoTableSeeder::class]);
        $this->call([TipoVehiculoSeeder::class]);
    }
}
