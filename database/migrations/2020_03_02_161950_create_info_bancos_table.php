<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInfoBancosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infBancos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('noCuenta');
            $table->string('tarjeta');
            $table->string('clabe');
            $table->integer('idUser');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('infBancos');
    }
}
