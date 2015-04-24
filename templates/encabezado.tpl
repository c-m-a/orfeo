<table border="0" cellpad="2" cellspacing="0" WIDTH="100%" class="borde_tab" valign="top" align="center">
  <tr>
    <td width="35%">
      <table width="100%" border="0" cellspacing="1" cellpadding="0">
        <tr> 
          <td height="20" bgcolor="8cacc1">
            <div align="left" class="titulo1">LISTADO DE: </div>
          </td>
        </tr>
        <tr class="info">
          <td height="20">{$NOMCARPETA}</td>
        </tr>
      </table>
    </td>
    <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="8cacc1">
            <div align="left" class="titulo1">USUARIO </div>
          </td>
        </tr>
        <tr class="info">
          <td height="20" >{$USUA_NOMB}</td>
        </tr>
      </table>
    </td>
    {if !$BUSQUEDA_DEP}
    <td width="33%">
	    <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="8cacc1">
            <div align="left" class="titulo1">DEPENDENCIA</div>
          </td>
        </tr>
		    <tr class="info">
          <td height="20">{$DEPE_NOMB}</td>
        </tr>
      </table>
     </td>
    {else}
	  <td width="35%">
      <table width="100%" border="0" cellspacing="5" cellpadding="0">
        <tr class="info" height="20">
      	  <td bgcolor="8cacc1"  ><div align="left" class="titulo1">DEPENDENCIA</div></td>
        </tr>
		    <tr>
		      <form name='formboton' action='{$ACCION}' method='GET'>
		        <input type='hidden' name='estado_sal' value='{$ESTADO_SAL}'>
		        <td height="1">
              {$SELECT_MENU}
		        </td>
	        </form>
		    </tr>
      </table>
    </td>
    {/if} 
  </tr>
</table>
