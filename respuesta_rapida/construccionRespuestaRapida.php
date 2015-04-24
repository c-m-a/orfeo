<html>
    <head>
        <title>Enviando Correo Entidad  --- OrfeoGPL</title>
        <link rel="stylesheet" href="../estilos/orfeo.css">
    </head>
    
<body>
<center><img src='http://volimpo/iconos/tuxTx.gif'></center>
<?php
// envio de respuesta via email
// Obtiene los datos de la respuesta rapida.
$ruta_raiz = "../";
$ruta_libs= $ruta_raiz."respuestaRapida/";
define('ADODB_ASSOC_CASE', 0);
define('SMARTY_DIR', $ruta_libs . 'libs/');
define('FPDF_FONTPATH', $ruta_raiz."fpdf/font/");
require_once("../include/db/ConnectionHandler.php");
require_once($ruta_raiz."_conf/constantes.php");
require_once("dompdf_config.inc.php");
include_once("../class_control/AplIntegrada.php");
include_once(ORFEOPATH . "class_control/anexo.php");
include_once(ORFEOPATH . "class_control/anex_tipo.php");
include_once($ruta_raiz."include/tx/Tx.php");
include_once("../include/tx/Radicacion.php");
include_once("../class_control/Municipio.php");
include_once("../envios/class.phpmailer.php");

set_time_limit(0);
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$verradicado = $_POST["radPadre"]. "\n";

function StrValido($cadena)
{
	$login = strtolower($cadena);
	$b     = array("á","é","í","ó","ú","ä","ë","ï","ö","ü","à","è","ì","ò","ù","ñ",",",".",";",":","¡","!","¿","?",'"',"/","&","\n");
	$c     = array("a","e","i","o","u","a","e","i","o","u","a","e","i","o","u","n","","","","","","","","",'',"","","",);
	$login = str_replace($b,$c,$login);
	return $login;
}

function FechaFormateada($FechaStamp) {
	$ano = date('Y', $FechaStamp); //<-- Año
	$mes = date('m', $FechaStamp); //<-- número de mes (01-31)
	$dia = date('d', $FechaStamp); //<-- Día del mes (1-31)
	$dialetra = date('w', $FechaStamp); //Día de la semana(0-7)
	switch ($dialetra) {
		case 0 :
			$dialetra = "Domingo";
			break;
		case 1 :
			$dialetra = "Lunes";
			break;
		case 2 :
			$dialetra = "Martes";
			break;
		case 3 :
			$dialetra = "Miércoles";
			break;
		case 4 :
			$dialetra = "Jueves";
			break;
		case 5 :
			$dialetra = "Viernes";
			break;
		case 6 :
			$dialetra = "Sábado";
			break;
	}
	switch ($mes) {
		case '01' :
			$mesletra = "Enero";
			break;
		case '02' :
			$mesletra = "Febrero";
			break;
		case '03' :
			$mesletra = "Marzo";
			break;
		case '04' :
			$mesletra = "Abril";
			break;
		case '05' :
			$mesletra = "Mayo";
			break;
		case '06' :
			$mesletra = "Junio";
			break;
		case '07' :
			$mesletra = "Julio";
			break;
		case '08' :
			$mesletra = "Agosto";
			break;
		case '09' :
			$mesletra = "Septiembre";
			break;
		case '10' :
			$mesletra = "Octubre";
			break;
		case '11' :
			$mesletra = "Noviembre";
			break;
		case '12' :
			$mesletra = "Diciembre";
			break;
	}
	return "$dialetra, $dia de $mesletra de $ano";
}

function makeLabel($db, $tdoc) {
	// params to variables
	$sqlE = "SELECT
	      		SGD_PQR_LABEL
			FROM
	    		SGD_PQR_MASTER
			WHERE
				ID = $tdoc";
	return $db->conn->Execute($sqlE);
}

function radi_paht($db, $ruta, $numerad) {
	// params to variables
	$ruta .= ".pdf";
	$sqlE = "UPDATE RADICADO
			SET RADI_PATH = ('$ruta')
			where radi_nume_radi = $numerad";
	return $db->conn->Execute($sqlE);
}

function nom_muni_dpto($muni, $dep, $db) {
	// params to variables
	$sqlE = "
			SELECT
	           a.MUNI_NOMB,
	           b.DPTO_NOMB
				FROM MUNICIPIO a, DEPARTAMENTO b
				WHERE (a.ID_PAIS = 170)
				AND	(a.ID_CONT = 1)
				AND (a.DPTO_CODI = $dep)
				AND (a.MUNI_CODI = $muni)
				AND (a.DPTO_CODI=b.DPTO_CODI)
				AND (a.ID_PAIS=b.ID_PAIS)
				AND (a.ID_CONT=b.ID_CONT)";
	return $db->conn->Execute($sqlE);
}

 $hist = new Historico($db);
 $Tx = new Tx($db);

 $ddate = date("d");
 $mdate = date("m");
 $adate = date("Y");
 $fechproc4 = substr($adate,2,4);

 $fechrd = $ddate.$mdate.$fechproc4;


 $tdoc           = 0;  // tipo documental no definido

 //DATOS A VALIDAR EN RADICADO //
 session_start();
 $coddepe        = $_POST["depecodi"];
 $radi_usua_actu = $_POST["usuacodi"];
 $usua 			 = $_POST["usualog"];
 $codigoCiu		 = $_POST["codigoCiu"];
 $usMailSelect	 = $_POST["usMailSelect"];

 $ent            = '1';
 $tpDepeRad      = $coddepe ;
 $radUsuaDoc     = $codigoCiu;
 
 if ($_SESSION["krd"])
 $krd = $_SESSION["krd"];

//Para crear el numero de radicado se realiza el siguiente procedimiento
 //$newRadicado = date("Y") . $this->dependencia . str_pad($secNew,$this->noDigitosRad,"0", STR_PAD_LEFT) . $tpRad;
 //este se puede ver en el archivo Radicacion.php

 $isql_consec= "select DEPE_RAD_TP$ent as secuencia from DEPENDENCIA WHERE DEPE_CODI = $tpDepeRad";
 $creaNoRad = $db->conn->Execute($isql_consec);
 $tpDepeRad	= $creaNoRad->fields["secuencia"];

 //Email del usuario

 //DATOS EMPRESA
 $sigla   = 'null';
 $iden    = $db->nextId("sec_ciu_ciudadano");// uniqe key ??????????????????????????????
 $email   = $_POST['usMailSelect']; //mail
 $pais    = 170; //OK, codigo pais
 $cont    = 1; //id del continente
 $asu     = $_POST["respuesta"];


 // RADICADO
 $rad = new Radicacion($db);
 $rad->radiTipoDeri  = 0; // ok ????
 $rad->radiCuentai   = 'null';  // ok, Cuenta Interna, Oficio, Referencia
 $rad->eespCodi      = $iden; //codigo emepresa de servicios publicos bodega
 $rad->mrecCodi      = 3; // medio de correspondencia, 3 internet
 $rad->radiFechOfic  = "$ddate/$mdate/$adate"; // igual fecha radicado;
 $rad->radiNumeDeri  = $verradicado; //ok, radicado padre
 $rad->radiPais      = $pais; //OK, codigo pais
 $rad->descAnex      = '.'; //OK anexos
 $rad->raAsun        = "Respuesta al radicado " . $verradicado; // ok asunto
 $rad->radiDepeActu  = $coddepe; // ok dependencia actual responsable
 $rad->radiUsuaActu  = $radi_usua_actu; // ok usuario actual responsable
 $rad->radiDepeRadi  = $coddepe; //ok dependencia que radica
 $rad->usuaCodi      = $radi_usua_actu; // ok usuario actual responsable
 $rad->dependencia   = $coddepe; //ok dependencia que radica
 $rad->trteCodi      =  0; //ok, tipo de codigo de remitente
 $rad->tdocCodi      = $tdoc; //ok, tipo documental
 $rad->tdidCodi      = 0; //ok, ????
 $rad->carpCodi      = 1; //ok, carpeta entradas
 $rad->carPer        = 0; //ok, carpeta personal
 $rad->ra_asun       = "Respuesta al radicado " . $verradicado;
 $rad->radiPath      = 'null';
 $rad->sgd_apli_codi = '0';
 $rad->usuaDoc       = $radUsuaDoc;
 $codTx = 62;

 $nurad = $rad->newRadicado($ent,$tpDepeRad);
 if ($nurad=="-1")
    	echo"<script type='text/javascript'>alert('No se creo radicado de salida');exit();</script>";

 if(!$nurad) echo "<hr>RADICADO GENERADO <HR>$nurad<hr>";
 $nextval          = $db->nextId("sec_dir_direcciones");
 $emailEMisorMensaje = $_POST["destinatario"];
 $isql = "insert into SGD_DIR_DRECCIONES(			SGD_TRD_CODIGO,
                                SGD_DIR_NOMREMDES,
                                SGD_DIR_DOC,
                                DPTO_CODI,
                                MUNI_CODI,
                                id_pais,
                                id_cont,
                                SGD_DOC_FUN,
                                SGD_OEM_CODIGO,
                                SGD_CIU_CODIGO,
                                SGD_ESP_CODI,
                                RADI_NUME_RADI,
                                SGD_SEC_CODIGO,
                                SGD_DIR_DIRECCION,
                                SGD_DIR_TELEFONO,
                                SGD_DIR_MAIL,
                                SGD_DIR_TIPO,
                                SGD_DIR_CODIGO,
                                SGD_DIR_NOMBRE)
                        values( 1,
                                NULL,
                                NULL,
                                11,
                                1,
                                170,
                                1,
                                NULL,
                                NULL,
                                NULL,
                                NULL,
                                $nurad,
                                0,
                                NULL,
                                NULL,
                                '$emailEMisorMensaje',
                                1,
                                $nextval,
                                NULL)";

 $rsg               = $db->conn->Execute($isql);
 $mensajeHistorico  = "Se envia respuesta rapida";
 $adjuntos          = $_SESSION["archivosAdjuntos"];

 if($adjuntos != null){
    $mensajeHistorico .= ", con archivos adjuntos";
 }
$numRadicadoPadre = $verradicado;
 //inserta el evento del radicado padre.
 $radicadosSel[0] = $numRadicadoPadre;
 $hist->insertarHistorico($radicadosSel,
                          $coddepe,
                          $radi_usua_actu,
                          $coddepe,
                          $radi_usua_actu,
                          $mensajeHistorico,
                          $codTx);
 //Inserta el evento del radicado de respuesta nuevo.
 $radicadosSel[0] = $nurad;
 $hist->insertarHistorico($radicadosSel,
                          $coddepe,
                          $radi_usua_actu,
                          $coddepe,
                          $radi_usua_actu,
                          "",
                          2);

 //Agregar un nuevo evento en el historico para que
 //muestre como contestado y no genere alarmas.
 //A la respuesta se le agrega el siguiente evento
 $hist->insertarHistorico($radicadosSel,
                          $coddepe,
                          $radi_usua_actu,
                          $coddepe,
                          $radi_usua_actu,
                          "Imagen asociada desde respuesta rapida",
                          42);

$Radicado    = $nurad;
$correo      = $email;
$numradicado = $Radicado;
$fecha1      = time();
$fecha       = FechaFormateada($fecha1);
$lugar       = "Bogota DC";
//variables para generar el pdf con l no olvidar \n para dividir filas
$pie         = "Calle 26 # 13 - 19 Bogotá, D.C., Colombia     PBX 381 5000     www.dnp.gov.co";
$mensaje     = "Atentamente";

if(trim($_POST["destinatario"])){
    $emailSend = split(";",$_POST["destinatario"]);
    $enviadoA = "";
    foreach($emailSend as $mailDir){
        if(Trim($mailDir)) $enviadoA .= ">".$mailDir. "\n";
    }
}

$conCopiaA ="";

if(trim($_POST["concopia"])){
    $emailSend = split(";",$_POST["concopia"]);
    foreach($emailSend as $mailDir){
        if(Trim($mailDir)) $conCopiaA .="CC>".$mailDir."\n";
    }
}

$receptor="Respuesta Web \nCorreo electronico: $correo \n \nDestinatarios: \n". $enviadoA . $conCopiaA;

#($pie, $numRadicadoPadre, $numradicado, $fecha, $lugar, $asu, $mensaje, $receptor);

//Construye las opciones necesario para el anexo del radicado.
//El archivo se guarda en la ruta que origina el radicado padre
//este campo se adjunta en el radipath
$primerno    = substr($numRadicadoPadre, 0, 4);
$segundono   = substr($numRadicadoPadre, 4, 3);
$rutaArchivo = "/" . $primerno . "/" . $segundono . "/docs/" .$enlace;
$adjuntos[count($adjuntos)]=$rutaArchivo;

?>
<center>
<TABLE class=borde_tab width="90%">
    <tr>
        <td class=titulos2>
<?
echo "<b>Radicado  pdf Enviado $rutaArchivo </b><br>";
//Se crea pdf
$radicado_rem = 7;

$radi         = $Radicado;
$sqlFechaHoy  = $db->conn->OffsetDate(0, $db->conn->sysTimeStamp);
$anex         = & new Anexo($db);
$anexTip      = & new Anex_tipo($db);

$radicado_rem = 1;
$auxnumero    = $anex->obtenerMaximoNumeroAnexo($radi);

do {
    $auxnumero += 1;
    $codigo = trim($numRadicadoPadre) . trim(str_pad($auxnumero, 5, "0", STR_PAD_LEFT));
}while ($anex->existeAnexo($codigo));

$anexTip->anex_tipo_codigo(7);

$ext         = 'pdf';
$auxnumero   = str_pad($auxnumero, 5, "0", STR_PAD_LEFT);
$tipo        = 7;  #pdf
$tamano      = 1000;
$auxsololect = 'N';
$descr       = 'Pdf respuesta';

$isql = "insert into anexos (SGD_REM_DESTINO,
                            ANEX_RADI_NUME,
                            ANEX_CODIGO,
                            ANEX_ESTADO,
                            ANEX_TIPO,
                            ANEX_TAMANO,
                            ANEX_SOLO_LECT,
                            ANEX_CREADOR,
                            ANEX_DESC,
                            ANEX_NUMERO,
                            ANEX_NOMB_ARCHIVO,
                            ANEX_BORRADO,
                            ANEX_SALIDA,
                            SGD_DIR_TIPO,
                            ANEX_DEPE_CREADOR,
                            SGD_TPR_CODIGO,
                            ANEX_FECH_ANEX,
                            SGD_APLI_CODI,
                            SGD_TRAD_CODIGO,
                            RADI_NUME_SALIDA,
                            SGD_EXP_NUMERO,
                            ANEX_ESTADO_EMAIL)
                    values ($radicado_rem,
                            $numRadicadoPadre,
                            '$codigo',
                            2,
                            $tipo,
                            $tamano,
                            '$auxsololect',
                            '$usua',
                            '$descr',
                            $auxnumero,
                            '$enlace',
                            'N',
                            1,
                            $radicado_rem,
                            $coddepe,
                            NULL,
                            $sqlFechaHoy,
                            NULL,
                            1,
                            $Radicado,
                            NULL,1)";

$bien = $db->conn->Execute($isql);
// Si actualizo BD correctamente
if ($bien) {
	echo "</br></br> anexado ok </br>";
} else {
	echo "</br></br> anexado ERROR </br>";
}

$strServer="172.16.1.92:25";

//Envio de correo
$resultadoEnvio = enviarCorreo($Radicado,$usMailSelect,"Respuesta_Web",$_POST["usuanomb"],$_POST["destinatario"],$strServer,$adjuntos,"",$asu,$_POST["concopia"],$numRadicadoPadre,$rutaArchivo,$db);

//Funcion que realiza el envio de correo.
function enviarCorreo($verradicado2, $correo, $usuario, $Nomb_usua, $Email_usua, $servidorSmtp, $adjuntos, $ext, $respuesta, $correocopia, $nurad, $rutaArchivo, $db) {
$mail = new PHPMailer();
$cuerpo = "<br>El Departamento Nacional de Planeacion
                <br> ha dado respuesta a su solicitud No. " . $nurad . " mediante el oficio No." . $verradicado2 . ", la cual tambien puede ser consultada en el portal Web del DNP.</p>
                 <br><br><b><center>Si no puede visualizar bien el correo, o no llegaron bien los Adjuntos, puede Consultarlos en :
                 <a href='http://orfeo.dnp.gov.co/pqr/consulta.php?rad=$nurad'>http://orfeo.dnp.gov.co/pqr/consulta.php</a><br><br><br>".htmlspecialchars($respuesta)."</b></center><BR>
                 ";
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);                 
$iSqlRadPadre = "Select RADI_PATH from radicado where radi_nume_radi=$nurad";

$rsPath = $db->conn->Execute($iSqlRadPadre);
$pathPadre = $rsPath->fields["RADI_PATH"];
$mail->Mailer = "smtp";
$mail->From = $correo;
$mail->FromName = $usuario;
$mail->Host = $servidorSmtp;
$mail->Mailer = "smtp";
$mail->SMTPAuth = "true";
$mail->Subject = "Respuesta al radicado " . $nurad . " Departamento Nacional de Planeacion";
$mail->AltBody = "Para ver el mensaje, por favor use un visor de E-mail compatible!";
$mail->Body = $cuerpo;
$mail->IsHTML(true);
$mail->SMTPDebug  = 0;	// enables SMTP debug information (for testing)
						// 1 = errors and messages                       
						// 2 = messages only 

if(trim($Email_usua)){
 $emailSend = split(";",$Email_usua);
 $enviadoA = "";
 foreach($emailSend as $mailDir){
  if($mailDir) $mail->AddAddress(trim($mailDir));
  echo ">".$mailDir . " <br> ";
  $enviadoA .= ">".$mailDir. " <br> ";
 }
}
$conCopiaA ="";
if(trim($correocopia)){
 $emailSend = split(";",$correocopia);
 foreach($emailSend as $mailDir){
  if($mailDir) $mail->AddCC(trim($mailDir));
  echo "CC> ".$mailDir . " <br> ";
  $conCopiaA .="CC>".$mailDir."<br>";
 }
}
$conCopiaOcultaA= "";
if(trim($_POST["concopiaOculta"])){
 $emailSend = split(";",$_POST["concopiaOculta"]);
 foreach($emailSend as $mailDir){
  if($mailDir) $mail->AddBCC(trim($mailDir));
  echo "BCC> ".$mailDir . " <br> ";
  $conCopiaOcultaA .= $mailDir;
 }
}
$mail->AddReplyTo($correo, $usuario);
$posExt = stripos($pathPadre,".");
$docRecibido = "Documento Recibido".substr($pathPadre,$posExt,strlen($pathPadre));
//$docRecibido = str_replace("/".$nurad,"DocRecibido", $pathP);

$mail->AddAttachment("../bodega/".$pathPadre, $docRecibido);
$mail->AddAttachment("../bodega/".$rutaArchivo, "Respuesta".$verradicado2.".pdf");

     //$anex = new Anexo($db);
if ($adjuntos != NULL){
	$i=0;
        $usua 			 = $_POST["usualog"];
        $anexo = new Anexo($db);
	while($i < count($adjuntos)){
				if($i<(count($adjuntos)-1))
                {		
                        $anexoAno = date('Y');
                		$mail->AddAttachment("../bodega/tmp/".$adjuntos[$i], $adjuntos[$i]);
                        $anexo->anex_radi_nume =  $nurad;
                        $anexo->usuaCodi = 1;
                        $anexo->depe_codi = coddepe;
                        $anexo->anex_solo_lect = "'S'";
                        $anexo->anex_tamano = "0";
                        $anexo->anex_creador = "'".$usua."'";
                        $anexo->anex_desc = "Adjunto: ". str_replace($adjuntos[$i], "", $adjuntos[$i]);
                        $anexo->anex_nomb_archivo = $adjuntos[$i];
                        $auxnumero = $anexo->obtenerMaximoNumeroAnexo($nurad);
                        $anexoCodigo = $anexo->anexarFilaRadicado($auxnumero);
                        $file = $adjuntos[$i];
						$destin = "../bodega/tmp/".$file;
                        $newfile = "../bodega". $anexo->anexoRutaArchivo;
                        if (!copy($destin, $newfile)) {
                        	echo "<font color=RED><B>No se Pudo Copiar el archivo < $file > ...</B></FONT><br>";
						}
                }
		$i++;
	}
}


if (!$mail->Send()) {
	echo "<BR><BR><CENTER><font color=RED><B>Error enviando correo: " . $mail->ErrorInfo . "<br>Destinatario: " . $Email_usua . "</B></FONT></CENTER><br>";
		//return false;
                $envioOk = "No";
	}else{

	$mail->ClearAddresses();
	$mail->ClearAttachments();
        $envioOk = "Si";
        $sql_sgd_renv_codigo = "select SGD_RENV_CODIGO FROM SGD_RENV_REGENVIO ORDER BY SGD_RENV_CODIGO DESC ";
        $rsRegenvio = $db->conn->SelectLimit($sql_sgd_renv_codigo,2);
        $nextval = $rsRegenvio->fields["SGD_RENV_CODIGO"];
        $nextval++;
        //$db->conn->debug= true;
        $fechaActual = $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
        $destinatarios = "Destino:".$_POST["destinatario"]." Copia:".$_POST["concopia"];
        $dependencia = $_POST["depecodi"];
        $iSqlEnvio = "INSERT INTO SGD_RENV_REGENVIO(SGD_RENV_CODIGO
           ,SGD_FENV_CODIGO,SGD_RENV_FECH,RADI_NUME_SAL,SGD_RENV_DESTINO,SGD_RENV_MAIL
           ,SGD_RENV_PESO,SGD_RENV_VALOR,SGD_RENV_ESTADO,USUA_DOC,SGD_RENV_NOMBRE
           ,SGD_RENV_PLANILLA,SGD_RENV_FECH_SAL,DEPE_CODI,SGD_DIR_TIPO,RADI_NUME_GRUPO,SGD_RENV_DIR
           ,SGD_RENV_CANTIDAD,SGD_RENV_TIPO,SGD_RENV_OBSERVA
           ,SGD_RENV_GRUPO,SGD_RENV_VALORTOTAL,SGD_RENV_VALISTAMIENTO,SGD_RENV_VDESCUENTO,SGD_RENV_VADICIONAL,SGD_DEPE_GENERA,SGD_RENV_PAIS,SGD_RENV_NUMGUIA)
     VALUES ($nextval ,106 ,$fechaActual
           ,$verradicado2,'$destinatarios'
           ,'$destinatarios','0','0',1,".$_SESSION["usua_doc"]."
           ,'".$_POST["destinatario"]."', '0' ,$fechaActual
           ,".$dependencia.", 1,$verradicado2 ,'$destinatarios'
           ,1 ,1 ,'Envio Respuesta Rapida a Correo Electronico'
           ,$verradicado2 ,'0','0','0','0'
           ,$dependencia
           ,'Colombia'
           ,'0')"; 
           
        $rsRegenvio = $db->conn->query($iSqlEnvio);
	return $envioOk;
        
        }
}

if ($adjuntos != NULL){
	$i=0;
        echo "<br><b>Adjuntos Enviados!".$verradicado2."</b><br>"; 
	while($i < count($adjuntos)){
		IF(unlink($adjuntos[$i])) ECHO "".$adjuntos[$i]."<br>";
		$i++;
	}
}

                                  


?>
    </td>
</tr>
<tr>
	<td align="center">
<?
	$isqlDepR = "SELECT RADI_DEPE_ACTU,
                        RADI_USUA_ACTU
                    FROM RADICADO
                    WHERE RADI_NUME_RADI = '$nurad'";
    $rsDepR = $db->conn->Execute($isqlDepR);

    if ($rsDepR === false) {
        echo "Error de Consulta";
        echo $db->conn->ErrorMsg();
        exit(1);
    }

    $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
    $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
    $ind_ProcAnex="N";
	
	$tsub = 0;
	$codserie = 0;
	
?>

<iframe src="../radicacion/tipificar_documento.php?nurad=<? echo $nurad;?>&dependencia=<? echo $coddepe;?>&krd=<? echo $krd;?>" width=100% height=400></iframe>
<form><p>
<input type="button" value="Salir" class="botones" onclick="window.close();">
</p>
</form>

	</td>
</tr>

</table>
</center>
    <?
unset($_SESSION["archivosAdjuntos"]);
if($resultadoEnvio=="Si")
{
    unset($_SESSION["archivosAdjuntos"]);
    echo "<script>
    alert('Se ha recibido la solicitud de Envio Correctamente. Si hay algun problema en el envio, el servidor de correo le informar  posteriormente.')
    </script>";
}
?>

</body>
</html>
