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
        Schema::create('historial', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ticket_id')->unsigned();
            $table->bigInteger('responsable_id')->unsigned();
            $table->bigInteger('accion_id')->unsigned();
            $table->bigInteger('accion_tipo_id')->unsigned();
            $table->text('old')->nullable();
            $table->text('new')->nullable();
            $table->bigInteger('old_especialista')->nullable()->unsigned();
            $table->bigInteger('new_especialista')->nullable()->unsigned();
            $table->timestamps();
        });
        Schema::table('historial', function($table) {
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
        });
        Schema::table('historial', function($table) {
            $table->foreign('responsable_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('historial', function($table) {
            $table->foreign('old_especialista')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('historial', function($table) {
            $table->foreign('new_especialista')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::table('historial', function($table) {
            $table->foreign('accion_id')->references('id')->on('acciones')->onDelete('cascade');
        });
        Schema::table('historial', function($table) {
            $table->foreign('accion_tipo_id')->references('id')->on('accion_tipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial');
    }
};
