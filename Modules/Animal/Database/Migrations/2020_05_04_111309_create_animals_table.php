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
            $table->datetime('fecha_nacimiento')->nullable();
            $table->string('sexo');
            $table->boolean('temporal')->default(false);
            $table->integer('estado_id')->unsigned()->nullable();
            $table->integer('lote_nacimiento_id')->nullable();
            $table->integer('madre_codigo')->nullable();
            $table->integer('padre_codigo')->nullable();
            $table->integer('raza_codigo')->nullable();
            $table->integer('lote_actual_id')->nullable();
            $table->integer('locomocion_code')->nullable();
            $table->integer('temporal_id')->nullable();
            $table->integer('inventario_id')->nullable();
            $table->integer('negocio_id');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('cascade');
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
