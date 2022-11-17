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
        $this->call([AccionesTableSeeder::class]);
        $this->call([AccionTiposTableSeeder::class]);
        $this->call([PermisosTableSeeder::class]);
        $this->call([CategoriasTableSeeder::class]);
        $this->call([EstatusTableSeeder::class]);
        $this->call([PrioridadesTableSeeder::class]);
        $this->call([ProyectosTableSeeder::class]);
        $this->call([SeguimientosTableSeeder::class]);
        $this->call([ServiciosTableSeeder::class]);
        $this->call([TicketTiposTableSeeder::class]);
        $this->call([PerfilsTableSeeder::class]);
        $this->call([UsersTableSeeder::class]);
        $this->call([CategoriasModuloTableSeeder::class]);
        $this->call([ModulosTableSeeder::class]);
        $this->call([ModuloPerfilPermisoTableSeeder::class]);
    }
}
