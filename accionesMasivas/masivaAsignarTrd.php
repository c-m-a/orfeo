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
    * Consulta de la serie
    * Con la selecion de una serie se buscaran las respectivas 
    * subserie y tipo documental para incluir radicados en los expedientes.
    * Esta busqueda inicia con el filtro realizado por la dependencia
    * 
    */

  $sql1	="SELECT
	    DISTINCT (cast(S.SGD_SRD_CODIGO as varchar(10))||' - '||S.SGD_SRD_DESCRIP)AS DETALLE
	    ,S.SGD_SRD_CODIGO AS CODIGO_SERIE
	      FROM
	      SGD_MRD_MATRIRD M
	      , SGD_SRD_SERIESRD S
	      WHERE
	      M.DEPE_CODI 			= $dependencia
	      AND S.SGD_SRD_CODIGO 	= M.SGD_SRD_CODIGO
	      AND M.SGD_MRD_ESTA 		= '1'
	      AND $sqlFechaHoy BETWEEN S.SGD_SRD_FECHINI AND S.SGD_SRD_FECHFIN
		      ORDER BY DETALLE";
  $rs	= $db->conn->Execute($sql1);

  while(!$rs->EOF){
    $serieArray[$rs->fields["CODIGO_SERIE"]] = $rs->fields["DETALLE"];
    $rs->MoveNext();				
  }	
  
  //buscamos si los radicados enviados tiene trd o no
  $radicados		= explode(",",$radicados);
	
  foreach ($radicados as $value){
  $sql = "SELECT COUNT(RADI_NUME_RADI) AS TOTAL
            FROM SGD_RDF_RETDOCF
            WHERE RADI_NUME_RADI = $value";
	  
	  $rs		= $db->conn->Execute($sql);
	  $total	= $rs->fields["TOTAL"];	
	  
	  //Si el radicado No tiene trd agregelo al arreglo del grupo correspondiente
	  if(empty($total)){
		  $radSinTrd .= empty($radSinTrd)? $value : ",$value";
	  }else{
		  $radConTrd .= empty($radConTrd)? $value : ",$value"; 
	  }
  }			

  /**
    * El resultados de la logica se coloca en las variables
    * de la plantilla masivaIncluir.tpl
    * parametros para javascript y generar resultados a partir
    * de la depedencia a la cual pertenece el usuario
    */
  $smarty->assign("serieArray"	, $serieArray	); //Series de la dependencia		 
  $smarty->assign("radicados"		, $radicados	); //Radicados que tienen Trd
  $smarty->assign("radSinTrd"		, $radSinTrd	); //Radicados que no tienen Trd
  $smarty->assign("radConTrd"		, $radConTrd	); //Radicados que no tienen Trd	

  $smarty->display('masivaAsignarTrd.tpl');
?>

