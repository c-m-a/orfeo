<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Soporte e Linea - Sueprintendencia de Servicios Publicos</title>
<!-- copyright OSI Codes Inc. http://www.osicodes.com [DO NOT DELETE] -->
<script type="text/javascript" src="js/chat_fn.js"></script>
<script type="text/javascript" src="js/xmlhttp.js"></script>
<script type="text/javascript" language="JavaScript1.2">
<!--

function init(){
	// Check for browser support
	if ( !document.createElement && !document.createElementNS ) self.location.href = "http://www.osicodes.com/demos/phplive/browser.php";
	if ( !initxmlhttp() ) self.location.href = "http://www.osicodes.com/demos/phplive/browser.php?xmlhttp=1";
	open_chat() ;
}

window.onload = init;

var win_width = window.screen.availWidth ;
var win_height = window.screen.availHeight ;

var now = new Date() ;
var day = now.getDate() ;
var time = ( now.getMonth() + 1 ) + '/' + now.getDate() + '/' +  now.getYear() + ' ' ;

var hours = now.getHours() ;
var minutes = now.getMinutes() ;
var seconds = now.getSeconds() ;

if (hours > 12){
	time += hours - 12 ;
}  else
if (hours > 10){
	time += hours ;
} else
if (hours > 0){
	time += "0" + hours ;
} else
	time = "12" ;

time += ((minutes < 10) ? ":0" : ":") + minutes ;
time += ((seconds < 10) ? ":0" : ":") + seconds ;
time += (hours >= 12) ? " P.M." : " A.M." ;

function do_submit()
{
	var dept_checked = 0 ;
	
	if ( document.form.deptid.value )
		dept_checked = 1 ;
	else
	{
		for( c = 0; c < document.form.deptid.length; ++c )
		{
			if ( document.form.deptid[c].checked )
				dept_checked = 1 ;
		}
	}

	if ( ( document.form.from_screen_name.value == "" ) || ( document.form.question.value == "" ) || ( dept_checked == 0 ) )
	{
		alert( "Los casilleros marcados con (*) deben ser completados." ) ;
	}
	else if ( document.form.email.value.indexOf("@") == -1 )
	{
		alert( "Email es formato inválido (ejemplo: someone@somewhere.com) " ) ;
	}
	else
	{
		document.form.display_width.value = win_width ;
		document.form.display_height.value = win_height ;
		document.form.datetime.value = time ;
		document.form.submit() ;
	}
}

function open_chat()
{
	}

//-->
</script>

<link href="http://elfo.anditel.com.co/phplive/css/layout.css" rel="stylesheet" type="text/css" />
<link href="http://elfo.anditel.com.co/phplive/themes/skyblue/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form method="post" action="http://elfo.anditel.com.co/phplive/request.php" name="form" id="chatform">
<input type="hidden" name="action" value="request">
<input type="hidden" name="display_width" value="">
<input type="hidden" name="display_height" value="">
<input type="hidden" name="datetime" value="">
<input type="hidden" name="x" value="1">
<input type="hidden" name="l" value="admin">
<input type="hidden" name="page" value="http://www.superservicios.gov.co/callcenter.htm">
<!-- copyright OSI Codes Inc. http://www.osicodes.com [DO NOT DELETE] -->
<div id="main">
<div id="logo"><img src="http://elfo.anditel.com.co/phplive/web/LOGO_1107475024.GIF" alt="" border=0 /></div>
<h1>Bienvenido a nuestra seccion de ayuda online.</h1>
<input type="hidden" name="deptid" value="1">	<br><br>
	<div id="inputarea">
		<fieldset>
	<dl>
		<dt><label for="user_name">Nombre</label></dt>
		<dd class="textbox"><input type="text" id="user_name" name="from_screen_name"  /></dd>
	</dl>
	<dl>
		<dt><label for="email">Email</label></dt>
		<dd class="textbox"><input type="text" id="email" name="email"  /></dd>
	</dl>
	<label for="message">Cual es su pregunta? </label>
	<textarea cols="25" rows="4" name="question" id="message" class="message1">Consulta sobre el radicado No. <?=$nuRad?>.-</textarea>
	<input type="button" id="send" name="send" value="Chat" onclick="return do_submit();" />
	</fieldset>
	</div>
	
	<div id="options">
		&nbsp;
	</div>
	
	<div id="copyright">Powered by <a href='http://www.phplivesupport.com/?link' target='newwin'>PHP Live!</a>  v3.0 &copy; OSI Codes Inc.</div>
</div>

</form>
</body>
</html>