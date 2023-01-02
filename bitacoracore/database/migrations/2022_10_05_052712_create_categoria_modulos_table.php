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
        Schema::create('categoria_modulos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre',100);
            $table->string('icono',100)->nullable();
            $table->boolean('estatus')->default(1);
            $table->boolean('eliminado')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categoria_modulos');
    }
};
