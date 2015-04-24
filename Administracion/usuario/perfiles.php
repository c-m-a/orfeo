<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<?
	$ruta_raiz = "../..";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler("$ruta_raiz");	
	//$db->conn->debug = true;
	error_reporting(0);
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	if ($codigo && $dependencia)
		{
		$isql = "SELECT USUARIO.USUA_CODI, USUARIO.USUA_DOC,USUARIO.USUA_NOMB,USUARIO.USUA_NACIM,USUARIO.USUA_LOGIN, DEPENDENCIA.DEPE_NOMB, USUARIO.USUA_AT, USUARIO.USUA_PISO, USUARIO.USUA_EXT, USUARIO.USUA_EMAIL, DEPENDENCIA.DEPE_CODI from USUARIO, DEPENDENCIA WHERE DEPENDENCIA.DEPE_CODI = USUARIO.DEPE_CODI AND USUARIO.USUA_CODI = " .$codigo ." AND USUARIO.DEPE_CODI= ".$dependencia;
		$rs = $db->query($isql);		
		$cedula = $rs->fields["USUA_DOC"];		
		$valor_cedula = $rs->fields["USUA_DOC"];	
		$valor_login = $rs->fields["USUA_LOGIN"];				
		$dependencia = $rs->fields["DEPE_CODI"];			
		$fecha_nacim = substr($rs->fields["USUA_NACIM"], 0, 11);
		}	
	else if ($cedula && !$login)
		{
		$isql = "SELECT USUARIO.USUA_CODI,USUARIO.USUA_DOC,USUARIO.USUA_NACIM,USUARIO.USUA_NOMB,DEPENDENCIA.DEPE_CODI,USUARIO.USUA_LOGIN, DEPENDENCIA.DEPE_NOMB, USUARIO.USUA_AT, USUARIO.USUA_PISO, USUARIO.USUA_EXT, USUARIO.USUA_EMAIL from USUARIO, DEPENDENCIA WHERE DEPENDENCIA.DEPE_CODI = USUARIO.DEPE_CODI AND USUARIO.USUA_DOC = " .$cedula;
		$rs = $db->query($isql);		
		$dependencia = $rs->fields["DEPE_CODI"];
		if ($rs->recordCount() > 0)
			{
			$valor_cedula = $rs->fields["USUA_DOC"];	
			$valor_login = $rs->fields["USUA_LOGIN"];			
?>
<script>
		alert("El n\xFAmero de c\xE9dula escrito tiene la siguiente información.");
		document.form[0].cedula.focus();		
</script>		
<?
			}
		else
			{
			$valor_cedula = $cedula;						
			}
		}
	else if ($login)
		{
		$isql = "SELECT USUARIO.USUA_CODI, USUARIO.USUA_DOC,USUARIO.USUA_NACIM,USUARIO.USUA_NOMB,USUARIO.DEPE_CODI,USUARIO.USUA_LOGIN, USUARIO.USUA_AT, USUARIO.USUA_PISO, USUARIO.USUA_EXT, USUARIO.USUA_EMAIL from USUARIO WHERE USUARIO.USUA_LOGIN = '" .$login ."'";
		$rs = $db->query($isql);		
		if ($rs->recordCount() > 0)
			{
			$valor_cedula = $rs->fields["USUA_DOC"];			
			$valor_login = $rs->fields["USUA_LOGIN"];			
			$dependencia = $rs->fields["DEPE_CODI"];			
?>
<script>
		alert("El Usuario ya existe, por favor verifique.");
		document.form[0].login.focus();		
</script>		
<?
			}
		else
			{
			$valor_cedula = $cedula;
			$valor_login = $login;
			$dependencia = "";
			}
		}		
	$isql = "SELECT * from DEPENDENCIA";
	$rs1= $db->query($isql);
?>	 
<html>
<head>
<title></title>
</head>
<script language="javascript">
function envio_datos()
{
	if((document.forms[0].cedula.value == "") || (isNaN(document.forms[0].cedula.value)))
	{
		alert("No se ha diligenciado el N\xFAmero de la Cedula del Usuario, o a diligenciado un valor no n\xFAmerico. Por favor dig\xEDtelo.");
		document.forms[0].cedula.focus();
		return false;
	}

	if(document.forms[1].login.value == "")
	{
		alert("No se ha diligenciado el Login del Usuario por favor dig\xEDtelo.");
		document.forms[1].login.focus();
		return false;
	}

	if(document.forms[2].dependencia1.value == 1)
	{
		alert("No se ha diligenciado la Dependencia. Por favor seleccionela.");
		document.forms[1].login.focus();
		return false;
	}

	if(document.forms[2].nombres.value == "")
	{
		alert("No se ha diligenciado el Nombre por favor dig\xEDtelo.");
		document.forms[2].nombres.focus();
		return false;
	}
	else
	{
		document.form1.cedula.value = document.numero_cedula.cedula.value;	
		document.form1.perfil.value = document.numero_cedula.perfil.value;			
		document.form1.login.value = document.login.login.value;			
		document.forms[2].submit();
		return true;														
	}
}
function validacion_numero()
{
	if((document.forms[0].cedula.value == "") || (isNaN(document.forms[0].cedula.value)))
	{
		alert("No se ha diligenciado el N\xFAmero de la Cedula del Usuario, o a diligenciado un valor no n\xFAmerico. Por favor dig\xEDtelo.");
		document.forms[0].cedula.focus();
		return false;
	}
}
</script>
<body>
<table width="50%" border="1" cellspacing="0" cellpadding="4" bordercolor="#CCCCCC" align="left">
  <tr>
    <td colspan="2" aling="center"><div align="center"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><strong>Administraci\xF3n de Usuarios y Perfiles</strong></font></div></td>
  </tr>
  <?
if ($editar)
	{
	$isql = "SELECT * from RADICADO WHERE RADI_DEPE_ACTU = ".$codigo." and RADI_USUA_ACTU=".$dependencia;
	$rs2= $db->query($isql);	
	if($rs2->RecordCount() > 0)
		$activacion = "disabled='true'";
	else
		$activacion = "";		
?>
  <tr>
    <td colspan="2"><div align="center"><strong>Editar Usuarios </strong></div></td>
  </tr>
  <?
	}
else
	{	
?>
  <tr>
    <td colspan="2"><div align="center"><strong>Creaci&oacute;n de Usuarios</strong> </div></td>
  </tr>
  <?
	}
?>
  <form name="numero_cedula" action="admin_usu_perfiles.php" method="post" onSubmit="return validacion_numero();">
    <tr>
      <td width="50%" align="left"><font size="2">Perfil</font></td>
      <td width="80%"><select name="perfil">
<?
$isql = "SELECT * from SGD_ADMIN_USUA_PERFILES";
$rs3 = $db->query($isql);		

while(!$rs3->EOF)
{
if ($rs3->fields["CODIGO_PERFIL"]==$rs->fields["USUA_CODI"] && $rs3->fields["CODIGO_PERFIL"] == 1)
	{
?>
          <option value='<?=$rs3->fields["CODIGO_PERFIL"]?>' selected>
          <?=$rs3->fields["DESCRIPCION_PERFIL"]?>
          </option>
<?
	}
else if($rs3->fields["CODIGO_PERFIL"]!=$rs->fields["USUA_CODI"] && $rs3->fields["CODIGO_PERFIL"] == 1)
	{
?>
          <option value='<?=$rs3->fields["CODIGO_PERFIL"]?>'>
          <?=$rs3->fields["DESCRIPCION_PERFIL"]?>
          </option>
<?	
	}
else if ($rs->fields["USUA_CODI"]>1 && $rs3->fields["CODIGO_PERFIL"] == 2)
	{
?>
          <option value='<?=$rs3->fields["CODIGO_PERFIL"]?>' selected>
          <?=$rs3->fields["DESCRIPCION_PERFIL"]?>
          </option>
<?
	}
else 
		{
?>
          <option value='<?=$rs3->fields["CODIGO_PERFIL"]?>'>
          <?=$rs3->fields["DESCRIPCION_PERFIL"]?>
          </option>
<?		
		}
$rs3->MoveNext();
}
?>	
    </select></td>
  </tr>
 
  <tr>
    <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">No. de Cedula </font> </span></td>
    <td width="80%"><input name="cedula" type="text" value='<?=$valor_cedula?>' size="10" maxlength="10">
          <input type="submit" value="Buscar">
          <input name="Restablecer" type="reset" value="Limpiar">
      </select></td>
    </tr>
  </form>
  <form name="login" action="admin_usu_perfiles.php" method="post">
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">Usuario</font> </span></td>
      <td width="80%"><input type="text" name="login" value='<?=$valor_login?>'>
          <input type="submit" name="Submit2" value="Buscar"></td>
    </tr>
  </form>
  <form name="form1" action="admin_usu_permisos.php" method="post" onSubmit="return envio_datos();">
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">Nombres y Apellidos</font> </span></td>
      <td width="80%"><input name="nombres" type="text" value='<?=$rs->fields["USUA_NOMB"]?>' size="73" maxlength="73"></td>
    </tr>
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">Dependencia</font> </span></td>
      <td width="80%"><select name="dependencia1" <?=$activacion?>>
          <?
while(!$rs1->EOF)
{
if ($rs1->fields["DEPE_CODI"]==$dependencia)
	{
?>
          <option value='<?=$rs1->fields["DEPE_CODI"]?>' selected>
          <?=$rs1->fields["DEPE_NOMB"]?>
          </option>
          <?
	}
	else
	{
?>
          <option value='<?=$rs1->fields["DEPE_CODI"]?>'>
          <?=$rs1->fields["DEPE_NOMB"]?>
          </option>
          <?
	}
$rs1->MoveNext();
}
$fecha_nacim = substr($rs->fields["USUA_NACIM"], 0, 11);
?>
      </select></td>
    </tr>
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">Fecha de Nacimiento</font> </span></td>
      <td width="80%">
        <select name="dia" id="select">
          <?
	for($i = 1; $i <= 31; $i++)
		{
		if ($i == substr($fecha_nacim, 8, 2))
			{
			echo "<option value=$i selected>$i</option>";
			}
		else
			echo "<option value=$i>$i</option>";		
		}
?>
        </select>
        /
        <select name="mes" id="select2">
          <?
$meses = array(
        0=>"Enero",
        1=>"Febrero",
        2=>"Marzo",
        3=>"Abril",
        4=>"Mayo",
        5=>"Junio",
        6=>"Julio",
        7=>"Agosto",
        8=>"Septiembre",
        9=>"Octubre",
        10=>"Noviembre",
        11=>"Diciembre");
	for($i = 1; $i <= 12; $i++)
		{
		if ($i < 10)
			$datos = "0".$i;
		else
			$datos = $i;
			
		if ($datos == substr($fecha_nacim, 5, 2))
			{
			echo "<option value=$i selected>".$meses[$i - 1]."</option>";
			}
		else
			echo "<option value=$i>".$meses[$i - 1]."</option>";		
		}
?>
        </select>
        /
        <input name="ano" type="text" id="ano2" size="4" maxlength="4" value='<?=substr($fecha_nacim, 0, 4)?>'>
        (dd / mm / yyyy) </td>
    </tr>
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">Ubicaci&oacute;n</font> </span></td>
      <td width="80%"><input type="text" name="ubicacion" value='<?=$rs->fields["USUA_AT"]?>'>
      </td>
    </tr>
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">Piso</font> </span></td>
      <td width="80%"><input name="piso" type="text" value='<?=$rs->fields["USUA_PISO"]?>' size="4" maxlength="4">
      </td>
    </tr>
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">Extensi&oacute;n</font> </span></td>
      <td width="80%"><input name="extension" type="text" value='<?=$rs->fields["USUA_EXT"]?>' size="6" maxlength="6">
      </td>
    </tr>
    <tr>
      <td width="50%" class="vbmenu_control" align="left"> <span class="Estilo5"><font size="2">E-Mail</font> </span></td>
      <td width="80%"><input name="email" type="text" size="73" maxlength="73" value='<?=$rs->fields["USUA_EMAIL"]?>'>
      </td>
    </tr>
    <tr>
      <td colspan="2"><div align="center">
          <input name="cedula" type="hidden" value='<?=$valor_cedula?>'>
          <input name="perfil" type="hidden" value='<?=$rs->fields["USUA_CODI"]?>'>		  
          <input name="login" type="hidden" value='<?=$valor_login?>'>
          <input name="krd" type="hidden" value='<?=$krd?>'>
          <input name="PHPSESSID" type="hidden" value='<?=$PHPSESSID?>'>
          <input name="editar" type="hidden" value='<?=$editar?>'>
          <input type="submit" name="continuar" value="Continuar">
          <input type="reset" name="true" value="Cancelar">
      </div></td>
    </tr>
  </form>
</table>
</body>
</html>
