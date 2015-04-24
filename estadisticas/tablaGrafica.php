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
			$linkPaginaActual = $PHP_SELF;
					$fld = $rsE->FetchField($iE);
			}
			if(!$genDetalle)
			{
			}
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
			$fieldCount = $rsE->FieldCount();
			for($iE=0; $iE<=$fieldCount-1; $iE++)
			{
					$path = "";
					if($rsE->fields["$fld->name"]=="RADICADO") 
					{
						$path = $rsE->fields["HID_RADI_PATH"];
					   if(trim($path)) 
					   {
					   }
					}
					$fld = $rsE->FetchField($iE);
					if($fld->name=="HID_COD_USUARIO") 
					{
						$datosEnvioDetalle="codUs=".$rsE->fields["$fld->name"];
					}
					if($fld->name=="USUARIO") 
					{
						$nombUs[$iRow]=$rsE->fields["$fld->name"];
						$nombYAxis = "USUARIO";
					}
					if($fld->name=="RADICADOS") 
					{
						$data1y[($iRow)]=$rsE->fields["$fld->name"];
						$nombYAxis = "RADICADOS";
					}
					if($fld->name=="HID_MREC_CODI") $datosEnvioDetalle.="&mrecCodi=".$rsE->fields["$fld->name"];
					if($fld->name=="HID_CODIGO_ENVIO") $datosEnvioDetalle.="&fenvCodi=".$rsE->fields["$fld->name"];
					if($fld->name=="HID_TPR_CODIGO") $datosEnvioDetalle.="&tipoDocumento=".$rsE->fields["$fld->name"];
					   if(trim($path)) 
					   {
					   }
				?>
			<?
			}
			if(!$genDetalle)
			{
			?>
	<?
	}
	?>
<?
$rsE->MoveNext();
/**  FIN CICLO RECORRIDO DE LOS REGISTROS
  */
 $iRow++;
}
?>
<?
error_reporting(7);
//$nombUs[1] = "JHLC";
//$nombUs = array("ddd","kuiyiuiu","kjop99");
//$data1y = array(11,23,45);
include "genBarras1.php";
?>