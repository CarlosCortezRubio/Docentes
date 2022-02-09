<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaRespuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_respuestas', function (Blueprint $table) {
            $table->id('id_respuesta');
            $table->bigInteger('id_postulante');
            $table->string('key');
            $table->string('respuesta');
            $table->foreign('id_postulante')->references('id_postulante')->on('admision.adm_postulante')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
