<?php
//Programa que radica un paquete de anexos de numeración y fechado
//Recupera los archivos modificados en caso de roolback
function recuperarARchivos($arregloArchsIni,$arregloArchsBk){

	$numArchvos = count($arregloArchsIni);
	$i = 0;
	
	//Recupera los archivos modificados
	while ($i < $numArchvos) {	
			copy ($arregloArchsBk[$i],$arregloArchsIni[$i]);
			$i++;
	}
	

}

if (!$ruta_raiz) $ruta_raiz= ".";

if (!$dependencia or !$depe_codi_territorial or !$depe_municipio )  include "$ruta_raiz/rec_session.php";

require_once("$ruta_raiz/include/db/ConnectionHandler.php"); 
require_once("$ruta_raiz/class_control/anexo.php");
include "$ruta_raiz/class_control/class_gen.php";
require_once("$ruta_raiz/class_control/Dependencia.php");
require_once("$ruta_raiz/class_control/Radicado.php");
require_once("$ruta_raiz/class_control/TipoDocumento.php");
require_once("$ruta_raiz/class_control/Esp.php");

if (!$conexion)
		$conexion = new ConnectionHandler($ruta_raiz);
$conexion->conn->BeginTrans();
$conexion->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 
$fecha_dia_hoy = Date("Y-m-d");
$sqlFechaHoy=$conexion->conn->DBDate($fecha_dia_hoy);
$espObjeto = new Esp($conexion);
$dep = new Dependencia($conexion);
$anex = & new Anexo($conexion);
$anex->anexoRadicado($numrad,$anexo);
$radObjeto = new Radicado($conexion);
$radObjeto->radicado_codigo($numrad);
$tdoc2 = new TipoDocumento($conexion);
$tdoc2->TipoDocumento_codigo($radObjeto->getTdocCodi());
$documentosPaquete=$anex->obtenerAnexosRadicablesPaquete();
$docsNoRadicables =$anex->obtenerAnexosNoRadicablesPaquete();
$dep->Dependencia_codigo($dependencia);
$dependencianomb = $dep->getDepe_nomb();
$dep_dir = $dep->getDepeDir();
$dep_sigla = $dep->getDepeSigla(); 
//Var que almacena el nombre de la ciudad de la territorial
$terr_ciu_nomb = $dep->getTerrCiuNomb();
//Var que almacena el nombre corto de la territorial
$terr_sigla = $dep->getTerrSigla();
//Var que almacena la direccion de la territorial
$terr_direccion = $dep->getTerrDireccion();
//Var que almacena el nombre largo de la territorial
$terr_nombre = $dep->getTerrNombre();
//Var que almacena el nombre del recurso
$nom_recurso =  $tdoc2->get_sgd_tpr_descrip();
$tipoDocumento = & new TipoDocumento($conexion);  
$num = count($documentosPaquete);
$i = 0; 
$j = 0;
//almacena el número de archivos que va siendo procesado
$numArchs=0; 
$no_digitos = 6;
$linkarchivo_grabar = str_replace("bodega","",$linkarchivo);
$linkarchivo_grabar = str_replace("./","",$linkarchivo_grabar);
$trozosPath = explode ("/", $linkarchivo_grabar);
$num2 = count($trozosPath);
$pathParcial="";
$obj_class_gen = new CLASS_GEN();
$fecha_hoy_corto = date("d-m-Y");
$hora=date("H")."_".date("i")."_".date("s");
// var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el año de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fechaArchivo=$adate."_".$mdate."_".$ddate;
//var que almacena el nombre que tendrá la pantilla
$archInsumo="tmp_".$usua_doc."_".$fechaArchivo."_".$hora.".txt";
//Arma el link hacia el lugar donde se encuentran los archivos físicos que hacen parte del paquete


while ($j < $num2-1) {	
	if (strlen($trozosPath[$j]))
		$pathParcial.="/".$trozosPath[$j];
	$j++;
} 
	$verrad = $numrad;
	$radicado_p = $verrad;
	//Se trae los datos del radicado y las direcciones
	require_once "$ruta_raiz/ver_datosrad.php";
	require_once "$ruta_raiz/radicacion/busca_direcciones.php";
	$dir_tipo_us[1]=$dir_tipo_us1;
	$dir_tipo_us[2]=$dir_tipo_us2;
	$dir_tipo_us[3]=$dir_tipo_us3;
	
	$tipo_emp_us[1]=$tipo_emp_us1;
	$tipo_emp_us[2]=$tipo_emp_us2;
	$tipo_emp_us[3]=$tipo_emp_us3;
	
	$nombre_us[1]=$nombre_us1;
	$nombre_us[2]=$nombre_us2;
	$nombre_us[3]=$nombre_us3;
	
	$documento_us[1]=$documento_us1;
	$documento_us[2]=$documento_us2;
	$documento_us[3]=$documento_us3;
	
	$cc_documento_us[1]=$cc_documento_us1;
	$cc_documento_us[2]=$cc_documento_us2;
	$cc_documento_us[3]=$cc_documento_us3;
	
	$prim_apel_us[1]=$prim_apel_us1;
	$prim_apel_us[2]=$prim_apel_us2;
	$prim_apel_us[3]=$prim_apel_us3;
	
	$seg_apel_us[1]=$seg_apel_us1;
	$seg_apel_us[2]=$seg_apel_us2;
	$seg_apel_us[3]=$seg_apel_us3;
	
	$telefono_us[1]=$telefono_us1;
	$telefono_us[2]=$telefono_us2;
	$telefono_us[3]=$telefono_us3;
	
	$direccion_us[1]=$direccion_us1;
	$direccion_us[2]=$direccion_us2;
	$direccion_us[3]=$direccion_us3;
	
	$mail_us[1]=$mail_us1;
	$mail_us[2]=$mail_us2;
	$mail_us[3]=$mail_us3;
	
	$muni_us[1]=$muni_us1;
	$muni_us[2]=$muni_us2;
	$muni_us[3]=$muni_us3;
	
	$codep_us[1]=$codep_us1;
	$codep_us[2]=$codep_us2;
	$codep_us[3]=$codep_us3;
	
	$tipo_us[1]=$tipo_us1;
	$tipo_us[2]=$tipo_us2;
	$tipo_us[3]=$tipo_us3;
  
	$espObjeto->Esp_nit($cc_documento_us3);
	$nuir_e = $espObjeto->getNuir(); 
  $arregloRadicado = array();
	
//Recorre el arreglo con los anexos radicables con el fin de radicarlos uno a uno		
while ($i < $num) {	
	$anex->anexoRadicado($numrad,$documentosPaquete[$i]);
	$tipoDocumento->TipoDocumento_codigo($anex->get_sgd_tpr_codigo());
	$descripcionDocumento="";
	$descripcionDocumento=$tipoDocumento->get_sgd_tpr_descrip();
	$arregloDocumentos[$i]=$descripcionDocumento;
	$desc_anexos="Documento que hace parte de un paquete de numeración y fechado";
	$sec=$conexion->nextId("sec_$depe_codi_territorial");
	
		
	if ($sec==-1){
		print ("No hay secuencia");
	die;
		$conexion->conn->RollbackTrans();
		 die ("<span class='etextomenu'>No existe secuencia para la generaci&oacute;n del radicado (Territorial $depe_codi_territorial)");
	}
  $sec = str_pad($sec,$no_digitos,"0",STR_PAD_left);
	$rad_salida = date("Y") . $dependencia . $sec ."1";
	$sql = "update ANEXOS set RADI_NUME_SALIDA=$rad_salida,
		           ANEX_SOLO_LECT='S',ANEX_RADI_FECH=$sqlFechaHoy,ANEX_ESTADO=2
		           where ANEX_CODIGO=$documentosPaquete[$i] AND ANEX_RADI_NUME=$numrad";
	$rs=$conexion->query($sql);
	
	if (!$rs){
		$conexion->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido actualizar los anexos"); 
	}
		
	$pathCompleto="";
	$pathCompleto=$pathParcial."/".$anex->get_anex_nomb_archivo();
	$carp_codi =1;
	$tipo_docto=$anex->get_sgd_tpr_codigo();
	  
	if (!$tipo_docto)
 		$tipo_docto=0;
	$arregloRadicados[$i]=$rad_salida;	
	$sql = "INSERT INTO RADICADO(EESP_CODI,TDOC_CODI,RADI_NUME_RADI,RADI_FECH_RADI,RADI_NUME_DERI,RADI_TIPO_DERI,CARP_CODI   ,CARP_PER,RADI_DEPE_RADI ,RADI_DEPE_ACTU,RADI_USUA_ACTU,RA_ASUN  ,RADI_DESC_ANEX         ,RADI_PATH     )
								 VALUES(    '$espcodi',$tipo_docto     ,'$rad_salida' , $sqlFechaHoy      ,'$numrad'      ,9  ,$carp_codi,0      ,'$dependencia',$dependencia    ,$codusuario     ,'$descripcionDocumento','$desc_anexos','$pathCompleto')";
	$rs2=$conexion->query($sql);
	
	if (!$rs2){
		$conexion->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido insetar el radicado"); 
	}
		
	$sgd_dir_tipo = $anex->get_sgd_dir_tipo();
	$dir_tipo_us1 = $dir_tipo_us[$sgd_dir_tipo];
	$tipo_emp_us1=$tipo_emp_us[$sgd_dir_tipo];
	$nombre_us1=$nombre_us[$sgd_dir_tipo];
	$documento_us1 = $documento_us[$sgd_dir_tipo];
	$cc_documento_us1 = $cc_documento_us[$sgd_dir_tipo];
	$prim_apel_us1 =$prim_apel_us[$sgd_dir_tipo];
	$seg_apel_us1 = $seg_apel_us[$sgd_dir_tipo];
	$telefono_us1 = $telefono_us[$sgd_dir_tipo];
	$direccion_us1 = $direccion_us[$sgd_dir_tipo];
	$mail_us1 = $mail_us[$sgd_dir_tipo];
	$muni_us1 = $muni_us[$sgd_dir_tipo];
	$codep_us1 = $codep_us[$sgd_dir_tipo];
	$tipo_us1 = $tipo_us[$sgd_dir_tipo];
	$nurad = $rad_salida;
	$documento_us2 = "";
	$documento_us3 = "";
	
	
	include "$ruta_raiz/radicacion/grb_direcciones.php"; 
	
	$i++; 
	//Recupera la información de los datos del radicado base, para combinar la plantilla
	$dir_tipo_us1 = $dir_tipo_us[1];
	$tipo_emp_us1=$tipo_emp_us[1];
	$nombre_us1=$nombre_us[1];
	$documento_us1 = $documento_us[1];
	$cc_documento_us1 = $cc_documento_us[1];
	$prim_apel_us1 =$prim_apel_us[1];
	$seg_apel_us1 = $seg_apel_us[1];
	$telefono_us1 = $telefono_us[1];
	$direccion_us1 = $direccion_us[1];
	$mail_us1 = $mail_us[1];
	$muni_us1 = $muni_us[1];
	$codep_us1 = $codep_us[1];
	$tipo_us1 = $tipo_us[1];
	$nurad = $rad_salida;
	$documento_us2 = $documento_us[2];
	$documento_us3 = $documento_us[3];
	$secuenciaDocto = $anex->get_doc_secuencia_formato($dependencia);
	$fechaDocumento = $anex->get_sgd_fech_doc();
	$fechaDocumento2 = $obj_class_gen->traducefecha_sinDia($fechaDocumento);
	$fechaDocumento=$obj_class_gen->traducefechaDocto($fechaDocumento);
	
	//$campos = array ("*RAD_S*"    ,"*RAD_E_PADRE*"   ,"*CTA_INT*","*ASUNTO*","*F_RAD_E*"            ,"*NOM_R*"        ,"*DIR_R*"         ,"*DEPTO_R*"     ,"*MPIO_R*"        ,"*TEL_R*"      ,"*MAIL_R*","*DOC_R*"          ,"*NOM_P*"       ,"*DIR_P*"      ,"*DEPTO_P*"         ,"*MPIO_P*"        ,"*TEL_P*"      ,"*MAIL_P*","*DOC_P*"          ,"*NOM_E*"     ,"*DIR_E*"       ,"*MPIO_E*"     ,"*DEPTO_E*"        ,"*TEL_E*"       ,"*MAIL_E*","*NIT_E*"          ,"*NUIR_E*","*F_RAD_S*"       ,"*RAD_E*","*SECTOR*"       ,"*NRO_PAGS*"   ,"*DESC_ANEXOS*","*F_HOY_CORTO*"    ,"*F_HOY*","*NUM_DOCTO*","*F_DOCTO*"        ,"*NOM_REC*"       ,"*F_DOCTO1*"    ,"*FUNCIONARIO*","*LOGIN*","*DEP_NOMB*"    ,"*CUI_TER*"    ,"*DEP_SIGLA*");
	//$datos = array ($rad_salida   ,$radicado_p       ,$cuentai   ,$ra_asun  ,$fecha_e               ,$nombret_us1_u   ,$direccion_us1   , $dpto_nombre_us1,$muni_nombre_us1  ,$telefono_us1  ,$mail_us1 ,$cc_documentous1  ,$nombret_us2_u  ,$direccion_us2 ,$dpto_nombre_us2    ,$muni_nombre_us2  ,$telefono_us1  ,$mail_us2 ,$cc_documento_us2  ,$nombret_us3_u,$direccion_us3 ,$muni_nombre_us3,$dpto_nombre_us3   ,$telefono_us3   ,$mail_us3 ,$cc_documento_us3   ,$nuir_e   ,$fecha_hoy_corto  ,$nurad   ,$sector_nombre   ,$radi_nume_hoja,$radi_desc_anex,$fecha_hoy_corto   ,$fecha_hoy,$secuenciaDocto,$fechaDocumento ,$tipoDocumentoDesc,$fechaDocumento2,$usua_nomb     ,$krd     ,$dependencianomb,$depe_municipio,$dep_sigla);
	$campos = array();
	$datos  = array();
	$anex->obtenerArgumentos($campos,$datos); 
	$fp=fopen("$ruta_raiz/bodega/masiva/$archInsumo",'w');
	if (!$fp){
			 	echo "<br><font size='3' ><span class='etextomenu'>ERROR..No se pudo abrir el archivo $ruta_raiz/bodega/masiva/$archInsumo</br>";
				recuperarARchivos($arregloArchsIni,$arregloArchsBk);
				die;
	}
	copy ("$ruta_raiz/bodega$pathCompleto", "$ruta_raiz/bodega$pathCompleto.bk");
	$arregloArchsBk[$numArchs]="$ruta_raiz/bodega$pathCompleto.bk";
	$arregloArchsIni[$numArchs] = "$ruta_raiz/bodega$pathCompleto";
	$numArchs++;
	$ra_asun =  ereg_replace ( "\n", "-", $ra_asun);
	$ra_asun =  ereg_replace ( "\r", " ", $ra_asun);
	fputs ($fp,"archivoInicial=$ruta_raiz/bodega$pathCompleto"."\n"); 
	fputs ($fp,"archivoFinal=$ruta_raiz/bodega$pathCompleto"."\n"); 
	fputs ($fp,"*RAD_S*=$rad_salida\n");
	fputs ($fp,"*RAD_E_PADRE*=$radicado_p\n");
	fputs ($fp,"*CTA_INT*=$cuentai\n");
	fputs ($fp,"*ASUNTO*=$ra_asun\n");
	fputs ($fp,"*F_RAD_E*=$fecha_e\n");
	fputs ($fp,"*NOM_R*=$nombret_us1_u\n");
	fputs ($fp,"*DIR_R*=$direccion_us1\n");
	fputs ($fp,"*DEPTO_R*=$dpto_nombre_us1\n");
	fputs ($fp,"*MPIO_R*=$muni_nombre_us1\n");
	fputs ($fp,"*TEL_R*=$telefono_us1\n");
	fputs ($fp,"*MAIL_R*=$mail_us1\n");
	fputs ($fp,"*DOC_R*=$cc_documentous1\n");
	fputs ($fp,"*NOM_P*=$nombret_us2_u\n");
	fputs ($fp,"*DIR_P*=$direccion_us2\n");
	fputs ($fp,"*DEPTO_P*=$dpto_nombre_us2\n");
	fputs ($fp,"*MPIO_P*=$muni_nombre_us2\n");
	fputs ($fp,"*TEL_P*=$telefono_us1\n");
	fputs ($fp,"*MAIL_P*=$mail_us2\n");
	fputs ($fp,"*DOC_P*=$cc_documento_us2\n");
	fputs ($fp,"*NOM_E*=$nombret_us3_u\n");
	fputs ($fp,"*DIR_E*=$direccion_us3\n");
	fputs ($fp,"*MPIO_E*=$muni_nombre_us3\n");
	fputs ($fp,"*DEPTO_E*=$dpto_nombre_us3\n");
	fputs ($fp,"*TEL_E*=$telefono_us3\n");
	fputs ($fp,"*MAIL_E*=$mail_us3\n");
	fputs ($fp,"*NIT_E*=$cc_documento_us3\n");
	fputs ($fp,"*NUIR_E*=$nuir_e\n");
	fputs ($fp,"*F_RAD_S*=$fecha_hoy_corto\n");
	fputs ($fp,"*RAD_E*=$nurad\n");
	fputs ($fp,"*SECTOR*=$sector_nombre\n");
	fputs ($fp,"*NRO_PAGS*=$radi_nume_hoja\n");
	fputs ($fp,"*DESC_ANEXOS*=$radi_desc_anex\n");
	fputs ($fp,"*F_HOY_CORTO*=$fecha_hoy_corto\n");
	fputs ($fp,"*F_HOY*=$fecha_hoy\n");
	fputs ($fp,"*NUM_DOCTO*=$secuenciaDocto\n");
	fputs ($fp,"*F_DOCTO*=$fechaDocumento\n");
	fputs ($fp,"*F_DOCTO1*=$fechaDocumento2\n");
	fputs ($fp,"*FUNCIONARIO*=$usua_nomb\n");
	fputs ($fp,"*LOGIN*=$krd\n");
	fputs ($fp,"*DEP_NOMB*=$dependencianomb\n");
	fputs ($fp,"*DEP_DIR*=$dep_dir\n");
	fputs ($fp,"*CIU_TER*=$depe_municipio\n");
	fputs ($fp,"*DEP_SIGLA*=$dep_sigla\n");
	fputs ($fp,"*TER*=$terr_sigla\n");   
	fputs ($fp,"*DIR_TER*=$terr_direccion\n");  
	fputs ($fp,"*TER_L*=$terr_nombre\n");
	fputs ($fp,"*NOM_REC*=$nom_recurso\n");
	
	for ($i_count=0;$i_count<count ($campos);$i_count++){
		fputs ($fp,trim($campos[$i_count])."=".trim($datos[$i_count])."\n");
		//print ("<BR> a&nacute;ade".trim($campos[$i_count])."=".trim($datos[$i_count])."\n");
	}
	fclose($fp);
	include("$ruta_raiz/config.php");
	 //El include del servlet hace que se altere el valor de la variable  $estadoTransaccion como 0 si se pudo procesar el documento, -1 de lo
	// contrario
	
	$estadoTransaccion=-1;
	include ("http://$servProcDocs/docgen/servlet/WorkDistributor?accion=1&ambiente=$ambiente&archinsumo=$archInsumo");
	if ($estadoTransaccion!=0){
		$conexion->conn->RollbackTrans();
		echo ("<BR> NO SE PUDO COMPLETAR LA TRANSACCION 	INTENTE MAS TARDE");
		//echo "<BR><input type=button  name=Reintentar value=Reintentar class='ebuttons2' onClick='history.go(0);'>";
		echo "<input type=button  name=Regresar value=Regresar  class='ebuttons2' onClick='history.go(-1);'>";
		recuperarARchivos($arregloArchsIni,$arregloArchsBk);
	die;
	}
	
}

$num = count($docsNoRadicables);
$i = 0; 
$rad_salida="";
//Recorre el arreglo con los anexos no radicables con el fin de radicarlos uno a uno		
while ($i < $num) {
	$anex->anexoRadicado($numrad,$docsNoRadicables[$i]);
	$pathCompleto="";
	$pathCompleto=$pathParcial."/".$anex->get_anex_nomb_archivo();
	$carp_codi =1;
	$tipo_docto=$anex->get_sgd_tpr_codigo();
	$sgd_dir_tipo = $anex->get_sgd_dir_tipo();
	$dir_tipo_us1 = $dir_tipo_us[$sgd_dir_tipo];
	$tipo_emp_us1=$tipo_emp_us[$sgd_dir_tipo];
	$nombre_us1=$nombre_us[$sgd_dir_tipo];
	$documento_us1 = $documento_us[$sgd_dir_tipo];
	$cc_documento_us1 = $cc_documento_us[$sgd_dir_tipo];
	$prim_apel_us1 =$prim_apel_us[$sgd_dir_tipo];
	$seg_apel_us1 = $seg_apel_us[$sgd_dir_tipo];
	$telefono_us1 = $telefono_us[$sgd_dir_tipo];
	$direccion_us1 = $direccion_us[$sgd_dir_tipo];
	$mail_us1 = $mail_us[$sgd_dir_tipo];
	$muni_us1 = $muni_us[$sgd_dir_tipo];
	$codep_us1 = $codep_us[$sgd_dir_tipo];
	$tipo_us1 = $tipo_us[$sgd_dir_tipo];
	$nurad = $rad_salida;
	$documento_us2 = "";
	$documento_us3 = "";
	$campos = array();
	$datos  = array();
	$anex->obtenerArgumentos($campos,$datos); 
	$fp=fopen("$ruta_raiz/bodega/masiva/$archInsumo",'w');
	
	if (!$fp){
			 	echo "<br><font size='3' ><span class='etextomenu'>ERROR..No se pudo abrir el archivo $ruta_raiz/bodega/masiva/$archInsumo</br>";
				die;
	}
	copy ("$ruta_raiz/bodega$pathCompleto", "$ruta_raiz/bodega$pathCompleto.bk");
	$arregloArchsBk[$numArchs]="$ruta_raiz/bodega$pathCompleto.bk";
	$arregloArchsIni[$numArchs] = "$ruta_raiz/bodega$pathCompleto";
	$numArchs++;
	$ra_asun =  ereg_replace ( "\n", "-", $ra_asun);
	$ra_asun =  ereg_replace ( "\r", " ", $ra_asun);
	fputs ($fp,"archivoInicial=$ruta_raiz/bodega$pathCompleto"."\n"); 
	fputs ($fp,"archivoFinal=$ruta_raiz/bodega$pathCompleto"."\n"); 
	fputs ($fp,"*RAD_S*=$rad_salida\n");
	fputs ($fp,"*RAD_E_PADRE*=$radicado_p\n");
	fputs ($fp,"*CTA_INT*=$cuentai\n");
	fputs ($fp,"*ASUNTO*=$ra_asun\n");
	fputs ($fp,"*F_RAD_E*=$fecha_e\n");
	fputs ($fp,"*NOM_R*=$nombret_us1_u\n");
	fputs ($fp,"*DIR_R*=$direccion_us1\n");
	fputs ($fp,"*DEPTO_R*=$dpto_nombre_us1\n");
	fputs ($fp,"*MPIO_R*=$muni_nombre_us1\n");
	fputs ($fp,"*TEL_R*=$telefono_us1\n");
	fputs ($fp,"*MAIL_R*=$mail_us1\n");
	fputs ($fp,"*DOC_R*=$cc_documentous1\n");
	fputs ($fp,"*NOM_P*=$nombret_us2_u\n");
	fputs ($fp,"*DIR_P*=$direccion_us2\n");
	fputs ($fp,"*DEPTO_P*=$dpto_nombre_us2\n");
	fputs ($fp,"*MPIO_P*=$muni_nombre_us2\n");
	fputs ($fp,"*TEL_P*=$telefono_us1\n");
	fputs ($fp,"*MAIL_P*=$mail_us2\n");
	fputs ($fp,"*DOC_P*=$cc_documento_us2\n");
	fputs ($fp,"*NOM_E*=$nombret_us3_u\n");
	fputs ($fp,"*DIR_E*=$direccion_us3\n");
	fputs ($fp,"*MPIO_E*=$muni_nombre_us3\n");
	fputs ($fp,"*DEPTO_E*=$dpto_nombre_us3\n");
	fputs ($fp,"*TEL_E*=$telefono_us3\n");
	fputs ($fp,"*MAIL_E*=$mail_us3\n");
	fputs ($fp,"*NIT_E*=$cc_documento_us3\n");
	fputs ($fp,"*NUIR_E*=$nuir_e\n");
	fputs ($fp,"*F_RAD_S*=$fecha_hoy_corto\n");
	fputs ($fp,"*RAD_E*=$nurad\n");
	fputs ($fp,"*SECTOR*=$sector_nombre\n");
	fputs ($fp,"*NRO_PAGS*=$radi_nume_hoja\n");
	fputs ($fp,"*DESC_ANEXOS*=$radi_desc_anex\n");
	fputs ($fp,"*F_HOY_CORTO*=$fecha_hoy_corto\n");
	fputs ($fp,"*F_HOY*=$fecha_hoy\n");
	fputs ($fp,"*NUM_DOCTO*=$secuenciaDocto\n");
	fputs ($fp,"*F_DOCTO*=$fechaDocumento\n");
	fputs ($fp,"*F_DOCTO1*=$fechaDocumento2\n");
	fputs ($fp,"*FUNCIONARIO*=$usua_nomb\n");
	fputs ($fp,"*LOGIN*=$krd\n");
	fputs ($fp,"*DEP_NOMB*=$dependencianomb\n");
	fputs ($fp,"*DEP_DIR*=$dep_dir\n");
	fputs ($fp,"*CIU_TER*=$depe_municipio\n");
	fputs ($fp,"*DEP_SIGLA*=$dep_sigla\n");
	fputs ($fp,"*TER*=$terr_sigla\n");   
	fputs ($fp,"*DIR_TER*=$terr_direccion\n");  
	fputs ($fp,"*TER_L*=$terr_nombre\n");
	fputs ($fp,"*NOM_REC*=$nom_recurso\n");
	
	for ($i_count=0;$i_count<count ($campos);$i_count++){
		fputs ($fp,trim($campos[$i_count])."=".trim($datos[$i_count])."\n");
	}
	fclose($fp);
	include("$ruta_raiz/config.php");
	 //El include del servlet hace que se altere el valor de la variable  $estadoTransaccion como 0 si se pudo procesar el documento, -1 de lo
	// contrario
	
	$estadoTransaccion=-1;
	include ("http://$servProcDocs/docgen/servlet/WorkDistributor?accion=1&ambiente=$ambiente&archinsumo=$archInsumo");
	if ($estadoTransaccion!=0){
		$conexion->conn->RollbackTrans();
		echo ("<BR> NO SE PUDO COMPLETAR LA TRANSACCION 	INTENTE MAS TARDE");
		echo "<input type=button  name=Regresar value=Regresar  class='ebuttons2' onClick='history.go(-1);'>";
		recuperarARchivos($arregloArchsIni,$arregloArchsBk);
	die;
	}
	$i++; 
	

}	

 $conexion->conn->CommitTrans();
include "$ruta_raiz/radicar_paquete_exitosa.php"; 

?>
