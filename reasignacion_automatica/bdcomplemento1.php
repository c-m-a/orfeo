<?
//echo $verrad;


session_start();
require_once("$ruta_raiz/include/db/ConnectionHandler.php");

if (!$verrad) $verrad=$_GET["verrad"];

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

 
 if(!$dependencia) include "$ruta_raiz/rec_session.php";
 
// include_once("$ruta_raiz/include/combos.php");
 
 $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
 $db->conn->debug = false; 

$Ano =date ( "Y" );

?>

<script>
function abrirbd()
{
//	alert(document.form_bdcomple.Trimestre.length)
//	document.form_bdcomple.Trimestre.value

//alert(document.form_bdcomple.expediente.length)
if(document.form_bdcomple.expediente.value=="0" || document.form_bdcomple.expediente.value=="1")
{
//alert(document.form_bdcomple.expediente.value)
	expediente=document.form_bdcomple.expediente.value;
//	alert("0")
}
else
{
	for(i=0;i<document.form_bdcomple.expediente.length;i++)
	{
		if(document.form_bdcomple.expediente[i].checked)
		{
			expediente=document.form_bdcomple.expediente[i].value;
			break;
		}
	}
}
/*if(!expediente)
	alert("Seleccione un expediente para archivar")
else
	alert("Se incluyo en "+expediente)
return;
*/
trimestre="";
for (i=0; i<document.form_bdcomple.Trimestre.options.length; i++) {
    if (document.form_bdcomple.Trimestre.options[i].selected) 
	{
		if(trimestre!="")	
			trimestre+=",";
		trimestre += document.form_bdcomple.Trimestre.options[i].value;

    }
  }
//  alert(trimestre);
//  return;



	if(trimestre=="")
	{
		alert("Por favor seleccione un trimestre")
		return;
	}
//	urlSancRegist="<?=$lksancionados?>&usuario=<?=$krd.'&nsesion='.trim(session_id())?>&nro=<?=$verradicado?><?=$datos_envio?>&ruta_raiz=.";
	mensaje="Esta seguro de guardar en la base de paz y salvos \ncon la siguiente información: \nRadicado : <?=$verrad?> \nAño :"+document.form_bdcomple.Ano.value+" \nTrimestre :"+trimestre+" \n "
	if(window.confirm(mensaje))
	{
		urlSancRegist="bdcompleme/pazysalvoscta.php?krd=<?=$krd?>&bd=PazySalvoscta&nit=<?=$cc_documento_us3?>&verrad=<?=$verrad?>&ano="+document.form_bdcomple.Ano.value+"&";
		urlSancRegist+="trimestre="+trimestre+"&ruta_raiz=..&dependencia=<?=$dependencia?>&expediente="+expediente;
//		alert(urlSancRegist)
		window.open(urlSancRegist,"pazysalvos",'top=0,height=580,width=640,scrollbars=yes');

		document.form_bdcomple.submit()
	}
}
</script>

<script>
function abrirSancionados()
{	
	//alert ("Se selecciona " +  document.form_decision.decis.value);
	urlSancRegist="pazysalvoscta.php?krd=<?=$krd?>&bd=PazySalvoscta&nit=<?=$nit?>&verrad=<?=$verrad?>&ano="+document.form_bdcomple.Ano.value+"&";
	urlSancRegist+="trimestre="+document.form_bdcomple.Trimestre.value+"&ruta_raiz=.";
	window.open(urlSancRegist,"pazysalvos",'top=0,height=580,width=640,scrollbars=yes');	
}

</script>

<form name="form_bdcomple"  method='post' action='<?=$_SERVER['PHP_SELF']?>?<?=session_name()?>=<?=trim(session_id())?>&krd=<?=$krd?>&verrad=<?=$verrad?>'>
<input type="hidden" name="verrad" id="verrad" value="<?=$verrad?>">
<input type="hidden" name="cc_documento_us3" id="cc_documento_us3" value="<?=$cc_documento_us3?>">
<input type="hidden" name="nombret_us3" id="nombret_us3" value="<?=$nombret_us3?>">

  <table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab">
      
    <tr> 
      <td  class="titulos2" >Base de Datos</td>
      <TD  > 
	  	<select id="combo" name="tipobd">
	  		<option value="1">Paz y Salvos Cta</option>
	  	</select>
      </td>
    </tr>

	<tr>
		<td class="titulos2" colspan="4"><br>Nit : 
		  <?=$cc_documento_us3?>		  <br>
		Entidad : <?=$nombret_us3?><BR>No Radicado : <?=$verrad?><br>&nbsp;</td>
	</tr>
	<tr>
		<td class="titulos2">AÑO</td>
		<td>
			<select id="combo" name="Ano">
				<option value="<?=$Ano-1?>"><?=$Ano-1?> </option>
				<option value="<?=$Ano?>" selected><?=$Ano?> </option>
			</select>
		</td>
		<td class="titulos2">TRIMESTRE</td>
		<td>
			<select id="combo" name="Trimestre" multiple>
<?
	$sql="(SELECT PER_CODIGO FROM SES_PERIODOS WHERE PER_TIPO=3) MINUS (select PYS_TRIMESTRE from SES_PAZYSALVOS_CTA WHERE PYS_ANO=$Ano and NIT_DE_LA_EMPRESA=$cc_documento_us3)";
//	echo $sql;
//	$rsce = $db->execute($queryce);
	$rs = $db->query($sql);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	if($rs!=false)	
	{
		$NombreTrimestre="";
		while(!$rs->EOF)
		{	
			switch($rs->fields["PER_CODIGO"])
			{
				case 1:
					$NombreTrimestre="PRIMERO";
					break;
				case 2:
					$NombreTrimestre="SEGUNDO";
					break;
				case 3:
					$NombreTrimestre="TERCERO";
					break;
				case 4:
					$NombreTrimestre="CUARTO";
					break;
			}
	
	?>
					<option value="<?=$rs->fields["PER_CODIGO"]?>"><?=$NombreTrimestre?></option>
	
	<?
			$rs->MoveNext();
		}
	}
	else
	echo "fallo en consulta";
?>
			</select>
		</td>
	</tr>
	
	<tr class="titulos2">
		<td colspan="4">Expediente</td>
	</tr>
	<tr>
<?
$sql = "SELECT SGD_EXP_NUMERO,SGD_SEXP_PAREXP1,SGD_SEXP_PAREXP2,SGD_SEXP_PAREXP3 FROM SGD_SEXP_SECEXPEDIENTES 
			WHERE SGD_SEXP_PAREXP1 = '$cc_documento_us3'";
			
//echo $sql;
$rs = $db->query($sql);

//echo "numero:".$rs->RecordCount();
$nexpedientes=$rs->RecordCount();
if(!$rs->RecordCount())
{
?>
	<tr>
		<td class="titulos2">Crear Expediente?</td><td> <input type="checkbox" name="expediente" value="0" onClick="check(this)"></td>
	</tr>
<?
}
else
{
?>
<tr>
	<td colspan="4"><table width="100%">
<?
	while(!$rs->EOF)
	{
?>
	<tr>
		<td class="titulos2"><?=$rs->fields["SGD_EXP_NUMERO"]?></td>
		<td><?=$rs->fields["SGD_SEXP_PAREXP1"]?></td>
		<td><?=$rs->fields["SGD_SEXP_PAREXP2"]?></td>
		<td><?=$rs->fields["SGD_SEXP_PAREXP3"]?></td>
		<td><input type="radio" name="expediente" value="<?=$rs->fields["SGD_EXP_NUMERO"]?>" ></td>
	</tr>
<?
	$rs->MoveNext();
	}
?>
	<tr>
		<td class="titulos2">NINGUNO</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td><input type="radio" name="expediente" value="0" checked ></td>
	</tr>
	</table></td>
</tr>

<?
}
?>
    <tr> 
      <td bgcolor='#cccccc' colspan="4" align="center"> 
        <input type=button  name=grabar_bdcomple value='Grabar Cambio' class='botones' onclick="abrirbd()">
      </td>
    </tr>
  </table>
</form>

<script>
function check(objeto)
{
	if(objeto.checked)
		objeto.value="1";
	else
		objeto.value="0";
//	alert(objeto.value)
}
</script>