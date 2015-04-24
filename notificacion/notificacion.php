<?
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/*				COLOMBIA TEL. (57) (1) 6913005  orfeogpl@gmail.com   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */ 
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/*************************************************************************************/
?>
<?

session_start();
if (!$ruta_raiz)
	$ruta_raiz = "..";
 require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$fecRadCorto = substr($radi_fech_radi,0,10); 

 if(!$dependencia) include "$ruta_raiz/rec_session.php";

 include_once("$ruta_raiz/include/combos.php");
 
 
?>
<script src="<?=$ruta_raiz?>/js/formchek.js"></script>

<script>

function cambioNotif(valor){
	
	if (valor==1 || valor==4){
		 mostrar('form_notificacion1');
		 ocultar ('form_notificacion3');
		 document.form_notificacion.edicto.value="";
		 document.form_notificacion.fecha_fij.value="";
		 document.form_notificacion.fecha_desfij.value="";
		 
	}
	if (valor==3){
		 mostrar('form_notificacion3');
		  document.form_notificacion.fecha_not.value="";
		 ocultar ('form_notificacion1');
	}
}

function validarNotif(){
	 
	
	sw=true;
	valor = document.form_notificacion.notif.value;
	
	if (!confirm('Esta seguro de los datos de notificacion ?'))
		sw=false;
			
	//alert (valor); 
	
	if ( document.form_notificacion.notificador.value.length==0){
		sw=false;
		alert ("Debe suministrar el nombre del notificador");
	}
	
	if ( document.form_notificacion.notificado.value.length==0){
		sw=false;
		alert ("Debe suministrar el nombre del notificado");
	}
	
	//alert ("validando->>>" + valor);
	if (valor==1){
		
		if ( document.form_notificacion.fecha_not.value.length==0){
			sw=false;
			alert ("Debe suministrar la fecha de notificacion");
		}
	}
	
	if (valor==3){
				
		if ( !isInteger(document.form_notificacion.edicto.value)){
			sw=false;
			alert ("El edicto debe ser numerico");
		}
		
		if (document.form_notificacion.edicto.value.length>5){
			sw=false;
			alert ("El edicto debe tener maximo 5 digitos");
		}
		
		if ( document.form_notificacion.fecha_fij.value.length==0){
			sw=false;
			alert ("Debe suministrar la fecha de fijacion");
		}
		
		if ( document.form_notificacion.fecha_desfij.value.length==0){
			sw=false;
			alert ("Debe suministrar la fecha de desfijacion");
		}
		
	}
	
	//Valida que la fecha de notificacion sea mayor a la fecha de radicacion
	if (valor==1 || valor==4 ){
		
		if (fechas_comp_ymd(document.form_notificacion.fecha_not.value,document.form_notificacion.hidFechaRad.value)){
			sw=false;
			alert ("La fecha de notificacion debe ser mayor o igual a la fecha de radicacion ");
		}
	}
	
	//Valida que la fecha de fijacion sea mayor a la fecha de radicacion
	if (valor==3){
		
		if (fechas_comp_ymd(document.form_notificacion.fecha_fij.value,document.form_notificacion.hidFechaRad.value)){
			sw=false;
			alert ("La fecha de fijacion debe ser mayor o igual a la fecha de radicacion ");
		}
	}
	
	if (valor==3){
		
		if (fechas_comp_ymd(document.form_notificacion.fecha_desfij.value,document.form_notificacion.fecha_fij.value)){
			sw=false;
			alert ("La fecha de desfijacion debe ser mayor a la fecha de fijacion ");
		}
	}
	
	return sw;
}

function enviarNotif(){
	
	if (validarNotif())
		 document.form_notificacion.submit();
	
}
</script>

<link rel="stylesheet" href="estilos_totales.css">
<form name=form_notificacion  method='post' action='notificacion/notificacion_registro.php?<?=session_name()?>=<?=trim(session_id())?>&krd=<?=$krd?>&verrad=<?=$verrad?>&<?="&mostrar_opc_envio=$mostrar_opc_envio&nomcarpeta=$nomcarpeta&carpeta=$carpeta&leido=$leido"?>'>
<input type="hidden" name="hidFechaRad" id="hidFechaRad" value="<?=$fecRadCorto?>">
<table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab" >
    <tr> 
      <td  height="22" width="124"  class="titulos2"> Tipo de Notificacion </td>
      <td width="315" class='celdaGris' height="22" > 
        <select name="notif" class="select" onchange="cambioNotif(this.value)">
          <?php
	//$tipoNotific=3;	 
       // Arma la lista desplegable con los tipos de documento a anexar
       $a = new combo($db); 
       $s = "select * from sgd_not_notificacion order by SGD_NOT_CODI";
			$r = "SGD_NOT_CODI"; 
			$t = "SGD_NOT_DESCRIP";
			$v = $tipoNotific;
			$sim = 0; 
      	$a->conectar($s,$r,$t,$v,$sim,$sim);
						
      	 ?>
        </select>
      </td>
    </tr>
    <input type=hidden name=ver_subtipo value="Si ver Subtipo">
    <input type=hidden name=nomcarpeta value="<?=$nomcarpeta?>">
  </table>
  <table border=0 width 100%     >
    <tr> 
      <td width="121" class="titulos2" >Notificador</td>
      <td width="317"> 
        <input name="notificador" type="text"  class="tex_area"   size="70"  value = "<?=$tNotNotifica ?>" >
      </td>
    </tr>
    <tr> 
      <td width="121" class="titulos2">Notificado </td>
      <td width="317"> 
        <input name="notificado" type="text"  class="tex_area" size="70" value = "<?=$tNotNotificado ?>"  >
      </td>
    </tr>
    <tr> 
      <td width="121" class="titulos2">Observaciones </td>
      <td width="317"> 
        <input name="observaciones" type="text"  class="tex_area" size="70" value = "<?=$tNotObserva ?>"  >
      </td>
    </tr>
  </table>
  <table border=0 width 100%  id=form_notificacion1    >
    <tr> 
      <td width="121" class="titulos2" >Fecha</td>
      <td width="317"><a href=# onClick="changedepesel(21);"><font size="1"> 
   
   
    
         <script language="javascript">
			var dateAvailable2 = new ctlSpiffyCalendarBox("dateAvailable2", "form_notificacion", "fecha_not","btnDate2","<?
			if (strlen($tFechNot))
				echo($tFechNot); 
			//else
			//	echo(Date("Y-m-d"));
			?>",scBTNMODE_CUSTOMBLUE);
		       dateAvailable2.writeControl();
			dateAvailable2.dateFormat="yyyy-MM-dd";
			
			
	</script>
        </font></a></td>
    </tr>
  </table>
  <table border=0 width 100% id=form_notificacion3  style="display:none"   >
    <tr> 
      <td width="122" class="titulos2" >Numero Edicto </td>
      <td width="316">
        <input name="edicto" type="text"  class="tex_area" size="30"  value = "<?=$tNotEdicto ?>" >
      </td>
    </tr>
    <tr> 
      <td width="122" class="titulos2" >Fecha Fijacion</td>
      <td width="316"><a href=# onClick="changedepesel(21);"><font size="1"> 
	     
        <script language="javascript">
			var dateAvailable3 = new ctlSpiffyCalendarBox("dateAvailable3", "form_notificacion", "fecha_fij","btnDate3","",scBTNMODE_CUSTOMBLUE);
		       dateAvailable3.writeControl();
			dateAvailable3.dateFormat="yyyy-MM-dd";
			document.form_notificacion.fecha_fij.value="<?
			if (strlen($tFechFija))
				echo($tFechFija); 
		
			?>";
	</script>
        </font></a></td>
    </tr>
    <tr> 
      <td width="122" class="titulos2"  >Fecha Desfijacion</td>
      <td width="316"><a href=# onClick="changedepesel(21);"><font size="1"> 
        <script language="javascript">
			var dateAvailable4 = new ctlSpiffyCalendarBox("dateAvailable4", "form_notificacion", "fecha_desfij","btnDate4","",scBTNMODE_CUSTOMBLUE);
		       dateAvailable4.writeControl();
			dateAvailable4.dateFormat="yyyy-MM-dd";
			document.form_notificacion.fecha_desfij.value="<?
			if (strlen($tFechDesFija))
				echo($tFechDesFija); 
		
			?>";
			
	</script>
        </font></a></td>
    </tr>
  </table>
  <p>
  	<? 
  	if ($tipoNotific) {
  	?>
    <span class="alarmas" >La resolucion ya esta notificada, no se puede volver a  notificar</span>
    <?} else {?>
    <input type=button name=grabar_subtipo value='Grabar Cambio' class='botones' onclick="enviarNotif();">
    <?}?>
  </p>
  <p>
    <input type="hidden" name="tdoc" value = "<?=$tdoc?>">
  </p>
  <p>&nbsp;</p>
  <script>
  	cambioNotif(<?=$tipoNotific ?>);
  </script>
</form>
