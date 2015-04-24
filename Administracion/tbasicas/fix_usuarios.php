<?
//ini_set(display_errors,ON);
include('../../config.php'); 		// incluir configuracion.

$con = mssql_connect ("$servidor", "$usuario", "$contrasena");
if ($con)
{	mssql_select_db ("$db", $con);
	$sql= "SELECT usua_doc FROM USUARIO";
	$rs = mssql_query ($sql, $con);
	if ($rs)
	{	while ($row = mssql_fetch_array($rs))
		{	
			$sql="UPDATE USUARIO SET USUA_DOC = NULL WHERE (USUA_DOC = '".trim($row['usua_doc'])."')";
			mssql_query ($sql, $con);
			$sql="UPDATE USUARIO SET USUA_DOC = '".trim($row['usua_doc'])."' WHERE USUA_DOC IS NULL";
			mssql_query ($sql, $con);
		}
		mssql_close ($con);
	}
	else 
	{	echo "Error de SELECT a USUARIO";
	}
}
else 
{	echo "Error de Conexion a BD";
}
?>