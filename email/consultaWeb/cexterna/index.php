<?php
	$ruta_raiz 	= "../../";
	$empresa 	= array();		// Contiene los datos de la empresa
	$expedientes 	= array(); 		// Contiene los expediente con sus radicados
	$tmpExp		= array(); 		// Temporal para tratar lo expedientes que se van a ver
	$depEnable 	= array(340); 		// Arreglo para activar las dependencias 
						// que se va a mostrar en dropdown y en la consulta
	//$optionDep 	= "Dependencias";
	$dependencias 	= array();
	$showDep 	= array();
	
	$idEmpresa 	= "";		// Variable de la empresa
	$expediente 	=  array();	// Contiene todos los detalles de cada expediente
	
	// Si no hay variable POST vigencia en o es == de uno entonces mostrarVigentes
	$mostrarVig = (isset($vigencia) && $vigencia == 1) ? false : true;
	if ($mostrarVig) {
		$activo[0] = "checked";
	} else {
		$activo[1] = "checked";
	}

	if (isset($_GET["PHPSESSID"])) {
		session_id ($_GET["PHPSESSID"]);
		session_start ($_GET["PHPSESSID"]);
		$PHPSESSID = $_GET["PHPSESSID"];
		$idEmpresa = $_GET["emp_id"]; 	// asigna el numero de la empresa que llega por GET
	}
	
	if (empty($idEmpresa)) {
		$idEmpresa = "2305";	// Prueba con empresa orbitel
	}
	/*echo "<hr>$emp_id<hr>".$_SESSION["emp_id"]."<hr>";
		        $idEmpresa = $emp_id;*/
	
	if (!defined('ADODB_ASSOC_CASE')) define('ADODB_ASSOC_CASE', 1);
	include ($ruta_raiz . "include/db/ConnectionHandler.php");
	include ("./class/UsuarioExterno.class.php");
	$db = new ConnectionHandler($ruta_raiz);
	$usuarioExt = new UsuarioExterno($idEmpresa, $db);
	$empresa = $usuarioExt->obtenerEmp();
	$dependencias = $usuarioExt->getDependencias ();
	$cont = 0;
	
	// for para mostrar en el dropdown las dependencias que estan activadas
	foreach ($depEnable as $dep) {
		foreach ($dependencias as $depComp) {
			if ($depComp["DEPE_CODI"] == $dep) {
				$showDep[$cont]["DEPE_CODI"] = $depComp["DEPE_CODI"];
				$showDep[$cont]["DEPE_NOMB"] = $depComp["DEPE_NOMB"];
				$cont++;
			}
		}
	}
	
	//$dropDownDep = "<option value=\"T\">" . $optionDep . "</option>\n\t";
	// array para ver las dependecias que estan activadas para el dropdown
	if (is_array($showDep)){
		foreach($showDep as $dep) {
			$selected =  (isset($dependencia) && $dep["DEPE_CODI"] == $dependencia) ? "selected" : "";
			$dropDownDep .= "<option value=\"". $dep["DEPE_CODI"] ."\" $selected>" .
						$dep["DEPE_NOMB"] . "</option>\n\t";
		}
	}
	
	// si ejecuta consulta entonces ver detalles expediente
	if (isset($verExpedientes)) {
		if (isset($dependencia) && $dependencia != "T") {
			$expedientes = $usuarioExt->expPorDep($dependencia,$mostrarVig);
		} else {
			/* Sino existe se escoge por defecto la dependencia 330 
			o primera dependencia que se encuentre en el arreglo de dependencias a mostrar*/
			$dependencia = $depEnable[0];
			$expedientes = $usuarioExt->expPorDep($dependencia,$mostrarVig);
		}
	} else {
		$dependencia = $depEnable[0];
		$expedientes = $usuarioExt->expPorDep($dependencia,$mostrarVig);
	}
	
	$cont = 0;
	// Filtrar expedientes que se van ha mostrar
	if(is_array($expedientes)){
		foreach ($depEnable as $dep) {
			foreach ($expedientes as $expediente) {
				if ($expediente["DEPE_CODI"] == $dep) {
					$tmpExp[$cont] = $expediente;
					$cont++;
				}
			}
		}
	}
	$expedientes = $tmpExp;
	unset($tmpExp); // liberar variable
	include ("./mostrarHtml.php");
?>
