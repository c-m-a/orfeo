<?php
/*********************************************************************************
 *       Filename: detalle.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// detalle CustomIncludes begin
session_start();
include_once ("./common.php");
include_once ("./encabezado.php");

// detalle CustomIncludes end
//-------------------------------

//

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "detalle.php";
//===============================


//===============================
// detalle PageSecurity begin
check_security();
// detalle PageSecurity end
//===============================

//===============================
// detalle Open Event begin
// detalle Open Event end
//===============================

//===============================
// detalle OpenAnyPage Event start
// detalle OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// detalle Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sPRESTAMOErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "PRESTAMO":
    PRESTAMO_action_dtl($sAction);
  break;
}
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
<?php
if ($sAction != "cancel")
 Form1_show(); 
?>
   
   </td>
  </tr>
 </table>

 <table>
  <tr>
   
   <td valign="top">
<?php 
if ($sAction != "cancel")
	PRESTAMO_show_dtl(); 
?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// detalle Show end

//===============================
// detalle Close Event begin
// detalle Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function PRESTAMO_action_dtl($sAction)
{
//-------------------------------
// Initialize variables  
//-------------------------------
  global $db;
  
  global $sForm;
  global $sPRESTAMOErr;
  global $styles;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKPRES_ID = "";
//-------------------------------

//-------------------------------
// PRESTAMO Action begin
//-------------------------------
  $sActionFileName = "busquedas.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// PRESTAMO BeforeCancel Event begin
// PRESTAMO BeforeCancel Event end
//-------------------------------
    include_once($sActionFileName);
  }
//-------------------------------

//-------------------------------
// Load all form fields into variables
//-------------------------------

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update") 
  {
//-------------------------------
// PRESTAMO Check Event begin
// PRESTAMO Check Event end
//-------------------------------
    if(strlen($sPRESTAMOErr)) return;
  }
//-------------------------------

//-------------------------------
// PRESTAMO BeforeExecute Event begin
// PRESTAMO BeforeExecute Event end
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  if(strlen($sPRESTAMOErr)) return;
  if($bExecSQL)
    $db->query($sSQL);
  include_once($sActionFileName);

//-------------------------------
// PRESTAMO Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function PRESTAMO_show_dtl()
{
  global $db;
  
  global $sAction;
  global $sForm;
  global $sFileName;
  global $sPRESTAMOErr;
  global $styles;
  
  $fldPRES_ID = "";
  $fldRADI_NUME_RADI = "";
  $fldUSUA_LOGIN_ACTU = "";
  $fldDEPE_CODI = "";
  $fldUSUA_LOGIN_PRES = "";
  $fldPRES_DESC = "";
  $fldPRES_FECH_PRES = "";
  $fldPRES_FECH_DEVO = "";
//-------------------------------
// PRESTAMO Show begin
//-------------------------------
  $sFormTitle = "Detalle Préstamo";
  $sWhere = "";
  $bPK = true;

?>
   
   <table class="FormTABLE">
   <form method="POST" action="<?= $sFileName ?>" name="PRESTAMO">
   <tr><td class="FormHeaderTD" colspan="2"><font class="FormHeaderFONT"><?=$sFormTitle?></font></td></tr>
   <? if ($sPRESTAMOErr) { ?>
		<tr><td class="DataTD" colspan="2"><font class="DataFONT"><?= $sPRESTAMOErr ?></font></td></tr>
	 <? } ?>
<? 

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sPRESTAMOErr == "")
  {
    $fldPRES_ID = get_param("PRES_ID");
    $pPRES_ID = get_param("PRES_ID");
  }
  else
  {
    $fldPRES_ID = strip(get_param("PRES_ID"));
    $pPRES_ID = get_param("PK_PRES_ID");
  }
//-------------------------------

//-------------------------------
// Load all form fields

//-------------------------------

//-------------------------------
// Build WHERE statement
//-------------------------------
  
  if( !strlen($pPRES_ID)) $bPK = false;
  
  $sWhere .= "PRES_ID=" . tosql($pPRES_ID, "Number");
//-------------------------------
//-------------------------------
// PRESTAMO Open Event begin
// PRESTAMO Open Event end
//-------------------------------

//-------------------------------
// Build SQL statement and execute query
//-------------------------------
  $sSQL = "select * from PRESTAMO where " . $sWhere;
  // Execute SQL statement
 $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $rs=$db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "PRESTAMO") && ($rs && !$rs->EOF));
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    
  	$fldDEPE_CODI = $rs->fields["DEPE_CODI"];
    $fldPRES_DESC = $rs->fields["PRES_DESC"];
    $fldPRES_FECH_DEVO = $rs->fields["PRES_FECH_DEVO"];
    $fldPRES_FECH_PRES = $rs->fields["PRES_FECH_PRES"];
    $fldPRES_ID = $rs->fields["PRES_ID"];
    $fldRADI_NUME_RADI = $rs->fields["RADI_NUME_RADI"];
    $fldUSUA_LOGIN_ACTU = $rs->fields["USUA_LOGIN_ACTU"];
    $fldUSUA_LOGIN_PRES = $rs->fields["USUA_LOGIN_PRES"];
//-------------------------------
// PRESTAMO ShowEdit Event begin
// PRESTAMO ShowEdit Event end
//-------------------------------
  }
  else
  {
    if($sPRESTAMOErr == "")
    {
      $fldPRES_ID = tohtml(get_param("PRES_ID"));
    }
//-------------------------------
// PRESTAMO ShowInsert Event begin
// PRESTAMO ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// PRESTAMO Show Event begin
// PRESTAMO Show Event end
//-------------------------------

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Radicado</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldRADI_NUME_RADI) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Usuario</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldUSUA_LOGIN_ACTU) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Dependencia</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldDEPE_CODI) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Prest&oacute;</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldUSUA_LOGIN_PRES) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Descripcion</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldPRES_DESC) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Fecha de pr&eacute;stamo</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldPRES_FECH_PRES) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Fecha de devoluci&oacute;n</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldPRES_FECH_DEVO) ?>&nbsp;</font>
       </td>
     </tr>
    <tr><td colspan="2" align="right">
  <input type="submit" value="O.K." onclick="document.PRESTAMO.FormAction.value = 'cancel';">
  <input type="hidden" name="FormName" value="PRESTAMO">
  
  <input type="hidden" name="PK_PRES_ID" value="<?= $pPRES_ID ?>">  
  <input type="hidden" name="PRES_ID" value="<?= tohtml($fldPRES_ID)?>">
  <input type="hidden" value="cancel" name="FormAction">
  
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
