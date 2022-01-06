<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSeccionEstudios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admision.adm_seccion_estudios', function (Blueprint $table) {
            $table->id('id_seccion');
            $table->char('codi_secc_sec',5);
            $table->string('categoria')->nullable();
            $table->integer('edad_min')->nullable();
            $table->integer('edad_max')->nullable();
            $table->char('estado',1);
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
