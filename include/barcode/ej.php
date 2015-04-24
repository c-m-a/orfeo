<?php @ob_start();

if($nurad) $nurad = "2006900111112";


//$bgcolor="#FFFFEC";
//$color="#333366";
$file="";
$type="png";

if(isset($_POST['Genrate']))
{
	$encode=$_POST['encode'];
	$bdata=$_POST['bdata'];
	$height=$_POST['height'];
	$scale=$_POST['scale'];
	$bgcolor=$_POST['bgcolor'];
	$color=$_POST['color'];
	$file=$_POST['file'];
	$type="png";
}
if(!$nurad) $nurad = "2006900111112";

$encode="CODE39";
$bdata=$nurad;
$height="150";
$scale="1";
$bgcolor="#000000"; 
$color="#FFFFFF";
$bdata=$nurad;
//$file="../../tmp/$nuRad.png"; 
$file="$nuRad.png";
?>
<HTML>
<BODY>
<TABLE style='border:1px solid #330066'>
<TR>
<TD>
<TABLE style='border:1px solid #990000'>
<form action='' method='POST'>
<TR>
	<TD>:</TD>
	<TD>
	<SELECT NAME="type">
	<option value='png'>PNG</option>
	</SELECT>
	</TD>
</TR>
<TR>
	<TD align='center' colspan=3>
	<input type="submit" name='Genrate' value='Submit'>
	</TD>
</TR>
</form>
</TABLE>
</TD>
<TD height="100%"><TABLE style='border:1px solid #336666;width:300px;height:100%;'>
<TR>
<TD align='center'>
<?php
if(isset($_POST['Genrate']))
{
	if(empty($_POST['file']))
	{
		foreach($_POST as $key=>$value)
			$qstr.=$key."=".urlencode($value)."&";
		echo "<img src='barcode.php?$qstr'>";
	}
	else
	{
		include("barcode.php");
		echo "<img src='".$_POST['file'].".".$_POST['type']."'>";
	}
}
?>
</TD>
</TR>
</TABLE></TD>
</TR>
</TABLE>
</BODY>
</HTML>
