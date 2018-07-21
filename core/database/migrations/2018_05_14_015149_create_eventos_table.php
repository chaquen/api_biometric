<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_ref')->unsigned();
            $table->foreign('id_ref')->references('id')->on('users');
            $table->string("name");
            $table->string("description");
            $table->dateTime("date");
            $table->string("city");
            $table->string("address");
            $table->string("atachments");
            $table->boolean("state");
            $table->string("img");
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
        Schema::drop('eventos');
    }
}
