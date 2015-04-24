<?php
/**----------Consultar el Funcionario que tiene a cargo una Empresa-------------*
 * @NOMBRE: CONSULTAR LA PERSONA QUE TIENE A CARGO UNA EMPRESA
 * @FECHA DE CREACIÓN: 19-07-06
 * @AUTOR: SUPERSOLIDARIA
 * @DESCRIPCIÓN: Consulta el funcionario que tiene a cargo una empresa
 *				 SGD_EMPUS_EMPUSUARIO.
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
    $verempresa;
    $dep_sel;
    $almacenar = "../usuario/consultarEntidadaCargo.php?".session_name()."=".session_id()."&krd=$krd&verempresa=$verempresa&usuario=$funcionario&dep_sel=$dep_sel";
?>
<html>
<head>
<title>:: Asignar Entidad ::</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<?php
	if($busqBodegaEmpresas)
	{
		$busqBodegaEmpresas = strtoupper(trim($busqBodegaEmpresas));
    	$condicionBE .= "NOMBRE_DE_LA_EMPRESA like '%$busqBodegaEmpresas%' or SIGLA_DE_LA_EMPRESA like '%$busqBodegaEmpresas%' or NIT_DE_LA_EMPRESA like '%$busqBodegaEmpresas%'";
	}
	
	 if ($orden_cambio==1)
		{
 			if (!$orderTipo)
			{
	   			$orderTipo="desc";
			}
			else
			{
	   			$orderTipo="";
			}
 		}
?>
<body>
<center>
<form name="formEnviar" method="post" action='../usuario/consultarEntidadaCargo.php?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>&orderNo=<?=$orderNo?>&orderTipo=<?=$orderTipo?>&verempresa=<?=$verempresa?>&usuario=<?=$funcionario?>'>
<table width="100%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>CONSULTAR ENTIDAD</span></B> </p>
	</center>
	</td>
	</tr>
</table>
<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>ENTIDAD A CARGO</center></td></tr></table>
<table border=0  cellpad=2 cellspacing='0' width=100% class='t_bordeGris' valign='top' align='center' >
	<tr>
	<tr/>
	<tr><td width='100%'>
	<table width="98%" align="center" cellspacing="0" cellpadding="0">
	<tr class="tablas"><td class="etextomenu" >
	<span class="etextomenu">
	<form name=form_busq_rad action='<?=$pagina_actual?>?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>' method=post>
	Buscar Entidad
	<input name="busqBodegaEmpresas" type="text" size="60" class="tex_area" value="<?=$busqBodegaEmpresas?>">
	<input type=submit value='Buscar' name='Buscar' valign='middle' class='botones'>
	</form>
	 </span>
	</td></tr>
	</table>
	<td/>
  <tr/>
</table>
<table><tr><td></td></tr></table>
<?

       if ($orderNo==98 or $orderNo==99)
	   {
       	$order=1;
	   	if ($orderNo==98)   $orderTipo="desc";
        if ($orderNo==99)   $orderTipo="";
	   }
    	else
		{
	   		if (!$orderNo)
			{
  		  		$orderNo=0;
	   		}
	   		$order = $orderNo + 1;
    	}
	include_once "queryFuncionarios.php";
	
	$encabezado = "".session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&accion_sal=$accion_sal&coddepe=$coddepe&verempresa=$verempresa&usuario=$funcionario&dep_sel=$dep_sel&busqBodegaEmpresas=$busqBodegaEmpresas&orderTipo=$orderTipo&orderNo=";
	$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
	$db->conn->debug = false;
	if ($mensaje!='')
	{
		echo "<center><b>NO se encontro nada con el criterio de busqueda</center></b></hr>";
	}
	else
	{
	$pager = new ADODB_Pager($db,$isqlEntFun,'adodb', true,$orderNo,$orderTipo);
	$pager->checkAll = false;
	$pager->checkTitulo = true;
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->Render($rows_per_page=25,$linkPagina,$checkbox=chkEnviar);
	}

?>
</table>
<div align="center">
<table border=1 width=100% class=t_bordeGris>
	<tr class=timparr>
	<td height="30" colspan="2" class="listado2"><center><input class="botones" type="submit" name="eliminarEntidad" id="eliminarEntidad" Value="Eliminar"></center>  </td>
	<td height="30" colspan="2" class="listado2"><center>
    <input class="botones" type=button name=Cancelar id=Cancelar Value=Cancelar onClick=window.location='listafuncionarios.php?<?=session_name()."=".session_id()."&$encabezado"?>'></center>  </td>
	</tr>
</table>
</div>
</form>
<span class=etexto><center>
</center></span>
</body>
</html>
