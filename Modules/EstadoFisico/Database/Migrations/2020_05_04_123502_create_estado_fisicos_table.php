<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEstadoFisicosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_fisicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->datetime('fecha');
            $table->integer('animal_id');
            $table->boolean('active')->default(true);
            $table->integer('condicion_id');
            $table->integer('locomocion_id');
            $table->integer('negocio_id');
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
        Schema::drop('estados_fisicos');
    }
}
