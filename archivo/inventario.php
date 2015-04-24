<? $krdOld = $krd;
session_start();
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
import_request_variables("gp", "");
if (!$ruta_raiz) $ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler("$ruta_raiz");
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&num_exp=$num_exp";

include_once "$ruta_raiz/include/tx/Historico.php";
include_once "$ruta_raiz/include/tx/Expediente.php";
	$db = new ConnectionHandler("$ruta_raiz");
$db->debug=true;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&tipo=$tipo&sel=$sel&ano=$ano";
static $sel;
$numInv=1;
$flds_desde_ano = $s_desde_ano;
function fnc_date_calcm($this_date,$num_month){
	$my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   	$timestamp = $my_time - ($num_month * 2678400 ); //calculates # of days passed ($num_days) * # seconds in a day (86400)
    $return_date = date("Y-m-d",$timestamp);  //puts the UNIX timestamp back into string format
    return $return_date;//exit function and return string
    }
?>
<html height=50,width=150>
<head>
<title>REPORTES</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
<CENTER>
<body bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
 <link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
 <script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js">
 </script><style type="text/css">
<!--
.style1 {font-size: 14px}
-->
</style>
<script>
 function CargarCsv() {
  window.open("<?=$ruta_raiz?>/archivo/cargarcsv.php?&krd=<?=$krd?>&coddepe=<?=$coddepe?>&codusua=<?=$codusua?>","Generar CSV","height=150,width=350,scrollbars=yes");
}

function Regresar(tipo_archivo){
	window.location.assign("<?=$ruta_raiz?>/archivo/cuerpo_exp.php?<?=$encabezado1 ?>&krd=<?=$krd?>&fechah=$fechah&$orno&tipo_archivo=$tipo_archivo&carpeta&adodb_next_page&nomcarpeta");

}

function Asignar(){
<? echo $sell=1;?>
}
function GenerarInv()
{
<?
$numInv+=1;
?>
window.open("<?=$ruta_raiz?>/archivo/generar.php?krd=<?=$krd?>&dep_sel=<?=$dep_sel?>&expe=<?=$expe?>&fechaInii=<?=$fechaInii?>&$fechaInif=<?=$fechaInif?>&exp=<?=$exp?>&exp2=<?=$exp2?>","height=250,width=750,scrollbars=yes" );

}
</script>



 <form name='inventario' action="<?=$encabezadol?>" method='post' action='inventario.php?<?=session_name()?>=<?=trim(session_id())?>&krd=<?=$krd?>&tipo=<?=$tipo?>&sel=<?=$sel?>'>
<br>

<table border=0 width 100% cellpadding="0"  class="borde_tab">
<tr>

	<?

	$fechah=date("dmy") . "_". time("h_m_s");

	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
    $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);

function fnc_date_calc($this_date,$num_years){

   $my_time = strtotime ($this_date); //converts date string to UNIX timestamp
   $timestamp = $my_time + ($num_years * 31557600); //calculates # of days passed ($num_days) * # seconds in a day (86400)
     $return_date = date("Y/m/d",$timestamp);  //puts the UNIX timestamp back into string format

   return $return_date;//exit function and return string
}//end of function

//	echo $tipo;
include("$ruta_raiz/include/query/archivo/queryInventario.php");
if($tipo==1){


?>
<TD class=titulos2 colspan="2" >
<b><center>INVENTARIO CONSOLIDADO CAPACIDAD OCUPADA</b></td>
<tr>
<td class="titulos5">DEPARTAMENTO
			<td>&nbsp;
			<?
			$rsD=$db->query($queryDpto);
			print $rsD->GetMenu2("codDpto", $codDpto,"0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
			?>
			</td>
			</tr>
	<tr>
			<td class="titulos5">MUNICIPIO
			<td >&nbsp;
			<?

 			$rsm=$db->query($queryMuni);
 			print $rsm->GetMenu2("codMuni", $codMuni, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
			?>
			</td>
			</tr>
<TR>
<td class='titulos5'>EDIFICIO</td>
				<TD>&nbsp;
				<?
				include("$ruta_raiz/include/query/archivo/queryInventario.php");
				$rs=$db->query($sql7);
				print $rs->GetMenu2('exp_edificio',$exp_edificio,true,false,""," class=select");
				?>
				</TD>

</TR>
<TR>
<td class='titulos5'>MINIMA UNIDAD</td>
				<TD>&nbsp;
				<?
				if($min==1)$sel="checked"; else $sel="";
				?>
				<span class="listado1"> ENTREPA&Ntilde;O:</span>
				<input name="min" type="radio" value="1" " <?=$sel?>>
				<?
				if($min==2)$sel="checked"; else $sel="";
				?>
				&nbsp; <span class="listado1">CAJA:</span>
				<input name="min" type="radio" value="2" " <?=$sel?>>
				</TD>

</TR>
<TR>
<td class="titulos5" align="right">
<input name='Generar' type=submit class="botones_funcion" id="envia22" value="Generar" >
<TD class="titulos5" align="left">
<input name='Regresar' align="middle" type="button" class="botones_funcion" id="envia22" onClick="window.back();" value="Regresar" ></td>
</td>
</TR>
</table>
<br>
<br>

<table border=0 width 100% cellpadding="0"  class="borde_tab">
<?
$TEMP=0;$TE=0;$DE=0;$DE2=0;$ctotal2=0;$cetotal2=0;$mo2=0;$mv2=0;
if($Generar and $min!=0){
	if ($min==1){$tmp="ESTANTE " or $tmp="estante ";$IT="ENTREPA&Ntilde;OS";$IT2="ENTREPANO " or $IT2="entrepano ";$IT3="ESTANTES";}
	if ($min==2){$tmp="ENTREPANO " or $tmp="entrepano ";$IT="CAJAS";$IT2="CAJA " or $IT2="caja ";$IT3="ENTREPA&Ntilde;OS";}
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sqli);
$i=1;
$p=1;
$q=1;
$r=1;
$l=1;
while (!$rs->EOF){
$piso1=$rs->fields['SGD_EIT_NOMBRE'];
$piso2=explode("PISO ",$piso1);
$piso=$piso2[1];
$pisocod=$rs->fields['SGD_EIT_CODIGO'];
$tp2=0;
if($pisocod!=0){

	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rs2=$db->query($sqlie);
	while(!$rs2->EOF){
		$item1[$i]=$rs2->fields['SGD_EIT_NOMBRE'];
		$item1_cod=$rs2->fields['SGD_EIT_CODIGO'];
		$tmp1=explode('1',$item1[$i]);
		if($tmp1[0]==$tmp){
				include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    		$rs4=$db->query($sqli4);
	    		$TEMP+=$rs4->fields['CO'];
			}

		include("$ruta_raiz/include/query/archivo/queryInventario.php");
		$rs3=$db->query($sqliD);

		while (!$rs3->EOF){
			$item2[$p]=$rs3->fields['SGD_EIT_NOMBRE'];
			$item2_cod=$rs3->fields['SGD_EIT_CODIGO'];
			$tmp2=explode('1',$item2[$p]);
			if($tmp2[0]==$tmp){
				include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    		$rs6=$db->query($sqliw);
	    		$TEMP+=$rs6->fields['CO'];
				}
			if($tmp2[0]==$IT2){
				include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    		$rs6=$db->query($sqliw);
	    		$DE+=$rs6->fields['CO'];
				}
			include("$ruta_raiz/include/query/archivo/queryInventario.php");
			$rs4=$db->query($sqliR);
			while (!$rs4->EOF){
				$item3[$q]=$rs4->fields['SGD_EIT_NOMBRE'];
				$item3_cod=$rs4->fields['SGD_EIT_CODIGO'];
				$tmp3=explode('1',$item3[$q]);
				if($tmp3[0]==$tmp){
					include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    			$rs6=$db->query($sqli1);
		    		$TEMP+=$rs6->fields['CO'];
				}
				if($tmp3[0]==$IT2){
					include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    			$rs6=$db->query($sqlil);
		    		$DE+=$rs6->fields['CO'];
				}
				include("$ruta_raiz/include/query/archivo/queryInventario.php");
				$rs5=$db->query($sqliQ);
				while (!$rs5->EOF){
					$item4[$r]=$rs5->fields['SGD_EIT_NOMBRE'];
					$item4_cod=$rs5->fields['SGD_EIT_CODIGO'];
					$tmp4=explode('1',$item4[$r]);
					if($tmp4[0]==$tmp){
						include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    				$rs6=$db->query($sqli2);
	    				$TEMP+=$rs6->fields['CO'];
					}
					if($tmp4[0]==$IT2){
						include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    				$rs6=$db->query($sqli2);
	    				$DE+=$rs6->fields['CO'];
					}
					include("$ruta_raiz/include/query/archivo/queryInventario.php");
					$rs11=$db->query($sqliT);
					while (!$rs11->EOF){
						$item5=$rs11->fields['SGD_EIT_NOMBRE'];
						$item5_cod=$rs11->fields['SGD_EIT_CODIGO'];
						$tmp5=explode('1',$item5);
						if($tmp5[0]==$tmp){
							include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    					$rs6=$db->query($sqli3);
	    					$TEMP+=$rs6->fields['CO'];
						}
						if($tmp5[0]==$IT2){
							include("$ruta_raiz/include/query/archivo/queryInventario.php");
	    					$rs6=$db->query($sqli3);
	    					$DE+=$rs6->fields['CO'];
						}
						$l=1;
					$rs11->MoveNext();
				}
				$rs5->MoveNext();
				}
				$r=1;
			$rs4->MoveNext();
			}
			$q=1;
		$rs3->MoveNext();
		}
		$p=1;
	$rs2->MoveNext();
	}
	$TE+=$TEMP;
	$DE2+=$DE;
	$mt=$DE/4;
	$ctotal=0;
	$cetotal=0;
	for($an=2005;$an<=Date('Y');$an++){
		$exp=$an;
		include("$ruta_raiz/include/query/archivo/queryInventario.php");
		if($min==1){$rs8=$db->query($sqlo3);$rs9=$db->query($sqlo4);}
		if($min==2){$rs8=$db->query($sqlo2);$rs9=$db->query($sqlo31);}
		if(!$rs8->EOF){
			$gpr=$rs8->fields['ITS'];
			$ctotal+=$gpr;
			}
		if(!$rs9->EOF){
			$gpr=$rs9->fields['ITE'];
			$cetotal+=$gpr;
		}	
	}
	$ctotal2+=$ctotal;
	$cetotal2+=$cetotal;
	$mo=$cetotal/4;
	$mo2+=$mo;
	if($mt!=0)$mv=$mt-$mo;
	else $mv=0;
	$mv2+=$mv;
	if($mt!=0)$porce=($mv*100)/$mt;
	else $porce=0;
	if($DE==0)$porce=100;
?>

<TR>
<td align="center" class="listado2"><?=$piso1?></td>
<td align="center" class="titulos2">TOTAL CAPACIDAD <?=$IT?> </td>
<td align="center" class="listado2"><?=$DE?></td>
<td align="center" class="titulos2">TOTAL CAPACIDAD <?=$IT3?> </td>
<td align="center" class="listado2"><?=$TEMP?></td>
<td align="center" class="titulos2"><?=$IT?> OCUPADOS </td>
<td align="center" class="listado2"><?=$ctotal?></td>
<td align="center" class="titulos2"><?=$IT3?> OCUPADOS </td>
<td align="center" class="listado2"><?=$cetotal?></td>
<td align="center" class="titulos2">M LIMEALES OCUPADOS </td>
<td align="center" class="listado2"><?=$mo?> </td>
<td align="center" class="titulos2">M LINEALES VACIOS </td>
<td align="center" class="listado2"><?=$mv?>
<td align="center" class="titulos2">% LIBRE </td>
<td align="center" class="listado2"><?=$porce?></td></tr>
<?
$i++;
$TEMP=0;
}
$totpor+=$porce;
$TEMP=0;
$DE=0;
$rs->MoveNext();
}
$totalporce=$totpor/($i-1);
?>
<tr><center>
<td>&nbsp;</td>
<td align="center" class="titulos2">TOTAL </td>
<td align="center" class="listado2"><?=$DE2?></td>
<td align="center" class="titulos2">TOTAL </td>
<td align="center" class="listado2"><?=$TE?></td>
<td align="center" class="titulos2">TOTAL </td>
<td align="center" class="listado2"><?=$ctotal2?></td>
<td align="center" class="titulos2">TOTAL </td>
<td align="center" class="listado2"><?=$cetotal2?></td>
<td align="center" class="titulos2">M OCUPADOS TOTAL &nbsp;&nbsp;&nbsp;&nbsp;
<td align="center" class="listado2"><?=$mo2?> </td>
<td align="center" class="titulos2">M LIBRES TOTAL </td>
<td align="center" class="listado2"><?=$mv2?> </td>
<td align="center" class="titulos2">% TOTAL </td>
<td align="center" class="listado2"><?=$totalporce?> </td>
</tr></center>


<?
}
}

if($tipo==2){
	//$tp=1;
?>
<TD class=titulos5 >
<BR><BR>
<CENTER><b>MOVIMIENTO DE COLECCION</b><BR><BR>
<?
if($TIPO1==1)$sel="checked"; else $sel="";
?>
&nbsp; POR CAJAS:
<input name="TIPO1" type="radio" value="1" onClick="submit();" <?=$sel?>>
<?
if($TIPO1==2)$sel="checked"; else $sel="";
?>
&nbsp; POR EXPEDIENTES:
<input name="TIPO1" type="radio" value="2" onClick="submit();" <?=$sel?>><br><BR>
<table border=0 width 80% cellpadding="1"  class="borde_tab">
<BR><center>DATOS ORIGEN</center><BR>
<?

if($TIPO1==1){
?>
<tr>
<td class="titulos5">A&Ntilde;O</td>
<td>
<select class="select" name="s_desde_ano">
          <?
  $agnoactual=Date('Y');
  $i = 1990;
  while($i <= $agnoactual)
  {
    if($ano!=0)$i=$ano;
   	if($i == $flds_desde_ano) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
     $i++;
  }

  ?>
        </select>

  </td></tr>
  <tr>
  <td class="titulos5">DEPENDENCIA</td>
  <td>
  <?
  $query="select depe_nomb,depe_codi from DEPENDENCIA ORDER BY DEPE_NOMB";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('dep_sel',$dep_sel,"0:--- TODAS LAS DEPENDENCIAS ---",false,""," onChange='submit()' class=select");
  ?>
  </td>
  </tr>
  <tr>
  <td class="titulos5">SERIE</td>
  <TD>
  <?php
	if(!$tdoc) $tdoc = 0;
	if(!$codserie) $codserie = 0;
	if(!$tsub) $tsub = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
	?>
  </td>
  </tr>
  <tr>
  <td class="titulos5">SUBSERIE</td>
  <td>
  <?
	$nomb_varc = "su.sgd_sbrd_codigo";
	$nomb_varde = "su.sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );

	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD =$tsub;
	}
  if ($codiSRD<10 and $codiSRD!=0)$codiSRD="0".$codiSRD;
  if ($codiSBRD<10 and $codiSBRD!=0)$codiSBRD="0".$codiSBRD;
  $expe=$s_desde_ano.$dep_sel.$codiSRD.$codiSBRD;
  include("$ruta_raiz/include/query/archivo/queryInventario.php");
  $rsc=$db->conn->query($sqlc);
  $cajas2=$rsc->fields['CAJA'];

	?>
  </td>
  </tr>
  <tr><td class=titulos5 >CAJAS </td>

<td class=titulos5>DESDE  <input type=text name=cajas value='<?=$cajas?>' class="tex_area" size="3" maxlength="2">
&nbsp;&nbsp;&nbsp;&nbsp;HASTA  <input type=text name=cajas2 value='<?=$cajas2?>' class="tex_area" size="3" maxlength="2">
</td>
</tr>
<tr><TD class="titulos5" align="center" colspan="2"><br> NUEVA UBICACION <br><BR></td></tr>

  <tr>
<td class="titulos5">DEPARTAMENTO
			<td>&nbsp;
			<?
			$rsD=$db->query($queryDpto);
			print $rsD->GetMenu2("codDpto", $codDpto,"0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
			?>
			</td>
			</tr>
	<tr>
			<td class="titulos5">MUNICIPIO
			<td >&nbsp;
			<?
 			$rsm=$db->query($queryMuni);
 			print $rsm->GetMenu2("codMuni", $codMuni, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
			?>
			</td>
			</tr>
<TR>
<td class='titulos5'>EDIFICIO</td>
				<TD>&nbsp;
				<?
				include("$ruta_raiz/include/query/archivo/queryInventario.php");
				$rs=$db->query($sql7);
				print $rs->GetMenu2('exp_edificio',$exp_edificio,true,false,""," onChange='submit()' class=select");
				?>
				</TD>

</TR>
<tr><td class=titulos5 >PISO </td>
<TD>&nbsp;
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql3);
print $rs->GetMenu2('exp_piso',$exp_piso,true,false,""," onChange='submit()' class=select ");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql1);
	if (!$rs->EOF)$item61=$rs->fields["SGD_EIT_NOMBRE"];
			$item1=explode('1',$item61);
?></td>
</tr>
<tr><td class=titulos5 ><?=$item1[0]?></td>
<TD>&nbsp;
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql4);
print $rs->GetMenu2('exp_item11',$exp_item11,true,false,""," onChange='submit()' class=select");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql11);
	if (!$rs->EOF)$item51=$rs->fields["SGD_EIT_NOMBRE"];
			$item8=explode('1',$item51);
?></td>
</tr>
<tr><td class=titulos5 ><?=$item8[0]?> </td>
<td>
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql17);
print $rs->GetMenu2('entre',$entre,true,false,"","onChange='submit()'  class=select");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql16);
	if (!$rs->EOF)$item41=$rs->fields["SGD_EIT_NOMBRE"];
			$item7=explode('1',$item41);
?>
</td>
<tr><td class=titulos5 > <?=$item7[0]?> </td>
<td>
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql18);
print $rs->GetMenu2('estan',$estan,true,false,""," onChange='submit()' class=select");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql10);
	if (!$rs->EOF)$item31=$rs->fields["SGD_EIT_NOMBRE"];
			$item9=explode('1',$item31);
?>
</td>
<tr><td class=titulos5 > <?=$item9[0]?> </td>
<td>
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql19);
print $rs->GetMenu2('item',$item,true,false,"","  class=select");
?>
</td>
<?
if ($Cambiar) {

	if($cajas=="")$cajas=0;
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rse=$db->query($sqle);
	$d=1;
	while (!$rse->EOF) {
		$expedientes[$d]=$rse->fields['SGD_EXP_NUMERO'];
		$rse->MoveNext();
		$d++;
	}
	$con=0;
	if ($exp_item11!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$exp_item11' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="AREA " or $tmp1=="ZONA ")$exp_item1=$exp_item11;
					if($tmp1[0]=="CARRO ")$exp_carro=$exp_item11;
					if($tmp1[0]=="ESTANTE ")$estante=$exp_item11;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$exp_item11;
					}
	}
	if ($entre!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$entre' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="AREA " or $tmp1=="ZONA ")$exp_item1=$entre;
					if($tmp1[0]=="CARRO ")$exp_carro=$entre;
					if($tmp1[0]=="ESTANTE ")$estante=$entre;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$entre;
					}
	}
	if ($estan!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$estan' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="AREA " or $tmp1=="ZONA ")$exp_item1=$estan;
					if($tmp1[0]=="CARRO ")$exp_carro=$estan;
					if($tmp1[0]=="ESTANTE ")$estante=$estan;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$estan;
					}
	}
		if ($item!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$item' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="CARRO ")$exp_carro=$item;
					if($tmp1[0]=="ESTANTE ")$estante=$item;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$item;
					}
	}
	for($t=1;$t<$d;$t++){
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rs=$db->query($quer);
	if ($rs->EOF)$con+=1;
	}
	if ($con==0)echo "No se pudo realizar el cambio";
	else echo "El cambio se Realizo Correctamente";
	}
?>
</center></table></td>

<tr><TD colspan='2'>
<CENTER><input name='Cambiar' type=submit class="botones_funcion" id="envia22" value="Cambiar" >

<?
}
if($TIPO1==2){

?>
<tr><td class=titulos5 > EXPEDIENTES </td>
<td class=titulos5><input type=text name=expde value='<?=$expde?>' class="tex_area">
<input type="submit" value=">>" class="botones_2" name="exp"></td>
</tr>
<?
	if($exp=='>>'){
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsex=$db->query($sqlex);
	$unidoc2=$rsex->fields['CARP'];
	$rsex2=$db->query($sqlex2);
	if (!$rsex2->EOF){
	$exp_edificio=$rsex2->fields['SGD_EXP_EDIFICIO'];
	$exp_item2=$rsex2->fields['SGD_EXP_ISLA'];
	$exp_item1=$rsex2->fields['SGD_EXP_UFISICA'];
	$entre=$rsex2->fields['SGD_EXP_ENTREPA'];
	$estan=$rsex2->fields['SGD_EXP_ESTANTE'];
	$u=explode($exp_item2,$exp_item1);
	$exp_item11=$u[1];
	}
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsed = $db->conn->Execute($queryed);
	if (!$rsed->EOF){
		$codDpto=$rsed->fields['SGD_EIT_DPTO'];
		$codMuni=$rsed->fields['SGD_EIT_MUNI'];
	}
}
?>
<tr><td class="titulos5"> UNIDAD DOCUMENTAL </td>
<td class=titulos5>DESDE  <input type=text name=unidoc value='<?=$unidoc?>' class="tex_area" size="3" maxlength="2">
&nbsp;&nbsp;&nbsp;&nbsp;HASTA  <input type=text name=unidoc2 value='<?=$unidoc2?>' class="tex_area" size="3" maxlength="2">
</td>
</tr>
<tr><TD class="titulos5" align="center" colspan="2"><br> NUEVA UBICACION <br><BR></td></tr>

  <tr>
<td class="titulos5">DEPARTAMENTO
			<td>&nbsp;
			<?
			$rsD=$db->query($queryDpto);
			print $rsD->GetMenu2("codDpto", $codDpto,"0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
			?>
			</td>
			</tr>
	<tr>
			<td class="titulos5">MUNICIPIO
			<td >&nbsp;
			<?
 			$rsm=$db->query($queryMuni);
 			print $rsm->GetMenu2("codMuni", $codMuni, "0:-- Seleccione --", false,""," onChange='submit()' class='select'" );
			?>
			</td>
			</tr>
<TR>
<td class='titulos5'>EDIFICIO</td>
				<TD>&nbsp;
				<?
				include("$ruta_raiz/include/query/archivo/queryInventario.php");
				$rs=$db->query($sql7);
				print $rs->GetMenu2('exp_edificio',$exp_edificio,true,false,"","onChange='submit()'  class=select");
				?>
				</TD>

</TR>
<tr><td class=titulos5 >PISO </td>
<TD>&nbsp;
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql3);
print $rs->GetMenu2('exp_piso',$exp_piso,true,false,"","onChange='submit()'  class=select ");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql1);
	if (!$rs->EOF)$item61=$rs->fields["SGD_EIT_NOMBRE"];
			$item1=explode('1',$item61);
?></td>
</tr>
<tr><td class=titulos5 ><?=$item1[0]?></td>
<TD>&nbsp;
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql4);
print $rs->GetMenu2('exp_item11',$exp_item11,true,false,""," onChange='submit()' class=select");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql11);
	if (!$rs->EOF)$item51=$rs->fields["SGD_EIT_NOMBRE"];
			$item8=explode('1',$item51);
?></td>
</tr>
<tr><td class=titulos5 ><?=$item8[0]?> </td>
<td>
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql17);
print $rs->GetMenu2('entre',$entre,true,false,""," onChange='submit()' class=select");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql16);
	if (!$rs->EOF)$item41=$rs->fields["SGD_EIT_NOMBRE"];
			$item7=explode('1',$item41);
?>
</td>
<tr><td class=titulos5 > <?=$item7[0]?> </td>
<td>
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql18);
print $rs->GetMenu2('estan',$estan,true,false,""," onChange='submit()' class=select");
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql10);
	if (!$rs->EOF)$item31=$rs->fields["SGD_EIT_NOMBRE"];
			$item9=explode('1',$item31);
?>
</td>
<tr><td class=titulos5 > <?=$item9[0]?> </td>
<td>
<?
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sql19);
print $rs->GetMenu2('item',$item,true,false,"","  class=select");
?>
</td>
<?
if ($Cambiar) {
	$expedientes[1]=$expde;
	$t=1;
	if($unidoc=="")$unidoc=0;
	if ($exp_item11!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$exp_item11' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="AREA " or $tmp1=="ZONA ")$exp_item1=$exp_item11;
					if($tmp1[0]=="CARRO ")$exp_carro=$exp_item11;
					if($tmp1[0]=="ESTANTE ")$estante=$exp_item11;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$exp_item11;
					}
	}
	if ($entre!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$entre' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="AREA " or $tmp1=="ZONA ")$exp_item1=$entre;
					if($tmp1[0]=="CARRO ")$exp_carro=$entre;
					if($tmp1[0]=="ESTANTE ")$estante=$entre;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$entre;
					}
	}
	if ($estan!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$estan' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="AREA " or $tmp1=="ZONA ")$exp_item1=$estan;
					if($tmp1[0]=="CARRO ")$exp_carro=$estan;
					if($tmp1[0]=="ESTANTE ")$estante=$estan;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$estan;
					}
	}
		if ($item!=""){
					$ttp="select sgd_eit_nombre from sgd_eit_items where sgd_eit_codigo like '$item' order by SGD_EIT_CODIGO";
					$rs=$db->conn->Execute($ttp);
					$tmp=$rs->fields['SGD_EIT_NOMBRE'];
					for ($i=1;$i<=22;$i++){
					$tmp1=explode("$i",$tmp);
					if($tmp1[0]=="CARRO ")$exp_carro=$item;
					if($tmp1[0]=="ESTANTE ")$estante=$item;
					if($tmp1[0]=="ENTREPANO ")$entrepano=$item;
					}
	}
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rs3=$db->conn->query($query);
	if (!$rs3->EOF)echo "No se pudo realizar el cambio";
	else echo "El cambio se Realizo Correctamente";
	}

?>
</center></table></td>

<tr><TD colspan='2'>
<CENTER><input name='Cambiar' type=submit class="botones_funcion" id="envia22" value="Cambiar" >

<?
}
}


if($tipo==3){

?>
<TD class=titulos5 >
<BR><BR>
<CENTER><b>INVENTARIO DOCUMENTAL ARCHIVO DE GESTION</b><BR><BR></CENTER>

<table border=0 width 100% cellpadding="1"  class="borde_tab">
<tr>
<td class="titulos5">A&Ntilde;O</td>
<td>
<select class="select" name="s_desde_ano">
          <?
  $agnoactual=Date('Y');
  $i = 1990;
  while($i <= $agnoactual)
  {
    if($ano!=0)$i=$ano;
   	if($i == $flds_desde_ano) $option="<option SELECTED value=\"" . $i . "\">" . $i . "</option>";
    else $option="<option value=\"" . $i . "\">" . $i . "</option>";
    echo $option;
     $i++;
  }

  ?>
        </select>

  </td></tr>
<tr>
  <td class="titulos5">DEPENDENCIA</td>
  <td>
  <?
  $query="select depe_nomb,depe_codi from DEPENDENCIA ORDER BY DEPE_NOMB";
  $rs1=$db->conn->query($query);
  print $rs1->GetMenu2('dep_sel',$dep_sel,"0:--- TODAS LAS DEPENDENCIAS ---",false,"","  class=select");
  ?>
  </td><br>
	<span class="titulos5">No se debe hacer cambio de dependencia sino hasta que se desee hacer otro inventario documental
  </tr>
   <tr><td class="titulos5" align="left">FECHA ARCHIVO INICIAL</td>
  <td>

  <script language="javascript">
  	<?
	 	if(!$fechaInii) $fechaInii=fnc_date_calcm(date('Y-m-d'),'1');
	 	if(!$fechaInif) $fechaInif = date('Y-m-d');
  	?>
   	var dateAvailable1 = new ctlSpiffyCalendarBox("dateAvailable1", "inventario", "fechaInii","btnDate1","<?=$fechaInii?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable1.date = "<?=date('Y-m-d');?>";
	dateAvailable1.writeControl();
	dateAvailable1.dateFormat="yyyy-MM-dd";
	</script>
</td>
<tr><td class="titulos5" align="right">FINAL </td>
<td>
	<script language="javascript">
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "inventario", "fechaInif","btnDate2","<?=$fechaInif?>",scBTNMODE_CUSTOMBLUE);
	dateAvailable2.date = "<?=date('Y-m-d');?>";
	dateAvailable2.writeControl();
	dateAvailable2.dateFormat="yyyy-MM-dd";
	</script>
	</td>
  </tr>
  <tr>
  <td class="titulos5">SERIE</td>
  <TD>
  <?php
	if(!$tdoc) $tdoc = 0;
	if(!$codserie) $codserie = 0;
	if(!$tsub) $tsub = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "s.sgd_srd_codigo";
	$nomb_varde = "s.sgd_srd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie", $codserie, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );
	?>
  </td>
  </tr>
  <tr>
  <td class="titulos5">SUBSERIE</td>
  <td>
  <?
	$nomb_varc = "su.sgd_sbrd_codigo";
	$nomb_varde = "su.sgd_sbrd_descrip";
	include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsSub=$db->conn->query($querySub);
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsSub->GetMenu2("tsub", $tsub, "0:-- Seleccione --", false,"","onChange='submit()' class='select'" );

	if(!$codiSRD)
	{
		$codiSRD = $codserie;
		$codiSBRD =$tsub;
	}
  if ($codiSRD<10 and $codiSRD!=0)$codiSRD="0".$codiSRD;
  if ($codiSBRD<10 and $codiSBRD!=0)$codiSBRD="0".$codiSBRD;
  $expe=$s_desde_ano.$dep_sel.$codiSRD.$codiSBRD;
  	?>
  </td>
  </tr>

  <?
  include("$ruta_raiz/include/query/archivo/queryInventario.php");
  $rsc=$db->query($bexp);
  $expt2=$rsc->fields['EXPE'];
  $exp21=explode($expe,$expt2);
  $exp2=$exp21[1];
  ?>
  <tr><td class=titulos5 >EXPEDIENTES DESDE</td>

<td class=titulos5>  <input type=text name=cajas value='<?=$exp?>' class="tex_area" size="8" maxlength="7"></td>
<tr><td class=titulos5 align="right">HASTA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><TD class="titulos5">  <input type=text name=cajas2 value='<?=$exp2?>' class="tex_area" size="8" maxlength="7">
</td>
</tr>

<tr><td class="titulos5">OBSERVACIONES</td>
<td class="titulos5"><input type=text name=observa value='<?=$observa?>' class="tex_area"></td></tr>

</TD>
</table>
</TD>
<?

if($Agregar){
	$p=0;
	if($exp=="")$exp="00000";
	$exp_num=$expe;
if ($dep_sel==0)$depe=substr($exp_num,4,3);
else $depe=$dep_sel;
include("$ruta_raiz/include/query/archivo/queryInventario.php");
if($rs=$db->query($sql5))$depe_nom=$rs->fields['DEPE_NOMB'];$c=1;
$rse=$db->query($sqld);

while(!$rse->EOF){
$radicado=$rse->fields['RADI_NUME_RADI'];
$expediente=$rse->fields['SGD_EXP_NUMERO'];
$Caja=$rse->fields['SGD_EXP_CAJA'];
$Unidad=$rse->fields['SGD_EXP_UNICON'];
$Fini=$rse->fields['SGD_EXP_FECH'];
$Ffin=$rse->fields['SGD_EXP_FECHFIN'];
$Archi=$rse->fiedls['SGD_EXP_ARCHIVO'];
$rete=$rse->fields['SGD_EXP_RETE'];
$nundocus=$rse->fields['SGD_EXP_CARPETA'];
$edi=$rse->fields['SGD_EXP_EDIFICIO'];
$estan=$rse->fields['SGD_EXP_ESTANTE'];
$entre=$rse->fields['SGD_EXP_ENTREPANO'];
$zona=$rse->fields['SGD_EXP_UFISICA'];
$carro=$rse->fields['SGD_EXP_CARRO'];
$piso=$rse->fields['SGD_EXP_ISLA'];
$tem=$edi;
include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rstem=$db->query($quernom);
$ubicacion=$rstem->fields['SGD_EIT_SIGLA'];

if($piso!=""){
	$tem=$piso;
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rstem=$db->conn->Execute($quernom);
	$ubicacion.=$rstem->fields['SGD_EIT_SIGLA'];
}
if($zona!=""){
	$tem=$zona;
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rstem=$db->conn->Execute($quernom);
	$ubicacion.=$rstem->fields['SGD_EIT_SIGLA'];
}
if($carro!=""){
	$tem=$carro;
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rstem=$db->conn->Execute($quernom);
	$ubicacion.=$rstem->fields['SGD_EIT_SIGLA'];
}
if($estan!=""){
	$tem=$estan;
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rstem=$db->conn->Execute($quernom);
	$ubicacion.=$rstem->fields['SGD_EIT_SIGLA'];
}
if($entre!=""){
	$tem=$entre;
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rstem=$db->conn->Execute($quernom);
	$ubicacion.=$rstem->fields['SGD_EIT_SIGLA'];
}
$p++;

include("$ruta_raiz/include/query/archivo/queryInventario.php");
$rs=$db->query($sqlr);
if(!$rs->EOF){
$srd=$rs->fields['SGD_SRD_CODIGO'];
$sbrd=$rs->fields['SGD_SBRD_CODIGO'];
$Titulo=$rs->fields['SGD_SEXP_PAREXP1'];
}
if($srd!="" or $sbrd!=""){
	include("$ruta_raiz/include/query/archivo/queryInventario.php");
if($rs=$db->query($sqlsr))$srd_desc=$rs->fields['SGD_SRD_DESCRIP'];$c.=4;
if($rs=$db->query($sqltsb)){
$sbrd_desc=$rs->fields['SGD_SBRD_DESCRIP'];
$disfin=$rs->fields['SGD_SBRD_DISPFIN'];
if($disfin==1)$disfinal="CONSERVACION TOTAL";
if($disfin==2)$disfinal="ELIMINACION";
if($disfin==3)$disfinal="MEDIO TECNICO";
if($disfin==4)$disfinal="SELECCION O MUESTREO";

}
}
else echo "NO TIENE CLASIFICACION DE TRD";
include("$ruta_raiz/include/query/archivo/queryInventario.php");
	$rsf=$db->query($sql13);
	$Folio=$rsf->fields['RADI_NUME_HOJA'];
		$sec=$db->conn->nextId('SEC_INV');
		include("$ruta_raiz/include/query/archivo/queryInventario.php");
		$rs = $db->query($sqlInv);






//print ("entro aki".$c);
//if($c=='12345')echo "Datos traidos";


$rse->MoveNext();
}



	?><tr><TD class=titulos5 >
	<?

	if($cont==1){
	if(!$rs->EOF)echo "No se pudo agregar";
	else echo "La informacion fue agregada al Inventario";
	}
	else {
	if(!$rs->EOF)echo "No se pudo agregar";
	else echo "La informacion fue agregada al Inventario";
	}

}
if($Limpiar){
	$lim="DELETE FROM SGD_EIT_ITEMS";
	//$lim="DELETE FROM SGD_EINV_INVENTARIO";
	$CL=$db->query($lim);
	echo "EL REGISTRO HA SIDO BORRADO";
}
}


if($tipo==3){
	?>
	<tr><TD colspan='2' align="center">
	<?
	if(!$CargarCSV){
?>
	<input name="CargarCSV" type="button" class="botones_funcion" onClick="CargarCsv();" value=" CargarCSV " >
<?
}
if(!$Agregar){
?>
	<input name='Agregar' type=submit class="botones_funcion" value="Agregar"  >
<?
}
if(!$Generar){
?>
	<input name='Generar' type="button" class="botones_funcion" id="envia22" onClick="GenerarInv()" value="Generar" >
<?
}
if(!$Limpiar){
?>
	<input name='Limpiar' type=submit class="botones_funcion" value="Limpiar"  ><b></b>
<?
}
}
if ($tipo==3 or $tipo==2){
?>
<input name='Regresar' align="middle" type="button" class="botones_funcion" id="envia22" onClick="window.back();" value="Regresar" >
<?}?>

	</TD></tr>
</table>
