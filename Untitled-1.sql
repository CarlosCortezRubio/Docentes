

CREATE TABLE "adm_examen_admision" (
  "Id_examen_admision" <type>,
  "cara_elim" <type>,
  "flag_jurado" <type>,
  "codi_secc_sec" <type>,
  "id_examen" <type>,
  CONSTRAINT "FK_adm_examen_admision.codi_secc_sec"
    FOREIGN KEY ("codi_secc_sec")
      REFERENCES "bdsig.vw_sig_seccion"("codi_secc_sec")
);

CREATE TABLE "adm_tipo_examen" (
  "Id_tipo_examen" <type>,
  "  nombre" <type>,
  "descripcion" <type>,
  "  estado" <type>
);

CREATE TABLE "adm_usuario" (
  "Id_usuario" <type>,
  "password" <type>,
  "  ndocumento" <type>,
  "  tdocumento" <type>,
  "codi_pers_per" <type>
);

CREATE TABLE "adm_periodo" (
  "   Id_periodo" <type>,
  "   anio" <type>,
  "   peri_insc_inic" <type>,
  "   peri_insc_fin" <type>,
  "   peri_eval_inic" <type>,
  "   peri_eval_fin" <type>,
  "   estado" <type>,
  "   observacion" <type>,
  "   fech_regi" <type>,
  "   fech_actu" <type>,
  "   user_regi" <type>,
  "   user_actu" <type>,
  "codi_secc_sec" <type>,
  CONSTRAINT "FK_adm_periodo.   user_regi"
    FOREIGN KEY ("   user_regi")
      REFERENCES "adm_usuario"("Id_usuario"),
  CONSTRAINT "FK_adm_periodo.   user_actu"
    FOREIGN KEY ("   user_actu")
      REFERENCES "adm_usuario"("Id_usuario"),
  CONSTRAINT "FK_adm_periodo.codi_secc_sec"
    FOREIGN KEY ("codi_secc_sec")
      REFERENCES "bdsig.vw_sig_seccion"("codi_secc_sec")
);


CREATE TABLE "adm_tipo_pregunta" (
  "id_tipo_pregunta" <type>,
  "descripcion" <type>
);

CREATE TABLE "adm_examen" (
  "id_examen" <type>,
  "  nombre" <type>,
  "descripcion" <type>,
  "nota_apro" <type>,
  "  nota_maxi" <type>,
  "  nota_mini" <type>,
  "  estado" <type>,
  "  fech_regi" <type>,
  "  fech_actu" <type>,
  "  user_regi" <type>,
  "  user_actu" <type>,
  "id_tipo_examen" <type>,
  CONSTRAINT "FK_adm_examen.  user_actu"
    FOREIGN KEY ("  user_actu")
      REFERENCES "adm_usuario"("Id_usuario"),
  CONSTRAINT "FK_adm_examen.  user_regi"
    FOREIGN KEY ("  user_regi")
      REFERENCES "adm_usuario"("Id_usuario"),
  CONSTRAINT "FK_adm_examen.id_tipo_examen"
    FOREIGN KEY ("id_tipo_examen")
      REFERENCES "adm_tipo_examen"("Id_tipo_examen")
);

CREATE TABLE "adm_seccion_examen" (
  "id_seccion_examen" <type>,
  "descripcion" <type>,
  "porcentaje" <type>,
  "  estado" <type>,
  "id_examen" <type>,
  CONSTRAINT "FK_adm_seccion_examen.id_examen"
    FOREIGN KEY ("id_examen")
      REFERENCES "adm_examen"("id_examen")
);

CREATE TABLE "adm_pregunta" (
  "id_pregunta" <type>,
  "descripcion" <type>,
  "  puntaje" <type>,
  "id_evaluacion" <type>,
  "  id_tipo_pregunta" <type>,
  CONSTRAINT "FK_adm_pregunta.  id_tipo_pregunta"
    FOREIGN KEY ("  id_tipo_pregunta")
      REFERENCES "adm_tipo_pregunta"("id_tipo_pregunta"),
  CONSTRAINT "FK_adm_pregunta.id_evaluacion"
    FOREIGN KEY ("id_evaluacion")
      REFERENCES "adm_seccion_examen"("id_seccion_examen")
);

CREATE TABLE "adm_opcion" (
  "id_opcion" <type>,
  "descripcion" <type>,
  "  flag_correcta" <type>,
  "id_pregunta" <type>,
  CONSTRAINT "FK_adm_opcion.id_pregunta"
    FOREIGN KEY ("id_pregunta")
      REFERENCES "adm_pregunta"("id_pregunta")
);





CREATE TABLE "adm_aula" (
  "id_aula" <type>,
  "descripcion" <type>
);

CREATE TABLE "adm_cupos" (
  "id_cupos" <type>,
  "cant_cupo" <type>,
  "observacion" <type>,
  "  fech_regi" <type>,
  "  fech_actu" <type>,
  "  estado" <type>,
  "codi_espe_esp" <type>,
  "id_periodo" <type>,
  "user_regi" <type>,
  "user_actu" <type>,
  CONSTRAINT "FK_adm_cupos.codi_espe_esp"
    FOREIGN KEY ("codi_espe_esp")
      REFERENCES "bdsig.vw_sig_seccion_especialidad"("codi_espe_esp"),
  CONSTRAINT "FK_adm_cupos.user_actu"
    FOREIGN KEY ("user_actu")
      REFERENCES "adm_usuario"("Id_usuario"),
  CONSTRAINT "FK_adm_cupos.id_periodo"
    FOREIGN KEY ("id_periodo")
      REFERENCES "adm_periodo"("   Id_periodo"),
  CONSTRAINT "FK_adm_cupos.user_regi"
    FOREIGN KEY ("user_regi")
      REFERENCES "adm_usuario"("Id_usuario")
);

CREATE TABLE "adm_programacion_examen" (
  "id_programacion_examen" <type>,
  "descripcion" <type>,
  "  fecha_resolucion" <type>,
  "  hora_inicio" <type>,
  "  hora_fin" <type>,
  "  minutos_resolucion" <type>,
  "  modalidad" <type>,
  "  estado" <type>,
  "  fech_regi" <type>,
  "  fech_actu" <type>,
  "  id_aula" <type>,
  "  id_examen" <type>,
  "  id_cupos" <type>,
  "  user_regi" <type>,
  "  user_actu" <type>,
  CONSTRAINT "FK_adm_programacion_examen.  user_actu"
    FOREIGN KEY ("  user_actu")
      REFERENCES "adm_usuario"("Id_usuario"),
  CONSTRAINT "FK_adm_programacion_examen.  id_aula"
    FOREIGN KEY ("  id_aula")
      REFERENCES "adm_aula"("id_aula"),
  CONSTRAINT "FK_adm_programacion_examen.  id_examen"
    FOREIGN KEY ("  id_examen")
      REFERENCES "adm_examen"("id_examen"),
  CONSTRAINT "FK_adm_programacion_examen.  user_regi"
    FOREIGN KEY ("  user_regi")
      REFERENCES "adm_usuario"("Id_usuario"),
  CONSTRAINT "FK_adm_programacion_examen.  id_cupos"
    FOREIGN KEY ("  id_cupos")
      REFERENCES "adm_cupos"("id_cupos")
);

CREATE TABLE "adm_pregunta_audio" (
  "id_pregunta_audio" <type>,
  "urlsource" <type>,
  "id_pregunta" <type>
);

CREATE TABLE "adm_asigna_alumno" (
  "id_asigna_alumno" <type>,
  "codi_post_pos" <type>,
  "  id_programacion_examen" <type>,
  CONSTRAINT "FK_adm_asigna_alumno.  id_programacion_examen"
    FOREIGN KEY ("  id_programacion_examen")
      REFERENCES "adm_programacion_examen"("id_programacion_examen"),
  CONSTRAINT "FK_adm_asigna_alumno.codi_post_pos"
    FOREIGN KEY ("codi_post_pos")
      REFERENCES "ad_postulacion"("codi_post_pos")
);

CREATE TABLE "adm_tipo_usuario" (
  "Id_tipo_usuario" <type>,
  "descripcion" <type>,
  "  estado" <type>
);

CREATE TABLE "adm_usuario_admision" (
  "Id_user_admision" <type>,
  "  ultimo_inicio" <type>,
  "  estado" <type>,
  "codi_secc_sec" <type>,
  "id_usuario" <type>,
  "  id_tipo_usuario" <type>,
  CONSTRAINT "FK_adm_usuario_admision.  id_tipo_usuario"
    FOREIGN KEY ("  id_tipo_usuario")
      REFERENCES "adm_tipo_usuario"("Id_tipo_usuario"),
  CONSTRAINT "FK_adm_usuario_admision.codi_secc_sec"
    FOREIGN KEY ("codi_secc_sec")
      REFERENCES "bdsig.vw_sig_seccion"("codi_secc_sec")
);























CREATE TABLE IF NOT EXISTS admision.adm_usuario
(
    username character varying(25) COLLATE pg_catalog."default" NOT NULL,
    password character varying(255) COLLATE pg_catalog."default",
    tdocumento character varying(5) COLLATE pg_catalog."default" NOT NULL,
    ndocumento character varying(20) COLLATE pg_catalog."default" NOT NULL,
    email character varying(100) COLLATE pg_catalog."default",
    created_at timestamp(6) without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp(6) without time zone,
    remember_token character varying(100) COLLATE pg_catalog."default",
    token_key character varying(255) COLLATE pg_catalog."default",
    codi_pers_per character(8) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT pkadm_usuario PRIMARY KEY (username),
    CONSTRAINT "FK_adm_usuario.codi_pers_per" FOREIGN KEY (codi_pers_per)
        REFERENCES bdsig.persona (codi_pers_per) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

CREATE TABLE IF NOT EXISTS admision.adm_tipo_pregunta
(
    id_tipo_pregunta character varying(4) COLLATE pg_catalog."default" NOT NULL,
    descripcion character varying(250) COLLATE pg_catalog."default",
    CONSTRAINT pkadm_tipo_pregunta PRIMARY KEY (id_tipo_pregunta)
)

CREATE TABLE IF NOT EXISTS admision.adm_tipo_examen
(
    id_tipo_examen character varying(4) COLLATE pg_catalog."default" NOT NULL,
    nombre character varying(250) COLLATE pg_catalog."default" NOT NULL,
    descripcion character varying(1000) COLLATE pg_catalog."default",
    estado character(1) COLLATE pg_catalog."default" NOT NULL DEFAULT 'A'::bpchar,
    CONSTRAINT pkadm_tipo_examen PRIMARY KEY (id_tipo_examen)
)

CREATE TABLE IF NOT EXISTS admision.adm_seccion_examen
(
    id_seccion_examen integer NOT NULL DEFAULT nextval('admision.adm_seccion_examen_id_seq'::regclass),
    descripcion character varying(1000) COLLATE pg_catalog."default",
    porcentaje numeric,
    estado character(1) COLLATE pg_catalog."default" NOT NULL DEFAULT 'A'::bpchar,
    id_examen integer NOT NULL,
    CONSTRAINT pkadm_seccion_examen PRIMARY KEY (id_seccion_examen),
    CONSTRAINT "FK_adm_seccion_examen.id_examen" FOREIGN KEY (id_examen)
        REFERENCES admision.adm_examen (id_examen) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

CREATE TABLE IF NOT EXISTS admision.adm_pregunta
(
    id_pregunta integer NOT NULL DEFAULT nextval('admision.adm_pregunta_id_seq'::regclass),
    descripcion character varying(1000) COLLATE pg_catalog."default",
    puntaje numeric,
    id_evaluacion integer,
    id_tipo_pregunta character varying(4) COLLATE pg_catalog."default",
    CONSTRAINT pkadm_pregunta PRIMARY KEY (id_pregunta),
    CONSTRAINT "FK_adm_pregunta.id_evaluacion" FOREIGN KEY (id_evaluacion)
        REFERENCES admision.adm_seccion_examen (id_seccion_examen) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "FK_adm_pregunta.id_tipo_pregunta" FOREIGN KEY (id_tipo_pregunta)
        REFERENCES admision.adm_tipo_pregunta (id_tipo_pregunta) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

CREATE TABLE IF NOT EXISTS admision.adm_periodo
(
    id_periodo integer NOT NULL DEFAULT nextval('admision.adm_periodo_id_seq'::regclass),
    anio character varying(4) COLLATE pg_catalog."default" NOT NULL,
    peri_insc_inic timestamp without time zone NOT NULL,
    peri_insc_fin timestamp without time zone NOT NULL,
    peri_eval_inic timestamp without time zone NOT NULL,
    peri_eval_fin timestamp without time zone NOT NULL,
    estado character(1) COLLATE pg_catalog."default" NOT NULL DEFAULT 'A'::bpchar,
    observacion character varying(1000) COLLATE pg_catalog."default",
    fech_regi timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fech_actu timestamp without time zone,
    user_regi character varying(25) COLLATE pg_catalog."default",
    user_actu character varying(25) COLLATE pg_catalog."default",
    codi_secc_sec character varying(5) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT pkadm_periodo PRIMARY KEY (id_periodo),
    CONSTRAINT "FK_adm_periodo.user_actu" FOREIGN KEY (user_actu)
        REFERENCES admision.adm_usuario (username) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "FK_adm_periodo.user_regi" FOREIGN KEY (user_regi)
        REFERENCES admision.adm_usuario (username) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

CREATE TABLE IF NOT EXISTS admision.adm_examen_admision
(
    id_examen_admision integer NOT NULL DEFAULT nextval('admision.adm_examen_admision_id_seq'::regclass),
    flag_cara_elim character(1) COLLATE pg_catalog."default" NOT NULL,
    flag_jura character(1) COLLATE pg_catalog."default" NOT NULL,
    codi_secc_sec character varying(5) COLLATE pg_catalog."default" NOT NULL,
    id_examen integer NOT NULL,
    CONSTRAINT pkadm_examen_admision PRIMARY KEY (id_examen_admision),
    CONSTRAINT "FK_adm_examen_admision.id_examen" FOREIGN KEY (id_examen)
        REFERENCES admision.adm_examen (id_examen) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

CREATE TABLE IF NOT EXISTS admision.adm_examen
(
    id_examen integer NOT NULL DEFAULT nextval('admision.adm_examen_id_seq'::regclass),
    nombre character varying(250) COLLATE pg_catalog."default" NOT NULL,
    descripcion character varying(1000) COLLATE pg_catalog."default",
    nota_apro integer NOT NULL,
    nota_maxi integer NOT NULL,
    nota_mini integer NOT NULL,
    estado character(1) COLLATE pg_catalog."default" NOT NULL DEFAULT 'A'::bpchar,
    fech_regi timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    fech_actu timestamp without time zone,
    user_regi character varying(25) COLLATE pg_catalog."default",
    user_actu character varying(25) COLLATE pg_catalog."default",
    id_tipo_examen character varying(4) COLLATE pg_catalog."default",
    CONSTRAINT pkadm_examen PRIMARY KEY (id_examen),
    CONSTRAINT "FK_adm_examen.id_tipo_examen" FOREIGN KEY (id_tipo_examen)
        REFERENCES admision.adm_tipo_examen (id_tipo_examen) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "FK_adm_examen.user_actu" FOREIGN KEY (user_actu)
        REFERENCES admision.adm_usuario (username) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT "FK_adm_examen.user_regi" FOREIGN KEY (user_regi)
        REFERENCES admision.adm_usuario (username) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)