<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePartosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->dateTime('fecha')->nullable();
            $table->string('sexo')->nullable();
            $table->string('animal_nacido')->nullable();
            $table->string('madre_code');
            $table->boolean('active')->default(true);
            $table->boolean('positivo');
            $table->integer('raza_id')->nullable();
            $table->integer('negocio_id')->nullable();
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
        Schema::drop('partos');
    }
}
