<?
session_start();
$ruta_raiz = "..";
   include_once "$ruta_raiz/include/db/ConnectionHandler.php";
   $db = new ConnectionHandler("$ruta_raiz");
   $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
   $query="update radicado set radi_path=NULL where radi_nume_radi=".$_GET['numrad'];
  if($db->conn->Execute($query))
  {
	$radicadosSel[] = $_GET['numrad'];
	$codTx = 204;	//Código de la transacción
	$observa="ELIMINACION PATH DE IMAGEN PARA CORRECCION";
	include "$ruta_raiz/include/tx/Historico.php";
	$hist = new Historico($db);
	$hist->insertarHistorico($radicadosSel,  $dependencia , $codusuario, $dependencia, $codusuario, $observa, $codTx);
	}else{
  	echo "<hr>No actualizo la BD <hr>";
  }
?>
<html>
<head>
<title>Realizar Transaccion - Orfeo </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body>
<table cellspace=2 WIDTH=60% id=tb_general align="left" class="borde_tab">
<tr>
	<td colspan="2" class="titulos4">ACCION REQUERIDA --> COMPLETADA ! </td>
</tr>
<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
</td>
	<td  width="65%" height="25" class="listado2_no_identa">
	ELIMINACION DE IMAGEN A RADICADO
	</td>
</tr>
<tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS INVOLUCRADOS :
	</td>
<td  width="65%" height="25" class="listado2_no_identa"><?=$_GET['numrad']?>
</td>
</tr>
<tr>
<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA :
</td>
<td  width="65%" height="25" class="listado2_no_identa">
<?=date("m-d-Y  H:i:s")?>
</td>
</tr>
<tr>
<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO ORIGEN:
</td>
<td  width="65%" height="25" class="listado2_no_identa">
<?=$_SESSION['usua_nomb']?>
</td>
</tr>
<tr>
<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">DEPENDENCIA ORIGEN:
</td>
<td  width="65%" height="25" class="listado2_no_identa">
<?=$_SESSION['depe_nomb']?>
</td>
</tr>
</table>
</body>
</html>