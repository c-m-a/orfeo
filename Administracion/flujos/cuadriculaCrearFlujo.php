<html>
<head>
<title>Cuadricula con etapas para creacion de flujo</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
<?
if(isset($HTTP_COOKIE_VARS["users_resolution"]))
	$screen_res = $HTTP_COOKIE_VARS["users_resolution"];
else
{
?>
<script language="javascript">
<!--
writeCookie();

function writeCookie() 
{
 var today = new Date();
 var the_date = new Date("December 31, 2010");
 var the_cookie_date = the_date.toGMTString();
 var the_cookie = "users_resolution="+ screen.width +"x"+ screen.height;
 var the_cookie = the_cookie + ";expires=" + the_cookie_date;
 document.cookie=the_cookie
	 
 location = 'cuadriculaCrearFlujo.php';
}
//-->
</script>

<?
}
?>

</head>
<body>
<script language="JavaScript">

<?
	if ($_POST['proceso'] != '') {
		$procesoSelected = $_POST['proceso'];
?>
alert('Hay proceso');
<?
	}
	else {
?>
alert ("No hay proceso." );
<?
	}
?>
function getScreenSize(){

	var ancho = screen.width
  	var alto = screen.height
  	alert("Tu monitor tiene las siguientes dimensiones: " + ancho + " X " + alto);
}
</script>



<form name='frmCrearEtapa' action='verFlujoCrear.php?<?=session_name()."=".session_id()."&$encabezado"?>' method="post">
<?
echo "<h1> PRoceso: </h1>" . $procesoSelected;
include("./cuadriculaBuilder.php");
?>	
	
<center><input align="middle" class="botones" type="submit" name="btnCrearFlujo" value="Crear Flujo"></center>

</form>
</body>
</html>