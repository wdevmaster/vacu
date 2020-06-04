<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolApkRolBotonsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rol_apk_rol_botons', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('rol_apk_id')->unsigned();
            $table->foreign('rol_apk_id')->references('id')->on('rol_apks');

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
        Schema::drop('rol_apk_rol_botons');
    }
}
