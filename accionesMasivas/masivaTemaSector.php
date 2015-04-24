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
	 * Consulta del sector 
	 * Con la selecion de un sector se traera la lista de temas con la cual se realacionara 
	 * el radicados
	 * 
	 */
	
	
	//Buscamos si tenemos 
	$sql1			=	"SELECT
 							(RIGHT('000' + convert(varchar,CA.SGD_CAU_CODIGO),3)+' - '+CA.SGD_CAU_DESCRIP)AS DETALLE
						    ,RIGHT('000' + convert(varchar,CA.SGD_CAU_CODIGO),3) AS CODIGO_SECTOR
						FROM 
							SGD_CAU_CAUSAL CA 
						WHERE 
							CA.SGD_CAU_ESTADO = 1  
						ORDER BY CA.SGD_CAU_CODIGO";

	$rs				=	$db->conn->Execute($sql1);
	while(!$rs->EOF){
		$sectorArray[$rs->fields["CODIGO_SECTOR"]] = $rs->fields["DETALLE"];
		$rs->MoveNext();				
	}	
	
	//buscamos si los radicados enviados tiene trd o no
	$radicados		= explode(",",$radicados);
	
	foreach ($radicados as $value){
		$sql 	= "		SELECT
							COUNT(1) AS TOTAL
						FROM 
							SGD_CAUX_CAUSALES caux
							, SGD_DCAU_CAUSAL dcau 
						WHERE 
							caux.RADI_NUME_RADI = '$value' 
							AND caux.SGD_DCAU_CODIGO = dcau.SGD_DCAU_CODIGO";
		
		$rs		= $db->conn->Execute($sql);
		$total	= $rs->fields["TOTAL"];	
		
		//Si el radicado No tiene sector/tema
		if(empty($total)){
			$radSinSectem .= empty($radSinSectem)? $value : ",$value";
		}else{
			$radConSectem .= empty($radConSectem)? $value : ",$value"; 
		}
	}			

	/**
	 * El resultados de la logica se coloca en las variables
	 * de la plantilla masivaIncluir.tpl
	 * parametros para javascript y generar resultados a partir
	 * de la depedencia a la cual pertenece el usuario
	 */

	$smarty->assign("radSinSectem"	, $radSinSectem	); //Radicado sin tema/sector		 
	$smarty->assign("radConSectem"	, $radConSectem	); //Radicados que tienen Trd
	$smarty->assign("sectorArray"	, $sectorArray	); //Sectores activos	

	$smarty->display('masivaTemaSector.tpl');
?>

