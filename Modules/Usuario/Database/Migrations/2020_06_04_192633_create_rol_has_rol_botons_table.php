<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolHasRolBotonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_has_rol_botons', function (Blueprint $table) {
            $table->increments('id');

            $table->bigInteger('rol_id')->unsigned();
            $table->foreign('rol_id')->references('id')->on('roles');

            $table->integer('rol_boton_id')->unsigned();
            $table->foreign('rol_boton_id')->references('id')->on('rol_botons');

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
        Schema::drop('rol_has_rol_botons');
    }
}
