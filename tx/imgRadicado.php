<?
	$db->conn->debug = false;
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$sql = "SELECT 
					RADI_NUME_HOJA,
					CARP_CODI,
					CARP_PER,
					RADI_USUA_ACTU,
					RADI_DEPE_ACTU,
					RADI_NUME_DERI,
					RADI_TIPO_DERI,
					SGD_EANU_CODIGO
				FROM 
					RADICADO
				WHERE 
					RADI_NUME_RADI=$radicado"; 
		# Busca el usuairo Origen para luego traer sus datos.
		$rs3 = $db->conn->query($sql); # Ejecuta la busqueda 
		$Hojas = $rs3->fields["RADI_NUME_HOJA"]; 
		$carpCodi = $rs3->fields["CARP_CODI"]; 
		$carpPer = $rs3->fields["CARP_PER"]; 
		$usuaActu = $rs3->fields["RADI_USUA_ACTU"]; 
		$depeActu = $rs3->fields["RADI_DEPE_ACTU"]; 
		$eanuCodi = $rs3->fields["SGD_EANU_CODIGO"]; 
		if($numeDeri==0 and $tipoDeri)
		{
			$radIcono = $rutaRaiz."/conos/anexos.gif";
		}
		 else 
		{
			$radIcono = $rutaRaiz."/iconos/comentarios.gif";
		}
		$anuComentario = "";
		if($eanuCodi==2)
		{
			$radIcono = $rutaRaiz."/iconos/anulacionRad.gif";
			$anuComentario = "!! RADICADO ANULADO !!";
		}elseif ($eanuCodi==1)
		{
			$radIcono = $rutaRaiz."/iconos/anulacionRad.gif";
			$anuComentario = "!! RADICADO EN SOLICITUD DE ANULACION !!";
		}
		
		if($carpPer==0)
		{
		$sql = "SELECT 
					CARP_CODI,
					CARP_DESC
				FROM 
					CARPETA
				WHERE 
					CARP_CODI=$carpCodi"; 
		# Busca el usuairo Origen para luego traer sus datos.
		$rs3 = $db->conn->query($sql); # Ejecuta la busqueda 
		$carpDesc = $rs3->fields["CARP_DESC"]; 
		}else 
		{
		$sql = "SELECT 
					NOMB_CARP,
					DESC_CARP
				FROM 
					CARPETA_PER
				WHERE 
					USUA_CODI=$usuaActu
					and DEPE_CODI=$depeActu"; 
		# Busca el usuairo Origen para luego traer sus datos.
		$rs3 = $db->conn->query($sql); # Ejecuta la busqueda 
		$carpDesc = $rs3->fields["NOMB_CARP"]; 			
		$carpNomb = $rs3->fields["DESC_CARP"]; 			
		}
	$datosRad = "$anuComentario Carpeta $carpDesc - $carpNomb - ";
	if($hojas)
	$datosRad .= " Numero de Hojas Digitalizadas $hojas";
	$imgRad = " <img src='$radIcono' alt='$datosRad' title='$datosRad' height=20 width=20>";
?>