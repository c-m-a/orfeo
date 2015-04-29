<?php
session_start();
/**
  * @autor Jairo Losada 2009-05
  * @Fundacion CorreLibre.org
  * @licencia GNU/GPL V 3
  */

$ruta_raiz = "../..";
include_once('../../config.php'); // incluir configuracion.

if(!isset($_SESSION['dependencia']))
  include "$ruta_raiz/rec_session.php";

if ($_SESSION['usua_admin_sistema'] != 1)
  die(include "../../sinacceso.php");

include_once("../../include/db/ConnectionHandler.php");

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

$ADODB_COUNTRECS = false;

$db = new ConnectionHandler("$ruta_raiz");

if ($db) {
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$error = 0;
	include($ruta_raiz.'/include/class/tipoRadicado.class.php');
	if (isset($_POST['btn_accion']))
	{	$record = array();
		if ($_POST['btn_accion'] != 'Eliminar')
		{
			$record['DEPE_NOMB'] = $_POST['txtModelo'];
			$record['DEP_SIGLA'] = $_POST['txtSigla'];
			$tmp = explode('-',$_POST['muni_us1']);
			$record['DEPE_ESTADO'] = $_POST['Slc_destado'];
			$record['ID_CONT']   = $_POST['idcont1'];
			$record['ID_PAIS']	 = $tmp[0];
			$record['DPTO_CODI'] = $tmp[1];
			$record['MUNI_CODI'] = $tmp[2];
			($_POST['Slc_dpadre']>0) ? $record['DEPE_CODI_PADRE'] = $_POST['Slc_dpadre'] : $record['DEPE_CODI_PADRE'] = 'null';
			$record['DEPE_CODI_TERRITORIAL'] = $_POST['Slc_dterr'];
			$record['DEP_DIRECCION'] = $_POST['txtDir'];
			$trObj = new TipRads($db);
			$Vec_Trad = $trObj->GetArrayIdTipRad();
		}
		include($ruta_raiz."/class_control/Dependencia.php");
		$depObj = new Dependencia($db);
		switch ($_POST['btn_accion'])
		{	case 'Agregar':
			{
				//$db->conn->BeginTrans();
				//Agregamos en el vector $record los registros de código y secuencias.
				$record['DEPE_CODI'] = $_POST['txtIdDep'];
				foreach ($Vec_Trad as $tmp)
				{
					$tmp1 = $tmp['ID'];
					if ($_POST['slc_tr'.$tmp1] > 0)
					{
						$record['DEPE_RAD_TP'.$tmp1] = $_POST['slc_tr'.$tmp1];
					}
					else
					{
					 	$record['DEPE_RAD_TP'.$tmp1] = 'null';
				}	}
				$tabla = 'DEPENDENCIA';
				$sql = $db->conn->GetInsertSQL($tabla,$record,true,null);
				//creamos registro en la tabla dependencia
				$ok1 = $db->conn->Execute($sql);
				//Crear estructura en bodega
				//Se llama esta clase UNICAMENTE con el fin de standarizar la obtencion del S.O. en que se ejecuta el servidor.
				include($ruta_raiz.'/radsalida/masiva/OpenDocText.class.php');
				$tmp_obj = new OpenDocText();
                $rut_bodeg=str_replace('/',$tmp_obj->barra,$ruta_raiz).$tmp_obj->barra."bodega".$tmp_obj->barra.date('Y').$tmp_obj->barra.$record['DEPE_CODI'].$tmp_obj->barra."docs";
				!is_dir($rut_bodeg)?$ok2 = mkdir($rut_bodeg,0777,true):$ok2=true;
				// VALIDACION E INSERCION DE DEPENDENCIAS SELECCIONADAS VISIBLES
				$ok3 = true;
				if (is_array($_POST['Slc_dvis']))
				{
					$rs_sec_dep_vis = $db->conn->Execute("SELECT MAX(CODIGO_VISIBILIDAD) AS IDMAX FROM DEPENDENCIA_VISIBILIDAD");
					$id_CodVis = $rs_sec_dep_vis->fields['IDMAX'];
					while((list($key, $val) = each($_POST['Slc_dvis'])) && $ok3 )
					{	$id_CodVis += 1;
						$ok3 = $db->conn->Execute("INSERT INTO DEPENDENCIA_VISIBILIDAD VALUES (".$id_CodVis.",".$record['DEPE_CODI'].",".$val.")");
					}
					unset($id_CodVis);
					$rs_sec_dep_vis->Close();
					unset($rs_sec_dep_vis);
				}
				if ($ok1 && $ok2 && $ok3)
				{
					//$db->conn->CommitTrans();
					$error = 6;
				}
				else
				{
					($ok1) ? (($ok2) ? $error=4 : $error=5) : $error=3;
					//$db->conn->RollbackTrans();
				}
			}break;
			case 'Modificar':
			{	/* Las reglas del negocio para la inactivacion de una dependencia son:
				   a. No debe tener usuarios Activos.
				   b. No hayan radicados.
				   Las reglas para cambiar la dependencia como origen de algún consecutivo es:
				   c. La dependencia seleccionada deberá tener su consecutivo del respectivo
				      Tipo de Radicado mayor o igual a la que tenia previamente.
				*/
				//traemos los datos ORIGINALES de la dependencia seleccionada
				//con el fin de comparar los cambios que necesiten validarse.
				$record_ori = $depObj->dependenciaArr($_POST['id']);
				//completamos el vector de datos recibidos
				$record['DEPE_CODI'] = $_POST['txtIdDep'];
				if ($_POST['Slc_destado'] == 0 && $record_ori['depe_estado'] == 1)
				{
					//Iniciamos validaciones...
					$ADODB_COUNTRECS = true;
					$sql = "SELECT usua_codi from USUARIO where depe_codi=".$_POST['id']." AND usua_esta=1";
					$rs_tmp = $db->conn->Execute($sql);
					$oka = false; $okb = false;
					if ($rs_tmp->RecordCount() == 0)
					{	$oka = true;
						$sql = "SELECT radi_nume_radi from RADICADO where RADI_DEPE_ACTU=".$_POST['id'];
						$rs_tmp = $db->conn->Execute($sql);
						if ($rs_tmp->RecordCount() == 0)
						{	$okb = true;
				}	}	}
				else
				{
					$oka = true; $okb = true;
				}
				$ADODB_COUNTRECS=false;
				//Validacion c.
				$okc = true;
				reset($Vec_Trad);
				while ((list(, $tmp) = each ($Vec_Trad)) && $okc)
				{
                    $vlr_nxt=0;
                    $vlr_act=0;
					$tmp1 = $tmp['ID'];
					//if ($record['DEPE_RAD_TP'.$tmp1] != $record_ori['depe_rad_tp'.$tmp1])
					if ($_POST['slc_tr'.$tmp1])
					{
						// Validaciones propias cuando se ha modificado la dependencia
						// para la secuencia de un tipo de radicado.

switch($db->driver)
{     
	case 'oci8':
		$ADODB_COUNTRECS = true;
		$sql_nxt="select * from all_sequences  where sequence_name = '".'SECR_TP'.$tmp1.'_'.$_POST['slc_tr'.$tmp1]."'";
		$sql_act="select * from all_sequences  where sequence_name = '".'SECR_TP'.$tmp1.'_'.$depObj->getSecRadicTipDepe($_POST['txtIdDep'],$tmp1)."'";
		$rs_nxt = $db->conn->Execute($sql_nxt);
		$rs_act = $db->conn->Execute($sql_act);
		$ADODB_COUNTRECS = false;
		if($rs_nxt->RecordCount()>0)$vlr_nxt=$rs_nxt->fields['LAST_NUMBER']+1;
		if($rs_act->RecordCount()>0)$vlr_act=$rs_act->fields['LAST_NUMBER']+1;
		$sql_rtp="select * from radicado where ".$db->conn->substr.'(cast(radi_nume_radi as varchar(15)),-1)='.$tmp1." and radi_depe_radi=".$_POST['txtIdDep'];
		break;
	case 'mssql':
	break;
	
}
$ADODB_COUNTRECS=true;
	$rs_rtp =$db->conn->Execute($sql_rtp);
	$ADODB_COUNTRECS=false;
	if($rs_rtp->RecordCount()==0)$vlr_nxt=$vlr_act;

	if ($vlr_nxt < $vlr_act)
	{
		$okc = false;
									$tpr=$tmp1;
	}
						else
						{
							$record['DEPE_RAD_TP'.$tmp1] = $_POST['slc_tr'.$tmp1];
				}	}	}
				//Finalizamos validaciones para modificación
				if ($oka && $okb && $okc)
				{
					//Generamos la sentencia para actualización de campos.
					$tabla = 'DEPENDENCIA';
					//Modificamos registro en la tabla dependencia
					$ok1 = $db->conn->Replace($tabla,$record,'DEPE_CODI',true);
                    $ok1?$error=10:$error=2;
					//Validacion en cambio de visibilidad de dependencias
					$ok3 = true;
					$db->conn->Execute("DELETE FROM DEPENDENCIA_VISIBILIDAD WHERE DEPENDENCIA_VISIBLE=".$record['DEPE_CODI']);
					if (is_array($_POST['Slc_dvis']))
					{
						$rs_sec_dep_vis = $db->conn->Execute("SELECT MAX(CODIGO_VISIBILIDAD) AS IDMAX FROM DEPENDENCIA_VISIBILIDAD");
						$id_CodVis = $rs_sec_dep_vis->Fields('IDMAX');
						while((list($key, $val) = each($_POST['Slc_dvis'])) && $ok3 )
						{	$id_CodVis += 1;
							$ok3 = $db->conn->Execute("INSERT INTO DEPENDENCIA_VISIBILIDAD VALUES ($id_CodVis,$record[DEPE_CODI],$val)");
						}
						unset($id_CodVis);
						$rs_sec_dep_vis->Close();
						unset($rs_sec_dep_vis);
					}
				}
				else
				{	if (!$oka) $error=7;
					else if(!$okb) $error=8;
					else if(!$okc) $error=9;
				}
			}
			break;
			case 'Eliminar':
			{	/*
				a. No debe tener histórico la actual dependencia(Consecuencia del punto b).
				*/
				$sql = "SELECT DEPE_CODI from HIST_EVENTOS where DEPE_CODI=".$_POST['id'];
				$ADODB_COUNTRECS=true;
				$rs_tmp = $db->conn->Execute($sql);
				$ADODB_COUNTRECS=false;
				if ($rs_tmp->RecordCount() == 0)
				{	$ok = $db->conn->Execute('DELETE FROM DEPENDENCIA WHERE DEPE_CODI='.$_POST['id']);
				}
				if (!$ok) $error=11;
			}
			break;
	}	}

	include "$ruta_raiz/radicacion/crea_combos_universales.php";
	// Buscamos los datos generales de las despencias

	$sql1 = "SELECT cast(DEPE_CODI as char(3))".$db->conn->concat_operator."' '".$db->conn->concat_operator."DEPE_NOMB as ver, ";
	$sql1 .="DEPE_CODI as ID, DEPE_NOMB as NOMBRE, DEPE_ESTADO as ESTADO, ID_CONT, ID_PAIS, ";
	$sql1 .="cast(ID_PAIS as char(3))".$db->conn->concat_operator."'-'".$db->conn->concat_operator."cast(DPTO_CODI as char(3)), ";
	$sql1 .="cast(ID_PAIS as char(3))".$db->conn->concat_operator."'-'".$db->conn->concat_operator."cast(DPTO_CODI as char(3))".$db->conn->concat_operator."'-'".$db->conn->concat_operator."cast(MUNI_CODI as char(3)), ";
	$sql1 .="DEPE_CODI_PADRE, DEPE_CODI_TERRITORIAL, DEP_SIGLA as SIGLA, DEP_CENTRAL, DEP_DIRECCION, DEPE_NUM_INTERNA, DEPE_NUM_RESOLUCION ";
	$sql1 .="FROM DEPENDENCIA ";
	$sql3 = "ORDER BY DEPE_NOMB";
//echo $sql1.$sql3;

	$rs = $db->conn->Execute($sql1.$sql3);	//utilizamos este recorset para los combos de las dependencias y para traer los datos generales de todas las dependencias.
  	if ($rs)
	{
		$id = '';
		$muni_us1 = "0";
		//Buscamos los datos de una dependencia específica para generar los datos mostrados.
		if ($_POST['id']>0)
		{	$sql0 = "SELECT * FROM DEPENDENCIA ";
			$sql2 = "WHERE DEPE_CODI = ".$_POST['id'];
			$v_def = $db->conn->GetAll($sql0.$sql2.$sql3);
			$txtIdDep =	$v_def[0]['DEPE_CODI'];
			$txtSigla =	$v_def[0]['DEP_SIGLA'];
			if ($v_def[0]['DEPE_ESTADO']==0)
			{$off='selected'; $on='';}
			else
			{$off=''; $on='selected';}
			$muni_us1 =	$v_def[0]['ID_CONT'].'-'.$v_def[0]['ID_PAIS'].'-'.$v_def[0]['DPTO_CODI'].'-'.$v_def[0]['MUNI_CODI'];

			$txtModelo=	$v_def[0]['DEPE_NOMB'];
			$txtDir =	$v_def[0]['DEP_DIRECCION'];
			$Slc_dpadre=$v_def[0]['DEPE_CODI_PADRE'];
			$Slc_dterr=	$v_def[0]['DEPE_CODI_TERRITORIAL'];
			// CREAMOS LA VARIABLE $Slc_dvis QUE CONTINE LAS DEPENDENCIAS QUE PUEDEN VER LA DEPENDENCIA SELECCIONADA.
			$rs_depvis = $db->conn->Execute("SELECT DEPENDENCIA_OBSERVA FROM DEPENDENCIA_VISIBILIDAD WHERE DEPENDENCIA_VISIBLE=".$_POST['id']);
			$Slc_dvis = array();
			$i = 0;
			while ($tmp = $rs_depvis->FetchRow())
			{	$Slc_dvis[$i] = $tmp['DEPENDENCIA_OBSERVA'];
				$i += 1;
			}
		}
		
		$varRad = new TipRads($db);
		$Vec_Trad = $varRad->GetArrayIdTipRad();
		$nm = 'slc_tr';
		foreach ($Vec_Trad as $val)
		{
			//Acá creamos las variables default de la segunda pestaña
			${$nm.$val['ID']} = $v_def[0]['DEPE_RAD_TP'.$val['ID']];
			/////////////////////////////////////////////////////////
			$pes2 .= '<tr class=timparr><td width="25%" align="left" class="titulos2">tipo de radicado(<b>'.$val['ID'].'</b>)</td><td>'.$rs->GetMenu2($nm.$val['ID'],${$nm.$val['ID']},':&lt;&lt seleccione &gt;&gt;',false,false,'Class="select" id="'.$nm.$val['ID'].'"').'</td></tr>';
			$js_pes2 .= "document.getElementById('".$nm.$val['ID']."').value = '';\n";
			$rs = $db->conn->Execute($sql1.$sql3);
		}
		
	 $slc_dep1 = $rs->GetMenu2('id',$txtIdDep,':&lt;&lt seleccione &gt;&gt;',false,false,'Class="select" Onchange="ver_datos(this.value)" id="slc_id"');
	 $rs = $db->conn->Execute($sql1.$sql3);
	 $slc_dep2 = $rs->GetMenu2('Slc_dpadre',$Slc_dpadre,':&lt;&lt seleccione &gt;&gt;',false,false,'Class="select" id="Slc_dpadre"');
	 $rs = $db->conn->Execute($sql1.$sql3);
	 $slc_dep3 = $rs->GetMenu2('Slc_dterr',$Slc_dterr,':&lt;&lt seleccione &gt;&gt;',false,false,'Class="select" id="Slc_dterr"');
	 $rs = $db->conn->Execute($sql1.$sql3);
	 $slc_dep4 = $rs->GetMenu2('Slc_dvis[]',$Slc_dvis,false,true,10,'Class="select" id="Slc_dvis"');
	 $rs = $db->conn->Execute($sql1.$sql3);
  	 $slc_cont = $Rs_Cont->GetMenu2('idcont1',0,"",false,0,"id=\"idcont1\" class=\"select\" onchange=\"borra_datos(this.form);cambia(this.form,'idpais1','idcont1')\"");
	}
	else
	{
		$error = 2;
	}
}

	// Implementado por si desean mostrar errores o mensajes personalizados.
	$error_msg = '<table width="100%" border="1" align="center" class="t_bordeGris"><tr bordercolor="#FFFFFF"><td align="center" class="titulosError" bgcolor="#FFFFFF">';
	switch ($error)
	{
        case 1: // No conexion a BD
			$error_msg .= "No hay conexi&oacute;n a la B.D.";
			break;
		case 2:
            $error_msg .= "!!Error al modificar!!";
			break;
		case 3: // Error al insertar dependencia
			break;
		case 4: // Error al insertar dependencias visibles.
			$error_msg .= "Error al crear visibilidad de dependencias.";
			break;
		case 5: // No hay acceso a la creacion en bodega
			$error_msg .= "Error al crear ruta en la bodega.";
			break;
		case 6: // Exito en la creacion de la dependencia
			$error_msg .= "<blink>Dependencia creada !!!!</bink>";
			break;
		case 7: // Error en la modificacion de la dependencia
			$error_msg .= "Esta dependencia tiene usuarios activos";
            break;
		case 8: // Error en la modificacion de la dependencia
			$error_msg .= "Esta dependencia tiene (o ha tenido) radicados asignados";
			break;
		case 9: // Error en la modificacion de la dependencia
			$error_msg .= "El consecutivo para el tipo de radicado $tpr de la nueva dependencia (".$_POST['slc_tr'.$tmp1].") es menor que el actual (".$depObj->getSecRadicTipDepe($_POST['txtIdDep'],$tmp1).").";
            break;
        case 10:
            $error_msg .= "!!Dependencia modificada con exito!!";
			break;
        case 11: // Error en la modificacion de la dependencia
			$error_msg .= "No se pudo eliminar dependencia";
			break;
		default: $error_msg .= "&nbsp;"; break;
	}
	$error_msg .= '</td></tr></table>';

?>
<html>
<head>
<title>Orfeo- Admon de Dependencias.</title>
<link href="<?php echo $ruta_raiz ?>/estilos/orfeo.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $ruta_raiz ?>/estilos/tabber.css" TYPE="text/css" MEDIA="screen">
<script language="JavaScript" src="<?php echo $ruta_raiz ?>/js/formchek.js"></script>
<script language="JavaScript" src="<?php echo $ruta_raiz ?>/js/crea_combos_2.js"></script>
<script language="JavaScript">
document.write('<style type="text/css">.tabber{display:none;}<\/style>');
var tabberOptions =
{
	/* Optional: instead of letting tabber run during the onload event,
	we'll start it up manually. This can be useful because the onload
	even runs after all the images have finished loading, and we can
	run tabber at the bottom of our page to start it up faster. See the
	bottom of this page for more info. Note: this variable must be set
	BEFORE you include tabber.js.
	*/
	'manualStartup':true,
	/* Optional: code to run after each tabber object has initialized */
	'onLoad': function(argsObj)
	{
		/* Display an alert only after tab2 */
		if (argsObj.tabber.id == 'tab1')
		{	crea_var_idlugar_defa('<?=$muni_us1 ?>');  }
	},
	/* Optional: set an ID for each tab navigation link */
	'addLinkId': true
};
</script>
<script type="text/javascript" src="<?php echo $ruta_raiz ?>/js/tabber.js"></script>
<script language="Javascript">
function ver_datos(x)
{	var pos=false;
	if (x == '')
	{
		document.getElementById('txtIdDep').value = '';
		document.getElementById('txtSigla').value = '';
		document.getElementById('Slc_destado').value = '';
		document.getElementById('txtModelo').value = '';
		document.getElementById('txtDir').value = '';
		document.getElementById('Slc_dpadre').value = '';
		document.getElementById('Slc_dterr').value = '';
		document.getElementById('idcont1').value = 1;
		document.getElementById('idpais').value = 1;
		act_pes2('');
		borra_datos(document.formSeleccion);
	}
	else
	{	
		document.formSeleccion.submit();
	}
}

function act_pes2(vlr)
{
<?php
	echo $js_pes2;
?>
}

function rightTrim(sString)
{	while (sString.substring(sString.length-1, sString.length) == ' ')
	{	sString = sString.substring(0,sString.length-1);  }
	return sString;
}

function addOpt(oCntrl, iPos, sTxt, sVal)
{	var selOpcion=new Option(sTxt, sVal);
	eval(oCntrl.options[iPos]=selOpcion);
}

function borra_datos(form1)
{
	borra_combo(form1, 7);
	borra_combo(form1, 8);
	borra_combo(form1, 9);
}

/*
*	Funcion que se le envia el id del municipio en el formato general c-ppp-ddd-mmm y lo desgloza
*	creando las variables en javascript para su uso individual, p.e. para los combos respectivos.
*/
function crea_var_idlugar_defa(id_mcpio)
{	if (id_mcpio == 0) return;
	var str = id_mcpio.split('-');

	document.formSeleccion.idcont1.value = str[0]*1;
	cambia(formSeleccion,'idpais1','idcont1');
	document.formSeleccion.idpais1.value = str[1]*1;
	cambia(formSeleccion,'codep_us1','idpais1');
	document.formSeleccion.codep_us1.value = str[1]*1+'-'+str[2]*1;
	cambia(formSeleccion,'muni_us1','codep_us1');
	document.formSeleccion.muni_us1.value = str[1]*1+'-'+str[2]*1+'-'+str[3]*1;
}

<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($vpaisesv, 'vp');
echo arrayToJsArray($vdptosv, 'vd');
echo arrayToJsArray($vmcposv, 'vm');
?>

function ValidarInformacion(accion)
{	if (!(isPositiveInteger(document.formSeleccion.txtIdDep.value,false)))
	{
		alert('Seleccione o digite el codigo de la dependencia');
		document.formSeleccion.txtIdDep.focus();
		return false;
	}
	if ((accion == 'Agregar') || (accion =='Modificar'))
	{	if(accion =='Modificar')
		{	if (document.formSeleccion.id.value != document.formSeleccion.txtIdDep.value)
			{
				alert('No se puede modificar el codigo de la dependencia.\nMejor inserte una nueva.');
				return false;
		}	}
		if (stripWhitespace(document.formSeleccion.txtModelo.value) == '')
		{
			alert('Digite el nombre de la dependencia');
			document.formSeleccion.txtModelo.focus();
			return false;
		}
		if (!(isPositiveInteger(document.formSeleccion.Slc_dterr.value,false)))
		{
			alert('Seleccione la dependencia Territorial');
			document.formSeleccion.Slc_dterr.focus();
			return false;
		}
		if (!(isNonnegativeInteger(document.formSeleccion.Slc_destado.value,false)))
		{
			alert('Seleccione estado de la dependencia');
			document.formSeleccion.Slc_destado.focus();
			return false;
		}
	}
    if (accion =='Agregar')
    {   for (n=1;n<document.formSeleccion.id.length;n++ )
		if (document.formSeleccion.id.options[n].value == document.formSeleccion.txtIdDep.value) {
			alert('!Ya existe una dependencia con este codigo!');
            return false;
		}
    }
	if (accion =='Eliminar')
	{
		a = window.confirm('Est\xe1 seguro de eliminar el registro ?');
		if (a==true)
		{}
		else
		{
			return false;
}	}	}

function ver_listado()
{
	window.open('listados.php?var=dpc','','scrollbars=yes,menubar=no,height=600,width=800,resizable=yes,toolbar=no,location=no,status=no');
}
</script>
</head>
<body>
<form name="formSeleccion" id="formSeleccion" method="post" action="<?= $_SERVER['PHP_SELF']?>">
<table width="100%" border="1" align="center" class="t_bordeGris">
<tr bordercolor="#FFFFFF">
	<td width="100%" colspan="2" height="40" align="center" class="titulos4"><b>ADMINISTRADOR DE DEPENDENCIAS</b></td>
</tr>
<tr class=timparr>
	<td width="25%" align="left" class="titulos2"><b>&nbsp;Seleccione Dependencia</b></td>
	<td width="75%" colspan="5" class="listado2">
	<?php
		echo $slc_dep1;
	?>
	</td>
</tr>
</table>
<div class="tabber" id="tab1">
	<div class="tabbertab" title="B&aacute;sicos">
	<table width="100%" border="1" align="center" class="t_bordeGris">
	<tr class=timparr>
		<td width="25%" align="left" class="titulos2"><b>&nbsp;Ingrese c&oacute;digo.</b></td>
		<td class="listado2"><input name="txtIdDep" id="txtIdDep" type="text" size="3" maxlength="3" value="<?=$txtIdDep ?>"></td>
		<td class="titulos2"><b>&nbsp;Ingrese Sigla</b></td>
		<td class="listado2"><input name="txtSigla" id="txtSigla" type="text" size="10" maxlength="15" value="<?=$txtSigla ?>"></td>
		<td class="titulos2"><b>&nbsp;Seleccione Estado</b></td>
		<td class="listado2">
			<select name="Slc_destado" id="Slc_destado" class="select">
				<option value="" selected>&lt; seleccione &gt;</option>
				<option value="0" <?=$off ?>>Inactiva</option>
				<option value="1" <?=$on ?>>Activa</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="left" class="titulos2"><b>&nbsp;Ingrese nombre.</b></td>
		<td colspan="5" class="listado2"><input name="txtModelo" id="txtModelo" type="text" size="50" maxlength="70" value="<?=$txtModelo ?>"></td>
	</tr>
	<tr>
		<td align="left" class="titulos2"><b>&nbsp;Ingrese direcci&oacute;n.</b></td>
		<td colspan="5" class="listado2"><input name="txtDir" id="txtDir" type="text" size="50" maxlength="70" value="<?=$txtDir ?>"></td>
	</tr>
	<tr>
	<td align="left" class="titulos2"><b>&nbsp;Seleccione ubicaci&oacute;n ?</b></td>
	<td colspan="5" class="listado2">
	<?	// Listamos los continentes.
   		echo $slc_cont;
    ?>
	<select name="idpais1" id="idpais1" class="select" onChange="cambia(this.form, 'codep_us1', 'idpais1')">
	<option value="0" selected>&lt;&lt; Seleccione Continente &gt;&gt;</option>
	</select>

	<select name='codep_us1' id ="codep_us1" class='select' onChange="cambia(this.form, 'muni_us1', 'codep_us1')" ><option value='0' selected>&lt;&lt; Seleccione Pa&iacute;s &gt;&gt;</option></select>

	<select name='muni_us1' id="muni_us1" class='select'><option value='0' selected>&lt;&lt; Seleccione Dpto &gt;&gt;</option></select>
		</td>
	</tr>
	<tr>
		<td align="left" class="titulos2"><b>&nbsp;Seleccione Dependencia PADRE</b></td>
		<td colspan="5" class="listado2">
		<?php
			echo $slc_dep2;
		?>
		</td>
	</tr>
	<tr>
		<td align="left" class="titulos2"><b>&nbsp;Seleccione Dependencia TERRITORIAL</b></td>
		<td colspan="5" class="listado2">
		<?php
			echo $slc_dep3;
		?>
		</td>
	</tr>
	<tr>
		<td align="left" class="titulos2"><b>&nbsp;Seleccione las Dependencias a las que ser&aacute; VISIBLE.</b><br />Presione (CTRL + click) para seleccionar varios</td>
		<td colspan="5" class="listado2">
		<?php
			echo $slc_dep4;
		?>
		</td>
	</tr>
	</table>
	</div>
	<div class="tabbertab" title="Consecutivos">
	<table width="100%" border="1" align="center" class="t_bordeGris">
	<?php
		echo $pes2;
	?>
	</table>
	</div>
</div>
<?php
echo $error_msg;
?>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="listado2">
<tr>
	<td width="10%">&nbsp;</td>
    <td width="20%" align="center"><input name="btn_accion" type="button" class="botones" id="btn_accion" value="Listado" onClick="ver_listado();" accesskey="L" alt="Alt + L"></td>
	<td width="20%" align="center"><input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Agregar" onClick="return ValidarInformacion(this.value);" accesskey="A"></td>
	<td width="20%" align="center"><input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Modificar" onClick="return ValidarInformacion(this.value);" accesskey="M"></td>
	<td width="20%" align="center"><input name="btn_accion" type="submit" class="botones" id="btn_accion" value="Eliminar" onClick="document.form1.hdBandera.value='E'; return ValidarInformacion();" accesskey="E"></td>
	<td width="10%">&nbsp;</td>
</tr>
</table>
<script type="text/javascript">
/* Since we specified manualStartup=true, tabber will not run after
   the onload event. Instead let's run it now, to prevent any delay
   while images load.
*/
tabberAutomatic(tabberOptions);
</script>
</form>
</body>
</html>
