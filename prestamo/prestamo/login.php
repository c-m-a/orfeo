<?php
/*********************************************************************************
 *       Filename: login.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// login CustomIncludes begin
session_start();

include_once ("./common.php");
include_once ("./encabezado.php");

// login CustomIncludes end
//-------------------------------



//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "login.php";
//===============================


//===============================
// login PageSecurity begin
// login PageSecurity end
//===============================

//===============================
// login Open Event begin
// login Open Event end
//===============================

//===============================
// login OpenAnyPage Event start
// login OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// login Show begin

//===============================
// Perform the form's action
//-------------------------------
// Initialize error variables
//-------------------------------
$sloginErr = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "login":
    login_action($sAction);
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
<?php login_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// login Show end

//===============================
// login Close Event begin
// login Close Event end
//===============================
//********************************************************************************


//===============================
// Login Form Action
//-------------------------------
function login_action($sAction)
{
  global $db;
  
  global $sloginErr;
  global $sFileName;
  global $styles;

  switch(strtolower($sAction))
  {
    case "login":

//-------------------------------
// login Login begin
//-------------------------------
      $sLogin = get_param("Login");
      $sPassword = get_param("Password");
      $sLogin = strtoupper($sLogin);
      $sPassword = substr(md5($sPassword),1,26);
       $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
       $rs = $db->query("SELECT USUA_LOGIN, DEPE_CODI FROM USUARIO WHERE USUA_LOGIN =" . tosql($sLogin, "Text") . " AND USUA_PASW=" . tosql($sPassword, "Text") . " AND USUA_ADMIN=1");
      
      

//-------------------------------
// login OnLogin Event begin
// login OnLogin Event end
//-------------------------------
      if($rs && !$rs->EOF )
      {
//-------------------------------
// Login and password passed
//-------------------------------
	$dependencia = $rs->fields["DEPE_CODI"];
	set_session("Dependencia",$dependencia);
        set_session("UserID", $sLogin);
        $sPage = get_param("ret_page");
        if (strlen($sPage))
          include($sPage);
       // else
          //include("inicio.php");
      }
      else
      {
        $sloginErr = "La identificación o la palabra clave es incorrecta.";
      }
//-------------------------------
// login Login end
//-------------------------------
    break;
    case "logout":
//-------------------------------
// Logout action
//-------------------------------
//-------------------------------
// login Logout begin
//-------------------------------

//-------------------------------
// login OnLogout Event begin
// login OnLogout Event end
//-------------------------------
      session_unregister("UserID");
      session_unregister("UserRights");
      if(strlen(get_param("ret_page"))){
      	$ret_page = urlencode(get_param("ret_page"));
        include_once($sFileName);
      }
      else
        include_once($sFileName);
//-------------------------------
// login Logout end
//-------------------------------
    break;
  }
}
//===============================


//===============================
// Display Login Form
//-------------------------------
function login_show()
{
  
  global $sloginErr;
  global $db;
  global $sFileName;
  global $styles;
  $querystring =  get_param("querystring");
  $ret_page = get_param("ret_page");

  $sFormTitle = "Préstamos";

//-------------------------------
// login Show begin
//-------------------------------

//-------------------------------
// login Open Event begin
// login Open Event end
//-------------------------------

  ?>
    <table class="FormTABLE">
    <form action="<?= $sFileName ?>" method="POST">
    <input type="hidden" name="FormName" value="login">

    <tr><td class="FormHeaderTD" colspan="2"><font class="FormHeaderFONT"><?=$sFormTitle?></font></td></tr>
    <? if ($sloginErr) { ?>
    <tr><td colspan="2" class="DataTD"><font class="DataFONT"><?= $sloginErr ?></font></td></tr>
    <? } ?>

  <?

  if(get_session("UserID") == "") 
  {
//-------------------------------
//- User is not logged in
//-------------------------------
?>
      <tr><td class="FieldCaptionTD"><font class="FieldCaptionFONT">Identificaci&oacute;n</font></td><td class="DataTD"><input type="text" name="Login" value="<?=tohtml(get_param("Login"))?>" maxlength="50"></td></tr>
      <tr><td class="FieldCaptionTD"><font class="FieldCaptionFONT">Palabra Clave</font></td><td class="DataTD"><input type="password" name="Password" maxlength="50"></td></tr>
      <tr><td colspan="2">
      <input type="hidden" name="FormAction" value="login">
      <input type="submit" value="Conexión">
      </td></tr>
    <?
  }
  else
  {
//-------------------------------
// User is logged in
//-------------------------------
    $usuario = get_session("UserID");
    $rs=$db->query("SELECT USUA_LOGIN FROM USUARIO WHERE USUA_LOGIN=". tosql($usuario,"Text"));
   
?>
      <tr><td class="DataTD"><font class="DataFONT"> <?= $rs->fields["USUA_LOGIN"] ?></font>
      <input type="hidden" name="FormAction" value="logout">
      <input type="submit" value="Desconexión">
      </td></tr>
<?
  }
?>
  <input type="hidden" name="ret_page" value="<?= $ret_page ?>"><input type="hidden" name="querystring" value="<?= $querystring ?>"></td></tr>
  </form></table>
<?
//-------------------------------
// login Close Event begin
// login Close Event end
//-------------------------------

//-------------------------------
// login Show end
//-------------------------------
}
//===============================


?>
