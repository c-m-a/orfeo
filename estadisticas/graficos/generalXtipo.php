<HTML>
<HEAD><TITLE></TITLE>
<?
$ofc_path = "../../include/ofc-2-Kvasir";
?>
<script type="text/javascript" src="<?=$ofc_path?>/js/swfobject.js"></script>
<script type="text/javascript">

swfobject.embedSWF(
"open-flash-chart.swf", "my_chart",
"650", "300", "9.0.0", "expressInstall.swf",
{"data-file":"datosXtipo.php"} );

</script>
</HEAD>
<BODY>
<div id="my_chart"></div>

</BODY>
</HTML>