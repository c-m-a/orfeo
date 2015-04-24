<?php
/*********************************************************************************
 *       Filename: devolver.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// devolver CustomIncludes begin
session_start();
include ("./common.php");
include ("./encabezado.php");

// devolver CustomIncludes end
//-------------------------------



//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "devolver.php";
//===============================


//===============================
// devolver PageSecurity begin
check_security();
// devolver PageSecurity end
//===============================

//===============================
// devolver Open Event begin
// devolver Open Event end
//===============================

//===============================
// devolver OpenAnyPage Event start
// devolver OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// devolver Show begin

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
    D_PRESTAMO_action($sAction);
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
 <?php Form1_show() ?>
   
   </td>
  </tr>
 </table>

 <table>
  <tr>
   
   <td valign="top">
<?php D_PRESTAMO_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// devolver Show end

//===============================
// devolver Close Event begin
// devolver Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function D_PRESTAMO_action($sAction)
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
  $fldPRES_FECH_DEVO = "";
  $fldPRES_DESC = "";
  $fldPRES_ESTADO = "";
//-------------------------------

//-------------------------------
// PRESTAMO Action begin
//-------------------------------
  $sActionFileName = "inicio.php";

//-------------------------------
// CANCEL action
//-------------------------------
  if($sAction == "cancel")
  {

//-------------------------------
// PRESTAMO BeforeCancel Event begin
// PRESTAMO BeforeCancel Event end
//-------------------------------
    header("Location: " . $sActionFileName);
  }
//-------------------------------


//-------------------------------
// Build WHERE statement
//-------------------------------
  if($sAction == "update" || $sAction == "delete") 
  {
    $pPKPRES_ID = get_param("PK_PRES_ID");
    if( !strlen($pPKPRES_ID)) return;
    $sWhere = "PRES_ID=" . tosql($pPKPRES_ID, "Number");
  }
//-------------------------------


//-------------------------------
// Load all form fields into variables
//-------------------------------
  $fldPRES_FECH_DEVO = get_param("PRES_FECH_DEVO");
  $fldPRES_DESC = get_param("PRES_DESC");
  $fldPRES_ESTADO = get_param("PRES_ESTADO");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update") 
  {
    if(!is_number($fldPRES_ESTADO))
      $sPRESTAMOErr .= "El valor en el campo Estado es incorrecto.<br>";
    
//-------------------------------
// PRESTAMO Check Event begin
// PRESTAMO Check Event end
//-------------------------------
    if(strlen($sPRESTAMOErr)) return;
  }
//-------------------------------


//-------------------------------
// Create SQL statement
//-------------------------------
  switch(strtolower($sAction)) 
  {
    case "update":

//-------------------------------
// PRESTAMO Update Event begin
$fldPRES_FECH_DEVO = "to_date('" .$fldPRES_FECH_DEVO . "','dd/mm/yyyy HH:MI')";
// PRESTAMO Update Event end
//-------------------------------
      if($sSQL == "")
      {
        $sSQL = "update PRESTAMO set " .
          "PRES_FECH_DEVO=" . $fldPRES_FECH_DEVO .
          ",PRES_DESC=" . tosql($fldPRES_DESC, "Text") .
          ",PRES_ESTADO=" . tosql($fldPRES_ESTADO, "Number");
        $sSQL .= " where " . $sWhere;
      }
    break;
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
 // include_once($sActionFileName);

//-------------------------------
// PRESTAMO Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function D_PRESTAMO_show()
{
  global $db;
  
  global $sAction;
  global $sForm;
  global $sFileName;
  global $sPRESTAMOErr;
  global $styles;
  
  $fldPRES_ID = "";
  $fldPRES_FECH_DEVO = "";
  $fldPRES_DESC = "";
  $fldPRES_ESTADO = "";
//-------------------------------
// PRESTAMO Show begin
//-------------------------------
  $sFormTitle = "Devolucion";
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
    $fldPRES_FECH_DEVO = strip(get_param("PRES_FECH_DEVO"));
    $fldPRES_DESC = strip(get_param("PRES_DESC"));
    $fldPRES_ESTADO = strip(get_param("PRES_ESTADO"));
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
  $rs=$db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "PRESTAMO") && ($rs && !$rs->EOF) );
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldPRES_ID =$rs->fields["PRES_ID"];
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sPRESTAMOErr == "") 
    {
      $fldPRES_FECH_DEVO =$rs->fields["PRES_FECH_DEVO"];
      $fldPRES_DESC =$rs->fields["PRES_DESC"];
      $fldPRES_ESTADO =$rs->fields["PRES_ESTADO"];
    }
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
      $fldPRES_FECH_DEVO= Date ('d-M-y');;
    }
//-------------------------------
// PRESTAMO ShowInsert Event begin
// PRESTAMO ShowInsert Event end
//-------------------------------
  }
  if($sPRESTAMOErr == "")
  {
//-------------------------------
// PRESTAMO Show Event begin
$fldPRES_FECH_DEVO = Date('d/m/Y h:i');
// PRESTAMO Show Event end
//-------------------------------
  }

//-------------------------------
// Show form field
//-------------------------------
    ?>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Fecha de devoluci&oacute;n</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><input type="hidden" name="PRES_FECH_DEVO" maxlength="15" value="<?= tohtml($fldPRES_FECH_DEVO) ?>" size="15" ><?=$fldPRES_FECH_DEVO?></font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Observaciones extras</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><textarea name="PRES_DESC" cols="50" rows="5"><?=tohtml($fldPRES_DESC)?></textarea></font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Estado</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><select name="PRES_ESTADO">
<?
    $LOV = split(";", "3;Devuelto;");
  
    if(sizeof($LOV)%2 != 0) 
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);
    
    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $fldPRES_ESTADO) 
        $option="<option SELECTED value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];
      else
        $option="<option value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];

      echo $option;
    }
?></select></font>
       </td>
     </tr>
    <tr><td colspan="2" align="right">
<? if ($bIsUpdateMode) { ?>
  <input type="hidden" value="update" name="FormAction"/>
  <input type="submit" value="Devolver" onclick="document.PRESTAMO.FormAction.value = 'update';">
<? } ?>
  <input type="submit" value="Cancelar" onclick="document.PRESTAMO.FormAction.value = 'cancel';">
  <input type="hidden" name="FormName" value="PRESTAMO">
  
  <input type="hidden" name="PK_PRES_ID" value="<?= $pPRES_ID ?>">  
  <input type="hidden" name="PRES_ID" value="<?= tohtml($fldPRES_ID)?>">
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
