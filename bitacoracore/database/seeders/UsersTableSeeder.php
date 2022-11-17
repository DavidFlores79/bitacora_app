<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'perfil_id' => 1,
            'name' => 'Super',
            'apellido' => 'Usuario',
            'email' => 'superuser@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'perfil_id' => 2,
            'name' => 'Administrador',
            'apellido' => '',
            'email' => 'admin@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'perfil_id' => 2,
            'name' => 'david',
            'apellido' => 'Flores',
            'email' => 'dflores@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'perfil_id' => 3,
            'name' => 'Empleado',
            'apellido' => '1',
            'email' => 'empleado@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
