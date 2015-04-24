<?
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
import_request_variables("gp", "");
if (!$ruta_raiz) $ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&num_exp=$num_exp";

$db = new ConnectionHandler("$ruta_raiz");
$encabezado = session_name()."=".session_id()."&krd=$krd&nomcarpeta=$nomcarpeta";
$flds_desde_ano = $s_desde_ano;
/*
 * Modificacion acceso a documentos
 * @author Liliana Gomez Velasquez
 * @since octubre 7 2009
 */
 include_once "$ruta_raiz/tx/verLinkArchivo.php";
 $verLinkArchivo = new verLinkArchivo($db);

?>
<html height=50,width=150>
<head>
<title>Alerta Archivo</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
</script>
<?php include_once "$ruta_raiz/js/funtionImage.php"; ?>
<CENTER>
<form name=alerta action="alerta.php?<?=$encabezado?>" method='post'>
<?
/*$i=1474;
$k=348;
while($i<=1517){
$sqm="insert into SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA,CODI_DPTO,CODI_MUNI) VALUES ('$i', '$k', 'CAJA 1', 'C1', '','')";
$d=$db->conn->Execute($sqm);
$i++;
$sqm="insert into SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA,CODI_DPTO,CODI_MUNI) VALUES ('$i', '$k', 'CAJA 2', 'C2', '','')";
$d=$db->conn->Execute($sqm);
$i++;
$sqm="insert into SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA,CODI_DPTO,CODI_MUNI) VALUES ('$i', '$k', 'CAJA 3', 'C3', '','')";
$d=$db->conn->Execute($sqm);
$i++;
$sqm="insert into SGD_EIT_ITEMS (SGD_EIT_CODIGO,SGD_EIT_COD_PADRE,SGD_EIT_NOMBRE,SGD_EIT_SIGLA,CODI_DPTO,CODI_MUNI) VALUES ('$i', '$k', 'CAJA 4', 'C4', '','')";
$d=$db->conn->Execute($sqm);
$i++;
$k++;
}
/*
$sqm="select USUA_DOC,SGD_EXP_NUMERO,SGD_EXP_FECH from SGD_EXP_EXPEDIENTE";
$fr=$db->query($sqm);
while(!$fr->EOF)
{
	$USU=$fr->fields['USUA_DOC'];
	$EXP=$fr->fields['SGD_EXP_NUMERO'];
	$FECH=$fr->fields['SGD_EXP_FECH'];
	$sqd="select sgd_exp_numero from sgd_sexp_secexpedientes where sgd_exp_numero='$EXP'";
	$de=$db->query($sqd);
	if($de->EOF){
	$wt="insert into sgd_sexp_secexpedientes (sgd_exp_numero,sgd_sexp_fech,usua_doc) values ('$EXP','$FECH','$USU')";
	$tr=$db->query($wt);
	}
	$fr->MoveNext();
}
$sqm="select d.RADI_NUME_RADI,c.MUNI_CODI,c.DPTO_CODI from SGD_DIR_DRECCIONES d, SGD_CIU_CIUDADANO c where c.SGD_CIU_CODIGO=d.SGD_CIU_CODIGO order by c.SGD_CIU_CODIGO";
$fr=$db->query($sqm);
while(!$fr->EOF)
{
	$rad=$fr->fields['RADI_NUME_RADI'];
	$muni=$fr->fields['MUNI_CODI'];
	$dpto=$fr->fields['DPTO_CODI'];
	$tr="select muni_codi from radicado where radi_nume_radi like '$rad'";
	$rs=$db->query($tr);
	$mun=$rs->fields['muni_codi'];
	if($mun==""){
	$wt="update radicado set MUNI_CODI='$muni',DPTO_CODI='$dpto' where radi_nume_radi like '$rad'";
	$tr=$db->query($wt);
	}
	$fr->MoveNext();
}
/*
$sqm="select RADI_NUME_RADI,MUNI_CODI,DPTO_CODI,EESP_CODI,TDOC_CODI from RADICADO";
$fr=$db->query($sqm);
while(!$fr->EOF)
{
	$rad=$fr->fields['RADI_NUME_RADI'];
	$muni=$fr->fields['MUNI_CODI'];
	$dpto=$fr->fields['DPTO_CODI'];
	$esp=$fr->fields['EESP_CODI'];

	$tipo=substr($rad,-1);
	$tr="select RADI_NUME_RADI from SGD_DIR_DRECCIONES where radi_nume_radi like '$rad'";
	$rs=$db->query($tr);
	if ($rs->EOF){
		$tdoc=$db->conn->nextId('SEC_DIR_DRECCIONES');
	$wt="insert into SGD_DIR_DRECCIONES (RADI_NUME_RADI,MUNI_CODI,DPTO_CODI,sgd_esp_codi,SGD_DIR_CODIGO,SGD_DIR_TIPO) values ('$rad','$muni','$dpto','$esp','$tdoc','$tipo')";
	$tr=$db->query($wt);
	}
	$fr->MoveNext();
}*/


function fnc_date_calc($this_date,$num_years){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time + ($num_years * 31557600); //calculates # of years passed ($num_years) * # seconds in a day (31557600)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
}//end of function

function fnc_date_calcd($this_date,$num_days){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time + ($num_days * 86400); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
}//end of function
	if(!$exp_fechaIni) $exp_fechaIni = fnc_date_calcd(date("Y-m-d"),"-15");
	if(!$exp_fechaFin) $exp_fechaFin = date("Y-m-d");
?>
<table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab">
<tr><TD class=titulos2 align="center" colspan="5" >
			LOS SIGUIENTES RADICADOS COMENZARON EL TIEMPO EN ARCHIVO DE GESTION:
			</td></tr>
			<tr>
  <td class="titulos5" colspan="2">DEPENDENCIA</td>
  <td colspan="2">
  <?
  $query="select depe_nomb,depe_codi from DEPENDENCIA ORDER BY DEPE_NOMB";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('dep_sel',$dep_sel,"0:--- TODAS LAS DEPENDENCIAS ---",false,"","  class=select");
  ?>
  </td>
  </tr>
  <tr>
  <td class="titulos5" colspan="2">SERIE</td>
  <TD colspan="2">
  <?php
	if(!$tdoc) $tdoc = 0;
	if(!$codserie) $codserie = 0;
	if(!$tsub) $tsub = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
	?>
  </td>
  </tr>
  <tr>
  <td class="titulos5" colspan="2">SUBSERIE</td>
  <td colspan="2">
  <?
	$nomb_varc = "su.sgd_sbrd_codigo";
	$nomb_varde = "su.sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );

	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD =$tsub;
	}
  if ($codiSRD<10 and $codiSRD!=0)$codiSRD="0".$codiSRD;
  if ($codiSBRD<10 and $codiSBRD!=0)$codiSBRD="0".$codiSBRD;
  if($dep_sel==0)$dep_sel2="";
  else $dep_sel2=$dep_sel;
  if($codiSRD==0)$codiSRD2="";
  else $codiSRD2=$codiSRD;
  if($codiSBRD==0)$codiSBRD2="";
  else $codiSBRD2=$codiSBRD;
   $expe=$dep_sel2.$codiSRD2.$codiSBRD2;
  ?>
  </td></tr>
		<tr>
		<td class='titulos2' >Fecha Inicial </td>
				<TD  >
				<script language="javascript">
  			   var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "alerta", "exp_fechaIni","btnDate1","<?=$exp_fechaIni?>",scBTNMODE_CUSTOMBLUE);
				dateAvailable1.date = "<?=date('Y-m-d');?>";
				dateAvailable1.writeControl();
				dateAvailable1.dateFormat="yyyy-MM-dd";
			</script></td>
			<td class='titulos2' >Fecha Final </td>
				<TD>
				<script language="javascript">
  			   var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "alerta", "exp_fechaFin","btnDate2","<?=$exp_fechaFin?>",scBTNMODE_CUSTOMBLUE);
				dateAvailable2.date = "<?=date('Y-m-d');?>";
				dateAvailable2.writeControl();
				dateAvailable2.dateFormat="yyyy-MM-dd";
			</script></td></tr>
			<tr>
			<td colspan="2"  align="right"><input type="submit" name="Traer" value="Traer" class="botones_funcion" align="middle"></td>
			<td colspan="2" align="left"><input name='Regresar' align="middle" type="button" class="botones_funcion" id="envia22" onClick="window.back();" value="Regresar" ></td>
			</tr>
			<?
			if($Traer){
			?>
			<tr>
			<td class="titulos3" align="center" colspan="2">Expediente</td>
			<td class="titulos3" align="center" colspan="2">Radicado</td>
			<td class="titulos3" align="center" >Fecha Fin</td>
			</tr>
<?

	include("$ruta_raiz/include/query/archivo/queryAlerta.php");
	$rs=$db->query($query);
	$cont=0;
	while(!$rs->EOF){
		$exp=$rs->fields["SGD_EXP_NUMERO"];
		$rad=$rs->fields["RADI_NUME_RADI"];
		$fechfin=$rs->fields["SGD_EXP_FECHFIN"];
		$arch=$rs->fields["SGD_EXP_ARCHIVO"];
		$rete=$rs->fields["SGD_EXP_RETE"];


		if ($fechfin!="" and $arch==2 and $rete==1){

			$srd=$rs->fields["SGD_SRD_CODIGO"];
			$sbrd=$rs->fields["SGD_SBRD_CODIGO"];
			$query2="select sgd_sbrd_tiemag, sgd_sbrd_tiemac from sgd_sbrd_subserierd where sgd_sbrd_codigo=$sbrd and sgd_srd_codigo=$srd";
			$rss=$db->query($query2);
			if (!$rss->EOF){
			$tiemc=$rss->fields["SGD_SBRD_TIEMAC"];
			$tiemg=$rss->fields["SGD_SBRD_TIEMAG"];
			$fechaIni = date('Y-m-d');
			$time=fnc_date_calc($fechfin,$tiemg);
			$time2=fnc_date_calc($time,$tiemc);
			if($time>=$fechaIni)
			{
				include("$ruta_raiz/include/query/archivo/queryAlerta.php");
				/*
				 * Modificacion acceso a documentos
				 * @author Liliana Gomez Velasquez
				 * @since octubre 7 2009
				 */

                 $resulVali = $verLinkArchivo->valPermisoRadi($rad);
                 $valImg = $resulVali['verImg'];
                 $pathImagen = $resulVali['pathImagen'];
  				 $rsr=$db->query($query3);
				 //$path=$rsr->fields['RADI_PATH'];
			?>
			<tr>
			<td class=leidos2 align="center" colspan="2"><b><a href='datos_expediente.php?<?=$encabezado."&num_expediente=$exp
			&nurad=$rad"?>' class='vinculos'><?=$exp?></b></td>
			<? 
			if($valImg == "SI"){
				echo "<td class=leidos2 align=center><a class=\"vinculos\" href=\"#2\" onclick=\"funlinkArchivo('$rad','$ruta_raiz');\">$rad</a> </b></td>";
			 } else {
               	echo "<td class=leidos2 align=center><a class=\"vinculos\" href=\"#2\" onclick=\"javascript:noPermiso();\">$rad</a> </b></td>";
			 } 
			?>
			<td class="leidos2" align="center"> <?=$fechfin?></td>
			</tr>

			<?
			$cont++;
			}
		}
		}
		$rs->MoveNext();
	}
	if($cont==0){
?>
<tr>
			<td class=leidos2 align="center">No se encontraron Radicados Proximos a pasar a Archivo Central</td>
			<? }?>
</table>

<br><br>

<table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab">
<tr><TD class=titulos2 align="center" colspan="3" >
			LOS SIGUIENTES RADICADOS COMENZARON EL TIEMPO EN ARCHIVO CENTRAL HOY:
			</td></tr>
			<tr>
			<td class="titulos3" align="center">Expediente</td>
			<td class="titulos3" align="center">Radicado</td>
			<td class="titulos3" align="center" >Fecha Fin</td>
			</tr>
<?

	$rs=$db->query($query);
	$cont=0;
	while(!$rs->EOF){
		$exp=$rs->fields["SGD_EXP_NUMERO"];
		$rad=$rs->fields["RADI_NUME_RADI"];
		$fechfin=$rs->fields["SGD_EXP_FECHFIN"];
		$arch=$rs->fields["SGD_EXP_ARCHIVO"];
		$rete=$rs->fields["SGD_EXP_RETE"];


		if ($fechfin!="" and $arch==2 and $rete==1){

			$srd=$rs->fields["SGD_SRD_CODIGO"];
			$sbrd=$rs->fields["SGD_SBRD_CODIGO"];
			$rss=$db->query($query2);
			if (!$rss->EOF){
			$tiemc=$rss->fields["SGD_SBRD_TIEMAC"];
			$tiemg=$rss->fields["SGD_SBRD_TIEMAG"];
			$fechaIni = date('Y-m-d');
			$time=fnc_date_calc($fechfin,$tiemg);
			$time2=fnc_date_calc($time,$tiemc);

			if($time<=$fechaIni and $fechaIni<=$time2)
			{
				include("$ruta_raiz/include/query/archivo/queryAlerta.php");
				/*
				 * Modificacion acceso a documentos
				 * @author Liliana Gomez Velasquez
				 * @since octubre 7 2009
				 */

                 $resulVali = $verLinkArchivo->valPermisoRadi($rad);
                 $valImg = $resulVali['verImg'];
                 $pathImagen = $resulVali['pathImagen'];
				 $rsr=$db->query($query3);
				 $path=$rsr->fields['RADI_PATH'];
			?>
			<tr>
			<td class=leidos2 align="center"><b><a href='datos_expediente.php?<?=$encabezado."&num_expediente=$exp
			&nurad=$rad"?>' class='vinculos'><?=$exp?></b></td>
			<? 
			if($valImg == "SI"){
				echo "<td class=leidos2 align=center><a class=\"vinculos\" href=\"#2\" onclick=\"funlinkArchivo('$rad','$ruta_raiz');\">$rad</a> </b></td>";
			 } else {
               	echo "<td class=leidos2 align=center><a class=\"vinculos\" href=\"#2\" onclick=\"javascript:noPermiso();\">$rad</a> </b></td>";
			 } 
			?>
			<td class="leidos2" align="center"> <?=$fechfin?></td>
			</tr>

			<?
			$cont++;
			}

		if ($time<=$fechaIni and $fechaIni<=$time2){

				$rsp=$db->query($quer);
			}
		if ($fechaIni>=$time2){

				$rsp=$db->query($quer2);
			}
		}
		}
		$rs->MoveNext();
	}
	if($cont==0){
?>
<tr>
			<td class=leidos2 align="center">No se encontraron Radicados Proximos a pasar a Archivo Historico
			<? }
			}
			?>
</table>
</form>
</html>