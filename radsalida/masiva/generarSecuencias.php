<?php
  /**
   * Metodo alternativo para radicacion masiva
   * @author      Johnny Gonzalez
   * @version     1.0
   */
  session_start();
  $ruta_raiz = '../../';
  //include( "$ruta_raiz/debugger.php" );
  require_once("$ruta_raiz/include/db/ConnectionHandler.php");
  
  //Si no llega la dependencia recupera la sesion
  if (!isset($_SESSION['dependencia']))
    include "$ruta_raiz/rec_session.php";
  
  $krd = (isset($_SESSION['krd']))? $_SESSION['krd'] : null;
  
  if (!$db)	$db = new ConnectionHandler($ruta_raiz);

  $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
  $phpsession = session_name().'='.session_id();
  $cantidadRegistros = (isset($_POST['cantidadRegistros']))? $_POST['cantidadRegistros'] : null;
  $tipoRad = (isset($_POST['tipoRad']))? $_POST['tipoRad'] : null;
  $dependencia = (isset($_SESSION['dependencia']))? $_SESSION['dependencia'] : null;
?>
<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<script language="JavaScript">
<!--
  function advertencia( cantidadRegistros, form ) {
    var confirmaSecuencias = confirm( 'Seguro que desea generar ' + cantidadRegistros + ' secuencias para radicacion masiva?\nEl proceso no se puede revertir y seria necesario realizar la anulacion manual de todos los radicados generados.' );
    if(confirmaSecuencias) {
<?php
		$arreglo = array();
		if ($tipoRad && ($cantidadRegistros != '' || $cantidadRegistros != null)) {
			require_once($ruta_raiz."/class_control/Dependencia.php");
			$objDependecia = new Dependencia($db);
			$objDependecia->Dependencia_codigo($dependencia);
			$cursor = &$db;
			$cuenta = 0;
      
			while ( $cuenta < $cantidadRegistros ) {
				$secRadicacion = "secr_tp".$tipoRad."_".$objDependecia->getSecRadicTipDepe($dependencia,$tipoRad);
	 			$sec = $cursor->nextId($secRadicacion);
			 	$sec = str_pad($sec,6,"0",STR_PAD_LEFT);

				$arreglo[] = date("Y").$dependencia.$sec.substr($secRadicacion,7,1);
				$cuenta++;
			}
?>
			alert( 'Se generaron las ' + cantidadRegistros + ' secuencias entre el <?=$arreglo[0] ?> y el <?=$arreglo[$cuenta - 1 ] ?>, a continuacion apareceran en una ventana aparte,\npara que las copie a una hoja de calculo.');
			ventana = window.open(' ','secuenciasMasiva','menubar=no,scrollbars=yes,width=300,height=500');
			ventana.opener = self;
<?php
			$cadena = "<html><head><title>Secuencias para Radicaci&oacute;n Masiva</title></head><body><center>";
			
      foreach ($arreglo as $numeroRadicado)
        $cadena .= "<br />" . $numeroRadicado;
      
			$cadena .= "</center></body></html>";
?>
      ventana.document.write("<?=$cadena?>");
			ventana.document.close();
<?php
			$confirmado = true;
			require_once $ruta_raiz."/class_control/class_controlExcel.php";
      $controlSec = new CONTROL_ORFEO($db);
      $intervaloSecuencia = ($arreglo[1] != null || $arreglo[1] != '')? $arreglo[1] - $arreglo[0] : 0;
      $resultadoInsertaSec = $controlSec->insertaSecuencias($arreglo[0],
                                                            $arreglo[$cuenta-1],
                                                            $intervaloSecuencia,
                                                            $dependencia,
                                                            $codusuario,
                                                            $tipoRad);
      if(!$resultadoInsertaSec) {
?>
      alert('Se produjo un error insertando los datos de las secuencias.');
      return false;
<?php
      }
		}	else {
?>
			alert('Debe seleccionar el tipo de radicacion.');
			return false;
<?php
		}
?>
	}	else {
		return false;
	}
}

function valida(form) {
	var cantidad = document.frmGeneraSecuenciasMasiva.cantidadRegistros.value;
	var band = false;
	if((cantidad == "") ||(document.frmGeneraSecuenciasMasiva.tipoRad.value == 0)) {
		alert( 'Debe gestionar todos los datos!' );
		band = false;
	}	else {
		band = advertencia( cantidad, form );
	}
	return band;
}

function ejecuta(){
	alert('ejecuta');
}

function f_close(){
	window.close();
}

function Start(URL, WIDTH, HEIGHT) {
  windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=";
  windowprops += WIDTH + ",height=" + HEIGHT;
  preview = window.open(URL , "preview", windowprops);
}
//-->
</script>
</head>
<body bgcolor="#FFFFFF" topmargin="0">
<form name="frmGeneraSecuenciasMasiva" action='generarSecuencias.php?<?=$phpsession ?>&krd=<?=$krd?>&<?="fechah=$fechah"?>' method="POST">
<table width="75%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr>
	<td height="25" class="titulos4" colspan="2">RADICACI&Oacute;N MASIVA DE DOCUMENTOS   (Generaci&oacute;n de Secuencias)</td>
</tr>
<tr align="center" >
	<td class="listado2" colspan="2">
		La radicaci&oacute;n requiere la generaci&oacute;n de las secuencias para los radicados, si desea generarlas,
		<br>ingrese la cantidad de registros a procesar y haga click en Generar, de lo contario en Cerrar.
	</td>
</tr>
<tr align="center">
	<td class="listado2" >
		Cantidad de Registros
		</a>
	</td>
	<td class="listado2" >
		<input type="text" name="cantidadRegistros" value="<?=$cantidadRegistros?>" size="5" maxlength="4">
	</td>
</tr>
<tr align="center">
	<td class="listado2" colspan="2" >
	<table width="31%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
	<tr align="center">
		<td height="25" colspan="2" class="titulos4">TIPO DE RADICACI&oacute;N</td>
	</tr>
	<tr align="center">
		<td width="16%" class="titulos2">Seleccione: </td>
		<td width="84%" height="30" class="listado2">
<?php
    $cad = "USUA_PRAD_TP";
    // Creacion del combo de Tipos de radicado habilitados seg�n permisos
    //Buscamos los TRAD En la entidad
    $sql = "SELECT SGD_TRAD_CODIGO,
                   SGD_TRAD_DESCR
              FROM SGD_TRAD_TIPORAD
              WHERE SGD_TRAD_GENRADSAL > 0";
    $Vec_Trad = $db->conn->GetAssoc($sql);
    $Vec_Perm = array();
    
    while (list($id, $val) = each($Vec_Trad)) {
      $sql = "SELECT ".$cad.$id." FROM USUARIO WHERE USUA_LOGIN='".$krd."'";
      $rs2 = $db->conn->Execute($sql);
      
      if ($rs2->fields[$cad.$id] > 0) 
        $Vec_Perm[$id] = $val;
    }
    
    reset($Vec_Perm);
?>
			<select name="tipoRad" id="Slc_Trd" class="select" onchange="this.form.submit();">
			<option value="0">Seleccione una opci&oacute;n</option>
<?php
    while (list($id, $val) = each($Vec_Perm)) {
      $datoss = ($tipoRad == $id)? ' selected ' : '';
      echo " <option value=".$id." $datoss>$val</option>\n";
    }
?>
			</select>
		</td>
	</tr>
</table>
	</td>
</tr>
<tr align="center">
	<td class="listado2" colspan="2" >
		<center>
			<input type="button" name="Submit" value="Generar" class="botones" onclick="valida(this.form);">
		</center>
	</td>
</tr>
<tr align="center">
	<td class="listado2" colspan="2" >
		<center>
			<input class="botones" type="button" name="Cerrar" id="Cerrar" Value="Cerrar" onclick='f_close()'>
		</center>
	</td>
</tr>
</table>
</form>
</body>
</html>
