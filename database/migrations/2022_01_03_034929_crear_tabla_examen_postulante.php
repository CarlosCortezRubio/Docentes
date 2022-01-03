<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaExamenPostulante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_Examen_Postulante', function (Blueprint $table) {
            $table->id('id_examen_postulante');
            $table->bigInteger('id_postulante');
            $table->integer('minutos');
            $table->integer('segundos');
            $table->char('estado',1);
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
