<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRazasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('razas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('nombre');
            $table->boolean('active');
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
        Schema::drop('razas');
    }
}
