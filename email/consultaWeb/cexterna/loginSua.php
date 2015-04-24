<?php
session_start();
?>
<xml version="1.0">
<!DOCTYPE session [
<!ELEMENT encode   (#PCDATA)>
<!ELEMENT id   (#PCDATA)>
<!ELEMENT idName   (#PCDATA)>
<!ELEMENT last   (#PCDATA)>
<!ELEMENT session   (encode?,id,idName?,timeOut,last)>
<!ELEMENT timeOut   (#PCDATA)>]>
<?

//String ipServidor=request.getRemoteAddr();


/*
session.invalidate();*/
/*

session.removeAttribute("EMP_LOGIN");
session.removeAttribute("EMPRESA_ACTUAL");
session.removeAttribute("NOMBRE_EMPRESA_ACTUAL");
session.removeAttribute("SERVICIO");
session.removeAttribute("NOMBRE_SERVICIO");
session.removeAttribute("TOPICO");
session.removeAttribute("NOMBRE_TOPICO");
session.removeAttribute("ZONA_SERVICIO");



System.out.println("Creando sesion: "+session.getId());
session.setAttribute("EMP_LOGIN",request.getParameter("login"));
session.setAttribute("EMPRESA_ACTUAL",request.getParameter("emp_id"));
session.setAttribute("NOMBRE_EMPRESA_ACTUAL",request.getParameter("emp_nom"));


System.out.println(ipServidor);



if (!ipServidor.equals("172.16.1.55")&&!ipServidor.equals("172.16.0.64")&&!ipServidor.equals("200.41.79.52"))
{
      response.sendRedirect("/SUIWeb/errorAutenticacion.htm");
      return;
}
*/
$direccionIP = $_SERVER['REMOTE_ADDR'];
$empId = $_GET["emp_id"];
$_SESSION["emp_id"]=$empId;
$empId = getenv('emp_id');
if ($direccionIP!="172.16.1.55" and $direccionIP!="200.41.79.52" and $direccionIP!="172.16.0.64"  and  $direccionIP!="172.16.0.155")
{
	echo "PROBLEMAS CON EL ACCESO, VERIFIQUE DATOS";
      //response.sendRedirect("$ruta_raiz/salir.htm");
}
?>

<session>
<encode>
<?="http://172.16.1.50/orfeo/orfeo_3.6/consultaWeb/cexpterna/index.php?emp_id=$emp_id"?>
</encode>

<id>
<?=session_id()?>
</id>

<idName><?=session_name()?></idName>

<timeOut>
2000
</timeOut>

<last>
3000
</last>
</session>
</xml>