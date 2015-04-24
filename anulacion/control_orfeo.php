

/**
 * class ANULACION
 * 
 */
class ANULACION
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/


  /**
   * Clase que maneja los documentos anulados 
   *
   * @param int dependencia Dependencia de Territorial que Anula 
   * @return void
   * @access public
   */
  function consultaAnulados( $dependencia )
  {
    
  } // end of member function consultaAnulados

  /**
   * 
   *
   * @param int radicado Numero de radicado para Anular 
   * @param int dependencia Dependencia que pide la anulacion del documento. 
   * @param int usuadoc Documento de identificación del usuario que pide la anulación 
   * @return void
   * @access public
   */
  function solicitudAnulacion( $radicado,  $dependencia,  $usuadoc )
  {
    
  } // end of member function solicitudAnulacion





} // end of ANULACION
?>



/**
 * class CONTROL_ORFEO
 * 
 */
class CONTROL_ORFEO
{

  /** Aggregations: */

  /** Compositions: */

   /*** Attributes: ***/

  /**
   * 
   * @access public
   */
  var $num_expediente;
  /**
   * 
   * @access public
   */
  var $estado_expediente;
  /**
   * 
   * @access public
   */
  var $exp_titulo;
  /**
   * 
   * @access public
   */
  var $exp_asunto;
  /**
   * 
   * @access public
   */
  var $exp_ufisica;
  /**
   * 
   * @access public
   */
  var $exp_isla;
  /**
   * 
   * @access public
   */
  var $exp_caja;
  /**
   * 
   * @access public
   */
  var $exp_estante;
  /**
   * 
   * @access public
   */
  var $exp_carpeta;
  /**
   * 
   * @access public
   */
  var $exp_num_carpetas;
  /**
   * 
   * @access public
   */
  var $campos_tabla;
  /**
   * 
   * @access public
   */
  var $campos_vista;
  /**
   * 
   * @access public
   */
  var $campos_width;
  /**
   * 
   * @access public
   */
  var $campos_align;
  /**
   * 
   * @access public
   */
  var $tabla_html;

  /**
   * 
   *
   * @param   
   * @return 
   * @access public
   */
  function CONTROL_ORFEO( $ )
  {
    
  } // end of member function CONTROL_ORFEO

  /**
   * 
   *
   * @param  return 
   * @param  radicado 
   * @return 
   * @access public
   */
  function consulta_exp( $return,  $radicado )
  {
    
  } // end of member function consulta_exp

  /**
   * 
   *
   * @param  return 
   * @param  num_expediente 
   * @param  radicado 
   * @param  depe_codi 
   * @param  usua_codi 
   * @param  usua_doc 
   * @return 
   * @access public
   */
  function insertar_expediente( $return,  $num_expediente,  $radicado,  $depe_codi,  $usua_codi,  $usua_doc )
  {
    
  } // end of member function insertar_expediente

  /**
   * 
   *
   * @param  return 
   * @param  radicado 
   * @param  num_expediente 
   * @param  exp_titulo 
   * @param  exp_asunto 
   * @param  exp_ufisica 
   * @param  exp_isla 
   * @param  arg1exp_caja 
   * @param  exp_estante 
   * @param  exp_carpeta 
   * @return 
   * @access public
   */
  function modificar_expediente( $return,  $radicado,  $num_expediente,  $exp_titulo,  $exp_asunto,  $exp_ufisica,  $exp_isla,  $arg1exp_caja,  $exp_estante,  $exp_carpeta )
  {
    
  } // end of member function modificar_expediente

  /**
   * 
   *
   * @param  return 
   * @param  radicado 
   * @param  num_expediente 
   * @return 
   * @access public
   */
  function datos_expediente( $return,  $radicado,  $num_expediente )
  {
    
  } // end of member function datos_expediente

  /**
   * 
   *
   * @param  return 
   * @param  radicado 
   * @return 
   * @access public
   */
  function consulta_envio( $return,  $radicado )
  {
    
  } // end of member function consulta_envio

  /**
   * 
   *
   * @param  return 
   * @param  tipoanexo 
   * @param  cuentai 
   * @param  documento_us3 
   * @param  med 
   * @param  fec 
   * @param  radicadopadre 
   * @param  codusuario 
   * @param  tip_doc 
   * @param  ane 
   * @param  pais 
   * @param  asu 
   * @param  coddepe 
   * @param  carp_codi 
   * @param  tip_rem 
   * @param  numdoc 
   * @param  tdoc 
   * @param  dpto_cod 
   * @param  muni_codi 
   * @param  archivo 
   * @param  usua_doc 
   * @param  depe_codi_territorial 
   * @return 
   * @access public
   */
  function radicar_salida( $return,  $tipoanexo,  $cuentai,  $documento_us3,  $med,  $fec,  $radicadopadre,  $codusuario,  $tip_doc,  $ane,  $pais,  $asu,  $coddepe,  $carp_codi,  $tip_rem,  $numdoc,  $tdoc,  $dpto_cod,  $muni_codi,  $archivo,  $usua_doc,  $depe_codi_territorial )
  {
    
  } // end of member function radicar_salida

  /**
   * 
   *
   * @param  return 
   * @param  no_documento 
   * @param  nombre_us1 
   * @param  direccion_us1 
   * @param  prim_apell_us1 
   * @param  seg_apell_us1 
   * @param  telefono_us1 
   * @param  mail_nus1 
   * @param  codep_us 
   * @param  muni_us 
   * @return 
   * @access public
   */
  function grabar_usuario( $return,  $no_documento,  $nombre_us1,  $direccion_us1,  $prim_apell_us1,  $seg_apell_us1,  $telefono_us1,  $mail_nus1,  $codep_us,  $muni_us )
  {
    
  } // end of member function grabar_usuario

  /**
   * 
   *
   * @param  return 
   * @param  no_documento 
   * @param  nombre_us 
   * @param  direccion_us1 
   * @param  prim_apell_us1 
   * @param  seg_apell_us1 
   * @param  telefono_us1 
   * @param  mail_nus1 
   * @param  codep_us 
   * @param  muni_us 
   * @return 
   * @access public
   */
  function grabar_oem( $return,  $no_documento,  $nombre_us,  $direccion_us1,  $prim_apell_us1,  $seg_apell_us1,  $telefono_us1,  $mail_nus1,  $codep_us,  $muni_us )
  {
    
  } // end of member function grabar_oem

  /**
   * 
   *
   * @param  return 
   * @param  tipo_rem 
   * @param  nombre 
   * @param  prim_apell 
   * @param  seg_apell 
   * @param  dignatario 
   * @param  direccion 
   * @param  depto 
   * @param  muni 
   * @param  radicado 
   * @param  cod_usuario 
   * @return 
   * @access public
   */
  function grabar_dir( $return,  $tipo_rem,  $nombre,  $prim_apell,  $seg_apell,  $dignatario,  $direccion,  $depto,  $muni,  $radicado,  $cod_usuario )
  {
    
  } // end of member function grabar_dir

  /**
   * 
   *
   * @param  return 
   * @param  query 
   * @return 
   * @access public
   */
  function tabla_sql( $return,  $query )
  {
    
  } // end of member function tabla_sql

  /**
   * 
   *
   * @param  return 
   * @param  radicado 
   * @param  depe_codi 
   * @param  usua_codi 
   * @param  usua_doc 
   * @return 
   * @access public
   */
  function anularRadicado( $return,  $radicado,  $depe_codi,  $usua_codi,  $usua_doc )
  {
    
  } // end of member function anularRadicado

  /**
   * 
   *
   * @param cadena (string) radicado 
   * @param int depe_codi 
   * @param int usua_codi 
   * @return void
   * @access public
   */
  function solicitud_anulacion( $radicado,  $depe_codi,  $usua_codi )
  {
    
  } // end of member function solicitud_anulacion





} // end of CONTROL_ORFEO
?>
