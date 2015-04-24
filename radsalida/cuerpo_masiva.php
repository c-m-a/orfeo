<?
session_start(); 
/**
  * Modificacion para aceptar Variables GLobales
  * @autor Jairo Losada 
  * @fecha 2009/05
  */
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];

/*
 * Lista Subseries documentales
 * @autor Jairo Losada
 * @fecha 2009/06 Modificacion Variables Globales. Arreglo cambio de los request Gracias a recomendacion de Hollman Ladino
 */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

//Programa que genera el listado de todos los grupos de masiva generados por la dependencia, que no han sido enviados y da la opci�n de 
//generar el env�o respectivo


$ruta_raiz = "..";
//print("El krd ($krd)($dep_sel)");



include_once "$ruta_raiz/class_control/GrupoMasiva.php"; 
include_once "$ruta_raiz/class_control/usuario.php"; 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");  
include_once "$ruta_raiz/class_control/TipoDocumento.php"; 
require_once("$ruta_raiz/include/combos.php");
if (!$db) $db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 
		
if (!$_SESSION['dependencia'] || !$_SESSION['nombusuario'])   
	include "../rec_session.php";
//$db->conn->debug=true;

$grupoMas = & new GrupoMasiva($db);
$usuarioGen = & new Usuario($db);
$tipoDoc = & new TipoDocumento($db);

if (strlen($dep_sel)<1)
	$dep_sel=$dependencia;	

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
function back() {
    history.go(-1);
}
   

</script>
<?php  
   error_reporting(7);  
  ?> 
<link rel="stylesheet" href="../estilos/orfeo.css">
<?
  
	//variable que indica la acci�n a ejecutar en el formulario
	$accion_sal = "Envio de Documentos";
	//variable que indica la acci�n a ejecutar en el formulario
	$pagina_sig = "envio_masiva.php";	
	
	 

  
//var de formato para la tabla
$tbbordes = "#CEDFC6";
//var de formato para la tabla
$tbfondo = "#FFFFCC";

//le pone valor a la variable que maneja el criterio de ordenamiento inicial
if(!$orno){$orno=1;}

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
</script>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
</head>

<body topmargin="0" >
<div id="object1" style="position:absolute; visibility:show; left:10px; top:-50px; width=80%; z-index:2" > 
  <p>Cuadro de Historico</p>
</div>
<?php

   $sqlFecha = $db->conn->SQLDate("Y/m/d","r.SGD_RENV_FECH");
	$img1="";$img2="";$img3="";$img4="";$img5="";$img6="";$img7="";$img8="";$img9="";
  IF($ordcambio){IF($ascdesc=="" ){$ascdesc="DESC";	$imagen="flechadesc.gif";}else{$ascdesc="";$imagen="flechaasc.gif";}}
	if($orno==1){$order=" r.radi_nume_grupo $ascdesc";$img1="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 
	if($orno==4){$order=" $sqlFecha $ascdesc";$img4="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 
  
	$datosaenviar = "fechaf=$fechaf&tipo_carp=$tipo_carp&ascdesc=$ascdesc&orno=$orno";
  $encabezado = session_name()."=".session_id()."&dep_sel=$dep_sel&krd=$krd&estado_sal=$estado_sal&fechah=$fechah&estado_sal_max=$estado_sal_max&ascdesc=$ascdesc&orno=";
  $fechah=date("dmy") . "_". time("h_m_s");
 	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
 	$row=array();
               
	?>

  
<br>
<table border=0 width='100%' align='center' >
  <tr >
    <td height="20" > 
      
          <?php
	     /** Instruccion que realiza la consulta de radicados segun criterios
		   * Tambien observamos que se encuentra la varialbe $carpetaenviar que maneja la carpeta 11.
		   */
           include "$ruta_raiz/include/query/radsalida/queryCuerpoMasiva.php";

				 $rs=$db->query($isql);
				?> 
	    <table BORDER=0 cellspacing='5' WIDTH=100%  valign='top' align='center' class="borde_tab" >
          <TR >
            <TD width='35%' > 
              <table width='100%' border='0' cellspacing='1' cellpadding='0'>
                <tr> <?
	     IF($nomcarpeta=="")
			 {
			      $nomcarpeta=" RADICADOS DE MASIVA ";
			 }

  ?> 
                  <td height="20" class='titulos2'>Listado de </td>
                </tr><tr>
                  <td height="20" class="listado2"><span class="etextomenu"><?=$nomcarpeta ?> 
                    </span></td>
                </tr>
              </table>
            </td>
            <TD width='32%'  > 
              <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr> 
                  <td width="10%" class='titulos2' height="20">Usuario</td>
                </tr><tr>
                  <td width="90%" height="20" class='listado2'><?=$nombusuario ?></td>
                </tr>
              </table>
            </td>
            <td height="37" width="33%"> 
              <table width="100%" border="0" cellspacing="1" cellpadding="0">
                <tr> 
                  <td width="16%" class='titulos2' height="20">Dependencia&nbsp;</td>
                </tr><tr>
                  
                <td width="84%" height="20" class='listado2'>
				  <form name=formDep>
                  <select name="dep_sel" class="select" id="tipo_clase"  onChange = "cambioDependecia(this.value)"  >
                    <option selected value="null">----- tipos de documento -----</option>
                    <?php
       // Arma la lista desplegable con los tipos de documento a anexar
            
			$a = new combo($db);  
			$codiATexto = $db->conn->numToString("DEPE_CODI");
			$concatSQL=$db->conn->Concat($codiATexto,"' '","DEPE_NOMB");
      $s = "SELECT DEPE_CODI,$concatSQL as NOMBRE  from dependencia order by depe_codi asc ";
			$r = "DEPE_CODI"; 
			$t = "NOMBRE";
			$v = $dep_sel;
			$sim = 0; 
      		$a->conectar($s,$r,$t,$v,$sim,$sim);
						
      	 ?>
                  </select>
                    <input type="hidden" name="krd" value=<?=$krd?>>
                  </form>
                  <FORM name=form_busq_dep action='cuerpo_masiva.php?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>' method=post>
                  </FORM>
					</td>
                </tr>
              </table>
            </TD>
          </tr>
        </table>
     <TABLE width="98%" align="center" cellspacing="0" cellpadding="0">
          <tr> 
			<td>
			</td>
		  </tr>
	 </table>			
	 <form name='form1' action='<?=$pagina_sig?>?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max" ?>' method=post>
        <TABLE width="100%" align="center" cellspacing="0" cellpadding="0">
          <tr> 
            <TD class="grisCCCCCC" height="58"> 
              <table BORDER=0  cellpad=2 cellspacing='2' WIDTH=100% class='borde_tab' valign='top' align='center' cellpadding="2" >
                <tr bgcolor="titulos5"> 
                  <td align='left' height="40" class="titulos5"  >
                    <input type="hidden" name="dep_sel" value =<?=$dep_sel?> >
                    <span class='etextomenu'>
                    <input type="hidden" name="krd" value=<?=$krd?>>
                    </span> </td>
                  <td width='10%' align="left" class='titulos5'> 
                    <input type=submit value='<?=$accion_sal ?>' name=Enviar valign='middle' class='botones_largo'>
                  </td>
                </TR>
              </TABLE>
            </td>
          </tr>
          <tr> 
            <td class="grisCCCCCC"> 
              <table border=0 cellspacing='5' WIDTH=100% class='borde_tab' align='center' >
                <tr bgcolor="#cccccc" class='titulos3'> 
                  <?

		  ?>
                  <td  align="center" width="10%" class='titulos3'> <a href='cuerpo_masiva.php?<?=$encabezado ?>1&ordcambio=1' class='titulos3' alt='Seleccione una busqueda'> 
                    <?=$img1 ?>
                    Grupo </a> </td>
                  <td width='9%' align="center"> Radicado Inicial </td>
                  <td  width='11%' align="center"> Radicado Final </td>
                  <td  width='7%' align="center"> 
                    <p><a href='cuerpo_masiva.php?<?=$encabezado ?>4&ordcambio=1' class='textoOpcion'  alt='Seleccione una busqueda'> 
                      <?=$img4 ?>
                      Fecha</a></p>
                  </td>
                  <td  width='10%' align="center"> Documentos</td>
                  <td  width='9%' align="center">Eliminados del grupo</td>
                  <td  width='28%' align="center"> Generado <br>
                    Por </td>
                  <td  width='12%' align="center"> Tipo<br>
                  </td>
                  <td  width='4%' align="center"> Enviar<br>
                  </td>
                </tr>
                <?
		 
		 $i = 1;
		 $ki=0;
	   $registro=$pagina*20;
   while($rs&&!$rs->EOF)
	 	 { 
       if($ki>=$registro and $ki<($registro+20)){
		  $radi_nume_grupo=	$rs->fields['RADI_NUME_GRUPO'];
		  $documentos=$rs->fields['DOCUMENTOS']; 
            if($data =="") $data = "NULL";
			error_reporting(7);
			 if($i==1){
			    $formato ="listado2";
				$leido ="leidos";
				$i=2;
			 }else{
			    $formato ="listado1";
				$leido ="leidos";
   				$i=1;
			 }
			 $grupoMas->limpiarGrupoSacado();
				$grupoMas->setGrupoSacado($radi_nume_grupo);
				$eliminados = $grupoMas->getNumeroSacados();
				$tipoDoc->TipoDocumento_codigo($rs->fields['TDOC_CODI']);
				//print("Eliminados $eliminados ($radi_nume_grupo) **");
			 ?>
                <tr class='<?=$formato?>'> 
                  <?
									
									$usuarioGen->limpiarAtributos();
									$usuarioGen->usuarioDocto($rs->fields['USUA_DOC']);
								//	print ("DOCTO".$row["usua_doc"]);   
			 						?>
                  <td class='leidos' align="center" width="10%">
				    <a href='lista_sacar_grupo.php?grupo=<?=$radi_nume_grupo?>&krd=<?=$krd?>&dep_sel=<?=$dep_sel?>'><span class='leidos'> 
                    <?=$radi_nume_grupo ?>
                    </span></a> </td>
                  <td class='<?=$leido ?>' width="9%"> 
                    <?=$rs->fields['RAD_INI']; ?>
                  </td>
                  <td class='<?=$leido ?>' width="11%"> <span class='<?=$leido ?>'> 
                    <?=$rs->fields['RAD_FIN']; ?>
                    </span> </td>
                  <td class='<?=$leido ?>' width="7%"> 
                    <?=$rs->fields['FECHA'];  ?>
                  </td>
                  <td  class='<?=$leido ?>' width="10%"> 
                    <?=$documentos ?>
                  </td>
                  <td class='<?=$leido ?>' width="9%"> 
                    <?=$eliminados ?>
                  </td>
                  <td class='<?=$leido ?>' width="28%"> &nbsp; 
                    <?=$usuarioGen->get_usua_nomb();?>
                  </td>
                  <td class='<?=$leido ?>' width="12%" > 
                    <?=$tipoDoc->get_sgd_tpr_descrip() ?>
                  </td>
                  <td align='center' class='<?=$leido ?>' width="4%"> 
                  <?if ($documentos - $eliminados>0){ ?>
										<INPUT type="radio" name="radGrupo" value="<?=$radi_nume_grupo ?>">
									<?}?>
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
<table border=0 cellspacing="5"  WIDTH=100% class='borde_tab' align='center'>
        <tr align="center"> 
          <td> <?	 	
					
	$numerot = $ki;
	
	// Se calcula el numero de | a mostrar
	$paginas = ($numerot / 20);
	?><span class='leidos'> Paginas</span> <?
	if(intval($paginas)<=$paginas)
	{$paginas=$paginas;}else{$paginas=$paginas-1;}
	// Se imprime el numero de Paginas.
	for($ii=0;$ii<$paginas;$ii++)
	{
	  if($pagina==$ii){$letrapg="<font color=green size=3>";}else{$letrapg="<font  class=leidos size=2>";}
	  echo " <a href='cuerpo_masiva.php?dep_sel=$dep_sel&pagina=$ii&$encabezado$orno'>$letrapg".($ii+1)."</font></a>\n";
	}
	 
	 
   ?> </td>
        </tr></table>
</td></tr></table>
	  
  
<br>
</body>
</html>
