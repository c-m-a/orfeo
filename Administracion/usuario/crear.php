<?php
  session_start();
  include ('../../config.php');
  include ('../../include/db/ConnectionHandler.php');

  $ruta_raiz = '../..'; 
  
  if (empty($_SESSION['dependencia']))
    header ("Location: $ruta_raiz/cerrar_session.php");

  $krd         = $_SESSION["krd"];
  $dependencia = $_SESSION["dependencia"];
  $usua_doc    = $_SESSION["usua_doc"];
  $codusuario  = $_SESSION["codusuario"];
  $tip3Nombre  = $_SESSION["tip3Nombre"];
  $tip3desc    = $_SESSION["tip3desc"];
  $tip3img     = $_SESSION["tip3img"];

  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;

  $entrada        = 0;
  $modificaciones = 0;
  $salida         = 0;

  if(empty($fecha_busq))
    $fecha_busq=date("Y-m-d");
  
  $tituloCrear = ($usModo ==1)? "Creacion de Usuario" : "Edicion de Usuario";

  $db = new ConnectionHandler($ruta_raiz);
?>
<!doctype html>
<html>
  <head>
    <title>Admin usuario</title>
    <base href="<?=ORFEO_URL?>">
    <link rel="stylesheet" href="estilos/orfeo.css">
    <script language="JavaScript" src="js/formchek.js"></script>
    <script language="javascript">

    function trim(stringToTrim) {
      return stringToTrim.replace(/^\s+|\s+$/g,"");
    }

    function envio_datos(){
      //Remover los espacios del nombre de usuario al final o el principio.
      document.forms[0].usuLogin.value = trim(document.forms[0].usuLogin.value);

        if(document.forms[0].perfil.value == "Jefe"){
            if(document.forms[0].nombreJefe.value == "") {
            }else {
                alert("En la dependencia " + document.forms[0].dep_sel.value + ", ya existe un usuario jefe, " + document.forms[0].nombreJefe.value + ", por favor verifique o realice los cambios necesarios para poder continuar con este proceso");
                document.forms[0].perfil.focus();
                return false;
            }
        }

        if(!isPositiveInteger(document.forms[0].cedula.value))
        {	alert("No se ha diligenciado el N\xfamero de la Cedula del Usuario, o a diligenciado un valor no n�merico.");
        document.forms[0].cedula.focus();
        return false;
        }

        if(isWhitespace(document.forms[0].usuLogin.value))
        {	alert("El campo Login del Usuario no ha sido diligenciado.");
        document.forms[0].usuLogin.focus();
        return false;
        }
        if (!isPositiveInteger (document.forms[0].piso.value,true))
        {	alert("El campo Piso del Usuario debe ser num\xe9rico.");
        document.forms[0].piso.focus();
        return false;
        }
        if (!isPositiveInteger(document.forms[0].extension.value,true))
        {	alert("El campo Extension del Usuario debe ser num\xe9rico.");
        document.forms[0].extension.focus();
        return false;
        }
        if (!isEmail(document.forms[0].email.value,true))
        {	alert("El campo mail del Usuario no tiene formato correcto.");
        document.forms[0].email.focus();
        return false;
        }

        if (!isYear(document.forms[0].ano.value ,true))
        {	alert("El campo a\xf1o del Usuario no tiene formato correcto.");
        document.forms[0].ano.focus();
        return false;
        }

        if(isWhitespace(document.forms[0].nombre.value)){
            alert("El campo de Nombres y Apellidos no ha sido diligenciado.");
            document.forms[0].nombre.focus();
            return false;
        }else{
            document.forms[0].submit();
            return true;
        }
    }
    </script>
  </head>
  <body>
<form name='frmCrear' action='Administracion/usuario/validar.php' method="POST">
<input type='hidden' name='<?=session_name()?>' value='<?=session_id()?>'> 
<input type=hidden  name=usModo value='<?=$usModo?>'>
<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>ADMINISTRACION DE USUARIOS Y PERFILES</span></B> </p>
	<p><B><span class=etexto> <?=$tituloCrear ?></span></B> </p></center>
	</td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
<?php
if ($usModo ==2)
{	//modo editar
	if ($valRadio)
	{	
		$usuSelec = $valRadio;
		$usuario_mat = preg_split('/\-/',$usuSelec,2);
		$usuDocSel = $usuario_mat[0];
		$usuLoginSel = $usuario_mat[1];
		$isql = "SELECT * FROM USUARIO WHERE USUA_LOGIN='".$usuLoginSel."'";
        	$rsCrea = $db->conn->Execute($isql);
		if ($rsCrea->fields["USUA_CODI"] == 1)  $perfilOrig = "Jefe";
		else $perfilOrig = "Normal";
		$perfil     = $perfilOrig;
		$nusua_codi = $rsCrea->fields["USUA_CODI"];
		$cedula     = $rsCrea->fields["USUA_DOC"];
		$usuLogin   = $rsCrea->fields["USUA_LOGIN"];
		$nombre     = $rsCrea->fields["USUA_NOMB"];
		$dep_sel    = $rsCrea->fields["DEPE_CODI"];
		$fecha_nacim 	= substr($rsCrea->fields["USUA_NACIM"], 0, 11);
		$dia = substr($fecha_nacim, 8, 2);
		$mes = substr($fecha_nacim, 5, 2);
		$ano = substr($fecha_nacim, 0, 4);
		$ubicacion      = $rsCrea->fields["USUA_AT"];
		$piso           = $rsCrea->fields["USUA_PISO"];
		$extension      = $rsCrea->fields["USUA_EXT"];
		$email          = $rsCrea->fields["USUA_EMAIL"];
		$usua_activo 	= $rsCrea->fields["USUA_ESTA"];
		$modificaciones	= $rsCrea->fields["USUA_PERM_MODIFICA"];
		$env_correo 	= $rsCrea->fields["USUA_PERM_ENVIOS"];
		$estadisticas = $rsCrea->fields["SGD_PERM_ESTADISTICA"];
		$impresion	  = $rsCrea->fields["USUA_PERM_IMPRESION"];
		$prestamo		  = $rsCrea->fields["USUA_PERM_PRESTAMO"];
		$adm_sistema 	= $rsCrea->fields["USUA_ADMIN"];
		$adm_archivo 	= $rsCrea->fields["USUA_ADMIN_ARCHIVO"];
		$usua_nuevoM 	= $rsCrea->fields["USUA_NUEVO"];
		$nivel			  = $rsCrea->fields["CODI_NIVEL"];
		$salida 		  = $rsCrea->fields["USUA_PRAD_TP1"];
		$masiva 		  = $rsCrea->fields["USUA_MASIVA"];
		$dev_correo 	= $rsCrea->fields["USUA_PERM_DEV"];
		$titulo			  = (isset($rsCrea->fields["TITULO"]))? $rsCrea->fields["TITULO"] : null;

		if ($rsCrea->fields["SGD_PANU_CODI"] == 1)
      $s_anulaciones = 1;
		
    if ($rsCrea->fields["SGD_PANU_CODI"] == 2) 
      $anulaciones = 1;
		
    if ($rsCrea->fields["SGD_PANU_CODI"] == 3) {
      $s_anulaciones = 1;
      $anulaciones = 1;
    }
    
		$usua_publico   = $rsCrea->fields["USUARIO_PUBLICO"];
		$reasigna       = $rsCrea->fields["USUARIO_REASIGNAR"];
		$firma          = $rsCrea->fields["USUA_PERM_FIRMA"];
		$notifica       = $rsCrea->fields["USUA_PERM_NOTIFICA"];
		$usua_permexp   = $rsCrea->fields["USUA_PERM_EXPEDIENTE"];
	}
}
?>
	<tr class="timparr">
		<td class="titulos2" height="26">Perfil</td>
		<td class="listado2" height="1">
<?
			$perf_1 = "Normal";
			$perf_2 = "Jefe";
			
      if ($perfil == "Jefe") {
        $perf_1 = "Jefe";
        $perf_2 = "Normal";
      }
			?>
				<select name="perfil" class='select'>
				<option value='<?=$perf_1?>' > <?=$perf_1?> </option>
				<option value='<?=$perf_2?>' > <?=$perf_2?> </option>
				</select>
			</td>
			<td class="titulos2" height="26">Dependencia</td>
			<td class="listado2" height="1">
			<?php
			include ('../../include/query/envios/queryPaencabeza.php');
			$sqlConcat = $db->conn->Concat($conversion, "'-'",$db->conn->substr."(depe_nomb,1,50) ");
			$sql = "select $sqlConcat ,depe_codi from dependencia where depe_estado=1 order by depe_codi";
      $rsDep = $db->conn->Execute($sql);
			
      if(empty($depeBuscada))
        $depeBuscada=$dependencia;
			
      print $rsDep->GetMenu2("dep_sel","$dep_sel",false, false, 0," class='select'");
      
      if (empty($nombreJefe))
        $nombreJefe = null;

      if (empty($cedulaYa))
        $cedulaYa = null;
		?>
		</td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
    <tr class=timparr>
     <input name="nombreJefe" type="hidden" value='<?=$nombreJefe?>'>
    <input name="cedulaYa" type="hidden" value='<?=$cedulaYa?>'>
<? if ($usModo == 1) { ?>
	<td class="titulos2" height="26">Nro Cedula <input type=text name=cedula id=cedula value='<?=$cedula?>' size=15 maxlenght="14" > </td>
	<td class="titulos2" height="26">Usuario <input type=text name=usuLogin id=usuLogin value='<?=$usuLogin?>' size=20 maxlenght=15></td>
<? }else { ?>
	<td class="titulos2" height="26">Nro Cedula <input  type=text name=cedula id=cedula value='<?=$cedula?>' size=15 maxlenght="14" > </td>
	<td class="titulos2" height="26">Usuario <input  type=text name=usuLogin id=usuLogin value='<?=$usuLogin?>' size=20 maxlenght=15></td>
<? } 
?>
	</tr>
</table>

<table border=1 width=93% class=t_bordeGris align="center">
<tr class=timparr>	<td width="46%" height="26" class="titulos2">Nombres y Apellidos <input type=text name=nombre id=nombre value='<?=$nombre?>' size=50 maxlenght=45> </td>	
		<td class="titulos2">
				Titulo
	<input type=text name=titulo id=titulo value='<?=$titulo?>' size=25 maxlenght=45>
			</td>
		</tr>

	<td class="titulos2" height="26">Fecha de Nacimiento </td>
	<td width="80%" class="titulos2">
		<select name="dia" id="select">
		<?
			for($i = 0; $i <= 31; $i++)
			{	if ($i == 0) {echo "<option value=''>"."". "</option>";}
				else
				{	if ($i == $dia)	{	echo "<option value=$i selected>$i</option>";	}
					else echo "<option value=$i>$i</option>";
				}
			}
		?>
		</select>
		<select name="mes" id="select2">
		<?
			$meses = array(
				0=>"",
				1=>"Enero",
				2=>"Febrero",
				3=>"Marzo",
				4=>"Abril",
				5=>"Mayo",
				6=>"Junio",
				7=>"Julio",
				8=>"Agosto",
				9=>"Septiembre",
				10=>"Octubre",
				11=>"Noviembre",
				12=>"Diciembre");
			for($i = 0; $i <= 12; $i++)
			{	if ($i == 0) {echo "<option value=" . "". ">"."". "</option>";}
				else
				{	if ($i < 10) $datos = "0".$i;
					else $datos = $i;
					if ($datos == $mes)
					{	echo "<option value=$i selected>".$meses[$i]."</option>";	}
					else echo "<option value=$i>".$meses[$i]."</option>";
				}
			}

      if (empty($s_anulaciones))
        $s_anulaciones = null;

      if (empty($anulaciones))
        $anulaciones = null;
		?>
		</select>
		<input name="ano" type="text" id="ano" size="4" maxlength="4" value='<?=$ano?>'>&nbsp;(dd/mm/yyyy)
	</td>
</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	<td width="40%" height="26" class="titulos2">Ubicacion Fisica <input type=text name=ubicacion id=ubicacion value='<?=$ubicacion?>' size=20></td>
	<td width="32%" height="26" class="titulos2">Piso <input type=text name=piso id=piso value='<?=$piso?>' size=10 ></td>
	<td width="28%" height="26" class="titulos2">Extension <input type=text name=extension id=extension value='<?=$extension?>' size=10></td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
	<tr class=timparr>
	<td width="40%" height="26" class="titulos2">
		Mail&nbsp;<input type=text name=email id=email value='<?=$email?>' size=40>
	</td>
	<td width="60%" height="26" class="listado2"></td>
	<input type=hidden name=entrada id=entrada value='<?=$entrada?>'>
	<input type=hidden name=modificaciones id=modificaciones value='<?=$modificaciones?>'>
	<input type=hidden name=masiva id=masiva value='<?=$masiva?>'>
	<input type=hidden name=impresion id=impresion value='<?=$impresion?>'>
	<input type=hidden name=s_anulaciones id=s_anulaciones value='<?=$s_anulaciones?>'>
	<input type=hidden name=anulaciones id=anulaciones value='<?=$anulaciones?>'>
	<input type=hidden name=adm_archivo id=adm_archivo value='<?=$adm_archivo?>'>
	<input type=hidden name=dev_correo id=dev_correo value='<?=$dev_correo?>'>
	<input type=hidden name=adm_sistema id=adm_sistema value='<?=$adm_sistema?>'>
	<input type=hidden name=env_correo id=env_correo value='<?=$env_correo?>'>
	<input type=hidden name=reasigna id=reasigna value='<?=$reasigna?>'>
	<input type=hidden name=estadisticas id=estadisticas value='<?=$estadisticas?>'>
	<input type=hidden name=usua_activo id=usua_activo value='<?=$usua_activo?>'>
	<input type=hidden name=usua_nuevoM id=usua_nuevoM value='<?=$usua_nuevoM?>'>
	<input type=hidden name=nivel id=nivel value='<?=$nivel?>'>
	<input type=hidden name=usuDocSel id=usuDocSel value='<?=$usuDocSel?>'>
	<input type=hidden name=usuLoginSel id=usuLoginSel value='<?=$usuLoginSel?>'>
	<input type=hidden name=perfilOrig id=perfilOrig value='<?=$perfilOrig?>'>
	<input type=hidden name=nusua_codi id=nusua_codi value='<?=$nusua_codi?>'>
	</tr>
</table>
<table border="1" width="93%" class="t_bordeGris" align="center">
	<tr class="timparr">
	  <td height="30" colspan="2" class="listado2"><span class="celdaGris"> <span class="e_texto1">
		  <center> <input class="botones" type=button name=reg_crear id=Continuar_button Value=Continuar onClick="envio_datos();"> </center> </span> </span></td>
	      <td height="30" colspan="2" class="listado2"><span class="celdaGris">
        <span class="e_texto1">
<?php
  $enlace_usuarios = 'Administracion/usuario/cuerpoEdicion.php?' .
                      'usModo=' . $usModo;
?>
	<center>
    <a href="<?=$enlace_usuarios?>">
      <input class="botones" type="button" name="Cancelar" id="Cancelar" value="Cancelar">
    </a>
  </center>
</span>
</span>
</td>
	</tr>
</table>
</form>
</body>
</html>
