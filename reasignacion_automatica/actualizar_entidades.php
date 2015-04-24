<?
session_start();


/*if (!$ruta_raiz)*/ $ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
//$db->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	

//echo "$krd<br>$dependencia";
if (!$krd or !$dependencia or !$usua_doc)
	include "$ruta_raiz/rec_session.php";


?>
<html>
<head>
<title>Enviar Datos</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

</head>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">

<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
<body bgcolor="#FFFFFF" topmargin="0">

<?

$fecha_hoy = Date("Y-m-d");
//$sqlFechaHoy=$db->conn->OffsetDate(0,$db->conn->sysTimeStamp);


$sql="select replace(nit,'-','') nit from entidad@sui	  
	  where codentidad in (90,246,248,271,374,432,561,644,686,734,821,824,889,912,969,978,1128,1250,1263,1302,1306,1339,1341,1352,1356,1374,1380,1421,1443,1450,1459,1500,1615,1661,1756,1805,1813,1818,1827,1851,1852,1856,2024,2058,2077,2130,2199,2223,2246,2331,2426,2427,2434,2506,2540,2641,2646,2704,2800,2814,2878,3048,3049,3123,3234,3249,3278,3386,3402,3488,3620,4004,4129,4204,4336,4458,4617,6234,7099,7571,8202
) ";
//echo $sql;
$rs1=$db->query($sql);
if ($rs1 === false) 
{
	die("error al insertar: ".$db->ErrorMsg()."<BR>");
}

while(!$rs1->EOF)
{
	echo $rs1->fields["nit"];				
	$rs1->MoveNext();		
}

//$db->conn->debug=true;
//$db->conn->CommitTrans();

?>


</body>
</html>