<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Untitled</title>
</head>
<body>
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
	 echo "<center>DocuImage - WEB <BR> CONTROL DOCUMENTOS DE CORRESPONDENCIA</center>";
   echo "<table border=1 width=100%>";
	 echo "<td width=55%>";
	 echo "<br>";

   $isql = "select USUA_LOGIN,USUA_PASW from usuario where USUA_LOGIN ='$krd'";
	 
   $resultado = ora_parse($cursor,$isql);
	 $resultado = ora_exec($cursor);
	 $row=array();
   ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
   //echo $row["usuario"].$krd;
	 echo "<font size=1>Usuario ".$row["USUA_LOGIN"]."<br>";
	 if (trim($row["USUA_LOGIN"])==trim($krd))
		{
		
		
		$contraxx=$row["USUA_PASW"];
				
		  if (trim($contraxx)==SUBSTR(md5(trim($drd)),1,26))
			  {

	  $iusuario = " and us_usuario='$krd'";
     $isql = "select * from radicado where carp_codi=$carpeta";
	   echo $isql;
		//$isql ="select * from radicado_rd where rd_estado=5 $iusuario ";
   // $result1 = ora_do($handle,$isql);
	ora_parse($cursor,$isql);
	ora_exec($cursor);
  $numerot = ora_numrows($cursor);
	
	 $row = array();
			 echo "<table border=1>";
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
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd' ><img src='iconos/$imagen' border=0 alt='$data'><font size=1><b>$data </font></a> <br>";
			 echo "</td>";
			 echo "<td>";
       echo $row["RADI_FECH_RADI"];
			 echo "</td>";
			 echo "</tr>";

 
   }
	 echo "</table>"; 
	//$isql = "INSERT INTO USUARIO (USUA_CODI,DEPE_CODI,USUA_LOGIN,USUA_PASW,USUA_ESTA,usua_fech_crea)";
	//$isql .="VALUES(99,1,'jh2','". substr(md5("jhlc"),1,26) ."','1',to_date('".date("d-m-y")."','dd-mm-yy'))";
	//ECHO $isql;
		//$TT =ora_parse($cursor,$isql) or die ("No se pudo Agregar Usuario1");
	  //$TT =ora_exec($cursor) or die ("No se pudo Agregar Usuario2");
		

		
   echo "</td>";
	 echo "<td width=45%>";
	
	 
	  $row = array();
  

	

  	      
				}
			}
	
?>
</body>
</html>
