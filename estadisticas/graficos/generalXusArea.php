<?
 $ofc_path = "../include/ofc-2-Kvasir";
?>
<HTML>
<HEAD><TITLE></TITLE>
<script type="text/javascript" src="<?=$ofc_path?>/js/swfobject.js"></script>
<script type="text/javascript">

swfobject.embedSWF(
"open-flash-chart.swf", "my_chart",
"550", "400", "9.0.0", "expressInstall.swf",
{"data-file":"./datosXus.php"} );

</script>
</HEAD>
<BODY>
<div id="my_chart"></div>

</BODY>
</HTML>