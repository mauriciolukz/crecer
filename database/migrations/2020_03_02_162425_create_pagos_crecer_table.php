<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosCrecerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagosCrecer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idUser');
            $table->integer('idCatalogoPagos');
            $table->string('comprobante');
            $table->date('fechaComprobante');
            $table->boolean('estatus');
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
        Schema::dropIfExists('pagosCrecer');
    }
}
