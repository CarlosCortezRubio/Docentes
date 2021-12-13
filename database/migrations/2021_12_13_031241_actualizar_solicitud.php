<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ActualizarSolicitud extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bdsigunm.ad_postulacion', function (Blueprint $table) {
            $table->char('codi_doce_adm',8)->nullable()->dropIfExists();
            $table->char('codi_espe_adm',5)->nullable()->dropIfExists();
            $table->char('nive_estu_adm',1)->nullable()->dropIfExists();
            $table->char('grad_estu_adm',1)->nullable()->dropIfExists();
            $table->char('flag_disc_adm',1)->nullable()->dropIfExists();
            $table->string('disc_soli_adm')->nullable()->dropIfExists();
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
