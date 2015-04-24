<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<body>

<table width="75%" border="0" align="center"  cellspacing="5" class="borde_tab">
  <tr  bordercolor="#FFFFFF">
    <td><table width="100%" border="0">
      <tr bordercolor="#FFFFFF">
        <td colspan="2" class="titulos3">INFORMACION DEL DOCUMENTO CON NUMERO DE RADICADO <span class="select"><!--{$radi}--></span></td>
      </tr>
      <tr  bordercolor="#FFFFFF">
        <td width="50%" valign="top"><table width="100%" border="0" align="center"  cellspacing="5" class="borde_tab">
          <tr  bordercolor="#FFFFFF">
            <td width=40% class="titulos2" height="24">TIPO DOCUMENTO </td>
            <td class="listado2"><!--{$TDOC_CODI}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=40% class="titulos2" height="24">FECHA RADICADO </td>
            <td class="listado2"><!--{$RADI_FECH_RADI}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=40% class="titulos2" height="24">ASUNTO</td>
            <td class="listado2"><!--{$RA_ASUN}--></td>
          </tr>
        </table>
          <br />
          <table width="100%" border="0" align="center"  cellspacing="5" class="borde_tab">
            <tr  bordercolor="#FFFFFF">
              <td width="40%" class="titulos2">REMITENTE</td>
              <td width="60%" class="listado2"><!--{$destina}--></td>
            </tr>
          </table></td>
        <td width="50%"><table width="100%" border="0" align="center"  cellspacing="5" class="borde_tab">
          <tr  bordercolor="#FFFFFF">
            <td width=40% class="titulos2" height="24">DPTO / MUN </td>
            <td class="listado2"><!--{$DEPARTAMENTO}--> / <!--{$MUNICIPIO}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=40% class="titulos2" height="24">DIRECCIÓN</td>
            <td class="listado2"><!--{$direccion}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=40% class="titulos2" height="24">Correo Electronico(E-mail) </td>
            <td class="listado2"><!--{$email}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=40% class="titulos2" height="24">TELEFONO</td>
            <td class="listado2"><!--{$telefono}--></td>
          </tr>

        </table>
          <br />
          <table width="100%" border="0" align="center"  cellspacing="5" class="borde_tab">
            <tr bordercolor="#FFFFFF">
              <td width="162" class="botones_largo">ESTADO ACTUAL </td>
              <td width="255" class="listado2"><!--{$contestado}--><!--{$fechacontestado}--></td>
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<BR><BR><BR>
<table width="75%" border="0" align="center"  cellspacing="5" class="borde_tab">
  <trbordercolor="#FFFFFF">
    <td height="25" align="center" class="titulos2">USUARIO (s) RESPONSABLES ACTUALES </td>
  </tr>
</table>
<table width="75%"  align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab" >
  <tr  bordercolor="#FFFFFF">
    <td width=10% height="24" class="titulos2"><strong> Usuario (s)  </strong></td>
    <td width=10% height="24" class="titulos2"> Dependencia</td>
  </tr>

      <td class="listado2" > &nbsp;&nbsp;<!--{$usua_actu}--></td>
        <td class="listado2" > &nbsp;&nbsp;<!--{$depe_actu}--></td>
    </tr>
</table>
</body>