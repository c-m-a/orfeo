<?php
	$nomcarpetaOLD = $nomcarpeta;
	if (!isset($_GET['carpeta'])) {
	  $carpeta = 0;
	  $nomcarpeta = "Entrada";
	}

  $nombre_carpeta = (isset($_GET['nomcarpeta']))? $_GET['nomcarpeta'] : null;
?>
<table border="0" cellpad="2" cellspacing="0" width="100%" class="borde_tab" valign="top" align="center">
  <tr>
    <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="8cacc1"><div align="left" class="titulo1">LISTADO DE: </div></td>
        </tr>
		<tr class="info">
          <td height="20"><?=$nombre_carpeta?></td>
        </tr>
      </table>
    </td>
     <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="8cacc1"><div align="left" class="titulo1">USUARIO </div></td>
        </tr>
		<tr class="info">
          <td height="20" ><?=$_SESSION['usua_nomb']?></td>
        </tr>
      </table>
    </td>
<?php
  if (empty($swBusqDep)) {
?>
	<td width="33%">
	    <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="8cacc1"><div align="left" class="titulo1">DEPENDENCIA </div></td>
        </tr>
		<tr class="info">
          <td height="20" ><?=$_SESSION['depe_nomb']?></td>
        </tr>
      </table>
     </td>
<?php
    } else {
      $accion = $pagina_actual . '?' . session_name() . '='. session_id() .
                '&estado_sal_max=' . $estado_sal_max .
                '&pagina_sig=' . $pagina_sig .
                '&dep_sel=' . $dep_sel .
                '&nomcarpeta=' . $nomcarpeta;
?>
	<td width="35%">
    <table width="100%" border="0" cellspacing="5" cellpadding="0">
      <tr class="info" height="20">
        <td bgcolor="8cacc1"  ><div align="left" class="titulo1">DEPENDENCIA</div></td>
      </tr>
		  <tr>
		  <form name="formboton" action="<?=$accion?>" method="get">
		<input type="hidden" name="estado_sal" value="<?=$estado_sal?>">
		<td height="1">
<?php		
		include_once "$ruta_raiz/include/query/envios/queryPaencabeza.php";			
		$sqlConcat = $db->conn->Concat($conversion , "'-'",depe_nomb);
		$sql = "select $sqlConcat ,
                    depe_codi
            from dependencia
            where depe_estado = 1
						order by depe_codi";
		$rsDep = $db->conn->Execute($sql);
		if(!$_GET['dep_sel']) $_GET['dep_sel']=$_SESSION['dependencia'];
		print $rsDep->GetMenu2("dep_sel",$_GET['dep_sel'],false, false, 0," onChange='submit();' class='select'");
?>			
		</td>
		 	  </form>
		</tr>
      </table>
    </td>
<?php
} 
?>
  </tr>
</table>
