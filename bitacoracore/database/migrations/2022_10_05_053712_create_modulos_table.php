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
        Schema::create('modulos', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('categoria_modulo_id')->unsigned();
            $table->string('nombre',100);
            $table->text('funcionalidad')->nullable();
            $table->string('ruta',100)->nullable();
            $table->string('icono',100)->nullable();
            $table->boolean('estatus')->default(1);

            $table->timestamps();
        });

        Schema::table('modulos', function($table) {
            $table->foreign('categoria_modulo_id')->references('id')->on('categoria_modulos')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modulos');
    }
};
