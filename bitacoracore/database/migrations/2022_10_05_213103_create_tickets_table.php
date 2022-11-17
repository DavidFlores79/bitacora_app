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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('proyecto_id')->unsigned();
            $table->bigInteger('ticket_tipo_id')->unsigned();
            $table->bigInteger('prioridad_id')->unsigned();
            $table->bigInteger('servicio_id')->unsigned();
            $table->bigInteger('estatus_id')->unsigned();
            $table->bigInteger('seguimiento_id')->unsigned();
            $table->bigInteger('especialista_id')->unsigned();
            $table->string('titulo',25);
            $table->longText('descripcion');
            $table->longText('solucion')->nullable();
            $table->string('email')->nullable();
            $table->string('telefono',10)->nullable();
            $table->string('archivos')->nullable();
            $table->boolean('estatus')->default(true);
            $table->integer('progreso');
            $table->timestamp('fecha_cerrado')->nullable();
            $table->timestamp('fecha_vencido')->nullable();
            $table->timestamp('fecha_atencion')->nullable();
            $table->timestamps();
        });
        Schema::table('tickets', function($table) {
            $table->foreign('proyecto_id')->references('id')->on('proyectos')->onDelete('cascade');
        });
        Schema::table('tickets', function($table) {
            $table->foreign('prioridad_id')->references('id')->on('prioridades')->onDelete('cascade');
        });
        Schema::table('tickets', function($table) {
            $table->foreign('ticket_tipo_id')->references('id')->on('ticket_tipos')->onDelete('cascade');
        });
        Schema::table('tickets', function($table) {
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
        Schema::table('tickets', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('tickets', function($table) {
            $table->foreign('especialista_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('tickets', function($table) {
            $table->foreign('estatus_id')->references('id')->on('estatus')->onDelete('cascade');
        });
        Schema::table('tickets', function($table) {
            $table->foreign('seguimiento_id')->references('id')->on('seguimientos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
