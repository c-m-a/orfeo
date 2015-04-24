<?php
session_start();
include_once('../config.php');
$ruta_raiz = "..";
if (!$_SESSION['dependencia'] and !$_SESSION['depe_codi_territorial'])	include "../rec_session.php";
if(!$fecha_busq) $fecha_busq=date("Y-m-d");
if(!$fecha_busq2) $fecha_busq2=date("Y-m-d");
include('../config.php');
include_once "Anulacion.php";
include_once "$ruta_raiz/include/tx/Historico.php";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);	
 foreach ($_GET as $key => $valor)  ${$key} = $valor;
 foreach ($_POST as $key => $valor) ${$key} = $valor; 
//$db->conn->debug=true;		
if ($cancelarAnular)
{	$aceptarAnular = "";
	$actaNo = "";
}
?>
<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
<script>
function soloNumeros() {
	jh =  document.new_product.actaNo.value;
 	if(jh) {
    var1 =  parseInt(jh);
		if(var1 != jh) {
			alert('Sólo introduzca números.' );
			//document.forma.submit();
			return false;
		}	else {
		    document.new_product.submit();
    }
 	}	else {
    document.new_product.submit();
  }
}
</script>
</head>
<body>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript">
<!--
	var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "new_product", "fecha_busq2","btnDate1","<?=$fecha_busq2?>",scBTNMODE_CUSTOMBLUE);
//-->
</script><P>
<TABLE width="100%" class='borde_tab' cellspacing="5">
  <TR>
    <TD height="30" valign="middle"   class='titulos5' align="center">Anulacion de Radicados por Dependencia
	</td></tr>
</table>
  <form name="new_product"  action='anularRadicados.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah"?>' method='POST'>
<center>

<TABLE width="550" class='borde_tab' cellspacing='5'>
  <!--DWLayoutTable-->
  <TR>
    <TD width="125" height="21"  class='titulos2'> Fecha desde<br>
	<?
	  echo "($fecha_busq)";
	?>
	</TD>
    <TD width="500" align="right" valign="top" class='listado2'>
    <script language="javascript">
		dateAvailable.date = "2003-08-05";
		dateAvailable.writeControl();
		dateAvailable.dateFormat="yyyy-MM-dd";
    </script>
</TD>
  </TR>
  <TR>
    <TD width="125" height="21"  class='titulos2'> Fecha Hasta<br>
	<?
	  echo "($fecha_busq2)";
	?>
	</TD>
    <TD width="500" align="right" valign="top"  class='listado2'>
    <script language="javascript">
		 dateAvailable2.date = "2003-08-05";
		 dateAvailable2.writeControl();
		 dateAvailable2.dateFormat="yyyy-MM-dd";
    </script>
</TD>
  </TR>
  <tr>
    <TD height="26" class='titulos2'>Tipo Radicacion</TD>
    <TD valign="top" align="left"  class='listado2'>
		<?
		$sqlTR ="select upper(sgd_trad_descr),sgd_trad_codigo from sgd_trad_tiporad 
				order by sgd_trad_codigo";
		$rsTR = $db->conn->Execute($sqlTR);
		print $rsTR->GetMenu2("tipoRadicado","$tipoRadicado",false, false, 0," class='select'>");
		//if(!$depeBuscada) $depeBuscada=$dependencia;
		?>    

	 	</TD>
  </tr>
  <tr>
    <TD height="26" class='titulos2'>Dependencia</TD>
    <TD valign="top" align="left"  class='listado2'>
		<?
			$sqlD = "select depe_nomb,depe_codi from dependencia 
			       where depe_codi_territorial = ".$_SESSION['depe_codi_territorial']."
							order by depe_codi";
			$rsD = $db->conn->Execute($sqlD);
			print $rsD->GetMenu2("depeBuscada",$_POST['depeBuscada'],false, false, 0," class='select'> <option value=0>--- TODAS LAS DEPENDENCIAS --- </OPTION ");
			//if(!$depeBuscada) $depeBuscada=$dependencia;
		?>    

	 	</TD>
  </tr>
  <tr>
    <td height="26" colspan="2" valign="top" class='titulos2'> <center>
		<INPUT TYPE=submit name=generar_informe Value='Ver Documentos En Solicitud' class='botones_funcion' >
		</center>
		</td>
	</tr>
  </TABLE>

<HR>
<?php
if(!$fecha_busq) $fecha_busq = date("Y-m-d");
if($aceptar1 and !$actaNo and !$cancelarAnular) die ("<font color=red><span class=etextomenu>Debe colocal el Numero de acta para poder anular los radicados</span></font>");
	
if(($generar_informe or $aceptarAnular) and !$cancelarAnular)
{
if($depeBuscada and $depeBuscada != 0)
{
  $whereDependencia = " b.DEPE_CODI=$depeBuscada AND";
}
    include_once("../include/query/busqueda/busquedaPiloto1.php");
	include "$ruta_raiz/include/query/anulacion/queryanularRadicados.php";
	error_reporting(7);
	$fecha_ini = $fecha_busq;
    $fecha_fin = $fecha_busq2;
	$fecha_ini = mktime(00,00,00,substr($fecha_ini,5,2),substr($fecha_ini,8,2),substr($fecha_ini,0,4));
	$fecha_fin = mktime(23,59,59,substr($fecha_fin,5,2),substr($fecha_fin,8,2),substr($fecha_fin,0,4));
	
	//Modificacion skina
	$query = "select $radi_nume_radi as radi_nume_radi, r.radi_fech_radi, r.ra_asun, r.radi_usua_actu,
				r.radi_depe_actu, r.radi_usu_ante, c.depe_nomb, b.sgd_anu_sol_fech, ".$db->conn->substr."(b.sgd_anu_desc, 21,62) as sgd_anu_desc
			 from radicado r, sgd_anu_anulados b, dependencia c";
	$fecha_mes = substr($fecha_ini,0,7);
	// Si la variable $generar_listado_existente viene entonces este if genera la planilla existente
	$where_isql = " WHERE $whereDependencia	b.sgd_anu_sol_fecH BETWEEN ".
						$db->conn->DBTimeStamp($fecha_ini)." and ".$db->conn->DBTimeStamp($fecha_fin).
						" and SGD_EANU_CODI = 1 $whereTipoRadi and r.radi_nume_radi=b.radi_nume_radi and b.depe_codi = c.depe_codi";
	$order_isql = " ORDER BY  b.depe_codi, b.SGD_ANU_SOL_FECH";
	$query_t = $query . $where_isql . $order_isql ;
	
	// Verifica el ultimo numero de acta del tipo de radicado
	
	$queryk ="Select max (usua_anu_acta)
			from sgd_anu_anulados
			where sgd_eanu_codi=2 and sgd_trad_codigo = $tipoRadicado	";
		
	$c = $db->conn->Execute($queryk);
	$rsk=$db->query($queryk);
	
	//require "$ruta_raiz/class_control/class_control.php";
	require "../anulacion/class_control_anu.php";
	$db->conn->SetFetchMode(ADODB_FETCH_NUM);
	$btt = new CONTROL_ORFEO($db);
	$campos_align = array("C","L","L","L","L","L","L","L","L","L","L","L");
	$campos_tabla = array("depe_nomb","radi_nume_radi","sgd_anu_sol_fech", "sgd_anu_desc");
	$campos_vista = array ("Dependencia","Radicado","Fecha de Solicitud", "Observacion Solicitante");
	$campos_width = array (200          ,100        ,280           ,300       );
	$btt->campos_align = $campos_align;
	$btt->campos_tabla = $campos_tabla;
	$btt->campos_vista = $campos_vista;
	$btt->campos_width = $campos_width;
	?></center>
<TABLE width="100%" class='borde_tab' cellspacing="3">
  <TR>
    <TD height="30" valign="middle"   class='titulos5' align="center" colspan="2" >Documentos con solicitud de Anulacion</td></tr>
  <tr><td width="16%" class='titulos5'>Fecha Inicial </td><td width="84%" class='listado5'><?=$fecha_busq ?> </td></tr>
  <tr><td class='titulos5'>Fecha Final   </td><td class='listado5'><?=$fecha_busq2 ?> </tr>
  <tr><td class='titulos5'>Fecha Generado </td><td class='listado5'><? echo date("Ymd - H:i:s"); ?></td></tr>
</table>
		<?
	$btt->tabla_sql($query_t);
	error_reporting(7);
	$html= $btt->tabla_html;
	
	$radAnular = $btt->radicadosEnv;
	$radObserva = $btt->radicadosObserva;
	
	//Se asigna el No. de la ultima acta + 1
	//$k = $rsk->fields["0"] + 1;

	}
	if($generar_informe)
	{
		
	?>
	<center>
	<span class="listado2">
	<br>Si esta seguro de Anular estos documentos por favor escriba el numero de acta y presione aceptar.<br>
	<br>Ultima acta generada de este tipo de radicado es la No. <? echo $rsk->fields["0"]; ?> <br> 

	<br>Acta No.    <input type=text name=actaNo class=tex_area><br> 
	<table class='borde_tab' align="center"> 
	<tr><td>
	<input type=button name=AcepAnular value=Aceptar class=botones onClick="soloNumeros();"> 
	<input type=Hidden name=aceptarAnular value=Aceptar class=ebutton onClick="soloNumeros();"> 
	</td><td>
	<input type=submit name=cancelarAnular value=Cancelar class=botones>
	</td></tr>
	</table>
	</span>
	</center>
	<?
	}
	
	//Se le asigna a actaNo el No. de acta que debe seguir
	//	$actaNo=$k;

	if($aceptarAnular and $actaNo)
	{
	
	error_reporting(7);
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler("$ruta_raiz");	
	//*Inclusion territorial
			
	if ($depeBuscada == 0 ) 
	{
		$sqlD = "select depe_nomb,depe_codi from dependencia 
		       where depe_codi_territorial = ".$_SESSION['depe_codi_territorial']."
				order by depe_codi";
		$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$rsD = $db->conn->Execute($sqlD);
		while(!$rsD->EOF)
		{
		    $depcod = $rsD->fields["DEPE_CODI"];
		    $lista_depcod .= " $depcod,";
		    $rsD->MoveNext();
		}   
		$lista_depcod .= "0"; 	
	}
	else 
	{ 
	    $lista_depcod = $depeBuscada;
	    }
            $where_depe = " and (depe_codi) in ($lista_depcod )";
			//*fin inclusion
		   /*
		   * Variables que manejan el tipo de Radicacion
		   */
		   $isqlTR = 'select sgd_trad_descr,sgd_trad_codigo from sgd_trad_tiporad 
        	     	where sgd_trad_codigo = '. $tipoRadicado.'
		  			';
    		$rsTR = $db->conn->Execute($isqlTR);
			if ($rsTR)
	    		{
				$TituloActam = $rsTR->fields["SGD_TRAD_DESCR"];
				} else
				{
				$TituloActam = "sin titulo ";
		}
    		
    	$dbSel = new ConnectionHandler("$ruta_raiz");	
	//$dbSel->conn->debug=true;
	$dbSel->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$rsSel = $dbSel->conn->Execute($query_t);
	$i=0;
	while(!$rsSel->EOF)
	{
	   $radAnularE[$i] = $rsSel->fields['RADI_NUME_RADI'];
	   $radObservaE[$i]= $rsSel->fields['SGD_ANU_DESC'];
	    $i++;
		$rsSel->MoveNext();
	}
//
	if(!$radAnularE) die("<P><span class=etextomenu><CENTER><FONT COLOR=RED>NO HAY RADICADOS PARA ANULAR</FONT></CENTER><span>");
	else {
           /*
		  *$where_TipoRadicado incluido 03082005 para filtrar por tipo radicacion del anulado
		  */

 	    $where_TipoRadicado = " and sgd_trad_codigo = " . $tipoRadicado;
    	$Anulacion = new Anulacion($db);
		$observa = "Radicado Anulado. (Acta No $actaNo)";
		$noArchivo = "/pdfs/planillas/ActaAnul_$dependencia"."_"."$tipoRadicado"."_"."$actaNo.pdf";
    $archivo_generado =  "ActaAnul_$dependencia_$tipoRadicado_$actaNo.pdf";
				$radicados = $Anulacion->genAnulacion($radAnularE,$_SESSION['dependencia'],$_SESSION['usua_doc'],$observaE,$_SESSION['codusuario'],$actaNo,$noArchivo,$where_depe,$where_TipoRadicado,$tipoRadicado, $rsk->fields["0"]);
	
    	$Historico = new Historico($db);
	/** Funcion Insertar Historico 
	 *
	 * ($radicados,  $depeOrigen, $depeDest, $usDocOrigen , $usDocDest, $usCodOrigen, $usCodDest, $observacion, $tipoTx)
	 *
	 */

		$radicados=$Historico->insertarHistorico($radAnularE,$dependencia,$codusuario,$depe_codi_territorial,1,$observa,26); 
		define(FPDF_FONTPATH,'../fpdf/font/');
		$radAnulados = join(",", $radAnularE);
		error_reporting(7);
		$radicadosPdf = "<table>
		<tr><td><b>Radicado</b>&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; 
		</td><td><b>Observacion Solicitante</b></td></tr>";
		foreach($radAnularE as $id=>$noRadicado)
		{
	  		$radicadosPdf .= "<tr><td>".$radAnularE[$id] ."&nbsp;&nbsp; &nbsp;</td><td>". $radObservaE[$id] ."</td></tr>";
		}
		$anoActual = date("Y");
		$radicadosPdf .= "</table>";
		error_reporting(7);
		$ruta_raiz = "..";
		include ("$ruta_raiz/fpdf/html2pdf.php");

	$fecha = date("d-m-Y");
	$fecha_hoy_corto = date("d-m-Y");
	include "$ruta_raiz/class_control/class_gen.php";
	$b = new CLASS_GEN();
	$date =  date("m/d/Y");
	$fecha_hoy =  $b->traducefecha($date);
  	$html = "
		<p><p>
		<br><br><br>
		<b><center> &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
		&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
		ACTA DE ANULACI&Oacute;N No.  $actaNo </center></b><p><br>
		<CENTER><B>
		&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
		NUMEROS DE RADICACI&Oacute;N DE CORRESPONDENCIA ENVIADA A&Ntilde;O $anoActual</B></CENTER><p>
		<CENTER><B>
		&nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp; &nbsp;&nbsp;
		GRUPO CENTRO DE GESTI&Oacute;N DOCUMENTAL Y CORRESPONDENCIA </B></CENTER><p>
		<br>
		En cumplimiento a lo establecido en el  Acuerdo No. 060 del 30 de octubre de 2001  expedido <br>
		por el Archivo General de la Naci&oacute;n, en el cual se establecen pautas para la administraci&oacute;n de<br>
		las  comunicaciones  oficiales en las entidades  p&uacute;blicas  y  privadas que cumplen  funciones<br>
		p&uacute;blicas, y con base especialmente en el par&aacute;grafo del Art&iacute;culo Quinto, el cual establece que <br>
		Cuando existan errores en la radicaci&oacute;n y  se  anulen  los n&uacute;meros, se debe dejar constancia <br>
		por escrito, con la respectiva justificaci&oacute;n y firma del Jefe de la unidad de correspondencia; el <br>
		Coordinador de Gesti&oacute;n  Documental y  Correspondencia de la $entidad_largo procede a anular los siguientes n&uacute;meros de radicaci&oacute;n de<br>
		$TituloActam que no fueron tramitados por las dependencias radicadoras:<br><br>
		1.- N&uacute;meros de radicaci&oacute;n de $TituloActam a anular: <br>
		    $radicadosPdf
		<br><br>
		2.- Se deja  copia  de la presente acta en el archivo central de la  Entidad  para  el tr&aacute;mite <br>
		     respectivo de la organizaci&oacute;n f&iacute;sica de los archivos.<p>
		Se firma la presente el $fecha_hoy
		<p><p>
		______________________________________________________ <br>
		$usua_nomb<BR>
		Coordinador Centro de Gesti&oacute;n Documental y Correspondencia.";
  	$html = 	'<img src="encabezado.jpg" width="520">' . $html;
  	$ruta_raiz = "..";
	$pdf=new PDF();
	$pdf->Open();
	$pdf->SetCreator("HTML2PDF");
	$pdf->SetTitle("Acta de Anulacion de Radicados");
	$pdf->SetSubject("Anulacion radicados");
	$pdf->SetAuthor("Correspondencia");
	$pdf->SetFont('Arial','',12);
	$pdf->AddPage();
	if(ini_get('magic_quotes_gpc')=='1')
			$html=stripslashes($html);
	$pdf->WriteHTML($html);
	//save and redirect
	$noArchivo = $ruta_raiz . '/bodega'.$noArchivo;
	$pdf->Output($noArchivo);
	?>
		<center>Ver Acta <a href=<?=$ruta_raiz?>'/descargar_archivo.php?ruta_archivo=<?=$noArchivo?>&nombre_archivo=<?=$nombre_archivo?>'>Acta No <?=$actaNo?> </a></center>
		<?
    exit;
}
}
?>
</form>
