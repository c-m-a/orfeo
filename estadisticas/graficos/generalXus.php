<HTML>
<HEAD><TITLE></TITLE>
<?
$ofc_path = "../../include/ofc-2-Kvasir/php-ofc-library";
?>
<script type="text/javascript" src="<?=$ofc_path?>js/swfobject.js"></script>
<script type="text/javascript">

swfobject.embedSWF(
"open-flash-chart.swf", "my_chart",
"300", "300", "9.0.0", "expressInstall.swf",
{"data-file":"gallery/pie-chart-on-click.php"} );

function pie_slice_clicked( index )
{
alert( 'Pie Slice '+ index +' clicked');
}
</script>
</HEAD>
<BODY>
<div id="my_chart"></div>

</BODY>
</HTML>