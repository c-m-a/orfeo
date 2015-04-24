<?
  session_start();
  ?>
<table width="98%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="tituloListado">GENERACION DE DOCUMENTOS</td>
  </tr>
</table>
<?  
	 
  if($plantilla_us AND $ins_plantilla)
	  {
	  $isql = "SELECT PL_CODI FROM PLANTILLA_PL ORDER BY PL_CODI DESC";
	  $rs=$db->query($isql);
      $pl_codi =  $rs->fields["PL_CODI"] + 1;
	  
  	  $archivo_pl = "pl_txt/$dependencia/per/$nombre_pl"."_".$krd.".txt";  
	  $fp=fopen($archivo_pl,"w");
	  fputs($fp,$alltext); 
	  fclose($fp);

      $recordSet["PL_CODI"] = $pl_codi;
      $recordSet["DEPE_CODI"] = $dependencia;	  
      $recordSet["PL_NOMB"] = '$nombre_pl';
      $recordSet["PL_ARCHIVO"] = '$archivo_pl';	  
      $recordSet["PL_DESC"] = '';
      $recordSet["PL_FECH"] = "sysdate";	  
      $recordSet["USUA_CODI"] = $codusuario;
      $recordSet["PL_USO"] = 0;	 
	  
	  $db->insert("PLANTILLA_PL", $recordSet); 
	  echo "<center>SE HA AGREGADO UNA PLANTILLA PERSONAL";	    
  }
  if($plantilla_dep  AND $ins_plantilla)
  {
	  $archivo_pl = "pl_txt/$dependencia/$nombre_pl.txt"; 
	  $fp=fopen($archivo_pl,"w");
	  fputs($fp,$alltext);
	  fclose($fp);
	  
	  $isql = "SELECT PL_CODI FROM PLANTILLA_PL ORDER BY PL_CODI DESC";
	  $rs=$db->query($isql);
      $pl_codi =  $rs->fields["PL_CODI"];
	  $pl_codi++;
	  
      $recordSet["PL_CODI"] = $pl_codi;	 	  
      $recordSet["DEPE_CODI"] = $dependencia;	 	  	  
      $recordSet["PL_NOMB"] = '$nombre_pl';	 	  	  
      $recordSet["PL_ARCHIVO"] = '$archivo_pl';	 	  	  
      $recordSet["PL_DESC"] = '';	 	  
      $recordSet["PL_FECH"] = "sysdate";	 	  	  
      $recordSet["USUA_CODI"] = $codusuario;	 	  	  
      $recordSet["PL_USO"] = 1;	 	  	  
	  $db->insert("PLANTILLA_PL", $recordSet);
	  
	  echo "<center>SE HA AGREGADO UNA PLANTILLA A LA DEPENDENCIA";
  }
  
?>
<br>
<?php
   if($plantillaper1){$plantillaper=$verrad."_".$plantillaper1;}
   //Include "listas.php";
	?> 

<table border=0 cellspace=2 cellpad=2 WIDTH=98%>
	    <tr>
    <td> 
      </td>
<td></td><td width='5' colspan='3' class=e_cajas >
    <form action='plantilla.php?<?=session_name()."=".trim(session_id()) ?>&verrad=<?=$verrad?>&gen_rad=<?=$gen_rad?>' method="post">
	  <input type=hidden name=nombre2 value='aa'>
		<input type=hidden name=menu_ver value='<?=$menu_ver ?>'>
		<input type=hidden name=verrad value='<?=$verrad ?>'>
		<input type=hidden name=numrad value='<?=$numrad ?>'>				
	 	<select name=plantilla align=bottom class=e_buttons onchange=submit()>
		<option value=0> Escoger Plantilla Estandar de la Dependencia. . .</option>
	 <?php
	    $isql_hl= "select * from PLANTILLA_PL where depe_codi=$dependencia AND PL_USO=1 order by PL_NOMB";
		$rs= $db->query($isql_hl);
		do
			{
			$pl_codi = $rs->fields["PL_CODI"];
			if($pl_codi==$plantilla)
				{
				$datoss=" selected ";
				}
			else
				{
				$datoss=" ";
				}
			echo "<option value='$pl_codi'  $datoss>".$rs->fields["PL_NOMB"]."</option>";
			$rs->MoveNext();
			}while(!$rs->EOF);
			?> 
			   </select>
	</form>	
	</td> 
  <tr>
    <td colspan=15> 
      <?
			if($plantillaper!=0 or $plantilla!=0 or $enviar or $enviar_new or $crea_plantilla)
			{
               include "cajaspdf.php";
			}
			?>
    </td>
</tr>
</table>
