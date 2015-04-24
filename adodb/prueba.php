<?php
include_once('toexport.inc.php');
include_once('adodb.inc.php');

$db = &NewADOConnection('oracle');
$db->Connect("atlas", "fldoc", "Fldoc", "bdprueba");
$db->concat("'",a.ra_asun,"'");
$isql = "select 
a.radi_nume_radi Rad_Padre
, a.radi_fech_radi Fecha_Rad
, b.radi_nume_radi as Rad_Rel
, b.radi_fech_radi Fecha_Rad_Padre
, a.radi_depe_radi Dep_Radicacion
, c.depe_codi Dep_Anterior
, a.radi_depe_actu Dep_Actual
, d.usua_nomb Us_Actual
, c.usua_nomb Us_anterior
, a.ra_asun
from radicado a, radicado b, usuario c, usuario d
where 
 a.radi_nume_radi = b.radi_nume_deri (+)
 and a.radi_depe_radi like '3%'
 and a.radi_usu_ante  = c.usua_login (+)
 and a.radi_usua_actu = d.usua_codi
 and a.radi_depe_actu = d.depe_codi
order by a.radi_nume_radi
";
echo $isql;
$rs = $db->Execute($isql);

//print "<pre>";
//print rs2csv($rs); # obtenemos un texto en formao CSV
//print '<hr>';

$rs->MoveFirst(); # Nota, en algunas bases de datos no funciona el MoveFirst

//print rs2tab($rs,false); # obtenemos el texto delimitado por tabuladores
			 # false == omite el nombre de los campos en el primer renglon
//print '<hr>';
//$rs->MoveFirst();
//rs2tabout($rs); # manda a la salida estandar (stdout) (tambien existe la funcion rs2csvout)
//print "</pre>";

$rs->MoveFirst();
$path = "../../orfeo/bodega/masiva/0dep_300_".date("Ymd")."_".time("H_m").".csv";
$fp = fopen($path, "w");
if ($fp) 
{
	//rs2csvfile($rs, $fp); # Escribe a un archivo (tambien existe la funcion rs2tabfile)
	rs2tabfile($rs, $fp);
	fclose($fp);
}
?>
