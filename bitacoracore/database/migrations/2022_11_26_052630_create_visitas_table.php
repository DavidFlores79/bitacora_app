<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->bigInteger('servicio_id')->unsigned();
            $table->string('nombre_visitante');
            $table->string('nombre_quien_visita');
            $table->string('motivo_visita')->nullable();
            $table->longText('imagen_identificacion')->nullable();
            $table->bigInteger('tipo_vehiculo_id')->unsigned();
            $table->string('placas');
            $table->bigInteger('user_id')->unsigned();
            $table->dateTime('fecha_entrada')->nullable();
            $table->dateTime('fecha_salida')->nullable();
            // $table->string('fecha_entrada');
            // $table->string('fecha_salida');
            $table->boolean('actualizado');
            $table->timestamps();
        });

        Schema::table('visitas', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('visitas', function($table) {
            $table->foreign('tipo_vehiculo_id')->references('id')->on('tipo_vehiculos')->onDelete('cascade');
        });

        Schema::table('visitas', function($table) {
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
};
