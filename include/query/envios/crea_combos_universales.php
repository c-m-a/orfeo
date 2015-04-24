<?php
/*
*	Al cargar este código, si hay un municipio por defecto se cargan los combos con la respectiva información, sino se
*	cargan los combos vacios y a traves de javascript vamos cambiando el contenido de los combos jerarquicamente.
*
*	Creamos un recordset (y respectivo vector) para cada componente de direccion (Continentes, Paises, Dptos y Mnpios),
*	usamos de "entrada" la opción getmenu2 de ADODB para generar combos con las opciones por defecto.
*	El vector es para crearlos en javascript y cambiar las opciones a medida que cambien lo seleccionado en los combos. 
*/

$ADODB_CACHE_DIR = session_save_path();
//$ADODB_ANSI_PADDING_OFF = true;

/*
*	Función que convierte un valor de PHP a un valor Javascript.
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
*	Función que convierte un vector de PHP a un vector Javascript.
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
				default:	trigger_error('Hoppa, egy új típus a PHP-ben?'.__CLASS__.'::'.__FUNCTION__.'()!', E_USER_WARNING);
			}
		}
		return $jsArray;
	}
	else 
	{	return false;	}
}

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

$sql_continentes =	"SELECT SGD_DEF_CONTINENTES.nombre_cont, MUNICIPIO.id_cont ".
					"FROM MUNICIPIO, SGD_DEF_CONTINENTES WHERE MUNICIPIO.id_cont = SGD_DEF_CONTINENTES.id_cont ".
					"GROUP BY SGD_DEF_CONTINENTES.nombre_cont, MUNICIPIO.id_cont ".
					"ORDER BY SGD_DEF_CONTINENTES.nombre_cont";
$Rs_Cont = $db->conn->CacheExecute(15,$sql_continentes);
unset($sql_continentes);

$sql_pais =	"SELECT MUNICIPIO.id_pais as ID1, SGD_DEF_PAISES.nombre_pais as NOMBRE, SGD_DEF_PAISES.id_cont as ID0 ".
			"FROM MUNICIPIO, SGD_DEF_PAISES WHERE MUNICIPIO.id_pais = SGD_DEF_PAISES.id_pais ".
			"GROUP BY SGD_DEF_PAISES.nombre_pais, MUNICIPIO.id_pais, SGD_DEF_PAISES.id_cont ".
			"ORDER BY SGD_DEF_PAISES.nombre_pais";
$Rs_pais = $db->conn->CacheExecute(15,$sql_pais);
if ($Rs_pais)
{   $vpaises = $db->conn->CacheGetAssoc($sql_pais,$inputarr=false,$force_array=false,$first2cols=false);
	$vpaisesk = array_keys($vpaises);
	$vpaisesv = array_values($vpaises);
	$idx=0;
	foreach ($vpaisesk as $vpk) 
	{	$vpaisesv[$idx]['ID1'] = $vpk;
		$idx += 1;
	}
	unset($vpaisesk);
	unset($vpaises);
	unset($vpk);
}
unset($sql_pais);
$Rs_pais->Move(0);

$cad = $db->conn->Concat("MUNICIPIO.id_pais","'-'","MUNICIPIO.DPTO_CODI");
$sql_dpto =	"SELECT $cad as ID1, DEPARTAMENTO.DPTO_NOMB as NOMBRE, DEPARTAMENTO.id_pais as ID0 
			FROM MUNICIPIO, DEPARTAMENTO, SGD_DEF_PAISES, SGD_DEF_CONTINENTES 
			WHERE    MUNICIPIO.id_pais = DEPARTAMENTO.id_pais AND 
                     MUNICIPIO.DPTO_CODI = DEPARTAMENTO.DPTO_CODI AND 
                     MUNICIPIO.id_pais = SGD_DEF_PAISES.id_pais AND 
                     MUNICIPIO.id_cont = SGD_DEF_CONTINENTES.id_cont 
			GROUP BY $cad, DEPARTAMENTO.DPTO_NOMB, DEPARTAMENTO.id_pais";
$Rs_dpto = $db->conn->CacheExecute(15,$sql_dpto);
if ($Rs_dpto)
{	$it = 0;
	$vdptosv = array();
	while (!$Rs_dpto->EOF)
	{	$vdptosv[$it]['ID1'] = $Rs_dpto->fields['ID1'];
		$vdptosv[$it]['NOMBRE'] = $Rs_dpto->fields['NOMBRE'];
		$vdptosv[$it]['ID0'] = $Rs_dpto->fields['ID0'];
		$it += 1;
		$Rs_dpto->MoveNext();
}	}
unset($sql_dpto);
$Rs_dpto->Move(0);

$cad = $db->conn->Concat("MUNICIPIO.id_pais","'-'","MUNICIPIO.DPTO_CODI","'-'","MUNICIPIO.MUNI_CODI");
$sql_mcpo =	"SELECT $cad as ID1, MUNICIPIO.MUNI_NOMB as NOMBRE, MUNICIPIO.DPTO_CODI as ID0, 
			MUNICIPIO.id_pais as ID 
			FROM MUNICIPIO, DEPARTAMENTO, SGD_DEF_PAISES, SGD_DEF_CONTINENTES 
			WHERE MUNICIPIO.id_pais = SGD_DEF_PAISES.id_pais AND 
			MUNICIPIO.id_cont = SGD_DEF_CONTINENTES.id_cont AND 
			MUNICIPIO.DPTO_CODI = DEPARTAMENTO.DPTO_CODI 
			GROUP BY $cad, MUNICIPIO.MUNI_NOMB, MUNICIPIO.DPTO_CODI, MUNICIPIO.id_pais
			ORDER BY MUNICIPIO.MUNI_NOMB";
$Rs_mcpo = $db->conn->CacheExecute(15,$sql_mcpo);
if ($Rs_mcpo)
{	$it = 0;
	$vmcposv = array();
	while (!$Rs_mcpo->EOF)
	{	$vmcposv[$it]['ID1'] = $Rs_mcpo->fields['ID1'];
		$vmcposv[$it]['NOMBRE'] = $Rs_mcpo->fields['NOMBRE'];
		$vmcposv[$it]['ID0'] = $Rs_mcpo->fields['ID0'];
		$vmcposv[$it]['ID'] = $Rs_mcpo->fields['ID'];
		$it += 1;
		$Rs_mcpo->MoveNext();
}	}
unset($sql_mcpo);
unset($cad);
$Rs_mcpo->Move(0);
?>
