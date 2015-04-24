<?
$correo='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Documento sin t&iacute;tulo</title>
<style type="text/css">
<!--
body {
	background-image: url(http://www.supersolidaria.gov.co/images/fondo_correo.jpg);
	background-repeat: repeat-y;
}
-->
</style></head>
<html>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><em>Rep&uacute;bica de Colombia </em></td>
  </tr>
  <tr>
    <td colspan="2"><em>Ministerio de hacienda y cr&eacute;dito p&uacute;blico </em></td>
  </tr>
  <tr>
    <td colspan="2"><em><strong><font size="+3">SUPERSOLIDARIA</font></strong></em></td>
  </tr>
  <tr>
    <td colspan="2"><p><em>Superintendencia de la econom&iacute;a solidaria </em></p>    </td>
  </tr>
  <tr>
    <td colspan="2"><strong>Estimado Sr(a) :</strong>'; $correo.=utf8_decode($_POST['nombre']); $correo.='</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Hemos recibido su queja de forma exitosa con la siguiente informaci&oacute;n : </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="18%"><font color="#1F619B"><strong>Fecha:</strong></font> </td>
    <td width="82%">';$correo.=date('d-m-Y');$correo.='</td>
  </tr>
  <tr>
    <td width="18%"><font color="#1F619B"><strong>Direcci&oacute;n:</strong></font> </td>
    <td width="82%">';$correo.=utf8_decode($_POST['direccion']);$correo.='</td>
  </tr>
  <tr>
    <td><font color="#1F619B"><strong>E-mail : </strong></font></td>
    <td>';$correo.=utf8_decode($_POST['mail']);$correo.='</td>
  </tr>
  <tr>
    <td><font color="#1F619B"><strong>Nit / C.C : </strong></font></td>
    <td>';$correo.=utf8_decode($_POST['nit']);$correo.='</td>
  </tr>
  <tr>
    <td><font color="#1F619B"><strong>Queja : </strong></font></td>
    <td>';$correo.=utf8_decode($_POST['comentario']);$correo.='</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">El centro de atenci&oacute;n al usuario (CAU), se comunicar&aacute; con usted lo m&aacute;s pronto posible. </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Cordialmente,</td>
  </tr>
  <tr>
    <td colspan="2"><p>Supersolidaria.gov.co</p>    </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><em>Por unas entidades solidarias confiables</em> </td>
  </tr>
</table>
';
?>
