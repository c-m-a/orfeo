<?
if (!$ruta_raiz)
	$ruta_raiz = "..";
?>
<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="<?=$ruta_raiz?>/js/spiffyCal/spiffyCal_v2_1.js"></script>
<link href="../estilos_totales.css" rel="stylesheet" type="text/css">
<div id="spiffycalendar" class="text"></div>
</head>
<body bgcolor="#FFFFFF" text="#000000"> 
<p>
  <script language="javascript">
		var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "busqueda","fechaIni","btnDate1","",scBTNMODE_CUSTOMBLUE);
	 	dateAvailable.date = "2003-08-05";
		dateAvailable.dateFormat="yyyy-MM-dd";
		
		var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "busqueda","fechaFin","btnDate2","",scBTNMODE_CUSTOMBLUE);
	 	dateAvailable2.date = "2003-08-05";
		dateAvailable2.dateFormat="yyyy-MM-dd";
	</script>
</p>
<form name="busqueda" method="post" action="resultResumenRads.php">
<table width="70%" border="0" cellspacing="1" cellpadding="1" class="t_bordeGris">
<tr> 
    <td width="29%" height="15"  align="right" class="grisCCCCCC" > Rango de Fechas 
      de Radicaci&oacute;n<strong><font size="-1" face="Arial, Helvetica, sans-serif" class="style4"> 
      </font></strong></td>
    <td width="19%" height="15"  align="left" class="grisCCCCCC style1" ><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
      <font size="-1"> 
      <script language="javascript">
	dateAvailable.writeControl();
	dateAvailable.dateFormat="yyyy/MM/dd";
	</script>
      </font></font></td>
    <td height="15" colspan="3" align="left" class="grisCCCCCC style1" > <font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
      <font size="-1"> 
      <script language="javascript">
	dateAvailable2.writeControl();
	dateAvailable2.dateFormat="yyyy/MM/dd";
	</script>
      </font></font></td>
  </tr>
  <tr align="center"> 
    <td height="30" colspan="5" class="grisCCCCCC style1"> 
      <input name="Submit"  type="Submit" class="ebuttons2" value="BUSCAR"  >
     
    </td>
  </tr>
 
  <? 
	//echo"<input type='hidden' name='numdoc' value='$numdoc'>";
	$pnom=$pnomb;
    echo "";
?>
</table>

</form>
<p>&nbsp; </p>
<p>&nbsp;</p>
</body>
</html>
