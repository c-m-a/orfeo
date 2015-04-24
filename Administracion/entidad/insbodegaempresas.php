<?php
session_start();
/**-------------------------------Registrar Empresa ----------------------------*
 * @NOMBRE: REGISTRAR EMPRESA EN LA TABLA BODEGA_EMPRESAS
 * @FECHA DE CREACIÓN: 14-06-06
 * @AUTOR: SUPERSOLIDARIA
 * @DESCRIPCIÓN: Registra la empresas en la tabla BODEGA_EMPRESAS, con verificación
 *				 previa de la existencia de la entidad en la Base de Datos.
 *------------------------------------------------------------------------------*/
/**
  * Paggina Cuerpo.php que muestra el contenido de las Carpetas
	* Creado en la SSPD en el año 2003
  * 
	* Se añadio compatibilidad con variables globales en Off
  * @autor Jairo Losada 2009-05
  * @licencia GNU/GPL V 3
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$nomcarpeta=$_GET["nomcarpeta"];
if($_GET["tipo_carp"])  $tipo_carp = $_GET["tipo_carp"];

define('ADODB_ASSOC_CASE', 2);

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];

$ruta_raiz = "..";
include "../../config.php";
include_once "$ruta_raiz/$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz/$ruta_raiz");
$encabezado = "&krd=$krd";
$entidad;
$orderTipo="asc";
$almacenar = "$PHP_SELF?".session_name()."=".session_id()."&nit=$nit&nombre=$nombre&sigla=$sigla&direccion=$direccion&codep_us=$codep_us&muni_us=$muni_us&sectorsuper=$sectorsuper";
?>
<html>
<head>
<title>:: Registrar Empresa - ORFEO::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript">
function validar()
{
    var checkOK = "0123456789";
    var checkStr = document.formulario.nit.value;
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
         alert("El NIT de la empresa debe ser numérico");
         document.formulario.nit.focus();
         return (false);
    }
   
   if (document.formulario.nombre.value.length < 1)
   {
        alert("Digite el nombre de la Empresa.");
        document.formulario.nombre.focus();
        return (false);
   }
   
    var checkOK = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz-.& ";
    var checkStr = document.formulario.nombre.value;
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
     alert("El Nombre de la Empresa no puede tener caracteres especiales");
     document.formulario.nombre.focus();
     return (false);
    }

   if (document.formulario.sigla.value.length < 1)
   {
        alert("Digite la sigla de la Empresa.");
        document.formulario.sigla.focus();
        return (false);
   }

    var checkOK = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz-.& ";
    var checkStr = document.formulario.sigla.value;
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
    alert("La Sigla de la Empresa no puede tener caracteres especiales");
    document.formulario.sigla.focus();
    return (false);
    }

  if (document.formulario.direccion.value.length < 1)
  {
    alert("Digite la direccion de la Empresa.");
    document.formulario.direccion.focus();
    return (false);
  }

 else if (document.formulario.codep_us.value == 0 )
  {
     alert("Seleccione el Departamento.");
  }
 else if (document.formulario.muni_us.value == 0 )
  {
     alert("Seleccione el municipio.");
  }
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
<script>
function procEst(formulario,tbres)
{

    var lista = document.formulario.codep_us.value;
	i = document.formulario.codep_us.value;

	if (i != 0) {
		var dropdownObjectPath = document.formulario.muni_us;
		var wichDropdown = "muni_us";
		var d=tbres;
	    var withWhat = document.formulario.codep_us.value;
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
	dropdownObjectPath = document.formulario.muni_us;
	eval(document.formulario.muni_us.length=o.length);
	largestwidth=0;
	for (i=0; i < o.length; i++)
	{
		eval(document.formulario.muni_us.options[i+1]=o[i]);
		if (o[i].text.length > largestwidth) {
				largestwidth=o[i].text.length;
		}
	}
		eval(document.formulario.muni_us.length=o.length);
}
</script>

<body>
<div align="center">
  <form name="formulario" method="post" action="<?=$almacenar?>">
    <table width="100%"  border="0" align="center" cellpadding="4" cellspacing="5" class="borde_tab">
      <tr>
        <td width="6" class="titulos2"><a href='javascript:atras();'>Atras</a> </td>
        <td width="94%" align="center"  valign="middle" class="titulos2"><b>
      REGISTRAR ENTIDAD SOLIDARIA </b><br>        </td>
      </tr>
    </table>
    <table border=0 width=100% class="borde_tab" align="center" cellpadding="0" cellspacing="5">
      <tr class=listado2>
        <td class="titulos5" height="25" align="right">NIT</td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="nit" class="tex_area" size=30 value='<?=$nit?>'>

        </td>
        <td class="titulos5" height="25" align="right">NUIR<font face="Arial, Helvetica, sans-serif" class="etextomenu">&nbsp;</font></td>
        <td width="39%" height="25" bgcolor="#FFFFFF" class="listado5"><input type="text" name="nuir" class="tex_area" size=30></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">Nombre</font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="nombre" class="tex_area" size=40 value='<?=$nombre?>'>
          *
        </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Sigla
        </font></td>
        <td colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="sigla" class="tex_area" size=30 value='<?=$sigla?>'>
          *
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Direcci&oacute;n </font> 
        </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="direccion" class="tex_area" size=30 value='<?=$direccion?>'>
          *
        </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tel&eacute;fono 1 </font></td>
        <td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="telefono1" class="tex_area" size=30>
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tel&eacute;fono 2 </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="telefono2" class="tex_area" size=30>
	  </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Mail </font></td>
        <td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="mail" class="tex_area" size=30>
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right" ><font face="Arial, Helvetica, sans-serif" class="etextomenu">Representante Legal</font></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="replegal" class="tex_area" size=40></td>
        <td bgcolor="#FFFFFF" height="25" class="titulos5"><div align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Cargo</font></div></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><input type="text" name="cargo" class="cargo" size=30></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Departamento </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5">
        <select  name="codep_us" onChange="procEst(formulario,18);" class="select">
        	<option value="" selected><font color="">-----</font></option>
<?PHP
	$isql ="select * from departamento ORDER BY DPTO_NOMB";
	$rs=$db->query($isql);
		while($rs && !$rs->EOF)
			{
				$deptocodi=trim($rs->fields[0]);
				$deptonomb=trim($rs->fields[1]);
				if (strlen(trim($codep_us))!=0)
				{
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
        <select  name="muni_us"  class="select">
<?PHP
		if($codep_us)
		{
			$depto=$codep_us;
		}
		if (strlen(trim($codep_us))!=0)
		{
			$depto=$codep_us;
		}
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
        
        </select>
          *
	  </font> </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right" ><font face="Arial, Helvetica, sans-serif" class="etextomenu">Delegatura</font></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5">
		
		 <select  name="sectorsuper"  class="select">
        	<option value="" selected>-----</option>
        	<option value="2" >Asociativa</option>
        	<option value="1" >Finaciera</option>
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
          <input type='submit' name='insertarEmpresa' value='GUARDAR' class='botones_largo' onclick='validar();'>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
<?php
   if($insertarEmpresa && $nombre !='' && $sigla !='' && $direccion !='' && $codep_us !=0 && $muni_us !=0)
   {
   		$nombre = strtoupper(trim($nombre));
   		$sigla = strtoupper(trim($sigla));
   		$replegal = strtoupper(trim($replegal));

		$isqlB = "SELECT * FROM BODEGA_EMPRESAS
				  WHERE NIT_DE_LA_EMPRESA = '$nit'";

		$rs = $db->query($isqlB); 
		$nitempresa = $rs->fields["NIT_DE_LA_EMPRESA"];
	        if ($nitempresa !='')
			 {
				   $mensaje_err = "<HR><center><B><FONT COLOR=RED>La empresa con NIT < $nitempresa > YA EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
   		     }
			   else
			   {
			   	//Ejecuta la busqueda y obtiene el último Codigo de la Empresa.
				$isql = "select max(IDENTIFICADOR_EMPRESA) as NUME from BODEGA_EMPRESAS";
				$rs = $db->query($isql);
	  			$idEmpresa = $rs->fields["NUME"];
				$idEmpresa =$idEmpresa + 1;
				//Query para registrar la empresa en la tabla BODEGA_EMPRESAS
				$query="INSERT INTO BODEGA_EMPRESAS(NOMBRE_DE_LA_EMPRESA,NUIR,NIT_DE_LA_EMPRESA,SIGLA_DE_LA_EMPRESA,DIRECCION,CODIGO_DEL_DEPARTAMENTO,CODIGO_DEL_MUNICIPIO,TELEFONO_1,TELEFONO_2,EMAIL,NOMBRE_REP_LEGAL,CARGO_REP_LEGAL,IDENTIFICADOR_EMPRESA,ARE_ESP_SECUE,SECTORSUPER)
						VALUES ('$nombre','$nuir','$nit','$sigla','$direccion','$codep_us','$muni_us','$telefono1','$telefono2','$email','$replegal','$cargo','$idEmpresa','','$sectorsuper')";
               	$rsIN = $db->conn->query($query);
				if($rsIN)
				{
					$mensaje_err = "<table width='90%' class=borde_tab celspacing=5><tr><td class='titulos2'><center>La empresa < $nombre > fue registrada correctamente.</B><HR><a href='javascript: atras()'>Volver al Listado</a></center></td></tr></table>";
				}	
				$nombre = '' ;
				$nuir = '';
				$nit = '';
				$sigla = '';
				$direccion = '';
				$codep_us = 0;
				$muni_us = 0;
				$telefono1 = '';
				$telefono2 = '';
				$email = '';
				$replegal = '';
                $cargo = '';
				$sectorsuper='';
                ?>
                <script language="javascript">
				document.formulario.nit.value ='';
				document.formulario.nuir.value ='';
				document.formulario.nombre.value ='';
				document.formulario.sigla.value ='';
				document.formulario.direccion.value ='';
				document.formulario.telefono1.value ='';
				document.formulario.telefono2.value ='';
				document.formulario.replegal.value ='';
				document.formulario.cargo.value ='';
				document.formulario.codep_us.value = '';
				document.formulario.muni_us.value = '';
				document.formulario.sectorsuper.value = '';
				
				</script>
<?
				 }
	 }
 ?>
  </form>
  <p>
<?=$mensaje_err?>
</p>
</div>
</body>
</html>
