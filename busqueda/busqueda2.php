<?php
error_reporting(0);
session_start();
$ruta_raiz="..";
if (!$krd or !$dependencia)   include "../rec_session.php";
//echo "--------$krd--------->".session_id();
/*********************************************************************************
 *       Filename: busqueda2.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// busqueda CustomIncludes begin

include ("common.php");
$fechah = date("ymd") . "_" . time("hms");
// busqueda CustomIncludes end
//-------------------------------


//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "busqueda2.php";
//===============================


//===============================
// busqueda PageSecurity begin

//$usu = get_param("usu");
$usu = $krd;
//$niv = get_param("niv");
$niv = 5;

if (strlen($usu) && strlen($niv)){
  set_session("UserID",$usu);
  set_session("krd",$krd);
  set_session("Nivel",$niv);
}

//check_security();
// busqueda PageSecurity end
//===============================

//===============================
// busqueda Open Event begin
// busqueda Open Event end
//===============================

//===============================
// busqueda OpenAnyPage Event start
// busqueda OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$krd = get_param("krd");
$sForm = get_param("FormName");
  $flds_ciudadano = strip(get_param("s_ciudadano"));
  $flds_empresaESP = strip(get_param("s_empresaESP"));
  $flds_oEmpresa = strip(get_param("s_oEmpresa"));

//===============================

// busqueda Show begin

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
<?php Search_show() ?>
    
   </td>
   <td valign="top"><font class="FieldCaptionFONT"><a href="busquedaHist.php?<?=session_name()."=".session_id()."&fechah=$fechah&krd=$krd" ?>">B&uacute;squeda por hist&oacute;rico</a><br><a href="busquedaUsuActu.php?<?=session_name()."=".session_id()."&fechah=$fechah&krd=$krd" ?>">Reporte por Usuarios</a></font></td>
  </tr>
 </table>
 <table>
  <tr>
   <td valign="top">
<? if($flds_ciudadano=="CIU" || 
		( !strlen($flds_ciudadano) && !strlen($flds_empresaESP) && !strlen($flds_oEmpresa) ) )Ciudadano_show(); ?>
   </td>
  </tr>
  <tr>
   <td valign="top">
<? if($flds_empresaESP=="ESP") EmpresaESP_show(); ?>
    
   </td>
  </tr>
  <tr>
   <td valign="top">
<? if($flds_oEmpresa=="OEM") OtrasEmpresas_show(); ?>
    
   </td>
  </tr>
 </table>


</body>
</html>
<?php

// busqueda Show end

//===============================
// busqueda Close Event begin
// busqueda Close Event end
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
  $sActionFileName = "busqueda2.php";
  $ss_desde_RADI_FECH_RADIDisplayValue = "";
  $ss_hasta_RADI_FECH_RADIDisplayValue = "";
  $ss_TDOC_CODIDisplayValue = "";
  $ss_RADI_DEPE_ACTUDisplayValue = "";

//-------------------------------
// Search Open Event begin
// Search Open Event end
//-------------------------------
//-------------------------------
// Set variables with search parameters
//-------------------------------
  $flds_RADI_NUME_RADI = strip(get_param("s_RADI_NUME_RADI"));
  $flds_RADI_NOMB = strip(get_param("s_RADI_NOMB"));
  $krd = strip(get_param("krd"));
  $flds_ciudadano = strip(get_param("s_ciudadano"));
  $flds_empresaESP = strip(get_param("s_empresaESP"));
  $flds_oEmpresa = strip(get_param("s_oEmpresa"));
  $flds_entrada = strip(get_param("s_entrada"));
  $flds_salida = strip(get_param("s_salida"));
  $flds_solo_nomb = strip(get_param("s_solo_nomb"));
  $flds_desde_dia = strip(get_param("s_desde_dia"));
  $flds_hasta_dia = strip(get_param("s_hasta_dia"));
  $flds_desde_mes = strip(get_param("s_desde_mes"));
  $flds_hasta_mes = strip(get_param("s_hasta_mes"));
  $flds_desde_ano = strip(get_param("s_desde_ano"));
  $flds_hasta_ano = strip(get_param("s_hasta_ano"));
  $flds_TDOC_CODI = strip(get_param("s_TDOC_CODI"));
  $flds_RADI_DEPE_ACTU = strip(get_param("s_RADI_DEPE_ACTU"));
 
  if (strlen($flds_desde_dia) && strlen($flds_hasta_dia) && 
      strlen($flds_desde_mes) && strlen($flds_hasta_mes) && 
      strlen($flds_desde_ano) && strlen($flds_hasta_ano) ) {
    $desdeTimestamp = mktime(0,0,0,$flds_desde_mes, $flds_desde_dia, $flds_desde_ano);
    $hastaTimestamp = mktime(0,0,0,$flds_hasta_mes, $flds_hasta_dia, $flds_hasta_ano);
    $flds_desde_dia = Date('d',$desdeTimestamp);
    $flds_hasta_dia = Date('d',$hastaTimestamp);
    $flds_desde_mes = Date('m',$desdeTimestamp);
    $flds_hasta_mes = Date('m',$hastaTimestamp);
    $flds_desde_ano = Date('Y',$desdeTimestamp);
    $flds_hasta_ano = Date('Y',$hastaTimestamp);
  }
  else { /*DESDE HACE UN MES HASTA HOY */
    $desdeTimestamp = mktime(0,0,0, Date('m')-1,  Date('d'),  Date('Y'));
    $flds_desde_dia = Date('d', $desdeTimestamp);
    $flds_hasta_dia = Date('d');
    $flds_desde_mes = Date('m', $desdeTimestamp);
    $flds_hasta_mes = Date('m');
    $flds_desde_ano = Date('Y', $desdeTimestamp);
    $flds_hasta_ano = Date('Y');
  }
//-------------------------------
// Search Show begin
//-------------------------------


//-------------------------------
// Search Show Event begin
// Search Show Event end
//-------------------------------
?>
<form method="post" action="<?= $sActionFileName ?>?<?=session_name()."=".session_id()?>&dependencia=<?=$dependencia?>&krd=<?=$krd?>" name="Search">
<input type="hidden" name=<?=session_name()?> value=<?=session_id()?>>
<input type="hidden" name=krd value=<?=$krd?>>	
<input type="hidden" name="FormName" value="Search"><input type="hidden" name="FormAction" value="search">
<table class="FormTABLE">
<tr>
  <td class="FormHeaderTD" colspan="13"><a name="Search"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
</tr>
<tr>
  <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Radicado</font></td>
  <td class="DataTD"><input class="DataFONT" type="text" name="s_RADI_NUME_RADI" maxlength="" value="<?=tohtml($flds_RADI_NUME_RADI) ?>" size="" ></td>
</tr>
<tr>
  <td class="FieldCaptionTD">
  <font class="FieldCaptionFONT">
  <INPUT type="radio" NAME="s_solo_nomb" value="All" CHECKED
  <?if($flds_solo_nomb=="All"){ echo ("CHECKED");} ?>>Todas las palabras (y)<br>
  <INPUT type="radio" NAME="s_solo_nomb" value="Any" 
  <? if($flds_solo_nomb=="Any"){echo ("CHECKED");} ?>>Cualquier Palabra (o)<br>
  </font></td>
 
  <td class="DataTD"><input class="DataFONT" type="text" name="s_RADI_NOMB" maxlength="70" value="<?=tohtml($flds_RADI_NOMB) ?>" size="70" ></td>
</tr>
<tr>
  <td colspan="2" class="FieldCaptionTD"><table><tr>
  <td><font class="FieldCaptionFONT">
    <INPUT type="checkbox" NAME="s_ciudadano" value="CIU" 
	<?if($flds_ciudadano=="CIU" || (!strlen($flds_ciudadano)&&!strlen($flds_empresaESP)&&!strlen($flds_oEmpresa)))
	  { echo ("CHECKED");} ?>>Buscar en Ciudadanos</font></td>
  <td><font class="FieldCaptionFONT">
    <INPUT type="checkbox" NAME="s_empresaESP" value="ESP" 
	<?if($flds_empresaESP=="ESP" || (!strlen($flds_ciudadano)&&!strlen($flds_empresaESP)&&!strlen($flds_oEmpresa)))
	  { echo ("CHECKED");} ?>>Buscar en Empresas ESP</font></td>
  <td><font class="FieldCaptionFONT">
    <INPUT type="checkbox" NAME="s_oEmpresa" value="OEM" 
	<?if($flds_oEmpresa=="OEM" || (!strlen($flds_ciudadano)&&!strlen($flds_empresaESP)&&!strlen($flds_oEmpresa)))
	  { echo ("CHECKED");} ?>>Buscar en otras empresas</font></td>
  </tr></table></td>
</tr>
<tr>
  <td colspan="2" class="FieldCaptionTD">
  <table><tr>
  <td><font class="FieldCaptionFONT">
    <INPUT type="checkbox" NAME="s_entrada" value="ENT" 
	<?if($flds_entrada=="ENT" || (!strlen($flds_entrada)&&!strlen($flds_salida)))
	  { echo ("CHECKED");} ?>>Radicados de Entrada</font></td>
  <td><font class="FieldCaptionFONT">
    <INPUT type="checkbox" NAME="s_salida" value="SAL" 
	<?if($flds_salida=="SAL" || (!strlen($flds_entrada)&&!strlen($flds_salida)))
	  { echo ("CHECKED");} ?>>Radicados de Salida</font></td>
  </tr>
  </table></td>
</tr>

<tr>
  <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Desde Fecha (dd/mm/yyyy)</font></td>

  <td class="DataTD">
<select class="DataFONT" name="s_desde_dia">
  <?
  for($i = 1; $i <= 31; $i++)
  {
    if($i == $flds_desde_dia) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?></select>
  <select class="DataFONT" name="s_desde_mes">
  <?
  for($i = 1; $i <= 12; $i++)
  {
    if($i == $flds_desde_mes) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?></select>
  <select class="DataFONT" name="s_desde_ano">
  <?
  $agnoactual=Date('Y');
  for($i = 2003; $i <= $agnoactual; $i++)
  {
    if($i == $flds_desde_ano) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
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
    if($i == $flds_hasta_dia) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?></select>
  <select class="DataFONT" name="s_hasta_mes">
  <?
  for($i = 1; $i <= 12; $i++)
  {
    if($i == $flds_hasta_mes) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?></select>
  <select class="DataFONT" name="s_hasta_ano">
  <?
  for($i = 2003; $i <= $agnoactual; $i++)
  {
    if($i == $flds_hasta_ano) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?></select></td>
</tr>
<tr>
  <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Tipo de Documento</font></td>

  <td class="DataTD"><select class="DataFONT" name="s_TDOC_CODI">
  <?
  if ($flds_TDOC_CODI==0) $flds_TDOC_CODI="9999";
  echo "<option value=\"9999\">" . $ss_TDOC_CODIDisplayValue . "</option>";
  $lookup_s_TDOC_CODI = db_fill_array("select SGD_TPR_CODIGO, SGD_TPR_DESCRIP from SGD_TPR_TPDCUMENTO order by SGD_TPR_DESCRIP");

  if(is_array($lookup_s_TDOC_CODI))
  {
    reset($lookup_s_TDOC_CODI);
    while(list($key, $value) = each($lookup_s_TDOC_CODI))
    {
      if($key == $flds_TDOC_CODI) $option="<option SELECTED value=\"$key\">$value";
      else $option="<option value=\"$key\">$value";
      echo $option;
    }
  }
  ?></select></td>
</tr>
<tr>
  <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Dependencia Actual</font></td>

  <td class="DataTD"><select class="DataFONT" name="s_RADI_DEPE_ACTU">
  <?
  echo "<option value=\"\">" . $ss_RADI_DEPE_ACTUDisplayValue . "</option>";
  $lookup_s_RADI_DEPE_ACTU = db_fill_array("select DEPE_CODI, DEPE_NOMB from DEPENDENCIA order by 2");

  if(is_array($lookup_s_RADI_DEPE_ACTU))
  {
    reset($lookup_s_RADI_DEPE_ACTU);
    while(list($key, $value) = each($lookup_s_RADI_DEPE_ACTU))
    {
      if($key == $flds_RADI_DEPE_ACTU) $option="<option SELECTED value=\"$key\">$value";
      else $option="<option value=\"$key\">$value";
      echo $option;
    }
  }
  ?></select></td>
</tr>
<tr>
  <td align="right" colspan="3"><input class="DataFONT" type="submit" value="Búsqueda"></td>
</tr>
</table>
</form>
<?
//-------------------------------
// Search Show end
//-------------------------------
//===============================
}


//===============================
// Display Grid Form
//-------------------------------
function Ciudadano_show()
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
  $sFormTitle = "Radicados encontrados por ciudadano";
  $HasParam = false;
  $iRecordsPerPage = 25;
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
  $form_params = trim(session_name())."=".trim(session_id())."&krd=$krd&s_RADI_DEPE_ACTU=" . tourl(get_param("s_RADI_DEPE_ACTU")) . "&s_RADI_NOMB=" . tourl(get_param("s_RADI_NOMB")) . "&s_RADI_NUME_RADI=" . tourl(get_param("s_RADI_NUME_RADI")) . "&s_TDOC_CODI=" . tourl(get_param("s_TDOC_CODI")) . "&s_desde_dia=" . tourl(get_param("s_desde_dia")) . "&s_desde_mes=" . tourl(get_param("s_desde_mes")) . "&s_desde_ano=" . tourl(get_param("s_desde_ano")) . "&s_hasta_dia=" . tourl(get_param("s_hasta_dia")) . "&s_hasta_mes=" . tourl(get_param("s_hasta_mes")) . "&s_hasta_ano=" . tourl(get_param("s_hasta_ano")) . "&s_solo_nomb=" . tourl(get_param("s_solo_nomb")) . "&s_ciudadano=" . tourl(get_param("s_ciudadano")) . "&s_empresaESP=" . tourl(get_param("s_empresaESP")) . "&s_oEmpresa=" . tourl(get_param("s_oEmpresa")) . "&s_entrada=" . tourl(get_param("s_entrada")) . "&s_salida=" . tourl(get_param("s_salida")) .  "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by R.RADI_NUME_RADI Asc";
  $iSort = get_param("FormCIUDADANO_Sorting");
  $iSorted = get_param("FormCIUDADANO_Sorted");
  $krd = strip(get_param("krd")); 
  if(!$iSort)
  {
    $form_sorting = "";
  }
  else
  {
    if($iSort == $iSorted)
    {
      $form_sorting = "";
      $sDirection = " DESC ";
      $sSortParams = "FormCIUDADANO_Sorting=" . $iSort . "&FormCIUDADANO_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC ";
      $sSortParams = "FormCIUDADANO_Sorting=" . $iSort . "&FormCIUDADANO_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by r.radi_nume_radi" . $sDirection;
    if ($iSort == 2) $sOrder = " order by r.radi_fech_radi" . $sDirection;
    if ($iSort == 3) $sOrder = " order by r.ra_asun" . $sDirection; 
    if ($iSort == 4) $sOrder = " order by td.sgd_tpr_descrip" . $sDirection;
    if ($iSort == 5) $sOrder = " order by r.radi_nume_hoja" . $sDirection;
    if ($iSort == 6) $sOrder = " order by dir.sgd_dir_direccion" . $sDirection;
    if ($iSort == 7) $sOrder = " order by dir.sgd_dir_telefono" . $sDirection;
	if ($iSort == 8) $sOrder = " order by dir.sgd_dir_mail" . $sDirection;
	if ($iSort == 9) $sOrder = " order by ciu.sgd_ciu_nombre" . $sDirection;
	if ($iSort == 10) $sOrder = " order by ciu.sgd_ciu_apell1" . $sDirection;
	if ($iSort == 11) $sOrder = " order by ciu.sgd_ciu_apell2" . $sDirection;
	if ($iSort == 12) $sOrder = " order by ciu.sgd_ciu_telefono" . $sDirection;
    if ($iSort == 13) $sOrder = " order by ciu.sgd_ciu_direccion" . $sDirection;
    if ($iSort == 14) $sOrder = " order by ciu.sgd_ciu_cedula" . $sDirection;
    if ($iSort == 15) $sOrder = " order by u1.usua_nomb" . $sDirection; 
    if ($iSort == 16) $sOrder = " order by d1.depe_nomb" . $sDirection;
    if ($iSort == 17) $sOrder = " order by r.radi_usu_ante" . $sDirection;
//    if ($iSort == 18) $sOrder = " order by muni.muni_nomb" . $sDirection;
//    if ($iSort == 19) $sOrder = " order by dpto.dpto_nomb" . $sDirection;
	if ($iSort == 20) $sOrder = " order by r.radi_pais" . $sDirection;
	if ($iSort == 21) $sOrder = " order by diasr" . $sDirection;
	if ($iSort == 22) $sOrder = " order by dir.sgd_dir_nombre" . $sDirection;
  }

//-------------------------------
// Encabezados HTML de las Columnas
//-------------------------------
?>
     <table width="2000" class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="20"><a name="RADICADO"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
      </tr>
      <tr>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=1&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=2&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha Radicaci&oacute;n</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=3&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Asunto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=4&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Tipo de Documento</font></a></td>	   
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=5&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Numero de Hojas</font></a></td>	   
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=6&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Direccion contacto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=7&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Tel&eacute;fono contacto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=8&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Mail Contacto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=9&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Nombre Ciudadano</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=10&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Apellido 1</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=11&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Apellido 2</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=12&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Telefono Ciudadano</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=13&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Direccion Ciudadano</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=14&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Cedula Ciudadano</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=15&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Actual</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=16&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dependencia Actual</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=17&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Anterior</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=22&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Firmante</font></a></td>
	   <!--td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=18&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Municipio</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=19&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Departamento</font></a></td-->
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=20&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Pais</font></a></td>
  	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=21&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dias Restantes</font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
// Se crea la $ps_desde_RADI_FECH_RADI con los datos ingresados.
//------------------------------------
  
  $ps_desde_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(0,0,0,get_param("s_desde_mes"),get_param("s_desde_dia"),get_param("s_desde_ano")));
  $ps_hasta_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(23,59,59,get_param("s_hasta_mes"),get_param("s_hasta_dia"),get_param("s_hasta_ano")));
  if(strlen($ps_desde_RADI_FECH_RADI) && strlen($ps_hasta_RADI_FECH_RADI))
  {
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_fech_radi>=to_date('" .$ps_desde_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
    $sWhere .= " and ";
    $sWhere = $sWhere . "r.radi_fech_radi<=to_date('" . $ps_hasta_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
  }

/* Se recibe la dependencia actual para búsqueda */

  $ps_RADI_DEPE_ACTU = get_param("s_RADI_DEPE_ACTU");
  if(is_number($ps_RADI_DEPE_ACTU) && strlen($ps_RADI_DEPE_ACTU))
	$ps_RADI_DEPE_ACTU = tosql($ps_RADI_DEPE_ACTU, "Number");
  else $ps_RADI_DEPE_ACTU = "";

  if(strlen($ps_RADI_DEPE_ACTU))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_depe_actu=" . $ps_RADI_DEPE_ACTU;
  }

 /* Se recibe el número del radicado para búsqueda */
  $ps_RADI_NUME_RADI = get_param("s_RADI_NUME_RADI");
  if(strlen($ps_RADI_NUME_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%".$ps_RADI_NUME_RADI ."%", "Text");
  }

/* Se decide si busca en radicado de entrada o de salida o ambos */
  $ps_entrada = strip(get_param("s_entrada"));
  if(strlen($ps_entrada) && $ps_entrada="ENT"){
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%2", "Text");
  }
  $ps_salida = strip(get_param("s_salida"));
  if(strlen($ps_salida) && $ps_salida="SAL"){
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%1", "Text");
  }


/* Se recibe el tipo de documento para la búsqueda */
  $ps_TDOC_CODI = get_param("s_TDOC_CODI");
  if(is_number($ps_TDOC_CODI) && strlen($ps_TDOC_CODI) && $ps_TDOC_CODI != "9999")
    $ps_TDOC_CODI = tosql($ps_TDOC_CODI, "Number");
  else $ps_TDOC_CODI = "";
  if(strlen($ps_TDOC_CODI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.tdoc_codi=" . $ps_TDOC_CODI;
  }

 /* Se recibe la caadena a buscar y el tipo de busqueda (All) (Any) */
  $ps_RADI_NOMB = strip(get_param("s_RADI_NOMB"));
  $ps_solo_nomb = get_param("s_solo_nomb");
  $yaentro=false;
  if(strlen($ps_RADI_NOMB) && $ps_solo_nomb == "All")
  {
    if($sWhere != "") 
      $sWhere .= " and (";
	$HasParam=true;
	$sWhere .= "dir.sgd_ciu_codigo IN (SELECT sgd_ciu_codigo FROM sgd_ciu_ciudadano c WHERE ";

	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(c.sgd_ciu_nombre||c.sgd_ciu_apell1||c.sgd_ciu_apell2||c.sgd_ciu_telefono||c.sgd_ciu_cedula||c.sgd_ciu_direccion) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .=")";
	$sWhere .= " or (";
    $yaentro=false;
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(r.ra_asun||dir.sgd_dir_nombre) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .="))";

  }

  if(strlen($ps_RADI_NOMB) && $ps_solo_nomb == "Any")
  {
    if($sWhere != "") 
      $sWhere .= " and (";
	$HasParam=true;
	$sWhere .= "dir.sgd_ciu_codigo IN (SELECT sgd_ciu_codigo FROM sgd_ciu_ciudadano c WHERE ";

	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " or ";
		}
		$sWhere .= "UPPER(c.sgd_ciu_nombre||c.sgd_ciu_apell1||c.sgd_ciu_apell2||c.sgd_ciu_telefono||c.sgd_ciu_cedula||c.sgd_ciu_direccion) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .=")";
	$sWhere .= " or (";
    $yaentro=false;
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " or ";
		}
		$sWhere .= "UPPER(r.ra_asun||dir.sgd_dir_nombre) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .="))";
  }

  if($HasParam)
    $sWhere = " AND (" . $sWhere . ") ";
	
//-------------------------------
// Build base SQL statement
//-------------------------------

$sSQL = "SELECT r.radi_nume_radi, r.radi_fech_radi, r.ra_asun,
td.sgd_tpr_descrip, round(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-sysdate)) as diasr, 
r.radi_nume_hoja, 
r.radi_path, 
dir.sgd_dir_direccion, dir.sgd_dir_telefono, dir.sgd_dir_mail,dir.sgd_dir_nombre,
ciu.sgd_ciu_nombre, ciu.sgd_ciu_apell1, ciu.sgd_ciu_apell2, 
ciu.sgd_ciu_telefono, 
ciu.sgd_ciu_direccion,
ciu.sgd_ciu_cedula, 
u1.usua_login AS login_actu, u1.usua_nomb AS nomb_actu, d1.depe_nomb AS depe_actu,
r.radi_usu_ante,
r.radi_pais
FROM sgd_dir_drecciones dir, radicado r, sgd_tpr_tpdcumento td, usuario u1, dependencia d1,
sgd_ciu_ciudadano ciu
WHERE dir.SGD_DIR_TIPO = 1 AND dir.radi_nume_radi=r.radi_nume_radi AND r.tdoc_codi=td.sgd_tpr_codigo
AND r.radi_usua_actu=u1.usua_codi AND r.radi_depe_actu=u1.depe_codi AND u1.depe_codi=d1.depe_codi
AND (dir.sgd_ciu_codigo=ciu.sgd_ciu_codigo AND NVL(dir.sgd_ciu_codigo,0)!=0 AND NVL(dir.sgd_oem_codigo,0)=0 AND NVL(dir.sgd_esp_codi,0)=0)
";
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
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
      <td colspan="20" class="DataTD"><font class="DataFONT">No hay resultados</font></td>
     </tr>
<?
 
//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="20" class="ColumnTD"><font class="ColumnFONT">
<?
  
?>
  </table>
<?

    return;
  }

//-------------------------------

?>
     <!--tr>
      <td colspan="10" class="DataTD"><font class="DataFONT"><b>Total Registros Encontrados: <?=$fldTotal?></b></font></td>
     </tr-->

<?

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Process page scroller
//-------------------------------
  $iPage = get_param("FormCIUDADANO_Page");

  if(!strlen($iPage)) $iPage = 1;
  else
  {
    if($iPage == "last")
    {
      $db_count = get_db_value($sCountSQL);
      $dResult = intval($db_count) / $iRecordsPerPage;
      $iPage = intval($dResult);
      if($iPage < $dResult) $iPage++;
    }
    else $iPage = intval($iPage);
  }
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

//$ruta_raiz ="..";
//include "../config.php";
//include "../jh_class/funciones_sgd.php";
//-------------------------------
// Display grid based on recordset
//-------------------------------.

while($next_record  && $iCounter < $iRecordsPerPage)
 {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldRADI_NUME_RADI = $db->f("RADI_NUME_RADI");
    $fldRADI_FECH_RADI = $db->f("RADI_FECH_RADI");
	$fldASUNTO = $db->f("RA_ASUN");
    $fldTIPO_DOC = $db->f("SGD_TPR_DESCRIP");
    $fldNUME_HOJAS = $db->f("RADI_NUME_HOJA");
    $fldRADI_PATH = $db->f("RADI_PATH");
    $fldDIRECCION_C = $db->f("SGD_DIR_DIRECCION");
    $fldTELEFONO_C = $db->f("SGD_DIR_TELEFONO");
    $fldMAIL_C = $db->f("SGD_DIR_MAIL");
    $fldNOMBRE = $db->f("SGD_CIU_NOMBRE");
    $fldAPELLIDO1 = $db->f("SGD_CIU_APELL1");
    $fldAPELLIDO2 = $db->f("SGD_CIU_APELL2");
    $fldTELEFONO = $db->f("SGD_CIU_TELEFONO");
    $fldDIRECCION = $db->f("SGD_CIU_DIRECCION");
    $fldCEDULA = $db->f("SGD_CIU_CEDULA");
    $fldUSUA_ACTU = $db->f("NOMB_ACTU") . " - (" . $db->f("LOGIN_ACTU").")";
    $fldDEPE_ACTU = $db->f("DEPE_ACTU");
    $fldUSUA_ANTE = $db->f("RADI_USU_ANTE");
//  $fldMUNI_NOMB = $db->f("MUNI_NOMB");
//	$fldDPTO_NOMB = $db->f("DPTO_NOMB");
	$fldPAIS = $db->f("RADI_PAIS");
	$fldDIASR = $db->f("DIASR");
	$fldFirmante = $db->f("sgd_dir_nombre");
    $next_record = $db->next_record();
    
//-------------------------------
// Show begin
//-------------------------------

//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="DataTD"><font class="DataFONT">
	  <? if (strlen($fldRADI_PATH)){ $iii = $iii +1;?>  <a href='../bodega<?=$fldRADI_PATH?>' target='Imagen<?=$iii?>'><?}?>
	   <font class="DataFONT"><?=$fldRADI_NUME_RADI?></font>
	  <?if (strlen($fldRADI_PATH)){?></a><?}?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT"><a href="../verradicado.php?verrad=<?=$fldRADI_NUME_RADI."&".session_name()."=".session_id()."&krd=$krd&carpeta=8&nomcarpeta=Busquedas&tipo_carp=0"?>">
      <?= tohtml($fldRADI_FECH_RADI) ?>&nbsp;</a></font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldASUNTO) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTIPO_DOC) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNUME_HOJAS) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDIRECCION_C) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTELEFONO_C) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldMAIL_C) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNOMBRE) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldAPELLIDO1) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldAPELLIDO2) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTELEFONO) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDIRECCION) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldCEDULA) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_ACTU) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDEPE_ACTU) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_ANTE) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldFirmante) ?>&nbsp;</font></td>
	  <!--td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldMUNI_NOMB); ?>&nbsp;</font></td>	  
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDPTO_NOMB); ?>&nbsp;</font></td-->	  
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldPAIS); ?>&nbsp;</font></td>	  
      <td class="DataTD"><font class="DataFONT">
      <? if ($fldRADI_DEPE_ACTU!=999){ echo tohtml($fldDIASR);} else {echo "Sal";} ?>&nbsp;</font></td>	  
     </tr>
	  <?
    $iCounter++;

  } 
 
//-------------------------------
//  Record navigator.
//-------------------------------
?>
    <tr>
     <td colspan="20" class="ColumnTD"><font class="ColumnFONT">
<?
  
  // Navigation begin
  $bEof = $next_record;

  if($bEof || $iPage != 1) 
  {
    $iCounter = 1;
    $iHasPages = $iPage;
    $sPages = "";
    $iDisplayPages = 0;  
    $iNumberOfPages = 30; /* El número de páginas que aparecerán en el navegador al pie de la página */
	
    while($next_record && $iHasPages < $iPage + $iNumberOfPages)
    {
      if($iCounter == $iRecordsPerPage)
      {
        $iCounter = 0;
        $iHasPages = $iHasPages + 1;
      }
      $iCounter++;
      $next_record = $db->next_record();
    }
    if(!$next_record && $iCounter > 1) $iHasPages++;
    if (($iHasPages - $iPage) < intval($iNumberOfPages / 2))
      $iStartPage = $iHasPages - $iNumberOfPages;
    else
    $iStartPage = $iPage - $iNumberOfPages + intval($iNumberOfPages / 2);
    
    if($iStartPage < 0) $iStartPage = 0;
    for($iPageCount = $iPageCount + 1;  $iPageCount <= $iPage - 1; $iPageCount++)
    {
      $sPages .=  "<a href=" . $sFileName . "?" . $form_params . $sSortParams . "FormCIUDADANO_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
      $iDisplayPages++;
    }
    
    $sPages .= "<font " . "class=\"ColumnFONT\"" . "><b>" . $iPage . "</b></font>&nbsp;";
    $iDisplayPages++;
    
    $iPageCount = $iPage + 1;
    while ($iDisplayPages < $iNumberOfPages && $iStartPage + $iDisplayPages < $iHasPages)
    {
      
      $sPages .= "<a href=\"" . $sFileName . "?" . $form_params . $sSortParams . "FormCIUDADANO_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
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
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormCIUDADANO_Page=1#RADICADO"><font class="ColumnFONT">Primero</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormCIUDADANO_Page=<?=$iPage - 1?>#RADICADO"><font class="ColumnFONT">Anterior</font></a>
<?
    }
    echo "&nbsp;[&nbsp;" . $sPages . "]&nbsp;";
    
    if (!$bEof) {
?>
        <font class="ColumnFONT">Siguiente</font>
        <font class="ColumnFONT">Ultimo</font>
<?
    }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormCIUDADANO_Page=<?=$iPage + 1?>#RADICADO"><font class="ColumnFONT">Siguiente</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormCIUDADANO_Page=last#RADICADO"><font class="ColumnFONT">Ultimo</font></a>
<?
    }
  }

//-------------------------------
// Navigation end
//-------------------------------

  ?>
      </font></td></tr>
    </table>
  <?

}

//===============================
// Display Grid Form
//-------------------------------
function EmpresaESP_show()
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
  $sFormTitle = "Radicados encontrados por Empresa ESP";
  $HasParam = false;
  $iRecordsPerPage = 25;
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
  $form_params = trim(session_name())."=".trim(session_id())."&krd=$krd&s_RADI_DEPE_ACTU=" . tourl(get_param("s_RADI_DEPE_ACTU")) . "&s_RADI_NOMB=" . tourl(get_param("s_RADI_NOMB")) . "&s_RADI_NUME_RADI=" . tourl(get_param("s_RADI_NUME_RADI")) . "&s_TDOC_CODI=" . tourl(get_param("s_TDOC_CODI")) . "&s_desde_dia=" . tourl(get_param("s_desde_dia")) . "&s_desde_mes=" . tourl(get_param("s_desde_mes")) . "&s_desde_ano=" . tourl(get_param("s_desde_ano")) . "&s_hasta_dia=" . tourl(get_param("s_hasta_dia")) . "&s_hasta_mes=" . tourl(get_param("s_hasta_mes")) . "&s_hasta_ano=" . tourl(get_param("s_hasta_ano")) . "&s_solo_nomb=" . tourl(get_param("s_solo_nomb")) . "&s_ciudadano=" . tourl(get_param("s_ciudadano")) . "&s_empresaESP=" . tourl(get_param("s_empresaESP")) . "&s_oEmpresa=" . tourl(get_param("s_oEmpresa")) . "&s_entrada=" . tourl(get_param("s_entrada")) . "&s_salida=" . tourl(get_param("s_salida")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by R.RADI_NUME_RADI Asc";
  $iSort = get_param("FormEMPRESAESP_Sorting");
  $iSorted = get_param("FormEMPRESAESP_Sorted");
  $krd = strip(get_param("krd")); 
  if(!$iSort)
  {
    $form_sorting = "";
  }
  else
  {
    if($iSort == $iSorted)
    {
      $form_sorting = "";
      $sDirection = " DESC ";
      $sSortParams = "FormEMPRESAESP_Sorting=" . $iSort . "&FormEMPRESAESP_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC ";
      $sSortParams = "FormEMPRESAESP_Sorting=" . $iSort . "&FormEMPRESAESP_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by r.radi_nume_radi" . $sDirection;
    if ($iSort == 2) $sOrder = " order by r.radi_fech_radi" . $sDirection;
    if ($iSort == 3) $sOrder = " order by r.ra_asun" . $sDirection; 
    if ($iSort == 4) $sOrder = " order by td.sgd_tpr_descrip" . $sDirection;
    if ($iSort == 5) $sOrder = " order by r.radi_nume_hoja" . $sDirection;
    if ($iSort == 6) $sOrder = " order by dir.sgd_dir_direccion" . $sDirection;
    if ($iSort == 7) $sOrder = " order by dir.sgd_dir_telefono" . $sDirection;
	if ($iSort == 8) $sOrder = " order by dir.sgd_dir_mail" . $sDirection;
	if ($iSort == 9) $sOrder = " order by bod.NOMBRE_DE_LA_EMPRESA" . $sDirection;
	if ($iSort == 10) $sOrder = " order by bod.NOMBRE_REP_LEGAL" . $sDirection;
	if ($iSort == 11) $sOrder = " order by bod.NIT_DE_LA_EMPRESA" . $sDirection;
	if ($iSort == 12) $sOrder = " order by bod.SIGLA_DE_LA_EMPRESA" . $sDirection;
    if ($iSort == 13) $sOrder = " order by bod.DIRECCION" . $sDirection;
    if ($iSort == 14) $sOrder = " order by bod.TELEFONO_1" . $sDirection;
    if ($iSort == 15) $sOrder = " order by u1.usua_nomb" . $sDirection; 
    if ($iSort == 16) $sOrder = " order by d1.depe_nomb" . $sDirection;
    if ($iSort == 17) $sOrder = " order by r.radi_usu_ante" . $sDirection;
//    if ($iSort == 18) $sOrder = " order by muni.muni_nomb" . $sDirection;
//    if ($iSort == 19) $sOrder = " order by dpto.dpto_nomb" . $sDirection;
	if ($iSort == 20) $sOrder = " order by r.radi_pais" . $sDirection;
	if ($iSort == 21) $sOrder = " order by diasr" . $sDirection;
	if ($iSort == 22) $sOrder = " order by dir.sgd_dir_nombre" . $sDirection;
  }

//-------------------------------
// Encabezados HTML de las Columnas
//-------------------------------
?>
     <table width="2000" class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="20"><a name="RADICADO"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
      </tr>
      <tr>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=1&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=2&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha Radicaci&oacute;n</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=3&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Asunto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=4&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Tipo de Documento</font></a></td>	   
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=5&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Numero de Hojas</font></a></td>	   
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=6&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Direccion contacto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=7&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Tel&eacute;fono contacto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=8&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Mail Contacto</font></a></td>
	   <!-- INICIO CAMPOS QUE CAMBIAN -->
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=9&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Nombre de la Empresa</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=10&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Representante Legal</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=11&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">NIT</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=12&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Sigla</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=13&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Direccion Empresa</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=14&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Telefono</font></a></td>
	   <!-- FIN CAMPOS QUE CAMBIAN -->
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=15&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Actual</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=16&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dependencia Actual</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=17&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Anterior</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=22&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Firmante</font></a></td>
	   <!--td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=18&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Municipio</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=19&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Departamento</font></a></td-->
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=20&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Pais</font></a></td>
  	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormEMPRESAESP_Sorting=21&FormEMPRESAESP_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dias Restantes</font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
// Se crea la $ps_desde_RADI_FECH_RADI con los datos ingresados.
//------------------------------------
  
  $ps_desde_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(0,0,0,get_param("s_desde_mes"),get_param("s_desde_dia"),get_param("s_desde_ano")));
  $ps_hasta_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(23,59,59,get_param("s_hasta_mes"),get_param("s_hasta_dia"),get_param("s_hasta_ano")));
  if(strlen($ps_desde_RADI_FECH_RADI) && strlen($ps_hasta_RADI_FECH_RADI))
  {
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_fech_radi>=to_date('" .$ps_desde_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
    $sWhere .= " and ";
    $sWhere = $sWhere . "r.radi_fech_radi<=to_date('" . $ps_hasta_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
  }

/* Se recibe la dependencia actual para búsqueda */

  $ps_RADI_DEPE_ACTU = get_param("s_RADI_DEPE_ACTU");
  if(is_number($ps_RADI_DEPE_ACTU) && strlen($ps_RADI_DEPE_ACTU))
	$ps_RADI_DEPE_ACTU = tosql($ps_RADI_DEPE_ACTU, "Number");
  else $ps_RADI_DEPE_ACTU = "";

  if(strlen($ps_RADI_DEPE_ACTU))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_depe_actu=" . $ps_RADI_DEPE_ACTU;
  }

 /* Se recibe el número del radicado para búsqueda */
  $ps_RADI_NUME_RADI = get_param("s_RADI_NUME_RADI");
  if(strlen($ps_RADI_NUME_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%".$ps_RADI_NUME_RADI ."%", "Text");
  }

/* Se decide si busca en radicado de entrada o de salida o ambos */
  $ps_entrada = strip(get_param("s_entrada"));
  if(strlen($ps_entrada) && $ps_entrada="ENT"){
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%2", "Text");
  }
  $ps_salida = strip(get_param("s_salida"));
  if(strlen($ps_salida) && $ps_salida="SAL"){
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%1", "Text");
  }

/* Se recibe el tipo de documento para la búsqueda */
  $ps_TDOC_CODI = get_param("s_TDOC_CODI");
  if(is_number($ps_TDOC_CODI) && strlen($ps_TDOC_CODI) && $ps_TDOC_CODI != "9999")
    $ps_TDOC_CODI = tosql($ps_TDOC_CODI, "Number");
  else $ps_TDOC_CODI = "";
  if(strlen($ps_TDOC_CODI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.tdoc_codi=" . $ps_TDOC_CODI;
  }

 /* Se recibe la caadena a buscar y el tipo de busqueda (All) (Any)  
 bod.nombre_de_la_empresa,bod.nombre_rep_legal,bod.nit_de_la_empresa,bod.sigla_de_la_empresa,bod.direccion,bod.telefono_1,bod.telefono_2,bod.telefono_3,
*/
  $ps_RADI_NOMB = strip(get_param("s_RADI_NOMB"));
  $ps_solo_nomb = get_param("s_solo_nomb");
  $yaentro=false;
  if(strlen($ps_RADI_NOMB) && $ps_solo_nomb == "All")
  {
    if($sWhere != "") 
      $sWhere .= " and (";
	$HasParam=true;
	$sWhere .= "dir.SGD_ESP_CODI IN (SELECT IDENTIFICADOR_EMPRESA FROM bodega_empresas b WHERE ";

	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(b.nombre_de_la_empresa||b.nombre_rep_legal||b.nit_de_la_empresa||b.sigla_de_la_empresa||b.direccion||b.telefono_1||b.telefono_2||b.telefono_3) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .=")";
	$sWhere .= " or (";
    $yaentro=false;
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(r.ra_asun||dir.sgd_dir_nombre) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .="))";

  }

  if(strlen($ps_RADI_NOMB) && $ps_solo_nomb == "Any")
  {
    if($sWhere != "") 
      $sWhere .= " and (";
	$HasParam=true;
	$sWhere .= "dir.SGD_ESP_CODI IN (SELECT IDENTIFICADOR_EMPRESA FROM bodega_empresas b WHERE ";

	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " or ";
		}
		$sWhere .= "UPPER(b.nombre_de_la_empresa||b.nombre_rep_legal||b.nit_de_la_empresa||b.sigla_de_la_empresa||b.direccion||b.telefono_1||b.telefono_2||b.telefono_3) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .=")";
	$sWhere .= " or (";
    $yaentro=false;
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " or ";
		}
		$sWhere .= "UPPER(r.ra_asun||dir.sgd_dir_nombre) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .="))";
  }

  if($HasParam)
    $sWhere = " AND (" . $sWhere . ") ";
//-------------------------------
// Build base SQL statement
//-------------------------------

$sSQL = "SELECT r.radi_nume_radi, r.radi_fech_radi, r.ra_asun,r.radi_pais, r.radi_nume_hoja, 
r.radi_path, r.radi_usu_ante,
td.sgd_tpr_descrip, ROUND(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-SYSDATE)) AS diasr, 
u1.usua_login AS login_actu, u1.usua_nomb AS nomb_actu, d1.depe_nomb AS depe_actu,
dir.sgd_dir_direccion, dir.sgd_dir_telefono, dir.sgd_dir_mail,dir.sgd_dir_nombre,
bod.nombre_de_la_empresa,bod.nombre_rep_legal,bod.nit_de_la_empresa,bod.sigla_de_la_empresa,bod.direccion,bod.telefono_1,bod.telefono_2,bod.telefono_3
FROM sgd_dir_drecciones dir, radicado r, sgd_tpr_tpdcumento td, usuario u1, dependencia d1,
bodega_empresas bod
WHERE dir.SGD_DIR_TIPO = 1 AND dir.radi_nume_radi=r.radi_nume_radi AND r.tdoc_codi=td.sgd_tpr_codigo
AND r.radi_usua_actu=u1.usua_codi AND r.radi_depe_actu=u1.depe_codi AND u1.depe_codi=d1.depe_codi
AND (dir.sgd_esp_codi=bod.identificador_empresa AND NVL(dir.sgd_esp_codi,0)!=0 AND NVL(dir.sgd_ciu_codigo,0)=0 AND NVL(dir.sgd_oem_codigo,0)=0)
";
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
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
      <td colspan="20" class="DataTD"><font class="DataFONT">No hay resultados</font></td>
     </tr>
<?
 
//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="20" class="ColumnTD"><font class="ColumnFONT">
<?
  
?>
  </table>
<?

    return;
  }

//-------------------------------

?>
     <!--tr>
      <td colspan="10" class="DataTD"><font class="DataFONT"><b>Total Registros Encontrados: <?=$fldTotal?></b></font></td>
     </tr-->

<?

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Process page scroller
//-------------------------------
  $iPage = get_param("FormEMPRESAESP_Page");

  if(!strlen($iPage)) $iPage = 1;
  else
  {
    if($iPage == "last")
    {
      $db_count = get_db_value($sCountSQL);
      $dResult = intval($db_count) / $iRecordsPerPage;
      $iPage = intval($dResult);
      if($iPage < $dResult) $iPage++;
    }
    else $iPage = intval($iPage);
  }
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

//$ruta_raiz ="..";
//include "../config.php";
//include "../jh_class/funciones_sgd.php";
//-------------------------------
// Display grid based on recordset
//-------------------------------.

while($next_record  && $iCounter < $iRecordsPerPage)
 {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldRADI_NUME_RADI = $db->f("RADI_NUME_RADI");
    $fldRADI_FECH_RADI = $db->f("RADI_FECH_RADI");
	$fldASUNTO = $db->f("RA_ASUN");
    $fldTIPO_DOC = $db->f("SGD_TPR_DESCRIP");
    $fldNUME_HOJAS = $db->f("RADI_NUME_HOJA");
    $fldRADI_PATH = $db->f("RADI_PATH");
    $fldDIRECCION_C = $db->f("SGD_DIR_DIRECCION");
    $fldTELEFONO_C = $db->f("SGD_DIR_TELEFONO");
    $fldMAIL_C = $db->f("SGD_DIR_MAIL");
	/* Inicio campos que cambian */
    $fldNOMBRE_EMPRESA = $db->f("NOMBRE_DE_LA_EMPRESA");
    $fldREP_LEGAL = $db->f("NOMBRE_REP_LEGAL");
    $fldNIT_EMPRESA = $db->f("NIT_DE_LA_EMPRESA");
    $fldSIGLA_EMPRESA = $db->f("SIGLA_DE_LA_EMPRESA");
    $fldDIRECCION = $db->f("DIRECCION");
    $fldTELEFONO = $db->f("TELEFONO_1") . " | ". $db->f("TELEFONO_2") . " | " . $db->f("TELEFONO_3");
	/* Fin campos que cambian */ 
    $fldUSUA_ACTU = $db->f("NOMB_ACTU") . " - (" . $db->f("LOGIN_ACTU").")";
    $fldDEPE_ACTU = $db->f("DEPE_ACTU");
    $fldUSUA_ANTE = $db->f("RADI_USU_ANTE");
//    $fldMUNI_NOMB = $db->f("MUNI_NOMB");
//    $fldDPTO_NOMB = $db->f("DPTO_NOMB");
	$fldPAIS = $db->f("RADI_PAIS");
	$fldDIASR = $db->f("DIASR");
	$fldFirmante = $db->f("sgd_dir_nombre");
    $next_record = $db->next_record();
    
//-------------------------------
// Show begin
//-------------------------------

//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="DataTD"><font class="DataFONT">
	  <? if (strlen($fldRADI_PATH)){ $iii = $iii +1;?>  <a href='../bodega<?=$fldRADI_PATH?>' target='Imagen<?=$iii?>'><?}?>
	   <font class="DataFONT"><?=$fldRADI_NUME_RADI?></font>
	  <?if (strlen($fldRADI_PATH)){?></a><?}?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT"><a href="../verradicado.php?verrad=<?=$fldRADI_NUME_RADI."&".session_name()."=".session_id()."&krd=$krd&carpeta=8&nomcarpeta=Busquedas&tipo_carp=0"?>">
      <?= tohtml($fldRADI_FECH_RADI) ?>&nbsp;</a></font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldASUNTO) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTIPO_DOC) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNUME_HOJAS) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDIRECCION_C) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTELEFONO_C) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldMAIL_C) ?>&nbsp;</font></td>
<!-- INICIO CAMPOS QUE CAMBIAN -->
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNOMBRE_EMPRESA) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldREP_LEGAL) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNIT_EMPRESA) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldSIGLA_EMPRESA) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDIRECCION) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTELEFONO) ?>&nbsp;</font></td>
<!-- FIN CAMPOS QUE CAMBIAN -->
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_ACTU) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDEPE_ACTU) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_ANTE) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldFirmante) ?>&nbsp;</font></td>
       <!--td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldMUNI_NOMB); ?>&nbsp;</font></td>	  
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDPTO_NOMB); ?>&nbsp;</font></td-->	  
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldPAIS); ?>&nbsp;</font></td>	  
      <td class="DataTD"><font class="DataFONT">
      <? if ($fldRADI_DEPE_ACTU!=999){ echo tohtml($fldDIASR);} else {echo "Sal";} ?>&nbsp;</font></td>	  
     </tr>
	  <?
    $iCounter++;

  } 
 
//-------------------------------
//  Record navigator.
//-------------------------------
?>
    <tr>
     <td colspan="20" class="ColumnTD"><font class="ColumnFONT">
<?
  
  // Navigation begin
  $bEof = $next_record;

  if($bEof || $iPage != 1) 
  {
    $iCounter = 1;
    $iHasPages = $iPage;
    $sPages = "";
    $iDisplayPages = 0;  
    $iNumberOfPages = 30; /* El número de páginas que aparecerán en el navegador al pie de la página */
	
    while($next_record && $iHasPages < $iPage + $iNumberOfPages)
    {
      if($iCounter == $iRecordsPerPage)
      {
        $iCounter = 0;
        $iHasPages = $iHasPages + 1;
      }
      $iCounter++;
      $next_record = $db->next_record();
    }
    if(!$next_record && $iCounter > 1) $iHasPages++;
    if (($iHasPages - $iPage) < intval($iNumberOfPages / 2))
      $iStartPage = $iHasPages - $iNumberOfPages;
    else
    $iStartPage = $iPage - $iNumberOfPages + intval($iNumberOfPages / 2);
    
    if($iStartPage < 0) $iStartPage = 0;
    for($iPageCount = $iPageCount + 1;  $iPageCount <= $iPage - 1; $iPageCount++)
    {
      $sPages .=  "<a href=" . $sFileName . "?" . $form_params . $sSortParams . "FormEMPRESAESP_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
      $iDisplayPages++;
    }
    
    $sPages .= "<font " . "class=\"ColumnFONT\"" . "><b>" . $iPage . "</b></font>&nbsp;";
    $iDisplayPages++;
    
    $iPageCount = $iPage + 1;
    while ($iDisplayPages < $iNumberOfPages && $iStartPage + $iDisplayPages < $iHasPages)
    {
      
      $sPages .= "<a href=\"" . $sFileName . "?" . $form_params . $sSortParams . "FormEMPRESAESP_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
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
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormEMPRESAESP_Page=1#RADICADO"><font class="ColumnFONT">Primero</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormEMPRESAESP_Page=<?=$iPage - 1?>#RADICADO"><font class="ColumnFONT">Anterior</font></a>
<?
    }
    echo "&nbsp;[&nbsp;" . $sPages . "]&nbsp;";
    
    if (!$bEof) {
?>
        <font class="ColumnFONT">Siguiente</font>
        <font class="ColumnFONT">Ultimo</font>
<?
    }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormEMPRESAESP_Page=<?=$iPage + 1?>#RADICADO"><font class="ColumnFONT">Siguiente</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormEMPRESAESP_Page=last#RADICADO"><font class="ColumnFONT">Ultimo</font></a>
<?
    }
  }

//-------------------------------
// Navigation end
//-------------------------------

  ?>
      </font></td></tr>
    </table>
  <?

}

//===============================
// Display Grid Form
//-------------------------------
function OtrasEmpresas_show()
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
  $sFormTitle = "Radicados encontrados por Otras Empresas";
  $HasParam = false;
  $iRecordsPerPage = 25;
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
  $form_params = trim(session_name())."=".trim(session_id())."&krd=$krd&s_RADI_DEPE_ACTU=" . tourl(get_param("s_RADI_DEPE_ACTU")) . "&s_RADI_NOMB=" . tourl(get_param("s_RADI_NOMB")) . "&s_RADI_NUME_RADI=" . tourl(get_param("s_RADI_NUME_RADI")) . "&s_TDOC_CODI=" . tourl(get_param("s_TDOC_CODI")) . "&s_desde_dia=" . tourl(get_param("s_desde_dia")) . "&s_desde_mes=" . tourl(get_param("s_desde_mes")) . "&s_desde_ano=" . tourl(get_param("s_desde_ano")) . "&s_hasta_dia=" . tourl(get_param("s_hasta_dia")) . "&s_hasta_mes=" . tourl(get_param("s_hasta_mes")) . "&s_hasta_ano=" . tourl(get_param("s_hasta_ano")) . "&s_solo_nomb=" . tourl(get_param("s_solo_nomb")) . "&s_ciudadano=" . tourl(get_param("s_ciudadano")) . "&s_empresaESP=" . tourl(get_param("s_empresaESP")) . "&s_oEmpresa=" . tourl(get_param("s_oEmpresa")) . "&s_entrada=" . tourl(get_param("s_entrada")) . "&s_salida=" . tourl(get_param("s_salida")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by R.RADI_NUME_RADI Asc";
  $iSort = get_param("FormOEMPRESAS_Sorting");
  $iSorted = get_param("FormOEMPRESAS_Sorted");
  $krd = strip(get_param("krd")); 
  if(!$iSort)
  {
    $form_sorting = "";
  }
  else
  {
    if($iSort == $iSorted)
    {
      $form_sorting = "";
      $sDirection = " DESC ";
      $sSortParams = "FormOEMPRESAS_Sorting=" . $iSort . "&FormOEMPRESAS_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC ";
      $sSortParams = "FormOEMPRESAS_Sorting=" . $iSort . "&FormOEMPRESAS_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by r.radi_nume_radi" . $sDirection;
    if ($iSort == 2) $sOrder = " order by r.radi_fech_radi" . $sDirection;
    if ($iSort == 3) $sOrder = " order by r.ra_asun" . $sDirection; 
    if ($iSort == 4) $sOrder = " order by td.sgd_tpr_descrip" . $sDirection;
    if ($iSort == 5) $sOrder = " order by r.radi_nume_hoja" . $sDirection;
    if ($iSort == 6) $sOrder = " order by dir.sgd_dir_direccion" . $sDirection;
    if ($iSort == 7) $sOrder = " order by dir.sgd_dir_telefono" . $sDirection;
	if ($iSort == 8) $sOrder = " order by dir.sgd_dir_mail" . $sDirection;
	if ($iSort == 9) $sOrder = " order by o.sgd_oem_oempresa" . $sDirection;
	if ($iSort == 10) $sOrder = " order by o.sgd_oem_rep_legal" . $sDirection;
	if ($iSort == 11) $sOrder = " order by o.sgd_oem_nit" . $sDirection;
	if ($iSort == 12) $sOrder = " order by o.sgd_oem_sigla" . $sDirection;
    if ($iSort == 13) $sOrder = " order by o.sgd_oem_direccion" . $sDirection;
    if ($iSort == 14) $sOrder = " order by o.sgd_oem_telefono" . $sDirection;
    if ($iSort == 15) $sOrder = " order by u1.usua_nomb" . $sDirection; 
    if ($iSort == 16) $sOrder = " order by d1.depe_nomb" . $sDirection;
    if ($iSort == 17) $sOrder = " order by r.radi_usu_ante" . $sDirection;
//    if ($iSort == 18) $sOrder = " order by muni.muni_nomb" . $sDirection;
//    if ($iSort == 19) $sOrder = " order by dpto.dpto_nomb" . $sDirection;
	if ($iSort == 20) $sOrder = " order by r.radi_pais" . $sDirection;
	if ($iSort == 21) $sOrder = " order by diasr" . $sDirection;
	if ($iSort == 22) $sOrder = " order by dir.sgd_dir_nombre" . $sDirection;
  }

//-------------------------------
// Encabezados HTML de las Columnas
//-------------------------------
?>
     <table width="2000" class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="20"><a name="RADICADO"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
      </tr>
      <tr>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=1&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=2&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha Radicaci&oacute;n</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=3&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Asunto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=4&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Tipo de Documento</font></a></td>	   
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=5&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Numero de Hojas</font></a></td>	   
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=6&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Direccion contacto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=7&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Tel&eacute;fono contacto</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=8&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Mail Contacto</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=9&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Nombre de la Empresa</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=10&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Representante Legal</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=11&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">NIT</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=12&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Sigla</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=13&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Direccion Empresa</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=14&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Telefono</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=15&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Actual</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=16&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dependencia Actual</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=17&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Anterior</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=22&FormCIUDADANO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Firmante</font></a></td>
	   <!--td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=18&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Municipio</font></a></td>
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=19&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Departamento</font></a></td-->
	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=20&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Pais</font></a></td>
  	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormOEMPRESAS_Sorting=21&FormOEMPRESAS_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dias Restantes</font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
// Se crea la $ps_desde_RADI_FECH_RADI con los datos ingresados.
//------------------------------------
  
  $ps_desde_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(0,0,0,get_param("s_desde_mes"),get_param("s_desde_dia"),get_param("s_desde_ano")));
  $ps_hasta_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(23,59,59,get_param("s_hasta_mes"),get_param("s_hasta_dia"),get_param("s_hasta_ano")));
  if(strlen($ps_desde_RADI_FECH_RADI) && strlen($ps_hasta_RADI_FECH_RADI))
  {
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_fech_radi>=to_date('" .$ps_desde_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
    $sWhere .= " and ";
    $sWhere = $sWhere . "r.radi_fech_radi<=to_date('" . $ps_hasta_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
  }

/* Se recibe la dependencia actual para búsqueda */

  $ps_RADI_DEPE_ACTU = get_param("s_RADI_DEPE_ACTU");
  if(is_number($ps_RADI_DEPE_ACTU) && strlen($ps_RADI_DEPE_ACTU))
	$ps_RADI_DEPE_ACTU = tosql($ps_RADI_DEPE_ACTU, "Number");
  else $ps_RADI_DEPE_ACTU = "";

  if(strlen($ps_RADI_DEPE_ACTU))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_depe_actu=" . $ps_RADI_DEPE_ACTU;
  }

 /* Se recibe el número del radicado para búsqueda */
  $ps_RADI_NUME_RADI = get_param("s_RADI_NUME_RADI");
  if(strlen($ps_RADI_NUME_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%".$ps_RADI_NUME_RADI ."%", "Text");
  }
/* Se decide si busca en radicado de entrada o de salida o ambos */
  $ps_entrada = strip(get_param("s_entrada"));
  if(strlen($ps_entrada) && $ps_entrada="ENT"){
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%2", "Text");
  }
  $ps_salida = strip(get_param("s_salida"));
  if(strlen($ps_salida) && $ps_salida="SAL"){
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_nume_radi like " . tosql("%1", "Text");
  }

/* Se recibe el tipo de documento para la búsqueda */
  $ps_TDOC_CODI = get_param("s_TDOC_CODI");
  if(is_number($ps_TDOC_CODI) && strlen($ps_TDOC_CODI) && $ps_TDOC_CODI != "9999")
    $ps_TDOC_CODI = tosql($ps_TDOC_CODI, "Number");
  else $ps_TDOC_CODI = "";
  if(strlen($ps_TDOC_CODI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.tdoc_codi=" . $ps_TDOC_CODI;
  }

 /* Se recibe la caadena a buscar y el tipo de busqueda (All) (Any)  
 bod.nombre_de_la_empresa,bod.nombre_rep_legal,bod.nit_de_la_empresa,bod.sigla_de_la_empresa,bod.direccion,bod.telefono_1,bod.telefono_2,bod.telefono_3,
*/
  $ps_RADI_NOMB = strip(get_param("s_RADI_NOMB"));
  $ps_solo_nomb = get_param("s_solo_nomb");
  $yaentro=false;
  if(strlen($ps_RADI_NOMB) && $ps_solo_nomb == "All")
  {
    if($sWhere != "") 
      $sWhere .= " and (";
	$HasParam=true;
	$sWhere .= "dir.sgd_oem_codigo IN (SELECT sgd_oem_codigo FROM sgd_oem_oempresas d WHERE ";

	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(d.sgd_oem_oempresa||d.sgd_oem_rep_legal||d.sgd_oem_nit||d.sgd_oem_sigla||d.sgd_oem_direccion||d.sgd_oem_telefono) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .=")";
	$sWhere .= " or (";
    $yaentro=false;
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(r.ra_asun||dir.sgd_dir_nombre) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .="))";

  }

  if(strlen($ps_RADI_NOMB) && $ps_solo_nomb == "Any")
  {
    if($sWhere != "") 
      $sWhere .= " and (";
	$HasParam=true;
	$sWhere .= "dir.sgd_oem_codigo IN (SELECT sgd_oem_codigo FROM sgd_oem_oempresas d WHERE ";

	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " or ";
		}
		$sWhere .= "UPPER(d.sgd_oem_oempresa||d.sgd_oem_rep_legal||d.sgd_oem_nit||d.sgd_oem_sigla||d.sgd_oem_direccion||d.sgd_oem_telefono) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .=")";
	$sWhere .= " or (";
    $yaentro=false;
	$tok = strtok($ps_RADI_NOMB," "); 
	while ($tok) { 
		if ($yaentro == true ) {
			$sWhere .= " or ";
		}
		$sWhere .= "UPPER(r.ra_asun||dir.sgd_dir_nombre) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .="))";
  }

  if($HasParam)
    $sWhere = " AND (" . $sWhere . ") ";

//-------------------------------
// Build base SQL statement
//-------------------------------

$sSQL = "SELECT r.radi_nume_radi, r.radi_fech_radi, r.ra_asun,r.radi_pais, r.radi_nume_hoja, 
r.radi_path, r.radi_usu_ante,
td.sgd_tpr_descrip, ROUND(((r.radi_fech_radi+(td.sgd_tpr_termino * 7/5))-SYSDATE)) AS diasr, 
u1.usua_login AS login_actu, u1.usua_nomb AS nomb_actu, d1.depe_nomb AS depe_actu,
dir.sgd_dir_direccion, dir.sgd_dir_telefono, dir.sgd_dir_mail,dir.sgd_dir_nombre,
o.sgd_oem_oempresa,o.sgd_oem_rep_legal,o.sgd_oem_nit, o.sgd_oem_sigla,o.sgd_oem_direccion,o.sgd_oem_telefono
FROM sgd_dir_drecciones dir, radicado r, sgd_tpr_tpdcumento td, usuario u1, dependencia d1, 
sgd_oem_oempresas o
WHERE dir.SGD_DIR_TIPO = 1 AND dir.radi_nume_radi=r.radi_nume_radi AND r.tdoc_codi=td.sgd_tpr_codigo
AND r.radi_usua_actu=u1.usua_codi AND r.radi_depe_actu=u1.depe_codi AND u1.depe_codi=d1.depe_codi
AND (dir.sgd_oem_codigo=o.sgd_oem_codigo AND NVL(dir.sgd_oem_codigo,0)!=0 AND NVL(dir.sgd_ciu_codigo,0)=0 AND NVL(dir.sgd_esp_codi,0)=0) 
";
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
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
      <td colspan="20" class="DataTD"><font class="DataFONT">No hay resultados</font></td>
     </tr>
<?
 
//-------------------------------
//  The insert link.
//-------------------------------
?>
    <tr>
     <td colspan="20" class="ColumnTD"><font class="ColumnFONT">
<?
  
?>
  </table>
<?

    return;
  }

//-------------------------------

?>
     <!--tr>
      <td colspan="10" class="DataTD"><font class="DataFONT"><b>Total Registros Encontrados: <?=$fldTotal?></b></font></td>
     </tr-->

<?

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Process page scroller
//-------------------------------
  $iPage = get_param("FormOEMPRESAS_Page");

  if(!strlen($iPage)) $iPage = 1;
  else
  {
    if($iPage == "last")
    {
      $db_count = get_db_value($sCountSQL);
      $dResult = intval($db_count) / $iRecordsPerPage;
      $iPage = intval($dResult);
      if($iPage < $dResult) $iPage++;
    }
    else $iPage = intval($iPage);
  }
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

//$ruta_raiz ="..";
//include "../config.php";
//include "../jh_class/funciones_sgd.php";
//-------------------------------
// Display grid based on recordset
//-------------------------------.

while($next_record  && $iCounter < $iRecordsPerPage)
 {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldRADI_NUME_RADI = $db->f("RADI_NUME_RADI");
    $fldRADI_FECH_RADI = $db->f("RADI_FECH_RADI");
	$fldASUNTO = $db->f("RA_ASUN");
    $fldTIPO_DOC = $db->f("SGD_TPR_DESCRIP");
    $fldNUME_HOJAS = $db->f("RADI_NUME_HOJA");
    $fldRADI_PATH = $db->f("RADI_PATH");
    $fldDIRECCION_C = $db->f("SGD_DIR_DIRECCION");
    $fldTELEFONO_C = $db->f("SGD_DIR_TELEFONO");
    $fldMAIL_C = $db->f("SGD_DIR_MAIL");
    $fldNOMBRE_EMPRESA = $db->f("SGD_OEM_OEMPRESA");
    $fldREP_LEGAL = $db->f("SGD_OEM_REP_LEGAL");
    $fldNIT_EMPRESA = $db->f("SGD_OEM_NIT");
    $fldSIGLA_EMPRESA = $db->f("SGD_OEM_SIGLA");
    $fldDIRECCION = $db->f("SGD_OEM_DIRECCION");
    $fldTELEFONO = $db->f("SGD_OEM_TELEFONO");
    $fldUSUA_ACTU = $db->f("NOMB_ACTU") . " - (" . $db->f("LOGIN_ACTU").")";
    $fldDEPE_ACTU = $db->f("DEPE_ACTU");
    $fldUSUA_ANTE = $db->f("RADI_USU_ANTE");
//    $fldMUNI_NOMB = $db->f("MUNI_NOMB");
//    $fldDPTO_NOMB = $db->f("DPTO_NOMB");
	$fldPAIS = $db->f("RADI_PAIS");
	$fldDIASR = $db->f("DIASR");
	$fldFirmante = $db->f("sgd_dir_nombre");
    $next_record = $db->next_record();
    
//-------------------------------
// Show begin
//-------------------------------

//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="DataTD"><font class="DataFONT">
	  <? if (strlen($fldRADI_PATH)){ $iii = $iii +1;?>  <a href='../bodega<?=$fldRADI_PATH?>' target='Imagen<?=$iii?>'><?}?>
	   <font class="DataFONT"><?=$fldRADI_NUME_RADI?></font>
	  <?if (strlen($fldRADI_PATH)){?></a><?}?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT"><a href="../verradicado.php?verrad=<?=$fldRADI_NUME_RADI."&".session_name()."=".session_id()."&krd=$krd&carpeta=8&nomcarpeta=Busquedas&tipo_carp=0"?>">
      <?= tohtml($fldRADI_FECH_RADI) ?>&nbsp;</a></font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldASUNTO) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTIPO_DOC) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNUME_HOJAS) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDIRECCION_C) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTELEFONO_C) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldMAIL_C) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNOMBRE_EMPRESA) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldREP_LEGAL) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldNIT_EMPRESA) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldSIGLA_EMPRESA) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDIRECCION) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldTELEFONO) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_ACTU) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDEPE_ACTU) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldUSUA_ANTE) ?>&nbsp;</font></td>
	   <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldFirmante) ?>&nbsp;</font></td>
       <!--td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldMUNI_NOMB); ?>&nbsp;</font></td>	  
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldDPTO_NOMB); ?>&nbsp;</font></td--> 
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldPAIS); ?>&nbsp;</font></td>	  
      <td class="DataTD"><font class="DataFONT">
      <? if ($fldRADI_DEPE_ACTU!=999){ echo tohtml($fldDIASR);} else {echo "Sal";} ?>&nbsp;</font></td>	  
     </tr>
	  <?
    $iCounter++;

  } 
 
//-------------------------------
//  Record navigator.
//-------------------------------
?>
    <tr>
     <td colspan="20" class="ColumnTD"><font class="ColumnFONT">
<?
  
  // Navigation begin
  $bEof = $next_record;

  if($bEof || $iPage != 1) 
  {
    $iCounter = 1;
    $iHasPages = $iPage;
    $sPages = "";
    $iDisplayPages = 0;  
    $iNumberOfPages = 30; /* El número de páginas que aparecerán en el navegador al pie de la página */
	
    while($next_record && $iHasPages < $iPage + $iNumberOfPages)
    {
      if($iCounter == $iRecordsPerPage)
      {
        $iCounter = 0;
        $iHasPages = $iHasPages + 1;
      }
      $iCounter++;
      $next_record = $db->next_record();
    }
    if(!$next_record && $iCounter > 1) $iHasPages++;
    if (($iHasPages - $iPage) < intval($iNumberOfPages / 2))
      $iStartPage = $iHasPages - $iNumberOfPages;
    else
    $iStartPage = $iPage - $iNumberOfPages + intval($iNumberOfPages / 2);
    
    if($iStartPage < 0) $iStartPage = 0;
    for($iPageCount = $iPageCount + 1;  $iPageCount <= $iPage - 1; $iPageCount++)
    {
      $sPages .=  "<a href=" . $sFileName . "?" . $form_params . $sSortParams . "FormOEMPRESAS_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
      $iDisplayPages++;
    }
    
    $sPages .= "<font " . "class=\"ColumnFONT\"" . "><b>" . $iPage . "</b></font>&nbsp;";
    $iDisplayPages++;
    
    $iPageCount = $iPage + 1;
    while ($iDisplayPages < $iNumberOfPages && $iStartPage + $iDisplayPages < $iHasPages)
    {
      
      $sPages .= "<a href=\"" . $sFileName . "?" . $form_params . $sSortParams . "FormOEMPRESAS_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
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
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormOEMPRESAS_Page=1#RADICADO"><font class="ColumnFONT">Primero</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormOEMPRESAS_Page=<?=$iPage - 1?>#RADICADO"><font class="ColumnFONT">Anterior</font></a>
<?
    }
    echo "&nbsp;[&nbsp;" . $sPages . "]&nbsp;";
    
    if (!$bEof) {
?>
        <font class="ColumnFONT">Siguiente</font>
        <font class="ColumnFONT">Ultimo</font>
<?
    }
    else {
?>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormOEMPRESAS_Page=<?=$iPage + 1?>#RADICADO"><font class="ColumnFONT">Siguiente</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormOEMPRESAS_Page=last#RADICADO"><font class="ColumnFONT">Ultimo</font></a>
<?
    }
  }

//-------------------------------
// Navigation end
//-------------------------------

  ?>
      </font></td></tr>
    </table>
  <?

}
?>
