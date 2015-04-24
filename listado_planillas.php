<head>
<link rel="stylesheet" href="../estilos_totales.css">
</head>
<body>
<TABLE class="t_bordeGris"><TR><TD bgcolor="#CCCCCC"> 
	    Del Usuario </TD><TD> <select name=codus  class=e_cajas>
		<option value='' >Todos los Usuarios</option>
		<?
 		$isqlus = "select a.USUA_CODI,a.USUA_NOMB from usuario a where depe_codi=$dependencia";
	    if($codusuario!=1) $isqlus .= " and a.usua_codi=$codusuario "; 
		//echo "--->".$isqlus;
		$resultado = ora_parse($cursor,$isqlus);
		$resultado = ora_exec($cursor);
		$row=array();
		$res=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);
		do{
		   $codigo = $row["USUA_CODI"]; $usnombre = $row["USUA_NOMB"];
		   $datoss="";
		   if($codus==$codigo){$datoss= " selected ";}
		   echo "<option value=$codigo  $datoss>$usnombre</option>";		
		}while($res=ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC));
		
		?></select></TD></TR><TR>
    <TD bgcolor="#CCCCCC"> 
      <? 

		
			//$isql = "select * ";

			 $tarea1 = "";$tarea2="";
			 if ($codus)   $isql_where = " and a.radi_usua_actu=$codus ";					   
			 if ($agrupar_tipo==1)   {$isql_group = "  d.usua_nomb ,b.SGD_TPR_DESCRIP  ";} else { $isql_group = " d.usua_nomb ";} 					   			  
			 if ($agrupar_tipo==2)   $isql_group = "  b.SGD_TPR_DESCRIP "; 
			  include "./listado_sql.php";
			  Switch ($tarea) {
        		 case 0:
		  			 $isqlc = $isql_select ; 
					 $tarea1 = " selected ";
					 break;
				 case 1:
		 			 $isqlc = $isql_group_by ;
					 $tarea2 = " selected ";
					 break;
				 case 2:
					 print "i es igual a 2";
					 break;
			 }
			 
   		    ?>
      Tipo de Documento </TD>
    <TD><select name=agrupar_tipo class=e_cajas>
			<? if ($agrupar_tipo==0){ $datoss = " selected "; }else{ $datoss = " "; }?>
			<option value=0 '<?=$datoss?>'>Mostrar todos Registros</option>
			<? if ($agrupar_tipo==1){ $datoss = " selected "; }else{ $datoss = " "; }?>			
			<option value=1 '<?=$datoss?>'>Totales por Usuario</option>
			<? if ($agrupar_tipo==2){ $datoss = " selected "; }else{ $datoss = " "; }?>								
			<option value=2 '<?=$datoss?>'>Totalizar Usuarios</option>					
			</select></TD></TR>
			<Tr> 
            <TD bgcolor="#CCCCCC">
			Tarea a Realizar </TD><TD><select name=tarea class=e_cajas>
			<option value=0 '<?=$tarea1?>'>Mostrar Registros</option>
			<option value=1 '<?=$tarea2?>'>Contar Registros</option>		
			</select></TD></TR>
			<tr><td colspan="2" bgcolor="#CCCCCC">
			<center><INPUT TYPE=SUBMIT name=generar_listado Value='Generar' class=ebuttons2></center>
			</td></tr>
			</TABLE>
<? 
if($generar_listado) 
{
        include "oracle_pdf.php";
		$query = "select SGD_FENV_CODIGO, 
				  '',
				  substr(RADI_NUME_SAL,5,8),
				  SGD_RENV_NOMBRE as DESTINATARIO,
				  SGD_RENV_DESTINO as DESTINO,		  
				  TO_NUMBER(SGD_RENV_PESO) as PESO,
				  TO_NUMBER(SGD_RENV_VALOR) as VALOR_PORTE,
				  SGD_RENV_CERTIFICADO as CERTIFICADO,
				  '' as VALOR_ASEGURADO,
				  '' as TASA_DE_SEGURO,
				  '' as VALOR_REEMBOLSABLE,
				  '' as AVISO_DE_LLEGADA,
				  '' as SERVICIOS_ESPECIALES,
				  TO_NUMBER(SGD_RENV_VALOR) as VALOR_TOTAL
				  from SGD_RENV_REGENVIO ";
		$pdf = new PDF('L','pt','A3');
		$pdf->SetFont('Arial','',8);
		$pdf->AliasNbPages(); 
		$pdf->connect('localhost','root','','register');
		$head_table = array ("CANTIDAD","CATEGORIA DE CORRESPONDENCIA","NUMERO DE REGISTRO","DESTINATARIO","DESTINO","PESO EN GRAMO","VALOR PORTE","CERTIFICADO","VALOR ASEGURADO","TASA DE SEGURO","VALOR REEMBOLSABLE","AVISO DE LLEGADA","SERVICIOS ESPECIALES","VALOR TOTAL PORTES Y TASAS");
		$head_table_size = array (30,60,60,200,80,80,80,40,80,80,80,80,80,80);
		$attr=array('titleFontSize'=>16,'titleText'=>'');
		
		$pdf->oracle_report($query,false,$attr,$head_table,$head_table_size); 
}			
?>
</body>