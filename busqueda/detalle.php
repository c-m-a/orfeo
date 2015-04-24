<?php
error_reporting(7);
session_start();

/*********************************************************************************
 *       Filename: detalle.php
 *       Generated with CodeCharge 2.0.5
 *       PHP 4.0 build 11/30/2001
 *********************************************************************************/

//-------------------------------
// detalle CustomIncludes begin

include ("./common.php");

// detalle CustomIncludes end
//-------------------------------

session_start();

//===============================
// Save Page and File Name available into variables
//-------------------------------
$sFileName = "detalle.php";
//===============================


//===============================
// detalle PageSecurity begin
check_security();
// detalle PageSecurity end
//===============================

//===============================
// detalle Open Event begin
// detalle Open Event end
//===============================

//===============================
// detalle OpenAnyPage Event start
// detalle OpenAnyPage Event end
//===============================

//===============================
//Save the name of the form and type of action into the variables
//-------------------------------
$sAction = get_param("FormAction");
$sForm = get_param("FormName");
//===============================

// detalle Show begin

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
<?php detalle_show() ?>
    
   </td>
  </tr>
 </table>


<?php

// detalle Show end

//===============================
// detalle Close Event begin
// detalle Close Event end
//===============================
//********************************************************************************


//===============================
// Display Grid Form
//-------------------------------
function detalle_show()
{
//-------------------------------
// Initialize variables  
//-------------------------------
  
  
  global $db;
  global $sdetalleErr;
  global $sFileName;
  global $styles;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $sFormTitle = "Detalle Radicado";
  $HasParam = false;
  $bReq = true;
  $iRecordsPerPage = 5;
  $iCounter = 0;
  $iSort = "";
  $iSorted = "";
  $sDirection = "";
  $sSortParams = "";

  $transit_params = "";
//-------------------------------
// Build ORDER BY statement
//-------------------------------
  $iSort = get_param("Formdetalle_Sorting");
  $iSorted = get_param("Formdetalle_Sorted");

//-------------------------------
// HTML column headers
//-------------------------------
?>
  <table class="FormTABLE">
      <tr>
       <td class="FormHeaderTD" colspan="2"><a name="detalle"><font class="FormHeaderFONT"><?=$sFormTitle?></font></a></td>
      </tr>
<?
  
//-------------------------------
// Build WHERE statement
//-------------------------------
  $ps_RADI_NUME_RADI = get_param("s_RADI_NUME_RADI");

  if(strlen($ps_RADI_NUME_RADI))
  {
    $HasParam = true;
    $sWhere = $sWhere . "R.RADI_NUME_RADI=" . tosql($ps_RADI_NUME_RADI, "Text") . "";
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
  $sSQL = "select R.CARP_CODI as R_CARP_CODI, " . 
    "R.CPOB_CODI as R_CPOB_CODI, " . 
    "R.DPTO_CODI as R_DPTO_CODI, " . 
    "R.EESP_CODI as R_EESP_CODI, " . 
    "R.ESTA_CODI as R_ESTA_CODI, " . 
    "R.MREC_CODI as R_MREC_CODI, " . 
    "R.MUNI_CODI as R_MUNI_CODI, " . 
    "R.RADI_DEPE_ACTU as R_RADI_DEPE_ACTU, " . 
    "R.RADI_DEPE_RADI as R_RADI_DEPE_RADI, " . 
    "R.RADI_DESC_ANEX as R_RADI_DESC_ANEX, " . 
    "R.RADI_DIRE_CORR as R_RADI_DIRE_CORR, " . 
    "R.RADI_FECH_ASIG as R_RADI_FECH_ASIG, " . 
    "to_char(R.RADI_FECH_RADI,'dd/mm/yyyy hh24:mi:ss') as R_RADI_FECH_RADI, " . 
    "R.RADI_NOMB as R_RADI_NOMB, " . 
    "R.RADI_NUME_DERI as R_RADI_NUME_DERI, " . 
    "R.RADI_NUME_HOJA as R_RADI_NUME_HOJA, " . 
    "R.RADI_NUME_IDEN as R_RADI_NUME_IDEN, " . 
    "R.RADI_NUME_RADI as R_RADI_NUME_RADI, " . 
    "R.RADI_PAIS as R_RADI_PAIS, " . 
    "R.RADI_PATH as R_RADI_PATH, " . 
    "R.RADI_PRIM_APEL as R_RADI_PRIM_APEL, " . 
    "R.RADI_REM as R_RADI_REM, " . 
    "R.RADI_SEGU_APEL as R_RADI_SEGU_APEL, " . 
    "R.RADI_TELE_CONT as R_RADI_TELE_CONT, " . 
    "R.RADI_TIPO_EMPR as R_RADI_TIPO_EMPR, " . 
    "R.RADI_USUA_ACTU as R_RADI_USUA_ACTU, " . 
    "R.RADI_USUA_RADI as R_RADI_USUA_RADI, " . 
    "R.RADI_USU_ANTE as R_RADI_USU_ANTE, " . 
    "R.RA_ASUN as R_RA_ASUN, " . 
    "R.TDID_CODI as R_TDID_CODI, " . 
    "R.TDOC_CODI as R_TDOC_CODI, " . 
    "R.TRTE_CODI as R_TRTE_CODI, " . 
    "R.CODI_NIVEL as R_CODI_NIVEL, " . 
    "T.SGD_TPR_CODIGO as T_TDOC_CODI, " . 
    "T.SGD_TPR_DESCRIP as T_TDOC_DESC, " . 
    "M.MUNI_CODI as M_MUNI_CODI, " . 
    "M.MUNI_NOMB as M_MUNI_NOMB, " . 
    "D.DPTO_CODI as D_DPTO_CODI, " . 
    "D.DPTO_NOMB as D_DPTO_NOMB, " . 
    "T1.TDID_CODI as T1_TDID_CODI, " . 
    "T1.TDID_DESC as T1_TDID_DESC, " . 
    "T2.TRTE_CODI as T2_TRTE_CODI, " . 
    "T2.TRTE_DESC as T2_TRTE_DESC, " . 
    "M1.MREC_CODI as M1_MREC_CODI, " . 
    "M1.MREC_DESC as M1_MREC_DESC, " . 
    "U.USUA_CODI as U_USUA_CODI, " . 
    "U.USUA_LOGIN as U_USUA_LOGIN, " . 
    "U.USUA_NOMB as U_USUA_NOMB, " . 
    "D1.DEPE_CODI as D1_DEPE_CODI, " . 
    "D1.DEPE_NOMB as D1_DEPE_NOMB, " . 
    "D2.DEPE_CODI as D2_DEPE_CODI, " . 
    "D2.DEPE_NOMB as D2_DEPE_NOMB, " . 
    "U1.USUA_CODI as U1_USUA_CODI, " . 
    "U1.USUA_LOGIN as U1_USUA_LOGIN " . 
    " from RADICADO R, SGD_TPR_TPDCUMENTO T, MUNICIPIO M, DEPARTAMENTO D, TIPO_DOC_IDENTIFICACION T1, TIPO_REMITENTE T2, MEDIO_RECEPCION M1, USUARIO U, DEPENDENCIA D1, DEPENDENCIA D2, USUARIO U1"  . 
    " where T.SGD_TPR_CODIGO=R.TDOC_CODI and M.MUNI_CODI=R.MUNI_CODI and D.DPTO_CODI=R.DPTO_CODI and T1.TDID_CODI=R.TDID_CODI and T2.TRTE_CODI=R.TRTE_CODI and M1.MREC_CODI=R.MREC_CODI and U.USUA_CODI(+)=R.RADI_USUA_ACTU and D1.DEPE_CODI(+)=R.RADI_DEPE_ACTU and D2.DEPE_CODI=R.RADI_DEPE_RADI and U1.USUA_CODI=R.RADI_USUA_RADI  ";
//-------------------------------

//-------------------------------
// detalle Open Event begin
$sWhere .= " AND M.DPTO_CODI=D.DPTO_CODI AND U.DEPE_CODI=D1.DEPE_CODI AND U1.DEPE_CODI=D2.DEPE_CODI ";
// detalle Open Event end
//-------------------------------

//-------------------------------
// Assemble full SQL statement
//-------------------------------
  $sSQL .= $sWhere . $sOrder;
//-------------------------------

//-------------------------------
// Execute SQL statement
//-------------------------------
  $db->query($sSQL);
  $next_record = $db->next_record();
//-------------------------------
//  echo $sSQL;
//-------------------------------
// Create field variables based on database fields
//-------------------------------
    $fldCARP_CODI = $db->f("R_CARP_CODI");
    $fldCPOB_CODI = $db->f("R_CPOB_CODI");
    $fldCODI_NIVEL = $db->f("R_CODI_NIVEL");
    $fldDPTO_CODI = $db->f("D_DPTO_NOMB");
    $fldEESP_CODI = $db->f("R_EESP_CODI");
    $fldESTA_CODI = $db->f("R_ESTA_CODI");
    $fldMREC_CODI = $db->f("M1_MREC_DESC");
    $fldMUNI_CODI = $db->f("M_MUNI_NOMB");
    $fldRA_ASUN = $db->f("R_RA_ASUN");
    $fldRADI_DEPE_ACTU = $db->f("D1_DEPE_NOMB");
    $fldRADI_DEPE_RADI = $db->f("D2_DEPE_NOMB");
    $fldRADI_DESC_ANEX = $db->f("R_RADI_DESC_ANEX");
    $fldRADI_DIRE_CORR = $db->f("R_RADI_DIRE_CORR");
    $fldRADI_FECH_ASIG = $db->f("R_RADI_FECH_ASIG");
    $fldRADI_FECH_RADI = $db->f("R_RADI_FECH_RADI");
    $fldRADI_NOMB = $db->f("R_RADI_NOMB");
    $fldRADI_NUME_DERI = $db->f("R_RADI_NUME_DERI");
    $fldRADI_NUME_HOJA = $db->f("R_RADI_NUME_HOJA");
    $fldRADI_NUME_IDEN = $db->f("R_RADI_NUME_IDEN");
    $fldRADI_NUME_RADI_URLLink = $db->f("R_RADI_PATH");
    $fldRADI_NUME_RADI = $db->f("R_RADI_NUME_RADI");
    $fldRADI_PAIS = $db->f("R_RADI_PAIS");
    $fldRADI_PATH = $db->f("R_RADI_PATH");
    $fldRADI_PRIM_APEL = $db->f("R_RADI_PRIM_APEL");
    $fldRADI_REM = $db->f("R_RADI_REM");
    $fldRADI_SEGU_APEL = $db->f("R_RADI_SEGU_APEL");
    $fldRADI_TELE_CONT = $db->f("R_RADI_TELE_CONT");
    $fldRADI_TIPO_EMPR = $db->f("R_RADI_TIPO_EMPR");
    $fldRADI_USU_ANTE = $db->f("R_RADI_USU_ANTE");
    $fldRADI_USUA_ACTU = $db->f("U_USUA_NOMB");
    $fldRADI_USUA_RADI = $db->f("U1_USUA_LOGIN");
    $fldTDID_CODI = $db->f("T1_TDID_DESC");
    $fldTDOC_CODI = $db->f("T_TDOC_DESC");
    $fldTRTE_CODI = $db->f("T2_TRTE_DESC");

    
//-------------------------------
// detalle Show begin
//-------------------------------

//-------------------------------
// detalle Show Event begin
$fldRADI_DEPE_RADI = $db->f("R_RADI_DEPE_RADI") . " - " . $db->f("D2_DEPE_NOMB");
$fldRADI_NUME_RADI_URLLink = "../bodega" . $db->f("R_RADI_PATH");
// detalle Show Event end
//-------------------------------
    $next_record = $db->next_record();
echo "<tr><td>$fldRADI_NUME_HOJA<td><tr>";
error_reporting(0);
include ("../jh_class/funciones_sgd.php");
$verrad = $ps_RADI_NUME_RADI;
$numrad = $ps_RADI_NUME_RADI;
$ruta_raiz = "..";
$no_tipo = "true";
include "../config.php";
include "../ver_datosrad.php";
$a = new LOCALIZACION($codep_us1,$muni_us1,"..");
$muni_nombre_us1 = $a->municipio;
$dpto_nombre_us1 = $a->departamento;
$a = new LOCALIZACION($codep_us2,$muni_us2,"..");
$muni_nombre_us2 =$a->municipio;
$dpto_nombre_us2 =$a->departamento;
$a = new LOCALIZACION($codep_us3,$muni_us3,"..");
$muni_nombre_us3 =$a->municipio;
$dpto_nombre_us3 =$a->departamento;


//-------------------------------
// Process the HTML controls
//-------------------------------
?>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Radicado</font></td><td class="DataTD"><font class="DataFONT">

<?
error_reporting(7);
if ($radi_path==""){
   echo "<font class=\DataFONT\>$verrad</font>";
}else{
   echo "<a href='../bodega$radi_path'><font class=\DataFONT\>$verrad</font> </a>";
}
?>

&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Fecha Radicaci&oacute;n</font></td><td class="DataTD"><font class="DataFONT">
      <?=$radi_fech_radi ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD" bgcolor="#999999"><font class="ColumnFONT">Datos Rem 1</font></td><td bgcolor="#CFCFCF"><font class="DataFONT">
      <?= tohtml($nombret_us1) ?>&nbsp;</font></td> 
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Direcci&oacute;n</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($direccion_us1) ?>&nbsp;</font></td> 
      </tr>	
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Numero Identificaci&oacute;n</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($cc_documento_us1) ?>&nbsp;</font></td>
      </tr>
      <tr>
       
    <td class="ColumnTD"><font class="ColumnFONT">Municipio / Departamento</font></td>
<td class="DataTD"><font class="DataFONT">
      <?=$muni_nombre_us1." / ".$dpto_nombre_us1?>&nbsp;</font></td>
      </tr>	  	    
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Datos Predio 2</font></td><td bgcolor="#CFCFCF"><font class="DataFONT">
      <?= tohtml($nombret_us2) ?>&nbsp;</font></td> 
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Direcci&oacute;n Predio</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($direccion_us2) ?>&nbsp;</font></td> 
      </tr>	 	  
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Numero Identificaci&oacute;n</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($cc_documento_us2) ?>&nbsp;</font></td>
      </tr>	  
	        <tr>
       
      <td class="ColumnTD"><font class="ColumnFONT">Municipio / Departamento</font></td>
	  <td class="DataTD"><font class="DataFONT">
      <?=$muni_nombre_us2." / ".$dpto_nombre_us2?>&nbsp;</font></td>
      </tr>
	  
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Empresa</font></td><td bgcolor="#CFCFCF"><font class="DataFONT">
      <?= tohtml($nombret_us3) ?>&nbsp;</font></td> 
      </tr>	  	  
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Direcci&oacute;n Empresa</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($direccion_us3) ?>&nbsp;</font></td> 
      </tr>	 	  
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Numero Identificaci&oacute;n Emp</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($cc_documento_us3) ?>&nbsp;</font></td>
      </tr>	  
      <tr>
       
    <td class="ColumnTD"><font class="ColumnFONT">Municipio / Departamento</font></td>
<td class="DataTD"><font class="DataFONT">
      <?=$muni_nombre_us3." / ".$dpto_nombre_us3?>&nbsp;</font></td>
      </tr>	  	  
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Asunto</font></td><td class="DataTD"><font class="DataFONT">
      <?=tohtml($ra_asun) ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Tipo de Documento</font></td><td class="DataTD"><font class="DataFONT">
      <?=tohtml($tpdoc_nombre) ?>&nbsp;</font></td>
      </tr>

       <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Codigo Carpeta</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($carpeta) ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Medio de Recepci&oacute;n</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldMREC_CODI) ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">N&uacute;mero de Hojas</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_NUME_HOJA) ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Descripci&oacute;n de Anexos</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldRADI_DESC_ANEX) ?>&nbsp;</font></td>
      </tr>
      <tr>
       
    <td class="ColumnTD"><font class="ColumnFONT">Radicado Padre</font></td>
<td class="DataTD"><font class="DataFONT">
      <?= tohtml($radi_nume_deri) ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Codigo Estado</font></td><td class="DataTD"><font class="DataFONT">
      <?= tohtml($fldESTA_CODI) ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Usuario Anterior</font></td><td class="DataTD"><font class="DataFONT">
      <?=tohtml($radi_usua_ante) ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Usuario Actual</font></td><td class="DataTD"><font class="DataFONT">
	   <?
	   $ruta_raiz = "..";
	   require "../jh_class/funciones_bd.php";
	   $kk = new BD("select usua_nomb from usuario where depe_codi=$radi_depe_actu and usua_codi=$radi_usua_actu",0,"..") ;
	   $usua_nomb = $kk->campo;
	   ?>	   
      <?=$usua_nomb." (".tohtml($radi_usua_actu).")" ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Dependencia Actual</font></td><td class="DataTD"><font class="DataFONT">
	   <?
	   $kk = new BD("select depe_nomb from dependencia where depe_codi=$radi_depe_actu",0,"..") ;
	   $depe_nomb = $kk->campo;
	   ?>
      <?=$depe_nomb." (".tohtml($radi_depe_actu).")"?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Dependencia Radicaci&oacute;n</font></td><td class="DataTD"><font class="DataFONT">
	   <? 
	   $kk = new BD("select depe_nomb from dependencia where depe_codi=$radi_depe_radicacion",0,"..") ;
	   $depe_nomb = $kk->campo;
	   ?>
      <?=$depe_nomb." (".tohtml($radi_depe_radicacion).")" ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Dependencia Inicial</font></td><td class="DataTD"><font class="DataFONT">
	   <? 
	   $kk = new BD("select depe_nomb from dependencia where depe_codi=$radi_depe_radi",0,"..") ;
	   $depe_nomb = $kk->campo;
	   ?>      
	  <?=$depe_nomb." (".tohtml($radi_depe_radi).")" ?>&nbsp;</font></td>
      </tr>	  
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Usuario Radicador</font></td><td class="DataTD"><font class="DataFONT">
      <? ?>&nbsp;</font></td>
      </tr>
      <tr>
       <td class="ColumnTD"><font class="ColumnFONT">Historial</font></td>
	   
    <td class="DataTD"><font class="DataFONT"><a href='historico.php?radicado=<?=$nurad."&".session_name()."=".session_id()?>'> 
      Ver Hist&oacute;rico&nbsp;</a></font></td>
      </tr>
	  </TABLE>
<?


//-------------------------------
// Finish form processing
//-------------------------------


//-------------------------------
// detalle Close Event begin
// detalle Close Event end
//-------------------------------
}
//===============================

?>
