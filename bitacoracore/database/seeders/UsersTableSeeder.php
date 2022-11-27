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
            'servicio_id' => 1,
            'nombre' => 'Super',
            'apellido' => 'Usuario',
            'nickname' => 'superuser',
            'email' => 'superuser@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'perfil_id' => 2,
            'servicio_id' => 1,
            'nombre' => 'Administrador',
            'apellido' => '',
            'nickname' => 'admin',
            'email' => 'admin@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'perfil_id' => 1,
            'servicio_id' => 1,
            'nombre' => 'david',
            'apellido' => 'Flores',
            'nickname' => 'dflores',
            'email' => 'dflores@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'perfil_id' => 3,
            'servicio_id' => 2,
            'nombre' => 'Empleado',
            'apellido' => 'Vigilante',
            'nickname' => 'empleado',
            'email' => 'empleado@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'perfil_id' => 3,
            'servicio_id' => 4,
            'nombre' => 'Empleado',
            'apellido' => 'Santa Fe',
            'nickname' => 'santafe',
            'email' => 'santafe@enlacetecnologias.mx',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
