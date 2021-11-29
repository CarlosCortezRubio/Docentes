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
                "name" => "Malak Jorge",
                "ndocumento" => "12345678",
                "email" => "admin@hotmail.com",
                "password" => Hash::make('12345678'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Ester Palma",
                "ndocumento" => "87654321",
                "email" => "docentesuperior@hotmail.com",
                "password" => Hash::make('12345678'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Almudena Amores",
                "ndocumento" => "96874218",
                "email" => "adminsuperior@hotmail.com",
                "password" => Hash::make('12345678'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Mirian Antunez",
                "ndocumento" => "12345879",
                "email" => "docenteposescolar@hotmail.com",
                "password" => Hash::make('12345678'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Ali Palomo",
                "ndocumento" => "14523687",
                "email" => "adminposescolar@hotmail.com",
                "password" => Hash::make('12345678'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Javi Saez",
                "ndocumento" => "78546328",
                "email" => "docentescolar@hotmail.com",
                "password" => Hash::make('12345678'),
            ]);
            DB::table('admision.adm_usuario')->insert([
                "name" => "Jose-Luis Pacheco",
                "ndocumento" => "78854632",
                "email" => "adminescolar@hotmail.com",
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
