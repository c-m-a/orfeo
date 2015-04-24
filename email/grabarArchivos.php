<?
error_reporting(7);
$ruta_raiz = "..";

//$db->conn->debug =true;
//if(!$dependencia or !$krd) include ("../rec_session.php");
 $encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
 include "connectIMAP.php";

//------------------------Funcion Suprime caracteres no imprimibles----------------------------//
 function sup_tilde($str)
{
 $stdchars= array("@","a","e","i","o","u","n","A","E","I","O","U","N"," "," ");
 $tildechars= array("@","=E1","=E9","=ED","=F3","=FA","=F1","=C1","=C9","=CD","=D3","=DA","=D1","=?iso-8859-1?Q?","?=");
 return str_replace($tildechars,$stdchars, $str);
}
$iEmail = 0;
//---------------------------------------------------------------------------------------//


 if($eMailMid){
  $eMailPid = $_SESSION['eMailPid'];
 	$body =$msg->getBody($eMailMid,$eMailPid);
	//lectura cabeceras----
	$msg->getHeaders($eMailMid);
 	error_reporting(7);
  $eMailRemitente = $_SESSION['eMailRemitente'];
  $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
	if($body['ftype']=="text/html") $nl="</br>"; else $nl="\n";
	$headRadicado = "
	<TABLE width=\"90%\" cellspacing=\"0\" border=\"0\" cellpadding=\"0\" >
  <tr><td width=55%>&nbsp;</td>
  <td border=1>
	<FONT face='free3of9,FREE3OF9, FREE3OF9X' SIZE=12>*$nurad*</FONT><br>
	Radicado No. $nurad<br>
	Fecha : ".$msg->header[$eMailMid]['Date']."<br>";
	$headRadicado .= "<FONT SIZE=2>".$_SESSION['entidad_largo']."<br>";
	$headRadicado .= "Consulte su Tramite en ".$_SESSION['pagina_web']."<br></FONT>
  </td></tr>
  </TABLE>
";
$remitente = sup_tilde($msg->header[$eMailMid]['from_personal'][0])." <".sup_tilde($msg->header[$eMailMid]['from'][0]).">";
$head=	"De :$remitente<br>";
$head .="Asunto :". $msg->header[$eMailMid]['Subject'] ."<br>";
$iMailMid = 0;
$iMail = 0;
foreach($msg->header[$eMailMid]['to_personal'] as $key => $value)
{
	if($iMail==0) 
	{
		$head.="Para :";
	} 
	else
	{
		$head.=", ";
	}
	$head.="".$msg->header[$eMailMid]['to_personal'][$iMail]."";
	$head.="< ".$msg->header[$eMailMid]['to'][$iMail]." >";
	$iMail++;
}

error_reporting(7);
// Graba el Radicado 

//$body =$msg->getBody($eMailMid,1.2);
$msg->getHeaders($eMailMid);
  if($body['ftype']=="text/html") 
	{
			$aExtension="html"; 
			$nl = "<br>";
		}else{
			$aExtension="html";
			$nl = "<br>";
	}
  $tmpNameEmail = $nurad.".".$aExtension;
  $directorio = substr($nurad,0,4) ."/". substr($nurad,4,3)."/";
	$fileRadicado = "../bodega/$directorio".$tmpNameEmail;
	$cuerpoMensaje = str_replace("\n","<br>",$body['message']);
	$archivoRadicado = $headRadicado . $head. " $nl ". $cuerpoMensaje;
	$file1=fopen($fileRadicado,'w');
	fputs($file1,$body['message']);
	fclose($file1);
	
$msg->getParts($eMailMid);
// Finalizacion Grabacion de Radicado e inicio Grabacion de Attachment

$numPartes =  count($msg->structure[$eMailMid]['obj']->parts);
$radicadoAttach = "______________________________________________________________________________________$nl";
$iMail = 0;

if (count($msg->msg[$eMailMid]['at']['pid']) >= 0)
{
				// Forr para colocar los remitentes en el Texto 0, o del correo.
if (count($msg->msg[$eMailMid]['at']['pid']) > 0)
	{
   $numPartesi=0;
   foreach ($msg->msg[$eMailMid]['at']['pid'] as $i => $aid)
	 {
       //echo "Archivo -->". $msg->structure[$eMailMid]['obj']->parts[$numPartesi]->dparameters[0]->value;
    $Pid = $aid;
    $body =$msg->getBody($eMailMid,$Pid);
    error_reporting(7);
    $msg->getHeaders($eMailMid);
    //$msg->getMailinboxes;
    //print_r($msg);
			 $fname = strtolower($msg->msg[$eMailMid]['at']['fname'][$i]);
			 $aExtension = substr($fname,-3,3);

		$numPartesi++;
		$fn=$body['fname'];
	//--Variable con la Cabecera en formato html----------------------------------//
	//----------------------------------------------------------------------------//
		$codigoAnexo = $nurad."000$numPartesi";
		$tmpNameEmail = $nurad."_000".$numPartesi.".".$aExtension;
		$directorio = substr($nurad,0,4) ."/". substr($nurad,4,3)."/docs/";
		$fileEmailMsg = "../bodega/$directorio".$tmpNameEmail;
	
		$file1=fopen($fileEmailMsg,'w');
		$archivo = $body['message'];
		fputs($file1,$body['message']);
		fclose($file1);
		$anexoTamano = $msg->msg[$eMailMid]['at']['fsize'][$i];
		echo "<br>Grabado Archivo en ---> <a href='$fileEmailMsg'> $fn </a>";
		$radicadoAttach .= "< ". $fname ." Tama&ntilde;o :". $anexoTamano . " >";
		$fileEmailMsg = str_replace("..","",$fileEmailMsg);
		$fecha_hoy = Date("Y-m-d");
		if(!$db->conn) echo "No hay conexion";
		$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
		$record["ANEX_RADI_NUME"] =$nurad;
		$record["ANEX_CODIGO"] =$codigoAnexo;
		$record["ANEX_TAMANO"] ="'".$anexoTamano."'";
		$record["ANEX_SOLO_LECT"] ="'S'";
		$record["ANEX_CREADOR"] ="'".$krd."'";
		$record["ANEX_DESC"] ="' Archivo:.". $fname."'";
		$record["ANEX_NUMERO"] =$numPartesi;
		$record["ANEX_NOMB_ARCHIVO"] ="'".$tmpNameEmail."'";
		$record["ANEX_BORRADO"] ="'N'";
		$record["ANEX_DEPE_CREADOR"] =$dependencia;
		$record["SGD_TPR_CODIGO"] ='0';
		$record["ANEX_TIPO"] ="1";
		$record["ANEX_FECH_ANEX"] =$sqlFechaHoy;
		$db->insert("anexos", $record, "true");
  }
  $radicadoAttach = $radicadoAttach ."$nl ______________________________________________________________________________________";
  $archivoRadicado = $archivoRadicado . " $nl 
																					Documentos Adjuntos : 
																					$nl $radicadoAttach";
 }
	echo "<br> Documento de Radicado ---> <a href='$fileRadicado' target='image'> $fileRadicado </a>";
	$file1=fopen($fileRadicado,'w');
	fputs($file1,$archivoRadicado);
	fclose($file1);
	str_replace('..','',$fileRadicado);
		$isqlRadicado = "update radicado set RADI_PATH = '$fileRadicado' where radi_nume_radi = $nurad";
		$rs=$db->conn->query($isqlRadicado);
		//print("Ha efectuado la transaccion($isql)($dependencia)");
		if (!$rs)	//Si actualizo BD correctamente
		{	
			echo "Fallo la Actualizacion del Path en radicado < $isqlRadicado >";
		}
 }
 else
 {
 	print("No hay Correo disponible");
 }
}



//$msgMng->manageMail('move', array($eMailMid), 'trash');
?>
