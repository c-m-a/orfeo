<?
  $rad = $_GET["rad"];
	$krd = $_GET["krd"];
  $accionSession = $_GET["accionSession"];
	echo "Se añadio el radicado <pre>";
	$fila="../../bodega/tmp/sessR$krd";
  if($accionSession=="Activar"){
		$fp = fopen($fila, "r");
		$contents = fread($fp, filesize($fila));
    if(left($contents,0,len($fila))==$fila){
       echo "ya esta activo el Carritoo de Documentos";
		}else{
			$fp = fopen($fila, 'w');
			$contents = $fila;
		  fwrite($fp, $contents);
		  fclose($fp);
    }
	}else{
	$fp = fopen($fila, 'w');
	$contents = "No Hay Session";
	fwrite($fp, $contents);
	fclose($fp);
		echo "</pre>";
  }
?>