<?php
function Search_show() {
  global $db;
  global $styles;
  global $db2;
  global $db3;
  global $sForm;
  $sFormTitle = "B&uacute;squeda Cl&aacute;sica";
  $sActionFileName = "busquedaPiloto.php";
  $ss_desde_RADI_FECH_RADIDisplayValue = "";
  $ss_hasta_RADI_FECH_RADIDisplayValue = "";
  $ss_TDOC_CODIDisplayValue = "Todos los Tipos";
  $ss_TRAD_CODIDisplayValue = "Todos los Tipos (-1,-2,-3,-5, . . .)";
  $ss_RADI_DEPE_ACTUDisplayValue = "Todas las Dependencias";
  //Con esta variable se determina si la busqueda corresponde a vinculacion documentos
  $indiVinculo= $_GET["indiVinculo"];
  $verrad     = $_GET["verrad"];
  $carpeAnt   = $_GET["carpeAnt"];
  $nomcarpeta = $_GET["nomcarpeta"];
  $krd        = $_SESSION["krd"];
  $dependencia= $_SESSION["dependencia"];
  $usua_doc   = $_SESSION["usua_doc"];
  $codusuario = $_SESSION["codusuario"];
  $nivelus    = $_SESSION["nivelus"];
  
  if($_REQUEST["flds_TDOC_CODI"])
    $flds_TDOC_CODI=$_REQUEST["flds_TDOC_CODI"];

  foreach ($_GET as $key => $valor) ${$key} = $valor;
  foreach ($_POST as $key => $valor) ${$key} = $valor;

  if ($indiVinculo == 1) 
    $sFormTitle = $sFormTitle . '  Anexo  al Vuelo ';
	
  if ($indiVinculo == 2) 
    $sFormTitle = $sFormTitle . '  Incluir Expediente ';
  
  $flds_DOCTO     = $_GET["s_DOCTO"];
  $flds_RADI_NOMB = $_GET["s_RADI_NOMB"];
  $flds_ciudadano = $_GET["s_ciudadano"];
  $flds_empresaESP= $_GET["s_empresaESP"];
  $flds_oEmpresa  = $_GET["s_oEmpresa"];
  $flds_entrada   = $_GET["s_entrada"];
  $flds_salida    = $_GET["s_salida"];
  $flds_solo_nomb = $_GET["s_solo_nomb"];
	$Busqueda       = $_GET["Busqueda"];
  $flds_desde_dia = $_GET["s_desde_dia"];
  $flds_hasta_dia = $_GET["s_hasta_dia"];
  $flds_desde_mes = $_GET["s_desde_mes"];
  $flds_hasta_mes = $_GET["s_hasta_mes"];
  $flds_desde_ano = $_GET["s_desde_ano"];
  $flds_hasta_ano = $_GET["s_hasta_ano"];
  $flds_TDOC_CODI = $_GET["s_TDOC_CODI"];
	$s_Listado      = $_GET["s_Listado"];
  $flds_FUNCIONARIO = $_GET["s_FUNCIONARIO"];
  $flds_RADI_NUME_RADI = $_GET["s_RADI_NUME_RADI"];
  $flds_RADI_DEPE_ACTU = $_GET["s_RADI_DEPE_ACTU"];

	if($flds_ciudadano) $checkCIU = "checked";
	if($flds_empresaESP) $checkESP = "checked";
	if($flds_oEmpresa) $checkOEM = "checked";
	if($flds_FUNCIONARIO) $checkFUN = "checked";
 /**
   * Busqueda por expediente
   * Fecha de modificacion: 30-Junio-2006
   * Modificador: Supersolidaria
   */
   $flds_SGD_EXP_SUBEXPEDIENTE = $_GET["s_SGD_EXP_SUBEXPEDIENTE"];

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
  } else { // DESDE HACE UN MES HASTA HOY 
    $desdeTimestamp = mktime(0,0,0, Date('m')-1,  Date('d'),  Date('Y'));
    $flds_desde_dia = Date('d', $desdeTimestamp);
    $flds_hasta_dia = Date('d');
    $flds_desde_mes = Date('m', $desdeTimestamp);
    $flds_hasta_mes = Date('m');
    $flds_desde_ano = Date('Y', $desdeTimestamp);
    $flds_hasta_ano = Date('Y');
  }

  $varibles_busqueda = session_name() . '=' . session_id() . 
                        '&indiVinculo=' . $indiVinculo .
                        '&verrad=' . $verrad .
                        '&carpeAnt=' . $carpeAnt .
                        '&nomcarpeta=' . $nomcarpeta;
?>
<form method="get" action="busquedaPiloto.php?<?=$varibles_busqueda?>" name="Search">
<input type='hidden' name='<?=session_name()?>' value='<?=session_id()?>'>
<input type="hidden" name="FormName" value="Search"><input type="hidden" name="FormAction" value="search">
  <table  border=0 cellpadding=0 cellspacing=2 class='borde_tab'>
    <tr>
      <td  class="titulos4" colspan="13"><a name="Search">
        <?=$sFormTitle?>
      </td>
    </tr>
    <tr>
      <td class="titulos5">Radicado</td>
      <td class="listado5">
        <input class="tex_area" type="text" name="s_RADI_NUME_RADI" maxlength="" value="<?=tohtml($flds_RADI_NUME_RADI) ?>" size="" id="cajarad">
      </td>
    </tr>
    <tr>
      <td class="titulos5">Identificaci&oacute;n (T.I.,C.C.,Nit) *</td>
      <td class="listado5">
        <input class="tex_area" type="text" name="s_DOCTO" maxlength="" value="<?=tohtml($flds_DOCTO) ?>" size="" >
      </td>
    </tr>

    <!--
    /**
    * Busqueda por expediente
    * Fecha de modificaci�n: 30-Junio-2006
    * Modificador: Supersolidaria
    */
    -->
    <tr>
      <td class="titulos5">Expediente</td>
      <td class="listado5">
        <input class="tex_area" type="text" name="s_SGD_EXP_SUBEXPEDIENTE" maxlength="" value="<?=tohtml($flds_SGD_EXP_SUBEXPEDIENTE) ?>" size="" >
      </td>
    </tr>
    <tr>
      <td class="titulos5">
        <input type="radio" NAME="s_solo_nomb" value="All" CHECKED
  <?if($flds_solo_nomb=="All"){ echo ("CHECKED");} ?>>
        Buscar Por<br>
        <!--<INPUT type="radio" NAME="s_solo_nomb" value="Any"
  <? if($flds_solo_nomb=="Any"){echo ("CHECKED");} ?>>Cualquier Palabra (o)<br>-->
        </td>
      <td class="listado5">
        <input class="tex_area" type="text" name="s_RADI_NOMB" maxlength="70" value="<?=tohtml($flds_RADI_NOMB) ?>" size="70" >
      </td>
    </tr>
    <tr>
      <td colspan="2" class="FieldCaptionTD">
        <table>
          <tr >
            <td class="titulos5" width="15%">
<?php
  if($s_Listado=="VerListado") {
			$listadoView = " checked=checked";
	}
?>
    <input type="checkbox" NAME="s_Listado" value="VerListado" <?=$listadoView?> onClick="delTodas();document.Search.elements['s_Listado'].checked=true;">
    Ver en Listado
  </td>
  <td class="titulos5" width="15%">
    <input type="checkbox" NAME="s_ciudadano" value="CIU" onClick="delTodas();document.Search.elements['s_ciudadano'].checked=true;" <?=$checkCIU?> >
    Buscar Ciudadanos
  </td>
 </td>
            <td class="titulos5" width="20%">
              <INPUT type="checkbox" NAME="s_empresaESP" value="ESP" onClick="delTodas();document.Search.elements['s_empresaESP'].checked= true;" <?=$checkESP?> >
              Buscar en Entidad</td>
            <td class="titulos5" width="20%">
              <INPUT type="checkbox" NAME="s_oEmpresa" value="OEM" onClick="delTodas();document.Search.elements['s_oEmpresa'].checked=true;" <?=$checkOEM?> >
              Buscar en Empresas</td>
            <td width="20%"  class="titulos5">
              <INPUT type="checkbox" NAME="s_FUNCIONARIO" value="FUN" onClick="delTodas();document.Search.elements['s_FUNCIONARIO'].checked=true;" <?=$checkFUN?> >
              Buscar Funcionarios</td>
          </tr>
          <td colspan="5" class="titulos5"> </td>
          </tr>
        </table>
      </td>
    </tr>
    <tr>
      <td class="titulos5"> Buscar en Radicados de</td>
      <td class="listado5">
        <select class="select" name="s_entrada">
<?php
	if(!$s_Listado) $s_Listado="VerListado";
  if ($flds_entrada==0) $flds_entrada="9999";
  echo "<option value=\"9999\">" . $ss_TRAD_CODIDisplayValue . "</option>";
  $lookup_s_entrada = db_fill_array("select SGD_TRAD_CODIGO, SGD_TRAD_DESCR from SGD_TRAD_TIPORAD order by 2");

  if(is_array($lookup_s_entrada)) {
    reset($lookup_s_entrada);
    while(list($key, $value) = each($lookup_s_entrada)) {
      if($key == $flds_entrada) $option="<option SELECTED value=\"$key\">$value</option>";
      else $option="<option value=\"$key\">$value</option>";
      echo $option;
    }
  }
  ?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="titulos5">Desde Fecha (dd/mm/yyyy)</td>
      <td class="listado5">
        <select class="select" name="s_desde_dia">
          <?
  for($i = 1; $i <= 31; $i++)
  {
    if($i == $flds_desde_dia) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?>
        </select>
        <select class="select" name="s_desde_mes">
          <?
  for($i = 1; $i <= 12; $i++)
  {
    if($i == $flds_desde_mes) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?>
        </select>
        <select class="select" name="s_desde_ano">
          <?
  $agnoactual=Date('Y');
  for($i = 1990; $i <= $agnoactual; $i++)
  {
    if($i == $flds_desde_ano) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="titulos5">Hasta Fecha (dd/mm/yyyy)</td>
      <td class="listado5">
        <select class="select" name="s_hasta_dia">
          <?
  for($i = 1; $i <= 31; $i++)
  {
    if($i == $flds_hasta_dia) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?>
        </select>
        <select class="select" name="s_hasta_mes">
          <?
  for($i = 1; $i <= 12; $i++)
  {
    if($i == $flds_hasta_mes) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?>
        </select>
        <select class="select" name="s_hasta_ano">
          <?
  for($i = 1990; $i <= $agnoactual; $i++)
  {
    if($i == $flds_hasta_ano) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
  }
  ?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="titulos5"><font class="FieldCaptionFONT">Tipo de Documento</td>
      <td class="listado5">
        <select class="select" name="s_TDOC_CODI">
<?php
  if ($flds_TDOC_CODI==0) $flds_TDOC_CODI="9999";
  echo "<option value=\"9999\">" . $ss_TDOC_CODIDisplayValue . "</option>";
  $lookup_s_TDOC_CODI = db_fill_array("select SGD_TPR_CODIGO, SGD_TPR_DESCRIP from SGD_TPR_TPDCUMENTO order by 2");

  if(is_array($lookup_s_TDOC_CODI)) {
    reset($lookup_s_TDOC_CODI);
    while(list($key, $value) = each($lookup_s_TDOC_CODI)) {
      if($key == $flds_TDOC_CODI) $option="<option SELECTED value=\"$key\">$value</option>";
      else $option="<option value=\"$key\">$value</option>";
      echo $option;
    }
  }
?>
        </select>
      </td>
    </tr>
    <tr>
      <td class="titulos5">Dependencia Actual</td>
      <td class="listado5">
        <select class="select" name="s_RADI_DEPE_ACTU">
<?php
	$l = strlen($flds_RADI_DEPE_ACTU);

	if ($l==0){
		echo "<option value=\"\" SELECTED>" . $ss_RADI_DEPE_ACTUDisplayValue . "</option>";
	}else{
		echo "<option value=\"\">" . $ss_RADI_DEPE_ACTUDisplayValue . "</option>";
	}
$lookup_s_RADI_DEPE_ACTU = db_fill_array("select DEPE_CODI, DEPE_NOMB from DEPENDENCIA where depe_estado=1 order by 2");

if(is_array($lookup_s_RADI_DEPE_ACTU)) {
	reset($lookup_s_RADI_DEPE_ACTU);
	while(list($key, $value) = each($lookup_s_RADI_DEPE_ACTU)) {
		if($l>0 && $key == $flds_RADI_DEPE_ACTU) $option="<option SELECTED value=\"$key\">$value</option>";
		else $option="<option value=\"$key\">$value</option>";
		echo $option;
	}
}
?>
        </select>
      </td>
    </tr>
    <tr>
      <td align="left" colspan="3" class="titulos5">
        <input class="botones" type="button" value="Limpiar" onclick="limpiar();">
        <input class="botones" type="submit" name=Busqueda value="B&uacute;squeda">
      </td>
    </tr>
  </table>
</form>
<?php
}

function Ciudadano_show($nivelus, $tpRemDes, $whereFlds) {
  global $db2;
  global $db3;
  global $sRADICADOErr;
  global $sFileName;
  global $styles;
  global $ruta_raiz;
  $sWhere = "";
  $sOrder = "";
  $sSQL = "";
  $db = new ConnectionHandler($ruta_raiz);
  
	if($tpRemDes==1){
		$tpRemDesNombre = "Por Ciudadano";
	}
  if($tpRemDes==2){
		$tpRemDesNombre = "Por Otras Empresas";
	}
  if($tpRemDes==3){
		$tpRemDesNombre = "Por Entidad";
	}
  if($tpRemDes==4){
		$tpRemDesNombre = "Por Funcionario";
	}
  if($tpRemDes==9){
		$tpRemDesNombre = "";
		$whereTrd = "   ";
	}else{
		$whereTrd = " and dir.sgd_trd_codigo = $whereFlds  ";
	}
	if ($indiVinculo == 2) {
    $sFormTitle = "Expedientes encontrados $tpRemDesNombre";
	} else {
    $sFormTitle = "Radicados encontrados $tpRemDesNombre";
  }
  $HasParam = false;
  $iCounter = 0;
  $iPage    = 0;
  $bEof     = false;
  $iSort    = '';
  $iSorted  = '';
  $iTmpI    = 0;
  $iTmpJ    = 0;
  $sCountSQL= '';
  $sDirection = '';
  $sSortParams = '';
  $transit_params = '';
  $iRecordsPerPage = 25;

  //Proceso de Vinculacion documentos
  $indiVinculo= $_GET["indiVinculo"];
  $verrad     = $_GET["verrad"];
  $carpeAnt   = $_GET["carpeAnt"];
  $nomcarpeta = $_GET["nomcarpeta"];
  

  // Build ORDER BY statement
  //$sOrder = " order by r.RADI_NUME_RADI ";
	$sOrder = " order by r.radi_fech_radi ";
  $iSort = $_GET["FormCIUDADANO_Sorting"];
  $iSorted = $_GET["FormCIUDADANO_Sorted"];
  $form_params = trim(session_name()) . '=' . trim(session_id()) .
                  "&verrad=$verrad&indiVinculo=$indiVinculo&carpeAnt=$carpeAnt&nomcarpeta=$nomcarpeta&s_RADI_DEPE_ACTU=" . 
                    tourl($_GET["s_RADI_DEPE_ACTU"]) .
                    "&s_RADI_NOMB=" . tourl($_GET["s_RADI_NOMB"]) . 
                    "&s_RADI_NUME_RADI=" . tourl($_GET["s_RADI_NUME_RADI"]) .
                    "&s_TDOC_CODI=" . tourl($_GET["s_TDOC_CODI"]) .
                    "&s_desde_dia=" . tourl($_GET["s_desde_dia"]) .
                    "&s_desde_mes=" . tourl($_GET["s_desde_mes"]) .
                    "&s_desde_ano=" . tourl($_GET["s_desde_ano"]) .
                    "&s_hasta_dia=" . tourl($_GET["s_hasta_dia"]) .
                    "&s_hasta_mes=" . tourl($_GET["s_hasta_mes"]) .
                    "&s_hasta_ano=" . tourl($_GET["s_hasta_ano"]) .
                    "&s_solo_nomb=" . tourl($_GET["s_solo_nomb"]) .
                    "&s_ciudadano=" . tourl($_GET["s_ciudadano"]) .
                    "&s_empresaESP=". tourl($_GET["s_empresaESP"]) .
                    "&s_oEmpresa="  . tourl($_GET["s_oEmpresa"]) .
                    "&s_FUNCIONARIO=" . tourl($_GET["s_FUNCIONARIO"]) .
                    "&s_entrada=" . tourl($_GET["s_entrada"]) .
                    "&s_salida=" . tourl($_GET["s_salida"]) .
                    "&s_DOCTO=" . tourl($_GET["s_DOCTO"]) .
                    "&nivelus=$nivelus&s_Listado=" . $_GET["s_Listado"] . 
                    "&s_SGD_EXP_SUBEXPEDIENTE=".$_GET["s_SGD_EXP_SUBEXPEDIENTE"]."&";
  
	// s_Listado s_ciudadano s_empresaESP s_FUNCIONARIO
  if(!$iSort) {
    $form_sorting = "";
  } else {
    if($iSort == $iSorted) {
      $form_sorting = "";
      $sDirection = " DESC ";
      $sSortParams = "FormCIUDADANO_Sorting=" . $iSort . "&FormCIUDADANO_Sorted=" . $iSort . "&";
    } else {
      $form_sorting = $iSort;
      $sDirection = "  ";
      $sSortParams = "FormCIUDADANO_Sorting=" . $iSort . "&FormCIUDADANO_Sorted=" . "&";
    }
    switch ($iSort){
    case   1: $sOrder = " order by r.radi_nume_radi" . $sDirection; break;
    case   2: $sOrder = " order by r.radi_fech_radi" . $sDirection; break;
    case   3: $sOrder = " order by r.ra_asun" . $sDirection; break;
    case   4: $sOrder = " order by td.sgd_tpr_descrip" . $sDirection; break;
    case   5: $sOrder = " order by r.radi_nume_hoja" . $sDirection; break;
    case   6: $sOrder = " order by dir.sgd_dir_direccion" . $sDirection; break; 
    case   7: $sOrder = " order by dir.sgd_dir_telefono" . $sDirection; break;
    case   8: $sOrder = " order by dir.sgd_dir_mail" . $sDirection; break;
    case   9: $sOrder = " order by dir.sgd_dir_nombre" . $sDirection; break;
    case   12: $sOrder = " order by dir.sgd_dir_telefono" . $sDirection; break;
    case   13: $sOrder = " order by dir.sgd_dir_direccion" . $sDirection; break;
    case   14: $sOrder = " order by dir.sgd_dir_doc" . $sDirection; break;
    case   17: $sOrder = " order by r.radi_usu_ante" . $sDirection; break;
    case   20: $sOrder = " order by r.radi_pais" . $sDirection; break;
    case   21: $sOrder = " order by diasr" . $sDirection; break;
    case   22: $sOrder = " order by dir.sgd_dir_nombre" . $sDirection; break;
    case   23: $sOrder = " order by dir.sgd_dir_nombre" . $sDirection; break;
    case   24: $sOrder = " order by dir.sgd_dir_nombre" . $sDirection; break;
    }
  }

// Encabezados HTML de las Columnas
 if ($indiVinculo != 2){
?>
	<table width="2000" border="0" cellpadding="0" cellspacing="0" class="borde_tab"> 
<?php
} else {
?>
	<table width="200" border="0" cellpadding="0" cellspacing="0" class="borde_tab">
<?php
}
?>
	<tr>
		<td class="titulos4" colspan="20">
      <a name="RADICADO"><?=$sFormTitle?></a>
    </td>
	</tr>
	<tr>
<?php
	if ($indiVinculo >= 1) {
?>
		<td class="titulos5"><font class="ColumnFONT"> </td>
<?php
  }	
	if ($indiVinculo != 2) {
?>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=1&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Radicado</a></td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=2&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Fecha Radicacion</a></td>
        <td class="titulos5"><font class="ColumnFONT">Expediente</td>
        <? } else	  {	?>
	    <td class="titulos5"><font class="ColumnFONT">Expediente</td>
        <td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=1&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Radicado vinculado al expediente</a></td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=2&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Fecha Radicacion</a></td>
          <? } ?>
		<td class="titulos5">
      <a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=3&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Asunto</a>
    </td>
		<td class="titulos5">
      <a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=4&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Tipo de Documento</a>
    </td>
		<td class="titulos5">
      <font class="ColumnFONT">Tipo</td>
		<td class="titulos5">
      <a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=5&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Numero de Hojas</a>
    </td>
		<td class="titulos5">
      <a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=6&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Direccion contacto</a>
    </td>
		<td class="titulos5">
      <a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=7&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Telefono contacto</a>
    </td>
		<td class="titulos5">
      <a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=8&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Mail Contacto</a></td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=23&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Dignatario</a></td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=9&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Nombre </a></td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=14&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Documento</a></td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=15&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Usuario Actual</a></td>
		<td class="titulos5"><font class="ColumnFONT">Dependencia Actual</td>
		<td class="titulos5"><font class="ColumnFONT">Usuario Anterior</td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=20&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Pais</a></td>
		<td class="titulos5"><a class="vinculos" href="<?=$sFileName?>?<?=$form_params?>FormCIUDADANO_Sorting=21&FormCIUDADANO_Sorted=<?=$form_sorting?>&">Dias Restantes</a></td>
	</tr>
<?php
  // Build WHERE statement
  // Se crea la $ps_desde_RADI_FECH_RADI con los datos ingresados.
  $ps_desde_RADI_FECH_RADI = mktime(0,0,0,$_GET["s_desde_mes"],$_GET["s_desde_dia"],$_GET["s_desde_ano"]);
  $ps_hasta_RADI_FECH_RADI = mktime(23,59,59,$_GET["s_hasta_mes"],$_GET["s_hasta_dia"],$_GET["s_hasta_ano"]);

  if(strlen($ps_desde_RADI_FECH_RADI) && strlen($ps_hasta_RADI_FECH_RADI) && strlen(trim($_GET["s_RADI_NUME_RADI"]))!=14) {
    $HasParam = true;
    $sWhere = $sWhere . $db->conn->SQLDate('Y-m-d','r.radi_fech_radi')." >= ".$db->conn->DBDate($ps_desde_RADI_FECH_RADI) ;
    //$sWhere = $sWhere . "r.radi_fech_radi>=".$db->conn->DBTimeStamp($ps_desde_RADI_FECH_RADI) ; //by HLP.
    $sWhere .= " and ";
    $sWhere = $sWhere . $db->conn->SQLDate('Y-m-d','r.radi_fech_radi')." <= ".$db->conn->DBDate($ps_hasta_RADI_FECH_RADI) ;
    //$sWhere = $sWhere . "r.radi_fech_radi<=".$db->conn->DBTimeStamp($ps_hasta_RADI_FECH_RADI); //by HLP.
  }
//echo $sWhere;
/* Se recibe la dependencia actual para bsqueda */
  $ps_RADI_DEPE_ACTU = $_GET["s_RADI_DEPE_ACTU"];
  if(is_number($ps_RADI_DEPE_ACTU) && strlen($ps_RADI_DEPE_ACTU))
    $ps_RADI_DEPE_ACTU = tosql($ps_RADI_DEPE_ACTU, "Number");
  else
    $ps_RADI_DEPE_ACTU = "";

  if(strlen($ps_RADI_DEPE_ACTU)) {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "r.radi_depe_actu=" . $ps_RADI_DEPE_ACTU;
  }

  // Se recibe el nmero del radicado para bsqueda
  $ps_RADI_NUME_RADI = trim($_GET["s_RADI_NUME_RADI"]);
  if(!$ps_RADI_NUME_RADI) $ps_RADI_NUME_RADI="2";
  $ps_DOCTO =  $_GET["s_DOCTO"];
  if(strlen($ps_RADI_NUME_RADI)!=14) {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "cast(r.radi_nume_radi as varchar(15)) like " . tosql("%".trim($ps_RADI_NUME_RADI) ."%", "Text");
  }
  if(strlen($ps_RADI_NUME_RADI)==14){
	//$sWhere.=" and ";
	$HasParam=true;
	 $sWhere.="r.radi_nume_radi=".$ps_RADI_NUME_RADI; 
}

    if(strlen($ps_DOCTO)) {
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . " dir.SGD_DIR_DOC = '$ps_DOCTO' " ;
  }

  /**
    * Se recibe el numero del expediente para busqueda
    * Fecha de modificacion: 30-Junio-2006
    * Modificador: Supersolidaria
    */
    $ps_SGD_EXP_SUBEXPEDIENTE = $_GET["s_SGD_EXP_SUBEXPEDIENTE"];
    if( strlen( $ps_SGD_EXP_SUBEXPEDIENTE ) != 0) {
        if( $sWhere != "" ) {
            $sWhere .= " and ";
        }
        $HasParam = true;
        $sWhere = $sWhere . " R.RADI_NUME_RADI = EXP.RADI_NUME_RADI";
        $sWhere = $sWhere . " AND EXP.SGD_EXP_NUMERO = SEXP.SGD_EXP_NUMERO";
        /**
          * No se tienen en cuenta los radicados que han sido excluidos de un expediente.
          * Fecha de modificacion: 12-Septiembre-2006
          * Modificador: Supersolidaria
          */
        $sWhere = $sWhere . " AND EXP.SGD_EXP_ESTADO <> 2";
        $sWhere = $sWhere . " AND ( EXP.SGD_EXP_NUMERO LIKE '%".str_replace( '\'', '', tosql( trim( $ps_SGD_EXP_SUBEXPEDIENTE ), "Text" ) )."%'";
        $sWhere = $sWhere . " OR SEXP.SGD_SEXP_PAREXP1 LIKE UPPER( '%".str_replace( '\'', '', tosql( trim( $ps_SGD_EXP_SUBEXPEDIENTE ), "Text" ) )."%' )";
        $sWhere = $sWhere . " OR SEXP.SGD_SEXP_PAREXP2 LIKE UPPER( '%".str_replace( '\'', '', tosql( trim( $ps_SGD_EXP_SUBEXPEDIENTE ), "Text" ) )."%' )";
        $sWhere = $sWhere . " OR SEXP.SGD_SEXP_PAREXP3 LIKE UPPER( '%".str_replace( '\'', '', tosql( trim( $ps_SGD_EXP_SUBEXPEDIENTE ), "Text" ) )."%' )";
        $sWhere = $sWhere . " OR SEXP.SGD_SEXP_PAREXP4 LIKE UPPER( '%".str_replace( '\'', '', tosql( trim( $ps_SGD_EXP_SUBEXPEDIENTE ), "Text" ) )."%' )";
        $sWhere = $sWhere . " OR SEXP.SGD_SEXP_PAREXP5 LIKE UPPER( '%".str_replace( '\'', '', tosql( trim( $ps_SGD_EXP_SUBEXPEDIENTE ), "Text" ) )."%' )";
        $sWhere = $sWhere . " )";
    }

  // Se decide si busca en radicado de entrada o de salida o ambos
  $ps_entrada = strip($_GET["s_entrada"]);
  $eLen = strlen($ps_entrada);
  $ps_salida = strip($_GET["s_salida"]);
  $sLen = strlen($ps_salida);

  if($ps_entrada!="9999" ){
    if($sWhere != "")
      $sWhere .= " and ";
    $HasParam = true;
    $sWhere = $sWhere . "cast(r.radi_nume_radi as varchar(15)) like " . tosql("%".trim($ps_entrada), "Text");
  }


  // Se recibe el tipo de documento para la busqueda 
  $ps_TDOC_CODI = $_GET["s_TDOC_CODI"];
  if(is_number($ps_TDOC_CODI) && strlen($ps_TDOC_CODI) && $ps_TDOC_CODI != "9999")
    $ps_TDOC_CODI = tosql($ps_TDOC_CODI, "Number");
  else
    $ps_TDOC_CODI = "";
  if(strlen($ps_TDOC_CODI))
  {
    if($sWhere != "")
      $sWhere .= " and ";

    $HasParam = true;
    $sWhere = $sWhere . "r.tdoc_codi=" . $ps_TDOC_CODI;
  }

  // Se recibe la caadena a buscar y el tipo de busqueda (All) (Any)
  $ps_RADI_NOMB = strip($_GET["s_RADI_NOMB"]);
  $ps_solo_nomb = $_GET["s_solo_nomb"];
  $yaentro=false;
  if(strlen($ps_RADI_NOMB)) //&& $ps_solo_nomb == "Any")
  {
    if($sWhere != "")
      $sWhere .= " and (";
	$HasParam=true;
	$sWhere .= " ";

	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	$tok = strtok($ps_RADI_NOMB," ");
	$sWhere .= "(";
	while ($tok) {
		$sWhere .= "";
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(dir.sgd_dir_nomremdes) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .=") or (";
	$tok = strtok($ps_RADI_NOMB," ");
	$yaentro=false;
	while ($tok) {
		$sWhere .= "";
		if ($yaentro == true ) {
			$sWhere .= " and ";
		}
		$sWhere .= "UPPER(dir.sgd_dir_nombre) LIKE '%".$tok."%' ";
	    $tok = strtok(" ");
		$yaentro=true;
	}
	$sWhere .= ") or (";
    $yaentro=false;
$tok = strtok($ps_RADI_NOMB," ");
if ($yaentro == true ) $sWhere .= " and (";

$sWhere .= "UPPER(".$db->conn->Concat("r.ra_asun","r.radi_cuentai","dir.sgd_dir_telefono","dir.sgd_dir_direccion") . ") LIKE '%".$ps_RADI_NOMB."%' ";
   $tok = strtok(" ");
if ($yaentro == true ) $sWhere .= ")";
	
	$yaentro=true;
	$sWhere .="))";

  }

  if(strlen($ps_RADI_NOMB) && $ps_solo_nomb == "AllTTT") {
	  if($sWhere != "")
		  $sWhere .= " AND (";
	  $HasParam=true;
	  $sWhere .= " ";

	  $ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
	  $tok = strtok($ps_RADI_NOMB," ");
	  $sWhere .= "(";
	  $sWhere .= "";
	  if ($yaentro == true ) {
		  $sWhere .= " AND ";
	  }
	  $sWhere .= "UPPER(dir.sgd_dir_nomremdes) LIKE '%".$ps_RADI_NOMB."%' ";
	  $tok = strtok(" ");
	  $yaentro=true;
	  $sWhere .=") OR (";
	  $tok = strtok($ps_RADI_NOMB," ");
	  $yaentro=false;
	  $sWhere .= "";
	  if ($yaentro == true ) {
		  $sWhere .= " AND ";
	  }
	  $sWhere .= "UPPER(dir.sgd_dir_nombre) LIKE '%".$ps_RADI_NOMB."%' ";
	  $tok = strtok(" ");
	  $yaentro=true;
	  $sWhere .= ") OR (";
	  $yaentro=false;
	  $tok = strtok($ps_RADI_NOMB," ");
	  if ($yaentro == true ) $sWhere .= " AND (";
	  $sWhere .= "UPPER(".$db->conn->Concat("r.ra_asun","r.radi_cuentai","dir.sgd_dir_telefono","dir.sgd_dir_direccion").") LIKE '%".$ps_RADI_NOMB."%' ";
	  echo " kkkk $ps_RADI_NOMB";
	  $tok = strtok(" ");
	  if ($yaentro == true ) $sWhere .= ")";
	  $yaentro=true;
	  $sWhere .="))";
  }
  if($HasParam)
	  $sWhere = " AND (" . $sWhere . ") ";

  // Build base SQL statement
  require_once("../include/query/busqueda/busquedaPiloto1.php");
  $sSQL = "SELECT ".
	  $radi_nume_radi." AS RADI_NUME_RADI,".
	  $db->conn->SQLDate('Y-m-d H:i:s','R.RADI_FECH_RADI')." AS RADI_FECH_RADI,
                                                            r.RA_ASUN, 
                                                            td.sgd_tpr_descrip, ".
                                                              $redondeo." as diasr,
                                                            r.RADI_NUME_HOJA, 
                                                            r.RADI_PATH, 
                                                            dir.SGD_DIR_DIRECCION, 
                                                            dir.SGD_DIR_MAIL,
                                                            dir.SGD_DIR_NOMREMDES, 
                                                            dir.SGD_DIR_TELEFONO, 
                                                            dir.SGD_DIR_DIRECCION,
                                                            dir.SGD_DIR_DOC, 
                                                            r.RADI_USU_ANTE, 
                                                            r.RADI_PAIS, 
                                                            dir.SGD_DIR_NOMBRE,
                                                            dir.SGD_TRD_CODIGO, 
                                                            r.RADI_DEPE_ACTU, 
                                                            r.RADI_USUA_ACTU, 
                                                            r.CODI_NIVEL, 
                                                            r.SGD_SPUB_CODIGO";

  /**
   * Busqueda por parameto del expediente
   * Fecha de modificacion: 11-Agosto-2006
   * Modificador: Supersolidaria
   */
  if( strlen( $ps_SGD_EXP_SUBEXPEDIENTE ) != 0 )	$sSQL .= " ,EXP.SGD_EXP_NUMERO";

  $sSQL .= " FROM sgd_dir_drecciones dir, radicado r, sgd_tpr_tpdcumento td";	

  /**
   * Busqueda por expediente
   * Fecha de modificacion: 30-Junio-2006
   * Modificador: Supersolidaria
   */
  if( strlen( $ps_SGD_EXP_SUBEXPEDIENTE ) != 0) {
	  $sSQL .= ", SGD_EXP_EXPEDIENTE EXP, SGD_SEXP_SECEXPEDIENTES SEXP";
  }
  $sSQL .= " WHERE dir.sgd_dir_tipo = 1 AND dir.RADI_NUME_RADI=r.RADI_NUME_RADI AND r.TDOC_CODI=td.SGD_TPR_CODIGO";
  
  //SE QUITA " AND r.CODI_NIVEL <=$nivelus "
  $sSQL .= $sWhere . $whereTrd . $sOrder;
// $db->conn->debug=true;
//-------------------------------
// Execute SQL statement
//-------------------------------
//$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
// print $sSQL;

$rs = $db->conn->query($sSQL);
$db->conn->SetFetchMode(ADODB_FETCH_NUM);
	//echo "<hr>$sSQL<hr>";
//include "rp.php";
 //echo"<a href='rp.php?rs='.$rs.' class=\"vinculos\">1.Archivo </a>";echo "2222222222222222222222222222222222";    
function array_envia($db) {
  $tmp = serialize($array);
  $tmp = urlencode($tmp);
  return $tmp;
}

$array = $sSQL;
$array = serialize($array);
//var_dump ($array);
//$array=array_envia($array);
$_SESSION ['array'] =$array;
?>
<!--<form action="rp.php" method="POST">
    <input name="array" type="hidden" value="<?=$array?>">    
    <input name="enviar" type="submit" value=" Enviar "> 
</form>    -->

 <form action="rptxt.php" method="POST">
<!--    <input name="array" type="hidden" value="<?=$array?>">     -->
    <input name="enviar" type="submit" value="Listado en Editor de Texto  ">
</form>  

<!-- <form action="rpxml.php" method="POST">
    <input name="array" type="hidden" value="<?=$array?>">     
    <input name="enviar" type="submit" value="Listado en xml  ">
</form> --> 
 <form action="rpxml.php" method="POST">
<!--    <input name="array" type="hidden" value="<?=$array?>">     -->
    <input name="enviar" type="submit" value="Listado en Hoja de Calculo ">
</form>  

<?php
//-------------------------------
// Process empty recordset
//-------------------------------
  if($rs->EOF || !$rs) {
?>
     <tr>
      <td colspan="20" class="alarmas">No hay resultados</td>
     </tr>
    <tr>
     <td colspan="20" class="ColumnTD"><font class="ColumnFONT">
  </table>
<?php
    return;
}
?>
     <!--tr>
      <td colspan="10" class="DataTD"><b>Total Registros Encontrados: <?=$fldTotal?></b></td>
     </tr-->
<?php

//-------------------------------
// Initialize page counter and records per page
//-------------------------------
  $iCounter = 0;
//-------------------------------

//-------------------------------
// Process page scroller
//-------------------------------
  $iPage = $_GET["FormCIUDADANO_Page"];
  //print ("<BR>($iPage)($iRecordsPerPage)");
  if(strlen(trim($iPage))==0)   $iPage = 1;
  else {
    if($iPage == "last") {
      $db_count = get_db_value($sCountSQL);
      $dResult = intval($db_count) / $iRecordsPerPage;
      $iPage = intval($dResult);
      if($iPage < $dResult) $iPage++;
    } else 
        $iPage = intval($iPage);
  }

  if(($iPage - 1) * $iRecordsPerPage != 0) {
  	 //print ("<BR>($iPage)($iRecordsPerPage)");
    do {
      $iCounter++;
      $rs->MoveNext();
     //print("Entra......");
    } while ($iCounter < ($iPage - 1) * $iRecordsPerPage && (!$rs->EOF && $rs));
  }

  $iCounter = 0;
//$ruta_raiz ="..";
//include "../config.php";
//include "../jh_class/funciones_sgd.php";
//-------------------------------
// Display grid based on recordset
//-------------------------------.
$i = 1;
while((!$rs->EOF && $rs)  && $iCounter < $iRecordsPerPage) {
//-------------------------------
// Create field variables based on database fields
//-------------------------------
	$fldRADI_NUME_RADI = $rs->fields['RADI_NUME_RADI'];
	$fldRADI_FECH_RADI = $rs->fields['RADI_FECH_RADI'];
  /**
    *Busqueda por expediente
    *Fecha de modificacion: 11-Agosto-2006
    *Modificador: Supersolidaria
    */
  $fldsSGD_EXP_SUBEXPEDIENTE = $rs->fields['SGD_EXP_NUMERO'];

	$fldASUNTO = $rs->fields['RA_ASUN'];
	$fldTIPO_DOC = $rs->fields['SGD_TPR_DESCRIP'];
	$fldNUME_HOJAS = $rs->fields['RADI_NUME_HOJA'];
	$fldRADI_PATH = $rs->fields['RADI_PATH'];
	$fldDIRECCION_C = $rs->fields['SGD_DIR_DIRECCION'];
	$fldDIGNATARIO = $rs->fields['SGD_DIR_NOMBRE'];
	$fldTELEFONO_C = $rs->fields['SGD_DIR_TELEFONO'];
	$fldMAIL_C = $rs->fields['SGD_DIR_MAIL'];
	$fldNOMBRE = $rs->fields['SGD_DIR_NOMREMDES'];
	$fldCEDULA = $rs->fields['SGD_DIR_DOC'];
	//$fldUSUA_ACTU = $rs->fields['NOMB_ACTU") . " - (" . $rs->fields['LOGIN_ACTU").")";
	$aRADI_DEPE_ACTU = $rs->fields['RADI_DEPE_ACTU'];//echo $aRADI_DEPE_ACTU;
	$aRADI_USUA_ACTU = $rs->fields['RADI_USUA_ACTU'];
	$fldUSUA_ANTE = $rs->fields['RADI_USU_ANTE'];
	$fldPAIS = $rs->fields['RADI_PAIS'];
	$fldDIASR = $rs->fields['DIASR'];
	$tipoReg = $rs->fields['SGD_TRD_CODIGO'];
	$nivelRadicado= $rs->fields['CODI_NIVEL'];
	$seguridadRadicado=$rs->fields['SGD_SPUB_CODIGO'];
	$nivelExp=$rs->fields['SGD_EXP_PRIVADO'];


if($tipoReg==1) $tipoRegDesc = "Ciudadano";
if($tipoReg==2) $tipoRegDesc = "Empresa";
if($tipoReg==3) $tipoRegDesc = "Entidad";
if($tipoReg==4) $tipoRegDesc = "Funcionario";

$fldNOMBRE = str_replace($ps_RADI_NOMB,"<font color=green><b>$ps_RADI_NOMB</b>",tohtml($fldNOMBRE));
$fldASUNTO = str_replace($ps_RADI_NOMB,"<font color=green><b>$ps_RADI_NOMB</b>",tohtml($fldASUNTO));
//-------------------------------
// Busquedas Anidadas
//-------------------------------
$queryDep = "select DEPE_NOMB from dependencia where DEPE_CODI=$aRADI_DEPE_ACTU";

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$rs2=$db->query($queryDep);
$fldDEPE_ACTU = $rs2->fields['DEPE_NOMB'];
$queryUs = "select USUA_NOMB, USUA_DOC, DEPE_CODI from USUARIO where DEPE_CODI=$aRADI_DEPE_ACTU and USUA_CODI=$aRADI_USUA_ACTU ";
$rs3=$db->query($queryUs);
$nivelExp=0;
if($fldsSGD_EXP_SUBEXPEDIENTE ){
  $queryExp = "select sexp.SGD_EXP_PRIVADO, sexp.DEPE_CODI, sexp.USUA_DOC_RESPONSABLE
		from SGD_SEXP_SECEXPEDIENTES sexp 
	       where sexp.SGD_EXP_NUMERO='$fldsSGD_EXP_SUBEXPEDIENTE' ";
  $rs4=$db->query($queryExp);
  $nivelExp  = $rs4->fields['SGD_EXP_PRIVADO'];
  $fldDEPE_CODI_ACTU = $rs4->fields['DEPE_CODI'];
  $fldUSUA_DOC_ACTU  = $rs4->fields['USUA_DOC_RESPONSABLE'];
}

$fldUSUA_ACTU  = $rs3->fields['USUA_NOMB'];

$db->conn->SetFetchMode(ADODB_FETCH_NUM);

include_once('../include/tx/Radicacion.php');
$radicacion = new Radicacion( $db );

  if( $fldRADI_NUME_RADI != "" ) {
      $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
      $arrAnexos = $radicacion->getRadImpresos( $fldRADI_NUME_RADI );
      $db->conn->SetFetchMode(ADODB_FETCH_NUM);
  }
  if( $arrAnexos[0] != 0  ) {
      $clase = "impresos";
      $clasevinc = "impresosvinc";
  } else {
    $clase = "leidos";
    $clasevinc = "vinculos";
  }

$linkDocto = "<a class='vinculos' href='javascript:noPermiso()' >";
$linkInfGeneral = "<a class='vinculos' href='javascript:noPermiso()'>";

//if  ($nivelRadicado <=$nivelus)
//{
	$linkDocto = "<a class='$clase' href='../bodega/$fldRADI_PATH' target='Imagen$iii'>";
	$linkInfGeneral = "<a class='$clase' href='../verradicado.php?verrad=$fldRADI_NUME_RADI&" . session_name() . '=' . 
                      session_id() . "&carpeta=8&nomcarpeta=Busquedas&tipo_carp=0'>";
//}
$verImg = true;
$verImg = ($seguridadRadicado==1)?($fldUSUA_ACTU !=$_SESSION['usua_nomb']?false:true):($nivelRadicado > $nivelus?false:true);
//$verImg= $verImg && !($fila['SGD_SPUB_CODIGO']==1);
//$verImg=( $nivelExp>=1)?($fldDEPE_CODI_ACTU!=$_SESSION['depe_codi']?false:true):($fldUSUA_DOC_ACTU !=$_SESSION['usua_doc']?false:true);
//echo $nivelExp .">=1 &&". $fldDEPE_CODI_ACTU ." != ".$_SESSION['dependencia'];
if($fldsSGD_EXP_SUBEXPEDIENTE){
if($nivelExp>=1 && $fldDEPE_CODI_ACTU!=$_SESSION["dependencia"]) {
  if($fldUSUA_DOC_ACTU ==$_SESSION['usua_doc'] || $_SESSION['codusuario']==1){
   $verImg=true;
  }else{
   $verImg=false;
  }
}
}

if($verImg==true) {

//Insertar Funcion para descargar archivo
$ruta_archivo = $fldRADI_PATH;
$arreglo_explode = explode('/', $ruta_archivo);

foreach ($arreglo_explode as $value) 
  $nombre_archivo = (preg_match('/.+\.[a-z]+$/',$value, $rs_nombre))? $rs_nombre[0] : null;

$enlace_descarga = '../descargar_archivo.php?' .
                    'ruta_archivo=' . $ruta_archivo .
                    '&nombre_archivo=' . $nombre_archivo .
                    '&from=consulta' .
                    '&radicado=' . $fldRADI_NUME_RADI;

$linkDocto = (isset($ruta_archivo))?
              "<a class='$clasevinc' href='$enlace_descarga'>" :
                $linkDocto;

$enlace_ver_radi = '../verradicado.php?verrad=' . $fldRADI_NUME_RADI .
                   '&' . session_name() . '=' . session_id() . 
                   '&carpeta=8' . 
                   '&nomcarpeta=Busquedas'.
                   '&tipo_carp=0' . 
                   '&from=consulta';

$linkInfGeneral = "<a class='$clasevinc' href='$enlace_ver_radi'>";

} else { 
  $linkDocto = '';
  $linkInfGeneral = "<a ><img src='../imagenes/candado.gif' width=10>";
}

if(strlen( $ps_SGD_EXP_SUBEXPEDIENTE ) == 0){
$consultaExpediente="SELECT SGD_EXP_NUMERO 
                      FROM SGD_EXP_EXPEDIENTE
                      WHERE radi_nume_radi = $fldRADI_NUME_RADI AND
                            sgd_exp_fech=(SELECT MIN(SGD_EXP_FECH) AS minFech
                                          from sgd_exp_expediente
                                          where radi_nume_radi= $fldRADI_NUME_RADI)";
  $rsE=$db->conn->query($consultaExpediente);
	$fldsSGD_EXP_SUBEXPEDIENTE=$rsE->fields[0];
}

// Process the HTML controls
if($i==1){
	$formato ="listado1";
	$i=2;
}else{
    $formato ="listado2";
	$i=1;
 }
?>
	<tr class="<?=$formato?>">
	<? if ($indiVinculo == 1)
	  {
	  ?>
	   <td class="<?=$clase?>" align="center" width="70">
	   <A href="javascript:pasar_datos('<?=$fldRADI_NUME_RADI?>');" >
	     Vincular
		</td>
	  <?
	  }
	 if ($indiVinculo == 2)
	  {
	  ?>
	   <td class="<?=$clase?>" align="center" width="70">
	   <A href="javascript:pasar_datos('<?=$fldsSGD_EXP_SUBEXPEDIENTE?>',2);" >
	     Vincular
		</td>

	  <?
	  }
	?>
	<td class="<?=$clase?>">
		<? if (strlen($fldRADI_PATH) && $verImg){ $iii = $iii +1;?>  <? echo ($linkDocto);}?>
		<?=$fldRADI_NUME_RADI?>
		<?if (strlen($fldRADI_PATH)){?></a><?}?>&nbsp;
	</td>
	<td class="<?=$clase?>"><?=$linkInfGeneral?>
	<?= tohtml($fldRADI_FECH_RADI) ?>&nbsp;</a></td>
    <!--
    B�squeda por expediente
    Fecha de modificaci�n: 11-Agosto-2006
    Modificador: Supersolidaria
    -->
    <td class="<?=$clase?>">
    <?= $fldsSGD_EXP_SUBEXPEDIENTE ?>&nbsp;</td>

	<td class="<?=$clase?>">
	<?= $fldASUNTO ?>&nbsp;</td>
	<td class="<?=$clase?>">
	<?= tohtml($fldTIPO_DOC) ?>&nbsp;</td>
	<td class="<?=$clase?>">
	<?=$tipoRegDesc; ?>&nbsp;</td>
	<td class="<?=$clase?>">
	<?= tohtml($fldNUME_HOJAS) ?>&nbsp;</td>
	<td class="<?=$clase?>">
	<?= tohtml($fldDIRECCION_C) ?>&nbsp;</td>
	<td class="leidos">
	<?= tohtml($fldTELEFONO_C) ?>&nbsp;</td>
	<td class="leidos">
	<?= tohtml($fldMAIL_C) ?>&nbsp;</td>
	<td class="leidos">
	<?= tohtml($fldDIGNATARIO) ?>&nbsp;</td>
	<td class="leidos">
	<?= $fldNOMBRE ?>&nbsp;</td>
	<td class="leidos">
	<?= tohtml($fldCEDULA) ?>&nbsp;</td>
	<td class="leidos">
	<?= tohtml($fldUSUA_ACTU) ?>&nbsp;</td>
	<td class="leidos">
	<?= tohtml($fldDEPE_ACTU) ?>&nbsp;</td>
	<td class="leidos">
	<?= tohtml($fldUSUA_ANTE) ?>&nbsp;</td>
		<td class="leidos">
	<?= tohtml($fldPAIS); ?>&nbsp;</td>
	<td class="leidos">
	<? if ($aRADI_DEPE_ACTU!=999){ echo tohtml($fldDIASR);} else {echo'Sal';} ?>&nbsp;</td>
	</tr>
	  <?
    $iCounter++;
    $rs->MoveNext();

  }
//  Record navigator.
?>
<tr>
	<td colspan="20" class="ColumnTD"><font class="ColumnFONT">
<?php
// Navigation begin
$bEof = $rs;

if(($bEof && !$bEof->EOF) || $iPage != 1)
{
	$iCounter = 1;
	$iHasPages = $iPage;
	$sPages = "";
	$iDisplayPages = 0;
	$iNumberOfPages = 30; /* El nmero de paginas que aparecera en el navegador al pie de la pagina */

	while((!$rs->EOF && $rs) && $iHasPages < $iPage + $iNumberOfPages)
	{
		if($iCounter == $iRecordsPerPage)
      	{
			$iCounter = 0;
			$iHasPages = $iHasPages + 1;
		}
		$iCounter++;
		$rs->MoveNext();
	}
	if(($rs->EOF || !$rs) && $iCounter > 1) $iHasPages++;
    if (($iHasPages - $iPage) < intval($iNumberOfPages / 2))
		$iStartPage = $iHasPages - $iNumberOfPages;
	else
		$iStartPage = $iPage - $iNumberOfPages + intval($iNumberOfPages / 2);

	if($iStartPage < 0) $iStartPage = 0;
	for($iPageCount = $iPageCount + 1;  $iPageCount <= $iPage - 1; $iPageCount++) {
		$sPages .=  "<a href=" . $sFileName . "?" . $form_params . $sSortParams . "FormCIUDADANO_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</a>&nbsp;";
		$iDisplayPages++;
	}

	$sPages .= "<font " . "class=\"paginacion\"" . "><b>" . $iPage . "</b>&nbsp;";
	$iDisplayPages++;

	$iPageCount = $iPage + 1;

	while ($iDisplayPages < $iNumberOfPages && $iStartPage + $iDisplayPages < $iHasPages) {
		$sPages .= "<a href=\"" . $sFileName . "?" . $form_params . $sSortParams . "FormCIUDADANO_Page=" . $iPageCount . "#RADICADO\"><font " . "class=\"ColumnFONT\"" . ">" . $iPageCount . "</a>&nbsp;";
		$iDisplayPages++;
		$iPageCount++;
	}
	if ($iPage == 1)
	{
?>
		<font class="paginacion">Primero
		<font class="paginacion">Anterior
<?php
	}
	else
	{
?>
	<a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormCIUDADANO_Page=1#RADICADO"><font class="paginacion">Primero</a>
	<a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormCIUDADANO_Page=<?=$iPage - 1?>#RADICADO"><font class="paginacion">Anterior</a>
<?php
	}
	echo "&nbsp;[&nbsp;" . $sPages . "]&nbsp;";
	if ($rs->EOF)
	{
?>
		<font class="ColumnFONT">Siguiente
		<font class="ColumnFONT">Ultimo
<?php
	}
	else
	{
?>
		<a href="<?=$sFileName?>?<?=$form_params?><?=$sSortParams?>FormCIUDADANO_Page=<?=$iPage + 1?>#RADICADO"><font class="ColumnFONT">Siguiente</a>
<?php
	}
}
?>
	</td></tr>
</table>
<?php
}

function EmpresaESP_show ($nivelus) {

}

function OtrasEmpresas_show ($nivelus) {

}

function FUNCIONARIO_show ($nivelus) {

}

function resolverTipoCodigo ($tipo) {
	$salida;
	switch ($tipo) {
		case 1:
			$salida  = "Ciudadano";
			break;
		case 2: 
			$salida = "Empresa";
			break;
		case 3: 
			$salida= "Entidad";
			break;
		case 4: 
			$salida= "Funcionario";
			break;	
	}
	return $salida;
}

function resalaltarTokens (&$tkens,$busqueda) {
	$salida = $busqueda;
	$tok = explode(" ",$tkens);
	foreach ($tok as $valor) {
		$salida = eregi_replace($valor,"<font color=\"green\"><b>".strtoupper($valor)."</b></font>",$salida);
	}
	return $salida;
}

function pintarResultadoConsultas(&$fila,$indice,$numColumna) {
	global $ruta_raiz,$ps_RADI_NOMB;
	$ps_RADI_NOMB = trim($_GET["s_RADI_NOMB"]);
	echo "<hr>".$fila['SGD_EXP_PRIVADO']."<hr>";
	$verImg=($fila['SGD_SPUB_CODIGO']==1)?($fila['USUARIO_ACTUAL']!=$_SESSION['usua_nomb']?false:true):($fila['USUA_NIVEL']>$_SESSION['nivelus']?false:true);
	$verImg=$verImg && !($fila['SGD_EXP_PRIVADO']>=1);
  $salida="<span class=\"leidos\">";

	switch ($numColumna) {
		case 0 :
			$salida = $indice;
			break;
		case 1 :
			if($fila['RADI_PATH'] && $verImg) {
				$salida="<a class='vinculos' href=\"{$ruta_raiz}bodega" . $fila['RADI_PATH'] . "\" target=\"imagen" . 
                  (strlen($fila['RADI_PATH'])+1) . "\">" . $fila['RADI_NUME_RADI'] . "</a>";
      }	else {
				$salida.=$fila['RADI_NUME_RADI'];
      }
		   break;
		case 2:	
		   	if($verImg)
				$salida="<a class=\"vinculos\" href=\"{$ruta_raiz}verradicado.php?verrad=".$fila['RADI_NUME_RADI']."&amp;".session_name()."=".session_id()."&amp;carpeta=8&amp;nomcarpeta=Busquedas&amp;tipo_carp=0 \" >".$fila['RADI_FECH_RADI']."</a>";
		   	else 
				$salida="<a class=\"vinculos\" href=\"#\" onclick=\"noPermiso();\">".$fila['RADI_FECH_RADI']."</a>";
		   break;
		case 3:	
			$salida.=$fila['SGD_EXP_NUMERO'];
			break;
		case 4:
			if($ps_RADI_NOMB)
				$salida.=resalaltarTokens($ps_RADI_NOMB,$fila['RA_ASUN']);
			else  
				$salida.=htmlentities($fila['RA_ASUN']);
			break;
		case 5:
			$salida.=tohtml($fila ['SGD_TPR_DESCRIP']);  //resolverTipoDocumento($fila['TD']);
			break;
		case 6:
			$salida.=resolverTipoCodigo($fila['SGD_TRD_CODIGO']);
			break;
		case 7:
			$salida.=tohtml($fila['RADI_NUME_HOJA']);
		   	break;
		case 8:
			if($ps_RADI_NOMB)
				$salida.=resalaltarTokens($ps_RADI_NOMB,$fila['SGD_DIR_DIRECCION']);
			else  
				$salida.=htmlentities($fila['SGD_DIR_DIRECCION']);
			break;
		case 9:
			$salida.=  tohtml($fila['SGD_DIR_TELEFONO']);
			break;
		case 10:
			$salida.=tohtml($fila['SGD_DIR_MAIL']);
			break;
		case 11:
			if($ps_RADI_NOMB)
				$salida.= resalaltarTokens($ps_RADI_NOMB,$fila['SGD_DIR_NOMBRE']);
			else 
				$salida.= tohtml($fila['SGD_DIR_NOMBRE']);
			break;
		case 12:
			if($ps_RADI_NOMB)
				$salida.= resalaltarTokens($ps_RADI_NOMB,$fila['SGD_DIR_NOMREMDES']);
			else
				$salida.= tohtml($fila['SGD_DIR_NOMREMDES']);
			break;
		case 13:
			$salida.= tohtml($fila['SGD_DIR_DOC']);
			break;
		case 14:
			if($ps_RADI_NOMB)
				$salida.= resalaltarTokens($ps_RADI_NOMB,$fila['USUARIO_ACTUAL']);
		   	else
				$salida.=tohtml($fila['USUARIO_ACTUAL']);
			break;
		case 15:
			$salida.=tohtml($fila['DEPE_NOMB']);
			break;
		case 16:
			if($ps_RADI_NOMB)
				$salida.= resalaltarTokens($ps_RADI_NOMB,$fila['USUARIO_ANTERIOR']);
			else
				$salida.=htmlentities(tohtml($fila['USUARIO_ANTERIOR']));
			break;
		case 17:
			$salida.=tohtml($fila['RADI_PAIS']); 
			break;
		case 18:
			$salida.=($fila['RADI_DEPE_ACTU']!=999)?tohtml($fila['DIASR']):"Sal";
			break;
	}
	return $salida."</span>";
}

function buscar_prueba($nivelus, $tpRemDes, $whereFlds)
{
	global $ruta_raiz;echo $ruta_raiz."eeeeee";
	$db=new ConnectionHandler($ruta_raiz);
	//$db->conn->debug=true;
	//constrimos las  condiciones dependiendo de los parametros de busqueda seleccionados
	$ps_desde_RADI_FECH_RADI = mktime(0,0,0,$_GET["s_desde_mes"],$_GET["s_desde_dia"],$_GET["s_desde_ano"]);
    $ps_hasta_RADI_FECH_RADI = mktime(23,59,59,$_GET["s_hasta_mes"],$_GET["s_hasta_dia"],$_GET["s_hasta_ano"]);
    
    $where=" AND (R.RADI_FECH_RADI BETWEEN ".$db->conn->DBDate($ps_desde_RADI_FECH_RADI)." AND ".$db->conn->DBDate($ps_hasta_RADI_FECH_RADI).")";
	// se rescantan los parametros de busqueda
	$ps_RADI_NUME_RADI  = $_GET["s_RADI_NUME_RADI"];  
if(!$ps_RADI_NUME_RADI) $ps_RADI_NUME_RADI="2";
	$ps_DOCTO           =  $_GET["s_DOCTO"];
	$ps_RADI_DEPE_ACTU  = $_GET["s_RADI_DEPE_ACTU"];
	$ps_SGD_EXP_SUBEXPEDIENTE = $_GET["s_SGD_EXP_SUBEXPEDIENTE"];
  $ps_solo_nomb       = $_GET["s_solo_nomb"];
	$ps_RADI_NOMB       = trim($_GET["s_RADI_NOMB"]);
  $ps_entrada         = $_GET["s_entrada"];
  $ps_TDOC_CODI       = $_GET["s_TDOC_CODI"];
  $ps_salida          = $_GET["s_salida"];
  $sFormTitle         = "Radicados encontrados $tpRemDesNombre";
  
	$ps_RADI_DEPE_ACTU = (is_number($ps_RADI_DEPE_ACTU) && strlen($ps_RADI_DEPE_ACTU))?tosql($ps_RADI_DEPE_ACTU, "Number"):"";
	$where =(strlen($ps_RADI_DEPE_ACTU) > 0)?$where." AND R.RADI_DEPE_ACTU = ".$ps_RADI_DEPE_ACTU:$where;
	$where = (strlen($ps_RADI_NUME_RADI))?$where." AND R.RADI_NUME_RADI  LIKE " . tosql("%".trim($ps_RADI_NUME_RADI) ."%", "Text"):$where;
  
	switch ($tpRemDes) {
		case 1:
		$tpRemDesNombre = "Por Ciudadano";
		$where.= " and dir.sgd_trd_codigo = $whereFlds  ";
		break;
		case 2:
		$tpRemDesNombre = "Por Otras Empresas";
		$where.= " and dir.sgd_trd_codigo = $whereFlds  ";
		break;
		case 3;
		$tpRemDesNombre = "Por Entidad";
		$where.= " and dir.sgd_trd_codigo = $whereFlds  ";
		break;
		case 4:
		$tpRemDesNombre = "Por Funcionario";
		$where.= " and dir.sgd_trd_codigo = $whereFlds  ";
		break;
		case 9:
		$tpRemDesNombre = "";
	}
	
	$where=(strlen($ps_DOCTO))?" AND  DIR.SGD_DIR_DOC = '$ps_DOCTO' ":$where;
    if(strlen( $ps_SGD_EXP_SUBEXPEDIENTE ) != 0 ) {
    	$min="INNER JOIN SGD_EXP_EXPEDIENTE MINEXP ON R.RADI_NUME_RADI=MINEXP.RADI_NUME_RADI";
        $where = $where. " AND MINEXP.SGD_EXP_ESTADO <> 2";
        $where = $where . " AND ( 
        	    SEXP.SGD_EXP_NUMERO LIKE '%".str_replace( '\'', '', tosql($ps_SGD_EXP_SUBEXPEDIENTE , "Text" ))."%' 
        		OR SEXP.SGD_SEXP_PAREXP1 LIKE UPPER( '%".str_replace( '\'', '', tosql($ps_SGD_EXP_SUBEXPEDIENTE,"Text"))."%') 
        		OR SEXP.SGD_SEXP_PAREXP2 LIKE UPPER( '%".str_replace( '\'', '', tosql($ps_SGD_EXP_SUBEXPEDIENTE,"Text"))."%') 
        		OR SEXP.SGD_SEXP_PAREXP3 LIKE UPPER( '%".str_replace( '\'', '', tosql($ps_SGD_EXP_SUBEXPEDIENTE,"Text"))."%')
        		OR SEXP.SGD_SEXP_PAREXP4 LIKE UPPER( '%".str_replace( '\'', '', tosql($ps_SGD_EXP_SUBEXPEDIENTE,"Text"))."%')
        		OR SEXP.SGD_SEXP_PAREXP5 LIKE UPPER( '%".str_replace( '\'', '', tosql($ps_SGD_EXP_SUBEXPEDIENTE,"Text"))."%'))";
    } else {
    	$min="LEFT JOIN	(SELECT RADI_NUME_RADI,
                              MIN(SGD_EXP_FECH) FECHA
                          FROM SGD_EXP_EXPEDIENTE 
                          GROUP BY SGD_EXP_NUMERO, RADI_NUME_RADI)
                    MINE ON MINE.RADI_NUME_RADI = R.RADI_NUME_RADI
              LEFT JOIN SGD_EXP_EXPEDIENTE MINEXP ON (MINE.RADI_NUME_RADI = MINEXP.RADI_NUME_RADI AND
                                                       MINE.FECHA = MINEXP.SGD_EXP_FECH)";
    }
    
    $where=($ps_entrada!="9999" )? $where." AND R.RADI_NUME_RADI like " .tosql("%".trim($ps_entrada), "Text").")":$where;
	/* Se decide si busca en radicado de entrada o de salida o ambos */
	$eLen = strlen($ps_entrada);
	$sLen = strlen($ps_salida);
  
	$where=(is_number($ps_TDOC_CODI) && strlen($ps_TDOC_CODI) && $ps_TDOC_CODI != "9999")?$where." AND R.TDOC_CODI=".tosql($ps_TDOC_CODI, "Number"):$where;
	/* Se recibe la caadena a buscar y el tipo de busqueda (All) (Any) */
  
	if(strlen($ps_RADI_NOMB)) //&& $ps_solo_nomb == "Any")
	{
    	$ps_RADI_NOMB = strtoupper($ps_RADI_NOMB);
    	$concatenacion="UPPER(".$db->conn->Concat("R.RA_ASUN","R.RADI_CUENTAI","DIR.SGD_DIR_TELEFONO","DIR.SGD_DIR_DIRECCION") . ") LIKE '%";
    	$tok= explode(" ",$ps_RADI_NOMB);
		$where.=" AND ((UPPER(dir.sgd_dir_nomremdes) LIKE '%".implode("%' AND UPPER(dir.sgd_dir_nomremdes) LIKE '%",$tok)."%') ";
		$where .="OR ( UPPER(dir.sgd_dir_nombre) LIKE '%".implode("%' AND UPPER(dir.sgd_dir_nombre) LIKE '%",$tok)."%')";
		$where .= " OR (".$concatenacion.implode("%' AND ".$concatenacion,$tok)."%'))";
	}
	//-------------------------------
	// Build base SQL statement
	//-------------------------------
	include($ruta_raiz . '/include/query/busqueda/busquedaPiloto1.php');
	require_once($ruta_raiz . '/include/myPaginador.inc.php');
	
	$titulos = array("#",
                  "1#RADICADO",
                  "3#FECHA RADICACION",
                  "2#EXPEDIENTE",
                  "4#ASUNTO",
                  "14#TIPO DE DIOCUMENTO",
                  "21#TIPO",
                  "7#NO DE HOJAS",
                  "15#DIRECCION CONTACTO",
                  "18#TELEFONO CONTACTO",
                  "16#MAIL CONTACTO ",
                  "20#DIGNATARIO",
                  "17#NOMBRE",
                  "19#DOCUMENTO",
                  "22#USUARIO ACTUAL",
                  "10#DEPENDENCIA ACTUAL",
                  "23#USUARIO ANTERIOR",
                  "11#PAIS",
                  "13#DIAS RESTANTES");
	
	$sSQL="select R.RADI_NUME_RADI,
                MINEXP.SGD_EXP_NUMERO," . $db->conn->SQLDate('Y-m-d H:i:s','R.RADI_FECH_RADI') . " AS RADI_FECH_RADI,
                R.RA_ASUN,
                R.RADI_NUME_HOJA,
                R.RADI_PATH,
                R.RADI_USUA_ACTU,
                R.CODI_NIVEL,
                R.SGD_SPUB_CODIGO,
                R.RADI_DEPE_ACTU,
                R.RADI_PAIS,
                D.DEPE_NOMB,
                {$redondeo} AS DIASR,
                TD.SGD_TPR_DESCRIP,
                DIR.SGD_DIR_DIRECCION,
                DIR.SGD_DIR_MAIL,
                DIR.SGD_DIR_NOMREMDES,
                DIR.SGD_DIR_TELEFONO,
                DIR.SGD_DIR_DOC,
                DIR.SGD_DIR_NOMBRE,
                DIR.SGD_TRD_CODIGO,
                U.USUA_NOMB USUARIO_ACTUAL,
                AL.USUA_NOMB USUARIO_ANTERIOR,
                U.CODI_NIVEL USUA_NIVEL,
                SGD_EXP_PRIVADO
            FROM RADICADO R 
              INNER JOIN SGD_DIR_DRECCIONES DIR ON R.RADI_NUME_RADI = DIR.RADI_NUME_RADI
              INNER JOIN SGD_TPR_TPDCUMENTO TD ON R.TDOC_CODI = TD.SGD_TPR_CODIGO
              INNER JOIN USUARIO U ON R.RADI_USUA_ACTU = U.USUA_CODI AND
                          R.RADI_DEPE_ACTU = U.DEPE_CODI
              LEFT JOIN USUARIO AL ON R.RADI_USU_ANTE = AL.USUA_LOGIN 
              LEFT JOIN DEPENDENCIA D ON D.DEPE_CODI = R.RADI_DEPE_ACTU 
	                      {$min}
              LEFT JOIN SGD_SEXP_SECEXPEDIENTES SEXP ON MINEXP.SGD_EXP_NUMERO = SEXP.SGD_EXP_NUMERO
            WHERE DIR.SGD_DIR_TIPO = 1 " .
            $where;
	  
	echo"<table >
			<tr>
			<td class=\"titulos4\" colspan=\"20\" width=\"2000\" ><a name=\"RADICADO\">$sFormTitle</a></td>
			</tr>
		 </table>";
	$paginador=new myPaginador($db,strtoupper($sSQL),null,"",25);
    $paginador->setImagenASC($ruta_raiz."iconos/flechaasc.gif");
    $paginador->setImagenDESC($ruta_raiz."iconos/flechadesc.gif");
    $paginador->setFuncionFilas("pintarResultadoConsultas");
    $paginador->setpropiedadesTabla(array('width'=>"2000", 'border'=>'0', 'cellpadding'=>'5', 'cellspacing'=>'5' ,'class'=>'borde_tab'));
    $paginador->setPie($pie);
    echo $paginador->generarPagina($titulos,"titulos3");
  }

function buscar($nivelus, $tpRemDes, $whereFlds) {
  Ciudadano_show($nivelus, $tpRemDes, $whereFlds);
}
?>
