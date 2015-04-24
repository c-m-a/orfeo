<?php
session_start();
/**-------------------------------Modificar Empresa ----------------------------*
 * @NOMBRE: MODIFICAR DATOS DE LA EMPRESA EN LA TABLA BODEGA_EMPRESAS
 * @FECHA DE CREACI�N: 15-06-06
 * @AUTOR: SUPERSOLIDARIA
 * @DESCRIPCI�N: Modifica los datos de la empresa en la tabla BODEGA_EMPRESAS.
 * @AUTOR MODIFICACION: Adaptado V 3.8 SUPERSOLIDARIA -  Jairo Losada 2009-08
 *------------------------------------------------------------------------------*/
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 2);

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];	session_start();
	error_reporting(7);
	$ruta_raiz = "../..";
  include "../../config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler("$ruta_raiz");
	$encabezado = "&krd=$krd";
	$entidad;
	$orderTipo="asc";
	$verempresa;
//    $almacenar = "$PHP_SELF?".session_name()."=".session_id()."&krd=$krd&nit=$nit&nombre=$nombre&sigla=$sigla&direccion=$direccion&replegal=$replegal&codep_us=$codep_us&muni_us=$muni_us&verempresa=$verempresa";
?>

<html>
<head>
<title>:: Modificar Empresa - ORFEO::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript">
function validar()
{
    var checkOK = "0123456789";
    var checkStr = document.formulario.nitEmp.value;
    var allValid = true;

    for (i = 0; i < checkStr.length; i++)
    {
        ch = checkStr.charAt(i);
        for (j = 0; j < checkOK.length; j++)
        if (ch == checkOK.charAt(j))
            break;
        if (j == checkOK.length) {
            allValid = false;
        break;
        }
    }
    if (!allValid)
    {
         alert("El NIT de la empresa debe ser num�rico");
         document.formulario.nitEmp.focus();
         return (false);
    }
  if (document.formulario.nombreEmp.value.length < 1)
  {
    alert("Digite el Nombre de la Empresa.");
    document.formulario.nombreEmp.focus();
    return (false);
  }

  if (document.formulario.siglaEmp.value.length < 1)
  {
    alert("Digite la Sigla de la Empresa.");
    document.formulario.siglaEmp.focus();
    return (false);
  }
  
  if (document.formulario.direccionEmp.value.length < 1)
  {
    alert("Digite la direccion de la Empresa.");
    document.formulario.direccionEmp.focus();
    return (false);
  }
 else if (document.formulario.codep_usEmp.value == 0 )
     alert("Seleccione el Departamento.");

 else if (document.formulario.muni_usEmp.value == 0 )
     alert("Seleccione el municipio.");
	 
//	 alert(document.formulario.sectorsuper.value)
	if (document.formulario.sectorsuper.value == 0 || !document.formulario.sectorsuper.value )
  	{
     	alert("Seleccione el Delegatura");
		return false;
  	}


}

function atras()
{
	location.href="listaempresas.php";
}
</script>
<body>

<?php
   if($modificarEmpresa && $nombreEmp !='' && $siglaEmp !='' && $direccionEmp !='' && $codep_usEmp !=0 && $muni_usEmp !=0 && $sectorsuper!='')
   {
//   echo "modificar";
   		$nombreEmp = strtoupper(trim($nombreEmp));
   		$siglaEmp = strtoupper(trim($siglaEmp));
   		$replegalEmp = strtoupper(trim($replegalEmp));

	   	//Query para modificar la empresa en la tabla BODEGA_EMPRESAS
		$query="UPDATE BODEGA_EMPRESAS SET NOMBRE_DE_LA_EMPRESA='$nombreEmp',NUIR='$nuirEmp',NIT_DE_LA_EMPRESA='$nitEmp',SIGLA_DE_LA_EMPRESA='$siglaEmp',DIRECCION='$direccionEmp',CODIGO_DEL_DEPARTAMENTO='$codep_usEmp',CODIGO_DEL_MUNICIPIO='$muni_usEmp',TELEFONO_1='$telefono1Emp',TELEFONO_2='$telefono2Emp',EMAIL='$emailEmp',NOMBRE_REP_LEGAL='$replegalEmp',CARGO_REP_LEGAL='$cargoEmp',sectorsuper='$sectorsuper' WHERE IDENTIFICADOR_EMPRESA='$verempresa'";
//		echo "<br>$query<br>";
	   	$rsMO = $db->conn->query($query);
		if($rsMO)
 		{
			$mensaje_err = "<table width='90%' class=borde_tab celspacing=5><tr><td class='titulos2'><center>La empresa < $nombreEmp > fue modificada correctamente.</B><HR><a href='javascript: atras()'>Volver al Listado</a></center></td></tr></table>";
		}
				$nombreEmp = '' ;
				$nuirEmp = '';
				$nitEmp = '';
				$siglaEmp = '';
				$direccionEmp = '';
				$codep_usEmp = 0;
				$muni_usEmp = 0;
				$telefono1Emp = '';
				$telefono2Emp = '';
				$emailEmp = '';
				$replegalEmp = '';
                $cargoEmp = '';
				$sectorsuper='';
echo "<p>
$mensaje_err
</p>";

				exit;
	 }
?>


<?php
	if ( $verempresa != null )
	{
		$query = "select * from bodega_empresas where identificador_empresa='$verempresa'";
		$rs=$db->conn->query($query);
		$varQuery = $query;
  		$busqueda=$verempresa;

  		if(!$rs->EOF)
		{
            $nit=$rs->fields["NIT_DE_LA_EMPRESA"];
			$nombre=$rs->fields["NOMBRE_DE_LA_EMPRESA"];
			$sigla =$rs->fields["SIGLA_DE_LA_EMPRESA"];
			$nuir=$rs->fields["NUIR"];
			$direccion= $rs->fields["DIRECCION"];
			$telefono1=$rs->fields["TELEFONO_1"];
			$telefono2=$rs->fields["TELEFONO_1"];
			$email = $rs->fields["EMAIL"];
			$replegal = $rs->fields["NOMBRE_REP_LEGAL"];
			$cargoreplegal = $rs->fields["CARGO_REP_LEGAL"];
			$codep_us=$rs->fields["CODIGO_DEL_DEPARTAMENTO"];
			$muni_us=$rs->fields["CODIGO_DEL_MUNICIPIO"];
			$sectorsuper=$rs->fields["SECTORSUPER"];
		}
		else
		{
			echo "<p><center><table width='90%' class=borde_tab celspacing=5><tr><td class=titulosError><center>No se han encontrado los datos de la empresa<br><p><hr><font color=red>Intente de Nuevo</a></center></td></tr></table></center>";
			//if(!$rsJHLC) die("<hr>");
	 	}
	}
?>
<script>
function procEst(formulario,tbres)
{
	
    var lista = document.formulario.codep_usEmp.value;
	i = document.formulario.codep_usEmp.value;

	if (i != 0) {
		var dropdownObjectPath = document.formulario.muni_usEmp;
		var wichDropdown = "muni_usEmp";
		var d=tbres;
	    var withWhat = document.formulario.codep_usEmp.value;
		populateOptions(wichDropdown, withWhat,tbres);

    }
 }
function populateOptions(wichDropdown, withWhat,tbres)
{
	o = new Array;
	i=0;
if (withWhat == "0")
	{
	o[i++]=new Option("NADA", "0");
	}
<?PHP
$isql ="select DPTO_CODI,DPTO_NOMB from departamento";
$rs=$db->query($isql);
	while($rs && !$rs->EOF)
	{
			$deptocodi=trim($rs->fields[0]);
			$deptonomb=trim($rs->fields[1]);
			if(!$deptocodi) $deptocodi ='0';
			$rs2=$db->query("select MUNI_CODI,DPTO_CODI,MUNI_NOMB
							from municipio where dpto_codi='$deptocodi'
							ORDER BY MUNI_NOMB");
			if  ($rs2->EOF)
			{
				//die("No se ha podido abrir la tabla de municipios");
			}
			else
			{
			echo "if (withWhat == '$deptocodi')";
			}
			echo "	{";
			//echo "opener.document.formulario.dep.value='$deptocodi';";
		$ii=0;

		while ($rs2 && !$rs2->EOF)
			{
				$municodi=trim($rs2->fields[0]);
				$muninomb=trim($rs2->fields[2]);
				echo "   o[$ii]=new Option('$muninomb','$municodi');\n";
				$ii=$ii+1;
				$rs2->MoveNext();
			}
		echo "o[$ii]=new Option('$muninomb','$munidepcodi');\n";
		echo "	}; i=$ii;
		";
		$rs->MoveNext();
	}
?>
	dropdownObjectPath = document.formulario.muni_usEmp;
	eval(document.formulario.muni_usEmp.length=o.length);
	largestwidth=0;
	for (i=0; i < o.length; i++)
	{
		eval(document.formulario.muni_usEmp.options[i+1]=o[i]);
		if (o[i].text.length > largestwidth)
		{
				largestwidth=o[i].text.length;
		}
	}
		eval(document.formulario.muni_usEmp.length=o.length);
}
</script>

<div align="center">
  <form name="formulario" method="post" action="#">
    <table width="100%"  border="0" align="center" cellpadding="4" cellspacing="5" class="borde_tab">
      <tr>
        <td width="6" class="titulos2"><a href='javascript: atras()'>Atras</a> </td>
    <?php
	switch( $entidad )
	{
		case 'SES':

	?>
        <td width="94%" align="center"  valign="middle" class="titulos2"><b>
      MODIFICAR ENTIDAD SOLIDARIA </b><br></td>
	<?
	    break;
	}
	?>

      </tr>
    </table>
    <table border=0 width=100% class="borde_tab" align="center" cellpadding="0" cellspacing="5">
      <tr class=listado2>
        <td class="titulos5" height="25" align="right">NIT</td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="nitEmp" class="tex_area" size=30 value="<?=$nit?>">
        </td>
        <td class="titulos5" height="25" align="right">NUIR<font face="Arial, Helvetica, sans-serif" class="etextomenu">&nbsp;</font></td>
        <td width="39%" height="25" bgcolor="#FFFFFF" class="listado5"><input type="text" name="nuirEmp" class="tex_area" size=30 value="<?=$nuir?>"></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">Nombre        </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="nombreEmp" class="tex_area" size=40 value="<?=$nombre?>">
          *
        </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Sigla
        </font></td>
        <td colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="siglaEmp" class="tex_area" size=30 value="<?=$sigla?>">
          *
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Direcci&oacute;n </font>
        </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="direccionEmp" class="tex_area" size=30 value="<?=$direccion?>">
          *
        </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tel&eacute;fono 1 </font></td>
        <td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="telefono1Emp" class="tex_area" size=30 value="<?=$telefono1?>">
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tel&eacute;fono 2 </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="telefono2Emp" class="tex_area" size=30 value="<?=$telefono2?>">
	  </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Mail </font></td>
        <td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="mailEmp" class="tex_area" size=30 value="<?=$mail?>">
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right" ><font face="Arial, Helvetica, sans-serif" class="etextomenu">Representante Legal</font></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="replegalEmp" class="tex_area" size=40 value="<?=$replegal?>">
          
        </td>
        <td bgcolor="#FFFFFF" height="25" class="titulos5"><div align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Cargo</font></div></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="cargoEmp" class="tex_area" size=30 value="<?=$cargo?>"></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Departamento </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5">
        <select name="codep_usEmp" onChange="procEst(formulario,18);" class="select">
        	<option value="" selected><font color="">-----</font></option>
        	<?PHP
			$isql ="select * from departamento ORDER BY DPTO_NOMB";
			$rs=$db->query($isql);
			while($rs && !$rs->EOF)
				{
					$deptocodi=trim($rs->fields[0]);
					$deptonomb=trim($rs->fields[1]);
					if (strlen(trim($codep_us))!=0){
						if($deptocodi ==$codep_us) {$datos =" selected ";}else { $datos="";}
					}
					ECHO "<option value='$deptocodi' $datos><font color=''>$deptonomb</font></option>";
					$rs->MoveNext();
				}
?>
</select>
          *
        </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Municipio </font></td>
		<td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><font color="">
		<select  name="muni_usEmp"  class="select">
<?PHP
		if($codep_us)
		{
			$depto=$codep_us;
		}
		if (strlen(trim($codep_us))!=0)
			$depto=$codep_us;
		if(!$depto) $depto ='0';
		$isql ="SELECT MUNI_CODI,MUNI_NOMB FROM MUNICIPIO where DPTO_CODI=$depto order by muni_nomb";
		$rs=$db->query($isql);
		echo "<option value='' $datos>---</font></option>";
	while($rs && !$rs->EOF)
	{
			$municodi=trim($rs->fields[0]);
			$muninomb=trim($rs->fields[1]);
			if (strlen(trim($muni_us))!=0)
			{
				if($municodi ==$muni_us) {$datos =" selected ";}else { $datos="";}
			}
			echo  "<option value='$municodi' $datos>$muninomb</font></option>";
			$rs->MoveNext();
	}
	$municodi="";$muninomb="";$depto="";
?>
</select>          *
	</font> </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right" ><font face="Arial, Helvetica, sans-serif" class="etextomenu">Delegatura</font></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5">
		
		 <select  name="sectorsuper"  class="select">
		 	<option selected>---</option>
        	<option value="2" <? if($sectorsuper=="2"){ ?> selected <? }?> >Asociativa</option>
        	<option value="1" <? if($sectorsuper=="1"){ ?> selected <? }?> >Financiera</option>
		</select>
		</td>
        <td bgcolor="#FFFFFF" height="25" class="titulos5"></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"></td>
      </tr>
      <tr class=e_tablas>
        <td height="25" colspan="4" align="right" class="titulos5">(*) Campos Obligatorios </td>
      </tr>
      <tr class=e_tablas>
        <td height="25" colspan="4" align="right" class="titulos5"><div align="center">
          <input type='submit' name='modificarEmpresa' value='GUARDAR' class="botones_largo" onclick='validar();'>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>

  </form>
<p>
<?=$mensaje_err?>
</p>
</div>
</body>
</html>
