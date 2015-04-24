<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Asignar tema / sector Masiva</title>

<link rel="stylesheet" type="text/css" href="../estilos/orfeo.css" >
<link rel="stylesheet" type="text/css" href="../estilos/fonts-min.css" >
<link rel="stylesheet" type="text/css" href="../estilos/autocomplete.css">

<script type="text/javascript" src="./libs/js/yahoo-dom-event.js"></script>
<script type="text/javascript" src="./libs/js/datasource-min.js"></script>
<script type="text/javascript" src="./libs/js/connection-min.js"></script>
<script type="text/javascript" src="./libs/js/animation-min.js"></script>
<script type="text/javascript" src="./libs/js/autocomplete-min.js"></script>

<script type="text/javascript" src="./libs/js/element-min.js"></script>
<script type="text/javascript" src="./libs/js/yahoo-min.js"></script>
<script type="text/javascript" src="./libs/js/event-min.js"></script>

<!-- INICIO archivo js para manejar los eventos -->
<script type="text/javascript" src="./js/selectTemasMass.js"></script>	<!-- Crea un selector con temas dependiendo del sector-->
<script type="text/javascript" src="./js/selectAutocTemasMass.js"></script>	<!-- Crea un selector con temas dependiendo del sector-->
<script type="text/javascript" src="./js/temaSectorMass.js"></script>	<!-- Crea un selector con temas dependiendo del sector-->
<!-- FIN archivo js para manejar los eventos -->
</head>

<body class=" yui-skin-sam">
    <form id="masiva" name="masiva"  method="POST">
    	<input type="hidden" value="<!--{$krd}-->" 	name="krd">				
		<table width="96%" align="center" margin="4">      
			<tr>
				<td  class="titulos4" colspan="2" align="center" valign="middle">
					<b>Asignar Sector y tema a radicados Masiva</b>
				</td>
			</tr>
			
			<!-- INICIO Sector-->
			<tr height="40px">
				<td width="13%">Sector: </td>
				<td width="87%">
					<select name="selectSector" id="selectSector" class="select_crearExp">								
		                <!--{foreach key=key item=item from = $sectorArray}-->
							<!--{if sectorArray eq $key}-->
								<option selected value=<!--{$key}-->><!--{$item}--></option>
							<!--{else}-->
							<option value=<!--{$key}-->><!--{$item}--></option>
							<!--{/if}-->
		                <!--{/foreach}-->						
		            </select>
				</td>
			</tr>
			<!-- FIN Sector-->
			
			<!--INICIO Seleccionar tema segun sector -->
			<tr height="40px">
				<td >Tema:</td>
				<td>
					<select name="selectTema" id="selectTema" class="select_crearExp">
						<option value="0" selected="selected"> Seleccione una tema </option>                            
		            </select>
				</td>
			</tr>
			<!--FIN  Seleccionar tema segun sector-->
			
			<!-- INICIO Temas-->
			<tr height="40px">
		        <td>Tema autocompletar:</td>
				<td>							
					<div class="select_crearExp">								
						<input  type="text" name="sect_Tema_search" id="sect_Tema_search" class="select_crearExp"/>
					    <div id="contnTemaSearch"></div>						
					</div>								
					 <input name="autoTemaSect" id="myHidden" type="hidden"> 																		                    
				</td>
		    </tr>					
			<!-- FIN Temas -->
						
			<!-- INICIO radicados sin tema -->
			<!--{if $radSinSectem eq ''}-->
			   &nbsp;
			<!--{else}-->
			<tr height="40px">
		        <td valign="top">Radicados sin <br/>tema-sector :</td>
				<td valign="center" width="100%">
					<textarea id="radSinTemaSec" name="radSinTemaSec" readonly="READONLY"  class="select_crearExp nombActuExp"><!--{$radSinSectem}--></textarea>																					                    
				</td>
		    </tr>
			<!--{/if}-->
			<!-- FIN radicados sin tema -->			
			
			<!--INICIO Radicados con tema y sector -->
			<!--{if $radConSectem eq ''}-->
			   &nbsp;
			<!--{else}-->
			<tr height="40px">
				<td valign="top" align="left">
					Radicados con <br/>tema-sector:<br/>
				</td>
				<td>
					<textarea id="radContemaSec" name="radcontemaSec" readonly="READONLY"  class="select_crearExp nombActuExp"><!--{$radConSectem}--></textarea>
					Incluir los radicados que ya tienen tema
					<input type="checkbox" name="cambExiSecTem" value="555"> 
				</td>
			</tr>
			<!--{/if}-->			
			<!--FIN Radicados con tema y sector -->			
						
			<!--INICIO Botones-->
			<tr height="40px">		                
				<td colspan="2" valign="center" align="center">
					<button class="botones" type="button" id="temasSecMass"> Agregar </button>
					<button class="botones" type="button" id="cerrarTemMass"> Cerrar </button>												                    
				</td>
		    </tr>	
			<!--FIN Botones-->			
        </table>
    </form>
</body>
</html>