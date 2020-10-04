<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nombre');
            $table->string('apellidoPaterno');
            $table->string('apellidoMaterno');
            $table->boolean('estatus');
            $table->string('calle');
            $table->string('numero',10);
            $table->string('colonia');
            $table->string('codigoPostal',7);
            $table->integer('idMunicipio');
            $table->integer('idEstado');
            $table->string('telefono');
            $table->string('rfc',20);
            $table->string('curp',20);
            $table->integer('rol');
            $table->integer('padre');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('sigueA');
            $table->string('otraMatriz');
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
}
