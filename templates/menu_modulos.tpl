<table border="0" cellpadding="0" cellspacing="0" width="160" >
<tr class="eMenu">
	<td><img src="imagenes/spacer.gif" width="10" height="1" border="0" alt=""></td>
	<td><img src="imagenes/spacer.gif" width="150" height="1" border="0" alt=""></td>
	<td><img src="imagenes/spacer.gif" width="1" height="1" border="0" alt=""></td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td valign="top">
		<table width="150"  border="0" cellpadding="0" cellspacing="0">
		<tr>
			<td valign="top">
				<table width="150"  border="0" cellpadding="0" cellspacing="3" class=eMenu>
{if $MOSTRAR_ADMINISTRACION}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <a href="{$ENLACE_ADMIN}" target='mainFrame' class="menu_princ">Administraci&oacute;n</a>
            </td>
          </tr>
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <a href="{$ENLACE_REASIGNACION}" target='mainFrame' class="menu_princ">Reasignaci&oacute;n Autom&aacute;tica</a>
            </td>
          </tr>
{/if}

{if $MOSTRAR_MODULO_COOP}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <a href="{$ENLACE_MODULO_COOP}" target='mainFrame' class="menu_princ">Modulo Cooperativas</a>
            </td>
          </tr>
{/if}

{if $MOSTRAR_FLUJOS}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <a href="{$ENLACE_ADMIN_FLUJOS}" class="menu_princ" target='mainFrame'>Editor Flujos</a>
            </td>
          </tr>
{/if}

{if $MOSTRAR_CTL_LEGALIDAD}
          <tr valign="middle">
		        <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
		        <td width="125">
              <a href="{$ENLACE_CTL_LEGALIDAD}" target='mainFrame' class="menu_princ">Reportes Control de Legalidad</a>
            </td>
          </tr>
{/if}

{if $MOSTRAR_ENVIOS}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <a href="{$ENLACE_ENVIOS}" target='mainFrame' class="menu_princ">Envios</a>
            </td>
          </tr>
{/if}

{if $MOSTRAR_MODIFICACION}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <span class="Estilo12">
                <a href="{$ENLACE_MODIFICACION}" target='mainFrame' class="menu_princ">Modificaci&oacute;n</a>
              </span>
            </td>
          </tr>
{/if}

{if $MOSTRAR_FIRMA}
          <tr valign="middle">
            <td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
            <td width="125">
              <span class="Estilo12">
                <a href="{$ENLACE_FIRMA}" target='mainFrame' class="menu_princ">Firma Digital</a>
              </span>
            </td>
          </tr>
{/if}

{if $MOSTRAR_APSINTEGRADAS}
        <tr valign="middle">
          <td width="25">
            <img src="imagenes/menu.gif" width="15" height="18">
          </td>
          <td width="125">
            <span class="Estilo12">
              <a href="{$ENLACE_APSINTEGRADAS}" target='mainFrame' class="menu_princ">Aplicaciones integradas</a>
            </span>
          </td>
        </tr>
{/if}

{if $MOSTRAR_IMPRESION}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <span class="Estilo12">
                <a href="{$ENLACE_IMPRESION}" target='mainFrame' class="menu_princ">Impresi&oacute;n</a></span>
            </td>
          </tr>
{/if}

{if $MOSTRAR_COMISIONES}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <span class="Estilo12">
                <a href="{$ENLACE_COMISIONES}" target='mainFrame' class="menu_princ">Comisiones</a>
              </span>
            </td>
          </tr>
{/if}

{if $MOSTRAR_ANULACIONES}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <span class="Estilo12">
                <a href="{$ENLACE_ANULACIONES}" target='mainFrame' class="menu_princ">Anulaci&oacute;n</a>
              </span>
            </td>
          </tr>
{/if}

{if $MOSTRAR_SANCIONADOS}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <span class="Estilo12">
              <a href="{$ENLACE_SANCIONADOS}" target='mainFrame' class="menu_princ">Sancionados</a></span>
            </td>
          </tr>
{/if}

{if $MOSTRAR_TRD}
          <tr valign="middle">
            <td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
            <td width="125">
              <span class="Estilo12">
                <a href="{$ENLACE_TRD}" target='mainFrame' class="menu_princ">Tablas Retenci&oacute;n Documental</a>
              </span>
            </td>
          </tr>
{/if}
          <tr valign="middle">
            <td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
            <td width="125">
              <span class="Estilo12">
              <a href="{$ENLACE_CONSULTAS}" target='mainFrame' class="menu_princ">Consultas</a></span>
            </td>
          </tr>

{if $MOSTRAR_ARCHIVO}
				<tr>
					<td>
						<img src='imagenes/menu.gif' alt='Documentos para archivar' title='Documentos para archivar' border=0 align='absmiddle'>
          </td>
          <td>
            <span class="Estilo12">
              <a href='{$ENLACE_ARCHIVO}' target='mainFrame' class="menu_princ">Archivo ({$NUM_EXP})</a></span>
					</td>
				</tr>
{/if}

{if $MOSTRAR_PRESTAMO}
				<tr valign="middle">
					<td width="25">
            <img src="imagenes/menu.gif" width="15" height="18">
          </td>
					<td width="125">
						<span class="Estilo12">
              <a href="{$ENLACE_PRESTAMO}" target='mainFrame' class="menu_princ">Prestamo</a>
            </span>
					</td>
				</tr>
{/if}

{if $MOSTRAR_DEVOLUCION}
				<tr>
					<td>
						<img src='imagenes/menu.gif' alt='Documentos para archivar' title='Documentos para archivar' border=0 align='absmiddle'>
					</td>
					<td>
						<span class="Estilo12">
						<a href='{$ENLACE_DEVOLUCION}' target='mainFrame' class="menu_princ" >Dev Correo</span></a>
					</td>
				</tr>
{/if}

{if $MOSTRAR_VISITAS}
          <tr valign="middle">
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <a href="{$ENLACE_VISITAS}" target='mainFrame' class="menu_princ">Visitas Descentralizadas</a>
            </td>
          </tr>
{/if}

{if $MOSTRAR_ENTIDADES}
            <tr valign="middle">
              <td width="25">
                <img src="imagenes/menu.gif" width="15" height="18">
              </td>
              <td width="125">
                <a href="{$ENLACE_ENTIDADES}" target="mainFrame" class="menu_princ">Entidades SES</a>
              </td>
            </tr>
{/if}
          <tr>
            <td width="25">
              <img src="imagenes/menu.gif" width="15" height="18">
            </td>
            <td width="125">
              <a href="{$ENLACE_DOCUWARE}" target='mainFrame' class="menu_princ">Archivo Central Docuware</a>
            </td>
          </tr>
{if $MOSTRAR_LIQUIDACION}
          <tr valign="middle">
            <td width="25"><img src="imagenes/menu.gif" width="15" height="18"></td>
            <td width="125"><a href="{$ENLACE_LIQUIDACION}" target='mainFrame' class="menu_princ">Liquidacion Voluntaria</a></td>
          </tr>
{/if}

{if $MOSTRAR_ARCHIVO_CENTRAL}
				<tr>
					<td>
						<img src='imagenes/menu.gif' alt='Documentos para archivar' title='Documentos para archivar' border=0 align='absmiddle'>
					</td>
					<td>
						<span class="Estilo12">
						<a href='{$ENLACE_DOCUMENTAL}' target='mainFrame' class="menu_princ" >Radicaci&oacute;n Archivo Central</span></a>
					</td>
				</tr>
{/if}
		    </table>
	    </td>
    </tr>
  </table>
</td>
</tr>
</table>
