<?php
/*********************************************************************************
 *       Filename: busquedas.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// busquedas CustomIncludes begin
session_start();
include_once ("./common.php");
include_once ("./encabezado.php");
//$db->conn->debug=true;
// busquedas CustomIncludes end
//-------------------------------



//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "busquedas.php";
//===============================


//===============================
// busquedas PageSecurity begin
check_security();
// busquedas PageSecurity end
//===============================

//===============================
// busquedas Open Event begin
// busquedas Open Event end
//===============================

//===============================
// busquedas OpenAnyPage Event start
// busquedas OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// busquedas Show begin

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
<?php Search_show() ?>
    
   </td>
  </tr>
 </table>
 <table>
  <tr>
   <td valign="top">
<?php PRESTADOS_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// busquedas Show end

//===============================
// busquedas Close Event begin
// busquedas Close Event end
//===============================
//********************************************************************************


//===============================
// Display Search Form
//-------------------------------
function Search_show()
{
  global $db;
  global $styles;
  
  global $sForm;
  $sFormTitle = "Busquedas";
  $sActionFileName = "busquedas.php";
  $ss_DEPE_CODIDisplayValue = "";
  $ss_PRES_ESTADODisplayValue = "";
  $ss_PRES_REQUERIMIENTODisplayValue = "";

//-------------------------------
// Search Open Event begin
// Search Open Event end
//-------------------------------
//-------------------------------
// Set variables with search parameters
//-------------------------------
  $flds_RADI_NUME_RADI = strip(get_param("s_RADI_NUME_RADI"));
  $flds_USUA_LOGIN_ACTU = strip(get_param("s_USUA_LOGIN_ACTU"));
  $flds_DEPE_CODI = strip(get_param("s_DEPE_CODI"));
  $flds_PRES_ESTADO = strip(get_param("s_PRES_ESTADO"));
  $flds_PRES_REQUERIMIENTO = strip(get_param("s_PRES_REQUERIMIENTO"));
  $flds_desde_dia = strip(get_param("s_desde_dia"));
  $flds_hasta_dia = strip(get_param("s_hasta_dia"));
  $flds_desde_mes = strip(get_param("s_desde_mes"));
  $flds_hasta_mes = strip(get_param("s_hasta_mes"));
  $flds_desde_ano = strip(get_param("s_desde_ano"));
  $flds_hasta_ano = strip(get_param("s_hasta_ano"));
   
  if (strlen($flds_desde_dia) && strlen($flds_hasta_dia) && 
      strlen($flds_desde_mes) && strlen($flds_hasta_mes) && 
      strlen($flds_desde_ano) && strlen($flds_hasta_ano) ) {
    $desdeTimestamp = mktime(0,0,0,$flds_desde_mes, $flds_desde_dia, $fld_desde_ano);
    $hastaTimestamp = mktime(0,0,0,$flds_hasta_mes, $flds_hasta_dia, $flds_hasta_ano);
    $flds_desde_dia = Date('d',$desdeTimestamp);
    $flds_hasta_dia = Date('d',$hastaTimestamp);
    $flds_desde_mes = Date('m',$desdeTimestamp);
    $flds_hasta_mes = Date('m',$hastaTimestamp);
    $flds_desde_ano = Date('Y',$desdeTimestamp);
    $flds_hasta_ano = Date('Y',$hastaTimestamp);
  }
  else {
    $flds_desde_dia = Date('d');
    $flds_hasta_dia = Date('d');
    $flds_desde_mes = Date('m')-1;
    $flds_hasta_mes = Date('m');
    $flds_desde_ano = 2003;
    $flds_hasta_ano = Date('Y');
  }
  $flds_USUA_LOGIN_PRES = strip(get_param("s_USUA_LOGIN_PRES"));

   
//-------------------------------
// Search Show begin
//-------------------------------


//-------------------------------
// Search Show Event begin
// Search Show Event end
//-------------------------------
?>
    <form method="GET" action="<?= $sActionFileName ?>" name="Search">
    <input type="hidden" name="FormName" value="Search"><input type="hidden" name="FormAction" value="search">
    <table class="FormTABLE">
     <tr>
      <td class="FormHeaderTD" colspan="11"><a name="Search"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Radicado</font></td>
      <td class="DataTD"><input type="text" name="s_RADI_NUME_RADI" maxlength="" value="<?= tohtml($flds_RADI_NUME_RADI) ?>" size="" ></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Usuario</font></td>
      <td class="DataTD"><input type="text" name="s_USUA_LOGIN_ACTU" maxlength="15" value="<?= tohtml($flds_USUA_LOGIN_ACTU) ?>" size="15" ></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Dependencia</font></td>
      <td class="DataTD"><select name="s_DEPE_CODI">
<?
    echo "<option value=\"\">" . $ss_DEPE_CODIDisplayValue . "</option>";
    $lookup_s_DEPE_CODI = db_fill_array("select DEPE_CODI, DEPE_NOMB from DEPENDENCIA order by 2");

    if(is_array($lookup_s_DEPE_CODI))
    {
      reset($lookup_s_DEPE_CODI);
      while(list($key, $value) = each($lookup_s_DEPE_CODI))
      {
        if($key == $flds_DEPE_CODI)
          $option="<option SELECTED value=\"$key\">$value";
        else 
          $option="<option value=\"$key\">$value";
        echo $option;
      }
    }
    
?></select></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Estado</font></td>
      <td class="DataTD"><select name="s_PRES_ESTADO">
<?
    echo "<option value=\"\">" . $ss_PRES_ESTADODisplayValue . "</option>";
    $LOV = split(";", "1;Solicitado;2;Prestado;3;Devuelto;4;Cancelado;5;Prestamo Indefinido");
  
    if(sizeof($LOV)%2 != 0) 
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);
    
    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $flds_PRES_ESTADO) 
        $option="<option SELECTED value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];
      else
        $option="<option value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];

      echo $option;
    }
?></select></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Requerimiento</font></td>
      <td class="DataTD"><select name="s_PRES_REQUERIMIENTO">
<?
    echo "<option value=\"\">" . $ss_PRES_REQUERIMIENTODisplayValue . "</option>";
    $LOV = split(";", "1;Documento;2;Anexo");
  
    if(sizeof($LOV)%2 != 0) 
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);
    
    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $flds_PRES_REQUERIMIENTO) 
        $option="<option SELECTED value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];
      else
        $option="<option value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];

      echo $option;
    }
?></select></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Desde Fecha (dd/mm/yyyy)</font></td>
      <td class="DataTD"><select class="DataFONT" name="s_desde_dia">
	  
	  
<?
    for($i = 1; $i <= 31; $i++)
    {
      if($i == $flds_desde_dia) 
        $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
      else
        $option="<option value=\"" . $i . "\">" . $i . "</option>";

      echo $option;
    }
?></select><select class="DataFONT" name="s_desde_mes">
<?
    for($i = 1; $i <= 12; $i++)
    {
      if($i == $flds_desde_mes) 
        $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
      else
        $option="<option value=\"" . $i . "\">" . $i . "</option>";

      echo $option;
    }
?></select><select class="DataFONT" name="s_desde_ano">
<?
    $agnoactual=Date('Y');
    for($i = 2003; $i <= $agnoactual; $i++)
    {
      if($i == $flds_desde_ano) 
        $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
      else
        $option="<option value=\"" . $i . "\">" . $i . "</option>";

      echo $option;
    }
?></select></td>
     </tr>

     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Hasta Fecha (dd/mm/yyyy)</font></td>
      <td class="DataTD"><select class="DataFONT" name="s_hasta_dia">
<?
    for($i = 1; $i <= 31; $i++)
    {
      if($i == $flds_hasta_dia) 
        $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
      else
        $option="<option value=\"" . $i . "\">" . $i . "</option>";

      echo $option;
    }
?></select><select class="DataFONT" name="s_hasta_mes">
<?
    for($i = 1; $i <= 12; $i++)
    {
      if($i == $flds_hasta_mes) 
        $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
      else
        $option="<option value=\"" . $i . "\">" . $i . "</option>";

      echo $option;
    }
?></select><select class="DataFONT" name="s_hasta_ano">
<?
    for($i = 2003; $i <= $agnoactual; $i++)
    {
      if($i == $flds_hasta_ano) 
        $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
      else
        $option="<option value=\"" . $i . "\">" . $i . "</option>";

      echo $option;
    }
?></select></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Funcionario Archivo</font></td>
      <td class="DataTD"><input type="text" name="s_USUA_LOGIN_PRES" maxlength="15" value="<?= tohtml($flds_USUA_LOGIN_PRES) ?>" size="15" ></td>
     </tr>
	 <tr>
     <td align="right" colspan="3"><input type="submit" value="B&uacute;squeda"></td>
    </tr>
   </table>
   </form>
<?

//-------------------------------
// Search Show end
//-------------------------------

//-------------------------------
// Search Close Event begin
// Search Close Event end
//-------------------------------
//===============================
}


//===============================
// Display Grid Form
//-------------------------------
function PRESTADOS_show()
{
//-------------------------------
// Initialize variables  
//-------------------------------
  
  
  global $db;
  global $sPRESTADOSErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Documentos Prestados";
  $HasParam = false;
  $iRecordsPerPage = 100;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $iTmpI = 0;
  $iTmpJ = 0;
  $sCountSQL = "";

  $transit_params = "";
  $form_params = "s_DEPE_CODI=" . tourl(get_param("s_DEPE_CODI")) . "&s_PRES_DESC=" . tourl(get_param("s_PRES_DESC")) . "&s_PRES_ESTADO=" . tourl(get_param("s_PRES_ESTADO")) . "&s_PRES_REQUERIMIENTO=" . tourl(get_param("s_PRES_REQUERIMIENTO")) . "&s_RADI_NUME_RADI=" . tourl(get_param("s_RADI_NUME_RADI")) . "&s_USUA_LOGIN_ACTU=" . tourl(get_param("s_USUA_LOGIN_ACTU")) . "&s_USUA_LOGIN_PRES=" . tourl(get_param("s_USUA_LOGIN_PRES")) . "&s_desde_dia=" . tourl(get_param("s_desde_dia")) . "&s_desde_mes=" . tourl(get_param("s_desde_mes")) . "&s_desde_ano=" . tourl(get_param("s_desde_ano")) . "&s_hasta_dia=" . tourl(get_param("s_hasta_dia")) . "&s_hasta_mes=" . tourl(get_param("s_hasta_mes")) . "&s_hasta_ano=" . tourl(get_param("s_hasta_ano")) . "&s_solo_nomb=" . tourl(get_param("s_solo_nomb")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $iSort = get_param("FormPRESTADOS_Sorting");
  $iSorted = get_param("FormPRESTADOS_Sorted");
  if(!$iSort)
  {
    $form_sorting = "";
	$sOrder = " order by P.PRES_FECH_PEDI DESC";
  }
  else
  {
    if($iSort == $iSorted)
    {
      $form_sorting = "";
      $sDirection = " DESC";
      $sSortParams = "FormPRESTADOS_Sorting=" . $iSort . "&FormPRESTADOS_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormPRESTADOS_Sorting=" . $iSort . "&FormPRESTADOS_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by P.RADI_NUME_RADI" . $sDirection;
    if ($iSort == 2) $sOrder = " order by P.USUA_LOGIN_ACTU" . $sDirection;
    if ($iSort == 3) $sOrder = " order by D.DEPE_NOMB" . $sDirection;
    if ($iSort == 4) $sOrder = " order by P.PRES_FECH_PEDI" . $sDirection;
    if ($iSort == 5) $sOrder = " order by P.PRES_REQUERIMIENTO" . $sDirection;
    if ($iSort == 6) $sOrder = " order by P.PRES_FECH_PRES" . $sDirection;
    if ($iSort == 7) $sOrder = " order by P.PRES_DESC" . $sDirection;
    if ($iSort == 8) $sOrder = " order by P.PRES_FECH_DEVO" . $sDirection;
    if ($iSort == 9) $sOrder = " order by P.USUA_LOGIN_PRES" . $sDirection;
    if ($iSort == 10) $sOrder = " order by P.PRES_ESTADO" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="10"><a name="PRESTADOS"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
      </tr>
      <tr>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=1&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=2&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=3&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dependencia</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=4&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha de Solicitud</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=5&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Requerimiento</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=6&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha de Pr&eacute;stamo</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=7&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Descripci&oacute;n</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=8&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha de Devoluci&oacute;n</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=9&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Archivo/C.Docum</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPRESTADOS_Sorting=10&FormPRESTADOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Estado</font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
// Se crea la $ps_desde_RADI_FECH_RADI con los datos ingresados.
//------------------------------------
  
  //$ps_desde_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(0,0,0,get_param("s_desde_mes"),get_param("s_desde_dia"),get_param("s_desde_ano")));
   $ps_desde_RADI_FECH_RADI = Date('Y-m-d H:i:s',mktime(0,0,0,get_param("s_desde_mes"),get_param("s_desde_dia"),get_param("s_desde_ano")));
  if(strlen($ps_desde_RADI_FECH_RADI))
  {
    $HasParam = true;
   
    //$sWhere = $sWhere . "P.PRES_FECH_PEDI>=to_date('" .$ps_desde_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
    $sWhere = $sWhere . "P.PRES_FECH_PEDI>=".$db->conn->DBDate($ps_desde_RADI_FECH_RADI). " ";
  }
//-----------------------
// Se reciben 
//-----------------------
  //$ps_hasta_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(23,59,59,get_param("s_hasta_mes"),get_param("s_hasta_dia"),get_param("s_hasta_ano")));
  $ps_hasta_RADI_FECH_RADI = Date('Y-m-d H:i:s',mktime(23,59,59,get_param("s_hasta_mes"),get_param("s_hasta_dia") + 1,get_param("s_hasta_ano")));

  if(strlen($ps_hasta_RADI_FECH_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    
    //$sWhere = $sWhere . "P.PRES_FECH_PEDI<=to_date('" . $ps_hasta_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
    $sWhere = $sWhere . "P.PRES_FECH_PEDI<" .$db->conn->DBDate($ps_hasta_RADI_FECH_RADI) . "  ";
  }
  //print ($ps_hasta_RADI_FECH_RADI);
  $ps_DEPE_CODI = get_param("s_DEPE_CODI");
  if(is_number($ps_DEPE_CODI) && strlen($ps_DEPE_CODI))
    $ps_DEPE_CODI = tosql($ps_DEPE_CODI, "Number");
  else 
    $ps_DEPE_CODI = "";

  if(strlen($ps_DEPE_CODI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
  	$HasParam = true;
    $sWhere = $sWhere . "P.DEPE_CODI=" . $ps_DEPE_CODI;
  }
  $ps_PRES_DESC = get_param("s_PRES_DESC");

  if(strlen($ps_PRES_DESC))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.PRES_DESC like " . tosql("%".$ps_PRES_DESC ."%", "Text");
  }
  $ps_PRES_ESTADO = get_param("s_PRES_ESTADO");
  if(is_number($ps_PRES_ESTADO) && strlen($ps_PRES_ESTADO))
    $ps_PRES_ESTADO = tosql($ps_PRES_ESTADO, "Number");
  else 
    $ps_PRES_ESTADO = "";

  if(strlen($ps_PRES_ESTADO))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.PRES_ESTADO=" . $ps_PRES_ESTADO;
  }
  $ps_PRES_REQUERIMIENTO = get_param("s_PRES_REQUERIMIENTO");
  if(is_number($ps_PRES_REQUERIMIENTO) && strlen($ps_PRES_REQUERIMIENTO))
    $ps_PRES_REQUERIMIENTO = tosql($ps_PRES_REQUERIMIENTO, "Number");
  else 
    $ps_PRES_REQUERIMIENTO = "";

  if(strlen($ps_PRES_REQUERIMIENTO))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.PRES_REQUERIMIENTO=" . $ps_PRES_REQUERIMIENTO;
  }
  $ps_RADI_NUME_RADI = get_param("s_RADI_NUME_RADI");
  if(is_number($ps_RADI_NUME_RADI) && strlen($ps_RADI_NUME_RADI))
    $ps_RADI_NUME_RADI = $ps_RADI_NUME_RADI; //tosql($ps_RADI_NUME_RADI, "Number");
  else 
    $ps_RADI_NUME_RADI = "";

  if(strlen($ps_RADI_NUME_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.RADI_NUME_RADI like ('%" . $ps_RADI_NUME_RADI ."%')";
  }
  $ps_USUA_LOGIN_ACTU = get_param("s_USUA_LOGIN_ACTU");

  if(strlen($ps_USUA_LOGIN_ACTU))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.USUA_LOGIN_ACTU like " . tosql("%".$ps_USUA_LOGIN_ACTU ."%", "Text");
  }
  $ps_USUA_LOGIN_PRES = get_param("s_USUA_LOGIN_PRES");

  if(strlen($ps_USUA_LOGIN_PRES))
  {	
	$ps_USUA_LOGIN_PRES = strtoupper($ps_USUA_LOGIN_PRES);
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.USUA_LOGIN_PRES like " . tosql("%".$ps_USUA_LOGIN_PRES ."%", "Text");
  }


  if($HasParam)
    $sWhere = " AND (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $radiATexto = $db->conn->numToString("P.RADI_NUME_RADI ");
  $sSQL = "select P.DEPE_CODI as P_DEPE_CODI, " . 
    "P.PRES_DESC as P_PRES_DESC, " . 
    "P.PRES_ESTADO as P_PRES_ESTADO, " . 
    "P.PRES_FECH_DEVO as P_PRES_FECH_DEVO, " . 
    "P.PRES_FECH_PEDI as P_PRES_FECH_PEDI, " . 
    "P.PRES_FECH_PRES as P_PRES_FECH_PRES, " . 
    "P.PRES_ID as P_PRES_ID, " . 
    "P.PRES_REQUERIMIENTO as P_PRES_REQUERIMIENTO, " . 
    "$radiATexto as P_RADI_NUME_RADI, " . 
    "P.USUA_LOGIN_ACTU as P_USUA_LOGIN_ACTU, " . 
    "P.USUA_LOGIN_PRES as P_USUA_LOGIN_PRES, " . 
    "D.DEPE_CODI as D_DEPE_CODI, " . 
    "D.DEPE_NOMB as D_DEPE_NOMB " . 
    " from PRESTAMO P, DEPENDENCIA D"  . 
    " where D.DEPE_CODI=P.DEPE_CODI  ";
//-------------------------------

//-------------------------------
// PRESTADOS Open Event begin
// PRESTADOS Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
  if($sCountSQL == "")
  {
    $iTmpI = strpos(strtolower($sSQL), "select");
    $iTmpJ = strpos(strtolower($sSQL), "from") - 1;
    $sCountSQL = str_replace(substr($sSQL, $iTmpI + 6, $iTmpJ - $iTmpI - 6), " count(*) ", $sSQL);
    $iTmpI = strpos(strtolower($sCountSQL), "order by");
    if($iTmpI > 1) 
      $sCountSQL = substr($sCountSQL, 0, $iTmpI - 1);
  }
//-------------------------------

  

//-------------------------------
// Execute SQL statement
//-------------------------------
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $rs=$db->query($sSQL);
  $db->conn->SetFetchMode(ADODB_FETCH_NUM); 
//-------------------------------
// Process empty recordset
//-------------------------------
  if((!$rs || $rs->EOF ))
  {
?>
     <tr>
      <td colspan="10" class="DataTD"><font class="DataFONT">No hay Registros</font></td>
     </tr>
<?
 
//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="10" class="ColumnTD"><font class="ColumnFONT">
<?
  
?>
  </table>
<?

    return;
  }

//-------------------------------

//-------------------------------
// Prepare the lists of values
//-------------------------------
  
  $aPRES_REQUERIMIENTO = split(";", "1;Documento;2;Anexo");
  $aPRES_ESTADO = split(";", "1;Solicitado;2;Prestado;3;Devuelto;4;Cancelado;5:Prestamo Indefinido");
//-------------------------------
//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iRecordsPerPage = 100;
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Process page scroller
//-------------------------------
  $iPage = get_param("FormPRESTADOS_Page");
  if(!strlen($iPage))
    $iPage = 1;
  else
  {
    if($iPage == "last")
    {
      $db_count = get_db_value($sCountSQL);
      $dResult = intval($db_count) / $iRecordsPerPage;
      $iPage = intval($dResult);
      if($iPage < $dResult) $iPage++;
    }
    else
      $iPage = intval($iPage);
    
  }
  
  

  if(($iPage - 1) * $iRecordsPerPage != 0)
  {
    do
    {
      $iCounter++;
      $rs->MoveNext();
    } while ($iCounter < ($iPage - 1) * $iRecordsPerPage && !$rs->EOF);
    
  }

 
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Display grid based on recordset
//-------------------------------
  while(($rs && !$rs->EOF )  && $iCounter < $iRecordsPerPage)
  {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldDEPE_CODI =$rs->fields["D_DEPE_NOMB"];
    $fldPRES_DESC =$rs->fields["P_PRES_DESC"];
    $fldPRES_ESTADO =$rs->fields["P_PRES_ESTADO"];
    $fldPRES_FECH_DEVO =$rs->fields["P_PRES_FECH_DEVO"];
    $fldPRES_FECH_PEDI =$rs->fields["P_PRES_FECH_PEDI"];
    $fldPRES_FECH_PRES =$rs->fields["P_PRES_FECH_PRES"];
    $fldPRES_ID =$rs->fields["P_PRES_ID"];
    $fldPRES_REQUERIMIENTO =$rs->fields["P_PRES_REQUERIMIENTO"];
    $fldRADI_NUME_RADI_URLLink = "detalle.php";
    $fldRADI_NUME_RADI_PRES_ID =$rs->fields["P_PRES_ID"];
    $fldRADI_NUME_RADI =$rs->fields["P_RADI_NUME_RADI"];
    $fldUSUA_LOGIN_ACTU =$rs->fields["P_USUA_LOGIN_ACTU"];
    $fldUSUA_LOGIN_PRES =$rs->fields["P_USUA_LOGIN_PRES"];
    $rs->MoveNext();
    
//-------------------------------
// PRESTADOS Show begin
//-------------------------------

//-------------------------------
// PRESTADOS Show Event begin
// PRESTADOS Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="DataTD"><font class="DataFONT"><a href="<?=$fldRADI_NUME_RADI_URLLink?>?PRES_ID=<?=$fldRADI_NUME_RADI_PRES_ID?>&<?= $transit_params ?>"><font class="DataFONT"><?=$fldRADI_NUME_RADI?></font></a>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_LOGIN_ACTU) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDEPE_CODI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldPRES_FECH_PEDI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <? $fldPRES_REQUERIMIENTO = get_lov_value($fldPRES_REQUERIMIENTO, $aPRES_REQUERIMIENTO); ?>
      <?= tohtml($fldPRES_REQUERIMIENTO) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldPRES_FECH_PRES) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldPRES_DESC) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldPRES_FECH_DEVO) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_LOGIN_PRES) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <? $fldPRES_ESTADO = get_lov_value($fldPRES_ESTADO, $aPRES_ESTADO); ?>
      <?= tohtml($fldPRES_ESTADO) ?>&nbsp;</font></td>
      </tr><?
//-------------------------------
// PRESTADOS Show end
//-------------------------------

//-------------------------------
// Move to the next record and increase record counter
//-------------------------------
    
    $iCounter++;
  }
// print ("<br> $iCounter");
 
//-------------------------------
//  Grid. The insert link and record navigator.
//-------------------------------
?>
    <tr>
     <td colspan="10" class="ColumnTD"><font class="ColumnFONT">
<?
  
  // PRESTADOS Navigation begin
  
  if(($rs && !$rs->EOF )|| $iPage != 1)
  {
    $iCounter = 1;
    $iHasPages = $iPage;
    $sPages = "";
    $iDisplayPages = 0;
    $iNumberOfPages = 10;
    while(($rs && !$rs->EOF ) && $iHasPages < $iPage + $iNumberOfPages)
    {
      if($iCounter == $iRecordsPerPage)
      {
        $iCounter = 0;
        $iHasPages = $iHasPages + 1;
      }
      $iCounter++;
      $rs->MoveNext();
    }
    if($rs->EOF && $iCounter > 1) $iHasPages++;
    if (($iHasPages - $iPage) < intval($iNumberOfPages / 2))
      $iStartPage = $iHasPages - $iNumberOfPages;
    else
      $iStartPage = $iPage - $iNumberOfPages + intval($iNumberOfPages / 2);
    
    if($iStartPage < 0) $iStartPage = 0;
    for($iPageCount = $iStartPage + 1;  $iPageCount <= $iPage - 1; $iPageCount++)
    {
      $sPages .=  "<a href=\"$sFileName?$form_params$sSortParams$FormPRESTADOS_Page=$iPageCount#PRESTADOS\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
      $iDisplayPages++;
    }
    
    $sPages .= "<font " . "class=\"ColumnFONT\"" . ">" . $iPage . "</font>&nbsp;";
    $iDisplayPages++;
    
    $iPageCount = $iPage + 1;
    while ($iDisplayPages < $iNumberOfPages && $iStartPage + $iDisplayPages < $iHasPages)
    {
      
      $sPages .= "<a href=\"" . $sFileName . "?" . $form_params . $sSortParams . "FormPRESTADOS_Page=" . $iPageCount . "#PRESTADOS\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
      $iDisplayPages++;
      $iPageCount++;
    }
    if ($iPage == 1) {
?>
        <font class="ColumnFONT">Primero</font>
        <font class="ColumnFONT">Anterior</font>
<? }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPRESTADOS_Page=1#PRESTADOS"><font class="ColumnFONT">Primero</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPRESTADOS_Page=<?=$iPage - 1?>#PRESTADOS"><font class="ColumnFONT">Anterior</font></a>
<?
    }
    echo "&nbsp;[&nbsp;" . $sPages . "]&nbsp;";
    
    if ($rs->EOF ) {
?>
        <font class="ColumnFONT">Siguiente</font>
        <font class="ColumnFONT">Ultimo</font>
<?
    }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPRESTADOS_Page=<?=$iPage + 1?>#PRESTADOS"><font class="ColumnFONT">Siguiente</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPRESTADOS_Page=last#PRESTADOS"><font class="ColumnFONT">Ultimo</font></a>
<?
    }
  }

//-------------------------------
// PRESTADOS Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </font></td></tr>
    </table>
  <?


//-------------------------------
// PRESTADOS Close Event begin
// PRESTADOS Close Event end
//-------------------------------
}
//===============================

?>
