<?php
if (!$ruta_raiz) $ruta_raiz= "..";
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	include_once "$ruta_raiz/include/tx/Historico.php";

    include_once ("$ruta_raiz/class_control/TipoDocumental.php");
	$trd = new TipoDocumental($db);
if ($borrar)
{		
		$sqlE = "SELECT ANEX_RADI_NUME
					FROM SGD_RDA_RETDOCA 
					WHERE ANEX_RADI_NUME = '$nurad'
					AND ANEX_CODIGO = '$coddocu'
				    AND  SGD_MRD_CODIGO =  '$codiTRDEli'";
		$rsE=$db->conn->query($sqlE);
		$i=0;
		while(!$rsE->EOF)
		{
	    	$codiRegE[$i] = $rsE->fields['ANEX_RADI_NUME'];
	    	$i++;
			$rsE->MoveNext();
		}
		  $observa = "*Elimina Tipo TRD Anexo*".$coddocu;
  		  $Historico = new Historico($db);		  
  		  $radiModi = $Historico->insertarHistorico($codiRegE, $coddepe, $codusua, $coddepe, $codusua, $observa, 33); 
		
		$radicados = $trd->eliminarTRDA($nurad,$coddocu,$coddepe,$usua_doc,$codusua,$codiTRDEli);
		$mensaje="Tipificacion del Anexo ELIMINADA<br> ";
 	}
	/*
  * Proceso de modificación de una clasificación TRD
  */

  if ($modificar)
	{
  		 $mensaje="ERROR EN EL PROCESO PASO 2";
		if ($tdoc !=0 && $tsub !=0 && $codserie !=0 )
			{
				$sqlH = "SELECT ANEX_RADI_NUME,
				        SGD_MRD_CODIGO
					    FROM SGD_RDA_RETDOCA 
					    WHERE ANEX_RADI_NUME = '$nurad'
					    AND ANEX_CODIGO = '$coddocu'
				        AND  DEPE_CODI  =  '$coddepe'
					";
				$rsH=$db->conn->query($sqlH);
				$codiActu = $rsH->fields['SGD_MRD_CODIGO'];
				$i=0;
				while(!$rsH->EOF)
				{
	    			$codiRegH[$i] = $rsH->fields['ANEX_RADI_NUME'];
					
	    			$i++;
					$rsH->MoveNext();
				}
		  		$observa = "*Modificado el TRD del ANEXO " . $coddocu ."dependencia*".$coddepe;
  		  		$Historico = new Historico($db);		  
  		  		$radiModi = $Historico->insertarHistorico($codiRegH, $coddepe, $codusua, $coddepe, $codusua, $observa, 32); 
		  		/*
		  		*Actualiza el campo tdoc_codi de la tabla Anexos
		  		*/
		 		$radiUp = $trd->actualizarTRD($codiRegH,$tdoc);
				$mensaje="Registro Modificado";
		
				// $codiTRDU = nuevo codigo TRD
		
				$isqlTRD = "select SGD_MRD_CODIGO 
							from SGD_MRD_MATRIRD 
							where DEPE_CODI = '$coddepe'
				 	   			  and SGD_SRD_CODIGO = '$codserie'
				       			  and SGD_SBRD_CODIGO = '$tsub'
					   			  and SGD_TPR_CODIGO = '$tdoc'";
			
				$rsTRD = $db->conn->Execute($isqlTRD);
				$codiTRDU = $rsTRD->fields['SGD_MRD_CODIGO'];
				
				$sqlUA = "UPDATE SGD_RDA_RETDOCA 
						  SET SGD_MRD_CODIGO = '$codiTRDU',
						  USUA_CODI = '$codusua'
				          WHERE ANEX_RADI_NUME = '$nurad' 
						        AND ANEX_CODIGO = '$coddocu' 
						        AND  DEPE_CODI =  '$coddepe'";
				$rsUp = $db->conn->query($sqlUA); 
		$mensaje="Registro Modificado   <br> ";
		}
		
}
?>
</script>
<body bgcolor="#FFFFFF" topmargin="0">
<br>
<div align="center">
<p>
<?=$mensaje?>
</p>
<input type='button' value='     Cerrar     ' onclick='opener.regresar();window.close();'>
</body>
</html> 
	
	
	
