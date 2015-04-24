<?php
	session_start();
	error_reporting(0);
	$ruta_raiz = "..";
	if (!isset($_SESSION['dependencia']))	include "../rec_session.php";
   	include_once  "../include/db/ConnectionHandler.php";
   	$db = new ConnectionHandler("..");	 
  	if (!defined('ADODB_FETCH_ASSOC'))	define('ADODB_FETCH_ASSOC',2);
  	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;

  	if(!$fecha_busq) $fecha_busq="2007-07-01";
?>
	<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
	<BODY>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript">
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
</script>
	<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>GENERACION DE REPORTE DE ARCHIVO</center></td></tr></table>
<table><tr><td></td></tr></table>
  <form name="new_product"  action='listado.php?<?=session_name()."=".session_id()."&krd=$krd&fecha_h=$fechah"?>' method=post>
<center>
<TABLE width="450" class="borde_tab" cellspacing="5">
  <!--DWLayoutTable-->
  <TR>
    <TD width="125" height="21"  class='titulos2'> Fecha desde<br>
</TD>
    <TD width="225" align="right" valign="top" class='listado2'>

        <script language="javascript">
		        dateAvailable.date = "2003-08-05";
			    dateAvailable.writeControl();
			    dateAvailable.dateFormat="yyyy-MM-dd";
    	  </script>
</TD>
  </TR>
  <tr>
  <td width="20%" class='titulos2'>DEPENDENCIA </td>
   <TD width="20%" class='titulos2' >
				<? 
				$conD=$db->conn->Concat("DEPE_CODI","'-'","DEPE_NOMB");
				$sql5="select ($conD) as detalle,DEPE_CODI from DEPENDENCIA order by DEPE_CODI";
				//$db->conn->debug=true;
				$rs=$db->conn->Execute($sql5);
				print $rs->GetMenu2('depen',$depen,true,false,"","class=select");
				?>
</td>
  </tr>
  <td width="20%" class='titulos2' align="left">&nbsp;SERIE </td>
<td width="20%" class='titulos2'>
	<?php
	if(!$srd) $srd = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo from 
 	sgd_srd_seriesrd s where ".$sqlFechaHoy." between s.sgd_srd_fechini
 	and s.sgd_srd_fechfin order by detalle ";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Documentales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("srd", $srd, "0:-- Seleccione --", false,"","class='select'" );
	?>
	</tr>
  <tr>
  <td colspan="2">
  <center>
  <input type="submit" name="generar" value="Generar" class="botones">
  </center>
  </td>
  </tr>
  </form>