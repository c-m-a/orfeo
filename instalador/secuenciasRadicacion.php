<?php
/**
 * secuenciasRadicacion.php
 * Autor: Infométrika Ltda.
 * Fecha creación: 09 - Noviembre - 2009
 * Fecha última modificación:
 * Autor última modificación:
 * Descripción: Este script permite crear las secuencias de radicación requeridas por el Sistema
 * de Gestión Documental Orfeo/GPL.
 * En la tabla DEPENDENCIA de la Base de Datos se deben haber ingresado previamente todas
 * las dependencias con su respectivo código, se deben haber creado todas las columnas asociadas
 * a los diferentes tipos de radicación y se deben haber ingresado los códigos de las dependencias 
 * de los cuales se tomarán las secuencias para numerar. (Ver http://orfeogpl.org/ata/node/250 -> Parametrización de tipos de radicación por Martha Mera)
 */

?>
<html>
  <head>
    <title>Sistema de Gesti&oacute;n Documental Orfeo/GPL - Secuencias de radicaci&oacute;n</title>
  </head>
  <body>
    <form name='frmInfoConexionBD' id='frmInfoConexionBD' method='POST' action="<?php print $_SERVER['PHP_SELF']; ?>">
      Conexi&oacute;n a la BD:
      <table>
        <tr>
          <td>
	    <input type='radio' name='modoConexionBD' value='0' checked>
	    Usar archivo config.php
	  </td>
        </tr>
        <tr>
	  <td>
	    <input type='radio' name='modoConexionBD' value='1'>
	    Ingresar datos de conexi&oacute;n a la BD
	  </td>
	</tr>
	<tr>
	  <td>Motor de BD:</td>
	  <td>
	    <input type='radio' name='driver' value='postgres' checked>Postgres
	    <br>
	    <input type='radio' name='driver' value='oci8'>Oracle
	    <br>
	    <input type='radio' name='driver' value='mssql'>MS SQL Server (Usar ADOdb)
	  </td>
	  <td>Nombre de la BD:</td>
	  <td><input type='text' name='bd' value='<?php print $_POST['bd']; ?>' ></td>
	</tr>
	<tr>
	  <td>Servidor:</td>
	  <td><input type='text' name='servidor' value='localhost'></td>
	  <td>Puerto:</td>
	  <td><input type='text' name='puerto' value='5432'></td>
	</tr>
	<tr>
          <td>Usuario de conexi&oacute;n a la BD:</td>
	  <td><input type='text' name='usuario' value='<?php print $_POST['usuario']; ?>' ></td>
          <td>Contrase&ntilde;a de conexi&oacute;n a la BD:</td>
	  <td> <input type='password' name='contrasena'></td>
        </tr>
	<tr>
	  <td>
	    <input type='submit' value='Generar SQL Crear Secuencias' name='sqlCrearSecuencias'>
	    <input type='submit' value='Generar SQL Reiniciar Secuencias' name='sqlReiniciarSecuencias'>
	  </td>
	</tr>
	<tr>
	  <td>
	    <input type='submit' value='Ejecutar SQL Crear Secuencias' name='crearSecuencias'>
	    <input type='submit' value='Ejecutar SQL Reiniciar Secuencias' name='reiniciarSecuencias'>
	  </td>
	</tr>
	<tr>
	  <td>
	    <input type='submit' value='Crear Secuencias con ADOdb' name='crearSecuenciasADOdb'>
	    &nbsp;
	    <input type='submit' value='Reiniciar Secuencias con ADOdb' name='reiniciarSecuenciasADOdb'>
	  </td>
	</tr>
      </table>
    </form>
  </body>
</html>
<?php
// Ruta del directorio que contiene los scripts de Orfeo/GPL
$ruta_raiz = "..";

if( $_POST['modoConexionBD'] === '0' ){
	include_once ( $ruta_raiz.'/config.php' );
	include_once ( $ruta_raiz.'/include/db/ConnectionHandler.php' );

	// Conexión a la BD utilizando los datos del archivo config.php
	$conexion = new ConnectionHandler( $ruta_raiz );
	$db =& $conexion->conn;
	
} else if( $_POST['modoConexionBD'] === '1' ){

	include( $ruta_raiz.'/adodb/adodb.inc.php' );
	// Nombre de la base de datos de Orfeo.
	$bd = $_POST['bd'];
	// Usuario de conexión con permisos de modificación y creación de objetos en la base de datos.
	$usuario = $_POST['usuario'];
	// Contraseña del usuario de conexión a la BD.
	$contrasena= $_POST['contrasena'];
	// Nombre o IP del servidor de BD.
	$servidor = $_POST['servidor'];
	// Puerto de conexión a la BD.
	$puerto = $_POST['puerto'];
	
	// Conexión a la BD utilizando la información ingresada en el formulario.
	$db = NewADOConnection( $_POST['driver'] );
	
	if( $db->Connect( $servidor.':'.$puerto, $usuario, $contrasena, $bd ) == false ){
		die( 'Error de conexi&oacute;n a la BD.' );
	}
}

//$db->debug = true;

// Verifica que se haya establecido la conexión a la BD.
if( $db ){
	// Arreglo con los nombre de las columnas que conforman la tabla DEPENDENCIA.
	$arrColumnas = $db->MetaColumnNames( 'dependencia' );
}

$arrSQLColumnas = array();

// Verifica el arreglo con los nombre de las columnas que conforman la tabla DEPENDENCIA.
if( is_array( $arrColumnas ) ){
	foreach( $arrColumnas as $arrColumnasClave => $arrColumnasValor ){

		if( strlen( $arrColumnasClave ) > strlen( 'DEPE_RAD_TP') &&
		    ( substr_compare( $arrColumnasClave, 'DEPE_RAD_TP', 0, strlen( 'DEPE_RAD_TP') ) === 0 || 
		      substr_compare( $arrColumnasValor, 'depe_rad_tp', 0, strlen( 'depe_rad_tp') ) === 0 ) ){
		      
			/**
			 *Arreglo que contiene los nombres de las columnas de la tabla DEPENDENCIA que coinciden con 
			 * la cadena DEPE_RAD_TP o depe_rad_tp, asociadas a un tipo de radicado específico, p.e. depe_rad_tp1, 
			 * depe_rad_tp2, depe_rad_tp3 o DEPE_RAD_TP1, DEPE_RAD_TP2, DEPE_RAD_TP3.
			 * El índice del arreglo corresponde al código asociado al tipo de radicado, p.e. 1, 2, 3.
			 */
			$arrSQLColumnas[ substr( $arrColumnasClave, strlen( 'DEPE_RAD_TP'), 1 ) ] = $arrColumnasValor;
			
			/**
			 * Arreglo que contiene los códigos asociados a un tipo de radicado, p.e. 1,2,3.
			 * El índice del arreglo corresponde al nombre de la columna de la tabla DEPENDENCIA
			 * que coincide con la cadena DEPE_RAD_TP, asociadas a un tipo de radicado específico, p.e. DEPE_RAD_TP1, 
			 * DEPE_RAD_TP2, DEPE_RAD_TP3.
			 */
			$arrTpRad[ $arrColumnasClave ] = substr( $arrColumnasClave, strlen( 'DEPE_RAD_TP'), 1 );
		}
	}
}
// Verifica que se haya establecido la conexión a la BD.
if( $db ){
	/**
	 * Sentencia SQL para consultar los valores almacenados en las columnas de la tabla DEPENDENCIA asociadas a un 
	 * tipo de radicado específico (depe_rad_tp1, depe_rad_tp2, depe_rad_tp3). Los valores corresponden al código de 
	 * la dependencia de la cual toma la secuencia para generar el consecutivo de un tipo de radicado. p.e. depe_rad_tp1 = 100, 
	 * depe_rad_tp2 = 100, depe_rad_tp3 = 900.
	 */
	$sqlCodDepeSecuencia = 'SELECT '.implode( ',', $arrSQLColumnas ) .
						' FROM dependencia';

	$rsCodDepeSecuencia = $db->Execute( $sqlCodDepeSecuencia );

	$arrCodDepeSecuenciaTpRad = array();
	$arrSQLEliminarSecuencia = array();
	$arrSQLCrearSecuencia = array();

	while( !$rsCodDepeSecuencia->EOF ){

		/**
		 * Arreglo que contiene los valores almacenados en las columnas de la tabla DEPENDENCIA asociadas a un 
		 * tipo de radicado específico (depe_rad_tp1, depe_rad_tp2, depe_rad_tp3). El índice del arreglo corresponde
		 * al nombre de la columna de la tabla DEPENDENCIA asociada a un tipo de radicado específico, p.e. DEPE_RAD_TP1, 
		 * DEPE_RAD_TP2, DEPE_RAD_TP3.
		 */
		$arrCodDepeSecuenciaTpRad = $rsCodDepeSecuencia->GetRowAssoc();
		
		foreach( $arrCodDepeSecuenciaTpRad as $claveArrCodDepeSecuenciaTpRad => $valorArrCodDepeSecuenciaTpRad ){
		
			if( $valorArrCodDepeSecuenciaTpRad != '' &&
			    $valorArrCodDepeSecuenciaTpRad != NULL ){
				
				// Nombre de la secuencia a crear o eliminar.
				$nombreSecuencia = 'secr_tp'.$arrTpRad[ $claveArrCodDepeSecuenciaTpRad ].'_'.$valorArrCodDepeSecuenciaTpRad;
				
				if( isset( $_POST['sqlReiniciarSecuencias'] ) || isset( $_POST['reiniciarSecuencias'] ) || isset( $_POST['reiniciarSecuenciasADOdb'] ) ){
					
					/**
					 * Arreglo que contiene las sentencias SQL para eliminar secuencias.
					 * El índice del arreglo es el nombre de la secuencia, p.e. secr_tp1_900, secr_tp2_900, secr_tp3_900
					 */
					 /*
					$arrSQLEliminarSecuencia[ 'secr_tp'.$arrTpRad[ $claveArrCodDepeSecuenciaTpRad ].'_'.$valorArrCodDepeSecuenciaTpRad ] = 
						'DROP SEQUENCE secr_tp'.$arrTpRad[ $claveArrCodDepeSecuenciaTpRad ].'_'.$valorArrCodDepeSecuenciaTpRad.';';
					*/
					$arrSQLEliminarSecuencia[ $nombreSecuencia ] = 'DROP SEQUENCE '.$nombreSecuencia.';';
					
					//print $sqlEliminarSecuencia.'<br>';
				}
				
				/**
				 * Arreglo que contiene las sentencias SQL para crear secuencias.
				 * El índice del arreglo es el nombre de la secuencia, p.e. secr_tp1_900, secr_tp2_900, secr_tp3_900
				 */
				 /*
				$arrSQLCrearSecuencia[ 'secr_tp'.$arrTpRad[ $claveArrCodDepeSecuenciaTpRad ].'_'.$valorArrCodDepeSecuenciaTpRad ] = 
					'CREATE SEQUENCE secr_tp'.$arrTpRad[ $claveArrCodDepeSecuenciaTpRad ].'_'.$valorArrCodDepeSecuenciaTpRad.'
					INCREMENT 1
					MINVALUE 1
					MAXVALUE 9223372036854775807
					START 1
					CACHE 1;
					ALTER TABLE secr_tp'.$arrTpRad[ $claveArrCodDepeSecuenciaTpRad ].'_'.$valorArrCodDepeSecuenciaTpRad.' OWNER TO '.$usuario.';';
				*/
				$arrSQLCrearSecuencia[ $nombreSecuencia ] = 
					'CREATE SEQUENCE '.$nombreSecuencia.'
					INCREMENT 1
					MINVALUE 1
					MAXVALUE 9223372036854775807
					START 1
					CACHE 1;
					ALTER TABLE '.$nombreSecuencia.' OWNER TO '.$usuario.';';
				
				//print $sqlCrearSecuencia.'<br>';
			}
		}
		
		$rsCodDepeSecuencia->MoveNext();
	}

	if( is_array( $arrSQLEliminarSecuencia ) && !isset( $_POST['reiniciarSecuenciasADOdb'] ) && !isset( $_POST['crearSecuenciasADOdb'] ) ){
		foreach( $arrSQLEliminarSecuencia as $claveSQLEliminarSecuencia => $valorSQLEliminarSecuencia ){
			print $valorSQLEliminarSecuencia.'<br>';
			
			if( isset( $_POST['reiniciarSecuencias'] ) ){
				// Ejecuta las sentencias SQL para eliminar secuencias.
				if( $db->Execute( $valorSQLEliminarSecuencia ) === false ){
					die( 'Error al eliminar la secuencia '.$claveSQLEliminarSecuencia.' '.$db->ErrorMsg() );
				} else{
					print 'Secuencia '.$claveSQLEliminarSecuencia.' eliminada.<br><br>';
				}
			}
		}
	}

	if( is_array( $arrSQLCrearSecuencia ) && !isset( $_POST['reiniciarSecuenciasADOdb'] ) && !isset( $_POST['crearSecuenciasADOdb'] ) ){
		foreach( $arrSQLCrearSecuencia as $claveSQLCrearSecuencia => $valorSQLCrearSecuencia ){	
			print $valorSQLCrearSecuencia.'<br>';
			// Ejecuta las sentencias SQL para crear secuencias.
			if( isset( $_POST['crearSecuencias'] ) || isset( $_POST['reiniciarSecuencias'] ) ){
				if( $db->Execute( $valorSQLCrearSecuencia ) === false ){
					die( 'Error al crear la secuencia '.$claveSQLCrearSecuencia.' '.$db->ErrorMsg() );
				} else{
					print 'Secuencia '.$claveSQLCrearSecuencia.' creada.<br><br>';
				}
			}
		}
	}
	
	// Eliminar secuencia utilizando ADOdb.
	if( isset( $_POST['reiniciarSecuenciasADOdb'] ) ){
		foreach( $arrSQLEliminarSecuencia as $claveSQLEliminarSecuencia => $valorSQLEliminarSecuencia ){
			$db->DropSequence( $claveSQLEliminarSecuencia );
			
			if( $db->ErrorMsg() == '' ){
				print 'Secuencia '.$claveSQLEliminarSecuencia.' eliminada.<br><br>';
			}else{
				print $db->ErrorMsg().'<br>';
			}
		}
	}
	// Crear secuencia utilizando ADOdb.
	if( isset( $_POST['reiniciarSecuenciasADOdb'] ) || isset( $_POST['crearSecuenciasADOdb'] ) ){
		foreach( $arrSQLCrearSecuencia as $claveSQLCrearSecuencia => $valorSQLCrearSecuencia ){	
			// Valor de inicio de la secuencia.
			$inciarEn = 1;
			
			$db->CreateSequence( $claveSQLCrearSecuencia, $inciarEn );
			
			if( $db->ErrorMsg() == '' ){
				print 'Secuencia '.$claveSQLCrearSecuencia.' creada.<br><br>';
			}else{
				print $db->ErrorMsg().'<br>';
			}
		}
	}
}
?>