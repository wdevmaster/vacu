<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePalpacionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('palpaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->integer('animal_code');
            $table->integer('celo_id');
            $table->integer('negocio_id');
            $table->datetime('fecha');
            $table->boolean('active')->default(true);
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
        Schema::drop('palpaciones');
    }
}
