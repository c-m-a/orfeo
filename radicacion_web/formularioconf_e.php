<?php

ini_set("session.use_cookies","1");
ini_set("session.use_only_cookies","1");
ini_set("session.use_trans_sid","1");
ini_set('display_errors', 1);
session_start();

/**
  * Modulo de Formularios Web para atencion a Ciudadanos.
  * @autor Carlos Barrero   carlosabc81@gmail.com SuperSolidaria
  * @fecha 2009/05
  * @Fundacion CorreLibre.org
  * @licencia GNU/GPL V2
  */



foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 2);


$ruta_raiz = "..";
$ADODB_COUNTRECS = false;
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true;


include('./funciones.php');

/*
$EnDecryptText = new EnDecryptText();
$radicado=$EnDecryptText->Decrypt_Text($_GET['r']);
*/

$radicado=$_GET['radicado'];
//busca si radicado existe
$sql_bus_rad="select count(*) as k from radicado where radi_nume_radi=".$radicado;
$rs_bus_rad=$db->conn->Execute($sql_bus_rad);
echo ">".$rs_bus_rad->fields['K']."<";
if($rs_bus_rad->fields['K']==0)
	{

		$handle=fopen('/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/'.$radicado,'r');
		$contents=fread($handle,filesize('/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/'.$radicado));
		fclose($handle);
    echo "<hr>Verificar plano <a href='./radicados/$radicado'> ver Plano si Exstie ??</a>' <hr>";
    echo "$contents";
		// inserta sentencias sql
		$contentsv=split(";",$contents);
    //$db->conn->debug = true;
    
		foreach($contentsv as $row)
			{
       echo "<hr><<<< ".$row.">>>>>";
				if(strlen($row)>0)
					{
            
						$db->conn->Execute($row);
					}
        
			}

		// inserta anexos si existen
		if (file_exists('/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/'.$radicado.'_anexos')) 
			{
				$handle2=fopen('/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/'.$radicado.'_anexos','r');
				$contents2=fread($handle2,filesize('/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/'.$radicado.'_anexos'));
				fclose($handle2);
		// inserta sentencias sql
		$contentsv2=split(";",$contents2);
		foreach($contentsv2 as $row2)
			{
				if(strlen($row2)>0)
					{
						$db->conn->Execute($row2);
					}
			}
				
			}
}


//trae datos para generar el pdf
$sql_datos_radicado="select r.RADI_NUME_RADI,r.radi_fech_radi, r.ra_asun,r.radi_depe_radi, b.sigla_de_la_empresa, b.nit_de_la_empresa,
sc.sgd_ciu_nombre,sc.sgd_ciu_direccion,sc.sgd_ciu_apell1,sc.sgd_ciu_telefono,sc.sgd_ciu_email,sc.sgd_ciu_cedula
from radicado r, bodega_empresas b, sgd_dir_drecciones sd, sgd_ciu_ciudadano sc
where r.eesp_codi= b.identificador_empresa (+) and
sd.sgd_ciu_codigo=sc.sgd_ciu_codigo and
sd.radi_nume_radi=r.radi_nume_radi and
r.radi_nume_radi=".$radicado;

//$db->conn->debug = true;
$rs_datos_radicado=$db->conn->Execute($sql_datos_radicado);
echo "<hr>--->". $rs_datos_radicado->fields['RADI_NUME_RADI'];
$_SESSION['radcom']=$rs_datos_radicado->fields['RADI_NUME_RADI'];
$_SESSION['fecha']=$rs_datos_radicado->fields['RADI_FECH_RADI'];
$_SESSION['sigla']=$rs_datos_radicado->fields['SIGLA_DE_LA_EMPRESA'];
$_SESSION['nit']=trim($rs_datos_radicado->fields['NIT_DE_LA_EMPRESA']);
$_SESSION['asunto']=trim($rs_datos_radicado->fields['RA_ASUN']);
$_SESSION['nombre_remitente']=trim($rs_datos_radicado->fields['SGD_CIU_NOMBRE']);
$_SESSION['apellidos_remitente']=trim($rs_datos_radicado->fields['SGD_CIU_APELL1']);
$_SESSION['cedula']=trim($rs_datos_radicado->fields['SGD_CIU_CEDULA']);
$_SESSION['direccion_remitente']=trim($rs_datos_radicado->fields['SGD_CIU_DIRECCION']);
$_SESSION['telefono_remitente']=trim($rs_datos_radicado->fields['SGD_CIU_TELEFONO']);
$_SESSION['email']=trim($rs_datos_radicado->fields['SGD_CIU_EMAIL']);
$_SESSION['dependencia']=$rs_datos_radicado->fields['RADI_DEPE_RADI'];


//lee de archivo plano descripcion de la queja

$handle2=fopen('/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/'.$radicado.'_desc','r');
$contents2=fread($handle2,filesize('/var/www/orfeo-3.8.0/formularioWeb_ses/radicados/'.$radicado.'_desc'));
fclose($handle2);
$_SESSION['desc']=$contents2;




$mensaje="Su queja fue radicada con exito en el sistema con el n&uacute;mero <font color='red'>".$radicado."</font>, pulse <strong>continuar</strong> para descargar su radicaci&oacute;n en formato PDF.";
/*

	}	
else
	{
		$mensaje="Su queja ya fue radicada en el sistema, si desea radicar una nueva ingrese a nuestra p&aacute;gina Web <a href='http://orfeoweb.supersolidaria.gov.co/orfeo-3.8.0/formularioWeb_ses/'>www.supersolidaria.gov.co</a>";
	}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Confirmaci&oacute;n radicaci&oacute;n quejas - </title>
<link rel="stylesheet" href="css/structure.css" type="text/css" />
</head>

<body>
<p>&nbsp;</p>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
  <tr>
    <td align="center"><br /><img src="../logoEntidad.gif"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>

  <tr>
    	<td align="center"><?= $mensaje ?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
<!--
  <tr>
    <td align="center"><input type="button" name="Submit" value="Continuar" onclick="window.open('formulariopdf.php')" />
</td>
  </tr>
-->
<? if($rs_bus_rad->fields['K']>=0) { ?>
  <tr>
    <td align="center"><input type="button" name="Submit" value="Continuar" onClick="window.location='formulariopdf.php';" />
</td>
  </tr>
  <tr>
    <td align="center">Al finalizar la descarga del documento puede cerrar esta ventana</td>
  </tr>
<? } ?>
<!--
  <tr>
    <td align="center"><br><a href="http://www.supersolidaria.gov.co/">Regresar al inicio</a><br>&nbsp;</td>
  </tr>
-->

  <tr>
    <td align="center"><br><br>&nbsp;</td>
  </tr>

</table>
</body>
</html>
