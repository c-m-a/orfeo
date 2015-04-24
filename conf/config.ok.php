<?php
// Archivo de configuracion de orfeo
$servicio = "orfeo_old";
$entidad_depsal = 999;		/*
				 * Variable para que los radicados de salida que se
				 * generen el sistema los envie directamente a dependencia de salida 999
				 */
//$usuario = "fldoc";
$usuario = "postgres";
//$contrasena= "fdoc225orfeo";
$contrasena= "orfeo-db"; 
//$servidor = "172.16.0.52";
$servidor = "localhost:5432";
//$dirora = "/oracle1/product/817";
// Configuracion de la conexion
/*
$db = "(DESCRIPTION=(ADDRESS_LIST=
        (ADDRESS=(PROTOCOL=TCP)
        (HOST=$servidor)(PORT=1521)))
        (CONNECT_DATA=(SERVICE_NAME=$servicio)))";
*/
$db = "orfeo_old";
//$driver = "oci8";
$driver = "postgres";
//$ambiente = "orfeo";
//$ambiente = "desarrollo";
$ambiente = "produccion";
//Servidor que procesa los documentos
$servProcDocs = "localhost:8080";
//$servProcDocs = "172.16.1.200:8080";
$entidad= "IDRD";
$version = "V 3.7";
//$entidad_largo = "Superintendencia de Servicios Publicos Domiciliarios <b><i>$version</i></b>";
$entidad_largo = "ALCALDIA MAYOR DE BOGOTA D.C. <br> Instituto Distrital para la Recreacion y el Deporte";
//Indica el servidor donde se encuentra el servlet de firma digital
$servFirma = "172.16.1.50:89/web/servlet/servletFirma";
//Indica el servidor web que contiene Orfeo
//$servWebOrfeo = "http://atlas/orfeo/";
$servWebOrfeo = "http://localhost/orfeo_3.7pg/";
// Configuracion para el modulo de sancionados
$MODULO_DOCUMENTOS_ANEXADOS = 3;
$MODULO_ENVIOS = 10;
$MODULO_TRANSACIONES_BASICAS = 4;
$MODULO_RADICACION_DOCS_ANEXOS = 5;
$MODULO_ANULACION = 11;
// Variables para configuracion de autorizacion contra el ldap
$ldapServer =  'ldap://ldap2.admin.gov.co';
$cadenaBusqLDAP = 'ou=People, o=usuarios,o=superservicios.gov.co';
$campoBusqLDAP = 'mail';

$ADODB_PATH = "/var/www/orfeo2/adodb493a";
?>
