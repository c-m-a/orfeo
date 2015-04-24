<?
  session_start();
  
	if (!$ruta_raiz){ 
  	$ruta_raiz= ".";
  }
		  
		  
  if(!$dependencia) 
  	include_once "$ruta_raiz/rec_session.php";
	
		
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";	
	require_once("$ruta_raiz/include/combos.php");
	require_once("$ruta_raiz/class_control/TipoDocumento.php");
		
	if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
	
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	
	if ($verUnico==1){
		$objTipoDocto = new TipoDocumento($db);
		$objTipoDocto->TipoDocumento_codigo($tdoc); 
	 }
		
		
	// print ("Llega ($tdoc)($verUnico)--".$objTipoDocto->get_sgd_tpr_codigo() ."--". $objTipoDocto->get_sgd_tpr_descrip() );
	
   
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Orfeo. Anexar archivo .... </title>
<link rel="stylesheet" href="estilos_totales.css">
<script language="JavaScript" type="text/JavaScript">
function datosBasicos (){
opener.datosBasicos();
this.close();

}

function adicionarOp (forma,combo,desc,val,posicion){
	o = new Array;
	o[0]=new Option(desc,val );
	eval(forma.elements[combo].options[posicion]=o[0]);
	
	
}
/**
    * Implementa la acción de anexar un nuevo archivo
    * Decide si la opción a anexar coresponde a un documento sencillo o a 
    * un paquete de documentos
    * @author      Sixto Angel Pinzón
 	* @version     1.0
*/


function nuevoArchivo(){


if (document.formAdjuntarArchivos.tipoLista.value=="null" )
{
	alert ("Debe ingresar el tipo de documento a adjuntar");
	return;
}


valorLista=document.formAdjuntarArchivos.tipoLista.value;
formulario="";

//Si la opción seleccionada contiene 'P', se trata de un paquete, de lo contrario es un documento sencillo
if (valorLista.indexOf('P')!= -1)
	formulario="nuevo_paquete.php";
else
	formulario="nuevo_archivo.php";

nombreVentana="NuevoDoc";
<?
$datos_envio="&otro_us11=$otro_us11&dpto_nombre_us11=$dpto_nombre_us11&muni_nombre_us11=$muni_nombre_us11&direccion_us11=$direccion_us11&nombret_us11=$nombret_us11";
$datos_envio.="&otro_us2=$otro_us2&dpto_nombre_us2=$dpto_nombre_us2&muni_nombre_us2=$muni_nombre_us2&direccion_us2=$direccion_us2&nombret_us2=$nombret_us2";
$datos_envio.="&dpto_nombre_us3=$dpto_nombre_us3&muni_nombre_us3=$muni_nombre_us3&direccion_us3=$direccion_us3&nombret_us3=$nombret_us3&tdoc=$tdoc";

?>


url="<?=$ruta_raiz?>/"+formulario+"?codigo=&<?='krd='.$krd.'&'.session_name().'='.trim(session_id())?>&usua=<?=$usua?>&numrad=<?=$numrad?>&contra=<?=$contra?>&radi=<?=$radi?>&tipo=<?=$tipo?>&ent=<?=$ent?>"+"<?=$datos_envio?>"+"&ruta_raiz=<?=$ruta_raiz?>&tipoLista="+valorLista;
window.open(url,nombreVentana,'top=0,height=580,width=540,scrollbars=yes,resizable=yes');
return; 
} 


/**
    * Recarga la lista de documentos anexados al radicado
*/
function regresar(){
	//opener.history.go(0);
	opener.location.reload();
	window.close();

}


</script>
</head>
<body>
<? 
$phpsession = session_name()."=".session_id(); ?>
 <form action="radsalida/masiva/adjuntar_masiva.php?<?=$phpsession?>&krd<?=$krd?>" method="post" enctype="multipart/form-data" name="formAdjuntarArchivos">
  <table width="47%" border="0" cellspacing="1" cellpadding="0" align="center" class="t_bordeGris">
    <tr align="center"> 
      <td height="25" colspan="2" class="grisCCCCCC"> <span class="etextomenu"> 
        TIPO DE DOCUMENTO A ANEXAR</span></td>
    </tr>
    <tr align="center"> 
      <td width="16%" class="grisCCCCCC"><span class="etextomenu"> Seleccione</span></td>
      <td width="84%" height="30" class="celdaGris"> 
        <div align="left">
				<select name="tipoLista" class="ecajasfecha" id="tipo_clase" >
		   <option selected value="null">----- tipos de documento -----</option>
          
		  
	   <?
			 $verUnico=0;
	      if ($verUnico==0 or !$verUnico) {
		     
		 	 // Arma la lista desplegable con los tipos de documento a anexar
			 $codiATexto = $db->conn->numToString("sgd_pnufe_codi");
			 $codiATexto = $db->conn->ltrim($codiATexto);
			 $concatDocNumFe=$db->conn->Concat("'P-'",$codiATexto);
			 
			 $codiATexto2 = $db->conn->numToString("a.SGD_TPR_CODIGO");
			 $codiATexto2 = $db->conn->ltrim($codiATexto2);
			 $concatDoc=$db->conn->Concat("'S-'",$codiATexto2);
			 
			 $a = new combo($db); 
			 include_once "$ruta_raiz/include/query/queryTipo_documento_selecc.php";

       		  $s = $query1;
		
			  $r = "COD"; 
				$t = "DES";
				$v = $estado;
				$sim = 0; 
				$a->conectar($s,$r,$t,$v,$sim,$sim);
		   	 }
     	 ?>
	           
				 </select>
				<? if ($verUnico==1){?>
				<script>
					adicionarOp (document.formAdjuntarArchivos,'tipoLista','<?= $objTipoDocto->get_sgd_tpr_descrip() ?>','<?= "S-".$objTipoDocto->get_sgd_tpr_codigo()  ?>',1);
				</script>
				<?}?>
				 
				 </div>
      </td>
    </tr>
    <tr align="center"> 
      <td height="30" colspan="2" class="celdaGris"><span class="celdaGris"> <span class="e_texto1"> 
        <input name="aceptar" type="button"  class="ebuttons2" id="envia22"  onClick="window.close();" value="Cancelar">
        <input name="cancelar" type="button"  class="ebuttons2" id="envia"  onClick="nuevoArchivo();" value="Aceptar">
        </span> </span></td>
    </tr>
  </table>
</form>
  <blockquote>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
  </blockquote>
</body>
</html>
