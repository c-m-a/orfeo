<?
session_start();
/**
  * Modulo de Formularios Web para atencion a Ciudadanos.
  * @autor Carlos Barrero   carlosabc81@gmail.com SuperSolidaria
  * @fecha 2009/05
  * 
  */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 1);

if($_GET["orderNo"]) $orderNo=$_GET["orderNo"];
if($_GET["orderTipo"]) $orderTipo=$_GET["orderTipo"];
if($_GET["busqRadicados"]) $gen_lisDefi=$_GET["busqRadicados"];

// $depeRadicaFormularioWeb = 900;  // Es radicado en la Dependencia 900
// $usuaRecibeWeb = 1; // Usuario que Recibe los Documentos Web
// $secRadicaFormularioWeb = 900;

unset($_SESSION['ins_anex']);

 $depeRadicaFormularioWeb = 470;  // Es radicado en la Dependencia 900
 $usuaRecibeWeb = 1; // Usuario que Recibe los Documentos Web
 $secRadicaFormularioWeb = 470;


 //$depeRadicaFormularioWeb = 900;  // Es radicado en la Dependencia 900
 //$usuaRecibeWeb = 1; // Usuario que Recibe los Documentos Web
 //$secRadicaFormularioWeb = 900;
$ruta_raiz = "..";
$ADODB_COUNTRECS = false;
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include "../config.php";
  $_SESSION["depeRadicaFormularioWeb"]=$depeRadicaFormularioWeb ;  // Es radicado en la Dependencia 900
  $_SESSION["usuaRecibeWeb"]=$usuaRecibeWeb ; // Usuario que Recibe los Documentos Web
  $_SESSION["secRadicaFormularioWeb"]=$secRadicaFormularioWeb ;   // Osea que usa la Secuencia sec_tp2_900
  
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true;


include('./funciones.php');
include('./formulario_sql.php');



//captcha

$val_cap=randomText(4);
$_SESSION['val_cap']=$val_cap;

//numero de radicado

// $numero=substr('000000'.$db->conn->GenID('SECR_TP2_'.$_SESSION['secRadicaFormularioWeb']),-6);

$numero=substr('000000'.$db->conn->GenID('SECR_TP2_'.$_SESSION['secRadicaFormularioWeb']),-6);
$numeroRadicado = date('Y').$_SESSION['depeRadicaFormularioWeb'].$numero."2";
$_SESSION['numeroRadicado']=$numeroRadicado;



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title>Formulario QRDP</title>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<!-- CSS -->
<link rel="stylesheet" href="css/structure.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />

<!-- JavaScript --><script type="text/javascript" src="scripts/wufoo.js"></script>
<!-- prototype --><script type="text/javascript" src="prototype.js"></script>
<!--funciones--><script type="text/javascript" src="ajax.js"></script>

<?
//validacion fecha y hora habil

echo "<script>
function valida_fecha()
{
fecha='".valida_fecha($db)."';

  if(!confirm('Su queja sera radicada en la siguiente fecha y hora : '+fecha))
    return false;
  else
    return valida_form();
}
</script>";
?>

<script>
 function ocultarIFBusqueda(){
    document.getElementById('ifBusqueda').style.display='none';
 }
function mostrarIFBusqueda(){
    document.getElementById('ifBusqueda').style.display='';
 }
</script>
</head>

<body id="public" onLoad='ocultarIFBusqueda();' >
  
<div id="container" style="background-image:url(../imagenes/logoOrfeoFondo.gif);">

<h1>  &nbsp;</h1>

  <form id="form68" class="wufoo topLabel" autocomplete="off"
  enctype="multipart/form-data" method="GET" action="formulariotx.php" name="quejas">

<div class="info" align="justify">
  <center><img src='../logoEntidad.gif' ></center>
<strong><font color="red" size=3>RECUERDE</font></strong>
<br>
El horario de atenci&oacute;n al ciudadano es de lunes a viernes de
8:30 am a 4:30 pm. Si hace su radicaci&oacute;n por este medio, en horario diferente, su queja quedar&aacute; radicada con la siguiente fecha h&aacute;bil.
  <br /><br>
Antes de diligenciar este formulario, tenga en cuenta que la presentaci&oacute;n de quejas relacionadas con la actuaci&oacute;n de los miembros de los &oacute;rganos de administraci&oacute;n, control y vigilancia de las organizaciones de la econom&iacute;a solidaria, deber&aacute; surtirse, <strong>en primera instancia</strong>, ante el &oacute;rgano de control social de la respectiva entidad.  Esto en virtud de lo dispuesto en el art&iacute;culo 40 de la Ley 79 de 1988, en concordancia con lo establecido en el art&iacute;culo 58 de la Ley 454 de 1998.
  <h4>Este formulario solo es para registrar <u>quejas contra entidades supervisadas.</u> </h4>
Campos requeridos ( <font color="#FF0000">*</font> ) </div>

<table><tr><td width="30%">
    Nombre Remitente      
</td><td  width="70%">
    <input id="Field0"      
      name="nombre_remitente"       
      type="text"       
      class=""      
      value=""      
      size="20"       
      tabindex="1"  
    />
    &nbsp;&nbsp;Apellidos<input id="Field1"       
      name="apellidos_remitente"      
      type="text"       
      class="field text"      
      value=""      
      size="20"       
      tabindex="2"  
      />
    <font color="#FF0000">*</font>
    
</td></tr>
<tr><td>
    Documento de Identificaci&oacute;n (C.C, C.E - digite solo numeros) 
</td><td>
    <input id="Field3"      
      name="cedula"       
      type="text"       
      class="field text medium"       
      value=""      
      maxlength="255"       
      tabindex="3"  
      onkeypress="return alpha(event,numbers)"    
    />
    &nbsp;<font color="#FF0000">*</font>
</td></tr>
<tr><td>
    Departamento
            </td><td>
    <select id="label"      
    name="depto"      
    class="field select medium"       
    tabindex="19" 
    onchange="trae_municipio()">
    Municipio<option value="0" selected="selected"> Seleccione </option>
    <?=$depto ?>
    </select>
  &nbsp;<font color="#FF0000">*</font> </td></tr><tr><td>Municipio </td><td>
  <div id="div-contenidos"><select id="label2"       
    name="muni"       
    class="field select medium"       
    tabindex="19">
    <option value="0" selected="selected">Seleccione..</option>
   </select>
  &nbsp;<font color="#FF0000">*</font>
</div>
</td></tr>
<tr><td>
    Direcci&oacute;n  Remitente (Es la direcci&oacute;n de residencia o trabajo de quien formula la queja. Ejm. Calle 31 No. 7-10)    &nbsp;<font color="#FF0000">*</font>
</td><td>
  <input id="direccion_remitente"       
      name="direccion_remitente"      
      type="text"       
      class="field text medium"       
      value=""      
      maxlength="255"       
      tabindex="4"
      size=50 
    />
</td></tr>
<tr><td>
   Tel&eacute;fono  Remitente 
  </td><td>
    <input id="label3"      
    name="telefono_remitente"       
    type="text"       
    class="field text medium"       
    value=""      
    maxlength="255"       
    tabindex="4"
  >
</td></tr>
<tr><td>E-mail  Remitente &nbsp;<font color="#FF0000">*</font>
</td><td>  
    <input id="label4"      
    name="email"      
    type="text"       
    class="field text medium"       
    value=""      
    maxlength="255"       
    tabindex="4"
  >
</td></tr>
<tr><td>Nit Entidad <img src="images/loading_animated2.gif" width="48" height="48" style="display:none" id="loader2" name nitEntidad/> (solo numeros)&nbsp;&nbsp;&nbsp;Si no conoce el nit de la entidad ingrese a la <a href="#nitEntidad" onClick='mostrarIFBusqueda(); ' >B&uacute;squeda Avanzada</a> &nbsp;<font color="#FF0000">*</font>

</td><td>
    <input id="label5"      
    name="nit" 
    id="nit"
    type="text"       
    class="field text medium"       
    value=""      
    maxlength="255"       
    tabindex="4"  
    onchange="trae_entidad()" 
    onkeypress="return alpha(event,numbers);" 
  />
    </td></tr>
<tr><td colspan="2">
<? $paginaBusqueda=" src='busquedaNew.php' "; ?>
<iframe <?=$paginaBusqueda?>  width="100%" height="300" id=ifBusqueda >
</iframe>
</td></tr>
<tr><td>
Tipo de Solicitud <font color="#FF0000">*</font>
   </td><td>
    <select id="tipo"       
    name="tipo"       
    class="field select medium"       
    tabindex="18"
   >
    <?= $tipo ?>
    </select>
</td></tr>
<!--
<li id="foli4"    class="   ">
  <label class="desc" id="title4" for="label7">Referente al Radicado No. (solo numeros, 14 d&iacute;gitos)<img src="images/loading_animated2.gif" width="48" height="48" style="display:none" id="loader3"/> </label>
  <div>
    <input id="label7"      
    name="radicado"       
    type="text"       
    class="field text large"      
    value=""      
    maxlength="255"       
    tabindex="4" 
    onchange="trae_radicado()" 
    onkeypress="return alpha(event,numbers);"
   />
  </div>
  <div id="div-contenidos3" style="display:none"></div>
</li>
-->
<tr><td>Asunto <font color="#FF0000">*</font>
</td><td>
  
    <input id="label6"      
    name="asunto"       
    type="text"       
    class="field text medium"       
    value=""      
    maxlength="255"       
    tabindex="4" 
/>
    </div>
</td></tr>
<tr><td>Descripci&oacute;n (Digite el contenido de su queja - texto en MAYUSCULAS) &nbsp;<font color="#FF0000">*</font>
<td>
    <textarea id="desc" 
      name="desc" 
      class="field textarea small" 
      rows="3" cols="40"
      tabindex="5"></textarea>
</td></tr>  
<tr><td><label class="desc" id="title113" for="Field113">Documentos Anexos</label>
<td>
<a href="#" onclick="window.open('anexo.php');">Si desea puede ingresar documentos anexos a su queja en este enlace.</a>
</td></tr>  
<tr><td>
  <label class="desc" id="title112" for="Field112">Ingrese el n&uacute;mero mostrado en la im&aacute;gen</label>
  <img src="captcha.php" width="100" height="30" vspace="3">
</td><td>
  <input 
    name="text_imagen" 
    type="text" 
    class="field text"  
    id="text_imagen"
>
  &nbsp;<font color="#FF0000">*</font>      
</td></tr>
<tr><td>
  <input id="saveForm" type="submit" value="Enviar" onclick="return valida_fecha();" />
</td><td>
  <input name="button" type="button" id="button" onclick="window.close();" value="Cancelar" />
</td></tr>


  <li style="display:none">
    <label for="comment">No llene esto</label>
    <textarea name="comment" id="comment" rows="1" cols="1"></textarea>
  </li>
</ul>

<input type="hidden" name="valcap" value="<?= $_SESSION['val_cap'] ?>">
</table>
</form>

</div><!--container-->
  
</body>
</html>
