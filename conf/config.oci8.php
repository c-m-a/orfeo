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

//Nombre de la base de datos de ORFEO
$servicio = "orfeo2";
//Usuario de conexion con permisos de modificacion y creacion de objetos en la Base de datos.
$usuario = "fltest";
$contrasena= "fltest123"; 

$servidor = "172.16.0.55";
$db = "orfeo";
//Tipo de Base de datos. Los valores validos son: postgres, oci8, mssql.
$driver = "oci8";
 //Variable que indica el ambiente de trabajo, sus valores pueden ser  desarrollo,prueba,orfeo
$ambiente = "desarrollo";
//Servidor que procesa los documentos
$servProcDocs = "172.16.1.200:8080";
$entidad= "SSPD";
$entidad_largo= 'EMPRESA ANONIMA USUARIA DE ORFEO';	//Variable usada generalmente para los t�tulos en informes.
//Telefono o PBX de la empresa.
$entidad_tel = 123456785 ;
//Direccion de la Empresa.
$entidad_dir = "Diag. 22C No 99-995";
$entidad_depsal = 999;	//Guarda el codigo de la dependencia de salida por defecto al radicar dcto de salida
			// 0 = Carpeta salida del radicador	>0 = Redirecciona a la dependencia especificada
/**
*	Se crea la variable $ADODB_PATH.
*	El Objetivo es que al independizar ADODB de ORFEO, este (ADODB) se pueda actualizar sin causar
*	traumatismos en el resto del codigo de ORFEO. En adelante se utilizara esta variable para hacer
*	referencia donde se encuentre ADODB
*/

$ADODB_PATH = "/var/www/orfeo_3.7.2/include/class/adodb";
$ADODB_CACHE_DIR = "/tmp";

$MODULO_RADICACION_DOCS_ANEXOS=1;
/**
 * Configuracion LDAP
 */
//Nombre o IP del servidor de autenticacion LDAP
$ldapServer = '';
//Cadena de busqueda en el servidor.
$cadenaBusqLDAP = '';
//Campo seleccionado (de las variables LDAP) para realizar la autenticacion.
$campoBusqLDAP = 'mail';
//Si esta variable va en 1 mostrara en informacion geneal el menu de Rel. Procedimental, resolucion, sector, causal y detalle. en cero Omite este menu
$menuAdicional = 0;

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
// Directorio de estilos a Usar... Si no se establece una Ruta el sistema usara el que posee por Defecto en el directorio estilos.  orfeo.css para usarlo cree una carpeta con su personalizacion y luego copie el archivo orf eo.css y cambie sus colores.
$ESTILOS_PATH = "/estilos/orfeoIDRD/";
/** $vbAllDependencias Si esta configurada la variable reasignar a Visto Bueno
  *	en 1 visto Bueno a Todas las Dependencias
  */
$vbAllDependencias = 1;
?>
