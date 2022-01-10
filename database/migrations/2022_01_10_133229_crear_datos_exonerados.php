<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearDatosExonerados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admision.adm_seccion_estudios', function (Blueprint $table) {
           // DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00086',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73094782',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04001']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00087',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72470176',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04013']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00088',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72529875',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04116']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00089',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74530469',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04008']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00090',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75489049',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04021']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00091',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72854143',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04002']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00092',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'76585100',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04056']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00093',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71336664',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00094',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73707019',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04002']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00095',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71732634',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04001']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00096',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75960042',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04014']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00097',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'77271683',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04021']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00098',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72219764',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04005']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00099',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75606791',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04010']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00100',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73830337',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00101',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75085725',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04006']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00102',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'70420899',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04013']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00103',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71405866',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04014']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00104',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75514032',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04005']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00105',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74383557',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04012']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00106',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'77863100',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04021']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00107',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'76726517',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04002']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00108',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73887702',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04012']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00109',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71850050',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04014']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00110',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'77747973',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00111',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72810840',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04001']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00112',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71417425',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04010']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00113',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72907937',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00114',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75415502',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04013']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00115',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73314538',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00116',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71866333',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04008']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00117',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73122709',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04044']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00118',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72357393',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04001']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00119',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'47888411',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00120',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74937901',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04012']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00121',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'010778979',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00122',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73201060',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04056']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00123',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72679817',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04029']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00124',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'76270637',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04021']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00125',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75367736',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04044']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00126',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72303136',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04114']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00127',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73463811',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04010']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00128',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74695138',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04008']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00129',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71939711',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04002']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00130',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72807253',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04007']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00131',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74200616',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04014']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00132',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73639892',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04113']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00133',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01004',"nume_docu_exo"=>'082217673',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04002']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00134',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74693760',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04008']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00135',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71316304',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04029']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00136',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'77093360',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00137',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'76284299',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04113']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00138',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71249481',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04009']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00139',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75676159',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04009']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00140',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'76537006',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04032']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00141',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'47155968',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00142',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75341223',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04014']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00143',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74642271',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04113']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00144',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74361676',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04010']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00145',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72205804',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04004']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00146',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71918295',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04116']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00147',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'77430103',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04002']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00148',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73761567',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04114']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00149',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71030496',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04008']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00150',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'77045250',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04001']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00151',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74905596',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04006']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00152',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75354123',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04009']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00153',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72741515',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04010']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00154',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75140717',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04013']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00155',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73994020',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04029']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00156',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73453878',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04009']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00157',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71959178',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04010']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00158',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'73929223',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04029']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00159',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75247995',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04032']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00160',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'25705141',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00161',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'77464121',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04005']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00162',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'72776825',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00163',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71624765',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04011']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00164',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'75446903',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04033']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00165',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'71372161',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04021']);
            DB::table('bdsigunm.ad_exonerado')->insert(["codi_exon_exo"=>'00166',"codi_proc_adm"=>'00002',"tipo_docu_exo"=>'01001',"nume_docu_exo"=>'74700120',"codi_secc_exo"=>'05001',"codi_espe_exo"=>'04115']);
        });
    }
}
