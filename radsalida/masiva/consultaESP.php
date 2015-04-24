<?
/**
 * Programa que despliega el formulario de consulta de ESP
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
$ruta_raiz = "../..";
session_start();

require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

include_once($ruta_raiz."/radicacion/crea_combos_universales.php");

//En caso de no llegar la dependencia recupera la sesi�n
if(!$_SESSION['dependencia']) include "$ruta_raiz/rec_session.php";
?>
<html>
<head>
<title>Orfeo. Consulta ESP</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="JavaScript" src="../../js/crea_combos_2.js"></script>
<script language="JavaScript" type="text/JavaScript">
<?php
//HLP. Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($vpaisesv, 'vp');
echo arrayToJsArray($vdptosv, 'vd');
echo arrayToJsArray($vmcposv, 'vm');
?>

/**
* Env�a el formulario de acuerdo a la opci�n seleccionada, que puede ser ver CSV o consultar
*/
function enviar(argumento)
{	document.formSeleccion.action=argumento+"&"+document.formSeleccion.params.value;
	document.formSeleccion.submit();
}


/*
*	Funcion que se le envia el id del municipio en el formato general c-ppp-ddd-mmm y lo desgloza
*	creando las variables en javascript para su uso individual, p.e. para los combos respectivos.
*/
function crea_var_idlugar_defa(id_mcpio)
{	if (id_mcpio == 0) return;
	var str = id_mcpio.split('-');

	document.formSeleccion.idcont1.value = str[0]*1;
	cambia(formSeleccion,'idpais1','idcont1');
	document.formSeleccion.idpais1.value = str[1]*1;
	cambia(formSeleccion,'codep_us1','idpais1');
	document.formSeleccion.codep_us1.value = str[1]*1+'-'+str[2]*1;
	cambia(formSeleccion,'muni_us1','codep_us1');
	document.formSeleccion.muni_us1.value = str[1]*1+'-'+str[2]*1+'-'+str[3]*1;
}

function activa_chk(forma)
{	//alert(forma.tbusqueda.value);
	//var obj = document.getElementById(chk_desact);
	if (forma.slc_tb.value == 0)
		forma.chk_desact.disabled = false;
	else
		forma.chk_desact.disabled = true;
}
</script>
</head>
<body onload="crea_var_idlugar_defa(<?php echo "'".($_SESSION['cod_local'])."'"; ?>);">
<?
$params = session_name()."=".session_id()."&krd=$krd";
?>
<form action="resultConsultaESP.php?<?=$params?>" method="post" enctype="multipart/form-data" name="formSeleccion" id="formSeleccion" >
<input type="hidden" name="selected0" value="<?=$selected0?>">
<input type="hidden" name="selected1" value="<?=$selected1?>">
<input type="hidden" name="selected2" value="<?=$selected2?>">
<input type="hidden" name="selectedctt0" value="<?=$selectedctt0?>">
<input type="hidden" name="selectedctt1" value="<?=$selectedctt1?>">
<input type="hidden" name="selectedctt2" value="<?=$selectedctt2?>">
<input type="hidden" name="tipo_masiva" value="<?=$_POST['masiva']?>">  <!-- Este valor viene cuando se invoca este archivo en selecConsultaESP.php -->
<table width="55%" border="0" cellspacing="5" cellpadding="0" align="center" class='borde_tab'>
	<tr align="center">
		<td height="25" colspan="2" class='titulos2'>
			CONSULTA Y SELECCI&Oacute;N DE DESTINATARIOS MASIVA
        	<input name="accion" type="hidden" id="accion">
        	<input type="hidden" name="params" value="<?=$params?>">
        </td>
    </tr>
	<tr align="center">
		<td width="31%" class='titulos2'>NOMBRE</td>
		<td width="69%" height="30" class='listado2' align="left">
			<input name="nombre" id="nombre" type="input" size="50" class="tex_area">
		</td>
	</tr>
	<tr align="center">
		<td width="31%" class='titulos2'>Continente</td>
		<td width="69%" height="30" class='listado2'>
			<div align="left">
          	<?	// Listamos los continentes.
    			echo $Rs_Cont->GetMenu2('idcont1',0,"0:&lt;&lt; SELECCIONE &gt;&gt;",false,0,"id=\"idcont1\" class=\"select\" onchange=\"cambia(this.form,'idpais1','idcont1')\"");
	    		$Rs_Cont->Move(0);
			?>
           </div>
		</td>
	</tr>
	<tr align="center">
		<td width="31%" class='titulos2'>Pa&iacute;s</td>
		<td width="69%" height="30" class='listado2'>
			<div align="left">
			<select name="idpais1" id="idpais1" class="select" onChange="cambia(this.form, 'codep_us1', 'idpais1')">
			<option value="0" selected>&lt;&lt; Seleccione Continente &gt;&gt;</option>
			</select>
			</div>
		</td>
	</tr>
	<tr align="center">
		<td width="31%" class='titulos2'>Departamento</td>
		<td height="30" class='listado2' width="69%">
			<div align="left">
			<select name='codep_us1' id ="codep_us1" class='select' onChange="cambia(this.form, 'muni_us1', 'codep_us1')" ><option value='0' selected>&lt;&lt; Seleccione Pa&iacute;s &gt;&gt;</option></select>
			</div>
		</td>
	</tr>
	<tr align="center">
		<td width="31%" class='titulos2'>Municipio</td>
		<td height="30" class='listado2' width="69%">
			<div align="left">
			<select name='muni_us1' id="muni_us1" class='select' ><option value='0' selected>&lt;&lt; Seleccione Dpto &gt;&gt;</option></select>
			</div>
		</td>
	</tr>
	<tr align="center">
		<td width="31%" class='titulos2'>Rango B&uacute;squeda: </td>
		<td height="30" class='listado2' width="69%" align="left">
			<select name="slc_tb" id="slc_tb" class="select" onchange="activa_chk(this.form)">
				<option value="0" selected>Empresas</option>
				<option value="1">Entidades</option>
				<option value="2">Ciudadanos</option>
			</select>&nbsp;&nbsp;
			<input type="checkbox" name="chk_desact" id="chk_desact">Incluir no vigentes
		</td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td class="titulos1" colspan="2">
			<font style="font-family:verdana; font-size:x-small"><b>Nota:
			<font color="Gray">
			El conjunto de registros a seleccionar deben ir para un solo tipo de destino; es decir Local o Nacional o Internacional.
			En caso de ser internacional la selecci&oacute;n ser&aacute; discriminada para solo el continente local o resto del mundo.
			</b></font></font>
		</td>
	</tr>
	<tr align="center">
		<td height="30" colspan="2" class='listado2'>
		<center>
			<input name="Consultar" type="button"  class="botones" id="envia22"  onClick="enviar('resultConsultaESP.php?x=x');" value="Consultar">&nbsp;&nbsp;
<?
				//Si se ha seleccionado registros previamente se muestran los botones para guardar esta seleccion como CSV o para mostrarla como PDF
				//Cada variable hace referencia al rango de busqueda del select 'slc_tb'
				if (strlen(trim($selected0))>0 or strlen(trim($selected1))>0 or strlen(trim($selected2))>0)
				{
?>
        		<input name="guardar" type="button" class="botones" id="envia22"  value="Guardar CSV" onClick="enviar('printConsultaESP.php?salida=csv');">&nbsp;&nbsp;
        		<input name="ver" type="button" class="botones_mediano" id="envia22"  value="Ver Seleccionados"  onClick="enviar('printConsultaESP.php?salida=pdf');">
<?
				}
?>
		</center>
		</td>
	</tr>
</table>
</form>
</body>
</html>
