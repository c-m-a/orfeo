<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Respuesta Rapida</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../estilos/orfeo.css" type="text/css"  rel="stylesheet" />
        <style type="text/css">

            HTML, BODY{
                font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
                margin: 0px; 
                height: 100%;
            }
        </style>
    </head>
    <body>

        <table width="70%" border="0" align="center" margin="4" CELLPADDING="10" cellspacing="0" >

            <tr bordercolor="#FFFFFF">
                <td colspan="2" height="40" align="center" class="titulos4"
                    valign="middle">
                    <b><span class=etexto>Respuesta Rapida</span></b>
                </td>
            </tr>
            <!--{if $noerror ge 1 or $salida eq 'ok'}-->
                <tr>
                    <td <!--{if !$sali}--> colspan="2" <!--{/if}--> valign="middle">
                        <b><span class=etexto>Radicado de respuesta No. <!--{$nurad}--></span></b>
                    </td>
                    <!--{if $sali}-->
                    <td valign="middle">
                        <b><span class=etexto>Anexos de la respuesta </span></b>
                            <!--{section name=customer loop=$sali}-->
                                <li><a href="<!--{$sali[customer].path}-->"><!--{$sali[customer].desc}--></a></li>
                            <!--{/section}-->
                    </td>
                    <!--{/if}--> 
                </tr>

                <tr>
                    <td colspan="2" >
                        <b><span class=etexto><!--{$error}--></span></b>
                    </td>
                </tr>
            <!--{else}-->
                <tr>
                    <td colspan="2" >
                        <b><span class=etexto><!--{$error}--></span></b>
                    </td>
                </tr>
            <!--{/if}-->
        </table>
        <!--{if $noerror ge 1 or $salida eq 'ok'}-->
        <iframe src="../radicacion/tipificar_documento.php?<!--{$sid}-->&nurad=<!--{$nurad}-->&dependencia=<!--{$dependencia}-->&krd=<!--{$krd}-->&tsub=0&codserie=0" 
        width='100%' height='340px' style='border: 0px'></iframe>
        <!--{/if}-->
        <center><h1><input type="button" value="Salir" class="botones" onclick="parent.window.close();"></h1></center>
    </body>
</html>
