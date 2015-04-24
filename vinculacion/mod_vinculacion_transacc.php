<?php
if (!$ruta_raiz) $ruta_raiz= "..";
    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	define('ADODB_FETCH_ASSOC',2);
   	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	include_once "$ruta_raiz/include/tx/Historico.php";
    $objHistorico= new Historico($db);
	$arrayRad = array();
	$arrayRad[]=$verrad;
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	if  (count($recordSet)>0)
    	array_splice($recordSet, 0);  		
	if  (count($recordWhere)>0)
    	array_splice($recordWhere, 0);
if ($borrar)
{		
	$isqlM = "select * FROM RADICADO
	            where RADI_NUME_RADI = '$verrad'";
	$rsM=$db->query($isqlM);
	$numRadiBusq = $rsM->fields["RADI_NUME_RADI"];
	if($numRadiBusq != '')
	  {
		$radiDeriAnte = $rsM->fields["RADI_NUME_DERI"];
		$tipoDeriAnte = $rsM->fields["RADI_TIPO_DERI"];
		if  (count($recordSet)>0)
			 array_splice($recordSet, 0);  		
	   	if  (count($recordWhere)>0)
			 array_splice($recordWhere, 0);
		$recordSet["RADI_NUME_DERI"] = "null";
		$recordSet["RADI_TIPO_DERI"] = "null";
		$recordWhere["RADI_NUME_RADI"] = $verrad;	  
	    $ok = $db->update("RADICADO", $recordSet,$recordWhere);
	    array_splice($recordSet, 0);  		
	    array_splice($recordWhere, 0);	  
	    if ($tipVinDocto==0)
		   {$detaTipoVin = "Anexo de";}
		if ($tipVinDocto==2)
		   {$detaTipoVin = "Asociado de";}
	    if($ok)
	       {   
			  $mensaje = "<hr><center><b><span class=info>Vinculacion Eliminada</span></center></b></hr>";
			  $observa = "*Se Elimino la Vinculacion Documento* ($radiDeriAnte) Tipo ($detaTipoVin)";
			  $codusdp = str_pad($dependencia, 3, "0", STR_PAD_LEFT).str_pad($codusuario, 3, "0", STR_PAD_LEFT);	
		      $objHistorico->insertarHistorico($arrayRad,$dependencia ,$codusuario, $dependencia,$codusuario, $observa, 38);
			 }
		 else
			{
			   $mensaje = "<hr><center><b><span class=info>No se Pudo Eliminar la Vinculacion Documento </span></center></b></hr>";
			}
		}
  	   else
	   {
	     $mensaje = "<hr><center><b><span class=info>Numero de Radicado Inexistente</span></center></b></hr>";
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
<input type='button' value='   Cerrar   ' class='botones_largo' onclick='opener.regresar();window.close();'>
</body>
</html> 
