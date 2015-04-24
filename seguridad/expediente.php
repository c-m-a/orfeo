<?
session_start(); 
error_reporting(7); 
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario =$_SESSION["codusuario"];
$ruta_raiz = ".."; 	
error_reporting(7);

if (!$nurad) $nurad= $rad;
if (!$numrad && $nurad) $numrad= $nurad;
if($nurad)
{
	$ent = substr($nurad,-1);
}
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
include_once "$ruta_raiz/include/tx/Historico.php";
//include_once ("$ruta_raiz/class_control/TipoDocumental.php");
include_once "$ruta_raiz/include/tx/Expediente.php";
//$trd = new TipoDocumental($db);
//$db->conn->debug = true;	
?>
<html>
<head>
<title>Cambiar Seguridad a Expediente</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css"><script>

function regresar(){   	
	document.TipoDocu.submit();
}
</script><style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
</head>
<body bgcolor="#FFFFFF">
<form method="POST" action="expediente.php" name="TipoDocu">
<input type=hidden name=numrad value=<?=$numrad?>>
<input type=hidden name=nurad value=<?=$nurad?>>
<input type=hidden name=num_expediente value=<?=$num_expediente?>>
<table border=0 width=70% align="center" class="borde_tab" cellspacing="0">
  <tr align="center" class="titulos2">
    <td height="15" class="titulos2">CAMBIAR NIVEL DE SEGURIDAD AL EXPEDIENTE No. <?=$num_expediente?></td>
    </tr>
</table> 
<table><tr><td></td></tr></table>
<table width="80%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
<tr >
<td width="62%" class="titulos5" >Nivel:</td>
<td width="38%" class=listado5 >
<select name=nivelExp class=select>
<?
if($nivelExp==0)  $datoss = " selected "; else $datoss = "";
?>
<option value=0 <?=$datoss?>>P&uacute;blico</option>
<?
if($nivelExp==1)  $datoss = " selected "; else $datoss = "";
?>
<option value=1 <?=$datoss?>>Privado solo jefe y Ususarios Actules de Radicados</option>
<?
if($nivelExp==2)  $datoss = " selected "; else $datoss = "";
?>
<option value=2 <?=$datoss?>>Privado dependencia (Solo usuarios Dependencias)</option>
<?
if($nivelExp==3)  $datoss = " selected "; else $datoss = "";
?>
<option value=3 <?=$datoss?>>Privado Solo Usuario Responsable Y Jefe (No Usuarios actuales)</option>
</select>
</td>
</tr>
<tr><TD class=listado5 COLSPAN=2 ><center>Si selecciona Privado, La Dependencia de la persona que posee el Expediente ser&aacute; la &uacute;nica que podr&aacute; ver los radicados de dicho Expediente.</TD></tr>
</center><tr>
<td class=listado5  align="center">
<center><input type="submit" class="botones" name=grbNivel value="Grabar Nivel">
</td>
<td class=listado5  align="center">
<input name="Cerrar" type="button" class="botones" id="envia22" onClick="opener.regresar();window.close();"value="Cerrar"></center>
</td>
</tr>
  <tr>
    <td class="titulos5" colspan="2" ><center>&nbsp;<?=$descTipoExpediente?> - <?=$expDesc?></center></td>
  </tr>
</table>
<br>
<br>
</form>
</span>
<p>
<?
if($grbNivel and $num_expediente)
{
      $query = "UPDATE SGD_EXP_EXPEDIENTE SET SGD_EXP_PRIVADO=$nivelExp where SGD_EXP_NUMERO='$num_expediente'";
      $query2 = "UPDATE SGD_SEXP_SECEXPEDIENTES SET SGD_EXP_PRIVADO=$nivelExp where SGD_EXP_NUMERO='$num_expediente'";
    if($nivelExp==1){
      $observa = "Expediente Confidencial solo Jefe y Responsable";
    }
    elseif ($nivelExp == 0) 
    {
      $observa = "Expediente Publico.";
    }elseif ($nivelExp == 2) 
    {
      $observa = "Expediente Confidencial dependencia. (Y Usuarios Acutales Radicados)";
    }elseif ($nivelExp == 3) 
    {
      $observa = "Expediente Confidencial Usuario Responsable y Jefe. (No usuarios actules de Radicados)";
    }
    //$db->conn->debug = true;
    if($db->conn->Execute($query) && $db->conn->Execute($query2))
    {
      echo "<span class=leidos>El nivel se actualiz&oacute; correctamente. ";
      include_once "$ruta_raiz/include/tx/Historico.php";
      $codiRegH = "";
      $Historico = new Historico($db);		  
	//$radiModi = $Historico->insertarHistorico($codiRegE, $coddepe, $codusua, $coddepe, $codusua, $observa, 33); 
      
      $codiRegR[0] = $numrad;
      $radiModi = $Historico->insertarHistoricoExp($num_expediente,$codiRegR , $dependencia, $codusuario, $observa, 60, 0); 
	    
    }else 
    {
      echo "<span class=titulosError> !No se pudo actualizar el nivel para el expediente !";
    }
}
?>
<?=$mensaje_err?>
</p>
</span>
</body>
</html>
