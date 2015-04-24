<table border="0" cellpadding="0" cellspacing="0" width="160">
  <tr>
    <td><img src="imagenes/spacer.gif" width="10" height="1" border="0" alt=""></td>
    <td><img src="imagenes/spacer.gif" width="150" height="1" border="0" alt=""></td>
    <td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
  </tr>
  <tr>
    <td colspan="2"><img name="menu_r3_c1" src="imagenes/menu_r3_c1.gif" width="148" height="31" border="0" alt=""></td>
    <td><img src="imagenes/spacer.gif" width="1" height="25" border="0" alt=""></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top">
      <table width="150" border="0" cellpadding="0" cellspacing="0" bgcolor="c0ccca">
        <tr>
          <td valign="top">
            <table width="150"  border="0" cellpadding="0" cellspacing="3" bgcolor="#eaeef9">
          {foreach $OPCIONES_MENU as $OPCION}
          {strip}
       	      <tr valign="middle">
                <td width="25">
                  <img src="imagenes/menu.gif" width="15" height="18" name="plus<?=$i?>">
                </td>
                <td width="125">
                  <a onclick="cambioMenu({$OPCION.valor_menu});" href="{$OPCION.enlace}" alt="{$OPCION.descripcion}" title="{$OPCION.descripcion}" target="mainFrame" class="menu_princ">
                {$OPCION.descripcion}
                </a>
              </td>
            </tr>
         {/strip}
         {/foreach}
         {if $MOSTRAR_MENU_MASIVA}
            <tr valign="middle">
              <td width="25"><img src="imagenes/menu.gif" width="15" height="18" name="plus<?=$i?>"></td>
              <td width="125"><a onclick="cambioMenu({$NUMERO_MENU_MASIVA});" href="{$ENLACE_MENU_MASIVA}" alt="Masiva" target='mainFrame' class="menu_princ">Masiva</a></td>
            </tr>
         {/if}
         {if $MOSTRAR_MENU_FAX}
            <tr valign="middle">
              <td width="25"><img src="imagenes/menu.gif" width="15" height="18" name="plus<?=$i?>"></td>
              <td width="125"><a onclick="cambioMenu({$NUMERO_MENU_FAX});" href="{$ENLACE_MENU_FAX}" alt="Radicacion de Fax" target='mainFrame' class="menu_princ">Rad Fax</a></td>
            </tr>
         {/if}
         {if $MOSTRAR_ASOCIAR_IMAGEN}
            <tr valign="middle">
              <td width="25"><img src="imagenes/menu.gif" width="15" height="18" name="plus<?=$i?>"></td>
              <td width="125"><a onclick="cambioMenu({$NUMERO_MENU_ASOCIAR_IMAGEN});" href="{$ENLACE_ASOCIAR_IMAGEN}" alt="Asociar imagen de radicado" target="mainFrame" class="menu_princ">Asociar Imagenes</a></td>
            </tr>
         {/if}
         {if $MOSTRAR_RADICACION_MAIL}
            <tr valign="middle">
              <td width="25"><img src="imagenes/menu.gif" width="15" height="18" name="plus<?=$i?>"></td>
              <td width="125"><a onclick="cambioMenu({$NUMERO_MENU_EMAIL});" href="{$ENLACE_EMAIL}" alt="Radicacion e-mail" target="mainFrame" class="menu_princ">e-mail</a></td>
            </tr>
         {/if}
            <tr valign="middle">
              <td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
              <td width="125">
                <a href="./plantillaRP.php" target="mainFrame" class="vinculos">Plantillas</a>
              </td>
            </tr>
          </table>
       </td>
     </tr>
   </table>
  </td>
 </tr>
</table>
