<?php 
require_once($ruta_raiz."/include/myPaginador.inc.php");
  	$whereAnno=(isset($_POST['codAno']) && $_POST['codAno']!="" && $_POST['codAno']!="0")?" AND EX.SGD_SEXP_ANO=".$_POST['codAno']:"";
  	$whereDependencia=" AND EX.DEPE_CODI=".$_POST['dependencia_busq'];
  	
        if(!isset($_GET['genDetalle'])){
        	$tituloProceso=(isset($_POST['codProceso']) && $_POST['codProceso']!="")?"N&uacute;mero de Expedientes":"Total de Procesos";
			$titulos=array("#","1#Usuario","2#".$tituloProceso);
			if(isset($_POST['codProceso']) && $_POST['codProceso']!=""){
	  			$consulta="SELECT SGD_FEXP_DESCRIP,SGD_FEXP_TERMINOS,SGD_FEXP_CODIGO
	                        FROM SGD_FEXP_FLUJOEXPEDIENTES 
	                        WHERE  SGD_PEXP_CODIGO =".$_POST['codProceso']."
	                        ORDER BY SGD_FEXP_ORDEN ";
			  $resultado=$db->query($consulta);
			  $tamTi=count($titulos);
			  while (!$resultado->EOF){
			  	  $titulos[]="#".$resultado->fields['SGD_FEXP_DESCRIP']."(".$resultado->fields['SGD_FEXP_TERMINOS'].")";  	
			      $ubicacion[$resultado->fields['SGD_FEXP_CODIGO']]=$tamTi;
			      $tamTi++;
			      $resultado->MoveNext();
			  }
			  $whereFexp=($_POST['codProceso']!="0")?" AND EX.SGD_FEXP_CODIGO <> 0 ":"";
			 $consultaTotal="SELECT EX.SGD_FEXP_CODIGO,FL.SGD_FEXP_ORDEN,COUNT(*) TOTAL
			 		FROM SGD_SEXP_SECEXPEDIENTES EX 
			 			INNER JOIN SGD_FEXP_FLUJOEXPEDIENTES FL ON EX.SGD_PEXP_CODIGO=FL.SGD_PEXP_CODIGO 
									AND EX.SGD_FEXP_CODIGO=FL.SGD_FEXP_CODIGO
			 		WHERE EX.SGD_PEXP_CODIGO=".$_POST['codProceso']."
			 			{$whereFexp} 
			 			 {$whereDependencia}
			 			 {$whereAnno}
			       GROUP BY EX.SGD_FEXP_CODIGO,FL.SGD_FEXP_ORDEN
			       ORDER BY FL.SGD_FEXP_ORDEN";
			 $resultado=$db->query($consultaTotal);
			 $anterior=3;
			 $total=0;
			 $pie="";
			 while (!$resultado->EOF){
	        				$etapa=$resultado->fields['SGD_FEXP_CODIGO'];
	        				$posicion=$ubicacion[$etapa];
	        				for($i=$anterior;$i<($posicion);$i++){
	        			    	$pie.="<td></td> \n";
	        			    }
	        			    $pie.="<td>".$resultado->fields['TOTAL']."</td>\n";
	        			    $total+=$resultado->fields['TOTAL'];
	        			    $anterior=$posicion+1;
	        			   $resultado->MoveNext();
	        			}
	        for($i=$posicion+1;$i<((count($titulos)));$i++){
	        			$pie.="<td></td> \n";
	       }
			}
	       $consultaTotal="SELECT SUM (TOTAL_PROCESOS) TOTAL FROM ($queryE)";
				 $resultado=$db->query($consultaTotal);
				$pie="<td></td> \n <td>TOTAL</td> \n <td>".$resultado->fields['TOTAL']."</td>".$pie;
			$orden=isset($orden)?$orden:"";
			$paginador=new myPaginador($db,strtoupper($queryE),$orden);
        	$paginador->setImagenASC($ruta_raiz."iconos/flechaasc.gif");
        	$paginador->setImagenDESC($ruta_raiz."iconos/flechadesc.gif");
        	$paginador->setFuncionFilas("pintarEstadProc");
        	$paginador->setPie($pie);
        	echo $paginador->generarPagina($titulos,"titulos3");
			 	
        } else {
        	$titulos=array("#","#USUARIO","#EXPEDIENTE","#FECHA RADICACION","#ESTADO DEL EXPEDIENTE","#PRIMER RADICADO","#NUMERO DE RADICADOS");
        	$queryE="SELECT e.*,radi_path FROM ({$queryE}) e LEFT JOIN radicado r on r.radi_nume_radi=e.DAT_Primer_Radicado ";
        	$paginador=new myPaginador($db,strtoupper($queryE),$orden);
        	$paginador->setImagenASC($ruta_raiz."iconos/flechaasc.gif");
        	$paginador->setImagenDESC($ruta_raiz."iconos/flechadesc.gif");
        	$paginador->setFuncionFilas("pintarEstaDetalle");
        	echo $paginador->generarPagina($titulos,"titulos3");
        }
if((isset($genDetalle) && $genDetalle!=1) and $noRegs>=1)
{
include "genBarras1.php";
?>         <br><input type=button class="botones_largo" value="Ver Grafica" onClick='window.open("./image.php?rutaImagen=<?=$rutaImagen."&fechaH=".date("YmdHis")?>" , "Grafica Estadisticas - Orfeo", "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=560,height=720");'>
      <?
}
?>
<!--
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
		<? /*
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
		// El siguietne "if" Omite las columnas que venga con encabezado HID
					
				
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
	$isqlEstados = "select 
						fe.SGD_FEXP_DESCRIP
						,fe.SGD_FEXP_TERMINOS
						,fe.SGD_FEXP_CODIGO
						,fe.SGD_FEXP_ORDEN
				from SGD_FEXP_FLUJOEXPEDIENTES fe
			where 
				fe.SGD_PEXP_CODIGO ='$codProceso'
				order by fe.SGD_FEXP_ORDEN  ";  
		//$db->conn->debug = true;
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
	{*/
	/**  INICIO CICLO RECORRIDO DE LOS REGISTROS
	  *	 En esta seccion se recorre todo el query solicitado
	  *  @numListado Int Variable que almacena 1 O 2 dependiendo de la clase requerida.(Resultado de modulo con doos )
	  */
		/*$usuaDocProc = $rsE->fields["HID_USUA_DOC"];
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
	if($fld->name=="TOTAL_PROCESOS") 
		{
				$totalProcesos = $totalProcesos + $rsE->fields["TOTAL_PROCESOS"];
			$iTotalProcesos = $iE;
			$datosEnvioDetalles = "$datosEnvioDetalle&genDetalle=1&usuaDocProc=$usuaDocProc&$datosaenviar";
			echo "<a href='genEstadisticaProc.php?$datosEnvioDetalles' target=detallesSec>";
		}
	if(substr($fld->name,0,3)=="DAT") 
	{
      $numRadicado = $rsE->fields["$fld->name"];
      $ImpVerRadicado="<a href=$ruta_raiz/verradicado.php?verrad=$numRadicado&krd=$krd&".$encabezado." target=".$numRadicado.">Ver Inf. </a>";
      echo $ImpVerRadicado;
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
				$queryUs = "select * from usuario where depe_codi=$dependencia_busq and usua_codi=$codus";
				$rsUs = $db->query($queryUs);
				$usuaDocProc = $rsUs->fields["USUA_DOC"];
			}
			$queryEstados = "SELECT fExp.sgd_fexp_orden ORDEN, 
						count(*) CONTEO,
						MIN(sExp.SGD_FEXP_CODIGO) SGD_FEXP_CODIGO
					FROM sgd_sexp_secexpedientes sExp ,
						sgd_pexp_procexpedientes pExp,
						sgd_fexp_flujoExpedientes fexp
					WHERE SExp.sgd_srd_codigo=pExp.sgd_srd_codigo 
						and SExp.sgd_sbrd_codigo=pExp.sgd_sbrd_codigo 
						and pExp.sgd_pexp_codigo=fExp.sgd_pExp_codigo
						and fExp.sgd_fexp_codigo=sExp.sgd_fexp_codigo
						and sExp.usua_doc_responsable='$usuaDocProc'
					group by fExp.sgd_fexp_orden";
			
			$rsEstados = $db->query($queryEstados);
			$estados = "";
			$estadoRegistros=0;
			while(!$rsEstados->EOF)
			{
				$estadoCodigo = $rsEstados->fields["ORDEN"];
				$estadoProc[$estadoCodigo] = $rsEstados->fields["SGD_FEXP_CODIGO"];
				$estadoRegistros += $rsEstados->fields["CONTEO"];
				$estados[$estadoCodigo]= $estadoRegistros;
				$subEstadosTotales[$estadoCodigo]= ($subEstadosTotales[$estadoCodigo]+$estadoRegistros);
				$rsEstados->MoveNext();
			}
			for($k=1;$k<=$colsProc;$k++)
			{
			$descTitulo = $estados[$k] ." Expedientes en Estado ".$etapaFlujoNombres[($k-1)];
			?>
			<td align="center"><center>
			<img src="<?=$ruta_raiz?>/imagenes/investigaciones.jpeg" width=10 height=10  alt="<?=$descTitulo?>" title="<?=$descTitulo?>">
			<a href='genEstadisticaProc.php?<?=$datosEnvioDetalles?>&estadoProc=<?=$estadoProc[$k]?>' target=detallesSec alt="<?=$descTitulo?>" title="<?=$descTitulo?>">
			<?=$estados[$k]?>
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
// FIN CICLO RECORRIDO DE LOS REGISTROS
 
 $iRow++;
}
?>
<tr class=titulos3><td></td><td></td><td></td>
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
*/?>

</center>
</CENTER>
</body>
</html>-->
