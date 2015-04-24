<a href='listar.php?ano=2007:'>Listar a&ntilde;o 2007</a><br>
<a href='listar.php?ano=2006'>Listar a&ntilde;o 2006</a><br>
<a href='listar.php?ano=2005'>Listar a&ntilde;o 2005</a><br>
<a href='listar.php?ano=2004'>Listar a&ntilde;o 2004</a><br>
<a href='listar.php?ano=2003'>Listar a&ntilde;o 2003</a><br>
<a href='listar.php?ano=2002'>Listar a&ntilde;o 2002</a><br>
<a href='listar.php?ano=2001'>Listar a&ntilde;o 2001</a><br>
<a href='listar.php?ano=2000'>Listar a&ntilde;o 2000</a><br>
<a href='listar.php?ano=1999'>Listar a&ntilde;o 1999</a><br>
<a href='listar.php?ano=1998'>Listar a&ntilde;o 1998</a><br>
<a href='listar.php?ano=1997'>Listar a&ntilde;o 1997</a><br>
<a href='listar.php?ano=1996'>Listar a&ntilde;o 1996</a><br>
<?
if(!$ano) $ano = 2002;
$ruta_raiz = "..";
$dir = $ruta_raiz. "/bodega/$ano/res";
$directorio=opendir($dir);
echo "<b><center>Resoluciones Historicas que no estan en Orfeo del año :</b><br>$dir<br></center>";
echo "<b>Archivos:</b><br>";
while ($archivo = readdir($directorio))
  echo "<a href='$dir/$archivo'>$archivo</a><br>";
closedir($directorio);
?>
