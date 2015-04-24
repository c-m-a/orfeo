<?
/**
 * Programa que muestra el resultado de la consulta de acuerdo a la selecci�n realizada en consultaESP.php
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */

session_start();
$ruta_raiz = "../..";

if(!$_SESSION['dependencia'])	include_once("$ruta_raiz/rec_session.php");
 //En caso de no llegar la dependencia recupera la sesi�n

$phpsession = session_name()."=".session_id();
$params=$phpsession."&krd=$krd";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug=true;

include_once("$ruta_raiz/jh_class/funciones_sgd.php");
include_once("$ruta_raiz/class_control/Contactos.php");

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

/**
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
				default:	trigger_error('Hoppa, egy j t�us a PHP-ben?'.__CLASS__.'::'.__FUNCTION__.'()!', E_USER_WARNING);
			}
		}
		return $jsArray;
	}
	else
	{	return false;	}
}

$nombre = strtoupper(trim($_POST['nombre']));

switch ($_POST['slc_tb'])
{	case '0':
	{	//Si incluy� alguna cadena a buscar
		if (strlen($nombre)) $sqlWhere.=" (nombre_de_la_empresa like '%$nombre%' or sigla_de_la_empresa like '%$nombre%') and ";
		//Si se desea realizar la b�squeda por continente
		if ($_POST['idcont1']!=0 )
		{	$sqlWhere.= "ID_CONT = ".$_POST['idcont1']." and ";
			$tmp_id_inter = $_POST['idcont1'];
		}
		//Si se desea realizar la b�squeda por pais
		if ($_POST['idpais1']!=0)
		{	$sqlWhere.= "ID_PAIS = ".$_POST['idpais1']." and ";
			$tmp_id_inter .= $_POST['idpais1'];
		}
		//Si se desea realizar la b�squeda por departamento
		if ($_POST['codep_us1']!=0 )
		{	$temp = split('-',$_POST['codep_us1']);
			$sqlWhere.= "codigo_del_departamento = ".$temp[1]." and ";
			$tmp_id_inter .= $temp[1];
		}
		//Si se desea realizar la b�squeda por municipio
		if ($_POST['muni_us1']!=0)
		{	$temp = split('-',$_POST['muni_us1']);
			$sqlWhere.= "codigo_del_municipio = ".$temp[2]." and ";
			$tmp_id_inter .= $temp[2];
		}
		//Si incluye ESP desactivas
		if (!isset($_POST['chk_desact']))	$sqlWhere.= " ACTIVA = 1 and ";
		$sqlWhere.="1=1 ";
		$sql = "SELECT IDENTIFICADOR_EMPRESA AS ID,nombre_de_la_empresa AS NOMBRE,
				sigla_de_la_empresa AS SIGLA,ID_CONT AS IDCONT,
				ID_PAIS AS IDPAIS, codigo_del_departamento AS IDDPTO, 
				codigo_del_municipio AS IDMPIO
				FROM bodega_empresas WHERE $sqlWhere
				ORDER BY ID_CONT,IDPAIS,codigo_del_departamento asc,codigo_del_municipio asc, nombre_de_la_empresa asc";
	}break;
	case '1':
	{	//Si incluy� alguna cadena a buscar
		if (strlen($nombre)) $sqlWhere.=" (SGD_OEM_OEMPRESA like '%$nombre%' or SGD_OEM_SIGLA like '%$nombre%') and ";
		//Si se desea realizar la b�squeda por continente
		if ($_POST['idcont1']!=0 )	$sqlWhere.= "ID_CONT = ".$_POST['idcont1']." and ";
		//Si se desea realizar la b�squeda por pais
		if ($_POST['idpais1']!=0)	$sqlWhere.= "ID_PAIS = ".$_POST['idpais1']." and ";
		//Si se desea realizar la b�squeda por departamento
		if ($_POST['codep_us1']!=0 )
		{	$temp = split('-',$_POST['codep_us1']);
			$sqlWhere.= "DPTO_CODI = ".$temp[1]." and ";
		}
		//Si se desea realizar la b�squeda por municipio
		if ($_POST['muni_us1']!=0)
		{	$temp = split('-',$_POST['muni_us1']);
			$sqlWhere.= "MUNI_CODI = ".$temp[2]." and ";
		}
		$sqlWhere.="1=1 ";
		$sql = "SELECT SGD_OEM_CODIGO AS ID, SGD_OEM_OEMPRESA AS NOMBRE,
				SGD_OEM_SIGLA AS SIGLA,ID_CONT AS IDCONT,
				ID_PAIS AS IDPAIS, DPTO_CODI AS IDDPTO, MUNI_CODI AS IDMPIO
				FROM SGD_OEM_OEMPRESAS WHERE $sqlWhere
				ORDER BY ID_CONT,ID_PAIS,DPTO_CODI asc,MUNI_CODI asc, SGD_OEM_OEMPRESA asc";
	}break;
	case '2':
	{	//Si incluy� alguna cadena a buscar
		if (strlen($nombre)) $sqlWhere.=" (SGD_CIU_NOMBRE like '%$nombre%' or SGD_CIU_APELL1 like '%$nombre%') and ";
		//Si se desea realizar la b�squeda por continente
		if ($_POST['idcont1']!=0 )	$sqlWhere.= "ID_CONT = ".$_POST['idcont1']." and ";
		//Si se desea realizar la b�squeda por pais
		if ($_POST['idpais1']!=0)	$sqlWhere.= "ID_PAIS = ".$_POST['idpais1']." and ";
		//Si se desea realizar la b�squeda por departamento
		if ($_POST['codep_us1']!=0 )
		{	$temp = split('-',$_POST['codep_us1']);
			$sqlWhere.= "DPTO_CODI = ".$temp[1]." and ";
		}
		//Si se desea realizar la b�squeda por municipio
		if ($_POST['muni_us1']!=0)
		{	$temp = split('-',$_POST['muni_us1']);
			$sqlWhere.= "MUNI_CODI = ".$temp[2]." and ";
		}
		$sqlWhere.="1=1 ";
		$sql = "SELECT SGD_CIU_CODIGO AS ID,SGD_CIU_NOMBRE AS NOMBRE,
				SGD_CIU_APELL1 AS SIGLA,ID_CONT AS IDCONT,
				ID_PAIS AS IDPAIS, DPTO_CODI AS IDDPTO, MUNI_CODI AS IDMPIO
				FROM SGD_CIU_CIUDADANO WHERE $sqlWhere
				ORDER BY ID_CONT,ID_PAIS, DPTO_CODI asc, MUNI_CODI asc, SGD_CIU_NOMBRE asc ";
	}break;
}
$rs = $db->conn->Execute($sql);
?>
<html>
<head>
<title>Orfeo. Consulta ESP</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="JavaScript" type="text/JavaScript">
/**
* Env�a el formulario de acuerdo a la opci�n seleccionada
*/
function enviar(argumento)
{	document.formSeleccionar.action=argumento+"?"+document.formSeleccionar.params.value;
	document.formSeleccionar.submit();
}

/**
* Selecciona todos los registros del resultado de la b�squeda
*/
function markAll()
{
	//almacena el totoal de los registros hallados
	total=document.formSeleccionar.total.value;
	//alert ("hayY " +total );

	if(document.formSeleccionar.elements['sel_todas'].checked)
		nuevoValor=1;
	else
		nuevoValor=0;

	//Si hay mas de un registro
	if (total>0)
		for (i=0;i<=total;i++)
			document.formSeleccionar.check_value[i].checked=nuevoValor;
	else if (total==0)
		document.formSeleccionar.check_value.checked=nuevoValor;
}

/**
* Valida que hayan registros seleccionados. En caso de haberlos, las restricciones son:
* - TODOS deben ir o no para el mismo continente. Ello significa que TODOS van digirigidos hacia grupo 1 (Continente local) o grupo 2 (Resto del mundo).
* - En caso de que vayan hacia grupo 1, el pais destino general debe ser diferente al local.
* - En caso que el destino sea el pais local, TODOS los destinatarios deben estar o no en el mismo departamento del remitente.
*/

function valida_check(forma)
{	var hay_chk;	//Bandera para saber si hay seleccionados.
	var vec_selec;	//Ac� guardaremos a los que han sido seleccionados.
	var x = -1;		//Subindice para el vector de seleccionados.
	var cnt_idcl;	//Variable para llevar el id (cont/pais/dpto/mcpio) LOCAL
	var cnt_idcc;	//Variable para llevar el id (cont/pais/dpto/mcpio) CICLO
	var cnt_idpl;	//Variable para llevar el id (cont/pais/dpto/mcpio) LOCAL
	var cnt_idpc;	//Variable para llevar el id (cont/pais/dpto/mcpio) CICLO
	var cnt_idml;	//Variable para llevar el id (cont/pais/dpto/mcpio) LOCAL
	var cnt_idmc;	//Variable para llevar el id (cont/pais/dpto/mcpio) CICLO
	var id_local = '<?php echo $_SESSION['cod_local']; ?>';
	hay_chk = false;
 	vec_selec = new Array();
	//Verificamos si hay algun checkado
	for(var i = 0; i < forma.elements.length; i++)
	{	if ((forma.elements[i].type == 'checkbox') && (forma.elements[i].name != 'sel_todas') && (forma.elements[i].checked == true))
		{	x += 1;
			vec_selec[x] = forma.elements[i-1].value;
			hay_chk = true;
    }	}
    if (hay_chk == false)
	{	alert('No ha seleccionado registro');
		return false;
	}
	if	(vec_selec.length > 0)	// Si hay mas de un registro se realiza la validacion explicada en el encabezado.
	{	vec_sub = id_local.split('-');
		tmp_idlc = vec_sub[0];	//Temporal Id local continente
		tmp_idlp = vec_sub[1];	//Temporal Id local pais
		tmp_idlm = (vec_sub[2]*1)+'-'+(vec_sub[3]*1);	//Temporal Id local municipio
		cnt_idcl = 0;
		cnt_idcc = 0;
		cnt_idpl = 0;
		cnt_idpc = 0;
		cnt_idml = 0;
		cnt_idmc = 0;
		x = 0; 					//Subindice para el vector.
		for (i = 0; i < vec_selec.length; i++)
		{	vec_sub = vec_selec[i].split('-');
			idc = vec_sub[0];					//Temporal 1 Id cont destinaratio
			idp = vec_sub[1];					//Temporal 1 Id pais destinaratio
			idm = vec_sub[2]+'-'+vec_sub[3];	//Temporal 1 Id mcpio destinaratio
			if (idc == tmp_idlc)	//Comparativo desde el 1er continente con el continente local
			{	cnt_idcl += 1;
				if (idp == tmp_idlp)	//Comparativo desde el 1er pais con el continente local
				{	cnt_idpl += 1;
					if (idm == tmp_idlm)	//Comparativo desde el 1er mcpio con el continente local
					{	cnt_idml += 1;
					}
					else	cnt_idmc += 1;
				}
				else	cnt_idpc += 1;
			}
			else	cnt_idcc += 1;
		}
		if (cnt_idcl > 0 && cnt_idcc >0)
		{	alert('Hay revoltijo de continentes destinatarios');
			return false;
		}
		else
		{	(cnt_idcl > 0) ? document.getElementById('masiva').value = 3 : document.getElementById('masiva').value = 4;
			//Si contador continente local > 0  ==> masiva = 3 (Grupo 1)  sino masiva = 4 (Grupo 2)
			if (cnt_idpl > 0 && cnt_idpc >0)
			{	alert('Hay revoltijo de paises destinatarios');
				return false;
			}
			else
			{	if (cnt_idpl > 0)	document.getElementById('masiva').value = 2;
				//Si contador paises local > 0  ==> masiva = 2 (Envios nacionales)
				if (cnt_idml > 0 && cnt_idmc >0)
				{	alert('Hay revoltijo de dptos destinatarios');
					return false;
				}
				else
				{	if (cnt_idml > 0)	document.getElementById('masiva').value = 1;
					//Si contador municipio local > 0  ==> masiva = 1 (Envios locales)
					return document.getElementById('masiva').value;
}	}	}	}	}

function valida_lugar(forma,tipo)
{	if (tipo == 0)
	{	if (valida_check(forma))	enviar('selecConsultaESP.php');
		else return false;
	}
	else
	{	if (valida_check(forma) == tipo)	enviar('selecConsultaESP.php');
		else
		{	// En caso de querer validar cambios en la seleccion de registros se har�a ac�.
			// Por ahora solo est� para focalizar los envios para el mismo tipo de destino previo.
			alert('La seleccion de registros no coincide con el tipo previo de envio');
			return false;
}	}	}
<?php
//HLP. Procedimiento para pasar los vectores de registros seleccionados a Javascript
$tmp_cad1 = "selected";
for ($i=0; $i<3; $i++)
{	if (strlen(${$tmp_cad1.$i}) >0)
	{	${"vsel".$i} = explode(',',${$tmp_cad1.$i});
		${"vselct".$i} = explode(',',${$tmp_cad1.'ctt'.$i});
		echo arrayToJsArray(${'vsel'.$i}, 'vsel'.$i);
		echo arrayToJsArray(${'vselct'.$i}, 'vselct'.$i);
	}
}
?>
</script>
</head>
<body>
<form action="selecConsultaESP.php?<?=$params?>" method="post" enctype="multipart/form-data" name="formSeleccionar">
<input type="hidden" name="slc_tb" value="<?=$_POST['slc_tb'] ?>">
<input type="hidden" name="selected0" value="<?=$selected0?>">
<input type="hidden" name="selectedctt0" value="<?=$selectedctt0?>">
<input type="hidden" name="selected1" value="<?=$selected1?>">
<input type="hidden" name="selectedctt1" value="<?=$selectedctt1?>">
<input type="hidden" name="selected2" value="<?=$selected2?>">
<input type="hidden" name="selectedctt2" value="<?=$selectedctt2?>">
<input type="hidden" name="masiva" id="masiva" value="">
<table width="52%" border="0" cellspacing="5" align="center" class="borde_tab">
	<tr align="center">
		<td height="25" class="titulos2" colspan="8">RADICACI&Oacute;N MASIVA <BR>CONSULTA DE ESP</td>
    </tr>
    <tr align="center">
    	<td class='titulos2'" height="12" colspan="8">
    		<div align="left"><BR>Resultado de la b&uacute;squeda: <BR>
    		<input type="hidden" name="params" value="<?=$params?>">
			</div>
		</td>
	</tr>
	<tr align="center">
		<td class='titulos5' height="12" width="13%">CONTINENTE</td>
		<td class='titulos5' height="12" width="13%">PA&Iacute;S</td>
		<td class='titulos5' height="12" width="13%">DEPARTAMENTO</td>
		<td class='titulos5' height="12" width="13%">MUNICIPIO</td>
		<td class='titulos5' height="12" width="38%">NOMBRE</td>
		<td class='titulos5' height="12" width="29%">SIGLA</td>
		<td class='titulos5' height="12" width="29%">DIGNATARIO</td>
      	<td class='titulos5' height="12" width="7%" align="center">
      		SELECCIONAR<BR><input type="checkbox" value="selec" id="sel_todas" NAME="sel_todas" onClick="markAll()" >
		</td>
	</tr>
<?
//Recorre la consulta
$i=-1;
$vec_id = array();
while ($rs&&!$rs->EOF)
{	$i++;
	//Cambia el estilo de la fila si es par
	if (($i%2)==0)
		$clase="timparr";
	else
		$clase="";
	$nomb=$rs->fields['NOMBRE'];
	$sigla=$rs->fields['SIGLA'];
	$codep_us1 = $rs->fields['IDPAIS'].'-'.$rs->fields['IDDPTO'];
	$muni_us1 = $codep_us1.'-'.$rs->fields['IDMPIO'];
	$a = new LOCALIZACION($codep_us1,$muni_us1,$db);
   	$dpto_nombre_us1 = $a->departamento;
   	$muni_nombre_us1 = $a->municipio;
	$chequeado=" ";
	$b = new Contactos($db);
	//Si el registro tiene nuir
	if (strlen($rs->fields['ID']))
		//Si el registro ya fu� seleccionado lo muestra marcado
		//if ( strlen(strpos($selected, $rs->fields['NUIR']."," )))	Comentariado por HLP.
		if (in_array($rs->fields['ID'],explode(',',${'selected'.$_POST['slc_tb']})))
		{	$chequeado="checked";
			(strlen($selectedForm)==0) ? $selectedForm = $rs->fields['ID'] : $selectedForm = $selectedForm.",".$rs->fields['ID'];
			$defa_idctt = array_search($rs->fields['ID'],explode(',',${'selected'.$_POST['slc_tb']}));	//Trae la posicion del NUIR en el "vector" $selected
			if (!is_array($tmp_vectorctt)) $tmp_vectorctt = explode(",",${'selectedctt'.$_POST['slc_tb']}); // Como se supone existe "vector" $selected debe existir el "vector" $selectecctt
		}
?>
	<tr align="justify" class="<?=$clase?>">
		<td class='listado2' height="12" width="13%"><?= $a->GET_NOMBRE_CONT($rs->fields['IDCONT'],$db); ?></td>
		<td class='listado2' height="12" width="13%"><?= $a->GET_NOMBRE_PAIS($rs->fields['IDPAIS'],$db); ?></td>
		<td class='listado2' height="12" width="13%"><?= $a->departamento ?></td>
		<td class='listado2' height="12" width="13%"><?= $a->municipio ?></td>
		<td class='listado2' height="12" width="38%"><?=$nomb ?></td>
		<td class='listado2' height="12" width="29%"><?=$sigla ?></td>
		<td class='listado2' height="12" width="29%">
		<?php
			($_POST['slc_tb'] ==0 or $_POST['slc_tb']==1) ? $b->GetMenuCnt($_POST['slc_tb'],$rs->fields['ID'],$tmp_vectorctt[$defa_idctt]): print '' ;
		?>
		</td>
		<td class='listado2' height="12" width="7%" align="center" >
			<input type="hidden" name="xx" value="<?php echo $rs->fields['IDCONT'].'-'.$rs->fields['IDPAIS'].'-'.$rs->fields['IDDPTO'].'-'.$rs->fields['IDMPIO'] ?>">
			<CENTER><input  type="checkbox" id="check_value"  value="selec"  <?php echo "$chequeado NAME=check_value[".$rs->fields['ID']."]" ?> ></CENTER>
		</td>
		<?php
			$vec_id[$i]['id']  = $rs->fields['ID'];
			$vec_id[$i]['idc'] = $rs->fields['IDCONT'];
			$vec_id[$i]['idp'] = $rs->fields['IDPAIS'];
			$vec_id[$i]['idd'] = $rs->fields['IDDPTO'];
			$vec_id[$i]['idm'] = $rs->fields['IDMPIO'];
		?>
	</tr>
<?	$rs->MoveNext();
	unset($b);
}
?>
	<tr align="center">
		<td height="30" class='titulos2' colspan="8">
	        <input type="hidden" name="selectedForm" value="<?=$selectedForm?>">
	        <input name="enviaPrueba" type="button"  class="botones" id="envia22"  onClick="enviar('menu_masiva.php')"  value="Cerrar">
	        <input name="consultar" type="button"  class="botones" id="envia22"  value="Consultar"  onClick="enviar('consultaESP.php')">
	        <input name="seleccionar" type="SUBMIT"  class="botones" id="envia22"  value="Seleccionar">
	        <input type="hidden" name="total" value="<?=$i?>">
		</td>
	</tr>
</table>
<script language="JavaScript" type="text/JavaScript">
<?php
// Convertimos el vector de los id y cont, paises, dptos y municipios creado a vector en JavaScript.
echo arrayToJsArray($vec_id, 'vid');
?>
</script>
</form>
</body>
</html>