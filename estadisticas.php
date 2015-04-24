<?
session_start();
include_once "./include/db/ConnectionHandler.php";
include("./class_control/usuario.php");


?>
<html><head><title>ESTADISTICAS -- SAD -- SSPD</title>
<link rel="stylesheet" href="./estilos_totales.css">
<link rel="stylesheet" href="./busqueda/Site.css" type="text/css">
<script>
function adicionarOp (forma,combo,desc,val,posicion){
	o = new Array;
	o[0]=new Option(desc,val );
	eval(forma.elements[combo].options[posicion]=o[0]);
	//alert ("Adiciona " +val+"-"+desc );
	
}
</script>
<body>
<?php
    
     $ruta_raiz = ".";

	
	 if(!$dependencia or !$krd or strlen(trim($nombusuario)) < 1 ) include "./rec_session.php";
	 if(!$dependencia_busq) $dependencia_busq=$dependencia;
	$phpsession = session_name()."=".session_id(); 
        $fechah=date("dmy") . " ". time("h_m_s");
	$paswd = substr($drde,1,26);
	$db = new ConnectionHandler(".");
	$objUsuario = new Usuario($db);
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$isql = "select a.USUA_CODI,a.USUA_NOMB,a.DEPE_CODI,b.DEPE_NOMB from usuario a,dependencia b where a.depe_codi=b.depe_codi and a.USUA_LOGIN ='$krd' ";
	$rs=$db->query($isql);
	if ($rs){
		?>
		<table width=100% class='t_bordeGris'>
		<TR class='t_bordeGris' >
            <TD width='33%' height="6" >
              <table width='100%' border='0' cellspacing='0' cellpadding='0'>
                <tr class="celdaGris"> <?
  $datosaenviar = "fechaf=$fechaf&tipo_carp=$tipo_carp&carpeta=$carpeta&ascdesc=$ascdesc&orno=$orno";
  ?> 
                  <td height="20" class="celdaGris"><img src="imagenes/listado.gif" width="85" height="20">&nbsp;</td>
                </TR><TR>
                  <td height="20" class="tituloListado"><span class="etextomenu">ESTADISTICAS DE DOCUMENTOS EN BANDEJA</span></td>
                </tr>
              </table>
            </td>
            <TD width='33%' height="6" > 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="10%" class="celdaGris" height="20"><img src="imagenes/usuario.gif" width="58" height="20"></td>
                </TR><TR>
                  <td width="90%" height="20"><span class='etextomenu'><?=$usua_nomb ?></span></td>
                </tr>
              </table>
            </td>
            <td height="6" width="33%"> 
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr> 
                  <td width="16%" class="celdaGris" height="20"><img src="imagenes/dependencia.gif" width="87" height="20"></td>
                </TR><TR>
                  <td width="84%" height="20"><span class='etextomenu'><?=$depe_nomb ?></span></td>
                </tr>
              </table>
            </TD>
          </tr>
</table>
		<P>
		<form name="formulario"  method=post action='estadisticas.php?<?=session_name()."=".trim(session_id())."&krd=$krd&fechah=$fechah"?>'>
		<TABLE class="FormTABLE">
		<TR>
		<TD bgcolor="#CCCCCC"> <font class="DataFONT">
	    Dependencia</FONT></TD>
	    
		<TD> <select name=dependencia_busq  class="DataFONT" onChange="comboUsuarioDependencia(document.formulario,document.formulario.elements['dependencia_busq'].value,'codus');">
        <?
        $whereDepSelect=" DEPE_CODI = $dependencia ";
        if ($codusuario==1){
        	$whereDepSelect=" $whereDepSelect or depe_codi_padre=$dependencia ";	
        }
        $whereDepSelect=
 		$isqlus = "select a.DEPE_CODI,a.DEPE_NOMB,a.DEPE_CODI_PADRE from DEPENDENCIA a 
		           where $whereDepSelect ";
	    //if($codusuario!=1) $isqlus .= " and a.usua_codi=$codusuario "; 
		//echo "--->".$isqlus;
		$rs1=$db->query($isqlus);
		
		do{
		   $codigo = $rs1->fields["DEPE_CODI"]; 
		   $vecDeps[]=$codigo;
		   $depnombre = $rs1->fields["DEPE_NOMB"];
		   $datoss="";
		   if($dependencia_busq==$codigo){
		   		$datoss= " selected ";
		   	}
		   echo "<option value=$codigo  $datoss>$depnombre</option>";		
		   $rs1->MoveNext();
		}while(!$rs1->EOF);
		?>
		  </select></TD>
		  <script>
		  <?
		  $objUsuario->comboUsDepGrp($vecDeps);
		  ?>
		  </script>
		</TR>
		<TR><TD bgcolor="#CCCCCC"> <font class="DataFONT">
	    Del Usuario </FONT></TD><TD><select name=codus  class="DataFONT" >
		<option value='' >Todos los Usuarios</option>
		</select></TD>
		<script>
		<? if ($codusuario!=1){?>
			adicionarOp (document.formulario,'codus','<?=$nombusuario?>','<?=$codusuario?>',1);
		   <? } else{?>
			comboUsuarioDependencia(document.formulario,<? echo ($dependencia_busq); ?>,'codus');
		<?}?>
		</script>
		</TR>
			<Tr> 
            <TD bgcolor="#CCCCCC">
			<font class="DataFONT">Tarea a Realizar</FONT></TD><TD><select name=tarea class="DataFONT">
			<?  if($tarea==0)$datoss= " selected "; else $datoss= " ";?>
			<option value=0 '<?=$datoss?>'>Mostrar Registros</option>
			<?  if($tarea==1)$datoss= " selected "; else $datoss= " ";?>			
			<option value=1 '<?=$datoss?>'>Contar Registros</option>		
			</select></TD></TR>
	<TR>
    <TD bgcolor="#CCCCCC"> 
      <? 

		
			//$isql = "select * ";

			 $tarea1 = "";$tarea2="";
			 if ($codus)   
			 	$isql_where = " and a.radi_usua_actu=$codus ";					   
			 else if ($codusuario!=1)
			 	$isql_where = " and a.radi_usua_actu=$codusuario ";	
			 	
			 if ($agrupar_tipo==1)   {$isql_group = "  d.usua_nomb ,b.SGD_TPR_DESCRIP   "; $isql_sel_group = "  d.usua_nomb USUARIO,b.SGD_TPR_DESCRIP TIPO_DOCUMENTO  ";} else { $isql_group = " d.USUA_NOMB "; $isql_sel_group = " d.usua_nomb NOMBRE ";} 					   			  
			 if ($agrupar_tipo==1 and $tarea1=0 )   $isql_group = "  b.SGD_TPR_DESCRIP "; 
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
      <font class="DataFONT">Agrupar por Tipo de Documento</FONT> </TD>
    <TD>
			<? if ($agrupar_tipo==1){ $datoss = " checked "; }else{ $datoss = " "; }?>
	<input type="checkbox" name=agrupar_tipo class="DataFONT" value=1 <?=$datoss?>>
</TD></TR>
			
  </TABLE>
			<input type=submit name=estadisticas value='Realizar' class=ebuttons2>
</form>
			<? 

			$isqlt = $isqlc ;
			 $rs1=$db->query($isqlt);
			 
			 if ($rs1)
			 	$ncols = $rs1->FieldCount(); 
			  
			 			IF (!$estadisticas) { die("<hr>Fecha ".date("y-m-d"))." Hora  ". time("h:m:s")."<hr>";}
						$nrows =0;
			 ?>
			 
			 <table class="FormTABLE">
			 <tr >
			 <?
			 for ($i=0; $i<$ncols; $i++) { 
			  $fld = $rs1->FetchField($i);
		      if(ucwords(strtolower($fld->name))!="Imagen")
					{
			    ?>
				<td class="ColumnTD">
				<font class="ColumnFONT"> 
				    <? 
					  echo ucwords(strtolower($fld->name));
				    ?>
				  </font>
			   </td>
				<? 
				}
			 } 
			 ?></tr><? 
			 // Aqui empieza a visualizar los datos de la consutla
			
			 $k=0;
//			 $curs = ora_do($handle,$isqlt);
			 //echo "<hr>$isql_group_by<hr>";
			 if($rs1 && !$rs1->EOF)
			 {  
			 do{     
 			   ?>
			   <tr>
			   <? 
				for ($i=0; $i<$ncols; $i++) 
				{
					$fld = $rs1->FetchField($i);
					$fld1 = $rs1->FetchField($i + 1);
					$col = $rs1->fields[strtoupper($fld->name)];
					$cols = $rs1->fields[$fld1->name];	
					$numRadicado=$rs1->fields["RADICADO"];	 				
//					$col = ora_getcolumn($curs, $i); 
//					$cols = ora_getcolumn($curs, ($i+1)); 
					if($fld->name=="RADICADO" and $cols)
					{
					  $radicado = $col;
					  $col = "<a href=bodega$cols>$col</a>";
					}
					if($fld->name=="FECHA_RADICACION")
					{
					  $col = "<a href='verradicado.php?$phpsession&krd=$krd&verrad=$numRadicado'>$col</a>";
					}					
					if($fld->name!="IMAGEN")
					{
					?>
					<td class="DataTD"><font class="DataFONT"><?=$col?></font></td>
					<?
					}
					if($i==0) 
					{
					    if($k!=0)  $variablex .=",";
						$variablex .= "$col"; 
					}
					if($i==1) 
					{
					    if($k!=0)  $variabley .=",";
						$variabley .= "$col";
					}					
						  
				} 
				$k++;
			  ?>
			  </tr>
			  <?
			  echo "\n";
			  $nrows++;
			  $rs1->MoveNext();
			}while(!$rs1->EOF);
			}
			?></table></td></tr></table>
			<?
			 
			 echo "<hr>Numero de Registross $nrows<hr>";
			 if($tarea==1 and ($agrupar_tipo==2 or $agrupar_tipo==0)) 
			 { 
			 ?> 
			 <a href='http://at-475/sgd1/jpgraph-1.12.2/src/Examples/barras_degrade.php?variablex=<?=$variablex?>&variabley=<?=$variabley?>'>Ver Grafica</a>
			  <?
			  }
	}else {echo "No entro";}
?>
</body>
</html>
