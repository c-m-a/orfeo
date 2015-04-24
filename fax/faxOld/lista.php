<?php
error_reporting(0);
$krdAnt = $krd;
session_start(); 
if(!$krd)  $krd = $krdAnt;
$ruta_raiz = "..";
if (!$dependencia)   include "../rec_session.php";
error_reporting(7);
$fechah = date("ymd") ."_". time("hms");
?> 
<head>
<html>
<head>
  <title>lista</title>
  <meta name="GENERATOR" content="Quanta Plus">
  <link rel="stylesheet" type="text/css" href="../estilos_totales.css">
  <script language="JavaScript">
	function outbox()
	{
		parent.formulario.location.href="send.php";
	}
  </script>
</head>
<body vlink="#6666CC" alink="#6666CC" link="#6666CC">
<?php include("functions.php"); ?>
<table width="100%" border="0">
<thead>
	<caption>Faxes</caption>
</thead>
  <tbody>
    <tr>
      <td>
      	<img src="../iconos/folder_open.gif" width="20" height="20" border="0">
      	<a href="form.php?lista=inbox&<?=session_name()."=".session_id() ?>&krd=<?=$krd?>&<? echo "fechah=$fechah&usr=".md5($dep)."&primera=1&ent=2&depende=$dependencia"; ?>" title="Tiene <?php print " (".inbox_num().")";?> fax(es) nuevo(s) " class="etextomenu" target="formulario">
		Entrada<?php print " (".inbox_num().")";?>
	</a>
      </td>
    </tr>
    <tr>
       <td><img src="../iconos/folder_open.gif" width="20" height="20" border="0">
      <a href="form.php?lista=outbox" class="etextomenu" title="Faxes Enviados" target="formulario">Salida</a></td>
    </tr>
    <tr>
    	<td><img src="../iconos/folder_open.gif" width="20" height="20" border="0">
      <a href="form.php?lista=process" class="etextomenu" title="Faxes en Proceso de Envio" target="formulario">En Proceso</a></td>
    </tr>
    <tr>
    	<td><img src="../iconos/folder_open.gif" width="20" height="20" border="0">
      <a href="http://172.16.1.168/fax/form.php"  title="Enviar Fax" onclick="outbox();" class="etextomenu" target="formulario">Fax</a></td>
    </tr>
  </tbody>
</table>
</body>
</html>