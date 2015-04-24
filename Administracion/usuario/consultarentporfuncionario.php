<?php
/**--------------------------Asignar Empresa a Funcionario----------------------*
 * @NOMBRE: CONSULTAR EMPRESAS ASIGNADAS AL FUNCIONARIO
 * @FECHA DE CREACIÓN: 13-07-06
 * @AUTOR: SUPERSOLIDARIA
 * @DESCRIPCIÓN: Consulta las empresas que tiene a cargo un funcionario en la tabla
 *				 SGD_EMPUS_EMPUSUARIO.
 *------------------------------------------------------------------------------*/
	$krdOld = $krd;
	session_start();
	error_reporting(7);
	$ruta_raiz = "../..";
	include "../../rec_session.php";
    include "../../config.php";
	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug=true;   
 $encabezado = "&krd=$krd";
    $entidad;
    $verempresa;
    $dep_sel;
    $almacenar = "../usuario/consultarentporfuncionario.php?".session_name()."=".session_id()."&krd=$krd&verempresa=$verempresa&usuario=$funcionario&dep_sel=$dep_sel";
?>
<html>
<head>
<title>:: Consultar Entidades por Funcionario ::</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<?php
	if($busqBodegaEmpresas)
	{
		$busqBodegaEmpresas = strtoupper(trim($busqBodegaEmpresas));
    	$condicionEPU .= "NOMBRE_DE_LA_EMPRESA like '%$busqBodegaEmpresas%' or SIGLA_DE_LA_EMPRESA like '%$busqBodegaEmpresas%' or NIT_DE_LA_EMPRESA like '%$busqBodegaEmpresas%'";
	}

	include "queryFuncionarios.php";
	$isql = "SELECT U.USUA_NOMB, D.DEPE_NOMB
			 FROM USUARIO U, DEPENDENCIA D
			 WHERE USUA_LOGIN = '".$_GET['verempresa']."'
		 	 AND D.DEPE_CODI = '".$_GET['dep_sel']."'
		 	 AND D.DEPE_CODI=U.DEPE_CODI";
  		 	 $rs = $db->query($isql);

  		if(!$rs->EOF )
  		{
            $usuario=$rs->fields["USUA_NOMB"];
			$depenomb=$rs->fields["DEPE_NOMB"];
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
<form name="formEnviar" method="post" action='../usuario/consultarentporfuncionario.php?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>&orderNo=<?=$orderNo?>&orderTipo=<?=$orderTipo?>&verempresa=<?=$verempresa?>&usuario=<?=$funcionario?>'>
<table width="100%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>CONSULTAR ENTIDADES POR FUNCIONARIO</span></B> </p>
	</center>
	</td>
	</tr>
</table>
<div align="center">
	<table border=0 width=100% class="borde_tab">
		<tr>
			<td width="10%" height="26" class="titulos2">
			  <div align="right">Funcionario:</div></td>
			<td width="36%" class="titulos2"><?=$usuario?></td>
			<input type="hidden" name="usuario" value="<?=$verempresa?>">
			<INPUT type="hidden" name="valores">
			<td width="14%" height="26" class="titulos2"><div align="left" class="titulo2">
			  <div align="right">Dependencia:</div>
			</div></td>
			<td width="40%" height="1" class="titulos2"><?=$depenomb?></td>
		</tr>
	</table>
</div>
<br>
<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>ENTIDADES ASIGNADAS AL FUNCIONARIO</center></td></tr></table>
<table border=0  cellpad=2 cellspacing='0' width=100% class='t_bordeGris' valign='top' align='center' >
	<tr>
	<tr/>
	<tr><td width='100%'>
	<table width="98%" align="center" cellspacing="0" cellpadding="0">
	<tr class="tablas"><td class="etextomenu" >
	<span class="etextomenu">
	<form name=form_busq_rad action='<?=$pagina_actual?>?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&tpAnulacion=<?=$tpAnulacion?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>' method=post>
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
<table>
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
	$encabezado = "".session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&accion_sal=$accion_sal&coddepe=$coddepe&verempresa=$verempresa&usuario=$funcionario&dep_sel=$dep_sel&orderTipo=$orderTipo&orderNo=";
	$linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=$orderNo";
	$db->conn->debug = false;
	if ($mensaje!='' )
	{
		echo "<center><b>NO se encontro nada con el criterio de busqueda</center></b></hr>";
	}
	else
	{
	
	$pager = new ADODB_Pager($db,$isqlEPU,'adodb', true,$orderNo,$orderTipo);
	$pager->checkAll = false;
	$pager->checkTitulo = true;
	$pager->toRefLinks = $linkPagina;
	$pager->toRefVars = $encabezado;
	$pager->Render($rows_per_page=25,$linkPagina,$checkbox=chkEnviar);
	}
 ?>
 </table>
<br>
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
