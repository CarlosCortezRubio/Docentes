<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaAudioTemporal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_audiostmp', function (Blueprint $table) {
            $table->id('id_audio');
            $table->bigInteger('id_examen_postulante');
            $table->string('archivo');
            $table->char('estado',1);
            $table->integer('contador');
            $table->foreign('id_examen_postulante')->references('id_examen_postulante')->on('admision.adm_examen_postulante')->onDelete('cascade');
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
