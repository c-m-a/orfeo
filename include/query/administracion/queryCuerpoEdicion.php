<?php
  if (empty($sqlDependencia))
    $sqlDependencia = null;
	
  $sqlConcat = $db->conn->Concat("usua_doc","'-'","usua_login");
	
  if(!trim($busqRadicados))
    $sqlDependencia = " u.depe_codi = " . $dep_sel . " AND ";
	
  switch($db->driver) {
	case 'mssql':
		$isql = "select 
			u.usua_nomb      		AS NOMBRE
			,u.usua_login	     	AS USUARIO
			,d.depe_nomb			AS DEPENDENCIA
			," . $sqlConcat  . " 	AS CHR_USUA_DOC
		from usuario u, dependencia d 
		where $sqlDependencia u.depe_codi = d.depe_codi " . $dependencia_busq2 . "
		order by " . $order . " " . $orderTipo;

		break;
	default:
		$isql = 'select u.usua_nomb AS "NOMBRE",
			u.usua_login	 AS "USUARIO",
			d.depe_nomb	AS "DEPENDENCIA",
			CASE  WHEN u.usua_codi=1 THEN '."'Jefe'".' END AS "ROL",
      CASE  WHEN u.usua_esta='."'1'" .
              ' THEN ' . "'Activo'" .
            ' WHEN  U.USUA_ESTA <> ' . "'1'" .
              ' THEN ' . "'Inactivo'".' END AS "ESTADO",
			u.usua_email EMAIL,
			u.usua_doc DOCUMENTO,
      U.CODI_NIVEL NIVEL,
			' . $sqlConcat  . ' AS "CHR_USUA_DOC"
		from USUARIO U, DEPENDENCIA D 
		where ' . $sqlDependencia . '
          u.depe_codi = d.depe_codi ' .
          $dependencia_busq2 .
          'order by ' . $order . ' ' . $orderTipo;

	break;
	}
?>
