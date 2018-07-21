<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo_doc');
            $table->string('documento');
            $table->string('lugar_exp');
            $table->string('pri_apellido');
            $table->string('seg_apellido');
            $table->string('pri_nombre');
            $table->string('seg_nombre');
            $table->string('ciud_nacimiento');
            $table->string('dep_nacimiento');
            $table->string('fecha_nac');
            $table->string('genero');
            $table->string('cap_dife');
            $table->string('etnia');
            $table->string('zona');
            $table->string('municipio');
            $table->string('celular');
            $table->string('email');
            $table->string('escolaridad');
            $table->string('titulo_obt');
            $table->string('proceso');
            
            $table->string('organizacion');
            $table->boolean("state");
            
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
        Schema::drop('participantes');
    }
}
