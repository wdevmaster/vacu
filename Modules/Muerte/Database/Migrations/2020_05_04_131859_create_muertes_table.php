<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMuertesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('muertes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->dateTime('fecha');
            $table->integer('motivo_id');
            $table->integer('animal_id');
            $table->integer('negocio_id');
            $table->boolean('active');
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
        Schema::drop('muertes');
    }
}
