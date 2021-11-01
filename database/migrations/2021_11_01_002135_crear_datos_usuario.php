<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class CrearDatosUsuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.adm_usuario', function (Blueprint $table) {
            DB::table('admision.adm_usuario')
            ->insert([
                "name" => "Eduardo Cahuana Juarez",
                "ndocumento" => "12345678",
                "email" => "educj.3@gmail.com",
                "password" => Hash::make('12345678'),
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admision.adm_usuario', function (Blueprint $table) {
            //
        });
    }
}
