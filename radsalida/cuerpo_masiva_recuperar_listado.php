<?
//Programa que genera el listado de todos los grupos de masiva generados por la dependencia y da la opción de recuperar el listado de cualquiera de
//ellos
session_start(); 
$ruta_raiz = "..";

include_once "$ruta_raiz/class_control/GrupoMasiva.php"; 
include_once "$ruta_raiz/class_control/usuario.php"; 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/class_control/TipoDocumento.php"; 

if (!$db)
		$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);	 


if (!$dependencia || !$nombusuario)   include "../rec_session.php";


$grupoMas = & new GrupoMasiva($db);
$usuarioGen = & new Usuario($db);
$tipoDoc = & new TipoDocumento($db);

//$db->conn->debug=true;
?>

<html>
<head>
  <meta http-equiv="Cache-Control" content="cache">
  <meta http-equiv="Pragma" content="public">
<?
$fechah=date("dmy") . "_". time("h_m_s");
$encabezado = session_name()."=".session_id()."&krd=$krd";
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
<?PHP
if($dep_sel)
  {
    $accion_sal = "Recuperar Listado";
	$pagina_sig = "recuperar_listado.php";	
	$dependencia_busq2= " and sgd_depe_genera = '$dep_sel'";
  }  else
  {
      $accion_sal = "Envio de Documentos";
	$pagina_sig = "recuperar_listado.php";	
	$dependencia_busq2= " and sgd_depe_genera = '$dependencia'";
	
    }
if($busq_radicados)  
{
    $busq_radicados = trim($busq_radicados);
    $textElements = split (",", $busq_radicados);
    $newText = "";
    foreach ($textElements as $item)
    {
         $item = trim ( $item );
         if ( strlen ( $item ) != 0 )
		 { $sec = str_pad($item,6,"0",STR_PAD_left);
		   $item = date("Y") . $dep_sel . $sec;		 
           $busq_radicados_tmp .= "$item,";
		  }
     }	
	if(substr($busq_radicados_tmp,-1)==",")   $busq_radicados_tmp = substr($busq_radicados_tmp,0,strlen($busq_radicados_tmp)-1); 
	 $dependencia_busq2 .= " and radi_nume_salida in($busq_radicados_tmp)  ";
}
$tbbordes = "#CEDFC6";
$tbfondo = "#FFFFCC";
if(!$orno){$orno=1;}
$imagen="flechadesc.gif";
if($estado_sal==2)
  {

	$dependencia_busq1= " and radi_nume_sal like '2004$dependencia%'";
	$dependencia_busq2= " and radi_nume_salida like '2004$dependencia%'";
  } 				

?> 
<script>
<!-- Esta funcion esconde el combo de las dependencia e inforados Se activan cuando el menu envie una señal de cambio.-->


<?php
   //include "libjs.php";
	 function tohtml($strValue)
{
  return htmlspecialchars($strValue);
}
?>
</script>
<style type="text/css">
<!--
.textoOpcion {  font-family: Arial, Helvetica, sans-serif; font-size: 8pt; color: #000000; text-decoration: underline}
-->
</style>
</head>

<body bgcolor="#FFFFFF" topmargin="0" >
<div id="object1" style="position:absolute; visibility:show; left:10px; top:-50px; width=80%; z-index:2" > 
  <p>Cuadro de Historico</p>
</div>
<?php
 /* 
 PARA EL FUNCIONAMIENTO CORRECTO DE ESTA PAGINA SE NECESITAN UNAS VARIABLE QUE DEBEN VENIR 
 carpeta  "Codigo de la carpeta a abrir"
 nomcarpeta "Nombre de la Carpeta"
 tipocarpeta "Tipo de Carpeta  (0,1)(Generales,Personales)"
 

 seleccionar todos los checkboxes
*/
   
		 $img1="";$img2="";$img3="";$img4="";$img5="";$img6="";$img7="";$img8="";$img9="";
         IF($ordcambio){IF($ascdesc=="" ){$ascdesc="DESC";	$imagen="flechadesc.gif";}else{$ascdesc="";$imagen="flechaasc.gif";}}
		 if($orno==1){$order=" r.radi_nume_grupo $ascdesc";$img1="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 
		 if($orno==4){$order=" 5 $ascdesc";$img4="<img src='../iconos/$imagen' border=0 alt='$data'>";}
		 
  
	$datosaenviar = "fechaf=$fechaf&tipo_carp=$tipo_carp&ascdesc=$ascdesc&orno=$orno";
  $encabezado = session_name()."=".session_id()."&dep_sel=$dep_sel&krd=$krd&estado_sal=$estado_sal&fechah=$fechah&estado_sal_max=$estado_sal_max&ascdesc=$ascdesc&orno=";
    $fechah=date("dmy") . "_". time("h_m_s");
 
	$check=1;
	$fechaf=date("dmy") . "_" . time("hms");
    //$numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
    
	//$resultado = ora_parse($cursor,$isql);
	//$resultado = ora_exec($cursor);
	$row=array();
  //ora_fetch_into($cursor,$row, ORA_FETCHINTO_NULLS|ORA_FETCHINTO_ASSOC);  
	// Validacion de Usuario y COntraseña MD5
	//echo "** $krd *** $drde"; 
                       

			
				?>

  
<br>
<?php
	     /** Instruccion que realiza la consulta de radicados segun criterios
		   * Tambien observamos que se encuentra la varialbe $carpetaenviar que maneja la carpeta 11.
		   */
		 $sqlFecha = $db->conn->SQLDate("Y/m/D","r.SGD_RENV_FECH");
		
		 $limit = ""; 
	   include "$ruta_raiz/include/query/radsalida/queryCuerpoMasivaRecuperearListado.php";
	  			//$db->conn->debug=true;		
				 $rs=$db->query($isql);
				
				// print($isql); 
	
	     IF($nomcarpeta=="") {
			      $nomcarpeta=" RECUPERACION DE LISTADOS GENERADOS -MASIVA ";
			 }

  		 		 
		?> 
<table width="100%" border=0 cellpadding=0 cellspacing=5 class='borde_tab'> 
<tr>
    <td width='35%' >
      	<table width='100%' border='0' cellspacing='1' cellpadding='0'>
        	<tr> 
          		<td height="20" bgcolor="377584"><div align="left" class="titulo1">LISTADO DE: </div></td>
        	</tr>
			<tr class="info">
          		<td height="20"><?=$nomcarpeta?></td>
        	</tr>
      	</table>
    </td>	
    <td width='35%' >
   	 	<table width='100%' border='0' cellspacing='1' cellpadding='0'>
     		<tr> 
        		<td height="20" bgcolor="377584"><div align="left" class="titulo1">USUARIO </div></td>
        	</tr>
			<tr class="info">
          		<td height="20" ><?=$nombusuario?></td>
        	</tr>
      	</table>
    </td>
    <td width='35%' >
   	 	<table width='100%' border='0' cellspacing='1' cellpadding='0'>
     		<tr> 
        		<td height="20" bgcolor="377584"><div align="left" class="titulo1">DEPENDENCIA </div></td>
        	</tr>
			<tr class="info">
          		<td height="20" ><?=$depe_nomb?></td>
        	</tr>
      	</table>
    </td>
   
     </tr>
</table>


	
   		
	 <form name='form1' action='<?=$pagina_sig?>?<?=session_name()."=".session_id()."&krd=$krd&fechah=$fechah&dep_sel=$dep_sel&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max" ?>' method=post>
        <TABLE width="100%" >
          <tr> 
           
                  <td align='right' height="40" class="info"  >
              <input type=submit value='Recuperar Listado' name=Enviar valign='middle' class='botones_mediano' ">
            </td>
            
          </tr>
          <tr> 
            <td class="grisCCCCCC"> 
              <table border=0 width="100%" border=0 cellpadding=0 cellspacing=5 class='borde_tab'>
                <tr bgcolor="#cccccc" class="textoOpcion"> 
                  <?

		  ?>
                  <td  class="titulos3" width="10%"> <a href='cuerpo_masiva_recuperar_listado.php?<?=$encabezado ?>1&ordcambio=1' class='textoOpcion' alt='Seleccione una busqueda'> 
                    <?=$img1 ?>
                    Grupo </a> </td>
                  <td width='9%' class="titulos3" align="center"> Radicado Inicial </td>
                  <td  width='11%' class="titulos3" align="center"> Radicado Final </td>
                  <td  width='7%' class="titulos3" align="center"> 
                    <p><a href='cuerpo_masiva_recuperar_listado.php?<?=$encabezado ?>4&ordcambio=1' class='textoOpcion'  alt='Seleccione una busqueda'> 
                      <?=$img4 ?>
                      Fecha</a></p>
                  </td>
                  <td  width='10%' class="titulos3" align="center"> Documentos</td>
                  <td  width='9%' class="titulos3" align="center">Eliminados del grupo</td>
                  <td  width='28%' class="titulos3" align="center"> Generado <br>
                    Por </td>
                  <td  width='12%' class="titulos3" align="center"> Tipo<br>
                  </td>
                  <td  width='4%' class="titulos3" align="center"> Enviar<br>
                  </td>
                </tr>
                <?
		 
		 $i = 1;
		 $ki=0;
	// Comienza el siclo para mostrar los documentos de la parpeta predeterminada.
	     $registro=$pagina*20;
	     $leido="leidos";
   while($rs&&!$rs->EOF)
	 	 { 
       if($ki>=$registro and $ki<($registro+20)){
			
			
			  $radi_nume_grupo=	$rs->fields['RADI_NUME_GRUPO'];
			//	print("Grupo... ($radi_nume_grupo)");
			$documentos=$rs->fields['DOCUMENTOS']; 
		  
				
            if($data =="") $data = "NULL";
			error_reporting(7);
			 if($i==1){
			    $formato ="listado1";
				$i=2;
			 }else{
			    $formato ="listado2";
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
                  <td class='<?=$leido ?>' align="center" width="10%"> <A class="vinculos" href='lista_sacar_grupo.php?grupo=<?=$radi_nume_grupo?>&krd=<?=$krd?>'><span class="tgris"> 
                    <?=$radi_nume_grupo ?>
                    </span></a> </td>
                  <td class='<?=$leido ?>' width="9%"> 
                    <?=$rs->fields['RAD_INI']; ?>
                  </td>
                  <td class='<?=$leido ?>' width="11%"> 
                    <?=$rs->fields['RAD_FIN']; ?>
                   </td>
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
                    <INPUT type="radio" name="radGrupo" value="<?=$radi_nume_grupo ?>">
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
	$paginas = ($numerot / 20);
	?><span class='paginacion'> Paginas</span> <?
	if(intval($paginas)<=$paginas)
	{$paginas=$paginas;}else{$paginas=$paginas-1;}
	// Se imprime el numero de Paginas.
	for($ii=0;$ii<$paginas;$ii++)
	{
	  if($pagina==$ii){$letrapg="<font color=green size=3>";}else{$letrapg="<span class='paginacion'>";}
	  echo " <a class='vinculos' href='cuerpo_masiva_recuperar_listado.php?pagina=$ii&$encabezado$orno'>$letrapg".($ii+1)."</span></a>\n";
	}
	 
	 
   ?> </td>
        </tr></table>
</td></tr></table>
	  
  
<br>
</body>
</html>
