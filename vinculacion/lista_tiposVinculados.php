<?php
session_start();
if (!$ruta_raiz) $ruta_raiz= "..";
$isqlC = 'select 
			radi_nume_deri        AS "DERIVADO"
			, radi_tipo_deri      AS "TIPO"
			from 
			   RADICADO
	   		where radi_nume_radi    =  '. $verrad;
     error_reporting(7);
?>
    <br>
	<br>
	<TABLE class="borde_tab"><tr><td>
   DOCUMENTO VINCULADO AL RADICADO No. <?=$verrad ?></td></tr></table>
	<br>
	<table class=borde_tab width="100%" cellpadding="0" cellspacing="5">
  	<tr class="titulo4" align="center">
    	<td width="20%"  class="titulos4">TIPO</td>
		<td width="30%"  class="titulos4">RADICADO VINCULADO</td>
   	   	<td width="30%"  class="titulos4">ACCION</td>
  		</tr>
  	<?php
	 	$rsC=$db->query($isqlC);
		$numRadiVin  =$rsC->fields["DERIVADO"];
   		 if($numRadiVin  != '')
			{
      			$tipVinculo  =$rsC->fields["TIPO"];
	  			$numRadiVin  =$rsC->fields["DERIVADO"];
				
		?> 
				<td class="listado4"> <?=$tipVinculo?> </td>
				<td class="listado4"> <?=$numRadiVin?> </td>
	 			<td  <? if (!$rsC->fields["DERIVADO"]) echo " class='celdaGris ' "; else echo " class='e_tablas ' "; ?>  > 
		<?php 
					echo "<a href=javascript:borrarArchivo('$verrad','si')><span class='botones_largo'>Borrar Vinculo</a> ";
		  ?> 
		 
	</td>
	</tr>
	<?
  		}
		 ?>
   </table>