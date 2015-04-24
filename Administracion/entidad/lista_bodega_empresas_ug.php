<?php
session_start();
//$sqlSubstDescBE =  $db->conn->substr."(NOMBRE_DE_LA_EMPRESA, 0, 60)";
	if($condicion !='')
	{
	$isqlC = 'select NOMBRE_DE_LA_EMPRESA	AS NOMBRE_DE_LA_ENTIDAD,
		 	  a.SIGLA_DE_LA_EMPRESA        	AS SIGLA,
		 	  a.NIT_DE_LA_EMPRESA 			AS NIT,
		 	  a.DIRECCION 					AS DIRECCION,
			  a.TELEFONO_1					AS TELEFONO,
			  a.EMAIL						AS EMAIL,
			  a.NOMBRE_REP_LEGAL			AS REPRESENTANTE_LEGAL,
			  b.DPTO_NOMB			  		AS DEPARTAMENTO,
			  c.MUNI_NOMB					AS MUNICIPIO
         	  from BODEGA_EMPRESAS a, DEPARTAMENTO b, MUNICIPIO c
         	  WHERE '.$condicion.'
			  AND a.CODIGO_DEL_DEPARTAMENTO=b.DPTO_CODI
			  AND a.CODIGO_DEL_MUNICIPIO=c.MUNI_CODI
			  AND b.DPTO_CODI=c.DPTO_CODI
		 	  order by ' . $order . ' ' . $orderTipo;    
    }
    else
    {
    $isqlC = 'select 
			  a.NOMBRE_DE_LA_EMPRESA 		AS NOMBRE_DE_LA_ENTIDAD,
		 	  a.SIGLA_DE_LA_EMPRESA        	AS SIGLA,
		 	  a.NIT_DE_LA_EMPRESA 			AS NIT,
		 	  a.DIRECCION 					AS DIRECCION,
			  a.TELEFONO_1					AS TELEFONO,
			  a.EMAIL						AS EMAIL,
			  a.NOMBRE_REP_LEGAL			AS REPRESENTANTE_LEGAL,
			  b.DPTO_NOMB			  		AS DEPARTAMENTO,
			  c.MUNI_NOMB					AS MUNICIPIO
         	  from BODEGA_EMPRESAS a, DEPARTAMENTO b, MUNICIPIO c
			  WHERE a.CODIGO_DEL_DEPARTAMENTO=b.DPTO_CODI
			  AND a.CODIGO_DEL_MUNICIPIO=c.MUNI_CODI
			  AND b.DPTO_CODI=c.DPTO_CODI
		 	  order by ' . $order . ' ' . $orderTipo;
	}
/*	
    error_reporting(7);
 	$rsC=$db->query($isqlC);
  		while(!$rsC->EOF)
		{			    
	  			$nombreempresa  =$rsC->fields["NOMBRE"];
				$siglaempresa    =$rsC->fields["SIGLA"];
				$nitempresa  =$rsC->fields["NIT"];

			$rsC->MoveNext();
  		}
 */
 ?>