<?php
function sig_lunes($festivo_mov){
	switch($festivo_mov){
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
	  return (isset($es_festivo))? $es_festivo : -1;
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
	  return (isset($fecha_new))? $fecha_new : -1;
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

function diff_days($fecha_ini, $fecha_fin){
	list($anio_ini, $mes_ini, $dia_ini) = parte_fecha($fecha_ini);
	list($anio_fin, $mes_fin, $dia_fin) = parte_fecha($fecha_fin);
	if($fecha_ini < $fecha_fin){
		echo "<br>Fecha inicial -> <b>" . $fecha_ini . "</b><br>";
		echo "Fecha final -> <b>" . $fecha_fin . "</b><br>";

		get_festivos($anio_ini);
		$calendario = (mktime(0, 0, 0, $mes_fin, $dia_fin, $anio_fin) - mktime(0, 0, 0, $mes_ini, $dia_ini, $anio_ini)) / (24 * 60 * 60);
		for($i = 1; $i <= $calendario; $i ++){
			$fecha_new = date("Y-m-d", mktime(0,0,0, $mes_ini, $dia_ini, $anio_ini) + 1 * 24 * 60 * 60);
			list($anio_ini, $mes_ini, $dia_ini) = parte_fecha($fecha_new);
			$fiesta = es_festivo($dia_ini, $mes_ini, $anio_ini);
			if($fiesta == 1){
				$festivos += 1;
				}
			}
		$habil = $calendario - $festivos;
		
		echo "No. de dias habiles <b>" . $habil . "</b><br>";
		echo "No. de dias festivos <b>" . $festivos . "</b><br>";
		echo "No. de dias calendario <b>" . $calendario . "</b><br><br>";
		}
	else{	
		echo "La fecha inicial debe ser menor a la fecha final";
		}
	}

?>
