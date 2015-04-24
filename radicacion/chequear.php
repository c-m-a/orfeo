<?php
session_start();
/**
  * Modificacion Variables Globales Infometrika 2009-05
  * Licencia GNU/GPL 
  */

foreach ($_GET as $key => $valor)
  ${$key} = $valor;

foreach ($_POST as $key => $valor)
  ${$key} = $valor;

$krd          = $_SESSION["krd"];
$dependencia  = $_SESSION["dependencia"];
$usua_doc     = $_SESSION["usua_doc"];
$codusuario   = $_SESSION["codusuario"];
$tpNumRad     = $_SESSION["tpNumRad"];
$tpPerRad     = $_SESSION["tpPerRad"];
$tpDescRad    = $_SESSION["tpDescRad"];
$tpDepeRad    = $_SESSION["tpDepeRad"];
$ruta_raiz    = '..';

include ('../include/db/ConnectionHandler.php');

$tipoMed = (isset($_SESSION['tipoMedio']))? $_SESSION['tipoMedio'] : null;

$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

session_cache_limiter('public');

$fechah = date('dmy') . '_' . time('hms');

$buscar_por_radicado = (isset($buscar_por_radicado))?
                          trim($buscar_por_radicado) : null;

/** RADICA UN DOCUMENTO TIPO $ent EN LA DEP $dependencia \n Trae la secuencia de la dependencia **/

/**
 * RESERVA DE FAX. Aqui se reservan los fax, cuando un usuario entra a radicarlo.
 * @author      Jairo Hernan Losada
 * @version     3.0
 */
/** var $faxPath;
   * Variable que trae la ruta actual de un fax entrante.
   * @var string
   * @access public
   */
if(isset($faxPath)) {
	$iSql= "SELECT SGD_RFAX_FAX,
                  USUA_LOGIN,
                  SGD_RFAX_FECHRADI
							FROM SGD_RFAX_RESERVAFAX
							WHERE SGD_RFAX_FAX='$faxPath'
								AND USUA_LOGIN='$krd'";
  
	$rs = $db->conn->query($iSql);
	$krdTmp = $rs->fields("USUA_LOGIN");
	$fechRadicacion = $rs->fields("SGD_RFAX_FECHRADI");
  
  if ($krdTmp != $krd) {
		if (empty($krdTmp)) {
		}
		{
		if(trim($krdTmp) != '') {
?>
		<hr>
      <font color="red">
        POR FAVOR VERIFIQUE CON <?=$krdTmp?> QUE EL FAX QUE TOMO NO SEA RADICADO POR SEGUNDA VEZ, YA OTRA PERSONA (<?=$krdTmp?>) lo habia radicado</font><hr>
<?php
		}
		if($fechRadicacion) {
		?>
		<hr></font color="red">CUIDADO !!!!! ESTE FAX YA APARECE CON FECHA DE RADICACION !!!!!!! <?=$krdTmp?> CONSULTE
CON (<?=$krdTmp?>) FECHA DE RADICACION <?=$fechRadicacion?></font><hr>
		<?
		}
		}
		$codigoFax = substr($faxPath,3,9);
		$iSql= " insert into SGD_RFAX_RESERVAFAX
		( sgd_rfax_codigo
		, sgd_rfax_fax
		, usua_login
		, sgd_rfax_fech
		) values
		(
		$codigoFax
		,'$faxPath'
		,'$krd'
		,".$db->conn->OffsetDate(0,$db->conn->sysTimeStamp)."
		)
   ";
	$db->conn->query($iSql);
	}
}

/**
  * Radicacion de eMails
  * @autor Orlando Burgos
  * @año 2008
  * @vesrion OrfeoGpl 3.7
  */
	
  if(empty($_SESSION['tipoMedio'])) {
    $tipoMedio = (isset($_GET['tipoMedio']))? $_GET['tipoMedio'] : null;

    if(empty($tipoMedio)) { 
      $tipoMedio = (isset($_POST['tipoMedio']))? $_POST['tipoMedio'] : null;
    }
	}
  
  $hay_tipo_medio = (isset($tipoMedio) && $tipoMedio == 'eMail') ||
                    (isset($_SESSION['tipoMedio']) && $_SESSION['tipoMedio'] == 'eMail');
  
  if ($hay_tipo_medio) {
    if($_GET['eMailPid']) {
      $eMailAmp = $_GET['eMailAmp'];
    
    $eMailMid=$_GET['eMailMid'];
    $eMailPid=$_GET['eMailPid'];
    $_SESSION['eMailPid'] = $_GET['eMailPid'];
    $_SESSION['eMailMid'] = $_GET['eMailMid'];
 }else{
  $eMailPid = $_SESSION['eMailPid'];
  $eMailMid = $_SESSION['eMailMid'];
  $eMailAmp = $_SESSION['eMailAmp'];
  }   
  $fileeMailAtach=$_GET['fileeMailAtach'];
}
?>
<!DOCTYPE html>
<html>
  <head>
    <base href="<?=ORFEO_URL?>">
    <meta http-equiv="expires" content="99999999999">
    <meta http-equiv="Cache-Control" content="cache">
    <meta http-equiv="Pragma" content="public">
    <link href="estilos/orfeo.css" rel="stylesheet" type="text/css">
  </head>
  <body topmargin="0" bgcolor="#FFFFFF" onLoad='document.getElementById("buscar_por_radicado").focus();'>
  <div id="spiffycalendar" class="text"></div>
  <div id="spiffycalendar2" class="text"></div>
  <link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">
	<script language="JavaScript" src="js/spiffyCal/spiffyCal_v2_1.js"></script>
<?php
  if (empty($busq))
    $busq = 1;
  
  if (empty($tip_rem))
    $tip_rem = 3;
  
  if(isset($Submit)) {
   	if ($busq == 1)
      $cuentai = (isset($buscar_por))? $buscar_por : null;

    if ($busq == 2)
      $noradicado = (isset($buscar_por))? $buscar_por : null;
    
    if ($busq == 3)
      $documento = (isset($buscar_por))? $buscar_por : null;

    if ($busq == 4)
      $nombres = (isset($buscar_por))? $buscar_por : null;
  }
  
  $query = "select SGD_TRAD_CODIGO,
                    SGD_TRAD_DESCR
              from sgd_trad_tiporad
              where SGD_TRAD_CODIGO = $ent";

$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$rs = $db->conn->query($query);
$tRadicacionDesc = " - " .strtoupper($rs->fields["SGD_TRAD_DESCR"]);
$faxPath = (isset($faxPath))? $faxPath : null;

$datos_enviar = session_name() . '=' . trim(session_id()) .
                '&krd=' . $krd .
                '&fechah=' . $fechah .
                '&faxPath=' . $faxPath;

$enlace_chequear = 'radicacion/chequear.php?' .
                    session_name() . '=' . session_id() .
                    '&krd=' . $krd .
                    '&dependencia=' . $dependencia .
                    '&faxPath=' . $faxPath;
?>
</form>
<form name="formulario" method="post" action="<?=$enlace_chequear?>">
  <input type="hidden" name="ent" value="<?=$ent?>">
<?php
  /**
	 * MODULO DE RADICACION PREVIA
	 * @autor JAIRO H LOSADA
	 * @fecha 2005-02
	 */
  include ('./formRadPrevia.php');
  $enlace_nuevo_rad = 'radicacion/nuevo_radicado.php?' . 
                      session_name() . '=' . trim(session_id()) .
                      '&dependencia=' . $dependencia .
                      '&faxPath=' . $faxPath;
?>
  </div>
</form>
<form action="<?=$enlace_nuevo_rad?>" method="post" name="form1" class="style1">
<input type="hidden" name="ent" value="<?=$ent?>">
<tr> 
  <td colspan="3">
    <div align="center">
<?php
	if(isset($Submit)) {
?>
	<table border="0" width="100%" class="borde_tab" cellspacing="0">
	<tr align="center" class="titulos2">
	<td class="titulos2">RADICAR COMO...</td>
</tr>
</table>
	<br>
	<table border="0" width="100%" class="borde_tab">
	<tr align="center">
		<td width="33%" height="25" class="listado2" align="center">
      <center>
        <input name="rad1" type="submit" class="botones_funcion" value="Nuevo (Copia Datos)"></center>
    </td>
		<td width="33%" class="listado2" height="25">
			<center>
        <input name="rad0" type=submit class="botones_funcion" value="Como Anexo">
      </center>
    </td>
		<td width="33%" class="listado2" height="25">
			<center>
        <input name="rad2" type=submit class="botones_funcion" value="Asociado">
      </center>
		</td>
	</tr>
	</table>
<?php
	}
$accion = '&accion=buscar';
$papl = (isset($papl))? $papl : null;
$sapl = (isset($sapl))? $sapl : null;
$numdoc = (isset($numdoc))? $numdoc : null;

$variables = '&pnom=' . strtoupper($pnom) .
              '&papl=' . $papl . 
              '&sapl=' . $sapl .
              '&numdoc=' . $numdoc .
              $accion;

$target = '_parent';
$hoy    = date('d/m/Y');
$hace_catorce_dias = date ('d/m/Y', mktime (0,0,0,date('m'),date('d')-14,date('Y')));
$where  = ' ';
$where_general = (isset($where_general))? $where_general : null;
$where_ciu     = (isset($where_ciu))? $where_ciu : null;

// Limite de Fecha 
$fecha_ini =(isset($fecha_ini))? $fecha_ini : null;
$fecha_ini = mktime(00,00,00,substr($fecha_ini,5,2),
                              substr($fecha_ini,8,2),
                              substr($fecha_ini,0,4));

$fecha_fin =(isset($fecha_fin))? $fecha_fin : null;
$fecha_fin = mktime(23,59,59,substr($fecha_fin,5,2),
                              substr($fecha_fin,8,2),
                              substr($fecha_fin,0,4));

$where_fecha = " and (a.radi_fech_radi >= " .
                $db->conn->DBTimeStamp($fecha_ini) .
                " and a.radi_fech_radi <= " .
                $db->conn->DBTimeStamp($fecha_fin).") ";
$dato1 = 1;
$where_general  = " $where_fecha ";

$and_cuentai = (isset($and_cuentai))? ' and ' : ' or ';
$and_radicado = (isset($and_radicado))? ' and ' : ' or ';

$and_exp = (isset($and_exp))? ' and ' : ' or ';
$and_doc = (isset($and_doc))? ' and ' : ' or ';
$and_nombres = (isset($and_nombres))? ' and ' : ' or ';

if (isset($buscar_por_cuentai))
  $where_general .= " $and_cuentai a.radi_cuentai like '%$buscar_por_cuentai%' ";

if (isset($buscar_por_radicado))
  $where_general .= " $and_radicado a.radi_nume_radi = $buscar_por_radicado ";

if (isset($buscar_por_dep_rad))
  $where_general .= " $and a.radi_depe_radi in($buscar_por_dep_rad) ";

if (isset($buscar_por_doc))
  $where_ciu .= " $and_doc d.SGD_DIR_DOC = '$buscar_por_doc'";

if (isset($buscar_por_exp))
	$where_ciu .= " $and_exp  g.SGD_EXP_NUMERO LIKE '%$buscar_por_exp%' ";

$buscar_por_nombres = (isset($buscar_por_nombres))? $buscar_por_nombres : null;
$nombres = strtoupper(trim($buscar_por_nombres));

if(trim($nombres)) {
  $array_nombre = explode(" ",$nombres);
	$strCamposConcat = $db->conn->Concat("UPPER(d.SGD_DIR_NOMREMDES)","UPPER(d.SGD_DIR_NOMBRE)");
	
  for($i=0;$i<count($array_nombre);$i++) {
    $nombres = trim($array_nombre[$i]); 
		$where_ciu .= " and $strCamposConcat LIKE '%$nombres%' ";
	} 
}

$dato = 2;
echo "</table>";
$primera = (isset($primera))? $primera : null;


$algun_campo_lleno = $primera != 1 &&
                      $Submit == 'BUSCAR' &&
                        (isset($buscar_por_cuentai) ||
                          isset($buscar_por_radicado) ||
                          isset($buscar_por_nombres) ||
                          isset($buscar_por_doc) ||
                          isset($buscar_por_dep_rad) ||
                          isset($buscar_por_exp));

if ($algun_campo_lleno) {
$db = new ConnectionHandler('..');
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
$sqlFecha = $db->conn->SQLDate("d-m-Y H:i","a.RADI_FECH_RADI");

$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$iBusqueda = (isset($iBusqueda))? $iBusqueda : null;

switch ($iBusqueda) {
case 1:
	$query = $query1;
	$eTitulo = "<table><tr><td></td></tr></table><table class='t_bordeGris' width=100%><tr class=eTitulo><td><span class=tpar>Resultados Busqueda por Ciudadanos</td></tr></table>";
	break;
case 2:
	$query = $query2;
	$eTitulo ="<table class='t_bordeGris' width=100%><tr><td><span class=tpar>Resultados Busqueda por Otras Empresas</td></tr></table>";
	break;
case 3:
	$query = $query3;
	$eTitulo ="<table class='t_bordeGris' width=100%><tr><td><span class=tpar>Resultados Busqueda por Esp</td></tr></table>";
	break;
case 4:
	$query = $query4;
	$eTitulo ="<table class='t_bordeGris' width=100%><tr><td><span class=tpar>Resultados Busqueda por Funcionarios</td></tr></table>";
	break;
}

$tpBuscarSel = "";

if($tpBusqueda1) {
	echo (isset($eTitulo))? $eTitulo : null;
	$tpBuscarSel = "ok";
	$whereTrd = "1";
}

if($tpBusqueda2) {
	echo (isset($eTitulo))? $eTitulo : null;
	$tpBuscarSel = "ok";
	if($whereTrd) $whereTrd .= ",";
	$whereTrd .= "2";
}

if($tpBusqueda3) {
	echo (isset($eTitulo))? $eTitulo : null;
	$tpBuscarSel = "ok";
	if($whereTrd) $whereTrd .= ",";
	$whereTrd .= "3";
}

if($tpBusqueda4) {
	echo (isset($eTitulo))? $eTitulo : null;
	$tpBuscarSel = "ok";
	if($whereTrd) $whereTrd .= ",";
	$whereTrd .= "4";
}

if($whereTrd) $whereTrd = " AND d.SGD_TRD_CODIGO IN ($whereTrd)"; else $whereTrd = "";
include ('../include/query/queryChequear.php');
$query = $query1;
$rsCheck = $db->conn->query($query);
echo '<label1>';
$varjh = 1;

if (empty($rsCheck) && $tpBuscarSel == 'ok') {
  echo "<center>
          <img src='img_alerta_1.gif' alt='Esta alerta indica que no se encontraron los datos que buscar e Intente buscar con otro nombre, apellido o No. IDD'>";
  echo "<center><font size='3' face='arial' class='etextomenu'><b>No se encontraron datos con las caracteristicas solicitadas</b></font>";
}else {
?>
  <table width="100%" class="borde_tab">
<? 
	if($tpBuscarSel == 'ok') {
?>
<tr align="center" class="titulos2">
	<td class="titulos2" align="left">
	<input name='radicadopadre' type='radio' value='' title='Radicado No <?=$nume_radi ?>' class="ecajasfecha">
	NO TIENE PADRE</td>
</tr>
<?php
  }
  $cent = 0;
  $varjh = 2;
  $radicado_anterior = 0;

  //Busqueda de radicados
  while (!$rsCheck->EOF) {
	$nume_radi    = '';
	$nombret_us1  = '';
	$nombret_us2  = '';
	$nombret_us3  = '';
	$dato         = '';
	$fecha        = '';
	$cuentai      = '';
	$asociado     = '';
	$asunto       = '';
	$cent         = 0;

	$nume_radi = $rsCheck->fields["RADI_NUME_RADI"];
	
	$nurad      = $nume_radi;
	$verrad     = $nume_radi;
	$verradicado = $nume_radi;
	$nomb       = $rsCheck->fields['SGD_CIU_NOMBRE'];
	$prim_apel  = $rsCheck->fields['SGD_CIU_APELL1'];
	$segu_apel  = $rsCheck->fields['SGD_CIU_APELL2'];
	$nume_deri  = $rsCheck->fields['RADI_NUME_DERI'];
	$imagenf    = $rsCheck->fields['RADI_PATH'];
	$hoj        = $rsCheck->fields['RADI_NUME_HOJA'];
	$asunto     = $rsCheck->fields['RA_ASUN'];
	$fecha      = $rsCheck->fields['RADI_FECH_RADI'];
	$derivado   = $rsCheck->fields['RADI_NUME_DERI'];
  $tipoderivado = $rsCheck->fields['RADI_TIPO_DERI'];
	$dir_tipo   = $rsCheck->fields['SGD_DIR_TIPO'];
	$cuentai    = $rsCheck->fields['RADI_CUENTAI'];
	$nume_exp   = $rsCheck->fields['SGD_EXP_NUMERO'];
	$ruta_raiz  = '..';
	$no_tipo    = 'true';
	
  include ('../ver_datosrad.php');
	if($dir_tipo==1) {
		 $dir_tipo_desc = "Remitente";
		 $dignatario1=$rsCheck->fields['SGD_DIR_NOMBRE'];
	}
	
  if($dir_tipo==2) {
    $dir_tipo_desc = "Predio";
    $dignatario2=$rsCheck->fields['SGD_DIR_NOMBRE'];
	}

	if($dir_tipo==3) {
    $dir_tipo_desc = "ESP";
    $dignatario3=$rsCheck->fields['SGD_DIR_NOMBRE'];
	}
  
	if (trim($derivado)){
	  switch ($tipoderivado) {
			case 0:
				$asociado = "Anx > $derivado";
				break;
			case 1:
				$asociado = "";
				break;
			case 2:
				$asociado = "Asc > $derivado";
				break;
		}
	}
	
  $dato = (trim($imagenf) == '')?
            'No Disp' : 
            '<a href="../bodega' . $imagenf . '" target="otraventana">Ver Imagen</a>';
	
  if($radicado_anterior!=$nume_radi) {
			 if($iii==1){
				 $fila = "<tr class='tparr'>";
				 $iii=2;
			 }else{
				$fila = "<tr class='timparr'>";
				$iii=1;
			 }
		  ?>
	<tr class='borde_tab'><?=$fila ?>
		<td class="listado2">
      <table class="borde_tab" width="100%">
        <tr>
          <td width="18%" class="titulos5">
            <input name="radicadopadre" type="radio" value="<?=$nume_radi?>" title="Radicado No <?=$nume_radi ?>">
            Radicado
          </td>
          <td width="39%" class="listado5">
            <?=$nume_radi?>
<?php
		  if(isset($nume_exp))
		 	  echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Expediente' . $nume_exp;
?>
          </td>
          <td width="12%" class="titulos5">Fecha Rad</td>
          <td width="31%" class="listado5"><?=$fecha ?></td>
        </tr>
      <td class="titulos5" >Remitente</td>
      <td class=listado5 >
        <?=$nombret_us1." - ".$dignatario1?>
      </td>
      <td class="titulos5">
        <span class="tituloListado">Cuenta Interna</span>
      </td>
      <td class="listado5">
        <?=$cuentai?>
      </td>
    <tr>
      <td class="titulos5" >Predio</td>
      <td class=listado5 ><?=$nombret_us2." - ".$dignatario2 ?></td>
      <td class="titulos5"><span class="tituloListado">Doc Asociado</span> </td>
      <td class="listado5"><?=$asociado?></td>
    </tr>
    <tr>
      <td class="titulos5">ESP</td>
      <td class=listado5 >
        <?=$nombret_us3." - ".$dignatario3 ?>
        <?=$dato ?>
      </td>
      <td class="titulos5">Asunto</td>
      <td class="listado5"><?=$asunto ?></td>
    </tr>
  </table>
</td>
</tr>
<?php
}
  $cent ++;
  $radicado_anterior = $nume_radi;
  $rsCheck->MoveNext();
}
  if ($cent == 0 and $tpBuscarSel == 'ok') {
?>
    <tr>
      <td align="center" colspan="7" class="titulosError">&nbsp;LO SENTIMOS NO HAY REGISTROS</td>
    </tr>
<?php
	}
}
} else { 
	if(isset($Submit)) {
		?>
		<center>
      <table class="borde_tab" width="100%">
        <tr>
          <td class="titulosError">
            <center>Debe digitar un Dato para realizar la busqueda !!</center>
          </td>
        </tr>
      </table>
    </center>
		<?php 
		$nobuscar = "No Buscar";
	}
	}
  $imagenf = (isset($imagenf))? $imagenf : null;
	
  $dato = (trim($imagenf) == '')?
            ' ' :
            '<a href="bodega/' . $imagenf . '" target="otraventana"></a>';

  $varjh = (isset($varjh))? $varjh : null;
  
  if ($varjh == 2) {
?> 
	<tr class='titulos2'> 
		<td class="titulos">
	    <input name="titulos" type="radio" value="" title="Radicado No <?=$nume_radi?>" class="ecajasfecha">
      NO TIENE PADRE
    </td>
  </tr>
<?php 
}
?> 
</table>
<?php
  $cent = (isset($cent))? $cent : null;
	$cent ++;

  $usr      = (isset($usr))? $usr : null;
  $ent      = (isset($ent))? $ent : null;
  $contra   = (isset($contra))? $contra : null;
  $tip_doc  = (isset($tip_doc))? $tip_doc: null;
  $pcodi    = (isset($pcodi))? $pcodi : null;
  $hoj      = (isset($hoj))? $hoj : null;
  $depende  = (isset($depende))? $depende : null;
	
  echo "<input type='hidden' name='usr' value='$usr'>";
	echo "<input type='hidden' name='ent' value='$ent'>";
	echo "<input type='hidden' name='depende' value='$depende'>";
	echo "<input type='hidden' name='contra' value='$contra'>";
	echo "<input type='hidden' name='pnom' value='$pnom'>";
	echo "<input type='hidden' name='sapl' value='$sapl'>";
	echo "<input type='hidden' name='papl' value='$papl'>";
	echo "<input type='hidden' name='numdoc' value='$numdoc'>";
	echo "<input type='hidden' name='tip_doc' value='$tip_doc'>";
	echo "<input type='hidden' name='tip_rem' value='$tip_rem'>";
	echo "<input type='hidden' name='codusuario' value='$codusuario'>";
	echo "<input type='hidden' name='pcodi' value='$pcodi'>";
	echo "<input type='hidden' name='hoj' value='$hoj'>";
?>
<br>
<br>
</div>
</td>
<div align="center">
<br>
<?php
	if(isset($Submit) && empty($nobuscar))
?>
<br>
</div>
<?php
$drde = (isset($drde))? : null;
$krd = (isset($krd))? : null;
echo "<input type='hidden' name='drde' value='$drde'>";
echo "<input type='hidden' name='krd' value='$krd'>";
?>
</form>
</body>
</html>
