<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_examen', function (Blueprint $table) {
            $table->id('id_examen');
            $table->string('nombre');
            $table->string('descripcion')->nullable();
            $table->integer('nota_apro');
            $table->integer('nota_maxi');
            $table->char('estado',1);
            $table->bigInteger('user_regi');
            $table->bigInteger('user_actu')->nullable();
            $table->bigInteger('id_tipo_examen');
            $table->foreign('id_tipo_examen')->references('id_tipo_examen')->on('admision.adm_tipo_examen')->onDelete('cascade');
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
        Schema::dropIfExists('admision.adm_examen');
    }
}
