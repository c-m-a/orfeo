<?php
  /*************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	               */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS         */
  /*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com                         */
  /* ===========================                                                       */
  /*                                                                                   */
  /* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
  /* bajo los terminos de la licencia GNU General Public publicada por                 */
  /* la "Free Software Foundation"; Licencia version 2. 			                         */
  /*                                                                                   */
  /* Copyright (c) 2005 por :	  	  	                                                 */
  /* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
  /*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
  /*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
  /* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
  /*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
  /*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
  /* D.N.P. "Departamento Nacional de Planeación"                                      */
  /*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
  /*                                                                                   */
  /* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
  /*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
  /*  Infometrika            info@infometrika.com  05/2009  Arreglo Variables Globales */
  /*  Jairo Losada           jlosada@gmail.com     05/2009  Eliminacion Funciones-Procesos */
  /*************************************************************************************/
  
  include('./config.php');

  session_start();
  
  foreach ($_GET as $key => $valor) ${$key} = $valor;
  foreach ($_POST as $key => $valor) ${$key} = $valor;

  $krd        = $_SESSION["krd"];
  $dependencia= $_SESSION["dependencia"];
  $usua_doc   = $_SESSION["usua_doc"];
  $codusuario = $_SESSION["codusuario"];
  $tip3Nombre = $_SESSION["tip3Nombre"];
  $tip3desc   = $_SESSION["tip3desc"];
  $tip3img    = $_SESSION["tip3img"];
  $tpNumRad   = $_SESSION["tpNumRad"];
  $tpPerRad   = $_SESSION["tpPerRad"];
  $tpDescRad  = $_SESSION["tpDescRad"];
  $tip3Nombre = $_SESSION["tip3Nombre"];
  $tpDepeRad  = $_SESSION["tpDepeRad"];
  $usuaPermExpediente = $_SESSION["usuaPermExpediente"];

  $nomcarpeta = $_GET["nomcarpeta"];
  $ruta_raiz  = '.';
  $verradicado = $_GET['verrad'];

  $from = (isset($_GET['from']))? $_GET['from'] : 0;

  // Variable para grabar descripcion del acceso al radicado
  $auditoria_arreglo = array('radicado' =>    null,
                              'asunto' =>     null,
                              'usua_login' => null,
                              'unix_time' =>  null,
                              'ip_cliente' => null);
  
  // Variable que controla la activacion de la grabacion de la auditoria.
  $activar_auditoria = ACTIVAR_AUDITORIA;
  $activar_auditoria = $from == 'consulta' || $from == null || $from == 'estadisticas';
  $es_bandeja        = $activar_auditoria == false;
  $activar_auditoria = $activar_auditoria && empty($menu_ver_tmp);
  $activar_auditoria = $activar_auditoria && $krd != USUARIO_AUDITOR;
  
  if (empty($ent))
    $ent = substr($verradicado, -1); 

  if (empty($carpeta))
    $carpeta = (isset($carpetaOld))? $carpetaOld : 0;

  if (empty($menu_ver_tmp))
    $menu_ver_tmp = (isset($menu_ver_tmpOld))? $menu_ver_tmpOld : null;

  if (empty($menu_ver))
    $menu_ver = (isset($menu_ver_Old))? $menu_ver_Old : null;

  if (!$menu_ver) $menu_ver = 3;
  if ($menu_ver_tmp) $menu_ver = $menu_ver_tmp;

  if (!defined('ADODB_ASSOC_CASE')) define('ADODB_ASSOC_CASE', 1);
  include_once "./include/db/ConnectionHandler.php";

  $verrad = (isset($verradicado))? $verradicado : null;
  $numrad = $verrad;

  $db = new ConnectionHandler($ruta_raiz);
  $db->conn->SetFetchMode(3);
  
  // Sentencia para grabar consulta de radicados
  if ($activar_auditoria) {
    $desde_donde  = $enlace[$from];
    $unix_time    = time();
    $radi_nume_radi  = trim($verradicado);
    $sql_asunto   = "SELECT RA_ASUN
                      FROM RADICADO
                      WHERE RADI_NUME_RADI = $radi_nume_radi";

    $rs_asunto    = $db->conn->Execute($sql_asunto);

    if (!$rs_asunto->EOF)
      $asunto_radicado = $rs_asunto->fields["RA_ASUN"];

    $ip_cliente   = $_SERVER['REMOTE_ADDR'];

    $auditoria_arreglo['desde_donde'] = $desde_donde;
    $auditoria_arreglo['usua_login']  = $krd;
    $auditoria_arreglo['unix_time']   = $unix_time;
    $auditoria_arreglo['radicado']    = $radi_nume_radi;
    $auditoria_arreglo['asunto']      = $asunto_radicado;
    $auditoria_arreglo['ip_cliente']  = $ip_cliente;

    $auditoria_json   = json_encode($auditoria_arreglo);
    
    $sql_insert   = "INSERT INTO SGD_AUDITORIA VALUES('$usua_doc',
                                                      's',
                                                      'RADICADO',
                                                      '$auditoria_json',
                                                      $unix_time,
                                                      '$ip_cliente',
                                                      '$radi_nume_radi')";
    
    $db->conn->Execute($sql_insert);
  }

  if($carpeta == 8) {
    $info = 8;
    $nombcarpeta = 'Informados';
  }

  include_once ($ruta_raiz . '/class_control/Radicado.php');
  $objRadicado = new Radicado($db);
  $objRadicado->radicado_codigo($verradicado);
  $path = $objRadicado->getRadi_path();

  // verificacion si el radicado se encuentra en el usuario Actual
  include ($ruta_raiz . '/tx/verifSession.php');
?>
<html>
  <head>
    <title>.: Modulo total :.</title>
    <link rel="stylesheet" href="estilos/orfeo.css">
<!-- seleccionar todos los checkboxes-->
<script language="JavaScript">
  function datosBasicos() {
    window.location='./radicacion/NEW.php?<?=session_name()."=".session_id()?>&<?="nurad=$verrad&fechah=$fechah&ent=$ent&Buscar=Buscar Radicado&carpeta=$carpeta&nomcarpeta=$nomcarpeta"; ?>';
  }

  function mostrar(nombreCapa) {
    document.getElementById(nombreCapa).style.display="";
  }

  function ocultar(nombreCapa) {
    document.getElementById(nombreCapa).style.display="none";
  }

  var contadorVentanas = 0;
  <?php
  if($verradPermisos == "Full" or $datoVer=="985") {
    if($datoVer=="985") {
  ?>
  function  window_onload() {
    <?php if($verradPermisos == "Full" or $datoVer=="985") { ?>
        window_onload2();
    <? } ?>
  }
  <? } ?>
</script>
<?php include ('./pestanas.js'); ?>
<script >
<?
} else {
?>
  function changedepesel(xx) {
  }
<?
}
?>

function window_onload2() {
<?php
if ($menu_ver==3) {
	echo 'ocultar_mod();';
	if ($ver_causal) echo 'ver_causales();'; 
  if ($ver_tema) echo 'ver_temas();';
	if ($ver_sectores) echo 'ver_sector();';
	if ($ver_flujo) echo 'ver_flujo();';
	//if ($ver_subtipo) {echo "verSubtipoDocto();"; }
	if ($ver_VinAnexo) {echo "verVinculoDocto();"; }
}
?>
}

function verNotificacion() {
   mostrar("mod_notificacion");
   ocultar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
   ocultar("mod_flujo");
}

function ver_datos() {
   mostrar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
   ocultar("mod_flujo");
}

function ocultar_mod() {
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
   ocultar("mod_flujo");
}

function ver_tipodocumental() {
<?php
	if($menu_ver_tmp!=2) {
?>
   ocultar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_flujo");
<?php
  }
?>
}

function ver_tipodocumento() {
  ocultar("tb_general");
  ocultar("mod_causales");
  ocultar("mod_temas");
  ocultar("mod_flujo");
}

function verDecision() {
  ocultar("tb_general");
  ocultar("mod_causales");
  ocultar("mod_temas");
  ocultar("mod_flujo");
}

function ver_tipodocuTRD(codserie,tsub) {
<?php
  $isqlDepR = "SELECT RADI_DEPE_ACTU,RADI_USUA_ACTU from radicado
                  WHERE RADI_NUME_RADI = '$numrad'";
  $rsDepR = $db->conn->Execute($isqlDepR);
  $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
  $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
  $ind_ProcAnex="N";
?>
   window.open("./radicacion/tipificar_documento.php?nurad=<?=$verrad?>&ind_ProcAnex=<?=$ind_ProcAnex?>&codusua=<?=$codusua?>&coddepe=<?=$coddepe?>&codusuario=<?=$codusuario?>&dependencia=<?=$dependencia?>&tsub="+tsub+"&codserie="+codserie,"Tipificacion_Documento","height=500,width=750,scrollbars=yes");
}

function verVinculoDocto() {
  window.open("./vinculacion/mod_vinculacion.php?verrad=<?=$verrad?>&codusuario=<?=$codusuario?>&dependencia=<?=$dependencia?>","Vinculacion_Documento","height=500,width=750,scrollbars=yes");
}

function verResolucion() {
   ocultar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_flujo");
   ocultar("mod_tipodocumento");
   mostrar("mod_resolucion");
   ocultar("mod_notificacion");
}

function ver_temas() {
   ocultar("tb_general");
   ocultar("mod_tipodocumento");
   ocultar("mod_causales");
   ocultar("mod_sector");
   ocultar("mod_flujo");
   ocultar("mod_tipodocumento");
   mostrar("mod_temas");
   ocultar("mod_resolucion");
   ocultar("mod_notificacion");
}

function ver_flujo() {
   mostrar("mod_flujo");
   ocultar("tb_general");
   ocultar("mod_tipodocumento");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
   mostrar("mod_flujo");
   ocultar("mod_resolucion");
   ocultar("mod_notificacion");
}

function hidden_tipodocumento() {
<?php
  if(!$ver_tipodoc) {
?>
      //ocultar_mod();
<?php
  }
?>
}

//Incluido Carlos Barrero -SES-
function mostrar(nombreCapa) {
	objeto=document.getElementById(nombreCapa);
	if(objeto)
	  objeto.style.display="";
}

function ocultar(nombreCapa) {
	objeto=document.getElementById(nombreCapa);
	if(objeto)
		objeto.style.display="none";
}

Complementos = new Array( "tb_general",
                          "mod_tipodocumento",
                          "mod_causales",
                          "mod_temas",
                          "mod_sector",
                          "mod_resolucion",
                          "mod_notificacion",
                          "mod_flujo",
                          "mod_decision",
                          "mod_bd_comple");

function ver_complementos(complemento) {
	for(i=0;i<Complementos.length;i++) {
		if(complemento==Complementos[i]) {
			mostrar(Complementos[i]);
		} else {
			ocultar(Complementos[i]);
		}
	}
}

/** FUNCION DE JAVA SCRIPT DE LAS PESTANAS
  * Esta funcion es la que produce el efecto de pertanas de mover a,
  * Reasignar, Informar, Devolver, Vobo y Archivar
  */
</script>
<div id="spiffycalendar" class="text"></div>
<script language="JavaScript" src="./js/spiffyCal/spiffyCal_v2_1.js"></script>
<link rel="stylesheet" type="text/css" href="./js/spiffyCal/spiffyCal_v2_1.css">
</head>
<?php
// Modificado Supersolidaria
if( isset( $_GET['ordenarPor'] ) && $_GET['ordenarPor'] != "" ) 
  $body = "document.location.href='#t1';";
?>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();<? print $body; ?>">
<?php
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$fechah  = date("dmy_h_m_s") . " ". time("h_m_s");
	$check   = 1;
	$numeroa = 0;
  $numero  = 0;
  $numeros = 0;
  $numerot = 0;
  $numerop = 0;
  $numeroh = 0;
 	include ('./ver_datosrad.php');
  if($verradPermisos == "Full" or $datoVer=="985") {
 	} else {
 		$numRad = $verrad;
 		if($nivelRad==1)
      include ($ruta_raiz . '/seguridad/sinPermisoRadicado.php');
 		if($nivelRad==1) die("-");
 	}
?>
<table border="0" width="100%"  cellpadding="0" cellspacing="5" class="borde_tab">
  <tr>
    <td class="titulos2">
      <a class="vinculos" href='javascript:history.back();'>PAGINA ANTERIOR</a>
    </td>
  <td width="85%" class="titulos2">
<?php
  if($krd) {
    $isql = "select *
              From usuario
              where USUA_LOGIN ='$krd' and
                    USUA_SESION='". substr(session_id(),0,29)."' ";
    $rs = $db->conn->query($isql);
    // Validacion de Usuario y Contrasena MD5
    
    if (($krd)) {
      echo 'DATOS DEL RADICADO No';
      if ($mostrar_opc_envio==0 and $carpeta!=8 and !$agendado) {
        $ent = substr($verrad, -1);
        echo "<a title='Click para modificar el Documento' href='./radicacion/NEW.php?nurad=$verrad&Buscar=BuscarDocModUS&".session_name()."=".session_id()."&Submit3=ModificarDocumentos&Buscar1=BuscarOrfeo78956jkgf' notborder >$verrad</a>";
      } else {
        echo $verrad;
      }
    /*
     *  Modificado: 15-Agosto-2006 Supersolidaria
     *  Muestra el numero del expediente al que pertenece el radicado.
	  */
	  if ($numExpediente && $_GET['expIncluido'][0] == '') {
      echo "<span class='noleidos'>&nbsp;&nbsp;&nbsp;PERTENECIENTE AL EXPEDIENTE No. ".
          ($_SESSION['numExpedienteSelected'] != "" ?  $_SESSION['numExpedienteSelected'] : $numExpediente )."</span>";
	} elseif ($_GET['expIncluido'][0] != "") {
    echo "<span class=noleidos>&nbsp;&nbsp;&nbsp;PERTENECIENTE AL EXPEDIENTE No. ".$_GET['expIncluido'][0]."</span>";
    $_SESSION['numExpedienteSelected'] = $_GET['expIncluido'][0];
	}
?>
	</td>
	<td class="titulos5">
      <a class="vinculos" href='./solicitar/Reservas.php?radicado=<?="$verrad"?>'>Solicitados</a>
    </td>
    <td class="titulos5">
      <a class="vinculos" href='./solicitar/Reservar.php?radicado=<?="$verrad&sAction=insert"?>'>Solicitar Fisico</a>
    </td>
  </tr>
</table>
	<table width="100%" class="t_bordeGris">
<tr class="t_bordeGris">
    <td width="33%" height="6">
      <table width='100%' border='0' cellspacing='0' cellpadding='0'>
        <tr class="celdaGris">
<?php
  $datosaenviar = 'fechaf=' . $fechaf .
                  '&mostrar_opc_envio=' . $mostrar_opc_envio .
                  '&tipo_carp=' . $tipo_carp .
                  '&carpeta=' . $carpeta .
                  '&nomcarpeta=' . $nomcarpeta .
                  '&datoVer=' . $datoVer .
                  '&ascdesc=' . $ascdesc .
                  '&orno=' . $orno;
?>
	<td height="20" class="titulos2">LISTADO DE: </td>
	</tr>
    <tr>
		<td height="20" class="info"><?=$nomcarpeta?>
		</td>
		</tr>
	</table>
	</td>
	<td width='33%' height="6">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="10%" class="titulos2" height="20">USUARIO:</td>
			</tr>
      <tr>
				<td width="90%" height="20"  class="info">
          <?=$_SESSION['usua_nomb'] ?>
        </td>
			</tr>
		</table>
	</td>
	<td height="6" width="33%">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="16%"  class="titulos2" height="20">DEPENDENCIA:</td>
			</tr>
      <tr>
			  <td width="84%" height="20" class="info" >
          <?=$_SESSION['depe_nomb'] ?>
        </td>
			</tr>
		</table>
	</td>
</tr>
</table>
<form name="form1" id="form1" action="<?=$ruta_raiz?>/tx/formEnvio.php?<?=session_name()?>=<?=session_id()?>" method="GET">
<?php
if($verradPermisos=='Full') 
	include ($ruta_raiz . '/tx/txOrfeo.php');
?>
<input type="hidden" name='checkValue[<?=$verrad?>]' value='CHKANULAR'>
<input type="hidden" name="enviara" value="9">
</form>
<table border="0" align="center" cellpadding="0" cellspacing="0" width="100%">
  <form action='verradicado.php?<?=session_name()?>=<?=trim(session_id())?>&verrad=<?=$verrad?>&datoVer=<?=$datoVer?>&chk1=<?=$verrad."&carpeta=$carpeta&nomcarpeta=$nomcarpeta"?>' method='GET' name='form2'>
<?php
  echo "<input type='hidden' name='fechah' value='$fechah'>";
  // Modificado Infometrika 22-Julio-2009
  // Compatibilidad con register_globals = Off.
  print "<input type='hidden' name='verrad' value='".$verrad."'>";
	if($flag==2) {
		echo "<center>NO SE HA PODIDO REALIZAR LA CONSULTA</center>";
	} else {
		$row = array();
		$row1 = array();
		if($info) {
			$row["INFO_LEIDO"] = 1;
			$row1["DEPE_CODI"] = $dependencia;
			$row1["USUA_CODI"] = $codusuario;
			$row1["RADI_NUME_RADI"] = $verrad;
			$rs = $db->update("informados", $row, $row1);
		} elseif (($leido!="no" or !$leido) and $datoVer!=985) {
			$row["RADI_LEIDO"] = 1;
			$row1["radi_depe_actu"] = $dependencia;
			$row1["radi_usua_actu"] = $codusuario;
			$row1["radi_nume_radi"] = $verrad;
			$rs = $db->update("radicado", $row, $row1);
		}
	}
  include ('./ver_datosrad.php');
  include ('./ver_datosgeo.php');
  $tipo_documento .= "<input type='hidden' name='menu_ver' value='$menu_ver'>";
  $hdatos = session_name() . '=' . session_id() . 
            '&leido=' . $leido .
            '&nomcarpeta=' . $nomcarpeta .
            '&tipo_carp=' . $tipo_carp .
            '&carpeta=' . $carpeta .
            '&verrad=' . $verrad .
            '&datoVer=' . $datoVer .
            '&fechah=fechah&menu_ver_tmp=';
?>
    <tr>
      <td height="99" rowspan="4" width="3%" valign="top" class="listado2">&nbsp;</td>
      <td height="8" width="94%" class="listado2">
<?php
		  $datos1 = '';
      $datos2 = '';
      $datos3 = '';
      $datos4 = '';
      $datos5 = '';

      $pestana_activa = "datos$menu_ver";
      ${$pestana_activa} = '_R';
?>
        <table border="0" width="69%" cellpadding="0" cellspacing="0">
          <tr>
            <td width="13%" valign="bottom" class="">
              <a href='verradicado.php?<?=$hdatos?>3'>
                <img src='imagenes/infoGeneral<?=$datos3?>.gif' alt='' border=0 width="110" height="25">
              </a>
            </td>
            <td width="13%" valign="bottom" class="">
              <a href='verradicado.php?<?=$hdatos ?>1'>
                <img src='imagenes/historico<?=$datos1?>.gif' alt='' border=0 width="110" height="25">
              </a>
            </td>
            <td width="13%" valign="bottom" class="">
              <a href='verradicado.php?<?=$hdatos ?>2'>
                <img src='imagenes/documentos<?=$datos2?>.gif' alt='' border=0 width="110" height="25">
              </a>
            </td>
            <td width="61%" valign="bottom" class="">
              <a href='verradicado.php?<?=$hdatos ?>4'>
                <img src='imagenes/expediente<?=$datos4?>.gif' alt='' border=0 width="110" height="25">
              </a>
            </td>
            <td width="61%" valign="bottom" class="">&nbsp;</td>
          </tr>
        </table>
      </td>
      <td height="149" rowspan="4" class="" width="3%">&nbsp;</td>
    </tr>
    <tr>
      <td bgcolor="" width="94%" height="100">
<?php
		  switch ($menu_ver) {	
		  	case 1:
				include ('./ver_historico.php');
				break;
			case 2:
				include ('./lista_anexos.php');
				break;
			case 3:
				include ('./lista_general.php');
				break;
			case 4:
				include ('./expediente/lista_expediente.php');
				break;
			case 5:
				include ('./plantilla.php');
				break;
        default:
        break;
      }
?>
      </td>
    </tr>
    <input type="hidden" name="menu_ver" value="<?=$menu_ver ?>">
    <tr>
      <td height="17" width="94%" class="celdaGris"> <?
	} else {
?>
  </td>
  </tr>
</table>
	   <form name="form1" action="enviar.php" method="GET">
	   <input type="hidden" name="depsel">
	   <input type="hidden" name="depsel8">
	   <input type="hidden" name="carpper">
	   <center>
       <span class='titulosError'>SU SESION HA TERMINADO O HA SIDO INICIADA EN OTRO EQUIPO</span><BR>
       <span class='eerrores'>
       </center>
    </form>
  <?php
		   }
			} else {
        echo "<center>
                <b>
                  <span class='eerrores'>
                    NO TIENE AUTORIZACION PARA INGRESAR
                  </span>
                  <br>
                  <span class='eerrores'>
                    <a href='login.php' target=_parent>
                      Por Favor intente validarse de nuevo. Presione aca!
                    </a>
                  </span>";
      }
?>
    </td>
    </tr>
    <tr>
      <td height="15" width="94%" class="listado2">&nbsp;</TD>
    </tr>
</form>
</table>
</body>
<script>
  ver_complementos('tb_general');
</script>
</html>
