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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Estimado Sr(a) :</strong>'; $correo.=$rs_q->fields['nombre'];$correo.='</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">En atenci&oacute;n a  su queja con fecha '; $correo.=$rs_q->fields['fechacreacion']; $correo.=' con la siguente informaci&oacute;n: </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="18%"><font color="#1F619B"><strong>Direcci&oacute;n:</strong></font> </td>
    <td width="82%">';$correo.=$rs_q->fields['direccion'];$correo.='</td>
  </tr>
  <tr>
    <td><font color="#1F619B"><strong>E-mail : </strong></font></td>
    <td>';$correo.=$rs_q->fields['email'];$correo.='</td>
  </tr>
  <tr>
    <td><font color="#1F619B"><strong>Nit / C.C : </strong></font></td>
    <td>';$correo.=$rs_q->fields['nitentidad'];$correo.='</td>
  </tr>
  <tr>
    <td><font color="#1F619B"><strong>Queja : </strong></font></td>
    <td>';$correo.=$rs_q->fields['comentario'];$correo.='</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Nos permitimos comunicarle : </td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>';$correo.=$_POST['respuesta'];$correo.='</strong></td>
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
</body>
</html>';
