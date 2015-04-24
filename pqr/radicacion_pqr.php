<?php 
	//borrar cache del navegador
	Header('Cache-Control: no-cache');
	Header('Pragma: no-cache');
	
	$ruta_raiz = "../";
	$ruta_libs = $ruta_raiz."pqr/";
	define('SMARTY_DIR', $ruta_libs.'libs/');
	require (SMARTY_DIR.'Smarty.class.php');
	define('FPDF_FONTPATH', "$ruta_raiz/fpdf/font/");
	require ($ruta_raiz."/fpdf/fpdf.php");
	
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
	
	//$db->conn->debug = true;
	
	require (SMARTY_DIR.'funciones.php');
	
	//strtoupper ( string cadena)Devuelve la cadena con todas sus letras en may�sculas.
	//ucwords ( string cad)Pasa a may�sculas la primera letra de cada palabra
	//ucfirst(), que convierte la primer letra de una cadena a mayuscula
	
	include ("$ruta_raiz/include/tx/Tx.php");
	include ("../include/tx/Radicacion.php");
	include ("../class_control/Municipio.php");
	$hist = new Historico($db);
	$Tx = new Tx($db);
	
	$ddate = date("d");
	$mdate = date("m");
	$adate = date("Y");
	$fechproc4 = substr($adate, 2, 4);
	$fechrd = $ddate.$mdate.$fechproc4;
	
	//Tambien se debe colocar en el archivo index.php
	//tipo documental para la nueva opcion e ingreso desde el enlace alterno
	$tipo_doc_especial = 2155;
	
	//Datos registrados por el ciudadano
	$tipoSolicitud 	= $_POST['tipoSolicitud'];
	$referencia 	= $_POST['numerox'];
	$emp 			= ucwords(StrValido($_POST['txtNomb']));
	$apell 			= ucwords(StrValido($_POST['txtApell']));
	$rad_asun		= substr(ucfirst($_POST['txInfo']), 0, 800);
	$dir 			= ucwords(StrValido($_POST['txtDir'])); //direcion usuario
	$email 			= StrValido($_POST['txtCorr']); //mail
	$tel 			= StrValido($_POST['txtTel']); //telefono
	$dep 			= $_POST['parent']; // codigo del departamento
	$muni 			= $_POST['child']; // municipio codigo
	
	//cambio para una dependecia en especial que solicito un ventana
	//similar a esta pero para un tipo documental especifico.
	$tipo2_salida 	= especial2($db, $tipo_doc_especial);	
	
	$pattern 		= '/[^\w:()����������=#�,.��]+/';
	$asu 			= preg_replace($pattern, ' ',$rad_asun);	
	
	if ($tipoSolicitud == $tipo2_salida) {
	    if ( empty($referencia) || !is_numeric($referencia)){
	        //header("Location: ../pqr/index.php?dosxfort&error=2");
		}
	}
	
	if ( empty($referencia))
	    $referencia = 'null';
	
	$validar = validar_asun($db, $asu);
		
	if (!empty($validar))
	    header("Location: ../pqr/index.php?error=1");
	    
	//Datos Necesario para generar un radicado
	$pais 	= 170; //OK, codigo pais
	$cont 	= 1; //id del continente
	$ced 	= '..'; //cedula
	$sigla 	= 'null';
	$iden 	= $db->nextId("sec_ciu_ciudadano"); // uniqe key

	//Comprobacion de variables enviadas para seguir con el proceso de radicacion.
	if ( empty($tipoSolicitud) || empty($emp) || empty($apell) || empty($email) || empty($asu))
	    header("Location: ../pqr/index.php?error=1");
	elseif ( empty($tipoSolicitud) || empty($emp) || empty($apell) || empty($email) || empty($asu) and ! empty($referencia))
	    header("Location: ../pqr/index.php?dosxfort&error=1");
	    
	if ( empty($dep) || empty($muni)) {
	    $dep = 11;
	    $muni = 1;
	}

	if ( empty($dir))
	    $dir = "No se diligencio";
	$isql 	= "select * from SGD_PQR_MASTER where ID = $tipoSolicitud";
	$rs 	= $db->conn->Execute($isql);
	if (!$rs->EOF) {
	    $tdoc = $rs->fields["SGD_PQR_TPD"];
	    $deperes = $rs->fields["SGD_PQR_DEPE"];
	    $usures = $rs->fields["SGD_PQR_USUA"];
	}
	//DATOS A VALIDAR EN RADICADO //
	
	/*dependencia de la persona que realiza la radicacion
	 Se crearon dos usuarios por que despues de implementado surgio la necesidad
	 de crear un link especial para la dependencia de contratacion con un numero
	 de consecutivo distinto. Se debe tener en cuata la creacion de los siguientes
	 usuarios para que la aplicacion funcione correctametne.*/
	
	($tipoSolicitud == $tipo2_salida) ? $usuarioqueradica = "CONTRATACIONWEB" : $usuarioqueradica = "RADICACIONWEB";
	$usuarioRadicador 	= "select depe_codi, usua_doc,usua_codi from usuario where usua_login like '$usuarioqueradica'";
	$datosRadicador 	= $db->conn->Execute($usuarioRadicador);
	//con este numero se genera el consecutivo
	$coddepe 			= $datosRadicador->fields["depe_codi"];
	//codigo de la persona que realiza la radicacion
	$radi_usua_actu 	= $datosRadicador->fields["usua_codi"];
	
	//$ent es el tipo de radicacion que se va ha hacer si es 1 es de salida y 2 de entrada
	$ent 				= '2';
	//$tpDepeRad permite buscar el consecutivo del radicado en la tabal secr_tp*****
	$tpDepeRad 			= $coddepe;
	//Documento del usuario radicador
	$radUsuaDoc 		= $datosRadicador->fields["usua_doc"];
	
	//Para crear el numero de radicado se realiza el siguiente procedimiento
	//$newRadicado = date("Y") . $this->dependencia . str_pad($secNew,$this->noDigitosRad,"0", STR_PAD_LEFT) . $tpRad;
	//este se puede ver en el archivo Radicacion.php
	
	$isql_consec 	= "select DEPE_RAD_TP$ent as secuencia from DEPENDENCIA WHERE DEPE_CODI = $tpDepeRad";
	$creaNoRad 		= $db->conn->Execute($isql_consec);
	$tpDepeRad 		= $creaNoRad->fields["secuencia"];
	
	$isql 			= "insert into SGD_CIU_CIUDADANO (TDID_CODI,
		                                       SGD_CIU_CODIGO,
		                                       SGD_CIU_NOMBRE,
		                                       SGD_CIU_APELL1,
		                                       SGD_CIU_DIRECCION,
		                                       SGD_CIU_TELEFONO,
		                                       SGD_CIU_EMAIL,
		                                       MUNI_CODI,
		                                       DPTO_CODI,
		                                       ID_PAIS,
		                                       ID_CONT,
		                                       SGD_CIU_CEDULA)
		                           values(2,
		                                  $iden,
		                                  '$emp',
		                                  '$apell',
		                                  '$dir',
		                                  '$tel',
		                                  '$email',
		                                  $muni,
		                                  $dep,
		                                  $pais,
		                                  $cont,
		                                  '$ced')";
		                                  
	$rsg = $db->conn->Execute($isql);

	if (!$rsg and empty($referencia))
	    echo "<script type='text/javascript'>document.location.href = '../pqr/index.php?error=1';</script>";
	elseif (!$rsg and ! empty($referencia))
	    header("Location: ../pqr/index.php?dosxfort&error=1");

	// RADICADO
	$rad 				= new Radicacion($db);
	$rad->radiTipoDeri 	= 1; // ok ????
	$rad->radiCuentai 	= $referencia; // ok, Cuenta Interna, Oficio, Referencia
	$rad->eespCodi 		= $iden; //codigo emepresa de servicios publicos bodega
	if(!$mrecCodi) $mrecCodi =3;
	$rad->mrecCodi 		= $mrecCodi; // medio de correspondencia, 3 internet
	$rad->radiFechOfic 	= "$ddate/$mdate/$adate"; // igual fecha radicado;
	$rad->radiNumeDeri 	= 'null'; //ok, radicado padre
	$rad->radiPais 		= $pais; //OK, codigo pais
	$rad->descAnex 		= '.'; //OK anexos
	$rad->raAsun 		= substr($asu, 0, 150); // ok asunto
	$rad->radiDepeActu 	= $deperes; // ok dependencia actual responsable
	$rad->radiUsuaActu 	= $usures; // ok usuario actual responsable
	$rad->radiDepeRadi 	= $coddepe; //ok dependencia que radica
	$rad->usuaCodi 		= $radi_usua_actu; // ok usuario actual responsable
	$rad->dependencia 	= $coddepe; //ok dependencia que radica
	$rad->trteCodi 		= 0; //ok, tipo de codigo de remitente
	$rad->tdocCodi 		= $tdoc; //ok, tipo documental
	$rad->tdidCodi 		= 0; //ok, ????
	$rad->carpCodi 		= 0; //ok, carpeta entradas
	$rad->carPer 		= 0; //ok, carpeta personal
	$rad->trteCodi 		= 0; //ok, $tip_rem;
	$rad->ra_asun 		= htmlspecialchars(stripcslashes(substr($asu, 0, 200)));
	$rad->radiPath 		= 'null';
	$rad->sgd_apli_codi = '0';
	$rad->usuaDoc 		= $radUsuaDoc;
	$codTx 				= 61;
	$noRad 				= $rad->newRadicado($ent, $tpDepeRad);
	$isqlMunDep 		= "UPDATE RADICADO SET DPTO_CODI= $dep, MUNI_CODI = $muni
		    				WHERE  (RADI_NUME_RADI = $noRad)";
	$rsgMunDep 			= $db->conn->Execute($isqlMunDep);
	
	// DIR DIRECCIONES
	$sgdTrd 			= 1; // TIPO DE USUARIO
	$grbNombresUs2 		= $emp." ".$apell; // nombre del usuario
	$cc_documento_us2 	= $ced; //cedula
	$dpto_tmp2 			= $dep; // codigo del departamento
	$muni_tmp2 			= $muni; // municipio codigo
	$idpais2 			= $pais; //id pais
	$idcont2 			= $cont; //id del continente
	$sgd_fun_codigo 	= '0'; // cedula del funcionario
	$sgd_oem_codigo 	= 'null'; // codigo empresa
	$sgd_ciu_codigo 	= $iden; // codigo ciudad
	$sgd_esp_codigo 	= 'null'; // codigo orestadora de servicios
	$nurad 				= $noRad; //nro de radicado
	$direccion_us 		= $dir; //direcion usuario
	$telefono_us 		= $tel; //telefono usuario
	$mail_us 			= $email; //mail
	$nextval 			= $db->nextId("sec_dir_direcciones");
	$isql 				= "insert into SGD_DIR_DRECCIONES(	SGD_TRD_CODIGO,
		                                                    SGD_DIR_NOMREMDES,
		                                                    SGD_DIR_DOC,
		                                                    DPTO_CODI,
		                                                    MUNI_CODI,
		                                                    id_pais,
		                                                    id_cont,
		                                                    SGD_DOC_FUN,
		                                                    SGD_OEM_CODIGO,
		                                                    SGD_CIU_CODIGO,
		                                                    SGD_ESP_CODI,
		                                                    RADI_NUME_RADI,
		                                                    SGD_SEC_CODIGO,
		                                                    SGD_DIR_DIRECCION,
		                                                    SGD_DIR_TELEFONO,
		                                                    SGD_DIR_MAIL,
		                                                    SGD_DIR_TIPO,
		                                                    SGD_DIR_CODIGO,
		                                                    SGD_DIR_NOMBRE)
		                                            values('$sgdTrd',
		                                                    '$grbNombresUs2',
		                                                    '$cc_documento_us2',
		                                                    $dpto_tmp2,
		                                                    $muni_tmp2,
		                                                    $idpais2,
		                                                    $idcont2,
		                                                    $sgd_fun_codigo,
		                                                    $sgd_oem_codigo,
		                                                    $sgd_ciu_codigo,
		                                                    $sgd_esp_codigo,
		                                                    $nurad,
		                                                    0,
		                                                    '$direccion_us',
		                                                    '$telefono_us',
		                                                    '$mail_us',
		                                                    1,
		                                                    $nextval,
		                                                    '$emp')";
	$rsg = $db->conn->Execute($isql);
	
	
	if ($gestor = opendir('../bodega/tmp/')) {

/* Esta es la forma correcta de iterar sobre el directorio. 
   Se buscan aka los archvios generados en el sistema
   @autor Se extrae de version 3.8.0 version por correlibre.org
          Modificacion 11/2010 DNP
   */
	include "../class_control/anexo.php";
	$anexo = new anexo($db);

	
	$anexo->anex_radi_nume = $nurad;

	//$db->conn->debug = true;
    while (false !== ($archivo = readdir($gestor))) {
		$archivoFile = explode("_",$archivo,2);
        if($archivoFile[0]==$identificadorArchivos) {
			$anexo->anex_nomb_archivo = "$archivo";
			$anexo->anex_solo_lect = "'S'";
			$anexo->anex_creador = "'".$usuarioqueradica."'";
			$anexo->anex_desc = $archivoFile[1];
			$nuevoArchivo = "$nurad";
			$anexo->anex_depe_creador = $coddepe;
			$anexo->usuaDoc=$radUsuaDoc;
			$anexo->anexarFilaRadicado();
		    if (!copy("../bodega/tmp/".$archivo, "../bodega".$anexo->anexoRutaArchivo)) {
    		  //echo "Error al copiar $archivo...\n";
			}else{
			   $archivosAdjuntos =  $archivoFile[1] . ",";
			}
		}
    }
	
 

    closedir($gestor);
}

// Fin listado Archivos
	if (!$rsg and empty($referencia))
	    echo "<script type='text/javascript'>document.location.href = '../pqr/index.php?error=1';</script>";
	elseif (!$rsg and ! empty($referencia))
	    header("Location: ../pqr/index.php?dosxfort&error=1");

	if ($noRad == "-1" and empty($referencia))
	    echo "<script type='text/javascript'>document.location.href = '../pqr/index.php?error=1';</script>";
	elseif ($noRad == "-1" and ! empty($referencia))
	    header("Location: ../pqr/index.php?dosxfort&error=1");
	    
	$radicadosSel[0] = $noRad;
	$hist->insertarHistorico($radicadosSel, $coddepe, $radi_usua_actu, $coddepe, $radi_usua_actu, "El usuario : ".$grbNombresUs2."\n Dejo el siguiente E-mail : ".$mail_us.""." y numero Telefonico: ".$telefono_us, 61);
	
	/*********** Generacion del archivo de salida *********************************************/
	$fecha1 = time();
	$fecha = FechaFormateada($fecha1);
	/*
	 *Se pasan las variables a la pagina salida_radicado.tpl
	 *por medio del template
	 **/
	
	$tipodoc = makeLabel($db, $tdoc);
	$tdoc = $tipodoc->fields["SGD_PQR_LABEL"];
	$ubica = nom_muni_dpto($muni, $dep, $db);
	while (!$ubica->EOF) {
	    $municip = $ubica->fields["MUNI_NOMB"];
	    $departa = $ubica->fields["DPTO_NOMB"];
	    $ubica->MoveNext();
	}
	
	$numradicado = $nurad;
	$nombre = $grbNombresUs2;
	$lugar = $municip." - ".$departa;
	
	//variables para generar el pdf con l no olvidar \n para dividir filas
	$remitente = "Se�ores\nDepartamento Nacional de Planeaci�n\nCalle 26 # 13 - 19\nTel: 381 50 00\n ";
	$referencia = "REFERENCIA: $tdoc DESDE LA PAGINA WEB DEL DEPARTAMENTO NACIONAL DE PLANEACI�N";
	$contenido = " ";
	$mensaje = "Atentamente";
	$reseptor = $nombre."\nDirecci�n: ".$direccion_us."\nTel�fono:".$telefono_us."\nCorreo electr�nico: ".$mail_us;
	
	$enlace = crearpdf($numradicado, $fecha, $lugar, $remitente, $referencia, $contenido, $asu, $mensaje, $reseptor);
	
	$nurad 	= base64_encode($nurad);
	$asu 	= base64_encode($asu);
	$apell 	= base64_encode($apell);
	$enlace = base64_encode($enlace);
	$fecha	= base64_encode($fecha);
	
	//header("Location: radicado.php?radicado=$nurad".
	//		"&enlace=$enlace".
	//		"&fecha=$fecha".
	//		"&lugar=$lugar".
	//		"&tdoc=$tdoc".
	//		"&asu=$asu".
	//		"&nombre=$nombre".
	//		"&direccion_us=$direccion_us".
	//		"&telefono_us=$telefono_us".
	//		"&mail_us=$mail_us");
	
	echo "<script type='text/javascript'>document.location.href = 'radicado.php?"."radicado=$nurad"."&identificadorArchivos=$identificadorArchivos"."&enlace=$enlace"."&fecha=$fecha"."&lugar=$lugar"."&asu=$asu"."&nombre=$nombre"."&direccion_us=$direccion_us"."&telefono_us=$telefono_us"."&mail_us=$mail_us"."&archivosAdjuntos=$archivosAdjuntos';"."</script>";
?>
