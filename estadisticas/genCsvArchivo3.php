<html>
<?
$ruta_raiz = "..";
?>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onload="SetFocus();">
<div id="spiffycalendar" class="text"></div>
<div id="spiffycalendar2" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript"><!--
	setRutaRaiz ('<?=$ruta_raiz?>');
   var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "formulario", "fecha_ini","btnDate1","<?=$fecha_ini?>",scBTNMODE_CUSTOMBLUE);
   var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "formulario", "fecha_fin","btnDate2","<?=$fecha_fin?>",scBTNMODE_CUSTOMBLUE);
//-->
</script>
<?php
include "../config.php";
$ruta_raiz = "..";
define('ADODB_ASSOC_CASE', 0);
include_once "../include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");	
$dbCon = $db;
include_once ('../adodb/toexport.inc.php');
include_once ('../adodb/adodb.inc.php');
?>
<hr>
GENERACION DE ARCHIVOS CON DATOS ESTADISTICOS DE RADICICADOS, SUS ANEXOS y TIPOS DE DOCUMENTO
<hr>
<form method="post" action=genCsvArchivo3.php name="formulario">
       Fecha Inicial<script language="javascript">
			    dateAvailable.writeControl(); 
			    dateAvailable.dateFormat="yyyy-MM-dd";
			  </script><p>
       Fecha Final<script language="javascript">
			    dateAvailable2.writeControl(); 
			    dateAvailable2.dateFormat="yyyy-MM-dd";
			  </script><p>
				Digite los codigos de dependencia que desea genrear
<input type=text name=genDependencias value='<?=$genDependencias?>'>
<input type=submit name=aceptar value=generar>
</form>
<?
error_reporting(7);

	include_once ('../adodb/adodb-errorpear.inc.php');
	include_once ('../adodb/adodb.inc.php');
	include_once ('../adodb/tohtml.inc.php');
	include_once('../adodb/adodb-paginacion.inc.php');
	include_once ('../config.php');
	error_reporting(7);

	
	$db = ADONewConnection('oracle'); # eg 'mysql' o 'postgres'
	$db->Connect($servidor, $usuario, $contrasena, $servicio);

$db->concat("'",a.ra_asun,"'");
if($genDependencias)
{
$where_fecha = " (a.radi_fech_radi <= to_date('$fecha_fin 23:59:59','yyyy-mm-dd hh24:mi:ss') and a.radi_fech_radi >= to_date('$fecha_ini 00:00:00','yyyy-mm-dd hh24:mi:ss') ) and ";
$isql = "select 
a.radi_nume_radi Rad_Padre
, a.radi_fech_radi Fecha_Rad
, b.radi_nume_radi as Rad_Rel
, b.radi_fech_radi Fecha_Rad_Padre
, a.radi_depe_radi Dep_Radicacion
, c.depe_codi Dep_Anterior
, a.radi_depe_actu Dep_Actual
, d.usua_nomb Us_Actual
, f.fecha_max
, c.usua_nomb Us_anterior
, a.ra_asun
, e.sgd_tpr_descrip
from radicado a, radicado b,usuario c, usuario d
	,sgd_tpr_tpdcumento e,
  (
   SELECT RADI_NUME_RADI, MAX(HIST_FECH) FECHA_MAX 
   	FROM HIST_EVENTOS 
  	GROUP BY 
  		RADI_NUME_RADI
  ) f
where 
 $where_fecha
 a.radi_nume_radi = b.radi_nume_deri (+)
 and a.radi_nume_radi=f.radi_nume_radi
 and a.radi_usu_ante  = c.usua_login (+)
 and a.radi_usua_actu = d.usua_codi
 and a.radi_depe_actu = d.depe_codi
 and a.tdoc_codi=e.sgd_tpr_codigo
order by a.radi_nume_radi, a.radi_fech_radi 
";
 // and a.radi_depe_radi in ($genDependencias)
//echo "<hr>la consulta Utilizadad es : $isql<hr>";
$db->conn->debug = true;
$rs = $db->query($isql);


//print "<pre>";
//print rs2csv($rs); # obtenemos un texto en formao CSV
//print '<hr>';

 # Nota, en algunas bases de datos no funciona el MoveFirst

//print rs2tab($rs,false); # obtenemos el texto delimitado por tabuladores
			 # false == omite el nombre de los campos en el primer renglon
//print '<hr>';
//$rs->MoveFirst();
//rs2tabout($rs); # manda a la salida estandar (stdout) (tambien existe la funcion rs2csvout)
//print "</pre>";
//echo "Total de Registros " . $rs->RecordCount( );
//$rs->MoveFirst();
//$path = "../bodega/masiva/EAdep($genDependencias)($fecha_ini~$fecha_fin)(".date("Ymd_h:i").").txt";
$path = "../bodega/estadisticasDatabox/TPdep($genDependencias)($fecha_ini~$fecha_fin)(".date("Ymd_h:i").").txt";
$fp = fopen($path, "w");
echo  "<hr>$fp<hr>";
if ($fp) 
{
	//rs2csvfile($rs, $fp); # Escribe a un archivo (tambien existe la funcion rs2tabfile)
	rs2tabfile($rs, $fp);
	fclose($fp);
	?>
	<hr>El archivo generado lo puede descargar de 
	<a href='<?=$path?>'><?=$path?></a>
	<hr>
	<?
}
}
?>
</body>
</html>