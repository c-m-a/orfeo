<?    
 error_reporting(0); 
 session_start(); 
 $ruta_raiz = ".."; 
 if (!$dependencia) { include "../rec_session.php";}
 $no_tipo = "true"; 
?> 
<html>
<head>
<title>:: Confirmacion de radicado ::</title>
<link rel="stylesheet" href="../estilos_totales.css">
</head>

<body bgcolor="#FFFFFF" text="#000000">
<?
  $var_envio=session_name()."=".trim(session_id())."&leido=no&krd=$krd&ent=$ent&carp_per=$carp_per&datoVer=985&carp_codi=$carp_codi&rad=$nurad&coddepe=$coddepe&depende=$depende&radi_usua_actu=radi_usua_actu&nomcarpeta=Actualizacion al Radicar";
?>
<SCRIPT>
function datos_generales()
{
  window.open("../verradicado.php?verrad=<?=$nurad?>&<?=$var_envio?>","Modificación_de_Datos","height=700,width=650,scrollbars=yes");
  
}
</SCRIPT>
<?php
if (strlen($nurad)==14) $consecutivo =6; else  $consecutivo =5; 
$x1=substr($nurad,0,4);
$x2=substr($nurad,4,3);
$x3=substr($nurad,7,$consecutivo);
$x4=substr($nurad,-1);
?> 
<table width="100%" border="0" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" height="100%" class="t_bordeGris">
  <tr>
    <td valign="middle" align="center">      <div align="center">
        <table width="98%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="52%" align="center"><br>
              <img src="../imagenes/radicado.gif" width="232" height="25"><br>
            <font face="Arial, Helvetica, sans-serif" size="5" color="#003366"><? echo "$x1-$x2-$x3-$x4";?></font>  </td>
          </tr>
        </table>
        <font face="Arial, Helvetica, sans-serif" size="4" color="#009933"><u><b> 
        <font color="#000000"> </font></b> </u></font><font face="Arial, Helvetica, sans-serif"><b><br>
        <input type="button" name="Submit" value="CERRAR VENTANA" onClick="window.close()" class="ebuttons2">
        <input type="button" name="Submit2" value="TIPIFICAR DOCUMENTOS" onClick="datos_generales()" class="ebuttons2">
		
</b></font></div>
    </td>
  </tr>
</table>
</body>
</html>
