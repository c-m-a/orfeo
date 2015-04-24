<?php
  /*************************************************************************************/
  /* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
  /*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
  /*				COLOMBIA TEL. (57) (1) 6913005  yoapoyo@orfeogpl.org   */
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
<table><tr><td> </td></tr></table>
  <table border="0" cellpad="2" cellspacing="2" width="100%" align="center" class="borde_tab" cellpadding="2">
     <tr> 
	   <?
       if (isset($swListar))  {
	   ?>
       <td width='50%'   class="titulos2" >
         <table cellpadding="0" cellspacing="0" border="0" width="100%" >
           <tr>
		        <td width='30%' align='left' height="40" class="titulos2" ><b>Listar Por </b>
		        <a href='<?= $pagina_actual?>?<?=$encabezado?>98&ordcambio=1' alt='Ordenar Por Leidos' >
		        <span class='leidos'>Impresos</span></a>
                <?=$img7 ?> <a href='<?=$pagina_actual?>?<?=$encabezado?>99&ordcambio=1'  alt='Ordenar Por Leidos'><span class='no_leidos'>
                    Por Imprimir</span></a>
		        </td>
		   </tr>
         </table>
       </td>
	   <?
       } 
	   ?>
       <td width='50%' align="center" class="titulos2" > 
		<a href='<?=$pagina_sig?>?<?=$encabezado?>'></a>
           <input type=submit value="<?=$accion_sal?>" name=Enviar id=Enviar valign='middle' class='botones_largo' onclick="Marcar(2);">			
       </td>
     </tr>
   </table>

<script>
function Marcar(tipoAnulacion)
{
	marcados = 0;

	for(i=0;i<document.formEnviar.elements.length;i++)
	{
	
			if(document.formEnviar.elements[i].checked==1)
			{
				
				marcados++;
			}
	}
	if(marcados>=1)
	{

	  document.formEnviar.submit();
	}
	else
	{
		alert("Debe seleccionar un usuario");
	}
}
		<!-- Funcion que activa el sistema de marcar o desmarcar todos los check  -->
		
		function markAll()
		
		{
		if(document.formEnviar.elements['checkAll'].checked)
		for(i=1;i<document.formEnviar.elements.length;i++)
		document.formEnviar.elements[i].checked=1;
		else
				for(i=1;i<document.formEnviar.elements.length;i++)
				document.formEnviar.elements[i].checked=0;
		}
</script>
