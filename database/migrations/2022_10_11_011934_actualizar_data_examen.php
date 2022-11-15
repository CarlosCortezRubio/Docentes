<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ActualizarDataExamen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.adm_examen_admision', function (Blueprint $table) {
            DB::table('admision.adm_examen_admision')->where('id_examen',1)->update(["id_nivel" => 2]);
            DB::table('admision.adm_examen_admision')->where('id_examen',2)->update(["id_nivel" => 2]);
            DB::table('admision.adm_examen_admision')->where('id_examen',3)->update(["id_nivel" => 2]);
            DB::table('admision.adm_examen_admision')->where('id_examen',4)->update(["id_nivel" => 2]);
            DB::table('admision.adm_examen_admision')->where('id_examen',5)->update(["id_nivel" => 2]);
            DB::table('admision.adm_examen_admision')->where('id_examen',6)->update(["id_nivel" => 2]);
            DB::table('admision.adm_examen_admision')->where('id_examen',7)->update(["id_nivel" => 2]);
            DB::table('admision.adm_examen_admision')->where('id_examen',21)->update(["id_nivel" => 6]);
            DB::table('admision.adm_examen_admision')->where('id_examen',8)->update(["id_nivel" => 5]);
            DB::table('admision.adm_examen_admision')->where('id_examen',9)->update(["id_nivel" => 5]);
            DB::table('admision.adm_examen_admision')->where('id_examen',10)->update(["id_nivel" => 7]);
            DB::table('admision.adm_examen_admision')->where('id_examen',11)->update(["id_nivel" => 7]);
            DB::table('admision.adm_examen_admision')->where('id_examen',12)->update(["id_nivel" => 8]);
            DB::table('admision.adm_examen_admision')->where('id_examen',13)->update(["id_nivel" => 8]);
            DB::table('admision.adm_examen_admision')->where('id_examen',19)->update(["id_nivel" => 12]);
            DB::table('admision.adm_examen_admision')->where('id_examen',20)->update(["id_nivel" => 12]);
            DB::table('admision.adm_examen_admision')->where('id_examen',18)->update(["id_nivel" => 11]);
            DB::table('admision.adm_examen_admision')->where('id_examen',16)->update(["id_nivel" => 10]);
            DB::table('admision.adm_examen_admision')->where('id_examen',17)->update(["id_nivel" => 10]);
            DB::table('admision.adm_examen_admision')->where('id_examen',14)->update(["id_nivel" => 9]);
            DB::table('admision.adm_examen_admision')->where('id_examen',15)->update(["id_nivel" => 9]);

            DB::table('admision.adm_examen_admision')->where('id_examen',22)->update(["id_nivel" => 14]);
            DB::table('admision.adm_examen_admision')->where('id_examen',32)->update(["id_nivel" => 14]);
            DB::table('admision.adm_examen_admision')->where('id_examen',33)->update(["id_nivel" => 14]);
            DB::table('admision.adm_examen_admision')->where('id_examen',34)->update(["id_nivel" => 14]);
            DB::table('admision.adm_examen_admision')->where('id_examen',35)->update(["id_nivel" => 14]);
            DB::table('admision.adm_examen_admision')->where('id_examen',23)->update(["id_nivel" => 16]);
            DB::table('admision.adm_examen_admision')->where('id_examen',24)->update(["id_nivel" => 16]);
            DB::table('admision.adm_examen_admision')->where('id_examen',25)->update(["id_nivel" => 16]);
            DB::table('admision.adm_examen_admision')->where('id_examen',26)->update(["id_nivel" => 16]);
            DB::table('admision.adm_examen_admision')->where('id_examen',31)->update(["id_nivel" => 17]);
            DB::table('admision.adm_examen_admision')->where('id_examen',36)->update(["id_nivel" => 17]);
            DB::table('admision.adm_examen_admision')->where('id_examen',27)->update(["id_nivel" => 18]);
            DB::table('admision.adm_examen_admision')->where('id_examen',28)->update(["id_nivel" => 18]);
            DB::table('admision.adm_examen_admision')->where('id_examen',29)->update(["id_nivel" => 18]);
            DB::table('admision.adm_examen_admision')->where('id_examen',30)->update(["id_nivel" => 18]);

            DB::table('admision.adm_examen_admision')->where('id_examen',38)->update(["id_nivel" => 20]);
            DB::table('admision.adm_examen_admision')->where('id_examen',40)->update(["id_nivel" => 23]);
            DB::table('admision.adm_examen_admision')->where('id_examen',42)->update(["id_nivel" => 22]);
            DB::table('admision.adm_examen_admision')->where('id_examen',43)->update(["id_nivel" => 24]);
            DB::table('admision.adm_examen_admision')->where('id_examen',44)->update(["id_nivel" => 24]);
            DB::table('admision.adm_examen_admision')->where('id_examen',41)->update(["id_nivel" => 22]);
            DB::table('admision.adm_examen_admision')->where('id_examen',45)->update(["id_nivel" => 22]);
            DB::table('admision.adm_examen_admision')->where('id_examen',46)->update(["id_nivel" => 24]);
            DB::table('admision.adm_examen_admision')->where('id_examen',47)->update(["id_nivel" => 22]);
            DB::table('admision.adm_examen_admision')->where('id_examen',48)->update(["id_nivel" => 24]);

            DB::table('admision.adm_examen_admision')->where('id_examen',37)->update(["id_nivel" => 26]);
            DB::table('admision.adm_examen_admision')->where('id_examen',39)->update(["id_nivel" => 28]);

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
