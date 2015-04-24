<html>
<head>
<?
$ofc_path = "../../include/ofc-2-Kvasir";
?>
<script type="text/javascript" src="<?=$ofc_path?>/js/swfobject.js"></script>


<script type="text/javascript">

swfobject.embedSWF(
"open-flash-chart.swf", "my_chart",
"500", "250", "9.0.0", "expressInstall.swf",
{"data-file":"datos.php"} );

</script>
</head>
<BODY>
<center>
<div id="my_chart"></div>
</center>
</BODY>
</HTML>
