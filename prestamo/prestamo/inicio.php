<?php
/*********************************************************************************
 *       Filename: inicio.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// inicio CustomIncludes begin

session_start();

include_once ("./common.php");
include_once ("./encabezado.php");

//set_session("Dependencia",$dependencia);
//set_session("UserID", $login);


// inicio CustomIncludes end
//-------------------------------



//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "inicio.php";
//===============================
if (strlen(trim($mensaje))==0)
	$mensaje = get_param("mensaje");

//===============================
// inicio PageSecurity begin
//===============================
check_security();
//===============================

// inicio PageSecurity end
//===============================

//===============================
// inicio Open Event begin
// inicio Open Event end
//===============================

//===============================
// inicio OpenAnyPage Event start
// inicio OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// inicio Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?><html>
<head>
<title>Archivo - Manejo de prestamos y devoluciones</title>
<meta name="GENERATOR" content="YesSoftware CodeCharge v.2.0.5 build 11/30/2001">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache">
<link rel="stylesheet" href="Site.css" type="text/css"></head>
<body class="PageBODY">

 <table>
  <tr>
   <td valign="top">
 <?php Form1_show() ?>
   
   </td>
  </tr>
 </table>

 <table>
  <tr>
   
   <td valign="top">
<?php inicio_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// inicio Show end

//===============================
// inicio Close Event begin
// inicio Close Event end
//===============================
//********************************************************************************


//===============================
// Display Menu Form
//-------------------------------
function inicio_show()
{
  global $db;
  global $styles;
  global $mensaje;
  $sFormTitle = "Escoja la opcion deseada";

//-------------------------------
// inicio Open Event begin
// inicio Open Event end
//-------------------------------

//-------------------------------
// Set URLs
//-------------------------------
//-------------------------------
// inicio Show begin
//-------------------------------


//-------------------------------
// inicio BeforeShow Event begin
// inicio BeforeShow Event end
//-------------------------------

//-------------------------------
// Show fields
//-------------------------------



?>
    <table class="FormTABLE">
     <tr>
      <td colspan="0"  class="FormHeaderTD"><font class="FormHeaderFONT"><?= $sFormTitle ?></font></td>
     </tr>
     <tr>
	 	<td><font class="DataFONT"><?= tohtml($mensaje) ?>&nbsp;</font></td>
     </tr>
    </table>
<?php

//-------------------------------
// inicio Show end
//-------------------------------
}
//===============================

?>
