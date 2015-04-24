<?php
/*
*	Al cargar este c�igo, si hay un municipio por defecto se cargan los combos con la respectiva informaci�, sino se
*	cargan los combos vacios y a traves de javascript vamos cambiando el contenido de los combos jerarquicamente.
*
*	Creamos un recordset (y respectivo vector) para cada componente de direccion (Continentes, Paises, Dptos y Mnpios),
*	usamos de "entrada" la opci� getmenu2 de ADODB para generar combos con las opciones por defecto.
*	El vector es para crearlos en javascript y cambiar las opciones a medida que cambien lo seleccionado en los combos. 
*/

if( strncmp ( $db->driver, 'postgres', 8 ) == 0 )
{
	$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
	$db->conn->SetFetchMode(ADODB_FETCH_NUM);
}
else
{
	$ADODB_CACHE_DIR = session_save_path();
	$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
	//$ADODB_ANSI_PADDING_OFF = true;
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
				default:	trigger_error('Hoppa, egy j t�us a PHP-ben?'.__CLASS__.'::'.__FUNCTION__.'()!', E_USER_WARNING);
			}
		}
		return $jsArray;
	}
	else 
	{	return false;	}
}


$sql_continentes =	"SELECT SGD_DEF_CONTINENTES.NOMBRE_CONT, DEPARTAMENTO.ID_CONT
						FROM SGD_DEF_CONTINENTES, DEPARTAMENTO
						WHERE SGD_DEF_CONTINENTES.ID_CONT = DEPARTAMENTO.ID_CONT
						GROUP BY SGD_DEF_CONTINENTES.NOMBRE_CONT, DEPARTAMENTO.ID_CONT
						ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT";
if( strncmp ( $db->driver, 'postgres', 8 ) == 0 )
{
	$Rs_Cont = $db->conn->Execute($sql_continentes);
}
else
{
	$Rs_Cont = $db->conn->CacheExecute(15,$sql_continentes);
}
unset($sql_continentes);

$sql_pais = "SELECT SGD_DEF_PAISES.ID_PAIS AS ID1, SGD_DEF_PAISES.NOMBRE_PAIS AS NOMBRE, SGD_DEF_PAISES.ID_CONT AS ID0
			FROM SGD_DEF_PAISES, SGD_DEF_CONTINENTES WHERE SGD_DEF_PAISES.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT
			GROUP BY SGD_DEF_PAISES.NOMBRE_PAIS, SGD_DEF_PAISES.ID_CONT, SGD_DEF_PAISES.ID_PAIS
			ORDER BY SGD_DEF_PAISES.NOMBRE_PAIS";
if( strncmp ( $db->driver, 'postgres', 8 ) == 0 )
{
	$Rs_pais = $db->conn->Execute($sql_pais);
	if ($Rs_pais)
	{
		$idx=0;
		while( !$Rs_pais->EOF )
		{	$vpaisesv[$idx]['ID1'] = $Rs_pais->fields[0];
			$vpaisesv[$idx]['NOMBRE'] = $Rs_pais->fields[1];
			$vpaisesv[$idx]['ID0'] = $Rs_pais->fields[2];
			$idx += 1;
			$Rs_pais->MoveNext();
		}
		$Rs_pais->Close();
	}
}
else
{
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
}
unset($sql_pais);
$Rs_pais->Move(0);

$cad = $db->conn->Concat("RTRIM(DEPARTAMENTO.ID_PAIS)","'-'","RTRIM(DEPARTAMENTO.DPTO_CODI)");
$sql_dpto="SELECT $cad AS ID1, DEPARTAMENTO.DPTO_NOMB AS NOMBRE, DEPARTAMENTO.ID_PAIS AS ID0
			FROM DEPARTAMENTO, SGD_DEF_PAISES
			WHERE DEPARTAMENTO.ID_PAIS = SGD_DEF_PAISES.ID_PAIS
			GROUP BY $cad, DEPARTAMENTO.DPTO_NOMB, DEPARTAMENTO.ID_PAIS";
if( strncmp ( $db->driver, 'postgres', 8 ) == 0 )
{
	$Rs_dpto = $db->conn->Execute($sql_dpto);
	if ($Rs_dpto)
	{
		$it = 0;
		$vdptosv = array();
		while (!$Rs_dpto->EOF)
		{	$vdptosv[$it]['ID1'] = $Rs_dpto->fields[0];
			$vdptosv[$it]['NOMBRE'] = $Rs_dpto->fields[1];
			$vdptosv[$it]['ID0'] = $Rs_dpto->fields[2];
			$it += 1;
			$Rs_dpto->MoveNext();
		}
	}
}
else
{
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
}
unset($sql_dpto);
$Rs_dpto->Move(0);

$cad = $db->conn->Concat("RTRIM(MUNICIPIO.ID_PAIS)","'-'","RTRIM(MUNICIPIO.DPTO_CODI)","'-'","RTRIM(MUNICIPIO.MUNI_CODI)");
$sql_mcpo =	"SELECT $cad as ID1, MUNICIPIO.MUNI_NOMB as NOMBRE, MUNICIPIO.DPTO_CODI as ID0, 
			MUNICIPIO.ID_PAIS as ID, MUNICIPIO.HOMOLOGA_MUNI, MUNICIPIO.HOMOLOGA_IDMUNI 
			FROM MUNICIPIO, DEPARTAMENTO, SGD_DEF_PAISES, SGD_DEF_CONTINENTES 
			WHERE MUNICIPIO.ID_PAIS = SGD_DEF_PAISES.ID_PAIS AND 
			MUNICIPIO.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT AND 
			MUNICIPIO.DPTO_CODI = DEPARTAMENTO.DPTO_CODI 
			GROUP BY $cad, MUNICIPIO.MUNI_NOMB, MUNICIPIO.DPTO_CODI, MUNICIPIO.ID_PAIS, MUNICIPIO.HOMOLOGA_MUNI, MUNICIPIO.HOMOLOGA_IDMUNI 
			ORDER BY MUNICIPIO.MUNI_NOMB";
if( strncmp ( $db->driver, 'postgres', 8 ) == 0 )
{
	$Rs_mcpo = $db->conn->Execute($sql_mcpo);
	if ($Rs_mcpo)
	{	
		$it = 0;
		$vmcposv = array();
		while (!$Rs_mcpo->EOF)
		{	$vmcposv[$it]['ID1'] = $Rs_mcpo->fields[0];
			$vmcposv[$it]['NOMBRE'] = trim($Rs_mcpo->fields[1]);
			$vmcposv[$it]['ID0'] = $Rs_mcpo->fields[2];
			$vmcposv[$it]['ID'] = $Rs_mcpo->fields[3];
			$vmcposv[$it]['HOMO_MCPIO'] = $Rs_mcpo->fields[4];
			$vmcposv[$it]['HOMO_IDMCPIO'] = trim($Rs_mcpo->fields[5]);
			$it += 1;
			$Rs_mcpo->MoveNext();
		}
	}
}
else
{
	$Rs_mcpo = $db->conn->CacheExecute(15,$sql_mcpo);
	if ($Rs_mcpo)
	{	$it = 0;
		$vmcposv = array();
		while (!$Rs_mcpo->EOF)
		{	$vmcposv[$it]['ID1'] = $Rs_mcpo->fields['ID1'];
			$vmcposv[$it]['NOMBRE'] = trim($Rs_mcpo->fields['NOMBRE']);
			$vmcposv[$it]['ID0'] = $Rs_mcpo->fields['ID0'];
			$vmcposv[$it]['ID'] = $Rs_mcpo->fields['ID'];
			$vmcposv[$it]['HOMO_MCPIO'] = $Rs_mcpo->fields['HOMOLOGA_MUNI'];
			$vmcposv[$it]['HOMO_IDMCPIO'] = trim($Rs_mcpo->fields['HOMOLOGA_IDMUNI']);
			$it += 1;
			$Rs_mcpo->MoveNext();
	}	}
}
unset($sql_mcpo);
unset($cad);
$Rs_mcpo->Move(0);
?>