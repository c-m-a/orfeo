<?php
// Modificado Septiembre-2009
/**
  * Pagina que trae los datos para una respuesta Rapida
  * Creado en la DNP en el año 2008
  * 
  * @autor Jairo Losada 2009-05
  * @licencia GNU/GPL V 3
  */
//include "../js/funtionImage.php";
// load Smarty library
$ruta_raiz = "../";
$ruta_libs = $ruta_raiz . "pqr/";
define('SMARTY_DIR', $ruta_libs . 'libs/');
require (SMARTY_DIR . 'Smarty.class.php');


$smarty = new Smarty;
$smarty->template_dir = './templates';
$smarty->compile_dir = './templates_c';
$smarty->config_dir = './configs/';
$smarty->cache_dir = './cache/';

$smarty->left_delimiter = '<!--{';
$smarty->right_delimiter = '}-->';

include_once ("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$Radi = $_POST['tpradi'];

/*
 *Se agrupan las funciones en la carpeta libs
 * */

require (SMARTY_DIR . 'funciones.php');

/*
*Se reciben las variables del  archivo Newpqr.php
**/

//enlace para ver el pdf de entrada
$primerno = substr($Radi, 0, 4);
$segundono = substr($Radi, 4, 3);
$ruta = "/" . $primerno . "/" . $segundono . "/" . $Radi;
$enlace = "../bodega" . $ruta . '.pdf';

if (ereg("([0-9]{14})", $Radi)) {
	$res_usua = validar($db, $Radi);
	$radicado = $res_usua->fields["RADICADO"];
	if ($radicado == "")
		header("Location: ./consulta.php?noexiste=1");
} else
	header("Location: ./consulta.php?noexiste=1");
$radi = $res_usua->fields["RADICADO"];

$res_usua = usua_Radi_fec($db, $Radi);
$TDOC_CODI = $res_usua->fields["TDOC_CODI"];
$RADI_FECH_RADI = $res_usua->fields["RADI_FECH_RADI"];
$RA_ASUN = $res_usua->fields["RA_ASUN"];

$res_usua = tipodocumental($db, $TDOC_CODI);
$TDOC_CODI = $res_usua->fields["SGD_TPR_DESCRIP"];

$smarty->assign("TDOC_CODI", $TDOC_CODI);
$smarty->assign("RA_ASUN", StrValido($RA_ASUN));
$smarty->assign("RADI_FECH_RADI", $RADI_FECH_RADI);

$res_usua = usua_Radicado($db, $Radi);
$destina = $res_usua->fields["destinatario"];
$sgd_oem_direccion = $res_usua->fields["sgd_oem_direccion"];
$email = $res_usua->fields["email"];
$sgd_oem_telefono = $res_usua->fields["telefono"];
$smarty->assign("radi", $radi);
$smarty->assign("destina", StrValido($destina));
$smarty->assign("direccion", $sgd_oem_direccion);
$smarty->assign("email", $email);
$smarty->assign("telefono", $sgd_oem_telefono);

$res_usua = radi_contes($db, $Radi);
$contestado = $res_usua->fields["RADI_PATH"];
$fechacontestado = $res_usua->fields["ANEX_FECH_ENVIO"];
$radicadopadre = $res_usua->fields["RADI_NUME_SALIDA"];
$enlace2 = "../bodega/" . $contestado;
if ($contestado){
	$respuesta = "Contestado";
	if ($regresado)
	 $respuesta .= "<br> => Devuelto en correspondencia en la fecha" . $regresado;
} else $respuesta = "En tramite";

$res_usua = depen_actual($db, $Radi);
$depe_actu = $res_usua->fields["dependencia"];
$usua_actu = $res_usua->fields["usua_nomb"];
$smarty->assign("usua_actu", ucwords(StrValido($usua_actu)));
$smarty->assign("depe_actu", ucwords(StrValido($depe_actu)));

$res_usua = usua_lugar($db, $Radi);
$DPTO_CODI = $res_usua->fields["DPTO_CODI"];
$MUNI_CODI = $res_usua->fields["MUNI_CODI"];
$res_usua = usua_lugarDept($db, $DPTO_CODI);
$DEPARTAMENTO = $res_usua->fields["DPTO_NOMB"];
$res_usua = usua_lugarMun($db, $DPTO_CODI, $MUNI_CODI);
$MUNICIPIO = $res_usua->fields["MUNI_NOMB"];
$isql = "select
	   a.ANEX_CODIGO,
	   a.RADI_NUME_SALIDA,
	   a.ANEX_NOMB_ARCHIVO,
	   a.ANEX_FECH_ANEX,
           a.ANEX_DESC,
           at.ANEX_TIPO_EXT,
           a.RADI_NUME_SALIDA
	from anexos a,
        anexos_tipo at
	where
        a.anex_tipo=at.anex_tipo_codi and
	a.anex_radi_nume=$Radi
        order by
           a.anex_codigo
          ,a.anex_fech_anex desc";
$rsAnexos = $db->conn->Execute($isql);
$i=0;
while(!$rsAnexos->EOF)
{
  /** Condicion que evalua si el radicado de salida ya Se encuentra Digitalizado o en PDF
   * Se realiza esta opcion para evitar que docuemntos en proyecto sean publicos.
   *@autor  JAIRO LOSADA - DNP 10/2009
   *@licencia GNU/GPL
   *
   **/
  $radiNumeSalida = $rsAnexos->fields['RADI_NUME_SALIDA'];
  $extension =$rsAnexos->fields["ANEX_TIPO_EXT"];
  $anexCodigoRad = substr($rsAnexos->fields["ANEX_CODIGO"],14);
  if( ($extension=="pdf" || $extension=="tif"))
  {
        $verDocumentosAnexos = "Si";
        $radiNumeSalidaPadre = $radiNumeSalida;
  }elseif($radiNumeSalida){
        $verDocumentosAnexos = "No";
        $radiNumeSalidaPadre = $radiNumeSalida;
  }elseif(substr($rsAnexos->fields["ANEX_DESC"],0,3)=="Adj")
  {
        $verDocumentosAnexos = "Si";
  }else{
        $verDocumentosAnexos = "No";
  }
  if($verDocumentosAnexos=="Si")
  {
    if($radiNumeSalida)
    {
     $numeroId = $rsAnexos->fields["RADI_NUME_SALIDA"];
    }else{
     $numeroId = $rsAnexos->fields["ANEX_CODIGO"];
    }
    $ruta = $ruta_raiz."bodega/".substr(trim($Radi),0,4)."/".substr(trim($Radi),4,3)."/docs/".$documento;
    $elementos[$i][2]= $numeroId;
    $elementos[$i][3]= $radiNumeSalida;
    $elementos[$i][4]=$rsAnexos->fields["ANEX_FECH_ANEX"];
    $elementos[$i][5]=$rsAnexos->fields["ANEX_DESC"];
    $elementos[$i][7]=$rsAnexos->fields["RADI_NUME_SALIDA"];
  
    switch ($extension) {
      case 'doc':
      case 'docx':        
        $elementos[$i][6] = "../iconos/imgDOC.jpg";      
        break;
      case 'xls':
      case 'xlsx':        
         $elementos[$i][6] = "../iconos/imgXLS.jpg";
         break;
      case 'ods':
        $elementos[$i][6] = "../iconos/imgODS.jpg";      
        break;
      case 'odt':
        $elementos[$i][6] = "../iconos/imgODT.jpg";      
        break;
      case 'pdf':
        $elementos[$i][6] = "../iconos/imgPDF.jpg";      
        break;
      default:
        $elementos[$i][6] = "../iconos/comentarios.gif";      
        break;
    }
  $elementos[$i][1]=$ruta;
  $ruta = "";
  $i++;
  }
  $rsAnexos->MoveNext();
}

$n = 10;
$cell = 3;
$smarty->assign("elementos", $elementos);
$smarty->assign("n", $n);
$smarty->assign("cell", $cell);
$smarty->assign("radicadopadre", $radicadopadre);
$smarty->assign("ENLACE2", $enlace2);
$smarty->assign("fechacontestado", $fechacontestado);
$smarty->assign("contestado", $respuesta);
$smarty->assign("ENLACE", $enlace);
$smarty->assign("DEPARTAMENTO", ucwords(StrValido($DEPARTAMENTO)));
$smarty->assign("MUNICIPIO", ucwords(StrValido($MUNICIPIO)));

$smarty->display('respuesta.tpl');

$ruta_raiz = "..";
$numrad = $Radi;
//include "../linkArchivo.php";
