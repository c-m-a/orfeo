<?php
  session_start();
  set_time_limit(0);
 
 if($_SESSION["krd"])
      $krd = $_SESSION["krd"];

  if (!isset($_SESSION['dependencia']))
      include "../rec_session.php";
  
  $dependencia = $_SESSION["dependencia"] * 1 ;
  $ruta_raiz = "../";
  require_once($ruta_raiz."include/db/ConnectionHandler.php");

  $db      = new ConnectionHandler("$ruta_raiz");
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);                 
  
  define('SMARTY_DIR', $ruta_libs.'libs/');
	require (SMARTY_DIR.'Smarty.class.php');

	$smarty = new Smarty;
	$smarty->template_dir = './templates';
	$smarty->compile_dir = './templates_c';
	$smarty->config_dir = './configs/';
	$smarty->cache_dir = './cache/';
	
	$smarty->left_delimiter = '<!--{';
	$smarty->right_delimiter = '}-->';

    $errores  = $_GET['error'];
    $nurad    = $_GET['nurad'];
    $sali     = array();

    function errores($errores){
        switch ($errores){
            case 1:
                $error= " No se genero el radicado.";
                break;
            case 2:
                $error= " Error no se creo la carpeta para los adjuntos /bodega/adjuntos/.";
                break;
            case 3:
                $error= " Un archivo no se envio (Extension invalida)";
                break;
            case 4:
                $error= " El formato mime del documento no existe";
                break;
            case 5:
                $error= " El tamano del archivo adjunto supero el limite permitido";
                break;
            case 6:
                $error= " No se pudo registrar uno de los adjuntos";
                break;
            case 7:
                $error= " No se pudo grabar uno de los anexos";
                break;
            case 8:
                $error= " Error enviando correo electronico. <br />
                          Realize el envio del correo de manera manual.";
                break;
            case 9:
                $error= " Error adjuntando el archivo de la respuesta. <br />
                          Realize el envio de manera manual.";
                break;
            case 10:
                $error= " Error adjuntado el archivo del radicado padre. <br />
                          Realize el envio del correo de manera manual.";
                break;
        }
        return $error;
    }

    if(!empty($nurad)){
        $isqlDepR = "SELECT 
                        ANEX_NOMB_ARCHIVO AS NOMBRE
                        ,ANEX_DESC
                    FROM 
                        ANEXOS
                    WHERE 
                        ANEX_RADI_NUME='$nurad' 
                        AND  ANEX_BORRADO='N'";

        $rsDepR = $db->conn->Execute($isqlDepR);
        $file   = $rsDepR->fields['NOMBRE'];

        while (!$rsDepR->EOF){
            $sali[] = array('path'  => $ruta_raiz."bodega/".substr($file,0,4)."/".$dependencia."/docs/".$file,
                            'desc'  => $rsDepR->fields['ANEX_DESC']);

            $rsDepR->MoveNext();
        }
    }

    $datoserror = explode('-', $errores);

    sort($datoserror);
    $noerrores = $datoserror[0];
    for($i=0;$i<count($datoserror);$i++)
       $error1 .= errores($datoserror[$i]).'<br/>'; 

    if(empty($errores)){
        $salida = 'ok'; 
    }

	$smarty->assign("krd"	    , $krd);
	$smarty->assign("noerror"   , $noerrores);
	$smarty->assign("error"	    , $error1);
	$smarty->assign("nurad"	    , $nurad);
	$smarty->assign("sali"      , $sali);
	$smarty->assign("salida"    , $salida);
	$smarty->assign("sid"	    , SID); //Envio de session por get
	$smarty->assign("dependencia"	, $dependencia); //Envio de session por get

	$smarty->display('salidaRespuesta.tpl');
?>
