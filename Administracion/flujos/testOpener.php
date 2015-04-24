<html>
<head>
<script language="javascript">

function Start(URL, WIDTH, HEIGHT) {
windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=1100,height=550";
preview = window.open(URL , "preview", windowprops);
}

function f_close(){
	//window.history.go(0);
	opener.regresar();
	window.close();
}
</script>

</head>

<body>
<?
echo "<h1>Flujo Creado</h1>";
?>
<form style="visibility:visible">
	<table  border="1">
	<tr>
		<td>
		<input align='middle' class='botones' type='button' name='btnInicio' value='Inicio' onclick="Start('procesa.php' ,100,400)";> 
		</td>
	</tr>
	</table>


</form>

</body>

</html>