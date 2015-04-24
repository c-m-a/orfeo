<!-- HEADER BEGIN -->
<?php
	include ("./cabez.php");
?>
<!-- HEADER END-->
<?php
	// Muestra informacion de la empresa
?>
<form name="consultaExp" method="POST" action="./index.php">
<table border="0" cellpadding="0" cellspacing="5" width="100%">
  <tbody>
   <tr>
    <td class="titulos2" align="center">
	<font size="2">EXPEDIENTE DE LA EMPRESA <b><?=$empresa["NOMBRE_DE_LA_EMPRESA"];?></b></font>
	<input type="hidden" name="idEmpresa" value="<?=$idEmpresa?>">
    </td>
   </tr>
  </tbody>
</table>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
  <tbody>
   <tr>
    <td><table class="borde_tab" border="0" cellpadding="0" cellspacing="0" width="100%">
      <tbody>
       <tr>
        <td>
	 <table border="0" cellpadding="0" cellspacing="5" width="100%">
          <tbody>
	   <tr>
            <td class="titulos2" width="40%">Nit. de la Empresa</td>
	    <td class="listado2" colspan="4"><?=$empresa["NIT_DE_LA_EMPRESA"];?></td>
           </tr>
           <tr>
            <td class="titulos2" width="40%">Direcci&oacute;n</td>
            <td class="listado2" colspan="4"><?=$empresa["DIRECCION"];?></td>
           </tr>
           <tr>
            <td class="titulos2" width="40%">Correo electr&oacute;nico:</td>
            <td class="listado2" colspan="4"><?=$empresa["EMAIL"];?></td>
           </tr>
	   <tr>
	    <td class="titulos2">Dependencia</td>
	    <td class="listado2" colspan="4">
	     <select name="dependencia" class="select">
		<?=$dropDownDep?>
	     </select>
	   </td>
	   </tr>
	   <tr>
	    <td class="titulos2">Tipo Vigencia</td>
	    <td class="listado2">
		Vigentes: 
	    </td>
	    <td class="listado2">
		<input type="radio" name="vigencia" value="0" <?=$activo[0]?>>  
	    </td>
	    <td class="listado2">
		No Vigentes:
	    </td>
	    <td class="listado2">
		<input type="radio" name="vigencia" value="1" <?=$activo[1]?>>
	    </td>
	   </tr>
	   <tr>
	    <td colspan="5" class="titulos2" align="center">
		<input type="submit" class="botones_funcion" value="Buscar Expedientes" name="verExpedientes">
	    </td>
	   </tr>
        </tbody>
       </table>
      </td>
     </tr>
    </tbody>
   </table>
   </td>
  </tr>
 </tbody>
</table>
<?php
	include ("./mostrarExpPorDep.php");
?>
</form>
</body>
</html>
