<?php

/*********************************************************************************
 *       Filename: common.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

error_reporting (E_ALL ^ E_NOTICE);
//===============================
// Database Connection Definition
//-------------------------------
//Archivo - Manejo de prestamos y devoluciones Connection begin

if (!$ruta_raiz) $ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");


// Archivo - Manejo de prestamos y devoluciones Connection end

//===============================
// Site Initialization
//-------------------------------
// Obtain the path where this site is located on the server
//-------------------------------
$app_path = ".";
//-------------------------------
// Create Header and Footer Path variables
//-------------------------------
$header_filename = "encabezado.html";
//===============================

//===============================
// Common functions
//-------------------------------
// Convert non-standard characters to HTML
//-------------------------------
function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}

//-------------------------------
// Convert value to URL
//-------------------------------
function tourl($strValue)
{
  return urlencode($strValue);
}

//-------------------------------
// Obtain specific URL Parameter from URL string
//-------------------------------
function get_param($param_name)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;

  $param_value = "";
  if(isset($HTTP_POST_VARS[$param_name]))
    $param_value = $HTTP_POST_VARS[$param_name];
  else if(isset($HTTP_GET_VARS[$param_name]))
    $param_value = $HTTP_GET_VARS[$param_name];
  // Modificado Infométrika 14-Julio-2009
  // Se agregan los arreglos $_GET y $_POST
  else if ( isset( $_POST[ $param_name ] ) ) {
	$param_value = $_POST[ $param_name ];
  } else if ( isset( $_GET[ $param_name ] ) ) {
	$param_value = $_GET[ $param_name ];
  }

  return $param_value;
}

function get_session($param_name)
{
  global $HTTP_POST_VARS;
  global $HTTP_GET_VARS;
  global ${$param_name};

  $param_value = "";
  // Modificado Infométrika 14-Julio-2009
  // Se agregan los arreglos $_GET y $_POST
  //if(!isset($HTTP_POST_VARS[$param_name]) && !isset($HTTP_GET_VARS[$param_name]) && session_is_registered($param_name)) 
  if(!isset($HTTP_POST_VARS[$param_name]) && !isset($HTTP_GET_VARS[$param_name]) && !isset( $_POST[ $param_name ] ) && !isset( $_GET[ $param_name ] ) && session_is_registered($param_name))
    $param_value = ${$param_name};

  return $param_value;
}

function set_session($param_name, $param_value)
{
  global ${$param_name};
  if(session_is_registered($param_name)) 
    session_unregister($param_name);
  ${$param_name} = $param_value;
  session_register($param_name);
}

function is_number($string_value)
{
  if(is_numeric($string_value) || !strlen($string_value))
    return true;
  else 
    return false;
}

//-------------------------------
// Convert value for use with SQL statament
//-------------------------------
function tosql($value, $type)
{
  if(!strlen($value))
    return "NULL";
  else
    if($type == "Number")
      return str_replace (",", ".", doubleval($value));
    else
    {
      if(get_magic_quotes_gpc() == 0)
      {
        $value = str_replace("'","''",$value);
        $value = str_replace("\\","\\\\",$value);
      }
      else
      {
        $value = str_replace("\\'","''",$value);
        $value = str_replace("\\\"","\"",$value);
      }

      return "'" . $value . "'";
    }
}

function strip($value)
{
  if(get_magic_quotes_gpc() == 0)
    return $value;
  else
    return stripslashes($value);
}

function db_fill_array($sql_query)
{
  global  $ruta_raiz;
  $db = new ConnectionHandler($ruta_raiz);
  //$db->conn->debug=true;
  $rs=$db->query($sql_query);
  if ($rs && !$rs->EOF  )
  {
    do
    {
      $ar_lookup[$rs->fields[0]] = $rs->fields[1];
      $rs->MoveNext();
    } while ($rs && !$rs->EOF);
    return $ar_lookup;
  }
  else
    return false;

}

//-------------------------------
// Deprecated function - use get_db_value($sql)
//-------------------------------
function dlookup($table_name, $field_name, $where_condition)
{
  $sql = "SELECT " . $field_name . " FROM " . $table_name . " WHERE " . $where_condition;
  return get_db_value($sql);
}


//-------------------------------
// Lookup field in the database based on SQL query
//-------------------------------
function get_db_value($sql)
{
  global $db;
  $rs=$db->query($sql);
  
  if($rs && !$rs->EOF)
    return $rs->fields[0];
  else 
    return "";
}

//-------------------------------
// Obtain Checkbox value depending on field type
//-------------------------------
function get_checkbox_value($value, $checked_value, $unchecked_value, $type)
{
  if(!strlen($value))
    return tosql($unchecked_value, $type);
  else
    return tosql($checked_value, $type);
}

//-------------------------------
// Obtain lookup value from array containing List Of Values
//-------------------------------
function get_lov_value($value, $array)
{
  $return_result = "";

  if(sizeof($array) % 2 != 0) 
    $array_length = sizeof($array) - 1;
  else
    $array_length = sizeof($array);

  for($i = 0; $i < $array_length; $i = $i + 2)
  {
    if($value == $array[$i]) $return_result = $array[$i+1];
  }

  return $return_result;
}

//-------------------------------
// Verify user's security level and redirect to login page if needed
//-------------------------------

function check_security()
{
  if(!session_is_registered("UserID")){
  	$querystring = urlencode(getenv("QUERY_STRING"));
  	$ret_page = urlencode(getenv("REQUEST_URI"));
    include_once ("login.php");
    die;
  }
}

//===============================
//  GlobalFuncs begin
//  GlobalFuncs end
//===============================
?>
