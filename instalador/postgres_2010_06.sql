SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

--
-- TOC entry 20 (class 1255 OID 16385)
-- Dependencies: 6
-- Name: concat(text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION concat(text, text) RETURNS text
    AS $_$select case when $1 = '' then $2 else ($1 || ', ' || $2) end$_$
    LANGUAGE sql;


ALTER FUNCTION public.concat(text, text) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1748 (class 1259 OID 16386)
-- Dependencies: 2140 2141 2142 2143 6
-- Name: anexos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos (
    anex_radi_nume numeric(15,0) NOT NULL,
    anex_codigo character varying(20) NOT NULL,
    anex_tipo numeric(4,0) NOT NULL,
    anex_tamano numeric,
    anex_solo_lect character varying(1) NOT NULL,
    anex_creador character varying(15) NOT NULL,
    anex_desc character varying(512),
    anex_numero numeric(5,0) NOT NULL,
    anex_nomb_archivo character varying(50) NOT NULL,
    anex_borrado character varying(1) NOT NULL,
    anex_origen numeric(1,0) DEFAULT 0,
    anex_ubic character varying(15),
    anex_salida numeric(1,0) DEFAULT 0,
    radi_nume_salida numeric(15,0),
    anex_radi_fech timestamp without time zone,
    anex_estado numeric(1,0) DEFAULT 0,
    usua_doc character varying(14),
    sgd_rem_destino numeric(1,0) DEFAULT 0,
    anex_fech_envio timestamp without time zone,
    sgd_dir_tipo numeric(4,0),
    anex_fech_impres date,
    anex_depe_creador numeric(4,0),
    sgd_doc_secuencia numeric(15,0),
    sgd_doc_padre character varying(20),
    sgd_arg_codigo numeric(2,0),
    sgd_tpr_codigo numeric(4,0),
    sgd_deve_codigo numeric(2,0),
    sgd_deve_fech timestamp without time zone,
    sgd_fech_impres timestamp without time zone,
    anex_fech_anex timestamp without time zone,
    anex_depe_codi character varying(3),
    sgd_pnufe_codi numeric(4,0),
    sgd_dnufe_codi numeric(4,0),
    anex_usudoc_creador character varying(15),
    sgd_fech_doc timestamp without time zone,
    sgd_apli_codi numeric(4,0),
    sgd_trad_codigo numeric(2,0),
    sgd_dir_direccion character varying(150),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_exp_numero character varying(18)
);


ALTER TABLE public.anexos OWNER TO postgres;

--
-- TOC entry 1749 (class 1259 OID 16396)
-- Dependencies: 2144 6
-- Name: anexos_historico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos_historico (
    anex_hist_anex_codi character varying(20) NOT NULL,
    anex_hist_num_ver numeric(4,0) NOT NULL,
    anex_hist_tipo_mod character varying(2) NOT NULL,
    anex_hist_usua character varying(15) NOT NULL,
    anex_hist_fecha timestamp without time zone DEFAULT now() NOT NULL,
    usua_doc character varying(14)
);


ALTER TABLE public.anexos_historico OWNER TO postgres;

--
-- TOC entry 1750 (class 1259 OID 16400)
-- Dependencies: 6
-- Name: anexos_tipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos_tipo (
    anex_tipo_codi numeric(4,0) NOT NULL,
    anex_tipo_ext character varying(10) NOT NULL,
    anex_tipo_desc character varying(50)
);


ALTER TABLE public.anexos_tipo OWNER TO postgres;

--
-- TOC entry 1751 (class 1259 OID 16403)
-- Dependencies: 2145 2146 2147 6
-- Name: bodega_empresas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bodega_empresas (
    nombre_de_la_empresa character varying(160),
    nuir character varying(13),
    nit_de_la_empresa character varying(80),
    sigla_de_la_empresa character varying(80),
    direccion character varying(4000),
    codigo_del_departamento character varying(4000),
    codigo_del_municipio character varying(4000),
    telefono_1 character varying(4000),
    telefono_2 character varying(4000),
    email character varying(4000),
    nombre_rep_legal character varying(4000),
    cargo_rep_legal character varying(4000),
    identificador_empresa numeric(5,0) NOT NULL,
    are_esp_secue numeric(8,0) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    activa numeric(1,0) DEFAULT 1,
    flag_rups character(1)
);


ALTER TABLE public.bodega_empresas OWNER TO postgres;

--
-- TOC entry 1752 (class 1259 OID 16412)
-- Dependencies: 6
-- Name: borrar_carpeta_personalizada; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE borrar_carpeta_personalizada (
    carp_per_codi numeric(2,0) NOT NULL,
    carp_per_usu character varying(15) NOT NULL,
    carp_per_desc character varying(80) NOT NULL
);


ALTER TABLE public.borrar_carpeta_personalizada OWNER TO postgres;

--
-- TOC entry 1753 (class 1259 OID 16415)
-- Dependencies: 6
-- Name: carpeta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE carpeta (
    carp_codi numeric(2,0) NOT NULL,
    carp_desc character varying(80) NOT NULL
);


ALTER TABLE public.carpeta OWNER TO postgres;

--
-- TOC entry 1754 (class 1259 OID 16418)
-- Dependencies: 6
-- Name: carpeta_per; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE carpeta_per (
    usua_codi numeric(10,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    nomb_carp character varying(10),
    desc_carp character varying(30),
    codi_carp numeric(3,0)
);


ALTER TABLE public.carpeta_per OWNER TO postgres;

--
-- TOC entry 1755 (class 1259 OID 16421)
-- Dependencies: 6
-- Name: centro_poblado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE centro_poblado (
    cpob_codi numeric(4,0) NOT NULL,
    muni_codi numeric(4,0) NOT NULL,
    dpto_codi numeric(2,0) NOT NULL,
    cpob_nomb character varying(100) NOT NULL,
    cpob_nomb_anterior character varying(100)
);


ALTER TABLE public.centro_poblado OWNER TO postgres;

--
-- TOC entry 1756 (class 1259 OID 16424)
-- Dependencies: 2148 2149 6
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE departamento (
    dpto_codi numeric(2,0) NOT NULL,
    dpto_nomb character varying(70) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170
);


ALTER TABLE public.departamento OWNER TO postgres;

--
-- TOC entry 1757 (class 1259 OID 16429)
-- Dependencies: 2150 2151 2152 6
-- Name: dependencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dependencia (
    depe_codi numeric(5,0) NOT NULL,
    depe_nomb character varying(70) NOT NULL,
    dpto_codi numeric(2,0),
    depe_codi_padre numeric(5,0),
    muni_codi numeric(4,0),
    depe_codi_territorial numeric(4,0),
    dep_sigla character varying(100),
    dep_central numeric(1,0),
    dep_direccion character varying(100),
    depe_num_interna numeric(4,0),
    depe_num_resolucion numeric(4,0),
    depe_rad_tp1 numeric(3,0),
    depe_rad_tp2 numeric(3,0),
    depe_rad_tp3 numeric(3,0),
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    depe_estado numeric(1,0) DEFAULT 1
);


ALTER TABLE public.dependencia OWNER TO postgres;

--
-- TOC entry 1758 (class 1259 OID 16435)
-- Dependencies: 6
-- Name: dependencia_visibilidad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dependencia_visibilidad (
    codigo_visibilidad numeric(18,0) NOT NULL,
    dependencia_visible numeric(5,0) NOT NULL,
    dependencia_observa numeric(5,0) NOT NULL
);


ALTER TABLE public.dependencia_visibilidad OWNER TO postgres;

--
-- TOC entry 1759 (class 1259 OID 16438)
-- Dependencies: 6
-- Name: encuesta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE encuesta (
    usua_doc character varying(14) NOT NULL,
    fecha timestamp without time zone,
    p1 character varying(100),
    p2 character varying(100),
    p3 character varying(100),
    p4 character varying(100),
    p5 character varying(100),
    p6 character varying(100),
    p7 character varying(100),
    p7_cual character varying(150),
    p8 character varying(100),
    p9 character varying(100),
    p10 character varying(100),
    p11 character varying(100),
    p12 character varying(100),
    p13 character varying(100),
    p14 character varying(100),
    p15 character varying(100),
    p16 character varying(100),
    p17 character varying(100),
    p18 character varying(100),
    p19 character varying(100),
    p20 character varying(100),
    p20_cual character varying(150),
    p21 character varying(100),
    p22 character varying(100),
    p23 character varying(100),
    p24 character varying(100),
    p25 character varying(100)
);


ALTER TABLE public.encuesta OWNER TO postgres;

--
-- TOC entry 1760 (class 1259 OID 16444)
-- Dependencies: 6
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estado (
    esta_codi numeric(2,0) NOT NULL,
    esta_desc character varying(100) NOT NULL
);


ALTER TABLE public.estado OWNER TO postgres;

--
-- TOC entry 1761 (class 1259 OID 16447)
-- Dependencies: 2153 6
-- Name: fun_funcionario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE fun_funcionario (
    usua_doc character varying(14),
    usua_fech_crea timestamp without time zone NOT NULL,
    usua_esta character varying(10) NOT NULL,
    usua_nomb character varying(45),
    usua_ext numeric(4,0),
    usua_nacim date,
    usua_email character varying(50),
    usua_at character varying(15),
    usua_piso numeric(2,0),
    cedula_ok character(1) DEFAULT 'n'::bpchar,
    cedula_suip character varying(15),
    nombre_suip character varying(45),
    observa character(20)
);


ALTER TABLE public.fun_funcionario OWNER TO postgres;

--
-- TOC entry 1762 (class 1259 OID 16451)
-- Dependencies: 6
-- Name: hist_eventos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE hist_eventos (
    depe_codi numeric(5,0) NOT NULL,
    hist_fech timestamp without time zone NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    hist_obse character varying(600) NOT NULL,
    usua_codi_dest numeric(10,0),
    usua_doc character varying(14),
    usua_doc_old character varying(15),
    sgd_ttr_codigo numeric(3,0),
    hist_usua_autor character varying(14),
    hist_doc_dest character varying(14),
    depe_codi_dest numeric(3,0)
);


ALTER TABLE public.hist_eventos OWNER TO postgres;

--
-- TOC entry 1763 (class 1259 OID 16457)
-- Dependencies: 2154 6
-- Name: informados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE informados (
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    depe_codi numeric(3,0) NOT NULL,
    info_desc character varying(600),
    info_fech timestamp without time zone NOT NULL,
    info_leido numeric(1,0) DEFAULT 0,
    usua_codi_info numeric(3,0),
    info_codi numeric(10,0),
    usua_doc character varying(14)
);


ALTER TABLE public.informados OWNER TO postgres;

--
-- TOC entry 1764 (class 1259 OID 16464)
-- Dependencies: 6
-- Name: medio_recepcion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE medio_recepcion (
    mrec_codi numeric(2,0) NOT NULL,
    mrec_desc character varying(100) NOT NULL
);


ALTER TABLE public.medio_recepcion OWNER TO postgres;

--
-- TOC entry 1765 (class 1259 OID 16467)
-- Dependencies: 2155 2156 2157 6
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE municipio (
    muni_codi numeric(4,0) NOT NULL,
    dpto_codi numeric(2,0) NOT NULL,
    muni_nomb character varying(100) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    homologa_muni character varying(10),
    homologa_idmuni numeric(4,0),
    activa numeric(1,0) DEFAULT 1
);


ALTER TABLE public.municipio OWNER TO postgres;

--
-- TOC entry 1766 (class 1259 OID 16473)
-- Dependencies: 6
-- Name: par_serv_servicios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE par_serv_servicios (
    par_serv_secue numeric(8,0) NOT NULL,
    par_serv_codigo character varying(5),
    par_serv_nombre character varying(100),
    par_serv_estado character varying(1)
);


ALTER TABLE public.par_serv_servicios OWNER TO postgres;

--
-- TOC entry 1767 (class 1259 OID 16476)
-- Dependencies: 2158 2159 2160 6
-- Name: pl_generado_plg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pl_generado_plg (
    depe_codi numeric(5,0),
    radi_nume_radi numeric(15,0),
    plt_codi numeric(4,0),
    plg_codi numeric(4,0),
    plg_comentarios character varying(150),
    plg_analiza numeric(10,0),
    plg_firma numeric(10,0),
    plg_autoriza numeric(10,0),
    plg_imprime numeric(10,0),
    plg_envia numeric(10,0),
    plg_archivo_tmp character varying(150),
    plg_archivo_final character varying(150),
    plg_nombre character varying(30),
    plg_crea numeric(10,0) DEFAULT 0,
    plg_autoriza_fech timestamp without time zone,
    plg_imprime_fech timestamp without time zone,
    plg_envia_fech timestamp without time zone,
    plg_crea_fech timestamp without time zone,
    plg_creador character varying(20),
    pl_codi numeric(4,0),
    usua_doc character varying(14),
    sgd_rem_destino numeric(1,0) DEFAULT 0,
    radi_nume_sal numeric(15,0) DEFAULT 0
);


ALTER TABLE public.pl_generado_plg OWNER TO postgres;

--
-- TOC entry 1768 (class 1259 OID 16485)
-- Dependencies: 6
-- Name: pl_tipo_plt; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pl_tipo_plt (
    plt_codi numeric(4,0) NOT NULL,
    plt_desc character varying(35)
);


ALTER TABLE public.pl_tipo_plt OWNER TO postgres;

--
-- TOC entry 1769 (class 1259 OID 16488)
-- Dependencies: 6
-- Name: plan_table; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plan_table (
    statement_id character varying(30),
    "TIMESTAMP" date,
    remarks character varying(80),
    operation character varying(30),
    options character varying(30),
    object_node character varying(128),
    object_owner character varying(30),
    object_name character varying(30),
    object_instance numeric,
    object_type character varying(30),
    optimizer character varying(255),
    search_columns numeric,
    id numeric,
    parent_id numeric,
    "POSITION" numeric,
    cost numeric,
    cardinality numeric,
    bytes numeric,
    other_tag character varying(255),
    partition_start character varying(255),
    partition_stop character varying(255),
    partition_id numeric,
    other character varying(1),
    distribution character varying(30)
);


ALTER TABLE public.plan_table OWNER TO postgres;

--
-- TOC entry 1770 (class 1259 OID 16494)
-- Dependencies: 2161 6
-- Name: plantilla_pl; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plantilla_pl (
    pl_codi numeric(4,0) NOT NULL,
    depe_codi numeric(5,0),
    pl_nomb character varying(35),
    pl_archivo character varying(35),
    pl_desc character varying(150),
    pl_fech date,
    usua_codi numeric(10,0),
    pl_uso numeric(1,0) DEFAULT 0
);


ALTER TABLE public.plantilla_pl OWNER TO postgres;

--
-- TOC entry 1771 (class 1259 OID 16498)
-- Dependencies: 6
-- Name: prestamo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE prestamo (
    pres_id numeric(10,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_login_actu character varying(15) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_login_pres character varying(15),
    pres_desc character varying(200),
    pres_fech_pres timestamp without time zone,
    pres_fech_devo timestamp without time zone,
    pres_fech_pedi timestamp without time zone NOT NULL,
    pres_estado numeric(2,0),
    pres_requerimiento numeric(2,0),
    pres_depe_arch numeric(5,0),
    pres_fech_venc timestamp without time zone,
    dev_desc character varying(500),
    pres_fech_canc timestamp without time zone,
    usua_login_canc character varying(15),
    usua_login_rx character varying(15)
);


ALTER TABLE public.prestamo OWNER TO postgres;

--
-- TOC entry 1772 (class 1259 OID 16504)
-- Dependencies: 2162 2163 2164 2165 2166 2167 2168 2169 6
-- Name: radicado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radicado (
    radi_nume_radi numeric(15,0) NOT NULL,
    radi_fech_radi timestamp without time zone NOT NULL,
    tdoc_codi numeric(4,0) NOT NULL,
    trte_codi numeric(2,0),
    mrec_codi numeric(2,0),
    eesp_codi numeric(10,0),
    eotra_codi numeric(10,0),
    radi_tipo_empr character varying(2),
    radi_fech_ofic timestamp without time zone,
    tdid_codi numeric(2,0),
    radi_nume_iden character varying(15),
    radi_nomb character varying(90),
    radi_prim_apel character varying(50),
    radi_segu_apel character varying(50),
    radi_pais character varying(70),
    muni_codi numeric(5,0),
    cpob_codi numeric(4,0),
    carp_codi numeric(3,0),
    esta_codi numeric(2,0),
    dpto_codi numeric(2,0),
    cen_muni_codi numeric(4,0),
    cen_dpto_codi numeric(2,0),
    radi_dire_corr character varying(100),
    radi_tele_cont numeric(15,0),
    radi_nume_hoja numeric(4,0),
    radi_desc_anex character varying(100),
    radi_nume_deri numeric(15,0),
    radi_path character varying(100),
    radi_usua_actu numeric(10,0),
    radi_depe_actu numeric(5,0),
    radi_fech_asig timestamp without time zone,
    radi_arch1 character varying(10),
    radi_arch2 character varying(10),
    radi_arch3 character varying(10),
    radi_arch4 character varying(10),
    ra_asun character varying(350),
    radi_usu_ante character varying(45),
    radi_depe_radi numeric(3,0),
    radi_rem character varying(60),
    radi_usua_radi numeric(10,0),
    codi_nivel numeric(2,0) DEFAULT 1,
    flag_nivel numeric,
    carp_per numeric(1,0) DEFAULT 0,
    radi_leido numeric(1,0) DEFAULT 0,
    radi_cuentai character varying(20),
    radi_tipo_deri numeric(2,0) DEFAULT 0,
    listo character varying(2),
    sgd_tma_codigo numeric(4,0),
    sgd_mtd_codigo numeric(4,0),
    par_serv_secue numeric(8,0),
    sgd_fld_codigo numeric(3,0) DEFAULT 0,
    radi_agend numeric(1,0),
    radi_fech_agend timestamp without time zone,
    radi_fech_doc timestamp without time zone,
    sgd_doc_secuencia numeric(15,0),
    sgd_pnufe_codi numeric(4,0),
    sgd_eanu_codigo numeric(1,0),
    sgd_not_codi numeric(3,0),
    radi_fech_notif timestamp without time zone,
    sgd_tdec_codigo numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_ttr_codigo numeric,
    usua_doc_ante character varying(14),
    radi_fech_antetx timestamp without time zone,
    sgd_trad_codigo numeric(2,0),
    fech_vcmto timestamp without time zone,
    tdoc_vcmto numeric(4,0),
    sgd_termino_real numeric(4,0),
    id_cont numeric(2,0) DEFAULT 1,
    sgd_spub_codigo numeric(2,0) DEFAULT 0,
    id_pais numeric(3,0),
    radi_nrr numeric(2,0) DEFAULT 0,
    medio_m numeric(4,0)
);


ALTER TABLE public.radicado OWNER TO postgres;

--
-- TOC entry 1773 (class 1259 OID 16518)
-- Dependencies: 6
-- Name: retencion_doc_tmp; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE retencion_doc_tmp (
    cod_serie numeric(4,0),
    serie character varying(100),
    tipologia_doc character varying(200),
    cod_subserie character varying(10),
    subserie character varying(100),
    tipologia_sub character varying(200),
    dependencia numeric(5,0),
    nom_depe character varying(200),
    archivo_gestion numeric(3,0),
    archivo_central numeric(3,0),
    disposicion character varying(100),
    soporte character varying(20),
    procedimiento character varying(500),
    tipo_doc numeric(4,0),
    error character varying(200)
);


ALTER TABLE public.retencion_doc_tmp OWNER TO postgres;

--
-- TOC entry 1774 (class 1259 OID 16524)
-- Dependencies: 6
-- Name: sec_ciu_ciudadano; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_ciu_ciudadano
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_ciu_ciudadano OWNER TO postgres;

--
-- TOC entry 2607 (class 0 OID 0)
-- Dependencies: 1774
-- Name: sec_ciu_ciudadano; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_ciu_ciudadano', 4, true);


--
-- TOC entry 1775 (class 1259 OID 16526)
-- Dependencies: 6
-- Name: sec_dir_direcciones; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_dir_direcciones
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_dir_direcciones OWNER TO postgres;

--
-- TOC entry 2608 (class 0 OID 0)
-- Dependencies: 1775
-- Name: sec_dir_direcciones; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_dir_direcciones', 7, true);


--
-- TOC entry 1776 (class 1259 OID 16528)
-- Dependencies: 6
-- Name: secr_tp1_900; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secr_tp1_900
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp1_900 OWNER TO postgres;

--
-- TOC entry 2609 (class 0 OID 0)
-- Dependencies: 1776
-- Name: secr_tp1_900; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secr_tp1_900', 2, true);


--
-- TOC entry 1777 (class 1259 OID 16530)
-- Dependencies: 6
-- Name: secr_tp2_900; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secr_tp2_900
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_900 OWNER TO postgres;

--
-- TOC entry 2610 (class 0 OID 0)
-- Dependencies: 1777
-- Name: secr_tp2_900; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secr_tp2_900', 2, true);


--
-- TOC entry 1778 (class 1259 OID 16532)
-- Dependencies: 6
-- Name: secr_tp3_900; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secr_tp3_900
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp3_900 OWNER TO postgres;

--
-- TOC entry 2611 (class 0 OID 0)
-- Dependencies: 1778
-- Name: secr_tp3_900; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secr_tp3_900', 1, true);

--
-- TOC entry 1829 (class 1259 OID 16553)
-- Dependencies: 6
-- Name: sgd_anu_id; Type: SEQUENCE; Schema: orfeo; Owner: -
--

CREATE SEQUENCE sgd_anu_id
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;

--
-- TOC entry 1779 (class 1259 OID 16534)
-- Dependencies: 6
-- Name: series; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE series (
    depe_codi numeric(5,0) NOT NULL,
    seri_nume numeric(7,0) NOT NULL,
    seri_tipo numeric(2,0) NOT NULL,
    seri_ano numeric(4,0) NOT NULL,
    dpto_codi numeric(2,0) NOT NULL,
    bloq character varying(20)
);


ALTER TABLE public.series OWNER TO postgres;

--
-- TOC entry 1780 (class 1259 OID 16537)
-- Dependencies: 6
-- Name: sgd_acm_acusemsg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_acm_acusemsg (
    sgd_msg_codi numeric(15,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_msg_leido numeric(3,0)
);


ALTER TABLE public.sgd_acm_acusemsg OWNER TO postgres;

--
-- TOC entry 1781 (class 1259 OID 16540)
-- Dependencies: 6
-- Name: sgd_actadd_actualiadicional; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_actadd_actualiadicional (
    sgd_actadd_codi numeric(4,0) NOT NULL,
    sgd_apli_codi numeric(4,0),
    sgd_instorf_codi numeric(4,0),
    sgd_actadd_query character varying(500),
    sgd_actadd_desc character varying(150)
);


ALTER TABLE public.sgd_actadd_actualiadicional OWNER TO postgres;

--
-- TOC entry 1782 (class 1259 OID 16546)
-- Dependencies: 6
-- Name: sgd_agen_agendados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_agen_agendados (
    sgd_agen_fech date,
    sgd_agen_observacion character varying(4000),
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_doc character varying(18) NOT NULL,
    depe_codi character varying(4000),
    sgd_agen_codigo numeric,
    sgd_agen_fechplazo date,
    sgd_agen_activo numeric
);


ALTER TABLE public.sgd_agen_agendados OWNER TO postgres;

--
-- TOC entry 1783 (class 1259 OID 16552)
-- Dependencies: 6
-- Name: sgd_anar_anexarg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_anar_anexarg (
    sgd_anar_codi numeric(4,0) NOT NULL,
    anex_codigo character varying(20),
    sgd_argd_codi numeric(4,0),
    sgd_anar_argcod numeric(4,0)
);


ALTER TABLE public.sgd_anar_anexarg OWNER TO postgres;

--
-- TOC entry 1784 (class 1259 OID 16555)
-- Dependencies: 6
-- Name: sgd_anu_anulados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_anu_anulados (
    sgd_anu_id numeric(4,0) NOT NULL,
    sgd_anu_desc character varying(250),
    radi_nume_radi numeric,
    sgd_eanu_codi numeric(4,0),
    sgd_anu_sol_fech timestamp without time zone,
    sgd_anu_fech timestamp without time zone,
    depe_codi numeric(3,0),
    usua_doc character varying(14),
    usua_codi numeric(4,0),
    depe_codi_anu numeric(3,0),
    usua_doc_anu character varying(14),
    usua_codi_anu numeric(4,0),
    usua_anu_acta numeric(8,0),
    sgd_anu_path_acta character varying(200),
    sgd_trad_codigo numeric(2,0)
);


ALTER TABLE public.sgd_anu_anulados OWNER TO postgres;

--
-- TOC entry 1785 (class 1259 OID 16561)
-- Dependencies: 6
-- Name: sgd_aper_adminperfiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aper_adminperfiles (
    sgd_aper_codigo numeric(2,0) NOT NULL,
    sgd_aper_descripcion character varying(20)
);


ALTER TABLE public.sgd_aper_adminperfiles OWNER TO postgres;

--
-- TOC entry 1786 (class 1259 OID 16564)
-- Dependencies: 6
-- Name: sgd_aplfad_plicfunadi; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplfad_plicfunadi (
    sgd_aplfad_codi numeric(4,0) NOT NULL,
    sgd_apli_codi numeric(4,0),
    sgd_aplfad_menu character varying(150) NOT NULL,
    sgd_aplfad_lk1 character varying(150) NOT NULL,
    sgd_aplfad_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_aplfad_plicfunadi OWNER TO postgres;

--
-- TOC entry 1787 (class 1259 OID 16567)
-- Dependencies: 6
-- Name: sgd_apli_aplintegra; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_apli_aplintegra (
    sgd_apli_codi numeric(4,0) NOT NULL,
    sgd_apli_descrip character varying(150),
    sgd_apli_lk1desc character varying(150),
    sgd_apli_lk1 character varying(150),
    sgd_apli_lk2desc character varying(150),
    sgd_apli_lk2 character varying(150),
    sgd_apli_lk3desc character varying(150),
    sgd_apli_lk3 character varying(150),
    sgd_apli_lk4desc character varying(150),
    sgd_apli_lk4 character varying(150)
);


ALTER TABLE public.sgd_apli_aplintegra OWNER TO postgres;

--
-- TOC entry 1788 (class 1259 OID 16573)
-- Dependencies: 6
-- Name: sgd_aplmen_aplimens; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplmen_aplimens (
    sgd_aplmen_codi numeric(6,0) NOT NULL,
    sgd_apli_codi numeric(4,0),
    sgd_aplmen_ref character varying(20),
    sgd_aplmen_haciaorfeo numeric(4,0),
    sgd_aplmen_desdeorfeo numeric(4,0)
);


ALTER TABLE public.sgd_aplmen_aplimens OWNER TO postgres;

--
-- TOC entry 1789 (class 1259 OID 16576)
-- Dependencies: 6
-- Name: sgd_aplus_plicusua; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplus_plicusua (
    sgd_aplus_codi numeric(4,0) NOT NULL,
    sgd_apli_codi numeric(4,0),
    usua_doc character varying(14),
    sgd_trad_codigo numeric(2,0),
    sgd_aplus_prioridad numeric(1,0)
);


ALTER TABLE public.sgd_aplus_plicusua OWNER TO postgres;

--
-- TOC entry 1790 (class 1259 OID 16579)
-- Dependencies: 6
-- Name: sgd_arg_pliego; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_arg_pliego (
    sgd_arg_codigo numeric(2,0) NOT NULL,
    sgd_arg_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_arg_pliego OWNER TO postgres;

--
-- TOC entry 1791 (class 1259 OID 16582)
-- Dependencies: 6
-- Name: sgd_argd_argdoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_argd_argdoc (
    sgd_argd_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    sgd_argd_tabla character varying(100),
    sgd_argd_tcodi character varying(100),
    sgd_argd_tdes character varying(100),
    sgd_argd_llist character varying(150),
    sgd_argd_campo character varying(100)
);


ALTER TABLE public.sgd_argd_argdoc OWNER TO postgres;

--
-- TOC entry 1792 (class 1259 OID 16588)
-- Dependencies: 6
-- Name: sgd_argup_argudoctop; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_argup_argudoctop (
    sgd_argup_codi numeric(4,0) NOT NULL,
    sgd_argup_desc character varying(50),
    sgd_tpr_codigo numeric(4,0)
);


ALTER TABLE public.sgd_argup_argudoctop OWNER TO postgres;

--
-- TOC entry 1793 (class 1259 OID 16591)
-- Dependencies: 2170 6
-- Name: sgd_camexp_campoexpediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_camexp_campoexpediente (
    sgd_camexp_codigo numeric(4,0) NOT NULL,
    sgd_camexp_campo character varying(30) NOT NULL,
    sgd_parexp_codigo numeric(4,0) NOT NULL,
    sgd_camexp_fk numeric DEFAULT 0,
    sgd_camexp_tablafk character varying(30),
    sgd_camexp_campofk character varying(30),
    sgd_camexp_campovalor character varying(30),
    sgd_campexp_orden numeric(1,0)
);


ALTER TABLE public.sgd_camexp_campoexpediente OWNER TO postgres;

--
-- TOC entry 1794 (class 1259 OID 16598)
-- Dependencies: 6
-- Name: sgd_carp_descripcion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_carp_descripcion (
    sgd_carp_depecodi numeric(5,0) NOT NULL,
    sgd_carp_tiporad numeric(2,0) NOT NULL,
    sgd_carp_descr character varying(40)
);


ALTER TABLE public.sgd_carp_descripcion OWNER TO postgres;

--
-- TOC entry 1795 (class 1259 OID 16601)
-- Dependencies: 6
-- Name: sgd_cau_causal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_cau_causal (
    sgd_cau_codigo numeric(4,0) NOT NULL,
    sgd_cau_descrip character varying(150)
);


ALTER TABLE public.sgd_cau_causal OWNER TO postgres;

--
-- TOC entry 1796 (class 1259 OID 16604)
-- Dependencies: 6
-- Name: sgd_caux_causales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_caux_causales (
    sgd_caux_codigo numeric(10,0) NOT NULL,
    radi_nume_radi numeric(15,0),
    sgd_dcau_codigo numeric(4,0),
    sgd_ddca_codigo numeric(4,0),
    sgd_caux_fecha timestamp without time zone,
    usua_doc character varying(14)
);


ALTER TABLE public.sgd_caux_causales OWNER TO postgres;

--
-- TOC entry 1797 (class 1259 OID 16607)
-- Dependencies: 2171 2172 6
-- Name: sgd_ciu_ciudadano; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ciu_ciudadano (
    tdid_codi numeric(2,0),
    sgd_ciu_codigo numeric(8,0) NOT NULL,
    sgd_ciu_nombre character varying(150),
    sgd_ciu_direccion character varying(150),
    sgd_ciu_apell1 character varying(50),
    sgd_ciu_apell2 character varying(50),
    sgd_ciu_telefono character varying(50),
    sgd_ciu_email character varying(50),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_ciu_cedula character varying(13),
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170
);


ALTER TABLE public.sgd_ciu_ciudadano OWNER TO postgres;

--
-- TOC entry 1798 (class 1259 OID 16615)
-- Dependencies: 6
-- Name: sgd_clta_clstarif; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_clta_clstarif (
    sgd_fenv_codigo numeric(5,0),
    sgd_clta_codser numeric(5,0),
    sgd_tar_codigo numeric(5,0),
    sgd_clta_descrip character varying(100),
    sgd_clta_pesdes numeric(15,0),
    sgd_clta_peshast numeric(15,0)
);


ALTER TABLE public.sgd_clta_clstarif OWNER TO postgres;

--
-- TOC entry 1799 (class 1259 OID 16618)
-- Dependencies: 6
-- Name: sgd_cob_campobliga; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_cob_campobliga (
    sgd_cob_codi numeric(4,0) NOT NULL,
    sgd_cob_desc character varying(150),
    sgd_cob_label character varying(50),
    sgd_tidm_codi numeric(4,0)
);


ALTER TABLE public.sgd_cob_campobliga OWNER TO postgres;

--
-- TOC entry 1800 (class 1259 OID 16621)
-- Dependencies: 6
-- Name: sgd_dcau_causal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dcau_causal (
    sgd_dcau_codigo numeric(4,0) NOT NULL,
    sgd_cau_codigo numeric(4,0),
    sgd_dcau_descrip character varying(150)
);


ALTER TABLE public.sgd_dcau_causal OWNER TO postgres;

--
-- TOC entry 1801 (class 1259 OID 16624)
-- Dependencies: 6
-- Name: sgd_ddca_ddsgrgdo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ddca_ddsgrgdo (
    sgd_ddca_codigo numeric(4,0) NOT NULL,
    sgd_dcau_codigo numeric(4,0),
    par_serv_secue numeric(8,0),
    sgd_ddca_descrip character varying(150)
);


ALTER TABLE public.sgd_ddca_ddsgrgdo OWNER TO postgres;

--
-- TOC entry 1802 (class 1259 OID 16627)
-- Dependencies: 6
-- Name: sgd_def_contactos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_contactos (
    ctt_id numeric(15,0) NOT NULL,
    ctt_nombre character varying(60) NOT NULL,
    ctt_cargo character varying(60) NOT NULL,
    ctt_telefono character varying(25),
    ctt_id_tipo numeric(4,0) NOT NULL,
    ctt_id_empresa numeric(15,0) NOT NULL
);


ALTER TABLE public.sgd_def_contactos OWNER TO postgres;

--
-- TOC entry 1803 (class 1259 OID 16630)
-- Dependencies: 6
-- Name: sgd_def_continentes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_continentes (
    id_cont numeric(2,0) NOT NULL,
    nombre_cont character varying(20) NOT NULL
);


ALTER TABLE public.sgd_def_continentes OWNER TO postgres;

--
-- TOC entry 1804 (class 1259 OID 16633)
-- Dependencies: 2173 6
-- Name: sgd_def_paises; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_paises (
    id_pais numeric(4,0) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1 NOT NULL,
    nombre_pais character varying(30) NOT NULL
);


ALTER TABLE public.sgd_def_paises OWNER TO postgres;

--
-- TOC entry 1805 (class 1259 OID 16637)
-- Dependencies: 6
-- Name: sgd_deve_dev_envio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_deve_dev_envio (
    sgd_deve_codigo numeric(2,0) NOT NULL,
    sgd_deve_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_deve_dev_envio OWNER TO postgres;

--
-- TOC entry 1806 (class 1259 OID 16640)
-- Dependencies: 2174 2175 6
-- Name: sgd_dir_drecciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dir_drecciones (
    sgd_dir_codigo numeric(10,0) NOT NULL,
    sgd_dir_tipo numeric(4,0) NOT NULL,
    sgd_oem_codigo numeric(8,0),
    sgd_ciu_codigo numeric(8,0),
    radi_nume_radi numeric(15,0),
    sgd_esp_codi numeric(5,0),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_dir_direccion character varying(150),
    sgd_dir_telefono character varying(50),
    sgd_dir_mail character varying(50),
    sgd_sec_codigo numeric(13,0),
    sgd_temporal_nombre character varying(150),
    anex_codigo numeric(20,0),
    sgd_anex_codigo character varying(20),
    sgd_dir_nombre character varying(150),
    sgd_doc_fun character varying(14),
    sgd_dir_nomremdes character varying(1000),
    sgd_trd_codigo numeric(1,0),
    sgd_dir_tdoc numeric(1,0),
    sgd_dir_doc character varying(14),
    id_pais numeric(4,0) DEFAULT 170,
    id_cont numeric(2,0) DEFAULT 1
);


ALTER TABLE public.sgd_dir_drecciones OWNER TO postgres;

--
-- TOC entry 1807 (class 1259 OID 16648)
-- Dependencies: 6
-- Name: sgd_dnufe_docnufe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dnufe_docnufe (
    sgd_dnufe_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    sgd_tpr_codigo numeric(4,0),
    sgd_dnufe_label character varying(150),
    trte_codi numeric(2,0),
    sgd_dnufe_main character varying(1),
    sgd_dnufe_path character varying(150),
    sgd_dnufe_gerarq character varying(10),
    anex_tipo_codi numeric(4,0)
);


ALTER TABLE public.sgd_dnufe_docnufe OWNER TO postgres;

--
-- TOC entry 1808 (class 1259 OID 16651)
-- Dependencies: 6
-- Name: sgd_eanu_estanulacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_eanu_estanulacion (
    sgd_eanu_desc character varying(150),
    sgd_eanu_codi numeric NOT NULL
);


ALTER TABLE public.sgd_eanu_estanulacion OWNER TO postgres;

--
-- TOC entry 1809 (class 1259 OID 16657)
-- Dependencies: 6
-- Name: sgd_einv_inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_einv_inventario (
    sgd_einv_codigo numeric NOT NULL,
    sgd_depe_nomb character varying(400),
    sgd_depe_codi numeric,
    sgd_einv_expnum character varying(18),
    sgd_einv_titulo character varying(400),
    sgd_einv_unidad numeric,
    sgd_einv_fech date,
    sgd_einv_fechfin date,
    sgd_einv_radicados character varying(40),
    sgd_einv_folios numeric,
    sgd_einv_nundocu numeric,
    sgd_einv_nundocubodega numeric,
    sgd_einv_caja numeric,
    sgd_einv_cajabodega numeric,
    sgd_einv_srd numeric,
    sgd_einv_nomsrd character varying(400),
    sgd_einv_sbrd numeric,
    sgd_einv_nomsbrd character varying(400),
    sgd_einv_retencion character varying(400),
    sgd_einv_disfinal character varying(400),
    sgd_einv_ubicacion character varying(400),
    sgd_einv_observacion character varying(400)
);


ALTER TABLE public.sgd_einv_inventario OWNER TO postgres;

--
-- TOC entry 1810 (class 1259 OID 16663)
-- Dependencies: 2176 6
-- Name: sgd_eit_items; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_eit_items (
    sgd_eit_codigo numeric NOT NULL,
    sgd_eit_cod_padre character varying(4) DEFAULT '0'::character varying,
    sgd_eit_nombre character varying(40),
    sgd_eit_sigla character varying(4),
    codi_dpto numeric(4,0),
    codi_muni numeric(5,0)
);


ALTER TABLE public.sgd_eit_items OWNER TO postgres;

--
-- TOC entry 1811 (class 1259 OID 16670)
-- Dependencies: 6
-- Name: sgd_ent_entidades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ent_entidades (
    sgd_ent_nit character varying(13) NOT NULL,
    sgd_ent_codsuc character varying(4) NOT NULL,
    sgd_ent_pias numeric(5,0),
    dpto_codi numeric(2,0),
    muni_codi numeric(4,0),
    sgd_ent_descrip character varying(80),
    sgd_ent_direccion character varying(50),
    sgd_ent_telefono character varying(50)
);


ALTER TABLE public.sgd_ent_entidades OWNER TO postgres;

--
-- TOC entry 1812 (class 1259 OID 16673)
-- Dependencies: 6
-- Name: sgd_enve_envioespecial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_enve_envioespecial (
    sgd_fenv_codigo numeric(4,0),
    sgd_enve_valorl character varying(30),
    sgd_enve_valorn character varying(30),
    sgd_enve_desc character varying(30)
);


ALTER TABLE public.sgd_enve_envioespecial OWNER TO postgres;

--
-- TOC entry 1813 (class 1259 OID 16676)
-- Dependencies: 6
-- Name: sgd_estc_estconsolid; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_estc_estconsolid (
    sgd_estc_codigo numeric,
    sgd_tpr_codigo numeric,
    dep_nombre character varying(30),
    depe_codi numeric,
    sgd_estc_ctotal numeric,
    sgd_estc_centramite numeric,
    sgd_estc_csinriesgo numeric,
    sgd_estc_criesgomedio numeric,
    sgd_estc_criesgoalto numeric,
    sgd_estc_ctramitados numeric,
    sgd_estc_centermino numeric,
    sgd_estc_cfueratermino numeric,
    sgd_estc_fechgen date,
    sgd_estc_fechini date,
    sgd_estc_fechfin date,
    sgd_estc_fechiniresp date,
    sgd_estc_fechfinresp date,
    sgd_estc_dsinriesgo numeric,
    sgd_estc_driesgomegio numeric,
    sgd_estc_driesgoalto numeric,
    sgd_estc_dtermino numeric,
    sgd_estc_grupgenerado numeric
);


ALTER TABLE public.sgd_estc_estconsolid OWNER TO postgres;

--
-- TOC entry 1814 (class 1259 OID 16682)
-- Dependencies: 6
-- Name: sgd_estinst_estadoinstancia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_estinst_estadoinstancia (
    sgd_estinst_codi numeric(4,0) NOT NULL,
    sgd_apli_codi numeric(4,0),
    sgd_instorf_codi numeric(4,0),
    sgd_estinst_valor numeric(4,0),
    sgd_estinst_habilita numeric(1,0),
    sgd_estinst_mensaje character varying(100)
);


ALTER TABLE public.sgd_estinst_estadoinstancia OWNER TO postgres;

--
-- TOC entry 1815 (class 1259 OID 16685)
-- Dependencies: 2177 2178 6
-- Name: sgd_exp_expediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_exp_expediente (
    sgd_exp_numero character varying(18) NOT NULL,
    radi_nume_radi numeric(18,0) NOT NULL,
    sgd_exp_fech timestamp without time zone,
    sgd_exp_fech_mod timestamp without time zone,
    depe_codi numeric(4,0),
    usua_codi numeric(4,0),
    usua_doc character varying(15),
    sgd_exp_estado numeric(1,0) DEFAULT 0,
    sgd_exp_titulo character varying(50),
    sgd_exp_asunto character varying(150),
    sgd_exp_carpeta character varying(30),
    sgd_exp_ufisica character varying(20),
    sgd_exp_isla character varying(10),
    sgd_exp_estante character varying(10),
    sgd_exp_caja character varying(10),
    sgd_exp_fech_arch date,
    sgd_srd_codigo numeric(3,0),
    sgd_sbrd_codigo numeric(3,0),
    sgd_fexp_codigo numeric(3,0) DEFAULT 0,
    sgd_exp_subexpediente numeric,
    sgd_exp_archivo numeric(1,0),
    sgd_exp_unicon numeric(1,0),
    sgd_exp_fechfin timestamp without time zone,
    sgd_exp_folios character varying(4),
    sgd_exp_rete numeric(2,0),
    sgd_exp_entrepa numeric(2,0),
    radi_usua_arch character varying(40),
    sgd_exp_edificio character varying(400),
    sgd_exp_caja_bodega character varying(40),
    sgd_exp_carro character varying(40),
    sgd_exp_carpeta_bodega character varying(40),
    sgd_exp_privado numeric(1,0),
    sgd_exp_cd character varying(10),
    sgd_exp_nref character varying(7),
    sgd_exp_fechafin timestamp without time zone
);


ALTER TABLE public.sgd_exp_expediente OWNER TO postgres;

--
-- TOC entry 1816 (class 1259 OID 16693)
-- Dependencies: 6
-- Name: sgd_fars_faristas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fars_faristas (
    sgd_fars_codigo numeric(5,0) NOT NULL,
    sgd_pexp_codigo numeric(4,0),
    sgd_fexp_codigoini numeric(6,0),
    sgd_fexp_codigofin numeric(6,0),
    sgd_fars_diasminimo numeric(3,0),
    sgd_fars_diasmaximo numeric(3,0),
    sgd_fars_desc character varying(100),
    sgd_trad_codigo numeric(2,0),
    sgd_srd_codigo numeric(3,0),
    sgd_sbrd_codigo numeric(3,0),
    sgd_fars_tipificacion numeric(1,0),
    sgd_tpr_codigo numeric,
    sgd_fars_automatico numeric,
    sgd_fars_rolgeneral numeric
);


ALTER TABLE public.sgd_fars_faristas OWNER TO postgres;

--
-- TOC entry 1817 (class 1259 OID 16699)
-- Dependencies: 2179 2180 6
-- Name: sgd_fenv_frmenvio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fenv_frmenvio (
    sgd_fenv_codigo numeric(5,0) NOT NULL,
    sgd_fenv_descrip character varying(40),
    sgd_fenv_estado numeric(1,0) DEFAULT 1 NOT NULL,
    sgd_fenv_planilla numeric(1,0) DEFAULT 0 NOT NULL
);


ALTER TABLE public.sgd_fenv_frmenvio OWNER TO postgres;

--
-- TOC entry 1818 (class 1259 OID 16704)
-- Dependencies: 6
-- Name: sgd_fexp_flujoexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fexp_flujoexpedientes (
    sgd_fexp_codigo numeric(6,0) NOT NULL,
    sgd_pexp_codigo numeric(6,0),
    sgd_fexp_orden numeric(4,0),
    sgd_fexp_terminos numeric(4,0),
    sgd_fexp_imagen character varying(50),
    sgd_fexp_descrip character varying(255)
);


ALTER TABLE public.sgd_fexp_flujoexpedientes OWNER TO postgres;

--
-- TOC entry 1819 (class 1259 OID 16707)
-- Dependencies: 6
-- Name: sgd_firrad_firmarads; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_firrad_firmarads (
    sgd_firrad_id numeric(15,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_firrad_firma character varying(1),
    sgd_firrad_fecha timestamp without time zone,
    sgd_firrad_docsolic character varying(14) NOT NULL,
    sgd_firrad_fechsolic timestamp without time zone NOT NULL,
    sgd_firrad_pk character varying(1000)
);


ALTER TABLE public.sgd_firrad_firmarads OWNER TO postgres;

--
-- TOC entry 1820 (class 1259 OID 16713)
-- Dependencies: 6
-- Name: sgd_fld_flujodoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fld_flujodoc (
    sgd_fld_codigo numeric(3,0),
    sgd_fld_desc character varying(100),
    sgd_tpr_codigo numeric(3,0),
    sgd_fld_imagen character varying(50),
    sgd_fld_grupoweb numeric
);


ALTER TABLE public.sgd_fld_flujodoc OWNER TO postgres;

--
-- TOC entry 1821 (class 1259 OID 16719)
-- Dependencies: 6
-- Name: sgd_fun_funciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fun_funciones (
    sgd_fun_codigo numeric(4,0) NOT NULL,
    sgd_fun_descrip character varying(530),
    sgd_fun_fech_ini timestamp without time zone,
    sgd_fun_fech_fin timestamp without time zone
);


ALTER TABLE public.sgd_fun_funciones OWNER TO postgres;

--
-- TOC entry 1822 (class 1259 OID 16725)
-- Dependencies: 6
-- Name: sgd_hfld_histflujodoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_hfld_histflujodoc (
    sgd_hfld_codigo numeric(6,0),
    sgd_fexp_codigo numeric(3,0) NOT NULL,
    sgd_exp_fechflujoant timestamp without time zone,
    sgd_hfld_fech timestamp without time zone,
    sgd_exp_numero character varying(18),
    radi_nume_radi numeric(15,0),
    usua_doc character varying(10),
    usua_codi numeric(10,0),
    depe_codi numeric(4,0),
    sgd_ttr_codigo numeric(2,0),
    sgd_fexp_observa character varying(500),
    sgd_hfld_observa character varying(500),
    sgd_fars_codigo numeric,
    sgd_hfld_automatico numeric
);


ALTER TABLE public.sgd_hfld_histflujodoc OWNER TO postgres;

--
-- TOC entry 1823 (class 1259 OID 16731)
-- Dependencies: 6
-- Name: sgd_hmtd_hismatdoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_hmtd_hismatdoc (
    sgd_hmtd_codigo numeric(6,0) NOT NULL,
    sgd_hmtd_fecha timestamp without time zone NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    sgd_hmtd_obse character varying(600) NOT NULL,
    usua_doc numeric(13,0),
    depe_codi numeric(5,0),
    sgd_mtd_codigo numeric(4,0)
);


ALTER TABLE public.sgd_hmtd_hismatdoc OWNER TO postgres;

--
-- TOC entry 1824 (class 1259 OID 16737)
-- Dependencies: 6
-- Name: sgd_instorf_instanciasorfeo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_instorf_instanciasorfeo (
    sgd_instorf_codi numeric(4,0) NOT NULL,
    sgd_instorf_desc character varying(100)
);


ALTER TABLE public.sgd_instorf_instanciasorfeo OWNER TO postgres;

--
-- TOC entry 1825 (class 1259 OID 16740)
-- Dependencies: 6
-- Name: sgd_lip_linkip; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_lip_linkip (
    sgd_lip_id numeric(4,0) NOT NULL,
    sgd_lip_ipini character varying(20) NOT NULL,
    sgd_lip_ipfin character varying(20),
    sgd_lip_dirintranet character varying(150) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    sgd_lip_arch character varying(70),
    sgd_lip_diascache numeric(5,0),
    sgd_lip_rutaftp character varying(150),
    sgd_lip_servftp character varying(50),
    sgd_lip_usbd character varying(20),
    sgd_lip_nombd character varying(20),
    sgd_lip_pwdbd character varying(20),
    sgd_lip_usftp character varying(20),
    sgd_lip_pwdftp character varying(30)
);


ALTER TABLE public.sgd_lip_linkip OWNER TO postgres;

--
-- TOC entry 1826 (class 1259 OID 16746)
-- Dependencies: 6
-- Name: sgd_masiva_excel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_masiva_excel (
    sgd_masiva_dependencia numeric(3,0),
    sgd_masiva_usuario numeric(10,0),
    sgd_masiva_tiporadicacion numeric(1,0),
    sgd_masiva_codigo numeric(15,1) NOT NULL,
    sgd_masiva_radicada numeric(1,0),
    sgd_masiva_intervalo numeric(3,0),
    sgd_masiva_rangoini character varying(15),
    sgd_masiva_rangofin character varying(15)
);


ALTER TABLE public.sgd_masiva_excel OWNER TO postgres;

--
-- TOC entry 1827 (class 1259 OID 16749)
-- Dependencies: 6
-- Name: sgd_mat_matriz; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mat_matriz (
    sgd_mat_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0),
    sgd_fun_codigo numeric(4,0),
    sgd_prc_codigo numeric(4,0),
    sgd_prd_codigo numeric(4,0),
    sgd_mat_fech_ini timestamp without time zone,
    sgd_mat_fech_fin timestamp without time zone,
    sgd_mat_peso_prd numeric(5,2)
);


ALTER TABLE public.sgd_mat_matriz OWNER TO postgres;

--
-- TOC entry 1828 (class 1259 OID 16752)
-- Dependencies: 6
-- Name: sgd_mpes_mddpeso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mpes_mddpeso (
    sgd_mpes_codigo numeric(5,0) NOT NULL,
    sgd_mpes_descrip character varying(10)
);


ALTER TABLE public.sgd_mpes_mddpeso OWNER TO postgres;

--
-- TOC entry 1829 (class 1259 OID 16755)
-- Dependencies: 6
-- Name: sgd_mrd_matrird; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mrd_matrird (
    sgd_mrd_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    sgd_srd_codigo numeric(4,0) NOT NULL,
    sgd_sbrd_codigo numeric(4,0) NOT NULL,
    sgd_tpr_codigo numeric(4,0) NOT NULL,
    soporte character varying(10),
    sgd_mrd_fechini timestamp without time zone,
    sgd_mrd_fechfin timestamp without time zone,
    sgd_mrd_esta character varying(10)
);


ALTER TABLE public.sgd_mrd_matrird OWNER TO postgres;

--
-- TOC entry 1830 (class 1259 OID 16758)
-- Dependencies: 6
-- Name: sgd_msdep_msgdep; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_msdep_msgdep (
    sgd_msdep_codi numeric(15,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    sgd_msg_codi numeric(15,0) NOT NULL
);


ALTER TABLE public.sgd_msdep_msgdep OWNER TO postgres;

--
-- TOC entry 1831 (class 1259 OID 16761)
-- Dependencies: 6
-- Name: sgd_msg_mensaje; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_msg_mensaje (
    sgd_msg_codi numeric(15,0) NOT NULL,
    sgd_tme_codi numeric(3,0) NOT NULL,
    sgd_msg_desc character varying(150),
    sgd_msg_fechdesp timestamp without time zone NOT NULL,
    sgd_msg_url character varying(150) NOT NULL,
    sgd_msg_veces numeric(3,0) NOT NULL,
    sgd_msg_ancho numeric(6,0) NOT NULL,
    sgd_msg_largo numeric(6,0) NOT NULL
);


ALTER TABLE public.sgd_msg_mensaje OWNER TO postgres;

--
-- TOC entry 1832 (class 1259 OID 16764)
-- Dependencies: 6
-- Name: sgd_mtd_matriz_doc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mtd_matriz_doc (
    sgd_mtd_codigo numeric(4,0) NOT NULL,
    sgd_mat_codigo numeric(4,0),
    sgd_tpr_codigo numeric(4,0)
);


ALTER TABLE public.sgd_mtd_matriz_doc OWNER TO postgres;

--
-- TOC entry 1833 (class 1259 OID 16767)
-- Dependencies: 6
-- Name: sgd_nfn_notifijacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_nfn_notifijacion (
    radi_nume_radi numeric NOT NULL,
    sgd_tdf_codigo numeric NOT NULL,
    sgd_nfn_fechnotusu timestamp without time zone,
    sgd_nfn_fechnotemp timestamp without time zone,
    sgd_nfn_fechfiusu timestamp without time zone,
    sgd_nfn_fechfiemp timestamp without time zone,
    sgd_nfn_fechdesfiusu timestamp without time zone,
    sgd_nfn_fechdesfiemp timestamp without time zone,
    sgd_nfn_sspdapela character varying(2)
);


ALTER TABLE public.sgd_nfn_notifijacion OWNER TO postgres;

--
-- TOC entry 1834 (class 1259 OID 16773)
-- Dependencies: 6
-- Name: sgd_noh_nohabiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_noh_nohabiles (
    noh_fecha timestamp without time zone NOT NULL
);


ALTER TABLE public.sgd_noh_nohabiles OWNER TO postgres;

--
-- TOC entry 1835 (class 1259 OID 16776)
-- Dependencies: 6
-- Name: sgd_not_notificacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_not_notificacion (
    sgd_not_codi numeric(3,0) NOT NULL,
    sgd_not_descrip character varying(100) NOT NULL
);


ALTER TABLE public.sgd_not_notificacion OWNER TO postgres;

--
-- TOC entry 1836 (class 1259 OID 16779)
-- Dependencies: 6
-- Name: sgd_ntrd_notifrad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ntrd_notifrad (
    radi_nume_radi numeric(15,0) NOT NULL,
    sgd_not_codi numeric(3,0) NOT NULL,
    sgd_ntrd_notificador character varying(150),
    sgd_ntrd_notificado character varying(150),
    sgd_ntrd_fecha_not timestamp without time zone,
    sgd_ntrd_num_edicto numeric(6,0),
    sgd_ntrd_fecha_fija timestamp without time zone,
    sgd_ntrd_fecha_desfija timestamp without time zone,
    sgd_ntrd_observaciones character varying(150)
);


ALTER TABLE public.sgd_ntrd_notifrad OWNER TO postgres;

--
-- TOC entry 1837 (class 1259 OID 16782)
-- Dependencies: 2181 2182 6
-- Name: sgd_oem_oempresas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_oem_oempresas (
    sgd_oem_codigo numeric(8,0) NOT NULL,
    tdid_codi numeric(2,0),
    sgd_oem_oempresa character varying(150),
    sgd_oem_rep_legal character varying(150),
    sgd_oem_nit character varying(14),
    sgd_oem_sigla character varying(50),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_oem_direccion character varying(150),
    sgd_oem_telefono character varying(50),
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170
);


ALTER TABLE public.sgd_oem_oempresas OWNER TO postgres;

--
-- TOC entry 1838 (class 1259 OID 16790)
-- Dependencies: 6
-- Name: sgd_panu_peranulados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_panu_peranulados (
    sgd_panu_codi numeric(4,0) NOT NULL,
    sgd_panu_desc character varying(200)
);


ALTER TABLE public.sgd_panu_peranulados OWNER TO postgres;

--
-- TOC entry 1839 (class 1259 OID 16793)
-- Dependencies: 6
-- Name: sgd_parametro; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_parametro (
    param_nomb character varying(25) NOT NULL,
    param_codi numeric(5,0) NOT NULL,
    param_valor character varying(25) NOT NULL
);


ALTER TABLE public.sgd_parametro OWNER TO postgres;

--
-- TOC entry 1840 (class 1259 OID 16796)
-- Dependencies: 6
-- Name: sgd_parexp_paramexpediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_parexp_paramexpediente (
    sgd_parexp_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(4,0) NOT NULL,
    sgd_parexp_tabla character varying(30) NOT NULL,
    sgd_parexp_etiqueta character varying(15) NOT NULL,
    sgd_parexp_orden numeric(1,0)
);


ALTER TABLE public.sgd_parexp_paramexpediente OWNER TO postgres;

--
-- TOC entry 1841 (class 1259 OID 16799)
-- Dependencies: 2183 2184 6
-- Name: sgd_pexp_procexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pexp_procexpedientes (
    sgd_pexp_codigo numeric NOT NULL,
    sgd_pexp_descrip character varying(100),
    sgd_pexp_terminos numeric DEFAULT 0,
    sgd_srd_codigo numeric(3,0),
    sgd_sbrd_codigo numeric(3,0),
    sgd_pexp_automatico numeric(1,0) DEFAULT 1,
    sgd_pexp_tieneflujo numeric
);


ALTER TABLE public.sgd_pexp_procexpedientes OWNER TO postgres;

--
-- TOC entry 1842 (class 1259 OID 16807)
-- Dependencies: 6
-- Name: sgd_pnufe_procnumfe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pnufe_procnumfe (
    sgd_pnufe_codi numeric(4,0) NOT NULL,
    sgd_tpr_codigo numeric(4,0),
    sgd_pnufe_descrip character varying(150),
    sgd_pnufe_serie character varying(50)
);


ALTER TABLE public.sgd_pnufe_procnumfe OWNER TO postgres;

--
-- TOC entry 1843 (class 1259 OID 16810)
-- Dependencies: 6
-- Name: sgd_pnun_procenum; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pnun_procenum (
    sgd_pnun_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    depe_codi numeric(5,0),
    sgd_pnun_prepone character varying(50)
);


ALTER TABLE public.sgd_pnun_procenum OWNER TO postgres;

--
-- TOC entry 1844 (class 1259 OID 16813)
-- Dependencies: 6
-- Name: sgd_prc_proceso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_prc_proceso (
    sgd_prc_codigo numeric(4,0) NOT NULL,
    sgd_prc_descrip character varying(150),
    sgd_prc_fech_ini timestamp without time zone,
    sgd_prc_fech_fin timestamp without time zone
);


ALTER TABLE public.sgd_prc_proceso OWNER TO postgres;

--
-- TOC entry 1845 (class 1259 OID 16816)
-- Dependencies: 6
-- Name: sgd_prd_prcdmentos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_prd_prcdmentos (
    sgd_prd_codigo numeric(4,0) NOT NULL,
    sgd_prd_descrip character varying(200),
    sgd_prd_fech_ini timestamp without time zone,
    sgd_prd_fech_fin timestamp without time zone
);


ALTER TABLE public.sgd_prd_prcdmentos OWNER TO postgres;

--
-- TOC entry 1846 (class 1259 OID 16819)
-- Dependencies: 6
-- Name: sgd_rda_retdoca; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rda_retdoca (
    anex_radi_nume numeric(15,0) NOT NULL,
    anex_codigo character varying(20) NOT NULL,
    radi_nume_salida numeric(15,0),
    anex_borrado character varying(1),
    sgd_mrd_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_rda_fech timestamp without time zone,
    sgd_deve_codigo numeric(2,0),
    anex_solo_lect character varying(1),
    anex_radi_fech timestamp without time zone,
    anex_estado numeric(1,0),
    anex_nomb_archivo character varying(50),
    anex_tipo numeric(4,0),
    sgd_dir_tipo numeric(4,0)
);


ALTER TABLE public.sgd_rda_retdoca OWNER TO postgres;

--
-- TOC entry 1847 (class 1259 OID 16822)
-- Dependencies: 6
-- Name: sgd_rdf_retdocf; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rdf_retdocf (
    sgd_mrd_codigo numeric(4,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_rdf_fech timestamp without time zone NOT NULL
);


ALTER TABLE public.sgd_rdf_retdocf OWNER TO postgres;

--
-- TOC entry 1848 (class 1259 OID 16825)
-- Dependencies: 2185 2186 2187 2188 2189 2190 2191 2192 2193 6
-- Name: sgd_renv_regenvio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_renv_regenvio (
    sgd_renv_codigo numeric(6,0) NOT NULL,
    sgd_fenv_codigo numeric(5,0),
    sgd_renv_fech timestamp without time zone,
    radi_nume_sal numeric(14,0),
    sgd_renv_destino character varying(150),
    sgd_renv_telefono character varying(50),
    sgd_renv_mail character varying(150),
    sgd_renv_peso character varying(10),
    sgd_renv_valor character varying(10),
    sgd_renv_certificado numeric(1,0),
    sgd_renv_estado numeric(1,0),
    usua_doc numeric(15,0),
    sgd_renv_nombre character varying(100),
    sgd_rem_destino numeric(1,0) DEFAULT 0,
    sgd_dir_codigo numeric(10,0),
    sgd_renv_planilla character varying(8),
    sgd_renv_fech_sal timestamp without time zone,
    depe_codi numeric(5,0),
    sgd_dir_tipo numeric(4,0) DEFAULT 0,
    radi_nume_grupo numeric(14,0),
    sgd_renv_dir character varying(100),
    sgd_renv_depto character varying(30),
    sgd_renv_mpio character varying(30),
    sgd_renv_tel character varying(20),
    sgd_renv_cantidad numeric(4,0) DEFAULT 0,
    sgd_renv_tipo numeric(1,0) DEFAULT 0,
    sgd_renv_observa character varying(200),
    sgd_renv_grupo numeric(14,0),
    sgd_deve_codigo numeric(2,0),
    sgd_deve_fech timestamp without time zone,
    sgd_renv_valortotal character varying(14) DEFAULT '0'::character varying,
    sgd_renv_valistamiento character varying(10) DEFAULT '0'::character varying,
    sgd_renv_vdescuento character varying(10) DEFAULT '0'::character varying,
    sgd_renv_vadicional character varying(14) DEFAULT '0'::character varying,
    sgd_depe_genera numeric(5,0),
    sgd_renv_pais character varying(30) DEFAULT 'colombia'::character varying
);


ALTER TABLE public.sgd_renv_regenvio OWNER TO postgres;

--
-- TOC entry 1849 (class 1259 OID 16840)
-- Dependencies: 6
-- Name: sgd_rfax_reservafax; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rfax_reservafax (
    sgd_rfax_codigo numeric(10,0),
    sgd_rfax_fax character varying(30),
    usua_login character varying(30),
    sgd_rfax_fech timestamp without time zone,
    sgd_rfax_fechradi timestamp without time zone,
    radi_nume_radi numeric(15,0),
    sgd_rfax_observa character varying(500),
    sgd_rfax_dhojas numeric
);


ALTER TABLE public.sgd_rfax_reservafax OWNER TO postgres;

--
-- TOC entry 1850 (class 1259 OID 16846)
-- Dependencies: 6
-- Name: sgd_rmr_radmasivre; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rmr_radmasivre (
    sgd_rmr_grupo numeric(15,0) NOT NULL,
    sgd_rmr_radi numeric(15,0) NOT NULL
);


ALTER TABLE public.sgd_rmr_radmasivre OWNER TO postgres;

--
-- TOC entry 1851 (class 1259 OID 16849)
-- Dependencies: 6
-- Name: sgd_san_sancionados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_san_sancionados (
    sgd_san_ref character varying(20) NOT NULL,
    sgd_san_decision character varying(60),
    sgd_san_cargo character varying(50),
    sgd_san_expediente character varying(20),
    sgd_san_tipo_sancion character varying(50),
    sgd_san_plazo character varying(100),
    sgd_san_valor numeric(14,2),
    sgd_san_radicacion character varying(15),
    sgd_san_fecha_radicado timestamp without time zone,
    sgd_san_valorletras character varying(1000),
    sgd_san_nombreempresa character varying(160),
    sgd_san_motivos character varying(160),
    sgd_san_sectores character varying(160),
    sgd_san_padre character varying(15),
    sgd_san_fecha_padre timestamp without time zone,
    sgd_san_notificado character varying(100)
);


ALTER TABLE public.sgd_san_sancionados OWNER TO postgres;

--
-- TOC entry 1852 (class 1259 OID 16855)
-- Dependencies: 6
-- Name: sgd_sbrd_subserierd; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sbrd_subserierd (
    sgd_srd_codigo numeric(4,0) NOT NULL,
    sgd_sbrd_codigo numeric(4,0) NOT NULL,
    sgd_sbrd_descrip character varying(200) NOT NULL,
    sgd_sbrd_fechini timestamp without time zone NOT NULL,
    sgd_sbrd_fechfin timestamp without time zone NOT NULL,
    sgd_sbrd_tiemag numeric(4,0),
    sgd_sbrd_tiemac numeric(4,0),
    sgd_sbrd_dispfin character varying(50),
    sgd_sbrd_soporte character varying(50),
    sgd_sbrd_procedi character varying(200)
);


ALTER TABLE public.sgd_sbrd_subserierd OWNER TO postgres;

--
-- TOC entry 1853 (class 1259 OID 16861)
-- Dependencies: 6
-- Name: sgd_sed_sede; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sed_sede (
    sgd_sed_codi numeric(4,0) NOT NULL,
    sgd_sed_desc character varying(50),
    sgd_tpr_codigo numeric(4,0)
);


ALTER TABLE public.sgd_sed_sede OWNER TO postgres;

--
-- TOC entry 1854 (class 1259 OID 16864)
-- Dependencies: 6
-- Name: sgd_senuf_secnumfe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_senuf_secnumfe (
    sgd_senuf_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    depe_codi numeric(5,0),
    sgd_senuf_sec character varying(50)
);


ALTER TABLE public.sgd_senuf_secnumfe OWNER TO postgres;

--
-- TOC entry 1855 (class 1259 OID 16867)
-- Dependencies: 6
-- Name: sgd_sexp_secexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sexp_secexpedientes (
    sgd_exp_numero character varying(18) NOT NULL,
    sgd_srd_codigo numeric,
    sgd_sbrd_codigo numeric,
    sgd_sexp_secuencia numeric,
    depe_codi numeric,
    usua_doc character varying(15),
    sgd_sexp_fech timestamp without time zone,
    sgd_fexp_codigo numeric,
    sgd_sexp_ano numeric,
    usua_doc_responsable character varying(18),
    sgd_sexp_parexp1 character varying(250),
    sgd_sexp_parexp2 character varying(160),
    sgd_sexp_parexp3 character varying(160),
    sgd_sexp_parexp4 character varying(160),
    sgd_sexp_parexp5 character varying(160),
    sgd_pexp_codigo numeric(3,0) NOT NULL,
    sgd_exp_fech_arch timestamp without time zone,
    sgd_fld_codigo numeric(3,0),
    sgd_exp_fechflujoant timestamp without time zone,
    sgd_mrd_codigo numeric(4,0),
    sgd_exp_subexpediente numeric(18,0),
    sgd_exp_privado numeric(1,0),
    sgd_sexp_fechafin timestamp without time zone
);


ALTER TABLE public.sgd_sexp_secexpedientes OWNER TO postgres;

--
-- TOC entry 1856 (class 1259 OID 16873)
-- Dependencies: 6
-- Name: sgd_srd_seriesrd; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_srd_seriesrd (
    sgd_srd_codigo numeric(4,0) NOT NULL,
    sgd_srd_descrip character varying(50) NOT NULL,
    sgd_srd_fechini timestamp without time zone NOT NULL,
    sgd_srd_fechfin timestamp without time zone NOT NULL
);


ALTER TABLE public.sgd_srd_seriesrd OWNER TO postgres;

--
-- TOC entry 1857 (class 1259 OID 16876)
-- Dependencies: 6
-- Name: sgd_tar_tarifas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tar_tarifas (
    sgd_fenv_codigo numeric(5,0),
    sgd_tar_codser numeric(5,0),
    sgd_tar_codigo numeric(5,0),
    sgd_tar_valenv1 numeric(15,0),
    sgd_tar_valenv2 numeric(15,0),
    sgd_tar_valenv1g1 numeric(15,0),
    sgd_clta_codser numeric(5,0),
    sgd_tar_valenv2g2 numeric(15,0),
    sgd_clta_descrip character varying(100)
);


ALTER TABLE public.sgd_tar_tarifas OWNER TO postgres;

--
-- TOC entry 1858 (class 1259 OID 16879)
-- Dependencies: 6
-- Name: sgd_tdec_tipodecision; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tdec_tipodecision (
    sgd_apli_codi numeric(4,0) NOT NULL,
    sgd_tdec_codigo numeric(4,0) NOT NULL,
    sgd_tdec_descrip character varying(150),
    sgd_tdec_sancionar numeric(1,0),
    sgd_tdec_firmeza numeric(1,0),
    sgd_tdec_versancion numeric(1,0),
    sgd_tdec_showmenu numeric(1,0),
    sgd_tdec_updnotif numeric(1,0),
    sgd_tdec_veragota numeric(1,0)
);


ALTER TABLE public.sgd_tdec_tipodecision OWNER TO postgres;

--
-- TOC entry 1859 (class 1259 OID 16882)
-- Dependencies: 6
-- Name: sgd_tdf_tipodefallos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tdf_tipodefallos (
    sgd_tdf_codigo numeric NOT NULL,
    sgd_tdf_nombre_fallo character varying(50) NOT NULL
);


ALTER TABLE public.sgd_tdf_tipodefallos OWNER TO postgres;

--
-- TOC entry 1860 (class 1259 OID 16888)
-- Dependencies: 6
-- Name: sgd_tid_tipdecision; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tid_tipdecision (
    sgd_tid_codi numeric(4,0) NOT NULL,
    sgd_tid_desc character varying(150),
    sgd_tpr_codigo numeric(4,0),
    sgd_pexp_codigo numeric(2,0),
    sgd_tpr_codigop numeric(2,0)
);


ALTER TABLE public.sgd_tid_tipdecision OWNER TO postgres;

--
-- TOC entry 1861 (class 1259 OID 16891)
-- Dependencies: 6
-- Name: sgd_tidm_tidocmasiva; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tidm_tidocmasiva (
    sgd_tidm_codi numeric(4,0) NOT NULL,
    sgd_tidm_desc character varying(150)
);


ALTER TABLE public.sgd_tidm_tidocmasiva OWNER TO postgres;

--
-- TOC entry 1862 (class 1259 OID 16894)
-- Dependencies: 2194 2195 2196 6
-- Name: sgd_tip3_tipotercero; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tip3_tipotercero (
    sgd_tip3_codigo numeric(2,0) NOT NULL,
    sgd_dir_tipo numeric(4,0),
    sgd_tip3_nombre character varying(15),
    sgd_tip3_desc character varying(30),
    sgd_tip3_imgpestana character varying(20),
    sgd_tpr_tp1 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp2 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp3 numeric(1,0) DEFAULT 0
);


ALTER TABLE public.sgd_tip3_tipotercero OWNER TO postgres;

--
-- TOC entry 1863 (class 1259 OID 16904)
-- Dependencies: 6
-- Name: sgd_tma_temas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tma_temas (
    sgd_tma_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0),
    sgd_prc_codigo numeric(4,0),
    sgd_tma_descrip character varying(150)
);


ALTER TABLE public.sgd_tma_temas OWNER TO postgres;

--
-- TOC entry 1864 (class 1259 OID 16907)
-- Dependencies: 6
-- Name: sgd_tme_tipmen; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tme_tipmen (
    sgd_tme_codi numeric(3,0) NOT NULL,
    sgd_tme_desc character varying(150)
);


ALTER TABLE public.sgd_tme_tipmen OWNER TO postgres;

--
-- TOC entry 1865 (class 1259 OID 16910)
-- Dependencies: 2197 2198 2199 2200 6
-- Name: sgd_tpr_tpdcumento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tpr_tpdcumento (
    sgd_tpr_codigo numeric(4,0) NOT NULL,
    sgd_tpr_descrip character varying(150),
    sgd_tpr_termino numeric(4,0),
    sgd_tpr_tpuso numeric(1,0),
    sgd_tpr_numera character(1),
    sgd_tpr_radica character(1),
    sgd_tpr_tp3 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp1 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp2 numeric(1,0) DEFAULT 0,
    sgd_tpr_estado numeric(1,0),
    sgd_termino_real numeric(4,0),
    sgd_tpr_tp6 numeric(1,0) DEFAULT 0
);


ALTER TABLE public.sgd_tpr_tpdcumento OWNER TO postgres;

--
-- TOC entry 1866 (class 1259 OID 16919)
-- Dependencies: 6
-- Name: sgd_trad_tiporad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_trad_tiporad (
    sgd_trad_codigo numeric(2,0) NOT NULL,
    sgd_trad_descr character varying(30),
    sgd_trad_icono character varying(30),
    sgd_trad_genradsal numeric(1,0)
);


ALTER TABLE public.sgd_trad_tiporad OWNER TO postgres;

--
-- TOC entry 1867 (class 1259 OID 16922)
-- Dependencies: 6
-- Name: sgd_ttr_transaccion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ttr_transaccion (
    sgd_ttr_codigo numeric(3,0) NOT NULL,
    sgd_ttr_descrip character varying(100) NOT NULL
);


ALTER TABLE public.sgd_ttr_transaccion OWNER TO postgres;

--
-- TOC entry 1868 (class 1259 OID 16925)
-- Dependencies: 6
-- Name: sgd_ush_usuhistorico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ush_usuhistorico (
    sgd_ush_admcod numeric(10,0) NOT NULL,
    sgd_ush_admdep numeric(5,0) NOT NULL,
    sgd_ush_admdoc character varying(14) NOT NULL,
    sgd_ush_usucod numeric(10,0) NOT NULL,
    sgd_ush_usudep numeric(5,0) NOT NULL,
    sgd_ush_usudoc character varying(14) NOT NULL,
    sgd_ush_modcod numeric(5,0) NOT NULL,
    sgd_ush_fechevento timestamp without time zone NOT NULL,
    sgd_ush_usulogin character varying(20) NOT NULL
);


ALTER TABLE public.sgd_ush_usuhistorico OWNER TO postgres;

--
-- TOC entry 1869 (class 1259 OID 16928)
-- Dependencies: 6
-- Name: sgd_usm_usumodifica; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_usm_usumodifica (
    sgd_usm_modcod numeric(5,0) NOT NULL,
    sgd_usm_moddescr character varying(60) NOT NULL
);


ALTER TABLE public.sgd_usm_usumodifica OWNER TO postgres;

--
-- TOC entry 1870 (class 1259 OID 16931)
-- Dependencies: 6
-- Name: tipo_doc_identificacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_doc_identificacion (
    tdid_codi numeric(2,0) NOT NULL,
    tdid_desc character varying(100) NOT NULL
);


ALTER TABLE public.tipo_doc_identificacion OWNER TO postgres;

--
-- TOC entry 1871 (class 1259 OID 16934)
-- Dependencies: 6
-- Name: tipo_remitente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_remitente (
    trte_codi numeric(2,0) NOT NULL,
    trte_desc character varying(100) NOT NULL
);


ALTER TABLE public.tipo_remitente OWNER TO postgres;

--
-- TOC entry 1872 (class 1259 OID 16937)
-- Dependencies: 6
-- Name: ubicacion_fisica; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ubicacion_fisica (
    ubic_depe_radi numeric(5,0) NOT NULL,
    ubic_depe_arch numeric(5,0),
    ubic_inv_piso character varying(2) NOT NULL,
    ubic_inv_piso_desc character varying(40),
    ubic_inv_itemso character varying(40),
    ubic_inv_itemsn character varying(40),
    ubic_inv_archivador character varying(4)
);


ALTER TABLE public.ubicacion_fisica OWNER TO postgres;

--
-- TOC entry 1873 (class 1259 OID 16940)
-- Dependencies: 2201 2202 2203 2204 2205 2206 2207 2208 2209 2210 2211 2212 2213 2214 2215 2216 2217 2218 2219 2220 2221 2222 6
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    usua_codi numeric(10,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_login character varying(15) NOT NULL,
    usua_fech_crea timestamp without time zone NOT NULL,
    usua_pasw character varying(30) NOT NULL,
    usua_esta character varying(10) NOT NULL,
    usua_nomb character varying(45),
    perm_radi character(1) DEFAULT '0'::bpchar,
    usua_admin character(1) DEFAULT '0'::bpchar,
    usua_nuevo character(1) DEFAULT '0'::bpchar,
    usua_doc character varying(14) DEFAULT '0'::character varying,
    codi_nivel numeric(2,0) DEFAULT 1,
    usua_sesion character varying(30),
    usua_fech_sesion timestamp without time zone,
    usua_ext numeric(4,0),
    usua_nacim date,
    usua_email character varying(50),
    usua_at character varying(15),
    usua_piso numeric(2,0),
    perm_radi_sal numeric DEFAULT 0,
    usua_admin_archivo numeric(1,0) DEFAULT 0,
    usua_masiva numeric(1,0) DEFAULT 0,
    usua_perm_dev numeric(1,0) DEFAULT 0,
    usua_perm_numera_res character varying(1),
    usua_doc_suip character varying(15),
    usua_perm_numeradoc numeric(1,0),
    sgd_panu_codi numeric(4,0),
    usua_prad_tp1 numeric(1,0) DEFAULT 0,
    usua_prad_tp2 numeric(1,0) DEFAULT 0,
    usua_prad_tp3 numeric(1,0) DEFAULT 0,
    usua_perm_envios numeric(1,0) DEFAULT 0,
    usua_perm_modifica numeric(1,0) DEFAULT 0,
    usua_perm_impresion numeric(1,0) DEFAULT 0,
    usua_prad_tp9 numeric(1,0),
    sgd_aper_codigo numeric(2,0),
    usu_telefono1 character varying(14),
    usua_encuesta character varying(1),
    sgd_perm_estadistica numeric(2,0),
    usua_perm_sancionados numeric(1,0),
    usua_admin_sistema numeric(1,0),
    usua_perm_trd numeric(1,0),
    usua_perm_firma numeric(1,0),
    usua_perm_prestamo numeric(1,0),
    usuario_publico numeric(1,0),
    usuario_reasignar numeric(1,0),
    usua_perm_notifica numeric(1,0),
    usua_perm_expediente numeric,
    usua_login_externo character varying(15),
    id_pais numeric(4,0) DEFAULT 170,
    id_cont numeric(2,0) DEFAULT 1,
    perm_tipif_anexo numeric,
    perm_vobo character(1) DEFAULT '1'::bpchar,
    perm_archi character(1) DEFAULT '1'::bpchar,
    perm_borrar_anexo numeric,
    usua_auth_ldap numeric,
    usua_perm_adminflujos numeric(1,0) DEFAULT 0 NOT NULL,
    usua_prad_tp6 numeric(1,0) DEFAULT 0,
    usua_perm_comisiones numeric(1,0),
    usua_exp_trd numeric(1,0),
    usua_perm_rademail numeric(1,0),
    CONSTRAINT usuario_usua_perm_comisiones_check CHECK ((((usua_perm_comisiones = (0)::numeric) OR (usua_perm_comisiones = (1)::numeric)) OR (usua_perm_comisiones = (2)::numeric)))
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 2482 (class 0 OID 16386)
-- Dependencies: 1748
-- Data for Name: anexos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY anexos (anex_radi_nume, anex_codigo, anex_tipo, anex_tamano, anex_solo_lect, anex_creador, anex_desc, anex_numero, anex_nomb_archivo, anex_borrado, anex_origen, anex_ubic, anex_salida, radi_nume_salida, anex_radi_fech, anex_estado, usua_doc, sgd_rem_destino, anex_fech_envio, sgd_dir_tipo, anex_fech_impres, anex_depe_creador, sgd_doc_secuencia, sgd_doc_padre, sgd_arg_codigo, sgd_tpr_codigo, sgd_deve_codigo, sgd_deve_fech, sgd_fech_impres, anex_fech_anex, anex_depe_codi, sgd_pnufe_codi, sgd_dnufe_codi, anex_usudoc_creador, sgd_fech_doc, sgd_apli_codi, sgd_trad_codigo, sgd_dir_direccion, muni_codi, dpto_codi, sgd_exp_numero) FROM stdin;
20089000000011	2008900000001100001	1	12.3	S	ADMON		1	120089000000011_00001.doc	N	0	\N	1	\N	\N	0	\N	1	\N	1	\N	900	\N	\N	\N	\N	\N	\N	\N	2008-08-20 11:29:51.249113	\N	\N	\N	\N	\N	\N	1	\N	\N	\N	
20089000000013	2008900000001300001	1	12.3	S	ADMON		1	120089000000013_00001.doc	N	0	\N	1	\N	\N	0	\N	1	\N	1	\N	900	\N	\N	\N	\N	\N	\N	\N	2008-08-20 11:40:23.329299	\N	\N	\N	\N	\N	\N	1	\N	\N	\N	
20089000000021	2008900000002100001	9	6.8	S	ADMON		1	120089000000021_00001d.zip	N	0	\N	1	20089000000021	2008-08-20 12:17:44.802507	3	\N	1	2008-08-20 12:22:53.015554	1	\N	900	\N	\N	\N	\N	\N	\N	2008-08-20 12:22:53.015554	2008-08-20 12:16:16.561808	\N	\N	\N	\N	\N	\N	1	\N	\N	\N	
\.


--
-- TOC entry 2483 (class 0 OID 16396)
-- Dependencies: 1749
-- Data for Name: anexos_historico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY anexos_historico (anex_hist_anex_codi, anex_hist_num_ver, anex_hist_tipo_mod, anex_hist_usua, anex_hist_fecha, usua_doc) FROM stdin;
\.


--
-- TOC entry 2484 (class 0 OID 16400)
-- Dependencies: 1750
-- Data for Name: anexos_tipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) FROM stdin;
13	csv	csv (separado por comas)
1	doc	.doc (Procesador de texto - Word)
2	xls	.xls (Hoja de calculo)
3	ppt	.ppt (Presentacion)
4	tif	.tif (Imagen)
5	jpg	.jpg (Imagen)
6	gif	.gif (Imagen)
7	pdf	.pdf (Acrobat Reader)
8	txt	.txt (Documento texto)
20	avi	.avi (Video)
21	mpg	.mpg (video)
16	xml	.xml (XML de Microsoft Word 2003)
23	tar	.tar (Comprimido)
9	zip	.zip (Comprimido)
10	rtf	.rtf (Rich Text Format)
11	dia	.dia (Diagrama)
12	zargo	Argo(Diagrama)
17	png	.png (Imagen)
14	odt	.odt (Procesador de Texto - odf)
15	ods	.ods (Hoja de Calculo - Odf)
\.


--
-- TOC entry 2485 (class 0 OID 16403)
-- Dependencies: 1751
-- Data for Name: bodega_empresas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY bodega_empresas (nombre_de_la_empresa, nuir, nit_de_la_empresa, sigla_de_la_empresa, direccion, codigo_del_departamento, codigo_del_municipio, telefono_1, telefono_2, email, nombre_rep_legal, cargo_rep_legal, identificador_empresa, are_esp_secue, id_cont, id_pais, activa, flag_rups) FROM stdin;
\.


--
-- TOC entry 2486 (class 0 OID 16412)
-- Dependencies: 1752
-- Data for Name: borrar_carpeta_personalizada; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY borrar_carpeta_personalizada (carp_per_codi, carp_per_usu, carp_per_desc) FROM stdin;
\.


--
-- TOC entry 2487 (class 0 OID 16415)
-- Dependencies: 1753
-- Data for Name: carpeta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY carpeta (carp_codi, carp_desc) FROM stdin;
0	Entrada
12	Devueltos
11	Vo.Bo.
1	Salida
3	Memos
\.


--
-- TOC entry 2488 (class 0 OID 16418)
-- Dependencies: 1754
-- Data for Name: carpeta_per; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY carpeta_per (usua_codi, depe_codi, nomb_carp, desc_carp, codi_carp) FROM stdin;
1	900	ca	carpeta	1
1	900	CA	asas	2
\.


--
-- TOC entry 2489 (class 0 OID 16421)
-- Dependencies: 1755
-- Data for Name: centro_poblado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY centro_poblado (cpob_codi, muni_codi, dpto_codi, cpob_nomb, cpob_nomb_anterior) FROM stdin;
24	615	68	LA MUSANDA	LA MUSANDA
25	615	68	LA UNION DE GALAPAGOS	LA UNION DE GALAPAGOS
31	615	68	SAN RAFAEL	SAN RAFAEL
34	615	68	NUEVA LAGUNA	NUEVA LAGUNA
1	655	68	LA GOMEZ	LA GOMEZ
6	655	68	KILOMETRO 80	KILOMETRO 80
9	655	68	PUERTO SANTOS	PUERTO SANTOS
1	669	68	ALTO DE JAIMES	ALTO DE JAIMES
21	1	95	LA FLORIDA	LA FLORIDA
2	25	95	LA UNILLA	LA UNILLA
1	200	95	BARRANQUILLITA	BARRANQUILLITA
1	1	97	QUERARI	QUERARI
3	1	97	MACUANA	MACUANA
1	889	97	PAPURI	PAPURI
1	1	99	LA VENTUROSA	LA VENTUROSA
1	524	99	NUEVA ANTIOQUIA	NUEVA ANTIOQUIA
5	524	99	GUACACIAS	GUACACIAS
1	572	99	AMANAVEN	AMANAVEN
3	572	99	PUERTO NARINO	PUERTO NARI?O
2	760	99	EL VIENTO	EL VIENTO
5	760	99	MANAJUARE	MANAJUARE
12	468	68	PANTANOGRANDE	PANTANOGRANDE
3	498	68	BUENAVISTA	BUENAVISTA
5	498	68	AGUA BLANCA	AGUA BLANCA
3	500	68	MONJAS	MONJAS
1	502	68	PADUA	PADUA
3	502	68	EL TOPON	EL TOPON
1	522	68	PALO GORDO	PALO GORDO
2	533	68	LA PALMITA	LA PALMITA
4	533	68	PUENTE MIRANDA	PUENTE MIRANDA
3	547	68	SEVILLA	SEVILLA
5	547	68	LA VEGA	LA VEGA
7	547	68	UMPALA	UMPALA
9	547	68	CRISTALES	CRISTALES
11	547	68	LOS CUROS	LOS CUROS
14	547	68	MESITAS SAN JAVIER	MESITAS SAN JAVIER
1	572	68	EL VENADO	EL VENADO
3	572	68	PROVIDENCIA	PROVIDENCIA
5	572	68	BAJO SEMISA	BAJO SEMISA
7	572	68	EL URUMAL	EL URUMAL
10	572	68	ALTO CANTANO	ALTO CANTANO
12	572	68	PENA BLANCA	PE?A BLANCA
15	572	68	PONTON BAJO GUA	PONTON BAJO GUA
1	573	68	CAMPO CAPOTE	CAMPO CAPOTE
18	406	68	LLANADAS	LLANADAS
1	418	68	LA PURNIA	LA PURNIA
3	418	68	EL ESPINAL	EL ESPINAL
5	418	68	SAN RAFAEL	SAN RAFAEL
3	425	68	LA BRICHA	LA BRICHA
5	425	68	ILARCUTA*TIENDA NUEVA	ILARCUTA*TIENDA NUEVA
6	432	68	VENTA QUEMADA	VENTA QUEMADA
9	406	68	PORTUGAL	PORTUGAL
13	406	68	URIBE URIBE	URIBE URIBE
5	271	68	BUENAVISTA	BUENAVISTA
1	276	68	AGUABLANCA	AGUABLANCA
5	38	5	PAJARITO ABAJO	PAJARITO ABAJO
2	40	5	LIBERIA	LIBERIA
3	40	5	MONTEFRIO	MONTEFRIO
4	40	5	SANTO DOMINGO	SANTO DOMINGO
5	40	5	CRISTALINAS	CRISTALINAS
6	40	5	LAS NIEVES	LAS NIEVES
7	40	5	MADRE SECA	MADRE SECA
1	42	5	CATIVO	CATIVO
2	42	5	GUASABRA	GUASABRA
3	42	5	LAS AZULES	LAS AZULES
4	42	5	TONUSCO ARRIBA	TONUSCO ARRIBA
5	42	5	LLANO DE BRISAS	LLANO DE BRISAS
6	42	5	EL PESCADO	EL PESCADO
1	44	5	GUINTAR	GUINTAR
2	44	5	LA CHOLINA	LA CHOLINA
3	44	5	LOS LLANOS	LOS LLANOS
4	44	5	LA CUEVA	LA CUEVA
5	44	5	LA CEJITA	LA CEJITA
6	44	5	LA HIGUINA	LA HIGUINA
1	45	5	SAN JOSE	SAN JOSE
2	45	5	CHURIDO	CHURIDO
3	45	5	ZUNGO	ZUNGO
4	45	5	PUEBLO QUEMADO	PUEBLO QUEMADO
6	45	5	PUERTO CARIBE	PUERTO CARIBE
1	51	5	BUENOS AIRES	BUENOS AIRES
3	51	5	EL CARMELO	EL CARMELO
5	51	5	LAS NARANJITAS	LAS NARANJITAS
7	51	5	SIETE VUELTAS	SIETE VUELTAS
9	51	5	LA TRINIDAD	LA TRINIDAD
10	51	5	LAS PLATAS SANTAFE	LAS PLATAS SANTAFE
11	51	5	LA CANDELARIA	LA CANDELARIA
13	51	5	EL YESO	EL YESO
1	55	5	LA PLATA	LA PLATA
2	55	5	GUADUALITO	GUADUALITO
3	55	5	EL ORO	EL ORO
4	55	5	EL PLAN	EL PLAN
5	55	5	MESONES	MESONES
6	55	5	LA MINA	LA MINA
7	55	5	PITAL	PITAL
8	55	5	EL ROSARIO	EL ROSARIO
9	55	5	LA MARGARITA	LA MARGARITA
1	59	5	LA HERRADURA	LA HERRADURA
2	59	5	LA LOMA	LA LOMA
3	59	5	EL SOCORRO	EL SOCORRO
4	59	5	MOJONES	MOJONES
1	79	5	EL HATILLO	EL HATILLO
2	79	5	GRACIANO	GRACIANO
3	79	5	LAS PENAS	LAS PE?AS
5	79	5	PLATANITO	PLATANITO
6	79	5	ELTABLAZO	ELTABLAZO
1	312	25	CARRIZAL	CARRIZAL
2	312	25	EL RAMAL	EL RAMAL
3	312	25	EL HOYO	EL HOYO
4	312	25	GUASIMAL	GUASIMAL
5	312	25	LA PLANADA	LA PLANADA
6	312	25	LA PLAYITA	LA PLAYITA
7	312	25	LA VEINTIDOS	LA VEINTIDOS
8	312	25	SABANETA	SABANETA
9	312	25	SAN JOSE	SAN JOSE
11	312	25	SANTA FE	SANTA FE
12	312	25	SANTA HELENA	SANTA HELENA
4	400	85	TEN	TEN
5	400	85	EL ARIPORO	EL ARIPORO
3	410	85	CARUPA	CARUPA
1	430	85	BOCAS DEL PAUTO	BOCAS DEL PAUTO
5	430	85	LOS CHOCHOS	LOS CHOCHOS
2	440	85	SANTA ELENA DE UPIA	SANTA ELENA DE UPIA
4	440	85	BUENOS AIRES	BUENOS AIRES
3	1	86	PUEBLO VIEJO	PUEBLO VIEJO
6	1	86	SAN ANTONIO	SAN ANTONIO
8	1	86	SANTA LUCIA	SANTA LUCIA
11	1	86	MANGALPA	MANGALPA
7	1	85	QUEBRADASECA	QUEBRADASECA
1	10	85	CUPIAGUA	CUPIAGUA
3	10	85	SAN BENITO	SAN BENITO
4	10	85	SAN MIGUEL DE FARALLONE	SAN MIGUEL DE FARALLONE
1	15	85	LAGUNITAS	LAGUNITAS
3	15	85	GURUVITA	GURUVITA
3	125	85	LA FRONTERA-LA CHAPA	LA FRONTERA-LA CHAPA
6	125	85	PASO REAL DE ARIPORO	PASO REAL DE ARIPORO
9	125	85	SAN SALVADOR	SAN SALVADOR
11	125	85	SAN JOSE DE ARIPORO	SAN JOSE DE ARIPORO
15	125	85	LAS CAMELIAS	LAS CAMELIAS
2	139	85	LA POYATA	LA POYATA
4	139	85	PASO REAL DE GUARIMENA	PASO REAL DE GUARIMENA
6	139	85	SAN JUAQUIN-GARIBAY	SAN JUAQUIN-GARIBAY
4	162	85	EL PORVENIR	EL PORVENIR
2	225	85	EL CONCHAL	EL CONCHAL
4	225	85	EL VELADERO	EL VELADERO
6	225	85	GUANAPALO	GUANAPALO
9	225	85	BARRANQUILLA	BARRANQUILLA
12	225	85	LA PALMIRA	LA PALMIRA
14	225	85	VIZERTA	VIZERTA
1	230	85	BOCAS DEL CRAVO	BOCAS DEL CRAVO
3	276	68	BARRIO LA LAGUNA	BARRIO LA LAGUNA
7	276	68	LOS LAGOS	LOS LAGOS
9	276	68	ZAPAMANGA IV	ZAPAMANGA IV
1	296	68	SAN ISIDRO	SAN ISIDRO
3	296	68	LA AGUADA	LA AGUADA
5	296	68	LAS VUELTAS	LAS VUELTAS
2	298	68	LA PALMA	LA PALMA
4	298	68	SN RAFAEL	SN RAFAEL
3	307	68	MARTA	MARTA
6	307	68	EL TABLAZO	EL TABLAZO
8	307	68	LLANO GRANDE	LLANO GRANDE
12	307	68	EL RINCON DE GIRON	EL RINCON DE GIRON
16	307	68	CANTALTA	CANTALTA
1	318	68	BARAYA	BARAYA
3	318	68	QUEBRADAS	QUEBRADAS
3	1	18	MARACAIBO	MARACAIBO
5	1	18	SANTA HERMOSA	SANTA HERMOSA
7	1	18	NORCACIA	NORCACIA
8	1	18	VENECIA	VENECIA
1	94	18	EL PORTAL	EL PORTAL
5	94	18	LOS ANGELES	LOS ANGELES
7	94	18	SAN JORGE	SAN JORGE
1	150	18	REMOLINO CAGUAN	REMOLINO CAGUAN
1	205	18	SALAMINA	SALAMINA
1	247	18	MAGUARE	MAGUARE
4	247	18	PUERTO HUNGRIA	PUERTO HUNGRIA
2	256	18	BOLIVIA	BOLIVIA
1	410	18	SANTUARIO	SANTUARIO
3	410	18	PALETARA	PALETARA
4	410	18	LA UNION	LA UNION
1	460	18	GETUCHA	GETUCHA
2	460	18	MATICURO	MATICURO
3	592	18	LUSITANIA	LUSITANIA
5	592	18	LA ESMERALDA	LA ESMERALDA
1	610	18	FRAGUITA	FRAGUITA
2	610	18	YURACO	YURACO
7	616	17	EL PALO	EL PALO
8	616	17	QUIEBRA DE VARI	QUIEBRA DE VARI
10	616	17	LA ESPERANZA	LA ESPERANZA
6	653	17	PORTACHUELO	PORTACHUELO
8	653	17	MEDIO DE L RIOS	MEDIO DE L RIOS
11	653	17	CANAVERAL	CANAVERAL
13	653	17	LA PALMA	LA PALMA
16	653	17	SAN PABLO	SAN PABLO
18	653	17	AMOLADORA GRANDE	AMOLADORA GRANDE
10	168	73	GUANI	GUANI
12	168	73	LAS CRUCES	LAS CRUCES
13	168	73	LA VIRGINIA	LA VIRGINIA
1	200	73	GUALANDAY	GUALANDAY
3	200	73	LLANO VIRGEN	LLANO VIRGEN
4	200	73	POTRERILLO	POTRERILLO
1	217	73	CASTILLA	CASTILLA
2	217	73	HILARCO	HILARCO
4	217	73	SANTA MARTA	SANTA MARTA
6	217	73	SOCORRO	SOCORRO
7	217	73	CASCABEL	CASCABEL
8	217	73	ZARAGOZA	ZARAGOZA
10	217	73	DOYARE CENTRO	DOYARE CENTRO
2	226	73	SAN PABLO	SAN PABLO
4	226	73	VALENCIA	VALENCIA
5	226	73	VARSOVIA	VARSOVIA
7	226	73	BUENAVISTA	BUENAVISTA
1	236	73	AMBICA	AMBICA
3	236	73	EL CARMEN	EL CARMEN
5	236	73	SAN ANDRES	SAN ANDRES
6	236	73	SAN JOSE	SAN JOSE
9	236	73	PALOS ALTOS	PALOS ALTOS
1	268	73	CHICORAL	CHICORAL
3	268	73	SAN FRANCISCO	SAN FRANCISCO
1	270	73	FRIAS	FRIAS
1	275	73	EL COLEGIO	EL COLEGIO
2	275	73	TOPACIO	TOPACIO
1	283	73	BETANIA	BETANIA
24	1	73	SANTA TERESA	SANTA TERESA
26	1	73	CHARCO RICO	CHARCO RICO
2	24	73	EL CARMEN	EL CARMEN
3	24	73	AMESES	AMESES
5	24	73	LA LINDOSA	LA LINDOSA
7	24	73	VEGA GRANDE	VEGA GRANDE
3	26	73	MONTEGRANDE	MONTEGRANDE
5	26	73	VERACRUZ	VERACRUZ
7	26	73	LA PALMITA	LA PALMITA
8	26	73	LA TEBAIDA	LA TEBAIDA
9	26	73	LAGUNETA	LAGUNETA
1	30	73	CUATRO ESQUINAS	CUATRO ESQUINAS
3	30	73	EL SANTUARIO	EL SANTUARIO
5	30	73	RASTROJOS	RASTROJOS
2	43	73	PALOMAR	PALOMAR
4	43	73	SANTA  RITA	SANTA  RITA
2	55	73	MENDEZ	MENDEZ
4	55	73	SAN FELIPE	SAN FELIPE
1	67	73	CAMPOHERMOSO	CAMPOHERMOSO
3	67	73	CASA DE ZINC	CASA DE ZINC
5	67	73	POLE	POLE
6	67	73	POLECITO	POLECITO
8	67	73	BALSILLAS	BALSILLAS
9	67	73	ANDES	ANDES
11	67	73	HOLANDA	HOLANDA
13	67	73	SAN PEDRO TOTUMO	SAN PEDRO TOTUMO
1	124	73	ANAIME	ANAIME
2	124	73	LA FONDA	LA FONDA
4	124	73	CAJAMARQUITA	CAJAMARQUITA
1	152	73	LA MESETA	LA MESETA
2	152	73	SAN JERONIMO	SAN JERONIMO
3	152	73	LEMBO	LEMBO
17	771	70	OREJERO	OREJERO
18	771	70	SAN LUIS	SAN LUIS
19	771	70	TRAVESIA	TRAVESIA
20	771	70	HATO NUEVO	HATO NUEVO
21	771	70	PAMPANILLA	PAMPANILLA
22	771	70	LA SOLERA	LA SOLERA
23	771	70	BAJO PUREZA	BAJO PUREZA
24	771	70	LA PALMA	LA PALMA
25	771	70	MACHETON	MACHETON
9	490	52	SANTA SOLEDAD	SANTA SOLEDAD
2	506	52	SAN ISIDRO	SAN ISIDRO
4	506	52	MERCEDES	MERCEDES
6	506	52	SAN MIGUEL	SAN MIGUEL
1	520	52	CORDOBA	CORDOBA
3	520	52	PATIA	PATIA
4	520	52	PEDRO VEIRA A.	PEDRO VEIRA A.
5	520	52	SIMON BOLIVAR	SIMON BOLIVAR
7	520	52	BOCA DE CURAY	BOCA DE CURAY
9	520	52	JORGE A.CUERO	JORGE A.CUERO
11	520	52	LUIS AVEL PEREZ	LUIS AVEL PEREZ
1	540	52	ALTAMIRA	ALTAMIRA
3	540	52	SAN ROQUE	SAN ROQUE
4	540	52	SANCHEZ	SANCHEZ
6	540	52	SANTA CRUZ	SANTA CRUZ
2	560	52	SAN FRANCISCO	SAN FRANCISCO
4	560	52	LA CABANA	LA CABA?A
5	560	52	LA PALMA	LA PALMA
7	560	52	SAN ANTONIO	SAN ANTONIO
9	560	52	MUESES	MUESES
10	560	52	YAMUESQUER	YAMUESQUER
2	573	52	MONOPAMBA	MONOPAMBA
4	573	52	SAN PABLO	SAN PABLO
5	573	52	MAICIRA	MAICIRA
14	399	52	ALPUJARRA	ALPUJARRA
16	399	52	LA CANADA	LA CA?ADA
18	399	52	OLIVOS	OLIVOS
19	399	52	JACOBA	JACOBA
21	399	52	LA CASTILLA	LA CASTILLA
22	399	52	OJO DE AGUA	OJO DE AGUA
24	399	52	CHAUGUARUCO	CHAUGUARUCO
25	399	52	EL PELIGRO	EL PELIGRO
1	405	52	EL PALMAR	EL PALMAR
2	405	52	LAS DELICIAS	LAS DELICIAS
4	405	52	LA VILLA	LA VILLA
6	405	52	PUERTO NUEVO	PUERTO NUEVO
8	405	52	LA FLORIDA	LA FLORIDA
1	411	52	SAN FRANCISCO	SAN FRANCISCO
2	411	52	TABILES	TABILES
4	411	52	BELLA FLORIDA	BELLA FLORIDA
3	418	52	PANGUS	PANGUS
5	418	52	LA LOMA	LA LOMA
7	418	52	SAN FRANCISCO	SAN FRANCISCO
2	427	52	CONCORDIA	CONCORDIA
4	427	52	PALACIO	PALACIO
5	427	52	PIRAGUA	PIRAGUA
7	427	52	SAN LUIS	SAN LUIS
10	427	52	EL TRUENO	EL TRUENO
13	427	52	LA LOMA	LA LOMA
14	427	52	SANTA (ROSA)	SANTA (ROSA)
2	435	52	CHUCUNES	CHUCUNES
4	435	52	LA OSCURANA	LA OSCURANA
5	435	52	PUERAN	PUERAN
7	435	52	PUSUSQUER	PUSUSQUER
1	473	52	GABRIEL TURBAY	GABRIEL TURBAY
10	354	52	CUARCHU	CUARCHU
1	356	52	LA VICTORIA	LA VICTORIA
2	356	52	LAS LAJAS	LAS LAJAS
4	356	52	YARAMAL	YARAMAL
6	356	52	CHIRES BAJO	CHIRES BAJO
8	356	52	ZAGUARAN	ZAGUARAN
9	356	52	LAS CRUCES	LAS CRUCES
3	378	52	CASCABEL	CASCABEL
5	378	52	SAN GERARDO	SAN GERARDO
6	378	52	EL PULPITO	EL PULPITO
8	378	52	JUAN LOPEZ	JUAN LOPEZ
11	378	52	COFRADIA	COFRADIA
12	378	52	LA CANADA	LA CA?ADA
14	378	52	JUAN ESTEBAN	JUAN ESTEBAN
1	381	52	MATITUY	MATITUY
3	381	52	TUNJA GRANDE	TUNJA GRANDE
4	381	52	SAN FRANCISCO	SAN FRANCISCO
6	381	52	EL MACO	EL MACO
7	381	52	EL CACIQUE	EL CACIQUE
9	381	52	BELLAVISTA	BELLAVISTA
1	385	52	VERGEL	VERGEL
1	390	52	ANTONIO NARINO	ANTONIO NARI?O
3	390	52	LA VIJIA	LA VIJIA
5	390	52	AGUACATAL	AGUACATAL
1	399	52	SANTANDER	SANTANDER
2	399	52	CUSILLO ALTO	CUSILLO ALTO
4	399	52	QUIROS	QUIROS
5	399	52	PRADERA	PRADERA
7	399	52	BUENOS AIRES	BUENOS AIRES
9	399	52	CHILCAL	CHILCAL
10	399	52	REYES	REYES
12	399	52	LA PLAYA	LA PLAYA
13	399	52	CONTADERO	CONTADERO
6	258	52	FATIMA	FATIMA
1	260	52	EL PENOL	EL PE?OL
3	260	52	TROJAYACO	TROJAYACO
4	260	52	SAN PABLO	SAN PABLO
6	260	52	CHAGRAURCO	CHAGRAURCO
8	260	52	LAS COCHAS	LAS COCHAS
1	287	52	CHAPAL	CHAPAL
3	287	52	SAN MIGUEL TELL	SAN MIGUEL TELL
5	287	52	SUCUMBIOS	SUCUMBIOS
6	287	52	EL TOTORAL	EL TOTORAL
8	287	52	CHITARRAL	CHITARRAL
1	317	52	COLIMBA	COLIMBA
6	456	66	LA JEGUADA	LA JEGUADA
8	456	66	MAMPAY	MAMPAY
1	572	66	SANTA CECILIA	SANTA CECILIA
3	572	66	EL AGUILA	EL AGUILA
4	572	66	CHATA	CHATA
6	572	66	LA PRADERA	LA PRADERA
1	594	66	BATERO	BATERO
3	594	66	LA CEIBA	LA CEIBA
5	594	66	MURRAPAL	MURRAPAL
7	594	66	SANTA ELENA	SANTA ELENA
9	594	66	LAS TROJES	LAS TROJES
11	594	66	BUENAVISTA	BUENAVISTA
12	594	66	MORETA	MORETA
15	594	66	EL CAIRO	EL CAIRO
2	682	66	CEDRALITO	CEDRALITO
4	682	66	EL MANZANILLO	EL MANZANILLO
35	1	66	HUERTAS	HUERTAS
37	1	66	EL CHOCHO	EL CHOCHO
38	1	66	LA GRAMINEA	LA GRAMINEA
2	45	66	SAN AGUSTIN	SAN AGUSTIN
4	45	66	JORDANIA	JORDANIA
6	45	66	MATECANA	MATECA?A
8	45	66	ALTA CAMPANA	ALTA CAMPANA
3	75	66	CACHIPAY	CACHIPAY
5	75	66	SAN ANTONIO	SAN ANTONIO
6	75	66	CUBA	CUBA
8	75	66	CRUCES	CRUCES
1	88	66	BALDELOMAR	BALDELOMAR
3	88	66	MATA DE GUADUA	MATA DE GUADUA
4	88	66	PUENTE UMBRIA	PUENTE UMBRIA
6	88	66	ANDICA	ANDICA
8	88	66	PROVIDENCIA	PROVIDENCIA
10	88	66	EL AGUACATE	EL AGUACATE
1	170	66	ALTO DEL TORO	ALTO DEL TORO
3	170	66	BOQUERON	BOQUERON
4	170	66	FRAILES	FRAILES
6	170	66	LA UNION	LA UNION
4	491	27	JUNTAS DE TAMANA	JUNTAS DE TAMANA
5	491	27	LA PLAYITA	LA PLAYITA
6	491	27	SAN LORENZO	SAN LORENZO
7	491	27	SESEGO	SESEGO
8	491	27	URABARA	URABARA
9	491	27	CURUNDO	CURUNDO
1	495	27	ARUSI	ARUSI
2	495	27	COQUI	COQUI
3	495	27	JURUBIDA	JURUBIDA
4	495	27	PANGUI	PANGUI
5	495	27	TRIBUGA	TRIBUGA
6	495	27	AGUA CALIENTE	AGUA CALIENTE
7	495	27	APARTADO	APARTADO
8	495	27	JOVI	JOVI
9	495	27	CHORI	CHORI
1	615	27	BOCAS DE CURBARADO	BOCAS DE CURBARADO
2	615	27	CACARICAS	CACARICAS
3	615	27	DOMINGODO	DOMINGODO
4	615	27	JIGUAMIANDO	JIGUAMIANDO
5	615	27	LA GRANDE	LA GRANDE
6	615	27	LA HONDA	LA HONDA
7	615	27	LA LARGA	LA LARGA
8	615	27	PEYE	PEYE
9	615	27	SALAQUI	SALAQUI
10	615	27	SAUTATA PERANCH	SAUTATA PERANCH
11	615	27	TAMBORAL	TAMBORAL
12	615	27	TRUANDO	TRUANDO
13	615	27	TURRIQUITADO	TURRIQUITADO
14	615	27	VIGIA CURVARADO	VIGIA CURVARADO
15	615	27	VILLANUEVA	VILLANUEVA
16	615	27	ALTO RIOSUCIO	ALTO RIOSUCIO
17	615	27	CHINTADO	CHINTADO
18	615	27	LA TERESITA	LA TERESITA
19	615	27	LA RAYA	LA RAYA
20	615	27	LA TRAVESIA	LA TRAVESIA
22	615	27	PERANCHITO	PERANCHITO
24	615	27	LA ISLETA	LA ISLETA
2	79	68	BUTAREGUA	BUTAREGUA
1	81	68	EL CENTRO	EL CENTRO
3	81	68	LIZAMA	LIZAMA
6	81	68	SAN RAFAEL DE CHUCURI	SAN RAFAEL DE CHUCURI
1	92	68	EL RAMO	EL RAMO
3	92	68	PUTANA	PUTANA
4	92	68	SAN JORGE	SAN JORGE
6	92	68	LA DURA	LA DURA
8	92	68	TIENDA NUEVA	TIENDA NUEVA
1	101	68	BERBEO	BERBEO
3	101	68	FLOREZ	FLOREZ
5	101	68	SANTA ROSA	SANTA ROSA
7	101	68	EL TRAPAL	EL TRAPAL
10	713	70	RINCON	RINCON
12	713	70	SAN ANTONIO	SAN ANTONIO
13	713	70	PASACORRIENDO	PASACORRIENDO
15	713	70	EL CHICHO	EL CHICHO
16	713	70	BARRANCA	BARRANCA
18	713	70	PAJONALITO	PAJONALITO
19	713	70	PUEBLITO	PUEBLITO
21	713	70	PALACIO	PALACIO
23	713	70	PALMIRA	PALMIRA
1	717	70	SAN MATEO	SAN MATEO
2	717	70	ROVIRA	ROVIRA
1	742	70	ANIME	ANIME
2	742	70	BAZAN	BAZAN
4	742	70	COCOROTE	COCOROTE
6	742	70	HATILLO	HATILLO
7	742	70	JUNIN	JUNIN
9	742	70	PANTANO	PANTANO
11	742	70	VELEZ	VELEZ
12	742	70	VILLAVICENCIO	VILLAVICENCIO
14	742	70	PERENDENGUE	PERENDENGUE
16	742	70	MORALITO	MORALITO
1	771	70	ARBOLEDA	ARBOLEDA
3	771	70	CALZON BLANCO	CALZON BLANCO
5	771	70	CAMPO ALEGRE	CAMPO ALEGRE
7	771	70	CHAPARRAL	CHAPARRAL
9	771	70	ISLA DEL COCO	ISLA DEL COCO
11	771	70	LA GUARIPA	LA GUARIPA
13	771	70	MONTERIA	MONTERIA
14	771	70	MUZANGA	MUZANGA
16	771	70	NARINO	NARI?O
5	670	70	HUERTAS CHICAS	HUERTAS CHICAS
6	670	70	LA NEGRA	LA NEGRA
8	670	70	PALITO	PALITO
9	670	70	PIEDRAS BLANCAS	PIEDRAS BLANCAS
11	670	70	SAN LUIS	SAN LUIS
12	670	70	SEGOVIA	SEGOVIA
14	670	70	CORNETA	CORNETA
1	678	70	BOQUERONES	BOQUERONES
2	678	70	CUIVA	CUIVA
4	678	70	LA CEIBA	LA CEIBA
6	678	70	LOS ANGELES	LOS ANGELES
8	678	70	RABON	RABON
9	678	70	SAN ROQUE	SAN ROQUE
11	678	70	DONA ANA	DO?A ANA
12	678	70	GUAYABAL	GUAYABAL
13	678	70	EL LIMON	EL LIMON
15	678	70	LA VENTURA	LA VENTURA
16	678	70	TIERRA SANTA	TIERRA SANTA
18	678	70	PATILLAL	PATILLAL
20	678	70	PUNTA NUEVA	PUNTA NUEVA
22	678	70	CIENAGA NUEVA	CIENAGA NUEVA
24	678	70	PALMITAL	PALMITAL
25	678	70	CIZPATACA	CIZPATACA
27	678	70	VILLA NUEVA	VILLA NUEVA
29	678	70	EL CAUCHAL	EL CAUCHAL
1	702	70	ALBANIA	ALBANIA
2	702	70	HATO VIEJO	HATO VIEJO
4	702	70	SABANETA	SABANETA
1	708	70	BELEN	BELEN
2	708	70	BUENAVISTA	BUENAVISTA
4	708	70	CANO PRIETO	CANO PRIETO
6	708	70	EL LIMON	EL LIMON
8	708	70	EL TORNO	EL TORNO
10	708	70	MONTEGRANDE	MONTEGRANDE
11	708	70	PALO ALTO	PALO ALTO
13	708	70	SANTA INES	SANTA INES
4	418	70	SABANAS BELTRAN	SABANAS BELTRAN
6	418	70	HATILLO	HATILLO
7	418	70	NARANJAL	NARANJAL
2	429	70	EL NARANJO	EL NARANJO
6	429	70	LAS PALMITAS	LAS PALMITAS
9	429	70	PUEBLONUEVO	PUEBLONUEVO
11	429	70	SANTANDER	SANTANDER
13	429	70	ZAPATA	ZAPATA
15	429	70	BELLAVISTA	BELLAVISTA
16	429	70	LEON BLANCO	LEON BLANCO
19	429	70	EDUARDO SANTOS	EDUARDO SANTOS
22	429	70	LAS CANDELARIAS	LAS CANDELARIAS
24	429	70	MIRAFLORES	MIRAFLORES
2	473	70	EL RINCON	EL RINCON
3	473	70	EL YESO	EL YESO
5	473	70	SABANETA	SABANETA
7	473	70	TIEMPO PERDIDO	TIEMPO PERDIDO
9	473	70	SABANAS DE CALI	SABANAS DE CALI
1	508	70	ALMAGRA	ALMAGRA
2	508	70	CANUTAL	CANUTAL
4	508	70	CHENGUE	CHENGUE
5	508	70	DAMASCO	DAMASCO
7	508	70	EL FLORAL	EL FLORAL
6	154	5	MARGENTO	MARGENTO
7	154	5	PUERTO COLOMBIA	PUERTO COLOMBIA
8	154	5	PALANCA	PALANCA
9	154	5	PALOMAR	PALOMAR
10	154	5	PUEBLO NUEVO	PUEBLO NUEVO
11	154	5	PUERTO GLORIA	PUERTO GLORIA
4	669	68	HATO  DE CABALLEROS	HATO  DE CABALLEROS
6	669	68	LISTARA	LISTARA
7	669	68	PANGOTE	PANGOTE
8	669	68	PANGUA	PANGUA
10	669	68	SANTO DOMINGO	SANTO DOMINGO
12	669	68	MOGOTOCORO	MOGOTOCORO
14	669	68	ANCA	ANCA
1	673	68	SAN BENITO	SAN BENITO
3	673	68	SAN BENITO NUEVO	SAN BENITO NUEVO
2	679	68	PUENTE DE ARCO	PUENTE DE ARCO
4	679	68	SANTA RITA	SANTA RITA
6	679	68	OJO DE AGUA	OJO DE AGUA
8	679	68	BEJARANAS	BEJARANAS
9	679	68	VERSALLES	VERSALLES
11	679	68	PALO BLANCO	PALO BLANCO
13	679	68	EL VOLADOR	EL VOLADOR
15	679	68	EL CUCHARO	EL CUCHARO
17	679	68	SAN MARTIN	SAN MARTIN
1	682	68	RICAURTE	RICAURTE
2	682	68	SAN CAYETANO	SAN CAYETANO
2	684	68	PETAQUERO	PETAQUERO
3	684	68	TEQUIA	TEQUIA
6	684	68	CUCHARITO	CUCHARITO
7	684	68	TIERRA BLANCA	TIERRA BLANCA
1	686	68	PIEDRALARGA	PIEDRALARGA
3	686	68	SAN PEDRO	SAN PEDRO
4	686	68	ARENALES	ARENALES
1	689	68	ALBANIA	ALBANIA
8	689	68	LOS ALJIBES	LOS ALJIBES
9	689	68	LLANA FRIA	LLANA FRIA
2	573	68	LAS MONTOYAS	LAS MONTOYAS
4	573	68	AGUA LINDA	AGUA LINDA
1	575	68	BADILLO	BADILLO
3	575	68	BOCAS ROSARIO	BOCAS ROSARIO
4	575	68	CARPINTERO	CARPINTERO
5	575	68	CHINGALE	CHINGALE
7	575	68	EL PEDRAL	EL PEDRAL
10	575	68	KILOMETRO 16	KILOMETRO 16
13	575	68	PATURIA	PATURIA
14	575	68	PRADILLA	PRADILLA
18	575	68	VIJAGUAL	VIJAGUAL
19	575	68	CAYUMBA	CAYUMBA
1	615	68	EL RUBI	EL RUBI
2	615	68	CUESTA RICA	CUESTA RICA
5	615	68	LA CONSULTA	LA CONSULTA
8	615	68	POPAS	POPAS
9	615	68	LA CEIBA	LA CEIBA
11	615	68	LLANO DE PALMAS	LLANO DE PALMAS
12	615	68	MISIJUAY	MISIJUAY
15	615	68	VILLA PAZ	VILLA PAZ
26	615	68	LA PLATANALA	LA PLATANALA
2	302	63	LA VENADA	LA VENADA
1	401	63	LA HERRADURA	LA HERRADURA
4	470	63	ONCE CASAS	ONCE CASAS
7	470	63	EL CASTILLO	EL CASTILLO
2	548	63	LA MARIELA	LA MARIELA
1	594	63	EL JAZMIN	EL JAZMIN
2	594	63	EL LAUREL	EL LAUREL
4	594	63	LA MESA BAJA	LA MESA BAJA
16	548	19	LOS UVALES	LOS UVALES
17	548	19	SAN ISIDRO	SAN ISIDRO
5	450	19	SAN JOAQUIN	SAN JOAQUIN
6	450	19	SAN JUANITO	SAN JUANITO
7	450	19	TABLONES ALTOS	TABLONES ALTOS
6	318	68	CAMARA	CAMARA
8	318	68	POTRERO GRANDE	POTRERO GRANDE
11	318	68	BARIA	BARIA
13	318	68	NUEVA GRANADA	NUEVA GRANADA
1	209	68	SAN JOAQUIN	SAN JOAQUIN
2	217	68	PUEBLO VIEJO	PUEBLO VIEJO
3	229	68	LAS VUELTAS	LAS VUELTAS
5	229	68	EL COMUN	EL COMUN
7	229	68	CANAVERAL DEL UVA	CANAVERAL DEL UVA
1	235	68	ANGOSTURA DE LOS ANDES	ANGOSTURA DE LOS ANDES
6	235	68	ISIANCE	ISIANCE
8	235	68	LOS ANDES	LOS ANDES
10	235	68	TRES AMIGOS	TRES AMIGOS
11	235	68	VISTA HERMOSA DE LOS A	VISTA HERMOSA DE LOS A
1	255	68	BARRIO NUEVO	BARRIO NUEVO
4	255	68	EL PINO	EL PINO
6	255	68	LAGUNA NUEVA ORIENTE	LAGUNA NUEVA ORIENTE
11	255	68	PLANADAS	PLANADAS
13	255	68	SAN BERNARDO	SAN BERNARDO
1	264	68	CANADA	CANADA
2	266	68	PENA COLORADA	PE?A COLORADA
4	266	68	AGUA SUCIA	AGUA SUCIA
8	266	68	CORTADERAS	CORTADERAS
3	271	68	SAN ANTONIO DE LEONES	SAN ANTONIO DE LEONES
6	162	68	EL RODEO	EL RODEO
8	162	68	TABETA	TABETA
10	162	68	PERALONSO	PERALONSO
3	167	68	RIACHUELO	RIACHUELO
1	169	68	LA AGUADA	LA AGUADA
4	169	68	ESCUELA DE PERICO	ESCUELA DE PERICO
2	176	68	PEON JERICO	PEON JERICO
4	179	68	EL PAPAYO	EL PAPAYO
6	179	68	LAS CRUCES	LAS CRUCES
8	179	68	LLANO DE SAN JUAN	LLANO DE SAN JUAN
3	190	68	PUERTO OLAYA	PUERTO OLAYA
6	190	68	SANTA ROSA DEL CARARE	SANTA ROSA DEL CARARE
8	190	68	LA PERDIDA	LA PERDIDA
11	190	68	CANO BAUL	CANO BAUL
13	190	68	LA INDIA	LA INDIA
15	190	68	PADILLA	PADILLA
1	207	68	MOJICONES	MOJICONES
4	207	68	SOLON WILCHES	SOLON WILCHES
8	207	68	CUZAGUETA	CUZAGUETA
1	79	68	GUANE	GUANE
3	79	68	PARAMITO	PARAMITO
2	81	68	EL LLANITO	EL LLANITO
4	81	68	MESETA SAN RAFAEL	MESETA SAN RAFAEL
2	92	68	MONTEBELLO	MONTEBELLO
5	92	68	SANTA BARBARA	SANTA BARBARA
7	92	68	CERRO D LA PAZ	CERRO D LA PAZ
9	92	68	SOL DE ORIENTE	SOL DE ORIENTE
6	101	68	EL ESPINAL	EL ESPINAL
9	101	68	LA HERMOSURA	LA HERMOSURA
12	101	68	LAJA SECA	LAJA SECA
14	101	68	PLAN DE ROJAS	PLAN DE ROJAS
2	121	68	OJO DE AGUA	OJO DE AGUA
1	132	68	EL CERRILLO	EL CERRILLO
4	147	68	QUEBRADA DE VERA	QUEBRADA DE VERA
7	147	68	CARRIZAL	CARRIZAL
2	152	68	LA LEONA	LA LEONA
5	152	68	LA RAMADA	LA RAMADA
7	152	68	SAN LUIS	SAN LUIS
3	440	66	LA ARGENTINA	LA ARGENTINA
6	440	66	EL GUAYABO	EL GUAYABO
9	440	66	ESTACION PEREIRA	ESTACION PEREIRA
2	456	66	PUERTO DE ORO	PUERTO DE ORO
4	456	66	NACEDEROS	NACEDEROS
7	456	66	ARIBATO	ARIBATO
9	456	66	PURENBARA	PURENBARA
2	572	66	VILLA CLARET	VILLA CLARET
5	572	66	GUAYABAL	GUAYABAL
2	594	66	IRRA	IRRA
4	594	66	OPIRAMA	OPIRAMA
6	594	66	NARANJAL	NARANJAL
8	594	66	SUMERA	SUMERA
10	594	66	MIRACAMPOS	MIRACAMPOS
14	594	66	SAN JOSE	SAN JOSE
1	682	66	BOQUERON	BOQUERON
3	682	66	EL ESPANOL	EL ESPANOL
36	1	66	EL PITAL DE COMBIA	EL PITAL DE COMBIA
1	45	66	GUARNE	GUARNE
3	45	66	SAN CARLOS	SAN CARLOS
5	45	66	VALLADOLID	VALLADOLID
7	45	66	LA CANDELARIA	LA CANDELARIA
4	75	66	TAMBORES	TAMBORES
7	75	66	LA AURORA	LA AURORA
9	75	66	TRES ESQUINAS	TRES ESQUINAS
2	88	66	COLUMBIA*FLORIDA	COLUMBIA*FLORIDA
5	88	66	TAPARCAL	TAPARCAL
7	88	66	BAJO SIRGUIA	BAJO SIRGUIA
9	88	66	SANTA EMILIA	SANTA EMILIA
2	170	66	BARRIO OTUN	BARRIO OTUN
5	170	66	LA BADEA	LA BADEA
26	256	19	SAN JUAN MECHEN	SAN JUAN MECHEN
30	256	19	LA LAGUNA	LA LAGUNA
32	256	19	LAS BOTAS	LAS BOTAS
34	256	19	EL CRUCERO DE PUEBLO	EL CRUCERO DE PUEBLO
8	75	19	LA LOMITA	LA LOMITA
2	100	19	CERRO PELADO	CERRO PELADO
4	100	19	NUEVA GRANADA	NUEVA GRANADA
7	100	19	GUACHICONO	GUACHICONO
8	100	19	LA CUMBRE DE SANTA INES	LA CUMBRE DE SANTA INES
13	100	19	LERMA	LERMA
15	100	19	LOS MILAGROS	LOS MILAGROS
17	100	19	MAZAMORRAS	MAZAMORRAS
19	100	19	SAN JOSE DEL MORRO	SAN JOSE DEL MORRO
22	100	19	SAN MIGUEL	SAN MIGUEL
25	100	19	GUAYABILLAS	GUAYABILLAS
28	100	19	BUTUYACO	BUTUYACO
30	100	19	PALMA O POCOS	PALMA O POCOS
32	100	19	PUENTE FIERRO	PUENTE FIERRO
35	100	19	EL GUADUAL	EL GUADUAL
38	100	19	LA ESPERANZA	LA ESPERANZA
40	100	19	LA PLAYA DE SAN JORGE	LA PLAYA DE SAN JORGE
44	100	19	VILLA NUEVA	VILLA NUEVA
1	110	19	ALTAMIRA	ALTAMIRA
2	753	18	GUACAMAYAS	GUACAMAYAS
4	753	18	CAMPO HERMOSO	CAMPO HERMOSO
7	753	18	TRES ESQUINAS	TRES ESQUINAS
10	753	18	GIBRALTAR	GIBRALTAR
1	765	18	ARARACUARA	ARARACUARA
5	765	18	PENAS BLANCAS	PE?AS BLANCAS
4	860	18	PLAYA RICA	PLAYA RICA
3	1	19	EL CHARCO	EL CHARCO
6	1	19	FIGUEROA	FIGUEROA
8	1	19	LA REJOYA	LA REJOYA
10	1	19	LAS MERCEDES	LAS MERCEDES
12	1	19	OLAYA HERRERA	OLAYA HERRERA
16	1	19	SAMANGA	SAMANGA
18	1	19	SANTA BARBARA	SANTA BARBARA
20	1	19	YANACONAS	YANACONAS
22	1	19	BELLO HORIZONTE	BELLO HORIZONTE
1	22	19	CAQUIONA	CAQUIONA
4	22	19	LLACUANAS	LLACUANAS
6	22	19	TARABITA	TARABITA
8	22	19	HIGUERAS L PILA	HIGUERAS L PILA
12	22	19	PRIMAVERA	PRIMAVERA
2	50	19	LA BELLEZA	LA BELLEZA
5	50	19	EL DIVISO	EL DIVISO
4	867	17	LA PRADERA	LA PRADERA
1	873	17	ALTO DE LA CRUZ	ALTO DE LA CRUZ
4	873	17	RIOCLARO	RIOCLARO
7	873	17	MIRAFLORES	MIRAFLORES
9	873	17	LA FLORIDA	LA FLORIDA
2	877	17	EL SOCORRO	EL SOCORRO
5	877	17	LA TESALIA	LA TESALIA
2	1	18	EL REMOLINO	EL REMOLINO
4	1	18	SAN ANTONIO	SAN ANTONIO
6	1	18	LA ESPERANZA	LA ESPERANZA
3	29	18	DORADO	DORADO
3	94	18	PUERTO TORRES	PUERTO TORRES
8	94	18	LOS ALETONES	LOS ALETONES
2	150	18	SANTA FE CAGUAN	SANTA FE CAGUAN
2	247	18	PUERTO MANRIQUE	PUERTO MANRIQUE
1	256	18	VERSALLES	VERSALLES
2	410	18	UNION PENEYA	UNION PENEYA
5	410	18	EL TRIUNFO	EL TRIUNFO
2	592	18	RIO NEGRO	RIO NEGRO
4	592	18	SANTA RAMOS	SANTA RAMOS
6	592	18	LA AGUILILLA	LA AGUILILLA
1	753	18	CIUDAD YARI	CIUDAD YARI
9	616	17	LA BOHEMIA	LA BOHEMIA
4	653	17	LA UNION	LA UNION
7	653	17	SAN FELIX	SAN FELIX
9	653	17	CURUVITAL	CURUVITAL
12	653	17	LA DIVISA	LA DIVISA
17	653	17	BUENOS AIRES	BUENOS AIRES
19	653	17	EL BOTON	EL BOTON
21	653	17	SAN DIEGO	SAN DIEGO
24	653	17	EL YARUMO	EL YARUMO
2	662	17	CONFINES	CONFINES
5	662	17	LOS POMOS	LOS POMOS
7	662	17	SAN DIEGO	SAN DIEGO
9	662	17	EL SILENCIO	EL SILENCIO
11	662	17	EL HIGUERON	EL HIGUERON
14	662	17	CRISTALES	CRISTALES
1	777	17	ALTO SEVILLA	ALTO SEVILLA
4	777	17	LA LOMA	LA LOMA
7	777	17	LA JULIA	LA JULIA
1	867	17	CANAVERAL	CA?AVERAL
6	486	17	LA CRISTALINA	LA CRISTALINA
6	388	17	MACIEGAL	MACIEGAL
8	388	17	SN JOSE	SN JOSE
1	433	17	AGUABONITA	AGUABONITA
13	88	5	SAN FELIX	SAN FELIX
15	88	5	NIQUIA	NIQUIA
16	88	5	BARRIO NUEVO	BARRIO NUEVO
2	91	5	LA LIBIA	LA LIBIA
3	93	5	LUCIANO RESTREPO	LUCIANO RESTREPO
1	101	5	ALFONSO LOPEZ	ALFONSO LOPEZ
3	101	5	EL MANZANILLO	EL MANZANILLO
2	107	5	EL ROBLAL	EL ROBLAL
1	113	5	EL NARANJO	EL NARANJO
4	113	5	URARCO	URARCO
7	113	5	MANGLAR	MANGLAR
3	120	5	GUARUMO	GUARUMO
5	120	5	EL TIGRE	EL TIGRE
5	308	5	ENCENILLA	ENCENILLA
10	308	5	LAS CUCHILLAS	LAS CUCHILLAS
15	308	5	SAN DIEGO	SAN DIEGO
2	310	5	SAN MATIAS	SAN MATIAS
3	313	5	GALILEA	GALILEA
5	313	5	MINITAS	MINITAS
2	315	5	GUALTEROS	GUALTEROS
7	315	5	GUADALUPE IV	GUADALUPE IV
2	318	5	ALTO DE LA VIRGEN	ALTO DE LA VIRGEN
5	318	5	YOLOMBAL	YOLOMBAL
1	347	5	ALTO DEL CORRAL	ALTO DEL CORRAL
6	347	5	LA CHORRERA	LA CHORRERA
3	360	5	EL AJISAL	EL AJISAL
5	360	5	LA LOMA I	LA LOMA I
7	360	5	EL ROSARIO	EL ROSARIO
9	360	5	SAN PIO	SAN PIO
2	361	5	BUILOPOLIS(EL ARO)	BUILOPOLIS(EL ARO)
6	361	5	SANTA LUCIA	SANTA LUCIA
7	361	5	SANTA RITA DE ITUANGO	SANTA RITA DE ITUANGO
11	361	5	QUEBRADA DEL MEDIO	QUEBRADA DEL MEDIO
12	234	5	CHIMIANDO	CHIMIANDO
1	237	5	BELLAVISTA	BELLAVISTA
2	240	5	ECUADOR	ECUADOR
4	240	5	VUELTA LA OREJA	VUELTA LA OREJA
7	240	5	GUAYABAL	GUAYABAL
1	250	5	SANTA MARGARITA	SANTA MARGARITA
4	250	5	PUERTO LOPEZ	PUERTO LOPEZ
3	266	5	ZUNIGA	ZU?IGA
2	282	5	LOS PALOMOS	LOS PALOMOS
5	282	5	MARSELLA	MARSELLA
7	282	5	ZABALETAS	ZABALETAS
9	282	5	LOMA DEL PLAN	LOMA DEL PLAN
13	282	5	PIANOLA	PIANOLA
14	282	5	PIEDRA VERDE	PIEDRA VERDE
4	284	5	MURRI	MURRI
6	284	5	NUTIBARA	NUTIBARA
9	284	5	BUENOS AIRES	BUENOS AIRES
1	306	5	MANGLAR	MANGLAR
1	308	5	LA MANGA ARRIBA	LA MANGA ARRIBA
12	154	5	SANTA ROSITA	SANTA ROSITA
15	154	5	PUERTO GAITAN	PUERTO GAITAN
17	154	5	LOS MEDIOS	LOS MEDIOS
20	154	5	PUERTO TRIANA	PUERTO TRIANA
3	190	5	ALGARROBO	ALGARROBO
1	197	5	AGUALINDA	AGUALINDA
5	1	76	LA BUITRERA	LA BUITRERA
6	1	76	LA CASTILLA	LA CASTILLA
7	1	76	LA ELVIRA	LA ELVIRA
8	1	76	LA LEONERA	LA LEONERA
9	1	76	LA PAZ	LA PAZ
10	1	76	LOS ANDES	LOS ANDES
11	1	76	MELENDEZ	MELENDEZ
12	1	76	NAVARRO	NAVARRO
13	1	76	PANCE	PANCE
14	1	76	PICHINDE	PICHINDE
16	1	76	MONTE BELLO	MONTE BELLO
17	1	76	VISTA HERMOSA	VISTA HERMOSA
18	1	76	BELLA VISTA	BELLA VISTA
1	20	76	LA CUCHILLA	LA CUCHILLA
2	20	76	MARAVELEZ	MARAVELEZ
3	20	76	LA ESTRELLA	LA ESTRELLA
4	20	76	EL CONGAL	EL CONGAL
5	20	76	LA CANA	LA CA?A
1	36	76	ALTAFLOR	ALTAFLOR
2	36	76	CAMPOALEGRE	CAMPOALEGRE
3	36	76	EL SALTO	EL SALTO
4	36	76	PARDO	PARDO
5	36	76	ZABALETAS	ZABALETAS
6	36	76	TAMBORAL	TAMBORAL
7	36	76	SANJON D PIEDRA	SANJON D PIEDRA
8	36	76	POTRERILLO	POTRERILLO
9	36	76	MONTE HERMOSO	MONTE HERMOSO
1	41	76	ANACARO	ANACARO
2	41	76	CALABAZAS	CALABAZAS
3	41	76	EL BILLAR	EL BILLAR
4	41	76	EL BOSQUE	EL BOSQUE
5	41	76	EL ROBLE	EL ROBLE
6	41	76	EL VERJEL	EL VERJEL
7	41	76	LA CABA A	LA CABA A
8	41	76	LA HONDURA	LA HONDURA
9	41	76	LA RAIZ	LA RAIZ
10	41	76	LUSITANIA	LUSITANIA
11	41	76	SAN AGUSTIN	SAN AGUSTIN
12	41	76	TRES ESQUINAS	TRES ESQUINAS
13	41	76	GRAMALOTE	GRAMALOTE
14	41	76	LA PUERTA	LA PUERTA
15	41	76	ALTO TIGRE	ALTO TIGRE
16	41	76	LA PEDRERA	LA PEDRERA
1	1	5	PALMITAS	PALMITAS
2	1	5	SAN ANTONIO DE PRADO	SAN ANTONIO DE PRADO
3	1	5	SAN CRISTOBAL	SAN CRISTOBAL
4	1	5	SANTA HELENA	SANTA HELENA
5	1	5	PEDREGAL	PEDREGAL
6	1	5	EL BOSQUE	EL BOSQUE
7	1	5	SAN JAVIER	SAN JAVIER
8	1	5	BUENOS AIRES	BUENOS AIRES
1	2	5	CHAGUALAL	CHAGUALAL
2	2	5	PANTANILLO	PANTANILLO
3	2	5	PURIMA	PURIMA
4	2	5	NARANJAL	NARANJAL
5	2	5	GUAYABAL	GUAYABAL
6	2	5	PURNIA	PURNIA
7	2	5	PORTUGAL	PORTUGAL
10	2	5	EL CAIRO	EL CAIRO
11	2	5	EL ERIZO	EL ERIZO
12	2	5	GUAICO GIBADO	GUAICO GIBADO
1	4	5	CORCOVADO	CORCOVADO
2	4	5	LA ANTIGUA	LA ANTIGUA
1	30	5	CAMILOCE RESTREPO	CAMILOCE RESTREPO
2	30	5	EL CEDRO	EL CEDRO
3	30	5	LA CLARITA	LA CLARITA
4	30	5	LA FERREIRA	LA FERREIRA
5	30	5	LA GUALI	LA GUALI
6	30	5	PIEDECUESTA	PIEDECUESTA
7	30	5	LOS ALVAREZ	LOS ALVAREZ
8	30	5	DOS PENAS	DOS PE?AS
9	30	5	MANI DE LOS MANGOS	MANI DE LOS MANGOS
4	31	5	PORTACHUELO	PORTACHUELO
5	31	5	ARENAS BLANCAS	ARENAS BLANCAS
6	31	5	EL ZACATIN	EL ZACATIN
7	31	5	LA GUAYANA	LA GUAYANA
8	31	5	BARRIO OBRERO	BARRIO OBRERO
9	31	5	EL TIGRE	EL TIGRE
10	31	5	LA CANCANA	LA CANCANA
1	34	5	BUENOS AIRES	BUENOS AIRES
3	34	5	SAN JOSE	SAN JOSE
4	34	5	SAN PEDRO	SAN PEDRO
5	34	5	SANTA BARBARA	SANTA BARBARA
6	34	5	SANTA RITA	SANTA RITA
7	34	5	TAPARTO	TAPARTO
8	34	5	LA CEDRONA	LA CEDRONA
9	34	5	QUEBRADA ARRIBA	QUEBRADA ARRIBA
10	34	5	LA SOLEDAD	LA SOLEDAD
11	34	5	VALLE UMBRIA	VALLE UMBRIA
1	36	5	ESTACION ANGELOPOLIS	ESTACION ANGELOPOLIS
3	36	5	SANTA ANA	SANTA ANA
4	36	5	SAN ISIDRO	SAN ISIDRO
5	36	5	EL NUDILLO	EL NUDILLO
6	36	5	SANTA RITA	SANTA RITA
7	36	5	LA CLARA	LA CLARA
1	38	5	EL CARMELO	EL CARMELO
2	38	5	LA QUINTA	LA QUINTA
3	38	5	PAJARITO ARRIBA	PAJARITO ARRIBA
4	38	5	EL SOCORRO	EL SOCORRO
5	197	5	LA PINUELA	LA PI?UELA
8	197	5	LA HONDA	LA HONDA
10	197	5	LA FLORIDA	LA FLORIDA
1	209	5	EL SOCORRO	EL SOCORRO
4	209	5	SAN FRANCISCO	SAN FRANCISCO
5	669	68	LAGUNA DE ORTICES	LAGUNA DE ORTICES
9	669	68	SANTA CRUZ	SANTA CRUZ
11	669	68	LA RAMADA	LA RAMADA
13	669	68	SAN PABLO	SAN PABLO
2	673	68	ALTO SAN ROQUE	ALTO SAN ROQUE
1	679	68	CA AVERAL	CA AVERAL
3	679	68	SAN JOSE	SAN JOSE
5	679	68	MACANILLO	MACANILLO
4	1	13	BAYUNCA	BAYUNCA
6	1	13	CANO DE LORO	CA?O DE LORO
10	679	68	POPAGA	POPAGA
12	679	68	GUARIGUA	GUARIGUA
14	679	68	EL JOVITO	EL JOVITO
16	679	68	LAS JOYAS	LAS JOYAS
18	679	68	SAN PEDRO	SAN PEDRO
1	684	68	CRUZ DE PIEDRA	CRUZ DE PIEDRA
4	684	68	CARBONERAS	CARBONERAS
5	684	68	ALTO S JOSE MIRANDA	ALTO S JOSE MIRANDA
2	686	68	SAN IGNACIO	SAN IGNACIO
5	686	68	PAMPLONITA	PAMPLONITA
7	689	68	LA TEMPESTUOSA	LA TEMPESTUOSA
10	689	68	PUENTE MURCIA	PUENTE MURCIA
3	573	68	BOCAS DEL CARARE	BOCAS DEL CARARE
2	575	68	BOCAS RIO LEBRIJA	BOCAS RIO LEBRIJA
6	575	68	EL GUAYABO	EL GUAYABO
9	575	68	LAS GARZAS	LAS GARZAS
11	575	68	KILOMETRO 20	KILOMETRO 20
15	575	68	PUENTE SOGAMOSO	PUENTE SOGAMOSO
22	575	68	SITIO NUEVO	SITIO NUEVO
4	615	68	LA SALINA	LA SALINA
6	615	68	GALAPAGOS	GALAPAGOS
10	615	68	LA GLORIA TIGRA	LA GLORIA TIGRA
13	615	68	PAPAYAL	PAPAYAL
4	204	70	EL CERRO	EL CERRO
6	204	70	EL OJITO	EL OJITO
7	204	70	JONEY	JONEY
1	215	70	CANTAGALLO	CANTAGALLO
3	215	70	CORNETA	CORNETA
4	215	70	CHAPINERO	CHAPINERO
5	215	70	DON ALONSO	DON ALONSO
6	215	70	EL MAMON	EL MAMON
7	215	70	EL ROBLE	EL ROBLE
8	215	70	EL SITIO	EL SITIO
9	215	70	HATO NUEVO	HATO NUEVO
10	215	70	LAS LLANADAS	LAS LLANADAS
11	215	70	LAS TINAS	LAS TINAS
12	215	70	LOMA ALTA	LOMA ALTA
14	215	70	PILETA	PILETA
15	215	70	SAN FRANCISCO	SAN FRANCISCO
16	215	70	RINCON D FLORES	RINCON D FLORES
41	1	27	ALTO MUNGUIDO	ALTO MUNGUIDO
42	1	27	BOCA DE AME	BOCA DE AME
43	1	27	BOCA D APARTADO	BOCA D APARTADO
44	1	27	BOCA DE NAURITA	BOCA DE NAURITA
45	1	27	SAN ANTONIO	SAN ANTONIO
46	1	27	MOTOLDO	MOTOLDO
47	1	27	EL FUERTE	EL FUERTE
2	6	27	CAPITAN	CAPITAN
3	6	27	CAPURGANA	CAPURGANA
5	6	27	LA CALETA	LA CALETA
6	6	27	PINORROA	PINORROA
7	6	27	SAN FRANCISCO	SAN FRANCISCO
8	6	27	SAN MIGUEL	SAN MIGUEL
9	6	27	STA CRUZ CHUGAN	STA CRUZ CHUGAN
10	6	27	SAPZURRO	SAPZURRO
14	6	27	VILLA CLARET	VILLA CLARET
15	6	27	GOLETA	GOLETA
2	823	25	EL NARANJAL	EL NARANJAL
2	839	25	LAGUNA AZUL	LAGUNA AZUL
3	839	25	MAMBITA	MAMBITA
4	839	25	SAN PEDRO JAGUA	SAN PEDRO JAGUA
5	839	25	SANTANDER ROSA	SANTANDER ROSA
6	839	25	LA PLAYA MUNDO NUEVO	LA PLAYA MUNDO NUEVO
1	841	25	SANTANDER ANA	SANTANDER ANA
2	841	25	SAN ROQUE	SAN ROQUE
3	841	25	SABANILLA	SABANILLA
4	841	25	PUEBLO VIEJO	PUEBLO VIEJO
1	843	25	GUATACUY	GUATACUY
4	843	25	VOLCAN N 2	VOLCAN N 2
5	843	25	VOLCAN N 1	VOLCAN N 1
6	843	25	VOLCAN N 3	VOLCAN N 3
7	843	25	SUCUNCHOQUE	SUCUNCHOQUE
8	843	25	LA PATERA	LA PATERA
1	845	25	EL RAMAL	EL RAMAL
4	433	17	LAS MARGARITAS	LAS MARGARITAS
6	433	17	SAN VICENTE	SAN VICENTE
8	450	19	CAJAMARCA	CAJAMARCA
9	450	19	CURACAS	CURACAS
10	450	19	LOS ARBOLES	LOS ARBOLES
11	450	19	LA DESPENSA	LA DESPENSA
12	450	19	LA PLAYA	LA PLAYA
13	450	19	SOMBRERILLOS	SOMBRERILLOS
15	450	19	TABLONCITO	TABLONCITO
17	450	19	CASA FRIA	CASA FRIA
18	450	19	MOJARRAS	MOJARRAS
20	450	19	LOS MEDIOS	LOS MEDIOS
1	455	19	CARAQUENO	CARAQUENO
2	455	19	EL CANON	EL CA?ON
5	455	19	ORTIGAL	ORTIGAL
6	455	19	POTRERITO	POTRERITO
7	455	19	SANTANA	SANTANA
9	455	19	TULIPAN	TULIPAN
10	455	19	GUATEMALA	GUATEMALA
2	473	19	CARPINTERO	CARPINTERO
4	473	19	HONDURAS	HONDURAS
5	473	19	LOS CAFES	LOS CAFES
7	473	19	MATARREDONDO	MATARREDONDO
9	473	19	SAN ISIDRO	SAN ISIDRO
10	473	19	SAN RAFAEL	SAN RAFAEL
12	473	19	SANTA ROSA	SANTA ROSA
14	473	19	LA ESTACION	LA ESTACION
1	513	19	EL CHAMIZO	EL CHAMIZO
3	513	19	LA PAILA	LA PAILA
4	513	19	YARUMALES	YARUMALES
6	513	19	CALLE TIBIA	CALLE TIBIA
8	513	19	CUERNAVACA	CUERNAVACA
10	513	19	LAS COSECHAS	LAS COSECHAS
2	517	19	AVIRAMA	AVIRAMA
4	517	19	CHINAS	CHINAS
4	392	19	LOS ROBLES	LOS ROBLES
2	397	19	ARBELA	ARBELA
4	397	19	EL PALMAR	EL PALMAR
6	397	19	LOS UVOS	LOS UVOS
7	397	19	PANCITARA	PANCITARA
9	397	19	SAN MIGUEL	SAN MIGUEL
11	397	19	SANTA JUANA	SANTA JUANA
12	397	19	ALBANIA	ALBANIA
14	397	19	DOMINICAL	DOMINICAL
16	397	19	LOS CIRUELOS	LOS CIRUELOS
1	418	19	AGUA CLARA	AGUA CLARA
2	418	19	ALTO CHUARE	ALTO CHUARE
4	418	19	EL TRAPICHE	EL TRAPICHE
6	418	19	JOLI	JOLI
8	418	19	LA SAGRADA FAMILIA	LA SAGRADA FAMILIA
9	418	19	NOANAMITO	NOANAMITO
11	418	19	RIO NAYA	RIO NAYA
13	418	19	SAN BARTOLO	SAN BARTOLO
14	418	19	SAN FERNANDO	SAN FERNANDO
16	418	19	SAN PEDRO DE NAYA	SAN PEDRO DE NAYA
18	418	19	TAPARAL	TAPARAL
20	418	19	CANDELARIA	CANDELARIA
22	418	19	EL COCO	EL COCO
24	418	19	BETANIA	BETANIA
25	418	19	CACAO	CACAO
26	418	19	CALLE LARGA-NAYA	CALLE LARGA-NAYA
27	418	19	CHIGUERO	CHIGUERO
29	418	19	ELTRUENO	ELTRUENO
31	418	19	LAS PAVAS	LAS PAVAS
33	418	19	BOCA GRANDE	BOCA GRANDE
34	418	19	BRAZO DE LA ROTULA	BRAZO DE LA ROTULA
2	450	19	ARBOLEDAS	ARBOLEDAS
3	450	19	EL PILON	EL PILON
47	256	19	LAS PIEDRAS	LAS PIEDRAS
49	256	19	LOS LLANOS	LOS LLANOS
50	256	19	RIO SUCIO	RIO SUCIO
52	256	19	PEPITAL	PEPITAL
54	256	19	LA VENTANA	LA VENTANA
1	318	19	ALFONSO LOPEZ	ALFONSO LOPEZ
3	318	19	CALLE LARGA	CALLE LARGA
4	318	19	CONCEPCION	CONCEPCION
6	318	19	ISLAS GORGONA	ISLAS GORGONA
8	318	19	LIMONES	LIMONES
9	318	19	NAPI	NAPI
11	318	19	ROSARIO	ROSARIO
12	318	19	SAN AGUSTIN	SAN AGUSTIN
14	318	19	SAN FRANCISCO	SAN FRANCISCO
16	318	19	BOCA DE NAPI	BOCA DE NAPI
17	318	19	EL ATAJO	EL ATAJO
19	318	19	SANTA CLARA	SANTA CLARA
21	318	19	CHAMON	CHAMON
23	318	19	LAS JUNTA	LAS JUNTA
24	318	19	QUIROGA	QUIROGA
2	355	19	PEDREGAL	PEDREGAL
4	355	19	SAN ANDRES	SAN ANDRES
5	355	19	SAN JOSE	SAN JOSE
7	355	19	TOPA	TOPA
8	355	19	TUMBICHUCUE	TUMBICHUCUE
10	355	19	SANTA TERESA	SANTA TERESA
13	355	19	LOS ALPES	LOS ALPES
14	355	19	SAN MIGUEL	SAN MIGUEL
15	355	19	SEGOVIA	SEGOVIA
1	364	19	LA MARIA	LA MARIA
4	364	19	VALLES HONDOS	VALLES HONDOS
1	392	19	LA DEPRESION	LA DEPRESION
3	392	19	JUANA CASTANA	JUANA CASTANA
7	170	66	POTREROS AGUAZUL	POTREROS AGUAZUL
3	318	66	SANTA ANA	SANTA ANA
5	318	66	EL PARAISO	EL PARAISO
8	318	66	GUATICA VIEJO	GUATICA VIEJO
12	318	66	TARQUI	TARQUI
14	318	66	VILLANUEVA	VILLANUEVA
2	383	66	EL SILENCIO	EL SILENCIO
5	383	66	LA POLONIA	LA POLONIA
1	302	63	EL DORADO	EL DORADO
1	470	63	EL CUZCO	EL CUZCO
3	470	63	PUEBLO TAPADO	PUEBLO TAPADO
1	548	63	BARRAGAN	BARRAGAN
3	548	63	MAIZENA ALTA	MAIZENA ALTA
3	594	63	LA ESPANOLA	LA ESPA?OLA
5	594	63	PUEBLO RICO	PUEBLO RICO
2	690	63	CANAAN	CANAAN
4	690	63	COCORA	COCORA
2	1	66	ARABIA	ARABIA
4	1	66	CAIMALITO	CAIMALITO
7	1	66	EL ROCIO	EL ROCIO
8	1	66	FONDA CENTRAL	FONDA CENTRAL
12	1	66	LA PALMILLA	LA PALMILLA
14	1	66	MONTELARGO	MONTELARGO
17	1	66	NARANJITO	NARANJITO
18	1	66	PUERTO CALDAS	PUERTO CALDAS
22	1	66	EL RETIRO	EL RETIRO
24	1	66	LLANO GRANDE	LLANO GRANDE
26	1	66	SAN VICENTE	SAN VICENTE
29	1	66	LA BANANERA	LA BANANERA
31	1	66	ALEGRIAS(GUAYAB	ALEGRIAS(GUAYAB
34	1	66	FILO BONITO	FILO BONITO
4	820	54	GIBRALTAR	GIBRALTAR
6	820	54	SAN ALBERTO	SAN ALBERTO
9	820	54	MARGUA	MARGUA
11	820	54	LA MESA	LA MESA
13	820	54	ALTO DEL ORO	ALTO DEL ORO
2	871	54	CORAZONES	CORAZONES
1	874	54	JUAN FRIO	JUAN FRIO
7	874	54	LOS VADOS	LOS VADOS
9	874	54	PIZARREAL	PIZARREAL
1	1	63	EL CAIMO	EL CAIMO
3	1	63	NIAGARA	NIAGARA
5	1	63	PUERTO ESPEJO	PUERTO ESPEJO
1	130	63	BARCELONA	BARCELONA
4	130	63	LA VIRGINIA	LA VIRGINIA
7	130	63	ALTO DEL RIO	ALTO DEL RIO
12	130	63	PUERTO RICO	PUERTO RICO
3	190	63	PIAMONTE	PIAMONTE
6	190	63	VILLARAZO	VILLARAZO
8	190	63	LA FRONTERA	LA FRONTERA
10	190	63	HOJAS ANCHAS	HOJAS ANCHAS
1	212	63	LAS FRONTERAS	LAS FRONTERAS
17	720	54	JORDANCITO	JORDANCITO
20	720	54	LA PRIMAVERA	LA PRIMAVERA
22	720	54	LOS GUAMOS	LOS GUAMOS
25	720	54	SAN ISIDRO	SAN ISIDRO
2	295	25	SANTANDER BARBARA	SANTANDER BARBARA
5	295	25	EL ROBLE	EL ROBLE
4	297	25	EL ZAQUE	EL ZAQUE
6	297	25	TASAJERAS	TASAJERAS
1	307	25	SAN LORENZO	SAN LORENZO
3	307	25	GUABINAL	GUABINAL
1	317	25	FRONTERA	FRONTERA
3	317	25	PUEBLO VIEJO	PUEBLO VIEJO
11	148	25	CACERES	CACERES
2	151	25	GIRON DEL RESGUARDO	GIRON DEL RESGUARDO
4	154	25	HATICO Y ENEAS	HATICO Y ENEAS
7	154	25	NAZARETH	NAZARETH
2	168	25	LOMA LARGA	LOMA LARGA
1	178	25	CALDERA	CALDERA
4	178	25	ALTO DE RAMO	ALTO DE RAMO
7	178	25	CEREZOS CHIQUITO	CEREZOS CHIQUITO
1	181	25	ALTO DEL PALO	ALTO DEL PALO
3	181	25	POTRERO GRANDE	POTRERO GRANDE
3	200	25	CARDONAL	CARDO?AL
1	214	25	PARCELAS	PARCELAS
3	214	25	ROZO	ROZO
5	214	25	EL HABRA	EL HABRA
1	245	25	EL TRIUNFO	EL TRIUNFO
1	258	25	GUAYABAL	GUAYABAL
1	269	25	SAN RAFAEL	SAN RAFAEL
3	269	25	CARTAGENITA	CARTAGENITA
10	855	23	SANTANDER MARIA	SANTANDER MARIA
13	855	23	JARAGUAY	JARAGUAY
15	855	23	SANTO DOMINGO	SANTO DOMINGO
18	855	23	COCUELO ARRIBA	COCUELO ARRIBA
1	1	25	MANUEL SUR	MANUEL SUR
1	19	25	CHIMBE(DANUBIO)	CHIMBE(DANUBIO)
2	35	25	SAN ANTONIO	SAN ANTONIO
4	40	25	CANAZEJAS	CANAZEJAS
2	53	25	SAN JOSE	SAN JOSE
2	86	25	LA POPA	LA POPA
3	86	25	PUERTO DE GRAMALOTA	PUERTO DE GRAMALOTA
1	120	25	APOSENTOS	APOSENTOS
3	120	25	SUMAPAZ L PLAYA	SUMAPAZ L PLAYA
4	442	17	LA MIEL	LA MIEL
2	745	25	EL SALITRE	EL SALITRE
2	754	25	GRANADA EL SOCHE	GRANADA EL SOCHE
5	754	25	SAN RAIMUNDO	SAN RAIMUNDO
6	754	25	TINZUQUE	TINZUQUE
9	754	25	SANTANDERNA	SANTANDERNA
1	758	25	LA VIOLETA	LA VIOLETA
3	758	25	SAN GABRIEL	SAN GABRIEL
4	758	25	EL NEUSA	EL NEUSA
6	758	25	BRICENO	BRICENO
1	772	25	HATO GRANDE	HATO GRANDE
3	772	25	SAN VICENTE	SAN VICENTE
2	781	25	LAS PENAS	LAS PE?AS
2	793	25	ROMA(TAUSA VIEJO)	ROMA(TAUSA VIEJO)
1	799	25	LA PUNTA	LA PUNTA
2	799	25	MARTIN ESPINO	MARTIN ESPINO
2	805	25	CUMACA	CUMACA
4	805	25	SAN VICENTE	SAN VICENTE
1	807	25	PUERTO LOPEZ	PUERTO LOPEZ
3	815	25	LA SALADA	LA SALADA
4	815	25	MALBERTO	MALBERTO
5	815	25	PALACIOS	PALACIOS
6	815	25	TETE	TETE
1	817	25	VENGANZA	VENGANZA
1	580	25	VALPARAISO	VALPARAISO
1	592	25	LA MAGDALENA	LA MAGDALENA
2	592	25	SAN CARLOS	SAN CARLOS
1	596	25	LA SIERRA	LA SIERRA
2	596	25	LA VIRGEN	LA VIRGEN
4	596	25	LA BOTICA	LA BOTICA
1	599	25	SAN ANTONIO	SAN ANTONIO
1	645	25	SANTANDERNDERCITO	SANTANDERNDERCITO
4	645	25	LA MARIA	LA MARIA
8	645	25	PIEDRA AZUL	PIEDRA AZUL
10	645	25	LA RAMBLA	LA RAMBLA
11	645	25	PUEBLO NUEVO	PUEBLO NUEVO
12	645	25	EL CAJON	EL CAJON
14	645	25	CUSIO	CUSIO
16	645	25	BELLAVISTA	BELLAVISTA
2	649	25	SANTANDER RITA	SANTANDER RITA
4	649	25	LAUREL BAJO	LAUREL BAJO
2	653	25	CUIBUCO	CUIBUCO
4	653	25	PINIPAY	PINIPAY
1	658	25	LA MAGOLA	LA MAGOLA
2	662	25	SAN NICOLAS	SAN NICOLAS
1	736	25	EL HATO LA CAPILLA	EL HATO LA CAPILLA
2	740	25	EL PENON	EL PENON
4	740	25	SAN BENITO II	SAN BENITO II
5	740	25	CHACUA	CHACUA
2	743	25	AZACRANAL	AZACRANAL
4	436	25	PENAS	PE?AS
5	436	25	SAN CARLOS	SAN CARLOS
4	438	25	SANTANDER TERESITA	SANTANDER TERESITA
5	438	25	MESA D L REYES	MESA D L REYES
7	438	25	GAZATAVENA	GAZATAVENA
9	438	25	EL ARENAL	EL ARENAL
10	438	25	LA ESMERALDA	LA ESMERALDA
2	473	25	SIETE TROJES	SIETE TROJES
3	473	25	SERREZUELITA	SERREZUELITA
1	486	25	PATIO BONITO	PATIO BONITO
2	486	25	ORATORIO	ORATORIO
1	488	25	LA ESMERALDA	LA ESMERALDA
1	489	25	TOBIA	TOBIA
2	489	25	EL CERRO	EL CERRO
2	506	25	AGUA DULCE	AGUA DULCE
4	506	25	QUEBRADA GRANDE	QUEBRADA GRANDE
1	513	25	PASUNCHA	PASUNCHA
2	518	25	TUDELA	TUDELA
1	530	25	MAYA	MAYA
2	530	25	SANTANDER CECILIA	SANTANDER CECILIA
4	530	25	VILLA PACHELLY	VILLA PACHELLY
1	535	25	ALTO DEL MOLINO	ALTO DEL MOLINO
1	572	25	COLORADOS	COLORADOS
3	572	25	PUERTO LIBRE	PUERTO LIBRE
4	572	25	EL GUAYABO	EL GUAYABO
5	317	25	GACHA	GACHA
6	317	25	MONROY	MONROY
2	320	25	LA PAZ	LA PAZ
4	320	25	TOTUMAL	TOTUMAL
5	320	25	CUATRO ESQUINAS	CUATRO ESQUINAS
7	320	25	EL ESCRITORIO	EL ESCRITORIO
1	324	25	EL PORVENIR	EL PORVENIR
1	328	25	ALTO DEL TRIGO	ALTO DEL TRIGO
1	339	25	SAN ISIDRO	SAN ISIDRO
2	372	25	CHUSCALES	CHUSCALES
2	377	25	MUNDONUEVO	MUNDONUEVO
3	377	25	EL SALITRE	EL SALITRE
5	377	25	LA CALLEJA	LA CALLEJA
8	377	25	TREINTA Y SEIS	TREINTA Y SEIS
2	386	25	SAN JAVIER	SAN JAVIER
1	394	25	MURCA	MURCA
2	394	25	EL HATO	EL HATO
1	402	25	SAN JUAN	SAN JUAN
29	807	23	CRUSITO	CRUSITO
1	855	23	RIO NUEVO	RIO NUEVO
2	855	23	VIJAGUAL	VIJAGUAL
3	855	23	VILLANUEVA	VILLANUEVA
4	855	23	LOMA LARGA	LOMA LARGA
5	855	23	TINAJON	TINAJON
7	855	23	LAS PALMAS	LAS PALMAS
36	660	23	EL ORGULLO	EL ORGULLO
1	670	23	BARBACOAS	BARBACOAS
3	670	23	EL BANCO	EL BANCO
4	670	23	FLECHAS	FLECHAS
6	670	23	LOS VIDALES	LOS VIDALES
7	670	23	MOLINA	MOLINA
9	670	23	PUEBLECITO	PUEBLECITO
11	670	23	TUCHIN	TUCHIN
13	670	23	PLAZA BONITA	PLAZA BONITA
14	670	23	LAS CASITAS	LAS CASITAS
16	670	23	LOS GUAYACANES	LOS GUAYACANES
17	670	23	SABANAL	SABANAL
19	670	23	CARRETAL	CARRETAL
21	670	23	EL CONTENTO	EL CONTENTO
23	670	23	JEJEN	JEJEN
24	670	23	ALEMANIA	ALEMANIA
26	670	23	EL HOYAL	EL HOYAL
27	670	23	EL ALGODONCILLO	EL ALGODONCILLO
2	672	23	LOS SECOS	LOS SECOS
4	672	23	SANTA ROSA DE B	SANTA ROSA DE B
5	672	23	TIJERETAS	TIJERETAS
1	675	23	JOSE MANUEL	JOSE MANUEL
4	675	23	CANO GRANDE	CANO GRANDE
5	675	23	PLAYA DL.VIENTO	PLAYA DL.VIENTO
7	675	23	TREMENTINO	TREMENTINO
9	675	23	SAN BLAS	SAN BLAS
11	675	23	SICARA	SICARA
12	675	23	CHIQUI	CHIQUI
13	675	23	PAJONAL	PAJONAL
14	675	23	LAS CANAS	LAS CA?AS
1	678	23	CAMPANITO	CAMPANITO
2	678	23	CARRIZAL	CARRIZAL
3	678	23	GUACHARACAL	GUACHARACAL
4	678	23	SANTA ROSA	SANTA ROSA
5	678	23	REMEDIO POBRE	REMEDIO POBRE
6	678	23	CABUYA	CABUYA
7	678	23	CALLE DE AGUA	CALLE DE AGUA
8	678	23	CALLE MAR	CALLE MAR
9	678	23	CINAGUITA	CINAGUITA
10	678	23	EL HATO	EL HATO
11	678	23	SAN MIGUEL	SAN MIGUEL
1	686	23	BUENOS AIRES	BUENOS AIRES
2	686	23	CARRILLO	CARRILLO
3	686	23	LA MADERA	LA MADERA
4	686	23	LAS GUAMAS	LAS GUAMAS
4	1	17	LA CABANA	LA CABA?A
5	1	17	LA CUCHILLA	LA CUCHILLA
6	1	17	LA ENEA	LA ENEA
7	1	17	LA VIOLETA	LA VIOLETA
8	1	17	LAS PAVAS	LAS PAVAS
9	1	17	SAN PEREGRINO	SAN PEREGRINO
10	1	17	ALTO DE TABLAZO	ALTO DE TABLAZO
11	1	17	ALTO DE NARANJO	ALTO DE NARANJO
12	1	17	EL ARENILLO	EL ARENILLO
13	1	17	LA UNION	LA UNION
14	1	17	LA CHINA	LA CHINA
15	1	17	LA AURORA	LA AURORA
22	1	17	ALTO BONITO	ALTO BONITO
23	1	17	MINA RICA	MINA RICA
24	1	17	LA GARRUCHA	LA GARRUCHA
1	13	17	ARMA	ARMA
2	13	17	ENCIMADAS	ENCIMADAS
3	13	17	RIO ARRIBA	RIO ARRIBA
4	13	17	LA MERMITA	LA MERMITA
5	13	17	GUAIMARAL	GUAIMARAL
6	13	17	ESTACION LA MARIA	ESTACION LA MARIA
9	13	17	GUACO	GUACO
10	13	17	EDEN	EDEN
11	13	17	SAN NICOLAS	SAN NICOLAS
12	13	17	ALTO DE PITO	ALTO DE PITO
13	13	17	LAS CHARCAS	LAS CHARCAS
14	13	17	ALTO DE LA MONTANA	ALTO DE LA MONTA?A
15	13	17	BOCAS	BOCAS
1	42	17	ALEJANDRIA	ALEJANDRIA
2	42	17	BELLAVISTA	BELLAVISTA
3	42	17	LA RICA	LA RICA
4	42	17	MARAPRA	MARAPRA
5	42	17	NUBIA	NUBIA
6	42	17	PALO BLANCO	PALO BLANCO
7	42	17	SAN PEDRO	SAN PEDRO
8	42	17	CONCHARI	CONCHARI
9	42	17	LA FLORESTA	LA FLORESTA
11	42	17	TABLA ROJA	TABLA ROJA
12	42	17	ALSACIA	ALSACIA
21	42	17	MIRAVALLE	MIRAVALLE
22	42	17	LAPERLA	LAPERLA
1	50	17	ALEGRIAS	ALEGRIAS
2	50	17	VARSOVIA	VARSOVIA
3	50	17	BUENOS AIRES	BUENOS AIRES
4	50	17	LA HONDITA	LA HONDITA
6	50	17	SAN RAFAEL	SAN RAFAEL
8	50	17	LA MARINA	LA MARINA
9	50	17	EL ROBLAL	EL ROBLAL
4	720	68	PLAN DE ALVAREZ	PLAN DE ALVAREZ
1	745	68	AGUA BLANCA	AGUA BLANCA
4	745	68	GUAYABAL	GUAYABAL
6	745	68	LA LLANITA	LA LLANITA
8	745	68	VIZCAINA BAJA	VIZCAINA BAJA
9	745	68	LA ROCHELA	LA ROCHELA
2	755	68	BERLIN	BERLIN
3	755	68	NARANJAL	NARANJAL
8	233	52	SANTA ROSA LA PALMA	SANTA ROSA LA PALMA
9	233	52	EL PESQUERIO	EL PESQUERIO
1	250	52	ARENAL	ARENAL
2	250	52	BOLIVAR	BOLIVAR
3	250	52	GAITAN	GAITAN
4	250	52	LAS MERCEDES	LAS MERCEDES
5	250	52	ROBERTO PAYAN	ROBERTO PAYAN
6	250	52	SAN JOSE DEL TAPAJE	SAN JOSE DEL TAPAJE
7	250	52	TURBAY	TURBAY
8	250	52	BAHIA MULATAS	BAHIA MULATAS
9	250	52	BEJAMIN HERRERA	BEJAMIN HERRERA
10	250	52	RIO TAPAJE	RIO TAPAJE
11	250	52	PLINIO OLIVEROS	PLINIO OLIVEROS
12	250	52	URIBE URIBE	URIBE URIBE
13	250	52	HORMIGUERO	HORMIGUERO
14	250	52	PULBUSA	PULBUSA
15	250	52	SAN FRANCISCO DE TAIGA	SAN FRANCISCO DE TAIGA
16	250	52	SECADERO SEQUITO	SECADERO SEQUITO
2	256	52	LA MONTANA	LA MONTA?A
3	256	52	ESMERALDA	ESMERALDA
4	256	52	LA SIERRA	LA SIERRA
5	256	52	SAN PABLO	SAN PABLO
6	256	52	CANADUZAL	CA?ADUZAL
7	256	52	VAPOR	VAPOR
8	256	52	EL VADO	EL VADO
9	256	52	RESTREPO	RESTREPO
11	256	52	SANTA ROSA	SANTA ROSA
12	256	52	MARTIN PEREZ	MARTIN PEREZ
13	256	52	PUERTO NUEVO	PUERTO NUEVO
14	256	52	SANTA ISABEL	SANTA ISABEL
15	256	52	ALTAMIRA	ALTAMIRA
16	256	52	MADRIGAL	MADRIGAL
17	256	52	POLICARPA	POLICARPA
18	256	52	SAN ROQUE	SAN ROQUE
19	256	52	SANCHEZ	SANCHEZ
20	256	52	SAN JOSE DE LA MONTANA	SAN JOSE DE LA MONTA?A
21	256	52	LA FLORIDA	LA FLORIDA
22	256	52	PIEDRA GRANDE	PIEDRA GRANDE
23	256	52	SAN RAFAEL	SAN RAFAEL
1	258	52	APONTE	APONTE
2	258	52	LA CUEVA	LA CUEVA
3	258	52	LAS MESAS	LAS MESAS
4	258	52	POMPEYA	POMPEYA
13	837	5	SAN JOSE DE MULA	SAN JOSE DE MULA
15	837	5	BOBAL	BOBAL
17	837	5	CASABLANCA	CASABLANCA
1	842	5	FUEMIA	FUEMIA
2	842	5	AMBALEMA	AMBALEMA
2	847	5	BUCHADO	BUCHADO
3	847	5	LA ENCARNACION	LA ENCARNACION
8	847	5	HONDA ABAJO	HONDA ABAJO
9	847	5	HONDA ARRIBA	HONDA ARRIBA
11	847	5	JAIPERA	JAIPERA
13	847	5	NENDO	NENDO
15	847	5	LA LOMA	LA LOMA
16	847	5	LA VENTA	LA VENTA
17	847	5	SAN JOSE	SAN JOSE
1	854	5	CANDEBA	CANDEBA
23	660	23	BRUSELAS	BRUSELAS
25	660	23	EL REMOLINO	EL REMOLINO
26	660	23	LAS CRUCES	LAS CRUCES
28	660	23	GUAIMARITO	GUAIMARITO
30	660	23	GUAIMARO	GUAIMARO
31	660	23	LA BALSA	LA BALSA
33	660	23	BAJO DEL LIMON	BAJO DEL LIMON
5	500	23	BELLA COITA	BELLA COITA
6	500	23	BROQUELES	BROQUELES
9	500	23	EL REY	EL REY
10	500	23	LA RADA	LA RADA
12	500	23	LAS TINAS	LAS TINAS
13	500	23	MANGLE	MANGLE
14	500	23	MEMBRILLAL	MEMBRILLAL
15	500	23	MURCIELAGAL	MURCIELAGAL
16	500	23	NARANJAL	NARANJAL
17	500	23	NICARAGUA	NICARAGUA
18	500	23	NORUEGA	NORUEGA
19	500	23	NO TE CEBES	NO TE CEBES
20	500	23	NUEVA ESTRELLA	NUEVA ESTRELLA
21	500	23	NUEVO ORIENTE	NUEVO ORIENTE
22	500	23	PATIO BONITO	PATIO BONITO
23	500	23	PERPETUO SOCORRO	PERPETUO SOCORRO
24	500	23	PUEBLITO	PUEBLITO
25	500	23	SAN PATRICIO	SAN PATRICIO
26	500	23	SAN RAFAEL	SAN RAFAEL
27	500	23	TRES BOCAS	TRES BOCAS
28	500	23	VILLA CARMEN	VILLA CARMEN
1	555	23	ARENOSO	ARENOSO
2	555	23	CAMPOBELLO	CAMPOBELLO
3	555	23	CAROLINA	CAROLINA
4	555	23	CENTRO ALEGRE	CENTRO ALEGRE
5	555	23	EL ALMENDRO	EL ALMENDRO
6	555	23	MARANONAL	MARA?ONAL
7	555	23	PLAZA BONITA	PLAZA BONITA
8	555	23	PROVIDENCIA	PROVIDENCIA
10	555	23	MEDIO RANCHO	MEDIO RANCHO
11	555	23	PAMPLONA	PAMPLONA
12	555	23	EL REPARO	EL REPARO
13	555	23	LOS CERROS	LOS CERROS
14	555	23	LOS PASTELES	LOS PASTELES
15	555	23	LAS PELONAS	LAS PELONAS
17	555	23	PUEBLO RIZO	PUEBLO RIZO
1	570	23	ARENA DEL SUR	ARENA DEL SUR
2	570	23	CINTURA	CINTURA
3	570	23	CORCOVADO	CORCOVADO
4	570	23	EL VARAL	EL VARAL
5	570	23	EL POBLADO	EL POBLADO
6	570	23	LA GRANJITA	LA GRANJITA
7	570	23	LOS LIMONES	LOS LIMONES
8	570	23	PUERTO SANTO	PUERTO SANTO
9	570	23	LA MAGDALENA	LA MAGDALENA
10	570	23	AGUAS CLARAS	AGUAS CLARAS
11	570	23	PALMIRA	PALMIRA
12	570	23	ARROYO GUADUAL	ARROYO GUADUAL
13	570	23	NEIVA	NEIVA
14	570	23	ARROYO DE ARENA	ARROYO DE ARENA
15	570	23	TAPA DE FRASCO	TAPA DE FRASCO
16	570	23	EL CONTENTO	EL CONTENTO
17	570	23	PRIMAVERA	PRIMAVERA
11	417	23	SAN ANTERITO	SAN ANTERITO
12	417	23	EL LAZO	EL LAZO
13	417	23	LAS MUJERES	LAS MUJERES
14	417	23	CAMPO ALEGRE	CAMPO ALEGRE
15	417	23	MARACAYO	MARACAYO
16	417	23	VILLAVICENCIO	VILLAVICENCIO
17	417	23	CAMPANA DE LOS INDIOS	CAMPANA DE LOS INDIOS
18	417	23	COTOCA ARRIBA	COTOCA ARRIBA
19	417	23	EL RODEO	EL RODEO
20	417	23	LOS HIGALES	LOS HIGALES
21	417	23	REMOLINO	REMOLINO
22	417	23	TRAGEDIA	TRAGEDIA
23	417	23	MATA DE CANA	MATA DE CANA
24	417	23	CASTILLERAL	CASTILLERAL
25	417	23	COTOCA ABAJO	COTOCA ABAJO
26	417	23	LAS CAMORRAS	LAS CAMORRAS
27	417	23	SAN NICOLAS DE	SAN NICOLAS DE
28	417	23	MANANTIAL ARRIBA	MANANTIAL ARRIBA
2	419	23	EL EBANO	EL EBANO
4	419	23	PUERTO REY	PUERTO REY
5	419	23	SANTA ROSA LA CANA	SANTA ROSA LA CA?A
9	419	23	SAN RAFAEL	SAN RAFAEL
10	419	23	BUENAVISTA	BUENAVISTA
12	419	23	MORINDO SANTANA	MORINDO SANTANA
2	464	23	SACANA	SACANA
4	464	23	SENO DE PIEDRA	SENO DE PIEDRA
6	464	23	GUAYMARAL	GUAYMARAL
1	466	23	EL ANCLAR	EL ANCLAR
6	466	23	TIERRADENTRO	TIERRADENTRO
7	466	23	URE	URE
10	466	23	EL BRILLANTE	EL BRILLANTE
12	466	23	EL SOL	EL SOL
13	466	23	BOCAS DE PERRO	BOCAS DE PERRO
15	466	23	CAMPAMENTO	CAMPAMENTO
6	668	41	EL PALMAR	EL PALMAR
8	668	41	LOS CAUCHOS	LOS CAUCHOS
1	676	41	SAN JOAQUIN	SAN JOAQUIN
1	770	41	GALLARDO	GALLARDO
2	770	41	GUAYABAL	GUAYABAL
4	770	41	HATO VIEJO	HATO VIEJO
5	770	41	MANTAGUA	MANTAGUA
7	770	41	EL SALADO	EL SALADO
10	770	41	SAFIA	SAFIA
2	791	41	MAITO	MAITO
3	791	41	QUITURO	QUITURO
4	791	41	CEDRO	CEDRO
6	791	41	EL TABLON	EL TABLON
8	791	41	CAIMITAL	CAIMITAL
9	791	41	RICA BRISA	RICA BRISA
11	791	41	LA EUREKA	LA EUREKA
13	791	41	LAGUNILLAS	LAGUNILLAS
1	797	41	PACARNI	PACARNI
2	799	41	SIERRA DE GRAMAL	SIERRA DE GRAMAL
6	298	41	SARTENJO	SARTENJO
8	298	41	EL MESON	EL MESON
10	298	41	EL DESCADO	EL DESCADO
1	306	41	LA CHIQUITA	LA CHIQUITA
3	306	41	POTRERILLOS	POTRERILLOS
4	306	41	RIOLORO	RIOLORO
6	306	41	EL MESON	EL MESON
8	306	41	SAN JUANITO	SAN JUANITO
10	306	41	SILVANIA	SILVANIA
1	319	41	RESINA	RESINA
2	319	41	MIRAFLORES	MIRAFLORES
4	319	41	POTRERILLOS	POTRERILLOS
2	357	41	CHAPARRO	CHAPARRO
1	359	41	IDOLOS	IDOLOS
2	359	41	CIENAGA CHIQUITA	CIENAGA CHIQUITA
4	359	41	SAN VICENTE	SAN VICENTE
1	378	41	BUENOS AIRES	BUENOS AIRES
2	378	41	EL PENSIL	EL PENSIL
2	396	41	MONSERRATE	MONSERRATE
4	396	41	SAN ANDRES	SAN ANDRES
6	396	41	SAN VICENTE	SAN VICENTE
8	396	41	SAN RAFAEL	SAN RAFAEL
9	396	41	GALLEGO	GALLEGO
1	503	41	SAN ROQUE	SAN ROQUE
1	851	25	CAICEDONIA	CAICEDONIA
1	862	25	PINZAIMA	PINZAIMA
2	862	25	GUACAMAYAS	GUACAMAYAS
3	862	25	LLANO GRANDE	LLANO GRANDE
4	862	25	VILLA OLARTE-FL	VILLA OLARTE-FL
5	862	25	CERINZA	CERINZA
1	871	25	CERRO AZUL	CERRO AZUL
1	875	25	BAGAZAL	BAGAZAL
2	875	25	CHAPAIMA	CHAPAIMA
3	875	25	ILO GRANDE	ILO GRANDE
1	878	25	BRASIL	BRASIL
2	878	25	SAN GABRIEL	SAN GABRIEL
3	878	25	EL PINAL	EL PI?AL
1	885	25	ALSACIA	ALSACIA
2	885	25	GUADUALITO	GUADUALITO
3	885	25	GUAYABALES	GUAYABALES
4	885	25	IBAMA	IBAMA
5	885	25	LAS PALMAS	LAS PALMAS
6	885	25	LLANO MATEO	LLANO MATEO
7	885	25	PUEBLO NUEVO	PUEBLO NUEVO
8	885	25	TERAN	TERAN
13	885	25	YASAL	YASAL
15	885	25	SAN LUIS	SAN LUIS
16	885	25	ALTO DE CANAS	ALTO DE CA?AS
18	885	25	PATEVACA	PATEVACA
1	898	25	EL OCASO	EL OCASO
3	898	25	RINCON SANTO	RINCON SANTO
1	899	25	LA GRANJA	LA GRANJA
3	899	25	SAN ANTONIO	SAN ANTONIO
4	899	25	EL TUNAL	EL TUNAL
5	874	54	LA PARADA	LA PARADA
8	874	54	PALOGORDO	PALOGORDO
10	874	54	LOMITAS	LOMITAS
11	874	54	SANTA ANA	SANTA ANA
2	1	63	MURILLO	MURILLO
4	1	63	PANTANILLO	PANTANILLO
1	111	63	RIO VERDE BAJO	RIO VERDE BAJO
2	130	63	LA ALBANIA	LA ALBANIA
3	130	63	LA BELLA	LA BELLA
5	130	63	QUEBRADANEGRA	QUEBRADANEGRA
8	130	63	LA PRADERA	LA PRADERA
10	130	63	LA MARIA	LA MARIA
1	190	63	LA POLA	LA POLA
2	190	63	LA SIRIA	LA SIRIA
4	190	63	SANTA RITA	SANTA RITA
7	190	63	LA JULIA	LA JULIA
9	190	63	BARCELONA BAJA	BARCELONA BAJA
11	190	63	LA CRISTALINA	LA CRISTALINA
1	272	63	EL PARAISO	EL PARAISO
2	272	63	LA INDIA	LA INDIA
18	720	54	LA ESMERALDA	LA ESMERALDA
19	720	54	LA LLANA	LA LLANA
21	720	54	LAS MESAS	LAS MESAS
23	720	54	PLANADAS	PLANADAS
24	720	54	SAN GIL	SAN GIL
26	720	54	SAN SEBASTIAN	SAN SEBASTIAN
27	720	54	LA CARTAGENA	LA CARTAGENA
1	743	54	BABEGA	BABEGA
2	743	54	BELEN	BELEN
3	743	54	LOS RINCON	LOS RINCON
1	800	54	ALTO ROSARIO	ALTO ROSARIO
2	800	54	CERRO LA FLORES	CERRO LA FLORES
3	800	54	CUATRO ESQUINAS	CUATRO ESQUINAS
4	800	54	EL GUARICO	EL GUARICO
5	800	54	EL OSO	EL OSO
6	800	54	EL TIGRE	EL TIGRE
7	800	54	EL TRIGO	EL TRIGO
8	800	54	FARACHE	FARACHE
9	800	54	GUARANAO	GUARANAO
10	800	54	EL JUNCAL	EL JUNCAL
11	800	54	LA CECILIA	LA CECILIA
12	800	54	LA JABONERA	LA JABONERA
13	800	54	LA TEJA	LA TEJA
14	800	54	LA TRINIDAD	LA TRINIDAD
15	800	54	MANZANARES	MANZANARES
16	800	54	MIRACOTES	MIRACOTES
17	800	54	PILOCOTO	PILOCOTO
18	800	54	RAMIREZ	RAMIREZ
19	800	54	RIO DE ORO	RIO DE ORO
20	800	54	SAN JOSE	SAN JOSE
21	800	54	SN JUAN DE DIOS	SN JUAN DE DIOS
22	800	54	SAN PABLO	SAN PABLO
23	800	54	TRAVESIAS	TRAVESIAS
24	800	54	VIJAGUAL	VIJAGUAL
1	810	54	BARCO LA SILLA	BARCO LA SILLA
2	810	54	LA GABARRA	LA GABARRA
3	810	54	PACHELLI	PACHELLI
4	810	54	REYES	REYES
5	810	54	RIO DE ORO	RIO DE ORO
6	810	54	TRES BOCAS	TRES BOCAS
7	810	54	EL SESENTA	EL SESENTA
8	810	54	PETROLEA	PETROLEA
9	810	54	VERSALLES	VERSALLES
10	810	54	AEROPUERTO LA PISTA	AEROPUERTO LA PISTA
11	810	54	CAMPO GILES	CAMPO GILES
12	810	54	CANO VICTORIA	CANO VICTORIA
13	810	54	LA LLANA	LA LLANA
14	810	54	PLAYA COTIZA	PLAYA COTIZA
15	810	54	SAN MIGUEL	SAN MIGUEL
16	810	54	VETAS DE ORIENTE	VETAS DE ORIENTE
4	269	25	DOS CAMINOS	DOS CAMINOS
5	269	25	BERLIN	BERLIN
6	269	25	LOS LLANITOS	LOS LLANITOS
1	279	25	LA UNION	LA UNION
2	279	25	CHINGAZA	CHINGAZA
2	281	25	SANAME	SANAME
3	281	25	EL JUCUAL	EL JUCUAL
1	286	25	EL CACIQUE	EL CACIQUE
2	286	25	EL HATO	EL HATO
3	286	25	SERREZUELITA	SERREZUELITA
1	288	25	CAPELLANIA	CAPELLANIA
2	288	25	CHINZAQUE	CHINZAQUE
1	290	25	LA AGUADITA	LA AGUADITA
2	290	25	GUAVIO ALTO	GUAVIO ALTO
3	290	25	TIERRA NEGRA	TIERRA NEGRA
4	290	25	PIAMONTE	PIAMONTE
5	290	25	EL PLACER	EL PLACER
6	290	25	EL ESPINALITO	EL ESPI?ALITO
7	290	25	LA ISLA	LA ISLA
8	290	25	JORDAN 111	JORDAN 111
9	290	25	JORDAN 1	JORDAN 1
10	290	25	LA VENTA	LA VENTA
11	290	25	CHINAUTA LOS PANCHES	CHINAUTA LOS PANCHES
12	290	25	EL TRIUNFO BOQUERON	EL TRIUNFO BOQUERON
13	290	25	LAS VIUDAS DEL SUR	LAS VIUDAS DEL SUR
1	293	25	LOS ALPES	LOS ALPES
2	293	25	MONTECRISTO	MONTECRISTO
2	614	17	EL ORO	EL ORO
3	614	17	EL SALADO	EL SALADO
4	614	17	FLORENCIA	FLORENCIA
5	614	17	QUIEBRALOMO	QUIEBRALOMO
6	614	17	SAN LORENZO	SAN LORENZO
7	614	17	SANTA MARIA	SANTA MARIA
8	614	17	IBERIA	IBERIA
9	614	17	LOS CHANCOS	LOS CHANCOS
10	614	17	SIPIRRA	SIPIRRA
11	614	17	JUAN DIAZ	JUAN DIAZ
12	614	17	LLANO GRANDE	LLANO GRANDE
14	614	17	SAN JERONIMO	SAN JERONIMO
17	614	17	PUEBLO VIEJO	PUEBLO VIEJO
20	614	17	PASMI	PASMI
1	616	17	ALTO ARAUCA	ALTO ARAUCA
2	616	17	CARBONERAL	CARBONERAL
3	616	17	LA LIBERTAD	LA LIBERTAD
4	616	17	LA QUIEBRA	LA QUIEBRA
141	835	52	TAMBILLO	TAMBILLO
143	835	52	TESTERIA	TESTERIA
17	90	23	PALO DE FRUTA	PALO DE FRUTA
20	90	23	TIERRA DENTRO	TIERRA DENTRO
2	162	23	MATEO GOMEZ	MATEO GOMEZ
5	162	23	CUERO CURTIDO	CUERO CURTIDO
7	162	23	EL TOMATE	EL TOMATE
9	162	23	SANTA CLARA	SANTA CLARA
11	162	23	CHUCHURUBI	CHUCHURUBI
14	162	23	ZARZALITO	ZARZALITO
16	162	23	MANGUELITO	MANGUELITO
19	162	23	RETIRO DE PAEZ	RETIRO DE PAEZ
22	162	23	EL VIDUAL	EL VIDUAL
2	168	23	CAMPO BELLO	CAMPO BELLO
5	168	23	PUNTA VERDE	PUNTA VERDE
8	168	23	SABANACOSTA	SABANACOSTA
2	182	23	CACAOTAL	CACAOTAL
4	182	23	EL PITAL	EL PITAL
7	182	23	NUEVO ORIENTE	NUEVO ORIENTE
2	787	20	LA BOCA	LA BOCA
7	787	20	ANTEQUERA	ANTEQUERA
10	787	20	SAN BERNARDO	SAN BERNARDO
2	1	23	CANO VIEJO D PALOTAL	CA?O VIEJO D PALOTAL
6	1	23	JARAQUIEL	JARAQUIEL
8	1	23	LAS PALOMAS	LAS PALOMAS
11	1	23	LOS GARZONES	LOS GARZONES
13	1	23	NUEVA LUCIA	NUEVA LUCIA
15	1	23	SN ISIDRO	SN ISIDRO
17	1	23	SAN ANTERITO	SAN ANTERITO
20	1	23	SANTA LUCIA	SANTA LUCIA
22	1	23	TRES PIEDRAS	TRES PIEDRAS
24	1	23	MOCARI	MOCARI
26	1	23	MOCHILA	MOCHILA
29	1	23	NUEVA ESPERANZA	NUEVA ESPERANZA
1	68	23	ALFONSO LOPEZ	ALFONSO LOPEZ
5	68	23	LA FRONTERA	LA FRONTERA
8	68	23	POPALES	POPALES
12	68	23	MARRALU	MARRALU
14	68	23	PUEBLO NUEVO	PUEBLO NUEVO
2	79	23	VILLA FATIMA	VILLA FATIMA
5	79	23	PUERTO CORDOBA	PUERTO CORDOBA
8	79	23	CIENAGA DE SAMBO	CIENAGA DE SAMBO
10	79	23	MEJOR ESQUINA	MEJOR ESQUINA
11	383	20	ESTACION FERROCARRIL	ESTACION FERROCARRIL
11	228	20	EL MAMEY LA SERENA	EL MAMEY LA SERENA
4	238	20	SAN FRANCISCO DE ASIS	SAN FRANCISCO DE ASIS
3	250	20	POTRERILLO	POTRERILLO
3	295	20	LAS GUADUAS	LAS GUADUAS
5	295	20	PUERTO MOSQUITO	PUERTO MOSQUITO
1	310	20	BUJARAVITA	BUJARAVITA
6	442	17	ECHANDIA	ECHANDIA
2	444	17	EL PLACER	EL PLACER
2	446	17	EL PARAMO	EL PARAMO
4	446	17	PARAMO HERVEO	PARAMO HERVEO
2	486	17	LLANO GRANDE	LLANO GRANDE
5	486	17	TAPIAS	TAPIAS
4	887	5	EL CEDRO	EL CEDRO
7	887	5	LLANOS DE CUIBA	LLANOS DE CUIBA
11	887	5	LA BRAMADORA	LA BRAMADORA
17	887	5	LAS NIEVES	LAS NIEVES
1	890	5	LA FLORESTA	LA FLORESTA
5	890	5	LA ARGENTINA	LA ARGENTINA
1	893	5	CIENAGA BARBACO	CIENAGA BARBACO
3	893	5	SAN MIGUEL TIGRE	SAN MIGUEL TIGRE
4	895	5	PATO	PATO
7	895	5	PUERTO COLOMBIA	PUERTO COLOMBIA
1	78	8	CAMPECHE	CAMPECHE
4	78	8	MEDIA TAPA	MEDIA TAPA
1	141	8	CARRETO	CARRETO
1	296	8	PALUATO	PALUATO
2	372	8	CHORRERA	CHORRERA
1	421	8	ARROYO DE PIEDRA	ARROYO DE PIEDRA
3	421	8	PENDALES	PENDALES
4	421	8	SAN JUAN TOCAGUAS	SAN JUAN TOCAGUAS
9	421	8	LAS TABLAS	LAS TABLAS
2	433	8	EL ESFUERZO	EL ESFUERZO
26	430	13	SANTA MONICA	SANTA MONICA
28	430	13	SITIONUEVO	SITIONUEVO
31	430	13	TACASALUMA	TACASALUMA
34	430	13	BARRANCA	BARRANCA
1	433	13	EVITAR	EVITAR
3	433	13	MALAGANA	MALAGANA
4	433	13	SAN BASILIO PALENQUE	SAN BASILIO PALENQUE
3	440	13	CAUSADO	CAUSADO
5	440	13	DONA JUANA	DO?A JUANA
7	440	13	MAMONCITO	MAMONCITO
10	440	13	LOS TRAPICHES	LOS TRAPICHES
2	442	13	EL NISPERO	EL NISPERO
5	442	13	NANGUMA	NANGUMA
7	442	13	SAN JOSE D PLAYA	SAN JOSE D PLAYA
10	442	13	EL PUERTO	EL PUERTO
12	442	13	MATUYA	MATUYA
15	442	13	EL FLORIDO	EL FLORIDO
17	442	13	ARROYO GRANDE	ARROYO GRANDE
19	442	13	NVA ESPERANZA	NVA ESPERANZA
1	468	13	CALDERA	CALDERA
3	468	13	EL CARMEN	EL CARMEN
8	468	13	GUAIMARAL	GUAIMARAL
11	468	13	LA LOBATA	LA LOBATA
8	140	13	SATO	SATO
1	212	13	GUAIMARAL	GUAIMARAL
3	212	13	LA MONTANA	LA MONTA?A
5	212	13	SAN ANDRES	SAN ANDRES
7	212	13	TACAMOCHITO	TACAMOCHITO
1	244	13	BAJO GRANDE	BAJO GRANDE
3	244	13	EL SALADO	EL SALADO
5	244	13	MACAYEPOS	MACAYEPOS
7	244	13	SAN ISIDRO	SAN ISIDRO
9	244	13	SAN ANDRES	SAN ANDRES
12	244	13	LAS LAJITAS	LAS LAJITAS
16	244	13	MESA	MESA
17	244	13	SANTO DOMINGO MEZA	SANTO DOMINGO MEZA
4	248	13	ROBLES	ROBLES
1	430	13	BARBOSA	BARBOSA
3	430	13	BETANIA	BETANIA
4	430	13	BOCA S.ANTONIO	BOCA S.ANTONIO
8	430	13	COYONGAL	COYONGAL
10	430	13	GUAZO	GUAZO
12	430	13	ISLA GRANDE	ISLA GRANDE
14	430	13	LA PASCUALA	LA PASCUALA
17	430	13	MADRID	MADRID
19	430	13	PANSEGUITA	PANSEGUITA
21	430	13	SAN RAFAEL DE CORTINA	SAN RAFAEL DE CORTINA
23	430	13	SAN SEBASTIAN BUENAVIST	SAN SEBASTIAN BUENAVIST
3	54	76	MARACAIBO	MARACAIBO
4	54	76	SAN ROQUE RAIZA	SAN ROQUE RAIZA
9	54	76	LA CRISTALINA	LA CRISTALINA
10	312	25	SAN JOSE BAJO	SAN JOSE BAJO
13	312	25	SAN RAIMUNDO	SAN RAIMUNDO
22	142	19	SAN JACINTO	SAN JACINTO
24	142	19	LOMA PELADA	LOMA PELADA
27	142	19	SILENCIO	SILENCIO
29	142	19	SABANETA	SABANETA
2	212	19	LA COMINERA	LA COMINERA
4	212	19	MEDIA NARANJA	MEDIA NARANJA
5	212	19	RIONEGRO	RIONEGRO
1	256	19	ALTO DEL REY	ALTO DEL REY
3	256	19	BETANIA	BETANIA
5	256	19	CHAPA	CHAPA
6	256	19	CHISQUIO	CHISQUIO
7	256	19	EL PLACER	EL PLACER
10	256	19	GAMBOA	GAMBOA
12	256	19	HUISITO	HUISITO
13	256	19	LA ALIANZA	LA ALIANZA
15	256	19	LOS ANAYES	LOS ANAYES
17	256	19	LOS ANGELES	LOS ANGELES
19	256	19	PANDIGUANDO	PANDIGUANDO
21	256	19	PUERTO RICO	PUERTO RICO
23	256	19	RONDON	RONDON
25	256	19	SAN JOAQUIN	SAN JOAQUIN
27	256	19	SEGUENGUE	SEGUENGUE
28	256	19	URIBE	URIBE
29	256	19	VILLA AL MAR	VILLA AL MAR
31	256	19	BUENA VISTA	BUENA VISTA
33	256	19	CABUYAL	CABUYAL
35	256	19	LA ROMELIA	LA ROMELIA
36	256	19	PLAYA RICA	PLAYA RICA
37	256	19	PUERTA LLAVE	PUERTA LLAVE
38	256	19	RIO HONDO	RIO HONDO
39	256	19	VEINTE DE JULIO	VEINTE DE JULIO
40	256	19	EL RETIRO	EL RETIRO
41	256	19	CALICHALES	CALICHALES
42	256	19	EL HIGUERON	EL HIGUERON
43	256	19	EL OCHENTAYUNO-	EL OCHENTAYUNO-
44	256	19	GUAZARAVITA	GUAZARAVITA
45	256	19	LA BANDA	LA BANDA
46	256	19	LA CUCHILLA	LA CUCHILLA
4	110	19	EL CARMEN	EL CARMEN
6	110	19	EL PORVENIR	EL PORVENIR
7	110	19	HONDURAS	HONDURAS
8	110	19	LA BALSA	LA BALSA
10	110	19	SAN IGNACIO	SAN IGNACIO
12	110	19	TIMBA	TIMBA
13	110	19	EL CERAL	EL CERAL
14	110	19	LA BALASTRERA	LA BALASTRERA
15	110	19	ASNAZU	ASNAZU
16	110	19	SAN FRANCISCO	SAN FRANCISCO
17	110	19	LA VENTURA	LA VENTURA
18	110	19	ALTO NAYA	ALTO NAYA
20	110	19	EL LLANITO	EL LLANITO
22	110	19	MAZAMORRERO	MAZAMORRERO
23	110	19	CASCAJERO	CASCAJERO
1	130	19	CAMPOALEGRE	CAMPOALEGRE
2	130	19	CHAUX	CHAUX
3	130	19	DINDE	DINDE
4	130	19	EL CARMELO	EL CARMELO
5	130	19	EL ROSARIO	EL ROSARIO
6	130	19	LA CAPILLA	LA CAPILLA
7	130	19	LA PEDREGOSA	LA PEDREGOSA
8	130	19	LA VENTA	LA VENTA
9	130	19	SANTA TERESA	SANTA TERESA
10	130	19	ORTEGA	ORTEGA
11	130	19	LA GRANJA	LA GRANJA
12	130	19	SAN ANTONIO	SAN ANTONIO
13	130	19	EL TUNEL	EL TUNEL
20	653	17	EL NARANJO	EL NARANJO
22	653	17	EL PERRO	EL PERRO
23	653	17	LA LOMA	LA LOMA
1	662	17	BERLIN	BERLIN
3	662	17	FLORENCIA	FLORENCIA
4	662	17	ENCIMADAS	ENCIMADAS
6	662	17	NORCASIA	NORCASIA
8	662	17	RANCHOLARGO	RANCHOLARGO
10	662	17	LA MOSCOVITA	LA MOSCOVITA
12	662	17	EL CONGAL	EL CONGAL
13	662	17	LA QUINTA	LA QUINTA
15	662	17	KILOMETRO 40	KILOMETRO 40
2	777	17	LA CUCHILLA	LA CUCHILLA
3	777	17	LA QUINTA	LA QUINTA
5	777	17	HOJAS ANCHAS	HOJAS ANCHAS
8	777	17	GUAMAL	GUAMAL
2	867	17	DONA JUANA	DO?A JUANA
3	867	17	ISAZA	ISAZA
8	486	17	LA FELICIA	LA FELICIA
1	513	17	CASTILLA	CASTILLA
2	513	17	LAS COLES	LAS COLES
3	513	17	SAN BARTOLOME	SAN BARTOLOME
4	513	17	ALTO DEL POZO	ALTO DEL POZO
5	513	17	LOS TRUJES	LOS TRUJES
6	513	17	MATA DE GUADUA	MATA DE GUADUA
7	513	17	ESTACION SALAMINA	ESTACION SALAMINA
8	513	17	LOMA HERMOSA	LOMA HERMOSA
9	513	17	EL ESCOBAL	EL ESCOBAL
10	513	17	SAN FRANCISCO	SAN FRANCISCO
11	513	17	LA PALMA	LA PALMA
12	513	17	BUENOS AIRES	BUENOS AIRES
13	513	17	LOSMORROS	LOSMORROS
14	513	17	SN LORENZO	SN LORENZO
1	524	17	ARAUCA	ARAUCA
2	524	17	EL REPOSO	EL REPOSO
3	524	17	LA PLATA	LA PLATA
4	524	17	LA INQUISICION	LA INQUISICION
5	524	17	CARTAGENA	CARTAGENA
6	524	17	SANTAGUEDA	SANTAGUEDA
1	541	17	ARBOLEDA	ARBOLEDA
2	541	17	BOLIVIA	BOLIVIA
3	541	17	EL CONGAL	EL CONGAL
4	541	17	EL HIGUERON	EL HIGUERON
5	541	17	GUACAS	GUACAS
6	541	17	LA LINDA	LA LINDA
8	541	17	LA RIOJA	LA RIOJA
9	541	17	PUEBLONUEVO	PUEBLONUEVO
10	541	17	SAMARIA	SAMARIA
11	541	17	SAN DANIEL	SAN DANIEL
12	541	17	LA ESPERANZA	LA ESPERANZA
13	541	17	LA TORRE	LA TORRE
14	541	17	EL VERAAL	EL VERAAL
1	614	17	BONAFONT	BONAFONT
3	293	25	SANTANDER RITA DL RIO NEGRO	SANTANDER RITA DL RIO NEGRO
5	293	25	EL GUAVIO	EL GUAVIO
1	295	25	SAN MARTIN	SAN MARTIN
3	295	25	SAN BARTOLOME	SAN BARTOLOME
4	295	25	SAN JOSE	SAN JOSE
2	297	25	CUZAQUIN	CUZAQUIN
5	297	25	LA VILLA	LA VILLA
8	297	25	LOS LOPEZ	LOS LOPEZ
1	299	25	SAN ROQUE	SAN ROQUE
2	307	25	ZUMBAMICOS	ZUMBAMICOS
4	307	25	BERLIN	BERLIN
5	307	25	BARLAZA	BARLAZA
2	317	25	PUNTA GRANDE	PUNTA GRANDE
9	148	25	SAN CARLOS	SAN CARLOS
10	148	25	EL CAMBULO	EL CAMBULO
1	151	25	RIO GRANDE	RIO GRANDE
3	151	25	MAYAS	MAYAS
1	154	25	HATO	HATO
2	154	25	SUCRE	SUCRE
3	154	25	ALISAL	ALISAL
5	154	25	SALITRE	SALITRE
6	154	25	CHARQUITA	CHARQUITA
1	168	25	PUERTO CHAGUANI	PUERTO CHAGUANI
1	175	25	FONQUETA	FONQUETA
2	178	25	MUNAR	MUNAR
3	178	25	QUERENTE	QUERENTE
5	178	25	CARAZA	CARAZA
6	178	25	CUMBA	CUMBA
8	178	25	CEREZOS	CEREZOS
9	178	25	FLOREZ	FLOREZ
10	178	25	GUAICA	GUAICA
2	181	25	LA LLANADA	LA LLANADA
4	181	25	EL HATO	EL HATO
5	181	25	EL RESGUARDO	EL RESGUARDO
2	200	25	RODAMONTAL	RODAMONTAL
4	200	25	EL MORTINO	EL MORTINO
2	214	25	PUEBLO VIEJO	PUEBLO VIEJO
4	214	25	CETIME	CETIME
6	214	25	LA MOYA	LA MOYA
2	245	25	LA VICTORIA	LA VICTORIA
3	245	25	PRADILLA	PRADILLA
2	258	25	TALAUTA	TALAUTA
2	269	25	MANO BLANCA	MANO BLANCA
8	855	23	BUENAVISTA	BUENAVISTA
9	855	23	EL REPOSO	EL REPOSO
11	855	23	EL VENADO	EL VENADO
12	855	23	LAS PIEDRAS	LAS PIEDRAS
14	855	23	MIELES	MIELES
16	855	23	MANZANARES	MANZANARES
17	855	23	SAN RAFAEL	SAN RAFAEL
19	855	23	GUADUAL CENTRAL	GUADUAL CENTRAL
2	1	25	LETICIA	LETICIA
3	1	25	LA PUNA	LA PUNA
2	19	25	PANTANILLO	PANTANILLO
1	35	25	LA PAZ	LA PAZ
2	40	25	LA FLORIDA	LA FLORIDA
3	40	25	REVENTONES	REVENTONES
1	53	25	LA HONDA	LA HONDA
3	53	25	TISANCE	TISANCE
1	86	25	PAQUILO	PAQUILO
1	95	25	LA PLAZUELA	LA PLAZUELA
2	99	25	SANTANDER BARBARA	SANTANDER BARBARA
2	120	25	SANTANDER LUCIA	SANTANDER LUCIA
1	123	25	PENA NEGRA	PE?A NEGRA
1	126	25	CAPELLANIA	CAPELLANIA
4	126	25	RIO GRANDE	RIO GRANDE
6	126	25	CHUNTAME	CHUNTAME
7	126	25	CANELON	CANELON
1	148	25	CAMBRAS	CAMBRAS
3	148	25	EL DINDAL	EL DINDAL
6	148	25	TATI	TATI
7	148	25	CORDOBA	CORDOBA
5	686	23	SABANANUEVA	SABANANUEVA
6	686	23	SAN ISIDRO	SAN ISIDRO
8	686	23	PUERTO NUEVO	PUERTO NUEVO
10	686	23	CANA	CANA
11	686	23	LAS LAURAS	LAS LAURAS
13	686	23	EL TAPON	EL TAPON
15	686	23	MORALITO	MORALITO
17	686	23	BELEN	BELEN
18	686	23	EL CHIQUI	EL CHIQUI
19	686	23	CAIMAN	CAIMAN
20	686	23	RETIRO	RETIRO
22	686	23	BONGAS MELLAS	BONGAS MELLAS
24	686	23	POMPELLA	POMPELLA
1	807	23	CALLEJAS	CALLEJAS
2	807	23	CARAMELO	CARAMELO
4	807	23	MANTAGORDAL	MANTAGORDAL
6	807	23	SAIZA	SAIZA
7	807	23	SANTAN FE	SANTAN FE
9	807	23	TUCURA	TUCURA
10	807	23	VOLADOR	VOLADOR
12	807	23	PUEBLO NUEVO	PUEBLO NUEVO
14	807	23	LAS CLARAS	LAS CLARAS
16	807	23	TOS PENSAMOS	TOS PENSAMOS
17	807	23	FRASQUILLO	FRASQUILLO
19	807	23	CARRIZOLA	CARRIZOLA
20	807	23	EL AGUILA	EL AGUILA
22	807	23	PALMIRA	PALMIRA
24	807	23	EL VIVIANO	EL VIVIANO
26	807	23	LOS MORALES	LOS MORALES
27	807	23	SANTANDER MARTA	SANTANDER MARTA
17	126	76	EL MIRADOR	EL MIRADOR
2	130	76	EL ARENAL	EL ARENAL
4	130	76	EL CARMELO	EL CARMELO
5	130	76	EL LAURO	EL LAURO
7	130	76	JUANCHITO GUALI	JUANCHITO GUALI
9	130	76	LA REGINA	LA REGINA
11	130	76	MADREVIEJA	MADREVIEJA
13	130	76	CAVASA	CAVASA
1	147	76	CAMPOALEGRE	CAMPOALEGRE
2	147	76	CAUCA	CAUCA
4	147	76	LA GRECIA	LA GRECIA
5	147	76	MODIN	MODIN
7	147	76	PUERTO VALLE	PUERTO VALLE
9	147	76	SANTA ANA	SANTA ANA
10	147	76	ZARAGOZA	ZARAGOZA
2	233	76	BORRERO AYERBE	BORRERO AYERBE
4	233	76	CISNEROS	CISNEROS
6	233	76	EL DANUBIO	EL DANUBIO
8	233	76	EL NARANJO	EL NARANJO
9	233	76	EL PALMAR	EL PALMAR
11	233	76	EL QUEREMAL	EL QUEREMAL
13	233	76	GUADUALITO	GUADUALITO
15	233	76	LA ELSA	LA ELSA
33	109	76	SAN FRANCISCO JAVIER	SAN FRANCISCO JAVIER
34	109	76	SAN ISIDRO	SAN ISIDRO
36	109	76	SAN LORENZO	SAN LORENZO
37	109	76	SAN PEDRO NAYA	SAN PEDRO NAYA
39	109	76	TAPARAL	TAPARAL
41	109	76	YURUMANGUI	YURUMANGUI
43	109	76	ZACARIAS	ZACARIAS
1	111	76	CHAMBIMBAL	CHAMBIMBAL
2	111	76	EL PLACER	EL PLACER
3	111	76	EL ROSARIO	EL ROSARIO
5	111	76	EL VINCULO	EL VINCULO
6	111	76	LA HABANA	LA HABANA
8	111	76	LOS BANCOS	LOS BANCOS
10	111	76	MONTERREY	MONTERREY
12	111	76	QUEBRADASECA	QUEBRADASECA
14	111	76	ZANJON HONDO	ZANJON HONDO
16	111	76	EL PORVENIR	EL PORVENIR
18	111	76	PUEBLO NUEVO	PUEBLO NUEVO
19	111	76	FRISOLES	FRISOLES
1	113	76	CEILAN	CEILAN
3	113	76	EL GUAYABO	EL GUAYABO
5	113	76	EL RAICERO	EL RAICERO
7	113	76	EL VOLADERO	EL VOLADERO
9	113	76	LA MORENA	LA MORENA
10	113	76	MESTIZAL	MESTIZAL
12	113	76	SAN ANTONIO	SAN ANTONIO
14	113	76	EL PLACER	EL PLACER
15	113	76	CHICORAL	CHICORAL
2	122	76	BURILA	BURILA
4	122	76	LA RIVERA	LA RIVERA
6	122	76	SAMARIA	SAMARIA
7	122	76	SAN GERARDO	SAN GERARDO
5	773	68	EL NARANJITO	EL NARANJITO
7	773	68	CUCHINA 22	CUCHINA 22
8	773	68	LA PAVA	LA PAVA
10	773	68	SOCORRITOS	SOCORRITOS
1	780	68	CACHIRI	CACHIRI
2	780	68	EL MOHAN	EL MOHAN
7	780	68	CARTAGUA	CARTAGUA
1	820	68	BERLIN	BERLIN
3	820	68	CARRIZAL	CARRIZAL
4	820	68	VEGAS	VEGAS
1	855	68	SANTA TERESA	SANTA TERESA
2	855	68	EL MORRO	EL MORRO
3	855	68	LLANO HONDO	LLANO HONDO
1	861	68	ALTO JORDAN	ALTO JORDAN
4	861	68	LLANADAS	LLANADAS
17	861	68	EL LIMON	EL LIMON
19	861	68	SAN PABLO	SAN PABLO
22	861	68	LOMALTA	LOMALTA
23	861	68	ROPERO	ROPERO
2	872	68	HATO VIEJO	HATO VIEJO
2	895	68	LA PLAZUELA	LA PLAZUELA
1	1	70	BUENAVISTA	BUENAVISTA
3	1	70	CHOCHO	CHOCHO
4	1	70	EL CERRITO	EL CERRITO
6	1	70	LA CHIVERA	LA CHIVERA
8	1	70	LA PINATA	LA PI?ATA
10	1	70	LAS HUERTAS	LAS HUERTAS
12	1	70	MOCHA	MOCHA
13	1	70	SABANAS POTRERO	SABANAS POTRERO
15	1	70	VILLA SAN MARTIN	VILLA SAN MARTIN
17	1	70	BUENAVISTICA	BUENAVISTICA
19	1	70	CASTANEDA	CASTA?EDA
2	110	70	REMOLINO	REMOLINO
12	689	68	YARIMA	YARIMA
16	689	68	CANTARRANA	CANTARRANA
18	689	68	EL TESORO	EL TESORO
19	689	68	EL 32	EL 32
23	689	68	POZO NUTRIAS	POZO NUTRIAS
26	689	68	SANTO DOMINGO DE RAMOS	SANTO DOMINGO DE RAMOS
1	705	68	EL APURE	EL APURE
3	705	68	LA TAHONA	LA TAHONA
5	705	68	QUEBRADAS	QUEBRADAS
1	720	68	ARAGUA	ARAGUA
2	720	68	CACHIPAY	CACHIPAY
6	899	25	PASO ANCHO	PASO ANCHO
3	743	25	YOYATA	YOYATA
4	743	25	QUEBRADA HONDA	QUEBRADA HONDA
5	743	25	SUBIA	SUBIA
1	318	66	LA BENDECIDA	LA BENDECIDA
2	318	66	SAN CLEMENTE	SAN CLEMENTE
4	318	66	SUAIBA	SUAIBA
6	318	66	TRAVESIAS	TRAVESIAS
7	318	66	CORINTO	CORINTO
10	318	66	BETANIA	BETANIA
11	318	66	EL JORDAN	EL JORDAN
13	318	66	ALTURAS	ALTURAS
1	383	66	PATIOBONITO	PATIOBONITO
3	383	66	EL TAMBO	EL TAMBO
4	383	66	CHORRITOS	CHORRITOS
3	272	63	CRUCES	CRUCES
4	272	63	PAVAS	PAVAS
3	560	8	PUERTO GIRALDO	PUERTO GIRALDO
5	560	8	GIRALDITO	GIRALDITO
1	573	8	EDUARDO SANTOS	EDUARDO SANTOS
1	606	8	ARROYO NEGRO	ARROYO NEGRO
3	606	8	LAS TABLAS	LAS TABLAS
4	606	8	ROTINET	ROTINET
2	638	8	CASCAJAL	CASCAJAL
3	638	8	COLOMBIA	COLOMBIA
4	638	8	ISABEL LOPEZ	ISABEL LOPEZ
6	638	8	MOLINERO	MOLINERO
7	638	8	MIRADOR	MIRADOR
1	675	8	ALGODONAL	ALGODONAL
1	685	8	UVITO	UVITO
1	832	8	CUATRO BOCAS	CUATRO BOCAS
3	832	8	GUAIMARAL	GUAIMARAL
1	849	8	LURIZA	LURIZA
1	1	11	CONCEPCION	CONCEPCION
3	1	11	NUNEZ	NU?EZ
5	1	11	SAN JUAN DE SUMAPAZ	SAN JUAN DE SUMAPAZ
2	1	13	ARROYO GRANDE	ARROYO GRANDE
3	1	13	BARU	BARU
5	1	13	BOCACHICA	BOCACHICA
7	1	13	ISLA FUERTE	ISLA FUERTE
9	1	13	PASACABALLOS	PASACABALLOS
18	570	23	BETANIA	BETANIA
19	570	23	EL CONTENTO	EL CONTENTO
20	570	23	EL CAMPANO	EL CAMPANO
2	574	23	EL PANTANO	EL PANTANO
4	574	23	VILLA ESTER	VILLA ESTER
5	574	23	ARIZAL	ARIZAL
7	574	23	MORINDO	MORINDO
9	574	23	LAS MUJERES	LAS MUJERES
1	580	23	LA RICA	LA RICA
2	580	23	PICA PICA	PICA PICA
4	580	23	JUAN JOSE	JUAN JOSE
6	580	23	BUENOS AIRES	BUENOS AIRES
8	580	23	SANTA FE DEL CLARO	SANTA FE DEL CLARO
2	586	23	EL HUESO	EL HUESO
4	586	23	SAN PEDRO	SAN PEDRO
1	660	23	ARENA DEL NORTE	ARENA DEL NORTE
3	660	23	CATALINA	CATALINA
5	660	23	CRUCERO	CRUCERO
6	660	23	EL VIEJANO	EL VIEJANO
8	660	23	LA YE	LA YE
9	660	23	MORROCOY	MORROCOY
11	660	23	SALITRAL	SALITRAL
13	660	23	SANTIAGO ABAJO	SANTIAGO ABAJO
15	660	23	AGUAS VIVAS	AGUAS VIVAS
17	660	23	PISA FLORES	PISA FLORES
19	660	23	EL AMARILLO	EL AMARILLO
20	660	23	EL ROBLE	EL ROBLE
26	771	70	MALAMBO	MALAMBO
27	771	70	SAN MATEO	SAN MATEO
1	820	70	COVENAS	COVE?AS
2	820	70	GUAYABAL	GUAYABAL
3	820	70	NUEVA ERA	NUEVA ERA
5	820	70	BOCA DE CIENAGA	BOCA DE CIENAGA
6	820	70	EL REPARO	EL REPARO
7	820	70	PITA EN MEDIO	PITA EN MEDIO
8	820	70	PUERTO VIEJO	PUERTO VIEJO
10	820	70	PITA ABAJO	PITA ABAJO
11	820	70	PUNTA SECA	PUNTA SECA
1	823	70	CARACOL	CARACOL
2	823	70	LAS PIEDRAS	LAS PIEDRAS
3	823	70	MACAJAN	MACAJAN
4	823	70	PALMIRA	PALMIRA
5	823	70	VARSOVIA	VARSOVIA
6	823	70	LA PICHE	LA PICHE
7	823	70	CIENAGUITA	CIENAGUITA
8	823	70	EL FLORAL	EL FLORAL
9	823	70	MOQUEN	MOQUEN
10	823	70	GUALON	GUALON
11	823	70	EL CANITO	EL CANITO
12	823	70	LA SIRIA	LA SIRIA
1	1	73	BUENOS AIRES	BUENOS AIRES
2	1	73	COCORA	COCORA
3	1	73	COMBEIMA	COMBEIMA
4	1	73	DANTAS	DANTAS
5	1	73	EL SALADO	EL SALADO
6	1	73	JUNTAS	JUNTAS
7	1	73	LAURELES	LAURELES
8	1	73	PICALENA	PICALENA
9	1	73	SAN BERNARDO	SAN BERNARDO
10	1	73	SAN JUAN DE LA CHINA	SAN JUAN DE LA CHINA
11	1	73	TAPIAS	TAPIAS
12	1	73	TOCHE	TOCHE
13	1	73	VILLARESTREPO	VILLARESTREPO
14	1	73	LLANITOS	LLANITOS
15	1	73	EL TOTUMO	EL TOTUMO
16	1	73	LLANO COMBEIMA	LLANO COMBEIMA
17	1	73	CARMEN D BULIRA	CARMEN D BULIRA
18	1	73	EL RODEO	EL RODEO
19	1	73	CARMEN D ROVIRA	CARMEN D ROVIRA
20	1	73	COELLO	COELLO
21	1	73	LA GAVIOTA	LA GAVIOTA
22	1	73	CHAPETON	CHAPETON
23	1	73	CALAMBEO	CALAMBEO
3	799	41	SAN ANDRES	SAN ANDRES
4	799	41	SIERRA DE LA CANADA	SIERRA DE LA CA?ADA
5	799	41	MESA REDONDA	MESA REDONDA
6	799	41	EL CEDRAL	EL CEDRAL
1	801	41	SN PEDRO	SN PEDRO
1	807	41	NARANJAL	NARANJAL
2	807	41	MATEO RICO	MATEO RICO
3	807	41	TOBO	TOBO
4	807	41	SAN ANTONIO	SAN ANTONIO
5	807	41	MONTANITA	MONTA?ITA
6	807	41	QUINCHE	QUINCHE
7	807	41	COSANZA	COSANZA
8	807	41	SANTANDER FE	SANTANDER FE
9	807	41	SAN ISIDRO	SAN ISIDRO
1	872	41	POTOSI	POTOSI
2	872	41	SAN ALFONSO	SAN ALFONSO
3	872	41	HATO NUEVO	HATO NUEVO
4	872	41	POLONIA	POLONIA
5	872	41	LA VICTORIA	LA VICTORIA
6	872	41	GOLONDRINAS	GOLONDRINAS
1	885	41	LETRAN	LETRAN
1	1	44	ARROYO ARENA	ARROYO ARENA
2	1	44	BARBACOAS	BARBACOAS
4	1	44	CASCAJALITO	CASCAJALITO
7	1	44	EL MINGUEO	EL MINGUEO
8	1	44	GALAN	GALAN
10	1	44	LAS FLORES	LAS FLORES
11	1	44	MATITA	MATITA
13	1	44	PALOMINO	PALOMINO
15	1	44	SAN ANTONIO	SAN ANTONIO
17	1	44	VILLA MARTIN	VILLA MARTIN
19	1	44	CAMPANA	CAMPANA
20	1	44	CHOLE	CHOLE
22	1	44	EL LABRAS	EL LABRAS
24	1	44	MORENEROS	MORENEROS
25	1	44	PELECHUA	PELECHUA
27	1	44	TIGRERA	TIGRERA
3	78	44	LAGUNITA	LAGUNITA
4	78	44	MANANTIAL	MANANTIAL
6	78	44	PAPAYAL	PAPAYAL
8	78	44	SAN PEDRO	SAN PEDRO
3	548	41	CARMELO	CARMELO
1	551	41	BRUSELAS	BRUSELAS
3	551	41	LA LAGUNA	LA LAGUNA
6	551	41	CHILLURCO	CHILLURCO
8	551	41	CRIOLLO	CRIOLLO
1	615	41	ULLOA	ULLOA
2	615	41	RIVERITA	RIVERITA
1	660	41	LA CABANA	LA CABA?A
2	660	41	SAN RAFAEL	SAN RAFAEL
4	660	41	PARAISO CHILCA	PARAISO CHILCA
5	660	41	PIRULINDA	PIRULINDA
7	660	41	MORELIA	MORELIA
2	668	41	OBANDO	OBANDO
3	668	41	VILLA FATIMA	VILLA FATIMA
5	668	41	LA CUCHILLA	LA CUCHILLA
3	317	52	MUELLAMUES	MUELLAMUES
1	320	52	AHUMADA	AHUMADA
2	320	52	ALEX	ALEX
3	320	52	GIRARDOT	GIRARDOT
4	320	52	LA VICTORIA	LA VICTORIA
6	320	52	SAN ALEJANDRO	SAN ALEJANDRO
8	320	52	LA VICTORIA 2	LA VICTORIA 2
9	320	52	EL CID	EL CID
11	320	52	MOTILON ESQUINA	MOTILON ESQUINA
12	320	52	SAN GERMAN ALTO	SAN GERMAN ALTO
13	320	52	SAN GERMAN BAJO	SAN GERMAN BAJO
14	320	52	GUARAMUES	GUARAMUES
15	320	52	CUATRO ESQUINAS	CUATRO ESQUINAS
1	323	52	CUATIS	CUATIS
3	323	52	CHARANDU	CHARANDU
1	352	52	BOLIVAR	BOLIVAR
2	352	52	EL TABLON	EL TABLON
3	352	52	SAN FRANCISCO	SAN FRANCISCO
4	352	52	SAN JAVIER	SAN JAVIER
5	352	52	EL ALTO DEL REY	EL ALTO DEL REY
1	354	52	NEIRA	NEIRA
2	354	52	PILCUAN	PILCUAN
3	354	52	VALENCIA	VALENCIA
4	354	52	PILCUAN 2	PILCUAN 2
5	354	52	SN BUENAVENTURA	SN BUENAVENTURA
7	354	52	PEDREGAL	PEDREGAL
8	354	52	EL ALISAL	EL ALISAL
4	227	52	PANAN	PANAN
5	227	52	SAN MARTIN	SAN MARTIN
6	227	52	NAZATE	NAZATE
7	227	52	PUEBLO VIEJO	PUEBLO VIEJO
8	227	52	TALAMBI	TALAMBI
1	233	52	DAMASCO	DAMASCO
2	233	52	EL DESIERTO	EL DESIERTO
3	233	52	PISANDA	PISANDA
4	233	52	SIDON	SIDON
5	233	52	AMINDA	AMINDA
6	233	52	NULPI	NULPI
7	233	52	LA ESPERANZA	LA ESPERANZA
6	594	63	PUERTO ALEJANDRO	PUERTO ALEJANDRO
1	690	63	BOQUIA	BOQUIA
3	690	63	LA NUBIA	LA NUBIA
1	1	66	ALTAGRACIA	ALTAGRACIA
3	1	66	BETULIA	BETULIA
5	1	66	COMBIA	COMBIA
6	1	66	CONVENCION	CONVENCION
9	1	66	LA BELLA	LA BELLA
10	1	66	LA FLORIDA	LA FLORIDA
11	1	66	LA LAGUNA	LA LAGUNA
13	1	66	LA SELVA	LA SELVA
15	1	66	MORELIA	MORELIA
16	1	66	MUNDO NUEVO	MUNDO NUEVO
19	1	66	SAN JOAQUIN	SAN JOAQUIN
20	1	66	SAN JOSE	SAN JOSE
21	1	66	TRIBUNAS	TRIBUNAS
23	1	66	LA HONDA	LA HONDA
25	1	66	TRES PUERTAS	TRES PUERTAS
27	1	66	EL POMO	EL POMO
28	1	66	YARUMAL	YARUMAL
30	1	66	ALEGRIAS(ALTO)	ALEGRIAS(ALTO)
32	1	66	PEREZ	PEREZ
33	1	66	CANAVERAL	CANAVERAL
1	820	54	BATA	BATA
2	820	54	BOJABA	BOJABA
3	820	54	EL CHUSCAL	EL CHUSCAL
5	820	54	PEDRAZA	PEDRAZA
7	820	54	SEGOVIA	SEGOVIA
8	820	54	SAN BERNARDO	SAN BERNARDO
10	820	54	LA LOMA	LA LOMA
12	820	54	ROMAN	ROMAN
14	820	54	SARARITO	SARARITO
1	871	54	ALTO DEL POZO	ALTO DEL POZO
3	871	54	EL PARAMO	EL PARAMO
4	874	54	LA UCHEMA	LA UCHEMA
25	615	27	TUMARADOCITO BE	TUMARADOCITO BE
15	708	70	EL LLANO	EL LLANO
16	708	70	RINCON GRANDE	RINCON GRANDE
1	713	70	AGUACATE	AGUACATE
3	713	70	BERRUGAS	BERRUGAS
5	713	70	LABARCE	LABARCE
6	713	70	LIBERTAD	LIBERTAD
8	713	70	PALO ALTO	PALO ALTO
3	275	76	CANAS ARRIBA	CA?AS ARRIBA
4	275	76	CHOCOCITO	CHOCOCITO
5	275	76	EL LIBANO	EL LIBANO
6	275	76	LA DIANA	LA DIANA
7	275	76	LA RIBERA	LA RIBERA
8	275	76	LA UNION	LA UNION
9	275	76	PUEBLO NUEVO	PUEBLO NUEVO
10	275	76	REMOLINO	REMOLINO
11	275	76	SAN ANTONIO	SAN ANTONIO
12	275	76	SAN FRANCISCO	SAN FRANCISCO
13	275	76	SANTA ROSA	SANTA ROSA
14	275	76	TARRAGONA	TARRAGONA
15	275	76	EL PEDREGAL	EL PEDREGAL
16	275	76	SANTO DOMINGO	SANTO DOMINGO
17	275	76	LA PALMERA	LA PALMERA
19	275	76	LAS GUACAS	LAS GUACAS
20	275	76	PARRAGA	PARRAGA
21	275	76	CALENO	CALE?O
22	275	76	MIRAVALLES	MIRAVALLES
23	275	76	LA ACEQUIA	LA ACEQUIA
1	306	76	COSTA RICA	COSTA RICA
2	306	76	FLORESTA	FLORESTA
3	306	76	JUNTAS	JUNTAS
4	306	76	LA NOVILLERA	LA NOVILLERA
5	306	76	ZABALETAS	ZABALETAS
1	318	76	ALTO LA JULIA	ALTO LA JULIA
2	318	76	EL BOSQUE	EL BOSQUE
3	318	76	GUABAS	GUABAS
4	318	76	GUABITAS	GUABITAS
5	318	76	LA MAGDALENA	LA MAGDALENA
16	233	76	LA PROVIDENCIA	LA PROVIDENCIA
17	233	76	LOBO GUERRERO	LOBO GUERRERO
18	233	76	LOS ALPES	LOS ALPES
19	233	76	SAN BERNARDO	SAN BERNARDO
20	233	76	SAN VICENTE	SAN VICENTE
21	233	76	SANTA MARIA	SANTA MARIA
22	233	76	SENDO	SENDO
23	233	76	TOCOTA	TOCOTA
24	233	76	VILLAHERMOSA	VILLAHERMOSA
25	233	76	ZABALETAS	ZABALETAS
26	233	76	ZELANDIA	ZELANDIA
27	233	76	JUNTAS	JUNTAS
28	233	76	LA VENTURA	LA VENTURA
29	233	76	KILOMETRO 18	KILOMETRO 18
30	233	76	EL ROCIO	EL ROCIO
31	233	76	JIGUALES	JIGUALES
32	233	76	CRISTALES	CRISTALES
1	243	76	EL EMBAL	EL EMBAL
2	243	76	LA ESPARTA	LA ESPARTA
3	243	76	LA GUAYACANA	LA GUAYACANA
4	243	76	LA LIBERTAD	LA LIBERTAD
5	243	76	LA MARIA	LA MARIA
6	243	76	SAN JOSE	SAN JOSE
7	243	76	SAN PABLO	SAN PABLO
8	243	76	VILLANUEVA	VILLANUEVA
9	243	76	SANTA HELENA	SANTA HELENA
10	243	76	SANTA MARTA	SANTA MARTA
11	243	76	LA GALANA	LA GALANA
12	243	76	CAJONES	CAJONES
13	243	76	CHORRITOS	CHORRITOS
14	243	76	EL COFRE	EL COFRE
15	243	76	EL RIO	EL RIO
16	243	76	LA BOCATOMA	LA BOCATOMA
17	243	76	LA JUDEA	LA JUDEA
18	243	76	CAJA DE ORO	CAJA DE ORO
1	246	76	ALBAN	ALBAN
2	246	76	BELLAVISTA	BELLAVISTA
3	246	76	LA GOAJIRA	LA GOAJIRA
4	246	76	LA GUARDIA	LA GUARDIA
5	246	76	LA PALMERA	LA PALMERA
6	246	76	PLAYA RICA	PLAYA RICA
7	246	76	SAN JOSE	SAN JOSE
8	246	76	SARMELIA	SARMELIA
9	246	76	LA CARBONERA	LA CARBONERA
11	246	76	ALTO CIELO	ALTO CIELO
1	248	76	AUJI	AUJI
2	248	76	CARRIZAL	CARRIZAL
4	248	76	EL PARAISO	EL PARAISO
5	248	76	EL PLACER	EL PLACER
8	248	76	SAN ANTONIO	SAN ANTONIO
10	248	76	SANTA LUISA	SANTA LUISA
11	248	76	TENERIFE	TENERIFE
1	126	76	EL BOLEO	EL BOLEO
3	126	76	JIGUALES	JIGUALES
4	126	76	LA CECILIA	LA CECILIA
6	126	76	LA FLORIDA	LA FLORIDA
7	126	76	LA GAVIOTA	LA GAVIOTA
9	126	76	LA RIVERA	LA RIVERA
11	126	76	LA UNION	LA UNION
12	126	76	MADRONAL	MADRONAL
14	126	76	RIOBRAVO	RIOBRAVO
15	126	76	SAN JOSE	SAN JOSE
8	508	70	EL PALMAR	EL PALMAR
10	508	70	JONEY	JONEY
11	508	70	LA PENA	LA PE?A
12	508	70	OSOS	OSOS
14	508	70	SAN RAFAEL	SAN RAFAEL
16	508	70	LOMA DEL BANCO	LOMA DEL BANCO
1	523	70	ALGODONCILLO	ALGODONCILLO
3	523	70	GUAIMI	GUAIMI
2	670	70	CEJA DEL MANGO	CEJA DEL MANGO
3	110	70	CHINA ROJA	CHINA ROJA
4	110	70	LAS CHICHAS	LAS CHICHAS
2	124	70	SIETE PALMAS	SIETE PALMAS
3	124	70	ALFEREZ	ALFEREZ
5	124	70	CANDELARIA	CANDELARIA
7	124	70	TOFEME	TOFEME
8	124	70	CEDENO	CEDE?O
10	124	70	NUEVA ESTACION	NUEVA ESTACION
1	137	19	CERRO ALTO	CERRO ALTO
2	137	19	EL PITAL	EL PITAL
3	137	19	LA AGUADA	LA AGUADA
4	137	19	PESCADOR	PESCADOR
5	137	19	PIOYA	PIOYA
6	137	19	PLAN DE ZUNIGA	PLAN DE ZUNIGA
7	137	19	PUEBLO NUEVO	PUEBLO NUEVO
8	137	19	SIBERIA	SIBERIA
9	137	19	EL SOCORRO	EL SOCORRO
10	137	19	SIBERIA-OVEJAS	SIBERIA-OVEJAS
1	142	19	CAMPOALEGRE	CAMPOALEGRE
2	142	19	CAPONERA	CAPONERA
3	142	19	EL GUABAL	EL GUABAL
4	142	19	EL PALO	EL PALO
5	142	19	EL PLACER	EL PLACER
6	142	19	GUACHENE	GUACHENE
7	142	19	HUASANO	HUASANO
8	142	19	MIRAFLORES	MIRAFLORES
9	142	19	PALOMERA	PALOMERA
10	142	19	PARAMILLO	PARAMILLO
11	142	19	QUINTERO	QUINTERO
12	142	19	CARPINTERO	CARPINTERO
13	142	19	EL ALBA	EL ALBA
14	142	19	EL CRUCERO	EL CRUCERO
15	142	19	LA ARBOLEDA	LA ARBOLEDA
16	142	19	SAN NICOLAS	SAN NICOLAS
17	142	19	SANTA RITA	SANTA RITA
18	142	19	LLANO DE TAULA	LLANO DE TAULA
19	142	19	SAN ANTONIO	SAN ANTONIO
20	142	19	OBANDO	OBANDO
7	50	19	SINAI	SINAI
8	50	19	LA EMBOSCADA	LA EMBOSCADA
9	50	19	SANTA CLARA	SANTA CLARA
3	126	25	RINCON SANTO	RINCON SANTO
5	126	25	CALAON	CALAON
8	126	25	RIO FRIO	RIO FRIO
2	148	25	CANCHIMAY	CANCHIMAY
5	148	25	SAN PEDRO	SAN PEDRO
8	148	25	LA AZAUNCHA	LA AZAUNCHA
7	686	23	VALPARAISO	VALPARAISO
9	686	23	PELAYITO	PELAYITO
12	686	23	BONGO	BONGO
14	686	23	BOCA DE LOPEZ	BOCA DE LOPEZ
16	686	23	LOS BORRACHOS	LOS BORRACHOS
21	686	23	EL OBLIGADO	EL OBLIGADO
23	686	23	EL NARANJO	EL NARANJO
25	686	23	COROCITO	COROCITO
3	807	23	CELMIRA	CELMIRA
5	807	23	NUEVA GRANADA	NUEVA GRANADA
8	807	23	SEVERINERA	SEVERINERA
11	807	23	MAZAMORRA	MAZAMORRA
13	807	23	LA SIERPE	LA SIERPE
4	755	68	QUEBRADAS	QUEBRADAS
5	755	68	ALTO DE LA CRUZ	ALTO DE LA CRUZ
6	755	68	VERDIN	VERDIN
7	755	68	LUCHADERO	LUCHADERO
9	755	68	EL BOSQUE	EL BOSQUE
11	755	68	ALTOS LOS CHOCO	ALTOS LOS CHOCO
13	755	68	MORROS	MORROS
14	755	68	MORADIO	MORADIO
15	755	68	PALMARITO	PALMARITO
1	770	68	OLIVAL	OLIVAL
2	770	68	SAN JOSE SUAITA	SAN JOSE SUAITA
3	770	68	VADO REAL	VADO REAL
4	770	68	LA CHAPA	LA CHAPA
5	770	68	BALCONCITOS	BALCONCITOS
6	770	68	PUERTO LIMON	PUERTO LIMON
7	770	68	LA CUCUTENA	LA CUCUTE?A
8	770	68	TOLOTA	TOLOTA
1	773	68	LA GRANJA	LA GRANJA
2	773	68	LA PRADERA	LA PRADERA
3	773	68	SABANA GRANDE	SABANA GRANDE
4	773	68	ARALES	ARALES
4	616	73	PALONEGRO	PALONEGRO
5	616	73	GAITAN	GAITAN
6	616	73	MARACAIBO	MARACAIBO
7	616	73	LA ALBANIA	LA ALBANIA
8	616	73	URIBE	URIBE
1	622	73	SANTA ELENA	SANTA ELENA
2	622	73	EL CEDRO	EL CEDRO
1	624	73	EL CORAZON	EL CORAZON
2	624	73	HERVIDERO	HERVIDERO
3	624	73	LOS ANDES	LOS ANDES
4	624	73	RIOMANSO	RIOMANSO
5	624	73	SAN PEDRO	SAN PEDRO
6	624	73	HATO VIEJO	HATO VIEJO
7	624	73	GUADUALITO	GUADUALITO
8	624	73	LA FLORIDA	LA FLORIDA
9	624	73	LA OSERA	LA OSERA
10	624	73	LA SELVA	LA SELVA
1	671	73	TABALCONN	TABALCONN
2	671	73	SANTA INES	SANTA INES
1	675	73	LA FLORIDA	LA FLORIDA
2	675	73	PLAYARRICA	PLAYARRICA
3	675	73	TETUAN	TETUAN
4	675	73	VILLA HERMOSA	VILLA HERMOSA
1	678	73	EL SALITRE	EL SALITRE
2	678	73	LA LAGUNA	LA LAGUNA
3	678	73	MALNOMBRE	MALNOMBRE
4	678	73	PAYANDE	PAYANDE
5	678	73	SAN JOSE	SAN JOSE
6	678	73	TOMOGO	TOMOGO
7	678	73	GUASIMITO	GUASIMITO
8	678	73	LUISA GARCIA	LUISA GARCIA
9	678	73	SANTA LUCIA	SANTA LUCIA
1	686	73	COLON	COLON
2	686	73	LA ESTRELLA	LA ESTRELLA
3	686	73	SAN RAFAEL	SAN RAFAEL
4	686	73	LA CONGOJA	LA CONGOJA
1	770	73	HATO VIEJO	HATO VIEJO
2	770	73	S CAYETANO CHIR	S CAYETANO CHIR
3	770	73	CANAVERALES	CANAVERALES
1	854	73	LA MANGA	LA MANGA
2	854	73	BUENAVISTA BAJA	BUENAVISTA BAJA
3	854	73	NEME	NEME
4	854	73	VALLECITO	VALLECITO
1	861	73	JUNIN	JUNIN
2	861	73	LA SIERRITA	LA SIERRITA
3	861	73	MALABAR	MALABAR
4	861	73	PALMARROSA	PALMARROSA
1	870	73	PAVAS	PAVAS
2	870	73	PRIMAVERA	PRIMAVERA
10	483	73	MONTEFRIO	MONTEFRIO
1	504	73	BUENOS AIRES	BUENOS AIRES
2	504	73	CHAPINERO	CHAPINERO
3	504	73	GUAIPA	GUAIPA
4	504	73	HATO DE IGLESIA	HATO DE IGLESIA
5	504	73	HORIZONTE	HORIZONTE
6	504	73	LA COLORADA	LA COLORADA
8	504	73	OLAYA HERRERA	OLAYA HERRERA
10	504	73	PILO	PILO
11	504	73	LA BALSA	LA BALSA
13	504	73	CEDRALES	CEDRALES
14	504	73	EL MACO	EL MACO
16	504	73	GUATAVITA TUA	GUATAVITA TUA
17	504	73	LOS GUAYABOS	LOS GUAYABOS
19	504	73	LA SORTIJA	LA SORTIJA
20	504	73	LOS ANDES	LOS ANDES
1	547	73	CHICALA	CHICALA
2	547	73	DOIMA	DOIMA
4	547	73	SAN MIGUEL	SAN MIGUEL
1	555	73	BILBAO	BILBAO
3	555	73	LA ESTRELLA	LA ESTRELLA
5	555	73	RIO CLARO	RIO CLARO
2	402	25	EL VINO	EL VINO
2	426	25	GASUCO	GASUCO
4	426	25	ZOLANA	ZOLANA
5	426	25	SAN LUIS	SAN LUIS
2	430	25	SAN PEDRO	SAN PEDRO
3	430	25	EL CORZO	EL CORZO
2	436	25	PALMAR ARRIBA	PALMAR ARRIBA
2	753	15	PUENTE PINZON	PUENTE PINZON
7	753	15	LA JOBONERA	LA JOBONERA
2	755	15	EL OSO	EL OSO
3	755	15	LA MANGA	LA MANGA
5	755	15	PUEBLOVIEJO	PUEBLOVIEJO
1	757	15	SANTA TERESA	SANTA TERESA
3	757	15	SOCHA VIEJO	SOCHA VIEJO
1	759	15	MORCA	MORCA
3	759	15	VANEGAS	VANEGAS
4	759	15	SIATAME	SIATAME
5	759	15	EL CRUCERO	EL CRUCERO
1	763	15	EL MORAL	EL MORAL
1	774	15	DESAGUADERO	DESAGUADERO
4	774	15	SIAPORA	SIAPORA
1	776	15	PEDREGAL ALTO	PEDREGAL ALTO
1	778	15	EL SALITRE	EL SALITRE
2	798	15	VALLE GRANDE	VALLE GRANDE
1	804	15	SUPANECA ARRIBA	SUPANECA ARRIBA
2	804	15	SUTA ARRIBA	SUTA ARRIBA
1	810	15	EL NOGAL	EL NOGAL
2	810	15	EL PALMAR	EL PALMAR
3	810	15	LA CARRERA	LA CARRERA
4	810	15	LA VARIANTE	LA VARIANTE
1	816	15	GARIBAI	GARIBAI
1	820	15	BADO CASTRO	BADO CASTRO
1	822	15	LA PUERTA	LA PUERTA
2	837	15	RIO DE PIEDRA	RIO DE PIEDRA
3	837	15	EL HATO	EL HATO
4	837	15	SAVIAL	SAVIAL
5	837	15	LEONERA	LEONERA
1	839	15	PARAMO	PARAMO
3	839	15	VILLA HERMOSA	VILLA HERMOSA
1	861	15	PARROQUIA VIEJA	PARROQUIA VIEJA
2	861	15	PUENTE DE PIEDRA	PUENTE DE PIEDRA
5	861	15	MONTOYA	MONTOYA
6	861	15	ESTANCIA GRANDE	ESTANCIA GRANDE
1	1	17	ALTO DE LISBOA	ALTO DE LISBOA
2	1	17	COLOMBIA	COLOMBIA
3	1	17	EL TABLAZO	EL TABLAZO
10	572	15	KILOMETRO 25	KILOMETRO 25
11	572	15	MARFIL	MARFIL
1	580	15	CORMAL	CORMAL
2	580	15	EL PARQUE	EL PARQUE
3	580	15	HUMBO	HUMBO
4	580	15	LA VEGA	LA VEGA
1	599	15	GUAYABAL	GUAYABAL
4	599	15	EL ESCOBAL	EL ESCOBAL
1	600	15	SAN CAYETANO	SAN CAYETANO
2	600	15	LA CANDELARIA	LA CANDELARIA
1	621	15	RANCHOGRANDE	RANCHOGRANDE
1	632	15	GARAVITO	GARAVITO
2	632	15	MERCHAN	MERCHAN
6	660	54	QUEBRADA HONDA	QUEBRADA HONDA
3	670	54	CASAS VIEJAS	CASAS VIEJAS
5	670	54	GUADUALES	GUADUALES
8	670	54	QUEBRADA GRANDE	QUEBRADA GRANDE
10	670	54	PALMAS DE VINO	PALMAS DE VINO
1	673	54	AYACUCHO	AYACUCHO
3	673	54	GUADUAS	GUADUAS
1	680	54	LA CUCAHUALA	LA CUCAHUALA
1	720	54	CASCAJAL	CASCAJAL
3	720	54	LA VICTORIA	LA VICTORIA
6	720	54	SAN MARTIN DE LOBA	SAN MARTIN DE LOBA
9	720	54	LA CRISTALINA	LA CRISTALINA
12	720	54	CAMPO RICO	CAMPO RICO
14	720	54	EL RIECITO	EL RIECITO
5	261	54	LA ALEJANDRA	LA ALEJANDRA
1	313	54	EL ROSARIO	EL ROSARIO
4	313	54	SANTA TERESITA	SANTA TERESITA
2	344	54	AGUA BLANCA	AGUA BLANCA
5	344	54	BUENOS AIRES	BUENOS AIRES
8	344	54	SAN JOSE DEL TARRA	SAN JOSE DEL TARRA
3	347	54	LA SIERRA	LA SIERRA
2	377	54	SANTA MARIA	SANTA MARIA
3	385	54	PUEBLO NUEVO	PUEBLO NUEVO
2	398	54	ASPASICA	ASPASICA
4	398	54	CURASICA	CURASICA
2	405	54	LA MAQUINARIA	LA MAQUINARIA
2	418	54	SAN ISIDRO	SAN ISIDRO
1	480	54	LA LAGUNA	LA LAGUNA
1	498	54	AGUA LA VIRGEN	AGUA LA VIRGEN
3	498	54	ALTO D L PATIOS	ALTO D L PATIOS
6	498	54	BUENAVISTA	BUENAVISTA
8	498	54	LA ERMITA	LA ERMITA
11	498	54	MARIQUITA	MARIQUITA
13	498	54	EL PALMAR	EL PALMAR
15	498	54	SINAGU	SINAGU
3	206	54	EL HOYO	EL HOYO
5	206	54	LAS MERCEDES	LAS MERCEDES
9	206	54	SAN JOSE DE PITA	SAN JOSE DE PITA
12	206	54	LA VEGA	LA VEGA
14	206	54	HONDURAS	HONDURAS
16	206	54	MIRAFLORES	MIRAFLORES
2	223	54	SAN JOSE DE LA MONTANA	SAN JOSE DE LA MONTA?A
3	239	54	LA CUCHILLA	LA CUCHILLA
5	239	54	LA TRINIDAD	LA TRINIDAD
2	245	54	BELLALUZ	BELLALUZ
5	245	54	EL ZUL	EL ZUL
7	245	54	LA LATA	LA LATA
9	245	54	LA PELOTA	LA PELOTA
15	807	23	SAN LORENZO	SAN LORENZO
18	807	23	SANTA RITA HACHI	SANTA RITA HACHI
21	807	23	DOS MARIAS	DOS MARIAS
23	807	23	LOS VOLCANES	LOS VOLCANES
25	807	23	CERRO L MUJERES	CERRO L MUJERES
28	807	23	VILLA PROVIDENCIA	VILLA PROVIDENCIA
30	807	23	SANT.ISABEL D.RIO MANSO	SANT.ISABEL D.RIO MANSO
6	855	23	MATA DE MAIZ	MATA DE MAIZ
35	660	23	EL TREINTA Y CINCO	EL TREINTA Y CINCO
2	670	23	CALLE LARGA	CALLE LARGA
5	670	23	LOS CARRETOS	LOS CARRETOS
8	670	23	NUEVA ESTRELLA	NUEVA ESTRELLA
10	670	23	SAN JUAN DE LA CRUZ	SAN JUAN DE LA CRUZ
15	670	23	LOS CASTILLOS	LOS CASTILLOS
18	670	23	VILLANUEVA	VILLANUEVA
20	670	23	MARTILLO	MARTILLO
22	670	23	CRUZ CHIQUITA	CRUZ CHIQUITA
25	670	23	CRUZ DE GUAYABO	CRUZ DE GUAYABO
1	672	23	EL PORVENIR	EL PORVENIR
3	672	23	NUEVO AGRADO	NUEVO AGRADO
6	672	23	PIJAITO	PIJAITO
3	675	23	PASO NUEVO	PASO NUEVO
2	865	86	LA DORADA	LA DORADA
5	865	86	SAN ANTONIO	SAN ANTONIO
7	865	86	SANTANDER ROSA SUCUMBIOS	SANTANDER ROSA SUCUMBIOS
1	1	88	LA LOMA	LA LOMA
1	1	91	SANTA SOFIA	SANTA SOFIA
4	1	91	ANCA	ANCA
2	263	91	PUERTO ALEGRIA	PUERTO ALEGRIA
5	1	94	GUASACAVI	GUASACAVI
7	1	94	PUERTO CAMANAOS	PUERTO CAMANAOS
1	1	95	GUAYABERO	GUAYABERO
4	1	95	BOCAS DE INIRIDA	BOCAS DE INIRIDA
8	1	95	PUERTO NUEVO	PUERTO NUEVO
10	1	95	PUERTO OSPINA	PUERTO OSPINA
13	1	95	SAN FRANCISCO	SAN FRANCISCO
15	1	95	CAPRICHO	CAPRICHO
18	1	95	TOMACHIPAN	TOMACHIPAN
11	1	13	SAN SEBASTIAN	SAN SEBASTIAN
14	1	13	PUNTA ARENAS	PUNTA ARENAS
17	1	13	ARCHIP.DE SAN BERNARDO	ARCHIP.DE SAN BERNARDO
1	6	13	BERMUDEZ	BERMUDEZ
4	6	13	CAIMITAL	CAIMITAL
6	6	13	GALINDO	GALINDO
8	6	13	GUAMO	GUAMO
11	6	13	PLAYA ALTA	PLAYA ALTA
13	6	13	RIONEGRO	RIONEGRO
16	6	13	TENCHE	TENCHE
18	6	13	VILLA URIBE	VILLA URIBE
21	6	13	BUENOS AIRES	BUENOS AIRES
23	6	13	MEJICO	MEJICO
25	6	13	SAN AGUSTIN	SAN AGUSTIN
28	6	13	ASTILLEROS	ASTILLEROS
30	6	13	CENTRO ALEGRE	CENTRO ALEGRE
32	6	13	PUEBLO LINDO	PUEBLO LINDO
35	6	13	SANTA LUCIA	SANTA LUCIA
37	6	13	RIO NEGRO	RIO NEGRO
2	52	13	GAMBOTE	GAMBOTE
2	74	13	LA PACHA	LA PACHA
4	74	13	SAN ANTONIO	SAN ANTONIO
2	140	13	BARRANCA NUEVA	BARRANCA NUEVA
4	140	13	HATO VIEJO	HATO VIEJO
1	549	8	AGUASVIVAS	AGUASVIVAS
1	558	8	PITALITO	PITALITO
2	560	8	MARTILLO	MARTILLO
4	560	8	SANTA RITA	SANTA RITA
6	560	8	LAS FLORES	LAS FLORES
2	573	8	SALGAR	SALGAR
2	606	8	CIEN PESOS	CIEN PESOS
5	606	8	VILLA ROSA	VILLA ROSA
1	638	8	AGUADA DE PABLO	AGUADA DE PABLO
5	638	8	LA PENA*GUAJARO	LA PE?A*GUAJARO
8	638	8	GALLEGO	GALLEGO
1	75	19	LA PLANADA	LA PLANADA
2	75	19	OLAYA	OLAYA
3	75	19	SAN ALFONSO	SAN ALFONSO
5	75	19	LA BERMEJA	LA BERMEJA
6	75	19	PURETO	PURETO
7	75	19	GUADALITO	GUADALITO
1	100	19	CAPELLANIAS	CAPELLANIAS
3	100	19	CHALGUAYACO	CHALGUAYACO
5	100	19	EL CARMEN	EL CARMEN
6	100	19	EL RODEO	EL RODEO
9	100	19	LA MEDINA	LA MEDINA
10	100	19	LA PLAYA	LA PLAYA
11	100	19	LAS CASCADAS	LAS CASCADAS
12	100	19	LAS CEJAS	LAS CEJAS
14	100	19	LOS POTREROS	LOS POTREROS
16	100	19	LOS RASTROJOS	LOS RASTROJOS
18	100	19	MELCHOR	MELCHOR
20	100	19	SAN JUAN	SAN JUAN
21	100	19	SAN LORENZO	SAN LORENZO
23	100	19	SUCRE	SUCRE
24	100	19	TACHUELO	TACHUELO
26	100	19	LOS TIGRES	LOS TIGRES
27	100	19	BAJO LLANO	BAJO LLANO
29	100	19	MORALES	MORALES
31	100	19	PORTACHUELO	PORTACHUELO
33	100	19	RIO NEGRO	RIO NEGRO
34	100	19	EL COCAL	EL COCAL
36	100	19	EL SILENCIO	EL SILENCIO
37	100	19	EL TAMBO	EL TAMBO
39	100	19	ANGONI	ANGONI
41	100	19	LA CARBONERA	LA CARBONERA
42	100	19	LADERAS	LADERAS
43	100	19	YUNGUILLAS	YUNGUILLAS
45	100	19	LA PARADA	LA PARADA
2	110	19	AURES	AURES
3	110	19	BETULIA	BETULIA
3	753	18	BARSILLA	BARSILLA
5	753	18	LAS PAVAS	LAS PAVAS
6	753	18	EL RECREO	EL RECREO
8	753	18	GUAYABAL	GUAYABAL
9	753	18	PUERTO BETANIA	PUERTO BETANIA
11	753	18	LOS POZOS	LOS POZOS
3	765	18	CURIPLAYA	CURIPLAYA
4	765	18	DANUBIO	DANUBIO
6	765	18	CUEMANI	CUEMANI
1	860	18	SANTIAGO	SANTIAGO
1	1	19	CAJETE	CAJETE
2	1	19	CALIBIO	CALIBIO
4	1	19	EL PLACER	EL PLACER
5	1	19	EL TABLON	EL TABLON
7	1	19	JULUMITO	JULUMITO
9	1	19	LA YUNGA	LA YUNGA
11	1	19	LAS PIEDRAS	LAS PIEDRAS
13	1	19	PUEBLILLO	PUEBLILLO
14	1	19	PUELENJE	PUELENJE
15	1	19	QUINTANA	QUINTANA
17	1	19	SAN RAFAEL	SAN RAFAEL
19	1	19	SANTA ROSA	SANTA ROSA
21	1	19	EL SENDERO	EL SENDERO
23	1	19	LA MESETA	LA MESETA
24	1	19	EL CANELO	EL CANELO
2	22	19	EL PENOL	EL PE?OL
3	22	19	EL TABLON	EL TABLON
5	22	19	SAN JORGE	SAN JORGE
7	22	19	LA PALIZADA	LA PALIZADA
9	22	19	SAUJI	SAUJI
10	22	19	GONZALO	GONZALO
11	22	19	HUMOS	HUMOS
1	50	19	EL MANGO	EL MANGO
3	50	19	BETANIA	BETANIA
4	50	19	BOLIVIA	BOLIVIA
6	50	19	EL PLATEADO	EL PLATEADO
5	867	17	EL LLANO	EL LLANO
6	867	17	FIERRITOS	FIERRITOS
2	873	17	EL PINDO	EL PINDO
3	873	17	LLANITOS	LLANITOS
6	873	17	SAN JULIAN	SAN JULIAN
8	873	17	ALTO VIYARAZO	ALTO VIYARAZO
10	873	17	GALLINAZO	GALLINAZO
1	877	17	LA MARIA	LA MARIA
3	877	17	CANAAN	CANAAN
4	877	17	EL DALMAR	EL DALMAR
1	1	18	ALTO ORTEGUAZA	ALTO ORTEGUAZA
27	615	68	LOS CHORROS	LOS CHORROS
30	615	68	MONTANITAS	MONTA?ITAS
33	615	68	SAN JOSE D AREVALO	SAN JOSE D AREVALO
35	615	68	PUENTE TIERRA	PUENTE TIERRA
2	655	68	SABANETA	SABANETA
4	655	68	PROVINCIA	PROVINCIA
7	655	68	MAGARA	MAGARA
8	655	68	PAYOA	PAYOA
10	655	68	MATA DE PINA	MATA DE PI?A
2	669	68	CAIRASCO	CAIRASCO
3	669	68	EL PIRE	EL PIRE
20	1	95	TURPIAL	TURPIAL
1	25	95	LA LIBERTAD	LA LIBERTAD
3	25	95	CERRITOS	CERRITOS
4	25	95	MORICHAL	MORICHAL
2	200	95	LAGOS DEL DORADO	LAGOS DEL DORADO
2	1	97	CAMANAOS	CAMANAOS
4	1	97	TIQUIE	TIQUIE
1	161	97	YURUPARI	YURUPARI
2	1	99	CASUARITO	CASUARITO
3	1	99	PUERTO MURILLO	PUERTO MURILLO
1	758	8	MESOLADIN	MESOLADIN
2	832	8	EL MORRO	EL MORRO
4	832	8	JUARUCO	JUARUCO
2	1	11	NAZARETH	NAZARETH
4	1	11	ISMAEL PERDOMO	ISMAEL PERDOMO
1	1	13	ARROYO DE PIEDRA	ARROYO DE PIEDRA
9	773	68	SANTA ELENA	SANTA ELENA
11	773	68	EL PORVENIR	EL PORVENIR
8	780	68	TURBAY	TURBAY
2	820	68	LA CORCOVA	LA CORCOVA
5	820	68	GRAMAL	GRAMAL
6	820	68	PUERTO DEL LLANO	PUERTO DEL LLANO
4	855	68	EL CERRO	EL CERRO
2	861	68	GUALILO	GUALILO
6	861	68	PALO BLANCO	PALO BLANCO
20	861	68	LOS EJIDOS	LOS EJIDOS
24	861	68	LOS GUAYABOS	LOS GUAYABOS
1	895	68	LA FUENTE	LA FUENTE
2	1	70	CRUZ DEL BEQUE	CRUZ DEL BEQUE
5	1	70	LA ARENA	LA ARENA
7	1	70	LA GALLERA	LA GALLERA
9	1	70	LAGUNA FLOR	LAGUNA FLOR
2	1	88	SAN LUIS	SAN LUIS
2	1	91	NAZARET	NAZARET
3	1	91	RIO CALDERON	RIO CALDERON
1	405	91	PUERTO ARICA	PUERTO ARICA
1	540	91	ATACUARI	ATACUARI
3	1	94	EL COCO	EL COCO
8	1	94	BARRANCO PICURE	BARRANCO PICURE
1	343	94	MAPIRIPANA	MAPIRIPANA
2	1	95	LA FUGA	LA FUGA
3	1	95	TEVIARE	TEVIARE
6	1	95	LAS GUACAMAYAS	LAS GUACAMAYAS
9	1	95	PUERTO ARTURO	PUERTO ARTURO
11	1	95	PUERTO CACHICAMO	PUERTO CACHICAMO
12	1	95	ARAGUATO	ARAGUATO
14	1	95	LA LINDOSA	LA LINDOSA
16	1	95	CHARRAS	CHARRAS
17	1	95	CARACOL	CARACOL
19	1	95	MOCUARE	MOCUARE
12	1	13	SANTA ANA	SANTA ANA
13	1	13	TIERRA BOMBA	TIERRA BOMBA
15	1	13	ARARCA	ARARCA
16	1	13	LETICIA	LETICIA
18	1	13	EL RECREO	EL RECREO
19	1	13	PUERTO REY	PUERTO REY
2	6	13	BOYACA	BOYACA
3	6	13	BUENAVISTA	BUENAVISTA
5	6	13	EL ALGARROBO	EL ALGARROBO
7	6	13	GUACAMAYO	GUACAMAYO
9	6	13	LA RAYA	LA RAYA
12	6	13	REGENERACION	REGENERACION
15	6	13	TACUYALTA	TACUYALTA
17	6	13	TRES CRUCES	TRES CRUCES
19	6	13	PAYANDE	PAYANDE
20	6	13	RIO NUEVO	RIO NUEVO
22	6	13	PUERTO ISABEL	PUERTO ISABEL
24	6	13	PUEBLO NUEVO	PUEBLO NUEVO
26	6	13	BETANIA	BETANIA
27	6	13	RANGEL	RANGEL
29	6	13	PALENQUILLO	PALENQUILLO
31	6	13	PLATANAL	PLATANAL
33	6	13	PUERTO VENECIA	PUERTO VENECIA
34	6	13	SAN MATEO	SAN MATEO
36	6	13	TABURETERA	TABURETERA
1	52	13	PUERTO BADEL	PUERTO BADEL
3	52	13	ROCHA	ROCHA
4	52	13	SINCERIN	SINCERIN
3	74	13	RIONUEVO	RIONUEVO
5	74	13	LOS CERRITOS	LOS CERRITOS
3	140	13	BARRANCA VIEJA	BARRANCA VIEJA
5	140	13	MACHADO	MACHADO
1	520	8	BURRUSCO	BURRUSCO
2	549	8	EL CERRITO	EL CERRITO
3	549	8	HIBACHARO	HIBACHARO
1	560	8	LA RETIRADA	LA RETIRADA
3	789	5	SANTA ANA	SANTA ANA
5	789	5	SAN LUIS	SAN LUIS
7	789	5	SANTA TERESA	SANTA TERESA
2	790	5	EL DOCE	EL DOCE
3	790	5	PUERTO ANTIOQUIA	PUERTO ANTIOQUIA
1	792	5	MORRON	MORRON
2	792	5	CANAAN	CANAAN
4	792	5	LA LINDA	LA LINDA
1	809	5	ANTONIO JOSE	ANTONIO JOSE
2	809	5	EL LIBANO	EL LIBANO
3	809	5	OTRAMINA	OTRAMINA
5	809	5	CORCOVADO	CORCOVADO
1	819	5	BUENAVISTA	BUENAVISTA
3	819	5	EL BRUJO	EL BRUJO
4	819	5	LA LINDA	LA LINDA
2	837	5	NUEVA COLONIA	NUEVA COLONIA
5	837	5	SAN VICENTE	SAN VICENTE
6	837	5	TIE	TIE
8	837	5	SAN JOSE	SAN JOSE
9	837	5	RIOGRANDE	RIOGRANDE
11	837	5	EL DOS	EL DOS
12	837	5	PUEBLO BELLO	PUEBLO BELLO
4	670	5	FRAYLES	FRAYLES
3	674	5	LA MAGDALENA	LA MAGDALENA
1	679	5	DAMASCO	DAMASCO
2	679	5	EL CAIRO	EL CAIRO
6	679	5	TRECE DE JUNIO	TRECE DE JUNIO
8	679	5	LOS ALMENDROS	LOS ALMENDROS
1	686	5	ARAGON	ARAGON
4	686	5	SAN ISIDRO	SAN ISIDRO
6	686	5	SAN PABLO	SAN PABLO
7	686	5	LAS PAYAS	LAS PAYAS
1	690	5	BOTERO	BOTERO
2	690	5	EL LIMON	EL LIMON
3	690	5	PORCECITO	PORCECITO
6	555	73	BRUSELAS	BRUSELAS
2	563	73	CATALAN	CATALAN
4	563	73	MONTOSO	MONTOSO
1	585	73	CHENCHE ASOLEADO	CHENCHE ASOLEADO
3	585	73	PENONES ALTOS	PENONES ALTOS
6	585	73	VILLA ESPERANZA	VILLA ESPERANZA
8	585	73	LA COYA	LA COYA
9	585	73	EL BAURA	EL BAURA
11	585	73	LAS DAMAS	LAS DAMAS
12	585	73	LA OVEJERA	LA OVEJERA
14	585	73	EL TAMBO	EL TAMBO
16	585	73	CAIRO SOCORRO	CAIRO SOCORRO
2	616	73	PUERTO SALDANA	PUERTO SALDANA
3	283	73	EL TABLAZO	EL TABLAZO
5	283	73	PAVAS	PAVAS
6	283	73	LOS ANDES	LOS ANDES
1	319	73	CERROGORDO	CERROGORDO
2	319	73	LA CHAMBA	LA CHAMBA
7	720	54	SAN ROQUE	SAN ROQUE
8	720	54	BALSAMINA	BALSAMINA
10	720	54	PARAMILLO	PARAMILLO
11	720	54	RIO NUEVO	RIO NUEVO
13	720	54	EL HIGUERON	EL HIGUERON
15	720	54	EL VESUBIO	EL VESUBIO
16	720	54	FATIMA	FATIMA
6	261	54	LAS PIEDRAS	LAS PIEDRAS
2	313	54	EL ZUMBADOR	EL ZUMBADOR
3	313	54	SAN ISIDRO	SAN ISIDRO
1	344	54	ASTILLEROS	ASTILLEROS
3	344	54	MARACAIBO	MARACAIBO
4	344	54	MARTINEZ	MARTINEZ
6	344	54	SAN MIGUEL	SAN MIGUEL
7	344	54	MECA RICA	MECA RICA
1	347	54	HONDA SUR	HONDA SUR
2	347	54	SIBERIA	SIBERIA
1	377	54	LA CUCHILLA	LA CUCHILLA
1	385	54	LA PEDREGOZA	LA PEDREGOZA
2	385	54	LEON XIII	LEON XIII
4	385	54	VEINTE DE JULIO	VEINTE DE JULIO
3	398	54	EL CINCHO	EL CINCHO
5	398	54	MACIEGAS	MACIEGAS
1	405	54	LA GARITA	LA GARITA
1	418	54	EL MIRADOR	EL MIRADOR
4	418	54	LA PAJUILA	LA PAJUILA
5	418	54	CAMPO RICO	CAMPO RICO
2	480	54	SUCRE	SUCRE
2	498	54	AGUAS CLARAS	AGUAS CLARAS
4	498	54	ALTO DEL LUCERO	ALTO DEL LUCERO
5	498	54	BROTARE	BROTARE
7	498	54	CERRO LA FLORES	CERRO LA FLORES
9	498	54	LA FLORESTA	LA FLORESTA
10	498	54	LOMA LARGA	LOMA LARGA
12	498	54	PUEBLO NUEVO	PUEBLO NUEVO
14	498	54	GUAYABAL	GUAYABAL
2	206	54	CARTAGENA	CARTAGENA
4	206	54	GUAMAL	GUAMAL
7	206	54	MESA RICA	MESA RICA
8	206	54	SOLEDAD	SOLEDAD
10	206	54	LA ESPERANZA	LA ESPERANZA
11	206	54	LA LIBERTAD	LA LIBERTAD
13	206	54	PIEDECUESTA	PIEDECUESTA
15	206	54	LA TRINIDAD	LA TRINIDAD
2	15	85	TEGUITA	TEGUITA
1	125	85	CORRALITO	CORRALITO
1	1	81	CLARINETERO	CLARINETERO
3	1	81	FLOR AMARILLA	FLOR AMARILLA
4	1	81	LA SAYA	LA SAYA
7	1	81	VILLANUEVA*CARA	VILLANUEVA*CARA
8	1	81	EL ELE	EL ELE
9	1	81	ROSARIO	ROSARIO
11	1	81	CABUYARE	CABUYARE
12	1	81	LIPA	LIPA
13	1	81	MAPORIYAL	MAPORIYAL
15	1	81	LA BECERRA	LA BECERRA
1	65	81	CARRETERO	CARRETERO
3	65	81	LOS ANGELITOS	LOS ANGELITOS
5	65	81	LA PAZ	LA PAZ
6	65	81	LOS PAJAROS	LOS PAJAROS
1	834	76	AGUACLARA	AGUACLARA
3	834	76	BARRAGAN	BARRAGAN
5	834	76	EL PICACHO	EL PICACHO
6	834	76	EL RETIRO	EL RETIRO
8	834	76	LA DIADEMA	LA DIADEMA
10	834	76	LA MARINA	LA MARINA
11	834	76	LA MORALIA	LA MORALIA
13	834	76	LOS CAIMOS	LOS CAIMOS
15	834	76	MONTELORO	MONTELORO
16	834	76	NARINO	NARI?O
17	834	76	QUEBRADAGRANDE	QUEBRADAGRANDE
18	834	76	SAN CARLOS	SAN CARLOS
19	834	76	SAN LORENZO	SAN LORENZO
20	834	76	SAN RAFAEL	SAN RAFAEL
21	834	76	SANTA LUCIA	SANTA LUCIA
22	834	76	TOCHECITO	TOCHECITO
23	834	76	TRES ESQUINAS	TRES ESQUINAS
24	834	76	VENUS	VENUS
25	834	76	CAMPOALEGRE	CAMPOALEGRE
26	834	76	LA RIVERA	LA RIVERA
27	834	76	JICARAMATA	JICARAMATA
1	845	76	CHAPINERO	CHAPINERO
2	845	76	MONTEZUMA	MONTEZUMA
3	845	76	EL PLACER	EL PLACER
4	845	76	CALAMONTE	CALAMONTE
5	845	76	DINAMARCA	DINAMARCA
6	845	76	EL BRILLANTE	EL BRILLANTE
1	863	76	CAMPOALEGRE	CAMPOALEGRE
2	863	76	EL BALSAL	EL BALSAL
3	863	76	EL CEDRO	EL CEDRO
4	863	76	EL DIAMANTE	EL DIAMANTE
5	863	76	EL VERGEL	EL VERGEL
6	863	76	GUAIRA ABAJO	GUAIRA ABAJO
7	863	76	LA FLORIDA	LA FLORIDA
8	863	76	LA GUAVIA	LA GUAVIA
9	863	76	MORRO ATO	MORRO ATO
11	245	54	LA ESTRELLA	LA ESTRELLA
14	245	54	MARACAIBO	MARACAIBO
16	245	54	QUEBRADA ARRIBA	QUEBRADA ARRIBA
19	245	54	VEGAS MOTILONIA	VEGAS MOTILONIA
22	245	54	EL CAJON	EL CAJON
1	250	54	NUEVA GRANADA	NUEVA GRANADA
3	261	54	SAN MIGUEL	SAN MIGUEL
12	3	54	SAN ALBERTO	SAN ALBERTO
14	3	54	SAN VICENTE	SAN VICENTE
17	3	54	EL HIGUERON	EL HIGUERON
19	3	54	MONTECRISTO	MONTECRISTO
22	3	54	EL LORO	EL LORO
2	51	54	CASTRO	CASTRO
5	51	54	VILLA SUCRE	VILLA SUCRE
8	51	54	LOS MOLINOS	LOS MOLINOS
2	99	54	LA DONJUANA	LA DONJUANA
4	99	54	PORTACHUELO	PORTACHUELO
3	109	54	LA SANJUANA	LA SANJUANA
5	109	54	LAS CUADRAS	LAS CUADRAS
3	125	54	TARGUALA	TARGUALA
4	3	54	EL LLANON	EL LLANON
10	3	54	LA MARIA	LA MARIA
1	563	76	BOLIVAR	BOLIVAR
3	563	76	BOLO BLANCO	BOLO BLANCO
6	563	76	EL HIGUERONAL	EL HIGUERONAL
8	563	76	EL NOGAL	EL NOGAL
12	563	76	LA RUIZA	LA RUIZA
14	563	76	LOMITAS	LOMITAS
16	563	76	MURILLO	MURILLO
19	563	76	SAN ISIDRO	SAN ISIDRO
21	563	76	LA FLORESTA	LA FLORESTA
6	318	76	PICHICHI	PICHICHI
8	318	76	SONSO	SONSO
10	318	76	PUENTE ROJO	PUENTE ROJO
1	364	76	AMPUDIA	AMPUDIA
2	364	76	BOCAS DE PALO	BOCAS DE PALO
5	364	76	PASO DE L BOLSA	PASO DE L BOLSA
8	364	76	PUENTE VELEZ	PUENTE VELEZ
11	364	76	SAN ANTONIO	SAN ANTONIO
14	364	76	VILLA COLOMBIA	VILLA COLOMBIA
1	377	76	BITACO	BITACO
3	377	76	LOMITAS	LOMITAS
5	377	76	PUENTE PALO	PUENTE PALO
7	377	76	SAN SALVADOR	SAN SALVADOR
4	400	76	LA DESPENSA	LA DESPENSA
6	400	76	SAN LUIS	SAN LUIS
2	403	76	HOLANDA	HOLANDA
4	403	76	MIRAVALLES	MIRAVALLES
7	403	76	SAN PEDRO	SAN PEDRO
9	403	76	TAGUALES	TAGUALES
3	497	76	JUAN DIAZ	JUAN DIAZ
5	497	76	MOLINA	MOLINA
6	497	76	PUERTO SAMARIA	PUERTO SAMARIA
9	497	76	SAN JOSE	SAN JOSE
1	520	76	AGUACLARA	AGUACLARA
13	248	76	LOS ANDES	LOS ANDES
15	248	76	EL CARMEN	EL CARMEN
2	250	76	BERLIN	BERLIN
5	250	76	LA CABANA	LA CABA?A
7	250	76	LITUANIA	LITUANIA
9	250	76	SANTA TERESA	SANTA TERESA
12	250	76	PLAYA RICA	PLAYA RICA
14	250	76	CALLE LARGA	CALLE LARGA
17	250	76	EL CRUCERO	EL CRUCERO
10	246	76	BOQUERON	BOQUERON
12	246	76	ALTO BONITO	ALTO BONITO
3	248	76	EL CASTILLO	EL CASTILLO
6	248	76	EL POMO	EL POMO
9	248	76	SANTA ELENA	SANTA ELENA
9	122	76	ALTO BARRAGAN	ALTO BARRAGAN
2	126	76	EL DIAMANTE	EL DIAMANTE
5	126	76	LA CRISTALINA	LA CRISTALINA
8	126	76	LA GUAIRA	LA GUAIRA
10	126	76	LA SAMARIA	LA SAMARIA
13	126	76	PUENTE TIERRA	PUENTE TIERRA
16	126	76	PRIMAVERA	PRIMAVERA
1	130	76	BUCHITOLO	BUCHITOLO
3	130	76	EL CABUYAL	EL CABUYAL
6	130	76	EL TIPLE	EL TIPLE
8	130	76	LA GORGONA	LA GORGONA
10	130	76	LA SOLORZA	LA SOLORZA
12	130	76	SAN JOAQUIN	SAN JOAQUIN
3	147	76	COLORADAS	COLORADAS
6	147	76	PIEDRA DE MOLER	PIEDRA DE MOLER
8	147	76	SAN JOAQUIN	SAN JOAQUIN
1	233	76	ATUNCELAS	ATUNCELAS
3	233	76	CENTELLA	CENTELLA
5	233	76	EL CARMEN	EL CARMEN
7	233	76	EL LIMONAR	EL LIMONAR
10	233	76	EL PINAL	EL PI?AL
12	233	76	EL SALADO	EL SALADO
14	233	76	LA CASCADA	LA CASCADA
32	109	76	SAN FRANCISCO DE NAYA	SAN FRANCISCO DE NAYA
35	109	76	SAN JOSE ANCHICAYA	SAN JOSE ANCHICAYA
38	109	76	SILVA	SILVA
40	109	76	VENERAL	VENERAL
42	109	76	ZABALETAS	ZABALETAS
44	109	76	CABECERA RIO SAN JUAN	CABECERA RIO SAN JUAN
4	111	76	EL SALADO	EL SALADO
7	111	76	LA MARIA	LA MARIA
9	111	76	MIRAFLORES	MIRAFLORES
11	111	76	NOGALES	NOGALES
13	111	76	RIOLORO	RIOLORO
15	111	76	EL CRUCERO	EL CRUCERO
17	111	76	LA PLAYA DEL BUEY	LA PLAYA DEL BUEY
2	113	76	CHORRERAS	CHORRERAS
4	113	76	EL OVERO	EL OVERO
6	113	76	EL ROCIO	EL ROCIO
8	113	76	GALICIA	GALICIA
11	113	76	PAILA ARRIBA	PAILA ARRIBA
13	113	76	URIBE URIBE	URIBE URIBE
1	122	76	AURES	AURES
3	122	76	EL CRUCERO	EL CRUCERO
5	122	76	MONTEGRANDE	MONTEGRANDE
8	122	76	LA CAMELIA	LA CAMELIA
6	773	68	LA FLORESTA	LA FLORESTA
22	79	52	SAN JUAN PALACIO	SAN JUAN PALACIO
23	79	52	NAMBI	NAMBI
1	83	52	SANTANDER ROSA	SANTANDER ROSA
90	835	52	SAN JACINTO	SAN JACINTO
92	835	52	ALTO AGUACLARA	ALTO AGUACLARA
94	835	52	NUEVA BRISA	NUEVA BRISA
96	835	52	PLAYA DEL CABALLO	PLAYA DEL CABALLO
99	835	52	INGUAPI DEL CARMEN	INGUAPI DEL CARMEN
103	835	52	EL COCO	EL COCO
105	835	52	ALBANIA	ALBANIA
107	835	52	BAJO CHILVI	BAJO CHILVI
109	835	52	BRISA D ACUEDUCTO	BRISA D ACUEDUCTO
112	835	52	CORRIENTE GRANDE	CORRIENTE GRANDE
114	835	52	EL ESTERO(SAN VICENTE)	EL ESTERO(SAN VICENTE)
118	835	52	EL MORRITO	EL MORRITO
121	835	52	KILOMETRO 28	KILOMETRO 28
123	835	52	KILOMETRO 41	KILOMETRO 41
126	835	52	LA CHORRERA	LA CHORRERA
129	835	52	LAS CARGAS	LAS CARGAS
131	835	52	MAJAGUA	MAJAGUA
134	835	52	PACORA	PACORA
136	835	52	PLAYON	PLAYON
138	835	52	S ANT D CURAY	S ANT D CURAY
8	1	13	LA BOQUILLA	LA BOQUILLA
10	1	13	PUNTA DE CANOA	PUNTA DE CANOA
1	574	23	CRISTO REY	CRISTO REY
3	574	23	SAN JOSE CANALE	SAN JOSE CANALE
1	223	54	PUENTE JULIO A.	PUENTE JULIO A.
4	223	54	ROMAN	ROMAN
1	239	54	CUAJADORAS	CUAJADORAS
2	239	54	HATOVIEJO	HATOVIEJO
4	239	54	LA MONTUOSA	LA MONTUOSA
6	239	54	LA UNION	LA UNION
1	245	54	ASTILLERO	ASTILLERO
3	245	54	CULEBRITA	CULEBRITA
4	245	54	EL COBRE	EL COBRE
6	245	54	GUAMALITO	GUAMALITO
8	245	54	LA OSA	LA OSA
10	245	54	LA QUIEBRA	LA QUIEBRA
12	245	54	LAS AGUILAS	LAS AGUILAS
13	245	54	LAS VEGAS	LAS VEGAS
15	245	54	PAJITAS	PAJITAS
17	245	54	SANTO DOMINGO	SANTO DOMINGO
18	245	54	SANTA INES	SANTA INES
20	245	54	LA CAMORRA	LA CAMORRA
21	245	54	QUEBRADA HONDA	QUEBRADA HONDA
2	250	54	ORU	ORU
1	261	54	ENCERRADEROS	ENCERRADEROS
2	261	54	PAN DE AZUCAR	PAN DE AZUCAR
4	261	54	CAMPO ALICIA	CAMPO ALICIA
13	3	54	SAN JOSE	SAN JOSE
15	3	54	EL CAIRO	EL CAIRO
16	3	54	EL GUAMAL	EL GUAMAL
18	3	54	EL TARRA	EL TARRA
20	3	54	SAN PABLO	SAN PABLO
21	3	54	LA SIERRA	LA SIERRA
1	51	54	BARRIENTOS	BARRIENTOS
3	51	54	CINERA	CINERA
4	51	54	UVITO	UVITO
6	51	54	LA UVITA	LA UVITA
7	51	54	GUZAMAN	GUZAMAN
1	99	54	ESPEJUELOS	ESPEJUELOS
3	99	54	MONTERREDONDO	MONTERREDONDO
1	109	54	AGUABLANCA	AGUABLANCA
4	516	15	ROMITA	ROMITA
6	516	15	EL VENADO	EL VENADO
1	518	15	CORINTO	CORINTO
1	531	15	AGUAFRIA	AGUAFRIA
3	531	15	TOPAGRANDE-	TOPAGRANDE-
1	537	15	PAZ VIEJO	PAZ VIEJO
2	542	15	EL HATO	EL HATO
1	572	15	AGUA NEGRO	AGUA NEGRO
3	572	15	POZO BOYACA	POZO BOYACA
5	572	15	PUERTO GUTIERRE	PUERTO GUTIERRE
7	572	15	PUERTO SERVIEZ	PUERTO SERVIEZ
8	572	15	EL PESCADO	EL PESCADO
1	317	15	LA PALMA	LA PALMA
2	317	15	CHICHIMITA	CHICHIMITA
2	322	15	GAUNZA ABAJO	GAUNZA ABAJO
9	90	23	CORDOBITA FRONTO	CORDOBITA FRONTO
11	90	23	EL AGUILA	EL AGUILA
12	90	23	EL CLAVO	EL CLAVO
14	90	23	LA ALCANCIA	LA ALCANCIA
16	90	23	LA LORENZA	LA LORENZA
18	90	23	PASO DEL MONO	PASO DEL MONO
19	90	23	PUEBLO MONO	PUEBLO MONO
21	90	23	URANGO	URANGO
1	162	23	MARTINEZ	MARTINEZ
3	162	23	RABOLARGO	RABOLARGO
4	162	23	SEVERA	SEVERA
6	162	23	RETIRO D INDIOS	RETIRO D INDIOS
8	162	23	LAS MUJERES	LAS MUJERES
10	162	23	EL CHORRILLO	EL CHORRILLO
12	162	23	SAN ANTONIO	SAN ANTONIO
13	162	23	EL CEDRO	EL CEDRO
15	162	23	CARACAS	CARACAS
17	162	23	CANITO	CANITO
18	162	23	EL QUEMADO	EL QUEMADO
20	162	23	LOS VENADOS	LOS VENADOS
21	162	23	EL PUEBLO	EL PUEBLO
1	168	23	ARACHE	ARACHE
3	168	23	CAROLINA	CAROLINA
4	168	23	COROZALITO	COROZALITO
6	168	23	SITIOVIEJO	SITIOVIEJO
7	168	23	GUAYACAN	GUAYACAN
1	182	23	AGUAS VIVAS	AGUAS VIVAS
3	182	23	CARBONERO	CARBONERO
5	182	23	HEREDIA	HEREDIA
6	182	23	LOS ANGELES	LOS ANGELES
1	787	20	PALESTINA LANUEVA	PALESTINA LANUEVA
5	787	20	ZAPATOSA	ZAPATOSA
9	787	20	LAS PALMAS	LAS PALMAS
1	1	23	BUENOS AIRES	BUENOS AIRES
3	1	23	EL CERRITO	EL CERRITO
4	1	23	EL SABANAL	EL SABANAL
5	1	23	GUASIMAL	GUASIMAL
7	1	23	LA MANTA	LA MANTA
9	1	23	LETICIA	LETICIA
10	1	23	LOMA VERDE	LOMA VERDE
12	1	23	NUEVO PARAISO	NUEVO PARAISO
14	1	23	PATIO BONITO	PATIO BONITO
16	1	23	PUEBLO BUJO	PUEBLO BUJO
18	1	23	SANTA CLARA	SANTA CLARA
19	1	23	SANTA ISABEL	SANTA ISABEL
21	1	23	TRES PALMAS	TRES PALMAS
23	1	23	BUENAVENTURA	BUENAVENTURA
25	1	23	EL TRONCO	EL TRONCO
27	1	23	MACHIN	MACHIN
28	1	23	EL BALSAL	EL BALSAL
30	1	23	EL COCHUELO	EL COCHUELO
3	68	23	CECILIA	CECILIA
14	787	27	BETANIA	BETANIA
12	1	86	JOSE MARIA HERNANDEZ	JOSE MARIA HERNANDEZ
13	1	86	JAUNO	JAUNO
14	1	86	LA TEBAIDA	LA TEBAIDA
15	1	86	GALLINAZO	GALLINAZO
1	219	86	SAN PEDRO	SAN PEDRO
1	320	86	LA TESALIA	LA TESALIA
2	320	86	PORTUGAL	PORTUGAL
3	320	86	SAN JUAN VIDES	SAN JUAN VIDES
4	320	86	LUCITANIA	LUCITANIA
5	320	86	JARDINES SUCUMBIOS	JARDINES SUCUMBIOS
2	568	86	SAN ANTONIO DEL GUAMUEZ	SAN ANTONIO DEL GUAMUEZ
4	568	86	VILLA VICTORIA	VILLA VICTORIA
5	568	86	PINUNA BLANCO	PINUNA BLANCO
6	568	86	MEDIO	MEDIO
7	568	86	CUEMBI	CUEMBI
8	568	86	CAMPO BELLO	CAMPO BELLO
9	568	86	BUENOS AIRES	BUENOS AIRES
10	568	86	EL TIGRE	EL TIGRE
11	568	86	LA DORADA	LA DORADA
12	568	86	PAUJIL	PAUJIL
13	568	86	PUERTO COLON	PUERTO COLON
14	568	86	SAN MIGUEL	SAN MIGUEL
15	568	86	SANTA MARIA ALTO CUEMBI	SANTA MARIA ALTO CUEMBI
16	568	86	EL PLACER	EL PLACER
1	569	86	EL CEDRAL	EL CEDRAL
3	569	86	SAN PEDRO	SAN PEDRO
1	573	86	LA TAGUA	LA TAGUA
2	573	86	PUERTO OSPINA	PUERTO OSPINA
3	573	86	SENSELLA	SENSELLA
5	573	86	EL MECAYA	EL MECAYA
6	573	86	LA PAYA	LA PAYA
7	573	86	LAS DELICIAS	LAS DELICIAS
8	573	86	LA VICTORIA	LA VICTORIA
1	749	86	EL EJIDO	EL EJIDO
2	749	86	SAN PEDRO	SAN PEDRO
3	749	86	SAN FRANCISCO	SAN FRANCISCO
4	749	86	SAN ANTONIO	SAN ANTONIO
5	749	86	POROTOYOCA	POROTOYOCA
6	749	86	SANTIAGO	SANTIAGO
7	749	86	SAN ANDRES	SAN ANDRES
1	755	86	SAN ANTONIO DEL POROYAC	SAN ANTONIO DEL POROYAC
2	755	86	PATUYACO	PATUYACO
1	760	86	SAN ANDRES	SAN ANDRES
2	760	86	EL CASCAJO	EL CASCAJO
3	230	85	EL ALGARROBO	EL ALGARROBO
4	230	85	BANCO LARGO	BANCO LARGO
5	230	85	TUJUA	TUJUA
1	250	85	BOCAS DE LA HERMOSA	BOCAS DE LA HERMOSA
2	250	85	CENTRO GAITAN	CENTRO GAITAN
3	250	85	CANO CHIQUITO	CANO CHIQUITO
4	250	85	LA AGUADA	LA AGUADA
5	250	85	EL BORAL	EL BORAL
6	250	85	MONTANA DEL TOTUMO	MONTA?A DEL TOTUMO
7	250	85	LAS GUAMAS	LAS GUAMAS
8	250	85	RINCON HONDO	RINCON HONDO
9	250	85	SAN PABLO	SAN PABLO
10	250	85	AGUAVERDE	AGUAVERDE
1	263	85	EL BANCO	EL BANCO
2	263	85	LA PLATA	LA PLATA
1	279	85	LOS ALPES	LOS ALPES
2	279	85	PUEBLO NUEVO	PUEBLO NUEVO
1	300	85	AGUACLARA	AGUACLARA
3	300	85	EL SECRETO	EL SECRETO
1	325	85	LA VENTUROSA	LA VENTUROSA
2	325	85	BOCAS DE GUANAPALO	BOCAS DE GUANAPALO
3	325	85	GAVIOTAS QUITEVE	GAVIOTAS QUITEVE
2	400	85	TABLON DE TAMARA	TABLON DE TAMARA
3	400	85	TABLONCITO	TABLONCITO
1	410	85	EL ACEITE	EL ACEITE
2	410	85	SANTA MARIA	SANTA MARIA
4	410	85	TUNUPE	TUNUPE
2	430	85	GUAMAL	GUAMAL
3	430	85	CAIMAN	CAIMAN
4	430	85	LA LUCHA	LA LUCHA
6	430	85	BELGICA	BELGICA
1	440	85	CARIBAYONA	CARIBAYONA
3	440	85	SAN AGUSTIN	SAN AGUSTIN
1	1	86	CONDAGUA	CONDAGUA
2	1	86	EL PEPINO	EL PEPINO
4	1	86	PUERTO LIMON	PUERTO LIMON
5	1	86	QUINORO	QUINORO
7	1	86	SAN ROQUE	SAN ROQUE
9	1	86	YUNGUILLO	YUNGUILLO
10	1	86	MAYOYOQUE	MAYOYOQUE
6	1	85	MORICHAL	MORICHAL
8	1	85	TACARIMENA	TACARIMENA
9	1	85	BARBILLAL	BARBILLAL
2	10	85	MONTERRALO	MONTERRALO
5	10	85	SAN JOSE BUBUY	SAN JOSE BUBUY
6	10	85	UNETE	UNETE
7	10	85	BELLAVISTA	BELLAVISTA
8	10	85	GUADALCANAL	GUADALCANAL
3	632	15	PANTANOS	PANTANOS
4	632	15	EL MOLINO	EL MOLINO
5	632	15	VELANDIA	VELANDIA
1	664	15	SANTO DOMINGO	SANTO DOMINGO
2	664	15	MUNOCES Y CAMACHOS	MU?OCES Y CAMACHOS
1	667	15	SANTA TERESA	SANTA TERESA
2	667	15	GUAMAL	GUAMAL
3	667	15	HORIZONTES	HORIZONTES
4	667	15	MESA DEL GUAVIO	MESA DEL GUAVIO
5	667	15	SAN CARLOS	SAN CARLOS
1	673	15	EL CHAPETON	EL CHAPETON
1	676	15	QUINTOQUE	QUINTOQUE
2	676	15	EL CHARCO	EL CHARCO
1	681	15	CALAMACO	CALAMACO
2	681	15	CHANARES	CHANARES
3	681	15	LA PALMARONA	LA PALMARONA
4	681	15	PENAS BLANCAS	PE?AS BLANCAS
5	681	15	SANTA BARBARA	SANTA BARBARA
1	686	15	EL ESCOBAL	EL ESCOBAL
1	690	15	CANO NEGRO	CA?O NEGRO
2	690	15	CULIMA	CULIMA
6	690	15	NAZARETH	NAZARETH
2	693	15	EL IMPERIO	EL IMPERIO
1	720	15	SATIVA VIEJO	SATIVA VIEJO
2	720	15	LA JUPA	LA JUPA
1	469	15	LA LAJA	LA LAJA
2	469	15	PUENTE ROCADA	PUENTE ROCADA
3	469	15	PAJONALES	PAJONALES
4	469	15	MACIEGAL	MACIEGAL
5	469	15	PANTANILLO	PANTANILLO
6	469	15	UBAZA	UBAZA
3	480	15	VERDUN	VERDUN
1	491	15	BELENCITO	BELENCITO
1	507	15	BETANIA	BETANIA
2	507	15	BUENAVISTA	BUENAVISTA
4	507	15	PIZARRA	PIZARRA
8	507	15	CURUBITA	CURUBITA
1	514	15	LA URURIA	LA URURIA
2	514	15	SIRASI	SIRASI
2	516	15	EL VOLCAN	EL VOLCAN
1	88	17	EL MADRONO	EL MADRONO
2	88	17	QUEBRADA DE LA HABANA	QUEBRADA DE LA HABANA
3	88	17	SAN ISIDRO	SAN ISIDRO
4	88	17	LA CRISTALINA	LA CRISTALINA
5	88	17	LA CASCADA	LA CASCADA
6	88	17	EL CRUCERO	EL CRUCERO
3	865	86	EL TIGRE	EL TIGRE
4	865	86	EL PLACER	EL PLACER
1	885	86	PUERTO UMBRIA	PUERTO UMBRIA
2	885	86	LA CASTELLANA	LA CASTELLANA
3	885	86	VILLAFLOR	VILLAFLOR
1	524	41	BETANIA	BETANIA
2	524	41	EL PARAGUAY	EL PARAGUAY
5	524	41	SAN JUAN	SAN JUAN
6	524	41	EL JUNCAL	EL JUNCAL
8	524	41	EL CARMEN	EL CARMEN
1	548	41	EL SOCORRO	EL SOCORRO
10	1	41	SAN BARTOLO	SAN BARTOLO
12	1	41	VEGALARGA	VEGALARGA
14	1	41	SAN FRANCISCO	SAN FRANCISCO
1	6	41	SAN ADOLFO	SAN ADOLFO
3	6	41	PUEBLO VIEJO	PUEBLO VIEJO
5	6	41	SAN MARCOS	SAN MARCOS
7	6	41	LLANITOS	LLANITOS
1	16	41	PRAGA	PRAGA
2	16	41	SANTANDER RITA	SANTANDER RITA
4	16	41	GUACIRCO	GUACIRCO
6	16	41	POTRERITOS	POTRERITOS
2	20	41	LA ARCADIA	LA ARCADIA
5	20	41	EL PUENTE	EL PUENTE
1	78	41	PATIA	PATIA
2	78	41	LA TROJA	LA TROJA
4	78	41	SALERO	SALERO
6	78	41	LA BATALLA	LA BATALLA
8	78	41	MIRAMAR	MIRAMAR
1	132	41	LA VEGA	LA VEGA
1	206	41	MONGUI	MONGUI
2	206	41	SANTANDERNA	SANTANDERNA
4	206	41	LAS LAJAS	LAS LAJAS
5	206	41	SAN MARCOS	SAN MARCOS
6	206	41	LOS RIOS	LOS RIOS
2	244	41	CRITOGUAS	CRITOGUAS
4	244	41	LAS AGUADAS	LAS AGUADAS
2	298	41	LA JAGUA	LA JAGUA
4	298	41	ZULUAGA	ZULUAGA
26	615	27	VENECIA	VENECIA
1	660	27	LA SELVA	LA SELVA
2	660	27	RIOBLANCO	RIOBLANCO
4	660	27	SURAMITA	SURAMITA
5	660	27	VALENCIA	VALENCIA
7	660	27	PLAYA RICA	PLAYA RICA
9	660	27	DAMASCO	DAMASCO
10	660	27	HABITA	HABITA
12	660	27	LA LIBERTAD	LA LIBERTAD
14	660	27	ZABALETA SURAMI	ZABALETA SURAMI
2	745	27	GARRAPATAS	GARRAPATAS
3	745	27	SAN AGUSTIN	SAN AGUSTIN
9	745	27	TANANDO	TANANDO
2	787	27	CARMELO	CARMELO
3	787	27	CERTEGUI	CERTEGUI
4	787	27	EL TAPON	EL TAPON
5	787	27	GUARATO	GUARATO
6	787	27	IBORDO	IBORDO
7	787	27	LA ESPERANZA	LA ESPERANZA
8	787	27	LAS ANIMAS	LAS ANIMAS
9	787	27	MUMBU	MUMBU
10	787	27	PLAYA DE ORO	PLAYA DE ORO
11	787	27	PROFUNDO	PROFUNDO
12	787	27	ALTO CHATO	ALTO CHATO
13	787	27	AGUA CLARA	AGUA CLARA
3	854	5	RAUDAL	RAUDAL
4	854	5	FILO DE HAMBRE	FILO DE HAMBRE
5	854	5	MATADERO	MATADERO
7	854	5	LA INDIA	LA INDIA
9	854	5	EL NEVADO	EL NEVADO
1	856	5	EL CRUCERO	EL CRUCERO
1	858	5	EL TIGRE	EL TIGRE
1	861	5	ARABIA	ARABIA
2	861	5	BOLOMBOLO	BOLOMBOLO
4	861	5	VILLA SILVIA	VILLA SILVIA
6	861	5	PALENQUE	PALENQUE
8	861	5	LA AMALIA	LA AMALIA
9	861	5	LA JULIA	LA JULIA
1	873	5	SAN ANTONIO DE PADUA	SAN ANTONIO DE PADUA
3	873	5	NEUDO	NEUDO
5	873	5	SAN MIGUEL	SAN MIGUEL
7	873	5	BUCHADO	BUCHADO
8	873	5	NENDO	NENDO
25	756	5	HIDALGO	HIDALGO
26	756	5	LOS PLANES	LOS PLANES
29	756	5	HABANA ARRIBA	HABANA ARRIBA
31	756	5	LA MORELIA	LA MORELIA
1	761	5	CORDOBA	CORDOBA
2	761	5	GUAYABAL	GUAYABAL
4	761	5	MONTEGRANDE	MONTEGRANDE
6	761	5	LOMA DEL MEDIO	LOMA DEL MEDIO
1	789	5	PALERMO	PALERMO
2	789	5	SAN PABLO	SAN PABLO
13	125	85	BERLIN	BERLIN
14	125	85	EL GUAFAL	EL GUAFAL
1	139	85	GUAFALPINTADO	GUAFALPINTADO
3	139	85	LAS GAVIOTAS	LAS GAVIOTAS
5	139	85	SANTA ELENA DE CUSIVA	SANTA ELENA DE CUSIVA
1	162	85	PALO NEGRO	PALO NEGRO
2	162	85	BRISAS DE LLANO	BRISAS DE LLANO
6	162	85	VILLA CAROLA	VILLA CAROLA
1	225	85	EL AMPARO	EL AMPARO
3	225	85	EL PRETEXTO	EL PRETEXTO
5	225	85	PUERTO TOCARIA	PUERTO TOCARIA
7	225	85	SIRIVANA	SIRIVANA
8	225	85	EL CAUCHO	EL CAUCHO
10	225	85	CORREA	CORREA
11	225	85	EL CAZADERO	EL CAZADERO
13	225	85	PEDREGAL	PEDREGAL
15	225	85	BARBACOAS	BARBACOAS
7	65	81	REINERA (GAVIOTA)	REINERA (GAVIOTA)
9	65	81	AGUACHICA	AGUACHICA
10	65	81	EL CAUCHO	EL CAUCHO
11	65	81	GUAMALITO	GUAMALITO
13	65	81	POTOSI (PRIMAVERA)	POTOSI (PRIMAVERA)
15	65	81	BOCAS DEL BAYON	BOCAS DEL BAYON
17	65	81	PANAMA DE ARAUCA	PANAMA DE ARAUCA
1	220	81	LA VIRGEN	LA VIRGEN
2	220	81	SAN RAFAEL	SAN RAFAEL
4	220	81	JURIEPE	JURIEPE
1	300	81	PUERTO NIDIA	PUERTO NIDIA
2	591	81	LA CORREA	LA CORREA
4	591	81	EL LORO	EL LORO
5	591	81	LAS ACACIAS	LAS ACACIAS
2	736	81	ISLA DEL CHARO	ISLA DEL CHARO
4	736	81	PUERTO BANADIA	PUERTO BANADIA
6	736	81	PUERTO LLERAS	PUERTO LLERAS
8	736	81	PUERTO NARINO	PUERTO NARI?O
1	794	81	BETOYES	BETOYES
2	794	81	EL BANCO	EL BANCO
4	794	81	COROCITO MACAGUA	COROCITO MACAGUA
5	794	81	MAPOY	MAPOY
8	794	81	SAN LOPE	SAN LOPE
9	794	81	SAN SALVADOR	SAN SALVADOR
11	794	81	CACHAMA	CACHAMA
12	794	81	CUSAY	CUSAY
14	794	81	LA HOLANDA	LA HOLANDA
16	794	81	SAN IGRIDERO	SAN IGRIDERO
18	794	81	PUERTO NYDIA	PUERTO NYDIA
1	1	85	EL MORRO	EL MORRO
3	1	85	TILODIRAN	TILODIRAN
4	1	85	EL ARACAL	EL ARACAL
6	869	76	VILLAMARIA	VILLAMARIA
1	890	76	EL CANEY	EL CANEY
3	890	76	JIGUALES	JIGUALES
4	890	76	LA NEGRA	LA NEGRA
6	890	76	MEDIACANOA	MEDIACANOA
8	890	76	PUENTETIERRA	PUENTETIERRA
10	890	76	EL BOSQUE	EL BOSQUE
11	890	76	CAMPO ALEGRE	CAMPO ALEGRE
12	890	76	DOPO	DOPO
3	892	76	LA OLGA	LA OLGA
5	892	76	MULALO	MULALO
8	892	76	SAN MARCOS	SAN MARCOS
9	892	76	SANTA INES	SANTA INES
11	892	76	LA BUITRERA	LA BUITRERA
13	892	76	DAPA EL RINCON	DAPA EL RINCON
14	892	76	EL PEDREGAL	EL PEDREGAL
2	895	76	LA PAILA	LA PAILA
4	895	76	QUEBRADANUEVA	QUEBRADANUEVA
6	895	76	EL VERGEL	EL VERGEL
17	466	23	SITIO NUEVO	SITIO NUEVO
21	466	23	PUERTO ANCHICA	PUERTO ANCHICA
23	466	23	CORDOBA	CORDOBA
25	466	23	PUEBLECITO	PUEBLECITO
28	466	23	PALMAR	PALMAR
1	500	23	RIO CEDRO	RIO CEDRO
3	500	23	BAJO BLANCO	BAJO BLANCO
4	500	23	BAJO DEL LIMON	BAJO DEL LIMON
9	182	23	SAN RAFAEL	SAN RAFAEL
11	182	23	SANTA FE	SANTA FE
12	182	23	SANTA ROSA	SANTA ROSA
14	182	23	TIERRA GRATA	TIERRA GRATA
16	182	23	GARBADO	GARBADO
17	182	23	LA PANAMA	LA PANAMA
19	182	23	RETIRO DE PEREZ	RETIRO DE PEREZ
21	182	23	LOS ALGARROBOS	LOS ALGARROBOS
23	182	23	PALMITAL	PALMITAL
25	182	23	MEJOR ESQUINA	MEJOR ESQUINA
27	182	23	EL DESEO	EL DESEO
1	189	23	BERASTEGUI	BERASTEGUI
3	189	23	LAGUNETA	LAGUNETA
5	189	23	PUNTA DE YANEZ	PUNTA DE YA?EZ
7	189	23	PUERTO D L CRUZ	PUERTO D L CRUZ
8	189	23	MALAGUA	MALAGUA
10	189	23	EL CHARCON	EL CHARCON
11	189	23	EL BOBO	EL BOBO
13	189	23	SUAREZ	SUAREZ
14	189	23	SALGUERO	SALGUERO
16	189	23	EL SALADO	EL SALADO
17	189	23	RABON	RABON
19	189	23	PIJAGUAYAL	PIJAGUAYAL
21	189	23	SANTIAGO POBRE	SANTIAGO POBRE
22	189	23	SOLEDAD	SOLEDAD
24	189	23	ROSA VIEJA	ROSA VIEJA
25	189	23	LAS PALMITAS	LAS PALMITAS
27	189	23	EL HIGAL	EL HIGAL
2	417	23	EL CARITO	EL CARITO
3	417	23	LA DOCTRINA	LA DOCTRINA
5	417	23	LOS GOMEZ	LOS GOMEZ
7	417	23	NARINO	NARI?O
8	417	23	PALO DE AGUA	PALO DE AGUA
10	417	23	TIERRALTA	TIERRALTA
2	90	23	POPAYAN	POPAYAN
4	90	23	AGUAS BLANCAS	AGUAS BLANCAS
6	90	23	AGUILITA	AGUILITA
7	90	23	CODILLO	CODILLO
4	310	20	EL POTRERO	EL POTRERO
6	310	20	MONTERA	MONTERA
8	310	20	BIJAGUAL	BIJAGUAL
1	383	20	AYACUCHO	AYACUCHO
4	383	20	SAN PABLO	SAN PABLO
7	383	20	BUBETA	BUBETA
10	383	20	LA MATA	LA MATA
33	1	20	VERACRUZ	VERACRUZ
35	1	20	LAS MINAS	LAS MINAS
1	11	20	BARRANCA  DE LEBRIJA	BARRANCA  DE LEBRIJA
5	11	20	LA YEGUERA	LA YEGUERA
7	11	20	LUCAICAL	LUCAICAL
10	11	20	BUTURAMA	BUTURAMA
12	11	20	SANTA LUCIA	SANTA LUCIA
15	11	20	CERRO BRAVO	CERRO BRAVO
17	11	20	PITA LIMON	PITA LIMON
19	11	20	SANTA BARBARA	SANTA BARBARA
24	11	20	TORCOROMA	TORCOROMA
2	13	20	CASACARA	CASACARA
4	13	20	SICARARE	SICARARE
3	32	20	EL YUCAL	EL YUCAL
5	32	20	SANTA CECILIA	SANTA CECILIA
1	60	20	LAS PAVAS	LAS PAVAS
3	60	20	LAS MARGARITAS	LAS MARGARITAS
3	175	20	CACARANAO	CACARANAO
6	175	20	EL HEBRON	EL HEBRON
8	65	81	LA ESMERALDA (JUJUA)	LA ESMERALDA (JUJUA)
12	65	81	LA ESPERANZA	LA ESPERANZA
14	65	81	BOCAS DE GAVIOTA	BOCAS DE GAVIOTA
16	65	81	LOS CHORROS	LOS CHORROS
18	65	81	BOCAS DEL CALAMAR	BOCAS DEL CALAMAR
3	220	81	LOS CABALLOS	LOS CABALLOS
1	591	81	MARRERO	MARRERO
3	591	81	LOS HIGUERONES	LOS HIGUERONES
1	736	81	LA COLORADA	LA COLORADA
3	736	81	ALTO SATOCA	ALTO SATOCA
5	736	81	PUENTE DE BOJABA	PUENTE DE BOJABA
7	736	81	AGUA SANTA	AGUA SANTA
9	736	81	BARRANCONES	BARRANCONES
3	794	81	LAS GAVIOTAS	LAS GAVIOTAS
6	794	81	PUERTO GAITAN	PUERTO GAITAN
10	794	81	PUERTO NARINO	PUERTO NARI?O
13	794	81	CARUNAL	CARUNAL
15	794	81	PUENTA TABLA	PUENTA TABLA
17	794	81	GRAN BUCARE	GRAN BUCARE
2	1	85	LA CHAPARRERA	LA CHAPARRERA
5	1	85	EL CHARTE	EL CHARTE
7	869	76	LA RIVERA	LA RIVERA
2	890	76	EL DORADO	EL DORADO
5	890	76	LAS DELICIAS	LAS DELICIAS
7	890	76	MIRAVALLE	MIRAVALLE
9	890	76	SAN ANT PIEDRAS	SAN ANT PIEDRAS
2	892	76	DAPA	DAPA
4	892	76	MONTANITAS	MONTA?ITAS
6	892	76	PUERTO ISAACS	PUERTO ISAACS
10	892	76	YUMBILLO	YUMBILLO
12	892	76	BARRIO AMERICA	BARRIO AMERICA
1	895	76	GUASIMAL	GUASIMAL
3	895	76	LIMONES	LIMONES
5	895	76	VALLEJUELO	VALLEJUELO
7	895	76	EL ALISAL	EL ALISAL
2	1	81	FELICIANO	FELICIANO
5	1	81	MATA DE PINA	MATA DE PI?A
6	1	81	TODOS LOS SANTOS	TODOS LOS SANTOS
10	1	81	PUERTO COLOMBIA	PUERTO COLOMBIA
14	1	81	SAN PABLO	SAN PABLO
16	1	81	SAN JOSE	SAN JOSE
2	65	81	EL TRONCAL	EL TRONCAL
4	65	81	SAN LORENZO	SAN LORENZO
17	828	76	LA MARINA	LA MARINA
2	834	76	ALTAFLOR	ALTAFLOR
4	834	76	BOCAS DE TULUA	BOCAS DE TULUA
7	834	76	FRAZADAS	FRAZADAS
9	834	76	LA IBERIA	LA IBERIA
12	834	76	LA PALMERA	LA PALMERA
14	834	76	MATEGUADUA	MATEGUADUA
11	823	76	SAN JOSE	SAN JOSE
1	828	76	ALTO DE PAEZ	ALTO DE PAEZ
4	828	76	DOS QUEBRADAS	DOS QUEBRADAS
7	828	76	ROBLEDO	ROBLEDO
9	828	76	TIERRA GRATA	TIERRA GRATA
12	828	76	LA BOHEMIA	LA BOHEMIA
14	828	76	LA SOLEDAD	LA SOLEDAD
16	828	76	BAJO CACERES	BAJO CACERES
2	606	76	EL DIAMANTE	EL DIAMANTE
6	606	76	RIOBRAVO	RIOBRAVO
8	606	76	SAN SALVADOR	SAN SALVADOR
12	606	76	RIOGRANDE	RIOGRANDE
14	606	76	TRES PUERTAS	TRES PUERTAS
3	616	76	LA CUCHILLA	LA CUCHILLA
6	616	76	MADRIGAL	MADRIGAL
9	616	76	SALONICA	SALONICA
2	622	76	EL RETIRO	EL RETIRO
5	622	76	LA CANDELARIA	LA CANDELARIA
8	622	76	PUERTO QUINTERO	PUERTO QUINTERO
10	622	76	EL AGUACATE	EL AGUACATE
13	622	76	MATA DE GUADUA	MATA DE GUADUA
16	622	76	EL CASCARILLO	EL CASCARILLO
19	622	76	EL CASTILLO	EL CASTILLO
21	622	76	LA ARMENIA	LA ARMENIA
24	622	76	EL PIE	EL PIE
1	670	76	ANGOSTURAS	ANGOSTURAS
3	670	76	LA ESMERALDA	LA ESMERALDA
6	670	76	PLATANARES	PLATANARES
8	670	76	SAN JOSE	SAN JOSE
10	670	76	GUAYABAL	GUAYABAL
5	520	76	BOLO ALIZAL	BOLO ALIZAL
7	520	76	BOLO SAN ISIDRO	BOLO SAN ISIDRO
10	520	76	CAUCASECO	CAUCASECO
13	520	76	CHONTADURO	CHONTADURO
16	520	76	JUANCHITO	JUANCHITO
18	520	76	LA HERRADURA	LA HERRADURA
20	520	76	LA TORRE	LA TORRE
23	520	76	OBANDO	OBANDO
25	520	76	POTRERILLO	POTRERILLO
28	520	76	TENJO	TENJO
30	520	76	TOCHE	TOCHE
32	520	76	LA BUITRERA	LA BUITRERA
34	520	76	MONTECLARO	MONTECLARO
37	520	76	LA ORLIDIA	LA ORLIDIA
9	175	20	LAS VEGAS	LAS VEGAS
13	175	20	SEMPEGUA	SEMPEGUA
15	175	20	TODOS LOS SANTO	TODOS LOS SANTO
18	175	20	SANTO DOMINGO	SANTO DOMINGO
8	809	19	SANTA MARIA	SANTA MARIA
10	809	19	CHETE	CHETE
12	809	19	EL CHARCO	EL CHARCO
14	809	19	CHACON	CHACON
16	809	19	INFI	INFI
17	809	19	LLANO GRANDE	LLANO GRANDE
1	821	19	LA CRUZ	LA CRUZ
3	821	19	LOPEZ	LOPEZ
5	821	19	SAN FRANCISCO	SAN FRANCISCO
8	821	19	EL TABLAZO	EL TABLAZO
2	824	19	GABRIEL LOPEZ	GABRIEL LOPEZ
5	824	19	POLINDARA	POLINDARA
8	824	19	BUENA VISTA	BUENA VISTA
2	1	20	ATANQUEZ	ATANQUEZ
5	1	20	CARACOLI	CARACOLI
2	518	54	NEGAVITA	NEGAVITA
1	520	54	EL DIAMANTE	EL DIAMANTE
3	599	54	HONDA NORTE	HONDA NORTE
1	660	54	CARMEN NAZARETH	CARMEN NAZARETH
4	660	54	SAN ANTONIO	SAN ANTONIO
4	125	85	MANARE	MANARE
5	125	85	PUERTO COLOMBIA	PUERTO COLOMBIA
7	125	85	LAS TAPIAS	LAS TAPIAS
8	125	85	SAN NICOLAS	SAN NICOLAS
10	125	85	SANTA RITA	SANTA RITA
12	125	85	SANTA BARBARA	SANTA BARBARA
14	248	76	CAMPOALEGRE	CAMPOALEGRE
16	248	76	GUACANAL	GUACANAL
1	250	76	BALKANES	BALKANES
3	250	76	BITACO	BITACO
4	250	76	GUACHAL	GUACHAL
6	250	76	LA ESPERANZA	LA ESPERANZA
8	250	76	MONTEAZUL	MONTEAZUL
10	250	76	SIRIMUNDA	SIRIMUNDA
11	250	76	TOLDAFRIA	TOLDAFRIA
13	250	76	LA PRADERA	LA PRADERA
15	250	76	MATECANA	MATECA?A
16	250	76	CAJAMARCA	CAJAMARCA
18	250	76	EL ORO	EL ORO
19	250	76	EL DUMAR	EL DUMAR
1	275	76	BETANIA	BETANIA
2	275	76	CANAS ABAJO	CA?AS ABAJO
8	615	5	SAJONIAS	SAJONIAS
9	615	5	LLANO GRANDE	LLANO GRANDE
1	628	5	EL JUNCO	EL JUNCO
2	628	5	EL ORO	EL ORO
3	628	5	ORO BAJO	ORO BAJO
4	628	5	EL SOCORRO	EL SOCORRO
5	628	5	EL PLACER	EL PLACER
6	628	5	TESORERO	TESORERO
1	631	5	MARIA AUXILIADORA	MARIA AUXILIADORA
2	631	5	CANABERALEJO	CA?ABERALEJO
3	631	5	LAS PLAYAS	LAS PLAYAS
4	631	5	SAN ANTONIO	SAN ANTONIO
5	631	5	LA MILAGROSA	LA MILAGROSA
6	631	5	SAN ISIDRO	SAN ISIDRO
7	631	5	LA INMACULADA	LA INMACULADA
8	631	5	PAN DE AZUCAR	PAN DE AZUCAR
9	631	5	LA DOCTORA	LA DOCTORA
1	642	5	EL CONCILIO	EL CONCILIO
2	642	5	LA CAMARA	LA CAMARA
3	642	5	LA MARGARITA	LA MARGARITA
4	642	5	LA SIBERIA	LA SIBERIA
5	642	5	LA TABORDA	LA TABORDA
7	642	5	EL JUNCO	EL JUNCO
9	642	5	LA ARGELIA	LA ARGELIA
10	642	5	PENALISA	PE?ALISA
11	642	5	LA GUALANGA	LA GUALANGA
1	647	5	SAN MIGUEL	SAN MIGUEL
2	647	5	CRUCES	CRUCES
3	647	5	LA CIENAGA	LA CIENAGA
4	647	5	LOS NARANJOS	LOS NARANJOS
9	189	23	LA SAPERA	LA SAPERA
12	189	23	LOS COPELES	LOS COPELES
15	189	23	LOS VENADOS	LOS VENADOS
18	189	23	LAS PIEDRAS	LAS PIEDRAS
20	189	23	LAS BARRAS	LAS BARRAS
23	189	23	SAN ANTONIO DE TACHIRA	SAN ANTONIO DE TACHIRA
26	189	23	LAS PALMAS	LAS PALMAS
28	189	23	LAS BALSAS	LAS BALSAS
4	417	23	LAS FLORES	LAS FLORES
6	417	23	LOS MONOS	LOS MONOS
9	417	23	SAN SEBASTIAN	SAN SEBASTIAN
3	90	23	ARMENIA ABAJO	ARMENIA ABAJO
5	90	23	AGUAS PRIETAS	AGUAS PRIETAS
8	90	23	CORDOBITA CENTRO	CORDOBITA CENTRO
10	90	23	CUCHILLO BLANCO	CUCHILLO BLANCO
13	90	23	EL GUINEO	EL GUINEO
15	90	23	LA CABANA	LA CABA?A
1	110	52	PALASINOY	PALASINOY
2	110	52	ROSAL DEL MONTE	ROSAL DEL MONTE
3	110	52	SAN ANTONIO	SAN ANTONIO
4	110	52	SAN IGNACIO	SAN IGNACIO
5	110	52	SANTAFE	SANTAFE
6	110	52	SANTAMARIA	SANTAMARIA
7	110	52	VILLAMORENO	VILLAMORENO
8	110	52	VERACRUZ	VERACRUZ
9	110	52	ALTACLARA	ALTACLARA
10	110	52	PAJAJOY	PAJAJOY
11	110	52	JUANAMEL	JUANAMEL
12	110	52	HATO TONGOSOY	HATO TONGOSOY
13	110	52	PARUPETOS	PARUPETOS
14	110	52	ORTEGA	ORTEGA
1	203	52	GUAITARILLA	GUAITARILLA
2	203	52	LA PLATA	LA PLATA
4	203	52	VILLANUEVA	VILLANUEVA
5	203	52	EL MACAL	EL MACAL
6	203	52	SAN CARLOS	SAN CARLOS
7	203	52	EL BORDO	EL BORDO
1	207	52	ALFONSO LOPEZ	ALFONSO LOPEZ
3	207	52	OLAYA HERRERA	OLAYA HERRERA
4	207	52	BOMBONA	BOMBONA
5	207	52	SAN MIGUEL CARIACO	SAN MIGUEL CARIACO
6	207	52	CAJABAMBA	CAJABAMBA
7	207	52	VERACRUZ	VERACRUZ
8	207	52	SAN JOSE DE SAL	SAN JOSE DE SAL
9	207	52	PALTAPAMBA	PALTAPAMBA
10	207	52	EL GUABO	EL GUABO
11	207	52	EL CAMPAMENTO	EL CAMPAMENTO
1	210	52	ALDEA DE MARIA	ALDEA DE MARIA
3	210	52	OSPINA PEREZ	OSPI?A PEREZ
1	215	52	LOS ARRAYANES	LOS ARRAYANES
2	215	52	LLORENTE	LLORENTE
4	215	52	SANTANDER	SANTANDER
6	215	52	S PABLO DE BIJA	S PABLO DE BIJA
1	224	52	MACAS	MACAS
2	224	52	EL CARCHI	EL CARCHI
2	227	52	MAYASQUER	MAYASQUER
40	1	52	SANCHEZ	SANCHEZ
41	1	52	CUVIJAN	CUVIJAN
43	1	52	MOCONDINO	MOCONDINO
44	1	52	CANCHALA	CANCHALA
46	1	52	EL ROSARIO	EL ROSARIO
48	1	52	CASTILLO LOMA	CASTILLO LOMA
1	19	52	CHAPIURCO	CHAPIURCO
3	19	52	CAMPO BELLO	CAMPO BELLO
4	19	52	LA VEGA	LA VEGA
5	19	52	EL TAMBO	EL TAMBO
1	22	52	PAMEA ROSA	PAMEA ROSA
3	22	52	SAN LUIS	SAN LUIS
4	22	52	PLAZUELAS	PLAZUELAS
2	36	52	CRUZ DE MAYO	CRUZ DE MAYO
4	36	52	YANANCHA	YANANCHA
6	36	52	LA ARADA	LA ARADA
7	36	52	LLANO	LLANO
10	36	52	SAN LUIS	SAN LUIS
12	36	52	LIMONAR	LIMONAR
3	51	52	GOMEZ	GOMEZ
5	51	52	EMPATE	EMPATE
8	51	52	OLAYA	OLAYA
9	51	52	LA CANADA	LA CA?ADA
10	51	52	LA COMUNIDAD	LA COMUNIDAD
2	79	52	BUENAVISTA	BUENAVISTA
4	79	52	CHAPIRA	CHAPIRA
6	79	52	JUNIN	JUNIN
7	79	52	JUSTO ORTIZ	JUSTO ORTIZ
9	79	52	LOS BRAZOS	LOS BRAZOS
11	79	52	MONGON	MONGON
12	79	52	OLAYA HERRERA	OLAYA HERRERA
14	79	52	SUCRE GUINULTE	SUCRE GUINULTE
16	79	52	CHALALBI	CHALALBI
19	79	52	SOLEDAD	SOLEDAD
7	573	50	PUERTO PORFIA	PUERTO PORFIA
8	573	50	REMOLINO	REMOLINO
2	577	50	PRIMAVERA	PRIMAVERA
3	577	50	CASIBARE	CASIBARE
1	606	50	CANEY ALTO	CANEY ALTO
2	680	50	SURIMENA	SURIMENA
3	680	50	LA PALMERA	LA PALMERA
5	683	50	MESA FERNANDEZ	MESA FERNANDEZ
1	689	50	EL MEREY	EL MEREY
3	689	50	REFORMA	REFORMA
1	711	50	CAMPO ALEGRE	CAMPO ALEGRE
1	1	52	CATAMBUCO	CATAMBUCO
2	1	52	EL ENCANO	EL ENCANO
5	1	52	NARINO	NARI?O
6	1	52	OBONUCO	OBONUCO
8	1	52	JONGOBITO	JONGOBITO
9	1	52	GUALMATAN	GUALMATAN
11	1	52	ATICANCE	ATICANCE
13	1	52	BAJO CASANARE	BAJO CASANARE
14	1	52	CHAVES	CHAVES
15	1	52	MOTILON	MOTILON
17	1	52	CEROTAL	CEROTAL
18	1	52	PORTACHUELO	PORTACHUELO
20	1	52	SAN JOSE	SAN JOSE
22	1	52	JUANOY	JUANOY
7	1	20	GUATAPURI	GUATAPURI
10	1	20	GUAIMARAL	GUAIMARAL
27	399	52	SANTA TERESA ABAJO	SANTA TERESA ABAJO
12	1	20	LOS VENADOS	LOS VENADOS
16	1	20	PALMARITO	PALMARITO
18	1	20	VALENCIA JESUS	VALENCIA JESUS
21	1	20	EL VALLITO	EL VALLITO
23	1	20	GUATAPUREY	GUATAPUREY
25	1	20	LOS CORAZONES	LOS CORAZONES
28	1	20	LAS RAICES	LAS RAICES
30	1	20	RANCHO LA GOYA	RANCHO LA GOYA
12	701	19	SAN JUAN	SAN JUAN
1	743	19	GUAMBIA	GUAMBIA
3	743	19	QUICHAYA	QUICHAYA
6	743	19	VALLE NUEVO	VALLE NUEVO
8	743	19	LA CAMPANA	LA CAMPANA
10	743	19	PUENTE REAL	PUENTE REAL
13	743	19	SAN PEDRO DEL BOSQUE	SAN PEDRO DEL BOSQUE
17	743	19	LAGUNA SECA	LAGUNA SECA
19	743	19	SAN ANTONIO	SAN ANTONIO
3	760	19	EL CRUCERO	EL CRUCERO
6	760	19	PIEDRELEON	PIEDRELEON
8	760	19	BUENAVISTA	BUENAVISTA
1	780	19	EL HATO	EL HATO
3	780	19	ASNAZU	ASNAZU
4	780	19	GELIMA LA TOMA	GELIMA LA TOMA
8	780	19	LA BETULIA	LA BETULIA
2	807	19	CINCO DIAS	CINCO DIAS
5	807	19	LA CABANA	LA CABA?A
7	807	19	LAS CRUCES	LAS CRUCES
11	807	19	SAMBONI	SAMBONI
2	809	19	CAMARONES	CAMARONES
5	809	19	PETE	PETE
6	809	19	SAN BERNARDO	SAN BERNARDO
1	573	19	BOCAS DEL PALO	BOCAS DEL PALO
4	573	19	ZANJON RICO	ZANJON RICO
6	573	19	VUELTA LARGA	VUELTA LARGA
2	585	19	GUILLERMO VALENCIA	GUILLERMO VALENCIA
12	207	52	LA AGUADA	LA AGUADA
2	210	52	LA JOSEFINA	LA JOSEFINA
4	210	52	SANTO DOMINGO	SANTO DOMINGO
3	215	52	PAYAN	PAYAN
5	215	52	PUEBLO BAJO	PUEBLO BAJO
7	215	52	SANTA BRIJIDA	SANTA BRIJIDA
1	227	52	CHILES	CHILES
3	227	52	MIRAFLORES	MIRAFLORES
42	1	52	SAN FERNANDO	SAN FERNANDO
45	1	52	LOS ANGELES	LOS ANGELES
47	1	52	JAMONDINO	JAMONDINO
49	1	52	SANJUAN	SANJUAN
2	19	52	SAN ANTONIO DEL GUARAND	SAN ANTONIO DEL GUARAND
6	19	52	EL SOCORRO	EL SOCORRO
2	22	52	CAUPERAN	CAUPERAN
1	36	52	EL INGENIO	EL INGENIO
3	36	52	LA LOMA	LA LOMA
5	36	52	MACAS CRUZ	MACAS CRUZ
9	36	52	COCHA BLANCA	COCHA BLANCA
1	51	52	CARDENAS	CARDENAS
6	51	52	LA COCHA	LA COCHA
7	51	52	LA CAP. ROSA F.	LA CAP. ROSA F.
1	79	52	ALTAQUER	ALTAQUER
3	79	52	CHALCHAL	CHALCHAL
5	79	52	DIAGUILLO	DIAGUILLO
8	79	52	LAS CRUCES	LAS CRUCES
10	79	52	LUIS AVELINO PEREZ	LUIS AVELINO PEREZ
13	79	52	PAMBANA	PAMBANA
15	79	52	TELPI	TELPI
17	79	52	GUAGAYPI	GUAGAYPI
18	79	52	SAN MIGUEL NAMBI	SAN MIGUEL NAMBI
9	573	50	CUMARALITO	CUMARALITO
2	590	50	PUERTO IRIS	PUERTO IRIS
1	680	50	RINCON D.PAJURE	RINCON D.PAJURE
1	683	50	EL VERGEL	EL VERGEL
1	686	50	SAN ROQUE	SAN ROQUE
4	689	50	RINCON BOLIVAR	RINCON BOLIVAR
2	711	50	PINALITO	PI?ALITO
3	1	52	GENOY	GENOY
4	1	52	LA LAGUNA	LA LAGUNA
7	1	52	SANTANDER BARBARA	SANTANDER BARBARA
10	1	52	ECTANILLA	ECTANILLA
12	1	52	EL SOCORRO CIMARRON	EL SOCORRO CIMARRON
16	1	52	LOS ALISALES	LOS ALISALES
19	1	52	LA VICTORIA	LA VICTORIA
3	124	73	EL CAJON	EL CAJON
1	148	73	CUATRO ESQUINAS	CUATRO ESQUINAS
3	1	44	CAMARONES	CAMARONES
5	1	44	COTOPRIX	COTOPRIX
9	1	44	PUNTA DE REMEDIOS	PUNTA DE REMEDIOS
12	1	44	MONGUI	MONGUI
14	1	44	RIO ANCHO	RIO ANCHO
16	1	44	TOMARRAZON	TOMARRAZON
18	1	44	LA PALMA	LA PALMA
21	1	44	COMEJENES	COMEJENES
23	1	44	LAS CASITAS	LAS CASITAS
26	1	44	PERICO	PERICO
1	78	44	CARRETALITO	CARRETALITO
5	78	44	OREGANAL	OREGANAL
7	78	44	ROCHE	ROCHE
9	78	44	GUAYACANAL	GUAYACANAL
2	551	41	GUACACALLO	GUACACALLO
5	551	41	REGUEROS	REGUEROS
7	551	41	VERSALLES	VERSALLES
3	615	41	EL VISO	EL VISO
4	615	41	BAJO PEDREGAL	BAJO PEDREGAL
3	660	41	LAS MERCEDES	LAS MERCEDES
6	660	41	PEDREGAL	PEDREGAL
1	668	41	ALTO DEL OBISPO	ALTO DEL OBISPO
4	668	41	PUERTO QUINCHANA	PUERTO QUINCHANA
7	668	41	PRADERA	PRADERA
9	668	41	EL ROSARIO	EL ROSARIO
2	676	41	EL SOCORRO	EL SOCORRO
3	770	41	SAN CALIXTO	SAN CALIXTO
6	770	41	PICUNA	PICUNA
8	770	41	AVISPERO	AVISPERO
1	791	41	EL VERGEL	EL VERGEL
5	791	41	ESMERALDA	ESMERALDA
7	791	41	LA PAMPA	LA PAMPA
10	791	41	BUENOS AIRES	BUENOS AIRES
12	791	41	EL TAMBO	EL TAMBO
1	799	41	ANACLETO GARCIA	ANACLETO GARCIA
5	298	41	EL PARAISO	EL PARAISO
7	298	41	PROVIDENCIA	PROVIDENCIA
11	298	41	EL ROSARIO	EL ROSARIO
2	306	41	LA GRAN VIA	LA GRAN VIA
5	306	41	VERACRUZ	VERACRUZ
7	306	41	PUEBLO NUEVO	PUEBLO NUEVO
9	306	41	VUELTAS ARRIBA	VUELTAS ARRIBA
3	319	41	LOS CAUCHOS	LOS CAUCHOS
3	357	41	RIO NEGRO	RIO NEGRO
4	357	41	VALENCIA LA PAZ	VALENCIA LA PAZ
3	359	41	EL SALTO DE BORDONES	EL SALTO DE BORDONES
1	396	41	BELEN	BELEN
3	396	41	MOSCOPAN	MOSCOPAN
5	396	41	VILLA LOSADA	VILLA LOSADA
7	396	41	EL VEGON	EL VEGON
1	483	41	PATIO BONITO	PATIO BONITO
2	503	41	EL CARMEN	EL CARMEN
3	524	41	NILO	NILO
4	524	41	OSPINA PEREZ	OSPINA PEREZ
7	524	41	SAN LUIS CAS	SAN LUIS CAS
2	548	41	MINAS	MINAS
11	1	41	SAN LUIS	SAN LUIS
13	1	41	EL TRIUNFO	EL TRIUNFO
15	1	41	SANTANDER HELENA	SANTANDER HELENA
4	6	41	LA TIJINA	LA TIJINA
6	6	41	EL ROSARIO	EL ROSARIO
8	6	41	LAS MERCEDES	LAS MERCEDES
3	16	41	PATA	PATA
5	16	41	LA CEJA	LA CEJA
1	20	41	EL PARAISO	EL PARAISO
3	20	41	EL TORO	EL TORO
2	26	41	PAJIJI	PAJIJI
3	78	41	SOTO	SOTO
5	78	41	FILO SECO	FILO SECO
7	78	41	LOS LAURELES	LOS LAURELES
2	132	41	OTAS	OTAS
4	380	17	LA ATARRAYA	LA ATARRAYA
5	380	17	EL TIGRE	EL TIGRE
6	380	17	LOS ANDES	LOS ANDES
1	388	17	EL LIMON	EL LIMON
2	388	17	LA FELISA	LA FELISA
3	388	17	PENA RICA	PE?A RICA
4	388	17	EL ALLO	EL ALLO
5	388	17	LA CHUSPA	LA CHUSPA
7	388	17	LLANADAS	LLANADAS
9	388	17	EL TAMBOR	EL TAMBOR
2	433	17	CAMPOALEGRE	CAMPOALEGRE
3	433	17	LA CEIBA	LA CEIBA
5	433	17	LOS PLANES	LOS PLANES
1	442	17	CABRAS	CABRAS
2	442	17	EL LLANO	EL LLANO
3	442	17	SAN JUAN	SAN JUAN
5	442	17	LA CUCHILLA	LA CUCHILLA
1	444	17	SANTA ELENA	SANTA ELENA
1	446	17	MONTEBONITO	MONTEBONITO
3	446	17	MOYEJONES	MOYEJONES
1	486	17	LA ESPERANZA	LA ESPERANZA
3	486	17	PAN DE AZUCAR	PAN DE AZUCAR
4	486	17	PUEBLORRICO	PUEBLORRICO
3	887	5	CEDENO	CEDE?O
5	887	5	EL ROSARIO	EL ROSARIO
6	887	5	OCHALI	OCHALI
9	887	5	EL PUEBLITO	EL PUEBLITO
12	887	5	LA RIVIERA	LA RIVIERA
14	887	5	SANTA RITA	SANTA RITA
18	887	5	EL CIPRES	EL CIPRES
2	890	5	LA LEONA	LA LEONA
3	890	5	LA CANCANA	LA CANCANA
4	890	5	RUBI	RUBI
6	890	5	ABISINIA	ABISINIA
7	890	5	BENGALA	BENGALA
2	893	5	SAN LUIS BELTRAN	SAN LUIS BELTRAN
2	895	5	EL REAL	EL REAL
3	895	5	BUENOS AIRES	BUENOS AIRES
1	1	8	JUAN MINA	JUAN MINA
2	1	8	LAS FLORES	LAS FLORES
3	1	8	SIAPE	SIAPE
2	78	8	PITAL	PITAL
3	78	8	SIBARCO	SIBARCO
5	78	8	CULEBRO	CULEBRO
1	137	8	BOHORQUEZ	BOHORQUEZ
2	141	8	LE A	LE A
1	372	8	BOCATOCINO	BOCATOCINO
3	372	8	SACO	SACO
4	372	8	SANTA VERONICA	SANTA VERONICA
2	421	8	PALMAR DE CANDELARIA	PALMAR DE CANDELARIA
5	421	8	SANTA CRUZ	SANTA CRUZ
6	421	8	LOS LIMITES	LOS LIMITES
7	421	8	LA PUNTICA	LA PUNTICA
1	433	8	CARACOLI	CARACOLI
24	430	13	SANTA FE	SANTA FE
25	430	13	SANTA LUCIA	SANTA LUCIA
27	430	13	SANTA PABLA	SANTA PABLA
29	430	13	PUERTO KENNEDY	PUERTO KENNEDY
30	430	13	TACALOA	TACALOA
32	430	13	TOLU	TOLU
33	430	13	YATI	YATI
36	430	13	PLAYAS D FLORES	PLAYAS D FLORES
2	433	13	GAMERO	GAMERO
5	433	13	SAN JOAQUIN	SAN JOAQUIN
7	433	13	MORROCOY	MORROCOY
1	440	13	BOTON DE LEIVA	BOTON DE LEIVA
2	440	13	CANTERA	CANTERA
4	440	13	CHILLOA	CHILLOA
6	440	13	GUATACA SUR	GUATACA SUR
8	440	13	SANDOVAL	SANDOVAL
9	440	13	SAN JOSE	SAN JOSE
11	440	13	COROCITO	COROCITO
1	442	13	CORREA	CORREA
3	442	13	FLAMENCO	FLAMENCO
4	442	13	MAMPUJAN	MAMPUJAN
6	442	13	RETIRO NUEVO	RETIRO NUEVO
8	442	13	SAN PABLO	SAN PABLO
9	442	13	MAJAGUAS	MAJAGUAS
11	442	13	LOS BELLOS	LOS BELLOS
13	442	13	EL RECREO	EL RECREO
14	442	13	COLU	COLU
16	442	13	NUEVO RETEN	NUEVO RETEN
18	442	13	PALO ALTICO	PALO ALTICO
20	442	13	PUEBLO NUEVO	PUEBLO NUEVO
21	442	13	NUEVA FLORIDA	NUEVA FLORIDA
2	468	13	CANDELARIA	CANDELARIA
4	468	13	EL GATO	EL GATO
9	468	13	GUATACA	GUATACA
10	468	13	LA JAGUA	LA JAGUA
6	140	13	PILON	PILON
7	140	13	SAN PEDRITO	SAN PEDRITO
9	140	13	YUCAL	YUCAL
2	212	13	ISLA DE CORDOBA	ISLA DE CORDOBA
4	212	13	PLAYONCITO	PLAYONCITO
6	212	13	SINCELEJITO	SINCELEJITO
8	212	13	TACAMOCHO	TACAMOCHO
9	212	13	SANTA LUCIA	SANTA LUCIA
2	244	13	CARACOLI GRANDE	CARACOLI GRANDE
4	244	13	JESUS DEL MONTE	JESUS DEL MONTE
6	244	13	SAN CARLOS	SAN CARLOS
3	132	41	BAJO PIRABAUTE	BAJO PIRABAUTE
3	206	41	POTRERO GRANDE	POTRERO GRANDE
1	244	41	EL VISO	EL VISO
3	244	41	POTRERILLOS	POTRERILLOS
1	298	41	EL RECREO	EL RECREO
3	298	41	SAN ANT DEL PESCADO	SAN ANT DEL PESCADO
3	660	27	SAN PEDRO INGARA	SAN PEDRO INGARA
6	660	27	LA ITALIA	LA ITALIA
8	660	27	CORCOVADO	CORCOVADO
11	660	27	LA ALBANIA	LA ALBANIA
13	660	27	LOS PATIOS	LOS PATIOS
1	745	27	CANAVERAL	CANAVERAL
4	745	27	TAPARAL	TAPARAL
1	787	27	ARRASTRADERO	ARRASTRADERO
21	615	27	PUERTO LLERAS	PUERTO LLERAS
23	615	27	BAJIRA BELEN DE BAJIRA	BAJIRA BELEN DE BAJIRA
14	708	70	LA QUEBRADA	LA QUEBRADA
17	708	70	NEIVA	NEIVA
2	713	70	BERLIN	BERLIN
4	713	70	BUENOS AIRES	BUENOS AIRES
7	713	70	PAJONAL	PAJONAL
9	713	70	PLAMPAREJO	PLAMPAREJO
11	713	70	SABANA MUCACAL	SABANA MUCACAL
14	713	70	HIGUERON	HIGUERON
17	713	70	CERRO DOS CASAS	CERRO DOS CASAS
20	713	70	AGUAS NEGRAS	AGUAS NEGRAS
22	713	70	BOCACERRADA	BOCACERRADA
1	174	54	CORNEJO	CORNEJO
2	174	54	CHUCARIMA	CHUCARIMA
3	174	54	EL ALISAL	EL ALISAL
4	174	54	EL PORVENIR	EL PORVENIR
5	174	54	LLANO GRANDE	LLANO GRANDE
6	174	54	PRESIDENTE	PRESIDENTE
7	174	54	TANE	TANE
1	206	54	BALCONES	BALCONES
145	835	52	VUELTA CANDELIL	VUELTA CANDELIL
146	835	52	VUELTA LARGA	VUELTA LARGA
1	838	52	ALBAN	ALBAN
2	838	52	CUATRO ESQUINAS	CUATRO ESQUINAS
3	838	52	OLAYA	OLAYA
4	838	52	PINZON	PINZON
5	838	52	QUINONES	QUI?ONES
6	838	52	SANTANDER	SANTANDER
7	838	52	TUTACHAG	TUTACHAG
8	838	52	YASCUAL	YASCUAL
9	838	52	RANCHO GRANDE	RANCHO GRANDE
10	838	52	SAN FRANCISCO	SAN FRANCISCO
11	838	52	LOS ARRAYANES	LOS ARRAYANES
12	838	52	LA FLOR	LA FLOR
13	838	52	GUAYAQUITA	GUAYAQUITA
1	885	52	MINDA	MINDA
2	885	52	TAINDALA	TAINDALA
3	885	52	MOHECHIZA	MOHECHIZA
4	885	52	CHAPACUAL	CHAPACUAL
5	885	52	EL PLACER	EL PLACER
6	885	52	MEJIA	MEJIA
7	885	52	AGUADA	AGUADA
8	885	52	EL ROSARIO	EL ROSARIO
9	885	52	TASNAQUE	TASNAQUE
1	1	54	AGUACLARA	AGUACLARA
2	1	54	BANCO DE ARENA	BANCO DE ARENA
3	1	54	LA BUENA ESPERANZA	LA BUENA ESPERANZA
5	1	54	EL CERRITO	EL CERRITO
6	1	54	EL ESCOBAL	EL ESCOBAL
7	1	54	EL SALADO	EL SALADO
11	1	54	PUERTO VILLAMIZAR	PUERTO VILLAMIZAR
12	1	54	PUNTA BRAVA	PUNTA BRAVA
15	1	54	RICAURTE	RICAURTE
17	1	54	SAN FAUSTINO	SAN FAUSTINO
18	1	54	SAN PEDRO	SAN PEDRO
22	1	54	AGUA LA SAL	AGUA LA SAL
24	1	54	CASA DE ZINC	CASA DE ZINC
25	1	54	ARRAYANES	ARRAYANES
26	1	54	BOCONO	BOCONO
27	1	54	CAMPO DOS	CAMPO DOS
28	1	54	ALTO VIENTO	ALTO VIENTO
29	1	54	EL CARMEN	EL CARMEN
30	1	54	EL PORTICO	EL PORTICO
31	1	54	EL RODEO	EL RODEO
33	1	54	LA JARRA	LA JARRA
35	1	54	LIMONCITO	LIMONCITO
36	1	54	PALMARITO	PALMARITO
38	1	54	PUERTO LEON	PUERTO LEON
39	1	54	PUERTO NUEVO	PUERTO NUEVO
40	1	54	LA BUENA ESPERANZA	LA BUENA ESPERANZA
41	1	54	GUAROMITO	GUAROMITO
1	3	54	CAPITANLARGO	CAPITANLARGO
2	3	54	CASITAS	CASITAS
3	3	54	EL CRUCE	EL CRUCE
5	3	54	EL TABACO	EL TABACO
9	3	54	LA ARENOSA	LA ARENOSA
89	835	52	SAN ISIDRO	SAN ISIDRO
91	835	52	SANTA ROSA	SANTA ROSA
93	835	52	IMBILPI DEL C.	IMBILPI DEL C.
95	835	52	PITAL PIRAGUA	PITAL PIRAGUA
97	835	52	PLAYA DEL MIRA	PLAYA DEL MIRA
98	835	52	PUNTO TIBIO	PUNTO TIBIO
100	835	52	STA MARIA ROSARIO	STA MARIA ROSARIO
102	835	52	LA BARCA	LA BARCA
104	835	52	CASAS VIEJAS	CASAS VIEJAS
106	835	52	AMBULPI	AMBULPI
108	835	52	BAJO JAGUA	BAJO JAGUA
110	835	52	CACAGUAL	CACAGUAL
111	835	52	CANDELO(ROSARIO)	CANDELO(ROSARIO)
113	835	52	CHAPILAR(  ROSARIO)	CHAPILAR(  ROSARIO)
17	780	13	PATICO	PATICO
21	780	13	SAN FRANCISCO DE LOBA	SAN FRANCISCO DE LOBA
22	780	13	SAN JAVIER	SAN JAVIER
1	836	13	CANAVERAL	CA?AVERAL
2	836	13	CHIQUITO	CHIQUITO
2	838	13	PUEBLO NUEVO	PUEBLO NUEVO
2	873	13	ALGARROBO	ALGARROBO
7	1	15	PUENTE BOYACA	PUENTE BOYACA
2	22	15	SINAI	SINAI
2	47	15	DIGANOME	DIGANOME
4	47	15	MOMBITA	MOMBITA
6	47	15	SUSE	SUSE
7	47	15	TOQUILLA	TOQUILLA
9	47	15	SUSACA	SUSACA
10	47	15	DAITO	DAITO
12	47	15	PRIMAVERA	PRIMAVERA
13	47	15	SORIANO	SORIANO
2	87	15	MONTERO BAJO	MONTERO BAJO
3	87	15	BOSQUE TRES	BOSQUE TRES
5	87	15	BOSQUE DOS	BOSQUE DOS
6	87	15	BOSQUE UNO	BOSQUE UNO
9	650	13	CUATRO BOCAS	CUATRO BOCAS
1	654	13	ARENAS	ARENAS
2	654	13	BAJO GRANDE	BAJO GRANDE
3	654	13	LAS PALMAS	LAS PALMAS
5	654	13	SAN CRISTOBAL	SAN CRISTOBAL
6	654	13	LOS CHARQUITOS	LOS CHARQUITOS
7	654	13	PARAISO	PARAISO
8	654	13	MATUYA	MATUYA
1	657	13	CORRALITO	CORRALITO
2	657	13	LA HAYA	LA HAYA
3	657	13	LAS PORQUERAS	LAS PORQUERAS
4	657	13	SAN AGUSTIN	SAN AGUSTIN
5	657	13	SAN CAYETANO	SAN CAYETANO
6	657	13	SAN PEDRO CONSOLADO	SAN PEDRO CONSOLADO
1	667	13	BUENOS AIRES	BUENOS AIRES
2	667	13	CHIMI	CHIMI
5	667	13	JUANA SANCHEZ	JUANA SANCHEZ
6	667	13	LA CHAPETONA	LA CHAPETONA
7	667	13	LA RIBONA	LA RIBONA
8	667	13	LA VICTORIA	LA VICTORIA
17	215	70	SAN JOSE PILITA	SAN JOSE PILITA
18	215	70	LAS PENAS	LAS PE?AS
1	230	70	LA CEIBA	LA CEIBA
1	235	70	BARAYA	BARAYA
2	235	70	SAN ANDRES PALOMO	SAN ANDRES PALOMO
3	235	70	SAN JOSE DE RIVERA	SAN JOSE DE RIVERA
4	235	70	SAN ANDRES	SAN ANDRES
5	235	70	BARAYA	BARAYA
6	235	70	TRES PUNTAS	TRES PUNTAS
7	235	70	PUEBLO NUEVO 2	PUEBLO NUEVO 2
8	235	70	RIVERA	RIVERA
9	235	70	PUEBLO NUEVO 1	PUEBLO NUEVO 1
10	235	70	JUNIN	JUNIN
2	265	70	DIAZ GRANADOS	DIAZ GRANADOS
4	265	70	GABALDA	GABALDA
6	265	70	LA CONCORDIA	LA CONCORDIA
8	265	70	PALMARITICO	PALMARITICO
9	265	70	PUERTO LOPEZ	PUERTO LOPEZ
1	400	70	CAYO DELGADO	CAYO DELGADO
2	400	70	PAJARITO	PAJARITO
3	400	70	CASCARILLA	CASCARILLA
4	400	70	LAS PALMITAS	LAS PALMITAS
5	400	70	SABANETA	SABANETA
1	418	70	EL COLEY	EL COLEY
2	418	70	EL PINAL	EL PI?AL
12	250	27	EL QUICHARO	EL QUICHARO
13	250	27	GARCIA GOMEZ	GARCIA GOMEZ
14	250	27	GUACHAL	GUACHAL
15	250	27	GUAGUALITO	GUAGUALITO
16	250	27	JIGUALITO	JIGUALITO
17	250	27	LAS PENITAS	LAS PE?ITAS
18	250	27	LOS PEREA	LOS PEREA
19	250	27	MUNGUIDO	MUNGUIDO
20	250	27	PALESTINA	PALESTINA
21	250	27	PANGALA	PANGALA
22	250	27	PANGALITA	PANGALITA
23	250	27	PAPAYO	PAPAYO
24	250	27	PLAYITA	PLAYITA
25	250	27	PICHINA	PICHINA
26	250	27	PUERTO MURILLO	PUERTO MURILLO
27	250	27	QUEBRADA GIRON	QUEBRADA GIRON
28	250	27	QUEBRADA DE PICHIMA	QUEBRADA DE PICHIMA
29	250	27	QUEBRADA DE TOGOROMA	QUEBRADA DE TOGOROMA
30	250	27	SAN JOSE	SAN JOSE
31	250	27	TAPARAL	TAPARAL
32	250	27	TAPARALITO	TAPARALITO
33	250	27	TAPARALITO	TAPARALITO
34	250	27	TIOCIRILO	TIOCIRILO
35	250	27	TORDO	TORDO
36	250	27	TROJITA	TROJITA
37	250	27	VENADO	VENADO
1	361	27	ANDAGOYA	ANDAGOYA
2	361	27	BAJO SAN JUAN	BAJO SAN JUAN
3	361	27	BASURU	BASURU
4	361	27	BEBEDO	BEBEDO
6	361	27	BOCAS DE SAN JUAN	BOCAS DE SAN JUAN
1	573	50	LA BALSA	LA BALSA
3	573	50	PACHAQUIARO	PACHAQUIARO
6	573	50	PUERTO GUADALUP	PUERTO GUADALUP
8	703	47	GUINEA	GUINEA
9	703	47	EL HORNO	EL HORNO
1	707	47	BARRO BLANCO	BARRO BLANCO
2	707	47	CABRERA	CABRERA
5	707	47	PITA	PITA
7	707	47	SAN PEDRO	SAN PEDRO
8	707	47	GAVILAN	GAVILAN
9	707	47	JARABA	JARABA
12	707	47	VELADERO	VELADERO
2	745	47	NUEVA VENECIA	NUEVA VENECIA
3	745	47	PALERMO	PALERMO
5	745	47	CARMONA	CARMONA
3	798	47	PIEDRAS DE MOLER	PIEDRAS DE MOLER
5	798	47	SAN LUIS	SAN LUIS
6	798	47	PIEDRAS PINTADA	PIEDRAS PINTADA
9	798	47	SAN ANTONIO	SAN ANTONIO
1	1	50	LA CONCEPCION	LA CONCEPCION
3	1	50	SANTANDER ROSA	SANTANDER ROSA
5	1	50	EL COCUY	EL COCUY
7	1	50	SERUITA	SERUITA
1	649	5	EL JORDAN	EL JORDAN
4	475	5	GUADUALITO	GUADUALITO
5	475	5	GEDEGA	GEDEGA
1	480	5	BEJUQUILLO	BEJUQUILLO
2	480	5	PAVARANDOCITO	PAVARANDOCITO
3	480	5	VILLA ARTEAGA	VILLA ARTEAGA
4	480	5	PAVARANDO GRANDE	PAVARANDO GRANDE
5	480	5	BAJIRA	BAJIRA
1	483	5	PUERTO VENUS	PUERTO VENUS
2	483	5	EL GUAMAL	EL GUAMAL
10	483	5	EL LLANO	EL LLANO
12	483	5	EL FARO	EL FARO
13	483	5	MONTECRISTO	MONTECRISTO
14	483	5	SAN ANDRES	SAN ANDRES
1	490	5	EL TOTUMO	EL TOTUMO
2	490	5	MULATOS	MULATOS
3	490	5	PUEBLO NUEVO	PUEBLO NUEVO
4	490	5	ZAPATA	ZAPATA
5	490	5	CARIBIA	CARIBIA
1	495	5	BIJAGUAL	BIJAGUAL
2	495	5	COLORADO	COLORADO
3	495	5	LA CONCHA	LA CONCHA
4	495	5	LAS FLORES	LAS FLORES
1	501	5	LLANADAS	LLANADAS
2	501	5	SUCRE	SUCRE
3	501	5	EL PERCAL	EL PERCAL
1	541	5	EL PENOL	EL PE?OL
1	543	5	BARBACOAS	BARBACOAS
2	543	5	LOMITAS	LOMITAS
4	543	5	VEGA DEL INGLES	VEGA DEL INGLES
6	543	5	LAS FALDAS	LAS FALDAS
8	543	5	URARCO	URARCO
9	543	5	EL AGRIO	EL AGRIO
2	576	5	CALIFORNIA	CALIFORNIA
3	576	5	SINAI	SINAI
2	579	5	VIRGINIAS	VIRGINIAS
4	579	5	EL BRASIL	EL BRASIL
6	579	5	SANTA CRUZ	SANTA CRUZ
8	579	5	GRECIA	GRECIA
10	579	5	CALERA	CALERA
2	585	5	EL DELIRIO	EL DELIRIO
4	585	5	LA UNION	LA UNION
13	361	5	LA HUNDIDA	LA HUNDIDA
14	361	5	LA PRENSA	LA PRENSA
1	364	5	CRISTIANIA	CRISTIANIA
2	364	5	LAS MACANAS	LAS MACANAS
4	364	5	LA CASCADA	LA CASCADA
10	823	76	PATIO BONITO	PATIO BONITO
12	823	76	LA CONSOLIDA	LA CONSOLIDA
2	828	76	ANDINAPOLIS	ANDINAPOLIS
3	828	76	CRISTALES	CRISTALES
5	828	76	EL TABOR	EL TABOR
6	828	76	HUASANO	HUASANO
8	828	76	SAN ISIDRO	SAN ISIDRO
10	828	76	VENECIA	VENECIA
11	828	76	LA CUCHILLA	LA CUCHILLA
13	828	76	LA SONORA	LA SONORA
15	828	76	PUEBLO NUEVO	PUEBLO NUEVO
1	606	76	BAJO ZABALETAS	BAJO ZABALETAS
3	606	76	ILAMA	ILAMA
4	606	76	LA PALMA	LA PALMA
5	606	76	MADRO AL	MADRO AL
7	606	76	ROMAN	ROMAN
9	606	76	TRAGEDIAS	TRAGEDIAS
11	606	76	AGUA MORA	AGUA MORA
13	606	76	LOS HISPANOS	LOS HISPANOS
1	616	76	EL RUBI	EL RUBI
2	616	76	FENICIA	FENICIA
4	616	76	LA MARINA	LA MARINA
5	616	76	LA ZULIA	LA ZULIA
7	616	76	PIEDRAS	PIEDRAS
8	616	76	PORTUGAL	PORTUGAL
1	622	76	CAJAMARCA	CAJAMARCA
3	622	76	HIGUERONCITO	HIGUERONCITO
4	622	76	ISUGU	ISUGU
6	622	76	LA SECA	LA SECA
7	622	76	MORELIA	MORELIA
9	622	76	SANTA RITA	SANTA RITA
11	622	76	EL HOBO	EL HOBO
12	622	76	LA MONTANUELA	LA MONTANUELA
14	622	76	BELGICA	BELGICA
15	622	76	BUENAVISTA	BUENAVISTA
17	622	76	EL CIRUELO	EL CIRUELO
18	622	76	EL SILENCIO	EL SILENCIO
20	622	76	GUAYABAL	GUAYABAL
22	622	76	TIERRABLANCA	TIERRABLANCA
23	622	76	REMOLINO	REMOLINO
25	622	76	EL REY	EL REY
2	670	76	BUENOS AIRES	BUENOS AIRES
4	670	76	LOS CHANCOS	LOS CHANCOS
5	670	76	NARANJAL	NARANJAL
7	670	76	PRESIDENTE	PRESIDENTE
9	670	76	TODOS SANTOS	TODOS SANTOS
3	520	76	AYACUCHO	AYACUCHO
4	520	76	BARRANCAS	BARRANCAS
6	520	76	BOLO LA ITALIA	BOLO LA ITALIA
8	520	76	BOYACA	BOYACA
9	520	76	CALUCE	CALUCE
11	520	76	COMBIA	COMBIA
12	520	76	CORONADO	CORONADO
14	520	76	GUANABANAL	GUANABANAL
15	520	76	GUAYABAL	GUAYABAL
17	520	76	LA ACEQUIA	LA ACEQUIA
19	520	76	LA QUISQUINA	LA QUISQUINA
21	520	76	LA ZAPATA	LA ZAPATA
22	520	76	MATAPALO	MATAPALO
24	520	76	PALMASECA	PALMASECA
26	520	76	ROZO	ROZO
27	520	76	TABLONES	TABLONES
29	520	76	TIENDA NUEVA	TIENDA NUEVA
31	520	76	ZAMORANO	ZAMORANO
33	520	76	LA PAMPA	LA PAMPA
35	520	76	LA BOLSA	LA BOLSA
36	520	76	LA MANUELITA	LA MANUELITA
38	520	76	LA DOLORES	LA DOLORES
2	563	76	BOLO AZUL	BOLO AZUL
4	563	76	BOLO NEGRO	BOLO NEGRO
5	563	76	EL HARTONAL	EL HARTONAL
7	563	76	EL LIBANO	EL LIBANO
9	563	76	EL RETIRO	EL RETIRO
11	563	76	LA GRANJA	LA GRANJA
13	563	76	LA TUPIA	LA TUPIA
15	563	76	LOS NEGROS	LOS NEGROS
17	563	76	PARRAGA	PARRAGA
18	563	76	POTRERITO	POTRERITO
20	563	76	VALLECITO	VALLECITO
22	563	76	LA CARBONERA	LA CARBONERA
7	318	76	SANTA ROSA DE TAPIAS	SANTA ROSA DE TAPIAS
9	318	76	GUACAS	GUACAS
11	318	76	CANANGUA	CANANGUA
12	318	76	EL PLACER	EL PLACER
3	364	76	GUACHINTE	GUACHINTE
4	364	76	LA LIBERIA	LA LIBERIA
6	364	76	POTRERITO	POTRERITO
7	364	76	PUENTE TIERRA	PUENTE TIERRA
9	364	76	QUINAMAYO	QUINAMAYO
10	364	76	ROBLES	ROBLES
12	364	76	SAN VICENTE	SAN VICENTE
13	364	76	TIMBA	TIMBA
15	364	76	VILLA PAZ	VILLA PAZ
16	364	76	LA ESTRELLA	LA ESTRELLA
2	377	76	LA MARIA	LA MARIA
4	377	76	PAVAS	PAVAS
6	377	76	SAN ANTONIO	SAN ANTONIO
1	400	76	CORCEGA	CORCEGA
2	400	76	EL LINDERO	EL LINDERO
3	400	76	LA AGUADA	LA AGUADA
5	400	76	QUEBRADAGRANDE	QUEBRADAGRANDE
3	473	13	EL DIQUE	EL DIQUE
4	473	13	LAS PAILAS	LAS PAILAS
11	473	13	BUENAVISTA	BUENAVISTA
12	473	13	BOCA D LA HONDA	BOCA D LA HONDA
13	473	13	MICO AHUMADO	MICO AHUMADO
2	549	13	COLORADO	COLORADO
3	549	13	EL SUDAN	EL SUDAN
5	549	13	LA UNION	LA UNION
7	549	13	LAS FLORES	LAS FLORES
9	549	13	MANTEQUERA	MANTEQUERA
10	549	13	PALENQUITO	PALENQUITO
12	549	13	PUERTO LOPEZ	PUERTO LOPEZ
14	549	13	SANTA COA	SANTA COA
15	549	13	SANTA ROSA	SANTA ROSA
18	549	13	RUFINA NUEVA	RUFINA NUEVA
1	600	13	NOROSI	NOROSI
3	600	13	SAN ANTONIO	SAN ANTONIO
5	600	13	SANTA TERESA	SANTA TERESA
1	647	13	BAYANO	BAYANO
1	650	13	GUASIMAL	GUASIMAL
3	650	13	PUEBLO NUEVO	PUEBLO NUEVO
5	650	13	SANTA ROSA	SANTA ROSA
6	650	13	EL PALMAR	EL PALMAR
7	650	13	EL POZON	EL POZON
7	79	5	EL VERDE	EL VERDE
8	79	5	IZASA	IZASA
10	79	5	EL GUAYABO	EL GUAYABO
13	79	5	AGUAS CLARAS	AGUAS CLARAS
14	79	5	POPALITO	POPALITO
2	86	5	QUEBRADITAS	QUEBRADITAS
4	86	5	LAS PLAYAS	LAS PLAYAS
2	88	5	MACHADO(FONTIDIENO)	MACHADO(FONTIDIENO)
4	88	5	EL PARAISO	EL PARAISO
7	88	5	TIERRADENTRO	TIERRADENTRO
8	88	5	POTRERITO	POTRERITO
11	88	5	LA CAMILA	LA CAMILA
12	88	5	ZARZAL	ZARZAL
14	88	5	BUENOS AIRES	BUENOS AIRES
17	88	5	BELLAVISTA	BELLAVISTA
18	88	5	CENTRAL	CENTRAL
1	93	5	ALTAMIRA	ALTAMIRA
2	93	5	CANGREJO	CANGREJO
4	93	5	YERBAL	YERBAL
5	93	5	SALADITAS	SALADITAS
2	101	5	FARALLONES	FARALLONES
6	101	5	SAN GREGORIO	SAN GREGORIO
7	101	5	LA LINDA	LA LINDA
1	107	5	BERLIN	BERLIN
3	107	5	LAS AURAS	LAS AURAS
2	113	5	GUARCO	GUARCO
3	113	5	TABACAL	TABACAL
5	113	5	LA ANGELINA	LA ANGELINA
2	120	5	EL JARDIN	EL JARDIN
4	120	5	MANIZALES	MANIZALES
6	120	5	PUERTO BELGICA	PUERTO BELGICA
8	308	5	LA MATICA	LA MATICA
9	308	5	CABILDO	CABILDO
11	308	5	JAMUNDI	JAMUNDI
21	1	52	EL PUERTO	EL PUERTO
24	1	52	EL BARBERO	EL BARBERO
26	1	52	BUESAQUILLO CENTRO	BUESAQUILLO CENTRO
29	1	52	CUJACAL	CUJACAL
31	1	52	ARANDA	ARANDA
33	1	52	MARACHICO BAJO	MARACHICO BAJO
37	1	52	CHORRO DE CHACHAG	CHORRO DE CHACHAG
1	223	50	SANTANDER ROSA ARIA	SANTANDER ROSA ARIA
4	226	50	SAN NICOLAS	SAN NICOLAS
8	226	50	EL CAIBE	EL CAIBE
2	245	50	SAN FRANCISCO	SAN FRANCISCO
1	251	50	MEDELLIN DEL ARIARI	MEDELLIN DEL ARIARI
1	287	50	PUERTO ALJURE	PUERTO ALJURE
5	405	52	NARINO	NARI?O
7	405	52	SANTA LUCIA	SANTA LUCIA
9	405	52	EL TABLON	EL TABLON
3	411	52	TAMBILLO BRAVOS	TAMBILLO BRAVOS
2	418	52	LA PLANADA	LA PLANADA
6	418	52	GUAYABAL	GUAYABAL
1	427	52	BOLIVAR	BOLIVAR
3	427	52	NANZALVI	NANZALVI
6	427	52	RICAURTE	RICAURTE
9	427	52	TABUJITO	TABUJITO
11	427	52	SAN LUISITO	SAN LUISITO
1	435	52	CHAMBU	CHAMBU
3	435	52	EL GUABO	EL GUABO
6	435	52	PUSPUED	PUSPUED
8	435	52	SAN MIGUEL	SAN MIGUEL
9	354	52	BETANIA	BETANIA
11	354	52	CAMUESTES	CAMUESTES
3	356	52	SAN JUAN	SAN JUAN
5	356	52	ZURAS	ZURAS
7	356	52	CHIRES CENTRO	CHIRES CENTRO
1	378	52	ALTO MAYO	ALTO MAYO
4	378	52	LA ESPERANZA	LA ESPERANZA
7	378	52	ALTO LEDESMA	ALTO LEDESMA
9	378	52	TAJUMBINA	TAJUMBINA
13	378	52	CABUYALES	CABUYALES
15	378	52	PLAZUELAS	PLAZUELAS
2	381	52	SANTACRUZ DE ROBLES	SANTACRUZ DE ROBLES
5	381	52	EL BARRANCO	EL BARRANCO
8	381	52	EL RODEO	EL RODEO
10	381	52	LAS PLAZUELAS	LAS PLAZUELAS
2	390	52	SOFONIAS YACUP	SOFONIAS YACUP
4	390	52	SAN ANTONIO DE LA MAR	SAN ANTONIO DE LA MAR
3	399	52	LA CALDERA	LA CALDERA
6	399	52	HIGUERONES	HIGUERONES
8	399	52	PENA BLANCA	PE?A BLANCA
11	399	52	OJO DE OSO	OJO DE OSO
5	258	52	LA VICTORIA	LA VICTORIA
2	260	52	SAN FRANCISCO	SAN FRANCISCO
5	260	52	SAN PEDRO	SAN PEDRO
7	260	52	EL PENOL VIEJO	EL PE?OL VIEJO
2	287	52	GUAPUSCAL	GUAPUSCAL
4	287	52	LOMA D DELGADO	LOMA D DELGADO
7	287	52	LA MESA	LA MESA
9	287	52	LA VEGA	LA VEGA
2	317	52	CHILLANQUER	CHILLANQUER
4	317	52	SAN JOSE DE CHILLANQUER	SAN JOSE DE CHILLANQUER
5	320	52	ESPERANZA	ESPERANZA
7	320	52	BUENOS AIRES	BUENOS AIRES
10	320	52	CABUYOS	CABUYOS
14	837	5	PUERTO RICO	PUERTO RICO
18	837	5	NUEVO ANTIOQUIA	NUEVO ANTIOQUIA
1	847	5	BAJO MURRI	BAJO MURRI
4	847	5	MANDE	MANDE
6	847	5	SANTA ISABEL	SANTA ISABEL
10	847	5	EL HOYO	EL HOYO
12	847	5	EL LLANO	EL LLANO
14	847	5	PUERTO PALACIOS	PUERTO PALACIOS
18	847	5	PALO BLANCO	PALO BLANCO
2	854	5	PUERTO VALDIVIA	PUERTO VALDIVIA
6	854	5	EL QUINCE	EL QUINCE
8	854	5	LA HABANA	LA HABANA
2	856	5	LA FABIANA	LA FABIANA
2	858	5	LA CHINA	LA CHINA
3	861	5	EL CERRO	EL CERRO
5	861	5	EL RINCON	EL RINCON
7	861	5	ESTACION TARSO	ESTACION TARSO
10	861	5	VENTIADERO	VENTIADERO
2	873	5	VEGAEZ	VEGAEZ
4	873	5	SAN ALEJANDRO	SAN ALEJANDRO
6	873	5	PUERTO ANTIOQUIA	PUERTO ANTIOQUIA
27	756	5	MEDIA CUESTA	MEDIA CUESTA
30	756	5	DANTAS	DANTAS
32	756	5	LLANADAS ABAJO	LLANADAS ABAJO
3	761	5	HORIZONTES	HORIZONTES
5	761	5	SAN NICOLAS	SAN NICOLAS
8	761	5	LLANO DE MONTA	LLANO DE MONTA
4	789	5	NUDILLALES	NUDILLALES
6	789	5	OTRA BANDA	OTRA BANDA
1	790	5	BARRO BLANCO	BARRO BLANCO
4	790	5	LA CAUCANA	LA CAUCANA
3	792	5	TACA MOCHO	TACA MOCHO
5	792	5	LA BODEGA CHAGUAN	LA BODEGA CHAGUAN
4	809	5	SITIOVIEJO	SITIOVIEJO
6	809	5	ALBANIA	ALBANIA
2	819	5	EL VALLE	EL VALLE
1	837	5	CURRULAO	CURRULAO
3	837	5	EL TRES	EL TRES
4	837	5	NUEVO ORIENTE	NUEVO ORIENTE
7	837	5	LOMAS AISLADAS	LOMAS AISLADAS
10	837	5	BOCAS DEL ATRAS	BOCAS DEL ATRAS
1	674	5	CORRIENTES	CORRIENTES
4	674	5	LA PORQUERA	LA PORQUERA
4	679	5	VERSALLES	VERSALLES
7	679	5	EL HELECHAL	EL HELECHAL
3	287	50	PUERTO SANTANDERNDE	PUERTO SANTANDERNDE
1	313	50	CANAGUARO	CANAGUARO
4	313	50	LA PLAYA	LA PLAYA
6	313	50	AGUAS CLARAS	AGUAS CLARAS
3	318	50	OROTOY	OROTOY
1	325	50	PUERTO ALVIRA	PUERTO ALVIRA
1	450	50	PORORORIO	PORORORIO
2	568	50	SAN PEDRO ARIME	SAN PEDRO ARIME
5	568	50	EL PORVENIR	EL PORVENIR
4	573	50	ALTAMIRA	ALTAMIRA
7	703	47	SANTANDER TERESA	SANTANDER TERESA
10	703	47	PUERTO ARTURO	PUERTO ARTURO
4	707	47	PINTO	PINTO
6	707	47	SAN FERNANDO	SAN FERNANDO
11	707	47	SANTANDER ROSA	SANTANDER ROSA
1	745	47	BUENAVISTA	BUENAVISTA
4	745	47	CALUCA	CALUCA
6	745	47	SAN ANTONIO	SAN ANTONIO
4	798	47	REAL DEL OBISPO	REAL DEL OBISPO
7	798	47	EL JUNCAL	EL JUNCAL
8	798	47	SANTANDER INES	SANTANDER INES
2	1	50	RINCON POMPEYA	RINCON POMPEYA
4	1	50	BUENAVISTA	BUENAVISTA
6	1	50	SANTANDER OLANIA	SANTANDER OLANIA
4	288	47	SANTA ROSA DE LIMA	SANTA ROSA DE LIMA
8	288	47	RIO MAR	RIO MAR
9	288	47	ESTACION LLERAS	ESTACION LLERAS
3	318	47	HATOVIEJO	HATOVIEJO
6	318	47	MURILLO	MURILLO
8	318	47	RICAURTE	RICAURTE
11	318	47	PLAYAS BLANCAS	PLAYAS BLANCAS
6	574	23	SAN LUIS	SAN LUIS
8	574	23	LA CANA DE CANAL	LA CA?A DE CA?AL
3	580	23	VILLANUEVA	VILLANUEVA
5	580	23	BELLA ROSA	BELLA ROSA
7	580	23	LA PIRAGUA	LA PIRAGUA
1	586	23	ASERRADERO	ASERRADERO
3	586	23	LOS CORRALES	LOS CORRALES
2	660	23	BAJO GRANDE	BAJO GRANDE
4	660	23	COLOMBOY	COLOMBOY
7	660	23	LLANADAS	LLANADAS
10	660	23	RODACULO	RODACULO
12	660	23	SAN ANTONIO	SAN ANTONIO
14	660	23	SABANETA	SABANETA
16	660	23	LAS BOCAS	LAS BOCAS
18	660	23	RINCON GRANDE	RINCON GRANDE
22	660	23	EL OLIVO	EL OLIVO
24	660	23	LOS BARRILES	LOS BARRILES
27	660	23	RANCHERIA	RANCHERIA
29	660	23	TREMENTINO	TREMENTINO
32	660	23	LAS AGUADITAS	LAS AGUADITAS
34	660	23	SAN ANDRESITO	SAN ANDRESITO
7	500	23	COAS	COAS
8	500	23	EL CONSUELO	EL CONSUELO
11	500	23	LAS MUJERES	LAS MUJERES
11	419	23	LA SALADA	LA SALADA
1	464	23	SABANETA	SABANETA
3	464	23	TREMENTINA	TREMENTINA
5	464	23	PUEBLECITO	PUEBLECITO
5	466	23	SAN FRANCISCO	SAN FRANCISCO
8	466	23	PICA PICA NUEVO	PICA PICA NUEVO
11	466	23	EL DISPARO	EL DISPARO
14	466	23	MORALITO	MORALITO
16	466	23	LA NUEVA	LA NUEVA
20	466	23	PUERTO CAREPA	PUERTO CAREPA
24	466	23	PUERTO LOPEZ	PUERTO LOPEZ
26	466	23	BOCA DE URE	BOCA DE URE
2	500	23	SANTANDER DE LA CRUZ	SANTANDER DE LA CRUZ
8	182	23	SAN MATEO	SAN MATEO
10	182	23	SANTA CECILIA	SANTA CECILIA
13	182	23	SEVILLA	SEVILLA
15	182	23	FLECHAS SABANAS	FLECHAS SABANAS
18	182	23	LA PILONA	LA PILONA
20	182	23	ANDALUCIA	ANDALUCIA
22	182	23	EL TIGRE	EL TIGRE
24	182	23	VILLA FATIMA	VILLA FATIMA
26	182	23	EL CHORRILLO	EL CHORRILLO
2	189	23	EL SIGLO	EL SIGLO
4	189	23	LOS MIMBRES	LOS MIMBRES
6	189	23	SANTIAGO DEL SUR	SANTIAGO DEL SUR
11	1	70	LAS MAJAGUAS	LAS MAJAGUAS
14	1	70	SAN ANTONIO	SAN ANTONIO
16	1	70	SAN RAFAEL	SAN RAFAEL
18	1	70	LAS PALMAS	LAS PALMAS
1	110	70	PLAN PAREJO	PLAN PAREJO
13	689	68	GUAMALES	GUAMALES
17	689	68	CLAVELLINAS	CLAVELLINAS
22	689	68	ALTO GRANDE	ALTO GRANDE
24	689	68	LA FORTUNA DE LIZAMA	LA FORTUNA DE LIZAMA
2	705	68	LA CEBA	LA CEBA
4	705	68	POZO BRAVO	POZO BRAVO
6	705	68	LOS VOLCANES	LOS VOLCANES
3	720	68	SAN JUAN BOSCO	SAN JUAN BOSCO
3	745	68	EL SALTO	EL SALTO
5	745	68	CINCO MIL	CINCO MIL
7	745	68	VISCAINA ALTA	VISCAINA ALTA
7	504	73	MESA DE ORTEGA	MESA DE ORTEGA
9	504	73	EL VERGEL	EL VERGEL
12	504	73	CANALI CHICALA	CANALI CHICALA
15	504	73	CORAZON DE PERA	CORAZON DE PERA
18	504	73	PALOMA PERALONSO	PALOMA PERALONSO
21	504	73	SANTUARIO	SANTUARIO
3	547	73	GUATAQUICITO	GUATAQUICITO
2	555	73	GAITANIA	GAITANIA
4	555	73	SUR DE ATA	SUR DE ATA
1	563	73	ACO	ACO
3	563	73	EL CONCHAL	EL CONCHAL
5	563	73	TAFURITO	TAFURITO
2	585	73	LOZANIA	LOZANIA
5	585	73	TIGRE Y CONSUELO	TIGRE Y CONSUELO
7	585	73	VILLA COLOMBIA	VILLA COLOMBIA
10	585	73	LAS BRISAS	LAS BRISAS
13	585	73	LA MATA	LA MATA
15	585	73	BUENAVISTA	BUENAVISTA
1	616	73	HERRERA	HERRERA
3	616	73	LA LINDOSA	LA LINDOSA
4	283	73	LA AGUADITA	LA AGUADITA
7	283	73	BOCAS DEL GUAROM	BOCAS DEL GUAROM
3	319	73	LAS MERCEDES	LAS MERCEDES
5	319	73	CHIPUELO ORIENTE	CHIPUELO ORIENTE
9	319	73	LA TROJA	LA TROJA
11	319	73	BARROSO	BARROSO
1	347	73	BRASIL	BRASIL
3	347	73	LETRAS	LETRAS
6	347	73	ARENILLO	ARENILLO
2	352	73	BOQUERON	BOQUERON
4	352	73	YOPAL	YOPAL
1	408	73	DELICIAS	DELICIAS
3	408	73	PADILLA	PADILLA
5	408	73	IGUASITO	IGUASITO
6	411	73	SAN FERNANDO	SAN FERNANDO
8	411	73	TIERRADENTRO	TIERRADENTRO
3	443	73	PITALITO	PITALITO
2	449	73	CHIMBI	CHIMBI
1	461	73	EL BOSQUE	EL BOSQUE
3	461	73	LA ESPERANZA	LA ESPERANZA
5	483	73	POCHARCO	POCHARCO
8	483	73	RINCON DE ACHIQ	RINCON DE ACHIQ
3	168	73	COPETE	COPETE
5	168	73	LA MARINA	LA MARINA
7	168	73	SAN JOSE LAS HERMOSAS	SAN JOSE LAS HERMOSAS
11	168	73	POTRERO AGUAYO	POTRERO AGUAYO
14	168	73	POTRERITO LUGO	POTRERITO LUGO
2	200	73	LA BARRIALOSA	LA BARRIALOSA
5	200	73	VEGA LOS PADRES	VEGA LOS PADRES
3	217	73	MESAS SAN JUAN	MESAS SAN JUAN
5	217	73	TOTARCO DINDE	TOTARCO DINDE
9	217	73	MEDIA LUNA	MEDIA LUNA
1	226	73	LA AURORA	LA AURORA
3	226	73	TRES ESQUINAS	TRES ESQUINAS
6	226	73	SAN MARTIN	SAN MARTIN
2	236	73	BERMEJO	BERMEJO
2	524	99	SANTA BARBARA	SANTA BARBARA
3	524	99	AVISPAS	AVISPAS
6	524	99	SANTA ROSALIA	SANTA ROSALIA
2	572	99	EL CEJAL	EL CEJAL
1	760	99	AJURUARE-CUMARB	AJURUARE-CUMARB
3	760	99	GUACO	GUACO
4	760	99	GUERIMA	GUERIMA
11	468	68	LAGUNA D OCHOAS	LAGUNA D OCHOAS
1	498	68	MIRAFLOREZ	MIRAFLOREZ
2	498	68	LA CANADA	LA CA?ADA
4	498	68	MAUCHIA	MAUCHIA
6	498	68	EL HATILLO	EL HATILLO
1	500	68	SAN PEDRO	SAN PEDRO
4	500	68	PIE DE ALTO	PIE DE ALTO
2	502	68	SUSA	SUSA
4	502	68	CAPILLA DEL CARMEN	CAPILLA DEL CARMEN
1	533	68	LA LAJITA	LA LAJITA
3	533	68	JUAN CURI	JUAN CURI
1	547	68	LA ESPERANZA	LA ESPERANZA
2	547	68	SAN ISIDRO	SAN ISIDRO
4	547	68	EL GRANADILLO	EL GRANADILLO
6	547	68	TABLANCA	TABLANCA
8	547	68	PESCADERO	PESCADERO
10	547	68	LAS COLINAS	LAS COLINAS
13	547	68	MENSULI	MENSULI
15	547	68	SAN FRANCISCO	SAN FRANCISCO
1	549	68	LLANO GRANDE	LLANO GRANDE
2	549	68	EL CUCHARO	EL CUCHARO
2	572	68	LA CAPILLA	LA CAPILLA
4	572	68	QUEBRADA NEGRA	QUEBRADA NEGRA
6	572	68	ALTO GUAMITO	ALTO GUAMITO
8	572	68	CUCHILLA	CUCHILLA
9	572	68	LOS ROBLES	LOS ROBLES
11	572	68	CANTANO BAJO	CANTANO BAJO
13	572	68	CORINTO	CORINTO
14	572	68	POPOA NORTE	POPOA NORTE
16	572	68	DELICIAS	DELICIAS
17	572	68	RINCON	RINCON
15	406	68	LA RENTA	LA RENTA
17	406	68	EL OSO	EL OSO
19	406	68	GUZAMAN	GUZAMAN
20	406	68	LIBANO	LIBANO
2	418	68	MESA DE SANTOS	MESA DE SANTOS
4	418	68	REGADERO	REGADERO
1	425	68	BUENAVISTA	BUENAVISTA
2	425	68	BURAGA	BURAGA
4	425	68	LA HUERTA	LA HUERTA
6	425	68	RASGON	RASGON
4	432	68	EL GUASIMO	EL GUASIMO
5	432	68	TIERRA BLANCA	TIERRA BLANCA
7	432	68	BARZAL	BARZAL
8	432	68	BUENAVISTA	BUENAVISTA
1	444	68	PATIO BARRIDO	PATIO BARRIDO
2	444	68	PAUJIL	PAUJIL
3	444	68	SAN FRANCISCO	SAN FRANCISCO
6	444	68	SANTA CRUZ	SANTA CRUZ
1	464	68	LOS CAUCHOS	LOS CAUCHOS
2	464	68	PITIGUAO	PITIGUAO
3	464	68	GUAURE	GUAURE
4	464	68	EL GUANO	EL GUANO
5	464	68	CERRO NEGRO	CERRO NEGRO
6	464	68	TUBUGA	TUBUGA
7	464	68	CUCHIQUIRA	CUCHIQUIRA
8	464	68	EL HOYO	EL HOYO
9	464	68	GUAYAGUATA	GUAYAGUATA
10	464	68	LA LOMITA	LA LOMITA
11	464	68	LA PALMITA	LA PALMITA
12	464	68	FLORES	FLORES
13	464	68	FELISCO	FELISCO
14	464	68	MIRABEL	MIRABEL
15	464	68	MONCHIA	MONCHIA
1	468	68	CHICACUTA	CHICACUTA
2	468	68	EL JUNCO	EL JUNCO
3	468	68	EL NARANJO	EL NARANJO
4	468	68	PURNIO	PURNIO
5	468	68	POTRERO RODRIGUEZ	POTRERO RODRIGUEZ
6	468	68	POTRERO GRANDE	POTRERO GRANDE
7	468	68	EL HOBO	EL HOBO
8	468	68	LAGUNITAS	LAGUNITAS
9	468	68	LA VEGA DE INFANTES	LA VEGA DE INFANTES
6	616	17	LA PRIMAVERA	LA PRIMAVERA
1	174	17	EL TREBOL	EL TREBOL
2	174	17	LA FLORESTA	LA FLORESTA
3	174	17	EL MANGO	EL MANGO
4	174	17	EL MITRE	EL MITRE
5	174	17	BAJO ESPANOL	BAJO ESPA?OL
6	174	17	ALTO DE LA MINA	ALTO DE LA MINA
7	174	17	NARANJAL	NARANJAL
10	174	17	ALTAMIRA	ALTAMIRA
1	272	17	EL PINTADO	EL PINTADO
2	272	17	EL VERSO	EL VERSO
3	272	17	LA PAILA	LA PAILA
4	272	17	MORRITOS	MORRITOS
5	272	17	SAMARIA	SAMARIA
7	272	17	SAN LUIS	SAN LUIS
8	272	17	BALMORAL	BALMORAL
1	380	17	BUENAVISTA	BUENAVISTA
2	380	17	GUARINOCITO	GUARINOCITO
3	380	17	PURNIO	PURNIO
4	236	73	RIONEGRO	RIONEGRO
7	236	73	LOS LLANITOS	LOS LLANITOS
10	236	73	LA SOLEDAD	LA SOLEDAD
2	268	73	MONTALVO CENTRO	MONTALVO CENTRO
3	270	73	ALTO EL ROMPE	ALTO EL ROMPE
2	283	73	CAMPEON MEDIO	CAMPEON MEDIO
25	1	73	PASTALES	PASTALES
1	24	73	LA ARADA	LA ARADA
4	24	73	SAN LUIS	SAN LUIS
6	24	73	ACHIRAL	ACHIRAL
1	26	73	CALDAS VIEJO	CALDAS VIEJO
4	26	73	RINCON CHIPALO	RINCON CHIPALO
6	26	73	ESTACION CALDAS	ESTACION CALDAS
10	26	73	LA TIGRERA	LA TIGRERA
2	30	73	CHORRILLO	CHORRILLO
4	30	73	PAJONALES	PAJONALES
1	43	73	LISBOA	LISBOA
3	43	73	SANTA BARBARA	SANTA BARBARA
3	55	73	SAN PEDRO	SAN PEDRO
5	55	73	EL PLAYON	EL PLAYON
2	67	73	CANOAS	CANOAS
4	67	73	CASA VERDE	CASA VERDE
7	67	73	SANTIAGO PEREZ	SANTIAGO PEREZ
10	67	73	BERLIN	BERLIN
12	67	73	MONTELORO	MONTELORO
14	67	73	EL PAUJIL	EL PAUJIL
4	322	15	CHORRO DE ORO	CHORRO DE ORO
7	322	15	LLANO GRANDE	LLANO GRANDE
8	322	15	SIBATE	SIBATE
12	322	15	ROSALES	ROSALES
2	325	15	SUNUBA	SUNUBA
4	332	15	LA CUEVA	LA CUEVA
7	332	15	BACHIRA	BACHIRA
1	367	15	FORAQUIRA	FORAQUIRA
1	368	15	CHEVA	CHEVA
2	368	15	PUEBLOVIEJO	PUEBLOVIEJO
1	377	15	LA AGUADA	LA AGUADA
2	380	15	LA PALMA	LA PALMA
4	401	15	STA HELENA	STA HELENA
1	403	15	CASAGUY	CASAGUY
1	407	15	LLANOBLANCO	LLANOBLANCO
2	407	15	CARDONAL	CARDO?AL
2	425	15	MUCENO	MUCENO
1	442	15	SANTA ROSA	SANTA ROSA
2	442	15	ZULIA	ZULIA
4	442	15	PORTACHUELO	PORTACHUELO
6	442	15	GUAZO	GUAZO
1	455	15	AYATA	AYATA
1	464	15	SIRGUAZA	SIRGUAZA
3	464	15	TUNJUELO	TUNJUELO
2	218	15	LAS TAPIAS	LAS TAPIAS
4	218	15	LIMON DULCE	LIMON DULCE
5	218	15	LOS SIATES	LOS SIATES
7	218	15	NOGONTOVA-LA C	NOGONTOVA-LA C
1	223	15	CHUSCAL	CHUSCAL
3	223	15	MOJICONES	MOJICONES
5	223	15	EL GUAMO	EL GUAMO
6	223	15	BOJABA	BOJABA
8	223	15	EL INDIO	EL INDIO
1	232	15	SAN PEDRO DE IGUAQUE	SAN PEDRO DE IGUAQUE
2	238	15	AVENDANOS	AVENDA?OS
3	238	15	EL CARMEN	EL CARMEN
6	238	15	HIGUERAS	HIGUERAS
7	238	15	SAN LORENZO ARRIBA	SAN LORENZO ARRIBA
9	238	15	SAN ANTONIO NORTE	SAN ANTONIO NORTE
10	238	15	SANTA ANA	SANTA ANA
2	244	15	EL CARRIZAL	EL CARRIZAL
3	244	15	LA PLAYA	LA PLAYA
3	248	15	LA BARRERA	LA BARRERA
4	248	15	STA ANA	STA ANA
2	272	15	DIRAVITA ALTO	DIRAVITA ALTO
1	296	15	SAZA	SAZA
2	299	15	LA VALVANERA	LA VALVANERA
4	299	15	GUAYABAL	GUAYABAL
7	87	15	LA VENTA LA MESA	LA VENTA LA MESA
1	92	15	OTENGA	OTENGA
1	97	15	EL ESPIGON	EL ESPIGON
1	109	15	CAMPOALEGRE	CAMPOALEGRE
3	109	15	PISMAL	PISMAL
1	131	15	NARINO	NARI?O
3	131	15	EL CUBO	EL CUBO
2	135	15	VISTAHERMOSA	VISTAHERMOSA
1	162	15	TOBA	TOBA
3	162	15	MOYARE	MOYARE
5	162	15	LA MESETA	LA MESETA
6	162	15	EL HATO	EL HATO
1	172	15	MONTEJO	MONTEJO
2	176	15	VARELA	VARELA
2	180	15	EL TAMBO	EL TAMBO
4	180	15	MUNDO NUEVO	MUNDO NUEVO
6	180	15	SAMORE	SAMORE
7	180	15	TAMARA	TAMARA
8	180	15	LA UPA	LA UPA
9	180	15	LAS CANAS	LAS CA?AS
1	183	15	CHIPAVIEJO	CHIPAVIEJO
2	183	15	EL MORAL	EL MORAL
4	183	15	MINAS	MINAS
6	183	15	CANOAS	CANOAS
7	183	15	LA PLAYA	LA PLAYA
8	183	15	EL ARENAL	EL ARENAL
2	185	15	SANTO DOMINGO	SANTO DOMINGO
2	204	15	SANTA BARBARA	SANTA BARBARA
2	212	15	GUASIMAL	GUASIMAL
4	212	15	TURTUR	TURTUR
1	218	15	LA PALMERA	LA PALMERA
7	744	13	SAN BLAS	SAN BLAS
8	744	13	SAN LUIS	SAN LUIS
11	744	13	MONTERREY	MONTERREY
1	760	13	HIGUERETAL	HIGUERETAL
5	780	13	CANO HONDO	CA?O HONDO
7	780	13	EL LIMON	EL LIMON
11	780	13	EL VESUBIO	EL VESUBIO
13	780	13	LA PENA	LA PE?A
4	690	5	SANTIAGO	SANTIAGO
6	690	5	LA ALDEA	LA ALDEA
8	690	5	LA QUIEBRA	LA QUIEBRA
2	697	5	EL RAMAL	EL RAMAL
3	697	5	LA ALDANA	LA ALDANA
1	736	5	FRAGUAS	FRAGUAS
1	756	5	ALTO DE SABANAS	ALTO DE SABANAS
2	756	5	LAS CRUCES	LAS CRUCES
5	756	5	SAN MIGUEL	SAN MIGUEL
6	756	5	RIO VERDE DE LOS MONTES	RIO VERDE DE LOS MONTES
7	756	5	EL SALADO	EL SALADO
9	756	5	SIRGUITA	SIRGUITA
11	756	5	LA TORRE	LA TORRE
12	756	5	PALESTINA	PALESTINA
14	756	5	PERRILLO	PERRILLO
16	756	5	EL RODEO	EL RODEO
21	756	5	TASAJO	TASAJO
22	756	5	RIO ARRIBA	RIO ARRIBA
3	649	5	JUANES	JUANES
4	649	5	ARENOSAS	ARENOSAS
5	649	5	NARICES	NARICES
7	649	5	MI RANDITA	MI RANDITA
10	649	5	LA GARZA	LA GARZA
1	652	5	AQUITANIA	AQUITANIA
3	652	5	HOLANDA	HOLANDA
4	652	5	MESA NORTE	MESA NORTE
2	656	5	LLANO DE SAN JUAN	LLANO DE SAN JUAN
4	656	5	LLANO DE AGUIRRE	LLANO DE AGUIRRE
6	656	5	MESTIZAL	MESTIZAL
7	656	5	POLEAL	POLEAL
1	659	5	DAMAQUIEL	DAMAQUIEL
3	659	5	UVEROS	UVEROS
1	660	5	EL SILENCIO	EL SILENCIO
6	660	5	EL PRODIGIO	EL PRODIGIO
8	660	5	ALTA VISTA	ALTA VISTA
9	660	5	PLAYA LINDA	PLAYA LINDA
11	660	5	MONTELORO	MONTELORO
2	664	5	LA PALMA 2	LA PALMA 2
3	664	5	LA MONTANA	LA MONTA?A
5	664	5	OVEJAS(CAPILLA)	OVEJAS(CAPILLA)
7	664	5	PANTANILLO	PANTANILLO
1	665	5	BUENOS AIRES	BUENOS AIRES
3	665	5	ARENAS MONAS	ARENAS MONAS
1	667	5	SAN JULIAN	SAN JULIAN
2	667	5	EL BIZCOCHO	EL BIZCOCHO
2	670	5	PROVIDENCIA	PROVIDENCIA
2	591	5	PUERTO PERALES NUEVO	PUERTO PERALES NUEVO
3	591	5	ESTACION COCORNA	ESTACION COCORNA
4	591	5	DORADAL	DORADAL
5	591	5	LA MERCEDES	LA MERCEDES
6	591	5	BUENOS AIRES	BUENOS AIRES
1	604	5	LA CRUZADA	LA CRUZADA
2	604	5	LAS MERCEDES	LAS MERCEDES
3	604	5	SANTA ISABEL	SANTA ISABEL
5	604	5	OTUL	OTUL
6	604	5	LLANO DE CORDOBA	LLANO DE CORDOBA
1	607	5	PANTANILLO	PANTANILLO
1	615	5	SAN ANTONIO	SAN ANTONIO
2	615	5	EL TABLAZO	EL TABLAZO
3	615	5	GARRIDO	GARRIDO
4	615	5	CUATRO ESQUINAS	CUATRO ESQUINAS
5	615	5	EL AGUILA	EL AGUILA
6	615	5	LA LAJA	LA LAJA
10	468	68	HIGUERONES	HIGUERONES
1	320	68	QUITASOL	QUITASOL
2	320	68	SOLFERINO	SOLFERINO
3	320	68	SAN ANTONIO	SAN ANTONIO
4	320	68	LA LAJITA	LA LAJITA
1	322	68	LAS PILAS	LAS PILAS
2	324	68	MERCADILLO	MERCADILLO
6	324	68	MATA REDONDA	MATA REDONDA
8	324	68	POPOA NORTE	POPOA NORTE
9	324	68	PAVA CHOQUE	PAVA CHOQUE
1	327	68	LA VIRGEN	LA VIRGEN
2	327	68	SONOSI	SONOSI
3	327	68	EL GUAMAL	EL GUAMAL
1	368	68	AGUA FRIA	AGUA FRIA
6	368	68	SANTA HELENA	SANTA HELENA
7	368	68	PAEZ(PARROQUIA)	PAEZ(PARROQUIA)
10	368	68	LADERAS	LADERAS
11	368	68	CABRERA BAJA	CABRERA BAJA
12	368	68	ALTO CRUCES	ALTO CRUCES
13	368	68	ALTO GRANDE	ALTO GRANDE
14	368	68	ARCINIEGAS	ARCINIEGAS
15	368	68	CRISTALES	CRISTALES
16	368	68	SANTA ROSA	SANTA ROSA
1	370	68	EL HOBO	EL HOBO
2	370	68	EL POZO L RONDO	EL POZO L RONDO
3	370	68	HATO VIEJO	HATO VIEJO
4	370	68	EL GUASIMO	EL GUASIMO
1	377	68	LA QUITAX	LA QUITAX
2	377	68	OTROMUNDO	OTROMUNDO
3	377	68	EL RUBI	EL RUBI
4	377	68	LA PLAYA	LA PLAYA
1	385	68	BAJO JORDAN	BAJO JORDAN
3	385	68	LA HERMOSURA	LA HERMOSURA
2	109	54	LA CURVA	LA CURVA
4	109	54	LAS FORTUNAS	LAS FORTUNAS
1	125	54	FENICIA	FENICIA
2	125	54	ICOTA	ICOTA
1	128	54	LA CARRERA	LA CARRERA
3	128	54	LA VEGA	LA VEGA
4	128	54	PRIMAVERA	PRIMAVERA
7	128	54	CARCASI	CARCASI
8	128	54	LAGUNA DE ORIENTE	LAGUNA DE ORIENTE
9	128	54	RAMIREZ	RAMIREZ
10	128	54	VILLA MARIA	VILLA MARIA
11	128	54	LOS MANGOS	LOS MANGOS
12	128	54	CAMPO ALEGRE	CAMPO ALEGRE
13	128	54	MIRAFLORES	MIRAFLORES
14	128	54	SAN JOSE DE LA MONTANA	SAN JOSE DE LA MONTA?A
1	172	54	NUEVA DONJUANA	NUEVA DONJUANA
3	172	54	LOBATICA	LOBATICA
4	172	54	PANTANOS	PANTANOS
10	863	76	PUENTETIERRA	PUENTETIERRA
11	863	76	LA BALSORA	LA BALSORA
12	863	76	PUERTO NUEVO	PUERTO NUEVO
13	863	76	COCONUCO	COCONUCO
14	863	76	MURRAPAL	MURRAPAL
15	863	76	EL TULCAN	EL TULCAN
1	869	76	CACHIMBAL	CACHIMBAL
2	869	76	CARBONERO	CARBONERO
3	869	76	EL PORVENIR	EL PORVENIR
4	869	76	LA FRESNEDA	LA FRESNEDA
5	869	76	OCACHE	OCACHE
11	670	76	MONTE GRANDE	MONTE GRANDE
12	670	76	PAVAS	PAVAS
1	736	76	ALEGRIAS	ALEGRIAS
2	736	76	CEBOLLAL	CEBOLLAL
3	736	76	COLORADAS	COLORADAS
4	736	76	COROZAL	COROZAL
5	736	76	CUMBARCO	CUMBARCO
6	736	76	EL VENADO	EL VENADO
7	736	76	LA ASTELIA	LA ASTELIA
8	736	76	LA CUCHILLA	LA CUCHILLA
9	736	76	LA ESTRELLA	LA ESTRELLA
10	736	76	LA MELBA	LA MELBA
11	736	76	MANZANILLO	MANZANILLO
12	736	76	MIRAFLORES	MIRAFLORES
13	736	76	PALOMINO	PALOMINO
14	736	76	SAN ANTONIO	SAN ANTONIO
15	736	76	SAN MARCOS	SAN MARCOS
16	736	76	TOTORO	TOTORO
17	736	76	TRES ESQUINAS	TRES ESQUINAS
18	736	76	QUEBRADA NUEVA	QUEBRADA NUEVA
19	736	76	ESTACION CAICEDONIA	ESTACION CAICEDONIA
20	736	76	LAS BRISAS	LAS BRISAS
21	736	76	COMINALES	COMINALES
22	736	76	CRISTALES	CRISTALES
23	736	76	LA RAQUELITA	LA RAQUELITA
24	736	76	MORRO AZUL	MORRO AZUL
25	736	76	BAJO CONGAL	BAJO CONGAL
26	736	76	CANOAS	CANOAS
27	736	76	PALMICHAL	PALMICHAL
1	823	76	BOHIO	BOHIO
2	823	76	EL CEDRO	EL CEDRO
3	823	76	LA PRADERA	LA PRADERA
4	823	76	LA ROBLEDA	LA ROBLEDA
5	823	76	LA QUIEBRA	LA QUIEBRA
6	823	76	SAN ANTONIO	SAN ANTONIO
7	823	76	SAN FRANCISCO	SAN FRANCISCO
8	823	76	VENTAQUEMADA	VENTAQUEMADA
4	68	23	EL CEDRO	EL CEDRO
6	68	23	NARINO	NARI?O
7	68	23	PALOTAL	PALOTAL
9	68	23	SINCELEJITO	SINCELEJITO
13	68	23	EL TOTUMO	EL TOTUMO
1	79	23	TIERRA SANTA	TIERRA SANTA
3	79	23	BELEN	BELEN
4	79	23	NUEVA ESTACION	NUEVA ESTACION
6	79	23	EL PARAISO	EL PARAISO
7	79	23	COTORRA	COTORRA
9	79	23	COSTA RICA	COSTA RICA
11	79	23	ALBANIA	ALBANIA
12	79	23	EL VIAJANO	EL VIAJANO
1	90	23	EL LIMON	EL LIMON
1	400	20	LA PALMITA	LA PALMITA
2	400	20	LA VICTORIA D S.ISIDRO	LA VICTORIA D S.ISIDRO
3	400	20	BOQUERON	BOQUERON
1	517	20	FLORESTA	FLORESTA
2	517	20	RIVERA	RIVERA
3	517	20	RAYITA	RAYITA
4	517	20	PALESTINA	PALESTINA
5	517	20	LOS LLANOS	LOS LLANOS
6	517	20	EL BURRO	EL BURRO
1	550	20	COSTILLA	COSTILLA
3	550	20	EL CRUCE	EL CRUCE
4	550	20	EL EDEN	EL EDEN
5	550	20	EL TANQUE	EL TANQUE
6	550	20	FLORESTA	FLORESTA
7	550	20	GUITARRILLA	GUITARRILLA
8	550	20	LAS DAMAS	LAS DAMAS
9	550	20	PASCUALA	PASCUALA
10	550	20	SANTA ANA LA LOMA	SANTA ANA LA LOMA
11	550	20	SENDERITO	SENDERITO
1	614	20	MARQUEZ	MARQUEZ
2	614	20	EL HOBO	EL HOBO
3	614	20	EL SALOBRE	EL SALOBRE
4	614	20	LOS ANGELES	LOS ANGELES
6	614	20	MONTECITOS	MONTECITOS
9	614	20	TORCOROMA	TORCOROMA
10	614	20	PUERTO NUEVO	PUERTO NUEVO
11	614	20	SAN JOSE	SAN JOSE
1	621	20	LOS ENCANTOS	LOS ENCANTOS
6	621	20	SAN JOSE DEL ORIENTE	SAN JOSE DEL ORIENTE
11	621	20	VARASBLANCAS	VARASBLANCAS
1	710	20	LA LLANA	LA LLANA
2	710	20	LA PALMA	LA PALMA
3	710	20	LA PEDREGOSA	LA PEDREGOSA
4	710	20	VEINTE DE JULIO	VEINTE DE JULIO
5	710	20	LIBANO	LIBANO
6	710	20	LA RAYA	LA RAYA
7	710	20	LOS CEDROS	LOS CEDROS
8	710	20	PUERTO CARRENO	PUERTO CARRE?O
1	750	20	LOS TUPES	LOS TUPES
2	750	20	MEDIA LUNA	MEDIA LUNA
9	667	13	PAPAYAL	PAPAYAL
10	667	13	PLAYITAS	PLAYITAS
11	667	13	SAN MIGUEL	SAN MIGUEL
12	667	13	PENONCITO	PE?ONCITO
2	670	13	CANALETAL	CANALETAL
3	670	13	SANTO DOMINGO	SANTO DOMINGO
4	670	13	EL CARMEN	EL CARMEN
5	670	13	EL SOCORRO	EL SOCORRO
6	670	13	SAN LORENZO	SAN LORENZO
7	670	13	POZO AZUL	POZO AZUL
8	670	13	SAN JUAN	SAN JUAN
9	670	13	CANABRAVAL	CA?ABRAVAL
2	673	13	EL PINIQUE	EL PINIQUE
3	673	13	GALERAZAMBA	GALERAZAMBA
4	673	13	LAS CARAS	LAS CARAS
5	673	13	LOMA DE ARENA	LOMA DE ARENA
6	673	13	PUEBLO NUEVO	PUEBLO NUEVO
7	673	13	COLORADO VIEJO	COLORADO VIEJO
8	673	13	EL SOCORRO	EL SOCORRO
2	688	13	BUENAVISTA	BUENAVISTA
3	688	13	BUENOS AIRES	BUENOS AIRES
5	688	13	FATIMA	FATIMA
7	688	13	LOS CANELOS	LOS CANELOS
9	688	13	SAN JOSE	SAN JOSE
11	688	13	SAN LUCAS	SAN LUCAS
13	688	13	VILLA FLOR	VILLA FLOR
1	744	13	CAMPO PALLARES	CAMPO PALLARES
13	468	13	LA RINCONADA	LA RINCONADA
14	468	13	LAS BOQUILLAS	LAS BOQUILLAS
15	468	13	LOMA DE SIMON	LOMA DE SIMON
16	468	13	LOS PINONES	LOS PI?ONES
20	468	13	SAN IGNACIO	SAN IGNACIO
22	468	13	SAN NICOLAS	SAN NICOLAS
23	468	13	SANTA CRUZ	SANTA CRUZ
24	468	13	SANTA ROSA	SANTA ROSA
25	468	13	SANTA TERESITA	SANTA TERESITA
28	468	13	ANCON	ANCON
30	468	13	LA TRAVESIA	LA TRAVESIA
31	468	13	PUEBLONUEVO	PUEBLONUEVO
32	468	13	SAN MARTIN	SAN MARTIN
33	468	13	BOMBA	BOMBA
34	468	13	PENON DE DURAN	PE?ON DE DURAN
2	473	13	BODEGA CENTRAL	BODEGA CENTRAL
2	125	85	CHIRE	CHIRE
13	318	47	CARRETERO	CARRETERO
16	318	47	LA PUNTICA	LA PUNTICA
18	318	47	LAS FLORES	LAS FLORES
21	318	47	PAJARAL	PAJARAL
23	318	47	SAN ISIDRO	SAN ISIDRO
1	541	47	BAHIAHONDA	BAHIAHONDA
4	541	47	CANO DE AGUAS	CANO DE AGUAS
8	541	47	HEREDIA	HEREDIA
9	541	47	PUNTA D PIEDRAS	PUNTA D PIEDRAS
4	551	47	FLORES DE MARIA	FLORES DE MARIA
7	551	47	LAS PIEDRAS	LAS PIEDRAS
9	551	47	MONTERRUBIO	MONTERRUBIO
13	551	47	PLACITAS	PLACITAS
14	551	47	LOMA DE SOLEDAD	LOMA DE SOLEDAD
1	170	47	LA CHINA	LA CHINA
3	170	47	LA ESTRELLA	LA ESTRELLA
3	189	47	RIOFRIO	RIOFRIO
4	189	47	SAN PEDRO DE LA SIERRA	SAN PEDRO DE LA SIERRA
10	189	47	LA CANDELARIA	LA CANDELARIA
12	189	47	CANO MOCHO	CANO MOCHO
14	189	47	SANTANDER ROSALIA	SANTANDER ROSALIA
19	189	47	SOPLADOR	SOPLADOR
1	245	47	AGUAESTRADA	AGUAESTRADA
4	245	47	LOS NEGRITOS	LOS NEGRITOS
7	245	47	EL CERRITO	EL CERRITO
9	245	47	LAS CABRAS	LAS CABRAS
11	245	47	SABANA HATILLO	SABANA HATILLO
14	245	47	TAMALAMEQUITO	TAMALAMEQUITO
17	245	47	SAN FELIPE	SAN FELIPE
19	245	47	RINCON MALPICA	RINCON MALPICA
23	245	47	BASTIDAS	BASTIDAS
25	245	47	BOTILLERO	BOTILLERO
28	245	47	PUEBLO NUEVO	PUEBLO NUEVO
1	258	47	CAMPOALEGRE	CAMPOALEGRE
4	258	47	PLAYON OROZCO	PLAYON OROZCO
7	258	47	TIO GOLLO	TIO GOLLO
4	847	44	CARRIZAL	CARRIZAL
7	847	44	EL CARDON	EL CARDON
10	847	44	JARARA	JARARA
13	847	44	PUERTO ESTRELLA	PUERTO ESTRELLA
17	847	44	TAPARAJIN	TAPARAJIN
21	847	44	GUARERPA	GUARERPA
24	847	44	TAGUAIRA	TAGUAIRA
1	855	44	EL PLAN	EL PLAN
1	1	47	BONDA	BONDA
3	1	47	DON DIEGO	DON DIEGO
6	1	47	GUACHACA	GUACHACA
9	1	47	MINCA	MINCA
11	1	47	BURITICA	BURITICA
13	1	47	TIGRERA	TIGRERA
15	1	47	EL YUCAL	EL YUCAL
3	717	70	NUMANCIA	NUMANCIA
3	742	70	CEJA	CEJA
5	742	70	GRANADA	GRANADA
8	742	70	LOS LIMONES	LOS LIMONES
10	742	70	VALENCIA	VALENCIA
13	742	70	LA VIVIENDA	LA VIVIENDA
15	742	70	GALAPAGO	GALAPAGO
2	771	70	BAJOGRANDE	BAJOGRANDE
4	771	70	CAMAJON	CAMAJON
6	771	70	CORDOBA	CORDOBA
8	771	70	EL CONGRESO	EL CONGRESO
10	771	70	ISLA GRANDE	ISLA GRANDE
12	771	70	LA VENTURA	LA VENTURA
15	771	70	NARANJAL	NARANJAL
4	670	70	ESCOBAR ARRIBA	ESCOBAR ARRIBA
7	670	70	MATEO PEREZ	MATEO PEREZ
10	670	70	SABANALARGA	SABANALARGA
13	670	70	ACHIOTE	ACHIOTE
15	670	70	CALLE NUEVA	CALLE NUEVA
3	678	70	JEGUA	JEGUA
5	678	70	LAS TABLITAS	LAS TABLITAS
7	678	70	PUNTA DE BLANCO	PUNTA DE BLANCO
10	678	70	SANTIAGO APOSTOL	SANTIAGO APOSTOL
14	678	70	PUERTO FRANCO	PUERTO FRANCO
17	678	70	POMPUMA	POMPUMA
19	678	70	LOMA SECA	LOMA SECA
21	678	70	CALLEJON	CALLEJON
23	678	70	LAS DELICIAS	LAS DELICIAS
26	678	70	SAN ISIDRO	SAN ISIDRO
28	678	70	LAS CHISPAS	LAS CHISPAS
30	678	70	GRILLO ALEGRE	GRILLO ALEGRE
5	702	70	VILLA LOPEZ	VILLA LOPEZ
3	708	70	CANDELARIA	CANDELARIA
5	708	70	CUENCA	CUENCA
7	708	70	EL TABLON	EL TABLON
9	708	70	LAS FLORES	LAS FLORES
12	708	70	EL PITAL	EL PITAL
3	418	70	PALMAS DE VINO	PALMAS DE VINO
5	418	70	SABANAS DE PEDRO	SABANAS DE PEDRO
5	429	70	LA SIERPITA	LA SIERPITA
8	429	70	PIZA	PIZA
10	429	70	SAN ROQUE	SAN ROQUE
12	429	70	TOMALA	TOMALA
14	429	70	SINCELEJITO	SINCELEJITO
17	429	70	PALMAR TIPICO	PALMAR TIPICO
21	429	70	SN MIGUEL	SN MIGUEL
23	429	70	LOS PATOS	LOS PATOS
1	473	70	CAMBIMBA	CAMBIMBA
4	473	70	LAS FLORES	LAS FLORES
6	473	70	TUMBATORO	TUMBATORO
8	473	70	MEDELLIN	MEDELLIN
10	473	70	BRISAS DEL MAR	BRISAS DEL MAR
3	508	70	CANUTALITO	CANUTALITO
6	508	70	DON GABRIEL	DON GABRIEL
9	508	70	FLOR DEL MONTE	FLOR DEL MONTE
13	508	70	PIJIGUAY	PIJIGUAY
15	508	70	SALITRAL	SALITRAL
17	508	70	EL FILOVAL	EL FILOVAL
2	523	70	GUAIMARAL	GUAIMARAL
1	670	70	BOSSA NAVARRO	BOSSA NAVARRO
3	670	70	ESCOBAR ABAJO	ESCOBAR ABAJO
1	124	70	EL MAMON	EL MAMON
4	124	70	LOS CAYITOS	LOS CAYITOS
6	124	70	LA SOLERA	LA SOLERA
9	124	70	MOLINERO	MOLINERO
2	204	70	CHINULITO	CHINULITO
5	204	70	BAJO DON JUAN	BAJO DON JUAN
2	215	70	CAYO DE PALMA	CAYO DE PALMA
8	244	13	HATO NUEVO	HATO NUEVO
10	244	13	GUAIMARAL	GUAIMARAL
11	244	13	EL RAIZAL	EL RAIZAL
13	244	13	EL JOBO	EL JOBO
14	244	13	SANTA LUCIA	SANTA LUCIA
18	244	13	EL HOBO	EL HOBO
1	248	13	LA ENEA	LA ENEA
2	248	13	LATA	LATA
3	248	13	NERVITI	NERVITI
5	248	13	TASAJERA	TASAJERA
2	430	13	BARRANCO DE YUCA	BARRANCO DE YUCA
5	430	13	CAMILO TORRES	CAMILO TORRES
6	430	13	CASCAJAL	CASCAJAL
7	430	13	CEIBAL	CEIBAL
26	835	52	JOSE AURELIO LL	JOSE AURELIO LL
28	835	52	JUAN D LA CRUZ	JUAN D LA CRUZ
31	835	52	LLORENTE	LLORENTE
33	835	52	RESURRECCION	RESURRECCION
36	835	52	PALAMBI	PALAMBI
38	835	52	PATRICIO JIMENEZ	PATRICIO JIMENEZ
41	835	52	ROBERTO GURRERO	ROBERTO GURRERO
44	835	52	ROSARIO	ROSARIO
46	835	52	CORDOBA	CORDOBA
48	835	52	SAMUEL A.ESCRUCERIA	SAMUEL A.ESCRUCERIA
53	835	52	SANTO DOMINGO	SANTO DOMINGO
55	835	52	BOCA DE CURAY	BOCA DE CURAY
58	835	52	TERAN	TERAN
60	835	52	SAN ANDRES BOCA	SAN ANDRES BOCA
62	835	52	CRISTOBAL COLON	CRISTOBAL COLON
65	835	52	EL PINDE	EL PINDE
67	835	52	LA NUEVA UNION	LA NUEVA UNION
69	835	52	CEIBITO	CEIBITO
71	835	52	EL CARMEN K36	EL CARMEN K36
73	835	52	EL CARMEN K63	EL CARMEN K63
75	835	52	BOCANA NUEVA	BOCANA NUEVA
79	835	52	TABACAL	TABACAL
80	835	52	DAVID ANGULO C	DAVID ANGULO C
86	835	52	PICUAMBI	PICUAMBI
1	720	52	EL ESPINO	EL ESPINO
3	720	52	LOS MONOS	LOS MONOS
6	720	52	PANAMAL	PANAMAL
2	786	52	EL TABLON	EL TABLON
5	786	52	HUECO	HUECO
7	786	52	EL MANZANO	EL MANZANO
9	786	52	CORNETA	CORNETA
11	786	52	TAMINANGUITO	TAMINANGUITO
14	786	52	PARAMO	PARAMO
15	786	52	CONCORDIA 11	CONCORDIA 11
1	788	52	SANTANDER	SANTANDER
2	788	52	TAPIALQUER ALTO	TAPIALQUER ALTO
5	788	52	SAN VICENTE	SAN VICENTE
1	835	52	ALBERTO LLERAS	ALBERTO LLERAS
3	835	52	ALMIRANTE PADILLA	ALMIRANTE PADILLA
6	835	52	BENITEZ	BENITEZ
7	835	52	BERNARDINO ORTIZ	BERNARDINO ORTIZ
11	835	52	DESCOLGADERO	DESCOLGADERO
13	835	52	EFRAIN LLORENTE	EFRAIN LLORENTE
16	835	52	EL PITAL	EL PITAL
18	835	52	FRANCISCO DE ARIZALA	FRANCISCO DE ARIZALA
21	835	52	GUAYABO	GUAYABO
22	835	52	GUILLERMO LEON VALENCIA	GUILLERMO LEON VALENCIA
15	678	52	PUERCHAS	PUERCHAS
17	678	52	CARTAGENA	CARTAGENA
2	683	52	EL INGENIO	EL INGENIO
4	683	52	SANTA BARBARA	SANTA BARBARA
6	683	52	LOMA D.TAMBILLO	LOMA D.TAMBILLO
10	683	52	EL VERGEL	EL VERGEL
12	683	52	SAN MIGUEL	SAN MIGUEL
1	687	52	EL CARMEN	EL CARMEN
3	687	52	SANTA MARTA	SANTA MARTA
5	687	52	SAN VICENTE	SAN VICENTE
2	693	52	BRICENO	BRICE?O
5	678	52	LA PLANADA	LA PLANADA
7	678	52	TANAMA	TANAMA
7	497	76	SAN ISIDRO	SAN ISIDRO
8	497	76	VILLA RODAS	VILLA RODAS
10	497	76	LA ESPERANZA	LA ESPERANZA
2	520	76	AMAIME	AMAIME
12	248	76	EL MORAL	EL MORAL
6	276	68	HELECHALES	HELECHALES
8	276	68	VERICUTE	VERICUTE
10	276	68	URBANIZACION BUCARICA	URBANIZACION BUCARICA
2	296	68	BUENAVISTA	BUENAVISTA
4	296	68	LA PLAZUELA	LA PLAZUELA
6	296	68	SIBERIA	SIBERIA
1	298	68	EL TALADRO	EL TALADRO
3	298	68	CORONTUNJO	CORONTUNJO
1	307	68	CHOCOA	CHOCOA
2	307	68	LAS BOCAS	LAS BOCAS
4	307	68	MOTOSO	MOTOSO
7	307	68	ACAPULCO	ACAPULCO
9	307	68	PANTANO	PANTANO
10	307	68	MALPASO	MALPASO
11	307	68	BARBOSA	BARBOSA
13	307	68	EL LINDERO	EL LINDERO
14	307	68	SAN LUIS DE RIO	SAN LUIS DE RIO
17	307	68	RIO PRADO	RIO PRADO
2	318	68	EL PORTILLO	EL PORTILLO
4	318	68	SISOTA	SISOTA
5	318	68	EL RETIRO	EL RETIRO
7	318	68	EL PALMAR	EL PALMAR
9	318	68	NUCUBUCA	NUCUBUCA
10	318	68	TABACAL	TABACAL
12	318	68	MATA DE LATA	MATA DE LATA
10	207	68	BARBULA	BARBULA
1	211	68	SAN PABLO	SAN PABLO
1	217	68	CINCELADA	CINCELADA
1	229	68	CANTABARA	CANTABARA
2	229	68	EL BASTO	EL BASTO
4	229	68	PIEDRA GORDA	PIEDRA GORDA
6	229	68	PALO BLANCO BAJO	PALO BLANCO BAJO
8	229	68	CUCHICUTE	CUCHICUTE
2	235	68	CAMPO HERMOSO	CAMPO HERMOSO
3	235	68	DELICIAS ALTO	DELICIAS ALTO
4	235	68	EL CENTENARIO	EL CENTENARIO
7	235	68	LA YE	LA YE
9	235	68	SANTO DOMINGO	SANTO DOMINGO
3	245	68	SANTA RITA	SANTA RITA
1	250	68	BOCAS DEL HORTA	BOCAS DEL HORTA
2	250	68	CRUCES	CRUCES
3	250	68	RIO BLANCO	RIO BLANCO
2	255	68	BETANIA	BETANIA
3	255	68	EL FILO	EL FILO
5	255	68	LA AGUADA	LA AGUADA
7	255	68	LA LAGUNA	LA LAGUNA
8	255	68	LA VEGA	LA VEGA
2	53	47	CERRO AZUL	CERRO AZUL
5	53	47	LOS PATOS	LOS PATOS
8	53	47	SANTANDER ANA	SANTANDER ANA
10	53	47	THEODROMINA	THEODROMINA
1	58	47	ALEJANDRIA	ALEJANDRIA
3	58	47	PUEBLO NUEVO	PUEBLO NUEVO
5	58	47	EL CARMEN DE ARIGUANI	EL CARMEN DE ARIGUANI
2	161	47	CANDELARIA	CANDELARIA
5	161	47	JESUS DEL MONTE	JESUS DEL MONTE
10	78	44	GUACAMAYAL	GUACAMAYAL
1	279	44	BUENAVISTA	BUENAVISTA
3	288	47	DONA MARIA	DO?A MARIA
6	288	47	KILOMETRO 25	KILOMETRO 25
7	288	47	SI DIOS QUIERE	SI DIOS QUIERE
1	318	47	CASA DE TABLA	CASA DE TABLA
2	318	47	GUAIMARAL	GUAIMARAL
4	318	47	PEDREGOSA	PEDREGOSA
5	318	47	LOS ANDES	LOS ANDES
7	318	47	PAMPAN	PAMPAN
9	318	47	SALVADORA	SALVADORA
10	318	47	URQUIJO	URQUIJO
12	318	47	SITIO NUEVO	SITIO NUEVO
14	318	47	BELLAVISTA	BELLAVISTA
15	318	47	GUACAMAYAL	GUACAMAYAL
17	318	47	SAN PEDRO	SAN PEDRO
19	318	47	SAN ANTONIO	SAN ANTONIO
20	318	47	LA CEIBA	LA CEIBA
22	318	47	PARACO	PARACO
24	318	47	VILLA NUEVA	VILLA NUEVA
2	541	47	BALSAMO	BALSAMO
3	541	47	BOMBA	BOMBA
5	541	47	CAPUCHO	CAPUCHO
6	541	47	EL BONGO	EL BONGO
7	541	47	GUAQUIRI	GUAQUIRI
1	551	47	AVIANCA	AVIANCA
2	551	47	CARABALLO	CARABALLO
3	551	47	CHINOBLAS	CHINOBLAS
5	551	47	GARRAPATA	GARRAPATA
6	551	47	LAS CANOAS	LAS CANOAS
8	551	47	MEDIALUNA	MEDIALUNA
10	551	47	PARACO	PARACO
11	551	47	PARAISO	PARAISO
12	551	47	PINUELAS	PINUELAS
15	551	47	SALAMINITA	SALAMINITA
7	161	47	ROSARIO CHENGUE	ROSARIO CHENGUE
2	170	47	PUEBLONUEVO	PUEBLONUEVO
1	189	47	GUACAMAYAL	GUACAMAYAL
2	189	47	ORIHUECA	ORIHUECA
5	189	47	SEVILLA	SEVILLA
6	189	47	SEVILLANO	SEVILLANO
7	189	47	TUCURINCA	TUCURINCA
8	189	47	ZAWADY	ZAWADY
9	189	47	EL MAMON	EL MAMON
11	189	47	LA GRAN VIA	LA GRAN VIA
13	189	47	PALOMAR	PALOMAR
15	189	47	CAMPO KENNEDY	CAMPO KENNEDY
16	189	47	GUAMACHITO	GUAMACHITO
18	189	47	PALMOR	PALMOR
20	189	47	VARELA	VARELA
2	245	47	ALGARROBAL	ALGARROBAL
3	245	47	BARRANCO	BARRANCO
5	245	47	BELEN	BELEN
6	245	47	CANOS DE PALMA	CANOS DE PALMA
8	245	47	EL TREBOL	EL TREBOL
10	245	47	MENCHIQUEJO	MENCHIQUEJO
12	245	47	SAN JOSE	SAN JOSE
13	245	47	SAN ROQUE	SAN ROQUE
15	245	47	EL SALTO	EL SALTO
16	245	47	SAN EDUARDO	SAN EDUARDO
18	245	47	GUACAMAYAL	GUACAMAYAL
20	245	47	GARZON	GARZON
21	245	47	CAIMANERA	CAIMANERA
22	245	47	ISLITAS	ISLITAS
24	245	47	FELIPE EDUARDO	FELIPE EDUARDO
26	245	47	LOS MAMONES	LOS MAMONES
32	245	47	MATA DE CANA	MATA DE CANA
2	258	47	CANTAGALLAR	CANTAGALLAR
3	258	47	CARRETO	CARRETO
5	258	47	SABANAS	SABANAS
6	258	47	SAN BASILIO	SAN BASILIO
9	258	47	ERANILLO	ERANILLO
5	847	44	CASTILLETES	CASTILLETES
6	847	44	CASUSO	CASUSO
9	847	44	GUIMPESI	GUIMPESI
12	847	44	NAZARETH	NAZARETH
14	847	44	PUERTO LOPEZ	PUERTO LOPEZ
15	847	44	RANCHO GRANDE	RANCHO GRANDE
18	847	44	TAROA	TAROA
20	847	44	IRRAIPA	IRRAIPA
23	847	44	PORCHINA	PORCHINA
25	847	44	JONJONCITO	JONJONCITO
3	855	44	SIERRA MONTANA	SIERRA MONTANA
2	1	47	CALABAZO	CALABAZO
4	1	47	EL CAMPANO	EL CAMPANO
5	1	47	GAIRA	GAIRA
7	1	47	LA TAGUA	LA TAGUA
10	1	47	TAGANGA	TAGANGA
12	1	47	LA QUININA	LA QUININA
14	1	47	PUERTO NUEVO	PUERTO NUEVO
1	53	47	BUENOS AIRES	BUENOS AIRES
3	53	47	EL BONGO	EL BONGO
6	53	47	MARIMONDA	MARIMONDA
7	53	47	MENGAJO	MENGAJO
9	53	47	SANTO TOMAS	SANTO TOMAS
11	53	47	CAUCA	CAUCA
12	53	47	LA COLOMBIA	LA COLOMBIA
2	58	47	CASA DE TABLA	CASA DE TABLA
4	58	47	SAN ANGEL	SAN ANGEL
7	58	47	PUENTE ARIGUANI	PUENTE ARIGUANI
1	161	47	BELLAVISTA	BELLAVISTA
3	161	47	CONCEPCION	CONCEPCION
4	161	47	CONCORDIA	CONCORDIA
3	686	5	HOYORRICO	HOYORRICO
5	686	5	SAN NICOLAS	SAN NICOLAS
8	686	5	RIO GRANDE	RIO GRANDE
9	686	5	ALTO DE LA MINA	ALTO DE LA MINA
5	690	5	VERSALLES	VERSALLES
7	690	5	EL ROSARIO	EL ROSARIO
1	697	5	PORTACHUELOS	PORTACHUELOS
4	697	5	LA JUDEA	LA JUDEA
2	736	5	PUERTO CALAVERA	PUERTO CALAVERA
3	756	5	LOS MEDIOS	LOS MEDIOS
4	756	5	RIO VERDE DE LOS HENAOS	RIO VERDE DE LOS HENAOS
8	756	5	MAGALLO	MAGALLO
10	756	5	LOS POTREROS	LOS POTREROS
13	756	5	BRASILLAL	BRASILLAL
18	756	5	NARANJAL ARRIBA	NARANJAL ARRIBA
24	756	5	LA LOMA	LA LOMA
2	649	5	SAMANA DEL NORTE	SAMANA DEL NORTE
8	649	5	PUERTO BELO	PUERTO BELO
11	649	5	EL CHOCO	EL CHOCO
2	652	5	CONCEPCION	CONCEPCION
1	656	5	LOS CEDROS	LOS CEDROS
3	656	5	CENAGUETA	CENAGUETA
5	656	5	ALTO COLORADO	ALTO COLORADO
8	656	5	LOMA HERMOSA	LOMA HERMOSA
2	659	5	SAN JUANCITO	SAN JUANCITO
5	660	5	EL VERGEL	EL VERGEL
7	660	5	BUENOS AIRES	BUENOS AIRES
10	660	5	SALAMBRINA	SALAMBRINA
1	664	5	LA CUCHILLA	LA CUCHILLA
4	664	5	EL ESPINAL	EL ESPINAL
6	664	5	LA LANA	LA LANA
8	664	5	RIO CHICO	RIO CHICO
2	665	5	SANTA CATALINA	SANTA CATALINA
4	665	5	ZAPINDONGA	ZAPINDONGA
1	670	5	CRISTALES	CRISTALES
3	670	5	SAN JOSE NUESTRA SENORA	SAN JOSE NUESTRA SE?ORA
3	543	5	LOS LLANOS	LOS LLANOS
5	543	5	TOLDAS	TOLDAS
7	543	5	LOS LLANOS 2	LOS LLANOS 2
10	543	5	JERIGUA	JERIGUA
1	579	5	MURILLO	MURILLO
3	579	5	CABANAS	CABA?AS
5	579	5	CRISTALINA	CRISTALINA
9	579	5	MALENA	MALENA
1	585	5	ARABIA	ARABIA
3	585	5	LA SIERRA	LA SIERRA
5	585	5	LOS LIMONES	LOS LIMONES
15	361	5	EL MEDIO	EL MEDIO
16	361	5	SAN PABLO DE RIOSUCIO	SAN PABLO DE RIOSUCIO
1	368	5	PALOCABILDO	PALOCABILDO
4	368	5	MONTECRISTO	MONTECRISTO
7	368	5	LOS PATIOS	LOS PATIOS
2	376	5	EL TAMBO	EL TAMBO
1	380	5	LA TABLAZA	LA TABLAZA
4	380	5	JUAN XXIII	JUAN XXIII
2	400	5	GUARUNGO	GUARUNGO
1	411	5	EL CARMEN	EL CARMEN
4	411	5	SAN DIEGO (PLACITA)	SAN DIEGO (PLACITA)
7	411	5	SAN CRISTOBAL	SAN CRISTOBAL
10	411	5	EL GUAMAL	EL GUAMAL
2	425	5	SAN LAUREANO	SAN LAUREANO
4	425	5	EL CENIZO	EL CENIZO
3	440	5	LA PRIMAVERA	LA PRIMAVERA
3	467	5	MONTE DE VENADO	MONTE DE VENADO
3	475	5	SAN ALEJANDRO	SAN ALEJANDRO
3	99	27	ISLA D PALACIOS	ISLA D PALACIOS
7	99	27	PUEBLO NUEVO	PUEBLO NUEVO
9	99	27	SAN JOSE DE LA CALLE	SAN JOSE DE LA CALLE
12	99	27	POGUE	POGUE
14	99	27	PUERTO LOPEZ	PUERTO LOPEZ
1	135	27	BOCA DE RASPADURA	BOCA DE RASPADURA
5	135	27	GUAPANDO	GUAPANDO
8	135	27	PAVAZA	PAVAZA
1	205	27	ACOSO	ACOSO
3	205	27	EL GUAMO	EL GUAMO
6	205	27	MANDINGA	MANDINGA
8	205	27	SANTANDER ANA	SANTANDER ANA
10	205	27	SANTANDER RITA	SANTANDER RITA
13	205	27	CALLE DEL CEDRO	CALLE DEL CEDRO
16	205	27	CONSUELO ANDRAPA	CONSUELO ANDRAPA
1	245	27	LA PLAYA	LA PLAYA
4	245	27	LA MANSA	LA MANSA
6	245	27	EL SIETE 2	EL SIETE 2
2	250	27	CARRA	CARRA
7	1	27	BOCA DE BEBARA	BOCA DE BEBARA
11	1	27	CALAHORRA	CALAHORRA
13	1	27	CAMPOBONITO	CAMPOBONITO
15	1	27	GUARANDO	GUARANDO
18	1	27	LAS MERCEDES	LAS MERCEDES
9	885	25	APOSENTOS	APOSENTOS
10	885	25	MONTANAS DE LIN	MONTA?AS DE LIN
17	885	25	EL CHOPON	EL CHOPON
2	898	25	PUEBLO VIEJO	PUEBLO VIEJO
4	898	25	LA CAPILLA	LA CAPILLA
2	899	25	BARANDILLAS	BARANDILLAS
5	899	25	RIO FRIO	RIO FRIO
7	899	25	SAN JORGE PALO BAJO	SAN JORGE PALO BAJO
1	745	25	EL PANTANO	EL PANTANO
1	754	25	EL CHARQUITO	EL CHARQUITO
3	754	25	LA DESPENSA	LA DESPENSA
8	754	25	SAN JORGE	SAN JORGE
10	754	25	LA VEREDITA	LA VEREDITA
2	758	25	CENTRO ALTO	CENTRO ALTO
5	758	25	CHUSCAL	CHUSCAL
2	769	25	LA PRADERA	LA PRADERA
2	772	25	SANTANDER ROSITA	SANTANDER ROSITA
1	793	25	PARAMO ALTO	PARAMO ALTO
1	797	25	LA GRAN VIA	LA GRAN VIA
1	805	25	BATEAS	BATEAS
3	805	25	SAN LUIS DE CHIS	SAN LUIS DE CHIS
1	815	25	PUBENZA	PUBENZA
2	815	25	ALTO DE LA VIGA	ALTO DE LA VIGA
7	815	25	LA COLORADA	LA COLORADA
1	823	25	SAN ANTONIO DE GUILLERA	SAN ANTONIO DE GUILLERA
3	592	25	TOBIA	TOBIA
2	594	25	PUENTE QUETAME	PUENTE QUETAME
3	596	25	SANTANDER MARTA	SANTANDER MARTA
1	612	25	MANUEL SUR	MANUEL SUR
2	645	25	ZARAGOZA	ZARAGOZA
5	645	25	LAS ANGUSTIAS	LAS ANGUSTIAS
9	645	25	QUEBRADA GRANDE	QUEBRADA GRANDE
13	645	25	LAGUNA GRANDE	LAGUNA GRANDE
1	649	25	EL PILAR	EL PILAR
3	649	25	PORTONES	PORTONES
1	653	25	CAMANCHA	CAMANCHA
3	653	25	LAS MERCEDES	LAS MERCEDES
1	662	25	CAMBAO	CAMBAO
1	718	25	LA VICTORIA	LA VICTORIA
1	740	25	SAN RAFAEL	SAN RAFAEL
3	740	25	LA UNION	LA UNION
1	743	25	SANTANDER RITA	SANTANDER RITA
3	436	25	BERMEJAL ARRIBA	BERMEJAL ARRIBA
3	438	25	SAN PEDRO DE GUAJARY	SAN PEDRO DE GUAJARY
6	438	25	LOS ALPES	LOS ALPES
8	438	25	SAN FRANCISCO DEGAZADUJ	SAN FRANCISCO DEGAZADUJ
1	473	25	EL DIAMANTE	EL DIAMANTE
1	483	25	LA REFORMA BUSCAVIDA	LA REFORMA BUSCAVIDA
3	486	25	LA PUERTA	LA PUERTA
2	488	25	PUEBLO NUEVO	PUEBLO NUEVO
1	506	25	APOSENTOS	APOSENTOS
3	506	25	LA REFORMA	LA REFORMA
1	518	25	CUATRO CAMINOS	CUATRO CAMINOS
3	518	25	EL PLOMO EL PAR	EL PLOMO EL PAR
3	530	25	EL ENGANO	EL ENGANO
5	540	52	EL EJIDO	EL EJIDO
1	560	52	CARDENAS	CARDENAS
3	560	52	EL CARRIZAL	EL CARRIZAL
6	560	52	SAN PEDRO	SAN PEDRO
8	560	52	LA CENTINELA	LA CENTINELA
1	573	52	EL PARAMO	EL PARAMO
3	573	52	SAN MATEO	SAN MATEO
6	573	52	EL LLANO	EL LLANO
15	399	52	EL SAUCE	EL SAUCE
17	399	52	LAS CUCHILLAS	LAS CUCHILLAS
20	399	52	CUSILLO BAJO	CUSILLO BAJO
23	399	52	RINCON CUSILLO	RINCON CUSILLO
26	399	52	PALOVERDE	PALOVERDE
3	228	20	SAN SEBASTIAN	SAN SEBASTIAN
4	228	20	SANTA ISABEL	SANTA ISABEL
5	228	20	CHAMPAN	CHAMPAN
6	228	20	ALGARROBO	ALGARROBO
7	228	20	GUAIMARAL	GUAIMARAL
8	228	20	BARRIO ACOSTA	BARRIO ACOSTA
9	228	20	HOJANCHA	HOJANCHA
10	228	20	LAS VEGAS	LAS VEGAS
2	238	20	CARACOLICITO	CARACOLICITO
3	238	20	CHIMILA	CHIMILA
1	250	20	EL BAYITO	EL BAYITO
2	250	20	LA LOMA	LA LOMA
1	295	20	ESTACION	ESTACION
2	295	20	EL CONTENTO	EL CONTENTO
4	295	20	PALENQUILLO	PALENQUILLO
6	295	20	PUERTO VIEJO	PUERTO VIEJO
7	295	20	CASCAJAL	CASCAJAL
2	310	20	BURBURA	BURBURA
3	310	20	CULEBRITA	CULEBRITA
5	310	20	LA FLORESTA	LA FLORESTA
7	310	20	SAN ISIDRO	SAN ISIDRO
9	310	20	MATA DE FIQUE	MATA DE FIQUE
2	383	20	CAROLINA	CAROLINA
3	383	20	MOLINA	MOLINA
5	383	20	SIMANA	SIMA?A
6	383	20	BESOTE	BESOTE
9	383	20	EL CRUCE	EL CRUCE
32	1	20	VEGA ARRIBA	VEGA ARRIBA
34	1	20	VILLA GERMANIA	VILLA GERMANIA
2	11	20	BOQUERON	BOQUERON
3	11	20	CERRO REDONDO	CERRO REDONDO
4	11	20	CUATRO BOCAS	CUATRO BOCAS
6	11	20	LOMA CORREDOR	LOMA CORREDOR
8	11	20	MUCURAS	MUCURAS
9	11	20	PATINO	PATINO
11	11	20	NOREAN	NOREAN
14	11	20	SAN ANDRES TOTUMA	SAN ANDRES TOTUMA
16	11	20	LAS JUNTAS	LAS JUNTAS
18	11	20	PUERTO AMALIA	PUERTO AMALIA
20	11	20	LA MORENA	LA MORENA
21	11	20	VILLA NUEVA	VILLA NUEVA
1	13	20	SN JACINTO	SN JACINTO
3	13	20	LLERASCA	LLERASCA
5	13	20	MIMGUILLO	MIMGUILLO
1	32	20	ARJONA	ARJONA
1	45	20	ESTADOS UNIDOS	ESTADOS UNIDOS
2	45	20	TAMAQUITO	TAMAQUITO
2	60	20	BOCAS D TIGRE	BOCAS D TIGRE
4	60	20	LOMA COLORADA	LOMA COLORADA
4	175	20	CANDELARIA	CANDELARIA
5	175	20	EL GUAMO	EL GUAMO
8	175	20	LAS FLORES	LAS FLORES
10	175	20	MANDIGUILLA	MANDIGUILLA
11	175	20	SALOA	SALOA
14	175	20	SOLEDAD	SOLEDAD
16	175	20	LA MATA	LA MATA
17	175	20	EL CANAL	EL CANAL
19	175	20	TRONCONAL	TRONCONAL
7	809	19	SAN JOSE	SAN JOSE
9	809	19	SANTA ROSA DE SAIJA	SANTA ROSA DE SAIJA
11	809	19	BOCA DE PATIA	BOCA DE PATIA
13	809	19	EL REALITO	EL REALITO
15	809	19	BRAZO CORTO	BRAZO CORTO
18	809	19	CUPI	CUPI
19	809	19	SOLEDAD DE YANTIN	SOLEDAD DE YANTIN
2	821	19	LA DESPENSA	LA DESPENSA
4	821	19	NATALA	NATALA
6	821	19	SANTO DOMINGO	SANTO DOMINGO
38	1	52	PASIPARA	PASIPARA
39	1	52	EL CONVENTO	EL CONVENTO
2	223	50	EL DORADO	EL DORADO
3	226	50	PUERTO PECUCA	PUERTO PECUCA
7	226	50	CANEY MEDIO	CANEY MEDIO
9	226	50	MONTEBELLO	MONTEBELLO
1	245	50	MONTFORT	MONTFORT
4	245	50	SANTANDER ELENA	SANTANDER ELENA
2	251	50	SAN ISIDRO	SAN ISIDRO
3	251	50	MIRAVALLES	MIRAVALLES
2	287	50	PUERTO LIMON	PUERTO LIMON
4	287	50	UNION DEL ARIARI	UNION DEL ARIARI
5	287	50	LA COOPERATIVA	LA COOPERATIVA
2	313	50	DOS QUEBRADAS	DOS QUEBRADAS
5	313	50	PUERTO CALDAS	PUERTO CALDAS
1	318	50	HUMADEA	HUMADEA
2	318	50	PIO XII	PIO XII
2	330	50	JARDIN D L PENA	JARDIN D L PE?A
1	400	50	CACAYAL	CACAYAL
1	568	50	PLANAS	PLANAS
3	568	50	CHAVIVA	CHAVIVA
4	568	50	S.MIGUEL*PESCAD	S.MIGUEL*PESCAD
11	683	52	SAN GABRIEL	SAN GABRIEL
13	683	52	SAN ISIDRO	SAN ISIDRO
2	687	52	SANTA CECILIA	SANTA CECILIA
4	687	52	SAN CLEMENTE	SAN CLEMENTE
6	687	52	LA HONDA	LA HONDA
1	693	52	BELLAVISTA	BELLAVISTA
3	693	52	EL ALTO	EL ALTO
4	693	52	LA CANADA	LA CA?ADA
5	693	52	LA CHORRERA	LA CHORRERA
6	693	52	LOS ROBLES	LOS ROBLES
7	693	52	YUNGUILLA	YUNGUILLA
8	693	52	LOS LLANOS	LOS LLANOS
9	693	52	DERRUMBES	DERRUMBES
10	693	52	LAS JUNTAS	LAS JUNTAS
11	693	52	RAMAL	RAMAL
12	693	52	EL ALTO N 2	EL ALTO N 2
13	693	52	BATEROS	BATEROS
14	693	52	FRANCIA	FRANCIA
15	693	52	LA CUCHILLA	LA CUCHILLA
16	693	52	EL LINDERO	EL LINDERO
1	696	52	ATANASIO GIRARDOT	ATANASIO GIRARDOT
2	696	52	CHANZARA	CHANZARA
3	696	52	PACIFICO	PACIFICO
4	696	52	SANABRIA	SANABRIA
5	696	52	SANTANDER	SANTANDER
6	696	52	FRANCISCO DE PARADA	FRANCISCO DE PARADA
7	696	52	TOMAS CMOSQUERA	TOMAS CMOSQUERA
9	696	52	PALOMINO	PALOMINO
9	255	68	LIMITES	LIMITES
12	255	68	SANTA BARBARA	SANTA BARBARA
14	255	68	SAN PEDRO DE TIGRA	SAN PEDRO DE TIGRA
1	266	68	LA MAYORIA	LA MAYORIA
3	266	68	LOS ROBLES	LOS ROBLES
5	266	68	ROSA BLANCA	ROSA BLANCA
7	266	68	SANTA HELENA	SANTA HELENA
1	271	68	LA VENTA	LA VENTA
3	162	68	CORNEJO	CORNEJO
4	162	68	CORRAL FALSO	CORRAL FALSO
5	162	68	MOJICONES	MOJICONES
7	162	68	SERVITA	SERVITA
9	162	68	MORTINO	MORTINO
1	167	68	CANTERA	CANTERA
2	167	68	CA AVERALES	CA AVERALES
4	167	68	GUACAMAYAS	GUACAMAYAS
2	169	68	PIRITA	PIRITA
3	169	68	OVEJERA	OVEJERA
5	169	68	LA RINCONADA	LA RINCONADA
1	176	68	LA PIEDRA	LA PIEDRA
2	179	68	MIRABUENO	MIRABUENO
3	179	68	BATAN	BATAN
5	179	68	CHIPATA VIEJO	CHIPATA VIEJO
7	179	68	EL CUCHARO	EL CUCHARO
9	179	68	SAN MIGUEL	SAN MIGUEL
2	190	68	PUERTO ARAUJO	PUERTO ARAUJO
4	190	68	ZAMBITO	ZAMBITO
5	190	68	DOS HERMANOS	DOS HERMANOS
7	190	68	EXPLANACION NUTRIAS	EXPLANACION NUTRIAS
9	190	68	LA VERDE	LA VERDE
10	190	68	GUAYABITO	GUAYABITO
12	190	68	CAMPO SECO	CAMPO SECO
14	190	68	SN FERNANDO	SN FERNANDO
16	190	68	LOS MORROS(LAYE)	LOS MORROS(LAYE)
3	207	68	RIO COLORADO	RIO COLORADO
6	207	68	JURADITO	JURADITO
7	207	68	TENERIFE	TENERIFE
9	207	68	CUEVA GRANDE	CUEVA GRANDE
6	282	5	COMBIA GRANDE	COMBIA GRANDE
8	282	5	EL ZANCUDO	EL ZANCUDO
10	282	5	EL PLAN	EL PLAN
11	282	5	EL EDEN	EL EDEN
12	282	5	UVITAL	UVITAL
1	284	5	CARAUTA	CARAUTA
2	284	5	EL CERRO	EL CERRO
3	284	5	CHONTADURO	CHONTADURO
5	284	5	MUSINGA	MUSINGA
7	284	5	PONTON	PONTON
8	284	5	FUEMIA	FUEMIA
10	284	5	SAN LAZARO	SAN LAZARO
11	284	5	NO BOGA	NO BOGA
2	308	5	SAN ANDRES	SAN ANDRES
3	308	5	EL TOTUMO	EL TOTUMO
4	308	5	LAPALMA	LAPALMA
13	154	5	CARACOLI	CARACOLI
14	154	5	RIO VIEJO	RIO VIEJO
16	154	5	EL SABALO	EL SABALO
18	154	5	EL TONO	EL TONO
19	154	5	EL GUTINAJO	EL GUTINAJO
3	172	5	BARRANQUILLITA	BARRANQUILLITA
2	190	5	FATIMA	FATIMA
4	190	5	EL LIMON	EL LIMON
4	197	5	LA PLACITA	LA PLACITA
6	197	5	FARALLONES	FARALLONES
7	197	5	CRUCES	CRUCES
9	197	5	LA PRIMAVERA	LA PRIMAVERA
11	197	5	LA GRANJA	LA GRANJA
12	197	5	PAILANIA	PAILANIA
2	209	5	MORELIA	MORELIA
3	209	5	MORITOS	MORITOS
5	209	5	LAS ANIMAS	LAS ANIMAS
6	209	5	EL GOLPE	EL GOLPE
1	212	5	BARRIO DE MARIA	BARRIO DE MARIA
2	212	5	VILLANUEVA	VILLANUEVA
3	212	5	PENOLCITO	PE?OLCITO
4	212	5	QUEBRADA ARRIBA	QUEBRADA ARRIBA
5	212	5	EL SALADO	EL SALADO
6	212	5	SABANETA	SABANETA
7	212	5	ZARZAL(CURAZAO)	ZARZAL(CURAZAO)
8	212	5	EL CABUYAL	EL CABUYAL
9	212	5	CANOAS	CANOAS
10	212	5	EL NAVAL(TOLDA)	EL NAVAL(TOLDA)
11	212	5	ZARZAL(LA LUZ)	ZARZAL(LA LUZ)
12	212	5	EL TABLAZO	EL TABLAZO
13	212	5	LA LOMITA	LA LOMITA
14	212	5	EL ALVARADO	EL ALVARADO
15	212	5	EL AMOR	EL AMOR
16	212	5	CIUDAD MACHADO	CIUDAD MACHADO
1	234	5	ARMENIA	ARMENIA
3	234	5	GALILEA	GALILEA
4	234	5	URAMAGRANDE	URAMAGRANDE
7	234	5	CARRA	CARRA
8	234	5	CAMPARRUSIA	CAMPARRUSIA
9	234	5	LLANO GRANDE	LLANO GRANDE
10	120	5	PIAMONTE(SAN RAFAEL)	PIAMONTE(SAN RAFAEL)
11	120	5	NUEVA ESPERANZA	NUEVA ESPERANZA
1	125	5	ASESI	ASESI
2	125	5	LA SALAZAR	LA SALAZAR
1	129	5	EL CANO	EL CA?O
2	129	5	LA RAYA	LA RAYA
3	129	5	MATADERO	MATADERO
4	129	5	LA MIEL	LA MIEL
5	129	5	LA CORRALA	LA CORRALA
6	129	5	PRIMAVERA	PRIMAVERA
1	134	5	LA CHIQUITA	LA CHIQUITA
2	134	5	SOLITA	SOLITA
3	134	5	LLANADAS	LLANADAS
5	134	5	MORROPELON	MORROPELON
8	134	5	LOS CHORROS	LOS CHORROS
1	138	5	BUENOS AIRES	BUENOS AIRES
2	138	5	CASTILLAL	CASTILLAL
3	138	5	JUNTAS URAMITA	JUNTAS URAMITA
5	138	5	SAN PASCUAL	SAN PASCUAL
6	138	5	VERSALLES	VERSALLES
7	138	5	LA BALSA	LA BALSA
8	138	5	EL MADERO	EL MADERO
1	142	5	SARDINAS	SARDINAS
2	142	5	CASCARON	CASCARON
3	142	5	EL BAGRE	EL BAGRE
4	142	5	LAS AGUILAS	LAS AGUILAS
5	142	5	LA FONTANA	LA FONTANA
6	142	5	SANTA ROSA	SANTA ROSA
1	145	5	ALEGRIAS	ALEGRIAS
2	145	5	SUCRE	SUCRE
3	145	5	BARRO BLANCO	BARRO BLANCO
1	147	5	BIJAGUAL	BIJAGUAL
2	147	5	CAMPAMENTO	CAMPAMENTO
1	148	5	SANTA INES	SANTA INES
2	148	5	SANTA RITA	SANTA RITA
3	148	5	AGUAS CLARAS	AGUAS CLARAS
4	148	5	LA MARIA	LA MARIA
5	148	5	LA CHAPA	LA CHAPA
6	148	5	CAMPO ALEGRE	CAMPO ALEGRE
7	148	5	LA ESPERANZA	LA ESPERANZA
8	148	5	LA MADERA	LA MADERA
1	150	5	GUANACAS	GUANACAS
3	154	5	CUTURU	CUTURU
4	154	5	CHONTADURO	CHONTADURO
10	1	27	CABI	CABI
12	1	27	CAMPO SANTO	CAMPO SANTO
14	1	27	DONA JOSEFA	DO?A JOSEFA
16	1	27	GUAYABAL	GUAYABAL
17	1	27	LA TROJE	LA TROJE
19	1	27	NAURITA	NAURITA
20	1	27	NEGUA	NEGUA
21	1	27	NEMOTA	NEMOTA
22	1	27	PAIMADO	PAIMADO
23	1	27	SAMURINDO	SAMURINDO
24	1	27	SAN FRANCISCO DE ICHO	SAN FRANCISCO DE ICHO
7	821	19	TACUEYO	TACUEYO
1	824	19	EL HATICO	EL HATICO
3	824	19	NOVIRAO	NOVIRAO
4	824	19	PANIQUITA	PANIQUITA
6	824	19	PORTACHUELO	PORTACHUELO
7	824	19	JEVALA	JEVALA
1	1	20	AGUAS BLANCAS	AGUAS BLANCAS
3	1	20	BADILLO	BADILLO
4	1	20	LA CAJA	LA CAJA
6	1	20	CHEMESQUEMENA	CHEMESQUEMENA
9	1	20	GUACOCHE	GUACOCHE
11	1	20	LA MINA	LA MINA
13	1	20	MARIANGOLA	MARIANGOLA
14	1	20	PATILLAL	PATILLAL
17	1	20	SAN SEBASTIAN	SAN SEBASTIAN
19	1	20	CAMPERUCHO	CAMPERUCHO
20	1	20	EL PERRO	EL PERRO
22	1	20	GUACOCHITO	GUACOCHITO
5	530	25	GUAICARAMO	GUAICARAMO
2	535	25	GUACHIPAS	GUACHIPAS
2	572	25	PUERTO ROJO	PUERTO ROJO
4	317	25	NENGUA	NENGUA
1	320	25	GUADUERO	GUADUERO
3	320	25	PUERTO BOGOTA	PUERTO BOGOTA
6	320	25	CEDRALES	CEDRALES
1	322	25	SANTUARIO	SANTUARIO
1	326	25	SANTANDERMARIA	SANTANDERMARIA
1	335	25	TUNQUE	TUNQUE
1	372	25	CLARAVAL	CLARAVAL
3	372	25	EL SALITRICO	EL SALITRICO
4	377	25	EL HATO	EL HATO
7	377	25	MARQUEZ	MARQUEZ
1	386	25	LA ESPERANZA	LA ESPERANZA
3	386	25	SAN JOAQUIN	SAN JOAQUIN
3	394	25	LA HOYA  TUDELA	LA HOYA  TUDELA
3	426	25	CORRALILLOS	CORRALILLOS
1	430	25	LA CUESTA	LA CUESTA
1	436	25	QUIUMBITA	QUIUMBITA
1	723	15	SATIVAVIEJO	SATIVAVIEJO
6	753	15	LA COSTA	LA COSTA
1	755	15	CHIPAVIEJO	CHIPAVIEJO
4	755	15	LOS PINOS	LOS PINOS
6	755	15	COSCATIVA	COSCATIVA
2	757	15	PUEBLO NUEVO	PUEBLO NUEVO
2	759	15	MORTINAL	MORTINAL
1	476	15	PANELAS	PANELAS
2	491	15	CHAMEZA MAYOR	CHAMEZA MAYOR
3	507	15	CACHIPAY	CACHIPAY
6	507	15	SAN JOSE DE NAZA	SAN JOSE DE NAZA
1	516	15	PALERMO	PALERMO
3	516	15	LLANO GRANDE	LLANO GRANDE
5	516	15	PANTANO DE VARGAS	PANTANO DE VARGAS
4	599	54	SAN ISIDRO	SAN ISIDRO
2	660	54	LA LAGUNA	LA LAGUNA
3	660	54	MONTECRISTO	MONTECRISTO
5	660	54	SAN JOSE DE AVILA	SAN JOSE DE AVILA
1	670	54	ALGARROBOS	ALGARROBOS
2	670	54	BANDERAS	BANDERAS
4	670	54	EL ESPEJO	EL ESPEJO
6	670	54	MESALLANA	MESALLANA
7	670	54	PALMARITO	PALMARITO
9	670	54	SAN JERONIMO	SAN JERONIMO
11	670	54	PUENTE REAL	PUENTE REAL
12	670	54	SANTA CATALINA	SANTA CATALINA
2	673	54	CORNEJO	CORNEJO
4	673	54	TABIRO	TABIRO
5	673	54	URIMACO	URIMACO
2	680	54	LOS NARANJOS	LOS NARANJOS
2	720	54	EL CARMEN	EL CARMEN
4	720	54	LAS MERCEDES	LAS MERCEDES
5	720	54	LUIS VERO	LUIS VERO
14	109	76	EL TRIGAL	EL TRIGAL
15	109	76	GAMBOA	GAMBOA
16	109	76	GUADUALITO	GUADUALITO
17	109	76	KILOMETRO 43	KILOMETRO 43
18	109	76	LA CONCEPCION	LA CONCEPCION
19	109	76	LA PLATA	LA PLATA
20	109	76	LA TROJITA	LA TROJITA
21	109	76	LADRILLEROS	LADRILLEROS
22	109	76	LLANOBAJO	LLANOBAJO
23	109	76	MALAGA	MALAGA
24	109	76	MAYORQUIN	MAYORQUIN
25	109	76	NICOLAS RAMOS H	NICOLAS RAMOS H
26	109	76	POTEDO	POTEDO
27	109	76	PUERTO ESPANA	PUERTO ESPA?A
28	109	76	PUERTO MERIZALDE	PUERTO MERIZALDE
29	109	76	PUERTO NAYA	PUERTO NAYA
30	109	76	PUNTA SOLDADO	PUNTA SOLDADO
31	109	76	SAN ANTONIO DE YURUMAGU	SAN ANTONIO DE YURUMAGU
3	870	73	BETULIA QUEBRADA NEGRA	BETULIA QUEBRADA NEGRA
4	870	73	PLATANILLAL	PLATANILLAL
5	870	73	GUAYABAL	GUAYABAL
6	870	73	PATIBURRI	PATIBURRI
7	870	73	YARUMAL	YARUMAL
7	679	68	LA FLORA	LA FLORA
4	750	20	EL DESASTRE	EL DESASTRE
5	750	20	EL JUNCAL	EL JUNCAL
6	750	20	EL RINCON	EL RINCON
7	750	20	LAS PITILLAS	LAS PITILLAS
8	750	20	LAS TRUPIAS	LAS TRUPIAS
9	750	20	LOS BRASILES	LOS BRASILES
10	750	20	SAB DEL TESORO	SAB DEL TESORO
11	750	20	TOCAIMO	TOCAIMO
12	750	20	NUEVAS FLORES	NUEVAS FLORES
1	770	20	AGUAS BLANCAS	AGUAS BLANCAS
2	770	20	EL BARRO	EL BARRO
3	770	20	MINAS	MINAS
4	770	20	PUETO OCULTO	PUETO OCULTO
5	770	20	SAN JOSE	SAN JOSE
20	175	20	PLATA PERDIDA	PLATA PERDIDA
21	175	20	JUAN MARCOS	JUAN MARCOS
6	178	20	POPONTE	POPONTE
8	178	20	RINCON HONDO	RINCON HONDO
11	178	20	EL CARMEN	EL CARMEN
12	178	20	ESTACION EL PASO	ESTACION EL PASO
13	178	20	BAUTISTA	BAUTISTA
14	178	20	LA AURORA	LA AURORA
15	178	20	ESTACION CHIRIGUANA	ESTACION CHIRIGUANA
16	178	20	LA SIERRA	LA SIERRA
1	228	20	SABANAGRANDE	SABANAGRANDE
2	228	20	SAN ROQUE	SAN ROQUE
4	385	68	LA MELONA	LA MELONA
5	385	68	PLAN DE ARMAS	PLAN DE ARMAS
6	385	68	SAN IGNACIO DEL OPON	SAN IGNACIO DEL OPON
7	385	68	MIRALINDO	MIRALINDO
8	385	68	KILOMETRO 15	KILOMETRO 15
1	397	68	EL HATO	EL HATO
2	397	68	LA LOMA	LA LOMA
3	397	68	EL CENTRO	EL CENTRO
4	397	68	EL TIGRE	EL TIGRE
5	397	68	TROCHAS	TROCHAS
1	406	68	AGUIRRE	AGUIRRE
2	406	68	CENTENARIO	CENTENARIO
3	406	68	CONCHAL	CONCHAL
4	406	68	CHUSPAS	CHUSPAS
6	406	68	LA AGUADA	LA AGUADA
8	406	68	LA PAZ	LA PAZ
12	406	68	SARDINAS	SARDINAS
14	406	68	VANEGAS	VANEGAS
4	271	68	AREPITAS	AREPITAS
6	271	68	TRAVESIAS	TRAVESIAS
2	276	68	BARRIO CALDAS	BARRIO CALDAS
4	276	68	EL REPOSO	EL REPOSO
5	276	68	VILLABEL	VILLABEL
9	430	13	EL RETIRO	EL RETIRO
11	430	13	HENEQUEN	HENEQUEN
13	430	13	JUAN ARIAS	JUAN ARIAS
15	430	13	LA VENTURA	LA VENTURA
16	430	13	LAS BRISAS	LAS BRISAS
18	430	13	PALMARITO	PALMARITO
20	430	13	PINALITO	PI?ALITO
22	430	13	SAN JOSE DE LAS MARTAS	SAN JOSE DE LAS MARTAS
17	41	76	EL CAFE	EL CAFE
18	41	76	LA POPALITA	LA POPALITA
19	41	76	LA PRIMAVERA	LA PRIMAVERA
1	54	76	LA PAZ	LA PAZ
5	54	76	LA AURORA	LA AURORA
6	54	76	LA PALMA	LA PALMA
7	54	76	COROZAL	COROZAL
10	54	76	LA MARINA	LA MARINA
1	100	76	BETANIA	BETANIA
2	100	76	CERRO AZUL	CERRO AZUL
3	100	76	CATRES	CATRES
4	100	76	DOSQUEBRADAS	DOSQUEBRADAS
5	100	76	GUARE	GUARE
6	100	76	LA HERRADURA	LA HERRADURA
7	100	76	LA TULIA	LA TULIA
8	100	76	NARANJAL	NARANJAL
9	100	76	PRIMAVERA	PRIMAVERA
10	100	76	RICAURTE	RICAURTE
11	100	76	SANTA TERESA	SANTA TERESA
12	100	76	AGUAS LINDAS	AGUAS LINDAS
13	100	76	LA MONTANUELA	LA MONTANUELA
14	100	76	SAN FERNANDO	SAN FERNANDO
15	100	76	POTOSI	POTOSI
16	100	76	LAS CABANAS	LAS CABA?AS
17	100	76	RIO DOVIO	RIO DOVIO
1	109	76	AGUACLARA	AGUACLARA
2	109	76	BARCOS	BARCOS
3	109	76	BAZAN	BAZAN
4	109	76	BOCAS DE CALIMA	BOCAS DE CALIMA
5	109	76	BOCAS DL S JUAN	BOCAS DL S JUAN
6	109	76	CALIMA	CALIMA
7	109	76	CALLE HONDA	CALLE HONDA
8	109	76	CISNEROS	CISNEROS
9	109	76	CORDOBA	CORDOBA
10	109	76	EL CARMEN	EL CARMEN
11	109	76	EL PASTICO	EL PASTICO
12	109	76	EL PITAL	EL PITAL
13	109	76	EL TIGRE	EL TIGRE
23	1	52	CABRERA	CABRERA
25	1	52	DOLORES	DOLORES
27	1	52	BUESAQUILLO DOS	BUESAQUILLO DOS
28	1	52	PUENTE TABLA	PUENTE TABLA
30	1	52	CUJACAL DOS	CUJACAL DOS
32	1	52	TESCUAL	TESCUAL
34	1	52	ANGANOY	ANGANOY
35	1	52	DAZA	DAZA
36	1	52	CASABUY	CASABUY
9	678	52	EL MOTILON(MESA	EL MOTILON(MESA
12	678	52	CHUGULDI(CHUPIN	CHUGULDI(CHUPIN
2	473	52	MORALES OLAYA	MORALES OLAYA
5	473	52	COCALITO	COCALITO
6	473	52	FIRME LOS CIFUENTES	FIRME LOS CIFUENTES
3	490	52	CORDOBA(CARMEN)	CORDOBA(CARMEN)
5	490	52	LERIDA(LAS MARIAS)	LERIDA(LAS MARIAS)
7	490	52	MERIZALDE PORVENIR	MERIZALDE PORVENIR
10	490	52	URIBE URIBE	URIBE URIBE
3	506	52	GAVILANES	GAVILANES
5	506	52	CUNCHILLA MORENA	CUNCHILLA MORENA
2	520	52	NICANOR VALENCIA	NICANOR VALENCIA
6	520	52	VICTOR CALONGE	VICTOR CALONGE
8	520	52	HUGO BELALCAZAR	HUGO BELALCAZAR
10	520	52	LAUREANO ARELLA	LAUREANO ARELLA
2	540	52	MADRIGAL	MADRIGAL
29	361	27	MONTEBRAVO	MONTEBRAVO
32	361	27	NOANAMA	NOANAMA
36	361	27	PANAMACITO	PANAMACITO
42	361	27	PUERTO NUEVO	PUERTO NUEVO
45	361	27	PRIMAVERA	PRIMAVERA
49	361	27	SAN ANTONIO	SAN ANTONIO
16	498	54	ESPIRITU SANTO	ESPIRITU SANTO
18	498	54	LAS CHIRCAS	LAS CHIRCAS
21	498	54	VENADILLO	VENADILLO
13	25	27	CHIGORODO	CHIGORODO
2	73	27	CHAMBARE	CHAMBARE
5	73	27	LA SIERRA	LA SIERRA
7	73	27	SAN MARINO	SAN MARINO
9	73	27	EL SALTO	EL SALTO
11	73	27	VIVICORA	VIVICORA
2	75	27	EL VALLE	EL VALLE
5	75	27	JUNA	JUNA
7	75	27	NABUGA	NABUGA
2	77	27	BELEN DE DOCAMPADO	BELEN DE DOCAMPADO
5	77	27	CUEVITA	CUEVITA
8	77	27	ORPUA	ORPUA
10	77	27	PIE DE PEPE	PIE DE PEPE
13	77	27	PUERTO MELUK	PUERTO MELUK
15	77	27	PURRICHA	PURRICHA
17	77	27	TORREIDO DE ABAJO	TORREIDO DE ABAJO
20	77	27	ARENAL	ARENAL
22	77	27	PUNTA DE IGUA	PUNTA DE IGUA
25	77	27	BAUDOCITO-PUERTO	BAUDOCITO-PUERTO
27	77	27	PTO MELUK PACIFICO	PTO MELUK PACIFICO
9	899	25	ALTO DEL AGUILA	ALTO DEL AGUILA
3	1	27	BEBARAMA	BEBARAMA
6	1	27	BETE	BETE
8	1	50	VANGUARDIA	VANGUARDIA
9	1	50	PUERTO COLOMBIA	PUERTO COLOMBIA
10	1	50	SANTANDER MARIA LA BAJA	SANTANDER MARIA LA BAJA
11	1	50	STA TERESA	STA TERESA
1	6	50	DINAMARCA	DINAMARCA
2	6	50	MANZANARES	MANZANARES
3	6	50	S ISIDRO CHICHIMENE	S ISIDRO CHICHIMENE
1	110	50	GUACAVIA	GUACAVIA
2	110	50	VERACRUZ	VERACRUZ
3	110	50	SAN IGNACIO	SAN IGNACIO
2	124	50	GUAYABAL	GUAYABAL
3	124	50	VISO DE UPIA	VISO DE UPIA
1	150	50	SAN LORENZO	SAN LORENZO
1	555	47	APURE	APURE
2	555	47	EL CARMEN DE MAGDALENA	EL CARMEN DE MAGDALENA
3	555	47	NUEVA GRANADA	NUEVA GRANADA
4	555	47	PUEBLO NUEVO	PUEBLO NUEVO
5	555	47	ZARATE	ZARATE
6	555	47	AGUAS VIVAS	AGUAS VIVAS
7	555	47	CIENAGUETA	CIENAGUETA
8	555	47	CERRO GRANDE	CERRO GRANDE
9	555	47	LAS MERCEDES	LAS MERCEDES
10	555	47	LOS ANDES	LOS ANDES
11	555	47	SAN JOSE PURGAT	SAN JOSE PURGAT
12	555	47	SAN JOSE DEE MAGDALENA	SAN JOSE DEE MAGDALENA
13	555	47	SAN ROQUE L MUL	SAN ROQUE L MUL
14	555	47	CESPEDES	CESPEDES
15	555	47	DISCIPLINA	DISCIPLINA
16	555	47	LA GLORIA	LA GLORIA
1	570	47	BOCAS ARACATACA	BOCAS ARACATACA
2	570	47	ISLA DL.ROSARIO	ISLA DL.ROSARIO
3	570	47	PALMIRA	PALMIRA
4	570	47	TASAJERAS	TASAJERAS
5	570	47	TIERRA NUEVA	TIERRA NUEVA
2	605	47	CORRALVIEJO	CORRALVIEJO
3	605	47	EL DIVIDIVE	EL DIVIDIVE
4	605	47	SAN RAFAEL DE BUENAVIST	SAN RAFAEL DE BUENAVIST
5	605	47	SANTANDER RITA	SANTANDER RITA
6	605	47	EL SALADO	EL SALADO
7	605	47	MARTINETE	MARTINETE
8	605	47	LAS CASITAS	LAS CASITAS
1	675	47	GUAIMARO	GUAIMARO
2	675	47	JULEPE	JULEPE
4	675	47	EL ASERRADERO	EL ASERRADERO
1	692	47	BUENAVISTA	BUENAVISTA
2	692	47	EL COCO	EL COCO
3	692	47	LA PACHA	LA PACHA
4	692	47	LAS MARGARITAS	LAS MARGARITAS
5	692	47	LOS GALVIS	LOS GALVIS
6	692	47	MARIA ANTONIA	MARIA ANTONIA
7	692	47	SAN RAFAEL	SAN RAFAEL
8	692	47	SANTANDER ROSA	SANTANDER ROSA
9	692	47	TRONCOSITO	TRONCOSITO
10	692	47	TRONCOSO	TRONCOSO
11	692	47	VENERO	VENERO
12	692	47	EL DIVIDIVE	EL DIVIDIVE
13	692	47	EL SEIS	EL SEIS
14	692	47	SABANA D PERAL	SABANA D PERAL
16	692	47	LA PLACITA	LA PLACITA
17	692	47	JAIME	JAIME
18	692	47	SAN VALENTIN	SAN VALENTIN
1	703	47	ANGOSTURA	ANGOSTURA
2	703	47	BERMEJAL	BERMEJAL
3	703	47	EL PALOMAR	EL PALOMAR
4	703	47	JANEIRO	JANEIRO
5	703	47	LA MONTA A	LA MONTA A
6	703	47	PE ONCITO	PE ONCITO
10	258	47	LOS PATOS	LOS PATOS
11	258	47	VASQUEZ	VASQUEZ
1	288	47	ALGARROBO	ALGARROBO
2	288	47	BELLAVISTA	BELLAVISTA
115	835	52	EL GUABAL	EL GUABAL
116	835	52	EL GUACHAL	EL GUACHAL
117	835	52	EL GUALTAL	EL GUALTAL
119	835	52	EL RETORNO	EL RETORNO
120	835	52	JUAN DOMINGO	JUAN DOMINGO
122	835	52	KILOMETRO 35	KILOMETRO 35
124	835	52	KILOMETRO 58	KILOMETRO 58
125	835	52	LA ADUANA	LA ADUANA
127	835	52	LA LOMA	LA LOMA
128	835	52	LA PINUELA	LA PI?UELA
130	835	52	LAS VEGAS	LAS VEGAS
132	835	52	MASCARAY	MASCARAY
133	835	52	MILAGROS	MILAGROS
135	835	52	PINDALES	PINDALES
137	835	52	PUEBLO NUEVO	PUEBLO NUEVO
139	835	52	SAN IGNACIO	SAN IGNACIO
140	835	52	SOLEDAD	SOLEDAD
142	835	52	TANGAREAL MIRA	TANGAREAL MIRA
144	835	52	VILLA RICA	VILLA RICA
27	835	52	JOSE LLORENTE C	JOSE LLORENTE C
29	835	52	JULIO PLAZA	JULIO PLAZA
30	835	52	LA GUAYACANA	LA GUAYACANA
32	835	52	MATAJE	MATAJE
34	835	52	PABLO REINEL E.	PABLO REINEL E.
35	835	52	PACIFICO	PACIFICO
37	835	52	MIRAPALMA	MIRAPALMA
39	835	52	LA HONDA	LA HONDA
40	835	52	PROGRESO	PROGRESO
42	835	52	ROBLES	ROBLES
43	835	52	ROMULO D ORTIZ	ROMULO D ORTIZ
45	835	52	ROSA ZARATE	ROSA ZARATE
47	835	52	SALISVI	SALISVI
50	835	52	SAN JUAN	SAN JUAN
51	835	52	SAN ANTONIO	SAN ANTONIO
52	835	52	SANTANDER	SANTANDER
54	835	52	SERGIO PEREZ	SERGIO PEREZ
56	835	52	STELLA MARQUEZ	STELLA MARQUEZ
57	835	52	SUCRE	SUCRE
59	835	52	URIBE URIBE	URIBE URIBE
61	835	52	BAJO ZAPOTAL	BAJO ZAPOTAL
63	835	52	EL BAJITO	EL BAJITO
64	835	52	EL PAPAYAL	EL PAPAYAL
66	835	52	FCO JOSE DE CALDAS	FCO JOSE DE CALDAS
68	835	52	CALETA VIENTO L	CALETA VIENTO L
70	835	52	CHAPILAR	CHAPILAR
72	835	52	ALTO SAN AGUSTIN	ALTO SAN AGUSTIN
74	835	52	PEDRO VIEIRA	PEDRO VIEIRA
76	835	52	CHAPUL	CHAPUL
77	835	52	CHILVICITO	CHILVICITO
78	835	52	EL JAGUA	EL JAGUA
83	835	52	LAS SIRENAS	LAS SIRENAS
84	835	52	MAJAGUAL	MAJAGUAL
85	835	52	PALAY	PALAY
87	835	52	PULGANDE	PULGANDE
88	835	52	EL RETONO	EL RETONO
2	720	52	URIBE	URIBE
4	720	52	MALABER	MALABER
5	720	52	FLORESTA	FLORESTA
1	786	52	CORDOBA	CORDOBA
3	786	52	CURIACO	CURIACO
4	786	52	BELLAVISTA	BELLAVISTA
6	786	52	ALTO DE DIEGO	ALTO DE DIEGO
8	786	52	CHARGUAYACO	CHARGUAYACO
10	786	52	EL SALADO	EL SALADO
12	786	52	MAJUANDO	MAJUANDO
13	786	52	CONCORDIA 1	CONCORDIA 1
16	786	52	TURUMBAMBILLA	TURUMBAMBILLA
17	786	52	PUERTO DE LEON	PUERTO DE LEON
3	788	52	LA COCHA	LA COCHA
4	788	52	SAN FRANCISCO	SAN FRANCISCO
6	788	52	SAN RAFAEL	SAN RAFAEL
7	788	52	CEBADAL	CEBADAL
2	835	52	ALFONSO LOPEZ	ALFONSO LOPEZ
4	835	52	ANGEL M CALDAS	ANGEL M CALDAS
5	835	52	ARTURO LLORENTE	ARTURO LLORENTE
8	835	52	CABO MANGLARES	CABO MANGLARES
9	835	52	CAUNAPI	CAUNAPI
10	835	52	COLORADO	COLORADO
12	835	52	CHAJAL	CHAJAL
14	835	52	ELADIO POLO RODRIGUEZ	ELADIO POLO RODRIGUEZ
15	835	52	CALETA	CALETA
17	835	52	ESPRIELLA	ESPRIELLA
19	835	52	GILBERTO ALZATE	GILBERTO ALZATE
20	835	52	B COLORADO GUAL	B COLORADO GUAL
23	835	52	HERRERA	HERRERA
24	835	52	JORGE E. GAITAN	JORGE E. GAITAN
25	835	52	JORGE H. LEAL	JORGE H. LEAL
16	678	52	DONA ANA	DO?A ANA
18	678	52	EL LLANO	EL LLANO
1	683	52	BOLIVAR	BOLIVAR
3	683	52	SAN BERNARDO	SAN BERNARDO
5	683	52	SANTA ROSA	SANTA ROSA
7	683	52	ROMA Y CHAVES	ROMA Y CHAVES
8	683	52	BOHORQUEZ	BOHORQUEZ
9	683	52	PARAGUAY	PARAGUAY
7	361	27	COCOVE	COCOVE
10	361	27	CHAMBUN	CHAMBUN
14	361	27	DIPURDU	DIPURDU
17	361	27	EL DOS	EL DOS
18	361	27	FUGIANDO	FUGIANDO
20	361	27	LA LERMA	LA LERMA
21	361	27	LA PLAYITA	LA PLAYITA
22	361	27	LA RANCHA	LA RANCHA
23	361	27	LA VIBORA	LA VIBORA
24	361	27	LAS MOJARRAS	LAS MOJARRAS
28	361	27	MATARE	MATARE
30	361	27	MUNGIDO	MUNGIDO
33	361	27	OLAVE	OLAVE
34	361	27	PAIMADO	PAIMADO
39	361	27	PERRU	PERRU
41	361	27	POTEDO	POTEDO
44	361	27	PLAN DE RASPADURA	PLAN DE RASPADURA
46	361	27	QUEBRADA	QUEBRADA
48	361	27	SALAZAR	SALAZAR
51	361	27	SAN MIGUEL	SAN MIGUEL
17	498	54	LLANO LOS TRIGOS	LLANO LOS TRIGOS
19	498	54	PALO GRANDE	PALO GRANDE
20	498	54	PORTACHUELO	PORTACHUELO
1	518	54	LAUREANO GOMEZ	LAUREANO GOMEZ
3	518	54	LA PENA	LA PE?A
1	599	54	CANUELAL	CANUELAL
2	599	54	EL NARANJAL	EL NARANJAL
12	308	5	JUAN COJO	JUAN COJO
1	310	5	EL SALTO	EL SALTO
1	313	5	SANTA ANA	SANTA ANA
2	313	5	LA CASCADA	LA CASCADA
4	313	5	LOS MEDIOS	LOS MEDIOS
1	315	5	MALABRIGO	MALABRIGO
6	315	5	PATIO BONITO	PATIO BONITO
1	318	5	COLORADOS	COLORADOS
3	318	5	LA HONDA	LA HONDA
4	318	5	PIEDRAS BLANCAS	PIEDRAS BLANCAS
1	321	5	EL ROBLE	EL ROBLE
2	347	5	PUEBLITO	PUEBLITO
3	347	5	LLANO DE SAN JOSE	LLANO DE SAN JOSE
7	347	5	EL HATILLO	EL HATILLO
1	360	5	LOS GOMEZ	LOS GOMEZ
4	360	5	YARUMITO	YARUMITO
6	360	5	EL PEDREGAL	EL PEDREGAL
8	360	5	LA NATORITARIA	LA NATORITARIA
1	361	5	BADILLO	BADILLO
3	361	5	LA GRANJA	LA GRANJA
4	361	5	PASCUITA	PASCUITA
5	361	5	SANTA ANA	SANTA ANA
8	361	5	FINLANDIA	FINLANDIA
9	361	5	EL CEDRAL	EL CEDRAL
10	361	5	EL SOCORRO	EL SOCORRO
12	361	5	SAN JUANILLO	SAN JUANILLO
10	234	5	CRUCES DE URAMA	CRUCES DE URAMA
11	234	5	ARENERA	ARENERA
13	234	5	SANTA TERESA	SANTA TERESA
2	237	5	RIOGRANDE	RIOGRANDE
1	240	5	BRASIL	BRASIL
3	240	5	SEVILLA	SEVILLA
5	240	5	LA RENTA	LA RENTA
6	240	5	SOCORRO	SOCORRO
8	240	5	EL ZARZAL	EL ZARZAL
2	250	5	PUERTO CLAVER	PUERTO CLAVER
3	250	5	LAS FLORES	LAS FLORES
1	266	5	LAS PALMAS	LAS PALMAS
2	266	5	SALADO	SALADO
1	282	5	BERLIN	BERLIN
3	282	5	MINAS	MINAS
4	282	5	PUENTE IGLESIAS	PUENTE IGLESIAS
2	368	5	PALENQUE	PALENQUE
3	368	5	LA CASCADA	LA CASCADA
5	368	5	GUACAMAYAL	GUACAMAYAL
6	368	5	LA LEONA	LA LEONA
1	376	5	GUAICO GRANDE	GUAICO GRANDE
3	376	5	SAN JOSE	SAN JOSE
4	376	5	PAYUCO	PAYUCO
2	380	5	PUEBLO VIEJO	PUEBLO VIEJO
1	400	5	MESOPOTAMIA	MESOPOTAMIA
3	400	5	CHUSCALITO	CHUSCALITO
2	411	5	LA HONDA	LA HONDA
3	411	5	LA MERCED	LA MERCED
5	411	5	CURITI	CURITI
6	411	5	EL POTRERO	EL POTRERO
8	411	5	BELEN	BELEN
9	411	5	SOBRESABANA	SOBRESABANA
11	411	5	LOS PENOLES	LOS PE?OLES
1	425	5	LA SUSANA	LA SUSANA
3	425	5	LA FLORESTA	LA FLORESTA
1	440	5	BELEN	BELEN
2	440	5	LA DALIA	LA DALIA
1	467	5	SABALETAS	SABALETAS
2	467	5	EL TABLAZO	EL TABLAZO
4	467	5	EL CARMELO	EL CARMELO
1	475	5	OPOGADO	OPOGADO
2	99	27	BOJAYA LA LOMA	BOJAYA LA LOMA
4	99	27	LA BOBA	LA BOBA
5	99	27	NAPIPI	NAPIPI
6	99	27	APOGADO	APOGADO
8	99	27	PUERTO CONTO	PUERTO CONTO
10	99	27	SANTANDER CRUZ	SANTANDER CRUZ
11	99	27	VERACRUZ	VERACRUZ
13	99	27	MESOPOTAMIA	MESOPOTAMIA
2	135	27	LA VICTORIA	LA VICTORIA
3	135	27	PUERTO PERVEL	PUERTO PERVEL
4	135	27	TARIDO	TARIDO
6	135	27	JORODO	JORODO
7	135	27	LA ISLA	LA ISLA
9	135	27	SAN LUIS	SAN LUIS
2	205	27	CORODO	CORODO
4	205	27	LA FLORIDA	LA FLORIDA
5	205	27	LA MURINA	LA MURINA
7	205	27	OPOGODO	OPOGODO
9	205	27	SANTANDER BARBARA	SANTANDER BARBARA
11	205	27	TAJUATO	TAJUATO
12	205	27	VIROVIRO	VIROVIRO
14	205	27	LA PLANTA	LA PLANTA
15	205	27	ILARIA	ILARIA
17	205	27	EL PASO	EL PASO
18	205	27	LA ENCHARCAZON	LA ENCHARCAZON
2	245	27	EL PINON	EL PI?ON
3	245	27	GUADUAS	GUADUAS
5	245	27	EL PORVENIR	EL PORVENIR
7	245	27	EL SIETE 1	EL SIETE 1
1	250	27	BURUJON	BURUJON
3	250	27	COPOMA	COPOMA
5	250	27	CUCURRUPI	CUCURRUPI
6	250	27	CHAPPIEN	CHAPPIEN
8	250	27	CHONTADURO	CHONTADURO
10	250	27	EL COCO	EL COCO
11	250	27	EL CHONCHO	EL CHONCHO
17	6	27	RUFINO	RUFINO
1	25	27	ALMENDRO	ALMENDRO
3	25	27	APARTADO	APARTADO
5	25	27	DUBAZA	DUBAZA
6	25	27	NAUCA	NAUCA
8	25	27	SANTANDER CATALINA	SANTANDER CATALINA
9	25	27	URUDO	URUDO
10	25	27	YUCAL	YUCAL
12	25	27	BELLAVISTA	BELLAVISTA
1	73	27	AGUASAL	AGUASAL
3	73	27	DABAIBE	DABAIBE
4	73	27	ENGRIVADO	ENGRIVADO
6	73	27	PIEDRA HONDA	PIEDRA HONDA
8	73	27	TAPERA	TAPERA
10	73	27	PLAYA BONITA	PLAYA BONITA
12	73	27	PESCADITO	PESCADITO
1	75	27	CUPICA	CUPICA
3	75	27	GUACA	GUACA
4	75	27	GUINA	GUINA
6	75	27	MECANA	MECANA
8	75	27	TEBADA	TEBADA
3	77	27	BERIGUADO	BERIGUADO
4	77	27	BOCA DE PEPE	BOCA DE PEPE
6	77	27	DOTENEDO	DOTENEDO
7	77	27	HIJUA	HIJUA
9	77	27	PABAZA	PABAZA
11	77	27	PILIZA	PILIZA
12	77	27	PLAYITA	PLAYITA
14	77	27	PUNTA PURRICHA	PUNTA PURRICHA
16	77	27	SIVIRU	SIVIRU
18	77	27	TORREIDO DE ARRIBA	TORREIDO DE ARRIBA
19	77	27	VIRUDO	VIRUDO
21	77	27	CURUNDO	CURUNDO
23	77	27	QUERA	QUERA
24	77	27	VILLA MARIA	VILLA MARIA
26	77	27	GUINEAL	GUINEAL
1	99	27	ALFONSO LOPEZ	ALFONSO LOPEZ
8	899	25	SAN JORGE PALO ALTO	SAN JORGE PALO ALTO
1	1	27	ALTAGRACIA	ALTAGRACIA
2	1	27	BEBARA	BEBARA
4	1	27	BELEN	BELEN
5	1	27	BELLALUZ	BELLALUZ
8	1	27	BOCA DE TAMANDO	BOCA DE TAMANDO
9	1	27	BUEY	BUEY
7	400	76	SAN PEDRO	SAN PEDRO
3	403	76	HOLGUIN	HOLGUIN
5	403	76	RIVERALTA	RIVERALTA
6	403	76	SAN JOSE	SAN JOSE
8	403	76	SIERRA MOCHA	SIERRA MOCHA
1	497	76	CRUCES	CRUCES
2	497	76	EL CHUZO	EL CHUZO
4	497	76	LA ESMERALDA	LA ESMERALDA
25	1	27	SAN ISIDRO	SAN ISIDRO
26	1	27	SAN JOSE DE PURRE	SAN JOSE DE PURRE
27	1	27	SAN MARTIN DE PURRE	SAN MARTIN DE PURRE
28	1	27	SAN ROQUE	SAN ROQUE
29	1	27	TAGACHI	TAGACHI
30	1	27	TANANDO	TANANDO
31	1	27	TANGUI	TANGUI
32	1	27	TUTUNENDO	TUTUNENDO
33	1	27	VILLACONTO	VILLACONTO
34	1	27	YUTO	YUTO
35	1	27	GUADALUPE	GUADALUPE
36	1	27	JITRADO	JITRADO
37	1	27	MOJAUDO	MOJAUDO
38	1	27	SANCENA	SANCENA
39	1	27	EL ARENAL	EL ARENAL
40	1	27	EL TAMBO	EL TAMBO
15	787	27	CORCOVADO	CORCOVADO
16	787	27	MANUNGARA	MANUNGARA
17	787	27	QUIADO	QUIADO
18	787	27	SALERO	SALERO
19	787	27	VARIANTE CERTEGA	VARIANTE CERTEGA
1	800	27	BALBOA	BALBOA
2	800	27	GILGAL	GILGAL
3	800	27	SANTANDER MARIA	SANTANDER MARIA
4	800	27	TANELA	TANELA
5	800	27	TITUMATE	TITUMATE
6	800	27	MANTUNTUGO	MANTUNTUGO
1	1	41	CAGUAN	CAGUAN
2	1	41	CHAPINERO	CHAPINERO
3	1	41	FORTALECILLAS	FORTALECILLAS
4	1	41	GUACIRCO	GUACIRCO
5	1	41	MOTILON	MOTILON
6	1	41	ORGANOS	ORGANOS
7	1	41	PALACIO	PALACIO
8	1	41	PENABLANCA	PE?ABLANCA
9	1	41	SAN ANTONIO	SAN ANTONIO
52	361	27	SAN PABLO ADENTRO	SAN PABLO ADENTRO
53	361	27	SURUCO	SURUCO
59	361	27	TRAPICHE	TRAPICHE
1	372	27	AGUACATE	AGUACATE
2	372	27	COREDO	COREDO
3	372	27	CURICHE	CURICHE
4	372	27	PUNTA ARDITA	PUNTA ARDITA
5	372	27	PUNTA DE CRUCES	PUNTA DE CRUCES
1	413	27	CHAGRATADA	CHAGRATADA
2	413	27	GUAITADO	GUAITADO
3	413	27	LA VUELTA	LA VUELTA
4	413	27	LAS HAMACAS	LAS HAMACAS
5	413	27	MUMBARADO	MUMBARADO
6	413	27	TUMUTUMBUDO	TUMUTUMBUDO
7	413	27	BORANDO	BORANDO
1	491	27	EL CAJON	EL CAJON
2	491	27	EL TIGRE	EL TIGRE
3	491	27	IRABUBU	IRABUBU
4	250	27	CORRIENTE PALO	CORRIENTE PALO
7	250	27	CHARAMBIRA	CHARAMBIRA
9	250	27	DESCOLGADERO	DESCOLGADERO
16	6	27	PENALOSA	PE?ALOSA
2	25	27	AMPARRAIDA	AMPARRAIDA
4	25	27	CHACHAJO	CHACHAJO
7	25	27	SAN FRANCISCO DE CUGUCH	SAN FRANCISCO DE CUGUCH
11	25	27	BATATAL	BATATAL
5	279	44	EL HATICO	EL HATICO
7	279	44	CARDONAL	CARDONAL
10	279	44	DOS CAMINOS	DOS CAMINOS
13	279	44	LOS ALTOS	LOS ALTOS
1	430	44	ALBANIA	ALBANIA
3	430	44	CUESTECITAS	CUESTECITAS
6	430	44	MAJUYURA	MAJUYURA
8	430	44	LOS REMEDIOS	LOS REMEDIOS
12	430	44	EL LIMONCITO	EL LIMONCITO
2	560	44	MUSICHY	MUSICHY
4	560	44	SAN ANTONIO	SAN ANTONIO
6	560	44	SHIRURE	SHIRURE
1	650	44	CANAVERALES	CANAVERALES
3	650	44	CORRAL DE PIEDRA	CORRAL DE PIEDRA
5	650	44	EL TABLAZO	EL TABLAZO
8	650	44	LA JUNTA	LA JUNTA
14	450	19	EL BADO	EL BADO
16	450	19	EL CARBONERO	EL CARBONERO
19	450	19	LOS LLANOS	LOS LLANOS
21	450	19	EL ROSARIO	EL ROSARIO
3	455	19	LA MUNDA	LA MUNDA
4	455	19	MONTERREDONDO	MONTERREDONDO
8	455	19	TIERRADURA	TIERRADURA
1	473	19	AGUASUCIA	AGUASUCIA
3	473	19	CHIMBORAZO	CHIMBORAZO
6	473	19	LOS QUINGOS	LOS QUINGOS
8	473	19	PAN DE AZUCAR	PAN DE AZUCAR
11	473	19	SAN ROQUE	SAN ROQUE
13	473	19	TIERRADENTRO	TIERRADENTRO
16	473	19	EL MESON	EL MESON
2	513	19	EL TETILLO	EL TETILLO
5	513	19	EL DESCANSO	EL DESCANSO
7	513	19	LOS ROBLES	LOS ROBLES
1	517	19	ARAUJO	ARAUJO
3	517	19	COHETANDO	COHETANDO
1	397	19	ALTAMIRA	ALTAMIRA
3	397	19	EL DIVISO	EL DIVISO
5	397	19	GUACHICONO	GUACHICONO
8	397	19	PLACER	PLACER
10	397	19	SANTA BARBARA	SANTA BARBARA
13	397	19	CHAUPILOM	CHAUPILOM
15	397	19	LA CARRERA	LA CARRERA
17	397	19	VILLA MARIA	VILLA MARIA
3	418	19	EL PLAYON	EL PLAYON
5	418	19	GUAYABAL	GUAYABAL
7	418	19	LA CONCEPCION	LA CONCEPCION
10	418	19	PLAYA GRANDE	PLAYA GRANDE
12	418	19	SAN ANT CHUARE	SAN ANT CHUARE
15	418	19	SAN ISIDRO	SAN ISIDRO
17	418	19	SANTA ANA	SANTA ANA
19	418	19	ZARAGOZA	ZARAGOZA
21	418	19	BAJO SIGUI	BAJO SIGUI
23	418	19	SAN FRANCISCO ADENTRO	SAN FRANCISCO ADENTRO
28	418	19	ALTO NAYA	ALTO NAYA
30	418	19	LAS CRUCES	LAS CRUCES
32	418	19	SAN ANTONIO DE GURUMEND	SAN ANTONIO DE GURUMEND
1	450	19	ALTO DE MAYO	ALTO DE MAYO
4	450	19	ESMERALDAS	ESMERALDAS
48	256	19	LAS HUERTAS	LAS HUERTAS
51	256	19	MURGUEITIO	MURGUEITIO
53	256	19	JUANA CASTANA	JUANA CASTANA
2	318	19	BENJAMIN HERRERA	BENJAMIN HERRERA
5	318	19	EL CARMELO	EL CARMELO
7	318	19	LA SOLEDAD	LA SOLEDAD
10	318	19	OLAYA HERRERA	OLAYA HERRERA
13	318	19	SAN ANTONIO	SAN ANTONIO
15	318	19	URIBE URIBE	URIBE URIBE
18	318	19	LLANTIN	LLANTIN
20	318	19	CASCAJERO	CASCAJERO
22	318	19	CHANZARA	CHANZARA
1	355	19	CALDERAS	CALDERAS
3	355	19	PUERTO VALENCIA	PUERTO VALENCIA
6	355	19	SANTA ROSA	SANTA ROSA
9	355	19	TURMINA	TURMINA
11	355	19	GUANACAS	GUANACAS
12	355	19	CARMEN DE VIBORAL	CARMEN DE VIBORAL
2	364	19	LA MINA	LA MINA
3	364	19	LOMA REDONDA	LOMA REDONDA
2	392	19	SAN PEDRO	SAN PEDRO
21	142	19	MINGO	MINGO
23	142	19	LA SOFIA	LA SOFIA
26	142	19	PEDREGAL	PEDREGAL
28	142	19	CABANA	CABA?A
1	212	19	EL JAGUAL	EL JAGUAL
3	212	19	LOS ANDES	LOS ANDES
8	212	19	SAN RAFAEL	SAN RAFAEL
2	256	19	BARAYA	BARAYA
4	256	19	CUATRO ESQUINAS	CUATRO ESQUINAS
9	256	19	EL ZARZAL	EL ZARZAL
11	256	19	GRANADA	GRANADA
14	256	19	LA PAZ	LA PAZ
16	256	19	LOS ANDES	LOS ANDES
18	256	19	MOSQUERA	MOSQUERA
20	256	19	PIAGUA	PIAGUA
22	256	19	QUILCACE	QUILCACE
24	256	19	SABANETAS	SABANETAS
6	161	47	PUERTO NINO	PUERTO NINO
11	78	44	POZO HONDO	POZO HONDO
12	78	44	TABACO	TABACO
2	279	44	CONEJO	CONEJO
3	279	44	CHORRERAS	CHORRERAS
6	279	44	SITIO NUEVO	SITIO NUEVO
8	279	44	LA BANGANITA	LA BANGANITA
11	279	44	EL CONFUSO	EL CONFUSO
12	279	44	LA CEIBA	LA CEIBA
14	279	44	QUEBRACHAL	QUEBRACHAL
2	430	44	CARRAIPIA	CARRAIPIA
4	430	44	IPAPURE	IPAPURE
5	430	44	LA PAZ	LA PAZ
7	430	44	PARAGUACHON	PARAGUACHON
10	430	44	MARANAMANA	MARANAMANA
11	430	44	LA ARENA	LA ARENA
13	430	44	YOTOJOROY	YOTOJOROY
1	560	44	AREMASAIN	AREMASAIN
3	560	44	EL PAJARO	EL PAJARO
5	560	44	SANTANDER ROSA	SANTANDER ROSA
7	560	44	MAYAPO	MAYAPO
8	560	44	MANZANA	MANZANA
2	650	44	CARACOLI	CARACOLI
4	650	44	HATICO DE LOS INDIOS	HATICO DE LOS INDIOS
6	650	44	EL TOTUMO	EL TOTUMO
7	650	44	GUAYACANAL	GUAYACANAL
9	650	44	LA PENA	LA PE?A
10	650	44	LA SIERRITA	LA SIERRITA
11	650	44	LOS HATICOS	LOS HATICOS
12	650	44	LOS PONDORES	LOS PONDORES
13	650	44	ZAMBRANO	ZAMBRANO
14	650	44	CORRALEJA	CORRALEJA
15	650	44	LA PENA DE LOS INDIOS	LA PE?A DE LOS INDIOS
16	650	44	PONDORITO	PONDORITO
17	650	44	VILLA DEL RIO	VILLA DEL RIO
18	650	44	LAGUNITA	LAGUNITA
19	650	44	LOS POZOS	LOS POZOS
20	650	44	POTRERITO	POTRERITO
2	847	44	BAHIA HONDA	BAHIA HONDA
3	847	44	CABO DE LA VELA	CABO DE LA VELA
5	517	19	EL COLORADO	EL COLORADO
6	517	19	HUILA	HUILA
7	517	19	ITAIBE	ITAIBE
8	517	19	LA ESTRELLA	LA ESTRELLA
9	517	19	LAME	LAME
10	517	19	LA PALMA	LA PALMA
11	517	19	MOSOCO	MOSOCO
12	517	19	RICAURTE	RICAURTE
13	517	19	RIOCHIQUITO	RIOCHIQUITO
14	517	19	SAN LUIS	SAN LUIS
15	517	19	TALAGA	TALAGA
16	517	19	TOEZ	TOEZ
17	517	19	TOGOIMA	TOGOIMA
18	517	19	VILLA RODRIGUEZ	VILLA RODRIGUEZ
19	517	19	VITONCO	VITONCO
22	517	19	LA TROJA	LA TROJA
1	532	19	BRISAS	BRISAS
2	532	19	CHONTADURO	CHONTADURO
3	532	19	DON ALONSO	DON ALONSO
4	532	19	GALINDEZ	GALINDEZ
5	532	19	LA FONDA	LA FONDA
6	532	19	LA MESA	LA MESA
7	532	19	LAS TALLAS	LAS TALLAS
8	532	19	PATIA	PATIA
9	532	19	PIEDRASENTADA	PIEDRASENTADA
10	532	19	PAN DE AZUCAR	PAN DE AZUCAR
11	532	19	CHONDURAL	CHONDURAL
12	532	19	SAJANDI	SAJANDI
13	532	19	EL ESTRECHO	EL ESTRECHO
14	532	19	EL HOYO	EL HOYO
16	532	19	ANGULO	ANGULO
17	532	19	BELLO HORIZONTE	BELLO HORIZONTE
18	532	19	EL PLACER	EL PLACER
19	532	19	EL PURO	EL PURO
20	532	19	EL ZARZAL	EL ZARZAL
21	532	19	LA FLORIDA	LA FLORIDA
22	532	19	SACHAMATES	SACHAMATES
23	532	19	SANTA ROSA BAJA	SANTA ROSA BAJA
24	532	19	VERSALLES BOQUI	VERSALLES BOQUI
1	548	19	TUNIA	TUNIA
2	548	19	CANO DULCE	CANO DULCE
3	548	19	SANTA HELENA	SANTA HELENA
4	548	19	FARALLONES	FARALLONES
5	548	19	CORRALES	CORRALES
6	548	19	EL MANGO	EL MANGO
7	548	19	EL CARMEN	EL CARMEN
8	548	19	MELCHOR	MELCHOR
9	548	19	LA LORENA-MATA	LA LORENA-MATA
10	548	19	SAN JOSE	SAN JOSE
11	548	19	LA MARIA	LA MARIA
12	548	19	LOMA CORTA	LOMA CORTA
13	548	19	CAMILO TORRES	CAMILO TORRES
14	548	19	EL AGRADO	EL AGRADO
15	548	19	EL ARRAYAN	EL ARRAYAN
2	531	15	IBACAPI	IBACAPI
1	533	15	MORCOTE	MORCOTE
1	542	15	EL PALMAR	EL PALMAR
2	572	15	CENTRO CALDERON	CENTRO CALDERON
4	572	15	PUEBLO NUEVO	PUEBLO NUEVO
6	572	15	PUERTO PALAGUA	PUERTO PALAGUA
9	572	15	DOS Y MEDIO	DOS Y MEDIO
3	317	15	GUIRAGON	GUIRAGON
3	322	15	GAUNZA ARRIBA	GAUNZA ARRIBA
5	322	15	CHINQUICO	CHINQUICO
9	322	15	PIEDRA PARADA	PIEDRA PARADA
1	332	15	BOCOTA	BOCOTA
5	332	15	EL BANCO	EL BANCO
8	332	15	TUNEBIA ARRIBA	TUNEBIA ARRIBA
3	368	15	COCUBAL	COCUBAL
1	380	15	EL ZINC	EL ZINC
1	401	15	CHAPON O GUADUA	CHAPON O GUADUA
2	403	15	EL CARMEN	EL CARMEN
1	425	15	SAN CARLOS	SAN CARLOS
3	425	15	NARANJOS	NARANJOS
3	442	15	NARAPAY	NARAPAY
5	442	15	GUAYABAL	GUAYABAL
2	455	15	TUNJITA	TUNJITA
2	464	15	CENTRO TUNJUELA	CENTRO TUNJUELA
3	218	15	PUERTO RICO	PUERTO RICO
6	218	15	EL NARANJO	EL NARANJO
8	218	15	SATOBA ARRIBA	SATOBA ARRIBA
4	223	15	AGUA BLANCA	AGUA BLANCA
7	223	15	COVARIA	COVARIA
1	226	15	LLANO DE ALARCON	LLANO DE ALARCON
1	238	15	SURBA Y BONZA	SURBA Y BONZA
4	238	15	AGUA TENDIDA	AGUA TENDIDA
5	238	15	QUEBRADA DE BECERRAS	QUEBRADA DE BECERRAS
8	238	15	SAN LORENZO ABAAJO	SAN LORENZO ABAAJO
1	244	15	EL PACHACUAL	EL PACHACUAL
2	248	15	LA LAGUNA	LA LAGUNA
1	272	15	BARATOA	BARATOA
1	276	15	TOBASIA	TOBASIA
1	299	15	CALDERA ABAJO	CALDERA ABAJO
3	299	15	BANCOS DE PARA	BANCOS DE PARA
8	87	15	TIRINQUITA	TIRINQUITA
2	97	15	SAN FRANCISCO	SAN FRANCISCO
2	109	15	CAMPO HERMOSO	CAMPO HERMOSO
2	131	15	QUIPE CHUNGAGUTA	QUIPE CHUNGAGUTA
2	162	15	COBUGOTE	COBUGOTE
4	162	15	SAN VICTORINO	SAN VICTORINO
1	176	15	SASA-MOYAVITA	SASA-MOYAVITA
3	180	15	GIBRALTAR	GIBRALTAR
5	180	15	PUEBLO LAS MERCEDES	PUEBLO LAS MERCEDES
10	180	15	LLANO DE TABACO	LLANO DE TABACO
3	183	15	MONSERRATE	MONSERRATE
5	183	15	CHIPA CENTRO	CHIPA CENTRO
1	185	15	GUAMO Y LADERA	GUAMO Y LADERA
1	204	15	EL BARNE	EL BARNE
1	212	15	CANTINO	CANTINO
3	212	15	PEDRO GOMEZ	PEDRO GOMEZ
6	744	13	VERACRUZ	VERACRUZ
10	744	13	LAS BRISAS	LAS BRISAS
12	744	13	SANTA ROSA	SANTA ROSA
24	1	20	LOS CALABAZOS	LOS CALABAZOS
26	1	20	LOS HATICOS	LOS HATICOS
27	1	20	LA  MESA	LA  MESA
29	1	20	POTRERITO	POTRERITO
31	1	20	RIO SECO	RIO SECO
11	701	19	PRIMAVERAS	PRIMAVERAS
13	701	19	VILLA MOSQUERA	VILLA MOSQUERA
2	743	19	PITAYO	PITAYO
4	743	19	PUEBLITO	PUEBLITO
5	743	19	USENDA	USENDA
7	743	19	LA ESTRELLA	LA ESTRELLA
9	743	19	EL CACIQUE	EL CACIQUE
11	743	19	MENDEZ	MENDEZ
12	743	19	MIRAFLORES	MIRAFLORES
14	743	19	TUMBURAO	TUMBURAO
15	743	19	ALTO GRANDE	ALTO GRANDE
16	743	19	LA AGUADA	LA AGUADA
18	743	19	LOMA DEL CARMEN	LOMA DEL CARMEN
1	760	19	CHAPA	CHAPA
2	760	19	CHIRIBIO	CHIRIBIO
4	760	19	HATO FRIO	HATO FRIO
5	760	19	LA PAZ	LA PAZ
7	760	19	RIO BLANCO	RIO BLANCO
9	760	19	SACHACOCO	SACHACOCO
10	760	19	EL CARMEN	EL CARMEN
2	780	19	LA MESETA	LA MESETA
5	780	19	MATECANA	MATECANA
6	780	19	BELLAVISTA	BELLAVISTA
7	780	19	LA ROMA	LA ROMA
1	807	19	CAMPOSANO	CAMPOSANO
3	807	19	CUEVITAS	CUEVITAS
4	807	19	EL HATO	EL HATO
6	807	19	LA CHORRERA	LA CHORRERA
8	807	19	URUBAMBA	URUBAMBA
9	807	19	ALTO SAN JOSE	ALTO SAN JOSE
1	809	19	BUBUEY	BUBUEY
3	809	19	COTEJE	COTEJE
4	809	19	EL CUERVAL	EL CUERVAL
18	548	19	SAN MIGUEL	SAN MIGUEL
19	548	19	SAN PEDRO	SAN PEDRO
2	573	19	LAS BRISAS	LAS BRISAS
3	573	19	SAN CARLOS	SAN CARLOS
5	573	19	PERICO NEGRO	PERICO NEGRO
8	573	19	LOS BANCOS	LOS BANCOS
1	585	19	CANDELARIA	CANDELARIA
3	585	19	MOSCOPAN	MOSCOPAN
4	585	19	PURACE	PURACE
5	585	19	TIJERAS	TIJERAS
6	585	19	SAN RAFAEL	SAN RAFAEL
1	622	19	GUALOTO	GUALOTO
2	622	19	PARRAGA	PARRAGA
3	622	19	MARQUES	MARQUES
4	622	19	UFUGU	UFUGU
5	622	19	LOMA BAJO	LOMA BAJO
1	693	19	EL ROSAL	EL ROSAL
2	693	19	MARMATO	MARMATO
3	693	19	PARAMILLOS	PARAMILLOS
4	693	19	SANTIAGO	SANTIAGO
5	693	19	VALENCIA	VALENCIA
6	693	19	VENECIA	VENECIA
1	698	19	EL PALMAR	EL PALMAR
2	698	19	EL TURCO	EL TURCO
3	698	19	JUAN IGNACIO	JUAN IGNACIO
4	698	19	LA ARROBLEDA	LA ARROBLEDA
5	698	19	LOMITAS	LOMITAS
6	698	19	MAZAMORRERO	MAZAMORRERO
7	698	19	MONDOMO	MONDOMO
8	698	19	PARAMILLO	PARAMILLO
9	698	19	SAN RAFAEL	SAN RAFAEL
10	698	19	TRES QUEBRADAS	TRES QUEBRADAS
12	698	19	GUINAMACO	GUINAMACO
13	698	19	SAN ANTONIO	SAN ANTONIO
14	698	19	SAN PEDRO	SAN PEDRO
15	698	19	AGUA AZUL	AGUA AZUL
16	698	19	CHALO	CHALO
17	698	19	DOMINGUILLO	DOMINGUILLO
18	698	19	EL CRUCERO	EL CRUCERO
19	698	19	SAN ISIDRO	SAN ISIDRO
20	698	19	QUINAMAYO	QUINAMAYO
1	701	19	DESCANSE	DESCANSE
2	701	19	EL CARMELO	EL CARMELO
3	701	19	NAPOLES	NAPOLES
4	701	19	SANTA CLARA	SANTA CLARA
5	701	19	SANTA MARTA	SANTA MARTA
6	701	19	VILLALOBOS	VILLALOBOS
7	701	19	EL CEDRO	EL CEDRO
8	701	19	CAMPOALEGRE	CAMPOALEGRE
9	701	19	EL TAMBOR	EL TAMBOR
10	701	19	LOS AZULES	LOS AZULES
20	79	52	TERAIMBE	TERAIMBE
21	79	52	YACULA	YACULA
8	870	73	EL RESGUARDO	EL RESGUARDO
9	870	73	LA COLORADA	LA COLORADA
1	873	73	LA MERCADILLA	LA MERCADILLA
2	873	73	LA COLONIA	LA COLONIA
3	873	73	LOS ALPES	LOS ALPES
4	873	73	PUERTO LLERAS	PUERTO LLERAS
1	1	76	EL SALADITO	EL SALADITO
2	1	76	FELIDIA	FELIDIA
3	1	76	GOLONDRINAS	GOLONDRINAS
4	1	76	HORMIGUERO	HORMIGUERO
3	780	13	CAMPO SERENO	CAMPO SERENO
9	780	13	EL PORVENIR	EL PORVENIR
15	780	13	LAS MARIAS	LAS MARIAS
19	780	13	PUNTA DE CARTAGENA	PUNTA DE CARTAGENA
23	780	13	TALAIGUA VIEJO	TALAIGUA VIEJO
1	838	13	BALLESTAS	BALLESTAS
1	873	13	CIPACOA	CIPACOA
1	894	13	JESUS DEL RIO	JESUS DEL RIO
1	47	15	HIRVA	HIRVA
3	47	15	MARAVILLA	MARAVILLA
5	47	15	SISVACA	SISVACA
8	47	15	LA ESPERANZA	LA ESPERANZA
11	47	15	HATO LAGUNA	HATO LAGUNA
1	87	15	SAN JOSE DE LA MONTANA	SAN JOSE DE LA MONTA?A
1	549	13	ARMENIA	ARMENIA
4	549	13	LA RUFINA	LA RUFINA
6	549	13	LAS CONCHITAS	LAS CONCHITAS
8	549	13	LOS CERRITOS	LOS CERRITOS
11	549	13	PALOMINO	PALOMINO
13	549	13	PUERTO RICO	PUERTO RICO
17	549	13	LA VENTURA	LA VENTURA
19	549	13	QUEBRADA DEL MEDIO	QUEBRADA DEL MEDIO
4	600	13	SAN CAYETANO	SAN CAYETANO
2	647	13	LAS PIEDRAS	LAS PIEDRAS
2	650	13	MENCHIQUEJO	MENCHIQUEJO
4	650	13	PUNTA DE HORNOS	PUNTA DE HORNOS
8	650	13	PORVENIR	PORVENIR
9	79	5	TABLAZO POPALITO	TABLAZO POPALITO
11	79	5	LAS VICTORIAS	LAS VICTORIAS
1	86	5	LABORES	LABORES
3	86	5	RIO ARRIBA	RIO ARRIBA
1	88	5	BARRIO PARIS	BARRIO PARIS
3	88	5	ZAMORA ACEVEDO	ZAMORA ACEVEDO
6	88	5	GUASIMALITO	GUASIMALITO
10	88	5	SANTA RITA	SANTA RITA
10	696	52	SAN JOSE	SAN JOSE
11	696	52	SAN SEBAST.D.BELARCAZAR	SAN SEBAST.D.BELARCAZAR
1	699	52	BALALAIKA	BALALAIKA
2	699	52	EL EDEN	EL EDEN
3	699	52	EL SANDE	EL SANDE
4	699	52	MANCHAG	MANCHAG
5	699	52	PIARAMAG	PIARAMAG
6	699	52	SANTA ROSA	SANTA ROSA
7	699	52	CHIPACUERDO	CHIPACUERDO
8	699	52	INGA	INGA
1	585	52	CASAFRIA	CASAFRIA
2	585	52	CHIRES	CHIRES
3	585	52	EL ESPINO	EL ESPINO
4	585	52	JOSE MARIA HERNAN	JOSE MARIA HERNAN
5	585	52	MIRAFLORES	MIRAFLORES
6	585	52	PISCUM	PISCUM
1	612	52	NULPE ALTO	NULPE ALTO
2	612	52	NULPE MEDIO	NULPE MEDIO
3	612	52	OSPINA PEREZ	OSPINA PEREZ
4	612	52	SAN ISIDRO	SAN ISIDRO
5	612	52	VEGAS	VEGAS
6	612	52	RAMOS	RAMOS
7	612	52	PIALAPI	PIALAPI
1	621	52	ARTEAGA-LIMONAR	ARTEAGA-LIMONAR
2	621	52	CACAO	CACAO
3	621	52	EL GUAYABAL	EL GUAYABAL
4	621	52	FATIMA EL CARME	FATIMA EL CARME
5	621	52	GOMEZ JURADO	GOMEZ JURADO
6	621	52	GUALPI	GUALPI
7	621	52	INDU	INDU
8	621	52	JALARAL	JALARAL
9	621	52	LAS LAJAS PUMBI	LAS LAJAS PUMBI
10	621	52	MIALO	MIALO
11	621	52	MUNAMBI	MU?AMBI
12	621	52	NEGRITO	NEGRITO
13	621	52	PALOSECO	PALOSECO
14	621	52	PENON G MARTINEZ	PE?ON G MARTINEZ
15	621	52	PIRI (PARAISO)	PIRI (PARAISO)
16	621	52	SAN ANTONIO	SAN ANTONIO
17	621	52	SANTA ELENA	SANTA ELENA
18	621	52	TASDAN	TASDAN
19	621	52	TRINIDAD LA MERCED	TRINIDAD LA MERCED
20	621	52	CARLOS LLERAS RESTREPO	CARLOS LLERAS RESTREPO
21	621	52	CHAFALOTE	CHAFALOTE
22	621	52	ANTONIO NARINO	ANTONIO NARI?O
23	621	52	JORGE E GAITAN	JORGE E GAITAN
24	621	52	LIMONES DEL PATIA	LIMONES DEL PATIA
25	621	52	INGUANBI	INGUANBI
26	621	52	CONQUISTA	CONQUISTA
27	621	52	VUELTA DE PAPI	VUELTA DE PAPI
1	678	52	ANDALUCIA	ANDALUCIA
2	678	52	BOLIVAR	BOLIVAR
3	678	52	CARRIZAL	CARRIZAL
4	678	52	DECIO	DECIO
6	678	52	MARANGUAY	MARANGUAY
8	678	52	LA AGUADA	LA AGUADA
10	678	52	YUNGUILLA	YUNGUILLA
11	678	52	SACAMPUES	SACAMPUES
13	678	52	TURUPAMBA	TURUPAMBA
14	678	52	EL SALADO	EL SALADO
3	473	52	NARINO GICRILLA	NARI?O GICRILLA
4	473	52	COCAL	COCAL
1	490	52	A. LOPEZ P. (FLORIDA)	A. LOPEZ P. (FLORIDA)
2	490	52	BELLAVISTA	BELLAVISTA
4	490	52	JORGE ELICER GAITAN	JORGE ELICER GAITAN
6	490	52	LOZANO TORRIJOS	LOZANO TORRIJOS
8	490	52	SAN JOSE CALABAZAL	SAN JOSE CALABAZAL
8	101	68	GUACAMAYO	GUACAMAYO
10	101	68	LA MELONA	LA MELONA
11	101	68	GALLEGOS	GALLEGOS
13	101	68	SAN ROQUE	SAN ROQUE
15	101	68	SOCORRITO	SOCORRITO
1	121	68	BOCORE	BOCORE
3	121	68	LA LLANADA	LA LLANADA
2	132	68	LA BAJA	LA BAJA
2	147	68	LA PLAYA	LA PLAYA
3	147	68	OVEJERAS	OVEJERAS
5	147	68	PLATANAL	PLATANAL
6	147	68	SEBARUTA	SEBARUTA
1	152	68	EL TOBAL	EL TOBAL
3	152	68	EL ROSAL	EL ROSAL
4	152	68	BITARIGUA	BITARIGUA
6	152	68	LOS CINCHOS	LOS CINCHOS
8	152	68	AGUATENDIDA	AGUATENDIDA
9	152	68	SAUCARA ALLA	SAUCARA ALLA
10	152	68	EL ASTILLA	EL ASTILLA
1	160	68	EL LAUREL	EL LAUREL
2	160	68	SAN MIGUEL	SAN MIGUEL
3	160	68	EL EMBUDO	EL EMBUDO
4	160	68	RODALITO	RODALITO
5	160	68	SAN FRANCISCO	SAN FRANCISCO
1	162	68	EL ATICO	EL ATICO
2	162	68	BARSALI	BARSALI
5	682	66	EL GUAMAL	EL GUAMAL
6	682	66	GUACAS	GUACAS
7	682	66	SAN RAMON	SAN RAMON
8	682	66	LA CAPILLA	LA CAPILLA
9	682	66	LA ESTRELLA	LA ESTRELLA
10	682	66	LAS MANGAS	LAS MANGAS
12	682	66	SANTA BARBARA	SANTA BARBARA
13	682	66	SANTA RITA	SANTA RITA
14	682	66	TARAPACA	TARAPACA
15	682	66	FERMIN LOPEZ	FERMIN LOPEZ
16	682	66	GUAIMARAL	GUAIMARAL
17	682	66	EL LEMBO	EL LEMBO
1	687	66	BRETA A	BRETA A
2	687	66	LA MARIA	LA MARIA
3	687	66	PERALONSO	PERALONSO
4	687	66	TOTUI	TOTUI
5	687	66	PENAS BLANCAS	PE?AS BLANCAS
6	687	66	BARCINAL	BARCINAL
7	687	66	BUENOS AIRES	BUENOS AIRES
8	687	66	EL TAMBO	EL TAMBO
9	687	66	LA GUAIRA	LA GUAIRA
10	687	66	PUEBLO VANO	PUEBLO VANO
1	1	68	BARRIO SANTANDER	BARRIO SANTANDER
2	1	68	ESTACION MADRID	ESTACION MADRID
3	1	68	LA PEDREGOSA	LA PEDREGOSA
4	1	68	MONSERRATE	MONSERRATE
5	1	68	CIUDAD MUTIS	CIUDAD MUTIS
6	1	68	BARRIO  KENNEDY	BARRIO  KENNEDY
9	1	68	BARRIO REGADERO	BARRIO REGADERO
10	1	68	BARRIO GIRARDOT	BARRIO GIRARDOT
11	1	68	BARRIO LAS AMERICAS	BARRIO LAS AMERICAS
12	1	68	CAMPO HERMOSO	CAMPO HERMOSO
1	20	68	CARRETERO	CARRETERO
2	20	68	EL HATILLO	EL HATILLO
3	20	68	LA MESA	LA MESA
4	20	68	SABANETA	SABANETA
5	20	68	GUACOS	GUACOS
6	20	68	UTAPA NORTE	UTAPA NORTE
7	20	68	UTAPA SUR	UTAPA SUR
8	20	68	GUAYABAL	GUAYABAL
1	51	68	CHIFLAS	CHIFLAS
2	51	68	CAMPAMENTO	CAMPAMENTO
3	51	68	EL CABLE	EL CABLE
4	51	68	CRISTALES	CRISTALES
5	51	68	AMARILLO	AMARILLO
6	51	68	BUENAVISTA 1	BUENAVISTA 1
7	51	68	BUENAVISTA 11	BUENAVISTA 11
8	51	68	MARSELLA	MARSELLA
9	51	68	TEJAR	TEJAR
10	51	68	POZO NEGRO 1	POZO NEGRO 1
11	51	68	POZO NEGRO 11	POZO NEGRO 11
1	77	68	CITE	CITE
6	383	66	CAIMAL	CAIMAL
7	383	66	SAN CARLOS	SAN CARLOS
8	383	66	SAN EUGENIO	SAN EUGENIO
9	383	66	LA CASCADA	LA CASCADA
10	383	66	EL BRILLANTE	EL BRILLANTE
11	383	66	EL TIGRE	EL TIGRE
12	383	66	LA SECRETA	LA SECRETA
13	383	66	LA PRIMAVERA	LA PRIMAVERA
14	383	66	LA MONTOYA	LA MONTOYA
15	383	66	LA PLAYA	LA PLAYA
1	400	66	LA PALMA	LA PALMA
3	400	66	EL AGUACATE	EL AGUACATE
1	440	66	ALTO CAUCA	ALTO CAUCA
2	440	66	BELTRAN	BELTRAN
4	440	66	LAS TAZAS	LAS TAZAS
5	440	66	MIRACAMPO	MIRACAMPO
8	440	66	EL RAYO	EL RAYO
10	440	66	LA NUBIA	LA NUBIA
1	456	66	EL JARDIN	EL JARDIN
3	456	66	SAN ANTONIO DE CHAMI	SAN ANTONIO DE CHAMI
5	456	66	PUEBLO RICO	PUEBLO RICO
4	319	73	RINCON SANTO	RINCON SANTO
6	319	73	QUINTO CHIPUELO	QUINTO CHIPUELO
7	319	73	TOVAR	TOVAR
8	319	73	GUAMAL	GUAMAL
10	319	73	LOMA DE LUISA	LOMA DE LUISA
12	319	73	EL JARDIN	EL JARDIN
2	347	73	LA PICOTA	LA PICOTA
4	347	73	MESONES	MESONES
5	347	73	PADUA	PADUA
1	352	73	BALCONCITOS	BALCONCITOS
3	352	73	NUEVO MUNDO	NUEVO MUNDO
5	352	73	PATICUINDE	PATICUINDE
2	408	73	LA SIERRA	LA SIERRA
4	408	73	EL CARMELO	EL CARMELO
2	411	73	EL CONVENIO	EL CONVENIO
3	411	73	LA CRUZ	LA CRUZ
7	411	73	SANTA TERESA	SANTA TERESA
1	443	73	EL HATILLO	EL HATILLO
2	443	73	LA CABA A	LA CABA A
1	449	73	CUALAMANA	CUALAMANA
3	449	73	INHALY	INHALY
2	461	73	LA DANTA	LA DANTA
1	483	73	LA PALMITA	LA PALMITA
2	483	73	VELU	VELU
3	483	73	TAMIRCO	TAMIRCO
7	483	73	PALMA ALTA	PALMA ALTA
9	483	73	BALSILLAS	BALSILLAS
1	168	73	ALTAMIRA	ALTAMIRA
2	168	73	ARACA	ARACA
4	168	73	EL LIMON	EL LIMON
6	168	73	LA PROFUNDA	LA PROFUNDA
8	168	73	SANTO DOMINGO	SANTO DOMINGO
9	168	73	YAGUARA	YAGUARA
\.


--
-- TOC entry 2490 (class 0 OID 16424)
-- Dependencies: 1756
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY departamento (dpto_codi, dpto_nomb, id_cont, id_pais) FROM stdin;
3	LIMA	1	171
8	ATLANTICO	1	170
11	D.C.	1	170
13	BOLIVAR	1	170
15	BOYACA	1	170
17	CALDAS	1	170
5	ANTIOQUIA	1	170
18	CAQUETA	1	170
19	CAUCA	1	170
20	CESAR	1	170
23	CORDOBA	1	170
25	CUNDINAMARCA	1	170
27	CHOCO	1	170
41	HUILA	1	170
44	LA GUAJIRA	1	170
47	MAGDALENA	1	170
50	META	1	170
52	NARINO	1	170
54	NORTE DE SANTANDER	1	170
63	QUINDIO	1	170
66	RISARALDA	1	170
68	SANTANDER	1	170
70	SUCRE	1	170
73	TOLIMA	1	170
76	VALLE DEL CAUCA	1	170
81	ARAUCA	1	170
85	CASANARE	1	170
86	PUTUMAYO	1	170
88	SAN ANDRES	1	170
91	AMAZONAS	1	170
94	GUAINIA	1	170
95	GUAVIARE	1	170
97	VAUPES	1	170
99	VICHADA	1	170
1	TODOS	1	170
80	LA PAZ	1	173
2	SAO PAULO	1	172
6	TEXAS	1	200
7	DISTRITO FEDERAL	1	300
4	KENTUCKY	1	200
9	CALIFORNIA	1	200
98	RIO DE JANEIRO	1	172
\.


--
-- TOC entry 2491 (class 0 OID 16429)
-- Dependencies: 1757
-- Data for Name: dependencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY dependencia (depe_codi, depe_nomb, dpto_codi, depe_codi_padre, muni_codi, depe_codi_territorial, dep_sigla, dep_central, dep_direccion, depe_num_interna, depe_num_resolucion, depe_rad_tp1, depe_rad_tp2, depe_rad_tp3, id_cont, id_pais, depe_estado) FROM stdin;
905	Pruebas Infometrika	11	900	1	900	PRB	\N	infometrika limitada	\N	\N	900	900	900	1	170	1
900	Dependencia de Pruebas 	11	\N	1	900	\N	\N	\N	900	\N	900	900	900	1	170	1
\.


--
-- TOC entry 2492 (class 0 OID 16435)
-- Dependencies: 1758
-- Data for Name: dependencia_visibilidad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY dependencia_visibilidad (codigo_visibilidad, dependencia_visible, dependencia_observa) FROM stdin;
1	900	900
2	905	900
\.


--
-- TOC entry 2493 (class 0 OID 16438)
-- Dependencies: 1759
-- Data for Name: encuesta; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY encuesta (usua_doc, fecha, p1, p2, p3, p4, p5, p6, p7, p7_cual, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p20_cual, p21, p22, p23, p24, p25) FROM stdin;
\.


--
-- TOC entry 2494 (class 0 OID 16444)
-- Dependencies: 1760
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY estado (esta_codi, esta_desc) FROM stdin;
9	Documento de Orfeo
\.


--
-- TOC entry 2495 (class 0 OID 16447)
-- Dependencies: 1761
-- Data for Name: fun_funcionario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY fun_funcionario (usua_doc, usua_fech_crea, usua_esta, usua_nomb, usua_ext, usua_nacim, usua_email, usua_at, usua_piso, cedula_ok, cedula_suip, nombre_suip, observa) FROM stdin;
\.


--
-- TOC entry 2496 (class 0 OID 16451)
-- Dependencies: 1762
-- Data for Name: hist_eventos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY hist_eventos (depe_codi, hist_fech, usua_codi, radi_nume_radi, hist_obse, usua_codi_dest, usua_doc, usua_doc_old, sgd_ttr_codigo, hist_usua_autor, hist_doc_dest, depe_codi_dest) FROM stdin;
900	2008-08-13 11:24:30.752217	2	20089000000012	 	1	1234567878787	\N	2	\N	900102030	900
900	2008-08-19 18:24:42.303609	1	20089000000012	para tramite	1	900102030	\N	9	\N	900102030	900
900	2008-08-20 10:55:17.918575	1	20089000000022	 	1	900102030	\N	2	\N	900102030	900
900	2008-08-20 10:59:28.037419	1	20089000000011	 	1	900102030	\N	2	\N	900102030	900
900	2008-08-20 11:38:18.852197	1	20089000000013	 	1	900102030	\N	2	\N	900102030	900
900	2008-08-20 12:12:40.827627	1	20089000000021	 	1	900102030	\N	2	\N	900102030	900
\.


--
-- TOC entry 2497 (class 0 OID 16457)
-- Dependencies: 1763
-- Data for Name: informados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY informados (radi_nume_radi, usua_codi, depe_codi, info_desc, info_fech, info_leido, usua_codi_info, info_codi, usua_doc) FROM stdin;
\.


--
-- TOC entry 2498 (class 0 OID 16464)
-- Dependencies: 1764
-- Data for Name: medio_recepcion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY medio_recepcion (mrec_codi, mrec_desc) FROM stdin;
1	Correo
2	Fax
3	Internet
4	Mail
5	Personal
6	Telefonico
7	A.Personalizada
9	Chat
8	Call Center
\.


--
-- TOC entry 2499 (class 0 OID 16467)
-- Dependencies: 1765
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY municipio (muni_codi, dpto_codi, muni_nomb, id_cont, id_pais, homologa_muni, homologa_idmuni, activa) FROM stdin;
381	52	LA FLORIDA	1	170	\N	\N	1
258	52	EL TABLON	1	170	\N	\N	1
893	5	YONDO	1	170	\N	\N	1
1	8	BARRANQUILLA	1	170	\N	\N	1
873	5	VIGIA DEL FUERTE	1	170	\N	\N	1
809	5	TITIRIBI	1	170	\N	\N	1
667	5	SAN RAFAEL	1	170	\N	\N	1
647	5	SAN ANDRES	1	170	\N	\N	1
656	5	SAN JERONIMO	1	170	\N	\N	1
576	5	PUEBLORRICO	1	170	\N	\N	1
440	5	MARINILLA	1	170	\N	\N	1
475	5	MURINDO	1	170	\N	\N	1
483	5	NARINO	1	170	\N	\N	1
541	5	PENOL	1	170	\N	\N	1
250	27	EL LITORAL DEL SAN JUAN	1	170	\N	\N	1
25	27	ALTO BAUDO	1	170	\N	\N	1
75	27	BAHIA SOLANO	1	170	\N	\N	1
817	25	TOCANCIPA	1	170	\N	\N	1
862	25	VERGARA	1	170	\N	\N	1
873	25	VILLAPINZON	1	170	\N	\N	1
662	25	SAN JUAN DE RIO SECO	1	170	\N	\N	1
455	15	MIRAFLORES	1	170	\N	\N	1
469	15	MONIQUIRA	1	170	\N	\N	1
511	15	PACHAVITA	1	170	\N	\N	1
238	15	DUITAMA	1	170	\N	\N	1
248	15	EL ESPINO	1	170	\N	\N	1
276	15	FLORESTA	1	170	\N	\N	1
332	15	GUICAN	1	170	\N	\N	1
367	15	JENESANO	1	170	\N	\N	1
172	15	CHINAVITA	1	170	\N	\N	1
180	15	CHISCAS	1	170	\N	\N	1
189	15	CIENEGA	1	170	\N	\N	1
327	68	GUEPSA	1	170	\N	\N	1
271	68	FLORIAN	1	170	\N	\N	1
209	68	CONFINES	1	170	\N	\N	1
81	68	BARRANCABERMEJA	1	170	\N	\N	1
170	66	DOSQUEBRADAS	1	170	\N	\N	1
190	63	CIRCASIA	1	170	\N	\N	1
175	25	CHIA	1	170	\N	\N	1
224	25	CUCUNUBA	1	170	\N	\N	1
40	25	ANOLAIMA	1	170	\N	\N	1
148	25	CAPARRAPI	1	170	\N	\N	1
83	52	BELEN	1	170	\N	\N	1
370	50	LA URIBE	1	170	\N	\N	1
711	50	VISTA HERMOSA	1	170	\N	\N	1
300	80	LA PAZ	1	173	\N	\N	1
245	50	EL CALVARIO	1	170	\N	\N	1
287	50	FUENTE DE ORO	1	170	\N	\N	1
692	47	SAN SEBASTIAN BUENAVISTA	1	170	\N	\N	1
318	47	GUAMAL	1	170	\N	\N	1
551	47	PIVIJAY	1	170	\N	\N	1
53	47	ARACATACA	1	170	\N	\N	1
874	44	VILLANUEVA	1	170	\N	\N	1
585	19	PURACE	1	170	\N	\N	1
693	19	SAN SEBASTIAN	1	170	\N	\N	1
513	19	PADILLA	1	170	\N	\N	1
318	19	GUAPI	1	170	\N	\N	1
110	19	BUENOS AIRES	1	170	\N	\N	1
50	19	ARGELIA	1	170	\N	\N	1
1	19	POPAYAN	1	170	\N	\N	1
1	18	FLORENCIA	1	170	\N	\N	1
94	18	BELEN DE LOS ANDAQUIES	1	170	\N	\N	1
256	18	EL PAUJIL	1	170	\N	\N	1
460	18	MILAN	1	170	\N	\N	1
442	17	MARMATO	1	170	\N	\N	1
444	17	MARQUETALIA	1	170	\N	\N	1
524	17	PALESTINA	1	170	\N	\N	1
372	8	JUAN DE ACOSTA	1	170	\N	\N	1
520	8	PALMAR DE VARELA	1	170	\N	\N	1
560	8	PONEDERA	1	170	\N	\N	1
244	13	EL CARMEN DE BOLIVAR	1	170	\N	\N	1
109	76	BUENAVENTURA	1	170	\N	\N	1
54	76	ARGELIA	1	170	\N	\N	1
31	5	AMALFI	1	170	\N	\N	1
38	5	ANGOSTURA	1	170	\N	\N	1
59	5	ARMENIA	1	170	\N	\N	1
497	76	OBANDO	1	170	\N	\N	1
147	76	CARTAGO	1	170	\N	\N	1
204	70	COLOSO	1	170	\N	\N	1
283	73	FRESNO	1	170	\N	\N	1
551	41	PITALITO	1	170	\N	\N	1
797	41	TESALIA	1	170	\N	\N	1
418	54	LOURDES	1	170	\N	\N	1
660	54	SALAZAR	1	170	\N	\N	1
347	54	HERRAN	1	170	\N	\N	1
99	54	BOCHALEMA	1	170	\N	\N	1
854	5	VALDIVIA	1	170	\N	\N	1
665	5	SAN PEDRO DE URABA	1	170	\N	\N	1
652	5	SAN FRANCISCO	1	170	\N	\N	1
769	25	SUBACHOQUE	1	170	\N	\N	1
513	25	PACHO	1	170	\N	\N	1
761	15	SOMONDOCO	1	170	\N	\N	1
537	15	PAZ DE RIO	1	170	\N	\N	1
646	15	SAMACA	1	170	\N	\N	1
667	15	SAN LUIS DE GACENO	1	170	\N	\N	1
114	15	BUSBANZA	1	170	\N	\N	1
667	13	SAN MARTIN DE LOBA	1	170	\N	\N	1
745	68	SIMACOTA	1	170	\N	\N	1
468	68	MOLAGAVITA	1	170	\N	\N	1
1	68	BUCARAMANGA	1	170	\N	\N	1
88	66	BELEN DE UMBRIA	1	170	\N	\N	1
871	54	VILLA CARO	1	170	\N	\N	1
290	25	FUSAGASUGA	1	170	\N	\N	1
74	13	BARRANCO DE LOBA	1	170	\N	\N	1
672	23	SAN ANTERO	1	170	\N	\N	1
233	52	CUMBITARA	1	170	\N	\N	1
313	50	GRANADA	1	170	\N	\N	1
350	50	LA MACARENA	1	170	\N	\N	1
660	47	SABANAS DE SAN ANGEL	1	170	\N	\N	1
450	27	MEDIO SAN JUAN	1	170	\N	\N	1
580	27	RIO ORO	1	170	\N	\N	1
495	17	NORCASIA	1	170	\N	\N	1
568	86	PUERTO ASIS	1	170	\N	\N	1
219	86	COLON	1	170	\N	\N	1
571	86	PUERTO GUZMAN	1	170	\N	\N	1
749	86	SIBUNDOY	1	170	\N	\N	1
755	86	SAN FRANCISCO	1	170	\N	\N	1
865	86	VALLE GUAMUEZ	1	170	\N	\N	1
885	86	VILLAGARZON	1	170	\N	\N	1
1	88	SAN ANDRES	1	170	\N	\N	1
263	85	PORE	1	170	\N	\N	1
279	85	RECETOR	1	170	\N	\N	1
300	85	SABANALARGA	1	170	\N	\N	1
400	85	TAMARA	1	170	\N	\N	1
410	85	TAURAMENA	1	170	\N	\N	1
440	85	VILLANUEVA	1	170	\N	\N	1
1	86	MOCOA	1	170	\N	\N	1
225	85	NUNCHIA	1	170	\N	\N	1
250	85	PAZ DE ARIPORO	1	170	\N	\N	1
15	85	CHAMEZA	1	170	\N	\N	1
136	85	LA SALINA	1	170	\N	\N	1
139	85	MANI	1	170	\N	\N	1
220	81	CRAVO NORTE	1	170	\N	\N	1
591	81	PUERTO RONDON	1	170	\N	\N	1
736	81	SARAVENA	1	170	\N	\N	1
869	76	VIJES	1	170	\N	\N	1
890	76	YOTOCO	1	170	\N	\N	1
895	76	ZARZAL	1	170	\N	\N	1
834	76	TULUA	1	170	\N	\N	1
845	76	ULLOA	1	170	\N	\N	1
670	76	SAN PEDRO	1	170	\N	\N	1
563	76	PRADERA	1	170	\N	\N	1
606	76	RESTREPO	1	170	\N	\N	1
520	76	PALMIRA	1	170	\N	\N	1
318	76	GUACARI	1	170	\N	\N	1
364	76	JAMUNDI	1	170	\N	\N	1
246	76	EL CAIRO	1	170	\N	\N	1
275	76	FLORIDA	1	170	\N	\N	1
233	76	DAGUA	1	170	\N	\N	1
243	76	EL AGUILA	1	170	\N	\N	1
111	76	BUGA	1	170	\N	\N	1
110	70	BUENAVISTA	1	170	\N	\N	1
124	70	CAIMITO	1	170	\N	\N	1
215	70	COROZAL	1	170	\N	\N	1
230	70	CHALAN	1	170	\N	\N	1
780	68	SURATA	1	170	\N	\N	1
820	68	TONA	1	170	\N	\N	1
861	68	VELEZ	1	170	\N	\N	1
872	68	VILLANUEVA	1	170	\N	\N	1
895	68	ZAPATOCA	1	170	\N	\N	1
1	70	SINCELEJO	1	170	\N	\N	1
671	73	SALDANA	1	170	\N	\N	1
675	73	SAN ANTONIO	1	170	\N	\N	1
678	73	SAN LUIS	1	170	\N	\N	1
770	73	SUAREZ	1	170	\N	\N	1
873	73	VILLARRICA	1	170	\N	\N	1
1	76	CALI	1	170	\N	\N	1
616	73	RIOBLANCO	1	170	\N	\N	1
411	73	LIBANO	1	170	\N	\N	1
461	73	MURILLO	1	170	\N	\N	1
504	73	ORTEGA	1	170	\N	\N	1
319	73	GUAMO	1	170	\N	\N	1
168	73	CHAPARRAL	1	170	\N	\N	1
217	73	COYAIMA	1	170	\N	\N	1
270	73	FALAN	1	170	\N	\N	1
43	73	ANZOATEGUI	1	170	\N	\N	1
279	44	FONSECA	1	170	\N	\N	1
430	44	MAICAO	1	170	\N	\N	1
1	44	RIOHACHA	1	170	\N	\N	1
78	44	BARRANCAS	1	170	\N	\N	1
676	41	SANTA MARIA	1	170	\N	\N	1
298	41	GARZON	1	170	\N	\N	1
349	41	HOBO	1	170	\N	\N	1
483	41	NATAGA	1	170	\N	\N	1
548	41	PITAL	1	170	\N	\N	1
6	41	ACEVEDO	1	170	\N	\N	1
16	41	AIPE	1	170	\N	\N	1
244	41	ELIAS	1	170	\N	\N	1
745	27	SIPI	1	170	\N	\N	1
800	27	UNGUIA	1	170	\N	\N	1
820	70	TOLU	1	170	\N	\N	1
742	70	SINCE	1	170	\N	\N	1
523	70	PALMITO	1	170	\N	\N	1
400	70	LA UNION	1	170	\N	\N	1
429	70	MAJAGUAL	1	170	\N	\N	1
508	70	OVEJAS	1	170	\N	\N	1
413	27	LLORO	1	170	\N	\N	1
495	27	NUQUI	1	170	\N	\N	1
800	54	TEORAMA	1	170	\N	\N	1
810	54	TIBU	1	170	\N	\N	1
599	54	RAGONVALIA	1	170	\N	\N	1
261	54	EL ZULIA	1	170	\N	\N	1
377	54	LABATECA	1	170	\N	\N	1
109	54	BUCARASICA	1	170	\N	\N	1
172	54	CHINACOTA	1	170	\N	\N	1
838	52	TUQUERRES	1	170	\N	\N	1
788	52	TANGUA	1	170	\N	\N	1
835	52	TUMACO	1	170	\N	\N	1
687	52	SAN LORENZO	1	170	\N	\N	1
693	52	SAN PABLO	1	170	\N	\N	1
612	52	RICAURTE	1	170	\N	\N	1
473	52	MOSQUERA	1	170	\N	\N	1
560	52	POTOSI	1	170	\N	\N	1
399	52	LA UNION	1	170	\N	\N	1
405	52	LEIVA	1	170	\N	\N	1
354	52	IMUES	1	170	\N	\N	1
378	52	LA CRUZ	1	170	\N	\N	1
320	52	GUAITARILLA	1	170	\N	\N	1
890	5	YOLOMBO	1	170	\N	\N	1
847	5	URRAO	1	170	\N	\N	1
856	5	VALPARAISO	1	170	\N	\N	1
837	5	TURBO	1	170	\N	\N	1
842	5	URAMITA	1	170	\N	\N	1
679	5	SANTA BARBARA	1	170	\N	\N	1
649	5	SAN CARLOS	1	170	\N	\N	1
664	5	SAN PEDRO	1	170	\N	\N	1
591	5	PUERTO TRIUNFO	1	170	\N	\N	1
607	5	RETIRO	1	170	\N	\N	1
631	5	SABANETA	1	170	\N	\N	1
411	5	LIBORINA	1	170	\N	\N	1
480	5	MUTATA	1	170	\N	\N	1
543	5	PEQUE	1	170	\N	\N	1
99	27	BOJAYA	1	170	\N	\N	1
135	27	CANTON DEL SAN PABLO	1	170	\N	\N	1
898	25	ZIPACON	1	170	\N	\N	1
815	25	TOCAIMA	1	170	\N	\N	1
823	25	TOPAIPI	1	170	\N	\N	1
878	25	VIOTA	1	170	\N	\N	1
885	25	YACOPI	1	170	\N	\N	1
718	25	SASAIMA	1	170	\N	\N	1
92	27	CARMEN DEL DARIEN	1	170	\N	\N	1
42	27	MEDIO BAUDO	1	170	\N	\N	1
777	25	SUPATA	1	170	\N	\N	1
785	25	TABIO	1	170	\N	\N	1
109	27	RIO IRO	1	170	\N	\N	1
491	25	NOCAIMA	1	170	\N	\N	1
506	25	VENECIA	1	170	\N	\N	1
530	25	PARATEBUENO	1	170	\N	\N	1
592	25	QUEBRADANEGRA	1	170	\N	\N	1
594	25	QUETAME	1	170	\N	\N	1
599	25	APULO	1	170	\N	\N	1
649	25	SAN BERNARDO	1	170	\N	\N	1
653	25	SAN CAYETANO	1	170	\N	\N	1
335	25	GUAYABETAL	1	170	\N	\N	1
339	25	GUTIERREZ	1	170	\N	\N	1
368	25	JERUSALEN	1	170	\N	\N	1
372	25	JUNIN	1	170	\N	\N	1
386	25	LA MESA	1	170	\N	\N	1
398	25	LA PENA	1	170	\N	\N	1
402	25	LA VEGA	1	170	\N	\N	1
430	25	MADRID	1	170	\N	\N	1
436	25	MANTA	1	170	\N	\N	1
438	25	MEDINA	1	170	\N	\N	1
483	25	NARINO	1	170	\N	\N	1
488	25	NILO	1	170	\N	\N	1
814	15	TOCA	1	170	\N	\N	1
816	15	TOGUI	1	170	\N	\N	1
832	15	TUNUNGUA	1	170	\N	\N	1
835	15	TURMEQUE	1	170	\N	\N	1
837	15	TUTA	1	170	\N	\N	1
861	15	VENTAQUEMADA	1	170	\N	\N	1
897	15	ZETAQUIRA	1	170	\N	\N	1
1	17	MANIZALES	1	170	\N	\N	1
42	17	ANSERMA	1	170	\N	\N	1
690	15	SANTA MARIA	1	170	\N	\N	1
693	15	SANTA ROSA DE VITERBO	1	170	\N	\N	1
723	15	SATIVASUR	1	170	\N	\N	1
740	15	SIACHOQUE	1	170	\N	\N	1
753	15	SOATA	1	170	\N	\N	1
755	15	SOCOTA	1	170	\N	\N	1
762	15	SORA	1	170	\N	\N	1
774	15	SUSACON	1	170	\N	\N	1
776	15	SUTAMARCHAN	1	170	\N	\N	1
790	15	TASCO	1	170	\N	\N	1
808	15	TINJACA	1	170	\N	\N	1
810	15	TIPACOQUE	1	170	\N	\N	1
522	15	PANQUEBA	1	170	\N	\N	1
550	15	PISVA	1	170	\N	\N	1
599	15	RAMIRIQUI	1	170	\N	\N	1
632	15	SABOYA	1	170	\N	\N	1
638	15	SACHICA	1	170	\N	\N	1
664	15	SAN JOSE DE PARE	1	170	\N	\N	1
676	15	SAN MIGUEL DE SEMA	1	170	\N	\N	1
681	15	SAN PABLO DE BORBUR	1	170	\N	\N	1
403	15	LA UVITA	1	170	\N	\N	1
407	15	VILLA DE LEYVA	1	170	\N	\N	1
442	15	MARIPI	1	170	\N	\N	1
466	15	MONGUI	1	170	\N	\N	1
476	15	MOTAVITA	1	170	\N	\N	1
507	15	OTANCHE	1	170	\N	\N	1
514	15	PAEZ	1	170	\N	\N	1
516	15	PAIPA	1	170	\N	\N	1
244	15	EL COCUY	1	170	\N	\N	1
272	15	FIRAVITOBA	1	170	\N	\N	1
299	15	GARAGOA	1	170	\N	\N	1
325	15	GUAYATA	1	170	\N	\N	1
368	15	JERICO	1	170	\N	\N	1
380	15	LA CAPILLA	1	170	\N	\N	1
183	15	CHITA	1	170	\N	\N	1
187	15	CHIVATA	1	170	\N	\N	1
204	15	COMBITA	1	170	\N	\N	1
218	15	COVARACHIA	1	170	\N	\N	1
894	13	ZAMBRANO	1	170	\N	\N	1
92	15	BETEITIVA	1	170	\N	\N	1
131	15	CALDAS	1	170	\N	\N	1
670	13	SAN PABLO	1	170	\N	\N	1
600	13	RIO VIEJO	1	170	\N	\N	1
647	13	SAN ESTANISLAO	1	170	\N	\N	1
654	13	SAN JACINTO	1	170	\N	\N	1
88	5	BELLO	1	170	\N	\N	1
113	5	BURITICA	1	170	\N	\N	1
125	5	CAICEDO	1	170	\N	\N	1
321	5	GUATAPE	1	170	\N	\N	1
368	5	JERICO	1	170	\N	\N	1
380	5	LA ESTRELLA	1	170	\N	\N	1
264	5	ENTRERRIOS	1	170	\N	\N	1
306	5	GIRALDO	1	170	\N	\N	1
315	5	GUADALUPE	1	170	\N	\N	1
209	5	CONCORDIA	1	170	\N	\N	1
234	5	DABEIBA	1	170	\N	\N	1
240	5	EBEJICO	1	170	\N	\N	1
145	5	CARAMANTA	1	170	\N	\N	1
150	5	CAROLINA	1	170	\N	\N	1
705	68	SANTA BARBARA	1	170	\N	\N	1
720	68	SANTA HELENA DEL OPON	1	170	\N	\N	1
673	68	SAN BENITO	1	170	\N	\N	1
524	99	LA PRIMAVERA	1	170	\N	\N	1
573	68	PUERTO PARRA	1	170	\N	\N	1
464	68	MOGOTES	1	170	\N	\N	1
502	68	ONZAGA	1	170	\N	\N	1
533	68	PARAMO	1	170	\N	\N	1
385	68	LANDAZURI	1	170	\N	\N	1
406	68	LEBRIJA	1	170	\N	\N	1
425	68	MACARAVITA	1	170	\N	\N	1
320	68	GUADALUPE	1	170	\N	\N	1
324	68	GUAVATA	1	170	\N	\N	1
344	68	HATO	1	170	\N	\N	1
255	68	EL PLAYON	1	170	\N	\N	1
266	68	ENCISO	1	170	\N	\N	1
276	68	FLORIDABLANCA	1	170	\N	\N	1
207	68	CONCEPCION	1	170	\N	\N	1
211	68	CONTRATACION	1	170	\N	\N	1
229	68	CURITI	1	170	\N	\N	1
101	68	BOLIVAR	1	170	\N	\N	1
121	68	CABRERA	1	170	\N	\N	1
687	66	SANTUARIO	1	170	\N	\N	1
20	68	ALBANIA	1	170	\N	\N	1
456	66	MISTRATO	1	170	\N	\N	1
45	66	APIA	1	170	\N	\N	1
318	66	GUATICA	1	170	\N	\N	1
401	63	LA TEBAIDA	1	170	\N	\N	1
594	63	QUIMBAYA	1	170	\N	\N	1
111	63	BUENAVISTA	1	170	\N	\N	1
293	25	GACHALA	1	170	\N	\N	1
299	25	GAMA	1	170	\N	\N	1
320	25	GUADUAS	1	170	\N	\N	1
168	25	CHAGUANI	1	170	\N	\N	1
181	25	CHOACHI	1	170	\N	\N	1
214	25	COTA	1	170	\N	\N	1
269	25	FACATATIVA	1	170	\N	\N	1
281	25	FOSCA	1	170	\N	\N	1
288	25	FUQUENE	1	170	\N	\N	1
53	25	ARBELAEZ	1	170	\N	\N	1
95	25	BITUIMA	1	170	\N	\N	1
126	25	CAJICA	1	170	\N	\N	1
807	23	TIERRALTA	1	170	\N	\N	1
686	23	SAN PELAYO	1	170	\N	\N	1
174	17	CHINCHINA	1	170	\N	\N	1
433	17	MANZANARES	1	170	\N	\N	1
1	94	INIRIDA	1	170	\N	\N	1
1	95	SAN JOSE DEL GUAVIARE	1	170	\N	\N	1
15	95	CALAMAR	1	170	\N	\N	1
140	13	CALAMAR	1	170	\N	\N	1
212	13	CORDOBA	1	170	\N	\N	1
638	8	SABANALARGA	1	170	\N	\N	1
675	8	SANTA LUCIA	1	170	\N	\N	1
685	8	SANTO TOMAS	1	170	\N	\N	1
849	8	USIACURI	1	170	\N	\N	1
1	13	CARTAGENA	1	170	\N	\N	1
6	13	ACHI	1	170	\N	\N	1
675	23	SAN BERNARDO DEL VIENTO	1	170	\N	\N	1
580	23	PUERTO LIBERTADOR	1	170	\N	\N	1
660	23	SAHAGUN	1	170	\N	\N	1
500	23	MONITOS	1	170	\N	\N	1
555	23	PLANETA RICA	1	170	\N	\N	1
570	23	PUEBLO NUEVO	1	170	\N	\N	1
466	23	MONTELIBANO	1	170	\N	\N	1
168	23	CHIMA	1	170	\N	\N	1
189	23	CIENAGA DE ORO	1	170	\N	\N	1
417	23	LORICA	1	170	\N	\N	1
750	20	SAN DIEGO	1	170	\N	\N	1
770	20	SAN MARTIN	1	170	\N	\N	1
1	23	MONTERIA	1	170	\N	\N	1
79	23	BUENAVISTA	1	170	\N	\N	1
310	20	GONZALEZ	1	170	\N	\N	1
443	20	MANAURE BALCON DL CESAR	1	170	\N	\N	1
550	20	PELAYA	1	170	\N	\N	1
621	20	LA PAZ	1	170	\N	\N	1
710	20	SAN ALBERTO	1	170	\N	\N	1
175	20	CHIMICHAGUA	1	170	\N	\N	1
178	20	CHIRIGUANA	1	170	\N	\N	1
228	20	CURUMANI	1	170	\N	\N	1
1	20	VALLEDUPAR	1	170	\N	\N	1
13	20	AGUSTIN CODAZZI	1	170	\N	\N	1
807	19	TIMBIO	1	170	\N	\N	1
824	19	TOTORO	1	170	\N	\N	1
743	19	SILVIA	1	170	\N	\N	1
215	52	CORDOBA	1	170	\N	\N	1
224	52	CUASPUD	1	170	\N	\N	1
250	52	EL CHARCO	1	170	\N	\N	1
51	52	ARBOLEDA	1	170	\N	\N	1
203	52	COLON	1	170	\N	\N	1
400	50	LEJANIAS	1	170	\N	\N	1
590	50	PUERTO RICO	1	170	\N	\N	1
686	50	SAN JUANITO	1	170	\N	\N	1
745	47	SITIONUEVO	1	170	\N	\N	1
150	50	CASTILLA LA NUEVA	1	170	\N	\N	1
226	50	CUMARAL	1	170	\N	\N	1
251	50	EL CASTILLO	1	170	\N	\N	1
707	47	SANTA ANA	1	170	\N	\N	1
288	47	FUNDACION	1	170	\N	\N	1
555	47	PLATO	1	170	\N	\N	1
258	47	EL PINON	1	170	\N	\N	1
855	44	URUMITA	1	170	\N	\N	1
1	47	SANTAMARTA	1	170	\N	\N	1
134	27	BELEN DE BAJIRA	1	170	\N	\N	1
573	19	PUERTO TEJADA	1	170	\N	\N	1
473	19	MORALES	1	170	\N	\N	1
517	19	PAEZ	1	170	\N	\N	1
290	19	FLORENCIA	1	170	\N	\N	1
130	19	CAJIBIO	1	170	\N	\N	1
142	19	CALOTO	1	170	\N	\N	1
100	19	BOLIVAR	1	170	\N	\N	1
860	18	VALPARAISO	1	170	\N	\N	1
877	17	VITERBO	1	170	\N	\N	1
247	18	EL DONCELLO	1	170	\N	\N	1
410	18	LA MONTANITA	1	170	\N	\N	1
616	17	RISARALDA	1	170	\N	\N	1
662	17	SAMANA	1	170	\N	\N	1
777	17	SUPIA	1	170	\N	\N	1
513	17	PACORA	1	170	\N	\N	1
614	17	RIOSUCIO	1	170	\N	\N	1
141	8	CANDELARIA	1	170	\N	\N	1
436	8	MANATI	1	170	\N	\N	1
549	8	PIOJO	1	170	\N	\N	1
433	13	MAHATES	1	170	\N	\N	1
473	13	MORALES	1	170	\N	\N	1
430	13	MAGANGUE	1	170	\N	\N	1
100	76	BOLIVAR	1	170	\N	\N	1
20	76	ALCALA	1	170	\N	\N	1
21	5	ALEJANDRIA	1	170	\N	\N	1
34	5	ANDES	1	170	\N	\N	1
40	5	ANORI	1	170	\N	\N	1
55	5	ARGELIA	1	170	\N	\N	1
306	76	GINEBRA	1	170	\N	\N	1
248	76	EL CERRITO	1	170	\N	\N	1
113	76	BUGALAGRANDE	1	170	\N	\N	1
560	44	MANAURE	1	170	\N	\N	1
801	41	TERUEL	1	170	\N	\N	1
668	41	SAN AGUSTIN	1	170	\N	\N	1
396	41	LA PLATA	1	170	\N	\N	1
250	54	EL TARRA	1	170	\N	\N	1
405	54	LOS PATIOS	1	170	\N	\N	1
786	52	TAMINANGO	1	170	\N	\N	1
887	5	YARUMAL	1	170	\N	\N	1
819	5	TOLEDO	1	170	\N	\N	1
686	5	SANTA ROSA DE OSOS	1	170	\N	\N	1
875	25	VILLETA	1	170	\N	\N	1
740	25	SIBATE	1	170	\N	\N	1
781	25	SUTATAUSA	1	170	\N	\N	1
524	25	PANDI	1	170	\N	\N	1
764	15	SORACA	1	170	\N	\N	1
531	15	PAUNA	1	170	\N	\N	1
621	15	RONDON	1	170	\N	\N	1
185	15	CHITARAQUE	1	170	\N	\N	1
212	15	COPER	1	170	\N	\N	1
47	15	AQUITANIA	1	170	\N	\N	1
744	13	SIMITI	1	170	\N	\N	1
549	13	PINILLOS	1	170	\N	\N	1
684	68	SAN JOSE DE MIRANDA	1	170	\N	\N	1
615	68	RIONEGRO	1	170	\N	\N	1
522	68	PALMAR	1	170	\N	\N	1
594	66	QUINCHIA	1	170	\N	\N	1
302	63	GENOVA	1	170	\N	\N	1
548	63	PIJAO	1	170	\N	\N	1
88	17	BELALCAZAR	1	170	\N	\N	1
540	91	PUERTO NARINO	1	170	\N	\N	1
758	8	SOLEDAD	1	170	\N	\N	1
586	23	PURISIMA	1	170	\N	\N	1
210	52	CONTADERO	1	170	\N	\N	1
110	52	BUESACO	1	170	\N	\N	1
568	50	PUERTO GAITAN	1	170	\N	\N	1
680	50	SAN CARLOS DE GUAROA	1	170	\N	\N	1
355	19	INZA	1	170	\N	\N	1
256	19	EL TAMBO	1	170	\N	\N	1
137	19	CALDONO	1	170	\N	\N	1
75	19	BALBOA	1	170	\N	\N	1
29	18	ALBANIA	1	170	\N	\N	1
205	18	CURILLO	1	170	\N	\N	1
2	5	ABEJORRAL	1	170	\N	\N	1
30	5	AMAGA	1	170	\N	\N	1
42	5	SANTAFE DE ANTIOQUIA	1	170	\N	\N	1
79	5	BARBOSA	1	170	\N	\N	1
889	97	YAVARATE	1	170	\N	\N	1
572	99	SANTA RITA	1	170	\N	\N	1
263	91	EL ENCANTO	1	170	\N	\N	1
405	91	LA CHORRERA	1	170	\N	\N	1
407	91	LA PEDRERA	1	170	\N	\N	1
798	91	TARAPACA	1	170	\N	\N	1
343	94	GUAVIARE	1	170	\N	\N	1
883	94	SAN FELIPE	1	170	\N	\N	1
884	94	PUERTO COLOMBIA	1	170	\N	\N	1
885	94	LA GUADALUPE	1	170	\N	\N	1
161	97	CARURU	1	170	\N	\N	1
511	97	PACOA	1	170	\N	\N	1
777	97	PAPUNAUA	1	170	\N	\N	1
312	25	GRANADA	1	170	\N	\N	1
30	13	ALTOS DEL ROSARIO	1	170	\N	\N	1
810	13	IQUISIO	1	170	\N	\N	1
580	13	REGIDOR	1	170	\N	\N	1
222	13	CLEMENCIA	1	170	\N	\N	1
620	13	SAN CRISTOBAL	1	170	\N	\N	1
42	13	ARENAL	1	170	\N	\N	1
188	13	CICUCO	1	170	\N	\N	1
62	13	ARROYOHONDO	1	170	\N	\N	1
50	27	ATRATO	1	170	\N	\N	1
260	25	EL ROSAL	1	170	\N	\N	1
90	44	DIBULLA	1	170	\N	\N	1
98	44	DISTRACCION	1	170	\N	\N	1
420	44	LA JAGUA DEL PILAR	1	170	\N	\N	1
757	86	SAN MIGUEL	1	170	\N	\N	1
533	19	PIAMONTE	1	170	\N	\N	1
845	19	VILLA RICA	1	170	\N	\N	1
785	18	SOLITA	1	170	\N	\N	1
300	23	COTORRA	1	170	\N	\N	1
430	91	LA VICTORIA	1	170	\N	\N	1
530	91	PUERTO ALEGRIA	1	170	\N	\N	1
570	20	PUEBLO BELLO	1	170	\N	\N	1
90	5	LA PINTADA	1	170	\N	\N	1
390	5	LA PINTADA	1	170	\N	\N	1
756	18	SOLANO	1	170	\N	\N	1
890	97	VILLA FATIMA	1	170	\N	\N	1
891	97	ACARICUARA	1	170	\N	\N	1
35	44	ALBANIA	1	170	\N	\N	1
785	19	SUCRE	1	170	\N	\N	1
999	1	TODOS	1	170	\N	\N	1
221	70	COVENAS	1	170	\N	\N	1
160	27	CERTEGUI	1	170	\N	\N	1
720	47	SANTA BARBARA DE PINTO	1	170	\N	\N	1
30	47	ALGARROBO	1	170	\N	\N	1
854	73	VALLE DE SAN JUAN	1	170	\N	\N	1
585	73	PURIFICACION	1	170	\N	\N	1
443	73	MARIQUITA	1	170	\N	\N	1
483	73	NATAGAIMA	1	170	\N	\N	1
352	73	ICONONZO	1	170	\N	\N	1
200	73	COELLO	1	170	\N	\N	1
268	73	ESPINAL	1	170	\N	\N	1
26	73	ALVARADO	1	170	\N	\N	1
124	73	CAJAMARCA	1	170	\N	\N	1
110	44	EL MOLINO	1	170	\N	\N	1
615	41	RIVERA	1	170	\N	\N	1
660	41	SALADOBLANCO	1	170	\N	\N	1
791	41	TARQUI	1	170	\N	\N	1
378	41	LA ARGENTINA	1	170	\N	\N	1
518	41	PAICOL	1	170	\N	\N	1
1	41	NEIVA	1	170	\N	\N	1
20	41	ALGECIRAS	1	170	\N	\N	1
78	41	BARAYA	1	170	\N	\N	1
660	27	SAN JOSE DEL PALMAR	1	170	\N	\N	1
713	70	SAN ONOFRE	1	170	\N	\N	1
771	70	SUCRE	1	170	\N	\N	1
678	70	SAN BENITO ABAD	1	170	\N	\N	1
708	70	SAN MARCOS	1	170	\N	\N	1
491	27	NOVITA	1	170	\N	\N	1
615	27	RIOSUCIO	1	170	\N	\N	1
480	54	MUTISCUA	1	170	\N	\N	1
520	54	PAMPLONITA	1	170	\N	\N	1
673	54	SAN CAYETANO	1	170	\N	\N	1
398	54	LA PLAYA	1	170	\N	\N	1
125	54	CACOTA	1	170	\N	\N	1
174	54	CHITAGA	1	170	\N	\N	1
3	54	ABREGO	1	170	\N	\N	1
885	52	YACUANQUER	1	170	\N	\N	1
683	52	SANDONA	1	170	\N	\N	1
685	52	SAN BERNARDO	1	170	\N	\N	1
621	52	ROBERTO PAYAN	1	170	\N	\N	1
520	52	FRANCIS PIZARRO	1	170	\N	\N	1
565	52	PROVIDENCIA	1	170	\N	\N	1
411	52	LINARES	1	170	\N	\N	1
418	52	LOS ANDES	1	170	\N	\N	1
356	52	IPIALES	1	170	\N	\N	1
287	52	FUNES	1	170	\N	\N	1
317	52	GUACHUCAL	1	170	\N	\N	1
137	8	CAMPO DE LA CRUZ	1	170	\N	\N	1
858	5	VEGACHI	1	170	\N	\N	1
674	5	SAN VICENTE	1	170	\N	\N	1
690	5	SANTO DOMINGO	1	170	\N	\N	1
736	5	SEGOVIA	1	170	\N	\N	1
659	5	SAN JUAN DE URABA	1	170	\N	\N	1
585	5	PTO NARE(LAMAGDALENA)	1	170	\N	\N	1
615	5	RIONEGRO	1	170	\N	\N	1
628	5	SABANALARGA	1	170	\N	\N	1
495	5	NECHI	1	170	\N	\N	1
245	27	EL CARMEN	1	170	\N	\N	1
205	27	CONDOTO	1	170	\N	\N	1
899	25	ZIPAQUIRA	1	170	\N	\N	1
807	25	TIBIRITA	1	170	\N	\N	1
839	25	UBALA	1	170	\N	\N	1
843	25	UBATE	1	170	\N	\N	1
743	25	SILVANIA	1	170	\N	\N	1
772	25	SUESCA	1	170	\N	\N	1
779	25	SUSA	1	170	\N	\N	1
480	15	MUZO	1	170	\N	\N	1
494	15	NUEVO COLON	1	170	\N	\N	1
518	15	PAJARITO	1	170	\N	\N	1
232	15	CHIQUIZA	1	170	\N	\N	1
296	15	GAMEZA	1	170	\N	\N	1
317	15	GUACAMAYAS	1	170	\N	\N	1
377	15	LABRANZAGRANDE	1	170	\N	\N	1
162	15	CERINZA	1	170	\N	\N	1
215	15	CORRALES	1	170	\N	\N	1
224	15	CUCAITA	1	170	\N	\N	1
873	13	VILLANUEVA	1	170	\N	\N	1
22	15	ALMEIDA	1	170	\N	\N	1
87	15	BELEN	1	170	\N	\N	1
97	15	BOAVITA	1	170	\N	\N	1
109	15	BUENAVISTA	1	170	\N	\N	1
657	13	SAN JUAN NEPOMUCENO	1	170	\N	\N	1
683	13	SANTA ROSA NORTE	1	170	\N	\N	1
760	13	SOPLAVIENTO	1	170	\N	\N	1
780	13	TALAIGUA NUEVO	1	170	\N	\N	1
650	13	SAN FERNANDO	1	170	\N	\N	1
86	5	BELMIRA	1	170	\N	\N	1
93	5	BETULIA	1	170	\N	\N	1
107	5	BRICENO	1	170	\N	\N	1
120	5	CACERES	1	170	\N	\N	1
129	5	CALDAS	1	170	\N	\N	1
347	5	HELICONIA	1	170	\N	\N	1
360	5	ITAGUI	1	170	\N	\N	1
364	5	JARDIN	1	170	\N	\N	1
376	5	LA CEJA	1	170	\N	\N	1
400	5	LA UNION	1	170	\N	\N	1
266	5	ENVIGADO	1	170	\N	\N	1
284	5	FRONTINO	1	170	\N	\N	1
308	5	GIRARDOTA	1	170	\N	\N	1
313	5	GRANADA	1	170	\N	\N	1
318	5	GUARNE	1	170	\N	\N	1
206	5	CONCEPCION	1	170	\N	\N	1
212	5	COPACABANA	1	170	\N	\N	1
237	5	DON MATIAS	1	170	\N	\N	1
134	5	CAMPAMENTO	1	170	\N	\N	1
142	5	CARACOLI	1	170	\N	\N	1
148	5	CARMEN DE VIBORAL	1	170	\N	\N	1
190	5	CISNEROS	1	170	\N	\N	1
689	68	SAN VICENTE DE CHUCURI	1	170	\N	\N	1
755	68	SOCORRO	1	170	\N	\N	1
669	68	SAN ANDRES	1	170	\N	\N	1
679	68	SAN GIL	1	170	\N	\N	1
1	99	PUERTO CARRENO	1	170	\N	\N	1
572	68	PUENTE NACIONAL	1	170	\N	\N	1
575	68	PUERTO WILCHES	1	170	\N	\N	1
498	68	OCAMONTE	1	170	\N	\N	1
524	68	PALMAS SOCORRO	1	170	\N	\N	1
549	68	PINCHOTE	1	170	\N	\N	1
377	68	LA BELLEZA	1	170	\N	\N	1
397	68	LA PAZ	1	170	\N	\N	1
418	68	LOS SANTOS	1	170	\N	\N	1
296	68	GALAN	1	170	\N	\N	1
298	68	GAMBITA	1	170	\N	\N	1
307	68	GIRON (SAN JUAN DE)	1	170	\N	\N	1
368	68	JESUS MARIA	1	170	\N	\N	1
245	68	EL GUACAMAYO	1	170	\N	\N	1
264	68	ENCINO	1	170	\N	\N	1
167	68	CHARALA	1	170	\N	\N	1
176	68	CHIMA	1	170	\N	\N	1
190	68	CIMITARRA	1	170	\N	\N	1
217	68	COROMORO	1	170	\N	\N	1
160	68	CEPITA	1	170	\N	\N	1
79	68	BARICHARA	1	170	\N	\N	1
132	68	CALIFORNIA	1	170	\N	\N	1
682	66	SANTA ROSA DE CABAL	1	170	\N	\N	1
51	68	ARATOCA	1	170	\N	\N	1
400	66	LA VIRGINIA	1	170	\N	\N	1
572	66	PUEBLO RICO	1	170	\N	\N	1
272	63	FILANDIA	1	170	\N	\N	1
470	63	MONTENEGRO	1	170	\N	\N	1
1	66	PEREIRA	1	170	\N	\N	1
874	54	VILLA DEL ROSARIO	1	170	\N	\N	1
295	25	GACHANCIPA	1	170	\N	\N	1
307	25	GIRARDOT	1	170	\N	\N	1
322	25	GUASCA	1	170	\N	\N	1
326	25	GUATAVITA	1	170	\N	\N	1
178	25	CHIPAQUE	1	170	\N	\N	1
200	25	COGUA	1	170	\N	\N	1
258	25	EL PENON	1	170	\N	\N	1
279	25	FOMEQUE	1	170	\N	\N	1
286	25	FUNZA	1	170	\N	\N	1
1	25	AGUA DE DIOS	1	170	\N	\N	1
86	25	BELTRAN	1	170	\N	\N	1
99	25	BOJACA	1	170	\N	\N	1
120	25	CABRERA	1	170	\N	\N	1
154	25	CARMEN DE CARUPA	1	170	\N	\N	1
678	23	SAN CARLOS	1	170	\N	\N	1
50	17	ARANZAZU	1	170	\N	\N	1
207	52	CONSACA	1	170	\N	\N	1
36	52	ANCUYA	1	170	\N	\N	1
325	50	MAPIRIPAN	1	170	\N	\N	1
450	50	PUERTO CONCORDIA	1	170	\N	\N	1
577	50	PUERTO LLERAS	1	170	\N	\N	1
683	50	SAN JUAN DE ARAMA	1	170	\N	\N	1
798	47	TENERIFE	1	170	\N	\N	1
6	50	ACACIAS	1	170	\N	\N	1
110	50	BARRANCA DE UPIA	1	170	\N	\N	1
223	50	CUBARRAL	1	170	\N	\N	1
425	27	MEDIO ATRATO	1	170	\N	\N	1
1711	3	LIMA	1	171	\N	\N	1
570	86	LA HORMIGA	1	170	\N	\N	1
1	4	LEXINGTON	1	200	\N	\N	1
1	9	STANFORD	1	200	\N	\N	1
150	27	carmen del darien	1	170	0	\N	1
1722	2	SAO PAULO	1	172	\N	\N	1
810	27	UNION PANAMERICANA	1	170	\N	\N	1
605	47	REMOLINO	1	170	\N	\N	1
245	47	EL BANCO	1	170	\N	\N	1
161	47	CERRO SAN ANTONIO	1	170	\N	\N	1
548	19	PIENDAMO	1	170	\N	\N	1
450	19	MERCADERES	1	170	\N	\N	1
397	19	LA VEGA	1	170	\N	\N	1
610	18	SAN JOSE DE FRAGUA	1	170	\N	\N	1
867	17	VICTORIA	1	170	\N	\N	1
592	18	PUERTO RICO	1	170	\N	\N	1
653	17	SALAMINA	1	170	\N	\N	1
541	17	PENSILVANIA	1	170	\N	\N	1
296	8	GALAPA	1	170	\N	\N	1
440	13	MARGARITA	1	170	\N	\N	1
468	13	MOMPOS	1	170	\N	\N	1
36	76	ANDALUCIA	1	170	\N	\N	1
4	5	ABRIAQUI	1	170	\N	\N	1
45	5	APARTADO	1	170	\N	\N	1
828	76	TRUJILLO	1	170	\N	\N	1
377	76	LA CUMBRE	1	170	\N	\N	1
30	73	AMBALEMA	1	170	\N	\N	1
148	73	CARMEN DE APICALA	1	170	\N	\N	1
357	41	IQUIRA	1	170	\N	\N	1
128	54	CACHIRA	1	170	\N	\N	1
1	54	CUCUTA	1	170	\N	\N	1
790	5	TARAZA	1	170	\N	\N	1
642	5	SALGAR	1	170	\N	\N	1
658	25	SAN FRANCISCO	1	170	\N	\N	1
572	25	PUERTO SALGAR	1	170	\N	\N	1
806	15	TIBASOSA	1	170	\N	\N	1
838	13	TURBANA	1	170	\N	\N	1
90	15	BERBEO	1	170	\N	\N	1
154	5	CAUCASIA	1	170	\N	\N	1
655	68	SABANA DE TORRES	1	170	\N	\N	1
440	66	MARSELLA	1	170	\N	\N	1
380	17	LA DORADA	1	170	\N	\N	1
25	95	EL RETORNO	1	170	\N	\N	1
701	19	SANTA ROSA	1	170	\N	\N	1
1	52	PASTO	1	170	\N	\N	1
205	47	CONCORDIA	1	170	\N	\N	1
960	47	ZAPAYAN	1	170	\N	\N	1
600	27	RIO QUITO	1	170	\N	\N	1
320	86	ORITO	1	170	\N	\N	1
569	86	PUERTO CAICEDO	1	170	\N	\N	1
573	86	PUERTO LEGUIZAMO	1	170	\N	\N	1
760	86	SANTIAGO	1	170	\N	\N	1
564	88	PROVIDENCIA	1	170	\N	\N	1
1	91	LETICIA	1	170	\N	\N	1
315	85	SACAMA	1	170	\N	\N	1
325	85	SAN LUIS DE PALENQUE	1	170	\N	\N	1
430	85	TRINIDAD	1	170	\N	\N	1
230	85	OROCUE	1	170	\N	\N	1
10	85	AGUAZUL	1	170	\N	\N	1
125	85	HATO COROZAL	1	170	\N	\N	1
162	85	MONTERREY	1	170	\N	\N	1
300	81	FORTUL	1	170	\N	\N	1
794	81	TAME	1	170	\N	\N	1
1	85	YOPAL	1	170	\N	\N	1
892	76	YUMBO	1	170	\N	\N	1
1	81	ARAUCA	1	170	\N	\N	1
65	81	ARAUQUITA	1	170	\N	\N	1
736	76	SEVILLA	1	170	\N	\N	1
823	76	TORO	1	170	\N	\N	1
622	76	ROLDANILLO	1	170	\N	\N	1
403	76	LA VICTORIA	1	170	\N	\N	1
400	76	LA UNION	1	170	\N	\N	1
250	76	EL DOVIO	1	170	\N	\N	1
130	76	CANDELARIA	1	170	\N	\N	1
122	76	CAICEDONIA	1	170	\N	\N	1
126	76	CALIMA (DARIEN)	1	170	\N	\N	1
265	70	GUARANDA	1	170	\N	\N	1
773	68	SUCRE	1	170	\N	\N	1
855	68	VALLE DE SAN JOSE	1	170	\N	\N	1
867	68	VETAS	1	170	\N	\N	1
622	73	RONCESVALLES	1	170	\N	\N	1
624	73	ROVIRA	1	170	\N	\N	1
686	73	SANTA ISABEL	1	170	\N	\N	1
861	73	VENADILLO	1	170	\N	\N	1
555	73	PLANADAS	1	170	\N	\N	1
233	70	EL ROBLE	1	170	\N	\N	1
449	73	MELGAR	1	170	\N	\N	1
347	73	HERVEO	1	170	\N	\N	1
408	73	LERIDA	1	170	\N	\N	1
236	73	DOLORES	1	170	\N	\N	1
24	73	ALPUJARRA	1	170	\N	\N	1
152	73	CASABIANCA	1	170	\N	\N	1
847	44	URIBIA	1	170	\N	\N	1
807	41	TIMANA	1	170	\N	\N	1
770	41	SUAZA	1	170	\N	\N	1
799	41	TELLO	1	170	\N	\N	1
359	41	ISNOS	1	170	\N	\N	1
503	41	OPORAPA	1	170	\N	\N	1
524	41	PALERMO	1	170	\N	\N	1
26	41	ALTAMIRA	1	170	\N	\N	1
132	41	CAMPOALEGRE	1	170	\N	\N	1
787	27	TADO	1	170	\N	\N	1
1	73	IBAGUE	1	170	\N	\N	1
717	70	SAN PEDRO	1	170	\N	\N	1
702	70	SAN JUAN DE BETULIA	1	170	\N	\N	1
473	70	MORROA	1	170	\N	\N	1
680	54	SANTIAGO	1	170	\N	\N	1
743	54	SILOS	1	170	\N	\N	1
498	54	OCANA	1	170	\N	\N	1
670	54	SAN CALIXTO	1	170	\N	\N	1
313	54	GRAMALOTE	1	170	\N	\N	1
223	54	CUCUTILLA	1	170	\N	\N	1
245	54	EL CARMEN	1	170	\N	\N	1
699	52	SANTACRUZ	1	170	\N	\N	1
720	52	SAPUYES	1	170	\N	\N	1
585	52	PUPIALES	1	170	\N	\N	1
678	52	SAMANIEGO	1	170	\N	\N	1
506	52	OSPINA	1	170	\N	\N	1
540	52	POLICARPA	1	170	\N	\N	1
573	52	PUERRES	1	170	\N	\N	1
427	52	MAGUI	1	170	\N	\N	1
435	52	MALLAMA	1	170	\N	\N	1
352	52	ILES	1	170	\N	\N	1
385	52	LA LLANADA	1	170	\N	\N	1
390	52	LA TOLA	1	170	\N	\N	1
260	52	EL TAMBO	1	170	\N	\N	1
895	5	ZARAGOZA	1	170	\N	\N	1
78	8	BARANOA	1	170	\N	\N	1
885	5	YALI	1	170	\N	\N	1
761	5	SOPETRAN	1	170	\N	\N	1
789	5	TAMESIS	1	170	\N	\N	1
792	5	TARSO	1	170	\N	\N	1
670	5	SAN ROQUE	1	170	\N	\N	1
697	5	SANTUARIO	1	170	\N	\N	1
756	5	SONSON	1	170	\N	\N	1
658	5	SAN JOSE DE LA MONTANA	1	170	\N	\N	1
579	5	PUERTO BERRIO	1	170	\N	\N	1
604	5	REMEDIOS	1	170	\N	\N	1
425	5	MACEO	1	170	\N	\N	1
467	5	MONTEBELLO	1	170	\N	\N	1
490	5	NECOCLI	1	170	\N	\N	1
501	5	OLAYA	1	170	\N	\N	1
361	27	ISTMINA	1	170	\N	\N	1
6	27	ACANDI	1	170	\N	\N	1
73	27	BAGADO	1	170	\N	\N	1
77	27	BAJO BAUDO	1	170	\N	\N	1
1	27	QUIBDO	1	170	\N	\N	1
805	25	TIBACUY	1	170	\N	\N	1
841	25	UBAQUE	1	170	\N	\N	1
845	25	UNE	1	170	\N	\N	1
851	25	UTICA	1	170	\N	\N	1
871	25	VILLAGOMEZ	1	170	\N	\N	1
736	25	SESQUILE	1	170	\N	\N	1
745	25	SIMIJACA	1	170	\N	\N	1
758	25	SOPO	1	170	\N	\N	1
793	25	TAUSA	1	170	\N	\N	1
797	25	TENA	1	170	\N	\N	1
518	25	PAIME	1	170	\N	\N	1
535	25	PASCA	1	170	\N	\N	1
580	25	PULI	1	170	\N	\N	1
612	25	RICAURTE	1	170	\N	\N	1
645	25	S.ANTONIO TEQUENDAMA	1	170	\N	\N	1
328	25	GUAYABAL DE SIQUIMA	1	170	\N	\N	1
377	25	LA CALERA	1	170	\N	\N	1
394	25	LA PALMA	1	170	\N	\N	1
407	25	LENGUAZAQUE	1	170	\N	\N	1
426	25	MACHETA	1	170	\N	\N	1
473	25	MOSQUERA	1	170	\N	\N	1
486	25	NEMOCON	1	170	\N	\N	1
489	25	NIMAIMA	1	170	\N	\N	1
820	15	TOPAGA	1	170	\N	\N	1
822	15	TOTA	1	170	\N	\N	1
839	15	TUTASA	1	170	\N	\N	1
842	15	UMBITA	1	170	\N	\N	1
879	15	VIRACACHA	1	170	\N	\N	1
13	17	AGUADAS	1	170	\N	\N	1
686	15	SANTANA	1	170	\N	\N	1
696	15	SANTA SOFIA	1	170	\N	\N	1
720	15	SATIVANORTE	1	170	\N	\N	1
757	15	SOCHA	1	170	\N	\N	1
759	15	SOGAMOSO	1	170	\N	\N	1
763	15	SOTAQUIRA	1	170	\N	\N	1
798	15	TENZA	1	170	\N	\N	1
804	15	TIBANA	1	170	\N	\N	1
533	15	PAYA	1	170	\N	\N	1
542	15	PESCA	1	170	\N	\N	1
572	15	PUERTO BOYACA	1	170	\N	\N	1
600	15	RAQUIRA	1	170	\N	\N	1
660	15	SAN EDUARDO	1	170	\N	\N	1
673	15	SAN MATEO	1	170	\N	\N	1
401	15	LA VICTORIA	1	170	\N	\N	1
425	15	MACANAL	1	170	\N	\N	1
464	15	MONGUA	1	170	\N	\N	1
491	15	NOBSA	1	170	\N	\N	1
500	15	OICATA	1	170	\N	\N	1
226	15	CUITIVA	1	170	\N	\N	1
236	15	CHIVOR	1	170	\N	\N	1
293	15	GACHANTIVA	1	170	\N	\N	1
322	15	GUATEQUE	1	170	\N	\N	1
362	15	IZA	1	170	\N	\N	1
135	15	CAMPOHERMOSO	1	170	\N	\N	1
176	15	CHIQUINQUIRA	1	170	\N	\N	1
836	13	TURBACO	1	170	\N	\N	1
51	15	ARCABUCO	1	170	\N	\N	1
106	15	BRICENO	1	170	\N	\N	1
673	13	SANTA CATALINA	1	170	\N	\N	1
688	13	SANTA ROSA DEL SUR	1	170	\N	\N	1
91	5	BETANIA	1	170	\N	\N	1
101	5	BOLIVAR	1	170	\N	\N	1
353	5	HISPANIA	1	170	\N	\N	1
361	5	ITUANGO	1	170	\N	\N	1
282	5	FREDONIA	1	170	\N	\N	1
310	5	GOMEZ PLATA	1	170	\N	\N	1
197	5	COCORNA	1	170	\N	\N	1
250	5	EL BAGRE	1	170	\N	\N	1
138	5	CANASGORDAS	1	170	\N	\N	1
172	5	CHIGORODO	1	170	\N	\N	1
770	68	SUAITA	1	170	\N	\N	1
682	68	SAN JOAQUIN	1	170	\N	\N	1
444	68	MATANZA	1	170	\N	\N	1
500	68	OIBA	1	170	\N	\N	1
547	68	PIEDECUESTA	1	170	\N	\N	1
720	54	SARDINATA	1	170	\N	\N	1
553	54	PUERTO SANTANDER	1	170	\N	\N	1
344	54	HACARI	1	170	\N	\N	1
239	54	DURANIA	1	170	\N	\N	1
51	54	ARBOLEDAS	1	170	\N	\N	1
696	52	SANTABARBARA	1	170	\N	\N	1
694	52	SAN PEDRO DE CARTAGO	1	170	\N	\N	1
490	52	OLAYA HERRERA	1	170	\N	\N	1
323	52	GUALMATAN	1	170	\N	\N	1
254	52	EL PENOL	1	170	\N	\N	1
480	52	NARINO	1	170	\N	\N	1
1	6	AUSTIN	1	200	\N	\N	1
1	7	SAN MIGUEL	1	300	\N	\N	1
370	68	JORDAN	1	170	\N	\N	1
432	68	MALAGA	1	170	\N	\N	1
318	68	GUACA	1	170	\N	\N	1
322	68	GUAPOTA	1	170	\N	\N	1
235	68	EL CARMEN	1	170	\N	\N	1
250	68	EL PENON	1	170	\N	\N	1
169	68	CHARTA	1	170	\N	\N	1
179	68	CHIPATA	1	170	\N	\N	1
162	68	CERRITO	1	170	\N	\N	1
92	68	BETULIA	1	170	\N	\N	1
147	68	CAPITANEJO	1	170	\N	\N	1
13	68	AGUADA	1	170	\N	\N	1
383	66	LA CELIA	1	170	\N	\N	1
75	66	BALBOA	1	170	\N	\N	1
212	63	CORDOBA	1	170	\N	\N	1
820	54	TOLEDO	1	170	\N	\N	1
1	63	ARMENIA	1	170	\N	\N	1
297	25	GACHETA	1	170	\N	\N	1
317	25	GUACHETA	1	170	\N	\N	1
324	25	GUATAQUI	1	170	\N	\N	1
183	25	CHOCONTA	1	170	\N	\N	1
245	25	EL COLEGIO	1	170	\N	\N	1
19	25	ALBAN	1	170	\N	\N	1
35	25	ANAPOIMA	1	170	\N	\N	1
123	25	CACHIPAY	1	170	\N	\N	1
151	25	CAQUEZA	1	170	\N	\N	1
855	23	VALENCIA	1	170	\N	\N	1
272	17	FILADELFIA	1	170	\N	\N	1
388	17	LA MERCED	1	170	\N	\N	1
200	95	MIRAFLORES	1	170	\N	\N	1
1	97	MITU	1	170	\N	\N	1
573	8	PUERTO COLOMBIA	1	170	\N	\N	1
606	8	REPELON	1	170	\N	\N	1
770	8	SUAN	1	170	\N	\N	1
832	8	TUBARA	1	170	\N	\N	1
52	13	ARJONA	1	170	\N	\N	1
670	23	SAN ANDRES SOTAVENTO	1	170	\N	\N	1
574	23	PUERTO ESCONDIDO	1	170	\N	\N	1
419	23	LOS CORDOBAS	1	170	\N	\N	1
464	23	MOMIL	1	170	\N	\N	1
182	23	CHINU	1	170	\N	\N	1
90	23	CANALETE	1	170	\N	\N	1
162	23	CERETE	1	170	\N	\N	1
787	20	TAMALAMEQUE	1	170	\N	\N	1
68	23	AYAPEL	1	170	\N	\N	1
383	20	LA GLORIA	1	170	\N	\N	1
400	20	LA JAGUA DE IBIRICO	1	170	\N	\N	1
517	20	PAILITAS	1	170	\N	\N	1
614	20	RIO DE ORO	1	170	\N	\N	1
32	20	ASTREA	1	170	\N	\N	1
45	20	BECERRIL	1	170	\N	\N	1
60	20	BOSCONIA	1	170	\N	\N	1
238	20	EL COPEY	1	170	\N	\N	1
250	20	EL PASO	1	170	\N	\N	1
295	20	GAMARRA	1	170	\N	\N	1
11	20	AGUACHICA	1	170	\N	\N	1
780	19	SUAREZ	1	170	\N	\N	1
809	19	TIMBIQUI	1	170	\N	\N	1
821	19	TORIBIO	1	170	\N	\N	1
698	19	SANTANDER DE QUILICHAO	1	170	\N	\N	1
760	19	SOTARA	1	170	\N	\N	1
227	52	CUMBAL	1	170	\N	\N	1
240	52	CHACHAGUI	1	170	\N	\N	1
79	52	BARBACOAS	1	170	\N	\N	1
19	52	ALBAN	1	170	\N	\N	1
318	50	GUAMAL	1	170	\N	\N	1
330	50	MESETAS	1	170	\N	\N	1
573	50	PUERTO LOPEZ	1	170	\N	\N	1
606	50	RESTREPO	1	170	\N	\N	1
689	50	SAN MARTIN	1	170	\N	\N	1
1	50	VILLAVICENCIO	1	170	\N	\N	1
124	50	CABUYARO	1	170	\N	\N	1
570	47	PUEBLOVIEJO	1	170	\N	\N	1
675	47	SALAMINA	1	170	\N	\N	1
703	47	SAN ZENON	1	170	\N	\N	1
541	47	PEDRAZA	1	170	\N	\N	1
58	47	ARIGUANI	1	170	\N	\N	1
170	47	CHIVOLO	1	170	\N	\N	1
189	47	CIENAGA	1	170	\N	\N	1
622	19	ROSAS	1	170	\N	\N	1
455	19	MIRANDA	1	170	\N	\N	1
418	19	LOPEZ	1	170	\N	\N	1
364	19	JAMBALO	1	170	\N	\N	1
212	19	CORINTO	1	170	\N	\N	1
765	18	SOLANO	1	170	\N	\N	1
22	19	ALMAGUER	1	170	\N	\N	1
150	18	CARTAGENA DEL CHAIRA	1	170	\N	\N	1
479	18	MORELIA	1	170	\N	\N	1
446	17	MARULANDA	1	170	\N	\N	1
486	17	NEIRA	1	170	\N	\N	1
421	8	LURUACO	1	170	\N	\N	1
433	8	MALAMBO	1	170	\N	\N	1
558	8	POLONUEVO	1	170	\N	\N	1
442	13	MARIA LA BAJA	1	170	\N	\N	1
248	13	EL GUAMO	1	170	\N	\N	1
41	76	ANSERMANUEVO	1	170	\N	\N	1
1	5	MEDELLIN	1	170	\N	\N	1
44	5	ANZA	1	170	\N	\N	1
863	76	VERSALLES	1	170	\N	\N	1
616	76	RIOFRIO	1	170	\N	\N	1
235	70	GALERAS	1	170	\N	\N	1
67	73	ATACO	1	170	\N	\N	1
885	41	YAGUARA	1	170	\N	\N	1
306	41	GIGANTE	1	170	\N	\N	1
518	54	PAMPLONA	1	170	\N	\N	1
206	54	CONVENCION	1	170	\N	\N	1
861	5	VENECIA	1	170	\N	\N	1
660	5	SAN LUIS	1	170	\N	\N	1
867	25	VIANI	1	170	\N	\N	1
754	25	SOACHA	1	170	\N	\N	1
799	25	TENJO	1	170	\N	\N	1
596	25	QUIPILE	1	170	\N	\N	1
778	15	SUTATENZA	1	170	\N	\N	1
580	15	QUIPAMA	1	170	\N	\N	1
223	15	CUBARA	1	170	\N	\N	1
1	15	TUNJA	1	170	\N	\N	1
104	15	BOYACA	1	170	\N	\N	1
147	5	CAREPA	1	170	\N	\N	1
686	68	SAN MIGUEL	1	170	\N	\N	1
152	68	CARCASI	1	170	\N	\N	1
77	68	BARBOSA	1	170	\N	\N	1
690	63	SALENTO	1	170	\N	\N	1
130	63	CALARCA	1	170	\N	\N	1
634	8	SABANAGRANDE	1	170	\N	\N	1
1	11	BOGOTA	1	170	\N	\N	1
256	52	EL ROSARIO	1	170	\N	\N	1
22	52	ALDANA	1	170	\N	\N	1
532	19	PATIA (EL BORDO)	1	170	\N	\N	1
392	19	LA SIERRA	1	170	\N	\N	1
753	18	SAN VICENTE DEL CAGUAN	1	170	\N	\N	1
873	17	VILLAMARIA	1	170	\N	\N	1
36	5	ANGELOPOLIS	1	170	\N	\N	1
51	5	ARBOLETES	1	170	\N	\N	1
760	99	SAN JOSE DE OCUNE	1	170	\N	\N	1
773	99	CUMARIBO	1	170	\N	\N	1
460	91	MIRITI-PARANA	1	170	\N	\N	1
669	91	PTO SANTANDER	1	170	\N	\N	1
886	94	CACAHUAL	1	170	\N	\N	1
887	94	PANA PANA	1	170	\N	\N	1
666	97	TARAIRA	1	170	\N	\N	1
385	54	LA ESPERANZA	1	170	\N	\N	1
458	13	MONTECRISTO	1	170	\N	\N	1
268	13	EL PENON	1	170	\N	\N	1
160	13	CANTAGALLO	1	170	\N	\N	1
300	13	HATILLO DE LOBA	1	170	\N	\N	1
655	13	SAN JACINTO DEL CAUCA	1	170	\N	\N	1
378	44	HATONUEVO	1	170	\N	\N	1
268	47	EL RETEN	1	170	\N	\N	1
545	47	PIJINO DEL CARMEN	1	170	\N	\N	1
520	73	PALOCABILDO	1	170	\N	\N	1
350	23	LA APARTADA	1	170	\N	\N	1
536	91	PUERTO ARICA	1	170	\N	\N	1
665	17	SAN JOSE	1	170	\N	\N	1
270	50	EL DORADO	1	170	\N	\N	1
888	94	CD. MORICHAL NUEVO	1	170	\N	\N	1
624	99	SANTA ROSALIA	1	170	\N	\N	1
999	47	NUEVA GRANADA	1	170	\N	\N	1
98	47	ZONA BANANERA	1	170	\N	\N	1
870	73	VILLAHERMOSA	1	170	\N	\N	1
563	73	PRADO	1	170	\N	\N	1
547	73	PIEDRAS	1	170	\N	\N	1
349	73	HONDA	1	170	\N	\N	1
226	73	CUNDAY	1	170	\N	\N	1
275	73	FLANDES	1	170	\N	\N	1
55	73	ARMERO	1	170	\N	\N	1
650	44	SAN JUAN DEL CESAR	1	170	\N	\N	1
872	41	VILLAVIEJA	1	170	\N	\N	1
319	41	GUADALUPE	1	170	\N	\N	1
530	41	PALESTINA	1	170	\N	\N	1
13	41	AGRADO	1	170	\N	\N	1
206	41	COLOMBIA	1	170	\N	\N	1
823	70	TOLUVIEJO	1	170	\N	\N	1
670	70	SAMPUES	1	170	\N	\N	1
418	70	LOS PALMITOS	1	170	\N	\N	1
372	27	JURADO	1	170	\N	\N	1
1723	2	RIO DE JANEIRO	1	172	\N	\N	1
9563	98	RIO DE JANEIRO	1	172	\N	\N	1
236	23	TUCHIN	1	170	\N	\N	1
490	13	NOROSI	1	170	\N	\N	1
300	19	GUACHENE	1	170	\N	\N	1
682	23	SAN JOSE DE URE	1	170	\N	\N	1
125	68	BERLIN	1	170	\N	\N	1
\.


--
-- TOC entry 2500 (class 0 OID 16473)
-- Dependencies: 1766
-- Data for Name: par_serv_servicios; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY par_serv_servicios (par_serv_secue, par_serv_codigo, par_serv_nombre, par_serv_estado) FROM stdin;
1	1	ACUEDUCTO	A
2	2	ALCANTARILLADO	A
3	3	ASEO	A
4	4	ENERGIA ELECTRICA	A
5	5	GAS NATURAL	A
6	6	TELEFONIA	A
7	7	GAS LICUADO DEL PETROLEO	A
8	8	SERVICIOS NO COMPETENTES 	A
9	9	CONSOLIDADO	\N
\.


--
-- TOC entry 2501 (class 0 OID 16476)
-- Dependencies: 1767
-- Data for Name: pl_generado_plg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pl_generado_plg (depe_codi, radi_nume_radi, plt_codi, plg_codi, plg_comentarios, plg_analiza, plg_firma, plg_autoriza, plg_imprime, plg_envia, plg_archivo_tmp, plg_archivo_final, plg_nombre, plg_crea, plg_autoriza_fech, plg_imprime_fech, plg_envia_fech, plg_crea_fech, plg_creador, pl_codi, usua_doc, sgd_rem_destino, radi_nume_sal) FROM stdin;
\.


--
-- TOC entry 2502 (class 0 OID 16485)
-- Dependencies: 1768
-- Data for Name: pl_tipo_plt; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pl_tipo_plt (plt_codi, plt_desc) FROM stdin;
0	Creada
1	Modificacion
2	Revision
3	Firmada
4	Imprimir
5	Enviada por Correo
6	Archivo
7	ssss
30	Devolucion Correo
20	Anulada
\.


--
-- TOC entry 2503 (class 0 OID 16488)
-- Dependencies: 1769
-- Data for Name: plan_table; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY plan_table (statement_id, "TIMESTAMP", remarks, operation, options, object_node, object_owner, object_name, object_instance, object_type, optimizer, search_columns, id, parent_id, "POSITION", cost, cardinality, bytes, other_tag, partition_start, partition_stop, partition_id, other, distribution) FROM stdin;
\.


--
-- TOC entry 2504 (class 0 OID 16494)
-- Dependencies: 1770
-- Data for Name: plantilla_pl; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY plantilla_pl (pl_codi, depe_codi, pl_nomb, pl_archivo, pl_desc, pl_fech, usua_codi, pl_uso) FROM stdin;
\.


--
-- TOC entry 2505 (class 0 OID 16498)
-- Dependencies: 1771
-- Data for Name: prestamo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY prestamo (pres_id, radi_nume_radi, usua_login_actu, depe_codi, usua_login_pres, pres_desc, pres_fech_pres, pres_fech_devo, pres_fech_pedi, pres_estado, pres_requerimiento, pres_depe_arch, pres_fech_venc, dev_desc, pres_fech_canc, usua_login_canc, usua_login_rx) FROM stdin;
\.


--
-- TOC entry 2506 (class 0 OID 16504)
-- Dependencies: 1772
-- Data for Name: radicado; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY radicado (radi_nume_radi, radi_fech_radi, tdoc_codi, trte_codi, mrec_codi, eesp_codi, eotra_codi, radi_tipo_empr, radi_fech_ofic, tdid_codi, radi_nume_iden, radi_nomb, radi_prim_apel, radi_segu_apel, radi_pais, muni_codi, cpob_codi, carp_codi, esta_codi, dpto_codi, cen_muni_codi, cen_dpto_codi, radi_dire_corr, radi_tele_cont, radi_nume_hoja, radi_desc_anex, radi_nume_deri, radi_path, radi_usua_actu, radi_depe_actu, radi_fech_asig, radi_arch1, radi_arch2, radi_arch3, radi_arch4, ra_asun, radi_usu_ante, radi_depe_radi, radi_rem, radi_usua_radi, codi_nivel, flag_nivel, carp_per, radi_leido, radi_cuentai, radi_tipo_deri, listo, sgd_tma_codigo, sgd_mtd_codigo, par_serv_secue, sgd_fld_codigo, radi_agend, radi_fech_agend, radi_fech_doc, sgd_doc_secuencia, sgd_pnufe_codi, sgd_eanu_codigo, sgd_not_codi, radi_fech_notif, sgd_tdec_codigo, sgd_apli_codi, sgd_ttr_codigo, usua_doc_ante, radi_fech_antetx, sgd_trad_codigo, fech_vcmto, tdoc_vcmto, sgd_termino_real, id_cont, sgd_spub_codigo, id_pais, radi_nrr, medio_m) FROM stdin;
20089000000011	2008-08-20 10:59:28.016597	0	0	7	0	\N	\N	2008-08-20 00:00:00	0	\N	\N	\N	\N	170	\N	\N	1	\N	\N	\N	\N	\N	\N	\N		\N	\N	1	900	\N	\N	\N	\N	\N	Acta de inicio contrato	\N	900	\N	1	5	\N	0	1		1	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	1	0	\N	0	\N
20089000000013	2008-08-20 11:38:18.83942	0	0	7	0	\N	\N	2008-08-20 00:00:00	0	\N	\N	\N	\N	170	\N	\N	3	\N	\N	\N	\N	\N	\N	\N		\N	\N	1	900	\N	\N	\N	\N	\N	\t\t	\N	900	\N	1	5	\N	0	0		1	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	1	0	\N	0	\N
20089000000021	2008-08-20 12:12:40.820727	0	0	7	0	\N	\N	2008-08-20 00:00:00	0	\N	\N	\N	\N	170	\N	\N	1	\N	\N	\N	\N	\N	\N	\N		\N	/2008/900/docs/120089000000021_00001.zip	1	900	\N	\N	\N	\N	\N	Prueba envÃ­o internacional	\N	900	\N	1	5	\N	0	1		1	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	1	0	\N	0	\N
20089000000012	2008-08-13 11:24:30.726291	0	0	1	0	\N	\N	2008-08-13 00:00:00	0	\N	\N	\N	\N	170	\N	\N	0	\N	\N	\N	\N	\N	\N	\N		\N	\N	1	900	\N	\N	\N	\N	\N		ADMON	900	\N	2	5	\N	0	1		1	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	1	0	\N	0	\N
20089000000022	2008-08-20 10:55:17.909779	0	0	7	0	\N	\N	2008-08-20 00:00:00	0	\N	\N	\N	\N	170	\N	\N	0	\N	\N	\N	\N	\N	\N	\N		\N	\N	1	900	\N	\N	\N	\N	\N	Cuenta de Cobro	\N	900	\N	1	5	\N	0	1		1	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	1	0	\N	0	\N
\.


--
-- TOC entry 2507 (class 0 OID 16518)
-- Dependencies: 1773
-- Data for Name: retencion_doc_tmp; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY retencion_doc_tmp (cod_serie, serie, tipologia_doc, cod_subserie, subserie, tipologia_sub, dependencia, nom_depe, archivo_gestion, archivo_central, disposicion, soporte, procedimiento, tipo_doc, error) FROM stdin;
\.


--
-- TOC entry 2508 (class 0 OID 16534)
-- Dependencies: 1779
-- Data for Name: series; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY series (depe_codi, seri_nume, seri_tipo, seri_ano, dpto_codi, bloq) FROM stdin;
\.


--
-- TOC entry 2509 (class 0 OID 16537)
-- Dependencies: 1780
-- Data for Name: sgd_acm_acusemsg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_acm_acusemsg (sgd_msg_codi, usua_doc, sgd_msg_leido) FROM stdin;
\.


--
-- TOC entry 2510 (class 0 OID 16540)
-- Dependencies: 1781
-- Data for Name: sgd_actadd_actualiadicional; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_actadd_actualiadicional (sgd_actadd_codi, sgd_apli_codi, sgd_instorf_codi, sgd_actadd_query, sgd_actadd_desc) FROM stdin;
3	1	5	insert into hist_eventos (depe_codi,hist_fech,usua_codi,radi_nume_radi,hist_obse,usua_codi_dest,usua_doc,SGD_TTR_CODIGO) values (P_DEPENDENCIA,sysdate,P_USUA_CODI,P_RAD_E,'Tipificacion de la decision a Sancionar Ingresado' ,P_USUA_CODI,P_USUA_DOC,35)	\N
2	1	5	update radicado set SGD_TDEC_CODIGO=20 where  RADI_NUME_RADI= P_RAD_E	\N
1	1	10	update SGD_APLMEN_APLIMENS set  SGD_APLMEN_DESDEORFEO = 5 where SGD_APLMEN_REF = 'P_RAD_E'	\N
4	1	5	update SGD_APLMEN_APLIMENS set SGD_APLMEN_REF = P_RAD_E, SGD_APLMEN_DESDEORFEO=1 where SGD_APLMEN_REF = 'P_COD_REF'	\N
5	1	10	update SGD_APLMEN_APLIMENS set  SGD_APLMEN_HACIAORFEO = 5 where SGD_APLMEN_REF = 'P_RAD_E'	\N
6	1	11	update SGD_APLMEN_APLIMENS set  SGD_APLMEN_DESDEORFEO = 2  where SGD_APLMEN_REF = 'P_RAD_E'	\N
\.


--
-- TOC entry 2511 (class 0 OID 16546)
-- Dependencies: 1782
-- Data for Name: sgd_agen_agendados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_agen_agendados (sgd_agen_fech, sgd_agen_observacion, radi_nume_radi, usua_doc, depe_codi, sgd_agen_codigo, sgd_agen_fechplazo, sgd_agen_activo) FROM stdin;
\.


--
-- TOC entry 2512 (class 0 OID 16552)
-- Dependencies: 1783
-- Data for Name: sgd_anar_anexarg; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_anar_anexarg (sgd_anar_codi, anex_codigo, sgd_argd_codi, sgd_anar_argcod) FROM stdin;
\.


--
-- TOC entry 2513 (class 0 OID 16555)
-- Dependencies: 1784
-- Data for Name: sgd_anu_anulados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_anu_anulados (sgd_anu_id, sgd_anu_desc, radi_nume_radi, sgd_eanu_codi, sgd_anu_sol_fech, sgd_anu_fech, depe_codi, usua_doc, usua_codi, depe_codi_anu, usua_doc_anu, usua_codi_anu, usua_anu_acta, sgd_anu_path_acta, sgd_trad_codigo) FROM stdin;
\.


--
-- TOC entry 2514 (class 0 OID 16561)
-- Dependencies: 1785
-- Data for Name: sgd_aper_adminperfiles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_aper_adminperfiles (sgd_aper_codigo, sgd_aper_descripcion) FROM stdin;
\.


--
-- TOC entry 2515 (class 0 OID 16564)
-- Dependencies: 1786
-- Data for Name: sgd_aplfad_plicfunadi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_aplfad_plicfunadi (sgd_aplfad_codi, sgd_apli_codi, sgd_aplfad_menu, sgd_aplfad_lk1, sgd_aplfad_desc) FROM stdin;
\.


--
-- TOC entry 2516 (class 0 OID 16567)
-- Dependencies: 1787
-- Data for Name: sgd_apli_aplintegra; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_apli_aplintegra (sgd_apli_codi, sgd_apli_descrip, sgd_apli_lk1desc, sgd_apli_lk1, sgd_apli_lk2desc, sgd_apli_lk2, sgd_apli_lk3desc, sgd_apli_lk3, sgd_apli_lk4desc, sgd_apli_lk4) FROM stdin;
\.


--
-- TOC entry 2517 (class 0 OID 16573)
-- Dependencies: 1788
-- Data for Name: sgd_aplmen_aplimens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_aplmen_aplimens (sgd_aplmen_codi, sgd_apli_codi, sgd_aplmen_ref, sgd_aplmen_haciaorfeo, sgd_aplmen_desdeorfeo) FROM stdin;
\.


--
-- TOC entry 2518 (class 0 OID 16576)
-- Dependencies: 1789
-- Data for Name: sgd_aplus_plicusua; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_aplus_plicusua (sgd_aplus_codi, sgd_apli_codi, usua_doc, sgd_trad_codigo, sgd_aplus_prioridad) FROM stdin;
\.


--
-- TOC entry 2519 (class 0 OID 16579)
-- Dependencies: 1790
-- Data for Name: sgd_arg_pliego; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_arg_pliego (sgd_arg_codigo, sgd_arg_desc) FROM stdin;
\.


--
-- TOC entry 2520 (class 0 OID 16582)
-- Dependencies: 1791
-- Data for Name: sgd_argd_argdoc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_argd_argdoc (sgd_argd_codi, sgd_pnufe_codi, sgd_argd_tabla, sgd_argd_tcodi, sgd_argd_tdes, sgd_argd_llist, sgd_argd_campo) FROM stdin;
2	2	sgd_tid_tipdecision	sgd_tid_codi	sgd_tid_desc	Seleccione la desicion	DECISION
3	3	sgd_tid_tipdecision	sgd_tid_codi	sgd_tid_desc	Seleccione la desicion	DECISION
4	4	sgd_tid_tipdecision	sgd_tid_codi	sgd_tid_desc	Seleccione la desicion	DECISION
5	5	sgd_argup_argudoctop	sgd_argup_codi	sgd_argup_desc	Seleccione el argumento	ARGUMENTO
6	5	sgd_sed_sede	sgd_sed_codI	sgd_sed_desc	Seleccione la sede	SEDE
7	6	sgd_tid_tipdecision	sgd_tid_codi	sgd_tid_desc	Seleccione la desicion	DECISION
1	1	sgd_tid_tipdecision	sgd_tid_codi	sgd_tid_desc	Seleccione la desicion	DECISION
\.


--
-- TOC entry 2521 (class 0 OID 16588)
-- Dependencies: 1792
-- Data for Name: sgd_argup_argudoctop; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_argup_argudoctop (sgd_argup_codi, sgd_argup_desc, sgd_tpr_codigo) FROM stdin;
2	Sin respuesta	34
1	Omitir respuesta de fondo\r	34
3	Respuesta extemporanea\r	34
\.


--
-- TOC entry 2522 (class 0 OID 16591)
-- Dependencies: 1793
-- Data for Name: sgd_camexp_campoexpediente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_camexp_campoexpediente (sgd_camexp_codigo, sgd_camexp_campo, sgd_parexp_codigo, sgd_camexp_fk, sgd_camexp_tablafk, sgd_camexp_campofk, sgd_camexp_campovalor, sgd_campexp_orden) FROM stdin;
1	IDENTIFICADOR_EMPRESA	1	0	\N	\N	\N	1
4	NOMBRE_DE_LA_EMPRESA	2	0	\N	\N	\N	2
5	NOMBRE_DE_LA_EMPRESA	3	0	\N	\N	\N	2
6	nit_de_la_empresa	3	0	\N	\N	\N	1
8	dpto_nomb	4	0	\N	\N	\N	1
9	dpto_codi	4	0	\N	\N	\N	2
7	NOMBRE_DE_LA_EMPRESA	5	0	\N	\N	\N	1
10	IDENTIFICADOR_EMPRESA	6	0	\N	\N	\N	1
11	NOMBRE_DE_LA_EMPRESA	6	0	\N	\N	\N	2
2	NOMBRE_DE_LA_EMPRESA	1	0	\N	\N	\N	2
3	IDENTIFICADOR_EMPRESA	2	0	\N	\N	\N	1
\.


--
-- TOC entry 2523 (class 0 OID 16598)
-- Dependencies: 1794
-- Data for Name: sgd_carp_descripcion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_carp_descripcion (sgd_carp_depecodi, sgd_carp_tiporad, sgd_carp_descr) FROM stdin;
\.


--
-- TOC entry 2524 (class 0 OID 16601)
-- Dependencies: 1795
-- Data for Name: sgd_cau_causal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_cau_causal (sgd_cau_codigo, sgd_cau_descrip) FROM stdin;
1	Facturacion
2	Instalacion
3	Prestacion
0	---
\.


--
-- TOC entry 2525 (class 0 OID 16604)
-- Dependencies: 1796
-- Data for Name: sgd_caux_causales; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_caux_causales (sgd_caux_codigo, radi_nume_radi, sgd_dcau_codigo, sgd_ddca_codigo, sgd_caux_fecha, usua_doc) FROM stdin;
\.


--
-- TOC entry 2526 (class 0 OID 16607)
-- Dependencies: 1797
-- Data for Name: sgd_ciu_ciudadano; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_ciu_ciudadano (tdid_codi, sgd_ciu_codigo, sgd_ciu_nombre, sgd_ciu_direccion, sgd_ciu_apell1, sgd_ciu_apell2, sgd_ciu_telefono, sgd_ciu_email, muni_codi, dpto_codi, sgd_ciu_cedula, id_cont, id_pais) FROM stdin;
2	2	denis 	12345 	lopez 	 	2164 	a@a.com	1	11	1233	1	170
2	3	ZacarÃ­as	Sunset Boulevard	Piedras 	Del RÃ­o	5555555	notengo@mail.com	94	18	11223344	1	170
2	4	Emma	CALLE 26 NO 15-65	Madera	De Gallo	66666666	mami@mail.net	420	44	22334455	1	170
\.


--
-- TOC entry 2527 (class 0 OID 16615)
-- Dependencies: 1798
-- Data for Name: sgd_clta_clstarif; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_clta_clstarif (sgd_fenv_codigo, sgd_clta_codser, sgd_tar_codigo, sgd_clta_descrip, sgd_clta_pesdes, sgd_clta_peshast) FROM stdin;
\.


--
-- TOC entry 2528 (class 0 OID 16618)
-- Dependencies: 1799
-- Data for Name: sgd_cob_campobliga; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) FROM stdin;
1	NOMBRE	NOMBRE	2
2	DIRECCION	DIR	2
3	MUNICIPIO	MUNI_NOMBRE	2
4	DEPARTAMENTO	DEPTO_NOMBRE	2
5	TIPO	TIPO	2
6	PAIS	PAIS_NOMBRE	2
\.


--
-- TOC entry 2529 (class 0 OID 16621)
-- Dependencies: 1800
-- Data for Name: sgd_dcau_causal; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_dcau_causal (sgd_dcau_codigo, sgd_cau_codigo, sgd_dcau_descrip) FROM stdin;
2	1	Cobro desconocido
3	1	Cobro sin prestacion
4	1	Cobros inoportunos
5	1	Cobros por cruce o fuga
6	1	Desviacion significativa
7	1	Direccion Incorrecta
8	1	Doble cobro
9	1	Estrato incorrecto
10	1	Fraude
11	1	Lectura incorrecta
12	1	Llamadas a celulares
13	1	Llamadas a lineas comerciales
14	1	Llamadas Larga Distancia
15	1	Mala financiacion
16	1	No envio de factura
17	1	Pago no reportado
18	1	Predio desocupado
19	1	Solidaridad
1	1	Clase de uso incorrecto
20	1	Tarifa incorrecta
21	2	Direccion Incorrecta
22	2	Fallas en la instalacion
23	2	Instalacion no solicitada
24	2	Pago sin instalacion
25	3	Sin servicio
26	3	Cruce o fuga
27	3	Sin continuidad
28	3	Interferencia
29	3	No reconectado
30	3	Suspension ilegal
31	3	Traslado
32	3	Cambio de numero
33	3	Desprogramacion de discados
34	3	Telefonos publicos
35	3	Suspension temporal
36	3	Servicio no solicitado
37	3	No es competencia
38	3	Cambio de medidor
39	3	Solicitud de retiro
0	0	---
40	1	Cobro de consumos dejados de facuturar
41	1	Cobros por promedio
42	1	Planes Tarifarios
43	1	Ciclo I
44	1	Cobro por revision
45	1	Unidad Habitacional
\.


--
-- TOC entry 2530 (class 0 OID 16624)
-- Dependencies: 1801
-- Data for Name: sgd_ddca_ddsgrgdo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_ddca_ddsgrgdo (sgd_ddca_codigo, sgd_dcau_codigo, par_serv_secue, sgd_ddca_descrip) FROM stdin;
\.


--
-- TOC entry 2531 (class 0 OID 16627)
-- Dependencies: 1802
-- Data for Name: sgd_def_contactos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_def_contactos (ctt_id, ctt_nombre, ctt_cargo, ctt_telefono, ctt_id_tipo, ctt_id_empresa) FROM stdin;
\.


--
-- TOC entry 2532 (class 0 OID 16630)
-- Dependencies: 1803
-- Data for Name: sgd_def_continentes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_def_continentes (id_cont, nombre_cont) FROM stdin;
1	America
\.


--
-- TOC entry 2533 (class 0 OID 16633)
-- Dependencies: 1804
-- Data for Name: sgd_def_paises; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_def_paises (id_pais, id_cont, nombre_pais) FROM stdin;
171	1	PERU
173	1	BOLIVIA
170	1	COLOMBIA
172	1	BRASIL
300	1	MEXICO
200	1	USA
\.


--
-- TOC entry 2534 (class 0 OID 16637)
-- Dependencies: 1805
-- Data for Name: sgd_deve_dev_envio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) FROM stdin;
1	CASA DESOCUPADA
2	CAMBIO DE DOMICILIO
99	SOBREPASO TIEMPO DE ESPERA
3	CERRADO
4	DESCONOCIDO
5	DEVUELTO DE PORTERIA
6	DIRECCION DEFICIENTE
7	FALLECIDO
8	NO EXISTE NUMERO
9	NO RESIDE
10	NO RECLAMADO
11	REHUSADO
12	SE TRASLADO
13	NO EXISTE EMPRESA
14	ZONA DE ALTO RIESGO
15	SOBRE DESOCUPADO
16	FUERA PERIMETRO URBANO
17	ENVIADO A ADPOSTAL, CONTROL DE CALIDAD
18	SIN SELLO
90	DOCUMENTO MAL RADICADO
\.


--
-- TOC entry 2535 (class 0 OID 16640)
-- Dependencies: 1806
-- Data for Name: sgd_dir_drecciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_dir_drecciones (sgd_dir_codigo, sgd_dir_tipo, sgd_oem_codigo, sgd_ciu_codigo, radi_nume_radi, sgd_esp_codi, muni_codi, dpto_codi, sgd_dir_direccion, sgd_dir_telefono, sgd_dir_mail, sgd_sec_codigo, sgd_temporal_nombre, anex_codigo, sgd_anex_codigo, sgd_dir_nombre, sgd_doc_fun, sgd_dir_nomremdes, sgd_trd_codigo, sgd_dir_tdoc, sgd_dir_doc, id_pais, id_cont) FROM stdin;
1	1	0	2	20089000000012	0	1	11	12345  	2164	a@a.com 	0	\N	\N	\N		0	denis lopez 	1	\N	1233	170	1
2	2	0	2	20089000000012	0	1	11	12345	2164	a@a.com 	0	\N	\N	\N		0	denis lopez 	1	\N	1233	170	1
3	1	0	4	20089000000022	0	420	44	CALLE 26 NO 15-65 	66666666	mami@mail.net 	0	\N	\N	\N		0	Emma Madera De Gallo	1	\N	22334455	170	1
4	1	0	3	20089000000011	0	94	18	Sunset Boulevard 	5555555	notengo@mail.com 	0	\N	\N	\N		0	ZacarÃ­as Piedras Del RÃ­o	1	\N	11223344	170	1
5	1	0	4	20089000000013	0	420	44	CALLE 26 NO 15-65 	66666666	mami@mail.net 	0	\N	\N	\N		0	Emma Madera De Gallo	1	\N	22334455	170	1
7	1	0	3	20089000000021	0	94	18	Sunset Boulevard	5555555	notengo@mail.com	0	\N	\N	\N		0	ZacarÃ­as   Piedras Del RÃ­o	1	\N	11223344	170	1
\.

--Requerido para radicar documentos
INSERT INTO SGD_DIR_DRECCIONES (SGD_DIR_CODIGO, SGD_DIR_TIPO) values(0, 0);

--
-- TOC entry 2536 (class 0 OID 16648)
-- Dependencies: 1807
-- Data for Name: sgd_dnufe_docnufe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_dnufe_docnufe (sgd_dnufe_codi, sgd_pnufe_codi, sgd_tpr_codigo, sgd_dnufe_label, trte_codi, sgd_dnufe_main, sgd_dnufe_path, sgd_dnufe_gerarq, anex_tipo_codi) FROM stdin;
\.


--
-- TOC entry 2537 (class 0 OID 16651)
-- Dependencies: 1808
-- Data for Name: sgd_eanu_estanulacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_eanu_estanulacion (sgd_eanu_desc, sgd_eanu_codi) FROM stdin;
RADICADO EN SOLICITUD DE ANULACION	1
RADICADO ANULADO	2
RADICADO EN SOLICITUD DE REVIVIR	3
RADICADO IMPOSIBLE DE ANULAR	9
\.


--
-- TOC entry 2538 (class 0 OID 16657)
-- Dependencies: 1809
-- Data for Name: sgd_einv_inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_einv_inventario (sgd_einv_codigo, sgd_depe_nomb, sgd_depe_codi, sgd_einv_expnum, sgd_einv_titulo, sgd_einv_unidad, sgd_einv_fech, sgd_einv_fechfin, sgd_einv_radicados, sgd_einv_folios, sgd_einv_nundocu, sgd_einv_nundocubodega, sgd_einv_caja, sgd_einv_cajabodega, sgd_einv_srd, sgd_einv_nomsrd, sgd_einv_sbrd, sgd_einv_nomsbrd, sgd_einv_retencion, sgd_einv_disfinal, sgd_einv_ubicacion, sgd_einv_observacion) FROM stdin;
\.


--
-- TOC entry 2539 (class 0 OID 16663)
-- Dependencies: 1810
-- Data for Name: sgd_eit_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_eit_items (sgd_eit_codigo, sgd_eit_cod_padre, sgd_eit_nombre, sgd_eit_sigla, codi_dpto, codi_muni) FROM stdin;
\.


--
-- TOC entry 2540 (class 0 OID 16670)
-- Dependencies: 1811
-- Data for Name: sgd_ent_entidades; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_ent_entidades (sgd_ent_nit, sgd_ent_codsuc, sgd_ent_pias, dpto_codi, muni_codi, sgd_ent_descrip, sgd_ent_direccion, sgd_ent_telefono) FROM stdin;
\.


--
-- TOC entry 2541 (class 0 OID 16673)
-- Dependencies: 1812
-- Data for Name: sgd_enve_envioespecial; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_enve_envioespecial (sgd_fenv_codigo, sgd_enve_valorl, sgd_enve_valorn, sgd_enve_desc) FROM stdin;
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
109	1400	3500	Valor Descuento Automatico
109	160	160	Valor Alistamiento
109	1400	3500	Valor Certificado Acuse de Rec
\.


--
-- TOC entry 2542 (class 0 OID 16676)
-- Dependencies: 1813
-- Data for Name: sgd_estc_estconsolid; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_estc_estconsolid (sgd_estc_codigo, sgd_tpr_codigo, dep_nombre, depe_codi, sgd_estc_ctotal, sgd_estc_centramite, sgd_estc_csinriesgo, sgd_estc_criesgomedio, sgd_estc_criesgoalto, sgd_estc_ctramitados, sgd_estc_centermino, sgd_estc_cfueratermino, sgd_estc_fechgen, sgd_estc_fechini, sgd_estc_fechfin, sgd_estc_fechiniresp, sgd_estc_fechfinresp, sgd_estc_dsinriesgo, sgd_estc_driesgomegio, sgd_estc_driesgoalto, sgd_estc_dtermino, sgd_estc_grupgenerado) FROM stdin;
\.


--
-- TOC entry 2543 (class 0 OID 16682)
-- Dependencies: 1814
-- Data for Name: sgd_estinst_estadoinstancia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_estinst_estadoinstancia (sgd_estinst_codi, sgd_apli_codi, sgd_instorf_codi, sgd_estinst_valor, sgd_estinst_habilita, sgd_estinst_mensaje) FROM stdin;
\.


--
-- TOC entry 2544 (class 0 OID 16685)
-- Dependencies: 1815
-- Data for Name: sgd_exp_expediente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_exp_expediente (sgd_exp_numero, radi_nume_radi, sgd_exp_fech, sgd_exp_fech_mod, depe_codi, usua_codi, usua_doc, sgd_exp_estado, sgd_exp_titulo, sgd_exp_asunto, sgd_exp_carpeta, sgd_exp_ufisica, sgd_exp_isla, sgd_exp_estante, sgd_exp_caja, sgd_exp_fech_arch, sgd_srd_codigo, sgd_sbrd_codigo, sgd_fexp_codigo, sgd_exp_subexpediente, sgd_exp_archivo, sgd_exp_unicon, sgd_exp_fechfin, sgd_exp_folios, sgd_exp_rete, sgd_exp_entrepa, radi_usua_arch, sgd_exp_edificio, sgd_exp_caja_bodega, sgd_exp_carro, sgd_exp_carpeta_bodega, sgd_exp_privado, sgd_exp_cd, sgd_exp_nref, sgd_exp_fechafin) FROM stdin;
2008900999900002E	20089000000022	2008-08-20 00:00:00	\N	900	1	900102030	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2008-08-20 00:00:00
2008900999900003E	20089000000022	2008-08-20 00:00:00	\N	900	1	900102030	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2008-08-20 00:00:00
\.


--
-- TOC entry 2545 (class 0 OID 16693)
-- Dependencies: 1816
-- Data for Name: sgd_fars_faristas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_fars_faristas (sgd_fars_codigo, sgd_pexp_codigo, sgd_fexp_codigoini, sgd_fexp_codigofin, sgd_fars_diasminimo, sgd_fars_diasmaximo, sgd_fars_desc, sgd_trad_codigo, sgd_srd_codigo, sgd_sbrd_codigo, sgd_fars_tipificacion, sgd_tpr_codigo, sgd_fars_automatico, sgd_fars_rolgeneral) FROM stdin;
\.


--
-- TOC entry 2546 (class 0 OID 16699)
-- Dependencies: 1817
-- Data for Name: sgd_fenv_frmenvio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_estado, sgd_fenv_planilla) FROM stdin;
101	CERTIFICADO	1	0
102	SERVIENTREGA	1	0
103	ENTREGA PERSONAL	1	0
104	FAX	1	0
105	POSTEXPRESS	1	0
106	CORREO ELECTRONICO	1	0
107	CORRA	1	0
108	NORMAL	1	0
109	CERTIFICADO CON ACUSE 	1	0
901	NO ENVIADO	1	0
902	SOPORTE DIGITALIZADO	1	0
110	INTER RAPIDISIMO	1	0
\.


--
-- TOC entry 2547 (class 0 OID 16704)
-- Dependencies: 1818
-- Data for Name: sgd_fexp_flujoexpedientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_fexp_flujoexpedientes (sgd_fexp_codigo, sgd_pexp_codigo, sgd_fexp_orden, sgd_fexp_terminos, sgd_fexp_imagen, sgd_fexp_descrip) FROM stdin;
\.


--
-- TOC entry 2548 (class 0 OID 16707)
-- Dependencies: 1819
-- Data for Name: sgd_firrad_firmarads; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_firrad_firmarads (sgd_firrad_id, radi_nume_radi, usua_doc, sgd_firrad_firma, sgd_firrad_fecha, sgd_firrad_docsolic, sgd_firrad_fechsolic, sgd_firrad_pk) FROM stdin;
\.


--
-- TOC entry 2549 (class 0 OID 16713)
-- Dependencies: 1820
-- Data for Name: sgd_fld_flujodoc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_fld_flujodoc (sgd_fld_codigo, sgd_fld_desc, sgd_tpr_codigo, sgd_fld_imagen, sgd_fld_grupoweb) FROM stdin;
\.


--
-- TOC entry 2550 (class 0 OID 16719)
-- Dependencies: 1821
-- Data for Name: sgd_fun_funciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_fun_funciones (sgd_fun_codigo, sgd_fun_descrip, sgd_fun_fech_ini, sgd_fun_fech_fin) FROM stdin;
\.


--
-- TOC entry 2551 (class 0 OID 16725)
-- Dependencies: 1822
-- Data for Name: sgd_hfld_histflujodoc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_hfld_histflujodoc (sgd_hfld_codigo, sgd_fexp_codigo, sgd_exp_fechflujoant, sgd_hfld_fech, sgd_exp_numero, radi_nume_radi, usua_doc, usua_codi, depe_codi, sgd_ttr_codigo, sgd_fexp_observa, sgd_hfld_observa, sgd_fars_codigo, sgd_hfld_automatico) FROM stdin;
\.


--
-- TOC entry 2552 (class 0 OID 16731)
-- Dependencies: 1823
-- Data for Name: sgd_hmtd_hismatdoc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_hmtd_hismatdoc (sgd_hmtd_codigo, sgd_hmtd_fecha, radi_nume_radi, usua_codi, sgd_hmtd_obse, usua_doc, depe_codi, sgd_mtd_codigo) FROM stdin;
\.


--
-- TOC entry 2553 (class 0 OID 16737)
-- Dependencies: 1824
-- Data for Name: sgd_instorf_instanciasorfeo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_instorf_instanciasorfeo (sgd_instorf_codi, sgd_instorf_desc) FROM stdin;
1	Radicacion
2	Informacion General
3	Documentos anexados
4	Transacciones Basicas
10	Envios
5	Radicacion de Documentos Anexados
11	Anulacion
\.


--
-- TOC entry 2554 (class 0 OID 16740)
-- Dependencies: 1825
-- Data for Name: sgd_lip_linkip; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_lip_linkip (sgd_lip_id, sgd_lip_ipini, sgd_lip_ipfin, sgd_lip_dirintranet, depe_codi, sgd_lip_arch, sgd_lip_diascache, sgd_lip_rutaftp, sgd_lip_servftp, sgd_lip_usbd, sgd_lip_nombd, sgd_lip_pwdbd, sgd_lip_usftp, sgd_lip_pwdftp) FROM stdin;
\.


--
-- TOC entry 2555 (class 0 OID 16746)
-- Dependencies: 1826
-- Data for Name: sgd_masiva_excel; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_masiva_excel (sgd_masiva_dependencia, sgd_masiva_usuario, sgd_masiva_tiporadicacion, sgd_masiva_codigo, sgd_masiva_radicada, sgd_masiva_intervalo, sgd_masiva_rangoini, sgd_masiva_rangofin) FROM stdin;
\.


--
-- TOC entry 2556 (class 0 OID 16749)
-- Dependencies: 1827
-- Data for Name: sgd_mat_matriz; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_mat_matriz (sgd_mat_codigo, depe_codi, sgd_fun_codigo, sgd_prc_codigo, sgd_prd_codigo, sgd_mat_fech_ini, sgd_mat_fech_fin, sgd_mat_peso_prd) FROM stdin;
\.


--
-- TOC entry 2557 (class 0 OID 16752)
-- Dependencies: 1828
-- Data for Name: sgd_mpes_mddpeso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_mpes_mddpeso (sgd_mpes_codigo, sgd_mpes_descrip) FROM stdin;
1	Arrobas
2	Kilos
3	Gramos
4	Toneladas
5	Libras
\.


--
-- TOC entry 2558 (class 0 OID 16755)
-- Dependencies: 1829
-- Data for Name: sgd_mrd_matrird; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_mrd_matrird (sgd_mrd_codigo, depe_codi, sgd_srd_codigo, sgd_sbrd_codigo, sgd_tpr_codigo, soporte, sgd_mrd_fechini, sgd_mrd_fechfin, sgd_mrd_esta) FROM stdin;
1	900	99	99	1	1	2008-08-19 00:00:00	\N	1
\.


--
-- TOC entry 2559 (class 0 OID 16758)
-- Dependencies: 1830
-- Data for Name: sgd_msdep_msgdep; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_msdep_msgdep (sgd_msdep_codi, depe_codi, sgd_msg_codi) FROM stdin;
\.


--
-- TOC entry 2560 (class 0 OID 16761)
-- Dependencies: 1831
-- Data for Name: sgd_msg_mensaje; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_msg_mensaje (sgd_msg_codi, sgd_tme_codi, sgd_msg_desc, sgd_msg_fechdesp, sgd_msg_url, sgd_msg_veces, sgd_msg_ancho, sgd_msg_largo) FROM stdin;
\.


--
-- TOC entry 2561 (class 0 OID 16764)
-- Dependencies: 1832
-- Data for Name: sgd_mtd_matriz_doc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_mtd_matriz_doc (sgd_mtd_codigo, sgd_mat_codigo, sgd_tpr_codigo) FROM stdin;
\.


--
-- TOC entry 2562 (class 0 OID 16767)
-- Dependencies: 1833
-- Data for Name: sgd_nfn_notifijacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_nfn_notifijacion (radi_nume_radi, sgd_tdf_codigo, sgd_nfn_fechnotusu, sgd_nfn_fechnotemp, sgd_nfn_fechfiusu, sgd_nfn_fechfiemp, sgd_nfn_fechdesfiusu, sgd_nfn_fechdesfiemp, sgd_nfn_sspdapela) FROM stdin;
\.


--
-- TOC entry 2563 (class 0 OID 16773)
-- Dependencies: 1834
-- Data for Name: sgd_noh_nohabiles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_noh_nohabiles (noh_fecha) FROM stdin;
\.

DELETE FROM SGD_NOH_NOHABILES;
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-01-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-01-07');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-03-20');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-03-21');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-05-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-05-26');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-06-02');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-06-30');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-08-07');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-08-18');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-10-13');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-11-17');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-12-08');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2008-12-25');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-01-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-01-12');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-03-23');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-04-09');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-04-10');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-05-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-05-25');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-06-15');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-06-22');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-06-29');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-07-20');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-08-07');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-08-17');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-10-12');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-11-02');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-11-16');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-12-08');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2009-12-25');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-01-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-01-11');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-03-22');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-04-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-04-02');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-05-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-05-17');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-06-07');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-06-14');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-07-05');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-07-20');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-08-07');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-08-16');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-10-18');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-11-01');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-11-15');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-12-08');
INSERT INTO SGD_NOH_NOHABILES (NOH_FECHA) values ('2010-12-25');

--
-- TOC entry 2564 (class 0 OID 16776)
-- Dependencies: 1835
-- Data for Name: sgd_not_notificacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_not_notificacion (sgd_not_codi, sgd_not_descrip) FROM stdin;
4	CONDUCTA CONCLUYENTE
1	PERSONAL
3	EDICTO
\.


--
-- TOC entry 2565 (class 0 OID 16779)
-- Dependencies: 1836
-- Data for Name: sgd_ntrd_notifrad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_ntrd_notifrad (radi_nume_radi, sgd_not_codi, sgd_ntrd_notificador, sgd_ntrd_notificado, sgd_ntrd_fecha_not, sgd_ntrd_num_edicto, sgd_ntrd_fecha_fija, sgd_ntrd_fecha_desfija, sgd_ntrd_observaciones) FROM stdin;
\.


--
-- TOC entry 2566 (class 0 OID 16782)
-- Dependencies: 1837
-- Data for Name: sgd_oem_oempresas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_oem_oempresas (sgd_oem_codigo, tdid_codi, sgd_oem_oempresa, sgd_oem_rep_legal, sgd_oem_nit, sgd_oem_sigla, muni_codi, dpto_codi, sgd_oem_direccion, sgd_oem_telefono, id_cont, id_pais) FROM stdin;
\.


--
-- TOC entry 2567 (class 0 OID 16790)
-- Dependencies: 1838
-- Data for Name: sgd_panu_peranulados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_panu_peranulados (sgd_panu_codi, sgd_panu_desc) FROM stdin;
1	PERMISO DE SOLICITUD DE ANULACION 
2	PERMISO ANULACION 
3	PERMISO SOLICITUD Y ANULACION 
\.


--
-- TOC entry 2568 (class 0 OID 16793)
-- Dependencies: 1839
-- Data for Name: sgd_parametro; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_parametro (param_nomb, param_codi, param_valor) FROM stdin;
PRESTAMO_ESTADO	5	Prestamo Indefinido
PRESTAMO_REQUERIMIENTO	1	Documento
PRESTAMO_REQUERIMIENTO	2	Anexo
PRESTAMO_REQUERIMIENTO	3	Documento y Anexo
PRESTAMO_DIAS_PREST	1	8
PRESTAMO_DIAS_CANC	1	2
PRESTAMO_PASW	1	1
PRESTAMO_ESTADO	4	Cancelado
PRESTAMO_ESTADO	3	Devuelto
PRESTAMO_ESTADO	2	Prestado
PRESTAMO_ESTADO	1	Solicitado
\.


--
-- TOC entry 2569 (class 0 OID 16796)
-- Dependencies: 1840
-- Data for Name: sgd_parexp_paramexpediente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_parexp_paramexpediente (sgd_parexp_codigo, depe_codi, sgd_parexp_tabla, sgd_parexp_etiqueta, sgd_parexp_orden) FROM stdin;
\.


--
-- TOC entry 2570 (class 0 OID 16799)
-- Dependencies: 1841
-- Data for Name: sgd_pexp_procexpedientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_pexp_procexpedientes (sgd_pexp_codigo, sgd_pexp_descrip, sgd_pexp_terminos, sgd_srd_codigo, sgd_sbrd_codigo, sgd_pexp_automatico, sgd_pexp_tieneflujo) FROM stdin;
0	Sin Proceso	0	\N	\N	1	\N
\.


--
-- TOC entry 2571 (class 0 OID 16807)
-- Dependencies: 1842
-- Data for Name: sgd_pnufe_procnumfe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_pnufe_procnumfe (sgd_pnufe_codi, sgd_tpr_codigo, sgd_pnufe_descrip, sgd_pnufe_serie) FROM stdin;
1	29	Resolucion - RAP (Combo)	\N
2	31	Resolucion - REP (Combo)	\N
3	32	Resolucion - REQ (Combo)	\N
4	33	Resolucion - REV (Combo)	\N
5	34	Pliego de Cargos - SAP (Combo)	\N
6	34	Resolucion - SAP (Combo)	\N
\.


--
-- TOC entry 2572 (class 0 OID 16810)
-- Dependencies: 1843
-- Data for Name: sgd_pnun_procenum; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_pnun_procenum (sgd_pnun_codi, sgd_pnufe_codi, depe_codi, sgd_pnun_prepone) FROM stdin;
\.


--
-- TOC entry 2573 (class 0 OID 16813)
-- Dependencies: 1844
-- Data for Name: sgd_prc_proceso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_prc_proceso (sgd_prc_codigo, sgd_prc_descrip, sgd_prc_fech_ini, sgd_prc_fech_fin) FROM stdin;
\.


--
-- TOC entry 2574 (class 0 OID 16816)
-- Dependencies: 1845
-- Data for Name: sgd_prd_prcdmentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_prd_prcdmentos (sgd_prd_codigo, sgd_prd_descrip, sgd_prd_fech_ini, sgd_prd_fech_fin) FROM stdin;
\.


--
-- TOC entry 2575 (class 0 OID 16819)
-- Dependencies: 1846
-- Data for Name: sgd_rda_retdoca; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_rda_retdoca (anex_radi_nume, anex_codigo, radi_nume_salida, anex_borrado, sgd_mrd_codigo, depe_codi, usua_codi, usua_doc, sgd_rda_fech, sgd_deve_codigo, anex_solo_lect, anex_radi_fech, anex_estado, anex_nomb_archivo, anex_tipo, sgd_dir_tipo) FROM stdin;
\.


--
-- TOC entry 2576 (class 0 OID 16822)
-- Dependencies: 1847
-- Data for Name: sgd_rdf_retdocf; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_rdf_retdocf (sgd_mrd_codigo, radi_nume_radi, depe_codi, usua_codi, usua_doc, sgd_rdf_fech) FROM stdin;
1	20089000000022	900	1	900102030	2008-08-20 14:33:13.411287
\.


--
-- TOC entry 2577 (class 0 OID 16825)
-- Dependencies: 1848
-- Data for Name: sgd_renv_regenvio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_renv_regenvio (sgd_renv_codigo, sgd_fenv_codigo, sgd_renv_fech, radi_nume_sal, sgd_renv_destino, sgd_renv_telefono, sgd_renv_mail, sgd_renv_peso, sgd_renv_valor, sgd_renv_certificado, sgd_renv_estado, usua_doc, sgd_renv_nombre, sgd_rem_destino, sgd_dir_codigo, sgd_renv_planilla, sgd_renv_fech_sal, depe_codi, sgd_dir_tipo, radi_nume_grupo, sgd_renv_dir, sgd_renv_depto, sgd_renv_mpio, sgd_renv_tel, sgd_renv_cantidad, sgd_renv_tipo, sgd_renv_observa, sgd_renv_grupo, sgd_deve_codigo, sgd_deve_fech, sgd_renv_valortotal, sgd_renv_valistamiento, sgd_renv_vdescuento, sgd_renv_vadicional, sgd_depe_genera, sgd_renv_pais) FROM stdin;
\.


--
-- TOC entry 2578 (class 0 OID 16840)
-- Dependencies: 1849
-- Data for Name: sgd_rfax_reservafax; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_rfax_reservafax (sgd_rfax_codigo, sgd_rfax_fax, usua_login, sgd_rfax_fech, sgd_rfax_fechradi, radi_nume_radi, sgd_rfax_observa, sgd_rfax_dhojas) FROM stdin;
\.


--
-- TOC entry 2579 (class 0 OID 16846)
-- Dependencies: 1850
-- Data for Name: sgd_rmr_radmasivre; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_rmr_radmasivre (sgd_rmr_grupo, sgd_rmr_radi) FROM stdin;
\.


--
-- TOC entry 2580 (class 0 OID 16849)
-- Dependencies: 1851
-- Data for Name: sgd_san_sancionados; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_san_sancionados (sgd_san_ref, sgd_san_decision, sgd_san_cargo, sgd_san_expediente, sgd_san_tipo_sancion, sgd_san_plazo, sgd_san_valor, sgd_san_radicacion, sgd_san_fecha_radicado, sgd_san_valorletras, sgd_san_nombreempresa, sgd_san_motivos, sgd_san_sectores, sgd_san_padre, sgd_san_fecha_padre, sgd_san_notificado) FROM stdin;
\.


--
-- TOC entry 2581 (class 0 OID 16855)
-- Dependencies: 1852
-- Data for Name: sgd_sbrd_subserierd; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_sbrd_subserierd (sgd_srd_codigo, sgd_sbrd_codigo, sgd_sbrd_descrip, sgd_sbrd_fechini, sgd_sbrd_fechfin, sgd_sbrd_tiemag, sgd_sbrd_tiemac, sgd_sbrd_dispfin, sgd_sbrd_soporte, sgd_sbrd_procedi) FROM stdin;
99	99	PRUEBA SUBSERIE	2008-08-19 00:00:00	2017-08-31 00:00:00	10	10	4	Papel 	
\.


--
-- TOC entry 2582 (class 0 OID 16861)
-- Dependencies: 1853
-- Data for Name: sgd_sed_sede; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_sed_sede (sgd_sed_codi, sgd_sed_desc, sgd_tpr_codigo) FROM stdin;
1	Misma sede	34
2	Otra sede	34
\.


--
-- TOC entry 2583 (class 0 OID 16864)
-- Dependencies: 1854
-- Data for Name: sgd_senuf_secnumfe; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_senuf_secnumfe (sgd_senuf_codi, sgd_pnufe_codi, depe_codi, sgd_senuf_sec) FROM stdin;
2	1	820	NUM_RESOL_DTN
3	1	830	NUM_RESOL_DTOC
4	1	840	NUM_RESOL_DTOR
5	1	850	NUM_RESOL_DTS
6	2	800	NUM_RESOL_GRAL
7	2	810	NUM_RESOL_DTC
1	1	814	NUM_RESOL_DTC
8	2	814	NUM_RESOL_DTC
9	2	815	NUM_RESOL_DTC
10	2	820	NUM_RESOL_DTN
11	2	830	NUM_RESOL_DTOC
12	2	840	NUM_RESOL_DTOR
13	2	850	NUM_RESOL_DTS
14	3	800	NUM_RESOL_GRAL
15	3	810	NUM_RESOL_DTC
16	3	814	NUM_RESOL_DTC
17	3	815	NUM_RESOL_DTC
18	3	820	NUM_RESOL_DTN
19	3	830	NUM_RESOL_DTOC
20	3	840	NUM_RESOL_DTOR
21	3	850	NUM_RESOL_DTS
22	4	800	NUM_RESOL_GRAL
23	4	810	NUM_RESOL_DTC
24	4	814	NUM_RESOL_DTC
25	4	815	NUM_RESOL_DTC
26	4	820	NUM_RESOL_DTN
27	4	830	NUM_RESOL_DTOC
28	4	840	NUM_RESOL_DTOR
29	4	850	NUM_RESOL_DTS
30	5	815	NUM_RESOL_DTC
31	5	820	NUM_RESOL_DTN
32	5	830	NUM_RESOL_DTOC
33	5	840	NUM_RESOL_DTOR
34	5	850	NUM_RESOL_DTS
35	6	815	NUM_RESOL_DTC
36	6	820	NUM_RESOL_DTN
37	6	830	NUM_RESOL_DTOC
38	6	840	NUM_RESOL_DTOR
39	6	850	NUM_RESOL_DTS
41	1	905	sec_rinterna_905
40	1	900	NUM_RESOL_DTN
\.


--
-- TOC entry 2584 (class 0 OID 16867)
-- Dependencies: 1855
-- Data for Name: sgd_sexp_secexpedientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_sexp_secexpedientes (sgd_exp_numero, sgd_srd_codigo, sgd_sbrd_codigo, sgd_sexp_secuencia, depe_codi, usua_doc, sgd_sexp_fech, sgd_fexp_codigo, sgd_sexp_ano, usua_doc_responsable, sgd_sexp_parexp1, sgd_sexp_parexp2, sgd_sexp_parexp3, sgd_sexp_parexp4, sgd_sexp_parexp5, sgd_pexp_codigo, sgd_exp_fech_arch, sgd_fld_codigo, sgd_exp_fechflujoant, sgd_mrd_codigo, sgd_exp_subexpediente, sgd_exp_privado, sgd_sexp_fechafin) FROM stdin;
2008900999900001E	99	99	1	900	900102030	2008-08-20 00:00:00	0	2008	900102030	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	2008-08-20 00:00:00
2008900999900002E	99	99	2	900	900102030	2008-08-20 00:00:00	0	2008	900102030	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	2008-08-20 00:00:00
2008900999900003E	99	99	3	900	900102030	2008-08-20 00:00:00	0	2008	1234567878787	\N	\N	\N	\N	\N	0	\N	\N	\N	\N	\N	\N	2008-08-20 00:00:00
\.


--
-- TOC entry 2585 (class 0 OID 16873)
-- Dependencies: 1856
-- Data for Name: sgd_srd_seriesrd; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_srd_seriesrd (sgd_srd_codigo, sgd_srd_descrip, sgd_srd_fechini, sgd_srd_fechfin) FROM stdin;
99	PRUEBAS DE SERIES	2008-08-19 00:00:00	2017-08-31 00:00:00
\.


--
-- TOC entry 2586 (class 0 OID 16876)
-- Dependencies: 1857
-- Data for Name: sgd_tar_tarifas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tar_tarifas (sgd_fenv_codigo, sgd_tar_codser, sgd_tar_codigo, sgd_tar_valenv1, sgd_tar_valenv2, sgd_tar_valenv1g1, sgd_clta_codser, sgd_tar_valenv2g2, sgd_clta_descrip) FROM stdin;
\.


--
-- TOC entry 2587 (class 0 OID 16879)
-- Dependencies: 1858
-- Data for Name: sgd_tdec_tipodecision; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tdec_tipodecision (sgd_apli_codi, sgd_tdec_codigo, sgd_tdec_descrip, sgd_tdec_sancionar, sgd_tdec_firmeza, sgd_tdec_versancion, sgd_tdec_showmenu, sgd_tdec_updnotif, sgd_tdec_veragota) FROM stdin;
\.


--
-- TOC entry 2588 (class 0 OID 16882)
-- Dependencies: 1859
-- Data for Name: sgd_tdf_tipodefallos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tdf_tipodefallos (sgd_tdf_codigo, sgd_tdf_nombre_fallo) FROM stdin;
1	ACLARATORIA
2	AMONESTACION
3	ARCHIVA
4	CADUCIDAD
6	CONFIRMAR
7	DECRETA PRUEBA
8	IMPROCEDENTE
11	INHIBIRSE
12	MODIFICAR
13	NO ACCEDER
16	NULIDAD
17	ORDENA RECONSTRUCCION
14	PROCEDENTE
15	RECHAZA PRUEBA
10	RECHAZAR
5	REVOCAR
9	SANCIONA
18	SOLICITUD DE PRORROGA
19	DEJAR SIN EFECTO
\.


--
-- TOC entry 2589 (class 0 OID 16888)
-- Dependencies: 1860
-- Data for Name: sgd_tid_tipdecision; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tid_tipdecision (sgd_tid_codi, sgd_tid_desc, sgd_tpr_codigo, sgd_pexp_codigo, sgd_tpr_codigop) FROM stdin;
\.


--
-- TOC entry 2590 (class 0 OID 16891)
-- Dependencies: 1861
-- Data for Name: sgd_tidm_tidocmasiva; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tidm_tidocmasiva (sgd_tidm_codi, sgd_tidm_desc) FROM stdin;
1	PLANTILLA
2	CSV
\.


--
-- TOC entry 2591 (class 0 OID 16894)
-- Dependencies: 1862
-- Data for Name: sgd_tip3_tipotercero; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tip3_tipotercero (sgd_tip3_codigo, sgd_dir_tipo, sgd_tip3_nombre, sgd_tip3_desc, sgd_tip3_imgpestana, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_tp3) FROM stdin;
1	1	REMITENTE	REMITENTE	tip3remitente.jpg	0	1	0
2	1	DESTINATARIO	DESTINATARIO	tip3destina.jpg	1	0	1
3	2	PREDIO	PREDIO	tip3predio.jpg	1	1	1
4	3	ENTIDAD	ENTIDAD	tip3esp.jpg	1	1	1
\.


--
-- TOC entry 2592 (class 0 OID 16904)
-- Dependencies: 1863
-- Data for Name: sgd_tma_temas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tma_temas (sgd_tma_codigo, depe_codi, sgd_prc_codigo, sgd_tma_descrip) FROM stdin;
\.


--
-- TOC entry 2593 (class 0 OID 16907)
-- Dependencies: 1864
-- Data for Name: sgd_tme_tipmen; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tme_tipmen (sgd_tme_codi, sgd_tme_desc) FROM stdin;
1	POP-UP
\.


--
-- TOC entry 2594 (class 0 OID 16910)
-- Dependencies: 1865
-- Data for Name: sgd_tpr_tpdcumento; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_tpr_tpdcumento (sgd_tpr_codigo, sgd_tpr_descrip, sgd_tpr_termino, sgd_tpr_tpuso, sgd_tpr_numera, sgd_tpr_radica, sgd_tpr_tp3, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_estado, sgd_termino_real, sgd_tpr_tp6) FROM stdin;
0	No definido	0	0	0	0	0	0	0	\N	\N	0
1	PRUEBAS TABLAS DE RETENCION	10	\N	\N	\N	1	1	1	\N	\N	1
\.


--
-- TOC entry 2595 (class 0 OID 16919)
-- Dependencies: 1866
-- Data for Name: sgd_trad_tiporad; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_trad_tiporad (sgd_trad_codigo, sgd_trad_descr, sgd_trad_icono, sgd_trad_genradsal) FROM stdin;
1	Salida	RadSalida.gif	1
2	Entrada	RadEntrada.gif	1
3	Memorando	RadInterna.gif	1
\.


--
-- TOC entry 2596 (class 0 OID 16922)
-- Dependencies: 1867
-- Data for Name: sgd_ttr_transaccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) FROM stdin;
61	Cambio de Etapa del Expediente
40	Firma Digital de Documento
41	Eliminacion solicitud de Firma Digital
50	Cambio de Estado Expediente
51	Creacion Expediente
1	Recuperacion Radicado
9	Reasignacion
8	Informar
19	Cambiar Tipo de Documento
20	Crear Registro
21	Editar Registro
10	Movimiento entre Carpetas
11	Modificacion Radicado
7	Borrar Informado
12	Devuelto-Reasignar
13	Archivar
14	Agendar
15	Sacar de la agenda
0	--
16	Reasignar para Vo.Bo.
2	Radicacion
22	Digitalizacion de Radicado
23	Digitalizacion - Modificacion
24	Asociacion Imagen fax
30	Radicacion Masiva
17	Modificacion de Causal
18	Modificacion del Sector
25	Solicitud de Anulacion
26	Anulacion Rad
27	Rechazo de Anulacion
37	Cambio de Estado del Documento
28	Devolucion de correo
29	Digitalizacion de Anexo
31	Borrado de Anexo a radicado
32	Modificacion TRD
33	Eliminar TRD
35	Tipificacion de la decision
36	Cambio en la Notificacion
38	Cambio Vinculacion Documento
39	Solicitud de Firma
42	Digitalizacion Radicado(Asoc. Imagen Web)
60	Cambio seguridad Expediente
52	Excluir radicado de expediente
53	Incluir radicado en expediente
54	Cambio Seguridad del Documento
57	Ingreso al Archivo Fisico
65	Archivar NRR
55	Creación Subexpediente
56	Cambio de Responsable
58	Expediente Cerrado
59	Expediente Reabierto
\.


--
-- TOC entry 2597 (class 0 OID 16925)
-- Dependencies: 1868
-- Data for Name: sgd_ush_usuhistorico; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) FROM stdin;
\.


--
-- TOC entry 2598 (class 0 OID 16928)
-- Dependencies: 1869
-- Data for Name: sgd_usm_usumodifica; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) FROM stdin;
65	Sin permisos radicacion salida
66	Permiso radicacion memorando anexo
67	Permiso radicacion memorando nuevo y anexo
68	Permiso radicacion resoluciones anexo
69	Permiso radicacion resoluciones nuevo y anexo
70	Otorgo permiso creacion expedientes
71	Quito permiso creacion expedientes
72	Otorgo permiso Notificacion de resoluciones
73	Quito permiso notificacion de resoluciones
75	Superusuario creacion Expedientes
47	Quito permiso impresion
43	Otorgo permiso prestamo de documentos
44	Quito permiso prestamo de documentos
45	Otorgo permiso digitalizacion de documentos
46	Quito permiso digitalizacion de documentos
48	Otorgo permiso modificaciones
49	Quito permiso modificaciones
50	Cambio de perfil
1	Creacion de usuario
51	Otorgo permiso tablas retencion documental
52	Quito permiso tablas retencion documental
3	Cambio dependencia
4	Cambio cedula
5	Cambio nombre
7	Cambio ubicacion
8	Cambio piso
9	Cambio estado
10	Otorgo permiso radicacion entrada
11	Otorgo permisos radicacion de entrada
12	Quito permiso administracion sistema
13	Otorgo permiso administracion sistema
14	Quito permiso administracion archivo
15	Otorgo permiso administracion archivo
16	Habilitado como usuario nuevo
17	Habilitado como usuario antiguo con clave
18	Cambio nivel
19	Permiso radicacion salida nueva
20	Permiso radicacion salida de anexos
21	Otorgo permiso radicacion masiva
22	Quito permiso radicacion masiva
23	Quito permiso devoluciones de correo
24	Otorgo permiso devoluciones de correo
25	Otorgo permiso de solicitud de anulacion
26	Otorgo permiso de anulacion
27	Otorgo permiso de solicitud de anulacion y anulacion
28	Quito permiso radicacion memorandos
29	Otorgo permiso radicacion memorandos
30	Quito permiso radicacion resoluciones
31	Permiso radicacion resoluciones nuevo
33	Quito permiso envio de correo
34	Otorgo permiso envio de correo
35	Permiso radicacion salida nueva y anexos
39	Cambio extension
40	Cambio email
41	Quito permisos radicacion entrada
42	Quito permisos de solicitud de anulacion y anulaciones
53	Quito permiso estadisticas
54	Otorgo permiso estadisticas
56	Quito permiso usuario publico
55	Otorgo permiso usuario publico
58	Quito permiso usuario reasignar
57	Otorgo permiso usuario reasignar
59	Sin permiso firma digital
60	Permiso firmar digitalmente
61	Permiso solicitar firma digital
62	Permiso solicitar y firmar digital
63	Superusuario estadisticas
64	Superusuario impresion
74	Permiso impresion
65	Sin permisos radicacion salida
66	Permiso radicacion memorando anexo
67	Permiso radicacion memorando nuevo y anexo
68	Permiso radicacion resoluciones anexo
69	Permiso radicacion resoluciones nuevo y anexo
70	Otorgo permiso creacion expedientes
71	Quito permiso creacion expedientes
72	Otorgo permiso Notificacion de resoluciones
73	Quito permiso notificacion de resoluciones
75	Superusuario creacion Expedientes
47	Quito permiso impresion
43	Otorgo permiso prestamo de documentos
44	Quito permiso prestamo de documentos
45	Otorgo permiso digitalizacion de documentos
46	Quito permiso digitalizacion de documentos
48	Otorgo permiso modificaciones
49	Quito permiso modificaciones
50	Cambio de perfil
1	Creacion de usuario
51	Otorgo permiso tablas retencion documental
52	Quito permiso tablas retencion documental
3	Cambio dependencia
4	Cambio cedula
5	Cambio nombre
7	Cambio ubicacion
8	Cambio piso
9	Cambio estado
10	Otorgo permiso radicacion entrada
11	Otorgo permisos radicacion de entrada
12	Quito permiso administracion sistema
13	Otorgo permiso administracion sistema
14	Quito permiso administracion archivo
15	Otorgo permiso administracion archivo
16	Habilitado como usuario nuevo
17	Habilitado como usuario antiguo con clave
18	Cambio nivel
19	Permiso radicacion salida nueva
20	Permiso radicacion salida de anexos
21	Otorgo permiso radicacion masiva
22	Quito permiso radicacion masiva
23	Quito permiso devoluciones de correo
24	Otorgo permiso devoluciones de correo
25	Otorgo permiso de solicitud de anulacion
26	Otorgo permiso de anulacion
27	Otorgo permiso de solicitud de anulacion y anulacion
28	Quito permiso radicacion memorandos
29	Otorgo permiso radicacion memorandos
30	Quito permiso radicacion resoluciones
31	Permiso radicacion resoluciones nuevo
33	Quito permiso envio de correo
34	Otorgo permiso envio de correo
35	Permiso radicacion salida nueva y anexos
39	Cambio extension
40	Cambio email
41	Quito permisos radicacion entrada
42	Quito permisos de solicitud de anulacion y anulaciones
53	Quito permiso estadisticas
54	Otorgo permiso estadisticas
56	Quito permiso usuario publico
55	Otorgo permiso usuario publico
58	Quito permiso usuario reasignar
57	Otorgo permiso usuario reasignar
59	Sin permiso firma digital
60	Permiso firmar digitalmente
61	Permiso solicitar firma digital
62	Permiso solicitar y firmar digital
63	Superusuario estadisticas
64	Superusuario impresion
74	Permiso impresion
65	Sin permisos radicacion salida
66	Permiso radicacion memorando anexo
67	Permiso radicacion memorando nuevo y anexo
68	Permiso radicacion resoluciones anexo
69	Permiso radicacion resoluciones nuevo y anexo
70	Otorgo permiso creacion expedientes
71	Quito permiso creacion expedientes
72	Otorgo permiso Notificacion de resoluciones
73	Quito permiso notificacion de resoluciones
75	Superusuario creacion Expedientes
47	Quito permiso impresion
43	Otorgo permiso prestamo de documentos
44	Quito permiso prestamo de documentos
45	Otorgo permiso digitalizacion de documentos
46	Quito permiso digitalizacion de documentos
48	Otorgo permiso modificaciones
49	Quito permiso modificaciones
50	Cambio de perfil
1	Creacion de usuario
51	Otorgo permiso tablas retencion documental
52	Quito permiso tablas retencion documental
3	Cambio dependencia
4	Cambio cedula
5	Cambio nombre
7	Cambio ubicacion
8	Cambio piso
9	Cambio estado
10	Otorgo permiso radicacion entrada
11	Otorgo permisos radicacion de entrada
12	Quito permiso administracion sistema
13	Otorgo permiso administracion sistema
14	Quito permiso administracion archivo
15	Otorgo permiso administracion archivo
16	Habilitado como usuario nuevo
17	Habilitado como usuario antiguo con clave
18	Cambio nivel
19	Permiso radicacion salida nueva
20	Permiso radicacion salida de anexos
21	Otorgo permiso radicacion masiva
22	Quito permiso radicacion masiva
23	Quito permiso devoluciones de correo
24	Otorgo permiso devoluciones de correo
25	Otorgo permiso de solicitud de anulacion
26	Otorgo permiso de anulacion
27	Otorgo permiso de solicitud de anulacion y anulacion
28	Quito permiso radicacion memorandos
29	Otorgo permiso radicacion memorandos
30	Quito permiso radicacion resoluciones
31	Permiso radicacion resoluciones nuevo
33	Quito permiso envio de correo
34	Otorgo permiso envio de correo
35	Permiso radicacion salida nueva y anexos
39	Cambio extension
40	Cambio email
41	Quito permisos radicacion entrada
42	Quito permisos de solicitud de anulacion y anulaciones
53	Quito permiso estadisticas
54	Otorgo permiso estadisticas
56	Quito permiso usuario publico
55	Otorgo permiso usuario publico
58	Quito permiso usuario reasignar
57	Otorgo permiso usuario reasignar
59	Sin permiso firma digital
60	Permiso firmar digitalmente
61	Permiso solicitar firma digital
62	Permiso solicitar y firmar digital
63	Superusuario estadisticas
64	Superusuario impresion
74	Permiso impresion
65	Sin permisos radicacion salida
66	Permiso radicacion memorando anexo
67	Permiso radicacion memorando nuevo y anexo
68	Permiso radicacion resoluciones anexo
69	Permiso radicacion resoluciones nuevo y anexo
70	Otorgo permiso creacion expedientes
71	Quito permiso creacion expedientes
72	Otorgo permiso Notificacion de resoluciones
73	Quito permiso notificacion de resoluciones
75	Superusuario creacion Expedientes
47	Quito permiso impresion
43	Otorgo permiso prestamo de documentos
44	Quito permiso prestamo de documentos
45	Otorgo permiso digitalizacion de documentos
46	Quito permiso digitalizacion de documentos
48	Otorgo permiso modificaciones
49	Quito permiso modificaciones
50	Cambio de perfil
1	Creacion de usuario
51	Otorgo permiso tablas retencion documental
52	Quito permiso tablas retencion documental
3	Cambio dependencia
4	Cambio cedula
5	Cambio nombre
7	Cambio ubicacion
8	Cambio piso
9	Cambio estado
10	Otorgo permiso radicacion entrada
11	Otorgo permisos radicacion de entrada
12	Quito permiso administracion sistema
13	Otorgo permiso administracion sistema
14	Quito permiso administracion archivo
15	Otorgo permiso administracion archivo
16	Habilitado como usuario nuevo
17	Habilitado como usuario antiguo con clave
18	Cambio nivel
19	Permiso radicacion salida nueva
20	Permiso radicacion salida de anexos
21	Otorgo permiso radicacion masiva
22	Quito permiso radicacion masiva
23	Quito permiso devoluciones de correo
24	Otorgo permiso devoluciones de correo
25	Otorgo permiso de solicitud de anulacion
26	Otorgo permiso de anulacion
27	Otorgo permiso de solicitud de anulacion y anulacion
28	Quito permiso radicacion memorandos
29	Otorgo permiso radicacion memorandos
30	Quito permiso radicacion resoluciones
31	Permiso radicacion resoluciones nuevo
33	Quito permiso envio de correo
34	Otorgo permiso envio de correo
35	Permiso radicacion salida nueva y anexos
39	Cambio extension
40	Cambio email
41	Quito permisos radicacion entrada
42	Quito permisos de solicitud de anulacion y anulaciones
53	Quito permiso estadisticas
54	Otorgo permiso estadisticas
56	Quito permiso usuario publico
55	Otorgo permiso usuario publico
58	Quito permiso usuario reasignar
57	Otorgo permiso usuario reasignar
59	Sin permiso firma digital
60	Permiso firmar digitalmente
61	Permiso solicitar firma digital
62	Permiso solicitar y firmar digital
63	Superusuario estadisticas
64	Superusuario impresion
74	Permiso impresion
\.


--
-- TOC entry 2599 (class 0 OID 16931)
-- Dependencies: 1870
-- Data for Name: tipo_doc_identificacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_doc_identificacion (tdid_codi, tdid_desc) FROM stdin;
0	Cedula de Ciudadania
1	Tarjeta de Identidad
2	Cedula de Extranjeria
3	Pasaporte
4	Nit
5	Nuir
\.


--
-- TOC entry 2600 (class 0 OID 16934)
-- Dependencies: 1871
-- Data for Name: tipo_remitente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tipo_remitente (trte_codi, trte_desc) FROM stdin;
0	ENTIDAD
1	OTRA EMPRESA
2	PERSONA NATURAL
5	PREDIO
3	OTRO
\.


--
-- TOC entry 2601 (class 0 OID 16937)
-- Dependencies: 1872
-- Data for Name: ubicacion_fisica; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ubicacion_fisica (ubic_depe_radi, ubic_depe_arch, ubic_inv_piso, ubic_inv_piso_desc, ubic_inv_itemso, ubic_inv_itemsn, ubic_inv_archivador) FROM stdin;
\.


--
-- TOC entry 2602 (class 0 OID 16940)
-- Dependencies: 1873
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY usuario (usua_codi, depe_codi, usua_login, usua_fech_crea, usua_pasw, usua_esta, usua_nomb, perm_radi, usua_admin, usua_nuevo, usua_doc, codi_nivel, usua_sesion, usua_fech_sesion, usua_ext, usua_nacim, usua_email, usua_at, usua_piso, perm_radi_sal, usua_admin_archivo, usua_masiva, usua_perm_dev, usua_perm_numera_res, usua_doc_suip, usua_perm_numeradoc, sgd_panu_codi, usua_prad_tp1, usua_prad_tp2, usua_prad_tp3, usua_perm_envios, usua_perm_modifica, usua_perm_impresion, usua_prad_tp9, sgd_aper_codigo, usu_telefono1, usua_encuesta, sgd_perm_estadistica, usua_perm_sancionados, usua_admin_sistema, usua_perm_trd, usua_perm_firma, usua_perm_prestamo, usuario_publico, usuario_reasignar, usua_perm_notifica, usua_perm_expediente, usua_login_externo, id_pais, id_cont, perm_tipif_anexo, perm_vobo, perm_archi, perm_borrar_anexo, usua_auth_ldap, usua_perm_adminflujos, usua_prad_tp6, usua_perm_comisiones, usua_exp_trd) FROM stdin;
2	900	PRUEBAS	2008-08-13 10:10:31.822753	e2ec3cc66427bb422894495068	1	Pruebas postgres 	1	0	1	1234567878787	5	127o0o0o1oPRUEBAS	2008-08-13 11:25:45.042017	\N	2008-05-09	\N	\N	\N	2	0	1	1	\N	\N	\N	3	3	3	3	1	1	0	3	\N	\N	\N	2	\N	1	1	3	1	1	1	1	2	\N	170	1	\N	1	1	\N	\N	0	3	\N	\N
1	900	ADMON	2007-09-21 00:00:00	02cb962ac59075b964b07152d2	1	ADMINISTRADOR	1	1	1	900102030	5	090527023935o127001ADMON	2009-05-27 14:39:35.797469	1111	0001-05-04 BC	\N	11	5	2	2	1	1	1	\N	\N	3	3	3	3	1	1	2	3	\N	\N	\N	2	\N	1	1	3	1	0	1	0	2	\N	170	1	1	1	1	1	0	1	3	\N	0
\.


--
-- TOC entry 2226 (class 2606 OID 16971)
-- Dependencies: 1749 1749 1749
-- Name: anex_hist_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anexos_historico
    ADD CONSTRAINT anex_hist_pk PRIMARY KEY (anex_hist_anex_codi, anex_hist_num_ver);


--
-- TOC entry 2224 (class 2606 OID 16973)
-- Dependencies: 1748 1748
-- Name: anex_pk_anex_codigo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anexos
    ADD CONSTRAINT anex_pk_anex_codigo PRIMARY KEY (anex_codigo);


--
-- TOC entry 2228 (class 2606 OID 16975)
-- Dependencies: 1750 1750
-- Name: anex_pk_anex_tipo_codi; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anexos_tipo
    ADD CONSTRAINT anex_pk_anex_tipo_codi PRIMARY KEY (anex_tipo_codi);


--
-- TOC entry 2234 (class 2606 OID 16977)
-- Dependencies: 1753 1753
-- Name: carpetas_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY carpeta
    ADD CONSTRAINT carpetas_pk PRIMARY KEY (carp_codi);


--
-- TOC entry 2236 (class 2606 OID 16979)
-- Dependencies: 1755 1755 1755 1755
-- Name: centro_poblado_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY centro_poblado
    ADD CONSTRAINT centro_poblado_pk PRIMARY KEY (cpob_codi, muni_codi, dpto_codi);


--
-- TOC entry 2238 (class 2606 OID 16981)
-- Dependencies: 1756 1756
-- Name: departamento_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT departamento_pk PRIMARY KEY (dpto_codi);


--
-- TOC entry 2242 (class 2606 OID 16983)
-- Dependencies: 1758 1758
-- Name: dependencia_visibilidad_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY dependencia_visibilidad
    ADD CONSTRAINT dependencia_visibilidad_pk PRIMARY KEY (codigo_visibilidad);


--
-- TOC entry 2246 (class 2606 OID 16985)
-- Dependencies: 1760 1760
-- Name: estados_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT estados_pk PRIMARY KEY (esta_codi);


--
-- TOC entry 2390 (class 2606 OID 16987)
-- Dependencies: 1855 1855 1855
-- Name: fk_sgd_sexp_secexpedientes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_sexp_secexpedientes
    ADD CONSTRAINT fk_sgd_sexp_secexpedientes PRIMARY KEY (sgd_exp_numero, sgd_pexp_codigo);


--
-- TOC entry 2270 (class 2606 OID 16989)
-- Dependencies: 1784 1784
-- Name: pk_anu_naludos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_anu_anulados
    ADD CONSTRAINT pk_anu_naludos PRIMARY KEY (sgd_anu_id);


--
-- TOC entry 2230 (class 2606 OID 16991)
-- Dependencies: 1751 1751
-- Name: pk_bodega_empresas_secue; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bodega_empresas
    ADD CONSTRAINT pk_bodega_empresas_secue PRIMARY KEY (identificador_empresa);


--
-- TOC entry 2240 (class 2606 OID 16993)
-- Dependencies: 1757 1757
-- Name: pk_depe; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT pk_depe PRIMARY KEY (depe_codi);


--
-- TOC entry 2244 (class 2606 OID 16995)
-- Dependencies: 1759 1759
-- Name: pk_encuesta; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY encuesta
    ADD CONSTRAINT pk_encuesta PRIMARY KEY (usua_doc);


--
-- TOC entry 2312 (class 2606 OID 16997)
-- Dependencies: 1808 1808
-- Name: pk_estanulacion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_eanu_estanulacion
    ADD CONSTRAINT pk_estanulacion PRIMARY KEY (sgd_eanu_codi);


--
-- TOC entry 2248 (class 2606 OID 16999)
-- Dependencies: 1764 1764
-- Name: pk_medio_recepcion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY medio_recepcion
    ADD CONSTRAINT pk_medio_recepcion PRIMARY KEY (mrec_codi);


--
-- TOC entry 2250 (class 2606 OID 17001)
-- Dependencies: 1765 1765 1765
-- Name: pk_municipio; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT pk_municipio PRIMARY KEY (muni_codi, dpto_codi);


--
-- TOC entry 2252 (class 2606 OID 17003)
-- Dependencies: 1766 1766
-- Name: pk_par_serv_servicios; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY par_serv_servicios
    ADD CONSTRAINT pk_par_serv_servicios PRIMARY KEY (par_serv_secue);


--
-- TOC entry 2362 (class 2606 OID 17005)
-- Dependencies: 1838 1838
-- Name: pk_peranualdos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_panu_peranulados
    ADD CONSTRAINT pk_peranualdos PRIMARY KEY (sgd_panu_codi);


--
-- TOC entry 2254 (class 2606 OID 17007)
-- Dependencies: 1768 1768
-- Name: pk_pl_tipo_plt; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY pl_tipo_plt
    ADD CONSTRAINT pk_pl_tipo_plt PRIMARY KEY (plt_codi);


--
-- TOC entry 2256 (class 2606 OID 17009)
-- Dependencies: 1770 1770
-- Name: pk_plantilla_pl; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY plantilla_pl
    ADD CONSTRAINT pk_plantilla_pl PRIMARY KEY (pl_codi);


--
-- TOC entry 2258 (class 2606 OID 17011)
-- Dependencies: 1771 1771
-- Name: pk_prestamo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT pk_prestamo PRIMARY KEY (pres_id);


--
-- TOC entry 2232 (class 2606 OID 17013)
-- Dependencies: 1752 1752
-- Name: pk_rad_carp_per; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY borrar_carpeta_personalizada
    ADD CONSTRAINT pk_rad_carp_per PRIMARY KEY (carp_per_codi);


--
-- TOC entry 2262 (class 2606 OID 17015)
-- Dependencies: 1779 1779 1779 1779
-- Name: pk_seri; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY series
    ADD CONSTRAINT pk_seri PRIMARY KEY (depe_codi, seri_tipo, seri_ano);


--
-- TOC entry 2264 (class 2606 OID 17017)
-- Dependencies: 1780 1780 1780
-- Name: pk_sgd_acm_acusemsg; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_acm_acusemsg
    ADD CONSTRAINT pk_sgd_acm_acusemsg PRIMARY KEY (sgd_msg_codi, usua_doc);


--
-- TOC entry 2266 (class 2606 OID 17019)
-- Dependencies: 1781 1781
-- Name: pk_sgd_actadd_actualiadicional; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_actadd_actualiadicional
    ADD CONSTRAINT pk_sgd_actadd_actualiadicional PRIMARY KEY (sgd_actadd_codi);


--
-- TOC entry 2268 (class 2606 OID 17021)
-- Dependencies: 1783 1783
-- Name: pk_sgd_anar_anexarg; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_anar_anexarg
    ADD CONSTRAINT pk_sgd_anar_anexarg PRIMARY KEY (sgd_anar_codi);


--
-- TOC entry 2272 (class 2606 OID 17023)
-- Dependencies: 1785 1785
-- Name: pk_sgd_aper_adminperfiles; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aper_adminperfiles
    ADD CONSTRAINT pk_sgd_aper_adminperfiles PRIMARY KEY (sgd_aper_codigo);


--
-- TOC entry 2274 (class 2606 OID 17025)
-- Dependencies: 1786 1786
-- Name: pk_sgd_aplfad_plicfunadi; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aplfad_plicfunadi
    ADD CONSTRAINT pk_sgd_aplfad_plicfunadi PRIMARY KEY (sgd_aplfad_codi);


--
-- TOC entry 2276 (class 2606 OID 17027)
-- Dependencies: 1787 1787
-- Name: pk_sgd_apli_aplintegra; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_apli_aplintegra
    ADD CONSTRAINT pk_sgd_apli_aplintegra PRIMARY KEY (sgd_apli_codi);


--
-- TOC entry 2278 (class 2606 OID 17029)
-- Dependencies: 1788 1788
-- Name: pk_sgd_aplmen_aplimens; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aplmen_aplimens
    ADD CONSTRAINT pk_sgd_aplmen_aplimens PRIMARY KEY (sgd_aplmen_codi);


--
-- TOC entry 2280 (class 2606 OID 17031)
-- Dependencies: 1789 1789
-- Name: pk_sgd_aplus_plicusua; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aplus_plicusua
    ADD CONSTRAINT pk_sgd_aplus_plicusua PRIMARY KEY (sgd_aplus_codi);


--
-- TOC entry 2282 (class 2606 OID 17033)
-- Dependencies: 1791 1791
-- Name: pk_sgd_argd_argdoc; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_argd_argdoc
    ADD CONSTRAINT pk_sgd_argd_argdoc PRIMARY KEY (sgd_argd_codi);


--
-- TOC entry 2284 (class 2606 OID 17035)
-- Dependencies: 1792 1792
-- Name: pk_sgd_argup_argudoctop; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_argup_argudoctop
    ADD CONSTRAINT pk_sgd_argup_argudoctop PRIMARY KEY (sgd_argup_codi);


--
-- TOC entry 2286 (class 2606 OID 17037)
-- Dependencies: 1793 1793
-- Name: pk_sgd_camexp_campoexpediente; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_camexp_campoexpediente
    ADD CONSTRAINT pk_sgd_camexp_campoexpediente PRIMARY KEY (sgd_camexp_codigo);


--
-- TOC entry 2290 (class 2606 OID 17039)
-- Dependencies: 1795 1795
-- Name: pk_sgd_cau_causal; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_cau_causal
    ADD CONSTRAINT pk_sgd_cau_causal PRIMARY KEY (sgd_cau_codigo);


--
-- TOC entry 2292 (class 2606 OID 17041)
-- Dependencies: 1796 1796
-- Name: pk_sgd_caux_causales; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_caux_causales
    ADD CONSTRAINT pk_sgd_caux_causales PRIMARY KEY (sgd_caux_codigo);


--
-- TOC entry 2294 (class 2606 OID 17043)
-- Dependencies: 1797 1797
-- Name: pk_sgd_ciu_ciudadano; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ciu_ciudadano
    ADD CONSTRAINT pk_sgd_ciu_ciudadano PRIMARY KEY (sgd_ciu_codigo);


--
-- TOC entry 2296 (class 2606 OID 17045)
-- Dependencies: 1799 1799
-- Name: pk_sgd_cob_campobliga; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_cob_campobliga
    ADD CONSTRAINT pk_sgd_cob_campobliga PRIMARY KEY (sgd_cob_codi);


--
-- TOC entry 2298 (class 2606 OID 17047)
-- Dependencies: 1800 1800
-- Name: pk_sgd_dcau_causal; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_dcau_causal
    ADD CONSTRAINT pk_sgd_dcau_causal PRIMARY KEY (sgd_dcau_codigo);


--
-- TOC entry 2300 (class 2606 OID 17049)
-- Dependencies: 1801 1801
-- Name: pk_sgd_ddca_ddsgrgdo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ddca_ddsgrgdo
    ADD CONSTRAINT pk_sgd_ddca_ddsgrgdo PRIMARY KEY (sgd_ddca_codigo);


--
-- TOC entry 2302 (class 2606 OID 17051)
-- Dependencies: 1803 1803
-- Name: pk_sgd_def_continentes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_def_continentes
    ADD CONSTRAINT pk_sgd_def_continentes PRIMARY KEY (id_cont);


--
-- TOC entry 2304 (class 2606 OID 17053)
-- Dependencies: 1804 1804
-- Name: pk_sgd_def_paises; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_def_paises
    ADD CONSTRAINT pk_sgd_def_paises PRIMARY KEY (id_pais);


--
-- TOC entry 2306 (class 2606 OID 17055)
-- Dependencies: 1805 1805
-- Name: pk_sgd_deve; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_deve_dev_envio
    ADD CONSTRAINT pk_sgd_deve PRIMARY KEY (sgd_deve_codigo);


--
-- TOC entry 2308 (class 2606 OID 17057)
-- Dependencies: 1806 1806
-- Name: pk_sgd_dir; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT pk_sgd_dir PRIMARY KEY (sgd_dir_codigo);


--
-- TOC entry 2310 (class 2606 OID 17059)
-- Dependencies: 1807 1807
-- Name: pk_sgd_dnufe_docnufe; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_dnufe_docnufe
    ADD CONSTRAINT pk_sgd_dnufe_docnufe PRIMARY KEY (sgd_dnufe_codi);


--
-- TOC entry 2318 (class 2606 OID 17061)
-- Dependencies: 1811 1811 1811
-- Name: pk_sgd_ent; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ent_entidades
    ADD CONSTRAINT pk_sgd_ent PRIMARY KEY (sgd_ent_nit, sgd_ent_codsuc);


--
-- TOC entry 2320 (class 2606 OID 17063)
-- Dependencies: 1814 1814
-- Name: pk_sgd_estinst_estadoinstancia; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_estinst_estadoinstancia
    ADD CONSTRAINT pk_sgd_estinst_estadoinstancia PRIMARY KEY (sgd_estinst_codi);


--
-- TOC entry 2326 (class 2606 OID 17065)
-- Dependencies: 1817 1817
-- Name: pk_sgd_fenv; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fenv_frmenvio
    ADD CONSTRAINT pk_sgd_fenv PRIMARY KEY (sgd_fenv_codigo);


--
-- TOC entry 2328 (class 2606 OID 17067)
-- Dependencies: 1818 1818
-- Name: pk_sgd_fexp_descrip; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fexp_flujoexpedientes
    ADD CONSTRAINT pk_sgd_fexp_descrip PRIMARY KEY (sgd_fexp_codigo);


--
-- TOC entry 2330 (class 2606 OID 17069)
-- Dependencies: 1819 1819
-- Name: pk_sgd_firrad_firmarads; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_firrad_firmarads
    ADD CONSTRAINT pk_sgd_firrad_firmarads PRIMARY KEY (sgd_firrad_id);


--
-- TOC entry 2332 (class 2606 OID 17071)
-- Dependencies: 1821 1821
-- Name: pk_sgd_fun_funciones; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fun_funciones
    ADD CONSTRAINT pk_sgd_fun_funciones PRIMARY KEY (sgd_fun_codigo);


--
-- TOC entry 2334 (class 2606 OID 17073)
-- Dependencies: 1823 1823
-- Name: pk_sgd_hmtd_hismatdoc; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_hmtd_hismatdoc
    ADD CONSTRAINT pk_sgd_hmtd_hismatdoc PRIMARY KEY (sgd_hmtd_codigo);


--
-- TOC entry 2336 (class 2606 OID 17075)
-- Dependencies: 1824 1824
-- Name: pk_sgd_instorf_instanciasorfeo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_instorf_instanciasorfeo
    ADD CONSTRAINT pk_sgd_instorf_instanciasorfeo PRIMARY KEY (sgd_instorf_codi);


--
-- TOC entry 2340 (class 2606 OID 17077)
-- Dependencies: 1827 1827
-- Name: pk_sgd_mat_matriz; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT pk_sgd_mat_matriz PRIMARY KEY (sgd_mat_codigo);


--
-- TOC entry 2344 (class 2606 OID 17079)
-- Dependencies: 1828 1828
-- Name: pk_sgd_mpes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mpes_mddpeso
    ADD CONSTRAINT pk_sgd_mpes PRIMARY KEY (sgd_mpes_codigo);


--
-- TOC entry 2346 (class 2606 OID 17081)
-- Dependencies: 1829 1829
-- Name: pk_sgd_mrd_matrird; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT pk_sgd_mrd_matrird PRIMARY KEY (sgd_mrd_codigo);


--
-- TOC entry 2350 (class 2606 OID 17083)
-- Dependencies: 1830 1830
-- Name: pk_sgd_msdep_msgdep; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_msdep_msgdep
    ADD CONSTRAINT pk_sgd_msdep_msgdep PRIMARY KEY (sgd_msdep_codi);


--
-- TOC entry 2352 (class 2606 OID 17085)
-- Dependencies: 1831 1831
-- Name: pk_sgd_msg_mensaje; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_msg_mensaje
    ADD CONSTRAINT pk_sgd_msg_mensaje PRIMARY KEY (sgd_msg_codi);


--
-- TOC entry 2354 (class 2606 OID 17087)
-- Dependencies: 1832 1832
-- Name: pk_sgd_mtd_matriz_doc; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mtd_matriz_doc
    ADD CONSTRAINT pk_sgd_mtd_matriz_doc PRIMARY KEY (sgd_mtd_codigo);


--
-- TOC entry 2358 (class 2606 OID 17089)
-- Dependencies: 1835 1835
-- Name: pk_sgd_not; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_not_notificacion
    ADD CONSTRAINT pk_sgd_not PRIMARY KEY (sgd_not_codi);


--
-- TOC entry 2360 (class 2606 OID 17091)
-- Dependencies: 1837 1837
-- Name: pk_sgd_oem_oempresas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_oem_oempresas
    ADD CONSTRAINT pk_sgd_oem_oempresas PRIMARY KEY (sgd_oem_codigo);


--
-- TOC entry 2366 (class 2606 OID 17093)
-- Dependencies: 1840 1840
-- Name: pk_sgd_parexp_paramexpediente; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_parexp_paramexpediente
    ADD CONSTRAINT pk_sgd_parexp_paramexpediente PRIMARY KEY (sgd_parexp_codigo);


--
-- TOC entry 2368 (class 2606 OID 17095)
-- Dependencies: 1841 1841
-- Name: pk_sgd_pexp_procexpedientes; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_pexp_procexpedientes
    ADD CONSTRAINT pk_sgd_pexp_procexpedientes PRIMARY KEY (sgd_pexp_codigo);


--
-- TOC entry 2370 (class 2606 OID 17097)
-- Dependencies: 1842 1842
-- Name: pk_sgd_pnufe_procnumfe; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_pnufe_procnumfe
    ADD CONSTRAINT pk_sgd_pnufe_procnumfe PRIMARY KEY (sgd_pnufe_codi);


--
-- TOC entry 2372 (class 2606 OID 17099)
-- Dependencies: 1843 1843
-- Name: pk_sgd_pnun_procenum; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_pnun_procenum
    ADD CONSTRAINT pk_sgd_pnun_procenum PRIMARY KEY (sgd_pnun_codi);


--
-- TOC entry 2374 (class 2606 OID 17101)
-- Dependencies: 1844 1844
-- Name: pk_sgd_prc_proceso; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_prc_proceso
    ADD CONSTRAINT pk_sgd_prc_proceso PRIMARY KEY (sgd_prc_codigo);


--
-- TOC entry 2376 (class 2606 OID 17103)
-- Dependencies: 1845 1845
-- Name: pk_sgd_prd_prcdmentos; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_prd_prcdmentos
    ADD CONSTRAINT pk_sgd_prd_prcdmentos PRIMARY KEY (sgd_prd_codigo);


--
-- TOC entry 2380 (class 2606 OID 17105)
-- Dependencies: 1850 1850 1850
-- Name: pk_sgd_rmr_radmasivre; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_rmr_radmasivre
    ADD CONSTRAINT pk_sgd_rmr_radmasivre PRIMARY KEY (sgd_rmr_grupo, sgd_rmr_radi);


--
-- TOC entry 2382 (class 2606 OID 17107)
-- Dependencies: 1851 1851
-- Name: pk_sgd_san_sancionados; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_san_sancionados
    ADD CONSTRAINT pk_sgd_san_sancionados PRIMARY KEY (sgd_san_ref);


--
-- TOC entry 2386 (class 2606 OID 17109)
-- Dependencies: 1853 1853
-- Name: pk_sgd_sed_sede; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_sed_sede
    ADD CONSTRAINT pk_sgd_sed_sede PRIMARY KEY (sgd_sed_codi);


--
-- TOC entry 2388 (class 2606 OID 17111)
-- Dependencies: 1854 1854
-- Name: pk_sgd_senuf_secnumfe; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_senuf_secnumfe
    ADD CONSTRAINT pk_sgd_senuf_secnumfe PRIMARY KEY (sgd_senuf_codi);


--
-- TOC entry 2392 (class 2606 OID 17113)
-- Dependencies: 1856 1856
-- Name: pk_sgd_srd_seriesrd; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_srd_seriesrd
    ADD CONSTRAINT pk_sgd_srd_seriesrd PRIMARY KEY (sgd_srd_codigo);


--
-- TOC entry 2396 (class 2606 OID 17115)
-- Dependencies: 1858 1858
-- Name: pk_sgd_tdec_tipodecision; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tdec_tipodecision
    ADD CONSTRAINT pk_sgd_tdec_tipodecision PRIMARY KEY (sgd_tdec_codigo);


--
-- TOC entry 2400 (class 2606 OID 17117)
-- Dependencies: 1860 1860
-- Name: pk_sgd_tid_tipdecision; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tid_tipdecision
    ADD CONSTRAINT pk_sgd_tid_tipdecision PRIMARY KEY (sgd_tid_codi);


--
-- TOC entry 2404 (class 2606 OID 17119)
-- Dependencies: 1862 1862
-- Name: pk_sgd_tip_tipotercero; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tip3_tipotercero
    ADD CONSTRAINT pk_sgd_tip_tipotercero PRIMARY KEY (sgd_tip3_codigo);


--
-- TOC entry 2406 (class 2606 OID 17121)
-- Dependencies: 1863 1863
-- Name: pk_sgd_tma_temas; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tma_temas
    ADD CONSTRAINT pk_sgd_tma_temas PRIMARY KEY (sgd_tma_codigo);


--
-- TOC entry 2408 (class 2606 OID 17123)
-- Dependencies: 1864 1864
-- Name: pk_sgd_tme_tipmen; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tme_tipmen
    ADD CONSTRAINT pk_sgd_tme_tipmen PRIMARY KEY (sgd_tme_codi);


--
-- TOC entry 2410 (class 2606 OID 17125)
-- Dependencies: 1865 1865
-- Name: pk_sgd_tpr_tpdcumento; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tpr_tpdcumento
    ADD CONSTRAINT pk_sgd_tpr_tpdcumento PRIMARY KEY (sgd_tpr_codigo);


--
-- TOC entry 2414 (class 2606 OID 17127)
-- Dependencies: 1867 1867
-- Name: pk_sgd_ttr_transaccion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ttr_transaccion
    ADD CONSTRAINT pk_sgd_ttr_transaccion PRIMARY KEY (sgd_ttr_codigo);


--
-- TOC entry 2402 (class 2606 OID 17129)
-- Dependencies: 1861 1861
-- Name: pk_tdm_tidomasiva; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tidm_tidocmasiva
    ADD CONSTRAINT pk_tdm_tidomasiva PRIMARY KEY (sgd_tidm_codi);


--
-- TOC entry 2260 (class 2606 OID 17131)
-- Dependencies: 1772 1772
-- Name: radicado_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_pk PRIMARY KEY (radi_nume_radi);


--
-- TOC entry 2288 (class 2606 OID 17133)
-- Dependencies: 1794 1794 1794
-- Name: sgd_carp_descripcion_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_carp_descripcion
    ADD CONSTRAINT sgd_carp_descripcion_pk PRIMARY KEY (sgd_carp_depecodi, sgd_carp_tiporad);


--
-- TOC entry 2314 (class 2606 OID 17135)
-- Dependencies: 1809 1809
-- Name: sgd_einv_inventario_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_einv_inventario
    ADD CONSTRAINT sgd_einv_inventario_pk PRIMARY KEY (sgd_einv_codigo);


--
-- TOC entry 2316 (class 2606 OID 17137)
-- Dependencies: 1810 1810
-- Name: sgd_eit_items_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_eit_items
    ADD CONSTRAINT sgd_eit_items_pk PRIMARY KEY (sgd_eit_codigo);


--
-- TOC entry 2322 (class 2606 OID 17139)
-- Dependencies: 1815 1815 1815
-- Name: sgd_exp_expediente_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_exp_expediente
    ADD CONSTRAINT sgd_exp_expediente_pk PRIMARY KEY (sgd_exp_numero, radi_nume_radi);


--
-- TOC entry 2324 (class 2606 OID 17141)
-- Dependencies: 1816 1816
-- Name: sgd_fars_faristas_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fars_faristas
    ADD CONSTRAINT sgd_fars_faristas_pk PRIMARY KEY (sgd_fars_codigo);


--
-- TOC entry 2338 (class 2606 OID 17143)
-- Dependencies: 1826 1826
-- Name: sgd_masiva_codigo; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_masiva_excel
    ADD CONSTRAINT sgd_masiva_codigo PRIMARY KEY (sgd_masiva_codigo);


--
-- TOC entry 2356 (class 2606 OID 17145)
-- Dependencies: 1833 1833
-- Name: sgd_nfn_notifijacion_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_nfn_notifijacion
    ADD CONSTRAINT sgd_nfn_notifijacion_pk PRIMARY KEY (radi_nume_radi);


--
-- TOC entry 2364 (class 2606 OID 17147)
-- Dependencies: 1839 1839 1839
-- Name: sgd_parametro_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_parametro
    ADD CONSTRAINT sgd_parametro_pk PRIMARY KEY (param_nomb, param_codi);


--
-- TOC entry 2398 (class 2606 OID 17149)
-- Dependencies: 1859 1859
-- Name: sgd_tdf_tipodefallos_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tdf_tipodefallos
    ADD CONSTRAINT sgd_tdf_tipodefallos_pk PRIMARY KEY (sgd_tdf_codigo);


--
-- TOC entry 2412 (class 2606 OID 17151)
-- Dependencies: 1866 1866
-- Name: sgd_trad_tiporad_codigo_inx; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_trad_tiporad
    ADD CONSTRAINT sgd_trad_tiporad_codigo_inx PRIMARY KEY (sgd_trad_codigo);


--
-- TOC entry 2416 (class 2606 OID 17153)
-- Dependencies: 1870 1870
-- Name: tipo_doc_identificacion_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_doc_identificacion
    ADD CONSTRAINT tipo_doc_identificacion_pk PRIMARY KEY (tdid_codi);


--
-- TOC entry 2418 (class 2606 OID 17155)
-- Dependencies: 1871 1871
-- Name: tipo_remitente_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_remitente
    ADD CONSTRAINT tipo_remitente_pk PRIMARY KEY (trte_codi);


--
-- TOC entry 2342 (class 2606 OID 17157)
-- Dependencies: 1827 1827 1827 1827 1827
-- Name: uk_sgd_mat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT uk_sgd_mat UNIQUE (depe_codi, sgd_fun_codigo, sgd_prc_codigo, sgd_prd_codigo);


--
-- TOC entry 2348 (class 2606 OID 17159)
-- Dependencies: 1829 1829 1829 1829 1829
-- Name: uk_sgd_mrd_matrird; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT uk_sgd_mrd_matrird UNIQUE (depe_codi, sgd_srd_codigo, sgd_sbrd_codigo, sgd_tpr_codigo);


--
-- TOC entry 2378 (class 2606 OID 17161)
-- Dependencies: 1847 1847 1847 1847
-- Name: uk_sgd_rdf_retdocf; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_rdf_retdocf
    ADD CONSTRAINT uk_sgd_rdf_retdocf UNIQUE (radi_nume_radi, depe_codi, sgd_mrd_codigo);


--
-- TOC entry 2384 (class 2606 OID 17163)
-- Dependencies: 1852 1852 1852
-- Name: uk_sgd_sbrd_subserierd; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_sbrd_subserierd
    ADD CONSTRAINT uk_sgd_sbrd_subserierd UNIQUE (sgd_srd_codigo, sgd_sbrd_codigo);


--
-- TOC entry 2394 (class 2606 OID 17165)
-- Dependencies: 1856 1856
-- Name: uk_sgd_srd_descrip; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_srd_seriesrd
    ADD CONSTRAINT uk_sgd_srd_descrip UNIQUE (sgd_srd_descrip);


--
-- TOC entry 2420 (class 2606 OID 17167)
-- Dependencies: 1873 1873
-- Name: usuario_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pk PRIMARY KEY (usua_login);


--
-- TOC entry 2422 (class 2606 OID 17169)
-- Dependencies: 1873 1873 1873
-- Name: usuario_uk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_uk UNIQUE (usua_codi, depe_codi);


--
-- TOC entry 2423 (class 2606 OID 17170)
-- Dependencies: 2223 1748 1749
-- Name: fk_anex_hist_anex_codi; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anexos_historico
    ADD CONSTRAINT fk_anex_hist_anex_codi FOREIGN KEY (anex_hist_anex_codi) REFERENCES anexos(anex_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2424 (class 2606 OID 17175)
-- Dependencies: 1757 1757 2239
-- Name: fk_depe_padre; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT fk_depe_padre FOREIGN KEY (depe_codi_padre) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2425 (class 2606 OID 17180)
-- Dependencies: 2239 1757 1762
-- Name: fk_hist_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY hist_eventos
    ADD CONSTRAINT fk_hist_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2426 (class 2606 OID 17185)
-- Dependencies: 1757 2239 1763
-- Name: fk_info_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY informados
    ADD CONSTRAINT fk_info_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2427 (class 2606 OID 17190)
-- Dependencies: 1765 2237 1756
-- Name: fk_municipi_ref_128_departam; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT fk_municipi_ref_128_departam FOREIGN KEY (dpto_codi) REFERENCES departamento(dpto_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2448 (class 2606 OID 17195)
-- Dependencies: 2301 1804 1803
-- Name: fk_paises_continentes; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_def_paises
    ADD CONSTRAINT fk_paises_continentes FOREIGN KEY (id_cont) REFERENCES sgd_def_continentes(id_cont) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2429 (class 2606 OID 17200)
-- Dependencies: 1757 2239 1770
-- Name: fk_pl_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY plantilla_pl
    ADD CONSTRAINT fk_pl_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2428 (class 2606 OID 17205)
-- Dependencies: 2239 1757 1767
-- Name: fk_plg_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pl_generado_plg
    ADD CONSTRAINT fk_plg_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2430 (class 2606 OID 17210)
-- Dependencies: 2239 1771 1757
-- Name: fk_prestamo_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT fk_prestamo_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2431 (class 2606 OID 17215)
-- Dependencies: 2239 1757 1771
-- Name: fk_prestamo_depe_arch; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT fk_prestamo_depe_arch FOREIGN KEY (pres_depe_arch) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2432 (class 2606 OID 17220)
-- Dependencies: 1755 1755 1772 1772 2235 1755 1772
-- Name: fk_radi_cpob; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT fk_radi_cpob FOREIGN KEY (cpob_codi, cen_muni_codi, cen_dpto_codi) REFERENCES centro_poblado(cpob_codi, muni_codi, dpto_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2433 (class 2606 OID 17225)
-- Dependencies: 1760 2245 1772
-- Name: fk_radi_esta; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT fk_radi_esta FOREIGN KEY (esta_codi) REFERENCES estado(esta_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2434 (class 2606 OID 17230)
-- Dependencies: 1772 2247 1764
-- Name: fk_radi_mrec; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT fk_radi_mrec FOREIGN KEY (mrec_codi) REFERENCES medio_recepcion(mrec_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2435 (class 2606 OID 17235)
-- Dependencies: 2249 1772 1772 1765 1765
-- Name: fk_radi_muni; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT fk_radi_muni FOREIGN KEY (muni_codi, dpto_codi) REFERENCES municipio(muni_codi, dpto_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2439 (class 2606 OID 17240)
-- Dependencies: 2259 1784 1772
-- Name: fk_radicado_nume; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_anu_anulados
    ADD CONSTRAINT fk_radicado_nume FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2436 (class 2606 OID 17245)
-- Dependencies: 1772 1766 2251
-- Name: fk_radicado_par_serv; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT fk_radicado_par_serv FOREIGN KEY (par_serv_secue) REFERENCES par_serv_servicios(par_serv_secue) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2476 (class 2606 OID 17250)
-- Dependencies: 2367 1841 1855
-- Name: fk_sexp_secexp_pexp_codigo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_sexp_secexpedientes
    ADD CONSTRAINT fk_sexp_secexp_pexp_codigo FOREIGN KEY (sgd_pexp_codigo) REFERENCES sgd_pexp_procexpedientes(sgd_pexp_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2438 (class 2606 OID 17255)
-- Dependencies: 2223 1748 1783
-- Name: fk_sgd_anar_anexos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_anar_anexarg
    ADD CONSTRAINT fk_sgd_anar_anexos FOREIGN KEY (anex_codigo) REFERENCES anexos(anex_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2480 (class 2606 OID 17260)
-- Dependencies: 1873 2271 1785
-- Name: fk_sgd_aper_adminp; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_sgd_aper_adminp FOREIGN KEY (sgd_aper_codigo) REFERENCES sgd_aper_adminperfiles(sgd_aper_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2440 (class 2606 OID 17265)
-- Dependencies: 1788 2275 1787
-- Name: fk_sgd_aplmen_sgd_apli; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_aplmen_aplimens
    ADD CONSTRAINT fk_sgd_aplmen_sgd_apli FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2443 (class 2606 OID 17270)
-- Dependencies: 2259 1772 1796
-- Name: fk_sgd_caux_radicado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_caux_causales
    ADD CONSTRAINT fk_sgd_caux_radicado FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2444 (class 2606 OID 17275)
-- Dependencies: 1797 1797 1765 1765 2249
-- Name: fk_sgd_ciu_municipio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ciu_ciudadano
    ADD CONSTRAINT fk_sgd_ciu_municipio FOREIGN KEY (muni_codi, dpto_codi) REFERENCES municipio(muni_codi, dpto_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2445 (class 2606 OID 17280)
-- Dependencies: 2289 1795 1800
-- Name: fk_sgd_dcau_sgd_cau_; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dcau_causal
    ADD CONSTRAINT fk_sgd_dcau_sgd_cau_ FOREIGN KEY (sgd_cau_codigo) REFERENCES sgd_cau_causal(sgd_cau_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2446 (class 2606 OID 17285)
-- Dependencies: 2251 1766 1801
-- Name: fk_sgd_ddca_ref_678_par_serv; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ddca_ddsgrgdo
    ADD CONSTRAINT fk_sgd_ddca_ref_678_par_serv FOREIGN KEY (par_serv_secue) REFERENCES par_serv_servicios(par_serv_secue) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2447 (class 2606 OID 17290)
-- Dependencies: 1800 1801 2297
-- Name: fk_sgd_ddca_sgd_dcau; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ddca_ddsgrgdo
    ADD CONSTRAINT fk_sgd_ddca_sgd_dcau FOREIGN KEY (sgd_dcau_codigo) REFERENCES sgd_dcau_causal(sgd_dcau_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2449 (class 2606 OID 17295)
-- Dependencies: 1765 2249 1765 1806 1806
-- Name: fk_sgd_dir_municipio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT fk_sgd_dir_municipio FOREIGN KEY (muni_codi, dpto_codi) REFERENCES municipio(muni_codi, dpto_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2450 (class 2606 OID 17300)
-- Dependencies: 1806 1772 2259
-- Name: fk_sgd_dir_radicado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT fk_sgd_dir_radicado FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2451 (class 2606 OID 17305)
-- Dependencies: 2293 1806 1797
-- Name: fk_sgd_dir_sgd_ciu; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT fk_sgd_dir_sgd_ciu FOREIGN KEY (sgd_ciu_codigo) REFERENCES sgd_ciu_ciudadano(sgd_ciu_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2452 (class 2606 OID 17310)
-- Dependencies: 1807 1750 2227
-- Name: fk_sgd_dnufe_anex_tipo; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dnufe_docnufe
    ADD CONSTRAINT fk_sgd_dnufe_anex_tipo FOREIGN KEY (anex_tipo_codi) REFERENCES anexos_tipo(anex_tipo_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2453 (class 2606 OID 17315)
-- Dependencies: 1814 1787 2275
-- Name: fk_sgd_estinst_sgd_apli; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_estinst_estadoinstancia
    ADD CONSTRAINT fk_sgd_estinst_sgd_apli FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2454 (class 2606 OID 17320)
-- Dependencies: 1815 1757 2239
-- Name: fk_sgd_exp_dependencia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_exp_expediente
    ADD CONSTRAINT fk_sgd_exp_dependencia FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2455 (class 2606 OID 17325)
-- Dependencies: 1815 1772 2259
-- Name: fk_sgd_exp_radicado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_exp_expediente
    ADD CONSTRAINT fk_sgd_exp_radicado FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2456 (class 2606 OID 17330)
-- Dependencies: 1819 1772 2259
-- Name: fk_sgd_firr_ref_82_radicado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_firrad_firmarads
    ADD CONSTRAINT fk_sgd_firr_ref_82_radicado FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2457 (class 2606 OID 17335)
-- Dependencies: 1823 1757 2239
-- Name: fk_sgd_hmtd_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_hmtd_hismatdoc
    ADD CONSTRAINT fk_sgd_hmtd_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2458 (class 2606 OID 17340)
-- Dependencies: 1823 1772 2259
-- Name: fk_sgd_hmtd_radicado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_hmtd_hismatdoc
    ADD CONSTRAINT fk_sgd_hmtd_radicado FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2459 (class 2606 OID 17345)
-- Dependencies: 1825 1757 2239
-- Name: fk_sgd_lip__ref_27_dependen; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_lip_linkip
    ADD CONSTRAINT fk_sgd_lip__ref_27_dependen FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2460 (class 2606 OID 17350)
-- Dependencies: 1827 1757 2239
-- Name: fk_sgd_mat_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT fk_sgd_mat_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2461 (class 2606 OID 17355)
-- Dependencies: 1827 1821 2331
-- Name: fk_sgd_mat_sgd_fun; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT fk_sgd_mat_sgd_fun FOREIGN KEY (sgd_fun_codigo) REFERENCES sgd_fun_funciones(sgd_fun_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2462 (class 2606 OID 17360)
-- Dependencies: 1829 1757 2239
-- Name: fk_sgd_mrd_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT fk_sgd_mrd_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2463 (class 2606 OID 17365)
-- Dependencies: 1830 1757 2239
-- Name: fk_sgd_msde_ref_27_dependen; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_msdep_msgdep
    ADD CONSTRAINT fk_sgd_msde_ref_27_dependen FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2464 (class 2606 OID 17370)
-- Dependencies: 1832 1827 2339
-- Name: fk_sgd_mtd_sgd_mtd; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mtd_matriz_doc
    ADD CONSTRAINT fk_sgd_mtd_sgd_mtd FOREIGN KEY (sgd_mat_codigo) REFERENCES sgd_mat_matriz(sgd_mat_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2466 (class 2606 OID 17375)
-- Dependencies: 2259 1836 1772
-- Name: fk_sgd_ntrd_notifrad_radicado; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ntrd_notifrad
    ADD CONSTRAINT fk_sgd_ntrd_notifrad_radicado FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2467 (class 2606 OID 17380)
-- Dependencies: 1837 1837 1765 1765 2249
-- Name: fk_sgd_oem_municipio; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_oem_oempresas
    ADD CONSTRAINT fk_sgd_oem_municipio FOREIGN KEY (muni_codi, dpto_codi) REFERENCES municipio(muni_codi, dpto_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2468 (class 2606 OID 17385)
-- Dependencies: 1840 1757 2239
-- Name: fk_sgd_parexp_depe_codi; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_parexp_paramexpediente
    ADD CONSTRAINT fk_sgd_parexp_depe_codi FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE CASCADE;


--
-- TOC entry 2469 (class 2606 OID 17390)
-- Dependencies: 1843 1757 2239
-- Name: fk_sgd_pnun_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_pnun_procenum
    ADD CONSTRAINT fk_sgd_pnun_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2470 (class 2606 OID 17395)
-- Dependencies: 1843 1842 2369
-- Name: fk_sgd_pnun_sgd_pnufe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_pnun_procenum
    ADD CONSTRAINT fk_sgd_pnun_sgd_pnufe FOREIGN KEY (sgd_pnufe_codi) REFERENCES sgd_pnufe_procnumfe(sgd_pnufe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2471 (class 2606 OID 17400)
-- Dependencies: 1757 1847 2239
-- Name: fk_sgd_rdf_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_rdf_retdocf
    ADD CONSTRAINT fk_sgd_rdf_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2472 (class 2606 OID 17405)
-- Dependencies: 1829 1847 2345
-- Name: fk_sgd_rdf_trd; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_rdf_retdocf
    ADD CONSTRAINT fk_sgd_rdf_trd FOREIGN KEY (sgd_mrd_codigo) REFERENCES sgd_mrd_matrird(sgd_mrd_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2473 (class 2606 OID 17410)
-- Dependencies: 1757 1848 2239
-- Name: fk_sgd_renv_dependecia; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_renv_regenvio
    ADD CONSTRAINT fk_sgd_renv_dependecia FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2474 (class 2606 OID 17415)
-- Dependencies: 1848 2305 1805
-- Name: fk_sgd_renv_sgd_deve; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_renv_regenvio
    ADD CONSTRAINT fk_sgd_renv_sgd_deve FOREIGN KEY (sgd_deve_codigo) REFERENCES sgd_deve_dev_envio(sgd_deve_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2475 (class 2606 OID 17420)
-- Dependencies: 1848 2307 1806
-- Name: fk_sgd_renv_sgd_dir; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_renv_regenvio
    ADD CONSTRAINT fk_sgd_renv_sgd_dir FOREIGN KEY (sgd_dir_codigo) REFERENCES sgd_dir_drecciones(sgd_dir_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2477 (class 2606 OID 17425)
-- Dependencies: 2275 1787 1858
-- Name: fk_sgd_tdec_tipodecision_apli; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_tdec_tipodecision
    ADD CONSTRAINT fk_sgd_tdec_tipodecision_apli FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2478 (class 2606 OID 17430)
-- Dependencies: 1863 2239 1757
-- Name: fk_sgd_tma_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_tma_temas
    ADD CONSTRAINT fk_sgd_tma_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2479 (class 2606 OID 17435)
-- Dependencies: 1844 2373 1863
-- Name: fk_sgd_tma_sgd_prc; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_tma_temas
    ADD CONSTRAINT fk_sgd_tma_sgd_prc FOREIGN KEY (sgd_prc_codigo) REFERENCES sgd_prc_proceso(sgd_prc_codigo) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2481 (class 2606 OID 17440)
-- Dependencies: 1757 2239 1873
-- Name: fk_usua_depe; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT fk_usua_depe FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2437 (class 2606 OID 17445)
-- Dependencies: 1782 1772 2259
-- Name: sgd_agen_agendados_r01; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_agen_agendados
    ADD CONSTRAINT sgd_agen_agendados_r01 FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2441 (class 2606 OID 17450)
-- Dependencies: 2275 1787 1789
-- Name: sgd_aplus_sgd_apli; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_aplus_plicusua
    ADD CONSTRAINT sgd_aplus_sgd_apli FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2442 (class 2606 OID 17455)
-- Dependencies: 1794 2239 1757
-- Name: sgd_carp_descripcion_fk1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_carp_descripcion
    ADD CONSTRAINT sgd_carp_descripcion_fk1 FOREIGN KEY (sgd_carp_depecodi) REFERENCES dependencia(depe_codi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2465 (class 2606 OID 17460)
-- Dependencies: 2259 1833 1772
-- Name: sgd_nfn_notifijacion_radi_fk1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_nfn_notifijacion
    ADD CONSTRAINT sgd_nfn_notifijacion_radi_fk1 FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi) ON UPDATE RESTRICT ON DELETE RESTRICT;


--
-- TOC entry 2606 (class 0 OID 0)
-- Dependencies: 6
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;

ALTER TABLE public.sgd_argup_argudoctop OWNER TO postgres;

--
-- TOC entry 1827 (class 1259 OID 17818)
-- Dependencies: 3
-- Name: sgd_auditoria; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_auditoria (
    usua_doc character varying(50),
    tipo character varying(20),
    tabla character varying(50),
    isql character varying(1000),
    fecha numeric(20,0),
    ip character varying(40)
);



-- Completed on 2009-05-27 14:42:19 COT

--
-- PostgreSQL database dump complete
--

CREATE TABLE sgd_empus_empusuario
(
  sgd_empus_codigo numeric(5) NOT NULL,
  sgd_empus_estado character(1),
  usua_login character varying(40) NOT NULL,
  identificador_empresa numeric(5) NOT NULL,
  CONSTRAINT PK_SGD_EMPUS_USUARIO PRIMARY KEY (sgd_empus_codigo),
  CONSTRAINT fk_usuario FOREIGN KEY (usua_login)
      REFERENCES usuario (usua_login) MATCH SIMPLE
      ON UPDATE NO ACTION ON DELETE NO ACTION
)
