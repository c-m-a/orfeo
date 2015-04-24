--
-- PostgreSQL database dump
--

-- Started on 2009-07-03 15:45:04

SET client_encoding = 'WIN1252';
SET standard_conforming_strings = off;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET escape_string_warning = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 1799 (class 1259 OID 17358)
-- Dependencies: 2151 2152 2153 2154 3
-- Name: anexos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos (
    anex_radi_nume bigint NOT NULL,
    anex_codigo character varying(20) NOT NULL,
    anex_tipo smallint,
    anex_tamano integer,
    anex_solo_lect character varying(1),
    anex_creador character varying(15),
    anex_desc character varying(512),
    anex_numero integer,
    anex_nomb_archivo character varying(50),
    anex_borrado character varying(1),
    anex_origen smallint DEFAULT 0,
    anex_ubic character varying(15),
    anex_salida smallint DEFAULT 0,
    radi_nume_salida bigint,
    anex_radi_fech date,
    anex_estado smallint DEFAULT 0,
    usua_doc character varying(14),
    sgd_rem_destino smallint DEFAULT 0,
    anex_fech_envio date,
    sgd_dir_tipo smallint,
    anex_fech_impres date,
    anex_depe_creador smallint,
    sgd_doc_secuencia bigint,
    sgd_doc_padre character varying(20),
    sgd_arg_codigo smallint,
    sgd_tpr_codigo smallint,
    sgd_deve_codigo smallint,
    sgd_deve_fech date,
    sgd_fech_impres date,
    anex_fech_anex date,
    anex_depe_codi character varying(3),
    sgd_pnufe_codi smallint,
    sgd_dnufe_codi smallint,
    anex_usudoc_creador character varying(15),
    sgd_fech_doc date,
    sgd_apli_codi smallint,
    sgd_trad_codigo smallint,
    sgd_dir_direccion character varying(150),
    muni_codi smallint,
    dpto_codi smallint,
    sgd_exp_numero character varying(18)
);


ALTER TABLE public.anexos OWNER TO postgres;

--
-- TOC entry 1800 (class 1259 OID 17378)
-- Dependencies: 3
-- Name: anexos_historico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos_historico (
    anex_hist_anex_codi character varying(20) NOT NULL,
    anex_hist_num_ver smallint NOT NULL,
    anex_hist_tipo_mod character varying(2) NOT NULL,
    anex_hist_usua character varying(15) NOT NULL,
    anex_hist_fecha date NOT NULL,
    usua_doc character varying(14)
);


ALTER TABLE public.anexos_historico OWNER TO postgres;

--
-- TOC entry 1706 (class 1259 OID 16404)
-- Dependencies: 3
-- Name: anexos_tipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos_tipo (
    anex_tipo_codi smallint NOT NULL,
    anex_tipo_ext character varying(10) NOT NULL,
    anex_tipo_desc character varying(50)
);


ALTER TABLE public.anexos_tipo OWNER TO postgres;

--
-- TOC entry 1707 (class 1259 OID 16410)
-- Dependencies: 2095 2096 2097 3
-- Name: bodega_empresas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bodega_empresas (
    nombre_de_la_empresa character varying(160),
    nuir character varying(13),
    nit_de_la_empresa character varying(80),
    sigla_de_la_empresa character varying(80),
    direccion character varying(80),
    codigo_del_departamento smallint,
    codigo_del_municipio smallint,
    telefono_1 character varying(15),
    telefono_2 character varying(15),
    email character varying(50),
    nombre_rep_legal character varying(72),
    cargo_rep_legal character varying(50),
    identificador_empresa integer NOT NULL,
    are_esp_secue integer NOT NULL,
    id_cont smallint DEFAULT 1,
    id_pais smallint DEFAULT 170,
    activa smallint DEFAULT 1,
    flag_rups character varying(1)
);


ALTER TABLE public.bodega_empresas OWNER TO postgres;

--
-- TOC entry 1708 (class 1259 OID 16426)
-- Dependencies: 3
-- Name: carpeta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE carpeta (
    carp_codi smallint NOT NULL,
    carp_desc character varying(80) NOT NULL
);


ALTER TABLE public.carpeta OWNER TO postgres;

--
-- TOC entry 1778 (class 1259 OID 16935)
-- Dependencies: 3
-- Name: carpeta_per; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE carpeta_per (
    usua_codi smallint NOT NULL,
    depe_codi smallint NOT NULL,
    nomb_carp character varying(10),
    desc_carp character varying(30),
    codi_carp smallint NOT NULL
);


ALTER TABLE public.carpeta_per OWNER TO postgres;

--
-- TOC entry 1775 (class 1259 OID 16892)
-- Dependencies: 2108 2109 3
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE departamento (
    id_cont smallint DEFAULT 1 NOT NULL,
    id_pais smallint DEFAULT 170 NOT NULL,
    dpto_codi smallint NOT NULL,
    dpto_nomb character varying(70) NOT NULL
);


ALTER TABLE public.departamento OWNER TO postgres;

--
-- TOC entry 1777 (class 1259 OID 16916)
-- Dependencies: 2111 2112 2113 3
-- Name: dependencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dependencia (
    depe_codi smallint NOT NULL,
    depe_nomb character varying(70) NOT NULL,
    dpto_codi smallint,
    depe_codi_padre smallint,
    muni_codi smallint,
    depe_codi_territorial smallint,
    dep_sigla character varying(100),
    dep_central smallint,
    dep_direccion character varying(100),
    depe_num_interna smallint,
    depe_num_resolucion smallint,
    depe_rad_tp1 smallint,
    depe_rad_tp2 smallint,
    id_cont smallint DEFAULT 1,
    id_pais smallint DEFAULT 170,
    depe_estado smallint DEFAULT 1
);


ALTER TABLE public.dependencia OWNER TO postgres;

--
-- TOC entry 1779 (class 1259 OID 16947)
-- Dependencies: 3
-- Name: dependencia_visibilidad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dependencia_visibilidad (
    codigo_visibilidad bigint NOT NULL,
    dependencia_visible smallint NOT NULL,
    dependencia_observa smallint NOT NULL
);


ALTER TABLE public.dependencia_visibilidad OWNER TO postgres;

--
-- TOC entry 1709 (class 1259 OID 16432)
-- Dependencies: 3
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estado (
    esta_codi smallint NOT NULL,
    esta_desc character varying(100) NOT NULL
);


ALTER TABLE public.estado OWNER TO postgres;

--
-- TOC entry 1801 (class 1259 OID 17394)
-- Dependencies: 3
-- Name: hist_eventos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE hist_eventos (
    depe_codi smallint NOT NULL,
    hist_fech date NOT NULL,
    usua_codi bigint NOT NULL,
    radi_nume_radi bigint NOT NULL,
    hist_obse character varying(600) NOT NULL,
    usua_codi_dest bigint,
    usua_doc character varying(14),
    usua_doc_old character varying(15),
    sgd_ttr_codigo smallint,
    hist_usua_autor character varying(14),
    hist_doc_dest character varying(14),
    depe_codi_dest smallint
);


ALTER TABLE public.hist_eventos OWNER TO postgres;

--
-- TOC entry 1802 (class 1259 OID 17409)
-- Dependencies: 2155 3
-- Name: informados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE informados (
    radi_nume_radi bigint NOT NULL,
    usua_codi bigint NOT NULL,
    depe_codi smallint NOT NULL,
    info_desc character varying(600),
    info_fech date NOT NULL,
    info_leido smallint DEFAULT 0,
    usua_codi_info smallint,
    info_codi bigint,
    usua_doc character varying(14)
);


ALTER TABLE public.informados OWNER TO postgres;

--
-- TOC entry 1710 (class 1259 OID 16438)
-- Dependencies: 3
-- Name: medio_recepcion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE medio_recepcion (
    mrec_codi smallint NOT NULL,
    mrec_desc character varying(100) NOT NULL
);


ALTER TABLE public.medio_recepcion OWNER TO postgres;

--
-- TOC entry 1776 (class 1259 OID 16904)
-- Dependencies: 2110 3
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE municipio (
    id_cont smallint NOT NULL,
    id_pais smallint NOT NULL,
    dpto_codi smallint NOT NULL,
    muni_codi smallint NOT NULL,
    muni_nomb character varying(100) NOT NULL,
    homologa_muni character varying(10),
    homologa_idmuni smallint,
    activa smallint DEFAULT 1
);


ALTER TABLE public.municipio OWNER TO postgres;

--
-- TOC entry 1711 (class 1259 OID 16444)
-- Dependencies: 3
-- Name: par_serv_servicios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE par_serv_servicios (
    par_serv_secue integer NOT NULL,
    par_serv_codigo character varying(5),
    par_serv_nombre character varying(100),
    par_serv_estado character varying(1)
);


ALTER TABLE public.par_serv_servicios OWNER TO postgres;

--
-- TOC entry 1803 (class 1259 OID 17425)
-- Dependencies: 3
-- Name: prestamo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE prestamo (
    pres_id bigint NOT NULL,
    radi_nume_radi bigint NOT NULL,
    usua_login_actu character varying(15) NOT NULL,
    depe_codi smallint NOT NULL,
    usua_login_pres character varying(15),
    pres_desc character varying(200),
    pres_fech_pres date,
    pres_fech_devo date,
    pres_fech_pedi date NOT NULL,
    pres_estado smallint,
    pres_requerimiento smallint,
    pres_depe_arch smallint,
    pres_fech_venc date,
    dev_desc character varying(500),
    pres_fech_canc date,
    usua_login_canc character varying(15),
    usua_login_rx character varying(15)
);


ALTER TABLE public.prestamo OWNER TO postgres;

--
-- TOC entry 1798 (class 1259 OID 17281)
-- Dependencies: 2141 2142 2143 2144 2145 2146 2147 2148 2149 2150 3
-- Name: radicado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radicado (
    radi_nume_radi numeric(19,0) NOT NULL,
    radi_fech_radi date NOT NULL,
    tdoc_codi smallint NOT NULL,
    trte_codi smallint,
    mrec_codi smallint,
    eesp_codi bigint,
    eotra_codi bigint,
    radi_tipo_empr character varying(2),
    radi_fech_ofic date,
    tdid_codi smallint,
    radi_nume_iden character varying(15),
    radi_nomb character varying(90),
    radi_prim_apel character varying(50),
    radi_segu_apel character varying(50),
    radi_pais character varying(70),
    muni_codi smallint,
    cpob_codi smallint,
    carp_codi smallint,
    esta_codi smallint,
    dpto_codi smallint,
    cen_muni_codi smallint,
    cen_dpto_codi smallint,
    radi_dire_corr character varying(100),
    radi_tele_cont bigint,
    radi_nume_hoja smallint,
    radi_desc_anex character varying(100),
    radi_nume_deri bigint,
    radi_path character varying(100),
    radi_usua_actu bigint,
    radi_depe_actu smallint,
    radi_fech_asig date,
    radi_arch1 character varying(10),
    radi_arch2 character varying(10),
    radi_arch3 character varying(10),
    radi_arch4 character varying(10),
    ra_asun character varying(350),
    radi_usu_ante character varying(45),
    radi_depe_radi smallint,
    radi_rem character varying(60),
    radi_usua_radi bigint,
    codi_nivel smallint DEFAULT 1,
    flag_nivel integer DEFAULT 1,
    carp_per smallint DEFAULT 0,
    radi_leido smallint DEFAULT 0,
    radi_cuentai character varying(20),
    radi_tipo_deri smallint DEFAULT 0,
    listo character varying(2),
    sgd_tma_codigo smallint,
    sgd_mtd_codigo smallint,
    par_serv_secue integer,
    sgd_fld_codigo smallint DEFAULT 0,
    radi_agend smallint,
    radi_fech_agend date,
    radi_fech_doc date,
    sgd_doc_secuencia bigint,
    sgd_pnufe_codi smallint,
    sgd_eanu_codigo smallint,
    sgd_not_codi smallint,
    radi_fech_notif date,
    sgd_tdec_codigo smallint,
    sgd_apli_codi smallint,
    sgd_ttr_codigo smallint DEFAULT 0,
    usua_doc_ante character varying(14),
    radi_fech_antetx date,
    sgd_trad_codigo smallint,
    fech_vcmto date,
    tdoc_vcmto smallint,
    sgd_termino_real smallint,
    id_cont smallint DEFAULT 1,
    sgd_spub_codigo smallint DEFAULT 0,
    id_pais smallint DEFAULT 170,
    medio_m character varying(100)
);


ALTER TABLE public.radicado OWNER TO postgres;

--
-- TOC entry 1712 (class 1259 OID 16450)
-- Dependencies: 3
-- Name: series; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE series (
    depe_codi integer NOT NULL,
    seri_nume integer NOT NULL,
    seri_tipo smallint NOT NULL,
    seri_ano smallint NOT NULL,
    dpto_codi smallint NOT NULL,
    bloq character varying(20)
);


ALTER TABLE public.series OWNER TO postgres;

--
-- TOC entry 1804 (class 1259 OID 17456)
-- Dependencies: 3
-- Name: sgd_acm_acusemsg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_acm_acusemsg (
    sgd_msg_codi bigint NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_msg_leido smallint
);


ALTER TABLE public.sgd_acm_acusemsg OWNER TO postgres;

--
-- TOC entry 1737 (class 1259 OID 16603)
-- Dependencies: 3
-- Name: sgd_actadd_actualiadicional; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_actadd_actualiadicional (
    sgd_actadd_codi smallint NOT NULL,
    sgd_apli_codi smallint,
    sgd_instorf_codi smallint,
    sgd_actadd_query character varying(500),
    sgd_actadd_desc character varying(150)
);


ALTER TABLE public.sgd_actadd_actualiadicional OWNER TO postgres;

--
-- TOC entry 1781 (class 1259 OID 17002)
-- Dependencies: 3
-- Name: sgd_admin_depe_historico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_admin_depe_historico (
    admin_depe_historico_codigo bigint NOT NULL,
    usuario_codigo_administrador bigint NOT NULL,
    dependencia_codigo_administrador smallint NOT NULL,
    usuario_documento_administrador character varying(14) NOT NULL,
    dependencia_modificada smallint NOT NULL,
    admin_observacion_codigo bigint NOT NULL,
    admin_fecha_evento date NOT NULL
);


ALTER TABLE public.sgd_admin_depe_historico OWNER TO postgres;

--
-- TOC entry 1713 (class 1259 OID 16457)
-- Dependencies: 3
-- Name: sgd_admin_dependencia_estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_admin_dependencia_estado (
    codigo_estado bigint NOT NULL,
    descripcion_estado character varying(50) NOT NULL
);


ALTER TABLE public.sgd_admin_dependencia_estado OWNER TO postgres;

--
-- TOC entry 1714 (class 1259 OID 16462)
-- Dependencies: 3
-- Name: sgd_admin_observacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_admin_observacion (
    codigo_observacion bigint NOT NULL,
    descripcion_observacion character varying(500) NOT NULL
);


ALTER TABLE public.sgd_admin_observacion OWNER TO postgres;

--
-- TOC entry 1782 (class 1259 OID 17012)
-- Dependencies: 3
-- Name: sgd_admin_usua_historico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_admin_usua_historico (
    admin_historico_codigo bigint NOT NULL,
    usuario_codigo_administrador bigint NOT NULL,
    dependencia_codigo_administrador smallint NOT NULL,
    usuario_documento_administrador character varying(14) NOT NULL,
    usuario_codigo_modificado bigint NOT NULL,
    dependencia_codigo_modificado smallint NOT NULL,
    usuario_documento_modificado character varying(14) NOT NULL,
    admin_observacion_codigo bigint NOT NULL,
    admin_fecha_evento date NOT NULL
);


ALTER TABLE public.sgd_admin_usua_historico OWNER TO postgres;

--
-- TOC entry 1715 (class 1259 OID 16467)
-- Dependencies: 3
-- Name: sgd_admin_usua_perfiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_admin_usua_perfiles (
    codigo_perfil bigint NOT NULL,
    descripcion_perfil character varying(200) NOT NULL
);


ALTER TABLE public.sgd_admin_usua_perfiles OWNER TO postgres;

--
-- TOC entry 1805 (class 1259 OID 17467)
-- Dependencies: 3
-- Name: sgd_agen_agendados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_agen_agendados (
    sgd_agen_fech date,
    sgd_agen_observacion character varying(3000),
    radi_nume_radi bigint NOT NULL,
    usua_doc character varying(18) NOT NULL,
    depe_codi smallint,
    sgd_agen_codigo integer,
    sgd_agen_fechplazo date,
    sgd_agen_activo integer
);


ALTER TABLE public.sgd_agen_agendados OWNER TO postgres;

--
-- TOC entry 1806 (class 1259 OID 17478)
-- Dependencies: 3
-- Name: sgd_anar_anexarg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_anar_anexarg (
    sgd_anar_codi smallint NOT NULL,
    anex_codigo character varying(20),
    sgd_argd_codi smallint,
    sgd_anar_argcod smallint
);


ALTER TABLE public.sgd_anar_anexarg OWNER TO postgres;

--
-- TOC entry 1807 (class 1259 OID 17494)
-- Dependencies: 3
-- Name: sgd_anu_anulados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_anu_anulados (
    sgd_anu_id smallint,
    sgd_anu_desc character varying(250),
    radi_nume_radi bigint,
    sgd_eanu_codi integer,
    sgd_anu_sol_fech date,
    sgd_anu_fech date,
    depe_codi smallint,
    usua_doc character varying(14),
    usua_codi smallint,
    depe_codi_anu smallint,
    usua_doc_anu character varying(14),
    usua_codi_anu smallint,
    usua_anu_acta integer,
    sgd_anu_path_acta character varying(200),
    sgd_trad_codigo smallint
);


ALTER TABLE public.sgd_anu_anulados OWNER TO postgres;

--
-- TOC entry 1752 (class 1259 OID 16752)
-- Dependencies: 3
-- Name: sgd_aper_adminperfiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aper_adminperfiles (
    sgd_aper_codigo smallint NOT NULL,
    sgd_aper_descripcion character varying(20)
);


ALTER TABLE public.sgd_aper_adminperfiles OWNER TO postgres;

--
-- TOC entry 1738 (class 1259 OID 16619)
-- Dependencies: 3
-- Name: sgd_aplfad_plicfunadi; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplfad_plicfunadi (
    sgd_aplfad_codi smallint NOT NULL,
    sgd_apli_codi smallint,
    sgd_aplfad_menu character varying(150) NOT NULL,
    sgd_aplfad_lk1 character varying(150) NOT NULL,
    sgd_aplfad_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_aplfad_plicfunadi OWNER TO postgres;

--
-- TOC entry 1716 (class 1259 OID 16472)
-- Dependencies: 3
-- Name: sgd_apli_aplintegra; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_apli_aplintegra (
    sgd_apli_codi smallint NOT NULL,
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
-- TOC entry 1739 (class 1259 OID 16630)
-- Dependencies: 3
-- Name: sgd_aplmen_aplimens; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplmen_aplimens (
    sgd_aplmen_codi smallint NOT NULL,
    sgd_apli_codi smallint,
    sgd_aplmen_ref character varying(20),
    sgd_aplmen_haciaorfeo smallint,
    sgd_aplmen_desdeorfeo smallint
);


ALTER TABLE public.sgd_aplmen_aplimens OWNER TO postgres;

--
-- TOC entry 1740 (class 1259 OID 16641)
-- Dependencies: 3
-- Name: sgd_aplus_plicusua; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplus_plicusua (
    sgd_aplus_codi smallint NOT NULL,
    sgd_apli_codi smallint,
    usua_doc character varying(14),
    sgd_trad_codigo smallint,
    sgd_aplus_prioridad smallint
);


ALTER TABLE public.sgd_aplus_plicusua OWNER TO postgres;

--
-- TOC entry 1824 (class 1259 OID 17741)
-- Dependencies: 3
-- Name: sgd_arch_depe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_arch_depe (
    sgd_arch_depe character varying(6),
    sgd_arch_edificio numeric(6,0),
    sgd_arch_item numeric(6,0),
    sgd_arch_id numeric NOT NULL
);


ALTER TABLE public.sgd_arch_depe OWNER TO postgres;

--
-- TOC entry 1763 (class 1259 OID 16820)
-- Dependencies: 3
-- Name: sgd_arg_pliego; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_arg_pliego (
    sgd_arg_codigo smallint NOT NULL,
    sgd_arg_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_arg_pliego OWNER TO postgres;

--
-- TOC entry 1717 (class 1259 OID 16478)
-- Dependencies: 3
-- Name: sgd_argd_argdoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_argd_argdoc (
    sgd_argd_codi smallint NOT NULL,
    sgd_pnufe_codi smallint,
    sgd_argd_tabla character varying(100),
    sgd_argd_tcodi character varying(100),
    sgd_argd_tdes character varying(100),
    sgd_argd_llist character varying(150),
    sgd_argd_campo character varying(100)
);


ALTER TABLE public.sgd_argd_argdoc OWNER TO postgres;

--
-- TOC entry 1756 (class 1259 OID 16779)
-- Dependencies: 3
-- Name: sgd_argup_argudoctop; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_argup_argudoctop (
    sgd_argup_codi smallint NOT NULL,
    sgd_argup_desc character varying(50),
    sgd_tpr_codigo smallint
);


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


ALTER TABLE public.sgd_auditoria OWNER TO postgres;

--
-- TOC entry 1795 (class 1259 OID 17247)
-- Dependencies: 2140 3
-- Name: sgd_camexp_campoexpediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_camexp_campoexpediente (
    sgd_camexp_codigo smallint NOT NULL,
    sgd_camexp_campo character varying(30) NOT NULL,
    sgd_parexp_codigo smallint NOT NULL,
    sgd_camexp_fk integer DEFAULT 0,
    sgd_camexp_tablafk character varying(30),
    sgd_camexp_campofk character varying(30),
    sgd_camexp_campovalor character varying(30),
    sgd_campexp_orden smallint
);


ALTER TABLE public.sgd_camexp_campoexpediente OWNER TO postgres;

--
-- TOC entry 1783 (class 1259 OID 17032)
-- Dependencies: 3
-- Name: sgd_carp_descripcion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_carp_descripcion (
    sgd_carp_depecodi smallint NOT NULL,
    sgd_carp_tiporad smallint NOT NULL,
    sgd_carp_descr character varying(40)
);


ALTER TABLE public.sgd_carp_descripcion OWNER TO postgres;

--
-- TOC entry 1718 (class 1259 OID 16484)
-- Dependencies: 3
-- Name: sgd_cau_causal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_cau_causal (
    sgd_cau_codigo smallint NOT NULL,
    sgd_cau_descrip character varying(150)
);


ALTER TABLE public.sgd_cau_causal OWNER TO postgres;

--
-- TOC entry 1808 (class 1259 OID 17507)
-- Dependencies: 3
-- Name: sgd_caux_causales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_caux_causales (
    sgd_caux_codigo bigint NOT NULL,
    radi_nume_radi bigint,
    sgd_dcau_codigo smallint,
    sgd_ddca_codigo smallint,
    sgd_caux_fecha date,
    usua_doc character varying(14)
);


ALTER TABLE public.sgd_caux_causales OWNER TO postgres;

--
-- TOC entry 1785 (class 1259 OID 17074)
-- Dependencies: 2135 2136 3
-- Name: sgd_ciu_ciudadano; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ciu_ciudadano (
    tdid_codi smallint,
    sgd_ciu_codigo integer NOT NULL,
    sgd_ciu_nombre character varying(150),
    sgd_ciu_direccion character varying(150),
    sgd_ciu_apell1 character varying(50),
    sgd_ciu_apell2 character varying(50),
    sgd_ciu_telefono character varying(50),
    sgd_ciu_email character varying(50),
    muni_codi smallint,
    dpto_codi smallint,
    sgd_ciu_cedula character varying(13),
    id_cont smallint DEFAULT 1,
    id_pais smallint DEFAULT 170
);


ALTER TABLE public.sgd_ciu_ciudadano OWNER TO postgres;

--
-- TOC entry 1770 (class 1259 OID 16862)
-- Dependencies: 3
-- Name: sgd_clta_clstarif; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_clta_clstarif (
    sgd_fenv_codigo integer,
    sgd_clta_codser integer,
    sgd_tar_codigo integer,
    sgd_clta_descrip character varying(100),
    sgd_clta_pesdes bigint,
    sgd_clta_peshast bigint
);


ALTER TABLE public.sgd_clta_clstarif OWNER TO postgres;

--
-- TOC entry 1755 (class 1259 OID 16768)
-- Dependencies: 3
-- Name: sgd_cob_campobliga; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_cob_campobliga (
    sgd_cob_codi smallint NOT NULL,
    sgd_cob_desc character varying(150),
    sgd_cob_label character varying(50),
    sgd_tidm_codi smallint
);


ALTER TABLE public.sgd_cob_campobliga OWNER TO postgres;

--
-- TOC entry 1741 (class 1259 OID 16652)
-- Dependencies: 3
-- Name: sgd_dcau_causal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dcau_causal (
    sgd_dcau_codigo smallint NOT NULL,
    sgd_cau_codigo smallint,
    sgd_dcau_descrip character varying(150)
);


ALTER TABLE public.sgd_dcau_causal OWNER TO postgres;

--
-- TOC entry 1742 (class 1259 OID 16663)
-- Dependencies: 3
-- Name: sgd_ddca_ddsgrgdo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ddca_ddsgrgdo (
    sgd_ddca_codigo smallint NOT NULL,
    sgd_dcau_codigo smallint,
    par_serv_secue integer,
    sgd_ddca_descrip character varying(150)
);


ALTER TABLE public.sgd_ddca_ddsgrgdo OWNER TO postgres;

--
-- TOC entry 1743 (class 1259 OID 16678)
-- Dependencies: 3
-- Name: sgd_def_contactos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_contactos (
    ctt_id bigint NOT NULL,
    ctt_nombre character varying(60) NOT NULL,
    ctt_cargo character varying(60) NOT NULL,
    ctt_telefono character varying(25),
    ctt_id_tipo smallint NOT NULL,
    ctt_id_empresa bigint NOT NULL
);


ALTER TABLE public.sgd_def_contactos OWNER TO postgres;

--
-- TOC entry 1773 (class 1259 OID 16873)
-- Dependencies: 3
-- Name: sgd_def_continentes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_continentes (
    id_cont smallint NOT NULL,
    nombre_cont character varying(20) NOT NULL
);


ALTER TABLE public.sgd_def_continentes OWNER TO postgres;

--
-- TOC entry 1774 (class 1259 OID 16879)
-- Dependencies: 2106 2107 3
-- Name: sgd_def_paises; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_paises (
    id_cont smallint DEFAULT 1 NOT NULL,
    id_pais smallint DEFAULT 170 NOT NULL,
    nombre_pais character varying(30) NOT NULL
);


ALTER TABLE public.sgd_def_paises OWNER TO postgres;

--
-- TOC entry 1744 (class 1259 OID 16681)
-- Dependencies: 3
-- Name: sgd_deve_dev_envio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_deve_dev_envio (
    sgd_deve_codigo smallint NOT NULL,
    sgd_deve_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_deve_dev_envio OWNER TO postgres;

--
-- TOC entry 1815 (class 1259 OID 17631)
-- Dependencies: 2160 2161 3
-- Name: sgd_dir_drecciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dir_drecciones (
    sgd_dir_codigo bigint NOT NULL,
    sgd_dir_tipo smallint NOT NULL,
    sgd_oem_codigo integer,
    sgd_ciu_codigo integer,
    radi_nume_radi bigint,
    sgd_esp_codi integer,
    muni_codi smallint,
    dpto_codi smallint,
    sgd_dir_direccion character varying(150),
    sgd_dir_telefono character varying(50),
    sgd_dir_mail character varying(50),
    sgd_sec_codigo bigint,
    sgd_temporal_nombre character varying(150),
    anex_codigo bigint,
    sgd_anex_codigo character varying(20),
    sgd_dir_nombre character varying(150),
    sgd_doc_fun character varying(14),
    sgd_dir_nomremdes character varying(1000),
    sgd_trd_codigo smallint,
    sgd_dir_tdoc smallint,
    sgd_dir_doc character varying(14),
    id_pais smallint DEFAULT 170,
    id_cont smallint DEFAULT 1
);


ALTER TABLE public.sgd_dir_drecciones OWNER TO postgres;

--
-- TOC entry 1784 (class 1259 OID 17048)
-- Dependencies: 3
-- Name: sgd_dnufe_docnufe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dnufe_docnufe (
    sgd_dnufe_codi smallint NOT NULL,
    sgd_pnufe_codi smallint,
    sgd_tpr_codigo smallint,
    sgd_dnufe_label character varying(150),
    trte_codi smallint,
    sgd_dnufe_main character varying(1),
    sgd_dnufe_path character varying(150),
    sgd_dnufe_gerarq character varying(10),
    anex_tipo_codi smallint
);


ALTER TABLE public.sgd_dnufe_docnufe OWNER TO postgres;

--
-- TOC entry 1771 (class 1259 OID 16865)
-- Dependencies: 3
-- Name: sgd_eanu_estanulacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_eanu_estanulacion (
    sgd_eanu_desc character varying(150),
    sgd_eanu_codi integer NOT NULL
);


ALTER TABLE public.sgd_eanu_estanulacion OWNER TO postgres;

--
-- TOC entry 1719 (class 1259 OID 16490)
-- Dependencies: 3
-- Name: sgd_einv_inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_einv_inventario (
    sgd_einv_codigo integer NOT NULL,
    sgd_depe_nomb character varying(400),
    sgd_depe_codi integer,
    sgd_einv_expnum character varying(18),
    sgd_einv_titulo character varying(400),
    sgd_einv_unidad integer,
    sgd_einv_fech date,
    sgd_einv_fechfin date,
    sgd_einv_radicados character varying(40),
    sgd_einv_folios integer,
    sgd_einv_nundocu integer,
    sgd_einv_nundocubodega integer,
    sgd_einv_caja integer,
    sgd_einv_cajabodega integer,
    sgd_einv_srd integer,
    sgd_einv_nomsrd character varying(400),
    sgd_einv_sbrd integer,
    sgd_einv_nomsbrd character varying(400),
    sgd_einv_retencion character varying(400),
    sgd_einv_disfinal character varying(400),
    sgd_einv_ubicacion character varying(400),
    sgd_einv_observacion character varying(400)
);


ALTER TABLE public.sgd_einv_inventario OWNER TO postgres;

--
-- TOC entry 1720 (class 1259 OID 16499)
-- Dependencies: 3
-- Name: sgd_eit_items; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_eit_items (
    sgd_eit_codigo numeric NOT NULL,
    sgd_eit_nombre character varying(40),
    sgd_eit_sigla character varying(6),
    sgd_eit_cod_padre numeric,
    codi_dpto numeric(4,0),
    codi_muni numeric(5,0)
);


ALTER TABLE public.sgd_eit_items OWNER TO postgres;

--
-- TOC entry 1758 (class 1259 OID 16791)
-- Dependencies: 3
-- Name: sgd_ent_entidades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ent_entidades (
    sgd_ent_nit character varying(13) NOT NULL,
    sgd_ent_codsuc character varying(4) NOT NULL,
    sgd_ent_pias integer,
    dpto_codi smallint,
    muni_codi smallint,
    sgd_ent_descrip character varying(80),
    sgd_ent_direccion character varying(50),
    sgd_ent_telefono character varying(50)
);


ALTER TABLE public.sgd_ent_entidades OWNER TO postgres;

--
-- TOC entry 1769 (class 1259 OID 16854)
-- Dependencies: 3
-- Name: sgd_enve_envioespecial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_enve_envioespecial (
    sgd_fenv_codigo integer,
    sgd_enve_valorl character varying(30),
    sgd_enve_valorn character varying(30),
    sgd_enve_desc character varying(30)
);


ALTER TABLE public.sgd_enve_envioespecial OWNER TO postgres;

--
-- TOC entry 1745 (class 1259 OID 16687)
-- Dependencies: 3
-- Name: sgd_estinst_estadoinstancia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_estinst_estadoinstancia (
    sgd_estinst_codi smallint NOT NULL,
    sgd_apli_codi smallint,
    sgd_instorf_codi smallint,
    sgd_estinst_valor smallint,
    sgd_estinst_habilita smallint,
    sgd_estinst_mensaje character varying(100)
);


ALTER TABLE public.sgd_estinst_estadoinstancia OWNER TO postgres;

--
-- TOC entry 1809 (class 1259 OID 17528)
-- Dependencies: 2156 2157 3
-- Name: sgd_exp_expediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_exp_expediente (
    sgd_exp_numero character varying(18),
    radi_nume_radi bigint,
    sgd_exp_fech date,
    sgd_exp_fech_mod date,
    depe_codi smallint,
    usua_codi smallint,
    usua_doc character varying(15),
    sgd_exp_estado integer DEFAULT 0,
    sgd_exp_titulo character varying(50),
    sgd_exp_asunto character varying(150),
    sgd_exp_carpeta character varying(30),
    sgd_exp_ufisica character varying(20),
    sgd_exp_isla character varying(10),
    sgd_exp_estante character varying(10),
    sgd_exp_caja character varying(10),
    sgd_exp_fech_arch date,
    sgd_srd_codigo smallint,
    sgd_sbrd_codigo smallint,
    sgd_fexp_codigo smallint DEFAULT 0,
    sgd_exp_subexpediente integer,
    sgd_exp_archivo smallint,
    sgd_exp_unicon smallint,
    sgd_exp_fechfin date,
    sgd_exp_folios character varying(4),
    sgd_exp_rete numeric(2,0),
    sgd_exp_entrepa numeric(6,0),
    sgd_exp_privado smallint,
    radi_usua_arch character varying(40),
    sgd_exp_edificio character varying(400),
    sgd_exp_caja_bodega character varying(40),
    sgd_exp_carro character varying(40),
    sgd_exp_carpeta_bodega character varying(40),
    sgd_exp_cd character varying(10),
    sgd_exp_nref character varying(7)
);


ALTER TABLE public.sgd_exp_expediente OWNER TO postgres;

--
-- TOC entry 1810 (class 1259 OID 17557)
-- Dependencies: 3
-- Name: sgd_fars_faristas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fars_faristas (
    sgd_fars_codigo integer NOT NULL,
    sgd_pexp_codigo integer,
    sgd_fexp_codigoini integer,
    sgd_fexp_codigofin integer,
    sgd_fars_diasminimo smallint,
    sgd_fars_diasmaximo smallint,
    sgd_fars_desc character varying(100),
    sgd_trad_codigo smallint,
    sgd_srd_codigo smallint,
    sgd_sbrd_codigo smallint,
    sgd_fars_tipificacion smallint,
    sgd_tpr_codigo integer,
    sgd_fars_automatico integer,
    sgd_fars_rolgeneral integer
);


ALTER TABLE public.sgd_fars_faristas OWNER TO postgres;

--
-- TOC entry 1759 (class 1259 OID 16796)
-- Dependencies: 2101 2102 3
-- Name: sgd_fenv_frmenvio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fenv_frmenvio (
    sgd_fenv_codigo integer NOT NULL,
    sgd_fenv_descrip character varying(40) NOT NULL,
    sgd_fenv_planilla smallint DEFAULT 0 NOT NULL,
    sgd_fenv_estado smallint DEFAULT 1 NOT NULL
);


ALTER TABLE public.sgd_fenv_frmenvio OWNER TO postgres;

--
-- TOC entry 1796 (class 1259 OID 17259)
-- Dependencies: 3
-- Name: sgd_fexp_flujoexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fexp_flujoexpedientes (
    sgd_fexp_codigo integer NOT NULL,
    sgd_pexp_codigo integer,
    sgd_fexp_orden smallint,
    sgd_fexp_terminos smallint,
    sgd_fexp_imagen character varying(50),
    sgd_fexp_descrip character varying(50)
);


ALTER TABLE public.sgd_fexp_flujoexpedientes OWNER TO postgres;

--
-- TOC entry 1811 (class 1259 OID 17568)
-- Dependencies: 3
-- Name: sgd_firrad_firmarads; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_firrad_firmarads (
    sgd_firrad_id bigint NOT NULL,
    radi_nume_radi bigint NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_firrad_firma bytea,
    sgd_firrad_fecha date NOT NULL,
    sgd_firrad_docsolic character varying(14) NOT NULL,
    sgd_firrad_fechsolic date NOT NULL
);


ALTER TABLE public.sgd_firrad_firmarads OWNER TO postgres;

--
-- TOC entry 1761 (class 1259 OID 16810)
-- Dependencies: 2103 3
-- Name: sgd_fld_flujodoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fld_flujodoc (
    sgd_fld_codigo smallint,
    sgd_fld_desc character varying(100),
    sgd_tpr_codigo smallint,
    sgd_fld_imagen character varying(50),
    sgd_fld_grupoweb integer DEFAULT 0
);


ALTER TABLE public.sgd_fld_flujodoc OWNER TO postgres;

--
-- TOC entry 1721 (class 1259 OID 16506)
-- Dependencies: 3
-- Name: sgd_fun_funciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fun_funciones (
    sgd_fun_codigo smallint NOT NULL,
    sgd_fun_descrip character varying(530),
    sgd_fun_fech_ini date,
    sgd_fun_fech_fin date
);


ALTER TABLE public.sgd_fun_funciones OWNER TO postgres;

--
-- TOC entry 1812 (class 1259 OID 17582)
-- Dependencies: 3
-- Name: sgd_hmtd_hismatdoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_hmtd_hismatdoc (
    sgd_hmtd_codigo integer NOT NULL,
    sgd_hmtd_fecha date NOT NULL,
    radi_nume_radi bigint NOT NULL,
    usua_codi bigint NOT NULL,
    sgd_hmtd_obse character varying(600) NOT NULL,
    usua_doc bigint,
    depe_codi smallint,
    sgd_mtd_codigo smallint
);


ALTER TABLE public.sgd_hmtd_hismatdoc OWNER TO postgres;

--
-- TOC entry 1722 (class 1259 OID 16512)
-- Dependencies: 3
-- Name: sgd_instorf_instanciasorfeo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_instorf_instanciasorfeo (
    sgd_instorf_codi smallint NOT NULL,
    sgd_instorf_desc character varying(100)
);


ALTER TABLE public.sgd_instorf_instanciasorfeo OWNER TO postgres;

--
-- TOC entry 1723 (class 1259 OID 16518)
-- Dependencies: 3
-- Name: sgd_masiva_excel; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_masiva_excel (
    sgd_masiva_dependencia smallint,
    sgd_masiva_usuario bigint,
    sgd_masiva_tiporadicacion smallint,
    sgd_masiva_codigo bigint NOT NULL,
    sgd_masiva_radicada smallint,
    sgd_masiva_intervalo smallint,
    sgd_masiva_rangoini character varying(15),
    sgd_masiva_rangofin character varying(15)
);


ALTER TABLE public.sgd_masiva_excel OWNER TO postgres;

--
-- TOC entry 1786 (class 1259 OID 17094)
-- Dependencies: 3
-- Name: sgd_mat_matriz; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mat_matriz (
    sgd_mat_codigo smallint NOT NULL,
    depe_codi smallint,
    sgd_fun_codigo smallint,
    sgd_prc_codigo smallint,
    sgd_prd_codigo smallint,
    sgd_mat_fech_ini date,
    sgd_mat_fech_fin date,
    sgd_mat_peso_prd numeric
);


ALTER TABLE public.sgd_mat_matriz OWNER TO postgres;

--
-- TOC entry 1768 (class 1259 OID 16848)
-- Dependencies: 3
-- Name: sgd_mpes_mddpeso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mpes_mddpeso (
    sgd_mpes_codigo integer NOT NULL,
    sgd_mpes_descrip character varying(10)
);


ALTER TABLE public.sgd_mpes_mddpeso OWNER TO postgres;

--
-- TOC entry 1787 (class 1259 OID 17124)
-- Dependencies: 3
-- Name: sgd_mrd_matrird; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mrd_matrird (
    sgd_mrd_codigo smallint NOT NULL,
    depe_codi smallint NOT NULL,
    sgd_srd_codigo smallint NOT NULL,
    sgd_sbrd_codigo smallint NOT NULL,
    sgd_tpr_codigo smallint NOT NULL,
    soporte character varying(10),
    sgd_mrd_fechini date,
    sgd_mrd_fechfin date,
    sgd_mrd_esta character varying(10)
);


ALTER TABLE public.sgd_mrd_matrird OWNER TO postgres;

--
-- TOC entry 1789 (class 1259 OID 17162)
-- Dependencies: 3
-- Name: sgd_msdep_msgdep; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_msdep_msgdep (
    sgd_msdep_codi bigint NOT NULL,
    depe_codi smallint NOT NULL,
    sgd_msg_codi bigint NOT NULL
);


ALTER TABLE public.sgd_msdep_msgdep OWNER TO postgres;

--
-- TOC entry 1788 (class 1259 OID 17151)
-- Dependencies: 3
-- Name: sgd_msg_mensaje; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_msg_mensaje (
    sgd_msg_codi bigint NOT NULL,
    sgd_tme_codi smallint NOT NULL,
    sgd_msg_desc character varying(150),
    sgd_msg_fechdesp date NOT NULL,
    sgd_msg_url character varying(150) NOT NULL,
    sgd_msg_veces smallint NOT NULL,
    sgd_msg_ancho integer NOT NULL,
    sgd_msg_largo integer NOT NULL
);


ALTER TABLE public.sgd_msg_mensaje OWNER TO postgres;

--
-- TOC entry 1790 (class 1259 OID 17178)
-- Dependencies: 3
-- Name: sgd_mtd_matriz_doc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mtd_matriz_doc (
    sgd_mtd_codigo smallint NOT NULL,
    sgd_mat_codigo smallint,
    sgd_tpr_codigo smallint
);


ALTER TABLE public.sgd_mtd_matriz_doc OWNER TO postgres;

--
-- TOC entry 1724 (class 1259 OID 16524)
-- Dependencies: 3
-- Name: sgd_noh_nohabiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_noh_nohabiles (
    noh_fecha date NOT NULL
);


ALTER TABLE public.sgd_noh_nohabiles OWNER TO postgres;

--
-- TOC entry 1725 (class 1259 OID 16530)
-- Dependencies: 3
-- Name: sgd_not_notificacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_not_notificacion (
    sgd_not_codi smallint NOT NULL,
    sgd_not_descrip character varying(100) NOT NULL
);


ALTER TABLE public.sgd_not_notificacion OWNER TO postgres;

--
-- TOC entry 1813 (class 1259 OID 17603)
-- Dependencies: 3
-- Name: sgd_ntrd_notifrad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ntrd_notifrad (
    radi_nume_radi bigint NOT NULL,
    sgd_not_codi smallint NOT NULL,
    sgd_ntrd_notificador character varying(150),
    sgd_ntrd_notificado character varying(150),
    sgd_ntrd_fecha_not date,
    sgd_ntrd_num_edicto integer,
    sgd_ntrd_fecha_fija date,
    sgd_ntrd_fecha_desfija date,
    sgd_ntrd_observaciones character varying(150)
);


ALTER TABLE public.sgd_ntrd_notifrad OWNER TO postgres;

--
-- TOC entry 1814 (class 1259 OID 17611)
-- Dependencies: 2158 2159 3
-- Name: sgd_oem_oempresas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_oem_oempresas (
    sgd_oem_codigo integer NOT NULL,
    tdid_codi smallint,
    sgd_oem_oempresa character varying(150),
    sgd_oem_rep_legal character varying(150),
    sgd_oem_nit character varying(14),
    sgd_oem_sigla character varying(50),
    muni_codi smallint,
    dpto_codi smallint,
    sgd_oem_direccion character varying(150),
    sgd_oem_telefono character varying(50),
    id_cont smallint DEFAULT 1,
    id_pais smallint DEFAULT 170
);


ALTER TABLE public.sgd_oem_oempresas OWNER TO postgres;

--
-- TOC entry 1764 (class 1259 OID 16823)
-- Dependencies: 3
-- Name: sgd_panu_peranulados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_panu_peranulados (
    sgd_panu_codi smallint NOT NULL,
    sgd_panu_desc character varying(200)
);


ALTER TABLE public.sgd_panu_peranulados OWNER TO postgres;

--
-- TOC entry 1726 (class 1259 OID 16536)
-- Dependencies: 3
-- Name: sgd_parametro; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_parametro (
    param_nomb character varying(25) NOT NULL,
    param_codi integer NOT NULL,
    param_valor character varying(25) NOT NULL
);


ALTER TABLE public.sgd_parametro OWNER TO postgres;

--
-- TOC entry 1791 (class 1259 OID 17194)
-- Dependencies: 3
-- Name: sgd_parexp_paramexpediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_parexp_paramexpediente (
    sgd_parexp_codigo smallint NOT NULL,
    depe_codi smallint NOT NULL,
    sgd_parexp_tabla character varying(30) NOT NULL,
    sgd_parexp_etiqueta character varying(15) NOT NULL,
    sgd_parexp_orden smallint,
    sgd_parexp_editable character varying(100)
);


ALTER TABLE public.sgd_parexp_paramexpediente OWNER TO postgres;

--
-- TOC entry 1792 (class 1259 OID 17205)
-- Dependencies: 2137 2138 2139 3
-- Name: sgd_pexp_procexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pexp_procexpedientes (
    sgd_pexp_codigo integer NOT NULL,
    sgd_pexp_descrip character varying(100),
    sgd_pexp_terminos integer DEFAULT 0,
    sgd_srd_codigo smallint,
    sgd_sbrd_codigo smallint,
    sgd_pexp_automatico smallint DEFAULT 1,
    sgd_pexp_tieneflujo smallint DEFAULT 0 NOT NULL
);


ALTER TABLE public.sgd_pexp_procexpedientes OWNER TO postgres;

--
-- TOC entry 1746 (class 1259 OID 16703)
-- Dependencies: 3
-- Name: sgd_pnufe_procnumfe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pnufe_procnumfe (
    sgd_pnufe_codi smallint NOT NULL,
    sgd_tpr_codigo smallint,
    sgd_pnufe_descrip character varying(150),
    sgd_pnufe_serie character varying(50)
);


ALTER TABLE public.sgd_pnufe_procnumfe OWNER TO postgres;

--
-- TOC entry 1816 (class 1259 OID 17667)
-- Dependencies: 3
-- Name: sgd_pnun_procenum; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pnun_procenum (
    sgd_pnun_codi smallint NOT NULL,
    sgd_pnufe_codi smallint,
    depe_codi smallint,
    sgd_pnun_prepone character varying(50)
);


ALTER TABLE public.sgd_pnun_procenum OWNER TO postgres;

--
-- TOC entry 1727 (class 1259 OID 16542)
-- Dependencies: 3
-- Name: sgd_prc_proceso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_prc_proceso (
    sgd_prc_codigo smallint NOT NULL,
    sgd_prc_descrip character varying(150),
    sgd_prc_fech_ini date,
    sgd_prc_fech_fin date
);


ALTER TABLE public.sgd_prc_proceso OWNER TO postgres;

--
-- TOC entry 1747 (class 1259 OID 16709)
-- Dependencies: 3
-- Name: sgd_prd_prcdmentos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_prd_prcdmentos (
    sgd_prd_codigo smallint NOT NULL,
    sgd_prd_descrip character varying(200),
    sgd_prd_fech_ini date,
    sgd_prd_fech_fin date
);


ALTER TABLE public.sgd_prd_prcdmentos OWNER TO postgres;

--
-- TOC entry 1793 (class 1259 OID 17219)
-- Dependencies: 3
-- Name: sgd_rdf_retdocf; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rdf_retdocf (
    sgd_mrd_codigo smallint NOT NULL,
    radi_nume_radi bigint NOT NULL,
    depe_codi smallint NOT NULL,
    usua_codi bigint NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_rdf_fech date NOT NULL
);


ALTER TABLE public.sgd_rdf_retdocf OWNER TO postgres;

--
-- TOC entry 1817 (class 1259 OID 17683)
-- Dependencies: 2162 2163 2164 2165 2166 2167 2168 2169 2170 3
-- Name: sgd_renv_regenvio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_renv_regenvio (
    sgd_renv_codigo integer NOT NULL,
    sgd_fenv_codigo integer,
    sgd_renv_fech date,
    radi_nume_sal bigint,
    sgd_renv_destino character varying(150),
    sgd_renv_telefono character varying(50),
    sgd_renv_mail character varying(150),
    sgd_renv_peso character varying(10),
    sgd_renv_valor character varying(10),
    sgd_renv_certificado smallint,
    sgd_renv_estado smallint,
    usua_doc bigint,
    sgd_renv_nombre character varying(100),
    sgd_rem_destino smallint DEFAULT 0,
    sgd_dir_codigo bigint,
    sgd_renv_planilla character varying(8),
    sgd_renv_fech_sal date,
    depe_codi smallint,
    sgd_dir_tipo smallint DEFAULT 0,
    radi_nume_grupo bigint,
    sgd_renv_dir character varying(100),
    sgd_renv_depto character varying(30),
    sgd_renv_mpio character varying(30),
    sgd_renv_tel character varying(20),
    sgd_renv_cantidad smallint DEFAULT 0,
    sgd_renv_tipo smallint DEFAULT 0,
    sgd_renv_observa character varying(200),
    sgd_renv_grupo bigint,
    sgd_deve_codigo smallint,
    sgd_deve_fech date,
    sgd_renv_valortotal character varying(14) DEFAULT '0'::character varying,
    sgd_renv_valistamiento character varying(10) DEFAULT '0'::character varying,
    sgd_renv_vdescuento character varying(10) DEFAULT '0'::character varying,
    sgd_renv_vadicional character varying(14) DEFAULT '0'::character varying,
    sgd_depe_genera smallint,
    sgd_renv_pais character varying(30) DEFAULT 'Colombia'::character varying
);


ALTER TABLE public.sgd_renv_regenvio OWNER TO postgres;

--
-- TOC entry 1728 (class 1259 OID 16548)
-- Dependencies: 3
-- Name: sgd_rfax_reservafax; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rfax_reservafax (
    sgd_rfax_codigo bigint,
    sgd_rfax_fax character varying(30),
    usua_login character varying(30),
    sgd_rfax_fech date,
    sgd_rfax_fechradi date,
    radi_nume_radi bigint,
    sgd_rfax_observa character varying(500)
);


ALTER TABLE public.sgd_rfax_reservafax OWNER TO postgres;

--
-- TOC entry 1762 (class 1259 OID 16814)
-- Dependencies: 3
-- Name: sgd_rmr_radmasivre; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rmr_radmasivre (
    sgd_rmr_grupo bigint NOT NULL,
    sgd_rmr_radi bigint NOT NULL
);


ALTER TABLE public.sgd_rmr_radmasivre OWNER TO postgres;

--
-- TOC entry 1729 (class 1259 OID 16555)
-- Dependencies: 3
-- Name: sgd_san_sancionados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_san_sancionados (
    sgd_san_ref character varying(20) NOT NULL,
    sgd_san_decision character varying(60),
    sgd_san_cargo character varying(50),
    sgd_san_expediente character varying(20),
    sgd_san_tipo_sancion character varying(50),
    sgd_san_plazo character varying(100),
    sgd_san_valor numeric,
    sgd_san_radicacion character varying(15),
    sgd_san_fecha_radicado date,
    sgd_san_valorletras character varying(1000),
    sgd_san_nombreempresa character varying(160),
    sgd_san_motivos character varying(160),
    sgd_san_sectores character varying(160),
    sgd_san_padre character varying(15),
    sgd_san_fecha_padre date,
    sgd_san_notificado character varying(100)
);


ALTER TABLE public.sgd_san_sancionados OWNER TO postgres;

--
-- TOC entry 1748 (class 1259 OID 16715)
-- Dependencies: 3
-- Name: sgd_sbrd_subserierd; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sbrd_subserierd (
    sgd_srd_codigo smallint NOT NULL,
    sgd_sbrd_codigo smallint NOT NULL,
    sgd_sbrd_descrip character varying(200) NOT NULL,
    sgd_sbrd_fechini date NOT NULL,
    sgd_sbrd_fechfin date NOT NULL,
    sgd_sbrd_tiemag smallint,
    sgd_sbrd_tiemac smallint,
    sgd_sbrd_dispfin character varying(50),
    sgd_sbrd_soporte character varying(50),
    sgd_sbrd_procedi character varying(200)
);


ALTER TABLE public.sgd_sbrd_subserierd OWNER TO postgres;

--
-- TOC entry 1757 (class 1259 OID 16785)
-- Dependencies: 3
-- Name: sgd_sed_sede; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sed_sede (
    sgd_sed_codi smallint NOT NULL,
    sgd_sed_desc character varying(50),
    sgd_tpr_codigo smallint
);


ALTER TABLE public.sgd_sed_sede OWNER TO postgres;

--
-- TOC entry 1760 (class 1259 OID 16804)
-- Dependencies: 3
-- Name: sgd_senuf_secnumfe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_senuf_secnumfe (
    sgd_senuf_codi smallint NOT NULL,
    sgd_pnufe_codi smallint,
    depe_codi integer,
    sgd_senuf_sec character varying(50)
);


ALTER TABLE public.sgd_senuf_secnumfe OWNER TO postgres;

--
-- TOC entry 1794 (class 1259 OID 17233)
-- Dependencies: 3
-- Name: sgd_sexp_secexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sexp_secexpedientes (
    sgd_exp_numero character varying(18) NOT NULL,
    sgd_srd_codigo integer,
    sgd_sbrd_codigo integer,
    sgd_sexp_secuencia integer,
    depe_codi smallint,
    usua_doc character varying(15),
    sgd_sexp_fech date,
    sgd_fexp_codigo integer,
    sgd_sexp_ano smallint,
    usua_doc_responsable character varying(18),
    sgd_sexp_parexp1 character varying(250),
    sgd_sexp_parexp2 character varying(160),
    sgd_sexp_parexp3 character varying(160),
    sgd_sexp_parexp4 character varying(160),
    sgd_sexp_parexp5 character varying(160),
    sgd_pexp_codigo integer,
    sgd_exp_fech_arch date,
    sgd_fld_codigo smallint,
    sgd_exp_fechflujoant date,
    sgd_mrd_codigo smallint,
    sgd_exp_subexpediente bigint
);


ALTER TABLE public.sgd_sexp_secexpedientes OWNER TO postgres;

--
-- TOC entry 1730 (class 1259 OID 16564)
-- Dependencies: 3
-- Name: sgd_srd_seriesrd; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_srd_seriesrd (
    sgd_srd_codigo smallint NOT NULL,
    sgd_srd_descrip character varying(50) NOT NULL,
    sgd_srd_fechini date NOT NULL,
    sgd_srd_fechfin date NOT NULL
);


ALTER TABLE public.sgd_srd_seriesrd OWNER TO postgres;

--
-- TOC entry 1772 (class 1259 OID 16870)
-- Dependencies: 3
-- Name: sgd_tar_tarifas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tar_tarifas (
    sgd_fenv_codigo integer,
    sgd_tar_codser integer,
    sgd_tar_codigo integer,
    sgd_tar_valenv1 bigint,
    sgd_tar_valenv2 bigint,
    sgd_tar_valenv1g1 bigint,
    sgd_clta_codser integer,
    sgd_tar_valenv2g2 bigint,
    sgd_clta_descrip character varying(100)
);


ALTER TABLE public.sgd_tar_tarifas OWNER TO postgres;

--
-- TOC entry 1749 (class 1259 OID 16726)
-- Dependencies: 3
-- Name: sgd_tdec_tipodecision; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tdec_tipodecision (
    sgd_apli_codi smallint NOT NULL,
    sgd_tdec_codigo smallint NOT NULL,
    sgd_tdec_descrip character varying(150),
    sgd_tdec_sancionar smallint,
    sgd_tdec_firmeza smallint,
    sgd_tdec_versancion smallint,
    sgd_tdec_showmenu smallint,
    sgd_tdec_updnotif smallint
);


ALTER TABLE public.sgd_tdec_tipodecision OWNER TO postgres;

--
-- TOC entry 1750 (class 1259 OID 16737)
-- Dependencies: 3
-- Name: sgd_tid_tipdecision; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tid_tipdecision (
    sgd_tid_codi smallint NOT NULL,
    sgd_tid_desc character varying(150),
    sgd_tpr_codigo smallint,
    sgd_pexp_codigo integer,
    sgd_tpr_codigop smallint
);


ALTER TABLE public.sgd_tid_tipdecision OWNER TO postgres;

--
-- TOC entry 1754 (class 1259 OID 16762)
-- Dependencies: 3
-- Name: sgd_tidm_tidocmasiva; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tidm_tidocmasiva (
    sgd_tidm_codi smallint NOT NULL,
    sgd_tidm_desc character varying(150)
);


ALTER TABLE public.sgd_tidm_tidocmasiva OWNER TO postgres;

--
-- TOC entry 1766 (class 1259 OID 16835)
-- Dependencies: 2104 2105 3
-- Name: sgd_tip3_tipotercero; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tip3_tipotercero (
    sgd_tip3_codigo smallint NOT NULL,
    sgd_dir_tipo smallint,
    sgd_tip3_nombre character varying(15),
    sgd_tip3_desc character varying(30),
    sgd_tip3_imgpestana character varying(20),
    sgd_tpr_tp1 smallint DEFAULT 0,
    sgd_tpr_tp2 smallint DEFAULT 0
);


ALTER TABLE public.sgd_tip3_tipotercero OWNER TO postgres;

--
-- TOC entry 1797 (class 1259 OID 17270)
-- Dependencies: 3
-- Name: sgd_tma_temas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tma_temas (
    sgd_tma_codigo smallint NOT NULL,
    sgd_prc_codigo smallint,
    sgd_tma_descrip character varying(150)
);


ALTER TABLE public.sgd_tma_temas OWNER TO postgres;

--
-- TOC entry 1818 (class 1259 OID 17715)
-- Dependencies: 3
-- Name: sgd_tmd_temadepe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tmd_temadepe (
    id integer NOT NULL,
    sgd_tma_codigo smallint NOT NULL,
    depe_codi smallint NOT NULL
);


ALTER TABLE public.sgd_tmd_temadepe OWNER TO postgres;

--
-- TOC entry 1731 (class 1259 OID 16571)
-- Dependencies: 3
-- Name: sgd_tme_tipmen; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tme_tipmen (
    sgd_tme_codi smallint NOT NULL,
    sgd_tme_desc character varying(150)
);


ALTER TABLE public.sgd_tme_tipmen OWNER TO postgres;

--
-- TOC entry 1751 (class 1259 OID 16743)
-- Dependencies: 2099 2100 3
-- Name: sgd_tpr_tpdcumento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tpr_tpdcumento (
    sgd_tpr_codigo smallint NOT NULL,
    sgd_tpr_descrip character varying(150),
    sgd_tpr_termino smallint,
    sgd_tpr_tpuso smallint,
    sgd_tpr_numera character varying(1),
    sgd_tpr_radica character varying(1),
    sgd_tpr_tp1 smallint DEFAULT 0,
    sgd_tpr_tp2 smallint DEFAULT 0,
    sgd_tpr_estado smallint,
    sgd_termino_real smallint
);


ALTER TABLE public.sgd_tpr_tpdcumento OWNER TO postgres;

--
-- TOC entry 1732 (class 1259 OID 16577)
-- Dependencies: 2098 3
-- Name: sgd_trad_tiporad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_trad_tiporad (
    sgd_trad_codigo smallint NOT NULL,
    sgd_trad_descr character varying(30),
    sgd_trad_icono character varying(30),
    sgd_trad_genradsal smallint,
    sgd_trad_diasbloqueo smallint DEFAULT 0
);


ALTER TABLE public.sgd_trad_tiporad OWNER TO postgres;

--
-- TOC entry 1765 (class 1259 OID 16829)
-- Dependencies: 3
-- Name: sgd_tres_tpresolucion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tres_tpresolucion (
    sgd_tres_codigo smallint NOT NULL,
    sgd_tres_descrip character varying(100) NOT NULL,
    sgd_tpr_codigo smallint
);


ALTER TABLE public.sgd_tres_tpresolucion OWNER TO postgres;

--
-- TOC entry 1767 (class 1259 OID 16842)
-- Dependencies: 3
-- Name: sgd_ttr_transaccion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ttr_transaccion (
    sgd_ttr_codigo smallint NOT NULL,
    sgd_ttr_descrip character varying(100) NOT NULL
);


ALTER TABLE public.sgd_ttr_transaccion OWNER TO postgres;

--
-- TOC entry 1733 (class 1259 OID 16584)
-- Dependencies: 3
-- Name: sgd_ush_usuhistorico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ush_usuhistorico (
    sgd_ush_admcod bigint NOT NULL,
    sgd_ush_admdep integer NOT NULL,
    sgd_ush_admdoc character varying(14) NOT NULL,
    sgd_ush_usucod bigint NOT NULL,
    sgd_ush_usudep integer NOT NULL,
    sgd_ush_usudoc character varying(14) NOT NULL,
    sgd_ush_modcod integer NOT NULL,
    sgd_ush_fechevento date NOT NULL,
    sgd_ush_usulogin character varying(20) NOT NULL
);


ALTER TABLE public.sgd_ush_usuhistorico OWNER TO postgres;

--
-- TOC entry 1734 (class 1259 OID 16587)
-- Dependencies: 3
-- Name: sgd_usm_usumodifica; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_usm_usumodifica (
    sgd_usm_modcod integer NOT NULL,
    sgd_usm_moddescr character varying(60) NOT NULL
);


ALTER TABLE public.sgd_usm_usumodifica OWNER TO postgres;

--
-- TOC entry 1735 (class 1259 OID 16591)
-- Dependencies: 3
-- Name: tipo_doc_identificacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_doc_identificacion (
    tdid_codi smallint NOT NULL,
    tdid_desc character varying(100) NOT NULL
);


ALTER TABLE public.tipo_doc_identificacion OWNER TO postgres;

--
-- TOC entry 1736 (class 1259 OID 16597)
-- Dependencies: 3
-- Name: tipo_remitente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_remitente (
    trte_codi smallint NOT NULL,
    trte_desc character varying(100) NOT NULL
);


ALTER TABLE public.tipo_remitente OWNER TO postgres;

--
-- TOC entry 1753 (class 1259 OID 16758)
-- Dependencies: 3
-- Name: ubicacion_fisica; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ubicacion_fisica (
    ubic_depe_radi integer NOT NULL,
    ubic_depe_arch integer,
    ubic_inv_piso character varying(2) NOT NULL,
    ubic_inv_piso_desc character varying(40),
    ubic_inv_itemso character varying(40),
    ubic_inv_itemsn character varying(40),
    ubic_inv_archivador character varying(4)
);


ALTER TABLE public.ubicacion_fisica OWNER TO postgres;

--
-- TOC entry 1780 (class 1259 OID 16963)
-- Dependencies: 2114 2115 2116 2117 2118 2119 2120 2121 2122 2123 2124 2125 2126 2127 2128 2129 2130 2131 2132 2133 2134 3
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    usua_codi smallint NOT NULL,
    depe_codi smallint NOT NULL,
    usua_login character varying(15) NOT NULL,
    usua_fech_crea date NOT NULL,
    usua_pasw character varying(30) NOT NULL,
    usua_esta character varying(10) NOT NULL,
    usua_nomb character varying(45),
    perm_radi character(1) DEFAULT 0,
    usua_admin character(1) DEFAULT 0,
    usua_nuevo character(1) DEFAULT 0,
    usua_doc character varying(14) DEFAULT '0'::character varying,
    codi_nivel smallint DEFAULT 1,
    usua_sesion character varying(30),
    usua_fech_sesion date,
    usua_ext smallint,
    usua_nacim date,
    usua_email character varying(50),
    usua_at character varying(15),
    usua_piso smallint,
    perm_radi_sal integer DEFAULT 0,
    usua_admin_archivo smallint DEFAULT 0,
    usua_masiva smallint DEFAULT 0,
    usua_perm_dev smallint DEFAULT 0,
    usua_perm_numera_res character varying(1),
    usua_doc_suip character varying(15),
    usua_perm_numeradoc smallint,
    sgd_panu_codi smallint,
    usua_prad_tp1 smallint DEFAULT 0,
    usua_prad_tp2 smallint DEFAULT 0,
    usua_perm_envios smallint DEFAULT 0,
    usua_perm_modifica smallint DEFAULT 0,
    usua_perm_impresion smallint DEFAULT 0,
    sgd_aper_codigo smallint,
    usu_telefono1 character varying(14),
    usua_encuesta character varying(1),
    sgd_perm_estadistica smallint,
    usua_perm_sancionados smallint,
    usua_admin_sistema smallint,
    usua_perm_trd smallint,
    usua_perm_firma smallint,
    usua_perm_prestamo smallint,
    usuario_publico smallint,
    usuario_reasignar smallint,
    usua_perm_notifica smallint,
    usua_perm_expediente integer,
    usua_login_externo character varying(15),
    id_pais smallint DEFAULT 170,
    id_cont smallint DEFAULT 1,
    perm_tipif_anexo integer,
    perm_vobo character varying(1) DEFAULT '1'::character varying,
    perm_archi character(1) DEFAULT 1,
    perm_borrar_anexo integer,
    usua_auth_ldap integer,
    usua_perm_adminflujos smallint DEFAULT 0,
    usua_adm_plantilla smallint DEFAULT 0,
    usua_perm_intergapps smallint DEFAULT 0
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- TOC entry 1819 (class 1259 OID 17731)
-- Dependencies: 3
-- Name: sec_ciu_ciudadano; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_ciu_ciudadano
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_ciu_ciudadano OWNER TO postgres;

--
-- TOC entry 2748 (class 0 OID 0)
-- Dependencies: 1819
-- Name: sec_ciu_ciudadano; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_ciu_ciudadano', 1, true);


--
-- TOC entry 1823 (class 1259 OID 17739)
-- Dependencies: 3
-- Name: sec_dir_direcciones; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_dir_direcciones
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_dir_direcciones OWNER TO postgres;

--
-- TOC entry 2749 (class 0 OID 0)
-- Dependencies: 1823
-- Name: sec_dir_direcciones; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_dir_direcciones', 3, true);


--
-- TOC entry 1825 (class 1259 OID 17749)
-- Dependencies: 3
-- Name: sec_edificio; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_edificio
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_edificio OWNER TO postgres;

--
-- TOC entry 2750 (class 0 OID 0)
-- Dependencies: 1825
-- Name: sec_edificio; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_edificio', 801, true);


--
-- TOC entry 1826 (class 1259 OID 17751)
-- Dependencies: 3
-- Name: sec_inv; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_inv
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_inv OWNER TO postgres;

--
-- TOC entry 2751 (class 0 OID 0)
-- Dependencies: 1826
-- Name: sec_inv; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_inv', 6, true);


--
-- TOC entry 1821 (class 1259 OID 17735)
-- Dependencies: 3
-- Name: sec_tp1_998; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_tp1_998
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_tp1_998 OWNER TO postgres;

--
-- TOC entry 2752 (class 0 OID 0)
-- Dependencies: 1821
-- Name: sec_tp1_998; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_tp1_998', 1, false);


--
-- TOC entry 1820 (class 1259 OID 17733)
-- Dependencies: 3
-- Name: sec_tp2_998; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_tp2_998
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_tp2_998 OWNER TO postgres;

--
-- TOC entry 2753 (class 0 OID 0)
-- Dependencies: 1820
-- Name: sec_tp2_998; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sec_tp2_998', 1, false);


--
-- TOC entry 1828 (class 1259 OID 17865)
-- Dependencies: 3
-- Name: secr_tp1_; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secr_tp1_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp1_ OWNER TO postgres;

--
-- TOC entry 2754 (class 0 OID 0)
-- Dependencies: 1828
-- Name: secr_tp1_; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secr_tp1_', 1, true);


--
-- TOC entry 1822 (class 1259 OID 17737)
-- Dependencies: 3
-- Name: secr_tp2_; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secr_tp2_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_ OWNER TO postgres;

--
-- TOC entry 2755 (class 0 OID 0)
-- Dependencies: 1822
-- Name: secr_tp2_; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('secr_tp2_', 2, true);

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
-- TOC entry 2722 (class 0 OID 17358)
-- Dependencies: 1799
-- Data for Name: anexos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2723 (class 0 OID 17378)
-- Dependencies: 1800
-- Data for Name: anexos_historico; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2629 (class 0 OID 16404)
-- Dependencies: 1706
-- Data for Name: anexos_tipo; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (1, 'doc', 'Word');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (2, 'xls', 'Excel');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (3, 'ppt', 'PowerPoint');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (4, 'tif', 'Imagen Tif');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (5, 'jpg', 'Imagen jpg');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (6, 'gif', 'Imagen gif');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (7, 'pdf', 'Acrobat Reader');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (8, 'txt', 'Documento txt');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (9, 'zip', 'Comprimido');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (10, 'rtf', 'Rich Text Format (rtf)');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (11, 'dia', 'Dia(Diagrama)');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (12, 'zargo', 'Argo(Diagrama)');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (13, 'csv', 'csv (separado por comas)');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (14, 'odt', 'open document text');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (20, 'avi', '.avi (Video)');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (21, 'mpg', '.mpg (video)');
INSERT INTO anexos_tipo (anex_tipo_codi, anex_tipo_ext, anex_tipo_desc) VALUES (23, 'tar', '.tar (Comprimido)');


--
-- TOC entry 2630 (class 0 OID 16410)
-- Dependencies: 1707
-- Data for Name: bodega_empresas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2631 (class 0 OID 16426)
-- Dependencies: 1708
-- Data for Name: carpeta; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO carpeta (carp_codi, carp_desc) VALUES (0, 'Entrada');
INSERT INTO carpeta (carp_codi, carp_desc) VALUES (1, 'Salida');
INSERT INTO carpeta (carp_codi, carp_desc) VALUES (12, 'Devueltos');
INSERT INTO carpeta (carp_codi, carp_desc) VALUES (11, 'Vo.Bo.');


--
-- TOC entry 2701 (class 0 OID 16935)
-- Dependencies: 1778
-- Data for Name: carpeta_per; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO carpeta_per (usua_codi, depe_codi, nomb_carp, desc_carp, codi_carp) VALUES (1, 998, 'Masiva', 'Radicacion Masiva', 5);


--
-- TOC entry 2698 (class 0 OID 16892)
-- Dependencies: 1775
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 1, 'TODOS');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 5, 'ANTIOQUIA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 8, 'ATLANTICO');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 11, 'D.C.');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 13, 'BOLIVAR');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 15, 'BOYACA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 17, 'CALDAS');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 18, 'CAQUETA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 19, 'CAUCA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 20, 'CESAR');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 23, 'CORDOBA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 25, 'CUNDINAMARCA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 27, 'CHOCO');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 41, 'HUILA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 44, 'LA GUAJIRA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 47, 'MAGDALENA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 50, 'META');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 52, 'NARIÑO');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 54, 'NORTE DE SANTANDER');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 63, 'QUINDIO');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 66, 'RISARALDA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 68, 'SANTANDER');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 70, 'SUCRE');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 73, 'TOLIMA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 76, 'VALLE DEL CAUCA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 81, 'ARAUCA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 85, 'CASANARE');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 86, 'PUTUMAYO');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 88, 'SAN ANDRES');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 91, 'AMAZONAS');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 94, 'GUAINIA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 95, 'GUAVIARE');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 97, 'VAUPES');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 170, 99, 'VICHADA');
INSERT INTO departamento (id_cont, id_pais, dpto_codi, dpto_nomb) VALUES (1, 218, 1, 'PICHINCHA');


--
-- TOC entry 2700 (class 0 OID 16916)
-- Dependencies: 1777
-- Data for Name: dependencia; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO dependencia (depe_codi, depe_nomb, dpto_codi, depe_codi_padre, muni_codi, depe_codi_territorial, dep_sigla, dep_central, dep_direccion, depe_num_interna, depe_num_resolucion, depe_rad_tp1, depe_rad_tp2, id_cont, id_pais, depe_estado) VALUES (999, 'Dependencia de Salida', 11, NULL, 1, 999, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 170, 1);
INSERT INTO dependencia (depe_codi, depe_nomb, dpto_codi, depe_codi_padre, muni_codi, depe_codi_territorial, dep_sigla, dep_central, dep_direccion, depe_num_interna, depe_num_resolucion, depe_rad_tp1, depe_rad_tp2, id_cont, id_pais, depe_estado) VALUES (998, 'Dependencia de Prueba', 11, NULL, 1, 998, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 170, 1);


--
-- TOC entry 2702 (class 0 OID 16947)
-- Dependencies: 1779
-- Data for Name: dependencia_visibilidad; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2632 (class 0 OID 16432)
-- Dependencies: 1709
-- Data for Name: estado; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO estado (esta_codi, esta_desc) VALUES (9, 'Documento Orfeo');


--
-- TOC entry 2724 (class 0 OID 17394)
-- Dependencies: 1801
-- Data for Name: hist_eventos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2725 (class 0 OID 17409)
-- Dependencies: 1802
-- Data for Name: informados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2633 (class 0 OID 16438)
-- Dependencies: 1710
-- Data for Name: medio_recepcion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO medio_recepcion (mrec_codi, mrec_desc) VALUES (1, 'Correo');
INSERT INTO medio_recepcion (mrec_codi, mrec_desc) VALUES (2, 'Fax');
INSERT INTO medio_recepcion (mrec_codi, mrec_desc) VALUES (3, 'Internet');
INSERT INTO medio_recepcion (mrec_codi, mrec_desc) VALUES (4, 'Mail');
INSERT INTO medio_recepcion (mrec_codi, mrec_desc) VALUES (5, 'Personal');
INSERT INTO medio_recepcion (mrec_codi, mrec_desc) VALUES (6, 'Telefonico');
INSERT INTO medio_recepcion (mrec_codi, mrec_desc) VALUES (7, 'Atn. Personalizada');


--
-- TOC entry 2699 (class 0 OID 16904)
-- Dependencies: 1776
-- Data for Name: municipio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 1, 999, 'TODOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 1, 'MEDELLIN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 2, 'ABEJORRAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 4, 'ABRIAQUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 21, 'ALEJANDRIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 30, 'AMAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 31, 'AMALFI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 34, 'ANDES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 36, 'ANGELOPOLIS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 38, 'ANGOSTURA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 40, 'ANORI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 42, 'ANTIOQUIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 44, 'ANZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 45, 'APARTADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 51, 'ARBOLETES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 55, 'ARGELIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 59, 'ARMENIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 79, 'BARBOSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 86, 'BELMIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 88, 'BELLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 90, 'LA PINTADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 91, 'BETANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 93, 'BETULIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 101, 'BOLIVAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 107, 'BRICEÑO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 113, 'BURITICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 120, 'CACERES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 125, 'CAICEDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 129, 'CALDAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 134, 'CAMPAMENTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 138, 'CAÑASGORDAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 142, 'CARACOLI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 145, 'CARAMANTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 147, 'CAREPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 148, 'CARMEN DE VIBORAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 150, 'CAROLINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 154, 'CAUCASIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 172, 'CHIGORODO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 190, 'CISNEROS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 197, 'COCORNA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 206, 'CONCEPCION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 209, 'CONCORDIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 212, 'COPACABANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 234, 'DABEIBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 237, 'DON MATIAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 240, 'EBEJICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 250, 'EL BAGRE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 264, 'ENTRERRIOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 266, 'ENVIGADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 282, 'FREDONIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 284, 'FRONTINO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 306, 'GIRALDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 308, 'GIRARDOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 310, 'GOMEZ PLATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 313, 'GRANADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 315, 'GUADALUPE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 318, 'GUARNE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 321, 'GUATAPE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 347, 'HELICONIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 353, 'HISPANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 360, 'ITAGUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 361, 'ITUANGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 364, 'JARDIN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 368, 'JERICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 376, 'LA CEJA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 380, 'LA ESTRELLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 390, 'LA PINTADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 400, 'LA UNION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 411, 'LIBORINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 425, 'MACEO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 440, 'MARINILLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 467, 'MONTEBELLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 475, 'MURINDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 480, 'MUTATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 483, 'NARIÑO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 490, 'NECOCLI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 495, 'NECHI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 501, 'OLAYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 541, 'PEÑOL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 543, 'PEQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 576, 'PUEBLORRICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 579, 'PUERTO BERRIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 585, 'PTO NARE(LAMAGDALENA)', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 591, 'PUERTO TRIUNFO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 604, 'REMEDIOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 607, 'RETIRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 615, 'RIONEGRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 628, 'SABANALARGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 631, 'SABANETA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 642, 'SALGAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 647, 'SAN ANDRES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 649, 'SAN CARLOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 652, 'SAN FRANCISCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 656, 'SAN JERONIMO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 658, 'SAN JOSE DE LA MONTAÑA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 659, 'SAN JUAN DE URABA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 660, 'SAN LUIS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 664, 'SAN PEDRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 665, 'SAN PEDRO DE URABA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 667, 'SAN RAFAEL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 670, 'SAN ROQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 674, 'SAN VICENTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 679, 'SANTA BARBARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 686, 'SANTA ROSA DE OSOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 690, 'SANTO DOMINGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 697, 'SANTUARIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 736, 'SEGOVIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 756, 'SONSON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 761, 'SOPETRAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 789, 'TAMESIS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 790, 'TARAZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 792, 'TARSO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 809, 'TITIRIBI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 819, 'TOLEDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 837, 'TURBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 842, 'URAMITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 847, 'URRAO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 854, 'VALDIVIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 856, 'VALPARAISO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 858, 'VEGACHI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 861, 'VENECIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 873, 'VIGIA DEL FUERTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 885, 'YALI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 887, 'YARUMAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 890, 'YOLOMBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 893, 'YONDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 5, 895, 'ZARAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 1, 'BARRANQUILLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 78, 'BARANOA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 137, 'CAMPO DE LA CRUZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 141, 'CANDELARIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 296, 'GALAPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 372, 'JUAN DE ACOSTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 421, 'LURUACO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 433, 'MALAMBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 436, 'MANATI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 520, 'PALMAR DE VARELA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 549, 'PIOJO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 558, 'POLONUEVO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 560, 'PONEDERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 573, 'PUERTO COLOMBIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 606, 'REPELON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 634, 'SABANAGRANDE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 638, 'SABANALARGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 675, 'SANTA LUCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 685, 'SANTO TOMAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 758, 'SOLEDAD', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 770, 'SUAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 832, 'TUBARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 8, 849, 'USIACURI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 11, 1, 'BOGOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 1, 'CARTAGENA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 6, 'ACHI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 30, 'ALTOS DEL ROSARIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 42, 'ARENAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 52, 'ARJONA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 62, 'ARROYOHONDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 74, 'BARRANCO DE LOBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 140, 'CALAMAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 160, 'CANTAGALLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 188, 'CICUCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 212, 'CORDOBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 222, 'CLEMENCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 244, 'EL CARMEN DE BOLIVAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 248, 'EL GUAMO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 268, 'EL PEÑON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 300, 'HATILLO DE LOBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 430, 'MAGANGUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 433, 'MAHATES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 440, 'MARGARITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 442, 'MARIA LA BAJA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 458, 'MONTECRISTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 468, 'MOMPOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 473, 'MORALES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 549, 'PINILLOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 580, 'REGIDOR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 600, 'RIO VIEJO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 620, 'SAN CRISTOBAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 647, 'SAN ESTANISLAO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 650, 'SAN FERNANDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 654, 'SAN JACINTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 655, 'SAN JACINTO DEL CAUCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 657, 'SAN JUAN NEPOMUCENO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 667, 'SAN MARTIN DE LOBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 670, 'SAN PABLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 673, 'SANTA CATALINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 683, 'SANTA ROSA NORTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 688, 'SANTA ROSA DEL SUR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 744, 'SIMITI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 760, 'SOPLAVIENTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 780, 'TALAIGUA NUEVO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 810, 'IQUISIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 836, 'TURBACO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 838, 'TURBANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 873, 'VILLANUEVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 13, 894, 'ZAMBRANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 1, 'TUNJA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 22, 'ALMEIDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 47, 'AQUITANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 51, 'ARCABUCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 87, 'BELEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 90, 'BERBEO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 92, 'BETEITIVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 97, 'BOAVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 104, 'BOYACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 106, 'BRICENO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 109, 'BUENAVISTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 114, 'BUSBANZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 131, 'CALDAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 135, 'CAMPOHERMOSO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 162, 'CERINZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 172, 'CHINAVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 176, 'CHIQUINQUIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 180, 'CHISCAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 183, 'CHITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 185, 'CHITARAQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 187, 'CHIVATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 189, 'CIENEGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 204, 'COMBITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 212, 'COPER', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 215, 'CORRALES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 218, 'COVARACHIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 223, 'CUBARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 224, 'CUCAITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 226, 'CUITIVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 232, 'CHIQUIZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 236, 'CHIVOR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 238, 'DUITAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 244, 'EL COCUY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 248, 'EL ESPINO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 272, 'FIRAVITOBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 276, 'FLORESTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 293, 'GACHANTIVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 296, 'GAMEZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 299, 'GARAGOA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 317, 'GUACAMAYAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 322, 'GUATEQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 325, 'GUAYATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 332, 'GUICAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 362, 'IZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 367, 'JENESANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 368, 'JERICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 377, 'LABRANZAGRANDE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 380, 'LA CAPILLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 401, 'LA VICTORIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 403, 'LA UVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 407, 'VILLA DE LEYVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 425, 'MACANAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 442, 'MARIPI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 455, 'MIRAFLORES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 464, 'MONGUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 466, 'MONGUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 469, 'MONIQUIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 476, 'MOTAVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 480, 'MUZO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 491, 'NOBSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 494, 'NUEVO COLON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 500, 'OICATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 507, 'OTANCHE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 511, 'PACHAVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 514, 'PAEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 516, 'PAIPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 518, 'PAJARITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 522, 'PANQUEBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 531, 'PAUNA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 533, 'PAYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 537, 'PAZ DE RIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 542, 'PESCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 550, 'PISVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 572, 'PUERTO BOYACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 580, 'QUIPAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 599, 'RAMIRIQUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 600, 'RAQUIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 621, 'RONDON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 632, 'SABOYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 638, 'SACHICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 646, 'SAMACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 660, 'SAN EDUARDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 664, 'SAN JOSE DE PARE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 667, 'SAN LUIS DE GACENO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 673, 'SAN MATEO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 676, 'SAN MIGUEL DE SEMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 681, 'SAN PABLO DE BORBUR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 686, 'SANTANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 690, 'SANTA MARIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 693, 'SANTA ROSA DE VITERBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 696, 'SANTA SOFIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 720, 'SATIVANORTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 723, 'SATIVASUR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 740, 'SIACHOQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 753, 'SOATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 755, 'SOCOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 757, 'SOCHA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 759, 'SOGAMOSO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 761, 'SOMONDOCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 762, 'SORA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 763, 'SOTAQUIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 764, 'SORACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 774, 'SUSACON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 776, 'SUTAMARCHAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 778, 'SUTATENZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 790, 'TASCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 798, 'TENZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 804, 'TIBANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 806, 'TIBASOSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 808, 'TINJACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 810, 'TIPACOQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 814, 'TOCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 816, 'TOGUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 820, 'TOPAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 822, 'TOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 832, 'TUNUNGUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 835, 'TURMEQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 837, 'TUTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 839, 'TUTASA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 842, 'UMBITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 861, 'VENTAQUEMADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 879, 'VIRACACHA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 15, 897, 'ZETAQUIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 1, 'MANIZALES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 13, 'AGUADAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 42, 'ANSERMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 50, 'ARANZAZU', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 88, 'BELALCAZAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 174, 'CHINCHINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 272, 'FILADELFIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 380, 'LA DORADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 388, 'LA MERCED', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 433, 'MANZANARES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 442, 'MARMATO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 444, 'MARQUETALIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 446, 'MARULANDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 486, 'NEIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 513, 'PACORA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 524, 'PALESTINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 541, 'PENSILVANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 614, 'RIOSUCIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 616, 'RISARALDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 653, 'SALAMINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 662, 'SAMANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 665, 'SAN JOSE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 777, 'SUPIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 867, 'VICTORIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 873, 'VILLAMARIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 17, 877, 'VITERBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 1, 'FLORENCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 29, 'ALBANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 94, 'BELEN DE LOS ANDAQUIES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 150, 'CARTAGENA DEL CHAIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 205, 'CURILLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 247, 'EL DONCELLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 256, 'EL PAUJIL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 410, 'LA MONTAÑITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 460, 'MILAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 479, 'MORELIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 592, 'PUERTO RICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 610, 'SAN JOSE DE FRAGUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 753, 'SAN VICENTE DEL CAGUAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 756, 'SOLANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 765, 'SOLANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 785, 'SOLITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 18, 860, 'VALPARAISO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 1, 'POPAYAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 22, 'ALMAGUER', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 50, 'ARGELIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 75, 'BALBOA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 100, 'BOLIVAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 110, 'BUENOS AIRES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 130, 'CAJIBIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 137, 'CALDONO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 142, 'CALOTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 212, 'CORINTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 256, 'EL TAMBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 290, 'FLORENCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 318, 'GUAPI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 355, 'INZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 364, 'JAMBALO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 392, 'LA SIERRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 397, 'LA VEGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 418, 'LOPEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 450, 'MERCADERES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 455, 'MIRANDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 473, 'MORALES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 513, 'PADILLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 517, 'PAEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 532, 'PATIA (EL BORDO)', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 533, 'PIAMONTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 548, 'PIENDAMO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 573, 'PUERTO TEJADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 585, 'PURACE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 622, 'ROSAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 693, 'SAN SEBASTIAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 698, 'SANTANDER DE QUILICHAO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 701, 'SANTA ROSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 743, 'SILVIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 760, 'SOTARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 780, 'SUAREZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 785, 'SUCRE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 807, 'TIMBIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 809, 'TIMBIQUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 821, 'TORIBIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 824, 'TOTORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 19, 845, 'VILLA RICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 1, 'VALLEDUPAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 11, 'AGUACHICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 13, 'AGUSTIN CODAZZI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 32, 'ASTREA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 45, 'BECERRIL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 60, 'BOSCONIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 175, 'CHIMICHAGUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 178, 'CHIRIGUANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 228, 'CURUMANI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 238, 'EL COPEY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 250, 'EL PASO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 295, 'GAMARRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 310, 'GONZALEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 383, 'LA GLORIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 400, 'LA JAGUA DE IBIRICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 443, 'MANAURE BALCON DL CESAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 517, 'PAILITAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 550, 'PELAYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 570, 'PUEBLO BELLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 614, 'RIO DE ORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 621, 'LA PAZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 710, 'SAN ALBERTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 750, 'SAN DIEGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 770, 'SAN MARTIN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 20, 787, 'TAMALAMEQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 1, 'MONTERIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 68, 'AYAPEL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 79, 'BUENAVISTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 90, 'CANALETE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 162, 'CERETE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 168, 'CHIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 182, 'CHINU', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 189, 'CIENAGA DE ORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 300, 'COTORRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 350, 'LA APARTADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 417, 'LORICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 419, 'LOS CORDOBAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 464, 'MOMIL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 466, 'MONTELIBANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 500, 'MOÑITOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 555, 'PLANETA RICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 570, 'PUEBLO NUEVO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 574, 'PUERTO ESCONDIDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 580, 'PUERTO LIBERTADOR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 586, 'PURISIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 660, 'SAHAGUN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 670, 'SAN ANDRES SOTAVENTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 672, 'SAN ANTERO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 675, 'SAN BERNARDO DEL VIENTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 678, 'SAN CARLOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 686, 'SAN PELAYO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 807, 'TIERRALTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 23, 855, 'VALENCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 1, 'AGUA DE DIOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 19, 'ALBAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 35, 'ANAPOIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 40, 'ANOLAIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 53, 'ARBELAEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 86, 'BELTRAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 95, 'BITUIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 99, 'BOJACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 120, 'CABRERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 123, 'CACHIPAY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 126, 'CAJICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 148, 'CAPARRAPI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 151, 'CAQUEZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 154, 'CARMEN DE CARUPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 168, 'CHAGUANI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 175, 'CHIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 178, 'CHIPAQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 181, 'CHOACHI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 183, 'CHOCONTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 200, 'COGUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 214, 'COTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 224, 'CUCUNUBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 245, 'EL COLEGIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 258, 'EL PENON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 260, 'EL ROSAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 269, 'FACATATIVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 279, 'FOMEQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 281, 'FOSCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 286, 'FUNZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 288, 'FUQUENE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 290, 'FUSAGASUGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 293, 'GACHALA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 295, 'GACHANCIPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 297, 'GACHETA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 299, 'GAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 307, 'GIRARDOT', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 312, 'GRANADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 317, 'GUACHETA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 320, 'GUADUAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 322, 'GUASCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 324, 'GUATAQUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 326, 'GUATAVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 328, 'GUAYABAL DE SIQUIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 335, 'GUAYABETAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 339, 'GUTIERREZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 368, 'JERUSALEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 372, 'JUNIN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 377, 'LA CALERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 386, 'LA MESA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 394, 'LA PALMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 398, 'LA PEÑA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 402, 'LA VEGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 407, 'LENGUAZAQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 426, 'MACHETA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 430, 'MADRID', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 436, 'MANTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 438, 'MEDINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 473, 'MOSQUERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 483, 'NARIÑO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 486, 'NEMOCON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 488, 'NILO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 489, 'NIMAIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 491, 'NOCAIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 506, 'VENECIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 513, 'PACHO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 518, 'PAIME', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 524, 'PANDI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 530, 'PARATEBUENO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 535, 'PASCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 572, 'PUERTO SALGAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 580, 'PULI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 592, 'QUEBRADANEGRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 594, 'QUETAME', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 596, 'QUIPILE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 599, 'APULO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 612, 'RICAURTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 645, 'S.ANTONIO TEQUENDAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 649, 'SAN BERNARDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 653, 'SAN CAYETANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 658, 'SAN FRANCISCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 662, 'SAN JUAN DE RIO SECO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 718, 'SASAIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 736, 'SESQUILE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 740, 'SIBATE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 743, 'SILVANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 745, 'SIMIJACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 754, 'SOACHA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 758, 'SOPO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 769, 'SUBACHOQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 772, 'SUESCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 777, 'SUPATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 779, 'SUSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 781, 'SUTATAUSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 785, 'TABIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 793, 'TAUSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 797, 'TENA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 799, 'TENJO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 805, 'TIBACUY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 807, 'TIBIRITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 815, 'TOCAIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 817, 'TOCANCIPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 823, 'TOPAIPI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 839, 'UBALA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 841, 'UBAQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 843, 'UBATE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 845, 'UNE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 851, 'UTICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 862, 'VERGARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 867, 'VIANI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 871, 'VILLAGOMEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 873, 'VILLAPINZON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 875, 'VILLETA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 878, 'VIOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 885, 'YACOPI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 898, 'ZIPACON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 25, 899, 'ZIPAQUIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 1, 'QUIBDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 6, 'ACANDI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 25, 'ALTO BAUDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 50, 'ATRATO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 73, 'BAGADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 75, 'BAHIA SOLANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 77, 'BAJO BAUDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 99, 'BOJAYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 135, 'CANTON DEL SAN PABLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 160, 'CERTEGUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 205, 'CONDOTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 245, 'EL CARMEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 250, 'EL LITORAL DEL SAN JUAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 361, 'ITSMINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 372, 'JURADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 413, 'LLORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 491, 'NOVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 495, 'NUQUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 615, 'RIOSUCIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 660, 'SAN JOSE DEL PALMAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 745, 'SIPI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 787, 'TADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 27, 800, 'UNGUIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 1, 'NEIVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 6, 'ACEVEDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 13, 'AGRADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 16, 'AIPE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 20, 'ALGECIRAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 26, 'ALTAMIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 78, 'BARAYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 132, 'CAMPOALEGRE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 206, 'COLOMBIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 244, 'ELIAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 298, 'GARZON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 306, 'GIGANTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 319, 'GUADALUPE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 349, 'HOBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 357, 'IQUIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 359, 'ISNOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 378, 'LA ARGENTINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 396, 'LA PLATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 483, 'NATAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 503, 'OPORAPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 518, 'PAICOL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 524, 'PALERMO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 530, 'PALESTINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 548, 'PITAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 551, 'PITALITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 615, 'RIVERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 660, 'SALADOBLANCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 668, 'SAN AGUSTIN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 676, 'SANTA MARIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 770, 'SUAZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 791, 'TARQUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 797, 'TESALIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 799, 'TELLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 801, 'TERUEL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 807, 'TIMANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 872, 'VILLAVIEJA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 41, 885, 'YAGUARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 1, 'RIOHACHA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 35, 'ALBANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 78, 'BARRANCAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 90, 'DIBULLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 98, 'DISTRACCION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 110, 'EL MOLINO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 279, 'FONSECA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 378, 'HATONUEVO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 420, 'LA JAGUA DEL PILAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 430, 'MAICAO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 560, 'MANAURE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 650, 'SAN JUAN DEL CESAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 847, 'URIBIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 855, 'URUMITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 44, 874, 'VILLANUEVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 1, 'SANTAMARTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 53, 'ARACATACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 58, 'ARIGUANI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 98, 'ZONA BANANERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 161, 'CERRO SAN ANTONIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 170, 'CHIVOLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 189, 'CIENAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 245, 'EL BANCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 258, 'EL PIÑON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 268, 'EL RETEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 288, 'FUNDACION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 318, 'GUAMAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 541, 'PEDRAZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 545, 'PIJIÑO DEL CARMEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 551, 'PIVIJAY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 555, 'PLATO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 570, 'PUEBLOVIEJO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 605, 'REMOLINO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 675, 'SALAMINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 692, 'SAN SEBASTIAN BUENAVISTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 703, 'SAN ZENON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 707, 'SANTA ANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 745, 'SITIONUEVO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 798, 'TENERIFE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 47, 999, 'NUEVA GRANADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 1, 'VILLAVICENCIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 6, 'ACACIAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 110, 'BARRANCA DE UPIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 124, 'CABUYARO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 150, 'CASTILLA LA NUEVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 223, 'CUBARRAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 226, 'CUMARAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 245, 'EL CALVARIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 251, 'EL CASTILLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 270, 'EL DORADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 287, 'FUENTE DE ORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 313, 'GRANADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 318, 'GUAMAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 325, 'MAPIRIPAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 330, 'MESETAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 350, 'LA MACARENA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 370, 'LA URIBE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 400, 'LEJANIAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 450, 'PUERTO CONCORDIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 568, 'PUERTO GAITAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 573, 'PUERTO LOPEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 577, 'PUERTO LLERAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 590, 'PUERTO RICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 606, 'RESTREPO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 680, 'SAN CARLOS DE GUAROA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 683, 'SAN JUAN DE ARAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 686, 'SAN JUANITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 689, 'SAN MARTIN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 50, 711, 'VISTA HERMOSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 1, 'PASTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 19, 'ALBAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 22, 'ALDANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 36, 'ANCUYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 51, 'ARBOLEDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 79, 'BARBACOAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 83, 'BELEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 110, 'BUESACO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 203, 'COLON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 207, 'CONSACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 210, 'CONTADERO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 215, 'CORDOBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 224, 'CUASPUD', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 227, 'CUMBAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 233, 'CUMBITARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 240, 'CHACHAGUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 250, 'EL CHARCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 256, 'EL ROSARIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 258, 'EL TABLON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 260, 'EL TAMBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 287, 'FUNES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 317, 'GUACHUCAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 320, 'GUAITARILLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 323, 'GUALMATAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 352, 'ILES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 354, 'IMUES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 356, 'IPIALES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 378, 'LA CRUZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 381, 'LA FLORIDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 385, 'LA LLANADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 390, 'LA TOLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 399, 'LA UNION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 405, 'LEIVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 411, 'LINARES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 418, 'LOS ANDES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 427, 'MAGUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 435, 'MALLAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 473, 'MOSQUERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 490, 'OLAYA HERRERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 506, 'OSPINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 520, 'FRANCIS PIZARRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 540, 'POLICARPA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 560, 'POTOSI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 565, 'PROVIDENCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 573, 'PUERRES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 585, 'PUPIALES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 612, 'RICAURTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 621, 'ROBERTO PAYAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 678, 'SAMANIEGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 683, 'SANDONA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 685, 'SAN BERNARDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 687, 'SAN LORENZO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 693, 'SAN PABLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 694, 'SAN PEDRO DE CARTAGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 696, 'SANTABARBARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 699, 'SANTACRUZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 720, 'SAPUYES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 786, 'TAMINANGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 788, 'TANGUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 835, 'TUMACO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 838, 'TUQUERRES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 52, 885, 'YACUANQUER', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 1, 'CUCUTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 3, 'ABREGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 51, 'ARBOLEDAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 99, 'BOCHALEMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 109, 'BUCARASICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 125, 'CACOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 128, 'CACHIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 172, 'CHINACOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 174, 'CHITAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 206, 'CONVENCION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 223, 'CUCUTILLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 239, 'DURANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 245, 'EL CARMEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 250, 'EL TARRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 261, 'EL ZULIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 313, 'GRAMALOTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 344, 'HACARI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 347, 'HERRAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 377, 'LABATECA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 385, 'LA ESPERANZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 398, 'LA PLAYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 405, 'LOS PATIOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 418, 'LOURDES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 480, 'MUTISCUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 498, 'OCAÑA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 518, 'PAMPLONA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 520, 'PAMPLONITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 553, 'PUERTO SANTANDER', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 599, 'RAGONVALIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 660, 'SALAZAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 670, 'SAN CALIXTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 673, 'SAN CAYETANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 680, 'SANTIAGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 720, 'SARDINATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 743, 'SILOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 800, 'TEORAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 810, 'TIBU', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 820, 'TOLEDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 871, 'VILLA CARO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 54, 874, 'VILLA DEL ROSARIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 1, 'ARMENIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 111, 'BUENAVISTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 130, 'CALARCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 190, 'CIRCASIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 212, 'CORDOBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 272, 'FILANDIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 302, 'GENOVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 401, 'LA TEBAIDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 470, 'MONTENEGRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 548, 'PIJAO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 594, 'QUIMBAYA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 63, 690, 'SALENTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 1, 'PEREIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 45, 'APIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 75, 'BALBOA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 88, 'BELEN DE UMBRIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 170, 'DOS QUEBRADAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 318, 'GUATICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 383, 'LA CELIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 400, 'LA VIRGINIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 440, 'MARSELLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 456, 'MISTRATO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 572, 'PUEBLO RICO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 594, 'QUINCHIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 682, 'SANTA ROSA DE CABAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 66, 687, 'SANTUARIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 1, 'BUCARAMANGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 13, 'AGUADA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 20, 'ALBANIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 51, 'ARATOCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 77, 'BARBOSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 79, 'BARICHARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 81, 'BARRANCABERMEJA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 92, 'BETULIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 101, 'BOLIVAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 121, 'CABRERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 132, 'CALIFORNIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 147, 'CAPITANEJO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 152, 'CARCASI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 160, 'CEPITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 162, 'CERRITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 167, 'CHARALA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 169, 'CHARTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 176, 'CHIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 179, 'CHIPATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 190, 'CIMITARRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 207, 'CONCEPCION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 209, 'CONFINES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 211, 'CONTRATACION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 217, 'COROMORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 229, 'CURITI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 235, 'EL CARMEN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 245, 'EL GUACAMAYO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 250, 'EL PEÑON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 255, 'EL PLAYON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 264, 'ENCINO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 266, 'ENCISO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 271, 'FLORIAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 276, 'FLORIDABLANCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 296, 'GALAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 298, 'GAMBITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 307, 'GIRON (SAN JUAN DE)', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 318, 'GUACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 320, 'GUADALUPE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 322, 'GUAPOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 324, 'GUAVATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 327, 'GUEPSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 344, 'HATO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 368, 'JESUS MARIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 370, 'JORDAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 377, 'LA BELLEZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 385, 'LANDAZURI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 397, 'LA PAZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 406, 'LEBRIJA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 418, 'LOS SANTOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 425, 'MACARAVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 432, 'MALAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 444, 'MATANZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 464, 'MOGOTES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 468, 'MOLAGAVITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 498, 'OCAMONTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 500, 'OIBA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 502, 'ONZAGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 522, 'PALMAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 524, 'PALMAS SOCORRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 533, 'PARAMO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 547, 'PIEDECUESTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 549, 'PINCHOTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 572, 'PUENTE NACIONAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 573, 'PUERTO PARRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 575, 'PUERTO WILCHES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 615, 'RIONEGRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 655, 'SABANA DE TORRES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 669, 'SAN ANDRES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 673, 'SAN BENITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 679, 'SAN GIL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 682, 'SAN JOAQUIN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 684, 'SAN JOSE DE MIRANDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 686, 'SAN MIGUEL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 689, 'SAN VICENTE DE CHUCURI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 705, 'SANTA BARBARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 720, 'SANTA HELENA DEL OPON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 745, 'SIMACOTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 755, 'SOCORRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 770, 'SUAITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 773, 'SUCRE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 780, 'SURATA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 820, 'TONA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 855, 'VALLE DE SAN JOSE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 861, 'VELEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 867, 'VETAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 872, 'VILLANUEVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 68, 895, 'ZAPATOCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 1, 'SINCELEJO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 110, 'BUENAVISTA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 124, 'CAIMITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 204, 'COLOSO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 215, 'COROZAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 221, 'COVEÑAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 230, 'CHALAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 235, 'GALERAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 265, 'GUARANDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 400, 'LA UNION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 418, 'LOS PALMITOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 429, 'MAJAGUAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 473, 'MORROA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 508, 'OVEJAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 523, 'PALMITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 670, 'SAMPUES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 678, 'SAN BENITO ABAD', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 702, 'SAN JUAN DE BETULIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 708, 'SAN MARCOS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 713, 'SAN ONOFRE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 717, 'SAN PEDRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 742, 'SINCE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 771, 'SUCRE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 820, 'TOLU', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 70, 823, 'TOLUVIEJO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 1, 'IBAGUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 24, 'ALPUJARRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 26, 'ALVARADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 30, 'AMBALEMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 43, 'ANZOATEGUI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 55, 'ARMERO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 67, 'ATACO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 124, 'CAJAMARCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 148, 'CARMEN DE APICALA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 152, 'CASABIANCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 168, 'CHAPARRAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 200, 'COELLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 217, 'COYAIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 226, 'CUNDAY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 236, 'DOLORES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 268, 'ESPINAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 270, 'FALAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 275, 'FLANDES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 283, 'FRESNO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 319, 'GUAMO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 347, 'HERVEO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 349, 'HONDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 352, 'ICONONZO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 408, 'LERIDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 411, 'LIBANO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 443, 'MARIQUITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 449, 'MELGAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 461, 'MURILLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 483, 'NATAGAIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 504, 'ORTEGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 520, 'PALOCABILDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 547, 'PIEDRAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 555, 'PLANADAS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 563, 'PRADO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 585, 'PURIFICACION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 616, 'RIOBLANCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 622, 'RONCESVALLES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 624, 'ROVIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 671, 'SALDAÑA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 675, 'SAN ANTONIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 678, 'SAN LUIS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 686, 'SANTA ISABEL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 770, 'SUAREZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 854, 'VALLE DE SAN JUAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 861, 'VENADILLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 870, 'VILLAHERMOSA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 73, 873, 'VILLARRICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 1, 'CALI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 20, 'ALCALA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 36, 'ANDALUCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 41, 'ANSERMANUEVO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 54, 'ARGELIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 100, 'BOLIVAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 109, 'BUENAVENTURA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 111, 'BUGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 113, 'BUGALAGRANDE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 122, 'CAICEDONIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 126, 'CALIMA (DARIEN)', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 130, 'CANDELARIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 147, 'CARTAGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 233, 'DAGUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 243, 'EL AGUILA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 246, 'EL CAIRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 248, 'EL CERRITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 250, 'EL DOVIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 275, 'FLORIDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 306, 'GINEBRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 318, 'GUACARI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 364, 'JAMUNDI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 377, 'LA CUMBRE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 400, 'LA UNION', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 403, 'LA VICTORIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 497, 'OBANDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 520, 'PALMIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 563, 'PRADERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 606, 'RESTREPO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 616, 'RIOFRIO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 622, 'ROLDANILLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 670, 'SAN PEDRO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 736, 'SEVILLA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 823, 'TORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 828, 'TRUJILLO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 834, 'TULUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 845, 'ULLOA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 863, 'VERSALLES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 869, 'VIJES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 890, 'YOTOCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 892, 'YUMBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 76, 895, 'ZARZAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 81, 1, 'ARAUCA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 81, 65, 'ARAUQUITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 81, 220, 'CRAVO NORTE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 81, 300, 'FORTUL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 81, 591, 'PUERTO RONDON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 81, 736, 'SARAVENA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 81, 794, 'TAME', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 1, 'YOPAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 10, 'AGUAZUL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 15, 'CHAMEZA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 125, 'HATO COROZAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 136, 'LA SALINA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 139, 'MANI', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 162, 'MONTERREY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 225, 'NUNCHIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 230, 'OROCUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 250, 'PAZ DE ARIPORO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 263, 'PORE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 279, 'RECETOR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 300, 'SABANALARGA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 315, 'SACAMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 325, 'SAN LUIS DE PALENQUE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 400, 'TAMARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 410, 'TAURAMENA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 430, 'TRINIDAD', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 85, 440, 'VILLANUEVA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 1, 'MOCOA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 219, 'COLON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 320, 'ORITO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 568, 'PUERTO ASIS', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 569, 'PUERTO CAICEDO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 571, 'PUERTO GUZMAN', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 573, 'PUERTO  LEGUIZAMO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 749, 'SIBUNDOY', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 755, 'SAN FRANCISCO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 757, 'SAN MIGUEL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 760, 'SANTIAGO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 865, 'VALLE GUAMUEZ', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 86, 885, 'VILLAGARZON', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 88, 1, 'SAN ANDRES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 88, 564, 'PROVIDENCIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 1, 'LETICIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 263, 'EL ENCANTO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 405, 'LA CHORRERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 407, 'LA PEDRERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 430, 'LA VICTORIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 460, 'MIRITI-PARANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 530, 'PUERTO ALEGRIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 536, 'PUERTO ARICA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 540, 'PUERTO NARIÑO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 669, 'PTO SANTANDER', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 91, 798, 'TARAPACA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 1, 'INIRIDA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 343, 'GUAVIARE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 883, 'SAN FELIPE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 884, 'PUERTO COLOMBIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 885, 'LA GUADALUPE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 886, 'CACAHUAL', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 887, 'PANA PANA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 94, 888, 'CD. MORICHAL NUEVO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 95, 1, 'SAN JOSE DEL GUAVIARE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 95, 15, 'CALAMAR', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 95, 25, 'EL RETORNO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 95, 200, 'MIRAFLORES', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 1, 'MITU', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 161, 'CARURU', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 511, 'PACOA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 666, 'TARAIRA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 777, 'PAPUNAUA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 889, 'YAVARATE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 890, 'VILLA FATIMA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 97, 891, 'ACARICUARA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 99, 1, 'PUERTO CARRENO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 99, 524, 'LA PRIMAVERA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 99, 572, 'SANTA RITA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 99, 624, 'SANTA ROSALIA', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 99, 760, 'SAN JOSE DE OCUNE', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 170, 99, 773, 'CUMARIBO', NULL, NULL, 1);
INSERT INTO municipio (id_cont, id_pais, dpto_codi, muni_codi, muni_nomb, homologa_muni, homologa_idmuni, activa) VALUES (1, 218, 1, 1, 'QUITO', NULL, NULL, 1);


--
-- TOC entry 2634 (class 0 OID 16444)
-- Dependencies: 1711
-- Data for Name: par_serv_servicios; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2726 (class 0 OID 17425)
-- Dependencies: 1803
-- Data for Name: prestamo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2721 (class 0 OID 17281)
-- Dependencies: 1798
-- Data for Name: radicado; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2635 (class 0 OID 16450)
-- Dependencies: 1712
-- Data for Name: series; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2727 (class 0 OID 17456)
-- Dependencies: 1804
-- Data for Name: sgd_acm_acusemsg; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2660 (class 0 OID 16603)
-- Dependencies: 1737
-- Data for Name: sgd_actadd_actualiadicional; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2704 (class 0 OID 17002)
-- Dependencies: 1781
-- Data for Name: sgd_admin_depe_historico; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2636 (class 0 OID 16457)
-- Dependencies: 1713
-- Data for Name: sgd_admin_dependencia_estado; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2637 (class 0 OID 16462)
-- Dependencies: 1714
-- Data for Name: sgd_admin_observacion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2705 (class 0 OID 17012)
-- Dependencies: 1782
-- Data for Name: sgd_admin_usua_historico; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2638 (class 0 OID 16467)
-- Dependencies: 1715
-- Data for Name: sgd_admin_usua_perfiles; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2728 (class 0 OID 17467)
-- Dependencies: 1805
-- Data for Name: sgd_agen_agendados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2729 (class 0 OID 17478)
-- Dependencies: 1806
-- Data for Name: sgd_anar_anexarg; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2730 (class 0 OID 17494)
-- Dependencies: 1807
-- Data for Name: sgd_anu_anulados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2675 (class 0 OID 16752)
-- Dependencies: 1752
-- Data for Name: sgd_aper_adminperfiles; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2661 (class 0 OID 16619)
-- Dependencies: 1738
-- Data for Name: sgd_aplfad_plicfunadi; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2639 (class 0 OID 16472)
-- Dependencies: 1716
-- Data for Name: sgd_apli_aplintegra; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_apli_aplintegra (sgd_apli_codi, sgd_apli_descrip, sgd_apli_lk1desc, sgd_apli_lk1, sgd_apli_lk2desc, sgd_apli_lk2, sgd_apli_lk3desc, sgd_apli_lk3, sgd_apli_lk4desc, sgd_apli_lk4) VALUES (0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 2662 (class 0 OID 16630)
-- Dependencies: 1739
-- Data for Name: sgd_aplmen_aplimens; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2663 (class 0 OID 16641)
-- Dependencies: 1740
-- Data for Name: sgd_aplus_plicusua; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2742 (class 0 OID 17741)
-- Dependencies: 1824
-- Data for Name: sgd_arch_depe; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_arch_depe (sgd_arch_depe, sgd_arch_edificio, sgd_arch_item, sgd_arch_id) VALUES ('998', 118, 0, 1);


--
-- TOC entry 2686 (class 0 OID 16820)
-- Dependencies: 1763
-- Data for Name: sgd_arg_pliego; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2640 (class 0 OID 16478)
-- Dependencies: 1717
-- Data for Name: sgd_argd_argdoc; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2679 (class 0 OID 16779)
-- Dependencies: 1756
-- Data for Name: sgd_argup_argudoctop; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2743 (class 0 OID 17818)
-- Dependencies: 1827
-- Data for Name: sgd_auditoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 34,^13^,^EWSD 1^,^R1^)', 1246551858, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 35,^13^,^EWSD 2^,^R2^)', 1246551858, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^36^,^11^,^BNUSA 1^,^BND1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^37^,^36^,^CDM 1^,^DMK1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^38^,^37^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^39^,^37^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^40^,^37^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^41^,^37^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^42^,^36^,^CDM 2^,^DMK2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^43^,^42^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^44^,^42^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^45^,^42^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^46^,^42^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^47^,^36^,^CDM 3^,^DMK3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^48^,^47^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^49^,^47^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^50^,^47^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^51^,^47^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^52^,^11^,^BNUSA 2^,^BND2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^53^,^52^,^CDM 1^,^DMK1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^54^,^53^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^55^,^53^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^56^,^53^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^57^,^53^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^58^,^52^,^CDM 2^,^DMK2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^59^,^58^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^60^,^58^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^61^,^58^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^62^,^58^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^63^,^52^,^CDM 3^,^DMK3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^64^,^63^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^65^,^63^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^66^,^63^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^67^,^63^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^68^,^11^,^BNUSA 3^,^BND3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^69^,^68^,^CDM 1^,^DMK1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^70^,^69^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^71^,^69^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^72^,^69^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^73^,^69^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^74^,^68^,^CDM 2^,^DMK2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^75^,^74^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^76^,^74^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^77^,^74^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^78^,^74^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^79^,^68^,^CDM 3^,^DMK3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^80^,^79^,^FKE 1^,^FEL1^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^81^,^79^,^FKE 2^,^FEL2^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^82^,^79^,^FKE 3^,^FEL3^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^83^,^79^,^FKE 4^,^FEL4^)', 1246551902, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^11^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^12^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^14^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^17^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^18^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^19^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^16^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^25^', 1246551926, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^22^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^23^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^24^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^15^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^20^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^13^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^26^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^27^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^28^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^29^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^30^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^31^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^32^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^33^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^34^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^35^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^36^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^37^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^38^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^39^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^40^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^41^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^42^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^43^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^44^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^45^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^46^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^47^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^48^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^49^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^50^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^51^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^52^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^53^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^54^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^55^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^56^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^57^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^58^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^59^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^60^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^61^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^62^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^63^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^64^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^65^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^66^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^67^', 1246551927, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^68^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^69^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^70^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^71^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^72^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^73^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^74^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^75^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^76^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^77^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^78^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^79^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^80^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^81^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^82^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS WHERE SGD_EIT_CODIGO = ^83^', 1246551928, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('', 'u', 'USUARIO', 'UPDATE USUARIO 
		SET USUA_SESION=^FIN  2009:07:02 12:0727:01^ 
		WHERE USUA_SESION LIKE ^%090702102807O127001ADMON%^', 1246552021, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'USUARIO', 'UPDATE USUARIO SET USUA_SESION= ^090702122706O127001ADMON^ ,USUA_FECH_SESION=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^)    WHERE  USUA_LOGIN = ^ADMON^ ', 1246552026, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 84,^9^,^ESTANTES 1^,^EN1^)', 1246552137, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 85,^9^,^ESTANTES 2^,^EN2^)', 1246552137, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 86,^9^,^ESTANTES 3^,^EN3^)', 1246552137, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 87,^9^,^ESTANTES 4^,^EN4^)', 1246552137, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 88,^9^,^ESTANTES 5^,^EN5^)', 1246552137, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 89,^10^,^EWSD 1^,^ES1^)', 1246552208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 90,^10^,^EWSD 2^,^ES2^)', 1246552208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 91,^10^,^EWSD 3^,^ES3^)', 1246552208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 92,^10^,^EWSD 4^,^ES4^)', 1246552208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 93,^10^,^EWSD 5^,^ES5^)', 1246552208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^94^,^10^,^ESTANTE 1^,^EST1^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^95^,^94^,^ENTREPA�OS 1^,^ENTR1^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^96^,^94^,^ENTREPA�OS 2^,^ENTR2^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^97^,^94^,^ENTREPA�OS 3^,^ENTR3^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^98^,^10^,^ESTANTE 2^,^EST2^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^99^,^98^,^ENTREPA�OS 1^,^ENTR1^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^100^,^98^,^ENTREPA�OS 2^,^ENTR2^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^101^,^98^,^ENTREPA�OS 3^,^ENTR3^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^102^,^10^,^ESTANTE 3^,^EST3^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^103^,^102^,^ENTREPA�OS 1^,^ENTR1^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^104^,^102^,^ENTREPA�OS 2^,^ENTR2^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^105^,^102^,^ENTREPA�OS 3^,^ENTR3^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^106^,^10^,^ESTANTE 4^,^EST4^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^107^,^106^,^ENTREPA�OS 1^,^ENTR1^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^108^,^106^,^ENTREPA�OS 2^,^ENTR2^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^109^,^106^,^ENTREPA�OS 3^,^ENTR3^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^110^,^10^,^ESTANTE 5^,^EST5^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^111^,^110^,^ENTREPA�OS 1^,^ENTR1^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^112^,^110^,^ENTREPA�OS 2^,^ENTR2^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^113^,^110^,^ENTREPA�OS 3^,^ENTR3^)', 1246552237, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_ARCH_DEPE', 'INSERT INTO SGD_ARCH_DEPE (SGD_ARCH_ID,SGD_ARCH_DEPE,SGD_ARCH_EDIFICIO,SGD_ARCH_ITEM) VALUES (1,^998^,8,0)', 1246552981, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_ARCH_DEPE', 'INSERT INTO SGD_ARCH_DEPE (SGD_ARCH_ID,SGD_ARCH_DEPE,SGD_ARCH_EDIFICIO,SGD_ARCH_ITEM) VALUES (1,^998^,8,0)', 1246553117, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_ARCH_DEPE', 'UPDATE SGD_ARCH_DEPE SET SGD_ARCH_DEPE=^998^,SGD_ARCH_EDIFICIO=8,SGD_ARCH_ITEM=9 WHERE SGD_ARCH_ID=1 ', 1246553855, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_ARCH_DEPE', 'INSERT INTO SGD_ARCH_DEPE (SGD_ARCH_ID,SGD_ARCH_DEPE,SGD_ARCH_EDIFICIO,SGD_ARCH_ITEM) VALUES (2,^998^,8,0)', 1246554379, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'd', 'SGD_ARCH_DEPE', 'DELETE FROM SGD_ARCH_DEPE WHERE SGD_ARCH_ID LIKE ^1^', 1246554432, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'd', 'SGD_ARCH_DEPE', 'DELETE FROM SGD_ARCH_DEPE WHERE SGD_ARCH_ID = ^2^', 1246554540, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^0^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^2^,SGD_EXP_FECH=^2009-07-02^,SGD_EXP_FOLIOS=^0^,SGD_EXP_EDIFICIO=^8^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^0^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^0^,SGD_EXP_NREF=^0^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246555590, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^0^, MEDIO_M=^0^ WHERE RADI_NUME_RADI LIKE ^20099980000012^', 1246555590, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^0^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-02^,SGD_EXP_FOLIOS=^0^,SGD_EXP_EDIFICIO=^8^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^0^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^0^,SGD_EXP_NREF=^0^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246556315, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^4^, MEDIO_M=^6^ WHERE RADI_NUME_RADI LIKE ^20099980000012^', 1246556315, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000012,998,1,1,998,9876543210,9876543210,62,^ MODIFICADO DE LA UBICACION DE ALMACENAMIENTO EN FISICO^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246556315, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^0^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-02^,SGD_EXP_FOLIOS=^0^,SGD_EXP_EDIFICIO=^8^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^0^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^0^,SGD_EXP_NREF=^0^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246556402, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^5^, MEDIO_M=^6^ WHERE RADI_NUME_RADI LIKE ^20099980000012^', 1246556402, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000012,998,1,1,998,9876543210,9876543210,62,^ MODIFICADO DE LA UBICACION DE ALMACENAMIENTO EN FISICO^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246556402, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^0^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-02^,SGD_EXP_FOLIOS=^0^,SGD_EXP_EDIFICIO=^8^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^0^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^0^,SGD_EXP_NREF=^0^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246556442, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^5^, MEDIO_M=^3^ WHERE RADI_NUME_RADI = ^20099980000012^', 1246556442, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000012,998,1,1,998,9876543210,9876543210,62,^ MODIFICADO DE LA UBICACION DE ALMACENAMIENTO EN FISICO^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246556442, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246567715, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246567870, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO = 1', 1246567965, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246567987, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246568127, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE 1', 1246568184, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO = 1', 1246568224, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO = ^1^', 1246568267, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246568451, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'USUARIO', 'UPDATE USUARIO 
		SET USUA_SESION=^FIN  2009:07:02 17:0715:36^ 
		WHERE USUA_SESION LIKE ^%090702122706O127001ADMON%^', 1246569336, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'USUARIO', 'UPDATE USUARIO SET USUA_SESION= ^090703092616O127001ADMON^ ,USUA_FECH_SESION=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^)    WHERE  USUA_LOGIN = ^ADMON^ ', 1246627576, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^^,SGD_EXP_CAJA=^^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246627630, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 114,^95^,^CAJA 1^,^CJ1^)', 1246628119, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 115,^95^,^CAJA 2^,^CJ2^)', 1246628119, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 116,^95^,^CAJA 3^,^CJ3^)', 1246628119, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( 117,^95^,^CAJA 4^,^CJ4^)', 1246628119, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^95^,SGD_EXP_CAJA=^116^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246628228, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^95^,SGD_EXP_CAJA=^116^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO LIKE ^1^', 1246628405, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ENTREPA=^95^,SGD_EXP_CAJA=^116^,SGD_EXP_EDIFICIO=^8^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND SGD_EXP_ESTADO = ^1^', 1246628493, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'RADICADO', 'INSERT INTO RADICADO(RADI_TIPO_DERI,SGD_SPUB_CODIGO,RADI_CUENTAI,EESP_CODI,MREC_CODI,RADI_FECH_OFIC,RADI_NUME_DERI,RADI_USUA_RADI,RADI_PAIS,RA_ASUN,RADI_DESC_ANEX,RADI_DEPE_RADI,RADI_USUA_ACTU,CARP_CODI,CARP_PER,RADI_NUME_RADI,TRTE_CODI,RADI_FECH_RADI,RADI_DEPE_ACTU,TDOC_CODI,TDID_CODI,CODI_NIVEL,SGD_APLI_CODI,RADI_PATH) VALUES (1,1,^^,0,1,^2009-07-03^,NULL,1,^170^,^ BVMRFG FCGNM DNC^,^45^,^998^,1,1,0,20099980000011,0,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),^998^,0,0,5,0,NULL)', 1246632079, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000011,998,1,1,998,9876543210,9876543210,2,^ ^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246632079, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_DIR_DRECCIONES', 'UPDATE SGD_DIR_DRECCIONES SET SGD_TRD_CODIGO=1,SGD_DIR_NOMREMDES=^TETR YFEDYE TERT^,SGD_DIR_DOC=12345357,MUNI_CODI=1,DPTO_CODI=11,ID_PAIS=170,ID_CONT=1,SGD_DOC_FUN=NULL,SGD_OEM_CODIGO=NULL,SGD_CIU_CODIGO=1,SGD_ESP_CODI=NULL,SGD_SEC_CODIGO=0,SGD_DIR_DIRECCION=^ETR534435326ER ^,SGD_DIR_TELEFONO=^^,SGD_DIR_MAIL=^ ^,SGD_DIR_CODIGO=2,SGD_DIR_NOMBRE=^^ WHERE RADI_NUME_RADI=20099980000011 AND SGD_DIR_TIPO=1', 1246632079, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_DIR_DRECCIONES', 'INSERT INTO SGD_DIR_DRECCIONES (SGD_TRD_CODIGO,SGD_DIR_NOMREMDES,SGD_DIR_DOC,MUNI_CODI,DPTO_CODI,ID_PAIS,ID_CONT,SGD_DOC_FUN,SGD_OEM_CODIGO,SGD_CIU_CODIGO,SGD_ESP_CODI,RADI_NUME_RADI,SGD_SEC_CODIGO,SGD_DIR_DIRECCION,SGD_DIR_TELEFONO,SGD_DIR_MAIL,SGD_DIR_TIPO,SGD_DIR_CODIGO,SGD_DIR_NOMBRE) VALUES (1,^TETR YFEDYE TERT^,12345357,1,11,170,1,NULL,NULL,1,NULL,20099980000011,0,^ETR534435326ER ^,^^,^ ^,1,2,^^)', 1246632079, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_LEIDO=1    WHERE  RADI_DEPE_ACTU = 998  AND  RADI_USUA_ACTU = 1  AND  RADI_NUME_RADI = 20099980000012 ', 1246632123, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_LEIDO=1    WHERE  RADI_DEPE_ACTU = 998  AND  RADI_USUA_ACTU = 1  AND  RADI_NUME_RADI = 20099980000011 ', 1246632130, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_RDF_RETDOCF', 'INSERT INTO SGD_RDF_RETDOCF(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_DOC,SGD_MRD_CODIGO,SGD_RDF_FECH) VALUES (20099980000011,998,1,9876543210,3,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246632138, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000011,998,1,1,998,9876543210,9876543210,32,^^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246632138, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET TDOC_CODI=4 WHERE 
						RADI_NUME_RADI = 20099980000011', 1246632138, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET FECH_VCMTO =  ^Y-M-D H:I:S^ WHERE RADI_NUME_RADI = 20099980000011 ', 1246632138, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_LEIDO=1    WHERE  RADI_DEPE_ACTU = 998  AND  RADI_USUA_ACTU = 1  AND  RADI_NUME_RADI = 20099980000011 ', 1246632140, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO
					SET
					', 'UPDATE RADICADO
					SET
					  RADI_USU_ANTE=^ADMON^
					  ,RADI_DEPE_ACTU=999
					  ,RADI_USUA_ACTU=1
					  ,CARP_CODI=0
					  ,CARP_PER=0
					  ,RADI_LEIDO=0
					  ,RADI_FECH_AGEND=NULL
					  ,RADI_AGEND=NULL
					  ,CODI_NIVEL=1
					  ,SGD_SPUB_CODIGO=0
				 WHERE RADI_DEPE_ACTU=998
				 	   AND RADI_USUA_ACTU=1
					   AND RADI_NUME_RADI IN(20099980000011)', 1246632460, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000011,998,1,1,999,9876543210,1234567890,13,^POR QUE SI^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246632460, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'RADICADO', 'INSERT INTO RADICADO(RADI_TIPO_DERI,SGD_SPUB_CODIGO,RADI_CUENTAI,EESP_CODI,MREC_CODI,RADI_FECH_OFIC,RADI_NUME_DERI,RADI_USUA_RADI,RADI_PAIS,RA_ASUN,RADI_DESC_ANEX,RADI_DEPE_RADI,RADI_USUA_ACTU,CARP_CODI,CARP_PER,RADI_NUME_RADI,TRTE_CODI,RADI_FECH_RADI,RADI_DEPE_ACTU,TDOC_CODI,TDID_CODI,CODI_NIVEL,SGD_APLI_CODI,RADI_PATH) VALUES (1,1,^^,0,1,^2009-07-03^,NULL,1,^170^,^FB NDF ^,^DFGHBFD^,^998^,1,0,0,20099980000022,0,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),^998^,0,0,5,0,NULL)', 1246633503, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000022,998,1,1,998,9876543210,9876543210,2,^ ^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246633503, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_DIR_DRECCIONES', 'UPDATE SGD_DIR_DRECCIONES SET SGD_TRD_CODIGO=1,SGD_DIR_NOMREMDES=^TETR YFEDYE TERT^,SGD_DIR_DOC=12345357,MUNI_CODI=1,DPTO_CODI=11,ID_PAIS=170,ID_CONT=1,SGD_DOC_FUN=NULL,SGD_OEM_CODIGO=NULL,SGD_CIU_CODIGO=1,SGD_ESP_CODI=NULL,SGD_SEC_CODIGO=0,SGD_DIR_DIRECCION=^ETR534435326ER ^,SGD_DIR_TELEFONO=^^,SGD_DIR_MAIL=^ ^,SGD_DIR_CODIGO=3,SGD_DIR_NOMBRE=^^ WHERE RADI_NUME_RADI=20099980000022 AND SGD_DIR_TIPO=1', 1246633503, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_DIR_DRECCIONES', 'INSERT INTO SGD_DIR_DRECCIONES (SGD_TRD_CODIGO,SGD_DIR_NOMREMDES,SGD_DIR_DOC,MUNI_CODI,DPTO_CODI,ID_PAIS,ID_CONT,SGD_DOC_FUN,SGD_OEM_CODIGO,SGD_CIU_CODIGO,SGD_ESP_CODI,RADI_NUME_RADI,SGD_SEC_CODIGO,SGD_DIR_DIRECCION,SGD_DIR_TELEFONO,SGD_DIR_MAIL,SGD_DIR_TIPO,SGD_DIR_CODIGO,SGD_DIR_NOMBRE) VALUES (1,^TETR YFEDYE TERT^,12345357,1,11,170,1,NULL,NULL,1,NULL,20099980000022,0,^ETR534435326ER ^,^^,^ ^,1,3,^^)', 1246633503, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_LEIDO=1    WHERE  RADI_DEPE_ACTU = 998  AND  RADI_USUA_ACTU = 1  AND  RADI_NUME_RADI = 20099980000012 ', 1246633903, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_LEIDO=1    WHERE  RADI_DEPE_ACTU = 998  AND  RADI_USUA_ACTU = 1  AND  RADI_NUME_RADI = 20099980000012 ', 1246633905, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_LEIDO=1    WHERE  RADI_DEPE_ACTU = 998  AND  RADI_USUA_ACTU = 1  AND  RADI_NUME_RADI = 20099980000012 ', 1246635054, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_ARCHIVO=^2^,SGD_EXP_FECHFIN=^2009-07-03^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^', 1246635058, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_HFLD_HISTFLUJODOC', 'INSERT INTO SGD_HFLD_HISTFLUJODOC(SGD_EXP_NUMERO,SGD_FEXP_CODIGO,RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_DOC,SGD_TTR_CODIGO,SGD_HFLD_OBSERVA,SGD_HFLD_FECH) VALUES (^2009998010100001E^,1,20099980000012,998,1,9876543210,58,^SE CERRO EL EXPEDIENTE  ^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246635058, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_LEIDO=1    WHERE  RADI_DEPE_ACTU = 998  AND  RADI_USUA_ACTU = 1  AND  RADI_NUME_RADI = 20099980000012 ', 1246635061, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EINV_INVENTARIO', 'INSERT INTO SGD_EINV_INVENTARIO (SGD_EINV_CODIGO,SGD_DEPE_NOMB,SGD_DEPE_CODI,SGD_EINV_EXPNUM,
	SGD_EINV_TITULO,SGD_EINV_UNIDAD,SGD_EINV_FECH,SGD_EINV_FECHFIN,SGD_EINV_RADICADOS,SGD_EINV_FOLIOS,
	SGD_EINV_NUNDOCU,SGD_EINV_NUNDOCUBODEGA,SGD_EINV_CAJA,SGD_EINV_CAJABODEGA,SGD_EINV_SRD,SGD_EINV_NOMSRD,
	SGD_EINV_SBRD,SGD_EINV_NOMSBRD,SGD_EINV_RETENCION,SGD_EINV_DISFINAL,SGD_EINV_UBICACION,SGD_EINV_OBSERVACION)
	VALUES (^1^,^DEPENDENCIA DE PRUEBA^,^998^,^2009998010100001E^,^^,^1^,^2009-07-02^,^2009-07-03^,
	^20099980000012^,^^,^0^,^^,^116^,^^,^1^,^TEMP^,
	^1^,^TEMP^,^1^,^CONSERVACION TOTAL^,^-Z2-EST1-ENTR1-CJ3^,^^)', 1246636585, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EINV_INVENTARIO', 'INSERT INTO SGD_EINV_INVENTARIO (SGD_EINV_CODIGO,SGD_DEPE_NOMB,SGD_DEPE_CODI,SGD_EINV_EXPNUM,
	SGD_EINV_TITULO,SGD_EINV_UNIDAD,SGD_EINV_FECH,SGD_EINV_FECHFIN,SGD_EINV_RADICADOS,SGD_EINV_FOLIOS,
	SGD_EINV_NUNDOCU,SGD_EINV_NUNDOCUBODEGA,SGD_EINV_CAJA,SGD_EINV_CAJABODEGA,SGD_EINV_SRD,SGD_EINV_NOMSRD,
	SGD_EINV_SBRD,SGD_EINV_NOMSBRD,SGD_EINV_RETENCION,SGD_EINV_DISFINAL,SGD_EINV_UBICACION,SGD_EINV_OBSERVACION)
	VALUES (^2^,^DEPENDENCIA DE PRUEBA^,^998^,^2009998010100001E^,^^,^1^,^2009-07-02^,^2009-07-03^,
	^20099980000012^,^^,^0^,^^,^116^,^^,^1^,^TEMP^,
	^1^,^TEMP^,^1^,^CONSERVACION TOTAL^,^CDSF-Z2-EST1-ENTR1-CJ3^,^^)', 1246636639, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EINV_INVENTARIO', 'INSERT INTO SGD_EINV_INVENTARIO (SGD_EINV_CODIGO,SGD_DEPE_NOMB,SGD_DEPE_CODI,SGD_EINV_EXPNUM,
	SGD_EINV_TITULO,SGD_EINV_UNIDAD,SGD_EINV_FECH,SGD_EINV_FECHFIN,SGD_EINV_RADICADOS,SGD_EINV_FOLIOS,
	SGD_EINV_NUNDOCU,SGD_EINV_NUNDOCUBODEGA,SGD_EINV_CAJA,SGD_EINV_CAJABODEGA,SGD_EINV_SRD,SGD_EINV_NOMSRD,
	SGD_EINV_SBRD,SGD_EINV_NOMSBRD,SGD_EINV_RETENCION,SGD_EINV_DISFINAL,SGD_EINV_UBICACION,SGD_EINV_OBSERVACION)
	VALUES (^3^,^DEPENDENCIA DE PRUEBA^,^998^,^2009998010100001E^,^^,^1^,^2009-07-02^,^2009-07-03^,
	^20099980000012^,^^,^0^,^^,^116^,^^,^1^,^TEMP^,
	^1^,^TEMP^,^1^,^CONSERVACION TOTAL^,^CDSF-Z2-EST1-ENTR1-CJ3^,^^)', 1246636698, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EINV_INVENTARIO', 'INSERT INTO SGD_EINV_INVENTARIO (SGD_EINV_CODIGO,SGD_DEPE_NOMB,SGD_DEPE_CODI,SGD_EINV_EXPNUM,
	SGD_EINV_TITULO,SGD_EINV_UNIDAD,SGD_EINV_FECH,SGD_EINV_FECHFIN,SGD_EINV_RADICADOS,SGD_EINV_FOLIOS,
	SGD_EINV_NUNDOCU,SGD_EINV_NUNDOCUBODEGA,SGD_EINV_CAJA,SGD_EINV_CAJABODEGA,SGD_EINV_SRD,SGD_EINV_NOMSRD,
	SGD_EINV_SBRD,SGD_EINV_NOMSBRD,SGD_EINV_RETENCION,SGD_EINV_DISFINAL,SGD_EINV_UBICACION,SGD_EINV_OBSERVACION)
	VALUES (^4^,^DEPENDENCIA DE PRUEBA^,^998^,^2009998010100001E^,^^,^1^,^2009-07-02^,^2009-07-03^,
	^20099980000012^,^5^,^0^,^^,^116^,^^,^1^,^TEMP^,
	^1^,^TEMP^,^1^,^CONSERVACION TOTAL^,^CDSF-Z2-EST1-ENTR1-CJ3^,^^)', 1246636769, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EINV_INVENTARIO', 'INSERT INTO SGD_EINV_INVENTARIO (SGD_EINV_CODIGO,SGD_DEPE_NOMB,SGD_DEPE_CODI,SGD_EINV_EXPNUM,
	SGD_EINV_TITULO,SGD_EINV_UNIDAD,SGD_EINV_FECH,SGD_EINV_FECHFIN,SGD_EINV_RADICADOS,SGD_EINV_FOLIOS,
	SGD_EINV_NUNDOCU,SGD_EINV_NUNDOCUBODEGA,SGD_EINV_CAJA,SGD_EINV_CAJABODEGA,SGD_EINV_SRD,SGD_EINV_NOMSRD,
	SGD_EINV_SBRD,SGD_EINV_NOMSBRD,SGD_EINV_RETENCION,SGD_EINV_DISFINAL,SGD_EINV_UBICACION,SGD_EINV_OBSERVACION)
	VALUES (^5^,^DEPENDENCIA DE PRUEBA^,^998^,^2009998010100001E^,^^,^1^,^2009-07-02^,^2009-07-03^,
	^20099980000012^,^5^,^0^,^^,^116^,^^,^1^,^TEMP^,
	^1^,^TEMP^,^1^,^CONSERVACION TOTAL^,^CDSF-Z2-EST1-ENTR1-CJ3^,^ ^)', 1246636919, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EINV_INVENTARIO', 'INSERT INTO SGD_EINV_INVENTARIO (SGD_EINV_CODIGO,SGD_DEPE_NOMB,SGD_DEPE_CODI,SGD_EINV_EXPNUM,
	SGD_EINV_TITULO,SGD_EINV_UNIDAD,SGD_EINV_FECH,SGD_EINV_FECHFIN,SGD_EINV_RADICADOS,SGD_EINV_FOLIOS,
	SGD_EINV_NUNDOCU,SGD_EINV_NUNDOCUBODEGA,SGD_EINV_CAJA,SGD_EINV_CAJABODEGA,SGD_EINV_SRD,SGD_EINV_NOMSRD,
	SGD_EINV_SBRD,SGD_EINV_NOMSBRD,SGD_EINV_RETENCION,SGD_EINV_DISFINAL,SGD_EINV_UBICACION,SGD_EINV_OBSERVACION)
	VALUES (^6^,^DEPENDENCIA DE PRUEBA^,^998^,^2009998010100001E^,^ ^,^1^,^2009-07-02^,^2009-07-03^,
	^20099980000012^,^5^,^0^,0,^116^,0,^1^,^TEMP^,
	^1^,^TEMP^,^1^,^CONSERVACION TOTAL^,^CDSF-Z2-EST1-ENTR1-CJ3^,^ ^)', 1246637117, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_CAJA_BODEGA=^<ESPACIO>^, SGD_EXP_CARPETA_BODEGA=^0^,
				SGD_EXP_ASUNTO=^<ESPACIO>^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND RADI_NUME_RADI LIKE ^20099980000012^', 1246637566, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_CAJA_BODEGA=^<ESPACIO>^, SGD_EXP_CARPETA_BODEGA=^0^,
				SGD_EXP_ASUNTO=^<ESPACIO>^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND RADI_NUME_RADI = ^20099980000012^', 1246637667, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'd', 'SGD_EIT_ITEMS', 'DELETE FROM SGD_EIT_ITEMS', 1246637674, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_CAJA_BODEGA=^<ESPACIO>^, SGD_EXP_CARPETA_BODEGA=^0^,
				SGD_EXP_ASUNTO=^<ESPACIO>^ WHERE SGD_EXP_NUMERO LIKE ^2009998010100001E^ AND RADI_NUME_RADI = ^20099980000012^', 1246637883, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'USUARIO', 'UPDATE USUARIO SET USUA_SESION= ^090703035354O127001ADMON^ ,USUA_FECH_SESION=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^)    WHERE  USUA_LOGIN = ^ADMON^ ', 1246650834, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS( SGD_EIT_CODIGO, SGD_EIT_COD_PADRE, SGD_EIT_NOMBRE, SGD_EIT_SIGLA, CODI_DPTO, CODI_MUNI ) VALUES( ^118^, 0, UPPER( ^TEMP^ ), UPPER( ^TM^ ), 11, 1 )', 1246651157, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS( SGD_EIT_CODIGO,SGD_EIT_COD_PADRE, SGD_EIT_NOMBRE, SGD_EIT_SIGLA ) VALUES( 119, 118, UPPER( ^ZONA 1^ ), UPPER( ^Z1^ ) )', 1246651157, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS( SGD_EIT_CODIGO,SGD_EIT_COD_PADRE, SGD_EIT_NOMBRE, SGD_EIT_SIGLA ) VALUES( 120, 118, UPPER( ^ZONA 2^ ), UPPER( ^Z2^ ) )', 1246651157, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS( SGD_EIT_CODIGO,SGD_EIT_COD_PADRE, SGD_EIT_NOMBRE, SGD_EIT_SIGLA ) VALUES( 121, 118, UPPER( ^HYNB^ ), UPPER( ^TH^ ) )', 1246651157, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^122^,^119^,^CARRO 1^,^CR1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^123^,^122^,^ESTANTE 1^,^EST1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^124^,^123^,^ENTREPANO 1^,^ENT1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^125^,^124^,^CAJA 1^,^CJ1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^126^,^124^,^CAJA 2^,^CJ2^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^127^,^124^,^CAJA 3^,^CJ3^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^128^,^124^,^CAJA 4^,^CJ4^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^129^,^123^,^ENTREPANO 2^,^ENT2^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^130^,^129^,^CAJA 1^,^CJ1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^131^,^129^,^CAJA 2^,^CJ2^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^132^,^129^,^CAJA 3^,^CJ3^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^133^,^129^,^CAJA 4^,^CJ4^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^134^,^123^,^ENTREPANO 3^,^ENT3^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^135^,^134^,^CAJA 1^,^CJ1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^136^,^134^,^CAJA 2^,^CJ2^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^137^,^134^,^CAJA 3^,^CJ3^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^138^,^134^,^CAJA 4^,^CJ4^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^139^,^123^,^ENTREPANO 4^,^ENT4^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^140^,^139^,^CAJA 1^,^CJ1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^141^,^139^,^CAJA 2^,^CJ2^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^142^,^139^,^CAJA 3^,^CJ3^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^143^,^139^,^CAJA 4^,^CJ4^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^144^,^122^,^ESTANTE 2^,^EST2^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^145^,^144^,^ENTREPANO 1^,^ENT1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^146^,^145^,^CAJA 1^,^CJ1^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^147^,^145^,^CAJA 2^,^CJ2^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^148^,^145^,^CAJA 3^,^CJ3^)', 1246651204, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^149^,^145^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^150^,^144^,^ENTREPANO 2^,^ENT2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^151^,^150^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^152^,^150^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^153^,^150^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^154^,^150^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^155^,^144^,^ENTREPANO 3^,^ENT3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^156^,^155^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^157^,^155^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^158^,^155^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^159^,^155^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^160^,^144^,^ENTREPANO 4^,^ENT4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^161^,^160^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^162^,^160^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^163^,^160^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^164^,^160^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^165^,^122^,^ESTANTE 3^,^EST3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^166^,^165^,^ENTREPANO 1^,^ENT1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^167^,^166^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^168^,^166^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^169^,^166^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^170^,^166^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^171^,^165^,^ENTREPANO 2^,^ENT2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^172^,^171^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^173^,^171^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^174^,^171^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^175^,^171^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^176^,^165^,^ENTREPANO 3^,^ENT3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^177^,^176^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^178^,^176^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^179^,^176^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^180^,^176^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^181^,^165^,^ENTREPANO 4^,^ENT4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^182^,^181^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^183^,^181^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^184^,^181^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^185^,^181^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^186^,^122^,^ESTANTE 4^,^EST4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^187^,^186^,^ENTREPANO 1^,^ENT1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^188^,^187^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^189^,^187^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^190^,^187^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^191^,^187^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^192^,^186^,^ENTREPANO 2^,^ENT2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^193^,^192^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^194^,^192^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^195^,^192^,^CAJA 3^,^CJ3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^196^,^192^,^CAJA 4^,^CJ4^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^197^,^186^,^ENTREPANO 3^,^ENT3^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^198^,^197^,^CAJA 1^,^CJ1^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^199^,^197^,^CAJA 2^,^CJ2^)', 1246651205, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^200^,^197^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^201^,^197^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^202^,^186^,^ENTREPANO 4^,^ENT4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^203^,^202^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^204^,^202^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^205^,^202^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^206^,^202^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^207^,^119^,^CARRO 2^,^CR2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^208^,^207^,^ESTANTE 1^,^EST1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^209^,^208^,^ENTREPANO 1^,^ENT1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^210^,^209^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^211^,^209^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^212^,^209^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^213^,^209^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^214^,^208^,^ENTREPANO 2^,^ENT2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^215^,^214^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^216^,^214^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^217^,^214^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^218^,^214^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^219^,^208^,^ENTREPANO 3^,^ENT3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^220^,^219^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^221^,^219^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^222^,^219^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^223^,^219^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^224^,^208^,^ENTREPANO 4^,^ENT4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^225^,^224^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^226^,^224^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^227^,^224^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^228^,^224^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^229^,^207^,^ESTANTE 2^,^EST2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^230^,^229^,^ENTREPANO 1^,^ENT1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^231^,^230^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^232^,^230^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^233^,^230^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^234^,^230^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^235^,^229^,^ENTREPANO 2^,^ENT2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^236^,^235^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^237^,^235^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^238^,^235^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^239^,^235^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^240^,^229^,^ENTREPANO 3^,^ENT3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^241^,^240^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^242^,^240^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^243^,^240^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^244^,^240^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^245^,^229^,^ENTREPANO 4^,^ENT4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^246^,^245^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^247^,^245^,^CAJA 2^,^CJ2^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^248^,^245^,^CAJA 3^,^CJ3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^249^,^245^,^CAJA 4^,^CJ4^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^250^,^207^,^ESTANTE 3^,^EST3^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^251^,^250^,^ENTREPANO 1^,^ENT1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^252^,^251^,^CAJA 1^,^CJ1^)', 1246651206, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^253^,^251^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^254^,^251^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^255^,^251^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^256^,^250^,^ENTREPANO 2^,^ENT2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^257^,^256^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^258^,^256^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^259^,^256^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^260^,^256^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^261^,^250^,^ENTREPANO 3^,^ENT3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^262^,^261^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^263^,^261^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^264^,^261^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^265^,^261^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^266^,^250^,^ENTREPANO 4^,^ENT4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^267^,^266^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^268^,^266^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^269^,^266^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^270^,^266^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^271^,^207^,^ESTANTE 4^,^EST4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^272^,^271^,^ENTREPANO 1^,^ENT1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^273^,^272^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^274^,^272^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^275^,^272^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^276^,^272^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^277^,^271^,^ENTREPANO 2^,^ENT2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^278^,^277^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^279^,^277^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^280^,^277^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^281^,^277^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^282^,^271^,^ENTREPANO 3^,^ENT3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^283^,^282^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^284^,^282^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^285^,^282^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^286^,^282^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^287^,^271^,^ENTREPANO 4^,^ENT4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^288^,^287^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^289^,^287^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^290^,^287^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^291^,^287^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^292^,^119^,^CARRO 3^,^CR3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^293^,^292^,^ESTANTE 1^,^EST1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^294^,^293^,^ENTREPANO 1^,^ENT1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^295^,^294^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^296^,^294^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^297^,^294^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^298^,^294^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^299^,^293^,^ENTREPANO 2^,^ENT2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^300^,^299^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^301^,^299^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^302^,^299^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^303^,^299^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^304^,^293^,^ENTREPANO 3^,^ENT3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^305^,^304^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^306^,^304^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^307^,^304^,^CAJA 3^,^CJ3^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^308^,^304^,^CAJA 4^,^CJ4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^309^,^293^,^ENTREPANO 4^,^ENT4^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^310^,^309^,^CAJA 1^,^CJ1^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^311^,^309^,^CAJA 2^,^CJ2^)', 1246651207, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^312^,^309^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^313^,^309^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^314^,^292^,^ESTANTE 2^,^EST2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^315^,^314^,^ENTREPANO 1^,^ENT1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^316^,^315^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^317^,^315^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^318^,^315^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^319^,^315^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^320^,^314^,^ENTREPANO 2^,^ENT2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^321^,^320^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^322^,^320^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^323^,^320^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^324^,^320^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^325^,^314^,^ENTREPANO 3^,^ENT3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^326^,^325^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^327^,^325^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^328^,^325^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^329^,^325^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^330^,^314^,^ENTREPANO 4^,^ENT4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^331^,^330^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^332^,^330^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^333^,^330^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^334^,^330^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^335^,^292^,^ESTANTE 3^,^EST3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^336^,^335^,^ENTREPANO 1^,^ENT1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^337^,^336^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^338^,^336^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^339^,^336^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^340^,^336^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^341^,^335^,^ENTREPANO 2^,^ENT2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^342^,^341^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^343^,^341^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^344^,^341^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^345^,^341^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^346^,^335^,^ENTREPANO 3^,^ENT3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^347^,^346^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^348^,^346^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^349^,^346^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^350^,^346^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^351^,^335^,^ENTREPANO 4^,^ENT4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^352^,^351^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^353^,^351^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^354^,^351^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^355^,^351^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^356^,^292^,^ESTANTE 4^,^EST4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^357^,^356^,^ENTREPANO 1^,^ENT1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^358^,^357^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^359^,^357^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^360^,^357^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^361^,^357^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^362^,^356^,^ENTREPANO 2^,^ENT2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^363^,^362^,^CAJA 1^,^CJ1^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^364^,^362^,^CAJA 2^,^CJ2^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^365^,^362^,^CAJA 3^,^CJ3^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^366^,^362^,^CAJA 4^,^CJ4^)', 1246651208, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^367^,^356^,^ENTREPANO 3^,^ENT3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^368^,^367^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^369^,^367^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^370^,^367^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^371^,^367^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^372^,^356^,^ENTREPANO 4^,^ENT4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^373^,^372^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^374^,^372^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^375^,^372^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^376^,^372^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^377^,^119^,^CARRO 4^,^CR4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^378^,^377^,^ESTANTE 1^,^EST1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^379^,^378^,^ENTREPANO 1^,^ENT1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^380^,^379^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^381^,^379^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^382^,^379^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^383^,^379^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^384^,^378^,^ENTREPANO 2^,^ENT2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^385^,^384^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^386^,^384^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^387^,^384^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^388^,^384^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^389^,^378^,^ENTREPANO 3^,^ENT3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^390^,^389^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^391^,^389^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^392^,^389^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^393^,^389^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^394^,^378^,^ENTREPANO 4^,^ENT4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^395^,^394^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^396^,^394^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^397^,^394^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^398^,^394^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^399^,^377^,^ESTANTE 2^,^EST2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^400^,^399^,^ENTREPANO 1^,^ENT1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^401^,^400^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^402^,^400^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^403^,^400^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^404^,^400^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^405^,^399^,^ENTREPANO 2^,^ENT2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^406^,^405^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^407^,^405^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^408^,^405^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^409^,^405^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^410^,^399^,^ENTREPANO 3^,^ENT3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^411^,^410^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^412^,^410^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^413^,^410^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^414^,^410^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^415^,^399^,^ENTREPANO 4^,^ENT4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^416^,^415^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^417^,^415^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^418^,^415^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^419^,^415^,^CAJA 4^,^CJ4^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^420^,^377^,^ESTANTE 3^,^EST3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^421^,^420^,^ENTREPANO 1^,^ENT1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^422^,^421^,^CAJA 1^,^CJ1^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^423^,^421^,^CAJA 2^,^CJ2^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^424^,^421^,^CAJA 3^,^CJ3^)', 1246651209, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^425^,^421^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^426^,^420^,^ENTREPANO 2^,^ENT2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^427^,^426^,^CAJA 1^,^CJ1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^428^,^426^,^CAJA 2^,^CJ2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^429^,^426^,^CAJA 3^,^CJ3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^430^,^426^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^431^,^420^,^ENTREPANO 3^,^ENT3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^432^,^431^,^CAJA 1^,^CJ1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^433^,^431^,^CAJA 2^,^CJ2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^434^,^431^,^CAJA 3^,^CJ3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^435^,^431^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^436^,^420^,^ENTREPANO 4^,^ENT4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^437^,^436^,^CAJA 1^,^CJ1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^438^,^436^,^CAJA 2^,^CJ2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^439^,^436^,^CAJA 3^,^CJ3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^440^,^436^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^441^,^377^,^ESTANTE 4^,^EST4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^442^,^441^,^ENTREPANO 1^,^ENT1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^443^,^442^,^CAJA 1^,^CJ1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^444^,^442^,^CAJA 2^,^CJ2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^445^,^442^,^CAJA 3^,^CJ3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^446^,^442^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^447^,^441^,^ENTREPANO 2^,^ENT2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^448^,^447^,^CAJA 1^,^CJ1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^449^,^447^,^CAJA 2^,^CJ2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^450^,^447^,^CAJA 3^,^CJ3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^451^,^447^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^452^,^441^,^ENTREPANO 3^,^ENT3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^453^,^452^,^CAJA 1^,^CJ1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^454^,^452^,^CAJA 2^,^CJ2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^455^,^452^,^CAJA 3^,^CJ3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^456^,^452^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^457^,^441^,^ENTREPANO 4^,^ENT4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^458^,^457^,^CAJA 1^,^CJ1^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^459^,^457^,^CAJA 2^,^CJ2^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^460^,^457^,^CAJA 3^,^CJ3^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^461^,^457^,^CAJA 4^,^CJ4^)', 1246651210, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^462^,^120^,^CARRO 1^,^CR1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^463^,^462^,^ESTANTE 1^,^EST1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^464^,^463^,^ENTREPANO 1^,^ENT1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^465^,^464^,^CAJA 1^,^CJ1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^466^,^464^,^CAJA 2^,^CJ2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^467^,^464^,^CAJA 3^,^CJ3^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^468^,^464^,^CAJA 4^,^CJ4^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^469^,^463^,^ENTREPANO 2^,^ENT2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^470^,^469^,^CAJA 1^,^CJ1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^471^,^469^,^CAJA 2^,^CJ2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^472^,^469^,^CAJA 3^,^CJ3^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^473^,^469^,^CAJA 4^,^CJ4^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^474^,^463^,^ENTREPANO 3^,^ENT3^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^475^,^474^,^CAJA 1^,^CJ1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^476^,^474^,^CAJA 2^,^CJ2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^477^,^474^,^CAJA 3^,^CJ3^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^478^,^474^,^CAJA 4^,^CJ4^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^479^,^463^,^ENTREPANO 4^,^ENT4^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^480^,^479^,^CAJA 1^,^CJ1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^481^,^479^,^CAJA 2^,^CJ2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^482^,^479^,^CAJA 3^,^CJ3^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^483^,^479^,^CAJA 4^,^CJ4^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^484^,^462^,^ESTANTE 2^,^EST2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^485^,^484^,^ENTREPANO 1^,^ENT1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^486^,^485^,^CAJA 1^,^CJ1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^487^,^485^,^CAJA 2^,^CJ2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^488^,^485^,^CAJA 3^,^CJ3^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^489^,^485^,^CAJA 4^,^CJ4^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^490^,^484^,^ENTREPANO 2^,^ENT2^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^491^,^490^,^CAJA 1^,^CJ1^)', 1246651214, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^492^,^490^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^493^,^490^,^CAJA 3^,^CJ3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^494^,^490^,^CAJA 4^,^CJ4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^495^,^484^,^ENTREPANO 3^,^ENT3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^496^,^495^,^CAJA 1^,^CJ1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^497^,^495^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^498^,^495^,^CAJA 3^,^CJ3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^499^,^495^,^CAJA 4^,^CJ4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^500^,^484^,^ENTREPANO 4^,^ENT4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^501^,^500^,^CAJA 1^,^CJ1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^502^,^500^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^503^,^500^,^CAJA 3^,^CJ3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^504^,^500^,^CAJA 4^,^CJ4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^505^,^462^,^ESTANTE 3^,^EST3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^506^,^505^,^ENTREPANO 1^,^ENT1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^507^,^506^,^CAJA 1^,^CJ1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^508^,^506^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^509^,^506^,^CAJA 3^,^CJ3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^510^,^506^,^CAJA 4^,^CJ4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^511^,^505^,^ENTREPANO 2^,^ENT2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^512^,^511^,^CAJA 1^,^CJ1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^513^,^511^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^514^,^511^,^CAJA 3^,^CJ3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^515^,^511^,^CAJA 4^,^CJ4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^516^,^505^,^ENTREPANO 3^,^ENT3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^517^,^516^,^CAJA 1^,^CJ1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^518^,^516^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^519^,^516^,^CAJA 3^,^CJ3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^520^,^516^,^CAJA 4^,^CJ4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^521^,^505^,^ENTREPANO 4^,^ENT4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^522^,^521^,^CAJA 1^,^CJ1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^523^,^521^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^524^,^521^,^CAJA 3^,^CJ3^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^525^,^521^,^CAJA 4^,^CJ4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^526^,^462^,^ESTANTE 4^,^EST4^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^527^,^526^,^ENTREPANO 1^,^ENT1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^528^,^527^,^CAJA 1^,^CJ1^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^529^,^527^,^CAJA 2^,^CJ2^)', 1246651215, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^530^,^527^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^531^,^527^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^532^,^526^,^ENTREPANO 2^,^ENT2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^533^,^532^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^534^,^532^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^535^,^532^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^536^,^532^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^537^,^526^,^ENTREPANO 3^,^ENT3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^538^,^537^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^539^,^537^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^540^,^537^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^541^,^537^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^542^,^526^,^ENTREPANO 4^,^ENT4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^543^,^542^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^544^,^542^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^545^,^542^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^546^,^542^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^547^,^120^,^CARRO 2^,^CR2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^548^,^547^,^ESTANTE 1^,^EST1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^549^,^548^,^ENTREPANO 1^,^ENT1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^550^,^549^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^551^,^549^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^552^,^549^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^553^,^549^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^554^,^548^,^ENTREPANO 2^,^ENT2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^555^,^554^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^556^,^554^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^557^,^554^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^558^,^554^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^559^,^548^,^ENTREPANO 3^,^ENT3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^560^,^559^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^561^,^559^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^562^,^559^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^563^,^559^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^564^,^548^,^ENTREPANO 4^,^ENT4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^565^,^564^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^566^,^564^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^567^,^564^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^568^,^564^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^569^,^547^,^ESTANTE 2^,^EST2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^570^,^569^,^ENTREPANO 1^,^ENT1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^571^,^570^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^572^,^570^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^573^,^570^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^574^,^570^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^575^,^569^,^ENTREPANO 2^,^ENT2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^576^,^575^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^577^,^575^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^578^,^575^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^579^,^575^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^580^,^569^,^ENTREPANO 3^,^ENT3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^581^,^580^,^CAJA 1^,^CJ1^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^582^,^580^,^CAJA 2^,^CJ2^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^583^,^580^,^CAJA 3^,^CJ3^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^584^,^580^,^CAJA 4^,^CJ4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^585^,^569^,^ENTREPANO 4^,^ENT4^)', 1246651216, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^586^,^585^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^587^,^585^,^CAJA 2^,^CJ2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^588^,^585^,^CAJA 3^,^CJ3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^589^,^585^,^CAJA 4^,^CJ4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^590^,^547^,^ESTANTE 3^,^EST3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^591^,^590^,^ENTREPANO 1^,^ENT1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^592^,^591^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^593^,^591^,^CAJA 2^,^CJ2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^594^,^591^,^CAJA 3^,^CJ3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^595^,^591^,^CAJA 4^,^CJ4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^596^,^590^,^ENTREPANO 2^,^ENT2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^597^,^596^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^598^,^596^,^CAJA 2^,^CJ2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^599^,^596^,^CAJA 3^,^CJ3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^600^,^596^,^CAJA 4^,^CJ4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^601^,^590^,^ENTREPANO 3^,^ENT3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^602^,^601^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^603^,^601^,^CAJA 2^,^CJ2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^604^,^601^,^CAJA 3^,^CJ3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^605^,^601^,^CAJA 4^,^CJ4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^606^,^590^,^ENTREPANO 4^,^ENT4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^607^,^606^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^608^,^606^,^CAJA 2^,^CJ2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^609^,^606^,^CAJA 3^,^CJ3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^610^,^606^,^CAJA 4^,^CJ4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^611^,^547^,^ESTANTE 4^,^EST4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^612^,^611^,^ENTREPANO 1^,^ENT1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^613^,^612^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^614^,^612^,^CAJA 2^,^CJ2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^615^,^612^,^CAJA 3^,^CJ3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^616^,^612^,^CAJA 4^,^CJ4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^617^,^611^,^ENTREPANO 2^,^ENT2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^618^,^617^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^619^,^617^,^CAJA 2^,^CJ2^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^620^,^617^,^CAJA 3^,^CJ3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^621^,^617^,^CAJA 4^,^CJ4^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^622^,^611^,^ENTREPANO 3^,^ENT3^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^623^,^622^,^CAJA 1^,^CJ1^)', 1246651217, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^624^,^622^,^CAJA 2^,^CJ2^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^625^,^622^,^CAJA 3^,^CJ3^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^626^,^622^,^CAJA 4^,^CJ4^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^627^,^611^,^ENTREPANO 4^,^ENT4^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^628^,^627^,^CAJA 1^,^CJ1^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^629^,^627^,^CAJA 2^,^CJ2^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^630^,^627^,^CAJA 3^,^CJ3^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^631^,^627^,^CAJA 4^,^CJ4^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^632^,^120^,^CARRO 3^,^CR3^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^633^,^632^,^ESTANTE 1^,^EST1^)', 1246651218, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^634^,^633^,^ENTREPANO 1^,^ENT1^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^635^,^634^,^CAJA 1^,^CJ1^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^636^,^634^,^CAJA 2^,^CJ2^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^637^,^634^,^CAJA 3^,^CJ3^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^638^,^634^,^CAJA 4^,^CJ4^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^639^,^633^,^ENTREPANO 2^,^ENT2^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^640^,^639^,^CAJA 1^,^CJ1^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^641^,^639^,^CAJA 2^,^CJ2^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^642^,^639^,^CAJA 3^,^CJ3^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^643^,^639^,^CAJA 4^,^CJ4^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^644^,^633^,^ENTREPANO 3^,^ENT3^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^645^,^644^,^CAJA 1^,^CJ1^)', 1246651219, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^646^,^644^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^647^,^644^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^648^,^644^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^649^,^633^,^ENTREPANO 4^,^ENT4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^650^,^649^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^651^,^649^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^652^,^649^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^653^,^649^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^654^,^632^,^ESTANTE 2^,^EST2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^655^,^654^,^ENTREPANO 1^,^ENT1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^656^,^655^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^657^,^655^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^658^,^655^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^659^,^655^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^660^,^654^,^ENTREPANO 2^,^ENT2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^661^,^660^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^662^,^660^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^663^,^660^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^664^,^660^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^665^,^654^,^ENTREPANO 3^,^ENT3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^666^,^665^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^667^,^665^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^668^,^665^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^669^,^665^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^670^,^654^,^ENTREPANO 4^,^ENT4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^671^,^670^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^672^,^670^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^673^,^670^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^674^,^670^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^675^,^632^,^ESTANTE 3^,^EST3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^676^,^675^,^ENTREPANO 1^,^ENT1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^677^,^676^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^678^,^676^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^679^,^676^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^680^,^676^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^681^,^675^,^ENTREPANO 2^,^ENT2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^682^,^681^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^683^,^681^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^684^,^681^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^685^,^681^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^686^,^675^,^ENTREPANO 3^,^ENT3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^687^,^686^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^688^,^686^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^689^,^686^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^690^,^686^,^CAJA 4^,^CJ4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^691^,^675^,^ENTREPANO 4^,^ENT4^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^692^,^691^,^CAJA 1^,^CJ1^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^693^,^691^,^CAJA 2^,^CJ2^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^694^,^691^,^CAJA 3^,^CJ3^)', 1246651220, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^695^,^691^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^696^,^632^,^ESTANTE 4^,^EST4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^697^,^696^,^ENTREPANO 1^,^ENT1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^698^,^697^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^699^,^697^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^700^,^697^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^701^,^697^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^702^,^696^,^ENTREPANO 2^,^ENT2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^703^,^702^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^704^,^702^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^705^,^702^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^706^,^702^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^707^,^696^,^ENTREPANO 3^,^ENT3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^708^,^707^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^709^,^707^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^710^,^707^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^711^,^707^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^712^,^696^,^ENTREPANO 4^,^ENT4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^713^,^712^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^714^,^712^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^715^,^712^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^716^,^712^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^717^,^120^,^CARRO 4^,^CR4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^718^,^717^,^ESTANTE 1^,^EST1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^719^,^718^,^ENTREPANO 1^,^ENT1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^720^,^719^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^721^,^719^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^722^,^719^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^723^,^719^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^724^,^718^,^ENTREPANO 2^,^ENT2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^725^,^724^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^726^,^724^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^727^,^724^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^728^,^724^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^729^,^718^,^ENTREPANO 3^,^ENT3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^730^,^729^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^731^,^729^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^732^,^729^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^733^,^729^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^734^,^718^,^ENTREPANO 4^,^ENT4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^735^,^734^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^736^,^734^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^737^,^734^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^738^,^734^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^739^,^717^,^ESTANTE 2^,^EST2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^740^,^739^,^ENTREPANO 1^,^ENT1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^741^,^740^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^742^,^740^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^743^,^740^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^744^,^740^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^745^,^739^,^ENTREPANO 2^,^ENT2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^746^,^745^,^CAJA 1^,^CJ1^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^747^,^745^,^CAJA 2^,^CJ2^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^748^,^745^,^CAJA 3^,^CJ3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^749^,^745^,^CAJA 4^,^CJ4^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^750^,^739^,^ENTREPANO 3^,^ENT3^)', 1246651221, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^751^,^750^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^752^,^750^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^753^,^750^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^754^,^750^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^755^,^739^,^ENTREPANO 4^,^ENT4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^756^,^755^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^757^,^755^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^758^,^755^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^759^,^755^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^760^,^717^,^ESTANTE 3^,^EST3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^761^,^760^,^ENTREPANO 1^,^ENT1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^762^,^761^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^763^,^761^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^764^,^761^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^765^,^761^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^766^,^760^,^ENTREPANO 2^,^ENT2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^767^,^766^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^768^,^766^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^769^,^766^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^770^,^766^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^771^,^760^,^ENTREPANO 3^,^ENT3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^772^,^771^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^773^,^771^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^774^,^771^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^775^,^771^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^776^,^760^,^ENTREPANO 4^,^ENT4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^777^,^776^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^778^,^776^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^779^,^776^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^780^,^776^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES (^781^,^717^,^ESTANTE 4^,^EST4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^782^,^781^,^ENTREPANO 1^,^ENT1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^783^,^782^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^784^,^782^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^785^,^782^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^786^,^782^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^787^,^781^,^ENTREPANO 2^,^ENT2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^788^,^787^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^789^,^787^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^790^,^787^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^791^,^787^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^792^,^781^,^ENTREPANO 3^,^ENT3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^793^,^792^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^794^,^792^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^795^,^792^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^796^,^792^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^797^,^781^,^ENTREPANO 4^,^ENT4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^798^,^797^,^CAJA 1^,^CJ1^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^799^,^797^,^CAJA 2^,^CJ2^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^800^,^797^,^CAJA 3^,^CJ3^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_EIT_ITEMS', 'INSERT INTO SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA) VALUES ( ^801^,^797^,^CAJA 4^,^CJ4^)', 1246651222, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'd', 'SGD_ARCH_DEPE', 'DELETE FROM SGD_ARCH_DEPE WHERE SGD_ARCH_ID = ^1^', 1246652178, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'SGD_ARCH_DEPE', 'INSERT INTO SGD_ARCH_DEPE (SGD_ARCH_ID,SGD_ARCH_DEPE,SGD_ARCH_EDIFICIO,SGD_ARCH_ITEM) VALUES (1,^998^,118,0)', 1246652186, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^321^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-03^,SGD_EXP_FOLIOS=^0^,SGD_EXP_EDIFICIO=^118^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^320^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^0^,SGD_EXP_NREF=^456^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246652247, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^5^, MEDIO_M=^5^ WHERE RADI_NUME_RADI = ^20099980000012^', 1246652247, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000012,998,1,1,998,9876543210,9876543210,62,^ MODIFICADO DE LA UBICACION DE ALMACENAMIENTO EN FISICO^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246652247, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^321^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-03^,SGD_EXP_FOLIOS=^5^,SGD_EXP_EDIFICIO=^118^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^320^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^5^,SGD_EXP_NREF=^456^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246652584, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^5^, MEDIO_M=^5^ WHERE RADI_NUME_RADI = ^20099980000012^', 1246652584, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000012,998,1,1,998,9876543210,9876543210,62,^ MODIFICADO DE LA UBICACION DE ALMACENAMIENTO EN FISICO^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246652584, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^321^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-03^,SGD_EXP_FOLIOS=^5^,SGD_EXP_EDIFICIO=^118^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^320^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^5^,SGD_EXP_NREF=^456^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246652593, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^5^, MEDIO_M=^5^ WHERE RADI_NUME_RADI = ^20099980000012^', 1246652594, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000012,998,1,1,998,9876543210,9876543210,62,^ MODIFICADO DE LA UBICACION DE ALMACENAMIENTO EN FISICO^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246652594, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^321^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^),SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-03^,SGD_EXP_FOLIOS=^5^,SGD_EXP_EDIFICIO=^118^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^320^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^5^,SGD_EXP_NREF=^456^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246652613, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^5^, MEDIO_M=^5^ WHERE RADI_NUME_RADI = ^20099980000012^', 1246652613, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'i', 'HIST_EVENTOS', 'INSERT INTO HIST_EVENTOS(RADI_NUME_RADI,DEPE_CODI,USUA_CODI,USUA_CODI_DEST,DEPE_CODI_DEST,USUA_DOC,HIST_DOC_DEST,SGD_TTR_CODIGO,HIST_OBSE,HIST_FECH) VALUES (20099980000012,998,1,1,998,9876543210,9876543210,62,^ MODIFICADO DE LA UBICACION DE ALMACENAMIENTO EN FISICO^,(CURRENT_TIMESTAMP+INTERVAL^0 DAYS^))', 1246652614, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'SGD_EXP_EXPEDIENTE', 'UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_TITULO=^^,SGD_EXP_CAJA=^321^,SGD_EXP_CARPETA=^1^,SGD_EXP_ESTADO=1,SGD_EXP_FECH_ARCH=^2009-07-03^,SGD_EXP_ARCHIVO=^1^,SGD_EXP_UNICON=^1^,SGD_EXP_FECH=^2009-07-03^,SGD_EXP_FOLIOS=^5^,SGD_EXP_EDIFICIO=^118^,SGD_EXP_SUBEXPEDIENTE=^0^,SGD_EXP_RETE=^0^,SGD_EXP_ENTREPA=^320^,RADI_USUA_ARCH=^ADMON^,SGD_EXP_CD=^5^,SGD_EXP_NREF=^456^    WHERE  RADI_NUME_RADI = 20099980000012  AND  SGD_EXP_NUMERO = ^2009998010100001E^ ', 1246652712, '127.0.0.1');
INSERT INTO sgd_auditoria (usua_doc, tipo, tabla, isql, fecha, ip) VALUES ('9876543210', 'u', 'RADICADO', 'UPDATE RADICADO SET RADI_NUME_HOJA=^5^, MEDIO_M=^5^ WHERE RADI_NUME_RADI = ^20099980000012^', 1246652712, '127.0.0.1');


--
-- TOC entry 2718 (class 0 OID 17247)
-- Dependencies: 1795
-- Data for Name: sgd_camexp_campoexpediente; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2706 (class 0 OID 17032)
-- Dependencies: 1783
-- Data for Name: sgd_carp_descripcion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2641 (class 0 OID 16484)
-- Dependencies: 1718
-- Data for Name: sgd_cau_causal; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2731 (class 0 OID 17507)
-- Dependencies: 1808
-- Data for Name: sgd_caux_causales; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2708 (class 0 OID 17074)
-- Dependencies: 1785
-- Data for Name: sgd_ciu_ciudadano; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2693 (class 0 OID 16862)
-- Dependencies: 1770
-- Data for Name: sgd_clta_clstarif; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2678 (class 0 OID 16768)
-- Dependencies: 1755
-- Data for Name: sgd_cob_campobliga; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (2, 'NOMBRE', 'NOMBRE', 1);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (3, 'MUNI_NOMBRE', 'MUNI_NOMBRE', 1);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (4, 'DEPTO_NOMBRE', 'DEPTO_NOMBRE', 1);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (5, 'F_RAD_S', 'F_RAD_S', 1);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (6, 'TIPO', 'TIPO', 2);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (7, 'NOMBRE', 'NOMBRE', 2);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (8, 'MUNI_NOMBRE', 'MUNI_NOMBRE', 2);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (9, 'DEPTO_NOMBRE', 'DEPTO_NOMBRE', 2);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (10, 'DIR', 'DIR', 2);
INSERT INTO sgd_cob_campobliga (sgd_cob_codi, sgd_cob_desc, sgd_cob_label, sgd_tidm_codi) VALUES (1, 'PAIS_NOMBRE', 'PAIS_NOMBRE', 2);


--
-- TOC entry 2664 (class 0 OID 16652)
-- Dependencies: 1741
-- Data for Name: sgd_dcau_causal; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2665 (class 0 OID 16663)
-- Dependencies: 1742
-- Data for Name: sgd_ddca_ddsgrgdo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2666 (class 0 OID 16678)
-- Dependencies: 1743
-- Data for Name: sgd_def_contactos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2696 (class 0 OID 16873)
-- Dependencies: 1773
-- Data for Name: sgd_def_continentes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_def_continentes (id_cont, nombre_cont) VALUES (1, 'AMERICA');
INSERT INTO sgd_def_continentes (id_cont, nombre_cont) VALUES (2, 'EUROPA');
INSERT INTO sgd_def_continentes (id_cont, nombre_cont) VALUES (3, 'ASIA');
INSERT INTO sgd_def_continentes (id_cont, nombre_cont) VALUES (4, 'AFRICA');
INSERT INTO sgd_def_continentes (id_cont, nombre_cont) VALUES (5, 'OCEANIA');
INSERT INTO sgd_def_continentes (id_cont, nombre_cont) VALUES (6, 'ANTARTIDA');


--
-- TOC entry 2697 (class 0 OID 16879)
-- Dependencies: 1774
-- Data for Name: sgd_def_paises; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_def_paises (id_cont, id_pais, nombre_pais) VALUES (1, 170, 'COLOMBIA');
INSERT INTO sgd_def_paises (id_cont, id_pais, nombre_pais) VALUES (1, 218, 'ECUADOR');
INSERT INTO sgd_def_paises (id_cont, id_pais, nombre_pais) VALUES (2, 724, 'ESPAÑA');
INSERT INTO sgd_def_paises (id_cont, id_pais, nombre_pais) VALUES (2, 826, 'REINO UNIDO');
INSERT INTO sgd_def_paises (id_cont, id_pais, nombre_pais) VALUES (1, 862, 'VENEZUELA');


--
-- TOC entry 2667 (class 0 OID 16681)
-- Dependencies: 1744
-- Data for Name: sgd_deve_dev_envio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (1, 'CASA DESOCUPADA');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (2, 'CAMBIO DE DOMICILIO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (3, 'CERRADO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (5, 'DEVUELTO DE PORTERIA');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (6, 'DIRECCION DEFICIENTE');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (7, 'FALLECIDO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (8, 'NO EXISTE NUMERO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (9, 'NO RESIDE');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (10, 'NO RECLAMADO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (11, 'REHUSADO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (12, 'SE TRASLADO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (13, 'NO EXISTE EMPRESA');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (14, 'ZONA DE ALTO RIESGO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (15, 'SOBRE DESOCUPADO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (16, 'FUERA PERIMETRO URBANO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (17, 'ENVIADO A ADPOSTAL, CONTROL DE CALIDAD');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (18, 'SIN SELLO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (90, 'DOCUMENTO MAL RADICADO');
INSERT INTO sgd_deve_dev_envio (sgd_deve_codigo, sgd_deve_desc) VALUES (99, 'SOBREPASO TIEMPO DE ESPERA');


--
-- TOC entry 2738 (class 0 OID 17631)
-- Dependencies: 1815
-- Data for Name: sgd_dir_drecciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2707 (class 0 OID 17048)
-- Dependencies: 1784
-- Data for Name: sgd_dnufe_docnufe; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2694 (class 0 OID 16865)
-- Dependencies: 1771
-- Data for Name: sgd_eanu_estanulacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_eanu_estanulacion (sgd_eanu_desc, sgd_eanu_codi) VALUES ('RADICADO EN SOLICITUD DE ANULACION', 1);
INSERT INTO sgd_eanu_estanulacion (sgd_eanu_desc, sgd_eanu_codi) VALUES ('RADICADO ANULADO', 2);
INSERT INTO sgd_eanu_estanulacion (sgd_eanu_desc, sgd_eanu_codi) VALUES ('RADICADO EN SOLICITUD DE REVIVIR', 3);
INSERT INTO sgd_eanu_estanulacion (sgd_eanu_desc, sgd_eanu_codi) VALUES ('RADICADO IMPOSIBLE DE ANULAR', 9);


--
-- TOC entry 2642 (class 0 OID 16490)
-- Dependencies: 1719
-- Data for Name: sgd_einv_inventario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_einv_inventario (sgd_einv_codigo, sgd_depe_nomb, sgd_depe_codi, sgd_einv_expnum, sgd_einv_titulo, sgd_einv_unidad, sgd_einv_fech, sgd_einv_fechfin, sgd_einv_radicados, sgd_einv_folios, sgd_einv_nundocu, sgd_einv_nundocubodega, sgd_einv_caja, sgd_einv_cajabodega, sgd_einv_srd, sgd_einv_nomsrd, sgd_einv_sbrd, sgd_einv_nomsbrd, sgd_einv_retencion, sgd_einv_disfinal, sgd_einv_ubicacion, sgd_einv_observacion) VALUES (6, 'Dependencia de Prueba', 998, '2009998010100001E', ' ', 1, '2009-07-02', '2009-07-03', '20099980000012', 5, 0, 0, 116, 0, 1, 'TEMP', 1, 'TEMP', '1', 'CONSERVACION TOTAL', 'CDSF-Z2-EST1-ENTR1-CJ3', ' ');


--
-- TOC entry 2643 (class 0 OID 16499)
-- Dependencies: 1720
-- Data for Name: sgd_eit_items; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (118, 'TEMP', 'TM', 0, 11, 1);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (119, 'ZONA 1', 'Z1', 118, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (120, 'ZONA 2', 'Z2', 118, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (121, 'HYNB', 'TH', 118, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (122, 'CARRO 1', 'CR1', 119, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (123, 'ESTANTE 1', 'EST1', 122, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (124, 'ENTREPANO 1', 'ENT1', 123, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (125, 'CAJA 1', 'CJ1', 124, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (126, 'CAJA 2', 'CJ2', 124, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (127, 'CAJA 3', 'CJ3', 124, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (128, 'CAJA 4', 'CJ4', 124, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (129, 'ENTREPANO 2', 'ENT2', 123, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (130, 'CAJA 1', 'CJ1', 129, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (131, 'CAJA 2', 'CJ2', 129, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (132, 'CAJA 3', 'CJ3', 129, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (133, 'CAJA 4', 'CJ4', 129, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (134, 'ENTREPANO 3', 'ENT3', 123, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (135, 'CAJA 1', 'CJ1', 134, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (136, 'CAJA 2', 'CJ2', 134, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (137, 'CAJA 3', 'CJ3', 134, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (138, 'CAJA 4', 'CJ4', 134, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (139, 'ENTREPANO 4', 'ENT4', 123, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (140, 'CAJA 1', 'CJ1', 139, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (141, 'CAJA 2', 'CJ2', 139, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (142, 'CAJA 3', 'CJ3', 139, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (143, 'CAJA 4', 'CJ4', 139, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (144, 'ESTANTE 2', 'EST2', 122, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (145, 'ENTREPANO 1', 'ENT1', 144, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (146, 'CAJA 1', 'CJ1', 145, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (147, 'CAJA 2', 'CJ2', 145, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (148, 'CAJA 3', 'CJ3', 145, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (149, 'CAJA 4', 'CJ4', 145, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (150, 'ENTREPANO 2', 'ENT2', 144, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (151, 'CAJA 1', 'CJ1', 150, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (152, 'CAJA 2', 'CJ2', 150, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (153, 'CAJA 3', 'CJ3', 150, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (154, 'CAJA 4', 'CJ4', 150, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (155, 'ENTREPANO 3', 'ENT3', 144, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (156, 'CAJA 1', 'CJ1', 155, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (157, 'CAJA 2', 'CJ2', 155, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (158, 'CAJA 3', 'CJ3', 155, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (159, 'CAJA 4', 'CJ4', 155, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (160, 'ENTREPANO 4', 'ENT4', 144, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (161, 'CAJA 1', 'CJ1', 160, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (162, 'CAJA 2', 'CJ2', 160, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (163, 'CAJA 3', 'CJ3', 160, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (164, 'CAJA 4', 'CJ4', 160, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (165, 'ESTANTE 3', 'EST3', 122, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (166, 'ENTREPANO 1', 'ENT1', 165, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (167, 'CAJA 1', 'CJ1', 166, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (168, 'CAJA 2', 'CJ2', 166, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (169, 'CAJA 3', 'CJ3', 166, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (170, 'CAJA 4', 'CJ4', 166, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (171, 'ENTREPANO 2', 'ENT2', 165, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (172, 'CAJA 1', 'CJ1', 171, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (173, 'CAJA 2', 'CJ2', 171, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (174, 'CAJA 3', 'CJ3', 171, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (175, 'CAJA 4', 'CJ4', 171, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (176, 'ENTREPANO 3', 'ENT3', 165, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (177, 'CAJA 1', 'CJ1', 176, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (178, 'CAJA 2', 'CJ2', 176, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (179, 'CAJA 3', 'CJ3', 176, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (180, 'CAJA 4', 'CJ4', 176, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (181, 'ENTREPANO 4', 'ENT4', 165, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (182, 'CAJA 1', 'CJ1', 181, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (183, 'CAJA 2', 'CJ2', 181, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (184, 'CAJA 3', 'CJ3', 181, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (185, 'CAJA 4', 'CJ4', 181, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (186, 'ESTANTE 4', 'EST4', 122, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (187, 'ENTREPANO 1', 'ENT1', 186, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (188, 'CAJA 1', 'CJ1', 187, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (189, 'CAJA 2', 'CJ2', 187, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (190, 'CAJA 3', 'CJ3', 187, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (191, 'CAJA 4', 'CJ4', 187, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (192, 'ENTREPANO 2', 'ENT2', 186, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (193, 'CAJA 1', 'CJ1', 192, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (194, 'CAJA 2', 'CJ2', 192, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (195, 'CAJA 3', 'CJ3', 192, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (196, 'CAJA 4', 'CJ4', 192, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (197, 'ENTREPANO 3', 'ENT3', 186, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (198, 'CAJA 1', 'CJ1', 197, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (199, 'CAJA 2', 'CJ2', 197, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (200, 'CAJA 3', 'CJ3', 197, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (201, 'CAJA 4', 'CJ4', 197, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (202, 'ENTREPANO 4', 'ENT4', 186, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (203, 'CAJA 1', 'CJ1', 202, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (204, 'CAJA 2', 'CJ2', 202, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (205, 'CAJA 3', 'CJ3', 202, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (206, 'CAJA 4', 'CJ4', 202, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (207, 'CARRO 2', 'CR2', 119, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (208, 'ESTANTE 1', 'EST1', 207, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (209, 'ENTREPANO 1', 'ENT1', 208, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (210, 'CAJA 1', 'CJ1', 209, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (211, 'CAJA 2', 'CJ2', 209, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (212, 'CAJA 3', 'CJ3', 209, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (213, 'CAJA 4', 'CJ4', 209, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (214, 'ENTREPANO 2', 'ENT2', 208, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (215, 'CAJA 1', 'CJ1', 214, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (216, 'CAJA 2', 'CJ2', 214, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (217, 'CAJA 3', 'CJ3', 214, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (218, 'CAJA 4', 'CJ4', 214, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (219, 'ENTREPANO 3', 'ENT3', 208, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (220, 'CAJA 1', 'CJ1', 219, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (221, 'CAJA 2', 'CJ2', 219, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (222, 'CAJA 3', 'CJ3', 219, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (223, 'CAJA 4', 'CJ4', 219, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (224, 'ENTREPANO 4', 'ENT4', 208, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (225, 'CAJA 1', 'CJ1', 224, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (226, 'CAJA 2', 'CJ2', 224, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (227, 'CAJA 3', 'CJ3', 224, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (228, 'CAJA 4', 'CJ4', 224, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (229, 'ESTANTE 2', 'EST2', 207, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (230, 'ENTREPANO 1', 'ENT1', 229, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (231, 'CAJA 1', 'CJ1', 230, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (232, 'CAJA 2', 'CJ2', 230, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (233, 'CAJA 3', 'CJ3', 230, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (234, 'CAJA 4', 'CJ4', 230, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (235, 'ENTREPANO 2', 'ENT2', 229, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (236, 'CAJA 1', 'CJ1', 235, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (237, 'CAJA 2', 'CJ2', 235, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (238, 'CAJA 3', 'CJ3', 235, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (239, 'CAJA 4', 'CJ4', 235, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (240, 'ENTREPANO 3', 'ENT3', 229, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (241, 'CAJA 1', 'CJ1', 240, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (242, 'CAJA 2', 'CJ2', 240, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (243, 'CAJA 3', 'CJ3', 240, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (244, 'CAJA 4', 'CJ4', 240, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (245, 'ENTREPANO 4', 'ENT4', 229, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (246, 'CAJA 1', 'CJ1', 245, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (247, 'CAJA 2', 'CJ2', 245, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (248, 'CAJA 3', 'CJ3', 245, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (249, 'CAJA 4', 'CJ4', 245, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (250, 'ESTANTE 3', 'EST3', 207, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (251, 'ENTREPANO 1', 'ENT1', 250, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (252, 'CAJA 1', 'CJ1', 251, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (253, 'CAJA 2', 'CJ2', 251, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (254, 'CAJA 3', 'CJ3', 251, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (255, 'CAJA 4', 'CJ4', 251, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (256, 'ENTREPANO 2', 'ENT2', 250, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (257, 'CAJA 1', 'CJ1', 256, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (258, 'CAJA 2', 'CJ2', 256, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (259, 'CAJA 3', 'CJ3', 256, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (260, 'CAJA 4', 'CJ4', 256, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (261, 'ENTREPANO 3', 'ENT3', 250, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (262, 'CAJA 1', 'CJ1', 261, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (263, 'CAJA 2', 'CJ2', 261, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (264, 'CAJA 3', 'CJ3', 261, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (265, 'CAJA 4', 'CJ4', 261, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (266, 'ENTREPANO 4', 'ENT4', 250, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (267, 'CAJA 1', 'CJ1', 266, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (268, 'CAJA 2', 'CJ2', 266, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (269, 'CAJA 3', 'CJ3', 266, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (270, 'CAJA 4', 'CJ4', 266, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (271, 'ESTANTE 4', 'EST4', 207, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (272, 'ENTREPANO 1', 'ENT1', 271, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (273, 'CAJA 1', 'CJ1', 272, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (274, 'CAJA 2', 'CJ2', 272, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (275, 'CAJA 3', 'CJ3', 272, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (276, 'CAJA 4', 'CJ4', 272, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (277, 'ENTREPANO 2', 'ENT2', 271, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (278, 'CAJA 1', 'CJ1', 277, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (279, 'CAJA 2', 'CJ2', 277, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (280, 'CAJA 3', 'CJ3', 277, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (281, 'CAJA 4', 'CJ4', 277, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (282, 'ENTREPANO 3', 'ENT3', 271, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (283, 'CAJA 1', 'CJ1', 282, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (284, 'CAJA 2', 'CJ2', 282, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (285, 'CAJA 3', 'CJ3', 282, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (286, 'CAJA 4', 'CJ4', 282, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (287, 'ENTREPANO 4', 'ENT4', 271, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (288, 'CAJA 1', 'CJ1', 287, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (289, 'CAJA 2', 'CJ2', 287, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (290, 'CAJA 3', 'CJ3', 287, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (291, 'CAJA 4', 'CJ4', 287, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (292, 'CARRO 3', 'CR3', 119, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (293, 'ESTANTE 1', 'EST1', 292, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (294, 'ENTREPANO 1', 'ENT1', 293, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (295, 'CAJA 1', 'CJ1', 294, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (296, 'CAJA 2', 'CJ2', 294, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (297, 'CAJA 3', 'CJ3', 294, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (298, 'CAJA 4', 'CJ4', 294, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (299, 'ENTREPANO 2', 'ENT2', 293, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (300, 'CAJA 1', 'CJ1', 299, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (301, 'CAJA 2', 'CJ2', 299, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (302, 'CAJA 3', 'CJ3', 299, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (303, 'CAJA 4', 'CJ4', 299, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (304, 'ENTREPANO 3', 'ENT3', 293, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (305, 'CAJA 1', 'CJ1', 304, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (306, 'CAJA 2', 'CJ2', 304, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (307, 'CAJA 3', 'CJ3', 304, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (308, 'CAJA 4', 'CJ4', 304, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (309, 'ENTREPANO 4', 'ENT4', 293, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (310, 'CAJA 1', 'CJ1', 309, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (311, 'CAJA 2', 'CJ2', 309, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (312, 'CAJA 3', 'CJ3', 309, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (313, 'CAJA 4', 'CJ4', 309, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (314, 'ESTANTE 2', 'EST2', 292, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (315, 'ENTREPANO 1', 'ENT1', 314, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (316, 'CAJA 1', 'CJ1', 315, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (317, 'CAJA 2', 'CJ2', 315, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (318, 'CAJA 3', 'CJ3', 315, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (319, 'CAJA 4', 'CJ4', 315, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (320, 'ENTREPANO 2', 'ENT2', 314, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (321, 'CAJA 1', 'CJ1', 320, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (322, 'CAJA 2', 'CJ2', 320, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (323, 'CAJA 3', 'CJ3', 320, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (324, 'CAJA 4', 'CJ4', 320, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (325, 'ENTREPANO 3', 'ENT3', 314, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (326, 'CAJA 1', 'CJ1', 325, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (327, 'CAJA 2', 'CJ2', 325, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (328, 'CAJA 3', 'CJ3', 325, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (329, 'CAJA 4', 'CJ4', 325, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (330, 'ENTREPANO 4', 'ENT4', 314, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (331, 'CAJA 1', 'CJ1', 330, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (332, 'CAJA 2', 'CJ2', 330, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (333, 'CAJA 3', 'CJ3', 330, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (334, 'CAJA 4', 'CJ4', 330, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (335, 'ESTANTE 3', 'EST3', 292, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (336, 'ENTREPANO 1', 'ENT1', 335, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (337, 'CAJA 1', 'CJ1', 336, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (338, 'CAJA 2', 'CJ2', 336, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (339, 'CAJA 3', 'CJ3', 336, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (340, 'CAJA 4', 'CJ4', 336, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (341, 'ENTREPANO 2', 'ENT2', 335, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (342, 'CAJA 1', 'CJ1', 341, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (343, 'CAJA 2', 'CJ2', 341, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (344, 'CAJA 3', 'CJ3', 341, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (345, 'CAJA 4', 'CJ4', 341, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (346, 'ENTREPANO 3', 'ENT3', 335, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (347, 'CAJA 1', 'CJ1', 346, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (348, 'CAJA 2', 'CJ2', 346, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (349, 'CAJA 3', 'CJ3', 346, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (350, 'CAJA 4', 'CJ4', 346, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (351, 'ENTREPANO 4', 'ENT4', 335, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (352, 'CAJA 1', 'CJ1', 351, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (353, 'CAJA 2', 'CJ2', 351, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (354, 'CAJA 3', 'CJ3', 351, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (355, 'CAJA 4', 'CJ4', 351, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (356, 'ESTANTE 4', 'EST4', 292, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (357, 'ENTREPANO 1', 'ENT1', 356, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (358, 'CAJA 1', 'CJ1', 357, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (359, 'CAJA 2', 'CJ2', 357, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (360, 'CAJA 3', 'CJ3', 357, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (361, 'CAJA 4', 'CJ4', 357, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (362, 'ENTREPANO 2', 'ENT2', 356, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (363, 'CAJA 1', 'CJ1', 362, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (364, 'CAJA 2', 'CJ2', 362, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (365, 'CAJA 3', 'CJ3', 362, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (366, 'CAJA 4', 'CJ4', 362, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (367, 'ENTREPANO 3', 'ENT3', 356, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (368, 'CAJA 1', 'CJ1', 367, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (369, 'CAJA 2', 'CJ2', 367, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (370, 'CAJA 3', 'CJ3', 367, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (371, 'CAJA 4', 'CJ4', 367, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (372, 'ENTREPANO 4', 'ENT4', 356, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (373, 'CAJA 1', 'CJ1', 372, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (374, 'CAJA 2', 'CJ2', 372, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (375, 'CAJA 3', 'CJ3', 372, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (376, 'CAJA 4', 'CJ4', 372, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (377, 'CARRO 4', 'CR4', 119, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (378, 'ESTANTE 1', 'EST1', 377, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (379, 'ENTREPANO 1', 'ENT1', 378, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (380, 'CAJA 1', 'CJ1', 379, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (381, 'CAJA 2', 'CJ2', 379, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (382, 'CAJA 3', 'CJ3', 379, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (383, 'CAJA 4', 'CJ4', 379, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (384, 'ENTREPANO 2', 'ENT2', 378, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (385, 'CAJA 1', 'CJ1', 384, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (386, 'CAJA 2', 'CJ2', 384, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (387, 'CAJA 3', 'CJ3', 384, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (388, 'CAJA 4', 'CJ4', 384, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (389, 'ENTREPANO 3', 'ENT3', 378, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (390, 'CAJA 1', 'CJ1', 389, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (391, 'CAJA 2', 'CJ2', 389, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (392, 'CAJA 3', 'CJ3', 389, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (393, 'CAJA 4', 'CJ4', 389, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (394, 'ENTREPANO 4', 'ENT4', 378, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (395, 'CAJA 1', 'CJ1', 394, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (396, 'CAJA 2', 'CJ2', 394, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (397, 'CAJA 3', 'CJ3', 394, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (398, 'CAJA 4', 'CJ4', 394, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (399, 'ESTANTE 2', 'EST2', 377, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (400, 'ENTREPANO 1', 'ENT1', 399, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (401, 'CAJA 1', 'CJ1', 400, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (402, 'CAJA 2', 'CJ2', 400, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (403, 'CAJA 3', 'CJ3', 400, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (404, 'CAJA 4', 'CJ4', 400, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (405, 'ENTREPANO 2', 'ENT2', 399, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (406, 'CAJA 1', 'CJ1', 405, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (407, 'CAJA 2', 'CJ2', 405, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (408, 'CAJA 3', 'CJ3', 405, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (409, 'CAJA 4', 'CJ4', 405, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (410, 'ENTREPANO 3', 'ENT3', 399, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (411, 'CAJA 1', 'CJ1', 410, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (412, 'CAJA 2', 'CJ2', 410, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (413, 'CAJA 3', 'CJ3', 410, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (414, 'CAJA 4', 'CJ4', 410, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (415, 'ENTREPANO 4', 'ENT4', 399, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (416, 'CAJA 1', 'CJ1', 415, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (417, 'CAJA 2', 'CJ2', 415, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (418, 'CAJA 3', 'CJ3', 415, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (419, 'CAJA 4', 'CJ4', 415, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (420, 'ESTANTE 3', 'EST3', 377, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (421, 'ENTREPANO 1', 'ENT1', 420, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (422, 'CAJA 1', 'CJ1', 421, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (423, 'CAJA 2', 'CJ2', 421, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (424, 'CAJA 3', 'CJ3', 421, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (425, 'CAJA 4', 'CJ4', 421, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (426, 'ENTREPANO 2', 'ENT2', 420, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (427, 'CAJA 1', 'CJ1', 426, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (428, 'CAJA 2', 'CJ2', 426, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (429, 'CAJA 3', 'CJ3', 426, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (430, 'CAJA 4', 'CJ4', 426, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (431, 'ENTREPANO 3', 'ENT3', 420, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (432, 'CAJA 1', 'CJ1', 431, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (433, 'CAJA 2', 'CJ2', 431, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (434, 'CAJA 3', 'CJ3', 431, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (435, 'CAJA 4', 'CJ4', 431, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (436, 'ENTREPANO 4', 'ENT4', 420, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (437, 'CAJA 1', 'CJ1', 436, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (438, 'CAJA 2', 'CJ2', 436, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (439, 'CAJA 3', 'CJ3', 436, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (440, 'CAJA 4', 'CJ4', 436, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (441, 'ESTANTE 4', 'EST4', 377, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (442, 'ENTREPANO 1', 'ENT1', 441, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (443, 'CAJA 1', 'CJ1', 442, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (444, 'CAJA 2', 'CJ2', 442, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (445, 'CAJA 3', 'CJ3', 442, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (446, 'CAJA 4', 'CJ4', 442, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (447, 'ENTREPANO 2', 'ENT2', 441, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (448, 'CAJA 1', 'CJ1', 447, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (449, 'CAJA 2', 'CJ2', 447, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (450, 'CAJA 3', 'CJ3', 447, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (451, 'CAJA 4', 'CJ4', 447, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (452, 'ENTREPANO 3', 'ENT3', 441, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (453, 'CAJA 1', 'CJ1', 452, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (454, 'CAJA 2', 'CJ2', 452, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (455, 'CAJA 3', 'CJ3', 452, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (456, 'CAJA 4', 'CJ4', 452, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (457, 'ENTREPANO 4', 'ENT4', 441, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (458, 'CAJA 1', 'CJ1', 457, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (459, 'CAJA 2', 'CJ2', 457, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (460, 'CAJA 3', 'CJ3', 457, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (461, 'CAJA 4', 'CJ4', 457, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (462, 'CARRO 1', 'CR1', 120, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (463, 'ESTANTE 1', 'EST1', 462, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (464, 'ENTREPANO 1', 'ENT1', 463, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (465, 'CAJA 1', 'CJ1', 464, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (466, 'CAJA 2', 'CJ2', 464, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (467, 'CAJA 3', 'CJ3', 464, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (468, 'CAJA 4', 'CJ4', 464, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (469, 'ENTREPANO 2', 'ENT2', 463, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (470, 'CAJA 1', 'CJ1', 469, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (471, 'CAJA 2', 'CJ2', 469, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (472, 'CAJA 3', 'CJ3', 469, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (473, 'CAJA 4', 'CJ4', 469, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (474, 'ENTREPANO 3', 'ENT3', 463, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (475, 'CAJA 1', 'CJ1', 474, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (476, 'CAJA 2', 'CJ2', 474, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (477, 'CAJA 3', 'CJ3', 474, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (478, 'CAJA 4', 'CJ4', 474, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (479, 'ENTREPANO 4', 'ENT4', 463, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (480, 'CAJA 1', 'CJ1', 479, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (481, 'CAJA 2', 'CJ2', 479, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (482, 'CAJA 3', 'CJ3', 479, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (483, 'CAJA 4', 'CJ4', 479, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (484, 'ESTANTE 2', 'EST2', 462, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (485, 'ENTREPANO 1', 'ENT1', 484, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (486, 'CAJA 1', 'CJ1', 485, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (487, 'CAJA 2', 'CJ2', 485, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (488, 'CAJA 3', 'CJ3', 485, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (489, 'CAJA 4', 'CJ4', 485, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (490, 'ENTREPANO 2', 'ENT2', 484, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (491, 'CAJA 1', 'CJ1', 490, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (492, 'CAJA 2', 'CJ2', 490, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (493, 'CAJA 3', 'CJ3', 490, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (494, 'CAJA 4', 'CJ4', 490, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (495, 'ENTREPANO 3', 'ENT3', 484, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (496, 'CAJA 1', 'CJ1', 495, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (497, 'CAJA 2', 'CJ2', 495, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (498, 'CAJA 3', 'CJ3', 495, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (499, 'CAJA 4', 'CJ4', 495, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (500, 'ENTREPANO 4', 'ENT4', 484, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (501, 'CAJA 1', 'CJ1', 500, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (502, 'CAJA 2', 'CJ2', 500, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (503, 'CAJA 3', 'CJ3', 500, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (504, 'CAJA 4', 'CJ4', 500, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (505, 'ESTANTE 3', 'EST3', 462, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (506, 'ENTREPANO 1', 'ENT1', 505, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (507, 'CAJA 1', 'CJ1', 506, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (508, 'CAJA 2', 'CJ2', 506, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (509, 'CAJA 3', 'CJ3', 506, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (510, 'CAJA 4', 'CJ4', 506, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (511, 'ENTREPANO 2', 'ENT2', 505, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (512, 'CAJA 1', 'CJ1', 511, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (513, 'CAJA 2', 'CJ2', 511, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (514, 'CAJA 3', 'CJ3', 511, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (515, 'CAJA 4', 'CJ4', 511, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (516, 'ENTREPANO 3', 'ENT3', 505, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (517, 'CAJA 1', 'CJ1', 516, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (518, 'CAJA 2', 'CJ2', 516, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (519, 'CAJA 3', 'CJ3', 516, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (520, 'CAJA 4', 'CJ4', 516, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (521, 'ENTREPANO 4', 'ENT4', 505, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (522, 'CAJA 1', 'CJ1', 521, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (523, 'CAJA 2', 'CJ2', 521, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (524, 'CAJA 3', 'CJ3', 521, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (525, 'CAJA 4', 'CJ4', 521, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (526, 'ESTANTE 4', 'EST4', 462, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (527, 'ENTREPANO 1', 'ENT1', 526, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (528, 'CAJA 1', 'CJ1', 527, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (529, 'CAJA 2', 'CJ2', 527, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (530, 'CAJA 3', 'CJ3', 527, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (531, 'CAJA 4', 'CJ4', 527, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (532, 'ENTREPANO 2', 'ENT2', 526, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (533, 'CAJA 1', 'CJ1', 532, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (534, 'CAJA 2', 'CJ2', 532, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (535, 'CAJA 3', 'CJ3', 532, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (536, 'CAJA 4', 'CJ4', 532, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (537, 'ENTREPANO 3', 'ENT3', 526, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (538, 'CAJA 1', 'CJ1', 537, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (539, 'CAJA 2', 'CJ2', 537, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (540, 'CAJA 3', 'CJ3', 537, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (541, 'CAJA 4', 'CJ4', 537, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (542, 'ENTREPANO 4', 'ENT4', 526, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (543, 'CAJA 1', 'CJ1', 542, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (544, 'CAJA 2', 'CJ2', 542, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (545, 'CAJA 3', 'CJ3', 542, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (546, 'CAJA 4', 'CJ4', 542, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (547, 'CARRO 2', 'CR2', 120, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (548, 'ESTANTE 1', 'EST1', 547, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (549, 'ENTREPANO 1', 'ENT1', 548, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (550, 'CAJA 1', 'CJ1', 549, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (551, 'CAJA 2', 'CJ2', 549, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (552, 'CAJA 3', 'CJ3', 549, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (553, 'CAJA 4', 'CJ4', 549, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (554, 'ENTREPANO 2', 'ENT2', 548, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (555, 'CAJA 1', 'CJ1', 554, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (556, 'CAJA 2', 'CJ2', 554, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (557, 'CAJA 3', 'CJ3', 554, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (558, 'CAJA 4', 'CJ4', 554, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (559, 'ENTREPANO 3', 'ENT3', 548, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (560, 'CAJA 1', 'CJ1', 559, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (561, 'CAJA 2', 'CJ2', 559, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (562, 'CAJA 3', 'CJ3', 559, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (563, 'CAJA 4', 'CJ4', 559, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (564, 'ENTREPANO 4', 'ENT4', 548, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (565, 'CAJA 1', 'CJ1', 564, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (566, 'CAJA 2', 'CJ2', 564, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (567, 'CAJA 3', 'CJ3', 564, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (568, 'CAJA 4', 'CJ4', 564, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (569, 'ESTANTE 2', 'EST2', 547, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (570, 'ENTREPANO 1', 'ENT1', 569, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (571, 'CAJA 1', 'CJ1', 570, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (572, 'CAJA 2', 'CJ2', 570, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (573, 'CAJA 3', 'CJ3', 570, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (574, 'CAJA 4', 'CJ4', 570, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (575, 'ENTREPANO 2', 'ENT2', 569, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (576, 'CAJA 1', 'CJ1', 575, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (577, 'CAJA 2', 'CJ2', 575, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (578, 'CAJA 3', 'CJ3', 575, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (579, 'CAJA 4', 'CJ4', 575, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (580, 'ENTREPANO 3', 'ENT3', 569, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (581, 'CAJA 1', 'CJ1', 580, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (582, 'CAJA 2', 'CJ2', 580, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (583, 'CAJA 3', 'CJ3', 580, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (584, 'CAJA 4', 'CJ4', 580, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (585, 'ENTREPANO 4', 'ENT4', 569, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (586, 'CAJA 1', 'CJ1', 585, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (587, 'CAJA 2', 'CJ2', 585, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (588, 'CAJA 3', 'CJ3', 585, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (589, 'CAJA 4', 'CJ4', 585, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (590, 'ESTANTE 3', 'EST3', 547, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (591, 'ENTREPANO 1', 'ENT1', 590, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (592, 'CAJA 1', 'CJ1', 591, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (593, 'CAJA 2', 'CJ2', 591, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (594, 'CAJA 3', 'CJ3', 591, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (595, 'CAJA 4', 'CJ4', 591, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (596, 'ENTREPANO 2', 'ENT2', 590, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (597, 'CAJA 1', 'CJ1', 596, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (598, 'CAJA 2', 'CJ2', 596, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (599, 'CAJA 3', 'CJ3', 596, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (600, 'CAJA 4', 'CJ4', 596, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (601, 'ENTREPANO 3', 'ENT3', 590, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (602, 'CAJA 1', 'CJ1', 601, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (603, 'CAJA 2', 'CJ2', 601, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (604, 'CAJA 3', 'CJ3', 601, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (605, 'CAJA 4', 'CJ4', 601, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (606, 'ENTREPANO 4', 'ENT4', 590, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (607, 'CAJA 1', 'CJ1', 606, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (608, 'CAJA 2', 'CJ2', 606, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (609, 'CAJA 3', 'CJ3', 606, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (610, 'CAJA 4', 'CJ4', 606, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (611, 'ESTANTE 4', 'EST4', 547, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (612, 'ENTREPANO 1', 'ENT1', 611, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (613, 'CAJA 1', 'CJ1', 612, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (614, 'CAJA 2', 'CJ2', 612, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (615, 'CAJA 3', 'CJ3', 612, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (616, 'CAJA 4', 'CJ4', 612, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (617, 'ENTREPANO 2', 'ENT2', 611, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (618, 'CAJA 1', 'CJ1', 617, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (619, 'CAJA 2', 'CJ2', 617, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (620, 'CAJA 3', 'CJ3', 617, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (621, 'CAJA 4', 'CJ4', 617, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (622, 'ENTREPANO 3', 'ENT3', 611, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (623, 'CAJA 1', 'CJ1', 622, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (624, 'CAJA 2', 'CJ2', 622, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (625, 'CAJA 3', 'CJ3', 622, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (626, 'CAJA 4', 'CJ4', 622, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (627, 'ENTREPANO 4', 'ENT4', 611, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (628, 'CAJA 1', 'CJ1', 627, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (629, 'CAJA 2', 'CJ2', 627, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (630, 'CAJA 3', 'CJ3', 627, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (631, 'CAJA 4', 'CJ4', 627, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (632, 'CARRO 3', 'CR3', 120, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (633, 'ESTANTE 1', 'EST1', 632, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (634, 'ENTREPANO 1', 'ENT1', 633, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (635, 'CAJA 1', 'CJ1', 634, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (636, 'CAJA 2', 'CJ2', 634, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (637, 'CAJA 3', 'CJ3', 634, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (638, 'CAJA 4', 'CJ4', 634, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (639, 'ENTREPANO 2', 'ENT2', 633, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (640, 'CAJA 1', 'CJ1', 639, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (641, 'CAJA 2', 'CJ2', 639, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (642, 'CAJA 3', 'CJ3', 639, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (643, 'CAJA 4', 'CJ4', 639, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (644, 'ENTREPANO 3', 'ENT3', 633, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (645, 'CAJA 1', 'CJ1', 644, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (646, 'CAJA 2', 'CJ2', 644, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (647, 'CAJA 3', 'CJ3', 644, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (648, 'CAJA 4', 'CJ4', 644, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (649, 'ENTREPANO 4', 'ENT4', 633, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (650, 'CAJA 1', 'CJ1', 649, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (651, 'CAJA 2', 'CJ2', 649, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (652, 'CAJA 3', 'CJ3', 649, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (653, 'CAJA 4', 'CJ4', 649, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (654, 'ESTANTE 2', 'EST2', 632, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (655, 'ENTREPANO 1', 'ENT1', 654, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (656, 'CAJA 1', 'CJ1', 655, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (657, 'CAJA 2', 'CJ2', 655, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (658, 'CAJA 3', 'CJ3', 655, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (659, 'CAJA 4', 'CJ4', 655, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (660, 'ENTREPANO 2', 'ENT2', 654, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (661, 'CAJA 1', 'CJ1', 660, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (662, 'CAJA 2', 'CJ2', 660, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (663, 'CAJA 3', 'CJ3', 660, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (664, 'CAJA 4', 'CJ4', 660, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (665, 'ENTREPANO 3', 'ENT3', 654, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (666, 'CAJA 1', 'CJ1', 665, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (667, 'CAJA 2', 'CJ2', 665, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (668, 'CAJA 3', 'CJ3', 665, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (669, 'CAJA 4', 'CJ4', 665, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (670, 'ENTREPANO 4', 'ENT4', 654, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (671, 'CAJA 1', 'CJ1', 670, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (672, 'CAJA 2', 'CJ2', 670, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (673, 'CAJA 3', 'CJ3', 670, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (674, 'CAJA 4', 'CJ4', 670, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (675, 'ESTANTE 3', 'EST3', 632, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (676, 'ENTREPANO 1', 'ENT1', 675, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (677, 'CAJA 1', 'CJ1', 676, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (678, 'CAJA 2', 'CJ2', 676, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (679, 'CAJA 3', 'CJ3', 676, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (680, 'CAJA 4', 'CJ4', 676, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (681, 'ENTREPANO 2', 'ENT2', 675, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (682, 'CAJA 1', 'CJ1', 681, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (683, 'CAJA 2', 'CJ2', 681, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (684, 'CAJA 3', 'CJ3', 681, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (685, 'CAJA 4', 'CJ4', 681, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (686, 'ENTREPANO 3', 'ENT3', 675, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (687, 'CAJA 1', 'CJ1', 686, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (688, 'CAJA 2', 'CJ2', 686, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (689, 'CAJA 3', 'CJ3', 686, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (690, 'CAJA 4', 'CJ4', 686, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (691, 'ENTREPANO 4', 'ENT4', 675, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (692, 'CAJA 1', 'CJ1', 691, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (693, 'CAJA 2', 'CJ2', 691, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (694, 'CAJA 3', 'CJ3', 691, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (695, 'CAJA 4', 'CJ4', 691, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (696, 'ESTANTE 4', 'EST4', 632, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (697, 'ENTREPANO 1', 'ENT1', 696, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (698, 'CAJA 1', 'CJ1', 697, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (699, 'CAJA 2', 'CJ2', 697, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (700, 'CAJA 3', 'CJ3', 697, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (701, 'CAJA 4', 'CJ4', 697, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (702, 'ENTREPANO 2', 'ENT2', 696, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (703, 'CAJA 1', 'CJ1', 702, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (704, 'CAJA 2', 'CJ2', 702, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (705, 'CAJA 3', 'CJ3', 702, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (706, 'CAJA 4', 'CJ4', 702, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (707, 'ENTREPANO 3', 'ENT3', 696, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (708, 'CAJA 1', 'CJ1', 707, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (709, 'CAJA 2', 'CJ2', 707, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (710, 'CAJA 3', 'CJ3', 707, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (711, 'CAJA 4', 'CJ4', 707, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (712, 'ENTREPANO 4', 'ENT4', 696, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (713, 'CAJA 1', 'CJ1', 712, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (714, 'CAJA 2', 'CJ2', 712, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (715, 'CAJA 3', 'CJ3', 712, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (716, 'CAJA 4', 'CJ4', 712, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (717, 'CARRO 4', 'CR4', 120, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (718, 'ESTANTE 1', 'EST1', 717, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (719, 'ENTREPANO 1', 'ENT1', 718, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (720, 'CAJA 1', 'CJ1', 719, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (721, 'CAJA 2', 'CJ2', 719, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (722, 'CAJA 3', 'CJ3', 719, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (723, 'CAJA 4', 'CJ4', 719, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (724, 'ENTREPANO 2', 'ENT2', 718, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (725, 'CAJA 1', 'CJ1', 724, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (726, 'CAJA 2', 'CJ2', 724, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (727, 'CAJA 3', 'CJ3', 724, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (728, 'CAJA 4', 'CJ4', 724, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (729, 'ENTREPANO 3', 'ENT3', 718, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (730, 'CAJA 1', 'CJ1', 729, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (731, 'CAJA 2', 'CJ2', 729, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (732, 'CAJA 3', 'CJ3', 729, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (733, 'CAJA 4', 'CJ4', 729, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (734, 'ENTREPANO 4', 'ENT4', 718, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (735, 'CAJA 1', 'CJ1', 734, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (736, 'CAJA 2', 'CJ2', 734, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (737, 'CAJA 3', 'CJ3', 734, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (738, 'CAJA 4', 'CJ4', 734, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (739, 'ESTANTE 2', 'EST2', 717, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (740, 'ENTREPANO 1', 'ENT1', 739, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (741, 'CAJA 1', 'CJ1', 740, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (742, 'CAJA 2', 'CJ2', 740, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (743, 'CAJA 3', 'CJ3', 740, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (744, 'CAJA 4', 'CJ4', 740, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (745, 'ENTREPANO 2', 'ENT2', 739, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (746, 'CAJA 1', 'CJ1', 745, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (747, 'CAJA 2', 'CJ2', 745, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (748, 'CAJA 3', 'CJ3', 745, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (749, 'CAJA 4', 'CJ4', 745, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (750, 'ENTREPANO 3', 'ENT3', 739, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (751, 'CAJA 1', 'CJ1', 750, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (752, 'CAJA 2', 'CJ2', 750, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (753, 'CAJA 3', 'CJ3', 750, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (754, 'CAJA 4', 'CJ4', 750, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (755, 'ENTREPANO 4', 'ENT4', 739, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (756, 'CAJA 1', 'CJ1', 755, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (757, 'CAJA 2', 'CJ2', 755, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (758, 'CAJA 3', 'CJ3', 755, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (759, 'CAJA 4', 'CJ4', 755, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (760, 'ESTANTE 3', 'EST3', 717, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (761, 'ENTREPANO 1', 'ENT1', 760, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (762, 'CAJA 1', 'CJ1', 761, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (763, 'CAJA 2', 'CJ2', 761, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (764, 'CAJA 3', 'CJ3', 761, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (765, 'CAJA 4', 'CJ4', 761, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (766, 'ENTREPANO 2', 'ENT2', 760, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (767, 'CAJA 1', 'CJ1', 766, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (768, 'CAJA 2', 'CJ2', 766, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (769, 'CAJA 3', 'CJ3', 766, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (770, 'CAJA 4', 'CJ4', 766, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (771, 'ENTREPANO 3', 'ENT3', 760, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (772, 'CAJA 1', 'CJ1', 771, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (773, 'CAJA 2', 'CJ2', 771, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (774, 'CAJA 3', 'CJ3', 771, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (775, 'CAJA 4', 'CJ4', 771, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (776, 'ENTREPANO 4', 'ENT4', 760, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (777, 'CAJA 1', 'CJ1', 776, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (778, 'CAJA 2', 'CJ2', 776, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (779, 'CAJA 3', 'CJ3', 776, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (780, 'CAJA 4', 'CJ4', 776, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (781, 'ESTANTE 4', 'EST4', 717, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (782, 'ENTREPANO 1', 'ENT1', 781, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (783, 'CAJA 1', 'CJ1', 782, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (784, 'CAJA 2', 'CJ2', 782, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (785, 'CAJA 3', 'CJ3', 782, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (786, 'CAJA 4', 'CJ4', 782, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (787, 'ENTREPANO 2', 'ENT2', 781, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (788, 'CAJA 1', 'CJ1', 787, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (789, 'CAJA 2', 'CJ2', 787, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (790, 'CAJA 3', 'CJ3', 787, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (791, 'CAJA 4', 'CJ4', 787, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (792, 'ENTREPANO 3', 'ENT3', 781, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (793, 'CAJA 1', 'CJ1', 792, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (794, 'CAJA 2', 'CJ2', 792, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (795, 'CAJA 3', 'CJ3', 792, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (796, 'CAJA 4', 'CJ4', 792, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (797, 'ENTREPANO 4', 'ENT4', 781, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (798, 'CAJA 1', 'CJ1', 797, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (799, 'CAJA 2', 'CJ2', 797, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (800, 'CAJA 3', 'CJ3', 797, NULL, NULL);
INSERT INTO sgd_eit_items (sgd_eit_codigo, sgd_eit_nombre, sgd_eit_sigla, sgd_eit_cod_padre, codi_dpto, codi_muni) VALUES (801, 'CAJA 4', 'CJ4', 797, NULL, NULL);


--
-- TOC entry 2681 (class 0 OID 16791)
-- Dependencies: 1758
-- Data for Name: sgd_ent_entidades; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2692 (class 0 OID 16854)
-- Dependencies: 1769
-- Data for Name: sgd_enve_envioespecial; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_enve_envioespecial (sgd_fenv_codigo, sgd_enve_valorl, sgd_enve_valorn, sgd_enve_desc) VALUES (109, '1200', '1200', 'Valor descuento automatico');
INSERT INTO sgd_enve_envioespecial (sgd_fenv_codigo, sgd_enve_valorl, sgd_enve_valorn, sgd_enve_desc) VALUES (109, '160', '160', 'Valor alistamiento');
INSERT INTO sgd_enve_envioespecial (sgd_fenv_codigo, sgd_enve_valorl, sgd_enve_valorn, sgd_enve_desc) VALUES (109, '1300', '3300', 'Valor cert. acuse recibido');


--
-- TOC entry 2668 (class 0 OID 16687)
-- Dependencies: 1745
-- Data for Name: sgd_estinst_estadoinstancia; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2732 (class 0 OID 17528)
-- Dependencies: 1809
-- Data for Name: sgd_exp_expediente; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2733 (class 0 OID 17557)
-- Dependencies: 1810
-- Data for Name: sgd_fars_faristas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2682 (class 0 OID 16796)
-- Dependencies: 1759
-- Data for Name: sgd_fenv_frmenvio; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (101, 'CERTIFICADO', 1, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (102, 'SERVIENTREGA', 0, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (103, 'ENTREGA PERSONAL', 0, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (104, 'FAX', 0, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (105, 'POSTEXPRESS', 1, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (106, 'CORREO ELECTRONICO', 0, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (107, 'CORRA', 0, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (108, 'NORMAL', 1, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (109, 'CERTIFICADO CON ACUSE', 1, 1);
INSERT INTO sgd_fenv_frmenvio (sgd_fenv_codigo, sgd_fenv_descrip, sgd_fenv_planilla, sgd_fenv_estado) VALUES (901, 'NO ENVIADO', 0, 1);


--
-- TOC entry 2719 (class 0 OID 17259)
-- Dependencies: 1796
-- Data for Name: sgd_fexp_flujoexpedientes; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2734 (class 0 OID 17568)
-- Dependencies: 1811
-- Data for Name: sgd_firrad_firmarads; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2684 (class 0 OID 16810)
-- Dependencies: 1761
-- Data for Name: sgd_fld_flujodoc; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2644 (class 0 OID 16506)
-- Dependencies: 1721
-- Data for Name: sgd_fun_funciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2735 (class 0 OID 17582)
-- Dependencies: 1812
-- Data for Name: sgd_hmtd_hismatdoc; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2645 (class 0 OID 16512)
-- Dependencies: 1722
-- Data for Name: sgd_instorf_instanciasorfeo; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2646 (class 0 OID 16518)
-- Dependencies: 1723
-- Data for Name: sgd_masiva_excel; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2709 (class 0 OID 17094)
-- Dependencies: 1786
-- Data for Name: sgd_mat_matriz; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2691 (class 0 OID 16848)
-- Dependencies: 1768
-- Data for Name: sgd_mpes_mddpeso; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2710 (class 0 OID 17124)
-- Dependencies: 1787
-- Data for Name: sgd_mrd_matrird; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2712 (class 0 OID 17162)
-- Dependencies: 1789
-- Data for Name: sgd_msdep_msgdep; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2711 (class 0 OID 17151)
-- Dependencies: 1788
-- Data for Name: sgd_msg_mensaje; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2713 (class 0 OID 17178)
-- Dependencies: 1790
-- Data for Name: sgd_mtd_matriz_doc; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2647 (class 0 OID 16524)
-- Dependencies: 1724
-- Data for Name: sgd_noh_nohabiles; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-01-01');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-01-07');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-03-20');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-03-21');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-05-01');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-05-26');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-06-02');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-06-30');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-08-07');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-08-18');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-10-13');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-11-17');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-12-08');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2008-12-25');
INSERT INTO sgd_noh_nohabiles (noh_fecha) VALUES ('2009-01-01');


--
-- TOC entry 2648 (class 0 OID 16530)
-- Dependencies: 1725
-- Data for Name: sgd_not_notificacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_not_notificacion (sgd_not_codi, sgd_not_descrip) VALUES (1, 'PERSONAL');
INSERT INTO sgd_not_notificacion (sgd_not_codi, sgd_not_descrip) VALUES (2, 'TELEFONICA');


--
-- TOC entry 2736 (class 0 OID 17603)
-- Dependencies: 1813
-- Data for Name: sgd_ntrd_notifrad; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2737 (class 0 OID 17611)
-- Dependencies: 1814
-- Data for Name: sgd_oem_oempresas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_oem_oempresas (sgd_oem_codigo, tdid_codi, sgd_oem_oempresa, sgd_oem_rep_legal, sgd_oem_nit, sgd_oem_sigla, muni_codi, dpto_codi, sgd_oem_direccion, sgd_oem_telefono, id_cont, id_pais) VALUES (0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 170);


--
-- TOC entry 2687 (class 0 OID 16823)
-- Dependencies: 1764
-- Data for Name: sgd_panu_peranulados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2649 (class 0 OID 16536)
-- Dependencies: 1726
-- Data for Name: sgd_parametro; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_ESTADO', 5, 'Prestamo indefinido');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_REQUERIMIENTO', 1, 'Documento');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_REQUERIMIENTO', 2, 'Anexo');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_REQUERIMIENTO', 3, 'Anexo y Documento');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_DIAS_PREST', 1, '8');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_DIAS_CANC', 1, '2');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_PASW', 1, '1');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_ESTADO', 4, 'Cancelado');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_ESTADO', 3, 'Devuelto');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_ESTADO', 2, 'Prestado');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('PRESTAMO_ESTADO', 1, 'Solicitado');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('CLASIFICACION_SEGURIDAD', 1, 'Privado');
INSERT INTO sgd_parametro (param_nomb, param_codi, param_valor) VALUES ('CLASIFICACION_SEGURIDAD', 2, 'Publico');


--
-- TOC entry 2714 (class 0 OID 17194)
-- Dependencies: 1791
-- Data for Name: sgd_parexp_paramexpediente; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2715 (class 0 OID 17205)
-- Dependencies: 1792
-- Data for Name: sgd_pexp_procexpedientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_pexp_procexpedientes (sgd_pexp_codigo, sgd_pexp_descrip, sgd_pexp_terminos, sgd_srd_codigo, sgd_sbrd_codigo, sgd_pexp_automatico, sgd_pexp_tieneflujo) VALUES (0, NULL, 0, NULL, NULL, 1, 0);


--
-- TOC entry 2669 (class 0 OID 16703)
-- Dependencies: 1746
-- Data for Name: sgd_pnufe_procnumfe; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2739 (class 0 OID 17667)
-- Dependencies: 1816
-- Data for Name: sgd_pnun_procenum; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2650 (class 0 OID 16542)
-- Dependencies: 1727
-- Data for Name: sgd_prc_proceso; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2670 (class 0 OID 16709)
-- Dependencies: 1747
-- Data for Name: sgd_prd_prcdmentos; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2716 (class 0 OID 17219)
-- Dependencies: 1793
-- Data for Name: sgd_rdf_retdocf; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2740 (class 0 OID 17683)
-- Dependencies: 1817
-- Data for Name: sgd_renv_regenvio; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2651 (class 0 OID 16548)
-- Dependencies: 1728
-- Data for Name: sgd_rfax_reservafax; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2685 (class 0 OID 16814)
-- Dependencies: 1762
-- Data for Name: sgd_rmr_radmasivre; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2652 (class 0 OID 16555)
-- Dependencies: 1729
-- Data for Name: sgd_san_sancionados; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2671 (class 0 OID 16715)
-- Dependencies: 1748
-- Data for Name: sgd_sbrd_subserierd; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2680 (class 0 OID 16785)
-- Dependencies: 1757
-- Data for Name: sgd_sed_sede; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2683 (class 0 OID 16804)
-- Dependencies: 1760
-- Data for Name: sgd_senuf_secnumfe; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2717 (class 0 OID 17233)
-- Dependencies: 1794
-- Data for Name: sgd_sexp_secexpedientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_sexp_secexpedientes (sgd_exp_numero, sgd_srd_codigo, sgd_sbrd_codigo, sgd_sexp_secuencia, depe_codi, usua_doc, sgd_sexp_fech, sgd_fexp_codigo, sgd_sexp_ano, usua_doc_responsable, sgd_sexp_parexp1, sgd_sexp_parexp2, sgd_sexp_parexp3, sgd_sexp_parexp4, sgd_sexp_parexp5, sgd_pexp_codigo, sgd_exp_fech_arch, sgd_fld_codigo, sgd_exp_fechflujoant, sgd_mrd_codigo, sgd_exp_subexpediente) VALUES ('2009998010100001E', 1, 1, 1, 998, '9876543210', '2009-07-01', 0, 2009, '9876543210', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL);


--
-- TOC entry 2653 (class 0 OID 16564)
-- Dependencies: 1730
-- Data for Name: sgd_srd_seriesrd; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2695 (class 0 OID 16870)
-- Dependencies: 1772
-- Data for Name: sgd_tar_tarifas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2672 (class 0 OID 16726)
-- Dependencies: 1749
-- Data for Name: sgd_tdec_tipodecision; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2673 (class 0 OID 16737)
-- Dependencies: 1750
-- Data for Name: sgd_tid_tipdecision; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2677 (class 0 OID 16762)
-- Dependencies: 1754
-- Data for Name: sgd_tidm_tidocmasiva; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_tidm_tidocmasiva (sgd_tidm_codi, sgd_tidm_desc) VALUES (1, 'PLANTILLA');
INSERT INTO sgd_tidm_tidocmasiva (sgd_tidm_codi, sgd_tidm_desc) VALUES (2, 'CSV');


--
-- TOC entry 2689 (class 0 OID 16835)
-- Dependencies: 1766
-- Data for Name: sgd_tip3_tipotercero; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_tip3_tipotercero (sgd_tip3_codigo, sgd_dir_tipo, sgd_tip3_nombre, sgd_tip3_desc, sgd_tip3_imgpestana, sgd_tpr_tp1, sgd_tpr_tp2) VALUES (1, 1, 'REMITENTE', 'REMITENTE', 'tip3remitente.jpg', 0, 1);
INSERT INTO sgd_tip3_tipotercero (sgd_tip3_codigo, sgd_dir_tipo, sgd_tip3_nombre, sgd_tip3_desc, sgd_tip3_imgpestana, sgd_tpr_tp1, sgd_tpr_tp2) VALUES (2, 1, 'DESTINATARIO', 'DESTINATARIO', 'tip3destina.jpg', 1, 0);
INSERT INTO sgd_tip3_tipotercero (sgd_tip3_codigo, sgd_dir_tipo, sgd_tip3_nombre, sgd_tip3_desc, sgd_tip3_imgpestana, sgd_tpr_tp1, sgd_tpr_tp2) VALUES (3, 2, 'PREDIO', 'PREDIO', 'tip3predio.jpg', 1, 1);
INSERT INTO sgd_tip3_tipotercero (sgd_tip3_codigo, sgd_dir_tipo, sgd_tip3_nombre, sgd_tip3_desc, sgd_tip3_imgpestana, sgd_tpr_tp1, sgd_tpr_tp2) VALUES (4, 3, 'ENTIDADES', 'ENTIDADES ESTATALES', 'tip3ent.jpg', 1, 1);


--
-- TOC entry 2720 (class 0 OID 17270)
-- Dependencies: 1797
-- Data for Name: sgd_tma_temas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2741 (class 0 OID 17715)
-- Dependencies: 1818
-- Data for Name: sgd_tmd_temadepe; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2654 (class 0 OID 16571)
-- Dependencies: 1731
-- Data for Name: sgd_tme_tipmen; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2674 (class 0 OID 16743)
-- Dependencies: 1751
-- Data for Name: sgd_tpr_tpdcumento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_tpr_tpdcumento (sgd_tpr_codigo, sgd_tpr_descrip, sgd_tpr_termino, sgd_tpr_tpuso, sgd_tpr_numera, sgd_tpr_radica, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_estado, sgd_termino_real) VALUES (0, 'No definido', 0, 4, NULL, NULL, 1, 1, 1, NULL);
INSERT INTO sgd_tpr_tpdcumento (sgd_tpr_codigo, sgd_tpr_descrip, sgd_tpr_termino, sgd_tpr_tpuso, sgd_tpr_numera, sgd_tpr_radica, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_estado, sgd_termino_real) VALUES (1, 'Accion de tutela', 0, 4, NULL, NULL, 1, 1, 0, NULL);
INSERT INTO sgd_tpr_tpdcumento (sgd_tpr_codigo, sgd_tpr_descrip, sgd_tpr_termino, sgd_tpr_tpuso, sgd_tpr_numera, sgd_tpr_radica, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_estado, sgd_termino_real) VALUES (2, 'Accion popular', 0, 4, NULL, NULL, 1, 1, 1, NULL);
INSERT INTO sgd_tpr_tpdcumento (sgd_tpr_codigo, sgd_tpr_descrip, sgd_tpr_termino, sgd_tpr_tpuso, sgd_tpr_numera, sgd_tpr_radica, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_estado, sgd_termino_real) VALUES (3, 'ACTA', 0, 4, NULL, NULL, 1, 1, 1, NULL);
INSERT INTO sgd_tpr_tpdcumento (sgd_tpr_codigo, sgd_tpr_descrip, sgd_tpr_termino, sgd_tpr_tpuso, sgd_tpr_numera, sgd_tpr_radica, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_estado, sgd_termino_real) VALUES (4, 'Anexo a Accion de Tutela', 0, 4, NULL, NULL, 1, 1, 1, NULL);
INSERT INTO sgd_tpr_tpdcumento (sgd_tpr_codigo, sgd_tpr_descrip, sgd_tpr_termino, sgd_tpr_tpuso, sgd_tpr_numera, sgd_tpr_radica, sgd_tpr_tp1, sgd_tpr_tp2, sgd_tpr_estado, sgd_termino_real) VALUES (5, 'Anexo a P.Q.R.', 10, 4, NULL, NULL, 1, 1, 1, NULL);


--
-- TOC entry 2655 (class 0 OID 16577)
-- Dependencies: 1732
-- Data for Name: sgd_trad_tiporad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_trad_tiporad (sgd_trad_codigo, sgd_trad_descr, sgd_trad_icono, sgd_trad_genradsal, sgd_trad_diasbloqueo) VALUES (1, 'Salida', NULL, 1, 0);
INSERT INTO sgd_trad_tiporad (sgd_trad_codigo, sgd_trad_descr, sgd_trad_icono, sgd_trad_genradsal, sgd_trad_diasbloqueo) VALUES (2, 'Entrada', NULL, 1, 0);


--
-- TOC entry 2688 (class 0 OID 16829)
-- Dependencies: 1765
-- Data for Name: sgd_tres_tpresolucion; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2690 (class 0 OID 16842)
-- Dependencies: 1767
-- Data for Name: sgd_ttr_transaccion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (0, '--');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (1, 'Recuperacion Radicado');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (2, 'Radicacion');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (7, 'Borrar Informado');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (8, 'Informar');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (9, 'Reasignacion');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (10, 'Movimiento entre Carpetas');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (11, 'Modificacion Radicado');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (12, 'Devuelto-Reasignar');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (13, 'Archivar');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (14, 'Agendar');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (15, 'Sacar de la agenda');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (16, 'Reasignar para Vo.Bo.');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (17, 'Modificacion de Causal');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (18, 'Modificacion del Sector');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (19, 'Cambiar Tipo de Documento');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (20, 'Crear Registro');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (21, 'Editar Registro');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (22, 'Digitalizacion de Radicado');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (23, 'Digitalizacion - Modificacion');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (24, 'Asociacion Imagen fax');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (25, 'Solicitud de Anulacion');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (26, 'Anulacion Rad');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (27, 'Rechazo de Anulacion');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (37, 'Cambio de Estado del Documento');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (28, 'Devolucion de correo');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (29, 'Digitalizacion de Anexo');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (30, 'Radicacion Masiva');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (31, 'Borrado de Anexo a radicado');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (32, 'Asignacion TRD');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (33, 'Eliminar TRD');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (35, 'Tipificacion de la decision');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (36, 'Cambio en la Notificacion');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (38, 'Cambio Vinculacion Documento');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (39, 'Solicitud de Firma');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (40, 'Firma Digital de Documento');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (41, 'Eliminacion solicitud de Firma Digital');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (42, 'Digitalizacion Radicado(Asoc. Imagen Web)');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (50, 'Cambio de Estado Expediente');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (51, 'Creacion Expediente');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (52, 'Excluir radicado de expediente');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (53, 'Incluir radicado en expediente');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (54, 'Cambio Seguridad del Documento');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (55, 'Creacion Subexpediente');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (56, 'Cambio de Responsable');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (57, 'Ingreso al Archivo Fisico');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (58, 'Expediente Cerrado');
INSERT INTO sgd_ttr_transaccion (sgd_ttr_codigo, sgd_ttr_descrip) VALUES (59, 'Expediente Reabierto');


--
-- TOC entry 2656 (class 0 OID 16584)
-- Dependencies: 1733
-- Data for Name: sgd_ush_usuhistorico; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 44, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 76, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 53, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 71, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 59, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 52, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 56, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 58, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 35, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 48, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 45, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 18, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 21, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 63, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 51, '2009-07-01', 'ADMON');
INSERT INTO sgd_ush_usuhistorico (sgd_ush_admcod, sgd_ush_admdep, sgd_ush_admdoc, sgd_ush_usucod, sgd_ush_usudep, sgd_ush_usudoc, sgd_ush_modcod, sgd_ush_fechevento, sgd_ush_usulogin) VALUES (1, 998, '9876543210', 1, 998, '9876543210', 75, '2009-07-01', 'ADMON');


--
-- TOC entry 2657 (class 0 OID 16587)
-- Dependencies: 1734
-- Data for Name: sgd_usm_usumodifica; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (47, 'Quito permiso impresion');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (43, 'Otorgo permiso prestamo de documentos');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (44, 'Quito permiso prestamo de documentos');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (45, 'Otorgo permiso digitalizacion de documentos');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (46, 'Quito permiso digitalizacion de documentos');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (48, 'Otorgo permiso modificaciones');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (49, 'Quito permiso modificaciones');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (50, 'Cambio de perfil');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (1, 'Creacion de usuario');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (51, 'Otorgo permiso tablas retencion documental');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (52, 'Quito permiso tablas retencion documental');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (3, 'Cambio dependencia');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (4, 'Cambio cedula');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (5, 'Cambio nombre');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (7, 'Cambio ubicacion');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (8, 'Cambio piso');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (9, 'Cambio estado');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (10, 'Otorgo permiso radicacion entrada');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (11, 'Otorgo permisos radicacion de entrada');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (12, 'Quito permiso administracion sistema');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (13, 'Otorgo permiso administracion sistema');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (14, 'Quito permiso administracion archivo');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (15, 'Otorgo permiso administracion archivo');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (16, 'Habilitado como usuario nuevo');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (17, 'Habilitado como usuario antiguo con clave');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (18, 'Cambio nivel');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (19, 'Otorgo permiso radicacion salida');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (20, 'Otorgo permiso impresion');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (21, 'Otorgo permiso radicacion masiva');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (22, 'Quito permiso radicacion masiva');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (23, 'Quito permiso devoluciones de correo');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (24, 'Otorgo permiso devoluciones de correo');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (25, 'Otorgo permiso de solicitud de anulacion');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (26, 'Otorgo permiso de anulacion');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (27, 'Otorgo permiso de solicitud de anulacion y anulacion');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (28, 'Quito permiso radicacion memorandos');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (29, 'Otorgo permiso radicacion memorandos');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (30, 'Quito permiso radicacion resoluciones');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (31, 'Otorgo permiso radicacion resoluciones');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (33, 'Quito permiso envio de correo');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (34, 'Otorgo permiso envio de correo');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (35, 'Otorgo permiso radicacion de salida ');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (39, 'Cambio extension');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (40, 'Cambio email');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (41, 'Quito permisos radicacion entrada');
INSERT INTO sgd_usm_usumodifica (sgd_usm_modcod, sgd_usm_moddescr) VALUES (42, 'Quito permisos de solicitud de anulacion y anulaciones');


--
-- TOC entry 2658 (class 0 OID 16591)
-- Dependencies: 1735
-- Data for Name: tipo_doc_identificacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_doc_identificacion (tdid_codi, tdid_desc) VALUES (0, 'Cedula de Ciudadania');
INSERT INTO tipo_doc_identificacion (tdid_codi, tdid_desc) VALUES (1, 'Tarjeta de Identidad');
INSERT INTO tipo_doc_identificacion (tdid_codi, tdid_desc) VALUES (2, 'Cedula de Extranjeria');
INSERT INTO tipo_doc_identificacion (tdid_codi, tdid_desc) VALUES (3, 'Pasaporte');
INSERT INTO tipo_doc_identificacion (tdid_codi, tdid_desc) VALUES (4, 'Nit');
INSERT INTO tipo_doc_identificacion (tdid_codi, tdid_desc) VALUES (5, 'NUIR');


--
-- TOC entry 2659 (class 0 OID 16597)
-- Dependencies: 1736
-- Data for Name: tipo_remitente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO tipo_remitente (trte_codi, trte_desc) VALUES (0, 'Entidades');
INSERT INTO tipo_remitente (trte_codi, trte_desc) VALUES (1, 'Otras empresas');
INSERT INTO tipo_remitente (trte_codi, trte_desc) VALUES (2, 'Persona natural');
INSERT INTO tipo_remitente (trte_codi, trte_desc) VALUES (3, 'Predio');
INSERT INTO tipo_remitente (trte_codi, trte_desc) VALUES (5, 'Otros');
INSERT INTO tipo_remitente (trte_codi, trte_desc) VALUES (6, 'Funcionario');


--
-- TOC entry 2676 (class 0 OID 16758)
-- Dependencies: 1753
-- Data for Name: ubicacion_fisica; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2703 (class 0 OID 16963)
-- Dependencies: 1780
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuario (usua_codi, depe_codi, usua_login, usua_fech_crea, usua_pasw, usua_esta, usua_nomb, perm_radi, usua_admin, usua_nuevo, usua_doc, codi_nivel, usua_sesion, usua_fech_sesion, usua_ext, usua_nacim, usua_email, usua_at, usua_piso, perm_radi_sal, usua_admin_archivo, usua_masiva, usua_perm_dev, usua_perm_numera_res, usua_doc_suip, usua_perm_numeradoc, sgd_panu_codi, usua_prad_tp1, usua_prad_tp2, usua_perm_envios, usua_perm_modifica, usua_perm_impresion, sgd_aper_codigo, usu_telefono1, usua_encuesta, sgd_perm_estadistica, usua_perm_sancionados, usua_admin_sistema, usua_perm_trd, usua_perm_firma, usua_perm_prestamo, usuario_publico, usuario_reasignar, usua_perm_notifica, usua_perm_expediente, usua_login_externo, id_pais, id_cont, perm_tipif_anexo, perm_vobo, perm_archi, perm_borrar_anexo, usua_auth_ldap, usua_perm_adminflujos, usua_adm_plantilla, usua_perm_intergapps) VALUES (1, 999, 'DSALIDA', '2009-07-01', 'a', '1', 'Usuario Dsalida', '0', '0', '0', '1234567890', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 170, 1, NULL, '1', '1', NULL, NULL, 0, 0, 0);
INSERT INTO usuario (usua_codi, depe_codi, usua_login, usua_fech_crea, usua_pasw, usua_esta, usua_nomb, perm_radi, usua_admin, usua_nuevo, usua_doc, codi_nivel, usua_sesion, usua_fech_sesion, usua_ext, usua_nacim, usua_email, usua_at, usua_piso, perm_radi_sal, usua_admin_archivo, usua_masiva, usua_perm_dev, usua_perm_numera_res, usua_doc_suip, usua_perm_numeradoc, sgd_panu_codi, usua_prad_tp1, usua_prad_tp2, usua_perm_envios, usua_perm_modifica, usua_perm_impresion, sgd_aper_codigo, usu_telefono1, usua_encuesta, sgd_perm_estadistica, usua_perm_sancionados, usua_admin_sistema, usua_perm_trd, usua_perm_firma, usua_perm_prestamo, usuario_publico, usuario_reasignar, usua_perm_notifica, usua_perm_expediente, usua_login_externo, id_pais, id_cont, perm_tipif_anexo, perm_vobo, perm_archi, perm_borrar_anexo, usua_auth_ldap, usua_perm_adminflujos, usua_adm_plantilla, usua_perm_intergapps) VALUES (1, 998, 'ADMON', '2009-07-01', '02cb962ac59075b964b07152d2', '1', 'Usuario Administrador', '1', '0', '1', '9876543210', 5, '090703035354o127001ADMON', '2009-07-03', NULL, NULL, NULL, NULL, NULL, 0, 2, 1, 0, NULL, NULL, NULL, 0, 3, 3, 0, 1, 0, NULL, NULL, NULL, 2, NULL, 1, 1, 0, 0, 0, 0, 0, 2, NULL, 170, 1, 0, '1', '1', 0, 0, 0, 0, 0);


--
-- TOC entry 2449 (class 2606 OID 17382)
-- Dependencies: 1800 1800 1800
-- Name: anexos_historico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anexos_historico
    ADD CONSTRAINT anexos_historico_pkey PRIMARY KEY (anex_hist_anex_codi, anex_hist_num_ver);


--
-- TOC entry 2442 (class 2606 OID 17366)
-- Dependencies: 1799 1799
-- Name: anexos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anexos
    ADD CONSTRAINT anexos_pkey PRIMARY KEY (anex_codigo);


--
-- TOC entry 2172 (class 2606 OID 16408)
-- Dependencies: 1706 1706
-- Name: anexos_tipo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY anexos_tipo
    ADD CONSTRAINT anexos_tipo_pkey PRIMARY KEY (anex_tipo_codi);


--
-- TOC entry 2175 (class 2606 OID 16417)
-- Dependencies: 1707 1707
-- Name: bodega_empresas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY bodega_empresas
    ADD CONSTRAINT bodega_empresas_pkey PRIMARY KEY (identificador_empresa);


--
-- TOC entry 2366 (class 2606 OID 16939)
-- Dependencies: 1778 1778 1778 1778
-- Name: carpeta_per_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY carpeta_per
    ADD CONSTRAINT carpeta_per_pkey PRIMARY KEY (usua_codi, depe_codi, codi_carp);


--
-- TOC entry 2185 (class 2606 OID 16430)
-- Dependencies: 1708 1708
-- Name: carpeta_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY carpeta
    ADD CONSTRAINT carpeta_pkey PRIMARY KEY (carp_codi);


--
-- TOC entry 2358 (class 2606 OID 16898)
-- Dependencies: 1775 1775 1775 1775
-- Name: departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT departamento_pkey PRIMARY KEY (id_cont, id_pais, dpto_codi);


--
-- TOC entry 2363 (class 2606 OID 16923)
-- Dependencies: 1777 1777
-- Name: dependencia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT dependencia_pkey PRIMARY KEY (depe_codi);


--
-- TOC entry 2370 (class 2606 OID 16951)
-- Dependencies: 1779 1779
-- Name: dependencia_visibilidad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY dependencia_visibilidad
    ADD CONSTRAINT dependencia_visibilidad_pkey PRIMARY KEY (codigo_visibilidad);


--
-- TOC entry 2188 (class 2606 OID 16436)
-- Dependencies: 1709 1709
-- Name: estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY estado
    ADD CONSTRAINT estado_pkey PRIMARY KEY (esta_codi);


--
-- TOC entry 2518 (class 2606 OID 17825)
-- Dependencies: 1824 1824
-- Name: id; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_arch_depe
    ADD CONSTRAINT id PRIMARY KEY (sgd_arch_id);


--
-- TOC entry 2192 (class 2606 OID 16442)
-- Dependencies: 1710 1710
-- Name: medio_recepcion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY medio_recepcion
    ADD CONSTRAINT medio_recepcion_pkey PRIMARY KEY (mrec_codi);


--
-- TOC entry 2361 (class 2606 OID 16909)
-- Dependencies: 1776 1776 1776 1776 1776
-- Name: municipio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT municipio_pkey PRIMARY KEY (id_cont, id_pais, dpto_codi, muni_codi);


--
-- TOC entry 2195 (class 2606 OID 16448)
-- Dependencies: 1711 1711
-- Name: par_serv_servicios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY par_serv_servicios
    ADD CONSTRAINT par_serv_servicios_pkey PRIMARY KEY (par_serv_secue);


--
-- TOC entry 2457 (class 2606 OID 17429)
-- Dependencies: 1803 1803
-- Name: prestamo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT prestamo_pkey PRIMARY KEY (pres_id);


--
-- TOC entry 2439 (class 2606 OID 17869)
-- Dependencies: 1798 1798
-- Name: radicado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_pkey PRIMARY KEY (radi_nume_radi);


--
-- TOC entry 2199 (class 2606 OID 16454)
-- Dependencies: 1712 1712 1712 1712
-- Name: series_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY series
    ADD CONSTRAINT series_pkey PRIMARY KEY (depe_codi, seri_tipo, seri_ano);


--
-- TOC entry 2460 (class 2606 OID 17460)
-- Dependencies: 1804 1804 1804
-- Name: sgd_acm_acusemsg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_acm_acusemsg
    ADD CONSTRAINT sgd_acm_acusemsg_pkey PRIMARY KEY (sgd_msg_codi, usua_doc);


--
-- TOC entry 2268 (class 2606 OID 16607)
-- Dependencies: 1737 1737
-- Name: sgd_actadd_actualiadicional_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_actadd_actualiadicional
    ADD CONSTRAINT sgd_actadd_actualiadicional_pkey PRIMARY KEY (sgd_actadd_codi);


--
-- TOC entry 2378 (class 2606 OID 17006)
-- Dependencies: 1781 1781
-- Name: sgd_admin_depe_historico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_admin_depe_historico
    ADD CONSTRAINT sgd_admin_depe_historico_pkey PRIMARY KEY (admin_depe_historico_codigo);


--
-- TOC entry 2201 (class 2606 OID 16461)
-- Dependencies: 1713 1713
-- Name: sgd_admin_dependencia_estado_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_admin_dependencia_estado
    ADD CONSTRAINT sgd_admin_dependencia_estado_pkey PRIMARY KEY (codigo_estado);


--
-- TOC entry 2203 (class 2606 OID 16466)
-- Dependencies: 1714 1714
-- Name: sgd_admin_observacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_admin_observacion
    ADD CONSTRAINT sgd_admin_observacion_pkey PRIMARY KEY (codigo_observacion);


--
-- TOC entry 2380 (class 2606 OID 17016)
-- Dependencies: 1782 1782
-- Name: sgd_admin_usua_historico_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_admin_usua_historico
    ADD CONSTRAINT sgd_admin_usua_historico_pkey PRIMARY KEY (admin_historico_codigo);


--
-- TOC entry 2205 (class 2606 OID 16471)
-- Dependencies: 1715 1715
-- Name: sgd_admin_usua_perfiles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_admin_usua_perfiles
    ADD CONSTRAINT sgd_admin_usua_perfiles_pkey PRIMARY KEY (codigo_perfil);


--
-- TOC entry 2463 (class 2606 OID 17482)
-- Dependencies: 1806 1806
-- Name: sgd_anar_anexarg_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_anar_anexarg
    ADD CONSTRAINT sgd_anar_anexarg_pkey PRIMARY KEY (sgd_anar_codi);


--
-- TOC entry 2310 (class 2606 OID 16756)
-- Dependencies: 1752 1752
-- Name: sgd_aper_adminperfiles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aper_adminperfiles
    ADD CONSTRAINT sgd_aper_adminperfiles_pkey PRIMARY KEY (sgd_aper_codigo);


--
-- TOC entry 2270 (class 2606 OID 16623)
-- Dependencies: 1738 1738
-- Name: sgd_aplfad_plicfunadi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aplfad_plicfunadi
    ADD CONSTRAINT sgd_aplfad_plicfunadi_pkey PRIMARY KEY (sgd_aplfad_codi);


--
-- TOC entry 2208 (class 2606 OID 16476)
-- Dependencies: 1716 1716
-- Name: sgd_apli_aplintegra_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_apli_aplintegra
    ADD CONSTRAINT sgd_apli_aplintegra_pkey PRIMARY KEY (sgd_apli_codi);


--
-- TOC entry 2273 (class 2606 OID 16634)
-- Dependencies: 1739 1739
-- Name: sgd_aplmen_aplimens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aplmen_aplimens
    ADD CONSTRAINT sgd_aplmen_aplimens_pkey PRIMARY KEY (sgd_aplmen_codi);


--
-- TOC entry 2277 (class 2606 OID 16645)
-- Dependencies: 1740 1740
-- Name: sgd_aplus_plicusua_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_aplus_plicusua
    ADD CONSTRAINT sgd_aplus_plicusua_pkey PRIMARY KEY (sgd_aplus_codi);


--
-- TOC entry 2211 (class 2606 OID 16482)
-- Dependencies: 1717 1717
-- Name: sgd_argd_argdoc_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_argd_argdoc
    ADD CONSTRAINT sgd_argd_argdoc_pkey PRIMARY KEY (sgd_argd_codi);


--
-- TOC entry 2320 (class 2606 OID 16783)
-- Dependencies: 1756 1756
-- Name: sgd_argup_argudoctop_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_argup_argudoctop
    ADD CONSTRAINT sgd_argup_argudoctop_pkey PRIMARY KEY (sgd_argup_codi);


--
-- TOC entry 2424 (class 2606 OID 17252)
-- Dependencies: 1795 1795
-- Name: sgd_camexp_campoexpediente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_camexp_campoexpediente
    ADD CONSTRAINT sgd_camexp_campoexpediente_pkey PRIMARY KEY (sgd_camexp_codigo);


--
-- TOC entry 2383 (class 2606 OID 17036)
-- Dependencies: 1783 1783 1783
-- Name: sgd_carp_descripcion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_carp_descripcion
    ADD CONSTRAINT sgd_carp_descripcion_pkey PRIMARY KEY (sgd_carp_depecodi, sgd_carp_tiporad);


--
-- TOC entry 2214 (class 2606 OID 16488)
-- Dependencies: 1718 1718
-- Name: sgd_cau_causal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_cau_causal
    ADD CONSTRAINT sgd_cau_causal_pkey PRIMARY KEY (sgd_cau_codigo);


--
-- TOC entry 2466 (class 2606 OID 17511)
-- Dependencies: 1808 1808
-- Name: sgd_caux_causales_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_caux_causales
    ADD CONSTRAINT sgd_caux_causales_pkey PRIMARY KEY (sgd_caux_codigo);


--
-- TOC entry 2390 (class 2606 OID 17080)
-- Dependencies: 1785 1785
-- Name: sgd_ciu_ciudadano_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ciu_ciudadano
    ADD CONSTRAINT sgd_ciu_ciudadano_pkey PRIMARY KEY (sgd_ciu_codigo);


--
-- TOC entry 2317 (class 2606 OID 16772)
-- Dependencies: 1755 1755
-- Name: sgd_cob_campobliga_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_cob_campobliga
    ADD CONSTRAINT sgd_cob_campobliga_pkey PRIMARY KEY (sgd_cob_codi);


--
-- TOC entry 2280 (class 2606 OID 16656)
-- Dependencies: 1741 1741
-- Name: sgd_dcau_causal_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_dcau_causal
    ADD CONSTRAINT sgd_dcau_causal_pkey PRIMARY KEY (sgd_dcau_codigo);


--
-- TOC entry 2282 (class 2606 OID 16667)
-- Dependencies: 1742 1742
-- Name: sgd_ddca_ddsgrgdo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ddca_ddsgrgdo
    ADD CONSTRAINT sgd_ddca_ddsgrgdo_pkey PRIMARY KEY (sgd_ddca_codigo);


--
-- TOC entry 2353 (class 2606 OID 16877)
-- Dependencies: 1773 1773
-- Name: sgd_def_continentes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_def_continentes
    ADD CONSTRAINT sgd_def_continentes_pkey PRIMARY KEY (id_cont);


--
-- TOC entry 2356 (class 2606 OID 16885)
-- Dependencies: 1774 1774 1774
-- Name: sgd_def_paises_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_def_paises
    ADD CONSTRAINT sgd_def_paises_pkey PRIMARY KEY (id_cont, id_pais);


--
-- TOC entry 2285 (class 2606 OID 16685)
-- Dependencies: 1744 1744
-- Name: sgd_deve_dev_envio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_deve_dev_envio
    ADD CONSTRAINT sgd_deve_dev_envio_pkey PRIMARY KEY (sgd_deve_codigo);


--
-- TOC entry 2505 (class 2606 OID 17637)
-- Dependencies: 1815 1815
-- Name: sgd_dir_drecciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT sgd_dir_drecciones_pkey PRIMARY KEY (sgd_dir_codigo);


--
-- TOC entry 2386 (class 2606 OID 17052)
-- Dependencies: 1784 1784
-- Name: sgd_dnufe_docnufe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_dnufe_docnufe
    ADD CONSTRAINT sgd_dnufe_docnufe_pkey PRIMARY KEY (sgd_dnufe_codi);


--
-- TOC entry 2350 (class 2606 OID 16869)
-- Dependencies: 1771 1771
-- Name: sgd_eanu_estanulacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_eanu_estanulacion
    ADD CONSTRAINT sgd_eanu_estanulacion_pkey PRIMARY KEY (sgd_eanu_codi);


--
-- TOC entry 2217 (class 2606 OID 16497)
-- Dependencies: 1719 1719
-- Name: sgd_einv_inventario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_einv_inventario
    ADD CONSTRAINT sgd_einv_inventario_pkey PRIMARY KEY (sgd_einv_codigo);


--
-- TOC entry 2220 (class 2606 OID 17760)
-- Dependencies: 1720 1720
-- Name: sgd_eit_items_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_eit_items
    ADD CONSTRAINT sgd_eit_items_pkey PRIMARY KEY (sgd_eit_codigo);


--
-- TOC entry 2325 (class 2606 OID 16795)
-- Dependencies: 1758 1758 1758
-- Name: sgd_ent_entidades_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ent_entidades
    ADD CONSTRAINT sgd_ent_entidades_pkey PRIMARY KEY (sgd_ent_nit, sgd_ent_codsuc);


--
-- TOC entry 2287 (class 2606 OID 16691)
-- Dependencies: 1745 1745
-- Name: sgd_estinst_estadoinstancia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_estinst_estadoinstancia
    ADD CONSTRAINT sgd_estinst_estadoinstancia_pkey PRIMARY KEY (sgd_estinst_codi);


--
-- TOC entry 2483 (class 2606 OID 17561)
-- Dependencies: 1810 1810
-- Name: sgd_fars_faristas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fars_faristas
    ADD CONSTRAINT sgd_fars_faristas_pkey PRIMARY KEY (sgd_fars_codigo);


--
-- TOC entry 2328 (class 2606 OID 16802)
-- Dependencies: 1759 1759
-- Name: sgd_fenv_frmenvio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fenv_frmenvio
    ADD CONSTRAINT sgd_fenv_frmenvio_pkey PRIMARY KEY (sgd_fenv_codigo);


--
-- TOC entry 2427 (class 2606 OID 17263)
-- Dependencies: 1796 1796
-- Name: sgd_fexp_flujoexpedientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fexp_flujoexpedientes
    ADD CONSTRAINT sgd_fexp_flujoexpedientes_pkey PRIMARY KEY (sgd_fexp_codigo);


--
-- TOC entry 2486 (class 2606 OID 17575)
-- Dependencies: 1811 1811
-- Name: sgd_firrad_firmarads_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_firrad_firmarads
    ADD CONSTRAINT sgd_firrad_firmarads_pkey PRIMARY KEY (sgd_firrad_id);


--
-- TOC entry 2223 (class 2606 OID 16510)
-- Dependencies: 1721 1721
-- Name: sgd_fun_funciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_fun_funciones
    ADD CONSTRAINT sgd_fun_funciones_pkey PRIMARY KEY (sgd_fun_codigo);


--
-- TOC entry 2489 (class 2606 OID 17586)
-- Dependencies: 1812 1812
-- Name: sgd_hmtd_hismatdoc_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_hmtd_hismatdoc
    ADD CONSTRAINT sgd_hmtd_hismatdoc_pkey PRIMARY KEY (sgd_hmtd_codigo);


--
-- TOC entry 2226 (class 2606 OID 16516)
-- Dependencies: 1722 1722
-- Name: sgd_instorf_instanciasorfeo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_instorf_instanciasorfeo
    ADD CONSTRAINT sgd_instorf_instanciasorfeo_pkey PRIMARY KEY (sgd_instorf_codi);


--
-- TOC entry 2229 (class 2606 OID 16522)
-- Dependencies: 1723 1723
-- Name: sgd_masiva_excel_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_masiva_excel
    ADD CONSTRAINT sgd_masiva_excel_pkey PRIMARY KEY (sgd_masiva_codigo);


--
-- TOC entry 2395 (class 2606 OID 17101)
-- Dependencies: 1786 1786
-- Name: sgd_mat_matriz_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT sgd_mat_matriz_pkey PRIMARY KEY (sgd_mat_codigo);


--
-- TOC entry 2348 (class 2606 OID 16852)
-- Dependencies: 1768 1768
-- Name: sgd_mpes_mddpeso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mpes_mddpeso
    ADD CONSTRAINT sgd_mpes_mddpeso_pkey PRIMARY KEY (sgd_mpes_codigo);


--
-- TOC entry 2399 (class 2606 OID 17128)
-- Dependencies: 1787 1787
-- Name: sgd_mrd_matrird_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT sgd_mrd_matrird_pkey PRIMARY KEY (sgd_mrd_codigo);


--
-- TOC entry 2405 (class 2606 OID 17166)
-- Dependencies: 1789 1789
-- Name: sgd_msdep_msgdep_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_msdep_msgdep
    ADD CONSTRAINT sgd_msdep_msgdep_pkey PRIMARY KEY (sgd_msdep_codi);


--
-- TOC entry 2402 (class 2606 OID 17155)
-- Dependencies: 1788 1788
-- Name: sgd_msg_mensaje_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_msg_mensaje
    ADD CONSTRAINT sgd_msg_mensaje_pkey PRIMARY KEY (sgd_msg_codi);


--
-- TOC entry 2408 (class 2606 OID 17182)
-- Dependencies: 1790 1790
-- Name: sgd_mtd_matriz_doc_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_mtd_matriz_doc
    ADD CONSTRAINT sgd_mtd_matriz_doc_pkey PRIMARY KEY (sgd_mtd_codigo);


--
-- TOC entry 2232 (class 2606 OID 16528)
-- Dependencies: 1724 1724
-- Name: sgd_noh_nohabiles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_noh_nohabiles
    ADD CONSTRAINT sgd_noh_nohabiles_pkey PRIMARY KEY (noh_fecha);


--
-- TOC entry 2235 (class 2606 OID 16534)
-- Dependencies: 1725 1725
-- Name: sgd_not_notificacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_not_notificacion
    ADD CONSTRAINT sgd_not_notificacion_pkey PRIMARY KEY (sgd_not_codi);


--
-- TOC entry 2493 (class 2606 OID 17617)
-- Dependencies: 1814 1814
-- Name: sgd_oem_oempresas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_oem_oempresas
    ADD CONSTRAINT sgd_oem_oempresas_pkey PRIMARY KEY (sgd_oem_codigo);


--
-- TOC entry 2337 (class 2606 OID 16827)
-- Dependencies: 1764 1764
-- Name: sgd_panu_peranulados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_panu_peranulados
    ADD CONSTRAINT sgd_panu_peranulados_pkey PRIMARY KEY (sgd_panu_codi);


--
-- TOC entry 2238 (class 2606 OID 16540)
-- Dependencies: 1726 1726 1726
-- Name: sgd_parametro_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_parametro
    ADD CONSTRAINT sgd_parametro_pkey PRIMARY KEY (param_nomb, param_codi);


--
-- TOC entry 2411 (class 2606 OID 17198)
-- Dependencies: 1791 1791
-- Name: sgd_parexp_paramexpediente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_parexp_paramexpediente
    ADD CONSTRAINT sgd_parexp_paramexpediente_pkey PRIMARY KEY (sgd_parexp_codigo);


--
-- TOC entry 2414 (class 2606 OID 17212)
-- Dependencies: 1792 1792
-- Name: sgd_pexp_procexpedientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_pexp_procexpedientes
    ADD CONSTRAINT sgd_pexp_procexpedientes_pkey PRIMARY KEY (sgd_pexp_codigo);


--
-- TOC entry 2291 (class 2606 OID 16707)
-- Dependencies: 1746 1746
-- Name: sgd_pnufe_procnumfe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_pnufe_procnumfe
    ADD CONSTRAINT sgd_pnufe_procnumfe_pkey PRIMARY KEY (sgd_pnufe_codi);


--
-- TOC entry 2508 (class 2606 OID 17671)
-- Dependencies: 1816 1816
-- Name: sgd_pnun_procenum_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_pnun_procenum
    ADD CONSTRAINT sgd_pnun_procenum_pkey PRIMARY KEY (sgd_pnun_codi);


--
-- TOC entry 2241 (class 2606 OID 16546)
-- Dependencies: 1727 1727
-- Name: sgd_prc_proceso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_prc_proceso
    ADD CONSTRAINT sgd_prc_proceso_pkey PRIMARY KEY (sgd_prc_codigo);


--
-- TOC entry 2294 (class 2606 OID 16713)
-- Dependencies: 1747 1747
-- Name: sgd_prd_prcdmentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_prd_prcdmentos
    ADD CONSTRAINT sgd_prd_prcdmentos_pkey PRIMARY KEY (sgd_prd_codigo);


--
-- TOC entry 2334 (class 2606 OID 16818)
-- Dependencies: 1762 1762 1762
-- Name: sgd_rmr_radmasivre_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_rmr_radmasivre
    ADD CONSTRAINT sgd_rmr_radmasivre_pkey PRIMARY KEY (sgd_rmr_grupo, sgd_rmr_radi);


--
-- TOC entry 2248 (class 2606 OID 16562)
-- Dependencies: 1729 1729
-- Name: sgd_san_sancionados_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_san_sancionados
    ADD CONSTRAINT sgd_san_sancionados_pkey PRIMARY KEY (sgd_san_ref);


--
-- TOC entry 2297 (class 2606 OID 16719)
-- Dependencies: 1748 1748 1748
-- Name: sgd_sbrd_subserierd_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_sbrd_subserierd
    ADD CONSTRAINT sgd_sbrd_subserierd_pkey PRIMARY KEY (sgd_srd_codigo, sgd_sbrd_codigo);


--
-- TOC entry 2322 (class 2606 OID 16789)
-- Dependencies: 1757 1757
-- Name: sgd_sed_sede_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_sed_sede
    ADD CONSTRAINT sgd_sed_sede_pkey PRIMARY KEY (sgd_sed_codi);


--
-- TOC entry 2331 (class 2606 OID 16808)
-- Dependencies: 1760 1760
-- Name: sgd_senuf_secnumfe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_senuf_secnumfe
    ADD CONSTRAINT sgd_senuf_secnumfe_pkey PRIMARY KEY (sgd_senuf_codi);


--
-- TOC entry 2420 (class 2606 OID 17237)
-- Dependencies: 1794 1794
-- Name: sgd_sexp_secexpedientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_sexp_secexpedientes
    ADD CONSTRAINT sgd_sexp_secexpedientes_pkey PRIMARY KEY (sgd_exp_numero);


--
-- TOC entry 2252 (class 2606 OID 16568)
-- Dependencies: 1730 1730
-- Name: sgd_srd_seriesrd_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_srd_seriesrd
    ADD CONSTRAINT sgd_srd_seriesrd_pkey PRIMARY KEY (sgd_srd_codigo);


--
-- TOC entry 2300 (class 2606 OID 16730)
-- Dependencies: 1749 1749
-- Name: sgd_tdec_tipodecision_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tdec_tipodecision
    ADD CONSTRAINT sgd_tdec_tipodecision_pkey PRIMARY KEY (sgd_tdec_codigo);


--
-- TOC entry 2303 (class 2606 OID 16741)
-- Dependencies: 1750 1750
-- Name: sgd_tid_tipdecision_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tid_tipdecision
    ADD CONSTRAINT sgd_tid_tipdecision_pkey PRIMARY KEY (sgd_tid_codi);


--
-- TOC entry 2314 (class 2606 OID 16766)
-- Dependencies: 1754 1754
-- Name: sgd_tidm_tidocmasiva_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tidm_tidocmasiva
    ADD CONSTRAINT sgd_tidm_tidocmasiva_pkey PRIMARY KEY (sgd_tidm_codi);


--
-- TOC entry 2342 (class 2606 OID 16841)
-- Dependencies: 1766 1766
-- Name: sgd_tip3_tipotercero_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tip3_tipotercero
    ADD CONSTRAINT sgd_tip3_tipotercero_pkey PRIMARY KEY (sgd_tip3_codigo);


--
-- TOC entry 2430 (class 2606 OID 17274)
-- Dependencies: 1797 1797
-- Name: sgd_tma_temas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tma_temas
    ADD CONSTRAINT sgd_tma_temas_pkey PRIMARY KEY (sgd_tma_codigo);


--
-- TOC entry 2516 (class 2606 OID 17719)
-- Dependencies: 1818 1818
-- Name: sgd_tmd_temadepe_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tmd_temadepe
    ADD CONSTRAINT sgd_tmd_temadepe_pkey PRIMARY KEY (id);


--
-- TOC entry 2255 (class 2606 OID 16575)
-- Dependencies: 1731 1731
-- Name: sgd_tme_tipmen_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tme_tipmen
    ADD CONSTRAINT sgd_tme_tipmen_pkey PRIMARY KEY (sgd_tme_codi);


--
-- TOC entry 2307 (class 2606 OID 16749)
-- Dependencies: 1751 1751
-- Name: sgd_tpr_tpdcumento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tpr_tpdcumento
    ADD CONSTRAINT sgd_tpr_tpdcumento_pkey PRIMARY KEY (sgd_tpr_codigo);


--
-- TOC entry 2258 (class 2606 OID 16582)
-- Dependencies: 1732 1732
-- Name: sgd_trad_tiporad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_trad_tiporad
    ADD CONSTRAINT sgd_trad_tiporad_pkey PRIMARY KEY (sgd_trad_codigo);


--
-- TOC entry 2340 (class 2606 OID 16833)
-- Dependencies: 1765 1765
-- Name: sgd_tres_tpresolucion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_tres_tpresolucion
    ADD CONSTRAINT sgd_tres_tpresolucion_pkey PRIMARY KEY (sgd_tres_codigo);


--
-- TOC entry 2345 (class 2606 OID 16846)
-- Dependencies: 1767 1767
-- Name: sgd_ttr_transaccion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ttr_transaccion
    ADD CONSTRAINT sgd_ttr_transaccion_pkey PRIMARY KEY (sgd_ttr_codigo);


--
-- TOC entry 2262 (class 2606 OID 16595)
-- Dependencies: 1735 1735
-- Name: tipo_doc_identificacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_doc_identificacion
    ADD CONSTRAINT tipo_doc_identificacion_pkey PRIMARY KEY (tdid_codi);


--
-- TOC entry 2265 (class 2606 OID 16601)
-- Dependencies: 1736 1736
-- Name: tipo_remitente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tipo_remitente
    ADD CONSTRAINT tipo_remitente_pkey PRIMARY KEY (trte_codi);


--
-- TOC entry 2376 (class 2606 OID 16988)
-- Dependencies: 1780 1780
-- Name: usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (usua_login);


--
-- TOC entry 2440 (class 1259 OID 17374)
-- Dependencies: 1799 1799 1799 1799
-- Name: anexos_idx_001; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX anexos_idx_001 ON anexos USING btree (anex_creador, anex_borrado, anex_estado, sgd_deve_codigo);


--
-- TOC entry 2367 (class 1259 OID 16946)
-- Dependencies: 1778
-- Name: carpetas_per; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX carpetas_per ON carpeta_per USING btree (codi_carp);


--
-- TOC entry 2368 (class 1259 OID 16945)
-- Dependencies: 1778 1778
-- Name: carpetas_per1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX carpetas_per1 ON carpeta_per USING btree (usua_codi, depe_codi);


--
-- TOC entry 2266 (class 1259 OID 16618)
-- Dependencies: 1737
-- Name: idx_actadd_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_actadd_codi ON sgd_actadd_actualiadicional USING btree (sgd_actadd_codi);


--
-- TOC entry 2461 (class 1259 OID 17493)
-- Dependencies: 1806
-- Name: idx_anar_anexarg; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_anar_anexarg ON sgd_anar_anexarg USING btree (sgd_anar_codi);


--
-- TOC entry 2443 (class 1259 OID 17373)
-- Dependencies: 1799
-- Name: idx_anex_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_anex_codigo ON anexos USING btree (anex_codigo);


--
-- TOC entry 2444 (class 1259 OID 17377)
-- Dependencies: 1799
-- Name: idx_anex_depe_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_anex_depe_codi ON anexos USING btree (anex_depe_codi);


--
-- TOC entry 2450 (class 1259 OID 17393)
-- Dependencies: 1800 1800
-- Name: idx_anex_hist; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_anex_hist ON anexos_historico USING btree (anex_hist_anex_codi, anex_hist_num_ver);


--
-- TOC entry 2445 (class 1259 OID 17375)
-- Dependencies: 1799
-- Name: idx_anex_numero; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_anex_numero ON anexos USING btree (anex_numero);


--
-- TOC entry 2446 (class 1259 OID 17372)
-- Dependencies: 1799
-- Name: idx_anex_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_anex_radi ON anexos USING btree (anex_radi_nume);


--
-- TOC entry 2447 (class 1259 OID 17376)
-- Dependencies: 1799
-- Name: idx_anex_radi_sal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_anex_radi_sal ON anexos USING btree (radi_nume_salida);


--
-- TOC entry 2173 (class 1259 OID 16409)
-- Dependencies: 1706
-- Name: idx_anex_tipo_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_anex_tipo_codi ON anexos_tipo USING btree (anex_tipo_codi);


--
-- TOC entry 2308 (class 1259 OID 16757)
-- Dependencies: 1752
-- Name: idx_aper_adminperfiles; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_aper_adminperfiles ON sgd_aper_adminperfiles USING btree (sgd_aper_codigo);


--
-- TOC entry 2196 (class 1259 OID 16456)
-- Dependencies: 1712
-- Name: idx_bloqueo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_bloqueo ON series USING btree (bloq);


--
-- TOC entry 2176 (class 1259 OID 16424)
-- Dependencies: 1707
-- Name: idx_bodega_empresas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_bodega_empresas ON bodega_empresas USING btree (identificador_empresa);


--
-- TOC entry 2177 (class 1259 OID 16422)
-- Dependencies: 1707 1707 1707 1707
-- Name: idx_bodega_inter; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_bodega_inter ON bodega_empresas USING btree (codigo_del_departamento, codigo_del_municipio, id_cont, id_pais);


--
-- TOC entry 2178 (class 1259 OID 16420)
-- Dependencies: 1707
-- Name: idx_bodega_nit; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_bodega_nit ON bodega_empresas USING btree (nit_de_la_empresa);


--
-- TOC entry 2179 (class 1259 OID 16418)
-- Dependencies: 1707
-- Name: idx_bodega_nombre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_bodega_nombre ON bodega_empresas USING btree (nombre_de_la_empresa);


--
-- TOC entry 2180 (class 1259 OID 16419)
-- Dependencies: 1707
-- Name: idx_bodega_nuir; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_bodega_nuir ON bodega_empresas USING btree (nuir);


--
-- TOC entry 2181 (class 1259 OID 16421)
-- Dependencies: 1707
-- Name: idx_bodega_sigla; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_bodega_sigla ON bodega_empresas USING btree (sigla_de_la_empresa);


--
-- TOC entry 2381 (class 1259 OID 17047)
-- Dependencies: 1783 1783
-- Name: idx_carp_descripcion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_carp_descripcion ON sgd_carp_descripcion USING btree (sgd_carp_depecodi, sgd_carp_tiporad);


--
-- TOC entry 2186 (class 1259 OID 16431)
-- Dependencies: 1708
-- Name: idx_carpetas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_carpetas ON carpeta USING btree (carp_codi);


--
-- TOC entry 2451 (class 1259 OID 17407)
-- Dependencies: 1801 1801 1801 1801
-- Name: idx_consulta; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_consulta ON hist_eventos USING btree (depe_codi, hist_fech, usua_codi, radi_nume_radi);


--
-- TOC entry 2351 (class 1259 OID 16878)
-- Dependencies: 1773
-- Name: idx_def_continentes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_def_continentes ON sgd_def_continentes USING btree (id_cont);


--
-- TOC entry 2354 (class 1259 OID 16891)
-- Dependencies: 1774
-- Name: idx_def_paises; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_def_paises ON sgd_def_paises USING btree (id_cont);


--
-- TOC entry 2364 (class 1259 OID 16934)
-- Dependencies: 1777
-- Name: idx_depe; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_depe ON dependencia USING btree (depe_codi);


--
-- TOC entry 2371 (class 1259 OID 16962)
-- Dependencies: 1779
-- Name: idx_dependencia_visibilidad; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_dependencia_visibilidad ON dependencia_visibilidad USING btree (codigo_visibilidad);


--
-- TOC entry 2495 (class 1259 OID 17661)
-- Dependencies: 1815
-- Name: idx_dir_ciu_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_dir_ciu_codigo ON sgd_dir_drecciones USING btree (sgd_ciu_codigo);


--
-- TOC entry 2496 (class 1259 OID 17662)
-- Dependencies: 1815 1815 1815 1815
-- Name: idx_dir_int; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_dir_int ON sgd_dir_drecciones USING btree (muni_codi, dpto_codi, id_pais, id_cont);


--
-- TOC entry 2384 (class 1259 OID 17073)
-- Dependencies: 1784
-- Name: idx_dnufe_docnufe; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_dnufe_docnufe ON sgd_dnufe_docnufe USING btree (sgd_dnufe_codi);


--
-- TOC entry 2215 (class 1259 OID 16498)
-- Dependencies: 1719
-- Name: idx_einv_inventario; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_einv_inventario ON sgd_einv_inventario USING btree (sgd_einv_codigo);


--
-- TOC entry 2218 (class 1259 OID 17758)
-- Dependencies: 1720
-- Name: idx_eit_items; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_eit_items ON sgd_eit_items USING btree (sgd_eit_codigo);


--
-- TOC entry 2189 (class 1259 OID 16437)
-- Dependencies: 1709
-- Name: idx_estado; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_estado ON estado USING btree (esta_codi);


--
-- TOC entry 2467 (class 1259 OID 17549)
-- Dependencies: 1809
-- Name: idx_exp_asun; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_asun ON sgd_exp_expediente USING btree (sgd_exp_asunto);


--
-- TOC entry 2468 (class 1259 OID 17553)
-- Dependencies: 1809
-- Name: idx_exp_caja; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_caja ON sgd_exp_expediente USING btree (sgd_exp_caja);


--
-- TOC entry 2469 (class 1259 OID 17552)
-- Dependencies: 1809
-- Name: idx_exp_estant; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_estant ON sgd_exp_expediente USING btree (sgd_exp_estante);


--
-- TOC entry 2470 (class 1259 OID 17543)
-- Dependencies: 1809
-- Name: idx_exp_exp; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_exp ON sgd_exp_expediente USING btree (sgd_exp_numero);


--
-- TOC entry 2471 (class 1259 OID 17554)
-- Dependencies: 1809
-- Name: idx_exp_fechaa; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_fechaa ON sgd_exp_expediente USING btree (sgd_exp_fech_arch);


--
-- TOC entry 2472 (class 1259 OID 17555)
-- Dependencies: 1809
-- Name: idx_exp_fechh; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_fechh ON sgd_exp_expediente USING btree (sgd_exp_fechfin);


--
-- TOC entry 2473 (class 1259 OID 17556)
-- Dependencies: 1809
-- Name: idx_exp_folio; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_folio ON sgd_exp_expediente USING btree (sgd_exp_folios);


--
-- TOC entry 2474 (class 1259 OID 17551)
-- Dependencies: 1809
-- Name: idx_exp_isla; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_isla ON sgd_exp_expediente USING btree (sgd_exp_isla);


--
-- TOC entry 2475 (class 1259 OID 17548)
-- Dependencies: 1809
-- Name: idx_exp_titu; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_titu ON sgd_exp_expediente USING btree (sgd_exp_titulo);


--
-- TOC entry 2476 (class 1259 OID 17550)
-- Dependencies: 1809
-- Name: idx_exp_ufisi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_exp_ufisi ON sgd_exp_expediente USING btree (sgd_exp_ufisica);


--
-- TOC entry 2477 (class 1259 OID 17546)
-- Dependencies: 1809 1809
-- Name: idx_expediente_depe_usua; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_expediente_depe_usua ON sgd_exp_expediente USING btree (depe_codi, usua_codi);


--
-- TOC entry 2478 (class 1259 OID 17545)
-- Dependencies: 1809
-- Name: idx_expediente_fecha; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_expediente_fecha ON sgd_exp_expediente USING btree (sgd_exp_fech);


--
-- TOC entry 2479 (class 1259 OID 17547)
-- Dependencies: 1809
-- Name: idx_expediente_usua_doc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_expediente_usua_doc ON sgd_exp_expediente USING btree (usua_doc);


--
-- TOC entry 2481 (class 1259 OID 17567)
-- Dependencies: 1810
-- Name: idx_fars_faristas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_fars_faristas ON sgd_fars_faristas USING btree (sgd_fars_codigo);


--
-- TOC entry 2230 (class 1259 OID 16529)
-- Dependencies: 1724
-- Name: idx_fecha; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_fecha ON sgd_noh_nohabiles USING btree (noh_fecha);


--
-- TOC entry 2425 (class 1259 OID 17269)
-- Dependencies: 1796
-- Name: idx_fexp_descrip; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_fexp_descrip ON sgd_fexp_flujoexpedientes USING btree (sgd_fexp_codigo);


--
-- TOC entry 2484 (class 1259 OID 17581)
-- Dependencies: 1811
-- Name: idx_firrad_firmarads; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_firrad_firmarads ON sgd_firrad_firmarads USING btree (sgd_firrad_id);


--
-- TOC entry 2221 (class 1259 OID 16511)
-- Dependencies: 1721
-- Name: idx_fun_funciones; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_fun_funciones ON sgd_fun_funciones USING btree (sgd_fun_codigo);


--
-- TOC entry 2487 (class 1259 OID 17602)
-- Dependencies: 1812
-- Name: idx_hmtd_hismatdoc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_hmtd_hismatdoc ON sgd_hmtd_hismatdoc USING btree (sgd_hmtd_codigo);


--
-- TOC entry 2453 (class 1259 OID 17424)
-- Dependencies: 1802 1802 1802
-- Name: idx_informado_usuario; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_informado_usuario ON informados USING btree (usua_codi, depe_codi, info_fech);


--
-- TOC entry 2224 (class 1259 OID 16517)
-- Dependencies: 1722
-- Name: idx_instorf_instanciasorfeo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_instorf_instanciasorfeo ON sgd_instorf_instanciasorfeo USING btree (sgd_instorf_codi);


--
-- TOC entry 2392 (class 1259 OID 17123)
-- Dependencies: 1786 1786 1786 1786
-- Name: idx_mat; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_mat ON sgd_mat_matriz USING btree (depe_codi, sgd_fun_codigo, sgd_prc_codigo, sgd_prd_codigo);


--
-- TOC entry 2393 (class 1259 OID 17122)
-- Dependencies: 1786
-- Name: idx_mat_matriz; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_mat_matriz ON sgd_mat_matriz USING btree (sgd_mat_codigo);


--
-- TOC entry 2190 (class 1259 OID 16443)
-- Dependencies: 1710
-- Name: idx_medio_recepcion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_medio_recepcion ON medio_recepcion USING btree (mrec_codi);


--
-- TOC entry 2346 (class 1259 OID 16853)
-- Dependencies: 1768
-- Name: idx_mpes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_mpes ON sgd_mpes_mddpeso USING btree (sgd_mpes_codigo);


--
-- TOC entry 2396 (class 1259 OID 17149)
-- Dependencies: 1787
-- Name: idx_mrd_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_mrd_codigo ON sgd_mrd_matrird USING btree (sgd_mrd_codigo);


--
-- TOC entry 2397 (class 1259 OID 17150)
-- Dependencies: 1787 1787 1787 1787
-- Name: idx_mrd_matrird; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_mrd_matrird ON sgd_mrd_matrird USING btree (depe_codi, sgd_srd_codigo, sgd_sbrd_codigo, sgd_tpr_codigo);


--
-- TOC entry 2403 (class 1259 OID 17177)
-- Dependencies: 1789
-- Name: idx_msdep_msgdep; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_msdep_msgdep ON sgd_msdep_msgdep USING btree (sgd_msdep_codi);


--
-- TOC entry 2400 (class 1259 OID 17161)
-- Dependencies: 1788
-- Name: idx_msg_mensaje; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_msg_mensaje ON sgd_msg_mensaje USING btree (sgd_msg_codi);


--
-- TOC entry 2406 (class 1259 OID 17193)
-- Dependencies: 1790
-- Name: idx_mtd_matriz_doc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_mtd_matriz_doc ON sgd_mtd_matriz_doc USING btree (sgd_mtd_codigo);


--
-- TOC entry 2359 (class 1259 OID 16915)
-- Dependencies: 1776 1776 1776 1776
-- Name: idx_municipio; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_municipio ON municipio USING btree (id_cont, id_pais, dpto_codi, muni_codi);


--
-- TOC entry 2490 (class 1259 OID 17628)
-- Dependencies: 1814
-- Name: idx_oem_oempresas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_oem_oempresas ON sgd_oem_oempresas USING btree (sgd_oem_codigo);


--
-- TOC entry 2193 (class 1259 OID 16449)
-- Dependencies: 1711
-- Name: idx_par_serv_servicios; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_par_serv_servicios ON par_serv_servicios USING btree (par_serv_secue);


--
-- TOC entry 2236 (class 1259 OID 16541)
-- Dependencies: 1726 1726
-- Name: idx_parametro_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_parametro_pk ON sgd_parametro USING btree (param_nomb, param_codi);


--
-- TOC entry 2409 (class 1259 OID 17204)
-- Dependencies: 1791
-- Name: idx_parexp_paramexpediente; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_parexp_paramexpediente ON sgd_parexp_paramexpediente USING btree (sgd_parexp_codigo);


--
-- TOC entry 2335 (class 1259 OID 16828)
-- Dependencies: 1764
-- Name: idx_peranualdos; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_peranualdos ON sgd_panu_peranulados USING btree (sgd_panu_codi);


--
-- TOC entry 2412 (class 1259 OID 17218)
-- Dependencies: 1792
-- Name: idx_pexp_procexpedientes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_pexp_procexpedientes ON sgd_pexp_procexpedientes USING btree (sgd_pexp_codigo);


--
-- TOC entry 2289 (class 1259 OID 16708)
-- Dependencies: 1746
-- Name: idx_pnufe_procnumfe; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_pnufe_procnumfe ON sgd_pnufe_procnumfe USING btree (sgd_pnufe_codi);


--
-- TOC entry 2506 (class 1259 OID 17682)
-- Dependencies: 1816
-- Name: idx_pnun_procenum; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_pnun_procenum ON sgd_pnun_procenum USING btree (sgd_pnun_codi);


--
-- TOC entry 2239 (class 1259 OID 16547)
-- Dependencies: 1727
-- Name: idx_prc_proceso; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_prc_proceso ON sgd_prc_proceso USING btree (sgd_prc_codigo);


--
-- TOC entry 2292 (class 1259 OID 16714)
-- Dependencies: 1747
-- Name: idx_prd_prcdmentos; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_prd_prcdmentos ON sgd_prd_prcdmentos USING btree (sgd_prd_codigo);


--
-- TOC entry 2455 (class 1259 OID 17455)
-- Dependencies: 1803
-- Name: idx_prestamo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_prestamo ON prestamo USING btree (pres_id);


--
-- TOC entry 2431 (class 1259 OID 17353)
-- Dependencies: 1798
-- Name: idx_radi_eesp; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_radi_eesp ON radicado USING btree (eesp_codi);


--
-- TOC entry 2454 (class 1259 OID 17423)
-- Dependencies: 1802
-- Name: idx_radicado; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_radicado ON informados USING btree (radi_nume_radi);


--
-- TOC entry 2432 (class 1259 OID 17354)
-- Dependencies: 1798 1798 1798 1798
-- Name: idx_radicado_inter; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_radicado_inter ON radicado USING btree (muni_codi, dpto_codi, id_cont, id_pais);


--
-- TOC entry 2415 (class 1259 OID 17232)
-- Dependencies: 1793 1793 1793
-- Name: idx_rdf_retdocf; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_rdf_retdocf ON sgd_rdf_retdocf USING btree (sgd_mrd_codigo, radi_nume_radi, depe_codi);


--
-- TOC entry 2242 (class 1259 OID 16551)
-- Dependencies: 1728
-- Name: idx_rfax_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_rfax_codigo ON sgd_rfax_reservafax USING btree (sgd_rfax_codigo);


--
-- TOC entry 2243 (class 1259 OID 16552)
-- Dependencies: 1728
-- Name: idx_rfax_fax; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_rfax_fax ON sgd_rfax_reservafax USING btree (sgd_rfax_fax);


--
-- TOC entry 2244 (class 1259 OID 16553)
-- Dependencies: 1728
-- Name: idx_rfax_fech; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_rfax_fech ON sgd_rfax_reservafax USING btree (sgd_rfax_fech);


--
-- TOC entry 2245 (class 1259 OID 16554)
-- Dependencies: 1728
-- Name: idx_rfax_radi_nume_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_rfax_radi_nume_radi ON sgd_rfax_reservafax USING btree (radi_nume_radi);


--
-- TOC entry 2332 (class 1259 OID 16819)
-- Dependencies: 1762 1762
-- Name: idx_rmr_radmasivre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_rmr_radmasivre ON sgd_rmr_radmasivre USING btree (sgd_rmr_grupo, sgd_rmr_radi);


--
-- TOC entry 2295 (class 1259 OID 16725)
-- Dependencies: 1748 1748
-- Name: idx_sbrd_subserierd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sbrd_subserierd ON sgd_sbrd_subserierd USING btree (sgd_srd_codigo, sgd_sbrd_codigo);


--
-- TOC entry 2329 (class 1259 OID 16809)
-- Dependencies: 1760
-- Name: idx_senuf_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_senuf_codi ON sgd_senuf_secnumfe USING btree (sgd_senuf_codi);


--
-- TOC entry 2197 (class 1259 OID 16455)
-- Dependencies: 1712 1712 1712
-- Name: idx_series; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_series ON series USING btree (depe_codi, seri_tipo, seri_ano);


--
-- TOC entry 2416 (class 1259 OID 17243)
-- Dependencies: 1794
-- Name: idx_sexp_secexpedientes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sexp_secexpedientes ON sgd_sexp_secexpedientes USING btree (sgd_exp_numero);


--
-- TOC entry 2458 (class 1259 OID 17466)
-- Dependencies: 1804 1804
-- Name: idx_sgd_acm_acusemsg; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_acm_acusemsg ON sgd_acm_acusemsg USING btree (sgd_msg_codi, usua_doc);


--
-- TOC entry 2206 (class 1259 OID 16477)
-- Dependencies: 1716
-- Name: idx_sgd_apli_aplintegra; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_apli_aplintegra ON sgd_apli_aplintegra USING btree (sgd_apli_codi);


--
-- TOC entry 2275 (class 1259 OID 16651)
-- Dependencies: 1740
-- Name: idx_sgd_aplus_plicusua; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_aplus_plicusua ON sgd_aplus_plicusua USING btree (sgd_aplus_codi);


--
-- TOC entry 2209 (class 1259 OID 16483)
-- Dependencies: 1717
-- Name: idx_sgd_argd_argdoc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_argd_argdoc ON sgd_argd_argdoc USING btree (sgd_argd_codi);


--
-- TOC entry 2318 (class 1259 OID 16784)
-- Dependencies: 1756
-- Name: idx_sgd_argup_argudoctop; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_argup_argudoctop ON sgd_argup_argudoctop USING btree (sgd_argup_codi);


--
-- TOC entry 2422 (class 1259 OID 17258)
-- Dependencies: 1795
-- Name: idx_sgd_camexp_campoexpediente; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_camexp_campoexpediente ON sgd_camexp_campoexpediente USING btree (sgd_camexp_codigo);


--
-- TOC entry 2212 (class 1259 OID 16489)
-- Dependencies: 1718
-- Name: idx_sgd_cau_causal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_cau_causal ON sgd_cau_causal USING btree (sgd_cau_codigo);


--
-- TOC entry 2464 (class 1259 OID 17527)
-- Dependencies: 1808
-- Name: idx_sgd_caux_causales; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_caux_causales ON sgd_caux_causales USING btree (sgd_caux_codigo);


--
-- TOC entry 2387 (class 1259 OID 17091)
-- Dependencies: 1785
-- Name: idx_sgd_ciu_ciudadano; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_ciu_ciudadano ON sgd_ciu_ciudadano USING btree (sgd_ciu_codigo);


--
-- TOC entry 2315 (class 1259 OID 16778)
-- Dependencies: 1755
-- Name: idx_sgd_cob_campobliga; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_cob_campobliga ON sgd_cob_campobliga USING btree (sgd_cob_codi);


--
-- TOC entry 2278 (class 1259 OID 16662)
-- Dependencies: 1741
-- Name: idx_sgd_dcau_causal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_dcau_causal ON sgd_dcau_causal USING btree (sgd_dcau_codigo);


--
-- TOC entry 2283 (class 1259 OID 16686)
-- Dependencies: 1744
-- Name: idx_sgd_deve; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_deve ON sgd_deve_dev_envio USING btree (sgd_deve_codigo);


--
-- TOC entry 2497 (class 1259 OID 17658)
-- Dependencies: 1815
-- Name: idx_sgd_dir; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_dir ON sgd_dir_drecciones USING btree (sgd_dir_codigo);


--
-- TOC entry 2498 (class 1259 OID 17666)
-- Dependencies: 1815
-- Name: idx_sgd_dir_doc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_dir_doc ON sgd_dir_drecciones USING btree (sgd_dir_doc);


--
-- TOC entry 2499 (class 1259 OID 17663)
-- Dependencies: 1815
-- Name: idx_sgd_dir_nombre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_dir_nombre ON sgd_dir_drecciones USING btree (sgd_dir_nombre);


--
-- TOC entry 2500 (class 1259 OID 17665)
-- Dependencies: 1815
-- Name: idx_sgd_dir_nomremdes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_dir_nomremdes ON sgd_dir_drecciones USING btree (sgd_dir_nomremdes);


--
-- TOC entry 2501 (class 1259 OID 17660)
-- Dependencies: 1815
-- Name: idx_sgd_dir_oem_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_dir_oem_codigo ON sgd_dir_drecciones USING btree (sgd_oem_codigo);


--
-- TOC entry 2502 (class 1259 OID 17664)
-- Dependencies: 1815
-- Name: idx_sgd_doc_fun; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_doc_fun ON sgd_dir_drecciones USING btree (sgd_doc_fun);


--
-- TOC entry 2326 (class 1259 OID 16803)
-- Dependencies: 1759
-- Name: idx_sgd_fenv; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_fenv ON sgd_fenv_frmenvio USING btree (sgd_fenv_codigo);


--
-- TOC entry 2233 (class 1259 OID 16535)
-- Dependencies: 1725
-- Name: idx_sgd_not; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_not ON sgd_not_notificacion USING btree (sgd_not_codi);


--
-- TOC entry 2246 (class 1259 OID 16563)
-- Dependencies: 1729
-- Name: idx_sgd_san_sancionados; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_sgd_san_sancionados ON sgd_san_sancionados USING btree (sgd_san_ref);


--
-- TOC entry 2249 (class 1259 OID 16570)
-- Dependencies: 1730
-- Name: idx_srd_descrip; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_srd_descrip ON sgd_srd_seriesrd USING btree (sgd_srd_descrip);


--
-- TOC entry 2250 (class 1259 OID 16569)
-- Dependencies: 1730
-- Name: idx_srd_seriesrd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_srd_seriesrd ON sgd_srd_seriesrd USING btree (sgd_srd_codigo);


--
-- TOC entry 2298 (class 1259 OID 16736)
-- Dependencies: 1749
-- Name: idx_tdec_tipodecision; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tdec_tipodecision ON sgd_tdec_tipodecision USING btree (sgd_tdec_codigo);


--
-- TOC entry 2312 (class 1259 OID 16767)
-- Dependencies: 1754
-- Name: idx_tdm_tidomasiva; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tdm_tidomasiva ON sgd_tidm_tidocmasiva USING btree (sgd_tidm_codi);


--
-- TOC entry 2301 (class 1259 OID 16742)
-- Dependencies: 1750
-- Name: idx_tid_tipdecision; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tid_tipdecision ON sgd_tid_tipdecision USING btree (sgd_tid_codi);


--
-- TOC entry 2260 (class 1259 OID 16596)
-- Dependencies: 1735
-- Name: idx_tipo_doc_identificacion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tipo_doc_identificacion ON tipo_doc_identificacion USING btree (tdid_codi);


--
-- TOC entry 2263 (class 1259 OID 16602)
-- Dependencies: 1736
-- Name: idx_tipo_remitente; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tipo_remitente ON tipo_remitente USING btree (trte_codi);


--
-- TOC entry 2452 (class 1259 OID 17408)
-- Dependencies: 1801
-- Name: idx_tipotrans; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_tipotrans ON hist_eventos USING btree (sgd_ttr_codigo);


--
-- TOC entry 2428 (class 1259 OID 17280)
-- Dependencies: 1797
-- Name: idx_tma_temas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tma_temas ON sgd_tma_temas USING btree (sgd_tma_codigo);


--
-- TOC entry 2514 (class 1259 OID 17730)
-- Dependencies: 1818
-- Name: idx_tmd_temadepe; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tmd_temadepe ON sgd_tmd_temadepe USING btree (id);


--
-- TOC entry 2253 (class 1259 OID 16576)
-- Dependencies: 1731
-- Name: idx_tme_tipmen; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tme_tipmen ON sgd_tme_tipmen USING btree (sgd_tme_codi);


--
-- TOC entry 2304 (class 1259 OID 16750)
-- Dependencies: 1751
-- Name: idx_tpr_tpdcumento; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tpr_tpdcumento ON sgd_tpr_tpdcumento USING btree (sgd_tpr_codigo);


--
-- TOC entry 2256 (class 1259 OID 16583)
-- Dependencies: 1732
-- Name: idx_trad_tiporad_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_trad_tiporad_codigo ON sgd_trad_tiporad USING btree (sgd_trad_codigo);


--
-- TOC entry 2338 (class 1259 OID 16834)
-- Dependencies: 1765
-- Name: idx_tres_tpresolucion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_tres_tpresolucion ON sgd_tres_tpresolucion USING btree (sgd_tres_codigo);


--
-- TOC entry 2343 (class 1259 OID 16847)
-- Dependencies: 1767
-- Name: idx_ttr_transaccion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_ttr_transaccion ON sgd_ttr_transaccion USING btree (sgd_ttr_codigo);


--
-- TOC entry 2311 (class 1259 OID 16761)
-- Dependencies: 1753
-- Name: idx_ubicacion_fisica; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_ubicacion_fisica ON ubicacion_fisica USING btree (ubic_inv_piso);


--
-- TOC entry 2259 (class 1259 OID 16590)
-- Dependencies: 1734
-- Name: idx_usm_modcod; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_usm_modcod ON sgd_usm_usumodifica USING btree (sgd_usm_modcod);


--
-- TOC entry 2372 (class 1259 OID 17001)
-- Dependencies: 1780
-- Name: idx_usua_doc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_usua_doc ON usuario USING btree (usua_doc);


--
-- TOC entry 2373 (class 1259 OID 17000)
-- Dependencies: 1780
-- Name: idx_usua_login; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_usua_login ON usuario USING btree (usua_login);


--
-- TOC entry 2374 (class 1259 OID 16999)
-- Dependencies: 1780 1780
-- Name: idx_usuario; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX idx_usuario ON usuario USING btree (usua_codi, depe_codi);


--
-- TOC entry 2480 (class 1259 OID 17544)
-- Dependencies: 1809
-- Name: ind_exp_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_exp_radi ON sgd_exp_expediente USING btree (radi_nume_radi);


--
-- TOC entry 2433 (class 1259 OID 17355)
-- Dependencies: 1798
-- Name: ind_radicado_radi_path; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radicado_radi_path ON radicado USING btree (radi_path);


--
-- TOC entry 2509 (class 1259 OID 17710)
-- Dependencies: 1817
-- Name: ind_renv_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_codigo ON sgd_renv_regenvio USING btree (sgd_renv_codigo);


--
-- TOC entry 2510 (class 1259 OID 17712)
-- Dependencies: 1817
-- Name: ind_renv_fech; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_fech ON sgd_renv_regenvio USING btree (sgd_renv_fech);


--
-- TOC entry 2511 (class 1259 OID 17713)
-- Dependencies: 1817
-- Name: ind_renv_fech_sal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_fech_sal ON sgd_renv_regenvio USING btree (sgd_renv_fech_sal);


--
-- TOC entry 2512 (class 1259 OID 17714)
-- Dependencies: 1817
-- Name: ind_renv_grupo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_grupo ON sgd_renv_regenvio USING btree (sgd_renv_grupo);


--
-- TOC entry 2513 (class 1259 OID 17711)
-- Dependencies: 1817 1817 1817
-- Name: ind_renv_radi_sal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_radi_sal ON sgd_renv_regenvio USING btree (sgd_fenv_codigo, radi_nume_sal, depe_codi);


--
-- TOC entry 2305 (class 1259 OID 16751)
-- Dependencies: 1751
-- Name: ind_tpr_tpdocdescrp; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_tpr_tpdocdescrp ON sgd_tpr_tpdcumento USING btree (sgd_tpr_descrip);


--
-- TOC entry 2434 (class 1259 OID 17357)
-- Dependencies: 1798
-- Name: radicado_dependencia; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radicado_dependencia ON radicado USING btree (radi_cuentai);


--
-- TOC entry 2435 (class 1259 OID 17867)
-- Dependencies: 1798 1798 1798
-- Name: radicado_idx_001; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX radicado_idx_001 ON radicado USING btree (radi_nume_radi, tdoc_codi, codi_nivel);


--
-- TOC entry 2436 (class 1259 OID 17356)
-- Dependencies: 1798 1798
-- Name: radicado_idx_003; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radicado_idx_003 ON radicado USING btree (radi_depe_radi, sgd_eanu_codigo);


--
-- TOC entry 2437 (class 1259 OID 17352)
-- Dependencies: 1798 1798 1798 1798 1798
-- Name: radicado_orden; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX radicado_orden ON radicado USING btree (radi_fech_radi, carp_codi, radi_usua_actu, radi_depe_actu, radi_fech_asig);


--
-- TOC entry 2182 (class 1259 OID 16425)
-- Dependencies: 1707
-- Name: sgd_bodega_are_esp_secue; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_are_esp_secue ON bodega_empresas USING btree (are_esp_secue);


--
-- TOC entry 2183 (class 1259 OID 16423)
-- Dependencies: 1707
-- Name: sgd_bodega_rep_legal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_rep_legal ON bodega_empresas USING btree (cargo_rep_legal);


--
-- TOC entry 2388 (class 1259 OID 17092)
-- Dependencies: 1785 1785 1785
-- Name: sgd_buscar_nombre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_buscar_nombre ON sgd_ciu_ciudadano USING btree (sgd_ciu_nombre, sgd_ciu_apell1, sgd_ciu_apell2);


--
-- TOC entry 2491 (class 1259 OID 17630)
-- Dependencies: 1814
-- Name: sgd_busq_nit; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_busq_nit ON sgd_oem_oempresas USING btree (sgd_oem_nit);


--
-- TOC entry 2391 (class 1259 OID 17093)
-- Dependencies: 1785 1785 1785
-- Name: sgd_ciu_inte; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_ciu_inte ON sgd_ciu_ciudadano USING btree (muni_codi, dpto_codi, id_cont);


--
-- TOC entry 2503 (class 1259 OID 17659)
-- Dependencies: 1815 1815 1815
-- Name: sgd_dir_drecciones_idx_001; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_dir_drecciones_idx_001 ON sgd_dir_drecciones USING btree (sgd_dir_tipo, radi_nume_radi, sgd_esp_codi);


--
-- TOC entry 2227 (class 1259 OID 16523)
-- Dependencies: 1723
-- Name: sgd_masiva_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sgd_masiva_codigo ON sgd_masiva_excel USING btree (sgd_masiva_codigo);


--
-- TOC entry 2417 (class 1259 OID 17246)
-- Dependencies: 1794
-- Name: sgd_sexp_proc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_sexp_proc ON sgd_sexp_secexpedientes USING btree (sgd_fexp_codigo);


--
-- TOC entry 2418 (class 1259 OID 17245)
-- Dependencies: 1794
-- Name: sgd_sexp_sbrd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_sexp_sbrd ON sgd_sexp_secexpedientes USING btree (sgd_sbrd_codigo);


--
-- TOC entry 2421 (class 1259 OID 17244)
-- Dependencies: 1794
-- Name: sgd_sexp_srd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_sexp_srd ON sgd_sexp_secexpedientes USING btree (sgd_srd_codigo);


--
-- TOC entry 2494 (class 1259 OID 17629)
-- Dependencies: 1814 1814
-- Name: sqg_busq_empresa; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sqg_busq_empresa ON sgd_oem_oempresas USING btree (sgd_oem_oempresa, sgd_oem_sigla);


--
-- TOC entry 2271 (class 1259 OID 16629)
-- Dependencies: 1738
-- Name: sys_c005036; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sys_c005036 ON sgd_aplfad_plicfunadi USING btree (sgd_aplfad_codi);


--
-- TOC entry 2274 (class 1259 OID 16640)
-- Dependencies: 1739
-- Name: sys_c005038; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sys_c005038 ON sgd_aplmen_aplimens USING btree (sgd_aplmen_codi);


--
-- TOC entry 2288 (class 1259 OID 16702)
-- Dependencies: 1745
-- Name: sys_c005088; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sys_c005088 ON sgd_estinst_estadoinstancia USING btree (sgd_estinst_codi);


--
-- TOC entry 2323 (class 1259 OID 16790)
-- Dependencies: 1757
-- Name: sys_c005196; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sys_c005196 ON sgd_sed_sede USING btree (sgd_sed_codi);


--
-- TOC entry 2587 (class 2606 OID 17367)
-- Dependencies: 2375 1780 1799
-- Name: anexos_anex_creador_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anexos
    ADD CONSTRAINT anexos_anex_creador_fkey FOREIGN KEY (anex_creador) REFERENCES usuario(usua_login);


--
-- TOC entry 2589 (class 2606 OID 17383)
-- Dependencies: 1800 1799 2441
-- Name: anexos_historico_anex_hist_anex_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anexos_historico
    ADD CONSTRAINT anexos_historico_anex_hist_anex_codi_fkey FOREIGN KEY (anex_hist_anex_codi) REFERENCES anexos(anex_codigo);


--
-- TOC entry 2588 (class 2606 OID 17388)
-- Dependencies: 2375 1800 1780
-- Name: anexos_historico_anex_hist_usua_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY anexos_historico
    ADD CONSTRAINT anexos_historico_anex_hist_usua_fkey FOREIGN KEY (anex_hist_usua) REFERENCES usuario(usua_login);


--
-- TOC entry 2538 (class 2606 OID 16940)
-- Dependencies: 2362 1777 1778
-- Name: carpeta_per_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY carpeta_per
    ADD CONSTRAINT carpeta_per_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2534 (class 2606 OID 16899)
-- Dependencies: 1774 1775 1774 1775 2355
-- Name: departamento_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT departamento_id_cont_fkey FOREIGN KEY (id_cont, id_pais) REFERENCES sgd_def_paises(id_cont, id_pais);


--
-- TOC entry 2536 (class 2606 OID 16929)
-- Dependencies: 1777 2362 1777
-- Name: dependencia_depe_codi_padre_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT dependencia_depe_codi_padre_fkey FOREIGN KEY (depe_codi_padre) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2537 (class 2606 OID 16924)
-- Dependencies: 1777 2360 1776 1776 1776 1776 1777 1777 1777
-- Name: dependencia_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dependencia
    ADD CONSTRAINT dependencia_id_cont_fkey FOREIGN KEY (id_cont, id_pais, dpto_codi, muni_codi) REFERENCES municipio(id_cont, id_pais, dpto_codi, muni_codi);


--
-- TOC entry 2539 (class 2606 OID 16957)
-- Dependencies: 2362 1777 1779
-- Name: dependencia_visibilidad_dependencia_observa_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dependencia_visibilidad
    ADD CONSTRAINT dependencia_visibilidad_dependencia_observa_fkey FOREIGN KEY (dependencia_observa) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2540 (class 2606 OID 16952)
-- Dependencies: 1779 2362 1777
-- Name: dependencia_visibilidad_dependencia_visible_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY dependencia_visibilidad
    ADD CONSTRAINT dependencia_visibilidad_dependencia_visible_fkey FOREIGN KEY (dependencia_visible) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2591 (class 2606 OID 17397)
-- Dependencies: 1801 1777 2362
-- Name: hist_eventos_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY hist_eventos
    ADD CONSTRAINT hist_eventos_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2590 (class 2606 OID 17870)
-- Dependencies: 1801 1798 2438
-- Name: hist_eventos_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY hist_eventos
    ADD CONSTRAINT hist_eventos_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2593 (class 2606 OID 17413)
-- Dependencies: 1777 2362 1802
-- Name: informados_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY informados
    ADD CONSTRAINT informados_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2592 (class 2606 OID 17875)
-- Dependencies: 1798 1802 2438
-- Name: informados_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY informados
    ADD CONSTRAINT informados_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2535 (class 2606 OID 16910)
-- Dependencies: 1776 1776 1776 1775 1775 1775 2357
-- Name: municipio_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT municipio_id_cont_fkey FOREIGN KEY (id_cont, id_pais, dpto_codi) REFERENCES departamento(id_cont, id_pais, dpto_codi);


--
-- TOC entry 2598 (class 2606 OID 17430)
-- Dependencies: 1803 1777 2362
-- Name: prestamo_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT prestamo_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2597 (class 2606 OID 17435)
-- Dependencies: 1777 2362 1803
-- Name: prestamo_pres_depe_arch_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT prestamo_pres_depe_arch_fkey FOREIGN KEY (pres_depe_arch) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2594 (class 2606 OID 17880)
-- Dependencies: 1803 2438 1798
-- Name: prestamo_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT prestamo_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2595 (class 2606 OID 17450)
-- Dependencies: 1803 2375 1780
-- Name: prestamo_usua_login_actu_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT prestamo_usua_login_actu_fkey FOREIGN KEY (usua_login_actu) REFERENCES usuario(usua_login);


--
-- TOC entry 2596 (class 2606 OID 17445)
-- Dependencies: 1803 2375 1780
-- Name: prestamo_usua_login_pres_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY prestamo
    ADD CONSTRAINT prestamo_usua_login_pres_fkey FOREIGN KEY (usua_login_pres) REFERENCES usuario(usua_login);


--
-- TOC entry 2581 (class 2606 OID 17321)
-- Dependencies: 2187 1798 1709
-- Name: radicado_esta_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_esta_codi_fkey FOREIGN KEY (esta_codi) REFERENCES estado(esta_codi);


--
-- TOC entry 2586 (class 2606 OID 17296)
-- Dependencies: 1776 1798 1798 1776 2360 1776 1776 1798 1798
-- Name: radicado_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_id_cont_fkey FOREIGN KEY (id_cont, id_pais, dpto_codi, muni_codi) REFERENCES municipio(id_cont, id_pais, dpto_codi, muni_codi);


--
-- TOC entry 2582 (class 2606 OID 17316)
-- Dependencies: 1798 1710 2191
-- Name: radicado_mrec_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_mrec_codi_fkey FOREIGN KEY (mrec_codi) REFERENCES medio_recepcion(mrec_codi);


--
-- TOC entry 2577 (class 2606 OID 17341)
-- Dependencies: 1798 2194 1711
-- Name: radicado_par_serv_secue_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_par_serv_secue_fkey FOREIGN KEY (par_serv_secue) REFERENCES par_serv_servicios(par_serv_secue);


--
-- TOC entry 2576 (class 2606 OID 17346)
-- Dependencies: 1798 1716 2207
-- Name: radicado_sgd_apli_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_sgd_apli_codi_fkey FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi);


--
-- TOC entry 2578 (class 2606 OID 17336)
-- Dependencies: 1798 2407 1790
-- Name: radicado_sgd_mtd_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_sgd_mtd_codigo_fkey FOREIGN KEY (sgd_mtd_codigo) REFERENCES sgd_mtd_matriz_doc(sgd_mtd_codigo);


--
-- TOC entry 2585 (class 2606 OID 17301)
-- Dependencies: 1798 1725 2234
-- Name: radicado_sgd_not_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_sgd_not_codi_fkey FOREIGN KEY (sgd_not_codi) REFERENCES sgd_not_notificacion(sgd_not_codi);


--
-- TOC entry 2580 (class 2606 OID 17326)
-- Dependencies: 2299 1749 1798
-- Name: radicado_sgd_tdec_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_sgd_tdec_codigo_fkey FOREIGN KEY (sgd_tdec_codigo) REFERENCES sgd_tdec_tipodecision(sgd_tdec_codigo);


--
-- TOC entry 2579 (class 2606 OID 17331)
-- Dependencies: 1798 2429 1797
-- Name: radicado_sgd_tma_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_sgd_tma_codigo_fkey FOREIGN KEY (sgd_tma_codigo) REFERENCES sgd_tma_temas(sgd_tma_codigo);


--
-- TOC entry 2583 (class 2606 OID 17311)
-- Dependencies: 1798 1735 2261
-- Name: radicado_tdid_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_tdid_codi_fkey FOREIGN KEY (tdid_codi) REFERENCES tipo_doc_identificacion(tdid_codi);


--
-- TOC entry 2584 (class 2606 OID 17306)
-- Dependencies: 1736 1798 2264
-- Name: radicado_trte_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT radicado_trte_codi_fkey FOREIGN KEY (trte_codi) REFERENCES tipo_remitente(trte_codi);


--
-- TOC entry 2599 (class 2606 OID 17461)
-- Dependencies: 1788 1804 2401
-- Name: sgd_acm_acusemsg_sgd_msg_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_acm_acusemsg
    ADD CONSTRAINT sgd_acm_acusemsg_sgd_msg_codi_fkey FOREIGN KEY (sgd_msg_codi) REFERENCES sgd_msg_mensaje(sgd_msg_codi);


--
-- TOC entry 2520 (class 2606 OID 16608)
-- Dependencies: 1716 1737 2207
-- Name: sgd_actadd_actualiadicional_sgd_apli_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_actadd_actualiadicional
    ADD CONSTRAINT sgd_actadd_actualiadicional_sgd_apli_codi_fkey FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi);


--
-- TOC entry 2519 (class 2606 OID 16613)
-- Dependencies: 2225 1722 1737
-- Name: sgd_actadd_actualiadicional_sgd_instorf_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_actadd_actualiadicional
    ADD CONSTRAINT sgd_actadd_actualiadicional_sgd_instorf_codi_fkey FOREIGN KEY (sgd_instorf_codi) REFERENCES sgd_instorf_instanciasorfeo(sgd_instorf_codi);


--
-- TOC entry 2543 (class 2606 OID 17007)
-- Dependencies: 1777 2362 1781
-- Name: sgd_admin_depe_historico_dependencia_modificada_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_admin_depe_historico
    ADD CONSTRAINT sgd_admin_depe_historico_dependencia_modificada_fkey FOREIGN KEY (dependencia_modificada) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2544 (class 2606 OID 17027)
-- Dependencies: 1782 2202 1714
-- Name: sgd_admin_usua_historico_admin_observacion_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_admin_usua_historico
    ADD CONSTRAINT sgd_admin_usua_historico_admin_observacion_codigo_fkey FOREIGN KEY (admin_observacion_codigo) REFERENCES sgd_admin_observacion(codigo_observacion);


--
-- TOC entry 2546 (class 2606 OID 17017)
-- Dependencies: 1782 1777 2362
-- Name: sgd_admin_usua_historico_dependencia_codigo_administrador_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_admin_usua_historico
    ADD CONSTRAINT sgd_admin_usua_historico_dependencia_codigo_administrador_fkey FOREIGN KEY (dependencia_codigo_administrador) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2545 (class 2606 OID 17022)
-- Dependencies: 1782 2362 1777
-- Name: sgd_admin_usua_historico_dependencia_codigo_modificado_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_admin_usua_historico
    ADD CONSTRAINT sgd_admin_usua_historico_dependencia_codigo_modificado_fkey FOREIGN KEY (dependencia_codigo_modificado) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2600 (class 2606 OID 17885)
-- Dependencies: 1805 2438 1798
-- Name: sgd_agen_agendados_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_agen_agendados
    ADD CONSTRAINT sgd_agen_agendados_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2602 (class 2606 OID 17483)
-- Dependencies: 1806 2441 1799
-- Name: sgd_anar_anexarg_anex_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_anar_anexarg
    ADD CONSTRAINT sgd_anar_anexarg_anex_codigo_fkey FOREIGN KEY (anex_codigo) REFERENCES anexos(anex_codigo);


--
-- TOC entry 2601 (class 2606 OID 17488)
-- Dependencies: 1717 2210 1806
-- Name: sgd_anar_anexarg_sgd_argd_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_anar_anexarg
    ADD CONSTRAINT sgd_anar_anexarg_sgd_argd_codi_fkey FOREIGN KEY (sgd_argd_codi) REFERENCES sgd_argd_argdoc(sgd_argd_codi);


--
-- TOC entry 2603 (class 2606 OID 17890)
-- Dependencies: 2438 1807 1798
-- Name: sgd_anu_anulados_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_anu_anulados
    ADD CONSTRAINT sgd_anu_anulados_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2604 (class 2606 OID 17502)
-- Dependencies: 1807 1771 2349
-- Name: sgd_anu_anulados_sgd_eanu_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_anu_anulados
    ADD CONSTRAINT sgd_anu_anulados_sgd_eanu_codi_fkey FOREIGN KEY (sgd_eanu_codi) REFERENCES sgd_eanu_estanulacion(sgd_eanu_codi);


--
-- TOC entry 2521 (class 2606 OID 16624)
-- Dependencies: 1738 2207 1716
-- Name: sgd_aplfad_plicfunadi_sgd_apli_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_aplfad_plicfunadi
    ADD CONSTRAINT sgd_aplfad_plicfunadi_sgd_apli_codi_fkey FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi);


--
-- TOC entry 2522 (class 2606 OID 16635)
-- Dependencies: 2207 1716 1739
-- Name: sgd_aplmen_aplimens_sgd_apli_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_aplmen_aplimens
    ADD CONSTRAINT sgd_aplmen_aplimens_sgd_apli_codi_fkey FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi);


--
-- TOC entry 2523 (class 2606 OID 16646)
-- Dependencies: 1740 2207 1716
-- Name: sgd_aplus_plicusua_sgd_apli_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_aplus_plicusua
    ADD CONSTRAINT sgd_aplus_plicusua_sgd_apli_codi_fkey FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi);


--
-- TOC entry 2573 (class 2606 OID 17253)
-- Dependencies: 1791 1795 2410
-- Name: sgd_camexp_campoexpediente_sgd_parexp_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_camexp_campoexpediente
    ADD CONSTRAINT sgd_camexp_campoexpediente_sgd_parexp_codigo_fkey FOREIGN KEY (sgd_parexp_codigo) REFERENCES sgd_parexp_paramexpediente(sgd_parexp_codigo);


--
-- TOC entry 2548 (class 2606 OID 17037)
-- Dependencies: 1783 2362 1777
-- Name: sgd_carp_descripcion_sgd_carp_depecodi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_carp_descripcion
    ADD CONSTRAINT sgd_carp_descripcion_sgd_carp_depecodi_fkey FOREIGN KEY (sgd_carp_depecodi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2547 (class 2606 OID 17042)
-- Dependencies: 2257 1732 1783
-- Name: sgd_carp_descripcion_sgd_carp_tiporad_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_carp_descripcion
    ADD CONSTRAINT sgd_carp_descripcion_sgd_carp_tiporad_fkey FOREIGN KEY (sgd_carp_tiporad) REFERENCES sgd_trad_tiporad(sgd_trad_codigo);


--
-- TOC entry 2605 (class 2606 OID 17895)
-- Dependencies: 2438 1808 1798
-- Name: sgd_caux_causales_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_caux_causales
    ADD CONSTRAINT sgd_caux_causales_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2607 (class 2606 OID 17512)
-- Dependencies: 2279 1741 1808
-- Name: sgd_caux_causales_sgd_dcau_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_caux_causales
    ADD CONSTRAINT sgd_caux_causales_sgd_dcau_codigo_fkey FOREIGN KEY (sgd_dcau_codigo) REFERENCES sgd_dcau_causal(sgd_dcau_codigo);


--
-- TOC entry 2606 (class 2606 OID 17522)
-- Dependencies: 1808 1742 2281
-- Name: sgd_caux_causales_sgd_ddca_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_caux_causales
    ADD CONSTRAINT sgd_caux_causales_sgd_ddca_codigo_fkey FOREIGN KEY (sgd_ddca_codigo) REFERENCES sgd_ddca_ddsgrgdo(sgd_ddca_codigo);


--
-- TOC entry 2554 (class 2606 OID 17081)
-- Dependencies: 1785 1785 1785 1785 1776 1776 1776 1776 2360
-- Name: sgd_ciu_ciudadano_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ciu_ciudadano
    ADD CONSTRAINT sgd_ciu_ciudadano_id_cont_fkey FOREIGN KEY (id_cont, id_pais, dpto_codi, muni_codi) REFERENCES municipio(id_cont, id_pais, dpto_codi, muni_codi);


--
-- TOC entry 2553 (class 2606 OID 17086)
-- Dependencies: 2261 1735 1785
-- Name: sgd_ciu_ciudadano_tdid_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ciu_ciudadano
    ADD CONSTRAINT sgd_ciu_ciudadano_tdid_codi_fkey FOREIGN KEY (tdid_codi) REFERENCES tipo_doc_identificacion(tdid_codi);


--
-- TOC entry 2531 (class 2606 OID 16773)
-- Dependencies: 1754 2313 1755
-- Name: sgd_cob_campobliga_sgd_tidm_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_cob_campobliga
    ADD CONSTRAINT sgd_cob_campobliga_sgd_tidm_codi_fkey FOREIGN KEY (sgd_tidm_codi) REFERENCES sgd_tidm_tidocmasiva(sgd_tidm_codi);


--
-- TOC entry 2524 (class 2606 OID 16657)
-- Dependencies: 1718 2213 1741
-- Name: sgd_dcau_causal_sgd_cau_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dcau_causal
    ADD CONSTRAINT sgd_dcau_causal_sgd_cau_codigo_fkey FOREIGN KEY (sgd_cau_codigo) REFERENCES sgd_cau_causal(sgd_cau_codigo);


--
-- TOC entry 2526 (class 2606 OID 16668)
-- Dependencies: 1711 1742 2194
-- Name: sgd_ddca_ddsgrgdo_par_serv_secue_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ddca_ddsgrgdo
    ADD CONSTRAINT sgd_ddca_ddsgrgdo_par_serv_secue_fkey FOREIGN KEY (par_serv_secue) REFERENCES par_serv_servicios(par_serv_secue);


--
-- TOC entry 2525 (class 2606 OID 16673)
-- Dependencies: 2279 1741 1742
-- Name: sgd_ddca_ddsgrgdo_sgd_dcau_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ddca_ddsgrgdo
    ADD CONSTRAINT sgd_ddca_ddsgrgdo_sgd_dcau_codigo_fkey FOREIGN KEY (sgd_dcau_codigo) REFERENCES sgd_dcau_causal(sgd_dcau_codigo);


--
-- TOC entry 2533 (class 2606 OID 16886)
-- Dependencies: 1774 2352 1773
-- Name: sgd_def_paises_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_def_paises
    ADD CONSTRAINT sgd_def_paises_id_cont_fkey FOREIGN KEY (id_cont) REFERENCES sgd_def_continentes(id_cont);


--
-- TOC entry 2619 (class 2606 OID 17653)
-- Dependencies: 1776 1815 1776 1776 1776 1815 2360 1815 1815
-- Name: sgd_dir_drecciones_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT sgd_dir_drecciones_id_cont_fkey FOREIGN KEY (id_cont, id_pais, dpto_codi, muni_codi) REFERENCES municipio(id_cont, id_pais, dpto_codi, muni_codi);


--
-- TOC entry 2618 (class 2606 OID 17920)
-- Dependencies: 1815 1798 2438
-- Name: sgd_dir_drecciones_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT sgd_dir_drecciones_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2621 (class 2606 OID 17638)
-- Dependencies: 1785 2389 1815
-- Name: sgd_dir_drecciones_sgd_ciu_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT sgd_dir_drecciones_sgd_ciu_codigo_fkey FOREIGN KEY (sgd_ciu_codigo) REFERENCES sgd_ciu_ciudadano(sgd_ciu_codigo);


--
-- TOC entry 2620 (class 2606 OID 17648)
-- Dependencies: 2492 1815 1814
-- Name: sgd_dir_drecciones_sgd_oem_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dir_drecciones
    ADD CONSTRAINT sgd_dir_drecciones_sgd_oem_codigo_fkey FOREIGN KEY (sgd_oem_codigo) REFERENCES sgd_oem_oempresas(sgd_oem_codigo);


--
-- TOC entry 2552 (class 2606 OID 17053)
-- Dependencies: 2171 1706 1784
-- Name: sgd_dnufe_docnufe_anex_tipo_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dnufe_docnufe
    ADD CONSTRAINT sgd_dnufe_docnufe_anex_tipo_codi_fkey FOREIGN KEY (anex_tipo_codi) REFERENCES anexos_tipo(anex_tipo_codi);


--
-- TOC entry 2551 (class 2606 OID 17058)
-- Dependencies: 1746 1784 2290
-- Name: sgd_dnufe_docnufe_sgd_pnufe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dnufe_docnufe
    ADD CONSTRAINT sgd_dnufe_docnufe_sgd_pnufe_codi_fkey FOREIGN KEY (sgd_pnufe_codi) REFERENCES sgd_pnufe_procnumfe(sgd_pnufe_codi);


--
-- TOC entry 2550 (class 2606 OID 17063)
-- Dependencies: 1784 2306 1751
-- Name: sgd_dnufe_docnufe_sgd_tpr_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dnufe_docnufe
    ADD CONSTRAINT sgd_dnufe_docnufe_sgd_tpr_codigo_fkey FOREIGN KEY (sgd_tpr_codigo) REFERENCES sgd_tpr_tpdcumento(sgd_tpr_codigo);


--
-- TOC entry 2549 (class 2606 OID 17068)
-- Dependencies: 1784 2264 1736
-- Name: sgd_dnufe_docnufe_trte_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_dnufe_docnufe
    ADD CONSTRAINT sgd_dnufe_docnufe_trte_codi_fkey FOREIGN KEY (trte_codi) REFERENCES tipo_remitente(trte_codi);


--
-- TOC entry 2532 (class 2606 OID 16857)
-- Dependencies: 1759 2327 1769
-- Name: sgd_enve_envioespecial_sgd_fenv_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_enve_envioespecial
    ADD CONSTRAINT sgd_enve_envioespecial_sgd_fenv_codigo_fkey FOREIGN KEY (sgd_fenv_codigo) REFERENCES sgd_fenv_frmenvio(sgd_fenv_codigo);


--
-- TOC entry 2528 (class 2606 OID 16692)
-- Dependencies: 2207 1745 1716
-- Name: sgd_estinst_estadoinstancia_sgd_apli_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_estinst_estadoinstancia
    ADD CONSTRAINT sgd_estinst_estadoinstancia_sgd_apli_codi_fkey FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi);


--
-- TOC entry 2527 (class 2606 OID 16697)
-- Dependencies: 2225 1722 1745
-- Name: sgd_estinst_estadoinstancia_sgd_instorf_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_estinst_estadoinstancia
    ADD CONSTRAINT sgd_estinst_estadoinstancia_sgd_instorf_codi_fkey FOREIGN KEY (sgd_instorf_codi) REFERENCES sgd_instorf_instanciasorfeo(sgd_instorf_codi);


--
-- TOC entry 2609 (class 2606 OID 17533)
-- Dependencies: 1809 1777 2362
-- Name: sgd_exp_expediente_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_exp_expediente
    ADD CONSTRAINT sgd_exp_expediente_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2608 (class 2606 OID 17900)
-- Dependencies: 1809 1798 2438
-- Name: sgd_exp_expediente_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_exp_expediente
    ADD CONSTRAINT sgd_exp_expediente_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2610 (class 2606 OID 17562)
-- Dependencies: 2413 1810 1792
-- Name: sgd_fars_faristas_sgd_pexp_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_fars_faristas
    ADD CONSTRAINT sgd_fars_faristas_sgd_pexp_codigo_fkey FOREIGN KEY (sgd_pexp_codigo) REFERENCES sgd_pexp_procexpedientes(sgd_pexp_codigo);


--
-- TOC entry 2574 (class 2606 OID 17264)
-- Dependencies: 2413 1792 1796
-- Name: sgd_fexp_flujoexpedientes_sgd_pexp_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_fexp_flujoexpedientes
    ADD CONSTRAINT sgd_fexp_flujoexpedientes_sgd_pexp_codigo_fkey FOREIGN KEY (sgd_pexp_codigo) REFERENCES sgd_pexp_procexpedientes(sgd_pexp_codigo);


--
-- TOC entry 2611 (class 2606 OID 17905)
-- Dependencies: 1811 1798 2438
-- Name: sgd_firrad_firmarads_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_firrad_firmarads
    ADD CONSTRAINT sgd_firrad_firmarads_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2614 (class 2606 OID 17587)
-- Dependencies: 1812 2362 1777
-- Name: sgd_hmtd_hismatdoc_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_hmtd_hismatdoc
    ADD CONSTRAINT sgd_hmtd_hismatdoc_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2612 (class 2606 OID 17910)
-- Dependencies: 2438 1812 1798
-- Name: sgd_hmtd_hismatdoc_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_hmtd_hismatdoc
    ADD CONSTRAINT sgd_hmtd_hismatdoc_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2613 (class 2606 OID 17597)
-- Dependencies: 2407 1790 1812
-- Name: sgd_hmtd_hismatdoc_sgd_mtd_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_hmtd_hismatdoc
    ADD CONSTRAINT sgd_hmtd_hismatdoc_sgd_mtd_codigo_fkey FOREIGN KEY (sgd_mtd_codigo) REFERENCES sgd_mtd_matriz_doc(sgd_mtd_codigo);


--
-- TOC entry 2558 (class 2606 OID 17102)
-- Dependencies: 1777 2362 1786
-- Name: sgd_mat_matriz_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT sgd_mat_matriz_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2557 (class 2606 OID 17107)
-- Dependencies: 1721 2222 1786
-- Name: sgd_mat_matriz_sgd_fun_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT sgd_mat_matriz_sgd_fun_codigo_fkey FOREIGN KEY (sgd_fun_codigo) REFERENCES sgd_fun_funciones(sgd_fun_codigo);


--
-- TOC entry 2556 (class 2606 OID 17112)
-- Dependencies: 1727 1786 2240
-- Name: sgd_mat_matriz_sgd_prc_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT sgd_mat_matriz_sgd_prc_codigo_fkey FOREIGN KEY (sgd_prc_codigo) REFERENCES sgd_prc_proceso(sgd_prc_codigo);


--
-- TOC entry 2555 (class 2606 OID 17117)
-- Dependencies: 1786 2293 1747
-- Name: sgd_mat_matriz_sgd_prd_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mat_matriz
    ADD CONSTRAINT sgd_mat_matriz_sgd_prd_codigo_fkey FOREIGN KEY (sgd_prd_codigo) REFERENCES sgd_prd_prcdmentos(sgd_prd_codigo);


--
-- TOC entry 2562 (class 2606 OID 17129)
-- Dependencies: 1777 1787 2362
-- Name: sgd_mrd_matrird_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT sgd_mrd_matrird_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2561 (class 2606 OID 17134)
-- Dependencies: 2251 1787 1730
-- Name: sgd_mrd_matrird_sgd_srd_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT sgd_mrd_matrird_sgd_srd_codigo_fkey FOREIGN KEY (sgd_srd_codigo) REFERENCES sgd_srd_seriesrd(sgd_srd_codigo);


--
-- TOC entry 2560 (class 2606 OID 17139)
-- Dependencies: 2296 1787 1787 1748 1748
-- Name: sgd_mrd_matrird_sgd_srd_codigo_fkey1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT sgd_mrd_matrird_sgd_srd_codigo_fkey1 FOREIGN KEY (sgd_srd_codigo, sgd_sbrd_codigo) REFERENCES sgd_sbrd_subserierd(sgd_srd_codigo, sgd_sbrd_codigo);


--
-- TOC entry 2559 (class 2606 OID 17144)
-- Dependencies: 2306 1787 1751
-- Name: sgd_mrd_matrird_sgd_tpr_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mrd_matrird
    ADD CONSTRAINT sgd_mrd_matrird_sgd_tpr_codigo_fkey FOREIGN KEY (sgd_tpr_codigo) REFERENCES sgd_tpr_tpdcumento(sgd_tpr_codigo);


--
-- TOC entry 2565 (class 2606 OID 17167)
-- Dependencies: 1777 1789 2362
-- Name: sgd_msdep_msgdep_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_msdep_msgdep
    ADD CONSTRAINT sgd_msdep_msgdep_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2564 (class 2606 OID 17172)
-- Dependencies: 2401 1789 1788
-- Name: sgd_msdep_msgdep_sgd_msg_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_msdep_msgdep
    ADD CONSTRAINT sgd_msdep_msgdep_sgd_msg_codi_fkey FOREIGN KEY (sgd_msg_codi) REFERENCES sgd_msg_mensaje(sgd_msg_codi);


--
-- TOC entry 2563 (class 2606 OID 17156)
-- Dependencies: 2254 1788 1731
-- Name: sgd_msg_mensaje_sgd_tme_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_msg_mensaje
    ADD CONSTRAINT sgd_msg_mensaje_sgd_tme_codi_fkey FOREIGN KEY (sgd_tme_codi) REFERENCES sgd_tme_tipmen(sgd_tme_codi);


--
-- TOC entry 2567 (class 2606 OID 17183)
-- Dependencies: 1786 1790 2394
-- Name: sgd_mtd_matriz_doc_sgd_mat_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mtd_matriz_doc
    ADD CONSTRAINT sgd_mtd_matriz_doc_sgd_mat_codigo_fkey FOREIGN KEY (sgd_mat_codigo) REFERENCES sgd_mat_matriz(sgd_mat_codigo);


--
-- TOC entry 2566 (class 2606 OID 17188)
-- Dependencies: 1751 2306 1790
-- Name: sgd_mtd_matriz_doc_sgd_tpr_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_mtd_matriz_doc
    ADD CONSTRAINT sgd_mtd_matriz_doc_sgd_tpr_codigo_fkey FOREIGN KEY (sgd_tpr_codigo) REFERENCES sgd_tpr_tpdcumento(sgd_tpr_codigo);


--
-- TOC entry 2615 (class 2606 OID 17915)
-- Dependencies: 2438 1813 1798
-- Name: sgd_ntrd_notifrad_radi_nume_radi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_ntrd_notifrad
    ADD CONSTRAINT sgd_ntrd_notifrad_radi_nume_radi_fkey FOREIGN KEY (radi_nume_radi) REFERENCES radicado(radi_nume_radi);


--
-- TOC entry 2617 (class 2606 OID 17618)
-- Dependencies: 1814 1814 1776 1776 2360 1776 1814 1776 1814
-- Name: sgd_oem_oempresas_id_cont_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_oem_oempresas
    ADD CONSTRAINT sgd_oem_oempresas_id_cont_fkey FOREIGN KEY (id_cont, id_pais, dpto_codi, muni_codi) REFERENCES municipio(id_cont, id_pais, dpto_codi, muni_codi);


--
-- TOC entry 2616 (class 2606 OID 17623)
-- Dependencies: 1814 1735 2261
-- Name: sgd_oem_oempresas_tdid_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_oem_oempresas
    ADD CONSTRAINT sgd_oem_oempresas_tdid_codi_fkey FOREIGN KEY (tdid_codi) REFERENCES tipo_doc_identificacion(tdid_codi);


--
-- TOC entry 2568 (class 2606 OID 17199)
-- Dependencies: 1791 2362 1777
-- Name: sgd_parexp_paramexpediente_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_parexp_paramexpediente
    ADD CONSTRAINT sgd_parexp_paramexpediente_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2569 (class 2606 OID 17213)
-- Dependencies: 2296 1748 1792 1792 1748
-- Name: sgd_pexp_procexpedientes_sgd_srd_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_pexp_procexpedientes
    ADD CONSTRAINT sgd_pexp_procexpedientes_sgd_srd_codigo_fkey FOREIGN KEY (sgd_srd_codigo, sgd_sbrd_codigo) REFERENCES sgd_sbrd_subserierd(sgd_srd_codigo, sgd_sbrd_codigo);


--
-- TOC entry 2623 (class 2606 OID 17672)
-- Dependencies: 1816 1777 2362
-- Name: sgd_pnun_procenum_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_pnun_procenum
    ADD CONSTRAINT sgd_pnun_procenum_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2622 (class 2606 OID 17677)
-- Dependencies: 1746 1816 2290
-- Name: sgd_pnun_procenum_sgd_pnufe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_pnun_procenum
    ADD CONSTRAINT sgd_pnun_procenum_sgd_pnufe_codi_fkey FOREIGN KEY (sgd_pnufe_codi) REFERENCES sgd_pnufe_procnumfe(sgd_pnufe_codi);


--
-- TOC entry 2571 (class 2606 OID 17222)
-- Dependencies: 1777 2362 1793
-- Name: sgd_rdf_retdocf_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_rdf_retdocf
    ADD CONSTRAINT sgd_rdf_retdocf_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2570 (class 2606 OID 17227)
-- Dependencies: 1787 1793 2398
-- Name: sgd_rdf_retdocf_sgd_mrd_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_rdf_retdocf
    ADD CONSTRAINT sgd_rdf_retdocf_sgd_mrd_codigo_fkey FOREIGN KEY (sgd_mrd_codigo) REFERENCES sgd_mrd_matrird(sgd_mrd_codigo);


--
-- TOC entry 2626 (class 2606 OID 17695)
-- Dependencies: 1777 2362 1817
-- Name: sgd_renv_regenvio_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_renv_regenvio
    ADD CONSTRAINT sgd_renv_regenvio_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2625 (class 2606 OID 17700)
-- Dependencies: 2284 1744 1817
-- Name: sgd_renv_regenvio_sgd_deve_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_renv_regenvio
    ADD CONSTRAINT sgd_renv_regenvio_sgd_deve_codigo_fkey FOREIGN KEY (sgd_deve_codigo) REFERENCES sgd_deve_dev_envio(sgd_deve_codigo);


--
-- TOC entry 2624 (class 2606 OID 17705)
-- Dependencies: 2504 1815 1817
-- Name: sgd_renv_regenvio_sgd_dir_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_renv_regenvio
    ADD CONSTRAINT sgd_renv_regenvio_sgd_dir_codigo_fkey FOREIGN KEY (sgd_dir_codigo) REFERENCES sgd_dir_drecciones(sgd_dir_codigo);


--
-- TOC entry 2529 (class 2606 OID 16720)
-- Dependencies: 2251 1748 1730
-- Name: sgd_sbrd_subserierd_sgd_srd_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_sbrd_subserierd
    ADD CONSTRAINT sgd_sbrd_subserierd_sgd_srd_codigo_fkey FOREIGN KEY (sgd_srd_codigo) REFERENCES sgd_srd_seriesrd(sgd_srd_codigo);


--
-- TOC entry 2572 (class 2606 OID 17238)
-- Dependencies: 2413 1794 1792
-- Name: sgd_sexp_secexpedientes_sgd_pexp_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_sexp_secexpedientes
    ADD CONSTRAINT sgd_sexp_secexpedientes_sgd_pexp_codigo_fkey FOREIGN KEY (sgd_pexp_codigo) REFERENCES sgd_pexp_procexpedientes(sgd_pexp_codigo);


--
-- TOC entry 2530 (class 2606 OID 16731)
-- Dependencies: 1716 2207 1749
-- Name: sgd_tdec_tipodecision_sgd_apli_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_tdec_tipodecision
    ADD CONSTRAINT sgd_tdec_tipodecision_sgd_apli_codi_fkey FOREIGN KEY (sgd_apli_codi) REFERENCES sgd_apli_aplintegra(sgd_apli_codi);


--
-- TOC entry 2575 (class 2606 OID 17275)
-- Dependencies: 2240 1727 1797
-- Name: sgd_tma_temas_sgd_prc_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_tma_temas
    ADD CONSTRAINT sgd_tma_temas_sgd_prc_codigo_fkey FOREIGN KEY (sgd_prc_codigo) REFERENCES sgd_prc_proceso(sgd_prc_codigo);


--
-- TOC entry 2628 (class 2606 OID 17720)
-- Dependencies: 1818 1777 2362
-- Name: sgd_tmd_temadepe_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_tmd_temadepe
    ADD CONSTRAINT sgd_tmd_temadepe_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2627 (class 2606 OID 17725)
-- Dependencies: 1797 1818 2429
-- Name: sgd_tmd_temadepe_sgd_tma_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_tmd_temadepe
    ADD CONSTRAINT sgd_tmd_temadepe_sgd_tma_codigo_fkey FOREIGN KEY (sgd_tma_codigo) REFERENCES sgd_tma_temas(sgd_tma_codigo);


--
-- TOC entry 2542 (class 2606 OID 16989)
-- Dependencies: 2362 1780 1777
-- Name: usuario_depe_codi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_depe_codi_fkey FOREIGN KEY (depe_codi) REFERENCES dependencia(depe_codi);


--
-- TOC entry 2541 (class 2606 OID 16994)
-- Dependencies: 1752 2309 1780
-- Name: usuario_sgd_aper_codigo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_sgd_aper_codigo_fkey FOREIGN KEY (sgd_aper_codigo) REFERENCES sgd_aper_adminperfiles(sgd_aper_codigo);


--
-- TOC entry 2747 (class 0 OID 0)
-- Dependencies: 3
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


-- Completed on 2009-07-03 15:45:05

--
-- PostgreSQL database dump complete
--

CREATE SEQUENCE sec_edificio
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE sec_edificio OWNER TO postgres;

CREATE SEQUENCE sec_inv
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE sec_inv OWNER TO postgres;

-- Sequence: sec_ciu_ciudadano

-- DROP SEQUENCE sec_ciu_ciudadano;

CREATE SEQUENCE sec_ciu_ciudadano
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 1
  CACHE 1;
ALTER TABLE sec_ciu_ciudadano OWNER TO postgres;

-- Sequence: sec_dir_direcciones

-- DROP SEQUENCE sec_dir_direcciones;

CREATE SEQUENCE sec_dir_direcciones
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 3
  CACHE 1;
ALTER TABLE sec_dir_direcciones OWNER TO postgres;

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
