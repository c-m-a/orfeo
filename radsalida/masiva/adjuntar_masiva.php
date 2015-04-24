<?php
/**
  * Pagina Menu_Masiva.php que muestra el contenido de las Carpetas
  * Creado en la SSPD en el año 2003
  * 
  * Se anadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @licencia GNU/GPL V 3
  */

session_start();
define ( 'WORKDIR', '../../bodega/tmp/workDir/' );
define ( 'CACHE', WORKDIR . 'cacheODT/' );

foreach ($_GET as $key => $valor) ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

$krd        = $_SESSION["krd"];
$dependencia= $_SESSION["dependencia"];
$usua_doc   = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tip3desc   = $_SESSION["tip3desc"];
$tip3img    = $_SESSION["tip3img"];

$archivoPlantilla = $_POST["archivoPlantilla"];
$ruta_raiz = '../..';

include_once "$ruta_raiz/include/db/ConnectionHandler.php";
require_once("$ruta_raiz/class_control/CombinaError.php");

if(!isset($_SESSION['dependencia']))
	include "$ruta_raiz/rec_session.php";

$conexion = (!$db)? new ConnectionHandler($ruta_raiz) : $db;

$conexion->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$hora  = date("H")."_".date("i")."_".date("s");
$ddate = date('d');   // var que almacena el dia de la fecha
$mdate = date('m');   // var que almacena el mes de la fecha
$adate = date('Y');   // var que almacena el año de la fecha
$fecha = $adate."_".$mdate."_".$ddate;    // var que almacena  la fecha formateada

$archivoPlantilla_name = $_FILES['archivoPlantilla']['name'];
//Almacena la extesion del archivo entrante
$extension = trim(substr($archivoPlantilla_name,
                          strpos($archivoPlantilla_name,".") + 1,
                          strlen($archivoPlantilla_name)-strpos($archivoPlantilla_name,".")));

//var que almacena el nombre que tendra la pantilla
$arcPlantilla = $usua_doc . "_" . $fecha . "_" . $hora . ".$extension";

//var que almacena el nombre que tendra el CSV
$arcCsv=$usua_doc."_".$fecha."_".$hora.".csv";

//var que almacena el path hacia el PDF final
$arcPDF="$ruta_raiz/bodega/masiva/"."tmp_".$usua_doc."_".$fecha."_".$hora.".pdf";
$listado_pdf = "/bodega/masiva/"."tmp_".$usua_doc."_".$fecha."_".$hora.".pdf";
$phpsession = session_name()."=".session_id();

//var que almacena los parametros de sesion
$params = $phpsession."&krd=$krd&dependencia=$dependencia&codiTRD=$codiTRD&depe_codi_territorial=$depe_codi_territorial&usua_nomb=$usua_nomb&tipo=$tipo&"
				."depe_nomb=$depe_nomb&usua_doc=$usua_doc&codusuario=$codusuario";

//Función que calcula el tiempo transcurrido
function microtime_float() {
  list($usec, $sec) = explode(" ", microtime());
  return ((float)$usec + (float)$sec);
}
?>
<html>
<head>
  <link rel="stylesheet" href="../../estilos/orfeo.css">
  <script>
    // Confirma la generacion definitiva
    function enviar() {
      if ( confirm ('Confirma la generacion de un radicado por cada registro del archivo CSV?'))
        document.formDefinitivo.submit();
    }

    function regresar() {
      document.formDefinitivo.action="menu_masiva.php?"+'<?=$params?>';
      document.formDefinitivo.submit();
    }

    // Envia el formulario, a consultar divipola
    function divipola() {
      document.formDefinitivo.action="consulta_depmuni.php?"+ document.formDefinitivo.params.value;
      document.formDefinitivo.submit();
    }

    // Cancela el proceso y devuelve el control a menu masiva
    function cancelar(){
      document.formDefinitivo.action='menu_masiva.php?'+ document.formDefinitivo.params.value;
      document.formDefinitivo.submit();
    }

    function abrirArchivoaux(url) {
      nombreventana='Documento';
      window.open(url, nombreventana,  'status, width=900,height=500,screenX=100,screenY=75,left=50,top=75');
      return;
    }
  </script>
</head>
<body>
<form action="adjuntar_defint.php?<?=$params?>" method="post" enctype="multipart/form-data" name="formDefinitivo">
<input type="hidden" name="pNodo" value='<?=$pNodo?>'>
<input type="hidden" name="codProceso" value='<?=$codProceso?>'>
<input type="hidden" name="tipoRad" value='<?=$tipoRad?>'>
<?php
  $time_start = microtime_float();
  $archivoPlantilla = $_FILES['archivoPlantilla']['name'];

  if ($_FILES['archivoPlantilla']['size'] >= 10000000 || $_FILES['archivoCsv']['size'] >= 10000000 ) {
    echo "el tama&nacute;o de los archivos no es correcto. <br><br><table><tr><td><li>se permiten archivos de 100 Kb m&aacute;ximo.</td></tr></table>";
  } else {
    $dirActual = getcwd();
    if(!move_uploaded_file($_FILES['archivoPlantilla']['tmp_name'], "../../bodega/masiva/".$arcPlantilla)) {
      echo "error al copiar Plantilla: $archivoPlantilla en ../../bodega/masiva/".$arcPlantilla;
    } elseif (!copy($_FILES['archivoCsv']['tmp_name'], "../../bodega/masiva/".$arcCsv)) {
      echo "error al copiar CSV: $archivoCsv en ../../bodega/masiva/" .$arcCsv;
    } else {
      echo "<center><span class=etextomenu align=left>";
      echo "<table border=0 width 60% cellpadding='0' cellspacing='5' class='borde_tab'>
      <TR ALIGN=LEFT><TD width=20% class='titulos2' >DEPENDENCIA :</td><td class='listado2'> ".$_SESSION['depe_nomb']."</TD>	<TR ALIGN=LEFT><TD class='titulos2' >USUARIO RESPONSABLE :</td><td class='listado2'>".$_SESSION['usua_nomb']."</TD>
      <TR ALIGN=LEFT><TD class='titulos2' >FECHA :</td><td class='listado2'>" . date("d-m-Y - h:mi:s") ."</TD></TR></TABLE>";
      require "$ruta_raiz/jhrtf/jhrtf.php";
      $ano = date("Y") ;
      //var que almacena nombre del archivo combinado
      //pone el nombre de los archivos de salida con la extensión adecuada (odt o .doc)
      if ($extension == 'doc') {
        $archivoFinal = "./bodega/$ano/$dependencia/docs/$usua_doc"."_$fecha"."_$hora.doc";
        $archivoTmp = "./bodega/masiva/tmp_$usua_doc"."_$fecha"."_$hora.doc";
      }else {
        $archivoFinal = "./bodega/$ano/$dependencia/docs/$usua_doc"."_$fecha"."_$hora.odt";
        $archivoTmp = "./bodega/masiva/tmp_$usua_doc"."_$fecha"."_$hora.odt";
      }
      
      $ruta_raiz = '../..';
      $definitivo= 'no';
      $archInsumo= 'tmp_' . $usua_doc . '_' . $fecha . '_' . $hora;
      $fp = fopen("$ruta_raiz/bodega/masiva/$archInsumo",'w');
      
      if ($fp) {
        fputs ($fp,"plantilla=$arcPlantilla"."\n");
        fputs ($fp,"csv=$arcCsv"."\n");
        fputs ($fp,"archFinal=$archivoFinal"."\n");
        fputs ($fp,"archTmp=$archivoTmp"."\n");
        fclose($fp);
      } else {
        exit("No hay acceso para crear el archivo $archInsumo");
      }
      
      // Se crea el objeto de masiva
      $masiva = new jhrtf($archInsumo,$ruta_raiz,$arcPDF,$conexion);
      $masiva->cargar_csv();
      $masiva->validarArchs();
      
      if ($masiva->hayError()) {
        $masiva->mostrarError();
      }	else {
        $masiva->setTipoDocto($tipo);
        $_SESSION["masiva"]=$masiva;
        echo  "<center><span class=info><br>Se ha realizado la combinaci&oacute;n de correspondencia como una prueba.<br> ";
        
        $masiva->combinar_csv($dependencia,
                              $codusuario,
                              $usua_doc,
                              $usua_nomb,
                              $depe_codi_territorial,
                              $codiTRD,
                              $tipoRad);
        
        include("$ruta_raiz/config.php");
        //El include del servlet hace que se altere el valor de la variable  $estadoTransaccion como 0 si se pudo procesar el documento, -1 de lo
        // contrario
        $estadoTransaccion = -1;

        //El archivo que ingreso es odt, luego se utiliza el nuevo combinador
        if($extension == 'odt') {
          include './combinacion_opendocument.php';
        } else {
          include 'combinacion_office_doc.php';
        }
      }
    }
    //Contabilizamos tiempo final
    $time_end = microtime_float();
    $time = $time_end - $time_start;
    echo "<br><b>Se demor&oacute;: $time segundos la Operaci&oacute;n total.</b>";
  }
?>
<input name='archivo' type='hidden' value='<?=$archivoFinal?>'>
<input name='arcPDF' type='hidden'  value='<?=$arcPDF ?>'>
<input name='tipoRad' type='hidden' value='<?=$tipoRad?>'>
<input name='pNodo' type='hidden' value='<?=$pNodo?>'>
<input name='params' type='hidden'  value="<?=$params?>">
<input name='archInsumo' type='hidden'  value="<?=$archInsumo?>">
<input name='extension' type='hidden'  value="<?=$extension?>">
<input name='arcPlantilla' type='hidden' value='<?=$arcPlantilla?>'>

</form>
</body>
</html>
