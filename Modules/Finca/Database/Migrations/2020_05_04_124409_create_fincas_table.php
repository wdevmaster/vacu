<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFincasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fincas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('finca_id');
            $table->string('nombre');
            $table->integer('numero');
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
        Schema::drop('fincas');
    }
}
