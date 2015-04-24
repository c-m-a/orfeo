<?php 

$krd=strtoupper($krd);
include "config.php";
$fechah=date("dmy") . " ". time("h_m_s");
putenv("ORACLE_SID=$servicio");
putenv("ORACLE_HOME=$dirora");
$handle = ora_logon("$usuario@$servicio", "$contrasena");
ora_commiton($handle); 
$cursor = ora_open($handle);
$check=1;
$fechaf=date("dmy") . "_" . time("hms");
$numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
$isql = "select a.*,b.depe_nomb from usuario a,dependencia b where  USUA_LOGIN ='$krd' and a.depe_codi=b.depe_codi ";
$resultado = ora_parse($cursor,$isql);
$resultado = ora_exec($cursor);
$row=array();
ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
// Validacion de Usuario y COntraseña MD5
if (trim($row["USUA_LOGIN"])==trim($krd))
{	$dependencia=$row["DEPE_CODI"];
	$dependencianomb=$row["DEPE_NOMB"];
	$codusuario =$row["USUA_CODI"];
	$nombusuario =$row["USUA_NOMB"];		
	$contraxx=$row["USUA_PASW"];
	if($drd)	{$drde=md5($drd);}
	$nivelus=$row["CODI_NIVEL"];
	if($row["USUA_NUEVO"]=="1")
	{	if (trim($contraxx)==SUBSTR($drde,1,26))
		{	echo "<table width='580' border='0' cellspacing='1' cellpadding='0'>";
			echo "    <tr> ";
  			echo "      <td width=180  align='left' ><a href='contraxx.php?drde=$drde&krd=$krd&depsel=$dependencia' alt='Cambio de Contraseñas'><img src='iconos/icono_llave.gif' border=0></a></td><td> <a href='estadisticas.php?krd=$krd&drde=$drd'> E </a> </td>";
  			echo "      <td width='400'> ";
  			echo "        <table width='425' border='0' cellspacing='0' cellpadding='0'>";
  			echo "          <tr>";
	     	IF($nomcarpeta=="")
			 {
			      $nomcarpeta=" ENTRADA ";
			 }
			$img1="";$img2="";$img3="";$img4="";$img5="";$img6="";$img7="";$img8="";$img9="";
   			IF($ordcambio){IF($ascdesc=="DESC" ){$ascdesc="";	$imagen="flechaasc.gif";}else{$ascdesc="DESC";$imagen="flechadesc.gif";}}
		 	if($orno==1){$order=" radi_nume_radi $ascdesc";$img1="<img src='iconos/$imagen' border=0 alt='$data'>";}
			if($orno==2){$order=" radi_fech_radi $ascdesc";$img2="<img src='iconos/$imagen' border=0 alt='$data'>";}
			if($orno==3){$order=" ra_asun $ascdesc";$img3="<img src='iconos/$imagen' border=0 alt='$data'>";}
			if($orno==4){$order=" tdoc_desc $ascdesc";$img4="<img src='iconos/$imagen' border=0 alt='$data'>";}
			if($orno==5){$order=" nombres $ascdesc";$img5="<img src='iconos/$imagen' border=0 alt='$data'>";}
			if($orno==6){$order=" DIASR $ascdesc";$img6="<img src='iconos/$imagen' border=0 alt='$data'>";}
	 		if($orno==9){$order=" radi_usu_ante $ascdesc";$img9="<img src='iconos/$imagen' border=0 alt='$data'>";}
			if($orno==7){$order=" radi_leido desc ,radi_fech_radi";$img7=" <img src='iconos/flechanoleidos.gif' border=0 alt='$data'> ";}
			if($orno==8){$order=" radi_leido ,radi_fech_radi";$img7=" <img src='iconos/flechaleidos.gif' border=0 alt='$data'> ";}		 		 

  			$datosaenviar = "fechaf=$fechaf&tipo_carp=$tipo_carp&carpeta=$carpeta&drde=$drde&contrax=$drde&contra=$drde&usua=".md5($krd)."&ascdesc=$ascdesc&krd=$krd&orno=$orno&codusuario=$codusuario";
			echo "            <td background='iconos/base_t_1.gif' width='426' height='20'><font size='2' face='Arial, Helvetica, sans-serif'><b><font size='3' color='#BFDEEA'>-</font><font size='3'>Listado de $nomcarpeta  </font></td>";
			echo "          </tr>";
			echo "        </table>";
			echo "      </td>";
			echo "     <td width='120'> ";
			echo "       <a href='#' onClick='window.print();return false'><img src='img/img_print.gif' alt='Imprima toda esta p&aacute;gina' width='91' height='30' hspace='10' border='0' align='absmiddle'></a>";
			echo "      </td>";
			echo "    </tr>";
			echo "  </table>";
			echo "  <p>";
			echo "<table border=0 width=100%>";
			echo "<tr ><td width=95%>";
			ECHO "<span class='tpar'><font color=black><b>Documentos:</b>  </font></span> <a href='cuerpo.php?$datosaenviar&orno=7' alt='Ordenar Por Leidos'><span class='tpar'>Leídos  </span></a>$img7<a href='cuerpo.php?$datosaenviar&orno=8' alt='Ordenar Por Leidos'><span class='tparr'>No Leídos</span></a>     ";
			echo "";
			$iusuario = " and us_usuario='$krd'";
	
			// Solo Si el usuario es el administrador y esta en la carpeta por enviar le deja ver
			// el boton para enviar a dependencia de salida los documentos.
			if($carpeta==11  and $codusuario ==1)
			{	$carpetaenviar = "";	}
			else 
	 		{
      		// Si el usuario no es el administrador cuando selecciona la carpeta enviar
			// Se le aniade esta instruccion a la varible del sql que solo muestra los doc's 
			// Enviados por el usuario de lo contrario solo toma la dependencia  	   
	    		$carpetaenviar = " and a.radi_usua_actu=$codusuario ";
	 		}
	   		// Instruccion que realiza la consulta de radicados segun criterios
		 	// Tambien observamos que se encuentra la varialbe $carpetaenviar que maneja la carpeta 11.
		
		 	$limit = ""; 
			//" and rownum < " .($registro + 1);
			$isql = "select a.RADI_NUME_HOJA,a.RADI_FECH_RADI,a.RADI_NUME_RADI,a.RA_ASUN,a.RADI_PATH,a.RADI_USU_ANTE,concat(concat(a.RADI_NOMB, RADI_PRIM_APEL), RADI_SEGU_APEL) AS NOMBRES,TO_CHAR(a.RADI_FECH_RADI,'DD/MM/YY   HH:MIam') AS FECHA,b.tdoc_desc,b.tdoc_codi,b.tdoc_term,round(((radi_fech_radi+b.tdoc_term)-sysdate)*7/5) as diasr,RADI_LEIDO,RADI_TIPO_DERI,RADI_NUME_DERI from radicado a,tipo_documento b where a.carp_per=$tipo_carp and a.tdoc_codi=b.tdoc_codi and a.carp_codi=$carpeta and a.radi_depe_actu=$dependencia $carpetaenviar $limit order by $order ";
			echo "<form name='form1' action='enviardatos.php' method=post>     ";
			echo "<CENTER><table BORDER=0  cellpad=2 WIDTH=100% class='etitulos' valign='top'>     ";
	  		if($carpeta==11 and $codusuario==1)
	  		{
			  echo "<tr><td></td><td></td><td width='5'><input type=submit value='Enviar a Salida' name=salida align=bottom class=e_buttons></td></TR>     ";
			}
			echo "<TR><TD width='30%' valign='top'>Usuario<br><span class='etextou'>$nombusuario</span></TD><TD width='30%' valign='top'>Dependencia<br><span class='etextou'>".$row["DEPE_NOMB"]."</span> <br></TD>\n";
			echo "<td width='20%' valign='bottom' align='left' ><span class='etitulos'><b>\n";
			if($carpeta!=11 ) {echo "Acción a realizar</b></span><br>\n";}
			echo "<select name=enviara class='e_buttons'  language=javascript onchange='changedepesel()'>\n";
			echo "<option value='9' SELECTED>Reasignar </option>\n";	   
			echo "<option value='1'>Marcar Como Actual</option>\n";
			echo "<option value='6'>Proceso Pendiente </option>\n";
			echo "<option value='7'>Temporal-Terminado(Use Por enviar) </option>\n";
			echo "<option value='8'>Informar (Enviar copia de documentos)</option>\n";
			echo " <option value='10'>Carpetas Personales </option>\n";	   
			if($carpeta!=11)
			{	// No muestra la opcion por enviar si se encuetra en la carpeta 11
		    	echo "<option value='11'>Por Enviar </option>\n";	   
			}
		 	echo "</select><br>";
			ora_commiton($handle); 
			$cursor = ora_open($handle);
		    ora_parse($cursor,"select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_NOMB");
			ora_exec($cursor);
		    $numerot = ora_numrows($cursor);
			$row1 = array();	
			$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
			// Combo en el que se muestran las dependencias, en el caso  de que el usuario escoja reasignar.
			echo "<b><select name='depsel' class='e_buttons' > ";
			$dependencianomb=substr($dependencianomb,0,35);
			$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
			do 
	   		{
		    	$depcod = $row1["DEPE_CODI"];
		 		$depdes = substr($row1["DEPE_NOMB"],0,35);
				IF ($depcod==$dependencia)
				{	$datosdep = " selected "; }
				else {$datosdep="";}
				if($codusuario==1 or $datosdep !="")
				{
				  echo "<option value=$depcod $datosdep>$depdes</option>\n";
				}	
		 	}while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
	  		echo "</select>";
	  		// genera las dependencias para informar
		    ora_commiton($handle); 
		    $cursor = ora_open($handle);
		    ora_parse($cursor,"select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_NOMB");
	  		ora_exec($cursor);
	        $numerot = ora_numrows($cursor);
			$row1 = array();	
			echo "<b><select name='depsel8' class='e_buttons' >".chr(13);
			$dependencianomb=substr($dependencianomb,0,35);
     		$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	   		do 
	   		{
		    	$depcod = $row1["DEPE_CODI"];
		 		$depdes = substr($row1["DEPE_NOMB"],0,35);
				IF ($depcod==$dependencia)
				{	$datosdep = " selected "; }
				else {$datosdep="";}
				echo "<option value=$depcod $datosdep>$depdes</option>\n";
			}while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
	  		echo "</select>";

	  
	 		// Aqui se muestran las carpetas Personales
	 		ora_commiton($handle); 
     		$cursor = ora_open($handle);
 	    	$isql2 ="select CODI_CARP,DESC_CARP,NOMB_CARP from carpeta_per where usua_codi=$codusuario and depe_codi=$dependencia order by codi_carp  ";
		
			ora_parse($cursor,$isql2);
		    ora_exec($cursor);
		    echo "<select name='carpper' class='e_buttons' > ";
			$dependencianomb=substr($dependencianomb,0,35);
			$result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
	   		do
	   		{
			    $carpcod = $row1["CODI_CARP"];
			 	$carpdes = substr($row1["NOMB_CARP"],0,35);
				echo "<option value=$carpcod $datosdep>$carpdes</option>\n";
	  		}while($result1=ora_fetch_into($cursor,$row1, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
	 		echo "</select>";
		}
	}
}
?>
