<?
if(!$FILE_LOCAL) $FILE_LOCAL = "localColombia.php";
$archivo = "$ruta_raiz/include/local/$FILE_LOCAL";
$lineas = file($archivo);
foreach ($lineas as $linea)
{
  $linea = str_replace("$","", $linea);
  $linea = str_replace(";","", $linea);
  $datos = explode("=",$linea);
  $variable = str_replace(" ","",$datos[0]);
  $variableDato = str_replace('"','',$datos[1]);
  //echo "Variable =>" . $variable . "Valor => " . $datos[1]."<hr>";
  $_SESSION[$variable]=$variableDato;
}
?>
