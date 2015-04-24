<?php
  // header("Location: C:\tmp\project1.exe");
  // echo "<a href='C:\\tmp\\project1.exe cadenacaracteres '>Imprimir Sticker</a>";

?>


<html><head>
<script language="javascript">
function enviar{
  alert(document.form.action);
  document.form.submit();
}
</script>
</head>
<body onload="enviar()">
<form name=form action="file://C:\tmp\project1.exe">
Hola
</form>
</body>
</html>

