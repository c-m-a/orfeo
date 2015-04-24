<?php
	$sqlConcat = $db->conn->Concat("usua_doc","'-'","usua_login");

	switch($db->driver)
	{
	case 'mssql':
		$isql = "select 
			u.usua_nomb      		AS NOMBRE
			,u.usua_login	     	AS USUARIO
			,d.depe_nomb			AS DEPENDENCIA
			," . $sqlConcat  . " 	AS CHR_USUA_DOC
		from usuario u, dependencia d 
		where u.depe_codi = " . $dep_sel .
		" AND u.depe_codi = d.depe_codi " . $dependencia_busq2 . "
		order by " . $order . " " . $orderTipo;

		break;
	default:
		$isql = 'select 
			u.usua_nomb      AS "NOMBRE"
			,u.usua_login	 AS "USUARIO"
			,d.depe_nomb	AS "DEPENDENCIA"
			,' . $sqlConcat  . ' AS "CHR_USUA_DOC"
		from usuario u, dependencia d 
		where u.depe_codi = ' . $dep_sel .
		' AND u.depe_codi = d.depe_codi ' . $dependencia_busq2 . '
		order by ' . $order . ' ' . $orderTipo;

	break;
	}
?>
