<?
session_start();
/**
  * Modulo de Formularios Web para atencion a Ciudadanos.
  * @autor Carlos Barrero   carlosabc81@gmail.com SuperSolidaria
  * @fecha 2009/05
  * 
  */

include('./funciones.php');

define('ADODB_ASSOC_CASE', 1);
$ruta_raiz = "..";
$ADODB_COUNTRECS = false;
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include "../config.php";

$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

if(isset($_POST['upload']))
{

//fecha valida de acuerdo al horario de atención
$fechaval=valida_fecha($db);

//consulta consecutivo de anexos
/*
$sql_con_anex=" select SUBSTR(max(anex_codigo),19,1) k from anexos where anex_radi_nume=".$_SESSION['numeroRadicado'];
$rs_con_anex=$db->conn->Execute($sql_con_anex);
if(($rs_con_anex->fields['k'])==NULL)
	$consec=1;
else
	$consec=($rs_con_anex->fields['k'])+1;
*/
$consec=count($_SESSION['ins_anex'])+1;


//datos del arhivo
$extension=strrchr($_FILES['archivo']['name'],".");
$archivo_orfeo="1".$_SESSION['numeroRadicado']."_".sprintf("%05d",$consec).$extension;
$nombre_archivo = "../../bodegaProd/".date('Y')."/".$_SESSION["depeRadicaFormularioWeb"]."/docs/".$archivo_orfeo;
$tipo_archivo = $_FILES['archivo']['type'];
$tamano_archivo = $_FILES['archivo']['size'];

$error=0;
//upload archivo
    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $nombre_archivo))
	{
       $mensaje="<strong>El archivo ha sido cargado correctamente. Si no desea cargar mas archivos pulse click en el CERRAR</strong>";
    }
	else
	{
       $mensaje="<strong>Ocurrio algun error al subir el fichero. No pudo guardarse.</strong>";
	$error=1;
    }


//trae usualogin

$sql_login="select usua_login from usuario where usua_codi=".$_SESSION["usuaRecibeWeb"]." and depe_codi=".$_SESSION["depeRadicaFormularioWeb"];
$rs_login=$db->conn->Execute($sql_login);

//inserta anexo
$ins_anex="insert into anexos(anex_radi_nume,anex_codigo,anex_tipo,anex_tamano,anex_solo_lect,anex_creador,anex_desc,anex_numero,anex_nomb_archivo,anex_borrado,anex_origen,anex_salida,anex_estado,sgd_rem_destino,sgd_dir_tipo,anex_depe_creador,anex_fech_anex,sgd_apli_codi)
values(".$_SESSION['numeroRadicado'].",".$_SESSION['numeroRadicado'].sprintf("%05d",$consec).",".$_POST['tipo'].",".$tamano_archivo.",'S','".$rs_login->fields['USUA_LOGIN']."','".$_POST['desc']."',1,'".$archivo_orfeo."','N',0,0,0,1,1,".$_SESSION["depeRadicaFormularioWeb"].",to_date('".$fechaval."','dd/mm/yyyy hh24:mi:ss'),0);";


//guarda consulta para que se ejecute cuando se cree el radicado
$_SESSION['ins_anex'][]=$ins_anex;

//echo $ins_anex;

//guarda consulta en archivo plano
$handle=fopen("/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/".$_SESSION['numeroRadicado']."_anexos","a+");
fwrite($handle,$ins_anex);
fclose($handle);
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Radicacion Web - Anexos</title>
<link rel="stylesheet" href="css/structure.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />
<!-- JavaScript -->
<script type="text/javascript" src="scripts/wufoo.js"></script>
<!-- prototype -->
<script type="text/javascript" src="prototype.js"></script>
<!--funciones-->
<script type="text/javascript" src="ajax.js"></script>
</head>

<body>
<p>&nbsp;</p>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td align="center"><br /><img src="../logoEntidad.gif"/></td>
  </tr>
  <tr>
    <td><br><font color="red"><?= $mensaje ?></font></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center">
	Adjunte los documentos que desea anexar a su queja.
    </td>
  </tr>
  <tr>
    <td align="left">
<form id="form69" class="wufoo topLabel" autocomplete="off" name="anexo" enctype="multipart/form-data" method="POST">

<li id="foli1" 		class="   ">
	<label class="desc" id="title1" for="Field1">
		Tipo de archivo (Es el formato del archivo que va a adjuntar a su queja)	
	</label>
	<div>
		    <select id="label1" 			
				name="tipo" 			
				class="field select medium" 			
				tabindex="19"
		    >
			<option value="1">Word</option>
			<option value="2">Excel</option>
			<option value="3">PowerPoint</option>
			<option value="4">Imagen Tif</option>
			<option value="5">Imagen jpg</option>
			<option value="6">Imagen gif</option>
			<option value="7">PDF</option>
			<option value="9">ZIP</option>


		    </select>		
		&nbsp;<font color="#FF0000">*</font>
	</div>
</li>
<li id="foli2" 
		class="    ">
	
	
	<label class="desc" id="title2" for="Field2">Descripci&oacute;n (Es un texto explicativo del contenido del archivo.)</label>
	
	<div>
		<textarea id="desc" 
			name="desc" 
			class="field textarea small" 
			rows="10" cols="50"
			tabindex="5"></textarea>
			&nbsp;<font color="#FF0000">*</font>			</div>
	</li>
<li id="foli3" 
		class="    ">
	
	
	<label class="desc" id="title3" for="Field3">Seleccione el archivo a anexar</label>
	
	<div>
	<input 
		name="archivo" 
		type="file" 
		class="field text"  
>
	&nbsp;<font color="#FF0000">*</font>			
	</div>
</li>
<input type="submit" name="Submit" value="Aceptar" onclick="return valida_form2()"/>
<input type="button" name="cerrar" value="Cerrar" onclick="window.close()" />
<input type="hidden" name="upload" value="upload">

</form>
</td>
  </tr>
  <tr>
    <td align="center">
<br>&nbsp;
</td>
  </tr>
</table>
</body>
</html>
