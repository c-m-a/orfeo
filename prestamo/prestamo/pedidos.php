<?php
/*********************************************************************************
 *       Filename: pedidos.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// pedidos CustomIncludes begin
session_start();
include ("./common.php");
include ("./encabezado.php");
// pedidos CustomIncludes end
//-------------------------------
//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "pedidos.php";
//===============================
//$db->conn->debug=true;

//===============================
// pedidos PageSecurity begin
 check_security();
// pedidos PageSecurity end
//===============================

//===============================
// pedidos Open Event begin
// pedidos Open Event end
//===============================

//===============================
// pedidos OpenAnyPage Event start
// pedidos OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// pedidos Show begin

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
<?php Search_show() ?>
    
   </td>
  </tr>
 </table>
 <table>
  <tr>
   <td valign="top">
<?php Pedidos_show() ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// pedidos Show end

//===============================
// pedidos Close Event begin
// pedidos Close Event end
//===============================
//********************************************************************************


//===============================
// Display Search Form
//-------------------------------
function Search_show()
{
 
  global $styles;
  
  global $sForm;
  $sFormTitle = "Búsqueda";
  $sActionFileName = "pedidos.php";
  $ss_DEPE_CODIDisplayValue = "";

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
      <td class="FormHeaderTD" colspan="7"><a name="Search"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Radicado</font></td>
      <td class="DataTD"><input type="text" name="s_RADI_NUME_RADI" maxlength="" value="<?= tohtml($flds_RADI_NUME_RADI) ?>" size="" ></td>
     </tr>
     <tr>
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Login Usuario</font></td>
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
     <td align="right" colspan="3"><input type="submit" value="Búsqueda"></td>
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
function Pedidos_show()
{
//-------------------------------
// Initialize variables  
//-------------------------------
  
  
  global $db;
  global $sPedidosErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Documentos Solicitados";
  $HasParam = false;
  $iRecordsPerPage = 20;
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
  $form_params = "s_DEPE_CODI=" . tourl(get_param("s_DEPE_CODI")) . "&s_RADI_NUME_RADI=" . tourl(get_param("s_RADI_NUME_RADI")) . "&s_USUA_LOGIN_ACTU=" . tourl(get_param("s_USUA_LOGIN_ACTU")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $iSort = get_param("FormPedidos_Sorting");
  $iSorted = get_param("FormPedidos_Sorted");
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
      $sSortParams = "FormPedidos_Sorting=" . $iSort . "&FormPedidos_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC";
      $sSortParams = "FormPedidos_Sorting=" . $iSort . "&FormPedidos_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by P.RADI_NUME_RADI" . $sDirection;
    if ($iSort == 2) $sOrder = " order by U.USUA_NOMB" . $sDirection;
    if ($iSort == 3) $sOrder = " order by D.DEPE_NOMB" . $sDirection;
    if ($iSort == 4) $sOrder = " order by P.PRES_FECH_PEDI" . $sDirection;
    if ($iSort == 5) $sOrder = " order by P.USUA_LOGIN_PRES" . $sDirection;
    if ($iSort == 6) $sOrder = " order by P.PRES_DESC" . $sDirection;
    if ($iSort == 7) $sOrder = " order by P.PRES_FECH_PRES" . $sDirection;
    if ($iSort == 8) $sOrder = " order by P.PRES_FECH_DEVO" . $sDirection;
    if ($iSort == 9) $sOrder = " order by P.PRES_REQUERIMIENTO" . $sDirection;
    if ($iSort == 10) $sOrder = " order by P.PRES_ESTADO" . $sDirection;
  }

//-------------------------------
// HTML column headers
//-------------------------------
?>
     <table class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="5"><a name="Pedidos"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
      </tr>
      <tr>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPedidos_Sorting=1&FormPedidos_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPedidos_Sorting=2&FormPedidos_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPedidos_Sorting=3&FormPedidos_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dependencia</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPedidos_Sorting=4&FormPedidos_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha Solicitud</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormPedidos_Sorting=9&FormPedidos_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Requerimiento</font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
  $ps_DEPE_CODI = get_param("s_DEPE_CODI");
  if(is_number($ps_DEPE_CODI) && strlen($ps_DEPE_CODI))
    $ps_DEPE_CODI = tosql($ps_DEPE_CODI, "Number");
  else 
    $ps_DEPE_CODI = "";

  if(strlen($ps_DEPE_CODI))
  {
    $HasParam = true;
    $sWhere = $sWhere . "P.DEPE_CODI=" . $ps_DEPE_CODI;
  }
  $ps_RADI_NUME_RADI = get_param("s_RADI_NUME_RADI");
  if(is_number($ps_RADI_NUME_RADI) && strlen($ps_RADI_NUME_RADI))
    $ps_RADI_NUME_RADI = $ps_RADI_NUME_RADI ; //tosql($ps_RADI_NUME_RADI, "Number");
  else 
    $ps_RADI_NUME_RADI = "";

  if(strlen($ps_RADI_NUME_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.RADI_NUME_RADI LIKE ('%" . $ps_RADI_NUME_RADI . "')";
  }
  $ps_USUA_LOGIN_ACTU = get_param("s_USUA_LOGIN_ACTU");

  if(strlen($ps_USUA_LOGIN_ACTU))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "P.USUA_LOGIN_ACTU like " . tosql("%".$ps_USUA_LOGIN_ACTU ."%", "Text");
  }


  if($HasParam)
    $sWhere = " AND (" . $sWhere . ")";


//-------------------------------
// Build base SQL statement
//-------------------------------
  $radiATexto = $db->conn->numToString("P.RADI_NUME_RADI");
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
    "U.USUA_LOGIN as U_USUA_LOGIN, " . 
    "U.USUA_NOMB as U_USUA_NOMB, " . 
    "D.DEPE_CODI as D_DEPE_CODI, " . 
    "D.DEPE_NOMB as D_DEPE_NOMB " . 
    " from PRESTAMO P, USUARIO U, DEPENDENCIA D"  . 
    " where U.USUA_LOGIN=P.USUA_LOGIN_ACTU and D.DEPE_CODI=P.DEPE_CODI  ";
//-------------------------------

//-------------------------------
// Pedidos Open Event begin
$depe=get_session("Dependencia");
$sWhere .= " AND P.PRES_ESTADO = 1 AND PRES_DEPE_ARCH=".$depe;
// Pedidos Open Event end
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
//$db->conn->debug=true;
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$rs=$db->query($sSQL);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);  
//-------------------------------
// Process empty recordset
//-------------------------------
  if(!$rs || $rs->EOF)
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
// Prepare the lists of values
//-------------------------------
  
  $aPRES_REQUERIMIENTO = split(";", "1;Documento;2;Anexo");
  $aPRES_ESTADO = split(";", "1;Solicitado;2;Prestado;3;Devuelto;4;Cancelado");
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
  $iPage = get_param("FormPedidos_Page");
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
  while( $rs && !$rs->EOF  && $iCounter < $iRecordsPerPage)
  {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldDEPE_CODI =$rs->fields["D_DEPE_NOMB"];
    $fldPRES_DESC =$rs->fields["P_PRES_DESC"];
    $fldPRES_FECH_PEDI =$rs->fields["P_PRES_FECH_PEDI"];
    $fldPRES_ID =$rs->fields["P_PRES_ID"];
    $fldPRES_REQUERIMIENTO =$rs->fields["P_PRES_REQUERIMIENTO"];
    $fldRADI_NUME_RADI_URLLink = "prestar.php";
    $fldRADI_NUME_RADI_PRES_ID =$rs->fields["P_PRES_ID"];
    $fldRADI_NUME_RADI =$rs->fields["P_RADI_NUME_RADI"];
    $fldUSUA_LOGIN_ACTU =$rs->fields["U_USUA_NOMB"];
    $rs->MoveNext();
    
//-------------------------------
// Pedidos Show begin
//-------------------------------

//-------------------------------
// Pedidos Show Event begin
// Pedidos Show Event end
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
      </tr><?
//-------------------------------
// Pedidos Show end
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
     <td colspan="10" class="ColumnTD"><font class="ColumnFONT">
<?
  
  // Pedidos Navigation begin
 
  if(($rs && !$rs->EOF ) || $iPage != 1)
  {
    $iCounter = 1;
    $iHasPages = $iPage;
    $sPages = "";
    $iDisplayPages = 0;
    $iNumberOfPages = 10;
    while(($rs || !$rs->EOF ) && $iHasPages < $iPage + $iNumberOfPages)
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
      $sPages .=  "<a href=\"$sFileName?$form_params$sSortParams$FormPedidos_Page=$iPageCount#Pedidos\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
      $iDisplayPages++;
    }
    
    $sPages .= "<font " . "class=\"ColumnFONT\"" . ">" . $iPage . "</font>&nbsp;";
    $iDisplayPages++;
    
    $iPageCount = $iPage + 1;
    while ($iDisplayPages < $iNumberOfPages && $iStartPage + $iDisplayPages < $iHasPages)
    {
      
      $sPages .= "<a href=\"" . $sFileName . "?" . $form_params . $sSortParams . "FormPedidos_Page=" . $iPageCount . "#Pedidos\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
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
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPedidos_Page=1#Pedidos"><font class="ColumnFONT">Primero</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPedidos_Page=<?=$iPage - 1?>#Pedidos"><font class="ColumnFONT">Anterior</font></a>
<?
    }
    echo "&nbsp;[&nbsp;" . $sPages . "]&nbsp;";
    
    if ($rs->EOF) {
?>
        <font class="ColumnFONT">Siguiente</font>
        <font class="ColumnFONT">Ultimo</font>
<?
    }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPedidos_Page=<?=$iPage + 1?>#Pedidos"><font class="ColumnFONT">Siguiente</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormPedidos_Page=last#Pedidos"><font class="ColumnFONT">Ultimo</font></a>
<?
    }
  }

//-------------------------------
// Pedidos Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </font></td></tr>
    </table>
  <?


//-------------------------------
// Pedidos Close Event begin
// Pedidos Close Event end
//-------------------------------
}
//===============================

?>
