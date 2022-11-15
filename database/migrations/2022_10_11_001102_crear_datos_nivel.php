<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearDatosNivel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admision.adm_nivelevaluacion', function (Blueprint $table) {
            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 50, "descripcion" => 'Especialidad', 'id_seccion' => 1]);                                          //1
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 1, "nivel" => 2, "porcentaje" => 50, "descripcion" => 'Especialidad', 'id_seccion' => 1]);                      //2
            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 42, "descripcion" => 'Conocimientos Musicales', 'id_seccion' => 1]);                               //3
            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 8, "descripcion" => 'Conocimientos Generales', 'id_seccion' => 1]);                                //4
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 3, "nivel" => 2, "porcentaje" => 14, "descripcion" => 'Audio', 'id_seccion' => 1]);                             //5
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 3, "nivel" => 2, "porcentaje" => 14, "descripcion" => 'Lectura Musical', 'id_seccion' => 1]);                   //6
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 3, "nivel" => 2, "porcentaje" => 8, "descripcion" => 'Analisis armònico', 'id_seccion' => 1]);                  //7
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 3, "nivel" => 2, "porcentaje" => 6, "descripcion" => 'Apreciaciòn', 'id_seccion' => 1]);                        //8
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 4, "nivel" => 2, "porcentaje" => 2, "descripcion" => 'RV', 'id_seccion' => 1]);                                 //9
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 4, "nivel" => 2, "porcentaje" => 2, "descripcion" => 'RM', 'id_seccion' => 1]);                                 //10
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 4, "nivel" => 2, "porcentaje" => 2, "descripcion" => 'HP', 'id_seccion' => 1]);                                 //11
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 4, "nivel" => 2, "porcentaje" => 2, "descripcion" => 'CG', 'id_seccion' => 1]);                                 //12

            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 50, "descripcion" => 'Examen de Interpretación musical', 'id_seccion' => 2]);                      //13
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 13,"nivel" => 2, "porcentaje" => 50, "descripcion" => 'Examen de Interpretación musical', 'id_seccion' => 2]);  //14
            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 50, "descripcion" => 'Conocimientos Musicales', 'id_seccion' => 2]);                               //15
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 15, "nivel" => 2, "porcentaje" => 20, "descripcion" => 'Examen de Audioperceptiva', 'id_seccion' => 2]);        //16
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 15, "nivel" => 2, "porcentaje" => 20, "descripcion" => 'Examen de Lectura Musical', 'id_seccion' => 2]);        //17
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 15, "nivel" => 2, "porcentaje" => 10, "descripcion" => 'Examen de Teoría Musical', 'id_seccion' => 2]);         //18

            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 50, "descripcion" => 'Especialidad', 'id_seccion' => 4]);                                          //19
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 19,"nivel" => 2, "porcentaje" => 50, "descripcion" => 'Examen de especialidad', 'id_seccion' => 4]);            //20
            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 50, "descripcion" => 'Conocimientos musicales', 'id_seccion' => 4]);                               //21
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 21,"nivel" => 2, "porcentaje" => 20, "descripcion" => 'Audioperceptiva', 'id_seccion' => 4]);                   //22
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 21,"nivel" => 2, "porcentaje" => 20, "descripcion" => 'Lectura musical', 'id_seccion' => 4]);                   //23
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 21,"nivel" => 2, "porcentaje" => 10, "descripcion" => 'Teoría musical', 'id_seccion' => 4]);                    //24

            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 50, "descripcion" => 'Especialidad', 'id_seccion' => 3]);                                          //25
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 25,"nivel" => 2, "porcentaje" => 50, "descripcion" => 'Examen de especialidad', 'id_seccion' => 3]);            //26
            DB::table('admision.adm_nivelevaluacion')->insert(["nivel" => 1, "porcentaje" => 50, "descripcion" => 'Conocimientos musicales', 'id_seccion' => 3]);                               //27
            DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 27,"nivel" => 2, "porcentaje" => 50, "descripcion" => 'Aptitud musical y lectura', 'id_seccion' => 3]);         //28
            //DB::table('admision.adm_nivelevaluacion')->insert(["id_up_nivel" => 21,"nivel" => 2, "porcentaje" => 20, "descripcion" => 'Lectura musical (hablada)', 'id_seccion' => 3]);       //29
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
