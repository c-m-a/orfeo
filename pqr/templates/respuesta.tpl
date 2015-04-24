<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="../estilos/orfeo.css">
<script type="text/javascript">
function funlinkArchivo(numrad,rutaRaiz){
  nombreventana="linkVistArch";
  url=rutaRaiz + "/linkArchivo.php?"+"&numrad="+numrad;
  ventana = window.open(url,nombreventana,'height=50,width=250');
  return;
}
</script>
</head>
<body>

<table width="530" border="0" align="center"  cellspacing="1" class="borde_tab">
  <tr  bordercolor="#FFFFFF">
    <td><table width="100%" border="0" cellspacing=1>
      <tr bordercolor="#FFFFFF">
        <td colspan="2" class="titulos3">INFORMACION DEL DOCUMENTO CON NUMERO DE RADICADO  <!--{$radi}--></span>
        	<span class="select">
                <br><a href=# onclick="funlinkArchivo(<!--{$radi}-->,'..',0);">  
                 (Ver Documento)</a></span></td>
      </tr>
      <tr  bordercolor="#FFFFFF">
        <td width="50%" valign="top"><table width="100%" border="0" align="center"  cellspacing="1" class="borde_tab">
          <tr  bordercolor="#FFFFFF">
            <td width=20% class="titulos2" height="24">TIPO DOCUMENTO </td>
            <td class="listado2"><!--{$TDOC_CODI}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=20% class="titulos2" height="24">FECHA RADICADO </td>
            <td class="listado2"><!--{$RADI_FECH_RADI}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=20% class="titulos2" height="24">ASUNTO</td>
            <td class="listado2"><!--{$RA_ASUN}--></td>
          </tr>
        </table>
          <br />
          <table width="100%" border="0" align="center"  cellspacing="1" class="borde_tab">
            <tr  bordercolor="#FFFFFF">
              <td width="20%" class="titulos2">REMITENTE</td>
              <td width="80%" class="listado2"><!--{$destina}--></td>
            </tr>
          </table></td>
        <td width="50%"><table width="100%" border="0" align="center"  cellspacing="1" class="borde_tab">
          <tr  bordercolor="#FFFFFF">
            <td width=20% class="titulos2" height="24">DPTO / MUN </td>
            <td class="listado2"><!--{$DEPARTAMENTO}--> / <!--{$MUNICIPIO}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=20% class="titulos2" height="24">DIRECCIÓN</td>
            <td class="listado2"><!--{$direccion}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=20% class="titulos2" height="24">Correo Electronico(E-mail) </td>
            <td class="listado2"><!--{$email}--></td>
          </tr>
          <tr  bordercolor="#FFFFFF">
            <td width=20% class="titulos2" height="24">TELEFONO</td>
            <td class="listado2"><!--{$telefono}--></td>
          </tr>
            <tr bordercolor="#FFFFFF">
              <td width="162" class="botones_largo">ESTADO ACTUAL </td>
              <td width="255" class="listado2">
              <!--{$contestado}-->
               - 
              <!--{$fechacontestado}--></td>
              
            </tr>
          </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table class="borde_tab" width="530" align=center cellspacing=1>
    <tr>
    <td width="30%" class="titulos2" colspan=8 align=center >DOCUMENTOS GENERADOS</td>
  </tr>

  <tr>
    <td width="30%" class="titulos2">Documento</td>
    <td width="30%" class="titulos2">Fecha Generado</td>
    <td width="162" class="titulos2">Numero Respuesta </td>
  </tr>
    <tr>
    <!--{section name=numloop loop=$elementos}-->
      <td width="1" class="listado2">
       <img src='<!--{$elementos[numloop][6]}-->' border=0 width=30>
       <!--{$elementos[numloop][5]}--><a href=# onclick="funlinkArchivo('<!--{$elementos[numloop][2]}-->','..',0);">  
       (Ver Documento)</a>
       </td>
       <td width="25%" class="listado2"><!--{$elementos[numloop][4]}--></td>
       <td width="25%" class="listado2"><!--{$elementos[numloop][7]}--></td>
       <!--{if not $smarty.section.numloop.last}-->
      </tr>
      <!--{/if}-->
    <!--{/section}-->
</table>
<table width="530"  align="center" border="0" cellpadding="0" cellspacing="1" class="borde_tab" >
  <tr  bordercolor="#FFFFFF">
    <td width=30% height="24" class="titulos2"> Dependencia actual </td>
    <td class="listado2" > &nbsp;&nbsp;<!--{$depe_actu}--></td>
  </tr>
  </tr>
</table>
</body>