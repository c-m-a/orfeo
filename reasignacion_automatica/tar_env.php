<?
session_start();
$ruta_raiz = "..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
if($_POST['actualiza'])
	{
		$upd_tar="UPDATE SGD_TAR_TARIFAS SET SGD_TAR_VALENV1=".$_POST['urbano'].",SGD_TAR_VALENV2=".$_POST['nacional']." WHERE SGD_FENV_CODIGO=".$_POST['cod_emp']." AND SGD_TAR_CODIGO=".$_POST['peso'];
		$rs_upd_tar = $db->conn->Execute($upd_tar);
echo "<center><span class='no_leidos'>TARIFA ACTUALIZADA CON EXITO</span></center>";
	}
?>
<link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css" type="text/css">
<br>
<script language="javascript">
<!--
new_ajax = function (){ 
	var xmlhttp=false;
	try	{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
	catch(e){
		try	{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
		catch(E){
			if (!xmlhttp && typeof XMLHttpRequest!='undefined') 
				xmlhttp = new XMLHttpRequest();
			}
		}
	return xmlhttp; 
	}
function trae_peso(empresa)
{
	var selSty = document.getElementById(empresa);
	var selIndex = selSty.selectedIndex;
	var selValue = selSty.options[selIndex].value;

	ajax = new_ajax();
	ajax.open("GET", "tar_cla_tar.php?empresa="+selValue,true);
	ajax.onreadystatechange = function() {
	var contenedor = document.getElementById('cla_pes');

						if (ajax.readyState == 4) 
							{
							contenedor.innerHTML = ajax.responseText;
							}
											}
					ajax.send(null);
}
function trae_tarifas()
{
	var empresa=document.getElementById('cod_emp').value;
	var codigo=document.getElementById('peso').value;
	ajax = new_ajax();
	ajax.open("GET", "tar_pre_tar.php?empresa="+empresa+"&codigo="+codigo,true);
	ajax.onreadystatechange = function() {
	var contenedor = document.getElementById('tarifas');

						if (ajax.readyState == 4) 
							{
							contenedor.innerHTML = ajax.responseText;
							}
											}
					ajax.send(null);

}	
-->
</script>


<form name="for_tar" method="post" action="<?= $_SERVER['PHP_SELF']?>">
<table width="60%" border="0" cellpadding="0"  class="borde_tab" align="center" cellspacing="5">
  <tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4" align="center">TARIFAS DE ENVIO</td>
  </tr>
  <tr bordercolor="#FFFFFF" class="listado2">
    <td><strong>Empresa de Envio</strong></td>
    <td><?
		$sqlEnv="SELECT * FROM SGD_FENV_FRMENVIO ORDER BY SGD_FENV_DESCRIP ";
		$rsEnv = $db->conn->query($sqlEnv);
	   ?>
 <select id="cod_emp" name="cod_emp" onChange="trae_peso(this.id);" class="select">
				<option>-- Seleccione --</option>
		<?
			while(!$rsEnv->EOF) 
			{
		?>
  				<option value="<?=$rsEnv->fields['SGD_FENV_CODIGO']?>"><?=$rsEnv->fields['SGD_FENV_DESCRIP']?></option>
		<?
			$rsEnv->MoveNext();
			}
		?>
			</select>
   </td>
  </tr>
  <tr bordercolor="#FFFFFF" class="listado2">
    <td>Peso (Kg)</td>
    <td>
		<div id="cla_pes"></div>
	</td>
  </tr>
  <tr bordercolor="#FFFFFF" class="listado2">
    <td colspan="2" class="titulos4" align="center">VALOR C/U</td>
  </tr>
  <tr class="listado2">
    <td colspan="2">
		<div id="tarifas"></div>
	</td>
  </tr>
  <tr bordercolor="#FFFFFF" class="listado2">
    <td colspan="2" class="titulos4" align="center"><input type="submit" name="Submit" value="Modificar" class="botones" /></td>
  </tr>
</table>
<input type="hidden" name="actualiza" value="actualiza" />
</form>
