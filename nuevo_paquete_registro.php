<?php
// Programa que actualiza el paquete de documentos de numeración y fechado
session_start();
//print("ENTRA");
if (!$ruta_raiz) $ruta_raiz = ".";
//print("ENTRA1");
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
//print("ENTRA2");
include "$ruta_raiz/rec_session.php";
//print("ENTRA3");
require_once("$ruta_raiz/class_control/anexo.php");
//print("ENTRA4");
require_once("$ruta_raiz/class_control/anex_tipo.php");
//print("INCLUYE");
$fecha_hoy = Date("Y-m-d");
$hora=date("H").":".date("i").":".date("s");
//Trae los datos relacionados con el paquete de documentos de numeración y fechado
$q="select a.SGD_TPR_CODIGO, a.ANEX_TIPO_CODI, a.SGD_DNUFE_GERARQ,b.SGD_PNUFE_CODI ,a.SGD_DNUFE_CODI,a.SGD_DNUFE_PATH ,b.SGD_PNUFE_SERIE,c.SGD_TPR_DESCRIP,a.SGD_DNUFE_LABEL,a.SGD_DNUFE_MAIN,a.TRTE_CODI from sgd_dnufe_docnufe a,sgd_pnufe_procnumfe b,sgd_tpr_tpdcumento c where b.sgd_pnufe_codi=a.sgd_pnufe_codi " .
		"and c.sgd_tpr_codigo=a.sgd_tpr_codigo and b.sgd_pnufe_codi=$tipoPaquete order by a.sgd_dnufe_main desc";
//print("ANTES CONEXIONES");

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->BeginTrans();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 

$anexo = & new Anexo($db);
$tipo_archivo=  & new Anex_tipo($db);  
$auxnumero=$anexo->obtenerMaximoNumeroAnexo($numrad);
$rs=$db->query($q);
$estadoCopia=true;
//print("ANTES WHILE");
//Recorre el paquete de documentos
while (($rs&&!$rs->EOF) && $estadoCopia ){
	//print("RECORRE");
	$doctoPrincipal="0";
	$auxnumero+=1; 
	$tipoArchivoFisico = $rs->fields['ANEX_TIPO_CODI'];
	$tipo_archivo->anex_tipo_codigo($tipoArchivoFisico);
	$extensionArchivo = $tipo_archivo->get_anex_tipo_ext();
	$auxnumero = str_pad($auxnumero,5,"0",STR_PAD_LEFT);
  $archivo=trim($numrad."_".$auxnumero.".".$extensionArchivo);
	$archivoconversion=trim("1").trim($numrad."_".$auxnumero.".".$extensionArchivo);
	$codigo=$numrad.str_pad($auxnumero,5,"0",STR_PAD_LEFT);
	$doctoPrincipal= 	$rs->fields['SGD_DNUFE_MAIN']; 
	$tipoLogicodeArchivo = $rs->fields['SGD_TPR_CODIGO']; 
	$archivoPlantilla = $rs->fields['SGD_DNUFE_PATH']; 
	
	//Se trata del documento principal
	if ($doctoPrincipal=="1") {
		$codDoctoPadre = $codigo;
	}
	
		
	$descripcionDocumento=$rs->fields['SGD_DNUFE_LABEL'];
	$destinatario=$rs->fields['TRTE_CODI'];
	$documentoPrincipal = $rs->fields['SGD_DNUFE_MAIN'];
	$prefijoSecuencia = $rs->fields['SGD_PNUFE_SERIE'];
	$destinatarios= $destinatarios."[".$destinatario."]";
	$codDocumento = $rs->fields['SGD_DNUFE_CODI'];
	$documentos=$documentos."[". $codDocumento."]";
	$documentoPath=$rs->fields['SGD_DNUFE_PATH'];
	$gerarquiaPosicional = $rs->fields['SGD_DNUFE_GERARQ'];
	$tamano = (filesize($documentoPath)/1000);
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	
	$isql = "insert into anexos
	                  (sgd_rem_destino,anex_radi_nume,anex_codigo,anex_tipo,anex_tamano   ,anex_solo_lect,anex_creador,anex_desc,anex_numero,anex_nomb_archivo   ,anex_borrado,anex_salida ,sgd_dir_tipo,sgd_tpr_codigo,sgd_doc_padre,sgd_fech_doc,anex_depe_creador,sgd_pnufe_codi,anex_fech_anex)
	            values ($gerarquiaPosicional  ,$numrad         ,$codigo    ,$tipoArchivoFisico    ,'$tamano'     ,'N','$krd'     ,'$descripcionDocumento' ,$auxnumero ,'$archivoconversion','N'         ,1,$gerarquiaPosicional,$tipoLogicodeArchivo,$codDoctoPadre,$sqlFechaHoy,$dependencia,$tipoPaquete,$sqlFechaHoy) ";

//$conexion2->execute($isql);
	$rs2=$db->query($isql);
	
	if (!$rs2){
		$db->conn->RollbackTrans();
		die ("<span class='etextomenu'>No se ha podido Insetar los anexos"); 
	}
//print ($isql);
$directorio="./bodega/".substr(trim($archivo),0,4)."/".substr(trim($archivo),4,3)."/docs/";
$estadoCopia = copy ( $archivoPlantilla, $directorio.trim(strtolower($archivoconversion)));
if (!$estadoCopia)
{	$db->conn->RollbackTrans();
  die ("ERROR!!  NO SE PUDO SUBIR  ".$directorio.trim(strtolower($archivoconversion)));
}


if ($doctoPrincipal=="1") {
		$num = count($argumento);
	 	$i = 0; 
		
		// Recorre el array de argumentos y actualiza la base de datos
		while ($i < $num) {			
			 $record_id = key($argumento); 
			 $secuencia=$db->nextId("sgd_anar_secue");
			 
			 if  ($secuencia==-1)
 			 	$secuencia=0;
			 
			 $values["sgd_anar_codi"] = $secuencia;
			 $values["anex_codigo"] = "'$codDoctoPadre'";
			 $values["sgd_argd_codi"] = $record_id;
			 $values["sgd_anar_argcod"] = $argumento[$record_id];
			 
			 $rs3=$db->insert("sgd_anar_anexarg",$values);
			 
			 if (!$rs3){
			 	$db->conn->RollbackTrans();
		 	 	die ("<span class='etextomenu'>No se ha podido Grabar la información seleccionada");
			 }

			 next($argumento); 
			 ++$i;
			 array_splice($values, 0);	
		}

}
	$rs->MoveNext();

}
//print("SALE");
$db->conn->CommitTrans();
include ("nuevo_paquete_exito.php");
?>

 <script language="javascript">
//opener.regresar();
//window.close();
</script>

