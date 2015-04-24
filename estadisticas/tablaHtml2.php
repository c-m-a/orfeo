<html>
<title>ORFEO - IMAGEN ESTADISTICAS </title>
		<link rel="stylesheet" href="../estilos/orfeo.css" />
<body>
   <table width="100%"  border="0" cellpadding="0" cellspacing="5" class="borde_tab">
	<tr >
			<td class="titulos3" width="1">	
			#
			</td>
			<?
			$fieldCount = $rsE->FieldCount();
			if($ascdesc=="")
			{
				$ascdesc = " desc ";
			}else
			{
				$ascdesc = "";
			}
			for($iE=0; $iE<=$fieldCount-1; $iE++)
			{
			$fld = $rsE->FetchField($iE);
			/** El siguietne "if" Omite las columnas que venga con encabezado HID
			   */	
			   
			if(substr($fld->name,0,3)!="HID") 
			{
			?>
			
			<td class="titulos3">	
			<? 
			$linkPaginaActual = $PHP_SELF;
			?>
			<a href='<?=$linkPaginaActual?>?<?=$datosaenviar?>&ascdesc=<?=$ascdesc?>&orno=<?=($iE+1)?>&generarOrfeo=Busquedasss&genDetalle=<?=$genDetalle?>&genTodosDetalle=<?=$genTodosDetalle?>&fenvCodi=<?=$fenvCodi?>&tipoDocumento=<?=$tipoDocumento?>' >
				<?
					echo $fld->name;
				?>
			</a>
			</td>
			<?
			}
			}
			if(!$genDetalle)
			{
			?>
			<td class="titulos3">	</td>			
			<?
			}
			?>
	</tr> 
	<?
	$iRow = 1;
	while(!$rsE->EOF)
	{
	/**  INICIO CICLO RECORRIDO DE LOS REGISTROS
	  *	 En esta seccion se recorre todo el query solicitado
	  *  @numListado Int Variable que almacena 1 O 2 dependiendo de la clase requerida.(Resultado de modulo con doos )
	  */
	  $numListado = fmod($iRow,2);
	  if($numListado==0)
	  {
	  	$numListado = 2;
	  }
	?>
		<tr class='listado<?=$numListado?>' >
			<td width="1">	
			<?=$iRow?>
			</td>
			<?
			$fieldCount = $rsE->FieldCount();
			for($iE=0; $iE<=$fieldCount-1; $iE++)
			{
			$fld = $rsE->FetchField($iE);
			if(substr($fld->name,0,3)!="HID") 
			{
			?>
					<td>
					<?
					
					$pathImg = "";
					if($fld->name=="RADICADO") 
					{
					   $pathImg = $rsE->fields["HID_RADI_PATH"];
					   if(trim($pathImg)) 
					   {
					   	 echo "<a href=$ruta_raiz/bodega/$pathImg>";
					   }
					}


					if($fld->name=="FECHA_RADICADO") 
					{
					   $pathImg = $rsE->fields["HID_RADI_PATH"];
					   if(trim($pathImg)) 
					   {
					   	 echo "<a href='$ruta_raiz/verradicado.php?verrad=". $rsE->fields["RADICADO"]."&from=estadisticas'>";
					   }
					}



						echo $rsE->fields["$fld->name"];
					if(trim($pathImg)) 
					   {
					   	 echo "</a>";
					   }
					?>
					</td>
					<?
					} // fIN DEL IF QUE OMITE LAS COLUMNAS COM HID_
					if($fld->name=="HID_COD_USUARIO") 
					{
						$datosEnvioDetalle="codUs=".$rsE->fields["$fld->name"];
					} 
					if($fld->name=="USUARIO") 
					{
						$nombUs[($iRow-1)]=substr($rsE->fields["$fld->name"],0,21);
						$nombXAxis = "USUARIO";
					}
					if($fld->name=="MEDIO_RECEPCION") 
					{
						$nombUs[($iRow-1)]=substr($rsE->fields["$fld->name"],0,21);
						$nombXAxis = "MED RECEPCION";
					}					
					if($fld->name=="MEDIO_ENVIO") 
					{
						$nombUs[($iRow-1)]=substr($rsE->fields["$fld->name"],0,21);
						$nombXAxis = "MED ENVIO";
					}										

					if($fld->name=="RADICADOS") 
					{
						$data1y[($iRow-1)]=$rsE->fields["$fld->name"];
						$nombYAxis = "RADICADOS";
					}
					if($fld->name=="TOTAL_ENVIADOS") 
					{
						$data1y[($iRow-1)]=$rsE->fields["$fld->name"];
						$nombYAxis = "RADICADOS";
					}					
					if($fld->name=="HOJAS_DIGITALIZADAS") 
					{
						$data2y[($iRow-1)]=$rsE->fields["$fld->name"];
						$nombYAxis .= " / HOJAS DIGITALIZADAS";
					}										
					if($fld->name=="HID_MREC_CODI") $datosEnvioDetalle.="&mrecCodi=".$rsE->fields["$fld->name"];
					if($fld->name=="HID_CODIGO_ENVIO") $datosEnvioDetalle.="&fenvCodi=".$rsE->fields["$fld->name"];
					if($fld->name=="HID_TPR_CODIGO") $datosEnvioDetalle.="&tipoDOCumento=".$rsE->fields["$fld->name"];
					if($fld->name=="HID_FECH_SELEC") $datosEnvioDetalle.="&fecSel=".$rsE->fields["$fld->name"];
			
			}
			if(!$genDetalle)
			{
				if($genTodosDetalle==1)  {
					?>
					<td align="center">
					<A href="genEstadistica.php?<?=$datosEnvioDetalle?>&genDetalle=1&<?=$datosaenviar?>" Target="VerDetalle<?=date("dmYHis")?>">
					</a>
					</td>
					<?
				} else {
					?>
					<td align="center">
					<A href="genEstadistica.php?<?=$datosEnvioDetalle?>&genDetalle=1&<?=$datosaenviar?>" Target="VerDetalle<?=date("dmYHis")?>">
					VER DETALLES
					</a>
					</td>
					<?
				}
	}
	?>
</tr> 
<?
$rsE->MoveNext();
/**  FIN CICLO RECORRIDO DE LOS REGISTROS
  */
 $iRow++;
}
$_SESSION["data1y"] = $data1y;
$_SESSION["nombUs"] = $nombUs;
$noRegs = count($data1y);
?>
</table>
<?
//$nombUs[1] = "JHLC";
//$nombUs = array("ddd","kuiyiuiu","kjop99");
//$data1y = array(11,23,45);
//$nombUs = array("ddd","kuiyiuiu","kjop99");
//$data1y = array(11,23,45);
$nombreGraficaTmp = "$ruta_raiz/bodega/tmp/E_$krd.png";
$rutaImagen = $nombreGraficaTmp;
$notaSubtitulo = $subtituloE[$tipoEstadistica]."\n";
$tituloGraph = $tituloE[$tipoEstadistica];
?>
<br><center><span class="listado5">
Items <?=($iRow-1)?>
</span>
<? if ($tipoEstadistica==1 or $tipoEstadistica==3 or $tipoEstadistica==8)  {
		if ($genTodosDetalle==1 or $genDetalle==1) {
			?>
			<Br>
				<A href="genEstadistica.php?<?=$datosEnvioDetalle?>&genTodosDetalle=1&<?=$datosaenviar?>" Target="VerDetalle<?=date("dmYHis")?>">
				</a>
			</Br>
		<?
		} else {
		?>
			<Br>
				<A href="genEstadistica.php?<?=$datosEnvioDetalle?>&genTodosDetalle=1&<?=$datosaenviar?>" Target="VerDetalle<?=date("dmYHis")?>">
				VER TODOS LOS DETALLES
				</a>
			</Br>
		<?
		}
	}
?>
<?
if($genDetalle!=1 and $noRegs>=1)
{
include "genBarras1.php";
?>
	 <br><input type=button class="botones_largo" value="Ver Grafica" onClick='window.open("./image.php?rutaImagen=<?=$rutaImagen."&fechaH=".date("YmdHis")?>" , "Grafica Estadisticas - Orfeo", "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=560,height=720");'>
      <?
}
?>
</center>
</body>
</html>
