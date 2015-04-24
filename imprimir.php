<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
</head>
<body>
Imprimir un archivo
<a href="c:\imgsspd\codbarras.exe">Imprimir</a>

<?php
//$handle = printer_open();
printer_start_doc($handle, "My Document");
printer_start_page($handle);

$font = printer_create_font("Arial",72,48,400,false,false,false,0);
printer_select_font($handle, $font);
printer_draw_text($handle, "test", 10, 10);
printer_delete_font($font);
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);
?>

</body>
</html>
