<? 
/**
 * Este programa despliega el menú principal de correspondencia masiva
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */
error_reporting(7);
session_start();
$ruta_raiz = "../../";

require_once("$ruta_raiz/include/db/ConnectionHandler.php"); 
//Si no llega la dependencia recupera la sesión
if(!$_SESSION['dependencia']) include "$ruta_raiz/rec_session.php";

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$phpsession = session_name()."=".session_id(); ?>
<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<table width="47%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
     <tr> 
      <td height="25" class="titulos4"> 
        RADICACION MASIVA DE DOCUMENTOS
      </td>
    </tr>
    <tr align="center"> 
      <td class="listado2" > 
        <a href='upload2.php?<?=$phpsession ?>&krd=<?=$krd?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' class="vinculos"  target='mainFrame'>Generar 
          Radicaci&oacute;n Masiva</a>
      </td>
    </tr>
    <tr align="center"> 
      <td class="listado2" > 
        <a  href="../cuerpo_masiva_recuperar_listado.php?<?=$phpsession ?>&krd=<?=$krd?>" class="vinculos">Recuperar 
          Listado</a>
      </td>
    </tr>
    <tr align="center"> 
      <td class="listado2" > 
        <a  href='consulta_depmuni.php?<?=$phpsession ?>&krd=<?=$krd?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>Consultar 
          Divisi&oacute;n Pol&iacute;tica Administrativa de Colombia (DIVIPOLA)</a>
      </td>
    </tr>
    <tr align="center"> 
      <td class="listado2" > 
        <a  href='consultaESP.php?<?=$phpsession ?>&krd=<?=$krd?>&krd=<?=$krd?>&<? echo "fechah=$fechah"; ?>' target='mainFrame' class="vinculos">Consultar 
          ESP </a>
      </td>
    </tr>
    
  </table>
</body>
</html>
