<html>
<head>
<SCRIPT>
function init() {
	document.getElementById('file_upload_form').onsubmit=function() {
		document.getElementById('file_upload_form').target = 'upload_target'; //'upload_target' is the name of the iframe
	}
}
window.onload=init;
</SCRIPT>
</head>
<body>
<form id="file_upload_form" method="post" enctype="multipart/form-data" action="upload.php">
<input name="file" id="file" size="27" type="file" /><br />
<input type="submit" name="action" value="Upload" /><br />
<iframe id="upload_target" name="upload_target" src="" style="width:0;height:0;border:0px solid #fff;"></iframe>
</form>
</body>
</html>