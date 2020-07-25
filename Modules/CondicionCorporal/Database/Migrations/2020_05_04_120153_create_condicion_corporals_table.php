<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCondicionCorporalsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condiciones_corporales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unique();
            $table->string('nombre');
            $table->string('descripcion');
            $table->boolean('active')->default(true);
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
        Schema::drop('condiciones_corporales');
    }
}
