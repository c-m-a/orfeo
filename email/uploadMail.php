<?
session_start();
error_reporting(7);
$ruta_raiz = "..";
//if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
define('ADODB_ASSOC_CASE', 1); 
include_once "../include/db/ConnectionHandler.php";
$tipoMed = $_SESSION['tipoMedio'];
$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug =true;
//$sqlFechaHoy=$db->conn->query("select * from usuario");
$tmpNameEmail = $_SESSION['tmpNameEmail']; 
?>
<html>
<head>
<title>:: Confirmacion de Carga de Correo Al radicado ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos_totales.css">
</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
<?
 
  $krd = $_SESSION['krd'];
  $dependencia = $_SESSION['dependencia'];
 // echo "<hr>$dependencia<hr>";
  $var_envio=session_name()."=".trim(session_id())."&faxPath=$faxPath&leido=no&krd=$krd&ent=$ent&carp_per=$carp_per&carp_codi=$carp_codi&nurad=$nurad&depende=$depende&radi_usua_actu=radi_usua_actu";
 //echo $tmpNameEmail;
if (strlen($nurad)==14) $consecutivo =6; else  $consecutivo =5; 
$x1=substr($nurad,0,4);
$x2=substr($nurad,4,3);
$x3=substr($nurad,7,$consecutivo);
$x4=substr($nurad,-1);
?> 
<form action="uploadMail.php?nurad=<?=$nurad?>&faxPath=<?=$faxPath?>&faxRemitente=<?=$faxRemitente?>&<?=$var_envio?>" method="POST">
<table width="100%" border="0" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" height="50%" class="t_bordeGris">
  <tr>
    <td valign="middle" align="center">      <div align="center">
        <table width="98%" border="0" cellspacing="0" cellpadding="0">
          <tr> 
            <td width="52%" align="center"><br>
	      <?
		 include "grabarArchivos.php";
		?>
              <img src="../imagenes/uploadFax.jpg" w><br>
            <font face="Arial, Helvetica, sans-serif" size="5" color="#003366">
		

						<font face="Arial, Helvetica, sans-serif" size="2" color="#003366">
		Documento asociado, si se genero algun problema presione aceptar.</font>						
						</td>
          </tr>
        </table>
        <input type="submit" name="uploadFax" value="ACEPTAR" onClick="datos_generales()" class="ebuttons2">
				
    </td>
  </tr>
</table>
</form>
<?
  $destinatario = $remitente;
//para el envío en formato HTML
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

//dirección del remitente
$headers .= "From: ". $_SESSION['pagina_web']."\r\n";

//dirección de respuesta, si queremos que sea distinta que la del remitente
$headers .= "Reply-To: sspd@superservicios.gov.co\r\n";

//ruta del mensaje desde origen a destino
$headers .= "Return-path: sspd@superservicios.gov.co\r\n";

  $motivo = "Mensaje y/o Documento Recibido. Rad. No $nurad";
  $texto = "Su mensaje ha sido recibido y se radico en la ".$_SESSION['entidad_largo'].
	 "con numero de radicacion $nurad.
	Acontinuacion encontrara documento recibido, consulte su tramite accediento a la pagina
	<a href='".$_SESSION['pagina_web']."'>".$_SESSION['pagina_web']."</a><br>
	$archivoRadicado 
	<br><hr>
	".$_SESSION['entidad_largo']."<br>
	 ".$_SESSION['pagina_web']."<br>
	 <br>
	<TABLE BORDER=0 width=100%>
	<TR><TD ALIGN=RIGHT>
	 <FONT SIZE=1>Sistema de Gestion <a href='http://www.orfeogpl.org'>OrfeoGpl.org</a></FONT>
	</TD></TR></TABLE>
	";
  $envioMail = mail("$destinatario",$motivo, $texto,$headers);
  echo "<hr>";
  if(!$envioMail)
  {
  echo "fallo el Envio de Correo respuesta $destinatario ->".$envioMail;
  }else{
  echo "Se envio el Correo a $destinatario ->".$envioMail;
}
?>
</body>
<center />
<form method=post action=deleteMail.php?PHPSESSID=<?=$PHPSESSID?>>
	<input type=submit value='Borrar este Correo' name=deleteMail>
</form>
</center>
</html>
