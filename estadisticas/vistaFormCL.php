<?php

/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*  Carlos Barrero         carlosabc81@gmail.com  11/08/09                           */
/*                            Estadísticas para Control de legalidad Supersolidaria  */
/*************************************************************************************/
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$ruta_raiz = "..";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);
//	$db->conn->debug=true;
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);



//Tipo de Concepto

$array = array(
    'INFORMATIVOS' => '443',
    'SOLICITUD DE CONTROL DE LEGALIDAD CONSTITUCION' => '467',
    'SOLICITUD DE REGISTRO E INSCRIPCION DE CTAS Y PCTAS NUEVAS' => '491-490',
    'SOLICITUD DE REGISTRO E INSCRIPCION DE CTAS Y PCTAS ANTIGUAS' => '589',
    'SOLICITUD DE REGISTRO E INSCRIPCION DE NOMBRAMIENTOS' => '592',
    'SOLICITUD DE REGISTRO E INSCRIPCION DE ORDENES DE ORGANOS JUDICIALES' => '593',
    'SOLICITUD DE REGISTRO DE LIBROS' => '595-63',
    'SOLICITUD DE REGISTRO DE SUCURSALES Y AGENCIAS' => '598',
    'SOLICITUD DE VARIAS COOPERATIVAS Y PARTICULARES' => '596',
    'SOLICITUD DE ENTES PUBLICOS Y CARACTER JUDICIAL ' => '594',
    'QUEJAS Y DERECHOS DE PETICION ' => '232-322-457-319-445-320-459-42-597-446',
    'SOLICITUD DE CONTROL DE LEGALIDAD ASAMBLEA' => '468',
    'SOLICITUD DE CONTROL  DE LEGALIDAD'=>'309');

$i=0;
$combo="";
while ($row = current($array)) 
	{
	$combo.="<option value=".$row.">".key($array)."</option>";
    	next($array);
	$i++;
	}
//combo año
$comboa="";
for($i=2012;$i<=2015;$i++)
{
	$comboa.="<option value=".$i.">".$i."</option>";
}
//combo mes
$combom="";
for($i=1;$i<=12;$i++)
{
	$combom.="<option value=".$i.">".$i."</option>";
}
?>



<html>
<head>
<title>principal</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
</head>
<body>
<form method="get" name="ctas" action="">
<table class="borde_tab" width="100%" border="0" cellpadding="0" cellspacing="5">
  <tbody><tr>

    <td colspan="2" class="titulos4"><a href="vistaFormConsulta.php?PHPSESSID=090811120235o127001ADMIN1&amp;krd=ADMIN1&amp;fechah=" style="color: rgb(255, 255, 204);">Estadisticas </a> - <center>CONTROL DE LEGALIDAD </center> </td>
  </tr>
  <tr>
    <td colspan="2" class="titulos3"><span class="cal-TextBox">Este reporte genera la cantidad de radicados.</span></td>
  </tr>
  <tr>

    <td class="titulos2" width="30%">Tipo de Consulta / Estadistica</td>
    <td class="listado2" align="left">
	  <select name="tipoEstadistica" class="select">
		<?= $combo; ?>
	   </select>
	</td>

	</tr>
	<tr>
    <td class="titulos2" width="30%">Desde</td>
    <td class="listado2">
 A&ntilde;o
	<select name="anodesde" class="select">
		<?= $comboa; ?>
	</select>
Mes
	<select name="mesdesde" class="select">
		<?= $combom; ?>
	</select>

</td>
</tr>

<tr id="cUsuario">
	<td class="titulos2" width="30%">Hasta </td>
    <td class="listado2">
 A&ntilde;o
	<select name="anohasta" class="select">
		<?= $comboa; ?>
	</select>
Mes
	<select name="meshasta" class="select">
		<?= $combom; ?>
	</select>

</td>
  </tr>


  <tr>
    <td colspan="2" class="titulos2">
	<center>
	<input name="Submit" class="botones_funcion" value="Limpiar" type="reset" onclick> 
	<input class="botones_funcion" value="Generar" name="generarOrfeo" type="submit">
	<input type="hidden" name="procesa" value="1">
	</center>
	</td>

  </tr>
</tbody>
</table>
</form>
<? if($_GET['procesa']==1) 
{

//limpia varias de session de consulta

unset($_SESSION["lista"]);
unset($_SESSION["lista2"]);
unset($_SESSION["tramite"]);
unset($_SESSION["total1"]);
unset($_SESSION["total2"]);
unset($_SESSION["tramite"]);


//RADICADOS DE ENTRADA

/*
validacion dias febrero
*/
if($_GET['mesdesde']==2)
	$dia_fin=28;	
else
	$dia_fin=30;


$v_anos=split("-",$_GET['tipoEstadistica']);
$sql_1="select distinct radi_nume_radi
from radicado r, SGD_TPR_TPDCUMENTO tpr 
where r.radi_depe_radi in (300,370,371) and r.radi_fech_radi between to_date ('01/".$_GET['mesdesde']."/".$_GET['anodesde']."','dd/mm/yyyy') and to_date ('".$dia_fin."/".$_GET['meshasta']."/".$_GET['anohasta']."','dd/mm/yyyy') 
and SUBSTR(r.RADI_NUME_RADI,14,1)='2' 
and tpr.sgd_tpr_codigo=r.tdoc_codi	
and tpr.sgd_tpr_codigo in(";

$i=1;
foreach($v_anos as $row)
{
	if ($i==count($v_anos))
		$sql_1.="'".$row."'";
	else
		$sql_1.="'".$row."',";
$i++;
}
$sql_1.=")";

$rs1=$db->query($sql_1);
$k=0;
while(!$rs1->EOF)
{
	$lista[]=$rs1->fields['RADI_NUME_RADI'];		
	$k++;
	$rs1->MoveNext();	
}//echo 'fffffffffff'.$k;

//consulta respuestas radicados
if(count($lista) > 0)
{
/*$sql_2="select distinct(r.RADI_NUME_RADI)
from radicado r 
inner join anexos a on r.RADI_NUME_RADI=a.ANEX_RADI_NUME and a.ANEX_BORRADO='N'
where (r.RADI_NUME_RADI=";

$sql_1="select to char (r.RADI_FECH_RADI, 'YYYYMM'), count (*)
from radicado r, SGD_TPR_TPDCUMENTO tpr 
where r.radi_depe_radi in (300,370,371) r.radi_fech_radi between to_date ('01/".$_GET['mesdesde']."/".$_GET['anodesde']."','dd/mm/yyyy') and to_date ('".$dia_fin."/".$_GET['meshasta']."/".$_GET['anohasta']."','dd/mm/yyyy') 
and SUBSTR(r.RADI_NUME_RADI,14,1)='2' 
and tpr.sgd_tpr_codigo=r.tdoc_codi	
and tpr.sgd_tpr_codigo in(";
$i=1;
foreach($v_anos as $row)
{
	if ($i==count($v_anos))
		$sql_1.="'".$row."'";
	else
		$sql_1.="'".$row."',";
$i++;
}
$sql_1.=")"; 

   */
$sql_2="select distinct(a.anex_radi_nume),count(*)
from anexos a,radicado r,SGD_TPR_TPDCUMENTO t
where r.radi_fech_radi
 between to_date ('01/".$_GET['mesdesde']."/".$_GET['anodesde']."','dd/mm/yyyy')
 and to_date ('".$dia_fin."/".$_GET['meshasta']."/".$_GET['anohasta']."','dd/mm/yyyy')
and SUBSTR(r.RADI_NUME_RADI, 14, 1)='2' and t.sgd_tpr_codigo in(";
$i=1;
foreach($v_anos as $row)
 {
 if ($i==count($v_anos))
	$sql_2.="'".$row."'";
 else
	$sql_2.="'".$row."',";
$i++;
 } 
$sql_2.=")and t.SGD_TPR_CODIGO = r.TDOC_CODI and  r.radi_depe_radi in (300, 370, 371)
          and a.anex_radi_nume=r.radi_nume_radi and a.anex_estado>=2 group by a.anex_radi_nume";

$i=1;
$rs2=$db->query($sql_2);

$k1=0;
while(!$rs2->EOF)
{
//	$lista2[]=$rs2->fields['RADI_NUME_RADI'];		i
	$lista2[]=$rs2->fields['ANEX_RADI_NUME'];
	$k1++;
	$rs2->MoveNext();	
}
}
// radicados en tramite
if(count($lista)>0)
$tramite = array_diff($lista, $lista2);
else
$tramite =0;
?>
<spam class="alarmas">
<u>CRITERIOS DE BUSQUEDA</u>
<br>
FECHA INICIAL : <?= $_GET['anodesde']." - ".$_GET['mesdesde']?>
<br>
FECHA FINAL : <?= $_GET['anohasta']." - ".$_GET['meshasta']?>
<br>
TIPO : 
<?
reset($array);
while (list($key, $val) = each($array)) {

	if($val==$_GET['tipoEstadistica'])
	    echo $key;
}
?>


</spam>
	<table class="borde_tab" width="100%" border="0" cellpadding="0" cellspacing="5">
		<tbody>
		<tr class="titulos3">
			<th>Solicitudes</th>
			<th>Respuestas</th>
			<th>En Tr&aacute;mite</th>
		</tr>
		<tr class="listado1">
			<td align="center"><a href="vistaFormCL_det.php?tipo=1" target="_blank"><?= $k ?></a></td>
			<td align="center"><a href="vistaFormCL_det.php?tipo=2" target="_blank"><?= $k1 ?></a></td>
			<td align="center"><a href="vistaFormCL_det.php?tipo=3" target="_blank"><?= ($k - $k1) ?></a></td>
		</tr>
		</tbody>
	</table>
<?
$_SESSION['lista']=$lista;
$_SESSION['lista2']=$lista2;
$_SESSION['tramite']=$tramite;
$_SESSION['total1']=$k;
$_SESSION['total2']=$k1;
$_SESSION['total3']=($k - $k1);

?>
<br>
<center>
<iframe src="graficos/grafico.php" border="0" width="80%" height="100%" style="border: 0px solid #ffffff;">
</center>
<?
}
?>
</body>
</html>

