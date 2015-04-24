<!DOCTYPE html>
<html>
  <head>
  <title>Sticker web</title>
  <style type="text/css">
    body {
      margin-bottom:0;
      margin-left:0;
      margin-right:0;
      margin-top:0;
      padding-bottom:0;
      padding-left:0;
      padding-right:0;
      padding-top:0
      font-family: Arial, Helvetica, sans-serif;            
    }

    .stik1{
      font-size: 9px;
    }

    .stik2{
      font-size: 7px;
      text-align: center;
      vertical-align:top;
    }

    .stik3{
      font-size: 9px;            
      text-align: center;
    }
  </style>
  </head>
  <body topmargin="0" leftmargin="0"  onload="window.print();">
    <table width="260px" cellpadding="0" cellspacing="0">
      <tr>
        <td align=left width="180px">
          <table>
            <tr>
              <td>
                <div align="left">
                  <font size="4">                                      
                    <b>Rad No. {$RADICADO_SEPARADO}</b>
                  </font><br>
                  <font size="2">           
                    <b>Fecha: {$RADI_FECH_RADI}</b><br>
                    <b>Dep. {$RADI_DEPE_ACTU}</b><br>
                    <b> Rem: {$REMITENTE}</b><br>
                    <b> Doc: {$NUMERO_DOCUMENTO}</b><br>
                  </font>
                </div>
              </td>
            </tr>
            <tr>
              <td colspan="1" align="center">
                <font size="" align="center">
                  <b>{$URL_ENTIDAD_STICKER}</b>
                </font>
              </td>
            </tr>
          </table>
        </td>
        <td valign="top">
        {if $URL_QRCODE}
          <img src="{$URL_QRCODE}">
        {/if}
        </td>
      </tr>
        <tr>
          <td colspan="2">
            <center>
            {if $URL_IMAGEN}
              <img src="{$URL_IMAGEN}" width="300px" height="40px">
            {else}
              <font face='Free 3 of 9' size="7">
                {$NUMERO_RADICADO} 
              </font>
            {/if}
            </center> 
          </td>
        </tr>
    </table>
  </body>
</html>
