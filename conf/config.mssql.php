<?php
/** OrfeoGPL 3.8.0
 * Es una Version que mantiene Correlibre
 *@licencia gnu/gpl v 2.0
 *
 * ---- NOTA ----
 * La pagina login.php posee un iframe al final que conecta con Correlibre.org
 * y envia informacion para poseer estadisticas de sitios en los cuales es instalado
 * si ud desea informacion Adicional puede enviar un correo a yoapoyo@orfeogpl.org
 * No se envian contraseñas de sus servicios.
 *
 **/

$servicio = "PbOrfeo";
$usuario = "orfeo";
$contrasena= "orfeo"; 
$servidor = "172.16.1.4";
$db = "PbOrfeo";
$driver = "mssql";
 //Variable que indica el ambiente de trabajo, sus valores pueden ser  desarrollo,prueba,orfeo
$ambiente = "orfeo";
//Servidor que procesa los documentos
$servProcDocs = "172.16.1.62:8080";
$entidad= "DNP";
$entidad_largo= "Departamento Nacional de Planeaci�n";	//Variable usada generalmente para los t�tulos en informes.
$entidad_tel = 5960300 ;
$entidad_dir = "Calle 26 # 13 - 19";

/****
	*	Se crea la variable $ADODB_PATH.
	*	El Objetivo es que al independizar ADODB de ORFEO, �ste (ADODB) se pueda actualizar sin causar
	*	traumatismos en el resto del c�digo de ORFEO. En adelante se utilizar� esta variable para hacer
	*	referencia donde se encuentre ADODB
	*/

$ADODB_PATH = "/var/www/hollman/orfeo_3.5.1/adodb480";
$ADODB_CACHE_DIR = "/var/www/session";

/**
 * _SERVER["SERVER_SOFTWARE"]	Apache/2.0.55 (Unix) PHP/5.0.5
 * _SERVER["SERVER_SOFTWARE"]	Microsoft-IIS/5.1
 */

// Variables que se usan para la radicacion del correo electronio 
// Sitio en el que encontramos la libreria pear instalada
$PEAR_PATH="/home/orfeodev/oburgos/public_html/orfeo-3.7.2/pear/";
// Servidor de Accso al correo Electronico
$servidor_mail="imap.admin.gov.co";
// Tipo de servidor de correo Usado
$protocolo_mail="imap"; // imap  | pop3
// Puerto del servidor de Mail.
$puerto_mail=143; //Segun servidor defecto 143 | 110
//Color de Fondo de OrfeoGPL
$colorFondo = "8cacc1";
// Pais Empresa o Entidad
$pais = "Colombia";
// Correo Contacto o Administrador del Sistema
$administrador = "sunombre@dominio.ooo";

// Directorio de estilos a Usar... Si no se establece una Ruta el sistema usara el que posee por Defecto en el
directorio estilos.  orfeo.css para usarlo cree una carpeta con su personalizacion y luego copie el archivo orf
eo.css y cambie sus colores.
$ESTILOS_PATH = "/estilos/orfeoIDRD/";
/** $vbAllDependencias Si esta configurada la variable reasignar a Visto Bueno
  *	en 1 visto Bueno a Todas las Dependencias
  */
$vbAllDependencias = 1;

?>
