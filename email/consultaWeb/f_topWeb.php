<?
error_reporting(0);
session_start();
$fechah = date("Ymdhms");
?><html>
<head>
<script language="JavaScript" type="text/JavaScript">
function cerrar_session() {
	if (confirm('¿Esta seguro de Cerrar Sesion ?'))
	{
		fecha = <?=date("Ymdhms") ?>;
		<?
		$fechah = date("Ymdhms");
		?>
		nombreventana="ventanaBorrar"+fecha;
		url="logRadicado.php?adios=chao";
		document.form_cerrar.submit();
	}
}

function cambContrasena() {
		url = 'logRadicado.php?<?=session_name()."=".session_id()."&fechah=$fechah&krd=$krd"?>'; 	
		document.form_cerrar.action=url;
		document.form_cerrar.submit();
	
}



</script>
</head>
<body topmargin="0" leftmargin="0" bgcolor="#FFFFFF" >
<form name=form_cerrar action=logRadicado.php?<?=session_name()."=".session_id()."&fechah=$fechah&krd=$krd"?> method=post>
</form>
<center>
<table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" background="../imagenes/fondo.gif">
  <tr>
    <td width="16%" height="40"><img name="intra1_r1_c1" src="../imagenes/logoOrfeo.gif" width="259" height="55" border="0"></td>
    <td width="84%" align="right" height="40">
      <table border="0" cellpadding="0" cellspacing="0" width="50">
        <tr valign="top">
          <td colspan="5"><img name="titulosistema" src="../imagenes/titulosistema.gif" width="501" height="19" border="0"></td>
        </tr>
        <tr valign="top">
					<td><a href='http://www.superservicios.gov.co/documentos/vi_cnspd/guia_usuario_v2.doc' target="Ayuda_Orfeo"><img name="info" src="../imagenes/ayuda.gif" width="88" height="24" border="0" target="Guia del Usuario" title="GUIA DEL USUARIO" ALT='GUIA DEL USUARIO'></a></td>
          <td><a href='#' onClick="cerrar_session();"><img name="sesion" src="../imagenes/sesion.gif" width="86" height="24" border="0"></a></td>
        <!-- login.php?<?=date("ymdhms")?>&PHPSESID=<?=date("ymdhms")?> cerrar_session.php?&fecha=<?=date("ymdms")?>-->
                </tr>
        <tr valign="top">
          <td colspan="5"><img name="pie" src="../imagenes/pie.gif" width="501" height="12" border="0"></td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</center>
</body></html>
