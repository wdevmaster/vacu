<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRegistroEnfermedadsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registro_enfermedads', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->datatime('fecha_enfermedad');
            $table->datatime('fecha');
            $table->boolean('active');
            $table->integer('id_animal');
            $table->integer('id_enfermedad');
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
        Schema::drop('registro_enfermedads');
    }
}
