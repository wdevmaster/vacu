<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLechesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->integer('animal_code');
            $table->decimal('peso');
            $table->datetime('fecha');
            $table->integer('negocio_id');
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
        Schema::drop('leches');
    }
}
