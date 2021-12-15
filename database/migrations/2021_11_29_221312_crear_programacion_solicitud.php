<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearProgramacionSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_postulante', function (Blueprint $table) {
            $table->id('id_postulante');
            $table->bigInteger('id_programacion_examen');
            $table->char('nume_docu_sol',10);
            $table->char('estado',1);
            $table->foreign('id_programacion_examen')->references('id_programacion_examen')->on('admision.adm_programacion_examen')->onDelete('cascade');
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
