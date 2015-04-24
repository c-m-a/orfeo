<?php
  date_default_timezone_get('America/Bogota');
  session_start();
  define('SEG_DIA', 86400);
  define('NUMERO_MAX_RADICACION', 600);
  $utime_numero_dias = NUMERO_MAX_RADICACION * SEG_DIA;
  $fecha_actual      = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
  $fecha_anexo       = '';
  
  //empieza Anexos por Julian Rolon
  //lista los documentos del radicado y proporciona links para ver historicos de cada documento
  //este archivo se incluye en la pagina verradicado.php
  if (!$ruta_raiz)
    $ruta_raiz = ".";

  include_once($ruta_raiz . '/class_control/anexo.php');
  include_once($ruta_raiz . '/include/db/ConnectionHandler.php');
  require_once($ruta_raiz . '/class_control/TipoDocumento.php');
  include_once($ruta_raiz . '/class_control/firmaRadicado.php');
  include($ruta_raiz . '/config.php');
  require_once($ruta_raiz . '/class_control/ControlAplIntegrada.php');
  require_once($ruta_raiz . '/class_control/AplExternaError.php');
  
  $db           = new ConnectionHandler('.');
  $objTipoDocto = new TipoDocumento($db);
  $objTipoDocto->TipoDocumento_codigo($tdoc);
  $objFirma      = new FirmaRadicado($db);
  $objCtrlAplInt = new ControlAplIntegrada($db);
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $num_archivos = 0;
  
  $anex =& new Anexo($db);
  $sqlFechaDocto = $db->conn->SQLDate("Y-m-D H:i:s A", "sgd_fech_doc");
  $sqlFechaAnexo = $db->conn->SQLDate("Y-m-D H:i:s A", "anex_fech_anex");
  $sqlSubstDesc  = $db->conn->substr . "(anex_desc, 0, 50)";
  include_once('./include/query/busqueda/busquedaPiloto1.php');
  
  // Modificado SGD 06-Septiembre-2007
  $isql = "select anex_codigo AS DOCU,
                anex_tipo_ext AS EXT,
                anex_tamano AS TAMA,
                anex_solo_lect AS RO,
                usua_nomb AS CREA,
                $sqlSubstDesc AS DESCR,
                anex_nomb_archivo AS NOMBRE,
                ANEX_CREADOR,
                ANEX_ORIGEN,
                ANEX_SALIDA,
                $radi_nume_salida as RADI_NUME_SALIDA,
                ANEX_ESTADO,
                SGD_PNUFE_CODI,
                SGD_DOC_SECUENCIA,
                SGD_DIR_TIPO,
                SGD_DOC_PADRE,
                SGD_TPR_CODIGO,
                SGD_APLI_CODI,
                SGD_TRAD_CODIGO,
                SGD_TPR_CODIGO,
                ANEX_TIPO,
                $sqlFechaDocto as FECDOC,
                $sqlFechaAnexo as FEANEX,
                ANEX_TIPO as NUMEXTDOC
            from anexos,
                anexos_tipo,
                usuario
            where anex_radi_nume = $verrad and
                  anex_tipo = anex_tipo_codi and
                  anex_creador = usua_login and
                  anex_borrado='N'
            order by anex_codigo,
                      radi_nume_salida,
                      sgd_dir_tipo,
                      anex_numero ";
?>
<script>
swradics = 0;
radicando = 0;
function verDetalles(anexo,tpradic,aplinteg,num) {
optAsigna = "";
if (swradics==0){
	optAsigna="&verunico=1";
}
contadorVentanas=contadorVentanas+1;
nombreventana="ventanaDetalles"+contadorVentanas;
url="detalle_archivos.php?usua=<?= $krd ?>&radi=<?= $verrad ?>&anexo="+anexo;
url="<?= $ruta_raiz ?>/nuevo_archivo.php?codigo="+anexo+"&<?= session_name() . "=" . trim(session_id()) ?>&usua=<?= $krd ?>&numrad=<?= $verrad ?>&contra=<?= $drde ?>&radi=<?= $verrad ?>&tipo=<?= $tipo ?>&ent=<?= $ent ?><?= $datos_envio ?>&ruta_raiz=<?= $ruta_raiz ?>"+"&tpradic="+tpradic+"&aplinteg="+aplinteg+optAsigna;
window.open(url,nombreventana,'top=0,height=580,width=640,scrollbars=yes,resizable=yes');
return;
}
function borrarArchivo(anexo,linkarch,radicar_a,procesoNumeracionFechado){
	if (confirm('Estas seguro de borrar este archivo anexo ?')) {
		contadorVentanas=contadorVentanas+1;
		nombreventana="ventanaBorrar"+contadorVentanas;
		//url="borrar_archivos.php?usua=<?= $krd ?>&contra=<?= $drde ?>&radi=<?= $verrad ?>&anexo="+anexo+"&linkarchivo="+linkarch;
		url="lista_anexos_seleccionar_transaccion.php?borrar=1&usua=<?= $krd ?>&numrad=<?= $verrad ?>&&contra=<?= $drde ?>&radi=<?= $verrad ?>&anexo="+anexo+"&linkarchivo="+linkarch+"&numfe="+procesoNumeracionFechado+"&dependencia=<?= $dependencia ?>&codusuario=<?= $codusuario ?>";
		window.open(url,nombreventana,'height=100,width=180');
	}
return;
}

function radicarArchivo(anexo,linkarch,radicar_a,procesoNumeracionFechado,tpradic,aplinteg,numextdoc,dejar_radicar) {
  if(!dejar_radicar) {
    alert ('Orfeo NO generara Radicados, en anexos que fueron creados en el sistema hace mas de (<?= NUMERO_MAX_RADICACION ?>) dias!\nRecomendacion: eliminar el anexo que no permite radicar y crear un nuevo anexo con fecha reciente!!');
    return;
  }

	if (radicando > 0) {
	 	alert ("Ya se esta procesando una radicacion, para re-intentarlo hagla click sobre la pestana de documentos");
	 	return;
  }
  
  radicando++;

	if (confirm('Se asignar\xe1 un n\xfamero de radicado a \xe9ste documento. Est\xe1 seguro  ?')) {
		contadorVentanas=contadorVentanas+1;
		nombreventana="mainFrame";
		
		url="<?= $ruta_raiz ?>/lista_anexos_seleccionar_transaccion.php?radicar=1&radicar_a="+radicar_a+"&vp=n&<?= "&" . session_name() . "=" . trim(session_id()) ?>&radicar_documento=<?= $verrad ?>&numrad=<?= $verrad ?>&anexo="+anexo+"&linkarchivo="+linkarch+"<?= $datos_envio ?>"+"&ruta_raiz=<?= $ruta_raiz ?>&numfe="+procesoNumeracionFechado+"&tpradic="+tpradic+"&aplinteg="+aplinteg+"&numextdoc="+numextdoc;
		window.open(url,nombreventana,'height=450,width=600');
	}
return;
}

function numerarArchivo(anexo,linkarch,radicar_a,procesoNumeracionFechado){
if (confirm('Se asignar\xe1 un n\xfamero a \xe9ste documento. Est\xe1 seguro ?')) {
		contadorVentanas=contadorVentanas+1;
		nombreventana="mainFrame";
		url="<?= $ruta_raiz ?>/lista_anexos_seleccionar_transaccion.php?numerar=1"+"&vp=n&<?= "krd=$krd&" . session_name() . "=" . trim(session_id()) ?>&radicar_documento=<?= $verrad ?>&numrad=<?= $verrad ?>&anexo="+anexo+"&linkarchivo="+linkarch+"<?= $datos_envio ?>"+"&ruta_raiz=<?= $ruta_raiz ?>&numfe="+procesoNumeracionFechado;
		window.open(url,nombreventana,'height=450,width=600');
	}
return;
}

function asignarRadicado(anexo,linkarch,radicar_a,numextdoc){
	if (radicando>0){
	 	alert ("Ya se esta procesando una radicacion, para re-intentarlo hagla click sobre la pestana de documentos");
	 	return;
  }

  radicando++;

	if (confirm('Esta seguro de asignarle el numero de Radicado a este archivo ?')) {
		contadorVentanas=contadorVentanas+1;
		nombreventana="mainFrame";
		url="<?= $ruta_raiz ?>/genarchivo.php?generar_numero=no&radicar_a="+radicar_a+"&vp=n&<?= "&" . session_name() . "=" . trim(session_id()) ?>&radicar_documento=<?= $verrad ?>&numrad=<?= $verrad ?>&anexo="+anexo+"&linkarchivo="+linkarch+"<?= $datos_envio ?>"+"&ruta_raiz=<?= $ruta_raiz ?>"+"&numextdoc="+numextdoc;
		window.open(url,nombreventana,'height=450,width=600');
	}
  return;
}

function ver_tipodocuATRD(anexo,codserie,tsub) {
  <?php
  $isqlDepR     = "SELECT RADI_DEPE_ACTU,RADI_USUA_ACTU from radicado
		            WHERE RADI_NUME_RADI = '$numrad'";
  $rsDepR       = $db->conn->Execute($isqlDepR);
  $coddepe      = $rsDepR->fields['RADI_DEPE_ACTU'];
  $codusua      = $rsDepR->fields['RADI_USUA_ACTU'];
  $ind_ProcAnex = "S";
?>
  window.open("./radicacion/tipificar_documento.php?krd=<?= $krd ?>&nurad="+anexo+"&ind_ProcAnex=<?= $ind_ProcAnex ?>&codusua=<?= $codusua ?>&coddepe=<?= $coddepe ?>&tsub="+tsub+"&codserie="+codserie+"&texp=<?= $texp ?>","Tipificacion_Documento_Anexos","height=500,width=750,scrollbars=yes");
}

function ver_tipodocuAnex(cod_radi,codserie,tsub) { 
  window.open("./radicacion/tipificar_anexo.php?krd=<?= $krd ?>&nurad="+cod_radi+"&ind_ProcAnex=<?= $ind_ProcAnex ?>&codusua=<?= $codusua ?>&coddepe=<?= $coddepe ?>&tsub="+tsub+"&codserie="+codserie,"Tipificacion_Documento_Anexos","height=300,width=750,scrollbars=yes");
}

function vistaPreliminar(anexo,linkarch,linkarchtmp){
		contadorVentanas=contadorVentanas+1;
		nombreventana="mainFrame";
		url="<?= $ruta_raiz ?>/genarchivo.php?vp=s&<?= "krd=$krd&" . session_name() . "=" . trim(session_id()) ?>&radicar_documento=<?= $verrad ?>&numrad=<?= $verrad ?>&anexo="+anexo+"&linkarchivo="+linkarch+"&linkarchivotmp="+linkarchtmp+"<?= $datos_envio ?>"+"&ruta_raiz=<?= $ruta_raiz ?>";
		window.open(url,nombreventana,'height=450,width=600');
return;
}
function nuevoArchivo(asigna){
contadorVentanas=contadorVentanas+1;
optAsigna="";
if (asigna==1){
	optAsigna="&verunico=1";
}
//alert (asigna);

nombreventana="ventanaNuevo"+contadorVentanas;
url="<?= $ruta_raiz ?>/nuevo_archivo.php?codigo=&<?= "krd=$krd&" . session_name() . "=" . trim(session_id()) ?>&usua=<?= $krd ?>&numrad=<?= $verrad ?>&contra=<?= $drde ?>&radi=<?= $verrad ?>&tipo=<?= $tipo ?>&ent=<?= $ent ?>"+"<?= $datos_envio ?>"+"&ruta_raiz=<?= $ruta_raiz ?>&tdoc=<?= $tdoc ?>"+optAsigna;
window.open(url,nombreventana,'height=580,width=640,scrollbars=yes,resizable=yes');
return;
}

function nuevoEditWeb(asigna){
  contadorVentanas=contadorVentanas+1;
  optAsigna="";
  if (asigna==1){
    optAsigna="&verunico=1";
  }
  //alert (asigna);

  nombreventana="ventanaNuevo"+contadorVentanas;
  url="<?= $ruta_raiz ?>/edicionWeb/editorWeb.php?codigo=&<?= "krd=$krd&" . session_name() . "=" . trim(session_id()) ?>&usua=<?= $krd ?>&numrad=<?= $verrad ?>&contra=<?= $drde ?>&radi=<?= $verrad ?>&tipo=<?= $tipo ?>&ent=<?= $ent ?>"+"<?= $datos_envio ?>"+"&ruta_raiz=<?= $ruta_raiz ?>&tdoc=<?= $tdoc ?>"+optAsigna;
  window.open(url,nombreventana,'height=800,width=700,scrollbars=yes,resizable=yes');
  return;
}

function Plantillas(plantillaper1) {
  if(plantillaper1==0) {
    plantillaper1="";
  }
  contadorVentanas=contadorVentanas+1;
  nombreventana="ventanaNuevo"+contadorVentanas;
  urlp="plantilla.php?<?= "krd=$krd&" . session_name() . "=" . trim(session_id()); ?>&verrad=<?= $verrad ?>&numrad=<?= $numrad ?>&plantillaper1="+plantillaper1;
  window.open(urlp,nombreventana,'top=0,left=0,height=800,width=850');
  return;
}
function Plantillas_pb(plantillaper1){
  if(plantillaper1==0) {
    plantillaper1="";
  }
  contadorVentanas=contadorVentanas+1;
  nombreventana="ventanaNuevo"+contadorVentanas;
  urlp="crea_plantillas/plantilla.php?<?= "krd=$krd&" . session_name() . "=" . trim(session_id()); ?>&verrad=<?= $verrad ?>&numrad=<?= $numrad ?>&plantillaper1="+plantillaper1;
  window.open(urlp,nombreventana,'top=0,left=0,height=800,width=850');
  return;
}

function regresar(){
	//window.history.go(0);
	window.location.reload();
	window.close();

}
</script>
<link rel="stylesheet" href="./estilos/orfeo.css">
<body bgcolor="#FFFFFF">
<table width="100%" border="0" cellspacing="0" cellpadding="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="titulos4" colspan="10">GENERACION DE DOCUMENTOS</td>
    <td class="titulos4" colspan="7" width="60%">
      <a href="http://orfeogpl.info/orfeogplVideos/radicacionSalida.ogv" target='VideosOrfeoGPL' alt='Descarga de Video Prueba de orfeogpl.org. Aprox 11 Megas'  title='Descarga de Video Prueba de orfeogpl.org. Aprox 11 Megas'>
        <img src='imagenes/videoOrfeo.png' width=40 border=0>
      </a>
</td>
<?php
  if ($_GET["verrad"] and ($dependencia == 500 || $dependencia == 121 || $dependencia == 370 || $dependencia == 371)) {
?>
<td align="right" class=titulos4>
  <a href='./respuesta_rapida/index.php?PHPSESSID=<?= session_id() ?>&radicado=<?= $numrad ?>&krd=<?= $krd ?>&asunto=<?= $ra_asun ?>&nombreCompleto=<?= $nombreCompleto ?>'>
    <font color="white">Respuesta Rapida</font>
  </a>
</td>
<?
  }
?>
</tr>
</table>
<table WIDTH="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
<tr class="t_bordeGris"><td colspan="15" class="timpar"><img src="<?= $ruta_raiz ?>/imagenes/estadoDocInfo.gif" width="320" height="35"></td></tr>
<tr bgcolor='#6699cc' class='etextomenu' align='middle'>
	<th width='10%' class="titulos2" align="left">
		<img src="<?= $ruta_raiz ?>/imagenes/estadoDoc.gif" width="130" height="32">
	</th>
    <th width='15%' class="titulos2">RADICADO</th>
    <th width='5%' class="titulos2">TIPO</th>
	  <th width='5%' class="titulos2">TRD</font></th>
    <th width='1%' class="titulos2"></th>
    <th width='5%' class="titulos2" >TAMA&Ntilde;O (Kb)</th>
    <th width='5%' class="titulos2" >SOLO LECTURA</th>
    <th width='20%' class="titulos2" >CREADOR</th>
    <th width='20%' class="titulos2">DESCRIPCION</th>
    <th width='12%' class="titulos2">ANEXADO</th>
    <th width='13%' class="titulos2">NUMERADO</th>
    <th width='35%' colspan="5" class="titulos2">ACCION</th>
</tr>
<?php
  $rowan = array();
  $rs    = $db->conn->query($isql);
  
  if (!$ruta_raiz_archivo)
    $ruta_raiz_archivo = $ruta_raiz;
  $directoriobase = "$ruta_raiz_archivo/bodega/";
  //Flag que indica si el radicado padre fue generado desde esta Area de anexos
  $swRadDesdeAnex = $anex->radGeneradoDesdeAnexo($verrad);
  if ($rs) {
    while (!$rs->EOF) {
      $aplinteg  = $rs->fields["SGD_APLI_CODI"];
      $numextdoc = $rs->fields["NUMEXTDOC"];
      $tpradic   = $rs->fields["SGD_TRAD_CODIGO"];
      $coddocu   = $rs->fields["DOCU"];
      $origen    = $rs->fields["ANEX_ORIGEN"];
      if ($rs->fields["ANEX_SALIDA"] == 1)
        $num_archivos++;
      $puedeRadicarAnexo = $objCtrlAplInt->contiInstancia($coddocu, $MODULO_RADICACION_DOCS_ANEXOS, 2);
      $linkarchivo       = $directoriobase . substr(trim($coddocu), 0, 4) . "/" . substr(trim($coddocu), 4, 3) . "/docs/" . trim($rs->fields["NOMBRE"]);
      $ruta_archivo      = substr(trim($coddocu), 0, 4) . "/" . substr(trim($coddocu), 4, 3) . "/docs/" . trim($rs->fields["NOMBRE"]);
      $nombre_archivo    = trim($rs->fields['NOMBRE']);
      
      $linkarchivo_vista = "$ruta_raiz/bodega/" . substr(trim($coddocu), 0, 4) . "/" . substr(trim($coddocu), 4, 3) . "/docs/" . trim($rs->fields["NOMBRE"]) . "?time=" . time();
      $linkarchivotmp    = $directoriobase . substr(trim($coddocu), 0, 4) . "/" . substr(trim($coddocu), 4, 3) . "/docs/tmp" . trim($rs->fields["NOMBRE"]);
      if (!trim($rs->fields["NOMBRE"]))
        $linkarchivo = "";
?>
<tr class="listado2">
<?php
      if ($origen == 1) {
        echo ' class="timpar" ';
        if ($rs->fields["NOMBRE"] == 'No') {
          $linkarchivo = '';
        }
        echo '';
      }
      
      $cod_radi = ($rs->fields["RADI_NUME_SALIDA"] != 0) ? $rs->fields["RADI_NUME_SALIDA"] : $coddocu;
      
      $anex_estado = $rs->fields["ANEX_ESTADO"];
      if ($anex_estado <= 1) {
        $img_estado = "<img src='$ruta_raiz/imagenes/docRecibido.gif' ";
      }
      
      if ($anex_estado == 2) {
        $estadoFirma = $objFirma->firmaCompleta($cod_radi);
        if ($estadoFirma == "NO_SOLICITADA")
          $img_estado = "<img src=$ruta_raiz/imagenes/docRadicado.gif  border=0>";
        elseif ($estadoFirma == "COMPLETA") {
          $img_estado = "<img src=$ruta_raiz/imagenes/docFirmado.gif  border=0>";
        } elseif ($estadoFirma == "INCOMPLETA") {
          $img_estado = "<img src=$ruta_raiz/imagenes/docEsperaFirma.gif border=0>";
        }
      }
      
      if ($anex_estado == 3) {
        $img_estado = "<img src='$ruta_raiz/imagenes/docImpreso.gif'>";
      }
      
      if ($anex_estado == 4) {
        $img_estado = "<img src='$ruta_raiz/imagenes/docEnviado.gif'>";
      }
?>
<td height="21" class="listado2"> <font size="1"> <?= $img_estado ?> </font>
</td>
 <TD><font size=1>
<?php
  $enlace_radicado = './descargar_archivo.php?'.
                      'ruta_archivo=' . $ruta_archivo .
                      '&nombre_archivo=' . $nombre_archivo .
                      '&radicado=' . trim(strtolower($cod_radi));

  $es_archivo_valido = trim($linkarchivo) &&
                        ($verradPermisos == "Full" ||
                          ($rs->fields["EXT"] != "doc" && $rs->fields["EXT"] != "odt" && $rs->fields["EXT"] != "ocx" && $rs->fields["EXT"] != "docx") ||
                            (($krd == "ADOMINGUEZ" || $krd == "ADMIN3")));

  if ($es_archivo_valido) {
        echo "<a class='vinculos' href='$enlace_radicado'>" . trim(strtolower($cod_radi)) . "</a>";
        //echo "<b><a class=vinculos href='".trim(strtolower($linkarchivo_vista))."'>".trim(strtolower($cod_radi))."</a>";
      } else {
        echo trim(strtolower($cod_radi));
      }
?>
 </font>
</td>
	<td><font size=1>
<?php
      if (trim($linkarchivo) && ($verradPermisos == "Full" || ($rs->fields["EXT"] != "doc" && $rs->fields["EXT"] != "odt" && $rs->fields["EXT"] != "docx" && $rs->fields["EXT"] != "ocx" || $krd != "ADOMINGUEZ" || $krd != "ADMIN3"))) {
        echo $rs->fields["EXT"];
      } else {
        echo $msg;
      }

      $msg = ($rs->fields["SGD_DIR_TIPO"] == 7)? 'Otro Destinatario' : 'Otro Destinatario';
?> 
</font> 
</td>
<td width="1%" valign="middle"><font face="Arial, Helvetica, sans-serif" class="etextomenu">
<?php
      // Indica si el Radicado Ya tiene asociado algun TRD
      $isql_TRDA  = "SELECT *
				FROM SGD_RDF_RETDOCF
				WHERE RADI_NUME_RADI = '$cod_radi'";
      $rs_TRA     = $db->conn->Execute($isql_TRDA);
      $radiNumero = $rs_TRA->fields["RADI_NUME_RADI"];
      
      $msg_TRD = ($radiNumero != '') ? 'S' : '';
      echo "<center>\n";
      echo $msg_TRD;
?>
</center>
</font>
</td>
	<td width="1%" valign="middle"><font face="Arial, Helvetica, sans-serif" class="etextomenu">
	<?php
      /**
       *  $perm_radi_sal  Viene del campo PER_RADI_SAL y Establece permiso en la rad. de salida
       *  1 Radicar documentos,  2 Impresion de Doc's, 3 Radicacion e Impresion.
       *  (Por. Jh)
       *  Ademas verifica que el documento no este radicado con $rowwan[9] y [10]
       *  El jefe con $codusuario=1 siempre podra radicar
       */
      // se agrega docx ricardo
      if (($rs->fields["EXT"] == "rtf" or $rs->fields["EXT"] == "doc" or $rs->fields["EXT"] == "docx" or $rs->fields["EXT"] == "odt" or $rs->fields["EXT"] == "xml" || $krd == "ADOMINGUEZ" || $krd == "ADMIN3") AND $rs->fields["ANEX_ESTADO"] <= 3) {
        echo "<a class=vinculos href=javascript:vistaPreliminar('$coddocu','$linkarchivo','$linkarchivotmp')>";
?>
	  <img src="<?= $ruta_raiz ?>/iconos/vista_preliminar.gif" alt="Vista Preliminar" border="0">
	  <font face="Arial, Helvetica, sans-serif" class="etextomenu">
	<?php
        echo "</a>";
        $radicado        = "false";
        $anexo           = $cod_radi;
        $fecha_anexo     = $rs->fields["FEANEX"];
        $arr_fecha_anexo = explode(' ', $fecha_anexo);
        $fecha_anexo     = $arr_fecha_anexo[0];
        $arr_fecha_anexo = explode('-', $fecha_anexo);
        $utime_anexo     = mktime(0, 0, 0, $arr_fecha_anexo[1], $arr_fecha_anexo[2], $arr_fecha_anexo[0]);
        $espacio_tiempo  = $fecha_actual - $utime_anexo;
        
        // Variable que permite dejar radicar si 1 no dejar radicar si 0 dejar radicar
        $dejar_radicar = ($espacio_tiempo > $utime_numero_dias) ? false : true;
      }
?>
	</font>
</td>
 <td><font size="1"> <?= $rs->fields["TAMA"] ?> </font></td>
 <td><font size="1"> <?= $rs->fields["RO"] ?> </font></td>
 <td><font size="1"> <?= $rs->fields["CREA"] ?> </font></td>
 <td><font size="1"> <?= $rs->fields["DESCR"] ?> </font></td>
 <td><font size="1"> <?= $rs->fields["FEANEX"] ?> </font></td>
 <td><font size="1">
 <?php
      if ($rs->fields["SGD_PNUFE_CODI"] && strcmp($cod_radi, $rs->fields["SGD_DOC_PADRE"]) == 0 && strlen($rs->fields["SGD_DOC_SECUENCIA"]) > 0) {
        $anex->anexoRadicado($verrad, $rs->fields["DOCU"]);
        echo ($anex->get_doc_secuencia_formato($dependencia) . "<BR>" . $rs->fields["FECDOC"]);
      }
?>
</font>
</td>
  <td>
    <font size="1">
<?php
      if ($origen != 1 and $linkarchivo and $verradPermisos == "Full") {
        if ($anex_estado < 4)
          echo "<a class=vinculos href=javascript:verDetalles('$coddocu','$tpradic','$aplinteg')>Modificar</a> ";
      }
?>
		</font>
	</td>
	<?php
      //Estas variables se utilizan para verificar si se debe mostrar la opci�n de tipificaci�n de anexo .TIF
      $anexTipo      = $rs->fields["ANEX_TIPO"];
      $anexTPRActual = $rs->fields["SGD_TPR_CODIGO"];
      if ($verradPermisos == "Full") {
?>
		<td>
      <font size="1">
<?php
        $radiNumeAnexo = $rs->fields["RADI_NUME_SALIDA"];
        if ($radiNumeAnexo > 0 and trim($linkarchivo)) {
          if (!$codserie)
            $codserie = "0";
          if (!$tsub)
            $tsub = "0";
          echo "<a class=vinculos href=javascript:ver_tipodocuATRD($radiNumeAnexo,$codserie,$tsub);>Tipificar</a> ";
        } elseif ($perm_tipif_anexo == 1 && $anexTipo == 4 && $anexTPRActual == '') {
          //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, adem�s el anexo no ha sido tipificado
          if (!$codserie)
            $codserie = "0";
          if (!$tsub)
            $tsub = "0";
          echo "<a class=vinculoTipifAnex href=javascript:ver_tipodocuAnex('$cod_radi','$anexo',$codserie,$tsub);> Tipificar </a> ";
        } elseif ($perm_tipif_anexo == 1 && $anexTipo == 4 && $anexTPRActual != '') {
          //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, adem�s el anexo YA ha sido tipificado antes
          if (!$codserie)
            $codserie = "0";
          if (!$tsub)
            $tsub = "0";
          echo "<a class=vinculoTipifAnex href=javascript:ver_tipodocuAnex('$cod_radi','$anexo',$codserie,$tsub);> Re-Tipificar </a> ";
        }
?>
 	</font>
 	</td>
	<td><font size="1">
	<?php
        if ($rs->fields["RADI_NUME_SALIDA"] == 0 and $ruta_raiz != ".." and (trim($rs->fields["ANEX_CREADOR"]) == trim($krd) OR $codusuario == 1)) {
          if ($origen != 1 and $linkarchivo) {
            echo "<a class=vinculos href=javascript:borrarArchivo('$coddocu','$linkarchivo','$cod_radi','" . $rs->fields["SGD_PNUFE_CODI"] . "')>Borrar</a> ";
          }
        }
?>
	</font>
	</td>
	<td>
    <font size="1">
	<?php
        /**
         *  $perm_radi_sal  Viene del campo PER_RADI_SAL y Establece permiso en la rad. de salida
         *  1 Radicar documentos,  2 Impresion de Doc's, 3 Radicacion e Impresion.
         *  (Por. Jh)
         *  Ademas verifica que el documento no este radicado con $rowwan[9] y [10]
         *  El jefe con $codusuario=1 siempre podra radicar
         */
        if (($tpPerRad[$tpradic] == 2 or $tpPerRad[$tpradic] == 3) and
              (strtoupper($rs->fields["EXT"]) == 'DOC' or
                strtoupper($rs->fields["EXT"]) == "DOCX" or
                strtoupper($rs->fields["EXT"]) == "OCX" or
                strtoupper($rs->fields["EXT"]) == "ODT")) {
          if (!$rs->fields["RADI_NUME_SALIDA"]) {
            if (substr($verrad, -1) == 2 && $puedeRadicarAnexo == 1) {
              $rs->fields["SGD_PNUFE_CODI"] = 0;
              echo "<a class=vinculos href=javascript:radicarArchivo('$coddocu','$linkarchivo','si'," . $rs->fields["SGD_PNUFE_CODI"] . ",'$tpradic','$aplinteg','$numextdoc','$dejar_radicar')>Radicar(-$tpradic)</a>";
              $radicado = "false";
              $anexo    = $cod_radi;
            } else if ($puedeRadicarAnexo != 1) {
              $objError = new AplExternaError();
              $objError->setMessage($puedeRadicarAnexo);
              echo ($objError->getMessage());
            } else {
              if ((substr($verrad, -1) != 2) &&
                    $num_archivos == 1 &&
                    !$rs->fields["SGD_PNUFE_CODI"] &&
                    $swRadDesdeAnex == false) {
                
                echo "<a class=vinculos href=javascript:asignarRadicado('$coddocu','$linkarchivo','$cod_radi','$numextdoc')>Asignar Rad</a>";
                $radicado = "false";
                $anexo    = $cod_radi;
              } elseif ($rs->fields["SGD_PNUFE_CODI"] &&
                          strcmp($cod_radi, $rs->fields["SGD_DOC_PADRE"]) == 0 &&
                          !$anex->seHaRadicadoUnPaquete($rs->fields["SGD_DOC_PADRE"])) {
                
                echo "<a class=vinculos href=javascript:radicarArchivo('$coddocu','$linkarchivo','si'," . $rs->fields["SGD_PNUFE_CODI"] . ",'$tpradic','$aplinteg','$numextdoc','$dejar_radicar')>Radicar(-$tpradic)</a>";
                $radicado = "false";
                $anexo    = $cod_radi;
              } elseif ($puedeRadicarAnexo == 1) {
                
                $rs->fields["SGD_PNUFE_CODI"] = 0;
                echo "<a class=vinculos href=javascript:radicarArchivo('$coddocu','$linkarchivo','si'," . $rs->fields["SGD_PNUFE_CODI"] . ",'$tpradic','$aplinteg',$numextdoc,'$dejar_radicar')>Radicar(-$tpradic)</a>";
                $radicado = "false";
                $anexo    = $cod_radi;
              }
            }
          } else {
            if (!$rs->fields["SGD_PNUFE_CODI"])
              $rs->fields["SGD_PNUFE_CODI"] = 0;
            if ($anex_estado < 4) {
              echo "<a class=vinculos href=javascript:radicarArchivo('$coddocu','$linkarchivo','$cod_radi'," . $rs->fields["SGD_PNUFE_CODI"] . ",'','',$numextdoc,'1')>Re-Generar</a>";
              $radicado = "true";
            }
          }
        } elseif ($rs->fields["SGD_PNUFE_CODI"] && ($usua_perm_numera_res == 1) && $ruta_raiz != ".." && !$rs->fields["SGD_DOC_SECUENCIA"] && strcmp($cod_radi, $rs->fields["SGD_DOC_PADRE"]) == 0) {
          // SI ES PAQUETE DE DOCUMENTOS Y EL USUARIO TIENE PERMISOS
          echo "<a class=vinculos href=javascript:numerarArchivo('$coddocu','$linkarchivo','si'," . $rs->fields["SGD_PNUFE_CODI"] . ")>Numerar</a>";
        }
        if ($rs->fields["RADI_NUME_SALIDA"]) {
          $radicado = "true";
        }
?>
		</font>
		</td>
	<?php
      } else {
?>
		<td >
    <font size=1>
		<?php
        if ($origen != 1 and $linkarchivo and $perm_borrar_anexo == 1 && $anexTipo == 4) {
          echo "<a class=vinculoTipifAnex href=javascript:borrarArchivo('$coddocu','$linkarchivo','$cod_radi','" . $rs->fields["SGD_PNUFE_CODI"] . "')>Borrar</a> ";
        }
        if ($perm_tipif_anexo == 1 && $anexTipo == 4 && $anexTPRActual == '') {
          //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, adem�s el anexo no ha sido tipificado
          if (!$codserie)
            $codserie = "0";
          if (!$tsub)
            $tsub = "0";
          echo "<a class=vinculoTipifAnex href=javascript:ver_tipodocuAnex('$cod_radi','$anexo',$codserie,$tsub);> Tipificar </a> ";
        } elseif ($perm_tipif_anexo == 1 && $anexTipo == 4 && $anexTPRActual != '') {
          //Es un anexo de tipo tif (4) y el usuario tiene permiso para Tipificar, adem�s el anexo YA ha sido tipificado antes
          if (!$codserie)
            $codserie = "0";
          if (!$tsub)
            $tsub = "0";
          echo "<a class=vinculoTipifAnex href=javascript:ver_tipodocuAnex('$cod_radi','$anexo',$codserie,$tsub);> Re-Tipificar </a> ";
        }
?>
	</font>
	</td>
	<?php
      }
?>
</tr>
<?php
      $rs->MoveNext();
    }
  }
  /*
  $mostrar_lista = 0;
  if($mostrar_lista==1)
  {
  ?>
  </TABLE>
  <?
  }*/
?>

</table>
<?
  if ($verradPermisos == "Full" or $krd == 'HOSORIO' or $krd == 'ADMIN3' or $krd == 'OCSES1' or $krd == 'OCSES2' or $krd == 'OCSES3' or $krd == 'OCSES7' or $krd == 'OCSES9' or $krd == 'OCSES6' or $krd == 'PROFESIONAL') {
?>
<br>
<table  width="100%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr align="center">
     <td>
     <a class="vinculos" href='javascript:nuevoArchivo(<?
    if ($num_archivos == 0 && $swRadDesdeAnex == false)
      echo "1";
    else
      echo "0";
?>)' class="timpar">
Anexar Archivo</a>
      </td>
    <script>
    	 swradics=<?= $num_archivos ?>;
    </script>
    <?
    /* Anexar plantillas, keda por ahora aplazado el proyecto
    <td class="celdaGris"> <a href='javascript:Plantillas(0)' class="timparr">Anexar
    Plantilla ...</a>
    <!-- <a href='plantilla.php?<?=SID ?>'>Anexar Plantilla ... </a> </td>-->
    </TD>
    
    <td class="celdaGris"> <a href='javascript:Plantillas_pb(0)' class="timparr">A</a>
    <!-- <a href='plantilla.php?<?=SID ?>'>Anexar Plantilla ... </a> </td>-->
    </TD>
    */
?>
  </tr>
</table>
<?php
  }
?>
<br>
</body>
