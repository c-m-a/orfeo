<?php
  /**
   * @autor Jairo Losada 2009-05
   * @licencia GNU/GPL V 3
   */
  
  foreach ($_GET as $key => $valor)
    ${$key} = $valor;
  foreach ($_POST as $key => $valor)
    ${$key} = $valor;
  
  define('ADODB_ASSOC_CASE', 1);
  session_start();
  include('./config.php');
  include(SMARTY_TEMPLATE);
  include ('./include/db/ConnectionHandler.php');
  
  $ruta_raiz = '.';
  $db = new ConnectionHandler($ruta_raiz);
  $krd = $_SESSION['krd'];

  if (empty($krd))
    exit('Error su sesion ha caducado!! Por favor vuelva a loguearse');
?>
<html>
  <head>
    <title>Cambio de Contrase&ntilde;as</title>
    <link rel="stylesheet" href="estilos/orfeo.css">
  </head>
<?php
  $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
  $numeroa = 0;
  $numero  = 0;
  $numeros = 0;
  $numerot = 0;
  $numerop = 0;
  $numeroh = 0;
  $krd     = strtoupper($krd);
  $isql    = "select a.*,
                      b.depe_nomb
              from usuario a,
                  dependencia b
              where USUA_LOGIN ='$krd' and
                    a.depe_codi = b.depe_codi";
  $rs      = $db->conn->query($isql);

  echo "<font size=1 face=verdana>";
  $contraxx = $rs->fields["USUA_PASW"];
  
  if (trim($rs->fields["USUA_LOGIN"]) == $krd) {
    $dependencia     = $rs->fields["DEPE_CODI"];
    $dependencianomb = $rs->fields["DEPE_NOMB"];
    $codusuario      = $rs->fields["USUA_CODI"];
    $contraxx        = $rs->fields["USUA_PASW"];
    $nivel           = $rs->fields["CODI_NIVEL"];
    $iusuario        = " and us_usuario='$krd'";
    $perrad          = $rs->fields["PERM_RADI"];
    $depsel          = $dependencia;
?>
	<body bgcolor="#207385">
	<center>
	<IMG src='<?= $ruta_raiz ?>/imagenes/logo2.gif'>
	<form action='usuarionuevo.php?<?= session_name() . "=" . session_id() ?>&krd=<?= $krd ?>' method=post onSubmit="MM_validateForm('contradrd','','R','contraver','','R');return document.MM_returnValue">
	<?php
    echo "<center><B><FONT color=white face='Verdana, Arial, Helvetica, sans-serif' SIZE=4 >CAMBIO DE CONTRASE&Ntilde;A USUARIOS
	 </font> </CENTER>\n";
    echo "<P><P><center><FONT face='Verdana, Arial, Helvetica, sans-serif' SIZE=3 color=white >Por favor introduzca la nueva contrase&ntilde;a</font><p></p>\n";
    echo "<table border=0 class='borde_tab'>\n";
    echo "<tr ><td class='titulos2'>\n";
    echo "<CENTER><input type=hidden name='usuarionew' value=$krd><B>USUARIO </td>
	 <td class=listado2>$krd</td></tr>\n";
    echo "<td class=titulos2><center>CONTRASE&Ntilde;A </td>
	 <td class=listado2 ><input type=password name=contradrd vale='' class=tex_area><br></td>\n";
    echo "</tr>";
    echo "<tr ><td class=titulos2><center>RE-ESCRIBA LA CONTRASE&Ntilde;A </td>
	 <td class=listado2><input type=password name=contraver class=tex_area vale=''></td>\n";
    echo "</tr>";
    echo "</table></p></p>\n";
    echo "";
    echo "";
    echo "<center>\n";
    $isql    = "SELECT depe_codi,
                        depe_nomb
                  FROM DEPENDENCIA
                  ORDER BY DEPE_NOMB";
    $rs      = $db->conn->query($isql);
    $numerot = $rs->RecordCount();
    echo "<br><input type='submit' value='Aceptar' class='botones'>\n";
    echo "<br><input type='hidden' value='$depsel' name='depsel'>\n";
?>
	 </form>
<?php
  } else {
    echo "<b>No esta Autorizado para entrar </b>";
  }
?>
</body>
</html>
