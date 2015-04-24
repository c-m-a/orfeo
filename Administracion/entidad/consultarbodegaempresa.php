<?php
/**-------------------------------Consultar Empresa ----------------------------*
 * @NOMBRE: CONSULTAR DATOS DE LA EMPRESA EN LA TABLA BODEGA_EMPRESAS
 * @FECHA DE CREACIÓN: 15-06-06
 * @AUTOR: SUPERSOLIDARIA
 * @DESCRIPCIÓN: Consulta los datos de la empresa en la tabla BODEGA_EMPRESAS.
 *------------------------------------------------------------------------------*/
	$krdOld = $krd;
	session_start();
	error_reporting(7);
	$ruta_raiz = "..";
	include "$ruta_raiz/$ruta_raiz/rec_session.php";
    include "../../config.php";
	include_once "$ruta_raiz/$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("$ruta_raiz/$ruta_raiz");
    $encabezado = "&krd=$krd";
    $entidad;
    $orderTipo="asc";
    $verempresa;
?>

<html>
<head>
<title>:: Consultar Empresa - ORFEO::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="../../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<script language="JavaScript">
function atras()
{
	location.href="listaempresas.php";
}
</script>
<body>
<?php
	if ( $verempresa != null )
	{
		$query = "select BE.NIT_DE_LA_EMPRESA,BE.NOMBRE_DE_LA_EMPRESA,BE.SIGLA_DE_LA_EMPRESA,
		    	  BE.NUIR,BE.DIRECCION,BE.TELEFONO_1,BE.TELEFONO_2,BE.EMAIL,BE.NOMBRE_REP_LEGAL,
				  BE.CARGO_REP_LEGAL,BE.SECTORSUPER,mu.muni_nomb,dep.dpto_nomb 
				  from bodega_empresas BE, municipio mu, departamento dep
				  where identificador_empresa='$verempresa'
				  and be.CODIGO_DEL_DEPARTAMENTO=dep.dpto_codi
				  and be.CODIGO_DEL_MUNICIPIO=MU.muni_codi
				  and mu.dpto_codi=dep.dpto_codi";
//	echo $query;
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
			$codep_us=$rs->fields["DPTO_NOMB"];
			$muni_us=$rs->fields["MUNI_NOMB"];
			$sectorsuper=$rs->fields["SECTORSUPER"];
		}
		else
		{
			echo "<p><center><table width='90%' class=borde_tab celspacing=5><tr><td class=titulosError><center>No se han encontrado los datos de la empresa <br><p><hr><font color=red>Intente de Nuevo</a></center></td></tr></table></center>";
	 	}
	}
?>
<div align="center">
    <table width="100%"  border="0" align="center" cellpadding="4" cellspacing="5" class="borde_tab">
      <tr>
        <td width="6" class="titulos2"><a href='javascript: atras()'>Atras</a> </td>
    <?php
	switch( $entidad )
	{
		case 'SES':

	?>
        <td width="94%" align="center"  valign="middle" class="titulos2"><b>
      DATOS ENTIDAD SOLIDARIA </b><br></td>
	<?
	    break;
	}
	?>

      </tr>
    </table>
    <table border=0 width=100% class="borde_tab" align="center" cellpadding="0" cellspacing="5">
      <tr class=listado2>
        <td class="titulos5" height="25" align="right">NIT</td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><?=$nit?>
        </td>
        <td class="titulos5" height="25" align="right">NUIR<font face="Arial, Helvetica, sans-serif" class="etextomenu">&nbsp;</font></td>
        <td width="39%" height="25" bgcolor="#FFFFFF" class="listado5"><?=$nuir?></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">Nombre</font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><?=$nombre?></td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Sigla
        </font></td>
        <td colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><?=$sigla?></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Direcci&oacute;n </font>
        </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><?=$direccion?></td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tel&eacute;fono 1 </font></td>
        <td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><?=$telefono1?></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Tel&eacute;fono 2 </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><?=$telefono2?></td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Mail </font></td>
        <td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><?=$mail?>
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right" ><font face="Arial, Helvetica, sans-serif" class="etextomenu">Representante Legal</font></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><?=$replegal?></td>
        <td bgcolor="#FFFFFF" height="25" class="titulos5"><div align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Cargo</font></div></td>
        <td bgcolor="#FFFFFF" height="25" class="listado5"><?=$cargo?></td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Departamento </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5"><?=$codep_us?>
        </td>
        <td width="14%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Municipio </font></td>
		<td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5"><?=$muni_us?>
        </td>
      </tr>
      <tr class=e_tablas>
        <td width="17%" class="titulos5" height="25" align="right"><font face="Arial, Helvetica, sans-serif" class="etextomenu">Departamento </font></td>
        <td width="30%" bgcolor="#FFFFFF" height="25" class="listado5">
<?
	if($sectorsuper=="1")
		echo "Financiera";
	else if($sectorsuper=="2")
		echo "Asociativa";
	else
		echo "No Asignada";
	
?>
        </td>
        <td width="14%" class="titulos5" height="25" align="right"></td>
		<td  colspan="3" bgcolor="#FFFFFF" height="25" class="listado5">
        </td>
      </tr>	  
      <tr class=e_tablas>
        <td height="25" colspan="4" align="right" class="titulos5"></td>
      </tr>
      <tr class=e_tablas>
        <td height="25" colspan="4" align="right" class="titulos5"><div align="center">
          <input type='button' name='cancelar' value='CANCELAR' class="botones_largo" onclick='atras();'>
        </div></td>
      </tr>
    </table>
    <p>&nbsp;</p>
</div>
</body>
</html>
