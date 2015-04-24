<?php
session_start();

    $ruta_raiz="../..";
    if (!$_SESSION['dependencia'])
        header ("Location: $ruta_raiz/cerrar_session.php");

/*  Administrador de Tablas sencillas.
 *	Son tablas que tienen un codigo (digitado) y una descripcion. P.E. : Tema, Resolucion.
 * @copyright Sistema de Gestion Documental ORFEO
 * @version 1.0
 * @author Desarrollado por Ing. Hollman Ladino Paredes para el Instituto de Desarrollo Urbano - IDU.
 *
 */

if (!isset($krd)) $krd = $_POST['krd']; else $krd = $_GET['krd'];

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler($ruta_raiz);

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

$error = 0;
//echo $a= ($db==true?bakano:3);
if ($db)
{	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if (isset($_POST['btn_accion']))
	{	$record = array();
		$record['SGD_FENV_DESCRIP'] = $_POST['txtNombre'];
		$record['SGD_FENV_CODIGO'] = $_POST['txtId'];
		$record['SGD_FENV_ESTADO'] = $_POST['slc_act'];
		$record['SGD_FENV_PLANILLA'] = $_POST['slc_pnl'];

		switch($_POST['btn_accion'])
		{	Case 'Agregar':
				{
					$tabla = 'SGD_FENV_FRMENVIO';
					$sql = $db->conn->GetInsertSQL($tabla, $record, true, null);
					$ok = $db->conn->Execute($sql);
					($ok) ? $error = 3 : $error = 2;
				}break;
			Case 'Modificar':
				{	$ok = $db->conn->Replace('SGD_FENV_FRMENVIO', $record, 'SGD_FENV_CODIGO', true);
					($ok) ? $error = 4 : $error = 2;
				}break;
			Case 'Eliminar':
				{	$ADODB_COUNTRECS = true;
					$sql1 = "SELECT count(1) FROM SGD_RENV_REGENVIO WHERE SGD_FENV_CODIGO = ".$record['SGD_FENV_CODIGO'];
					$sql2 = "SELECT count(1) FROM SGD_CLTA_CLSTARIF WHERE SGD_FENV_CODIGO = ".$record['SGD_FENV_CODIGO'];
					$cnt1 = $db->conn->GetOne($sql1);
					$cnt2 = $db->conn->GetOne($sql2);
					if ($cnt1 > 0 || $cnt2 > 0)
					{	$error = 5;	}
					else
					{	$ok = $db->conn->Execute('DELETE FROM SGD_FENV_FRMENVIO WHERE SGD_FENV_CODIGO='.$record['SGD_FENV_CODIGO']);
						if (!$ok) $error = 2;
					}
				}break;
			Default: break;
		}
		unset($record);
	}

	$sql =	"SELECT SGD_FENV_DESCRIP, SGD_FENV_CODIGO, SGD_FENV_ESTADO
				FROM SGD_FENV_FRMENVIO ORDER BY SGD_FENV_DESCRIP";
	$Rs = $db->conn->Execute($sql);//$db->conn->debug = true;var_dump ($rs);
	if (!($Rs)) $error = 2;
	else
	{	//Creamos el vector que contiene todas las Formas de envio con su respectiva informacion.
		$v_fenv = array();
		$i = 0;
		while ($arr = $Rs->fetchRow())
		{	$v_fenv[$i]['nombre'] = trim($arr['SGD_FENV_DESCRIP']);
			$v_fenv[$i]['id'] = trim($arr['SGD_FENV_CODIGO']);
			$v_fenv[$i]['estado'] = trim($arr['SGD_FENV_ESTADO']);
			$v_fenv[$i]['planilla'] = trim($arr['SGD_FENV_PLANILLA']);
			$i +=1;
		}
		//$Rs->Move(0);
$db->conn->debug = true;
		$Rs = $db->conn->Execute($sql);
		$slc_fenv = $Rs->GetMenu2('sls_idfenv',0,"0:&lt;&lt; SELECCIONE &gt;&gt;",false,0,"id=\"sls_idfenv\" class=\"select\" onchange=\"actualiza_datos(this.value)\"");
		$Rs->Close();
		reset($v_fenv);
	}
}
else
{	$error = 1;
}

$msg = "";
if ($error)
{	$msg .= '<tr bordercolor="#FFFFFF">
			<td width="3%" align="center" class="titulosError" colspan="3" bgcolor="#FFFFFF">';
	switch ($error)
	{	case 1:	//NO CONECCION A BD
				$msg .= "Error al conectar a BD, comun&iacute;quese con el Administrador de sistema !!";
				break;
		case 2:	//ERROR EJECUCCION SQL
				$msg .= "Error al gestionar datos, Si est&aacute; agregando es posible que el ID asignado exista sino comun&iacute;quese con el Administrador de sistema !!";
				break;
		case 3:	//ACUTALIZACION REALIZADA
				$msg .= "Forma de Envio creada satisfactoriamente!!";break;
		case 4:	//INSERCION REALIZADA
				$msg .= "Informaci&oacute;n actualizada!!";break;
		case 5:	//IMPOSIBILIDAD DE ELIMINAR, TIENE HISTORIAL.
				$msg .= "No se puede eliminar, se encuentra ligado a otros registros.";break;
	}
	$msg .= '</td></tr>';
}
?>
<html>
<head>
<script language="JavaScript" src="<?=$ruta_raiz?>/js/crea_combos_2.js"></script>
<script language="JavaScript" src="<?=$ruta_raiz?>/js/formchek.js"></script>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="JavaScript" type="text/JavaScript">
function ver_listado(que)
{
	window.open('listados.php?<?=session_name()."=".session_id()?>&var=fnv','','scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
}

function ValidarInformacion()
{	var strMensaje = "Por favor ingrese todos los datos.";

	if(isWhitespace(document.form1.txtId.value)) 
	{	alert("Debe seleccionar o digitar el codigo.\n" + strMensaje);
		document.form1.txtId.focus();
		return false;
	}
	else if(isNaN(document.form1.txtId.value))
	{	alert("El Codigo debe ser numerico.\n" + strMensaje);
		document.form1.txtId.focus();
		return false; 
	}
	
	if ( (document.form1.hdBandera.value == "A") || (document.form1.hdBandera.value == "M") )
	{	if(isWhitespace(document.form1.txtNombre.value) || 
			isWhitespace(document.form1.slc_pnl.value) || 
			isWhitespace(document.form1.slc_act.value)
		  )
		{	alert(strMensaje);
			return false; 
		}
	}
	if(document.form1.hdBandera.value == "E") 
	{	if(confirm("Esta seguro de borrar el registro ?\n"))
		{	document.form1.submit();	}
		else
		{	return false;	}
	}
	document.form1.submit();
}

<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($v_fenv, 've');
?>

function actualiza_datos(vlr)
{	
	var i;
	for (i=0; i<=ve.length; i++)
	{
		if (ve[i]['id'] == vlr)
		{
			break;
		}
	}
	if (form1.sls_idfenv.value>0)
	{	document.getElementById('txtId').value = ve[i]['id'];
		document.getElementById('txtNombre').value = ve[i]['nombre'];
		document.getElementById('slc_pnl').value = ve[i]['planilla'];
		document.getElementById('slc_act').value = ve[i]['estado'];
	}
	else
	{	document.getElementById('txtId').value = '';
		document.getElementById('txtNombre').value = '';
		document.getElementById('slc_pnl').value = '';
		document.getElementById('slc_act').value = '';
	}
}
</script>
<title>.: ORFEO :. Administraci&oacute;n de ESP(Entidades)</title>
</head>
<body>
<form name="form1" id="form1" method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
<input type='hidden' name='<?=session_name()?>' value='<?=session_id()?>'> 
<input type="hidden" id="hdBandera" name="hdBandera" value="">
<input type="hidden" id="krd" name="krd" value="<?= $krd ?>">
<table width="75%" align="center" border="1" cellspacing="0" class="tablas">
	<tr bordercolor="#FFFFFF">
		<td colspan="6" height="40" class="titulos4" valign="middle" align="center">Administraci&oacute;n de Formas de Env&iacute;o.</td>
	</tr>
</table>
<table border="1" cellpadding="0" cellspacing="0" align="center" width="75%">
<tr bordercolor = "#FFFFFF">
	<td width="5%" align="center" valign="middle" class="titulos2">1.</td>
	<td width="20%" align="left" class="titulos2">Seleccione Env&iacute;o</td>
	<td class="listado2">&nbsp;
	<?=$slc_fenv?>
	</td>
</tr>
<tr bordercolor = "#FFFFFF">
	<td width="5%" align="center" valign="middle" class="titulos2">2.</td>
	<td width="20%" align="left" class="titulos2">Mod. o Ingrese datos</td>
	<td class="listado2">
		<table border="1" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="33%" align="center" valign="middle" class="titulos2">ID</td>
			<td width="33%" align="center" valign="middle" class="titulos2">NOMBRE</td>
		</tr>
		<tr align="center">
			<td width="33%"><input class="tex_area" type="text" name="txtId" id="txtId" size="3" maxlength="3"></td>
			<td width="33%"><input class="tex_area" type="text" name="txtNombre" id="txtNombre" size="50" maxlength="80"></td>
		</tr>
		<tr>
			<td width="33%" align="center" valign="middle" class="titulos2">Est&aacute; activa ?</td>
			<td width="34%" align="center" valign="middle" class="titulos2">Genera Planilla ?</td>
		</tr>
		<tr align="center">
			<td width="34%">
				<select name="slc_act" id="slc_act" class="select">
					<option value="">Seleccione</option>
					<option value="1"> S  I </option>
					<option value="0"> N  O </option>
				</select>
			</td>
			<td width="34%">
				<select name="slc_pnl" id="slc_pnl" class="select">
					<option value="">Seleccione</option>
					<option value="1"> S  I </option>
					<option value="0"> N  O </option>
				</select>
			</td>
		</tr>
		</table>
	</td>
</tr>
<?php	echo $msg;	?>
</table>
<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
<tr bordercolor="#FFFFFF">
	<td width="10%" class="listado2">&nbsp;</td>
	<td width="20%"  class="listado2">
		<span class="celdaGris"><center>
		<input name="btn_accion" type="button" class="botones" id="btn_accion" value="Listado" onClick="ver_listado();">
		</center></span>	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Agregar" onClick="document.form1.hdBandera.value='A'; return ValidarInformacion();">
		</center></span>	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Modificar" onClick="document.form1.hdBandera.value='M'; return ValidarInformacion();">
		</center></span>	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		  <input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Eliminar" onClick="document.form1.hdBandera.value='E'; return ValidarInformacion();">
		  </center></span>	</td>
	<td width="10%" class="listado2">&nbsp;</td>
</tr>
</table>
</form>
</body>
</html>
