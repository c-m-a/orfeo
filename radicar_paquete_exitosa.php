<?
   //Programa que muestra los documentos radicados de forma exitosa
	 
	 session_start();
   $ruta_raiz = "../";
	 
   if(!$dependencia) include "$ruta_raiz/rec_session.php";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="estilos_totales.css">
</head>
<body>
<form action="radsalida/masiva/adjuntar_masiva.php?<?=$phpsession?>&krd<?=$krd?>" method="post" enctype="multipart/form-data" name="formAdjuntarArchivos">
<?php
	$num = count($arregloDocumentos);
	$i = 0; 
?>
	<table width="47%" border="0" cellspacing="1" cellpadding="0" align="center" class="t_bordeGris">
    <tr align="center"> 
      <td height="25" class="grisCCCCCC"> 
        <div align="left"><span class="etextomenu"> RADICACION EXITOSA</span></div>
      </td>
    </tr>
		<tr align="center"> 
      <td height="25" class="grisCCCCCC"> 
        <div align="left">Se han radicado los siguientes documentos:</div>
      </td>
    </tr>
		<?
		//Recorre el erreglo con los documentos radicados y muestra su número
		while ($i < $num) {	
		?>
      <tr align="center"> 
      <td class="celdaGris" > 
        <div align="left" class="etexto"><?=$arregloDocumentos[$i] ?> <font color="#008040"><b>No. 
          <?=$arregloRadicados[$i]?></b></font></div>
      </td>
    </tr>
		<?
		$i++; 
		}
		?>
    <tr align="center"> 
      <td height="30" class="celdaGris"><span class="celdaGris"> <span class="e_texto1"> 
        <input name="envia" type="button"  class="ebuttons2" id="envia"  onClick="history.go(-1);" value="Aceptar">
        </span> </span></td>
    </tr>
  </table>
</form>
  <blockquote>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </blockquote>
</body>
</html>
