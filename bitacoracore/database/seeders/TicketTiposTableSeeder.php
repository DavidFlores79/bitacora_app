<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proyectos = [
            'Incidente',
            'Requerimiento',
        ];
        foreach ($proyectos as $proyecto) {
            DB::table('ticket_tipos')->insert([
                "descripcion" => $proyecto,
            ]);
        }
    }
}
