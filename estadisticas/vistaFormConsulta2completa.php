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
$krdOld = $krd;
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
if(!$tipoCarpOld) $tipoCarpOld= $tipo_carpt;
session_start();
if(!$krd) $krd=$krdOsld;
$ruta_raiz = "..";
//include "$ruta_raiz/rec_session.php";
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
	$tituloE[11] = "ESTADISTICAS DE DIGITALIZACION";
	$tituloE[12] = "DOCUMENTOS RETIPIFICADOS POR TRD";
	$tituloE[13] = "EXPEDIENTES POR DEPENDENCIA";
	$tituloE[14] = "REPORTE DE RADICADOS ASIGNADOS DETALLADOS (CARPETAS PERSONALES)";

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
	$helpE[11] = "Muestra la cantidad de radicados digitalizados por usuario y el total de hojas digitalizadas. Se puede seleccionar el tipo de radicaci&oacute;n y la fecha de digitalizaci&oacute;n." ;
	$helpE[12] = "Muestra los radicados que ten&iacute;an asignados un tipo documental(TRD) y han sido modificados";
	$helpE[13] = "Muestra todos los expedientes agrupados por dependencia que con el n&uacute;mero de radicados totales";
	$helpE[14] = "Muestra el total de radicados que tiene un usuario y 
				el detalle del radicado con respecto al Remitente(Detalle), 
				Predio(Detalle), ESP(Detalle) ";
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
    <td colspan="2" class="titulos4">POR RADICADOS  -  <A href='vistaFormProc.php?<?=session_name()."=".trim(session_id())."&krd=$krd&fechah=$fechah"?>' style="color: #FFFFCC">POR PROCESOS </A> </td>
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

if($tipoEstadistica==1 or $tipoEstadistica==2 or $tipoEstadistica==3 or 
	$tipoEstadistica==4 or $tipoEstadistica==5 or $tipoEstadistica==6 or 
	$tipoEstadistica==7 or $tipoEstadistica==11 or $tipoEstadistica==12)
{
?>
<tr id="cUsuario">
	<td width="30%" class="titulos2">Usuario
		<br />
	<?	$datoss = isset($usActivos) && ($usActivos) ?" checked ":"";	?>
	<input name="usActivos" type="checkbox" class="select" <?=$datoss?> onChange="formulario.submit();">
	Incluir Usuarios Inactivos  </td>
	<td class="listado2">
	<select name="codus"  class="select"  onChange="formulario.submit();">
	<? 	if ($usua_perm_estadistica > 0){	?>
			<option value=0> -- AGRUPAR POR TODOS LOS USUARIOS --</option>
	<?	}
		$whereUsSelect = (!isset($_POST['usActivos']) )? " u.USUA_ESTA = 1 ":"";
		$whereUsSelect=($usua_perm_estadistica < 1)?
					(($whereUsSelect!="")?$whereUsSelect." AND u.USUA_LOGIN='$krd' ":" u.USUA_LOGIN='$krd' "):$whereUsSelect;	  if($dependencia_busq != 99999)  {
 			
			$whereUsSelect=($whereUsSelect=="")? substr($whereDependencia,4):$whereUsSelect.$whereDependencia;
			$isqlus = "select u.USUA_NOMB,u.USUA_CODI,u.USUA_ESTA from USUARIO u 
					   where  $whereUsSelect 
					   order by u.USUA_NOMB";
			//if($codusuario!=1) $isqlus .= " and a.usua_codi=$codusuario "; 
			//echo "--->".$isqlus;
			$rs1=$db->query($isqlus);
			while(!$rs1->EOF)  {
				$codigo = $rs1->fields["USUA_CODI"]; 
				$vecDeps[]=$codigo;
				$usNombre = $rs1->fields["USUA_NOMB"];
				$datoss=($codus==$codigo)?$datoss= " selected ":"";
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
  
  if($tipoEstadistica==1 or $tipoEstadistica==2 or $tipoEstadistica==3 or 
  		$tipoEstadistica==4 or $tipoEstadistica==6 or $tipoEstadistica==11 or 
  		$tipoEstadistica==12)
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
  if($tipoEstadistica==1 or $tipoEstadistica==6 or $tipoEstadistica==10 or 
  	$tipoEstadistica==12 or $tipoEstadistica == 14) {
  ?>
  <tr>
    <td width="30%" height="40" class="titulos2">Agrupar por Tipo de Documento </td>
    <td class="listado2">
	<select name=tipoDocumento  class="select" >
        <?
 		$isqlTD = "SELECT SGD_TPR_DESCRIP, SGD_TPR_CODIGO 
					from SGD_TPR_TPDCUMENTO
					WHERE SGD_TPR_CODIGO<>0
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
		<option value='9998'  <?=$datoss?>>-- Agrupar Por Tipo de Documento</option>
		<?
		$datoss = "";
		if($tipoDocumento=='9997'){
			$datoss= " selected ";
		}
		?>
		<option value='9997'  <?=$datoss?>>-- Tipos Documentales No Definidos</option>
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
  if($tipoEstadistica==1 or $tipoEstadistica==2 or $tipoEstadistica==3 or 
  		$tipoEstadistica==4 or $tipoEstadistica==5 or $tipoEstadistica==7 or 
  		$tipoEstadistica==8 or $tipoEstadistica==9 or $tipoEstadistica==10 or 
  		$tipoEstadistica==11 or $tipoEstadistica==12 or $tipoEstadistica==14)
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

//
if (isset($generarOrfeo) && $tipoEstadistica == 12) {
	global $orderby;
	$orderby = 'ORDER BY NOMBRE';
	$whereDep = ($dependencia_busq != 99999) ? "AND h.DEPE_CODI = " . $dependencia_busq : '';
	//modificado idrd para postgres	
	$isqlus = "SELECT u.USUA_NOMB NOMBRE, u.USUA_DOC, d.DEPE_CODI, 
					COUNT(r.RADI_NUME_RADI) as TOTAL_MODIFICADOS
					  FROM USUARIO u, RADICADO r, HIST_EVENTOS h, DEPENDENCIA d, SGD_TPR_TPDCUMENTO s
					  WHERE u.USUA_DOC = h.USUA_DOC
					    AND h.SGD_TTR_CODIGO = 32
					    AND h.HIST_OBSE LIKE '*Modificado TRD*%'
					    AND h.DEPE_CODI = d.DEPE_CODI
					    $whereDep
					    AND s.SGD_TPR_CODIGO = r.TDOC_CODI
					    AND r.RADI_NUME_RADI = h.RADI_NUME_RADI
					    AND TO_CHAR(r.RADI_FECH_RADI,'yyyy/mm/dd') BETWEEN '$fecha_ini'  AND '$fecha_fin'
					  GROUP BY u.USUA_NOMB, u.USUA_DOC, d.DEPE_CODI $orderby";
	
	$rs1 = $db->query($isqlus);
	while(!$rs1->EOF)  {
		$usuadoc[] = $rs1->fields["USUA_DOC"]; 
		$dependencias[] = $rs1->fields["DEPE_CODI"]; 
		$rs1->MoveNext();
	}
}

if($generarOrfeo)
{
   include "genEstadistica.php";
}
?>
</body>
</html>

<table border=0 cellspace=2 cellpad=2 WIDTH=100% class='borde_tab' align='center'>
<tr align="center"> 
  <td>
	<?	 		
	// Se calcula el numero de | a mostrar
	//$db->conn->debug = true;
	$rs=$db->query($isqlCount);
	$numerot = $rs->fields["CONTADOR"];
	$paginas = ($numerot / 20);
	?><span class='vinculos'>Paginas </span> <?
	if(intval($paginas)<=$paginas)
	{$paginas=$paginas;}else{$paginas=$paginas-1;}
	// Se imprime el numero de Paginas.
	for($ii=0;$ii<$paginas;$ii++)
	{
	  if($pagina==$ii){$letrapg="<font color=green size=3>";}else{$letrapg="";}
	  echo " <a href='vistaFormConsulta.php?pagina=$ii&$encabezado$orno'><span class=leidos>$letrapg".($ii+1)."</span></font></a>\n";
	}
 echo "<input type=hidden name=check value=$check>";
?></td>
</tr></table>
<form name=jh >
 <input type=hidDEN name=jj value=0>
  <input type=hidDEN name=dS value=0>
 </form>
