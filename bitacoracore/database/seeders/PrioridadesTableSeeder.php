<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrioridadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prioridades = [
            'Alta',
            'Media',
            'Baja',
        ];
        foreach ($prioridades as $prioridad) {
            DB::table('prioridades')->insert([
                "descripcion" => $prioridad,
            ]);
        }
    }
}
