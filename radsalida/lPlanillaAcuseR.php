<?
session_start();

if (!$no_planilla or intval($no_planilla) == 0) die ("<p><hr><b><center><span class=etexto>Debe colocar un Numero de Planilla válido");
if($generar_listado)
{
	error_reporting(7);
	$ruta_raiz = "..";
   	include_once  "../include/db/ConnectionHandler.php";
   	$db = new ConnectionHandler("..");
	define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	include  "../rec_session.php";
	$fecha_ini = $fecha_busq;
    $fecha_fin = $fecha_busq;
	$fecha_ini = mktime($hora_ini,$minutos_ini,00,substr($fecha_ini,5,2),substr($fecha_ini,8,2),substr($fecha_ini,0,4));
	$fecha_fin = mktime($hora_fin,$minutos_fin,59,substr($fecha_fin,5,2),substr($fecha_fin,8,2),substr($fecha_fin,0,4));

// Obtener valores para acuse de recibo
	$order_isql = "  ORDER BY  SGD_RENV_CODIGO,SGD_RENV_VALOR";
	
    $isql = "select * From sgd_enve_envioespecial where sgd_fenv_codigo = 109";
	$rs = $db->query( $isql);
	while(!$rs->EOF)  {
       if (trim($rs->fields["SGD_ENVE_DESC"])=="Valor Descuento Automatico") {
	      $vDescuentoLoc =$rs->fields["SGD_ENVE_VALORL"];
		  $vDescuentoNal =$rs->fields["SGD_ENVE_VALORN"];		
	   }
       if (trim($rs->fields["SGD_ENVE_DESC"])=="Valor Alistamiento") {
	      $vAlistamientoLoc =$rs->fields["SGD_ENVE_VALORL"];
		  $vAlistamientoNal =$rs->fields["SGD_ENVE_VALORN"];		
	   }
       if (trim($rs->fields["SGD_ENVE_DESC"])=="Valor Certificado Acuse de Rec") {
		  $vAcuseLoc =$rs->fields["SGD_ENVE_VALORL"];
		  $vAcuseNal =$rs->fields["SGD_ENVE_VALORN"];		
	   }
	   $rs->MoveNext();
	}

 	$sWhere = ' AND sgd_renv_fech BETWEEN
			  '.$db->conn->DBTimeStamp($fecha_ini). ' AND
			  '.$db->conn->DBTimeStamp($fecha_fin) ;

/** Actualizar valores locales */

	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
   	include "$ruta_raiz/include/query/radsalida/queryLPlanillaAcuseR.php";	

	$whereV = " WHERE SGD_RENV_MPIO 		= '$depe_municipio' 
	    			  AND DEPE_CODI			= $dependencia
					  AND SGD_FENV_CODIGO 	= 109 
					  AND SGD_RENV_VALOR 	!= 0
					  AND " . $wplanilla . "
					  AND sgd_renv_tipo 	< 2"
	            ;
	$rsUpValor = $db->conn->Execute("select * from sgd_renv_regenvio  $whereV $sWhere $order_isql");
	$nregis = 0 ;
	$rvCodigo = $rsUpValor->fields["SGD_RENV_CODIGO"] ;
	if ($rvCodigo)  {
//		$rsUpValor->MoveFirst();
		while (!$rsUpValor->EOF) {
			$nregis = $nregis + 1;
			$rsUpValor->MoveNext();
		}
	}

	if ($nregis > 0)  {
		$rsUpValor = $db->conn->Execute("select * from sgd_renv_regenvio  $whereV $sWhere $order_isql");
//		$rsUpValor->MoveFirst();
		if ($nregis <= 32) $maximo = $nregis; else $maximo = 32;
		for ($cont = 1; $cont <= $maximo; $cont++ ) {
			$renv_codigo = $rsUpValor->fields["SGD_RENV_CODIGO"];  
			$wrc = " AND SGD_RENV_CODIGO = $renv_codigo";
			$isql_updateLoc = "UPDATE SGD_RENV_REGENVIO 
					   SET SGD_RENV_VALISTAMIENTO 	= $vAlistamientoLoc,
	                       SGD_RENV_VDESCUENTO 		= $vDescuentoLoc, 
						   SGD_RENV_VADICIONAL 		= $vAcuseLoc
						   $whereV
						   $wrc
							 ";
			$isql_updateLoc .= $sWhere;
			$rs = $db->query($isql_updateLoc);	
			$rsUpValor->MoveNext();
		}
	}


// Actualizar valores nacionales

	$whereV = " WHERE SGD_RENV_MPIO != '$depe_municipio' 
	    					AND DEPE_CODI			= $dependencia
							AND SGD_FENV_CODIGO 	= 109 
							AND SGD_RENV_VALOR 		!= 0
							AND " . $wplanilla . "
							AND sgd_renv_tipo 		<2
							";

	$rsUpValor = $db->conn->Execute("select * from sgd_renv_regenvio  $whereV $sWhere $order_isql");
	$nregis = 0 ;
	$rvCodigo = $rsUpValor->fields["SGD_RENV_CODIGO"] ;
	if ($rvCodigo)  {
//		$rsUpValor->MoveFirst();
		while (!$rsUpValor->EOF) {
			$nregis = $nregis + 1;
			$rsUpValor->MoveNext();
		}
	}
	if ($nregis > 0)  {
		$rsUpValor = $db->conn->Execute("select * from sgd_renv_regenvio  $whereV $sWhere $order_isql");
		if ($nregis <= 32) $maximo = $nregis; else $maximo = 32;
		for ($cont = 1; $cont <= $maximo; $cont++ ) {
			$renv_codigo = $rsUpValor->fields["SGD_RENV_CODIGO"];  
			$wrc = " AND SGD_RENV_CODIGO = $renv_codigo";
			// Modificado SGD 20-Septiembre-2007
			$isql_updateLoc = "UPDATE SGD_RENV_REGENVIO 
					   SET SGD_RENV_VALISTAMIENTO 	= '".$vAlistamientoNal."',
	    				   SGD_RENV_VDESCUENTO 		= '".$vDescuentoNal."', 
						   SGD_RENV_VADICIONAL 		= '".$vAcuseNal."'
						   $whereV
						   $wrc
						";

			$isql_updateLoc .= $sWhere;
			$rs = $db->query($isql_updateLoc);	
			$rsUpValor->MoveNext();
		}
	}
	$fecha_ini1 = "$fecha_busq $hora_ini:$minutos_ini:00";
   	$fecha_mes = "'" . substr($fecha_ini1,0,7) . "'";
	$sqlChar = $db->conn->SQLDate("Y-m","SGD_RENV_FECH");	

// Seleccionar datos para planillar	
	$ruta_raiz = "..";
   	include_once  "../include/db/ConnectionHandler.php";
   	$db = new ConnectionHandler("..");
   	define('ADODB_FETCH_NUM',1);
	$ADODB_FETCH_MODE = ADODB_FETCH_NUM; 
	
	include "oracle_pdf2.php";

	$pdf = new PDF('L','pt','A3'); 
	$pdf->lmargin = 0.2;
	$pdf->SetFont('Arial','',8);
	$pdf->AliasNbPages();

	$head_table = array ("CANTIDAD","CATEGORIA DE CORRESPONDENCIA","NUMERO DE REGISTRO","DESTINATARIO","DIRECCION","MUNICIPIO","DEPTO","PESO EN GRAMOS","VALOR PORTE","VALOR CERTIFICADO ACUSE RECIBO","VALOR ALISTAMIENTO","VALOR DESCUENTO AUTORIZADO","VALOR TOTAL");
	$head_table_size = array (37   ,95                            ,60                  ,170           ,238        ,95         ,60     ,55              ,50           ,85                              ,70                  ,80                          ,55           );
	$attr=array('titleFontSize'=>10,'titleText'=>''); 
	$arpdf_tmp = "../bodega/pdfs/planillas/$dependencia_". date("Ymd_hms") . "_jhlc.pdf";
	$pdf->SetFont('Arial','',8);
	$pdf->usuario = $usua_nomb;
	$pdf->depe_municipio = $depe_municipio;

	$total_registros = 0;
	$pdf->lmargin = 0.2;
	$i_total3 = 0;
	do
	{  // Amplia
   	include "$ruta_raiz/include/query/radsalida/queryLPlanillaAcuseR.php";	

		$pdf->planilla = $no_planilla;

// Si la variable $generar_listado_existente viene entonces este if genera la planilla existente
		if($generar_listado_existente)  {
			$where_isql = $where_isql1;
		}else  {  // o genera una nueva...
			$where_isql = $where_isql2;
		}
		$query_t = $query . $where_isql . $order_isql;

		$pdf->oracle_report($db,$query_t,false,$attr,$head_table,$head_table_size,$arpdf_tmp,0,31);
		if ($i_total3 == 0)  {
			$i_total3 = $pdf->numrows;
			$total_registros += $i_total3;
		}
	
        if($generar_listado_existente)  {
		   $i_total3 = 0;
	    }else  {
			$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
			//$db->conn->debug = TRUE;
			$rsParaUp = $db->conn->Execute("select * from sgd_renv_regenvio  $where_isql $order_isql");
			$rvCodigo = $rsParaUp->fields["SGD_RENV_CODIGO"] ;
			if ($rvCodigo)  {
//				$rsParaUp->MoveFirst();
				while (!$rsParaUp->EOF) {
					$nregis = $nregis + 1;
					$rsParaUp->MoveNext();
				}
			}
			if ($nregis > 0)  {
				$rsParaUp = $db->conn->Execute("select * from sgd_renv_regenvio  $where_isql $order_isql");
//				$rsParaUp->MoveFirst();	
				if ($nregis <= 32) $maximo = $nregis; else $maximo = 32;
				for ($cont = 1; $cont <= $maximo; $cont++ )  {
					$renv_codigo = $rsParaUp->fields["SGD_RENV_CODIGO"];  
					$wrc = " WHERE SGD_RENV_CODIGO = $renv_codigo AND " . $wplanilla;
		  			$update_isql = "update sgd_renv_regenvio set sgd_renv_planilla='$no_planilla' $wrc";
  					$rs = $db->query($update_isql);	
					$rsParaUp->MoveNext();
				}
			}

	    }
		$no_planilla++;
		$iii++;
		$i_total3 = $i_total3 - 32 ;
		}while ($i_total3>0);
	$pdf->Output($arpdf_tmp);
}
?>
<TABLE BORDER=0 WIDTH=100%>
<TR><TD class="etextomenu"  align="center">
<b>Se han Generado <?=$total_registros?> Registros para Imprimir en <?=$paginas?> Planillas. <br>
<a href='<?=$arpdf_tmp?>' target='<?=date("dmYh").time("his")?>'>Abrir Archivo</a>
</td>
</TR>
</TABLE>
</body>
