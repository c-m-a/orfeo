<?php 
//require_once ("../include/in_sel.inc");
//require_once("../include/consultas_genericas.php");
//include ("../include/dp_fun_db2.inc");

//$aa = new connect2;

session_start();
$ruta_raiz = "..";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";	
include_once("$ruta_raiz/include/combos.php");
include_once("$ruta_raiz/class_control/usuario.php");
$encabezado = "krd=$krd";
 
if (!$db)
	$db = new ConnectionHandler($ruta_raiz);

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);


$objUsuario = new Usuario($db);

if(!$dependencia) {
  	include "$ruta_raiz/rec_session.php";
}
$depelist = $dependencia;
$textoSeleccionadoDefecto ="----- seleccione -----";
$valorSelecionadoDefecto = "null";
if (strlen ($asesor)) {
	$tipDocAsesor=sacarConsecutivoDelRus($asesor);
	$docAsesor=sacarYearDelRus($asesor);
	$asesor2=traerNombreUsuarioDocto($tipDocAsesor,$docAsesor);

}
else
{
$asesor = $valorSelecionadoDefecto;
$asesor2= $textoSeleccionadoDefecto;
}
?>

<html>
<head>
<title>Solicitud Firmas - ORFEO</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<script language="JavaScript" type="text/JavaScript">
<?php  

$objUsuario->comboUsDepsWhr($deps," and usuario.USUA_ESTA = 1 and usuario.USUA_PERM_FIRMA in (1,3) ");
//$aa->loadAsesorDefensor($dep_user);
?>

function fYaseleccionado(valor) {

	n=0;
	swSeleccionado = false;
	//alert ('Firmas mide ' + document.formFirmantes.elements['firmas[]'].length );
	for (n=0;n<document.formFirmantes.elements['firmas[]'].length;n++ ) {
		if (document.formFirmantes.elements['firmas[]'][n].value == valor)
			swSeleccionado = true;
	}
	
	return swSeleccionado;

}

function fAgregar (opcion) {
	o = new Array;
	j=0;
	
	if (opcion=='AGREGAR_TODO') {
		
		for (i=0;i<document.formFirmantes.elements['usuarios[]'].length;i++ ) {
			document.formFirmantes.elements['usuarios[]'][i].selected = true;
		}
	
	}
	
		for (i=0;i<document.formFirmantes.elements['usuarios[]'].length;i++ ) {
			if (document.formFirmantes.elements['usuarios[]'][i].selected) {
				if (!fYaseleccionado(document.formFirmantes.elements['usuarios[]'][i].value)) {
					o[j]=new Option(document.formFirmantes.elements['usuarios[]'][i].text, document.formFirmantes.elements['usuarios[]'][i].value);
					j++;
				}
			}
		
		}
	
		
	largestwidth=0; 
	if (document.formFirmantes.elements['firmas[]'][0].value =='null')
		longFirmantes = 0;
	else
		longFirmantes =  document.formFirmantes.elements['firmas[]'].length;
		
		
	for (i=0; i < o.length; i++) {
		eval(document.formFirmantes.elements['firmas[]'].options[longFirmantes]=o[i]);	
		if (o[i].text.length > largestwidth) {
			largestwidth=o[i].text.length;
		}
		longFirmantes++;
	}

	document.formFirmantes.elements['firmas[]'].length=longFirmantes;
	evaluarRemover();
	
	
}

function fRemover (opcion) {
	o = new Array;
	j=0;
	
	if (opcion=='REMOVER_TODO') {
		
		for (i=0;i<document.formFirmantes.elements['firmas[]'].length;i++ ) {
			document.formFirmantes.elements['firmas[]'][i].selected = true;
		}
	
	}
	
		for (i=0;i<document.formFirmantes.elements['firmas[]'].length;i++ ) {
			if (!document.formFirmantes.elements['firmas[]'][i].selected) {
				o[j]=new Option(document.formFirmantes.elements['firmas[]'][i].text, document.formFirmantes.elements['usuarios[]'][i].value);
				j++;
			}
		
		}
	
		
	largestwidth=0; 
	longFirmantes = 0;
	
	if (o.length==0){
    	o[longFirmantes]=new Option('----- Sin datos -----', 'null');
     }
			
	for (i=0; i < o.length; i++) {
		eval(document.formFirmantes.elements['firmas[]'].options[longFirmantes]=o[i]);	
		if (o[i].text.length > largestwidth) {
			largestwidth=o[i].text.length;
		}
		longFirmantes++;
	}
	
    
	document.formFirmantes.elements['firmas[]'].length=longFirmantes;
	
	evaluarRemover();
	
	
}

function evaluarRemover () {
 	j=0;
	
 	for (i=0;i<document.formFirmantes.elements['firmas[]'].length;i++ ) {
		if (document.formFirmantes.elements['firmas[]'][i].selected && document.formFirmantes.elements['firmas[]'][i].value !='null')
			j++;
	}
	
	if (j>0) 
		document.formFirmantes.elements['remover'].disabled = false; 
	else
		document.formFirmantes.elements['remover'].disabled = true;
		
	if (document.formFirmantes.elements['firmas[]'][0].value !='null') 
		document.formFirmantes.elements['removerTodo'].disabled = false;
	else
		document.formFirmantes.elements['removerTodo'].disabled = true;
		
		
		
}
function seleccionados(){
	k=0;
	//alert ('evalua  ' +combo + '  '  + boton);
	for (i=0;i<document.formFirmantes.elements['usuarios[]'].length;i++ ) {
		if (document.formFirmantes.elements['usuarios[]'][i].selected && document.formFirmantes.elements['usuarios[]'][i].value !='null')
			k++;
	}
	return (k);

}

function firmantes(){
	k=0;
	//alert ('evalua  ' +combo + '  '  + boton);
	for (i=0;i<document.formFirmantes.elements['firmas[]'].length;i++ ) {
		if (document.formFirmantes.elements['firmas[]'][i].selected && document.formFirmantes.elements['firmas[]'][i].value !='null')
			k++;
	}
	return (k);

}


function evaluarAgregar () {
 
	j = seleccionados();
	if (j>0) 
		document.formFirmantes.elements['agregar'].disabled = false; 
	else
		document.formFirmantes.elements['agregar'].disabled = true;

	
	if (document.formFirmantes.elements['usuarios[]'][0].value !='null')
		document.formFirmantes.elements['agregarTodo'].disabled = false;
	else
		document.formFirmantes.elements['agregarTodo'].disabled = true;
   
}



function blanquearBotones() {
evaluarRemover();
document.formFirmantes.agregarTodo.disabled = true;
document.formFirmantes.remover.disabled = true;
document.formFirmantes.agregar.disabled = true;
if (document.formFirmantes.elements['firmas[]'].length == 1 && document.formFirmantes.elements['firmas[]'].options[0].value=='null') 
	document.formFirmantes.removerTodo.disabled = true;
else
	document.formFirmantes.removerTodo.disabled = false;
if (document.formFirmantes.elements['usuarios[]'].length == 1 && document.formFirmantes.elements['usuarios[]'].options[0].value=='null') 
	document.formFirmantes.agregarTodo.disabled = true;
else if (document.formFirmantes.asesor.value!='null')
	document.formFirmantes.agregarTodo.disabled = false;
//alert ("no asignados");
//alert (document.reparto.abog_asignado.options[0].value);
}


function enviar() {
	
	for (i=0;i<document.formFirmantes.elements['firmas[]'].length;i++ ) {
		document.formFirmantes.elements['firmas[]'][i].selected = true;
	}
	
	j=firmantes();
	if (j==0){
		alert ('Debe seleccionar uno o m�s usuarios firmantes');	
		return;
	}
	document.formFirmantes.submit();

}






</script>


</head>

<body >
<form action="<?=$ruta_raiz?>/firma/firmantesRegistro.php?ruta_raiz=<?=$ruta_raiz?>&<?=$encabezado?>" method="post" name="formFirmantes" id="formFirmantes">
 <input type="hidden" name="radicados" value="<?=$radicados?>"> 
 
  <br>
  <table width="56%" border="0" cellpadding="0" cellspacing="2">
    <tr align="center"> 
      <td colspan="4" class="titulos4" > SOLICITUD DE 
        FIRMAS PARA LOS RADICADOS </td>
    </tr>
    <tr> 
      <td colspan="4" class="titulos2"  align="center" height="24">
        <?=$radicados?>
        </td>
    </tr>
    <tr> 
      <td width="159" class="titulos4"   align="right"  > Dependencia 
         </td>
      <td width="187">
        <select name ="depelist" class="select" id="asesor"  onChange="comboUsuarioDependencia(document.formFirmantes,this.value,'usuarios[]');blanquearBotones();">
          <?php
                        
                        $a = new combo($db); 
                        $s = "select * from dependencia order by DEPE_NOMB asc ";
                        $r = "DEPE_CODI";
                        $t = "DEPE_NOMB";
					    $sim = 0;
                        $v = $depelist;
                        $a->conectar($s,$r,$t,$v,$sim,$sim);
       ?>
        </select>
        </td>
      <td width="118" >&nbsp;</td>
      <td width="202" align="center"  class="titulos4"   > Solicitar 
        Firmas de... </td>
    </tr>
    <tr> 
      <td width="159" rowspan="4" align="right"  class="titulos4"  > Usuarios 
        </td>
      <td width="187" rowspan="4"> 
        <select name ="usuarios[]" size="20" multiple class="select" id="select3" onChange="evaluarAgregar();" >
          <option value="null">----- Sin datos -----</option>
        </select>
        </td>
      <td height="68"  align="left" width="118"> 
        <input name="agregar" type="button"  disabled="true" class="botones_mediano" id="agregar" onClick="fAgregar('AGREGAR_DETALLE');"value="Agregar  &gt;        " accept="">
      </td>
      <td width="202" rowspan="4"><font color="#0000ff"> 
        <select name ="firmas[]" size="20" multiple class="select" id="select4"  onChange="evaluarRemover();"  >
          <option value="null">----- Sin datos -----</option>
        </select>
        </font></td>
    </tr>
    <tr> 
      <td height="69" align="left"  width="118"> 
        <input name="agregarTodo" type="button" disabled="true" class="botones_mediano" id="agregarTodo" onClick="fAgregar('AGREGAR_TODO');"  value="Agregaro  Todo&gt;&gt;">
      </td>
    </tr>
    <tr> 
      <td height="58"  align="left" width="118"> 
        <input name="remover" type="button"   disabled="true" class="botones_mediano" id="remover"  onClick="fRemover('REMOVER_DETALLE');" value="Remover   &lt;        ">
      </td>
    </tr>
    <tr> 
      <td height="33"  align="left" width="118"> 
        <input name="removerTodo" type="button" disabled="true" class="botones_mediano" id="removerTodo3" onClick="fRemover('REMOVER_TODO');"  value="Remover  Todo &lt;&lt;">
      </td>
    </tr>
    <tr> 
      <td  width="159" height="12">&nbsp;</td>
      <td align="right"  height="12">&nbsp; </td>
      <td align="center"  height="12">&nbsp; </td>
      <td width="202" align="right" height="12">
        <input name="Actualizar" type="button"  class="botones" id="removerTodo3" onClick="enviar();"  value="Actualizar ">
      </td>
    </tr>
    <tr> 
      <td  width="159">&nbsp;</td>
      <td align="right"  >&nbsp; </td>
      <td align="left">&nbsp; </td>
      <td width="202" align="right" >
        <input name="Cancelar" type="button"  class="botones" id="Cancelar" onClick="opener.recargar();window.close();"  value="Cancelar ">
      </td>
    </tr>
  </table>
</form>
<script language="JavaScript" type="text/JavaScript">
comboUsuarioDependencia(document.formFirmantes,<?=$depelist?>,'usuarios[]');
evaluarAgregar();
</script>


</body>
</html>
