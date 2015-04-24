<?
// Programa que muestra los componentes de un paquete de datos anexado
if (!$ruta_raiz){ 
	$ruta_raiz = ".";
}

if (!$dependencia)   include "$ruta_raiz/rec_session.php"; 

require_once("$ruta_raiz/include/db/ConnectionHandler.php");



//Arma el query para recorrer el paquete de documentos anexado
$q="select b.sgd_pnufe_codi ,a.sgd_dnufe_codi,a.sgd_dnufe_path ,b.sgd_pnufe_serie,c.sgd_tpr_descrip,a.sgd_dnufe_label,a.sgd_dnufe_main,a.trte_codi from sgd_dnufe_docnufe a,sgd_pnufe_procnumfe b,sgd_tpr_tpdcumento c where b.sgd_pnufe_codi=a.sgd_pnufe_codi " .
		"and c.sgd_tpr_codigo=a.sgd_tpr_codigo and b.sgd_pnufe_codi=$tipoPaquete order by a.sgd_dnufe_main";


if (!$db)
		$db = new ConnectionHandler($ruta_raiz);


?>

<html>
<head>
<link rel="stylesheet" href="estilos_totales.css">
<title>Documento sin titulo</title>
</head>
<body bgcolor="#FFFFFF" text="#000000">
<script language="JavaScript">
</script>
<form name="formPaqueteDocumentos"   action = "nuevo_paquete_registro.php" method = post >
  <p class="tituloListado" >&nbsp;</p>
  <table width="47%" border="0" cellspacing="1" cellpadding="0" align="center" class="t_bordeGris">
    <tr align="center"> 
      <td height="25" class="grisCCCCCC"> 
        <div align="left"><span class="etextomenu"> Documentos Anexados</span></div>
      </td>
    </tr>
    <tr align="center"> 
      <td height="25" class="grisCCCCCC"> 
        <div align="left">Se han anexado los siguientes documentos de manera exitosa:</div>
      </td>
    </tr>
  <?
$rs=$db->query($q);
$destinatarios="";
$documentos="";
//Recorre el paquete de documentos anexado y muestra sus componentes
while ($rs&&!$rs->EOF){
	$descripcionDocumento=$rs->fields['SGD_DNUFE_LABEL'];
	$destinatario=$rs->fields['TRTE_CODI'];
	$documentoPrincipal = $rs->fields['SGD_DNUFE_MAIN'];
	$prefijoSecuencia = $rs->fields['SGD_PNUFE_SERIE'];
	$destinatarios= $destinatarios."[".$destinatario."]";
	$codDocumento = $rs->fields['SGD_DNUFE_CODI'];
	$documentos=$documentos."[". $codDocumento."]";
	$documentoPath=$rs->fields['SGD_DNUFE_PATH'];

?>

    <tr align="center"> 
      <td class="celdaGris" > 
        <div align="left" class="etexto"> 
          <?=$descripcionDocumento?>
        </div>
      </td>
    </tr>
    
  
    <?
	$rs->MoveNext();

}
?>
    <tr align="center"> 
      <td height="30" class="celdaGris"><span class="celdaGris"> <span class="e_texto1"> 
        <input name="envia" type="button"  class="ebuttons2" id="envia"  onClick="opener.regresar();window.close();" value="Aceptar">
        </span> </span></td>
    </tr>
  </table>
	
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
