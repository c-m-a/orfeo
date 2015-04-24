<?php
	$pearLib = "./pear/";
	$ruta_raiz = ".";
	require_once($pearLib . "HTML/Template/IT.php");
	$tpl = new HTML_Template_IT($ruta_raiz . "/tpl");
	$municipio = array();
	if (isset($departamento)) unset($departamento);
	if (isset($municipio)) unset($municipio);
	$departamentos = array();
	$municipios = array();
	$muniSelect["muni_codi"] = "N";
	$muniSelect["muni_nomb"] = "Seleccione Municipio";
	$arregloJs = "";
	$fileTarget = "asignarDireccion.php";
	$sessId = "";
	$usuario = "";
	$radicado = "";
	$direccion = "";
	if (isset($HTTP_GET_VARS["anexo"]) || isset($HTTP_GET_VARS["anexo"])) {
		if (isset($HTTP_GET_VARS["anexo"])){
			$anexoCodigo = $HTTP_GET_VARS["anexo"];
		} else {
			if (isset($HTTP_POST_VARS["anexo"])) {
				$anexoCodigo = $HTTP_POST_VARS["anexo"];
			} else {
				if (isset($anexCodi)) {
					$anexoCodigo = $anexCodi;
				} else {
					$anexoCodigo = null;
				}
			}
		}
	}
	
	$flagDatos = false;
	$cont = 0;
	
	$krdOld = $krd;
	session_start();
	
	if(!isset($_SESSION['dependencia']) && !isset($_SESSION['cod_local']))
		include "../rec_session.php";
	
	$ruta_raiz = ".";
	define('ADODB_ASSOC_CASE', 0);
	include_once ($ruta_raiz . "/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	
	$sql = "SELECT sgd_dir_direccion as direccion, muni_codi, dpto_codi 
			FROM anexos WHERE anex_codigo = '$anexoCodigo'";
	$res = $db->conn->Execute($sql);
	
	if(!$res->EOF) {
		$flagDatos = true;
		$direccion = $res->fields["DIRECCION"];
		$departamento["depto_codi"] = $res->fields["DPTO_CODI"];
		$municipio["codigo"] = $res->fields["MUNI_CODI"];
	}
	
	// Capturando municipios del departamento para construir select 
	// si tiene un departamento asignado
	if (!empty($departamento["depto_codi"])) {
		$municipio = (empty($municipio["codigo"])) ?
				null : $municipio["codigo"];
		$sqlMuni = "SELECT muni_nomb, muni_codi 
				FROM municipio 
				WHERE dpto_codi = '".
				$departamento["depto_codi"] ."'";
		$res = $db->conn->Execute($sqlMuni);
		$selectMuni = $res->GetMenu2('municipio[codigo]',	
					$municipio,
					false,
					false,
					0,
					"id=\"municipio\" class=\"select\"");
	} else {
		$selectMuni = "<select id=\"municipio\" name=\"municipio[codigo]\"  class=\"select\">\n
			<option value=\"1\" > Seleccione Municipio </option>\n
		</select>";
	}
	
	$sql = "SELECT dpto_nomb, dpto_codi FROM departamento ORDER BY dpto_nomb";
	$res = $db->conn->Execute($sql);
	
	// Si no tiene asignado ningun departamento entonces muestra 
	// en el select la palabra todos
	$departamento = (empty($departamento["depto_codi"])) ? 
				1 : $departamento["depto_codi"];
	
	$selectDepto = $res->GetMenu2('departamento[depto_codi]',
					$departamento, 
					false, 
					false, 
					0, 
					"onChange=\"javascript:cambiar_seccion(this);\" class=\"select\"");
	
	$sql = "SELECT dpto_codi, muni_codi, muni_nomb FROM municipio ORDER BY dpto_codi";
	$res = $db->conn->query($sql);
	
	while (!$res->EOF) {
		$municipios[$cont]["codigoDepto"] = $res->fields["DPTO_CODI"];
		$municipios[$cont]["codigoMun"] = $res->fields["MUNI_CODI"];
		$municipios[$cont]["nombre"] = $res->fields["MUNI_NOMB"];
		$cont++;
		$res->MoveNext();
	}
	
	$mostrarComa = "";
	$cont = 0;
	$coma = ",";
	foreach ($municipios as $municipio) {
		if ($cont != 0) $mostrarComa = $coma . "\n";
		if ($cont > 0) $mostrarComa .= "\t\t\t\t\t";
		$arregloJs .= $mostrarComa . "new seccionE (\"" . $municipio["codigoMun"] . 
				"\",\"" . $municipio["nombre"] . 
				"\",\"" . $municipio["codigoDepto"] . "\")";
		$cont++;
	}
	$mostrarBorrar = "<tr>\n
			    <td class=\"titulos2\">BORRAR:</td>\n
			    <td width=\"323\"><input type=\"checkbox\" name=\"borrarDireccion\" value=\"borrar\"></td>\n
			  </tr>";
	
	$tpl->loadTemplatefile("formAsignarDirecion.tpl");
	$tpl->setVariable("ARREGLOJS",$arregloJs);
	$tpl->setVariable("DIRECCION",$direccion);
	$tpl->setVariable("RUTA_RAIZ",$ruta_raiz);
	$tpl->setVariable("FILE_TARGET","/" . $fileTarget);
	$tpl->setVariable("SESS_NAME",session_name());
	$tpl->setVariable("SESS_ID",session_id());
	$tpl->setVariable("USUARIO",$krd);
	$tpl->setVariable("RADICADO",$radicado);
	$tpl->setVariable("ANEX_CODIGO", $anexoCodigo);
	$tpl->setVariable("DPTO_SELECT",$selectDepto);
	$tpl->setVariable("MUNI_SELECT",$selectMuni);
	$tpl->setVariable("RUTA_RAIZ",$ruta_raiz);
	$tpl->setVariable("ACCION",($departamento != 1) ? 'Modificar' : 'Insertar');
	$tpl->setVariable("BORRAR",($departamento != 1) ? $mostrarBorrar :  '');
	$tpl->setVariable("ACCION_BORRAR",($departamento !=1) ? 'borrar' :  '');
	$tpl->show();
?>
