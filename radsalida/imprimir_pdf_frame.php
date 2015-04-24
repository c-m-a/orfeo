<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>
<title>Untitled Document</title>
</head>
<body>
<? 
  
?>
</body>
<frameset rows="47,*" cols="*" framespacing="0" frameborder="NO" border="0">
  <frame src="imprimir_pdf.php?<?=session_name()."=".session_id() ?>&numrad=<?=$numrad ?>" name="topFrame" scrolling="NO" noresize >
  <frame src='http://atlas/sgd/<?=$ref_pdf ?>'  name="mainFrame">
</frameset>
<noframes></noframes>
</html>
