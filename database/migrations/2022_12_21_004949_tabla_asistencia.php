<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TablaAsistencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_asistencia', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->char('codi_pers_per',8);
            $table->char('tipo',2);
            $table->timestamps();
            $table->dateTime('entrada')->nullable();
            $table->dateTime('salida')->nullable();
            $table->dateTime('fecha_asistencia');
            $table->char('estado',1);
            $table->foreign('codi_pers_per')->references('codi_pers_per')->on('bdsig.persona');
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
