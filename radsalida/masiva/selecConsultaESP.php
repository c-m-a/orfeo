<?
/**
 * Programa que actualiza la variable que almacena la selección que ha efectuado el usuario desce resultConsultaESP.php
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */

session_start();

//variable que almacena la cantidad de empresas seleccionadas en el formulario
$num = count($check_value);
$i = 0; 
//almacena todos los elementos seleccionados desde el formulario
$seleccTodos="";
//almacena todos los contactos de los elementos seleccionados desde el formulario
$seleccTodos_idcct="";
//Recorre el arreglo de elementos seleccionados desde el formulario
$tmp_cad1 = "selected".$_POST['slc_tb'];
$tmp_cad2 = "selectedctt".$_POST['slc_tb'];
$selected = ${$tmp_cad1};
$selectedctt = ${$tmp_cad2};
while ($i < $num)
{	$record_id = key($check_value);
	//si el elemento ha sido seleccionado
	if ($check_value[$record_id] == "selec")
	{	(strlen($seleccTodos) > 0) ? $seleccTodos=$seleccTodos.",".$record_id : $seleccTodos=$record_id;
		//se pregunta si el elemento analizado es de los nuevos a seleccionar
		if (in_array($record_id,explode(",",$selected))==false)
		{	// se llena la variable de los nuevos a incluir
			(strlen($seleccNueva) > 0) ? $seleccNueva=$seleccNueva.",".$record_id : $seleccNueva=$record_id;
			if ($_POST['slc_tb'] == 0 or $_POST['slc_tb'] == 1)
				(array_key_exists($record_id,$slc_ctt))? $seleccNuevacct.=$slc_ctt[$record_id].',' : $seleccNuevacct.='0,' ;
	}	}
	next($check_value); 		
	$i++;
}
if (strlen($seleccNuevacct)>1) $seleccNuevacct=substr($seleccNuevacct,0,strlen($seleccNuevacct)-1);

//En caso de que hayan seleccionados previos......
if ($selectedForm)
{
//genera un arreglo con los elementos del formulario previamente seleccionados al cargarlo
$arrselctedForm= explode ( ",", $selectedForm);
//variable que almacena la cantidad de empresas del formulario previamente seleccionadas al cargarlo
$num = count($arrselctedForm);
$i = 0; 
//Se recorre el arreglo de los que ya estaban seleccionados a la hora de cargar el formulario
while ($i < $num)
{ 	$nuir=$arrselctedForm[$i];
	if (strlen($nuir)>0)
	{	// si el nuir a analizar no esta en la selección que llegó finalmente
		//if (strpos($seleccTodos, trim($nuir).",")==false)
		if (in_array($nuir,explode(",",$seleccTodos))==false)
		{	//almacena los elementos excluidos de la selección
			(strlen($excluir)>0) ? $excluir .=",".$nuir : $excluir = $nuir;
	}	}
	$i++;
}
}

if ($selected)
{
//genera un arreglo con la selección global
$arrSelGlobal = explode ( ",", $selected);
//variable que almacena la cantidad de empresas de la selección global
$num = count($arrSelGlobal);
$i = 0;
//Se recorre el arreglo de la seclección global para tomar los que no han sido excluidos
while ($i < $num)
{ 	$nuir=$arrSelGlobal[$i];
	if (strlen($nuir)>0)
	{	// si el niur a analizar no esta dentro de los excluidos
		if (in_array($nuir,explode(",",$excluir))==false)
		{	//se llena la variable con la selección de los que no fueron excluidos
			if (strlen($selectedFinal))
			{	$selectedFinal .= ",".$nuir;
				
			}
			else
			{	$selectedFinal = $nuir;
				
			}
			(array_key_exists($nuir,$slc_ctt)) ? $selectedFinalcct .=$slc_ctt[$nuir].',' : $selectedFinalcct.='0,' ;
	}	}
	$i++;
}
}
if (strlen($selectedFinalcct)>1) $selectedFinalcct=substr($selectedFinalcct,0,strlen($selectedFinalcct)-1);

//se actualiza la variable que almacena la la selección global
if (is_null($selectedFinal))
{	${$tmp_cad1} = $seleccNueva;
	${$tmp_cad2} = $seleccNuevacct;
}
else 
{	${$tmp_cad1} = $seleccNueva.",". $selectedFinal;
	${$tmp_cad2} = $seleccNuevacct.",".$selectedFinalcct;
}

unset($tmp_cad1); unset($tmp_cad2);
require_once("consultaESP.php");
?>