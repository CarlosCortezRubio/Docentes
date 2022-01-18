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
            DB::table('admision.adm_usuario')->insert([
                "name" => "Eduardo Cahuana Juarez",
                "ndocumento" => "12345678",
                "email" => "sistemas@unm.edu.pe",
                "password" => Hash::make('AdminSistemas'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Jorge Luis Falcon Villanueva",
                "ndocumento" => "40786880",
                "email" => "postescolar.secprep@unm.edu.pe",
                "password" => Hash::make('adminpostescolar'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Miguel Ángel Alfaro",
                "ndocumento" => "47134075",
                "email" => "escolar.secprep@unm.edu.pe",
                "password" => Hash::make('adminescolar0911'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Miguel Ángel Alfaro",
                "ndocumento" => "47134075",
                "email" => "malfaro@unm.edu.pe",
                "password" => Hash::make('adminescolar1217'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Isaias Romero Vasquez",
                "ndocumento" => "99900089",
                "email" => "secsup@unm.edu.pe",
                "password" => Hash::make('adminsuperior'),
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
        //
    }
}
