<? session_start();
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
<title>Busqueda Archivo Central</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">


 </script>



<form name=busqueda_central action="<?=$encabezadol?>" method='post' action='busqueda_central.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'>
<br>

<table border=0 width="90%" cellpadding="0"  class="borde_tab">
  <td class=titulosError  width="80%" colspan="4" align="center">BUSQUEDA ARCHIVO CENTRAL </td>

<? // parametrizacion de items
	/*include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql1);
	$item11=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item11);
	$item1=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql6);
	$item31=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item31);
	$item3=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql7);
	$item41=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item41);
	$item4=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql8);
	$item51=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item51);
	$item5=$tm[0];
	include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	$rs=$db->query($sql9);
	$item61=$rs->fields["SGD_EIT_NOMBRE"];
	$tm=explode('1',$item61);
	$item6=$tm[0];*/
	$item1="CARRO";
	$item3="CARA";
	$item4="CUERPO";
	$item5="ENTREPANO";
	$item6="CAJA";
?>
<tr>
<td width="20%" class='titulos2' align="left">&nbsp;SERIE </td>
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
	<td width="20%" class='titulos2' align="left"> SUBSERIE </td>
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
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,""," class='select'" );

	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD =$tsub;
	}

	?>
	</tr>
	<tr>
	<td width="20%" class='titulos2' align="left">TIPO</td>
	<td width="20%" class='titulos2'>
	<?
		$queryt="select sgd_pexp_descrip,sgd_pexp_codigo from sgd_pexp_procexpedientes";
		if($codserie!=0)$queryt.=" where sgd_srd_codigo = ".$codserie;
		$queryt.=" order by sgd_pexp_descrip";
		$rsTip=$db->conn->Execute($queryt);
		print $rsTip->GetMenu2("tip", $tip, "0:-- Seleccione --", false,""," class='select' " );
	?>
	</td>
	<?
switch($codserie){
	case '1':
		$titu="NRO DE EXPEDIENTE";
		$titu2="TITULO";
		$titu3="NRO CONSECUTIVO";
		$titu4="A&Ntilde;O";
		$titu5="";
		break;
	case '2':
		$titu="NRO DE EXPEDIENTE";
		$titu2="QUERELLADO";
		$titu3="QUERELLANTE";
		$titu4="A&Ntilde;O";
		$titu5="AUTO DE ARCHIVO";
		break;
	case '3':
		$titu="NRO CONTRATO";
		$titu2="CONTRATISTA";
		$titu3="OBJETO CONTRACTUAL";
		$titu4="VIGENCIA";
		$titu5="ACTA DE LIQUIDACION";
		break;
	default:
		$titu="NRO DE DOCUMENTO ";
		$titu2="TITULO";
		$titu3="REMITENTE";
		$titu4="A&Ntilde;O";
		$titu5="";
		break;
}
?>
	<td width="20%" class='titulos2' align="left"><?=$titu5?></td>
<td width="20%" class='titulos2'><input type=text name=fechaa value='<?=$fechaa?>' class="tex_area">
	</tr>
<tr>
<td width="20%" class='titulos2' align="left"><?=$titu?> </td>
	<td width="20%" class='titulos2'><input type=text name=buscar_orden value='<?=$buscar_orden?>' class="tex_area">
    </td>
    <td width="20%" class='titulos2' align="left"> RADICADO </td>
	<td width="20%" class='titulos2'><input type=text name=buscar_rad value='<?=$buscar_rad?>' class="tex_area">
	</td>
	</tr>
	<tr><td width="20%" class='titulos2' align="left"><?=$titu2?></td>
<td width="20%" class='titulos2'><input type=text name=buscar_deman value='<?=$buscar_deman?>' class="tex_area"></td>
<td width="20%" class='titulos2'><?=$titu3?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_demant value='<?=$buscar_demant?>' class="tex_area" ></td></tr>
<tr><td width="20%" class='titulos2' align="left"> FECHA INICIAL &nbsp;&nbsp;&nbsp;&nbsp;  Desde  <br>&nbsp;&nbsp;&nbsp;
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
	 	if(!$fechaIni) $fechaIni=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif) $fechaInif = date('Y-m-d');
  	?>
   	var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "busqueda_central", "fechaIni","btnDate1","<?=$fechaIni?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable1.date = "<?=date('Y-m-d');?>";
	dateAvailable1.writeControl();
	dateAvailable1.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "busqueda_central", "fechaInif","btnDate2","<?=$fechaInif?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable2.date = "<?=date('Y-m-d');?>";
	dateAvailable2.writeControl();
	dateAvailable2.dateFormat="yyyy-MM-dd";
	</script>

            </td>
	    <td width="20%" class='titulos2' align="left"> FECHA FINAL &nbsp;&nbsp;&nbsp;&nbsp;  Desde  <br>&nbsp;&nbsp;&nbsp;
            <?
			if($sep2 == 1) $datoss2 = "checked"; else $datoss2= "";
			?>
            <input name="sep2" type="checkbox" class="select" value="1" <?=$datoss2?>>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta
            </td>
	<td width="20%" class='titulos2'>
	<script language="javascript">
  	<?
	 	if(!$fechaIni2) $fechaIni2=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif2) $fechaInif2 = date('Y-m-d');
  	?>
   	var dateAvailable3 = new ctlSpiffyCalendarBox("dateAvailable3", "busqueda_central", "fechaIni2","btnDate3","<?=$fechaIni2?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable3.date = "<?=date('Y-m-d');?>";
	dateAvailable3.writeControl();
	dateAvailable3.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable4 = new ctlSpiffyCalendarBox("dateAvailable4", "busqueda_central", "fechaInif2","btnDate4","<?=$fechaInif2?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable4.date = "<?=date('Y-m-d');?>";
	dateAvailable4.writeControl();
	dateAvailable4.dateFormat="yyyy-MM-dd";
	</script>

            </td></tr>
	    
	<tr><td width="20%" class='titulos2' align="left">OBSERVACIONES </td>
	<td width="20%" class='titulos2'><input type=text name=anexo value='<?=$anexo?>' class="tex_area">
<?
  switch($codserie){
  	case '300': $proc=1;
		break;
  	default: $proc=2;
		break;
  }
  ?>
          	  </td>
	  <td width="20%" class='titulos2'>DEPENDENCIA </td>
   <TD width="20%" class='titulos2' >
				<? 
				$conD=$db->conn->Concat("d.DEPE_CODI","'-'","d.DEPE_NOMB");
				$sql5="select distinct($conD) as detalle,d.DEPE_CODI from DEPENDENCIA d ";
				if($codserie!='0')$sql5.=" , SGD_MRD_MATRIRD m where m.depe_codi=d.depe_codi and m.sgd_srd_codigo='$codserie'";
				$sql5.=" order by d.DEPE_CODI";
				//$db->conn->debug=true;
				$rs=$db->conn->Execute($sql5);
				print $rs->GetMenu2('depen',$depen,true,false,"","class=select");
				?>
</td>
	</tr>
    	<tr> 
	<td width="20%" class='titulos2' align="left"><?=$titu4?></td>
	<td width="20%" class='titulos2'>
	<select class="select" name="buscar_ano">
          <?
	$agnoactual=Date('Y');
	for($i = 1986; $i <= $agnoactual; $i++)
	{
		if($i == $buscar_ano) $option="<option SELECTED value=\"" . $buscar_ano . "\">" . $buscar_ano . "</option>";
		elseif($i == 1986)$option="<option value=\"\"> TODOS</option>";
		else $option="<option value=\"" . $i . "\">" . $i . "</option>";
		echo $option;
	}
	?>
          </select>
	  <input type="hidden" name="yea" value="<?=$buscar_ano?>">
	</td>
	<td width="20%" class='titulos2' align="left">DOCUMENTO DE IDENTIDAD
	</td>
   <td width="20%" class='titulos2'><input type=text name=buscar_docu value='<?=$buscar_docu?>' class="tex_area">
   </td></tr>
<tr><td width="20%" class='titulos2' align="left">ZONA </td>
<td width="20%" class='titulos2'><input type=text name=buscar_zona value='<?=$buscar_zona?>' class="tex_area" size=4 maxlength="3"></td>
<?/*
$edi=$db->conn->Execute("select sgd_eit_codigo from sgd_eit_items where sgd_eit_nombre like 'central' or sgd_eit_nombre like 'CENTRAL' ");
$edi1=$edi->fields['SGD_EIT_CODIGO'];
  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$edi1'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_zona',$buscar_zona,true,false,"","onChange='submit()' class=select");*/
  ?>

<td width="20%" class='titulos2'><?=$item1?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_carro value='<?=$buscar_carro?>' class="tex_area" size=4 maxlength="3"></td>
<?/*
				$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_zona'";
				$rs=$db->query($sql);
				print $rs->GetMenu2('buscar_carro',$buscar_carro,true,false,"","onChange='submit()'  class=select");
   		    	*/?>
</td></tr>

<tr><td width="20%" class='titulos2' align="left"><?=$item3?> </td>
<?
if($buscar_cara=="A")$sec1="checked";
elseif($buscar_cara=="B")$sec2="checked";
else $sec3="checked";
?>
<td width="20%" class='titulos2'><input type="radio" name="buscar_cara" value="A" <?=$sec1?>>A &nbsp;
<input type="radio" name="buscar_cara" value="B" <?=$sec2?>>B &nbsp;
<input type="radio" name="buscar_cara" value="" <?=$sec3?>>Ninguno &nbsp;</td>
<?
/*
  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_carro'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_cara',$buscar_cara,true,false,"","onChange='submit()' class=select");
  */?>

<td width="20%" class='titulos2'><?=$item4?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_estante value='<?=$buscar_estante?>' class="tex_area" size=6 maxlength="5"></td>
<?/*
		$sql="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_cara'";
		$rs=$db->query($sql);
		print $rs->GetMenu2('buscar_estante',$buscar_estante,true,false,"","onChange='submit()' class=select");
	*/?>
</td></tr>
<tr><td width="20%" class='titulos2' align="left"><?=$item5?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_entre value='<?=$buscar_entre?>' class="tex_area" size=6 maxlength="5"></td>
<?/*

  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_estante'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_entre',$buscar_entre,true,false,"","onChange='submit()' class=select");
  */?>
  <td width="20%" class='titulos2' align="left"><?=$item6?> </td>
<td width="20%" class='titulos2'><input type=text name=buscar_caja value='<?=$buscar_caja?>' class="tex_area" size=6 maxlength="5"></td>
<?
/*
  $query="select SGD_EIT_NOMBRE,SGD_EIT_CODIGO from SGD_EIT_ITEMS where SGD_EIT_COD_PADRE LIKE '$buscar_entre'";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('buscar_caja',$buscar_caja,true,false,"","onChange='submit()' class=select");
  */?>
  </tr>

	    <tr>
	    <td width="20%" class='titulos2' align="left">INDICADORES DE DETERIORO </td>
<td width="20%" class='titulos2'>
  <?
switch($buscar_inder){
  	case 1: $sele1="selected";
		break;
  	case 2: $sele2="selected";
		break;
	case 3: $sele3="selected";
		break;
	case 4: $sele4="selected";
		break;
	case 5: $sele5="selected";
		break;
	case 6: $sele48="selected";
		break;
	case 7: $sele49="selected";
		break;
	case 8: $sele50="selected";
		break;
	case 9: $sele51="selected";
		break;
	case 10: $sele52="selected";
		break;
	case 11: $sele53="selected";
		break;
	case 12: $sele54="selected";
		break;
	case 13: $sele55="selected";
		break;
	case 14: $sele56="selected";
		break;
	case 15: $sele57="selected";
		break;
	case 16: $sele58="selected";
		break;
	case 17: $sele59="selected";
		break;	
	case 18: $sele60="selected";
		break;
	case 19: $sele61="selected";
		break;
	case 20: $sele62="selected";
		break;
	case 21: $sele63="selected";
		break;
	default: $sele0="selected";
		break;
		}
  ?>
          <select class="select" name="buscar_inder">
	  <option value="0" <?=$sele0?>>Ninguno</option>
	<option value="1" <?=$sele1?>>Biologicos: Hongos</option>
	<option value="2" <?=$sele2?>>Biologicos: Roedores</option>
	<option value="3" <?=$sele3?>>Biologicos: Insectos</option>
	<option value="4" <?=$sele4?>>Decoloracion Soporte</option>
	<option value="5" <?=$sele5?>>Desgarros</option>
	<option value="6" <?=$sele48?>>Biologicos: Hongos y Biologicos: Roedores</option>
	<option value="7" <?=$sele49?>>Biologicos: Hongos y Biologicos: Insectos</option>
	<option value="8" <?=$sele50?>>Biologicos: Hongos y Decoloracion Soporte</option>
	<option value="9" <?=$sele51?>>Biologicos: Hongos y Desgarros</option>
	<option value="10" <?=$sele52?>>Biologicos: Roedores y Biologicos: Insectos</option>
	<option value="11" <?=$sele53?>>Biologicos: Roedores y Decoloracion Soporte</option>
	<option value="12" <?=$sele54?>>Biologicos: Roedores y Desgarros</option>
	<option value="13" <?=$sele55?>>Biologicos: Insectos y Decoloracion Soporte</option>
	<option value="14" <?=$sele56?>>Biologicos: Insectos y Desgarros</option>
	<option value="15" <?=$sele57?>>Decoloracion Soporte y Desgarros</option>
	<option value="16" <?=$sele58?>>Biologicos: Hongos, Biologicos: Roedores y Biologicos: Insectos</option>
	<option value="17" <?=$sele59?>>Biologicos: Hongos, Biologicos: Roedores y Decoloracion Soporte</option>
	<option value="18" <?=$sele60?>>Biologicos: Hongos, Biologicos: Roedores y Desgarros</option>
	<option value="19" <?=$sele61?>>Biologicos: Hongos, Biologicos: Insectos y Decoloracion Soporte</option>
	<option value="20" <?=$sele62?>>Biologicos: Hongos, Biologicos: Insectos y Desgarros</option>
	<option value="21" <?=$sele63?>>Biologicos: Hongos, Decoloracion Soporte y Desgarros</option>
	
</select>
</td>
<td width="20%" class='titulos2' align="left">MATERIALES INSERTADOS </td>
<td width="20%" class='titulos2'>
<?
switch($buscar_mata){
  	case 1: $sele7="selected";
		break;
  	case 2: $sele8="selected";
		break;
	case 3: $sele9="selected";
		break;
	case 4: $sele10="selected";
		break;
	case 5: $sele11="selected";
		break;
	case 6: $sele12="selected";
		break;
	case 7: $sele13="selected";
		break;
	case 8: $sele14="selected";
		break;
	case 9: $sele15="selected";
		break;
	case 10: $sele16="selected";
		break;
	case 11: $sele17="selected";
		break;
	case 12: $sele18="selected";
		break;
	case 13: $sele19="selected";
		break;
	case 14: $sele20="selected";
		break;
	case 15: $sele21="selected";
		break;
	case 16: $sele22="selected";
		break;
	case 17: $sele23="selected";
		break;	
	case 18: $sele24="selected";
		break;
	case 19: $sele25="selected";
		break;
	case 20: $sele26="selected";
		break;
	case 21: $sele27="selected";
		break;
	case 22: $sele28="selected";
		break;
	case 23: $sele29="selected";
		break;
	case 24: $sele30="selected";
		break;
	case 25: $sele31="selected";
		break;
	case 26: $sele32="selected";
		break;
	case 27: $sele33="selected";
		break;
	case 28: $sele34="selected";
		break;
	case 29: $sele35="selected";
		break;
	case 30: $sele36="selected";
		break;
	case 31: $sele37="selected";
		break;
	case 32: $sele38="selected";
		break;
	case 33: $sele39="selected";
		break;
	 case 34: $sele40="selected";
		break;
	case 35: $sele41="selected";
		break;
	case 36: $sele42="selected";
		break;
	case 37: $sele43="selected";
		break;
	case 38: $sele44="selected";
		break;
	case 39: $sele45="selected";
		break;
	case 40: $sele46="selected";
		break;
	case 41: $sele47="selected";
		break;
	default: $sele64="selected";
		break;
		}
  ?>
          <select class="select" name="buscar_mata">
	  <option value="0" <?=$sele64?>>Ninguno</option>
	<option value="1" <?=$sele7?>>Metalico</option>
	<option value="2" <?=$sele8?>>Post-it</option>
	<option value="3" <?=$sele9?>>Planos</option>
	<option value="4" <?=$sele10?>>Fotografia</option>
	<option value="5" <?=$sele11?>>Soporte Optico</option>
	<option value="6" <?=$sele12?>>Soporte Magnetico</option>
	<option value="7" <?=$sele13?>>Metalico y Post-it</option>
	<option value="8" <?=$sele14?>>Metalico y Planos </option>
	<option value="9" <?=$sele15?>>Metalico y Fotografia </option>
	<option value="10" <?=$sele16?>>Metalico y Soporte Optico </option>
	<option value="11" <?=$sele17?>>Metalico y Soporte Magnetico </option>
	<option value="12" <?=$sele18?>>Post-it y Planos</option>
	<option value="13" <?=$sele19?>>Post-it y Fotografia</option>
	<option value="14" <?=$sele20?>>Post-it y Soporte Optico</option>
	<option value="15" <?=$sele21?>>Post-it y Soporte Magnetico</option>
	<option value="16" <?=$sele22?>>Planos y Fotografia</option>
	<option value="17" <?=$sele23?>>Planos y Soporte Optico</option>
	<option value="18" <?=$sele24?>>Planos y Soporte Magnetico</option>
	<option value="19" <?=$sele25?>>Fotografia y Soporte Optico</option>
	<option value="20" <?=$sele26?>>Fotografia y Soporte Magnetico</option>
	<option value="21" <?=$sele27?>>Soporte Optico y Soporte Magnetico</option>
	<option value="22" <?=$sele28?>>Metalico, Post-it y Planos</option>
	<option value="23" <?=$sele29?>>Metalico, Post-it y Fotografia</option>
	<option value="24" <?=$sele30?>>Metalico, Post-it y Soporte Optico</option>
	<option value="25" <?=$sele31?>>Metalico, Post-it y Soporte Magnetico</option>
	<option value="26" <?=$sele32?>>Metalico, Planos y Fotografia</option>
	<option value="27" <?=$sele33?>>Metalico, Planos y Soporte Optico</option>
	<option value="28" <?=$sele34?>>Metalico, Planos y Soporte Magnetico</option>
	<option value="29" <?=$sele35?>>Metalico, Fotografia y Soporte Optico</option>
	<option value="30" <?=$sele36?>>Metalico, Fotografia y Soporte Magnetico</option>
	<option value="31" <?=$sele37?>>Metalico, Soporte Optico y Soporte Magnetico</option>
	<option value="32" <?=$sele38?>>Post-it, Planos y Fotografia</option>
	<option value="33" <?=$sele39?>>Post-it, Planos y Soporte Optico</option>
	<option value="34" <?=$sele40?>>Post-it, Planos y Soporte Magnetico</option>
	<option value="35" <?=$sele41?>>Post-it, Fotografia y Soporte Optico</option>
	<option value="36" <?=$sele42?>>Post-it, Fotografia y Soporte Magnetico</option>
	<option value="37" <?=$sele43?>>Post-it, Soporte Optico y Soporte Magnetico</option>
	<option value="38" <?=$sele44?>>Planos, Fotografia y Soporte Optico</option>
	<option value="39" <?=$sele45?>>Planos, Fotografia y Soporte Magnetico</option>
	<option value="40" <?=$sele46?>>Planos, Soporte Optico y Soporte Magnetico</option>
	<option value="41" <?=$sele47?>>Fotografia, Soporte Optico y Soporte Magnetico</option>
	
</select>
</td>	
 </tr>
<TR><td class='titulos2' align="right" >PRESTAMO</td>
<?
if($presta==1)$de="checked";else $de="";
?>
<td class='titulos2' align="left"><input type="checkbox" name="presta" value=1 <?=$de?> > </td>
<td width="20%" class='titulos2' align="left"> FECHA RADICADO &nbsp;&nbsp;&nbsp;&nbsp;  Desde  <br>&nbsp;&nbsp;&nbsp;
            <?
			if($sep3 == 1) $datoss3 = "checked"; else $datoss3= "";
			?>
            <input name="sep3" type="checkbox" class="select" value="1" <?=$datoss3?>>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hasta
            </td>
	<td width="20%" class='titulos2'>
	<script language="javascript">
  	<?
	 	if(!$fechaIni3) $fechaIni3=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif3) $fechaInif3 = date('Y-m-d');
  	?>
   	var dateAvailable5 = new ctlSpiffyCalendarBox("dateAvailable5", "busqueda_central", "fechaIni3","btnDate5","<?=$fechaIni3?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable5.date = "<?=date('Y-m-d');?>";
	dateAvailable5.writeControl();
	dateAvailable5.dateFormat="yyyy-MM-dd";
	</script>
	<br>&nbsp;
	<script language="javascript">
	var dateAvailable6 = new ctlSpiffyCalendarBox("dateAvailable6", "busqueda_central", "fechaInif3","btnDate6","<?=$fechaInif3?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable6.date = "<?=date('Y-m-d');?>";
	dateAvailable6.writeControl();
	dateAvailable6.dateFormat="yyyy-MM-dd";
	</script>

            </td>
</TR>
<td colspan="2" align="right"><input type=submit value=Buscar name=Buscar class="botones">&nbsp;</td>
<td colspan="2" align="left"><a href='archivo.php?<?=session_name()?>=<?=trim(session_id())?>krd=<?=$krd?>'><input name='Regresar' align="middle" type="button" class="botones" id="envia22" value="Regresar" ></td>
</table>
<br>
<?
if($Buscar){
include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");		
$dbg=$db->conn->Execute($sqla);
if(!$dbg->EOF)$usua_perm_archi=$dbg->fields['USUA_ADMIN_ARCHIVO'];
switch($codiSRD){
	case '1':
		$it1="NRO DE EXPEDIENTE";
		$it2="TITULO";
		$it3="NRO CONSECUTIVO";
		$it4="A&Ntilde;O";
		$it5="";
		break;
	case '2':
		$it1="NRO DE EXPEDIENTE";
		$it2="QUERELLADO";
		$it3="QUERELLANTE";
		$it4="A&Ntilde;O";
		$it5="AUTO DE ARCHIVO";
		break;
	case '3':
		$it1="NRO CONTRATO";
		$it2="CONTRATISTA";
		$it3="OBJETO CONTRACTUAL";
		$it4="VIGENCIA";
		$it5="ACTA DE LIQUIDACION";
		break;
	default:
		$it1="NRO DE DOCUMENTO ";
		$it2="TITULO";
		$it3="REMITENTE";
		$it4="A&Ntilde;O";
		$it5="AUTO";
		break;
}
?>
<table border=0 width 100% cellpadding="1"  class="borde_tab">
<TD class=titulos5 >RADICADO
<TD class=titulos5 >FECHA RADICADO
<TD class=titulos5 ><?=$it1?>
<TD class=titulos5 >FECHA INICIAL
<TD class=titulos5 >FECHA FINAL
<TD class=titulos5 ><?=$it4?>
<TD class=titulos5 >DEPENDENCIA
<TD class=titulos5 ><?=$it2?>
<TD class=titulos5 ><?=$it3?>
<TD class=titulos5 >DOCUMENTO DE IDENTIDAD <?=$it2?>
<?
if($codiSRD=='200')$tp="DOCUMENTO DE IDENTIDAD ".$it3;
else $tp="";
?>
<TD class=titulos5 ><?=$tp?>
<TD class=titulos5 >DIRECCION
<TD class=titulos5 >SERIE
<TD class=titulos5 >SUBSERIE
<TD class=titulos5 >TIPO
<TD class=titulos5 >FOLIOS
<TD class=titulos5 >ZONA
<TD class=titulos5 >CARRO
<TD class=titulos5 >CARA
<TD class=titulos5 >CUERPO
<TD class=titulos5 >ENTREPA&Ntilde;O
<TD class=titulos5 >CAJA
<TD class=titulos5 >UNIDAD DOCUMENTAL
<TD class=titulos5 >NRO CARPETA
<TD class=titulos5 >OBSERVACIONES
<TD class=titulos5 ><p>INDICADORES DE DETERIORO</p>
<TD class=titulos5 ><p>MATERIAL AGREGADO</p>
<TD class=titulos5 ><?=$it5?>
<TD class=titulos5 >PRESTAMO
<TD class=titulos5 >FUNCIONARIO PRESTAMO
<TD class=titulos5 >FECHA ENTREGA PRESTAMO

</tr>

<?
if($buscar_ano!=""){$x="SGD_ARCHIVO_YEAR LIKE '$buscar_ano'";$a="and";}
else {$x="";$a="";}
if($buscar_rad!=""){$r="SGD_ARCHIVO_RAD LIKE '%$buscar_rad%'";$b="and";}
else {$r="";$b="";}
if($codserie!='0'){$srds="SGD_ARCHIVO_SRD LIKE '$codiSRD'";$c="and";}
else {$srds="";$c="";}
if($codiSBRD!='0'){$sbrds="SGD_ARCHIVO_SBRD LIKE '$codiSBRD'";$d="and";}
else {$sbrds="";$d="";}
if($buscar_zona!=""){$bzon=strtoupper($buscar_zona);$zon="SGD_ARCHIVO_ZONA LIKE '$bzon'";$f="and";}
else {$zon="";$f="";}
if($buscar_carro!=""){
if($item1=="ESTANTE")$carro="SGD_ARCHIVO_ESTANTE LIKE '$buscar_carro'";
elseif($item1=="CARRO")$carro="SGD_ARCHIVO_CARRO LIKE '$buscar_carro'";
$g="and";}
else {$carro="";$g="";}
if($buscar_cara!=""){
if($item3=="ENTREPANO")$cara="SGD_ARCHIVO_ENTREPANO LIKE '$buscar_cara'";
elseif($item3=="CARA")$cara="SGD_ARCHIVO_CARA LIKE '$buscar_cara'";
$i="and";}
else {$cara="";$i="";}
if($buscar_estante!=""){
if($item4=="ESTANTE")$estan="SGD_ARCHIVO_ESTANTE LIKE '$buscar_estante'";
elseif($item4=="CAJA")$estan="SGD_ARCHIVO_CAJA LIKE '$buscar_estante'";
$h="and";}
else {$estan="";$h="";}
if($buscar_entre!=""){$entre="SGD_ARCHIVO_ENTREPANO LIKE '$buscar_entre'";$v="and";}
else {$entre="";$v="";}
if($buscar_caja!=""){$caja="SGD_ARCHIVO_CAJA LIKE '$buscar_caja'";$t="and";}
else {$caja="";$s="";}
if ($sep=='1'){
	if($fechaIni==$fechaInif)$fecha="SGD_ARCHIVO_FECHAI like '$fechaIni'";
	else{
	$time=fnc_date_calcy($fechaInif,'1');
	$fecha="SGD_ARCHIVO_FECHAI <= '$time' and SGD_ARCHIVO_FECHAI >= '$fechaIni'";
	}
	$j="and";
}
else {$fecha="";$j="";}
if ($sep2=='1'){
	if($fechaIni2==$fechaInif2)$fecha2="SGD_ARCHIVO_FECHAF like '$fechaIni2'";
	else{
	$time2=fnc_date_calcy($fechaInif2,'1');
	$fecha2="SGD_ARCHIVO_FECHAF <= '$time2' and SGD_ARCHIVO_FECHAF >= '$fechaIni2'";
	}
	$w="and";
}
else {$fecha2="";$w="";}
if ($sep3=='1'){
	if($fechaIni3==$fechaInif3)$fecha3="SGD_ARCHIVO_FECH like '$fechaIni3'";
	else{
	$time3=fnc_date_calcy($fechaInif3,'1');
	$fecha3="SGD_ARCHIVO_FECH <= '$time3' and SGD_ARCHIVO_FECH >= '$fechaIni3'";
	}
	$wq="and";
}
else {$fecha3="";$wq="";}
if($buscar_orden!=""){$orden="SGD_ARCHIVO_ORDEN LIKE '%$buscar_orden%'";$k="and";}
else {$orden="";$k="";}
if($depen!=""){$depe="SGD_ARCHIVO_DEPE LIKE '$depen' ";$l="and";}
else {$depe="";$l="";}
if($buscar_deman!=""){$dem=strtoupper($buscar_deman);$deman="SGD_ARCHIVO_DEMANDADO LIKE '%$dem%'";$n="and";}
else {$deman="";$n="";}
if($buscar_demant!=""){$demt=strtoupper($buscar_demant);$demant="SGD_ARCHIVO_DEMANDANTE LIKE '%$demt%'";$m="and";}
else {$demant="";$m="";}
if($buscar_docu!=""){$docu="(SGD_ARCHIVO_CC_DEMANDANTE LIKE '%$buscar_docu%' or SGD_ARCHIVO_DOCU2 LIKE '%$buscar_docu%')";$o="and";}
else {$docu="";$o="";}
if($buscar_inder!='0'){$inder="SGD_ARCHIVO_INDER LIKE '$buscar_inder'";$p="and";}
else {$inder="";$p="";}
if($buscar_mata!='0'){$mata="SGD_ARCHIVO_MATA LIKE '$buscar_mata'";$q="and";}
else {$mata="";$q="";}
if ($buscar_ano!="")$orde=" order by sgd_archivo_year";
else $orde=" order by sgd_archivo_fech";
if ($presta!=""){$pst="SGD_ARCHIVO_PRESTAMO=$presta ";$pt="and";}
else {$pst="";$pt="";}
if ($fechaa!=""){$fea="SGD_ARCHIVO_FECHAA like '$fechaa' ";$fta="and";}
else {$fea="";$fta="";}
if ($tip!="0"){$ti="SGD_ARCHIVO_PROC=$tip ";$tic="and";}
else {$ti="";$tic="";}
if ($anexo!=""){$anex="SGD_ARCHIVO_ANEXO like '%$anexo%' ";$an="and";}
else {$anex="";$an="";}

$at=$buscar_orden.$buscar_rad.$buscar_ano.$buscar_caja.$buscar_estante.$buscar_entrepa.$buscar_zona.$buscar_deman.$fecha.$depe.$buscar_demant.
$buscar_docu.$buscar_ufisica.$codserie.$codiSBRD.$buscar_proc.$buscar_inder;
$cont=0;
$pru=$c.$d.$ef.$b.$a.$f.$g.$i.$h.$v.$t.$k.$l.$j.$w.$wq.$n.$m.$o.$p.$q.$pt.$fea.$tic.$an;
if($pru!=""){
$de=$db->conn->Execute("select depe_codi from usuario where usua_login like '$krd'");
$depek=$de->fields['DEPE_CODI'];
include("$ruta_raiz/include/query/archivo/queryBusqueda_central.php");
	//$db->conn->debug=true;
	$rs=$db->conn->Execute($sql);
	while(!$rs->EOF){
		$orden1=$rs->fields['NRO_ORDEN'];
		$sbrd=$rs->fields['SUBSERIE'];
		$srd=$rs->fields['SERIE'];
		$demandado=$rs->fields['QUERELLADO_O_OBJETO'];
		$demandante=$rs->fields['QUERELLANTE_O_CONTRATISTA'];
		$cc=$rs->fields['DOCUMENTO_DE_IDENTIDAD'];
		$docu2=$rs->fields['DOCUMENTO_2'];
		$indet=$rs->fields['INDICADORES_DE_DETERIORO'];
		$mata1=$rs->fields['MATERIAL_INSERTADO'];
		$fechi=$rs->fields['FECHA_INICIAL'];
		$fechf=$rs->fields['FECHA_FINAL'];
		$year=$rs->fields['VIGENCIA'];
		$caja1=$rs->fields['CAJA'];
		$caja2=$rs->fields['CAJA_HASTA'];
		$carro1=$rs->fields['CARRO'];
		$cara1=$rs->fields['CARA'];
		$radi=$rs->fields["RADICADO"];
		$estante1=$rs->fields['ESTANTE'];
		$unidoc=$rs->fields['UNIDAD_DOCUMENTAL'];
		$dependencia=$rs->fields['DEPENDENCIA'];
		$entrepa1=$rs->fields['ENTREPANO'];
		$folio=$rs->fields['FOLIOS'];
		//$path=$rs->fields['SGD_ARCHIVO_PATH'];
		$zona1=$rs->fields['ZONA'];
		$anexo=$rs->fields['OBSERVACIONES'];
		$pres=$rs->fields['PRESTAMO'];
		$funprest=$rs->fields['FUNCIONARIO_PRESTAMO'];
		$fprestf=$rs->fields['FECHA_ENTREGA_PRESTAMO'];
		$fechaR=$rs->fields['FECHA_RADICADO'];
		$fecaa=$rs->fields['AUTO'];
		$procc=$rs->fields['TIPO'];
		$ncarp=$rs->fields['NRO_CARPETAS'];
		$dir=$rs->fields['DIRECCION'];
			
		if($procc!=0){$wet=$db->conn->Execute("select sgd_pexp_descrip from sgd_pexp_procexpedientes where sgd_pexp_codigo like'".$procc."'");
		$proce=$wet->fields['SGD_PEXP_DESCRIP'];
		}
		if($pres==1)$prest="SI";
		else $prest="NO";
		
		switch($indet){
			case '0': $indete="Ninguno";break;
			case '1': $indete="Biologicos: Hongos";break;
			case '2': $indete="Biologicos: Roedores";break;
			case '3': $indete="Biologicos: Insectos";break;
			case '4': $indete="Decoloracion Soporte";break;
			case '5': $indete="Desgarros";break;
			case '6': $indete="Biologicos: Hongos y Biologicos: Roedores";break;
			case '7': $indete="Biologicos: Hongos y Biologicos: Insectos";break;
			case '8': $indete="Biologicos: Hongos y Decoloracion Soporte";break;
			case '9': $indete="Biologicos: Hongos y Desgarros";break;
			case '10': $indete="Biologicos: Roedores y Biologicos: Insectos";break;
			case '11': $indete="Biologicos: Roedores y Decoloracion Soporte";break;
			case '12': $indete="Biologicos: Roedores y Desgarros";break;
			case '13': $indete="Biologicos: Insectos y Decoloracion Soporte";break;
			case '14': $indete="Biologicos: Insectos y Desgarros";break;
			case '15': $indete="Decoloracion Soporte y Desgarros";break;
			case '16': $indete="Biologicos: Hongos, Biologicos: Roedores y Biologicos: Insectos";break;
			case '17': $indete="Biologicos: Hongos, Biologicos: Roedores y Decoloracion Soporte";break;
			case '18': $indete="Biologicos: Hongos, Biologicos: Roedores y Desgarros";break;
			case '19': $indete="Biologicos: Hongos, Biologicos: Insectos y Decoloracion Soporte";break;
			case '20': $indete="Biologicos: Hongos, Biologicos: Insectos y Desgarros";break;
			case '21': $indete="Biologicos: Hongos, Decoloracion Soporte y Desgarros";break;
			case '22': $indete="Biologicos: Roedores, Biologicos: Insectos y Decoloracion Soporte";break;
			case '23': $indete="Biologicos: Roedores, Biologicos: Insectos y Desgarros";break;
			case '24': $indete="Biologicos: Roedores, Decoloracion Soporte y Desgarros";break;
			case '25': $indete="Biologicos: Insectos, Decoloracion Soporte y Desgarros";break;
			case '26': $indete="Biologicos: Hongos, Biologicos: Roedores, Biologicos: Insectos y Decoloracion Soporte";break;
			case '27': $indete="Biologicos: Hongos, Biologicos: Roedores, Biologicos: Insectos y Desgarros";break;
			case '28': $indete="Biologicos: Hongos, Biologicos: Roedores, Decoloracion Soporte y Desgarros";break;
			case '29': $indete="Biologicos: Hongos, Biologicos: Insectos, Decoloracion Soporte y Desgarros";break;
			case '30': $indete="Biologicos: Roedores, Biologicos: Insectos, Decoloracion Soporte y Desgarros";break;
			case '31': $indete="Biologicos: Hongos, Biologicos: Roedores, Biologicos: Insectos, Decoloracion Soporte y Desgarros";break;
												
		}
		switch($mata1){
				case '0':$mata2="Ninguno";break;
				case '1':$mata2="Metalico";break;
				case '2':$mata2="Post-it";break;
				case '3':$mata2="Planos";break;
				case '4':$mata2="Fotografia";break;
				case '5':$mata2="Soporte Optico";break;
				case '6':$mata2="Soporte Magnetico";break;
				case '7':$mata2="Metalico y Post-it ";break;
				case '8':$mata2="Metalico y Planos ";break;
				case '9':$mata2="Metalico y Fotografia ";break;
				case '10':$mata2="Metalico y Soporte Optico ";break;
				case '11':$mata2="Metalico y Soporte Magnetico ";break;
				case '12':$mata2="Post-it y Planos";break;
				case '13':$mata2="Post-it y Fotografia";break;
				case '14':$mata2="Post-it y Soporte Optico";break;
				case '15':$mata2="Post-it y Soporte Magnetico";break;
				case '16':$mata2="Planos y Fotografia";break;
				case '17':$mata2="Planos y Soporte Optico";break;
				case '18':$mata2="Planos y Soporte Magnetico";break;
				case '19':$mata2="Fotografia y Soporte Optico";break;
				case '20':$mata2="Fotografia y Soporte Magnetico";break;
				case '21':$mata2="Soporte Optico y Soporte Magnetico";break;
				case '22':$mata2="Metalico, Post-it y Planos";break;
				case '23':$mata2="Metalico, Post-it y Fotografia";break;
				case '24':$mata2="Metalico, Post-it y Soporte Optico";break;
				case '25':$mata2="Metalico, Post-it y Soporte Magnetico";break;
				case '26':$mata2="Metalico, Planos y Fotografia";break;
				case '27':$mata2="Metalico, Planos y Soporte Optico";break;
				case '28':$mata2="Metalico, Planos y Soporte Magnetico";break;
				case '29':$mata2="Metalico, Fotografia y Soporte Optico";break;
				case '30':$mata2="Metalico, Fotografia y Soporte Magnetico";break;
				case '31':$mata2="Metalico, Soporte Optico y Soporte Magnetico";break;
				case '32':$mata2="Post-it, Planos y Fotografia";break;
				case '33':$mata2="Post-it, Planos y Soporte Optico";break;
				case '34':$mata2="Post-it, Planos y Soporte Magnetico";break;
				case '35':$mata2="Post-it, Fotografia y Soporte Optico";break;
				case '36':$mata2="Post-it, Fotografia y Soporte Magnetico";break;
				case '37':$mata2="Post-it, Soporte Optico y Soporte Magnetico";break;
				case '38':$mata2="Planos, Fotografia y Soporte Optico";break;
				case '39':$mata2="Planos, Fotografia y Soporte Magnetico";break;
				case '40':$mata2="Planos, Soporte Optico y Soporte Magnetico";break;
				case '41':$mata2="Fotografia, Soporte Optico y Soporte Magnetico";break;
		}
		/*include("$ruta_raiz/include/query/archivo/queryBusqueda_exp.php");
		$rsr=$db->query($sql2);
		if(!$rsr->EOF)$caja=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql3);
		if(!$rsr->EOF)$estante=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql4);
		if(!$rsr->EOF)$piso=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql5);
		if(!$rsr->EOF)$archiva=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql10);
		if(!$rsr->EOF)$carro=$rsr->fields["SGD_EIT_SIGLA"];
		$rsr=$db->query($sql11);
		if(!$rsr->EOF)$entrepa=$rsr->fields["SGD_EIT_SIGLA"];*/
		?>
		<tr>

		<td class=leidos2 align="center">
		<?
		$rs2=$db->conn->Execute("select DEPE_CODI from sgd_archivo_central where sgd_archivo_rad like '$radi'");
		$depen=$rs2->fields['DEPE_CODI'];
if($usua_perm_archi>=3 and ($depek==$depen or $depek=='623')){
		?>
		<a href='insertar_central.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&$orno&adodb_next_page&edi=1&rad=$radi" ?>' > 
		<? }?>
		<?=$radi?></a></td>
		<td class=titulos5 align="center"><b><a href='verHistoricoArch.php?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&$orno&adodb_next_page&rad=$radi" ?>' ><?=$fechaR?></b></td>
		<td class=leidos2 align="center"><b><?=$orden1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2> <?=$fechi?></b></td>
		<td class=leidos2 align="center"> <b><span class=leidos2><?=$fechf?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$year?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$dependencia?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$demandado?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$demandante?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$cc?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$docu2?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$dir?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$srd?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$sbrd?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$proce?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$folio?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$zona1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$carro1?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$cara1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$estante1?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$entrepa1?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><? echo $caja1; 
		if($caja2!="") echo " a la ".$caja2;?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$unidoc?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$ncarp?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$anexo?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$indete?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$mata2?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$fecaa?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$prest?></b></td>
		<td class=titulos5 align="center"><b><span class=leidos2><?=$funprest?></b></td>
		<td class=leidos2 align="center"><b><span class=leidos2><?=$fprestf?></b></td>
		</tr>

		<?
		$cont++;
	$rs->MoveNext();

	}
	
	include_once( $ADODB_PATH.'/toexport.inc.php' );
			
			$db->conn->SetFetchMode( ADODB_FETCH_ASSOC );
			
			$rs = $db->query( $sql );

			$archivoCSV = $ruta_raiz."/bodega/tmp/B_$krd.xls";
			
			$fp = fopen( $archivoCSV, "w" );
			if( $fp )
			{
				fwrite( $fp, iconv( "UTF-8", "ISO-8859-1", rs2csv( $rs ) ) );
				fclose( $fp );
			}
			require_once($ADODB_PATH.'excel.inc.php');
			//$tit=array("RADICADO","FECHA_RADICADO","NRO_ORDEN","FECHA_INICIAL","FECHA_FINAL","VIGENCIA","DEPENDENCIA","QUERELLANTE_O_CONTRATISTA","QUERELLADO_O_OBJETO","DOCUMENTO_DE_IDENTIDAD","DOCUMENTO_QUERELLADO","DIRECCION","SERIE","SUBSERIE","TIPO","FOLIOS","ZONA","CARRO","CARA","ESTANTE","ENTREPANO","CAJA","CAJA_HASTA","UNIDAD_DOCUMENTAL","NRO_CARPETAS","OBSERVACIONES","INDICADORES_DE_DETERIORO","MATERIAL_INSERTADO","AUTO","PRESTAMO");
			$tit=array("NRO_ORDEN","SERIE","SUBSERIE","TIPO","FOLIOS","CAJA","NRO_CARPETAS");
			$gerar= new sql2excel($tit,$sql,$db); //using $db pointer by default
}
else echo"DEBE SELECCIONAR O LLENAR ALGUNA OPCION";
?>
</table>
<br>
<center><?=$cont?> Archivos Encontrados<br>
<a href="<?php print $archivoCSV; ?>" class="botones_largo">VER ARCHIVO</a>
</center>
<?
}
?>
