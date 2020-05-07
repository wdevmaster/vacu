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
            $table->string('code');
            $table->dateTime('fecha');
            $table->string('sexo');
            $table->string('animal_nacido');
            $table->string('madre_code');
            $table->boolean('active');
            $table->integer('raza_id');
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
