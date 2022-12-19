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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido')->nullable();
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('telefono',10)->nullable();
            $table->bigInteger('perfil_id')->unsigned();
            $table->boolean('bloqueado')->default(0);
            $table->boolean('estatus')->default(1);
            $table->string('fecha_baja')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('users', function($table) {
            $table->foreign('perfil_id')->references('id')->on('perfils')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
