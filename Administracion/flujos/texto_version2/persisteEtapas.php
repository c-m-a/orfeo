
<?
/*
// Id: class.easyxml.php, version 2.0 6/10/2005 18:00
//
// +--------------------------------------------------------------------------+
// | Proyecto:    easyXML                                                     |
// +--------------------------------------------------------------------------+
// | Fichero:     class.easyxml.php                                           |
// |                                                                          |
// | Incluida en:                                                             |
// | LLamada por:                                                             |
// |                                                                          |
// | FunciÛn:     Clase que parsea un archivo XML                             |
// +--------------------------------------------------------------------------+
// | Copyright (c) 2004 Daniel Mota Leiva <daniel.mota@gmail.com>             |
// +--------------------------------------------------------------------------+
// | No borrar estas líneas.                                                  |
// +--------------------------------------------------------------------------+
*/

//$krdOld = $krd;
error_reporting(0);
session_start();
error_reporting(7);
$ruta_raiz = "../../..";
$carpetaOld = $carpeta;
$tipoCarpOld = $tipo_carp;
if(!$tipoCarpOld) $tipoCarpOld= $tipo_carpt;
if(!$krd) $krd=$krdOld;
//if(!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";
print_r($_POST);
include "$ruta_raiz/config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler( "$ruta_raiz" );
    if (!defined('ADODB_FETCH_ASSOC'))define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//	$db->conn->debug = true;    
$usuarioGrafico = $_POST['usuario'];
$passwordUsuarioGrafico = $_POST['password'];

if ( $usuarioGrafico == $krd ) {
	
	$md5 = substr(md5($passwordUsuarioGrafico), 1 , 26);
	
	$selectPasswd = "select USUA_PASW FROM USUARIO WHERE USUA_LOGIN = '$usuarioGrafico'";
	$rsPasswd = $db->conn->query( $selectPasswd );
	$passwdMD5 = $rsPasswd->fields['USUA_PASW'];
	if ($md5 == $passwdMD5) {
		

		if ( $_POST['infoNodos'] ){
			$textoXML = $_POST['infoNodos'];
			//Activar para hacer pruebas locales con el XML que llega como parametro
			
			$textoXML2 = str_replace('\"', '"', $textoXML);
			include "xml.php";
			
				include "$ruta_raiz/include/tx/Proceso.php";
	
				$documento = easyXML($textoXML2, true);
			//Procesamos Nodos
				//Traemos el nombre del proceso
				$descripcionProceso = $documento->flujo->descripcion;
			
				//Se lee el proceso al que se le está creando flujo
				
					$maxProc = "select max(sgd_pexp_codigo) as COD from sgd_pexp_procexpedientes";
					$rsProc = $db->conn->query( $maxProc );
					$procesoSelected = $rsProc->fields['COD'] + 1;
					
					$queryProceso = "insert into sgd_pexp_procexpedientes ( sgd_pexp_codigo , sgd_pexp_descrip, sgd_pexp_tieneflujo) values ( $procesoSelected , '$descripcionProceso', 1 )";
					$db->conn->query( $queryProceso );
				}
					$flujo = new EtapaFlujo( $db );
					
					$nodos = array();
					
					
					
				//Nodos
				if (is_array($documento->flujo->nodo)){
					
				
					foreach ($documento->flujo->nodo as $clave=> $value ){
						
						$flujo->initEtapa( $value->nombre,  $value->atts->id , $value->termino, $procesoSelected );	
		 				$flujo->etapa->setGrafico(1);
		 				
						$resultadoInsercionEt = $flujo-> insertaEtapa(  );
						if( is_numeric($resultadoInsercionEt) ){
							$nodos[ $value->atts->id ] =  $resultadoInsercionEt;
					}
					
				}
					
				$arista = new AristaFlujo( $db );
				//Aristas
		 		if (is_array($documento->flujo->arista)){
					
				
				foreach ($documento->flujo->arista as $clave=> $value ){
				  $arista->initArista( $nodos [ $value->origen ], $nodos [ $value->destino ], 'Arista ' . $value-> arista->atts->id , 0, 0, 0,0,0, 0, $procesoSelected, 1, 0 );	
					$resultadoInsercionAr = $arista-> insertaArista(  );
					
				}
			
	//
				
				}else {
				 $arista->initArista( $nodos [ $documento->flujo->arista->origen ], $nodos [ $documento->flujo->arista->destino ], 'Arista ' . $value-> arista->atts->id , 0, 0, 0,0,0, 0, $procesoSelected, 1, 0 );	
				}
			}
	}else {
		echo "Error: Password No Concuerda";
	}
}else {
	echo "Error:Usuario No Concuerda";
}
?>