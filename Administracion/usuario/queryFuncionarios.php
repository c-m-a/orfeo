<?
session_start();
//$db->conn->debug = true;
if(!$order) $order = 1;
if($entidad='SES')
	{
	$isql = "select
			 u.usua_nomb      		AS NOMBRE
			,d.depe_nomb			AS DEPENDENCIA
			,u.usua_doc             AS DOCUMENTO
			,u.usua_login	     	AS USUARIO
  		from usuario u, dependencia d
		where u.depe_codi = " . $dep_sel .
		" AND u.depe_codi = d.depe_codi " . $dependencia_busq2 . "
		order by " . $order . " " . $orderTipo;
		
	if($condicion !='')
	{
	$isqlBod = "SELECT *
				FROM BODEGA_EMPRESAS
				WHERE ".$condicion."";

	$rsEnt=$db->query($isqlBod);
	$identificadorEmp=$rsEnt->fields["IDENTIFICADOR_EMPRESA"];

	if($identificadorEmp !='')
	 	{
	 		$isqlEmpUsu = "SELECT IDENTIFICADOR_EMPRESA AS IDENTIFICADOR
			    		   FROM SGD_EMPUS_EMPUSUARIO EU
						   WHERE EU.IDENTIFICADOR_EMPRESA=".$identificadorEmp."";

			$rs=$db->query($isqlEmpUsu);
			$codigo=$rs->fields["IDENTIFICADOR"];
			if($codigo !='')
	 		{
			  $mensajeNM = "La Empresa ya esta asignada";
			  $isqlEnt = "SELECT BE.IDENTIFICADOR_EMPRESA AS IDENTIFICADOR,
							BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
							BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
							BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
							BE.IDENTIFICADOR_EMPRESA AS CHK_IDENTIFICADOR_EMPRESA
							FROM BODEGA_EMPRESAS BE
			    			WHERE 
						        BE.IDENTIFICADOR_EMPRESA NOT IN (SELECT EU.IDENTIFICADOR_EMPRESA
							FROM SGD_EMPUS_EMPUSUARIO EU)
							AND BE.IDENTIFICADOR_EMPRESA=".$identificadorEmp."
       						ORDER BY " . $order . " " . $orderTipo;
	 		}else{
			  $isqlEnt = "SELECT BE.IDENTIFICADOR_EMPRESA AS IDENTIFICADOR,
							BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
							BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
							BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
							BE.IDENTIFICADOR_EMPRESA AS CHK_IDENTIFICADOR_EMPRESA
							FROM BODEGA_EMPRESAS BE
			    			WHERE 
							BE.IDENTIFICADOR_EMPRESA=".$identificadorEmp."
       						ORDER BY " . $order . " " . $orderTipo;

			}
	 	}
	else
		{
		    $mensajeNM = "No existen datos";
		}
 	}
	else
	{

/*
CONSULTA MODIFICADA CARLOS BARRERO
EN LA NUEVA CONSULTA SE ADICIONO LA VISTA QUE TRAE EL NIVEL DE SUPERVISION DE LA ENIDAD


	$isqlEnt = "SELECT BE.IDENTIFICADOR_EMPRESA AS IDENTIFICADOR,
				BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
				BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
				BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
				BE.IDENTIFICADOR_EMPRESA AS CHK_IDENTIFICADOR_EMPRESA
				FROM BODEGA_EMPRESAS BE
			    WHERE BE.IDENTIFICADOR_EMPRESA NOT IN (SELECT EU.IDENTIFICADOR_EMPRESA
				FROM SGD_EMPUS_EMPUSUARIO EU)
				ORDER BY " . $order . " " . $orderTipo;
*/
	$isqlEnt = "SELECT BE.IDENTIFICADOR_EMPRESA AS IDENTIFICADOR,
				BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
				BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
				BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
				V.SUPERVISION AS NIVEL_SUPERVISION,
				BE.IDENTIFICADOR_EMPRESA AS CHK_IDENTIFICADOR_EMPRESA
				FROM BODEGA_EMPRESAS BE,VW_ORFEO_ENTIDADES V 
			    WHERE BE.IDENTIFICADOR_EMPRESA NOT IN (SELECT EU.IDENTIFICADOR_EMPRESA
				FROM SGD_EMPUS_EMPUSUARIO EU)
				AND BE.IDENTIFICADOR_EMPRESA = V.CODIGO_ORFEO
				ORDER BY " . $order . " " . $orderTipo;

	$isqlEnt = "SELECT BE.IDENTIFICADOR_EMPRESA AS IDENTIFICADOR,
				BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
				BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
				BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
				V.SUPERVISION AS NIVEL_SUPERVISION,
				BE.IDENTIFICADOR_EMPRESA AS CHK_IDENTIFICADOR_EMPRESA
				FROM BODEGA_EMPRESAS BE,VW_ORFEO_ENTIDADES V 
			    WHERE BE.IDENTIFICADOR_EMPRESA = V.CODIGO_ORFEO
				ORDER BY " . $order . " " . $orderTipo;


	}
/*
CONSULTA MODIFICADA CARLOS BARRERO
EN LA NUEVA CONSULTA SE ADICIONO LA VISTA QUE TRAE EL NIVEL DE SUPERVISION DE LA ENIDAD

    $isqlEU = "SELECT BE.IDENTIFICADOR_EMPRESA AS IDENTIFICADOR,
			   BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
			   BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
			   BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA
			   FROM BODEGA_EMPRESAS BE,SGD_EMPUS_EMPUSUARIO EU
			   WHERE BE.IDENTIFICADOR_EMPRESA =EU.IDENTIFICADOR_EMPRESA
			   AND EU.USUA_LOGIN = '" . $verempresa . "'
			   ORDER BY " . $order . " " . $orderTipo;
			   
*/
    $isqlEU = "SELECT BE.IDENTIFICADOR_EMPRESA AS IDENTIFICADOR,
			   BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
			   BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
			   BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
			   V.SUPERVISION AS NIVEL_SUPERVISION
			   FROM BODEGA_EMPRESAS BE,SGD_EMPUS_EMPUSUARIO EU,VW_ORFEO_ENTIDADES V 
			   WHERE BE.IDENTIFICADOR_EMPRESA =EU.IDENTIFICADOR_EMPRESA
			   AND EU.USUA_LOGIN = '" . $verempresa . "'
			   AND BE.IDENTIFICADOR_EMPRESA = V.CODIGO_ORFEO
			   ORDER BY " . $order . " " . $orderTipo;

 if ($condicionEPU !='')
 {

	 $isqlBodEmp = "SELECT IDENTIFICADOR_EMPRESA
					FROM BODEGA_EMPRESAS
					WHERE ".$condicionEPU."";

	$rsBodEmp=$db->query($isqlBodEmp);
	$identificadorEmp=$rsBodEmp->fields["IDENTIFICADOR_EMPRESA"];
	
 	if($identificadorEmp !='')
	 	{
	 		$isqlEmpUsu = "SELECT IDENTIFICADOR_EMPRESA AS IDENTIFICADOR
			    		   FROM SGD_EMPUS_EMPUSUARIO
						   WHERE USUA_LOGIN = '" . $verempresa . "'
						   AND IDENTIFICADOR_EMPRESA=".$identificadorEmp."";

			$rs=$db->query($isqlEmpUsu);
			$codigo=$rs->fields["IDENTIFICADOR"];
			if($codigo !='')
	 		{

               $isqlEPU = "SELECT BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
			   BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
			   BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
			   EU.SGD_EMPUS_CODIGO AS CHK_SGD_EMPUS_CODIGO
			   FROM BODEGA_EMPRESAS BE,SGD_EMPUS_EMPUSUARIO EU
			   WHERE BE.IDENTIFICADOR_EMPRESA =EU.IDENTIFICADOR_EMPRESA
			   AND BE.IDENTIFICADOR_EMPRESA = '" . $codigo . "'
			   ORDER BY " . $order . " " . $orderTipo;
	 		}
			else
			{
                $mensaje = "La Empresa no esta asignada  a este usuario";
			}
	 	}
	else
		{
		    $mensaje = "No existen datos";
		}
 }
			   
 else
 {
/*
CONSULTA MODIFICADA CARLOS BARRERO
EN LA NUEVA CONSULTA SE ADICIONO LA VISTA QUE TRAE EL NIVEL DE SUPERVISION DE LA ENIDAD

    $isqlEPU = "SELECT BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
			   BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
			   BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
			   EU.SGD_EMPUS_CODIGO AS CHK_SGD_EMPUS_CODIGO
			   FROM BODEGA_EMPRESAS BE,SGD_EMPUS_EMPUSUARIO EU
			   WHERE BE.IDENTIFICADOR_EMPRESA =EU.IDENTIFICADOR_EMPRESA
			   AND EU.USUA_LOGIN = '" . $verempresa . "'
			   ORDER BY " . $order . " " . $orderTipo;
*/

    $isqlEPU = "SELECT BE.NIT_DE_LA_EMPRESA AS NIT_DE_LA_EMPRESA,
			   BE.NOMBRE_DE_LA_EMPRESA AS NOMBRE_DE_LA_EMPRESA,
			   BE.SIGLA_DE_LA_EMPRESA AS SIGLA_DE_LA_EMPRESA,
			   V.SUPERVISION AS NIVEL_SUPERVISION,
			   EU.SGD_EMPUS_CODIGO AS CHK_SGD_EMPUS_CODIGO
			   FROM BODEGA_EMPRESAS BE,SGD_EMPUS_EMPUSUARIO EU,VW_ORFEO_ENTIDADES V
			   WHERE BE.IDENTIFICADOR_EMPRESA =EU.IDENTIFICADOR_EMPRESA
			   AND EU.USUA_LOGIN = '" . $verempresa . "'
			   AND BE.IDENTIFICADOR_EMPRESA = V.CODIGO_ORFEO
			   ORDER BY " . $order . " " . $orderTipo;

 }
			   
	if($condicionBE !='')
	{
		$sql = "SELECT IDENTIFICADOR_EMPRESA FROM BODEGA_EMPRESAS
			    WHERE IDENTIFICADOR_EMPRESA IN
			    (SELECT SGD_EMPUS_CODIGO FROM SGD_EMPUS_EMPUSUARIO)
			    AND ".$condicionBE."";

        $rs=$db->query($sql);
		$identificador=$rs->fields["IDENTIFICADOR_EMPRESA"];

	 	if($identificador !='')
	 	{
	 	$isqlEntFun = "SELECT EU.USUA_LOGIN AS USUARIO, U.USUA_NOMB, BE.NOMBRE_DE_LA_EMPRESA,
	 				BE.SIGLA_DE_LA_EMPRESA, BE.NIT_DE_LA_EMPRESA, EU.SGD_EMPUS_CODIGO AS CHK_SGD_EMPUS_CODIGO
					FROM SGD_EMPUS_EMPUSUARIO EU, USUARIO U, BODEGA_EMPRESAS BE
					WHERE EU.USUA_LOGIN=U.USUA_LOGIN AND
					EU.IDENTIFICADOR_EMPRESA=BE.IDENTIFICADOR_EMPRESA
				    AND EU.IDENTIFICADOR_EMPRESA=".$identificador."
					ORDER BY " . $order . " " . $orderTipo;
		}
		else
		{
   			$mensaje = "No existen datos";
		}	
		
	}
	else
	{
		$isqlEntFun = "SELECT EU.USUA_LOGIN AS USUARIO, U.USUA_NOMB, BE.NOMBRE_DE_LA_EMPRESA,
	 				BE.SIGLA_DE_LA_EMPRESA, BE.NIT_DE_LA_EMPRESA, EU.SGD_EMPUS_CODIGO AS CHK_SGD_EMPUS_CODIGO
					FROM SGD_EMPUS_EMPUSUARIO EU, USUARIO U, BODEGA_EMPRESAS BE
					WHERE EU.USUA_LOGIN=U.USUA_LOGIN AND
					EU.IDENTIFICADOR_EMPRESA=BE.IDENTIFICADOR_EMPRESA
					ORDER BY " . $order . " " . $orderTipo;
	}
}


	if($asignarEntidad)
	{
		$num = count($checkValue);
		$i = 0;
		while ($i < $num)
		{
	 		$record_id = key($checkValue);
	 		$radicados_asig .= $record_id .",";
	 		$radicados_sel = $record_id;
	 		$chkt = $radicados_sel;

			$isqlCount = "select max(SGD_EMPUS_CODIGO) as NUME from SGD_EMPUS_EMPUSUARIO";
			$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	   		$rsC = $db->query($isqlCount);
			$numreg = $rsC->fields["NUME"];
			$numreg = $numreg+1;
			$record = array(); # Inicializa el arreglo que contiene los datos a insertar

			$record["SGD_EMPUS_CODIGO"] = $numreg;
			$record["SGD_EMPUS_ESTADO"] = '1';
			$record["USUA_LOGIN"]="'".$verempresa."'";
			$record["IDENTIFICADOR_EMPRESA"] = $chkt;
			$insertSQL = $db->insert("SGD_EMPUS_EMPUSUARIO", $record, "true");
 			next($checkValue);
			$i++;
		}
	}
	
	if($eliminarEntidad)
	{
		$num = count($checkValue);
		$i = 0;
		while ($i < $num)
		{
	 		$record_id = key($checkValue);
	 		$radicados_eli .= $record_id .",";
	 		$radicados_sel = $record_id;
	 		$chkt = $radicados_sel;

			$record = array(); # Inicializa el arreglo que contiene los datos a insertar

			$record["SGD_EMPUS_CODIGO"] = $chkt;
			$insertSQL = $db->delete("SGD_EMPUS_EMPUSUARIO", $record, "true");
 			next($checkValue);
			$i++;
		}
	}

?>
