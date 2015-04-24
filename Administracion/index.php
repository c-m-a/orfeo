<?php
  session_start();
  /**
    * Se adicion compatibilidad con variables globales en Off
    * @autor Jairo Losada 2009-05
    * @modificado por Cmauricio Parra
    * @licencia GNU/GPL V 3
    */

  foreach($_GET as $k=>$v) $$k=$v;

  $krd          = $_SESSION["krd"];
  $dependencia  = $_SESSION["dependencia"];
  $usua_doc     = $_SESSION["usua_doc"];
  $codusuario   = $_SESSION["codusuario"];
  $tip3Nombre   = $_SESSION["tip3Nombre"];
  $tip3desc     = $_SESSION["tip3desc"];
  $tip3img      = $_SESSION["tip3img"];
  $ruta_raiz    = '..';

  $nomcarpeta   = (isset($_GET['carpeta']))? $_GET['carpeta'] : null;
  $tipo_carpt   = (isset($_GET['tipo_carpt']))? $_GET['tipo_carpt'] : null;
  $adodb_next_page = (isset($_GET['adodb_next_page']))? $_GET['adodb_next_page'] : null;

  if($_SESSION['usua_admin_sistema'] != 1)
    die(include "$ruta_raiz/sinacceso.php");

  if($krd!='AVALBUENA' AND $krd!='JZORA'){
?>
<html>
<head>
<title>Modulo Administraci&oacute;n</title>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body>
<table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr bordercolor="#FFFFFF">
	<td colspan="2" class="titulos4"><div align="center"><strong>M&Oacute;DULO DE ADMINISTRACI&Oacute;N</strong></div></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%">
		<a href='usuario/mnuUsuarios.php?krd=<?=$krd?>' target='mainFrame' class="vinculos">
      1. USUARIOS Y PERFILES
    </a>
	</td>
	<td align="center" class="listado2" width="48%">
    <a href="tbasicas/adm_dependencias.php" class="vinculos" target="mainFrame">2. DEPENDENCIAS</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"> <a  href="tbasicas/adm_nohabiles.php" class="vinculos" target='mainFrame'>3. DIAS NO HABILES</a></td>
	<td align="center" class="listado2" width="48%"><a href="../bdcompleme/tar_env.php" class="vinculos" target='mainFrame'>4. ENV&Iacute;O DE CORRESPONDENCIA</a> </td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_tsencillas.php" class="vinculos" target='mainFrame'>5. TABLAS SENCILLAS</a></td>
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_trad.php?krd=<?=$krd?>" class="vinculos" target='mainFrame'>6. TIPOS DE RADICACI&Oacute;N</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_paises.php" class="vinculos" target='mainFrame'>7. PA&Iacute;SES</a></td>
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_dptos.php" class="vinculos" target='mainFrame'>8. DEPARTAMENTOS</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_mcpios.php" class="vinculos" target='mainFrame'>9. MUNICIPIOS</a></td>
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_tarifas.php" class="vinculos" target='mainFrame'>10. TARIFAS</a></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_contactos.php" class="vinculos" target='mainFrame'>11. CONTACTOS</a></td>
	<td align="center" class="listado2" width="48%"><a href="tbasicas/adm_esp.php?krd=<?=$krd?>" class="vinculos" target='mainFrame'>12. ENTIDADES</a></td>
</tr>
</table>
<br>
<table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr bordercolor="#FFFFFF">
	<td colspan="2" class="titulos4"><div align="center"><strong>M&Oacute;DULO DE AUDITORIA</strong></div></td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="48%">
    <center>
      <a href='auditoria/?krd=<?=$krd?>' target='mainFrame' class="vinculos">
        ENTRAR
      </a>
    </center>
	</td>
</tr>
</table>
<br>
<?php
//tbasicas/adm_fenvios.php
 // MODULO OPCIONAL DE ADMINISTRACION DE FUNCIONARIOS Y ENTIDADES
 /* Por SuperSolidaria
    Modifico y Adapto Jairo Losada 08/2009 */

  $enlace_empresas = 'entidad/listaempresas.php?' .
                      session_name() . '=' . session_id() .
                      '&krd=' . $krd;

  $enlace_funcionarios = 'usuario/listafuncionarios.php?' . 
                          session_name() . '=' . session_id();

  $enlace_esp = 'tbasicas/adm_esp.php?' .
                  'krd=' . $krd ;
}
?>
<table width="71%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
<tr bordercolor="#FFFFFF">
	<td colspan="3" class="titulos4" align="center">
          Opcional x SES
        </td>
</tr>
<tr bordercolor="#FFFFFF">
	<td align="center" class="listado2" width="38%">
		<a href="<?$enlace_empresas?>" target="mainFrame" class="vinculos">12. ENTIDADES  V.SES</a>
	</td>
	<td align="center" class="listado2" width="38%">
	<a href="<?=$enlace_funcionarios?>" target='mainFrame'  class="vinculos">12.1 FUNCIONARIO - ENTIDAD</a>
</td>
<td align="center" class="listado2" width="38%">
  <a href="<?=$enlace_esp?>" class="vinculos" target='mainFrame'>12. ENTIDADES</a></td>
</tr>
</table>
</body>
</html>
