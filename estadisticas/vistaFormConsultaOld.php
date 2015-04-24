<?
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
/*************************************************************************************/
?>
<?
$krdOld = $krd;
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
if(!$tipoCarpOld) $tipoCarpOld= $tipo_carpt;
session_start();
if(!$krd) $krd=$krdOsld;
$ruta_raiz = "..";
include "$ruta_raiz/rec_session.php";
error_reporting(7);
if(!$tipoEstadistica) $tipoEstadistica =1;
if(!$dependencia_busq) $dependencia_busq =$dependencia;
/** DEFINICION DE VARIABLES ESTADISTICA
	*	var $tituloE String array  Almacena el titulo de la Estadistica Actual
	* var $subtituloE String array  Contiene el subtitulo de la estadistica
	* var $helpE String Almacena array Almacena la descripcion de la Estadistica.
	*/
	$tituloE[1] = "RADICACION - CONSULTA DE RADICADOS POR USUARIO";
	$tituloE[2] = "RADICACION - ESTADISTICAS POR MEDIO DE RECEPCION-ENVIO";
	$tituloE[3] = "RADICACION - ESTADISTICAS DE MEDIO ENVIO FINAL DE DOCUMENTOS";
	$tituloE[4] = "RADICACION - ESTADISTICAS DE DIGITALIZACION DE DOCUMENTOS";
	$tituloE[5] = "RADICADOS DE ENTRADA RECIBIDOS DEL AREA DE CORRESPONDENCIA";
	$tituloE[6] = "RADICADOS ACTUALES EN LA DEPENDENCIA";
	//$tituloE[7] = "ESTADISTICAS DE NUMERO DE DOCUMENTOS ENVIADOS";	  	  
	$tituloE[8] = "REPORTE DE VENCIMIENTOS";	  	  
	$tituloE[9] = "REPORTE PROCESO RADICADOS DE ENTRADA";
	$tituloE[10] = "REPORTE ASIGNACION RADICADOS";


	$subtituloE[1] = "ORFEO - Generada el: " . date("Y/m/d H:i:s"). "\n Parametros de Fecha: Entre $fecha_ini y $fecha_fin";
	$subtituloE[2] = "ORFEO - Fecha: " . date("Y/m/d H:i:s"). "\n Parametros de Fecha: Entre $fecha_ini y $fecha_fin";
	$subtituloE[3] = "ORFEO - Fecha: " . date("Y/m/d H:i:s"). "\n Parametros de Fecha: Entre $fecha_ini y $fecha_fin";
	$subtituloE[4] = "ORFEO - Fecha: " . date("Y/m/d H:i:s"). "\n Parametros de Fecha: Entre $fecha_ini y $fecha_fin";
	$subtituloE[5] = "ORFEO - Fecha: " . date("Y/m/d H:i:s"). "\n Parametros de Fecha: Entre $fecha_ini y $fecha_fin";
	$subtituloE[6] = "ORFEO - Fecha: " . date("Y/m/d H:i:s"). "\n Parametros de Fecha: Entre $fecha_ini y $fecha_fin";
	$subtituloE[8] = "ORFEO - Fecha: " . date("Y/m/d H:i:s"). "\n Parametros de Fecha: Entre $fecha_ini y $fecha_fin";  
	
		$helpE[1] = "Este reporte genera la cantidad de radicados por usuario. Se puede discriminar por tipo de radicaci&oacute;n. " ;
	$helpE[2] = "Este reporte genera la cantidad de radicados de acuerdo al medio de recepci&oacute;n o envio realizado al momento de la radicaci&oacute;n. " ;
	$helpE[3] = "Este reporte genera la cantidad de radicados enviados a su destino final por el &aacute;rea.  " ;
	$helpE[4] = "Este reporte genera la cantidad de radicados digitalizados por usuario y el total de hojas digitalizadas. Se puede seleccionar el tipo de radicaci&oacute;n." ;
	$helpE[5] = "Este reporte genera la cantidad de documentos de entrada radicados del &aacute;rea de correspondencia a una dependencia. " ;
	$helpE[6] = "Esta estadistica trae la cantidad de radicados \n generados por usuario, se puede discriminar por tipo de Radicacion. " ;
	$helpE[8] = "Este reporte genera la cantidad de radicados de entrada cuyo vencimiento esta dentro de las fechas seleccionadas. " ;
	$helpE[9] = "Este reporte muestra el proceso que han tenido los radicados tipo 2 que ingresaron durante las fechas seleccionadas. ";
	$helpE[10] = "Este reporte muestra cuantos radicados de entrada han sido asignados a cada dependencia. ";
?>	  
<html>
<head>
<title>principal</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script>
function adicionarOp (forma,combo,desc,val,posicion){
	o = new Array;
	o[0]=new Option(desc,val );
	eval(forma.elements[combo].options[posicion]=o[0]);
	//alert ("Adiciona " +val+"-"+desc );
	
}
</script>
		 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
		  
		 <script language="javascript">
		 <!--
			<?
				$ano_ini = date("Y");
				$mes_ini = substr("00".(date("m")-1),-2);
				if ($mes_ini==0) {$ano_ini==$ano_ini-1; $mes_ini="12";}
				$dia_ini = date("d");
				if(!$fecha_ini) $fecha_ini = "$ano_ini/$mes_ini/$dia_ini";
					$fecha_busq = date("Y/m/d") ;
				if(!$fecha_fin) $fecha_fin = $fecha_busq;
			?>
   var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "formulario", "fecha_ini","btnDate1","<?=$fecha_ini?>",scBTNMODE_CUSTOMBLUE);
   var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "formulario", "fecha_fin","btnDate2","<?=$fecha_fin?>",scBTNMODE_CUSTOMBLUE);

//--></script>
</head>
<?
include "$ruta_raiz/envios/paEncabeza.php";
?>
<table><tr><TD></TD></tr></table>
<?
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
include("$ruta_raiz/class_control/usuario.php");
$db = new ConnectionHandler($ruta_raiz);	
//$db->conn->debug=true; 
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$objUsuario = new Usuario($db);
?>
<body bgcolor="#ffffff" onLoad="comboUsuarioDependencia(document.formulario,document.formulario.elements['dependencia_busq'].value,'codus');" topmargin="0">
<div id="spiffycalendar" class="text"></div>
<form name="formulario"  method=post action='./vistaFormConsulta.php?<?=session_name()."=".trim(session_id())."&krd=$krd&fechah=$fechah"?>'>

<table width="100%"  border="0" cellpadding="0" cellspacing="5" class="borde_tab">
  <tr>
    <td colspan="2" class="titulos4">ESTADISTICAS    -  <A href='vistaFormProc.php?<?=session_name()."=".trim(session_id())."&krd=$krd&fechah=$fechah"?>' class=noLeidos>POR PROCESOS </A></td>
  </tr>
  <tr>
    <td colspan="2" class="titulos3"><span class="cal-TextBox"><?=$helpE[$tipoEstadistica]?></span></td>
  </tr>
  <tr>
    <td width="30%" class="titulos2">Tipo de Consulta / Estadistica</td>
    <td class="listado2" align="left">
	   <select name=tipoEstadistica  class="select" onChange="formulario.submit();">
		<?	
			foreach($tituloE as $key=>$value)
			{
		?>
	   <? if($tipoEstadistica==$key) $selectE = " selected "; else $selectE = ""; ?>
			<option value=<?=$key?> <?=$selectE?>><?=$tituloE[$key]?></option>
		<?
		}
		?>
		</select>
	</td>
	</tr>
	<tr>
    <td width="30%" class="titulos2">Dependencia</td>
    <td class="listado2">
	<select name=dependencia_busq  class="select"  onChange="formulario.submit();">
<?
	if($usua_perm_estadistica>1)  {
		if($dependencia_busq==99999)  {
			$datoss= " selected ";
		}
		?>
			<option value=99999  <?=$datoss?>>-- Todas las Dependencias --</option>
		<?
	}

$whereDepSelect=" DEPE_CODI = $dependencia ";
if ($usua_perm_estadistica==1){
	$whereDepSelect=" $whereDepSelect or depe_codi_padre = $dependencia ";	
}
if ($usua_perm_estadistica==2) {
	$isqlus = "select a.DEPE_CODI,a.DEPE_NOMB,a.DEPE_CODI_PADRE from DEPENDENCIA a ORDER BY a.DEPE_NOMB";
}
else {
//$whereDepSelect=
	$isqlus = "select a.DEPE_CODI,a.DEPE_NOMB,a.DEPE_CODI_PADRE from DEPENDENCIA a 
						where $whereDepSelect ";
}
	//if($codusuario!=1) $isqlus .= " and a.usua_codi=$codusuario "; 
//echo "--->".$isqlus;
$rs1=$db->query($isqlus);

do{
	$codigo = $rs1->fields["DEPE_CODI"]; 
	$vecDeps[]=$codigo;
	$depnombre = $rs1->fields["DEPE_NOMB"];
	$datoss="";
	if($dependencia_busq==$codigo){
		$datoss= " selected ";
	}
	echo "<option value=$codigo  $datoss>$depnombre</option>";		
	$rs1->MoveNext();
}while(!$rs1->EOF);
	?>
	</select>
</td>
</tr>
<?
		if ($dependencia_busq != 99999)  {
			$whereDependencia = " AND DEPE_CODI=$dependencia_busq ";
		}

if($tipoEstadistica==1 or $tipoEstadistica==2 or $tipoEstadistica==3 or $tipoEstadistica==4 or $tipoEstadistica==5 or $tipoEstadistica==6 or $tipoEstadistica==7)
{
?>
<tr id="cUsuario">
	<td width="30%" class="titulos2">Usuario
		<BR>
	<?
	$datoss = "";
	if($usActivos)
	{
		$datoss = " checked ";
	}
	?>
	<input name="usActivos" type="checkbox" class="select" <?=$datoss?> onChange="formulario.submit();">
	Incluir Usuarios Inactivos  </td>
	<td class="listado2">
	<select name=codus  class="select"  onChange="formulario.submit();">
	<?
    if ($usua_perm_estadistica > 0){
		?>
		<option value=0> -- AGRUPAR POR TODOS LOS USUARIOS --</option>
		<?
	}
	
		$whereUsSelect = "";
		if(!$usActivos)
		{
          $whereUsua = " u.USUA_ESTA = 1 ";
		  $whereUsSelect = " AND u.USUA_ESTA = 1 ";
		  $whereActivos = " AND b.USUA_ESTA=1";
		}
        if ($usua_perm_estadistica < 1){
        	$whereUsSelect.=" AND u.USUA_LOGIN='$krd' ";	
        }
 		if($dependencia_busq != 99999)  {
			$isqlus = "select u.USUA_NOMB,u.USUA_CODI,u.USUA_ESTA from USUARIO u 
					   where $whereUsua $whereUsSelect $whereDependencia 
					   order by u.USUA_NOMB";
			//if($codusuario!=1) $isqlus .= " and a.usua_codi=$codusuario "; 
			//echo "--->".$isqlus;
	//		$db->conn->debug = true;
			$rs1=$db->query($isqlus);
			while(!$rs1->EOF)  {
				$codigo = $rs1->fields["USUA_CODI"]; 
				$vecDeps[]=$codigo;
				$usNombre = $rs1->fields["USUA_NOMB"];
				$datoss="";
				if($codus==$codigo)  {
					$datoss= " selected ";
				}
				echo "<option value=$codigo  $datoss>$usNombre</option>";		
				$rs1->MoveNext();
			}
		}
		?>
		</select>
	&nbsp;</td>
  </tr>
  <?
  }
  
  if($tipoEstadistica==1 or $tipoEstadistica==2 or $tipoEstadistica==3 or $tipoEstadistica==4 or $tipoEstadistica==6)
  {
  ?>
<tr>
	<td width="30%" height="40" class="titulos2">Tipo de Radicado </td>
	<td class="listado2">
	<? 
		$rs = $db->conn->Execute('select SGD_TRAD_DESCR, SGD_TRAD_CODIGO  from SGD_TRAD_TIPORAD order by 2');
		$nmenu = "tipoRadicado";
		$valor = "";
		$default_str=$tipoRadicado;
		$itemBlanco = " -- Agrupar por Todos los Tipos de Radicado -- ";
		print $rs->GetMenu2($nmenu, $default_str, $blank1stItem = "$valor:$itemBlanco",false,0,'class=select');
		?>&nbsp;</td>
</tr>
   <?
  }
  if($tipoEstadistica==1 or $tipoEstadistica==6 or $tipoEstadistica==10)
  {

  ?>
  <tr>
    <td width="30%" height="40" class="titulos2">Agrupar por Tipo de Documento </td>
    <td class="listado2">
	<select name=tipoDocumento  class="select" >
        <?
 		$isqlTD = "select SGD_TPR_DESCRIP, SGD_TPR_CODIGO 
					from SGD_TPR_TPDCUMENTO
				    order by  SGD_TPR_DESCRIP";
	    //if($codusuario!=1) $isqlus .= " and a.usua_codi=$codusuario "; 
		//echo "--->".$isqlus;
		$rs1=$db->query($isqlTD);
		$datoss = "";

		if($tipoDocumento!='9998'){
			$datoss= " selected ";
			$selecUs = " b.USUA_NOMB USUARIO, ";
			$groupUs = " b.USUA_NOMB, ";
		}

		if($tipoDocumento=='9999'){
			$datoss= " selected ";
		}
		?>
		<option value='9999'  <?=$datoss?>>-- No Agrupar Por Tipo de Documento</option>
		<?   $datoss = "";
		if($tipoDocumento=='9998'){
			$datoss= " selected ";
		}
		?>
		<option value='9998'  <?=$datoss?>>-- Agrupar Por Todos los Tipos de Documentos</option>
		<?
		do{
			$codigo = $rs1->fields["SGD_TPR_CODIGO"]; 
			$vecDeps[]=$codigo;
			$selNombre = $rs1->fields["SGD_TPR_DESCRIP"];
			$datoss="";
		if($tipoDocumento==$codigo){
				$datoss= " selected ";
			}
			echo "<option value=$codigo  $datoss>$selNombre</option>";		
			$rs1->MoveNext();
		}while(!$rs1->EOF);
		?>
		</select>
						
	  </td>
  </tr>
  <?
  }
  if($tipoEstadistica==1 or $tipoEstadistica==2 or $tipoEstadistica==3 or $tipoEstadistica==4 or $tipoEstadistica==5 
    or $tipoEstadistica==7 or $tipoEstadistica==8 or $tipoEstadistica==9 or $tipoEstadistica==10)
  {
  ?>  
  <tr>
    <td width="30%" class="titulos2">Desde fecha (aaaa/mm/dd) </td>
    <td class="listado2">
	<script language="javascript">
	dateAvailable.writeControl();
	dateAvailable.dateFormat="yyyy/MM/dd";
	</script>
	&nbsp;
  </td>
  </tr>
  <tr>
    <td width="30%" class="titulos2">Hasta  fecha (aaaa/mm/dd) </td>
    <td class="listado2">
	<script language="javascript">
	dateAvailable2.writeControl();
	dateAvailable2.dateFormat="yyyy/MM/dd";
	</script>&nbsp;</td>
  </tr>
    <?
  }
  ?>
  <tr>
    <td colspan="2" class="titulos2">
	<center>
	<input name="Submit" type="submit" class="botones_funcion" value="Limpiar"> 
	<input type="submit" class="botones_funcion" value="Generar" name="generarOrfeo">
	</center>
	</td>
  </tr>
</table>
</form>
<?

$datosaenviar = "fechaf=$fechaf&tipoEstadistica=$tipoEstadistica&codus=$codus&krd=$krd&dependencia_busq=$dependencia_busq&ruta_raiz=$ruta_raiz&fecha_ini=$fecha_ini&fecha_fin=$fecha_fin&tipoRadicado=$tipoRadicado&tipoDocumento=$tipoDocumento";
if($generarOrfeo)
{
   include "genEstadistica.php";
}
?>
</body>
</html>
