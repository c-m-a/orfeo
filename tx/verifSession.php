<?php
  /** verificacion si el radicado se encuentra en el usuario Actual
    *
    */
  
		$sql = "SELECT 
					R.RADI_USUA_ACTU AS USU,
					R.RADI_DEPE_ACTU AS DEPE,
					R.SGD_SPUB_CODIGO AS PRIVRAD					
				FROM 
					RADICADO R
				WHERE 
					R.RADI_NUME_RADI=$verrad"; 
		# Busca el usuairo Origen para luego traer sus datos.
		$rs = $db->conn->Execute($sql); # Ejecuta la busqueda 
		$verCodusuario = $rs->fields["USU"]; 
		$verDependencia = $rs->fields["DEPE"];  
		$verSeguridadRad = $rs->fields["PRIVRAD"];  
		
		//Buscamos nivel de seguridad del expediente en que se encuentra el radicado
		$sqlExp = "SELECT 
					EXP.SGD_EXP_PRIVADO AS PRIVEXP
				FROM 
					RADICADO R, SGD_SEXP_SECEXPEDIENTES SEXP, SGD_EXP_EXPEDIENTE EXP
				WHERE 
					R.RADI_NUME_RADI=$verrad AND R.RADI_NUME_RADI = EXP.RADI_NUME_RADI AND EXP.SGD_EXP_NUMERO = SEXP.SGD_EXP_NUMERO" ; 
		
		$rs = $db->conn->Execute( $sqlExp );
		$verSeguridadExp = $rs->fields["PRIVEXP"];  
		
		if(( $verSeguridadExp == 0 || $verSeguridadExp == 2 ) && $codusuario == $verCodusuario && $dependencia == $verDependencia ) {		
			$verradPermisos = "Full";
		} elseif ( $verSeguridadExp == 1 && $codusuario == $verCodusuario && $dependencia == $verDependencia && $_SESSION["codusuario"] == 1 ) {
			$verradPermisos = "Full";
		} else {
			$verradPermisos = "Otro";
			$mostrar_opc_envio = 0;
			$modificar = false;			
		}
?>  
