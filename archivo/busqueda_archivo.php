<?
// Modificado SGD 10-Septiembre-2007
if( !isset( $codDpto ) )
{
	$codDpto = 0;
}
session_start();

/**
  * Modificacion Variables Globales Fabian losada 2009-07
  * Licencia GNU/GPL 
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tpDepeRad = $_SESSION["tpDepeRad"];
$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
	$db2 = new ConnectionHandler("$ruta_raiz");
	$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&sel=$sel";
	$encabezado = session_name()."=".session_id()."&krd=$krd&tipo_archivo=1&nomcarpeta=$nomcarpeta";

	function fnc_date_calcy($this_date,$num_years){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time + ($num_years * 86400); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
   }
    function fnc_date_calcm($this_date,$num_month){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time - ($num_month * 2678400 ); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
    }
?>
<html height=50,width=150>
<head>
<title>Busqueda Avanzada en Archivo</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">


 </script>



<form name=busqueda_archivo action="<?=$encabezadol?>" method='post' action='busqueda_archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'>
<br>

<? // parametrizacion de items
//$db->conn->debug=true;
	include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
	$rs=$db->query($sql1);
	$item11=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode(' ',$item11);
	$item1=$tm[0];
	if($item1!=""){
		include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
		$rs=$db->query($sql12);
		$item21=$rs->fields["SGD_EIT_NOMBRE"];
		$tm=explode(' ',$item21);
		$item2=$tm[0];
		if($item2!=""){
			include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
			$rs=$db->query($sql6);
			$item31=$rs->fields["SGD_EIT_NOMBRE"];
			$tm=explode(' ',$item31);
			$item3=$tm[0];
			if($item3!=""){
				include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
				$rs=$db->query($sql7);
				$item41=$rs->fields["SGD_EIT_NOMBRE"];
				$tm=explode(' ',$item41);
				$item4=$tm[0];
				if($item4!=""){
					include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
					$rs=$db->query($sql8);
					$item51=$rs->fields["SGD_EIT_NOMBRE"];
					$tm=explode(' ',$item51);
					$item5=$tm[0];
					if($item5!=""){
						include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
						$rs=$db->query($sql9);
						$item61=$rs->fields["SGD_EIT_NOMBRE"];
						$tm=explode(' ',$item61);
						$item6=$tm[0];
					}
				}
			}
		}
	}
/*
	$item1="Archivador";
	$item2="Consecutivo";
	$item3="Piso";*/
 ?>

<table border=0 width="90%" cellpadding="0"  class="borde_tab">
  <td class=titulosError  width="80%" colspan="4" align="center">BUSQUEDA AVANZADA (SOLO PARA RADICADOS ARCHIVADOS) </td>

<tr><td width="20%" class='titulos2' align="left">
&nbsp;SERIE </td>
<td width="20%" class='titulos2'>
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
	$querySerie = "select distinct ($sqlConcat) as detalle, s.sgd_srd_codigo from sgd_mrd_matrird m,
 	sgd_srd_seriesrd s where s.sgd_srd_codigo = m.sgd_srd_codigo and ".$sqlFechaHoy." between s.sgd_srd_fechini
 	and s.sgd_srd_fechfin order by detalle ";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
	?>
	<td width="20%" class='titulos2' align="left">EXPEDIENTE</td>
	<td width="20%" class='titulos2'><input type=text name=buscar_exp value='<?=$buscar_exp?>' class="tex_area">
	</td></tr>
	<tr><td width="20%" class='titulos2' align="left"> SUBSERIE </td>
	<td width="20%" class='titulos2'>
	<?
	$nomb_varc = "su.sgd_sbrd_codigo";
	$nomb_varde = "su.sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySub = "select distinct ($sqlConcat) as detalle, su.sgd_sbrd_codigo from sgd_mrd_matrird m,
 	sgd_sbrd_subserierd su where m.sgd_srd_codigo = '$codserie' and su.sgd_srd_codigo = '$codserie'
			and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ".$sqlFechaHoy." between su.sgd_sbrd_fechini
			and su.sgd_sbrd_fechfin order by detalle ";
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );

	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD =$tsub;
	}

	?>
	<td width="20%" class='titulos2' align="left"> RADICADO </td>
	<td width="20%" class='titulos2'><input type=text name=buscar_rad value='<?=$buscar_rad?>' class="tex_area">
	</td></tr>
	<tr><td width="20%" class='titulos2' align="left">PROCESO </td>
	<td width="20%" class='titulos2'>
          <?
          $queryPEXP = "select SGD_PEXP_DESCRIP,SGD_PEXP_CODIGO FROM SGD_PEXP_PROCEXPEDIENTES WHERE
				SGD_SRD_CODIGO=$codiSRD AND SGD_SBRD_CODIGO=$codiSBRD
			";
          	$rsP=$db->conn->query($queryPEXP);
			$texp = $rsP->fields["SGD_PEXP_CODIGO"];
            $comentarioDev = "Muestra los procesos segun la combinacion Serie-Subserie";
            include "$ruta_raiz/include/tx/ComentarioTx.php";

            print $rsP->GetMenu2("codProc", $codProc, "0:-- Seleccione --", false,"","class='select'" );
            ?>
	<td width="20%" class='titulos2' align="left">PARAMETROS </td>
	<td width="20%" class='titulos2'><input type=text name=buscar_parametros value='<?=$buscar_parametros?>' class="tex_area">
    </td></tr>
    <?
	if($docu1 == 1) $datoss = "checked"; else $datoss= "";
	?>
	<tr> <td width="20%" class='titulos2' align="left">
	NIT
   <input name="docu1" type="checkbox" class="select" value="1" <?=$datoss?>>
	&nbsp;&nbsp;No DE CEDULA
   <?
	if($docu1 == 2) $datoss = "checked"; else $datoss= "";
	?>
	<input name="docu1" type="checkbox" class="select" value="2" <?=$datoss?>>
	<br>No DE REFERENCIA
   <?
	if($docu1 == 3) $datoss = "checked"; else $datoss= "";
	?>
	<input name="docu1" type="checkbox" class="select" value="3" <?=$datoss?>></td>
   <td width="20%" class='titulos2'><input type=text name=buscar_docu value='<?=$buscar_docu?>' size="11"  maxlength="9" class="tex_area">
   &nbsp;&nbsp;Para cedula: xx.xxx.xxx
    <?

   ?>
<td width="20%" class='titulos2'>EDIFICIO </td>
<TD width="20%" class='titulos2' >
				<? 
				$sql5="select SGD_EIT_SIGLA,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE='0' ";
				$rs=$db->query($sql5);
				print $rs->GetMenu2('exp_edificio',$exp_edificio,true,false,"","onChange='submit()'  class=select");
				if($exp_edificio!=""){
				?>
</td></td></tr>
<tr><td width="20%" class='titulos2' align="left"><?=$item1?> </td>
<td width="20%" class='titulos2'><!--input type=text name=buscar_isla value='<?=$buscar_piso?>' class="tex_area" size=3 maxlength="2"></td-->
<?

  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$exp_edificio'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_piso',$buscar_piso,true,false,"","onChange='submit()' class=select");
  if($buscar_piso!=""){
  ?>

<td width="20%" class='titulos2'><?=$item2?> </td>
<td width="20%" class='titulos2'>
<?
				$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$buscar_piso'";
				$rs=$db->query($sql);
				print $rs->GetMenu2('buscar_ufisica',$buscar_ufisica,true,false,"","onChange='submit()'  class=select");
				if($buscar_ufisica!=""){
   		    	?>
</td></tr>

<tr><td width="20%" class='titulos2' align="left"><?=$item3?> </td>
<td width="20%" class='titulos2'>
<?

  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$buscar_ufisica'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_estan',$buscar_estan,true,false,"","onChange='submit()' class=select");
  if($buscar_estan!=""){
  ?>

<td width="20%" class='titulos2'><?=$item4?> </td>
<td width="20%" class='titulos2'>
<?
				$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$buscar_estan'";
				$rs=$db->query($sql);
				print $rs->GetMenu2('buscar_entre',$buscar_entre,true,false,"","onChange='submit()' class=select");
				if($buscar_entre!=""){
   		    	?>
</td></tr>
<tr><td width="20%" class='titulos2' align="left"><?=$item5?> </td>
<td width="20%" class='titulos2'>
<?

  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$buscar_entre'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_caja',$buscar_caja,true,false,"","onChange='submit()' class=select");
  if($buscar_caja!=""){
  ?>

<td width="20%" class='titulos2'><?=$item6?> </td>
<td width="20%" class='titulos2'>
<?
				$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE = '$buscar_caja'";
				$rs=$db->query($sql);
				print $rs->GetMenu2('buscar_caja2',$buscar_caja2,true,false,""," class=select");
   		    	?>
</td></tr>
<?
}
}
}
}
}
}
?>
<tr><td width="20%" class='titulos2' align="left">DEPARTAMENTO </td>
<td width="20%" class='titulos2'>
          <?

			$rsPE=$db->conn->query($queryDpto);
			if( $rsPE )
            print $rsPE->GetMenu2("codDpto", $codDpto, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
            ?>
            <td width="20%" class='titulos2' align="left"> FECHA ARCHIVO &nbsp;&nbsp;&nbsp;&nbsp;  Desde  <br>&nbsp;&nbsp;&nbsp;
            <?
			if($sep == 1) $datoss = "checked"; else $datoss= "";
			?>
            <input name="sep" type="checkbox" class="select" value="1" <?=$datoss?>>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta
            </td>
	<td width="20%" class='titulos2'>
	<script language="javascript">
  	<?
	 	if(!$fechaInii) $fechaInii=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif) $fechaInif = date('Y-m-d');
  	?>
   	var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "busqueda_archivo", "fechaInii","btnDate1","<?=$fechaInii?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable1.date = "<?=date('Y-m-d');?>";
	dateAvailable1.writeControl();
	dateAvailable1.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "busqueda_archivo", "fechaInif","btnDate1","<?=$fechaInif?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable2.date = "<?=date('Y-m-d');?>";
	dateAvailable2.writeControl();
	dateAvailable2.dateFormat="yyyy-MM-dd";
	</script>

            </td></tr>
 <tr><td width="20%" class='titulos2' align="left">MUNICIPIO </td>
 <td width="20%" class='titulos2'>
          <?
          	$rsPX=$db->conn->query($queryMuni);
			print $rsPX->GetMenu2("codMuni", $codMuni, "0:-- Seleccione --", false,"","class='select'" );

            ?>
	<td width="20%" class='titulos2'>FECHA FINAL  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Desde <br>&nbsp;&nbsp;&nbsp;
	<?
			if($sel1 == 1) $datoss = "checked"; else $datoss= "";
			?>
            <input name="sel1" type="checkbox" class="select" value="1" <?=$datoss?>>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;Hasta
	</td>

	<td width="20%" class='titulos2'>
	<script language="javascript">
  	<?
  	 	if(!$fechaFini) $fechaFini=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaFinf) $fechaFinf = date('Y-m-d');
  	?>
   	var dateAvailable3 = new ctlSpiffyCalendarBox("dateAvailable3", "busqueda_archivo", "fechaFini","btnDate1","<?=$fechaFini?>",scBTNMODE_CUSTOMBLUE);
  				dateAvailable3.date = "<?=date('Y-m-d');?>";
				dateAvailable3.writeControl();
				dateAvailable3.dateFormat="yyyy-MM-dd";
			</script>
			<br>&nbsp;
	<script language="javascript">
	var dateAvailable4 = new ctlSpiffyCalendarBox("dateAvailable4", "busqueda_archivo", "fechaFinf","btnDate1","<?=$fechaFinf?>",scBTNMODE_CUSTOMBLUE);
  				dateAvailable4.date = "<?=date('Y-m-d');?>";
				dateAvailable4.writeControl();
				dateAvailable4.dateFormat="yyyy-MM-dd";
			</script>
			</td></tr>

<tr><td width="20%" class='titulos2' align="left">RETENCION </td>
<?
	if($buscar_rete == 1) $datoss = "checked"; else $datoss= "";
?>
<td width="20%" class='titulos2'> AG <input name="buscar_rete" type="checkbox" class="select" value="1" <?=$datoss?>> &nbsp;&nbsp;
<?
	if($buscar_rete == 2) $datoss = "checked"; else $datoss= "";
?>
AC <input name="buscar_rete" type="checkbox" class="select" value="2" <?=$datoss?>>
<!--input type=text name=buscar_rete value='<?=$buscar_rete?>' class="tex_area" size=3 maxlength="2"></td-->
<!--td width="20%" class='titulos2'>CAJA </td>
<td width="20%" class='titulos2'><input type=text name=buscar_caja value='<?=$buscar_caja?>' class="tex_area" size=3 maxlength="2"></td-->
</tr>
<tr><td colspan="2" align="right"><input type=submit value=Buscar name=Buscar class="botones">&nbsp;</td>
<td colspan="2" align="left"><a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'><input name='Regresar' align="middle" type="button" class="botones" id="envia22" value="Regresar" ></td>
</table>
<br>
<?
if($Buscar){

?>
<table border=0 width 100% cellpadding="1"  class="borde_tab">
<TD class=titulos5 >RADICADO
<TD class=titulos5 >FECHA RADICADO
<TD class=titulos5 >EXPEDIENTE
<TD class=titulos5 >DOCUMENTO
<TD class=titulos5 >SERIE
<TD class=titulos5 >SUBSERIE
<TD class=titulos5 >PROCESO
<TD class=titulos5 >PARAMETRO 1
<TD class=titulos5 >PARAMETRO 2
<TD class=titulos5 >PARAMETRO 3
<TD class=titulos5 >PARAMETRO 5
<TD class=titulos5 >FOLIOS
<TD class=titulos5 >
<TD class=titulos5 >
<TD class=titulos5 >
<TD class=titulos5 >
<TD class=titulos5 >
<TD class=titulos5 >
<TD class=titulos5 >
<TD class=titulos5 >
<TD class=titulos5 >UNIDAD DOCUMENTAL
<TD class=titulos5 >FECHA ARCHIVO
<TD class=titulos5 >FECHA FINAL
</tr>

<?
$perm2=0;
if($buscar_exp!=""){$x="e.SGD_EXP_NUMERO LIKE '%$buscar_exp%'";$a="and";$perm2=1;}
else {$x="";$a="";}
if($buscar_rad!=""){$r="e.RADI_NUME_RADI LIKE '%$buscar_rad%'";$b="and";$perm2=1;}
else {$r="";$b="";}
if($codserie!='0'){$srds="s.SGD_SRD_CODIGO LIKE '$codserie'";$c="and";$perm2=1;}
else {$srds="";$c="";}
if($codiSBRD!='0'){$sbrds="s.SGD_SBRD_CODIGO LIKE '$codiSBRD'";$d="and";$perm2=1;}
else {$sbrds="";$d="";}
if($codProc!='0'){$pross="s.SGD_PEXP_CODIGO LIKE '$codProc'";$ef="and";$perm2=1;}
else{$pross="";$ef="";}
if($buscar_ufisica!=""){
if($item2=="ENTREPANO" or $item2=="ENTREPA\D1O"){$ufisica="e.SGD_EXP_ENTREPA LIKE '$buscar_ufisica'";$t3="and";}
elseif($item2=="CAJA"){$ufisica="e.SGD_EXP_CAJA LIKE '$buscar_ufisica'";$t3="and";}
}
else {$ufisica="";$t3="";}
if($buscar_estan!=""){
if($item3=="ENTREPANO" or $item3=="ENTREPA\D1O"){$estan="e.SGD_EXP_ENTREPA LIKE '$buscar_estan'";$t2="and";}
elseif($item3=="CAJA"){$estan="e.SGD_EXP_CAJA LIKE '$buscar_estan'";$t2="and";}
}
else {$estan="";$t2="";}
if($buscar_entre!=""){
if($item4=="ENTREPANO" or $item4=="ENTREPA\D1O"){$entre="e.SGD_EXP_ENTREPA LIKE '$buscar_entre'";$t1="and";}
elseif($item4=="CAJA"){$entre="e.SGD_EXP_CAJA LIKE '$buscar_entre'";$t1="and";}
}
else {$entre="";$t1="";}
if($buscar_caja!=""){
if($item5=="ENTREPANO" or $item5=="ENTREPA\D1O"){$caja="e.SGD_EXP_ENTREPA LIKE '$buscar_caja'";$t="and";}
elseif($item5=="CAJA"){$caja="e.SGD_EXP_CAJA LIKE '$buscar_caja'";$t="and";}
}
else {$caja="";$t="";}
if($buscar_caja2!=""){
if($item6=="ENTREPANO" or $item6=="ENTREPA\D1O"){$caja2="e.SGD_EXP_ENTREPA LIKE '$buscar_caja2'";$u1="and";}
elseif($item6=="CAJA"){$caja2="e.SGD_EXP_CAJA LIKE '$buscar_caja2'";$u1="and";}
}
else {$caja2="";$u1="";}
if($exp_edificio!=""){
$edifi="e.SGD_EXP_EDIFICIO LIKE '$exp_edificio'";
$edi="and";
}
else {$edifi="";$edi="";}
if ($sep=='1'){
	if($fechaInii==$fechaInif){$fecha="e.SGD_EXP_FECH_ARCH like '$fechaInii'";}
	else{
	$time=fnc_date_calcy($fechaInif,'1');
	$fecha="e.SGD_EXP_FECH_ARCH <= '$time' and e.SGD_EXP_FECH_ARCH >= '$fechaInii'";
	}
	$perm2=1;
	$i="and";
}
else {$fecha="";$fech="";$i="";}
if ($sel1=='1'){
	if($fechaFini==$fechaFinf){$fechafin="e.SGD_EXP_FECHFIN like '$fechaFini'";}
	else{
		$time2=fnc_date_calcy($fechaFinf,'1');
		$fechafin="e.SGD_EXP_FECHFIN <= '$time2' and e.SGD_EXP_FECHFIN >= '$fechaFini'";
	}
	$perm2=1;
	$j="and";
}
else {$fechafin="";$fechfin="";$j="";}
if($buscar_rete!=""){$foli="e.SGD_EXP_RETE LIKE '$buscar_rete'";$k="and";$perm2=1;}
else {$foli="";$k="";}
if($buscar_parametros!=""){$param="s.SGD_SEXP_PAREXP1 LIKE '%$buscar_parametros%' OR s.SGD_SEXP_PAREXP2 LIKE
'%$buscar_parametros%' OR s.SGD_SEXP_PAREXP3 LIKE '%$buscar_parametros%' OR s.SGD_SEXP_PAREXP4 LIKE '%$buscar_parametros%'
OR s.SGD_SEXP_PAREXP5 LIKE '%$buscar_parametros%'";$l="and";$perm2=1;}
else {$param="";$l="";}
if($buscar_consecutivo!=""){$conse="e.SGD_EXP_CARPETA LIKE '$buscar_consecutivo'";$n="and";$perm2=1;}
else {$conse="";$n="";}
if($codMuni!='0'){
		$queryMuni = "select MUNI_NOMB FROM MUNICIPIO WHERE MUNI_CODI= '$codMuni' and DPTO_CODI= '$codDpto'";
		$rsm=$db->query($queryMuni);
 		$munici=$rsm->fields['MUNI_NOMB'];
	$muni="(s.SGD_SEXP_PAREXP1 LIKE '%$munici%' OR s.SGD_SEXP_PAREXP2 LIKE '%$munici%' OR s.SGD_SEXP_PAREXP3
	LIKE '%$munici%' OR s.SGD_SEXP_PAREXP4 LIKE '%$munici%' OR s.SGD_SEXP_PAREXP5 LIKE '%$munici%')";$p="and";
	$perm2=1;
}
else {$muni="";$p="";}
if($codDpto!='0'){
	$queryDpto = "select DPTO_NOMB FROM DEPARTAMENTO WHERE DPTO_CODI= '$codDpto'";
 		$rsD=$db->query($queryDpto);
		$departa=$rsD->fields['DPTO_NOMB'];
	$depa="(s.SGD_SEXP_PAREXP1 LIKE '%$departa%' OR s.SGD_SEXP_PAREXP2 LIKE '%$departa%' OR s.SGD_SEXP_PAREXP3
	LIKE '%$departa%' OR s.SGD_SEXP_PAREXP4 LIKE '%$departa%' OR s.SGD_SEXP_PAREXP5 LIKE '%$departa%')";$q="and";$perm2=1;}
else {$depa="";$q="";}
if ($fecha!="" or $fechafin!="")$orde=" order by 2";
else $orde=" order by 1";

$at=$buscar_exp.$buscar_rad.$buscar_piso.$buscar_caja.$buscar_estante.$buscar_caja.$buscar_caja2.$buscar_rete.$fecha.$fechafin.$buscar_parametros.
$buscar_consecutivo.$buscar_ufisica.$codserie.$codiSBRD.$codProc;
$bt=$buscar_exp.$buscar_rad.$buscar_piso.$buscar_caja.$buscar_estante.$buscar_caja.$buscar_caja2.$buscar_rete.$fecha.$fechafin.$buscar_parametros.
$buscar_consecutivo.$buscar_ufisica.$codMuni.$codDpto;
$cont=0;


if(($buscar_docu!="" and $at=='000')){
	include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
	$rs=$db->query($sqlca);
	while (!$rs->EOF){
		$radi=$rs->fields["RAD"];
	 	$fechrad=$rs->fields['FECH'];
	 	$path=$rs->fields['RADI_PATH'];
		$folios=$rs->fields['RADI_NUME_HOJA'];
		if($docu1!=0)$perm2=1;
	 	if($docu1==3)$documento=$rs->fields['RADI_CUENTAI'];
	 	if ($docu1==1){$documento=$rs->fields['NIT_DE_LA_EMPRESA'];$perm6=1;}
 		else $documento=$rs->fields['SGD_DIR_DOC'];
 	include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
	$rsr=$db->query($sqlmin);
	while (!$rsr->EOF){
	$expnum=$rsr->fields['SGD_EXP_NUMERO'];
	$parametro1=$rsr->fields['SGD_SEXP_PAREXP1'];
	$parametro2=$rsr->fields['SGD_SEXP_PAREXP2'];
	$parametro3=$rsr->fields['SGD_SEXP_PAREXP3'];
	$parametro4=$rsr->fields['SGD_SEXP_PAREXP5'];
	$edificio=$rsr->fields['SGD_EXP_EDIFICIO'];
	$fech=$rsr->fields['SGD_EXP_FECH_ARCH'];
	$fechfin=$rsr->fields['SGD_EXP_FECHFIN'];
	$caja1=$rsr->fields['SGD_EXP_CAJA'];
	$consecu=$rsr->fields['SGD_EXP_CARPETA'];
	$entrepa1=$rsr->fields['SGD_EXP_ENTREPA'];
	$srd=$rsr->fields['SGD_SRD_CODIGO'];
	$sbrd=$rsr->fields['SGD_SBRD_CODIGO'];
	$proceso=$rsr->fields['SGD_PEXP_CODIGO'];
	if(($caja1=="" or $caja1==0) and $entrepa1!="")$bus=$entrepa1;
		else $bus=$caja1;
		$qpri=$db->conn->Execute("select SGD_EIT_COD_PADRE from SGD_EIT_ITEMS where sgd_eit_codigo = '$bus'");
		if(!$qpri->EOF){
			$it1=$qpri->fields['SGD_EIT_COD_PADRE'];
			$qsec=$db->conn->Execute("select SGD_EIT_COD_PADRE from SGD_EIT_ITEMS where sgd_eit_codigo = '$it1'");
			if(!$qsec->EOF){
				$it2=$qsec->fields['SGD_EIT_COD_PADRE'];
				$qtir=$db->conn->Execute("select SGD_EIT_COD_PADRE from SGD_EIT_ITEMS where sgd_eit_codigo = '$it2'");
				if(!$qtir->EOF){
					$it3=$qtir->fields['SGD_EIT_COD_PADRE'];
					$qcua=$db->conn->Execute("select SGD_EIT_COD_PADRE from SGD_EIT_ITEMS where sgd_eit_codigo = '$it3'");
					if(!$qcua->EOF){
						$it4=$qcua->fields['SGD_EIT_COD_PADRE'];
						$qqin=$db->conn->Execute("select SGD_EIT_COD_PADRE from SGD_EIT_ITEMS where sgd_eit_codigo = '$it4'");
						if(!$qqin->EOF){
							$it5=$qqin->fields['SGD_EIT_COD_PADRE'];
							$qsex=$db->conn->Execute("select SGD_EIT_COD_PADRE from SGD_EIT_ITEMS where sgd_eit_codigo = '$it5'");
							if(!$qsex->EOF){
								$it6=$qsex->fields['SGD_EIT_COD_PADRE'];
								$qset=$db->conn->Execute("select SGD_EIT_COD_PADRE from SGD_EIT_ITEMS where sgd_eit_codigo = '$it6'");
								if(!$qset->EOF){
									$it7=$qset->fields['SGD_EIT_COD_PADRE'];
								}
							}
						}
					}
				}	
			}
		}
		$perm=0;$perm3=0;$perm4=0;$perm5=0;
		if($it7 and $it7==$exp_edificio){
		$ite1=$it6;$ite2=$it5;$ite3=$it4;$ite4=$it3;$ite5=$it2;$ite6=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3 or $buscar_entre==$ite4 or $buscar_entre==$ite5 or $buscar_entre==$ite6)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3 or $buscar_estan==$ite4 or $buscar_estan==$ite5 or $buscar_estan==$ite6)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3 or $buscar_ufisica==$ite4 or $buscar_ufisica==$ite5 or $buscar_ufisica==$ite6)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3 or $buscar_piso==$ite4 or $buscar_piso==$ite5 or $buscar_piso==$ite6)$perm5=4;
		}
		if($it6 and $it6==$exp_edificio){
		$ite1=$it5;$ite2=$it4;$ite3=$it3;$ite4=$it2;$ite5=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3 or $buscar_entre==$ite4 or $buscar_entre==$ite5)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3 or $buscar_estan==$ite4 or $buscar_estan==$ite5)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3 or $buscar_ufisica==$ite4 or $buscar_ufisica==$ite5)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3 or $buscar_piso==$ite4 or $buscar_piso==$ite5)$perm5=4;
		}
		if($it5 and $it5==$exp_edificio){
		$ite1=$it4;$ite2=$it3;$ite3=$it2;$ite4=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3 or $buscar_entre==$ite4)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3 or $buscar_estan==$ite4)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3 or $buscar_ufisica==$ite4)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3 or $buscar_piso==$ite4)$perm5=4;
		}
		if($it4 and $it4==$exp_edificio){$ite1=$it3;$ite2=$it2;$ite3=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3)$perm5=4;
		}
		
		
	include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
	$rst=$db->query($sql2);
	if(!$rsr->EOF)$nam1=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql3);
		if(!$rsr->EOF)$nam2=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql4);
		if(!$rsr->EOF)$nam3=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql13);
		if(!$rsr->EOF)$nam0=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql14);
		if(!$rsr->EOF)$nam7=$rsr->fields["SGD_EIT_SIGLA"];
		if($ite4){$rsr=$db->query($sql5);
		if(!$rsr->EOF)$nam4=$rsr->fields["SGD_EIT_SIGLA"];}
		if($ite5){$rsr=$db->query($sql10);
		if(!$rsr->EOF)$nam5=$rsr->fields["SGD_EIT_SIGLA"];}
		if($ite6){$rsr=$db->query($sql11);
		if(!$rsr->EOF)$nam6=$rsr->fields["SGD_EIT_SIGLA"];}
	if(($exp_edificio!="" and (($perm==1 and $perm3==2) or ($perm3==2 and $perm4==3) or ($perm4==3 and $perm5==4) or $perm5==4)) or $perm2==1){
	if(($buscar_estan!="" and $perm3==2) or ($buscar_entre!="" and $perm==1) or $buscar_estan=="" or $buscar_entre=="" or $perm2==1){
	if(($docu1==1 and $perm6==1) or $buscar_docu=="" or $docu1==0 or $perm2==1){
?>
<tr>

<td class=leidos2 align="center"><a href='../bodega<?=$path?>' > <?=$radi?></b></td>
<td class=leidos2 align="center"><a href='../verradicado.php?<?=$encabezado."&num_expediente=$expnum&verrad=$radi&carpeta_per=0&carpeta=8&nombcarpeta=Expedientes"?>' > <? echo $fechrad;?></a></td>
<td class=leidos2 align="center"><a href='datos_expediente.php?<?=$encabezado."&num_expediente=$expnum&ent=1&nurad=$radi"?>' class='vinculos'><?=$expnum?></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$documento?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$srd?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$sbrd?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$proceso?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro1?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro2?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro3?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro4?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$folios?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam0?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam1?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam2?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam3?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam4?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam5?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam6?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$nam7?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$consecu?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$fech?></b></td>
<td class=leidos2 align="center"><b><span class=leidos2><?=$fechfin?></b></td>

</tr>
<?
$cont++;
}
}
}
$rsr->MoveNext();
	}
		$rs->MoveNext();

	}
}

else{

	include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
	/*$linkPagina = "$PHP_SELF?$encabezadol&orde=$orde&orderNo=$orderNo";
$orderNo=1;
$orderTipo="";
	 $pager = new ADODB_Pager( $db, $sql, 'adodb', true, $orderNo, $orderTipo );
    $pager->checkAll = false;
    $pager->checkTitulo = true;
    $pager->toRefLinks = $linkPagina;
    $pager->toRefVars = $encabezadol;
    $pager->descCarpetasGen = $descCarpetasGen;
    $pager->descCarpetasPer = $descCarpetasPer;
    $pager->Render( $rows_per_page = 20, $linkPagina, $checkbox = chkAnulados );
	*/$rs=$db->query($sql);
	while(!$rs->EOF){
		$expnum=$rs->fields['SGD_EXP_NUMERO'];
		$sbrd=$rs->fields['SGD_SBRD_CODIGO'];
		$srd=$rs->fields['SGD_SRD_CODIGO'];
		$proceso=$rs->fields['SGD_PEXP_CODIGO'];
		$parametro1=$rs->fields['SGD_SEXP_PAREXP1'];
		$parametro2=$rs->fields['SGD_SEXP_PAREXP2'];
		$parametro3=$rs->fields['SGD_SEXP_PAREXP3'];
		$parametro4=$rs->fields['SGD_SEXP_PAREXP5'];
		$fech=$rs->fields['SGD_EXP_FECH_ARCH'];
		$fechfin=$rs->fields['SGD_EXP_FECHFIN'];
		$folios=$rs->fields['RADI_NUME_HOJA'];
		$caja1=$rs->fields['SGD_EXP_CAJA'];
		$edificio=$rs->fields['SGD_EXP_EDIFICIO'];
		$radi=$rs->fields["RADI_NUME_RADI"];
		$consecu=$rs->fields['SGD_EXP_CARPETA'];
		$entrepa1=$rs->fields['SGD_EXP_ENTREPA'];
		$fechrad=$rs->fields['FECH'];
		$path=$rs->fields['RADI_PATH'];
		$eesp=$rs->fields['EESP_CODI'];
		if(($caja1=="" or $caja1==0) and $entrepa1!="")$bus=$entrepa1;
		else $bus=$caja1;
		$qpri=$db->conn->Execute("select sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$bus'");
		if(!$qpri->EOF){
			$it1=$qpri->fields['SGD_EIT_COD_PADRE'];
			$qsec=$db->conn->Execute("select sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$it1'");
			if(!$qsec->EOF){
				$it2=$qsec->fields['SGD_EIT_COD_PADRE'];
				$qtir=$db->conn->Execute("select sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$it2'");
				if(!$qtir->EOF){
					$it3=$qtir->fields['SGD_EIT_COD_PADRE'];
					$qcua=$db->conn->Execute("select sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$it3'");
					if(!$qcua->EOF){
						$it4=$qcua->fields['SGD_EIT_COD_PADRE'];
						$qqin=$db->conn->Execute("select sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$it4'");
						if(!$qqin->EOF){
							$it5=$qqin->fields['SGD_EIT_COD_PADRE'];
							$qsex=$db->conn->Execute("select sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$it5'");
							if(!$qsex->EOF){
								$it6=$qsex->fields['SGD_EIT_COD_PADRE'];
								$qset=$db->conn->Execute("select sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$it6'");
								if(!$qset->EOF){
									$it7=$qset->fields['SGD_EIT_COD_PADRE'];
								}
							}
						}
					}
				}	
			}
		}
		$perm=0;$perm3=0;$perm4=0;$perm5=0;
		if($it7 and $it7==$exp_edificio){
		$ite1=$it6;$ite2=$it5;$ite3=$it4;$ite4=$it3;$ite5=$it2;$ite6=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3 or $buscar_entre==$ite4 or $buscar_entre==$ite5 or $buscar_entre==$ite6)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3 or $buscar_estan==$ite4 or $buscar_estan==$ite5 or $buscar_estan==$ite6)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3 or $buscar_ufisica==$ite4 or $buscar_ufisica==$ite5 or $buscar_ufisica==$ite6)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3 or $buscar_piso==$ite4 or $buscar_piso==$ite5 or $buscar_piso==$ite6)$perm5=4;
		}
		if($it6 and $it6==$exp_edificio){
		$ite1=$it5;$ite2=$it4;$ite3=$it3;$ite4=$it2;$ite5=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3 or $buscar_entre==$ite4 or $buscar_entre==$ite5)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3 or $buscar_estan==$ite4 or $buscar_estan==$ite5)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3 or $buscar_ufisica==$ite4 or $buscar_ufisica==$ite5)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3 or $buscar_piso==$ite4 or $buscar_piso==$ite5)$perm5=4;
		}
		if($it5 and $it5==$exp_edificio){
		$ite1=$it4;$ite2=$it3;$ite3=$it2;$ite4=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3 or $buscar_entre==$ite4)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3 or $buscar_estan==$ite4)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3 or $buscar_ufisica==$ite4)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3 or $buscar_piso==$ite4)$perm5=4;
		}
		if($it4 and $it4==$exp_edificio){$ite1=$it3;$ite2=$it2;$ite3=$it1;
		if($buscar_entre==$ite1 or $buscar_entre==$ite2 or $buscar_entre==$ite3)$perm=1;
		if($buscar_estan==$ite1 or $buscar_estan==$ite2 or $buscar_estan==$ite3)$perm3=2;
		if($buscar_ufisica==$ite1 or $buscar_ufisica==$ite2 or $buscar_ufisica==$ite3)$perm4=3;
		if($buscar_piso==$ite1 or $buscar_piso==$ite2 or $buscar_piso==$ite3)$perm5=4;
		}
		
		include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
		if($docu1==1){
			$rsm=$db->query($sqld);
			if(!$rsm->EOF){$documento=$rsm->fields['NIT_DE_LA_EMPRESA'];echo $perm6=1;}
		}
		if($docu1==3)$documento=$rs->fields['RADI_CUENTAI'];
		else $documento=$rs->fields['SGD_DIR_DOC'];

		include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
		$rsr=$db->conn->Execute($sql2);
		if($rsr->EOF){$nam1=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql3);
		if($rsr->EOF){$nam2=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql4);
		if($rsr->EOF){$nam3=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql13);
		if($rsr->EOF){$nam0=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql14);
		}
		}
		}
		}
		if(!$rsr->EOF)$nam7=$rsr->fields["SGD_EIT_SIGLA"];
		if($ite4){$rsr=$db->query($sql5);
		if(!$rsr->EOF)$nam4=$rsr->fields["SGD_EIT_SIGLA"];}
		if($ite5){$rsr=$db->query($sql10);
		if(!$rsr->EOF)$nam5=$rsr->fields["SGD_EIT_SIGLA"];}
		if($ite6){$rsr=$db->query($sql11);
		if(!$rsr->EOF)$nam6=$rsr->fields["SGD_EIT_SIGLA"];}
		//echo $perm."dff".$perm3."dff".$perm4."dff".$perm5."dff";
		if($exp_edificio!="")$perm2=1;
	if(($exp_edificio!="" and (($perm==1 and $perm3==2) or ($perm3==2 and $perm4==3) or ($perm4==3 and $perm5==4) or $perm5==4)) or $perm2==1){
	if(($buscar_estan!="" and $perm3==2) or ($buscar_entre!="" and $perm==1) or $buscar_estan=="" or $buscar_entre=="" or $perm2==1){
	if(($docu1==1 and $perm6==1) or $buscar_docu=="" or $docu1==0 or $perm2==1){
		?>
		<tr>

		<td class=leidos2 align="center"><a href='../bodega<?=$path?>' > <?=$radi?></b></td>
		<td class=leidos2 align="center"><a href='../verradicado.php?<?=$encabezado."&num_expediente=$expnum&verrad=$radi&carpeta_per=0&carpeta=8&nombcarpeta=Expedientes"?>' > <? echo $fechrad;?></a></td>
	<td class=leidos2 align="center"><a href='datos_expediente.php?<?=$encabezado."&num_expediente=$expnum&ent=1&nurad=$radi"?>' class='vinculos'><?=$expnum?></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$documento?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$srd?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$sbrd?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$proceso?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro1?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro2?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro3?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$parametro4?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$folios?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam0?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam1?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam2?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam3?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam4?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam5?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam6?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$nam7?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$consecu?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$fech?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$fechfin?></b></td>
		</tr>

		<?
		//$rsm->MoveNext();
		$cont++;
		}
		}
		}
	$rs->MoveNext();

	}
}
}?>
</table>
<br>
<center><?=$cont?> Archivos Encontrados</center>
