<?php
/*********************************************************************************
 *       Filename: reporte.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// reporte CustomIncludes begin

include ("./common.php");

// reporte CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "reporte.php";
//===============================


//===============================
// reporte PageSecurity begin
// reporte PageSecurity end
//===============================

//===============================
// reporte Open Event begin
// reporte Open Event end
//===============================

//===============================
// reporte OpenAnyPage Event start
// reporte OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// reporte Show begin

//===============================
// Display page

//===============================
// HTML Page layout
//-------------------------------
?><html>
<head>
<title>Reporte Planilla</title>
<meta name="GENERATOR" content="YesSoftware CodeCharge v.2.0.5 build 11/30/2001">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">
<meta http-equiv="cache-control" content="no-cache">
<link rel="stylesheet" href="Site.css" type="text/css"></head>
<body class="PageBODY">

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
<?php RADICADO_show() ?>
    
   </td>
  </tr>
 </table>



<?php

// reporte Show end

//===============================
// reporte Close Event begin
// reporte Close Event end
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
  $sFormTitle = "Búsqueda";
  $sActionFileName = "reporte.php";
  $ss_desde_RADI_FECH_RADIDisplayValue = "";
  $ss_hora_inicialDisplayValue = "";
  $ss_hora_finalDisplayValue = "";

//-------------------------------
// Search Open Event begin
  $cadena="";
  for ($hace=60;$hace>=0;$hace--){
    $timestamp = mktime (0,0,0,date("m"),date("d")-$hace,date("Y"));
    $mes = Date('d/m/Y',$timestamp);
    $valormes = Date("M d Y", $timestamp);
    $cadena.=$mes.";". $valormes .";";
  }
  $cadena2="";
  for ($hace=0;$hace<=24;$hace++){
    $cadena2.= $hace .";" .$hace . ";";
  }
  $cadena3="";
  for ($hace=0;$hace<=24;$hace++){
    $cadena3.= $hace .";" .$hace;
	if ($hace!= 24)
		$cadena3.= ";";
  }
// Search Open Event end
//-------------------------------
//-------------------------------
// Set variables with search parameters
//-------------------------------
  $flds_RADI_DEPE_RADI = strip(get_param("s_RADI_DEPE_RADI"));
  $flds_desde_RADI_FECH_RADI = strip(get_param("s_desde_RADI_FECH_RADI"));
  $flds_hora_inicial = strip(get_param("s_hora_inicial"));
  $flds_hora_final = strip(get_param("s_hora_final"));

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
    
  <table class="FormTABLE" width="722">
    <tr>
      <td class="FormHeaderTD" colspan="7"><a name="Search"><font class="FormHeaderFONT"><?=$sFormTitle?>Busqueda</font></a></td>
    </tr>
     <tr>
      <td class="FieldCaptionTD" width="154" align="right" height="25"><font class="FieldCaptionFONT">DEPENDENCIA</font></td>
      <td class="DataTD" width="594" height="25"> 
        <select name="s_RADI_DEPE_RADI">
<?
    $lookup_s_RADI_DEPE_RADI = db_fill_array("select UBIC_DEPE_RADI, UBIC_DEPE_RADI from UBICACION_FISICA order by 2");

    if(is_array($lookup_s_RADI_DEPE_RADI))
    {
      reset($lookup_s_RADI_DEPE_RADI);
      while(list($key, $value) = each($lookup_s_RADI_DEPE_RADI))
      {
        if($key == $flds_RADI_DEPE_RADI)
          $option="<option SELECTED value=\"$key\">$value";
        else 
          $option="<option value=\"$key\">$value";
        echo $option;
      }
    }
    
?></select></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD" width="154" align="right" height="25"><font class="FieldCaptionFONT">FECHA</font></td>
      <td class="DataTD" width="594" height="25"> 
        <select name="s_desde_RADI_FECH_RADI">
<?
    echo "<option value=\"\">" . $ss_desde_RADI_FECH_RADIDisplayValue . "</option>";
    $LOV = split(";", "$cadena;");
  
    if(sizeof($LOV)%2 != 0) 
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);
    
    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $flds_desde_RADI_FECH_RADI) 
        $option="<option SELECTED value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];
      else
        $option="<option value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];

      echo $option;
    }
?></select></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD" width="154" align="right" height="25"><font class="FieldCaptionFONT">HORA 
        INICIO</font></td>
      <td class="DataTD" width="594" height="25"> 
        <select name="s_hora_inicial">
<?
    echo "<option value=\"\">" . $ss_hora_inicialDisplayValue . "</option>";
    $LOV = split(";", "$cadena3;");
  
    if(sizeof($LOV)%2 != 0) 
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);
    
    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $flds_hora_inicial || ($ss_hora_inicialDisplayValue=="" && $i==0 && $flds_hora_inicial=="")) 
        $option="<option SELECTED value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1]."</option>";
      else
        $option="<option value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1]."</option>";

      echo $option;
    }
?></select></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD" width="154" align="right" height="25"><font class="FieldCaptionFONT">HORA 
        FINAL</font></td>
      <td class="DataTD" width="594" height="25"> 
        <select name="s_hora_final">
<?
    echo "<option value=\"\">" . $ss_hora_finalDisplayValue . "</option>";
    $LOV = split(";", "$cadena2;");
  
    if(sizeof($LOV)%2 != 0) 
      $array_length = sizeof($LOV) - 1;
    else
      $array_length = sizeof($LOV);
    
    for($i = 0; $i < $array_length; $i = $i + 2)
    {
      if($LOV[$i] == $flds_hora_final) 
        $option="<option SELECTED value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];
      else
        $option="<option value=\"" . $LOV[$i] . "\">" . $LOV[$i + 1];

      echo $option;
    }
?></select></td>
     </tr>
     
    <tr align="center"> 
      <td colspan="3"> 
        <input type="submit" value="BUSCAR">
      </td>
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
function RADICADO_show()
{
//-------------------------------
// Initialize variables  
//-------------------------------
  
  
  global $db;
  global $sRADICADOErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Reporte";
  $HasParam = false;
  $bReq = true;
  $iRecordsPerPage = 2000;
  $iCounter = 0;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";
  $iTmpI = 0;
  $iTmpJ = 0;
  $sCountSQL = "";

  $transit_params = "";
  $form_params = "s_RADI_DEPE_RADI=" . tourl(get_param("s_RADI_DEPE_RADI")) . "&s_desde_RADI_FECH_RADI=" . tourl(get_param("s_desde_RADI_FECH_RADI")) . "&s_hasta_RADI_FECH_RADI=" . tourl(get_param("s_hasta_RADI_FECH_RADI")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by R.RADI_NUME_RADI Asc";
  $iSort = get_param("FormRADICADO_Sorting");
  $iSorted = get_param("FormRADICADO_Sorted");
  if(!$iSort)
  {
    $form_sorting = "";
  }
  else
  {
    if($iSort == $iSorted)
    {
      $form_sorting = "";
      $sDirection = " DESC";
      $sSortParams = "FormRADICADO_Sorting=" . $iSort . "&FormRADICADO_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormRADICADO_Sorting=" . $iSort . "&FormRADICADO_Sorted=" . "&";
    }
    if($iSort == 1) $sOrder = " order by R.RADI_NUME_RADI" . $sDirection;
    if($iSort == 2) $sOrder = " order by R.RA_ASUN" . $sDirection;
    if($iSort == 3) $sOrder = " order by R.RADI_FECH_RADI" . $sDirection;
    if($iSort == 4) $sOrder = " order by R.RADI_NUME_HOJA" . $sDirection;
    if($iSort == 5) $sOrder = " order by R.RADI_DESC_ANEX" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     
<table class="FormTABLE" width="715">
  <tr>
       <td class="FormHeaderTD" colspan="5"><a name="RADICADO"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
  </tr>
      
  <tr align="center"> 
    <td class="ColumnTD" height="25" width="85"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=1&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       
    <td class="ColumnTD" height="25" width="331"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=2&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Asunto</font></a></td>
       
    <td class="ColumnTD" width="110" height="25"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=3&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha 
      Radicaci&oacute;n</font></a></td>
       
    <td class="ColumnTD" height="25" width="23"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=4&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT"># H</font></a>oj</td>
       
    <td width="142" height="25" class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=5&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Anexos</font></a></td>
  </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
  $ps_desde_RADI_FECH_RADI = get_param("s_desde_RADI_FECH_RADI");
  $ps_hora_inicial = get_param("s_hora_inicial");
  $ps_hora_final = get_param("s_hora_final");

  if(strlen($ps_desde_RADI_FECH_RADI) && strlen($ps_hora_inicial) && strlen($ps_hora_final))
  {
    $ps_hora_final -=1;
    $desde = $ps_desde_RADI_FECH_RADI . " ". $ps_hora_inicial .":00:00";
    $hasta = $ps_desde_RADI_FECH_RADI . " ". $ps_hora_final .":59:59";

    $HasParam = true;
    $sWhere = $sWhere . "R.RADI_FECH_RADI>=to_date('" .$desde . "','dd/mm/yyyy HH24:MI:ss')";
    $sWhere .= " and ";
    $sWhere = $sWhere . "R.RADI_FECH_RADI<=to_date('" . $hasta . "','dd/mm/yyyy HH24:MI:ss')";
  }


  $ps_RADI_DEPE_RADI = get_param("s_RADI_DEPE_RADI");
  if(is_number($ps_RADI_DEPE_RADI) && strlen($ps_RADI_DEPE_RADI))
    $ps_RADI_DEPE_RADI = tosql($ps_RADI_DEPE_RADI, "Number");
  else 
    $ps_RADI_DEPE_RADI = "";

  if(strlen($ps_RADI_DEPE_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;//se busca en el radicado donde sea like 'yyyyDEP%'
    $sWhere = $sWhere . "R.RADI_NUME_RADI LIKE '" . substr($ps_desde_RADI_FECH_RADI,6,4) . $ps_RADI_DEPE_RADI ."%'";
  }
  else
  {
    $bReq = false;
  }


  if($HasParam)
    $sWhere = " WHERE (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select R.RADI_DEPE_RADI as R_RADI_DEPE_RADI, " . 
    "R.RADI_DESC_ANEX as R_RADI_DESC_ANEX, " . 
    "to_char(R.RADI_FECH_RADI,'dd/mm/yyyy hh24:mi:ss') as R_RADI_FECH_RADI, " . 
    "R.RADI_NUME_HOJA as R_RADI_NUME_HOJA, " . 
    "R.RADI_NUME_RADI as R_RADI_NUME_RADI, " . 
    "R.RA_ASUN as R_RA_ASUN " . 
    " from RADICADO R ";
//-------------------------------

//-------------------------------
// RADICADO - Open Event begin
$sSQLCount = "Select count(*) as Total from radicado R " . $sWhere;
$db->query($sSQLCount);
$next_record = $db->next_record();
$fldTotal = $db->f("TOTAL");
// RADICADO - Open Event end
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
// Process if form has all required parameters
//-------------------------------
  if(!$bReq)
  {
?>
     <tr>
      
    <td colspan="5" class="DataTD" height="25"><font class="DataFONT">No records</font></td>
     </tr>
</table>
<?
    return;
  }
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  $db->query($sSQL);
  $next_record = $db->next_record();
//-------------------------------
// Process empty recordset
//-------------------------------
  if(!$next_record)
  {
?>
     <tr>
      <td colspan="5" class="DataTD"><font class="DataFONT">No records</font></td>
     </tr>
<?
   
?>
  </table>
<?

    return;
  }

//-------------------------------

?>
     <tr>
      <td colspan="5" class="DataTD"><font class="DataFONT"><b>Total Registros: <?=$fldTotal?></b></font></td>
     </tr>

<?

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iRecordsPerPage = 2000;
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Display grid based on recordset
//-------------------------------
  while($next_record  && $iCounter < $iRecordsPerPage)
  {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldRA_ASUN = $db->f("R_RA_ASUN");
    $fldRADI_DESC_ANEX = $db->f("R_RADI_DESC_ANEX");
    $fldRADI_FECH_RADI = $db->f("R_RADI_FECH_RADI");
    $fldRADI_NUME_HOJA = $db->f("R_RADI_NUME_HOJA");
    $fldRADI_NUME_RADI = $db->f("R_RADI_NUME_RADI");
    $next_record = $db->next_record();
    
//-------------------------------
// RADICADO Show begin
//-------------------------------

//-------------------------------
// RADICADO Show Event begin
// RADICADO Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_NUME_RADI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRA_ASUN) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_FECH_RADI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_NUME_HOJA) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_DESC_ANEX) ?>&nbsp;</font></td>
      </tr><?
//-------------------------------
// RADICADO Show end
//-------------------------------

//-------------------------------
// Move to the next record and increase record counter
//-------------------------------
    
    $iCounter++;
  }

 

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
    </table>
  <?


//-------------------------------
// RADICADO Close Event begin
// RADICADO Close Event end
//-------------------------------
}
//===============================

?>
</body>
</html>
