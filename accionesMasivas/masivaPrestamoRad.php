<?php
include_once	("confSmarty.php");	
	/**
	 * Created on 30/07/2009
	 * include_once	("confSmarty.php")
	 * trae la session, adodb, elementos
	 * enviados desde el Post, Get, sesion
	 * y la configuracion de los templates
	 */	
	
			
	/**
	 * Buscar los radicados que estan ya solicitados
	 * en prestamos y los que no pueden solicitar
	 * por que el usuario no los tiene un la bandeja
	 */
	
	$radicad		= explode(",",$radicados);
	
	foreach ($radicad as $radi_nume){
	 
		$sql_exis 	= "	SELECT
						      COUNT(1) AS TOTAL
						FROM 
							PRESTAMO PR,
						    RADICADO RA					     
						WHERE
						     PR.DEPE_CODI 			= $dependencia 
						     AND RA.RADI_USUA_ACTU 	= $codusuario
						     AND PR.RADI_NUME_RADI 	= $radi_nume
						     AND PR.PRES_ESTADO 	IN (1,2,5)
						     AND PR.RADI_NUME_RADI 	= RA.RADI_NUME_RADI
						     AND RA.RADI_DEPE_ACTU 	= PR.DEPE_CODI";	
					
		$result		= $db->conn->Execute($sql_exis);
				
		$total		= $result->fields["TOTAL"];	
		
		//Si el radicado No esta como solicitado, prestado, devuelto, cancelado, vencido 
		if(empty($total)){
			$radLibre .= empty($radLibre)? $radi_nume : ",$radi_nume";
		}else{
			$radRestr .= empty($radRestr)? $radi_nume : ",$radi_nume"; 
		}
	};	

	/**
	 * El resultados de la logica se coloca en las variables
	 * de la plantilla .tpl
	 * parametros para javascript y generar resultados a partir
	 * de la depedencia a la cual pertenece el usuario
	 */	
	//$vars = get_defined_vars(); print_r($vars["$_SESSION"]);
	
	
	$smarty->assign("radLibre"		, $radLibre	); //Radicados asociados a los radicaso que se quieren incluir
	$smarty->assign("radRestr"		, $radRestr	); //Radicados asociados a los radicaso que se quieren incluir

	$smarty->display('masivaPrestamoRad.tpl');
?>