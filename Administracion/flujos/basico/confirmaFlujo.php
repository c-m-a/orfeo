<?
//$krdOld = $krd;
error_reporting(0);
session_start();
error_reporting(0);
$ruta_raiz = "../../..";

?>
<html>
<head>
<title>Creación de Proceso</title>
<link rel="stylesheet" href="../../../estilos/orfeo.css">



</head>
<body>
<?
    include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//	$db->conn->debug = true;
	
	if( $_GET['proceso'] != '' ){
		$procesoSelected = $_GET['proceso'];
		
        $query = "UPDATE sgd_pexp_procexpedientes SET  sgd_pexp_tieneflujo = 1 ";
        $query .= "WHERE sgd_pexp_codigo = " . $procesoSelected;
        if (!$rs = $db->conn->query($query)){
     		$resultado = "No se pudo crear el flujo para el proceso con ID: " . $procesoSelected;
         }else{
			$resultado = "Se cre&oacute; satisfactoriamente el flujo para el proceso con ID: " . $procesoSelected;
         }
		
	}elseif ( $_POST['proceso'] != ''){
		$procesoSelected = $_POST['proceso'];
		$resultado = "No se pudo crear el flujo para el proceso con ID: " . $procesoSelected;
	}
	
?>
<form name='frmFlujoCreado' >
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<p><B><span class=etexto>  </span></B></p></center>
	<center>
	<p><B><span class=etexto>RESULTADO CREACI&Oacute;N DE FLUJO</span></B> </p>
	<p><B><span class=etexto> <?=$resultado?></span></B></p></center>
	</td>
	</tr>
</table>

</form>
</body>
</html>