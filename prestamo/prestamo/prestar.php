<?php
/*********************************************************************************
 *       Filename: prestar.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// prestar CustomIncludes begin

session_start();
include_once ("./common.php");
include_once ("./encabezado.php");

// prestar CustomIncludes end
//-------------------------------
//$db->conn->debug=true;


//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "prestar.php";
//===============================


//===============================
// prestar PageSecurity begin
check_security();
// prestar PageSecurity end
//===============================

//===============================
// prestar Open Event begin
// prestar Open Event end
//===============================

//===============================
// prestar OpenAnyPage Event start
// prestar OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");



//===============================

// prestar Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sPRESTAMOErr = "";

$login_err="";
//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "PRESTAMO":
    PRESTAMO_action($sAction);
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
<?php PRESTAMO_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// prestar Show end

//===============================
// prestar Close Event begin
// prestar Close Event end
//===============================
//********************************************************************************


//===============================
// Action of the Record Form
//-------------------------------
function PRESTAMO_action($sAction)
{
//-------------------------------
// Initialize variables  
//-------------------------------
  global $db;
  
  global $sForm;
  global $sPRESTAMOErr;
  global $styles;
  global $login_err;
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
  $pPKPRES_ID = "";
  $fldUSUA_LOGIN_PRES = "";
  $fldPRES_FECH_PRES = "";
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
  //if($sAction == "cancel")
  //{

//-------------------------------
// PRESTAMO BeforeCancel Event begin
// PRESTAMO BeforeCancel Event end
//-------------------------------
    //include_once($sActionFileName);
  //}
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
  $fldUserID = get_session("UserID");
  $fldPRES_ID = get_param("Rqd_PRES_ID");
  $fldUSUA_LOGIN_PRES = get_param("USUA_LOGIN_PRES");
  $fldPRES_FECH_PRES = get_param("PRES_FECH_PRES");
  $fldPRES_FECH_VENC = get_param("PRES_FECH_VENC");
  $fldPRES_DESC = get_param("PRES_DESC");
  $fldPRES_ESTADO = get_param("PRES_ESTADO");
  $fldcontrasena = get_param("contrasena");
  $fldusuario = get_param("usuario");

//-------------------------------
// Validate fields
//-------------------------------
  if($sAction == "insert" || $sAction == "update") 
  {
    if(!strlen($fldUSUA_LOGIN_PRES))
      $sPRESTAMOErr .= "El valor en el campo Usuario que Presta se requiere.<br>";
    
    if(!strlen($fldPRES_FECH_PRES))
      $sPRESTAMOErr .= "El valor en el campo Fecha de Pr&eacute;stamo se requiere.<br>";
    
    if(!is_number($fldPRES_ESTADO))
      $sPRESTAMOErr .= "El valor en el campo Estado es incorrecto.<br>";

    if(!strlen($fldcontrasena) && $fldPRES_ESTADO==2)
      $sPRESTAMOErr .= "El valor en el campo Contrase&nacute;a de Usuario se requiere para prestar.<br>";
    
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
$fldPRES_FECH_PRES = "to_date('" .$fldPRES_FECH_PRES . "','dd/mm/yyyy HH:MI')";
if ($fldPRES_ESTADO!=5){ //Es un prestamo indefinido
  $fldPRES_FECH_VENC = "to_date('" .$fldPRES_FECH_VENC . "','dd/mm/yyyy HH:MI')";
}
else{
  $fldPRES_FECH_VENC = "to_date('01/01/2020','dd/mm/yyyy HH:MI')";
}

if($fldPRES_ESTADO ==2){
  $fldcontrasena = substr(md5($fldcontrasena),1,26);
  $rs=$db->query("SELECT USUA_LOGIN FROM USUARIO WHERE USUA_LOGIN =" . tosql($fldusuario, "Text") . " AND USUA_PASW=" . tosql($fldcontrasena, "Text"));
 
  if(!$rs || $rs->EOF ){
    $login_err = "LA PALABRA CLAVE DEL USUARIO ES INCORRECTA";
  }
}

// PRESTAMO Update Event end
//-------------------------------
      if($sSQL == "")
      {
        $sSQL = "update PRESTAMO set " .
          "USUA_LOGIN_PRES=" . tosql($fldUSUA_LOGIN_PRES, "Text") .
          ",PRES_FECH_PRES=" . $fldPRES_FECH_PRES .
          ",PRES_FECH_VENC=" . $fldPRES_FECH_VENC . 
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
  if(strlen($login_err)) return;
  if($bExecSQL)
    $db->query($sSQL);
 
  //include_once($sActionFileName);

//-------------------------------
// PRESTAMO Action end
//-------------------------------
}

//===============================
// Display Record Form
//-------------------------------
function PRESTAMO_show()
{
  global $db;
  
  global $sAction;
  global $sForm;
  global $sFileName;
  global $sPRESTAMOErr;
  global $styles;
  global $login_err;
  
  $fldPRES_ID = "";
  $fldRADI_NUME_RADI = "";
  $fldUSUA_LOGIN_ACTU = "";
  $fldDEPE_CODI = "";
  $fldPRES_FECH_PEDI = "";
  $fldPRES_REQUERIMIENTO = "";
  $fldUSUA_LOGIN_PRES = "";
  $fldPRES_FECH_PRES = "";
  $fldPRES_DESC = "";
  $fldPRES_ESTADO = "";
 /* 
  if (!$sAction){
	$sAction = "insert";
	$sForm = "PRESTAMO";
   }
   */
//-------------------------------
// PRESTAMO Show begin
//-------------------------------
  $sFormTitle = "Prestar / Cancelar";
  $sWhere = "";
  $bPK = true;

?>
   
   <table class="FormTABLE">
   <form method="POST" action="<?= $sFileName ?>" name="PRESTAMO">
   <tr><td class="FormHeaderTD" colspan="2"><font class="FormHeaderFONT"><?=$sFormTitle?></font></td></tr>
   <? if ($sPRESTAMOErr) { ?>
		<tr><td class="DataTD" colspan="2"><font class="ErrorFONT"><?=$sPRESTAMOErr?></font></td></tr>
	 <? } ?>
    <? if (strlen($login_err)) { ?>
    <tr><td colspan="2"><font Class="ErrorFONT"><?=$login_err?></font></td></tr>
    <? } ?>

<? 

//-------------------------------
// Load primary key and form parameters
//-------------------------------
  if($sPRESTAMOErr == "")
  {
    $fldPRES_ID = get_param("PRES_ID");
    $rqd_PRES_ID = get_param("PRES_ID");
    $pPRES_ID = get_param("PRES_ID");
  }
  else
  { 
    $fldPRES_ID = strip(get_param("PRES_ID"));
    $fldUSUA_LOGIN_PRES = strip(get_param("USUA_LOGIN_PRES"));
    $fldPRES_FECH_PRES = strip(get_param("PRES_FECH_PRES"));
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
   $radiATexto = $db->conn->numToString("RADI_NUME_RADI  ");
  $sSQL = "select PRES_ID,
			$radiATexto as RADI_NUME_RADI,
			USUA_LOGIN_ACTU,
			DEPE_CODI,
			USUA_LOGIN_PRES,
			PRES_DESC,
			PRES_FECH_PRES,
			PRES_FECH_DEVO,
			PRES_FECH_PEDI,
			PRES_ESTADO,
			PRES_REQUERIMIENTO,
			PRES_DEPE_ARCH,
			PRES_FECH_VENC
	  from PRESTAMO where " . $sWhere;
  // Execute SQL statement
 $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $rs=$db->query($sSQL);
  $bIsUpdateMode = ($bPK && !($sAction == "insert" && $sForm == "PRESTAMO") && ($rs && !$rs->EOF) );
//-------------------------------
  
//-------------------------------
// Load lists of values
//-------------------------------
  
  $aPRES_REQUERIMIENTO = split(";", "1;Documento;2;Anexo");
//-------------------------------

//-------------------------------
// Load all fields into variables from recordset or input parameters
//-------------------------------
  if($bIsUpdateMode)
  {
    $fldDEPE_CODI =$rs->fields["DEPE_CODI"];
    $fldPRES_FECH_PEDI =$rs->fields["PRES_FECH_PEDI"];
    $fldPRES_ID =$rs->fields["PRES_ID"];
    $fldPRES_REQUERIMIENTO =$rs->fields["PRES_REQUERIMIENTO"];
    $fldRADI_NUME_RADI =$rs->fields["RADI_NUME_RADI"];
    $fldUSUA_LOGIN_ACTU =$rs->fields["USUA_LOGIN_ACTU"];
//-------------------------------
// Load data from recordset when form displayed first time
//-------------------------------
    if($sPRESTAMOErr == "") 
    {
      
      $fldUSUA_LOGIN_PRES =$rs->fields["USUA_LOGIN_PRES"];
      $fldPRES_FECH_PRES =$rs->fields["PRES_FECH_PRES"];
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
      $fldUSUA_LOGIN_PRES = tohtml(get_session("UserID"));
      $fldPRES_FECH_PRES=Date('d/m/Y h:i');;
    }
//-------------------------------
// PRESTAMO ShowInsert Event begin
// PRESTAMO ShowInsert Event end
//-------------------------------
  }
//-------------------------------
// Set lookup fields
//-------------------------------
  $fldDEPE_CODI = get_db_value("SELECT DEPE_NOMB FROM DEPENDENCIA WHERE DEPE_CODI=" . tosql($fldDEPE_CODI, "Number"));
  if($sPRESTAMOErr == "")
  {
//-------------------------------
// PRESTAMO Show Event begin
$fldUSUA_LOGIN_PRES = get_session("UserID");
$fldPRES_FECH_PRES = Date('d/m/Y h:i');
$fldPRES_FECH_VENC = Date('d/m/Y h:i', mktime(Date(h),Date(i),0,Date(m),Date(d)+8,Date(Y)));
// PRESTAMO Show Event end
//-------------------------------
  }

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
         <font class="FieldCaptionFONT">Login Usuario</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><input type="hidden" name="usuario" value="<?=$fldUSUA_LOGIN_ACTU?>">
      <?= tohtml($fldUSUA_LOGIN_ACTU) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Contrase&nacute;a Usuario</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><input type="password" name="contrasena" maxlength="20" size="20" ></font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Dependencia Usuario</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldDEPE_CODI) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Fecha de Pedido</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <?= tohtml($fldPRES_FECH_PEDI) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Requerimiento</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT">
      <? $fldPRES_REQUERIMIENTO = get_lov_value($fldPRES_REQUERIMIENTO, $aPRES_REQUERIMIENTO); ?>
      <?= tohtml($fldPRES_REQUERIMIENTO) ?>&nbsp;</font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Usuario que Presta</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><input type="hidden" name="USUA_LOGIN_PRES" maxlength="15" value="<?= tohtml($fldUSUA_LOGIN_PRES) ?>" size="15" ><?=$fldUSUA_LOGIN_PRES?></font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Fecha de Pr&eacute;stamo</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><input type="hidden" name="PRES_FECH_PRES" maxlength="20" value="<?= tohtml($fldPRES_FECH_PRES) ?>" size="20" ><?=$fldPRES_FECH_PRES?></font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Fecha de Vencimiento</font>
       </td>
       <td class="DataTD">
         <font class="DataFONT"><input type="hidden" name="PRES_FECH_VENC" maxlength="20" value="<?= tohtml($fldPRES_FECH_VENC) ?>" size="20" ><?=$fldPRES_FECH_VENC?></font>
       </td>
     </tr>
      <tr>
       <td class="FieldCaptionTD">
         <font class="FieldCaptionFONT">Descripcion</font>
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
    $LOV = split(";", "2;Prestado;4;Cancelado;5;Prestamo indefinido");
  
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
  <input type="submit" value="Prestar/Cancelar" onclick="document.PRESTAMO.FormAction.value = 'update';">
<? } ?>
  <input type="submit" value="No hacer nada" onclick="document.PRESTAMO.FormAction.value = 'cancel';">
  <input type="hidden" name="FormName" value="PRESTAMO">
  
  <input type="hidden" name="Rqd_PRES_ID" value="<?= $rqd_PRES_ID ?>";>
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
