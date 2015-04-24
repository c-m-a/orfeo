<script>
function abrirbd(){
	var opt = document.getElementById('opcion');
	switch(opt.value) {
		case "pys":
			if(document.form_bdcomple.expediente.value=="0" || document.form_bdcomple.expediente.value=="1"){
				expediente=document.form_bdcomple.expediente.value;
				}
			else{
				for(i=0;i<document.form_bdcomple.expediente.length;i++)	{
					if(document.form_bdcomple.expediente[i].checked){
						expediente=document.form_bdcomple.expediente[i].value;
						break;
						}
					}
				}
			
			anio = document.getElementById('combo_anio').value;
			if(anio == ""){
				alert("Por favor seleccione un A&ntilde;o");
				return;
				}

			var trimestre = selMulti('combo_trimestre');
			if(trimestre == ""){
				alert("Por favor seleccione un trimestre");
				return;
				}
			mensaje="Esta seguro de guardar en la base de paz y salvos \ncon la siguiente informacion: \nRadicado : {$VERRAD} \nA�o :"+document.form_bdcomple.Ano.value+" \nTrimestre :"+trimestre+" \n "
			if(window.confirm(mensaje))	{
				urlSancRegist = "{$ENLACE_PAZYSALVOS}" + document.form_bdcomple.Ano.value;
				urlSancRegist += "&trimestre=" + trimestre + "{$VARIABLES}" + expediente
				window.open(urlSancRegist,"pazysalvos",'top=0,height=580,width=640,scrollbars=yes');
				document.form_bdcomple.submit();
				}
			break;
		case "qyd":
			alert("sdfs")
			var quejas = selMulti('quejas');
			if(quejas == ""){
				alert("Por favor seleccione un Tipo de Documento");
				return;
				}
			url = "bdcompleme/quejayderechocta.php?quejas="+quejas;
			url += "&krd=<?=$krd?>&bd=PazySalvoscta&nit=<?=$cc_documento_us3?>&verrad=<?=$verrad?>&id=<?=$documento?>";
			url += "&ruta_raiz=..&dependencia=<?=$dependencia?>";
			window.open(url, "quejasyderechos",'top = 0, height = 580, width = 640, scrollbars = yes');
			document.form_bdcomple.submit();
			break;
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

function selMulti(id_sel){
	var selectedArray = new Array();
	var selObj = document.getElementById(id_sel);
	var count = 0;
	for (var i = 0; i < selObj.options.length; i ++) {
		if (selObj.options[i].selected) {
			selectedArray[count] = selObj.options[i].value;
			count ++;
			}
		}
	return selectedArray;
	}

function nuevoAjax(){ 
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

carga_bd = function (id_sel)
{

	var selSty = document.getElementById(id_sel);
	var selIndex = selSty.selectedIndex;
	var selValue = selSty.options[selIndex].value;
	
	cc_documento_us3 = document.getElementById('cc_documento_us3').value;


	switch(id_sel){
		case "combo_bd":
			switch(selValue){
				case "pys":				
					
					
					var contenedor = document.getElementById('carga_contenido');
					contenedor.innerHTML = '';
					
					ajax = nuevoAjax();
					ajax.open("GET", "bdcompleme/bdcomple_pys.php?cc_documento_us3=" + cc_documento_us3,true);
					ajax.onreadystatechange = function() {
						if (ajax.readyState == 4) {
							contenedor.innerHTML = ajax.responseText;
							}
						}
					ajax.send(null);
					anio = document.getElementById('combo_anio').value;
					
					document.getElementById('opcion').value = "pys";
					document.getElementById('combo_anio').options[0].selected = true;
					document.getElementById('carga_trimestre').innerHTML = "<select multiple='multiple'><option>(Seleccione Trimestre)</option></select>";
					break;
				case "qyd":
					var contenedor = document.getElementById('carga_contenido');
					contenedor.innerHTML = '<img src="img/loading.gif">';
					ajax = nuevoAjax();
					ajax.open("GET", "bdcompleme/bdcomple_qyd.php",true);
					ajax.onreadystatechange = function()
					{
						if (ajax.readyState == 4)
						{
							contenedor.innerHTML = ajax.responseText;
						}
					}
					ajax.send(null);
					document.getElementById('opcion').value = "qyd";
					break;
				}
			break;
		case "combo_anio":
			anio = document.getElementById('combo_anio').value;
			documento = document.getElementById('documento').value;
			
			var contenedor = document.getElementById('carga_trimestre');
			contenedor.innerHTML = '<img src="img/loading.gif">';
			ajax = nuevoAjax();
			
			ajax.open("GET", "bdcompleme/cargatrimestre.php?Ano=" + anio + "&cc_documento_us3=" + cc_documento_us3 +"&documento="+documento, true);
			ajax.onreadystatechange = function() 
			{
				if (ajax.readyState == 4) 
				{
					contenedor.innerHTML = ajax.responseText;
				}
			}
			ajax.send(null);
			break;
		}
	}

</script>

<form name="form_bdcomple"  method='post' action='<?=$_SERVER['PHP_SELF']?>?<?=session_name()?>=<?=trim(session_id())?>&krd=<?=$krd?>&verrad=<?=$verrad?>'>
<input type="hidden" name="verrad" id="verrad" value="<?=$verrad?>">
<input type="hidden" name="cc_documento_us3" id="cc_documento_us3" value="<?=$cc_documento_us3?>">
<input type="hidden" name="documento" id="documento" value="<?=$documento?>">
<input type="hidden" name="nombret_us3" id="nombret_us3" value="<?=$nombret_us3?>">
<input type="hidden" name="opcion" id="opcion" value="pys">

  <table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab">
      
    <tr> 
      <td  class="titulos2" >Base de Datos</td>
      <TD  > 
	  	<select id="combo_bd" name="tipobd" onChange="carga_bd(this.id);">
			<option value="pys">Paz y Salvos Cta</option>
			<option value="qyd">Quejas y Derechos de Petici&oacute;n</option>
	  	</select>
      </td>
    </tr>

	<tr>
	<td class="titulos2" colspan="4">
	<br>
	Nit de la entidad: <?=$cc_documento_us3?><br>
	C&oacute;digo de la entidad: <?=$documento?><br>
	Entidad : <?=$nombret_us3?><br>
	No Radicado : <?=$verrad?>
	<br>
	<div id='carga_contenido'></div>
	</td>
	</tr>
    <tr> 
      <td bgcolor='#cccccc' colspan="4" align="center"> 
        <input type=button  name=grabar_bdcomple value='Grabar Cambio' class='botones' onclick="abrirbd()">
      </td>
    </tr>
  </table>
  <p>.</p>
</form>
<script>
function check(objeto) {
	if(objeto.checked)
		objeto.value="1";
	else
		objeto.value="0";
}
carga_bd("combo_bd");
</script>
