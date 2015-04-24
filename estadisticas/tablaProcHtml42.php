<html>
<title>ORFEO - IMAGEN ESTADISTICAS </title>
		<link rel="stylesheet" href="../estilos/orfeo.css" />
<body>
<CENTER>
   <table border="0" cellpadding="0" cellspacing="2" class="borde_tab">
	<tr >
		<td class="titulos3" width="1">	
		# <?=$estadoProc?>
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
	<?
	$codigoTipoExp=1;
	$whereProceso =  (isset($codProceso) && $codProceso != '') ? " WHERE fe.SGD_PEXP_CODIGO ='$codProceso'" : '';
	$isqlEstados = "SELECT 
						fe.SGD_FEXP_DESCRIP
						,fe.SGD_FEXP_TERMINOS
						,fe.SGD_FEXP_CODIGO
						,fe.SGD_FEXP_ORDEN
				FROM SGD_FEXP_FLUJOEXPEDIENTES fe
				$whereProceso
				order by fe.SGD_FEXP_ORDEN  ";
		$rs2 = $db->query($isqlEstados);
		$terminosTotales = 0;
	$colsProc = 0;
	if($rs2)
	{
		while(!$rs2->EOF)
		{
			$etapaFlujo = $rs2->fields["SGD_FEXP_DESCRIP"];
			$etapaFlujoTerminos = $rs2->fields["SGD_FEXP_TERMINOS"];
			$etapaFlujoNombres[$colsProc]=$etapaFlujo;
				?>
						<TD class="titulos3" align="center"><?=$etapaFlujo?></TD>
				<?
			$colsProc++;
			$rs2->MoveNext();
		}
	}
	?><td class="titulos3">	</td>	<? 
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
		$usuaDocProc = $rsE->fields["HID_USUA_DOC"];
	  $numListado = fmod($iRow,2);
	  $expNumeroActual = $rsE->fields["EXPEDIENTE"];
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
	if($fld->name=="TOTAL_PROCESOS") 
		{
				$totalProcesos = $totalProcesos + $rsE->fields["TOTAL_PROCESOS"];
			$iTotalProcesos = $iE;
			$datosEnvioDetalles = "$datosEnvioDetalle&genDetalle=1&usuaDocProc=$usuaDocProc&$datosaenviar";
			echo "<a href='genEstadisticaProc.php?$datosEnvioDetalles' target=detallesSec>";
		}
			echo $rsE->fields["$fld->name"];
		if(trim($pathImg) or $fld->name=="TOTAL_PROCESOS") 
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
		if($fld->name=="HID_DEPE_USUA") $datosEnvioDetalle.="&depeUs=".$rsE->fields["$fld->name"];
		if($fld->name=="HID_FECH_SELEC") $datosEnvioDetalle.="&fecSel=".$rsE->fields["$fld->name"];
		if($fld->name=="HID_USUA_DOC") {
				$usuaDocProc = $rsE->fields["$fld->name"];
				$datosEnvioDetalle.="&usuaDoc=".$rsE->fields["$fld->name"];
		}
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
			if(!$usuaDocProc)
			{
				$queryUs = "SELECT * FROM USUARIO WHERE DEPE_CODI = $dependencia_busq AND USUA_CODI = $codus";
				$rsUs = $db->query($queryUs);
				$usuaDocProc = $rsUs->fields["USUA_DOC"];
			}
			$queryFlujo = "
                 select fExp.SGD_FEXP_ORDEN,
                 fArs.SGD_FARS_CODIGO,
                 fArs.SGD_FEXP_CODIGOFIN,
                 hFld.RADI_NUME_RADI,
                 hFld.SGD_HFLD_FECH,
                 hFld.SGD_HFLD_AUTOMATICO,
                 u.USUA_LOGIN
				  from 
				  	SGD_HFLD_HISTFLUJODOC hFld
				  	,SGD_FARS_FARISTAS fArs
				  	,SGD_FEXP_FLUJOEXPEDIENTES fExp
				  	,USUARIO u
					WHERE
					hFld.SGD_FARS_CODIGO=fArs.SGD_FARS_CODIGO AND
					fArs.SGD_FEXP_CODIGOFIN=fExp.SGD_FEXP_CODIGO AND
					hFld.SGD_EXP_NUMERO = '$expNumeroActual'
					AND hFld.USUA_DOC = u.USUA_DOC";
			$rsFlujo = $db->query($queryFlujo);
			$estados = "";
			$codEstado =array();
			unset($noRad);
			unset($fRad);
			
			while(!$rsFlujo->EOF) {
				$estadoCodigo = $rsFlujo->fields["SGD_FEXP_ORDEN"];
				//Asignando Radicado y su fecha y usuario
				$noRad[$estadoCodigo] = $rsFlujo->fields["RADI_NUME_RADI"];
				$estadoText = $rsFlujo->fields["SGD_HFLD_FECH"] ;
				$estadoText .= ($rsFlujo->fields["SGD_HFLD_AUTOMATICO"] == 0 ) ? ' (<font color="d49825">M</font>)':' (<font color="Red">A</font>)';
				$estadoText .= '<br>(<font color="0002FF">' . $rsFlujo->fields["USUA_LOGIN"] . '</font>)';
				$fRad[$estadoCodigo] = $estadoText;
				$rsFlujo->MoveNext();
			}
			
			for ($k=1;$k<=$colsProc;$k++) {
				$descTitulo = $estados[$k] ." Expedientes en Estado ".$etapaFlujoNombres[($k-1)];
			?>
			<td align="center">
			<?=($noRad[$k] == "") ? "" : $noRad[$k];?>
			<?=($fRad[$k] == "") ? "" : $fRad[$k];?>
			</a>
			</td>
			<?
			}
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
?>
<tr class=titulos3><td></td><td></td>
<?
if(!$genDetalle)
{
$rs2 = $db->query($isqlEstados);
		while(!$rs2->EOF)
		{
			$etapaFlujo = $rs2->fields["SGD_FEXP_DESCRIP"];
			$etapaFlujoTerminos = $rs2->fields["SGD_FEXP_TERMINOS"];
			$etapaFlujoNombres[$colsProc]=$etapaFlujo;
				?>
						<TD class="titulos3" align="center"><?=$etapaFlujo?></TD>
				<?
			$colsProc++;
			$rs2->MoveNext();
		}
}
?>
</tr>
<tr class=titulos3>
<?
for($iE=0; $iE<=($fieldCount+$colsProc); $iE++)
{
	if($iTotalProcesos==($iE-1))
	{
		echo "<td>$totalProcesos</td>";
	}else
	{
		
		if($iTotalProcesos<=($iE-2))
		{
			echo "<td>";
			echo $subEstadosTotales[$iE-2];
			echo "</td>";
		}else
		{
			echo "<td></td>";
		}
	}
}
$_SESSION["data1y"] = $data1y;
$_SESSION["nombUs"] = $nombUs;
$noRegs = count($data1y);
?>
</tr>
<tr>
<td class="titulos3" align="center" colspan="13">
(<font color="Red">M</font>) Flujo Manual , (<font color="Red">A</font>) Flujo Automatico
</td>
</tr>
</table>

<?
error_reporting(7);
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
</CENTER>
</body>
</html>
