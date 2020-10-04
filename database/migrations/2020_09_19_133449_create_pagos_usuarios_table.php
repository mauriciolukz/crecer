<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos_usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('ciclo_id');
            $table->integer('matriz_id');
            $table->integer('comunidad');
            $table->float('comisiones',10,2);
            $table->integer('estatus');
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
        Schema::dropIfExists('pagos_usuarios');
    }
}
  