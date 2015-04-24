<?php
/*********************************************************************************
 *       Filename: login.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// login CustomIncludes begin

include ("./common.php");

// login CustomIncludes end
//-------------------------------

session_start();

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
$sForm1Err = "";

//-------------------------------
// Select the FormAction
//-------------------------------
switch ($sForm) {
  case "Form1":
    Form1_action($sAction);
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
<title>Consultas</title>
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
function Form1_action($sAction)
{
  global $db;
  
  global $sForm1Err;
  global $sFileName;
  global $styles;

  switch(strtolower($sAction))
  {
    case "login":

//-------------------------------
// Form1 Login begin
//-------------------------------
      $sLogin = get_param("Login");
      $sPassword = get_param("Password");
      $sLogin = strtoupper($sLogin);
      $sPassword = substr(md5($sPassword),1,26);
      $db->query("SELECT USUA_LOGIN, CODI_NIVEL FROM USUARIO WHERE USUA_LOGIN =" . tosql($sLogin, "Text") . " AND USUA_PASW=" . tosql($sPassword, "Text"));
      $is_passed = $db->next_record();

//-------------------------------
// Form1 OnLogin Event begin
// Form1 OnLogin Event end
//-------------------------------
      if($is_passed)
      {
//-------------------------------
// Login and password passed
//-------------------------------
        set_session("UserID", $db->f("USUA_LOGIN"));
        set_session("Nivel", $db->f("CODI_NIVEL"));
        $sPage = get_param("ret_page");
        if (strlen($sPage))
          header("Location: " . $sPage);
        else
          header("Location: busqueda.php");
      }
      else
      {
        $sForm1Err = "La identificaci&oacute;n o la palabra clave es incorrecta.";
      }
//-------------------------------
// Form1 Login end
//-------------------------------
    break;
    case "logout":
//-------------------------------
// Logout action
//-------------------------------
//-------------------------------
// Form1 Logout begin
//-------------------------------

//-------------------------------
// Form1 OnLogout Event begin
// Form1 OnLogout Event end
//-------------------------------
      session_unregister("UserID");
      session_unregister("UserRights");
      if(strlen(get_param("ret_page")))
        header("Location:" . $sFileName . "?ret_page=" . urlencode(get_param("ret_page")));
      else
        header("Location:" . $sFileName);
//-------------------------------
// Form1 Logout end
//-------------------------------
    break;
  }
}
//===============================


//===============================
// Display Login Form
//-------------------------------
function Form1_show()
{
  
  global $sForm1Err;
  global $db;
  global $sFileName;
  global $styles;
  $querystring =  get_param("querystring");
  $ret_page = get_param("ret_page");

  $sFormTitle = "Ingrese usuario y contrase&nacute;a";

//-------------------------------
// Form1 Show begin
//-------------------------------

//-------------------------------
// Form1 Open Event begin
// Form1 Open Event end
//-------------------------------

  ?>
    <table class="FormTABLE">
    <form action="<?= $sFileName ?>" method="POST">
    <input type="hidden" name="FormName" value="Form1">

    <tr><td class="FormHeaderTD" colspan="2"><font class="FormHeaderFONT"><?=$sFormTitle?></font></td></tr>
    <? if ($sForm1Err) { ?>
    <tr><td colspan="2" class="DataTD"><font class="DataFONT"><?= $sForm1Err ?></font></td></tr>
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
    $db->query("SELECT USUA_LOGIN FROM USUARIO WHERE USUA_LOGIN=". tosql($usuario,"Text"));
    $db->next_record();
?>
      <tr><td class="DataTD"><font class="DataFONT"> <?= $db->f("USUA_LOGIN") ?></font>
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
// Form1 Close Event begin
// Form1 Close Event end
//-------------------------------

//-------------------------------
// Form1 Show end
//-------------------------------
}
//===============================


?>
