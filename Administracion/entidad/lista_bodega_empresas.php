<?php
session_start();
$sqlSubstDescBE =  $db->conn->substr."(NOMBRE_DE_LA_EMPRESA, 0, 60)";
	if($condicion !='')
	{
	$isqlC = 'select  '. $sqlSubstDescBE .' AS NOMBRE,
		 	  SIGLA_DE_LA_EMPRESA        	AS SIGLA,
		 	  NIT_DE_LA_EMPRESA 			AS NIT,
		 	  IDENTIFICADOR_EMPRESA 		AS IDENTIFICADOR
         	  from BODEGA_EMPRESAS
         	  WHERE '.$condicion.'
		 	  order by ' . $order . ' ' . $orderTipo;    
    }
    else
    {
    $isqlC = 'select  '. $sqlSubstDescBE .' AS NOMBRE,
		 	  SIGLA_DE_LA_EMPRESA        	AS SIGLA,
		 	  NIT_DE_LA_EMPRESA 			AS NIT,
		 	  IDENTIFICADOR_EMPRESA 		AS IDENTIFICADOR
         	  from BODEGA_EMPRESAS
		 	  order by ' . $order . ' ' . $orderTipo;
	}
    error_reporting(7);
 	$rsC=$db->query($isqlC);
   		while(!$rsC->EOF)
		{			    
	  			$nombreempresa  =$rsC->fields["NOMBRE"];
				$siglaempresa    =$rsC->fields["SIGLA"];
				$nitempresa  =$rsC->fields["NIT"];

			$rsC->MoveNext();
  		}
 ?>