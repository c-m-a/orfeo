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
	 * Select para mostrar todas las dependencias
	 */	
	$sql_depe = "SELECT
				      DE.DEPE_CODI AS CODIGO
				      ,(cast(DE.DEPE_CODI as varchar(10))||' - '||DE.DEPE_NOMB) AS NOMBRE
				FROM
				    DEPENDENCIA DE";	
				
	$result_dep = $db->conn->Execute($sql_depe);
			
	while(!$result_dep->EOF){
		$depeArray[$result_dep->fields["CODIGO"]]=
			utf8_encode(htmlentities(trim($result_dep->fields["NOMBRE"])));							
		$result_dep->MoveNext();		
	}		


	/**
	 * Consulta de la serie
	 * Con la selecion de una serie se buscaran las respectivas 
	 * subserie y tipo documental para incluir radicados en los expedientes.
	 * Esta busqueda inicia con el filtro realizado por la dependencia
	 * 
	 */

	$sql1			=	"SELECT
							DISTINCT (CAST(S.SGD_SRD_CODIGO AS VARCHAR(5))||' - '||S.SGD_SRD_DESCRIP) AS DETALLE
						    ,S.SGD_SRD_CODIGO  AS CODIGO_SERIE
						FROM
							SGD_MRD_MATRIRD M
							, SGD_SRD_SERIESRD S
						WHERE
			                M.DEPE_CODI 			= '$dependencia'
							AND S.SGD_SRD_CODIGO 	= M.SGD_SRD_CODIGO
							AND M.SGD_MRD_ESTA 		= '1'
			                AND $sqlFechaHoy BETWEEN S.SGD_SRD_FECHINI AND S.SGD_SRD_FECHFIN
			      			ORDER BY DETALLE";

	$rs				=	$db->conn->Execute($sql1);
	while(!$rs->EOF){
		$serieArray[$rs->fields["CODIGO_SERIE"]] = $rs->fields["DETALLE"];
		$rs->MoveNext();				
	}	
	


	/**
	 * @var $ano_busq select de años para filtrar busqueda
	 * se realiza desde el año actual hasta 10 años antes  
	 */
	
	for($i=0; $i< 10; $i++){
		$anoArray[date("Y") - $i]= date("Y") - $i;		
	}

	/**
	 * Buscar los radicados para mostrar el arbol de 
	 * documentos anexos.
	 */
	
	$radicad		= explode(",",$radicados);
	
	foreach ($radicad as $radi_nume){				
		//Busqueda de radicados anexos, hijos del rad_num
		$sqlF =	"SELECT
					A.RADI_NUME_SALIDA AS RADI_HIJO
    			FROM
    				ANEXOS A
    			WHERE
    				A.ANEX_SALIDA = '1'
    				AND A.ANEX_RADI_NUME = $radi_nume
    				AND A.ANEX_RADI_NUME <> A.RADI_NUME_SALIDA";

        $salida_Sqlf = $db->conn->Execute($sqlF);
		
        while(!$salida_Sqlf->EOF){
        	$rad		= $salida_Sqlf->fields["RADI_HIJO"];
			$rad_hijos .= empty($rad_hijos)? $rad : ",$rad";
			$salida_Sqlf->MoveNext();
        }
	};	

	/**
	 * El resultados de la logica se coloca en las variables
	 * de la plantilla masivaIncluir.tpl
	 * parametros para javascript y generar resultados a partir
	 * de la depedencia a la cual pertenece el usuario
	 */
	
	$smarty->assign("depeArray"		, $depeArray	); //dependencia de la cual se buscan los expedientes
	$smarty->assign("serieArray"	, $serieArray	); //Series de la dependencia		 
	$smarty->assign("radicados"		, $radicados	); //Radicados para incluir en exp
	$smarty->assign("anoArray"		, $anoArray		); //Año actual
	$smarty->assign("depecodi"		, $dependencia	); //dependencia del usuario actual	
	$smarty->assign("rad_hijos"		, $rad_hijos	); //Radicados asociados a los radicaso que se quieren incluir

	$smarty->display('masivaIncluirExp.tpl');
?>

