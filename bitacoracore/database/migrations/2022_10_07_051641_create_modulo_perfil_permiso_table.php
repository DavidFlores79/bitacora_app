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
        Schema::create('modulo_perfil_permiso', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('perfil_id')->unsigned();
            $table->bigInteger('modulo_id')->unsigned();
            $table->bigInteger('permiso_id')->unsigned();
            $table->boolean('estatus')->default(1);

            $table->timestamps();
        });

        Schema::table('modulo_perfil_permiso', function($table) {
            $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
        });
        Schema::table('modulo_perfil_permiso', function($table) {
            $table->foreign('modulo_id')->references('id')->on('modulos')->onDelete('cascade');
        });
        Schema::table('modulo_perfil_permiso', function($table) {
            $table->foreign('permiso_id')->references('id')->on('permisos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulo_perfil_permiso');
    }
};
