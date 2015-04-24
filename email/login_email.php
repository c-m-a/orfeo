<?php
session_start();
$usuaEmail =  $_SESSION["usua_email"];
$krd =  $_SESSION["krd"];
$dependencia =  $_SESSION["dependencia"];
if(isset($_SESSION['passwdEmail']))    $passwdEmail =$_SESSION['passwdEmail'];
else if (isset($_POST['passwd_mail']) && trim($_POST['passwd_mail']) <> '')
{
    $passwdEmail = $_POST['passwd_mail'];
    $_SESSION['passwdEmail'] = $_POST['passwd_mail'];
    $usuaEmail=$_SESSION['usua_email'];
    $dominioEmail=$_SESSION['dominioEmail'];
}
else $passwdEmail = null;

if(!is_null($passwdEmail))    include "emailinbox.php";
else
{
?>
<html>
<head>
<title>..Vista Previa..</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2 align="center">
<?php
if($err==1)
echo "No se pudo establecer conexi&oacute;n con el servidor.";
?>
</h2>
<table border="1"  align="center" background="../imagenes/orfeopasswd.jpg">
<tr>
    <td width="360">
        <form action="login_email.php" method="post" >
        <table width="350" border="0" align="center">
        <tr>
            <td colspan="2" align="right"><font color="#FFFFFF">Ingrese su Clave de Correo para: <br><?=$usuaEmail?><br></font></td>
        </tr>
        <tr>
            <td width="182" align="center" >
                <p>&nbsp;</p><p>&nbsp; </p></td>
            <td width="144" align="center" ><input type="password" name="passwd_mail" /></td>
        </tr>
        <tr>
            <td colspan="2" align="center" ><input name="Submit" type="submit" class="botones" value="INGRESAR"></td>
        </tr>
        </table>
        </form>
    </td>
</tr>
</table>
</body>
</html>
<?php
}
?>