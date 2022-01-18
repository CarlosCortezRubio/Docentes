<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaJuradoPostulante extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_jurado_postulante', function (Blueprint $table) {
            $table->id('id_jurado_postulante');
            $table->bigInteger('id_jurado');
            $table->bigInteger('id_postulante');
            $table->char('estado',1);
            $table->foreign('id_jurado')->references('id_jurado')->on('admision.adm_jurado')->onDelete('cascade');
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
