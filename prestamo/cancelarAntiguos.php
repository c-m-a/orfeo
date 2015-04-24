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

//$db->conn->debug=true;

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

 
  
  $bExecSQL = true;
  $sActionFileName = "";
  $sWhere = "";
  $bErr = false;
//-------------------------------

//-------------------------------
// PRESTAMO Action begin
//-------------------------------
  $sActionFileName = "inicio.php";

//-------------------------------
// Build WHERE statement
//-------------------------------
  $antier = Date('dmY', mktime(0,0,0,Date(m),Date(d)-7,Date(Y)));
  $sWhere = "pres_estado=1 and pres_fech_pedi < to_date('$antier','ddmmyyyy')";
//-------------------------------

//-------------------------------
//-------------------------------
// Create SQL statement
//-------------------------------
      if($sSQL == "")
      {
        $sSQL = "update PRESTAMO set " .
          "PRES_ESTADO=4";
        $sSQL .= " where " . $sWhere;
      }
//-------------------------------
// Execute SQL statement
//-------------------------------
  $db->query($sSQL);
  $mensaje = "Las solicitudes anteriores a $antier fueron canceladas";
  include($sActionFileName);
?>