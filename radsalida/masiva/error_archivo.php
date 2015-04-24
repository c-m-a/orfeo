<html>
<head>
<title>Resultado del an&aacute;lisis de datos</title>
<link rel="stylesheet" href="../../estilos_totales.css">
</head>
<script>
function enviar_consulta(){
	
}
</script>

<body bgcolor="#FFFFFF" text="#000000">
<span class=tituloListado>Se termin&oacute; de realizar la verificación de los archivos 
y se encontraron los siguientes errores: </span> <BR>
<?
if (count($auxErrrEnca)>0){
?>
<p class=etexto> <span class='etextomenu'>El archivo CSV no tiene las columnas obigatorias 
  :<BR>
  <?  
   $num = count($auxErrrEnca);
	$i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrrEnca); 
	    echo ("*".$auxErrrEnca[$record_id]."*"."<BR>");
		   next($auxErrrEnca); 
		   ++$i; 
	 }
   
  ?>
  </span></p>
	<? }
if (count($auxErrCmpCsv)>0){
?>
<p class=etexto> <span class='etextomenu'>Al archivo CSV le faltan algunas columnas oblogatorias en sus registros
  :<BR>
  <?  
   $num = count($auxErrCmpCsv);
	$i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrCmpCsv); 
	    echo ("*".$auxErrCmpCsv[$record_id]."*"."<BR>");
		   next($auxErrCmpCsv); 
		   ++$i; 
	 }
 
  ?>
  </span></p>
		<? }
if (count($auxErrorTipo)>0){
?>
<p class=etexto> <span class='etextomenu'>Al archivo CSV no se le defini&oacute; correctamente el campo tipo en los registros
  :<BR>
  <?  
   $num = count($auxErrorTipo);
	$i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrorTipo); 
	    echo ("*".$auxErrorTipo[$record_id]."*"."<BR>");
		   next($auxErrorTipo); 
		   ++$i; 
	 }
 
  ?>
  </span></p>
	
	
  <? }
	 if (count($auxErrPlant)>0) {
	 ?>
<p class=etexto><span class='etextomenu'>El archivo RTF no tiene los campos obigatorios 
  :<br>
	<?  
   $num = count($auxErrPlant);
	$i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrPlant); 
	    echo ("*".$auxErrPlant[$record_id]."*"."<BR>");
		  next($auxErrPlant); 
		  ++$i; 
	 }
} 
if (count($auxErrLugar)>0)  {
  ?>
	
  Los siguientes datos de la divisi&oacute;n pol&iacute;tica no se encontraron en la base de 
  datos: <BR>
 	<?  
   $num = count($auxErrLugar);
	$i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrLugar); 
	    echo ("*".$auxErrLugar[$record_id]."*"."<BR>");
		  next($auxErrLugar); 
		  ++$i; 
	 }
	 
	}

	if (count($auxErrESP)>0)  {
  ?>
	
  Los siguientes datos LAS ESP incluidas no se encontraron en la base de 
  datos: <BR>
 	<?  
   $num = count($auxErrESP);
	$i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrESP); 
	    echo ("*".$auxErrESP[$record_id]."*"."<BR>");
		  next($auxErrESP); 
		  ++$i; 
	 }
	 
	}
	if (count($auxErrorDir)>0)  {
	?>
  Los siguientes datos de las direcciones tienen tama&nacute;o mayor de 95 caracteres<BR>
   	<?  
   $num = count($auxErrorDir);
	$i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrorDir); 
	    echo ("*".$auxErrorDir[$record_id]."*"."<BR>");
		  next($auxErrorDir); 
		  ++$i; 
	 }
	 
	}
	
	if (count($auxErrorNom)>0)  {
	?>
	 Los siguientes datos de nombres tienen tama&nacute;o mayor de 95 caracteres<BR>
   	<?  
   $num = count($auxErrorNom);
	 $i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrorNom); 
	    echo ("*".$auxErrorNom[$record_id]."*"."<BR>");
		  next($auxErrorNom); 
		  ++$i; 
	 }
	 
	}
	
	if (count($auxErrorAnexo)>0)  {
	?>
	Los siguientes datos de radicados asociados no existen<BR>
	<?  
   $num = count($auxErrorAnexo);
	 $i = 0; 
	
	while ($i < $num) {
		  
		  $record_id = key($auxErrorAnexo); 
	    echo ("*".$auxErrorAnexo[$record_id]."*"."<BR>");
		  next($auxErrorAnexo); 
		  ++$i; 
	 }
	 
	}
  
	?>	
	
	 
  <BR>
  POR FAVOR VERIFIQUE LOS DATOS Y REPITA EL PROCESO <BR>
  <BR>
   <input type="button" name="Submit" value="Menu Masiva" class="ebuttons2"  onClick="regresar();" >
  </span> </p>
 
</body>
</html>
