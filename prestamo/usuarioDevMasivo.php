<?php
/*********************************************************************************
 *       Filename: usuarioDevMasivo.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// usuarioMasivo CustomIncludes begin
session_start();
include ("./common.php");
include ("./encabezado.php");

// usuarioMasivo CustomIncludes end
//-------------------------------



//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "usuarioDevMasivo.php";
//===============================


//===============================
// usuarioMasivo PageSecurity begin
check_security();
// usuarioMasivo PageSecurity end
//===============================

//===============================
// usuarioMasivo Open Event begin
// usuarioMasivo Open Event end
//===============================

//===============================
// usuarioMasivo OpenAnyPage Event start
// usuarioMasivo OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
//===============================

// usuarioMasivo Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
//-------------------------------
// Select the FormAction
//-------------------------------
//===============================

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?><html>
<head>
<title></title>
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
<?php DM_PRESTAMO_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>

<?php
// usuarioMasivo Show end

//===============================
// usuarioMasivo Close Event begin
// usuarioMasivo Close Event end
//===============================
//********************************************************************************

//===============================
// Display Record Form
//-------------------------------
function DM_PRESTAMO_show()
{
  $fldUSUA_LOGIN_ACTU = "";
//-------------------------------
// PRESTAMO Show begin
//-------------------------------
  $sFormTitle = "Devolucion Masiva";

?>
   
   <table class="FormTABLE">
   <form method="POST" action="devolucionMasivo.php" name="PRESTAMO">
   <tr><td class="FormHeaderTD" colspan="2"><font class="FormHeaderFONT"><?=$sFormTitle?></font></td></tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Ingrese el Login del Usuario</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><input type="text" name="usuario" value="<?=$fldUSUA_LOGIN_ACTU?>">
      <?= tohtml($fldUSUA_LOGIN_ACTU) ?>&nbsp;</font>
       </td>
     </tr>
    <tr><td colspan="2" align="right">
  <input type="submit" value="Buscar Documentos Prestados a este Usuario">
  </td></tr>
  </form>
  </table>
<?
  


//-------------------------------
// PRESTAMO Close Event begin
// PRESTAMO Close Event end
//-------------------------------

//-------------------------------
// PRESTAMO Show end
//-------------------------------
}
//===============================
?>
