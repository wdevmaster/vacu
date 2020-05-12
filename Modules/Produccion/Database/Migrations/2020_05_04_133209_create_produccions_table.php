<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProduccionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producciones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->dateTime('fecha');
            $table->string('peso');
            $table->boolean('active');
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
        Schema::drop('producciones');
    }
}
