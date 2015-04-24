<?php 
  foreach ($_GET as $key => $valor)
    ${$key} = $valor;
	
  require_once($ruta_raiz."/include/myPaginador.inc.php");

	$paginador=new myPaginador($db,($queryE),$orden);
  //$_SESSION["tipoEstadistica"] = $tipoEstadistica;
	$paginador->moreLinks = "&tipoEstadistica=".$_GET['tipoEstadistica']."&codEsp=".$_GET['codEsp']."";

	if(!isset($_GET['genDetalle'])){
		$orden=isset($orden)?$orden:"";
		$paginador->setFuncionFilas("pintarEstadistica");
	} else {
		$paginador->setFuncionFilas("pintarEstadisticaDetalle");
	}
	$paginador->setImagenASC($ruta_raiz."iconos/flechaasc.gif");
	$paginador->setImagenDESC($ruta_raiz."iconos/flechadesc.gif");
	//$paginador->setPie($pie);
	echo $paginador->generarPagina($titulos,"titulos3");

if(!isset($_GET['genDetalle'])&& $paginador->getTotal() > 0){	
	$total=$paginador->getId()."_total";
	if(!isset($_REQUEST[$total])) {
	$res=$db->query($queryE);
	$datos=0;
	while(!$res->EOF){ 
   
		if($tipoEstadistica ==16) $data1y[]=$res->fields[2]; else $data1y[]=$res->fields[1];
		$nombUs[]=$res->fields[0];
		$res->MoveNext();
	}
	$nombYAxis=substr($titulos[1],strpos($titulos[1],"#")+1);
	$nombXAxis=substr($titulos[2],strpos($titulos[2],"#")+1);
	$nombreGraficaTmp = $ruta_raiz."bodega/tmp/E_$krd.png";
	$rutaImagen = $nombreGraficaTmp;
	if(file_exists($rutaImagen)){
		unlink($rutaImagen);
	}
	$notaSubtitulo = $subtituloE[$tipoEstadistica]."\n";
	$tituloGraph = $tituloE[$tipoEstadistica];
	include "genBarras1.php";
}
  if ($tipoEstadistica != 1000)  {
		if ($genTodosDetalle==1 or $genDetalle==1) {
			?>
			<Br>
				<A href="genEstadistica.php?<?=$datosEnvioDetalle?>&genTodosDetalle=1&codEsp=<?=$codEsp?>&<?=$datosaenviar?>" Target="VerDetalle<?=date("dmYHis")?>">
				</a>
			</Br>
		<?
		} else {
		?>
			<Br>
				<A href="genEstadistica.php?<?=$datosEnvioDetalle?>&genTodosDetalle=1&codEsp=<?=$codEsp?>&<?=$datosaenviar?>" Target="VerDetalle<?=date("dmYHis")?>" class="titulos3">
				VER TODOS LOS DETALLES
			</Br>
		<?
		}
	}
?>
<table align="center">
<tr>
	<td>
		<!-- Modfiicado SGD 21-Agosto-2007
	<input type=button class="botones_largo" value="Ver Grafica" onClick='window.open("image.php?rutaImagen=<?=$rutaImagen."&fechaH=".date("YmdHis")?>" , "Grafica Estadisticas - Orfeo", "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=560,height=720");' />
	-->
	<input type=button class="botones_largo" value="Ver Grafica" onClick='window.open("<?php print $ruta_raiz; ?>/estadisticas/image.php?rutaImagen=<?=$rutaImagen."&fechaH=".date("YmdHis")?>" , "Grafica Estadisticas - Orfeo", "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=560,height=720");' />
</td>  	
</tr> 
	</table>
<?
}
?>
</center>
</body>
</html>
