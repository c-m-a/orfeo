<?
session_start();
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");

//echo $CFechaIni;
//echo $CFechaFin;

?>

	<script type="text/javascript" src="../Calendario/src/utils.js"></script>
	<script type="text/javascript" src="../Calendario/src/calendar.js"></script>
	
	<script type="text/javascript" src="../Calendario/lang/calendar-es.js"></script>
	
	<script type="text/javascript" src="../Calendario/src/calendar-setup.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="../Calendario/themes/aqua.css" title="Calendar Theme - winxp.css" >
	<link href="../Calendario/doc/css/zpcal.css" rel="stylesheet" type="text/css">
	<link href="../Calendario/doc/css/template.css" rel="stylesheet" type="text/css">


<form id="Formulario" name="Formulario" method="post" action="#">
<table>
	<tr>
		<td>Fecha Inicial</td>
		<td>
<input type="text" id="CFechaIni" style="WIDTH:80px;" name="CFechaIni"  value="<?=$CFechaIni?>" >
<input type="reset" value="...." id="bFechaIni" style="height:18px;" class="boton"  >
			<script type="text/javascript">
				var cal = new Zapatec.Calendar.setup({
				
					inputField     :    "CFechaIni",   // id of the input field
					button         :    "bFechaIni",  // What will trigger the popup of the calendar
					ifFormat       :    "%Y/%m/%d", // format of the input field: Mar 18, 2005
					showsTime      :     false,      //no time
					saveDate       :    0            // save for two days					
				});
		</script>
		</td>
		<td rowspan="2"><input type="submit" onClick="Buscar()" value="Generar"> </td>
	</tr>
	
	<tr>
		<td>Fecha Inicial</td>
		<td>
<input type="text" id="CFechaFin" style="WIDTH:80px;" name="CFechaFin" value="<?=$CFechaFin?>" >
<input type="reset" value="...." id="bFechaFin" style="height:18px;" class="boton"  >
			<script type="text/javascript">
				var cal = new Zapatec.Calendar.setup({
				
					inputField     :    "CFechaFin",   // id of the input field
					button         :    "bFechaFin",  // What will trigger the popup of the calendar
					ifFormat       :    "%Y/%m/%d", // format of the input field: Mar 18, 2005
					showsTime      :     false,      //no time
					saveDate       :    0            // save for two days					
				});
		</script>
		</td>
	</tr>
	
</table>


</form>


<?


if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
//$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	
// $db->conn->debug=true;


function sig_lunes($festivo_mov)
{
	switch($festivo_mov)
	{
		case 0:
			$num = 1;
			break;
		case 1:
			$num = 0;
			break;
		case 2:
			$num = 6;
			break;
		case 3:
			$num = 5;
			break;
		case 4:
			$num = 4;
			break;
		case 5:
			$num = 3;
			break;
		case 6:
			$num = 2;
			break;
	}
	return $num;
}

$festivos = array("1" => array("1"),
					"2" => array(),
					"3" => array(),
					"4" => array(),
					"5" => array("1"),
					"6" => array(),
					"7" => array("20"),
					"8" => array("7"),
					"9" => array(),
					"10" => array(),
					"11" => array(),
					"12" => array("8", "25")
					);

$festivos_tmp = array("1" => array("6"),
					"2" => array(),
					"3" => array("19"),
					"4" => array(),
					"5" => array(),
					"6" => array("29"),
					"7" => array(),
					"8" => array("15"),
					"9" => array(),
					"10" => array("12"),
					"11" => array("1", "11"),
					"12" => array()
					);

function month($month){
	switch ($month) {
		case 1: 
			$mes = "Enero";
			break;
		case 2:
			$mes = "Febrero";
			break;
		case 3: 
			$mes = "Marzo";
			break;
		case 4:
			$mes = "Abril";
			break;
		case 5: 
			$mes = "Mayo";
			break;
		case 6:
			$mes = "Junio";
			break;
		case 7: 
			$mes = "Julio";
			break;
		case 8:
			$mes = "Agosto";
			break;
		case 9:
			$mes = "Septiembre";
			break;
		case 10:
			$mes = "Octubre";

			break;
		case 11: 
			$mes = "Noviembre";
			break;
		case 12:
			$mes = "Diciembre";
			break;
		};
	return($mes); 
	}

function get_festivos($anio){
	global $festivos;
	global $festivos_tmp;
	
	festivo_religioso(pascua($anio), 'Jueves Santo', 0);
	festivo_religioso(pascua($anio), 'Viernes Santo', 0);
	festivo_religioso(pascua($anio), 'Asension', 1);
	festivo_religioso(pascua($anio), 'Corpus Cristi', 1);
	festivo_religioso(pascua($anio), 'Sagrado Corazon', 1);

	for($i = 1; $i <= 12; $i ++){
		$this_month = getDate(mktime(0, 0, 0, $i, 1, $anio));
		$next_month = getDate(mktime(0, 0, 0, $i + 1, 1, $anio));
		$days = round(($next_month[0] - $this_month[0]) / (60 * 60 * 24));
		for($i_day = 1; $i_day <= $days; $i_day ++){
			$festivo = date("w", mktime(0, 0, 0, $i, $i_day, $anio));
			if($festivo == 0 || $festivo == 6){
				$festivo_month = $festivos[$i];
				array_push($festivo_month, $i_day);
				$festivos[$i] = $festivo_month;
				}
			$fiesta_tmp = $festivos_tmp[$i];
			foreach ($fiesta_tmp as $fiesta){
				if($fiesta == $i_day){
					$festivo_mov = date("w", mktime(0, 0, 0, $i, $i_day, $anio));
					$festivo_month = $festivos[$i];
					
					if($festivo_mov != 1){
						$num = sig_lunes($festivo_mov);
						$festivo_new = date("Y-m-d", mktime(0,0,0, $i, $i_day, $anio) + $num * 24 * 60 * 60);
						list($f_anio, $f_mes, $f_dia) = parte_fecha($festivo_new);
						if(substr($f_mes, 0, 1) == 0){
							$f_mes = substr($f_mes, 1, 2);
							}
						if(substr($f_dia, 0, 1) == 0){
							$f_dia = substr($f_dia, 1, 2);
							}
						$festivo_month = $festivos[$f_mes];
						array_push($festivo_month, $f_dia);
						$festivos[$f_mes] = $festivo_month;
						}
					else{
						array_push($festivo_month, $i_day);
						$festivos[$i] = $festivo_month;
						}
					}
				}
			}
		}
	}

function es_festivo($dia, $mes, $anio){
	global $festivos;
	if(substr($mes, 0, 1) == 0){
		$mes = substr($mes, 1, 2);
		}
	if(substr($dia, 0, 1) == 0){
		$dia = substr($dia, 1, 2);
		}
	$dias_festivos = $festivos[$mes];
	foreach ($dias_festivos as $fiesta){
		if($fiesta == $dia)
			$es_festivo = 1;
		}
	return $es_festivo;
	}

function suma_dias($fecha_old, $ndias, $habil){
	list($anio, $mes, $dia) = parte_fecha($fecha_old);
	get_festivos($anio);
	if($habil == 1){
		for($i = 1; $i <= $ndias; $i ++){
			$fecha_new = date("Y-m-d", mktime(0,0,0, $mes, $dia, $anio) + 1 * 24 * 60 * 60);
			list($anio, $mes, $dia) = parte_fecha($fecha_new);
			$fiesta = es_festivo($dia, $mes, $anio);
			if($fiesta == 1){
				$i --;
				}
			}
		}
	else{
		$fecha_new = date("Y-m-d", mktime(0,0,0, $mes, $dia, $anio) + $ndias * 24 * 60 * 60);
		}
	return ($fecha_new);
	}

function pascua ($anio){
	$a = $anio % 19;
	$b = floor($anio / 100);
	$c = $anio % 100;
	$d = floor($b / 4);
	$e = $b % 4;
	$f = floor(($b + 8) / 25);
	$g = floor(($b - $f + 1) / 3);
	$h = (19 * $a + $b - $d - $g + 15) % 30;
	$i = floor($c / 4);
	$k = $c % 4;
	$l = (32 + 2 * $e + 2 * $i - $h - $k) % 7;
	$m = floor(($a + 11 * $h + 22 * $l) / 451);
	$p = ($h + $l - 7 * $m + 114); // L o 1
	$month = floor($p / 31);
	$day = ($p % 31) + 1; //L o 1
	$date_pascua = date("Y-m-d", mktime(0, 0, 0, $month, $day, $anio));
	return $date_pascua;
	}

function festivo_religioso($date, $fiesta, $movible){
	global $festivos;
	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $date, $fecha); 
	$anio = $fecha[1];
	$mes = $fecha[2];
	$dia = $fecha[3];
	switch($fiesta){
		case 'Jueves Santo':
			$ndias = '-3';
			break;
		case 'Viernes Santo':
			$ndias = '-2';
			break;
		case 'Asension':
			$ndias = '39';
			break;
		case 'Corpus Cristi':
			$ndias = '60';
			break;
		case 'Sagrado Corazon':
			$ndias = '65';
			break;
		}
	$fecha_new = date("Y-m-d", mktime(0, 0, 0, $mes, $dia, $anio) + $ndias * 24 * 60 * 60);
	list($anio_tmp, $mes_tmp, $dia_tmp) = parte_fecha($fecha_new);
	if($movible == 1){
		$festivo_mov = date("w", mktime(0, 0, 0, $mes_tmp, $dia_tmp, $anio_tmp));
		if($festivo_mov != 1){
			$num = sig_lunes($festivo_mov);
			$fecha_new = date("Y-m-d", mktime(0,0,0, $mes_tmp, $dia_tmp, $anio_tmp) + $num * 24 * 60 * 60);
			list($anio_tmp, $mes_tmp, $dia_tmp) = parte_fecha($fecha_new);
			}
		}
	
	if(substr($mes_tmp, 0, 1) == 0){
		$mes_tmp = substr($mes_tmp, 1, 2);
		}
	if(substr($dia_tmp, 0, 1) == 0){
		$dia_tmp = substr($dia_tmp, 1, 2);
		}
	array_push($festivos[$mes_tmp], $dia_tmp);
	return $fecha_new;
	}

function parte_fecha($fecha){
	ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $date); 
	$anio = $date[1];
	$mes = $date[2];
	$dia = $date[3];
	return array($anio, $mes, $dia);
	}

function diff_days($fecha_ini, $fecha_fin)
{
	if(!$fecha_fin)
		$fecha_fin=date("Y-n-j");
	list($anio_ini, $mes_ini, $dia_ini) = parte_fecha($fecha_ini);
	list($anio_fin, $mes_fin, $dia_fin) = parte_fecha($fecha_fin);

	if($fecha_ini < $fecha_fin)
	{
//		echo "<br>Fecha inicial -> <b>" . $fecha_ini . "</b><br>";
//		echo "Fecha final -> <b>" . $fecha_fin . "</b><br>";

		get_festivos($anio_ini);
		$calendario = (mktime(0, 0, 0, $mes_fin, $dia_fin, $anio_fin) - mktime(0, 0, 0, $mes_ini, $dia_ini, $anio_ini)) / (24 * 60 * 60);
		for($i = 1; $i <= $calendario; $i ++)
		{
			$fecha_new = date("Y-m-d", mktime(0,0,0, $mes_ini, $dia_ini, $anio_ini) + 1 * 24 * 60 * 60);
			list($anio_ini, $mes_ini, $dia_ini) = parte_fecha($fecha_new);
			$fiesta = es_festivo($dia_ini, $mes_ini, $anio_ini);
			if($fiesta == 1)
			{
				$festivos += 1;
			}
		}
		$habil = $calendario - $festivos;
//		echo "No. de dias habiles <b>" . $habil . "</b><br>";
//		echo "No. de dias festivos <b>" . $festivos . "</b><br>";
//		echo "No. de dias calendario <b>" . $calendario . "</b><br><br>";

		return $habil;
	}
	else
	{	
		return 0;
//		echo "La fecha inicial debe ser menor a la fecha final";
	}
}
//echo  "Buscar:".$Buscar;
if($CFechaIni && $CFechaFin)
{
$Numero=0;

 


$sql="select b.USUA_NOMB USUARIO,a.RA_ASUN as asunto,d.ANEX_CREADOR ,
	   RADI_NUME_RADI as NO_RADICADO,d.RADI_NUME_SALIDA,a.RADI_FECH_RADI,d.SGD_FECH_IMPRES,d.ANEX_ESTADO, d.ANEX_FECH_ENVIO 
from radicado a 
inner join  USUARIO b on  (b.usua_CODI=a.RADI_USUA_ACTU and b.DEPE_CODI=a.RADI_DEPE_ACTU )
inner join  Anexos d on d.ANEX_RADI_NUME=a.radi_nume_radi and d.ANEX_TIPO<>20 and d.ANEX_BORRADO='N'
where TO_CHAR(a.radi_fech_radi, 'yyyy/mm/dd') BETWEEN '$CFechaIni' AND '$CFechaFin' 
and substr(a.radi_nume_radi, 5, 3)='440' AND substr(a.radi_nume_radi, 14, 1)='2' 
and a.RA_ASUN like '%QUEJA%' order by a.RADI_FECH_RADI";

	$rs = $db->query($sql);
//	echo $rs->RecordCount()."<br>";
?>
	<table border="1">
		<tr>
			<td>No</td>
			<td>FECHA RADICADO</td>
			<td>FECHA IMPRESION</td>
			<td>FECHA ENVIO</td>
			<td>RADICADO ENTRADA</td>
			<td> RADICADO SALIDA</td>
			<td>RESPUESTA POR</td>
			<td>USUARIO ACTUAL</td>
			<TD>ASUNTO</TD>
			<td>TERMINO</td>
			<td>DIFERENCIA</td>
		</tr>
<?
	while(!$rs->EOF )
//	while(!$rs->EOF)
	{

		$FechaIni=$rs->fields["RADI_FECH_RADI"];
		$FechaFin=$rs->fields["SGD_FECH_IMPRES"];	
	
		if($rs->fields["ANEX_ESTADO"]=="2")
		{
			$sql1="select SGD_FECH_IMPRES from Anexos where RADI_NUME_SALIDA='".$rs->fields["RADI_NUME_SALIDA"]."' and ANEX_ESTADO in(3,4)";
//			echo $sql1;
			$rs1 = $db->query($sql1);
			if(!$rs1->EOF)
			{
				$FechaFin=$rs1->fields["SGD_FECH_IMPRES"];
			}
		}
		
		$diferencia=diff_days($FechaIni,$FechaFin);
		$termino=0;

		if( strpos("QUEJA", $rs->fields["ASUNTO"]) ===true)
			$sandra=15;
		else if( strpos("PETICI", $rs->fields["ASUNTO"]) ===true)
			$termino=15;
		else if( strpos("TUTELA", $rs->fields["ASUNTO"]) ===true)
			$termino=5;
		else
			$termino=15;
			
//		echo $rs->fields["ASUNTO"]." :".strpos("QUEJA", $rs->fields["ASUNTO"]).",".strpos("PETICI", $rs->fields["ASUNTO"]).",".strpos("TUTELA", $rs->fields["ASUNTO"])."<br>";
?>
		<tr>
			<td><?=++$Numero?></td>
			<td><?=$FechaIni?></td>
			<td><?=$FechaFin?></td>			
			<td><?=$rs->fields["ANEX_FECH_ENVIO"]?></td>
			<td><?=$rs->fields["NO_RADICADO"]?></td>
			<td><?=$rs->fields["RADI_NUME_SALIDA"]?></td>
			<td><?=$rs->fields["ANEX_CREADOR"]?></td>
			<td><?=$rs->fields["USUARIO"]?></td>
			<td><?=$rs->fields["ASUNTO"]?></td>
			<td><?=$termino?></td>
			<td><?=$diferencia?></td>
		</tr>
<?
		$rs->MoveNext();
	}
	
	
	
$sql="select RADI_NUME_RADI as NO_RADICADO,b.USUA_NOMB USUARIO,a.RADI_FECH_RADI,a.RA_ASUN as asunto
from radicado a 
inner join  USUARIO b on  (b.usua_CODI=a.RADI_USUA_ACTU and b.DEPE_CODI=a.RADI_DEPE_ACTU)
where TO_CHAR(a.radi_fech_radi, 'yyyy/mm/dd') BETWEEN '$CFechaIni' AND '$CFechaFin' 
and	a.radi_nume_radi not in (select ANEX_RADI_NUME from Anexos where ANEX_TIPO<>20 and ANEX_BORRADO='N')
and substr(a.radi_nume_radi, 5, 3)='440' AND substr(a.radi_nume_radi, 14, 1)='2' 
and a.RA_ASUN like '%QUEJA%' order by a.RADI_FECH_RADI";
//echo $sql;

	$rsGenenral = $db->query($sql);
//echo $sql;
//	echo $rsGenenral->RecordCount()."<br>";

	while(!$rsGenenral->EOF)
	{
//		echo "'".$rsGenenral->fields["NO_RADICADO"]."',";

		$sql="select b.USUA_NOMB USUARIO,a.RA_ASUN as asunto,d.ANEX_CREADOR ,
			   RADI_NUME_RADI as NO_RADICADO,d.RADI_NUME_SALIDA,a.RADI_FECH_RADI,d.SGD_FECH_IMPRES,d.ANEX_ESTADO, d.ANEX_FECH_ENVIO 
		from radicado a 
		inner join  USUARIO b on  (b.usua_CODI=a.RADI_USUA_ACTU and b.DEPE_CODI=a.RADI_DEPE_ACTU)
		inner join  Anexos d on d.ANEX_RADI_NUME=a.radi_nume_radi and d.ANEX_TIPO<>20 and d.ANEX_BORRADO='N'
		where a.RADI_NUME_DERI='".$rsGenenral->fields["NO_RADICADO"]."'
		order by a.RADI_FECH_RADI";
//		echo $sql;
			$rs = $db->query($sql);

		$FechaIni=$rsGenenral->fields["RADI_FECH_RADI"];
	
		if( strstr ("QUEJA", $rsGenenral->fields["asunto"]) ===true)
			$termino=15;
		else if( strstr ("PETICI", $rsGenenral->fields["asunto"]) ===true)
			$termino=15;
		else if( strstr ("TUTELA", $rsGenenral->fields["asunto"]) ===true)
			$termino=5;
		else
			$termino=30;

//		echo $rsGenenral->fields["asunto"]." :".strpos("QUEJA", $rsGenenral->fields["asunto"]).",".strpos("PETICI", $rsGenenral->fields["asunto"]).",".strpos("TUTELA", $rsGenenral->fields["asunto"])."<br>";
		if(!$rs->EOF)
		{
			while(!$rs->EOF)
			{				
				$FechaFin=$rs->fields["SGD_FECH_IMPRES"];			
				if($rs->fields["ANEX_ESTADO"]=="2")
				{
					$sql1="select SGD_FECH_IMPRES from Anexos where RADI_NUME_SALIDA='".$rs->fields["RADI_NUME_SALIDA"]."' and ANEX_ESTADO in (3,4)";
		//			echo $sql1;
					$rs1 = $db->query($sql1);
					if(!$rs1->EOF)
					{
						$FechaFin=$rs1->fields["SGD_FECH_IMPRES"];
					}
				}				
				$diferencia=diff_days($FechaIni,$FechaFin);
				$termino=0;
				
?>
				<tr>
					<td><?=++$Numero?></td>
					<td><?=$FechaIni?></td>
					<td><?=$FechaFin?></td>					
					<td><?=$rsGenenral->fields["ANEX_FECH_ENVIO"]?></td>
					<td><?=$rsGenenral->fields["NO_RADICADO"]?></td>
					<td><?=$rs->fields["RADI_NUME_SALIDA"]?></td>
					<td><?=$rs->fields["ANEX_CREADOR"]?></td>
					<td><?=$rs->fields["USUARIO"]?></td>
					<td><?=$rs->fields["ASUNTO"]?></td>
					<td><?=$termino?></td>
					<td><?=$diferencia?></td>
				</tr>
		<?
				$rs->MoveNext();
			}
		}
		else
		{
//			echo $sql;
			$diferencia=diff_days($FechaIni,$FechaFin);
?>
				<tr>
					<td><?=++$Numero?></td>
					<td><?=$FechaIni?></td>
					<td><?=$FechaFin?></td>
					<td><?=$rsGenenral->fields["ANEX_FECH_ENVIO"]?></td>
					<td><?=$rsGenenral->fields["NO_RADICADO"]?></td>
					<td>SIN RESPUESTA</td>
					<td></td>
					<td><?=$rsGenenral->fields["USUARIO"]?></td>
					<td><?=$rsGenenral->fields["ASUNTO"]?></td>
					<td><?=$termino?></td>
					<td><?=$diferencia?></td>
				</tr>
<?
		}
	$rsGenenral->MoveNext();
	}
?>




</table>
<?

//echo "$sql<br>";
//$db->conn->CommitTrans();
}
?>