<?php
/*
 * $Clase base de Oracle en php $
 *
 * $autor: Sixto Angel Pinzón López
 *
 *
 *
 */
if (!$ruta_raiz)
	include_once ('phplib/php/db_oracle.inc');
else
	include_once ($ruta_raiz.'/phplib/php/db_oracle.inc');


	class OracleConnection  {
	
		var $cursor;


		function getconnection(){

		   // CONFIG
		$servicio = "prueba";
		$dirora = "c:\oracle\ora81";
		$usuario = "orfeo";
		$contrasena= "super";
		$servidor = "orfeo";
		putenv("ORACLE_SID=$servicio");
		putenv("ORACLE_HOME=$dirora");
		$handle = ora_logon("$usuario@$servicio", "$contrasena");
		if (!$handle)
			print ("NO HAY CONEXION   ........................");


		   // FIN CONFIG

		$q= new DB_Sql;
		$q->Home = "$dirora";
		$q->Database = "(DESCRIPTION=
			(ADDRESS_LIST=
			(ADDRESS=(PROTOCOL=TCP)
			(HOST=$servidor)(PORT=1521)
			)
			)
			(CONNECT_DATA=(SERVICE_NAME=PRUEBA))
			)";
			$q->User = "$usuario";
			$q->Password = "$contrasena";
			$this->cursor = $q;


			}
			
			
			

			

	}

?>
