<?php
/*********************************************************************************
 *       Filename: historico.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// historico CustomIncludes begin
include ("./common.php");

// historico CustomIncludes end
//-------------------------------
error_reporting(0);
session_start();
//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "historico.php";
//===============================


//===============================
// historico PageSecurity begin
//check_security();
// historico PageSecurity end
//===============================

//===============================
// historico Open Event begin
// historico Open Event end
//===============================

//===============================
// historico OpenAnyPage Event start
// historico OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// historico Show begin

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
<?php HIST_EVENTOS_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// historico Show end

//===============================
// historico Close Event begin
// historico Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function HIST_EVENTOS_show()
{
//-------------------------------
// Initialize variables  
//-------------------------------
  
  
  global $db;
  global $sHIST_EVENTOSErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Historico";
  $HasParam = false;
  $bReq = true;
  $iRecordsPerPage = 20;
  $iCounter = 0;
  $iPage = 0;
  $bEof = false;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";

  $transit_params = "";
  $form_params = "radicado=" . tourl(get_param("radicado")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by H.HIST_FECH Asc";
  $iSort = get_param("FormHIST_EVENTOS_Sorting");
  $iSorted = get_param("FormHIST_EVENTOS_Sorted");
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
      $sSortParams = "FormHIST_EVENTOS_Sorting=" . $iSort . "&FormHIST_EVENTOS_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormHIST_EVENTOS_Sorting=" . $iSort . "&FormHIST_EVENTOS_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by H.RADI_NUME_RADI" . $sDirection;
    if ($iSort == 2) $sOrder = " order by H.HIST_FECH" . $sDirection;
    if ($iSort == 3) $sOrder = " order by U.USUA_NOMB" . $sDirection;
    if ($iSort == 4) $sOrder = " order by D.DEPE_NOMB" . $sDirection;
    if ($iSort == 5) $sOrder = " order by H.HIST_OBSE" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>

     <table class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="5"><a name="HIST_EVENTOS"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
	 </tr>
<? 
	  $pradicado = get_param("radicado");
	  $queryUsuActu = "select U.USUA_LOGIN AS U_USUA_LOGIN, U.USUA_NOMB AS U_USUA_NOMB from RADICADO R, USUARIO U, DEPENDENCIA D"  . 
    " WHERE U.USUA_CODI=R.RADI_USUA_ACTU and D.DEPE_CODI=R.RADI_DEPE_ACTU and U.DEPE_CODI=D.DEPE_CODI and R.RADI_NUME_RADI= $pradicado";
	  $db->query($queryUsuActu);
	  $next_record = $db->next_record();
	  if ($next_record){
	    $fldUSUA_LOGIN = $db->f("U_USUA_LOGIN");
		$fldUSUA_NOMB = $db->f("U_USUA_NOMB");
?>	  
	 <tr>
	   <td class="ColumnTD" colspan="5">
	   <font class="ColumnFONT">El usuario Actual es <?=$fldUSUA_LOGIN?> / <?=$fldUSUA_NOMB?>
	   </font></td>
      </tr>
<?	  }
?>
	  <tr>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormHIST_EVENTOS_Sorting=1&FormHIST_EVENTOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormHIST_EVENTOS_Sorting=2&FormHIST_EVENTOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormHIST_EVENTOS_Sorting=3&FormHIST_EVENTOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Codigo Usuario</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormHIST_EVENTOS_Sorting=4&FormHIST_EVENTOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dependencia</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormHIST_EVENTOS_Sorting=5&FormHIST_EVENTOS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Observaciones</font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
  $pradicado = get_param("radicado");

  if(strlen($pradicado))
  {
    $HasParam = true;
    $sWhere = $sWhere . "H.RADI_NUME_RADI=" . tosql($pradicado, "Text") . "";
  }
  else
  {
    $bReq = false;
  }


  if($HasParam)
    $sWhere = " AND (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $sSQL = "select H.DEPE_CODI as H_DEPE_CODI, " . 
    "to_char(H.HIST_FECH,'dd/mm/yyyy hh24:mi:ss') as H_HIST_FECH, " . 
    "H.HIST_OBSE as H_HIST_OBSE, " . 
    "H.RADI_NUME_RADI as H_RADI_NUME_RADI, " . 
    "H.USUA_CODI as H_USUA_CODI, " . 
    "U.USUA_CODI as U_USUA_CODI, " . 
    "U.USUA_NOMB as U_USUA_NOMB, " . 
    "U.DEPE_CODI as U_DEPE_CODI, " . 
    "D.DEPE_CODI as D_DEPE_CODI, " . 
    "D.DEPE_NOMB as D_DEPE_NOMB " . 
    " from HIST_EVENTOS H, USUARIO U, DEPENDENCIA D"  . 
    " where U.USUA_CODI=H.USUA_CODI and D.DEPE_CODI=H.DEPE_CODI and U.DEPE_CODI=D.DEPE_CODI  ";
//-------------------------------

//-------------------------------
// HIST_EVENTOS Open Event begin
// HIST_EVENTOS Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
//-------------------------------

  

//-------------------------------
// Process if form has all required parameters
//-------------------------------
  if(!$bReq)
  {
?>
     <tr>
      <td colspan="5" class="DataTD"><font class="DataFONT">No hay Registros</font></td>
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
      <td colspan="5" class="DataTD"><font class="DataFONT">No hay Registros</font></td>
     </tr>
<?
 
//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="5" class="ColumnTD"><font class="ColumnFONT">
<?
  
?>
  </table>
<?

    return;
  }

//-------------------------------

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iRecordsPerPage = 20;
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Process page scroller
//-------------------------------
  $iPage = get_param("FormHIST_EVENTOS_Page");
  if(!strlen($iPage)) $iPage = 1; else $iPage = intval($iPage);

  if(($iPage - 1) * $iRecordsPerPage != 0)
  {
    do
    {
      $iCounter++;
    } while ($iCounter < ($iPage - 1) * $iRecordsPerPage && $db->next_record());
    $next_record = $db->next_record();
  }

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
    $fldDEPE_CODI = $db->f("D_DEPE_NOMB");
    $fldHIST_FECH = $db->f("H_HIST_FECH");
    $fldHIST_OBSE = $db->f("H_HIST_OBSE");
    $fldRADI_NUME_RADI = $db->f("H_RADI_NUME_RADI");
    $fldUSUA_CODI = $db->f("U_USUA_NOMB");
    $next_record = $db->next_record();
    
//-------------------------------
// HIST_EVENTOS Show begin
//-------------------------------

//-------------------------------
// HIST_EVENTOS Show Event begin
// HIST_EVENTOS Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_NUME_RADI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= $fldHIST_FECH ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_CODI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDEPE_CODI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldHIST_OBSE) ?>&nbsp;</font></td>
      </tr><?
//-------------------------------
// HIST_EVENTOS Show end
//-------------------------------

//-------------------------------
// Move to the next record and increase record counter
//-------------------------------
    
    $iCounter++;
  }

 
//-------------------------------
//  Grid. The insert link and record navigator.
//-------------------------------
?>
    <tr>
     <td colspan="5" class="ColumnTD"><font class="ColumnFONT">
<?
  
  // HIST_EVENTOS Navigation begin
  $bEof = $next_record;
  if($bEof || $iPage != 1)
  {
    if ($iPage == 1) {
?>
        <font class="ColumnFONT">Anterior</font>
<? }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormHIST_EVENTOS_Page=<?=$iPage - 1?>#HIST_EVENTOS"><font class="ColumnFONT">Anterior</font></a>
<?
    }
    echo "&nbsp;[&nbsp;" . $iPage . "&nbsp;]&nbsp;";
    
    if (!$bEof) {
?>
        <font class="ColumnFONT">Siguiente</font>
<?
    }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormHIST_EVENTOS_Page=<?=$iPage + 1?>#HIST_EVENTOS"><font class="ColumnFONT">Siguiente</font></a>
<?
    }
  }

//-------------------------------
// HIST_EVENTOS Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </font></td></tr>
    </table>
  <?


//-------------------------------
// HIST_EVENTOS Close Event begin
// HIST_EVENTOS Close Event end
//-------------------------------
}
//===============================

?>
