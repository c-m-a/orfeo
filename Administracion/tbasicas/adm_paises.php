<?
/*  Administrador de Paises.
*	Creado por: Ing. Hollman Ladino Paredes.
*	Para el proyecto ORFEO.
*
*	Permite la administracion de paises. La insercion y modificacion hace uso de la funcion
*	Replace de ADODB, la eliminacion esta sujeta a que este NUNCA haya sido referenciado en radicados.
*/
session_start();
$ruta_raiz = "../..";
if($_SESSION['usua_admin_sistema'] !=1 ) die(include "$ruta_raiz/errorAcceso.php");
include("$ruta_raiz/config.php"); 			// incluir configuracion.
include($ADODB_PATH.'/adodb.inc.php');	// $ADODB_PATH configurada en config.php
$error = 0;
$dsn = $driver."://".$usuario.":".$contrasena."@".$servidor."/".$db;
$conn = NewADOConnection($dsn);
if ($conn)
{	$conn->SetFetchMode(ADODB_FETCH_ASSOC);

	if (isset($_POST['btn_accion']))
	{	$record = array();
		$record['ID_PAIS'] = $_POST['txtIdPais'];
		$record['ID_CONT'] = $_POST['idcont'];
		$record['NOMBRE_PAIS'] = $_POST['txtModelo'];
		switch($_POST['btn_accion'])
		{	Case 'Agregar':
			Case 'Modificar':{	$res = $conn->Replace('SGD_DEF_PAISES',$record,array('ID_PAIS','ID_CONT'),$autoquote = true);
								($res) ? ($res == 1 ? $error = 3 : $error = 4 ) : $error = 2;
					 		 }break;
			Case 'Eliminar':
				{	$ADODB_COUNTRECS = true;
					$sql = "SELECT * FROM SGD_DIR_DRECCIONES WHERE ID_PAIS = ".$record['ID_PAIS'];
					$rs = $conn->Execute($sql);
					$ADODB_COUNTRECS = false;
					if ($rs->RecordCount() > 0)
					{	$error = 5;	}
					else 
					{	$conn->BeginTrans();
						$ok = $conn->Execute('DELETE FROM MUNICIPIO WHERE ID_PAIS=?',$record['ID_PAIS']);
						if ($ok)
						{	$ok = $conn->Execute('DELETE FROM DEPARTAMENTO WHERE ID_PAIS=?',$record['ID_PAIS']);
							if ($ok)
							{	$record = array_slice($record, 0, 2);
								$ok = $conn->Execute('DELETE FROM SGD_DEF_PAISES WHERE ID_PAIS=? AND ID_CONT=?',$record);
							}
						}
						($ok) ? $conn->CommitTrans() : $conn->RollbackTrans() ;
					}
				}break;
			Default: break;
		}
		unset($record);
	}
	
	$sql_cont = "SELECT nombre_cont,ID_CONT FROM SGD_DEF_CONTINENTES ORDER BY nombre_cont";
	$Rs_cont = $conn->CacheExecute(86400,$sql_cont); 	//Query en cache por 24 horas.
	if (!($Rs_cont)) $error = 2;

	if (isset($_POST['idcont']) and $_POST['idcont'] >0)
	{	$sql_pais = "SELECT NOMBRE_PAIS,ID_PAIS FROM SGD_DEF_PAISES WHERE ID_CONT=".$_POST['idcont']." ORDER BY NOMBRE_PAIS";
		$Rs_pais = $conn->Execute($sql_pais);
		if (!($Rs_pais)) $error = 2;
	}
}
else
{	$error = 1;
}
?>
<html>
<head>
<script language="JavaScript">
<!--
function Actual()
{
var Obj = document.getElementById('idpais');
var i = Obj.selectedIndex;
document.getElementById('txtModelo').value = Obj.options[i].text;
document.getElementById('txtIdPais').value = Obj.value;
}

function rightTrim(sString)
{	while (sString.substring(sString.length-1, sString.length) == ' ')
	{	sString = sString.substring(0,sString.length-1);  }
	return sString;
}

function ver_listado()
{
	window.open('listados.php?var=pai','','scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
}
//-->
</script>

<title>Orfeo - Admor de paises.</title>
<link href="../../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<body>
<form name="form1" method="post" action="<?= $_SERVER['PHP_SELF']?>">  
<input type="hidden" name="hdBandera" value="">
<table width="75%" border="1" align="center" cellspacing="0" class="tablas">
<tr bordercolor="#FFFFFF">
	<td colspan="3" height="40" align="center" class="titulos4" valign="middle"><b><span class=etexto>ADMINISTRADOR DE PAISES</span></b></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td width="3%" align="center" class="titulos2"><b>1.</b></td>
	<td width="25%" align="left" class="titulos2"><b>&nbsp;Seleccione Continente</b></td>
	<td width="72%" class="listado2">
	<?	// Listamos los continentes.
    	echo $Rs_cont->GetMenu2('idcont',$_POST['idcont'],"0:&lt;&lt;SELECCIONE&gt;&gt;",false,0,"class='select' onChange=\"this.form.submit()\"");
	    $Rs_cont->Close();
	?>	</td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td align="center" class="titulos2"><b>2.</b></td>
	<td align="left" class="titulos2"><b>&nbsp;Seleccione Pa&iacute;s</b></td>
    <td align="left" class="listado2">
		<?	
		if (isset($_POST['idcont']) and $_POST['idcont'] > 0)
		{	// Listamos los paises segun continente.
    		echo $Rs_pais->GetMenu2('idpais',$_POST['idpais'],"0:&lt;&lt;SELECCIONE&gt;&gt;",false,0,"class='select' id=\"idpais\" onChange=\"Actual();\" ");
	    	$Rs_pais->Close();
	    }
		else 
		{	echo "<select name='idpais' id='idpais' class='select' ><option value='0' selected>&lt;&lt; Seleccione Continente &gt;&gt;</option></select>";
		}
		?></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td rowspan="2" valign="middle" class="titulos2">3.</td>
	<td align="left" class="titulos2"><b>&nbsp;Ingrese c&oacute;digo de pa&iacute;s</b></td>
	<td class="listado2"><input name="txtIdPais" id="txtIdPais" type="text" size="10" maxlength="3"></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td align="left" class="titulos2"><b>&nbsp;Ingrese nombre pa&iacute;s</b></td>
	<td class="listado2"><input name="txtModelo" id="txtModelo" type="text" size="50" maxlength="30"></td>
</tr>
<tr bordercolor="#FFFFFF"> 
	<td width="3%" align="justify" class="info" colspan="3" bgcolor="#FFFFFF"><b>NOTA: </b> Para una estandarizaci&oacute;n en los c&oacute;digos de pa&iacute;ses utilicemos los sugeridos por la ISO.  <a href="http://es.wikipedia.org/wiki/ISO_3166-1" target="_blank" class="vinculos">enlace</a></td>
</tr>
<?php
if ($error)
{	echo '<tr bordercolor="#FFFFFF"> 
			<td width="3%" align="center" class="titulosError" colspan="3" bgcolor="#FFFFFF">';
	switch ($error)
	{	case 1:	//NO CONECCION A BD
				echo "Error al conectar a BD, comun&iacute;quese con el Administrador de sistema !!";
				break;
		case 2:	//ERROR EJECUCCIÓN SQL
				echo "Error al gestionar datos, comun&iacute;quese con el Administrador de sistema !!";
				break;
		case 3:	//ACUTALIZACION REALIZADA
				echo "Informaci&oacute;n actualizada!!";break;
		case 4:	//INSERCION REALIZADA
				echo "Pa&iacute;s creado satisfactoriamente!!";break;
		case 5:	//IMPOSIBILIDAD DE ELIMINAR PAIS, EST&Aacute; LIGADO CON DIRECCIONES
				echo "No se puede eliminar pa&iacute;s, se encuentra ligado a direcciones.";break;
	}
	echo '</td></tr>';
}
?>
</table>
<table width="75%" border="1" align="center" cellpadding="0" cellspacing="0" class="tablas">
<tr bordercolor="#FFFFFF">
	<td width="10%" class="listado2">&nbsp;</td>
	<td width="20%"  class="listado2">
		<span class="celdaGris"> <span class="e_texto1"><center>
		<input name="btn_accion" type="button" class="botones" id="btn_accion" value="Listado" onClick="ver_listado();">
		</center></span>
	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Agregar" onClick="document.form1.hdBandera.value='A'; return ValidarInformacion();">
		</center></span>
	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Modificar" onClick="document.form1.hdBandera.value='M'; return ValidarInformacion();">
		</center></span>
	</td>
	<td width="20%" class="listado2">
		<span class="e_texto1"><center>
		<input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Eliminar" onClick="document.form1.hdBandera.value='E'; return ValidarInformacion();">
		</center></span>
	</td>
	<td width="10%" class="listado2">&nbsp;</td>
</tr>
</table>
</form>

<script ID="clientEventHandlersJS" LANGUAGE="JavaScript">
<!--
function ValidarInformacion()
{	var strMensaje = "Por favor ingrese las datos.";
	
	if (document.form1.idcont.value == "0")
	{	alert("Debe seleccionar el continente.\n" + strMensaje);
		document.form1.idcont.focus();
		return false;
	}
	
	if ( rightTrim(document.form1.txtIdPais.value) <= "0")
	{	alert("Debe ingresar el Codigo de Pais.\n" + strMensaje);
		document.form1.txtIdPais.focus();
		return false;
	}
	else if(isNaN(document.form1.txtIdPais.value))
	{	alert("El Codigo de Pais debe ser numerico.\n" + strMensaje);
		document.form1.txtIdPais.select();
		document.form1.txtIdPais.focus();
		return false; 
	}
	
	if (document.form1.hdBandera.value == "A")
	{	if(rightTrim(document.form1.txtModelo.value) == "")
		{	alert("Debe ingresar nombre del Pais.\n" + strMensaje);
			document.form1.txtModelo.focus();
			return false; 
		}
		else
		{	document.form1.submit();	
		}
	}
	else if(document.form1.hdBandera.value == "M")
	{	if(rightTrim(document.form1.txtModelo.value) == "")
		{	alert("Primero debe seleccionar el Pais a modificar.\n" + strMensaje);	
			return false; 
		}
		else
		{	document.form1.submit();	
		}
	}
	else if(document.form1.hdBandera.value == "E") 
	{	if(confirm("Esta seguro de borrar el registro ?\n La eliminaci\xf3n de este pais incluye sus Dptos y municipios."))
		{	document.form1.submit();	}
		else
		{	return false;	}
	}
}
//-->
</script>
</body>
</html>
