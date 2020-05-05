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
        Schema::create('animals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->datetime('fecha_nacimiento');
            $table->string('sexo');
            $table->integer('lote_nacimiento_id');
            $table->string('madre_codigo');
            $table->string('padre_codigo');
            $table->string('raza_codigo');
            $table->integer('lote_actual_id');
            $table->string('locomocion_code');
            $table->string('temporal_id');
            $table->string('inventario_id');
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
        Schema::drop('animals');
    }
}
