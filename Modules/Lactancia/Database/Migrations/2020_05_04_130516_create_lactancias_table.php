<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLactanciasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lactancias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->dateTime('fecha');
            $table->string('leche');
            $table->string('concentrado');
            $table->string('peso');
            $table->integer('animal_id');
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
        Schema::drop('lactancias');
    }
}
