<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaComentarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_comentarios', function (Blueprint $table) {
            $table->id('id_comentario');
            $table->bigInteger('id_jurado_postulante');
            $table->string('comentario')->nullable();
            $table->foreign('id_jurado_postulante')->references('id_jurado_postulante')->on('admision.adm_jurado_postulante')->onDelete('cascade');
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
