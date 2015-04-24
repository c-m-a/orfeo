<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Solicitud de prestamo masiva</title>

<link rel="stylesheet" type="text/css" href="../estilos/orfeo.css" >
<link rel="stylesheet" type="text/css" href="../estilos/fonts-min.css" >


<script type="text/javascript" src="./libs/js/yahoo-min.js"></script>
<script type="text/javascript" src="./libs/js/event-min.js"></script>
<script type="text/javascript" src="./libs/js/connection-min.js"></script>
<script type="text/javascript" src="./libs/js/yahoo-dom-event.js"></script>

<!-- INICIO archivo js para manejar los eventos -->
<script type="text/javascript" src="./js/soliPrestMass.js"></script>	<!-- Incluir radicados en Expediente-->
<!-- FIN archivo js para manejar los eventos -->

</head>
<body class=" yui-skin-sam">
    <form id="masiva" name="masiva"  method="POST">
    	<input type="hidden" value="<!--{$krd}-->" 	name="krd">				
		<table width="96%" align="center" margin="4">  
			
			<tr>
				<td  class="titulos4" colspan="2" align="center" valign="middle">
					<b>Solicitar documentos para prestamo</b>
				</td>
			</tr>				
			
			<tr height="40px"><td></td></tr>
			
			<!--INICIO Radicados seleccionados-->
			<tr height="40px">
				<td width="13%" valign="top" align="left">
					Radicados:<br/>
				</td>
				<td width="87%">
					<textarea name="radLibre" id="radLibre" readonly="READONLY"  class="select_crearExp nombActuExp"><!--{$radLibre}--></textarea>
				</td>
			</tr>
			<!--FIN Radicados seleccionados-->			
			
			<!--INICIO Radicados que no se pueden solicitar-->
			<!--{if $radRestr eq ''}-->
			   &nbsp;
			<!--{else}-->
			<tr height="40px">
				<td valign="top" align="left">
					No se pueden solicitar:<br/>
				</td>
				<td>
					<textarea readonly="READONLY"  class="select_crearExp nombActuExp" ><!--{$radRestr}--></textarea>					 
				</td>
			</tr>
			<!--{/if}-->
			<!--FIN Radicados que no se pueden solicitar-->			
			
			<!--INICIO Botones-->
			<tr height="40px">		                
				<td colspan="2" valign="center" align="center">
					<button class="botones" type="button" id="soliPrestMass"> Solicitar </button>
					<button class="botones" type="button" id="cerrarPrest"> Cerrar </button>												                    
				</td>
		    </tr>	
			<!--FIN Botones-->			
        </table>
    </form>
	
	<!--INICIO Respuesta -->
	<table id="respuestaPrestMass"  class="yui-hidden2" width="96%" align="center" margin="4">
		<tr>
			<td  class="titulos4" colspan="2" align="center" valign="middle">
				<center><b>Se Solicitaron los siguientes radicados para prestamo</b></center>
			</td>
		</tr>	
		
		<tr height="40px"><td></td></tr>
			
		<tr height="40px">
			<td width="23%" valign="top" align="left">
				Radicados solicitados:<br/>
			</td>
			<td width="78%">
				<textarea id="radiSoli" readonly="READONLY"  class="select_crearExp nombActuExp"></textarea>
			</td>
		</tr>
		<tr height="40px">
			<td valign="top" align="left">
				Radicados No solicitados:<br/>
			</td>
			<td>
				<textarea id="radiNoSoli" readonly="READONLY"  class="select_crearExp nombActuExp"></textarea>
			</td>
		</tr>
		
		<tr>
			<td>
				<button class="botones" type="button" id="cerrarPrest2"> Cerrar </button>		
			</td>
		</tr>	
	</table>
	<!--FIN Respuesta -->	
</body>
</html>