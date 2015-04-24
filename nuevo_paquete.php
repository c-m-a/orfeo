<?
     
if (!$ruta_raiz){ 
	$ruta_raiz = ".";
}

if (!$dependencia)   include "$ruta_raiz/rec_session.php"; 

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/class_control/RemitenteDocumento.php");
require_once("$ruta_raiz/class_control/anexo.php");
require_once("$ruta_raiz/include/combos.php");


		
//Genera el objeto que procesa los datos del remitnete para un paquete de numeración y fechado
$remitenteDocumento = new RemitenteDocumento; 
$remitenteDocumento->setDatosUsuario($nombret_us11,$direccion_us11,$dpto_nombre_us11,$muni_nombre_us11);
$remitenteDocumento->setDatosPredio($nombret_us2,$direccion_us2,$dpto_nombre_us2,$muni_nombre_us2);
$remitenteDocumento->setDatosESP($nombret_us3,$direccion_us3,$dpto_nombre_us3,$muni_nombre_us3);
$tipoDocumento = explode("-", $tipo);
$tipoPaquete = $tipoDocumento[1];
//Arma el query que obtine los datos del paquete de numeración y fechado
$q="select b.SGD_PNUFE_CODI ,a.SGD_DNUFE_CODI,a.SGD_DNUFE_PATH ,b.SGD_PNUFE_SERIE,c.SGD_TPR_DESCRIP,a.SGD_DNUFE_LABEL,a.SGD_DNUFE_MAIN,a.TRTE_CODI from sgd_dnufe_docnufe a,sgd_pnufe_procnumfe b,sgd_tpr_tpdcumento c where b.sgd_pnufe_codi=a.sgd_pnufe_codi " .
		"and c.sgd_tpr_codigo=a.sgd_tpr_codigo and b.sgd_pnufe_codi=$tipoPaquete order by a.sgd_dnufe_main desc";
//$conexion = new ConnectionHandler;
//$conexion2 = new ConnectionHandler;

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$anexo = new Anexo($db);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
//print("EL DOCUMENTO DE ORIGEN ES $tdoc");
?>

<html>
<head>
<link rel="stylesheet" href="estilos_totales.css">
<title>Untitled Document</title>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<script language="JavaScript">

function datosBasicos (){
opener.datosBasicos();
this.close();
}

/**
    * Valida que el formulario desplegado se encuentre adecuadamente diligenciado
*/

function validar(){

desde=0; 
//Verifica que las plantillas existan
documentos=document.formPaqueteDocumentos.listaDocumentos.value;

//Verifica que no exista problema alguno con las plantillas, es decir que el campo que
//indica algun inconveniente "existeDocumento*" no tenga algún comentario de objeción
while ( documentos.indexOf("[",desde) >=0) {
		
		hasta = documentos.indexOf("]",desde) + 1;
		criterio = documentos.substring(desde,hasta);
		
		if (document.formPaqueteDocumentos.elements["existeDocumento"+criterio].value.length>0) {
			alert(document.formPaqueteDocumentos.elements["existeDocumento"+criterio].value);
			return false;				
		}
			
		desde=hasta;
		if (desde >= documentos.length )
   			break;
	}

desde=0; 
//Verifica que los datos de los destinatarios esten completos
//El campo listaDestinatarios almacena los destinatarios involucrados en el paquete de documentos
destinatarios=document.formPaqueteDocumentos.listaDestinatarios.value;
//Verifica que no exista problema alguno con los remitentes, es decir que el campo que
//indica algun inconveniente "completitudDestinatario*" no tenga algún comentario de objeción
while ( destinatarios.indexOf("[",desde) >=0) {
		
		hasta = destinatarios.indexOf("]",desde) + 1;
		criterio = destinatarios.substring(desde,hasta);
		
		if (document.formPaqueteDocumentos.elements["completitudDestinatario"+criterio].value.length>0) {
			alert(document.formPaqueteDocumentos.elements["completitudDestinatario"+criterio].value);
			return false;				
		}
								
		desde=hasta;
		if (desde >= destinatarios.length )
   			break;
	}



//Verifica que los argumentos esten completos, a través del campo "listaArgumentos", que contiene
//la lista de codigos de argumento del paquete de datos
desde=0; 
argumentos=document.formPaqueteDocumentos.listaArgumentos.value;
//Verifica que no exista problema alguno con los argumentos, es decir que las listas de selección que
//despliegan los argumentos hayan sido seleccionadas
while ( argumentos.indexOf("[",desde) >=0) {
		
		hasta = argumentos.indexOf("]",desde) + 1;
		criterio = argumentos.substring(desde,hasta);
		if (document.formPaqueteDocumentos.elements["argumento"+criterio].value=="null") {
			alert(document.formPaqueteDocumentos.elements["argumento"+criterio].options[0].text);					
			return false;				
		}	
		desde=hasta;
		if (desde >= argumentos.length )
   			break;
	}

return true;

}
function cambio(obj) {
alert(obj.name);
nombre=obj.name;
alert(document.formPaqueteDocumentos.elements[nombre].value);
}

function enviar(){
if (validar()){
	document.formPaqueteDocumentos.submit();

}

}

</script>
<form name="formPaqueteDocumentos"   action = "nuevo_paquete_registro.php" method = post >
  <p class="tituloListado" > Se van a anexar los siguientes documentos al radicado <BR>
    <a href="javascript:datosBasicos()">No.
    <?php echo $numrad ?>
    </a>: 
    <input type="hidden" name="tipoPaquete"  value="<?php echo $tipoPaquete ?>">
    <input type="hidden" name="numrad"  value="<?php echo $numrad ?>">
    <input type="hidden" name="krd"  value="<?php echo $krd ?>">
  </p>

<?


$rs=$db->query($q);
$destinatarios="";
$documentos="";

//Recorre el query, pintando los controles del formulario
while ($rs&&!$rs->EOF) {
	$descripcionDocumento=$rs->fields['SGD_DNUFE_LABEL'];
	$destinatario=$rs->fields['TRTE_CODI'];
	$documentoPrincipal = $rs->fields['SGD_DNUFE_MAIN'];
	$prefijoSecuencia = $rs->fields['SGD_PNUFE_SERIE'];
	$destinatarios= $destinatarios."[".$destinatario."]";
	$codDocumento = $rs->fields['SGD_DNUFE_CODI'];
	$documentos=$documentos."[". $codDocumento."]";
	$documentoPath=$rs->fields['SGD_DNUFE_PATH'];
	

?>

<table width="75%"  style="border-collapse: collapse; border: groove;"  >
  <tr> 
    <td class="tituloListado" ><?=$descripcionDocumento?></td>
  </tr>
  <r> 
	
	<?
	// Si es el documento principal pintal el último número generado y los argumentos
	if ($documentoPrincipal=="1") {
		$numeroActualSecuencia = $anexo->obtenerNumeroActualSecuencia($tipoPaquete,$dependencia);
	
	?>    
		<tr> 
    <td class='etextomenu' > 
      <p>(Ultimo numero de documento Generado: <b><font color="#008040"><?=$numeroActualSecuencia?></font></b>)</p>
    </td>
  </tr>
		
      <td class='timpar'> 
        <p><font size="1"> 
          <?


$q2="select * from sgd_argd_argdoc where sgd_pnufe_codi=$tipoPaquete ";
$rs2=$db->query($q2);
$a = new combo($db); 
$argumentosActuales="";
//print($q2);
while ($rs2&&!$rs2->EOF){
	$codigoargumento = $rs2->fields['SGD_ARGD_CODI'];   
	$tabla=$rs2->fields['SGD_ARGD_TABLA'];
	$campoLlave=$rs2->fields['SGD_ARGD_TCODI'];
	$campoDescripcin=$rs2->fields['SGD_ARGD_TDES'];
	$labelLista=$rs2->fields['SGD_ARGD_LLIST'];
	 $argumentosActuales=$argumentosActuales."[".$codigoargumento."]";
	 
?>
          <BR>
          <select <?php  echo "NAME=argumento[$codigoargumento]" ?>  class="ecajasfecha"   >
            <option selected value="null" > 
            <?=$labelLista?>
            </option>
            <?
     	$s = "select * from $tabla where sgd_tpr_codigo=$tdoc";
      $r = $campoLlave; 
			$t = $campoDescripcin;
			$sim = 0; 
      $a->conectar($s,trim($r),trim($t),$sim,$sim,$sim);
?>
          </select>
			
          <? 
	$rs2->MoveNext();
}}
$remitenteDocumento->escribirRemitente($destinatario);
?>
          <input type="hidden" <? echo "NAME=completitudDestinatario[$destinatario]"?>  value="<?php $remitenteDocumento->verificarCompletitud($destinatario); ?>">
					<input type="hidden" <? echo "NAME=existeDocumento[$codDocumento]"?>  
					value="<?php  if (!file_exists(trim("$ruta_raiz/$documentoPath"))) echo ("No existe plantilla para $descripcionDocumento '$ruta_raiz/$documentoPath'");  ?>">
          </font></p>
        </td>	
</table>
<BR>
  <?

	$rs->MoveNext();
}
?>
  <input type="hidden" name="listaArgumentos"  value="<?php echo $argumentosActuales ?>">
  <input type="hidden" name="listaDestinatarios"  value="<?php echo $destinatarios ?>">
  <input type="hidden" name="listaDocumentos"  value="<?php echo $documentos ?>">
  <p>
  <input type="button" name="Submit" value="Cancelar" class="ebuttons2"  onClick="window.close();" >
  <input type="button" name="Submit" value="Aceptar" class="ebuttons2"  onClick="enviar();" >
</p>
</form>
<p>&nbsp;</p>
</body>
</html>
