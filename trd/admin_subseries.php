<?php
	session_start(); 
/*
 * Lista Subseries documentales
 * @autor Jairo Losada SuperSOlidaria 
 * @fecha 2009/06 Modificacion Variables Globales.
 */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
	$ruta_raiz = ".."; 
	include_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug=true;
if (!defined('ADODB_FETCH_ASSOC'))	define('ADODB_FETCH_ASSOC',2);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
if (!$fecha_busq)  $fecha_busq=Date('Y-m-d');
if (!$fecha_busq2)  $fecha_busq2=Date('Y-m-d');
?>
<html>
<head>
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF">
 <div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="../js/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="../js/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript"><!--
    var dateAvailable  = new ctlSpiffyCalendarBox("dateAvailable", "adm_subserie", "fecha_busq","btnDate1","<?=$fecha_busq?>",scBTNMODE_CUSTOMBLUE);
	var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "adm_subserie", "fecha_busq2","btnDate1","<?=$fecha_busq2?>",scBTNMODE_CUSTOMBLUE);
//--></script>
<form name="adm_subserie" id='adm_subserie' method='post'  action='admin_subseries.php?<?=session_name()."=".session_id()."&krd=$krd&tiem_ac=$tiem_ac&tiem_ag=$tiem_ag&fecha_busq=$fecha_busq&fecha_busq2=$fecha_busq2&codserie=$codserie&tsub=$tsub&detasub=$detasub"?>'>      
<table class=borde_tab width='100%' cellspacing="5"><tr><td class=titulos2><center>SUBSERIES DOCUMENTALES</center></td></tr></table>
<table><tr><td></td></tr></table>
<center>
<TABLE width="550" class="borde_tab" cellspacing="5">       
<TR>
    <TD width="95" height="21"  class='titulos2'> C&oacute;digo Serie<br>
   <td colspan="2"  class="listado5"> 
  <?php
    if(!$codserie) $codserie = 0;
	$fechah=date("dmy") . " ". time("h_m_s");
	$fecha_hoy = Date("Y-m-d");
	$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
	$num_car = 4;
	$nomb_varc = "sgd_srd_codigo";
	$nomb_varde = "sgd_srd_descrip";
  include "$ruta_raiz/include/query/trd/queryCodiDetalle.php";
	$querySerie = "select distinct ($sqlConcat) as detalle,
                        sgd_srd_codigo 
	                    from sgd_srd_seriesrd 
			                order by sgd_srd_descrip";
	$rsD=$db->conn->query($querySerie);
	$comentarioDev = "Muestra las Series Docuementales";
	include "$ruta_raiz/include/tx/ComentarioTx.php";
	print $rsD->GetMenu2("codserie",
                        $codserie,
                        "0:-- Seleccione --",
                        false,
                        "",
                        "onChange='submit()' class='select'" );

//$db->conn->debug=true;
 ?>
 </td>
 </td>
 <?
if($_POST['actua_subserie']) {
 ?>
 <td width="35" height="21"><input type=submit name=modi_subserie Value='Grabar Modificacion' class=botones_largo ></td>
 <?
 }
 ?>
	<tr>
		<td width="125" height="21"  class='titulos2'>C&oacute;digo Subserie</td>
		<td width="125" valign="top" align="left" class='listado2'>
			<input name="tsub" type="text" size="20" class="tex_area" value="<?=$tsub?>">
		</td>
		<td width="125" height="21"  class='titulos2'>Descripci&oacute;n</td>
		<td valign="top" align="left" class='listado2'>
			<input name="detasub" type="text" size="75" class="tex_area" value="<?=$detasub?>">
		</td>
	</tr>
  <tr> 
  <td height="26" class='titulos2'>Fecha desde<br></td>
   	<td width="225" valign="top" class='listado2'>
	  <script language="javascript">
	  	dateAvailable.dateFormat="yyyy-MM-dd";
	    dateAvailable.date ="<?=$fecha_busq?>";
		dateAvailable.writeControl();
    </script>
     </td>
  <td height="26" class='titulos2'>Fecha Hasta<br></td>
 	<td width="225" align="right" valign="top" class='listado2'>
    <script language="javascript">
		dateAvailable2.dateFormat="yyyy-MM-dd";
		dateAvailable2.date ="<?=$fecha_busq2?>";
		dateAvailable2.writeControl();
    </script>
   </td>
  </tr>
  <tr> 
      <TD width="125" height="21"  class='titulos2'> Tiempo Arrchivo de Gesti&oacute;n</td>
      <TD valign="top" align="left" class='listado2'>
	     <input name="tiem_ag" type="text" size="20" class="tex_area" value="<?=$tiem_ag?>"></td>
     <TD width="125" height="21"  class='titulos2'> Tiempo Archivo Central</td>
      <TD valign="top" align="left" class='listado2'>
	  <input name="tiem_ac" type="text" size="20" class="tex_area" value="<?=$tiem_ac?>"> 
  </td>
  </tr>
  <tr> 
      <TD width="125" height="21"  class='titulos2'> Soporte </td>
      <TD valign="top" align="left" class='listado2'>
	     <input name="soporte" type="text" size="20" class="tex_area" value="<?=$soporte?>"></td>
     <TD width="125" height="21"  class='titulos2'>Disposici&oacute;n Final</td>
      <TD valign="top" align="left" class='listado2'>
	  <select  name='med'  class='select'>
	<?php
	if($med==1){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='1' $datosel><font>CONSERVACION TOTAL</font></option>";
	if($med==2){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='2' $datosel><font>ELIMINACION</font></option>";
	if($med==3){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='3' $datosel><font>MEDIO TECNICO</font></option>";
	if($med==4){$datosel=" selected ";}else {$datosel=" ";}
		echo "<option value='4' $datosel><font>SELECCION O MUESTREO</font></option>";
		?>
</select>
  </td>
  </tr>
 	<tr>
	<td  class="titulos5" width="25%" align="right" > <font color="" face="Arial, Helvetica, sans-serif" class="etextomenu">Observaciones
		</font></td>
	<td width="75%" class="listado5" >
	<textarea name="asu" cols="70" class="tex_area" rows="2" ><?=trim($asu)?></textarea>
	</td>
	</tr>
 <tr>
       <td height="26" colspan="4" valign="top" class='titulos2'> 
	   <center>
	   <input type=submit name=buscar_subserie Value='Buscar' class=botones >
	  <input type=submit name=insertar_subserie Value='Insertar' class=botones >
	  <input type=submit name=actua_subserie Value='Modificar' class=botones >
      <input type="reset"  name=aceptar class=botones id=envia22  value='Cancelar'>
 </td>
    </tr>
  </table>
<?PHP
    if ($tiem_ag == '') $tiem_ag = 0;
    if ($tiem_ac == '') $tiem_ac = 0;
 	$detasub = strtoupper(trim($detasub));
	$sqlFechaD=$db->conn->DBDate($fecha_busq);	
	$sqlFechaH=$db->conn->DBDate($fecha_busq2);	
    //Buscar detalle subserie
    if($buscar_subserie && $detasub !='') {
		 if($codserie != 0) {
		 	$detasub = strtoupper(trim($detasub));
		    $whereBusqueda = " and sgd_sbrd_descrip like '%$detasub%'";
		 } else {
		    echo "<script>alert('Debe seleccionar la Serie');</script>";
		 }
    }
	   
	  if($insertar_subserie) {

		  if($tsub !=0 && $codserie !=0 && $detasub !='') {
			  $isqlB = "select * from sgd_sbrd_subserierd 
					  where sgd_srd_codigo = '$codserie'
					  and sgd_sbrd_codigo = '$tsub'
					  ";
	
			# Selecciona el registro a actualizar
			$rs = $db->conn->query($isqlB); # Executa la busqueda y obtiene el registro a actualizar.
			$radiNumero = $rs->fields["SGD_SRD_CODIGO"];
	        if ($radiNumero !='') {
			   $mensaje_err = "<HR><center><B><FONT COLOR=RED>EL CODIGO < $codserieI > YA EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
			   } 
			   else 
			   {
				$isqlB = "select * from sgd_sbrd_subserierd 
					  			where sgd_srd_codigo = '$codserie'
						        and sgd_sbrd_descrip = '$detasub'
						  "; 
				$rs = $db->conn->query($isqlB); # Executa la busqueda y obtiene el registro a actualizar.
				$radiNumero = $rs->fields["SGD_SRD_CODIGO"];
	        	if ($radiNumero !='') {
				   $mensaje_err = "<HR><center><B><FONT COLOR=RED>LA SERIE <$detasub > YA EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
				  }
				else
					{
						$query="insert into SGD_SBRD_SUBSERIERD (SGD_SRD_CODIGO,
                                                      SGD_SBRD_CODIGO,
                                                      SGD_SBRD_DESCRIP,
                                                      SGD_SBRD_FECHINI,
                                                      SGD_SBRD_FECHFIN,
                                                      SGD_SBRD_TIEMAG,
                                                      SGD_SBRD_TIEMAC,
                                                      SGD_SBRD_DISPFIN,
                                                      SGD_SBRD_SOPORTE,
                                                      SGD_SBRD_PROCEDI)
						VALUES ($codserie,$tsub,'$detasub'    ,".$sqlFechaD.",".$sqlFechaH.",$tiem_ag,$tiem_ac,'$med','$soporte','$asu')";
						$rsIN = $db->conn->query($query);
						$tsub = '' ;
						$detasub = '';
						$tiem_ag = '';
						$tiem_ac = '';
						$soporte = '';						
						if(!rsIN) $mensaje_err=" <HR><center><B><FONT COLOR=RED> Verifique todos los datos</FONT></B></center><HR>";
						?>
						<script language="javascript">
						    document.adm_subserie.elements['detasub'].value= '';
							document.adm_subserie.elements['tsub'].value= '';
						    document.adm_subserie.elements['asu'].value= '';
						    document.adm_subserie.elements['soporte'].value= '';
							document.adm_subserie.elements['tiem_ag'].value= '';
							document.adm_subserie.elements['tiem_ac'].value= '';

					</script>
						<?
  					}
			}
			}
			else
			{
			 echo "<script>alert('Los campos Serie, Subserie y Detalle son OBLIGATORIOS');</script>";
			}
			 
    }
				
	if($_POST['actua_subserie'] )
	  {  
  		 if ($codserie !=0 && $tsub !=0 )
		   {
			 $isqlB = "select * from sgd_sbrd_subserierd 
					  where sgd_srd_codigo = $codserie
					  and sgd_sbrd_codigo = $tsub
					  "; 
			  # Selecciona el registro a actualizar
			  $rs = $db->conn->query($isqlB); # Executa la busqueda y obtiene el registro a actualizar.
			  $radiNumero = $rs->fields["SGD_SRD_CODIGO"];
	          if ($radiNumero =='') {
			    $mensaje_err = "<HR><center><B><FONT COLOR=RED>EL CODIGO < $codserie >< $tsub > NO EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
			   } 
			   else 
			   {
			   //Carga Valores actuales
			     $detasub   = $rs->fields["SGD_SBRD_DESCRIP"];
				 $sqlFechaD = $rs->fields["SGD_SBRD_FECHINI"];
				 $sqlFechaH = $rs->fields["SGD_SBRD_FECHFIN"];
				 $tiem_ag	= $rs->fields["SGD_SBRD_TIEMAG"];  
 				 $tiem_ac   = $rs->fields["SGD_SBRD_TIEMAC"];  
 				 $med       = $rs->fields["SGD_SBRD_DISPFIN"];
				 $soporte   = $rs->fields["SGD_SBRD_SOPORTE"];
				 $asu      = $rs->fields["SGD_SBRD_PROCEDI"];
				 $fecha_busq = $sqlFechaD;
				 $fecha_busq2 = $sqlFechaH;
				 $varFechaD = $fecha_busq;
			
				 ?>
					<script language="javascript">
					document.adm_subserie.elements['detasub'].value= "<?=$detasub?>";
					document.adm_subserie.elements['tsub'].value= "<?=$tsub?>";
					document.adm_subserie.elements['asu'].value= "<?=$asu?>";
					document.adm_subserie.elements['tiem_ag'].value= "<?=$tiem_ag?>";
					document.adm_subserie.elements['tiem_ac'].value= "<?=$tiem_ac?>";
					document.adm_subserie.elements['soporte'].value= "<?=$soporte?>";
					document.adm_subserie.elements['med'].value= "<?=$med?>";
					document.adm_subserie.elements['fecha_busq'].value= "<?=$fecha_busq?>";
					document.adm_subserie.elements['fecha_busq2'].value= "<?=$fecha_busq2?>";
					
					</script>
					<?
			   }
	 }
	else  {
		  echo "<script>alert('Debe seleccionar la Serie y la Subserie');</script>";
	}
  }
  else
  {
	?>
 	<script language="javascript">

        document.adm_subserie.elements['detasub'].value= '';
		document.adm_subserie.elements['tsub'].value= '';
	    document.adm_subserie.elements['asu'].value= '';
	    document.adm_subserie.elements['soporte'].value= '';
		document.adm_subserie.elements['tiem_ag'].value= '';
		document.adm_subserie.elements['tiem_ac'].value= '';
		
	</script>
	<?
  }
     
//Selecciono Grabar Cambios
   if($_POST['modi_subserie'] )
     {  
       if ($codserie !=0 && $tsub !=0 && $detasub != '')
	     {
	        $isqlB = "select * from sgd_sbrd_subserierd 
				        where sgd_srd_codigo = $codserie
				        and sgd_sbrd_descrip = '$detasub'
				        and sgd_sbrd_codigo != $tsub
			          "; 
	  		$rs = $db->conn->query($isqlB); # Executa la busqueda y obtiene el registro a actualizar.
	  		$radiNumero = $rs->fields["SGD_SRD_CODIGO"];
	  		if ($radiNumero !='') 
	    		{
		   			$mensaje_err = "<HR><center><B><FONT COLOR=RED>LA SUBSERIE <$detasub > YA EXISTE. <BR>  VERIFIQUE LA INFORMACION E INTENTE DE NUEVO</FONT></B></center><HR>";
	    		}
	  		else  
	    		{		   
	     			$isqlUp = "update sgd_sbrd_subserierd 
					   			set SGD_SBRD_DESCRIP= '$detasub' 
						  			,SGD_SBRD_FECHINI=$sqlFechaD 
						  			,SGD_SBRD_FECHFIN =$sqlFechaH 
						  			,SGD_SBRD_TIEMAG = $tiem_ag
 						  			,SGD_SBRD_TIEMAC = $tiem_ac
 						  			,SGD_SBRD_DISPFIN ='$med'
						  			,SGD_SBRD_SOPORTE ='$soporte'
						  			,SGD_SBRD_PROCEDI ='$asu'
                        		where sgd_srd_codigo = $codserie
									and sgd_sbrd_codigo = $tsub
								";
            		$rsUp= $db->query($isqlUp); 
					$tsub = '' ;
					$detasub = '';
					$tiem_ag = '';
					$tiem_ac = '';
					$soporte = '';	
					$mensaje_err ="<HR><center><B><FONT COLOR=RED>SE MODIFICO LA SUBSERIE</FONT></B></center><HR>";
					?>
					<script language="javascript">
				        document.adm_subserie.elements['detasub'].value= '';
						document.adm_subserie.elements['tsub'].value= '';
	    				document.adm_subserie.elements['asu'].value= '';
	    				document.adm_subserie.elements['soporte'].value= '';
						document.adm_subserie.elements['tiem_ag'].value= '';
						document.adm_subserie.elements['tiem_ac'].value= '';
					</script>
					<?
	    		}
   			} 
   		else
    		{
	    		echo "<script>alert('La Serie, la Subserie y el Detalle son OBLIGATORIOS');</script>";
    		}
	}
	include_once "$ruta_raiz/trd/lista_subseries.php";

	?>
	
</form>
</span>
<p>
<?=$mensaje_err?>
</p>
</body>
</html>
