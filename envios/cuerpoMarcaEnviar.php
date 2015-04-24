<?
session_start();
/*************************************************************************************/
/* ORFEO GPL:Sistema de Gestion Documental		http://www.orfeogpl.org	     */
/*	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS    */
/*	orfeogpl@gmail.com   */
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
/*   Hollman Ladino       hollmanlp@gmail.com                Desarrollador           */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/* CARLOS BARRERO carlosabc81@gmail.com*/
/*************************************************************************************/
?>
<?

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

if($_GET["carpeta"]) $carpeta=$_GET["carpeta"];
$tipo_carpt=$_GET["tipo_carpt"];
$adodb_next_page=$_GET["adodb_next_page"];
if($_GET["gen_lisDefi"]) $gen_lisDefi=$_GET["gen_lisDefi"];
if($_GET["dep_sel"]) $dep_sel=$_GET["dep_sel"];
if($_GET["generar_listado"]) $generar_listado=$_GET["generar_listado"];
if($_GET["cancelarAnular"]) $cancelarAnular=$_GET["cancelarAnular"];
if($_GET["orderNo"]) $orderNo=$_GET["orderNo"];
if($_GET["orderTipo"]) $orderTipo=$_GET["orderTipo"];
if($_GET["busqRadicados"]) $busqRadicados=$_GET["busqRadicados"];
if($_GET["estado_sal_max"]) $estado_sal_max=$_GET["estado_sal_max"];
if($_GET["estado_sal"]) $estado_sal=$_GET["estado_sal"];
if($_GET["Buscar"]) $Buscar=$_GET["Buscar"];

$ruta_raiz = "..";



include_once "$ruta_raiz/class_control/usuario.php"; 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");  
include_once "$ruta_raiz/class_control/TipoDocumento.php"; 
include_once "$ruta_raiz/class_control/firmaRadicado.php";



$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//Se crea el objeto de an�lisis de firmas
$objFirma = new  FirmaRadicado($db);

if (!$_SESSION['dependencia']) include "../rec_session.php";
$nombusuario = $_SESSION['usua_nomb'];
if (!$dep_sel) $dep_sel = $dependencia;

$sqlFechaHoy=$db->conn->DBDate($fecha_hoy);

?>

<html>
<head>
  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<?
//variable con la fecha formateada
$fechah=date("dmy") . "_". time("h_m_s");
//variable con elementos de sesi�n
$encabezado = session_name()."=".session_id()."&krd=$krd" ;

?>
<script>

pedientesFirma="";
function back() {
    history.go(-1);
}

function recargar(){
	window.location.reload();	
}

function editFirmantes(rad){
	nombreventana="EdiFirms";
	url="<?=$ruta_raiz?>/firma/editarFirmates.php?radicado=" + rad +"&<?="&usua_nomb=$usua_nomb&&depe_nomb=$depe_nomb&usua_doc=$usua_doc&krd=$krd&".session_name()."=".trim(session_id()) ?>&usua=<?=$krd?>";
	window.open(url,nombreventana,'height=500,width=750,scrollbars=yes,resizable=yes');
	return; 
}

function solicitarFirma () {
	marcados = 0;
	radicados = "";

	for(i=0;i<document.formEnviar.elements.length;i++){
		if(document.formEnviar.elements[i].checked==1)	{
			marcados++;
			if (radicados.length > 0)
				radicados = radicados + ",";
			radicados = radicados +  (document.formEnviar.elements[i].value) ;
		}
	}

	if(marcados>=1)	{
		
		nombreventana="SolFirma";
		url="<?=$ruta_raiz?>/firma/seleccFirmantes.php?codigo=&<?="&usua_nomb=$usua_nomb&&depe_nomb=$depe_nomb&usua_doc=$usua_doc&krd=$krd&".session_name()."=".trim(session_id()) ?>&usua=<?=$krd?>&radicados="+radicados;
		window.open(url,nombreventana,'height=550,width=1000,scrollbars=yes,resizable=yes');
		return; 
	  
	}else{
		alert("Debe seleccionar un radicado");
	}	

}

function valPendsFirma (){
	
	for(i=0;i<document.formEnviar.elements.length;i++){
		if(document.formEnviar.elements[i].checked==1)	{
			if (pedientesFirma.indexOf(document.formEnviar.elements[i].value)!=-1){
					alert ("No se puede enviar el radicado " + document.formEnviar.elements[i].value + " pues se encuentra pendiente de firma ");
					return false;
				}
				
		}
	}
	
	return true;
}

function continuar(){
	accion = '<?=$pagina_sig?>?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&usua_perm_impresion=$usua_perm_impresion&estado_sal_max=$estado_sal_max" ?>';
	alert (accion);
}

</script>
<?php  
   error_reporting(7);  
  ?> 
<link rel="stylesheet" href="../estilos/orfeo.css">
<?
  

	
     
	if(!$carpeta) 
	 	$carpeta=0;
	 	
 	if(!$estado_sal)   
 		{$estado_sal=2;}
 		
 	if(!$estado_sal_max) 
 		$estado_sal_max=3;

 if($estado_sal==2){
    $accion_sal = "Marcar Documentos Como Impresos";
    $nomcarpeta = "Documentos Para Impresion";

	$pagina_sig = "cuerpoMarcaEnviar.php";
    if($usua_perm_impresion==2){
	$swBusqDep  = "S";
     }

/*
Adicionado Carlos Barrero -SES-
*/


    $dependencia_busq1 = " and c.radi_depe_radi  = $dep_sel ";

	$dependencia_busq2 = " and c.radi_depe_radi  = $dep_sel";	
/*
Modificado Carlos Barrero -SES-16/10/09
*/



if($_SESSION['entidad']=="SES")
{
    if(!$dep_sel[0]) $dep_sel[0] = $dependencia;
    $dependencia_busq1 = " and substr(c.radi_depe_radi,0,1)  = ".$dep_sel[0];	
    $dependencia_busq2 = " and substr(c.radi_depe_radi,0,1)  = ".$dep_sel[0];	

}

 }
 
	//variable que indica la acci�n a ejecutar en el formulario
	$accion_sal = "Marcar Documentos como Impresos";
	//variable que indica la acci�n a ejecutar en el formulario
	$nomcarpeta= "Marcar Documentos como Impresos"; 
	$carpeta = "nada";
    $pagina_sig = "../envios/marcaEnviar.php";
    $pagina_actual = "../envios/cuerpoMarcaEnviar.php";
	$varBuscada = "radi_nume_salida";
    $swListar = "si";
    
 
 if ($orden_cambio==1)  {
 	if (!$orderTipo)  {
	   $orderTipo=" DESC";
	}else  {
	   $orderTipo="";
	}
 }
	

  
//var de formato para la tabla
$tbbordes = "#CEDFC6";
//var de formato para la tabla
$tbfondo = "#FFFFCC";

//le pone valor a la variable que maneja el criterio de ordenamiento inicial
if(!$orno){
	$orno=1;
	$ascdesc=$orderTipo;
}

$imagen="flechadesc.gif";
 				

?> 
<script>
<!-- Esta funcion esconde el combo de las dependencia e inforados Se activan cuando el menu envie una se�al de cambio.-->
 
function window_onload()
		
{
   
   form1.depsel.style.display = '';
   form1.enviara.style.display = '';
   form1.depsel8.style.display = 'none';
   form1.carpper.style.display = 'none';
   setVariables();
  setupDescriptions();
}



function markAll()
{
if(form1.marcartodos.checked==1)
for(i=4;i<form1.elements.length;i++)
form1.elements[i].checked=1;
else
    for(i=4;i<form1.elements.length;i++)
  	form1.elements[i].checked=0;
}
<?php
   //include "libjs.php";
	 function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}
?>

</script>
<script>
function cambioDependecia (dep){
	document.formDep.action="cuerpo_masiva.php?krd=<?=$krd?>&dep_sel="+dep;
	//alert(document.formDep.action);
	document.formDep.submit();
}

function marcar()
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
		
		if (valPendsFirma())
			document.formEnviar.submit();
	}
	else
	{
		alert("Debe seleccionar un radicado");
	}
}

</script>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
</head>

<body  topmargin="0" >

<div id="object1" style="position:absolute; visibility:show; left:10px; top:-50px; width=80%; z-index:2" > 
  <p>Cuadro de Historico</p>
</div>
<?php
 
   $sqlFecha = $db->conn->SQLDate("Y/m/d","r.SGD_RENV_FECH");
	$img1="";$img2="";$img3="";$img4="";$img5="";$img6="";$img7="";$img8="";$img9="";
  IF($ordcambio){
  		IF($ascdesc=="" )
  			{$ascdesc="DESC";	$imagen="flechadesc.gif";}
  		else
  			{$ascdesc="";$imagen="flechaasc.gif";}
  }else 
  		if ($ascdesc=="DESC")
  			$imagen="flechadesc.gif";
  		else 
  			$imagen="flechaasc.gif";
  			
	
  
  if($orno==1){$order=" a.radi_nume_salida  $ascdesc";$img1="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==2){$order=" 6  $ascdesc";$img2="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	if($orno==3){$order=" a.anex_radi_nume $ascdesc";$img3="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	If($orno==4){$order=" c.radi_fech_radi  $ascdesc";$img4="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	If($orno==5){$order=" a.anex_desc  $ascdesc";$img5="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	If($orno==6){$order=" a.sgd_fech_impres  $ascdesc";$img6="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	If($orno==7){$order=" a.anex_creador $ascdesc";$img7="<img src='../iconos/$imagen' border=0 alt='$data'>";}
	If($orno==8){$order=" a.anex_creador $ascdesc";$img7="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		


  $encabezado = session_name()."=".session_id()."&dep_sel=$dep_sel&krd=$krd&estado_sal=$estado_sal&usua_perm_impresion=$usua_perm_impresion&fechah=$fechah&estado_sal_max=$estado_sal_max&ascdesc=$ascdesc&orno=";
  $fechah=date("dmy") . "_". time("h_m_s");
 	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
 	$row=array();
   
	?>

  
<br>
<table border=0 width='100%' class='t_bordeGris' align='center'>
  <tr >
    <td height="20" > 
      <TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
          <tr> 
			
          <td height="73"> 
            <? 
			    include "../envios/paEncabeza.php";
				include "../envios/paBuscar.php"; 
			   // include "../envios/paOpciones.php";   
			    /*
 				* GENERAR LISTADO ENTREGA FISICOS
 				*/ 
		?>
		<table BORDER=0  cellpad=2 cellspacing='2'  width="100%" >
<tr>
	<td width='50%' align='left' height="40" class="titulos2" ><b>Listar Por </b>
	<a href='<?= $pagina_actual?>?<?=$encabezado?>98&ordcambio=1' alt='Ordenar Por Leidos' >
	<span class='leidos'>Impresos</span></a>
	<?=$img7 ?> <a href='<?=$pagina_actual?>?<?=$encabezado?>99&ordcambio=1'  alt='Ordenar Por Leidos'><span class='no_leidos'>
	Por Imprimir</span></a>
	
	</td>
	<td class="titulos2" align="center">
	
	
	
	<a href='<?=$pagina_sig?>?<?=$encabezado?> '></a>
	<input type=submit value="<?=$accion_sal?>" name=Enviar id=Enviar valign='middle' class='botones_largo' onclick="marcar();">
	


	</td>
	
</tr>
</table>



</td>


</tr>
</table>
		<? 
 			 $accion_sal2 = "Generar Listado de Entrega";
 			include "../envios/paListado.php"; 
	/*  GENERACION LISTADO DE RADICADOS
	 *  Aqui utilizamos la clase adodb para generar el listado de los radicados
	 *  Esta clase cuenta con una adaptacion a las clases utiilzadas de orfeo.
	 *  el archivo original es adodb-pager.inc.php la modificada es adodb-paginacion.inc.php
	 */
			    
			    include "$ruta_raiz/include/query/envios/queryCuerpoMarcaEnviar.php"; 
			    
			    
			    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
			      //$db->conn->debug=true;
	      		$rs=$db->query($isql); 
	      		
	      		if ($usua_perm_firma==2 || $usua_perm_firma==3){
			 	?>
            <table cellpad=2 cellspacing='0' WIDTH=100% class='borde_tab' valign='top' align='center' >
              <tr  class="titulos2" > 
                <td align='left' height="17"  > <span class='etextomenu'> 
                  </span> </td>
                <td width='10%' align="left" height="17"> 
                  <input type=button value='Solicitar Firma' name=solicfirma valign='middle' class='botones' onclick="solicitarFirma();" >
                </td>
              </tr>
            </table>
            
            <?
	      	}
	      	?>
            
          </td>
		  </tr>
	 </table>			
	 <form name='formEnviar'  method='GET' onsubmit=" return alert ('12345')" action=<?=$pagina_sig?>?<?=session_name()."=".session_id()."&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&usua_perm_impresion=$usua_perm_impresion&estado_sal_max=$estado_sal_max" ?> >
        <TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
           <tr> 
            <td class="grisCCCCCC"> 
              <table width="100%"  border="0"  cellpadding="0" cellspacing="5" class="borde_tab"'>
                <tr class='titulos3' > 
                  <td  align="center" width="14%"> <img src='<?=$ruta_raiz?>/imagenes/estadoDoc.gif'  border=0 > 
                  </td>
                  <td width='8%' align="center">
                  	<a href='<?=$PHP_SELF."?".$encabezado ?>1&ordcambio=1&orno=1' class='textoOpcion' alt='Ordenamiento'>
                  		<?=$img1 ?>
                  		Radicado Salida 
                  	</a>
                  </td>
                  <td  width='5%' align="center">
                  	<a href='<?=$PHP_SELF."?".$encabezado ?>1&ordcambio=1&orno=2' class='textoOpcion' alt='Ordenamiento'>
                  		<?=$img2 ?>
                  		Copia 
                  	</a>
                  </td>
                  <td  width='9%' align="center"> 
                   	  <a href='<?=$PHP_SELF."?".$encabezado ?>1&ordcambio=1&orno=3' class='textoOpcion' alt='Ordenamiento'>
                      	<?=$img3 ?>
                      	Radicado Padre
                      </a>
                  </td>
                  <td  width='9%' align="center"> 
                  	<a href='<?=$PHP_SELF."?".$encabezado ?>1&ordcambio=1&orno=4' class='textoOpcion' alt='Ordenamiento'>
                  		<?=$img4 ?>
                  		Fecha Radicado
                  	</a>
                  </td>
                  <td  width='30%' align="center"> <a href='<?=$PHP_SELF."?".$encabezado ?>1&ordcambio=1&orno=5' class='textoOpcion' alt='Ordenamiento'> 
                    <?=$img5 ?>
                    Descripcion </a> </td>
                  <td  width='12%' align="center"> <a href='<?=$PHP_SELF."?".$encabezado ?>1&ordcambio=1&orno=6' class='textoOpcion' alt='Ordenamiento'>	
                    <?=$img6 ?>
                    </a> Fecha Impresion </td>
                  <td  width='10%' align="center"> <a href='<?=$PHP_SELF."?".$encabezado ?>1&ordcambio=1&orno=7' class='textoOpcion' alt='Ordenamiento'>	
                    <?=$img7 ?>
                    Generado Por </a> </td>
                  <td  width='3%' align="center"> </td>
                </tr>
                <?
		 
		 $i = 1;
		 $ki=0;
	   $registro=$pagina*100;
   while($rs&&!$rs->EOF)
	 	 { 
	 	 	
       if($ki>=$registro and $ki<($registro+100)){
       	    
			$swEsperaFirma =  false;
			$estado=	$rs->fields['CHU_ESTADO'];
			$copia = $rs->fields['COPIA']; 
			$documentos=$rs->fields['DOCUMENTOS'];
			$rad_salida = $rs->fields['IMG_RADICADO_SALIDA'];  
			$rad_padre = $rs->fields['RADICADO_PADRE'];  
			$cod_dev = $rs->fields['HID_DEVE_CODIGO']; 
			$fech_radicado = $rs->fields['FECHA_RADICADO'];   
			$descripcion = $rs->fields['DESCRIPCION'];    
		    $fecha_impre = $rs->fields['FECHA_IMPRESION']; 
		    $fecha_dev = $rs->fields['HID_SGD_DEVE_FECH']; 
		    $generadoPor = $rs->fields['GENERADO_POR'];  
		    $path_imagen = $rs->fields['HID_RADI_PATH'];   
		    
			//***********************************************
			$edoDev = 0; 
				
				if ($cod_dev ==0 OR $cod_dev ==NULL)  {$edoDev = 97;} else {if ($cod_dev > 0)  $edoDev = 98;}
				if ($cod_dev ==99)  $edoDev = 99;
				  
				switch($edoDev) 
				{			
				case 99:
				$imgEstado ="<img src='$ruta_raiz/imagenes/docDevuelto_tiempo.gif'  border=0 alt='Fecha Devolucionyy :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
				break;
				case  98:
				$imgEstado =	"<img src='$ruta_raiz/imagenes/docDevuelto.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
					break;
				case 97:
					$fecha_dev = $rs->fields["HID_SGD_DEVE_FECH"];
					if($rs->fields["HID_DEVE_CODIGO1"]==99)
					{
						$imgEstado =	"<img src='$ruta_raiz/imagenes/docDevuelto_tiempo.gif'  border=0 alt='Fecha Devolucionx :$fecha_dev' title='Devolucion por Tiempo de Espera'>";
						$noCheckjDevolucion = "enable";
						break;
					}
					if($rs->fields["HID_DEVE_CODIGO"]>=1 and $rs->fields["HID_DEVE_CODIGO"]<=98)
					{
						$imgEstado =	"<img src='$ruta_raiz/imagenes/docDevuelto.gif'  border=0 alt='Fecha Devolucionn :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
						$noCheckjDevolucion = "disable";
						break;
					}
				switch($estado) 
				{
				case 2:
				$estadoFirma = $objFirma->firmaCompleta($rad_salida);
				if ($estadoFirma == "NO_SOLICITADA")
					$imgEstado = "<img src=$ruta_raiz/imagenes/docRadicado.gif  border=0>";
				else if ($estadoFirma == "COMPLETA"){
					$imgEstado = "<a  href='javascript:editFirmantes($rad_salida)' > <img src=$ruta_raiz/imagenes/docFirmado.gif  border=0></a>"; 
				}else if ($estadoFirma == "INCOMPLETA"){ 
					$imgEstado = "<a  href='javascript:editFirmantes($rad_salida)' >
								  	<img src=$ruta_raiz/imagenes/docEsperaFirma.gif border=0>
								  </a>";
					$swEsperaFirma=true;
				}
				break;
				case 3:
				$imgEstado = "<img src=$ruta_raiz/imagenes/docImpreso.gif  border=0>";
				break;
				case 4:
				$imgEstado ="<img src=$ruta_raiz/imagenes/docEnviado.gif  border=0>";
				break;
				}
			break;
		}
			
			//************************************************
			      
			
			
			
			
			
			
				
            if($data =="") $data = "NULL";
			error_reporting(7);

			
			 if($i==1){
			    $formato ="listado2";
				
				$i=2;
			 }else{
			    $formato ="listado1";
				
   				$i=1;
			 }
			
	
				
				
				
				
			 ?>
                <tr class='<?=$formato?>'> 
                  <td class='<?=$leido ?>' align="center" width="14%"> 
                    <?=$imgEstado ?>
                  </td>
                  <td class='<?=$leido ?>' width="8%"> 
                  	 <a href='<?=$ruta_raiz?>/bodega<?=$path_imagen."?time=".time() ?>' >
                    <?=$rad_salida ?> </a>
                  </td>
                  <td class='<?=$leido ?>' width="5%"> <span class='$leido'> 
                    <?=$copia ?>
                    </span> </td>
                  <td class='<?=$leido ?>' width="9%"> 
                    <?=$rad_padre  ?>
                  </td>
                  <td  class='<?=$leido ?>' width="9%"> 
                    <?=$fech_radicado ?>
                  </td>
                  <td class='<?=$leido ?>' width="30%"> 
                    <?=$descripcion ?>
                  </td>
                  <td class='<?=$leido ?>' width="12%"> &nbsp; 
                    <?=$fecha_impre;?>
                  </td>
                  <td class='<?=$leido ?>' width="10%" > 
                    <?=$generadoPor ?>
                  </td>
                  <td align='center' class='<?=$leido ?>' width="3%"> 
                    <?if ($swEsperaFirma) { ?>
                    <script>
                    pedientesFirma = pedientesFirma + <?=$rad_salida?> + "," ;
                    </script>
                      <?}?>
                    <input type=checkbox name='checkValue[<?=$rad_salida?>]' value='<?=$rad_salida?>'  >
                  
                  
									
                  </td>
                </tr>
                <?
								
				}
					$ki=$ki+1;				
				  $rs->MoveNext();	
       }
			 
   
	 ?>
              </table>
            </TD>
          </tr>
        </TABLE>

	 </form>
<table border=0 cellspace=2 cellpad=2 WIDTH=98% class='t_bordeGris' align='center'>
        <tr align="center"> 
          <td> <?	 	
					
	$numerot = $ki;
	
	// Se calcula el numero de | a mostrar
	$paginas = ($numerot / 100); 
	?><span class='leidos'> Paginas</span> <?
	if(intval($paginas)<=$paginas)
	{$paginas=$paginas;}else{$paginas=$paginas-1;}
	// Se imprime el numero de Paginas.
	for($ii=0;$ii<$paginas;$ii++)
	{
	  if($pagina==$ii){$letrapg="<font color=green size=3>";}else{$letrapg="<font color=blue size=2>";}
	  echo " <a  class=paginacion  href='$PHP_SELF?dep_sel=$dep_sel&pagina=$ii&$encabezado&orno=$orno'>$letrapg".($ii+1)."</font></a>\n";
	}
	 
	 
   ?> </td>
        </tr></table>
</td></tr></table>
	  
  
<br>
</body>
</html>
