<?
if($_GET['swListar']) $swListar =  $_GET['swListar'];
if($_GET['accion_sal']) $accion_sal =  $_GET['accion_sal'];
?>

<table><tr><td> </td></tr></table>
<table BORDER=0  cellpad=2 cellspacing='2' WIDTH=100%  align='center' class="borde_tab" cellpadding="2">
<tr> 
<? 
if ($swListar)  {
?>
<td width='50%'   class="titulos2" >
<table cellpadding="0" cellspacing="0" border="0" width="100%" >
<tr>
	<td width='30%' align='left' height="40" class="titulos2" ><b>Listar Por </b>
	<a href='<?= $pagina_actual?>?<?=$encabezado?>98&ordcambio=1' alt='Ordenar Por Leidos' >
	<span class='leidos'>Impresos</span></a>
	<?=$img7 ?> <a href='<?=$pagina_actual?>?<?=$encabezado?>99&ordcambio=1'  alt='Ordenar Por Leidos'><span class='no_leidos'>
	Por Imprimir</span></a>
	</td>
</tr>
</table>
</td>
<?
} 
?>
<td width='50%' align="center" class="titulos2" > 
	<a href='<?=$pagina_sig?>?<?=$encabezado?> '></a>
	<?
	if($accion_sal)
	{
	?>
	<input type=submit value="<?=$accion_sal?>" name=Enviar id=Enviar valign='middle' class='botones_largo' onclick="Marcar(2);">
	<?
	}
	?>
	</td>
</tr>
</table>

<script>
function Marcar(tipoAnulacion)
{
	marcados = 0;

	for(i=0;i<document.formEnviar.elements.length;i++)
	{
		if(document.formEnviar.elements[i].checked==1)
		{
			marcados++;
		}
	}
	if(marcados>=1)
	{
		document.formEnviar.submit();
	}
	else
	{
		alert("Debe seleccionar un radicado");
	}
}
		<!-- Funcion que activa el sistema de marcar o desmarcar todos los check  -->
		function markAll()
		{
			if(document.formEnviar.elements['checkAll'].checked)
			for(i=1;i<document.formEnviar.elements.length;i++)
			document.formEnviar.elements[i].checked=1;
			else
			for(i=1;i<document.formEnviar.elements.length;i++)
			document.formEnviar.elements[i].checked=0;
		}
</script>
<!--
function markAll(noRad)
{
	if(document.formEnviar.elements.check_titulo.checked || noRad >=1)
	{
			for(i=1;i<document.formEnviar.elements.length;i++)
			{
					document.formEnviar.elements[i].checked=1;
			}
	}
	else
	{
			for(i=1;i<document.formEnviar.elements.length;i++)
			{
				document.formEnviar.elements[i].checked=0;
			}
	}
}
-->