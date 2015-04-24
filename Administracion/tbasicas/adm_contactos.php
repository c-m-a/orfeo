<?php
session_start();
$ruta_raiz = "../..";
if($_SESSION['usua_admin_sistema'] !=1 ) die(include "$ruta_raiz/errorAcceso.php");
include("$ruta_raiz/config.php"); 		// incluir configuracion.
$ADODB_COUNTRECS = false;
(isset($_POST['ideps'])) ? $ideps_defa=$_POST['ideps'] : $ideps_defa=0 ;
(isset($_POST['idctt'])) ? $idctt_defa=$_POST['idctt'] : $idctt_defa=0 ;

$ruta_raiz = "../..";
include_once("$ruta_raiz/config.php"); 			// incluir configuracion.
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug=true;

if ($db)
{	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$error = 0;
	if (isset($_POST['btn_accion']))
	{	$record = array();
		($_POST['hdBandera'] == 'A')? $record['CTT_ID'] = $db->nextId('SEC_DEF_CONTACTOS') : $record['CTT_ID'] = $_POST['txtidctt'];
		$record['CTT_ID_EMPRESA'] = $_POST['ideps'];
		//$record['CTT_ID_TIPO'] = $_POST['idtipo'] + 1;
		$record['CTT_ID_TIPO'] = $_POST['idtipo'];
		$record['CTT_CARGO'] = $_POST['txtcargo'];
		$record['CTT_NOMBRE'] = $_POST['txtnombre'];
		$record['CTT_TELEFONO'] = $_POST['txttelefono'];
		switch($_POST['btn_accion'])
		{	Case 'Agregar':
			Case 'Modificar':
				{	$ok = $db->conn->Replace('SGD_DEF_CONTACTOS',$record,'CTT_ID',$autoquote = true);
					$ok ? $error = $ok : $error = 4;
				}break;
			Case 'Eliminar':
				{	if (!($db->conn->Execute("DELETE FROM SGD_DEF_CONTACTOS WHERE CTT_ID=".$record['CTT_ID']))) $error = 5;
				}break;
		}
		unset($record);
	}
	switch ($_POST['idtipo'])
	{	case '0':
			$sql="SELECT RTRIM(NOMBRE_DE_LA_EMPRESA) AS DESCRIP, NUIR AS ID FROM BODEGA_EMPRESAS ORDER BY NOMBRE_DE_LA_EMPRESA";
			$rs_idtipo = $db->conn->Execute($sql);
			if (!$rs_idtipo)	$error = 4;
			break;
		case '1':
			$sql="SELECT RTRIM(SGD_OEM_OEMPRESA) AS DESCRIP, SGD_OEM_CODIGO AS ID FROM SGD_OEM_OEMPRESAS ORDER BY SGD_OEM_OEMPRESA";
			$rs_idtipo = $db->conn->Execute($sql);
			if (!$rs_idtipo)	$error = 4;
			break;
		default:
			unset($_POST['ideps']);
			break;
	}

	//	Si ha seleccionado una empresa....
	if ($_POST['ideps'])
	{	require_once("$ruta_raiz/class_control/Contactos.php");
		$ctt = new Contactos($db);
		$rs_idctt = $ctt->SelectContactos($_POST['idtipo'],$_POST['ideps']);
		if ($rs_idctt)
		{	$tmp_vector = $ctt->GetVector($rs_idctt);
			$rs_idctt->Move(0);
		}
		else	$error = 4;
	}
}
else
{
	$error = 3;
}

$msg = '';
if ($error)
{	$msg .= '<tr bordercolor="#FFFFFF">
			<td width="3%" align="center" class="titulosError" colspan="3" bgcolor="#FFFFFF">';
	switch ($error)
	{	case 1:	$msg .= "Informaci&oacute;n actualizada!!";break;													//ACUTALIZACION REALIZADA
		case 2:	$msg .= "Contacto creado satisfactoriamente!!";break;										//INSERCION REALIZADA
		case 3:	$msg .= "Error al conectar a BD, comun&iacute;quese con el Administrador de sistema !!";break;	//NO CONECCION A BD
		case 4:	$msg .= "Error al gestionar datos, comun&iacute;quese con el Administrador de sistema !!";break;	//ERROR EJECUCCI�N SQL
		case 5:	$msg .= "No se puede eliminar Contacto, se encuentra ligado a historial.";break;			//IMPOSIBILIDAD DE ELIMINAR PAIS, EST� LIGADO CON DIRECCIONES
	}
	$msg .= '</td></tr>';
}

/*
*	Funcion que convierte un valor de PHP a un valor Javascript.
*/
function valueToJsValue($value, $encoding = false)
{	if (!is_numeric($value))
	{	$value = str_replace('\\', '\\\\', $value);
		$value = str_replace('"', '\"', $value);
		$value = '"'.$value.'"';
	}
	if ($encoding)
	{	switch ($encoding)
		{	case 'utf8' :	return iconv("ISO-8859-2", "UTF-8", $value);
							break;
		}
	}
	else
	{	return $value;	}
	return ;
}


/*
*	Funcion que convierte un vector de PHP a un vector Javascript.
*	Utiliza a su vez la funcion valueToJsValue.
*/
function arrayToJsArray( $array, $name, $nl = "\n", $encoding = false )
{	if (is_array($array))
	{	$jsArray = $name . ' = new Array();'.$nl;
		foreach($array as $key => $value)
		{	switch (gettype($value))
			{	case 'unknown type':
				case 'resource':
				case 'object':	break;
				case 'array':	$jsArray .= arrayToJsArray($value,$name.'['.valueToJsValue($key, $encoding).']', $nl);
								break;
				case 'NULL':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = null;'.$nl;
								break;
				case 'boolean':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = '.($value ? 'true' : 'false').';'.$nl;
								break;
				case 'string':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = '.valueToJsValue($value, $encoding).';'.$nl;
								break;
				case 'double':
				case 'integer':	$jsArray .= $name.'['.valueToJsValue($key,$encoding).'] = '.$value.';'.$nl;
								break;
				default:	trigger_error('Hoppa, egy j ERROR a PHP-ben?'.__CLASS__.'::'.__FUNCTION__.'()!', E_USER_WARNING);
			}
		}
		return $jsArray;
	}
	else
	{	return false;	}
}
?>
<html>
<head>
<title>.:Orfeo - Administrador de Contactos :.</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="JavaScript">
<!--
function ver_listado()
{	window.open('listados.php?var=ctt','','scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
}

function Actual()
{
var Obj = document.getElementById('idctt');
var i = Obj.selectedIndex;
var x = 0;
var found = true;
if (Obj.options[i].value == 0)
{
	document.getElementById('txtcargo').value = '';
	document.getElementById('txtnombre').value = '';
	document.getElementById('txttelefono').value = '';
	document.getElementById('txtidctt').value = '';
}
else
{
	while(found)
	{	if (vc[x]['ID'] == Obj.options[i].value)	break;
		x += 1;
	}
	document.getElementById('txtcargo').value = vc[x]['CARGO'];
	document.getElementById('txtnombre').value = vc[x]['NOMBRE'];
	document.getElementById('txttelefono').value = vc[x]['TELEFONO'];
	document.getElementById('txtidctt').value = vc[x]['ID'];
}
}

function ValidarInformacion()
{	var strMensaje = "Por favor ingrese las datos.";
	if(document.form1.idtipo.value == "")
	{	alert("Debe seleccionar el Tipo de Contacto.\n" + strMensaje);
		document.form1.idtipo.focus();
		return false;
	}
	if(document.form1.ideps.value == "0")
	{	alert("Debe seleccionar la Empresa o Entidad.\n" + strMensaje);
		document.form1.ideps.focus();
		return false;
	}
	if(document.form1.hdBandera.value == "A" || document.form1.hdBandera.value == "M")
	{	if(document.form1.hdBandera.value == "M" && document.form1.idctt.value == 0)
		{	alert("Debe seleccionar el Contacto a modificar.\n");
			document.form1.idctt.focus();
			return false;
		}
		if(document.form1.txtcargo.value == "")
		{	alert("Debe ingresar el cargo del Contacto.\n" + strMensaje);
			document.form1.txtcargo.focus();
			return false;
		}
		if(document.form1.txtnombre.value == "")
		{	alert("Debe ingresar nombre del Contacto.\n" + strMensaje);
			document.form1.txtnombre.focus();
			return false;
		}
		if(document.form1.txttelefono.value == "")
		{	alert("Debe ingresar el telefono (extension) del Contacto.\n" + strMensaje);
			document.form1.txttelefono.focus();
			return false;
		}
	}
	if(document.form1.hdBandera.value == "E")
	{	if (document.form1.idctt.value != 0)
		{	if(confirm("Esta seguro de borrar el registro ?"))
			{	document.form1.submit();	}
			else
			{	return false;	}
		}
		else
		{	alert("Debe seleccionar el Contacto a eliminar.\n");
			document.form1.idctt.focus();
			return false;

	}	}
	document.form1.submit();
}

function borra_datos()
{

}
<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
if (is_array($tmp_vector))	echo arrayToJsArray($tmp_vector, 'vc');
?>
//-->
</script>
</head>
<body>
<form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>" name="form1" id="form1">
<input type="hidden" name="hdBandera" value="">
<table width="75%" border="1" align="center" class=t_bordeGris>
	<tr bordercolor="#FFFFFF">
		<td width="100%" class="titulos4">
			<B><span class=etexto><center>Administrador de Contactos</center></span></B></td>
	</tr>
</table>
<table width="75%" border="1" align="center" class=t_bordeGris>
	<tr class=timparr>
		<td width="3%" class="titulos2" height="26">1.</td>
		<td width="25%" class="titulos2" height="26">Seleccione Tipo de Contacto</td>
		<td width="72%" class="listado2" height="1">
			<select name="idtipo" id="idtipo" class="select" onchange="document.form1.ideps.value='';this.form.submit();">
			<option value='' <? (isset($_POST['idtipo'])) ? print "" : print "selected"; ?>>&lt;&lt; Seleccione &gt;&gt;</option>
			<option value='0' <? ($_POST['idtipo'] == '0')? print "selected" : print ""; ?>>Entidad</option>
		    <option value='1' <? ($_POST['idtipo'] == '1')? print "selected" : print ""; ?>>Otras Empresas</option>
			</select>
		</td>
	</tr>
	<tr class=timparr>
		<td width="3%" class="titulos2" height="26">2.</td>
		<td width="25%" class="titulos2" height="26">Seleccione la empresa</td>
		<td width="72%" class="listado2">
		<?	// Listamos las entidades/Empresas.
    	if ($rs_idtipo)
    	{	echo $rs_idtipo->GetMenu2('ideps',$ideps_defa,"0:&lt;&lt; SELECCIONE &gt;&gt;",false,0,"id='ideps' class='select' onchange=\"borra_datos();this.form.submit();\"");
	    	$rs_idtipo->Close();
    	}
    	else
    	{
    		echo("<select name='ideps' id='ideps' class='select'><option value=0>&lt;&lt; Seleccione Tipo de Contacto&gt;&gt;</option></select>");
    	}
		?>
		</td>
	</tr>
	<tr>
		<td width="3%" class="titulos2" height="26">3.</td>
		<td width="25%" class="titulos2" height="26">Seleccione el contacto</td>
		<td width="72%" class="listado2">
		<?	// Listamos las entidades/Empresas.
    	if ($rs_idctt)
    	{	echo $rs_idctt->GetMenu2('idctt',$idctt_defa,"0:&lt;&lt; SELECCIONE &gt;&gt;",false,0,"id='idctt' class='select' onchange=\"borra_datos();Actual();\"");
	    	$rs_idctt->Close();
    	}
    	else
    	{
    		echo("<select name='idctt' id='idctt' class='select'><option value=0>&lt;&lt; Seleccione La Empresa &gt;&gt;</option></select>");
    	}
		?>
		</td>
	</tr>
	<tr>
		<td width="3%" class="titulos2" height="26" rowspan="3">4.</td>
		<td width="25%" class="titulos2" height="26">Cargo del contacto</td>
		<td width="72%" class="listado2">
			<input type="text" name="txtcargo" id="txtcargo" size="20">
			<input type="hidden" name="txtidctt" id="txtidctt" size="10">
		</td>
	</tr>
	<tr>
		<td width="25%" class="titulos2" height="26">Nombre del contacto</td>
		<td width="72%" class="listado2"><input type="text" name="txtnombre" id="txtnombre" size="20"></td>
	</tr>
	<tr>
		<td class="titulos2" height="26">Tel&eacute;fono del contacto</td>
		<td class="listado2"><input type="text" name="txttelefono" id="txttelefono" size="20"></td>
	</tr>
<?php
echo $msg;
?>
</table>
<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" class="listado2">
<tr>
	<td width="10%">&nbsp;</td>
    <td width="20%" align="center"><input name="btn_accion" type="button" class="botones" id="btn_accion" value="Listado" onClick="ver_listado();" accesskey="L" alt="Alt + L"></td>
	<td width="20%" align="center"><input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Agregar" onClick="document.form1.hdBandera.value='A'; return ValidarInformacion();" accesskey="A"></td>
	<td width="20%" align="center"><input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Modificar" onClick="document.form1.hdBandera.value='M'; return ValidarInformacion();" accesskey="M"></td>
	<td width="20%" align="center"><input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Eliminar" onClick="document.form1.hdBandera.value='E'; return ValidarInformacion();" accesskey="E"></td>
	<td width="10%">&nbsp;</td>
</tr>
</table>
</form>
</body>
</html>
