<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnimalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unique();
            $table->datetime('fecha_nacimiento');
            $table->string('sexo');
            $table->integer('lote_nacimiento_id');
            $table->integer('madre_codigo');
            $table->integer('padre_codigo');
            $table->integer('raza_codigo');
            $table->integer('lote_actual_id');
            $table->integer('locomocion_code');
            $table->integer('temporal_id');
            $table->integer('inventario_id');
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
        Schema::drop('animales');
    }
}
