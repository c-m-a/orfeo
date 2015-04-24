<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
<link rel="stylesheet" href="estilos_totales.css">
</head>
<body>
<?php
//<meta http-equiv="Refresh" content="3;URL=http://www.algunsitio.com/nuevo.html">, 
  $servidor = "localhost";
	$bd = "bdprueba";
	$usuario = "root";
	$contrasena= "jhlc";
	putenv("ORACLE_SID=DBPRUEBA");
	putenv("ORACLE_HOME=/orant");
  $handle = ora_logon("fldoc@bdprueba", "Fldoc");
	ora_commiton($handle); 
	$cursor = ora_open($handle);
	
	
	  
	 
   $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
	 echo "<center></center>";
   echo "<table border=0 width=100% >";
	 echo "<tr class='e_tablas'><td width=85%>";
	 echo "<br>";
   $isql = "select a.USUA_LOGIN,a.USUA_PASW,a.USUA_codi,a.DEPE_CODI,b.depe_nomb from usuario a,dependencia b where USUA_LOGIN ='$krd' and a.depe_codi=b.depe_codi ";
	 $resultado = ora_parse($cursor,$isql);
	 $resultado = ora_exec($cursor);
	 $row=array();
   ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
   //echo $row["usuario"].$krd;
	 
	 if (trim($row["USUA_LOGIN"])==trim($krd))
		{
		$dependencia=$row["DEPE_CODI"];
		$contraxx=$row["USUA_PASW"];
				
		  if (trim($contraxx)==SUBSTR(md5(trim($drd)),1,26))
			  {
      echo "<CENTER><table BORDER=0 WIDTH=85%><TR><TD><font size=3><b>Usuario<FONT COLOR='#9999cc'> ".$row["USUA_LOGIN"]."</FONT> </TD><TD><B> Dependencia <FONT COLOR='#9999cc'><B>".$row["DEPE_NOMB"]."</FONT><br></TD></TR></TABLE>";
	  $iusuario = " and us_usuario='$krd'";
     $isql = "select a.*,b.trte_desc from radicado a,tipo_remitente b where a.trte_codi=b.trte_codi and carp_codi=$carpeta and radi_depe_actu=$dependencia and radi_nume_radi=$radicado";
	  //echo $isql;
		//$isql ="select * from radicado_rd a , tipo_remitente b where rd_estado=5 $iusuario ";
   // $result1 = ora_do($handle,$isql);
	ora_parse($cursor,$isql);
	ora_exec($cursor);
  $numerot = ora_numrows($cursor);
	$imagen="flechaabajo.bmp";
	 $row = array();
			 echo "<CENTER><table  WIDTH=90%>";
			 			 echo "<tr>";
			 echo "<th>";
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd&order=radicado' alt='Seleccione una busqueda'><img src='iconos/$imagen' border=0 alt='$data'><font size=3 color=blue><b>Numero Radicado</font></a> <br>";
			 echo "</th>";
			 echo "<th>";
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd&order=fecha'  alt='Seleccione una busqueda'><img src='iconos/$imagen' border=0 alt='$data'><font size=3 color=blue><b>Fecha Radicado</font></a> <br>";
			 echo "</th>";
			 echo "<th>";
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd&order=remitente'  alt='Seleccione una busqueda'><img src='iconos/$imagen' border=0 alt='$data'><font size=3 color=blue><b>Tipo de Remitente</font></a> <br>";
			 echo "</th>";
			 echo "<th>";
       echo "Nombre";
			 echo "</th>";
			 echo "</tr>";
   while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	 { $row1 = array();
       //$data = trim(ora_getcolumn($cursor, 1));
			 $data = trim($row["RADI_NUME_RADI"]);
			 $numdata =  trim($row["CARP_CODI"]);
       if($data =="") $data = "NULL";
			 //$numerot = ora_numrows($cursor2);
			 $numerot = $row1["num"];
			 if($carpeta==$numdata){$imagen="usuarios.gif";}else{$imagen="usuarios.gif";}

			 echo "<tr>";
			 echo "<td>";
       echo "<a href='datosrad.php?radicado=".$row["RADI_NUME_RADI"]."&carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd' ><img src='iconos/$imagen' border=0 alt='$data'><font size=1><b>$data </font></a> <br>";
			 echo "</td>";
			 echo "<td>";
       echo $row["RADI_FECH_RADI"];
			 echo "</td>";
			 			 echo "<td>";
       echo $row["TRTE_DESC"];
			 echo "</td>";
			 echo "<td>";
       echo $row["RADI_PRIM_APEL"] . " ". $row["RADI_SEGU_APEL"]." ". $row["RADI_NOMB"];
			 echo "</td>";
			 echo "</tr>";

 
   }
	 echo "</table>";
	 echo "Reasignar Trabajo a Dependencia "; 
	//$isql = "INSERT INTO USUARIO (USUA_CODI,DEPE_CODI,USUA_LOGIN,USUA_PASW,USUA_ESTA,usua_fech_crea)";
	//$isql .="VALUES(99,1,'jh2','". substr(md5("jhlc"),1,26) ."','1',to_date('".date("d-m-y")."','dd-mm-yy'))";
	//ECHO $isql;
		//$TT =ora_parse($cursor,$isql) or die ("No se pudo Agregar Usuario1");
	  //$TT =ora_exec($cursor) or die ("No se pudo Agregar Usuario2");
		

		
   echo "</td>";
	 echo "<td width=15%>";
	
	 
	  $row = array();
  }
	}

	

  	      

?>
</body>
</html>
