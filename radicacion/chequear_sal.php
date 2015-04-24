<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<link href="../estilos_totales.css" rel="stylesheet" type="text/css">
</head>
<body topmargin="0" bgcolor="#FFFFFF">
<? error_reporting(0); session_start(); ?> 
<form name="formulario1" method="post" action=chequear.php?<?=session_name()."=".session_id()?>>
  <!--<input name="buscareesp" type="text" class="ecajasfecha" size="20" value=<?php  echo "buscareesp"; ?>>
   <input name="buscareespbot" type=submit class="ebuttons2" value="Limitar EESP">--> 
</form>
<form name="formulario" method="post" action=chequear.php?<?=session_name()."=".session_id()?>>
<?php  
   
   echo $dependencia;
   echo "<input type=hidden name=drde value=$drde>";
   echo "<input type=hidden name=krd value=$krd>";
?>
	 
  <div align="center">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="t_bordeGris">
      <tr align="center"> 
        <td class="tituloListado" height="25">VERIFICAR RADICACION PREVIA</td>
      </tr>
    </table>
    <br>
    <table width="100%" border="0" cellspacing="1" cellpadding="2" class="t_bordeGris">
      <TR>
        <td width="25%" class="grisCCCCCC" height="30" ><span class="etextomenu">LIMITE 
          EMPRESAS POR: <strong>Nombre(Opcional)</strong></span><br> 
        </td>
        <td  class="celdaGris" width="50%" height="30"> 
          <input name="buscareesp" type="text" class="ecajasfecha" size="20" value=<?php  echo "$buscareesp"; ?>>
          
		  
          </td>
        <td width="25%" align="center" class="celdaGris" height="30"> 
          <input name="buscareespbot" type=submit class="ebuttons2" value="RECARGAR">
        </td>
      </tr>
		</table>
		
    <br>
    <table width="100%" border="0" cellspacing="1" cellpadding="1" class="t_bordeGris">
        <td colspan="4" width="25%" align="Center" height="25" class="grisCCCCCC" ><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
          <strong><b>Buscar Por</b></strong></font> <font size="-1">
          <input type="radio" value=1 name=busq1>
          Cuenta Interna, Oficio, Referencia  
          <input type="radio" value=2 name=busq2>
          No. Radicado 
          <input type="radio" value=3 name=busq3>
          Identificacion (T.I.,C.C.,Nit) 
          <input type="radio" value=4 name=busq4>
          Nombres</font> </td>
      </tr>
      <TR> 
        <TD   align=right height="25" width="25%" class="grisCCCCCC"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
          NOMBRE</font></TD>
        <TD height="25" width="25%" class="celdaGris" > <?php
	INCLUDE "../config.php";
	putenv("ORACLE_SID=$servicio");
	putenv("ORACLE_HOME=$dirora");
  $handle = ora_logon("$usuario@$servicio", "$contrasena");
  $cursor = ora_open($handle);
	ora_commiton($handle); 
 if($tip_rem==1){
 
 if($buscareesp){
   $datoadd =" where eesp_nomb like '%".STRTOUPPER($buscareesp)."%' ";
                }
		elseif ($buscarem){
		   $datoadd =" where eesp_rep_leg like '%".STRTOUPPER($buscarem)."%' ";

		              }						
 else{$datoadd="";}
 $query2="select essp_nit,eesp_nomb,eesp_codi,eesp_dire, eesp_rep_leg from empresa_esp $datoadd order by eesp_nomb";
 ora_parse($cursor, $query2) or die ("no hay consulta"); 
 ora_exec($cursor); $i=0;
 //norma n1 no comentar el codigo ..hace lenta una aplik :-) 
 echo "<select name='pcodi' class='ecajasfecha'>";
 echo "<option value='' selected></option>";
 			while(ora_fetch($cursor)) {

 	 		$esspcod = trim(ora_getcolumn($cursor, 2));
			$adress= trim(ora_getcolumn($cursor, 3));
			$rem2= trim(ora_getcolumn($cursor, 4));
 	 		$espnomb=substr(ora_getcolumn($cursor, 1),0,60);
      if ($pcodi == $esspcod){
          echo "<option value='$esspcod' selected>$espnomb</option>";
					$pnomb = $espnomb;
		 			$numdoc = trim(ora_getcolumn($cursor, 0));
			      }else{
          echo "<option value='$esspcod'>$espnomb</option>";
         }
	}
			
  echo" </select>";

 		echo"<input type='hidden' name='pnom' value='$pnomb'>";
	//echo"<input type='hidden' name='numdoc' value='$numdoc'>";
	$pnom=$pnomb;
	}   else   {          
  		echo "<input type='text' name='pnom' size='30' class='ecajasfecha' value='$pnom'>";
	}
 
?> 
          <script> 						 
function dock(formulario)
{
formulario.submit();
}						  
</script>
        </TD>
        <TD align=right height="25" width="25%" class="grisCCCCCC"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
          N&ordm; RADICADO</font></TD>
        <TD height="25" width="25%" class="celdaGris" > 
          <input name="noradicado" type="text" class="ecajasfecha" id="sapl" size="16" value="<? echo $noradicado;?>">
        </TD>
      </TR>
      
      <tr> 
        <td width="25%" height="25" align="right" class="grisCCCCCC"><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
          PRIMER APELLIDO</font></td>
        <td width="25%" height="25" class="celdaGris" > 
          <input name="papl" type="text" class="ecajasfecha" id="papl6" size="20" value="<? echo $papl;?>">
        </td>
        <td width="25%" height="25" align="right" class="grisCCCCCC" ><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
          SEGUNDO APELLIDO</font></td>
        <td width="25%" height="25" class="celdaGris" > 
          <input name="sapl" type="text" class="ecajasfecha" id="sapl6" size="20" value="<? echo $sapl;?>">
        </td>
      </tr>
      <tr> 
        <td width="25%" height="25" align="right" class="grisCCCCCC" ><font face="Arial, Helvetica, sans-serif" class="etextomenu"> 
          TIPO DE DOCUMENTO</font></td>
        <td width="25%" height="25" class="celdaGris" ><strong><font color="">&nbsp; 
          <select name="tip_doc" class="ecajasfecha">
            <?php
	        if($tip_rem==1){
					    echo "<option value='4' $datotip >NIT</option>";
						if($tip_doc=="5"){$datotip= " selected ";}else{$datotip="";}
					    echo "<option value='5' $datotip >NUIR</option>";
					}
	        if($tip_rem==2){
						if($tip_doc=="4"){$datotip= " selected ";}else{$datotip="";}
					    echo "<option value='4' $datotip >NIT</option>";
					}
	        if($tip_rem==3){
	 					if($tip_doc=="0"){$datotip= " selected ";}else{$datotip="";}
					    echo "<option value='0' $datotip >CC</option>";
						if($tip_doc=="1"){$datotip= " selected ";} else{$datotip="";}
					  echo "<option value='1' $datotip >TI</option>";
						if($tip_doc=="2"){$datotip= " selected ";}else{$datotip="";}
					    echo "<option value='2' $datotip >CE</option>";
						if($tip_doc=="3"){$datotip= " selected ";}else{$datotip="";}
					    echo "<option value='3' $datotip >PASAPORTE</option>";
					}
 
    ?> 
          </select>
          </font></strong></td>
        <td width="25%" height="25" align="right"  class="grisCCCCCC"> <font face="Arial, Helvetica, sans-serif" class="etextomenu">NUMERO 
          ID</font></td>
        <td width="25%" height="25" class="celdaGris" ><strong> 
          <input name="numdoc" type="text" class="ecajasfecha" id="numdoc6" size="20" value="<? echo $numdoc;?>">
          <input type="hidden" value=2 name=primera>
          <?php echo"<input type='hidden' name='usr' value='$usr'>";
           echo"<input type='hidden' name='ent' value='$ent'>";
          echo"<input type='hidden' name='depende' value='$depende'>";
           echo"<input type='hidden' name='contra' value='$contra'>";
      		  echo"<input type='hidden' name='codusuario' value='$codusuario'>";
		 //echo"<input type='hidden' name='buscareesp' value='$buscareesp'>";
          
           ?> </strong></td>
      </tr>
      <tr> 
        <td align="right" class="grisCCCCCC"><font face="Arial, Helvetica, sans-serif" class="etextomenu">NOMBRE 
          REMITENTE</font></td>
        <td colspan="3" class="celdaGris" > 
          <input name="papl2" type="text" class="ecajasfecha" id="papl" size="30" value="<? echo $remitente;?>">
        </td>
      </tr>
      <tr align="center"> 
        <td colspan="4" class="grisCCCCCC" height="30"> 
          <input name="Submit" type="submit" class="ebuttons2" value="BUSCAR">
          <!--<input type="reset" value="BORRAR" class="ebuttons2">--> </td>
      </tr>
    </table>
  </div>
</form>
<form name="form1" method="post" action=NEW.PHP?<?=session_name()."=".session_id() ?>>
<input type='hidden' name='cuentai' value='<?=$cuentai?>'>
  <tr> 
      <td colspan="3"> <div align="center">
	  <?php
		if($Submit){
		?>
	    <table border=0 width=100% class="t_bordeGris" cellspacing="0">
          <tr align="center"> 
            <td height="25"><FONT face="Verdana, Arial, Helvetica, sans-serif" SIZE=3 class="tituloListado" > 
              RADICAR COMO...</FONT></td>
</tr></Table>
	    <br>
        <table border=0 width=100% class="t_bordeGris">
          <tr align="center"> 
            <td width="33%" class="celdaGris" height="25"> 
              <input name="noradicar1" type=submit class="ebuttons2" value="SOLO DATOS (Copia)">
            </td>
            <td width="33%" class="celdaGris" height="25"> 
              <input name="noradicar" type=submit class="ebuttons2" value="COMO ANEXO">
            </td>
            <td width="33%" class="celdaGris" height="25"> 
              <input name="noradicar2" type=submit class="ebuttons2" value=" ASOCIADO">
            </td></tr>
		</table>
		
        <?php
		}
$accion="&accion=buscar";
$variables = "&pnom=".strtoupper($pnom)."&papl=".$papl."$sapl=".$sapl."&numdoc=".$numdoc.$accion;
$target="_parent";
$hoy = date('d/m/Y');

$hace_catorce_dias = date ('d/m/Y', mktime (0,0,0,date('m'),date('d')-14,date('Y')));
$where ="  a.radi_nume_radi>2000 ";
// **** limite de Fecha 
//(radi_fech_radi <= to_date('". $hoy . " 23:59:59','dd/mm/yyyy hh24:mi:ss') and radi_fech_radi >= to_date('" . $hace_catorce_dias .  "23:59:59','dd/mm/yyyy hh24:mi:ss') )
$dato1=1;

if($cuentai){ $where .= " and a.radi_cuentai like '%$cuentai%' ";}
if($noradicado){ $where .= " and a.radi_nume_radi like '%$noradicado%' ";}
if($pnom){ $where .= " and  b.sgd_ciu_nombre like '%". strtoupper($pnom) .  "%' ";}
if($papl){ $where .= " and  b.sgd_ciu_apell1 like '%". strtoupper($papl) ."%'";
if($sapl){ $where .= " and  b.sgd_ciu_apell2 like '%" . strtoupper($sapl) . "%' " ;}
$where .= ")";
}
$dato=2;
echo "</table>";
if($primera!=1 and $Submit=="BUSCAR" and ($pnom or $cuentai or $noradicado or $radi_prim_apel or $radi_segu_apel ) ){

  $iusuario = " ";
	
	// Solo Si el usuario es el administrador y esta en la carpeta por enviar le deja ver
	// el boton para enviar a dependencia de salida los documentos.
	if($carpeta==11  and $codusuario ==1)
	{
	   
	    $carpetaenviar = "";
	 } else 
	 {
      // Si el usuario no es el administrador cuando selecciona la carpeta enviar
			// Se le añade esta instruccion a la varible del sql que solo muestra los doc's 
			// Enviados por el usuario de lo contrario solo toma la dependencia  	   
	    $carpetaenviar = "  ";
	 }
	   // Instruccion que realiza la consulta de radicados segun criterios
		 // Tambien observamos que se encuentra la varialbe $carpetaenviar que maneja la carpeta 11.
		
		 $limit = ""; 
		 //" and rownum < " .($registro + 1);
	   $isql = "select c.PLT_CODI,c.PLG_ARCHIVO_FINAL,c.RADI_NUME_SAL
	   			,a.RADI_NUME_HOJA,a.RADI_FECH_RADI,a.RADI_NUME_RADI,a.RA_ASUN,a.RADI_PATH,a.RADI_USU_ANTE
	            ,concat(concat(a.RADI_NOMB, RADI_PRIM_APEL), RADI_SEGU_APEL) AS NOMBRES,TO_CHAR(a.RADI_FECH_RADI,'DD/MM/YY   HH:MIam') AS FECHA
			    ,b.tdoc_desc,b.tdoc_codi,b.tdoc_term,round(((radi_fech_radi+(b.tdoc_term * 7/5))-sysdate)) as diasr
			    ,RADI_LEIDO,RADI_TIPO_DERI,RADI_NUME_DERI
			   from radicado a,tipo_documento b,PL_GENERADO_PLG c 
			   where a.radi_nume_radi=c.radi_nume_radi AND plt_codi>=2
			    and a.tdoc_codi=b.tdoc_codi  and 
			   a.radi_depe_actu=$dependencia and a.radi_nume_radi=$noradicado order by $order ";
			   echo $isql;
			    ?>
	   
          <td height="3"> 
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
              <tr>
                <td width="11%"><img src="../imagenes/listar.gif" width="73" height="20"></td>
                <td width="89%"> <a href='cuerpopdf.php?<?=SID ?>&<? echo "fechah=$fechah&orno=7"; ?>' alt='Ordenar Por Leidos'><span class='tpar'>Impresos</span></a> 
                  <?=$img7 ?>
                  <a href='cuerpopdf.php?<?=SID ?>&<? echo "fechah=$fechah&orno=8"; ?>' alt='Ordenar Por Leidos' class="tparr"><span class='tparr'> 
                  Por Imprimir</span></a></td>
              </tr>
            </table>
		</td>
      </tr>
    </table>
      <form name='form1' action='imprimir_pdf.php?<?=session_name()."=".session_id() ?>' method=post target='pdf_<? echo date("dmy_h_m_s");  ?>'>
	    <table BORDER=0  cellpad=2 cellspacing='1' WIDTH=98% class='t_bordeGris' valign='top' align='center' >
          <? 
  	if($carpeta==11 and $codusuario==1){
		  ?> 
          <tr align="center" > 
            <td colspan="2" height="25"> 
              <input type=submit value='ENVIAR A SALIDA' name=salida align=bottom class=ebuttons2>
            </td>
          </TR>
          <?
		}
	   ?> 
          <TR > 
            <TD width='50%' height="6" > 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="10%"><img src="../imagenes/usuario.gif" width="58" height="20"></td>
                  <td width="90%"><span class='etextou'><?=$nombusuario ?></span></td>
                </tr>
              </table>
            </td>
            <td height="6">  
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="16%"><img src="../imagenes/dependencia.gif" width="87" height="20"></td>
                  <td width="84%"><span class='etextou'><?=$depe_nomb ?></span></td>
                </tr>
              </table>
            </TD>
          </tr>
        </table>
        <TABLE><TD></TD></TABLE>
		<table BORDER=0  cellpad=2 cellspacing='0' WIDTH=98% class='t_bordeGris' valign='top' align='center' > 
		<tr>
            <td width='50%' valign='bottom' align='left' > <?
	   if($carpeta!=11 ) {?><img src='../imagenes/accion.gif' ><br>
              <? }
	   ?>
              <br>
      
            
            </td>
            <td width='5%' valign='bottom'>
              <input type=submit value='IMPRIMIR RADICADOS SELECCIONADOS' name=Enviar valign='middle' class='ebuttons2'>
            </td></TR>
	</TABLE><br>
	  <?
	  ora_parse($cursor,$isql);
	ora_exec($cursor);
	$row = array();
	// Encabezado de la lista de documentos
	// Cada encabezado tiene un href que permite recargar la pagina con otro orden. 



		 ?>
       
      <table border=0 cellspace=2 cellpad=2 WIDTH=98% class='t_bordeGris' align='center'>
		  <tr bgcolor="#cccccc" class="textoOpcion"> <?
		   $encabezado = "&fechah=$fechah&ordcambio=1&ascdesc=$ascdesc&orno=";
		  ?> 
            <th width='9%' height="45">  
              <?=$img1 ?>
              Pdf </th>
            <th width='9%' height="45"> <a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>1' alt='Seleccione una busqueda' class='textoOpcion'> 
              <?=$img1 ?>
              N&uacute;mero Radicado Generado</a> </th>			  		  
            <th width='9%' height="45"> <a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>1' alt='Seleccione una busqueda' class='textoOpcion'> 
              <?=$img1 ?>
              N&uacute;mero Radicado</a> </th>
		    <th  width='17%'> <a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>2' alt='Seleccione una busqueda' class='textoOpcion'>
              <?=$img2 ?>
              Fecha Radicado</a> </th>
		    <th  width='19%'> <a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>3'  alt='Seleccione una busqueda' class='textoOpcion'>
              <?=$img3 ?>
              Asunto</a> </th>	
		    <th  width='14%'> <a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>4'  alt='Seleccione una busqueda' class='textoOpcion'>
              <?=$img4  ?>
              Tipo de Doc</a></th>
		    <th  width='14%'> <a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>5'  alt='Ordenar por nombre' class='textoOpcion'>
              <?=$img5 ?>
              Nombre</a> </th>
		    <th  width='9%'> <a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>6'  alt='Ordenar por nombre' class='textoOpcion'>
              <?=$img6 ?>
              D&iacute;as <br>
               Restantes</a>
		 </th>
	        <th  width='7%'><a href='cuerpopdf.php?<?=SID ?><?=$encabezado ?>7'  alt='Ordenar por Enviado' class='textoOpcion'>
              <?=$img9 ?>
              Enviado<br>
              Por</a>
		 </th>
		 <?
		 if($codusuario==1){
		 ?> 
            <th  width='2%'> 
              <input type='checkbox' onClick='markAll(form1)' title='Seleccione/deseleccione todos los mensajes' name='marcartodos' id=mt> 
		 <? } ?>
		 </th>
		 </tr>
		 <?
		 $row = array();
		 $i = 1;
		 $ki=0;
	// Comienza el siclo para mostrar los documentos de la parpeta predeterminada.
	     $registro=$pagina*20;
   while($result1=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
	 { 
			 if($ki>=$registro and $ki<($registro+20)){
			 $data = trim($row["RADI_NUME_RADI"]);
			 $numdata =  trim($row["CARP_CODI"]);
	 		$plg_codi = $row["PLG_CODI"];
	 		$plt_codi = $row["PLT_CODI"];			
			$rad_salida = $row["RADI_NUME_SAL"];
			$ref_pdf = $row["PLG_ARCHIVO_FINAL"];
					
			$urlimagen = "<a href='../bodega".$row["RADI_PATH"]."?fechah=$fechah'>$data</a>";
			if($plt_codi==2){$img_estado = "<img src=../img/pdf_ok.gif width='22' height='24' border=0>"; }
			if($plt_codi==3){$img_estado = "<img src=../img/pdf_im.gif width='22' height='24' border=0>"; }			
			if($plt_codi==4){$img_estado = "<img src=../img/pdf_en.gif width='22' height='24' border=0>"; }			
			$ref_pdf_salida = "<a href=../$ref_pdf alt='Radicado de Salida --> $rad_salida'>$img_estado</a>";
			//$ref_pdf_salida = "<a href='imprimir_pdf_frame?".session_name()."=".session_id() . "&ref_pdf=$ref_pdf&numrad=$numrad'>$img_estado </a>";
            if($data =="") $data = "NULL";
			 $numerot = $row1["num"];
			 if($row["RADI_LEIDO"]==0){$leido="r";} else {$leido="";}
			 if($carpeta==$numdata){$imagen="usuarios.gif";}else{$imagen="usuarios.gif";}
             if($i==1){
			    $leido ="tpar$leido";
				$i=2;
			 }else{
			    $leido ="timpar$leido";
   
				$i=1;
			 }
			 ?><tr class='$leido'><?
			 $radi_tipo_deri = $row["RADI_TIPO_DERI"];
			 $radi_nume_deri = $row["RADI_NUME_DERI"];
			 if($radi_tipo_deri==0 and $radi_nume_deri)
			 {
			   
			   $imagen = "anexos.gif";
			 }else{
			   
			   $imagen = "comentarios.gif";
			 }
			 ?>
            <td  class='<?=$leido ?>' align="center"><font size=1> 
			<?=$ref_pdf_salida ?>
			</td>
            <td class='<?=$leido ?>' align="center"><font size=1> 
			<?=$rad_salida ?>
			</td>			
			<td class='<?=$leido ?>'><font size=1><?=$urlimagen ?>
              <?
		      	$cursor3 = ora_open($handle);
				$isql3 ="select to_char(HIST_FECH,'DD/MM/YY HH12:MI:SSam')as HIST_FECH,HIST_FECH AS HIST_FECH1,HIST_OBSE from hist_eventos where radi_nume_radi='$data' order by HIST_FECH1 desc ";
				 
				ora_parse($cursor3,$isql3);
				ora_exec($cursor3);
				//$result3=ora_fetch_into($cursor3,$row3, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
						//Genera Historia del Documento
				/*$observaciones = "<table border=0 width=100%>"; 
				while($result3=ora_fetch_into($cursor3,$row3, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC))
				{
				   if($row3["HIST_OBSE"]){$HIST_OBSE=trim($row3["HIST_OBSE"]);}else{$HIST_OBSE="";}
				   $observaciones.="<TR bgcolor=$tbfondo class=tencabezado2><TD width=15%>";
				   $observaciones .= $row3["HIST_FECH"]."</td><td width=85%>".ereg_replace("(\r\n|\n|\r)", " ", $HIST_OBSE)."</td></tr>";
				   
				}
				
				$observaciones .= "</table>";
				*/

			   $radi_nomb=$row["NOMBRES"] ;
			   ?>
            </td>
			 <td class='<?=$leido ?>'>
			 <a href='verradicado.php?<?=SID ?>
                   &$urlradicado' ><font size=1><span class='$leido'><?=$row["FECHA"] ?></span></a>
			 </td>
			 <td class='<?=$leido ?>'>
              <?=$row["RA_ASUN"] ?>
			 </td>
			 <td  class='<?=$leido ?>'>
             <?=$row["TDOC_DESC"] ?>
			 </td>
			 <td class='<?=$leido ?>'>
             <?=$radi_nomb ?>
			 </td>
	   	     
            <td class='<?=$leido ?>'> 
              <?
       $diasr = $row["TDOC_TERM"];
			 if($row["DIASR"]<=0 and $diasr!=0){echo "<font color=red>";}else{echo "";}
			 if($diasr==0){echo "ND(".$row["DIASR"].")";}else{echo $row["DIASR"];}
			 ?>
            </td>
		 <td  class='$leido'>
         <?=$row["RADI_USU_ANTE"]; ?>
		 </td>
		 <? 
			 if($check<=20){
			 ?><td align='center' class='<?=$leido ?>'>
             <input type='checkbox' value='<?=$rad_salida ?>' name='chk<?=$check ?>' class='ebuttons2'>
			 </td>
			 <?
			 $check=$check+1;
			 }
			 ?></tr><?
       }
			 $ki=$ki+1;
    }
	 ?> </table>
	 </form>
</form>
 

</body>
</html>
