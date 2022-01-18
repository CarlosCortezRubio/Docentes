<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearJurado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_jurado', function (Blueprint $table) {
            $table->id('id_jurado');
            $table->bigInteger('id_programacion_examen');
            $table->char('codi_doce_per',8);
            $table->char('estado',1);
            $table->foreign('codi_doce_per')->references('codi_pers_per')->on('bdsig.persona')->onDelete('cascade');
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
