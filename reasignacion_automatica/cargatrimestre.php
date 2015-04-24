<?
function nombre_tri($cod_tri){
	switch($cod_tri){
		case 1:
			$NombreTrimestre="PRIMERO";
			break;
		case 2:
			$NombreTrimestre="SEGUNDO";
			break;
		case 3:
			$NombreTrimestre="TERCERO";
			break;
		case 4:
			$NombreTrimestre="CUARTO";
			break;
		}
	return $NombreTrimestre;
	}
	
session_start();

$ruta_raiz = "..";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once ("$ruta_raiz/class_control/TipoDocumental.php");


if (!$db)
	$db = new ConnectionHandler($ruta_raiz);

$db->conn->BeginTrans();

$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	

if($Ano){
	?>
	<select id="combo_trimestre" name="Trimestre" multiple>
	<?
/*
MODIFICADO CARLOS BARRERO - SUPERSOLIDARIA
04/06/09
PERMITE REGISTRAR PAZ Y SALVOS A ENTIDADES SIN NIT
	$sql="(SELECT PER_CODIGO FROM SES_PERIODOS WHERE PER_TIPO=3) MINUS (select PYS_TRIMESTRE from SES_PAZYSALVOS_CTA WHERE PYS_ANO=$Ano and NIT_DE_LA_EMPRESA=$cc_documento_us3)";

*/
	$sql="(SELECT PER_CODIGO FROM SES_PERIODOS WHERE PER_TIPO=3) MINUS (select PYS_TRIMESTRE from SES_PAZYSALVOS_CTA WHERE PYS_ANO=$Ano and IDENTIFICADOR_EMPRESA=$documento)";

//echo $sql;
	$rs = $db->query($sql);
	
	
	if($rs!=false){
		$NombreTrimestre="";
		while(!$rs->EOF){
			$per_codigo = $rs->fields["PER_CODIGO"];

/*
MODIFICADO CARLOS BARRERO - 04/06/09
			$sql_tri = "SELECT * FROM SES_PAZYSALVOS_CTA 
				WHERE NIT_DE_LA_EMPRESA = $cc_documento_us3 AND PYS_ANO = $Ano AND PYS_TRIMESTRE = $per_codigo";
*/
			$sql_tri = "SELECT * FROM SES_PAZYSALVOS_CTA 
				WHERE IDENTIFICADOR_EMPRESA = $documento AND PYS_ANO = $Ano AND PYS_TRIMESTRE = $per_codigo";

			$rs_tri = $db->query($sql_tri);
		
			if(!$rs_tri)
			{
				$rs->MoveNext();
			}

			$NombreTrimestre = nombre_tri($per_codigo);
			?>
			<option value="<?=$rs->fields["PER_CODIGO"]?>"><?=$NombreTrimestre?></option>
			<?
			$rs->MoveNext();
			}
		}
	else
		echo "fallo en consulta";
	?>
	</select>
	<?
	}
	?>

