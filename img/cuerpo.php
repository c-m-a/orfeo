<html>
<head>
<title>Untitled Document</title>
<link rel="stylesheet" href="estilos_totales.css">
</head>

<body bgcolor="#FFFFFF">
<div align="center"> 
  <p><img src="img/tit_listado_corresp.gif" width="662" height="21"> <a href="#" onClick="window.print();return false"><img src="img/img_print.gif" width="91" height="30" align="absmiddle" hspace="5" border="0" alt="Imprima toda esta p&aacute;gina"></a></p>
  <p> 
    <?php
//<meta http-equiv="Refresh" content="3;URL=http://www.algunsitio.com/nuevo.html">,
 echo "";
 $myvar=str_pad('55',15,"0",STR_PAD_left);
 echo $myvar; 
  $servidor = "localhost";
	$bd = "bdprueba";
	$usuario = "root";
	$contrasena= "jhlc";
	putenv("ORACLE_SID=DBPRUEBA");
	putenv("ORACLE_HOME=/oracle1/product/817");
  $handle = ora_logon("fldoc@bdprueba", "Fldoc");
	ora_commiton($handle); 
	$cursor = ora_open($handle);
	$check=1;
	
	  
	 
   $numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
	 echo "<table border=0 width=100% >";
	 echo "<tr ><td width=95%>";
	 echo "<br>";
   $isql = "select a.USUA_LOGIN,a.USUA_PASW,a.USUA_CODI,a.DEPE_CODI,b.depe_nomb from usuario a,dependencia b where USUA_LOGIN ='$krd' and a.depe_codi=b.depe_codi";
	 $resultado = ora_parse($cursor,$isql);
	 $resultado = ora_exec($cursor);
	 $row=array();
   ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
   //echo $row["usuario"].$krd;
	 if (trim($row["USUA_LOGIN"])==trim($krd))
		{
		$dependencia=$row["DEPE_CODI"];
		$codusuario =$row["USUA_CODI"];
		$contraxx=$row["USUA_PASW"];
				
		  if (trim($contraxx)==SUBSTR(md5(trim($drd)),1,26))
			  {

	  $iusuario = " and us_usuario='$krd'";
     $isql = "select a.*,b.trte_desc from radicado a,tipo_remitente b where a.trte_codi=b.trte_codi and carp_codi=$carpeta and radi_depe_actu=$dependencia and radi_usua_actu=$codusuario";
		 //echo $isql;
	  //echo $isql;
		//$isql ="select * from radicado_rd a , tipo_remitente b where rd_estado=5 $iusuario ";
   // $result1 = ora_do($handle,$isql);
	 	 	 echo "<form action='enviardatos.php' method=post>";
	 	 echo "<CENTER><table BORDER=0 WIDTH=85%><TR><TD width='30%'><font size=2><b>Usuario<br><FONT COLOR='#9999cc'> ".$row["USUA_LOGIN"]."</FONT> </TD><TD  width='30%'><B> Dependencia<br> <FONT COLOR='#9999cc'><B>".$row["DEPE_NOMB"]."</FONT><br></TD>";
   echo "<td width='10%'><b>Accion <select name=enviara class='e_buttons'>";
	   echo "<option value='1'>Marcar Como Actual</option>";
	   echo "<option value='9'>Reasignar</option>";
	   echo "<option value='6'>Proceso Pendiente</option>";
	   echo "<option value='7'>Proceso Terminado</option>";
		 
		 
		 echo "</select></td><td width=2%><b><font size=4>a</font></td><td width='5%'>";
		 putenv("ORACLE_SID=DBPRUEBA");
	putenv("ORACLE_HOME=/oracle1/product/817");
  $handle = ora_logon("fldoc@bdprueba", "Fldoc");
	ora_commiton($handle); 
	$cursor = ora_open($handle);
		 ora_parse($cursor,"select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_NOMB");
	   ora_exec($cursor);
     $numerot = ora_numrows($cursor);$row1 = array();	
		 
		
		 
		//Ana Helena 3106073256
		 echo "<b>Dependencia <select name='dependencia' class='e_buttons'> ";
	   DO
	   {
		    $depcod = $row1["DEPE_CODI"];
		 		$depdes = $row1["DEPE_NOMB"];

				echo "<option value=$depcod>$depdes</option>";
		 }while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
		 		echo "<option value='99'>Ninguna</option>";
	   echo "</select>";		 	  
	 echo "</select></td><td width='5%'><input type=submit value='Enviar' valign='bottom' class='e_buttons'></td></TR></TABLE>";

	ora_parse($cursor,$isql);
	ora_exec($cursor);
  $numerot = ora_numrows($cursor);
	$imagen="img_flecha_sort.gif";
	 $row = array();

		 echo "<input type=hidden name=contra value=".md5($drd).">";
		 echo "<input type=hidden name=sesion value=".md5($krd).">";		 
		 echo "<input type=hidden name=krd value=$krd>";
 		 echo "<input type=hidden name=drd value=$drd>";
		 echo "<input type=hidden name=carpeta value=$carpeta>";
			 echo "<CENTER><table border=0 cellspace=1 cellpad=2 WIDTH=95% >";
			 echo "<tr class='tencabezado'>";
			 echo "<th width='10%'>";
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd&order=radi_nume_radi'  alt='Seleccione una busqueda'> Numero Radicado</font></a> <br>";
			 echo "</th>";
			 
			 echo "<th  width='10%'>";
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd&order=radi_fech_radi' alt='Seleccione una busqueda'><img src='iconos/$imagen' border=0 alt='$data'> Fecha Radicado</a> <br>";
			 echo "</th>";
			 		 echo "<th  width='30%'>";
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd&order=ra_asun'  alt='Seleccione una busqueda'><img src='iconos/$imagen' border=0 alt='$data'> Asunto</a> <br>";
			 echo "</th>";	
			 echo "<th  width='15%'>";
       echo "<a href='cuerpo.php?carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd&order=trte_codi'  alt='Seleccione una busqueda'><img src='iconos/$imagen' border=0 alt='$data'> Tipo de Remitente</a> <br>";
			 echo "</th>";
			 echo "<th  width='15%'>";
       echo "Nombre";
			 echo "</th>";
			 if($codusuario=1){
			 echo "<th  width='5%'>";
       echo "<input type='checkbox' name='marcartodos' id=mt>";
			 echo "</th>";
			 }
			 echo "</tr>";$row = array();
			 $i = 1;
   while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	 { 
	   
       //$data = trim(ora_getcolumn($cursor, 1));
			 $data = trim($row["RADI_NUME_RADI"]);
			 $numdata =  trim($row["CARP_CODI"]);
       if($data =="") $data = "NULL";
			 //$numerot = ora_numrows($cursor2);
			 $numerot = $row1["num"];
			 if($carpeta==$numdata){$imagen="usuarios.gif";}else{$imagen="usuarios.gif";}
             if($i==1){
			    echo "<tr class='timpar'>";
				$i=2;
			 }else{
			    echo "<tr class='tpar'>";
				$i=1;
			 }
			 
			 echo "<td ><font size=1>";
       echo "<a href='datosrad.php?radicado=".$row["RADI_NUME_RADI"]."&carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd' ><img src='iconos/$imagen' border=0 alt='$data'>$data </a> <br>";
			 echo "</td>";
			 echo "<td  >";
       echo $row["RADI_FECH_RADI"];
			 echo "</td>";
			 echo "<td  >";
       echo $row["ra_asun"];
			 echo "</td>";
			 echo "<td  >";
       echo $row["TRTE_DESC"];
			 echo "</td>";
			 echo "<td >";
       echo $row["RADI_PRIM_APEL"] . " ". $row["RADI_SEGU_APEL"]." ". $row["RADI_NOMB"];
			 echo "</td>";
			 if( $check<20){
			 echo "<td>";
       //echo "<a href='reasignar.php?radicado=$data&carpeta=$carpeta&contra=".md5($drd)."&usua=".md5($krd)."&drd=$drd&krd=$krd'>OK</a>";
			 echo "<input type='checkbox' value=$data name='chk$check'>";
			 $check=$check+1;
			 echo "</td>";
			 }
			 
			 echo "</tr>";

 
   }
	 echo "</table>"; 
	 echo "</form>";


	//$isql = "INSERT INTO USUARIO (USUA_CODI,DEPE_CODI,USUA_LOGIN,USUA_PASW,USUA_ESTA,usua_fech_crea)";
	//$isql .="VALUES(99,1,'jh2','". substr(md5("jhlc"),1,26) ."','1',to_date('".date("d-m-y")."','dd-mm-yy'))";
	//ECHO $isql;
		//$TT =ora_parse($cursor,$isql) or die ("No se pudo Agregar Usuario1");
	  //$TT =ora_exec($cursor) or die ("No se pudo Agregar Usuario2");
		

		
   echo "</td>";
	 echo "<td width=15%>";
	
	 
	  $row = array();
  

	

  	      
					}Else {echo "<center><b><span class='e_errores'>NO AUTORIZADO EL INGRESO</span><BR><a href='login.php' target=_parent> 'Por Favor Intente de nuevo'</a>";}
			}Else {echo "<center><b><span class='e_errores'>NO AUTORIZADO EL INGRESO</span><BR><a href='login.php' target=_parent> 'Por Favor Intente de nuevo'</a>";}
	
?>
  </p>
</div>

</body>
</html>
