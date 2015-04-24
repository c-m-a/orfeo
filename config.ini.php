<?php
  // Direccion de Orfeo URL
  // http://nombre_dominio

  if (!defined('NOMBRE_SW')) {
    define('NOMBRE_SW', 'ORFEO');
    define('VERSION', '4.0.0');
  }

  if (!defined('NOMBRE_SERVIDOR')) {
    define ('NOMBRE_SERVIDOR', 'nombre_servidor');
    define ('URL_SERVIDOR', 'http://' . NOMBRE_SERVIDOR . '/');
    
    // Si realizo configuracion se servidor apache por dejar la constante en blanco
    define ('DIRECTORIO_ORFEO', 'orfeo/');
    define ('ORFEO_URL',        URL_SERVIDOR . DIRECTORIO_ORFEO);
    define ('URL_INSTALADOR',   ORFEO_URL . 'instalador/');
    define ('ORFEO_URL_BUSCAR', ORFEO_URL . 'buscar/radicado/');
    define ('URL_BODEGA',       ORFEO_URL . 'bodega/');
  }
  
  // Portal entidad
  if (!defined('URL_ENTIDAD')) {
    // Datos de la entidad se usan para la parte de generacion de respuesta rapida
    define ('URL_ENTIDAD', 'http://nombre_de_la_entidad');
    define ('URL_ENTIDAD_STICKER', 'http://nombre_de_la_entidad');
    define ('URL_ENTIDAD_CORTO', 'http://direccion_corta_de_la_entidad');
    define ('URL_TMP', ORFEO_URL . 'bodega/tmp/');
  }
  
  // Directorio donde se encuentra el sistema
  if (!defined('ORFEO_PATH')) {
    // Ruta Absoluta de Orfeo
    // ejemplo define('ORFEO_PATH', '/var/www/html/orfeo/');
    define('ORFEO_PATH', 'ruta absoluta orfeo');
  
    // Bodega de datos orfeo
    define('BODEGA_ORFEO',    ORFEO_PATH . 'bodega/');
    define('BODEGA_TMP',      BODEGA_ORFEO . 'tmp/');
    define('BODEGA_FAX_TMP',  BODEGA_ORFEO . 'faxtmp/');
    $ADODB_PATH      = ORFEO_PATH . 'include/class/adodb';
    $ADODB_CACHE_DIR = '/tmp';
  }

  // Constantes para verificar que pestana esta activa
  if (!defined('HISTORICO')) {
    define('HISTORICO',           1);
    define('DOCUMENTOS',          2);
    define('INFORMACION_GENERAL', 3);
    define('EXPEDIENTES',         4);
  }

  // Tipos de radicados
  if (!defined('ENTRADA')) {
    define('ENTRADA',     2);
    define('SALIDA',      1);
    define('MEMORANDO',   3);
    define('RESOLUCION',  5);
    
    // Tipos de carpetas
    define('CARPETA_VOBO',          11);
    define('AGENDADOS_VENCIDOS',    2);
    define('AGENDADOS_NO_VENCIDOS', 1);
  }

  // Anexos Impresos
  if (!defined('ANEXO_IMPRESO')) {
    define('ANEXO_RECIBIDO', 1);
    define('ANEXO_RADICADO', 2);
    define('ANEXO_IMPRESO', 3);
    define('ANEXO_ENVIADO', 4);
  }

  // Activacion para auditoria de consulta, descarga y codificacion de radicados y anexos en verradicado.php y descargar_archivo.php
  if (!defined('ACTIVAR_AUDITORIA'))
    define ('ACTIVAR_AUDITORIA', true);
  
  if (!defined('USUARIO_AUDITOR'))
    define ('USUARIO_AUDITOR',   'ADMON');

  // Configuracion de servicio de correo electronico para el modulo de respuesta rapida
  if (!defined('ADM_PHP_MAILER')) {
    // Administrador del correo
    define ('ADM_PHP_MAILER',   'orfeo@supersolidaria.gov.co');

    // Usuario del correo
    define ('USER_PHP_MAILER',  'orfeo@supersolidaria.gov.co');

    // Contrasena
    define ('PASS_PHP_MAILER',  'supersolidaria2014');

    // Direccion servidor smtp
    define ('HOST_PHP_MAILER',  'smtp.gmail.com');

    // Puerto de conexion del servicio de correo
    define ('PORT_PHP_MAILER',  587);
    define ('ASUNTO_PHP_MAILER', 'Respuesta de su radicado en NOMBRE_DE_LA_ENTIDAD');
    define ('ASUNTO_ENTIDAD',   ' NOMBRE_DE_LA_ENTIDAD');
    define ('ATL_BODY',         'Para ver el mensaje, por favor use un visor de E-mail compatible!');
    define ('DATOS_SISTEMA',    'Sistema de gestion Orfeo. ' . URL_ENTIDAD);
  }

  // Longitud dependencia
  if (!defined('LONGITUD_DEPENDENCIA'))
    define ('LONGITUD_DEPENDENCIA', 3);
 
  //Usuario de conexion con permisos de modificacion y creacion de objetos en la Base de datos.
  $usuario    = 'postgres';
  $contrasena = 'contrasena';
  $servicio   = 'orfeo';    //Nombre de la base de datos de ORFEO
  
  // Servidor base de datos
  $servidor   = 'localhost:5432';
  
  // Tipo de Base de datos. Los valores validos son: postgres, oci8, mssql.
  $driver     = 'postgres';
  // Variable que indica el ambiente de trabajo, sus valores pueden ser  desarrollo,prueba,orfeo
  $ambiente   = 'orfeoc';
  
  //Servidor que procesa los documentos
  $servProcDocs   = "192.127.28.45:8080";
  
  $entidad        = 'SES';

  //Variable usada generalmente para los titulos en informes.
  $entidad_largo  = 'NOMBRE DE LA ENTIDAD';
  
  // Telefono o PBX de la empresa.
  $entidad_tel    = 'NUMERO(S) TELEFONICOS';  // Telefono o PBX de la empresa.
  $entidad_dir    = 'DIRECCION DE LA ENTIDAD';   // Direccion de la Empresa.
  $entidad_depsal = 999;
  
  //Guarda el codigo de la dependencia de salida por defecto al radicar dcto de salida
  // 0 = Carpeta salida del radicador >0 = Redirecciona a la dependencia especificada
  /**
   * Se crea la variable $ADODB_PATH.
   * El Objetivo es que al independizar ADODB de ORFEO, este (ADODB) se pueda actualizar sin causar
   * traumatismos en el resto del codigo de ORFEO. En adelante se utilizara esta variable para hacer
   * referencia donde se encuentre ADODB
   */
  
  $MODULO_RADICACION_DOCS_ANEXOS = 1;

  // Configuracion plantilla de respuesta rapida
  if(!defined('LOGO_ENTIDAD')) {
    // Banner para generar los PDF's
    define ('LOGO_ENTIDAD', '../img/banerPDF.jpg');
    define ('DIRECCION',    'DIRECCION COMPLETA DE LA ENTIDAD');
    define ('PBX',          'TELEFONOS');
    define ('LINEA_GRATIS', 'LINEA GRATIS');
    define ('DATOS_ENTIDAD',  DIRECCION .
                              ' PBX: ' . PBX .
                              ' Linea Gratis: ' . LINEA_GRATIS .
                              ' Pagina: ' . URL_ENTIDAD);
  }
  
  // Enlace comisiones
  if (!defined('URL_COMISIONES'))
    define('URL_COMISIONES', 'comisiones');
  
  // Configuracion LDAP
  // Nombre o IP del servidor de autenticacion LDAP
  $ldapServer = '';

  // Cadena de busqueda en el servidor.
  $cadenaBusqLDAP = '';
  
  // Campo seleccionado (de las variables LDAP) para realizar la autenticacion.
  $campoBusqLDAP = 'mail';
  
  // Si esta variable va en 1 mostrara en informacion geneal el menu de Rel.
  // Procedimental, resolucion, sector, causal y detalle. en cero Omite este menu
  $menuAdicional = 0;

  // Variables que se usan para la radicacion del correo electronio 
  // Sitio en el que encontramos la libreria pear instalada
  $PEAR_PATH     = ORFEO_PATH . 'pear/';

  // Servidor de Acceso al correo Electronico
  $servidor_mail= '';

  // Tipo de servidor de correo Usado
  $protocolo_mail= 'imap'; // imap  | pop3
  
  // Puerto del servidor de Mail.
  // Segun servidor defecto 143 | 110
  $puerto_mail = 143;

  /* Directorio de estilos a Usar...
   * Si no se establece una Ruta el sistema usara el que posee por
   * Defecto en el directorio estilos.
   * Orfeo.css para usarlo cree una carpeta con su personalizacion y
   * luego copie el archivo orfeo.css y cambie sus colores.
  */ 
  
  // hay que borrar esta variable para reemplazarla como constante
  $ESTILOS_PATH = '/estilos/';
  if (!defined('ORFEO_ESTILOS'))
    define('ORFEO_ESTILOS', '/estilos/orfeo.css');
  
  /** $vbAllDependencias Si esta configurada la variable reasignar a Visto Bueno
    * en 1 visto Bueno a Todas las Dependencias
    */
  $vbAllDependencias = 1;
  
  // Configuracion del servidor de fax
  if (!defined('SERVIDOR_FAX')) {
    // Nombre del servidor de Fax
    define('SERVIDOR_FAX',      'NOMBRE DEL SERVIDOR DE FAX');
    
    // Usuario de conexion de FAX
    define('USUARIO_ADMIN_FAX', 'usuario_servidor_fax');
    
    // Password usuario de fax
    define('PASSWORD_FAX',      'contrasena');
    
    // Imagen para el modulo de fax
    define('IMAGEN_FAX',        BODEGA_TMP . 'fax.jpg');
  }

  // Ni idea para que funciona esta variable
  $n_dias_pass = 800;

  // Variable para realizar un seguimiento de auditoria
  $enlaces = array('consulta'       =>'Modulo Consultas',
                    'bandeja'       =>'Desde Bandeja de usuario',
                    'estadisticas'  =>'Modulo de Estadisticas',
                    'anexos'        =>'Anexo un Archivo',
                    'descarga'      =>'Descarga imagen',
                    'expediente'    =>'Consulta desde expediente',
                    0               =>'Enlace no especifico/Acceso sin loguearse al sistema');
  
  // Variable que se usa para enviar correos al radicar o reasignar
  // Para configurar el correo electronico enviado se usa phpmailer que esta en include/ y se deben configurar
  // Los archivos en /conf/ El servidor 
  // /conf/configPHPMailer.php Archivo con la configuracion de servidor y cuenta de correo.
  // MailInformado.html, MailRadicado.hrml y MailReasignado.html (Archivos con el cuerpo de los correos)
  $enviarMailMovimientos = 1;
  
  // Configuracion Smarty
  $smarty_dir = './include/Smarty/libs/';   // Carga el Motor para manipular plantillas HTML
  $smarty_lib = 'Smarty.class.php';
  $smarty_eng = $smarty_dir . $smarty_lib;
  
  if (!defined('SMARTY_TEMPLATE')) {
    define('SMARTY_TEMPLATE', ORFEO_PATH . 'include/Smarty/libs/Smarty.class.php');
    define('TEMPLATE_DIR', ORFEO_PATH . 'templates');
    define('COMPILE_DIR', ORFEO_PATH . 'templates_c');
    define('CACHE_DIR', ORFEO_PATH . 'cache');
  }
  
  // Activar para que Adodb no haga el render afecta queryCuerpo.php
  if (!defined('ACTIVAR_RENDER'))
    define('ACTIVAR_RENDER', true);

  // Constante que para verificar si el usuario es nuevo
  if (!defined('ES_NUEVO'))
    define('ES_NUEVO', 0);

  // Idioma
  if (!defined('LENGUAJE'))
    define('LENGUAJE', ORFEO_PATH . 'include/espanol_colombia.php');
  
  include_once(LENGUAJE);
  
  // Es necesario determinar la zona hora en PHP5
  date_default_timezone_set('America/Bogota');
  
  // Permiso para descargar archivo
  if (!defined('PERM_DESCARGAR_ARCHIVO'))
    define('PERM_DESCARGAR_ARCHIVO', true);

  // Configuracion para viewerjs
  if (!defined('VIEWERJS'))
    define('VIEWERJS', 'ViewerJS/');

  // Apagar asignacion
  if (!defined('APAGAR_ASIGNACION'))
    define('APAGAR_ASIGNACION', false);

  // Constantes para que jquery y PHP puedan detectar el tipo de dispositivo y navegador
  // Tipos de sistemas operativo
  if (!defined('WIN7')) {
    define('WIN7', 'Win7');
    define('MACOSX', 'MacOSX');
    define('IOS', 'iOS');
  }
  
  // Navegadores
  if (!defined('FIREFOX')) {
    define('FIREFOX', 'Firefox');
    define('FIREFOX_VER', '33');
    define('CHROME',  'Chrome');
    define('CHROME_VER', '38');
  }
?>
