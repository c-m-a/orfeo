<?php
session_start();
$ruta_raiz = "../../";
if($_SESSION['usua_admin_sistema'] !=1 ) die(include "$ruta_raiz/errorAcceso.php");
include("$ruta_raiz/config.php"); 			// incluir configuracion.
include($ADODB_PATH.'/adodb.inc.php');	// $ADODB_PATH configurada en config.php

foreach ($_GET as $key => $valor) ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

$error = 0;
$dsn = $driver."://".$usuario.":".$contrasena."@".$servidor."/".$db;
$conn = NewADOConnection($dsn);

if($conn) {
    $conn->SetFetchMode(ADODB_FETCH_ASSOC);

    switch($_POST['btn_accion']) {
		Case 'Agregar':
        {
            $sqlInsert="insert into sgd_noh_nohabiles (noh_fecha) values(".$conn->DBDate($fecha_sel).")";
            $ok=$conn->Execute($sqlInsert);
            $ok?$error=1:$error=2;
        }break;
		Case 'Borrar':
		{	$tmp_val = implode("','",$noh_fecha);
			$sqlBorra="delete from sgd_noh_nohabiles where noh_fecha in ('$tmp_val')";
            $ok=$conn->Execute($sqlBorra);
            $ok?$error=3:$error=4;
		}break;
	}

    $where = ($_POST['slc_anio']=="") ? "" : " WHERE ".$conn->SQLDate('Y','NOH_FECHA')."=".$_POST['slc_anio'];
    $sql_cont = "SELECT NOH_FECHA as ID,NOH_FECHA as DESCRIP FROM SGD_NOH_NOHABILES $where ORDER BY 1";
    $rs_noh = $conn->Execute($sql_cont); 
    if ($rs_noh)
        $slc_fechas = $rs_noh->GetMenu2('noh_fecha',false,false,true,5,"class='select' multiple size=5 id='noh_fecha'");
    else
    {
        $slc_fechas = "<select><option></option></select>";
        $error = 5;
    }
}
else
{
    $error=6;
    $slc_fechas = "<select><option></option></select>";
}

switch($error)
{
    case 0:$msg="";
        break;
    case 1:$msg="Se agreg&oacute; correctamente el registro";
        break;
    case 2:$msg="No se Insert&oacute; el registro Verifique";
        break;
    case 3:$msg="Se eliminaron los registros seleccionados";
        break;
    case 4:$msg="No se pudo borrar el registro Verifique";
        break;
    case 5:$msg="No se pudo seleccionar fechas";
        break;
    case 6:$msg="No se pudo conectar con la Base de Datos";
        break;
    default:$msg="";break;
}

if(!$fecha_sel) $fecha_sel=date("Y-m-d");
for($i=2007;$i<=2018;$i++)
{   $sel = ($_POST['slc_anio']==$i) ? "selected" : "";
    $filtro .="<option value='$i' $sel>$i</option>";
}
?>
<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body>
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="<?=$ruta_raiz?>js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="<?=$ruta_raiz?>js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript">
    var dateAvailable  = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "fecha_sel","btnDate1","<?=$fecha_sel?>",scBTNMODE_CUSTOMBLUE);
</script>
<table><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr><tr><td></td></tr></table>
<center><table width="550" class='borde_tab'><tr><td class='titulos4' align="center">Administraci&oacute;n de Dias no Habiles</td></tr></table></center>
<form name="new_product"  action='<?=$_SERVER['PHP_SELF']?>' method="post">
<center>
<table width="550" class='borde_tab'>
    <tr>
        <td  class='titulos5'>Seleccionar fecha</td>
        <td  class='titulos5'>
            <script language="javascript">
            dateAvailable.date = "";
            dateAvailable.writeControl();
            dateAvailable.dateFormat="yyyy-MM-dd";
            </script>
         </td>
         <td height="26" colspan="2" valign="top" class='titulos5'>
            <center>
            <input   type="submit" name='btn_accion' id="btn_accion" Value='Agregar' class='botones_mediano'>
            </center>
        </td>
    </tr>
    <tr>
        <td height="26" class='titulos5'>Filtro</td>
        <td height="26" class='titulos5'>
            <select name="slc_anio" id="slc_anio" class="select"  onchange="this.form.submit();">
                <option value="">&lt;&lt Todos los a&ntilde;os &gt;&gt;</option>
                <?echo $filtro;?>
            </select>
        </td>
        <td height="26" class='titulos5'></td>
    </tr>
    <tr border="1">
        <td height="26" class='titulos5'>Fechas registradas</td>
        <td height="26" class='titulos5'>
          <?echo $slc_fechas?>
        </td>
        <td height="26" class='titulos5' align="center">
            <input type="submit" name='btn_accion' id="btn_accion" Value='Borrar' class=botones_mediano>
        </td>
	</tr>
    <tr>
        <td colspan="3" align="center">
        <?echo $msg?>
        </td>
    </tr>
  </table>
  </center>
  </form>
  </body>
  </html>
