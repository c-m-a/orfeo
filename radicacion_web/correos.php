<?
//tiempo de ejecucion
set_time_limit(30000);
session_start();

include('../adodb/adodb.inc.php');
include('../conecta/conecta.php');
include('../sql/sala_prensa_doc.php');
include('../funciones/funciones.php');

$cuerpo=str_replace('192.127.28.5','www.supersolidaria.gov.co',$_SESSION['cuerpo']);
$sec=consecutivo("boletines","id",$db)+1;

					$campos[]="id";
					$campos[]="contenido";
					$campos[]="fecha";
//					$valores[]=(int)consecutivo("boletines","id",$db)+1;
					$valores[]=(int)$sec;
					$valores[]=texto_ajax($cuerpo);
					$valores[]=date('m-d-Y');
					inserta('boletines',$campos,$valores,$db);
					unset($campos);
					unset($valores);



function trae_id($correo,$db)
	{
		$sql_id="select idusuario from usupag where email='".$correo."'";
		$rs_id=$db->Execute($sql_id);
		return $rs_id->fields['idusuario'];
	}
	
$sql_boletin="select contenido from boletines where id=".$sec;
$rs_boletin=$db->Execute($sql_boletin);

$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers .= "Reply-To: Comunicaciones Supersolidaria <comunicaciones@supersolidaria.gov.co>\r\n" ;
$headers .= "Return-Path: Comunicaciones Supersolidaria <comunicaciones@supersolidaria.gov.co>\r\n" ;
$headers .= "From: Bolet�n Virtual Supersolidaria<comunicaciones@supersolidaria.gov.co>\r\n" ;
$headers .= "Organization: Superintendencia de la Econom�a Solidaria\r\n" ;


$k=0;
$error=0;
$correos_error="";
$asunto="Bolet�n Virtual No. ";
$asunto.=$sec;
foreach($_SESSION['correos'] as $row)
{
	if((emailValidator($row))==false)
		{
		$error++;
		$correos_error.=$row.",";
		$daralta[]=$row;
		}
	else
		{
		mail($row,$asunto,$rs_boletin->fields['contenido'],$headers);
		$nombre_archivo = '../log/correo_boletin_'.$sec.'.txt';
		$contenido = trae_id($row,$db).",";
		$gestor = fopen($nombre_archivo, 'a');
		fwrite($gestor, $contenido);
		fclose($gestor);
		}

$k++;
}

/*
DEPURACION CORREOS DE ERROR SE MARCAN CON 1, PARA QUE EL PROGRAMA NO LOS TOME EN CUENTA
$daralta[] vector que contiene direcciones de correo invalidas.
24 de Marzo de 2009
*/
foreach($daralta as $fila)
{
	$sqlupd="update usupag set estado=1 where email='".$fila."'";
	$db->Execute($sqlupd);
}
$cuerpo="<strong>Reporte de Envio:</strong>
<br /><br />
Correos enviados satisfactoriamente : ".($k-$error)."<br />
Correos con problemas :".$correos_error."<font color=#FF0000>Estos correos ser&aacute;n marcados como invalidos.</font>
<br />
Total Correos :".$k;
?>
<?
					unset($_SESSION['cuerpo']);
					unset($_SESSION['correos']);

$headers2 = "MIME-Version: 1.0\r\n"; 
$headers2 .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
$headers2 .= "Reply-To: ENVIOS MASIVOS<cbarrero@supersolidaria.gov.co>\r\n" ;
$headers2 .= "Return-Path: ENVIOS MASIVOS <cbarrero@supersolidaria.gov.co>\r\n" ;
$headers2 .= "From: Boletin ENVIOS MASIVOS<cbarrero@supersolidaria.gov.co>\r\n" ;
$headers2 .= "Organization: Superintendencia de la Econom�a Solidaria\r\n" ;
$asunto2="Confirmaci�n Envio Bolet�n Virtual No. ";
$asunto2.=$sec;
		mail('cbarrero@supersolidaria.gov.co',$asunto2,$cuerpo,$headers2);
		mail('ostaaden@supersolidaria.gov.co',$asunto2,$cuerpo,$headers2);
?>