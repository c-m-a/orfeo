<html>
<head>
<title>Constructor de Cuadrícula con etapas de flujo</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<?
$orden = 0;
$estaEnInicio = 0;
$estaEnFin = 0;
$inicioOLD = 0;
$finOLD = 0;
//include( "../../debugger.php" );
//include( "../../include/funciones.js" );
				
/*			
if( isset( $HTTP_COOKIE_VARS[ "users_resolution" ] ) )
	$screen_res = $HTTP_COOKIE_VARS[ "users_resolution" ];
else
{
?>
<script language="javascript">
<!--
//writeCookie();

function writeCookie() 
{
 var today = new Date();
 var the_date = new Date( "December 31, 2010" );
 var the_cookie_date = the_date.toGMTString();
 var the_cookie = "users_resolution="+ screen.width +"x"+ screen.height;
 var the_cookie = the_cookie + ";expires=" + the_cookie_date;
 document.cookie=the_cookie
	 
 location = 'cuadriculaBuilder.php';
}



//-->



</script>

<?
/*
<script language="JavaScript">


function getScreenSize(){

	var ancho = screen.width
  	var alto = screen.height
  	alert("Tu monitor tiene las siguientes dimensiones: " + ancho + " X " + alto);
}
</script>
*/
?>

<?
//}
?>


<script language="JavaScript">

function Start( URL, WIDTH, HEIGHT ) {
windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=650,height=350,status='This message will display in the window status bar is ver, very, very, very long for testing purposes, I guess :).'";
preview = window.open( URL , "preview", windowprops );
preview.opener = self;
preview.document.close(  );

/*preview.document.write( "<html><head></head><body>" );
preview.document.write( '\<\?php include ( "procesaAccionArista.php" ) \?\>' );
preview.document.write( "</body></html>" );

//preview.document.write("<html><head><body>hola</body></head></html>");
preview.document.close(  );
//preview.document.write('echo "hola";');
//preview.document.write('include ( "class.Flujo.php" );');
//preview.document.write("?>");
*/
//preview.;

}
function regresar(){
	window.location.reload();
	//f_close();
}
function validarInicio( ordenEtapaActual ){
	alert("Pasa");
	url="procesaAccionArista.php?ordenEtapaActual="+ordenEtapaActual;
	
	window.open(url,"Ingreso de Inicio Arista",'top=0,height=480,width=640,scrollbars=yes,resizable=yes');
	
//	var arregloEtapa = ordenEtapaActual.split( "_" ) ;
//	alert( "X: " + arregloEtapa[1] + " Y:" + arregloEtapa[2] );
//	writeCookieAction( 'Inicio' , arregloEtapa[1], arregloEtapa[2] );
	
	
	<?/*
		echo "alert('--$ordenEtapaActual--');";
		echo "alert('Inicio: ' + ordenEtapaActual);";
		*/
	?>
	
}

function validarFin( ordenEtapaActual ){
	
	
	var arregloEtapa = ordenEtapaActual.split( "_" );
	alert( "X: " + arregloEtapa[1] + " Y:" + arregloEtapa[2] );
//	writeCookieAction( 'Fin' , arregloEtapa[1], arregloEtapa[2] );

	
	<?/*
	echo "alert('--$ordenEtapaActual--');";
	echo "alert('Fin: ' + ordenEtapaActual);";
	*/
	?>
	
}

function mostrarForm( ordenEtapaActual ){

	var arregloEtapa = ordenEtapaActual.split( "_" );

	alert( "Muestra form: " + ordenEtapaActual );
	document.getElementById( ordenEtapaActual ).style.visibility = 'visible';
	
	<?/*
		echo "alert('--$ordenEtapaActual--');";
		echo "alert('Inicio: ' + ordenEtapaActual);";
		*/
	?>
	
}


</script>

</head>
<body>

<table width="93%"  border="1" align="center">
  	<tr bordercolor="#FFFFFF">
    <td colspan="2" class="titulos4">
	<center>
	<p><B><span class=etexto>CREACI&Oacute;N DE FLUJO</span></B> </p>
	</td>
	</tr>
</table>
<table border=1 width=93% class=t_bordeGris align="center">
<?
	//echo "<p>Entro a cuadricula con: " . $screen_res;

	$screenSize = explode("x", $screen_res);

	$ancho = $screenSize[0];
	$alto = $screenSize[1];

	/*echo "<p>Ancho: " . $ancho;
	echo " Alto: " . $alto;*/
	if ($primeraVez == 0) {
		$primeraVez = 1;
	
		for( $indiceEtapax = 0; $indiceEtapax < 10; $indiceEtapax++ ){
			
			echo "<tr  class=timparr>";
			
			
			for ( $indiceEtapay = 0; $indiceEtapay < 4; $indiceEtapay++ ){
				$ordenEtapaActual = "nombreEtapa_" . $indiceEtapax . "_". $indiceEtapay;
				$actionForm = 'action="cuadriculaBuilder.php?orden=' . $ordenEtapaActual . '"';
				$inicioForm = '<form method="post" name="frmFlujos' . $indiceEtapax . $indiceEtapay . '" ' . $actionForm . '>';
				$inicioFormBut = '<form method="post" name="frmFlujosActBut' . $indiceEtapax . $indiceEtapay . '" ' . $actionForm . '>';
				
				$idTabla = 'tabla_' . $indiceEtapax . "_" . "$indiceEtapay";
				
				$visibilityHidden = 'style="visibility:hidden"';
				$visibilityVisible = 'style="visibility:visible"';
//				$tempVis = ($indiceEtapax == 0 and $indiceEtapay ==1) ? $visibilityVisible : $visibilityHidden;
				$tempVis = $visibilityHidden;
				
				$finForm = '</form>';
				$finCelda = '</td>';
				$inicioCelda = '<td class="listado2" height="1">';
				$finFila =  '</tr>';
				$inicioFila =  '<tr >';
				$finTabla = '</table>';
				$inicioTabla =  '<table border=0  ';	
				$finFilaInicioCelda = '</tr><td  class="listado2" height="1">';
				$inicioFilaInicioCelda = '<tr><td class="listado2" height="1">';
				
				echo $inicioCelda . $inicioForm;
				
				//$valorOrdenEtapaActual = "valorNombreEtapa" . $indiceEtapax . $indiceEtapay;
				
				$plazoEtapaActual = "plazoEtapa"  . $indiceEtapax . $indiceEtapay;
				$valorPlazoEtapaActual = "$valorplazoEtapa"  . $indiceEtapax . $indiceEtapay;
				
				
				$celda = $inicioTabla . $visibilityVisible  . ">" . $inicioFila . $inicioCelda;
				$celda .= $inicioFormBut;
				$celda .= '<input align="left" class="botonesa" type="button" value="*" onclick="mostrarForm(' . "'$idTabla'" . ');">';
				$celda .= $finForm . $finCelda . $finFila . $finTabla;
			
				
				$celda  .= $inicioTabla . $tempVis . ' id="' . $idTabla . '">';
				$celda .= $inicioFilaInicioCelda;
				
				
				//Se agrega Campo de Texto que guarda el Orden de la etapa
				//$celda .= 'Nombre: <input class="tex_area" type="text" name="'. $ordenEtapaActual . '" maxlength="50" value=' . $valorNombreEtapa . ' size="" >';
				$celda .= "Nombre: <input class='tex_area' type='text' name=$ordenEtapaActual maxlength='50' value='$valorNombreEtapa' size='' >";
				
				//if( $indiceEtapay == 0 ){
					$celda .= $finCelda . $inicioCelda;
					$celda .= "<input align='middle' class='botones' type='button' name='btnInicioArista_$indiceEtapax_$indiceEtapay' value='Inicio'" .' onclick="Start(\'procesaAccionArista.php?ordenEtapaActual='.$ordenEtapaActual.'\'' . ',100,400)";>' ;
					$celda .= $finCelda ;	
				//}
				
				
				$celda .= $finFila . $inicioFila . $inicioCelda;
				
				//Se agrega Campo de Texto que guarda el plazo de la etapa			
	//			$celda .= 'Plazo (d&iacute;as): <input class="tex_area" type="text" name="'. $plazoEtapaActual . '" maxlength="50" value="<?=tohtml( $valorPlazoEtapaActual )" size="5" >';			
				$celda .= "Plazo (d&iacute;as): <input class='tex_area' type='text' name=$plazoEtapaActual maxlength='50' value='$valorPlazoEtapa' size='5' >";			
				
				//if( $indiceEtapay == 1 ){
					$celda .= $finCelda . $inicioCelda;
					$celda .= '<input align="middle" class="botones" type="submit" name="btnFinArista_' . $indiceEtapax . '_' . $indiceEtapay . '" value="Fin" onclick="validarFin(' . " '$ordenEtapaActual' " . ');">' ;
					$celda .= $finCelda ;	
				//}
				
				$celda .=  $finFila . $finTabla . '<br>';
				
				echo $celda;
				echo $finForm . $finCelda;
			}
			
			echo "</tr>";
			
		}
	}else {
		
	}
	
?>

</table>

<form  id="elementosHidden" >
<input type="hidden" id="arista_0" name="arista_0" value="<?=$valorArista1?>">
<input type="hidden" name="arista_1" >
<input type="hidden" name="arista_2" >
<input type="hidden" name="arista_3" >
<input type="hidden" name="arista_4" >
<input type="hidden" name="arista_5" >
<input type="hidden" name="arista_6" >
<input type="hidden" name="arista_7" >
<input type="hidden" name="arista_8" >
<input type="hidden" name="arista_9" >
<input type="hidden" name="arista_10" >
<input type="hidden" name="arista_11" >
<input type="hidden" name="arista_12" >
<input type="hidden" name="arista_13" >
<input type="hidden" name="arista_14" >
<input type="hidden" name="arista_15" >
<input type="hidden" name="arista_16" >
<input type="hidden" name="arista_17" >
<input type="hidden" name="arista_18" >
<input type="hidden" name="arista_19" >
<input type="hidden" name="arista_20" >

</form>
<?

include ( "class.Flujo.php" );
include ( "class.Etapa.php" );
include ( "class.Arista.php" );
if ( !isset( $flujo ) ) {
	$flujo = new Flujo();	
}

//Si viene de la ventana de creación arista todas las variables tienen datos, creo la arista y la agrego a la etapa
if ( $valorArista1 != '' ){//$descripcionArista != '' || $_POST['descripcionArista'] != '' ) {
	$aristaIngresada = new Arista();
	$aristaIngresada->setCodigoProceso( $procesoSelected );
	$aristaIngresada->setDescripcion( $valorArista1 );//$_POST['descripcionArista'] );
	$aristaIngresada->setDiasMin( $_POST['diasMinimo'] ); 
	$aristaIngresada->setDiasMax( $_POST['diasMaximo'] );
	$aristaIngresada->setSerie( $_POST['serie'] );
	$aristaIngresada->setSubSerie( $_POST['subserie'] );
	$aristaIngresada->setTipificacion( $_POST['tipificacion'] );
	$aristaIngresada->setCodigoTPR( $_POST['tpr'] );
	echo "Descripcion: " . $aristaIngresada->getDescripcion();	
}else {
	echo "No viene nada.";
}

$etapaIngresada = new Etapa( );
$etapaIngresada->setOrden( $orden );
$etapaIngresada->setCodigoProceso( $procesoSelected );
$etapaIngresada->setDescripcion( $valorNombreEtapa );
$etapaIngresada->setTerminos( $valorPlazoEtapa );

$flujo->addEtapa( $etapaIngresada );


?>
</body>
</html>