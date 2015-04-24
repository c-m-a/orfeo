<?php
error_reporting(0);
session_start();
/*********************************************************************************
 *       Filename: busqueda.php
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
$sFileName = "busquedaTest.php";
//===============================


//===============================
// busqueda PageSecurity begin

$usu = get_param("usu");
$niv = get_param("niv");

if (strlen($usu) && strlen($niv)){
  set_session("UserID",$usu);
  set_session("Nivel",$niv);
}

check_security();
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
$sForm = get_param("FormName");
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
   <td valign="top"><font class="FieldCaptionFONT"><a href="busquedaHist.php?<?=session_name()."=".session_id()."&fechah=$fechah" ?>">Búsqueda por histórico</a><br><a href="busquedaUsuActu.php?<?=session_name()."=".session_id()."&fechah=$fechah" ?>">Reporte por Usuarios</a></font></td>
  </tr>
 </table>
 <table>
  <tr>
   <td valign="top">
<?php RADICADO_show() ?>
    
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
  $sActionFileName = "busquedaTest.php";
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
    $desdeTimestamp = mktime(0,0,0,$flds_desde_mes, $flds_desde_dia, $fld_desde_ano);
    $hastaTimestamp = mktime(0,0,0,$flds_hasta_mes, $flds_hasta_dia, $fld_hasta_ano);
    $flds_desde_dia = Date('d',$desdeTimestamp);
    $flds_hasta_dia = Date('d',$hastaTimestamp);
    $flds_desde_mes = Date('m',$desdeTimestamp);
    $flds_hasta_mes = Date('m',$hastaTimestamp);
    $flds_desde_ano = Date('Y',$desdeTimestamp);
    $flds_hasta_ano = Date('Y',$hastaTimestamp);
  }
  else {
    $flds_desde_dia = Date('d')-1;
    $flds_hasta_dia = Date('d');
    $flds_desde_mes = Date('m')-1;
    $flds_hasta_mes = Date('m');
    $flds_desde_ano = 2003;
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
    <form method="POST" action="<?= $sActionFileName ?>?<?=session_name()."=".session_id() ?>&dependencia=<?=$dependencia?>" name="Search">
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
      <td class="FieldCaptionTD"><font class="FieldCaptionFONT">Texto 
      <INPUT type="radio" NAME="s_solo_nomb" value="Texto" <?php if($flds_solo_nomb=="Texto"){ echo ("CHECKED");} ?>>
      Solo Nombre 
      <INPUT type="radio" NAME="s_solo_nomb" value="Nombre" <?php if($flds_solo_nomb=="Nombre"){echo ("CHECKED");} ?>>
      </font></td>
      <td class="DataTD"><input class="DataFONT" type="text" name="s_RADI_NOMB" maxlength="70" value="<?=tohtml($flds_RADI_NOMB) ?>" size="70" ></td>
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
        if($key == $flds_TDOC_CODI)
          $option="<option SELECTED value=\"$key\">$value";
        else 
          $option="<option value=\"$key\">$value";
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
        if($key == $flds_RADI_DEPE_ACTU)
          $option="<option SELECTED value=\"$key\">$value";
        else 
          $option="<option value=\"$key\">$value";
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
  $sFormTitle = "Radicados";
  $HasParam = false;
  $iRecordsPerPage = 50;
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
  $form_params = trim(session_name())."=".trim(session_id())."&s_RADI_DEPE_ACTU=" . tourl(get_param("s_RADI_DEPE_ACTU")) . "&s_RADI_NOMB=" . tourl(get_param("s_RADI_NOMB")) . "&s_RADI_NUME_RADI=" . tourl(get_param("s_RADI_NUME_RADI")) . "&s_TDOC_CODI=" . tourl(get_param("s_TDOC_CODI")) . "&s_desde_dia=" . tourl(get_param("s_desde_dia")) . "&s_desde_mes=" . tourl(get_param("s_desde_mes")) . "&s_desde_ano=" . tourl(get_param("s_desde_ano")) . "&s_hasta_dia=" . tourl(get_param("s_hasta_dia")) . "&s_hasta_mes=" . tourl(get_param("s_hasta_mes")) . "&s_hasta_ano=" . tourl(get_param("s_hasta_ano")) . "&s_solo_nomb=" . tourl(get_param("s_solo_nomb")) . "&";

//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $sOrder = " order by R_RADI_NUME_RADI Asc";
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
      $sDirection = " DESC ";
      $sSortParams = "FormRADICADO_Sorting=" . $iSort . "&FormRADICADO_Sorted=" . $iSort . "&";
    }
    else
    {
      $form_sorting = $iSort;
      $sDirection = " ASC ";
      $sSortParams = "FormRADICADO_Sorting=" . $iSort . "&FormRADICADO_Sorted=" . "&";
    }
    if ($iSort == 1) $sOrder = " order by R_RADI_NUME_RADI " . $sDirection;
    if ($iSort == 2) $sOrder = " order by R_RADI_FECH_RADI " . $sDirection;
    if ($iSort == 3) $sOrder = " order by R_RADI_NOMB " . $sDirection; 
    if ($iSort == 4) $sOrder = " order by RADI_NOMB " . $sDirection;
    if ($iSort == 5) $sOrder = " order by radi_path " . $sDirection;
    if ($iSort == 6) $sOrder = " order by RADI_NUME_IDEN " . $sDirection;
    if ($iSort == 7) $sOrder = " order by TDOC_DESC " . $sDirection;
	if ($iSort == 8) $sOrder = " order by DPTO_NOMB " . $sDirection;
	if ($iSort == 9) $sOrder = " order by DIASR " . $sDirection;
	if ($iSort == 10) $sOrder = " order by MUNI_NOMB " . $sDirection;
  }

//-------------------------------
// Encabezados HTML de las Columnas
//-------------------------------
?>
     <table width="1500" class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="10"><a name="RADICADO"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">#</font></td>	  
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=1&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Radicado</font></a></td>
       <td width="55" class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=2&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Fecha Radicaci&oacute;n</font></a></td>
       <td width="360" class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=3&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">ESP</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=6&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Nombre</font></a></td>	   
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=6&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Identificacion</font></a></td>
       <td width="150" class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=7&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Tipo Documento</font></a></td>
       <td width="150" class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=4&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Usuario Actual</font></a></td>
       <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=5&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Imagen</font></a></td>
	   <td width="100" class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=8&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Departamento</font></a></td>
	   <td width="100" class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=10&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Municipio</font></a></td>
  	   <td class="ColumnTD"><a href="<?=$sFileName?>?<?=$form_params?>FormRADICADO_Sorting=9&FormRADICADO_Sorted=<?=$form_sorting?>&"><font class="ColumnFONT">Dias Restantes</font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
// Se crea la $ps_desde_RADI_FECH_RADI con los datos ingresados.
//------------------------------------
  
  $ps_desde_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(0,0,0,get_param("s_desde_mes"),get_param("s_desde_dia"),get_param("s_desde_ano")));
  if(strlen($ps_desde_RADI_FECH_RADI))
  {
    $HasParam = true;
    $sWhere = $sWhere . "a.RADI_FECH_RADI>=to_date('" .$ps_desde_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
  }
//-----------------------
// Se reciben 
//-----------------------
  $ps_hasta_RADI_FECH_RADI = Date('d/m/Y H:i:s',mktime(23,59,59,get_param("s_hasta_mes"),get_param("s_hasta_dia"),get_param("s_hasta_ano")));

  if(strlen($ps_hasta_RADI_FECH_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "a.RADI_FECH_RADI<=to_date('" . $ps_hasta_RADI_FECH_RADI . "','dd/mm/yyyy hh24:mi:ss')";
  }


/* Se recibe la dependencia actual para búsqueda */

  $ps_RADI_DEPE_ACTU = get_param("s_RADI_DEPE_ACTU");
  if(is_number($ps_RADI_DEPE_ACTU) && strlen($ps_RADI_DEPE_ACTU))
    $ps_RADI_DEPE_ACTU = tosql($ps_RADI_DEPE_ACTU, "Number");
  else 
    $ps_RADI_DEPE_ACTU = "";

  if(strlen($ps_RADI_DEPE_ACTU))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "a.RADI_DEPE_ACTU=" . $ps_RADI_DEPE_ACTU;
  }

 
/* Se recibe el número del radicado para búsqueda */

  $ps_RADI_NUME_RADI = get_param("s_RADI_NUME_RADI");

  if(strlen($ps_RADI_NUME_RADI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "a.RADI_NUME_RADI like " . tosql("%".$ps_RADI_NUME_RADI ."%", "Text");
  }

/* Se recibe el tipo de documento para la búsqueda */
  $ps_TDOC_CODI = get_param("s_TDOC_CODI");
  if(is_number($ps_TDOC_CODI) && strlen($ps_TDOC_CODI) && $ps_TDOC_CODI != "9999")
    $ps_TDOC_CODI = tosql($ps_TDOC_CODI, "Number");
  else 
    $ps_TDOC_CODI = "";

  if(strlen($ps_TDOC_CODI))
  {
    if($sWhere != "") 
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "b.SGD_TPR_CODIGO=" . $ps_TDOC_CODI;
  }
/*
// Aca se recibe el texto para busqueda de texto. Se tokeniza y se busca por cada 
// uno de las palabras individuales por AND. 
// s_solo_nomb toma los siguientes valores: 
// "Texto" - si hay que buscar en todo lado
// "Nombre" - si hay que buscar solo en el nombre (radi_nomb antiguamente)
// s_RADI_NOMB trae el parametro para busqueda, puede ser una cadena separada por espacios
*/
  $ps_RADI_NOMB = strip(get_param("s_RADI_NOMB"));
  $ps_solo_nomb = get_param("s_solo_nomb");
		   
  if(strlen($ps_RADI_NOMB))
  {
	$HasParam2=true;
	$sWhere_nomb_1="";
	$sWhere_nomb_2="";
	$sWhere_nomb_3="";
	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB); //Se lleva toda la cadena a mayusculas para la comparacion.
	$tok = strtok($ps_RADI_NOMB," "); // Se tokeniza la cadena por espacio en vacio.
	while ($tok) { //por cada palabra se hace la búsqueda.
		$sWhere_nomb_1 .= " and UPPER(c.NOMBRE_DE_LA_EMPRESA||C.SIGLA_DE_LA_EMPRESA) LIKE '%".$tok."%' ";
		$sWhere_nomb_2 .= " and UPPER(c.SGD_OEM_OEMPRESA||C.SGD_OEM_SIGLA) LIKE '%".$tok."%' ";
		$sWhere_nomb_3 .= " and UPPER(c.SGD_CIU_NOMBRE||C.SGD_CIU_APELL1||C.SGD_CIU_APELL2) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
	}
  }

  if($HasParam)
    $sWhere = " and a.radi_nume_radi =d.radi_nume_radi ".
				  " and a.tdoc_codi=b.sgd_tpr_codigo ".
				  " AND (" . $sWhere . ") ";


//-------------------------------
// Build base SQL statement
//-------------------------------

$sSQL = "select a.RADI_NUME_HOJA, ".
	"a.RADI_FECH_RADI as R_RADI_FECH_RADI, ".
	"a.RADI_NUME_RADI as R_RADI_NUME_RADI, ".
	"a.RA_ASUN as R_RADI_ASUN, ".
	"a.RADI_PATH R_RADI_PATH, ".
	"a.RADI_USU_ANTE, ".
	"c.NOMBRE_DE_LA_EMPRESA as R_RADI_NOMB, ".
	"TO_CHAR(a.RADI_FECH_RADI,'DD/MM/YY HH:MIam') AS FECHA, ".
	"b.sgd_tpr_descrip as R_TDOC_DESC, ".
	"b.sgd_tpr_codigo, ".
	"b.sgd_tpr_termino, ".
	"round(((radi_fech_radi+(b.sgd_tpr_termino * 7/5))-sysdate)) as diasr, ".
	"RADI_LEIDO, ".
	"RADI_TIPO_DERI, ".
	"RADI_NUME_DERI, ".
	"'' SGD_CIU_NOMBRE, ".
	"'' SGD_CIU_APELL1, ".
	"'' SGD_CIU_APELL2 ".
	"from radicado a, ".
	"sgd_tpr_tpdcumento b, ".
	"bodega_empresas c, ".
	"SGD_DIR_DRECCIONES d ".
	"WHERE ".
	"d.SGD_ESP_CODI = c.IDENTIFICADOR_EMPRESA and d.SGD_ESP_CODI != 0 and ".
	"d.SGD_DIR_TIPO = 1 ".
/*Parametros $where*/
	$sWhere;
	if($HasParam2) {$sSQL.=$sWhere_nomb_1;}
	$sSQL .= $sOrder;
$sSQL .= "union all ".
	"select a.RADI_NUME_HOJA, ".
	"a.RADI_FECH_RADI as R_RADI_FECH_RADI, ".
	"a.RADI_NUME_RADI as R_RADI_NUME_RADI, ".
	"a.RA_ASUN as R_RADI_ASUN, ".
	"a.RADI_PATH R_RADI_PATH, ".
	"a.RADI_USU_ANTE, ".
	"c.SGD_OEM_OEMPRESA as R_RADI_NOMB, ".
	"TO_CHAR(a.RADI_FECH_RADI,'DD/MM/YY HH:MIam') AS FECHA, ".
	"b.sgd_tpr_descrip as R_TDOC_DESC, ".
	"b.sgd_tpr_codigo, ".
	"b.sgd_tpr_termino, ".
	"round(((radi_fech_radi+(b.sgd_tpr_termino * 7/5))-sysdate)) as diasr, ".
	"RADI_LEIDO, ".
	"RADI_TIPO_DERI, ".
	"RADI_NUME_DERI, ".
	"'' SGD_CIU_NOMBRE, ".
	"'' SGD_CIU_APELL1, ".
	"'' SGD_CIU_APELL2  ".
	"from radicado a,sgd_tpr_tpdcumento b,SGD_OEM_OEMPRESAS c, SGD_DIR_DRECCIONES d ".
	"WHERE ".
	"d.SGD_OEM_CODIGO = c.SGD_OEM_CODIGO and d.SGD_OEM_CODIGO != 0 and ".
	"d.SGD_DIR_TIPO = 1 ".
/*Where $where*/
	$sWhere;
/*$where especifico 2*/
	if($HasParam2){$sSQL .= $sWhere_nomb_2;}
	$sSQL .= $sOrder;
$sSQL .= "union all ".
	"select ".
	"a.RADI_NUME_HOJA, ".
	"a.RADI_FECH_RADI as R_RADI_FECH_RADI, ".
	"a.RADI_NUME_RADI as R_RADI_NUME_RADI, ".
	"a.RA_ASUN as R_RADI_ASUN, ".
	"a.RADI_PATH R_RADI_PATH, ".
	"a.RADI_USU_ANTE, ".
	"'' R_RADI_NOMB, ".
	"TO_CHAR(a.RADI_FECH_RADI,'DD/MM/YY HH:MIam') AS FECHA, ".
	"b.sgd_tpr_descrip as R_TDOC_DESC, ".
	"b.sgd_tpr_codigo, ".
	"b.sgd_tpr_termino, ".
	"round(((radi_fech_radi+(b.sgd_tpr_termino * 7/5))-sysdate)) as diasr, ".
	"RADI_LEIDO, ".
	"RADI_TIPO_DERI, ".
	"RADI_NUME_DERI, ".
	"c.SGD_CIU_NOMBRE, ".
	"c.SGD_CIU_APELL1, ".
	"c.SGD_CIU_APELL2  ".
	"from radicado a,sgd_tpr_tpdcumento b,SGD_CIU_CIUDADANO c, SGD_DIR_DRECCIONES d ".
	"WHERE ".
	"d.SGD_CIU_CODIGO = c.SGD_CIU_CODIGO and d.SGD_CIU_CODIGO !=0 and ".
	"d.SGD_DIR_TIPO = 1 ".
/*$where*/
    $sWhere;
/*where especifico 3*/
	if($HasParam2){$sSQL .= $sWhere_nomb_3;}
	$sSQL .= $sOrder;
//-------------------------------
//-------------------------------
// RADICADO Open Event begin

// Busqueda por nivel
/*
$nivel = get_session("Nivel");
if($sWhere != "") 
  $sWhere .= " and ";
else 
  $sWhere = " where ";
$sWhere = $sWhere . " R.CODI_NIVEL<=".$nivel ." AND R.RADI_USUA_ACTU=U.USUA_CODI AND R.RADI_DEPE_ACTU=U.DEPE_CODI ";
*/
// Contador
/*$sSQLCount = "Select count(*) as Total from radicado R, USUARIO U, departamento D,TIPO_DOCUMENTO B, MUNICIPIO M  " . $sWhere;
*/
   $sSQLCount1 = "select 
	   			count(*) as TOTAL
				from radicado a,sgd_tpr_tpdcumento b,
				bodega_empresas c,
				( 
				 SELECT DISTINCT b.sgd_ciu_cedula,a.radi_nume_radi,b.sgd_ciu_nombre,b.sgd_ciu_apell1,b.sgd_ciu_apell2,b.sgd_ciu_codigo
				 FROM SGD_DIR_DRECCIONES a,SGD_CIU_CIUDADANO b
				 WHERE b.sgd_ciu_codigo=a.sgd_ciu_codigo
				) d
				$sWhere 
				 and c.IDENTIFICADOR_EMPRESA  =  a.eesp_codi";
				
   $sSQLCount2 = "select 
	   			count(*) as TOTAL
				from radicado a,sgd_tpr_tpdcumento b,
				( 
				 SELECT DISTINCT b.sgd_ciu_cedula,a.radi_nume_radi,b.sgd_ciu_nombre,b.sgd_ciu_apell1,b.sgd_ciu_apell2,b.sgd_ciu_codigo
				 FROM SGD_DIR_DRECCIONES a,SGD_CIU_CIUDADANO b
				 WHERE b.sgd_ciu_codigo=a.sgd_ciu_codigo
				) d
				$sWhere 
				 and a.eesp_codi = 0
				";

//  echo "$sSQLCount1<br><br>";
//  echo "$sSQLCount2<br><br>";
//  echo "$sSQL";
/*
$db->query($sSQLCount1);
$next_record = $db->next_record();
$fldTotal1 = $db->f("TOTAL"); 

$db->query($sSQLCount2);
$next_record = $db->next_record();
$fldTotal2 = $db->f("TOTAL"); 

$fldTotal = $fldTotal1 + $fldTotal2; 
*/
// RADICADO Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
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
      <td colspan="10" class="DataTD"><font class="DataFONT">No hay resultados</font></td>
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
  $iPage = get_param("FormRADICADO_Page");

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
    } while ($iCounter < ($iPage - 1) * $iRecordsPerPage && $db->next_record());
    $next_record = $db->next_record();
  }

  $iCounter = 0; 
//-------------------------------

//-------------------------------
// Display grid based on recordset
//-------------------------------.

 while($next_record  && $iCounter < $iRecordsPerPage)
 {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldRADI_FECH_RADI = $db->f("R_RADI_FECH_RADI");
    $fldRADI_NOMB = $db->f("R_RADI_NOMB");
    $fldRADI_NUME_IDEN = $db->f("R_RADI_NUME_IDEN");
    $fldRADI_NUME_RADI_URLLink = "detalle.php";
    $fldRADI_NUME_RADI_s_RADI_NUME_RADI = $db->f("R_RADI_NUME_RADI");
    $fldRADI_NUME_RADI = $db->f("R_RADI_NUME_RADI");
    $fldRADI_PRIM_APEL = $db->f("R_RADI_PRIM_APEL");
    $fldRADI_SEGU_APEL = $db->f("R_RADI_SEGU_APEL");
    $fldRADI_USUA_ACTU = $db->f("R_RADI_USUA_ACTU");
    $fldRADI_USUA_NOMBRE = $db->f("SGD_CIU_APELL1")." ".$db->f("SGD_CIU_APELL2")." ".$db->f("SGD_CIU_NOMBRE");	
    $fldRADI_PATH = $db->f("R_RADI_PATH");
    $fldRADI_TDOC_DESC = $db->f("R_TDOC_DESC");
    $fldMUNI_NOMB = $db->f("M_MUNI_NOMB");
    $fldRADI_PATH1 = $db->f("R_RADI_PATH");
	$fldDPTO_CODI = $db->f("R_DPTO_CODI");
	$fldDPTO_NOMB = $db->f("D_DPTO_NOMB");
	$fldDIASR = $db->f("DIASR");
	$fldRADI_DEPE_ACTU = $db->f("RADI_DEPE_ACTU");
    $next_record = $db->next_record();
    
//-------------------------------
// RADICADO Show begin
//-------------------------------

//-------------------------------
/* RADICADO Show Event begin
*/
    if (strlen($fldRADI_PATH)){
	  $iii = $iii +1;
      $fldRADI_PATH="<a href='../bodega$fldRADI_PATH1' target='Imagen$iii'>Si</a>";
	  
    }else{
      $fldRADI_PATH="No";
	}  

// RADICADO Show Event end
//-------------------------------


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="DataTD"><font class="DataFONT"><?=($iCounter+1)+(($iPage-1)*($iRecordsPerPage)) ?></td> 
       <td class="DataTD"><font class="DataFONT"> <a href="<?=$fldRADI_NUME_RADI_URLLink?>?s_RADI_NUME_RADI=<?=$fldRADI_NUME_RADI_s_RADI_NUME_RADI?>&"><font class="DataFONT"><?=$fldRADI_NUME_RADI?></font></a>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_FECH_RADI) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_NOMB) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_USUA_NOMBRE) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_NUME_IDEN) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_TDOC_DESC) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_USUA_ACTU) ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?php  echo $fldRADI_PATH; ?>&nbsp;</font></td>
       <td class="DataTD"><font class="DataFONT">
      <?PHP echo tohtml($fldDPTO_NOMB); ?>&nbsp;</font></td>	  
       <td class="DataTD"><font class="DataFONT">
      <?PHP echo tohtml($fldMUNI_NOMB); ?>&nbsp;</font></td>	  
      <td class="DataTD"><font class="DataFONT">
      <?PHP IF ($fldRADI_DEPE_ACTU!=999){ echo tohtml($fldDIASR);} else {echo "Sal";} ?>&nbsp;</font></td>	  
      </tr>


	  
	  <?
//-------------------------------
// RADICADO Show end
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
     <td colspan="12" class="ColumnTD"><font class="ColumnFONT">
<?
  
  // RADICADO Navigation begin
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
      $sPages .=  "<a href=" . $sFileName . "?" . $form_params . $sSortParams . "FormRADICADO_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
      $iDisplayPages++;
    }
    
    $sPages .= "<font " . "class=\"ColumnFONT\"" . "><b>" . $iPage . "</b></font>&nbsp;";
    $iDisplayPages++;
    
    $iPageCount = $iPage + 1;
    while ($iDisplayPages < $iNumberOfPages && $iStartPage + $iDisplayPages < $iHasPages)
    {
      
      $sPages .= "<a href=\"" . $sFileName . "?" . $form_params . $sSortParams . "FormRADICADO_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</font></a>&nbsp;";
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
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormRADICADO_Page=1#RADICADO"><font class="ColumnFONT">Primero</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormRADICADO_Page=<?=$iPage - 1?>#RADICADO"><font class="ColumnFONT">Anterior</font></a>
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
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormRADICADO_Page=<?=$iPage + 1?>#RADICADO"><font class="ColumnFONT">Siguiente</font></a>
        <a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormRADICADO_Page=last#RADICADO"><font class="ColumnFONT">Ultimo</font></a>
<?
    }
  }

//-------------------------------
// RADICADO Navigation end
//-------------------------------

//-------------------------------
// Finish form processing
//-------------------------------
  ?>
      </font></td></tr>
    </table>
  <?


//-------------------------------
// RADICADO Close Event begin
// RADICADO Close Event end
//-------------------------------
}
//===============================

?>
