<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPeriodo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_periodo', function (Blueprint $table) {
            $table->id('id_periodo');
            $table->char('anio',4);
            $table->dateTime('peri_insc_inic');
            $table->dateTime('peri_insc_fin');
            $table->dateTime('peri_eval_inic');
            $table->dateTime('peri_eval_fin');
            $table->char('estado',1);
            $table->bigInteger('user_regi');
            $table->bigInteger('user_actu')->nullable();
            $table->bigInteger('id_seccion');
            $table->foreign('id_seccion')->references('id_seccion')->on('admision.adm_seccion_estudios')->onDelete('cascade');
            $table->foreign('user_regi')->references('id')->on('admision.adm_usuario')->onDelete('cascade');
            $table->foreign('user_actu')->references('id')->on('admision.adm_usuario')->onDelete('cascade');
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
        //
    }
}
