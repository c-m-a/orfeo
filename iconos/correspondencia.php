<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="estilos_totales.css">
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" background="img/fondo_izq.gif">
<table width="173" border="0" cellspacing="0" cellpadding="0" height="100%">
  <tr> 
    <td background="img/img_menu_izq_r2_c1.gif" valign="top" width="173"> <img name="img_menu_izq_r1_c1" src="img/img_menu_izq_r1_c1.gif" width="173" height="57" border="0"> 
      <table width="140" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr> 
          <td> 
            <?php
//<meta http-equiv="Refresh" content="3;URL=http://www.algunsitio.com/nuevo.html">, 
  $servidor = "localhost";
	$bd = "bdprueba";
	$usuario = "root";
	$contrasena= "jhlc";
	putenv("ORACLE_SID=DBPRUEBA");
	putenv("ORACLE_HOME=/oracle1/product/817");
  $handle = ora_logon("fldoc@bdprueba", "Fldoc");
	ora_commiton($handle); 
	$cursor = ora_open($handle);
	
	
	  
	 
   $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
	 echo "<center><table border=0 width=75%>";
	 echo "<td width=100%>";
	 echo "<br>";

   $isql = "select a.*,b.depe_nomb from usuario a,dependencia b where USUA_LOGIN ='$krd' and a.depe_codi=b.depe_codi";
	 //$isql = "select * from usuario , where USUA_LOGIN ='$krd'";
	   $resultado = ora_parse($cursor,$isql);
	 $resultado = ora_exec($cursor);
	 $row=array();
   ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
   //echo $row["usuario"].$krd;
	 echo "<font size=1 face=verdana>";
	 if (trim($row["USUA_LOGIN"])==trim($krd))
		{
		
		
		$contraxx=$row["USUA_PASW"];
				
		  if (trim($contraxx)==SUBSTR(md5(trim($drd)),1,26))
			  {
		$dependencia=$row["DEPE_CODI"];
		$codusuario =$row["USUA_CODI"];
		$contraxx=$row["USUA_PASW"];
	  $iusuario = " and us_usuario='$krd'";
    $isql ="select * from carpeta order by carp_codi ";
	
		//$isql ="select * from radicado_rd where rd_estado=5 $iusuario ";
   // $result1 = ora_do($handle,$isql);
	ora_parse($cursor,$isql);
	ora_exec($cursor);
  $numerot = ora_numrows($cursor);
	
	 $row = array();

   while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	 { $row1 = array();
       //$data = trim(ora_getcolumn($cursor, 1));
			 $data = trim($row["CARP_DESC"]);
			 $numdata =  trim($row["CARP_CODI"]);
       if($data=="") $data = "NULL";
			 	putenv("ORACLE_SID=DBPRUEBA");
				putenv("ORACLE_HOME=/oracle/product/817");
				$handle1 = ora_logon("fldoc@bdprueba", "Fldoc");
				ora_commiton($handle1); 
				$cursor1 = ora_open($handle1);
				
				$isql="select count(*) from radicado where carp_codi=$numdata and  radi_depe_actu=$dependencia and radi_usua_actu=$codusuario ";		
				//echo $isql;
				ora_parse($cursor1,$isql);
        ora_exec($cursor1);
		    //$numerot = ora_numrows($cursor1);
	      //echo $numerot;
				$numerot = ora_getcolumn($cursor1, 0);
				echo "-- $numdata - $carpeta";
       if($carpeta==$numdata){$imagen="folder_open.gif";}else{$imagen="carpeta.gif";}
       echo "<a href='cuerpo.php?carpeta=$numdata&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd' target='mainFrame' alt='Seleccione una Carpeta'><img src='iconos/$imagen' border=0 alt='$data' align='absmiddle'> <font size=1><b>$data ($numerot)</font></a> <p>"; 
   }
	 $imagen="radicar.gif";
	 echo "<a href='cuerpo.php?carpeta=$numdata&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd' target='mainFrame' alt='Seleccione una Carpeta'><img src='iconos/$imagen' border=0 alt='$data' align='absmiddle'> <font size=1><b>Radicaci&oacute;n</font></a> <p>"; 
	 ORA_CLOSE($cursor1);
	//$isql = "INSERT INTO USUARIO (USUA_CODI,DEPE_CODI,USUA_LOGIN,USUA_PASW,USUA_ESTA,usua_fech_crea)";
	//$isql .="VALUES(99,1,'jh2','". substr(md5("jhlc"),1,26) ."','1',to_date('".date("d-m-y")."','dd-mm-yy'))";
	//ECHO $isql;
		//$TT =ora_parse($cursor,$isql) or die ("No se pudo Agregar Usuario1");
	  //$TT =ora_exec($cursor) or die ("No se pudo Agregar Usuario2");
		

		
   echo "</td>";
	 echo "<td width=65%>";
	
	 
	  $row = array();
  }
	}

//*********************TRANSACCIONES DEL CURSOR DE CONSULTA PRIMARIA**************************************************************************************************

?>
          </td>
        </tr>
        <tr> 
          <td> 
            <p align="center"><img src="img/img_logo_sspd.gif" width="100" height="75"></p>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</body>
</html>
