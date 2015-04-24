<?php
/**
 * Example of Using HTML_AJAX_Action
 *
 * All the work happens in support/testHaa.class.php
 * This class just attaches some acctions to calls to the server class
 *
 * This just shows basic functionality, what were doing isn't actually useful
 * For an example on how one would actually use HTML_AJAX_Action check out the guestbook example
 *
 * @category   HTML
 * @package    AJAX
 * @author     Joshua Eichorn <josh@bluga.net>
 * @copyright  2006 Joshua Eichorn
 * @license    http://www.opensource.org/licenses/lgpl-license.php  LGPL
 * @version    Release: 0.5.6
 * @link       http://pear.php.net/package/HTML_AJAX
 */
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Script-Content-Type" content="text/javascript; charset=iso-8859-1">
<script type='text/javascript' src="usuariosServer.php?client=all"></script>
<script type='text/javascript' src="usuariosServer.php?stub=usuarios"></script>
<script type='text/javascript'>
// create our remote object so we can use it elsewhere
var remote = new usuarios({}); // pass in an empty hash so were in async mode
</script>
</head>
<body>

<h1>Usuarios de La Dependencia $depeCodi</h1>

<ul>
 <li><a href="#" onclick="remote.getUsuarios('usuariosInformar','500')" >Traer Usuarios Dependencia 900</a></li>
</ul>

<ul>
 <li><a href="#" onclick="remote.informarUsuario('usuariosInformar','500','1','Prueba de Informar','5222222')" >Informar Usuarios . . . .</a></li>
</ul>

<div id="target">
I'm some random text.  Ain't I fun.
</div>

<div id="usuarios">
</div>

<select id='usuariosInformar' multiple=true size=10 cols=30>
	<option value=0>Todos Los Usuarios</option>
</select>
</body>
</html>
