<?php 
  session_start();

  $ruta_raiz = "../";
  $ruta_libs = "../respuesta_rapida/";

  define('SMARTY_DIR', $ruta_libs.'libs/');
  require (SMARTY_DIR . 'Smarty.class.php');
  require_once 'libs/htmlpurifier/HTMLPurifier.auto.php';

  //formato para fecha en documentos
  function fechaFormateada($FechaStamp){
    $ano = date('Y', $FechaStamp); //<-- Ano
    $mes = date('m', $FechaStamp); //<-- número de mes (01-31)
    $dia = date('d', $FechaStamp); //<-- Día del mes (1-31)
    $dialetra = date('w', $FechaStamp); //Día de la semana(0-7)

    switch ($dialetra) {
      case 0 :
          $dialetra = "domingo";
          break;
      case 1 :
          $dialetra = "lunes";
          break;
      case 2 :
          $dialetra = "martes";
          break;
      case 3 :
          $dialetra = "miércoles";
          break;
      case 4 :
          $dialetra = "jueves";
          break;
      case 5 :
          $dialetra = "viernes";
          break;
      case 6 :
          $dialetra = "Sábado";
          break;
      }

        switch ($mes) {
            case '01' :
                $mesletra = "enero";
                break;
            case '02' :
                $mesletra = "febrero";
                break;
            case '03' :
                $mesletra = "marzo";
                break;
            case '04' :
                $mesletra = "abril";
                break;
            case '05' :
                $mesletra = "mayo";
                break;
            case '06' :
                $mesletra = "junio";
                break;
            case '07' :
                $mesletra = "julio";
                break;
            case '08' :
                $mesletra = "agosto";
                break;
            case '09' :
                $mesletra = "septiembre";
                break;
           case '10' :
                $mesletra = "octubre";
                break;
            case '11' :
                $mesletra = "noviembre";
                break;
            case '12' :
                $mesletra = "diciembre";
                break;
        }

        return htmlentities("$dialetra, $dia de $mesletra de $ano");
    }

    // Include the CKEditor class
    include_once "$ruta_raiz/ckeditor/ckeditor_php5.php";

    // Create a class instance.
    $CKEditor = new CKEditor();

    // Path to the CKEditor directory.
    $CKEditor->basePath = $ruta_raiz."ckeditor/";
	
	$smarty = new Smarty;
	$smarty->template_dir = './templates';
	$smarty->compile_dir = './templates_c';
	$smarty->config_dir = './configs/';
	$smarty->cache_dir = './cache/';
	
	$smarty->left_delimiter = '<!--{';
	$smarty->right_delimiter = '}-->';


    function byteSize($bytes) {
        $size = $bytes / 1024;
        if($size < 1024){
            $size = number_format($size, 2);
            $size .= ' KB';
            }
        else
            {
            if($size / 1024 < 1024)
                {
                $size = number_format($size / 1024, 2);
                $size .= ' MB';
                }
            else if ($size / 1024 / 1024 < 1024)
                {
                $size = number_format($size / 1024 / 1024, 2);
                $size .= ' GB';
                }
            }
        return $size;
    }

  $krd = ($_SESSION["krd"])? $_SESSION["krd"] : null;
	$radicado = ($_GET["radicado"])? $_GET["radicado"] : null;
	    
	include_once ($ruta_raiz."include/db/ConnectionHandler.php");

	$db = new ConnectionHandler("$ruta_raiz");
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	
	$usuario      = $_SESSION["usua_nomb"];
	$dependencia  = $_SESSION["depe_nomb"];
	$dep_code     = $_SESSION["dependencia"];
	$encabezado   = session_name()."=".session_id();
	$encabezado .= "&krd= $krd";
	
	$isql 	= "
				SELECT 
					USUA_EMAIL, 
					DEPE_CODI, 
					USUA_CODI, 
					USUA_NOMB, 
					USUA_LOGIN, 
					USUA_DOC 
				FROM 
					USUARIO 
				WHERE 
					USUA_LOGIN ='$krd' ";
					
	$rs 	= $db->conn->Execute($isql);	
	
	while (!$rs->EOF) {
		
	    $emails[] = trim(strtolower($rs->fields["USUA_EMAIL"]));		
		$usuacodi  = $rs->fields["USUA_CODI"];
		$depecodi  = $rs->fields["DEPE_CODI"];
		$usuanomb  = $rs->fields["USUA_NOMB"];
		$usualog   = $rs->fields["USUA_LOGIN"];
		$codigoCiu = $rs->fields["USUA_DOC"];
	    $rs->MoveNext();
	}
	//Eliminamos los campos vacios en el array	
	$emails 	=  array_filter($emails);
	
	// informacion remitente
	$name  = "";
	$email = "";

	$isql  = "SELECT D.* FROM SGD_DIR_DRECCIONES D
	             WHERE D.RADI_NUME_RADI =". $_GET['radicado'];
	$rs = $db->conn->Execute($isql);

    $name       = $rs->fields["SGD_DIR_NOMREMDES"];
    $email      = $rs->fields["SGD_DIR_MAIL"];
    $municicodi = $rs->fields["MUNI_CODI"];
    $depecodi2  = $rs->fields["DPTO_CODI"];
    
    $name     = strtoupper($name);
    $depcNomb = strtoupper($depcNomb);
    $fecha1   = time();
    $fecha    = ucfirst(fechaFormateada($fecha1));
    
    $asunto = "<br><br><br> <strong>Bogota, $fecha</strong>
		<br /><br /><br />
		Se&ntilde;or(a)<br />
                <strong>
                $name</strong><br>"
                .$email."<br><br><br>";
	
	$sqlD = " SELECT
		           a.MUNI_NOMB,
		           b.DPTO_NOMB
              FROM 
                   MUNICIPIO a, DEPARTAMENTO b
			  WHERE (a.ID_PAIS = 170)
					AND	(a.ID_CONT = 1)
					AND (a.DPTO_CODI = $depecodi2)
					AND (a.MUNI_CODI = $municicodi)
					AND (a.DPTO_CODI=b.DPTO_CODI)
					AND (a.ID_PAIS=b.ID_PAIS)
					AND (a.ID_CONT=b.ID_CONT)";

	$descripMuniDep = $db->conn->Execute($sqlD);
	$depcNomb       = $descripMuniDep->fields["MUNI_NOMB"];
	$muniNomb       = $descripMuniDep->fields["DPTO_NOMB"];
	
	$destinatario   = trim($email);

    $sql1 		= "	select
                        anex_tipo_ext as ext
                    from
                        anexos_tipo";

    $exte = $db->conn->Execute($sql1);

    while(!$exte->EOF) {
        $val  = $exte->fields["EXT"];
        $extn .= empty($extn)? $val : "|".$val;
        //arreglo para validar la extension
        $exte->MoveNext();
    };
	
    $sqlSubstDesc =  $db->conn->substr."(anex_desc, 0, 50)";
    //adjutar los anexos del radicado
    $sql2 = "   SELECT 
                    ANEX_NOMB_ARCHIVO AS NOMB,
                    ANEX_TAMANO AS TAMA,
			        $sqlSubstDesc AS DESCR
                FROM 
                    ANEXOS
                WHERE ANEX_RADI_NUME =". $_GET['radicado'];

    $proce = $db->conn->Execute($sql2);


    while(!$proce->EOF){

        $nomb = $proce->fields["NOMB"];
        $desc = $proce->fields["DESCR"];
        $tama = byteSize($proce->fields["TAMA"]);
        $desc = empty($desc)? $nomb : $desc;
        
        $aneNombDoc[] = array("nomb" => $nomb,
                              "desc" => $desc,
                              "tama" => $tama);
        $proce->MoveNext();
    };

    //adjuntar  la imagen html al radicado
    $desti = "SELECT RADI_PATH
                FROM RADICADO 
                WHERE RADI_NUME_RADI =". $_GET['radicado'];

    $rssPatth       = $db->conn->Execute($desti);
    $pathPadre      = $rssPatth->fields["RADI_PATH"];

    $post  = strpos(strtolower($pathPadre),'bodega');

   // if($post !== false){
        $pathPadre = substr($pathPadre,$post + 5);  
   // }

    $rutaPadre      = trim($ruta_raiz.'bodega/'.$pathPadre);
    $rutaPadre . "<hr>";

    if(is_file($rutaPadre) 
        and substr($rutaPadre, -4) == "html" )
    {
        $gestor  = fopen($rutaPadre, "r");
        $archtml = fread($gestor, filesize($rutaPadre));

        $archtml    = preg_replace('/<img (.+?)>/', ' ',$archtml);
        $archtml    = preg_replace('COLOR: red;', ' ',$archtml);
        $config     = HTMLPurifier_Config::createDefault();
        $purifier   = new HTMLPurifier();
        $clean_html = $purifier->purify($archtml);

        $asunto .= "<br><br><hr><br>
                    $clean_html" ;
    }

	$smarty->assign("sid"			, SID); //Envio de session por get
	$smarty->assign("usuacodi" 		, $usuacodi);
	$smarty->assign("extn" 		        , $extn);
	$smarty->assign("depecodi"		, $depecodi);
	$smarty->assign("codigoCiu"		, $codigoCiu);
	$smarty->assign("radPadre"		, $radicado);
	$smarty->assign("rutaPadre"   , $rutaPadre);
	$smarty->assign("usuanomb"		, $usuanomb);
	$smarty->assign("usualog"		, $usualog);
	$smarty->assign("destinatario"	        , $destinatario);
	//$smarty->assign("concopia"		, "");
	//$smarty->assign("concopiaOculta" 	, "");
	$smarty->assign("asunto"		, $asunto);
	$smarty->assign("emails"		, $emails);
	$smarty->assign("docAnex"		, $aneNombDoc);
	$smarty->display('index.tpl');

    // Replace a textarea element with an id (or name) of "textarea_id".
    $CKEditor->config['height'] = 575;
    $CKEditor->replace("texrich");
?>
