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
            $table->string('code');
            $table->string('nombre');
            $table->integer('numero')->nullable();
            $table->integer('negocio_id')->unsigned();
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('negocio_id')->references('id')->on('negocios');
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
