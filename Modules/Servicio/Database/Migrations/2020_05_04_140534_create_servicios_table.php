<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiciosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->datatime('fecha');
            $table->integer('animal_inceminado');
            $table->integer('animal_inseminador');
            $table->integer('semen_id');
            $table->string('personal_inseminador');
            $table->boolean('active');
            $table->integer('tipo_servicio_id');
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
        Schema::drop('servicios');
    }
}
